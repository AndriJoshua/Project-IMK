<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>QNA - UMKM Maritim</title>
    <link rel="stylesheet" href="qna.css" />
</head>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #203B5C;
        color: white;
    }

    .qna-section {
        padding: 50px 20px;
        max-width: 800px;
        margin: auto;
        text-align: center;
    }

    .qna-section h2 {
        font-size: 32px;
        margin-bottom: 30px;
        font-weight: 600;
    }

    .qna-card {
        background-color: white;
        color: #333;
        border-radius: 15px;
        padding: 30px;
        text-align: left;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .qna-card ol {
        padding-left: 20px;
    }

    .qna-card li {
        margin-bottom: 20px;
        line-height: 1.6;
    }
</style>

<body>
    <?php include './component/header.php';?>
    <section class="qna-section">
        <h2 style="color:white">FAQ's</h2>
        <div class="qna-card">
            <ol>
                <li>
                    <strong>Apa itu UMKM Maritim?</strong><br />
                    UMKM Maritim adalah usaha mikro, kecil, dan menengah yang bergerak di sektor kelautan dan perikanan. Usaha ini mencakup perikanan tangkap, budidaya, pengolahan hasil laut, serta kerajinan berbasis sumber daya maritim.
                </li>
                <li>
                    <strong>Produk apa saja yang tersedia?</strong><br />
                    Kami menyediakan berbagai produk hasil laut seperti ikan segar, olahan seafood (abon, ikan asap, kerupuk ikan), serta kerajinan berbasis bahan laut seperti aksesori dari kerang dan anyaman rumput laut.
                </li>
                <li>
                    <strong>Apakah produk bisa dikirim ke luar daerah?</strong><br />
                    Ya, kami melayani pengiriman ke berbagai daerah dengan kemasan khusus untuk menjaga kualitas produk, terutama untuk produk segar dan olahan.
                </li>
                <li>
                    <strong>Bagaimana cara memesan produk?</strong><br />
                    Anda bisa memesan produk melalui halaman "Produk & Layanan" di website kami. Cukup pilih produk, masukkan jumlah yang diinginkan, dan isi formulir pemesanan.
                </li>
                <li>
                    <strong>Apakah ada program kemitraan untuk reseller?</strong><br />
                    Ya, kami membuka peluang kemitraan bagi reseller dan distributor yang ingin menjual produk kami. Silakan hubungi kami melalui halaman "Kontak" untuk informasi lebih lanjut.
                </li>
                <li>
                    <strong>Apa manfaat membeli dari UMKM Maritim?</strong><br />
                    Dengan membeli produk kami, Anda turut mendukung perekonomian nelayan dan pengrajin lokal, serta mendapatkan produk berkualitas tinggi langsung dari sumbernya.
                </li>
            </ol>
        </div>
    </section>
    <?php include './component/footer.php';?>
</body>

</html>