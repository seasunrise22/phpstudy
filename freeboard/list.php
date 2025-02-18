<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자유 게시판</title>
    <link rel="stylesheet" href="style.css">
    <script>
    </script>
</head>

<body>
    <h2>자유 게시판 > 목록보기</h2>
    <ul class="board_list">
        <li>
            <span class="col1">번호</span>
            <span class="col2">제목</span>
            <span class="col3">글쓴이</span>
            <span class="col4">등록일</span>
        </li>
    <?php
    $con = mysqli_connect("localhost", "user", "12345", "sample");
    $sql = "select * from freeboard order by num desc";
    $result = mysqli_query($con, $sql); // SQL 명령 실행
    $total_record = mysqli_num_rows($result); // 전체 글 수

    $number = $total_record; // 글 번호 매김
    for($i=0; $i<$total_record; $i++) {
        mysqli_data_seek($result, $i); // 레코드 포인터 이동
        $row = mysqli_fetch_assoc($result); // 현재 행을 연관 배열로 가져온다.

        $num        = $row["num"];          // 레코드 번호
        $name       = $row["name"];         // 이름
        $subject    = $row["subject"];      // 제목
        $regist_day = $row["regist_day"];   // 작성일
    ?>
    <li>
        <span class="col1"><?=$number?></span> <!-- echo 단축 문법 -->
        <span class="col2">
            <a href="view.php?num=<?=$num?>"><?=$subject?></a></span>
        <span class="col3"><?=$name?></span>
        <span class="col4"><?=$regist_day?></span>
    </li>

    <?php
    $number--; // 왜 이렇게 하지? 그냥 $num을 col1에 넣으면 더 직관적이지 않나?
    }
    mysqli_close($con);
    ?>
    </ul>    
    <ul class="buttons">
        <li><button onclick="location.href='list.php'">목록</button></li> <!-- 이거는 필요 없지 않나? -->
        <li><button onclick="location.href='form.php'">글쓰기</button></li>
    </ul>
    
</body>

</html>