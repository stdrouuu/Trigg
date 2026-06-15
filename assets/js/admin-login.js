// Redirect ke dashboard jika sudah login
$.ajax({
  url: "administrator/api/admin_auth.php",
  type: "POST",
  data: { action: "checkSession" },
  dataType: "json",
  success: function (response) {
    if (response.loggedIn) {
      window.location.href = "admin/dashboard";
    }
  },
});

// button click
$("#adminLoginBtn").click(function () {
  var username = $("#adminUsername").val();
  var password = $("#adminPassword").val();

  if (username == "" || password == "") {
    $("#errorMsg").text("Please fill in all fields.").show();
    return;
  }

  $.ajax({
    url: "administrator/api/admin_auth.php",
    type: "POST",
    data: {
      action: "login",
      username: username,
      password: password,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        window.location.href = "admin/dashboard";
      } else {
        $("#errorMsg").text(response.message).show();
      }
    },
  });
});

// Izinkan tombol Enter untuk login
$("#adminPassword").keypress(function (e) {
  if (e.which == 13) {
    $("#adminLoginBtn").click();
  }
});
