<?php 
//avvio della sessione
session_start();
//inclusione del file di configurazione
include("config.php");

includiComponente("header", array(
    "titolo" => "Home",
    "script" => "assets/js/login.js") );

includiComponente("search-section", array(
    "h1" => "Benvenuto!",
    "h2" => "Cerca tra i migliori articoli, post e blog"));

/*-- Fase di estrazione dei dati --*/

    //Estrazione degli articoli più votati
    $articoli = getBestArticles( $conn, 8 );
    //Estrazione dei post più votati
    $post = getBestPosts( $conn, 6 );
    //Estrazione dei blog più seguiti
    $blog = getMostFollowedBlogs( $conn, 8 );   

/*-- Fine fase di estrazione dei dati --*/

/*-- Fase di presentazione dei dati --*/

    includiComponente("article-home-section", array(
        "titolo" => "Leggi gli articoli più votati!",
        "articoli" => $articoli,
        "tema" => "bgColorBlack",
        "textColor" => "text-white") 
    );

    includiComponente("post-section", array(
        "titolo" => "Scopri i diversi tipi di post!",
        "post" => $post)
    );

    includiComponente("blog-listing-home-section", array(
        "titolo" => "Scegli un blog in base ai tuoi interessi!",
        "blog" => $blog,
        "tema" => "bgColorBlack",
        "textColor" => "text-white") );

/*-- Fine fase di presentazione dei dati --*/

includiComponente("login-form");

includiComponente("footer");