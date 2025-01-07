<?php
// 한국 시간대로 설정
date_default_timezone_set('Asia/Seoul');

$id = $_POST["id"]; // 아이디
$pass = $_POST["pass"]; // 비밀번호호
$name = $_POST["name"]; // 이름
$email = $_POST["email"]; // 이메일

$regist_day = date("Y-m-d (H:i)");  // 한국 시간 기준 '년-월-일 (시:분)'

$con = mysqli_connect("localhost", "user", "12345", "sample");

$sql = "insert into members (id, pass, name, email, regist_day, level, point) ";
$sql .= "values('$id', '$pass', '$name', '$email', '$regist_day', 9, 0)";

mysqli_query($con, $sql); // SQL 명령 실행
mysqli_close($con); // DB 연결 끊기

// 로그인 폼으로 이동
echo "
<script>
location.href = 'login_form.php';
</script>";
?>