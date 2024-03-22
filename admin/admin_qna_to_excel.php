<?php
    include "../inc/common.php";

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/qna.php";

    $qna = new Qna($db);

    if ($ses_id != 'skyduck_admin') {
        echo "<script>
            alert('접근 권한 없음');
            window.location.href = './admin_login.php';
        </script>";
    };

    $rs = $qna->getAllData();


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
            <td colspan="6" class="title">견적문의 목록</td>
        </tr>
    </table>
    <table border="1">
        <tr>
            <td>번호</td>
            <td>이름</td>
            <td>연락처</td>
            <td>이메일</td>
            <td>회사명</td>
            <td>직급</td>
            <td>웹사이트</td>
            <td>카테고리</td>
            <td>예산</td>
            <td>스케줄</td>
            <td>등록일시</td>
        </tr>
        <?php
            foreach($rs As $row){
                echo ' 
                        <tr>
                            <td>'.$row['idx'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['contact_number'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['company_name'].'</td>
                            <td>'.$row['position'].'</td>
                            <td>'.$row['website'].'</td>
                            <td>'.$row['service_required'].'</td>
                            <td>'.$row['budget'].'</td>
                            <td>'.$row['timeline'].'</td>
                            <td>'.$row['additional_notes'].'</td>
                            <td>'.$row['created_at'].'</td>
                        </tr> 
                    ';
            }
        ?>
    </table>
</body>

</html>