<?php

include ("connexion_bdd.php");

if($_GET['Table']=="EMPRUNT"){
    $info['id']=$_GET['id'];
    $requet_EMPRUNT="SELECT * FROM EMPRUNT WHERE idAdherent=".$info['id'].";";
    $donnees=mysql_query($requet_EMPRUNT);
    $message="Que voulez vous modifiez ?";
}elseif($_GET['Table']=="AUTEUR"){
    $info['id']=$_GET['id'];
    $requet_AUTEUR="SELECT * FROM AUTEUR WHERE idAuteur=".$info['id'].";";
    $donnees=mysql_fetch_array($requet_AUTEUR);
    $message="Que voulez vous modifiez ?";
}elseif($_GET['Table']=="ADHERENT"){
    $info['id']=$_GET['id'];
    $requet_ADHERENT="SELECT * FROM ADHERENT WHERE idAdherent=".$info['id'].";";
    $donnees=mysql_fetch_array($requet_ADHERENT);
    $message="Que voulez vous modifiez ?";
}elseif($_GET['Table']=="OEUVRE"){
    $info['id']=$_GET['id'];
    $requet_OEUVRE="SELECT * FROM OEUVRE WHERE idAdherent=".$info['id'].";";
    $reponse= $ma_connexion_mysql->exec($requet_OEUVRE);
    $donnees=$reponse->fetchAll();
    $message="Que voulez vous modifiez ?";
}elseif($_GET['Table']=="EXEMPLAIRE"){
    $info['id']=$_GET['id'];
    $requet_EXEMPLAIRE="SELECT * FROM EXEMPLAIRE WHERE idAdherent=".$info['id'].";";
    $reponse= $ma_connexion_mysql->exec($requet_EXEMPLAIRE);
    $donnees=$reponse->fetchAll();
    $message="Que voulez vous modifiez ?";
}else{
    $message="Aucune entrée";
}

?>

<!DOCTYPE html>
<html>
<?php include("header.php")?>
<form action="modif.php" method="post">
    <div id="page" class="text-center page margin-top-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group responsive-table-line">
                        <h4 class="text-info"><?= $message ?></h4>
                        <table class="table">
                            <tbody>
                                <?php
                                    while ($reponse = mysql_fetch_array($donnees)){
                                        $reponse = mysql_fetch_array($result);
                                        echo $donnees [0];
                                    }
                                ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary btn-embossed btn-wide btn-lg pull-right"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                        <a href="index.php">
                            <button class="btn-warning btn btn-primary btn-embossed btn-lg btn-wide pull-right">
                                <span class="glyphicon glyphicon-minus"></span> Annuler
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php include("footer.php")?>
</html>