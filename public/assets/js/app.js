function normalizeSlideHeights() {
    $('.carousel-text').each(function(){
        var items = $('.carousel-item', this);
        var itemsInner = $('.crousel-item-inner', this);
        // reset the height
        items.css('min-height', 0);
        // set the height
        var maxHeight = Math.max.apply(null, 
            items.map(function(){
                return $(this).outerHeight()}).get() 
        );

        items.css('min-height', maxHeight + 'px');
        itemsInner.css('min-height', maxHeight + 'px');
    })
}

$('#imageModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('image');
    var modal = $(this);
    modal.find('.modal-body img')[0].src = recipient;
})

$(window).on(
    'load resize orientationchange', 
    normalizeSlideHeights
);