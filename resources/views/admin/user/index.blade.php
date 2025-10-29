@extends('tenplates.app')
@section('content')


    <div class="container mt-3">
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>

        @endif
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.users.export') }}" class="btn btn-secondary me-2">Export</a>
            <a href="{{ route('admin.users.trash') }}" class="btn btn-secondary me-2">Data Sampah</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success"> tambah data</a>
        </div>
        <h5 class="mt-3">data user</h5>
        <table class="table table-bordered" id="tableUser">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>aksi</th>
            </tr>
        </table>
    </div>

@endsection
@push('script')
    <script>
        $(function(){
            $("#tableUser").DataTable({
                processing: true,
                serverSide: true,
                ajax:  "{{ route('admin.users.datatables') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        })
    </script>
@endpush

                        {{-- @if ($item['role'] == 'admin')
                            <span class="badge rounded-pill bg-danger text-white">admin</span>
                        @elseif ($item['role'] == 'staff')
                            <span class="badge rounded-pill bg-success text-white">staff</span>
                        @else
                            <span class="badge rounded-pill bg-primary text-white">user</span>
                        @endif --}}

{{-- {{ route('admin.users.edit', $item['id']) }} --}}
{{-- {{ route('admin.users.delete', $item['id']) }} --}}
