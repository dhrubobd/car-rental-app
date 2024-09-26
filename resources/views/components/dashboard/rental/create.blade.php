<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create A New Rental</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label mt-2">Customer Name</label>
                                <select type="text" class="form-control form-select" id="rentalCustomerID">
                                </select>

                                <label class="form-label mt-2">Car Details</label>
                                <select type="text" class="form-control form-select" id="rentalCarID">
                                </select>

                                <label class="form-label mt-2">Start Date</label>
                                <input type="date" class="form-control" id="fromDate">

                                <label class="form-label mt-2">End Date</label>
                                <input type="date" class="form-control" id="toDate">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="createRental()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    async function createRental() {

        let rentalCustomerID = document.getElementById('rentalCustomerID').value;
        let rentalCarID = document.getElementById('rentalCarID').value;
        let fromDate = document.getElementById('fromDate').value;
        let toDate = document.getElementById('toDate').value;
        
        if (rentalCustomerID.length === 0) {
            errorToast("Please Select A Customer !")
        }
        else if(rentalCarID.length===0){
            errorToast("Please Select A Car !")
        }
        else if(fromDate.length===0){
            errorToast("Please Select A Starting Date !")
        }
        else if(toDate.length===0){
            errorToast("Please Select A Ending Date !")
        }
        else {
            
            let date1 = new Date(fromDate);
            let date2 = new Date(toDate);
            let dateDifference = date2.getTime() - date1.getTime();
            let bookingDays = Math.round (dateDifference / (1000 * 3600 * 24));

            if(bookingDays<0){
                errorToast("To Date Can't Be less than From Date.");
            } 
            else 
            {
                
                document.getElementById('modal-close').click();
                bookingDays = bookingDays + 1;
                let formData=new FormData();
                formData.append('customerID',rentalCustomerID)
                formData.append('carID',rentalCarID)
                formData.append('fromDate',fromDate)
                formData.append('toDate',toDate)
                formData.append('bookingDays',bookingDays)

                showLoader();
                //debugger;
                let res = await axios.post("/dashboard/create-rental",formData);
                //console.info(res);
                hideLoader();

                if(res.status===201){
                    successToast('Rental is Created');
                    document.getElementById("save-form").reset();
                    await getList();
                }
                else{
                    errorToast(res.data.msg)
                }
            }
        }
    }
</script>
