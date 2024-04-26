$(document).ready(function () {
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
});
