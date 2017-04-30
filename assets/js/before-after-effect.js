( function( $ ) {

	var PressElementsBeforeAfterEffect = function( $scope, $ ) {

		// Apply the dragging event
		$scope.find( '.twentytwenty-container' ).each( function() {

			$(this).twentytwenty({
				default_offset_pct: $(this).data( 'starting-position' ),
				orientation: $(this).data( 'orientation' )
			});

		});

	}

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/before-after-effect.default', PressElementsBeforeAfterEffect );
	} );

} )( jQuery );
