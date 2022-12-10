<?php 
    $args = [ 'post_type' => 'my_news', 'post_per_page' => -1, 'order' => 'DESC', 'orderby' => 'id'  ];
    $news = new WP_Query( $args );
?>
<?php if ( $news->have_posts() ): ?>
<div class="row hidden-xs">
    <div class="col-md-12">
        <div class="news-ticker clearfix">
            <div class="news-title">
                <h3>Trending News</h3>
            </div>
            <ul id="ticker">
                <?php while ( $news->have_posts() ) : $news->the_post() ?>
                    <li><?php the_content(); ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif ?>