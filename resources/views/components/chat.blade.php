<style>
    #chatToggleBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        padding: 12px 18px;
        background: #5B5400;
        color: #fff;
        border: none;
        border-radius: 50%;
        font-size: 22px;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        transition: transform 0.2s ease-in-out;
    }

    #chatToggleBtn:hover {
        transform: scale(1.1);
    }

    #chatPopup {
        position: fixed;
        bottom: 80px;
        right: 20px;
        width: 600px;
        height: 450px;
        background: #1e1e1e;
        color: #fff;
        border-radius: 12px;
        display: none;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        z-index: 999;
        overflow: hidden;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .chat-container {
        display: flex;
        height: 100%;
    }

    .chat-list {
        width: 40%;
        background-color: #2c2c2c;
        border-right: 1px solid #444;
        overflow-y: auto;
        padding: 10px;
    }

    .chat-item {
        padding: 12px;
        margin-bottom: 8px;
        background: #333;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s;
        color: #fff;
    }

    .chat-item:hover {
        background: #444;
    }

    .chat-box {
        width: 60%;
        display: flex;
        flex-direction: column;
        padding: 12px;
        background-color: #1e1e1e;
    }

    .chat-messages {
        flex-grow: 1;
        overflow-y: auto;
        padding-right: 8px;
        margin-bottom: 12px;
        border: 1px solid #333;
        border-radius: 8px;
        background: #2b2b2b;
        padding: 10px;
    }

    .chat-messages div {
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .chat-messages b {
        color: #cfcfcf;
    }

    #messageForm {
        display: flex;
        border-top: 1px solid #444;
        padding-top: 10px;
    }

    #messageInput {
        flex-grow: 1;
        padding: 8px 12px;
        border-radius: 6px;
        border: none;
        background: #3b3b3b;
        color: #fff;
        font-size: 14px;
    }

    #messageInput:focus {
        outline: none;
        background: #4a4a4a;
    }

    #messageForm button {
        margin-left: 10px;
        padding: 8px 16px;
        background: #5B5400;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.2s ease-in-out;
    }

    #messageForm button:hover {
        background: #776f00;
    }

    #noChatsMsg {
        color: #aaa;
        padding: 10px;
    }
    .chat-bubble {
        display: flex;
        margin: 8px 0;
        width: 100%;
    }

    .chat-bubble .bubble-content {
        max-width: 80%;
        padding: 10px 14px;
        border-radius: 16px;
        font-size: 14px;
        line-height: 1.4;
        word-wrap: break-word;
    }

    .chat-bubble.me {
        justify-content: flex-start;
    }

    .chat-bubble.me .bubble-content {
        background-color: #3c3c3c;
        color: #fff;
        border-top-left-radius: 0;
    }

    .chat-bubble.them {
        justify-content: flex-end;
    }

    .chat-bubble.them .bubble-content {
        background-color: #5B5400;
        color: #fff;
        border-top-right-radius: 0;
    }
    @keyframes fadeInScale {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes fadeOutScale {
        0% {
            opacity: 1;
            transform: scale(1);
        }
        100% {
            opacity: 0;
            transform: scale(0.8);
        }
    }

    #chatPopup.show {
        display: block;
        animation: fadeInScale 0.3s ease-out forwards;
    }

    #chatPopup.hide {
        animation: fadeOutScale 0.2s ease-in forwards;
    }

</style>

