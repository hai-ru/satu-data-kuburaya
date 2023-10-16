<div class="mb-3 row">
    <label for="name" class="col-md-3 col-form-label">
        Nama Lengkap
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('name', old('name', $edit ? $user->name : null), [
            'id' => 'name',
            'class' => 'form-control',
            'placeholder' => 'Nama Lengkap',
        ]) !!}
        @if ($errors->has('name'))
            <small class="text-danger">
                {{ $errors->first('name') }}
            </small>
        @endif
    </div>
</div>
<div class="mb-3 row">
    <label for="name" class="col-md-3 col-form-label">
        Username
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('username', old('username', $edit ? $user->username : null), [
            'id' => 'username',
            'class' => 'form-control',
            'placeholder' => 'Username',
        ]) !!}
        @if ($errors->has('username'))
            <small class="text-danger">
                {{ $errors->first('username') }}
            </small>
        @endif
    </div>
</div>
<div class="mb-3 row">
    <label for="name" class="col-md-3 col-form-label">
        Email
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::text('email', old('email', $edit ? $user->email : null), [
            'id' => 'email',
            'class' => 'form-control',
            'placeholder' => 'email',
        ]) !!}
        @if ($errors->has('email'))
            <small class="text-danger">
                {{ $errors->first('email') }}
            </small>
        @endif
    </div>
</div>
<div class="mb-3 row">
    <label for="name" class="col-md-3 col-form-label">
        Peran
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-9">
        {!! Form::select('roles', ['' => ''] + $roles, old('roles', $edit ? $userRole : null), [
            'id' => 'roles',
            'class' => 'form-control select2',
            'data-placeholder' => 'Silahkan pilih peran',
        ]) !!}
        @if ($errors->has('roles'))
            <small class="text-danger">
                {{ $errors->first('roles') }}
            </small>
        @endif
    </div>
</div>
<div class="mb-3 row">
    <label for="name" class="col-md-3 col-form-label">
        Password
        @if (!$edit)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-md-9">
        {!! Form::password('password', [
            'id' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Password',
        ]) !!}
        @if ($edit)
            <small class="text-danger me-2">(Isi jika ingin mengubah password)</small>
        @endif
        @if ($errors->has('password'))
            <small class="text-danger">
                {{ $errors->first('password') }}
            </small>
        @endif
    </div>
</div>
<div class="mb-3 row">
    <label for="name" class="col-md-3 col-form-label">
        Konfirmasi Password
        @if (!$edit)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-md-9">
        {!! Form::password('confirm-password', [
            'id' => 'confirm-password',
            'class' => 'form-control',
            'placeholder' => 'Konfirmasi Password',
        ]) !!}
        @if ($errors->has('confirm-password'))
            <small class="text-danger">
                {{ $errors->first('confirm-password') }}
            </small>
        @endif
    </div>
</div>

@push('styles')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2();
        });
    </script>
@endpush
