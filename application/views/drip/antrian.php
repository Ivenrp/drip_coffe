<div class="page active" id="antrian">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="antrian-title mb-5">
                    <h1 class="display-1 fw-black">NOMOR<br>ANTRIAN <span class="text-red">LO*</span></h1>
                </div>

                <div class="antrian-card bg-warning p-4 rounded position-relative" id="antrianCard">
                    <div class="text-center">
                        <div class="small text-uppercase text-dark-50">drip* coffee · purwokerto</div>
                        <hr class="my-3 w-25 mx-auto">

                        <div id="antrianEmpty" class="py-4">
                            <p class="fst-italic text-dark-50">belum ada pesanan<br>
                                <span class="small">— pesan dulu yuk</span>
                            </p>
                        </div>

                        <div id="antrianContent" style="display:none;">
                            <div id="antrianNum" class="display-1 fw-black">—</div>
                            <div class="small text-uppercase text-dark-50">nomor antrian lo</div>

                            <div class="antrian-order-list bg-white bg-opacity-25 rounded p-3 my-3 text-start"
                                id="antrianOrderList"></div>

                            <div class="row g-0 bg-dark bg-opacity-10 my-3">
                                <div class="col-6 p-3 bg-white bg-opacity-50">
                                    <div id="antrianServed" class="h3 fw-black">—</div>
                                    <div class="small">dilayani</div>
                                </div>
                                <div class="col-6 p-3 bg-white bg-opacity-50">
                                    <div id="antrianAhead" class="h3 fw-black">—</div>
                                    <div class="small">di depan</div>
                                </div>
                            </div>

                            <div class="antrian-status bg-dark text-white p-3 rounded text-start">
                                <div class="small text-white-50 mb-3">STATUS PESANAN LO</div>
                                <div class="status-step d-flex gap-3 mb-2" id="step1">
                                    <div class="status-step-num bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 24px; height: 24px;">1</div>
                                    <div>
                                        <div class="fw-bold">Pesanan Diterima</div>
                                        <div class="small text-white-50">pesanan masuk ke sistem dapur</div>
                                    </div>
                                </div>
                                <div class="status-step d-flex gap-3 mb-2" id="step2">
                                    <div class="status-step-num bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 24px; height: 24px;">2</div>
                                    <div>
                                        <div class="fw-bold">Sedang Dibuat</div>
                                        <div class="small text-white-50">barista lagi racik kopi lo</div>
                                    </div>
                                </div>
                                <div class="status-step d-flex gap-3 mb-2" id="step3">
                                    <div class="status-step-num bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 24px; height: 24px;">3</div>
                                    <div>
                                        <div class="fw-bold">Siap Diambil</div>
                                        <div class="small text-white-50">minuman lo udah di meja pickup</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>