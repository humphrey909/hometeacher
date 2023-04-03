<?php 


namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;
use CodeIgniter\I18n\Time;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';

//Load Composer's autoloader
require '../vendor/autoload.php';

class Join extends BaseController
{
    public $oUser = "";
    public $now = "";
	public function __construct()
    {
        $this->oUser = new User();
        $this->now = Time::now('Asia/Seoul', 'en_US');
        
    }
    
    public function index()
    {
        return view("../../../svelte/public/index.html");
    }
    public function joinstart(){
       // $json=json_decode(file_get_contents('php://input'));
        //$json=$json->data;

        log_message('alert', "joindata ".json_encode($_POST));
        
        //$json->email 중복 확인하기
        //$emailchk = $this->oUser->getdataone_email($json->email);
        //이메일 중복확인
        //$overlap = $this->mailoverlab($_POST['email']);
       // $overlapval = json_decode($overlap);
       // echo $overlapval->result;
            
        //if($overlapval->result == false){ //중복된 값이 없음

            $password_hash = hash("sha256", $_POST['password']);
            $data_ = array(
                "idx" => '0',
                "usertype" => $_POST['usertype'],
                "email" => $_POST['email'], 
                "password" => $password_hash, 
                "name" => $_POST['name'], 
                "nicname" => $_POST['nicname'], 
                "pointscore" => 0, 
                "classconnectnum" => 0, 
                "loginregdate" => $this->now,  
                "regdate" => $this->now
            );
            log_message('alert', "joindata ".json_encode($data_));
            //echo json_decode($data_);
            $results = $this->oUser->getinsert($data_);


        // if($emailchk == null){
        //     $password_hash = hash("sha256", $json->pw2);
        //     $data=array("idx" => '0', 'email' => $json->email, 'password' => $password_hash, 'name' => $json->nic, 'regdate' => $this->now);

        //     $results = $this->oUser->getinsert($data);
        // }else{
        //     $results = false;
        // }

        //저장이 됐으면 해당 id를 가져와서 프론트로 던짐. 
        if($results == true){
            //방금 insert 시킨 idx 가져오기 
            $insertid = $this->oUser->getinsertid();
            log_message('alert', "insertid ".json_encode($insertid));

            //idx로 값 가져오기 $insertid
            $usrdata = $this->oUser->getdataone($insertid);
        }

        //$result = $this->response->setJSON(['result'  => $results, 'idx' => $userinfo[0]->idx, 'id' => $userinfo[0]->email]);
        $result = $this->response->setJSON(['result'  => $results, 'idx' => $usrdata[0]->idx, 'id' => $usrdata[0]->email, 'usertype' => $usrdata[0]->usertype, 'name' => $usrdata[0] -> name, 'nicname' => $usrdata[0] -> nicname, 'loginregdate' => $usrdata[0] -> loginregdate]);

        return $result; 
    }
    public function usrupadate(){
        $json=json_decode(file_get_contents('php://input'));
        $json=$json->data;

        log_message('alert', "joindata ".json_encode($json));

        //$data=array("idx" => '0', 'email' => $json->email, 'password' => $json->pw2, 'name' => $json->nic, 'regdate' => $this->now);


        $fieldname=array(
            'idx' => $json->idx
        );
        if($json->password != null){
            //$json->password 암호화 처리할 것. 
            $password_hash = hash("sha256", $json->password);
            $data=array('password' => $password_hash, 'name' => $json->name);
        }else{
            $data=array('name' => $json->name);
        }
        
        $results = $this->oUser->getupdate($fieldname, $data);

        $results = $this->response->setJSON(['result'  => $results]);

        return $results; 
    }    





    public function accountmail()
    {
        
        log_message('alert', "아이디는? ".$_POST["sendemail"]);
        if($_GET["type"] == "1"){

            //$_POST["certifytype"] // 1 = 회원가입, 2 = 비밀번호찾기 //회원가입에서는 이메일이 없어야 하고, 비밀번호 찾기에서는 이메일이 등록되어 있어야함.

            if($_POST["sendemail"] != null){ //데이터가 존재 

                if($_POST["certifytype"] == "1"){ //회원가입일때 
                    //이메일 중복확인
                    $overlap = $this->mailoverlab($_POST["sendemail"]);
                    $overlapval = json_decode($overlap);
                    if($overlapval->result == false){ //db에 아이디 값이 존재하지 않음
                        $CertificationNumber = $this->mailsender($_POST["sendemail"], "회원가입");
                        $resultarr = array('result' => "true", 'CertifiNumber' => $CertificationNumber, 'CertificationEmail' => $_POST["sendemail"]);

                    }else{ //db에 아이디 값이 존재
                        $resultarr = array('result' => "false", 'err' => 'overlab mail');
                    }
                }else if($_POST["certifytype"] == "2"){ //비밀번호 찾기일때


                    //이메일 중복확인
                    $overlap = $this->mailoverlab($_POST["sendemail"]);
                    $overlapval = json_decode($overlap);
                    if($overlapval->result == false){ //db에 아이디 값이 존재하지 않음
                        $resultarr = array('result' => "false", 'err' => 'no user');
                    }else{ //db에 아이디 값이 존재
                        $CertificationNumber = $this->mailsender($_POST["sendemail"], "비밀번호 찾기");
                        $resultarr = array('result' => "true", 'CertifiNumber' => $CertificationNumber, 'CertificationEmail' => $_POST["sendemail"]);
                    }
                }
            }else{
                $resultarr = array('result' => "false", 'err' => 'no email');
            }

           // echo json_encode($result);
            $results = $this->response->setJSON($resultarr);

            return $results; 
        }
    }


    	//이메일 중복 체크
	public function mailoverlab($tomail){

        $overlapchk = $this->oUser->getdataone_email($tomail);
		$arr = array('result' => $overlapchk);
		
		return json_encode($arr);
	}

    	//이메일 전송
        public function mailsender($to, $document, $type=0, $file="", $cc="", $bcc=""){
		
                    $CertificationNumber = $this->getRandStr(6); //인증번호 생성
    
    
    
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);
    
                    try {
                        //Server settings
                        $mail->SMTPDebug = 0;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = "smtp.naver.com";                      //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'wlgns1858';                     //SMTP username
                        $mail->Password   = 'zikx4489!';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
                        //Recipients
                        $mail->setFrom('wlgns1858@naver.com', 'hometeacher');
                        $mail->addAddress($to, 'User');     //Add a recipient
                        $mail->addAddress($to);               //Name is optional
                        //$mail->addReplyTo('info@example.com', 'Information');
                        //$mail->addCC('cc@example.com');
                        //$mail->addBCC('bcc@example.com');
    
                        //Attachments
                        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
                        //Content
                        //$mail->isHTML(true);                                  //Set email format to HTML
                        $mail->CharSet = 'UTF-8';
                        $mail->Subject = "HomeTeacher 인증번호 입니다.";
                        $mail->Body    = "안녕하세요. HomeTeahcer 입니다. ".$document." 인증번호를 입력해주시기 바랍니다. 인증번호는 ".$CertificationNumber." 입니다 !";
                        $mail->AltBody = '';
    
                        $mail->send();
    
                        //$arr = array('result' => "true", 'CertifiNumber' => $CertificationNumber);
                        return $CertificationNumber;


                        //echo 'Message has been sent';
                    } catch (Exception $e) {
                        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
        }
    
        function getRandStr($length) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
}
