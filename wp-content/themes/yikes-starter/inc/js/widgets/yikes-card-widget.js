/**
 * @output yikes-starter/inc/js/widgets/yikes-card-widget.js
 */

/* eslint consistent-this: [ "error", "control" ] */
(function( component, $ ) {
	'use strict';

	var yikesCardWidgetModel, yikesCardWidgetControl;

	/**
	 * YIKES Card widget model.
	 *
	 * See YIKES_Card_Widget::enqueue_admin_scripts() for amending prototype from PHP exports.
	 *
	 * @class    wp.mediaWidgets.modelConstructors.yikes_card
	 * @augments wp.mediaWidgets.MediaWidgetModel
	 */
	yikesCardWidgetModel = component.modelConstructors.media_image.extend({});

	/**
	 * YIKES Card widget control.
	 *
	 * See YIKES_Card_Widget::enqueue_admin_scripts() for amending prototype from PHP exports.
	 *
	 * @class    wp.mediaWidgets.controlConstructors.yikes_card
	 * @augments wp.mediaWidgets.MediaWidgetControl
	 */
	yikesCardWidgetControl = component.controlConstructors.media_image.extend(/** @lends wp.mediaWidgets.controlConstructors.yikes_card.prototype */{

	    initialize: function initialize( options ) {
	    	component.controlConstructors.media_image.prototype.initialize.call( this, options );			

	    	var control = this;

			// Update the content textarea.
			control.$el.on( 'input change', '.textarea', function updateTextArea() {
				control.model.set({
					text_area: $.trim( $( this ).val() )
				});
			});

			// Update the link text input.
			control.$el.on( 'input change', '.linktext', function updateLinkText() {
				control.model.set({
					link_text: $.trim( $( this ).val() )
				});
			});

			// Update the link url input.
			control.$el.on( 'input change', '.linkurl', function updateLinkUrl() {
				control.model.set({
					link_url: $.trim( $( this ).val() )
				});
			});

			// Update the badge input.
			control.$el.on( 'input change', '.badge', function updateBadgeInput() {
				control.model.set({
					badge: $.trim( $( this ).val() )
				});
			});
	    },

		/**
		 * Render template.
		 *
		 * @returns {void}
		 */
		render: function render() {
			component.controlConstructors.media_image.prototype.render.call( this );

			var control = this, fieldsContainer, fieldsTemplate, textAreaInput, linkTextInput, linkUrlInput, badgeInput;

			if ( ! control.yikesTemplateRendered ) {
				fieldsContainer = control.$el.find( '.media-widget-fields' );
				fieldsTemplate = wp.template( 'wp-media-widget-yikes-card-fields' );
				fieldsContainer.html( fieldsTemplate( control.previewTemplateProps.toJSON() ) );
				control.yikesTemplateRendered = true;
			}

			textAreaInput = control.$el.find( '.textarea' );
			if ( ! textAreaInput.is( document.activeElement ) ) {
				textAreaInput.val( control.model.get( 'text_area' ) );
			}

			linkTextInput = control.$el.find( '.linktext' );
			if ( ! linkTextInput.is( document.activeElement ) ) {
				linkTextInput.val( control.model.get( 'link_text' ) );
			}

			linkUrlInput = control.$el.find( '.linkurl' );
			if ( ! linkUrlInput.is( document.activeElement ) ) {
				linkUrlInput.val( control.model.get( 'link_url' ) );
			}

			badgeInput = control.$el.find( '.badge' );
			if ( ! badgeInput.is( document.activeElement ) ) {
				badgeInput.val( control.model.get( 'badge' ) );
			}
		},

		/**
		 * Render preview.
		 *
		 * @returns {void}
		 */
		renderPreview: function renderPreview() {

			var control = this, previewContainer, previewTemplate, fieldsContainer, fieldsTemplate, linkInput;

			if ( ! control.model.get( 'attachment_id' ) && ! control.model.get( 'url' ) ) {
				return;
			}

			previewContainer = control.$el.find( '.media-widget-preview' );
			previewTemplate = wp.template( 'wp-media-widget-image-preview' );
			previewContainer.html( previewTemplate( control.previewTemplateProps.toJSON() ) );
			previewContainer.addClass( 'populated' );

		},

	});

	// Exports.
	component.controlConstructors.yikes_card = yikesCardWidgetControl;
	component.modelConstructors.yikes_card = yikesCardWidgetModel;

})( wp.mediaWidgets, jQuery );
