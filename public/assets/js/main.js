const openBtn = document.getElementById('openBtn');
const landing = document.getElementById('landing');
const transition = document.getElementById('transition');
const mainContent = document.getElementById('mainContent');

openBtn.addEventListener("click", () => {
    transition.classList.remove('hidden');

    const skipBtn = document.getElementById('skip-button');

    skipBtn.addEventListener("click", () => {
        gsap.globalTimeline.clear();

        landing.classList.add('hidden');
        transition.classList.add('hidden');
        mainContent.classList.remove('hidden');

        showSection("opening");
        animateSectionContent("opening");
        animateSectionContent("date");
        animateSectionContent("quotes");
        animateSectionContent("barcode");
        animateSectionContent("gallery");
        animateSectionContent("wedding-gift");
    });


    const tl = gsap.timeline();

    tl.to("#landing", {
        opacity: 0,
        duration: 0.4,
        ease: "power2.inOut",
        onComplete: () => {
            document.getElementById("landing").style.display = "none";
        },
    });

    const bgMusic = document.getElementById("bg-music");
    if (bgMusic) {
        bgMusic.play().catch(error => {
            console.log("Music play prevented:", error);
        });
    }

    tl.set("#transition", { pointerEvents: "all" }, "+=0.1")
        .to("#transition", { opacity: 1, duration: 0.5, ease: "power2.out" })
        .fromTo("#transition-img", { scale: 0.8, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.5, ease: "back.out(1.5)" })
        .fromTo("#ground", { y: 100, opacity: 0 }, { y: 0, opacity: 1, duration: 1, ease: "power3.out" }, "+=0.2")
        .fromTo(
            "#bride",
            { y: 40, scale: 0.85, opacity: 0, transformOrigin: "50% 100%" },
            { y: 0, scale: 1, opacity: 1, duration: 1.4, ease: "back.out(1.0)" },
            "+=0.2"
        )
        .set("#cloud", { left: "-100px", bottom: "200px", opacity: 0 })
        .set("#cloud2", { left: "-500px", top: "100px", opacity: 0 })

        .to("#cloud", {
            left: "calc(10% + 100px)",
            bottom: "700px",
            opacity: 1,
            duration: 1,
            ease: "power1.inOut"
        }, "+=0")

        .to("#cloud2", {
            left: "calc(50% + 200px)",
            top: "0px",
            opacity: 1,
            duration: 1,
            ease: "power1.inOut"
        }, "<")

        .to(["#cloud", "#cloud2"], { y: "+=8", duration: 2, yoyo: true, repeat: -1, ease: "sine.inOut" }, "-=0.2")
        .fromTo(["#leftLeaf", "#leftLeaf2", "#rightLeaf", "#rightLeaf2", "#leftFlower", "#rightFlower", "#leftLeaf3", "#rightLeaf3"], {
            y: 100, opacity: 0
        }, {
            y: 0, opacity: 1, duration: 0.5, ease: "power3.out"
        }, "-=2.5")
        .to(["#leftLeaf", "#leftLeaf2", "#rightLeaf", "#rightLeaf2", "#leftFlower", "#rightFlower", "#leftLeaf3", "#rightLeaf3"], {
            rotate: 10, duration: 1, yoyo: true, repeat: -1, ease: "sine.inOut"
        }, "-=0")
        .set("#birds", {
            left: "-200px",
            bottom: "200px",
            opacity: 0
        })
        .to("#birds", {
            left: "calc(100% + 200px)",
            bottom: "700px",
            opacity: 1,
            duration: 3,
            ease: "power1.inOut"
        }, "+=0.2")
        .to("#transition", {
            opacity: 0,
            duration: 0.5,
            ease: "power2.in"
        })

        .call(() => {
            const transition = document.getElementById("transition");
            const landing = document.getElementById("landing");
            const mainContent = document.getElementById("mainContent");

            landing.classList.add('hidden');
            transition.classList.add('hidden');
            mainContent.classList.remove('hidden');
            showSection("opening");
            animateSectionContent("opening");
            animateSectionContent("date");
            animateSectionContent("quotes");
            animateSectionContent("barcode");
            animateSectionContent("gallery");
            animateSectionContent("wedding-gift");
            animateSectionContent("video");
        });
});

