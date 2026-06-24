<div class="container-fluid mt-4">
    <h2>Dashboard Kasir</h2>
    <div class="row">
        <div class="col-md-12">
            <h4>Daftar Pesanan</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Meja</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['table_number'] ?></td>
                        <td>Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                        <td><?= $order['status'] ?></td>
                        <td>
                            <a href="<?= site_url('kasir/order_detail/'.$order['id']) ?>" class="btn btn-sm btn-info">Detail</a>
                            <a href="<?= site_url('kasir/print_struk/'.$order['id']) ?>" class="btn btn-sm btn-secondary">Print</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
