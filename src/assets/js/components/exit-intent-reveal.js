/**
 * Uses Foundation Reveal as an exit intent popup.
 * To use it simply instantiate it with the Reveal as a parameter:
 * const eir = new ExitIntentReveal($('#example'));
 *
 * To adjust the sensitivity of the distance from the top use the topSensitivity parameter like:
 * const eir = new ExitIntentReveal($('#example'), 50); // fires 50px from top.
 *
 * To adjust the sensitivity of the delay when the exit intent should fire  use the delaySensitivity
 * parameter like:
 * const eir = new ExitIntentReveal($('#example'), 10, 350); // fires 350ms after exceeding topSensitivity.
 *
 * To set a cookie, so the exit intent doesn't fire again for a specified amount of time after
 * closing it use the useCookieOnClose function like:
 * const eir = new ExitIntentReveal($('#example'));
 * eir.useCookieOnClose(3600); // Reveal will only show again on exit intent if 1 hour is passed.
 * To use a session cookie add no argument or 0.
 */
export default class ExitIntentReveal {
	constructor($reveal, topSensitivity = 10, delaySensitivity = 350) {
		this.$reveal = $reveal;
		this.topSensitivity = topSensitivity;
		this.delaySensitivity = delaySensitivity;
		this.sensitivityDelayTimeout = null; // Stores the timeout used for sensitivity delay.

		$(document).on('mouseleave', this.mouseleave.bind(this));
		$(document).on('mouseenter', this.mouseenter.bind(this));
	}

	mouseleave(e) {
		if (
			e.target.nodeName.toLowerCase() === 'select' || // bug fix for some browsers. see https://github.com/jquery/jquery/issues/3558
			e.clientY > this.topSensitivity ||
			!this.$reveal
		) {
			return;
		}

		this.sensitivityDelayTimeout = setTimeout(() => {
			// If the popup is already open return.
			if (this.$reveal.is(':visible')) {
				return;
			}

			// TODO: If cookie exists or conditions fail return.
			const revealId = this.$reveal.attr('id');
			const shouldOpen =
				ExitIntentReveal.getCookie(`disableExitIntent_${revealId}`) !== 'true';
			if (shouldOpen) {
				this.$reveal.foundation('open');
			}

			// only show once.
			// this.sensitivityDelayTimeout = null;
		}, this.delaySensitivity);
	}

	mouseenter() {
		// clear timeout to abort displaying the reveal if timer not expired.
		clearTimeout(this.sensitivityDelayTimeout);
	}

	static getCookie(cookieName) {
		const name = `${cookieName}=`;
		const ca = document.cookie.split(';');
		for (let i = 0; i < ca.length; i += 1) {
			let c = ca[i];
			while (c.charAt(0) === ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) === 0) {
				return c.substring(name.length, c.length);
			}
		}
		return '';
	}

	/**
	 * Add a cookie when the Reveal is closed and only opens it again if it is expired.
	 *
	 * @param {int} maxAge time in seconds when the cookie should expire. 0 for session cookie.
	 */
	useCookieOnClose(maxAge = 0) {
		$(document).on('closed.zf.reveal', e => {
			if (e.target === this.$reveal.get(0)) {
				const revealId = this.$reveal.attr('id');
				if (maxAge === 0) {
					document.cookie = `disableExitIntent_${revealId}=true; path=/;`;
				} else {
					document.cookie = `disableExitIntent_${revealId}=true; max-age=${maxAge}; path=/;`;
				}
			}
		});
	}
}
