<?php 

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

if ($query->have_posts()) {?>
  
<div class="relative-posts">
 
 <div class="relative-posts-header d-flex">
     <p>آهنگ های مرتبط</p>

 </div>

   <div class="relative-post-boxes">

  <?php while($query->have_posts()) {
     $query->the_post();?>
<a href="<?php echo the_permalink(); ?>">
<div class="relative-post-box">
         <?php 
    if (has_post_thumbnail(get_the_ID()) ) {
          the_post_thumbnail();
    }

    else {?>

<img src="<?php echo get_theme_file_uri("/img/not-image.jpeg") ?>" alt="image not set">

   <?php }
      
          ?>
         <div class="relative-detail">
         <p class="relative-author"><?php echo $artist_meta[0]->name; ?></p>
         <p class="relative-music"> <?php the_field("music-name"); ?> </p>
         </div>
     </div>
     </a> 
 <?php } 
 wp_reset_postdata();
 ?>

 </div>
 


 </div>
<?php } 

else 
{
  
  $categories = get_the_category();
  foreach($categories as $category){
    $rel_cat[] = $category->cat_ID;
  }
  $rep_args = array(
    'post__not_in' => array($postid), 
    'category__in' => $rel_cat, 
    'posts_per_page' => 8, 
    'orderby' => 'rand' 
  );

  $rep_query = new wp_query($rep_args);

  if ($rep_query->have_posts()) {?>
  <div class="relative-posts">
 
 <div class="relative-posts-header d-flex">
     <p>آهنگ های مرتبط</p>
     <div class="relative-posts-border"></div>
 </div>

   <div class="relative-post-boxes">
    <?php
  while ($rep_query->have_posts()) {
    $rep_query->the_post();?>
<a href="<?php the_permalink(); ?>">
<div class="relative-post-box">
<?php 
    if (has_post_thumbnail(get_the_ID()) ) {
          the_post_thumbnail();
    }

    else {?>

<img src="<?php echo get_theme_file_uri("/img/not-image.jpeg") ?>" alt="image not set">

   <?php }
      
          ?>
         <div class="relative-detail">
			 <?php $artist_meta = get_the_terms( get_the_ID(), "artist" );
$postid = get_the_ID();?>
         <p class="relative-author"><?php echo $artist_meta[0]->name; ?></p>
         <p class="relative-music"> <?php the_field("music-name"); ?> </p>
         </div>
     </div>

  <?php
  }
  wp_reset_postdata();
    ?>

</a> 
 <?php }

?>

</div>
 


 </div>

<?php 
}
?>
  


