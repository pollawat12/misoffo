<?php 

namespace App\Libraries;


/**
 * MyNotification
 */
class MyNotification 
{        
        
    /**
     * notiSuppliesLows
     *
     * @param  mixed $tiemName
     * @param  mixed $intMinimum
     * @param  mixed $intBalance
     * @param  mixed $updatedAt
     * @return void
     */
    public static function notiSuppliesLows($tiemName='', $unit='', $intMinimum=0,$intBalance=0,$updatedAt='')
    {
        $msg = "\nเรื่อง : รายการพัสดุน้อยกว่าค่าขั้นต่ำ \n";
        $msg .= "รายการ : ".$tiemName."\n";
        $msg .= "จำนวนต่ำสุด : ".$intMinimum." ".$unit."  \n";
        $msg .= "คงเหลือ : ".$intBalance." ".$unit." \n";
        $msg .= "อัพเดทล่าสุด : ".$updatedAt."\n";

        MyUtilities::sendNotify($msg, 'JDOrFBPRt57Uab6xHbpev2YQu6GxGUV4FCINw70umsW');
    }

    
    /**
     * notiEmployeeLeave
     *
     * @param  mixed $employeeName
     * @param  mixed $leaveType
     * @param  mixed $start
     * @param  mixed $end
     * @param  mixed $countDays
     * @param  mixed $status
     * @return void
     */
    public static function notiEmployeeLeave($employeeName='', $leaveType='', $start=0, $end=0, $countDays=0, $status='รอการอนุมัติ')
    {
        $msg = "\nเรื่อง : เจ้าหน้าที่แจ้งการลา \n";
        $msg .= "คุณ ".$employeeName."\n";
        $msg .= "ประเภทการลา : ".$leaveType." \n";
        $msg .= "วันที่เริ่ม : ".$start."\n";
        $msg .= "วันที่สิ้นสุด : ".$end."\n";
        $msg .= "จำนวนวัน : ".$countDays." วัน\n";
        $msg .= "สถานะ : ".$status."\n";

        MyUtilities::sendNotify($msg, '1XhD3EENef6vCw2oL90IHncQFUgqDfgALZZHpHuSVDv');
    }

    
    /**
     * notiEmployeeLeaveApproved
     *
     * @param  mixed $employeeName
     * @param  mixed $leaveType
     * @param  mixed $start
     * @param  mixed $end
     * @param  mixed $countDays
     * @param  mixed $status
     * @return void
     */
    public static function notiEmployeeLeaveApproved($employeeName='', $leaveType='', $start=0, $end=0, $countDays=0, $status='อนุมัติแล้ว')
    {
        $msg = "\nเรื่อง : แจ้งผลการลา \n";
        $msg .= "คุณ ".$employeeName."\n";
        $msg .= "ประเภทการลา : ".$leaveType." \n";
        $msg .= "วันที่เริ่ม : ".$start."\n";
        $msg .= "วันที่สิ้นสุด : ".$end."\n";
        $msg .= "จำนวนวัน : ".$countDays." วัน\n";
        $msg .= "สถานะ : ".$status."\n";

        MyUtilities::sendNotify($msg, '1XhD3EENef6vCw2oL90IHncQFUgqDfgALZZHpHuSVDv');
    }
    

    /**
     * linenotify
     *
     * @param  mixed $subjectType
     * @param  mixed $dataArray
     * @param  mixed $token
     * @return void
     */
    public static function linenotify($subjectType='', $dataArray=[], $token='')
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
     * sendemail
     *
     * @return void
     */
    public static function sendemail()
    {
        # code...
    }

    
    /**
     * smsmessage
     *
     * @return void
     */
    public static function smsmessage()
    {

    }
    
    /**
     * msginbox
     *
     * @param  mixed $subjectType
     * @param  mixed $dataArray
     * @return void
     */
    public static function msginbox($subject='', $description='', $to=0, $from=0)
    {
        
    }
    
    /**
     * msglinenotify
     *
     * @param  mixed $subjectType
     * @param  mixed $type
     * @param  mixed $data
     * @return void
     */
    public static function msglinenotify($subjectType='project', $type='',  $data=[])
    {
        if ($subjectType == 'hr') {
            switch ($type) {
                case 'leave':
                    $msg = "\nเรื่อง : เจ้าหน้าที่แจ้งการลา \n\n";
                    $msg .= "คุณ ".$data['employee_name']."\n\n";
                    $msg .= "ประเภทการลา : ".$data['leave_']." \n";
                    $msg .= "วันที่เริ่ม : ".$data['update_by']."\n";
                    $msg .= "วันที่สิ้นสุด : ".$data['mobile']."\n";
                    $msg .= "สถานะ : รอการอนุมัติ"."\n";
                    break;
            }
        }

        // if () {

        // }

        // if () {

        // }
    }
}


