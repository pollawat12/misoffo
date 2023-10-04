@extends('default.template-export')

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>แบบฟอร์มใบยืม</title>
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
<body>
<div class="page-break<?=(1==1)?"-no":""?>">&nbsp;</div>
<table width="750"  border="0">
  <tr >
    <th align="center" colspan="2">
      <span style="vertical-align: middle; font-size:16px;">ใบยืม</span>
    </th>
  </tr>
  <tr >
    <td align="center" colspan="2">
      <table style="width:88%" border="0">
        <tr colspan="2">
          <td>
            <table width="100%" border="0">
                <tr>
                  <td align="left" class="headTitle">เขียน....................................................................................</td>
                  <td align="right" class="headTitle">วันที่....................................................................................<td>
                </tr>
              </table>
          </td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0">
              <tr>
                <td align="left" style="width: 7%;" class="headTitle">เรื่อง</td>
                <td align="left">ขอยืมครุภัณฑ์<td>
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
              <tr>
                <td align="left" class="headTitle">&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าขอยืมครุภัณฑ์ตามจำนวนและรายการดังต่อไปนี้ เพื่อใช้ในราขการของ &nbsp;...............................................................................</td>
              </tr>
              <tr>
                <td align="left" class="headTitle">...............................................................................................................................................................................................................................................................</td>
              </tr>
              <tr>
                <td align="left" class="headTitle">ตั้งแต่วันที่ &nbsp;.......................................................................................... &nbsp; ถึงวันที่ &nbsp; .......................................................................................... </td>
              </tr>
              <tr>
                <td align="left" class="headTitle">ขอได้จ่ายให้ข้าพเจ้ายืมด้วย ดังรายการต่อไปนี้</td>
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
                        <th align="center" style="width: 15%;"> หน่วยนับ </th>
                        <th align="center" style="width: 15%;"> หมายเหตุ </th>
                    </tr>
                    <tr>
                        <td align="center" style="width: 10%; height: 40px;" >  </td>
                        <td style="width: 50%;"> </td>
                        <td align="center" style="width: 10%;">  </td>
                        <td align="center" style="width: 15%;">  </td>
                        <td  style="width: 15%;">  </td>
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
                      <td align="center" class="headTitle" style="font-size:24px;">อนุญาต</td>
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
                  </table> 
                </td>
                <td style="width: 10%;">

                </td>
                <td align="left" style="width: 45%; vertical-align : top;">
                  <table width="100%" border="0">
                    <tr>
                      <td align="center" class="headTitle">ลงชื่อ &nbsp;..............................................................................................&nbsp; ผู้ยืม</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle"> (...........................................................................................)</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">ตำแหน่ง &nbsp;..........................................................................................</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">สำนัก/กอง/ศูนย์ &nbsp;...................................................................................................</td>
                    </tr>
                    <tr>
                      <td align="left" class="headTitle" style="height: 30px;"></td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">(ลงชื่อ) &nbsp;............................................................................................</td>
                    </tr>
                    <tr>
                      <td align="right" class="headTitle"> &nbsp;(...........................................................................................)</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">ตำแหน่ง &nbsp;..........................................................................................</td>
                    </tr>
                    <tr>
                      <td align="left" class="headTitle" style="height: 30px;"></td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">&nbsp;..............................................................................................................</td>
                    </tr>
                    <tr>
                      <td align="left" class="headTitle" style="height: 5px;"></td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">(ลงชื่อ) &nbsp;............................................................................................</td>
                    </tr>
                    <tr>
                      <td align="right" class="headTitle"> &nbsp;(...........................................................................................)</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">ตำแหน่ง &nbsp;..........................................................................................</td>
                    </tr>
                    <tr>
                      <td align="center" class="headTitle">วันที่ &nbsp;...................................................................................................</td>
                    </tr>
                  </table>
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