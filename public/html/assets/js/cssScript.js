// "use strict";


// function hexToRgb(hex, result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex)) {
//     return result ? result.map(i => parseInt(i, 16)).slice(1) : null
// }
// // hexToRgb("#0A3678").join();

// var getRoot = document.querySelector(':root');
// // Create a function for getting a variable value
// function myFunction_get() {
//     // Get the styles (properties and values) for the root
//     var getRootStyle = getComputedStyle(getRoot);
//     // Alert the value of the --blue variable
//     let rgbOne = hexToRgb((getRootStyle.getPropertyValue('--main-color-one')).trim())?.toString();
//     let rgbTwo = hexToRgb((getRootStyle.getPropertyValue('--main-color-two')).trim())?.toString();
//     let rgbThree = hexToRgb((getRootStyle.getPropertyValue('--main-color-three')).trim())?.toString();
//     let rgbPrimary = hexToRgb((getRootStyle.getPropertyValue('--primary')).trim())?.toString();
//     let rgbSecondary = hexToRgb((getRootStyle.getPropertyValue('--secondary')).trim())?.toString();
//     let rgbSuccess = hexToRgb((getRootStyle.getPropertyValue('--success')).trim())?.toString();
//     let rgbDanger = hexToRgb((getRootStyle.getPropertyValue('--danger')).trim())?.toString();
//     let rgbInfo = hexToRgb((getRootStyle.getPropertyValue('--info')).trim())?.toString();
//     let rgbDark = hexToRgb((getRootStyle.getPropertyValue('--dark')).trim())?.toString();
//     let rgbLight = hexToRgb((getRootStyle.getPropertyValue('--light')).trim())?.toString();
//     let rgbBlue = hexToRgb((getRootStyle.getPropertyValue('--blue')).trim())?.toString();
//     let rgbPurple = hexToRgb((getRootStyle.getPropertyValue('--purple')).trim())?.toString();
//     let rgbOrange = hexToRgb((getRootStyle.getPropertyValue('--orange')).trim())?.toString();
//     let rgbBrown = hexToRgb((getRootStyle.getPropertyValue('--brown')).trim())?.toString();
//     let rgbGreen = hexToRgb((getRootStyle.getPropertyValue('--green')).trim())?.toString();
//     let rgbSky = hexToRgb((getRootStyle.getPropertyValue('--sky')).trim())?.toString();
//     let rgbPink = hexToRgb((getRootStyle.getPropertyValue('--pink')).trim())?.toString();
//     let rgbWarning = hexToRgb((getRootStyle.getPropertyValue('--warning')).trim())?.toString();

//     getRoot.style.setProperty('--main-color-one-rgb', rgbOne);
//     getRoot.style.setProperty('--main-color-two-rgb', rgbTwo);
//     getRoot.style.setProperty('--main-color-three-rgb', rgbThree);
//     getRoot.style.setProperty('--primary-rgb', rgbPrimary);
//     getRoot.style.setProperty('--secondary-rgb', rgbSecondary);
//     getRoot.style.setProperty('--success-rgb', rgbSuccess);
//     getRoot.style.setProperty('--danger-rgb', rgbDanger);
//     getRoot.style.setProperty('--info-rgb', rgbInfo);
//     getRoot.style.setProperty('--dark-rgb', rgbDark);
//     getRoot.style.setProperty('--light-rgb', rgbLight);
//     getRoot.style.setProperty('--blue-rgb', rgbBlue);
//     getRoot.style.setProperty('--purple-rgb', rgbPurple);
//     getRoot.style.setProperty('--orange-rgb', rgbOrange);
//     getRoot.style.setProperty('--brown-rgb', rgbBrown);
//     getRoot.style.setProperty('--green-rgb', rgbGreen);
//     getRoot.style.setProperty('--sky-rgb', rgbSky);
//     getRoot.style.setProperty('--pink-rgb', rgbPink);
//     getRoot.style.setProperty('--warning-rgb', rgbWarning);
// }

// myFunction_get()


