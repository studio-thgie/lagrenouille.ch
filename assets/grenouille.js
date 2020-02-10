/* effects */
let elements_with_effects = document.querySelectorAll('[data-effect]');

ready(function () {

    elements_with_effects.forEach(el => {
        switch (el.dataset.effect) {
            case 'random-rotate':
                random_rotation(el, -15, 30);
                el.addEventListener('mouseover', function () {
                    random_rotation(el, -15, 30);
                })
                break;
            case 'random-rotate-hover':
                el.addEventListener('mouseover', function () {
                    random_rotation(el, -1, 1);
                })
                break;
            case 'random-padding':
                let padding = 1 + Math.random() * (window.innerWidth < 768 ? 1 : 8);
                el.style.padding = padding + 'em';
                break;
            case 'parallax':
                new simpleParallax(el, {
                    'scale': Math.random() * 2 + 1.5
                });
                break;
            case 'animation':
                var animation = bodymovin.loadAnimation({
                    container: el,
                    renderer: 'svg',
                    loop: el.dataset.loop || true,
                    autoplay: true,
                    path: el.dataset.animation
                })
                break;
            default:
                break;
        }
    });

    setTimeout(function () {
        var event = document.createEvent('HTMLEvents');
        event.initEvent('resize', true, false);
        window.dispatchEvent(event);

        if (typeof reservation_event !== 'undefined') {
            jQuery('#nf-field-12').val(reservation_event).trigger('change');
            jQuery('#nf-field-21').val(reservation_event).trigger('change');
        }
    }, 250);

    $('input[type="radio"]').on('click change', function(e) {
        $('.g-newsletter-form').addClass('hide');
        $('.g-newsletter-form__'+$('input[type="radio"]:checked').val()).removeClass('hide')
    });

});

jQuery(window).bind('load', function () {
    if (document.querySelector('.g-production__slideshow')) {
        var elem = document.querySelector('.g-production__slideshow');
        var flkty = new Flickity(elem, {
            wrapAround: true,
            autoPlay: true
        });
    }
})

function random_rotation(el, min, max) {
    let rotation = -15 + Math.round(Math.random() * 30);
    el.style.transform = 'rotate(' + rotation + 'deg)';
}

document.querySelectorAll('.g-shape--left').forEach(el => {
    el.style.top = Math.random() * (document.body.offsetHeight - el.offsetHeight * 2) + 'px';
});
document.querySelectorAll('.g-shape--right').forEach(el => {
    el.style.top = Math.random() * (document.body.offsetHeight - el.offsetHeight * 2) + 'px';
});

/* ui */
document.addEventListener('click', function (evt) {

    if (evt.target.matches('.g-info__list-item h2')) {
        document.querySelectorAll('.g-info__list-item--unfolded').forEach(function (el, i) {
            el.classList.remove('g-info__list-item--unfolded')
        });
        evt.target.parentNode.parentNode.classList.toggle('g-info__list-item--unfolded');
    }

    if (evt.target.matches('.g-btn__mobile-nav')) {
        document.querySelector('.g-nav').classList.toggle('g-nav--unfolded')
        document.querySelector('body').classList.toggle('g-nav--open')
    }

    if (evt.target.matches('.g-foldable__title')) {
        evt.target.querySelector('.g-button-foldable').classList.toggle('g-button-foldable--open');
        evt.target.parentNode.querySelector('.production__additional-block__content').classList.toggle('production__additional-block__content--open')
    }

}, false);

document.addEventListener('change', function (evt) {

    if (evt.target.matches('.g-programme__categories .categories')) {
		window.location = '?category='+document.querySelectorAll('.g-programme__categories .categories option:checked')[0].value
    }

}, false);

/* basics */
function ready(fn) {
    if (document.readyState != 'loading') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}