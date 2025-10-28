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
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>aksi</th>
            </tr>
            {{-- $users dari compact --}}
            {{-- foreach karena $users pake :: all()  --}}
            @foreach ($Users as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>
                        @if ($item['role'] == 'admin')
                            <span class="badge rounded-pill badge-primary">admin</span>
                        @elseif ($item['role'] == 'staff')
                            <span class="badge rounded-pill badge-success">staff</span>
                        @else
                            <span class="badge rounded-pill badge-light">user</span>
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('admin.users.edit', $item['id']) }}" class="btn btn-secondary mx-2">Edit</a>
                        <form action="{{ route('admin.users.delete', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection

                        {{-- @if ($item['role'] == 'admin')
                            <span class="badge rounded-pill bg-danger text-white">admin</span>
                        @elseif ($item['role'] == 'staff')
                            <span class="badge rounded-pill bg-success text-white">staff</span>
                        @else
                            <span class="badge rounded-pill bg-primary text-white">user</span>
                        @endif --}}

{{-- {{ route('admin.users.edit', $item['id']) }} --}}
{{-- {{ route('admin.users.delete', $item['id']) }} --}}
