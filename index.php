<!doctype html>
<html>

<head>
    <title>BotMan Widget</title>
    <meta charset="UTF-8">
    
    <style>
        .main-card{
            width:  100%;
            min-width: 500px;
        }
        .msgTime, .msgHeader{
            font-size: 0.6em;
            border: none;
            padding: 3px;
        }
        .msgHeader{
            font-size: 0.8em;
        }
        .instImg{
            border-radius: 0;
        }
        .main-card-body{
            height: 75vh;
            max-height: 75vh;
            overflow-y: auto;
        }
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
    
    <!--<div class="container">
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
    </div>-->
    <div class="container mt-5">
        <div class="row">
            <div class="main-card card m-auto">
                <div class="card-header bg-warning text-white">
                    <h3 class="m-0">Adglobe Bot</h3>
                </div>
                <div class="card-body main-card-body d-flex">
                    <div class="container displayArea">
                           <!--Text from User-->
                            <!--<div class="row justify-content-end mb-1">
                                <div class="card text-right">
                                    <div class="card-header msgHeader">from A</div>
                                    <div class="card-body p-2">
                                        <p class="card-text msgBody">message A</p>
                                    </div>
                                    <div class="card-footer text-muted bg-white msgTime">01:00</div>
                                </div>
                            </div>-->
                            
                            <!--Text from Bot-->
                            <div class="row justify-content-start mb-1">
                                <div class="card">
                                    <div class="card-header msgHeader">Bot</div>
                                    <div class="card-body p-2">
                                        <p class="card-text msgBody"># + 文章又は言葉　→　翻訳</p>
                                    </div>
                                    <div class="card-footer text-muted text-right bg-white msgTime">01:00</div>
                                </div>
                            </div>
                            <div class="row justify-content-start mb-1">
                                <div class="card">
                                    <div class="card-header msgHeader">Bot</div>
                                    <div class="card-body p-2">
                                        <p class="card-text msgBody">"@" + インスタグラムのユーザー名　→　直近投稿</p>
                                    </div>
                                    <div class="card-footer text-muted text-right bg-white msgTime">01:00</div>
                                </div>
                            </div>
                            
                            <!--Instagram from Bot-->
                            <!--<div class="row justify-content-start mb-1">
                                <div class="card" style="max-width: 200px;">
                                    <div class="card-header msgHeader">from Bot</div>
                                    <img src="./img/img.jpg" alt="" class="card-img-top instImg">
                                    <div class="card-body p-2">
                                        <p class="card-text">Instagram Caption</p>
                                    </div>
                                    <div class="card-footer text-muted text-right bg-white msgTime">01:00</div>
                                </div>
                            </div>-->

                    </div>
                </div>
                <div class="card-footer">
                    <div class="row m-2">
                       <div class="col-10">
                              <input class="form-control" type="text" id="input" autofocus>
                       </div>
                       <div class="col-2">
                           <button id="sendBtn" class="btn btn-outline-success" type=button onclick="sendText()">send</button>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function scroll(){
            $('.main-card-body').scrollTop($('.main-card-body')[0].scrollHeight);
        }
        
        document.querySelector("#input").addEventListener("keyup", function(event){
            event.preventDefault();
            
            if(event.keyCode === 13){
                document.querySelector("#sendBtn").click();
            }
        });
        
        function sendText(){
            let text = document.querySelector("#input").value;
            console.log(text);
            let data = new FormData();
            
            let item = {
               driver: 'web',
               userId: 'tny9rs',
               message : text
            };

            for (let key in item) {
                data.append(key, item[key]);
            }
            
            console.log(data);
            $.ajax({
                url: 'https://adglobebot.herokuapp.com/botman.php',
                data: data,
                type: 'POST',
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $date = new Date();
                    $sendTime = $date.getHours()+':'+$date.getMinutes();
                    $userText = '<div class="row justify-content-end mb-1">';
                    $userText = $userText+'<div class="card text-right">';
                    $userText = $userText+'<div class="card-header msgHeader">User</div>';
                    $userText = $userText+'<div class="card-body p-2">';
                    $userText = $userText+'<p class="card-text msgBody">'+ text +'</p>';
                    $userText = $userText+'</div>';
                    $userText = $userText+'<div class="card-footer text-muted bg-white msgTime">'+ $sendTime +'</div>';
                    $userText = $userText+'</div>';
                    $userText = $userText+'</div>';
                    
                    $('.displayArea').append($userText);
                    $("#input").val("");
                    scroll();
                },
                
                
                success: function(result){
                    let $indicator = result.messages[0].additionalParameters.type;
                    console.log($indicator);
                    $date2 = new Date();
                    $replyTime = $date2.getHours()+':'+$date2.getMinutes();
                    if($indicator == 'translate'){
                        $botText = '<div class="row justify-content-start mb-1">';
                        $botText = $botText+'<div class="card" style="max-width: 300px">';
                        $botText = $botText+'<div class="card-header msgHeader">Bot</div>';
                        $botText = $botText+'<div class="card-body p-2">';
                        $botText = $botText+'<p class="card-text msgBody">'+　result.messages[0].text　+'</p>';
                        $botText = $botText+'</div>';
                        $botText = $botText+'<div class="card-footer text-muted text-right bg-white msgTime">'+ $replyTime +'</div>';
                        $botText = $botText+'</div>';
                        $botText = $botText+'</div>';
                    
                    }else if($indicator == 'instagram'){
                        $botText = '<div class="row justify-content-start mb-1">';
                        $botText = $botText+'<div class="card" style="max-width: 300px;">';
                        $botText = $botText+'<div class="card-header msgHeader">Bot</div>';
                        $botText = $botText+'<img src="'+ result.messages[0].additionalParameters.imgSrc +'" alt="" class="card-img-top instImg">';
                        $botText = $botText+'<div class="card-body p-2">';
                        
                        let captionEnd = (result.messages[0].additionalParameters.caption).length>70?'...</p>':'</p>';
                        $botText = $botText+'<p class="card-text">'+ (result.messages[0].additionalParameters.caption).substring(0,70) + captionEnd;
                        
                        $botText = $botText+'</div>';
                        $botText = $botText+'<div class="card-footer text-muted text-right bg-white msgTime">'+ $replyTime +'</div>';
                        $botText = $botText+'</div>';
                        $botText = $botText+'</div>';
                        
                    }else if($indicator == 'error'){
                        $botText = '<div class="row justify-content-start mb-1">';
                        $botText = $botText+'<div class="card" style="max-width: 300px">';
                        $botText = $botText+'<div class="card-header msgHeader">Bot</div>';
                        $botText = $botText+'<div class="card-body p-2">';
                        $botText = $botText+'<p class="card-text msgBody">'+　result.messages[0].text　+'</p>';
                        $botText = $botText+'</div>';
                        $botText = $botText+'<div class="card-footer text-muted text-right bg-white msgTime">'+ $replyTime +'</div>';
                        $botText = $botText+'</div>';
                        $botText = $botText+'</div>';
                    }
                    
                    $('.displayArea').append($botText);
                    $botText = "";
                    scroll();
                }
            });
        }
        
        
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>