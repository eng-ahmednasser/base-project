@extends('admin.layouts.app', ['activePage' => 'ticket-management', 'titlePage' => __('Ticket management')])

@section('content')

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('admin.ticket.update' , $ticket->id) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Create ticket') }}</h4>
                    <p class="card-category">{{ __('ticket information') }}</p>
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
                                    id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name' , $ticket->name) }}"
                                    required="true" aria-required="true" />
                                @if ($errors->has('name'))
                                <span id="name-error" class="error text-danger"
                                    for="input-name">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                <textarea class=" form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                     maxlength="500" minlength="3"
                                     placeholder="{{ __('Description') }}"
                                     name="description"  required="true">{{ old('description',$ticket->description) }}</textarea>
                                @if ($errors->has('description'))
                                <span id="description-error" class="error text-danger"
                                    for="input-description">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Final date') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('finalDate') ? ' has-danger' : '' }}">
                                <input class="text-center form-control{{ $errors->has('finalDate') ? ' is-invalid' : '' }}" name="finalDate"
                                    id="input-finalDate" type="date" placeholder="{{ __('finalDate') }}" value="{{ old('finalDate',$ticket->dateline) }}"
                                    required="true" aria-required="true" />
                                @if ($errors->has('finalDate'))
                                <span id="finalDate-error" class="error text-danger"
                                    for="input-finalDate">{{ $errors->first('finalDate') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Users') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('user') ? ' has-danger' : '' }}">
                                {!! Form::select('user', $users, $ticket->assigned_to, ['class'=>'form-control '.($errors->has('user') ?
                                '
                                is-invalid' : ''),'id'=>'input-user' ,'placeholder'=>__('Select user') ]) !!}
                                @if ($errors->has('user'))
                                <span id="user-error" class="error text-danger" for="input-user">
                                    {{ $errors->first('user') }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Status') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                {!! Form::select('status', $status, $ticket->status, ['class'=>'form-control '.($errors->has('status') ?'is-invalid' : ''),'id'=>'input-status' ,'placeholder'=>__('Select status') ]) !!}
                                @if ($errors->has('status'))
                                <span id="status-error" class="error text-danger" for="input-status">
                                    {{ $errors->first('status') }}
                                </span>
                                @endif
                            </div>
                        </div>
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
