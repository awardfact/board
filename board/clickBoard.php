<?php

include 'Data.php';

$db = new DataIO('localhost', 'root', '123456', 'board', 'freeboard');

$title;
$content;
$id;
$clickNumber;
session_start();

if($_SESSION["loginId"]){
  echo "현재 접속중 아이디 : ", $_SESSION["loginId"];
 }


if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['title']){

  $title = $_GET['title'];
  $content = $_GET['content'];
  $id = $_GET['makeId'];
  $clickNumber = (int)$_GET['clickNumber'] + 1;
  $db-> readBoard($title, $content, $id, $clickNumber);
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['inputTitle']){
  if($db-> updateBoard($_POST['originTitle'],$_POST['originContent'],$_POST['inputTitle'],
  $_POST['inputcontent'],$_POST['makeId'])){
    ?>
    <script>
      alert("글을 수정하였습니다.");
    </script>
    <?php
    $title = $_POST['inputTitle'];
    $content = $_POST['inputcontent'];
    $id = $_POST['makeId'];
    $clickNumber = $_POST['clickNumber'];
  }else{
    ?>
    <script>
      alert("수정실패.");
    </script>
    <?php
    $title = $_POST['originTitle'];
    $content = $_POST['originContent'];
    $id = $_POST['makeId'];
    $clickNumber = $_POST['clickNumber'];
  }



}



if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['delete']){
  if($_GET['makeId'] == $_SESSION["loginId"]){
    if($db-> deleteBoard($title, $content, $id)){
      ?>
      <script>
        alert("삭제완료");
        location.href = 'FreeBoard.php';
      </script>
      <?php
    }
    else{
      ?>
      <script>
        alert("삭제 실패");
      </script>
      <?php
    }
  }
  else{
    ?>
    <script>
      alert("작성자만 삭제할 수 있습니다.");
    </script>
    <?php
  }
}
?>

<html>
<head>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script>
  var slot;
  $(function(){
    $('#backButton').click(function(){
      location.href = 'FreeBoard.php';
    });
  });
  </script>
  <style>
    div { width : 70%; height : 500px; padding :
      5px;top : 30%; left : 20%;  align-self: center;
      background: lightgray;}
    textarea{ width : 500px; height : 400px; resize : none;}
    input{display : none;}
  </style>
</head>
<body>
</div>
<div id = "contentContainer">
  제목 : <span><?php print $title; ?></span>
  <br>
  내용  <br>
  <textarea disabled> <?php print $content; ?> </textarea>
  <br>
  <span>작성자 : <?php print $id; ?></span>
  <span>조회수 : <?php print $clickNumber; ?></span>
</div>
 <form method ="GET" action ="<?php echo $_SERVER['PHP_SELF'];?>">
   <input name = "title"  value = "<?php echo $title; ?>"/>
   <input name = "content" value = "<?php echo $content; ?>" />
   <input name = "makeId" value = "<?php echo $id; ?>" />
   <sapn><button  id = "boardDeleteButton" name ="delete" value = "1">삭제</button></span>
 </form>
 <form method = "GET" action = "update.php">
   <input name = "originTitle"  value = "<?php echo $title; ?>"/>
   <input name = "originContent" value = "<?php echo $content; ?>" />
   <input name = "makeId" value = "<?php echo $id; ?>" />
   <input name = "clickNumber" value = "<?php echo $clickNumber; ?>" />
   <span><button  id = "boardAdjustButton">수정</button></span>
 </form>
 <form method = "POST" action = "FreeBoard.php"><span><button  id = "backButton">뒤로가기</button></sapn></form>
</body>
</html>
