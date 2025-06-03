<!DOCTYPE html>
<html>
<head>
  <title>Detail Produk</title>
</head>
<body>
  <div id="detail"></div>
  <a href="index.html">← Kembali ke daftar</a>

  <script>
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    fetch(`produk.php?id=${id}`)
      .then(res => res.json())
      .then(data => {
        document.getElementById("detail").innerHTML = `
          <h1>${data.nama}</h1>
          <img src="uploads/${data.gambar}" width="200"><br>
          <p><strong>Harga:</strong> Rp${parseInt(data.harga).toLocaleString()}</p>
          <p><strong>Deskripsi:</strong> ${data.deskripsi}</p>
        `;
      });
  </script>
</body>
</html>
