<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UMKM Maritim</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="../UMKM-MARITIM/index.css">
  <link rel="stylesheet" href ="./component/About_Us.css">
 
</head>

<body>
  <?php include './component/header.php';?>
  <div class="hero">
    <h3>SELAMAT DATANG</h3>
  </div>
  
  <section class="about-section">
    <h2>About Us</h2>
    <div class="about-content">
      <div id="about-map" class="about-map">
      </div>
      <div class="about-text">
        <p>
          Kami adalah UMKM maritim yang berkomitmen menghasilkan produk berkualitas tinggi dari hasil laut terbaik.
          Dengan bahan utama ikan dari nelayan lokal, kami mengolah setiap produk dengan standar mutu tinggi dan ramah lingkungan.
          Produk kami meliputi aneka olahan ikan segar, produk beku, hingga camilan ikan bernutrisi tinggi.
          Dengan semangat inovasi dan tradisi, kami terus membawa kekayaan laut Indonesia ke meja Anda.
        </p>
      </div>
    </div>
  </section>
  <?php include './component/footer.php';?>

</body>
<script>
  var lokasi = [0.907541, 104.461122]; 
  var map = L.map('about-map').setView(lokasi, 15);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  L.marker(lokasi).addTo(map)
    .bindPopup('Lokasi UMKM Maritim')
    .openPopup();
</script>

</html>