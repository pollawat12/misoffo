<?php 
if (! function_exists('getIPAddress')) {
    /**
     * Undocumented function getIPAddress
     *
     * @return void
     */
    function getIPAddress()
    {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}

if (! function_exists('getCheckTimeType')) {
    /**
     * Undocumented function getCheckTimeType
     *
     * @param string $checkInTime
     * @param string $checkOutTime
     * @return void
     */
    function getCheckTimeType($checkInTime='', $checkOutTime='', $returnStrType=false)
    {
        $today = strtotime(date('Y-m-d H:i:s'));
        $intCheckIn = strtotime($checkInTime);
        $intCheckOut = strtotime($checkOutTime);
        if ($returnStrType) {
            if ($intCheckOut < $today) {
                return 'in';
            } else {
                return 'out';
            }
            // if ($checkInTime >= $today) return 'in';
            // if ($checkOutTime ) return 'out';
        } 
        if ($intCheckOut < $today) {
            return '<span class="check-in">Check In</span>';
        } else {
            return '<span class="check-out">Check Out</span>';
        }
        // if ($checkInTime >= $today) return '<span class="check-in">Check In</span>';
        // if ($checkOutTime ) return '<span class="check-out">Check Out</span>';
    }
}

if (! function_exists('getSumIncomeAndRateUp')) {    
    /**
     * getSumIncomeAndRateUp
     *
     * @param  mixed $amount
     * @param  mixed $rate
     * @param  mixed $isDiv
     * @return void
     */
    function getSumIncomeAndRateUp($amount=0, $rate=0, $isDiv=false)
    {
        if ($isDiv) {
            return ($amount * $rate)/2;
        }
        return $amount * $rate;
    }
}


if (! function_exists('mkDirPathUpload') ) {    
    /**
     * mkDirPathUpload
     *
     * @return void
     */
    function mkDirPathUpload()
    {
        $path = base_path('upfiles');

        if (is_dir($path)) {
            $path .= '/' . date('Y_m');
            if (! is_dir($path)) {
                mkdir($path, 777);
            } 
        }

        return $path;
    }
}


if (! function_exists('getSumIncomeAndRateUpOnly')) {    
    /**
     * getSumIncomeAndRateUp
     *
     * @param  mixed $amount
     * @param  mixed $rate
     * @param  mixed $isDiv
     * @return void
     */
    function getSumIncomeAndRateUpOnly($amount=0, $rate=0, $isDiv=false)
    {
        if ($isDiv) {
            return (($amount * $rate) - $amount)/2;
        } else {
            return ($amount * $rate) - $amount;
        }
    }
}

if (! function_exists('getDateNow')) {
    
    /**
     * getDateNow
     *
     * @param  mixed $showTime
     * @return void
     */
    function getDateNow($showTime=true)
    {
        date_default_timezone_set("Asia/Bangkok");
        
        if (!$showTime) { return date('Y-m-d'); }

        return date('Y-m-d H:i:s');
    }
}

if (! function_exists('getTimeNow')) {
    
    /**
     * getDateNow
     *
     * @param  mixed $showTime
     * @return void
     */
    function getTimeNow($showTime=true)
    {
        
        date_default_timezone_set("Asia/Bangkok");

        if (!$showTime) { return date('H:i:s'); }

        return date('H:i');
    }
}

if (! function_exists('checkStrNull') ) {    
    /**
     * checkStrNull
     *
     * @param  mixed $str
     * @return void
     */
    function checkStrNull($str='')
    {
        return (!empty($str)) ? trim($str) : null;
    }
}

if (! function_exists('cleanNumberFormat') ) {    
    /**
     * cleanNumberFormat
     *
     * @param  mixed $number
     * @return void
     */
    function cleanNumberFormat($number=0)
    {
        return (isset($number) && !empty($number)) ? getNumberWithoutCurrency((float) str_replace(',','',$number)) : getNumberWithoutCurrency((float) '0');
    }
}

if ( ! function_exists('getImportDatePaid') ) {    
    /**
     * getImportDatePaid
     *
     * @param  mixed $strDate
     * @return void
     */
    function getImportDatePaid($strDate='')
    {
        
        if (empty($strDate)) { return null; }
        
        list($d,$m,$y) = explode('/', $strDate);

        return $y.'-'.$m.'-'.$d;
    }
}

function getCreateReportDate($strDate='')
{
    
    if (empty($strDate)) { return null; }
    
    list($m,$d,$y) = explode('/', $strDate);

    return $y.'-'.$m.'-'.$d;
}



if (! function_exists('getDateFromInputDate')) {
        
    /**
     * getDateFromInputDate
     *
     * @param  mixed $strDate
     * @return void
     */
    function getDateFromInputDate($strDate='')
    {
        
        list($dd,$mm,$yyyy) = explode('/', $strDate);

        return $yyyy.'-'.$mm.'-'.$dd;
    }
}


if (!function_exists ('getDateTimeTH')) {    
    /**
     * getDateTimeTH
     *
     * @param  mixed $dateTime
     * @param  mixed $showTime
     * @return void
     */
    function getDateTimeTH($strDate='', $showTime=true, $isShortMonth=false, $showDayName=false) {

        $timestamp = strtotime($strDate);

        $dayTH = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];

        if (!$isShortMonth) {
            $strMonth = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        } else {
            $strMonth = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        }

        $year = date('Y', $timestamp) + 543;
        $month = $strMonth[date('n', $timestamp)];
        $date = date('d', $timestamp);
        $time = date('H:i', $timestamp) . ' น.';

        $strDate = $date.' '.$month.' '.$year;

        if ($showTime) {
            $strDate .= ' '.$time;
        } 

        if ($showDayName) {
            $dayInWeek = date('w', $timestamp);
            $strDate = 'วัน'.$dayTH[$dayInWeek]. 'ที่' . ' ' . $strDate;
        }


        return $strDate;
    }
}

