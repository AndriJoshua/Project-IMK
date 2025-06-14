<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../UMKM-MARITIM/index.css">
</head>
<body>
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">UMKM</a>
            <nav>
                <ul class="nav-menu" id="nav-menu">
                    <li><a href="./index.php">Beranda</a></li>
                    <li><a href="./Contact_Us.php">Contact Us</a></li>
                    <li><a href="./OurProduct.php">Product</a></li>
                    <li><a href="./About_Us.php">About Us</a></li>
                    <li><a href="./FAQ's.php">FAQ's</a></li>
                    <li><a href="./cart.php">Keranjang</a></li>
                </ul>
            </nav>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

<script>
     const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('nav-menu');

        hamburger.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            hamburger.classList.toggle('active');
        });

        //menutup menu saat klik pada link
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                hamburger.classList.remove('active');
            });
        });

        // Menutup Menu saat klik di luar area navigasi
        document.addEventListener('click', function(event) {
            const isClickInsideNav = navMenu.contains(event.target);
            const isClickOnHamburger = hamburger.contains(event.target);

            if (!isClickInsideNav && !isClickOnHamburger && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                hamburger.classList.remove('active');
            }
        });

        // Untuk Resize Window
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                navMenu.classList.remove('active');
                hamburger.classList.remove('active');
            }
        });
    </script>
