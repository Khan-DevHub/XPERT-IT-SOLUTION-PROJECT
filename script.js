/* Subpage shared script: reveal + drag-to-scroll + cursor glow */
(function () {
    /* cursor glow */
    const cg = document.getElementById('cursorGlow');
    if (cg) {
        document.addEventListener('mousemove', e => {
            cg.style.left = e.clientX + 'px';
            cg.style.top = e.clientY + 'px';
        });
    }

    /* reveal-hidden */
    const reveals = document.querySelectorAll('.reveal-hidden');
    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver(entries => {
            entries.forEach(en => {
                if (en.isIntersecting) {
                    en.target.classList.add('reveal-visible');
                    io.unobserve(en.target);
                }
            });
        }, { threshold: 0.12 });
        reveals.forEach(el => io.observe(el));
    } else {
        reveals.forEach(el => el.classList.add('reveal-visible'));
    }

    /* drag-to-scroll all .scroll-x */
    document.querySelectorAll('.scroll-x').forEach(strip => {
        let isDown = false, startX, sl;
        strip.addEventListener('mousedown', e => {
            isDown = true; strip.classList.add('dragging');
            startX = e.pageX - strip.offsetLeft; sl = strip.scrollLeft;
        });
        strip.addEventListener('mouseleave', () => { isDown = false; strip.classList.remove('dragging'); });
        strip.addEventListener('mouseup', () => { isDown = false; strip.classList.remove('dragging'); });
        strip.addEventListener('mousemove', e => {
            if (!isDown) return; e.preventDefault();
            strip.scrollLeft = sl - (e.pageX - strip.offsetLeft - startX) * 1.4;
        });
    });

    /* navbar scroll shadow */
    const nav = document.getElementById('mainNav');
    if (nav) {
        window.addEventListener('scroll', () => {
            nav.classList.toggle('nav-scrolled', window.scrollY > 40);
        }, { passive: true });
    }

    /* VanillaTilt (if loaded) */
    if (typeof VanillaTilt !== 'undefined') {
        VanillaTilt.init(document.querySelectorAll('[data-tilt]'), {
            max: 10, speed: 400, glare: true, 'max-glare': 0.15
        });
    }
})();
