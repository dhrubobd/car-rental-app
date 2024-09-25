@extends('layout.dashboard')
@section('content')
@include('components.dashboard.car.create')
@include('components.dashboard.car.delete')
@include('components.dashboard.car.update')
<div id="contentRef" class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card px-5 py-5">
                    <div class="row justify-content-between ">
                        <div class="align-items-center col">
                            <h4>Car Management</h4>
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
                                <th>Car Photo</th>
                                <th>Car Details</th>
                                <th>Rent Price</th>
                                <th>Availability Status</th>
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
        debugger;
        let res=await axios.post("/dashboard/car-data");
        console.info(res);
        hideLoader();

        let tableList=$("#tableList");
        let tableData=$("#tableData");
        
        tableData.DataTable().destroy();
        tableList.empty();
        let availabilityStatus = "";
        res.data.forEach(function (item,index) {
            if(item['availability']==true){
                availabilityStatus = "Available";
            }else{
                availabilityStatus = "Not Available";
            }
            let row=`<tr>
                        <td><img class="w-50 h-auto" alt="" src="../${item['image']}"></td>
                        <td>
                            <strong>Car Name:</strong> ${item['name']} <br/>
                            <strong>Brand:</strong> ${item['brand']}<br/>
                            <strong>Model:</strong> ${item['model']}<br/>
                            <strong>Year of Manufacture:</strong> ${item['year']}<br/>
                            <strong>Car Type:</strong> ${item['car_type']}
                        </td>
                        <td>${item['daily_rent_price']}</td>
                        <td>${availabilityStatus}</td>
                        <td>
                            <button data-path="${item['image']}" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-path="${item['image']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                     </tr>`;
            tableList.append(row);
        })
    
        $('.editBtn').on('click', async function () {
           let id= $(this).data('id');
           let imagePath= $(this).data('path');
           await FillUpUpdateForm(id,imagePath)
           $("#car-update-modal").modal('show');
        })

        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            let imagePath = $(this).data('path');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
            $("#deleteFilePath").val(imagePath)

        })
        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu: [10, 25, 50, 75, 100]
        });
    
    }
    
    
</script>
@endsection