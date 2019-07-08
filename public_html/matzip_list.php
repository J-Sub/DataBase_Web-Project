<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from restaurant natural join food ";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where rest_name like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : 다시 검색해주세요' . mysqli_error());
    }
    ?>
	<div>
		<h5><a href='matzip_reg.php'><font size = '4.5'>맛집 등록 하기!!</font></a></h5>
	</div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>이 름</th>
            <th>종 류</th>
            <th>더 보 기</th>
            <th>처 리</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['rest_name']}</td>";
			echo "<td>{$row['sort']}</td>";
            echo "<td><a href='matzip_view.php?rest_id={$row['rest_id']}'>자세히</a></td>";

            echo "<td width='10%'>
                <a href='matzip_reg.php?rest_id={$row['rest_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['rest_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(rest_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "matzip_delete.php?rest_id=" + rest_id;
            }else{   //철회
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
