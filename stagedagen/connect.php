<?php
try{
	$conn = new PDO('mysql:host=localhost;dbname=stagedagen',"root", "");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOExeption $e) {
	echo "error: " . $e0>getMessage();
}


?>