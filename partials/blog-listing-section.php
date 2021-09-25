
<div class="container-fluid <?php echo $args["tema"]; ?>" style="padding: <?php echo $args["padding"]; ?>">
  <h2 class=" blog-listing-section <?php echo $args["textColor"];?>" ><?php echo $args['titolo']; ?></h2>


    <div class="row g-3">
        <?php if( !empty( $args['listaBlog']) ){ ?>
            <?php foreach( $args['listaBlog'] as $blog ){ ?>

                <?php includiComponente("blog-card", array(
                        "img" => "/progetto-sito/" . $blog['posizioneImgProfilo'],
                        "titolo" => $blog['nomeBlog'],
                        "url" => "/progetto-sito/blog.php?blogCode=" . $blog['codiceBlog'],
                        "textColor" => "text-black"
                    )
                ); ?>
            <?php } ?>
        <?php } ?>
    </div>

</div>
