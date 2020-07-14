


<?php
/**
* 시작페이지
* 로그인, 회원가입, 로그아웃 , 게시판 이동 기능이 있다
*/


include 'RegisterAdmin.php';
include 'Data.php';

$registerAdmin = new RegisterAdmin('localhost','root','123456','board','register');
$db = new DataIO('localhost', 'root', '123456', 'board', 'freeboard');
// db관리 클래스들을 include시켜서 객체를 만든다


session_start();
// 로그인 상태를 유지하기 위해서 세션을 시작한다
print $_SESSION['loginId'];

/**
*inputid - 입력한 아이디 inputPassword -입력한 패스워드 registerCheck - 회원가입 창에서 입력했는지 체크변수
* 회원가입 화면에서 아이디와 패스워드를 입력하고 회원가입 버튼을 눌르면 POST가 되고
* 만들어논 db관리 class에 있는 함수를 통해 회원가입을 한다
*/
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['registerCheck'] &&$_POST['inputId'] && $_POST['inputPassword']){
  $success = $registerAdmin -> duplicateCheck($_POST['inputId'], $_POST['inputPassword']);
  if($success){
    ?>
    <script>
    alert("회원가입 성공");
    </script>
    <?php
  }
  else{
    ?>
    <script>
    alert("회원가입 실패");
    </script>
    <?php
  }
}


/**
*inputid - 입력한 아이디 inputPassword -입력한 패스워드 loginCheck - 로그인 창에서 입력했는지 체크변수
*로그인 화면에서 아이디와 패스워드를 입력하고 로그인 버튼을 눌르면 POST가 되고
* db에 입력한 아이디와 패스워드가 있으면 로그인이 성공되고 세션에 로그인 아이디를 넣는다
*/
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['loginCheck'] && $_POST['inputId'] && $_POST['inputPassword']){
  $success = $registerAdmin -> loginCheck($_POST['inputId'], $_POST['inputPassword']);
  if($success){
    $db -> $loginId = $_POST['inputId'];
    $_SESSION["loginId"] = $db->$loginId;
    ?>
    <script>
    alert("로그인 성공");
    </script>
    <?php
  }
  else{
    if($registerAdmin -> $idExist == 0){
      ?>
      <script>
      alert("입력한 아이디가 존재하지 않습니다.");
      </script>
      <?php
    }
    else{
      ?>
      <script>
      alert("패스워드를 잘못 입력하셨습니다.");
      </script>
      <?php
    }
  }
}




// 세션에 아이디가 있으면 아이디를 출력해준다
if($_SESSION["loginId"]){
    echo "현재 접속중 아이디 : ", $_SESSION["loginId"];
}


// 로그아웃 버튼을 눌렀을 때 로그인 상태라면 세션에 있는 내용을 삭제한다
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['logoutCheck'] && $_SESSION["loginId"]){
  print 123;
  session_destroy();
  unset($_SESSION["loginId"]);
  ?>
  <script>
      location.href = 'Board.php';
  </script>
  <?php
}



?>



<!doctype html>
<head>
  <style>
    #menu {background : gray; Color : blue; font-size : 30px; text-align : center;}
    #freeBoardButton {display: none; font-size : 30px; }
    #registerButton{display : none; font-size : 30px; }
    div#boardContainer {display:none; width : 70%; height : 500px; padding :
      5px;top : 30%; left : 20%; position: absolute; align-self: center;}
    #freeBoardList { background : lightgray; }
    #searchText{position: relative; top: 90%; left : 30% }
    #loginButton{display :none; font-size :30px;}
    #logoutButton{display :none; font-size : 30px;}

  </style>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script>
    var boardlist = new Object();
    function asd(){
      alert('1213');

    }
    $(function(){

      $('#menu').click(function(){
        if($('#freeBoardButton').css('display') == 'none')
        {
          $('#freeBoardButton').css('display','inline');
          $('#registerButton').css('display','inline');
          $('#loginButton').css('display','inline');
          $('#logoutButton').css('display','inline');
        }
        else
        {
          $('#freeBoardButton').css('display', 'none');
          $('#registerButton').css('display', 'none');
          $('#loginButton').css('display','none');
          $('#logoutButton').css('display','none');
        }
      });


      $('#title').click(function(){
        $('#freeBoardButton').css('display', 'none');
        $('#boardContainer').css('display','none');
        $('#registerButton').css('display','none');
        $('#loginButton').css('display','none');
        $('#logoutButton').css('display','none');
      });


  /*    $('freeBoardButton').click(function(){
        $('#freeBoardButton').css('display','none');
        $('#boardContainer').css('display','block');
        $.ajax({ url : 'Board.php',
          dataType : 'json',
          type : 'GET',
          success : function(data){
            alert(data);
          }
        .done(function(){
            alert("실패");
        })
        });
      });*/

  });

</script>
</head>
<body>

  <h1 id = "title">
  HomePage
  </h1>
  <hr>
  <h3 id = "menu">
    Menu
  </h3>
  <br>
  <form method="POST" action="FreeBoard.php">
  <button type = "submit" id = "freeBoardButton">
    FreeBoard
  </button>
  </form>
  <form method "GET" action= "register.php">
    <button type = "submit" id = "registerButton"> 회원가입
    </button>
  </form>
  <form method "GET" action = "login.php">
    <button type = "submit" id = "loginButton">로그인</button>
  </form>
  <form method= "POST" action ="Board.php">
  <button type = "submit" id = "logoutButton" value="hjk1">로그아웃</button>
  <input type = "text" name = "logoutCheck" style = "display:none;" value = "ads"></input>
  </form>


  </body>
