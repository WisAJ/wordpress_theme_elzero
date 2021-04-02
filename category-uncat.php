<?php get_header(); ?>

<div class="container category-page">
<div class="row text-center cat-info">
        <div class="align-middle col-md">
            <h1 class="cat-title"><?php single_cat_title(); ?></h1>
        </div>
        <div class="col-md">
            <div class="mt-3 cat-desc"><?php echo category_description(); ?></div>
        </div>
        <div class="col-md">
            <div class="cat-stats">
                <span> Posts Count: 20, </span>
                <spa >this is for the uncat items</span>
            </div>
        </div>
    </div> <!-- ./cat-info --> 

    <div class="row">
        <div class="col-sm-8">
         <?php 
                if ( have_posts() ) {
	                while ( have_posts() ) {
		                    the_post(); ?>
                    
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
                          
                            <?php 
                          
	                                        } // end while
                                                } // end if    ?>

        </div>    <!-- end of div md 9 -->

       <!-- dynamic_sidebar -->

        <div class="col-sm-4 sidebar-new">
            <?php if (is_active_sidebar('main-sidebar')) {
                dynamic_sidebar('main-sidebar');
            
                // get_sidebar('new'); // the default wordpress sidebar  
            }
            ?>
        </div>
 </div>  <!-- end row -->


                <!--  start pagination from here, function are in function.php file. -->

        <div class="pagingation_num">
            <?php echo numbering_pagination(); ?>
        </div>


</div>



<?php get_footer(); ?>


     <!-- <?php the_content('&raquo; &raquo; &raquo; &raquo;'); ?>  can be used also instead of excerpt()-->

     