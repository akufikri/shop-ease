@extends('backend.template')

@section('header')
    Produk
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
                    <div style="display: flex; justify-content: space-between">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i
                                class="fa fa-plus"></i> CREATE</button>
                        <button id="redirectButton" class="btn btn-success"><i class="fa fa-plus"></i> Add Type</button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 14px">No</th>
                                <th>Prod Name</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Photo Prod</th>
                                <th>Expired</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal Create</h4>
                </div>
                <div class="modal-body">
                    <form id="form-data" enctype="multipart/form-data">
                        @csrf
                        <div class="row margin-bottom">
                            <div class="col-md-6">
                                <label for="" class="form-label">Produk Name</label>
                                <input type="text" class="form-control" name="produk_name">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-control select2" style="width: 100%; height: 500px;">
                                    <option selected="selected">Select Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row margin-bottom">
                            <div class="col-md-6">
                                <label for="" class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" name="harga">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok">
                            </div>
                        </div>
                        <hr>
                        <div class="row margin-bottom">
                            <div class="col-md-4">
                                <label for="" class="form-label">Expired (Optional)</label>
                                <input type="date" class="form-control" name="expired">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Photo</label>
                                <input type="file" class="form-control-file" name="photo_produk">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Kategori</label>
                                <select name="type_id" class="form-control select2" style="width: 100%; height: 500px;">
                                    <option selected="selected">Select Kategori</option>
                                    @foreach ($type as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-label">Deskripsi</label>
                                <textarea style="resize: none" name="deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submit-form">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Product</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row margin-bottom">
                            <div class="col-md-6">
                                <label for="" class="form-label">Produk Name</label>
                                <input type="text" class="form-control" name="produk_name">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-control select2"
                                    style="width: 100%; height: 500px;">
                                    <option selected="selected">Select Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row margin-bottom">
                            <div class="col-md-6">
                                <label for="" class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" name="harga">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok">
                            </div>
                        </div>
                        <hr>
                        <div class="row margin-bottom">
                            <div class="col-md-4">
                                <label for="" class="form-label">Expired (Optional)</label>
                                <input type="date" class="form-control" name="expired">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Photo</label>
                                <input type="file" class="form-control-file" name="photo_produk">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Kategori</label>
                                <select name="type_id" class="form-control select2" style="width: 100%; height: 500px;">
                                    <option selected="selected">Select Kategori</option>
                                    @foreach ($type as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-label">Deskripsi</label>
                                <textarea style="resize: none" name="deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var produkId;

        function deleteData(id) {
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    type: "DELETE",
                    url: '/produk/delete/' + id,
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
        $(function() {
            var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/produk/get',
                    type: 'GET'
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
                        data: 'produk_name',
                        name: 'produk_name'
                    },
                    {
                        data: 'kategori.name',
                        name: 'kategori.name'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        render: function(data, type, full, meta) {
                            var limitedDescription = data.split(/\s+/).slice(0, 10).join(' ');

                            if (data.split(/\s+/).length > 10) {
                                limitedDescription += '...';
                            }

                            return limitedDescription;
                        }
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'photo_produk',
                        name: 'photo_produk',
                        render: function(data, type, full, meta) {
                            return '<img src="{{ asset('ImageProduk') }}/' + data +
                                '" height="50" />';
                        }
                    },
                    {
                        data: 'expired',
                        name: 'expired'
                    },
                    {
                        data: 'type.name',
                        name: 'type.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function(data, type, full, meta) {
                            return '<button class="btn btn-sm btn-primary btn-edit" data-id="' +
                                full.id + '">Edit</button> ' +
                                '<button class="btn btn-sm btn-danger" onclick="deleteData(' + full
                                .id + ')">Delete</button>';
                        }
                    }
                ],
                language: {
                    emptyTable: "No data available in the table",
                    zeroRecords: "No matching records found",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    infoFiltered: "(filtered from _MAX_ total records)"
                }
            });

            function handleEditButtonClick() {
                var data = table.row($(this).parents('tr')).data();
                produkId = data.id;
                $.ajax({
                    url: '/produk/show/' + data.id,
                    type: 'GET',
                    success: function(response) {
                        var produk = response.produk;

                        $('#edit-form [name="produk_name"]').val(produk.produk_name);
                        $('#edit-form [name="kategori_id"]').val(produk.kategori_id).trigger('change');
                        $('#edit-form [name="deskripsi"]').val(produk.deskripsi);
                        $('#edit-form [name="harga"]').val(produk.harga);
                        $('#edit-form [name="stok"]').val(produk.stok);
                        $('#edit-form [name="expired"]').val(produk.expired);
                        $('#edit-form [name="type_id"]').val(produk.type_id).trigger('change');
                        $('#edit-form [name="custom_field"]').val(produk.custom_field);
                        $('#edit-form [name="related_field"]').val(produk.related_field);

                        $('#edit-modal').modal('show');
                    },
                    error: function(error) {
                        // Handle error
                    }
                });
            }
            $('#example1 tbody').on('click', 'button.btn-primary', handleEditButtonClick);

            $('#edit-form').submit(function(e) {
                e.preventDefault();

                // Assuming you have a variable 'produkId' storing the ID
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: '/produk/update/' + produkId, // Change with the correct URL
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response.message, "sukses");
                        $('#edit-modal').modal('hide');
                        $('#example1').DataTable().ajax.reload(); // Reload the DataTable
                    },
                    error: function(error) {
                        console.error("Error:", error);
                        // Handle error messages or display them to the user
                    }
                });
            });

            $('#redirectButton').on('click', function() {
                window.location.replace('/type');
            });
            $('#redirectButton').on('click', function() {
                window.location.replace('/type');
            });

            $(".submit-form").click(function() {
                var formData = new FormData($('#form-data')[0]);

                $.ajax({
                    type: "POST",
                    url: '/produk/store', // Adjust the URL based on your route
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.message, "sukses");
                        $('#modal-default').modal('hide');
                        $('#example1').DataTable().ajax.reload();
                        $('#success-alert').slideDown().delay(3000).slideUp();
                    },
                    error: function(error) {
                        console.error("Error:", error);
                        // Handle error messages or display them to the user
                    }
                });
            });
        });
    </script>
@endsection
