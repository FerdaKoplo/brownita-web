import gsap from "gsap";

export function heroAnimation() {
    // landing page hero section
    const heroLanding = document.querySelectorAll('#heroTitle, #heroDesc, #heroButtons')
    const heroImages = document.querySelectorAll('#heroImg1, #heroImg2, #heroImg3')
    const heroImageBackground = document.querySelector('#heroImages')

    gsap.set(heroImages, { opacity: 0, scale: 0 });
    gsap.to(heroImages, {
        opacity: 1,
        stagger: 0.3,
        duration: 1.2,
        scale: 1,
        ease: "elastic.out"
    });

    gsap.set(heroImageBackground, { opacity: 0 });
    gsap.to(heroImageBackground, {
        opacity: 1,
        duration: 7,
    });

    gsap.set(heroLanding, { opacity: 0, y: -30 });
    gsap.to(heroLanding, {
        opacity: 1,
        y: 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out"
    });

}
