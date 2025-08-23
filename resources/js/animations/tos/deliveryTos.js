import gsap from "gsap";

export function deliveryTOSPageAnimate() {
    const deliveryPageTOSTitle = document.querySelectorAll('#deliveryTOSTitle')
    const rowDeliveryPageTOSTitle = document.querySelectorAll(".row-animate")

    gsap.set(deliveryPageTOSTitle, { opacity: 0, y: -60 });
    gsap.to(deliveryPageTOSTitle, {
        opacity: 1,
        y: 0,
        duration: 1.2,
        ease: "elastic.out"
    });

    gsap.set(rowDeliveryPageTOSTitle, { opacity: 0, x: 100, y : 40 });
    gsap.to(rowDeliveryPageTOSTitle, {
        opacity: 1,
        x: 0,
        y : 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out"
    });
}
