

/*
    Give the service worker access to Firebase Messaging.
    Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
    */
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({

    apiKey: "AIzaSyAIDvBgf8mz_diq1FcwfEBqDzGeo4U5zuw",
    authDomain: "kas-keluarga.firebaseapp.com",
    projectId: "kas-keluarga",
    storageBucket: "kas-keluarga.appspot.com",
    messagingSenderId: "28720048140",
    appId: "1:128720048140:web:6051f0b8b083e158dcde29"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});