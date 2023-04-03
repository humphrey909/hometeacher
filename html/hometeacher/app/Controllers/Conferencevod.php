<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Conferencevodlist;
use App\Models\MyclassRoomlistset;
use CodeIgniter\I18n\Time;
use App\Models\User;

class Conferencevod extends BaseController
{
    public $oConferencevodlist = "";
    public $oUser = "";

    public $now = "";
	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');

        $this->oConferencevodlist = new Conferencevodlist();
        $this->oUser = new User();

    }


    
    public function vodlist($glimit, $goffset){ //uid만 join
        log_message('alert', "-------ClassRequest------------".json_encode($_POST)); 
        log_message('alert', "-------ClassRequest------------".json_encode($_GET)); 
        log_message('alert', "-------ClassRequest------------".json_encode($glimit)); 
        log_message('alert', "-------ClassRequest------------".json_encode($goffset)); 

        $conditionarr = array();
        //$conditionarr["feild"] = "a.idx,a.uid,a.rid,a.rtcuid,a.regdate,b.usertype,b.email,b.name,b.nicname, c.idx as imgidx, c.basicuri, c.src, c.type";
        
        
        $conditionarr["where"]["rid"]["logic"] = "=";
        $conditionarr["where"]["rid"]["value"] = $_POST['rid']; //방 idx

        // $conditionarr["where"]["a.rtcuid"]["logic"] = "=";
        // $conditionarr["where"]["a.rtcuid"]["value"] = $_POST['rtcuid']; //rtc uid


        // $conditionarr["where"]["c.type"]["logic"] = "=";
        // $conditionarr["where"]["c.type"]["value"] = '1'; //유저프로필 메인 이미지



        $conditionarr["order"]["feild"] = "idx";
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $vodlist = $this->oConferencevodlist->getlist($conditionarr, $pagehandler);
	    
       

	    
        log_message('alert', "-------total vodlist------------".json_encode($vodlist)); 
	    $response = $this->response->setJSON($vodlist);
        

	    return $response;
    }


    //방에 접근 후 정보를 가져올때 사용
    public function myclassroominfo($glimit, $goffset){
        log_message('alert', "-------myclassinfo------------".json_encode($_POST)); 

        $conditionarr = array();

        if($_POST['roomidx'] != null){
            $conditionarr["where"]["idx"]["logic"] = "=";
            $conditionarr["where"]["idx"]["value"] = $_POST['roomidx'];
        }
 
         $conditionarr["order"]["feild"] = "idx";
         $conditionarr["order"]["value"] = "DESC";
 
         $pagehandler = array();
         $pagehandler["limit"] = $glimit; //리스트 갯수
         $pagehandler["offset"] = $goffset; //리스트 위치 
 
         log_message('alert', "55555555555555  ".json_encode($conditionarr));
 
        $myclassinfo = $this->oMyclassRoomlist->getlist($conditionarr, $pagehandler);
         
        for($i = 0; $i<count($myclassinfo);$i++){

            //채팅방 참여 유저리스트에 유저정보를 추가함. + 프로필 메인 이미지를 추가, 
            $conditionarr = array();
            $conditionarr["feild"] = "a.idx,a.rid,a.uid,a.type,a.invitechk,a.regdate,b.usertype,b.email,b.name, b.nicname, c.idx as imgidx, c.basicuri as profilebasicuri, c.src as profilesrc, c.type as profiletype";

            //프로필의 메인 이미지를 하나 가져옴
            $conditionarr["where"]["c.type"]["logic"] = "=";
            $conditionarr["where"]["c.type"]["value"] = 1;
        
            //room idx 
            $conditionarr["where"]["a.rid"]["logic"] = "=";
            $conditionarr["where"]["a.rid"]["value"] = $myclassinfo[$i]->idx;
     
            $conditionarr["order"]["feild"] = "type";
            $conditionarr["order"]["value"] = "DESC";
     
            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치 

            $userlist = $this->oMyclassUserlist->getlist_join_user($conditionarr, $pagehandler);

            $myclassinfo[$i]->userlist = $userlist;


            //내가 작성한 리뷰 갯수 가져오기
            $conditionarr = array();

            $conditionarr["where"]["rid"]["logic"] = "=";
            $conditionarr["where"]["rid"]["value"] = $_POST['roomidx']; 
            //$conditionarr["where"]["teacheruid"]["logic"] = "=";
            //$conditionarr["where"]["teacheruid"]["value"] = $_POST['teacheruid']; 
            $conditionarr["where"]["writeuid"]["logic"] = "=";
            $conditionarr["where"]["writeuid"]["value"] = $_POST['writeuid']; //내 uid
    
            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치 
    
            $reviewlist = $this->oUserReviewlist->getlist($conditionarr, $pagehandler);

            $myclassinfo[$i]->reviewcount = count($reviewlist);



            //백그라운드 배경색, 방 이미지 가져오기 
            $conditionarr = array();
            $conditionarr["where"]["rid"]["logic"] = "=";
            $conditionarr["where"]["rid"]["value"] = $myclassinfo[$i]->idx;
            $conditionarr["where"]["uid"]["logic"] = "=";
            $conditionarr["where"]["uid"]["value"] = $_POST['writeuid']; //내 uid

            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치  

            //이미 조인 된 상태의 class에서 조인 안한 값을 가져오려고 하니 가져오지 못함. 그래서 새로 class를 생성해서 갯수만 가져오도록 함.
            //$oMyclassUserlist_ = new MyclassUserlist();
            $myclasslist_ = $this->oMyclassRoomlistset->getlist($conditionarr, $pagehandler);
            if(!empty($myclasslist_)){
                $myclassinfo[$i]->myclass_setinfo = $myclasslist_;
            }else{
                $myclassinfo[$i]->myclass_setinfo = 'null';
            }
        }

	    log_message('alert', json_encode($myclassinfo));
	    $response = $this->response->setJSON($myclassinfo);
        

	    return $response;
    }
    
    //과외방 세팅에서 정보를 가져올때 사용
    public function myclassroominfo_set(){
        log_message('alert', "-------myclassinfo------------".json_encode($_POST)); 

        $conditionarr = array();

        if($_POST['roomidx'] != null){
            $conditionarr["where"]["idx"]["logic"] = "=";
            $conditionarr["where"]["idx"]["value"] = $_POST['roomidx'];
        }
 
         $conditionarr["order"]["feild"] = "idx";
         $conditionarr["order"]["value"] = "DESC";
 
         $pagehandler = array();
         $pagehandler["limit"] = 0; //리스트 갯수
         $pagehandler["offset"] = 0; //리스트 위치 
 
         log_message('alert', "55555555555555  ".json_encode($conditionarr));
 
         $myclassinfo = $this->oMyclassRoomlist->getlist($conditionarr, $pagehandler);
         

         for($i = 0; $i<count($myclassinfo);$i++){
            //백그라운드 배경색, 방 이미지 가져오기 
            $conditionarr = array();
            $conditionarr["where"]["rid"]["logic"] = "=";
            $conditionarr["where"]["rid"]["value"] = $myclassinfo[$i]->idx;
            $conditionarr["where"]["uid"]["logic"] = "=";
            $conditionarr["where"]["uid"]["value"] = $_POST['myuid']; //내 uid

            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치  

            //이미 조인 된 상태의 class에서 조인 안한 값을 가져오려고 하니 가져오지 못함. 그래서 새로 class를 생성해서 갯수만 가져오도록 함.
            //$oMyclassUserlist_ = new MyclassUserlist();
            $myclasslist_ = $this->oMyclassRoomlistset->getlist($conditionarr, $pagehandler);
            if(!empty($myclasslist_)){
                $myclassinfo[$i]->myclass_setinfo = $myclasslist_;
            }else{
                $myclassinfo[$i]->myclass_setinfo = 'null';
            }
         }


         log_message('alert', json_encode($myclassinfo));
         $response = $this->response->setJSON($myclassinfo);
         
 
         return $response;
    }

    //내 게시글 보기에서 확인하는 리스트
    //댓글 대댓글 합치기, 해당 게시글 내용 합치기 
    public function commentlist_mypage($glimit, $goffset){
        log_message('alert', "-------comment------------".json_encode($_POST)); 
        log_message('alert', "-------comment------------".json_encode($_GET)); 
        log_message('alert', "-------comment------------".json_encode($glimit)); 
        log_message('alert', "-------comment------------".json_encode($goffset)); 


        //----댓글 생성
        $conditionarr = array();
        $conditionarr["feild"] = "a.idx,a.nid,a.uid,a.basicuri,a.src,a.document,a.regdate,b.usertype,b.email,b.name,b.nicname, c.maincategorey, c.subcategorey, c.title, c.document as ndocument";
        
        //유저 고유번호
        if($_POST['uid'] != null){
            $conditionarr["where"]["a.uid"]["logic"] = "=";
            $conditionarr["where"]["a.uid"]["value"] = $_POST['uid'];
        }


        $conditionarr["order"]["feild"] = "a.regdate";
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $commentlist = $this->oCommentlist->getlist_join_mypage($conditionarr, $pagehandler);




       // for($i = 0; $i<count($commentlist);$i++){
        //    $commentlist[$i]->commenttype = 1;
            //대댓글 가져오기
        
            // //댓글 갯수 
            // $conditionarr = array();

            // $conditionarr["where"]["nid"]["logic"] = "=";
            // $conditionarr["where"]["nid"]["value"] = $commentlist[$i]->nid;
            // $conditionarr["where"]["cid"]["logic"] = "=";
            // $conditionarr["where"]["cid"]["value"] = $commentlist[$i]->idx;

            // $pagehandler = array();
            // $pagehandler["limit"] = 0; //리스트 갯수
            // $pagehandler["offset"] = 0; //리스트 위치 
            // $commentnestedinfo = $this->oCommentlistNested->getlist($conditionarr, $pagehandler);
            // log_message('alert', "대댓글 데이터 ".json_encode($commentnestedinfo));
        
            // if(!empty($commentnestedinfo)){ //like 리스트가 있을때만 푸쉬함
            //     $commentlist[$i]->commentnestedtotalnum = count($commentnestedinfo);
            //  }else{
            //     $commentlist[$i]->commentnestedtotalnum = 0;
            // }

            // //좋아요 수 
            // $conditionarr3 = array();
            // $conditionarr3["where"]["getcid"]["logic"] = "=";
            // $conditionarr3["where"]["getcid"]["value"] = $commentlist[$i]->idx;

            // $pagehandler3 = array();
            // $pagehandler3["limit"] = 0; //리스트 갯수
            // $pagehandler3["offset"] = 0; //리스트 위치 
            // $commentlikenum = $this->oLikecommentlist->getlist($conditionarr3, $pagehandler3);
            // log_message('alert', "댓글 좋아요 갯수 ".json_encode($commentlikenum));
        
            // if(!empty($commentlikenum)){ //like 리스트가 있을때만 푸쉬함
            //     $commentlist[$i]->commentliketotalnum = count($commentlikenum);
            //  }else{
            //     $commentlist[$i]->commentliketotalnum = 0;
            // }
       // }


      
    //    log_message('alert', "commentlist-----------  ".json_encode($commentlist));  

    
    //    //----대댓글 생성

    //    $conditionarr = array();
    //    $conditionarr["feild"] = "a.idx,a.nid,a.cid,a.uid,a.basicuri,a.src,a.document,a.regdate,b.usertype,b.email,b.name,b.nicname, c.maincategorey, c.subcategorey, c.title, c.document as ndocument";
       
    //    //유저 고유번호
    //    if($_POST['uid'] != null){
    //        $conditionarr["where"]["a.uid"]["logic"] = "=";
    //        $conditionarr["where"]["a.uid"]["value"] = $_POST['uid'];
    //    }


    //    $conditionarr["order"]["feild"] = "a.regdate";
    //    $conditionarr["order"]["value"] = "DESC";

    //    $pagehandler = array();
    //    $pagehandler["limit"] = $glimit; //리스트 갯수
    //    $pagehandler["offset"] = $goffset; //리스트 위치 

    //    log_message('alert', "55555555555555  ".json_encode($conditionarr));

    //    $commentnestedlist = $this->oCommentlistNested->getlist_join_mypage($conditionarr, $pagehandler);
    //    for($i = 0; $i<count($commentnestedlist);$i++){
    //     $commentnestedlist[$i]->commenttype = 2;
        
    //     //log_message('alert', "commentnestedlist-----------  ".json_encode($commentnestedlist[$i]));

    //     //댓글과 대댓글 합치기 !!!!
    //     $commentlist[count($commentnestedlist)-1+$i] = $commentnestedlist[$i];
    //    }
       

        log_message('alert', "commentlist-----------  ".json_encode($commentlist));  

	    $response = $this->response->setJSON($commentlist);
        
	    return $response;
    }
    
    //검색용 데이터 수집
    public function getdatasearch($condid, $condval){

        //조건이 여러개면? 
        log_message('alert', $condid);
        log_message('alert', $condval);
        //$conditionarray = array($condid => $condval);
        $conditionarray = array("condid" => $condid, "condval" => $condval);

        $limit = 0; //리스트 갯수
        $offset = 0; //리스트 위치 
        $results = $this->oNboardlist->getlistone($conditionarray, $limit, $offset);
	    
	    log_message('alert', json_encode($results));
	    $response = $this->response->setJSON($results);

	    return $response;
    }
    
    //info 검색 처리 : ntype으로 조절
    public function getdatainfoone(){
        $json=json_decode(file_get_contents('php://input'));
        $json=$json->data;

        log_message('alert', json_encode($json));

        $conditionarr = array();
        if($json->ntype == '3'){//자랑 - 랭크 아이디 조인 필수
            $conditionarr["feild"] = "a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info, d.score";
        }else{ //공략 및 잡담
            $conditionarr["feild"] = "a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info";
        }

        $conditionarr["where"]["a.idx"]["logic"] = "=";
        $conditionarr["where"]["a.idx"]["value"] = $json->idx;

        $pagehandler = array();

        //$json->ntype 으로 구분한다. 1일때는 랭크없이 join, 3일때는 rank 같이 join
        //자랑일때 수정으로 rankid를 join하지 않는다. 
        $results = $this->oNboardlist->getlistinfoone($conditionarr, $pagehandler, $json->ntype);
	    
	    log_message('alert', json_encode($results));
	    $response = $this->response->setJSON($results);

	    return $response;
    }

    //전체 갯수
    public function getdatacount(){
        $results = $this->oNboardlist->getlistcount();
	    
	   // log_message('alert', json_encode($results));
	    $response = $this->response->setJSON($results);

	    return $response; 
    }

    //vod를 추가한다. 
    public function savebox($a,$b){
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------"));
        log_message('alert', json_encode($_POST)); 
        log_message('alert', json_encode($_FILES)); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 
        
        if($_FILES != null){
            $fileresult = $this->imgupload($_FILES, $_POST);

            log_message('alert', "vod를 추가 getincre  ".$fileresult); 
        }
    }

    //과외방 - 문의방 여러개 생성 : 과외방에서 유저를 추가할시 여기서 방을 등록 함. 유저 추가
    public function makeroom_adduser($a,$b){
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------"));
        log_message('alert', json_encode($_POST)); 
        log_message('alert', json_encode($_POST['userlist'])); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 


        //과외문의 방 rid 고유값 
         $roomidxarr = array();

        //유저리스트를 저장한다. 
        if($_POST['userlist'] != null){
            $userlist_arr = json_decode($_POST['userlist'], true);
            for($j = 0; $j<count($userlist_arr);$j++){
                log_message('alert', json_encode($userlist_arr[$j])); 

                //유저 저장
                $data=array("idx" => '0', 'rid' => $_POST['rid_myclass'], 'uid' => $userlist_arr[$j], 'type' => 0, 'invitechk' => 2, 'regdate' => $_POST["currenttime"]);
                $results = $this->oMyclassUserlist->getinsert($data);



                //문의 방을 생성한다. (초대기능)
                //해당 문의방이 있는지 체크한다. 두 uid가 속한 방이 있는지 체크해야함. 18 31 
                //$_POST['myuid'] //내 id
                //$userlist_arr[$j] //상대 id

                // $conditionarr = array();
                // $conditionarr[$this->oClassRequestRoomlist->FIXWHEREVAL] = " WHERE (pid1 = '".$_POST['myuid']."' || pid2 = '".$_POST['myuid']."') && (pid1 = '".$userlist_arr[$j]."' || pid2 = '".$userlist_arr[$j]."')";
                                
                // $pagehandler = array();
                // $pagehandler["limit"] = 0; //리스트 갯수
                // $pagehandler["offset"] = 0; //리스트 위치 
                // $requestroom = $this->oClassRequestRoomlist->getlist($conditionarr, $pagehandler);

                // //이미 만들어진 방이 있다는 것. - 방 고유값 을 array로 만든다.
                // if(count($requestroom) > 0){

                //     $requestroominfo = array();
                //     $requestroominfo["makechk"] = 0; //방생성 x
                //     $requestroominfo["requestrid"] = $requestroom[0]->idx;
                //     array_push($roomidxarr, $requestroominfo);
                                
                // }else{ //방없음 -> 방 생성
                //     $data_=array("idx" => '0', 'pid1' => $_POST["myuid"], 'pid1out' => 0, 'pid2' => $userlist_arr[$j], 'pid2out' => 0, 'participantnum' => 2, 'regdate' => $_POST["currenttime"]);
                //     $results = $this->oClassRequestRoomlist->getinsert($data_);
                //     if($results == 1){
                //         //방금 insert한 id 가져오기
                //         $resultsid_requestclass = strval($this->oClassRequestRoomlist->getinsertid());
                //         //array_push($roomidxarr, $resultsid_requestclass);

                //         $requestroominfo = array();
                //         $requestroominfo["makechk"] = 1; //방생성 o
                //         $requestroominfo["requestrid"] = $resultsid_requestclass;
                //         array_push($roomidxarr, $requestroominfo);
                //     }
                // }

            }
            //리턴값으로 방 고유값을 알아야 소켓에 방을 만들어 줄 수 잇따. 
        } 

        //$response = $this->response->setJSON(['result'  => true,  'err'  => "success",  'myclassroomidx'  => $_POST['rid_myclass'], 'requestroomidxarr'  => $roomidxarr]);
        $response = $this->response->setJSON(['result'  => true,  'err'  => "success",  'myclassroomidx'  => $_POST['rid_myclass'],  'userlist'  => $_POST['userlist']]);
        log_message('alert', "내과외방 에러사항-----------  ".json_encode(true));  
        
        return $response;
    }


    //과외문의방 삭제
    public function deleteroom($a,$b){
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode($_POST)); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 

        //post전부 저장 
        if($_POST != null){

            //방 삭제
            $deletelist = array();
            $deletelist[0] = $_POST['roomidx'];
            //log_message('alert', "-----getdatadelete-----".json_encode($deletelist));
            $response = $this->oMyclassRoomlist->getdelete("idx", $deletelist);
            
            return $response;
        }
    }


    //데이터 추가
    public function getdatainsert($Data){

        $data=array("idx" => '0', 'uid' => $Data["uid"], 'rid' => $Data["rid"], 'rtcuid' => $Data["rtcuid"], 'regdate' => $Data["currenttime"]);

        $results = $this->oConferencejoinuserlist->getinsert($data);

        $results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }

    //데이터 업데이트
    public function getdataupdate($Data, $joinidx){
        
        $fieldname=array(
            'idx' => $joinidx
        );

        $data=array('rid' => $Data["rid"], 'rtcuid' => $Data["rtcuid"], 'regdate' => $Data["currenttime"]);

        $results = $this->oConferencejoinuserlist->getupdate($fieldname, $data);
        
        $results = $this->response->setJSON(['result'  => $results]);
        log_message('alert', "회의 참여자 데이터_ ".json_encode($results));

        return $results; 
    }

    public function getdataupdate_each(){
        $json=json_decode(file_get_contents('php://input'));
        $json=$json->data;
        log_message('alert', "댓글 데이터_update ".json_encode($json));

        //패스워드가 있는경우 패스워드 확인작업 들어간다. 
        if($json->password != null){ //비회원
           // $json->idx 의 $json->password가 맞는지 확인한다. 
           $chkdata = $this->oCommentlist->Chkpassword($json->idx, $json->password);

           log_message('alert', "댓글 데이터_패스워드 확인 ".json_encode($chkdata)); //true false로 확인
           $results = $chkdata;

            //true 일때만 저장 처리함. false면 저장하지 않고 false를 뱃음
            if($results == true){
                $fieldname=array(
                    'idx' => $json->idx
                );
                $data=array('document' => $json->document);
        
                $results = $this->oCommentlist->getupdate($fieldname, $data);
            }

        }else{ //회원
            $fieldname=array(
                //'idx' => $json->gameplayinfo->rankid
                'idx' => $json->idx
            );
            $data=array('document' => $json->document);
    
            $results = $this->oCommentlist->getupdate($fieldname, $data);

        }
        $results = $this->response->setJSON(['result'  => $results]);
        log_message('alert', "댓글 데이터_ ".json_encode($results));
 
         return $results; 
     }
    
    public function imgupload($files, $Data){

        // log_message('alert', json_encode($files)); 
        // log_message('alert', json_encode($files['files'])); 
        // log_message('alert', json_encode($files['files']['tmp_name'])); 
        // log_message('alert', json_encode($files['files']['name'])); 
        // log_message('alert', json_encode($files['files']['type']));  
        // log_message('alert', json_encode($files['files']['size']));  
        // log_message('alert', json_encode($files['files']['error']));  


        $oUpload = new Upload();

        $basicurl = "/video/conferencevod/";

        //다중으로 가져오는 파일 정보 -- 파일 저장, 경로 db에 저장 
        //{"name":"img.png","type":"image\/png","tmp_name":"\/tmp\/phpvquFKq","error":0,"size":4052}
        foreach($files as $key => $value){
            log_message('alert', json_encode($value));  

            //        // var filename = joincode+uid+pid+"_"+year+month+day+getHours+getMinutes+getSeconds+getMilliseconds+".mp4";
            //nid 저장
            //파일명 생성해서 넘기기

            $filename = $oUpload->upload($value, $basicurl); //이미지 업로드

            log_message('alert', "img 경로".json_encode($filename));  


           // $imgdata=array('basicuri' => $basicurl, 'src' => $filename);
            $imgdata=array("idx" => '0', 'uid' => $Data['uid'], 'rid' => $Data['rid'], 'basicuri' => $basicurl, 'src' => $filename, 'regdate' => $Data["currenttime"]);

            //이미지 경로 db 저장
            //getinsert
            $reslut = $this->oConferencevodlist->getinsert($imgdata);

            log_message('alert', "img result".json_encode($reslut));  
        }
        
    }

}
