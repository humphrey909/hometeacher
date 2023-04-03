<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\ProfileTeacher;
use App\Models\ProfileStudent;
use App\Controllers\Upload;
use App\Models\ProfileImglist;
use App\Models\User;
use App\Models\Likeuserlist;
class Profile extends BaseController
{
    public $oProfileteacher = "";
    public $oProfilestudent = "";
    public $now = "";
    public $oProfileImglist = "";
    public $oUser = "";
    public $oLikeuserlist = "";

    public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');

        $this->oProfileteacher = new ProfileTeacher();
        $this->oProfilestudent = new ProfileStudent();
        $this->oProfileImglist = new ProfileImglist();
        $this->oUser = new User();
        $this->oLikeuserlist = new Likeuserlist();
    }


    public function index()
    {
       // echo "qweqwe";
        //return view('welcome_message');
    }

//     public function uploadimg($a,$b){
//         // "이미지 업로드";
//          log_message('alert', "이미지 업로드");
        
        
//          //$fileContent = file_get_contents($_FILES['uploaded_file']);
//          log_message('alert', json_encode($_FILES));
//          //log_message('alert', $_FILES);
//          log_message('alert', json_encode($_POST));
//         // log_message('alert', $_GET);
        


// //ALERT - 2022-06-16 20:48:22 --> {"uploaded_file1":{"name":"photo1.jpg","type":"image\/jpeg","tmp_name":"\/tmp\/phps7ki3Q","error":0,"size":80}}
// //ALERT - 2022-06-16 20:48:22 --> {"sextypeval":"1","forteachertalk":"wefwef","uid":"16","subjectypeval":"4","nicname":"fefwef","studentages":"\uc9111","availabletime":"efwefwef","usertype":"2","maxpayguide":"40"}

//     }


