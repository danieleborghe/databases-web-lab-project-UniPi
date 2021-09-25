<div class="d-flex">
    <?php
        if( !isset( $args['hidden_sidebar'] ) ){
            includiComponente("feed-sidebar", array( "current_user" => $args['current_user'], "username" => $args['username'], "blog_seguiti" => $args['blog_seguiti'], "user" => $args['current_user'] ) );
        }
    ?>

    <div class="feed-stream col">
        <?php 
            //Mostro il form di creazione dei post solo ad utenti che collaborano con un blog o che ne hanno già creato uno
            if( empty( $args['blog_utente'] ) && empty( $args['blog_collabs'] ) ){
                //In base al valore dell'attributo $args['create_post_mode'] so se devo includere l'add-post-section relativo al feed oppure al blog
                if( $args['create_post_mode'] == "feed" ){
                    includiComponente("add-post-section-feed", array( "current_user" => $args['current_user'], "no_blogs" => true ));
                }else{
                    includiComponente("add-post-section", array( "hide_post_creation" => true, "current_user" => $args['current_user'], "no_blogs" => true ));
                }
            }else{
                //In base al valore dell'attributo $args['create_post_mode'] so se devo includere l'add-post-section relativo al feed oppure al blog
                if( $args['create_post_mode'] == "feed" ){
                    includiComponente("add-post-section-feed", array( "current_user" => $args['current_user'], "post_insert_result" => $args['post_insert_result'], "blogs_1" => $args['blog_utente'], "blogs_2" => $args['blog_collabs'] ));
                } else {
                    if($args["todayPosts"] < 10){
                        includiComponente("add-post-section", array( "hide_post_creation" => $args['hide_post_creation'], "current_user" => $args['current_user'], "blogId" => $args['blogId'], "post_insert_result" => $args['post_insert_result'] ));
                    } else {
                    ?>
                        <div class="alert alert-warning" role="alert">
                            Hai raggiunto il numero massimo di post consentiti per oggi per questo blog
                        </div>
                    <?php
                    }
                }
            }

            includiComponente("list-post", array( "current_author" => $args['current_user'], "posts" => $args['posts'] ));
        ?>    
    </div>


</div>