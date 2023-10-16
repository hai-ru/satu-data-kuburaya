@extends('manajemen.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => ['slider.update', $slider->slug], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
                    {!! Form::hidden('slider_id', $slider->id) !!}
                    @include('manajemen.slider.form', ['edit' => true])
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
