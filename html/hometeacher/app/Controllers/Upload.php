<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class Upload extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        //return view('upload_form', ['errors' => []]);
    }

    public function upload($imginfo, $urlname)
    {
        log_message('alert', "upload!!!"); 
        log_message('alert', json_encode($imginfo)); 
//{"name":"img.png","type":"image\/png","tmp_name":"\/tmp\/phpvquFKq","error":0,"size":4052}
        

        $ext = explode(".",$imginfo['name']);
        log_message('alert', json_encode($imginfo['type'])); 
        log_message('alert', json_encode($ext[1])); 
        switch($ext[1]){
            case 'jpeg':
            case 'jpg':
            case 'gif':
            case 'bmp':
            case 'png':
            case 'mp4':
                $extStatus = true;
                break;
            
            default:
                log_message('alert', "이미지 전용 확장자(jpg, bmp, gif, png)외에는 사용이 불가합니다."); 
                //echo "이미지 전용 확장자(jpg, bmp, gif, png)외에는 사용이 불가합니다."; 
                exit;
                break;
        }



        // 허용할 확장자를 jpg, bmp, gif, png로 정함, 그 외에는 업로드 불가
        if($extStatus){
            // 임시 파일 옮길 디렉토리 및 파일명 
            //$timestamp = time();
            $randomnum = ceil((double) microtime() * 100000000);
            //log_message('alert', json_encode((double) microtime()*100000000)); 
            log_message('alert', json_encode($randomnum)); 
            //log_message('alert', json_encode(microtime())); 


            $splitname = explode(".",$imginfo['name']);
            $filename = $splitname[0]."_".$randomnum.".".$ext[1];

            
            $resFile = "../public".$urlname.$filename; //파일 경로와 파일 명 생성
            $tempFile = $imginfo['tmp_name']; //업로드 될 파일

            log_message('alert', $resFile); 
            log_message('alert', json_encode($tempFile)); 
            // 임시 저장된 파일을 우리가 저장할 디렉토리 및 파일명으로 옮김
            $imageUpload = move_uploaded_file($tempFile, $resFile);
            
            // 업로드 성공 여부 확인
            if($imageUpload == true){
                log_message('alert', "파일이 정상적으로 업로드 되었습니다."); 
                //echo "파일이 정상적으로 업로드 되었습니다. <br>";
                //echo "<img src='{$resFile}' width='100' />";

                return $filename; //
            }else{
                log_message('alert', "파일 업로드에 실패하였습니다."); 
                //echo "파일 업로드에 실패하였습니다.";
            }
        }	// end if - extStatus
            // 확장자가 jpg, bmp, gif, png가 아닌 경우 else문 실행
        else {
            log_message('alert', "파일 확장자는 jpg, bmp, gif, png 이어야 합니다."); 
            //echo "파일 확장자는 jpg, bmp, gif, png 이어야 합니다.";
        //    exit;
            return false;
        }	

       
    }
}
?>