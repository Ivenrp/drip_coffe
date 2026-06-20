// DRIP* Coffee - Main JavaScript

let cart = [];
let currentRating = 0;
let orderHistory = [];

// Menu items data
const menuItems = [
    { id:1, name:'Americano', cat:'kopi', price:28000, emoji:'☕', desc:'espresso + air panas. simple, bold.' },
    { id:2, name:'Cappuccino', cat:'kopi', price:35000, emoji:'☕', desc:'espresso + steamed milk + foam tebal.' },
    { id:3, name:'Kopi Susu Gula Aren', cat:'kopi', price:32000, emoji:'🧋', desc:'kopi susu dengan gula aren asli.' },
    { id:4, name:'V60 Pour Over', cat:'kopi', price:42000, emoji:'☕', desc:'manual brew, karakter kopi beda level.' },
    { id:5, name:'Cold Brew', cat:'kopi', price:38000, emoji:'🧊', desc:'16 jam steep, smooth banget.' },
    { id:6, name:'Matcha Latte', cat:'non-kopi', price:35000, emoji:'🍵', desc:'matcha grade A + oat milk.' },
    { id:7, name:'Teh Tarik', cat:'non-kopi', price:22000, emoji:'🧋', desc:'teh susu kental, panas atau dingin.' },
    { id:8, name:'Mojito Virgin', cat:'non-kopi', price:28000, emoji:'🍃', desc:'mint + lime + soda. seger banget.' },
    { id:9, name:'Avocado Toast', cat:'makanan', price:35000, emoji:'🥑', desc:'sourdough + alpukat + telur setengah matang.' },
    { id:10, name:'Croissant', cat:'makanan', price:28000, emoji:'🥐', desc:'butter croissant fresh baked.' },
    { id:11, name:'Nasi Goreng Barista', cat:'makanan', price:42000, emoji:'🍳', desc:'nasi goreng spesial + telor mata sapi.' },
    { id:12, name:'Cheesecake', cat:'dessert', price:32000, emoji:'🍰', desc:'new york style, creamy + dense.' },
    { id:13, name:'Tiramisu', cat:'dessert', price:35000, emoji:'🍫', desc:'classic italian, pakai espresso shot.' },
    { id:14, name:'Brownies', cat:'dessert', price:25000, emoji:'🍫', desc:'fudgy, dark chocolate. adiktif.' },
    { id:15, name:'Flat White', cat:'kopi', price:36000, emoji:'☕', desc:'ristretto + velvet milk. intensitas tinggi.' },
    { id:16, name:'Lychee Tea', cat:'non-kopi', price:26000, emoji:'🍹', desc:'teh bunga + lychee segar.' },
];

// Page navigation logic handled by header.php script now

// Render Menu
function renderMenu(filter = 'semua') {
    const grid = document.getElementById('menuGrid');
    const items = filter === 'semua' ? menuItems : menuItems.filter(i => i.cat === filter);
    
    grid.innerHTML = items.map(item => `
        <div class="col-md-3 col-sm-6 p-0">
            <div class="menu-card p-3">
                <div class="menu-card-img text-center" style="font-size: 60px;">${item.emoji}</div>
                <div class="menu-card-cat position-absolute top-0 start-0 m-2">
                    <span class="badge bg-dark">${item.cat.toUpperCase()}</span>
                </div>
                <div class="menu-card-body p-3">
                    <h5 class="fw-bold mb-1">${item.name}</h5>
                    <p class="small text-secondary fst-italic">${item.desc}</p>
                </div>
                <div class="menu-card-footer d-flex justify-content-between align-items-center pt-2 border-top">
                    <span class="h5 text-red mb-0">Rp ${item.price.toLocaleString('id-ID')}</span>
                    <button class="btn btn-dark btn-sm rounded-circle" onclick="addToCart(${item.id})">+</button>
                </div>
            </div>
        </div>
    `).join('');
}

// Filter menu
document.querySelectorAll('.menu-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.menu-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        renderMenu(this.dataset.cat);
    });
});