if (! function_exists('getNumberCurrency')) {
        
    /**
     * getNumberCurrency
     *
     * @param  mixed $amount
     * @return void
     */
    function getNumberCurrency($amount=0)
    {
        return number_format($amount, 2, '.', ',');
    }
}


if (! function_exists('getNumberWithoutCurrency')) {
        
    /**
     * getNumberWithoutCurrency
     *
     * @param  mixed $amount
     * @return void
     */
    function getNumberWithoutCurrency($amount=0)
    {
        return number_format($amount, 2, '.', '');
    }
}


if (! function_exists('getDateFormatToInput')) {
        
    /**
     * getDateFormatToInput
     *
     * @param  mixed $strDate
     * @return void
     */
    function getDateFormatToInput($strDate='')
    {
        list($yyyy, $mm, $dd) = explode('-', $strDate);

        return $dd.'/'.$mm.'/'.$yyyy;
    }
}

if (! function_exists('getDateFormatToInputThai')) {
        
    /**
     * getDateFormatToInput
     *
     * @param  mixed $strDate
     * @return void
     */
    function getDateFormatToInputThai($strDate='')
    {
        $dd = date('d', strtotime($strDate));
        $mm = date('m', strtotime($strDate));
        $yyyy = date('Y', strtotime($strDate));
        // list($yyyy, $mm, $dd) = explode('-', $strDate);

        return $dd.'/'.$mm.'/'.($yyyy+543);
    }
}


if (! function_exists('getDateFormatToInputReport')) {
        
    /**
     * getDateFormatToInput
     *
     * @param  mixed $strDate
     * @return void
     */
    function getDateFormatToInputReport($strDate='')
    {
        list($yyyy, $mm, $dd) = explode('-', $strDate);

        return $mm.'/'.$dd.'/'.$yyyy;
    }
}


