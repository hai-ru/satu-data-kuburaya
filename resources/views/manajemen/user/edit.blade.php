@extends('manajemen.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            {!! Form::open(['route' => ['users.update', $user], 'method' => 'POST']) !!}
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-header bg-light">
                    <div class="card-title float-md-start mt-2">
                        {{ $pageTitle }}
                    </div>
                    <div class="float-md-end">
                        {!! Form::button('<i class="bx bx-save label-icon"></i> ubah', [
                            'type' => 'submit',
                            'class' => 'btn btn-warning waves-effect btn-label waves-light btn-sm-full-width',
                        ]) !!}
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::hidden('user_id', $user->id) !!}
                    @include('manajemen.user.form', ['edit' => true])
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
