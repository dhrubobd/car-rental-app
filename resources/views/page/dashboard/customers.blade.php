@extends('layout.dashboard')
@section('content')
<div id="contentRef" class="content">
    <div class="container-fluid">
        <div class="row">
            Customers
        </div>
    </div>
</div>
<script>

    getData();
    
    
    async function getData() {
    
    
        showLoader();
        let res=await axios.get("/dashboard/customer-data");

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