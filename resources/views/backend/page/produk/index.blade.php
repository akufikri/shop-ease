@extends('backend.template')

@section('header')
    Produk
@endsection

@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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
                <div class="box-body">
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
                        {{-- <div class="mb-5">
                            <label for="" class="form-label">Produk Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <span id="name-error" style="color: red;"></span>
                        <div class="mt-3" style="margin-top: 2rem">
                            <label for="" class="form-label">Logo Type (Optional)</label>
                            <input type="file" class="form-control-file" name="logo">
                        </div>
                        <span id="logo-error" style="color: red;"></span> --}}
                        <div class="row margin-bottom">
                            <div class="col-md-6">
                                <label for="" class="form-label">Produk Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Kategori</label>
                                <select class="form-control select2" style="width: 100%; height: 500px;">
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
                                <select class="form-control select2" style="width: 100%; height: 500px;">
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
                                <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
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
    <script>
        $(function() {
            $('#example1').DataTable({
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
                        name: 'deskripsi'
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
                            return '<img src="' + data + '" height="50" />';
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
                            return '<button class="btn btn-sm btn-primary">Edit</button> ' +
                                '<button class="btn btn-sm btn-danger">Delete</button>';
                        }
                    }
                ]
            });

            $('#redirectButton').on('click', function() {
                window.location.replace('/type');
            });
        });
    </script>
@endsection
