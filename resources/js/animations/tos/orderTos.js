import gsap from "gsap";

export function orderTOSAnimate(){
    const orderPageTOSTitle = document.querySelectorAll('#orderTOSTitle')
    const rowOrderPageTOSTitle = document.querySelectorAll(".row-animate")

    gsap.set(orderPageTOSTitle, { opacity: 0, y: -60 });
    gsap.to(orderPageTOSTitle, {
        opacity: 1,
        y: 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out"
    });

    gsap.set(rowOrderPageTOSTitle, { opacity: 0, x: 100, y : 40 });
    gsap.to(rowOrderPageTOSTitle, {
        opacity: 1,
        x: 0,
        y : 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out"
    });
}
