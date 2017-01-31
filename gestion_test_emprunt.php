<?php
include("connexion_bdd.php");
?>
<?php
$ma_requete_SQL_Emprunt = "SELECT * FROM EMPRUNT;";
$reponse = $ma_connexion_mysql->query($ma_requete_SQL_Emprunt);
$donnees = $reponse->fetchAll();
?>
<!DOCTYPE html>
<html lang="eng">
<?php include ("header.php")?>
<div class="container text-center margin-top-80 editContent">
    <div class="row">
        <div class="col-lg-12">
            <div class="row margin-bottom-60 center-block">
                <div class="col-lg-2">
                    <button class="btn-link"><h1><a href="gestion_test_auteur.php">Auteurs</a></h1></button>
                </div>
                <div class="col-lg-2">
                    <button class="btn-link"><h1><a href="gestion_test_oeuvres.php">Oeuvres</a></h1></button>
                </div>
                <div class="col-lg-2">
                    <button class="btn-link"><h1><a href="gestion_test_adherent.php">Adhérents</a></h1></button>
                </div>
                <div class="col-lg-3">
                    <button class="btn-link bg-warning"><h1><a href="gestion_test_emprunt.php">Emprunts</a></h1></button>
                </div>
                <div class="col-lg-3">
                    <button class="btn-link"><h1><a href="gestion_test_exemplaire.php">Exemplaire</a></h1></button>
                </div>
            </div>
            <hr>
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                    <button class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            <div class="row margin-top-20 margin-bottom-20">
                <table class="table table-condensed table-body-center" >
                    <thead>
                    <tr>
                        <td>
                            <h5>ID Adherent</h5>
                        </td>
                        <td>
                            <h5>Numéro Exemplaire</h5>
                        </td>
                        <td>
                            <h5>Date Emprunt</h5>
                        </td>
                        <td>
                            <h5>Date Rendu</h5>
                        </td>
                        <td>
                            <h5>Actions</h5>
                        </td>
                    </tr>
                    </thead>
                    <tbody class="searchable">
                    <?php foreach ($donnees as $value): ?>
                        <tr>
                            <td>
                                <?=
                                $value['idAdherent']
                                ?>
                            </td>
                            <td>
                                <?=
                                $value['noExemplaire']
                                ?>
                            </td>
                            <td>
                                <?=
                                $value['dateEmprunt']
                                ?>
                            </td>
                            <td>
                                <?=
                                $value['dateRendu']
                                ?>
                            </td>
                            <td>
                                <a href="modif.php"><button type="submit" class="btn btn-xs btn-primary btn-embossed btn-wide"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></a>
                                <a href="suppr.php?id=<?= $value['idAdherent'] ?>&noExemplaire=<?php echo $value['noExemplaire'] ?>&Table=EMPRUNT"><button type="submit" class="btn-danger btn-xs btn btn-primary btn-embossed btn-wide"><span class="glyphicon glyphicon-minus"></span> Supprimer</button></a>
                            </td>
                        </tr>
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include ("footer.php")?>
</html>