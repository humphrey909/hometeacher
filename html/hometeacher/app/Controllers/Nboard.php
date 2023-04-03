<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Nboardlist;
use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\IncomingRequest;
use App\Controllers\Upload;
use App\Models\NboardImglist;
use App\Models\Likenboardlist;
use App\Models\Commentlist;
use App\Models\CommentlistNested;
use App\Models\Alertlist;
class Nboard extends BaseController
{
    public $oNboardlist = "";
    public $oNboardImglist = "";
    public $now = "";
    public $oLikenboardlist = "";
    public $oCommentlist = "";
    public $oCommentlistNested = "";
    public $oAlertlist = "";

	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');

        $this->oNboardlist = new Nboardlist();
        $this->oNboardImglist = new NboardImglist();

        $this->oLikenboardlist = new Likenboardlist();
        $this->oCommentlist = new Commentlist();
        $this->oCommentlistNested = new CommentlistNested();
        $this->oAlertlist = new Alertlist();
        
    }
    
    //리스트페이지
    public function list()
    {
        return view("../../../svelte/public/index.html");
    }

    //수정, 보기 페이지
    public function info()
    {
        return view("../../../svelte/public/index.html");
    }
    
    //http://192.168.56.101/index.php/main/page1/sandals/123


    //게시글 전체 불러오기
    
    //
    //전체보기
    //검색 조건 : 제목검색, 내용검색, 작성자검색, 게임타입별검색
    //페이징처리 : 페이지 번호에 10개씩 자르기 $query=$builder->get(10, 20);
    //정렬 조건 : 오름차순 내림차순, 필드 이름

    //조인 처리 : uid gid 랭크id 있으면 rankid
    public function nboardlist($glimit, $goffset){

        log_message('alert', "-------nboard------------".json_encode($_POST)); 
        log_message('alert', "-------nboard------------".json_encode($_GET)); 
        log_message('alert', "-------nboard------------".json_encode($glimit)); 
        log_message('alert', "-------nboard------------".json_encode($goffset)); 
        log_message('alert', "-------total nboard text------------".json_encode($_POST['uid'])); 

        //조회수 체크 
        if($_POST['viewsup'] == 1){
            $this->viewsupdate($_POST['nid']);
        }

        $conditionarr = array();

        $conditionarr["feild"] = "a.idx,a.uid,a.maincategorey,a.subcategorey,a.title,a.document,a.likenum,a.views,a.regdate,b.usertype,b.email,b.name,b.nicname, c.idx as imgidx, c.basicuri, c.src, c.type";
        if($_POST['nid'] != null){
            $conditionarr["where"]["a.idx"]["logic"] = "=";
            $conditionarr["where"]["a.idx"]["value"] = $_POST['nid']; //게시글 idx
        }

        if($_POST['maincategorey'] != "null"){
            $conditionarr["where"]["a.maincategorey"]["logic"] = "=";
            $conditionarr["where"]["a.maincategorey"]["value"] = $_POST['maincategorey']; //메인 카테고리
        }

        //프로필의 메인 이미지를 하나 가져옴
        $conditionarr["where"]["c.type"]["logic"] = "=";
        $conditionarr["where"]["c.type"]["value"] = 1;

        //서브카테고리 검색
        if($_POST['subcategorey'] != null){
            $conditionarr["where"]["a.subcategorey"]["logic"] = "=";
            $conditionarr["where"]["a.subcategorey"]["value"] = $_POST['subcategorey']; //서브 카테고리
        }


        //AND (a.title like '%학교%' || a.document like '%학교%') 이걸 한번에 추가할 수 없을까? 
        //검색어 찾기 
        if($_POST['searchtext'] != null){
           // $conditionarr["where"]["a.document"]["logic"] = "like";
           // $conditionarr["where"]["a.document"]["value"] = "'%".$_POST['searchtext']."%'"; 
           
           //log_message('alert', "-------nboard------------FIXWHEREVAL ".json_encode($this->oNboardlist->FIXWHEREVAL)); 

           //제목 + 글에서 내용이 있으면 조건을 줌.
           $conditionarr[$this->oNboardlist->FIXWHEREVAL] = " AND (a.title like '%".$_POST['searchtext']."%' || a.document like '%".$_POST['searchtext']."%')";
        }


        $conditionarr["order"]["feild"] = "a.idx";
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "conditionarr--------!!!  ".json_encode($conditionarr));

        $nboardinfo = $this->oNboardlist->getlist_join($conditionarr, $pagehandler);
        log_message('alert', "-------total nboard text------------".json_encode($nboardinfo)); 
        log_message('alert', "-------total nboard text------------".json_encode(count($nboardinfo))); 

        for($i = 0; $i<count($nboardinfo);$i++){
            log_message('alert', "-------nboard------------".json_encode($nboardinfo[$i])); 

            //게시글 이미지 추가
            $nboardimg = $this->nboardimglist($nboardinfo[$i]->idx);

            log_message('alert', "-------nboard img------------img".json_encode($nboardimg)); 

            if(!empty($nboardimg)){ //이미지 데이터가 있는 게시물만 푸쉬함
                log_message('alert', "-------nboard img------------img~~~~".json_encode($nboardimg[0])); 

               // $nboardimg_trans = json_decode($nboardimg);
               // array_push($nboardinfo[$i], $nboardimg);
               $nboardinfo[$i]->nboardimg = $nboardimg;
            }else{
                $nboardinfo[$i]->nboardimg = "null";
            }


            //좋아요 갯수 넣어주기. 
            $conditionarr = array();

            $conditionarr["where"]["getnid"]["logic"] = "=";
            $conditionarr["where"]["getnid"]["value"] = $nboardinfo[$i]->idx;

            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치 
            $likeinfo = $this->oLikenboardlist->getlist($conditionarr, $pagehandler);
            log_message('alert', "좋아요 데이터 ".json_encode($likeinfo));

            if(!empty($likeinfo)){ //like 리스트가 있을때만 푸쉬함
                $nboardinfo[$i]->liketotalnum = count($likeinfo);
            }else{
                $nboardinfo[$i]->liketotalnum = 0;
            }

            

            //댓글 갯수 
            $conditionarr = array();

            $conditionarr["where"]["nid"]["logic"] = "=";
            $conditionarr["where"]["nid"]["value"] = $nboardinfo[$i]->idx;

            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치 
            $commentinfo = $this->oCommentlist->getlist($conditionarr, $pagehandler);
            log_message('alert', "댓글 데이터 ".json_encode($commentinfo));

            if(!empty($commentinfo)){ //like 리스트가 있을때만 푸쉬함
                $nboardinfo[$i]->commenttotalnum = count($commentinfo);
            }else{
                $nboardinfo[$i]->commenttotalnum = 0;
            }


            //내가 체크한 좋아요 확인
            //내 uid와 해당 댓글의 좋아요 데이터가 있으면 true
            //내 uid와 해당 댓글 좋아요 데이터가 없으면 false
            if($_POST['uid'] != null){
                $conditionarr = array();

                $conditionarr["where"]["giveuid"]["logic"] = "=";
                $conditionarr["where"]["giveuid"]["value"] = $_POST['uid'];
                $conditionarr["where"]["getnid"]["logic"] = "=";
                $conditionarr["where"]["getnid"]["value"] = $nboardinfo[$i]->idx;
    
                $pagehandler = array();
                $pagehandler["limit"] = 0; //리스트 갯수
                $pagehandler["offset"] = 0; //리스트 위치 
                $nboardlikeinfo = $this->oLikenboardlist->getlist($conditionarr, $pagehandler);
                log_message('alert', "내가 좋아요 누른 데이터 ".json_encode($nboardlikeinfo));
            
                if(!empty($nboardlikeinfo)){ //like 리스트가 있을때만 푸쉬함
                    $nboardinfo[$i]->nboardlikechk = "true";
                 }else{
                    $nboardinfo[$i]->nboardlikechk = "false";
                }
    
            }
        }






        log_message('alert', "-------total nboard text------------".json_encode($nboardinfo)); 
	    $response = $this->response->setJSON($nboardinfo);
	    return $response;
    }
    

    //내 게시글 보기에서 확인하는 리스트
    public function nboardlist_mypage($glimit, $goffset){
    
        log_message('alert', "-------nboard------------".json_encode($_POST)); 
        log_message('alert', "-------nboard------------".json_encode($_GET)); 
        log_message('alert', "-------nboard------------".json_encode($glimit)); 
        log_message('alert', "-------nboard------------".json_encode($goffset)); 

        $conditionarr = array();

        $conditionarr["feild"] = "a.idx,a.uid,a.maincategorey,a.subcategorey,a.title,a.document,a.likenum,a.views,a.regdate,b.usertype,b.email,b.name,b.nicname";
        
        //유저 고유번호
        if($_POST['uid'] != null){
            $conditionarr["where"]["a.uid"]["logic"] = "=";
            $conditionarr["where"]["a.uid"]["value"] = $_POST['uid'];
        }

        if($_POST['maincategorey'] != "null"){
            $conditionarr["where"]["a.maincategorey"]["logic"] = "=";
            $conditionarr["where"]["a.maincategorey"]["value"] = $_POST['maincategorey']; //메인 카테고리
        }

        $conditionarr["order"]["feild"] = "a.idx";
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "conditionarr--------!!!  ".json_encode($conditionarr));

        $nboardinfo = $this->oNboardlist->getlist_join_mypage($conditionarr, $pagehandler);
        log_message('alert', "-------total nboard text------------".json_encode($nboardinfo)); 
        log_message('alert', "-------total nboard text------------".json_encode(count($nboardinfo))); 



        for($i = 0; $i<count($nboardinfo);$i++){
            log_message('alert', "-------nboard------------".json_encode($nboardinfo[$i])); 

            //게시글 이미지 추가
            $nboardimg = $this->nboardimglist($nboardinfo[$i]->idx);

            log_message('alert', "-------nboard img------------img".json_encode($nboardimg)); 

            if(!empty($nboardimg)){ //이미지 데이터가 있는 게시물만 푸쉬함
                log_message('alert', "-------nboard img------------img~~~~".json_encode($nboardimg[0])); 

               // $nboardimg_trans = json_decode($nboardimg);
               // array_push($nboardinfo[$i], $nboardimg);
               $nboardinfo[$i]->nboardimg = $nboardimg;
            }else{
                $nboardinfo[$i]->nboardimg = "null";
            }


            //좋아요 갯수 넣어주기. 
            $conditionarr = array();

            $conditionarr["where"]["getnid"]["logic"] = "=";
            $conditionarr["where"]["getnid"]["value"] = $nboardinfo[$i]->idx;

            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치 
            $likeinfo = $this->oLikenboardlist->getlist($conditionarr, $pagehandler);
            log_message('alert', "좋아요 데이터 ".json_encode($likeinfo));

            if(!empty($likeinfo)){ //like 리스트가 있을때만 푸쉬함
                $nboardinfo[$i]->liketotalnum = count($likeinfo);
            }else{
                $nboardinfo[$i]->liketotalnum = 0;
            }

            

            //댓글 갯수 
            $conditionarr = array();

            $conditionarr["where"]["nid"]["logic"] = "=";
            $conditionarr["where"]["nid"]["value"] = $nboardinfo[$i]->idx;

            $pagehandler = array();
            $pagehandler["limit"] = 0; //리스트 갯수
            $pagehandler["offset"] = 0; //리스트 위치 
            $commentinfo = $this->oCommentlist->getlist($conditionarr, $pagehandler);
            log_message('alert', "댓글 데이터 ".json_encode($commentinfo));

            if(!empty($commentinfo)){ //like 리스트가 있을때만 푸쉬함
                $nboardinfo[$i]->commenttotalnum = count($commentinfo);
            }else{
                $nboardinfo[$i]->commenttotalnum = 0;
            }
        }

        log_message('alert', "-------total nboard text------------".json_encode($nboardinfo)); 
	    $response = $this->response->setJSON($nboardinfo);
	    return $response;

    }



    //게시글 이미지 리스트 
    public function nboardimglist($nid){


        $conditionarr = array();

        $conditionarr["where"]["nid"]["logic"] = "=";
        $conditionarr["where"]["nid"]["value"] = $nid; 

        // if($subcategorey != "null"){
        //     $conditionarr["where"]["subcategorey"]["logic"] = "=";
        //     $conditionarr["where"]["subcategorey"]["value"] = $subcategorey; //서브 카테고리
        // }

        $conditionarr["order"]["feild"] = "idx";
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = 0; //리스트 갯수
        $pagehandler["offset"] = 0; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $results = $this->oNboardImglist->getlist($conditionarr, $pagehandler);

       // log_message('alert', json_encode($results));
	    //$response = $this->response->setJSON($results);

	    return $results;
    }

    public function nboardimginfoone($nid){


        $conditionarr = array();

        $conditionarr["where"]["nid"]["logic"] = "=";
        $conditionarr["where"]["nid"]["value"] = $nid; //메인 이미지만 가져옴

        $conditionarr["order"]["feild"] = "idx";
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = 0; //리스트 갯수
        $pagehandler["offset"] = 0; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $results = $this->oNboardImglist->getlist($conditionarr, $pagehandler);

       // log_message('alert', json_encode($results));
	    //$response = $this->response->setJSON($results);

	    return $results;
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
    
    // //info 검색 처리 : ntype으로 조절
    // public function getdatainfoone($glimit, $goffset){
    //     log_message('alert', "-------nboard------------".json_encode($_POST)); //nid


    //     if($_POST['viewsup'] == 1){
    //         $this->viewsupdate($_POST['nid']);
    //     }


    //     $conditionarr = array();
    //     $conditionarr["feild"] = "a.idx,a.uid,a.maincategorey,a.subcategorey,a.title,a.document,a.likenum,a.views,a.regdate,b.usertype,b.email,b.name,b.nicname, c.idx as imgidx, c.basicuri, c.src, c.type";

    //     $conditionarr["where"]["a.idx"]["logic"] = "=";
    //     $conditionarr["where"]["a.idx"]["value"] = $_POST['nid'];
    //     $conditionarr["where"]["c.type"]["logic"] = "=";
    //     $conditionarr["where"]["c.type"]["value"] = 1;

    //     $pagehandler = array();
    //     $pagehandler["limit"] = $glimit; //리스트 갯수
    //     $pagehandler["offset"] = $goffset; //리스트 위치 

    //     $nboardinfo = $this->oNboardlist->getlist_join($conditionarr, $pagehandler);

    //     //댓글 갯수도 같이 넣기 

    //     //좋아요 수도 넣기 










    //     $nboardimg = $this->nboardimginfoone($_POST['nid']);
	    
	//     log_message('alert', json_encode($results));
	//     $response = $this->response->setJSON(['nboardinfo'  => $nboardinfo, 'nboardimg'  => $nboardimg]);

	//     return $response;
    // }

    //조회수 1을 업 한다. 
    public function viewsupdate($nid){

        $info = $this->oNboardlist->getdataone($nid); //회원정보 가져오기
        $infoviews = intval($info[0] -> views);
     
        $views = $infoviews+1;
    
        //조회수 수정할 것. 
        $fieldname_user=array(
            'idx' => $nid
        );
                
        $data_user=array("views" => $views);
        $results_user = $this->oNboardlist->getupdate($fieldname_user, $data_user);
    }


    //전체 갯수
    public function getdatacount(){
        $results = $this->oNboardlist->getlistcount();
	    
	   // log_message('alert', json_encode($results));
	    $response = $this->response->setJSON($results);

	    return $response; 
    }

    //데이터 추가
    public function getdatainsert($Data){
        //log_message('alert', "게시판 데이터_ ".json_encode($json));
        // log_message('alert', "게시판 데이터 ".json_encode($Data["gtype"]));
        // log_message('alert', "게시판 데이터 ".json_encode($Data["rankid"]));
        // log_message('alert', "게시판 데이터 ".json_encode($Data["uid"]));
        // log_message('alert', "게시판 데이터 ".json_encode($Data["score"]));
        // log_message('alert', "게시판 데이터 ".json_encode($Data["title"]));
        // log_message('alert', "게시판 데이터 ".json_encode($Data["documenttext"]));
        // // log_message('alert', "게시판 데이터_ ".json_encode($json));
        // log_message('alert', "게시판 데이터 ".json_encode($json->gtype));
        // log_message('alert', "게시판 데이터 ".json_encode($json->rankid));
        // log_message('alert', "게시판 데이터 ".json_encode($json->uid));
        // log_message('alert', "게시판 데이터 ".json_encode($json->score));
        // log_message('alert', "게시판 데이터 ".json_encode($json->title));
        // log_message('alert', "게시판 데이터 ".json_encode($json->documenttext));

       // $data=array("idx" => '0', 'uid' => $json->uid, 'gid' => $json->gtype, 'rankid' => $json->rankid, 'ntype' => $json->ntype, 'title' => $json->title, 'document' => $json->documenttext,  'regdate' => $this->now, 'views' => 0);
        $data=array("idx" => '0', 'uid' => $Data["uid"], 'maincategorey' => $Data["maincategorey"], 'subcategorey' => $Data["subcategorey"], 'title' => $Data["title"], 'document' =>$Data["document"], 'likenum' => 0, 'views' => 0,  'regdate' => $Data["currenttime"]);
        log_message('alert', "게시판 데이터 ".json_encode($data));
        
        $results = $this->oNboardlist->getinsert($data);

        //$results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }

    //데이터 업데이트
    public function getdataupdate($Data){

        $fieldname=array(
            //'idx' => $json->gameplayinfo->rankid
            'idx' => $Data["nid"]
        );
        $data=array('uid' => $Data["uid"], 'maincategorey' => $Data["maincategorey"], 'subcategorey' => $Data["subcategorey"], 'title' => $Data["title"], 'document' => $Data["document"], 'regdate' => $Data["currenttime"]);

        //$data=array("idx" => '150', 'gameidx' => 2, 'title' => 'qqq', 'document' => 'wewe', 'useridx' => '1', 'regdate' => $this->now, 'views' => 0);

        $results = $this->oNboardlist->getupdate($fieldname, $data);
        
       $results = $this->response->setJSON(['result'  => $results]);
       log_message('alert', "게시판 데이터_ ".json_encode($results));

        return $results; 
    }

    public function getdataupdate_each(){
        $json=json_decode(file_get_contents('php://input'));
        $json=$json->data;
        log_message('alert', "게시판 데이터_update ".json_encode($json));

        $fieldname=array(
            'idx' => $json->idx
        );
        $data=array('views' => $json->views);
        
        $results = $this->oNboardlist->getupdate($fieldname, $data);

        $results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }
    //데이터 삭제
    public function getdatadelete($a, $b){
        log_message('alert', "-----getdatadelete-----".json_encode($_POST));


        //게시글 삭제
        $deletelist = array();
        $deletelist[0] = $_POST['nid'];
        //log_message('alert', "-----getdatadelete-----".json_encode($deletelist));
        $results = $this->oNboardlist->getdelete("idx", $deletelist);

        //게시글 이미지 삭제
        $results = $this->oNboardImglist->getdelete("nid", $deletelist);



        //댓글 삭제
       // $deletelist = array();
       // $deletelist[0] = $_POST['nid'];
        //log_message('alert', "-----getdatadelete-----".json_encode($deletelist));
        $results = $this->oCommentlist->getdelete("nid", $deletelist);


        //대댓글 삭제
      //  $deletelist = array();
       // $deletelist[0] = $_POST['nid'];
        //log_message('alert', "-----getdatadelete-----".json_encode($deletelist));
        $results = $this->oCommentlistNested->getdelete("nid", $deletelist);



        
        $results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }

    public function imgupload($files, $nid, $uid, $maincategorey, $subcategorey, $currenttime){

        // log_message('alert', json_encode($files)); 
        // log_message('alert', json_encode($files['files'])); 
        // log_message('alert', json_encode($files['files']['tmp_name'])); 
        // log_message('alert', json_encode($files['files']['name'])); 
        // log_message('alert', json_encode($files['files']['type']));  
        // log_message('alert', json_encode($files['files']['size']));  
        // log_message('alert', json_encode($files['files']['error']));  


        $oUpload = new Upload();

        $basicurl = "/image/nboard/";

        //다중으로 가져오는 파일 정보 -- 파일 저장, 경로 db에 저장 
        //{"name":"img.png","type":"image\/png","tmp_name":"\/tmp\/phpvquFKq","error":0,"size":4052}
        foreach($files as $key => $value){
            log_message('alert', json_encode($value));  

            //        // var filename = joincode+uid+pid+"_"+year+month+day+getHours+getMinutes+getSeconds+getMilliseconds+".mp4";
            //nid 저장
            //파일명 생성해서 넘기기

            $filename = $oUpload->upload($value, $basicurl); //이미지 업로드

            log_message('alert', "img 경로".json_encode($filename));  


            $imgdata=array("idx" => '0', 'nid' => $nid, 'uid' => $uid, 'maincategorey' => $maincategorey, 'subcategorey' => $subcategorey, 'basicuri' => $basicurl, 'src' => $filename, 'regdate' => $currenttime);

            //이미지 경로 db 저장
            //getinsert
            $reslut = $this->oNboardImglist->getinsert($imgdata);

            log_message('alert', "img result".json_encode($reslut));  
        }
        
    }

    //이미지 글 formdata로 가져와서 저장함 //게시물 저장
    public function nboardsavebox(){
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode($_FILES)); 
        log_message('alert', json_encode($_POST)); 
        log_message('alert', json_encode("--------------------------")); 
        log_message('alert', json_encode("--------------------------")); 


        
        //post전부 저장 
        if($_POST != null){
            $results = $this->getdatainsert($_POST);

            if($results == 1){
                //방금 insert한 id 가져오기
                $resultsid = $this->oNboardlist->getinsertid();
                log_message('alert', "게시판 응답 getincre  ".$resultsid); 
                //후에 nid 나오면 img 전부 저장 고고 
            }
        }

        if($_FILES != null){
            $fileresult = $this->imgupload($_FILES, $resultsid, $_POST['uid'], $_POST['maincategorey'], $_POST['subcategorey'], $_POST['currenttime']);

            log_message('alert', "게시판 응답 getincre  ".$fileresult); 
        }
        
    }

    //이미지 글 formdata로 가져와서 업데이트
    // - 이미지는 삭제할 데이터 삭제, 이미지 추가할 데이터 추가, 텍스트 업데이트
    public function nboardupdatebox(){
        log_message('alert', "-------!!!-------".json_encode($_FILES)); 
        log_message('alert', "-------!!!-------".json_encode($_POST)); 
        log_message('alert', "-------!!!-------".json_encode($_POST['deletelist'])); 

        //post전부 저장 
        if($_POST != null){
            $results = $this->getdataupdate($_POST);
        }

        if($_FILES != null){
            $fileresult = $this->imgupload($_FILES, $_POST['nid'], $_POST['uid'], $_POST['maincategorey'], $_POST['subcategorey'], $_POST['currenttime']);

            log_message('alert', "게시판 응답 getincre  ".$fileresult); 
        }

        //$_POST['imgdeletelist'] // delete리스트 삭제 고고 하기 
        if($_POST['imgdeletelist'] != ""){
            $this->deleteimage($_POST['imgdeletelist']);
        }
    }

    public function getimage($glimit, $goffset){
        //nid에 맞는 데이터 가져오기


        $conditionarr = array();
        //$conditionarr["feild"] = "a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info";
        log_message('alert', "55555555555555  ".json_encode($_POST));
        log_message('alert', "55555555555555  ".json_encode($_POST['fieldval']));

        $conditionarr["where"][$_POST["fieldname"]]["logic"] = $_POST["fieldlogic"];
        $conditionarr["where"][$_POST["fieldname"]]["value"] = $_POST["fieldval"];

        $conditionarr["order"]["feild"] = "regdate";
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $list = $this->oNboardImglist->getlist_join($conditionarr, $pagehandler);
        $response = $this->response->setJSON($list);
        return $response;
    }

    //게시판 이미지 데이터 리스트 삭제하기 
    public function deleteimage($deletelist){
        log_message('alert', "deletelist  ".json_encode($deletelist));
        
        $deletearr = substr($deletelist, 1);
        $deletearr = substr($deletearr, 0, -1);
        $deletearr = str_replace(" ", "", $deletearr); 

        //deletef리스트 "17,14"이거 풀어서 어레이로 묵기 !!!
        $deletelistarr = explode(",", $deletearr);
        log_message('alert', "deletelist  ".json_encode($deletelistarr));
        
        $list = $this->oNboardImglist->getdelete("idx", $deletelistarr);
    }

    //좋아요 추가
    public function likeadd($a, $b){
        log_message('alert', "likeadd".json_encode($_POST));

        $conditionarr = array();

        $conditionarr["where"]["giveuid"]["logic"] = "=";
        $conditionarr["where"]["giveuid"]["value"] = $_POST["uid"];
        $conditionarr["where"]["getnid"]["logic"] = "=";
        $conditionarr["where"]["getnid"]["value"] = $_POST["nid"];

        $pagehandler = array();
        $pagehandler["limit"] = 0; //리스트 갯수
        $pagehandler["offset"] = 0; //리스트 위치 
        $likeinfo = $this->oLikenboardlist->getlist($conditionarr, $pagehandler);
        log_message('alert', "좋아요 데이터 ".json_encode($likeinfo));



        if($_POST["liketype"] == 1){ //좋아요 클릭
            if($likeinfo[0] == ""){ //값이 없을때만 
                $data=array("idx" => '0', 'giveuid' => $_POST["uid"], 'getnid' => $_POST["nid"], 'regdate' => $_POST['currenttime']);
                log_message('alert', "프로필 데이터 ".json_encode($data));
        
                $results = $this->oLikenboardlist->getinsert($data);


                
                //알림 저장하기.
                $data=array("idx" => '0', 'nid' => $_POST["nid"], 'uid' => $_POST["uid"], 'alertuid' => $_POST["Nboardwriteuid"], 'alertdocu' => $_POST["myname"]."님이 회원님의 게시글에 좋아요를 눌렀습니다. ", 'click' => 1, 'regdate' => $_POST['currenttime']);
                log_message('alert', "알림데이터 데이터 ".json_encode($data));
                
                $alertresult = $this->oAlertlist->getinsert($data);
                if($alertresult == 1){
                    //방금 insert한 id 가져오기
                    $alertidx = $this->oAlertlist->getinsertid();
                    log_message('alert', "alertidx ".$alertidx); 
                    //후에 nid 나오면 img 전부 저장 고고 
                }

            }else{
                $results = false;
            }
        }else{ //좋아요 해제
            if($likeinfo[0] != ""){ //값이 있으면
                log_message('alert', "좋아요 삭제 데이터 ".json_encode($likeinfo[0]->idx));
                
                $deletearr = array();
                array_push($deletearr, $likeinfo[0]->idx);
                $results = $this->oLikenboardlist->getdelete("idx", $deletearr);
            }else{
                $results = false;
            }
        }



        $results = $this->response->setJSON(['result'  => $results, 'alertuid'  => $data['alertuid'], 'alertdocu'  => $data['alertdocu']]);
        return $results; 
    }

    // //좋아요 리스트 - 선생님 프로젝트만 가능
    // public function likelist($a, $b){

    //     log_message('alert', "likeadd".json_encode($_POST));

    //     $conditionarr = array();

    //     $conditionarr["where"]["getnid"]["logic"] = "=";
    //     $conditionarr["where"]["getnid"]["value"] = $_POST["getlikeuid"];

    //     $pagehandler = array();
    //     $pagehandler["limit"] = 0; //리스트 갯수
    //     $pagehandler["offset"] = 0; //리스트 위치 
    //     $likeinfo = $this->oLikenboardlist->getlist($conditionarr, $pagehandler);
    //     log_message('alert', "좋아요 데이터 ".json_encode($likeinfo));

    //     $results = $this->response->setJSON($likeinfo);
    //     return $results; 
    // }

}
