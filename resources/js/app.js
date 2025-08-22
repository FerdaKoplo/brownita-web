import './bootstrap';
import gsap from "gsap";
import { ScrollTrigger } from 'gsap/all';
import { heroAnimation } from './animations/landing/hero';
import { aboutAnimation } from './animations/landing/about';
import { profileAnimation } from './animations/landing/profile';
import { locationAnimation } from './animations/landing/location';
import { rowAnimate } from './animations/history_transaction/row';
import { frontTOSPageAnimate } from './animations/tos/frontTos';
import { orderTOSAnimate } from './animations/tos/orderTos';
import { paymentTOSAnimate } from './animations/tos/paymentTos';
import { deliveryTOSPageAnimate } from './animations/tos/deliveryTos';
import { pickupTOSAnimate } from './animations/tos/pickupTos';
import { animateCatalogItems } from './animations/katalog/catalogue';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", () => {

    // landing page
    heroAnimation()
    aboutAnimation()
    profileAnimation()
    locationAnimation()

    // term of service
    frontTOSPageAnimate()

    // customer transaction
    rowAnimate()
    orderTOSAnimate()
    paymentTOSAnimate()
    deliveryTOSPageAnimate()
    pickupTOSAnimate()

    // katalog
    animateCatalogItems()

});

