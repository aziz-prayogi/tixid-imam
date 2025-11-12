@extends('tenplates.app')

@section('content')
    <div class="container my-5 card">
        <div class="card-body">
            <i class="fa-solid fa-location-dot me-3"></i>{{ $schedules[0]['cinema']['location'] }}
            <hr>
            @foreach ($schedules as $schedule)
                <div class="my-2">
                    <div class="d-flex">
                        <div style="width: 150px height: 200px">
                            <img src="{{ asset('storage/' . $schedule['movie']['poster']) }}" alt="poster"
                                class="img-fluid mx-auto d-block" style="max-width:250px; border-radius:12px;">
                        </div>
                        <div class="ms-5 mt-4">
                            <h5>{{ $schedule['title'] }}</h5>
                            <table>
                                <tr>
                                    <td><b class="text-secondary">Genre</b></td>
                                    <td class="px-3"></td>
                                    <td>{{ $schedule['movie']['genre'] }}</td>
                                </tr>
                                <tr>
                                    <td><b class="text-secondary">Durasi</b></td>
                                    <td class="px-3"></td>
                                    <td>{{ $schedule['movie']['duration'] }}</td>
                                </tr>
                                <tr>
                                    <td><b class="text-secondary">Sutradara</b></td>
                                    <td class="px-3"></td>
                                    <td>{{ $schedule['movie']['director'] }}</td>
                                </tr>
                                <tr>
                                    <td><b class="text-secondary">rating Usia</b></td>
                                    <td class="px-3"></td>
                                    <td>{{ $schedule['movie']['age_rating'] }}+</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="w-100 my-3">
                        <div class="d-flex justify-content-end">
                            <div>
                                <b>Rp. {{ number_format($schedule['price'], 0, ',', '.') }}</b>
                            </div>
                        </div>
                        <div class="d-felx gap-3 ps-3 my-2">
                            @foreach ($schedule['hours'] as $index => $hours)
                                {{-- this : mengirim element html yg diklik je JS nya --}}
                                <div class="btn btn-outline-secondary"
                                    onclick="selectedHour('{{ $schedule->id }}', '{{ $index }}', this)">
                                    {{ $hours }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
    <div class="w-100 p-2  text-center fixed-bottom" id="wrapper-btn">
        <a href="" id="btn-ticket"><i class="fa-solid fa-ticket"></i> BELI TIKET</a>
    </div>
@endsection

@push('script')
    <script>
        let selectedHours = null;
        let scheduleId = null;
        let lastClickedElement = null;

        function selectedHour(scheduleId, hourId, el) {
            // memindahkan data dari parameter val
            selectedHours = hourId;
            selectedSchedule = scheduleId;

            // memberikan styling warna ke kotak jam (element yg di klik)
            if (lastClickedElement) {
                // kalau ada jam yang sebelumnya dipilih, jam sblmnya di kembalikan ke tanpa warna
                lastClickedElement.style.background = "";
                lastClickedElement.style.color = "";
                lastClickedElement.style.borderColor = "";
            }
            // beri warna ke element yang baru diklik
            el.style.background = "#112646";
            el.style.color = "white";
            el.style.borderColor = "112646";
            // update  lastClickedElement ke el baru
            lastClickedElement = el;

            let btnWrapper = document.querySelector('#wrapper-btn');
            let btnTicket = document.querySelector('#btn-ticket');

            btnWrapper.style.background = "#112646";
            btnTicket.style.color = "white";
            btnWrapper.style.borderColor = "#112646";

            // set route
            let url = "{{ route('schedules.show_seats', ['scheduleId' => ':schedule', 'hourId' => ':hour']) }}"
                .replace(':schedule', scheduleId)
                .replace(':hour', hourId);
            // replace -> mengganti :schedule dan :hour menjadi data yg sebenarnya
            // isi href pada a beli tiket
            btnTicket.href = url;



        }
    </script>
@endpush
