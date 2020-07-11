@extends('admin.layouts.app', ['activePage' => 'role-management', 'titlePage' => __('Role management')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Roles')}}</h4>
                        <p class="card-category"> {{__('Here you can manage roles')}}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('admin.role.create')}}" class="btn btn-sm btn-primary">
                                    {{__('Add Role')}}</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            {{__('Name')}}
                                        </th>
                                        <th>
                                            {{__('Number Users')}}
                                        </th>
                                        <th>
                                            {{__('Creation date')}}
                                        </th>
                                        <th class="text-right">
                                            {{__('Actions')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            {{$role->name}}
                                        </td>
                                        <td>
                                            {{count($role->users)}}
                                        </td>

                                        <td>
                                            {{$role->created_at}}
                                        </td>
                                        <td class="td-actions text-right">
                                            @if($role->name != "admin")
                                            @can('edit roles')
                                                <a rel="tooltip"
                                                class="btn btn-success btn-link"
                                                href="{{route('admin.role.edit',$role->id)}}">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                @endcan
                                                @can('delete roles')
                                                {{ Form::open(['method' => 'DELETE','class'=>'d-inline-block', 'route' => ['admin.role.destroy',$role->id], 'name' => 'delete']) }}
                                                <a rel="tooltip"
                                                class="btn btn-success btn-link xxx"
                                                href="#" onclick="deleteItem(this)">
                                                    <i class="material-icons">delete</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                {{ Form::close() }}
                                                @endcan
                                            @endif
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
    </div>
</div>
@endsection

<script>

   function deleteItem(e) {

    Swal.fire({
        title: '{{__('Do you want to continue?')}}',
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
