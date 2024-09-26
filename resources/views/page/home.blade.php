@extends('layout.front-end')
@section('content')
    <section class="pb-5">
        <div class="container pt-2">
            <div class="row align-items-center mb-5">
                <div class="col-12 col-md-10 col-lg-5 mb-5 mb-lg-0">
                    <h3 class=" fw-bold mb-3">Welcome to Super Car Rentals! </h3>
                    <h5 class=" fw-bold mb-3">Rent Our Cars To Save Your Time & Money. </h5>
                    <p class="lead text-muted mb-4">Just Login and choose a car from our latest stock then you are ready to GO!</p>
                    <div class="d-flex flex-wrap">
                        <a class="btn bg-gradient-primary mb-2 mb-sm-0" href="/login">Login / Signup</a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 offset-lg-1">
                        <img class="img-fluid" src="./images/hero.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection