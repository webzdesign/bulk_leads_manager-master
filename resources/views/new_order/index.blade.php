@extends('layouts.master')
@section('content')
    <div class="middleContent">
        <div class="settingWrpr importWrpr newOrderWrpr">
            <ul class="m-0 importStep row justify-content-center">
                <li class="stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
                    <div class="countStep">
                        <span class="text-white f-16 f-700 d-flex align-items-center justify-content-center">1</span>
                        <svg class="d-none" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="16" fill="url(#paint0_linear_1652_6208)"/>
                            <path d="M9.33325 16L14.3333 21L22.6666 11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <defs>
                            <linearGradient id="paint0_linear_1652_6208" x1="16" y1="0" x2="16" y2="32" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#63B967"/>
                            <stop offset="1" stop-color="#4BA64F"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <p class="mb-0">Client Details</p>
                </li>
                <li class="stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
                    <div class="countStep">
                        <span class="text-white f-16 f-700 d-flex align-items-center justify-content-center">2</span>
                        <svg class="d-none" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="16" fill="url(#paint0_linear_1652_6208)"/>
                            <path d="M9.33325 16L14.3333 21L22.6666 11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <defs>
                            <linearGradient id="paint0_linear_1652_6208" x1="16" y1="0" x2="16" y2="32" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#63B967"/>
                            <stop offset="1" stop-color="#4BA64F"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <p class="mb-0">Product Details</p>
                </li>
                <li class="stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
                    <div class="countStep">
                        <span class="text-white f-16 f-700 d-flex align-items-center justify-content-center">3</span>
                        <svg class="d-none" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="16" fill="url(#paint0_linear_1652_6208)"/>
                            <path d="M9.33325 16L14.3333 21L22.6666 11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <defs>
                            <linearGradient id="paint0_linear_1652_6208" x1="16" y1="0" x2="16" y2="32" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#63B967"/>
                            <stop offset="1" stop-color="#4BA64F"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <p class="mb-0">Leads Details</p>
                </li>
                <li class="stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
                    <div class="countStep">
                        <span class="text-white f-16 f-700 d-flex align-items-center justify-content-center">4</span>
                    </div>
                    <p class="mb-0">Confimation</p>
                </li>
            </ul>
            <div>
                <div class="step active">
                    <div class="cards">
                        <div class="cardsHeader">
                            <span class="f-18 f-600 f-16-500 c-gr f-700">Client Details</span>
                        </div>
                        <div class="cardsBody">
                            <div class="emailBlock">
                                <div class="d-flex align-items-center d-block-768">
                                    <label class="f-16 f-500 c-gr col-order-1">Email:</label>
                                    <div class="col-order-2 position-relative">
                                        <input type="text" placeholder="Enter email address" class="form-control" name="filter_client_email">
                                        <div class="emailErrorDiv text-center position-absolute bg-white">
                                            <div class="loadingClient c-7b f-14 f-400">
                                                Searching client with same email address
                                                <img src="{{ asset('public/assets/images/Spinner.svg') }}" alt="loader" width="30" height="30" class="loader_image">
                                            </div>

                                            <div class="email_list">
                                                <!-- Loading -->
                                            </div>

                                            <span class="c-e9 f-14 f-400 d-block mb-2 email_not_match"></span>
                                            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#Client">Add client</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clientBlock emailBlock d-none">
                                <div class="d-flex align-items-center d-block-768">
                                    <label class="f-16 f-500 c-gr col-order-1">Client:</label>
                                    <div class="col-order-2 position-relative">
                                        <select>
                                            <option value="hide">Select client details</option>
                                            <option>John Doe</option>
                                            <option>John Doe</option>
                                            <option>John Doe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="devider mt-4" style="background: #bfbfbf;"></div>
                            <div>
                                <h4 class="f-16 f-500 c-19 mt-4">Client Details</h4>
                                <div class="row uploadStatus">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="colOne c-gr f-16 f-500">First Name: </div>
                                            <div class="colTwo c-19 f-16 f-500">John</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="colOne c-gr f-16 f-500">Last Name:</div>
                                            <div class="colTwo c-19 f-16 f-500">Doe</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="colOne c-gr f-16 f-500">Email: </div>
                                            <div class="colTwo c-19 f-16 f-500">johndoe@gmail.com</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="colOne c-gr f-16 f-500">City:</div>
                                            <div class="colTwo c-19 f-16 f-500">Cavite City</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="colOne c-gr f-16 f-500">State:</div>
                                            <div class="colTwo c-19 f-16 f-500">GMA</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="colOne c-gr f-16 f-500">Country:</div>
                                            <div class="colTwo c-19 f-16 f-500">Philippines</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="colOne c-gr f-16 f-500">IP Address:</div>
                                            <div class="colTwo c-19 f-16 f-500">110.112.2122</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cardsFooter d-flex justify-content-end">
                            <button class="btn-primary f-500 f-14 next" style="min-width: 78px !important;">Next</button>
                        </div>
                    </div>
                </div>

                <div class="step">
                    <div class="cards">
                        <div class="cardsHeader">
                            <span class="f-18 f-600 f-16-500 c-gr f-700">Product Details</span>
                        </div>
                        <div class="cardsBody">
                            <div class="clientBlock emailBlock">
                                <div class="d-flex align-items-center mb-4 d-block-768">
                                    <label class="f-16 f-500 c-gr col-order-1">Lead Type:</label>
                                    <div class="col-order-2 position-relative">
                                        <select>
                                            <option value="hide">Select a lead type</option>
                                            <option>John Doe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-4 d-block-768">
                                    <label class="f-16 f-500 c-gr col-order-1">Lead Age:</label>
                                    <div class="col-order-2 position-relative">
                                        <select>
                                            <option value="hide">Enter lead age</option>
                                            <option>John Doe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-4 d-block-768">
                                    <label class="f-16 f-500 c-gr col-order-1">Quantity:</label>
                                    <div class="col-order-2 position-relative">
                                        <input type="text" placeholder="Enter quantity" class="form-control f-14">
                                    </div>
                                </div>
                                <div class="devider"></div>
                                <h4 class="f-14 f-500 c-19 my-4">OPTIONAL</h4>
                                <div class="d-flex align-items-center mb-4 d-block-768">
                                    <label class="f-16 f-500 c-gr col-order-1">Gender:</label>
                                    <div class="col-order-2 position-relative">
                                        <select>
                                            <option value="hide">Select gender</option>
                                            <option>John Doe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-4 d-block-768">
                                    <label class="f-16 f-500 c-gr col-order-1">State(s): </label>
                                    <div class="col-order-2 position-relative">
                                        <select>
                                            <option value="hide">Select states</option>
                                            <option>John Doe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cardsFooter d-flex justify-content-end">
                            <button class="btn-default f-500 f-14 prev" style="min-width: 78px !important;">Previous</button>
                            <button class="btn-primary f-500 f-14 next" style="min-width: 78px !important;">Next</button>
                        </div>
                    </div>
                </div>

                <div class="step stepLeadDetail">
                    <div class="cards">
                        <div class="cardsHeader">
                            <span class="f-18 f-600 f-16-500 c-gr f-700">Lead details</span>
                        </div>
                        <div class="cardsBody">
                            <div class="d-flex align-items-center mb-4 d-block-768">
                                <label class="f-16 f-500 c-gr col-order-1">Total Leads Available: </label>
                                <div class="col-order-2">
                                    <h3 class="f-16 f-500 c-19 mb-0">4,000 US Leads</h3>
                                </div>
                            </div>
                            <div class="d-flex align-items-center d-block-768">
                                <label class="f-16 f-500 c-gr col-order-1">Quantity to be Sent:</label>
                                <div class="col-order-2">
                                    <input type="text" placeholder="Enter the quantity of leads to be sent" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="cardsFooter d-flex justify-content-end">
                            <button class="btn-default f-500 f-14 prev">Cancel</button>
                            <button class="btn-primary f-500 f-14 next">Create order and email the leads<svg class="ms-2 position-relative bottom-1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.00033 0.666748C3.95033 0.666748 0.666992 3.95008 0.666992 8.00008C0.666992 12.0501 3.95033 15.3334 8.00033 15.3334C12.0503 15.3334 15.3337 12.0501 15.3337 8.00008C15.3337 3.95008 12.0503 0.666748 8.00033 0.666748ZM6.52899 5.80475C6.40755 5.67901 6.34036 5.51061 6.34188 5.33581C6.3434 5.16102 6.41351 4.99381 6.53711 4.8702C6.66072 4.7466 6.82793 4.67648 7.00273 4.67497C7.17752 4.67345 7.34592 4.74064 7.47166 4.86208L10.1383 7.52875C10.2633 7.65377 10.3335 7.82331 10.3335 8.00008C10.3335 8.17686 10.2633 8.3464 10.1383 8.47141L7.47166 11.1381C7.34592 11.2595 7.17752 11.3267 7.00273 11.3252C6.82793 11.3237 6.66072 11.2536 6.53711 11.13C6.41351 11.0064 6.3434 10.8391 6.34188 10.6643C6.34036 10.4896 6.40755 10.3211 6.52899 10.1954L8.72433 8.00008L6.52899 5.80475Z" fill="white"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="step stepConfirmation">
                    <div class="cards">
                        <div class="cardsHeader">
                            <span class="f-18 f-600 f-16-500 c-gr f-700">Confirmation</span>
                        </div>
                        <div class="cardsBody text-center">
                            <svg class="mt-2" width="100" height="100" viewBox="0 0 100 102" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M99.458 76.4167L74.0413 101.833L56.2497 84.0417L63.8747 76.4167L74.0413 86.5834L91.833 68.7917L99.458 76.4167ZM10.4997 0.166748C4.85717 0.166748 0.333008 4.69091 0.333008 10.3334V91.6667C0.333008 97.3092 4.85717 101.833 10.4997 101.833H50.2005C47.5063 97.2076 46.083 91.9209 46.083 86.5834C46.083 84.9059 46.2355 83.1776 46.4897 81.5001H10.4997V71.3334H50.2005C52.5388 67.2667 55.7922 63.7084 59.7063 61.1667H10.4997V51.0001H71.4997V56.4901C73.1772 56.2359 74.9055 56.0834 76.583 56.0834C78.3113 56.0834 79.9888 56.2359 81.6663 56.4901V30.6667L51.1663 0.166748M46.083 7.79175L74.0413 35.7501H46.083V7.79175Z" fill="#6666EA"/>
                            </svg>
                            <h3 class="f-18 f-16-500 f-400 c-gr mt-4">Leads were sent to <a href="javascript:;" class="c-16">client@gmail.com</a> and a copy was emailed to the admin.</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade fieldsModal groupModal" id="Client">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Client</h4>
                </div>

                <!-- Modal body -->
                <form id="form" method="post" action="">
                    @csrf

                    <div class="modal-body">
                        <div class="row align-items-center mb-4 mx-0">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">First Name:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control f-14 c-19" name="first_name" placeholder="Enter first name">
                            </div>
                        </div>
                        <div class="row align-items-center mb-4 mx-0">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">Last Name:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control f-14 c-19" name="last_name" placeholder="Enter last name">
                            </div>
                        </div>
                        <div class="row align-items-center mb-4 mx-0">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">Email:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control f-14 c-19" name="email" placeholder="Enter email address">
                            </div>
                        </div>
                        <div class="row align-items-center mb-4 mx-0">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">City:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control f-14 c-19" name="city" placeholder="Enter city">
                            </div>
                        </div>
                        <div class="row align-items-center mb-4 mx-0">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">State:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control f-14 c-19" name="state" placeholder="Enter state">
                            </div>
                        </div>
                        <div class="row align-items-center mb-4 mx-0">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">Country:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control f-14 c-19" name="country" placeholder="Enter country">
                            </div>
                        </div>
                        <div class="row align-items-center mb-4 mx-0">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">IP Address</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control f-14 c-19" name="ip_address" placeholder="Enter IP address" value="{{ Request::ip();                                }}">
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn-primary btn_submit" style="min-width: 74px;">Add Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $("#form").validate({
                rules:{
                    first_name: {required: true},
                    last_name: {required: true},
                    email: {required: true, email:true},
                    city: {required: true},
                    state: {required: true},
                    country: {required: true},
                    ip_address: {required: true},
                },
                messages:{
                    first_name:{required: "This fields is required."},
                    last_name:{required: "This fields is required."},
                    email:{required: "This fields is required.", email:"Please enter valid email formate"},
                    city:{required: "This fields is required."},
                    state:{required: "This fields is required."},
                    country:{required: "This fields is required."},
                    ip_address:{required: "This fields is required."},
                },
                errorPlacement: function(error, element) {
                    error.addClass('text-danger f-400 f-14').appendTo(element.parent("div"));
                }
            });

            $(document).on('click','.btn_submit',function(){
                if($('#form').valid()){
                    var datastring = $("#form").serialize();

                    $.ajax({
                        type: "POST",
                        url: "{{ url('new-order/create-client') }}",
                        dataType: "json",
                        data: datastring,
                        success: function(response) {
                            if (response) {
                                Swal.fire({
                                    icon: "success",
                                    title: 'Success',
                                    text: response[1].message,
                                });

                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            }else {
                                Swal.fire({
                                    icon: "error",
                                    title: 'Opps!',
                                    text: response[1].message,
                                })
                            }
                        }
                    });
                }
            });

            //Email list in search
            $("[name='filter_client_email']").on("change paste keyup", function() {
                var filter_client_email = $(this).val();
                $('.email_list,.email_not_match').html('');

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.client.email-filter') }}",
                    dataType: "json",
                    data: {'email':filter_client_email},
                    success: function(response) {
                        if (response[1]) {
                            $('.email_list').html(response[1].html);
                            $('.loader_image').css({'display':'none'});
                        }else{
                            $('.loader_image').css({'display':'inline-block'});
                            $('.email_not_match').text('No client matched the email address you entered.');
                        }
                    }
                });
            });
        });
    </script>
@endsection
