const NOTIFICATION_TITLE = 'Marosvölgyi Gergely weboldala';
const NOTIFICATION_BODY = 'Új vers/novella: Ez a címe';
//const NOTIFICATION_ICON_SRC = 'https://www.marosvolgyigergely.hu/images/favicon.png';
const NOTIFICATION_ICON_SRC = '../images/favicon.png';
const NOTIFICATION_HIDE_MS = 10000;

var notificationsEnabled = false;

function initNotifications() {
    if (window.Notification) {
        Notification.requestPermission(function(permission) {
            if (permission === 'granted') {
                notificationsEnabled = true;
                showNotification();
            } else {
                console.log('Notifications are disabled by the user.');
            }
        });
    } else {
        console.error('Your browser does not support Notifications API.');
    }
}

function showNotification() {
    if (notificationsEnabled) {
        var options = {
            body: NOTIFICATION_BODY,
            badge: NOTIFICATION_ICON_SRC,
            icon: NOTIFICATION_ICON_SRC
        };

        var notification = new Notification(NOTIFICATION_TITLE, options);

        setTimeout(function() {
            notification.close();
        }, NOTIFICATION_HIDE_MS);
    }
}