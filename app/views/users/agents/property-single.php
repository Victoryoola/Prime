<?php
require APPROOT . '/views/include/header.php';
require APPROOT . '/views/include/viewNavbar.php';
?>
<style>
    .img-property-slide {
        width: 100%;
        height: 70vh;
        object-fit: cover;
    }
</style>
<?php if (!empty($propertyDetails)): ?>
    <div class="hero page-inner overlay"
        style="background-image: url('<?php echo URLROOT ?>/Estate/public/images/hero_bg_3.jpg')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">
                        <?php echo $propertyDetails['propertyTitle'] ?>
                    </h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/Estate/agent/dashboard">Home</a></li>
                            <li class="breadcrumb-item">
                                <a href="<?php echo URLROOT ?>/Estate/agent/properties">View Properties</a>
                            </li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                <?php echo $propertyDetails['address'] ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <div class="img-property-slide-wrap">
                        <div class="img-property-slide">
                            <?php foreach ($propertyImages as $image): ?>
                                <img src="<?php echo URLROOT ?>/Estate/public/images/<?php echo $image ?>" alt="Image"
                                    class="img-fluid" />
                            <?php endforeach ?>
                        </div>
                    </div>
                    <a href="<?php echo URLROOT ?>/Estate/agent/properties/edit?id=<?php echo $propertyDetails['id']; ?>"
                        class="btn btn-success mt-3" style="margin-left:10rem">Edit</a>
                    <form action="<?php echo URLROOT ?>/Estate/agent/properties/delete" method="POST"
                        style="display:inline-block;" onsubmit="return confirmDelete();">
                        <input type="hidden" name="property_id" value="<?php echo $propertyDetails['id']; ?>">
                        <button type="submit" class="btn btn-danger mt-3" style="margin-left: 3rem">Delete</button>
                    </form>
                </div>
                <div class="col-lg-4">
                    <h2 class="heading text-primary">
                        <?php echo $propertyDetails['lga_name'] . ", " . $propertyDetails['state_name'] ?>
                    </h2>
                    <p class="meta"><?php echo $propertyDetails['address'] ?></p>
                    <h6 class="meta">NGN <?php echo number_format((int) $propertyDetails['price']) ?></h6>
                    <h6 class="meta">For <?php echo $propertyDetails['propertyStatus'] ?></h6>
                    <p class="meta"><?php echo $propertyDetails['description'] ?></p>

                    <div class="row">
                        <div class="col-lg-4">
                            <span class="d-block d-flex align-items-center me-3">
                                <span class="icon-bed me-2"></span>
                                <span class="caption">
                                    <?php echo $propertyDetails['bed_number'] ?>
                                    <?php echo $propertyDetails['bed_number'] > 1 ? 'beds' : 'bed'; ?>
                                </span>
                            </span>
                        </div>
                        <div class="col-lg-4">
                            <span class="d-block d-flex align-items-center">
                                <span class="icon-bath me-2"></span>
                                <span class="caption">
                                    <?php echo $propertyDetails['bath_number'] ?>
                                    <?php echo $propertyDetails['bath_number'] > 1 ? 'baths' : 'bath'; ?>
                                </span>
                            </span>
                        </div>
                        <div class="col-lg-4">
                            <span class="d-block d-flex align-items-center">
                                <i class="fa-solid fa-utensils" style="margin-left: 1rem;"></i>
                                <span class="caption" style="margin-left: 10px;">
                                    <?php echo $propertyDetails['kitchen_number'] ?>
                                    <?php echo $propertyDetails['kitchen_number'] > 1 ? 'kitchens' : 'kitchen'; ?>
                                </span>
                            </span>
                        </div>
                    </div>

                    <?php if (!empty($agentDetails)): ?>
                        <div class="d-block agent-box p-5">
                            <div class="text">
                                <h3 class="mb-2" style="margin-left: 4.5rem"><?php echo $_SESSION['agent_name'] ?></h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <span class="d-block d-flex align-items-center">
                                            <i class="fa-solid fa-phone"></i>
                                            <span class="caption"
                                                style="margin-left: 10px;"><?php echo $agentDetails['phone'] ?></span>
                                        </span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="d-block d-flex align-items-center">
                                            <i class="fa-solid fa-envelope"></i>
                                            <span class="caption"
                                                style="margin-left: 10px;"><?php echo $agentDetails['email'] ?></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this property?');
    }
</script>

<?php
require APPROOT . '/views/include/footer.php';
?>
