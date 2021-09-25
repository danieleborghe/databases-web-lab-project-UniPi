<?php 
//avvio della sessione
session_start();
//includo il file di configurazione
include("config.php");

includiComponente("header", array( "titolo" => "Guarda i blog" ) );

includiComponente("search-section", array( 
    "h1" => "Visita i blog più popolari", 
    "h2" => "Cerca tra i migliori blog del portale!" ));

$i=0;

/* Fase di estrazione dei dati */
    $themes = getThemesByMaxNumBlog($conn, 10);
    foreach($themes as $theme){
        $blog_theme = getBlogsTheme( $conn, $theme['nomeTema'], 4);
/* Fine fase di estrazione dei dati */

/* Fase di presentazione dei dati */
        if($i%2 == 0){
            includiComponente("blog-listing-section", array( 
                "listaBlog" => $blog_theme,
                "titolo" => $theme['nomeTema'],
                "tema" => "bgColorBlack",
                "textColor" => "text-white",
                "padding" => "7vh 10vw 10vh 10vw;"
            ) );
        } else{
            includiComponente("blog-listing-section", array( 
                "listaBlog" => $blog_theme,
                "titolo" => $theme['nomeTema'],
                "tema" => "bgColorWhite",
                "textColor" => "text-dark",
                "padding" => "7vh 10vw 10vh 10vw;"
            ) );
        }
        $i++;
    }
/* Fine fase di presentazione dei dati */

includiComponente("footer");