Collejo.image.lazyLoad = function(img) {
    img.hide();
    img.each(function(i) {
        if (this.complete) {
            $(this).fadeIn();
        } else {
            $(this).load(function() {
                $(this).fadeIn(500);
            });
        }
    });
}

Collejo.ready.push(function(scope) {
    Collejo.image.lazyLoad($(scope).find('img.img-lazy'));
});