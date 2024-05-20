<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Bootstrap
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div id="productsDisplay" class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-4" id="product1"></div>
        <div class="col-md-4 mb-4" id="product2"></div>
        <div class="col-md-4 mb-4" id="product3"></div>
    </div>
</div>

<div id="cartContainer"></div>

<script>
    fetch('./products/products-api.php')
        .then(response => response.json())
        .then(data => {
            const productIds = ['product1', 'product2', 'product3'];
            productIds.forEach((id, index) => {
                if (data[index]) {
                    const product = data[index];
                    const cardHTML = `
                        <div class="card">
                            <img class="card-img-top" src="${product.img}" alt="${product.title}">
                            <div class="card-body">
                                <h5 class="card-title">${product.title}</h5>
                                <p class="card-text">Price: ₱${product.rrp}</p>
                                <p class="card-text">${product.description}</p>
                                <p class="card-text">Quantity: ${product.quantity}</p>
                                <button class="btn btn-success" onclick="addToCart(${product.id})">
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

    let cart = {};

    function addToCart(productId) {
        if (cart[productId]) {
            cart[productId]++;
        } else {
            cart[productId] = 1;
        }
        displayCart();
    }

    function displayCart() {
        const cartContainer = document.getElementById('cartContainer');
        let cartHTML = '<h3>Cart</h3>';
        for (const [productId, quantity] of Object.entries(cart)) {
            cartHTML += `<p>Product ID: ${productId}, Quantity: ${quantity}</p>`;
        }
        cartContainer.innerHTML = cartHTML;
    }
</script>
</body>
</html>
