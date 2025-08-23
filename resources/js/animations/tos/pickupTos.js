import gsap from "gsap";

export function pickupTOSAnimate(){
    const pickupPageTOSTitle = document.querySelectorAll('#pickupTOSTitle')
    const rowPickupPageTOSTitle = document.querySelector("#row-animate-pickup")

    gsap.set(pickupPageTOSTitle, { opacity: 0, y: -60 });
    gsap.to(pickupPageTOSTitle, {
        opacity: 1,
        y: 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out"
    });

    gsap.set(rowPickupPageTOSTitle, { opacity: 0, x: -100, y: 40 });
    gsap.to(rowPickupPageTOSTitle, {
        opacity: 1,
        x: 0,
        y : 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out"
    });
}
