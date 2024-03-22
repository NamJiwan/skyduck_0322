<?php
// 세션을 시작합니다.
session_start();

// 모든 세션 변수를 제거합니다.
session_unset();

// 세션을 파기합니다.
session_destroy();

// 로그아웃 후, 로그인 페이지로 리다이렉트합니다.
header("Location: ./login.php");
exit();
?>
