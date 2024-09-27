<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update The Rental Info</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Customer Name</label>
                                <select type="text" class="form-control form-select" id="rentalCustomerIDUpdate" disabled>
                                </select>

                                <label class="form-label mt-2">Car Details</label>
                                <select type="text" class="form-control form-select" id="rentalCarIDUpdate" disabled> 
                                </select>

                                <label class="form-label mt-2">Start Date</label>
                                <input type="date" class="form-control" id="fromDateUpdate" readonly>

                                <label class="form-label mt-2">End Date</label>
                                <input type="date" class="form-control" id="toDateUpdate" readonly>

                                <label class="form-label mt-2">Rental Status</label>
                                <select type="text" class="form-control form-select" id="rentalStatusUpdate">
                                    <option value="ongoing">ongoing</option>
                                    <option value="completed">completed</option>
                                    <option value="cancelled">cancelled</option>
                                </select>
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


    async function fillUpUpdateForm(id){

        $("#rentalCustomerIDUpdate").find("option").remove();
        $("#rentalCarIDUpdate").find("option").remove();
        
        let res = await axios.post("/dashboard/list-customer");
        res.data.forEach(function (item,i) {
            let option=`<option value="${item['id']}">${item['name']}</option>`
            $("#rentalCustomerIDUpdate").append(option);
        })
        
        let res2 = await axios.post("/dashboard/list-available-car");
        res2.data.forEach(function (item,i) {
            let option=`<option value="${item['id']}">${item['name']}  - ${item['brand']} - ${item['car_type']}</option>`
            $("#rentalCarIDUpdate").append(option);
        })
        
        document.getElementById('updateID').value=id;


        showLoader();
        //debugger;
        let res3=await axios.post("/dashboard/rental-by-id",{id:id});
        //console.info(res3);
        hideLoader();
        
        document.getElementById('rentalCustomerIDUpdate').value = res3.data['user_id'];
        document.getElementById('rentalCarIDUpdate').value = res3.data['car_id'];
        document.getElementById('fromDateUpdate').value=res3.data['start_date'];
        document.getElementById('toDateUpdate').value=res3.data['end_date'];
        document.getElementById('rentalStatusUpdate').value = res3.data['status'];
        
    }



    async function update() {

        let rentalStatus = document.getElementById('rentalStatusUpdate').value;
        let updateID=document.getElementById('updateID').value;


        if(rentalStatus.length===0){
            errorToast("Rental Status is Required !")
        }

        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('rentalID',updateID)
            formData.append('rentalStatus',rentalStatus)

            showLoader();
            //debugger;
            let res = await axios.post("/dashboard/update-rental",formData);
            //console.info(res);
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast('Rental Status is Updated');
                document.getElementById("update-form").reset();
                await getList();
            }
            else{
                errorToast("Update Request fail !")
            }
        }
    }
</script>
