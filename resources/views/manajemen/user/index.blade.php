@extends('manajemen.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header bg-light">
            <div class="card-title float-md-start mt-2">
                {{ $pageTitle }}
            </div>
            @can('users-add')
                <div class="float-md-end">
                    <a href="{{ route('users.create') }}" class="btn btn-success waves-effect btn-label waves-light btn-sm-full-width">
                        <i class="bx bx-plus label-icon"></i>
                        TAMBAH
                    </a>
                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="width: 100%;" id="datatable" role="grid"
                class="table table-hover table-striped table-bordered">
                <thead>
                    <tr role="row">
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>USERNAME</th>
                        <th>EMAIL</th>
                        <th class="text-center">PERAN</th>
                        @if (auth()->user()->hasAnyPermission(['users-edit', 'users-delete']))
                            <th class="text-center">AKSI</th>
                        @endif
                    </tr>
                </thead>
            </table>
            </div>
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
    <script>
        $(function() {
            $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                bStateSave: true,
                language: {
                    'loadingRecords': '&nbsp;',
                    'processing': '<div class="spinner-border text-primary m-1" role="status"><span class="sr-only">Loading...</span></div>'
                },
                ajax: {
                    url: "{{ route('users.datatable.api') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                    },
                    dataSrc: function(json) {
                        return json.data;
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        serachable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    @if (auth()->user()->hasAnyPermission(['users-edit', 'users-delete']))
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        serachable: false
                    }
                    @endif
                ],
                columnDefs: [{
                        className: 'text-center',
                        width: 30,
                        targets: [0]
                    },
                    {
                        className: 'text-center',
                        targets: [4]
                    },
                    @if (auth()->user()->hasAnyPermission(['users-edit', 'users-delete']))
                    {
                        className: 'text-center',
                        targets: [5]
                    }
                    @endif
                ],
                order: [],
            });
        });
    </script>
    @can('users-delete')
        <script>
            var id;
            $(document).on('click', '.delete', function() {
                id = $(this).data('id');
            });

            $('#delete-btn').click(function() {
                $('#confirm-delete').modal().hide();
                var url = "{{ route('users.destroy', ':id') }}"
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
                        if (result.status) {
                            flasher.success(result.message);
                            $('#datatable').DataTable().ajax.reload(null, false);
                        } else {
                            flasher.error(result.message);
                        }
                    },
                })
            });
        </script>
    @endcan
@endpush
