<?php
    include "assets/include/header.php";

    /* DATABASE ACTION */
    $db = connectDb();

    $query = $db->prepare("SELECT id_customer, pseudo_customer, last_name_customer, name_customer, email_customer, is_admin, blocked FROM CUSTOMERS");

    $query->execute();

    $result = $query->fetchAll();
?>

    <section>
        <center><h2>Bienvenue dans la page d'administration !</h2></center>

        <div class="container main-content">
			<div class="row" style="margin-top:50px; margin-bottom:50px;">
				<div class="col-md-12">
                    <div class="card-deck">
                        <div class="card">
                            <table class="table table-responsive table-hover">
                				<tr>
                					<th>ID USER</th>
                					<th>PSEUDO</th>
                					<th>NOM</th>
                					<th>PRENOM</th>
                					<th>EMAIL</th>
                					<th>Rang</th>
                                    <th>Promotion</th>
                                    <th>Bloquer</th>
                				</tr>
                				<?php
                					foreach($result as $res){
                						echo '	<tr>
                									<td>'.$res[0].'</td>
                									<td>'.$res[1].'</td>
                									<td>'.$res[2].'</td>
                									<td>'.$res[3].'</td>
                									<td>'.$res[4].'</td>
                									<td>';
                                                        if($res[5] == 0)
                                                            echo "Utilisateur";
                                                        else if($res[5] == 1)
                                                            echo "Administrateur";
                                        echo '      <td>';
                                                        if($res[5] == 0)
                                                            echo '<a class="btn btn-primary" href="admin_users_actions.php?user='.$res[0].'&promote=up" role="button">Promouvoir</a>';
                                                        else if($res[5] == 1)
                                                            echo '<a class="btn btn-primary" href="admin_users_actions.php?user='.$res[0].'&promote=down" role="button">Destituer</a>';
                                        echo '      </td>
                                                    <td>';
                										if($res[6] == 0){
                											echo '<a class="btn btn-danger" href="admin_users_actions.php?user='.$res[0].'&block=true">Bloquer</a>';
                										}
                										else if($res[6] == 1){
                											echo '<a class="btn btn-danger" href="admin_users_actions.php?user='.$res[0].'&unblock=true">Débloquer</a>';
                										}
                						echo '		</td>
                                                </tr>';
                					}
                				?>

                			</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php include "assets/include/footer.php"; ?>
