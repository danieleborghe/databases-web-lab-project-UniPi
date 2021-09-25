<?php $accordion_css_id = generateRandomString(10); ?>
    
<div class="single-post-comments" id="accordion-<?php echo $accordion_css_id; ?>">

    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#<?php echo $accordion_css_id; ?>" aria-expanded="false" aria-controls="collapse<?php echo $accordion_css_id; ?>">
        Commenti <span class="single-post-comments-badge badge bg-secondary ms-2"><?php echo count($args['comments']); ?></span>
    </button>

    <div id="<?php echo $accordion_css_id; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo $accordion_css_id; ?>" data-bs-parent="#accordion-<?php echo $accordion_css_id; ?>">
        <div class="single-post-comments-add px-3 py-3">
        <?php
        if (!$args['comments_limit']){
        ?> 
            <form method="POST" action="/progetto-sito/includes/ajax/ajax-post-comment.php" class="single-post-comments-form input-group">
                <textarea name="comment" type="text" class="form-control comment-content" placeholder="Scrivi qui il tuo commento"></textarea>
                <button class="btn btn-outline-primary" type="submit"
                    id="button-addon2">Invia</button>
            </form>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Hai commentato abbastanza questo post per oggi
            </div>
        <?php
        }
        ?>
        </div>

        <div class="single-post-comments-list">
            <div class="single-post-comment px-3 py-3 d-none single-post-comment-template">
                <div class="user-details mb-2 d-flex justify-content-between">
                    <div class="user-info">
                        <?php if( !empty( $args['current_author']['posizioneImgProfilo'] ) ){ ?>
                            <img src="<?php echo $args['current_author']['posizioneImgProfilo']; ?>" alt="" width="32" height="32"
                            class="rounded-circle me-2">
                        <?php }else{ ?>
                            <img src="/progetto-sito/assets/img/default.jpg" alt="" width="32" height="32"
                            class="rounded-circle me-2">
                        <?php } ?>
                        <span class="user-name"><?php echo $args['current_author']['nomeUtente']; ?></span>
                    </div>
                    
                    <div class="comment-meta">
                        <span><small class="date"></small></span>
                        &nbsp;
                        <span><button class="single-post-comments-delete-comment btn btn-outline-danger delete-btn btn-sm">Elimina</button></span>
                    </div>
                </div>

                <div class="comment-content">
                    
                </div>
            </div>

            <?php if( !empty( $args['comments'] ) ){ ?>
                <?php foreach( $args['comments'] as $comment ){ ?>
                    <div data-comment-id="<?php echo $comment['codiceCommento']; ?>" class="single-post-comment px-3 py-3">
                        <div class="user-details mb-2 d-flex justify-content-between">
                            <div class="user-info">
                                <?php if( !empty( $comment['posizioneImgProfilo'] ) ){ ?>
                                <img src="<?php echo $comment['posizioneImgProfilo']; ?>" alt="" width="32" height="32"
                                class="rounded-circle me-2">
                                <?php }else{ ?>
                                <img src="/progetto-sito/assets/img/default.jpg" alt="" width="32" height="32"
                                class="rounded-circle me-2">
                                <?php } ?>
                                <span class="user-name"><?php echo $comment['nomeUtente']; ?></span>
                            </div>
                            <div class="comment-meta">
                                <span><small class="date"><?php echo $comment['dataOra']; ?></small></span>
                                <?php if($comment['can_delete']){?>
                                    &nbsp;
                                    <span><button class="single-post-comments-delete-comment btn btn-outline-danger delete-btn btn-sm">Elimina</button></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>
                                <?php echo $comment['testo']; ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>