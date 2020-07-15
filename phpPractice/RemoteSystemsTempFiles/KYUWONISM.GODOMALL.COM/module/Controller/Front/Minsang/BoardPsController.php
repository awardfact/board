<?php 
namespace Controller\Front\Minsang; 

use App;
use Request;
use Component\Minsang\Board;

class BoardPsController extends \Controller\Front\Controller
{
    public function index() {
        //form문으로 요청된 post값을 배열로 받아옴
        $allGet = Request::post()->toArray();
        
        //파일데이터 받아오기
        $fileGet=Request::files()->toArray();
        
        //파일 데이터 확인
        gd_debug($fileGet);
        gd_debug($allGet);
        //파일 이름 분할
        $file_extension=explode(".",$fileGet['file']['name'],2);
        //time()과유니크한 값을 병합
        $tmp = time()."_".uniqid();
        //파일 이름 생성
        $user_file = $tmp.".".$file_extension[1];
        //파일 업로드 경로 설정
        $upload_path=$_SERVER['DOCUMENT_ROOT']."data/minsang/".$user_file;
        
        //DB에 저장되는 파일 경로
        if($fileGet['file']['error']){
            if($allGet['confirmDelete']==0 && $allGet['sendType']=='modify'){
                //기존 경로를 입력함
                $path=$allGet['imgSrc'];
            }else if($allGet['confirmDelete']==1){
                //파일 삭제만 하고 수정함
                $path=null;
            }else{
                //게시글 작성 시 첨부된 파일이 없음
                $path=null;
            }
                
        }
        else{
            if($allGet['confirmDelete']==0 && $allGet['sendType']=='modify'){
                //이미지가 변경되지 않음
                $path=$allGet['imgSrc'];
            }else if($allGet['confirmDelete']==1){
                //이미지가 변경됨
                $path='/data/minsang/'.$user_file;
            }else{
                $path='/data/minsang/'.$user_file;
            }
        }
            
        //board.php로드
        $board = App::load(Board::class);
        
        //스위치문을 이용하여 sendType을 기준으로 분기함
        switch($allGet['sendType']){
            //게시글 작성
            case 'submit' :
                //파일 업로드
                move_uploaded_file($fileGet['file']['tmp_name'],$upload_path);
                
                $board->insertBoard($allGet['writer'],$allGet['title'],$allGet['content'],$path);
                break;
            //게시글 수정
            case 'modify' :
                //이미지의 삭제여부를 확인 이미지가 추가되었는지 확인
                if($allGet['confirmDelete']!=0 || !$fileGet['file']['error']){
                    //파일 업로드
                    move_uploaded_file($fileGet['file']['tmp_name'],$upload_path);
                }
                
                $board->updateBoard($allGet['sno'],$allGet['writer'],$allGet['title'],$allGet['content'],$path);
                break;
            //게시글 삭제
            case 'delete' :
                for($i=0;$i<sizeof($allGet['sendData']);$i++){
                    $board->deleteBoard($allGet['sendData'][$i]);
                }
                break;
        }
        
        
        exit;
    }
    
    
    
    
}






?>