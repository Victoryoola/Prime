<?php
require APPROOT . '/views/include/header.php';
require APPROOT . '/views/include/navbar.php';
?>
<div class="hero page-inner overlay"
  style="background-image: url('<?php echo URLROOT ?>/Estate/public/images/hero_bg_1.jpg')">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-9 text-center mt-5">
        <h1 class="heading" data-aos="fade-up">Services</h1>

        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
          <ol class="breadcrumb text-center justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/Estate/">Home</a></li>
            <li class="breadcrumb-item active text-white-50" aria-current="page">
              Services
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="box-feature mb-4">
          <span class="flaticon-house mb-4 d-block"></span>
          <h3 class="text-black mb-3 font-weight-bold">
            Quality Properties
          </h3>
          <p class="text-black-50">
            Experience excellence with every property. Premium features and meticulous craftsmanship
            ensure exceptional living standards.
          </p>
          <p><a href="#" class="learn-more">Read more</a></p>
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="box-feature mb-4">
          <span class="flaticon-house-2 mb-4 d-block-3"></span>
          <h3 class="text-black mb-3 font-weight-bold">Top Rated Agent</h3>
          <p class="text-black-50">
            Work with the best. Our top-rated agents deliver expert advice, exceptional service, and results that exceed
            expectations.
          </p>
          <p><a href="#" class="learn-more">Read more</a></p>
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
        <div class="box-feature mb-4">
          <span class="flaticon-building mb-4 d-block"></span>
          <h3 class="text-black mb-3 font-weight-bold">
            Property for Sale
          </h3>
          <p class="text-black-50">
            Prime locations, exceptional homes and premium architectural designs. Discover your ideal property today,
            tailored just for you.
          </p>
          <p><a href="#" class="learn-more">Read more</a></p>
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
        <div class="box-feature mb-4">
          <span class="flaticon-house-3 mb-4 d-block-1"></span>
          <h3 class="text-black mb-3 font-weight-bold">House for Sale</h3>
          <p class="text-black-50">
            Charming homes in desirable locations. Explore beautifully designed spaces with modern amenities and
            exceptional value today.
          </p>
          <p><a href="#" class="learn-more">Read more</a></p>
        </div>
      </div>

      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="box-feature mb-4">
          <span class="flaticon-house-4 mb-4 d-block"></span>
          <h3 class="text-black mb-3 font-weight-bold">
            Quality Properties
          </h3>
          <p class="text-black-50">
            Discover properties crafted with care. Superior design, prime locations, and unmatched quality for a truly
            exceptional living experience.
          </p>
          <p><a href="#" class="learn-more">Read more</a></p>
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="box-feature mb-4">
          <span class="flaticon-building mb-4 d-block-3"></span>
          <h3 class="text-black mb-3 font-weight-bold">Top Rated Agent</h3>
          <p class="text-black-50">
            Connect with highly rated professionals. Expert guidance, outstanding service, and proven results from our
            top agents
          </p>
          <p><a href="#" class="learn-more">Read more</a></p>
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
        <div class="box-feature mb-4">
          <span class="flaticon-house mb-4 d-block"></span>
          <h3 class="text-black mb-3 font-weight-bold">
            Property for Sale
          </h3>
          <p class="text-black-50">
            Explore our curated selections. High-quality homes and unbeatable value at affordable prices awaits you.
          </p>
          <p><a href="#" class="learn-more">Read more</a></p>
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
        <div class="box-feature mb-4">
          <span class="flaticon-house-1 mb-4 d-block-1"></span>
          <h3 class="text-black mb-3 font-weight-bold">House for Sale</h3>
          <p class="text-black-50">
            Elegant homes with top features. Discover your perfect match in prime locations offering comfort and style.
          </p>
          <p><a href="#" class="learn-more">Read more</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="section sec-testimonials">
  <div class="container">
    <div class="row mb-5 align-items-center">
      <div class="col-md-6">
        <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
          Customer Reviews
        </h2>
      </div>
      <div class="col-md-6 text-md-end">
        <div id="testimonial-nav">
          <span class="prev" data-controls="prev">Prev</span>

          <span class="next" data-controls="next">Next</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4"></div>
    </div>
    <div class="testimonial-slider-wrap">
      <div class="testimonial-slider">
        <div class="item">
          <div class="testimonial">
            <img src="<?php echo URLROOT ?>/Estate/public/images/person_1-min.jpg" alt="Image"
              class="img-fluid rounded-circle w-25 mb-4" />
            <div class="rate">
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
            </div>
            <h3 class="h5 text-primary mb-4">James Smith</h3>
            <blockquote>
              <p>
                “Excellent service from start to finish! Our agent was knowledgeable and attentive, helping us find the
                perfect home. We highly recommend them for a seamless experience.”
              </p>
            </blockquote>
            <p class="text-black-50">Buyer</p>
          </div>
        </div>

        <div class="item">
          <div class="testimonial">
            <img src="<?php echo URLROOT ?>/Estate/public/images/person_2-min.jpg" alt="Image"
              class="img-fluid rounded-circle w-25 mb-4" />
            <div class="rate">
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
            </div>
            <h3 class="h5 text-primary mb-4">Mike Houston</h3>
            <blockquote>
              <p>
                “Outstanding from start to finish! They truly listened to our needs and found us the perfect home. Their
                professionalism and attention to detail were top-notch.”
              </p>
            </blockquote>
            <p class="text-black-50">Buyer</p>
          </div>
        </div>

        <div class="item">
          <div class="testimonial">
            <img src="<?php echo URLROOT ?>/Estate/public/images/person_3-min.jpg" alt="Image"
              class="img-fluid rounded-circle w-25 mb-4" />
            <div class="rate">
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
            </div>
            <h3 class="h5 text-primary mb-4">Cameron Webster</h3>
            <blockquote>
              <p>
                “Our agent made the home-buying process stress-free and enjoyable. Their expertise and dedication were
                evident in finding us the ideal property. Highly recommended!”
              </p>
            </blockquote>
            <p class="text-black-50">Buyer</p>
          </div>
        </div>

        <div class="item">
          <div class="testimonial">
            <img src="<?php echo URLROOT ?>/Estate/public/images/person_4-min.jpg" alt="Image"
              class="img-fluid rounded-circle w-25 mb-4" />
            <div class="rate">
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
            </div>
            <h3 class="h5 text-primary mb-4">Dave Smith</h3>
            <blockquote>
              <p>
                “Incredible experience! The team was professional and responsive, guiding us through every step. We’re
                thrilled with our new home and the service provided.”
              </p>
            </blockquote>
            <p class="text-black-50">Buyer</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
require APPROOT . '/views/include/footer.php';
?>