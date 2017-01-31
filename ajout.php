<?php
//$r = $pdo->prepare("UPDATE machin SET truc = ? and abc = ? where ma bite = :39 centimètres;");
//$r->execute(array("le premier param", "le deuxiieme", "le troisième"));
?>

<?php  include('connexion_bdd.php')?>

<?php
$erreurs=array();
$donnees=array();

if(isset($_POST['nom_auteur']) AND isset($_POST["prenom_auteur"])AND isset($_POST['submit'])){
    // ## contrôle des données
    $donnees['nom_auteur']=$_POST['nom_auteur'];
    $donnees['prenom_auteur']=htmlentities($_POST['prenom_auteur']);

    if ((! preg_match("/^[A-Za-z ]{2,}/",$donnees['nom_auteur']))) $erreurs['nom_auteur']='nom composé de 2 lettres minimum';
    if ((! preg_match("/^[A-Za-z ]{2,}/",$donnees['prenom_auteur']))) $erreurs['prenom_auteur']='Prénom composé de 2 lettres minimum';
//    if(! is_numeric($donnees['prenom_auteur']))$erreurs['prenom_erreur']='veuillez saisir une valeur';
//    if(! is_numeric($donnees['prix']))$erreurs['prix']='saisir une valeur numérique';
//    if (! preg_match("/[A-Za-z0-9]{2,}.(jpeg|jpg|png)/",$donnees['photo'])) $erreurs['photo']='nom de fichier incorrect (extension jpeg , jpg ou png)';

    if(empty($erreurs)) {
        // ## accés au modéle
        $ma_requete_SQL = "INSERT INTO AUTEUR VALUES (NULL,'".$donnees['nom_auteur']."','".$donnees['prenom_auteur']."');";
        $ma_connexion_mysql->exec($ma_requete_SQL);
        // ## redirection
    }
}

if(isset($_POST['submit']) AND isset($_POST['Exemplaire']) AND isset($_POST['idAdherent'])) {
    $donnees['idAdherent'] = htmlentities($_POST['idAdherent']);
    $donnees['noExemplaire'] = htmlentities($_POST['Exemplaire']);
    $donnees['date_emprunt'] = htmlentities($_POST['date_emprunt']);

    if ($donnees['idAdherent']=="0") $erreurs['idAdherent']='Sélectionnez un Adhérent valide';
    if ($donnees['noExemplaire']=="0") $erreurs['Exemplaire']='Sélectionnez un Exemplaire valide';

    if (empty($erreurs)) {
        $reponse_EMPRUNT = "INSERT INTO EMPRUNT VALUES(". $donnees['idAdherent'].",".$donnees['noExemplaire'].",'".$donnees['date_emprunt']."',NULL);";
        $ma_connexion_mysql->exec($reponse_EMPRUNT);
    }
}

if (isset($_POST['submit']) AND isset($_POST['idAuteur']) AND isset($_POST['titre']) AND isset($_POST['date_parution'])) {
    $donnees['idAuteur'] = htmlentities($_POST['idAuteur']);
    $donnees['titre'] = htmlentities($_POST['titre']);
    $donnees['date_parution'] = htmlentities($_POST['date_parution']);

    if ((!preg_match("/^[A-Za-z ]{2,}/", $donnees['titre']))) $erreurs['titre'] = 'Titre composé de 2 lettres minimum';
    if ($donnees['idAuteur']=="0") $erreurs['idAuteur']="Sélectionnez un Auteur valide";


    if (empty($erreurs)) {
        $reponse_OEUVRE = "INSERT INTO OEUVRE VALUES(NULL,'".$donnees['titre']."','".$donnees['date_parution']."',".$donnees['idAuteur'].");";
        $ma_connexion_mysql->exec($reponse_OEUVRE);
    }
}

