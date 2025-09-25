
@extends('tenplates.app')
@section('content')

    <div class="container pt-5">
        <div class="w-75 d-block m-auto">
            <div class="d-flex">
                <div style="width: 150px; height: 200px;">
                    <img src="{{ asset('storage/' . $movie->poster) }}" alt="" class="w-100">
                </div>
                <div class="ms-5 mt-4">
                    <h5>
                        {{ $movie->title }}
                    </h5>
                    <table>
                        <tr>
                            <td><b class="text-secondary">genre</b></td>
                            <td class="px-3"></td>
                            <td>{{ $movie->genre }}</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">durasi</b></td>
                            <td class="px-3"></td>
                            <td>{{ $movie->genre }}</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">sutradara</b></td>
                            <td class="px-3"></td>
                            <td>{{ $movie->director }}</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">rating usia</b></td>
                            <td class="px-3"></td>
                            <td class="badge badge-danger"><span>+{{ $movie->age_rating }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="w-100 row mt-5">
                <div class="col-6 pe-5">
                    <div class="d-flex flex-column justify-content-end align-items-end">
                        <div class="d-flex align-items-center">
                            <h3 class="text-warning me-2">9.2</h3>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-secondary"></i>
                        </div>
                        <small>4.414 Vote</small>
                    </div>
                </div>
                <div class="col-6 ps-5" style="border-left: 2px solid #c7c7c7">
                    <div class="d-flex align-items-center">
                        <div class="fas fa-heart text-danger me-2"></div>
                        <b>masukan watchlist</b>
                    </div>
                    <small>9.000 orang</small>
                </div>
                <div class="container pt-5">
                    <div class="w-75 d-block m-auto">
                        <div class="d-flex w-100 bg-light mt-3">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    bioskop
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="" class="dropdown-item">bogor</a></li>
                                    <li><a href="" class="dropdown-item">jakarta timur</a></li>
                                    <li><a href="" class="dropdown-item">jakarta barat</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    sortir
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="" class="dropdown-item">harga</a></li>
                                    <li><a href="" class="dropdown-item">alfabet</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="mb-5">
                            <div class="w-100 my-3">
                                <i class="fa-solid fa-building"></i><b class="ms-2">lippo plazza ekalokasari</b>
                                <br>
                                <small class="ms-3">Jl. siliwangi No.123, sukasari, kec. bogor timur. bogor, jawa barat 16134. lippo plazza ekalokasari</small>
                                <div class="d-flex gap-3 ps-3 my-2">
                                    <div class="btn btn-outline-secondary">11.00</div>
                                    <div class="btn btn-outline-secondary">12.00</div>
                                    <div class="btn btn-outline-secondary">13.00</div>
                                    <div class="btn btn-outline-secondary">14.00</div>
                                    <div class="btn btn-outline-secondary">15.00</div>
                                </div>
                            </div>
                            <div class="w-100 p-2 bg-light text-center fixed-bottom">
                                <a href=""><i class="fa-solid fa-ticket"></i> beli tiket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
