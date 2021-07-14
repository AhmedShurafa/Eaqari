@extends("layouts.app")

@section("content")

@include("layouts._header")


@include("layouts._footer")


@endsection
@push('script')
        <script>
            $("#message").click(function () {
                var owner = $(this).data('owner');
                var apartment = $(this).data('apartment');
                var name = $("#name").va();
                console.log(name);
                $('#owner_id').val(owner);
                $('#apartment_id').val(apartment);
                $('#Name').val(name);
            });
        </script>
@endpush
