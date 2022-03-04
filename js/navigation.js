/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
( function( $ ) {
	// var container = document.getElementById( 'site-navigation' );
	var dropdownToggle = $( '<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		} ).append( $( '<span />', {
			'class': 'screen-reader-text',
			text: "expand child menu"
		} ) );

		$("#site-navigation").find( '.menu-item-has-children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		$("#site-navigation").find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		$("#site-navigation").find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		$("#site-navigation").find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

		$("#site-navigation").find( '.dropdown-toggle' ).click( function( e ) {
			var _this = $( this )

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		} );
} )( jQuery );

( function( $ ) {
	var container, button, menu, links, subMenus, linksTop;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];
	if ( window.innerWidth < 910 ) {
		menu.style.display = 'none';
	}

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
			menu.style.display = 'none';
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
			menu.style.display = 'block';
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( var i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	linksTop = document.getElementById( 'site-navigation-top' ).getElementsByTagName( 'ul' )[0];

	if( linksTop != undefined ) {
		linksTop = linksTop.getElementsByTagName( 'a' );

		for ( i = 0, len = linksTop.length; i < len; i++ ) {
			linksTop[i].addEventListener( 'focus', toggleFocus, true );
			linksTop[i].addEventListener( 'blur', toggleFocus, true );
		}
	}
	
	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		
		var self = this;
		var prevElement = self.parentElement;
		var toggleButton =  prevElement.getElementsByTagName('button')

		if ($(window).width() <= 640) {			
			if ( toggleButton.length > 0 ) {
	
				$(self).on('keydown', function (e) {
					var isTabPressed = e.key === 'Tab' || e.keyCode === 9;
		
					if (!isTabPressed) {
						return;
					};
					
					if (!e.shiftKey) {
						e.preventDefault();
						$(toggleButton[0]).focus();
						// $(toggleButton[0]).parent().removeClass('focus');
					};
		
				});
	
				$(toggleButton[0].className).on('keydown', function (e) {
					var isTabPressed = e.key === 'Tab' || e.keyCode === 9;
		
					if (!isTabPressed) {
						return;
					};
		
					if (e.shiftKey && toggleButton.hasClass('toggled-on')) {
						e.preventDefault();
						self.focus();
					};
				});
			}
		}

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) && -1 === self.className.indexOf( 'top-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )( jQuery );
