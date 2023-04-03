<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Characterlist;
use App\Models\Subjectlist;
use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\IncomingRequest;
//use App\Controllers\Upload;
//use App\Models\Imglist;

//성격, 과외 리스트를 불러오는 컨트롤러 
class Categorey extends BaseController
{
    public $oCharacterlist = "";
    public $oSubjectlist = "";
    //public $oImglist = "";
    public $now = "";
	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');

        $this->oCharacterlist = new Characterlist();
        $this->oSubjectlist = new Subjectlist();
      //  $this->oImglist = new Imglist();
    }
    
    //리스트페이지
    public function getdata($glimit, $goffset)
    {
        log_message('alert', "type !!!!!! ".json_encode($_GET['type']));
        log_message('alert', "type !!!!!! ".json_encode($_POST));
        log_message('alert', "type !!!!!! ".json_encode($_POST['catetype']));

        $conditionarr = array();

        //성격 리스트
        if($_POST['catetype'] == 1){ 
            $conditionarr["order"]["feild"] = "idx";
            $conditionarr["order"]["value"] = "ASC";
    
            $pagehandler = array();
            $pagehandler["limit"] = $glimit; //리스트 갯수
            $pagehandler["offset"] = $goffset; //리스트 위치 

            
            $results = $this->oCharacterlist->getlist($conditionarr, $pagehandler);


            log_message('alert', "성격 리스트".json_encode($results));


            $result = $this->response->setJSON($results);
            
        }else if($_POST['catetype'] == 2){ //과목 리스트 
            $conditionarr["order"]["feild"] = "idx";
            $conditionarr["order"]["value"] = "ASC";
    
            $pagehandler = array();
            $pagehandler["limit"] = $glimit; //리스트 갯수
            $pagehandler["offset"] = $goffset; //리스트 위치 

            
            $results = $this->oSubjectlist->getlist($conditionarr, $pagehandler);


            log_message('alert', "과목 리스트".json_encode($results));


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
