$(document).ready(function(){
    $('.main-carousel').flickity({
      contain: true,
      autoPlay: 4000,
      prevNextButtons: false,
      pageDots: false,
      wrapAround: true,
    });

    let cards = $('.carousel-card');

    function createIndicators() {
        let totalCards = cards.length;
        cards.each(function(index) {
            let indicatorContainer = $(this).find('.carousel-indicator');
            indicatorContainer.empty();
            for (let i = 0; i < totalCards; i++) {
                let button = $('<button></button>');
                let dot = $('<div></div>');
                if (i === index) {
                    button.addClass('button h-4');
                    dot.addClass('w-10 h-1 rounded-full bg-cp-dark-blue');
                } else {
                    button.addClass('button h-4');
                    dot.addClass('w-10 h-1 rounded-full bg-[#E8EAF2]');
                }
                dot.appendTo(button);
                button.appendTo(indicatorContainer);
            }
        });
    }

    createIndicators();

    $('.carousel-indicator').on( 'click', '.button', function() {
        let index = $(this).index();
        $('.main-carousel').flickity( 'select', index );
    });
});