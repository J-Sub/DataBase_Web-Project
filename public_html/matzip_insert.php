 <?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$rest_name = $_POST['rest_name'];
// 여기서는 product_id를 안써도 됨! 
// 온라인쉘에서 mall (use mall;) 로 들어가면 desc restaurant;로 확인하면 rest_id가 auto_increment임 
// 따라서 값이 추가되면 알아서 id가 increment되어 추가됨
$opendate = $_POST['opendate'];
$sort = $_POST['sort'];
$loca_name = $_POST['loca_name'];
$rate_point = $_POST['rate_point'];
 // 여기까지가 그 웹에서 써놓은 정보를 php lv로 다 받아온것!!
 
$ret = mysqli_query($conn, "insert into restaurant (rest_name, opendate, sort, loca_name, rate_point) values('$rest_name', '$opendate', '$sort', '$loca_name', '$rate_point')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('맛집 등록 성공!');
    echo "<meta http-equiv='refresh' content='0;url=matzip_list.php'>";
    // 메타가 refresh는 새로고침하면 matzip_list로 가라는것!
}

?>