@extends('backend.template')

@section('header')
    Type Produk
@endsection

@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <div id="success-alert" class="alert alert-success alert-dismissible" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        Data has been successfully saved.
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i
                            class="fa fa-plus"></i> CREATE</button>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal Create</h4>
                </div>
                <div class="modal-body">
                    <form id="form-data" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="" class="form-label">Name Type</label>
                            <input type="text" class="form-control" name="name" oninput="validateName()">
                        </div>
                        <span id="name-error" style="color: red;"></span>
                        <div class="mt-3" style="margin-top: 2rem">
                            <label for="" class="form-label">Logo Type (Optional)</label>
                            <input type="file" class="form-control-file" name="logo" oninput="validateLogo()">
                        </div>
                        <span id="logo-error" style="color: red;"></span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submit-form">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal Edit</h4>
                </div>
                <div class="modal-body">
                    <form id="form-edit-data" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Add method field for PUT request --}}
                        <input type="hidden" name="edit_id" id="edit_id">
                        <div class="mb-5">
                            <label for="" class="form-label">Name Type</label>
                            <input type="text" class="form-control" name="edit_name" oninput="validateName()">
                        </div>
                        <span id="edit_name-error" style="color: red;"></span>

                        <div class="mt-3" style="margin-top: 2rem">
                            <label for="" class="form-label">Logo Type (Optional)</label>
                            <input type="file" class="form-control-file" name="edit_logo" oninput="validateLogo()">
                        </div>
                        <span id="edit_logo-error" style="color: red;"></span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submit-edit-form">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteData(id) {
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    type: "DELETE",
                    url: "/type/delete/" + id,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response.message, "deleted");
                        $('#example1').DataTable().ajax.reload();
                    },
                    error: function(error) {
                        // Handle error
                    }
                });
            }
        }

        function validateName() {
            var name = $('input[name="name"]').val();

            if (name === "") {
                $('#name-error').text('Name is required');
                return false;
            } else if (name.length < 3) {
                $('#name-error').text('Name must be at least 3 characters long');
                return false;
            } else {
                $('#name-error').text(''); // Clear the error message
                return true;
            }
        }

        function validateLogo() {
            var logoInput = $('input[name="logo"]');
            var logo = logoInput[0].files[0];

            if (!logo) {
                $('#logo-error').text('Logo is required');
                return false;
            } else {
                $('#logo-error').text(''); // Clear the error message
            }

            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(logo.name)) {
                $('#logo-error').text('Invalid file format. Please upload a JPG or PNG image.');
                return false;
            } else {
                $('#logo-error').text(''); // Clear the error message
            }

            var maxSize = 2048; // Maximum file size in kilobytes
            if (logo.size > maxSize * 1024) {
                $('#logo-error').text('File size exceeds the maximum limit of 2048 KB.');
                return false;
            } else {
                $('#logo-error').text(''); // Clear the error message
            }

            // You can add more checks, such as image dimensions, if needed

            return true;
        }


        $(document).ready(function() {
            // Initialize DataTable without assigning it to a variable
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/type/get',
                    type: 'GET',
                },
                columns: [{
                        data: null,
                        name: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'logo',
                        name: 'logo',
                        render: function(data, type, full, meta) {
                            return '<img src="' + data + '" height="50" />';
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, full, meta) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<button class="btn btn-sm btn-primary btn-edit" data-toggle="modal" ' +
                                'data-target="#modal-edit" data-id="' + full.id +
                                '">Edit</button> ' +
                                '<button class="btn btn-sm btn-danger" onclick="deleteData(' + full
                                .id + ')">Delete</button>';
                        }
                    },
                ]
            });

            $(".submit-form").click(function() {
                if (validateName() && validateLogo()) {
                    var formData = new FormData($('#form-data')[0]);

                    $.ajax({
                        type: "POST",
                        url: "/type/create",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response.message, "sukses");
                            $('#modal-default').modal('hide');
                            $('#example1').DataTable().ajax.reload();
                            $('#success-alert').slideDown().delay(3000).slideUp();
                        },
                        error: function(error) {
                            console.error("Error:", error);
                        }
                    });
                }
            });

            // ...

            $('#example1').on('click', '.btn-edit', function() {
                var id = $(this).data('id');

                // Fetch data for the selected record
                $.ajax({
                    type: "GET",
                    url: "/type/show/" + id,
                    success: function(response) {
                        // Populate the edit modal with fetched data
                        $('#edit_id').val(response.id);
                        $('input[name="edit_name"]').val(response.name);
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    }
                });
            });

            $(".submit-edit-form").click(function() {
                var editFormData = new FormData($('#form-edit-data')[0]);

                $.ajax({
                    type: "POST",
                    url: "/type/update/" + $('#edit_id').val(),
                    data: editFormData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response.message, "sukses");
                        $('#modal-edit').modal('hide');
                        $('#example1').DataTable().ajax.reload();
                        $('#success-alert').slideDown().delay(3000).slideUp();
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    }
                });
            });

            function validateName() {
                var name = $('input[name="name"]').val();
                if (name === "") {
                    $('#name-error').text('Name is required');
                    return false;
                } else {
                    $('#name-error').text(''); // Clear the error message
                    return true;
                }
            }

            function validateLogo() {
                var logoInput = $('input[name="logo"]');
                var logo = logoInput[0].files[0];

                if (!logo) {
                    $('#logo-error').text('Logo is required');
                    return false;
                } else {
                    $('#logo-error').text(''); // Clear the error message
                }

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(logo.name)) {
                    $('#logo-error').text('Invalid file format. Please upload a JPG or PNG image.');
                    return false;
                } else {
                    $('#logo-error').text(''); // Clear the error message
                }

                var maxSize = 2048; // Maximum file size in kilobytes
                if (logo.size > maxSize * 1024) {
                    $('#logo-error').text('File size exceeds the maximum limit of 2048 KB.');
                    return false;
                } else {
                    $('#logo-error').text(''); // Clear the error message
                }

                return true;
            }
        });
    </script>
@endsection
