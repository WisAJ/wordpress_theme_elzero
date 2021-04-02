<?php 
        get_header(); 
        include(get_template_directory(  ) . '/includes/breadcrumb.php'); 

?>

<div class="container">
    <?php 
                if ( have_posts() ) {
	                while ( have_posts() ) {
		                    the_post(); ?>

    <div class="main-post single-post">
        <?php edit_post_link('Edit <span><i class="fas fa-edit fa-fw"></i></span>'); ?>
        <h3 class="post-title">
            <a href='<?php   the_permalink( ); ?>'
                title="<?php the_title_attribute( 'before=Permalink to: "&after="' ); ?>">
                <?php   the_title( ); ?>
            </a>

        </h3>
        <span class="post-author"><i class="far fa-user fa-fw"></i>
            <?php the_author_posts_link(); ?>
        </span>

        <span class="post-date"><i class="far fa-calendar fa-fw"></i> Posted:
            <?php the_date('F j, Y'); ?> at <?php the_time('g:i a'); ?>
        </span>

        <span class="post-comments"><i class="far fa-comments fa-fw"></i>
            <?php  comments_popup_link( 'No comments yet', 'One comment', '% comments', 'comments-link', 'Comments are off for this post');?>
        </span>

        <div class="row">
            <div class="col">
                <?php the_post_thumbnail('', ['class'=> 'img-res', 'title' => 'Feature image']); ?>
            </div>

            <div class="col">

                <div class="post-summary">
                    <?php the_content('&raquo; &raquo; &raquo; &raquo;'); ?>
                </div>
            </div>
        </div>

        <hr>
        <p class="post-categories">
            <i class="fa fa-tags fa-fw"></i>
            <?php the_category( ',  ' ); ?>
        </p>

        <p class="post-tags">
            <?php if(has_tag()) {
                                                    the_tags( 'Social tagging: ',' > ' );
                                                   } else {
                                                       echo 'There\'s no tag to show';
                                                   }
                                  ?>
        </p>
    </div>

    <?php 
                          
	} // end while
} // end if   
// end of post main section
//  start of category section 
//  four methods to get the ID, 
// global $post; echo $post ->ID.   '<br>';   // 1  echo get_queried_object_id(  ).  '<br>'; //2  echo 'The current post ID is: '.get_the_ID(). '<br>'; //3

// Get the category  and  ...print_r( wp_get_post_categories( get_queried_object_id(  ))) ; //4  and this produce an array which is needed for cateogry__in!

     $random_posts_args = array (
        'posts_per_page'      => 3,
        'orderby'                     => 'rand',
        'category__in'          => wp_get_post_categories(  get_queried_object_id( )), // gives an array, which we need for cat__in
        'post__not_in'          => array( get_queried_object_id( )), 
     );

    $random_post = new WP_Query($random_posts_args);
    if ($random_post-> have_posts() ) { 
        
        while ( $random_post->have_posts() ) {                  
            $random_post->the_post(); ?>                   
                <h3 class="post-title">
                    <a href='<?php   the_permalink( ); ?>'
                        title="<?php the_title_attribute( 'before=Permalink to: "&after="' ); ?>">
                        <?php   the_title( ); ?>
                    </a>
                </h3>
                <hr>
                    <?php                                        
                 } // end while             
                    } // end if            
     wp_reset_postdata();  // resest loop




echo '<hr class="comment-separator">';  ?>

    <div class='row'>
        <div class='col-md-3'>
            <?php

                $avatar_args = array (  'class' => "img-fluid img-thumbnail rounded mx-auto d-block" );

                 echo get_avatar(get_the_author_meta('ID'), 64, '', 'user avatar', $avatar_args) 

            ?>

        </div>
        <div class='col-md-9 author-info'>

            <h4>
                <?php the_author_meta('first_name') ?>
                <?php the_author_meta( 'last_name') ?>
                (<?php the_author_meta('nickname') ?>)
            </h4>

            <?php if (get_the_author_meta("description" )) { ?>
            <p class="lead">
                <?php the_author_meta('description') ?>
            </p>
            <?php } else {  echo '<p> There\'s no Biography </p>'; } ?>

        </div>
       
        <hr>
      
        <p class="author-stats">
            Number of posts published by user: <span class="posts-count"> <?php echo count_user_posts( get_the_author_meta('ID') ) ; ?></span> </p>
        <p class="author-stats"> 
            User profile Url :<?php the_author_posts_link(); ?></p>

       

    </div>

    <?php

    echo '<hr class="comment-separator"> ';
    echo '<div class="post-pagination"> ';

       if (get_previous_post_link()) {
         previous_post_link('%link', ' <i class="fas fa-chevron-left fa-fw"></i>  %title' );
      } else {
       echo "<span class='prev'> Prev</span>";
      }

      if (get_next_post_link()) {
         next_post_link('%link', ' %title  <i class="fas fa-chevron-right fa-fw"></i>');
      } else {
       echo "<span class='next'> Next </span>";
      }

    echo     '</div>' ;   

    echo '<hr class="comment-separator">';
    comments_template();
    
?>
</div>




<?php get_footer(); ?>


<!-- <?php the_content('&raquo; &raquo; &raquo; &raquo;'); ?>  can be used also instead of excerpt()-->