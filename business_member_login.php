<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>member_login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <script src="./js/business_login.js"></script>
    <h1>로그인</h1>
    <div id="loginWrap">
        <input type="text" id="member_login_id" placeholder="아이디 입력" autocomplete="off">
        <label for="member_login_id">아이디</label>
        <input type="text" id="b_number" placeholder="사업자 등록번호 입력" autocomplete="off">
        <label for="b_number">사업자 번호</label>
        <input type="password" id="member_login_password" placeholder="비밀번호 입력">
        <label for="member_login_password">비밀번호</label>
        <button type="button" id="btn_login">로그인</button>
    </div>
</body>

</html>