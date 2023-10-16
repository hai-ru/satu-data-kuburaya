<div class="mb-3 row">
    <label for="nama" class="col-md-3 col-form-label">
        Nama
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('nama', old('nama', $edit ? $unduhan->nama : null), [
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
        {!! Form::text('email', old('email', $edit ? $unduhan->email : null), [
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
    <label for="resource_id" class="col-md-3 col-form-label">
        Dataset
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('resource_id', old('resource_id', $edit ? $unduhan->resource_id : null), [
            'id' => 'resource_id',
            'class' => 'form-control',
            'placeholder' => 'Cari Dataset',
        ]) !!}
        @error('resource_id')
            <small class="text-danger">
                {{ $errors->first('resource_id') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label for="alasan_pemanfaatan" class="col-md-3 col-form-label">
        Alasan Pemanfaatan
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::textarea('alasan_pemanfaatan', old('alasan_pemanfaatan', $edit ? $unduhan->alasan_pemanfaatan : null), [
            'id' => 'alasan_pemanfaatan',
            'class' => 'form-control',
            'rows' => 5,
            'placeholder' => 'Alasan Pemanfaatan',
        ]) !!}
        @error('alasan_pemanfaatan')
            <small class="text-danger">
                {{ $errors->first('alasan_pemanfaatan') }}
            </small>
        @enderror
    </div>
</div>
