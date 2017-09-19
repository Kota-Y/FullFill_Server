<?php
    header("Content-Type: text/html; charset=UTF-8");
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("SELECT MAX(id) AS maxid FROM kotoba");
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$maxid = $result['maxid'];

		$max1 = 0;
		$max2 = 0;
		$kotobaid1=0;
		$kotobaid2=0;
		for( $loop = 1; $loop <= $maxid; $loop++)
		{
			$stmt = $conn->prepare("SELECT COUNT(kotobaid) AS count FROM favorite WHERE 1 AND kotobaid=$loop");
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$temp = $result['count'];
			if( $max1 <= $temp )
			{
				$max2 = $max1;
				$max1 = $temp;
				$kotobaid2 = $kotobaid1;
				$kotobaid1 = $loop;
			}
			else if( $max2 <= $temp )
			{
				$max2 = $temp;
				$kotobaid2 = $loop;
			}
		}


		$stmt = $conn->prepare("SELECT kotoba.kotoba,kotoba.whose,user.username,user.image,kotoba.id FROM kotoba,user WHERE 1 AND kotoba.userid=user.id AND kotoba.id=$kotobaid2");
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
		print("\"kotoba\":\"test\",\"whose\":\"test\",\"username\":\"test\",\"image\":\"/img/icon1.jpg\",\"id\":\"0\"}]");
    }
    catch(PDOException $e) {
        print(json_encode(-1));
    }
?>
