do ->
	documentH = $(window).height() - 51
	documentW = $(window).width() - 300

	$ ".cmp-content"
	.css "width", documentW + "px"
	.css "height", documentH + "px"

	$ ".cmp-access"
	.css "height", documentH + "px"

	$ ".act-show-lightbox"
	.on "click", (event) ->
		event.preventDefault();

		$ ".cmp-overlay"
		.fadeIn( 250 )

		$ ".cmp-lightbox"
		.fadeIn( 250 )
		return

	$ ".act-hide-lightbox"
	.on "click", (event) ->
		event.preventDefault();
		$ ".cmp-overlay"
		.fadeOut( 250 )

		$ ".cmp-lightbox"
		.fadeOut( 250 )
		return

