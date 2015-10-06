(function() {
  var menuIteration;
  menuIteration = new TimelineMax({
    paused: true,
    onStart: function() {
      $(".button-open").addClass("button-close");
      return $(".button-close").removeClass("button-open");
    },
    onReverseComplete: function() {
      $(".button-close").addClass("button-open");
      return $(".button-open").removeClass("button-close");
    }
  });
  menuIteration.add(TweenMax.to(".menu", 0.3, {
    right: 0,
    ease: Quad.easeInOut
  }), 0);
  $(".item-1,.item-2").css("height", $(window).height());
  $(window).scrollTop(0);
  $(".menu").on("click", ".button-open a", function(e) {
    e.preventDefault();
    return menuIteration.play(0);
  });
  $(".menu").on("click", ".button-close a", function(e) {
    e.preventDefault();
    return menuIteration.reverse();
  });
  return $(".button-scroll").on("click", function(e) {
    e.preventDefault();
    return TweenMax.to(window, 0.3, {
      scrollTo: {
        y: $(window).height()
      },
      ease: Quad.easeInOut
    });
  });
})();
