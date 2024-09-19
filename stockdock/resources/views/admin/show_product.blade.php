<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
    .custom-btn-spacing {
        margin-right: 5px; /* Adjust the value as needed */
    }
</style>

@include('admin.tags')
@include('admin.sidebar')
@include('admin.navbar')

<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <h6 class="mb-4">Product Table</h6>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example" style="width:200%">
                        <thead class="table-dark">
                            <tr> 
                                <th scope="col">#</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Description</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $show_product)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $show_product->id }}</td>
                                <td>{{ $show_product->product_name }}</td>
                                <td>{{ $show_product->product_description }}</td>
                                <td>{{ $show_product->product_price }}</td>
                                <td>{{ $show_product->product_quantity }}</td>
                                <td>
                                    @if(!empty($show_product->decoded_images))
                                        @foreach($show_product->decoded_images as $image)
                                            <a href="{{ asset('product_images/' . $image) }}" target="_blank">
                                                <img src="{{ asset('product_images/' . $image) }}" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;" />
                                            </a>
                                        @endforeach
                                    @else
                                        No Image Available
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="javascript:void(0);" class="btn btn-warning btn-sm custom-btn-spacing" onclick="confirmEdit('{{ url('/admin/edit_product_form', $show_product->id) }}')">Edit</a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm custom-btn-spacing" onclick="confirmDelete('{{ url('/admin/delete_product', $show_product->id) }}')">Delete</a> 
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')

<script>
    function confirmEdit(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to edit this Product!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, edit it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function confirmDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to delete this Product!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
