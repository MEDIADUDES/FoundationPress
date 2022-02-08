function fixReCaptchaPosition() {
	jQuery('body > div > div > iframe[src^="https://www.google.com/recaptcha/"]')
		.parent()
		.parent()
		.addClass('recaptcha-wrapper');
}

setInterval(() => {
	fixReCaptchaPosition();
}, 250);
