<?php
    $pageDescription = "Page de réservation Work'n Share.";
    $pageTitle = "Work'n Share - Réservation de salle";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"])){
      header('Location: index.php');
      exit();
    }

    function name_town($id,$db){
        $query = $db->prepare("SELECT * FROM LOCATION WHERE id_location=:plop");
        $query->execute(["plop" => $id]);
        $result2 = $query->fetch(PDO::FETCH_ASSOC);
        return $result2['town'];
    }
?>

    <body>
        <?php include 'assets/include/header.php'; ?>
        <section>
            <div class="container container-main-content">
	             <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center border-bottom border-bottom-header">Réservation d'une salle</h1>
                    </div>
                </div>

                <div class="row" style="margin-top:50px;">
                  <div class="col-lg-12">
                      <div class="card card-profile text-center border border-info border-profile">
                        <h5 class="card-header card-header-profile">Réserver</h5>
                        <div class="card-body card-body-profile">
                            <?php echo '<form method="POST" action="book.php">'; ?>
                                <center>
                                    <div class="form-group">
                                        <label>Lieu</label>
                                        <select class="form-control" name="place_select">
                                            <option value="1">Bastille</option>
                                            <option value="2">Beaubourg</option>
                                            <option value="3">Odéon</option>
                                            <option value="4">Place d'Italie</option>
                                            <option value="5">République</option>
                                            <option value="6">Ternes</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Valider</button>

                                    <?php //echo '<a class="btn btn-danger" href="admin_rooms_edit.php?id_room='.$_GET["id_room"].'&id_location='.$_GET["id_location"].'&del=true">Supprimer</a>'; ?>

                                </center>
                            </form>
                        </div>
                      </div>
                  </div>
              </div>

        </section>

        <?php
            include "assets/include/footer.php";
        ?>
    </body>
</html>
