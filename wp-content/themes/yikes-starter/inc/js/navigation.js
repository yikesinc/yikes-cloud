/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
( function() {
	var container, button, menu, links, subMenus;

	// Init dropdown menu functionality.
	dropdownMenuHandler();

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

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
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( var i = 0, len = subMenus.length; i < len; i++ ) {
		//subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

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
} )();

/* Handle main navigation dropdown menu. */
function dropdownMenuHandler() {
	const nav = document.getElementById('site-navigation');

	// If nav menu not found, exit function early.
	if ( null === nav ) {
		return;
	}

	const dropdowns = nav.querySelectorAll('.navbar-nav > li.dropdown');
	const subDropdowns = nav.querySelectorAll('.navbar-nav > li.dropdown li.dropdown');
	const subDropdownsArr = Array.from(subDropdowns);
	const dropdownsArr = Array.from(dropdowns);
	const allDropdowns = null !== subDropdowns ? dropdownsArr.concat(subDropdownsArr) : dropdownsArr;
	const navObj = {
		nav: nav,
		dropdowns: allDropdowns,
	}

	// Add event listeners to top-level dropdown menus.
	if ( null !== dropdowns ) {
		dropdownsArr.map(dropdown => {
			dropdown.addEventListener('click', toggleDropdown.bind(allDropdowns));
		});
	}

	// Add event listeners to sub-level dropdown menus.
	if ( null !== subDropdowns ) {
		subDropdownsArr.map(subDropdown => {
			subDropdown.addEventListener('click', toggleSubDropdown.bind(subDropdownsArr));
		});
	}

	// Close all menus on outside click.
	document.addEventListener( 'click', closeAllMenus.bind(navObj) );

	function toggleDropdown(e) {

		// Do nothing if clicking on a dropdown menu within the currently open dropdown menu.
		if ( ( e.target.parentNode !== e.currentTarget && e.target.parentNode.classList.contains('dropdown') ) || ( e.target.parentNode.parentNode !== e.currentTarget && e.target.parentNode.parentNode.classList.contains('dropdown') ) ) {
			return;
		}
		

		// Close all other dropdown menus that may be open.
		this.map(dropdown => {
			const menu = dropdown.querySelector('.dropdown-menu');
			if ( e.currentTarget !== dropdown && null !== menu ) {
				menu.classList.remove('show');
				const toggle = dropdown.querySelector('.dropdown-toggle');
				if ( toggle !== null ) {
					toggle.setAttribute('aria-expanded', 'false');
				}
			}
		});
		
		// Toggle dropdown menu on clicked dropdown toggle button.
		const menu = e.currentTarget.querySelector('.dropdown-menu');
		if (null !== menu) {
			menu.classList.toggle('show');
			const toggle = e.currentTarget.querySelector('.dropdown-toggle');
			if ( toggle !== null ) {
				if (menu.classList.contains('show')) {
					toggle.setAttribute('aria-expanded', 'true');
				} else {
					toggle.setAttribute('aria-expanded', 'false');
				}
			}
		}
	}

	function toggleSubDropdown(e) {

		// Close all other dropdown menus that may be open.
		this.map(subDropdown => {
			const menu = subDropdown.querySelector('.dropdown-menu');
			if ( e.currentTarget !== subDropdown && null !== menu ) {
				menu.classList.remove('show');
				subDropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
			}
		});

		// Toggle dropdown menu on clicked dropdown toggle button.
		const menu = e.currentTarget.querySelector('.dropdown-menu');
		if (null !== menu) {
			menu.classList.toggle('show');
			const toggle = e.currentTarget.querySelector('.dropdown-toggle');
			if ( toggle !== null ) {
				if (menu.classList.contains('show')) {
					toggle.setAttribute('aria-expanded', 'true');
				} else {
					toggle.setAttribute('aria-expanded', 'false');
				}
			}
		}
	}

	function closeAllMenus(e) {
		if (this.nav.contains(e.target)) {
			return;
		}

		// Close all dropdown menus.
		this.dropdowns.map(dropdown => {
			const menu = dropdown.querySelector('.dropdown-menu');
			if ( null !== menu ) {
				const toggle = dropdown.querySelector('.dropdown-toggle');
				if ( toggle !== null ) {
					menu.classList.remove('show');
					toggle.setAttribute('aria-expanded', 'false');
				}
			}
		});
	}
}