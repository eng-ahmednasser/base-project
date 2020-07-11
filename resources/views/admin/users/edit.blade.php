@extends('admin.layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Profile')])

@section('content')

      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('admin.user.update' , $user->id) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Update User') }}</h4>
                <p class="card-category">{{ __('User information') }}</p>
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
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name',$user->name) }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email',$user->email) }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Roles') }}</label>
                    <div class="col-sm-7">

                      <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                        {!! Form::select('role', $roles, optional($user->roles()->first())->id, ['class'=>'form-control '.($errors->has('role') ? ' is-invalid' : ''),'id'=>'input-role' ,'placeholder'=>__('Select Role') ]) !!}
                        @if ($errors->has('role'))
                            <span id="role-error" class="error text-danger" for="input-role">
                              {{ $errors->first('role') }}
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>
                {{-- <div class="row">
                    <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Password') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
                        @if ($errors->has('password'))
                          <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                      </div>
                    </div>
                  </div> --}}
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>

@endsection
