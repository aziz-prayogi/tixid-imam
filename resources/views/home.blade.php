@extends('tenplates.app')
@section('content')


    @if (Session::get('success'))
        {{-- Auth::user()->field : mengambil data orang yang login, field dari fillable model user --}}
        <div class="alert alert-success">
            {{ Session::get('success') }} <b>Selamat Datang, {{Auth::user()->name}}</b>
        </div>
    @endif
    @if (Session::get('logout'))
        <div class="alert alert-warning">
            {{ Session::get('logout') }}
        </div>
    @endif

    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle d-flex align-items-center w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-location-dot me-2">bogor</i>
        </button>

        <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item" href="#">bogor</a></li>
            <li><a class="dropdown-item" href="#">jakarta</a></li>
            <li><a class="dropdown-item" href="#">bandung</a></li>
        </ul>
    </div>

    <!-- Carousel wrapper -->
<div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel" data-mdb-carousel-init>
  <!-- Indicators -->
  <div class="carousel-indicators">
    <button
      type="button"
      data-mdb-target="#carouselBasicExample"
      data-mdb-slide-to="0"
      class="active"
      aria-current="true"
      aria-label="Slide 1"
    ></button>
    <button
      type="button"
      data-mdb-target="#carouselBasicExample"
      data-mdb-slide-to="1"
      aria-label="Slide 2"
    ></button>
    <button
      type="button"
      data-mdb-target="#carouselBasicExample"
      data-mdb-slide-to="2"
      aria-label="Slide 3"
    ></button>
  </div>

  <!-- Inner -->
  <div class="carousel-inner">
    <!-- Single item -->
    <div class="carousel-item active">
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(15).webp" class="d-block w-100" alt="Sunset Over the City"/>
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
      </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(22).webp" class="d-block w-100" alt="Canyon at Nigh"/>
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(23).webp" class="d-block w-100" alt="Cliff Above a Stormy Sea"/>
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
      </div>
    </div>
  </div>
  <!-- Inner -->

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- Carousel wrapper -->


<div class="container my-3">
    <div class="d-flex justify-content-between align-items-center w-100">
        <div class="mt-3">
            <h5>
                <i class="fa-solid fa-clapperboard"></i>sedang tayang
            </h5>
        </div>
        <div>
            <a href="#" class="btn btn-warning rounded-pill">semua</a>
        </div>
    </div>
    <div class="d-flex my-3 gap-2">
        <a href="#" class="btn btn-outline-primary rounded-pill" style="padding: 5px 10px !important"><small>semua film</small></a>
        <a href="#" class="btn btn-outline-primary rounded-pill" style="padding: 5px 10px !important"><small>XXI</small></a>
        <a href="#" class="btn btn-outline-primary rounded-pill" style="padding: 5px 10px !important"><small>CGV</small></a>
        <a href="#" class="btn btn-outline-primary rounded-pill" style="padding: 5px 10px !important"><small>Cinepolis</small></a>
    </div>
    <div class="d-flex justify-content-center gap-2 my-3">
        <div class="card" style="width: 13rem;">
            <img src="https://asset.tix.id/wp-content/uploads/2025/07/d8b1ece7-68b4-4958-a74b-e3925d63b475.webp" class="card-img-top" alt="testimoni">
            <div class="card-body" style="padding: 0 !important">
                <p class="card-text text-center bg-primary py-2">
                    <a href="#" class="text-warning"><b>beli tiket</b></a>
                </p>
            </div>
        </div>
        <div class="card" style="width: 13rem;">
            <img src="https://asset.tix.id/wp-content/uploads/2025/08/98b61540-970e-45d2-bb6e-5574dcb71ee4.webp " class="card-img-top" alt="testimoni">
            <div class="card-body" style="padding: 0 !important">
                <p class="card-text text-center bg-primary py-2">
                    <a href="#" class="text-warning"><b>beli tiket</b></a>
                </p>
            </div>
        </div>
        <div class="card" style="width: 13rem;">
            <img src="https://asset.tix.id/wp-content/uploads/2025/07/58c5c13f-18fc-42b0-a20a-67555f18deef.webp" class="card-img-top" alt="testimoni">
            <div class="card-body" style="padding: 0 !important">
                <p class="card-text text-center bg-primary py-2">
                    <a href="{{ route('schedules.detail') }}" class="text-warning"><b>beli tiket</b></a>
                </p>
            </div>
        </div>
        <div class="card" style="width: 13rem;">
            <img src="https://asset.tix.id/wp-content/uploads/2025/08/0f3dcf97-2f5d-4310-8648-f196b320066b.webp " class="card-img-top" alt="testimoni">
            <div class="card-body" style="padding: 0 !important">
                <p class="card-text text-center bg-primary py-2">
                    <a href="#" class="text-warning"><b>beli tiket</b></a>
                </p>
            </div>
        </div>
    </div>
</div>

<footer class="bg-body-tertiary text-center text-lg-start mt-5">
    <div class="text-center p-3" style="background-color: rgba(0,0,0,0.05);">
        © 2024 Copyright:
        <a class="text-body" href="https://mdbootstrap.com/">tix.id</a>
    </div>
</footer>
@endsection
