@extends('tenplates.app')
@section('content')
    <div class=" container card my-5 p-4">
        <div class="card-body">
            <h5 class="text-center">SELESAIKAN PEMBAYARAN</h5>
            <img src="{{ asset('storage/'. $ticket['ticketPayment']['qrcode']) }}" alt="" class="d-block mx-auto">
            <div class=" w-25 d-block mx-auto mb-4">
                <table class="w-100">
                    <tr>
                        <td>2 tiket</td>
                        <td><b>{{ implode(', ', $ticket['rows_of_seats']) }}</b></td>
                    </tr>
                    <tr>
                        <td>kursi reguler</td>
                        <td><b>Rp. {{ number_format($ticket['schedule']['price'], '0',',', '.') }} <span class="text-secondary"> X{{ $ticket['quantity'] }}</span></b></td>
                    </tr>
                    <tr>
                        <td>Biaya Layanan</td>
                        <td><b>{{ $ticket['quantity'] }}</b></td>
                    </tr>
                    <tr>
                        <td>Promo</td>
                        @php
                            if($ticket['promo']) {
                                $promo = $ticket['promo']['type'] == 'percentage' ? $ticket['promo']['discount'] . '%' : 'Rp .' . number_format($ticket['promo']['discount'], 0, ',','.');
                            } else {
                                $promo = 'Rp . 0';
                            }
                        @endphp
                        <td><b>{{ $promo }}</b></td>
                    </tr>
                </table>
                <hr>
                @php
                    $price = $ticket['total_price'] + ($ticket['service-fee'] * $ticket['quantity']);
                @endphp
                <div class="d-flex justify-content-end">
                    <b>Rp. {{ number_format($price, '0',',','.') }}</b>
                </div>
            </div>
            <form action="{{ route('tickets.payment.update', $ticket['id']) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary btn-block btn-lg">
                    sudah bayar
                </button>
            </form>
        </div>
    </div>

@endsection
