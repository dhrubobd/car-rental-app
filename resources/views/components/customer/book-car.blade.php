<div class="modal animated zoomIn" id="car-book-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Book The Car</h5>
            </div>
            <div class="modal-body">
                <form id="car-book-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">From</label>
                                <input type="date" class="form-control" id="formDate">
                                <label class="form-label mt-2">To</label>
                                <input type="date" class="form-control" id="toDate">
                                <input type="text" class="d-none" id="carID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="bookCar()" id="update-btn" class="btn bg-gradient-success" >Confirm</button>
            </div>

        </div>
    </div>
</div>


<script>

async function setupID(id) {
    document.getElementById('carID').value=id;
}

async function bookCar(){
    
    let fromDate = document.getElementById('formDate').value;
    let toDate = document.getElementById('toDate').value;
    
    //alert(present_date.getTime());
    if(fromDate.length === 0){
        errorToast("From Date Can't be empty!");
    }else if(toDate.length === 0){
        errorToast("To Date Can't be empty!");
    } else {
        let date1 = new Date(fromDate);
        let date2 = new Date(toDate);
        let dateDiffence = date2.getTime() - date1.getTime();
        let bookingDays = Math.round (dateDiffence / (1000 * 3600 * 24));
        if(bookingDays<0){
            errorToast("To Date Can't Be less than From Date.");
        } 
        else 
        {
            bookingDays=bookingDays+1;
            let carID=document.getElementById('carID').value;
            let formData=new FormData();
            formData.append('carID',carID);
            formData.append('fromDate',fromDate);
            formData.append('toDate',toDate);
            formData.append('bookingDays',bookingDays);
            showLoader();
            //debugger;
            let res = await axios.post("/book-car",formData);
            //console.info(res);
            hideLoader();
            if(res.status===201){
                successToast('Request completed');
                window.location.href="/manage-bookings";
            }
            else{
                //errorToast(res.data.msg);
                errorToast('Request Failed!');
            }
        }
    }
}
</script>
