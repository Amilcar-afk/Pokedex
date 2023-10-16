<?php 
require('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
    <?php

        include('includes/header.php');
    ?>
    <link href="css/profil.css" rel="stylesheet">
    <title>Profil</title>
    <body>
        <main>
            <h1>mon compte</h1>
            <p id="amilcus">Mes infos</p>
            <?php
            $q = 'SELECT pseudo, email,image FROM user WHERE pseudo = ?';
            $req = $bdd->prepare($q);
            $req->execute([$_SESSION['pseudo']]);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $key => $value) { ?>
                <div>
                    <?php echo '<p class="data"><b>Pseudo : </b>' . $value['pseudo'] . '</p>'; ?>
                    <?php echo '<p class="data"><b>Email : </b>' . $value['email'] . '</p>'; ?><br>
                    <label><b>Image de profil: </b></label><img class="styleimg" src="<?php echo "uploads/" . $value['image']; ?>" alt="pokemon" class="imgCollection">
                </div>
                <?php
                    }
                ?>
                <br><br><br><br><br><br>
                <hr>
                <p id="amilcus">Mes infos</p>
                <?php
                $pre = 'SELECT id FROM user WHERE pseudo = ?';
                $req1 = $bdd->prepare($pre);
                $req1->execute([$_SESSION['pseudo']]);
                $data1 = $req1->fetchAll(PDO::FETCH_ASSOC);
                /*$id = $req->fetch();
                /*print_r($id);*/
                $_SESSION['id'] = $data1[0];
                $id = $_SESSION['id'];
                ?>
                <?php
                $q1 = 'SELECT nom,pv,attaque,defense,vitesse,image FROM pokemon WHERE id_user = ?';
                $req2 = $bdd->prepare($q1);
                $req2->execute([$id['id']]);
                $data2 = $req2->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="div1">
                <?php
                foreach($data2 as $key => $value) { ?>
                <div>
                    <?php echo '<b>' . $value['nom'] . '</b>'?>
                    <?php echo '<p class="data"><b>PV : </b>' . $value['pv'] . '</p>'; ?>
                    <?php echo '<p class="data"><b>Attaque : </b>' . $value['attaque'] . '</p>'; ?>
                    <?php echo '<p class="data"><b>Défense : </b>' . $value['defense'] . '</p>'; ?>
                    <?php echo '<p class="data"><b>Vitesse : </b>' . $value['vitesse'] . '</p>'; ?>
                    <img class="styleimg2" src="<?php echo "pokemon/" . $value['image']; ?>" alt="pokemon" class="imgCollection">
                </div>
                <?php
                    }
                ?>
                </div>
        </main>
    </body>
    <?php
        include('includes/footer.php');
    ?>
</html>
