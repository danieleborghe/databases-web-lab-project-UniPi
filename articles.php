<?php 
    //avvio sessione 
    session_start();
    //inclusione del file di configurazione
    include("config.php");

    includiComponente("header", array( "titolo" => "Articoli" ) );

    includiComponente("search-section", array( 
        "h1" => "Esplora i nostri articoli", 
        "h2" => "Seleziona un tema oppure cerca un titolo", ));

    $i = 0;

    /* Fase di estrazione dati */
    //Estraggo i temi ordinati in maniera decrescente in base al numero di blog che usano un determinato tema
    $themes = getThemesByMaxNumBlog($conn, 10);

    //Scorro tutti i temi estratti e per ogni tema tiro fuori gli articoli migliori
    foreach($themes as $theme){
        //Estraggo gli articoli a partire da uno specifico tema
        $article_theme = getBestArticlesByTheme( $conn, $theme['nomeTema'], 4);
    /* Fine fase di estrazione dati */

    /* Fase di presentazione dei dati */
        if($i%2 == 0){
            includiComponente("article-section", array( 
            "articoli" => $article_theme,
            "titolo" => $theme['nomeTema'],
            "tema" => "bgColorBlack",
            "textColor" => "text-white" ) );
        } else{
            includiComponente("article-section", array( 
            "articoli" => $article_theme,
            "titolo" => $theme['nomeTema'],
            "tema" => "bgColorWhite",
            "textColor" => "text-dark" ) );
        }
        $i++;
    }
    /* Fine fase di presentazione dei dati */

    includiComponente("footer");