<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - UMKM Maritim</title>
    <link rel="stylesheet" href="../UMKM-MARITIM/index.css">
    <link rel="stylesheet" href="./component/OurProduct.css">
    <style>
        .product-detail-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .container_utama {

            width: 100%;
            min-height: 400px;
            background-color: white;

            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
            width: 100%;
        }

        .product-image {
            text-align: center;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .product-info h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .product-info .price {
            font-size: 24px;
            font-weight: bold;
            color: #e74c3c;
            margin: 20px 0;
        }

        .product-info .description {
            line-height: 1.6;
            margin-bottom: 30px;
            color: #34495e;
        }

        .product-info .ingredients,
        .product-info .weight,
        .product-info .availability {
            margin-bottom: 15px;
            color: #34495e;
        }

        .product-info h3 {
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .product-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }

        .btn-success {
            background-color: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background-color: #229954;
        }

        .loading {
            text-align: center;
            padding: 50px;
            font-size: 18px;
            color: #7f8c8d;
        }

        .error {
            text-align: center;
            padding: 50px;
            color: #e74c3c;
            font-size: 18px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #3498db;
            text-decoration: none;
            font-size: 16px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Best Seller Section */
        .best-seller-section {
            max-width: 1200px;
            margin: 40px auto 20px;
            padding: 0 20px;

        }

        .best-seller-container {

            background-color: white;
            border-radius: 15px;
            padding: 40px 30px;
            color: black;
            position: relative;
            overflow: hidden;
        }

        .best-seller-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;

        }

        .best-seller-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 40px;
            letter-spacing: 2px;
        }

        .best-seller-products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            align-items: center;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .product-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .product-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: black;
        }

        .product-card .price {
            font-size: 20px;
            font-weight: bold;
            color: #f39c12;
            margin-bottom: 15px;
        }

        .product-card .read-more {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: black;
            padding: 8px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .product-card .read-more:hover {
            background: linear-gradient(45deg, #2980b9, #1f618d);
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .product-actions {
                justify-content: center;
            }

            .container_utama {
                width: 95%;
                min-height: 500px;
                padding: 15px;
                margin: 10px auto;
            }

            .best-seller-container {
                padding: 30px 20px;
            }

            .best-seller-title {
                font-size: 24px;
                margin-bottom: 30px;
            }

            .best-seller-products {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .product-card img {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>

<body>
    <?php include './component/header.php'; ?>

    <div class="product-detail-container">
        <a href="OurProduct.php" class="back-link">← Kembali ke Produk</a>

        <div class="container_utama">
            <div id="loading" class="loading">
                Memuat detail produk...
            </div>

            <div id="error" class="error" style="display: none;">
                Produk tidak ditemukan atau terjadi kesalahan.
            </div>

            <div id="product-detail" style="display: none;">
                <!-- Detail produk akan dimuat di sini -->
            </div>
        </div>
    </div>

    <!-- Best Seller Section -->
    <div class="best-seller-section">
        <div class="best-seller-container">
            <h2 class="best-seller-title">BEST SELLER</h2>
            <div class="best-seller-products">
                <div class="product-card">
                    <img src="./component/Gallery/Abon.png" alt="Abon Ikan">
                    <h3>Abon Ikan</h3>
                    <div class="price">Rp 30.000</div>
                    <a href="Product.php?id=3" class="read-more">Read More</a>
                </div>
                <div class="product-card">
                    <img src="./component/Gallery/otak-otak.png" alt="Otak-Otak">
                    <h3>Otak-Otak Sotong</h3>
                    <div class="price">Rp 10.000</div>
                    <a href="Product.php?id=2" class="read-more">Read More</a>
                </div>
            </div>
        </div>
    </div>

    <?php include './component/footer.php'; ?>

    <script>
        // Ambil ID produk dari URL
        function getProductIdFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('id');
        }

        // Muat detail produk dari API
        async function loadProductDetail() {
            const productId = getProductIdFromUrl();

            if (!productId) {
                showError('ID produk tidak valid');
                return;
            }

            const loading = document.getElementById('loading');
            const error = document.getElementById('error');
            const productDetail = document.getElementById('product-detail');

            try {
                const response = await fetch(`./API/produk.php?id=${productId}`);

                if (!response.ok) {
                    throw new Error('Produk tidak ditemukan');
                }

                const product = await response.json();

                if (!product || !product.id) {
                    throw new Error('Data produk tidak valid');
                }

                // Tampilkan detail produk
                displayProductDetail(product);

                loading.style.display = 'none';
                error.style.display = 'none';
                productDetail.style.display = 'block';

                // Update judul halaman
                document.title = `${product.nama} - UMKM Maritim`;

            } catch (err) {
                console.error('Error loading product detail:', err);
                showError('Gagal memuat detail produk: ' + err.message);
            }
        }

        // Tampilkan detail produk
        function displayProductDetail(product) {
            const container = document.getElementById('product-detail');

            const imagePath = product.gambar;

            container.innerHTML = `
                <div class="product-detail">
                    <div class="product-image">
                        <img src="${imagePath}" alt="${product.nama}">
                    </div>
                    
                    <div class="product-info">
                        <h1>${product.nama}</h1>
                        
                        ${product.harga ? `<div class="price">Rp ${formatPrice(product.harga)}</div>` : ''}
                        
                        <div class="description">
                            <p>${product.deskripsi}</p>
                        </div>
                        
                        
                        
                   <div class="product-actions">
    <a href="checkout.php?id=${product.id}" class="btn btn-success">
        Beli Sekarang
    </a>

    <button class="btn btn-primary" onclick="addToCart(${product.id}, '${product.nama}', ${product.harga}, '${product.gambar}')">
        Tambah ke Keranjang
    </button>

    <button class="btn btn-secondary" onclick="shareProduct('${product.nama}', '${product.id}')">
        Bagikan
    </button>
</div>

                    </div>
                </div>
            `;
        }

        // Tampilkan error
        function showError(message) {
            const loading = document.getElementById('loading');
            const error = document.getElementById('error');

            loading.style.display = 'none';
            error.style.display = 'block';
            error.textContent = message;
        }

        // Format harga
        function formatPrice(price) {
            return new Intl.NumberFormat('id-ID').format(price);
        }



        // Bagikan produk
        function shareProduct(productName, productId) {
            const url = window.location.href;
            const text = `Lihat produk ${productName} dari UMKM Maritim: ${url}`;

            if (navigator.share) {
                navigator.share({
                    title: productName,
                    text: text,
                    url: url
                });
            } else {
                // Fallback: copy ke clipboard
                navigator.clipboard.writeText(text).then(() => {
                    alert('Link produk berhasil disalin ke clipboard!');
                });
            }
        }

        function addToCart(id, nama, harga, gambar) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Cek apakah produk sudah ada
            const existing = cart.find(item => item.id === id);
            if (existing) {
                existing.jumlah += 1;
            } else {
                cart.push({
                    id,
                    nama,
                    harga,
                    gambar,
                    jumlah: 1
                });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            alert(`Produk "${nama}" ditambahkan ke keranjang.`);
        }

        // Muat detail produk saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadProductDetail);
    </script>
</body>

</html>