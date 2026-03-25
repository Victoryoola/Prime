<?php
require APPROOT . '/views/include/header.php';
require APPROOT . '/views/include/viewNavbar.php';
$id = $propertyDetails['id'] ?? '';
$title = htmlspecialchars($propertyDetails['propertyTitle'] ?? '');
$price = htmlspecialchars($propertyDetails['price'] ?? '');
$status = htmlspecialchars($propertyDetails['propertyStatus'] ?? '');
$stateName = htmlspecialchars($propertyDetails['state_name'] ?? '');
$lgaID = htmlspecialchars($propertyDetails['lga_id'] ?? '');
$lgaName = htmlspecialchars($propertyDetails['lga_name'] ?? '');
$address = htmlspecialchars($propertyDetails['address'] ?? '');
$kitchenNumber = htmlspecialchars($propertyDetails['kitchen_number'] ?? '');
$bathNumber = htmlspecialchars($propertyDetails['bath_number'] ?? '');
$bedNumber = htmlspecialchars($propertyDetails['bed_number'] ?? '');
$description = htmlspecialchars($propertyDetails['description'] ?? '');
?>
<div class="hero page-inner overlay"
    style="background-image: url('<?php echo URLROOT ?>/Estate/public/images/hero_bg_1.jpg')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">Edit Property</h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/Estate/agent/dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            Edit Property
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
                <form action="<?php echo URLROOT ?>/Estate/agent/properties/update" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="property_id" value="<?php echo $id; ?>">

                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="propertyTitle">Property Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $title ?>">
                        </div>

                        <div class="col-4 mb-3">
                            <label for="">Price</label>
                            <input type="text" name="price" value="NGN <?php echo $price ?>" class="form-control"
                                id="priceInput">
                        </div>

                        <div class="col-4 mb-3">
                            <label for="">Property Status</label>
                            <select class="form-control" name="propertyStatus">
                                <option>Select...</option>
                                <option value="sale" <?php echo ($status == 'sale') ? 'selected' : ''; ?>>Sale</option>
                                <option value="rent" <?php echo ($status == 'rent') ? 'selected' : ''; ?>>Rent</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="state">State</label>
                            <select class="form-control" name="state" id="stateID">
                                <option value="">Select...</option>
                                <?php foreach ($states as $state): ?>
                                    <option value="<?php echo $state['id']; ?>" <?php echo ($stateName == $state['stateName']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($state['stateName']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="lga">L.G.A</label>
                            <select class="form-control" name="lga" id="lgas">
                                <option value="">Select...</option>
                                <?php if ($lgaName): ?>
                                    <option value="<?php echo $lgaID; ?>" selected><?php echo $lgaName; ?></option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="address">Address</label>
                            <input class="form-control" type="text" name="address" value="<?php echo $address; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label for="">Select number of</label>
                        <div class="col-4 mb-3">
                            <label for="kitchen">Kitchen</label>
                            <select class="form-control" name="kitchenNumber">
                                <option>Select...</option>
                                <option value="1" <?php echo ($kitchenNumber == '1') ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($kitchenNumber == '2') ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($kitchenNumber == '3') ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo ($kitchenNumber == '4') ? 'selected' : ''; ?>>4</option>
                                <option value="5" <?php echo ($kitchenNumber == '5') ? 'selected' : ''; ?>>5</option>
                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="bathrooms">Bathrooms</label>
                            <select class="form-control" name="bathNumber">
                                <option>Select...</option>
                                <option value="1" <?php echo ($bathNumber == '1') ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($bathNumber == '2') ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($bathNumber == '3') ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo ($bathNumber == '4') ? 'selected' : ''; ?>>4</option>
                                <option value="5" <?php echo ($bathNumber == '5') ? 'selected' : ''; ?>>5</option>
                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="bedrooms">Bedrooms</label>
                            <select class="form-control" name="bedNumber">
                                <option>Select...</option>
                                <option value="1" <?php echo ($bedNumber == '1') ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($bedNumber == '2') ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($bedNumber == '3') ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo ($bedNumber == '4') ? 'selected' : ''; ?>>4</option>
                                <option value="5" <?php echo ($bedNumber == '5') ? 'selected' : ''; ?>>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <textarea name="propertyDescription" cols="10" rows="5" class="form-control"
                                placeholder="Property Description"><?php echo $description; ?></textarea>
                        </div>
                        <div class="col-12">
                            <input type="submit" value="Update Property" class="btn btn-primary mb-5" />
                            <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal"
                                data-bs-target="#newImageModal">
                                Add Image
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <h5 class="text-center">Images for
                <?php echo $title ?>
            </h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Image Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <tr>
                            <?php foreach ($propertyImages as $image): ?>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $image["file_url"] ?></td>
                                <td>
                                    <button type="button" class="btn btn-success"
                                        data-image-id="<?php echo $image['image_id']; ?>" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        Update
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        data-image-id="<?php echo $image['image_id']; ?>" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Property Image</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?php echo URLROOT ?>/Estate/agent/images/update"
                            method="POST" enctype="multipart/form-data">
                            <input type="file" name="image">
                            <input type="hidden" value="<?php echo $image["image_id"] ?>" name="imageID">
                            <input type="hidden" value="<?php echo $id; ?>" name="propertyID">
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="newImageModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Image</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?php echo URLROOT ?>/Estate/agent/images/add" method="POST"
                            enctype="multipart/form-data">
                            <input type="file" name="image">
                            <input type="hidden" value="<?php echo $id; ?>" name="propertyID">
                            <button type="submit" class="btn btn-success">Add</button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Property Image</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?php echo URLROOT ?>/Estate/agent/images/delete"
                            method="POST" enctype="multipart/form-data">
                            <b class="text-dark">Are you sure you want to delete this image?</b>

                            <input type="hidden" value="<?php echo $imageID ?>" name="imageID">
                            <input type="hidden" value="<?php echo $id; ?>" name="propertyID">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require APPROOT . '/views/include/footer.php';
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var imageID = button.data('image-id'); // Extract image ID from data-* attribute

        // Update modal form action with the correct image ID
        $(this).find('input[name="imageID"]').val(imageID);
    });
