<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;
use CodeIgniter\I18n\Time;
use App\Models\Gameranklist;
use App\Models\Autologinlist;
use CodeIgniter\Cookie\Cookie;
use DateTime;
class Login extends BaseController
{
    public $oUser = "";
    public $oGameranklist = "";
    public $oAutologinlist = "";
    public $now = "";

	public function __construct()
    {
        $this->oUser = new User();
        $this->oGameranklist = new Gameranklist();
        $this->oAutologinlist = new Autologinlist();
        $this->now = Time::now('Asia/Seoul', 'en_US');
    }
    
    public function index()
    {

        $sessionval = $this->oUser->session_get();
       // $sessionval = $this->session_get();
        log_message('alert', "세션 ".json_encode($sessionval));
        log_message('alert', "세션 ".json_encode($sessionval["logged_in"]));

        return view("../../../svelte/public/index.html");
    }

    //내 정보를 가져온다. - 세션체트해서 내 값을 가져오는 것 
    public function selectme(){
        //$sessionval = $this->oUser->session_get();
        //log_message('alert', "세션 idx ".json_encode($sessionval));
        //log_message('alert', "세션 idx ".json_encode($sessionval["idx"]));
        //log_message('alert', "세션 idx ".json_encode($sessionval["idx"]));
        
        log_message('alert', "세션 type ".$_GET["type"]);
        log_message('alert', "세션 idx ".$_POST["idx"]);

        if($_POST["idx"] != null){
            $info = $this->oUser->getdataone($_POST["idx"]);

            log_message('alert', "세션 idx ".json_encode($info));
            log_message('alert', "세션 idx ".json_encode($info[0]));
            log_message('alert', "세션 idx ".json_encode($info[0] -> idx));
            log_message('alert', "세션 idx ".json_encode($info[0] -> email));
           // log_message('alert', "세션 idx ".json_encode($info));

         $results = $this->response->setJSON(['result'  => true, 'idx' => $info[0] -> idx, 'usertype' => $info[0] -> usertype, 'pid' => $info[0] -> pid, 'email' => $info[0] -> email, 'name' => $info[0] -> name, 'nicname' => $info[0] -> nicname, 'pointscore' => $info[0] -> pointscore, 'classconnectnum' => $info[0] -> classconnectnum, 'loginregdate' => $info[0] -> loginregdate, 'regdate' => $info[0] -> regdate, 'views' => $info[0] -> views]);
        }else{
            $results = $this->response->setJSON(['result'  => false]);
            //$info = false;
        }
        
        

        
        

        return $results;
    }

    //자동 로그인 처리 
    public function autologin(){
        $json=json_decode(file_get_contents('php://input'));
        $json=$json->data;
        log_message('alert', "세션 아이디 정보 ".json_encode($json));
        log_message('alert', "세션 아이디 정보 ".json_encode($json->data));
        log_message('alert', "세션 아이디 정보 ".json_encode($json->data->sessionidval));
        //{"data":{"sessionidval":"54gbuc85atmmbpa1oalee33g0ocf7kpk"}}



        //$json->data->sessionidval 이 정보로 데이터 찾기 
        $conditionarr = array();
        $conditionarr["where"][$json->fieldname]["logic"] = $json->fieldlogic;
        $conditionarr["where"][$json->fieldname]["value"] = "'".$json->fieldval."'";

        log_message('alert', "55555555555555  ".json_encode($conditionarr));
        $sessionresult = $this->oAutologinlist->getlist($conditionarr, '');

        log_message('alert', "저장된 세션 정보들 ".json_encode($sessionresult));
        log_message('alert', "저장된 세션 정보들 ".json_encode($sessionresult[0]));
        log_message('alert', "저장된 세션 정보들 ".json_encode($sessionresult[0]->uid)); //uid 정보


        //id pw 가져오기
        //
        $uidresult = $this->oUser->getdataone($sessionresult[0]->uid);
        log_message('alert', "유저 정보다.  ".json_encode($uidresult)); //uid 정보
        log_message('alert', "유저 정보다. ".json_encode($uidresult[0]->email)); //uid 정보
        log_message('alert', "유저 정보다. ".json_encode($uidresult[0]->password)); //uid 정보


        $usrdata = $this->oUser->loginchk($uidresult[0]->email, $uidresult[0]->password);
        if($usrdata == null){
            log_message('alert', "자동로그인 - 없는 회원");
            $results = $this->response->setJSON(['result'  => false]);
        }else{
            log_message('alert', "자동로그인 - ".$usrdata);
            $sessiondata = $this->session_save($usrdata); //세션 저장 
            $results = $this->response->setJSON(['result'  => $sessiondata]);
        }




        return $results;
    }

