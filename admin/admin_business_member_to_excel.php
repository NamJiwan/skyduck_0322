<?php
    include "../inc/common.php";

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/businessmember.php";

    $bmem = new BusinessMemeber($db);

    if ($ses_id != 'skyduck_admin') {
        echo "<script>
            alert('접근 권한 없음');
            window.location.href = './admin_login.php';
        </script>";
    };

    $rs = $bmem->getAllData();


    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=member.xls");
    header("Content-Description:PHP8 Generated Data");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .title {
        font-size: 25px;
        text-align: center;
        font-weight: 900;
    }
    </style>
</head>

<body>
    <table>
        <tr>
            <td colspan="6" class="title">사업자회원목록</td>
        </tr>
    </table>
    <table border="1">
        <tr>
            <td>번호</td>
            <td>아이디</td>
            <td>회사명</td>
            <td>대표명</td>
            <td>휴대폰</td>
            <td>연락처</td>
            <td>팩스번호</td>
            <td>우편번호</td>
            <td>주소</td>
            <td>사업자번호</td>
            <td>등록증 이미지</td>
            <td>업태</td>
            <td>업종</td>
            <td>등록일시</td>
        </tr>
        <?php
            foreach($rs As $row){
                echo ' 
                        <tr>
                            <td>'.$row['IDX'].'</td>
                            <td>'.$row['ID'].'</td>
                            <td>'.$row['CompanyName'].'</td>
                            <td>'.$row['CEOName'].'</td>
                            <td>'.$row['PhoneNumber'].'</td>
                            <td>'.$row['MobileNumber'].'</td>
                            <td>'.$row['FaxNumber'].'</td>
                            <td>'.$row['Email'].'</td>
                            <td>'.$row['ZipCode'].'</td>
                            <td>'.$row['Address'].' '. $row['DetailAddress'].'</td>
                            <td>'.$row['BusinessRegistrationNumber'].'</td>
                            <td>'.$row['BusinessRegistrationImage'].'</td>
                            <td>'.$row['BusinessType'].'</td>
                            <td>'.$row['BusinessCategory'].'</td>
                            <td>'.$row['SignupDate'].'</td>
                        </tr> 
                    ';
            }
        ?>
    </table>
</body>

</html>