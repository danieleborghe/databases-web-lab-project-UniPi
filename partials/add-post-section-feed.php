<?php
//Verifico che esistano dei blog da cui attingere per creare un post, nel caso non ce ne siano viene mostrato
//il messaggio che si trova nell'else
if( !isset( $args['no_blogs'] ) ){ ?>
    <div class="js-create-post create-post-form w-100 py-4 container container-size-small">

        <h3 class="title mb-3 h4 py-3">Aggiungi un post</h3>

        <?php if( !empty( $args['post_insert_result'] ) ){ ?>
            <?php if( $args['post_insert_result']['result'] == "success"){ ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $args['post_insert_result']['notice']; ?>
                </div>
            <?php }else{ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $args['post_insert_result']['notice']; ?>
                </div>
            <?php } ?>
        <?php } ?>

        <div class="row">
            <div class="col-12">
                <form class="create-pots-form w-100" method="POST" action="/progetto-sito/includes/actions/action-add-post.php" enctype="multipart/form-data">
                    
                    <input type="hidden" name="action" value="add-post">

                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" required class="form-control" id="addPostTitle" placeholder="Titolo post" name="postTitle">
                                <label for="addPostTitle">Titolo post</label>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <textarea required class="form-control height-small" placeholder="Scrivi un commento qui" id="addPostTextArea" name="postText"></textarea>
                                <label for="addPostTextArea">Testo</label>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <?php 
                                /*      
                                    Verifico che la lista dei blog a cui associare il post non sia vuota, e nel caso
                                    stampo i blog nella select con id addPostBlogSelect
                                */ ?>
                                <select required class="form-select" id="addPostBlogSelect" aria-label="Seleziona blog" name="blogId">
                                    <option value="">Seleziona un blog</option>
                                    <?php foreach( $args['blogs_1'] as $blog ){ ?>
                                        <option value="<?php echo $blog[2]; ?>"><?php echo $blog[0]; ?></option>
                                    <?php } ?>
                                    <?php foreach( $args['blogs_2'] as $blog ){ ?>
                                        <option value="<?php echo $blog[2]; ?>"><?php echo $blog[0]; ?></option>
                                    <?php } ?>
                                </select>

                                <label for="addPostBlogSelect">Blog in cui aggiungere il post</label>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <select required class="post-type-selector form-select" id="addPostTypeSelect" aria-label="Seleziona blog" name="postType">
                                    <option value="">Seleziona tipologia</option>
                                    <option data-type="audio" value="audio">Audio</option>
                                    <option data-type="image" value="immagine">Immagine</option>
                                    <option data-type="link" value="link">Link</option>
                                    <option data-type="text" value="testo">Testo</option>
                                    <option data-type="video" value="video">Video</option>
                                </select> 

                                <label for="addPostBlogSelect">Tipologia di post</label>
                            </div>
                        </div>
                    </div>

                    <div class="post-type-specifics">
                        
                        <div data-type="link">
                            <div class="row">
                                <div class="col">
                                    <label for="addPostFormLink">Link</label>
                                    <input required class="form-control mb-3" disabled type="text" id="addPostFormLink" name="link">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="addPostFormImgLink" class="form-label">Immagine (formati consentiti: .jpg, .gif, .png)</label>
                                    <input name="image" required class="form-control mb-3" disabled type="file" id="addPostFormImgLink">
                                </div>
                            </div>
                        </div>

                        <div data-type="image">
                            <div class="row">
                                <div class="col">
                                    <label for="addPostFormFile" class="form-label">Carica una o più immagini (formati consentiti: .jpg, .gif, .png)</label>
                                    <input name="images[]" required class="form-control mb-3" disabled multiple type="file" id="addpostFormFile">
                                </div>
                            </div>
                        </div>

                        <div data-type="video">
                            <div class="row">
                                <div class="col">
                                    <label for="addPostFormVideo" class="form-label">Carica un video (formato consentito: .mp4)</label>
                                    <input name="video" required id="addPostFormVideo" class="form-control mb-3" disabled type="file">
                                </div>
                            </div>
                        </div>

                        <div data-type="audio">
                            <div class="row">
                                <div class="col">
                                    <label for="addPostFormAudio" class="form-label">Carica un audio (formati consentiti: .mp3, .wma)</label>
                                    <input name="audio" required id="addPostFormAudio" class="form-control mb-3" disabled type="file">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col py-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" aria-label="Aggiungi post">Aggiungi post</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
<?php }else{ ?>
    <div class="container w-100 py-5 container container-size-small text-center">
        <h3 class="h5 mb-3">Ops! Sembra che tu non abbia un blog o collaborazioni attive, creane subito uno e inizia a pubblicare i tuoi post!</h3>
        <a class="btn btn-primary" href="/progetto-sito/create-blog.php" title="Crea subito un blog">Crea un blog</a>
    </div>
<?php } ?>