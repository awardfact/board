<?php 
namespace Controller\Front\Minsang;

class TestController extends \Controller\Front\Controller
{
    
    public function index() 
    {
        $data = array(
            "data1" => "new sample data1"
            , "data2" => "new sample data2"
            , "data3" => "nemw sample data3"
        );
        $this->setData($data);
    }
}

