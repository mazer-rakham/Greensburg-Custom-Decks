/* global compellingMenuText */
/**
 * File compelling.js
 *
 * Handles all JavaScript functions
 *
 */
jQuery( document ).ready( function( $ ) {
	var body = $( 'body' );
	var container = $( '.site-navigation' );
	var button = $( '.panel-toggle' );
	var menu = container.find( 'ul' );
	var panel = $( '.panel' );
	
	if ( ! button || ! menu ) {
		return;
	}
	
	button.attr( 'aria-expanded', 'false' );
	menu.attr( 'aria-expanded', 'false' );
	
	button.on( 'click', function( e ) {
		e.preventDefault();
		
		body.toggleClass( 'panel-active' );
		if ( body.hasClass( 'panel-active' ) ) {
			button.attr( 'aria-expanded', 'true' );
			button.html( '<span class="screen-reader-text">' + compellingMenuText.close + '</span><span class="icon">' );
			menu.attr( 'aria-expanded', 'true' );
		} else {
			button.attr( 'aria-expanded', 'false' );
			button.html( '<span class="screen-reader-text">' + compellingMenuText.open + '</span><span class="icon">' );
			menu.attr( 'aria-expanded', 'false' );
		}
	} );
	
	function debounce( func, wait, immediate ) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if ( ! immediate ) {
					func.apply( context, args );
				}
			};
			var callNow = immediate && ! timeout;
			clearTimeout( timeout );
			timeout = setTimeout( later, wait );
			if ( callNow ) {
				func.apply( context, args );
			}
		};
	}
	
	var shouldPanelMove = debounce( function() {
		if ( ! body.hasClass( 'admin-bar' ) || $( window ).width() > 782 ) {
			return;
		}
		
		var height = $( window ).scrollTop();
		
		if ( height > 46 ) {
			body.addClass( 'scroll-below-admin-bar' );
		} else {
			body.removeClass( 'scroll-below-admin-bar' );
		}
	}, 150 );
	
	window.addEventListener( 'scroll', shouldPanelMove );
} );
