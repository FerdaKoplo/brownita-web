import gsap from "gsap";

export function aboutAnimation(){

    // landing page about section
    const aboutSection = document.querySelectorAll('#aboutImage, #tentang-kami, #aboutDesc')

    gsap.set(aboutSection, { opacity: 0, y: -30 });
    gsap.to(aboutSection, {
        opacity: 1,
        y: 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out",
        scrollTrigger: {
            trigger: '#aboutSection',
            start: "top 80%",
        }
    });
}