// Cart functions
function addToCart(id) {
    const item = menuItems.find(i => i.id === id);
    const existing = cart.find(c => c.id === id);
    
    if (existing) {
        existing.qty++;
    } else {
        cart.push({ ...item, qty: 1 });
    }
    
    updateCartUI();
    showToast(`${item.name} ditambah ke keranjang ✓`);
}

function updateCartUI() {
    const total = cart.reduce((s, i) => s + i.qty, 0);
    document.getElementById('cartCount').textContent = total;
    
    const cartItemsEl = document.getElementById('cartItems');
    if (cart.length === 0) {
        cartItemsEl.innerHTML = '<div class="text-center py-5 text-secondary fst-italic">keranjang masih kosong nih...</div>';
    } else {
        cartItemsEl.innerHTML = cart.map(item => `
            <div class="cart-item d-flex gap-3 py-3 border-bottom">
                <div class="fs-1">${item.emoji}</div>
                <div class="flex-grow-1">
                    <h6 class="fw-bold mb-0">${item.name}</h6>
                    <small class="text-red">Rp ${item.price.toLocaleString('id-ID')}</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-dark btn-sm" onclick="changeQty(${item.id}, -1)">−</button>
                    <span class="mx-2">${item.qty}</span>
                    <button class="btn btn-dark btn-sm" onclick="changeQty(${item.id}, 1)">+</button>
                </div>
            </div>
        `).join('');
    }
    
    const sub = cart.reduce((s, i) => s + i.price * i.qty, 0);
    const tax = Math.round(sub * 0.1);
    const tot = sub + tax;
    
    document.getElementById('cartSubtotal').textContent = `Rp ${sub.toLocaleString('id-ID')}`;
    document.getElementById('cartTax').textContent = `Rp ${tax.toLocaleString('id-ID')}`;
    document.getElementById('cartTotalNum').textContent = `Rp ${tot.toLocaleString('id-ID')}`;
}

function changeQty(id, delta) {
    const item = cart.find(c => c.id === id);
    if (!item) return;
    item.qty += delta;
    if (item.qty <= 0) cart = cart.filter(c => c.id !== id);
    updateCartUI();
}

// Cart drawer
function toggleCart() {
    const overlay = document.getElementById('cartOverlay');
    const drawer = document.getElementById('cartDrawer');
    overlay.classList.toggle('show');
    drawer.classList.toggle('show');
}

// Payment
let selectedPayment = null;
let currentOrder = null;

function openPayment() {
    if (cart.length === 0) {
        showToast('keranjang masih kosong!', 'error');
        return;
    }
    
    const table = document.getElementById('tableInput').value.trim();
    if (!table) {
        showToast('isi nomor meja dulu ya!', 'error');
        return;
    }
    
    const sub = cart.reduce((s, i) => s + i.price * i.qty, 0);
    const tax = Math.round(sub * 0.1);
    const tot = sub + tax;
    
    currentOrder = { cart, sub, tax, tot, table };
    
    // Update receipt
    document.getElementById('receiptItems').innerHTML = cart.map(i => `
        <div class="d-flex justify-content-between small mb-1">
            <span>${i.name} x${i.qty}</span>
            <span>Rp ${(i.price*i.qty).toLocaleString('id-ID')}</span>
        </div>
    `).join('');
    document.getElementById('receiptSub').textContent = `Rp ${sub.toLocaleString('id-ID')}`;
    document.getElementById('receiptTax').textContent = `Rp ${tax.toLocaleString('id-ID')}`;
    document.getElementById('receiptTotal').textContent = `Rp ${tot.toLocaleString('id-ID')}`;
    document.getElementById('receiptTable').textContent = table;
    document.getElementById('receiptTime').textContent = new Date().toLocaleTimeString('id-ID');
    document.getElementById('qrAmount').textContent = `Rp ${tot.toLocaleString('id-ID')}`;
    document.getElementById('cashAmount').textContent = `Rp ${tot.toLocaleString('id-ID')}`;
    
    selectedPayment = null;
    document.getElementById('payBtn').disabled = true;
    document.getElementById('payBtn').textContent = 'pilih metode pembayaran dulu';
    document.querySelectorAll('.pay-method').forEach(m => m.classList.remove('selected'));
    document.getElementById('qrSection').classList.remove('show');
    document.getElementById('cashSection').classList.remove('show');
    
    document.getElementById('paymentModal').classList.add('show');
}

