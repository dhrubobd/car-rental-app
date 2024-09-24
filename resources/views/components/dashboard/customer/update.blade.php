<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer Info</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">


                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="customerNameUpdate">

                                <label class="form-label mt-2">Email</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">

                                <label class="form-label mt-2">Phone</label>
                                <input type="text" class="form-control" id="customerPhoneUpdate">

                                <label class="form-label mt-2">Address</label>
                                <input type="text" class="form-control" id="customerAddressUpdate">

                                <label class="form-label mt-2">Password</label>
                                <input type="text" class="form-control" id="customerPasswordUpdate">

                                <input type="text" class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>

        </div>
    </div>
</div>


<script>


    async function FillUpUpdateForm(id){

        document.getElementById('updateID').value=id;


        showLoader();
        //debugger;
        let res=await axios.post("/dashboard/customer-by-id",{id:id});
        //console.info(res);
        hideLoader();

        document.getElementById('customerNameUpdate').value=res.data['name'];
        document.getElementById('customerEmailUpdate').value=res.data['email'];
        document.getElementById('customerPhoneUpdate').value=res.data['phone'];
        document.getElementById('customerAddressUpdate').value=res.data['address'];
        document.getElementById('customerPasswordUpdate').value=res.data['password'];

    }



    async function update() {

        let customerNameUpdate=document.getElementById('customerNameUpdate').value;
        let customerEmailUpdate = document.getElementById('customerEmailUpdate').value;
        let customerPhoneUpdate = document.getElementById('customerPhoneUpdate').value;
        let customerAddressUpdate = document.getElementById('customerAddressUpdate').value;
        let customerPasswordUpdate = document.getElementById('customerPasswordUpdate').value;
        let updateID=document.getElementById('updateID').value;


        if (customerNameUpdate.length === 0) {
            errorToast("Customer Name Required !")
        }
        else if(customerEmailUpdate.length===0){
            errorToast("Customer Email Required !")
        }
        else if(customerPhoneUpdate.length===0){
            errorToast("Customer Phone Required !")
        }
        else if(customerAddressUpdate.length===0){
            errorToast("Customer Address Required !")
        }
        else if(customerPasswordUpdate.length===0){
            errorToast("Customer Password Required !")
        }

        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('name',customerNameUpdate)
            formData.append('id',updateID)
            formData.append('email',customerEmailUpdate)
            formData.append('phone',customerPhoneUpdate)
            formData.append('address',customerAddressUpdate)
            formData.append('password',customerPasswordUpdate)

            

            showLoader();
            let res = await axios.post("/dashboard/update-customer",formData)
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast('Request completed');
                document.getElementById("update-form").reset();
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>
