@extends('frontend.template')
@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <section>
        <div class="grid grid-cols-3 gap-4 w-full">
            <div class="border-2 h-24 rounded-md"></div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            getProduct()
        })

        function getProduct() {
            $.ajax({
                type: "GET",
                url: "/produk/get",
                success: function(response) {
                    console.log(response)
                }
            });
        }
    </script>
@endsection
