<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>
    <link rel="stylesheet" href="./component/Contact_Us.css">
</head>

<body>
    <?php include './component/header.php'; ?>
    <div class="container">
        <h2>Contact Us</h2>
        <div class="image-box">
            <img src="./component/Gallery/Abon.png" alt="Food" />
        </div>
        <form class="contact-form">
            <label>Name</label>
            <input type="text" placeholder="Name" required>
            <label>Email</label>
            <input type="email" placeholder="Email" required>
            <label>Pesan</label>
            <textarea placeholder="Reason" rows="5" required></textarea>
            <button type="submit">SEND</button>
        </form>
    </div>
    <?php include './component/footer.php'?>
</body>

</html>