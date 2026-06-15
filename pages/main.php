<link rel="stylesheet" href="./assets/css/main-style.css?v=<?= time(); ?>" />


    <!-- Hero Section with Bootstrap Carousel-->
    <div class="hero-section">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-interval="false">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="hero-bg" style="background-image: url('./assets/img/banner10.jpeg');"></div>
          </div>
          <div class="carousel-item">
            <div class="hero-bg" style="background-image: url('./assets/img/banner0.jpg');"></div>
          </div>
          <div class="carousel-item">
            <div class="hero-bg" style="background-image: url('./assets/img/banner7.jpg');"></div>
          </div>
          <div class="carousel-item">
            <div class="hero-bg" style="background-image: url('./assets/img/banner11.jpg');"></div>
          </div>
        </div>
      </div>
      
      <div class="hero-overlay"></div>
      
      <div class="hero-container">
        <div class="hero-content">
          <span class="hero-badge">Toko Game Terlengkap</span>
          <h1 class="hero-title">Mainkan Game<br>Impianmu, hanya di<br>
          Gam<span style="color: #A0C4FF;">i</span><span style="color: #BDB2FF;">n</span><span style="color: #E8AEFF;">c</span><span style="color: #FFC6FF;">!</span></h1>
          <p class="hero-desc">
            Gaminc. hadir sebagai surga belanja para gamer. Dapatkan rilisan game PlayStation dan Nintendo Switch 2 paling hits, 100% produk original, serta pengiriman gratis ongkir ke seluruh Indonesia.
          </p>
          <div class="hero-buttons">
            <a href="product" class="btn-hero-primary">Eksplor Game</a>
            <a href="#testimonials" class="btn-hero-outline">Cek Info</a>
          </div>
        </div>
      </div>

      <!-- Standard Bootstrap Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>

      <!-- Bootstrap Pagination -->
 
    </div>


    <!-- new arrival -->
    <div class="container">
      <div class="new-arrival">
        <div class="arrival-left-banner">
          <h3>NEW<br />
          <span style="color: #BDB2FF;">ARRIVAL</span>
        </h3>
          <p>Be the first to own new items !</p>
          <button onclick="location.href='product'" class="arrival-left-btn">Go to Products</button>
        </div>

        <div class="arrival-right-grid">
          <div class="arrival-right-card">
            <div class="arrival-right-image">
              <img src="./assets/img/nba.jpg" class="arrival-right-innerimage"> <span class="badge playstation">PLAYSTATION</span>
            </div>
            <h3>NBA 2K26 </h3>
            <p class="arrival-right-price">Rp 815.000</p>
            <button class="see-more" onclick="location.href='product'">See More</button>
          </div>

          <div class="arrival-right-card">
            <div class="arrival-right-image">
              <img src="./assets/img/ninja.jpg" class="arrival-right-innerimage"> <span class="badge playstation">PLAYSTATION</span>
            </div>
            <h3>Ninja Gaiden 4</h3>
            <p class="arrival-right-price">Rp 1.024.000</p>
            <button class="see-more" onclick="location.href='product'">See More</button>
          </div>

          <div class="arrival-right-card">
            <div class="arrival-right-image">
              <img src="./assets/img/fc26.jpg" class="arrival-right-innerimage"> <span class="badge switch2">SWITCH 2</span>
            </div>
            <h3>FC 26</h3>
            <p class="arrival-right-price">Rp 760.000</p>
            <button class="see-more" onclick="location.href='product'">See More</button>
          </div>

          <div class="arrival-right-card">
            <div class="arrival-right-image">
              <img src="./assets/img/yotei.jpg" class="arrival-right-innerimage"> <span class="badge playstation">PLAYSTATION</span>
            </div>
            <h3>Ghost of Yōtei</h3>
            <p class="arrival-right-price">Rp 1.029.000</p>
            <button class="see-more" onclick="location.href='product'">See More</button>
          </div>
        </div>
      </div>
    </div>



    <!-- best selling games -->
      <div class="container my-5">
        <h2 class="section-title">Best Selling 
          <span style="color: #A0C4FF;">GAMES</span>
        </h2>
        <div class="game-grid-container" style="margin-bottom: 40px;">

          <div class="grid-column-left">
            <div class="grid-item large-left" style="height: 100%;">
              <a href="product/10" style="display: block; height: 100%;">
                <img src="./assets/img/tlou2.png"/>
                <div class="grid-item-overlay">
                  <span class="grid-item-badge">Terlaris #1</span>
                  <h3 class="grid-item-title">The Last of Us Part II</h3>
                  <p class="grid-item-price">Rp 850.000</p>
                </div>
              </a>
            </div>
          </div>

          <div class="grid-column-right">
            <div class="grid-item small-right-top">
              <a href="product/3" style="display: block; height: 100%;">
                <img src="./assets/img/kirby.jpg"/>
                <div class="grid-item-overlay">
                  <span class="grid-item-badge">Terlaris #2</span>
                  <h3 class="grid-item-title">Kirby: Air Riders</h3>
                  <p class="grid-item-price">Rp 950.000</p>
                </div>
              </a>
            </div>
            
            <div class="grid-item small-right-bottom">
              <a href="product/11" style="display: block; height: 100%;">
                <img src="./assets/img/spidermanmiles.png"/>
                <div class="grid-item-overlay">
                  <span class="grid-item-badge">Terlaris #3</span>
                  <h3 class="grid-item-title">Spiderman: Miles Morales</h3>
                  <p class="grid-item-price">Rp 350.000</p>
                </div>
              </a>
            </div>
          </div>
        </div>

        <div class="grid-item banner-grid-item" style="margin-bottom: 60px;">
          <a href="product/20" style="display: block; height: 100%;">
            <img src="./assets/img/banner22.jpg"/>
            <div class="grid-item-overlay">
              <span class="grid-item-badge" style="background: #ef4444; color: #fff;">Promo Spesial</span>
              <h3 class="grid-item-title">Eksplor Penawaran Menarik Lainnya</h3>
              <p class="grid-item-desc" style="color: rgba(255,255,255,0.8); margin: 0;">Dapatkan diskon hingga 50% untuk judul-judul game pilihan minggu ini.</p>
            </div>
          </a>
        </div>
      </div>

    <!-- Testimonial Highlight Section -->
    <section id="testimonials" class="testimonial-highlight-section">
      <!-- Background Character Graphics -->
      <img src="./assets/img/Jin3.png" alt="Jin Kazama (Tekken)" class="testimonial-bg-char-left">
      <img src="./assets/img/adawong.png" alt="Ada Wong (Resident Evil)" class="testimonial-bg-char-right">

      <div class="container" style="position: relative; z-index: 2;">
        <!-- Centered Header -->
        <div class="testimonial-header">
          <span class="testimonial-badge">Apa Kata Mereka ?</span>
          <h2 class="testimonial-section-title">Gamer Puas, Kami Senang!</h2>
          <p class="testimonial-section-desc">Ribuan gamer di Indonesia telah mempercayai GamInc. sebagai destinasi belanja game original terbaik mereka.</p>
        </div>

        <!-- 3-Column Grid Layout -->
        <div class="testimonial-grid-layout">
          <!-- Testimonial 1 -->
          <div class="testimonial-card">
            <div class="testimonial-stars">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
            </div>
            <p class="testimonial-text">"Pelayanan super cepat! Game yang saya pesan sampai dalam 2 hari dan semuanya original. Pasti bakal belanja lagi di sini!"</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar" style="background: #A0C4FF; color: #000;">
                <span>R</span>
              </div>
              <div class="testimonial-meta">
                <h4>Rizky Pratama</h4>
                <span class="testimonial-role">Verified Buyer</span>
              </div>
            </div>
          </div>

          <!-- Testimonial 2 -->
          <div class="testimonial-card">
            <div class="testimonial-stars">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
            </div>
            <p class="testimonial-text">"Koleksi game-nya lengkap banget, dari PS5 sampai Switch 2 semua ada. Harga juga bersaing. Recommended banget!"</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar" style="background: #E8AEFF; color: #000;">
                <span>A</span>
              </div>
              <div class="testimonial-meta">
                <h4>Anisa Dewi</h4>
                <span class="testimonial-role">Verified Buyer</span>
              </div>
            </div>
          </div>

          <!-- Testimonial 3 -->
          <div class="testimonial-card">
            <div class="testimonial-stars">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
            </div>
            <p class="testimonial-text">"Support-nya ramah dan fast response. Pernah ada masalah pengiriman tapi langsung dibantu sampai selesai. Mantap!"</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar" style="background: #BDB2FF; color: #000;">
                <span>D</span>
              </div>
              <div class="testimonial-meta">
                <h4>Dimas Ardianto</h4>
                <span class="testimonial-role">Verified Buyer</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Testimonial Footer Note -->
        <div class="testimonial-more">
          <p class="testimonial-more-text">dan 1000+ testimoni lainnya > </p>
        </div>
      </div>
    </section>

      <!-- Community Card Section -->
      <div class="container my-5">
        <div class="community-card">
          <!-- discordbanner bg GRAYSCALE -->
          <div class="community-card-bg"></div>
          <div class="community-overlay"></div>
          <div class="community-content">
            <!-- <h2 class="community-title">Jangan Main Sendirian !</h2> -->
            <h2 class="community-title">Mabar Lebih Seru Bareng Komunitas !</h2>
            <p class="community-desc">
              Dapatkan info promo eksklusif, cari teman mabar, dan ikuti giveaway menarik dengan bergabung ke komunitas gamer kami sekarang, GRATIS !
            </p>
            <a href="https://discord.gg" target="_blank" class="btn-community-join">
              <i class="fa-brands fa-discord me-2"></i> Gabung Komunitas
            </a>
          </div>
        </div>
      </div>

    <!-- contact us  -->
    <section id="contact" class="contact">
      <div class="container">
        <h2 class="section-title">Contact 
          <span style="color: #E8AEFF">Us</span>
        </h2>
        <div class="contact-content">
          <div class="contact-info">

            <div class="contact-item">
              <i class="fas fa-envelope"></i>
                <div>
                  <h4>Email</h4>
                  <p>support@gaminc.com</p>
                </div>
            </div>

            <div class="contact-item">
              <i class="fas fa-phone"></i>
                <div>
                  <h4>Phone</h4>
                  <p>WhatsApp: +62 812-9999-9999</p>
                </div>
            </div>

            <div class="contact-item">
              <i class="fas fa-map-marker-alt"></i>
                <div>
                  <h4>Address</h4>
                  <p>Jl. Gaminc Center No. 123, Jakarta Barat, Indonesia</p>
                </div>
            </div>
            
          </div>
          
          <div class="map-card">
            <h4>Find Us</h4>
            <div class="map-wrapper">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.4799741033162!2d106.82356565026629!3d-6.136083819383487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1e02081711a1%3A0xab408191f954d871!2sITC%20Mangga%20Dua!5e0!3m2!1sid!2sid!4v1762317099020!5m2!1sid!2sid"
                width="100%"
                height="300"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </div>
          
        </div>

        <div class="social-media">
          <h4>Follow Us</h4>
          <div class="social-icons">
            <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-youtube" ></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter" ></i></a>
          </div>
        </div>

      </div>
    </section>

<script src="assets/js/thtoggle.js"></script>