if (! function_exists('getDateFormatToInputReportNew')) {
        
    /**
     * getDateFormatToInput
     *
     * @param  mixed $strDate
     * @return void
     */
    function getDateFormatToInputReportNew($strDate='')
    {
        return date('d/m/Y', strtotime($strDate));
    }
}


if (! function_exists('getInputDateToDB')) {
        
    /**
     * getDateFormatToInput
     *
     * @param  mixed $strDate
     * @return void
     */
    function getInputDateToDB($strDate='')
    {
        list($d,$m,$y) = explode('/', $strDate);
        $y = $y - 543;

        return implode('-',[$y,$m,$d]);
    }
}

// define variable
if (! function_exists('getReligion')) {    
    /**
     * getReligion
     *
     * @param  mixed $religionId
     * @return void
     */
    function getReligion($religionId=0)
    {
        $array = [
            14 => 'พุทธ',
            15 => 'คริสต์',
            56 => 'อิสลาม'
        ];

        if ($religionId > 0) {
            return $array[$religionId];
        }

        return $array;
    }
}


if (! function_exists('getMaritialStatus')) {    
    /**
     * getMaritialStatus
     *
     * @param  mixed $statusId
     * @return void
     */
    function getMaritialStatus($statusId=0)
    {
        $array = [
            63 => 'โสด',
            64 => 'สมรสแล้ว'
        ];

        if ($statusId > 0) {
            return $array[$statusId];
        }

        return $array;
    }
}


if (! function_exists('getContractType')) {        
    /**
     * getContractType
     *
     * @param  mixed $typeId
     * @return void
     */
    function getContractType($typeId=0)
    {
        $array = [
            6 => 'ชั่วคราว',
            7 => 'ประจำ'
        ];

        if ($typeId > 0) {
            return $array[$typeId];
        }

        return $array;
    }
}


if (! function_exists('getEducationDegree')) {        
    /**
     * getEducationDegree
     *
     * @param  mixed $degreeId
     * @return void
     */
    function getEducationDegree($degreeId=0)
    {
        $array = [
            1 => 'อนุบาล', // value="N"
            2 => 'ประถมศึกษา', // value="PR"
            3 => 'มัธยมศึกษาตอนต้น', // value="S"
            4 => 'มัธยมศึกษาตอนปลาย', // value="H"
            5 => 'ประกาศวิชาชีพชั้นสุง (ปวส.)', // value="A"
            6 => 'ปริญญาตรี', // value="B"
            7 => 'ปริญญาโท', // value="M"
            8 => 'ปริญญาเอก', // value="PH"
            9 => 'ใบประกอบวิชาชีพ' // value="C"
        ];

        if ($degreeId > 0) {
            return $array[$degreeId];
        }

        return $array;
    }
}


if (! function_exists('getAddressType')) {        
    /**
     * getAddressType
     *
     * @param  mixed $typeId
     * @return void
     */
    function getAddressType($typeId=0)
    {
        $array = [
            8 => 'ที่อยู่ที่ติดต่อได้', 
            9 => 'ที่อยู่ที่ทำงาน', 
            10 => 'ที่อยู่ตามบัตรประชาชน', 
            12 => 'ที่อยู่ตามทะเบียนบ้าน'
        ];

        if ($typeId > 0) {
            return $array[$typeId];
        }

        return $array;
    }
}



if (! function_exists('getEmployeeType')) {        
        
    /**
     * getEmployeeType
     *
     * @param  mixed $typeId
     * @return void
     */
    function getEmployeeType($typeId=0)
    {
        $array = [
            //2 => 'พนักงานกองทุนพัฒนาน้ำบาดาล', 
            1 => 'เจ้าหน้าที่',
            3 => 'พนักงานราชการ'
        ];

        if ($typeId > 0) {
            return $array[$typeId];
        }

        return $array;
    }
}


