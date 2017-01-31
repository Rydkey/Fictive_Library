<?php
include("connexion_bdd.php");
?>
<?php
$ma_requete_SQL_Compte_Emprunt = "SELECT COUNT(em.dateEmprunt) FROM EMPRUNT as em WHERE em.dateRendu IS NULL ORDER BY em.dateEmprunt;";
$reponse = $ma_connexion_mysql->query($ma_requete_SQL_Compte_Emprunt);
$donnees = $reponse->fetchAll();
?>
<?php
$ma_requete_SQL_2 = "
SELECT a.nomAdherent, o.titre, au.nomAuteur, au.prenomAuteur, e.etat, em.dateEmprunt, a.idAdherent, e.noExemplaire
FROM ADHERENT as a, OEUVRE as o, AUTEUR as au, EXEMPLAIRE as e, EMPRUNT as em
WHERE em.idAdherent = a.idAdherent
AND em.noExemplaire = e.noExemplaire
AND e.noOeuvre = o.noOeuvre
AND o.idAuteur = au.idAuteur
AND em.dateRendu IS NULL;";
$reponse_2 = $ma_connexion_mysql->query($ma_requete_SQL_2);
$donnees_2 = $reponse_2->fetchAll();
?>
<!DOCTYPE html>
<html>
<?php include("header.php")?>
<div class="container text-justify margin-top-100 editContent">

    <div class="row">


            <h4 class="text-info">Il y à <?php foreach($donnees[0] as $data) echo $data ?> oeuvres actuellement en location.</h4>
            <hr>
            <div class="responsive-table-line col-lg-12 text-center">
                <div class="responsive-table-line text-center">
                    <table class="table table-condensed table-body-center" >
                        <thead>
                        <tr>
                            <td>Adherent</td>
                            <td>Emprunt</td>
                            <td>Exemplaire</td>
                            <td>Oeuvre</td>
                            <td>Auteur</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
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
                                <td>
                                    <a href="modif.php"><button type="submit" class="btn btn-primary btn-xs btn-embossed btn-wide"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></a>
                                    <a href="suppr.php?id=<?= $value['idAdherent'] ?>&noExemplaire=<?php echo $value['noExemplaire'] ?>&Table=EMPRUNT"><button type="submit" class="btn-danger btn btn-primary btn-xs btn-embossed btn-wide"><span class="glyphicon glyphicon-minus"></span> Supprimer</button></a>
                                </td>
                            </tr>
                        <?php endforeach?>
                        </tbody>
                    </table>
                </div><!-- /.tableWrapper -->
            </div>

    </div><!-- /.row -->

</div><!-- /.container -->

</div><!-- /.item -->

<?php include("footer.php")?>
</html>