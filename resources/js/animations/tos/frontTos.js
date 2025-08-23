import gsap from "gsap";

export function frontTOSPageAnimate() {
    const frontPageTOS = document.querySelectorAll('#tosTitle, #greetMain')
    const btnTOS = document.querySelectorAll('.tos-btn')

    gsap.set(btnTOS, { opacity: 0, scale: 0 });
    gsap.to(btnTOS, {
        opacity: 1,
        scale: 1,
        stagger: 0.1,
        duration: 1.2,
        ease: "elastic.out"
    });

    gsap.set(frontPageTOS, { opacity: 0, y: 60 });
    gsap.to(frontPageTOS, {
        opacity: 1,
        y: 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out"
    });
}