if (isset($_POST['submit']) AND isset($_POST['prix']) AND isset($_POST['date_achat']) AND isset($_POST['etat']) AND isset($_POST['noOeuvre'])) {
    $donnees['noOeuvre'] = htmlentities($_POST['noOeuvre']);
    $donnees['prix'] = htmlentities($_POST['prix']);
    $donnees['date_achat'] = htmlentities($_POST['date_achat']);
    $donnees['etat'] = htmlentities($_POST['etat']);

    if(! is_numeric($donnees['prix']))$erreurs['prix']='veuillez saisir une valeur numérique';
    if ($donnees['etat']=="0")$erreurs['etat']='Sélectionnez un état.';
    if ($donnees['noOeuvre']=="0")$erreurs['noOeuvre']='Sélectionnez oeuvre.';


    if (empty($erreurs)) {
        $reponse_ex = "INSERT INTO EXEMPLAIRE VALUES(NULL,'".$donnees['etat']."','".$donnees['date_achat']."',".$donnees['prix'].",".$donnees['noOeuvre'].");";
        $ma_connexion_mysql->exec($reponse_ex);
    }
}

if (isset($_POST['submit']) AND isset($_POST['nomAdherent']) AND isset($_POST['villeAdherent'])) {
    $donnees['nomAdherent'] = htmlentities($_POST['nomAdherent']);
    $donnees['villeAdherent'] = htmlentities($_POST['villeAdherent']);
    $donnees['date_paiement'] = htmlentities($_POST['date_paiement']);

    if ((!preg_match("/^[A-Za-z ]{2,}/", $donnees['nomAdherent']))) $erreurs['nomAdherent'] = 'prenom composé de 2 lettres minimum';
    if ((!preg_match("/^[A-Za-z ]{2,}/", $donnees['villeAdherent']))) $erreurs['villeAdherent'] = 'Ville composé de 2 lettres minimum';

    if (empty($erreurs)){
        $reponse_ADHERENT = "INSERT INTO ADHERENT VALUES(NULL,'".$donnees['nomAdherent']."','".$donnees['villeAdherent']."','".$donnees['date_paiement']."');";
        $ma_connexion_mysql->exec($reponse_ADHERENT);
    }
}

?>

?>



<?php
$requete_AUTEUR="SELECT * FROM AUTEUR ORDER BY nomAuteur;";
$reponse_AUTEUR=$ma_connexion_mysql->query($requete_AUTEUR);
$AUTEUR=$reponse_AUTEUR->fetchAll();

$requete_ADHERENT="SELECT * FROM ADHERENT ORDER BY nomAdherent;";
$reponse_ADHERENT=$ma_connexion_mysql->query($requete_ADHERENT);
$ADHERENT=$reponse_ADHERENT->fetchAll();

$requete_OEUVRE="SELECT * FROM OEUVRE ORDER BY titre;";
$reponse_OEUVRE=$ma_connexion_mysql->query($requete_OEUVRE);
$OEUVRE=$reponse_OEUVRE->fetchAll();


$requete_EXEMPLAIRE="
SELECT o.titre, ex.noExemplaire
FROM OEUVRE as o, EXEMPLAIRE as ex, AUTEUR as a, EMPRUNT as e, ADHERENT as ad
WHERE a.idAuteur = o.idAuteur
AND o.noOeuvre = ex.noOeuvre
AND e.noExemplaire = ex.noExemplaire
AND e.idAdherent = ad.idAdherent
ORDER BY o.titre;
";
$reponse_EXEMPLAIRE=$ma_connexion_mysql->query($requete_EXEMPLAIRE);
$EXEMPLAIRE=$reponse_EXEMPLAIRE->fetchAll();
?>

<?php
//if(isset($_POST['submit'])){
//    $donnees['nom_auteur']=$_POST['nom_auteur'];
//    $donnees['prenom_auteur']=$_POST['prenom_auteur'];
//    $donnees['date_emprunt']=$_POST['date_emprunt'];
//    $donnees['date_rendu']=$_POST['date_rendu'];
//    $donnees['titre']=$_POST['titre'];
//    $donnees['date_parution']=$_POST['date_parution'];
//    $donnees['prix']=$_POST['prix'];
//    $donnees['date_achat']=$_POST['date_achat'];
//    $donnees['date_achat']=$_POST['date_achat'];
//    $donnees['adresse']=$_POST['adresse'];
//    if(preg_match()){
//
//    }
//
//}
//
//
//
//if ((! preg_match("/^[A-Za-z ]{2,}/",$donnees['nom']))) $erreurs['nom']='nom composé de 2 lettres minimum';
//if(! is_numeric($donnees['typeProduit_id']))$erreurs['typeProduit_id']='veuillez saisir une valeur';
//if(! is_numeric($donnees['prix']))$erreurs['prix']='saisir une valeur numérique';
//if (! preg_match("/[A-Za-z0-9]{2,}.(jpeg|jpg|png)/",$donnees['photo'])) $erreurs['photo']='nom de fichier incorrect (extension jpeg , jpg ou png)';
?>

