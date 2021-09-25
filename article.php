<?php 

//avvio della sessione
session_start();
//inclusione del file di configurazione
include("config.php");

/*-- Fase di controllo accesso --*/

    //Controlliamo che sia stato settato l'attributo $_GET['articleid']
    //in caso contrario facciamo il redirect alla pagina degli articoli
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

/*-- Fine fase di controllo accesso --*/

/*-- Fase di estrazione dati --*/

    //Estraggo dal database l'articolo corrente (specificato attraverso il parametro $_GET['articleid']
    $current_article = getArticleByID( $conn, $_GET['articleid'] );
    //Estraggo il blog di appartenenza dell'articolo
    $blog =  getBlog( $conn, $current_article['blog'] );
    //Estraggo i commenti relativi all'articolo corrente
    $comments = getCommentsByArticleID( $conn, $current_article['codiceArticolo'] );
    //Estrazione dei tag appartenenti all'articolo
    $tags = getArticleTags( $conn, $current_article['codiceArticolo']);
    //Estraggo l'immagine in evidenza dell'articolo
    $feat_image = getArticleContentIncluded( $conn, $current_article['codiceArticolo'] );
    //Estraggo i dati relativi all'utente corrente
    $current_user = getUser( $conn, getCurrentUserID() );
    //Estraggo i voti all'articolo degli utenti
    $user_votes = getUserArticleVote( $conn, getCurrentUserID(), $current_article['codiceArticolo'] );

/*-- Fine fase di estrazione dati --*/

//Includo l'header settando il titolo della pagina come titolo dell'articolo (attraverso "titolo" => $current_article['titolo'])
includiComponente("header", array( "titolo" => $current_article['titolo'] . " - Articolo" ) );

/*-- Fase di controllo azioni utente --*/
    //Verifico che l'utente che sta visualizzando la pagina dell'articolo possa commentare
    $show_comment_form = false;
    if( getCurrentUserID() !== false ){
        $show_comment_form = true;
    }
/*-- Fase di controllo azione utente --*/

/*-- Fase di elaborazione dati --*/
    
    //Aggiungo il "prefisso" /progetto-sito/ all'immagine del profilo del blog a cui appartiene l'articolo
    //(nel database sono salvate a partire da /uploads per cui ho bisogno di aggiungerci anche /progetto-sito all'inizio)
    $blog['posizioneImgProfilo'] = "/progetto-sito/" . $blog['posizioneImgProfilo'];

    //Controllo se i commenti di un articolo appartengono all'utente attualmente loggato, se sì faccio comparire il tasto elimina
    if(!empty($comments) && $show_comment_form == true){
        foreach( $comments as $key => $comment ){
            if( userCanEditComment($comment, getCurrentUserID()) ){
                $comments[$key]['can_delete'] = true;
            }
            else{
                $comments[$key]['can_delete'] = false;
            }
        }
    }

/*-- Fine fase di elaborazione dati --*/

/*-- Fase di controllo azioni utente --*/

    //Verifico che l'utente possa modificare o eliminare l'articolo
    $user_can_edit = false;
    if( getCurrentUserID() !== false ){
        if( userCanEditArticle( $conn, $current_article, getCurrentUserID() ) == true ){
            $user_can_edit = true;
        }
    }

    //Verifico che l'utente che sta visualizzando la pagina possa votare
    $show_vote_form = false;
    if( getCurrentUserID() !== false ){
        $show_vote_form = true;
    }
/*-- Fase di controllo azione utente --*/

/*-- Fase di presentazione dei dati --*/
    //Includo il componente article-read-section passandogli le informazioni estratte sopra
    includiComponente("article-read-section",array(
        "tags" => $tags,
        "feat_image" => $feat_image,
        "article" => $current_article,
        "blog" => $blog,
        "comments" => $comments,
        "show_edit_bar" => $user_can_edit,
        "current_user" => $current_user,
        "show_vote_form" => $show_vote_form,
        "show_comment_form" => $show_comment_form, 
        "user_votes" => $user_votes
    ) );
/*-- Fine fase di presentazione dei dati --*/

includiComponente("footer", array( "script_list" => array( "/progetto-sito/assets/js/article.js" ) ) );