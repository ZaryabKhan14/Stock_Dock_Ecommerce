<!-- Add SweetAlert2 via CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('admin.tags')
@include('admin.sidebar')
@include('admin.navbar')

<style>
/* Ensure the full-height div centers the form vertically */
.full-height {
    min-height: 60vh; /* Adjusted to min-height to ensure better responsiveness */
    display: flex;
    align-items: center; /* Center content vertically */
    justify-content: center; /* Center content horizontally */
}

.custom-width {
    width: 100%;
    max-width: 800px; /* Maximum width for better layout on large screens */
}

.bg-light-rounded {
    background-color: #f8f9fa; /* Ensure this matches your design */
    border-radius: 0.5rem;
    padding: 2rem;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional: Add subtle shadow */
}

.form-floating label {
    font-size: 0.9rem; /* Adjust label font size */
}

.form-control {
    border-radius: 0.3rem; /* Rounded corners for input fields */
}

.color-field {
    margin-bottom: 1rem; /* Space between color input fields */
}

.btn-add-color {
    display: block;
    margin-top: 1rem;
}
</style>

<div class="full-height">
    <div class="col-12 custom-width">
        <div class="bg-light-rounded">
            <h6 class="mb-4">Add Product Form</h6>
            <form id="addProductForm" action="{{ route('add_product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="product_images" name="product_images[]" multiple placeholder="Product Images" required>
                    <label for="product_images">Product Images</label>
                </div>
                {{-- Uncomment if you need video upload --}}
                {{-- <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="product_video" name="product_video" accept="video/*" placeholder="Product Video">
                    <label for="product_video">Product Video (Optional)</label>
                </div> --}}
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required>
                    <label for="product_name">Product Name</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="product_description" name="product_description" placeholder="Product Description" rows="3" required></textarea>
                    <label for="product_description">Product Description</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Product Price" step="0.01" required>
                    <label for="product_price">Product Price</label>
                </div>

                <!-- Dynamic Color Input Fields -->
                <div id="colorFields">
                    <div class="form-floating mb-3 color-field">
                        <input type="text" class="form-control" name="product_colour[]" placeholder="Color" required>
                        <label for="product_colour">Color</label>
                    </div>
                </div>
                <button type="button" id="addColorField" class="btn btn-secondary btn-add-color">Add Another Color</button>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="product_quantity" name="product_quantity" placeholder="Product Quantity" required>
                    <label for="product_quantity">Product Quantity</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
// Check for success message from session
@if(session('success'))
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
@endif

// Check for error messages from validation     
@if($errors->any())
    Swal.fire({
        title: 'Error!',
        text: '{{ $errors->first() }}', // Display the first error message
        icon: 'error',
        confirmButtonText: 'OK'
    });
@endif

document.getElementById('addProductForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to add this product?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, add it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, submit the form
            this.submit();
        }
    });
});

// Add color input fields dynamically
document.getElementById('addColorField').addEventListener('click', function() {
    const colorFieldsContainer = document.getElementById('colorFields');
    const newField = document.createElement('div');
    newField.classList.add('form-floating', 'mb-3', 'color-field');
    newField.innerHTML = `
        <input type="text" class="form-control" name="product_colour[]" placeholder="Color" required>
        <label for="product_colour">Color</label>
    `;
    colorFieldsContainer.appendChild(newField);
});
</script>

@include('admin.footer')