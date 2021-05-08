function addIconlistIcons() {
	$('[data-iconlist]').each((i, list) => {
		const $list = $(list);
		const icon = $list.data('icon')
			? $list.data('icon')
			: 'far fa-arrow-circle-right';

		$list.find('li').each((n, item) => {
			$(item).prepend(`<i class="iconlist__icon ${icon}"></i>`);
		});
	});
}

jQuery(() => {
	addIconlistIcons();
});
