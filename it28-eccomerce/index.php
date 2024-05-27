<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #87CEEB; /* Sky blue background */
            font-family: Arial, sans-serif;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .navbar-brand img {
            width: 40px;
        }
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: #ffffff; /* White background for cards */
            border: none; /* No border for cards */
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .btn-primary, .btn-secondary, .btn-success {
            transition: background-color 0.2s, color 0.2s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .card-header, .card-footer {
            background-color: #e9ecef;
        }
        .product-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .product-card .card-body {
            text-align: left;
            padding: 20px;
        }
        .product-card .card-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .product-card .card-text {
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        .product-card .btn {
            width: 100%;
            font-size: 1rem;
        }
        #homepage {
            padding: 100px 0;
            text-align: center;
            background: url('https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2') no-repeat center center;
            background-size: cover;
            color: #ffffff;
            position: relative;
        }
        #homepage::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Add a dark overlay */
        }
        #homepage h1, #homepage p, #homepage .btn {
            position: relative;
            z-index: 1;
        }
        #homepage h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        #homepage p {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
        #homepage .btn {
            padding: 10px 30px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" class="d-inline-block align-top" alt="">
        Bootstrap
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#homepage">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#productsDisplay">Products</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div id="homepage">
    <h1>Welcome to Our Store</h1>
    <p>Explore our exclusive range of products</p>
    <a href="#productsDisplay" class="btn btn-primary">Shop Now</a>
</div>

<div id="productsDisplay" class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-4" id="product1"></div>
        <div class="col-md-4 mb-4" id="product2"></div>
        <div class="col-md-4 mb-4" id="product3"></div>
    </div>
</div>

<div id="cartContainer"></div>

<div id="showCard" class="container mt-5" style="display: none;">
    <div class="card">
        <div class="card-header">
            Shopping Cart
        </div>
        <div class="card-body" id="cartItems">
            <!-- Cart items will be displayed here -->
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" onclick="purchase()">Purchase</button>
            <button class="btn btn-secondary" onclick="cancel()">Cancel</button>
        </div>
    </div>
</div>

<script>
    let cart = {};

    function addToCartAndShow(productId, price) {
        addToCart(productId, price);
        displayShowCard(); // Call the function to display the show card
    }

    function addToCart(productId, price) {
        if (cart[productId]) {
            cart[productId].quantity++;
            cart[productId].totalPrice = cart[productId].quantity * price;
        } else {
            cart[productId] = {
                quantity: 1,
                price: price,
                totalPrice: price
            };
        }
        displayCart();
    }

    function displayCart() {
        const cartItems = document.getElementById('cartItems');
        let showCardHTML = '<h3>Shopping Cart</h3>';
        let totalAmount = 0;
        for (const [productId, item] of Object.entries(cart)) {
            showCardHTML += `<p>Product ID: ${productId}, Quantity: ${item.quantity}, Price: ₱${item.price}, Total Price: ₱${item.totalPrice}</p>`;
            totalAmount += item.totalPrice;
        }
        showCardHTML += `<p>Total Amount: ₱${totalAmount}</p>`;
        cartItems.innerHTML = showCardHTML;
    }

    function displayShowCard() {
        const showCard = document.getElementById('showCard');
        showCard.style.display = 'block';
    }

    function purchase() {
        // Store the cart items in local storage
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Redirect to payment.php
        window.location.href = 'products/payment.php';
    }

    function cancel() {
        // Logic for cancel action
        alert('Cancel action triggered!');
    }
</script>

<script>
    fetch('./products/products-api.php')
        .then(response => response.json())
        .then(data => {
            const productIds = ['product1', 'product2', 'product3'];
            productIds.forEach((id, index) => {
                if (data[index]) {
                    const product = data[index];
                    const cardHTML = `
                        <div class="card product-card">
                            <img class="card-img-top" src="${product.img}" alt="${product.title}">
                            <div class="card-body">
                                <h5 class="card-title">${product.title}</h5>
                                <p class="card-text">Price: ₱${product.rrp}</p>
                                <p class="card-text">${product.description}</p>
                                <p class="card-text">Quantity: ${product.quantity}</p>
                                <button class="btn btn-success" onclick="addToCartAndShow(${product.id}, ${product.rrp})">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    `;
                    document.getElementById(id).innerHTML = cardHTML;
                }
            });
        })
        .catch(error => console.error('Error:', error));
</script>

</body>
</html>
