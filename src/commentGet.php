<?php
    header("Content-Type: text/html; charset=UTF-8");
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT COUNT(userid) AS commentcount FROM comment WHERE 1 AND kotobaid=:kotobaid");
        $stmt->bindParam(':kotobaid', $_POST["kotobaid"]);
        $stmt->execute();

		print("[{");

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$commentcount = mb_convert_encoding($result['commentcount'],"utf-8","auto");
			print("\"commentcount\":\"" . $commentcount . "\"},{");
        }
        print("\"commentcount\":\"0\"}]");
    }
    catch(PDOException $e) {
        print(json_encode(-1));
    }
?>
