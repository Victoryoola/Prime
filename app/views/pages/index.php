<?php
require APPROOT . '/views/include/header.php';
require APPROOT . '/views/include/navbar.php';
?>
<div class="hero">
    <div class="hero-slide">
        <div class="img overlay"
            style="background-image: url('<?php echo URLROOT ?>/Estate/public/images/hero_bg_3.jpg')"></div>
        <div class="img overlay"
            style="background-image: url('<?php echo URLROOT ?>/Estate/public/images/hero_bg_2.jpg')"></div>
        <div class="img overlay"
            style="background-image: url('<?php echo URLROOT ?>/Estate/public/images/hero_bg_1.jpg')"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center">
                <h1 class="heading" data-aos="fade-up">
                    Easiest way to find your dream home
                </h1>
                <form action="#" class="narrow-w form-search d-flex align-items-stretch mb-3" data-aos="fade-up"
                    data-aos-delay="200">
                    <input type="text" class="form-control px-4" placeholder="Your ZIP code or City. e.g. New York" />
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="font-weight-bold text-primary heading">
                    Popular Properties
                </h2>
            </div>
            <div class="col-lg-3 text-lg-end">
                <p>
                    <a href="<?php echo URLROOT ?>/Estate/agent/properties/create" target="_blank"
                        class="btn btn-primary text-white py-3 px-4">Create property</a>
                </p>
            </div>
            <div class="col-lg-3 text-lg-end">
                <p>
                    <a href="" target="_blank" class="btn btn-primary text-white py-3 px-4">View all properties</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="property-slider-wrap">
                    <div class="property-slider">
                        <?php if (!empty($properties)): ?>
                            <?php foreach ($properties as $property): ?>
                                <div class="property-item">
                                    <a class="img">
                                        <img src="<?php echo URLROOT ?>/Estate/public/images/<?php echo $property['file_url'] ?>"
                                            alt="Image" class="img-fluid" />
                                    </a>

                                    <div class="property-content">
                                        <span class="city d-block"><?php echo $property['propertyTitle'] ?></span>
                                        <div class="price"><span>NGN
                                                <?php echo number_format((int) $property['price']) ?></span>
                                        </div>
                                        <span class="city d-block">For <?php echo $property['propertyStatus'] ?></span>
                                        <div>
                                            <span class="d-block mb-2 text-black-50"><?php echo $property['address'] ?></span>
                                            <span
                                                class="city d-block mb-3"><?php echo $property['lga_name'] . ', ' . $property['state_name'] ?></span>

                                            <div class="specs d-flex mb-4">
                                                <span class="d-block d-flex align-items-center me-3">
                                                    <span class="icon-bed me-2"></span>
                                                    <span class="caption">
                                                        <?php echo $property['bed_number'] ?>
                                                        <?php echo $property['bed_number'] > 1 ? 'beds' : 'bed'; ?>
                                                    </span>
                                                </span>
                                                <span class="d-block d-flex align-items-center">
                                                    <span class="icon-bath me-2"></span>
                                                    <span class="caption">
                                                        <?php echo $property['bath_number'] ?>
                                                        <?php echo $property['bath_number'] > 1 ? 'baths' : 'bath'; ?>
                                                    </span>
                                                </span>
                                                <span class="d-block d-flex align-items-center">
                                                    <i class="fa-solid fa-utensils" style="margin-left: 1rem;"></i>
                                                    <span class="caption" style="margin-left: 10px;">
                                                        <?php echo $property['kitchen_number'] ?>
                                                        <?php echo $property['kitchen_number'] > 1 ? 'kitchens' : 'kitchen'; ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <p>No Properties Available</p>
                        <?php endif ?>
                    </div>

                    <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
                        <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">Prev</span>
                        <span class="next" data-controls="next" aria-controls="property" tabindex="-1">Next</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="features-1">
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="box-feature">
                    <span class="flaticon-house"></span>
                    <h3 class="mb-3">Our Properties</h3>
                    <p>
                        Prime locations. Exceptional value. Your perfect home awaits.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                <div class="box-feature">
                    <span class="flaticon-building"></span>
                    <h3 class="mb-3">Property for Sale</h3>
                    <p>
                        Exclusive listings. Find your dream property today.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="box-feature">
                    <span class="flaticon-house-3"></span>
                    <h3 class="mb-3">Real Estate Agent</h3>
                    <p>
                        Expert guidance. Personalized service. Your trusted property partner.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="box-feature">
                    <span class="flaticon-house-1"></span>
                    <h3 class="mb-3">House for Sale</h3>
                    <p>
                        Stunning homes. Exceptional value. Find yours today.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

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
                                &ldquo;Outstanding service! Our agent found our dream home effortlessly and made the
                                entire process
                                seamless. From the first showing to closing, every detail was handled professionally. We
                                couldn’t be
                                happier with our new home and highly recommend their services!&rdquo;
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
                                &ldquo;Professional and dedicated agents. They took the time to understand our needs and
                                helped us
                                secure the perfect property. Their expertise and attention to detail made all the
                                difference. We had
                                an excellent experience from start to finish!&rdquo;
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
                                &ldquo;The process was smooth from start to finish. The team was always available to
                                answer our
                                questions and guide us through every step. Their knowledge and patience made buying our
                                first home a
                                stress-free experience. We are very satisfied with the service provided.&rdquo;
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
                                &ldquo;Exceptional knowledge and support. Our agent made buying a home easy and
                                stress-free. They were
                                always available to provide insights and advice, which made us feel confident in our
                                decisions. We’re
                                thrilled with our new place and grateful for their assistance!&rdquo;
                            </p>
                        </blockquote>
                        <p class="text-black-50">Buyer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section section-4 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-5">
                <h2 class="font-weight-bold heading text-primary mb-4">
                    Let's find home that's perfect for you
                </h2>
                <p class="text-black-50">
                    Discover personalized service and expert guidance with our extensive listings, ensuring you find a
                    place
                    that feels just right. Let's make your dream home a reality together.
                </p>
            </div>
        </div>
        <div class="row justify-content-between mb-5">
            <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
                <div class="img-about dots">
                    <img src="<?php echo URLROOT ?>/Estate/public/images/hero_bg_3.jpg" alt="Image" class="img-fluid" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-home2"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading">2M Properties</h3>
                        <p class="text-black-50">
                            Explore over 2M properties with us, find your perfect home today.
                        </p>
                    </div>
                </div>

                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-person"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading">Top Rated Agents</h3>
                        <p class="text-black-50">
                            Partner with top-rated agents for a stress-free home search.
                        </p>
                    </div>
                </div>

                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-security"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading">Legit Properties</h3>
                        <p class="text-black-50">
                            Discover legit listings and secure your dream home hassle-free.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row section-counter mt-5">
            <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">3298</span></span>
                    <span class="caption text-black-50">Bought Properties</span>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">2181</span></span>
                    <span class="caption text-black-50">Sold Properties</span>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">2203012</span></span>
                    <span class="caption text-black-50">Total Properties</span>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">160</span></span>
                    <span class="caption text-black-50">Agents</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="row justify-content-center footer-cta" data-aos="fade-up">
        <div class="col-lg-7 mx-auto text-center">
            <h2 class="mb-4">Be a part of our growing real state agents</h2>
            <p>
                <a class="btn btn-primary text-white py-3 px-4" onclick="myFunction()">Apply for Real Estate agent</a>
            </p>
        </div>
        <!-- /.col-lg-7 -->
    </div>
    <!-- /.row -->
