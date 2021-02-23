
<!DOCTYPE html>
<html>
        <?php
            include('includes/header.php');
        ?>
        <link href="css/addpokemon.css" rel="stylesheet">
        <title>Ajout de pokemon</title>
    <body>
        <?php
			if(isset($_GET['msg'])){
				echo '<h3>' . htmlspecialchars($_GET['msg']) . '</h3>';
			}
        ?>
        <main>
            <h1 class="title">ajouter un pokemon</h1>
            <form method="POST" action="verifpokemon.php" enctype="multipart/form-data">
                <input type="text" name="nom" placeholder="Nom" required><br>
                <input type="text" name="pv" placeholder="PV" required><br>
                <input type="text" name="attaque" placeholder="Attaque" required><br>
                <input type="text" name="defense" placeholder="Défense" required><br>
                <input type="text" name="vitesse" placeholder="Vitesse" required><br>
                <input type="file" name="image" value="Choisir un fichier" required><br>
                <input id="button" type="submit" Value="Ajouter">
            </form>
        </main>
    </body>
    <?php
        include('includes/footer.php');
    ?>
</html>