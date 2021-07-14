@extends("dashboard.app")

@section("content")


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            {{-- <h1 class="h3 mb-4 text-gray-800 d-inline-block">الرسائل</h1> --}}
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">العمليات التجارية</h1>
            <a href="{{route('dashboard.transaction.create')}}" class="btn btn-primary float-left">
                <i class="fa fa-plus"></i>
                إضافة معاملة جديدة
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>المستثمر</th>
                            <th>العقار</th>
                            <th>اسم الزبون</th>
                            <th>رقم جوال الزبون</th>
                            <th>التفاصيل</th>
                            <th>الحدث</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>المستثمر</th>
                            <th>العقار</th>
                            <th>اسم الزبون</th>
                            <th>رقم جوال الزبون</th>
                            <th>التفاصيل</th>
                            <th>الحدث</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($transactions as $index=>$transaction)
                            <tr>
                                <td>{{$index+1}}</td>

                                <td>{{$transaction->owner->name}}</td>
                                <td>
                                   {{$transaction->apartment->Property->name}}
                                </td>
                                <td>{{$transaction->customer->name}}</td>
                                <td>{{$transaction->customer->phone}}</td>
                                <td>{{ Str::limit ($transaction->details , 30 ,'...') }}</td>
                                <td>
                                    <a href="{{route("dashboard.transaction.edit",$transaction->id)}}"
                                       class="btn btn-secondary text-white shadow">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger text-white shadow delete"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("dashboard.transaction.destroy",$transaction->id)}}'>
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
