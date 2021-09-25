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

    //Controllo che article_id non sia vuoto, altrimenti l'utente non è loggato
    if( getCurrentUserID() !== false  && !empty( $_POST['post_id'] ) && !empty( $_POST['comment'] ) ){ 

        //Verifico che $_POST['post_id'] sia un dato del formato che mi aspetto (cioè intero)
        if( !is_numeric( $_POST['post_id']) ){
            $validated = false;
            $validation_result["code"] = 500;
            $validation_result["notice"] = "Errore generico";
        }

        $nComments = todayPostComments($conn, getCurrentUserID(), $_POST['post_id']);

        //verifico che l'utente non abbia già effettuato 10 commenti su quel post
        if ($nComments["nComments"] >= 10){
            $validated = false;
            $validation_result["code"] = 500;
            $validation_result["notice"] = "Limite di commenti raggiunto";
        }

        //Se i controlli precedenti sono andati a buon fine proseguo con l'inserimento del commento
        if( $validated == true ){

            //Preparo un array contenente i dati del nuovo commento
            $comment = array(
                "post" => $_POST['post_id'],
                "author" => getCurrentUserID(),
                "text" => $_POST['comment'],
                "date" => date('Y-m-d H:i:s')
            );
            
            //Inserisco il commento
            $comment_id = insertCommentPost( $conn, $comment);

            //Controllo se l'inserimento è andato a buon fine e in tal caso mando l'array $validation_result al javascript 
            //Inserendo dentro l'id del nuovo commento inserito e la sua data di pubblicazione
            if( $comment_id !== false ){
                increasePostNumComments( $conn, $_POST['post_id'] );
                $validation_result["notice"] = "Commento inserito correttamente";
                $validation_result['data'] = array(
                    "comment_id" => $comment_id,
                    "date" => $comment['date'],
                );
                echo json_encode( $validation_result );
                die();
            }
            //Se invece l'inserimento non è andato a buon fine segnalo l'errore con il $validation_result['code'] impostato a 500
            else{
                $validation_result['code'] = 500;
                $validation_result["notice"] = "Commento non inserito";
                echo json_encode( $validation_result );
                die();
            }   
        } else {
            echo json_encode( $validation_result );
            die();
        }

    }else{

        $validation_result["code"] = 500;
        $validation_result["notice"] = "Qualcosa è andato storto";
        echo json_encode( $validation_result );
        die();

    }

