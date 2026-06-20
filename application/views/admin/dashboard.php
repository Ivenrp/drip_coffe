<div class="container-fluid mt-4">
    <h2>Dashboard Admin</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Total Laba Bulan Ini</h5>
                    <h3>Rp <?= number_format($total_income, 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <canvas id="chartDaily" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <a href="<?= site_url('admin/export_pdf') ?>" class="btn btn-danger">Export PDF</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartDaily').getContext('2d');
const dailyData = <?= json_encode($daily_data) ?>;
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: dailyData.map(d => d.hour + ':00'),
        datasets: [{
            label: 'Penjualan per Jam',
            data: dailyData.map(d => d.total),
            backgroundColor: 'rgba(201, 75, 44, 0.6)'
        }]
    }
});
</script>
