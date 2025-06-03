<!DOCTYPE html>
<html>
<head>
  <title>Produk</title>
</head>
<body>
  <h1>Daftar Produk</h1>
  <div id="produk-list" style="display: flex; flex-wrap: wrap;"></div>

  <script>
    fetch("produk.php")
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById("produk-list");
        data.forEach(item => {
          const div = document.createElement("div");
          div.style.margin = "20px";
          div.innerHTML = `
            <a href="detail.php?id=${item.id}">
              <img src="uploads/${item.gambar}" width="150"><br>
              ${item.nama}
            </a>
          `;
          container.appendChild(div);
        });
      });
  </script>
</body>
</html>
