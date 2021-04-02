<?php
$all_cats = get_the_category(); // get all info about the categories of this posts
// echo '<pre>';
// print_r($all_cats);
// echo '</pre>';

?>


<div class="breadcrumb-holder">
    <nav class="container" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo get_home_url(); ?>" target="_blank">
                    <?php bloginfo('name'); ?>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo esc_url(get_category_link($all_cats[0]->term_id)); ?>" target="_blank">
                    <?php echo esc_html($all_cats[0]->name);  ?>
                </a>
            </li>
            <li class="breadcrumb-item active">
            <?php echo get_the_title( );  ?>
            </li>
        </ol>
</nav>

</div>