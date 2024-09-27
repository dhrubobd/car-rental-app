<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create A New Car For Rental</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="carName">

                                <label class="form-label mt-2">Brand</label>
                                <input type="text" class="form-control" id="carBrand">

                                <label class="form-label mt-2">Model</label>
                                <input type="text" class="form-control" id="carModel">

                                <label class="form-label mt-2">Year of Manufacture</label>
                                <input type="number" class="form-control" id="carYear">

                                <label class="form-label mt-2">Car Type</label>
                                <input type="text" class="form-control" id="carType">

                                <label class="form-label mt-2">Rent Price</label>
                                <input type="number" class="form-control" id="carRentPrice">

                                <label class="form-label mt-2">Availability Status</label>
                                <select type="text" class="form-control form-select" id="carAvailability">
                                    <option value="">Choose Car Availability</option>
                                    <option value="1">Available</option>
                                    <option value="2">Not Available</option>
                                </select>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="carImg">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="saveCar()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>


    async function saveCar() {

        let carName = document.getElementById('carName').value;
        let carBrand = document.getElementById('carBrand').value;
        let carModel = document.getElementById('carModel').value;
        let carYear = document.getElementById('carYear').value;
        let carType = document.getElementById('carType').value;
        let carRentPrice = document.getElementById('carRentPrice').value;
        let carAvailability = document.getElementById('carAvailability').value;
        let carImg = document.getElementById('carImg').files[0];

        if (carName.length === 0) {
            errorToast("Car Name is Required !")
        }
        else if(carBrand.length===0){
            errorToast("Car Brand is Required !")
        }
        else if(carModel.length===0){
            errorToast("Car Model is Required !")
        }
        else if(carYear.length===0){
            errorToast("Car Manufacturing Year is Required !")
        }
        else if(carType.length===0){
            errorToast("Car Type is Required !")
        }
        else if(carRentPrice.length===0){
            errorToast("Daily Rental Price is Required !")
        }
        else if(carAvailability.length===0){
            errorToast("Car Availability Status is Required !")
        }
        else if(!carImg){
            errorToast("Car Image Required !")
        }
        else {

            document.getElementById('modal-close').click();

            let formData=new FormData();
            formData.append('carName',carName)
            formData.append('carBrand',carBrand)
            formData.append('carModel',carModel)
            formData.append('carYear',carYear)
            formData.append('carType',carType)
            formData.append('carRentPrice',carRentPrice)
            formData.append('carAvailability',carAvailability)
            formData.append('carImg',carImg)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            debugger;
            let res = await axios.post("/dashboard/create-car",formData,config);
            console.info(res);
            hideLoader();

            if(res.status===201){
                successToast('Car Profile Created');
                document.getElementById("save-form").reset();
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>
