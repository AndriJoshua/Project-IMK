<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out - UMKM Maritim</title>
    <link rel="stylesheet" href="./component/checkout.css">
    <style>
        .error-message {
            color: #ff0000;
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        .input-error {
            border: 1px solid #ff0000 !important;
        }
    </style>
</head>
<style>
    .btn-outline {
    background: white;
    border: 2px solid #27ae60;
    color: #27ae60;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}
.btn-outline:hover {
    background: #27ae60;
    color: white;
}

    </style>
<body>
    <?php include './component/header.php'; ?>
    <div class="container">
        <div class="checkout-header">
            <h1>Check Out</h1>
        </div>

        <div id="loading" class="loading">
            Memuat data produk...
        </div>

        <div id="error" class="error"></div>

        <div id="checkout-content" class="checkout-content">
            <!-- Konten akan diisi oleh JavaScript -->
        </div>
    </div>
     <?php include './component/footer.php'; ?>
    <script>
        let currentProduct = null;
        let currentQuantity = 1;

        // Ambil ID produk dari URL
        function getProductIdFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('id');
        }

        // Muat detail produk dari API
        async function loadProductForCheckout() {
            const productId = getProductIdFromUrl();

            if (!productId) {
                showError('ID produk tidak valid');
                return;
            }

            try {
                const response = await fetch(`./API/produk.php?id=${productId}`);

                if (!response.ok) {
                    throw new Error('Produk tidak ditemukan');
                }

                const product = await response.json();

                if (!product || !product.id) {
                    throw new Error('Data produk tidak valid');
                }

                currentProduct = product;
                displayCheckoutForm(product);

                document.getElementById('loading').style.display = 'none';
                document.getElementById('error').style.display = 'none';
                document.getElementById('checkout-content').style.display = 'block';

                // Update judul halaman
                document.title = `Check Out - ${product.nama} - UMKM Maritim`;

            } catch (err) {
                console.error('Error loading product for checkout:', err);
                showError('Gagal memuat data produk: ' + err.message);
            }
        }

        // Tampilkan form checkout
        function displayCheckoutForm(product) {
            const container = document.getElementById('checkout-content');
            const imagePath = product.gambar;

            container.innerHTML = `
                <div class="main-content">
                    <div class="left-section">
                        <div class="product-image">
                            <img src="${imagePath}" alt="${product.nama}">
                        </div>
                        
                        <div class="product-info">
                            <h2>${product.nama}</h2>
                        </div>
                        
                        <div class="quantity-control">
                            <button class="quantity-btn" onclick="changeQuantity(-1)">−</button>
                            <input type="number" class="quantity-input" id="quantity" value="1" min="1" onchange="updateQuantity()">
                            <button class="quantity-btn" onclick="changeQuantity(1)">+</button>
                        </div>

                        <div class="total-section">
                            <h3>TOTAL:</h3>
                            <div class="total-price" id="total-price">Rp ${formatPrice(product.harga)}</div>
                        </div>
                    </div>

                    <div class="right-section">
                        <div class="form-section">
                            <div class="form-group">
                                <label for="email">Masukan email</label>
                                <input type="email" id="email" onblur="validateInput('email')" required>
                                <span class="error-message" id="email-error">Format email tidak valid</span>
                            </div>

                            <div class="form-group">
                                <label for="phone">No.Hp</label>
                                <input type="tel" id="phone" onblur="validateInput('phone')" required>
                                <span class="error-message" id="phone-error">Format nomor telepon tidak valid</span>
                            </div>

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" id="name" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea id="address" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="button-group">
    <button class="btn btn-secondary" onclick="goBack()">KEMBALI</button>
    <button class="btn btn-outline" onclick="addToCart()">TAMBAH KE KERANJANG</button>
    <button class="btn btn-primary" onclick="processOrder()">PESAN SEKARANG</button>
</div>

                    </div>
                </div>
            `;
        }

        // Ubah jumlah produk
        function changeQuantity(change) {
            const quantityInput = document.getElementById('quantity');
            let newQuantity = parseInt(quantityInput.value) + change;
            
            if (newQuantity < 1) newQuantity = 1;
            
            quantityInput.value = newQuantity;
            updateQuantity();
        }

        // Update jumlah dan total harga
        function updateQuantity() {
            const quantityInput = document.getElementById('quantity');
            const quantity = parseInt(quantityInput.value) || 1;
            
            if (quantity < 1) {
                quantityInput.value = 1;
                currentQuantity = 1;
            } else {
                currentQuantity = quantity;
            }

            // Update total harga
            const totalPrice = currentProduct.harga * currentQuantity;
            document.getElementById('total-price').textContent = `Rp ${formatPrice(totalPrice)}`;
        }

        // Validasi input
        function validateInput(type) {
    const input = document.getElementById(type);
    const errorElement = document.getElementById(`${type}-error`);
    let isValid = true;

    if (type === 'email') {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        isValid = emailRegex.test(input.value);
    } else if (type === 'phone') {
        const phoneRegex = /^(\+62|62|0)8[1-9][0-9]{6,9}$/;
        isValid = phoneRegex.test(input.value);
    }

    if (!isValid) {
        input.classList.add('input-error');
        errorElement.style.display = 'block';
    } else {
        input.classList.remove('input-error');
        errorElement.style.display = 'none';
    }

    return isValid;
}

// Proses pemesanan
        function processOrder() {
            const emailValid = validateInput('email');
    const phoneValid = validateInput('phone');
    const name = document.getElementById('name').value;
    const address = document.getElementById('address').value;

    if (!emailValid || !phoneValid || !name || !address) {
        if (!name) alert('Mohon isi nama Anda');
        if (!address) alert('Mohon isi alamat Anda');
        return;
    }

            // Data pesanan
            const orderData = {
                product: currentProduct,
                quantity: currentQuantity,
                total: currentProduct.harga * currentQuantity,
                customer: {
                    email: email,
                    phone: phone,
                    name: name,
                    address: address
                }
            };

            // Simulasi proses pemesanan
            alert('Pesanan berhasil diproses! Anda akan dihubungi melalui WhatsApp untuk konfirmasi.');
            
            // Bisa redirect ke halaman konfirmasi atau WhatsApp
            const whatsappMessage = `Halo, saya ingin memesan:\n\nProduk: ${currentProduct.nama}\nJumlah: ${currentQuantity}\nTotal: Rp ${formatPrice(orderData.total)}\n\nData Pemesan:\nNama: ${name}\nEmail: ${email}\nNo. HP: ${phone}\nAlamat: ${address}`;
            const whatsappUrl = `https://wa.me/6285356277535?text=${encodeURIComponent(whatsappMessage)}`;
            window.open(whatsappUrl, '_blank');
        }

        // Kembali ke halaman sebelumnya
        function goBack() {
            if (currentProduct) {
                window.location.href = `Product.php?id=${currentProduct.id}`;
            } else {
                window.history.back();
            }
        }

        // Format harga
        function formatPrice(price) {
            return new Intl.NumberFormat('id-ID').format(price);
        }

        // Tampilkan error
        function showError(message) {
            const loading = document.getElementById('loading');
            const error = document.getElementById('error');

            loading.style.display = 'none';
            error.style.display = 'block';
            error.textContent = message;
        }
        function addToCart() {
    const quantity = parseInt(document.getElementById('quantity').value) || 1;
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Cek apakah produk sudah ada di keranjang
    const existing = cart.find(item => item.id === currentProduct.id);
    if (existing) {
        existing.jumlah += quantity;
    } else {
        cart.push({
            id: currentProduct.id,
            nama: currentProduct.nama,
            harga: currentProduct.harga,
            gambar: currentProduct.gambar,
            jumlah: quantity
        });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    alert('Produk berhasil ditambahkan ke keranjang!');
}

        // Muat data produk saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadProductForCheckout);
    </script>
</body>
</html>