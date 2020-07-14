

<?php
/**
*
*  게시판 화면 php 접속시 로그인 상태가 아니라면 메인화면으로 돌아가고 번호가 가장 높은 게시글 10개가 자동으로 출력된다
*
*/
include 'Data.php';

 $db = new DataIO('localhost', 'root', '123456', 'board', 'freeboard');

 session_start();
 //아이디가 있어야 접속 가능하기 때문에 세션을 시작해준다

 $clickSlot;
 $db -> getBoardData();
 // db에서 번호가 가장 높은 10개를 가져온다


 if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['inputTitle']){
   $db-> makeBoard($_POST['inputTitle'], $_POST['inputcontent'], $_SESSION['loginId']);
   $db-> getBoardData();
 }


 // 클릭한 게시글이 db클래스의 몇 번째 배열인지 체크해서 출력한다


/**  글쓰기 화면에서 제목과 내용을 POST로 보내면 그 내용을 db에 추가한다
* @inputTitle - 글 제목 inputcontent - 글 내용
*/
// 로그인 상태가 아니라면 Board.php로 돌아간다
 if(!$_SESSION["loginId"]){
   ?>
   <script>
       alert("로그인을 해야 이용이 가능합니다.");
       location.href = 'Board.php';
   </script>
   <?php
 }
 else{
    echo "현재 접속중 아이디 : ", $_SESSION["loginId"];

 }
?>

<head>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script>

  var slot;

  $(function(){
    $('#title').click(function(){
      location.href = 'Board.php';
    });

    $('#boardMakeButton').click(function(){
      location.href = 'BoardMake.php';
    });

    $('#backButton').click(function(){
      location.href = 'Board.php';
    });

     $('.slot').click(function(){
        $('#boardContainer').css('display','none');
        $('#contentContainer').css('display','block');
        $('#boardMakeButton').css('display', 'none');
        $('.c_Button').css('display','inline');
      });

    $('#backButton').click(function(){
      $('.c_Button').css('display','none');
      $('#boardMakeButton').css('display', 'inline');
      $('#boardContainer').css('display','block');
      $('#contentContainer').css('display','none');
    });

  });

  </script>
  <style>
  div { width : 70%; height : 500px; padding :
    5px;top : 30%; left : 20%;  align-self: center;
    background: lightgray;}
  div#contentContainer{display : none;}
  textarea{width : 500px; height : 400px; resize : none; }
  .c_Button{display : none;}
  h5 {display : none}
  input{width = 50px;}
  input#content{width = 100px;}
  </style>
</head>

<body>
  <h1 id = "title">
  HomePage
  </h1>
  <hr>
  <div id = "boardContainer">
        <table>
          <tr><td>제목&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;내용&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td> <td>&nbsp;&nbsp;작성자&nbsp;&nbsp;&nbsp;</td> <td>&nbsp;&nbsp;조회수</td><td>클릭</td></tr>
        <?php
          for($i =0; $i < 10; $i++){
            if($db -> m_boardTitle[$i]){
              echo "<form method = \"GET\" action =\"clickBoard.php\"><tr><td><input readonly name = \"title\" value = \"".$db->m_boardTitle[$i]."\"></input></td><td><input id = \"content\" readonly name = \"content\" value = \"".
              $db->m_boardContent[$i]."\"></input></td><td><input readonly name = \"makeId\" value = \"".$db->m_boardmakeId[$i]."\"></input></td><td><input readonly name = \"clickNumber\" value = \"".$db->m_clickNumber[$i]."\"/></td>
              <td><button type = \"submit\">글 읽기</button></td></tr></form>";
            }
          }
        ?>
      </table>
  </div>
  <span><button id = "boardMakeButton">글쓰기</button></span>
  <span><button id = "backButton">뒤로가기</button></span>
</body>
