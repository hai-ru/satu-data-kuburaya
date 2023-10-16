<div class="mb-3 row">
    <label for="title" class="col-md-3 col-form-label">
        Judul
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
    <label for="name" class="col-md-3 col-form-label">
        Slug
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('name', old('name'), [
            'id' => 'name',
            'class' => 'form-control',
            'placeholder' => 'Slug',
        ]) !!}
        @error('name')
            <small class="text-danger">
                {{ $errors->first('name') }}
            </small>
        @enderror
    </div>
</div>
{{-- <div class="mb-3 row">
    <label for="tags" class="col-md-3 col-form-label">
        Tag
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::select('tags', ['' => ''], old('tags'), [
            'id' => 'tags',
            'class' => 'form-control select2 select2-multiple',
            'style' => 'width: 100%',
            'multiple' => 'multiple',
            'data-initial-value' => '',
            'data-user-option-allowed' => 'true',
            'data-url' => "{{ url('ajax/tags/cari') }}"
        ]) !!}
        <input type="text" multiple class="tagsInput" value="Algeria,Angola"
            data-initial-value='[{"text": "Algeria", "value" : "Algeria"}, {"text": "Angola", "value" : "Angola"}]'
            data-user-option-allowed="true" data-url="demo/data.json" data-load-once="true" name="language" />
    </div>
</div> --}}
<div class="mb-3 row">
    <label for="tags" class="col-md-3 col-form-label">
        Tags
    </label>
    <div class="col-md-9">
        {!! Form::select('tags', ['' => ''], null, [
            'id' => 'tags',
            'class' => 'form-control select2',
            'style' => 'width: 100%',
            'data-placeholder' => 'Contoh: pemerintahan, asn',
        ]) !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="license_id" class="col-md-3 col-form-label">
        Lisensi
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::select('license_id', $lisensi, old('license_id', $edit ? $dataset->license_id : 'cc-by'), [
            'id' => 'license_id',
            'class' => 'form-control select2',
            'style' => 'width: 100%',
            'data-placeholder' => 'Silahkan pilih lisensi',
        ]) !!}
        <small class="mr-3">
            <i class="fa fa-info-circle text-info">
                Definisi lisensi dan informasi tambahan dapat ditemukan di
                <a href="https://opendefinition.org" target="_blank" rel="noopener noreferrer">
                    opendefinition.org
                </a>
            </i>
        </small>
        @error('license_id')
            <small class="text-danger">
                {{ $errors->first('license_id') }}
            </small>
        @enderror
    </div>
</div>
@role('masteradmin|superadmin')
    <div class="mb-3 row">
        <label for="private" class="col-md-3 col-form-label">
            Visibiltas
            <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            {!! Form::select(
                'private',
                ['True' => 'Privat', 'False' => 'Publik'],
                old('private', $edit ? $dataset->private : 'True'),
                [
                    'id' => 'private',
                    'class' => 'form-control select2',
                    'style' => 'width: 100%',
                ],
            ) !!}
            @error('private')
                <small class="text-danger">
                    {{ $errors->first('private') }}
                </small>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="owner_org" class="col-md-3 col-form-label">
            Perangkat Daerah
            <span class="text-danger">*</span>
        </label>
        <div class="col-md-9">
            {!! Form::select(
                'owner_org',
                $opd,
                old('owner_org', $edit ? $dataset->owner_org : 'd46272f4-47c8-42ff-80b0-74efb51aa53a'),
                [
                    'id' => 'owner_org',
                    'class' => 'form-control select2',
                    'style' => 'width: 100%',
                ],
            ) !!}
            @error('owner_org')
                <small class="text-danger">
                    {{ $errors->first('owner_org') }}
                </small>
            @enderror
        </div>
    </div>
@endrole
<div class="mb-3 row">
    <label for="groups" class="col-md-3 col-form-label">
        Kategori
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::select('groups', ['' => ''] + $grup, old('groups', $edit ? $dataset->groups : null), [
            'id' => 'groups',
            'class' => 'form-control select2',
            'style' => 'width: 100%',
            'data-placeholder' => 'Silahkan pilih kategori',
        ]) !!}
        @error('groups')
            <small class="text-danger">
                {{ $errors->first('groups') }}
            </small>
        @enderror
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/fastselect/css/fastselect.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/fastselect/js/fastselect.min.js') }}"></script>
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

            $('#title').on("change keyup paste click", function() {
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
                $('#name').val(Text);
            });

            $('#name').on("change keyup paste click", function() {
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
                $('#name').val(Text);
            });
        });
    </script>
@endpush
