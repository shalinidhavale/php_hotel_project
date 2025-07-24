<!-- Add Table Form -->
<style>
    h1 {
        font-family: serif;
        letter-spacing: 2px;
    }

    /* Custom QR Modal */
    .modal-overlay {
        display: none; /* hidden by default */
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
    }

    .modal-content {
        background-color: white;
        margin: 10% auto;
        padding: 20px;
        border-radius: 8px;
        width: 300px;
        text-align: center;
        position: relative;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    .close-btn {
        position: absolute;
        top: 5px;
        right: 10px;
        font-size: 24px;
        font-weight: bold;
        color: red;
        cursor: pointer;
    }
</style>

<form action="<?= base_url() ?>hotel/save_table" method="post">
    <div class="container p-5 bg-white shadow-lg rounded-4 mt-4">
        <div class="row align-items-end">
            <div class="col-md-12 mb-3">
                <h1 class="text-center">Add New Table</h1>
            </div>
            <div class="col-md-10 mb-3">
                <label for="table_no" class="form-label">Enter Table No.</label>
                <input type="text" name="table_no" id="table_no" class="form-control form-control-lg rounded-3 shadow-sm" required>
            </div>
            <div class="col-md-2 mb-3 text-end">
                <button class="btn btn-primary w-100 btn-lg shadow-sm">
                    <i data-feather="plus-circle" class="me-1"></i> Save
                </button>
            </div>
        </div>
    </div>
</form>

<!-- Table List -->
<div class="container p-5 bg-white shadow-lg rounded-4 mt-4">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h1 class="text-center">Table List</h1>
            <hr>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-hover text-center align-middle shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>Action</th>
                        <th>QR</th>
                        <th>Sr No</th>
                        <th>Table No</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tables as $key => $row): ?>
                        <tr>
                            <td class="text-center">
                                <!-- Edit Icon -->
                                <a href="<?= base_url('hotel/edit_table/' . $row['hotel_table_id']) ?>" class="me-2" title="Edit">
                                    <i data-feather="edit" style="color: #007bff;"></i>
                                </a>

                                <!-- Delete Icon -->
                                <a href="<?= base_url('hotel/delete_table/' . $row['hotel_table_id']) ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this table?');">
                                    <i data-feather="trash-2" style="color: #dc3545;"></i>
                                </a>
                            </td>
                            
                                <td>
                                    <img src="<?= base_url('assets/img/icons/qr-code.png') ?>" 
                                    onclick="show_qr(<?= $row['hotel_table_id'] ?>)" 
                                    alt="QR Icon"
                                    title="Show QR Code"
                                    style="width: 32px; height: 32px; cursor: pointer;" />
                                </td>

                            
                            <td><?= $key + 1 ?></td>
                            <td class="fw-bold"><?= $row['table_no'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- QR Code Modal -->
<div id="qrModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-btn" onclick="closeQRModal()">&times;</span>
        <h2>QR Code</h2>
        <div id="qrcode"></div>
    </div>
</div>

<!-- Required JS Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();

    function show_qr(table_id) {
        // Show modal
        document.getElementById("qrModal").style.display = "block";

        // Clear previous QR code
        document.getElementById('qrcode').innerHTML = '';

        // Generate new QR code
        var url = "<?= base_url() ?>user/index?table_no=" + table_id;
        new QRCode(document.getElementById("qrcode"), url);
    }

    function closeQRModal() {
        document.getElementById("qrModal").style.display = "none";
    }
</script>

<!-- Font Awesome for QR Icon -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
