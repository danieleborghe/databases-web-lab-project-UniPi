<?php 
//---

//---
//FUNZIONI DI INCLUSIONE DEI COMPONENTI HTML
//---

//Funzione di inclusione componenti HTML
function includiComponente($component, $args = array(), $extension = ".php" ){
    //percorso dei partials
    $partials_path = "partials" . DIRECTORY_SEPARATOR;
    //inclusione
    include( $partials_path . $component . $extension );
}

//---
//TERMINE FUNZIONI DI INCLUSIONE DEI COMPONENTI HTML
//---

//Funzione di generazione di una stringa random di lunghezza a piacere
function generateRandomString($length = 10) {
    //caratteri possibili
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //lunghezza della stringa
    $charactersLength = strlen($characters);
    //variabile stringa
    $randomString = '';
    //ciclo di generazione
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;

}

//---

//---
//FUNZIONI DI CONTROLLO E E VERIFICA DATI
//---

//funzione di verifica dell'esistenza di un utente
function checkUserExistence($conn, $suUsername, $suEmail, $suDocument){
    //definisco la query
    $sql = "SELECT * FROM utente WHERE nomeUtente = ? OR email = ? OR estremiDocumento = ?;";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE checkUserExistence: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query SQL
    mysqli_stmt_bind_param($stmt, "sss", $suUsername, $suEmail, $suDocument);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i dati di risultato
    $resultData = mysqli_stmt_get_result($stmt);
    //chuiudo la statement
    mysqli_stmt_close($stmt);

    //verifico la presenza di risultati
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;

}

//funzione di verifica dell'esistenza di un utente con EXCEPT
function checkUserExistenceExcept($conn, $Username, $Email, $Document, $userCode){
    //definisco la query
    $sql = "SELECT * FROM utente WHERE nomeUtente = ? OR email = ? OR estremiDocumento = ? EXCEPT (SELECT * FROM utente WHERE codiceUtente = ?);";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE checkUserExistenceExcept: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "ssss", $Username, $Email, $Document, $userCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i dati risultato
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //verifico la presenza di risultati
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;
    
}

//funzione di verifica del "follow" di un utente rispetto a un blog
function checkFollow($conn, $userCode, $blogCode){
    //definisco la query sql
    $sql = "SELECT * FROM seguito WHERE utente = ? AND blog = ?;";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE checkFollow: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili della query SQL
    mysqli_stmt_bind_param($stmt, "ss", $userCode, $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i risultati della query
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //verifico che la query abbia estratto dei risultati
    if ($row = mysqli_fetch_assoc($resultData)){  
        return $row;
    }
    return false;

}

//funzione di verifica dell'appartenenza di un blog a un utente
function checkBlogOwner($conn, $userCode, $blogCode){
    //estraggo i blog dell'utente
    $userBlogs = getUserBlogs($conn, $userCode);
    //memorizzo il numero del blog in formato numerico
    $blogCode = $blogCode + 0;

    //scorro i blog dell'utente
    foreach($userBlogs as $blog){
        //verifico se il blog appartiene all'utente
        if ($blogCode == $blog[2]){
            return true;
        }

    }
    return false;
    
}

//funzione provvisoria
/*
function emptyInputBlogEditing($blogTitle, $blogTheme, $blogStyle){
    if (empty($blogTitle) || empty($blogTheme) || empty($blogStyle)) {
        return true;
    }

    return false;
}
*/

//---
//TERMINE DELLE FUNZIONI DI CONTROLLO E VERIFICA DATI
//---

//---

//---
//FUNZIONI DI ESTRAZIONE DATI
//---

//funzione di estrazione delle informazioni di un utente a partire dal codice utente [DUPLICATA!]
/*
function getProfileInfo($conn, $userCode){
    //definisco la query SQL
    $sql = "SELECT * FROM utente WHERE codiceUtente = ?;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getProfileInfo: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $userCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //verifico la presenza di risultati
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;

}*/

//funzione di estrazione di un utente a partire dal codice
function getUser($conn, $userCode){
    //definisco la query sql
    $sql = "SELECT * FROM utente WHERE codiceUtente = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getUserInfo: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query SQL
    mysqli_stmt_bind_param($stmt, "s", $userCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //verifico la presena di risultati
    if ($row = mysqli_fetch_assoc($resultData)){  
        return $row;
    }
    return false;

}

//funzione di estrazioni delle informazioni parziali dei blog di un determinato utente
function getUserBlogs($conn, $userCode){
    //definisco la query SQL
    $sql = "SELECT nomeBlog, posizioneImgProfilo, codiceBlog FROM blog WHERE autore = ?;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getUserBlogs: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $userCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    //creo un array di memorizzazione dei risultati
    $userBlog = array();
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while ($row = mysqli_fetch_assoc($resultData)){
        $tempArray = array($row['nomeBlog'], $row['posizioneImgProfilo'], $row['codiceBlog']);
        array_push($userBlog, $tempArray);
    }
    return $userBlog;
}

//funzione di estrazione dei blog con cui un determinato utente collabora
function getUserCollabs($conn, $userCode){
    //definisco la query SQL
    $sql = "SELECT nomeBlog, posizioneImgProfilo, codiceBlog FROM blog WHERE codiceBlog IN (SELECT blog FROM collaborazione WHERE utente = ? AND dataFine IS NULL);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE extractUserCollabs: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $userCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    $userCollabs = array();

    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while ($row = mysqli_fetch_assoc($resultData)){
        $tempArray = array($row['nomeBlog'], $row['posizioneImgProfilo'], $row['codiceBlog']);
        array_push($userCollabs, $tempArray);
    }
    return $userCollabs;
}
//termine della funzione di estrazione dei blog con cui un determinato utente collabora

//funzione di estrazione delle informazioni di un determinato blog
function getBlog($conn, $blogCode){
    //definisco la query SQL
    $sql = "SELECT * FROM blog WHERE codiceBlog = ?;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE extractBlogInfo: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //verifico la presenza di risultati
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;

}

//funzione di estrazione dei sottotemi trattati da un determinato blog
function getBlogSubthemes($conn, $blogCode){
    //definisco la query SQL
    $sql = "SELECT tema FROM trattazione WHERE blog = ? AND temaPrincipale = 0;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBlogSubthemes: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    $blogSubthemes = array();

    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while ($row = mysqli_fetch_assoc($resultData)){
        array_push($blogSubthemes, $row["tema"]);
    }
    return $blogSubthemes;
}

//funzione di estrazione del tema principale trattato da un determinato blog
function getBlogTheme($conn, $blogCode){
    //definisco la query SQL
    $sql = "SELECT tema FROM trattazione WHERE blog = ? AND temaPrincipale = 1;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBlogTheme: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //verifico la presenza di risultati
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;

}

//funzione di estrazione del nome utente del proprietario di un determinato blog
function getBlogOwner($conn, $blogCode){
    //definisco la query SQL
    $sql = "SELECT nomeUtente FROM utente WHERE codiceUtente IN (SELECT autore FROM blog WHERE codiceUtente = autore AND codiceBlog = ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBlogOwner: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //verifico la presenza di risultati
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row['nomeUtente'];
    }
    return false;

}

//funzione di estrazione degli stili grafici applicabili a un blog
function getStyles($conn){
    //definisco la query SQL
    $sql = "SELECT * FROM grafica;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getStyles: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    $grafiche = array();

    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while ($row = mysqli_fetch_assoc($resultData)){
        array_push($grafiche, $row);
    }
    return $grafiche;
}

//funzione di estrazione delle caratteristiche grafiche di un determinato stile
function getStyle($conn, $styleCode){
    //definisco la query SQL
    $sql = "SELECT * FROM grafica WHERE codiceGrafica = ?;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getStyle: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $styleCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //verifico la presenza di risultati
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;
}

//funzione di estrazione dei post di un determinato blog
/*
function getBlogPosts($conn, $blogCode){
    //definisco la query SQL
    $sql = "SELECT * FROM post WHERE blog = ?;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBlogPosts: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    //creo un array di memorizzazione dei risultati
    $blogPosts = array();
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while ($row = mysqli_fetch_assoc($resultData)){
        array_push($blogPosts, $row);
    }
    return $blogPosts;
}
*/

//funzione di estrazione degli utenti collaboratori di un determinato blog
function getBlogCollabs($conn, $blogCode){
    //definisco la query SQL
    $sql = "SELECT c.*, u.nomeUtente FROM collaborazione c INNER JOIN utente u ON c.utente = u.codiceUtente WHERE c.blog = ? AND c.dataFine IS NULL";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBlogCollabs: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    //creo un array di memorizzazione dei risultati
    $blogCollabs = array();
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while ($row = mysqli_fetch_assoc($resultData)){
        array_push($blogCollabs, $row);
    }
    return $blogCollabs;
}

//funzione di estrazione degli articoli con media voti più alta
function getBestArticles($conn, $num_record){
    //definnizione della query SQL
    $sql = "SELECT * FROM articolo ORDER BY mediaVoti DESC LIMIT " . $num_record;
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBestArticles: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estrazione dei risultati
    $resultData = mysqli_stmt_get_result($stmt);
    //creo un array di memorizzazione dei risultati
    $risultatoQuery = array();
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        //associo l'url
        $row['url'] = "/progetto-sito/article.php?articleid=" . $row['codiceArticolo'];
        //associo l'immagine principale
        $row['feat_img'] = getArticleContentIncluded( $conn, $row['codiceArticolo'] );
        $row['feat_img'] = "/progetto-sito/" . $row['feat_img']['posizioneContenuto'];
        // inserisci nella prossima posizione libera dell'array
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;
}

//Funzione di estrazione degli articoli con media voti voti più alta per tema
function getBestArticlesByTheme($conn, $tema, $num_record){
    //definisco la query SQL
    $sql = "SELECT * FROM articolo, trattazione, tema WHERE articolo.blog = trattazione.blog AND trattazione.tema = tema.codiceTema AND tema.nomeTema = ? ORDER BY mediaVoti DESC LIMIT " . $num_record;
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    //creo un array di memorizzazione dei risultati
    $risultatoQuery = array();

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBestArticlesByTheme: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $tema);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i risultati della query SQL
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $articleContent = getArticleContentIncluded( $conn, $row['codiceArticolo'] );
        $row['posizioneContenuto'] = "/progetto-sito/" . $articleContent['posizioneContenuto'];
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;

}

