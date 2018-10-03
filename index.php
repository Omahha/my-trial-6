<!doctype html>
<html>

<head>
    <title>BotMan Widget</title>
    <meta charset="UTF-8">
    
    <style>
        body{
                
        }
        
        #header{
            height: 80px;
            background-color: orange;
            color:#fff;
        }
        #messageArea{
            height: 500px;
            border: 1px solid grey;
        }
        
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
    
    <div class="container">
       <div class="row">
           <div class="col-2"></div>
        <div class="col-8 mt-2" style="height:80%">
            <div class="row p-2 m-2"  id="header">
                <h1 class="m-auto">Translate Bot</h1>
            </div>
            <div class="row p-2" id="messageArea">
                <div class="card" id="result"></div>
            </div>
            <div class="row m-2">
              <form type="text" name="text" id="text">
               <div class="col-10">
                      <input class="form-control" type="text" id="input">
               </div>
               <div class="col-2">
                   <button class="btn btn-outline-success" type=button onclick="sendText()">send</button>
               </div>
               </form>
                
            </div>
        </div>
        <div class="col-2"></div>
       </div>
        
    </div>
    
    <div id="display"></div>
    
    
    <script>
        /*var botmanWidget = {
            frameEndpoint: 'chat.html',
            chatServer : 'botman.php', 
            title: 'My Chatbot', 
            mainColor: '#456765',
            bubbleBackground: '#ff76f4',
            aboutText: '',
            bubbleAvatarUrl: null,
            placeholderText: 'message...',
            desktopHeight: '1000',
            desktopWidth: '1000'
        }; */
        
        function sendText1(){
            let text = document.querySelector("#input").value;
            //console.log(text);
            let result = document.querySelector("#result");
            //botmanChatWidget.open();
            botmanChatWidget.say(text);
            result.innerHTML = text;
        }
        function sendText(){
            let text = document.querySelector("#input").value;
            console.log(text);
            let data = new FormData();
            
            var item = {
               driver: 'web',
               userId: 'tny9rs',
               message : text
            };

            for (var key in item) {
                data.append(key, item[key]);
            }
            
            //data.append('driver','web');
            //data.append('userId','tny9rs');
            //data.append('message',text);
            console.log(data);
            $.ajax({
                url: 'https://adglobebot.herokuapp.com/botman.php',
                data: data,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(result){
                    //$("#result").html("success");
                    $("#input").val("");
                    console.log(result.messages[0].text);
                    $("#result").html(result.messages[0].text);
                }
            });
        }
        
        
    </script>
    <!--<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>