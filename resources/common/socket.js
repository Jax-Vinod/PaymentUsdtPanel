/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
// window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    // forceTLS: false,
    forceTLS: true,
    // wsHost: '127.0.0.1',
    wsHost: window.location.host,
    wsPort: 6001,
    wssPort: 443,
    encrypted: true,
    // encrypted: false,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
    // authEndpoint :'http://127.0.0.1:8000/api/broadcasting/auth',
    auth:{
        headers: {
            Authorization: 'Bearer '+localStorage.getItem('token'),
            Accept: "application/json"
        }
    },
});
