$(document).ready(function () {
  loadFavorites();
});

// Ambil daftar favorit dari database
function loadFavorites() {
  $.ajax({
    url: "api/favorites.php?action=getFavorites",
    type: "GET",
    dataType: "json",
    success: function (items) {
      var grid = $("#favoritesGrid");
      grid.empty();

      if (items.length == 0) {
        grid.html(
          '<div class="empty-favorites"><i class="fa-regular fa-heart"></i><p>You have no favorite items yet.<br>Click the heart icon on a product to add it here!</p></div>',
        );
        return;
      }

      items.forEach(function (item) {
        var card = '<div class="fav-card">';
        card += '<img src="' + item.image + '" alt="' + item.name + '">';
        card += "<h3>" + item.name + "</h3>";
        card +=
          '<div class="fav-price">Rp ' +
          parseInt(item.price).toLocaleString("id-ID") +
          "</div>";
        card += '<div class="fav-actions">';
        card +=
          '<a href="product/' +
          item.id +
          '" class="btn-view">View</a>';
        card +=
          '<button class="btn-remove-fav" onclick="removeFavorite(' +
          item.fav_id +
          ')">Remove</button>';
        card += "</div>";
        card += "</div>";

        grid.append(card);
      });
    },
  });
}

// Hapus dari favorit
function removeFavorite(favId) {
  $.ajax({
    url: "api/favorites.php",
    type: "POST",
    data: {
      action: "removeFavorite",
      fav_id: favId,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        loadFavorites();
        notifAlert("Removed from favorites");
      }
    },
  });
}

function notifAlert(message) {
  var container = $("#notifContainer");
  var box = $('<div class="notifAlert">' + message + "</div>");
  container.append(box);
  setTimeout(function () {
    box.addClass("show");
  }, 20);
  setTimeout(function () {
    box.removeClass("show");
    setTimeout(function () {
      box.remove();
    }, 300);
  }, 3000);
}