<?php 
//avvio la sessione
session_start();

//includo il file di configurazione
include("config.php");

//Se l'utente non è loggato redireziono all'homepage
if( !getCurrentUserID() ){
    header("location:/progetto-sito/signup.php");
}

//includo l'header
includiComponente("header", array( 
    "titolo" => "Crea un blog",
    "script" => "assets/js/blog-creation.js"));
?>

<div class="d-flex">
    <?php
    //includo la sidebar
    if (isset($_SESSION['userCode'])){
        includiComponente("profile-sidebar", array( "user" => getUser( $conn, $_SESSION['userCode'] ) ) );
    } else {
        includiComponente("profile-sidebar");
    }
    ?>

        <div class="container-fluid p-0 m-0 flex-column create-blog-container">
            <?php
            //verifico l'avvenuto accesso
            if (isset($_SESSION["userCode"])){
                //calcolo il numero di blog dell'utente
                $userBlogs = userBlogCount($conn, $_SESSION["userCode"]);
                //calcolo quanti blog l'utente può ancora creare
                $allowedBlogs = 5 - $userBlogs["nBlog"];

                //verifico che l'utente non abbia già creato 5 blog
                if ($userBlogs["nBlog"] < 5){
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Ricorda, hai il permesso di creare ancora <?php echo $allowedBlogs; ?> blog
                    </div>
                    <?php

                    //includo la sezione di creazione del nuovo blog
                    includiComponente("create-blog-section");
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Hai raggiunto il numero massimo di blog consentiti! Per creare uno nuovo dovrai eliminarne uno
                    </div>
                    <?php
                }
            } else {
                die("DEVI AVER ESEGUITO L'ACCESSO PRIMA DI POTER CREARE UN NUOVO BLOG!");
            }
            ?>
        </div>
</div>

<?php
//includo il footer
includiComponente("footer");
?>