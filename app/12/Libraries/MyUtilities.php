<?php 

namespace App\Libraries;

use Auth;
use URL;
use DB;
use Session;
use Illuminate\Http\Request;

use App\Libraries\MySms;
use App\Models\SmsCampaign;
use App\Models\SmsDetail;

class MyUtilities 
{    
    /**
     * generateMsgNotify
     *
     * @param  mixed $data
     * @param  mixed $type
     * @return void
     */
    public static function generateMsgNotify($data=[], $type='indicator')
    {
        switch ($type) {
            case 'indicator':
                $msg = "\nเรื่อง : รายงานผล ตัวชี้วัด \n\n";
                $msg .= $data['project']."\n\n";
                $msg .= "หน่วยงานรับผิดชอบ : ".$data['dept_owner']." \n";
                $msg .= "เจ้าหน้าที่ : ".$data['update_by']."\n";
                $msg .= "เบอร์มือ : ".$data['mobile']."\n";
                $msg .= "อีเมล : ".$data['email']."\n";
                $msg .= "​Line id : ".$data['line_id']."\n";
                break;

            case 'event':
                $msg = "\nเรื่อง : รายงานผล แผนงาน/กิจกรรม \n\n";
                $msg .= $data['project']."\n\n";
                $msg .= "หน่วยงานรับผิดชอบ : ".$data['dept_owner']." \n";
                $msg .= "เจ้าหน้าที่ : ".$data['update_by']."\n";
                $msg .= "เบอร์มือ : ".$data['mobile']."\n";
                $msg .= "อีเมล : ".$data['email']."\n";
                $msg .= "​Line id : ".$data['line_id']."\n";
                break;
            case 'event':
                $msg = "\nเรื่อง : รายงานผล ผลการเบิกจ่าย \n\n";
                $msg .= $data['project']."\n\n";
                $msg .= "หน่วยงานรับผิดชอบ : ".$data['dept_owner']." \n";
                $msg .= "เจ้าหน้าที่ : ".$data['update_by']."\n";
                $msg .= "เบอร์มือ : ".$data['mobile']."\n";
                $msg .= "อีเมล : ".$data['email']."\n";
                $msg .= "​Line id : ".$data['line_id']."\n";
                break;
        }

        return $msg;
    }

    
    /**
     * sendNotify
     *
     * @param  mixed $msg
     * @param  mixed $token
     * @return void
     */
    public static function sendNotify($msg, $token)
    {
        $ch = curl_init(); 

        curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, "message=$msg"); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 

        $headers = array("Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token");
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        $result = curl_exec($ch); 

        curl_close($ch); 

        return $result;
    }
    
    /**
     * createFolderName
     *
     * @param  mixed $int
     * @param  mixed $intPerfix
     * @param  mixed $preFix
     * @param  mixed $strLen
     * @param  mixed $type
     * @return void
     */
    public static function createFolderName($int=0,$intPerfix=0, $preFix='', $strLen=9, $type=STR_PAD_LEFT)
    {
        $folderName = '';

        if (!empty($preFix)) {
            $folderName = $preFix;
        }

        $folderName .= str_pad($int, $strLen, $intPerfix, $type);

        return $folderName;
    }
    
    /**
     * mkDirPathUpload
     *
     * @param  mixed $itemId
     * @param  mixed $folderUpfile
     * @return void
     */
    public static function mkDirPathUpload($itemId=0, $folderUpfile='upfiles')
    {
        $rootPath = base_path().'/'.$folderUpfile;

        if (!is_dir($rootPath)) { @mkdir($rootPath, 0755, true); }
        $rootPathUpload = self::createFolderName($itemId);

        $arrInt = str_split($rootPathUpload, 3);
        krsort($arrInt);

        $strPath = '';
        foreach ($arrInt as $val) {
            $strPath .= $val . '/';
            
            // mkdir
            if (!file_exists($strPath)) {
                @mkdir($rootPath.'/'.$strPath, 0755, true);
            }
        }

        return $folderUpfile.'/'.implode('/', $arrInt);
    }
    
    
    /**
     * doUpload
     *
     * @param  mixed $file
     * @param  mixed $pathUpload
     * @param  mixed $fileName
     * @return void
     */
    public static function doUpload($file=null, $pathUpload=null, $fileName=null)
    {
        if (is_null($file) || empty($file)) { return false; }
        // make upload
        return $file->move($pathUpload, $fileName);
    }

    /**
     * sendSMS
     *
     * @param  mixed $msisdn
     * @param  mixed $msg
     * @param  mixed $option
     * @return void
     */
    public static function sendSMS($msisdn='', $msg='', $option='')
    {
        $sms = new MySms(env("SMS_API_KEY"), env("SMS_API_SECRET_KEY"));
        
        $body = [
            'msisdn' => $msisdn,
            'message' => $msg,
            // 'sender' => '',
            // 'scheduled_delivery' => '',
            // 'force' => ''
        ];
        $res = $sms->sendSMS($body);
        
        $statusSend = false;

        if ($res->httpStatusCode == 201) {
            $statusSend = true;
            // echo "Succes";
            // var_dump($res);
        } 
        return $res;
    }

}
