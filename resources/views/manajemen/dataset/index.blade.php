@extends('manajemen.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header bg-light">
            <div class="card-title float-md-start mt-2">
                {{ $pageTitle }}
            </div>
            @can('dataset-add')
                <div class="float-md-end">
                    <a href="{{ route('dataset.create') }}"
                        class="btn btn-success waves-effect btn-label waves-light btn-sm-full-width">
                        <i class="bx bx-plus label-icon"></i>
                        TAMBAH
                    </a>
                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="width: 100%;" id="datatable" role="grid"
                    class="table table-hover table-striped table-bordered table-responsive-sm">
                    <thead>
                        <tr role="row">
                            <th style="width: 10px">#</th>
                            <th>JUDUL DATASET</th>
                            <th class="text-center">VISIBILITAS</th>
                            @if (auth()->user()->hasAnyPermission(['dataset-read', 'dataset-edit', 'dataset-delete']))
                                <th class="text-center">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $dari = $result['dari'];
                        @endphp
                        @foreach ($result['dataset'] as $item)
                            <tr>
                                <td>{{ $dari++ }}</td>
                                <td>{{ $item->title }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $item->private ? 'badge-soft-danger' : 'badge-soft-success' }} p-2">
                                        {{ $item->private ? 'privat' : 'publik' }}
                                    </span>
                                </td>
                                @if (auth()->user()->hasAnyPermission(['dataset-read', 'dataset-edit', 'dataset-delete']))
                                    <td class="text-center">
                                        <div class="btn-group btn-full-width mb-3">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Pilih <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @can('dataset-read')
                                                    <a href="#" class="dropdown-item text-warning"><i
                                                            class="fa fa-eye"></i> Detail </a>
                                                @endcan
                                                @can('dataset-edit')
                                                    <a href="#" class="dropdown-item text-warning"><i
                                                            class="fa fa-edit"></i> Ubah </a>
                                                @endcan
                                                @can('dataset-delete')
                                                    <a href="javascript:void(0);" class="dropdown-item text-danger delete"
                                                        data-id="#" data-bs-toggle="modal"
                                                        data-bs-target="#confirm-delete"><i class="fa fa-trash"></i> Hapus </a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        Menampikan {{ $result['dari'] }} - {{ $result['sampai'] }} dari total {{ $result['total'] }}
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <nav aria-label="dataset-pagination">
                            <ul class="pagination justify-content-end">
                                <li class="page-item {{ $result['page'] == 1 ? 'disabled' : '' }}">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $result['total_page']; $i++)
                                    @if ($i <= 1 || $i >= $result['total_page'] - 1 || abs($i - $result['page']) <= 1)
                                        @php
                                            $outOfRange = false;
                                        @endphp

                                        <li class="page-item {{ $result['page'] == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ route('dataset.index', ["page=$i"]) }}">{{ $i }}</a>
                                        </li>
                                    @else
                                        @if (!$outOfRange)
                                            <li class="page-item">
                                                <a class="page-link" href="javascript:void(0);">...</a>
                                            </li>
                                        @endif
                                        @php
                                            $outOfRange = true;
                                        @endphp
                                    @endif
                                @endfor
                                <li class="page-item {{ $result['page'] == $result['total_page'] ? 'disabled' : '' }}">
                                    <a class="page-link" href="#">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manajemen.modals.hapus-data')
@endsection

@push('scripts')
    <script>
        $(function() {
            //
        });
    </script>
    @can('dataset-delete')
        <script>
            var slug;
            $(document).on('click', '.delete', function() {
                slug = $(this).data('slug');
            });

            $('#delete-btn').click(function() {
                $('#confirm-delete').modal().hide();
                var url = "{{ route('dataset.destroy', ':slug') }}"
                url = url.replace(':slug', slug);
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
