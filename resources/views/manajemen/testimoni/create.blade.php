@extends('manajemen.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => 'testimoni.store', 'method' => 'POST']) !!}
            @csrf
            <div class="row mb-4">
                <div class="col-12 text-end">
                    {!! Form::button('<i class="bx bx-save label-icon"></i> simpan', [
                        'type' => 'submit',
                        'class' => 'btn btn-success waves-effect btn-label waves-light',
                    ]) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @include('manajemen.testimoni.form', ['edit' => false])
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
