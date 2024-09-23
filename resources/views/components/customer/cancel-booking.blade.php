<div class="modal animated zoomIn" id="booking-cancel-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel Booking</h5>
            </div>
            <div class="modal-body">
                <form id="car-book-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                Are You Sure?
                                <input type="text" class="d-none" id="bookingID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="cancelBooking()" id="update-btn" class="btn bg-gradient-success" >Confirm</button>
            </div>

        </div>
    </div>
</div>


<script>

async function setupID(id) {
    document.getElementById('bookingID').value=id;
}

async function cancelBooking(){
            let bookingID=document.getElementById('bookingID').value;
            let formData=new FormData();
            formData.append('bookingID',bookingID);
            showLoader();
            //debugger;
            let res = await axios.post("/cancel-booking",formData);
            //console.info(res);
            hideLoader();
            if(res.status===200 && res.data===1){
                successToast('Request completed');
                window.location.href="/manage-bookings";
            }
            else{
                errorToast('Failed');
            }
}
</script>
