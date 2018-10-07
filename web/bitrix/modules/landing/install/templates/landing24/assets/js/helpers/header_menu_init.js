;(function() {
	"use strict";

	/**
	 * @todo Refactoring
	 */
	BX.addCustomEvent(window, "BX.Landing.Block:init", function(event) {
		var headerSelector = event.makeRelativeSelector('.u-header');
		if (event.block.querySelectorAll(headerSelector).length > 0)
		{
			// in edit mode menu must be like a usual block
			if (BX.Landing.getMode() == "view")
			{
				$.HSCore.components.HSHeader.init($(headerSelector));
			}
		}

		var scrollNavSelector = event.makeRelativeSelector('.js-scroll-nav');
		if (event.block.querySelectorAll(scrollNavSelector).length > 0)
		{
			$.HSCore.components.HSScrollNav.init($('.js-scroll-nav'), {
				duration: 400,
				easing: 'easeOutExpo'
			});
		}
	});


	//unset ACTIVE on menu link
	// todo: unset active before clone
	// BX.addCustomEvent("BX.Landing.Block:Card:add", function (event)
	// {
	// 	var headerSelector = event.makeRelativeSelector('.u-header');
	// 	if (event.block.querySelectorAll(headerSelector).length > 0)
	// 	{
	// 		if (event.card && BX.hasClass(event.card, 'active'))
	// 		{
	// 			BX.removeClass(event.card, 'active');
	// 		}
	// 	}
	// });
})();