if (! function_exists('getProjectStatus')) {        
        
    /**
     * getProjectStatus
     *
     * @param  mixed $statusId
     * @return void
     */
    function getProjectStatus($statusId=0)
    {
        $array = [
            1 => 'รอพิจารณา', 
            2 => 'ปรับปรุงแก้ไข',
            3 => 'ส่งเรื่องคืน',
            4 => 'อนุมัติ'
        ];

        if ($statusId > 0) {
            return $array[$statusId];
        }

        return $array;
    }
}



if (! function_exists('getBloodGroup')) {        
        
    /**
     * getBloodGroup
     *
     * @param  mixed $groupId
     * @return void
     */
    function getBloodGroup($groupId=0)
    {
        $array = [
            59 => 'A', 
            60 => 'B', 
            61 => 'AB', 
            62 => 'O'
        ];

        if ($groupId > 0) {
            return $array[$groupId];
        }

        return $array;
    }
}


if (! function_exists('getLabelStatusOnOff')) {    
    /**
     * getLabelStatusOnOff
     *
     * @param  mixed $statusId
     * @return void
     */
    function getLabelStatusOnOff($statusId=0)
    {
        $status = '<span class="badge badge-success badge-pill" style="padding:10px;">เปิด</span>';
        if ($statusId == 1) {
            $status = '<span class="badge badge-danger badge-pill" style="padding:10px;">ปิด</span>';
        }

        return $status;
    }
}



if (! function_exists('getLabelYearDefault')) {    
    /**
     * getLabelStatusOnOff
     *
     * @param  mixed $statusId
     * @return void
     */
    function getLabelYearDefault($isDefault=0)
    {
        $status = '';
        if ($isDefault == 1) {
            $status = '<span class="badge badge-success badge-pill" style="padding:10px;">ใช่</span>';
        }

        return $status;
    }
}


if (! function_exists('getLabelStatusChecked')) {    
    /**
     * getLabelStatusOnOff
     *
     * @param  mixed $statusId
     * @return void
     */
    function getLabelStatusChecked($statusId=0)
    {
        $status = '<span class="badge badge-secondary badge-pill" style="padding:8px; font-size:13px !important;">รอดำเนินการ</span>';
        if ($statusId == 1) {
            $status = '<span class="badge badge-pink badge-pill" style="padding:8px; font-size:13px !important;">กำลังดำเนินการ</span>';
        }

        if ($statusId == 2) {
            $status = '<span class="badge badge-warning badge-pill" style="padding:8px; font-size:13px !important;">รอตรวจสอบ</span>';
        }

        if ($statusId == 3) {
            $status = '<span class="badge badge-success badge-pill" style="padding:8px; font-size:13px !important;">ตรวจสอบแล้ว</span>';
        }

        return $status;
    }
}

if (! function_exists('getLabelStatusDurable')) {    
    /**
     * getLabelStatusOnOff
     *
     * @param  mixed $statusId
     * @return void
     */
    function getLabelStatusDurable($status_id=0)
    {
        $status = '<span class="badge badge-success badge-pill" style="padding:8px; font-size:13px !important;">ในคลัง/คืน</span>';
        if ($status_id == 0) {
            $status = '<span class="badge badge-success badge-pill" style="padding:8px; font-size:13px !important;">ในคลัง/คืน</span>';
        }

        if ($status_id == 1) {
            $status = '<span class="badge badge-warning badge-pill" style="padding:8px; font-size:13px !important;">ยืม</span>';
        }

        if ($status_id == 2) {
            $status = '<span class="badge badge-secondary badge-pill" style="padding:8px; font-size:13px !important;">ตัดจำหน่าย</span>';
        }

        return $status;
    }
}






