<?php 
//avvio la sessione
session_start();
//inclusione del file di configurazione
include("config.php");

//inclusione dell'header
includiComponente("header", array(
    "titolo" => "Risultati di ricerca") 
);

includiComponente("search-section", array(
    "h1" => "Benvenuto!",
    "h2" => "Cerca tra i migliori articoli, post e blog")
);

//verifico che sia stato premuto il pulsante di ricerca
if (isset($_POST["mainSearchBtn"])){
    //verifico che l'input non sia vuoto
    if (isset($_POST["mainSearchInput"])){
        //estraggo il termine di ricerca
        $searchInput = $_POST["mainSearchInput"];

        //estraggo gli articoli risultato della ricerca
        $articleSearchResults = articleResearch($conn, $searchInput);

        //estraggo i post risultato della ricerca
        $postSearchResults = postResearch($conn, $searchInput);

        //estraggo i blog risultato della ricerca
        $blogSearchResults = blogResearch($conn, $searchInput);
        
    }

}

//verifico che sia stato premuto il pulsante di ricerca
if (isset($_POST["headerSearchBtn"])){
    //verifico che l'input non sia vuoto
    if (isset($_POST["headerSearchInput"])){
        //estraggo il termine di ricerca
        $searchInput = $_POST["headerSearchInput"];

        //estraggo gli articoli risultato della ricerca
        $articleSearchResults = articleResearch($conn, $searchInput);

        //estraggo i post risultato della ricerca
        $postSearchResults = postResearch($conn, $searchInput);

        //estraggo i blog risultato della ricerca
        $blogSearchResults = blogResearch($conn, $searchInput);
        
    }

}


//inclusione dei risultati di ricerca tra gli articoli
includiComponente("article-home-section", array(
    "titolo" => "Risultati di ricerca per gli articoli",
    "articoli" => $articleSearchResults,
    "tema" => "bgColorBlack",
    "textColor" => "text-white")
);

//inclusione dei risultati di ricerca tra i post
includiComponente("post-section", array(
    "titolo" => "Risultati di ricerca per i post",
    "post" => $postSearchResults)
);

//inclusione dei risultati di ricerca tra i blog
includiComponente("blog-listing-home-section", array(
    "titolo" => "Risultati di ricerca per i blog",
    "blog" => $blogSearchResults,
    "tema" => "bgColorBlack",
    "textColor" => "text-white")
);

//inclusione del footer
includiComponente("footer");