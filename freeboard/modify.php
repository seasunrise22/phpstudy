<?php
    // 한국 시간대로 설정
    date_default_timezone_set('Asia/Seoul');

    $num = $_GET["num"];

    $name = $_POST["name"]; // 이름
    $pass = $_POST["pass"]; // 비밀번호
    $subject = $_POST["subject"]; // 제목
    $content = $_POST["content"]; // 내용

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);
    $regist_day = date("Y-m-d (H:i)");  // 한국 시간 기준 '년-월-일 (시:분)' // 이거는 수정일을 바꿔야...?

    $con = mysqli_connect("localhost", "user", "12345", "sample");

    $sql = "update freeboard set name='$name', pass='$pass', subject='$subject', ";
     $sql .= "content='$content', regist_day='$regist_day'
     where num=$num"; // 레코드 수정 명령

    mysqli_query($con, $sql); // $sql에 저장된 명령 실행

    mysqli_close($con); // DB 연결 끊기

    // 목록 페이지로 이동
    echo "<script>location.href = 'list.php';</script>";
?>