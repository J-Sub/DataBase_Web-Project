<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$rest_id = $_GET['rest_id'];

$ret = mysqli_query($conn, "delete from restaurant where rest_id = $rest_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('당신은 맛집을 삭제하였습니다.');
    echo "<meta http-equiv='refresh' content='0;url= matzip_list.php'>";
}

?>

