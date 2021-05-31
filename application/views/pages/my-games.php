<?php 
	$this->load->view('templates/header');
	$this->load->view('templates/nav-top');

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"><?= $title ?></h1>
		<div class="btn-group mr-2">
			<a href="<?= base_url() ?>games/new" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Game</a>
		</div>
	</div>

	<?php if (validation_errors() != false) : ?>
		<div class="col-sm-3 alert alert-warning" role="alert">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>

	<div class="table-responsive">
	 <?php if ($number > 0 ) { ?>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Price</th>
					<th>Category</th>
					<th>Developer</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php if  (is_array($games) || is_object($games)) : ?>
					<?php foreach($games as $game) : ?>
						<tr>
							<td><?= $game->id ?></td>
							<td><?= $game->name ?></td>
							<td><?= reais($game->price) ?></td>
							<?php $id = intval($game->category_id) ?>
							<?php $resultado = $this->category_model->get_category($id);?>							
							<td><?= isset($game->category_id) ? $resultado : '(Nenhuma categoria selecionada!)' ?></td>
							<td><?= $game->developer ?></td>
							<td>
								<a href="<?= base_url() ?>games/edit/<?= $game->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
								<a href="javascript:goDelete(<?= $game->id ?>)" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	 <?php } else { ?>
			<div class="d-flex justify-content-center">
					<h1>Você ainda não inseriu nenhum jogo</h1>
			</div>
        <?php } ?>
		
		 		<?php if (isset($links)) { ?>			
					<?php echo $links ?>
				<?php } ?>
			         
	</div>
</main>

<?php
$this->load->view('templates/footer');
$this->load->view('templates/js');

?>
  
<script>
	function goDelete(id) {
		
		if(confirm("Deseja apagar este registro?")) {
			window.location.href = 'destroy/'+id;
		} else {
			alert("Registro não alterado");
			return false;
		}
	}
</script>
