<?php
$mode = $_GET["mode"];
$num = $_GET["num"];
$pass = $_POST["pass"];

$con = mysqli_connect("localhost", "user", "12345", "sample");

$sql = "select pass from freeboard where num=$num";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

$db_password = $row["pass"];
mysqli_close($con);

// $pass : 입력 비밀번호, $db_password : DB 저장 비밀번호

if ($pass == $db_password) { // 입력 비밀번호가 DB 비밀번호와 같은 경우
    if ($mode == "modify") // 수정모드
        $url = "modify_form.php?num=$num";
    else    // 삭제모드
        $url = "delete.php?num=$num";

    echo "<script>
            self.close();
            opener.location.href = '$url';
        </script>";
} else { // 입력 비밀번호가 DB 비밀번호와 다른 경우
    // mode값도 같이 넘겨줘야 함. 예제 코드에서는 mode값을 넘겨주지 않았음.
    echo "<script>
    location.href='password_form.php?mode=$mode&num=$num&error=y'; 
    </script>";
}