function selectPayment(method, element) {
    selectedPayment = method;
    document.querySelectorAll('.pay-method').forEach(m => m.classList.remove('selected'));
    element.classList.add('selected');
    
    document.getElementById('qrSection').classList.remove('show');
    document.getElementById('cashSection').classList.remove('show');
    
    if (method === 'qris' || method === 'transfer') {
        document.getElementById('qrSection').classList.add('show');
    } else if (method === 'cash') {
        document.getElementById('cashSection').classList.add('show');
    }
    
    document.getElementById('payBtn').disabled = false;
    document.getElementById('payBtn').textContent = 'konfirmasi pembayaran →';
}

function closePayment() {
    document.getElementById('paymentModal').classList.remove('show');
}

function confirmPayment() {
    if (!selectedPayment || !currentOrder) return;
    
    // Generate queue number
    const queueNum = 'A-' + Math.floor(Math.random() * 100 + 10);
    
    // Create order object
    const order = {
        id: `ORD-${Date.now().toString().slice(-6)}`,
        queue: queueNum,
        table: currentOrder.table,
        items: currentOrder.cart,
        sub: currentOrder.sub,
        tax: currentOrder.tax,
        total: currentOrder.tot,
        payment: selectedPayment,
        time: new Date().toLocaleString('id-ID'),
        status: 'Selesai'
    };
    
    orderHistory.unshift(order);
    
    // Save to localStorage
    localStorage.setItem('orderHistory', JSON.stringify(orderHistory));
    
    // Send to backend via AJAX so Kasir can see it
    fetch(SITE_URL + '/submit_order_ajax', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            queue: queueNum,
            table: currentOrder.table,
            items: currentOrder.cart,
            subtotal: currentOrder.sub,
            tax: currentOrder.tax,
            total: currentOrder.tot,
            payment: selectedPayment
        })
    }).then(res => res.json()).then(res => {
        if (!res.success) {
            console.error("Gagal mengirim order ke server", res);
        }
    }).catch(err => console.error(err));
    
    // Show success
    document.getElementById('successQueueNum').textContent = order.queue;
    document.getElementById('successOverlay').classList.add('show');
    
    // Clear cart
    cart = [];
    updateCartUI();
    document.getElementById('tableInput').value = '';
    closePayment();
    toggleCart();
    
    renderRiwayat();
    
    // Auto redirect to queue page after 3 seconds
    setTimeout(() => {
        closeSuccess();
        window.location.href = SITE_URL + '/antrian';
    }, 3000);
}

function closeSuccess() {
    document.getElementById('successOverlay').classList.remove('show');
}

