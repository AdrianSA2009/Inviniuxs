import './bootstrap';
import '../css/app.css';
import 'flowbite';
import './ajax-list-search.js';

// Initialize Laravel Echo for real-time notifications (only when WebSocket server is available)
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

const enableRealtime = import.meta.env.VITE_ENABLE_REALTIME_NOTIFICATION === 'true';

if (enableRealtime) {
    window.Pusher = Pusher;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
        wsHost: import.meta.env.VITE_PUSHER_HOST,
        wsPort: import.meta.env.VITE_PUSHER_PORT ?? 6001,
        wssPort: import.meta.env.VITE_PUSHER_PORT ?? 6001,
        forceTLS: false,
        encrypted: false,
        disableStats: true,
    });

    // Listen for low stock notifications in real-time
    window.Echo.channel('low-stock')
        .listen('.low-stock-alert', (data) => {
            console.log('Low stock alert received:', data);
            
            // Call the notification function if it exists
            if (typeof window.addNotification === 'function') {
                window.addNotification(data);
            }
        });
}