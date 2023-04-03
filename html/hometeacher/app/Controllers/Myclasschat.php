<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\MyclassChatlist;
use App\Models\MyclassChatReadChklist;
use CodeIgniter\I18n\Time;
use App\Models\User;

class Myclasschat extends BaseController
{
    public $oMyclassChatlist = "";
    public $oMyclassChatReadChklist = "";
    public $oUser = "";


    public $now = "";
	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');

        $this->oMyclassChatlist = new MyclassChatlist();
        $this->oMyclassChatReadChklist = new MyclassChatReadChklist();
        
        $this->oUser = new User();

    }

    //전체보기
    //검색 조건 : 제목검색, 내용검색, 작성자검색, 게임타입별검색
    //페이징처리 : 페이지 번호에 10개씩 자르기 $query=$builder->get(10, 20);
    //정렬 조건 : 오름차순 내림차순, 필드 이름

    //조인 처리 : uid gid 랭크id 있으면 rankid
    public function chatlist($glimit, $goffset){ //uid만 join
        log_message('alert', "-------chatlist------------".json_encode($_POST)); 
        log_message('alert', "-------chatlist------------".json_encode($_GET)); 
        log_message('alert', "-------glimit------------".json_encode($glimit)); 
        log_message('alert', "-------goffset------------".json_encode($goffset)); 


        //$_POST['uid'] 값이 pid1 pid2에 존재하면 다 가져온다.
        // 상대방의 uid의 프로필 정보를 join해서 가져와서 보여준다. 


        $conditionarr = array();
        $conditionarr["feild"] = "a.idx,a.rid,a.uid,a.type,a.message, a.imgchk,a.regdate,b.usertype,b.email,b.name,b.nicname, c.idx as imgidx, c.basicuri as profilebasicuri, c.src as profilesrc, c.type as profiletype";

        //프로필의 메인 이미지를 하나 가져옴
        $conditionarr["where"]["c.type"]["logic"] = "=";
        $conditionarr["where"]["c.type"]["value"] = 1;
       
        if($_POST['roomidx'] != null){
            $conditionarr["where"]["a.rid"]["logic"] = "=";
            $conditionarr["where"]["a.rid"]["value"] = $_POST['roomidx'];
        }

        $conditionarr["order"]["feild"] = "a.idx";
        $conditionarr["order"]["value"] = "ASC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $classrequestlist = $this->oMyclassChatlist->getlist_join($conditionarr, $pagehandler);
	    
        for($i = 0; $i<count($classrequestlist);$i++){

            //read list를 가져오기 전에  read list에서 요청한 uid 를 삭제해준다.
            $deletecondition = array();
            $deletecondition["where"]["chatidx"] = $classrequestlist[$i]->idx;
            $deletecondition["where"]["rid"] = $_POST['roomidx'];
            $deletecondition["where"]["uid"] = $_POST['uid'];
            $results = $this->oMyclassChatReadChklist->getdelete_condition($deletecondition);


            //read list에서 chatidx로 검색해서 몇개인지 파악할것
            //$readnum = $this->oMyclassChatReadChklist->getlistcount($classrequestlist[$i]->idx);
            //$classrequestlist[$i]->readnum = $readnum[0]->idx;

            //log_message('alert', "------------readnum-----------  ".json_encode($readnum[0]->idx));

            

            //안읽은 uid리스트를 만든다. 

            
            $conditionarr = array();
            //$conditionarr["feild"] = "a.idx,a.rid,a.uid,a.type,a.message, a.imgchk,a.regdate,b.usertype,b.email,b.name,b.nicname, c.idx as imgidx, c.basicuri as profilebasicuri, c.src as profilesrc, c.type as profiletype";

            $conditionarr["where"]["chatidx"]["logic"] = "=";
            $conditionarr["where"]["chatidx"]["value"] = $classrequestlist[$i]->idx;
           
            $conditionarr["order"]["feild"] = "idx";
            $conditionarr["order"]["value"] = "ASC";

            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치                        
            $readlist = $this->oMyclassChatReadChklist->getlist($conditionarr, $pagehandler);

            
            $classrequestlist[$i]->noreadnum = count($readlist);  //안읽은 유저 수

            //안읽은 유저 리스트 만들기
            $noreaduserarr = array();
            for($j = 0; $j<count($readlist);$j++){
                array_push($noreaduserarr, $readlist[$j]->uid);
            }

            $classrequestlist[$i]->noreaduid = $noreaduserarr; //안읽은 유저 리스트 
        }




	    log_message('alert', json_encode($classrequestlist));
	    $response = $this->response->setJSON($classrequestlist);
        

	    return $response;
    }


    //방에 접근 후 정보를 가져올때 사용
    public function classrequestroominfo($glimit, $goffset){
        log_message('alert', "-------classrequestroominfo------------".json_encode($_POST)); 

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
 
         $classrequestinfo = $this->oMyclassChatlist->getlist($conditionarr, $pagehandler);
         
            //pid1, pid2 둘다 정보를 가져와야함. 

             //pid1 유저정보 가져오기 
             $uidinfo = $this->oUser->getdataone($classrequestinfo[0]->pid1);

             log_message('alert', " --------------- userinfo ---------------  ".json_encode($uidinfo));
             log_message('alert', " --------------- userinfo ---------------  ".json_encode($uidinfo[0]->name));
 
             $profileimginfo = $this->oProfileImglist->getdataone($classrequestinfo[0]->pid1);
             log_message('alert', " --------------- userinfoimg ---------------  ".json_encode($profileimginfo));
 
             $classrequestinfo[0]->pid1username = $uidinfo[0]->name;
             $classrequestinfo[0]->pid1usernicname = $uidinfo[0]->nicname;
             $classrequestinfo[0]->pid1usertype = $uidinfo[0]->usertype;
             $classrequestinfo[0]->pid1userimg = $profileimginfo;
 
             //프로필 정보 가져오기
             if($uidinfo[0]->usertype == 1){ //선생
                 $profiledata = $this->oProfileteacher->getdataone($classrequestinfo[0]->pid1);
             }else{ //학생
                 $profiledata = $this->oProfilestudent->getdataone($classrequestinfo[0]->pid1);
             }
             $classrequestinfo[0]->pid1userprofile = $profiledata;



            //pid2 유저정보 가져오기 
             $uidinfo2 = $this->oUser->getdataone($classrequestinfo[0]->pid2);

             log_message('alert', " --------------- userinfo ---------------  ".json_encode($uidinfo2));
             log_message('alert', " --------------- userinfo ---------------  ".json_encode($uidinfo2[0]->name));
 
             $profileimginfo2 = $this->oProfileImglist->getdataone($classrequestinfo[0]->pid2);
             log_message('alert', " --------------- userinfoimg ---------------  ".json_encode($profileimginfo2));
 
             $classrequestinfo[0]->pid2username = $uidinfo2[0]->name;
             $classrequestinfo[0]->pid2usernicname = $uidinfo2[0]->nicname;
             $classrequestinfo[0]->pid2usertype = $uidinfo2[0]->usertype;
             $classrequestinfo[0]->pid2userimg = $profileimginfo2;
 
             //프로필 정보 가져오기
             if($uidinfo2[0]->usertype == 1){ //선생
                 $profiledata2 = $this->oProfileteacher->getdataone($classrequestinfo[0]->pid2);
             }else{ //학생
                 $profiledata2 = $this->oProfilestudent->getdataone($classrequestinfo[0]->pid2);
             }
             $classrequestinfo[0]->pid2userprofile = $profiledata2;


	    log_message('alert', json_encode($classrequestinfo));
	    $response = $this->response->setJSON($classrequestinfo);
        

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

    //과외문의방 생성
    public function makeroom($a,$b){
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 
        //log_message('alert', json_encode($_FILES)); 
        log_message('alert', json_encode($_POST)); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 


        
        
        //post전부 저장 
        if($_POST != null){

            //pid1, pid2로 만든 방이 있는지 체크해서 있으면 만들지 않음.
            $conditionarr = array();
            $conditionarr["where"]["pid1"]["logic"] = "=";
            $conditionarr["where"]["pid1"]["value"] = $_POST['myuid'];
            $conditionarr["where"]["pid2"]["logic"] = "=";
            $conditionarr["where"]["pid2"]["value"] = $_POST['requestuid'];

            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치 

            $roomchk = $this->oMyclassChatlist->getlist($conditionarr, $pagehandler);


            log_message('alert', "과외문의방 정보-----------  ".json_encode($roomchk));  
            log_message('alert', "과외문의방 갯수-----------  ".json_encode(count($roomchk)));  

            //방이 존재하지 않으면 방을 생성함. 
            if(count($roomchk) == 0){ 
                $results = $this->getdatainsert($_POST);
                if($results == 1){

                    //방금 insert한 id 가져오기
                    $resultsid = $this->oMyclassChatlist->getinsertid();
                    log_message('alert', "게시판 응답 getincre  ".$resultsid); 
                    //후에 nid 나오면 img 전부 저장 고고 

                    $response = $this->response->setJSON(['result'  => true,  'err'  => "success",  'roomidx'  => $resultsid]);
                    log_message('alert', "과외문의방 에러사항-----------  ".json_encode(true));  
                }else{
                    $response = $this->response->setJSON(['result'  => false, 'err'  => "no create room",  'roomidx'  => "null"]);
                    log_message('alert', "과외문의방 에러사항-----------  ".json_encode("no create room"));  
                }
            }else{ //방이 존재하면
                $response = $this->response->setJSON(['result'  => false, 'err'  => "exist room",  'roomidx'  => $roomchk[0]->idx]);
                log_message('alert', "과외문의방 에러사항-----------  ".json_encode("exist room"));  
            }
            
            return $response;

        }
    }


    //과외문의방 수정 - 수정바람
    public function editroom($a,$b){
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode($_POST)); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 

        //post전부 저장 
        if($_POST != null){
                $results = $this->getdataupdate($_POST);


            if($results == 1){
                $response = $this->response->setJSON(['result'  => true,  'err'  => "success",  'roomidx'  => $roomchk[0]->idx]);
                log_message('alert', "과외문의방 에러사항-----------  ".json_encode(true));  
            }else{
                $response = $this->response->setJSON(['result'  => false, 'err'  => "no create room",  'roomidx'  => "null"]);
                log_message('alert', "과외문의방 에러사항-----------  ".json_encode("no create room"));  
            }
            
            return $response;
        }
    }

    //데이터 추가
    public function getdatainsert($Data){

        //내가 만든 방 갯수를 체크한다.
        $conditionarr = array();
        $conditionarr["where"]["pid1"]["logic"] = "=";
        $conditionarr["where"]["pid1"]["value"] = $Data['myuid'];
             
        $pagehandler = array();
        $pagehandler["limit"] = 0; //리스트 갯수
        $pagehandler["offset"] = 0; //리스트 위치 
        
        //방을 만든 갯수를 가져와서 닉네임과 합쳐서 방이름을 만들 것. pid1을 기준으로 검색해서 갯수를 가져올 것
        $roomlist = $this->oMyclassChatlist->getlist($conditionarr, $pagehandler);

        $data=array("idx" => '0', 'roomname' => $Data["roomname"]."_".count($roomlist), 'pid1' => $Data["myuid"], 'pid2' => $Data["requestuid"], 'participantnum' => $Data["participantnum"], 'regdate' => $Data["currenttime"]);

        $results = $this->oMyclassChatlist->getinsert($data);

        $results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }

    //데이터 업데이트
    public function getdataupdate($Data){
        
        $fieldname=array(
            //'idx' => $json->gameplayinfo->rankid
            'idx' => $Data["roomidx"]
        );

        //참가자 수를 증가함. 
        if($Data["participantnum"] != null){
            $data=array('participantnum' => $Data["participantnum"]);
        }
        //$data=array("idx" => '150', 'gameidx' => 2, 'title' => 'qqq', 'document' => 'wewe', 'useridx' => '1', 'regdate' => $this->now, 'views' => 0);

        $results = $this->oMyclassChatlist->getupdate($fieldname, $data);
        
       $results = $this->response->setJSON(['result'  => $results]);
       log_message('alert', "과외문의 방 데이터_ ".json_encode($results));

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


    //과외문의방 채팅내용 삭제
    public function deletemsg($a,$b){
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
            $response = $this->oMyclassChatlist->getdelete("rid", $deletelist);
            
            return $response;
        }
    }


    //과외문의방 채팅 읽음체크 삭제
    public function deletemsg_readchk($a,$b){
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode($_POST)); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 

        //post전부 저장 
        if($_POST != null){

            $deletecondition = array();
            $deletecondition["where"]["chatidx"] = $_POST['chatidx'];
            $deletecondition["where"]["rid"] = $_POST['roomidx'];
            $deletecondition["where"]["uid"] = $_POST['uid'];
            $results = $this->oMyclassChatReadChklist->getdelete_condition($deletecondition);


            log_message('alert', json_encode("-------------".$_POST['chatidx']."|".$_POST['uid']." delete data-------------")); 
            return $results;
        }

        
    }


    
    public function imgupload($files, $cid){

        // log_message('alert', json_encode($files)); 
        // log_message('alert', json_encode($files['files'])); 
        // log_message('alert', json_encode($files['files']['tmp_name'])); 
        // log_message('alert', json_encode($files['files']['name'])); 
        // log_message('alert', json_encode($files['files']['type']));  
        // log_message('alert', json_encode($files['files']['size']));  
        // log_message('alert', json_encode($files['files']['error']));  


        $oUpload = new Upload();

        $basicurl = "/image/comment/";

        //다중으로 가져오는 파일 정보 -- 파일 저장, 경로 db에 저장 
        //{"name":"img.png","type":"image\/png","tmp_name":"\/tmp\/phpvquFKq","error":0,"size":4052}
        foreach($files as $key => $value){
            log_message('alert', json_encode($value));  

            //        // var filename = joincode+uid+pid+"_"+year+month+day+getHours+getMinutes+getSeconds+getMilliseconds+".mp4";
            //nid 저장
            //파일명 생성해서 넘기기

            $filename = $oUpload->upload($value, $basicurl); //이미지 업로드

            log_message('alert', "img 경로".json_encode($filename));  


            $imgdata=array('basicuri' => $basicurl, 'src' => $filename);

            //이미지 경로 db 저장
            //getinsert
            $reslut = $this->oCommentlist->getupdate($cid, $imgdata);

            log_message('alert', "img result".json_encode($reslut));  
        }
        
    }

    

    public function onlyimgupload($a, $b){

        log_message('alert', "----------------chat-------------".json_encode($_FILES)); 
        
        $oUpload = new Upload();

        $basicurl = "/image/myclass/";

        //다중으로 가져오는 파일 정보 -- 파일 저장, 경로 db에 저장 
        //{"name":"img.png","type":"image\/png","tmp_name":"\/tmp\/phpvquFKq","error":0,"size":4052}
        foreach($_FILES as $key => $value){
            log_message('alert', json_encode($value));  

            // var filename = joincode+uid+pid+"_"+year+month+day+getHours+getMinutes+getSeconds+getMilliseconds+".mp4";
            //nid 저장
            //파일명 생성해서 넘기기

            $filename = $oUpload->upload($value, $basicurl); //이미지 업로드

            log_message('alert', "img 경로".json_encode($filename));  


           // $imgdata=array('basicuri' => $basicurl, 'src' => $filename);

            //이미지 경로 db 저장
            //getinsert
            //$reslut = $this->oCommentlist->getupdate($cid, $imgdata);

           // log_message('alert', "img result".json_encode($filename));  

            $results = $this->response->setJSON(['result'  => $basicurl.$filename]);
            return $results; 
        }
    }
}
