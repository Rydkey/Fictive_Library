<?php
// 1° appel de la page : un parmètre de nom "id" existe dans l'url  http://votreUrl/Produit_delete?id=valeur


if(isset($_GET['id']) AND $_GET['Table']=="EMPRUNT")
{
    include ("connexion_bdd.php");
    $ma_requete_SQL_Emprunt = "SELECT * FROM EMPRUNT WHERE idAdherent= ".$_GET['id']." AND noExemplaire= ".$_GET['noExemplaire'].";";
    $reponse = $ma_connexion_mysql->query($ma_requete_SQL_Emprunt);
    $donnees = $reponse->fetch();
    $table=$_GET['Table'];
}
elseif(isset($_GET['id']) AND $_GET['Table']=="AUTEUR")
{
    include ("connexion_bdd.php");
    $ma_requete_SQL_Auteur = "SELECT * FROM AUTEUR WHERE idAuteur= ".$_GET['id'].";";

    $reponse = $ma_connexion_mysql->query($ma_requete_SQL_Auteur);
    $donnees = $reponse->fetch();
    $table=$_GET['Table'];
}
elseif(isset($_GET['id']) AND $_GET['Table']=="OEUVRE")
{
    include ("connexion_bdd.php");
    $ma_requete_SQL_Oeuvre = "SELECT * FROM OEUVRE WHERE noOeuvre= ".$_GET['id'].";";
    $reponse = $ma_connexion_mysql->query($ma_requete_SQL_Oeuvre);
    $donnees = $reponse->fetch();
    $table=$_GET['Table'];

}
elseif(isset($_GET['id']) AND $_GET['Table']=="ADHERENT")
{
    include ("connexion_bdd.php");
    $ma_requete_SQL_Adherent = "SELECT * FROM ADHERENT WHERE idAdherent= ".$_GET['id'].";";
    $reponse = $ma_connexion_mysql->query($ma_requete_SQL_Adherent);
    $donnees = $reponse->fetch();
    $table=$_GET['Table'];

}

elseif(isset($_GET['id']) AND $_GET['Table']=="EXEMPLAIRE")
{
    include ("connexion_bdd.php");
    $ma_requete_SQL_Exemplaire = "SELECT * FROM EXEMPLAIRE WHERE noExemplaire= ".$_GET['id'].";";
    $reponse = $ma_connexion_mysql->query($ma_requete_SQL_Exemplaire);
    $donnees = $reponse->fetch();
    $table=$_GET['Table'];

}

else{
    $erreur="Il n'y à pas d'entrée séléctionnée.";
}

// traitement lors de la soumission du formulaire
if( isset($_POST["Supprimer"]) AND isset($_POST["idAdherent"]) AND isset($_POST['Table']) && $_POST['Table']=='EMPRUNT' ){
    $donnees['idAdherent']=htmlentities($_POST['idAdherent']);
    $donnees['noExemplaire']=htmlentities($_POST['noExemplaire']);

    include ("connexion_bdd.php");

    $ma_requete_SQL_EMPRUNT = $ma_connexion_mysql->prepare("DELETE FROM EMPRUNT WHERE idAdherent = :id AND noExemplaire = :noExp;");
    $ma_requete_SQL_EMPRUNT->bindValue(":id", $donnees['idAdherent']);
    $ma_requete_SQL_EMPRUNT->bindValue(":noExp", $donnees['noExemplaire']);
    $ma_requete_SQL_EMPRUNT->execute();

    header("Location: gestion_test_emprunt.php");

}
elseif( isset($_POST["Supprimer"]) AND isset($_POST["idAuteur"]) AND isset($_POST['Table']) && $_POST['Table']=='AUTEUR' ){
    $donnees['idAuteur']=htmlentities($_POST['idAuteur']);
    include ("connexion_bdd.php");

    $ma_requete_SQL_AUTEUR = $ma_connexion_mysql->prepare("DELETE FROM AUTEUR WHERE idAuteur = :id;");
    $ma_requete_SQL_AUTEUR->bindValue(":id", $donnees['idAuteur']);
    $ma_requete_SQL_AUTEUR->execute();

    header("Location: gestion_test_auteur.php");

}
elseif( isset($_POST["Supprimer"]) AND isset($_POST["noOeuvre"]) AND isset($_POST['Table']) && $_POST['Table']=='OEUVRE' ){
    $donnees['noOeuvre']=htmlentities($_POST['noOeuvre']);
    include ("connexion_bdd.php");

    $ma_requete_SQL_OEUVRE = $ma_connexion_mysql->prepare("DELETE FROM OEUVRE WHERE noOeuvre = :id;");
    $ma_requete_SQL_OEUVRE->bindValue(":id", $donnees['noOeuvre']);
    $ma_requete_SQL_OEUVRE->execute();

    header("Location: gestion_test_oeuvres.php");
}
elseif( isset($_POST["Supprimer"]) AND isset($_POST["idAdherent"]) AND isset($_POST['Table']) AND $_POST['Table']=='ADHERENT' ){
    $donnees['idAdherent']=htmlentities($_POST['idAdherent']);
    include ("connexion_bdd.php");

    $ma_requete_SQL_ADHERENT = $ma_connexion_mysql->prepare("DELETE FROM ADHERENT WHERE idAdherent = :id;");
    $ma_requete_SQL_ADHERENT->bindValue(":id", $donnees['idAdherent']);
    $ma_requete_SQL_ADHERENT->execute();

    header("Location: gestion_test_adherent.php");
}

elseif( isset($_POST["Supprimer"]) AND isset($_POST["noExemplaire"]) AND isset($_POST['Table']) AND $_POST['Table']=='EXEMPLAIRE' ){

    $donnees['noExemplaire']=htmlentities($_POST['noExemplaire']);
    include ("connexion_bdd.php");

    $ma_requete_SQL_Exemplaire = $ma_connexion_mysql->prepare("DELETE FROM EXEMPLAIRE WHERE noExemplaire = :id;");
    $ma_requete_SQL_Exemplaire->bindValue(":id", $donnees['noExemplaire']);
    $ma_requete_SQL_Exemplaire->execute();

    header("Location: gestion_test_exemplaire.php");
}

?>


<!DOCTYPE html>
<html>
<?php include("header.php")?>
<div id="page" class="page margin-top-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-danger"><?php if(isset($erreur)) echo $erreur; else echo "Souhaitez vous réellement supprimer cette entrée ?";?></h4>
                    <form action="suppr.php" method="post">
                        <input type="hidden" name="Table" value="<?php if(isset($_GET['Table'])) echo $_GET['Table']; ?>">
                        <input name="noOeuvre" type="hidden" value="<?php if(isset($donnees['noOeuvre'])) echo $donnees['noOeuvre']; ?>">
                        <input name="idAdherent"  type="hidden" value="<?php if(isset($donnees['idAdherent'])) echo $donnees['idAdherent']; ?>"/>
                        <input name="noExemplaire"  type="hidden" value="<?php if(isset($donnees['noExemplaire'])) echo $donnees['noExemplaire']; ?>"/>
                        <input name="idAuteur"  type="hidden" value="<?php if(isset($donnees['idAuteur'])) echo $donnees['idAuteur']; ?>"/>
                        <input type="submit" class="btn-danger btn btn-primary btn-embossed btn-lg btn-wide pull-right" name="Supprimer" value="Supprimer" />
                    </form>
                <a href="index.php"><button type="submit" class="btn-warning btn btn-primary btn-embossed btn-lg btn-wide pull-right"><span class="glyphicon glyphicon-minus"></span> Annuler</button></a>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php")?>
</html>