</script>
<script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var imageID = button.data('image-id'); // Extract image ID from data-* attribute

        // Update modal form action with the correct image ID
        $(this).find('input[name="imageID"]').val(imageID);
    });
</script>
<script>


    $(document).ready(function () {
        var currentLGA = "<?php echo $lgaName; ?>"; // Store the current LGA

        $('#stateID').change(function () {
            var stateId = $(this).val(); // Get selected state ID

            if (stateId) {
                $.ajax({
                    url: '<?php echo URLROOT ?>/Estate/ajax/lgas',
                    type: 'POST',
                    data: { stateId: stateId },  // Send the JS variable to PHP
                    success: function (response) {
                        console.log('Server response:', response);

                        // Parse JSON response
                        const lgaList = JSON.parse(response);

                        // Ensure lgaList is an array
                        if (Array.isArray(lgaList)) {
                            const lgaSelect = $('#lgas');
                            lgaSelect.empty(); // Clear previous options
                            lgaSelect.append('<option value="">Select...</option>'); // Add default option

                            // Append new options and select the current LGA if it matches
                            lgaList.forEach(function (lga) {
                                let selected = (lga.lga === currentLGA) ? 'selected' : '';
                                lgaSelect.append('<option value="' + lga.id + '" ' + selected + '>' + lga.lga + '</option>');
                            });
                        } else {
                            console.error('Expected an array, but received:', lgaList);
                        }
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
<script>
    // Function to get URL query parameters
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Check if status and message are available in the URL
    const status = getQueryParam('status');
    const message = getQueryParam('message');

    // Display the SweetAlert based on the status
    if (status === 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: decodeURIComponent(message), // Decode the URL-encoded message
        });
    } else if (status === 'error') {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: decodeURIComponent(message),
        });
    }
</script>