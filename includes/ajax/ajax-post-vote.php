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

    //Controllo che article_id non sia vuoto
    if( !empty( $_POST['vote'] ) && !empty( $_POST['post_id'] ) && getCurrentUserID() !== false  ){ 
        
        //Controllo che il valore della votazione sia numerico
        if( !is_numeric( $_POST['vote'] ) || !is_numeric( $_POST['post_id'] ) ){
            $validated = false;
            $validation_result['notice'] = "Errore nel formato dei dati";
        }

        //Controllo che il voto del post sia minore o uguale di 5
        if( $_POST['vote'] > 5  && $_POST['vote'] < 1){
            $validated = false;
            $validation_result['notice'] = "Valore voto non valido";
        }

        //Se le verifiche precedenti sono andate a buon fine procedo a inserire il voto al post
        if( $validated == true ){
            $update_result = votePost($conn, array( "author_id" => getCurrentUserID(), "post_id" => $_POST['post_id'], "date" => date('Y-m-d H:i:s'), "vote" => $_POST['vote'] ) );
            //Se il voto è stato inserito con successo comunico al javascript l'esito positivo
            if( $update_result ){
                $validation_result['code'] = 200;
                $validation_result["notice"] = "Voto inserito";
                //Nell'indice data di $validation_result inserisco i dati che ho bisogno di comunicare in risposta al javascript
                $validation_result['data'] = array(
                    "voteavg" => getPostVoteAverage($conn, $_POST['post_id']),
                );
                echo json_encode( $validation_result );
                die();
            }else{
                $validation_result['code'] = 500;
                $validation_result['notice'] = "Voto non inserito";
                echo json_encode( $validation_result );
                die();
            }
        }else{
            $validation_result['code'] = 500;
            echo json_encode( $validation_result );
        }

    }else{

        $validation_result["code"] = 500;
        $validation_result["notice"] = "Qualcosa è andato storto";
        echo json_encode( $validation_result );
        die();

    }

