<div class="container-fluid section-padding <?php echo $args["tema"];?>">
    <div class="row text-white article-home-section-row">
        <h2 class="<?php echo $args["textColor"];?> pb-5"><?php echo $args['titolo']; ?></h2>
    </div>

    <div class="row pb-2 g-2 justify-content-center article-section.row">
        <?php if( !empty( $args['articoli'] ) ){ 
            foreach( $args['articoli'] as $articolo ){ 
                includiComponente("article-card", array(
                    "image" => $articolo['feat_img'],
                    "title" => $articolo['titolo'],
                    "url" => $articolo['url'],
                ) );
            }
        }else{ ?>
            <h4 class="h5 text-center p-3">Non ci sono articoli da vedere</h4>
        <?php } ?>
    </div>
</div>