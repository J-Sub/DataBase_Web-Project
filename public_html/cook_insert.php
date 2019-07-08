 <?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
$cook_name = $_POST['cook_name'];
$sort = $_POST['sort'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation


 // 여기까지가 그 웹에서 써놓은 정보를 php lv로 다 받아온것!!
$ret = mysqli_query($conn, "insert into cook (cook_name, sort) values('$cook_name','$sort')");

if(!$ret)
{
	mysqli_query($conn, "rollback"); // 요리사 등록 query 수행 실패. 수행 전으로 rollback
	alert_message('Query Error : '.mysqli_error($conn));
}
else
{
	$cook_id = mysqli_insert_id($conn);
	mysqli_query($conn, "commit"); // 요리사 등록 query 수행 성공. 수행 내역 commit
	s_msg ('성공적으로 입력 되었습니다');
	echo "<meta http-equiv='refresh' content='0;url=cook_list.php'>";
}

?>