<?php 
    session_start();

    include("../../config.php");

    //Controllo che sia stata impostato il field "action" e se l'utente corrente ha effettuato il login
    if( isset( $_POST['action'] ) && $_POST['action'] == "add-post" && getCurrentUserID() !== false ){
        
        $validated = true;
        $validation_error = "";
        $blog = null;
        $upload_dir = "../../uploads/";

        //Uso params a fine di non accedere direttamente agli indici dell'array $_POST e facilitare le verifiche
        $params = array(
            "title" => $_POST['postTitle'],
            "text" => $_POST['postText'],
            "blog_id" => $_POST['blogId'],
            "post_type" => $_POST['postType'],
        );

        //Controllo se i campi passati dal form sono vuoti
        foreach( $params as $param ){
            if( empty( $param ) ){
                $validated = false;
            }
        }

        //Controllo che il blog in cui si vuole inserire il post esista davvero
        if( !is_numeric( $params['blog_id'] ) ){
            $validated = false;
        }

        //Contorllo che il blog esista
        $blog = getBlog( $conn, $params['blog_id'] );
        if( !$blog ){
            $validated = false;
        }

        //Controllo che la validazione dei campi è andata a buon fine
        if( $validated ){
            //Preparo il nuovo post all'interno di un array $new_post
            $new_post = array(
                "title" => $params['title'],
                "text" => $params['text'],
                "author_id" => getCurrentUserID(), 
                "blog_id" => $params['blog_id'],
                "post_type" => $params['post_type'],
                "date" => date("Y-m-d H:i:s")
            );

            $error = null;
            //Percorso della cartella che conterrà i file caricati
            $uploaded_content_path = "uploads/";
            $content_inserted_id = null;

            //Qui indico i formati consentiti per i vari tipi di file (audio, video e immagine)
            $allowed_formats = array(
                "img" => array( "png", "jpg", "jpeg", "tiff", "gif"),
                "video" => array( "mp4"),
                "audio" => array( "mp3", "wma"),
            );

            //Controllo che non si tratti di un post di tipo testo (Non ha senso gestire file e simili in quel caso)
            if( $params['post_type'] !== "testo" ){
                switch( $params['post_type'] ){
                    case "immagine":
                        //Array che conterrà gli id dei contenuti che inserisco nel DB
                        $content_inserted_id = array(
                            "imgs" => array(),
                        );
                        //Array che contiene i percorsi delle immagini caricate
                        $uploaded_imgs_path = array();

                        //Acquisisco tutte le immagini e le inserisco dentro $files
                        $files = array_filter($_FILES['images']['name']); 
                        //Conto quante immagini sono state caricate
                        $total_count = count($_FILES['images']['name']);
                        //Scorro tutte le immagini che sono state caricate
                        for( $i=0 ; $i < $total_count ; $i++ ) {
                            //Salvo il percorso temporaneo dell'immagine
                            $tmpFilePath = $_FILES['images']['tmp_name'][$i];
                            //Verifico che all'interno del percorso temporaneo dell'immagine ci sia qualcosa
                            // (es. se l'upload è fallito per qualche motivo $tmpFilePath sarà vuoto
                            if ($tmpFilePath != ""){
                                //Estraggo i dettagli riguardo al file caricato
                                $file_details = pathinfo($_FILES['images']['name'][$i]);
                                //Controllo che l'estensione del file sia consentita
                                if( in_array( $file_details['extension'], $allowed_formats['img'] ) ){
                                    $file_name = generateRandomString(4) . date('His') . "." . $file_details['extension'];
                                    $uploadfile = $upload_dir . $file_name;

                                    //Carico il file all'interno della cartella /uploads
                                    if(move_uploaded_file($tmpFilePath, $uploadfile)) {
                                        $uploaded_imgs_path[] = $uploaded_content_path . $file_name;
                                    }else{
                                        $error = "images-multi-up-error";
                                        break;
                                    }
                                }else{
                                    $error = "image-multi-format-not-valid";
                                }
                            }else{
                                $error = "images-upload-error";
                                break;
                            }
                        }

                        //Se non ci sono stati errori durante il salvataggio proseguo a inserire i file caricati nella tabella "contenuto"
                        if( $error == null ){
                            //Per ogni immagine caricata vado a inserire nel database un record all'interno della tabella
                            //contenuto
                            foreach( $uploaded_imgs_path as $path ){
                                $content_id = insertContent( $conn, array( "position" => $path, "type" => "immagine" ) );
                                //Se l'inserimento è andato a buon fine inserisco l'id del contenuto appena inserito all'interno
                                //dell'array $content_inserted_id['imgs']
                                if( $content_id !== false ){
                                    $content_inserted_id['imgs'][] = $content_id;
                                }else{
                                    $error = "img-content-db-not-inserted";
                                    break;
                                }
                            }
                        }

                    break;
                    case "video":

                        //Acquisisco in $file_details i dettagli sul file che è stato caricato
                        $file_details = pathinfo($_FILES['video']['name']);

                        //Controllo se l'estensione del file caricato sia effettivamente consentita
                        if( in_array( $file_details['extension'], $allowed_formats['video'] ) ){
                            //Genero un nome random per il file che sta per essere caricato
                            $file_name = generateRandomString(4) . date('His') . "." . $file_details['extension'];
                            //Specifico quale sarà la destinazione del file (/uploads/nomefilerandom)
                            $uploadfile = $upload_dir . $file_name;
                            //Salvo il file all'interno della cartella /uploads
                            if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadfile)) {
                                $uploaded_content_path .= $file_name;
                            } else {
                                $error = "uploadfail";
                            }

                            //Se non ci sono stati errori durante il salvataggio proseguo a inserire il file caricato nella tabella "contenuto"
                            if( $error == null ){
                                $content_inserted_id = insertContent($conn, array( "position" => $uploaded_content_path, "type" => "video" ) );
                                if( !$content_inserted_id ){
                                    $error = "contenterror";
                                }
                            }
                        }else{
                            $error = "audio-format-error";
                        }

                    break;
                    case "audio":
                        
                        //Acquisisco in $file_details i dettagli sul file che è stato caricato
                        $file_details = pathinfo($_FILES['audio']['name']);

                         //Controllo se l'estensione del file caricato sia effettivamente consentita
                        if( in_array( $file_details['extension'], $allowed_formats['audio'] ) ){
                            //Genero un nome random per il file che sta per essere caricato
                            $file_name = generateRandomString(4) . date('His') . "." . $file_details['extension'];
                            //Specifico quale sarà la destinazione del file (/uploads/nomefilerandom)
                            $uploadfile = $upload_dir . $file_name;
                            //Salvo il file all'interno della cartella /uploads
                            if (move_uploaded_file($_FILES['audio']['tmp_name'], $uploadfile)) {
                                $uploaded_content_path .= $file_name;
                            } else {
                                $error = "uploadfail";
                            }

                            //Se non ci sono stati errori durante il salvataggio proseguo a inserire il file caricato nella tabella "contenuto"
                            if( $error == null ){
                                $content_inserted_id = insertContent($conn, array( "position" => $uploaded_content_path, "type" => "audio" ) );
                                if( !$content_inserted_id ){
                                    $error = "contenterror";
                                }
                            }
                        }else{
                            $error = "audio-format-error";
                        }

                    break;
                    case "link":

                        //Acquisisco in $file_details i dettagli sul file che è stato caricato
                        $file_details = pathinfo($_FILES['image']['name']);
                        $content_inserted_id = array(
                            "img" => null,
                            "link" => null,
                        );
                        
                        //Controllo se l'estensione del file caricato sia effettivamente consentita
                        if( in_array( $file_details['extension'], $allowed_formats['img'] ) ){
                            //Genero un nome random per il file che sta per essere caricato
                            $file_name = generateRandomString(4) . date('His') . "." . $file_details['extension'];
                            //Specifico quale sarà la destinazione del file (/uploads/nomefilerandom)
                            $uploadfile = $upload_dir . $file_name;
                            //Salvo il file all'interno della cartella /uploads
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                                $uploaded_content_path .= $file_name;
                            } else {
                                $error = "uploadfail";
                            }
                        }else{
                            $error = "img-link-format-not-valid";
                        }
                        
                        //Se non ci sono stati errori durante il salvataggio proseguo a inserire il file caricato nella tabella "contenuto"
                        if( $error == null ){
                            $content_inserted_id['img'] = insertContent($conn, array( "position" => $uploaded_content_path, "type" => "immagine" ) );
                            if( !$content_inserted_id['img'] ){
                                $error = "img-link-contenterror";
                            }
                        }

                        //Prendo il link e lo inserisco nel database
                        if( $error == null ){
                            $content_inserted_id['link'] = insertContent( $conn, array( "position" => $_POST['link'], "type" => "link" ) );
                            if( !$content_inserted_id['link'] ){
                                $error = "link-content-error";
                            }
                        }
                        
                    break;
                }
            }

            //Se l'inclusione dei contenuti che verranno adesso agganciati al post è andata a buon fine proseguo con la creazione del post
            if( $error == null ){
                //Inserisco il nuovo post
                $createdPost = createPost( $conn, $new_post );

                //Controllo che l'inserimento del post sia andato a buon fine
                if( $createdPost !== false ){

                    //Incremento il numero di post del blog di cui fa parte
                    increaseBlogNumPosts( $conn, $params['blog_id'] );

                    //Controllo la tipologia di post e in base a questo inserisco il collegamento tra contenuto e post
                    if( $params['post_type'] !== "testo" ){
                        switch( $params['post_type'] ){
                            //Nel caso del link inserisco il contenuto relativo al link e quello relativo all'immagine
                            case "link":
                                if( insertContentPostInclusion( $conn, array( "post" => $createdPost, "content" => $content_inserted_id['link'] ) ) === false ){
                                    $error = "link-contentnotincluded";
                                }
                                if( insertContentPostInclusion( $conn, array( "post" => $createdPost, "content" => $content_inserted_id['img'] ) ) === false ){
                                    $error = "link-img-contentnotincluded";
                                }
                            break;
                            //Nel caso dell'immagine inserisco il contenuto relativo alle immagini che sono state inserite
                            case "immagine":
                                foreach( $content_inserted_id['imgs'] as $img ){
                                    if( insertContentPostInclusion( $conn, array( "post" => $createdPost, "content" => $img ) ) === false ){
                                        $error = "img-multi-contentnotincluded";
                                        break;
                                    }
                                }
                            break;
                            //Nel caso in cui il contenuto non è ne link ne immagine procedo a inserire un solo id all'interno della tabella inclusionecontenutopost
                            default:
                                if( insertContentPostInclusion( $conn, array( "post" => $createdPost, "content" => $content_inserted_id ) ) === false ){
                                    $error = "contentnotincluded";
                                }
                            break;
                        }
                    }

                    //Se non ci sono errori durante l'operazione di creazione post e inclusione contenuto allora faccio il redirect alla pagina feed oppure blog
                    //a seconda dell'origine della richiesta
                    if( $error == null ){
                        //Verifico se la richiesta di creazione del post viene dal feed o da un blog, se viene da un blog redireziono alla pagina blog altrimenti al feed
                        if( isset( $_POST['redirectToBlog'] ) ){
                            header("location:/progetto-sito/blog.php?blogCode=" . $_POST['blogId'] . "&postinsert=success");
                            die();
                        }else{
                            header("location:/progetto-sito/feed.php?postinsert=success");
                            die();
                        }
                    }

                }else{
                    //Verifico se la richiesta di creazione del post viene dal feed o da un blog, se viene da un blog redireziono alla pagina blog altrimenti al feed
                    if( isset( $_POST['redirectToBlog'] ) ){
                        header("location:/progetto-sito/blog.php?blogCode=" . $_POST['blogId'] . "&postinsert=error1");
                        die();
                    }else{
                        header("location:/progetto-sito/feed.php?postinsert=error1");
                        die();
                    }
                }
            }else{
                //Verifico se la richiesta di creazione del post viene dal feed o da un blog, se viene da un blog redireziono alla pagina blog altrimenti al feed
                if( isset( $_POST['redirectToBlog'] ) ){
                    header("location:/progetto-sito/blog.php?blogCode=" . $_POST['blogId'] . "&postinsert=" . $error);
                    die();
                }else{
                    header("location:/progetto-sito/feed.php?postinsert=" . $error);
                    die();
                }
            }

        }else{
            //Verifico se la richiesta di creazione del post viene dal feed o da un blog, se viene da un blog redireziono alla pagina blog altrimenti al feed
            if( isset( $_POST['redirectToBlog'] ) ){
                header("location:/progetto-sito/blog.php?blogCode=" . $_POST['blogId'] . "&postinsert=error2");
                die();
            }else{
                header("location:/progetto-sito/feed.php?postinsert=error2");
                die();
            }
        }

    }else{
        //Verifico se la richiesta di creazione del post viene dal feed o da un blog, se viene da un blog redireziono alla pagina blog altrimenti al feed
        if( isset( $_POST['redirectToBlog'] ) ){
            header("location:/progetto-sito/blog.php?blogCode=" . $_POST['blogId']);
            die();
        }else{
            header("location:/progetto-sito/feed.php");
            die();
        }
    }