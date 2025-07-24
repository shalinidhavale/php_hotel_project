<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Order Confirmation</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #fefefe;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      overflow: hidden;
    }

    .card {
      background: #fff;
      padding: 30px 25px;
      border-radius: 16px;
      box-shadow: 0 14px 30px rgba(0, 0, 0, 0.3);
      text-align: center;
      max-width: 400px;
      width: 90%;
      border: 2px solid #cc2b5e;
      animation: fadeInUp 0.8s ease forwards;
      transform: translateY(30px);
      opacity: 0;
    }

    @keyframes fadeInUp {
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .check-icon {
      background: linear-gradient(to right, #cc2b5e, #753a88);
      color: white;
      font-size: 32px;
      width: 60px;
      height: 60px;
      line-height: 60px;
      border-radius: 50%;
      display: inline-block;
      margin-bottom: 10px;
      box-shadow: 0 6px 20px rgba(204, 43, 94, 0.5);
      animation: pulse 1.2s ease infinite;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.15); }
      100% { transform: scale(1); }
    }

    .card h1 {
      color: #cc2b5e;
      font-size: 30px;
      margin-bottom: 8px;
      letter-spacing: 1.5px;
    }

    .card p {
      font-size: 15px;
      color: #636e72;
      margin-bottom: 25px;
    }

    .card a {
      display: inline-block;
      text-decoration: none;
      background: linear-gradient(to right, #cc2b5e, #753a88);
      color: #fff;
      padding: 10px 22px;
      border-radius: 30px;
      font-weight: 600;
      font-size: 15px;
      box-shadow: 0 10px 24px rgba(204, 43, 94, 0.4);
      transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s;
    }

    .card a:hover {
      background: linear-gradient(to right, #753a88, #cc2b5e);
      transform: scale(1.05);
      box-shadow: 0 12px 28px rgba(204, 43, 94, 0.5);
    }
  </style>
</head>
<body>

  <div class="card">
    <div class="check-icon">✔</div>
    <h1>Thank You!</h1>
    <p>Your Order Will Be Delivered Within 15 to 20 Minutes</p>
    <a href="<?=base_url()?>user/index?table_no=<?= $_SESSION['table_id'] ?>">Done</a>
  </div>

  <script>
    // Run confetti burst once
    confetti({
      particleCount: 100,
      spread: 70,
      origin: { y: 0.6 }
    });
  </script>
</body>
</html>
