@extends('tenplates.app')

@section('content')
    <div class="container card p-4 ny-5">
        <div class="card-body">
            <b class="text-center">RINGKASAN ORDER</b>
            <div class="d-flex">
                <img src="{{ asset('storage/'. $ticket['schedule']['movie']['poster']) }}" width="120" >
                <div class="ms-4 my-4">
                    <b class="text-warning"> {{ $ticket['schedule']['cinema']['name'] }}</b>
                    <br><b>{{ $ticket['schedule']['movie']['title'] }}</b>
                    <table>
                        <tr>
                            <td>Genre</td>
                            <td>:</td>
                            <td>{{ $ticket['schedule']['movie']['genre'] }}</td>
                        </tr>
                        <tr>
                            <td>durasi</td>
                            <td>:</td>
                            <td>{{ $ticket['schedule']['movie']['duration'] }}</td>
                        </tr>
                        <tr>
                            <td>Sutradara</td>
                            <td>:</td>
                            <td>{{ $ticket['schedule']['movie']['director'] }}</td>
                        </tr>
                        <tr>
                            <td>usia minimal</td>
                            <td>:</td>
                            <td> <span class="badge badge-danger"> {{ $ticket['schedule']['movie']['age_rating'] }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>
            <b class="text-secondary">NOMOR PESANAN : {{ $ticket['id'] }}</b>
            <br><b>Detai Pesanan</b>
            <table>
                <tr>
                    <td>{{ $ticket['quantity'] }} tiket</td>
                    <td style="padding: 0 20px"></td>
                    <td><b>{{ implode(', ',$ticket['rows_of_seats']) }}</b></td>
                </tr>
                <tr>
                    <td>Harga Tiket</td>
                    <td style="padding: 0 20px"></td>
                    <td><b>Rp. {{ number_format($ticket['schedule']['price'], 0, ',', '.') }} <span class="text-secondary"> {{ $ticket['quantity'] }}</span> </b></td>
                </tr>
                <tr>
                    <td>biaya layanan</td>
                    <td style="padding: 0 20px"></td>
                    <td><b>Rp. 4.000 <span class="text-secondary">X{{ $ticket['quantity'] }}</span> </b></td>
                </tr>

            </table>
            <b>gunakan promo</b>
            <select name="promo_id" id="promo_id" class="form-select" onchange="selectPromo(this)">
                @if (count($promos) < 1)
                    <option disabled hidden selected>
                        Tidak ada Promo aktif saat ini
                    </option>
                @else
                    <option disabled hidden selected>
                        pilih promo
                    </option>

                    @foreach ($promos as $promo)
                        <option value="{{ $promo['id'] }}">{{ $promo['promo_code'] }} - {{ $promo['type'] == 'percentage' ? $promo['discount'] . '%' : 'Rp. ' . number_format($promo['discount'], '0', ',', '.')}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <input type="hidden" name="ticket_id" value="{{ $ticket['id'] }}" id="ticket_id">
    <div class="w-100 p-2 text-center fixed-bottom" style="background: #112646; color: white; cursor: pointer;" onclick="createQR()">
        <i class="fa-solid fa-ticket"></i> BAYAR SEKARANG
    </div>


@endsection

@push('script')
    <script>
        let promoId = null;
        function selectPromo(element) {
            //isi nilai promoId dari value select
            promoId = element.value;
        }

        function createQR() {
            let data = {
                _token: "{{ csrf_token() }}",
                promo_id: promoId,
                ticket_id: $("#ticket_id").val()
            }
            $.ajax({
                url: "{{ route('tickets.barcode') }}",
                type:"POST",
                data: data,
                success: function(response) {
                    const ticketId = response.data.ticket_id;
                    window.location.href = `/tickets/${ticketId}/payment`;

                },
                error: function(xhr) {
                    alert("Terjadi Kesalahan Saat mengirim Data!");
                    console.error(xhr.responseText);
                }
            })
        }
    </script>
@endpush
