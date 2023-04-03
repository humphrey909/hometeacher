<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Gameranklist;
use CodeIgniter\I18n\Time;
use App\Models\User;
class Rank extends BaseController
{

    public $oGameranklist = "";
    public $oUser = "";
    public $now = "";
	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');

        $this->oGameranklist = new Gameranklist();
        $this->oUser = new User();
    }
    
    public function index()
    {
        return view("../../../svelte/public/index.html");
    }
    public function total()
    {
        return view("../../../svelte/public/index.html");
    }
    //데이터 추가
    public function getdatainsert(){
        $json=json_decode(file_get_contents('php://input'));
        $json=$json->rankdata;
        log_message('alert', "랭크 데이터 ".json_encode($json));
        log_message('alert', "랭크 데이터 ".json_encode($json->gid));
        log_message('alert', "랭크 데이터 ".json_encode($json->uid));
        log_message('alert', "랭크 데이터 ".json_encode($json->score));
        log_message('alert', "랭크 데이터 ".$json->nic);
        
        //닉네임이 있다면 uid 값이 0
        if($json->nic){
            $json->uid = null;
        }

        $data=array("idx" => '0', 'gid' => $json->gid, 'uid' => $json->uid, 'nicname' => $json->nic, 'score' => $json->score, 'regdate' => $this->now);

        $results = $this->oGameranklist->getinsert($data);
        log_message('alert', "랭크 응답 ".$results); //1 나옴

        if($results == 1){
            //방금 insert한 id 가져오기
            $resultsid = $this->oGameranklist->getinsertid();
            log_message('alert', "랭크 응답 getincre  ".$resultsid); 
        }

       //array로 묶어서 json으로 변환
        $response = $this->response->setJSON(['result'  => $results, 'id'  => $resultsid]);

        return $response; 
    }

    public function getdata($glimit, $goffset){
        $json=json_decode(file_get_contents('php://input'));
        $json=$json->data;
        log_message('alert', "랭크 데이터 ".json_encode($json));
        //log_message('alert', "랭크 데이터 ".json_encode($json->gameidx));



        $conditionarr = array();
        // ['idx', 'gid', 'uid', 'nicname', 'score', 'regdate'];
        //$conditionarr["feild"] = "a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info";
        //$conditionarr["feild"] = "a.idx,a.gid,a.uid,a.nicname,a.score,a.regdate,b.email,b.name as bname";
        $conditionarr["where"][$json->fieldname]["logic"] = "=";
        $conditionarr["where"][$json->fieldname]["value"] = $json->fieldval;

        $conditionarr["order"]["feild"] = "score";
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 


        log_message('alert', "conditionarr ".json_encode($conditionarr));

        $results = $this->oGameranklist->getlist_join($conditionarr, $pagehandler);
	    


//uid = null 비회원 -> 합치지 말고 닉네임 사용
//uid != null 회원 -> 유저 테이블 불러와서 합치기

//$this->oUser
        foreach($results as $key => $value){
            //log_message('alert', json_encode($value));
            //log_message('alert', json_encode($value->uid));

            if($value->uid != null){//회원
                $result = $this->oUser->getdataone($value->uid);
                //log_message('alert', "!!!!!!@@@@@@@@@@@@@");
            // log_message('alert', json_encode($result));
               // log_message('alert', json_encode($result[0]->name)); //저장할 이름

               
               $results[$key]->membername = $result[0]->name;
               //log_message('alert', "!!!".json_encode($results[$key]));
            }
        }


	    log_message('alert', json_encode($results));
	    $response = $this->response->setJSON($results);

	    return $response;
    }

    //나의 랭크 페이지에서 게임별 최고점 랭크를 가져옴
    function myrankdata($glimit, $goffset){
        $json=json_decode(file_get_contents('php://input'));

        log_message('alert', "마이 랭크 데이터 ".json_encode($json));
        $limit = $glimit; //리스트 갯수
        $offset = $goffset; //리스트 위치 

        $Myrankarr = array();
        for($rnum=1;$rnum<=3;$rnum++){
            $conditionarray = array("uid" => $json->uid, "gid" => $rnum);
            $maxscore = $this->oGameranklist->getmaxdata($conditionarray); //최대 점수
            log_message('alert', "나의 랭크 데이터 ");
            log_message('alert', json_encode($maxscore[0]));
            
            if($maxscore[0]->score != null){

                //json 다시 만듬
                $conditionarray = array("uid" => $json->uid, "gid" => $rnum, "score" => $maxscore[0]->score);
                $limit = $glimit; //리스트 갯수
                $offset = $goffset; //리스트 위치 
                $order = array("name" => "regdate", "type" => "DESC");
                $scoreidx = $this->oGameranklist->getlist($conditionarray, $limit, $offset, $order); //점수에 맞는 idx 구하기
                
                //log_message('alert', json_encode($scoreidx));
                log_message('alert', json_encode($scoreidx[0]));
                log_message('alert', json_encode($scoreidx[0]->idx));  //idx 값으로 등수 찾기
                
                if($scoreidx[0]->idx != null){
                    $rankcount = $this->oGameranklist->getRankcount($scoreidx[0]->idx, $rnum); //idx로 랭킁 등수 구하기
                }

                log_message('alert', $rankcount[0]['score']);
                log_message('alert', $rankcount[0]['RankNo']);
                $Myrankarr_2 = array("gid" =>  $rankcount[0]['gid'], "score" =>  $rankcount[0]['score'], "rankno" => $rankcount[0]['RankNo']);
                array_push($Myrankarr, $Myrankarr_2);

            }else{
                $Myrankarr_2 = array("gid" =>  $rnum);
                array_push($Myrankarr, $Myrankarr_2);
            }
        }

         //이 사람의 최고 점수를 가져왔는데, 그 점수가 전체의 몇등인지 어떻게 알까?

        log_message('alert', json_encode($Myrankarr));

         
         
         $response = $this->response->setJSON($Myrankarr);
 
         return $response;
    }
}
