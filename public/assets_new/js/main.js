const openInvitation = document.getElementById("openInvitation");
const introScreen = document.getElementById("intro-screen");
const transitionScreen = document.getElementById("transition-screen");
const mainContent = document.getElementById("main-content");

openInvitation.addEventListener("click", () => {
    const tl = gsap.timeline();

    // Hide intro screen
    tl.to("#intro-screen", {
        opacity: 0,
        duration: 0.4,
        ease: "power2.inOut",
        onComplete: () => {
            document.getElementById("intro-screen").style.display = "none";
        },
    });

    // Play music
    const bgMusic = document.getElementById("bg-music");
    if (bgMusic) {
        bgMusic.play().catch(error => {
            console.log("Music play prevented:", error);
        });
    }

    // Show transition screen
    tl.set("#transition-screen", { pointerEvents: "all" }, "+=0.1")
        // .to("#transition-screen", { opacity: 1, duration: 0.5, ease: "power2.out" })
        // .fromTo("#transition-img", { scale: 0.8, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.5, ease: "back.out(1.5)" })
        // .fromTo("#ground", { y: 100, opacity: 0 }, { y: 0, opacity: 1, duration: 1, ease: "power3.out" }, "+=0.2")
        // .fromTo("#bride", { y: 100, opacity: 0 }, { y: 0, opacity: 1, duration: 1, ease: "power3.out" }, "+=0.2")
        // .fromTo(["#leftLeaf", "#leftLeaf2", "#rightLeaf", "#rightLeaf2", "#leftFlower", "#rightFlower"], {
        //     y: 100, opacity: 0
        // }, {
        //     y: 0, opacity: 1, duration: 1, ease: "power3.out"
        // }, "+=0.2")
        // .to(["#leftLeaf", "#leftLeaf2", "#rightLeaf", "#rightLeaf2", "#leftFlower", "#rightFlower"], {
        //     rotate: 10, duration: 1, yoyo: true, repeat: -1, ease: "sine.inOut"
        // }, "-=0.8")
        // .fromTo(["#leftLeaf3", "#rightLeaf3"], {
        //     y: 100, opacity: 0
        // }, {
        //     y: 0, opacity: 1, duration: 1, ease: "power3.out"
        // }, "+=0.2")
        // .to(["#leftLeaf3", "#rightLeaf3"], {
        //     rotate: 0, duration: 1, yoyo: true, repeat: -1, ease: "sine.inOut"
        // }, "-=0.8")
        // .set("#birds", {
        //     left: "-200px",
        //     bottom: "200px",
        //     opacity: 0
        // })
        // .to("#birds", {
        //     left: "calc(100% + 200px)",
        //     bottom: "700px",
        //     opacity: 1,
        //     duration: 3,
        //     ease: "power1.inOut"
        // }, "+=0.2")
        // .to("#transition-screen", {
        //     opacity: 0,
        //     duration: 0.5,
        //     ease: "power2.in"
        // })

        .call(() => {
            const transitionScreen = document.getElementById("transition-screen");
            const introScreen = document.getElementById("intro-screen");
            const mainContent = document.getElementById("main-content");

            transitionScreen.style.display = "none";
            introScreen.style.display = "none";
            mainContent.style.display = "block";
            showSection("opening");
            animateSectionContent("opening");
        });
});


const navBtns = document.querySelectorAll(".nav-btn");
let currentSection = "opening";

navBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        const target = btn.dataset.target;
        if (target !== currentSection) {
            transitionToSection(currentSection, target);
            currentSection = target;
        }
    });
});

function showSection(sectionId) {
    const section = document.getElementById(sectionId);
    section.style.display = "flex";
    gsap.fromTo(section, { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 1 });
}

function transitionToSection(fromId, toId) {
    const from = document.getElementById(fromId);
    const to = document.getElementById(toId);

    gsap.to(from, {
        opacity: 0,
        y: -50,
        duration: 0.6,
        onComplete: () => {
            from.style.display = "none";
            to.style.display = "flex";

            gsap.fromTo(to, { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 0.6 });

            animateSectionContent(toId);
        },
    });
}

