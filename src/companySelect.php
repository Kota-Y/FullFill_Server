<?php
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM company"); 
        $stmt->execute();
        
	
		print("[{");

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$id = mb_convert_encoding($result['id'],"utf-8","auto");
			print("\"id\":\"" . $id . "\",");
			$catchcopy = mb_convert_encoding($result['catchcopy'],"utf-8","auto");
			print("\"catchcopy\":\"" . $catchcopy . "\",");
			$name = mb_convert_encoding($result['name'],"utf-8","auto");
			print("\"name\":\"" . $name . "\",");
			$image = mb_convert_encoding($result['image'],"utf-8","auto");
			print("\"image\":\"" . $image . "\"},{");
        }
		print("\"id\":\"0\",\"catchcopy\":\"test\",\"name\":\"test\",\"image\":\"/ccop/icon1.jpg\"}]");
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
