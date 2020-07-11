@extends('admin.layouts.app', ['activePage' => 'ticket-management', 'titlePage' => __('Ticket management')])

@section('content')

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('admin.ticket-owner.update' , $ticket->id) }}" autocomplete="off" class="form-horizontal">
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
                        <label class="col-sm-2 col-form-label">{{ __('Comment') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
                                <textarea class=" form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                                     maxlength="500" minlength="3"
                                     placeholder="{{ __('Comment') }}"
                                     name="comment"  required="true">{{ old('comment') }}</textarea>
                                @if ($errors->has('comment'))
                                <span id="comment-error" class="error text-danger"
                                    for="input-comment">{{ $errors->first('comment') }}</span>
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
