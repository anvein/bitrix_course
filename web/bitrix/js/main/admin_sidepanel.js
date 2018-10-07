/*** Settings for sidepanel in admin panel ***/
(function() {
	var iframeMode = window !== window.top;
	var search = window.location.search;
	var sliderMode = search.indexOf("IFRAME=") !== -1 || search.indexOf("IFRAME%3D") !== -1;

	if (iframeMode && sliderMode)
	{
		return;
	}

	if (!BX.SidePanel.Instance)
	{
		return;
	}

	var destroyAndOpenPage = function (event, link) {
		if (BX.SidePanel.Instance && BX.SidePanel.Instance.getTopSlider())
		{
			BX.onCustomEvent("SidePanel:destroy", [BX.SidePanel.Instance.getTopSlider().getUrl()]);
			BX.SidePanel.Instance.open(link.url);
		}
	};

	BX.SidePanel.Instance.bindAnchors({
		rules: []
	});

})();