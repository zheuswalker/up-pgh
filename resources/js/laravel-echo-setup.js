import Echo from 'laravel-echo';

   
window.io = require('socket.io-client');
window.Echo = new Echo({

    broadcaster: 'socket.io',

    host: "127.0.0.1:6001"

});	