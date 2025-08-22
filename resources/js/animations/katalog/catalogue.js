import gsap from "gsap";

export function animateCatalogItems() {
    const items = document.querySelectorAll('#catalogueItems > div')

    gsap.from(items, {
        opacity: 0,
        y: 20,
        stagger: 0.15,
        duration: 0.5,
        ease: "power2.out"
    });
}
