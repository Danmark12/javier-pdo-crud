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
            background: linear-gradient(to right, #ff7e5f, #feb47b); /* Modern gradient background */
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .navbar-brand img {
            width: 40px;
            margin-right: 10px;
        } 
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: rgba(255, 255, 255, 0.7); /* Transparent white background for cards */
            border: none; /* No border for cards */
            border-radius: 10px; /* Rounded corners */
            overflow: hidden; /* Ensure inner elements are contained within the card */
            position: relative; /* For adding pseudo-elements */
        }
        .card:not(.no-design):hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .btn {
            transition: background-color 0.2s, color 0.2s;
            font-size: 1rem;
        }
        .btn:not(.no-modernize):hover {
            background-color: #0056b3;
        }
        .card-header, .card-footer {
            background-color: rgba(233, 236, 239, 0.8);
        }
        .product-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            max-height: 200px;
            object-fit: cover; 
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
        #homepage {
            padding: 100px 0;
            text-align: center;
            background: url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0') no-repeat center center;
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
        #showCard {
            display: none;
            transition: all 0.5s ease;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="https://img.icons8.com/external-justicon-lineal-color-justicon/344/external-store-online-shopping-justicon-lineal-color-justicon.png" alt="Logo">
        D-store
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
            <button class="btn btn-outline-success my-2 my-sm-0 no-modernize" type="submit">Search</button>
        </form>
    </div>
</nav>

<div id="homepage">
    <h1>Welcome to Our Store</h1>
    <p>Explore our exclusive range of products</p>
    <a href="#productsDisplay" class="btn btn-primary no-modernize">Shop Now</a>
</div>

<div id="productsDisplay" class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-4 product-card" id="product1"></div>
        <div class="col-md-4 mb-4 product-card" id="product2"></div>
        <div class="col-md-4 mb-4 product-card" id="product3"></div>
    </div>
</div>

<div id="cartContainer"></div>

<div id="showCard" class="container mt-5">
    <div class="card">
        <div class="card-header">
            Shopping Cart
        </div>
        <div class="card-body" id="cartItems">
            <!-- Cart items will be displayed here -->
        </div>
        <div class="card-footer">
            <button class="btn btn-primary no-modernize" onclick="purchase()">Purchase</button>
            <button class="btn btn-secondary no-modernize" onclick="cancel()">Cancel</button>
        </div>
    </div>
</div>

<script>
    let cart = {};

    function addToCartAndShow(p_id, p_price) {
        addToCart(p_id, p_price);
        displayShowCard(); // Call the function to display the show card
    }

    function addToCart(p_id, p_price) {
        if (cart[p_id]) {
            cart[p_id].quantity++;
            cart[p_id].totalPrice = cart[p_id].quantity * p_price;
        } else {
            cart[p_id] = {
                quantity: 1,
                price: p_price,
                totalPrice: p_price
            };
        }
        displayCart();
    }

    function displayCart() {
        const cartItems = document.getElementById('cartItems');
        let showCardHTML = '<h3>Shopping Cart</h3>';
        let totalAmount = 0;
        for (const [p_id, item] of Object.entries(cart)) {
            showCardHTML += `<p>Product ID: ${p_id}, Quantity: ${item.quantity}, Price: ₱${item.price}, Total Price: ₱${item.totalPrice}</p>`;
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
        
        // Get the product IDs from the cart
        const productIds = Object.keys(cart);

        if (productIds.length > 0) {
            // Redirect to user_details.php with the first product ID
            window.location.href = './products/user_details.php?p_id=' + productIds[0];
        } else {
            // Handle the case when there are no products in the cart
            alert('Your cart is empty!');
        }
    }

    function cancel() {
        // Logic for cancel action
        alert('Cancel action triggered!');
    }

    fetch('./products/products-api.php')
        .then(response => response.json())
        .then(data => {
            const productIds = ['product1', 'product2', 'product3'];
            productIds.forEach((id, index) => {
                if (data[index]) {
                    const product = data[index];
                    const cardHTML = `
                        <div class="card product-card">
                            <img class="card-img-top" src="${product.p_img}" alt="${product.p_title}">
                            <div class="card-body">
                                <h5 class="card-title">${product.p_title}</h5>
                                <p class="card-text">Price: ₱${product.p_rrp}</p>
                                <p class="card-text">${product.p_description}</p>
                                <button class="btn btn-success" onclick="addToCartAndShow(${product.p_id}, ${product.p_rrp})">
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