//유저 리스트 전부 가져오기 - 학생 선생님 나눠서 가져옴, 프로필 join
public function userlist($glimit, $goffset){
    log_message('alert', "-------userlist------------".json_encode($_POST)); 
    log_message('alert', "-------userlist------------".json_encode($_GET)); 
    log_message('alert', "-------userlist------------".json_encode($glimit)); 
    log_message('alert', "-------userlist------------".json_encode($goffset)); 
    // //android에서 던져온 값
    // $subjectlist = json_decode($_POST['subject'], true);
    // for($i = 0; $i<count($subjectlist);$i++){
    //     log_message('alert', "-------subject------------".json_encode($subjectlist[$i]));  
    // }
    // 이 값이 majorsubject에 포함되면 리스트를 뽑아낼 것.... 

    

    $conditionarr = array();
    if($_POST['usertype'] == "1"){ //선생님
        $conditionarr["feild"] = "a.idx,a.usertype,a.email,a.name,a.nicname,a.pointscore,a.classconnectnum,a.loginregdate,a.regdate,a.views,b.idx as pidx,b.getstate,b.gender,b.minpay,b.detailpaystandard,b.character,b.majorsubject,b.university,b.universitychk,b.campusaddress,b.universmajor,b.studentid,b.introduce,b.availabletime,b.subjectdocument,b.classstyle,b.skillappeal,c.idx as imgidx,c.basicuri,c.src,c.type";
    }else{
        $conditionarr["feild"] = "a.idx,a.usertype,a.email,a.name,a.nicname,a.pointscore,a.classconnectnum,a.loginregdate,a.regdate,a.views,b.idx as pidx,b.getstate,b.studentages,b.gender,b.introduce,b.majorsubject,b.maxpay,b.availabletime,b.infotalk,c.idx as imgidx,c.basicuri,c.src,c.type";
    }


    $conditionarr["where"]["c.type"]["logic"] = "=";
    $conditionarr["where"]["c.type"]["value"] = "1"; //메인 이미지만 가져옴
    $conditionarr["where"]["b.getstate"]["logic"] = "!=";
    $conditionarr["where"]["b.getstate"]["value"] = "1"; //1인 경우는 미노출 상태임. 
    
    //검색어 찾기 
    if($_POST['searchtext'] != null){
        if($_POST['usertype'] == "1"){ //선생님
            $conditionarr["where"]["b.subjectdocument"]["logic"] = "like";
            $conditionarr["where"]["b.subjectdocument"]["value"] = "'%".$_POST['searchtext']."%'"; 
        }else if($_POST['usertype'] == "2"){ //학생
            $conditionarr["where"]["b.introduce"]["logic"] = "like";
            $conditionarr["where"]["b.introduce"]["value"] = "'%".$_POST['searchtext']."%'"; 
        }
    }

    //성별 찾기 
    if($_POST['usergender'] != null){
        $conditionarr["where"]["b.gender"]["logic"] = "=";
        $conditionarr["where"]["b.gender"]["value"] = $_POST['usergender']; 
    }


    //선생 학생에 따른 필드명 변경해주는 부분
    $payfield = "";
    if($_POST['usertype'] == "1"){ //선생님
        $payfield = "minpay";
    }else if($_POST['usertype'] == "2"){ //학생
        $payfield = "maxpay";
    }
    //log_message('alert', "-------studentid------------".json_encode($_POST['usertype'])); 
    //log_message('alert', "-------studentid------------".json_encode($payfield)); 
    
    //수업료 검색
    if($_POST['minpay'] != null && $_POST['maxpay'] != null){ //둘다 값이 있는경우
        $condival = " AND ( b.".$payfield." >= ".$_POST['minpay']." and b.".$payfield." <= ".$_POST['maxpay'].")";
        $conditionarr[$this->oUser->FIXWHEREVAL] = $condival;
    }else if($_POST['minpay'] != null && $_POST['maxpay'] == null){ //최소만 있는경우
        $conditionarr["where"]["b.".$payfield]["logic"] = ">=";
        $conditionarr["where"]["b.".$payfield]["value"] = $_POST['minpay']; 
    }else if($_POST['minpay'] == null && $_POST['maxpay'] != null){ //최대만 있는경우
        $conditionarr["where"]["b.".$payfield]["logic"] = "<=";
        $conditionarr["where"]["b.".$payfield]["value"] = $_POST['maxpay']; 
    }



    //선생 학생에 따른 필드명 변경해주는 부분
    $studentidfield = "";
    if($_POST['usertype'] == "1"){ //선생님
        $studentidfield = "studentid";
    }else if($_POST['usertype'] == "2"){ //학생
        $studentidfield = "studentages";
    }
    //학번 찾기
    if($_POST['studentid'] != null){

        if($_POST['studentid'] == "04"){ //04가 아닌 전체

            $condival = "";
             for($i = 22;$i>4;$i--){
                 if($i < 10){
                    $condival .= " AND b.studentid != 0".$i;
                 }else{
                    $condival .= " AND b.studentid != ".$i;
                 }
             }
             
             log_message('alert', "-------studentid------------".json_encode($condival)); 

            $conditionarr[$this->oUser->FIXWHEREVAL] = $condival;

        }else{ 
            $conditionarr["where"]["b.studentid"]["logic"] = "=";
            $conditionarr["where"]["b.studentid"]["value"] = $_POST['studentid'];
        }
    }

    //학년 찾기
    if($_POST['studentages'] != null){
        $conditionarr["where"]["b.studentages"]["logic"] = "=";
        $conditionarr["where"]["b.studentages"]["value"] = $_POST['studentages'];
    }   

    //name 찾기  
    if($_POST['name'] != null){
        $conditionarr["where"]["a.name"]["logic"] = "like";
        $conditionarr["where"]["a.name"]["value"] = "'%".$_POST['name']."%'"; 
    }


    //닉네임 찾기  
    if($_POST['nicname'] != null){
        $conditionarr["where"]["a.nicname"]["logic"] = "like";
        $conditionarr["where"]["a.nicname"]["value"] = "'%".$_POST['nicname']."%'"; 
    }

    //출신학교 찾기
    if($_POST['university'] != null){
        $conditionarr["where"]["b.university"]["logic"] = "like";
        $conditionarr["where"]["b.university"]["value"] = "'%".$_POST['university']."%'"; 
    }


    $conditionarr["order"]["feild"] = "a.idx";
    $conditionarr["order"]["value"] = "DESC";

    $pagehandler = array();
    $pagehandler["limit"] = $glimit; //리스트 갯수
    $pagehandler["offset"] = $goffset; //리스트 위치 


    log_message('alert', "data------------------".json_encode($conditionarr));

    //uid 찾아서 데이터 가져올 것. 
    if($_POST['usertype'] == "1"){ //선생님
        $data = $this->oUser->getlist_join_teacherimg($conditionarr, $pagehandler);
    }else{ //학생
        $data = $this->oUser->getlist_join_studnetimg($conditionarr, $pagehandler);
    }
    log_message('alert', json_encode($data));


    //데이터를 다 불러온 다음 선택한 과목 리스트로 검색한다.
        $arrayselectdata = json_decode($_POST['subjectlist'], true); //선택한 데이터 json 변환
        $Changedata = array(); //검색 후 넣을 공간

        //회원 리스트
        for($i = 0; $i<count($data);$i++){

            //subjectlist //과목 리스트 검색
            if($_POST['subjectlist'] != null){


                log_message('alert', "data------------------".json_encode($data[$i]));
                log_message('alert', "data------------------".json_encode($data[$i]->majorsubject));
            // log_message('alert', "data------------------".json_encode($data[$i]->majorsubject[0]));
            
                //회원 과목 리스트
                $arraymajorsubject = json_decode($data[$i]->majorsubject, true);
                for($j = 0; $j<count($arraymajorsubject);$j++){
                    log_message('alert', "data------------------".json_encode($arraymajorsubject[$j]));

                    //선택한 과목 리스트
                    for ($k = 0; $k<count($arrayselectdata);$k++){
                        if($arraymajorsubject[$j] == $arrayselectdata[$k]){
                        
                            if (!in_array($data[$i], $Changedata)){
                                array_push($Changedata, $data[$i]);
                            }
                        }
                    
                    }
                }
            }else{
                array_push($Changedata, $data[$i]);
              //  $result = $this->response->setJSON($data);
            }
        }


//검색 데이터 추가하기 
for($i = 0; $i<count($Changedata);$i++){


}

        log_message('alert', "Search Complete data------------------".json_encode($Changedata));
        $result = $this->response->setJSON($Changedata);



    // log_message('alert', "data-----------------searchtext -".json_encode($_POST['searchtext']));
    // if($_POST['searchtext'] != null){
    //     //subjectdocument 에 해당 단어가 있는지 찾는다. 


    //     $Changedata = array(); //검색 후 넣을 공간

    //     //회원 리스트
    //     for($i = 0; $i<count($data);$i++){
    //         log_message('alert', "data------------------".json_encode($data[$i]));


    //         log_message('alert', "user subjectdocument------------------".json_encode($data[$i]->subjectdocument));
    //         log_message('alert', "searchtext------------------".json_encode($_POST['searchtext']));
           


    //         //$data[$i]->subjectdocument 여기에 $_POST['searchtext']이 단어가 있는지 찾기 
    //         if(strpos($data[$i]->subjectdocument, $_POST['searchtext']) == true){
    //             // $strposTest 변수에 'bc' 가 포함되어 있는 경우.

    //             log_message('alert', "data------------------". "true!@!!!!!!!");
    //         }
            

        
    //         //회원 과목 리스트
    //       //  $arraymajorsubject = json_decode($data[$i]->majorsubject, true);
    //         // for($j = 0; $j<count($arraymajorsubject);$j++){
    //         //     log_message('alert', "data------------------".json_encode($arraymajorsubject[$j]));

    //         //     //선택한 과목 리스트
    //         //     for ($k = 0; $k<count($arrayselectdata);$k++){
    //         //         if($arraymajorsubject[$j] == $arrayselectdata[$k]){
                    
    //         //             if (!in_array($data[$i], $Changedata)){
    //         //                 array_push($Changedata, $data[$i]);
    //         //             }
    //         //         }
                
    //         //     }
    //         // }
    //     }

    //     log_message('alert', "Search Complete data------------------".json_encode($Changedata));
    //     $result = $this->response->setJSON($Changedata);
    // }


    
    
    return $result; 
}


