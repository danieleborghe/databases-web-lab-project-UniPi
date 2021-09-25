<?php 

    session_start();

    include("../../config.php");

    //Controllo che sia stata impostato il field "action" e se l'utente corrente ha effettuato il login
    if( isset($_POST['action'] ) && $_POST['action'] == "deleteArticle" && getCurrentUserID() !== false ){
        //Controllo che il parametro $_POST['articleid'] esista, sia numerico e che effettivamente risulti essere un articolo
        if( isset($_POST['articleId']) && is_numeric($_POST['articleId']) && $article = getArticleByID( $conn, $_POST['articleId']) ){
            //Verifico che l'utente attualmente loggato possa effetivamente eliminare l'articolo
            if(userCanEditArticle($conn, $article, getCurrentUserID())){
                //Decremento il numero di articoli per il blog sotto il quale è stato pubblicato l'articolo da eliminare
                decreaseBlogNumArticles($conn, $article['blog']);
                //Elimino l'articolo
                deleteArticle($conn, $article['codiceArticolo']);
                //Faccio il redirect alla pagina articles.php
                header('location:/progetto-sito/articles.php');
                die();
            }
        }

    }