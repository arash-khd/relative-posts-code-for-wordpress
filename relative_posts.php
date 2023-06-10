<?php 
// relative posts based on artist name texonemy
$artist_meta = get_the_terms( get_the_ID(), "artist" );
$postid = get_the_ID();
$args = array(
  'post__not_in'=> array($postid),
  'posts_per_page' => 8,
  'tax_query' => array(
    array (
        'taxonomy' => 'artist',
        'field' => 'slug',
        'terms' => $artist_meta[0]->name,
        
        
    )
),
);
$query = new WP_Query($args);

?>