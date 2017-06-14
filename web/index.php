<?php
//// comment out the following two lines when deployed to production
//defined('YII_DEBUG') or define('YII_DEBUG', true);
//defined('YII_ENV') or define('YII_ENV', 'dev');
//
//require(__DIR__ . '/../vendor/autoload.php');
//require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
//require(__DIR__ . '/../functions.php');
//
//$config = require __DIR__ . '/../config/web.php';
//
//(new yii\web\Application($config))->run();




/*----------------------------------------------------*/

function debug($arr)
{
	echo '<pre class="debug" style =" color: #cc0000;">' . print_r($arr, true) . '</pre>';
}

$servername = "localhost";
$username = "x6312930_db";
$password = "111111";
$dbname = "x6312930_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($con,"utf8");
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}




//Выбираем данные из БД
$sql = "SELECT * FROM  test_categories";

$result = $conn->query($sql);

//Если в базе данных есть записи, формируем массив
if   ($result->num_rows > 0){
	$cats = [];


	//В цикле формируем массив разделов, ключом будет id родительской категории, а также массив разделов, ключом будет id категории
	while($cat = $result->fetch_assoc()){
		$cats_ID[$cat['id']][] = $cat;
		$cats[$cat['parent_id']][$cat['id']] = $cat;
	}
}

function build_tree($cats,$parent_id,$only_parent = false){
	if(is_array($cats) and isset($cats[$parent_id])){
		$tree = '<ul>';
		if($only_parent==false){
			foreach($cats[$parent_id] as $cat){
				$tree .= '<li>'.$cat['name'].' #'.$cat['id'];
				$tree .=  build_tree($cats,$cat['id']);
				$tree .= '</li>';
			}
		}elseif(is_numeric($only_parent)){
			$cat = $cats[$parent_id][$only_parent];
			$tree .= '<li>'.$cat['name'].' #'.$cat['id'];
			$tree .=  build_tree($cats,$cat['id']);
			$tree .= '</li>';
		}
		$tree .= '</ul>';
	}
	else return null;
	return $tree;
}

echo build_tree($cats,0);
//debug($cats);
//debug($cats);

//		if ($result->num_rows > 0) {
//			// output data of each row
//			while($row = $result->fetch_assoc()) {
//				echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//			}

/*---------------------------------------------------*/

