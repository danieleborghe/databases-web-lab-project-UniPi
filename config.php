<?php 

    /*-- CLIQUE - file di configurazione --*/

    //Dati di connessione al database
    define( "DB_HOST", "localhost" );
    define( "DB_USER", "root" );
    define( "DB_PASSWORD", "" );
    define( "DB_NAME", "progettobasididati_v2b" );

    //Inclusione delle funzioni principali
    include("includes/functions.php");

    //includo il file di connessione al DB
    include_once("includes/db-connection.php");