//Funzione di estrazione dei post con media voti voti più alta [DA RIVEDERE]
function getBestPosts($conn, $num_record){
    //definisco la query sql
    $sql = "SELECT DISTINCT post.codicePost, post.blog, post.dataOra, post.titolo, post.testo, post.tipologia, blog.nomeBlog, blog.posizioneImgProfilo FROM post, inclusionecontenutopost, blog WHERE post.codicePost = inclusionecontenutopost.post AND post.blog = blog.CodiceBlog ORDER BY mediaVoti DESC LIMIT " . $num_record;
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    //creo un array di memorizzazione dei risultati
    $risultatoQuery = array();

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBestPosts: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati
    $resultData = mysqli_stmt_get_result($stmt);

    //scorro i risultati
    while($row = mysqli_fetch_assoc($resultData)){
        //aggiungo l'url
        $row['blog_url'] = "/progetto-sito/blog.php?blogCode=" . $row['blog'];
        //inserisci nella prossima posizione libera dell'array
        $risultatoQuery[] = $row;
    }
    
    //Adesso per ogni post estraggo i relativi allegati e commenti li aggancio a ciascuna entry dell'array $risultatoQuery
    foreach($risultatoQuery as $key => $result){
        //Estraggo gli allegati
        $sql = "SELECT * FROM contenuto WHERE contenuto.codiceContenuto IN ( SELECT inclusionecontenutopost.contenuto FROM inclusionecontenutopost WHERE inclusionecontenutopost.post = ? )";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            return false;
        }
        mysqli_stmt_bind_param($stmt, "d", $result['codicePost']);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        //Creiamo un array che conterrà la lista degli allegati associati a ciascun post
        $risultatoQuery[$key]['listaAllegati'] = array();
        //Verifichiamo che la query abbia effettivamente prodotto risultati
        if( mysqli_num_rows($resultData) > 0 ){
            //In caso siano effettivamente presenti allegati riempiamo l'array ['listaAllegati'] con tutti gli allegati trovati
            while( $row = mysqli_fetch_assoc( $resultData ) ){
                //Per creare una struttura del tipo array( [ARRAY_POST], "listaAllegati" => array( "link" => "percorso_link", "video" => "percorso_video" ) );
                
                if( $result['tipologia'] == "immagine" ){
                    $risultatoQuery[$key]['listaAllegati'][] = "/progetto-sito/" . $row['posizioneContenuto'];
                }else if( $result['tipologia'] == "link" ){
                    $risultatoQuery[$key]['listaAllegati'][$row['tipoContenuto']] = $row['posizioneContenuto'];
                }else{
                    $risultatoQuery[$key]['listaAllegati'][$row['tipoContenuto']] = "/progetto-sito/" . $row['posizioneContenuto'];
                }

            }
        }
        
    }

    mysqli_stmt_close($stmt);

    return $risultatoQuery;
}

//funzione di estrazione dei post ordinati per data e ora (da più recenti a più vecchi)
function getOrderedPost( $conn ){

    $sql = "SELECT post.codicePost, post.blog, post.dataOra, post.titolo, post.testo, post.tipologia, blog.nomeBlog, blog.codiceBlog FROM post, blog WHERE post.blog = blog.CodiceBlog ORDER BY post.dataOra DESC ";
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    
    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    while( $row = mysqli_fetch_assoc( $resultData ) ){
        // inserisci nella prossima posizione libera dell'array
        $risultatoQuery[] = $row;
    }

    //Adesso per ogni post estraggo i relativi allegati e commenti li aggancio a ciascuna entry dell'array $risultatoQuery
    foreach( $risultatoQuery as $key => $result ){

        $sql = "SELECT * FROM contenuto WHERE contenuto.codiceContenuto IN ( SELECT inclusionecontenutopost.contenuto FROM inclusionecontenutopost WHERE inclusionecontenutopost.post = ? )";
        /*
        $sql = "SELECT * FROM allegati WHERE allegati.codiceContenuto IN ( SELECT contenutopost.codicecontenuto FROM contenutopost WHERE contenutopost.codicepost = ? )";*/
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            return false;
        }
        mysqli_stmt_bind_param($stmt, "d", $result['codicePost']);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        //Creiamo un array che conterrà la lista degli allegati associati a ciascun post
        $risultatoQuery[$key]['listaAllegati'] = array();
        //Verifichiamo che la query abbia effettivamente prodotto risultati
        if( mysqli_num_rows($resultData) > 0 ){
            //In caso siano effettivamente presenti allegati riempiamo l'array ['listaAllegati'] con tutti gli allegati trovati
            while( $row = mysqli_fetch_assoc( $resultData ) ){
                //Per creare una struttura del tipo array( [ARRAY_POST], "listaAllegati" => array( "link" => "percorso_link", "video" => "percorso_video" ) );
                
                if( $result['tipologia'] == "immagine" ){
                    $risultatoQuery[$key]['listaAllegati'][] = "/progetto-sito/" . $row['posizioneContenuto'];
                }else if( $result['tipologia'] == "link" ){
                    $risultatoQuery[$key]['listaAllegati'][$row['tipoContenuto']] = $row['posizioneContenuto'];
                }else{
                    $risultatoQuery[$key]['listaAllegati'][$row['tipoContenuto']] = "/progetto-sito/" . $row['posizioneContenuto'];
                }

            }
        }

        //Estraggo anche i commenti per il post
        $risultatoQuery[$key]['comments'] = getCommentsByPostID( $conn, $result['codicePost'] );
        
    }
    
    mysqli_stmt_close($stmt);

    return $risultatoQuery;
}

//funzione di estrazione di un blog a partire da un codice blog [DUPLICATA]
/*
function getBlog( $conn, $blog_id ){
    //definisco la query SQL
    $sql = "SELECT * FROM blog WHERE codiceBlog = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    //creo un array di memorizzazione dei risultati
    $risultatoQuery = array();
    
    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBlog: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "d", $blog_id);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){  
        mysqli_stmt_close($stmt);
        return $row;
    }
    
    mysqli_stmt_close($stmt);
    return false;

}
*/

//Funzione che ottiene un post di un dato id
function getPostByID( $conn, $post_id ){
    //definisco la query SQL
    $sql = "SELECT * FROM post WHERE post.codicePost = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    //creo un array di memorizzazione dei risultati
    $risultatoQuery = array();

    //controllo la corretta definizine dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getPost: FALLIMENTO DELLO STATEMENT");
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $post_id );
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    
    //memorizzo i risultati della query SQL
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    if( $row = mysqli_fetch_assoc( $resultData ) ){
        return $row;
    }
    return false;

}

//funzione di estrazione dei blog con il maggior numero di follower
function getMostFollowedBlogs( $conn, $num_record ){
    //definisco la query SQL
    $sql = "SELECT * FROM blog ORDER BY numeroSeguaci DESC LIMIT " . $num_record;
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);
    //creo un array di memorizzazione per i risultati
    $risultatoQuery = array();

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getMostFollowedBlogs: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati della query
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        //includo l'url dell'articolo
        $row['url'] = "/progetto-sito/blog.php?blogCode=" . $row['codiceBlog'];
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;
}

//funzione di estrazione dei blog a partire da un tema
function getBlogByTheme( $conn, $tema, $num_record ){
    //definisco la query SQL
    $sql = "SELECT * FROM trattazione, blog WHERE trattazione.blog = blog.codiceBlog AND trattazione.tema = ? ORDER BY blog.numeroSeguaci DESC LIMIT " . $num_record;
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);
    //creo un array di memorizzazione per i risultati
    $risultatoQuery = array();

    //controllo la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBlogByTheme: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "s", $tema);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i risultati della query SQL
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;

}

//funzione di estrazione dei blog seguiti da un determinato utente 
function getFollowedBlog( $conn, $user_id, $num_record = 30){
    //definisco la query SQL
    $sql = "SELECT blog.* FROM utente, blog, seguito WHERE utente.codiceUtente = ? AND blog.codiceBlog = seguito.blog LIMIT " . $num_record;
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);
    //creo un array di memorizzazione per i risultati
    $risultatoQuery = array();

    //controllo la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getFollowedBlog: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $user_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i risultati della query SQL
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;

}

//funzione di estrazione delle informazioni di un articolo a partire da un codice articolo
function getArticleByID( $conn, $article_id ){
    //definisco la query SQL
    $sql = "SELECT * FROM articolo WHERE codiceArticolo = ?";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getArticleByID: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $article_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i risultati della query SQL
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){  
        return $row;
    }
    return false;
}

//funzione di estrazione dei temi
function getThemes($conn){
    //definisco la query SQL
    $sql = "SELECT * FROM tema;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getThemes: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    $themes = array();

    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while ($row = mysqli_fetch_assoc($resultData)){
        array_push($themes, $row);
    }
    return $themes;
}

//funzione di estrazione dei sottotemi relativi a un determinato tema
function getSubthemes($conn){
    //definisco la query SQL
    $sql = "SELECT s.*, t.nomeTema FROM sottotema s INNER JOIN tema t ON s.codiceSottotema = t.codiceTema;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //controllo la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getSubthemes: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //estraggo i risultati
    $resultData = mysqli_stmt_get_result($stmt);
    $subthemes = array();

    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while ($row = mysqli_fetch_assoc($resultData)){
        array_push($subthemes, $row);
    }
    return $subthemes;
}

