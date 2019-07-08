<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$cook_id = $_POST['cook_id'];
$cook_name = $_POST['cook_name'];
$sort = $_POST['sort'];

$ret = mysqli_query($conn, "update cook set cook_name = '$cook_name', sort = '$sort' where cook_id = '$cook_id' ");

if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=cook_list.php'>";
}


?>

