/**
 * Integrate FontAwesome Icons
 *
 * Available Packages:
 * @fortawesome/free-solid-svg-icons
 * @fortawesome/free-regular-svg-icons
 * @fortawesome/free-brands-svg-icons
 * @fortawesome/pro-solid-svg-icons
 * @fortawesome/pro-regular-svg-icons
 * @fortawesome/pro-light-svg-icons
 * @fortawesome/pro-duotone-svg-icons
 *
 * You need to install needed packages first:
 * npm i -E @fortawesome/free-regular-svg-icons
 *
 * Access to the Pro packages requires you to configure the @fortawesome scope
 * to use their Pro NPM registry.
 * @see https://fontawesome.com/how-to-use/on-the-web/setup/using-package-managers#installing-pro
 */

import { library, dom } from '@fortawesome/fontawesome-svg-core';

/* SOLID */
import { faArrowCircleRight } from '@fortawesome/free-solid-svg-icons/faArrowCircleRight';

/* REGULAR */

/* LIGHT */

/* DUOTONE */

/* BRANDS */

/* register used fontawesome icons */
library.add(
	/* SOLID */
	faArrowCircleRight,

	/* REGULAR */

	/* LIGHT */

	/* DUOTONE */

	/* BRANDS */
);

// Kicks off the process of finding <i> tags and replacing with <svg>
$('.site-header, .main-container, .footer').each((i, el) => {
	dom.i2svg({ node: el });
});

// use dom.watch if you plan to dynamically add <i> icon tag.
// dom.watch();
