<div class="mb-3 row">
    <label for="name" class="col-md-2 col-form-label">Hak Akses</label>
    <div class="col-md-10">
        {!! Form::text('name', old('name', $edit ? $permission->name : null), [
            'id' => 'name',
            'class' => 'form-control',
            'placeholder' => 'Hak Akses',
        ]) !!}
        <small class="text-danger"></small>
    </div>
</div>
<div class="mb-3 row">
    <label for="group" class="col-md-2 col-form-label">Group</label>
    <div class="col-md-10">
        {!! Form::text('group', old('group', $edit ? $permission->group : null), [
            'id' => 'group',
            'class' => 'form-control',
            'placeholder' => 'Group',
        ]) !!}
        <small class="text-danger"></small>
    </div>
</div>
@if (!$edit)
        @foreach ($options as $key => $value)
        <div class="mb-3 row">
            <label class="col-md-2 col-form-label"></label>
            <div class="col-md-10">
                {!! Form::checkbox('options[]', $value, false, [
                    'id' => $value,
                    'class' => 'form-check-input',
                ]) !!}
                <label class="form-check-label" for="{{ $value }}">
                    {{ $value }}
                </label>

            </div>
        </div>
        @endforeach
@endif

@push('scripts')
    <script>
        $('#name').on("change keyup paste click", function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $(this).val(Text);
        });
        $('#group').on("change keyup paste click", function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            $(this).val(Text);
        });
    </script>
@endpush
