<?php get_header(); ?>

<div class="container author-page">
    <div class="author-main-info">
        <h1 class="profile-header text-center"> <?php the_author_meta('nickname'); ?> Page</h1>

        <div class="row author-meta">
            <div class='col-md-3'>
                <?php
                $avatar_args = array (  'class' => "img-fluid img-thumbnail rounded mx-auto d-block" );
                echo get_avatar(get_the_author_meta('ID'),256, '', 'user avatar', $avatar_args) 
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
                Number of posts published by user: <span class="posts-count">
                    <?php echo count_user_posts( get_the_author_meta('ID') ) ; ?></span>
            </p>
            <p class="author-stats">
                User profile Url :<?php the_author_posts_link(); ?>
            </p>

        </div> <!-- row end -->
    </div> <!-- end  of author main info-->

    <!-- start new row -->
    <div class="row author-stats">
        <div class="col-md-3">
            <div class="stats">
                Post Count <span> <?php echo count_user_posts(get_the_author_meta('id')); ?></span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
                Comments Count <span>
                    <?php
                    $comments_args  = array(
                        'user_id' => get_the_author_meta('id'),
                        'count' => true
                    );
                    echo get_comments($comments_args);

                    ?>

                </span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
                Total posts view <span>0</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
                Something for later use <span>0</span>
            </div>
        </div>
    </div> <!-- row end -->


    <div class="row author-all-posts">
        <!-- new row for the detailed publications -->

            <?php 

                // WP Query 
                    
                         $author_all_post = count_user_posts(get_the_author_meta('id'));
                         $author_ppp = 5;
                         $author_posts_args = array(
                             'author'                          => get_the_author_meta('id'),
                             'posts_per_page'         =>  $author_ppp  // -1 return all posts 
                         );
                         $author_post = new WP_Query($author_posts_args);

                        if ($author_post-> have_posts() ) { ?>
                            
                <div class="col-12 text-center all-posts-header-section">
                    <h3 class="all-posts-header">
                            <?php the_author_meta('nickname') ?> latest [ <?php echo $author_ppp <= $author_all_post ? $author_ppp : $author_all_post; ?> ] posts 
                        </h3>
                </div>
            <?php         
                            while ( $author_post->have_posts() ) {                  
                                $author_post->the_post(); ?>                   

            <div class="row author-posts">
                <div class="col-sm-2 image-section">
                    <?php the_post_thumbnail("", ["class" => "img-fluid img-thumbnail", "alt" => "place holder image", "title" => "post image"]); ?>
                </div><!-- end col -->

                <div class="col-sm-10">

                    <h3 class="post-title">
                        <a href='<?php   the_permalink( ); ?>'
                            title="<?php the_title_attribute( 'before=Permalink to: "&after="' ); ?>">
                            <?php   the_title( ); ?>
                        </a>
                    </h3>
                    <span class="post-date"><i class="far fa-calendar fa-fw"></i> Posted:
                        <?php the_date('F j, Y'); ?> at <?php the_time('g:i a'); ?>
                    </span>
                    <span class="post-comments"><i class="far fa-comments fa-fw"></i>
                        <?php  comments_popup_link( 'No comments yet', 'One comment', '% comments', 'comments-link', 'Comments are off for this post');?>
                    </span>

                    <div class="post-summary">
                        <?php echo wp_trim_words( get_the_content(), 15 ); ?>  <!--  show only a certain number of words-->
                        <!-- <a href="<?php echo get_permalink(); ?>"> Read more ... </a> -->
                    </div>
                </div>
            </div>
            <!-- <div class="clearfix"></div> -->
            <?php                                        
        } // end while             
        } // end if            
        wp_reset_postdata();  // resest loop

        $author_comments_per_page = 4;                   // to change it smoothly when we want to
        $author_all_comments = get_comments($comments_args);

        $author_comments_args = array (
            'user_id'                         => get_the_author_meta('id'),
            'status'                             => 'all',
            'post_status'                   => 'publish', 
            'number'                        => $author_comments_per_page,
            'post_type'                     => 'post'
        );

        $author_comments = get_comments($author_comments_args);

        if ($author_comments) : ?>
            <div class="col-12 text-center comments-header-section">
                <h3 class="comments-header"><?php the_author_meta('nickname') ?> latest [ <?php echo $author_comments_per_page <= $author_all_comments ? $author_comments_per_page : $author_all_comments; ?> ] comments </h3>
            </div>

            <?php

        foreach ($author_comments as $comment) :  ?>

                <div class="row comments-listing">
        
                            <div class="comment-title col-12">
                                <a href="<?php echo get_permalink($comment->comment_post_ID); ?>">
                                    <?php echo get_the_title($comment->comment_post_ID); ?>
                                </a>
                            </div>
        
                            <div class="comment-date col-12">
                                <i class="fas fa-calendar-alt"></i> <?php echo "Added on ".  mysql2date("d/m/Y", $comment->comment_date); ?>
                            </div>
        
                            <div class="comment-content col-12">
                                <?php echo $comment->comment_content; ?>
                            </div>


                </div> <!-- ./comments-listing -->
                
        <?php endforeach; ?>
        <?php else :
            echo "There is no commment belong to this user";
        endif;   ?>


    </div> <!-- row end for all posts/publications -->

</div> <!-- container end -->


<?php get_footer(); ?>