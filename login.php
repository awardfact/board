<?php

include 'Data.php';
session_start();

if($_SESSION["loginId"]){
  ?>
  <script>
      location.href = 'Board.php';
      alert("이미 로그인 중입니다.");
  </script>
  <?php
}



 ?>



<head>
  <style>
    div{display : inline-block;}
    #registerCheck{display : none;}
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script>
    var boardlist = new Object();
    function asd(){
      alert('1213');
    }
    $(function(){
      $('#cancelButton').click(function(){

        location.href = 'Board.php';
      });
    });
  </script>
</head>



<body>
  <form method = "POST" action = "Board.php">
    <span>아이디 : </span>
    <input type = "text" name = "inputId"> </input>
    <span>비밀번호 : </span>
    <input type = "password" name = "inputPassword"> </input>
    <br>
    <input type = "text" name = "loginCheck" style = "display:none;" value = "ads"></input>
    <br>
    <span>
    <button type = "submit" name = "loginFinishButton" style = "display : inline" id = "registerCheck">로그인</button>
    </span>
  </form>
  <span><button id = "cancelButton">취소</button></sapn>
</body>
