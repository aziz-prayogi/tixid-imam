@extends('tenplates.app')

@section('content')
    <div class="container card my-5 p=4" style="margin-bottom: 20% !importantff">
        <div class="card-body">
            <b>{{ $schedule['cinema']['name'] }}</b>
            {{-- now() : ambil tanggal hari ini, format : f nama bulan--}}
            <br><b>{{ now()->format('d F y') }} - {{ $hour }}</b>
            <div class="alert alert-secondary">
                <i class="fa-solid fa-info text-danger"></i> Anak berusia 2 tahun wajib membeli tiket
            </div>
            <div class="w-50 d-block mx-auto my-4">
                <div class="row">
                    <div class="col-4 d-flex">
                        <div style="width: 20px; height: 20px; background: blue; margin-right: 5px;"></div>kursi dipilih
                    </div>
                    <div class="col-4 d-flex">
                        <div style="width: 20px; height: 20px; background: #112646; margin-right: 5px;"></div>kursi tersedia
                    </div>
                    <div class="col-4 d-flex">
                        <div style="width: 20px; height: 20px; background: #eaeaea; margin-right: 5px;"></div>kursi terjual
                    </div>
                </div>
            </div>

            @php
                // array untuk loooping, range() : membuat rentang tertentu menjadi array
                $rows = range('A','H');
                $cols = range(1,18);
            @endphp

            @foreach ($rows as $row)
                {{-- untuk loop 1-18 kesamping dibungkus d-flex --}}
                <div class="d-flex justify-content-center align-items-center">
                    @foreach ($cols as $col)
                        @if ($col == 7)
                            {{-- memberi kota kosong untuk jarak kursi 6 dan 7 (jalur jalur) --}}
                            <div style="width: 50px"></div>
                        @endif
                        <div style="width: 45px; height: 45px; text-align: center; font-weight: bold; color: white; padding-top: 10px; cursor: pinter; background: #112646; margin: 5px; border-radius: 8px;" onclick="selectSeat('{{ $schedule->price }}','{{ $row }}','{{$col }}',this)">{{ $row }}-{{ $col }}</div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <div class="fixed-bottom">
        <div class="p-4 bg-light text-center w-100"><b>layar bioskop</b></div>
        <div class="row w-100 bg-light">
            <div class="col-6 py-3 text-center" style="border: 1px solid grey">
                <h5>Total Harga</h5>
                <h5 id="totalPrice">Rp. -</h5>
            </div>
            <div class="col-6 py-3 text-center" style="border: 1px solid grey">
                <h5>Kursi dipilih</h5>
                <h5 id="seat">-</h5>
            </div>
        </div>
        <div class="w-100 bg-light p-2 text-center" id="btnOrder"><b>RINGKASAN ORDER</b></div>
    </div>

@endsection

@push('script')
    <script>
        let seats = [];
        function selectSeat(price, row, col, element) {
            //buat format nomor kursi : A-10
            let seat = row + "-" + col;
            // cek ke arrayu seats apakah kursi ini uda ada di array atau belum (udah pernah di klik/belum)
            //indesOf() : mencari item di array dan mengembalikan nilai index itemnya
            let indexSeat = seats.indexOf(seat);
            // jika ada item maka index array bernilai 0-dst kalo gaada 1-18
            if (indexSeat== -1) {
                // kalau kursi tsb belum ada di array maka tambahkan dan warna biru
                seats.push(seat); // push :menambahkan item ke array
                element.style.background = 'blue';
            } else {
                // kalau kursi ada di array artinya klik kali ini untuk hapus
                seats.splice(indexSeat,1); // splice : menghapus item array sesuai index yang diberikan sebanyak 1
                element.style.background = '#112646'; // kembalikan warna ke biru
            }

            let totalPrice = price * seats.length; // length : count php, menghhitung isi array
            let totalPriceElement = document.querySelector('#totalPrice');
            totalPriceElement.innerText = "Rp. " + totalPrice;

            let seatsElement = document.querySelector('#seat');
            seatsElement.innerText = seats.join(', '); // join : menggabungkan item array menjadi string dengan pemisah koma

            let btnOrder = document.querySelector('#btnOrder');
            if (seats.length > 0) {
                btnOrder.classList.remove('bg-light');
                btnOrder.style.background = '#112646';
                btnOrder.style.color = 'white';
            } else {
                btnOrder.classlist.add('bg-light');
                btnOrder.style.background = '';
                btnOrder.style.color = '';
            }
        }
    </script>
@endpush
