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

    //Controllo che comment_id non sia vuoto e he l'utente sia loggato
    if( getCurrentUserID() !== false  && !empty( $_POST['comment_id'] )){
        //Controllo che il commento esista immagazzinando in $comment l'eventuale commento (ritornerà false nel caso in cui non esiste)
        if( $comment = getArticleCommentByID($conn, $_POST['comment_id'])){
            //Controllo se l'utente loggato in questo momento è l'autore del commento
            if(userCanEditComment($comment, getCurrentUserID())){
                //Controllo che l'eliminazione del commento vada a buon fine in caso positivo mando risposta 200
                if(deleteArticleComment($conn, $comment)){
                    decreaseArticleNumComments( $conn, $comment['articolo'] );
                    $validation_result['code'] = 200;
                    $validation_result['notice'] = "Commento eliminato";
                }else{
                    $validation_result['code'] = 500;
                    $validation_result['notice'] = "Errore generico 1";
                }
            }else{
                $validation_result['code'] = 500;
                $validation_result['notice'] = "Errore, il commento non esiste";
            }
        }else{
            $validation_result['code'] = 500;
            $validation_result['notice'] = "Errore generico 2";
        }
        echo json_encode($validation_result);
        die();
    }