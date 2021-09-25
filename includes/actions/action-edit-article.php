<?php 

    session_start();

    include("../../config.php");

    //Controllo che sia stata impostato il field "action" e se l'utente corrente ha effettuato il login
    if( isset($_POST['action'] ) && $_POST['action'] == "editArticle" && getCurrentUserID() !== false ){

        //Preparo la variabile che conterra il blog estratto dal database così posso verificare che il blog passato dal form esista davvero
        $blog = null;

        //Controllo che il titolo dell'articolo non sia vuoto, nel caso lo sia faccio redirect alla pagina edit article inserento un parametro get di errore
        if( empty( $_POST['articleTitle'] ) ){
            header("location:/progetto-sito/edit-article.php?articleinsert=titleempty");
            die();
        }
        
        //Controllo che il contenuto dell'articolo non sia vuoto, nel caso lo sia faccio redirect alla pagina edit article inserendo un parametro get di errore
        if( empty( $_POST['articleContent'] ) ){
            header("location:/progetto-sito/edit-article.php?articleinsert=contentempty");
            die();
        }

        //Controllo che il parametro $_POST['articleID'] sia corretto
        if( empty( $_POST['articleID'] ) || !is_numeric($_POST['articleID']) ){
            header("location:/progetto-sito/edit-article.php?articleinsert=notinserted");
            die();
        }   

        //Controllo che l'articolo da modificare esista davvero, in caso negativo faccio il redirect con errore a edit-article.php
        if( $article_to_edit = getArticleByID( $conn, $_POST['articleID'] ) ){
            
            //Modifico l'articolo con i nuovi inserimenti
            $edited_article = array(
                "title" => $_POST['articleTitle'],
                "text" => $_POST['articleContent'],
            );

            //Controllo che l'operazione di modifica dell'articolo sia andata a buon fine a questo punto
            //Procedo a modificare l'eventuale immagine in evidenza
            if( editArticle( $conn, $edited_article, $article_to_edit['codiceArticolo'] ) ){

                //Formati consentiti per l'immagine in evidenza
                $allowed_formats = array(
                    "img" => array( "png", "jpg", "jpeg", "tiff", "gif"),
                );
                //Percorso relativo al contenuto "immagine" che verrà inserito nel database
                $uploaded_content_path = "uploads/";
                //Percorso che utilizzerò per salvare il file
                $upload_dir = "../../uploads/";
                //Variabile di stato che indica la presenza o meno di un errore durante la fase di caricamento dell'immagine
                $error = null;
                
                //Controllo se è stata caricata un immagine
                if( !empty( ($_FILES['articleImage']['name'] ) ) ){

                    //Acquisisco in $file_details i dettagli sul file che è stato caricato
                    $file_details = pathinfo($_FILES['articleImage']['name']);
                    $content_inserted_id = array(
                        "img" => null,
                    );
                    
                    //Controllo se l'estensione del file caricato sia effettivamente consentita
                    if( in_array( $file_details['extension'], $allowed_formats['img'] ) ){
                        //Genero un nome random per il file che sta per essere caricato
                        $file_name = generateRandomString(4) . date('His') . "." . $file_details['extension'];
                        //Specifico quale sarà la destinazione del file (/uploads/nomefilerandom)
                        $uploadfile = $upload_dir . $file_name;
                        //Salvo il file all'interno della cartella /uploads
                        if (move_uploaded_file($_FILES['articleImage']['tmp_name'], $uploadfile)) {
                            $uploaded_content_path .= $file_name;
                        } else {
                            $error = "uploadfail";
                        }
                    }else{
                        $error = "img-link-format-not-valid";
                    }
                    
                     //Se non ci sono stati errori durante il salvataggio proseguo a inserire il file caricato nella tabella "contenuto"
                    if( $error == null ){
                        //Verifico che l'articolo abbia già un immagine in evidenza
                        $current_feat_img = getArticleContentIncluded( $conn, $article_to_edit['codiceArticolo'] );
                        if( !empty( $current_feat_img ) ){
                            //Elimino l'eventuale immagine in evidenza dell'articolo
                            if( deleteArticleContent( $conn, $article_to_edit['codiceArticolo'] ) ){
                                //Inserisco la nuova immagine in evidenza dell'articolo
                                $content_inserted_id['img'] = insertContent($conn, array( "position" => $uploaded_content_path, "type" => "immagine" ) );
                                if( $content_inserted_id['img'] ){
                                    //Se l'inserimento del contenuto è andato a buon fine inserisco il legame tra l'articolo e il contenuto nel DB tramite insertContentArticleInclusion()
                                    if( !insertContentArticleInclusion( $conn, array( "article_id" => $article_to_edit['codiceArticolo'], "content" => $content_inserted_id['img'] ) ) ){
                                        $error = "img-not-included";
                                    }
                                }
                            }
                        }

                    }

                }

                //Controllo se sono stati settati dei tag
                if (isset($_POST['articleTags'])){

                    //Salvo in tags la conversione ad array del JSON contenuto in $_POST['articleTags'] creato da tagify
                    $tags = json_decode( $_POST['articleTags'], true);
                    
                    if( !empty( $tags ) ){
                        //Controllo se l'articolo ha già dei tag e in caso quali tag "staccare" dall'articolo 
                        //(es. se modificando l'articolo vengono tolti dei tag questi vanno rimossi)
                        $article_tags =  getArticleTags( $conn, $article_to_edit['codiceArticolo']);
                        if( !empty( $article_tags ) ){
                            foreach( $article_tags as $article_tag ){
                                $found = false;
                                foreach( $tags as $tag ){
                                    if( $existing_tag = articleTagExists( $conn, $tag['value'] ) ){
                                        if( $existing_tag['codiceTag'] == $article_tag['codiceTag'] ){
                                            $found=true;
                                        }
                                    }
                                }    
                                if( !$found ){
                                    deleteArticleTag( $conn, $article_to_edit['codiceArticolo'], $article_tag['codiceTag'] );
                                    decreaseTagNumBlog( $conn, $article_tag['codiceTag'] );
                                }
                            }
                        }
                        //Verifico che ciascun tag non sia già collegato all'articolo (attraverso articleHasTag) in caso non lo sia lo aggiungo
                        foreach( $tags as $tag){
                            //Verifico che il tag esista, nel caso non esista lo creo e aggiungo all'articolo
                            if( $existing_tag = articleTagExists( $conn, $tag['value'] ) ){
                                if( !articleHasTag( $conn, $article_to_edit['codiceArticolo'], $existing_tag['codiceTag'] ) ){
                                    addArticleTag( $conn, $article_to_edit['codiceArticolo'], $existing_tag['codiceTag'] );
                                    increaseTagNumBlog( $conn, $existing_tag['codiceTag'] );
                                }
                            }else{
                                if($newTag = createTag($conn, strtolower( $tag['value'] )) ){
                                    increaseTagNumBlog($conn, $newTag);
                                    addArticleTag($conn,  $article_to_edit['codiceArticolo'], $newTag);
                                }
                            }
                        }
                    }else{
                        //Se i tag non sono stati impostati eliminiamo tutti i tag dell'articolo
                        $article_tags =  getArticleTags( $conn, $article_to_edit['codiceArticolo']);
                        foreach( $article_tags as $tag ){
                            deleteArticleTag( $conn, $article_to_edit['codiceArticolo'], $tag['codiceTag'] );
                            decreaseTagNumBlog( $conn, $tag['codiceTag'] );
                        }
                    }

                }

                if( $error == null ){
                    header("location:/progetto-sito/article.php?articleid=" . $article_to_edit['codiceArticolo'] . "&articleinsert=success");
                    die();
                }else{
                    header("location:/progetto-sito/edit-article.php?articleinsert=notinserted");
                    die();
                }

            }else{          
                header("location:/progetto-sito/edit-article.php?articleinsert=notinserted");
                die();
            }       

        }else{
            header("location:/progetto-sito/edit-article.php?articleinsert=notinserted");
            die();
        }

    }else{
        die();
    }