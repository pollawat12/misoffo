<?php
// header("Content-type: application/vnd.ms-excel");
// header('Content-type: application/csv'); //*** CSV ***//
// header("Content-Disposition: attachment; filename=money.xls");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ใบจ่ายเงินเดือน</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- font -->
  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <style type="text/css">
  html {
      font-family:Kanit, "times New Roman", tahoma;
      font-size:12px;
      color:#000000;
  }
  body {
      font-family:Kanit, "times New Roman", tahoma;
      font-size:12px;
      padding:0;
      margin:0;
      color:#000000;
  }

  /* css ส่วนสำหรับการแบ่งหน้าข้อมูลสำหรับการพิมพ์ */
  @media all
  {
      .page-break { display:none; }
      .page-break-no{ display:none; }
  }
  @media print
  {
      .page-break { display:block;height:1px; page-break-before:always; }
      .page-break-no{ display:block;height:1px; page-break-after:avoid; } 
  }

  .headTitle {
      height: 26px;
  }
  </style>
</head>
<body>
<div class="page-break<?=(1==1)?"-no":""?>">&nbsp;</div>
<?php foreach ($employees as $employee);?>
<table width="750"  border="0">
  <tr >
    <th align="right" colspan="2">
      <span style="vertical-align: middle; font-size:13px;">ใบจ่ายเงินเดือน/ค่าจ้าง/เงินประจำตำแหน่ง</span>
    </th>
  </tr>
  <tr>
    <th align="right" colspan="2">
      <span style="vertical-align: middle; font-size:12px;">โปรดตรวจสอบและเก็บเป็นหลักฐานในการติดต่อการเงินและบัญชี</span>
    </th>
  </tr>
  <tr >
    <td align="center" colspan="2">
      <table style="width:100%" border="0">
        <tr>
            <th align="left">
              <span style="vertical-align: middle; font-size:13px;">ชื่อเจ้าหน้าที่ : {{$employee['firstname']}}  {{$employee['lastname']}}</span>
            </th>
            <td align="left" class="headTitle" style="width: 15%;"></td>
            <th align="left">
              <span style="vertical-align: middle; font-size:13px;">เลขประจำตัวประชาชน : {{$employee['card_no']}}</span>
            </th>
            <td align="left" class="headTitle"></td>
        </tr>
        <tr>
            <th align="left">
              <span style="vertical-align: middle; font-size:13px;">Name : {{$employee['firstname_en']}} {{$employee['lastname_en']}}</span>
            </th>
            <td align="left" class="headTitle"></td>
            <th align="left">
              <span style="vertical-align: middle; font-size:13px;">ตำแหน่ง : <?php if($dutyDetail){ foreach($dutyDetail as $dutyDetails);  echo $dutyDetails['position']; }?></span>
            </th>
            <td align="left" class="headTitle"></td>
        </tr>
      </table> 
    </td>
  </tr>
  <tr>
    <td align="left" class="headTitle">
        <?php foreach ($evaluations as $evaluation);?>
        <?php $day = date("Y-m-d");


          $tmomth = getDateMonthTH($day , false);
          list($momth,$days) = explode(" ",$tmomth);
        ?>
        <table width="100%" border="1">
            <tr style="background-color: #decdb8;">
                <th align="center" style="width: 15%;"> เงินเดือน <br> Salary {{getDateShow($day)}}</th>
                <th align="center" style="width: 15%;"> เดือน <br> Month</th>
                <th align="center" style="width: 15%;"> จำนวนเงิน <br> Amount </th>
                <th align="center" style="width: 10%;"> ภาษี <br> TAX </th>
                <th align="center" style="width: 15%;"> ประกันสังคม <br> Social Security </th>
                <th align="center" style="width: 15%;"> จำนวนเงิน <br> Amount </th>
                <th align="center" style="width: 15%;"> วันที่/เดือน/ปี <br> Payroll Date </th>
            </tr>
            <tr>
                <td align="center" rowspan="2" style="width: 15%; height: 40px;" > {{number_format($evaluation->salary_end,2,'.',',')}}  </td>
                <td align="center" rowspan="2" style="width: 15%;"> {{$momth}} </td>
                <td align="center" rowspan="2" style="width: 15%;"> {{number_format($evaluation->salary_end,2,'.',',')}} </td>
                <td align="center" rowspan="2" style="width: 10%;">  </td>
                <td align="center" rowspan="2" style="width: 15%;"> 750 </td>
                <td align="center" rowspan="2" style="width: 15%;"> 750 </td>
                <td align="center" style="width: 15%;  height: 40px;"> {{getDateShow($day)}} </td>
            </tr>
            <tr>
              <th align="center"  style="width: 15%; background-color: #decdb8;"> เงินรับสุทธิ <br> Net To Pay </th>
            </tr>
            <tr>
              <th align="center" colspan="2" style="height: 40px; background-color: #decdb8;"> รวมรายได้ <br> Toltal </th>
              <th align="center"> {{number_format($evaluation->salary_end,2,'.',',')}} </th>
              <th align="center" colspan="2" style="height: 40px; background-color: #decdb8;"> รวมรายการหัก <br> Toltal Deductions </th>
              <th align="center"> 750 </th>
              <th align="center"> {{number_format($evaluation->salary_end - 750,2,'.',',')}} </th>
            </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td align="left" class="headTitle">
        <table width="100%" border="1">
            <tr style="background-color: #decdb8;">
                <th align="center" style="width: 15%;"> รายได้สะสมต่อปี</th>
                <th align="center" style="width: 15%;"> ภาษีสะสมต่อปี</th>
                <th align="center" style="width: 15%;"> เงินสะสมกองทุนต่อปี </th>
                <th align="center" style="width: 10%;"> เงินประกันสังคมต่อปี </th>
                <th align="center" style="width: 15%;"> ค่าลดหย่อนอื่นๆต่อปี </th>
            </tr>
            <tr>
                <th align="center" style="width: 15%;  height: 40px;">  </th>
                <th align="center" style="width: 15%;  height: 40px;">  </th>
                <th align="center" style="width: 15%;  height: 40px;">  </th>
                <th align="center" style="width: 15%;  height: 40px;">  </th>
                <th align="center" style="width: 15%;  height: 40px;">  </th>
            </tr>
        </table>
    </td>
  </tr>
</table>
</body>
</html>