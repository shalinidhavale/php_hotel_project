<style>
    h1{
        font-family: serif;
        letter-spacing: 3px;
        text-align: center;
        margin-bottom: 20px;
    }
</style>
<form action="<?=base_url()?>hotel/save_product" method="post" enctype="multipart/form-data">
	<h1>Add New Product</h1>
	<div class="container p-5 bg-white mt-3 shadow-lg rounded-4">
		<div class="row">
			<div class="col-md-12 mb-3">
			</div>
			<div class="col-md-5 mb-3">
				Select Category
				<select class="form-control" name="category_id" required>
					<option value="" selected disabled>Select Category</option>
					<?php
					foreach($cats as $row)
					{
					?>
					<option value="<?=$row['category_id']?>"><?=$row['category_name']?></option>
					<?php
				    }
				    ?>
				</select>
			</div>
			<div class="col-md-7 mb-3">
				Enter Product Name
				<input type="text" class="form-control" name="product_name" required>
			</div>
			<div class="col-md-6 mb-3">
				Price
				<input type="number" class="form-control" name="product_price" required>
			</div>
			<div class="col-md-6 mb-3">
				Image
				<input type="file" class="form-control" name="product_image" required>
			</div>
			<div class="col-md-12 mb-3 text-center">
				<br>
				<button class="btn btn-primary">Save Product</button>
			</div>
		</div>
	</div>
</form>