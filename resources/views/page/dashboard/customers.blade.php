@extends('layout.dashboard')
@section('content')
@include('components.dashboard.customer.create')
@include('components.dashboard.customer.delete')
@include('components.dashboard.customer.update')
@include('components.dashboard.customer.rental')
<div id="contentRef" class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card px-5 py-5">
                    <div class="row justify-content-between ">
                        <div class="align-items-center col">
                            <h4>Customer Management</h4>
                        </div>
                        <div class="align-items-center col">
                            <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0  bg-gradient-primary">Create</button>
                        </div>
                    </div>
                    <hr class="bg-dark "/>
                    <div class="table-responsive">
                        <table class="table" id="tableData">
                            <thead>
                            <tr class="bg-light">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
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
</div>
<script>

getList();
    
    
    async function getList() {
    
    
        showLoader();
        //debugger;
        let res=await axios.get("/dashboard/customer-data");
        //console.info(res);
        hideLoader();

        let tableList=$("#tableList");
        let tableData=$("#tableData");
        
        tableData.DataTable().destroy();
        tableList.empty();
        
        res.data.forEach(function (item,index) {
            let row=`<tr>
                        <td>${item['name']}</td>
                        <td>${item['email']}</td>
                        <td>${item['phone']}</td>
                        <td>${item['address']}</td>
                        <td>
                            <button data-path="" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-path="" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                            <button data-path="" data-id="${item['id']}" class="btn rentalHistoryBtn btn-sm btn-outline-info">Rental History</button>
                        </td>
                     </tr>`;
            tableList.append(row);
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
    
        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu: [10, 25, 50, 75, 100]
        });
    
    }
    
    
</script>
@endsection