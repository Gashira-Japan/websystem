<?php
/**
 * The template for displaying all pages
 *
 * @package TenFive_Recruit
 */

get_header();
?>

<main class="main-content">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="container">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>

    <?php endwhile; ?>
</main>

<?php
get_footer();
