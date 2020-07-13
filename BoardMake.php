

<head>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script>
  $(function(){
    $('#backButton').click(function(){
      location.href = 'FreeBoard.php';
    });
  });
  </script>
  <style>
    textarea{width : 700px; height:500px; display: block;}
    input{display: block;}
  </style>
</head>



<body>
  <form method = "POST" action = "FreeBoard.php">
    제목
    <input type = "text" name = "inputTitle"> </input>
    <br>
    내용
    <textarea  name = "inputcontent"row = "50" cols = "50"></textarea>
    <span><button type = "submit">글쓰기</button></span>
    <br>
  </form>
  <span><button id = "backButton">취소</button></span>
</body>
