jQuery(document).ready(function($) {
    // 要素の取得
    const $container = $('#chatbot-container');
    const $toggle = $('#chatbot-toggle');
    const $chatWindow = $('#chatbot-window');
    const $closeButton = $('.chatbot-close');
    const $messageInput = $('#chatbot-message');
    const $sendButton = $('#chatbot-send');
    const $messagesContainer = $('#chatbot-messages');

    // デバッグ情報
    console.log('Chatbot elements:', {
        container: $container.length,
        toggle: $toggle.length,
        chatWindow: $chatWindow.length,
        closeButton: $closeButton.length,
        messageInput: $messageInput.length,
        sendButton: $sendButton.length,
        messagesContainer: $messagesContainer.length
    });

    // 初期メッセージを表示
    if ($messagesContainer.length) {
        appendMessage('bot', 'こんにちは！テンファイブのAIアシスタントです。ご質問やご相談がございましたら、お気軽にお申し付けください。😊');
    }

    // トグルボタンのクリックイベント
    $(document).on('click', '#chatbot-toggle', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Toggle button clicked');
        
        if ($chatWindow.is(':visible')) {
            $chatWindow.fadeOut(200);
        } else {
            $chatWindow.fadeIn(200);
        }
    });

    // 閉じるボタンのクリックイベント
    $(document).on('click', '.chatbot-close', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Close button clicked');
        $chatWindow.fadeOut(200);
    });

    // メッセージ送信関数
    function sendMessage() {
        const message = $messageInput.val().trim();
        if (!message) return;

        // メッセージをチャット画面に追加
        appendMessage('user', message);
        $messageInput.val('');

        // サーバーにメッセージを送信
        $.ajax({
            url: chatbotAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'chatbot_message',
                nonce: chatbotAjax.nonce,
                message: message
            },
            success: function(response) {
                if (response.success) {
                    appendMessage('bot', response.data.message, response.data.links);
                } else {
                    appendMessage('bot', 'すみません、エラーが発生しました。もう一度お試しください。');
                }
            },
            error: function() {
                appendMessage('bot', 'すみません、エラーが発生しました。もう一度お試しください。');
            }
        });
    }

    // メッセージ表示関数
    function appendMessage(type, content, links = null) {
        const $messageDiv = $('<div>').addClass(`chatbot-message ${type}-message`);
        
        // メッセージ本文（URLを自動リンク化）
        let linkedContent = content
            // Markdownスタイルのリンクを処理
            .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank">$1</a>')
            // 通常のURLを処理
            .replace(/(?<![\(\["])(https?:\/\/[^\s\)]+)/g, '<a href="$1" target="_blank">$1</a>')
            // 壊れたリンクを修正
            .replace(/@(https?:\/\/[^\s\)]+)/g, '<a href="$1" target="_blank">$1</a>')
            // 重複したリンクタグを修正
            .replace(/<a href="<a href="([^"]+)"[^>]*>([^<]+)<\/a>"[^>]*>([^<]+)<\/a>/g, '<a href="$1" target="_blank">$2</a>');

        const $messageContent = $('<div>').addClass('message-content').html(linkedContent);
        $messageDiv.append($messageContent);

        // リンクがある場合は追加
        if (links && Array.isArray(links)) {
            const $linksContainer = $('<div>').addClass('message-links');
            links.forEach(link => {
                const $link = $('<a>')
                    .attr('href', link.url)
                    .attr('target', '_blank')
                    .text(link.text)
                    .addClass('chatbot-link');
                $linksContainer.append($link);
            });
            $messageDiv.append($linksContainer);
        }

        $messagesContainer.append($messageDiv);
        $messagesContainer.scrollTop($messagesContainer[0].scrollHeight);
    }

    // 送信ボタンのクリックイベント
    $(document).on('click', '#chatbot-send', sendMessage);

    // Enterキーでの送信
    $messageInput.on('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
}); 