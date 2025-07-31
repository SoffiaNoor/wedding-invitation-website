import './bootstrap';
import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', () => {
    const {
        clickText,
    } = {
        clickText: document.querySelector('.click-text'),
    };

    const bounceAnim = gsap.to(".clickHere", {
        y: -10,
        duration: 1,
        ease: 'power1.inOut',
        yoyo: true,
        repeat: -1,
    });

    clickText?.addEventListener('click', () => {
        bounceAnim.kill();
        animateIntroSection();
        animateEnvelopeTransition();
    });

    document.getElementById('goBack')?.addEventListener('click', () => {
        resetToIntro();
    });
});

function animateIntroSection() {
    gsap.to('#intro', {
        duration: 4,
        delay: 0.5,
        ease: 'bounce.out',
        onStart: () => {
            document.getElementById('panggung').classList.remove('hidden');
            document.getElementById('bungaBawah').classList.remove('hidden');
            gsap.to('#intro', {
                backgroundColor: '#FFFFFF',
            });

            gsap.fromTo(
                '#panggung',
                { opacity: 0, scale: 0 },
                {
                    opacity: 1,
                    scale: 1,
                    duration: 1,
                    ease: 'back.out(1.7)',
                    onComplete: () => {
                        gsap.to('#intro', {
                            opacity: 0,
                            duration: 0.5,
                            onComplete: () => startLeafAndFlowerAnimations(),
                        });
                    },
                }
            );
        },
    });
}

function animateEnvelopeTransition() {
    gsap.to('.click-here', { y: 1000, duration: 0.5, ease: 'power3.in' });

    gsap.to('.envelope', {
        y: -1000,
        duration: 2,
        ease: 'bounce.out',
        delay: 0.3,
        onComplete: () => {
            gsap.to('#opening', {
                opacity: 1,
                duration: 0.5,
                delay: 2,
                onStart: () => togglePointer('#page1', true),
                onComplete: () => revealPage1(),
            });
        },
    });
}

function startLeafAndFlowerAnimations() {
    const leaves = [
        { id: '#awanKiri', fromX: -200 },
        { id: '#awanKanan', fromX: 200 },
        { id: '#daunKiri', fromX: -300 },
        { id: '#daunKiri2', fromX: -300 },
        { id: '#daunKanan', fromX: 300 },
        { id: '#daunKanan2', fromX: 300 },
    ];
    leaves.forEach(({ id, fromX }) => animateLeaf(id, fromX));
    animateFlower('#bungaBawah');
}

function revealPage1() {
    gsap.to('#page1', {
        opacity: 1,
        duration: 0.5,
        onStart: () => togglePointer('#page1', true),
        onComplete: () => animatePage1Elements(),
    });
}

function animatePage1Elements() {
    gsap.fromTo(
        '.background1',
        { scale: 0, opacity: 0 },
        { scale: 1, opacity: 1, duration: 0.5, ease: 'power2.out' }
    );

    ['#flower1', '#flower2'].forEach((selector, idx) => {
        const rotation = idx === 0 ? 10 : -10;
        gsap.to(selector, {
            rotation,
            duration: 2,
            ease: 'sine.inOut',
            repeat: -1,
            yoyo: true,
        });

        gsap.fromTo(
            selector,
            { x: 200, y: 200, scale: 0.5, opacity: 0, rotation: 0 },
            { x: 0, y: 0, scale: 1, opacity: 1, duration: 1.5, ease: 'back.out(1.7)', delay: 0.5 }
        );
    });

    [['#bottomNav', 'y', 50], ['#borderLeft', 'y', -100], ['#borderRight', 'y', -100]].forEach(
        ([sel, prop, fromValue]) => {
            const props = { duration: 0.8, ease: 'power2.out', delay: 1.2 };
            const from = { opacity: 0 };
            from[prop] = fromValue;
            gsap.fromTo(sel, from, { ...props, [prop]: 0, opacity: 1 });
        }
    );
}

function animateLeaf(id, fromX) {
    gsap.set(id, { x: fromX, scale: 0.5, opacity: 0 });
    gsap.to(id, {
        x: fromX > 0 ? 100 : -100,
        scale: 1,
        opacity: 1,
        duration: 3,
        ease: 'power3.out',
        onComplete: () => {
            gsap.to(id, { x: '-=40', duration: 3, ease: 'sine.inOut', yoyo: true, repeat: -1 });
        },
    });
}

function animateFlower(id) {
    gsap.set(id, { y: 300, scale: 0.5, opacity: 0 });
    gsap.to(id, {
        y: 0,
        scale: 1.5,
        opacity: 1,
        duration: 1.2,
        ease: 'power3.out',
        onComplete: () => {
            gsap.to(id, { y: '-=20', duration: 2, ease: 'sine.inOut', yoyo: true, repeat: -1 });
        },
    });
}

function resetToIntro() {
    document.getElementById('panggung').classList.add('hidden');
    document.getElementById('bungaBawah').classList.add('hidden');

    ['#page1', '#opening'].forEach(id => {
        gsap.to(id, { opacity: 0, duration: 0.5, onComplete: () => (document.querySelector(id).style.pointerEvents = 'none') });
    });

    const intro = document.getElementById('intro');
    intro.style.display = 'block';
    intro.style.backgroundColor = '';
    gsap.to(intro, { opacity: 1, duration: 0.5, onStart: () => (intro.style.pointerEvents = 'auto') });

    gsap.set('.envelope', { y: 0 });
    gsap.set('.click-here', { y: 0, opacity: 1 });
    gsap.to('.click-here', { y: -10, duration: 0.5, ease: 'power1.inOut', yoyo: true, repeat: -1 });
}

function togglePointer(selector, enable) {
    const el = document.querySelector(selector);
    if (enable) {
        el.classList.remove('pointer-events-none');
        el.classList.add('z-20');
    } else {
        el.classList.add('pointer-events-none');
        el.classList.remove('z-20');
    }
}