</div>

<div class="section section-5 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-6 mb-5">
                <h2 class="font-weight-bold heading text-primary mb-4">
                    Our Agents
                </h2>
                <p class="text-black-50">
                    Welcome to Prime Estates! Our team of dedicated real estate
                    agents—James Doe, Jean Smith, and Alicia Huston—are here to assist
                    you with all your real estate needs. With years of experience and
                    extensive knowledge of the local market, we are committed to
                    providing exceptional service and personalized guidance. Whether
                    you're buying, or renting, our team is ready to help you achieve
                    your real estate goals. Let's make your real estate journey a
                    success!
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="h-100 person">
                    <img src="<?php echo URLROOT ?>/Estate/public/images/person_1-min.jpg" alt="Image"
                        class="img-fluid" />

                    <div class="person-contents">
                        <h2 class="mb-0"><a href="#">James Doe</a></h2>
                        <span class="meta d-block mb-3">Real Estate Agent</span>
                        <p>
                            Hello, I'm James Doe from Prime Estates. With over 10 years in
                            the industry, I'm here to help you find your dream home or
                            perfect investment property. Let's make your goals a reality!
                        </p>

                        <ul class="social list-unstyled list-inline dark-hover">
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-twitter"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-facebook"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-linkedin"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-instagram"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="h-100 person">
                    <img src="<?php echo URLROOT ?>/Estate/public/images/person_2-min.jpg" alt="Image"
                        class="img-fluid" />

                    <div class="person-contents">
                        <h2 class="mb-0"><a href="#">Jean Smith</a></h2>
                        <span class="meta d-block mb-3">Real Estate Agent</span>
                        <p>
                            Hi, I'm Jean Smith at Prime Estates. Growing up here, I know
                            the local market well. Whether you're buying, selling, or
                            renting, I'm committed to making your real estate journey
                            smooth and successful.
                        </p>

                        <ul class="social list-unstyled list-inline dark-hover">
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-twitter"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-facebook"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-linkedin"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-instagram"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="h-100 person">
                    <img src="<?php echo URLROOT ?>/Estate/public/images/person_3-min.jpg" alt="Image"
                        class="img-fluid" />

                    <div class="person-contents">
                        <h2 class="mb-0"><a href="#">Alicia Huston</a></h2>
                        <span class="meta d-block mb-3">Real Estate Agent</span>
                        <p>
                            Greetings, I'm Alicia Huston with Prime Estates. Specializing
                            in both residential and commercial properties, I offer unique
                            market insights and strategies. Let's work together to achieve
                            your real estate goals!
                        </p>

                        <ul class="social list-unstyled list-inline dark-hover">
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-twitter"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-facebook"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-linkedin"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"><span class="icon-instagram"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require APPROOT . '/views/include/footer.php';
?>