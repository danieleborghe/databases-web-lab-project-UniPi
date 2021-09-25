<div class="container py-5">
    <form method="POST" enctype="multipart/form-data" action="/progetto-sito/includes/actions/action-edit-article.php">
        
        <?php if( !empty( $args['article_insert_result'] ) ){ ?>
            <?php if( $args['article_insert_result']['result'] == "success"){ ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $args['article_insert_result']['notice']; ?>
                </div>
            <?php }else{ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $args['article_insert_result']['notice']; ?>
                </div>
            <?php } ?>
        <?php } ?>

        <input type="hidden" name="action" value="editArticle">
        <input type="hidden" name="articleID" value="<?php echo $args['article']['codiceArticolo']; ?>">

        <h4 class="mb-5 h2">Modifica articolo</h4>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input required value="<?php echo $args['article']['titolo']; ?>" type="text" class="form-control" id="addArticleTitle" placeholder="Titolo blog" name="articleTitle">
                    <label for="addArticleTitle">Titolo articolo</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label d-block">Copertina articolo attuale</label>
                <img height="200" width="400" alt="<?php echo $args['article']['titolo']; ?>" src="/progetto-sito/<?php echo $args['article']['feat_image']['posizioneContenuto']; ?>"/>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="addArticleImg" class="form-label">Copertina articolo (formati consentiti: .jpg, .gif, .png)</label>
                <input name="articleImage" class="form-control mb-3" type="file" id="addArticleImg">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <textarea required name="articleContent" class="js-custom-editor">
                    <?php echo $args['article']['testo']; ?>
                </textarea>
            </div>
        </div>

        
        <div class="row py-3">
            <div class="col">
                 <div class="mb-3">
                    <label class="form-label mb-3" for="addArticleTags">Digita i tag dell'articolo</label>
                    <input value="<?php echo $args['stringified_tags']; ?>" type="text" class="form-control tag-selector" id="addArticleTags" placeholder="Tags" name="articleTags">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col py-3">
                <button type="submit" class="btn btn-primary" aria-label="Modifica articolo">Modifica articolo</button>
            </div>
        </div>

    </form>
</div>