<?php
include("connexion_bdd.php");
?>

<?php
$ma_requete_SQL_2 = "
SELECT a.nomAdherent, o.titre, au.nomAuteur, au.prenomAuteur, e.etat, e.noExemplaire, em.dateEmprunt
FROM ADHERENT as a, OEUVRE as o, AUTEUR as au, EXEMPLAIRE as e, EMPRUNT as em
WHERE em.idAdherent = a.idAdherent
AND em.noExemplaire = e.noExemplaire
AND e.noOeuvre = o.noOeuvre
AND o.idAuteur = au.idAuteur";
$reponse_2 = $ma_connexion_mysql->query($ma_requete_SQL_2);
$donnees_2 = $reponse_2->fetchAll();
?>

<!DOCTYPE html>
<html>
<?php include("header.php")?>
<div id="page" class="page margin-top-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                            <div class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <h4 class="text-info">Résultat : </h4>
                        <div class="responsive-table-line text-center">
                            <table class="table table-condensed table-body-center" >
                                <thead>
                                <tr>
                                    <td>Adherent</td>
                                    <td>Emprunt</td>
                                    <td>ID Exemplaire</td>
                                    <td>Oeuvre</td>
                                    <td>Auteur</td>
                                </tr>
                                </thead>
                                <tbody class="searchable">
                                <?php foreach ($donnees_2 as $value): ?>
                                    <tr>
                                        <td>
                                            <?=
                                            $value['nomAdherent']
                                            ?>
                                        </td>
                                        <td>
                                            <?=
                                            $value['dateEmprunt']
                                            ?>
                                        </td>
                                        <td>
                                            <?=
                                            $value['noExemplaire']
                                            ?>
                                        </td>
                                        <td>
                                            <?=
                                            $value['titre']
                                            ?>
                                        </td>
                                        <td>
                                            <?=
                                            $value['prenomAuteur'],
                                            " ",
                                            $value['nomAuteur']
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach?>
                                </tbody>
                            </table>
                        </div><!-- /.tableWrapper -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php")?>
</html>