//---
//TERMINE DELLE FUNZIONI DI ESTRAZIONE DATI
//---

//---

//---
//FUNZIONI DI VALIDAZIONE DEGLI INPUT
//---

//funzione di verifica del nome
function invalidName($suName) {
    //definisco un'espressione regolare
    $pattern = "/[^A-Za-z ',]+/i";

    //verifico il match dell'espressione regolare
    if (preg_match($pattern, $suName)){
        return true;
    }
    return false;
}

//funzione di verifica del cognome
function invalidSurname($suSurname) {
    //definisco l'espressione regolare
    $pattern = "/[^A-Za-z ',]+/i";

    //verifico il match dell'espressione regolare
    if (preg_match($pattern, $suSurname)/* || (strlen($suSurname) > 50 || strlen($suSurname) < 1)*/){
        return true;
    }
    return false;
}

//funzione di verifica della data di nascita
function invalidBDate($suBDate) {
    //definisco la data di oggi
    $today = date("Y-m-d");
    //calcolo la differenza e quindi l'età dell'utente
    $diff = date_diff(date_create($suBDate), date_create($today));

    //verifico che la differenza sia sufficiente
    if($diff->format('%y%') < 14){
        return true;
    }
    return false;
}

//funzione di verifica del numero di telefono
function invalidPhone($suPhone) {
    //definisco l'espressione regolare
    $pattern = "/[^0-9]+/";

    //verifico il match dell'espressione regolare
    if (preg_match($pattern, $suPhone)){
        return true;
    }
    return false;
}

//funzione di verifica del documento di identità
function invalidDocument($suDocument) {
    //definisco l'espressione regolare
    $pattern = "/[^A-Za-z0-9]+/i";

    //verifico il match dell'espressione regolare
    if (preg_match($pattern, $suDocument)){
        return true;
    }
    return false;
}

//funzione di verifica del nome utente
function invalidUsername($suUsername) {
    //definisco l'espressione regolare
    $pattern = "/[^A-Za-z\.-_]+/i";

    //verifico il match dell'espressione regolare
    if (preg_match($pattern, $suUsername)){
        return true;
    }
    return false;
}

//funzione di verifica dell'indirizzo e-mail
function invalidEmail($suEmail) {
    //verifico la validità dell'indirizzo email
    if (!filter_var($suEmail, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}

//funzione di verifica della password
function invalidPassword($suPassword) {
    //definisco le condizioni per la validità della password
    $checkNumber = preg_match("/[0-9]+/", $suPassword);
    $checkLowerCase = preg_match("/[a-z]+/", $suPassword);
    $checkUpperCase = preg_match("/[A-Z]+/", $suPassword);
    $checkSpecialSymbols = preg_match("/\W+/", $suPassword);

    //verifico la validità della password con le espressioni regolari
    if (!$checkNumber || !$checkLowerCase || !$checkUpperCase || !$checkSpecialSymbols){
        return true;
    }
    return false;
}

//funzione di verifica del check della password
function invalidCheckPassword($suPassword, $suCheckPassword) {
    //verifico la correttezza della doppia password
    if ($suPassword !== $suCheckPassword){
        return true;
    }
    return false;
}

//---
//TERMINE DELLE FUNZIONI DI VALIDAZIONE DEGLI INPUT
//---

//---

//---
//FUNZIONI DI ACCESSO E MANIPOLAZIONE DELLA SESSIONE
//---

//funzione di login di un utente (modifica della sessione)
function loginUser($userExistence){
    //avvio la sessione
    session_start();
    //memorizzo nella sessione i dati dell'utente che ha eseguito l'accesso
    $_SESSION["userCode"] = $userExistence["codiceUtente"];
    $_SESSION["userID"] = $userExistence["nomeUtente"];
    $_SESSION["userEmail"] = $userExistence["email"];
    $_SESSION["userDocument"] = $userExistence["estremiDocumento"];
}

function passwordExpiring($conn, $userCode){
    
}

//funzione di recupero del codice utente dell'utente loggato
function getCurrentUserID(){
    //estraggo il codice utente dell'utente che ha eseguito l'accesso
    if( isset( $_SESSION['userCode'] ) ){
        return $_SESSION['userCode'];
    }else{
        return false;
    }
}

//funzione di recupero dell'username dell'utente loggato
function getCurrentUserName(){
    //estraggo il nome utente dell'utente che ha eseguito l'accesso
    if( isset($_SESSION['userID'] ) ){
        return $_SESSION['userID'];
    }else{
        return false;
    }
}

//---
//TERMINE DELLE FUNZIONI DI ACCESSO E MANIPOLAZIONE DELLA SESSIONE
//---

//---

//---
//FUNZIONI DI MANIPOLAZIONE E VALIDAZIONE DELLE IMMAGINI
//---

//funzione di caricamento dell'immagine
function imgUpload($imgTmpName, $imgActualExtension){
    //definisco un nome univoco per il file immagine
    $newImgName = uniqid('', true).".".$imgActualExtension;
    //definisco la destinazione per il file immagine
    $imgDestination = "../../uploads/".$newImgName;
    //trasferisco il file immagine alla destinazione
    move_uploaded_file($imgTmpName, $imgDestination);

    //mando in output la posizione del file immagine
    return "uploads/". $newImgName;
}

//funzione di verifica della dimensione massima dell'immagine
function checkImgSize($imgSize){
    //verifico la grandezza dell'immagine
    if (!($imgSize <= 2097152)){
        return false;
    }
    return true;
}

//funzione di verifica di errori nel caricamento dell'immagine
function checkImgUpload($imgError){
    //verifico il corretto caricamento dell'immagine
    if (!($imgError === 0)) {
        return false;
    }
    return true;
}

//funzione di verifica della correttezza dell'estensione dell'immagine
function checkImgExtension($imgActualExtension, $allowedImgExtensions){
    //verifico la correttezza dell'estensione dell'immagine
    if (!in_array($imgActualExtension, $allowedImgExtensions)){
        return false;
    }
    return true;
}

//---
//TERMINE DELLE FUNZIONI DI MANIPOLAZIONE E VALIDAZIONE DELLE IMMAGINI
//---

//---

//---
//FUNZIONI DI MODIFICA E MANIPOLAZIONE DEI TEMI (ARGOMENTI)
//---

//funzione di cancellazione dei temi trattati da un blog
function cleanBlogThemes($conn, $blogCode){
    //definisco la query sql
    $sql = "DELETE FROM trattazione WHERE blog = ?;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE cleanBlogThemes: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "s", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
}

//funzione di modifica del tema principale trattato da un blog
function editBlogTheme($conn, $blogCode, $blogTheme){
    //definisco la query sql
    $sql = "INSERT INTO trattazione (tema, blog, temaPrincipale) VALUES (?, ?, 1);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE editBlogTheme: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "ss", $blogTheme, $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
}

//funzione di modifica dei sottotemi trattati da un blog
function editBlogSubthemes($conn, $blogCode, $blogSubthemes){
    foreach($blogSubthemes as $subtheme){
        //definisco la query sql
        $sql = "INSERT INTO trattazione (tema, blog, temaPrincipale) VALUES (?, ?, 0);";
        //memorizzo lo stato di avvio dello statement
        $stmt = mysqli_stmt_init($conn);

        //verifico la corretta definizione dello statement
        if (!mysqli_stmt_prepare($stmt, $sql)){
            die("ERRORE NELLA FUNZIONE editBlogSubthemes: FALLIMENTO DELLO STATEMENT");
            exit();
        }

        //imposto i parametri variabili nella query sql
        mysqli_stmt_bind_param($stmt, "ss", $subtheme, $blogCode);
        //eseguo lo statement
        mysqli_stmt_execute($stmt);
        //chiudo lo statement
        mysqli_stmt_close($stmt);
    }
}

//---
//TERMINE DELLE FUNZIONI DI MODIFICA E MANIPOLAZIONE DEI TEMI (ARGOMENTI)
//---

//---

//---
//FUNZIONI DI MODIFICA E MANIPOLAZIONE DELLE COLLABORAZIONI
//---

//funzione di verifica dell'esistenza di una collaborazione tra utente e blog
function checkCollaboration($conn, $blogCode, $username){
    //definisco la query sql
    $sql = "SELECT * FROM collaborazione WHERE blog = ? AND utente = (SELECT codiceUtente FROM utente WHERE nomeUtente = ?);";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE checkCollaboration: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili della query SQL
    mysqli_stmt_bind_param($stmt, "ss", $blogCode, $username);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i risultati della query
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement e ritorno risultato negativo
    mysqli_stmt_close($stmt);

    //verifico che la query abbia estratto dei risultati
    if ($row = mysqli_fetch_assoc($resultData)){  
        if ($row["dataFine"] == NULL){
            return $row;
        }
    } 
    return false;
}

//funzione di cancellazione di una collaborazione tra utente e blog
function endCollab($conn, $blogCode, $collabName){
    //definisco la query sql
    $sql = "UPDATE collaborazione SET dataFine = CURRENT_DATE WHERE utente = (SELECT codiceUtente FROM utente WHERE nomeUtente = ?) AND blog = ?;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE endCollab: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "ss", $collabName, $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    updateBlogCollabs($conn, $blogCode, false);
    updateUserCollabs($conn, $collabName, false);
}

//funzione di aggiunta di un nuovo collaboratore 
function addCollaborator($conn, $blogCode, $newCollab){
    //definisco la query sql
    $sql = "INSERT INTO collaborazione (utente, blog, dataInizio) VALUES ((SELECT codiceUtente FROM utente WHERE nomeUtente = ?), ?, CURRENT_DATE) ON DUPLICATE KEY UPDATE dataInizio = CURRENT_DATE, dataFine = NULL;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE addCollaborator: FALLIMENTO DELLO STATEMENT");
        exit();
    }
    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "sd", $newCollab, $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    updateBlogCollabs($conn, $blogCode, true);
    updateUserCollabs($conn, $newCollab, true);
}

