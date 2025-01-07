<?php
$id = $_POST["id"]; // 아이디
$pass = $_POST["pass"]; // 비밀번호

$con = mysqli_connect("localhost", "user", "12345", "sample");
$sql = "select * from members where id='$id'";
$result = mysqli_query($con, $sql);

$num_match = mysqli_num_rows($result); // 구지 이렇게 하지 말고 $row = mysqli_fetch_assoc($result); 로 해도?

if (!$num_match) {
    echo "
    <script>
    window.alert('등록되지 않은 아이디입니다!');
    history.go(-1);
    </script>
    ";
} else {
    $row = mysqli_fetch_assoc($result);
    $db_pass = $row["pass"];

    mysqli_close($con); // DB 연결 끊기

    if ($pass != $db_pass) {
        echo "
    <script>
    window.alert('비밀번호가 틀립니다!');
    history.go(-1);
    </script>
    ";
    } else {
        session_start();
        $_SESSION["userid"] = $row["id"]; // 세션 변수에 DB에서 가져온 값 할당
        $_SESSION["username"] = $row["name"]; // 세션 변수에 DB에서 가져온 값 할당

        echo "
        <script>
        location.href = 'index.php';
        </script>
        ";
    }
}
