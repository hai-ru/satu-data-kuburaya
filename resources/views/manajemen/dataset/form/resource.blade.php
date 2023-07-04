<div class="mb-3 row">
    <label for="title" class="col-md-3 col-form-label">
        Nama Berkas
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('title', old('title'), [
            'id' => 'title',
            'class' => 'form-control',
            'placeholder' => 'Judul Dataset',
        ]) !!}
        @error('title')
            <small class="text-danger">
                {{ $errors->first('title') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label for="deskripsi" class="col-md-3 col-form-label">
        deskripsi
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::textarea('deskripsi', old('deskripsi', $edit ? $dataset->deskripsi : null), [
            'id' => 'deskripsi',
            'class' => 'form-control',
            'rows' => 5,
            'placeholder' => 'Tambahkan deskripsi',
        ]) !!}
        @error('deskripsi')
            <small class="text-danger">
                {{ $errors->first('deskripsi') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label class="col-md-3 col-form-label">
        Berkas
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::file('upload', [
            'id' => 'upload',
            'class' => 'form-control',
            // 'accept' => 'image/png, image/jpg, image/jpeg',
        ]) !!}
        @error('upload')
            <small class="text-danger">
                {{ $errors->first('upload') }}
            </small>
        @enderror
    </div>
</div>