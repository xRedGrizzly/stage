<?php

	include("connect.php");

	if(isset($_POST['submit']) && isset($_POST['titel']) && isset($_POST['content'])) {

		$titel = $_POST['titel'];
		$content = $_POST['content'];

		$sql = "INSERT INTO `portfolio_items` (titel, content, date, active) VALUES (:titel, :content, NOW(), 1)";

		$query = $conn->prepare($sql);
		$query->bindParam(':titel', $titel, PDO::PARAM_STR);
		$query->bindParam(':content', $content, PDO::PARAM_STR);
		$query->execute();

		echo "opgeslagen!";

		}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Portfolio item toevoegen</title>
</head>
<body>
	<form method="POST">
		<input type="text" name="titel" placeholder="Titel">
		<br />
		<textarea rows="5" name="content" placeholder="Content"></textarea>
		<br />
		<input type="submit" name="submit" value="Opslaan">
        <br />
        <a href="portfolio_overzicht.php">Overzicht</a>
	</form>
</body>
</html>