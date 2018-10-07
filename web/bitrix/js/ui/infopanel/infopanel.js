(function () {

	"use strict";

	BX.namespace("BX.UI");

	/**
	 *
	 * @param options
	 * @constructor
	 */

	BX.UI.InfoPanel = function(options) {
		this.panelElement = options.panelElement;

		BX.addCustomEvent(window, 'BX.UI.Dropdown:onSelect', this.render.bind(this));
	};

	BX.UI.InfoPanel.prototype = {
		render: function() {
			if(!this.panelContainer) {
				this.panelContainer = BX.create('div', {
					props: {
						className: 'ui-infopanel'
					},
					children: [
						this.getCrmPanel()
					]
				})
			}
			return this.panelContainer;
		},

		getDefaultPanel: function() {

		},

		getCrmPanel: function() {
			// BX.onCustomEvent(this, "TileGrid.Grid:onItemDragStart", [this]);

			var crmPanel = BX.Crm.ClientEditorEntityPanel.create(
				this._id +  "_" + entityInfo.getId().toString(),
				{
					editor: this._editor,
					entityInfo: entityInfo,
					mode: this._mode,
					onDelete: BX.delegate(this.onItemDelete, this)
				});

			return crmPanel;
		}
	};
})();