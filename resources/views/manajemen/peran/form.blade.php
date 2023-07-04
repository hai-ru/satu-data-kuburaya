<div class="mb-3 row">
    <label for="name" class="col-md-3 col-form-label">
        Peran
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('name', old('name', $edit ? $role->name : null), [
            'id' => 'name',
            'class' => 'form-control',
            'placeholder' => 'Peran',
        ]) !!}
        <small class="text-danger"></small>
    </div>
</div>
<div class="mt-4 mb-2">
    Hak Akses
    <small class="text-danger"></small>
</div>
<div class="row">
    @foreach ($permissions as $key => $permisssion)
        <div class="col-md-4">
            <div class="main-card card mb-3">
                <div class="card-header bg-primary text-white">
                    {{ ucfirst($key) }}
                </div>
                <div class="card-body bg-light">
                    @foreach ($permisssion as $value)
                        {!! Form::checkbox(
                            'permissions[]',
                            $value['id'],
                            !$edit ? null : (in_array($value['id'], $rolePermissions) ? true : false),
                            [
                                'id' => $value['id'],
                                'class' => 'form-check-input',
                                'style' => 'margin-right: 5px;'
                            ],
                        ) !!}
                        <label class="custom-control-label" for="{{ $value['id'] }}">
                            {{ $value['name'] }}
                        </label>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
