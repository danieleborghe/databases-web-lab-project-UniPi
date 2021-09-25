  
    <!--</section>-->
    <!-- #middle-section -->
        <section id="footer-section">
            <footer class="bgColorBlack">
                <div class="container py-5">
                    <!--Grid row-->
                    <div class="row">
                        <!--Grid column-->
                        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                            <h3 class="text-uppercase text-white mb-2">Clique</h3>

                            <p class="text-white">
                                Il tuo blog a portata di clique.
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-4 py-3 mb-md-0 text-end text-white">
                            <span class="mx-auto">  
                                © 2021 Copyright &middot; clique.com
                            </span>
                        </div>
                    </div>
                    <!--Grid row-->
                    </div>
                    <!-- Grid container -->
            </footer>
        </section>

        </main>
        <!-- #main-content -->

        <script src="/progetto-sito/assets/js/bootstrap.js"></script>
        <script src="/progetto-sito/assets/js/main.js"></script>  
        <?php if( !empty( $args['script_list'] ) ){ ?>
            <?php foreach( $args['script_list'] as $script ){ ?>
                <script type="text/javascript" src="<?php echo $script; ?>"></script>
            <?php } ?>
        <?php } ?>
    </body>
</html>