//aggiorna numero collaboratori
function updateBlogCollabs($conn, $blogCode, $increment){
    //definisco la query sql
    if ($increment){
        $sql = "UPDATE blog SET numeroCollaboratori = (numeroCollaboratori + 1) WHERE codiceBlog = ?;";
    } else {
        $sql = "UPDATE blog SET numeroCollaboratori = (numeroCollaboratori - 1) WHERE codiceBlog = ?;";
    }
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE updateBlogCollabs: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query SQL
    mysqli_stmt_bind_param($stmt, "d", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
}

//aggiorna numero collaboratori
function updateUserCollabs($conn, $userName, $increment){
    //definisco la query sql
     if ($increment){
        $sql = "UPDATE utente SET numeroCollaborazioni = (numeroCollaborazioni + 1) WHERE nomeUtente = ?;";
    } else {
        $sql = "UPDATE utente SET numeroCollaborazioni = (numeroCollaborazioni - 1) WHERE nomeUtente = ?;";
    }
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE updateUserCollabs: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query SQL
    mysqli_stmt_bind_param($stmt, "s", $userName);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
}

function countUserCollabs($conn, $userName){
    //definisco la query sql
    $sql = "SELECT numeroCollaborazioni AS nCollabs FROM utente WHERE nomeUtente = ?;";
    //avvio lo statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico lo stato di avvio dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE checkCollabsNumber: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userName);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati della query sql
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;
}

function countBlogCollabs($conn, $blogCode){
    //definisco la query sql
    $sql = "SELECT numeroCollaboratori AS nCollabs FROM blog WHERE codiceBlog = ?;";
    //avvio lo statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico lo stato di avvio dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE checkCollabsNumber: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati della query sql
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;
}

//---
//TERMINE DELLE FUNZIONI DI MODIFICA E MANIPOLAZIONE DELLE COLLABORAZIONI
//---

//---

//---
//FUNZIONI DI MANIPOLAZIONE DEI BLOG
//---

//funzione di modifica di un blog
function editBlog($conn, $blogCode, $blogTitle, $blogBio, $profileImgLocation, $coverImgLocation, $blogStyle){
    //memorizzo il codice utente
    $userCode = $_SESSION["userCode"];
    
    //definisco la query sql
    $sql = "UPDATE blog SET nomeBlog = ?, descrizione = ?, posizioneImgProfilo = ?, posizioneImgCopertina = ?, graficaBlog = ? WHERE (codiceBlog = ? AND autore = ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE editBlog: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query SQL
    mysqli_stmt_bind_param($stmt, "sssssss", $blogTitle, $blogBio, $profileImgLocation, $coverImgLocation, $blogStyle, $blogCode, $userCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
}

//funzione di cancellazione di un blog
function deleteBlog($conn, $blogCode){
    //definisco la query sql
    $sql = "DELETE FROM blog WHERE codiceBlog = ?;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE deleteBlog: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "s", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
}

//funzione di creazione di un nuovo blog
function createBlog($conn, $blogTitle, $blogBio, $profileImgLocation, $coverImgLocation, $blogStyle){
    //memorizzo il codice utente
    $userCode = $_SESSION["userCode"];
    
    //definisco la query SQL
    $sql = "INSERT INTO blog (nomeBlog, autore, descrizione, posizioneImgProfilo, posizioneImgCopertina, graficaBlog) VALUES (?, ?, ?, ?, ?, ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE createBlog: FALLIMENTO DELLO STATEMENT".$stmt);
        exit();
    }

    //associo i parametri variabili alla query sql
    mysqli_stmt_bind_param($stmt, "ssssss", $blogTitle, $userCode, $blogBio, $profileImgLocation, $coverImgLocation, $blogStyle);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo l'id del blog inserito
    $lastID = mysqli_insert_id($conn);
    //chiudo e termino lo statement
    mysqli_stmt_close($stmt);

    return $lastID;
}

//funzione di estrazione dei post di un blog
function getBlogPosts($conn, $blogCode, $user_id){
    //definisco la query SQL
    $sql = "SELECT post.codicePost, post.autore, post.blog, post.dataOra, post.titolo, post.testo, post.tipologia, post.numeroCommenti, post.numeroVoti, post.mediaVoti, blog.nomeBlog, blog.posizioneImgProfilo FROM post, blog  WHERE post.blog = ? AND blog.codiceBlog = ? ORDER BY post.dataOra DESC;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    //definisco un array di risultato
    $risultatoQuery = array();
    
    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBlogPosts: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "dd", $blogCode, $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati della query SQL
    $resultData = mysqli_stmt_get_result($stmt);

    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        // inserisci nella prossima posizione libera dell'array
        $risultatoQuery[] = $row;
    }

    //Adesso per ogni post estraggo i relativi allegati, commenti e voto dell'utente e li aggancio a ciascuna entry dell'array $risultatoQuery
    foreach($risultatoQuery as $key => $result){
        //Estraggo gli allegati
        $sql = "SELECT * FROM contenuto WHERE contenuto.codiceContenuto IN ( SELECT inclusionecontenutopost.contenuto FROM inclusionecontenutopost WHERE inclusionecontenutopost.post = ? )";
        //avvio lo statement
        $stmt = mysqli_stmt_init($conn);

        //verifico lo stato di avvio dello statement
        if (!mysqli_stmt_prepare($stmt, $sql)){
            die("FALLIMENTO DELLO STATEMENT NELLA FUNZIONE getBlogFeed, PARTE 2");
            return false;
        }

        //associo i parametri variabili dello statement
        mysqli_stmt_bind_param($stmt, "d", $result['codicePost']);
        //eseguo lo statement
        mysqli_stmt_execute($stmt);
        //memorizzo i risultati della query
        $resultData = mysqli_stmt_get_result($stmt);

        //Creo un array che conterrà la lista degli allegati associati a ciascun post
        $risultatoQuery[$key]['listaAllegati'] = array();

        //Verifico che la query abbia effettivamente prodotto risultati
        if( mysqli_num_rows($resultData) > 0 ){
            //In caso siano effettivamente presenti allegati riempiamo l'array ['listaAllegati'] con tutti gli allegati trovati
            while( $row = mysqli_fetch_assoc( $resultData ) ){
                //Per creare una struttura del tipo array( [ARRAY_POST], "listaAllegati" => array( "link" => "percorso_link", "video" => "percorso_video" ) );
                if( $result['tipologia'] == "immagine" ){
                    $risultatoQuery[$key]['listaAllegati'][] = "/progetto-sito/" . $row['posizioneContenuto'];
                }else if( $result['tipologia'] == "link" ){
                    $risultatoQuery[$key]['listaAllegati'][$row['tipoContenuto']] = $row['posizioneContenuto'];
                }else{
                    $risultatoQuery[$key]['listaAllegati'][$row['tipoContenuto']] = "/progetto-sito/" . $row['posizioneContenuto'];
                }
            }
        }

        if ($user_id != NULL){
            //Estraggo anche i commenti per il post e li inserisco in un indice che creo chiamato "comments"
            $risultatoQuery[$key]['comments'] = getCommentsByPostID( $conn, $result['codicePost'] );

            //Estraggo il voto inserito dall'utente e se presente sarà inserito all'indice "user_vote"
            $risultatoQuery[$key]['user_vote'] = getUserPostVote( $conn, $user_id, $result['codicePost'] );
        }
        
    }
    return $risultatoQuery;
}

