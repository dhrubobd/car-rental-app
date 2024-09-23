@extends('layout.customer')
@section('content')
@include('components.customer.cancel-booking')
<div class="container my-3">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Your Bookings</h4>
                    </div>
                </div>
                <hr class="bg-dark "/>
                <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead>
                        <tr class="bg-light">
                            <th>Booking ID</th>
                            <th>Starting Date</th>
                            <th>Ending Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="tableList">
        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    getList();
    
    
    async function getList() {
    
    
        showLoader();
        let res=await axios.get("/list-bookings");
        hideLoader();

        let tableList=$("#tableList");
        let tableData=$("#tableData");
        let status="";
        
        tableData.DataTable().destroy();
        tableList.empty();
        
        res.data.forEach(function (item,index) {
            if(item['status']=="ongoing"){
                status = "<div class='text-warning bg-dark'>Please make payment within 24 hours to confirm the rental.</div>";
            }else if(item['status']=="completed"){
                status = "<div class='text-success'>You completed the payment. Have a nice trip!</div>";
            }else{
                status = "<div class='text-danger'>The booking is cancelled.</div>";
            }
            let row=`<tr>
                        <td>${item['id']}</td>
                        <td>${item['start_date']}</td>
                        <td>${item['end_date']}</td>
                        <td>${item['total_cost']}</td>
                        <td>${status}</td>
                        <td>   
                             <button data-path="" data-id="${item['id']}" class="btn cancelBtn btn-sm btn-outline-danger">Cancel Booking</button>    
                        </td>
                       </tr>`;
            tableList.append(row);
        })
    
        $('.cancelBtn').on('click', async function () {
               let id= $(this).data('id');
               await setupID(id);
               $("#booking-cancel-modal").modal('show');
        });
    
        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu: [10, 25, 50, 75, 100]
        });
    
    }
    
    
    </script>
@endsection