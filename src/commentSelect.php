<?php
    header("Content-Type: text/html; charset=UTF-8");
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT DISTINCT(comment.comment),user.username,user.image FROM comment,kotoba,user WHERE 1 AND comment.kotobaid=kotoba.id  AND  comment.userid=user.id AND kotoba.id=:kotobaid");
        $stmt->bindParam(':kotobaid', $_POST["kotobaid"]);
        $stmt->execute();

		print("[{");

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $comment = mb_convert_encoding($result['comment'],"utf-8","auto");
			print("\"comment\":\"" . $comment . "\",");
			$username = mb_convert_encoding($result['username'],"utf-8","auto");
			print("\"username\":\"" . $username . "\",");
			$image = mb_convert_encoding($result['image'],"utf-8","auto");
			print("\"image\":\"" . $image . "\"},{");
        }
		print("\"comment\":\"test\",\"username\":\"test\",\"image\":\"/img/icon1.jpg\"}]");
    }
    catch(PDOException $e) {
        print(json_encode(-1));
    }
?>
