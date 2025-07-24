<!-- manage_category.php -->
<style>
    h1{
        font-family: serif;
        letter-spacing: 3px;
        text-align: center;
        margin-bottom: 20px;
    }
</style>

<h1>Add New Category</h1>
<form action="<?=base_url()?>hotel/save_category" method="post">
	<div class="container p-4 bg-white">
		<div class="row">
			<div class="col-md-12 mb-3">
			</div>
			<!-- Hidden input for edit mode -->
			<input type="hidden" name="category_id" value="<?=isset($edit_data) ? $edit_data['category_id'] : ''?>">

			<div class="col-md-10">
				Enter Category Name
				<input type="text" name="category_name" class="form-control" 
					value="<?=isset($edit_data) ? $edit_data['category_name'] : ''?>" required>
			</div>
			<div class="col-md-2">
				<br>
				<button class="btn btn-primary w-100">
					<?=isset($edit_data) ? 'Update' : 'Save Category'?>
				</button>
			</div>
		</div>
	</div>
</form>

<!-- Category List -->
<div class="container p-5 bg-white mt-3 shadow-lg rounded-4">
	<div class="row">
		<div class="col-md-12 mb-3">
			<table class="table table-bordered text-center align-middle table-hover">
				<thead class="table-light">
				<tr>
					<th>Action</th>
					<th>SrNo</th>
					<th>Category Name</th>
				</tr>
			</thead>
				<?php foreach ($cats as $key => $row): ?>
					<tr>
						<td>
							<a href="<?=base_url()?>hotel/edit_category/<?=$row['category_id']?>" class="me-2">
							<i data-feather="edit" style="color: #007bff;"></i></a>
							<a href="<?=base_url()?>hotel/delete_category/<?=$row['category_id']?>" onclick="return confirm('Are you sure you want to delete this category?')"><i data-feather="trash-2" style="color: #dc3545;"></i></a>
						</td>
						<td><?=$key+1?></td>
						<td><?=$row['category_name']?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>

<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace()
</script>