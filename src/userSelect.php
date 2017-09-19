<?php
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("Select * From user"); 
        $stmt->execute();
        
		print("[{");
        
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$id = mb_convert_encoding($result['id'],"utf-8","auto");
			print("\"id\":\"" . $id . "\",");
			$userid = mb_convert_encoding($result['userid'],"utf-8","auto");
			print("\"userid\":\"" . $userid . "\",");
			$username = mb_convert_encoding($result['username'],"utf-8","auto");
			print("\"username\":\"" . $username . "\",");
			$password = mb_convert_encoding($result['password'],"utf-8","auto");
			print("\"password\":\"" . $password . "\",");
			$image = mb_convert_encoding($result['image'],"utf-8","auto");
			print("\"image\":\"" . $image . "\",");
			$selfkotoba = mb_convert_encoding($result['selfkotoba'],"utf-8","auto");
			print("\"selfkotoba\":\"" . $selfkotoba . "\"},{");
        }
        print("\"id\":\"0\",\"userid\":\"0\",\"username\":\"test\",\"password\":\"test\",\"image\":\"/img/icon1.jpg\",\"selfkotoba\":\"test\"}]");
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>