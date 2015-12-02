var Modal = Class.create({
		initialize: function() {
			var defaults = {
				container: document.body,
				opacity: 0.9,
				overlay: true,
				zIndex: 1,
				overlayId: 'modal_overlay',
				containerId: 'modal_window_wrapper',
				content: '',
				contentId: 'modal_content_wrapper',
				buttonContainerId: "modal_buttons_wrapper",
				okButton: true,
				okButtonHtml: '<input id="modal_ok_button" class="inputsubmit" type="button" name="ok" value="OK" />',
				okButtonId: 'modal_ok_button',
				cancelButton: true,
				cancelButtonHtml: '<input id="modal_cancel_button" class="inputsubmit inputaux" type="button" name="cancel" value="Annuler" />',
				cancelButtonId: 'modal_cancel_button',
				html: '\
				  <div class="modal_window_wrapper" id="modal_window_wrapper">\
				    <div class="modal_content_wrapper" id="modal_content_wrapper"></div>\
				    <div class="modal_buttons_wrapper" id="modal_buttons_wrapper"></div>\
				  </div>\
				',
				onOkButton: function(){ return true; },
			  onCancelButton: function(){ return true; },
			  afterShow: function() { return true; },
			  afterClose: function() { return true; },
			  showContainerEffect: function(self){ self.container.appear(); },
			  showOverlayEffect: function(overlay, self){ new Effect.Opacity(overlay, { from: 0, to: self.options.opacity, duration: 0.1 }); },
			  hideOverlayEffect: function(overlay, self){ new Effect.Opacity(overlay, { from: self.options.opacity, to: 0, duration: 0.3, afterFinish: function(){ overlay.remove() } }); },
			  closeEffect: function(self){ Effect.Fade(self.container, { duration: .4, afterFinish: function(){ container.remove(); } }); }
			};
			this.options = Object.extend(defaults, arguments[0] || { });
			this.initialized = false;
			this.init();
		},
		
		init: function() {
			if (this.initialized) {
				return true;
			} else {
				this.initialized = true;
			}
			
			this.showOverlay();
			
			var container = document.createElement('div');
			container.update(this.options.html);
			this.options.container.insertBefore(container, this.options.container.firstChild);
			
			this.container = $(this.options.containerId);
			this.container.setStyle({zIndex: 100 + parseInt(this.options.zIndex, 10), position: 'absolute', display: 'none'});
			
			this.buildButtons();
			this.setContent(this.options.content);
			
			this.show();
		},
		
		buildButtons: function() {
			if (this.options.cancelButton) {
				var container = document.createElement('span');
				container.update('<span>' + this.options.cancelButtonHtml + '</span>');
				$(this.options.buttonContainerId).insertBefore(container, $(this.options.buttonContainerId).firstChild);

				Event.observe($(this.options.cancelButtonId), 'click', this.cancel.bind(this));
			}
			
			if (this.options.okButton) {
				var container = document.createElement('span');
				container.update('<span>' + this.options.okButtonHtml + '</span>');
				$(this.options.buttonContainerId).insertBefore(container, $(this.options.buttonContainerId).firstChild);

				Event.observe($(this.options.okButtonId), 'click', this.ok.bind(this));
			}
		},
					
		ok: function() {
			this.close(this.options.onOkButton);
		},
		
		cancel: function() {
			this.close(this.options.onCancelButton);
		},
		
		setContent: function(content) {
      if("string" == typeof(content).toLowerCase()) {
				$(this.options.contentId).update(content);
			} else {
        var elem = content.cloneNode(true);
        elem.id = "yapopup_" + elem.id;
        $(this.options.contentId).appendChild(elem);
			}
		},
		
		close: function(callback) {
			if ((callback && callback(this)) || null == callback) {
	      this.hideOverlay();
        this.options.closeEffect(this);
        this.options.afterClose();
			}
		},
		
		show: function() {
		  
			var containerDimensions = this.container.getDimensions();
			var top = ((document.viewport.getDimensions().height - containerDimensions.height) / 2) + document.viewport.getScrollOffsets().top;
			var left = (this.options.container.offsetWidth / 2) - (containerDimensions.width / 2);
			
			this.container.setStyle({
				'top': this.options.top || Math.floor(top) + 'px',
				'left': this.options.left || Math.floor(left) + 'px'
			})
			
			this.options.showContainerEffect(this);
			this.padRootElement();
			this.options.afterShow(this);
		},
		
		padRootElement: function() {
			if (this.options.container.clientHeight < this.container.clientHeight) {
				var container = document.createElement('div');
				container.update('<span></span>');
				var dist = this.container.clientHeight - this.options.container.clientHeight;
				container.setStyle({height: dist + this.container.scrollTop + 'px', display: 'block'});
				this.options.container.appendChild(container);
			}
		},
		
		skipOverlay: function() {
			return this.options.overlay == false || this.options.opacity === null;
		},
		
		showOverlay: function() {
			if (this.skipOverlay()) return;
			if ($(this.options.overlayId) == null) {
				var overlay = document.createElement('div');
				overlay.id = this.options.overlayId;
				this.options.container.insertBefore(overlay, this.options.container.firstChild);
			}
			$(this.options.overlayId).setStyle({position: 'fixed', 
				top: '0px',
			  left: '0px',
			  height: '100%',
			  width: '100%',
				backgroundColor: '#000',
				zIndex: '100',
				opacity: 0
			});
      this.options.showOverlayEffect($(this.options.overlayId), this);
			return false;
		},
	  
		hideOverlay: function() {
			if (this.skipOverlay()) return;
			this.options.hideOverlayEffect($(this.options.overlayId), this);
			return false;
		}
});