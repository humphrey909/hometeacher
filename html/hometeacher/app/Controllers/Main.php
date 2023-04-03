<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Main_model;
use App\Models\Gamelist;
use CodeIgniter\I18n\Time;
class Main extends BaseController
{
    public $oGamelist = "";
    public $now = "";
	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');
        $this->oGamelist = new Gamelist();

        //Gamelist   
    }
    
    public function index()
    {
        echo "123";
        //svete와 연동
       // return view("../../../svelte/public/index.html");
    }

    //게임을 전부 여기서 띄울 것. 
    public function game()
    {
        return view("../../../svelte/public/index.html");
    }
    //game1
    public function game1()
    {
        return view("../../../svelte/public/index.html");
    }
    //game2
    public function game2()
    {
        return view("../../../svelte/public/index.html");
    }
    //game3
    public function game3()
    {
        return view("../../../svelte/public/index.html");
    } 

    /*public function getgamedata($glimit, $goffset){
        log_message('alert', json_encode("comeon????"));
        //[{"fieldname":"a.gid","fieldlogic":"=","fieldval":"2"}]
        $json=json_decode(file_get_contents('php://input'));
        //log_message('alert', json_encode($json));
        $json=$json->data;

        log_message('alert', "선택 데이터 ");
        log_message('alert', json_encode($json));
        //log_message('alert', json_encode(count($json)));

        $conditionarr = array();
        $conditionarr["feild"] = "a.idx,a.uid,a.name,a.info,a.url,a.thumimg,a.display,a.regdate,b.name as bname";


        if($json != null){
            if(count($json) > 0){
                foreach($json as $key => $value){

                    $conditionarr["where"][$value->fieldname]["logic"] = $value->fieldlogic;
                    $conditionarr["where"][$value->fieldname]["value"] = $value->fieldval;
                }
            }
           // $conditionarr["where"][$json->fieldname]["logic"] = $json->fieldlogic;
           // $conditionarr["where"][$json->fieldname]["value"] = $json->fieldval;
        }


        $conditionarr["order"]["feild"] = "a.idx";
        $conditionarr["order"]["value"] = "ASC";

       // $pagehandler = array();
        //$pagehandler["limit"] = $glimit; //리스트 갯수
       // $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $results = $this->oGamelist->getlist($conditionarr, '');
	    
	    log_message('alert', json_encode($results));
	    $response = $this->response->setJSON($results);

	    return $response;
    }*/

}
