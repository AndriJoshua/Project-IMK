<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out - UMKM Maritim</title>
    <link rel="stylesheet" href="./component/checkout.css">
</head>
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
                                <input type="email" id="email" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">No.Hp</label>
                                <input type="tel" id="phone" required>
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

        // Proses pemesanan
        function processOrder() {
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const name = document.getElementById('name').value;
            const address = document.getElementById('address').value;

            if (!email || !phone || !name || !address) {
                alert('Mohon lengkapi semua data yang diperlukan!');
                return;
            }

            if (!validateEmail(email)) {
                alert('Format email tidak valid!');
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

        // Validasi email
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
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

        // Muat data produk saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadProductForCheckout);
    </script>
</body>
</html>