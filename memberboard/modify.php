<?php
// 한국 시간대로 설정
date_default_timezone_set('Asia/Seoul');

$num = $_GET["num"];
$page = $_GET["page"];

$subject = $_POST["subject"]; // 제목
$content = $_POST["content"]; // 내용

$subject = htmlspecialchars($subject, ENT_QUOTES); // 특수문자 처리
$content = htmlspecialchars($content, ENT_QUOTES); // 특수문자 처리
$regist_day = date("Y-m-d (H:i)"); // 현재 시간

$upload_dir = "./data/"; // 업로드 디렉토리

$upfile_name = $_FILES["upfile"]["name"]; // 업로드 파일명
$upfile_tmp_name = $_FILES["upfile"]["tmp_name"]; // 임시 파일명
$upfile_type = $_FILES["upfile"]["type"]; // 파일 유형
$upfile_size = $_FILES["upfile"]["size"]; // 파일 크기
$upfile_error = $_FILES["upfile"]["error"]; // 에러

if($upfile_name && !$upfile_error) { // 파일이 있고 에러가 없다면
    $file = explode(".", $upfile_name); // 파일명을 .을 기준으로 분리
    $file_name = $file[0]; // 파일명
    $file_ext = $file[1]; // 확장자

    $copied_file_name = date("Y_m_d_H_i_s"); // 현재 시간
    $copied_file_name .= "." . $file_ext; // 현재 시간과 확장자를 합침
    $uploaded_file = $upload_dir . $copied_file_name; // 파일을 업로드 디렉토리에 저장

    if($upfile_size > 10000000) { // 바이트 단위, 파일 용량이 10MB를 넘어간다면
        echo "
    <script>
        alert('업로드 파일 크기가 지정된 용량(10MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
        history.go(-1);
    </script>
    ";
    exit;        
    }

    if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)) { // 파일을 업로드 디렉토리로 이동 실패했을 경우
        echo "
    <script>
        alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
        history.go(-1);
    </script>
    ";
    exit;      
    }
} else { // 파일이 없거나 에러가 있다면
    $upfile_name = "";
    $upfile_type = "";
    $copied_file_name = "";
}

include "db_con.php"; // DB 연결

$sql = "update memberboard set subject='$subject', content='$content', regist_day='$regist_day', ";
$sql .= "file_name='$upfile_name', file_type='$upfile_type', file_copied='$copied_file_name' ";
$sql .= "where num=$num"; // 레코드 수정 명령

mysqli_query($con, $sql); // $sql에 저장된 명령 실행

mysqli_close($con); // DB 연결 끊기

// 목록 페이지로 이동
echo "<script>location.href = 'list.php?page=$page';</script>";