//funzione di estrazione degli articoli di un blog
function getBlogArticles($conn, $blogCode){
    //definisco la query sql
    $sql = "SELECT * FROM articolo WHERE blog = ? ORDER BY dataScrittura DESC;";
    //avvio lo statement sul DB
    $stmt = mysqli_stmt_init($conn);
    //definisco un array risultato
    $risultatoQuery = array();

    //verifico lo stato di avvio dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getBlogArticles: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "d", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati della query sql
    $resultData = mysqli_stmt_get_result($stmt);

    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro tutti i risultati
    while($row = mysqli_fetch_assoc($resultData)){
        //aggiungo l'url dell'articolo
        $row['url'] = "/progetto-sito/article.php?articleid=" . $row['codiceArticolo'];
        //aggiungo l'immagine principale dell'articolo
        $row['feat_img'] = getArticleContentIncluded( $conn, $row['codiceArticolo'] );
        $row['feat_img'] = "/progetto-sito/" . $row['feat_img']['posizioneContenuto'];
        // inserisci nella prossima posizione libera dell'array
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;

}

function userBlogCount($conn, $userCode){
    //definisco la query sql
    $sql = "SELECT numeroBlog AS nBlog FROM utente WHERE codiceUtente = ?;";
    //avvio lo statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico lo stato di avvio dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE userBlogCount: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "d", $userCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati della query sql
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;

}

//---
//TERMINE DELLE FUNZIONI DI MANIPOLAZIONE DEI BLOG
//---

//---

//---
//FUNZIONI DI MANIPOLAZIONE DEL PROFILO UTENTE
//---

//funzione di modifica del profilo utente
function editProfile($conn, $profileName, $profileSurname, $profileBDat, $profileGender, $profilePhone, $profileDocument, $profileEmail, $profileUsername, $profileImgLocation, $profileBio){
    //memorizzo il codice utente
    $userCode = $_SESSION["userCode"];
    
    //definisco la query sql
    $sql = "UPDATE utente SET nome = ?, cognome = ?, dataNascita = ?, genere= ?, telefono = ?, estremiDocumento = ?, email = ?, nomeUtente = ?, posizioneImgProfilo = ?, biografia = ? WHERE (codiceUtente = ?);";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE editProfile: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i paraemtri alla query sql
    mysqli_stmt_bind_param($stmt, "sssssssssss", $profileName, $profileSurname, $profileBDat, $profileGender, $profilePhone, $profileDocument, $profileEmail, $profileUsername, $profileImgLocation, $profileBio, $userCode);
    //eseguo lo statement sul DB
    mysqli_stmt_execute($stmt);
    //chiudo lo statement sul DB
    mysqli_stmt_close($stmt);
}

//funzione di cancellazione di un utente dal sito
function deleteProfile($conn, $userCode){
    //definisco la query sql
    $sql = "DELETE FROM utente WHERE codiceUtente = ?;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE deleteProfile: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "s", $userCode);
    //eseguo lo statement sul DB
    mysqli_stmt_execute($stmt);
    //chiudo lo statement sul DB
    mysqli_stmt_close($stmt);
}

//funzione di creazione di un nuovo utente
function createUser($conn, $suPhone, $suDocument, $suGenderSelect, $suUsername, $suEmail, $suPassword, $suDate, $suBDate, $suName, $suSurname){
    //definisco la query sql
    $sql = "INSERT INTO utente (nome, cognome, dataNascita, nomeUtente, email, parolaChiave, dataRegistrazione, telefono, estremiDocumento, genere) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE createUser: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //cripto la password
    $hashedPassword = password_hash($suPassword, PASSWORD_DEFAULT);

    //imposto i parametri variabili nella query SQL
    mysqli_stmt_bind_param($stmt, "ssssssssss", $suName, $suSurname, $suBDate, $suUsername, $suEmail, $hashedPassword, $suDate, $suPhone, $suDocument, $suGenderSelect);
    ///eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
}

//funzione di modifica della password di accesso
function editPassword($conn, $newPassword){
    //memorizzo il codice utente
    $userCode = $_SESSION["userCode"];
    
    //definisco la query sql
    $sql = "UPDATE utente SET parolaChiave = ? WHERE codiceUtente = ?;";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE editPassword: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //cripto la password da registrare nel database
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    //imposto i parametri variabili nella query SQL
    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $userCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
}

//---
//TERMINE DELLE FUNZIONI DI MANIPOLAZIONE DEL PROFILO UTENTE
//---

//---

//---
//FUNZIONI DI MANIPOLAZIONE DEGLI ARTICOLI
//---

//funzione di inserimento di un articolo
function insertArticle( $conn, $blog_id, $article ){
    //definisco la query SQL
    $sql = "INSERT INTO articolo (autore, titolo, testo, dataScrittura, blog,  numeroCommenti, numeroVoti, mediaVoti ) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE insertArticle: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //la funzione mysqli_stmt_bind_param non accetta valori per riferimento diretto
    //ovvio a questa limitazione dichiarando una variabile per ciascun valore
    $date = date('Y-m-d');
    $article['mediaVoti'] = 0;
    $article['numeroVoti'] = 0;
    $article['numeroCommenti'] = 0;

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "dsssdddd", $article['author_id'], $article['title'], $article['content'], $date, $blog_id, $article['numeroCommenti'], $article['numeroVoti'], $article['mediaVoti'] );
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //ritorno la chiave primaria dell'ultimo elemento inserito
    $lastID = mysqli_insert_id($conn);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    return $lastID;
}

//Funzione che modifica un articolo
function editArticle( $conn, $article, $article_id ){
    //definisco la query SQL
    $sql = "UPDATE articolo SET titolo = ?, testo = ? WHERE codiceArticolo = ?;";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE editArticle: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "ssd", $article['title'], $article['text'], $article_id );
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    return true;
    //chiudo lo statement
    mysqli_stmt_close($stmt);

}

//Controllo a partire da un ID articolo e ID utente se l'articolo può essere modificato da uno specifico utente
function userCanEditArticle( $conn, $article, $user_id ){
    //Controllo se l'autore dell'articolo è uguale all'utente passato come parametro tramite user_id 
    //es. utente loggato che può modificare un suo articolo
    if( $article['autore'] == $user_id ){
        return true;
    }else{
        //controllo se l'utente passato come parametro tramite user_id è proprietario del blog a cui appartiene l'articolo 
        //in tal caso può modificarlo
        $blog_origin = getBlog( $conn, $article['blog'] );

        if( $blog_origin['autore'] == $user_id ){
            return true;
        }
    }

}

//Inserisce il commento a un articolo
function insertArticleComment( $conn, $comment ){
    //definisco la query SQL
    $sql = "INSERT INTO commentoarticolo (autore, articolo, testo, dataOra) VALUES (?, ?, ?, ?);";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE insertArticleComment: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "ddss", $comment['author_id'], $comment['article_id'], $comment['text'], $comment['date'] );
    //eseguo lo statement sul DB
    mysqli_stmt_execute($stmt);
    $lastID = mysqli_insert_id($conn);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    return $lastID;

}

//Restituisce la data in un formato custom
function customDateFormat( $date, $type = "standard"){
    //Se il tipo specificato è standard restituisce la data in formato gg/mm/aaaa, contempla soltanto le stringe con data (no orario)
    if( $type == "standard" ){
        $date = DateTime::createFromFormat('Y-m-d', $date);
        return $date->format('d/m/Y');
    }
}

function todayPostComments($conn, $userCode, $postCode){
    //definisco la query sql
    $sql = "SELECT COUNT(*) AS nComments FROM commentopost WHERE autore = ? AND post = ? AND (CURRENT_DATE = DATE(dataOra));";
    //avvio lo statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico lo stato di avvio dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE checkTodayPosts: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "dd", $userCode, $postCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati della query sql
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;
}

//Restituisce un articolo di un dato ID
function getCommentsByArticleID( $conn, $article_id ){
    //definisco la query SQL
    $sql = "SELECT commentoarticolo.*, utente.nomeUtente, utente.codiceUtente, utente.posizioneImgProfilo FROM commentoarticolo, utente WHERE commentoarticolo.articolo = ? AND utente.codiceUtente = commentoarticolo.autore ORDER BY commentoarticolo.dataOra DESC";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    //verifico la corretta esecuzione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getCommentsByArticleID: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $article_id);
    //eseguo lo statement sul DB
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati della query SQL
    $resultData = mysqli_stmt_get_result($stmt);

    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;
}

//Inserisce il voto di un articolo
function voteArticle( $conn, $params ){
    //definisco la query SQL
    $sql = "INSERT INTO votoarticolo (utente, articolo, dataOra, votazione) VALUES (?, ?, ?, ?);";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);
    $inserted = false;
    
    //verifico la corretta esecuzione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE voteArticle: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "ddsd", $params['author_id'], $params['article_id'], $params['date'], $params['vote'] );
    //eseguo lo statement sul DB
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
    $inserted = true;

    //ottengo la media dei voti
    $voteAverage = getArticleVoteAverage( $conn, $params['article_id'] );

    //definisco la query SQL
    $sql = "UPDATE articolo SET numeroVoti = ?, mediaVoti = ? WHERE codiceArticolo = ?";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta esecuzione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE voteArticle: FALLIMENTO DELLO STATEMENT 2");
        exit();
    }

    //Estraggo l'articolo da aggiornare e incremento il relativo numeroVoti con il valore scelto
    $article = getArticleByID( $conn, $params['article_id'] );
    $num_voti = $article['numeroVoti'] + 1;
    
    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "ddd", $num_voti, $voteAverage, $params['article_id'] );
    //eseguo lo statement sul DB
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
    return true;

}

//Restituisce la media dei voti di un dato articolo
function getArticleVoteAverage($conn, $article_id ){
    $votes = getArticleVotes( $conn, $article_id );
    $numVotes = count($votes);
    $total = 0;
    foreach( $votes as $vote ){
        $total += $vote['votazione'];
    }
    return $total / $numVotes;
}

//Restituisce i voti di un articolo
function getArticleVotes($conn, $article_id){
    //definisco la query SQL
    $sql = "SELECT * FROM votoarticolo WHERE articolo = ?";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getArticleVotes: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $article_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati della query
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while($row = mysqli_fetch_assoc($resultData)){
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;

}

//Restituisce il voto dato a un articolo da un determinato utente
function getUserArticleVote( $conn, $user_id, $post_id ){
    //definisco la query SQL
    $sql = "SELECT * FROM votoarticolo WHERE utente = ? AND articolo = ?";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getUserArticleVote: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "dd", $user_id, $post_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    if( $row = mysqli_fetch_assoc( $resultData ) ){
        return $row;
    }
    return false;
}

//Restituisce tutte le inclusioni di un article
function getArticleContentIncluded( $conn, $article_id ){
    //definisco la query sql
    $sql = "SELECT * FROM contenuto WHERE contenuto.codiceContenuto IN ( SELECT inclusionecontenutoarticolo.contenuto FROM inclusionecontenutoarticolo WHERE inclusionecontenutoarticolo.articolo = ? )";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getArticleContentIncluded: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "d", $article_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $risultatoQuery[] = $row;
    }

    if(empty( $risultatoQuery)){
        return false;
    }
    return $risultatoQuery[0];

}

//Elimina tutti i contenuti collegati a un articolo [DA RIVEDERE]
function deleteArticleContent( $conn, $article_id ){
    //Estraggo tutti i contenuti inclusi in un post con la getPostContentIncluded
    $article_content = array( 0 => getArticleContentIncluded( $conn, $article_id ) );
    //Scorro tutti i contenuti del post e per ognuno eseguo la funzione deleteContent che elimina un contenuto passandogli un codiceContenuto
    foreach( $article_content as $content ){
        //Faccio un check se il contenuto è stato effettivamente eliminato in caso non sia riuscito esco dalla funzione ritornando false
          if( !deleteContent($conn, $content['codiceContenuto']) ){
            return false;
        }
    }
    //Se tutto è andato bene ritorno true
    return true;
}

