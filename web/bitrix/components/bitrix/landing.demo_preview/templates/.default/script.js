;(function() {
	"use strict";

	BX.namespace("BX.Landing");

	var slice = BX.Landing.Utils.slice;
	var proxy = BX.Landing.Utils.proxy;
	var bind = BX.Landing.Utils.bind;
	var unbind = BX.Landing.Utils.unbind;
	var addClass = BX.Landing.Utils.addClass;
	var removeClass = BX.Landing.Utils.removeClass;
	var isNumber = BX.Landing.Utils.isNumber;
	var style = BX.Landing.Utils.style;
	var data = BX.Landing.Utils.data;
	var addQueryParams = BX.Landing.Utils.addQueryParams;
	var getDeltaFromEvent = BX.Landing.Utils.getDeltaFromEvent;

	/**
	 * Implements interface for works with template preview
	 * @constructor
	 */
	BX.Landing.TemplatePreview = function(params)
	{
		this.closeButton = document.querySelector(".landing-template-preview-close");
		this.createButton = document.querySelector(".landing-template-preview-create");
		this.palette = document.querySelector(".landing-template-preview-palette");
		this.imageContainer = document.querySelector(".preview-desktop-body-image");
		this.loaderContainer = document.querySelector(".preview-desktop-body-loader-container");
		this.previewFrame = document.querySelector(".preview-desktop-body-preview-frame");
		this.loader = new BX.Loader({});
		this.messages = params.messages || {};
		this.loaderText = null;
		this.IsLoadedFrame = false;

		this.onCreateButtonClick = proxy(this.onCreateButtonClick, this);
		this.onCancelButtonClick = proxy(this.onCancelButtonClick, this);
		this.onFrameLoad = proxy(this.onFrameLoad, this);

		this.init();
	};

	/**
	 * Gets instance of BX.Landing.TemplatePreview
	 * @return {BX.Landing.TemplatePreview}
	 */
	BX.Landing.TemplatePreview.getInstance = function(params)
	{
		return (
			BX.Landing.TemplatePreview.instance ||
			(BX.Landing.TemplatePreview.instance = new BX.Landing.TemplatePreview(params))
		);
	};

	BX.Landing.TemplatePreview.prototype = {
		/**
		 * Initializes template preview elements
		 */
		init: function()
		{
			slice(this.palette.children)
				.forEach(this.initSelectableItem, this);

			bind(this.previewFrame, "load", this.onFrameLoad);
			bind(this.closeButton, "click", this.onCancelButtonClick);
			bind(this.createButton, "click", this.onCreateButtonClick);

			void this.showPreview(data(this.palette.querySelector(".active"), "data-src"));
		},

		onFrameLoad: function() {
			this.IsLoadedFrame = true;
		},

		/**
		 * Shows preview
		 * @param {string} src
		 * @return {Promise<T>}
		 */
		showPreview: function(src)
		{
			return this.showLoader()
				.then(this.createFrameIfNeeded())
				.then(this.loadPreview(src))
				.then(this.delay(200))
				.then(this.hideLoader());
		},

		/**
		 * Creates frame if needed
		 * @return {Function}
		 */
		createFrameIfNeeded: function()
		{
			return function()
			{
				new Promise(function(resolve) {

					if (!this.previewFrame.style.width)
					{
						var containerWidth = this.imageContainer.clientWidth;

						void style(this.previewFrame, {
							"width": "1000px",
							"height": "calc((100vh - 140px) * (100 / "+((containerWidth/1000)*100)+"))",
							"transform": "scale("+(containerWidth/1000)+") translateZ(0)",
							"transform-origin": "top left",
							"border": "none"
						});
					}

					resolve(this.previewFrame);
				}.bind(this));
			}.bind(this)
		},

		/**
		 * Loads template preview
		 * @param {string} src
		 * @return {Function}
		 */
		loadPreview: function(src)
		{
			return function()
			{
				return new Promise(function(resolve) {
					if (this.previewFrame.src !== src)
					{
						this.previewFrame.src = src;
						this.previewFrame.onload = function() {
							resolve(this.previewFrame);
						}.bind(this);
						return;
					}

					resolve(this.previewFrame);
				}.bind(this));
			}.bind(this)
		},

		/**
		 * Shows preview loader
		 * @return {Promise}
		 */
		showLoader: function()
		{
			return new Promise(function(resolve) {
				void this.loader.show(this.loaderContainer);
				addClass(this.imageContainer, "landing-template-preview-overlay");
				resolve();
			}.bind(this));
		},

		/**
		 * Hides loader
		 * @return {Function}
		 */
		hideLoader: function()
		{
			return function(iframe)
			{
				return new Promise(function(resolve) {
					void this.loader.hide();
					removeClass(this.imageContainer, "landing-template-preview-overlay");
					resolve(iframe);
				}.bind(this));
			}.bind(this);
		},

		/**
		 * Creates delay
		 * @param delay
		 * @return {Function}
		 */
		delay: function(delay)
		{
			delay = isNumber(delay) ? delay : 0;

			return function(image)
			{
				return new Promise(function(resolve) {
					setTimeout(resolve.bind(null, image), delay);
				});
			}
		},

		/**
		 * Gets value
		 * @return {Object}
		 */
		getValue: function()
		{
			var result = {};
			result[data(this.palette, "data-name")] = data(this.palette.querySelector(".active"), "data-value");

			return result;
		},

		/**
		 * Makes create url
		 * @return {string}
		 */
		getCreateUrl: function()
		{
			return addQueryParams(this.createButton.getAttribute("href"), this.getValue());
		},

		/**
		 * Handles click event on close button
		 * @param {MouseEvent} event
		 */
		onCancelButtonClick: function(event)
		{
			event.preventDefault();
			top.BX.SidePanel.Instance.close();
		},

		/**
		 * Handles click event on create button
		 * @param {MouseEvent} event
		 */
		onCreateButtonClick: function(event)
		{
			event.preventDefault();

			if(this.isStore() && this.IsLoadedFrame) {
				this.loaderText = BX.create("div", { props: { className: "landing-template-preview-loader-text"},
					text: this.messages.LANDING_LOADER_WAIT});

				this.loaderContainer.appendChild(this.loaderText);
			}

			this.showLoader()
				.then(this.delay(200))
				.then(function() {
					top.location = this.getCreateUrl();
				}.bind(this));

		},

		/**
		 * Initializes selectable items
		 * @param {HTMLElement} item
		 */
		initSelectableItem: function(item)
		{
			bind(item, "click", proxy(this.onSelectableItemClick, this));
		},

		/**
		 * Handles click on selectable item
		 * @param event
		 */
		onSelectableItemClick: function(event)
		{
			event.preventDefault();

			removeClass(event.currentTarget.parentElement.querySelector(".active"), "active");
			addClass(event.currentTarget, "active");

			if (event.currentTarget.parentElement === this.palette)
			{
				this.showPreview(data(event.currentTarget.parentElement.querySelector(".active"), "data-src"));
			}
		},

		isStore: function()
		{
			return top.location.href.includes("/stores");
		}
	};
})();