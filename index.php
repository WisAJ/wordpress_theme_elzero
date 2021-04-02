<?php get_header(); ?>

<div class="container">
    <div class="row">
         <?php 
                if ( have_posts() ) {
	                while ( have_posts() ) {
		                    the_post(); ?>
                           <div class="col-md-6">
                              <div class="main-post">
                                 <h3 class="post-title">
                                    <a  href= '<?php   the_permalink( ); ?>'
                                           title="<?php the_title_attribute( 'before=Permalink to: "&after="' ); ?>"
                                    >
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
                              <?php the_post_thumbnail('', ['class'=> 'img-res', 'title' => 'Feature image']); ?>

                              <div class="post-summary">
                              <?php the_excerpt(); ?>
                              <a href="<?php echo get_permalink(); ?>"> Read more ... </a>
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
                            </div>
                            <?php 
                          
	} // end while
} // end if   

// start pagination from here, without numbers
 echo '<div class="post-pagination"> ';

       if (get_previous_posts_link()) {
         previous_posts_link( '<i class="fas fa-chevron-left"></i>  Prev' ) ;
      } else {
       echo "<span class='prev'> Prev</span>";
      }

      if (get_next_posts_link()) {
         next_posts_link( 'Next   <i class="fas fa-chevron-right fa-fw"></i>' );
      } else {
       echo "<span class='next'> Next </span>";
      }
 echo     '</div>' ;   

 ?>

<!--  start pagination from here, function are in function.php file. -->

<div class="pagingation_num">
      <?php echo numbering_pagination(); ?>
 </div>

    </div>
</div>



<?php get_footer(); ?>


     <!-- <?php the_content('&raquo; &raquo; &raquo; &raquo;'); ?>  can be used also instead of excerpt()-->

     