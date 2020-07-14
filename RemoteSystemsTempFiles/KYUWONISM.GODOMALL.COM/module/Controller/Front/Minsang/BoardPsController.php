<?php 
namespace Controller\Front\Minsang; 

use App;
use Request;

class BoardPsController extends \Controller\Front\Controller
{
    public function index() {
        $allGet = get()->all();
        gd_debug($allGet);
    }
    
    
    
    
}






?>