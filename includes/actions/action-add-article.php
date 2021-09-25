<?php 

    session_start();

    include("../../config.php");

    //Controllo che sia stata impostato il field "action" e se l'utente corrente ha effettuato il login
    if( isset($_POST['action'] ) && $_POST['action'] == "addArticle" && getCurrentUserID() !== false ){

        //Preparo la variabile che conterra il blog estratto dal database così posso verificare che il blog passato dal form esista davvero
        $blog = null;

        //Controllo che il titolo dell'articolo non sia vuoto, nel caso lo sia faccio redirect alla pagina profile inserento un parametro get di errore
        if( empty( $_POST['articleTitle'] ) ){
            header("location:/progetto-sito/create-article.php?articleinsert=titleempty");
            die();
        }
        
        //Controllo che il contenuto dell'articolo non sia vuoto, nel caso lo sia faccio redirect alla pagina profile inserendo un parametro get di errore
        if( empty( $_POST['articleContent'] ) ){
            header("location:/progetto-sito/create-article.php?articleinsert=contentempty");
            die();
        }


        //Controllo che l'id del blog in cui inserire l'articolo sia specificato e valido
        if( !empty( $_POST['blogId'] ) ){
            //Controllo che il parametro relativo all'id del blog sia numerico
            if( is_numeric( $_POST['blogId'] ) ){
                //Controllo che il blog passato dal form esista davvero
                $blog = getBlog( $conn, $_POST['blogId']);
                
                //Se il blog esiste davvero procedo alla creazione dell'articolo altrimenti rimando alla pagina creazione articolo segnalando errore con il parametro GET articolinsert
                if( $blog !== false ){

                    //Preparo un array $article dove inserisco le informazioni del nuovo articolo
                    $article = array(
                        "author_id" => getCurrentUserID(),
                        "title" => $_POST['articleTitle'],
                        "content" => trim( $_POST['articleContent'] ),
                    );

                    //All'interno dell'if faccio sia l'inserimento dell'articolo (con la funzione insertArticle) che la verifica dell'esito dell'inserimento
                    if( $newArticleID = insertArticle( $conn, $_POST['blogId'], $article ) ){
                        
                        //Incremento il numero di articoli per il blog sotto il quale verrà pubblicato l'articolo
                        increaseBlogNumArticles($conn, $_POST['blogId']);

                        //Formati consentiti per l'immagine in evidenza
                        $allowed_formats = array(
                            "img" => array( "png", "jpg", "jpeg", "tiff", "gif"),
                        );
                        $uploaded_content_path = "uploads/";
                        $upload_dir = "../../uploads/";
                        $error = null;
                        
                        //Controllo se è stata caricata un'immagine in evidenza
                        if( isset($_FILES['articleImage']['name'] ) ){
                            $file_details = pathinfo($_FILES['articleImage']['name']);
                            $content_inserted_id = array(
                                "img" => null,
                            );
                            
                            //Prendiamo l'immagine e la salviamo
                            if( in_array( $file_details['extension'], $allowed_formats['img'] ) ){
                                $file_name = generateRandomString(4) . date('His') . "." . $file_details['extension'];
                                $uploadfile = $upload_dir . $file_name;
                                if (move_uploaded_file($_FILES['articleImage']['tmp_name'], $uploadfile)) {
                                    $uploaded_content_path .= $file_name;
                                } else {
                                    $error = "uploadfail";
                                }
                            }else{
                                $error = "img-link-format-not-valid";
                            }
                            
                            //Verifico che non ci sono errori e inserisco il contenuto nel database
                            if( $error == null ){
                                $content_inserted_id['img'] = insertContent($conn, array( "position" => $uploaded_content_path, "type" => "immagine" ) );
                                if( $content_inserted_id['img'] ){
                                    //Se l'inserimento del contenuto è andato a buon fine inserisco il legame tra l'articolo e il contenuto nel DB tramite insertContentArticleInclusion()
                                    if( !insertContentArticleInclusion( $conn, array( "article_id" => $newArticleID, "content" => $content_inserted_id['img'] ) ) ){
                                        $error = "img-not-included";
                                    }
                                }else{
                                    $error = "img-not-included";
                                }
                            }
                            
                        }

                        //Controllo se sono stati settati dei tag
                        if (isset($_POST['articleTags'])){
                            //Salvo in tags la conversione ad array del JSON contenuto in $_POST['articleTags'] creato da tagify
                            $tags = json_decode( $_POST['articleTags'], true);
                            //Controllo che siano stati effettivamente inseriti dei tag nel campo di testo
                            if( !empty( $tags ) ){
                                foreach ($tags as $tag){
                                    //Mi assicuro che il tag sia tutto in minuscolo
                                    $tag['value'] = strtolower($tag['value']);
                                    //Verifico che il tag esista
                                    if( $existing_tag = articleTagExists($conn, $tag['value']) ){
                                        increaseTagNumBlog($conn, $existing_tag['codiceTag']);
                                        addArticleTag($conn, $newArticleID, $existing_tag['codiceTag']);
                                    }
                                    //Se il tag non esiste lo creo
                                    else{
                                        if($newTag = createTag($conn, $tag['value'])){
                                            increaseTagNumBlog($conn, $newTag);
                                            addArticleTag($conn, $newArticleID, $newTag);
                                        }
                                    }
                                }
                            }
                        }

                        //Nel caso in cui l'articolo è stato inserito correttamente faccio il redirect al nuovo articolo e riporto un parametro che indichi che l'articolo è stato inserito correttamente
                        header("location:/progetto-sito/article.php?articleid=" . $newArticleID . "&articleinsert=success");
                        die();
                    }else{
                        //Rimando alla pagina di creazione dell'articolo con l'errore specificato
                        header("location:/progetto-sito/create-article.php?articleinsert=notinserted");
                        die();
                    }
                }else{
                    header("location:/progetto-sito/create-article.php?articleinsert=blognotvalid");
                    die();
                }
            }else{
                header("location:/progetto-sito/create-article.php?articleinsert=blognotvalid");
                die();
            }
        }else{
            header("location:/progetto-sito/create-article.php?articleinsert=blognotvalid");
            die();
        }

    }else{
        die();
    }