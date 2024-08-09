
import axios from 'axios';
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Écoutez les événements diffusés
window.Echo.channel('chat')
    .listen('MessageSent', (e) => {
        console.log(e.message);
        // Mettre à jour l'interface utilisateur avec le nouveau message
        addMessageToChat(e.message);
    });

// Fonction pour ajouter un message à la div de chat
function addMessageToChat(message) {
    let chatDiv = document.getElementById('messages');
    let messageElement = document.createElement('div');
    messageElement.innerText = message.message;
    chatDiv.appendChild(messageElement);
}

