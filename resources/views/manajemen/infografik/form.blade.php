<div class="mb-3 row">
    <label for="judul" class="col-md-3 col-form-label">
        Judul
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('judul', old('judul', $edit ? $infografik->judul : null), [
            'id' => 'judul',
            'class' => 'form-control',
            'placeholder' => 'Judul Infografik',
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
        {!! Form::text('slug', old('slug', $edit ? $infografik->slug : null), [
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
    <label for="group_id" class="col-md-3 col-form-label">
        Kategori
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::select('group_id', ['' => ''] + $grup, old('group_id', $edit ? $infografik->group_id : null), [
            'id' => 'group_id',
            'class' => 'form-control select2',
            'style' => 'width: 100%',
            'data-placeholder' => 'Silahkan pilih kategori',
        ]) !!}
        @error('group_id')
            <small class="text-danger">
                {{ $errors->first('group_id') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label for="deskripsi" class="col-md-3 col-form-label">
        Deskripsi
    </label>
    <div class="col-md-9">
        {!! Form::textarea('deskripsi', old('deskripsi', $edit ? $infografik->deskripsi : null), [
            'id' => 'deskripsi',
            'class' => 'form-control',
            'rows' => 10,
            'placeholder' => 'Jelaskan dengan jelas tentang infografik ini',
        ]) !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="group_id" class="col-md-3 col-form-label">
        Tipe
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::select('tipe', ['' => ''] + \App\Models\Infografik::getTipeAvailable(), old('tipe', $edit ? $infografik->tipe : null), [
            'id' => 'tipe',
            'class' => 'form-control select2',
            'style' => 'width: 100%',
            'data-placeholder' => 'Silahkan pilih tipe',
        ]) !!}
        @error('group_id')
            <small class="text-danger">
                {{ $errors->first('tipe') }}
            </small>
        @enderror
    </div>
</div>
<div class="mb-3 row">
    <label for="slug" class="col-md-3 col-form-label">
        Link Embed
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('link', old('link', $edit ? $infografik->link : null), [
            'id' => '`',
            'class' => 'form-control',
            'placeholder' => 'link',
        ]) !!}
        @error('slug')
            <small class="text-danger">
                {{ $errors->first('link') }}
            </small>
        @enderror
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
        <img id="preview-gambar"
            src="{{ $edit ? url('uploads/infografik/' . $infografik->gambarInfografik?->gambar ?? "") : asset('assets/images/image-not-found.png') }}"
            alt="preview gambar" style="max-height: 250px; margin-top: 10px">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-md-3 col-form-label">
        PDF
        <span class="text-danger"></span>
    </label>
    <div class="col-md-9">
        {!! Form::file('pdf', [
            'id' => 'pdf',
            'class' => 'form-control',
            'accept' => 'image/pdf',
        ]) !!}
        @error('pdf')
            <small class="text-danger">
                {{ $errors->first('pdf') }}
            </small>
            <br>
        @enderror
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                allowClear: true,
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                }
            });

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
