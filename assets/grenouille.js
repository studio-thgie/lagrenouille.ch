/* effects */
let elements_with_effects = document.querySelectorAll('[data-effect]');

ready(function(){

    elements_with_effects.forEach(el => {
        switch (el.dataset.effect) {
            case 'random-rotate':
                random_rotation(el, -15, 30);
                el.addEventListener('mouseover', function(){
                    random_rotation(el, -15, 30);
                })
                break;
            case 'random-rotate-hover':
                el.addEventListener('mouseover', function(){
                    random_rotation(el, -1, 1);
                })
                break;
            case 'random-padding':
                let padding = 1 + Math.random() * 10;
                el.style.padding = padding+'em';
                break;
            case 'parallax':
                new simpleParallax(el, {
                    'scale': 2.5,
                    'delay': 0
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

    var event = document.createEvent('HTMLEvents');
    event.initEvent('resize', true, false);
    window.dispatchEvent(event);

});

function random_rotation(el, min, max) {
    let rotation = -15 + Math.round(Math.random() * 30);
    el.style.transform = 'rotate('+rotation+'deg)';
}

document.querySelectorAll('.g-shape--left').forEach(el => {
    el.style.top = Math.random() * (document.body.offsetHeight - el.offsetHeight + 100) + 'px';
});
document.querySelectorAll('.g-shape--right').forEach(el => {
    el.style.top = Math.random() * (document.body.offsetHeight - el.offsetHeight + 100) + 'px';
});

/* info ui */
document.addEventListener('click', function (evt) {

	if (evt.target.matches('.g-info__list-item h2')) {
        document.querySelectorAll('.g-info__list-item--unfolded').forEach(function(el, i){
            el.classList.remove('g-info__list-item--unfolded')
        });
		evt.target.parentNode.parentNode.classList.toggle('g-info__list-item--unfolded');
    }
    
	if (evt.target.matches('.g-btn__mobile-nav')) {
        document.querySelector('.g-nav').classList.toggle('g-nav--unfolded')
    }

}, false);

/* basics */
function ready(fn) {
    if (document.readyState != 'loading'){
      fn();
    } else {
      document.addEventListener('DOMContentLoaded', fn);
    }
  }
  
  