<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tide
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-item'); ?>">
<header class="entry-header">
    <?php
    echo '<div class="tide-author-section clearfix">';
        echo '<div class="tide-author-img">'.get_avatar(get_the_author_meta('ID'), '32').'</div>';
        echo '<div class="tide-author-name">'. get_the_author_meta('nickname') .'</div>';
    echo '</div>';
    if (get_the_post_thumbnail()) {
        echo '<div class="masonry-image">';
            echo '<a class="more-link" href="' . get_permalink() . '">';
                the_post_thumbnail();
            echo '</a>';
        echo '</div>';
    }
    ?>
</header><!-- .entry-header -->

<div class="entry-content">
    <?php
    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
    echo '<div class="masonry-tags">';
        the_tags('');
    echo '</div>';
    the_excerpt();

    wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'tide'),
        'after' => '</div>',
    ));
    ?>
</div><!-- .entry-content -->

<footer class="entry-footer">
    <?php
    if( is_home() ) {
        echo '<a class="more-link" href="' . get_permalink() . '">'.__("Read More", "tide").'</a>';
    }
    ?>
</footer><!-- .entry-footer -->
</article><!-- #post-## -->
