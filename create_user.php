<?php
require_once "pdo.php";

if ( isset($_POST['name']) && isset($_POST['email']) 
     && isset($_POST['password'])) {
    $sql = "INSERT INTO users (name, email, password) 
              VALUES (:name, :email, :password)";
    //echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password']));
}

if ( isset($_POST['delete']) && isset($_POST['user_id']) ) {
    $sql = "DELETE FROM users WHERE user_id = :zip";
    //echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['user_id']));
}

$stmt = $pdo->query("SELECT name, email, password, user_id FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>RDRS</title>
    <style>
		body {
			padding: 0;
			margin: 0;
			background: rgb(177, 0, 0);
		}

		abbr {
			text-decoration: none;
		}

		em {
			text-decoration: solid;
		}

		h1 {
			color: white;
			text-shadow: #000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px,
				#000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px;
			background: rgb(177, 0, 0);
			font-size: 70px;
			text-align: center;
			margin: 0;
			padding: 0;
			font-family: 'Times New Roman';
		}

		h2 {
			color: white;
			background: black;
			font-family: 'Times New Roman';
			font-size: 25px;
			text-align: center;
			margin: 0;
			padding: 0;
			font-family: 'Times New Roman';
		}

		h3 {
			color: white;
			text-shadow: #000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px,
				#000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px;
			background: rgb(177, 0, 0);
			font-size: 35px;
			text-align: center;
			margin: 0;
			padding: 0;
			font-family: 'Times New Roman';
		}

		nav {
			width: 100%;
			height: 50px;
			background-color: black;
		}

		ul {
			margin: 0;
			padding: 0;
		}

		ul li {
			list-style: none;
			display: inline-block;
			float: left;
			line-height: 50px;
		}

		ul li a {
			display: block;
			text-decoration: none;
			font-size: 30px;
			font-family: 'Times New Roman';
			color: white;
			padding: 0 70px;
		}

		ul li a:hover {
			background-color: rgb(58, 58, 58);
		}

		.skip-link {
			position: absolute;
			top: -40px;
			left: 0;
			background: black;
			color: white;
			padding: 8px;
		}

		.skip-link:focus {
			top: 0;
		}

		p {
			padding: 2px;
			margin: 10px;
			color: white;
			font-size: 20px;
			font-family: 'Times New Roman';
		}

		blockquote {
			block-size: 350px;
			border: solid;
			border-color: black;
			padding: 0;
			margin: 0;
			color: white;
			font-size: 25px;
			text-shadow: #000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px,
				#000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px;
			font-family: 'Times New Roman';
			background-image: url("oldtrafford.jpg");
		}

		audio {
			position: absolute;
			top: 500px;
			left: 0;
		}

		footer {
			color: white;
			border-style: solid;
			border-color: black;
			border-width: 3px 0px 0px 0px;
			font-family: 'Times New Roman';
			font-size: 20px;
			text-align: left;
			background-color: black;

		}
		button{
			width:100%;
			background-color: black;
			color:white;
			font-size: 50px;
		}
		input{
			background-color:black;
			color:white;
			font-size: 40px;
		}
		table, tr, td{
			font-size: 35px;
			border-color: black;
			width:100%;
		}
		p{
			text-align: center;
			font-size: 30px;
			color: black;
		}
	</style>
</head>
<body>

	<table border="1">
<?php
foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['name']);
    echo("</td><td>");
    echo($row['email']);
    echo("</td><td>");
    echo($row['password']);
    echo("</td><td>");
    echo('<form method="post"><input type="hidden" ');
    echo('name="user_id" value="'.$row['user_id'].'">'."\n");
    echo('<input type="submit" value="Del" name="delete">');
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
?>
<header>
		<h1>
			<abbr title="Red Devils Retro Shirts">RDRS</abbr>
		</h1>
	</header>
	<a href="#maincontent" class="skip-link">skip to main content</a>
	<nav>
		<ul>
			<li><a href="index.html">About us</a></li>
			<li><a href="products.php">Products</a></li>
			<li><a href="members.php">Members</a></li>
			<li><a href="video.html">Product Video</a></li>
			<li><a href="contactus.html">Contact us</a></li>
		</ul>
	</nav>
	<h2>
		Members
	</h2>
	<main id="maincontent">
    </table>
<p>Add new member</p>
<form method="post">
<p>Name:
<input type="text" name="name" size="30"></p>
<p>Email:
<input type="text" name="email"></p>
<p>Password:
<input type="password" name="password"></p>
<p><input type="submit" value="Add Member"/></p>
</form>
                </main>
                <footer>
		Website created by Greg Jaremko
	</footer>
</body>
