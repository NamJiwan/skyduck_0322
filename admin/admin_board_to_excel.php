<?php
    include "../inc/common.php";

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/Questionboard.php";

    $board = new Board($db);

    if ($ses_id != 'skyduck_admin') {
        echo "<script>
            alert('접근 권한 없음');
            window.location.href = './admin_login.php';
        </script>";
    };

    $rs = $board->getAllData();


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
            <td colspan="6" class="title">일반회원목록</td>
        </tr>
    </table>
    <table border="1">
        <tr>
            <td>번호</td>
            <td>이름</td>
            <td>비밀번호</td>
            <td>이메일</td>
            <td>휴대폰</td>
            <td>제목</td>
            <td>내용</td>
            <td>첨부파일명</td>
            <td>등록일시</td>
        </tr>
        <?php
            foreach($rs As $row){
                echo ' 
                        <tr>
                            <td>'.$row['idx'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['password'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['phone_number'].'</td>
                            <td>'.$row['PhoneNumber'].'</td>
                            <td>'.$row['title'].'</td>
                            <td>'.$row['content'].'</td>
                            <td>'.$row['attachments'].'</td>
                            <td>'.$row['posting_time'].'</td>
                        </tr> 
                    ';
            }
        ?>
    </table>
</body>

</html>