<!--
    Page de gestion qui permets en cliquant sur
    les différents boutons d'afficher le tableau
    de l'objet correspondant.
-->

<!DOCTYPE html>
<html lang="eng">
<?php include ("header.php")?>
<div class="container text-center margin-top-80 editContent">
    <div class="row">
        <div class="col-lg-12">
            <div class="row margin-bottom-60">
                <div class="col-lg-6">
                    <button class="btn-link"><h1><a href="gestion_test_auteur.php">Auteurs</a></h1></button>
                </div>
                <div class="col-lg-6">
                    <button class="btn-link"><h1><a href="gestion_test_oeuvres.php">Oeuvres</a></h1></button>
                </div>
                <div class="col-lg-6">
                    <button class="btn-link"><h1><a href="gestion_test_adherent.php">Adhérents</a></h1></button>
                </div>
                <div class="col-lg-6">
                    <button class="btn-link"><h1><a href="gestion_test_emprunt.php">Emprunts</a></h1></button>
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
                        <td>Adherent</td>
                        <td>Emprunt</td>
                        <td>Exemplaire</td>
                        <td>Oeuvre</td>
                        <td>Auteur</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody class="searchable">
                    <tr>
                        <td>1</td>
                        <td>The Shawshank Redemption</td>
                        <td>1994</td>
                        <td>8888888</td>
                        <td>923,629</td>
                        <td>
                            <a href="modif.php"><button type="submit" class="btn btn-xs btn-primary btn-embossed btn-wide"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></a>
                            <a href="suppr.php"><button type="submit" class="btn-danger btn-xs btn btn-primary btn-embossed btn-wide"><span class="glyphicon glyphicon-minus"></span> Supprimer</button></a>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>The Shawshank Redemption</td>
                        <td>1994</td>
                        <td>9999999</td>
                        <td>923,629</td>
                        <td>
                            <a href="modif.php"><button type="submit" class="btn btn-xs btn-primary btn-embossed btn-wide"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></a>
                            <a href="suppr.php"><button type="submit" class="btn-danger btn-xs btn btn-primary btn-embossed btn-wide"><span class="glyphicon glyphicon-minus"></span> Supprimer</button></a>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>The Shawshank Redemption</td>
                        <td>1994</td>
                        <td>7777777</td>
                        <td>923,629</td>
                        <td>
                            <a href="modif.php"><button type="submit" class="btn btn-xs btn-primary btn-embossed btn-wide"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></a>
                            <a href="suppr.php"><button type="submit" class="btn-danger btn-xs btn btn-primary btn-embossed btn-wide"><span class="glyphicon glyphicon-minus"></span> Supprimer</button></a>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include ("footer.php")?>
</html>