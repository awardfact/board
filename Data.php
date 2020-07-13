<?php


/**
* 게시판 db 관리 클래스


*/


class DataIO{

  private $hostname;  // 호스트 이름
  private $databaseUserName;   // 계정이름
  private $databasePassword;  // 계정 비밀번호
  private $databaseName;  // 데이터베이스 이름
  private $database;  // 위에걸로 연결한 데이터베이스
  private $query;  // 데이터베이스로 가져온 쿼리
  private $row;  // 쿼리에 있는 열
  public $currentPageNumber; // 현재 자유게시판 몇 페이지를 보고있는지
  private $fieldName;

  public $m_boardTitle = array();  // 게시글 제목
  public $m_boardContent = array();  // 게시글 내용
  public $m_boardNumber = array(); // 게시글 번호
  public $m_boardmakeId = array(); // 게시글 만든 아이디
  public $m_clickNumber = array(); // 게시글 조회수

  public static $loginId;

  public $inputText;
  public $inputTitle;
  public $inputId;

  /**
  * 매개변수로 호스트이름, 사용자 이름, 패스워드 , 데이터베이스 이름을 받아서 db를 생성해주는 생성자
  *@ $hostname - 호스트이름 $databaseUserName - db 사용자 이름
  *@$databaseName - db 이름 $databasePassword - db패스워드 $fieldName - db필드이름
  */
  public function __construct($hostname, $databaseUserName, $databasePassword, $databaseName,$fieldName){
    $this -> hostname = $hostname;
    $this -> databaseUserName = $databaseUserName;
    $this -> databasePassword = $databasePassword;
    $this -> databaseName = $databaseName;
    $this -> fieldName = $fieldName;
    $this -> database = mysqli_connect($hostname, $databaseUserName, $databasePassword, $databaseName);
    $this -> currentPageNumber = 1;
  }

  /** 데이터베이스에 있는 내용 첫 페이지 내용을 배열에 넣어주는 함수
  * @$m_boardTitle 게시글 제목   $m_boardContent - 게시글 내용  $m_boardmakeId- 게시글 작성 아이디
  */
  public function getBoardData(){
    $this->currentpageNumber = $currentPageNumber;
    $this->query = mysqli_query($this -> database, "SELECT * from freeboard order by sno desc limit 0, 10") or die("오류발생");
    // db에서 번호가 제일 높은 10개를 쿼리에 넣는다
    $i = 0;
    while($this->row = mysqli_fetch_array($this->query)){
      $this->m_boardTitle[$i] = $this->row['m_boardTitle'];
      $this->m_boardNumber[$i] = $this->row['sno'];
      $this->m_boardmakeId[$i] = $this->row['m_boardmakeId'];
      $this->m_boardContent[$i] = $this->row['m_boardContent'];
      $this->m_clickNumber[$i] = $this->row['m_clickNumber'];
      $i += 1;
      //쿼리의 내용을 게시글 정보 배열에 넣는다
    }
  }


  /**
  * 매개변수로 작성할 게시글 제목, 내용 , 아이디를 받아서 db에 추가해주는 함수
  * @$inputTitle - 작성 제목  $inputText - 작성 내용 $inputId -작성 아이디
  *
  */
  public function makeBoard($inputTitle, $inputText, $inputId){
    $this -> inputTitle = $inputTitle;
    $this -> inputText = $inputText;
    $this -> inputId = $inputId;

    mysqli_query($this -> database, "INSERT INTO freeboard(m_boardTitle, m_boardContent, m_boardmakeId, m_clickNumber)
    Values('".$this-> inputTitle."', '".$this-> inputText."' ,'".$this -> inputId."', 0)");
    // db에 게시글 제목, 내용, 아이디, 조회수를 넣어준다
  }



  /** 배열 번호를 매개변수로 db에서 얻어온 내용을 통해 db내용을 삭제해주는 함수
  * @$ number - 배열번호
  */
  public function deleteBoard($inputTitle, $inputText, $inputId){
    $this -> inputTitle = $inputTitle;
    $this -> inputText = $inputText;
    $this -> inputId = $inputId;
    if(mysqli_query($this-> database, "DELETE FROM freeboard where
    m_boardTitle = '".$this -> inputTitle."'AND m_boardContent = '".$this -> inputText."'
    AND m_boardmakeId = '".$this -> inputId."'"))
    {
      return 1;
    }
    else
    {
      return 0;

    }
       // 클래스에 있는 배열[$number]와 일치하는 db를 삭제한다
  }


  public function readBoard($inputTitle, $inputText, $inputId, $clickNumber){
    $this -> inputTitle = $inputTitle;
    $this -> inputText = $inputText;
    $this -> inputId = $inputId;
    $this -> clickNumber = $clickNumber;
    mysqli_query($this-> database, "UPDATE freeboard set m_clickNumber = '".$this -> clickNumber."' where
    m_boardTitle = '".$this -> inputTitle."'AND m_boardContent = '".$this -> inputText."'
    AND m_boardmakeId = '".$this -> inputId."'");
  }


  public function updateBoard($originTitle, $originContent, $updateTitle, $updateContent, $inputId){
    echo $originTitle;

    if(mysqli_query($this-> database, "UPDATE freeboard set m_boardTitle = '".$updateTitle."' , m_boardContent = '".$updateContent."'
      where m_boardTitle = '".$originTitle."'AND m_boardContent = '".$originContent."' AND m_boardmakeId = '".$inputId."'")){
        return 1;
      }
      else{
        return 0;
      }


  }

}


?>
