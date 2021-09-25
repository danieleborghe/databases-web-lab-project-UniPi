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

    //Controllo che l'utente sia loggato e possa effettuare l'azione
    if( !getCurrentUserID() ){
        $validation_result['code'] = 500;
        $validation_result['notice'] = "Operazione non consentita";
        echo json_encode($validation_result);
        die();
    }

    //Controllo che article_id non sia vuoto
    if( !empty( $_POST['article_id'] ) && !empty( $_POST['comment'] ) ){ 

        //Controllo che l'article_id in $_POST è numerico e che il testo del commento da postare non sia vuoto
        if( !is_numeric( $_POST['article_id'] ) || empty( $_POST['comment'] ) ){
            $validated = false;
            $validation_result["notice"] = "Errore generico";
        }
        
        //Preparo l'array che contiene il nuovo commento
        $comment = array(
            "author_id" => getCurrentUserID(),
            "article_id" => $_POST['article_id'],
            "text" => $_POST['comment'],
            "date" => date('Y-m-d H:i:s'),
        );

        //Inserisco il commento
        if( $new_comment = insertArticleComment( $conn, $comment ) ){
            //Incremento il numero di commenti all'articolo in oggetto
            increaseArticleNumComments( $conn, $_POST['article_id'] );
            $validated = true;
            //Preparo la risposta da dare al javascript, nello specifico inserisco data di pubblicazione e id del nuovo commento
            $validation_result['data'] = array( "date" => $comment['date'], "comment_id" => $new_comment );
        }

        //Controllo che l'operazione sia andata a buon fine
        if( $validated == true ){
            $validation_result["notice"] = "Commento inserito correttamente";
            echo json_encode( $validation_result );
            die();
        }else{
            $validation_result['code'] = 500;
            echo json_encode( $validation_result );
            die();
        }

    }else{
        $validation_result["code"] = 500;
        $validation_result["notice"] = "Qualcosa è andato storto";
        echo json_encode( $validation_result );
        die();
    }

