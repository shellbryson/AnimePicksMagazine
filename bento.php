<?php
/*
Template Name: Bento
*/

// if you are not using this in a child of Twenty Eleven, you need to replicate the html structure of your own theme.

// assign this template to a page in AP, to vi

get_header(); ?>

<section class="bento">

<?php

$apBentoCategory = "Bento Box";

$args = array(
    'numberposts'     => 99,
    'offset'          => 0,
    'category'        => get_cat_ID( $apBentoCategory ),
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    //'include'         => ,
    //'exclude'         => ,
    //'meta_key'        => ,
    //'meta_value'      => ,
    'post_type'       => 'post',
    //'post_mime_type'  => ,
    //'post_parent'     => ,
    'post_status'     => 'publish',
    'suppress_filters' => true );

$posts_array = get_posts( $args );

foreach( $posts_array as $post ) : setup_postdata( $post );

?>

    <article class="snack"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></article>

<?php
endforeach;
?>

</section>

<?php get_footer(); ?>