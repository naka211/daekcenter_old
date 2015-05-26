var dynamicParams = new Class({
	options: {
		addButton: '',
		moreField: '',
		basename: '',
		params: '',
		extLinks: '.roknavmenu-extendedlink',
		fields: 1
	},
	
	initialize: function(options) {
		this.setOptions(options);
		
		this.addButton = $(this.options.addButton);
		this.moreField = $(this.options.moreField);
		
		if (!this.addButton) 
			throw new Error('Add Button ('+this.options.addButton+') cannot be find. Class initialization stopped.');
		if (!this.moreField) 
			throw new Error('More Field container ('+this.options.moreField+') cannot be find. Class initialization stopped.');
		
		if (!this.addButton || !this.moreField) return false;
		
		this.rendered = this.moreField.getElements(this.options.extLinks);
		
		if (this.rendered.length) this.extLinksEvents();
		this.extendedlinkInit.delay(350, this);
		this.eventAdd();
		
	},
	
	eventAdd: function() {
		var self = this;
	 	this.addButton.addEvent('click', function(e) {
			new Event(e).stop();
			self.moreField.getParent().getParent().getParent().getParent().getParent().setStyle('height', '');
			if (self.moreField.getLast() == null) {
				last = 0;
			}
			else {
				var last = self.moreField.getLast().id;
				last = last.split("_").slice(-1)[0].toInt();
			}
			var id = {
				'div': self.options.basename + '_' + (last + 1),
				'name': self.options.params + '[' + self.options.basename + '_name_' + (last + 1) + ']',
				'value': self.options.params + '[' + self.options.basename + '_value_' + (last + 1) + ']'
			};
			var div = new Element('div', {'id': id.div, 'class': 'roknavmenu-extendedlink', 'styles': {'margin': '5px 0'}});
			
			var size = (self.options.fields == 1) ? 22 : 10;
			
			var input1 = new Element('input', {'type': 'text', 'name': id.name, 'size': size}).inject(div).setProperty('value', 'Name');
			if (self.options.fields == 2) 
				var input2 = new Element('input', {'type': 'text', 'name': id.value, 'size': size}).inject(div).setProperty('value', 'Value');
			
			var remove = new Element('button', {'class': 'remove'}).setText('-').inject(div);

			var fx = {
				'remove': new Fx.Style(remove, 'opacity', {'duration': 200, 'wait': false}).set(0),
				'div': new Fx.Style(div, 'opacity', {'duration': 200, 'wait': false}).set(0)
			};

			div.inject(self.moreField);
			fx.div.start(1);

			input1.addEvents({
				'focus': function() {if (this.value == "Name") this.value = "";},
				'blur': function() {if (this.value == "") this.value = "Name";}
			});
			
			if (self.options.fields == 2) {
				input2.addEvents({
					'focus': function() {if (this.value == "Value") this.value = "";},
					'blur': function() {if (this.value == "") this.value = "Value";}
				});
			}
			
			div.addEvents({
				'mouseenter': function() {
					fx.remove.start(1);
				},
				'mouseleave': function() {
					fx.remove.start(0);
				}
			});

			remove.addEvent('click', function(e) {
				new Event(e).stop();
				self.moreField.getParent().getParent().getParent().getParent().getParent().setStyle('height', '');
				fx.div.start(0).chain(function() {
					delete fx.remove;
					delete fx.div;
					(function() {
						div.empty().remove();
						self.extendedlinkReorder();
					}).delay(100);
				});
			});
		});	
	},
	
	extLinksEvents: function() {
		this.rendered.each(function(render) {
			var inputs = render.getElements('input');
			inputs.each(function(input, i) {
				input.addEvents({
					'focus': function() {if ((this.value == "Name" && !i) || (this.value == "Value" && i == 1)) this.value = "";},
					'blur': function() {
						if (this.value == "" && !i) this.value = "Name";
						else if (this.value == "" && i == 1) this.value = "Value";
					}
				});
			});
		});
	},
	
	extendedlinkInit: function() {
		var more = this.moreField, self = this;
		more.getChildren().each(function(div, i) {
			var inputs = div.getChildren();
			var input1 = inputs[0], input2 = inputs[1];
			var remove = new Element('button', {'class': 'remove'}).setText('-').inject(div);

			var fx = {
				'remove': new Fx.Style(remove, 'opacity', {'duration': 200, 'wait': false}).set(0),
				'div': new Fx.Style(div, 'opacity', {'duration': 200, 'wait': false}).set(1)
			};

			input1.addEvents({
				'focus': function() {if (this.value == "Name") this.value = "";},
				'blur': function() {if (this.value == "") this.value = "Name";}
			});
			
			if (self.options.fields == 2) 
				input2.addEvents({
					'focus': function() {if (this.value == "Value") this.value = "";},
					'blur': function() {if (this.value == "") this.value = "Value";}
				});

			div.addEvents({
				'mouseenter': function() {
					fx.remove.start(1);
				},
				'mouseleave': function() {
					fx.remove.start(0);
				}
			});

			remove.addEvent('click', function(e) {
				new Event(e).stop();
				more.getParent().getParent().getParent().getParent().getParent().setStyle('height', '');
				fx.div.start(0).chain(function() {
					delete fx.remove;
					delete fx.div;
					(function() {
						div.empty().remove();
						self.extendedlinkReorder();
					}).delay(100);
				});
			});
		});
		
		self.moreField.getParent().getParent().getParent().getParent().getParent().setStyle('height', '');
	},
	
	extendedlinkReorder: function() {
		this.moreField.getChildren().each(function(div, i) {
			div.setProperty('id', this.options.basename  + '_' + (i + 1));
			div.getElements('input').each(function(input, j) {
				if (!j) input.setProperty('name', this.options.params + '[' + this.options.basename + '_name_' + (i + 1) + ']');
				else input.setProperty('name', this.options.params + '[' + this.options.basename + '_value_' + (i + 1) + ']');
			}, this);
		}, this);
	}
});

dynamicParams.implement(new Options);