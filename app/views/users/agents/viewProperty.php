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
<div class="hero page-inner overlay"
    style="background-image: url('<?php echo URLROOT ?>/Estate/public/images/hero_bg_1.jpg')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">View Properties</h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/Estate/agent/dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            View Properties
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="font-weight-bold text-primary heading">
                    Your Properties
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="property-slider-wrap">
                    <div class="property-slider">
                        <?php if (!empty($properties)): ?>
                            <?php foreach ($properties as $property): ?>
                                <div class="property-item">
                                    <a href="<?php echo URLROOT ?>/Estate/agent/properties/single?id=<?php echo $property['id'] ?>"
                                        class="img">
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

                                            <a href="<?php echo URLROOT ?>/Estate/agent/properties/single?id=<?php echo $property['id'] ?>"
                                                class="btn btn-primary py-2 px-3">See details</a>
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
if (isset($_GET['deleted']) && $_GET['deleted'] == 'success'): ?>
    <script>
        Swal.fire({
            title: 'Deleted!',
            text: 'The property has been deleted successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>
<?php
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status === 'success') {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Property Updated",
                text: "Your property has been updated successfully!",
                confirmButtonText: "OK"
            });
        </script>';
    } elseif ($status === 'error') {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "There was an error updating the property. Please try again.",
                confirmButtonText: "OK"
            });
        </script>';
    }
}