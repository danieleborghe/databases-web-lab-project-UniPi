<?php 
//avvio della sessione
session_start();

//inclusione del file di configurazione
include("config.php");

/*-- Fase di controllo accesso --*/
    //Controllo se l'utente è loggato
    if( getCurrentUserID() ){
        header("location:/progetto-sito/profile.php");
        die();
    }
/* Fine fase di controllo accesso --*/

includiComponente("header", array( 
    "titolo" => "Pagina login",
    "script" => "assets/js/login.js")
);

includiComponente("login-form");

includiComponente("footer");