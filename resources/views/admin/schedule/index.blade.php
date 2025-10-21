@extends('tenplates.app')
@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Harga:</label>
            <input type="text" class="form-control" id="recipient-name @error('price') is-invalid @enderror">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
            <span class="text-primary mc-3" style="cursor:ponter" onclick="addInput()">tambah data</span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
        <button type="button" class="btn btn-primary">Kirim</button>
      </div>
    </div>
  </div>
</div>


@endsection
@push('script')
    <script>
        function addInput () {
            let content = '<input type="time" name="hours" class="form-control mt-3">';
                //panggil bagian yang akan diisi
                let wadah = document.querySelector('#additionalInput');
                // tambahkan konten, karena akan terus bertambah gunakan +=
                wadah.innerHTML += content;
        }
    </script>
    {{-- cek apakah ada error di php atau engga --}}
    @if ($errors->any())
        {{-- jida ada error, munculkan modal melalui javascript--}}
        <script>
            let modalAdd = document.querySelector("#modalAdd");
            new bootstrap.Modal(modalAdd).show();
        </script>
    @endif
@endpush
