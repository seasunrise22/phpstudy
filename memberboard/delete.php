<?php
$num = $_GET["num"];
$page = $_GET["page"];

include "db_con.php";

$sql = "delete from memberboard where num=$num";  // 레코드 삭제 명령

mysqli_query($con, $sql); // $sql에 저장된 명령 실행

mysqli_close($con); // DB 연결 끊기

// 목록 페이지로 이동
echo "<script>location.href = 'list.php?page=$page';</script>";
