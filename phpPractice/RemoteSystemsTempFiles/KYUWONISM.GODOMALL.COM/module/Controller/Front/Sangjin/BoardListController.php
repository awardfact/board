<?php 
namespace Controller\Front\Sangjin;

use App;
use Request;
use Component\Sangjin\Board;
use Session;

class BoardListController extends \Controller\Front\Controller
{
    public function index()
    {
        //session_start();

        $postValue = Request::request()->toArray();
        $board = App::load(Board::class);
        
        $session = App::getInstance('session');
        
        if($postValue['mode'] == 'logout'){
            $session->del(SESSION_USER_CERTIFICATION);
            
        }
        
        if($session->has(SESSION_USER_CERTIFICATION)){
            $loginId = $session->get(SESSION_USER_CERTIFICATION);
            
        }

        
        // 페이지 번호를 클릭하지 않았다면 첫 페이지기 때문에 페이지 번호를 0번으로 초기화해준다 
        if(!$postValue['page']){
            $postValue['page'] = 0;
        }
        // selectNumber가 넘어오지 않은 것은 체크를 하지 않았기 때문에 10으로 바꿔준다ㅣ 
        if(!$postValue['selectedNumber']){
            $postValue['selectedNumber'] = 10;
        } 
        /*
        if(!$_SESSION['page']){
            $_SESSION.setAttribute('page', 0);
        }
        if(!$_SESSION['number']){
            $_SESSION.setAttribute('number', 10);
        }
        */
        

        // 전체 게시글 숫자를 받아온다 
        $postValue['boardCount']= $board->getBoardCount();
        
        
        //전체 게시글 숫자 / 페이지당 게시글 숫자를 해서 페이지가 총 몇개가 필요한지 얻는다 
        $postValue['maxPage'] =(int) ($postValue['boardCount'] / $postValue['selectedNumber']);
        
        // 1페이지로 이동 버튼을 눌렀다면 page를 0으로 바꿔준다 
        if($postValue['minPageCheck'] == 1){
            $postValue['page'] = 0;
        }
        //끝 페이지로 이동 버튼을 눌렀다면 page를 maxpage로 바꿔준다 
        if($postValue['maxPageCheck'] == 1){
            $postValue['page'] = $postValue['maxPage'];
        }
        
        //현재 페이지, 페이지당 숫자를 통해 게시글과 게시글들의 댓글 숫자를 얻어온다 
        $boardData = $board->getBoardList($postValue);
        $comment = $board->getCommentList($boardData);

        $this->setData('commentNumber',$comment);
        $this->setData('boardList', $boardData);
        $this->setData('currentPage', $postValue);
        $this->setData('loginId' , $loginId);
        gd_debug($loginId);
        gd_debug($postValue);
    }
    

}