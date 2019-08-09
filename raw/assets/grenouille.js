/* effects */
let elements_with_effects = document.querySelectorAll('[data-effect]');

setTimeout(() => {

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
        
            default:
                break;
        }
    });
}, 500);

function random_rotation(el, min, max) {
    let rotation = -15 + Math.round(Math.random() * 30);
    el.style.transform = 'rotate('+rotation+'deg)';
}

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
