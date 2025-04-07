document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.logo-carousel').forEach((el) => {
        new Swiper(el, {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 0, // Nessun ritardo tra le transizioni
                disableOnInteraction: false,
            },
            speed: 10000, // Rendi la velocità più lenta per un effetto continuo
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 1 },
                768: { slidesPerView: 1 },
                1024: { slidesPerView: 1 },
            }
        });
    });

    const swiper = new Swiper('.logo-marquee', {
        slidesPerView: 'auto', // Adatta automaticamente i loghi visibili sulla larghezza del viewport
        loop: true, // Abilita il loop continuo
        centeredSlides: false,
        autoplay: {
            delay: 0, // Nessun ritardo, per un effetto continuo
            disableOnInteraction: false,
        },
        speed: 3500, // Velocità dello scorrimento dei loghi
        grabCursor: true, // Permette l'interazione con il cursore
        observer: true, // Rileva quando gli swiper-elements vengono modificati
        observeParents: true, // Rileva quando i parent-elements dello swiper vengono modificati
        freeMode: true, // Permette uno scorrimento libero senza fermarsi ai singoli slide
    });
});
