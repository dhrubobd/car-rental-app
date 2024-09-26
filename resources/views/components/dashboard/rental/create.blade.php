<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create A New Customer</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label mt-2">Customer Name</label>
                                <select type="text" class="form-control form-select" id="rentalCustomerName">
                                    <option value="">Choose A Castomer</option>
                                </select>

                                <label class="form-label mt-2">Car Details</label>
                                <select type="text" class="form-control form-select" id="rentalCarName">
                                    <option value="">Choose A Car</option>
                                </select>

                                <label class="form-label mt-2">Start Date</label>
                                <input type="date" class="form-control" id="formDate">

                                <label class="form-label mt-2">End Date</label>
                                <input type="date" class="form-control" id="toDate">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="saveRental()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    async function fillUpRentalDropdowns(){
        let res = await axios.post("/dashboard/list-customer");
        res.data.forEach(function (item,i) {
            let option=`<option value="${item['id']}">${item['name']}</option>`
            $("#rentalCustomerName").append(option);
        })
        let res2 = await axios.post("/dashboard/list-available-car");
        res2.data.forEach(function (item,i) {
            let option=`<option value="${item['id']}">${item['name']}  - ${item['brand']} - ${item['car_type']}</option>`
            $("#rentalCarName").append(option);
        })
    }

    async function saveRental() {

        let customerName = document.getElementById('customerName').value;
        let customerEmail = document.getElementById('customerEmail').value;
        let customerPhone = document.getElementById('customerPhone').value;
        let customerAddress = document.getElementById('customerAddress').value;
        let customerPassword = document.getElementById('customerPassword').value;

        if (customerName.length === 0) {
            errorToast("Name is Required !")
        }
        else if(customerEmail.length===0){
            errorToast("Email is Required !")
        }
        else if(customerPhone.length===0){
            errorToast("Phone Number is Required !")
        }
        else if(customerAddress.length===0){
            errorToast("Address is Required !")
        }
        else if(customerPassword.length===0){
            errorToast("Password is Required !")
        }

        else {

            document.getElementById('modal-close').click();

            let formData=new FormData();
            formData.append('customerName',customerName)
            formData.append('customerEmail',customerEmail)
            formData.append('customerPhone',customerPhone)
            formData.append('customerAddress',customerAddress)
            formData.append('customerPassword',customerPassword)

            showLoader();
            //debugger;
            let res = await axios.post("/dashboard/create-customer",formData);
            //console.info(res);
            hideLoader();

            if(res.status===201){
                successToast('Customer Profile Created');
                document.getElementById("save-form").reset();
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>
