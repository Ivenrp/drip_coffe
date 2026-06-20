<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; color: #C94B2C; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #1C1A17; color: white; }
        .total { font-weight: bold; font-size: 18px; margin-top: 20px; }
        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <h1>DRIP* Coffee - Laporan Penjualan</h1>
    <p>Periode: <?= date('d-m-Y') ?></p>
    <p>Total Pesanan: <?= $total_orders ?></p>
    <p>Total Pendapatan: Rp <?= number_format($total_revenue, 0, ',', '.') ?></p>

    <table>
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Meja</th>
                <th>Total</th>
                <th>Status</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['table_number'] ?></td>
                <td>Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                <td><?= ucfirst($order['status']) ?></td>
                <td><?= date('d-m-Y H:i', strtotime($order['created_at'])) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: <?= date('d-m-Y H:i:s') ?>
    </div>
</body>
</html>