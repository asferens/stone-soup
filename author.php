<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Stone_Soup
 */
get_header(); ?>

<div class="entry-content">

<!-- This sets the $curauth variable -->
    
    <ul class="bio-desc">
        <li>
            <?php
            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
            ?>

            <h2><?php echo $curauth->nickname; ?></h2>
            <p><?php echo $curauth->user_description; ?></p>

        </li>
    </ul>

    <ul class="bio-info">
        <li class="bio-post-cont">

            <h2>Articles by <?php echo $curauth->nickname; ?>:</h2>
            <ul class="bio-posts">
        <!-- The Loop -->

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                    <?php the_post_thumbnail( 'full' ); ?></a>
                    <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h3>
                    <p class="line-link">Published. <?php the_time('d M Y'); ?> in <?php the_category(' & ');?></p>
                    <?php the_excerpt(); ?>
                </li>

            <?php endwhile; else: ?>
                <p><?php _e('No posts by this author.'); ?></p>

            <?php endif; ?>

        <!-- End Loop -->

            </ul>
        </li>
    </ul>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>