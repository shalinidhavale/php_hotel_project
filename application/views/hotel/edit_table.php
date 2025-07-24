<!-- edit_table.php -->
<style>
    h1{
        font-family: serif;
        letter-spacing: 2px;
    }
</style>

<form action="<?= base_url('hotel/update_table') ?>" method="post">
    <div class="container p-4 bg-white shadow rounded">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h1 class="text-center">Edit Table</h1>
            </div>
            <input type="hidden" name="hotel_table_id" value="<?= $table['hotel_table_id'] ?>">
            <div class="col-md-10">
                Enter Table No.
                <input type="text" name="table_no" class="form-control" required value="<?= $table['table_no'] ?>">
            </div>
            <div class="col-md-2 mb-3 text-end">
                <br>
                <button class="btn btn-primary w-100 btn-lg shadow-sm">
                    <i data-feather="plus-circle" class="me-1"></i> Save
                </button>
            </div>
        </div>
    </div>
</form>
