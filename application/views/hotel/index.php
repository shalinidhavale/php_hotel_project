<!-- Required CSS/JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<style>
body {
  font-family: 'Poppins', sans-serif;
}

.card-table {
  background-color: white;
  border: 2px solid #ccc;
  border-radius: 10px;
  padding: 20px;
  transition: 0.3s ease;
  text-align: center;
  min-height: 220px;
}
.card-table:hover {
  transform: scale(1.02);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}
.card-table.active {
  border-color: #ffc107;
}
.card-table.complete {
  border-color: #28a745;
}
.card-table.other {
  border-color: #6c757d;
}

.btn-box {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-top: 20px;
  padding: 10px;
  border-radius: 10px;
}

.btn-custom {
  min-width: 60px;
  border-radius: 8px;
  transition: transform 0.3s ease, background-color 0.3s ease;
  text-align: center;
  padding: 5px 10px;
}

.btn-custom img {
  display: block;
  margin: 0 auto 4px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 6px;
}

.btn-custom:hover {
  background-color: #000;
  color: white;
  transform: scale(1.05);
}

.btn-custom:hover img {
  transform: scale(1.1);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

.chart-container {
  max-width: 900px;
  margin: auto;
  background: linear-gradient(to right, #eef2f3, #dfe9f3);
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
</style>

<div class="container py-4">
  <div class="row">
    <?php foreach ($tables as $row): 
      $sql = "SELECT *,
              (SELECT SUM(total) FROM order_products WHERE order_products.order_id = order_tbl.order_id) AS ttl
              FROM order_tbl 
              WHERE hotel_table_id = '".$row['hotel_table_id']."' 
              ORDER BY order_id DESC LIMIT 1";

      $orders = $this->db->query($sql)->result_array();
      $statusClass = 'other';
      if (!empty($orders)) {
        if ($orders[0]['order_status'] == 'active') $statusClass = 'active';
        elseif ($orders[0]['order_status'] == 'complete') $statusClass = 'complete';
      }
    ?>
      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card-table <?= $statusClass ?>">
          <h5><?= $row['table_no'] ?></h5>

          <?php if (!empty($orders)): ?>
            <p class="mt-2 mb-1"><strong>₹ <?= $orders[0]['ttl'] ?></strong></p>

            <p>
              <?php if ($orders[0]['order_status'] == 'complete'): ?>
                <span class="badge bg-success">Complete</span>
              <?php elseif ($orders[0]['order_status'] == 'active'): ?>
                <span class="badge bg-warning text-dark">Active</span>
              <?php else: ?>
                <span class="badge bg-secondary"><?= ucfirst($orders[0]['order_status']) ?></span>
              <?php endif; ?>
            </p>

            <div class="btn-box">
              <a href="<?= base_url() ?>hotel/order_details/<?= $orders[0]['order_id'] ?>" class="btn btn-outline-success btn-sm btn-custom" data-bs-toggle="tooltip" title="Order Details">
                <img src="<?= base_url('assets/img/icons/details.png') ?>" width="24" height="24" alt="Details">
                <small>Details</small>
              </a>
              <?php if ($orders[0]['order_status'] == 'active'): ?>
              <a href="<?= base_url() ?>hotel/print_bill/<?= $orders[0]['order_id'] ?>" class="btn btn-outline-dark btn-sm btn-custom" data-bs-toggle="tooltip" title="Print Bill">
                <img src="<?= base_url('assets/img/icons/bill.png') ?>" width="24" height="24" alt="Print">
                <small>Print</small>
              </a>
              <?php endif; ?>
            </div>
          <?php else: ?>
            <p class="mt-3 text-danger">
              <i class="fa-solid fa-ban me-1"></i> No Orders Found
            </p>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<br><br>



<!-- Chart Section -->
  <h2 class="text-center mb-4">Sales History</h2>
<div class="chart-container mb-5">

  <!-- Chart Type Switch -->
  <div class="text-end mb-2">
    <label for="chartType">Chart Type: </label>
    <select id="chartType" class="form-select d-inline-block w-auto">
      <option value="bar" selected>Bar</option>
      <option value="line">Line</option>
      <option value="pie">Pie</option>
      <option value="doughnut">Doughnut</option>
      <option value="radar">Radar</option>
      <option value="polarArea">Polar Area</option>
    </select>
  </div>

  <canvas id="myChart" style="width:100%; height:500px;"></canvas>
</div>

<!-- Chart.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script>
  var xValues = [<?= implode(",", $x_axis); ?>];
  var yValues = [<?= implode(",", $y_axis); ?>];
  var chart;

  function createChart(type = 'bar') {
    if (chart) chart.destroy();

    var ctx = document.getElementById("myChart").getContext("2d");

    // Gradient for bar/line
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, " rgb(110, 26, 121)"); // Purple
    gradient.addColorStop(1, "rgb(197, 2, 93)"); // Pink

    // Set up dataset
    var dataset = {
      label: "₹ Sales",
      data: yValues,
      backgroundColor: type === 'bar' || type === 'line' ? (type === 'bar' ? gradient : "transparent") : [
        "#a18cd1", "#fbc2eb", "#ff9a9e", "#fad0c4", "#fcb69f", "#ff758c", "#8ec5fc"
      ],
      borderColor: "#a18cd1",
      borderWidth: 2,
      fill: type === 'bar',
      pointBackgroundColor: "#a18cd1"
    };

    // Create chart
    chart = new Chart(ctx, {
      type: type,
      data: {
        labels: xValues,
        datasets: [dataset]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: { display: type === 'pie' || type === 'doughnut' || type === 'polarArea' || type === 'radar' },
        title: {
          display: true,
          text: "Last 7 Day Sale History ₹ <?= number_format(array_sum($y_axis)) ?>",
          fontSize: 18
        },
        scales: (type === 'bar' || type === 'line') ? {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        } : {}
      }
    });
  }

  // Initial chart
  createChart('bar');

  // Change chart on dropdown selection
  document.getElementById("chartType").addEventListener("change", function () {
    createChart(this.value);
  });
</script>

