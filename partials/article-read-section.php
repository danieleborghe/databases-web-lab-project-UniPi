<div data-article-id="<?php echo $args['article']['codiceArticolo']; ?>" class="js-article container article">
    <div class="posts-container my-5" >

        <?php
            //Controllo se nella pagina article.php è stato definito l'indice "show_edit_bar", in tal caso, se valorizzato true
            //vuol dire che devo mostrare la "barra" di modifica dell'articolo che contiene il link alla pagina edit-article.php
            //e il tasto di eliminazione
             if( $args['show_edit_bar'] ){ ?>
            <div class="article-controls d-flex justify-content-end">
                <div class="mx-2">
                    <a class="btn btn-primary" href="/progetto-sito/edit-article.php?articleid=<?php echo $args['article']['codiceArticolo']?>" title="Modifica articolo">Modifica articolo</a>
                </div>      
                <div>    
                    <?php 
                    //Creo un piccolo form, con degli input nascosti che viene inviato al click del pulsante "Elimina articolo" e 
                    //Dopo aver richiesto all'utente tramite la onsubmit se è sicuro di voler effettuare l'eliminazione procede a rimuoverlo ?>
                    <form onsubmit="return confirm('Vuoi davvero eliminare l\'articolo?');" method="POST" action="/progetto-sito/includes/actions/action-delete-article.php">      
                        <input type="hidden" name="action" value="deleteArticle">
                        <input type="hidden" name="articleId" value="<?php echo $args['article']['codiceArticolo']; ?>">   
                        <button type="submit" class="btn btn-danger" title="Elimina articolo">Elimina articolo</button>
                    </form>
                </div>
            </div>
        <?php } ?>

        <div class="post">
            <h1 class="h1 post-title mb-3"><?php echo $args['article']['titolo']; ?></h1>

            <div class="d-flex align-items-center mb-4 text-muted author-info row p-0">
                <div class="col-6">
                    <img alt="" src="<?php echo $args['blog']['posizioneImgProfilo']; ?>" class="mb-0 mr-2 avatar-small rounded-circle" loading="lazy" width="40" height="40">
                    
                    <span class="author-name mx-2"><a href="/progetto-sito/blog.php?<?php echo('blogCode='.$args["blog"]["codiceBlog"]);?>" rel="author"><?php echo $args['blog']['nomeBlog']; ?></a></span>
                    </a>
                </div>
                <div class="col-6 text-end">
                    <img class="mx-2" alt="<?php echo $args['blog']['posizioneImgProfilo']; ?>" src="/progetto-sito/assets/img/agenda.png" width="30" height="30"></img>
                    <span><?php echo customDateFormat( $args['article']['dataScrittura'] ); ?></span>
                </div>
            </div> 
                
            <?php if( !empty( $args['feat_image'] ) ){ ?>
                <div class="d-flex align-items-center mb-5">
                    <img alt="<?php echo $args['article']['titolo']; ?>" src="<?php echo "/progetto-sito/" . $args['feat_image']['posizioneContenuto']; ?>" width="600" height="400" class="mx-auto"/>
                </div>
            <?php } ?>

            <div class="col mb-5 article-content">
                <?php echo $args['article']['testo']; ?>
            </div>
            <?php if( !empty( $args['tags'] ) ){ ?>
                <div class="tags mb-4">
                    <?php foreach( $args['tags'] as $tag ){ ?>
                        <span class="badge rounded-pill bg-primary text-light p-3"><?php echo $tag['chiaveTag']; ?></span>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php includiComponente("single-article-vote", $args ); ?>
        <?php includiComponente("single-article-comments-list", $args); ?>

    </div>
</div>




