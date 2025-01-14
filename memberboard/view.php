<?php
$num = $_GET["num"]; // 레코드 번호
$page = $_GET["page"]; // 페이지 번호

include "db_con.php"; // DB 연결
$sql = "select * from memberboard where num=$num";
$result = mysqli_query($con, $sql); // SQL 명령 실행

$row = mysqli_fetch_assoc($result); // 키와 값 쌍으로 이루어진 연관 배열로 가져온다.

$id         = $row["id"]; // 아이디
$name       = $row["name"]; // 이름
$subject    = $row["subject"]; // 제목
$regist_day = $row["regist_day"]; // 작성일

$content = $row["content"]; // 내용
$content = str_replace(" ", "&nbsp;", $content); // 공백을 &nbsp;로 변환
$content = str_replace("\n", "<br>", $content); // 줄 바꿈 문자를 <br>로 변환)

$file_name = $row["file_name"]; // 파일명
$file_type = $row["file_type"]; // 파일 유형
$file_copied = $row["file_copied"]; // 파일 복사된 이름
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원 게시판</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>회원 게시판 > 내용보기</h2>
    <ul class="board_view">
        <li class="row1">
            <span class="col1"><b>제목 : </b><?=$subject?></span>
            <span class="col2"><?=$name?> | <?=$regist_day?></span>
        </li>
        <li class="row2">
            <?php
                if($file_name) { // $file_name이 빈 문자열일 경우 false로 취급된다.
                    $file_path = "./data/".$file_copied;
                    $file_size = filesize($file_path); // 파일 크기

                    echo "▷ 첨부파일 : $file_name ($file_size Byte)
                    &nbsp;&nbsp;
                    <a href='download.php?num=$num&file_copied=$file_copied&
                    file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                }
                echo $content;
            ?>
        </li>
    </ul>

    <ul class="buttons">
        <li><button onclick="location.href='list.php?page=<?=$page?>'">목록보기</button></li>
        <li><button onclick="location.href='modify_form.php?num=<?=$num?>&page=<?=$page?>'">
            수정하기</button></li>
        <li><button onclick="location.href='delete.php?num=<?=$num?>&page=<?=$page?>'">
            삭제하기</button></li>
        <li><button onclick="location.href='form.php'">글쓰기</button></li>
    </ul>

</body>

</html>