<!DOCTYPE html>
<html>
<?php include("header.php")?>
<body>
<form action="ajout.php" method="post">
<div id="page" class="page margin-top-20">

    <div class="item contact" id="contact2">

        <div class="container">
            <div class="padding-bottom-60 row">
                <div class="col-md-6">

                    <h4 class="text-center padding-bottom-60">Ajouter Auteur : </h4>

                    <form role="form" action="ajout.php" method="post">

                        <h5>Nom Auteur : </h5>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="nom_auteur" placeholder="Nom auteur" value="<?php if(isset($donnees['nom_auteur'])) echo $donnees['nom_auteur']?>">
                            <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['nom_auteur'])) echo $erreurs['nom_auteur']; ?></p>
                        </div>

                        <h5>Prénom Auteur : </h5>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" id="prenom_auteur" name="prenom_auteur" placeholder="Prénom auteur" value="<?php if(isset($donnees['prenom_auteur'])) echo $donnees['prenom_auteur']?>">
                            <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['prenom_auteur'])) echo $erreurs['prenom_auteur']; ?></p>
                        </div>

                        <button name="submit" class="btn btn-primary btn-embossed btn-lg btn-wide pull-right margin-bottom-0"><span class="fui-mail"></span> Submit</button>
                    </form>

                </div>

                <div class="col-md-6">

                    <h4 class="text-center padding-bottom-60">Ajouter Emprunt : </h4>

                    <form role="form" action="ajout.php" method="post">

                        <h5>Adhérent : </h5>
                        <div class="form-group">
                            <select id="idAdherent" name="idAdherent" class="select select-default select">
                                <option value="0">Adherent</option>
                                <?php foreach($ADHERENT  as $value) : ?>
                                    <option value="<?= $value['idAdherent']?>"><?= $value['nomAdherent'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['idAdherent'])) echo $erreurs['idAdherent']; ?></p>

                        <h5>Exemplaire emprunté : </h5>
                        <div class="form-group">
                            <select id="Exemplaire" name="Exemplaire" class="select select-default select">
                                <option value="0">Exemplaire</option>
                                <?php foreach($EXEMPLAIRE  as $value) : ?>
                                    <option value=<?=$value['noExemplaire'] ?>><?= $value['titre'] ?>    Exemplaire N°: <?= $value['noExemplaire']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['Exemplaire'])) echo $erreurs['Exemplaire']; ?></p>


                        <h5>Date Emprunt : </h5>
                        <div class="form-group">
                            <input type="date" class="form-control input-lg" id="date_emprunt" name="date_emprunt" placeholder="Date emprunt" value="<?php if(isset($donnees['date_emprunt'])) echo $donnees['date_emprunt']?>">
                        </div>
                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['date_emprunt'])) echo $erreurs['date_emprunt']; ?></p>

                        <button name="submit" class="btn btn-primary btn-embossed btn-lg btn-wide pull-right margin-bottom-0"><span class="fui-mail"></span> Submit</button>

                    </form>

                </div>
            </div>
            <hr>
            <div class="padding-bottom-60 row">
                <div class="col-md-6">

                    <h4 class="text-center padding-bottom-60">Ajouter Oeuvre : </h4>

                    <form role="form" action="ajout.php" method="post">

                        <h5>Auteur : </h5>
                        <div class="form-group">
                            <select id="idAuteur" name="idAuteur" class="select select-default select">
                                <option value="0">Auteur</option>
                                <?php foreach($AUTEUR  as $value) : ?>
                                    <option value=<?=$value['idAuteur'] ?>><?= $value['prenomAuteur'] ?> <?= $value['nomAuteur']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['idAuteur'])) echo $erreurs['idAuteur']; ?></p>

                        <h5>Titre Oeuvre : </h5>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" id="titre" name="titre" placeholder="Titre Oeuvre" value="<?php if(isset($donnees['titre'])) echo $donnees['titre']?>">
                        </div>
                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['titre'])) echo $erreurs['titre']; ?></p>

                        <h5>Date Parution : </h5>
                        <div class="form-group">
                            <input type="date" class="form-control input-lg" id="date_parution" name="date_parution" placeholder="Date de parution">
                        </div>
                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['date_parution'])) echo $erreurs['date_parution']; ?></p>



                        <button name="submit" class="btn btn-primary btn-embossed btn-lg btn-wide pull-right margin-bottom-0"><span class="fui-mail"></span> Submit</button>

                    </form>

                </div>

                <div class="col-md-6">

                    <h4 class="text-center padding-bottom-60">Ajouter Exemplaire : </h4>

                    <form role="form" action="ajout.php" method="post">

                        <h5>Oeuvre : </h5>
                        <div class="form-group">
                            <select id="noOeuvre" name="noOeuvre" class="select select-default select">
                                <option value="0">Oeuvre</option>
                                <?php foreach($OEUVRE  as $value) : ?>
                                    <option value="<?= $value['noOeuvre']?>"><?= $value['titre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['noOeuvre'])) echo $erreurs['noOeuvre']; ?></p>

                        <h5>Prix : </h5>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" id="prix" name="prix" placeholder="Prix">
                        </div>
                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['prix'])) echo $erreurs['prix']; ?></p>


                        <h5>Date Achat : </h5>
                        <div class="form-group">
                            <input type="date" class="form-control input-lg" id="date_achat" name="date_achat" placeholder="Date Achat">
                        </div>

                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['date_achat'])) echo $erreurs['date_achat']; ?></p>


                        <div class="form-group">
                            <select id="etat" name="etat" class="select select-default select">
                                <option value="0">État</option>
                                <option value="Neuf">Neuf</option>
                                <option value="Bon">Bon</option>
                                <option value="Moyen">Moyen</option>
                                <option value="Mauvais">Mauvais</option>
                            </select>
                        </div>

                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['etat'])) echo $erreurs['etat']; ?></p>

                        <button name="submit" class="btn btn-primary btn-embossed btn-lg btn-wide pull-right margin-bottom-0"><span class="fui-mail"></span> Submit</button>

                    </form>

                </div>
            </div>
            <hr>
            <div class="padding-bottom-60 row">
                <div class="col-md-6">

                    <h4 class="text-center padding-bottom-60">Ajouter Adhérent : </h4>

                    <form role="form" action="ajout.php" method="post">

                        <h5>Nom adherent : </h5>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" id="nomAdherent" name="nomAdherent" placeholder="Nom adhérent" value="<?php if (isset($donnees['nomAdherent'])) echo $donnees['nomAdherent'] ?>">
                        </div>
                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['nomAdherent'])) echo $erreurs['nomAdherent']; ?></p>


                        <h5>Adresse : </h5>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" id="villeAdherent" name="villeAdherent" placeholder="Ville" value="<?php if (isset($donnees['villeAdherent'])) echo $donnees['villeAdherent'] ?>">
                        </div>
                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['villeAdherent'])) echo $erreurs['villeAdherent']; ?></p>


                        <h5>Date paiement : </h5>
                        <div class="form-group">
                            <input type="date" class="form-control input-lg" id="date_paiement" name="date_paiement" placeholder="Date de paiement">
                        </div>

                        <p class="alert-danger text-center text-danger"><?php if(isset($erreurs['date_paiement'])) echo $erreurs['date_paiement']; ?></p>



                        <button name="submit" class="btn btn-primary btn-embossed btn-lg btn-wide pull-right margin-bottom-0"><span class="fui-mail"></span> Submit</button>

                    </form>

                </div>
            </div>


        </div><!-- /.container -->

        </div><!-- /.item --><div class="container" id="divider1">

    </div><!-- /.container -->

</div>
</form>
<?php include("footer.php")?>
</html>