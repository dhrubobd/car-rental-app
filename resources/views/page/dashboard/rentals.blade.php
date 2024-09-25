@extends('layout.dashboard')
@section('content')
@include('components.dashboard.rental.create')
@include('components.dashboard.rental.delete')
@include('components.dashboard.rental.update')
<div id="contentRef" class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card px-5 py-5">
                    <div class="row justify-content-between ">
                        <div class="align-items-center col">
                            <h4>Rental Management</h4>
                        </div>
                        <div class="align-items-center col">
                            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0  bg-gradient-primary">Create</button>
                        </div>
                    </div>
                    <hr class="bg-dark "/>
                    <div class="table-responsive">
                        <table class="table" id="tableRentalData">
                            <thead>
                            <tr class="bg-light">
                                <th>Rental ID</th>
                                <th>Customer Name</th>
                                <th>Car Details</th>
                                <th>Rental Start Date</th>
                                <th>End Date</th>
                                <th>Total Cost</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="tableRentalList">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

getList();
    
    
    async function getList() {
    
    
        showLoader();
        debugger;
        let res=await axios.post("/dashboard/rental-data");
        console.info(res);
        hideLoader();

        let tableRentalList=$("#tableRentalList");
        let tableRentalData=$("#tableRentalData");
        
        tableRentalData.DataTable().destroy();
        tableRentalList.empty();
        
        res.data.forEach(function (item,index) {
            let row=`<tr>
                        <td>${item['id']}</td>
                        <td>${item['customer_name']}</td>
                        <td>
                            <strong>Car Name:</strong> ${item['car_name']}</br>
                            <strong>Car Brand:</strong> ${item['car_brand']}</br>
                        </td>
                        <td>${item['start_date']}</td>
                        <td>${item['end_date']}</td>
                        <td>${item['total_cost']}</td>
                        <td>${item['status']}</td>
                        <td>
                            <button data-path="" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-path="" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                     </tr>`;
            tableRentalList.append(row);
        })
    
        $('.editBtn').on('click', async function () {
           let id= $(this).data('id');
           await FillUpUpdateForm(id)
           $("#update-modal").modal('show');
        })

        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            let path= $(this).data('path');

            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
            $("#deleteFilePath").val(path)

        })

        $('.rentalHistoryBtn').on('click', async function () {
           let id= $(this).data('id');
           await showRentalDetails(id)
           $("#rental-modal").modal('show');
        })
    
        new DataTable('#tableRentalData',{
            order:[[0,'desc']],
            lengthMenu: [10, 25, 50, 75, 100]
        });
    
    }
    
    
</script>
@endsection