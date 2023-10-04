<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แจ้งรหัสผ่านชั่วคราว</title>

    <style>
        @media screen {
            @import url(http://fonts.googleapis.com/css?family=Open+Sans:400);
            td, h1, h2, h3 {
                font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif !important;
            }
        }
        body {
            font-size: 14.5px;
        }
        table {
            width: 750px;
        }
        td {
            padding:10px;
        }
    </style>
</head>
<body>
    <center>
        <table>
            <thead>
                <tr>
                    <td><img src="https://misoffo.com/assets/img/offo-new-logo_0.png" width="350" alt=""></td>
                </tr>
            </thead>
    
            <tbody>
                <tr style="height:15px;">
                    <td></td>
                </tr>
                <tr style="">
                    <td>
                        <span>ลืมรหัสผ่าน</span>
                    </td>
                </tr>
                <tr style="padding-bottom: 25px;">
                    <td>
                        <span>เรียนคุณ {{$content['name']}} <br></span>
                        <span>ระบบได้ทำการจัดส่ง รหัสผ่านใหม่เพื่อเข้าใช้ระบบชั่วคราว</span>
                    </td>
                </tr>
                <tr style="padding-bottom: 25px;">
                    <td><span>รหัสผ่านใหม่ : {{$content['new_password']}}</span></td>
                </tr>
                <tr style="padding-bottom: 25px;">
                    <td><span>เมื่อเข้าระบบเรียบร้อยแล้ว เพื่อความปลอดภัยของบัญชีใช้งานคุณ กรุณาเปลี่ยนรหัสผ่านใหม่ ค่ะ</span></td>
                </tr>
    
                <tr style="height:35px;">
                    <td></td>
                </tr>
    
                <tr>
                    <td>
                        ขอแสดงความนับถือ <br>
                        สำนักงานกองทุนน้ำมันเชื้อเพลิง (Oil Fuel Fund Office) <br>
                        Website: https://misoffo.com
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </tbody>
        </table>
    
        </center>
</body>
</html>