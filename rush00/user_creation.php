<?php
include("./globals.php");
include("./header.php");
include("./footer.php");
?>
<body>
	<div class="user_creation_form">
	<h2>nouvel utilisateur</h2>
	<form action="./create_user.php" method="post">
		Identifiant:<input name="login"/>
		Mot de passe: <input name="passwd"  type="password"/>
		<input type="submit" name="submit" value="OK"/>
	</form>
	</div>
</body>
<?php 
mysqli_close($conn);
footer();
?>
