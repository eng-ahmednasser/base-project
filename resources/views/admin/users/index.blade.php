@extends('admin.layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Profile')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Users')}}</h4>
                        <p class="card-category"> {{__('Here you can manage users')}}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('admin.user.create')}}" class="btn btn-sm btn-primary">
                                    {{__('Add user')}}</a>
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
                                            {{__('Email')}}
                                        </th>
                                        <th>
                                            {{__('Roles')}}
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
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            {{-- @dump($user->roles) --}}
                                            {{implode(',',$user->getRoleNames()->toArray())}}
                                        </td>

                                        <td>
                                            {{$user->created_at}}
                                        </td>
                                        <td class="td-actions text-right">
                                            @if(!$user->isSuperAdmin)
                                                @can('edit users')
                                                <a rel="tooltip"
                                                class="btn btn-success btn-link"
                                                href="{{route('admin.user.edit',$user->id)}}">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                @endcan
                                                @can('delete users')
                                                {{ Form::open(['method' => 'DELETE','class'=>'d-inline-block', 'route' => ['admin.user.destroy',$user->id], 'name' => 'delete']) }}
                                                <a rel="tooltip"
                                                class="btn btn-success btn-link xxx"
                                                href="#" onclick="deleteUser(this)">
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

   function deleteUser(e) {

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
