<div class="article-comments content-item py-4"> 
    <div class="row">
        <div class="col-12">   
            <h3 class="pull-left mb-5">Commenti</h3>

            <?php if( $args['show_comment_form'] !== false ){ ?>
            <form class="article-new-comment-form mb-5" action="includes/ajax/ajax-article-comment.php" method="POST">
                <div class="row mb-4">
                    <div class="col-1 text-center">
                        <div class="avatar-sm">
                            <?php if( !empty( $args['current_user']['posizioneImgProfilo'] ) ){ ?>
                                <img class="img-responsive rounded-circle" src="<?php echo $args['current_user']['posizioneImgProfilo']; ?>" alt="<?php echo $args['current_user']['nomeUtente']; ?>" whidt= "50" height= "50">
                            <?php }else{ ?>
                                 <img class="img-responsive rounded-circle" src="/progetto-sito/assets/img/default.jpg" alt="<?php echo $args['current_user']['nomeUtente']; ?>" whidt= "50" height= "50">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-floating mb-3">
                            <textarea class="comment-content form-control height-small" id="articleComment" placeholder="Comment" name="articleComment"></textarea>
                            <label for="articleComment">Inserisci il tuo commento</label>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <div class="d-flex justify-content-end">
                            <div class="article-comment-notice small alert alert-danger d-inline-block d-none">Non è stato possibile inserire il commento, riprova più tardi.</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="edit-button btn btn-primary" name="submitButton">Invia</button>
                        </div>
                    </div>
            
                </div>  	
            </form>
            <?php } ?>

            <div class="article-comments-list">

                <?php if( !empty( $args['current_user'] ) ){ ?>
                <div class="article-single-comment article-single-comment-template rounded new d-none py-4 row mb-3">
                    <div class="row mb-2 pb-2">
                        <div class="col-1 text-center">
                            <div class="avatar avatar-sm">
                                <?php if( !empty( $args['current_user']['posizioneImgProfilo'] ) ){ ?>
                                    <img class="img-responsive rounded-circle" src="<?php echo $args['current_user']['posizioneImgProfilo']; ?>" alt="<?php echo $args['current_user']['nome']; ?>" width= "50" height= "50">
                                <?php }else{ ?>
                                    <img class="img-responsive rounded-circle" src="/progetto-sito/assets/img/default.jpg" alt="<?php echo $args['current_user']['nome']; ?>" width= "50" height= "50">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="d-flex align-center article-single-comment-meta">
                                <h4 class="media-heading mb-3 article-single-comment-username"><?php echo $args['current_user']['nomeUtente']; ?></h4>
                                <span class="article-single-comment-date mx-3"></span>
                                <span><button class="single-article-comments-delete-comment btn btn-outline-danger delete-btn btn-sm">Elimina</button></span>
                            </div>
                            <div class="article-single-comment-text">
                                <p></p> 
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if( !empty( $args['comments'] ) ){ ?>
                    <?php foreach( $args['comments'] as $comment ){ ?>
                        <div data-comment-id="<?php echo $comment['codiceCommento']; ?>" class="article-single-comment py-4 row mb-3">
                            <div class="row mb-2 pb-2">
                                <div class="col-1 text-center">
                                    <div class="avatar avatar-sm">
                                        <img class="img-responsive rounded-circle" src="<?php echo $comment['posizioneImgProfilo']; ?>" alt="<?php echo $comment['nomeUtente']; ?>" width= "50" height= "50">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div class="d-flex align-center article-single-comment-meta">
                                        <h4 class="media-heading mb-3 article-single-comment-username"><?php echo $comment['nomeUtente']; ?></h4>
                                        <span class="article-single-comment-date mx-3"><?php echo $comment['dataOra']; ?></span>
                                        <?php if( isset( $comment['can_delete'] ) && $comment['can_delete'] == true ){ ?>
                                            <span><button class="single-article-comments-delete-comment btn btn-outline-danger delete-btn btn-sm">Elimina</button></span>
                                        <?php } ?>
                                    </div>
                                    <div class="article-single-comment-text">
                                        <p><?php echo $comment['testo']; ?></p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>