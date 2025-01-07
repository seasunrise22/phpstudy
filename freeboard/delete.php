<?php
    // 한국 시간대로 설정
    date_default_timezone_set('Asia/Seoul');

    $num = $_GET["num"];

    $con = mysqli_connect("localhost", "user", "12345", "sample");
    $sql = "delete from freeboard where num=$num";  // 레코드 삭제 명령

    mysqli_query($con, $sql); // $sql에 저장된 명령 실행

    mysqli_close($con); // DB 연결 끊기

    // 목록 페이지로 이동
    echo "<script>location.href = 'list.php';</script>";
?>