do ->

	# Set timeline for main menu 
	menuIteration = new TimelineMax
		paused: true
		onStart: ->
			$(".button-open").addClass "button-close"
			$(".button-close").removeClass "button-open"
		onReverseComplete: ->
			$(".button-close").addClass "button-open"
			$(".button-open").removeClass "button-close"


	menuIteration.add(TweenMax.to(".menu", 0.3,
		right: 0
		ease: Quad.easeInOut
	),0)

	# Set height for fullbrowser div's
	$(".item-1,.item-2").css "height", $(window).height()
	# Set scroll to 0 on page load
	$(window).scrollTop 0

	# Set click for main menu open
	$(".menu").on "click", ".button-open a", (e) ->
		e.preventDefault()
		menuIteration.play(0)

	# Set click for main menu close
	$(".menu").on "click", ".button-close a", (e) ->
		e.preventDefault()
		menuIteration.reverse()

	# Set scroll home animation
	$(".button-scroll").on "click", (e) ->
		e.preventDefault()

		TweenMax.to window, 0.3,
			scrollTo:
				y: $(window).height()
			ease: Quad.easeInOut