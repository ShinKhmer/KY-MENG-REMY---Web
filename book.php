<?php
    $pageDescription = "Page de réservation Work'n Share.";
    $pageTitle = "Work'n Share - Réservation de salle";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"])){
      header('Location: index.php');
      exit();
    }

    if(isset($_POST["room"]) && isset($_POST["date"]) && isset($_POST["begin"]) && isset($_POST["end"]) ){
        send_booking($_SESSION["account"]["id_customer"], $_POST["room"], $_POST["date"], $_POST["begin"], $_POST["end"]);
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
                                        <select class="form-control" name="place_select" onchange="book_print_room()">
                                            <option value="place_default">Sélectionner un lieu</option>
                                            <?php
                                            $locations = location_data();
                                            foreach($locations as $loc){
                                                echo '<option value="'.$loc["id_location"].'">'.name_town($loc["id_location"]).'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div id="print_room" class="form-group">
                                        <!-- AJAX -->
                                    </div>
                                    <div id="print_date" class="form-group" style="display:none">
                                        <?php
                                        $now = date('Y-m-d', time()+2*60*60);   // GMT+1 + heure d'été
                                        ?>
                                        <input type="date" name="date_select" min="<?php echo $now ?>" onchange="book_print_day()">

                                    </div>
                                    <div id="print_day" class="form-group" style="display:none">
                                        <!-- AJAX -->
                                    </div>
                                    <div id="print_day_next" class="form-group" style="display:none">
                                        <!-- AJAX -->
                                    </div>
                                    <a class="btn btn-danger" href="index.php">Annuler</a>
                                    <button class="btn btn-primary" onclick="send_booking()">Valider</button>

                                    <?php //echo '<a class="btn btn-danger" href="admin_rooms_edit.php?id_room='.$_GET["id_room"].'&id_location='.$_GET["id_location"].'&del=true">Supprimer</a>'; ?>

                                </center>
                            </form>
                        </div>
                      </div>
                  </div>
              </div>

        </section>

        <script src="function.js"></script>

        <?php
            include "assets/include/footer.php";
        ?>
    </body>
</html>