//Elimina un articolo
function deleteArticle( $conn, $article_id ){
    //Prima elimino i contenuti associati al article
    $contentDel = deleteArticleContent( $conn, $article_id );

    //Se l'eliminazione dei contenuti associato al article è andata a buon fine procedo all'eliminazione del article altrimenti mi fermo e ritorno false
    if( $contentDel == false ){
        return false;
    }

    //definisco la query sql
    $sql = "DELETE FROM articolo WHERE codiceArticolo = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE deleteArticle: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "d", $article_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
    return true;

}

//Restituisce un commento dato un codiceCommento ($comment_id)
function getArticleCommentByID( $conn, $comment_id ){
    //definisco la query sql
    $sql = "SELECT commentoarticolo.*, utente.codiceUtente, utente.nomeutente, utente.nome, utente.cognome FROM commentoarticolo, utente WHERE commentoarticolo.codiceCommento = ? AND commentoarticolo.autore = utente.codiceUtente ";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getArticleCommentByID: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "d", $comment_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //verifico la presenza dei risultati
    if( $row = mysqli_fetch_assoc( $resultData ) ){
        return $row;
    }
    return false;
}

//Elimina un commento 
function deleteArticleComment($conn, $comment){
    //definisco la query sql
    $sql = "DELETE FROM commentoarticolo WHERE codiceCommento = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE deleteArticleComment: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "d", $comment['codiceCommento']);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
    return true;

}

//Controlla se il tag che l'utente vuole inserire esiste già o meno
function articleTagExists($conn, $tag){
    //definisco la query sql
    $sql = "SELECT * FROM tag WHERE chiaveTag = ?"; 
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE articleTagExists: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "s", $tag);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    if( $row = mysqli_fetch_assoc( $resultData ) ){
        return $row;
    }
    return false;
    

}



//Aggiunge il tag che l'utente vuole inserire all'articolo
function addArticleTag($conn, $article_id, $tag_id ){
    //definisco la query sql
    $sql = "INSERT INTO caratterizzazionearticolo (articolo, tag) VALUES (?, ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE addArticleTag: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "dd", $article_id, $tag_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
    return true;
    
}

//Crea un tag nella tabella tag
function createTag($conn, $tag){
    //definisco la query sql
    $sql = "INSERT INTO tag (chiaveTag) VALUES (?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE createTag: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "s", $tag);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $lastID = mysqli_insert_id($conn);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    return $lastID;
}

//Restituisce i tag a partire dall'id di un articolo
function getArticleTags( $conn, $article_id ){
    //definisco la query sql
    $sql = "SELECT tag.* FROM caratterizzazionearticolo AS t, tag WHERE t.articolo = ? AND tag.codiceTag = t.tag"; 
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getArticleTags: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "d", $article_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $risultatoQuery[] = $row;
    }

    if(empty($risultatoQuery)){
        return false;
    }
    return $risultatoQuery;

}

//Funzione che elimina tutti i tag collegati a un articolo
function deleteArticleTags( $conn, $article_id ){
    //definisco la query sql
    $sql = "DELETE FROM caratterizzazionearticolo WHERE articolo = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE deleteArticleTags: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "d", $article_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
    return true;
}

//---
//TERMINE DELLE FUNZIONI DI MANIPOLAZIONE DEGLI ARTICOLI
//---

//---

//---
//FUNZIONI DI MANIPOLAZIONE DEI "FOLLOW"
//---

//funzione di aggiunta di un "follow" tra utente e blog
function followBlog($conn, $userCode, $blogCode, $todayDate){
    //definisco la query sql
    $sql = "INSERT INTO seguito (utente, blog, dataInizio) VALUES (?, ?, ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE followBlog: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "sss", $userCode, $blogCode, $todayDate);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    updateBlogFollowers($conn, $blogCode, true);
}

function updateBlogFollowers($conn, $blogCode, $increment){
    //definisco la query SQL
    if ($increment){
        $sql = "UPDATE blog SET numeroSeguaci = (numeroSeguaci + 1) WHERE codiceBlog = ?;";
    } else {
        $sql = "UPDATE blog SET numeroSeguaci = (numeroSeguaci - 1) WHERE codiceBlog = ?;";
    }
    
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE updateBlogFollowers: FALLIMENTO DELLO STATEMENT 2");
        exit();
    }
    
    //associo i paraemtri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
}

//funzione di rimozione di un "follow" tra utente e blog
function unfollowBlog($conn, $userCode, $blogCode){
    //definisco la query sql
    $sql = "DELETE FROM seguito WHERE utente = ? AND blog = ?;";
    
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE unfollowBlog: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //imposto i parametri variabili nella query sql
    mysqli_stmt_bind_param($stmt, "ss", $userCode, $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    updateBlogFollowers($conn, $blogCode, false);
}

//---
//TERMINE FUNZIONI DI MANIPOLAZIONE DEI "FOLLOW"
//---

//---

//---
//FUNZIONI DI GESTIONE DELLA RICERCA DEI CONTENUTI
//---

//funzione di ricerca degli articoli
function articleResearch($conn, $searchInput){
    //definisco la query sql
    $sql = "SELECT * FROM articolo WHERE titolo LIKE '%".$searchInput."%';";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);
    //creo una variabile array per i risultati
    $articles = array();

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE articleResearch: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i risultati della query
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati della query
    while( $row = mysqli_fetch_assoc($resultData)){
        //includo l'url dell'articolo
        $row['url'] = "/progetto-sito/article.php?articleid=" . $row['codiceArticolo'];
        //includo l'immagine principale dell'articolo
        $row['feat_img'] = getArticleContentIncluded( $conn, $row['codiceArticolo'] );
        $row['feat_img'] = "/progetto-sito/" . $row['feat_img']['posizioneContenuto'];

        //inserisco i dati dell'articolo nell'array di output
        $articles[] = $row;
    }
    return $articles;
}

function postResearch($conn, $searchInput){
    //definisco la query
    $sql = "SELECT P.*, B.* FROM post AS P, blog AS B WHERE P.blog = B.codiceBlog AND (P.titolo LIKE '%".$searchInput."%' OR P.testo LIKE '%".$searchInput."%');";
    //avvio lo statement sul DB
    $stmt = mysqli_stmt_init($conn);
    //definisco un array di risultato
    $risultatoQuery = array();
    
    //verifico lo stato dell'avvio dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELL'AVVIO DELLO STATEMENT: funzione postResearch");
        return false;
    }

    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati
    $resultData = mysqli_stmt_get_result($stmt);

    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        //aggiungo l'url
        $row['blog_url'] = "/progetto-sito/blog.php?blogCode=" . $row['blog'];
        // inserisci nella prossima posizione libera dell'array
        $risultatoQuery[] = $row;
    }

    //Adesso per ogni post estraggo i relativi allegati, commenti e voto dell'utente e li aggancio a ciascuna entry dell'array $risultatoQuery
    foreach($risultatoQuery as $key => $result){
        //Estraggo gli allegati
        $sql = "SELECT * FROM contenuto WHERE contenuto.codiceContenuto IN ( SELECT inclusionecontenutopost.contenuto FROM inclusionecontenutopost WHERE inclusionecontenutopost.post = ? )";
        //avvio lo statement
        $stmt = mysqli_stmt_init($conn);

        //verifico lo stato di avvio dello statement
        if (!mysqli_stmt_prepare($stmt, $sql)){
            die("FALLIMENTO DELLO STATEMENT NELLA FUNZIONE postResearch, PARTE 2");
            return false;
        }

        //associo i parametri variabili dello statement
        mysqli_stmt_bind_param($stmt, "d", $result['codicePost']);
        //eseguo lo statement
        mysqli_stmt_execute($stmt);
        //memorizzo i risultati della query
        $resultData = mysqli_stmt_get_result($stmt);

        //Creo un array che conterrà la lista degli allegati associati a ciascun post
        $risultatoQuery[$key]['listaAllegati'] = array();

        //Verifico che la query abbia effettivamente prodotto risultati
        if( mysqli_num_rows($resultData) > 0 ){
            //In caso siano effettivamente presenti allegati riempiamo l'array ['listaAllegati'] con tutti gli allegati trovati
            while( $row = mysqli_fetch_assoc( $resultData ) ){
                //Per creare una struttura del tipo array( [ARRAY_POST], "listaAllegati" => array( "link" => "percorso_link", "video" => "percorso_video" ) );
                if( $result['tipologia'] == "immagine" ){
                    $risultatoQuery[$key]['listaAllegati'][] = "/progetto-sito/" . $row['posizioneContenuto'];
                }else if( $result['tipologia'] == "link" ){
                    $risultatoQuery[$key]['listaAllegati'][$row['tipoContenuto']] = $row['posizioneContenuto'];
                }else{
                    $risultatoQuery[$key]['listaAllegati'][$row['tipoContenuto']] = "/progetto-sito/" . $row['posizioneContenuto'];
                }
            }
        }
    }
    return $risultatoQuery;
}

//funzione di ricerca dei blog
function blogResearch($conn, $searchInput){
    //definisco la query sql
    $sql = "SELECT * FROM blog WHERE nomeBlog LIKE '%".$searchInput."%';";
    //memorizzo lo stato di avvio dello statement sul DB
    $stmt = mysqli_stmt_init($conn);
    //creo una variabile array per i risultati
    $blogs = array();

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE blogResearch: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    //memorizzo i risultati della query
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati della query
    while($row = mysqli_fetch_assoc($resultData)){
        //includo l'url dell'articolo
        $row['url'] = "/progetto-sito/blog.php?blogCode=" . $row['codiceBlog'];

        $blogs[] = $row;
    }
    return $blogs;
}

//---
//TERMINE DELLE FUZIONI DI GESTIONE DELLA RICERCA DEI CONTENUTI
//---

//---

//---
//FUNZIONI DI MANIPOLAZIONE DEI POST
//---

