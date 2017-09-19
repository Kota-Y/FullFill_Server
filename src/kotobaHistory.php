<?php
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$offset = $_POST["offset"];
		$offset = $offset * 10;
        $stmt = $conn->prepare("SELECT DISTINCT(kotoba.kotoba),kotoba.whose,user.username,user.image,kotoba.id FROM kotoba,user WHERE 1 AND kotoba.userid=user.id AND kotoba.userid=:userid LIMIT $offset,15");
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
			$id = mb_convert_encoding($result['id'],"utf-8","auto");
			print("\"id\":\"" . $id . "\"},{");
        }
		print("\"kotoba\":\"test\",\"whose\":\"test\",\"name\":\"test\",\"image\":\"test\",\"id\":\"0\"}]");
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
