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
            <form id="editUserForm" action="{{ route('update_user',['id' => $edit_user->id]) }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $edit_user->name }}">
                    <label for="name">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ $edit_user->email }}">
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ $edit_user->password }}">
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="role" name="role" aria-label="Floating label select example">
                        <option value="admin" {{ $edit_user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $edit_user->role == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    <label for="role">Select Role</label>
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