//verifica del numero giornaliero di Post
function checkTodayPosts($conn, $blogCode){
    //definisco la query sql
    $sql = "SELECT COUNT(*) AS nPosts FROM post WHERE blog = ? AND (CURRENT_DATE = DATE(dataOra));";
    //avvio lo statement sul DB
    $stmt = mysqli_stmt_init($conn);

    //verifico lo stato di avvio dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE checkTodayPosts: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "d", $blogCode);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //memorizzo i risultati della query sql
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    return false;
}

//Funzione di creazione post
function createPost( $conn, $post ){
    //definisco la query SQL
    $sql = "INSERT INTO post (autore, blog, titolo, testo, dataOra, tipologia, numeroCommenti, numeroVoti, mediaVoti ) VALUES (?, ?, ?, ?, ?, ?, 0, 0, 0);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE insertContentPostInclusion: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "ddssss", $post['author_id'], $post['blog_id'], $post['title'], $post['text'], $post['date'], $post['post_type'] );
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    $lastID = mysqli_insert_id($conn);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    return $lastID;
}

//Inserisce il legame tra post e contenuto
function insertContentPostInclusion( $conn, $params ){
    //definisco la query SQL
    $sql = "INSERT INTO inclusionecontenutopost (post, contenuto) VALUES (?, ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE insertContentPostInclusion: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "dd", $params['post'], $params['content'] );
    //eseguo lo statement
    mysqli_stmt_execute($stmt);

    $lastID = mysqli_insert_id($conn);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    return $lastID;

}

//Inserisce il legame tra articolo e contenuto
function insertContentArticleInclusion( $conn, $params ){
    //definisco la query SQL
    $sql = "INSERT INTO inclusionecontenutoarticolo (articolo, contenuto) VALUES (?, ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE insertContentArticleInclusion: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "dd", $params['article_id'], $params['content'] );
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    return true;
}

//Restituisce i commenti di un determinato post
function getCommentsByPostID( $conn, $post_id ){
    //definisco la query SQL
    $sql = "SELECT commentopost.*, utente.nomeUtente, utente.codiceUtente, utente.posizioneImgProfilo FROM commentopost, utente WHERE post = ? AND commentopost.autore = utente.codiceUtente ORDER BY commentopost.dataOra DESC ";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getCommentsByPostID: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $post_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;

}

//Restituisce un commento dato un codiceCommento ($comment_id)
function getPostCommentByID( $conn, $comment_id ){
    //definisco la query SQL
    $sql = "SELECT commentopost.*, utente.codiceUtente, utente.nomeutente, utente.nome, utente.cognome FROM commentopost, utente WHERE commentopost.codiceCommento = ? AND commentopost.autore = utente.codiceUtente ";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getPostCommentByID: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $comment_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //verifico la presenza di risultati
    if( $row = mysqli_fetch_assoc( $resultData ) ){
        return $row;
    }
    return false;

}

//Inserisce un commento a un post
function insertCommentPost( $conn, $comment ){
    //definisco la query SQL
    $sql = "INSERT INTO commentopost (autore, post, testo, dataOra) VALUES (?, ?, ?, ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE insertCommentPost: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "ssss", $comment['author'], $comment['post'], $comment['text'], $comment['date'] );
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    
    $lastID = mysqli_insert_id($conn);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    return $lastID;

}


//Verifica se un utente può eliminare un commento
function userCanEditComment( $comment, $user_id ){
    if( $comment['autore'] == $user_id ){
        return true;
    }
    else{
        return false;
    }
}

//Elimina un commento 
function deletePostComment($conn, $comment){
    //definisco la query SQL
    $sql = "DELETE FROM commentopost WHERE codiceCommento = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE deletePostComment: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i paraemtri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $comment['codiceCommento']);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
    return true;

}

//Inserisce il voto di un post
function votePost( $conn, $params ){
    //definisco la query SQL
    $sql = "INSERT INTO votopost (utente, post, dataOra, votazione) VALUES (?, ?, ?, ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    $inserted = false;
    
    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE votePost: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i paraemtri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "ddsd", $params['author_id'], $params['post_id'], $params['date'], $params['vote'] );
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
    $inserted = true;
    
    $voteAverage = getPostVoteAverage( $conn, $params['post_id'] );

    //definisco la query SQL
    $sql = "UPDATE post SET numeroVoti = ?, mediaVoti = ? WHERE codicePost = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE votePost: FALLIMENTO DELLO STATEMENT 2");
        exit();
    }

    //Estraggo il post da aggiornare e incremento il relativo numeroVoti con il valore scelto
    $post = getPostByID( $conn, $params['post_id'] );
    $num_voti = $post['numeroVoti'] + 1;
    
    //associo i paraemtri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "ddd", $num_voti, $voteAverage, $params['post_id'] );
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
    return true;

}

//Restituisce il voto dato a un post da un determinato utente
function getUserPostVote( $conn, $user_id, $post_id ){
    //definisco la query SQL
    $sql = "SELECT * FROM votopost WHERE utente = ? AND post = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getUserPostVote: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i paraemtri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "dd", $user_id, $post_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    //chiudo lo statement
    mysqli_stmt_close($stmt);

    if( $row = mysqli_fetch_assoc( $resultData ) ){
        return $row;
    }
    return false;
}

//Restituisce i voti di un post
function getPostVotes( $conn, $post_id ){
    //definisco la query SQL
    $sql = "SELECT * FROM votopost WHERE post = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getPostVotes: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i paraemtri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $post_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;
}

//Restituisce la media dei voti di un dato post
function getPostVoteAverage( $conn, $post_id ){
    $votes = getPostVotes( $conn, $post_id );
    $numVotes = count($votes);
    $total = 0;
    foreach( $votes as $vote ){
        $total += $vote['votazione'];
    }
    return $total / $numVotes;
}

//Restituisce tutte le inclusioni di un post
function getPostContentIncluded( $conn, $post_id ){
    //definisco la query SQL
    $sql = "SELECT * FROM contenuto WHERE contenuto.codiceContenuto IN ( SELECT inclusionecontenutopost.contenuto FROM inclusionecontenutopost WHERE inclusionecontenutopost.post = ? )";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getPostContentIncluded: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i paraemtri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $post_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $risultatoQuery[] = $row;
    }
    return $risultatoQuery;

}

//Elimina un contenuto di un determinato ID
function deleteContent( $conn, $content_id ){
    $sql = "DELETE FROM contenuto WHERE codiceContenuto = ?";
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    if( !mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    mysqli_stmt_bind_param($stmt, "d", $content_id);
    if( mysqli_stmt_execute($stmt) ){
        mysqli_stmt_close($stmt);
        return true;
    }

    mysqli_stmt_close($stmt);
    return false;
}

//Elimina tutti i contenuti collegati a un post
function deletePostContent( $conn, $post_id ){
    //Estraggo tutti i contenuti inclusi in un post con la getPostContentIncluded
    $post_content = getPostContentIncluded( $conn, $post_id );
    //Scorro tutti i contenuti del post e per ognuno eseguo la funzione deleteContent che elimina un contenuto passandogli un codiceContenuto
    foreach( $post_content as $content ){
        //Faccio un check se il contenuto è stato effettivamente eliminato in caso non sia riuscito esco dalla funzione ritornando false
        if( !deleteContent($conn, $content['codiceContenuto']) ){
            return false;
        }
    }
    //Se tutto è andato bene ritorno true
    return true;
}

//Elimina un post
function deletePost($conn, $post_id){
    //Prima elimino i contenuti associati al post
    $contentDel = deletePostContent( $conn, $post_id );

    //Se l'eliminazione dei contenuti associato al post è andata a buon fine procedo all'eliminazione del post altrimenti mi fermo e ritorno false
    if( $contentDel == false ){
        return false;
    }
    
    //definisco la query SQL
    $sql = "DELETE FROM post WHERE codicePost = ?";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    //verifico la corretta definizione dello statement
    if( !mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE deletePost: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i paraemtri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "d", $post_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);
    return true;
}

//Controllo a partire da un ID post e ID utente se l'post può essere modificato da uno specifico utente
function userCanEditPost($conn, $post, $user_id){

    //Controllo se l'autore dell'post è uguale all'utente passato come parametro tramite user_id (es. utente loggato che può modificare un suo post)
    if( $post['autore'] == $user_id ){
        return true;
    }else{
        //Qui controllo invece se l'utente passato come parametro tramite user_id è proprietario del blog a cui appartiene il'post (in tal caso può modificarlo)
        $blog_origin = getBlog( $conn, $post['blog'] );
        if( $blog_origin['autore'] == $user_id ){
            return true;
        }
    }
    return false;
}

//---
//TERMINE DELLE FUZIONI DI MANIPOLAZIONE DEI POST
//---

//---

//---
//FUNZIONI DI GESTIONE DEL FEED
//---

//Restituisce il feed di un dato utente
function getUserFeed( $conn, $user_id ){
    //definisco la query SQL
    $sql = "SELECT post.codicePost, post.autore, post.blog, post.dataOra, post.titolo, post.testo, post.tipologia, post.numeroCommenti, post.numeroVoti, post.mediaVoti, blog.nomeBlog, blog.posizioneImgProfilo
    FROM post, blog WHERE
    post.blog IN ( SELECT seguito.blog FROM seguito WHERE seguito.utente = ? )
    AND blog.codiceBlog IN ( SELECT seguito.blog FROM seguito WHERE seguito.utente = ? )
    ||
    post.blog IN (SELECT blog.codiceBlog FROM blog WHERE blog.autore = ? ) 
    AND post.blog = blog.codiceBlog
    ||
    post.blog IN (SELECT collaborazione.blog FROM collaborazione WHERE collaborazione.utente = ? )
    AND post.blog = blog.codiceBlog
    ORDER BY post.dataOra DESC";

    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();
    
    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        die("ERRORE NELLA FUNZIONE getUserFeed: FALLIMENTO DELLO STATEMENT");
        exit();
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "dddd", $user_id, $user_id, $user_id, $user_id);
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    //scorro i risultati
    while( $row = mysqli_fetch_assoc( $resultData ) ){
        // inserisci nella prossima posizione libera dell'array
        $risultatoQuery[] = $row;
    }

    //Adesso per ogni post estraggo i relativi allegati, commenti e voto dell'utente e li aggancio a ciascuna entry dell'array $risultatoQuery
    foreach( $risultatoQuery as $key => $result ){

        //Estraggo gli allegati
        $sql = "SELECT * FROM contenuto WHERE contenuto.codiceContenuto IN ( SELECT inclusionecontenutopost.contenuto FROM inclusionecontenutopost WHERE inclusionecontenutopost.post = ? )";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            return false;
        }
        mysqli_stmt_bind_param($stmt, "d", $result['codicePost']);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        //Creo un array che conterrà la lista degli allegati associati a ciascun post
        $risultatoQuery[$key]['listaAllegati'] = array();
        //Verifico che la query abbia effettivamente prodotto risultati
        if( mysqli_num_rows($resultData) > 0 ){
            //In caso siano effettivamente presenti allegati riempiamo l'array ['listaAllegati'] con tutti gli allegati trovati
            while( $row = mysqli_fetch_assoc( $resultData ) ){
                //Per creare una struttura del tipo array( [ARRAY_POST], "listaAllegati" => array( "link" => "percorso_link", "video" => "percorso_video" ) );
                if( $result['tipologia'] == "immagine" ){
                    $risultatoQuery[$key]['listaAllegati'][] = "/progetto-sito/" . $row['posizioneContenuto'];
                }else if( $result['tipologia'] == "link" ){
                    $risultatoQuery[$key]['listaAllegati'][$row['tipoContenuto']] = $row['posizioneContenuto'];
                }else{
                    $risultatoQuery[$key]['listaAllegati'][$row['tipoContenuto']] = "/progetto-sito/" . $row['posizioneContenuto'];
                }

            }
        }

        //Estraggo anche i commenti per il post e li inserisco in un indice che creo chiamato "comments"
        $risultatoQuery[$key]['comments'] = getCommentsByPostID( $conn, $result['codicePost'] );

        //Estraggo il voto inserito dall'utente e se presente sarà inserito all'indice "user_vote"
        $risultatoQuery[$key]['user_vote'] = getUserPostVote( $conn, $user_id, $result['codicePost'] );
        
    }
    return $risultatoQuery;
}

