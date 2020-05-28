$("#search").on("input", function () {
  var userSearch = $(this).val().trim();

  if (userSearch) {
    $.ajax({
      url: "back.php",
      type: "GET",
      dataType: "json",
      data: { search: userSearch },
      success: function (res) {
        if (res) {
          var availableTags = [];
          res.forEach(function (product, index) {
            availableTags.push(product.title);
          });
          $("#search").autocomplete({
            source: availableTags,
            select: function (event, ui) {
              $(".search-btn").click();
            },
          });
        }
      },
    });
  }
});
