<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
 */

if ( ! function_exists( 'jrojas_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function jrojas_posted_on() {

	// Get the author name; wrap it in a link.
	/*$byline = sprintf(
		/* translators: %s: post author */
		/*__( 'by %s', 'jrojas' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);*/

	// Finally, let's write all of this to the page.
	/*echo '<span class="posted-on">' . jrojas_time_link() . '</span><span class="byline"> ' . $byline . '</span>';*/

	echo jrojas_time_link();
}
endif;


if ( ! function_exists( 'jrojas_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function jrojas_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	/*if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}*/

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date( 'j F Y')
		/*get_the_modified_date( DATE_W3C ),
		get_the_modified_date()*/
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Publicado el</span> %s', 'jrojas' ), $time_string 
	);
}
endif;



if ( ! function_exists( 'jrojas_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function jrojas_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'jrojas' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );

	// We don't want to output .entry-footer if it will be empty, so make sure its not.
	if ( ( ( jrojas_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

		echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && jrojas_categorized_blog() ) || $tags_list ) {
					echo '<span class="cat-tags-links">';

						// Make sure there's more than one category before displaying.
						if ( $categories_list && jrojas_categorized_blog() ) {
							echo '<span class="cat-links">' . '<span class="screen-reader-text">' . __( 'Categorías', 'jrojas' ) . '</span>' . $categories_list . '</span>';
						}

						if ( $tags_list && ! is_wp_error( $tags_list ) ) {
							echo '<span class="tags-links">' . '<span class="screen-reader-text">' . __( 'Etiquetas', 'jrojas' ) . '</span>' . $tags_list . '</span>';
						}

					echo '</span>';
				}
			}

			//jrojas_edit_link();

		echo '</footer> <!-- .entry-footer -->';
	}
}
endif;


if ( ! function_exists( 'jrojas_edit_link' ) ) :
/**
 * Returns an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
function jrojas_edit_link() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'jrojas' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function jrojas_categorized_blog() {
	$category_count = get_transient( 'jrojas_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'jrojas_categories', $category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}


if ( ! function_exists( 'jrojas_testimonio_date' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function jrojas_testimonio_date() {

		//$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$meses = array( 
			__('Enero', 'jrojas'),
			__('Febrero', 'jrojas'),
			__('Marzo', 'jrojas'),
			__('Abril', 'jrojas'),
			__('Mayo', 'jrojas'),
			__('Junio', 'jrojas'),
			__('Julio', 'jrojas'),
			__('Agosto', 'jrojas'),
			__('Septiembre', 'jrojas'),
			__('Octubre', 'jrojas'),
			__('Noviembre', 'jrojas'),
			__('Diciembre', 'jrojas'),
			);
		$dias = array(
			__('Domingo', 'jrojas'),
			__('Lunes', 'jrojas'),
			__('Martes', 'jrojas'),
			__('Miércoles', 'jrojas'),
			__('Jueves', 'jrojas'),
			__('Viernes', 'jrojas'),
			__('Sábado', 'jrojas'),
			);

		$date_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		
		$date = get_the_date();
		$fecha = $meses[get_the_date('n')-1] . ' ' . get_the_date('Y') ;
		
		$date_string = sprintf( $date_string,
			get_the_date( DATE_W3C ),
			$fecha
		);
		
		return $date_string;
		
	}
endif;



/**
 * Flush out the transients used in jrojas_categorized_blog.
 */
function jrojas_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'jrojas_categories' );
}
add_action( 'edit_category', 'jrojas_category_transient_flusher' );
add_action( 'save_post',     'jrojas_category_transient_flusher' );



if ( ! function_exists( 'jrojas_the_posts_navigation' ) ) :
	/**
	 * mustra la paginacion en el index
	 */
	function jrojas_the_posts_navigation() {
		echo '<div class="container pagination-margin">';
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => sprintf(
					'<span class="nav-prev-text">%s</span>',
					__( '< Anterior', 'jrojas' )
				),
				'next_text' => sprintf(
					'<span class="nav-next-text">%s</span>',
					__( 'Siguiente >', 'jrojas' )
				),
			)
		);
		echo '</div>';
	}
endif;