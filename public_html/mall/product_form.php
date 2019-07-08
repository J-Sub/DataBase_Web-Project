<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname); // 이걸로 connection 설정!!!!
$mode = "입력"; // 프로덕트_form이므로 mode라는 변수에 '입력'이 들어가있음
$action = "product_insert.php"; // 디폴트값으로 설정 -> 입력을 누르면 에서는 insert.php로 연결!

if (array_key_exists("product_id", $_GET)) { // 이 if문은 get array로 product_id값이 있다면! 이 if문을 실행하라는 것 
    $product_id = $_GET["product_id"]; // 즉 상품목록 -> 에서 '수정'에서 들어가면 주소창 뒤에 product_id가 php?뒤에 뜨게됨 
    $query =  "select * from product where product_id = $product_id"; // 
    $res = mysqli_query($conn, $query); 
    $product = mysqli_fetch_array($res);
    if(!$product) {
        msg("물품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "product_modify.php"; // 만약 링크를 타고 들어갔다면 modify.php를 부름!
    
    
    // echo json_encode($product);
}

$manufacturers = array();


$query = "select * from manufacturer"; // 하는 이유 : 상품 등록으로 들어가면 제조사가 뜸
// 제조사에는 코리아 유니브, 애플, 삼성, 엘쥐, 네이버 가 있음
// 이 목록은 현재 내 데이터베이스에 있음
// 확인은 오픈쉘에서 확인가능
//
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $manufacturers[$row['manufacturer_id']] = $row['manufacturer_name'];
}
?>
    <div class="container">
        <form name="product_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="product_id" value="<?=$product['product_id']?>"/>
            <!--여기서 hidden은 product_id의 값이 없으므로  -->
            <h3>상품 정보 <?=$mode?></h3> <!--목록에서 수정 타고 들어가면 '수정', 바로 상품등록으로 들어가면 '입력'!  -->
            <p>
                <label for="manufacturer_id">제조사</label>
                <select name="manufacturer_id" id="manufacturer_id">  <!--옵션값을 만들어주는거! 그 리스트처럼 뜨게 해주는 것 -->
                    <option value="-1">선택해 주십시오.</option> <!-- 평소엔 -1로 디폴트로! -->
                    <?
                        foreach($manufacturers as $id => $name) { // 이건 manufacturere의 값을 id값처럼 받아와 name에 넣겠다!
                            if($id == $product['manufacturer_id']){
                            	// 만일 아이디가 product의 manufacturer의 id로 갖고 있다면!!
                                echo "<option value='{$id}' selected>{$name}</option>";
                                // 에코에 뒤에 selected를 해야함!
                                //왜냐하면 그 id값을 selected해야하므로 
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="product_name">상품명</label>
                <input type="text" placeholder="상품명 입력" id="product_name" name="product_name" value="<?=$product['product_name']?>"/>
            <!-- placeholder가 그 쓰기전에 나와있고 쓰기 시작하면 사라짐 value로 하면 쓸때 지워지지 않음 -->
            </p>
            <p>
                <label for="product_desc">상품설명</label>
                <textarea placeholder="상품설명 입력" id="product_desc" name="product_desc" rows="10"><?=$product['product_desc']?></textarea>
            </p>
            <p>
                <label for="price">가격</label>
                <input type="number" placeholder="정수로 입력" id="price" name="price" value="<?=$product['price']?>" />
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>
            <!-- return validate은 제조사 id가 디폴트로 -1 임  이를 검사하는 것이 있음 밑에!!-->

            <script>
                function validate() {
                    if(document.getElementById("manufacturer_id").value == "-1") {
                        alert ("제조사를 선택해 주십시오"); return false;
                        // 그럼 아까 저 바로 위에 저 코드에 의해 값이 입력 안되어있는 것을 체크하면 제조사를 선택하라고 팝업 뜸!
                    }
                    else if(document.getElementById("product_name").value == "") {
                        alert ("상품명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("product_desc").value == "") {
                        alert ("상품설명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("price").value == "") {
                        alert ("가격을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>