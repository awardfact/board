

<?php

session_start();

if($_SESSION["loginId"]){
  echo "현재 접속중 아이디 : ", $_SESSION["loginId"];
 }

$clickNumber;
$originTitle;
$originContent;
$id;
$clickNumber;

if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['originContent']){
  if($_GET['makeId'] == $_SESSION["loginId"]){
    $originTitle = $_GET['originTitle'];
    $originContent = $_GET['originContent'];
    $id = $_GET['makeId'];
    $clickNumber = $_GET['clickNumber'];
    echo $originTitle;
  }
  else{
    ?>
    <script>
      alert("작성자만 수정이 가능합니다.");
      location.href = 'FreeBoard.php';
    </script>
    <?php
  }
}





?>

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
    input#origin{display : none;}
  </style>
</head>



<body>
  <form method = "POST" action = "clickBoard.php">
    제목
    <input type = "text" name = "inputTitle"> </input>
    <br>
    내용
    <textarea  name = "inputcontent"row = "50" cols = "50"></textarea>
    <input name = "originTitle" id = "origin" value = "<?php echo $originTitle; ?>"/>
    <input name = "originContent" id = "origin" value = "<?php echo $originContent; ?>"/>
    <input name = "makeId" id = "origin" value = "<?php echo $id; ?>"/>
    <input name = "clickNumber" id = "origin" value = "<?php echo $clickNumber; ?>"/>
    <span><button type = "submit">수정하기</button></span>
    <br>
  </form>
  <span><button id = "backButton">취소</button></span>
</body>
