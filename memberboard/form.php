<?php
include "session.php"; //세션 실행
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원 게시판</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function checkFileSize() {
            var fileInput = document.getElementById('upfile');
            if (fileInput.files.length === 0) {
                return true; // 파일이 선택되지 않은 경우 크기 체크를 건너뜀
            }
            var file = fileInput.files[0];
            var maxSize = 10 * 1024 * 1024; // 10MB

            if (file.size > maxSize) {
                alert('업로드 파일 크기가 지정된 용량(10MB)을 초과합니다! 파일 크기를 확인해주세요.');
                fileInput.value = ''; // 파일 입력 초기화
                return false;
            }
            return true;
        }
        function check_input() {
            if (!document.board.subject.value) { // 제목 체크
                alert("제목을 입력하세요!");
                document.board.subject.focus();
                return;
            }
            if (!document.board.content.value) { // 내용 체크
                alert("내용을 입력하세요!");
                document.board.content.focus();
                return;
            }
            if (!checkFileSize()) { // 파일 크기 체크
                return;
            }

            document.board.submit();
        }
    </script>
</head>

<body>
    <h2>회원 게시판 > 글쓰기</h2>
    <form name="board" method="post" action="insert.php" enctype="multipart/form-data">
        <ul class="board_form">
            <li>
                <span class="col1">이름 : </span>
                <span class="col2"><?=$username?></span>
            </li>
            <li>
                <span class="col1">제목 : </span>
                <span class="col2"><input name="subject" type="text"></span>
            </li>
            <li class="area">
                <span class="col1">내용 : </span>
                <span class="col2"><textarea name="content"></textarea></span>
            </li>
            <li>
                <span class="col1">첨부 파일</span>
                <span class="col2"><input type="file" name="upfile" id="upfile"></span>
            </li>
        </ul>

        <ul class="buttons">
            <li><button type="button" onclick="check_input()">저장하기</button></li>
            <li><button type="button" onclick="location.href='list.php'">목록보기</button></li>
        </ul>
    </form>
</body>

</html>