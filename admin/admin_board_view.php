<?php
    session_start();

    $ses_id = (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] != '') ? $_SESSION['ses_id'] : '';

    // 로그아웃 로직
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        session_destroy();
        header("Location: ../index.php");
        exit();
    }

    if ($ses_id != 'skyduck_admin') {
        echo "<script>
            alert('접근 권한 없음');
            window.location.href = './admin_login.php';
        </script>";
    }

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/Questionboard.php";
    include "../inc/reply.php";

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                self.location.href = './admin_board.php';
            </script>
        ");
    };

    $board = new Board($db);
    $reply = new Reply($db);

    $row = $board->getInfoFormIdx($idx);
    $replyrow = $reply->getInfoBoardIdx($idx);
    // print_r($row);
    // print_r($row);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/admin_main.css">
    <link rel="stylesheet" href="./css/admin_board_view.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="./js/admin_board_view.js"></script>
</head>

<body>
    <div class="area"></div>
    <nav class="main-menu">
        <ul>
            <li>
                <a href="./admin_main.php">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        메인
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="./admin_member.php">
                    <i class="fa fa-globe fa-2x"></i>
                    <span class="nav-text">
                        회원관리
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="./admin_business_member.php">
                    <i class="fa fa-comments fa-2x"></i>
                    <span class="nav-text">
                        사업자 회원 관리
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="./admin_qna.php">
                    <i class="fa fa-camera-retro fa-2x"></i>
                    <span class="nav-text">
                        문의 관리
                    </span>
                </a>

            </li>
            <li>
                <a href="./admin_board.php">
                    <i class="fa fa-film fa-2x"></i>
                    <span class="nav-text">
                        게시판 관리
                    </span>
                </a>
            </li>
            <li>
                <a href="./admin_portfolio.php">
                    <i class="fa fa-book fa-2x"></i>
                    <span class="nav-text">
                        포트폴리오 관리
                    </span>
                </a>
            </li>
        </ul>

        <ul class="logout">
            <li>
                <a href="?logout=1">
                    <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">
                        로그아웃
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <div id="main_wrap">
        <table>
            <!-- Array ( [idx] => 8
            [name] => data
            [password] => 1234
            [email] => test@test.com
            [phone_number] => 0101111111
            [title] => teset
            [content] => ewtsefgda
            [attachments] => data-1.png, data-2.png, data-3.png
            [posting_time] => 2024-03-08 17:20:59 ) -->
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" required value="<?= $row['name'] ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="password">Password (4-digit):</label></td>
                <td><input type="text" id="password" name="password" min="1000" max="9999" required
                        value="<?= $row['password'] ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required value="<?= $row['email'] ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="phone_number">Phone Number:</label></td>
                <td><input type="tel" id="phone_number" name="phone_number" required value="<?= $row['phone_number'] ?>"
                        readonly></td>
            </tr>
            <tr>
                <td><label for="title">Title:</label></td>
                <td><input type="text" id="title" name="title" required value="<?= $row['title'] ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="content">Content:</label></td>
                <td><textarea id="content" name="content" rows="4" required readonly><?= $row['content'] ?></textarea>
                </td>
            </tr>
            <!-- <tr>
                <td><label for="attachments">Attachments (comma-separated file names):</label></td>
                <td><input type="file" id="attachments" name="attachments" multiple></td>
            </tr> -->
        </table>
        <?php
            if (!empty($replyrow)) {
        ?>
        <button id="reply_view" type="button" data-idx="<?= $row['idx']; ?>">답글보기</button>
        <?php
        } else {
        ?>
        <button id="reply" type="button" data-idx="<?= $row['idx']; ?>">답글달기</button>
        <?php
        }
        ?>
        <button id="view_all" type="button">전체보기</button>
    </div>
    <div id="imagewrap">
        <?php
        $images = explode(", ", $row['attachments']);

        for ($i = 0; $i < count($images); $i++) {
            echo '<h3>'.$images[$i].'</h3>';
            echo '<img src="./../data/board_attachment/'.$images[$i].'" alt="설명'.($i+1).'" width=400>';
        }
    ?>
    </div>
</body>

</html>