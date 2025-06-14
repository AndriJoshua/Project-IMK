<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja - UMKM Maritim</title>
    <link rel="stylesheet" href="../UMKM-MARITIM/index.css">
    <style>
        .cart-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 20px;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-name {
            font-weight: bold;
        }

        .cart-item-actions button {
            margin-left: 10px;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        .btn-checkout {
            display: block;
            margin: 20px auto 0;
            padding: 12px 24px;
            background-color: #25D366; /* Warna WhatsApp */
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-checkout:hover {
            background-color: #128C7E;
        }

        .cart-item-checkbox {
            width: 20px;
            height: 20px;
            margin-right: 15px;
        }

        .cart-item.selected {
            background-color: #f0f9ff;
        }

        .btn-delete {
            background: none;
            border: none;
            color: #e74c3c;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-delete:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include './component/header.php'; ?>
    <div class="cart-container">
        <h2>Keranjang Belanja</h2>
        <div id="cart-items"></div>
        <div class="total" id="cart-total"></div>
        <button onclick="orderViaWhatsApp()" class="btn-checkout">Pesan</button>
    </div>
    <?php include './component/footer.php'; ?>

    <script>
        function loadCart() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const container = document.getElementById('cart-items');
            const totalContainer = document.getElementById('cart-total');

            if (cart.length === 0) {
                container.innerHTML = '<p>Keranjang kamu kosong.</p>';
                totalContainer.textContent = '';
                return;
            }

            container.innerHTML = '';

            cart.forEach((item, index) => {
                container.innerHTML += `
                    <div class="cart-item">
                        <input type="checkbox" 
                               class="cart-item-checkbox" 
                               data-price="${item.harga}" 
                               data-quantity="${item.jumlah}"
                               data-index="${index}"
                               onchange="updateTotal()">
                        <img src="${item.gambar}" alt="${item.nama}">
                        <div class="cart-item-details">
                            <div class="cart-item-name">${item.nama}</div>
                            <div>Harga: Rp ${item.harga.toLocaleString('id-ID')}</div>
                            <div>Jumlah: ${item.jumlah}</div>
                            <div>Subtotal: Rp ${(item.harga * item.jumlah).toLocaleString('id-ID')}</div>
                        </div>
                        <button onclick="removeItem(${index})" class="btn-delete">Hapus</button>
                    </div>
                `;
            });

            updateTotal();
        }

        function updateTotal() {
            const checkboxes = document.querySelectorAll('.cart-item-checkbox:checked');
            let total = 0;

            checkboxes.forEach(checkbox => {
                const price = parseFloat(checkbox.dataset.price);
                const quantity = parseInt(checkbox.dataset.quantity);
                total += price * quantity;
            });

            document.getElementById('cart-total').innerHTML = `
                Total: Rp ${total.toLocaleString('id-ID')}
            `;
        }

        function removeFromCart(id) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart = cart.filter(item => item.id !== id);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
        }

        function removeItem(index) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
            updateTotal();
        }

        function orderViaWhatsApp() {
            const checkboxes = document.querySelectorAll('.cart-item-checkbox:checked');
            if (checkboxes.length === 0) {
                alert('Pilih minimal satu produk untuk dipesan');
                return;
            }

            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            let total = 0;
            let message = "*PESANAN BARU*\n\n";
            message += "Detail Pesanan:\n";
            message += "==================\n\n";

            checkboxes.forEach((checkbox, index) => {
                const itemIndex = parseInt(checkbox.dataset.index);
                const item = cart[itemIndex];
                const itemTotal = item.harga * item.jumlah;
                total += itemTotal;
                
                message += `${index + 1}. ${item.nama}\n`;
                message += `   Harga: Rp ${item.harga.toLocaleString('id-ID')}\n`;
                message += `   Jumlah: ${item.jumlah}\n`;
                message += `   Subtotal: Rp ${itemTotal.toLocaleString('id-ID')}\n\n`;
            });

            message += "==================\n";
            message += `*Total: Rp ${total.toLocaleString('id-ID')}*\n\n`;
            message += "Mohon konfirmasi pesanan saya.\nTerima kasih.";

            const phoneNumber = "6285356277535";
            const encodedMessage = encodeURIComponent(message);
            window.open(`https://wa.me/${phoneNumber}?text=${encodedMessage}`, '_blank');
        }

        document.addEventListener('DOMContentLoaded', loadCart);
    </script>
</body>
</html>