//유저리스트 - 사람검색에서 쓰일 것.
public function usersearchlist($glimit, $goffset){
    log_message('alert', "-------userlist-----------usersearchlist-".json_encode($_POST)); 
    log_message('alert', "-------userlist-----------usersearchlist-".json_encode($_GET)); 
    log_message('alert', "-------userlist-----------usersearchlist-".json_encode($glimit)); 
    log_message('alert', "-------userlist-----------usersearchlist-".json_encode($goffset)); 

    $conditionarr = array();
    $conditionarr["feild"] = "a.idx,a.usertype,a.email,a.name,a.nicname,a.pointscore,a.classconnectnum,a.loginregdate,a.regdate,b.idx as imgidx,b.basicuri,b.src,b.type";


    $conditionarr["where"]["b.type"]["logic"] = "=";
    $conditionarr["where"]["b.type"]["value"] = "1"; //메인 이미지만 가져옴

    //검색어 찾기 
    if($_POST['searchtext'] != null){
        $conditionarr["where"]["a.name"]["logic"] = "like";
        $conditionarr["where"]["a.name"]["value"] = "'%".$_POST['searchtext']."%'"; 
    }


    $conditionarr["order"]["feild"] = "a.idx";
    $conditionarr["order"]["value"] = "DESC";

    $pagehandler = array();
    $pagehandler["limit"] = $glimit; //리스트 갯수
    $pagehandler["offset"] = $goffset; //리스트 위치 

    $data = $this->oUser->getlist_joinimg($conditionarr, $pagehandler);


    log_message('alert', "-------userlist-----------usersearchlist!!!!!!  :".json_encode($data)); 
    $result = $this->response->setJSON($data);
    return $result; 
}