if (! function_exists('getLabelStatusApprovedReport')) {    
    /**
     * getLabelStatusOnOff
     *
     * @param  mixed $statusId
     * @return void
     */
    function getLabelStatusApprovedReport($statusId=0)
    {
        $status = '<span class="badge badge-secondary badge-pill" style="padding:8px; font-size:13px !important;">รอดำเนินการ</span>';
        if ($statusId == 2) {
            $status = '<span class="badge badge-info badge-pill" style="padding:8px; font-size:13px !important;">กำลังดำเนินการ</span>';
        }

        if ($statusId == 3) {
            $status = '<span class="badge badge-warning badge-pill" style="padding:8px; font-size:13px !important;">รอตรวจสอบ</span>';
        }

        if ($statusId == 4) {
            $status = '<span class="badge badge-success badge-pill" style="padding:8px; font-size:13px !important;">อนุมัติ</span>';
        }

        if ($statusId == 5) {
            $status = '<span class="badge badge-danger badge-pill" style="padding:8px; font-size:13px !important;">ยกเลิก</span>';
        }

        return $status;
    }
}



function getLabelStatusApprovedPayment($statusId=0)
{
    $status = '<span class="badge badge-warning badge-pill" style="padding:8px; font-size:14px !important;">รอชำระเงิน</span>';
    // if ($statusId == 1) {
    //     $status = '<span class="badge badge-info badge-pill" style="padding:8px; font-size:13px !important;">กำลังดำเนินการ</span>';
    // }

    if ($statusId == 2) {
        $status = '<span class="badge badge-secondary badge-pill" style="padding:8px; font-size:14px !important;">ชำระบางส่วน</span>';
    }

    if ($statusId == 3) {
        $status = '<span class="badge badge-success badge-pill" style="padding:8px; font-size:14px !important;">ชำระเงินแล้ว</span>';
    }

    return $status;
}


function getImportCommaWithArray($array=[])
{
    $str = '';

    if (count($array) > 0) {
        $str = implode('', $array);
    }

    return $str;
}


if (!function_exists ('getDateMonthTH')) {    
    /**
     * getDateMonthTH
     *
     * @param  mixed $dateMonth
     * @param  mixed $showMonth
     * @return void
     */
    function getDateMonthTH($strDate='', $showTime=true, $isShortMonth=false) {

        $timestamp = strtotime($strDate);

        if (!$isShortMonth) {
            $strMonth = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน.","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        } else {
            $strMonth = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        }

        $year = date('Y', $timestamp) + 543;
        $month = $strMonth[date('n', $timestamp)];
        
        return $month.' '.$year;
    }
}



if (!function_exists ('getShowDateMonthTH')) {    
    /**
     * getDateMonthTH
     *
     * @param  mixed $dateMonth
     * @param  mixed $showMonth
     * @return void
     */
    function getShowDateMonthTH($strDate='', $showTime=true, $isShortMonth=false) {

        $timestamp = strtotime($strDate);

        if (!$isShortMonth) {
            $strMonth = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน.","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        } else {
            $strMonth = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        }

        $year = date('Y', $timestamp) + 543;
        $month = $strMonth[date('n', $timestamp)];
        $date = date('j', $timestamp);
        
        return $date . ' ' . $month . ' ' . $year;
    }
}


if (! function_exists('getDateShow')) {
        
    /**
     * getDateShow
     *
     * @param  mixed $strDate
     * @return void
     */
    function getDateShow($strDate='')
    {
        $timestamp = strtotime($strDate);

        $year = date('Y', $timestamp) + 543;

        $month = date('n', $timestamp);

        $date = date('d', $timestamp);

        return $date.'/'.$month.'/'.$year;
    }
}


if (! function_exists('getLabelDashboardDivTarget')) {
    
    /**
     * getLabelDashboardDivTarget
     *
     * @param  mixed $cateId
     * @param  mixed $itemId
     * @return void
     */
    function getLabelDashboardDivTarget($cateId=0, $itemId=0)
    {
        $arrDivTargets[1] = [
            1 => 'income-group-pie-chart',
            2 => 'income-group-pie-chart',
            3 => 'income-group-pie-chart',
            4 => 'income-group-pie-chart',
            5 => 'income-group-pie-chart',
            6 => ''
        ];


        return $arrDivTargets[$cateId][$itemId];
    }
}


