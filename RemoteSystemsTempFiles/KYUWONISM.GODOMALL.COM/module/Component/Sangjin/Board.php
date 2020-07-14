<?php

namespace Component\Sangjin;

use App;

class Board
{
    private $db;
    
    public function __construct(){

        //$db 변수에 DB모듈을 로드합니다.
        $this->db = App::load('DB');
        /*
         * App::load('DB');는 \App::load('DB");처럼 역슬러시를 이용해서 작성이 가능하지만 ,
         * Class 선언부 위에 use App; 라인을 이용해서 App을 사용할 수 있습니다.
         * 이렇게 선언하는 이유는 코드가 길어질수록 App을 사용하는 곳 역시 많이 질 수 있기 때문에 매번 \App을 사용하거나
         * 뒤에 소스코드를 수정하는 사람이 \를 사용하지않고 App을 사용했을 때 오류를 방지해주기 위한 권장사항입니다.
         *
         * */
    }

    public function getBoardList() {
        $sql = "SELECT * FROM wm_test";
        return $this->db->query_fetch($sql);
    }
    
    
    public function getBoardfieldList(){
        
        $sql = "SELECT * FROM wm_test";
        return $this -> db -> query_fetch($sql);
        
    }
    public function makeList($postValue){
        $title = $postValue['title'];
        $content = $postValue['content'];
        $writer = $postValue['writer'];
        
        
        $sql = "INSERT INTO wm_test(title, content, writer) Values('".$title."', '".$content."' , '".$writer."')";
        if($this -> db -> query_fetch($sql)){
            return 1;   
        }
        else{
            return 0;
        }
    }
}