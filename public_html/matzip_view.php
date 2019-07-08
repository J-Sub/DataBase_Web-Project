<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("rest_id", $_GET)) {
    $rest_id = $_GET["rest_id"];
    $query = "select * from restaurant natural join food where rest_id = $rest_id";
    $res = mysqli_query($conn, $query);
    $restaurant = mysqli_fetch_assoc($res);
    if (!$restaurant) {
        // msg("맛집이 존재하지 않습니다.");
        	echo mysqli_error($conn);

    }
}


?>
    <div class="container fullwidth">

        <h3>맛집 정보 상세 보기</h3>
        
        	<p>
                <label for="rest_name"> 맛집 이름</label>
                <input readonly type="text" id="rest_name" name="rest_name" value="<?=$restaurant['rest_name']?>"/>
            
            </p>
            <p>
                <label for="opendate">오픈일</label>
                <input readonly type="text"  id="opendate" name="opendate" value="<?=$restaurant['opendate']?>"/>
            </p>
            <p>
                <label for="sort">식사분류</label>
                <input readonly type="text"  id="sort" name="sort" value="<?=$restaurant['sort']?>" />
            </p>
            <p>
                <label for="loca_name">맛집 위치</label>
                <input readonly type="text" id="loca_name" name="loca_name" value="<?=$restaurant['loca_name']?>" />
            </p>
            <p>
                <label for="rate_point">평가 점수</label>
                <input readonly type="text"  id="rate_point" name="rate_point" value="<?=$restaurant['rate_point']?>" />
            </p>
    </div>
<? include("footer.php") ?>