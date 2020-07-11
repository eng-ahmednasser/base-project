@extends('admin.layouts.app', ['activePage' => 'ticket-management', 'titlePage' => __('Ticket management')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Tickets')}}</h4>
                        <p class="card-category"> {{__('Here you can manage tickets')}}</p>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                <h5>{{__('Start Date')}}
                                    <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="date" name="start_date" id="start_date" class="text-center form-control datepicker-autoclose" placeholder="Please select start date"> <div class="help-block"></div></div>
                                </div>
                                <div class="form-group col-md-5">
                                <h5>{{__('End Date')}} <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="date" name="end_date" id="end_date" class="text-center form-control datepicker-autoclose" placeholder="Please select end date"> <div class="help-block"></div></div>
                                </div>
                                <div class="form-group col-md-2 " >
                                <button type="text" id="btnFiterSubmitSearch" class="mt-4 btn btn-info">{{__('Filter')}}</button>
                                </div>
                            </div>
                        </div>
                        <br>
                            <div class="table-responsive">

                            {{-- {!! $dataTable->table() !!} --}}

                            <table class="table table-bordered" id="tickets-table">
                                <thead>
                                    <tr>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Final date')}}</th>
                                        <th>{{__('Creator')}}</th>
                                        <th>{{__('Actions')}}</th>
                                    </tr>
                                </thead>
                              </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection



@push('js')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>

{{-- {{$dataTable->scripts()}} --}}



<script>
     $('#tickets-table').DataTable({
        searching: false,
        processing: true,
        serverSide: true,
        ajax: {
            data : function (d) {
          d.start_date = $('#start_date').val();
          d.end_date = $('#end_date').val();
          }
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            {data: 'dateline', name: 'dateline'},
            {data: 'creator', name: 'creator'},
            {data: 'actions', name: 'actions', orderable: false}

        ]
    });
    $('#btnFiterSubmitSearch').click(function(){
       $('#tickets-table').DataTable().draw(true);
    });
    function deleteItem(e) {

        Swal.fire({
            title: '{{__('Do you want to continue ?')}}',
            icon: 'question',
            iconHtml: '؟',
            confirmButtonText: '{{__('Yes')}}',
            cancelButtonText: '{{__('No')}}',
            showCancelButton: true,
            showCloseButton: true
        }).then((result) => {
            if (result.value) {
                e.parentNode.submit();
            }
        });
    };

</script>
@endpush
