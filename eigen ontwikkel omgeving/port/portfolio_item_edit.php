<?php

 include("connect.php");

 if(isset($_GET['id']) && is_numeric($_GET['id'])) {
 	$id = $_GET['id'];
 }


 	//bijwerken van gegevens
 	if(isset($_POST['submit']) && isset($_POST['titel']) && isset($_POST['content'])) { 
 		$titel = $_POST['titel'];
 		$content = $_POST['content'];

 		$sql = "UPDATE `portfolio_items` SET `titel` = :titel, `content` = :content WHERE `id` = :id";

 		$query = $conn->prepare($sql);
 		$query->bindParam(':titel', $titel, PDO::PARAM_STR);
 		$query->bindParam(':content', $content, PDO::PARAM_STR);
 		$query->bindParam(':id', $id, PDO::PARAM_STR);
 		$query->execute();

 		echo "Geupdate!";

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Project item bewerken</title>
</head>
<body>

	<?php

		if(isset($id)) {

			$resultaat = $conn->prepare("SELECT `titel`, `content`, `date` FROM `portfolio_items` WHERE `id` = $id");
			$resultaat->execute();
			foreach($resultaat as $row) { 
				?>
				<form method="POST">
					<input type="text" name="titel" value="<?php echo $row['titel']; ?> ">
					<br />
					<textarea rows="5" name="content"> <?php echo $row['content']; ?> </textarea>
					<br />
					<input type="submit" name="submit" value="Bijwerken">
					<br />
					<a href="portfolio_overzicht.php">Overzicht</a>
				</form>
			<?php 
			}

		}	else { 
			echo "Niks gevonden";
		}

	?>

</body>
</html>