<?php
/**
 * Template part for displaying categories.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Triangle_X
 */

$author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
 
?>

<?php insert_ad('Global Banner Top', 'banner-top'); ?>

<div class="generic-container">
	<div class="category-title">Articles by <?php printf('%1$s %2$s', $author->first_name, $author->last_name); ?></div>
</div>

<div class="generic-flex-container">
	<main class="flex-main">
		<?php
			while(have_posts())
			{
				the_post();
				
				$title = get_the_title();
				$link = get_permalink();
				$date = get_the_date('M. j, Y');
				$authors = coauthors_posts_links(null, null, null, null, false);
				$excerpt = get_the_summary($post->ID);
				$thumb = get_the_post_thumbnail($post, array('class' => '169-preview-medium'));
				
				echo '<div class="category-post">';
				
				// Left box - date
				printf('<div class="category-date">%1$s</div>', esc_attr($date));
				
				// Middle box flex - headline, author, and excerpt
				echo '<div class="category-post-info">';
				printf('<a class="text-headline-medium" href="%1$s">%2$s</a>', esc_attr($link), esc_html($title));
				printf('<div class="category-tease">%1$s</div>', $excerpt);
				printf('<div class="category-author">By %1$s</div>', $authors);
				echo '</div>';
				
				// Right box - thumbnail
				printf($thumb);
				
				echo '</div>';
			}
		?>
		
		<!-- TODO: figure out why this causes last story to have bottom border -->
		<div class="category-pagination">
			<?php posts_nav_link(' ','<< Newer Stories','Older Stories >>'); ?>
		</div>
	</main>

	<aside class="flex-sidebar">	
		<div id="ad-sidebar" style="margin-bottom:25px;">
			<?php
				if(function_exists('drawAdsPlace'))
							drawAdsPlace(array('name' => 'Global Medium Rectangle Sidebar'), false);
			?>
		</div>

		<div id="most-recent" class="sidebar-item">
			<?php get_template_part('template-parts/sidebar-recent'); ?>
		</div>
	</aside>
</div>

<?php insert_ad('Global Banner Bottom', 'banner-bottom'); ?>