@extends('tenplates.app')
@section('content')

    <div class="container mt-3">
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>

        @endif
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.cinemas.create') }}" class="btn btn-success"> tambah data</a>
        </div>
        <h5 class="mt-3">data bioskop</h5>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Nama bioskop</th>
                <th>Lokasi</th>
                <th>aksi</th>
            </tr>
            {{-- $cinemas dari compact --}}
            {{-- foreach karena $cinemas pake :: all()  --}}
            @foreach ($Cinemas as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['location']}}</td>
                    <td class="d-flex">
                        <a href="{{ route('admin.cinemas.edit', $item['id']) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('admin.cinemas.delete', $item['id']) }}" method="POST">
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
