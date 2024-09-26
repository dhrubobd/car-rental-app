@extends('layout.dashboard')
@section('content')
<div id="contentRef" class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card px-5 py-5">
                    <div class="row justify-content-between ">
                        <div class="align-items-center col">
                            <h4>Super Car Rental Dashboard</h4>
                        </div>
                    </div>
                    <hr class="bg-dark "/>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
                            <div class="card card-plain h-100 bg-info">
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                            <div class="text-white">
                                                <h3 class="mb-0 text-capitalize font-weight-bold text-white">
                                                    <span id="totalCars"></span>
                                                </h3>
                                                <p class="mb-0 text-lg">Total Number of Cars</p>
                                            </div>
                                        </div>
                                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                            <div class="bg-gradient-secondary shadow float-end border-radius-md">
                                                <img class="w-100 " src="./images/car.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
                            <div class="card card-plain h-100 bg-info">
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                            <div class="text-white">
                                                <h3 class="mb-0 text-capitalize font-weight-bold text-white">
                                                    <span id="availableCars"></span>
                                                </h3>
                                                <p class="mb-0 text-lg">Number of Available Cars</p>
                                            </div>
                                        </div>
                                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                            <div class="bg-gradient-secondary shadow float-end border-radius-md">
                                                <img class="w-100 " src="./images/car.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
                            <div class="card card-plain h-100 bg-info">
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                            <div class="text-white">
                                                <h3 class="mb-0 text-capitalize font-weight-bold text-white">
                                                    <span id="totalRentals"></span>
                                                </h3>
                                                <p class="mb-0 text-lg">Total Number of Rentals (Completed)</p>
                                            </div>
                                        </div>
                                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                            <div class="bg-gradient-secondary shadow float-end border-radius-md">
                                                <img class="w-100 " src="./images/car.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
                            <div class="card card-plain h-100 bg-info">
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                            <div class="text-white">
                                                <h3 class="mb-0 text-capitalize font-weight-bold text-white">
                                                    <span id="totalEarnings">$</span>
                                                </h3>
                                                <p class="mb-0 text-lg">Total Earnings from (Completed) Rentals</p>
                                            </div>
                                        </div>
                                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                            <div class="bg-gradient-secondary shadow float-end border-radius-md">
                                                <img class="w-100 " src="./images/car.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    getData();
    
    
    async function getData() {
    
    
        showLoader();
        let res=await axios.post("/dashboard/dashboard-data");

        let totalCars=$("#totalCars");
        let availableCars=$("#availableCars");
        let totalRentals=$("#totalRentals");
        let totalEarnings=$("#totalEarnings");
        
        totalCars.append(res.data.totalCars);
        availableCars.append(res.data.availableCars);
        totalRentals.append(res.data.totalRentals);
        totalEarnings.append(res.data.totalEarnings);
        hideLoader();
    }
    
    
    </script>
@endsection