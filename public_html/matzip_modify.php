<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$rest_id = $_POST['rest_id'];
$rest_name = $_POST['rest_name'];
$opendate = $_POST['opendate'];
$sort = $_POST['sort'];
$loca_name = $_POST['loca_name'];
$rate_point = $_POST['rate_point'];

$ret = mysqli_query($conn, "update restaurant set rest_name = '$rest_name', opendate = '$opendate', sort = '$sort', loca_name = '$loca_name', rate_point = '$rate_point' where rest_id = '$rest_id'");

if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('수정 성공!');
    echo "<meta http-equiv='refresh' content='0;url=matzip_list.php'>";
}


?>

