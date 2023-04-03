<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Mentoringcategorey;
use App\Models\Teacherdedatecategorey;
use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\IncomingRequest;
//use App\Controllers\Upload;
//use App\Models\Imglist;

//성격, 과외 리스트를 불러오는 컨트롤러 
class Nboardcategorey extends BaseController
{
    public $oMentoringcategorey = "";
    public $oTeacherdedatecategorey = "";
    //public $oImglist = "";
    public $now = "";
	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');

        $this->oMentoringcategorey = new Mentoringcategorey();
        $this->oTeacherdedatecategorey = new Teacherdedatecategorey();
      //  $this->oImglist = new Imglist();
    }
    
    //리스트페이지
    public function getdata($glimit, $goffset)
    {
        log_message('alert', "getdata !!!!!! ".json_encode($_GET));
        log_message('alert', "getdata !!!!!! ".json_encode($_POST));
        log_message('alert', "getdata !!!!!! ".json_encode($_POST['maincategoreytype']));

        $conditionarr = array();

        //멘토링 리스트
        if($_POST['maincategoreytype'] == 1){ 
            $conditionarr["order"]["feild"] = "idx";
            $conditionarr["order"]["value"] = "ASC";
    
            $pagehandler = array();
            $pagehandler["limit"] = $glimit; //리스트 갯수
            $pagehandler["offset"] = $goffset; //리스트 위치 

            
            $results = $this->oMentoringcategorey->getlist($conditionarr, $pagehandler);


            log_message('alert', "멘토링 리스트".json_encode($results));


            $result = $this->response->setJSON($results);
            
        }else if($_POST['maincategoreytype'] == 2){ //선생님 토론 리스트 
            $conditionarr["order"]["feild"] = "idx";
            $conditionarr["order"]["value"] = "ASC";
    
            $pagehandler = array();
            $pagehandler["limit"] = $glimit; //리스트 갯수
            $pagehandler["offset"] = $goffset; //리스트 위치 

            
            $results = $this->oTeacherdedatecategorey->getlist($conditionarr, $pagehandler);


            log_message('alert', "선생님 토론 리스트".json_encode($results));


            $result = $this->response->setJSON($results);
            
        }

        return $result; 

    }

    //수정, 보기 페이지
    public function info()
    {
        //return view("../../../svelte/public/index.html");
    }

}
