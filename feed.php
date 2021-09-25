<?php 
//avvio della sessione
session_start();
//inclusione del file di configurazione
include("config.php");

/*-- Fase di controllo accesso --*/
    //Controllo se l'utente è loggato
    if( !getCurrentUserID() ){
        header("location:/progetto-sito/login.php");
        die();
    }
/*-- Fine fase di controllo accesso --*/

includiComponente("header", array( "titolo" => "Feed" ) );

/*-- Fase di controllo esito operazione precedente --*/
    /* 
        Controllo se l'esecuzione di un crea post è andata a buon fine,
        in particolare preparo un array $postInsertResult che passerò al partial "feed-container" che 
        a sua volta farà un controllo per capire se il suo contenuto indica che è avvenuto un errore (quindi il post non è stato creato)
        oppure l'operazione di creazione post è andata a buon fine
    */
    $postInsertResult = array();

    if( isset( $_GET['postinsert'] ) ){
        //Se la $_GET['postinsert'] ha valore "success" riempio l'array $postInsertResult inserendo l'esito del risultato ("result" => "success") e il messaggio da visualizzare ("notice")
        if( $_GET['postinsert'] == "success" ){
            $postInsertResult = array(
                "result" => "success",
                "notice" => "Il post è stato inserito correttamente",
            );
        }else{
            //Se la $_GET['postinsert'] ha valore "error" riempio l'array $postInsertResult inserendo l'esito del risultato ("result" => "error") e il messaggio da visualizzare ("notice")
                $postInsertResult = array(
                "result" => "error",
                "notice" => "C'è stato un errore durante l'inserimento del post, controlla i dati inseriti o riprova più tardi.",
            );
        }
    }
/*-- Fine fase di controllo esito operazione precedente --*/

/*-- Fase di estrazione dati --*/

    //Estraggo i blog seguiti dall'utente attualmente loggato
    $userBlogs = getFollowedBlog($conn, getCurrentUserID());
    //Estraggo i blog creati dall'utente
    $userPersonalBlogs = getUserBlogs( $conn, getCurrentUserID() );
    //Estraggo i blog con cui l'utente collabora
    $userBlogCollabs = getUserCollabs( $conn, getCurrentUserID() );
    //Estraggo il feed dell'utente
    $post = getUserFeed($conn, getCurrentUserID());
    //Estraggo le informazioni relative all'utente corrente
    $current_user = getUser( $conn, getCurrentUserID() );


/*-- Fine fase di estrazione dati --*/

/*-- Fase di elaborazione dati --*/
    
    foreach( $post as $key => $single_post ){
        //Controllo se un post può essere eliminato dall'utente attualmente loggato
        if( userCanEditPost( $conn, $single_post, getCurrentUserID() ) ){
            $post[$key]['can_delete'] = true;
        }else{
            $post[$key]['can_delete'] = false;
        }

        //Controllo se i commenti di un post appartengono all'utente attualmente loggato, se sì faccio comparire il tasto elimina
        if(!empty($single_post['comments'])){
            foreach( $single_post['comments'] as $key2 => $comment ){
                if( userCanEditComment($comment, getCurrentUserID()) ){
                    $post[$key]['comments'][$key2]['can_delete'] = true;
                } else{
                    $post[$key]['comments'][$key2]['can_delete'] = false;
                }
            }
        }

        $nComments = todayPostComments($conn, getCurrentUserID(), $single_post['codicePost']);

        if ($nComments["nComments"] >= 10){
            $post[$key]['comments_limit'] = true;
        } else {
            $post[$key]['comments_limit'] = false; 
        }
    }
/*-- Fine fase di elaborazione dati --*/

/*-- Fase di presentazione dei dati --*/
    //Includo il componente feed-container passandogli tutti i dati estratti sopra
    includiComponente("feed-container", array(
        "create_post_mode" => "feed",
        "post_insert_result" => $postInsertResult,
        "current_user" => $current_user,
        "blog_utente" => $userPersonalBlogs,
        "blog_collabs" => $userBlogCollabs,
        "blog_seguiti" => $userBlogs,   
        "posts" => $post,
        "username" => getCurrentUserName(),
    ) );
/*-- Fine fase di presentazione dei dati --*/

/* 
    Includo il footer passandogli una lista di script, in particolare:
    create-post.js : contiene la logica di visualizzazione dei campi in più a seconda del tipo di post scelto (es. se scelgo immagine vedo campo file immagine ecc..)
    post.js : contiene la logica dei singoli post per quanto riguarda creazione commenti, "opzioni" post, e la votazione dei post
*/
includiComponente("footer", array(
    "script_list" => array(
        "/progetto-sito/assets/js/create-post.js",
        "/progetto-sito/assets/js/post.js"
    )
));