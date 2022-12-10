<?php get_header(); ?>
    <div class="container sitecontainer bgw">
        <!--BEGIN NEWS HERE-->
        <?php get_template_part( 'templates/news'); ?>        
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <!--BEGIN SLIDER HERE-->
                <?php get_template_part( 'templates/slider'); ?>                
                <div class="widget searchwidget indexslider">

                    <?php if (have_posts() ) :
                        while( have_posts() ):
                            the_post() ?>
                            <?php get_template_part( 'templates/content', get_post_format() ) ?>
                        <?php endwhile ?>
                         <?php //laptopfusion_paging_nav(); ?>
                         <?php //laptopfusion_numbered_pagination() ?>
                    <?php else: ?>
                        <?php get_template_part('templates/content-none'); ?>
                    <?php endif ?>
                </div>
                <!-- BEGIN LATEST POST -->
                <?php get_template_part( 'templates/latest' ); ?>
            <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="ads-widget">
                                <a href="#"><img src="<?php echo ot_get_option('footer_banner') ?>" alt="" class="img-responsive"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <?php get_sidebar(); ?>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
        <!-- end container -->
        <?php get_footer(); ?>