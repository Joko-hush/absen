/**
 * Preloader
 */
let preloader = select("#preloader");
if (preloader) {
	window.addEventListener("load", () => {
		preloader.remove();
	});
}
// Import the functions you need from the SDKs you need

import { initializeApp } from "firebase/app";

import { getAnalytics } from "firebase/analytics";

// TODO: Add SDKs for Firebase products that you want to use

// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration

// For Firebase JS SDK v7.20.0 and later, measurementId is optional

const firebaseConfig = {
	apiKey: "AIzaSyDAWhOdPWGHqC7iZ20OTM1eYdxxizGMHKs",

	authDomain: "doelsipetir-f5e25.firebaseapp.com",

	projectId: "doelsipetir-f5e25",

	storageBucket: "doelsipetir-f5e25.appspot.com",

	messagingSenderId: "433556666703",

	appId: "1:433556666703:web:b40ad42c23c3a7e72c6d3a",

	measurementId: "G-VLHMQZ189H",
};

// Initialize Firebase

const app = initializeApp(firebaseConfig);

const analytics = getAnalytics(app);
