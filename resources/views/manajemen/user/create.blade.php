@extends('manajemen.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'class']) !!}
            @csrf
            <div class="card">
                <div class="card-header bg-light">
                    <div class="card-title float-md-start mt-2">
                        {{ $pageTitle }}
                    </div>
                    <div class="float-md-end">
                        {!! Form::button('<i class="bx bx-save label-icon"></i> simpan', [
                            'type' => 'submit',
                            'class' => 'btn btn-success waves-effect btn-label waves-light btn-sm-full-width',
                        ]) !!}
                    </div>
                </div>
                <div class="card-body">
                    @include('manajemen.user.form', ['edit' => false])
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
