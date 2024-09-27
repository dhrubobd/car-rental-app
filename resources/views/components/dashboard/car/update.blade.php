<div class="modal animated zoomIn" id="car-update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update The Car Info</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">


                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="carNameUpdate">

                                <label class="form-label mt-2">Brand</label>
                                <input type="text" class="form-control" id="carBrandUpdate">

                                <label class="form-label mt-2">Model</label>
                                <input type="text" class="form-control" id="carModelUpdate">

                                <label class="form-label mt-2">Year of Manufacture</label>
                                <input type="text" class="form-control" id="carYearUpdate">

                                <label class="form-label mt-2">Car Type</label>
                                <input type="text" class="form-control" id="carTypeUpdate">

                                <label class="form-label mt-2">Rent Price</label>
                                <input type="text" class="form-control" id="carRentPriceUpdate">

                                <label class="form-label mt-2">Availability Status</label>
                                <select type="text" class="form-control form-select" id="carAvailabilityUpdate">
                                    <option value="">Choose Car Availability</option>
                                    <option value="1">Available</option>
                                    <option value="2">Not Available</option>
                                </select>
                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="carImgUpdate">

                                <input type="text" class="d-none" id="updateID">
                                <input type="text" class="d-none" id="imagePath">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="updateCar()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>

        </div>
    </div>
</div>


<script>


    async function FillUpUpdateForm(id,imagePath){

        document.getElementById('updateID').value=id;
        document.getElementById('imagePath').value=imagePath;
        document.getElementById('oldImg').src="../".concat(imagePath);


        showLoader();
        debugger;
        let res=await axios.post("/dashboard/car-by-id",{id:id});
        console.info(res);
        hideLoader();

        document.getElementById('carNameUpdate').value=res.data['name'];
        document.getElementById('carBrandUpdate').value=res.data['brand'];
        document.getElementById('carModelUpdate').value=res.data['model'];
        document.getElementById('carYearUpdate').value=res.data['year'];
        document.getElementById('carTypeUpdate').value=res.data['car_type'];
        document.getElementById('carRentPriceUpdate').value=res.data['daily_rent_price'];
        
        if(res.data['availability']==1){
            document.getElementById('carAvailabilityUpdate').options[1].selected=true;
        }else{
            document.getElementById('carAvailabilityUpdate').options[2].selected=true;
        }
    }

    async function updateCar() {

        let carNameUpdate=document.getElementById('carNameUpdate').value;
        let carBrandUpdate = document.getElementById('carBrandUpdate').value;
        let carModelUpdate = document.getElementById('carModelUpdate').value;
        let carYearUpdate = document.getElementById('carYearUpdate').value;
        let carTypeUpdate = document.getElementById('carTypeUpdate').value;
        let carRentPriceUpdate = document.getElementById('carRentPriceUpdate').value;
        let carAvailabilityUpdate = document.getElementById('carAvailabilityUpdate').value;
        let productImgUpdate = document.getElementById('carImgUpdate').files[0];
        let updateID=document.getElementById('updateID').value;
        let imagePath=document.getElementById('imagePath').value;
        


        if (carNameUpdate.length === 0) {
            errorToast("Car Name is Required !")
        }
        else if(carBrandUpdate.length===0){
            errorToast("Car Brand is Required !")
        }
        else if(carModelUpdate.length===0){
            errorToast("Car Model is Required !")
        }
        else if(carYearUpdate.length===0){
            errorToast("Year of Manufacture is Required !")
        }
        else if(carRentPriceUpdate.length===0){
            errorToast("Daily Rental Price is Required !")
        }
        else if(carTypeUpdate.length===0){
            errorToast("Car Type is Required !")
        }
        else if(carAvailabilityUpdate.length===0){
            errorToast("Car Availability Status is Required !")
        }
        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('id',updateID)
            formData.append('carName',carNameUpdate)
            formData.append('carBrand',carBrandUpdate)
            formData.append('carModel',carModelUpdate)
            formData.append('carYear',carYearUpdate)
            formData.append('carType',carTypeUpdate)
            formData.append('carRentPrice',carRentPriceUpdate)
            formData.append('carAvailability',carAvailabilityUpdate)
            formData.append('carImage',carImgUpdate)
            formData.append('imagePath',imagePath)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/dashboard/update-car",formData,config)
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast('Car Information is Updated');
                document.getElementById("update-form").reset();
                await getList();
            }
            else{
                errorToast("Update Request failed !")
            }
        }
    }
</script>
