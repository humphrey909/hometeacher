<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
//use App\Models\Main_model;
use App\Models\Fcmtokenlist;
use App\Models\Alertlist;
use CodeIgniter\I18n\Time;
class Notification extends BaseController
{
    public $oFcmtokenlist = "";
    public $oAlertlist = "";
    public $now = "";
	public function __construct()
    {
        $this->now = Time::now('Asia/Seoul', 'en_US');
        $this->oFcmtokenlist = new Fcmtokenlist();
        $this->oAlertlist = new Alertlist();
    }
    
    public function send($a, $b)
    {

        log_message('alert', "-------Fcm send------------".json_encode($_POST)); 
        
        //알림 내용 가져오기 
        $conditionarr = array();
        $conditionarr["where"]["idx"]["logic"] = "=";
        $conditionarr["where"]["idx"]["value"] = $_POST['alertidx'];

        $pagehandler = array();
        $pagehandler["limit"] = 0; //리스트 갯수
        $pagehandler["offset"] = 0; //리스트 위치 
        $alertlist = $this->oAlertlist->getlist($conditionarr, $pagehandler);
        //log_message('alert', "-------Fcm send------------".json_encode($alertlist)); 


        //토큰리스트 가져오기 
        $conditionarr = array();
        $conditionarr["where"]["uid"]["logic"] = "=";
        $conditionarr["where"]["uid"]["value"] = $alertlist[0]->alertuid;

        $pagehandler = array();
        $pagehandler["limit"] = 0; //리스트 갯수
        $pagehandler["offset"] = 0; //리스트 위치 
        $tokenlist = $this->oFcmtokenlist->getlist($conditionarr, $pagehandler);
        
        log_message('alert', "-------Fcm send------------".json_encode($tokenlist[0]->token)); 
        //$data = json_encode($json_data);

        // $fields = array(
        //      'registration_ids' => array($tokenlist[0]->token),
        // //    'registration_ids' => array($_POST['Tokenvalue']),
        //     // 'notification' => array(
        //     //     'title'=>'hometeacher',
        //     //     'body'=>'test 알람',
        //     // ),
        //     //'data' => array('url'=>'https://fcm.googleapis.com/fcm/send'),
        //     //'data' => array('url'=>'https://fcm.googleapis.com/fcm/send'),
        //     //'priority'=>'high'

        // );
        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $tokenlist[0]->token;
        $serverKey = 'your server token of FCM project';
        $title = "Notification title";
        $body = "Hello I am from Your php server";
        $notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);

