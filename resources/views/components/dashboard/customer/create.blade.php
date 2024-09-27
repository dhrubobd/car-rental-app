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
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="customerName">

                                <label class="form-label mt-2">Email</label>
                                <input type="text" class="form-control" id="customerEmail">

                                <label class="form-label mt-2">Phone</label>
                                <input type="text" class="form-control" id="customerPhone">

                                <label class="form-label mt-2">Address</label>
                                <input type="text" class="form-control" id="customerAddress">

                                <label class="form-label mt-2">Password</label>
                                <input type="text" class="form-control" id="customerPassword">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>


    async function Save() {

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
