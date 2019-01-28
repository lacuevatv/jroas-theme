<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<main class="wrapper" id="bio">

		<?php the_title( '<div class="headline"><h2 class="entry-title">', '</h2></div>' ); ?>

		
			<div class="col-text container-fluid">
                <div class="row">
                    <div class="biografia-slider col-sm-12 col-md-10 offset-md-1 col-xl-5 offset-xl-5">
                        <div class="mx-2">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		

	</main>
</div><!-- #post-<?php the_ID(); ?> -->
