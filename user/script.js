let cart = [];
let total = 0;

function addToCart(item, price) {
  cart.push({ item, price });
  updateCart();
}

function updateCart() {
  const cartList = document.getElementById('cart-items');
  const totalSpan = document.getElementById('total');

  cartList.innerHTML = '';
  total = 0;

  cart.forEach(product => {
    const li = document.createElement('li');
    li.textContent = `${product.item} - $${product.price.toFixed(2)}`;
    cartList.appendChild(li);
    total += product.price;
  });

  totalSpan.textContent = total.toFixed(2);
}

function submitOrder(event) {
  event.preventDefault();

  const name = document.getElementById('name').value.trim();
  const address = document.getElementById('address').value.trim();
  const payment = document.getElementById('payment').value;

  if (!cart.length) {
    alert("Your cart is empty!");
    return;
  }

  if (!name || !address || !payment) {
    alert("Please fill out all fields.");
    return;
  }

  const params = new URLSearchParams({
    name,
    address,
    payment,
    total: total.toFixed(2)
  });

  fetch('submit_order.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: params.toString()
  })
  .then(res => res.text())
  .then(response => {
    if (response === "success") {
      alert("Order submitted successfully!");
      cart = [];
      updateCart();
      event.target.reset();
    } else {
      alert("Error: " + response);
    }
  })
  .catch(err => {
    alert("Request failed: " + err);
  });
}

function filterProducts() {
  const query = document.getElementById('search').value.toLowerCase().trim();
  const products = document.querySelectorAll('.product');
  let matchFound = false;

  products.forEach(product => {
    const name = product.querySelector('h2')?.textContent.toLowerCase() || '';

    if (name.includes(query)) {
      product.style.display = 'block';
      matchFound = true;
    } else {
      product.style.display = 'none';
    }
  });

  const noResult = document.getElementById('no-result');
  if (noResult) {
    noResult.style.display = matchFound ? 'none' : 'block';
  }
}

