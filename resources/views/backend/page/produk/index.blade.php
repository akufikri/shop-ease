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
                        <button class="btn btn-primary"><i class="fa fa-plus"></i> CREATE</button>
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

    <script>
        $(function() {
            // Click event for the redirect button
            $('#redirectButton').on('click', function() {
                // Use replace() instead of href to redirect without adding to the browser history
                window.location.replace('/type');
            });
        });
    </script>
@endsection
