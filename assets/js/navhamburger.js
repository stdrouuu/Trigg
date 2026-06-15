document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".hamburger-icon");
  const overlay = document.querySelector(".mobile-overlay");
  const links = document.querySelectorAll(".mobile-menu a");

  const toggleMenu = () => {
    const isActive = overlay.classList.toggle("active");
    hamburger.classList.toggle("active", isActive);
    document.body.classList.toggle("menu-open", isActive);

    const icon = hamburger.querySelector("i");
    if (isActive) {
      icon.classList.remove("fa-bars");
      icon.classList.add("fa-xmark");
    } else {
      icon.classList.remove("fa-xmark");
      icon.classList.add("fa-bars");
    }
  };

  const closeMenu = () => {
    overlay.classList.remove("active");
    hamburger.classList.remove("active");
    document.body.classList.remove("menu-open");
    
    const icon = hamburger.querySelector("i");
    icon.classList.remove("fa-xmark");
    icon.classList.add("fa-bars");
  };

  hamburger.addEventListener("click", toggleMenu);

  overlay.addEventListener("click", (e) => {
    if (e.target === overlay) {
      closeMenu();
    }
  });

  links.forEach((link) => link.addEventListener("click", closeMenu));




  
  // Handle Favorites link/button click when user is not logged in ---------------------------------------------
  const favBtns = document.querySelectorAll(".fav-navbar-btn");
  favBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
      if (!window.isLoggedIn) {
        e.preventDefault();
        showGlobalAlert("Please log in first!");
      }
    });
  });

  function showGlobalAlert(message) {
    let container = document.getElementById("notifContainer");
    if (!container) {
      container = document.createElement("div");
      container.id = "notifContainer";
      document.body.appendChild(container);
    }
    const box = document.createElement("div");
    box.className = "notifAlert";
    box.textContent = message;
    container.appendChild(box);

    setTimeout(() => {
      box.classList.add("show");
    }, 20);

    setTimeout(() => {
      box.classList.remove("show");
      setTimeout(() => {
        box.remove();
      }, 300);
    }, 3000);
  }
});