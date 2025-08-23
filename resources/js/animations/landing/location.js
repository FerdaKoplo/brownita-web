import gsap from "gsap";


export function locationAnimation() {
    // landing page location section
    const locationSection = document.querySelectorAll('#lokasi, #landingAddress, #landingMap')
    const helperButtons = document.querySelectorAll('#btnMap, #foundUsTitle, #btnSocialMedia')

    // animate location section
    gsap.set(locationSection, { opacity: 0, y: 30 });
    gsap.to(locationSection, {
        opacity: 1,
        y: 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out",
        scrollTrigger: {
            trigger: '#locationSection',
            start: "top 80%",
        }
    });
    gsap.set(helperButtons, { opacity: 0, scale: 0 });
    gsap.to(helperButtons, {
        opacity: 1,
        stagger: 0.3,
        duration: 1.2,
        scale: 1,
        ease: "elastic.out",
        scrollTrigger: {
            trigger: '#locationSection',
            start: "top 60%",
        }
    });
}
