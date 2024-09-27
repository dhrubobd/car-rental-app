@extends('layout.front-end')
@section('content')
    <section class="pb-5">
        <div class="container pt-2">
            <div class="row align-items-center mb-5">
                <div class="col-12">
                    <h3 class=" fw-bold mb-3">Contact Us</h3>
                    <hr>
                    <p class="lead text-muted mb-4">
                        We’re here to help! Whether you have questions about our fleet, need assistance with your reservation, or want to learn more about our services, our friendly team at Super Car Rental is ready to assist you.
                    </p>
                    <div class="row">
                        <div class="col-4">
                            <h5 class="fw-bold mb-3">Phone</h5>
                            <p class="text-muted mb-4">
                                For immediate assistance, give us a call at:</br>
                                <a>+880 123456789</a></br>
                                Our customer support team is available 24/7 to answer your questions.
                            </p>
                            <h5 class="fw-bold mb-3">Email</h5>
                            <p class="text-muted mb-4">
                                Prefer to reach out via email? Send us a message at:</br>
                                <a>info@superrental.com</a></br>
                                We aim to respond to all inquiries within 24 hours.
                            </p>
                            <h5 class="fw-bold mb-3">Locations</h5>
                            <p class="text-muted mb-4">
                                Visit us at one of our convenient locations:</br>
                                <span class="text-info">Gulshan Avenue, Dhaka Bangladesh</span></br>
                                Feel free to stop by during our business hours to speak with our team in person!
                            </p>
                        </div>
                        <div class="col-8">
                            <h5 class="fw-bold mb-3">Get in Touch</h5>
                            <form style="width: 100%">
                                <!-- Name input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label lead" for="form4Example1">Name</label>
                                    <input type="text" id="form4Example1" class="form-control" />
                                  
                                </div>
                              
                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label lead" for="form4Example2">Email address</label>
                                    <input type="email" id="form4Example2" class="form-control" />
                                </div>
                              
                                <!-- Message input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label lead" for="form4Example3">Message</label>
                                    <textarea class="form-control" id="form4Example3" rows="4"></textarea>
                                </div>
                              
                                <!-- Submit button -->
                                <button data-mdb-ripple-init type="button" class="btn btn-primary btn-block mb-4 lead">Send</button>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection