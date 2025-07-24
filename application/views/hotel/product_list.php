<style>
    h1{
        font-family: serif;
        letter-spacing: 3px;
    }
</style>

<h1 class="text-center mb-2">Products List</h1>

<div class="container p-5 bg-white mt-3 shadow-lg rounded-4">
    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered text-center align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Action</th>
                        <th>SrNo</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Category Name</th>
                        <th>Product Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $key => $row): ?>
                        <tr>
                            <td>
                                <!-- Edit Icon (Blue) -->
                                <a href="<?= base_url('hotel/edit_product/' . $row['product_id']) ?>" class="me-2" title="Edit">
                                    <i data-feather="edit" style="color: #007bff;"></i>
                                </a>

                                <!-- Delete Icon (Red) -->
                                <a href="<?= base_url('hotel/delete_product/' . $row['product_id']) ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this product?');">
                                    <i data-feather="trash-2" style="color: #dc3545;"></i>
                                </a>
                            </td>
                            <td><?= $key + 1 ?></td>
                            <td><?= $row['product_name'] ?></td>
                            <td><?= $row['product_price'] ?></td>
                            <td><?= $row['category_name'] ?></td>
                            <td>
                                <img src="<?= base_url('uploads/' . $row['product_image']) ?>" 
                                     alt="<?= $row['product_name'] ?>" 
                                     width="100" height="80" 
                                     class="mx-auto d-block rounded-3 shadow-lg">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace()
</script>
