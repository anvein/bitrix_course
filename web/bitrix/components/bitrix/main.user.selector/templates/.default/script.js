;(function ()
{
	BX.namespace('BX.Main.User');
	if (BX.Main.User.Selector)
	{
		return;
	}

	/**
	 * UserSelector.
	 *
	 */
	function UserSelector (params)
	{
		this.caller = params.caller;
		this.container = BX(params.containerId);
		this.id = params.id;
		this.containerId = params.containerId;
		this.inputName = params.inputName;
		this.inputId = params.inputName;
		this.isInputMultiple = params.isInputMultiple;
		this.inputNode = this.container.querySelector('input[name="' + params.inputName + '"]');

		this.selector = BX.UI.TileSelector.getById(this.id);
		if (!this.selector)
		{
			throw new Error('Tile selector `' + this.id + '` not found.');
		}
		this.searchInputNode = this.selector.getSearchInput();
		if (!this.searchInputNode.id)
		{
			this.searchInputNode.id = this.inputId + '-search-input'
		}

		BX.addCustomEvent(this.selector, this.selector.events.buttonSelect, this.openDialog.bind(this));
		BX.addCustomEvent(this.selector, this.selector.events.tileRemove, this.removeTile.bind(this));

		BX.Main.User.SelectorController.init(this);
	}
	UserSelector.prototype = {
		openDialog: function()
		{
			BX.Main.User.SelectorController.open(this);
		},
		removeTile: function(tile)
		{
			this.unsetValue(tile.id);
		},
		setUsers: function(list)
		{
			list = list || [];


			if (this.isInputMultiple)
			{
				this.addInputs(list);
			}
			else
			{
				this.inputNode.value = list.join(',');
			}
		},
		getUsers: function()
		{
			if (!this.inputNode)
			{
				return [];
			}

			var list;
			if (this.isInputMultiple)
			{
				list = this.getInputs().map(function (inputNode) {
					return inputNode.value;
				});
			}
			else
			{
				list = this.inputNode.value.split(',');
			}

			return list.filter(function (id) {
				id = parseInt(id);
				return !!id;
			}).map(function (id) {
				return parseInt(id);
			});
		},
		setValue: function(value)
		{
			if (/^\d+$/.test(value) !== true)
			{
				return;
			}

			value = parseInt(value);
			if (this.selectOne)
			{
				this.setUsers([value]);
			}
			else
			{
				var list = this.getUsers();
				if (!BX.util.in_array(value, list))
				{
					list.push(value);
				}
				this.setUsers(list);
			}

		},
		unsetValue: function(value)
		{
			if (/^\d+$/.test(value) !== true)
			{
				return;
			}

			value = parseInt(value);
			if (this.selectOne)
			{
				this.setUsers();
			}
			else
			{
				var list = this.getUsers().filter(function (id) {
					return id !== value;
				});
				this.setUsers(list);
			}
		},
		addInput: function(value)
		{
			var inputNode = document.createElement('input');
			inputNode.type = 'hidden';
			inputNode.name = this.inputName;
			inputNode.value = value;
			this.container.insertBefore(inputNode, this.container.firstElementChild);
		},
		addInputs: function(list)
		{
			this.removeInputs();
			list.forEach(function (value) {
				this.addInput(value);
			}, this);
		},
		getInputs: function()
		{
			return BX.convert.nodeListToArray(this.container.querySelectorAll('input[name="' + this.inputName + '"]'));
		},
		removeInputs: function()
		{
			this.getInputs().forEach(function (inputNode) {
				BX.remove(inputNode);
			});
		}
	};


	var Controller = {
		list: [],
		init: function (userSelector)
		{
			this.list.push(userSelector);
			BX.onCustomEvent(window, 'BX.Main.User.SelectorController::init', [{
				id: userSelector.id,
				inputId: userSelector.searchInputNode.id,
				containerId: userSelector.containerId,
				openDialogWhenInit: false
			}]);
		},
		open: function (userSelector)
		{
			if (userSelector.isOpen)
			{
				return;
			}

			if (BX.SocNetLogDestination && BX.SocNetLogDestination.obItemsSelected)
			{
				var name = userSelector.id;
				BX.SocNetLogDestination.obItemsSelected[name] = {};
				userSelector.getUsers().forEach(function (id) {
					BX.SocNetLogDestination.obItemsSelected[name][id] = 'users';
				});
			}

			userSelector.isOpen = true;
			BX.onCustomEvent(window, 'BX.Main.User.SelectorController::open', [{
				id: userSelector.id,
				inputId: userSelector.searchInputNode.id,
				containerId: userSelector.containerId,
				bindNode: userSelector.container
			}]);
		},
		select: function (params)
		{
			var self = BX.Main.User.SelectorController;
			var userSelector = self.getUserSelector(params.name);
			if (!userSelector)
			{
				return;
			}

			userSelector.setValue(params.item.entityId);
			userSelector.selector.addTile(params.item.name, {}, params.item.entityId);
		},
		unSelect: function (params)
		{
			var self = BX.Main.User.SelectorController;
			var userSelector = self.getUserSelector(params.name);
			if (!userSelector)
			{
				return;
			}

			userSelector.unsetValue(params.item.entityId);
			var tile = userSelector.selector.getTile(params.item.entityId);
			userSelector.selector.removeTile(tile);
		},
		closeDialog: function (params)
		{
			var self = BX.Main.User.SelectorController;
			var userSelector = self.getUserSelector(params.name);
			if (!userSelector)
			{
				return;
			}

			userSelector.isOpen = false;
		},
		openSearch: function (params)
		{
		},
		getUserSelector: function (id)
		{
			var userSelector = this.list.filter(function (selector) {
				return selector.id === id;
			});

			return userSelector[0];
		}
	};

	if (!BX.Main.User.SelectorController)
	{
		BX.Main.User.SelectorController = Controller;
	}

	BX.Main.User.Selector = UserSelector;

})(window);