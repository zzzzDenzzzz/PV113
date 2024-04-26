$(document).ready(function () {
  loadCart();

  $(".page-link").click(function (e) {
    e.preventDefault();
    let page = $(this).data("page");
    loadProducts(page);
  });

  function loadProducts(page) {
    $.ajax({
      url: "load_products.php",
      type: "GET",
      data: { page: page },
      success: function (response) {
        $("#product-list").html(response);
      },
    });
  }

  $(document).on("click", ".add-to-cart", function () {
    let productId = $(this).data("product-id");
    addToCart(productId);
  });

  function addToCart(productId) {
    let productItem = $(`button[data-product-id="${productId}"]`).closest(
      ".product-item"
    );
    let productName = productItem.find(".product-name").text();
    let productPrice = parseFloat(
      productItem.find(".product-price").text().replace("$", "")
    );

    let cart = JSON.parse(localStorage.getItem("cart")) || {};
    let item = cart[productId];

    if (item) {
      item.count++;
    } else {
      item = {
        count: 1,
        name: productName,
        price: productPrice,
        id: productId,
      };
    }

    cart[productId] = item;
    localStorage.setItem("cart", JSON.stringify(cart));

    let totalCount = Object.values(cart).reduce(
      (total, value) => total + value.count,
      0
    );
    $("#cart-count").text(totalCount);

    alert("Товар добавлен в корзину");
  }

  function loadCart() {
    let cart = JSON.parse(localStorage.getItem("cart")) || {};
    let totalCount = Object.values(cart).reduce(
      (total, value) => total + value.count,
      0
    );
    $("#cart-count").text(totalCount);
  }

  $("#clear-cart").click(function () {
    localStorage.removeItem("cart");
    $("#cart-count").text("0");
    alert("Корзина очищена!");
  });
});
