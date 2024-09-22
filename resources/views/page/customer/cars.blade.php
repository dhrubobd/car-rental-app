@extends('layout.customer')
@section('content')
@include('components.customer.book-car')
<div class="container my-3">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Available Cars For Rental</h4>
                    </div>
                </div>
                <hr class="bg-dark "/>
                <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead>
                        <tr class="bg-light">
                            <th>Car Photo</th>
                            <th>Car Details</th>
                            <th>Daily Rent Price</th>
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
        let res=await axios.get("/list-cars");
        hideLoader();

        let tableList=$("#tableList");
        let tableData=$("#tableData");
        
        tableData.DataTable().destroy();
        tableList.empty();
        
        res.data.forEach(function (item,index) {
            let row=`<tr>
                        <td><img class="w-100 h-auto" alt="" src="${item['image']}"></td>
                        <td>
                            <strong>Name:</strong> ${item['name']} <br/>
                            <strong>Brand:</strong> ${item['brand']}<br/>
                            <strong>Model:</strong> ${item['model']}<br/>
                            <strong>Year:</strong> ${item['year']}<br/>
                            <strong>Car Type:</strong> ${item['car_type']}
                        </td>
                        <td>${item['daily_rent_price']}</td>
                        <td>
                            <button data-path="${item['img_url']}" data-id="${item['id']}" class="btn bookBtn btn-sm btn-outline-info">Book Now</button>
                        </td>
                     </tr>`;
            tableList.append(row);
        })
    
        $('.bookBtn').on('click', async function () {
               let id= $(this).data('id');
               await setupID(id);
               $("#car-book-modal").modal('show');
        });
    
        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu: [10, 25, 50, 75, 100]
        });
    
    }
    
    
    </script>
@endsection