/* eslint-disable import/first */
// set to false if you don't use ES6 syntax which needs polyfills.
const useES6Polyfills = true;

/* eslint-disable no-underscore-dangle, global-require */
if (
	useES6Polyfills &&
	((typeof window !== 'undefined' && !window._babelPolyfill) ||
		(typeof global !== 'undefined' && !global._babelPolyfill))
) {
	require('@babel/polyfill');
}
/* eslint-enable no-underscore-dangle, global-require */

import './lib/foundation';

// because jQuery is included with webpack.ProvidePlugin we can
// just use jQuery and $ variables without importing it again.