//update amonthep
if (! function_exists('getGender')) {        
    
    function getGender($genderId=0)
    {
        $array = [
            'm' => 'เพศชาย', 
            'f' => 'เพศหญิง'
        ];

        if ($genderId > 0) {
            return $array[$genderId];
        }

        return $array;
    }
}

if (! function_exists('getRelation')) {    
    /**
     * getRelation ความสัมพันธ์
     *
     * @param  mixed $statusId
     * @return void
     */
    function getRelation($statusId=0)
    {
        $array = [
            1 => 'พ่อ',
            2 => 'แม่',
            3 => 'สามี',
            4 => 'ภรรยา',
            5 => 'ลูกชาย/ลูกสาว',
            6 => 'พี่/น้อง',
            7 => 'ปู่/ตา',
            8 => 'ย่า/ยาย',
            9 => 'อื่น ๆ'
        ];

        if ($statusId > 0) {
            return $array[$statusId];
        }

        return $array;
    }
}

//update amonthep
if (! function_exists('getPrenames')) {    
    /**
     * getPrenames คำนำหน้า
     *
     * @param  mixed $statusId
     * @return void
     */
    function getPrenames($statusId=0)
    {
        $array = [
            1 => 'นาย',
            2 => 'นาง',
            3 => 'นางสาว',
            4 => 'อื่น ๆ'
        ];

        if ($statusId > 0) {
            return $array[$statusId];
        }

        return $array;
    }
}

//update amonthep
if (! function_exists('getPrenames')) {    
    /**
     * getPrenames คำนำหน้า
     *
     * @param  mixed $statusId
     * @return void
     */
    function getPrenames($statusId=0)
    {
        $array = [
            1 => 'นาย',
            2 => 'นาง',
            3 => 'นางสาว',
            4 => 'ว่าที่ร้อยตรี',
            5 => 'ว่าที่ร้อยตรีหญิง',
            6 => 'ดร.',
            7 => 'อื่น ๆ'
        ];

        if ($statusId > 0) {
            return $array[$statusId];
        }

        return $array;
    }
    
}

/**
 * getMessageLineNotify
 *
 * @param  mixed $data
 * @param  mixed $type
 * @return void
 */
function getMessageLineNotify($data=[], $type='project')
{
    switch ($type) {
        case 'project':
                $msg = "รายงานผลการดำเนินงาน (New)\n";
                $msg .= "โครงการ : ".$data['project']."\n";
                //$msg .= "หน่วยงานรับผิดชอบ : ".$data['dept_owner']." \n";
            break;
        case 'project_update':
                $msg = "รายงานผลการดำเนินงาน (Update)\n";
                $msg .= "โครงการ : ".$data['project']."\n";
                //$msg .= "หน่วยงานรับผิดชอบ : ".$data['dept_owner']." \n";
            break;
    }


    return $msg;
}

// rendom int
if (! function_exists('randomNumbers') ) {    
    /**
     * randomNumbers
     *
     * @param  mixed $len
     * @return void
     */
    function randomNumbers($len=6)
    {
        $nPassword = '';
        for($i = 0; $i < $len; $i++) {
            $nPassword .= mt_rand(0, 9);
        }

        return $nPassword;
    }
}


if (! function_exists('cleanPhoneNumber') ) {    
    /**
     * cleanPhoneNumber
     *
     * @param  mixed $phone
     * @return void
     */
    function cleanPhoneNumber($phone='')
    {
        return str_replace('-', '',str_replace(' ','',trim($phone)));
    }
}

