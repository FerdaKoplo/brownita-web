import gsap from "gsap";

export function rowAnimate() {

    // transaction table customer
    const rows = document.querySelectorAll("#transactionBody .transaction-row");

    // animate table transaction customer
    gsap.set(rows, { opacity: 0, y: 30 });
    gsap.to(rows, {
        opacity: 1,
        y: 0,
        stagger: 0.075,
        duration: 0.05,
        ease: "elastic.out"
    });
}
