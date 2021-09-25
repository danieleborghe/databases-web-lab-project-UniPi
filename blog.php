<?php 

//avvio la sessione
session_start();

//includo il file di configurazione
include("config.php");

//verifico che sia stato specificato un codice blog e la sua effettiva esistenza
if (isset($_GET['blogCode']) && getBlog($conn, $_GET['blogCode']) !== false){
    //estraggo il codice blog dall'URL con il metodo GET
    $blogCode = htmlspecialchars($_GET['blogCode']);

    //imposto un COOKIE per leggere il codice del blog negli includes
    setcookie("blogCode", $blogCode);
    $_COOKIE["blogCode"] = $blogCode;

    //trasferisco il codice utente da GET a SESSION
    $_SESSION['blogCode'] = $blogCode;

} else {
    //visualizzo un messaggio di errore
    header("location:/progetto-sito/blog-listing.php");
    die("IL BLOG CHE STAI CERCANDO DI VISUALIZZARE NON ESISTE");
}

//includo l'header
includiComponente("header", array( 
    "titolo" => "Blog",
    "script" => "assets/js/blog-information.js"));
?>

<?php 

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

?>

<div class="d-flex align-items-start">
    <?php
    //includo la sidebar

    if (isset($_SESSION['userCode'])){
        includiComponente("profile-sidebar", array( "user" => getUser( $conn, $_SESSION['userCode'] ) ) );
    } else {
        includiComponente("profile-sidebar" );
    }
    ?>

    <div class="container-fluid d-flex flex-column p-0">
        <?php

        //Estraggo i blog seguiti dall'utente attualmente loggato
        $userBlogs = getFollowedBlog($conn, getCurrentUserID());
        //Estraggo i blog creati dall'utente
        $userPersonalBlogs = getUserBlogs( $conn, getCurrentUserID() );
        //Estraggo i blog con cui l'utente collabora
        $userBlogCollabs = getUserCollabs( $conn, getCurrentUserID() );
        //Estraggo il feed dell'utente
        $post = getBlogPosts($conn, $_GET['blogCode'], getCurrentUserID());
        //estraggo il numero di post pubblicati sul blog durante la giornata
        $todayPosts = checkTodayPosts($conn, $blogCode);

        
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
                    }
                    else{
                        $post[$key]['comments'][$key2]['can_delete'] = false;
                    }
                }
            }

            $nComments = todayPostComments($conn, getCurrentUserID(), $single_post['codicePost']);
            //controllo che non sia stato raggiunto il limite di commenti per il post da parte dell'utente loggato
            if ($nComments["nComments"] >= 10){
                $post[$key]['comments_limit'] = true;
            } else {
                $post[$key]['comments_limit'] = false; 
            }
        }

        //Controllo se l'utente attualmente loggato è proprietario del blog
        $hide_post_creation = false;
        if( checkBlogOwner( $conn, getCurrentUserID(), $blogCode ) == false ){
            $hide_post_creation = true;
        }       

        if( $hide_post_creation == true ){
            if( checkCollaboration($conn, $blogCode, getCurrentUserID() ) == false ){
                $hide_post_creation = true;
            }
        }

        //includo la sezione di visualizzazione del blog
        includiComponente("blog-section", array(
            "posts_settings" => array(
                "create_post_mode" => "blog",
                "blogId" => $blogCode,
                "hide_post_creation" => $hide_post_creation,
                "hidden_sidebar" => true,
                "post_insert_result" => $postInsertResult,
                "current_user" => getUser( $conn, getCurrentUserID() ),
                "blog_utente" => $userPersonalBlogs,
                "blog_collabs" => $userBlogCollabs,
                "blog_seguiti" => $userBlogs,   
                "posts" => $post,
                "username" => getCurrentUserName(),
                "todayPosts" => $todayPosts["nPosts"],
            )
        ));

        //verifico l'avvenuto accesso e l'appartenenza del blog all'utente [PRIMO CONTROLLO]
        if (isset($_SESSION["userCode"]) && checkBlogOwner($conn, $_SESSION['userCode'], $blogCode)){
            //se il blog visualizzato è il mio includo la sezione di modifica
            includiComponente("edit-blog-section");
        }
        ?>
    </div>
</div>
<?php
//includo il footer

includiComponente("footer", array(
    "script_list" => array(
        "/progetto-sito/assets/js/create-post.js",
        "/progetto-sito/assets/js/post.js"
    )
));
?>
