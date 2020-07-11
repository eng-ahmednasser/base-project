@extends('admin.layouts.app', ['activePage' => 'role-management', 'titlePage' => __('Role management')])

@section('content')

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('admin.role.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Create role') }}</h4>
                    <p class="card-category">{{ __('role information') }}</p>
                </div>
                <div class="card-body ">
                    @if (session('status'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">{{__('close')}}</i>
                                </button>
                                <span>{{ session('status') }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                    id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name') }}"
                                    required="true" aria-required="true" />
                                @if ($errors->has('name'))
                                <span id="name-error" class="error text-danger"
                                    for="input-name">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3>
                        <i class="material-icons">rule</i>
                        {{__('Select permissions')}}
                        @if ($errors->has('permissions'))
                        <span class="error text-danger">
                            {{ $errors->first('permissions') }}
                        </span>
                        @endif
                    </h3>
                    <div class="row">


                        @foreach ($permissions as $permission)
                        <div class=" form-check-inline col-3">
                            <label class="form-control form-check-label">
                                <input type="checkbox"
                                    class=" form-check-input {{ $errors->has('permissions.*') ? ' is-invalid' : '' }}"
                                    name="permissions[]" value="{{$permission->id}}">
                                {{$permission->name}}
                            </label>
                            @if ($errors->has('permissions.*'))
                            <span class="error text-danger">
                                {{ $errors->first('permissions.*') }}
                            </span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
