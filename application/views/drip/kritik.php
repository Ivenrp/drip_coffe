<div class="page active" id="kritik">
    <div class="container py-5">
        <div class="page-title mb-5">
            <h1 class="display-1 fw-black">KRITIK<br><span class="text-red">&</span> SARAN</h1>
        </div>

        <div class="row g-5">
            <div class="col-lg-6">
                <div class="kritik-form">
                    <div class="mb-4">
                        <label class="form-label small text-uppercase text-secondary">nama lo</label>
                        <input type="text" class="form-control" id="feedbackName" placeholder="siapa lo?">
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-uppercase text-secondary">rating</label>
                        <div class="rating-stars" id="ratingStars">
                            <i class="fa-regular fa-star star fs-3" data-rating="1"></i>
                            <i class="fa-regular fa-star star fs-3" data-rating="2"></i>
                            <i class="fa-regular fa-star star fs-3" data-rating="3"></i>
                            <i class="fa-regular fa-star star fs-3" data-rating="4"></i>
                            <i class="fa-regular fa-star star fs-3" data-rating="5"></i>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-uppercase text-secondary">kategori</label>
                        <select class="form-select" id="feedbackCat">
                            <option value="">pilih kategori</option>
                            <option>kualitas minuman</option>
                            <option>pelayanan</option>
                            <option>suasana</option>
                            <option>kebersihan</option>
                            <option>harga</option>
                            <option>lainnya</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-uppercase text-secondary">cerita lo</label>
                        <textarea class="form-control" id="feedbackText" rows="4"
                            placeholder="jujur aja, lo aman..."></textarea>
                    </div>
                    <button class="btn btn-dark w-100 py-3" onclick="submitFeedback()">kirim kritik →</button>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="fw-bold mb-3 small text-uppercase">YANG UDAH NGOMONG</div>
                <div class="review-list" id="reviewList"></div>
            </div>
        </div>
    </div>
</div>