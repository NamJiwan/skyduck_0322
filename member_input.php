<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemberInput</title>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="./js/main.js"></script>
    <div id="inputform">
        <input type="hidden" name="id_chk" id="id_chk" value="0">
        <input type="hidden" name="email_chk" id="email_chk" value="0">
        <label for="member_id">아이디</label>
        <input type="text" name="id" id="member_id" placeholder="아이디를 입려해 주세요">
        <button id="btn_member_id_check" type="button">아이디 중복확인</button>
        <label for="member_password">비밀번호</label>
        <input type="password" name="password" id="member_password" placeholder="비밀번호를 입력해 주세요">
        <label for="member_password_check">비밀번호확인</label>
        <input type="password" name="password_check" id="member_password_check" placeholder="비밀번호를 다시 입력해 주세요">
        <div id="emailWrap">
            <label for="member_email">이메일</label>
            <input type="text" id="member_email" name="email" placeholder="이메일을 입력해주세요">
            <input type="text" id="manual_email_input" placeholder="이메일을 입력해 주세요">
            <select name="email_domain" id="email_domain">
                <option value="gmail.com">gmail.com</option>
                <option value="naver.com">naver.com</option>
                <option value="kakao.com">kakao.com</option>
                <option value="hanmail.net">hanmail.net</option>
                <option value="manual_input">직접입력</option>
            </select>
            <button id="btn_member_email_check" type="button">이메일 중복확인</button>
        </div>
        <label for="member_name">이름</label>
        <input type="text" name="name" id="member_name" placeholder="이름을 입력해 주세요">
        <div id="mobileWrap">
            <label for="member_mobile">전화 번호</label>
            <input type="text" id="member_mobile" name="member_mobile" pattern="[0-9]{3}"> -
            <input type="text" id="member_mobile2" name="member_mobile2" pattern="[0-9]{4}"> -
            <input type="text" id="member_mobile3" name="member_mobile3" pattern="[0-9]{4}">
        </div>
        <div id="phoneWrap">
            <label for="member_phone">전화 번호</label>
            <input type="text" id="member_phone" name="member_phone" pattern="[0-9]{3}"> -
            <input type="text" id="member_phone2" name="member_phone2" pattern="[0-9]{4}"> -
            <input type="text" id="member_phone3" name="member_phone3" pattern="[0-9]{4}">
        </div>
        <div id="addressWrap">
            <label for="member_zipcode">우편번호</label>
            <input type="text" name="zipcode" id="member_zipcode" readonly>
            <button id="btn_zipicode" type="button">우편번호 찾기</button>
            <div class="w-50">
                <label for="member_addr1">주소</label>
                <input type="text" name="member_addr1" id="member_addr1" placeholder="">
            </div>
            <div class="w-50">
                <label for="member_addr2">상세주소</label>
                <input type="text" name="member_addr2" id="member_addr2" placeholder="상세주소를 입력해 주세요">
            </div>
        </div>
        <div id="buttonwrap">
            <button id="input_btn" type="button">가입 확인</button>
        </div>
    </div>
</body>

</html>