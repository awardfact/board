<?php

/**
 * 회원정보 db관리 클래스


*/
class RegisterAdmin{


    public $inputId;   // 입력한 아이디
    public $inputPassword; // 입력한 패스워드

    private $hostname;  // 호스트 이름
    private $databaseUserName;   // 계정이름
    private $databasePassword;  // 계정 비밀번호
    private $databaseName;  // 데이터베이스 이름
    private $database;  // 회원정보 db
    private $query;
    private $row;
    private $fieldName;

    public $idExist;
    public $loginSuccess;


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
      // 매개변수를 이용하여 db를 만든다

    }
    /**
    * 아이디 중복체크 후 없는 아이디면 회원가입 하는 함수
    * @$inputId - 입력한 아이디 $inputPassword - 입력한 패스워드
    * @ return 0 - 회원가입 실패  return 1 - 회원가입 성공
    */
    public function duplicateCheck($inputId, $inputPassword){

      $this -> inputId = $inputId;
      $this -> inputPassword = $inputPassword;
      $this -> query = mysqli_query($this -> database, "SELECT id from register where id = '".$this -> inputId."'");
      // db에 입력한 아이디가 있으면 qeurt에 넣는다
      if($this -> row = mysqli_fetch_array($this -> query)){
        return 0;
      }
      // 쿼리에 있다면 이미 있는 아이디이기 때문에 회원가입 실패
      else{
        mysqli_query($this -> database, "INSERT INTO register(id,password)Values('".$this-> inputId."', '".$this-> inputPassword."')");
        return 1;
      }
      // 쿼리에 없다면 아이디를 생성할 수 있기 때문에 db에 아이디를 추가해준다


    }

    /** 로그인창에서 이용자가 입력한 아이디와 패스워드가 db정보와 일치하는지 체크하는 함수
    * @$inputId - 입력한 아이디 $inputPassword - 입력한 패스워드
    * @ return 0 - 로그인 실패  return 1 - 로그인 성공
    */
    public function loginCheck($inputId, $inputPassword){

      $this -> inputId = $inputId;
      $this -> inputPassword = $inputPassword;
      $this -> query = mysqli_query($this-> database , "SELECT id from register where id = '".$this -> inputId."'");
      // 먼저 입력한 아이디가 db에 있는지 확인한다
      if($this -> row = mysqli_fetch_array($this -> query)){
        $idExist = 1;
      }
      else {
        $idExist = 0;
        return 0;
      }
      // 있으면 idExist를 1로 해서 아이디가 존재한다는걸 체크하고 없다면 로그인 불가하기 때문에 return 0한다
      $this -> query = mysqli_query($this-> database , "SELECT id, password from register where id = '".$this -> inputId."' AND password = '".$this -> inputPassword."'");
      if($this -> row = mysqli_fetch_array($this -> query)){
        $loginSuccess = 1;
        return 1;
      }else{
        $loginSuccess = 0;
        return 0;
      }
      // 입력한 아이디와 패스워드가 일치하는 행이 있다면 로그인을 할 수 있으므로 1을 리턴해준다 

    }




}









 ?>
