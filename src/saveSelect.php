<?php
    header("Content-Type: text/html; charset=UTF-8");
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$offset = $_POST["offset"];
		$offset = $offset * 10;
		$stmt = $conn->prepare("SELECT DISTINCT(kotoba.kotoba),kotoba.whose,user.username,user.image,favorite.kotobaid FROM favorite,kotoba,user WHERE 1 AND favorite.kotobaid=kotoba.id  AND  kotoba.userid=user.id AND favorite.userid=:userid LIMIT $offset,15");
        $stmt->bindParam(':userid', $_POST["userid"]);
        $stmt->execute();

		print("[{");

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$kotoba = mb_convert_encoding($result['kotoba'],"utf-8","auto");
			print("\"kotoba\":\"" . $kotoba . "\",");
			$whose = mb_convert_encoding($result['whose'],"utf-8","auto");
			print("\"whose\":\"" . $whose . "\",");
			$username = mb_convert_encoding($result['username'],"utf-8","auto");
			print("\"username\":\"" . $username . "\",");
			$image = mb_convert_encoding($result['image'],"utf-8","auto");
			print("\"image\":\"" . $image . "\",");
			$kotobaid = mb_convert_encoding($result['kotobaid'],"utf-8","auto");
			print("\"kotobaid\":\"" . $kotobaid . "\"},{");
        }
		print("\"kotoba\":\"test\",\"whose\":\"test\",\"username\":\"test\",\"image\":\"/img/icon1.jpg\",\"kotobaid\":\"0\"}]");

    }
    catch(PDOException $e) {
        print(json_encode(-1));
    }
?>
