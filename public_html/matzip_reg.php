<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname); // 이걸로 connection 설정!!!!
$mode = "등록"; // 프로덕트_form이므로 mode라는 변수에 '입력'이 들어가있음
$action = "matzip_insert.php"; // 디폴트값으로 설정 -> 입력을 누르면 에서는 insert.php로 연결!

if (array_key_exists("rest_id", $_GET)) { // 이 if문은 get array로 product_id값이 있다면! 이 if문을 실행하라는 것 
    $rest_id = $_GET["rest_id"]; // 즉 상품목록 -> 에서 '수정'에서 들어가면 주소창 뒤에 product_id가 php?뒤에 뜨게됨 
    $query =  "select * from restaurant where rest_id = $rest_id"; // 
    $res = mysqli_query($conn, $query); 
    $restaurant = mysqli_fetch_array($res);
    
    $mode = "수정";
    $action = "matzip_modify.php"; // 만약 링크를 타고 들어갔다면 modify.php를 수정하고 완료했을 때 부름!
    
    // echo json_encode($restaurant);
}

// $restaurant = array();


$query = "select * from restaurant"; // 하는 이유 : 상품 등록으로 들어가면 제조사가 뜸
// 제조사에는 코리아 유니브, 애플, 삼성, 엘쥐, 네이버 가 있음
// 이 목록은 현재 내 데이터베이스에 있음
// 확인은 오픈쉘에서 확인가능
//
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $restaurant[$row['rest_id']] = $row['rest_name'];
    // echo json_encode($restaurant);
}
?>
    <div class="container">
        <form name="matzip_reg" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="rest_id" value="<?=$restaurant['rest_id']?>"/>
            <!--여기서 hidden은 product_id의 값이 없으므로  -->
            <h3> 맛집 정보 <?=$mode?></h3> <!--목록에서 수정 타고 들어가면 '수정', 바로 상품등록으로 들어가면 '입력'!  -->
            
            
            <p>
                <label for="rest_name"> 맛집 이름</label>
                <input type="text" placeholder="맛집명 입력" id="rest_name" name="rest_name" value="<?=$restaurant['rest_name']?>"/>
            <!-- placeholder가 그 쓰기전에 나와있고 쓰기 시작하면 사라짐 value로 하면 쓸때 지워지지 않음 -->
            </p>
            <p>
                <label for="opendate">오픈일</label>
                <input type="date" placeholder="오픈일 입력! " id="opendate" name="opendate" value="<?=$restaurant['opendate']?>"/>
            </p>
            <p>
                <label for="sort">식사분류</label>
                <input type="text" placeholder="<한식, 중식, 일식, 양식, 분식> 중 하나로 입력" id="sort" name="sort" value="<?=$restaurant['sort']?>" />
            </p>
            <p>
                <label for="loca_name">맛집 위치</label>
                <input type="text" placeholder="<이공캠, 정후, 정문> 중 하나로 입력" id="loca_name" name="loca_name" value="<?=$restaurant['loca_name']?>" />
            </p>
            <p>
                <label for="rate_point">평가 점수</label>
                <input type="text" placeholder="<1,2,3,4,5> 중 하나로 입력" id="rate_point" name="rate_point" value="<?=$restaurant['rate_point']?>" />
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>
            <!-- return validate은 제조사 id가 디폴트로 -1 임  이를 검사하는 것이 있음 밑에!!-->

            <script>
                function validate() {
                    if(document.getElementById("rest_name").value == "") {
                        alert ("맛집이름을 입력해 주십시오"); return false;
                        // 그럼 아까 저 바로 위에 저 코드에 의해 값이 입력 안되어있는 것을 체크하면 제조사를 선택하라고 팝업 뜸!
                    }
                    else if(document.getElementById("opendate").value == "") {
                        alert ("상품명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("sort").value == "") {
                        alert ("식사분류를 제대로 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("loca_name").value == "") {
                        alert ("위치를 제대로 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("rate_point").value == "") {
                        alert ("평가를 제대로 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>