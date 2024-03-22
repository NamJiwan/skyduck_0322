<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business MemberInput</title>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="./js/business_member_input.js"></script>
    <div id="inputform">
        <input type="hidden" name="id_chk" id="id_chk" value="0">
        <input type="hidden" name="email_chk" id="email_chk" value="0">
        <input type="hidden" name="business_number_chk" id="business_number_chk" value="0">
        <label for="business_member_id">아이디</label>
        <input type="text" name="id" id="business_member_id" placeholder="아이디를 입력해 주세요">
        <button id="btn_member_id_check" type="button">아이디 중복확인</button>
        <label for="business_member_password">비밀번호</label>
        <input type="password" name="password" id="business_member_password" placeholder="비밀번호를 입력해 주세요">
        <label for="business_member_password_chk">비밀번호확인</label>
        <input type="password" name="password_chk" id="business_member_password_chk" placeholder="확인용 비밀번호를 입력해 주세요">
        <label for="company_name">회사명</label>
        <input type="text" name="companyname" id="company_name" placeholder="회사명을 입력해 주세요">
        <label for="ceo_name">대표명</label>
        <input type="text" name="ceoname" id="ceo_name" placeholder="대표명을 입력해주세요">
        <div id="emailWrap">
            <label for="business_member_email">이메일</label>
            <input type="text" id="business_member_email" name="email" placeholder="이메일을 입력해주세요">
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
        <div id="mobileWrap">
            <label for="business_member_mobile">전화 번호</label>
            <input type="text" id="business_member_mobile" name="member_mobile" pattern="[0-9]{3}"> -
            <input type="text" id="business_member_mobile2" name="member_mobile2" pattern="[0-9]{4}"> -
            <input type="text" id="business_member_mobile3" name="member_mobile3" pattern="[0-9]{4}">
        </div>
        <div id="phoneWrap">
            <label for="business_member_phone">전화 번호</label>
            <input type="text" id="business_member_phone" name="member_phone" pattern="[0-9]{3}"> -
            <input type="text" id="business_member_phone2" name="member_phone2" pattern="[0-9]{4}"> -
            <input type="text" id="business_member_phone3" name="member_phone3" pattern="[0-9]{4}">
        </div>
        <div id="Wrap">
            <label for="business_member_fax">팩스 번호</label>
            <input type="text" id="business_member_fax" name="member_ㄴphone" pattern="[0-9]{3}"> -
            <input type="text" id="business_member_fax2" name="member_phone2" pattern="[0-9]{4}"> -
            <input type="text" id="business_member_fax3" name="member_phone3" pattern="[0-9]{4}">
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
        <label for="business_registration_number">사업자 등록 번호(-없이 입력)</label>
        <input type="text" name="business_registration_number" id="business_registration_number"
            placeholder="ex) 00000000">
        <button id="btn_business_number_chk" type="button">중복확인</button>
        <label for="business_type">업태</label>
        <input type="text" name="business_type" id="business_type" placeholder="업태를 입력해주세요">
        <label for="business_category">업종</label>
        <input type="text" name="business_category" id="business_category">
        <div id="imageWrap">
            <label for="business_image">사업자 등록증</label>
            <input type="file" name="business_image" id="business_image">
        </div>
        <button type="button" id="input_submit">확인</button>
    </div>
</body>

</html>