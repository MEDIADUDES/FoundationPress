/* eslint-disable import/first */
/* eslint-disable no-underscore-dangle, global-require */
/* uncomment if babel polyfills are needed.
if (
	(typeof window !== 'undefined' && !window._babelPolyfill) ||
	(typeof global !== 'undefined' && !global._babelPolyfill)
) {
	require('@babel/polyfill');
}
*/
/* eslint-enable no-underscore-dangle, global-require */

import './lib/foundation';

// helper
import './helper/exit-intent-reveal';

// components
import './components/iconlist';

// import FA last, to kick off the process of finding <i> tags and
// replacing with <svg> tags, after importing all components.
import './lib/FontAwesome';
import './lib/reCaptcha';

// because jQuery is included with webpack.ProvidePlugin we can
// just use jQuery and $ variables without importing it again.
