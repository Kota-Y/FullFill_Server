<?php
    header("Content-Type: text/html; charset=UTF-8");
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM favorite WHERE 1 AND userid=:userid");
        $stmt->bindParam(':userid', $_POST["userid"]);
        $stmt->execute();

		print("[{");

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $userid = mb_convert_encoding($result['userid'],"utf-8","auto");
			print("\"userid\":\"" . $userid . "\",");
			$kotobaid = mb_convert_encoding($result['kotobaid'],"utf-8","auto");
			print("\"kotobaid\":\"" . $kotobaid . "\"},{");
        }
		print("\"userid\":\"0\",\"kotobaid\":\"0\"}]");
    }
    catch(PDOException $e) {
        print(json_encode(-1));
    }
?>
