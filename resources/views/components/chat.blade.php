<style>
    #chatToggleBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        padding: 10px 15px;
        background: #5B5400;
        color: #fff;
        border: none;
        border-radius: 30px;
        font-size: 20px;
        cursor: pointer;
    }

    #chatPopup {
        position: fixed;
        bottom: 70px;
        right: 20px;
        width: 600px;
        height: 400px;
        background: #000000;
        border: 1px solid #ddd;
        border-radius: 10px;
        display: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        z-index: 999;
        overflow: hidden;
    }

    .chat-container {
        display: flex;
        height: 100%;
    }

    .chat-list {
        width: 40%;
        border-right: 1px solid #ccc;
        overflow-y: auto;
    }

    .chat-item {
        padding: 10px;
        cursor: pointer;
        border-bottom: 1px solid #eee;
    }

    .chat-item:hover {
        background: #000000;
    }

    .chat-box {
        width: 60%;
        display: flex;
        flex-direction: column;
        padding: 10px;
    }

    .chat-messages {
        flex-grow: 1;
        overflow-y: auto;
        border-bottom: 1px solid #000000;
        margin-bottom: 10px;
    }

    #messageForm {
        display: flex;
    }

    #messageInput {
        flex-grow: 1;
        padding: 5px;
    }

    #messageForm button {
        padding: 5px 10px;
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
            popup.style.display = (popup.style.display === 'block') ? 'none' : 'block';
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
                        const senderName = m.sender.id === {{ auth()->id() }} ? 'Вы' : m.sender.FIO;
                        $('#chatMessages').append(`<div><b>${senderName}:</b> ${m.message}</div>`);
                    });

                    scrollToBottom();
                });

            currentChannel = pusher.subscribe('private-chat.' + chatId);
            currentChannel.bind('MessageSent', function (data) {
                if (data.message.sender.id !== {{ auth()->id() }}) {
                    $('#chatMessages').append(`
            <div>
                <b>${data.message.sender.name}:</b>
                ${data.message.message} <!-- Используем data.message.message -->
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
                $('#chatMessages').append(`<div><b>Вы:</b> ${res.message}</div>`);
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
