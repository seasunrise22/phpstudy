<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>아이디 중복체크</title>
    <style>
        .close { margin: 20px 0 0 120px; cursor: pointer; }
    </style>
</head>
<body>
    <h3>아이디 중복체크</h3>
    <div> <!-- div 태그 안에 둘 필요가 있나? -->
        <?php
        $id = $_GET["id"];

        if(!$id) {
            echo("아이디를 입력해 주세요!"); // 괄호 필요없지 않나?
        }
        else {
            $con = mysqli_connect("localhost", "user", "12345", "sample");

            $sql = "select * from members where id='$id'"; // select id 로 id만 가져오는 게 낫지 않나?
            $result = mysqli_query($con, $sql); // $sql에 저장된 명령 실행

            $num_record = mysqli_num_rows($result); // 결과 레코드 수

            if($num_record) { // 이미 등록된 아이디라면
                echo $id . " 아이디는 중복됩니다.<br>";
                echo "다른 아이디를 사용해 주세요!<br>";
            }
            else {
                echo $id . " 아이디는 사용 가능합니다.<br>";
            }
            mysqli_close($con); // DB 연결 끊기
        }
        ?>
    </div>
    <div class="close"> <!-- button 태그에 직접 class로 넣어야 제대로 style 적용되는데... -->
        <button onclick="javascript:self.close()">창 닫기</button>
    </div>
</body>
</html>