
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM - Produk Makanan Berkualitas</title>
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <!-- Header -->
    <?php include './component/header.php';?>
    <!-- Hero Section -->
    <section class="welcome-image">
        <div class="Gambar_welcome"></div>
    </section>

    <!-- Products Carousel -->
    <section class="highlight-section">
        <div class="highlight-container">
            <div class="highlight-text">
                <p>
                    Temukan cita rasa terbaik dari hasil laut dengan produk unggulan kami,
                    mulai dari kerupuk ikan yang renyah, otak-otak ikan segar yang gurih,
                    hingga terasi udang premium dengan aroma khas – semua dibuat dengan
                    bahan berkualitas dari nelayan lokal untuk menghadirkan kelezatan autentik
                    di setiap hidangan.
                </p>
            </div>
            <div class="carousel-wrapper">
                <button class="arrow left" onclick="prevSlide()">❮</button>
                <div class="highlight-image">
                    <img src="https://images.unsplash.com/photo-1615141982883-c7ad0e69fd62?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Produk Laut" />
                </div>
                <button class="arrow right" onclick="nextSlide()">❯</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include './component/footer.php';?>
    <script>
        window.onload = function () {
        const images = [
            "./crab.png",
            "./component/Gallery/Abon.png",
            "./component/Gallery/otak-otak.png"
        ];
        let currentIndex = 0;
        const imgElement = document.querySelector(".highlight-image img");

        function showImage(index) {
            imgElement.src = images[index];
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        }

        // Set gambar awal
        showImage(currentIndex);

        // Pasang ke global agar bisa dipanggil onclick di HTML
        window.nextSlide = nextSlide;
        window.prevSlide = prevSlide;

        //setInterval(nextSlide,3000);
    }
    </script>
</body>

</html>