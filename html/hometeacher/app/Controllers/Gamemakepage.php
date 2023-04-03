<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Gamelist;
use CodeIgniter\I18n\Time;
class Gamemakepage extends BaseController
{
    public $oGamelist = "";
    public $now = "";
	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');
        $this->oGamelist = new Gamelist();

        //Gamelist   
    }
    public function getgamedata($glimit, $goffset){
        log_message('alert', json_encode("!!!!!game getlist !!!!!")); 
        log_message('alert', json_encode($_POST)); //$_POST['gamejstext']
        //{"fieldname":"a.uid","fieldlogic":"=","fieldval":"2"}
        $data = $_POST;
        //log_message('alert', json_encode(count($json)));

        $conditionarr = array();
        $conditionarr["feild"] = "a.idx,a.uid,a.pkey,a.name,a.info,a.writecode,a.thumimg,a.display,a.regdate,b.name as bname";


        //key로 보내온 경우 key값으로 idx 구해오기 
        if($data['fieldname'] == "pkey"){
            $dataone = $this->oGamelist->getdataone($data['fieldval']);
        
            log_message('alert', json_encode($dataone));
            log_message('alert', json_encode($dataone[0]));
            log_message('alert', json_encode($dataone[0]->idx));
        
            $conditionarr["where"]["a.idx"]["logic"] = $data['fieldlogic'];
            $conditionarr["where"]["a.idx"]["value"] = $dataone[0]->idx;
        
        
        }else{
            if($data != null){
                if(count($data) > 0){
                    foreach($data as $key => $value){
    
                        $conditionarr["where"][$data['fieldname']]["logic"] = $data['fieldlogic'];
                        $conditionarr["where"][$data['fieldname']]["value"] = $data['fieldval'];
                    }
                }
            }
        }
        $conditionarr["order"]["feild"] = "a.idx";
        $conditionarr["order"]["value"] = "ASC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $results = $this->oGamelist->getlist($conditionarr, $pagehandler);
	    
	    log_message('alert', json_encode($results));
	    $response = $this->response->setJSON($results);

	    return $response;
    }


    //데이터 삭제
    public function getdatadelete(){
        $json=json_decode(file_get_contents('php://input'));
        $json=$json->data;

        log_message('alert', "game delete list");
        log_message('alert', json_encode($json));

        $results = $this->oGamelist->getdelete($json->fieldname, $json->checklist);

        $results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }


    //데이터 추가
    public function getdatainsert($Data, $imgurl){
        //$json=json_decode(file_get_contents('php://input'));
        //$json=$json->data;


        //log_message('alert', "게시판 데이터_ ".json_encode($json));
        log_message('alert', "게시판 데이터 ".json_encode($Data["gtype"]));
        log_message('alert', "게시판 데이터 ".json_encode($Data["rankid"]));
        log_message('alert', "게시판 데이터 ".json_encode($Data["uid"]));
        log_message('alert', "게시판 데이터 ".json_encode($Data["score"]));
        log_message('alert', "게시판 데이터 ".json_encode($Data["title"]));
        log_message('alert', "게시판 데이터 ".json_encode($Data["documenttext"]));


        if($Data["display"] == "true"){
                
            log_message('alert', "게시판 데이터_ display 1");
            $display = 1;
        }else{
            log_message('alert', "게시판 데이터_ display 0");
            $display = 0;
        }
        
        $data=array('idx' => '0', 'uid' => $Data["uid"], 'pkey' => $Data["pkey"], 'name' => $Data["name"], 'info' => $Data["info"], 'writecode' => $Data["writecode"], 'thumimg' => $imgurl, 'display' => $display, 'regdate' => $this->now);


        log_message('alert', "게시판 데이터 ".json_encode($data));
        
        $results = $this->oGamelist->getinsert($data);

        //$results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }

    //데이터 업데이트
    //ALERT - 2022-05-07 02:55:50 --> {"gtype":"1","pcode":"254","ntype":"2","uid":"2","title":"qwewqe","documenttext":"qweqweqwe","deletelist":"13,12"}

    public function getdataupdate($Data, $imgurl){

        log_message('alert', "게시판 데이터_ ".json_encode($Data));

        $fieldname=array(
            'idx' => $Data["pcode"]
        );

        if($imgurl == ""){
            log_message('alert', "게시판 데이터_ ".json_encode($Data["display"]));

            if($Data["display"] == "true"){
                
                log_message('alert', "게시판 데이터_ display 1");
                $display = 1;
            }else{
                log_message('alert', "게시판 데이터_ display 0");
                $display = 0;
            }
            
            $data=array('uid' => $Data["uid"], 'pkey' => $Data["pkey"], 'name' => $Data["name"], 'info' => $Data["info"], 'writecode' => $Data["writecode"], 'display' => $display, 'regdate' => $this->now);
        }else{
            $data=array('uid' => $Data["uid"], 'pkey' => $Data["pkey"], 'name' => $Data["name"], 'info' => $Data["info"], 'writecode' => $Data["writecode"], 'thumimg' => $imgurl, 'display' => $display, 'regdate' => $this->now);
        }


        $results = $this->oGamelist->getupdate($fieldname, $data);
        
      // $results = $this->response->setJSON(['result'  => $results]);
      // log_message('alert', "게시판 데이터_ ".json_encode($results));

        return $results; 
    }

    //이미지 글 formdata로 가져와서 저장함
    public function gamesavebox(){
        log_message('alert', json_encode($_FILES)); 
        log_message('alert', json_encode($_POST)); 

        //pkey  $_POST['pkey']; 중복체크할 것
        //$overlabchk = $this->oGamelist->getoverlapchk($_POST['pkey']);
            
            if($_FILES != null){
                $filename = $this->imgupload($_FILES);

                log_message('alert', "게시판 응답 getincre  ".$fileresult); 

                //post전부 저장 
                if($filename != null){   
                    if($_POST != null){
                        $imgurl = "/image/gamelist/".$filename;
                        $results = $this->getdatainsert($_POST, $imgurl);

                    }
                }
            }
            
	    $results = $this->response->setJSON(['result'  => $results]);

	    return $results;

    }
    //이미지 글 formdata로 가져와서 업데이트
    // - 이미지는 삭제할 데이터 삭제, 이미지 추가할 데이터 추가, 텍스트 업데이트
    public function gameupdatebox(){
        log_message('alert', json_encode($_FILES)); 
        log_message('alert', json_encode($_POST)); 
       // log_message('alert', json_encode($_POST['deletelist'])); 


       //pkey  $_POST['pkey']; 중복체크할 것

        if($_FILES != null){
            $filename = $this->imgupload($_FILES);
            log_message('alert', "게시판 응답 getincre  ".$filename); 
            $imgurl = "/image/gamelist/".$filename;
        }else{
            $imgurl = "";
        }
           
        //이미지 파일 저장후 가져오는 파일 이름을 넣어줘야함.
        //post전부 저장 
        if($_POST != null){
            log_message('alert', json_encode($imgurl)); 
            $results = $this->getdataupdate($_POST, $imgurl);
        } 

        log_message('alert', json_encode($results)); 

        $results = $this->response->setJSON(['result'  => $results]);
	    return $results;
    }


    public function imgupload($files){
        
        log_message('alert', json_encode($files)); 
        log_message('alert', json_encode($files['files'])); 
        log_message('alert', json_encode($files['files']['tmp_name'])); 
        log_message('alert', json_encode($files['files']['name'])); 
        log_message('alert', json_encode($files['files']['type']));  
        log_message('alert', json_encode($files['files']['size']));  
        log_message('alert', json_encode($files['files']['error']));  

        $oUpload = new Upload();

        $basicurl = "/image/gamelist/";

        //다중으로 가져오는 파일 정보 -- 파일 저장, 경로 db에 저장 
        //{"name":"img.png","type":"image\/png","tmp_name":"\/tmp\/phpvquFKq","error":0,"size":4052}
        foreach($files as $key => $value){
            log_message('alert', json_encode($value));  

            $filename = $oUpload->upload($value, $basicurl); //이미지 업로드

            log_message('alert', "img 경로".json_encode($filename));  
        }

        return $filename;
        
    }

    //중복체크
    public function overlabchk(){
        log_message('alert', "중복체크 ".json_encode($_POST));  


        $overlabreturn = $this->oGamelist->getoverlapchk($_POST['pkey']);
        log_message('alert', "중복체크 ".json_encode($overlabreturn));  

        $results = $this->response->setJSON(['result'  => $overlabreturn]);
        return $results;
    }

        // //파일생성하여 코드 저장하기. - 폴더 파일 저장 필요 없음
        // public function gamesavebox(){
        //     //log_message('alert', json_encode($_FILES)); 
        //     log_message('alert', json_encode("!!!!!게임 저장하자")); 
        //     log_message('alert', json_encode($_POST)); 
        //     //{"gametext":"\u314e\u314e\u314e\u314e"}
        //     log_message('alert', json_encode($_POST['gamejstext'])); 
        //     log_message('alert', json_encode($_POST['gamehtmltext'])); 
    
        //     //폴더 생성
        //     $path = "./fileupload/".$_POST['title'];
        //     $permit = 0777;
        //     if (!is_dir($path)) {
        //         mkdir($path, $permit, true);
        //         chmod($path, $permit);
        //     }else{
        //         chmod($path, $permit);
        //     }
    
    
    
        //     //파일 생성
        //     $myfilejs = fopen($path."/".$_POST['title'].".js", "w");
        //     $myfilehtml = fopen($path."/".$_POST['title'].".html", "w");
    
        //     //내용 입력
        //     $jstxt = $_POST['gamejstext'];
        //     $htmltxt = $_POST['gamehtmltext'];
        //     fwrite($myfilejs, $jstxt);
        //     fwrite($myfilehtml, $htmltxt);
        //     fclose($myfilejs);
        //     fclose($myfilehtml);
    
    
        //     //게임 db 생성
        //     //폴더에 게임 스크립트 들어가
        // }
    
        // //폴더에서 불러오기  - 폴더 파일 저장 필요 없음
        // public function getgameinfo(){
            
        //     log_message('alert', "!!!!!"); 
        //     log_message('alert', json_encode($_POST['title'])); 
    
        //     //폴더 떠오기
        //     $jspath = "./fileupload/".$_POST['title']."/".$_POST['title'].".js";
        //     $htmlpath = "./fileupload/".$_POST['title']."/".$_POST['title'].".html";
    
        //     $docjs = file($jspath);
        //     $doc_datajs = implode("", $docjs);
        //     log_message('alert', json_encode($doc_datajs)); 
        //     $doc_datajsarr = array($doc_datajs);
    
    
        //     $dochtml = file($htmlpath);
        //     $doc_datahtml = implode("", $dochtml);
        //     log_message('alert', json_encode($doc_datahtml)); 
        //     $doc_datahtmlarr = array($doc_datahtml);
    
        //     //"<div>game1<\/div>\r\n<div>game2<\/div>\r\n<div>game3<\/div>"
        //    // $response = $this->response->setJSON($doc_data);
        //     log_message('alert', json_encode($doc_data)); 
        //     log_message('alert', json_encode($doc_dataarr)); 
    
    
        //     $Totalarr = array();
        //     array_push($Totalarr, $doc_datajsarr);
        //     array_push($Totalarr, $doc_datahtmlarr);
            
        //     $response = $this->response->setJSON($Totalarr);
            
        //     return $response;
    
        // }

}
