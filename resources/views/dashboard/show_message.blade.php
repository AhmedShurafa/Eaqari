@extends("dashboard.app")

@section("content")


    <!-- Begin Page Content -->
    <div class="container">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">الرسائل</h1>
        </div>
{{--{{dd($message->apartment_id)}}--}}
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group">
                        <label for="property_name" class="col-form-label">Property:</label>
                        <a href="{{route('dashboard.apartment.show',$message->apartment_id)}}
                            ">الذهاب إلى المنشأة</a>
                        <input type="text" name="owner_id" class="form-control"
                               value="{{$message->apartment->Property->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Owner:</label>
                        <input type="text" name="name" class="form-control" value="{{$message->owner->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{$message->customer->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{$message->customer->email}}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Phone:</label>
                        <input type="number" name="phone" class="form-control" value="{{$message->customer->phone}}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Ssn:</label>
                        <input type="number" name="ssn" class="form-control" value="{{$message->customer->ssn}}" required>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-form-label">Message:</label>
                        <textarea name="description" class="form-control" required>{{$message->description}}</textarea>
                    </div>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->


    <!-- show Modal-->
    @include('dashboard.delete')
@endsection

@push('script')
    <script>

        $(".delete").click(function () {
            var id = $(this).data('row');
            $('.modal_delete').attr('action',id);
        });
    </script>
@endpush
