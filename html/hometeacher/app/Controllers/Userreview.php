<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserReviewlist;
use CodeIgniter\I18n\Time;
use App\Models\User;
use App\Models\MyclassRoomlist;
class Userreview extends BaseController
{
    public $oUserReviewlist = "";
    public $oUser = "";
    public $oMyclassRoomlist = "";


    public $now = "";
	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');
        $this->oUserReviewlist = new UserReviewlist();
        $this->oUser = new User();
        $this->oMyclassRoomlist = new MyclassRoomlist();
    }


    //where teacheruid
    //writeuid, profileimg join
    //기본 join이 작성자의 정보와 연결되어 있음. 
    public function reviewlist($glimit, $goffset){

        log_message('alert', "-------reviewlist------------".json_encode($_POST)); 
        log_message('alert', "-------reviewlist------------".json_encode($_GET)); 
        log_message('alert', "-------reviewlist------------".json_encode($glimit)); 
        log_message('alert', "-------reviewlist------------".json_encode($goffset)); 
        log_message('alert', "-------total reviewlist text------------".json_encode($_POST['teacheruid'])); 



        $conditionarr = array();

        $conditionarr["feild"] = "a.idx,a.rid,a.teacheruid,a.writeuid,a.reviewtext,a.professional,a.lecturepower,a.lectureready,a.lectureontime,a.payment,a.classstartdate,a.regdate,b.usertype,b.email,b.name,b.nicname, c.idx as imgidx, c.basicuri, c.src, c.type";
       
       //선생님 프로필에서 리뷰를 리스트로 확인함
        if($_POST['teacheruid'] != null){
            $conditionarr["where"]["a.teacheruid"]["logic"] = "=";
            $conditionarr["where"]["a.teacheruid"]["value"] = $_POST['teacheruid']; //선생님 고유번호
        }

        //학생이 작성한 리뷰를 리스트로 확인함
        if($_POST['studentuid'] != null){
            $conditionarr["where"]["a.writeuid"]["logic"] = "=";
            $conditionarr["where"]["a.writeuid"]["value"] = $_POST['studentuid']; //선생님 고유번호
        }

        //수정시 해당 리뷰 가져오기
        if($_POST['reviewidx'] != null){
            $conditionarr["where"]["a.idx"]["logic"] = "=";
            $conditionarr["where"]["a.idx"]["value"] = $_POST['reviewidx']; //선생님 고유번호
        }
        


        //프로필의 메인 이미지를 하나 가져옴
        $conditionarr["where"]["c.type"]["logic"] = "=";
        $conditionarr["where"]["c.type"]["value"] = 1;


        //AND (a.title like '%학교%' || a.document like '%학교%') 이걸 한번에 추가할 수 없을까? 
        //검색어 찾기 
        // if($_POST['searchtext'] != null){

        //    //제목 + 글에서 내용이 있으면 조건을 줌.
        //    $conditionarr[$this->oNboardlist->FIXWHEREVAL] = " AND (a.title like '%".$_POST['searchtext']."%' || a.document like '%".$_POST['searchtext']."%')";
        // }


        $conditionarr["order"]["feild"] = "a.idx";
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "conditionarr--------!!!  ".json_encode($conditionarr));

        $reviewinfo = $this->oUserReviewlist->getlist_join($conditionarr, $pagehandler);

        // for($i = 0; $i<count($reviewinfo);$i++){
            
        //     //teacheruid의 타입을 가져올 것. 
        
        
        // }






        log_message('alert', "-------total nboard text------------".json_encode($reviewinfo)); 
        log_message('alert', "-------total nboard text------------".json_encode(count($reviewinfo))); 

        //for($i = 0; $i<count($nboardinfo);$i++){
         //   log_message('alert', "-------nboard------------".json_encode($nboardinfo[$i])); 
        //}

        log_message('alert', "-------total nboard text------------".json_encode($reviewinfo)); 
	    $response = $this->response->setJSON($reviewinfo);
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

            $myclassinfo[0]->userlist = $userlist;
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

    //리뷰 추가
    public function reviewsave($a,$b){
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------"));
        log_message('alert', json_encode($_POST)); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 
        
        //post전부 저장 
        if($_POST != null){

            //리뷰를 생성한다. 
            //리뷰는 값이 없을때만 저장한다. 이미 리뷰를 작성했다면 저장하지 않는다. 수정가능. 
            
            $conditionarr = array();

            $conditionarr["where"]["rid"]["logic"] = "=";
            $conditionarr["where"]["rid"]["value"] = $_POST['roomidx']; 
            $conditionarr["where"]["teacheruid"]["logic"] = "=";
            $conditionarr["where"]["teacheruid"]["value"] = $_POST['teacheruid']; 
            $conditionarr["where"]["writeuid"]["logic"] = "=";
            $conditionarr["where"]["writeuid"]["value"] = $_POST['writeuid']; 

           // $conditionarr["order"]["feild"] = "idx";
           // $conditionarr["order"]["value"] = "DESC";
    
            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치 
    
            //log_message('alert', "55555555555555  ".json_encode($conditionarr));
    
            $reviewlist = $this->oUserReviewlist->getlist($conditionarr, $pagehandler);


            if(empty($reviewlist)){//리뷰 리스트가 빈값일때 저장한다. 
            
                //방정보 가져오기  $_POST['roomidx']
                $conditionarr = array();
                $conditionarr["where"]["idx"]["logic"] = "=";
                $conditionarr["where"]["idx"]["value"] = $_POST['roomidx']; 

                $pagehandler = array();
                $pagehandler["limit"] = 0; //리스트 갯수
                $pagehandler["offset"] = 0; //리스트 위치 
                $myclassinfo = $this->oMyclassRoomlist->getlist($conditionarr, $pagehandler);
                log_message('alert', "---myclassinfo search  ".json_encode($myclassinfo));

                $results = $this->getdatainsert($_POST, $myclassinfo[0]); //방정보 같이 전달. 
                if($results == 1){

                    //방금 insert한 id 가져오기
                    //$resultsid_myclass = $this->oMyclassRoomlist->getinsertid();
                    //log_message('alert', "게시판 응답 getincre  ".$resultsid_myclass); 
    
                    $response = $this->response->setJSON(['result'  => true,  'err'  => "success"]);
                    log_message('alert', "리뷰 추가 에러사항-----------  ".json_encode(true));  
                }else{
                    $response = $this->response->setJSON(['result'  => false, 'err'  => "fail"]);
                    log_message('alert', "리뷰 추가 에러사항-----------  ".json_encode("fail"));  
                }
            }else{
                $response = $this->response->setJSON(['result'  => false, 'err'  => "fail"]);
            }
            
            return $response;

        }
    }


    //내가 작성한 리뷰 수정
    public function reviewupdate($a,$b){
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode($_POST)); 
        //log_message('alert', json_encode($_FILES)); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 

        //post전부 저장 
        if($_POST != null){
            $results = $this->getdataupdate($_POST);
        }


        // if($_FILES != null){

        //     $fieldname=array(
        //         'idx' => $_POST["roomidx"]
        //     );
        //     $fileresult = $this->imgupload($_FILES, $fieldname);

        //     log_message('alert', "게시판 응답 getincre  ".$fileresult); 
        // }



            if($results == 1){
                $response = $this->response->setJSON(['result'  => true,  'err'  => "success",  'roomidx'  => $roomchk[0]->idx]);
                log_message('alert', "내 과외 방 에러사항-----------  ".json_encode(true));  
            }else{
                $response = $this->response->setJSON(['result'  => false, 'err'  => "no create room",  'roomidx'  => "null"]);
                log_message('alert', "내 과외 방 에러사항-----------  ".json_encode("no create room"));  
            }
            
            return $response;
    }

    //리뷰 삭제
    public function getdatadelete($a,$b){
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode($_POST)); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 

        //post전부 저장 
        if($_POST != null){

            //방 삭제
            $deletelist = array();
            $deletelist[0] = $_POST['reviewidx'];
            //log_message('alert', "-----getdatadelete-----".json_encode($deletelist));
            $response = $this->oUserReviewlist->getdelete("idx", $deletelist);
            
            return $response;
        }
    }


    //데이터 추가
    public function getdatainsert($Data, $myclassinfo){

        $data=array("idx" => '0', 'rid' => $Data["roomidx"], 'teacheruid' => $Data["teacheruid"], 'writeuid' => $Data["writeuid"], 'reviewtext' => $Data["reviewtext"], 'professional' => $Data["professional"], 'lecturepower' => $Data["lecturepower"], 'lectureready' => $Data["lectureready"], 'lectureontime' => $Data["lectureontime"], 'payment' => $myclassinfo->payment, 'classstartdate' => $myclassinfo->regdate, 'regdate' => $Data["currenttime"]);

        $results = $this->oUserReviewlist->getinsert($data);

        $results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }

    //데이터 업데이트
    public function getdataupdate($Data){
        
        $fieldname=array(
            'idx' => $Data["reviewidx"]
        );

        $data=array('reviewtext' => $Data["reviewtext"], 'professional' => $Data["professional"], 'lecturepower' => $Data["lecturepower"], 'lectureready' => $Data["lectureready"], 'lectureontime' => $Data["lectureontime"], 'regdate' => $Data["currenttime"]);

        $results = $this->oUserReviewlist->getupdate($fieldname, $data);
        
        $results = $this->response->setJSON(['result'  => $results]);
        log_message('alert', "리뷰 데이터_ ".json_encode($results));

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
    
    public function imgupload($files, $rid){

        // log_message('alert', json_encode($files)); 
        // log_message('alert', json_encode($files['files'])); 
        // log_message('alert', json_encode($files['files']['tmp_name'])); 
        // log_message('alert', json_encode($files['files']['name'])); 
        // log_message('alert', json_encode($files['files']['type']));  
        // log_message('alert', json_encode($files['files']['size']));  
        // log_message('alert', json_encode($files['files']['error']));  


        $oUpload = new Upload();

        $basicurl = "/image/myclassroom/";

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
            $reslut = $this->oMyclassRoomlist->getupdate($rid, $imgdata);

            log_message('alert', "img result".json_encode($reslut));  
        }
        
    }

}
