

  var elem = document.querySelector('.scroller');
var infScroll = new InfiniteScroll( elem, {
  // options
  //  Prochaine route des paginations ds l'app
 path: '.pagination__next', 
 // Lieu (container) ou on ajoute
  append: '.scroller',
  history: false,
});

// element argument can be a selector string
//   for an individual element
var infScroll = new InfiniteScroll( '.scroller', {
  // options
});