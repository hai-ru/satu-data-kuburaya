@extends('manajemen.layouts.admin')

@section('content')
    <div class="row mb-4">
        <div class="col-12 text-end">
            @can('permissions-add')
                <a href="{{ route('permissions.create') }}" class="btn btn-success waves-effect btn-label waves-light">
                    <i class="bx bx-plus label-icon"></i>
                    TAMBAH
                </a>
            @endcan
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table style="width: 100%;" id="datatable" role="grid"
                class="table table-hover table-striped table-bordered table-responsive-sm">
                <thead>
                    <tr role="row">
                        <th style="width: 10px">#</th>
                        <th>HAK AKSES</th>
                        <th>GROUP</th>
                        @if (auth()->user()->hasAnyPermission(['permissions-edit', 'permissions-delete']))
                            <th class="text-center">AKSI</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $data)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->group }}</td>
                            @if (auth()->user()->hasAnyPermission(['permissions-edit', 'permissions-delete']))
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Pilih
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('permissions-edit')
                                                <a href="{{ route('permissions.edit', $data->id) }}"
                                                    class="dropdown-item text-warning">
                                                    <i class="fa fa-edit text-warning"></i>
                                                    <span> Ubah</span>
                                                </a>
                                            @endcan
                                            @can('permissions-delete')
                                                <a href="javascript:void(0)" class="dropdown-item text-danger delete"
                                                    data-id="{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#confirm-delete">
                                                    <i class="fa fa-trash text-danger"></i>
                                                    <span> Hapus</span>
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('manajemen.modals.hapus-data')
@endsection

@push('styles')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        $(function() {
            $('#datatable').DataTable({
                "bStateSave": true,
            });
        });
    </script>
    @can('permissions-delete')
        <script>
            var id;
            $('.delete').click(function() {
                id = $(this).data('id');
            });

            $('#delete-btn').click(function() {
                $('#confirm-delete').modal().hide();
                var url = "{{ route('permissions.destroy', ':id') }}"
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: 'DELETE'
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(result) {
                        $('#confirm-delete').modal('hide');
                        var alertType
                        if (result.status == true) {
                            alertType = 'success';
                        } else {
                            alertType = 'error';
                        }
                        Swal.fire(
                            'HAK AKSES',
                            result.message,
                            alertType,
                        ).then(function() {
                            location.reload();
                        });
                    },
                })
            });
        </script>
    @endcan
@endpush
