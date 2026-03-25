<?php
require APPROOT . '/views/include/header.php';
require APPROOT . '/views/include/viewNavbar.php';
?>
<div class="hero page-inner overlay"
    style="background-image: url('<?php echo URLROOT ?>/Estate/public/images/hero_bg_1.jpg')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">Create New Properties</h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/Estate/agent/dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            Create Property
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm col-md col-lg col-xl col-xxl" data-aos="fade-up" data-aos-delay="200">
                <form action="<?php echo URLROOT ?>/Estate/agent/properties" method="POST"
                    enctype="multipart/form-data">
                    <label for="" class="mb-3">Upload Property Images</label>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="">Image 1</label>
                            <input type="file" class="form-control" name="image1">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Image 2</label>
                            <input type="file" class="form-control" name="image2">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="">Image 3</label>
                            <input type="file" class="form-control" name="image3">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Image 4</label>
                            <input type="file" class="form-control" name="image4">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="propertyTitle">Property Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>

                        <div class="col-4 mb-3">
                            <label for="">Price</label>
                            <input type="text" name="price" value="NGN" class="form-control" id="priceInput">
                        </div>

                        <div class="col-4 mb-3">
                            <label for="">Property Status</label>
                            <select class="form-control" name="propertyStatus">
                                <option>Select...</option>
                                <option value="sale">Sale</option>
                                <option value="rent">Rent</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="state">State</label>
                            <select class="form-control" name="state" id="stateID">
                                <option value="">Select...</option>
                                <?php foreach ($states as $state): ?>
                                    <option value="<?php echo $state['id']; ?>">
                                        <?php echo htmlspecialchars($state['stateName']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="lga">L.G.A</label>
                            <select class="form-control" name="lga" id="lgas">
                                <option value="">Select...</option>
                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="address">Address</label>
                            <input class="form-control" type="text" name="address">
                        </div>
                    </div>
                    <div class="row">
                        <label for="">Select number of</label>
                        <div class="col-4 mb-3">
                            <label for="kitchen">Kitchen</label>
                            <select class="form-control" name="kitchenNumber">
                                <option>Select...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="bathrooms">Bathrooms</label>
                            <select class="form-control" name="bathNumber">
                                <option>Select...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="bedrooms">Bedrooms</label>
                            <select class="form-control" name="bedNumber">
                                <option>Select...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <textarea name="propertyDescription" cols="10" rows="5" class="form-control"
                                placeholder="Property Description"></textarea>
                        </div>
                        <div class="col-12">
                            <input type="submit" value="Create Property" class="btn btn-primary mb-5" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require APPROOT . '/views/include/footer.php';
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#stateID').change(function () {
            var stateId = $(this).val();

            if (stateId) {
                $.ajax({
                    url: '<?php echo URLROOT ?>/Estate/ajax/lgas',
                    type: 'POST',
                    dataType: 'json',
                    data: { stateId: stateId },
                    success: function (lgaList) {
                        const lgaSelect = $('#lgas');
                        lgaSelect.empty().append('<option value="">Select...</option>');
                        lgaList.forEach(function (lga) {
                            lgaSelect.append('<option value="' + lga.id + '">' + lga.lga + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ' + status + error);
                    }
                });
            } else {
                $('#lgas').empty().append('<option value="">Select...</option>');
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const priceInput = document.getElementById('priceInput');

        // Set the initial cursor position after "NGN "
        priceInput.setSelectionRange(4, 4);

        priceInput.addEventListener('keydown', function (e) {
            // Prevent backspace, delete, and arrow keys from affecting "NGN "
            if ((e.key === 'Backspace' && priceInput.selectionStart <= 4) ||
                (e.key === 'Delete' && priceInput.selectionStart < 5) ||
                (e.key === 'ArrowLeft' && priceInput.selectionStart <= 4) ||
                (e.key === 'ArrowRight' && priceInput.selectionStart < 4)) {
                e.preventDefault();
            }
        });

        priceInput.addEventListener('input', function () {
            // Ensure "NGN " is always at the beginning
            if (!priceInput.value.startsWith('NGN ')) {
                priceInput.value = 'NGN ';
            }
        });

        priceInput.addEventListener('click', function () {
            // Ensure the cursor doesn't move before "NGN "
            if (priceInput.selectionStart < 4) {
                priceInput.setSelectionRange(4, 4);
            }
        });
    });

</script>
<?php
// Checking for success or error messages from the controller
if (isset($_GET['success'])) {
    $successMessage = urldecode($_GET['success']);
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '$successMessage',
                confirmButtonText: 'OK'
            });
          </script>";
}

if (isset($_GET['error'])) {
    $errorMessage = urldecode($_GET['error']);
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '$errorMessage',
                confirmButtonText: 'OK'
            });
          </script>";
}
?>