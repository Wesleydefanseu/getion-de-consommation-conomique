<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
 
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  
</head>
<body>
    <div id="messages">
        @foreach ($messages as $message)
            <div class="message @if ($message->id_emeteur == Auth::id()) sent @else received @endif">
                <img src="{{ $message->emeteur->photo }}" alt="{{ $message->emeteur->name }}">
                <div>
                    <strong>{{ $message->emeteur->name }}</strong>
                    <p>{{ $message->message }}</p>
                    <small>{{ $message->created_at->format('d/m/Y H:i') }}</small>
                </div>
            </div>
        @endforeach
    </div>

    <form id="messageForm">
        <textarea name="message" id="message" placeholder="Type your message here..."></textarea>
        <input type="hidden" name="id_recepteur" value="{{ $id }}">
        <button type="submit">Send</button>
    </form>

    <script>
        // Initialize Pusher
        Pusher.logToConsole = true;
      
        var pusher = new Pusher("91ef8f9d0bb2f2049b2a", {
            cluster: "mt1",
            encrypted: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            fetchMessages();
            console.log('bonjour');
        });

        function fetchMessages() {
            axios.get('/messages/3')
                .then(response => {
                    let messagesDiv = document.getElementById('messages');
                    messagesDiv.innerHTML = '';
                    response.data.messages.forEach(message => {
                        let messageDiv = document.createElement('div');
                        messageDiv.classList.add('message');
                        if (message.id_emeteur ==2) {
                            messageDiv.classList.add('sent');
                        } else {
                            messageDiv.classList.add('received');
                        }
                        messageDiv.innerHTML = `
                            <img src="${message.emeteur.photo}" alt="${message.emeteur.name}">
                            <div>
                                <strong>${message.emeteur.name}</strong>
                                <p>${message.message}</p>
                                <small>${new Date(message.created_at).toLocaleString()}</small>
                            </div>
                        `;
                        messagesDiv.appendChild(messageDiv);
                    });
                });
        }

        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            axios.post('/messages', formData)
                .then(response => {
                    document.getElementById('message').value = '';
                });
        });
    </script>

    <style>
        .message {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .message.sent {
            justify-content: flex-end;
            text-align: right;
        }
        .message img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .message.sent img {
            margin-left: 10px;
            margin-right: 0;
        }
        .message div {
            max-width: 60%;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 10px;
        }
        .message.sent div {
            background-color: #dcf8c6;
        }
    </style>
</body>
</html>
