<?php
//avvio la sessione
session_start();

include("../../config.php");

if (isset($_SESSION['blogCode'])) {
    //estraggo il codice del blog dalla sessione
    $blogCode = $_SESSION['blogCode'];

    //estraggo le informazioni del blog dal DB
    $blogInfo = getBlog($conn, $blogCode);
    
    if (isset($_SESSION['userCode'])){
        //estraggo il codice dell'utente loggato
        $userCode = $_SESSION['userCode'];

        //estraggo lo stato del follow rispetto al blog
        $blogFollowState = checkFollow($conn, $userCode, $blogCode);
        //appendo lo stato di follow del blog da parte dell'utente
        $blogInfo['follow'] = $blogFollowState;
    }

    //estraggo il nome del proprietario del blog
    $blogOwner = getBlogOwner($conn, $blogCode);
    //appendo il nome del proprietario del blog alle informazioni del blog
    $blogInfo['nomeAutore'] = $blogOwner;

    //estraggo lo stile grafico del blog
    $blogStyle = getStyle($conn, $blogInfo['graficaBlog']);
    //appendo le informazione dello stile grafico alle informazioni del blog
    $blogInfo['graficaBlog'] = $blogStyle;

    //invio ad AJAX i dati in formato JSON
    echo json_encode($blogInfo);
} else {
    die("IL BLOG CHE STAI CERCANDO NON ESISTE!");
}
?>