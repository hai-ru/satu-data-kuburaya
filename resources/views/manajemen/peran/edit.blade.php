@extends('manajemen.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => ['roles.update', $role], 'method' => 'POST']) !!}
            @method('PUT')
            @csrf
            <div class="row mb-4">
                <div class="col-12 text-end">
                    {!! Form::button('<i class="bx bx-save label-icon"></i> ubah', [
                        'type' => 'submit',
                        'class' => 'btn btn-warning waves-effect btn-label waves-light',
                    ]) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger fade show" role="alert">
                            <h5>Terjadi Kesalahan</h5>
                            @foreach ($errors->all() as $error)
                                <p class="mb-2">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    {!! Form::hidden('role_id', $role->id) !!}
                    @include('manajemen.peran.form', ['edit' => true])
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
