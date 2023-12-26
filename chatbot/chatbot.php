<!DOCTYPE html>
<html>
<head>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../chatbot/stylechat.css">

    <style>
        /* Style for the button */
        #chatbot-button {
            position: fixed;
            right: 3%;
            top: 90%;
            background-image: linear-gradient(to left top,  #f91bf2, pink);
            color: white;
            border-radius: 50%;
            width: 80px;
            height: 78px;
            text-align: center;
            line-height: 50px;
            font-size: 40px;
            cursor: pointer;
            z-index: 1;
        }
        /* Style for the chatbot window */
        #chatbot-window {
            position: fixed;
            left: 80%;
            top: 20%;
            width: 300px;
            height: 400px;
            padding: 20px;
            display: none;
            z-index: 1;
        }
    </style>
</head>
<body>
    <!-- Button to open the chatbot window -->
    <div id="chatbot-button" onclick="openChatbot()">
    <img src="../images/chatbot1.png"  width="100%" height="100%">
    </div>
 
    <button style=" position: fixed; bottom: 8%;right: 1%;
     color:black; background-color: Transparent;;
     border:none; font-size:large;"
    for="click on me" onclick="openChatbot()">click on me</button>
   

    <!-- Chatbot window -->
    <div id="chatbot-window">
      <div class="wrapper">
        <div class="title">Chat bot helper </div>
        <div class="form">
        <div class="bot-inbox inbox">
        <div class="icon">  <img src="../images/chatbot1.png"  width="50px" height="50px"></div>
                <div class="msg-header">
                    <p>Hi my name is robi ,  your helper robot😊, <br />
                        If you want to get your details flight  , please enter part or full IATA (flight number)</p>
               
        </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type something here.." required>
                <button id="send-btn" >Send</button>
            </div>
        </div>
    </div>
      
    </div>
    <script>




        // Function to open the chatbot window
        function openChatbot() {
            if(   document.getElementById('chatbot-window').style.display == 'block')
            {
                document.getElementById('chatbot-window').style.display = 'none';
            }
            else
            {        
                    document.getElementById('chatbot-window').style.display = 'block';

            }
        }
       
       
    </script>
</body>
</html>


<script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: '../chatbot/message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon">  <img src="../images/chatbot1.png"  width="50px" height="50px"></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });

      
    </script>