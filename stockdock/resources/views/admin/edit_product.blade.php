<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('admin.tags')
@include('admin.sidebar')
@include('admin.navbar')

<style>
.full-height {
    height: 60vh; /* Full viewport height */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center content vertically */
}

.custom-width {
    width: 100%;
}

.bg-light-rounded {
    background-color: #f8f9fa; /* Ensure this matches your design */
    border-radius: 0.5rem;
    padding: 2rem;
}

.fixed-textarea {
    resize: none; /* Prevent resizing */
    /* Optional: Set a fixed width */
    width: 100%; /* Adjust as needed */
}

</style>
<br>
<br>
<br>
<br>
<div class="full-height">
    <div class="col-10 custom-width">
        <div class="bg-light-rounded">
            <h6 class="mb-4">Edit Product Form</h6>
            <form id="editUserForm" action="{{ route('update_product',['id' => $product_edit->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="product_images" name="product_images[]" multiple placeholder="Product Images" required>
                    <label for="product_images">Product Images</label>
                </div>
                {{-- <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="product_video" name="product_video" accept="video/*" placeholder="Product Video">
                    <label for="product_video">Product Video (Optional)</label>
                </div> --}}
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" value="{{$product_edit->product_name}}" required>
                    <label for="product_name">Product Name</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control fixed-textarea" id="product_description" name="product_description" placeholder="Product Description" rows="3" required>{{ $product_edit->product_description }}</textarea>
                    <label for="product_description">Product Description</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Product Price" step="0.01" value="{{$product_edit->product_price}}"required>
                    <label for="product_price">Product Price</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="product_quantity" name="product_quantity" placeholder="Product Quantity" value="{{$product_edit->product_quantity}}" required>
                    <label for="product_quantity">Product Quantity</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')

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

    // SweetAlert for Edit User Form submission
    document.getElementById('editUserForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update this Product?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                this.submit();
            }
        });
    });
</script>
