import { library, dom } from '@fortawesome/fontawesome-svg-core';

const blockName = 'accordion';

/**
 * initializeBlock
 *
 * Adds custom JavaScript to the block HTML.
 *
 * @date    15/4/19
 * @since   1.0.0
 *
 * @param   object $block The block jQuery element.
 * @param   object attributes The block attributes (only available when editing).
 * @return  void
 */
function initializeBlock($block) {
	// initialize element with foundation plugin.
	$block.find('[data-accordion]').foundation();

	// Font Awesome Icons -> SVG
	dom.i2svg({ node: $block[0] });
}

// Initialize each block on page load (front end).
jQuery(($) => {
	$('.b-accordion').each((i, el) => {
		initializeBlock($(el));
	});
});

// Initialize dynamic block preview (back end editor).
if (window.acf) {
	window.acf.addAction(
		`render_block_preview/type=${blockName}`,
		initializeBlock,
	);
}