// Riwayat
function renderRiwayat() {
    const el = document.getElementById('riwayatContent');
    const storedHistory = localStorage.getItem('orderHistory');
    if (storedHistory) orderHistory = JSON.parse(storedHistory);
    
    if (orderHistory.length === 0) {
        el.innerHTML = `
            <div class="text-center py-5 text-secondary">
                <div class="display-1 mb-3 opacity-50">📋</div>
                <p class="fst-italic">belum ada riwayat orderan nih.<br>pesen kopi dulu yuk biar melek.</p>
            </div>
        `;
        return;
    }
    
    el.innerHTML = `
        <div class="row">
            <div class="col-md-8">
                ${orderHistory.map(o => `
                    <div class="card mb-3">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0 fw-bold">${o.id}</h6>
                                <small class="text-white-50">${o.time} · Meja ${o.table}</small>
                            </div>
                            <span class="badge bg-success">✓ SELESAI</span>
                        </div>
                        <div class="card-body">
                            <div class="small text-secondary mb-2">${o.items.map(i => `${i.name} x${i.qty}`).join(' · ')}</div>
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                <small class="text-secondary">bayar via ${o.payment.toUpperCase()}</small>
                                <span class="h5 text-red mb-0">Rp ${o.total.toLocaleString('id-ID')}</span>
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
    `;
}

// Queue status simulation
let queueCounter = 10;

function loadQueueStatus() {
    const activeOrder = orderHistory[0];
    if (!activeOrder) return;
    
    document.getElementById('antrianEmpty').style.display = 'none';
    document.getElementById('antrianContent').style.display = 'block';
    document.getElementById('antrianNum').textContent = activeOrder.queue;
    document.getElementById('antrianServed').textContent = `A-${queueCounter - 3}`;
    document.getElementById('antrianAhead').textContent = Math.max(0, queueCounter - (queueCounter - 3) - 1);
    
    const list = document.getElementById('antrianOrderList');
    list.innerHTML = activeOrder.items.map(i => `
        <div class="d-flex justify-content-between py-1 border-bottom">
            <span>${i.name} x${i.qty}</span>
            <span>Rp ${(i.price*i.qty).toLocaleString('id-ID')}</span>
        </div>
    `).join('');
    
    // Simulate status updates
    setTimeout(() => {
        document.getElementById('step1').classList.add('done');
    }, 3000);
    setTimeout(() => {
        document.getElementById('step2').classList.add('active');
    }, 6000);
    setTimeout(() => {
        document.getElementById('step3').classList.add('active');
    }, 9000);
}

// Rating stars
document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', function() {
        const rating = parseInt(this.dataset.rating);
        currentRating = rating;
        document.querySelectorAll('.star').forEach((s, i) => {
            if (i < rating) {
                s.classList.remove('fa-regular');
                s.classList.add('fa-solid');
            } else {
                s.classList.remove('fa-solid');
                s.classList.add('fa-regular');
            }
        });
    });
});

// Submit feedback
function submitFeedback() {
    const name = document.getElementById('feedbackName').value.trim();
    const cat = document.getElementById('feedbackCat').value;
    const text = document.getElementById('feedbackText').value.trim();
    
    if (!name || !currentRating || !text) {
        showToast('lengkapin dulu ya!', 'error');
        return;
    }
    
    const review = { name, rating: currentRating, cat, text, date: 'baru saja' };
    
    const list = document.getElementById('reviewList');
    const stars = '★'.repeat(review.rating) + '☆'.repeat(5 - review.rating);
    
    const reviewHtml = `
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 fw-bold">${review.name}</h6>
                    <div class="text-warning">${stars}</div>
                </div>
                <p class="small text-secondary fst-italic mb-1">"${review.text}"</p>
                <small class="text-muted">${review.date}</small>
            </div>
        </div>
    `;
    
    list.insertAdjacentHTML('afterbegin', reviewHtml);
    
    document.getElementById('feedbackName').value = '';
    document.getElementById('feedbackCat').value = '';
    document.getElementById('feedbackText').value = '';
    currentRating = 0;
    document.querySelectorAll('.star').forEach(s => {
        s.classList.remove('fa-solid');
        s.classList.add('fa-regular');
    });
    
    showToast('makasih kritiknya! 🙏', 'success');
}

// Toast notification
function showToast(msg, type = '') {
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'dark'} border-0 position-fixed bottom-0 start-50 translate-middle-x mb-3`;
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${msg}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    document.body.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    toast.addEventListener('hidden.bs.toast', () => toast.remove());
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('menuGrid')) renderMenu();
    if (document.getElementById('riwayatContent')) renderRiwayat();
    if (document.getElementById('antrianContent')) loadQueueStatus();
    
    // Load stored history
    const storedHistory = localStorage.getItem('orderHistory');
    if (storedHistory) orderHistory = JSON.parse(storedHistory);
    
    // Setup modal close handlers
    document.getElementById('cartOverlay')?.addEventListener('click', toggleCart);
    document.getElementById('paymentModal')?.addEventListener('click', function(e) {
        if (e.target === this) closePayment();
    });
});

// Bootstrap modal and components
const bootstrap = window.bootstrap;