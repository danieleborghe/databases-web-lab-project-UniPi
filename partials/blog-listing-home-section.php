
<div class="container-fluid section-padding <?php echo $args["tema"]; ?>">
  <h2 class="blog-listing-section <?php echo $args["textColor"];?>" ><?php echo $args['titolo'];?></h2>

  <div class="row g-2 justify-content-center blog-listing-section">
        <?php if( !empty( $args['blog'] ) ){ 
            foreach( $args['blog'] as $blog ){ 
                includiComponente("blog-card", array(
                    "img" => $blog['posizioneImgProfilo'],
                    "titolo" => $blog['nomeBlog'],
                    "textColor" => "text-black",
                    "url" => $blog['url']
                ) );
            }
        }else{ ?>
            <p>Non ci sono blog disponibili</p>
        <?php } ?>
                
  </div>
</div>


