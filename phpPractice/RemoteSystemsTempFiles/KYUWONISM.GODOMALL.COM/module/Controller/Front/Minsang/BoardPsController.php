<?php 
namespace Controller\Front\Minsang; 

use App;
use Request;
use Component\Minsang\Board;

class BoardPsController extends \Controller\Front\Controller
{
    public function index() {
        $allGet = Request::post()->toArray();
        gd_debug($allGet);
        gd_debug($allGet['sendType']);
        
        $board = App::load(Board::class);
        switch($allGet['sendType']){
            case 'submit' :
                //$board->insertBoard($allGet['writer'],$allGet['title'],$allGet['content']);
                break;
                
            case 'modify' :
                
                break;
            
        }
        
        
        exit;
    }
    
    
    
    
}






?>