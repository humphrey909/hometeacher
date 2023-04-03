<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ClassRequestRoomlist;
use App\Models\ClassRequestChatlist;
use App\Models\ClassRequestChatReadChklist;
use CodeIgniter\I18n\Time;
use App\Models\User;
use App\Models\ProfileImglist;
use App\Models\ProfileTeacher;
use App\Models\ProfileStudent;
class Classrequestroom extends BaseController
{
    public $oClassRequestRoomlist = "";
    public $oClassRequestChatlist = "";
    public $oUser = "";
    public $oProfileImglist = "";
    public $oProfileteacher = "";
    public $oProfilestudent = "";

    public $oClassRequestChatreadchklist = "";

    public $now = "";
	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');

        $this->oClassRequestRoomlist = new ClassRequestRoomlist();
        $this->oClassRequestChatlist = new ClassRequestChatlist();
        $this->oUser = new User();
        $this->oProfileImglist = new ProfileImglist();
        $this->oProfileteacher = new ProfileTeacher();
        $this->oProfilestudent = new ProfileStudent();

        $this->oClassRequestChatreadchklist = new ClassRequestChatreadchklist();
    }

    //전체보기
    //검색 조건 : 제목검색, 내용검색, 작성자검색, 게임타입별검색
    //페이징처리 : 페이지 번호에 10개씩 자르기 $query=$builder->get(10, 20);
    //정렬 조건 : 오름차순 내림차순, 필드 이름

    //조인 처리 : uid gid 랭크id 있으면 rankid
    public function roomlist($glimit, $goffset){ //uid만 join
        log_message('alert', "-------ClassRequest------------".json_encode($_POST)); 
        log_message('alert', "-------ClassRequest------------".json_encode($_GET)); 
        log_message('alert', "-------ClassRequest------------".json_encode($glimit)); 
        log_message('alert', "-------ClassRequest------------".json_encode($goffset)); 


        //$_POST['uid'] 값이 pid1 pid2에 존재하면 다 가져온다.
        // 상대방의 uid의 프로필 정보를 join해서 가져와서 보여준다. 


        $conditionarr = array();
        $conditionarr["feild"] = "a.idx, ANY_VALUE(a.pid1) as pid1,  ANY_VALUE(a.pid1out) as pid1out, ANY_VALUE(a.pid2) as pid2, ANY_VALUE(a.pid2out) as pid2out, ANY_VALUE(a.participantnum) as participantnum, ANY_VALUE(a.regdate) as regdate, ANY_VALUE(b.`type`) as chattype, MAX(b.regdate) as chatregdate";

       if($_POST['uid'] != null){
        //최신 채팅 내용과 조인하기위해 group by를 사용함 
        //SELECT a.idx, a.pid1, a.pid1, a.pid1out, a.pid2, a.pid2out, a.participantnum, a.regdate , ANY_VALUE(b.idx) as chatidx, ANY_VALUE(b.uid) as uid, ANY_VALUE(b.`type`) as chattype, ANY_VALUE(b.message) as message , MAX(b.regdate) as chatregdate  FROM classrequestroomlist as a INNER JOIN classrequestchatlist b ON b.rid = a.idx WHERE (a.pid1 = '17' || a.pid2 = '17') and type = 0 GROUP BY a.idx, a.pid1, a.pid1, a.pid1out, a.pid2, a.pid2out, a.participantnum ORDER BY a.idx DESC;
        $conditionarr[$this->oClassRequestRoomlist->FIXWHEREVAL] = " WHERE (a.pid1 = '".$_POST['uid']."' || a.pid2 = '".$_POST['uid']."') GROUP BY a.idx";
        //$conditionarr[$this->oClassRequestRoomlist->FIXWHEREVAL] = " WHERE (pid1 = '".$_POST['uid']."' || pid2 = '".$_POST['uid']."')";
       }

      //$conditionarr["order"]["feild"] = "chatregdate";
        $conditionarr["order"]["feild"] = "chatregdate";
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $classrequestlist = $this->oClassRequestRoomlist->getlist_join($conditionarr, $pagehandler);
	    
        for($i = 0; $i<count($classrequestlist);$i++){
            $compareuid = ""; //상대방 uid

            //참가자 아이디중 내 아이디가 아닌 상대방 uid의 정보를 가져온다. 
            if($_POST['uid'] == $classrequestlist[$i]->pid1){
                $compareuid = $classrequestlist[$i]->pid2;
            }else{
                $compareuid = $classrequestlist[$i]->pid1;
            }


            //유저정보 가져오기 
            $uidinfo = $this->oUser->getdataone($compareuid);
            //$uidinfo[$i]->pid1;
            log_message('alert', " --------------- userinfo ---------------  ".json_encode($uidinfo));
            log_message('alert', " --------------- userinfo ---------------  ".json_encode($uidinfo[0]->name));

            $profileimginfo = $this->oProfileImglist->getdataone_main($compareuid);
            log_message('alert', " --------------- userinfoimg ---------------  ".json_encode($profileimginfo));

            $classrequestlist[$i]->viewusername = $uidinfo[0]->name;
            $classrequestlist[$i]->viewusertype = $uidinfo[0]->usertype;
            $classrequestlist[$i]->viewuserimg = $profileimginfo;

            //프로필 정보 가져오기
            if($uidinfo[0]->usertype == 1){ //선생
                $profiledata = $this->oProfileteacher->getdataone($compareuid);
            }else{ //학생
                $profiledata = $this->oProfilestudent->getdataone($compareuid);
            }
            //log_message('alert', " --------------- compareuid ---------------  ".json_encode($compareuid));
            //log_message('alert', " --------------- usertype ---------------  ".json_encode($uidinfo[$i]));
            //log_message('alert', " --------------- profiledata ---------------  ".json_encode($profiledata));
            $classrequestlist[$i]->viewuserprofile = $profiledata;


            log_message('alert', " --------------- classrequestlist ---------------  ".json_encode($classrequestlist[$i]));


            //해당 방의 채팅 갯수 가져오기
            $chatcount = $this->oClassRequestChatlist->getlistcount($classrequestlist[$i]->idx);
            $classrequestlist[$i]->totalchatcount = $chatcount[0]->idx;
            log_message('alert', " --------------- chatcount ---------------  ".json_encode($chatcount[0]->idx));

            
            //조인으로는 Group by에러로 다른데이터는 바뀌지 않아서 최신 채팅 데이터로 순서를 바꿔주는 역할을 함.
            //여기서 데이터를 추가해주어서 최근 채팅 데이터만 가져오는 것.
            //메세지 중에 최근 거 하나만 가져오기, type은 0으로 하여 공지는 가져오지 않기
            $conditionarr = array();
            $conditionarr["where"]["type"]["logic"] = "!=";
            $conditionarr["where"]["type"]["value"] = '1';
            $conditionarr["where"]["rid"]["logic"] = "=";
            $conditionarr["where"]["rid"]["value"] = $classrequestlist[$i]->idx;
            
            $conditionarr["order"]["feild"] = "idx";
            $conditionarr["order"]["value"] = "DESC";
    
            $pagehandler = array();
            $pagehandler["limit"] = 1; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치 
    
            $msginfo = $this->oClassRequestChatlist->getlist($conditionarr, $pagehandler);

            if(!empty($msginfo)){ //채팅 내용 존재 하면
                log_message('alert', "-----msginfo-----  ".json_encode($msginfo));
                $classrequestlist[$i]->currentmsg = $msginfo[0]->message;
                $classrequestlist[$i]->currentmsgregdate = $msginfo[0]->regdate;
                $classrequestlist[$i]->currentimgchk = $msginfo[0]->imgchk; //이미지 여부 


                //$_POST['uid']의 읽지않음 데이터가 잇으면 1을 표시 할 것. 
                //읽음 표시 등록 
                //chatidx, uid, rid
                $conditionarr = array();
                $conditionarr["where"]["chatidx"]["logic"] = "=";
                $conditionarr["where"]["chatidx"]["value"] = $msginfo[0]->idx;
                $conditionarr["where"]["rid"]["logic"] = "=";
                $conditionarr["where"]["rid"]["value"] = $msginfo[0]->rid;
                $conditionarr["where"]["uid"]["logic"] = "=";
                $conditionarr["where"]["uid"]["value"] = $_POST['uid'];

                $conditionarr["order"]["feild"] = "idx";
                $conditionarr["order"]["value"] = "DESC";
                
                $pagehandler = array();
                $pagehandler["limit"] = 1; //리스트 갯수
                $pagehandler["offset"] = 0; //리스트 위치 
                $chatreadinfo = $this->oClassRequestChatreadchklist->getlist($conditionarr, $pagehandler);

                //안읽음 메시지가 있으면 1, 없으면 0
                if(count($chatreadinfo) > 0){
                    $classrequestlist[$i]->noreadchk = 1;
                }else{
                    $classrequestlist[$i]->noreadchk = 0;
                }
                
                //안읽은 채팅 갯수 가져오기 
                $conditionarr = array();
                $conditionarr["where"]["rid"]["logic"] = "=";
                $conditionarr["where"]["rid"]["value"] = $msginfo[0]->rid;
                $conditionarr["where"]["uid"]["logic"] = "=";
                $conditionarr["where"]["uid"]["value"] = $_POST['uid'];

                $conditionarr["order"]["feild"] = "idx";
                $conditionarr["order"]["value"] = "DESC";
                
                $pagehandler = array();
                $pagehandler["limit"] = 0; //리스트 갯수
                $pagehandler["offset"] = 0; //리스트 위치 
                $chatreadlist = $this->oClassRequestChatreadchklist->getlist($conditionarr, $pagehandler);
                $classrequestlist[$i]->noreadcount = count($chatreadlist);

            }else{ //채팅 내용이 없으면
                $classrequestlist[$i]->currentmsg = "null";
                $classrequestlist[$i]->currentmsgregdate = "null";
            }
        }
        

        //searchdata에 대한 값으로 재검색을 해야함. 
        //viewusername으로 검색해서 리스트를 다시 모집할 것. 
        //$classrequestlist // 이 데이터를 재 탐색 실시
        if($_POST['searchdata'] != null){
            $Changedata = array(); //검색 후 넣을 공간
            for($i = 0; $i<count($classrequestlist);$i++){

                //strpos 첫번째 단어에 검색을 하면 0으로 false가 나오는 에러를 해결하기 위해 유저이름 앞에 .을 찍어서 검색할때 사용함. 
                $username = ".".$classrequestlist[$i]->viewusername;
                $pos = strpos($username, $_POST['searchdata']);

                //검색어가 이름에 포함되어 있으면? 저장한다. 
                if($pos != false){
                    array_push($Changedata, $classrequestlist[$i]);
                }
                //log_message('alert', "-----username-----".json_encode($username));
                //log_message('alert', "-----searchdata-----".json_encode($_POST['searchdata']));
                //log_message('alert', "-----pos-----".json_encode($pos));
            }

            log_message('alert', "-----Changedata-----".json_encode($Changedata));

            $response = $this->response->setJSON($Changedata);
        }else{ //검색어가 없을때만 기존 변수를 사용한다. 
            log_message('alert', json_encode($classrequestlist));
            $response = $this->response->setJSON($classrequestlist);
        }

	    
	    
        

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
 
         $classrequestinfo = $this->oClassRequestRoomlist->getlist($conditionarr, $pagehandler);
         
            //pid1, pid2 둘다 정보를 가져와야함. 

             //pid1 유저정보 가져오기 
             $uidinfo = $this->oUser->getdataone($classrequestinfo[0]->pid1);

             log_message('alert', " --------------- userinfo ---------------  ".json_encode($uidinfo));
             log_message('alert', " --------------- userinfo ---------------  ".json_encode($uidinfo[0]->name));
 
             $profileimginfo = $this->oProfileImglist->getdataone_main($classrequestinfo[0]->pid1);
             log_message('alert', " --------------- userinfoimg ---------------  ".json_encode($profileimginfo));
 
             $classrequestinfo[0]->pid1username = $uidinfo[0]->name;
             $classrequestinfo[0]->pid1usernicname = $uidinfo[0]->nicname;
             $classrequestinfo[0]->pid1usertype = $uidinfo[0]->usertype;
             $classrequestinfo[0]->pid1userimg = $profileimginfo[0]->basicuri.$profileimginfo[0]->src;
 
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
 
             $profileimginfo2 = $this->oProfileImglist->getdataone_main($classrequestinfo[0]->pid2);
             log_message('alert', " --------------- userinfoimg ---------------  ".json_encode($profileimginfo2));
 
             $classrequestinfo[0]->pid2username = $uidinfo2[0]->name;
             $classrequestinfo[0]->pid2usernicname = $uidinfo2[0]->nicname;
             $classrequestinfo[0]->pid2usertype = $uidinfo2[0]->usertype;
             $classrequestinfo[0]->pid2userimg = $profileimginfo2[0]->basicuri.$profileimginfo2[0]->src;
 
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

            $roomchk = $this->oClassRequestRoomlist->getlist($conditionarr, $pagehandler);


            log_message('alert', "과외문의방 정보-----------  ".json_encode($roomchk));  
            log_message('alert', "과외문의방 갯수-----------  ".json_encode(count($roomchk)));  

            //방이 존재하지 않으면 방을 생성함. 
            if(count($roomchk) == 0){ 
                $results = $this->getdatainsert($_POST);
                if($results == 1){

                    //방금 insert한 id 가져오기
                    $resultsid = $this->oClassRequestRoomlist->getinsertid();
                    log_message('alert', "게시판 응답 getincre  ".$resultsid); 
                    //후에 nid 나오면 img 전부 저장 고고 

                    $response = $this->response->setJSON(['result'  => true,  'err'  => "success",  'roomidx'  => $resultsid]);
                    log_message('alert', "과외문의방 에러사항-----------  ".json_encode(true));  
                }else{
                    $response = $this->response->setJSON(['result'  => false, 'err'  => "no create room",  'roomidx'  => "null"]);
                    log_message('alert', "과외문의방 에러사항-----------  ".json_encode("no create room"));  
                }
            }else{ //방이 존재하면
                //채팅 갯수 가져오기

                //해당 방의 채팅 갯수 가져오기
                $chatcount = $this->oClassRequestChatlist->getlistcount($roomchk[0]->idx);
                //$classrequestlist[$i]->totalchatcount = $chatcount[0]->idx;
                log_message('alert', " --------------- chatcount ---------------  ".json_encode($chatcount[0]->idx));

                $response = $this->response->setJSON(['result'  => false, 'err'  => "exist room",  'roomidx'  => $roomchk[0]->idx,  'chatcount'  => $chatcount[0]->idx]);
                log_message('alert', "과외문의방 에러사항-----------  ".json_encode("exist room"));  
            }
            
            return $response;

        }
    }


    //과외문의방 수정
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
            $response = $this->oClassRequestRoomlist->getdelete("idx", $deletelist);
            
            return $response;
        }
    }


    //데이터 추가
    public function getdatainsert($Data){

        // //내가 만든 방 갯수를 체크한다.
        // $conditionarr = array();
        // $conditionarr["where"]["pid1"]["logic"] = "=";
        // $conditionarr["where"]["pid1"]["value"] = $Data['myuid'];
             
        // $pagehandler = array();
        // $pagehandler["limit"] = 0; //리스트 갯수
        // $pagehandler["offset"] = 0; //리스트 위치 
        
        // //방을 만든 갯수를 가져와서 닉네임과 합쳐서 방이름을 만들 것. pid1을 기준으로 검색해서 갯수를 가져올 것
        // $roomlist = $this->oClassRequestRoomlist->getlist($conditionarr, $pagehandler);

        $data=array("idx" => '0', 'pid1' => $Data["myuid"], 'pid1out' => 0, 'pid2' => $Data["requestuid"], 'pid2out' => 0, 'participantnum' => $Data["participantnum"], 'regdate' => $Data["currenttime"]);

        $results = $this->oClassRequestRoomlist->getinsert($data);

        $results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }

    //데이터 업데이트
    public function getdataupdate($Data){
        
        $fieldname=array(
            'idx' => $Data["roomidx"]
        );

        //MyuidLocate pid1 or pid2 둘중 하나를 정해서 보내줌. 
        if($Data["MyuidLocate"] != null){
            $data=array($Data["MyuidLocate"] => 1);
        }
        //$data=array("idx" => '150', 'gameidx' => 2, 'title' => 'qqq', 'document' => 'wewe', 'useridx' => '1', 'regdate' => $this->now, 'views' => 0);

        $results = $this->oClassRequestRoomlist->getupdate($fieldname, $data);
        
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

}
