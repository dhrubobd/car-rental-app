<div class="modal animated zoomIn" id="rental-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Rental Details</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="table-responsive">
                                    <table class="table" id="tableRentalData">
                                        <thead>
                                        <tr class="bg-light">
                                            <th>Booking ID</th>
                                            <th>Starting Date</th>
                                            <th>Ending Date</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tableRentalList">
                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="rental-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>

        </div>
    </div>
</div>


<script>

    async function showRentalDetails(id){

        showLoader();
        //debugger;
        let res=await axios.post("/dashboard/customer-rentals",{id:id});
        //console.info(res);
        hideLoader();

        let tableRentalList=$("#tableRentalList");
        let tableRentalData=$("#tableRentalData");
        
        tableRentalData.DataTable().destroy();
        tableRentalList.empty();
        
        res.data.forEach(function (item,index) {
            let row=`<tr>
                        <td>${item['id']}</td>
                        <td>${item['start_date']}</td>
                        <td>${item['end_date']}</td>
                        <td>$${item['total_cost']}</td>
                        <td>${item['status']}</td>
                       </tr>`;
            tableRentalList.append(row);
        })

        new DataTable('#tableRentalData',{
            order:[[0,'desc']],
            lengthMenu: [10, 25, 50, 75, 100]
        });

    }
</script>