    //로그인을 진행한다. 
    public function loginstart(){

      log_message('alert', "type ? ".$_GET["type"]);
      log_message('alert', "아이디는? ".$_POST["email"]);
      log_message('alert', $_POST["password"]);


        $emailchk = $this->oUser->getdataone_email($_POST["email"]);

        if($emailchk){ //아이디 존재

            //로그인 체크 
            $password_hash = hash("sha256", $_POST["password"]);
            $usrdata = $this->oUser->loginchk($_POST["email"], $password_hash);
            log_message('alert', json_encode($usrdata));

            if($usrdata == null){
                log_message('alert', "맞지않는 비밀번호");
                $results = $this->response->setJSON(['result'  => false, 'err' => 'wrong password']);
            }else{
                log_message('alert', json_encode($usrdata));
    
                $results = $this->response->setJSON(['result'  => true, 'idx' => $usrdata[0]->idx, 'id' => $usrdata[0]->email, 'usertype' => $usrdata[0]->usertype, 'name' => $usrdata[0] -> name, 'nicname' => $usrdata[0] -> nicname, 'loginregdate' => $usrdata[0] -> loginregdate]);
            }

        }else{ //아이디 존재하지 않음

            log_message('alert', "없는 회원");
            $results = $this->response->setJSON(['result'  => false, 'err' => 'no user']);
        }

        // //로그인 체크 
        // $password_hash = hash("sha256", $_POST["password"]);
        // $usrdata = $this->oUser->loginchk($_POST["email"], $password_hash);
        // log_message('alert', json_encode($usrdata));

        // if($usrdata == null){
        //     log_message('alert', "없는 회원");
        //     $results = $this->response->setJSON(['result'  => false, 'err' => 'no user']);
        // }else{
        //     //$data = $this->oUser->session_destroy(); //기존 세션 파기

        //     log_message('alert', json_encode($usrdata));

        //     $results = $this->response->setJSON(['result'  => true, 'idx' => $usrdata[0]->idx, 'id' => $usrdata[0]->email, 'usertype' => $usrdata[0]->usertype, 'pid' => $usrdata[0]->pid, 'name' => $usrdata[0] -> name, 'nicname' => $usrdata[0] -> nicname, 'loginregdate' => $usrdata[0] -> loginregdate]);
        // }
        return $results;
    }

    //로그아웃 진행한다.
    public function logoutstart(){
        $json=json_decode(file_get_contents('php://input'));
        $json=$json->data;
        log_message('alert', json_encode($json));

         //json으로 변환
        //

        $data = $this->oUser->session_remove(); //데이터 삭제 
        $data = $this->oUser->session_destroy(); //데이터 파기
        //파기를 안시키니까 세션 아이디를 그대로 사용함. 

        log_message('alert', "삭제 uid".json_encode($json));//$json->uid

        $uidarr = array($json->uid);
        $sessionresult = $this->oAutologinlist->getdelete("uid", $uidarr);

        $results = $this->response->setJSON(['result'  => $sessionresult]);
        //$results = $this->response->setJSON(false);

        return $results;
    }

    //세션 저장 후 가져오기
    public function session_save($usrdata){
        $session = session();
        $sessiondata = [
            'idx'  => $usrdata[0]->idx,
            'email'     => $usrdata[0]->email,
            'name'     => $usrdata[0]->name,
            'logged_in' => true
        ];
        $session->set($sessiondata); //세션 저장

        log_message('alert', json_encode($usrdata[0]->email));

        $data = $this->oUser->session_get();
        return $data;
    }


    public function session_get(){
	    //$this->oUser = new User();
        $data = $this->oUser->session_get();
	    return $this->response->setJSON($data);
    }
    public function session_remove(){
	    //$this->oUser = new User();
        $data = $this->oUser->session_remove();
	    return $this->response->setJSON($data);
    }
    public function session_destroy(){
	    //$this->oUser = new User();
        //$data = $this->oUser->session_remove();
        $data = $this->oUser->session_destroy();
	    return $this->response->setJSON($data);
    }
    public function cookie_get(){
        //$_COOKIE
        log_message('alert', json_encode($_COOKIE));
        $data = $_COOKIE;
	    //$this->oUser = new User();
        //$data = $this->oUser->session_remove();
        //$data = $this->oUser->session_destroy();
	    return $this->response->setJSON($data);
    }


    public function getdata(){

        $results = $this->oUser->get_query();
	    
	    log_message('alert', json_encode($results));
	    $response = $this->response->setJSON($results);
	    return $response;
    } 
}
