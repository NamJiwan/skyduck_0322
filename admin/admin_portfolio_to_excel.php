<?php
    include "../inc/common.php";

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/portfolio.php";

    $port = new Portfolio($db);

    if ($ses_id != 'skyduck_admin') {
        echo "<script>
            alert('접근 권한 없음');
            window.location.href = './admin_login.php';
        </script>";
    };

    $rs = $port->getAllData();


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
            <td colspan="6" class="title">포트폴리오 목록</td>
        </tr>
    </table>
    <table border="1">
        <tr>
            <td>번호</td>
            <td>카테고리</td>
            <td>프로젝트명</td>
            <td>설명</td>
            <td>이미지 이름</td>
            <td>등록일시</td>
        </tr>
        <?php
            foreach($rs As $row){
                echo ' 
                        <tr>
                            <td>'.$row['idx'].'</td>
                            <td>'.$row['Category'].'</td>
                            <td>'.$row['Name'].'</td>
                            <td>'.$row['description'].'</td>
                            <td>'.$row['ImageRoute'].'</td>
                            <td>'.$row['UploadDate'].'</td>
                        </tr> 
                    ';
            }
        ?>
    </table>
</body>

</html>