function scrollToSection(id) {
    const target = document.getElementById(id);
    if (!target) return;

    const startPosition = window.scrollY;
    const targetPosition = target.getBoundingClientRect().top + window.scrollY;
    const distance = targetPosition - startPosition;

    const baseDuration = 600;
    const maxDuration = 1200;
    const distanceFactor = Math.min(Math.abs(distance) / 1000, 1);
    const duration = baseDuration + (maxDuration - baseDuration) * distanceFactor;

    let start = null;

    function easeOutBack(t) {
        const c1 = 1.70158;
        const c3 = c1 + 1;
        return 1 + c3 * Math.pow(t - 1, 3) + c1 * Math.pow(t - 1, 2);
    }

    function animation(currentTime) {
        if (!start) start = currentTime;
        const timeElapsed = currentTime - start;
        const progress = Math.min(timeElapsed / duration, 1);
        const easedProgress = easeOutBack(progress);

        window.scrollTo(0, startPosition + distance * easedProgress);

        if (timeElapsed < duration) {
            requestAnimationFrame(animation);
        } else {
            animateSectionContent(id);
        }
    }

    requestAnimationFrame(animation);
}

function showSection(sectionId) {
    const section = document.getElementById(sectionId);
    section.style.display = "flex";
    gsap.fromTo(section, { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 1 });
}

