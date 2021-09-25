<?php
    require "includes/db-connection.php";
    $blogCode = $_COOKIE['blogCode'];
    $blogInfo = getBlog($conn, $blogCode);
?>

<!-- form modifica blog-->
<div class="container p-5" id="editBlogSection">
        <h2 class="mb-5">Modifica blog</h2>

        <form method="POST" action="includes/ajax/ajax-blog-editing.php" enctype="multipart/form-data" id="blogEditingForm">

            <!-- Dettagli blog-->   
            <p class="fs-3 mb-3">Dettagli blog<p> 

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="<?php print $blogInfo['nomeBlog']; ?>" type="text" class="form-control" id="editBlogTitle" placeholder="Titolo blog" name="blogTitle">
                        <label for="editBlogTitle">Titolo</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <textarea class="form-control height-small" placeholder="Scrivi un commento qui" id="editBlogTextArea" name="blogBio"><?php print $blogInfo['descrizione'] ?></textarea>
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
                            $blogTheme = getBlogTheme($conn, $blogCode);

                            foreach ($themes as $theme){
                                if ($theme["codiceTema"] == $blogTheme["tema"]){
                                    echo '<option selected value="'.$theme["codiceTema"].'">'.$theme["nomeTema"].'</option>';
                                } else {
                                    echo '<option value="'.$theme["codiceTema"].'">'.$theme["nomeTema"].'</option>';
                                }
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
                $blogSubthemes = getBlogSubthemes($conn, $blogCode);

                foreach ($subThemes as $subTheme){
                    echo '<div class="col form-check sottotema '.$subTheme["tema"].'">';
                        if (in_array($subTheme["codiceSottotema"], $blogSubthemes)){
                            echo '<input checked class="form-check-input sottotemaCheck" type="checkbox" value="'.$subTheme["codiceSottotema"].'" id="sottotema'.$subTheme["codiceSottotema"].'" name="blogSubThemes[]">';
                        } else {
                            echo '<input class="form-check-input sottotemaCheck" type="checkbox" value="'.$subTheme["codiceSottotema"].'" id="sottotema'.$subTheme["codiceSottotema"].'" name="blogSubThemes[]">';
                        }

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
                            $blogStyle = $blogInfo["graficaBlog"];

                            foreach ($styles as $style){
                                if ($style["codiceGrafica"] == $blogStyle){
                                    echo '<option selected value="'.$style["codiceGrafica"].'">'.$style["nomeGrafica"].'</option>';
                                } else {
                                    echo '<option value="'.$style["codiceGrafica"].'">'.$style["nomeGrafica"].'</option>';
                                }
                            }
                            ?>
                        </select>

                        <label for="editBlogGraphicSelect">Design</label>
                    </div>
                </div>
            </div>
            <!-- Fine tema blog-->

            <div class="alert alert-success" role="alert" id="blogEdited">
                Blog modificato con successo!
            </div>
            
            <div class="row">
                <div class="d-flex justify-content-start py-3 col-8">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" id="deleteBlog" name="deleteBlog">
                        Elimina blog
                    </button>
                </div>

                <div class="d-flex justify-content-end py-3 col-2">
                    <?php echo('<a href="/progetto-sito/blog.php?blogCode='.$blogCode.'">') ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" id="returnToBlog">
                            Torna al Blog
                        </button>
                    </a>
                </div>

                <!-- Bottone salva modifiche blog-->
                <div class="d-flex justify-content-end py-3 col-2">
                    <button type="submit" class="edit-button btn btn-primary" name="blogSave">Salva modifiche</button>
                </div>
                <!-- Fine bottone salva modifiche blog-->    
            </div>
        </form> 

        <div class="row">
            <p class="fs-3 mb-3">Collaboratori<p> 

            <div class="alert alert-warning" role="alert" id="alreadyCollab">
                Questo utente è già un collaboratore del tuo blog
            </div>

            <div class="alert alert-warning" role="alert" id="userNotFound">
                L'utente che vuoi aggiungere come collaboratore non esiste
            </div>

            <div class="alert alert-warning" role="alert" id="tooManyUserCollabs">
                L'utente che vuoi aggiungere collabora già con 5 blog
            </div>

            <div class="alert alert-danger" role="alert" id="collabError">
                Errore nell'aggiunta del nuovo collaboratore. Controllare la console.
            </div>

            <div class="alert alert-success" role="alert" id="successCollab">
                Questo utente adesso è un collaboratore del tuo blog
            </div>
        </div>

        <div class="row">
            <?php
            //calcolo il numero di collaborazioni del blog
            $blogCollabs = countBlogCollabs($conn, $blogCode);

            if ($blogCollabs["nCollabs"] < 5){
            ?>
                <form method="POST" action="includes/ajax/ajax-collabs-editing.php" enctype="multipart/form-data" id="addCollabsForm">

                    <div class="col-6">
                        <label for="addCollabForm" class="form-label">Aggiungi un collaboratore</label>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="addon-wrapping">@</span>
                            <input type="text" class="form-control" placeholder="Inserisci un nome utente" aria-describedby="addCollab" id="addCollabForm" name="addCollabForm">
                            <button class="btn btn-outline-success" type="submit" id="addCollab" name="addCollab">Aggiungi</button>
                        </div>
                    </div>
                </form>
            <?php
            } else {
            ?>
                <div class="alert alert-warning" role="alert" id="userNotFound">
                    Questo blog ha già 5 collaboratori, non puoi aggiungerne altri!
                </div>
            <?php
            }
            ?>
            <form method="POST" action="includes/ajax/ajax-collabs-editing.php" enctype="multipart/form-data" id="deleteCollabsForm">
                <div class="col-6">
                    <label for="addCollabForm" class="form-label">Elimina un collaboratore</label>

                    <div class="input-group">
                        <select class="form-select" id="inputGroupSelect04" aria-label="Elimina un collaboratore" id="deleteCollabName" name="deleteCollabName">
                            <option selected disabled>Scegli un collaboratore da eliminare</option>
                            <?php 
                            $blogCollabs = getBlogCollabs($conn, $blogCode);

                            foreach ($blogCollabs as $collab){
                                echo '<option value="'.$collab["nomeUtente"].'" >'.$collab["nomeUtente"].'</option>';
                            }
                            ?>
                        </select>

                        <button class="btn btn-outline-danger" type="submit" id="deleteCollab" name="deleteCollab">Elimina</button>
                    </div>
                </div>

                    <div class="alert alert-info" role="alert" id="collabDeleted">
                        Adesso l'utente selezionato non è più un collaboratore del tuo blog
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Fine form modifica blog-->

    </div>
</div>