function animateSectionContent(sectionId) {
    switch (sectionId) {
        case "couple":
            gsap.to(`#${sectionId} .couple-flower-r`, {
                scale: 1.1,
                rotation: 10,
                yoyo: true,
                repeat: -1,
                duration: 2,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .couple-flower-l`, {
                scale: 1.1,
                rotation: -10,
                yoyo: true,
                repeat: -1,
                duration: 2.5,
                ease: 'sine.inOut'
            });

            gsap.from(`#${sectionId} .font-rouge, #couple .font-dmSerif`, {
                y: 30,
                opacity: 0,
                stagger: 0.2
            });

            break;

        case "opening":
            gsap.to(`#${sectionId} .opening-flower-1`, {
                scale: 1.1,
                rotation: 10,
                yoyo: true,
                repeat: -1,
                duration: 2,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .opening-flower-2`, {
                scale: 1.1,
                rotation: -10,
                yoyo: true,
                repeat: -1,
                duration: 2.5,
                ease: 'sine.inOut'
            });

            gsap.from(`#${sectionId} .font-brittany, #opening .font-dmSerif`, {
                y: 30,
                opacity: 0,
                stagger: 0.2
            });

            break;

        case "date":
            gsap.to(`#${sectionId} .date-flower-1`, {
                scale: 1.1,
                rotation: 10,
                yoyo: true,
                repeat: -1,
                duration: 2,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .date-flower-2`, {
                scale: 1.1,
                rotation: -10,
                yoyo: true,
                repeat: -1,
                duration: 2.5,
                ease: 'sine.inOut'
            });

            gsap.from(`#${sectionId} .date-barcode`, {
                opacity: 0,
                x: 100,
                scale: 0.5,
                duration: 1.2,
                ease: "back.out(1.7)",
                delay: 0.5
            });

            gsap.from(`#${sectionId} .font-brittany, .font-rouge , .font-raleway,#date .font-dmSerif`, {
                y: 30,
                opacity: 0,
                stagger: 0.2
            });

            break;

        case "quotes":
            gsap.to(`#${sectionId} .quotes-flower-1`, {
                scale: 1.1,
                rotation: 10,
                yoyo: true,
                repeat: -1,
                duration: 2,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .quotes-flower-2`, {
                scale: 1.1,
                rotation: -10,
                yoyo: true,
                repeat: -1,
                duration: 2.5,
                ease: 'sine.inOut'
            });

            gsap.from(`#${sectionId} .font-dmSerif`, {
                y: 30,
                opacity: 0,
                stagger: 0.2
            });

            break;

        case "barcode":
            gsap.to(`#${sectionId} .barcode-flower-t`, {
                scale: 1.1,
                rotation: 10,
                yoyo: true,
                repeat: -1,
                duration: 2,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .barcode-flower-l`, {
                scale: 1.1,
                rotation: -10,
                yoyo: true,
                repeat: -1,
                duration: 2.5,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .barcode-flower-r`, {
                scale: 1.1,
                rotation: -10,
                yoyo: true,
                repeat: -1,
                duration: 2.5,
                ease: 'sine.inOut'
            });

            gsap.from(`#${sectionId} .font-dmSerif`, {
                y: 30,
                opacity: 0,
                stagger: 0.2
            });

            break;

        case "gallery":
            gsap.to(`#${sectionId} .gallery-leaf-r`, {
                scale: 1.1,
                rotation: 10,
                yoyo: true,
                repeat: -1,
                duration: 2,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .gallery-flower-l`, {
                scale: 1.1,
                rotation: -10,
                yoyo: true,
                repeat: -1,
                duration: 2.5,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .gallery-leaf-l`, {
                scale: 1.1,
                rotation: -10,
                yoyo: true,
                repeat: -1,
                duration: 2.5,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .gallery-flower-r`, {
                scale: 1.1,
                rotation: 10,
                yoyo: true,
                repeat: -1,
                duration: 2,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .gallery-images`, {
                opacity: 0,
                y: 30,
                duration: 0.8,
                stagger: 0.15,
                ease: "power2.out",
            });

            gsap.from(`#${sectionId} .font-brittany`, {
                y: 30,
                opacity: 0,
                stagger: 0.2
            });

            break;

        case "wedding-gift":
            gsap.to(`#${sectionId} .wedding-gift-leaf-r`, {
                scale: 1.1,
                rotation: 10,
                yoyo: true,
                repeat: -1,
                duration: 2,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .wedding-gift-bride`, {
                scale: 1.3,
                duration: 2,
                ease: "back.out(1.7)",
            });

            gsap.to(`#${sectionId} .wedding-gift-groom`, {
                scale: 1.3,
                duration: 2,
                ease: "back.out(1.7)",
            });

            gsap.to(`#${sectionId} .wedding-gift-flower-3`, {
                scale: 1.1,
                rotation: -10,
                yoyo: true,
                repeat: -1,
                duration: 2.5,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .wedding-gift-leaf-l`, {
                scale: 1.1,
                rotation: -10,
                yoyo: true,
                repeat: -1,
                duration: 2.5,
                ease: 'sine.inOut'
            });

            gsap.to(`#${sectionId} .wedding-gift-flower-4`, {
                scale: 1.1,
                rotation: 10,
                yoyo: true,
                repeat: -1,
                duration: 2,
                ease: 'sine.inOut'
            });

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