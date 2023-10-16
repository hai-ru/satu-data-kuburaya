<div class="mb-3 row">
    <label for="judul" class="col-md-3 col-form-label">
        Judul
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('judul', old('judul', $edit ? $slider->judul : null), [
            'id' => 'judul',
            'class' => 'form-control',
            'placeholder' => 'Judul Slider',
        ]) !!}
        @error('judul')
            <small class="text-danger">
                {{ $errors->first('judul') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label for="slug" class="col-md-3 col-form-label">
        Slug
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('slug', old('slug', $edit ? $slider->slug : null), [
            'id' => 'slug',
            'class' => 'form-control',
            'placeholder' => 'Slug',
        ]) !!}
        @error('slug')
            <small class="text-danger">
                {{ $errors->first('slug') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label for="deskripsi" class="col-md-3 col-form-label">
        Deskripsi
    </label>
    <div class="col-md-9">
        {!! Form::textarea('deskripsi', old('deskripsi', $edit ? $slider->deskripsi : null), [
            'id' => 'deskripsi',
            'class' => 'form-control',
            'rows' => 10,
            'placeholder' => 'Deskripsi singkat slider',
        ]) !!}
    </div>
</div>
<div class="mb-3 row">
    <label class="col-md-3 col-form-label">
        Gambar
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::file('gambar', [
            'id' => 'gambar',
            'class' => 'form-control',
            'accept' => 'image/png, image/jpg, image/jpeg',
        ]) !!}
        @error('gambar')
            <small class="text-danger">
                {{ $errors->first('gambar') }}
            </small>
            <br>
        @enderror
        <img id="preview-gambar" src="{{ $edit ? url('uploads/slider/'.$slider->gambar) : asset('assets/images/image-not-found.png') }}"
            alt="preview gambar" style="max-height: 250px; margin-top: 10px">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-md-3 col-form-label">
        Tampilkan Judul
    </label>
    <div class="col-md-9">
        {!! Form::checkbox('is_judul_show', null, old('is_judul_show', $edit && $slider->is_judul_show ? true : false), [
            'id' => 'is_judul_show',
            'class' => 'switch-oos',
            'switch' => 'success',
        ]) !!}
        <label for="is_judul_show" class="mt-1" data-on-label="Ya" data-off-label="Tidak"></label>
    </div>
</div>
<div class="mb-3 row">
    <label class="col-md-3 col-form-label">
        Tampilkan Deskripsi
    </label>
    <div class="col-md-9">
        {!! Form::checkbox('is_deskripsi_show', null, old('is_deskripsi_show', $edit && $slider->is_deskripsi_show ? true : false), [
            'id' => 'is_deskripsi_show',
            'class' => 'switch-oos',
            'switch' => 'success',
        ]) !!}
        <label for="is_deskripsi_show" class="mt-1" data-on-label="Ya" data-off-label="Tidak"></label>
    </div>
</div>
<div class="mb-3 row">
    <label class="col-md-3 col-form-label">
        Aktif
    </label>
    <div class="col-md-9">
        {!! Form::checkbox('is_active', null, old('is_active', $edit && $slider->is_active ? true : false), [
            'id' => 'is_active',
            'class' => 'switch-oos',
            'switch' => 'success',
        ]) !!}
        <label for="is_active" class="mt-1" data-on-label="Ya" data-off-label="Tidak"></label>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            $('#judul').on("change keyup paste click", function() {
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
                $('#slug').val(Text);
            });

            $('#slug').on("change keyup paste click", function() {
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
                $('#slug').val(Text);
            });

            $('#gambar').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-gambar').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
