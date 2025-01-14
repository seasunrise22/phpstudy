<?php
    // 한국 시간대로 설정
    date_default_timezone_set('Asia/Seoul');

    $id = $_GET["id"];

    $pass = $_POST["pass"]; // 비밀번호
    $name = $_POST["name"]; // 이름
    $email = $_POST["email"]; // 이메일

    $con = mysqli_connect("localhost", "user", "12345", "sample");

    $sql = "update members set pass='$pass', name='$name', email='$email'";
    $sql .= " where id='$id'"; // 레코드 수정 명령

    mysqli_query($con, $sql); // $sql에 저장된 명령 실행
    mysqli_close($con); // DB 연결 끊기

    // 목록 페이지로 이동
    echo "<script>location.href = 'index.php';</script>";
?>