if (! function_exists('getBadgeDataStatus')) {    
    /**
     * getBadgeDataStatus
     *
     * @param  mixed $type
     * @param  mixed $status_value
     * @return void
     */
    function getBadgeDataStatus($type='', $status_value=0)
    {
        switch ($type) {
            case 'is_deleted':
                switch ($status_value) {
                    case 0:
                        $info = ['class_name' => 'success', 'label' => 'เปิดใช้งาน'];
                        break;
                    case 1:
                        $info = ['class_name' => 'danger', 'label' => 'ปิดใช้งาน'];
                        break;
                }
                break;
            case 'status_booking_car':
                switch ($status_value) {
                    case 'cancel':
                        $info = ['class_name' => 'danger', 'label' => 'ยกเลิก'];
                        break;
                    case 'no_approved':
                        $info = ['class_name' => 'danger', 'label' => 'ไม่อนุมัติ'];
                        break;
                    case 'wait':
                        $info = ['class_name' => 'warning', 'label' => 'รออนุมัติ'];
                        break;
                    case 'approved':
                        $info = ['class_name' => 'danger', 'label' => 'ปิดใช้งาน'];
                        break;
                }
                break;
        }
    
        return '<span class="badge badge-'.$info['class_name'].' badge-pill" style="font-size: 13.5px; padding:8px;">'.$info['label'].'</span>';
    }

    if (! function_exists('getDateTimeForCheck')) {        
        /**
         * getDateTimeForCheck
         *
         * @param  mixed $str_datetime
         * @param  mixed $type
         * @return void
         */
        function getDateTimeForCheck($str_datetime='', $type="start")
        {
            $date_checked = date('Y-m-d H:i:s');
            if ($type == 'start') {
                $date_checked = date('Y-m-d H:i:s', strtotime('+1 minute', strtotime($str_datetime)));
            } else {
                $date_checked = date('Y-m-d H:i:s', strtotime('-1 minute', strtotime($str_datetime)));
            }

            return $date_checked;
        }
    }


    if (! function_exists('getToken')) {        
        /**
         * getToken
         *
         * @param  mixed $strLen
         * @return void
         */
        function getToken($strLen=15)
        {
            $characters = 'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789!@#$%*+-_';
            $randstring = '';
            for ($i = 0; $i < $strLen; $i++) {
                $randstring .= $characters[rand(0, (strlen($characters)-1))];
            }
            return $randstring;
        }
    }


    
    
    
}


if (! function_exists('getMonthInBudgetYear')) {    
    /**
     * getMonthInBudgetYear
     *
     * @return void
     */
    function getMonthInBudgetYear()
    {
        // ช่วงปีงบประมาณ 1 ตุลา -30 กันยา
        $months = ['10' => "ต.ค.", '11' => "พ.ย.", '12' => "ธ.ค.", '01' => "ม.ค.",'02' => "ก.พ.", '03' => "มี.ค.", '04' => "เม.ย.", '05' => "พ.ค.",'06' => "มิ.ย..", '07' => "ก.ค.",'08' => "ส.ค.", '09' => "ก.ย."];

        return $months;
    }
}


// -- 5/06/2022  -- //
if (! function_exists('getCalDistance')) {
    
    /**
     * Undocumented function getCalDistance
     *
     * @param array $from
     * @param array $to
     * @return void
     */
    function getCalDistance($from=[], $to=[])
    {
        $latitudeFrom    = $from[0];
        $longitudeFrom    = $from[1];
        $latitudeTo        = $to[0];
        $longitudeTo    = $to[1];

        $diffDistance    = $longitudeFrom - $longitudeTo;
        $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($diffDistance));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = $dist * 60 * 1.1515;
        
        // Convert unit and return distance
        return round($miles * 1.609344, 2).'';
    }
}


if (! function_exists('getCheckInPlaceType')) {
    /**
     * Undocumented function getCheckInPlaceType
     *
     * @param string $type
     * @return void
     */
    function getCheckInPlaceType($type='office')
    {
        $strPlaceType = 'สำนักงาน';

        switch ($type) {
            case 'office':
                $strPlaceType = 'สำนักงาน';
                break;
            case 'onsite':
                $strPlaceType = 'นอกสถานที่';
                break;
            case 'wfh':
                $strPlaceType = 'WFH';
                break;
            
            default:
                $strPlaceType = 'สำนักงาน';
                break;
        }

        return $strPlaceType;
    }
}