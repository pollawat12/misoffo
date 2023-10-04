<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>แบบฟอร์มใบเบิก</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- font -->
  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <style type="text/css">
  html {
      font-family:Kanit, "times New Roman", tahoma;
      font-size:14px;
      color:#000000;
  }
  body {
      font-family:Kanit, "times New Roman", tahoma;
      font-size:14px;
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
<body onload="window.print()">
<div class="page-break<?=(1==1)?"-no":""?>">&nbsp;</div>
<table width="750"  border="0">
  <tr >
    <th align="center" colspan="2">
      <span style="vertical-align: middle; font-size:16px;">ใบเบิก</span>
    </th>
  </tr>
  <tr >
    <td align="center" colspan="2">
      <table style="width:88%" border="0">
        <tr colspan="2">
          <td>
            <table width="100%" border="0">
                <tr>
                  <td align="left" class="headTitle">เขียน กองทุนน้ำบาดาล</td>
                  <td align="right" class="headTitle">วันที่ {{getDateShow($info->amount_date)}}<td>
                </tr>
              </table>
          </td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0">
              <tr>
                <td align="left" style="width: 7%;" class="headTitle">เรื่อง</td>
                <td align="left">ขอเบิกวัสดุ<td>
              </tr>
              <tr>
                <td align="left" style="width: 7%;" class="headTitle">เรียน</td>
                <td align="left">อธิบดีกรมทรัพยากรน้ำบาดาล ผ่าน ผู้อำนวยการกองบริหารกองทุนพัฒนาน้ำบาดาล<td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0">

              <?php 
                $institution = \App\Models\DataSetting::find((int) $info->institution);  
              ?>
              <tr>
                <td align="left" class="headTitle">&nbsp;&nbsp;&nbsp;&nbsp;ขอเบิกวัสดุสำหรับใช้ในราชการ ฝ่าย &nbsp;{{$institution->name}}&nbsp; ตามรายการต่อไปนี้</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0">
              <tr>
                <td align="left" style="width: 45%; vertical-align : top;">

                </td>
                <td align="left" style="width: 45%; vertical-align : top;">

                  <table width="100%" border="0">
                    <tr>
                      <td align="center" class="headTitle">{{$info->user_name}}&nbsp; ผู้เบิก</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle"> (...........................................................................................)</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">ตำแหน่ง &nbsp;..........................................................................................</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
            <td align="left" class="headTitle">
                <table width="100%" border="1">
                    <tr>
                        <th align="center" style="width: 10%;"> ลำดับ </th>
                        <th align="center" style="width: 50%;"> รายการ</th>
                        <th align="center" style="width: 10%;"> จำนวน </th>
                        <th align="center" style="width: 10%;"> หน่วยนับ </th>
                        <th align="center" style="width: 15%;"> ราคาบาท </th>
                        <th align="center" style="width: 15%;"> หมายเหตุ </th>
                    </tr>
                    <?php 
                      $durable = \App\Models\Durable::find((int) $info->durable_id); 

                      $unitcount = \App\Models\DataSetting::find((int) $durable->unitcount_id); 

                      $lot = \App\Models\DurableAmount::find((int) $info->lot_id); 
                      
                      $Checkitems = \App\Models\DurableDisbursement::where('lot_id', $info->id)->where('is_deleted', '0')->where('is_active','1')->sum('amount_num');

                      if($info->project_id == 0){
                          $name = 'สำนักงาน';
                      }else{
                          $project = \App\Models\Project::find((int) $info->project_id);

                          $name = $project->project_name;
                      } 
                    ?>

                    <tr>
                        <td align="center" style="width: 10%; height: 40px;" > 1. </td>
                        <td style="width: 50%;">{{$durable->durable_name}}</td>
                        <td align="center" style="width: 10%;">{{$info->amount_num}}</td>
                        <td align="center" style="width: 10%;">{{$unitcount->name}}</td>
                        <th align="center" style="width: 15%;">{{number_format($lot->amount_sum,2,'.',',')}}</th>
                        <td  style="width: 15%;">{{$name}} </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0">
              <tr>
                <td align="left" class="headTitle">ข้าพเจ้าจะส่งคืนทันทีในเมื่อได้ใช้ราชการเสร็จแล้ว</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0">
              <tr>
                
                <td align="left" style="width: 45%; vertical-align : top;">
                  <table width="100%" border="0">
                    <tr>
                      <td align="center" class="headTitle">เสนอ อทบ. ผ่าน ผอ.กทบ.</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">เห็นควรอนุญาตจ่ายได้</td>
                    </tr>
                    <tr>
                      <td align="left" class="headTitle" style="height: 50px;"></td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">..............................................................................................</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle"> (...........................................................................................)</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">..............................................................................................</td>
                    </tr>
                  </table>
                </td>
                <td style="width: 10%;">

                </td>
                <td align="left" style="width: 45%; vertical-align : top;">
                  <table width="100%" border="0">
                    <tr>
                      <td align="center" class="headTitle" style="font-size:24px;">อนุมัติ</td>
                    </tr>
                    <tr>
                      <td align="left" class="headTitle" style="height: 50px;"></td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">..............................................................................................</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle"> (...........................................................................................)</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">..............................................................................................</td>
                    </tr>
                  </table> 
                </td>
              </tr>
              <tr>
                
                <td align="left" style="width: 45%; vertical-align : top;">
                  
                </td>
                <td style="width: 10%;">
                  <table width="100%" border="0">
                    <tr>
                      <td align="center" class="headTitle">ข้าพเจ้าได้รับของไปถูกต้องแล้ว</td>
                    </tr>
                    <tr>
                      <td align="left" class="headTitle" style="height: 50px;"></td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">..............................................................................................</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle"> (...........................................................................................)</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">..............................................................................................</td>
                    </tr>
                  </table>
                </td>
                <td align="left" style="width: 45%; vertical-align : top;">

                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table> 
    </td>
  </tr>
</table>
</body>
</html>