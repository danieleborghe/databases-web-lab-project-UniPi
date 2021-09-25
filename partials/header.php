
<!DOCTYPE html>

<html lang="it">

  <head>

    <title><?php echo $args['titolo']; ?></title>

    <meta charset="UTF-8">

    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <?php 
        //Verifico se sono stati specificati dei CSS da includere e li stampo
        if( !empty( $args['css_list'] ) ){ ?>
        <?php foreach( $args['css_list'] as $css ){ ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php } ?>
    <?php } ?>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/jquery.validate.js"></script>
    <?php if( !empty( $args['script'] ) ){ ?>
    <script type="text/javascript" src="<?php echo $args['script']; ?>"></script>
    <?php } ?>
    <?php 
        //Verifico se sono stati specificati dei javascript da includere e li stampo
        if( !empty( $args['script_list'] ) ){ ?>
        <?php foreach( $args['script_list'] as $script ){ ?>
        <script type="text/javascript" src="<?php echo $script; ?>"></script>
        <?php } ?>
    <?php } ?>
  </head>



  <body>

            <!-- Modal eliminazione Blog -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Vuoi davvero eliminare il blog?</h5>
                </div>

                <div class="modal-body">
                    Tutti i dati relativi al blog, compresi i post, gli articoli e le informazioni relative, verranno cancellati definitivamente. <br /> Vuoi procedere?
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="closeModal">Annulla</button>
                    <button type="button" class="btn btn-danger" id="deleteBlog2">Elimina</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal eliminazione Profilo -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Vuoi davvero eliminare il tuo profilo?</h5>
                </div>

                <div class="modal-body">
                    Tutti i dati relativi al tuo profilo, compresi i blog e tutti i loro contenuti, verranno cancellati definitivamente. <br /> <b>Vuoi procedere?</b> <br /> Una volta completata la cancellazione verrai reindirizzato alla homepage del sito.
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="closeModal2">Annulla</button>
                    <button type="button" class="btn btn-danger" id="deleteProfile2">Elimina</button>
                </div>
            </div>
        </div>
    </div>

    

      <section id="header-section">

        <header class="p-3 bgColorBlack text-white">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/progetto-sito/homepage.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <img src="/progetto-sito/assets/img/clique-logo.png" class="bi me-2" width="100%" height="45" role="img" aria-label="Bootstrap">
                    </a>
        
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/progetto-sito/articles.php" class="nav-link px-2 text-white">Articoli</a></li>
                        <li><a href="/progetto-sito/blog-listing.php" class="nav-link px-2 text-white">Blog</a></li>
                        

                    </ul>

                    <div class="mx-2 p-3">
                        <?php
                            if (isset($_SESSION["userCode"])) {
                                echo '<button type="button" class="mx-2 btn btn-outline-light"><a href="/progetto-sito/feed.php">Feed</a></button>';
                                echo '<button type="button" class="mx-2 btn btn-outline-light"><a href="/progetto-sito/profile.php?userCode='.$_SESSION["userCode"].'">Profilo</a></button>';
                                echo '<button type="button" class="btn bgColorRed text-white mx-2"><a href="/progetto-sito/includes/actions/action-logout.php">Log out</a></button>';
                            } else {
                                echo '<button type="button" class="mx-2 btn btn-outline-light"><a href="/progetto-sito/login.php">Accedi</a></button>';
                                echo '<button type="button" class="mx-2 btn bgColorRed text-white"><a href="/progetto-sito/signup.php">Registrati</a></button>';
                            }
                        ?>
                    </div>

                    <form class="d-flex mx-2" data-children-count="1" id="headerSearchForm" name="headerSearchForm" method="POST" action="search-results.php">
                        <input type="search" class="form-control form-control-dark" placeholder="Cerca..." aria-label="Search" id="headerSearchInput" name="headerSearchInput">
                        <button class="btn bgColorRed px-4 ms-2 button-max-content" type="submit" id="headerSearchBtn" name="headerSearchBtn">Cerca</button>
                    </form>
                </div>
            </div>
        </header>

      </section>
    <main class="d-flex flex-column" id="main-content">

      <!--<section id="middle-section"> -->