function animateSectionContent(sectionId) {
    switch (sectionId) {
        case "couple":
            if (!document.querySelector(`#${sectionId} .couple-flower-r`).dataset.animated) {
                gsap.to(`#${sectionId} .couple-flower-r`, {
                    scale: 1.1,
                    rotation: 10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .couple-flower-r`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .couple-flower-l`).dataset.animated) {
                gsap.to(`#${sectionId} .couple-flower-l`, {
                    scale: 1.1,
                    rotation: -10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.5,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .couple-flower-l`).dataset.animated = true;
            }

            gsap.set(`#${sectionId} .font-rouge, #couple .font-dmSerif`, {
                y: 30,
                opacity: 0
            });

            gsap.to(`#${sectionId} .font-rouge, #couple .font-dmSerif`, {
                y: 0,
                opacity: 1,
                stagger: 0.2,
                duration: 1,
                ease: "power2.out"
            });

            break;

        case "opening":
            if (!document.querySelector(`#${sectionId} .opening-flower-1`).dataset.animated) {
                gsap.to(`#${sectionId} .opening-flower-1`, {
                    scale: 1.1,
                    rotation: 10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .opening-flower-1`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .opening-flower-2`).dataset.animated) {
                gsap.to(`#${sectionId} .opening-flower-2`, {
                    scale: 1.1,
                    rotation: -10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.5,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .opening-flower-2`).dataset.animated = true;
            }

            gsap.set(`#${sectionId} .font-brittany, #opening .font-dmSerif, .nz-logo`, {
                y: 30,
                opacity: 0
            });

            gsap.to(`#${sectionId} .font-brittany, #opening .font-dmSerif, .nz-logo`, {
                y: 0,
                opacity: 1,
                stagger: 0.2,
                duration: 1,
                ease: "power2.out"
            });

            break;

        case "date":
            if (!document.querySelector(`#${sectionId} .date-flower-1`).dataset.animated) {
                gsap.to(`#${sectionId} .date-flower-1`, {
                    scale: 1.1,
                    rotation: 10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .date-flower-1`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .date-flower-2`).dataset.animated) {
                gsap.to(`#${sectionId} .date-flower-2`, {
                    scale: 1.1,
                    rotation: -10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.5,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .date-flower-2`).dataset.animated = true;
            }

            gsap.set(`#${sectionId} .date-barcode`, {
                opacity: 0,
                x: 100,
                scale: 0.5
            });

            gsap.to(`#${sectionId} .date-barcode`, {
                opacity: 1,
                x: 0,
                scale: 1,
                duration: 1.2,
                ease: "back.out(1.7)",
                delay: 0.5
            });

            gsap.set(`#${sectionId} .font-brittany, 
              #${sectionId} .font-rouge, 
              #${sectionId} .font-raleway, 
              #date .font-dmSerif, 
              #${sectionId} .date-location-barcode, 
              #${sectionId} .date-line-decor`, {
                y: 30,
                opacity: 0
            });

            gsap.to(`#${sectionId} .font-brittany, 
             #${sectionId} .font-rouge, 
             #${sectionId} .font-raleway, 
             #date .font-dmSerif, 
             #${sectionId} .date-location-barcode, 
             #${sectionId} .date-line-decor`, {
                y: 0,
                opacity: 1,
                stagger: 0.2,
                duration: 1,
                ease: "power2.out"
            });

            break;

        case "quotes":
            if (!document.querySelector(`#${sectionId} .quotes-flower-1`).dataset.animated) {
                gsap.to(`#${sectionId} .quotes-flower-1`, {
                    scale: 1.1,
                    rotation: 10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .quotes-flower-1`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .quotes-flower-2`).dataset.animated) {
                gsap.to(`#${sectionId} .quotes-flower-2`, {
                    scale: 1.1,
                    rotation: -10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.5,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .quotes-flower-2`).dataset.animated = true;
            }

            gsap.set(`#${sectionId} .font-dmSerif, 
              #${sectionId} .quotes-text, 
              #${sectionId} .quotes-line-decor`, {
                y: 30,
                opacity: 0
            });

            gsap.to(`#${sectionId} .font-dmSerif, 
             #${sectionId} .quotes-text, 
             #${sectionId} .quotes-line-decor`, {
                y: 0,
                opacity: 1,
                stagger: 0.2,
                duration: 1,
                ease: "power2.out"
            });

            break;

        case "barcode":
            if (!document.querySelector(`#${sectionId} .barcode-flower-t`).dataset.animated) {
                gsap.to(`#${sectionId} .barcode-flower-t`, {
                    scale: 1.1,
                    rotation: 10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .barcode-flower-t`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .barcode-flower-l`).dataset.animated) {
                gsap.to(`#${sectionId} .barcode-flower-l`, {
                    scale: 1.1,
                    rotation: -10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.5,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .barcode-flower-l`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .barcode-flower-r`).dataset.animated) {
                gsap.to(`#${sectionId} .barcode-flower-r`, {
                    scale: 1.1,
                    rotation: -10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.5,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .barcode-flower-r`).dataset.animated = true;
            }

            gsap.set(`#${sectionId} .font-dmSerif, 
              #${sectionId} .barcode-text, 
              #${sectionId} .barcode-line-decor`, {
                y: 30,
                opacity: 0
            });

            gsap.to(`#${sectionId} .font-dmSerif, 
             #${sectionId} .barcode-text, 
             #${sectionId} .barcode-line-decor`, {
                y: 0,
                opacity: 1,
                stagger: 0.2,
                duration: 1,
                ease: "power2.out"
            });

            break;

        case "gallery": {
            const gridEl = document.querySelector(`#${sectionId} .grid`);
            if (!gridEl) break;

            const items = gsap.utils.toArray(`#${sectionId} .grid > *`);
            if (!items.length) break;

            if (gridEl._galleryTl) {
                gridEl._galleryTl.kill();
                gridEl._galleryTl = null;
            }

            gsap.set(items, {
                opacity: 0,
                y: 20,
                pointerEvents: 'none'
            });

            const tl = gsap.timeline();

            const duration = 0.2;
            items.forEach(item => {
                tl.to(item, {
                    opacity: 1,
                    y: 0,
                    pointerEvents: 'auto',
                    duration: duration,
                    ease: 'power2.out'
                });
            });

            gridEl._galleryTl = tl;

            break;
        }

        case "wedding-gift":
            if (!document.querySelector(`#${sectionId} .wedding-gift-leaf-r`).dataset.animated) {
                gsap.to(`#${sectionId} .wedding-gift-leaf-r`, {
                    scale: 1.1,
                    rotation: 10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .wedding-gift-leaf-r`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .wedding-gift-flower-3`).dataset.animated) {
                gsap.to(`#${sectionId} .wedding-gift-flower-3`, {
                    scale: 1.1,
                    rotation: -10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.5,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .wedding-gift-flower-3`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .wedding-gift-leaf-l`).dataset.animated) {
                gsap.to(`#${sectionId} .wedding-gift-leaf-l`, {
                    scale: 1.1,
                    rotation: -10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.5,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .wedding-gift-leaf-l`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .wedding-gift-flower-4`).dataset.animated) {
                gsap.to(`#${sectionId} .wedding-gift-flower-4`, {
                    scale: 1.1,
                    rotation: 10,
                    yoyo: true,
                    repeat: -1,
                    duration: 2,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .wedding-gift-flower-4`).dataset.animated = true;
            }

            gsap.fromTo(`#${sectionId} .wedding-gift-bride`,
                { scale: 0.5, opacity: 0 },
                { scale: 1.3, opacity: 1, duration: 2, ease: "back.out(1.7)" }
            );

            gsap.fromTo(`#${sectionId} .wedding-gift-groom`,
                { scale: 0.5, opacity: 0 },
                { scale: 1.3, opacity: 1, duration: 2, ease: "back.out(1.7)", delay: 0.2 }
            );

            gsap.set(`#${sectionId} .wedding-gift-text, 
              #${sectionId} .wedding-gift-title,
              #${sectionId} .wedding-gift-btn`, {
                y: 30,
                opacity: 0
            });

            gsap.to(`#${sectionId} .wedding-gift-text, 
             #${sectionId} .wedding-gift-title,
             #${sectionId} .wedding-gift-btn`, {
                y: 0,
                opacity: 1,
                stagger: 0.2,
                duration: 1,
                ease: "power2.out",
                delay: 0.5
            });

            break;

        case "video":
            if (!document.querySelector(`#${sectionId} .video-flower-r`)?.dataset.animated) {
                gsap.to(`#${sectionId} .video-flower-r`, {
                    scale: 1.06,
                    rotation: 6,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.2,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .video-flower-r`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .video-flower-l`)?.dataset.animated) {
                gsap.to(`#${sectionId} .video-flower-l`, {
                    scale: 1.06,
                    rotation: -6,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.6,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .video-flower-l`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .video-leaf-r`)?.dataset.animated) {
                gsap.to(`#${sectionId} .video-leaf-r`, {
                    y: -10,
                    rotation: 8,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.4,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .video-leaf-r`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .video-leaf-l`)?.dataset.animated) {
                gsap.to(`#${sectionId} .video-leaf-l`, {
                    y: -12,
                    rotation: -6,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.8,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .video-leaf-l`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .video-border-tr`)?.dataset.animated) {
                gsap.to(`#${sectionId} .video-border-tr`, {
                    scale: 1.02,
                    yoyo: true,
                    repeat: -1,
                    duration: 3.2,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .video-border-tr`).dataset.animated = true;
            }
            if (!document.querySelector(`#${sectionId} .video-border-tl`)?.dataset.animated) {
                gsap.to(`#${sectionId} .video-border-tl`, {
                    scale: 1.02,
                    yoyo: true,
                    repeat: -1,
                    duration: 2.9,
                    ease: 'sine.inOut'
                });
                document.querySelector(`#${sectionId} .video-border-tl`).dataset.animated = true;
            }

            if (!document.querySelector(`#${sectionId} .font-brittany`)?.dataset.animated) {
                gsap.set(`#${sectionId} .font-brittany, #${sectionId} video`, { y: 30, opacity: 0 });
                gsap.to(`#${sectionId} .font-brittany, #${sectionId} video`, {
                    y: 0,
                    opacity: 1,
                    stagger: 0.18,
                    duration: 1,
                    ease: "power2.out"
                });
                document.querySelector(`#${sectionId} .font-brittany`).dataset.animated = true;
            }

            break;
    }
}


window.addEventListener('DOMContentLoaded', () => {
    const tl = gsap.timeline();

    tl.from("#circle", {
        scale: 0,
        duration: 1,
        ease: "back.out(1.7)",
    })
        .from("#nz", {
            scale: 0,
            duration: 1,
            ease: "back.out(1.7)",
        }, "-=0.5")

        .from("#flower1", {
            scale: 0,
            duration: 1,
            ease: "back.out(1.7)",
        }, "-=0.7")

        .from("#flower2", {
            scale: 0,
            duration: 1,
            ease: "back.out(1.7)",
        }, "-=0.9");

    gsap.from("#borderTR", {
        opacity: 0,
        scale: 0.8,
        duration: 2,
        ease: "power2.out"
    });

    gsap.from("#borderBL", {
        opacity: 0,
        scale: 0.8,
        duration: 2,
        delay: 0.3,
        ease: "power2.out"
    });

    gsap.to("#circle", {
        rotate: 360,
        duration: 20,
        repeat: -1,
        ease: "linear"
    });

    gsap.to("#flower1", {
        rotate: 10,
        duration: 2,
        yoyo: true,
        repeat: -1,
        ease: "sine.inOut"
    });

    gsap.to("#flower2", {
        rotate: -10,
        duration: 2.5,
        yoyo: true,
        repeat: -1,
        ease: "sine.inOut"
    });
});