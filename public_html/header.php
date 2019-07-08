<!DOCTYPE html>

<style>
	.flex-div{
		display:flex;
		justify-content: space-around;
		font-size:24px;
	}
	.font{
		font-size:30px;
	}
</style>
<html lang='ko'>
<head class="font">
    <title>쿠맛집</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="matzip_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">쿠맛집</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="쿠맛집 통합검색">
                </li>
                
            </ul>
        </div>
    </div>
    <div class="flex-div">
    	<a href='matzip_list.php'>맛집 목록</a>
    	<a href='cook_list.php'>요리사 목록</a>
    	<!-- <a href='product_form.php'>평가 목록</a>
    	<a href='site_info.php'>음식 목록</a> -->
    	<a href='site_info.php'>KuFood</a>
    </div>

</form>