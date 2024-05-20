 

 {{--  starting loading logo when opening the website --}}
 <div class="preloader-wrapper">
    <div class="preloader">
    </div>
  </div>
  {{--  ending loading logo when opening the website --}}


  <div class="search-popup">
    <div class="search-popup-container">

      <form role="search" method="get" class="search-form" action="">
        <input type="search" id="search-form" class="search-field" placeholder="Type and press enter" value="" name="s" />
        <button type="submit" class="search-submit"><a href="#"><i class="icon icon-search"></i></a></button>
      </form>

      <h5 class="cat-list-title">Browse Categories</h5>

      <ul class="cat-list">
        <li class="cat-list-item">
          <a href="shop.html" title="Men Jackets">Men Jackets</a>
        </li>
        <li class="cat-list-item">
          <a href="shop.html" title="Fashion">Fashion</a>
        </li>
        <li class="cat-list-item">
          <a href="shop.html" title="Casual Wears">Casual Wears</a>
        </li>
        <li class="cat-list-item">
          <a href="shop.html" title="Women">Women</a>
        </li>
        <li class="cat-list-item">
          <a href="shop.html" title="Trending">Trending</a>
        </li>
        <li class="cat-list-item">
          <a href="shop.html" title="Hoodie">Hoodie</a>
        </li>
        <li class="cat-list-item">
          <a href="shop.html" title="Kids">Kids</a>
        </li>
      </ul>
    </div>
  </div>

  {{-- begin of billboard section --}}

  <section id="billboard" class="overflow-hidden">

    <button class="button-prev">
      <i class="icon icon-chevron-left"></i>
    </button>
    <button class="button-next">
      <i class="icon icon-chevron-right"></i>
    </button>
    <div class="swiper main-swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide" style="background-image: url('images/banner1.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;">
          <div class="banner-content">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <h2 class="banner-title">Summer Collection</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero ipsum enim pharetra hac.</p>
                  <div class="btn-wrap">
                    <a href="shop.html" class="btn btn-light btn-medium d-flex align-items-center" tabindex="0">Shop it now <i class="icon icon-arrow-io"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide" style="background-image: url('images/banner2.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;">
          <div class="banner-content">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <h2 class="banner-title">Casual Collection</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero ipsum enim pharetra hac.</p>
                  <div class="btn-wrap">
                    <a href="shop.html" class="btn btn-light btn-light-arrow btn-medium d-flex align-items-center" tabindex="0">Shop it now <i class="icon icon-arrow-io"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
      {{-- end of billboard section --}}
