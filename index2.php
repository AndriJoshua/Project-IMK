<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Produk</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f5f5f5;
    }

    .section {
      background-color: #1b3c59;
      padding: 40px 0;
      color: #fff;
    }

    .card {
      background-color: #fff;
      max-width: 600px;
      margin: auto;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      color: #000;
      text-align: center;
    }

    .card img {
      width: 150px;
      border-radius: 10px;
    }

    .card h3 {
      margin: 10px 0 5px;
    }

    .card p {
      font-size: 14px;
      margin: 8px 0;
    }

    .btn-pesan {
      background-color: #28a745;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 20px;
      cursor: pointer;
      margin: 10px 0;
    }

    .tags {
      margin-top: 10px;
      font-size: 14px;
    }

    .best-seller {
      background-color: #fff;
      margin: 30px auto;
      max-width: 900px;
      padding: 20px;
      border-radius: 12px;
    }

    .best-seller h3 {
      text-align: center;
      margin-bottom: 20px;
      color: #000;
    }

    .products {
      display: flex;
      gap: 20px;
      justify-content: space-around;
      flex-wrap: wrap;
    }

    .product {
      text-align: center;
      max-width: 200px;
    }

    .product img {
      width: 100%;
      border-radius: 10px;
    }

    .product h4 {
      margin: 10px 0 5px;
      color: #000;
    }

    .product p {
      font-size: 13px;
      color: #333;
    }

    .read-more {
      display: inline-block;
      margin-top: 5px;
      color: #007bff;
      text-decoration: none;
      font-size: 13px;
    }
  </style>
</head>
<body>

  <div class="section">
    <div class="card">
      <img src="https://example.com/kerupuk-atom.png" alt="Kerupuk Atom" />
      <h3>Kerupuk Atom</h3>
      <p><strong>Rp 10.000</strong></p>
      <p>Camilan renyah yang terbuat dari adonan tepung tapioka dan bumbu udang, lalu digoreng hingga menggembung.</p>
      <button class="btn-pesan">PESAN</button>
      <div class="tags">
        Tags : Terbaru, Best seller<br />
        Stock : 20
      </div>
    </div>
  </div>

  <div class="best-seller">
    <h3>BEST SELLER</h3>
    <div class="products">
      <div class="product">
        <img src="https://example.com/abon-ikan.png" alt="Abon Ikan" />
        <h4>Abon Ikan</h4>
        <p>Rp 20.000</p>
        <a href="#" class="read-more">Read More</a>
      </div>
      <div class="product">
        <img src="https://example.com/keripik.png" alt="Keripik" />
        <h4>Keripik Wortel</h4>
        <p>Rp 15.000</p>
        <a href="#" class="read-more">Read More</a>
      </div>
      <div class="product">
        <img src="https://example.com/stik-udang.png" alt="Stik Udang" />
        <h4>Stik Udang</h4>
        <p>Rp 15.000</p>
        <a href="#" class="read-more">Read More</a>
      </div>
    </div>
  </div>

</body>
</html>
