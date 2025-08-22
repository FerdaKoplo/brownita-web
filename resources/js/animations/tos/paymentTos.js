import gsap from "gsap";

export function paymentTOSAnimate(){
    const paymentPageTOSTitle = document.querySelectorAll('#paymentTitleTOS')
    const rowPaymentPageTOSTitle = document.querySelector("#row-animate-payment")

    gsap.set(paymentPageTOSTitle, { opacity: 0, y: -60 });
    gsap.to(paymentPageTOSTitle, {
        opacity: 1,
        y: 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out"
    });

    gsap.set(rowPaymentPageTOSTitle, { opacity: 0, x: -100, y : 40});
    gsap.to(rowPaymentPageTOSTitle, {
        opacity: 1,
        x: 0,
        y : 0,
        stagger: 0.3,
        duration: 1.2,
        ease: "elastic.out"
    });
}
