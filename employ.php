<?php
session_start();
if(isset($_SESSION['id'])){
		$title  = 'Employ';
require_once './assest/header.php';
require_once './assest/navbar.php';
require_once './php/query.php';
if(!isset($_GET['page'])){
	$page = 1 ; 
}else{
	$page = $_GET['page'];
}
$restlat_par_page = 15;
$strat_number_page = ($page - 1) * $restlat_par_page;
$fetch = new action();
$resultat = $fetch->select('SELECT * FROM employ ORDER BY `employ`.`creat_at` DESC LIMIT 105');
$res = $fetch->select('SELECT * FROM employ ORDER BY `employ`.`creat_at` DESC LIMIT '.$strat_number_page.','.$restlat_par_page);
?>
<div class="margin-left">
	<div class="expenses">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-3">
					<a href="addEmploy.php"><button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter Employer</button></a>
				</div>
			</div>
			<table class="table table-striped table-dark">
				<thead>
					<tr>
					<th scope="col">nom</th>
					<th scope="col">date</th>
					<th scope="col"> Salyer</th>
					<th scope="col">Avance</th>
					<th scope="col">Reset</th>
					<th scope="col">Pay</th>
					<th scope="col">action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						for ($i =0 ; $i <count($res) ; $i++){
						?>
					<tr>
						<td scope="row"><?php echo $res[$i]['fullname']  ?></td>
						<td><?php echo $res[$i]['date'] ?></td>
						<td><?php echo $res[$i]['salyer'] ?></td>
						<td><?php echo $res[$i]['avance'] ?></td>
						<td><?php echo $res[$i]['reset'] ?></td>
						<td><?php if( $res[$i]['pay'] == 0 ){echo 'pyement no complete'; }else{echo 'pyement '; }?></td>
						
						<td>
							<div class="row justify-content-between">
								<div class="col-6">
									<a href="editEmployer.php?id=<?php echo $res[$i]['id'] ?>"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
								</div>
								<div class="col-6">
									<button class="btn btn-danger" data-id="<?php echo $res[$i]['id'] ?>"><i class="fas fa-trash"></i></button>
								</div>
							</div>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="pagination margin-left">
	<div class="container">
		<nav aria-label="Page navigation example">
			<ul class="pagination">
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>
				<?php
				for($page = 1; $page <= ceil(count($resultat) / 6) ; $page++){
					?>
				<li class="page-item"><a class="page-link" href="<?php echo 'employ.php?page='.$page ?>"><?php echo $page ?></a></li>
				<?php
				}
				?>
				<li class="page-item">
					<a class="page-link" href="" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</div>
<script src="./js/delete/DeleteEmployer.js"></script>

<?php
require_once './assest/footer.php';
	}else{
		header('location:404.php');
	}
?>