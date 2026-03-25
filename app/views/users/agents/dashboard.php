<?php
require APPROOT . '/views/include/header.php';
require APPROOT . '/views/include/viewNavbar.php';
?>
<style>
    .property-item img {
        width: 321px;
        height: 321px;
        object-fit: cover;

    }
</style>
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

<div class="section"></nav>

<div class="section">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="font-weight-bold text-primary heading">
                    All Properties
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
                    <a href="<?php echo URLROOT ?>/Estate/agent/properties" target="_blank"
                        class="btn btn-primary text-white py-3 px-4">View all properties</a>
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
<?php
require APPROOT . '/views/include/footer.php';
?>