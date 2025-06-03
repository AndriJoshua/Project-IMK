<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk Kami</title>
  <link rel="stylesheet" href="../UMKM-MARITIM/index.css">
  <link rel="stylesheet" href="./component/OurProduct.css">
  <style>
    .product img {
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .product img:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .loading {
      display: none;
      text-align: center;
      padding: 20px;
      font-style: italic;
    }
    
    .error {
      color: red;
      text-align: center;
      padding: 10px;
      display: none;
    }
  </style>
</head>
<body>
    <?php include './component/header.php';?>
  <div class="container">
    <h2 style="color: white;">Our Product</h2>
    
    <div class="loading" id="loading">Memuat produk...</div>
    <div class="error" id="error">Gagal memuat produk. Silakan coba lagi.</div>

    <div id="product-container">
      <!-- Produk akan dimuat dari API -->
    </div>

  </div>

  <?php include './component/footer.php';?>

  <script>
    // Fungsi untuk memuat semua produk dari API
    async function loadProducts() {
      const loading = document.getElementById('loading');
      const error = document.getElementById('error');
      const container = document.getElementById('product-container');
      
      loading.style.display = 'block';
      error.style.display = 'none';
      
      try {
        const response = await fetch('./API/produk.php');
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        
        const products = await response.json();
        container.innerHTML = '';
        
        products.forEach(product => {
          const productDiv = document.createElement('div');
          productDiv.className = 'product';
          
          productDiv.innerHTML = `
            <img src="${product.gambar || './component/Gallery/' + product.nama.replace(/\s+/g, '_') + '.png'}" 
                 alt="${product.nama}"
                 onclick="redirectToDetail(${product.id})"
                 data-product-id="${product.id}">
            <div class="product-description">
              <h3>${product.nama}</h3>
              <p>${product.deskripsi}</p>
              ${product.harga ? `<p class="price">Rp ${formatPrice(product.harga)}</p>` : ''}
            </div>
          `;
          
          container.appendChild(productDiv);
        });
        
        loading.style.display = 'none';
      } catch (err) {
        console.error('Error loading products:', err);
        loading.style.display = 'none';
        error.style.display = 'block';
        
        // Fallback ke data statis jika API gagal
        loadStaticProducts();
      }
    }
    
    // Fungsi fallback untuk data statis
   
    // Fungsi untuk redirect ke halaman detail
    function redirectToDetail(productId) {
      // Opsi 1: Redirect ke halaman detail terpisah
      window.location.href = `Product.php?id=${productId}`;
      
      // Opsi 2: Buka di tab/window baru
      // window.open(`product-detail.php?id=${productId}`, '_blank');
      
      // Opsi 3: Tampilkan modal (jika Anda ingin menggunakan modal)
      // showProductModal(productId);
    }
    
    // Fungsi untuk menampilkan modal detail produk (opsional)
    async function showProductModal(productId) {
      try {
        const response = await fetch(`./api/products.php?id=${productId}`);
        const product = await response.json();
        
        // Buat dan tampilkan modal
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.innerHTML = `
          <div class="modal-content">
            <span class="close" onclick="this.parentElement.parentElement.remove()">&times;</span>
            <h2>${product.nama}</h2>
            <img src="${product.image_url || './component/Gallery/' + product.nama.replace(/\s+/g, '_') + '.png'}" 
                 alt="${product.nama}" style="max-width: 100%; height: auto;">
            <p>${product.deskripsi}</p>
            ${product.harga ? `<p class="price">Harga: Rp ${formatPrice(product.harga)}</p>` : ''}
          </div>
        `;
        
        document.body.appendChild(modal);
      } catch (err) {
        console.error('Error loading product detail:', err);
      }
    }
    
    // Fungsi untuk format harga
    function formatPrice(price) {
      return new Intl.NumberFormat('id-ID').format(price);
    }
    
    // Muat produk saat halaman dimuat
    document.addEventListener('DOMContentLoaded', loadProducts);
  </script>
</body>
</html>