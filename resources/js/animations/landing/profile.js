import gsap from "gsap";

export function profileAnimation() {
    // landing page profil section
    const profilSection = document.querySelectorAll('#founder, #founderDesc')

    // animate profil section
    gsap.set(profilSection, { opacity: 0, scale: 0 });
    gsap.to(profilSection, {
        opacity: 1,
        stagger: 0.3,
        duration: 1.2,
        scale: 1,
        ease: "elastic.out",
        scrollTrigger: {
            trigger: '#profilSection',
            start: "top 80%",
        }
    });
}
