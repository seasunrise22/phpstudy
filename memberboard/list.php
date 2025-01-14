<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원 게시판</title>
    <link rel="stylesheet" href="style.css">
    <script>
    </script>
</head>

<body>
    <h2>회원 게시판 > 목록보기</h2>
    <ul class="board_list">
        <li>
            <span class="col1">번호</span>
            <span class="col2">제목</span>
            <span class="col3">글쓴이</span>
            <span class="col4">첨부</span>
            <span class="col5">등록일</span>
        </li>
        <?php
        include "session.php"; //세션 실행

        if (isset($_GET["page"]))
            $page = $_GET["page"];
        else
            $page = 1;

        include "db_con.php"; // DB 연결
        $sql = "select * from memberboard order by num desc";
        $result = mysqli_query($con, $sql); // SQL 명령 실행

        $total_record = mysqli_num_rows($result); // 전체 글 수

        $scale = 2; // 한 페이지에 보여질 글 수

        // 전체 페이지 수($total_page) 계산
        if($total_record % $scale == 0)
            $total_page = floor($total_record/$scale); // floor: 소수점 이하 버림
        else
            $total_page = floor($total_record/$scale) + 1;

        // 표시할 페이지($page)에 따라 $start 계산
        $start = (intval($page) - 1) * $scale; // intval: 정수로 변환

        $number = $total_record - $start; // 글 번호 매김
        for ($i = $start; $i<$start+$scale && $i<$total_record; $i++) {
            mysqli_data_seek($result, $i); // 레코드 포인터 이동
            $row = mysqli_fetch_assoc($result); // 현재 행을 연관 배열로 가져온다.

            $num        = $row["num"];          // 레코드 번호
            $id         = $row["id"];           // 아이디
            $name       = $row["name"];         // 이름
            $subject    = $row["subject"];      // 제목
            $regist_day = $row["regist_day"];   // 작성일
            if($row["file_name"])
                $file_image = "<img src='./file.png'>";
            else
                $file_image = " "; // 파일이 있으면 이미지 아이콘, 없으면 공백
        ?>
            <li>
                <span class="col1"><?= $number ?></span> <!-- echo 단축 문법 -->
                <span class="col2">
                    <a href="view.php?num=<?= $num ?>&page=<?=$page?>"><?= $subject ?></a></span>
                <span class="col3"><?= $name ?></span>
                <span class="col4"><?= $file_image ?></span>
                <span class="col5"><?= $regist_day ?></span>
            </li>

        <?php
            $number--; // 왜 이렇게 하지? 그냥 $num을 col1에 넣으면 더 직관적이지 않나?
        }
        mysqli_close($con);
        ?>
    </ul>

    <!-- 페이지 번호 매김 -->
     <ul class="page_num">
        <?php
            if($total_page>=2 && $page>=2) {
                $new_page = $page-1;
                echo "<li>
                <a href='list.php?page=$new_page'>◀ 이전</a>
                </li>";
            } else 
                echo "<li>&nbsp;</li>";
            
            // 게시판 목록 하단에 페이지 링크 번호 출력
            for($i=1; $i<=$total_page; $i++) {
                if($page == $i) // 현재 페이지 번호 링크 안함
                    echo "<li><b>$i</b></li>";
                else
                    echo "<li><a href='list.php?page=$i'>$i</a></li>";
            }

            if($total_page>=2 && $page!=$total_page) {
                $new_page = $page+1;
                echo "<li>
                <a href='list.php?page=$new_page'>다음 ▶</a>
                </li>";
            } else 
                echo "<li>&nbsp;</li>";
        ?>
     </ul> <!-- 페이지 번호 매김 끝 -->

    <ul class="buttons">
        <li><button onclick="location.href='list.php?page=<?=$page?>'">목록</button></li> <!-- 이거는 필요 없지 않나? -->
        <li><button onclick="location.href='form.php'">글쓰기</button></li>
    </ul>

</body>

</html>