//---
//TERMINE DELLE FUZIONI DI GESTIONE DEL FEED
//---

//---

//---
//FUNZIONI DI GESTIONE DEI CONTENUTI MULTIMEDIALI
//---

//Inserisce un contenuto nella tabella contenuto
function insertContent( $conn, $content ){
    //definisco la query SQL
    $sql = "INSERT INTO contenuto (posizioneContenuto, tipoContenuto) VALUES (?, ?);";
    //memorizzo lo stato di avvio dello statement
    $stmt = mysqli_stmt_init($conn);

    //verifico la corretta definizione dello statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    //associo i parametri variabili alla query SQL
    mysqli_stmt_bind_param($stmt, "ss", $content['position'], $content['type'] );
    //eseguo lo statement
    mysqli_stmt_execute($stmt);
    
    $lastID = mysqli_insert_id($conn);
    //chiudo lo statement
    mysqli_stmt_close($stmt);

    return $lastID;

}

//---
//TERMINE DELLE FUZIONI DI GESTIONE DEI CONTENUTI MULTIMEDIALI
//---

//---

/* ARTICLES */
//Estrae i temi in ordine decrescente per numeroBlog
function getThemesByMaxNumBlog( $conn, $limit){
    $sql = "SELECT * FROM tema ORDER BY numeroBlog DESC LIMIT " . $limit;
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    if( !mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $risultatoQuery[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $risultatoQuery;
}

/* BLOG */ 
//Estrae i blog che appartengono a uno specifico tema
function getBlogsTheme( $conn, $theme ){

    $sql = "SELECT * FROM blog WHERE blog.codiceBlog
    IN ( SELECT blog FROM trattazione WHERE tema 
    IN ( SELECT codiceTema FROM tema WHERE nomeTema = ? ) )";

    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    if( !mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }
    mysqli_stmt_bind_param($stmt, "s", $theme );
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    while( $row = mysqli_fetch_assoc( $resultData ) ){
        $risultatoQuery[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $risultatoQuery; 

}


/*TAG*/
//Estrare un tag a partire dal suo id 
function getTagByID( $conn, $tag_id ){
    $sql = "SELECT * FROM tag WHERE codiceTag = ?";

    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    if( !mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }
    mysqli_stmt_bind_param($stmt, "s", $tag_id );
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if( $row = mysqli_fetch_assoc( $resultData ) ){    
        return $row;
    }
    return false;
}

//Incrementa il numeroblog che utilizzano un determinato tag
function increaseTagNumBlog( $conn, $tag_id ){
    $tag = getTagByID( $conn, $tag_id );
    $sql = "UPDATE tag SET numeroArticoli = ? WHERE codiceTag = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    $numArticoli = $tag['numeroArticoli'] + 1;

    mysqli_stmt_bind_param($stmt, "dd", $numArticoli, $tag_id  );
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Controlla se ad un article_id è associato un deteminato tag_id, in fase di modifica controlla tutti i tag aggiunti e nel caso ce ne siano di nuovi va ad incrementare il numero id articoli
function articleHasTag( $conn, $article_id, $tag_id ){
    $sql = "SELECT * FROM caratterizzazionearticolo WHERE articolo = ? AND tag = ?";

    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    if( !mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }
    mysqli_stmt_bind_param($stmt, "dd", $article_id, $tag_id );
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if( $row = mysqli_fetch_assoc( $resultData ) ){
        return $row;
    }
    return false;
}


//Elimina il tag associato ad un determiato articolo
function deleteArticleTag($conn, $article_id, $tag_id){
    $sql = "DELETE FROM caratterizzazionearticolo WHERE articolo = ? AND tag = ?";
    $stmt = mysqli_stmt_init($conn);
    $risultatoQuery = array();

    if( !mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    mysqli_stmt_bind_param($stmt, "dd", $article_id, $tag_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Decrementa il numero di blog che utilizzano un determinato tag
function decreaseTagNumBlog( $conn, $tag_id ){
    $tag = getTagByID( $conn, $tag_id );
    $sql = "UPDATE tag SET numeroArticoli = ? WHERE codiceTag = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    $numArticoli = $tag['numeroArticoli'] - 1;

    mysqli_stmt_bind_param($stmt, "dd", $numArticoli, $tag_id  );
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Decrementa il numero di commenti di un post 
function decreasePostNumComments( $conn, $post_id ){
    $post = getPostByID( $conn, $post_id );
    $sql = "UPDATE post SET numeroCommenti = ? WHERE codicePost = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    $numCommenti = $post['numeroCommenti'] - 1;

    mysqli_stmt_bind_param($stmt, "dd", $numCommenti, $post_id  );
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Incrementa il numero di commenti di un post
function increasePostNumComments( $conn, $post_id ){
    $post = getPostByID( $conn, $post_id );
    $sql = "UPDATE post SET numeroCommenti = ? WHERE codicePost = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    $numCommenti = $post['numeroCommenti'] + 1;

    mysqli_stmt_bind_param($stmt, "dd", $numCommenti, $post_id  );
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Decrementa il numero di commenti di un article
function decreaseArticleNumComments( $conn, $article_id ){
    $article = getArticleByID( $conn, $article_id );
    $sql = "UPDATE articolo SET numeroCommenti = ? WHERE codiceArticolo = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    $numCommenti = $article['numeroCommenti'] - 1;

    mysqli_stmt_bind_param($stmt, "dd", $numCommenti, $article_id  );
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Incrementa il numero di commenti di un article
function increaseArticleNumComments( $conn, $article_id ){
    $article = getArticleByID( $conn, $article_id );
    $sql = "UPDATE articolo SET numeroCommenti = ? WHERE codiceArticolo = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    $numCommenti = $article['numeroCommenti'] + 1;

    mysqli_stmt_bind_param($stmt, "dd", $numCommenti, $article_id  );
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Decrementa il numero di articoli di un blog
function decreaseBlogNumArticles( $conn, $blog_id ){
    $blog = getBlog( $conn, $blog_id );
    $sql = "UPDATE blog SET numeroArticoli = ? WHERE codiceBlog = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    $numArticoli = $blog['numeroArticoli'] - 1;

    mysqli_stmt_bind_param($stmt, "dd", $numArticoli, $blog_id  );
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Incrementa il numero di articoli di un blog
function increaseBlogNumArticles( $conn, $blog_id ){
    $blog = getBlog( $conn, $blog_id );
    $sql = "UPDATE blog SET numeroArticoli = ? WHERE codiceBlog = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    $numArticoli = $blog['numeroArticoli'] + 1;

    mysqli_stmt_bind_param($stmt, "dd", $numArticoli, $blog_id  );
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Decrementa il numero di post di un blog
function decreaseBlogNumPosts( $conn, $blog_id ){
    $blog = getBlog( $conn, $blog_id );
    $sql = "UPDATE blog SET numeroPost = ? WHERE codiceBlog = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    $numPost = $blog['numeroPost'] - 1;

    mysqli_stmt_bind_param($stmt, "dd", $numPost, $blog_id  );
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Incrementa il numero di post di un blog
function increaseBlogNumPosts( $conn, $blog_id ){
    $blog = getBlog( $conn, $blog_id );
    $sql = "UPDATE blog SET numeroPost = ? WHERE codiceBlog = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
    }

    $numPost = $blog['numeroPost'] + 1;

    mysqli_stmt_bind_param($stmt, "dd", $numPost, $blog_id  );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

