<?php 
//avvio della sessione
session_start();
//inclusione del file di configurazione
include("config.php");

/*-- Fase di controllo accesso --*/

    //Verifico che l'utente sia loggato, in caso non lo sia lo rimando alla home page
    if( getCurrentUserID() == false ){
        header("location:/progetto-sito/homepage.php");
        die();
    }

    //Verifico che l'utente abbia collaborazioni o blog in caso non ce le abbia lo rimando alla home
    if( empty( getUserCollabs( $conn, getCurrentUserID() ) ) && empty( getUserBlogs( $conn, getCurrentUserID() ) ) ){
        header("location:/progetto-sito/homepage.php");
    }

/*-- Fine fase di controllo accesso --*/

includiComponente("header", array( 
    "titolo" => "Crea un articolo",
    "css_list" => array(
        "/progetto-sito/assets/css/summernote.css",
        "/progetto-sito/assets/css/tagify.css"
    )
));

/*-- Fase di estrazione dati --*/
    //Estratto i blog con cui l'utente collabora o di cui è proprietario
    $blogs = array_merge( getUserBlogs( $conn, getCurrentUserID() ), getUserCollabs( $conn, getCurrentUserID() ) );
/*-- Fine fase di estrazione dati --*/

/*-- Fase di presentazione dati --*/
    includiComponente("add-article-section", array(
        "blog_list" => $blogs
    ) );
/*-- FIne fase di presentazione dati --*/

includiComponente("footer", array( 
    "script_list" => array( 
        "/progetto-sito/assets/js/summernote.js",
        "/progetto-sito/assets/js/tagify.js"
    ) 
));