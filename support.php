<?php
    $pageDescription = "Support de Work'n Share";
    $pageTitle = "Work'n Share - Support";
    include "assets/include/head.php";

    /* IF USER */
    if(!isset($_SESSION["account"]["token"])){
        header('Location: index.php');
    }
 ?>

    <body>
        <?php include "assets/include/header.php"; ?>
        <section style="margin-top: 50px">
            <div class="container container-main-content">
                <div class="row">
                    <div class="col-md-12">
                      <h1 class="text-center border-bottom border-bottom-header">Bienvenue sur la page de support de Work'n Share</h1>
                    </div>
                  </div>

                  <div class="row" style="margin-top:50px;">
                      <div class="col-lg-12">
                          <div class="card-deck">
                              <div class="card card-profile text-center border border-info border-profile">
                                  <h5 class="card-header card-header-profile">Aperçu de vos requêtes</h5>
                                  <div id="support-js" class="card-body card-body-profile">
                                      <table class="table table-striped">
                                          <tbody>
                                              <?php
                                                  $tickets = support_customer_view($_SESSION["account"]["id_customer"]);
                                                  if($tickets == null){
                                                    echo "Aucun ticket trouvé";
                                                  }else{
                                              ?>
                                              <tr>
                                                  <th>Référence du ticket</th>
                                                  <th>Intitulé du ticket</th>
                                                  <th>Date de création</th>
                                                  <th>Etat</th>
                                              </tr>
                                              <?php
                                                    foreach ($tickets as $ticket) {
                                                        if($ticket["state"] == 0){
                                                            $state_print = "Non résolu";
                                                        }
                                                        else{
                                                            $state_print = "Résolu";
                                                        }
                                                        echo '  <tr>
                                                                    <td>'.$ticket["id_ticket"].'</td>
                                                                    <td>'.$ticket["subject"].'</td>
                                                                    <td>'.$ticket["date_creation"].'</td>
                                                                    <td>'.$state_print.'</td>
                                                                    <td>
                                                                        <a class="btn btn-primary" href="support_ticket_view.php?ticket='.$ticket["id_ticket"].'">Visualiser</a>
                                                                        </button>
                                                                    </td>
                                                                </tr>';
                                                      }
                                                  }
                                             ?>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include "assets/include/footer.php"; ?>
    </body>
</html>
