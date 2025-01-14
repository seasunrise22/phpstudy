<?php
$num            = $_GET["num"]; // 레코드 번호. 이거는 안 쓰는데 왜 넘겨받음.
$file_copied    = $_GET["file_copied"]; // 실제 저장된 파일명
$file_name      = $_GET["file_name"]; // 첨부 파일명
$file_type      = $_GET["file_type"]; // 파일 유형
$file_path      = "./data/".$file_copied; // 파일 경로

if(file_exists($file_path)) { // 파일이 존재한다면
    header("Content-Type: application/octet-stream");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file_name");
    header("Content-Transfer-Encoding: binary");
    header("Cache-Control: cache, must-revalidate");
    header("Pragma: public");
    header("Content-Length: ".filesize($file_path));

    flush();
    readfile($file_path);
    die();
}
?>