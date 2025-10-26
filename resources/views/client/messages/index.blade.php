@extends('layouts.client')

@section('title', 'Messages')

@section('styles')
<style>
    .chat-app {
        height: calc(100vh - 250px);
        min-height: 600px;
        border-radius: 0.35rem;
        overflow: hidden;
        background-color: #fff;
    }

    .people-list {
        height: 100%;
        overflow-y: auto;
        border-right: 1px solid #e3e6f0;
        background-color: #f8f9fc;
    }

    .people-list .search-box {
        padding: 15px;
        border-bottom: 1px solid #e3e6f0;
    }

    .people-list .person {
        position: relative;
        padding: 15px;
        border-bottom: 1px solid #e3e6f0;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .people-list .person:hover {
        background-color: rgba(78, 115, 223, 0.1);
    }

    .people-list .person.active {
        background-color: rgba(78, 115, 223, 0.2);
    }

    .people-list .person .user-info {
        display: flex;
        align-items: center;
    }

    .people-list .person .avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: #4e73df;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 1.2rem;
        margin-right: 15px;
    }

    .people-list .person .name-time {
        flex: 1;
    }

    .people-list .person .name {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .people-list .person .preview {
        font-size: 0.8rem;
        color: #6c757d;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .people-list .person .badge-counter {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .chat-area {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .chat-header {
        padding: 15px 20px;
        border-bottom: 1px solid #e3e6f0;
        background-color: #fff;
    }

    .chat-header .user-info {
        display: flex;
        align-items: center;
    }

    .chat-header .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #4e73df;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 1.1rem;
        margin-right: 15px;
    }

    .chat-header .name {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .chat-header .subject {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        background-color: #f8f9fc;
    }

    .message-group {
        margin-bottom: 20px;
    }

    .message {
        max-width: 75%;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        position: relative;
        word-wrap: break-word;
    }

    .message.outgoing {
        background-color: #4e73df;
        color: white;
        margin-left: auto;
        border-bottom-right-radius: 0;
    }

    .message.incoming {
        background-color: white;
        color: #5a5c69;
        margin-right: auto;
        border-bottom-left-radius: 0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .message .time {
        font-size: 0.7rem;
        text-align: right;
        margin-top: 5px;
    }

    .message.outgoing .time {
        color: rgba(255,255,255,0.8);
    }

    .message.incoming .time {
        color: #858796;
    }

    .message-input {
        padding: 15px;
        border-top: 1px solid #e3e6f0;
        background-color: #fff;
    }

    .message-input .input-group {
        background-color: #f8f9fc;
        border-radius: 30px;
        padding: 5px;
    }

    .message-input input {
        border: none;
        background-color: transparent;
        padding-left: 15px;
    }

    .message-input input:focus {
        box-shadow: none;
    }

    .message-input .btn {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-chat {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #858796;
        background-color: #f8f9fc;
    }

    .empty-chat i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #dddfeb;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        color: #858796;
    }

    .section-title {
        padding: 10px 15px;
        background-color: #e3e6f0;
        color: #5a5c69;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Messages</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body p-0">
            <div class="row g-0 chat-app">
                <!-- People List -->
                <div class="col-md-4 col-lg-3 people-list">
                    <div class="search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" id="search-contact" placeholder="Search teachers...">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="section-title">TEACHERS</div>

                    <div id="contacts-container">
                        @if($teachers->isEmpty() && $conversationUsers->isEmpty())
                            <div class="empty-state p-4">
                                <i class="fas fa-user-slash fa-3x mb-3 text-gray-300"></i>
                                <p>No contacts available</p>
                            </div>
                        @else
                            @foreach($teachers as $teacher)
                                <div class="person contact-item" data-id="{{ $teacher->faculty_id }}" data-subject="{{ $teacher->subject_code }} - {{ $teacher->subject_name }}">
                                    <div class="user-info">
                                        <div class="avatar">
                                            {{ strtoupper(substr($teacher->faculty_name, 0, 1)) }}
                                        </div>
                                        <div class="name-time">
                                            <div class="name">{{ $teacher->faculty_name }}</div>
                                            <div class="preview">{{ $teacher->subject_code }} - {{ $teacher->subject_name }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach($conversationUsers as $user)
                                @if(!$teachers->contains('faculty_id', $user->id))
                                    <div class="person contact-item" data-id="{{ $user->id }}" data-subject="{{ $user->user_role == 'faculty' ? 'Teacher' : 'Admin' }}">
                                        <div class="user-info">
                                            <div class="avatar">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div class="name-time">
                                                <div class="name">{{ $user->name }}</div>
                                                <div class="preview">{{ $user->user_role == 'faculty' ? 'Teacher' : 'Admin' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="col-md-8 col-lg-9 chat-area">
                    <!-- Empty state when no chat is selected -->
                    <div id="empty-chat-container" class="empty-chat">
                        <i class="fas fa-comments fa-3x mb-3"></i>
                        <h5>Your Messages</h5>
                        <p class="text-muted">Select a contact to start chatting</p>
                    </div>

                    <!-- Chat content when a conversation is selected -->
                    <div id="chat-container" class="d-none" style="height: 100%; display: flex; flex-direction: column;">
                        <div class="chat-header">
                            <div class="user-info">
                                <div class="avatar" id="chat-recipient-avatar">J</div>
                                <div>
                                    <div class="name" id="chat-recipient-name">John Doe</div>
                                    <div class="subject" id="chat-recipient-subject">Subject</div>
                                </div>
                            </div>
                        </div>

                        <div class="chat-messages" id="messages-container">
                            <!-- Messages will be loaded here -->
                        </div>

                        <div class="message-input">
                            <form id="message-form">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="message-text" placeholder="Type your message...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    let currentRecipientId = null;
    const userId = {{ Auth::id() }};

    // Check if faculty parameter is in URL
    const urlParams = new URLSearchParams(window.location.search);
    const facultyParam = urlParams.get('faculty');
    if (facultyParam) {
        $(`.contact-item[data-id="${facultyParam}"]`).click();
    }

    // Handle contact click
    $('.contact-item').on('click', function() {
        $('.contact-item').removeClass('active');
        $(this).addClass('active');

        currentRecipientId = $(this).data('id');
        const currentRecipientName = $(this).find('.name').text();
        const currentRecipientSubject = $(this).data('subject');

        $('#chat-recipient-name').text(currentRecipientName);
        $('#chat-recipient-subject').text(currentRecipientSubject);
        $('#chat-recipient-avatar').text(currentRecipientName.charAt(0).toUpperCase());

        $('#empty-chat-container').addClass('d-none');
        $('#chat-container').removeClass('d-none');

        loadConversation(currentRecipientId);
        $('#message-text').focus();
    });

    // Search contacts
    $('#search-contact').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();
        $('.contact-item').each(function() {
            const name = $(this).find('.name').text().toLowerCase();
            const preview = $(this).find('.preview').text().toLowerCase();
            $(this).toggle(name.includes(searchTerm) || preview.includes(searchTerm));
        });
    });

    // Load conversation
    function loadConversation(recipientId) {
        $.ajax({
            url: `{{ route('client.messages.conversation', ['userId' => '__id__']) }}`.replace('__id__', recipientId),
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                displayMessages(data.messages);
            },
            error: function(xhr) {
                console.error('Error loading conversation:', xhr);
                $('#messages-container').html(`
                    <div class="empty-state">
                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-danger"></i>
                        <p>Error loading messages. Please try again.</p>
                    </div>
                `);
            }
        });
    }

    // Display messages
    function displayMessages(messages) {
        const container = $('#messages-container');
        container.empty();

        if (messages.length === 0) {
            container.html(`
                <div class="empty-state">
                    <i class="far fa-comment-dots fa-3x mb-3 text-gray-300"></i>
                    <p>No messages yet. Start the conversation!</p>
                </div>
            `);
            return;
        }

        let currentDate = null;
        messages.forEach(function(message) {
            const messageDate = new Date(message.created_at);
            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);

            let dateLabel;
            if (messageDate.toDateString() === today.toDateString()) dateLabel = 'Today';
            else if (messageDate.toDateString() === yesterday.toDateString()) dateLabel = 'Yesterday';
            else dateLabel = messageDate.toLocaleDateString(undefined, { month: 'short', day: 'numeric' });

            if (currentDate !== dateLabel) {
                container.append(`<div class="text-center my-3"><span class="badge badge-light px-3 py-2">${dateLabel}</span></div>`);
                currentDate = dateLabel;
            }

            const isOutgoing = message.sender_id == userId;
            const messageClass = isOutgoing ? 'outgoing' : 'incoming';
            const messageTime = messageDate.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

            container.append(`
                <div class="message ${messageClass}">
                    <div class="content">${message.message}</div>
                    <div class="time">${messageTime}</div>
                </div>
            `);
        });

        container.scrollTop(container.prop('scrollHeight'));
    }

    // Send message
    $('#message-form').on('submit', function(e) {
        e.preventDefault();
        if (!currentRecipientId) {
            alert('Please select a recipient first.');
            return;
        }

        const messageText = $('#message-text').val().trim();
        if (!messageText) return;

        $.ajax({
            url: '{{ route('client.messages.send') }}',
            type: 'POST',
            data: {
                recipient_id: currentRecipientId,
                message: messageText,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            beforeSend: function() {
                $('#message-text').prop('disabled', true);
            },
            success: function(data) {
                if (data.success) {
                    $('#message-text').val('');
                    loadConversation(currentRecipientId);
                } else {
                    alert(data.error || 'Error sending message. Please try again.');
                }
            },
            error: function(xhr) {
                console.error('Error sending message:', xhr);
                alert(xhr.responseJSON?.error || 'Error sending message. Please try again.');
            },
            complete: function() {
                $('#message-text').prop('disabled', false).focus();
            }
        });
    });

    // Auto-refresh
    setInterval(function() {
        if (currentRecipientId) {
            loadConversation(currentRecipientId);
        }
    }, 10000);
});
</script>
@endsection

