<?php 
	$this->load->view('templates/header');
	$this->load->view('templates/nav-top');

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Games</h1>
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
		<?php if ($number > 0) { ?>	
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Preço</th>
						<th>Categoria</th>
						<th>Developer</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($games as $game) : ?>
						<tr>
							<td><?php echo $game->id ?></td>
							<td><?php echo $game->name ?></td>
							<td><?php echo $game->price?></td>	
							<?php $id = intval($game->category_id) ?>
							<?php $resultado = $this->category_model->get_category($id);?>							
							<td><?= isset($game->category_id) ? $resultado : '(Nenhuma categoria selecionada!)' ?></td>						
							<td><?php echo $game->developer ?></td>
							<td>
								<?php if($this->session->logged_user['id'] === $game->user_id) : ?>
									<a href="<?= base_url() ?>games/edit/<?= $game->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
									<a href="javascript:goDelete(<?= $game->id ?>)" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
								<?php else : ?>
									<button disabled type="button" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt" title="Apenas quem inseriu pode editar!"></i></a>
									<button disabled type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt" title="Apenas quem inseriu pode excluir!"></i></a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php } else { ?>
			<div class="d-flex justify-content-center">
					<h1>Nenhum jogo inserido!</h1>
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
			window.location.href = 'games/destroy/'+id;
		} else {
			alert("Registro não alterado");
			return false;
		}
	}
</script>
