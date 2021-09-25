<?php
require "includes/db-connection.php";
?>

<!-- form modifica blog-->
<div class="container p-5" id="editBlogSection">

    <h2 class="mb-5">Crea un nuovo blog</h2>
    
    <form method="POST" action="includes/ajax/ajax-blog-editing.php" enctype="multipart/form-data" id="blogEditingForm">

        <!-- Dettagli blog-->   
        <p class="fs-3 mb-3">Dettagli blog<p> 

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="editBlogTitle" placeholder="Titolo blog" name="blogTitle">
                    <label for="editBlogTitle">Titolo</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <textarea class="form-control height-small" placeholder="Scrivi un commento qui" id="editBlogTextArea" name="blogBio"></textarea>
                    <label for="editBlogTextArea">Descrizione</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <select class="form-select" id="editBlogTemeSelect" aria-label="Seleziona argomento" name="blogTheme">
                        <option value="0" disabled>Seleziona argomento</option>
                        <?php 
                        $themes = getThemes($conn);

                        foreach ($themes as $theme){
                            echo '<option value="'.$theme["codiceTema"].'">'.$theme["nomeTema"].'</option>';
                        }
                        ?>
                    </select>

                    <label for="editBlogTemeSelect">Argomento</label>
                </div>
            </div>
        </div>

        <div class="row-cols-2 mb-3">
        <?php 
            $subThemes = getSubthemes($conn);

            foreach ($subThemes as $subTheme){
                echo '<div class="col form-check sottotema '.$subTheme["tema"].'">';
                    echo '<input class="form-check-input sottotemaCheck" type="checkbox" value="'.$subTheme["codiceSottotema"].'" id="sottotema'.$subTheme["codiceSottotema"].'" name="blogSubThemes[]">';

                    echo '<label class="form-check-label" for="sottoTema1">';
                        echo $subTheme["nomeTema"];
                    echo '</label>';
                echo '</div>';
            }
        ?>
        </div>

        <!-- Fine informazioni blog-->


        <!-- Immagini blog-->
        <p class="fs-3 mb-3">Immagini<p> 

        <div class="row">
            <div class="col">
                <label for="editBlogProfileImg" class="form-label">Immagine del profilo</label>
                <input name="blogProfileImg" class="form-control mb-3" type="file" id="editBlogProfileImg">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="editBlogCoverImg" class="form-label">Immagine di copertina</label>
                <input name="blogCoverImg" class="form-control mb-3" type="file" id="editBlogCoverImg">
            </div>
        </div>

        <!--fine immagini blog-->


        <!-- Tema blog-->
        <p class="fs-3 mb-3">Grafica<p> 

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <select class="form-select" id="editBlogGraphicSelect" aria-label="Seleziona design" name="blogStyle">
                        <option value="0" disabled>Seleziona design</option>
                        <?php 
                        $styles = getStyles($conn);

                        foreach ($styles as $style){
                            echo '<option value="'.$style["codiceGrafica"].'">'.$style["nomeGrafica"].'</option>';
                        }
                        ?>
                    </select>

                    <label for="editBlogGraphicSelect">Design</label>
                </div>
            </div>
        </div>
        <!-- Fine tema blog-->
        
        <div class="row">
            <div class="alert alert-info col-10" role="alert">
                Una volta creato, sarai reindirizzato alla pagina del blog
            </div>
            <!-- Bottone salva modifiche blog-->
            <div class="d-flex justify-content-end py-3 col-2">
                <button type="submit" class="edit-button btn btn-primary" name="blogSave">Salva modifiche</button>
            </div>
            <!-- Fine bottone salva modifiche blog-->    
        </div>
    </form> 
    
    <!-- Fine form modifica blog-->

</div>
