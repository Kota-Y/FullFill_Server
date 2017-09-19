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
        $stmt = $conn->prepare("SELECT * FROM kotoba ORDER BY id DESC LIMIT $offset,15");
        //$stmt->bindParam(':offset', $_POST["offset"]);
        $stmt->execute();
        
	
		print("[{");

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$id = mb_convert_encoding($result['id'],"utf-8","auto");
			print("\"id\":\"" . $id . "\",");
			$userid = mb_convert_encoding($result['userid'],"utf-8","auto");
			print("\"userid\":\"" . $userid . "\",");
			$kotoba = mb_convert_encoding($result['kotoba'],"utf-8","auto");
			print("\"kotoba\":\"" . $kotoba . "\",");
			$whose = mb_convert_encoding($result['whose'],"utf-8","auto");
			print("\"whose\":\"" . $whose . "\"},{");
        }
		print("\"id\":\"0\",\"userid\":\"0\",\"kotoba\":\"test\",\"whose\":\"test\"}]");
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
