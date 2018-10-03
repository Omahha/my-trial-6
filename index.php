<!doctype html>
<html>

<head>
    <title>BotMan Widget</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>My chat bot</h1>
    
    <input type="text" id="input">
    <button type=button onclick="sendText()">send</button>
    <div id="display"></div>
    <div id="result"></div>
    
    <script>
        var botmanWidget = {
            frameEndpoint: 'chat.html',
            chatServer : 'chat.php', 
            title: 'My Chatbot', 
            mainColor: '#456765',
            bubbleBackground: '#ff76f4',
            aboutText: '',
            bubbleAvatarUrl: './images/bubbleImage.jpg',
            placeholderText: 'message...',
            desktopHeight: '1000',
            desktopWidth: '1000'
        }; 
        
        function sendText(){
            let text = document.querySelector("#input").value;
            //console.log(text);
            let result = document.querySelector("#result");
            //botmanChatWidget.open();
            botmanChatWidget.say(text);
            result.innerHTML = text;
        }
        
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

</body>
</html>