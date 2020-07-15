<?php 

namespace Controller\Front\Sangjin;

use App;
use Request;
use Component\Sangjin\Board;


class BoardPsController extends \Controller\Front\Controller
{
    public function index()
    {
        // 파일 업로드 경로 
        $uploadDirect = $_SERVER['DOCUMENT_ROOT']."data/sangjin/";
        
        // 입력된 정보를 받아옴
        $postValue = Request::request()->toArray();
        $getFile = Request::files()->all();

        
        // 기존 이미지 체크박스가 체크되어있으면 기존 이미지를 삭제하고 뒤를 진행한다 
        if($postValue['existingImageDelete'] && $postValue['image']){
            unlink($uploadDirect.$postValue['image']);
            $postValue['image'] = null;
        }
        

        //업로드한 파일이 있는 경우
        if($getFile['uploadFile']['name']){
            $file_extension = explode("." , $getfile['uploadFile']['name'],2);
            $tmp = time()."_".uniqid();
            $user_file = $tmp.".".$file_extension[1];
            $path = $uploadDirect.$user_file;
            //기존 파일이 있는경우 기존파일 삭제 
            if($postValue['image']){
                unlink($uploadDirect.$postValue['image']);
            }
            $postValue['image'] = $user_file;
            $tmp_name = $getFile['uploadFile']['tmp_name'];
            move_uploaded_file($tmp_name, $path);
        }
        
        
        $board = App::load(Board::class);
       
        
        // mode값에 따라 db에 내용 삭제, 삽입, 수정을 실행한다 
        switch($postValue['mode']){
            case 'write' :
                $board->makeList($postValue);
                break;
            case 'update' :
                $board->updateList($postValue);
                break;
            case 'delete' :
                $board->deleteList($postValue);
                break;
            case 'comment' : 
                $board->insertComment($postValue);
            default :
                break;
        }
        
        
        // 실행이 끝나면 리스트로 돌아간다 
        echo "<script> location.replace('board_list.php')</script>";
    }
    

}