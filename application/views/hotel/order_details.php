<!-- Required CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<style>

  .bill-container {
    width: 58mm;
    max-width: 100%;
    margin: auto;
    padding: 10px;
    border: 1px dashed #000;
    background: #fff;
     font-family: 'Poppins', sans-serif;
    background: #fff;
    font-size: 12px;
  }

  .bill-header {
    text-align: center;
    border-bottom: 1px dashed #000;
    padding-bottom: 5px;
    margin-bottom: 10px;
  }

  .bill-header h4 {
    margin: 0;
    font-size: 14px;
    font-weight: bold;
    letter-spacing: 1px;
  }

  .bill-header p {
    margin: 0;
    font-size: 11px;
    line-height: 1.2;
  }

  .bill-info {
    margin-bottom: 10px;
  }

  .bill-info p {
    margin: 0;
    font-size: 12px;
  }

  .table thead th {
    font-size: 12px;
    font-weight: 600;
    padding: 4px;
    border-top: 1px dashed #000;
    border-bottom: 1px dashed #000;
    text-align: center;
  }

  .table td {
    padding: 4px;
    font-size: 12px;
    text-align: center;
    vertical-align: middle;
  }

  .table-bordered {
    border: none;
  }

  .grand-total {
    font-size: 13px;
    font-weight: bold;
    text-align: right;
    margin-top: 5px;
    border-top: 1px dashed #000;
    padding-top: 5px;
  }

  .thanks-msg {
    text-align: center;
    font-size: 12px;
    margin-top: 10px;
    border-top: 1px dashed #000;
    padding-top: 5px;
  }
  .btn-print-blue {
    background: linear-gradient(45deg, #1e3c72, #2a5298);
    border: none;
    color: #fff;
    font-weight: 600;
    border-radius: 30px;
    padding: 6px 20px;
    font-size: 13px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(30, 60, 114, 0.3);
  }

  .btn-print-blue:hover {
    background: linear-gradient(45deg, #0052d4, #4364f7);
    transform: scale(1.05);
    color: #fff;
  }
@media print {
  body {
    margin: 0;
    padding: 0;
    background: #fff !important;
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
  }

  .bill-container {
    width: 58mm !important;
    margin: 0 auto !important;
    padding: 10px !important;
    background: #fff !important;
    border: 1px dashed #000 !important;
    box-shadow: none !important;
    font-size: 12px !important;
    page-break-inside: avoid !important;
  }

  .bill-header h4,
  .bill-header p,
  .bill-info p,
  .table th,
  .table td,
  .grand-total,
  .thanks-msg {
    color: #000 !important;
    background: transparent !important;
  }

  .print-btn {
    display: none !important;
  }

  @page {
    size: 58mm auto;
    margin: 0;
  }
}


</style>

<div class="bill-container" id="order-details">
  <div class="bill-header">
    <h4>TAJ HOTEL</h4>
    <p>Shivaji Chowk, Ahmednagar - 414001<br>
    Mob: +91 9876543210<br>
    GSTIN: 27ABCDE1234F1Z5</p>
  </div>

  <div class="bill-info">
    <p><strong>Order Date:</strong> <?= $order_info['order_date'] ?></p>
    <p><strong>Order Time:</strong> <?= $order_info['order_time'] ?></p>
    <p><strong>Status:</strong> <?= ucfirst($order_info['order_status']) ?></p>
  </div>

  <table class="table table-bordered w-100">
    <thead>
      <tr>
        <th>#</th>
        <th>Item</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php $ttl = 0; foreach ($order_products as $key => $row): $ttl += $row['total']; ?>
      <tr>
        <td><?= $key + 1 ?></td>
        <td><?= $row['product_name'] ?></td>
        <td>₹<?= $row['product_price'] ?></td>
        <td><?= $row['qty'] ?></td>
        <td>₹<?= $row['total'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="grand-total">
    Grand Total: ₹<?= number_format($ttl, 2) ?>
  </div>

  <div class="thanks-msg">
    Thank You! Visit Again 😊
  </div>
</div>

<!-- Print Button -->
<div class="text-center mt-3 print-btn">
  <button onclick="print_order_details()" class="btn-print-blue">🖨️ Print Bill</button>
</div>



<script>
  function print_order_details() {
    var content = document.getElementById("order-details").innerHTML;
    var original = document.body.innerHTML;
    document.body.innerHTML = content;
    window.print();
    document.body.innerHTML = original;
    location.reload(); // restore scroll/page
  }
</script>
