<?php 
//avvio della sessione
session_start();
//inclusioen del file di configurazione
include("config.php");

/*-- Fase di controllo accesso --*/
    //Verifico che l'utente sia loggato, in caso non lo sia lo mando alla home
    if( getCurrentUserID() == false ){
        header("location:/progetto-sito/homepage.php");
        die();
    }

    //Controlliamo che sia stato settato l'attributo $_GET['articleid'] e in caso contrario facciamo il redirect alla pagina degli articoli
    if( !isset( $_GET['articleid'] ) ){
        header("location:/progetto-sito/articles.php");
        die();
    }else{

        //Controllo che l'attributo articleid sia effettivamente un numero altrimenti rimando alla pagina articles
        if( !is_numeric( $_GET['articleid'] ) ){
            header("location:/progetto-sito/articles.php");
            die();
        }

        //Controllo che l'articolo esista e se non esiste rimando alla pagina articoli
        if( getArticleByID( $conn, $_GET['articleid'] ) == false  ){
            header("location:/progetto-sito/articles.php");
            die();
        }

    }

    //Estraggo dal database l'articolo corrente (specificato attraverso il parametro $_GET['articleid']
    $current_article = getArticleByID( $conn, $_GET['articleid'] );

    //Controllo che l'articolo che si intende modificare possa essere modificato dall'utente attualmente loggato in caso negativo si reindirizza alla pagina articles.php
    if( userCanEditArticle( $conn, $current_article, getCurrentUserID() ) == false ){
        header("location:/progetto-sito/articles.php");
        die();
    }

/*-- Fine fase di controllo accesso --*/

includiComponente("header", array( 
    "titolo" => "Modifica articolo",
    "css_list" => array(
        "/progetto-sito/assets/css/summernote.css",
        "/progetto-sito/assets/css/tagify.css"
    )
));

/*-- Fase di estrazione dei dati --*/

    //Estraggo i tag corrispondenti all'articolo che sto modificando 
    $tags =  getArticleTags( $conn, $current_article['codiceArticolo'] );

    //Estraggo i blog che appartengono all'utente e quelli con cui collabora, e gli unisco tramite la funzione array_merge()
    $blog_list = array_merge( getUserBlogs( $conn, getCurrentUserID() ), getUserCollabs( $conn, getCurrentUserID() ) );

/*-- Fine fase di estrazione dei dati --*/


/*-- Fase di elaborazione dei dati --*/
    //Aggiungo la feat_image a current_article in modo da averla nel partial
    $current_article['feat_image'] = getArticleContentIncluded( $conn, $current_article['codiceArticolo'] );

    //Converto la lista di tag in una stringa separata da virgole
    $stringified_tags = "";
    if( !empty( $tags ) ){
        foreach( $tags as $tag ){
            $stringified_tags .= $tag['chiaveTag'] . ", ";
        }
        $stringified_tags = substr($stringified_tags, 0, -2);
    }
/*-- Fine fase di elaborazione dei dati --*/

/*-- Fase di presentazione dei dati --*/

    includiComponente("edit-article-section", array(
        "article" => $current_article,
        "stringified_tags" => $stringified_tags,
        "tags" => $tags,
        "blog_list" => $blog_list
    ) );

/*-- Fine fase di presentazione dei dati --*/


includiComponente("footer", array( 
    "script_list" => array( 
        "/progetto-sito/assets/js/summernote.js",
        "/progetto-sito/assets/js/tagify.js"
    ) 
));    