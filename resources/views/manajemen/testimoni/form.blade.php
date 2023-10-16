<div class="mb-3 row">
    <label for="nama" class="col-md-3 col-form-label">
        Nama
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('nama', old('nama', $edit ? $testimoni->nama : null), [
            'id' => 'nama',
            'class' => 'form-control',
            'placeholder' => 'Nama',
        ]) !!}
        @error('nama')
            <small class="text-danger">
                {{ $errors->first('nama') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label for="email" class="col-md-3 col-form-label">
        Email
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('email', old('email', $edit ? $testimoni->email : null), [
            'id' => 'email',
            'class' => 'form-control',
            'placeholder' => 'Email',
        ]) !!}
        @error('email')
            <small class="text-danger">
                {{ $errors->first('email') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label for="rating" class="col-md-3 col-form-label">
        Rating
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('rating', old('rating', $edit ? $testimoni->rating : null), [
            'id' => 'rating',
            'class' => 'form-control',
            'placeholder' => 'rating',
        ]) !!}
        @error('rating')
            <small class="text-danger">
                {{ $errors->first('rating') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label for="testimoni" class="col-md-3 col-form-label">
        Testimoni
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::textarea('testimoni', old('testimoni', $edit ? $testimoni->testimoni : null), [
            'id' => 'testimoni',
            'class' => 'form-control',
            'rows' => 5,
            'placeholder' => 'Tambahkan testimoni',
        ]) !!}
        @error('testimoni')
            <small class="text-danger">
                {{ $errors->first('testimoni') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label class="col-md-3 col-form-label">
        Tampilkan
    </label>
    <div class="col-md-9">
        {!! Form::checkbox('is_show', null, old('is_show', $edit && $testimoni->is_show ? true : false), [
            'id' => 'is_show',
            'class' => 'switch-oos',
            'switch' => 'success',
        ]) !!}
        <label for="is_show" class="mt-1" data-on-label="Ya" data-off-label="Tidak"></label>
    </div>
</div>
