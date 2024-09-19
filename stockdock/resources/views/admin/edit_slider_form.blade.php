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
</style>

<div class="full-height">
    <div class="col-10 custom-width">
        <div class="bg-light-rounded">
            <h6 class="mb-4">Edit User Form</h6>
            <form id="editUserForm" action="{{ route('update_slider',['id' => $edit_slider->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
              
                <div class="form-floating mb-3">
                <input type="file" class="form-control" id="image" name="image" placeholder="Image">
                <label for="image">Image</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="description" name="description" placeholder="description" value="{{ $edit_slider->description }}">
                    <label for="description">Description</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ $edit_slider->title }}">
                    <label for="title">Title</label>
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
            text: "Do you want to update this user?",
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