//데이터 하나씩 업데이트 하기위한 함수
public function profileupdateone($glimit, $goffset){
    log_message('alert', json_encode($_POST)); 


        //post전부 저장 
        if($_POST != null){
            //$results = $this->getdataupdate($_POST);

            //usertype
            //uid를 통해 프로필 고유번호 가져오기

            if($_POST['usertype'] == 1){ //선생님

                $conditionarr = array();
                $conditionarr["where"]["uid"]["logic"] = "=";
                $conditionarr["where"]["uid"]["value"] = $_POST['uid'];

                $pagehandler = array();
                $pagehandler["limit"] = $glimit; //리스트 갯수
                $pagehandler["offset"] = $goffset; //리스트 위치 

                $data = $this->oProfileteacher->getlist($conditionarr, $pagehandler);

                log_message('alert', json_encode($data[0]->idx));

                if($data[0]->idx != null){
                    $fieldname=array(
                        //'idx' => $json->gameplayinfo->rankid
                        'idx' => $data[0]->idx
                    );
                }

    
                $getstatearr = array('getstate' => $_POST["searchviewval"]);
                log_message('alert', "프로필 하나 업데이트 여부 ".json_encode($getstatearr));
                
                $results = $this->oProfileteacher->getupdate($fieldname, $getstatearr);

            }else{ //학생

                $conditionarr = array();
                $conditionarr["where"]["uid"]["logic"] = "=";
                $conditionarr["where"]["uid"]["value"] = $_POST['uid'];

                $pagehandler = array();
                $pagehandler["limit"] = $glimit; //리스트 갯수
                $pagehandler["offset"] = $goffset; //리스트 위치 

                $data = $this->oProfilestudent->getlist($conditionarr, $pagehandler);

                log_message('alert', json_encode($data[0]->idx));

                if($data[0]->idx != null){
                    $fieldname=array(
                        //'idx' => $json->gameplayinfo->rankid
                        'idx' => $data[0]->idx
                    );
                }

    
                $getstatearr = array('getstate' => $_POST["searchviewval"]);
                log_message('alert', "프로필 하나 업데이트 여부 ".json_encode($getstatearr));
                
                $results = $this->oProfilestudent->getupdate($fieldname, $getstatearr);

            }

            $result = $this->response->setJSON(['result'  => $results]);
    
            return $result; 
        }
}







    //이미지 글 formdata로 가져와서 업데이트
    // - 이미지는 삭제할 데이터 삭제, 이미지 추가할 데이터 추가, 텍스트 업데이트
    public function profileupdatebox($a,$b){//a,b 파라미터는 사용되는 곳은 없음. 안드로이드에서 리턴받을때 같은 형식으로 보내주기 위해서 설정함.
        log_message('alert', json_encode($_FILES)); 
        log_message('alert', json_encode($_POST)); 
      //  log_message('alert', "imgdeletelist ------------".json_encode($_POST['imgdeletelist'])); 

        //post전부 저장 
        if($_POST != null){
            $results = $this->getdataupdate($_POST);
        }

        if($_FILES != null){
            $fileresult = $this->imgupload($_FILES, $_POST['uid']);

            log_message('alert', "게시판 응답 getincre  ".$fileresult); 
        }

       // $_POST['imgdeletelist'] // delete리스트 삭제 고고 하기 
       if($_POST['imgdeletelist'] != ""){
           $this->deleteimage($_POST['imgdeletelist']);
       }
    }

    
    public function getdataupdate($Data){

        if($Data["nicname"] != null){
            //nicname 수정할 것. 
            $fieldname_user=array(
                'idx' => $Data["uid"]
            );
            $data_user=array('nicname' => $Data["nicname"]);
            $results_user = $this->oUser->getupdate($fieldname_user, $data_user);
        }

        if($Data["pidx"] != null){
            $fieldname=array(
                //'idx' => $json->gameplayinfo->rankid
                'idx' => $Data["pidx"]
            );
        }

        if($Data["usertype"] == "1"){ //선생님
            log_message('alert', "프로필 데이터 ".json_encode($Data));

            $data=array('uid' => $Data["uid"], 'gender' => $Data["sextypeval"], 'minpay' => $Data["minpayguide"], 'detailpaystandard' => $Data["payguidelinereason"], 'character' => $Data["character"], 'majorsubject' => $Data["subjectlist"], 'university' => $Data["university"], 'universitychk' => $Data["universitychk"], 'campusaddress' => $Data["campusaddress"], 'universmajor' => $Data["universmajor"], 'studentid' => $Data["studentid"], 'introduce' => $Data["onelineintroduce"], 'availabletime' => $Data["availabletime"], 'subjectdocument' => $Data["subjectdocument"], 'classstyle' => $Data["classstyle"], 'skillappeal' => $Data["skillappeal"]);
            log_message('alert', "프로필 데이터 ".json_encode($data));
            
            $results = $this->oProfileteacher->getupdate($fieldname, $data);

        }else{ //학생

            log_message('alert', "프로필 데이터 ".json_encode($Data));
            
            $data=array('uid' => $Data["uid"], 'studentages' => $Data["studentages"], 'gender' => $Data["sextypeval"], 'introduce' => $Data["onelineintroduce"], 'majorsubject' => $Data["subjectlist"], 'maxpay' =>$Data["maxpayguide"], 'availabletime' => $Data["availabletime"], 'infotalk' => $Data["infotalk"]);
            log_message('alert', "게시판 데이터 ".json_encode($data));
            
            $results = $this->oProfilestudent->getupdate($fieldname, $data);
        }
        $results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }


        //이미지 글 formdata로 가져와서 저장함
        public function profilesavebox($a,$b){ //a,b 파라미터는 사용되는 곳은 없음. 안드로이드에서 리턴받을때 같은 형식으로 보내주기 위해서 설정함.
            log_message('alert', json_encode("!!!!!!!!!!!!profilesavebox")); 
            log_message('alert', json_encode($_FILES)); 
            log_message('alert', json_encode($_POST)); 
            log_message('alert', json_encode("!!!!!!!!!!!!profilesavebox")); 

    
            //post전부 저장 
            if($_POST != null){
                $results = $this->getdatainsert($_POST);
    
                if($results == 1){
                    //방금 insert한 id 가져오기
                   // $resultsid = $this->oProfilestudent->getinsertid();
                    log_message('alert', "게시판 응답 getincre  ".$resultsid); 
                    //후에 nid 나오면 img 전부 저장 고고 
                }
            }
    
            if($_FILES != null){
                $fileresult = $this->imgupload($_FILES, $_POST['uid']);
    
                log_message('alert', "게시판 응답 getincre  ".$fileresult); 
            }
        }

    //데이터 추가
    public function getdatainsert($Data){

        if($Data["nicname"] != null){
            //nicname 수정할 것. 
            $fieldname_user=array(
                'idx' => $Data["uid"]
            );
            
            $data_user=array('nicname' => $Data["nicname"]);
            $results_user = $this->oUser->getupdate($fieldname_user, $data_user);
        }


        if($Data["usertype"] == "1"){ //선생님
            log_message('alert', "프로필 데이터 ".json_encode($Data));

            $data=array("idx" => '0', 'uid' => $Data["uid"], 'getstate' => 0, 'gender' => $Data["sextypeval"], 'minpay' => $Data["minpayguide"], 'detailpaystandard' => $Data["payguidelinereason"], 'character' => $Data["character"], 'majorsubject' => $Data["subjectlist"], 'university' => $Data["university"], 'universitychk' => $Data["universitychk"], 'campusaddress' => $Data["campusaddress"], 'universmajor' => $Data["universmajor"], 'studentid' => $Data["studentid"], 'introduce' => $Data["onelineintroduce"], 'availabletime' => $Data["availabletime"], 'subjectdocument' => $Data["subjectdocument"], 'classstyle' => $Data["classstyle"], 'skillappeal' => $Data["skillappeal"]);
            log_message('alert', "프로필 데이터 ".json_encode($data));
            
            $results = $this->oProfileteacher->getinsert($data);

        }else{ //학생

            log_message('alert', "프로필 데이터 ".json_encode($Data));
            
            $data=array("idx" => '0', 'uid' => $Data["uid"], 'getstate' => 0, 'studentages' => $Data["studentages"], 'gender' => $Data["sextypeval"], 'introduce' => $Data["onelineintroduce"], 'majorsubject' => $Data["subjectlist"], 'maxpay' =>$Data["maxpayguide"], 'availabletime' => $Data["availabletime"], 'infotalk' => $Data["infotalk"]);
            log_message('alert', "게시판 데이터 ".json_encode($data));
            
            $results = $this->oProfilestudent->getinsert($data);
        }
        $results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }

    public function imgupload($files, $uid){
        $oUpload = new Upload();

        $basicurl = "/image/profile/";

        //다중으로 가져오는 파일 정보 -- 파일 저장, 경로 db에 저장 
        //{"name":"img.png","type":"image\/png","tmp_name":"\/tmp\/phpvquFKq","error":0,"size":4052}
        $index = 0;
        foreach($files as $key => $value){
            $index++;
            log_message('alert', "file value".json_encode($value));  
            //log_message('alert', "file key".json_encode($key));  

            //        // var filename = joincode+uid+pid+"_"+year+month+day+getHours+getMinutes+getSeconds+getMilliseconds+".mp4";
            //nid 저장
            //파일명 생성해서 넘기기

            $filename = $oUpload->upload($value, $basicurl); //이미지 업로드

            log_message('alert', "img 경로".json_encode($filesrc));  


            //['idx', 'nid', 'basicuri', 'src', 'regdate'];
            $imgdata=array("idx" => '0', 'uid' => $uid, 'basicuri' => $basicurl, 'src' => $filename, 'type' => 0, 'regdate' => $this->now);

            //이미지 경로 db 저장
            //getinsert
            $reslut = $this->oProfileImglist->getinsert($imgdata);

            log_message('alert', "img result".json_encode($reslut));  
        }
        
    }

    //전체보기
    //검색 조건 : 제목검색, 내용검색, 작성자검색, 게임타입별검색
    //페이징처리 : 페이지 번호에 10개씩 자르기 $query=$builder->get(10, 20);
    //정렬 조건 : 오름차순 내림차순, 필드 이름

    //조인 처리 : uid gid 랭크id 있으면 rankid
    public function getdata($glimit, $goffset){
        //[{"fieldname":"a.gid","fieldlogic":"=","fieldval":"2"}]
        $json=json_decode(file_get_contents('php://input'));
        //log_message('alert', json_encode($json));
        $json=$json->data;

        log_message('alert', "선택 데이터 ");
        log_message('alert', json_encode($json));
        //log_message('alert', json_encode(count($json)));

        $conditionarr = array();
        $conditionarr["feild"] = "a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info";
        

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
        $conditionarr["order"]["value"] = "DESC";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $results = $this->oNboardlist->getlist_join($conditionarr, $pagehandler);
	    
	    log_message('alert', json_encode($results));
	    $response = $this->response->setJSON($results);

	    return $response;
    }


        //info 검색 처리 : ntype으로 조절
        public function getdatainfoone($glimit, $goffset){
            log_message('alert', json_encode($_POST));
            //log_message('alert', json_encode($_FILES));
            //{"uid":"15","usertype":"1"}

            if($_POST['viewsup'] == 1){
                $this->viewsupdate($_POST['uid']);
            }
           


            $conditionarr = array();
            if($_POST['usertype'] == "1"){ //선생님
                $conditionarr["feild"] = "a.idx,a.usertype,a.email,a.name,a.nicname,a.pointscore,a.classconnectnum,a.loginregdate,a.regdate,a.views,b.idx as pidx,b.getstate,b.gender,b.minpay,b.detailpaystandard,b.character,b.majorsubject,b.university,b.universitychk,b.campusaddress,b.universmajor,b.studentid,b.introduce,b.availabletime,b.subjectdocument,b.classstyle,b.skillappeal";
            }else{
                $conditionarr["feild"] = "a.idx,a.usertype,a.email,a.name,a.nicname,a.pointscore,a.classconnectnum,a.loginregdate,a.regdate,a.views,b.idx as pidx,b.getstate,b.studentages,b.gender,b.introduce,b.majorsubject,b.maxpay,b.availabletime,b.infotalk";
            }


            $conditionarr["where"]["a.idx"]["logic"] = "=";
            $conditionarr["where"]["a.idx"]["value"] = $_POST['uid'];

            $conditionarr["order"]["feild"] = "a.idx";
            $conditionarr["order"]["value"] = "DESC";

            $pagehandler = array();
            $pagehandler["limit"] = $glimit; //리스트 갯수
            $pagehandler["offset"] = $goffset; //리스트 위치 
    
            //log_message('alert', "55555555555555  ".json_encode($conditionarr));


            //유저정보까지 join해서 가져오는게 맞을 듯...

            //uid 찾아서 데이터 가져올 것. 
            if($_POST['usertype'] == "1"){ //선생님

                $data = $this->oUser->getlist_join_teacher($conditionarr, $pagehandler);

            }else{ //학생
                $data = $this->oUser->getlist_join_studnet($conditionarr, $pagehandler);
            }
            log_message('alert', json_encode($data));

            $result = $this->response->setJSON($data);

            return $result; 
        }


        //조회수 1을 업 한다. 
        public function viewsupdate($uid){

            $info = $this->oUser->getdataone($uid); //회원정보 가져오기
            $infoviews = intval($info[0] -> views);
 
            $views = $infoviews+1;

            //조회수 수정할 것. 
            $fieldname_user=array(
                'idx' => $uid
            );
            
            $data_user=array("views" => $views);
            $results_user = $this->oUser->getupdate($fieldname_user, $data_user);

        }




        //이미지 가져오기 함수.
        public function getdataimg($glimit, $goffset){
            log_message('alert', json_encode($_POST));

            
            $conditionarr = array();
            // if($_POST['usertype'] == "1"){ //선생님
            //     $conditionarr["feild"] = "a.idx,a.usertype,a.pid,a.email,a.name,a.nicname,a.pointscore,a.classconnectnum,a.loginregdate,a.regdate,b.getstate,b.gender,b.minpay,b.detailpaystandard,b.character,b.majorsubject,b.university,b.universitychk,b.campusaddress,b.universmajor,b.studentid,b.introduce,b.availabletime,b.subjectdocument,b.classstyle,b.skillappeal,b.views";
            // }else{
            //     $conditionarr["feild"] = "a.idx,a.usertype,a.pid,a.email,a.name,a.nicname,a.pointscore,a.classconnectnum,a.loginregdate,a.regdate,b.getstate,b.studentages,b.gender,b.introduce,b.majorsubject,b.maxpay,b.availabletime,b.infotalk,b.views";
            // }


            $conditionarr["where"]["uid"]["logic"] = "=";
            $conditionarr["where"]["uid"]["value"] = $_POST['uid'];
            if($_POST['imgtype'] != null){
                $conditionarr["where"]["type"]["logic"] = "=";
                $conditionarr["where"]["type"]["value"] = $_POST['imgtype'];
            }
  

            $conditionarr["order"]["feild"] = "idx";
            $conditionarr["order"]["value"] = "desc";

            $pagehandler = array();
            $pagehandler["limit"] = $glimit; //리스트 갯수
            $pagehandler["offset"] = $goffset; //리스트 위치 

            $data = $this->oProfileImglist->getlist($conditionarr, $pagehandler);

            log_message('alert', json_encode($data));

            $result = $this->response->setJSON($data);

            return $result; 
        }


    //프로필 이미지 데이터 리스트 삭제하기 
    public function deleteimage($deletelist){
        log_message('alert', "deletelist  ".json_encode($deletelist));
        
        $deletearr = substr($deletelist, 1);
        $deletearr = substr($deletearr, 0, -1);
        $deletearr = str_replace(" ", "", $deletearr); 
        //deletef리스트 "17,14"이거 풀어서 어레이로 묵기 !!!
        $deletelistarr = explode(",", $deletearr);
        log_message('alert', "deletelist  ".json_encode($deletelistarr));

        $list = $this->oProfileImglist->getdelete("idx", $deletelistarr);
    }


    //메인 프로필 이미지 저장 (이미지 단일저장)
    public function mainprofilesavebox($glimit, $goffset){
        log_message('alert', "mainprofilesavebox  ".json_encode($_POST));
        log_message('alert', "mainprofilesavebox  ".json_encode($_FILES));



        //uid, type=1 프로필 이미지 값이 존재하면 upload 
        //존재하지 안으면 insert 

        $conditionarr = array();

        $conditionarr["where"]["uid"]["logic"] = "=";
        $conditionarr["where"]["uid"]["value"] = $_POST['uid'];
        $conditionarr["where"]["type"]["logic"] = "=";
        $conditionarr["where"]["type"]["value"] = "1";

        $pagehandler = array();
        $pagehandler["limit"] = $glimit; //리스트 갯수
        $pagehandler["offset"] = $goffset; //리스트 위치 
        $data = $this->oProfileImglist->getlist($conditionarr, $pagehandler);
        
        log_message('alert', "메인 프로필 응답 getincre  ".json_encode($data)); 

       // $type = 0; //수정 삭제 여부
       // if($data[0] == null){ //존재하지 않음 - insert
       //     $type = 1;
       // }else{ //존재 - update
       //     $type = 2;
       // } 
        //log_message('alert', "메인 프로필 응답 getincre  ".json_encode($data[0]->idx)); 
        if($_FILES != null){
            $fileresult = $this->imguploadone($_FILES, $_POST['uid'], $data[0]); // type = 1 메인 프로필 이미지

            log_message('alert', "메인 프로필 응답 getincre  ".$fileresult); 
        }
    }

    public function imguploadone($files, $uid, $data){
        $oUpload = new Upload();

        $basicurl = "/image/profile/";

        //다중으로 가져오는 파일 정보 -- 파일 저장, 경로 db에 저장 
        //{"name":"img.png","type":"image\/png","tmp_name":"\/tmp\/phpvquFKq","error":0,"size":4052}
       // $index = 0;
        foreach($files as $key => $value){
           // $index++;
            log_message('alert', "file value".json_encode($value));  
            //log_message('alert', "file key".json_encode($key));  

            //        // var filename = joincode+uid+pid+"_"+year+month+day+getHours+getMinutes+getSeconds+getMilliseconds+".mp4";
            //nid 저장
            //파일명 생성해서 넘기기

            $filename = $oUpload->upload($value, $basicurl); //이미지 업로드

            log_message('alert', "img 경로".json_encode($filesrc));  


            //['idx', 'nid', 'basicuri', 'src', 'regdate'];
           

            //이미지 경로 db 저장
            if($data == null){ //저장
                $imgdata=array("idx" => '0', 'uid' => $uid, 'basicuri' => $basicurl, 'src' => $filename, 'type' => 1, 'regdate' => $this->now);
                $reslut = $this->oProfileImglist->getinsert($imgdata);
            }else{ //업데이트
                $fieldname=array(
                    //'idx' => $json->gameplayinfo->rankid
                    'idx' => $data->idx
                );

                $imgdata=array('uid' => $uid, 'basicuri' => $basicurl, 'src' => $filename, 'type' => 1, 'regdate' => $this->now);
                $reslut = $this->oProfileImglist->getupdate($fieldname, $imgdata);
            }
            //$reslut = $this->oProfileImglist->getinsert($imgdata);

            log_message('alert', "img result".json_encode($reslut));  
        }
    }
 
    
    //계정 수정
    public function setaccount($a, $b){
        log_message('alert', "updateaccount".json_encode($_POST));
        log_message('alert', "updateaccount".json_encode($_POST['uid']));
        log_message('alert', "updateaccount".json_encode($_POST['value']));
        // {"uid":"15","field":"name","value":"hujmwefwe"}      


         //nicname 수정할 것. 
        $fieldname_user=array(
            'idx' => $_POST["uid"]
        );
        
        $data_user=array($_POST["field"] => $_POST["value"]);
        $results_user = $this->oUser->getupdate($fieldname_user, $data_user);

    }

    //현재 비밀번호 체크 후 변경
    public function changepw($a, $b){
        log_message('alert', "updateaccount".json_encode($_POST));
        //{"uid":"15","newpw":"wlgns1466!","originpw":"123123123"}

        if($_POST != null){

            //로그인 체크 - 1 로그인 된 상태, 0 로그아웃된 상태
            if($_POST["loginchk"] == 1){ //로그인된 상태에서 비밀번호 변경
            
                $info = $this->oUser->getdataone($_POST["uid"]);
            
                $originpassword_hash = hash("sha256", $_POST["originpw"]); //작성한 오리지널 비밀번호
                $dbpw = $info[0] -> password; //db에 있는 비밀번호 
                if($dbpw != $originpassword_hash){ //같지않으면 미통과
    
                    $results = $this->response->setJSON(['result'  => false]);
                }else{  //같아야 통과
                    
                    $newpassword_hash = hash("sha256", $_POST["newpw"]); //작성한 새 비밀번호
                    $fieldname=array(
                        'idx' => $_POST["uid"]
                    );
                    $data = array('password' => $newpassword_hash);
                    $result = $this->oUser->getupdate($fieldname, $data);
    
                    $results = $this->response->setJSON(['result'  => true]);
                }

            }else if($_POST["loginchk"] == 0){ //로그아웃된 상태에서 비밀번호 변경
                //$_POST["CertifyEmail"] - 회원 고유번호 찾기
                $userinfo = $this->oUser->getdatatoemail($_POST["CertifyEmail"]);
                log_message('alert', "userinfo".json_encode($userinfo[0]->idx));
                    
                $newpassword_hash = hash("sha256", $_POST["newpw"]); //작성한 새 비밀번호
                $fieldname=array(
                    'idx' => $userinfo[0]->idx
                );
                $data = array('password' => $newpassword_hash);
                $result = $this->oUser->getupdate($fieldname, $data);
    
                $results = $this->response->setJSON(['result'  => true]);
            }
        }
        
        //기존패스워드 확인

        //-> 틀리면 false 리턴
        //-> 맞으면 newpw으로 변경 후 true 리턴


        return $results;
    }

    //닉네임 중복체크
    public function nicnameoverlab($a, $b){
        log_message('alert', "nicnameoverlab".json_encode($_POST));
        //nicnameoverlab{"writenicname":"jojo2211wwef","uid":"15"}

        $overlapchk = $this->oUser->getnicnameoverlab($_POST['uid'], $_POST['writenicname']);
		$arr = array('result' => $overlapchk);
		
		return json_encode($arr);
    }

    //좋아요 추가
    public function likeadd($a, $b){
        log_message('alert', "likeadd".json_encode($_POST));

        $conditionarr = array();

        $conditionarr["where"]["giveuid"]["logic"] = "=";
        $conditionarr["where"]["giveuid"]["value"] = $_POST["uid"];
        $conditionarr["where"]["getuid"]["logic"] = "=";
        $conditionarr["where"]["getuid"]["value"] = $_POST["getlikeuid"];

        $pagehandler = array();
        $pagehandler["limit"] = 0; //리스트 갯수
        $pagehandler["offset"] = 0; //리스트 위치 
        $likeinfo = $this->oLikeuserlist->getlist($conditionarr, $pagehandler);
        log_message('alert', "좋아요 데이터 ".json_encode($likeinfo));



        if($_POST["liketype"] == 1){ //좋아요 클릭
            if($likeinfo[0] == ""){ //값이 없을때만 
                $data=array("idx" => '0', 'giveuid' => $_POST["uid"], 'getuid' => $_POST["getlikeuid"], 'regdate' => $this->now);
                log_message('alert', "프로필 데이터 ".json_encode($data));
        
                $results = $this->oLikeuserlist->getinsert($data);
            }else{
                $results = false;
            }
        }else{ //좋아요 해제
            if($likeinfo[0] != ""){ //값이 있으면
                log_message('alert', "좋아요 삭제 데이터 ".json_encode($likeinfo[0]->idx));
                
                $deletearr = array();
                array_push($deletearr, $likeinfo[0]->idx);
                $results = $this->oLikeuserlist->getdelete("idx", $deletearr);
            }else{
                $results = false;
            }
        }



        $results = $this->response->setJSON(['result'  => $results]);
        return $results; 
    }

    //좋아요 리스트 - 선생님 프로젝트만 가능
    public function likelist($a, $b){

        log_message('alert', "likeadd".json_encode($_POST));

        $conditionarr = array();

        //$conditionarr["where"]["giveuid"]["logic"] = "=";
        //$conditionarr["where"]["giveuid"]["value"] = $_POST["uid"];
        $conditionarr["where"]["getuid"]["logic"] = "=";
        $conditionarr["where"]["getuid"]["value"] = $_POST["getlikeuid"];

        $pagehandler = array();
        $pagehandler["limit"] = 0; //리스트 갯수
        $pagehandler["offset"] = 0; //리스트 위치 
        $likeinfo = $this->oLikeuserlist->getlist($conditionarr, $pagehandler);
        log_message('alert', "좋아요 데이터 ".json_encode($likeinfo));

        $results = $this->response->setJSON($likeinfo);
        return $results; 
    }

        //좋아요 리스트 - 선생님만 가능
        //찜한 선생님 목록
        //나를 찜한 학생
        //로그인한자의 유저타입을 같이 보낼까? 선생님이면 나를 찜한학생, 학생이면 찜한 선생님목록/
        public function likelistjoin($a, $b){

            log_message('alert', "likeadd".json_encode($_POST));
    
            $conditionarr = array();
            if($_POST['usertype'] == "1"){ //선생님 : 학생 데이터 가져오기
                //,b.idx as pidx,b.getstate,b.studentages,b.gender,b.introduce,b.majorsubject,b.maxpay,b.availabletime,b.infotalk,b.views,c.idx as imgidx,c.basicuri,c.src,c.type,c.regdate
                $conditionarr["feild"] = "a.idx, a.giveuid, a.getuid, a.regdate,b.idx as uid, b.usertype,b.email,b.name,b.nicname,b.pointscore,b.classconnectnum,b.loginregdate,b.regdate,b.views, c.idx as pidx,c.getstate,c.studentages,c.gender,c.introduce,c.majorsubject,c.maxpay,c.availabletime,c.infotalk,d.idx as imgidx,d.basicuri,d.src,d.type";

                $conditionarr["where"]["a.getuid"]["logic"] = "=";
                $conditionarr["where"]["a.getuid"]["value"] = $_POST["uid"];
                $conditionarr["where"]["d.type"]["logic"] = "=";
                $conditionarr["where"]["d.type"]["value"] = "1"; //메인 이미지만 가져옴
                $conditionarr["where"]["c.getstate"]["logic"] = "!=";
                $conditionarr["where"]["c.getstate"]["value"] = "1"; //1인 경우는 미노출 상태임. 

                $pagehandler = array();
                $pagehandler["limit"] = 0; //리스트 갯수
                $pagehandler["offset"] = 0; //리스트 위치 
                $likeinfo = $this->oLikeuserlist->getlist_join_studnetimg($conditionarr, $pagehandler);
                log_message('alert', "좋아요 데이터 ".json_encode($likeinfo));                


            }else{ //학생 : 선생님 데이터 가져오기
                $conditionarr["feild"] = "a.idx, a.giveuid, a.getuid, a.regdate,b.idx as uid, b.usertype,b.email,b.name,b.nicname,b.pointscore,b.classconnectnum,b.loginregdate,b.regdate,b.views,c.idx as pidx,c.getstate,c.gender,c.minpay,c.detailpaystandard,c.character,c.majorsubject,c.university,c.universitychk,c.campusaddress,c.universmajor,c.studentid,c.introduce,c.availabletime,c.subjectdocument,c.classstyle,c.skillappeal,d.idx as imgidx,d.basicuri,d.src,d.type";
            
                $conditionarr["where"]["a.giveuid"]["logic"] = "=";
                $conditionarr["where"]["a.giveuid"]["value"] = $_POST["uid"];
                $conditionarr["where"]["d.type"]["logic"] = "=";
                $conditionarr["where"]["d.type"]["value"] = "1"; //메인 이미지만 가져옴
                $conditionarr["where"]["c.getstate"]["logic"] = "!=";
                $conditionarr["where"]["c.getstate"]["value"] = "1"; //1인 경우는 미노출 상태임. 

                $pagehandler = array();
                $pagehandler["limit"] = 0; //리스트 갯수
                $pagehandler["offset"] = 0; //리스트 위치 
                $likeinfo = $this->oLikeuserlist->getlist_join_teacherimg($conditionarr, $pagehandler);
                log_message('alert', "좋아요 데이터 ".json_encode($likeinfo));
        
            }


            log_message('alert', "likeinfo------------------".json_encode($likeinfo));



    //데이터를 다 불러온 다음 선택한 과목 리스트로 검색한다.
    //subjectlist //과목 리스트 검색
    if($_POST['subjectlist'] != null){
        $arrayselectdata = json_decode($_POST['subjectlist'], true); //선택한 데이터 json 변환

        $Changedata = array(); //검색 후 넣을 공간

        //회원 리스트
        for($i = 0; $i<count($likeinfo);$i++){
            log_message('alert', "likeinfo------------------".json_encode($likeinfo[$i]->majorsubject));
            log_message('alert', "likeinfo------------------".json_encode($likeinfo[$i]->majorsubject[0]));
        
            //회원 과목 리스트
            $arraymajorsubject = json_decode($likeinfo[$i]->majorsubject, true);
            for($j = 0; $j<count($arraymajorsubject);$j++){
                log_message('alert', "likeinfo------------------".json_encode($arraymajorsubject[$j]));

                //선택한 과목 리스트
                for ($k = 0; $k<count($arrayselectdata);$k++){
                    if($arraymajorsubject[$j] == $arrayselectdata[$k]){
                    
                        if (!in_array($likeinfo[$i], $Changedata)){
                            array_push($Changedata, $likeinfo[$i]);
                        }
                    }
                
                }
            }
        }

        log_message('alert', "Search Complete data------------------".json_encode($Changedata));
        $results = $this->response->setJSON($Changedata);
    }else{
        $results = $this->response->setJSON($likeinfo);
    }












            //$results = $this->response->setJSON($likeinfo);
            return $results; 
        }
}
