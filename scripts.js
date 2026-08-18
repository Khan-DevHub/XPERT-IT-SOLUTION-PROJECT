/* ── Scroll reveal ───────────────────────────────────────── */
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

/* ── 3-D card tilt on service cards ─────────────────────── */
document.querySelectorAll('[data-service-card]').forEach(card => {
    card.addEventListener('mousemove', e => {
        const r = card.getBoundingClientRect();
        const rx = ((e.clientY - r.top) / r.height - 0.5) * -16;
        const ry = ((e.clientX - r.left) / r.width - 0.5) * 16;
        card.style.transform = `perspective(700px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-8px)`;
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = '';
    });
});

/* ── Navbar scroll shadow ────────────────────────────────── */
const nav = document.getElementById('mainNav');
if (nav) {
    window.addEventListener('scroll', () => {
        nav.classList.toggle('nav-scrolled', window.scrollY > 40);
    }, { passive: true });
}

/* ── Stat counter animation ──────────────────────────────── */
function animateCounter(el) {
    const target = parseFloat(el.dataset.target);
    const suffix = el.dataset.suffix || '';
    const dur = 1400;
    const step = 16;
    const inc = target / (dur / step);
    let cur = 0;
    const t = setInterval(() => {
        cur += inc;
        if (cur >= target) { cur = target; clearInterval(t); }
        el.textContent = (Number.isInteger(target) ? Math.floor(cur) : cur.toFixed(0)) + suffix;
    }, step);
}
const statNums = document.querySelectorAll('.stat-num');
if (statNums.length && 'IntersectionObserver' in window) {
    const sio = new IntersectionObserver(entries => {
        entries.forEach(en => {
            if (en.isIntersecting) { animateCounter(en.target); sio.unobserve(en.target); }
        });
    }, { threshold: 0.5 });
    statNums.forEach(el => sio.observe(el));
}

/* ── Horizontal Scroll Logic ───────────────────────────────── */
const scrollContainers = [];

function setupHorizontalScroll(containerId, prevBtnId, nextBtnId) {
    const container = document.getElementById(containerId);
    const prevBtn = document.getElementById(prevBtnId);
    const nextBtn = document.getElementById(nextBtnId);

    if (!container || !prevBtn || !nextBtn) return;

    const scrollAmount = 350; // Adjust based on card width
    
    scrollContainers.push({ container, scrollAmount });

    nextBtn.addEventListener('click', () => {
        container.scrollLeft += scrollAmount;
    });

    prevBtn.addEventListener('click', () => {
        container.scrollLeft -= scrollAmount;
    });

    const toggleButtons = () => {
        prevBtn.style.opacity = container.scrollLeft <= 5 ? '0.3' : '1';
        prevBtn.style.pointerEvents = container.scrollLeft <= 5 ? 'none' : 'auto';
        
        const isAtEnd = container.scrollLeft + container.clientWidth >= container.scrollWidth - 10;
        nextBtn.style.opacity = isAtEnd ? '0.3' : '1';
        nextBtn.style.pointerEvents = isAtEnd ? 'none' : 'auto';
    };

    container.addEventListener('scroll', toggleButtons);
    window.addEventListener('resize', toggleButtons);
    setTimeout(toggleButtons, 100);
}

// Keyboard Navigation
window.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
        // Find the container most in view
        let activeContainer = null;
        let maxVisibleHeight = 0;

        scrollContainers.forEach(({ container }) => {
            const rect = container.getBoundingClientRect();
            const visibleHeight = Math.min(rect.bottom, window.innerHeight) - Math.max(rect.top, 0);
            
            if (visibleHeight > maxVisibleHeight) {
                maxVisibleHeight = visibleHeight;
                activeContainer = container;
            }
        });

        if (activeContainer) {
            const amount = 350;
            if (e.key === 'ArrowLeft') {
                activeContainer.scrollLeft -= amount;
            } else {
                activeContainer.scrollLeft += amount;
            }
            // Prevent default page scroll if we handled it
            e.preventDefault();
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    setupHorizontalScroll('servicesContainer', 'prevServices', 'nextServices');
    setupHorizontalScroll('testimonialsContainer', 'prevTestimonials', 'nextTestimonials');
});