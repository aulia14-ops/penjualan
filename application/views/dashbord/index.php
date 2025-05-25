<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Optik Mahandra</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }
        .header {
            background-color: white;
            padding: 20px 30px;
            color: #000;
            font-size: 28px;
            font-weight: bold;
            text-align: justify;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
            margin-bottom: 40px;
        }
        .box {
            background-color: white;
            padding: 20px;
            width: 250px;
            height: 120px;
            text-align: left;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            font-size: 22px;
            font-weight: 600;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
        }
        .box:hover {
            background-color: #007bff;
            color: white;
            box-shadow: 0px 8px 20px rgba(0, 123, 255, 0.2);
            transform: translateY(-5px);
            cursor: pointer;
        }
        .box small {
            font-size: 14px;
            margin-top: 5px;
            color: #666;
        }
        .table-container {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.05);
            border: 1px solid #e0e0e0;
            margin-top: 20px;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 700;
            color: #333;
            text-align: left;
        }
        .empty-text {
            color: #777;
            text-align: left;
        }
        @media (max-width: 768px) {
            .box {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    Dashboard Optik Mahandra
</div>

<div class="container">
    <!-- 3 Kotak -->
    <div class="box-container">
        <div class="box">
            Penjualan
            <small>120 Transaksi</small>
        </div>
        <div class="box">
            Proses
            <small>34 Transaksi</small>
        </div>
        <div class="box">
            Telah Selesai
            <small>200 Transaksi</small>
        </div>
    </div>

    <!-- Daftar Pemesanan Terbaru -->
    <div class="table-container">
        <h2>Daftar Pemesanan Terbaru</h2>
        <p class="empty-text">Belum ada data pemesanan.</p>
    </div>
</div>

</body>
</html>
