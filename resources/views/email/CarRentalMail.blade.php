<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
            <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Booking Success!</a>
        </div>
        <p style="font-size:1.1em">{{$customerName}}  recently booked a car.</p>
        <p>Here is the details of the rental:</p>
        <p><strong>Car Name:</strong> {{$carName}} </p>
        <p><strong>Rental Begining Date:</strong> {{$beginDate}} </p>
        <p><strong>Rental Ending Date:</strong> {{$endDate}} </p>
        <p><strong>Amount To be Paid:</strong>${{$totalAmount}} </p>
        <hr style="border:none;border-top:1px solid #eee" />
        <p style="font-size:1em;">With Regards,<br />Super Car Rentals</p>
        
    </div>
</div>