<?php 

    session_start();

    include("../../config.php");

    $validated = true;
    //Preparo l'array $validation_result che conterrà la risposta da dare al javascript una volta eseguita l'operazione
    //di eliminazione del commento, questa conterrà l'esito dell'operazione (indice "code") e il messaggio relativo all'operazione (es. messaggio di errore)
    //inoltre predispongo un indice che si chiama "data" dove andrò a inserire i dati che ho bisogno di comunicare al javascript quando questo riceve la risposta.
    $validation_result = array(
        "code" => 200,
        "notice" => "",
        "data" => null,
    );

    //Controllo che post_id non sia vuoto
    if( getCurrentUserID() !== false  && !empty( $_POST['post_id'] ) ){ 

        //Controllo che il post id ricevuto dal form sia numerico 
        if( !is_numeric( $_POST['post_id']) ){
            $validated = false;
            $validation_result["code"] = 500;
            $validation_result["notice"] = "Errore generico";
        }

        //Verifico che il post esiste
        if( getPostByID( $conn, $_POST['post_id'] ) == false ){
            $validated = false;
            $validation_result["code"] = 500;
            $validation_result["notice"] = "Errore generico";
        }

        if( $validated == true ){

            $post = getPostByID( $conn, $_POST['post_id'] );
            //Verifico che l'utente loggato possa eliminare il post
            if( userCanEditPost( $conn, getPostByID( $conn, $_POST['post_id'] ), getCurrentUserID() ) ){
                    
                $result = deletePost( $conn, $_POST['post_id'] );

                //Controllo che l'eliminazione del form sia andata a buon fine
                if( $result !== false ){
                    decreaseBlogNumPosts( $conn, $post['blog'] );
                    $validation_result["notice"] = "Post eliminato";
                    echo json_encode( $validation_result );
                    die();
                }else{
                    $validation_result['code'] = 500;
                    $validation_result["notice"] = "Post non eliminato";
                    echo json_encode( $validation_result );
                    die();
                }   
            }else{
                $validation_result["code"] = 500;
                $validation_result["notice"] = "Errore generico";
                echo json_encode( $validation_result );
                die();
            }
        }

    }else{

        $validation_result["code"] = 500;
        $validation_result["notice"] = "Qualcosa è andato storto";
        echo json_encode( $validation_result );
        die();

    }