<script>

    $(document).ready(function () {
        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            encrypted: true,
            authEndpoint: '/broadcasting/auth',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        });

        function toggleChatPopup() {
            const popup = document.getElementById('chatPopup');

            if (popup.classList.contains('show')) {
                popup.classList.remove('show');
                popup.classList.add('hide');
                // Ждем окончания анимации, потом удаляем блок только классом, не стилем
                popup.addEventListener('animationend', function handler() {
                    popup.classList.remove('hide');
                    popup.style.display = 'none'; // временно скрываем
                    popup.removeEventListener('animationend', handler);
                });
            } else {
                popup.style.display = 'block'; // сначала показываем
                requestAnimationFrame(() => {
                    popup.classList.remove('hide');
                    popup.classList.add('show'); // запускаем анимацию появления
                });
            }
        }



        window.toggleChatPopup = toggleChatPopup;

        let currentChatId = null;
        let currentChannel = null;

        window.openChat = function (chatId) {
            currentChatId = chatId;
            $('#chatId').val(chatId);

            if (currentChannel) {
                currentChannel.unbind('MessageSent');
            }

            fetch(`/chat/${chatId}/messages`)
                .then(res => res.json())
                .then(messages => {
                    $('#chatMessages').html('');
                    messages.forEach(m => {
                        const isMe = m.sender.id === {{ auth()->id() }};
                        $('#chatMessages').append(`
        <div class="chat-bubble ${isMe ? 'me' : 'them'}">
            <div class="bubble-content">
                <b>${isMe ? 'Вы' : m.sender.FIO}:</b> ${m.message}
            </div>
        </div>
    `);
                    });


                    scrollToBottom();
                });

            currentChannel = pusher.subscribe('private-chat.' + chatId);
            currentChannel.bind('MessageSent', function (data) {
                if (data.message.sender.id !== {{ auth()->id() }}) {
                    $('#chatMessages').append(`
    <div class="chat-bubble them">
        <div class="bubble-content">
            <b>${data.message.sender.name}:</b> ${data.message.message}
        </div>
    </div>
`);

                    scrollToBottom();
                }
            });
        };

        $('#messageForm').on('submit', function (e) {
            e.preventDefault();

            const messageText = $('#messageInput').val().trim();
            if (messageText === '') return;

            $.post('/chat/send', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                chat_id: currentChatId,
                message: messageText
            }, function (res) {
                $('#chatMessages').append(`
    <div class="chat-bubble me">
        <div class="bubble-content">
            <b>Вы:</b> ${res.message}
        </div>
    </div>
`);

                $('#messageInput').val('');
                scrollToBottom();
            });
        });

        window.startChat = function (userId) {
            $.post('/chat/start', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                user_id: userId
            }, function (response) {
                if (response.success) {
                    console.log(response)
                    if ($(`.chat-item[data-chat-id="${response.chat_id}"]`).length === 0) {
                        $('#noChatsMsg').remove();

                        $('#chatList').prepend(`
                        <div class="chat-item" onclick="openChat(${response.chat_id})" data-chat-id="${response.chat_id}">
                            Чат с пользователем ${response.companion_name}
                        </div>
                    `);
                    }

                    toggleChatPopup();
                    openChat(response.chat_id);
                } else {
                    alert('Не удалось начать чат');
                }
            });
        };

        function scrollToBottom() {
            const container = document.getElementById('chatMessages');
            container.scrollTop = container.scrollHeight;
        }

        pusher.connection.bind('error', function (err) {
            console.error('Pusher connection error:', err);
        });

        pusher.connection.bind('state_change', function (states) {
            console.log('Pusher connection state changed:', states);
        });

    });
</script>


<button id="chatToggleBtn" onclick="toggleChatPopup()">💬</button>

<div id="chatPopup">
    <div class="chat-container">
        <div class="chat-list" id="chatList">
            @if($chats === null || $chats->isEmpty())
                <p id="noChatsMsg">Пока чатов нет</p>
            @else
                @foreach($chats as $chat)
                    @php
                        $companion = $chat->user_one_id === auth()->id()
                            ? $chat->userTwo
                            : $chat->userOne;
                    @endphp
                    <div class="chat-item" onclick="openChat({{ $chat->id }})" data-chat-id="{{ $chat->id }}">
                        Чат с пользователем {{ $companion->FIO }}
                    </div>
                @endforeach
            @endif
        </div>


        <div class="chat-box">
            <div id="chatMessages" class="chat-messages"></div>
            <form id="messageForm">
                <input type="hidden" id="chatId">
                <input type="text" id="messageInput" placeholder="Введите сообщение...">
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
</div>