        $headers = array(
            'Authorization:key ='.'AAAAEpaIQEo:APA91bFb3yxwRD1mx6U4Xaqd5CBEFffdtYEoqK3uUSa0VV1YV_UXR24ZCVFg7Uxz77_gdcwy__G4AXikPTlAC0q7eU72okPqYlFMl54TUwViFzE6JgrIaxcHFu2o-vMCPbIQwkUKPVe2',
            'Content-Type: application/json'
        );
        //firebase에서 키값으로 호출 형식

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);

       // echo $result;
        $json = json_decode($result,true);
        return $json['success'];
    }

    public function savetoken()
    {
        log_message('alert', "-------Fcm savetoken------------".json_encode($_POST)); 

        //중복체크 

        //프로필의 메인 이미지를 하나 가져옴
        $conditionarr["where"]["uid"]["logic"] = "=";
        $conditionarr["where"]["uid"]["value"] = $_POST['uid'];

        $pagehandler = array();
        $pagehandler["limit"] = 0; //리스트 갯수
        $pagehandler["offset"] = 0; //리스트 위치 
        $tokenlist = $this->oFcmtokenlist->getlist($conditionarr, $pagehandler);

        //존재하면 update
        if(empty($tokenlist)){
            $data=array("idx" => '0', 'uid' => $_POST["uid"], 'token' => $_POST["token"]);
            $results = $this->oFcmtokenlist->getinsert($data);
        }else{ //존재하지 않으면 insert

            $fieldname=array(
                'uid' => $_POST["uid"]
            );
            $data=array('token' => $_POST["token"]);
            $results = $this->oFcmtokenlist->getupdate($fieldname, $data);
        }

        $results = $this->response->setJSON(['result'  => $results]);
        return $results; 
    }


    public function fcmsendtest(){
    //     $fields = array(
    //         'registration_ids' => array('cjKovlRrS4W1mvq7wl5Inq:APA91bFwKOmzqc34AUSWOIuZkO0oR0g6e74Us-zbYLwIwiLFFUpuZWaqK_70aqPJIyYBAQBzR87w2uNmMLSMtO3RtTdg6nopmWBV2Xx3-4MO3Py2DajrqGVvzxw-eWWGWVEyBwhSFNAP'),
    //    //    'registration_ids' => array($_POST['Tokenvalue']),
    //        // 'notification' => array(
    //        //     'title'=>'hometeacher',
    //        //     'body'=>'test 알람',
    //        // ),
    //        //'data' => array('url'=>'https://fcm.googleapis.com/fcm/send'),
    //        //'data' => array('url'=>'https://fcm.googleapis.com/fcm/send'),
    //        //'priority'=>'high'

    //    );

       $url = "https://fcm.googleapis.com/fcm/send";
       $token = 'cjKovlRrS4W1mvq7wl5Inq:APA91bFwKOmzqc34AUSWOIuZkO0oR0g6e74Us-zbYLwIwiLFFUpuZWaqK_70aqPJIyYBAQBzR87w2uNmMLSMtO3RtTdg6nopmWBV2Xx3-4MO3Py2DajrqGVvzxw-eWWGWVEyBwhSFNAP';
       $serverKey = 'your server token of FCM project';
       $title = "Notification title";
       $body = "Hello I am from Your php server";
       $notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
       $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
       $json = json_encode($arrayToSend);


       $headers = array(
           'Authorization:key ='.'AAAAEpaIQEo:APA91bFb3yxwRD1mx6U4Xaqd5CBEFffdtYEoqK3uUSa0VV1YV_UXR24ZCVFg7Uxz77_gdcwy__G4AXikPTlAC0q7eU72okPqYlFMl54TUwViFzE6JgrIaxcHFu2o-vMCPbIQwkUKPVe2',
           'Content-Type: application/json'
       );
       //firebase에서 키값으로 호출 형식

       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
       $result = curl_exec($ch);
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       echo $result;
    }

    //게임을 전부 여기서 띄울 것. 
    public function game()
    {
        return view("../../../svelte/public/index.html");
    }
    //game1
    public function game1()
    {
        return view("../../../svelte/public/index.html");
    }
    //game2
    public function game2()
    {
        return view("../../../svelte/public/index.html");
    }
    //game3
    public function game3()
    {
        return view("../../../svelte/public/index.html");
    } 

    /*public function getgamedata($glimit, $goffset){
        log_message('alert', json_encode("comeon????"));
        //[{"fieldname":"a.gid","fieldlogic":"=","fieldval":"2"}]
        $json=json_decode(file_get_contents('php://input'));
        //log_message('alert', json_encode($json));
        $json=$json->data;

        log_message('alert', "선택 데이터 ");
        log_message('alert', json_encode($json));
        //log_message('alert', json_encode(count($json)));

        $conditionarr = array();
        $conditionarr["feild"] = "a.idx,a.uid,a.name,a.info,a.url,a.thumimg,a.display,a.regdate,b.name as bname";


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
        $conditionarr["order"]["value"] = "ASC";

       // $pagehandler = array();
        //$pagehandler["limit"] = $glimit; //리스트 갯수
       // $pagehandler["offset"] = $goffset; //리스트 위치 

        log_message('alert', "55555555555555  ".json_encode($conditionarr));

        $results = $this->oGamelist->getlist($conditionarr, '');
	    
	    log_message('alert', json_encode($results));
	    $response = $this->response->setJSON($results);

	    return $response;
    }*/

}
