<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$product_name = $_POST['product_name'];
// 여기서는 product_id를 안써도 됨! 
// 온라인쉘에서 mall (use mall;) 로 들어가면 desc product; 하면 product_id가 auto_increment임 
// 따라서 값이 추가되면 알아서 id가 increment되어 추가됨
$product_desc = $_POST['product_desc'];
$manufacturer_id = $_POST['manufacturer_id'];
$price = $_POST['price'];
 // 여기까지가 그 웹에서 써놓은 정보를 php lv로 다 받아온것!!
 
$ret = mysqli_query($conn, "insert into product (product_name, product_desc, manufacturer_id, price, added_datetime) values('$product_name', '$product_desc', '$manufacturer_id', '$price', NOW())");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=product_list.php'>";
    // 메타가 refresh는 새로고침하면 product_list로 가라는것!
}

?>

