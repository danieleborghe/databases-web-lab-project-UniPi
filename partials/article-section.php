<div class="container-fluid section-padding <?php echo $args["tema"];?>">
    <div class="row text-white article-listing-section ">
        <h2 class="<?php echo $args["textColor"];?>"><?php echo $args['titolo']; ?></h2>
    </div>

    <div class="row article-section-row pb-2 g-2 justify-content-center">
        <?php if(!empty( $args['articoli'])){ ?>
            <?php foreach( $args['articoli'] as $articolo ){   
                includiComponente("article-card", array (
                    "title" => $articolo['titolo'],
                    "url" => "/progetto-sito/article.php?articleid=" . $articolo['codiceArticolo'],
                    "image" => $articolo['posizioneContenuto'],
                )); ?>
            <?php } ?>
        <?php } ?>
    </div>  
</div>