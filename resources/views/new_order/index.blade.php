@extends('layouts.master')
@section('content')
    <div class="middleContent">
        <div class="settingWrpr importWrpr newOrderWrpr">
            <ul class="m-0 importStep row justify-content-center">
                <li class="tab1 stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
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
                <li class="tab2 stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
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
                <li class="tab3 stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
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
                <li class="tab4 stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
                    <div class="countStep">
                        <span class="text-white f-16 f-700 d-flex align-items-center justify-content-center">4</span>
                    </div>
                    <p class="mb-0">Confimation</p>
                </li>
            </ul>
            <div>
                <form id="order_form" method="post">
                    @csrf
                    <input type="hidden" name="client_id" value="">
                    <input type="hidden" name="total_leads_available" value="">

                    <div class="step active step1">
                        <div class="cards">
                            <div class="cardsHeader">
                                <span class="f-18 f-600 f-16-500 c-gr f-700">Client Details</span>
                            </div>
                            <div class="cardsBody">
                                <div class="emailBlock">
                                    <div class="d-flex align-items-center d-block-768">
                                        <label class="f-16 f-500 c-gr col-order-1">Email:</label>
                                        <div class="col-order-2 position-relative">
                                            <input type="text" placeholder="Enter email address" class="form-control" name="filter_client_email"  id="filter_client_email" autocomplete="off">

                                            <div class="emailErrorDiv text-center position-absolute bg-white">
                                                <div class="loadingClient c-7b f-14 f-400">
                                                    Searching client with same email address
                                                    <img src="{{ asset('public/assets/images/Spinner.svg') }}" alt="loader" width="30" height="30" class="loader_image">
                                                </div>

                                                <div class="email_list">
                                                    <!-- Loading -->
                                                </div>

                                                <span class="c-e9 f-14 f-400 d-block mb-2 email_not_match"></span>
                                                <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#Client">Add client</button>
                                            </div>
                                        </div> &nbsp;
                                        <span class="text-danger" id="client_id_validate"></span>
                                    </div>
                                </div>
                                {{-- <div class="clientBlock emailBlock d-none">
                                    <div class="d-flex align-items-center d-block-768">
                                        <label class="f-16 f-500 c-gr col-order-1">Client:</label>
                                        <div class="col-order-2 position-relative">
                                            <select class="select2">
                                                <option value="hide">Select client details</option>
                                                <option>John Doe</option>
                                                <option>John Doe</option>
                                                <option>John Doe</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="devider mt-4" style="background: #bfbfbf;"></div>
                                <div>
                                    <h4 class="f-16 f-500 c-19 mt-4">Client Details</h4>
                                    <div class="row uploadStatus">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="colOne c-gr f-16 f-500">First Name: </div>
                                                <div class="colTwo c-19 f-16 f-500 first_name_text">--</div>
                                            </div>
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="colOne c-gr f-16 f-500">Last Name:</div>
                                                <div class="colTwo c-19 f-16 f-500 last_name_text">--</div>
                                            </div>
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="colOne c-gr f-16 f-500">Email: </div>
                                                <div class="colTwo c-19 f-16 f-500 email_text">--</div>
                                            </div>
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="colOne c-gr f-16 f-500">City:</div>
                                                <div class="colTwo c-19 f-16 f-500 city_text">--</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="colOne c-gr f-16 f-500">State:</div>
                                                <div class="colTwo c-19 f-16 f-500 state_text">--</div>
                                            </div>
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="colOne c-gr f-16 f-500">Country:</div>
                                                <div class="colTwo c-19 f-16 f-500 country_text">--</div>
                                            </div>
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="colOne c-gr f-16 f-500">IP Address:</div>
                                                <div class="colTwo c-19 f-16 f-500 ip_address_text">--</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cardsFooter d-flex justify-content-end">
                                <button type="button" class="btn-primary f-500 f-14 btn_next1" style="min-width: 78px !important;">Next</button>
                            </div>
                        </div>
                    </div>

                    <div class="step step2">
                        <div class="cards">
                            <div class="cardsHeader">
                                <span class="f-18 f-600 f-16-500 c-gr f-700">Product Details</span>
                            </div>
                            <div class="cardsBody">
                                <div class="clientBlock emailBlock">
                                    <div class="d-flex align-items-center mb-4 d-block-768">
                                        <label class="f-16 f-500 c-gr col-order-1">Lead Type:</label>
                                        <div class="col-order-2 position-relative">
                                            <select name="lead_type_id" class="select2">
                                                <option value="">Select a lead type</option>
                                                @if ($LeadTypes->isNotEmpty())
                                                    @foreach ($LeadTypes as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span class="text-danger" id="lead_type_id_validate"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-4 d-block-768">
                                        <label class="f-16 f-500 c-gr col-order-1">Lead Age:</label>
                                        <div class="col-order-2 position-relative">
                                            <select name="age_group_id" class="select2">
                                                <option value="">Select Age</option>
                                            </select>
                                            <span class="text-danger" id="age_group_id_validate"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-4 d-block-768">
                                        <label class="f-16 f-500 c-gr col-order-1">Quantity:</label>
                                        <div class="col-order-2 position-relative">
                                            <input type="text" placeholder="Enter quantity" name="qty" class="form-control f-14 only_digits" maxlength="10">
                                            <span class="text-danger" id="qty_validate"></span>
                                        </div>
                                    </div>

                                    <div class="devider"></div>
                                    <h4 class="f-14 f-500 c-19 my-4">OPTIONAL</h4>
                                    <div class="d-flex align-items-center mb-4 d-block-768">
                                        <label class="f-16 f-500 c-gr col-order-1">Gender:</label>
                                        <div class="col-order-2 position-relative">
                                            <select name="gender" class="form-control select2" >
                                                <option value="">Select gender</option>
                                                <option value="0">Male</option>
                                                <option value="1">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-4 d-block-768">
                                        <label class="f-16 f-500 c-gr col-order-1">State(s): </label>
                                        <div class="col-order-2 position-relative">
                                            <select name="state_id" class="form-control select2">
                                                <option value="">Select states</option>
                                                @if ($States->isNotEmpty())
                                                    @foreach ($States as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cardsFooter d-flex justify-content-end">
                                <button type="button" class="btn-default f-500 f-14 prev" style="min-width: 78px !important;">Previous</button>
                                <button type="button" class="btn-primary f-500 f-14 btn_next2" style="min-width: 78px !important;">Next</button>
                            </div>
                        </div>
                    </div>

                    <div class="step stepLeadDetail step3">
                        <div class="cards">
                            <div class="cardsHeader">
                                <span class="f-18 f-600 f-16-500 c-gr f-700">Lead details</span>
                            </div>
                            <div class="cardsBody">
                                <div class="d-flex align-items-center mb-4 d-block-768">
                                    <label class="f-16 f-500 c-gr col-order-1">Total Leads Available: </label>
                                    <div class="col-order-2">
                                        <h3 class="f-16 f-500 c-19 mb-0 total_leads_available">0 US Leads</h3>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center d-block-768">
                                    <label class="f-16 f-500 c-gr col-order-1">Quantity to be Sent:</label>
                                    <div class="col-order-2">
                                        <input type="text" placeholder="Enter the quantity of leads to be sent" name="lead_quantity" class="form-control only_digits" maxlength="10">
                                        <span class="text-danger" id="lead_quantity_validate"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="cardsFooter d-flex justify-content-end">
                                <button type="button" class="btn-default f-500 f-14 prev">Cancel</button>
                                <button type="button" class="btn-primary f-500 f-14 btn_create_order">Create order and email the leads<svg class="ms-2 position-relative bottom-1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.00033 0.666748C3.95033 0.666748 0.666992 3.95008 0.666992 8.00008C0.666992 12.0501 3.95033 15.3334 8.00033 15.3334C12.0503 15.3334 15.3337 12.0501 15.3337 8.00008C15.3337 3.95008 12.0503 0.666748 8.00033 0.666748ZM6.52899 5.80475C6.40755 5.67901 6.34036 5.51061 6.34188 5.33581C6.3434 5.16102 6.41351 4.99381 6.53711 4.8702C6.66072 4.7466 6.82793 4.67648 7.00273 4.67497C7.17752 4.67345 7.34592 4.74064 7.47166 4.86208L10.1383 7.52875C10.2633 7.65377 10.3335 7.82331 10.3335 8.00008C10.3335 8.17686 10.2633 8.3464 10.1383 8.47141L7.47166 11.1381C7.34592 11.2595 7.17752 11.3267 7.00273 11.3252C6.82793 11.3237 6.66072 11.2536 6.53711 11.13C6.41351 11.0064 6.3434 10.8391 6.34188 10.6643C6.34036 10.4896 6.40755 10.3211 6.52899 10.1954L8.72433 8.00008L6.52899 5.80475Z" fill="white"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="step stepConfirmation step4">
                        <div class="cards">
                            <div class="cardsHeader">
                                <span class="f-18 f-600 f-16-500 c-gr f-700">Confirmation</span>
                            </div>
                            <div class="cardsBody text-center">
                                <svg class="mt-2" width="100" height="100" viewBox="0 0 100 102" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M99.458 76.4167L74.0413 101.833L56.2497 84.0417L63.8747 76.4167L74.0413 86.5834L91.833 68.7917L99.458 76.4167ZM10.4997 0.166748C4.85717 0.166748 0.333008 4.69091 0.333008 10.3334V91.6667C0.333008 97.3092 4.85717 101.833 10.4997 101.833H50.2005C47.5063 97.2076 46.083 91.9209 46.083 86.5834C46.083 84.9059 46.2355 83.1776 46.4897 81.5001H10.4997V71.3334H50.2005C52.5388 67.2667 55.7922 63.7084 59.7063 61.1667H10.4997V51.0001H71.4997V56.4901C73.1772 56.2359 74.9055 56.0834 76.583 56.0834C78.3113 56.0834 79.9888 56.2359 81.6663 56.4901V30.6667L51.1663 0.166748M46.083 7.79175L74.0413 35.7501H46.083V7.79175Z" fill="#6666EA"/>
                                </svg>
                                <h3 class="f-18 f-16-500 f-400 c-gr mt-4">Leads were sent to <a href="javascript:void(0);" class="c-16 client_email_text">--</a> and a copy was emailed to the admin.</h3>
                            </div>

                            <div class="cardsFooter d-flex justify-content-end">
                                <a href="{{ route('admin.new-order') }}"><button type="button" class="btn-default f-500 f-14" style="min-width: 78px !important;">Home</button></a>
                            </div>
                        </div>
                    </div>
                </form>
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
                                <input type="text" class="form-control f-14 c-19" name="ip_address" placeholder="Enter IP address">
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

            $('.loadingClient').prop('hidden',true);
            $('.email_list').click(function(){
                $('.loadingClient').prop('hidden',true);
            });

            $(document).on('input','#filter_client_email',function(){
                $('.loadingClient').removeAttr('hidden');
            })

            $('.only_digits').keyup(function(e){
                if (/\D/g.test(this.value))
                {
                    this.value = this.value.replace(/\D/g, '');
                }
            });

            $("#form").validate({
                rules:{
                    first_name: {required: true},
                    last_name: {required: true},
                    email: {required: true, email:true},
                },
                messages:{
                    first_name:{required: "This fields is required."},
                    last_name:{required: "This fields is required."},
                    email:{required: "This fields is required.", email:"Please enter valid email formate"},
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
                            if (response[0]) {
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
            $("[name='filter_client_email']").on("keyup paste", function() {
                var filter_client_email = $(this).val();
                $('.email_list,.email_not_match').html('');

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.client.email-filter') }}",
                    dataType: "json",
                    data: {'email':filter_client_email},
                    async:false,
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

            $(document).on('click','.client_details', function(e) {

                var id = $(this).data('id');
                var first_name = $(this).data('first_name');
                var last_name = $(this).data('last_name');
                var email = $(this).data('email');
                var city = $(this).data('city');
                var state = $(this).data('state');
                var country = $(this).data('country');
                var ip_address = $(this).data('ip_address');

                $('[name="client_id"]').val(id);
                $('.first_name_text').text(first_name);
                $('.last_name_text').text(last_name);
                $('.email_text').text(email);
                $('.city_text').text(city);
                $('.state_text').text(state);
                $('.country_text').text(country);
                $('.ip_address_text').text(ip_address);

                $('[name="filter_client_email"]').val(email);
                $('.email_list,#client_id_validate').html('');
                $('.btn_next1').addClass('next');
            });

            $(document).on('change','[name="lead_type_id"]', function(e) {
                var lead_type_id = $('[name="lead_type_id"] option:selected').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.age-group') }}",
                    dataType: "json",
                    data: {'lead_type_id':lead_type_id},
                    success: function(response) {
                        $('[name="age_group_id"]').html(response[1].html);
                    }
                });
            });

            //Validation is client,product and lead section
            $(document).on('click','.btn_next1',function(e) {
                e.preventDefault();
                var client_id = $('[name="client_id"]').val();

                if(client_id == ''){
                    $("#client_id_validate").text('Please select client.');
                    return false;
                }else{
                    $(".btn_next1").addClass("next");
                    $(".step1").removeClass("active");
                    $(".tab1").addClass("done");
                    $(".step2").addClass("active");
                }
            });

            $(document).on('click','.btn_next2',function(e) {
                e.preventDefault();

                var lead_type_id = $('[name="lead_type_id"]').val();
                var age_group_id = $('[name="age_group_id"]').val();
                var qty = $('[name="qty"]').val();
                if(lead_type_id == ''){
                    $("#lead_type_id_validate").text('Please select lead type.');
                    return false;
                }
                else if(age_group_id == ''){
                    $("#age_group_id_validate").text('Please select age.');
                    return false;
                }
                else if(qty == ''){
                    $("#qty_validate").text('Please enter quantity.');
                    return false;
                }
                else if(qty == 0){
                    $("#qty_validate").text('Quantity must be enter greater than of 0.');
                    return false;
                }else{
                    $(".btn_next2").addClass("next");
                    $(".step2").removeClass("active");
                    $(".tab2").addClass("done");
                    $(".step3").addClass("active");

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.count-total-leads-available') }}",
                        dataType: "json",
                        data: $('#order_form').serialize(),
                        success: function(response) {
                            $('.total_leads_available').text(response[1].total_leads_available + ' US Leads');
                            $('[name="total_leads_available"]').val(response[1].total_leads_available);
                            $('[name="lead_quantity"]').val(qty);
                        }
                    });
                }
            });

            $(document).on('click','[name="lead_type_id"]',function(e) {
                $("#lead_type_id_validate").text('');
            });
            $(document).on('click','[name="age_group_id"]',function(e) {
                $("#age_group_id_validate").text('');
            });
            $(document).on('keyup','[name="qty"],[name="lead_quantity"]',function(e) {
                $("#qty_validate,#lead_quantity_validate").text('');
            });

            $(document).on('click','.btn_create_order', function(e) {
                e.preventDefault();
                var lead_quantity = $('[name="lead_quantity"]').val();
                var total_leads_available = $('[name="total_leads_available"]').val();

                if(lead_quantity == ''){
                    $("#lead_quantity_validate").text('Please enter lead quantity.');
                    return false;
                }else if(lead_quantity == 0){
                    $("#lead_quantity_validate").text('Quantity must be enter greater than of 0.');
                    return false;
                }else if(lead_quantity > total_leads_available){
                    $("#lead_quantity_validate").text('Quantity can\'t be add greater than of total leads.');
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.create-order') }}",
                    dataType: "json",
                    data: $('#order_form').serialize(),
                    success: function(response) {
                        if(response[0]){
                            $(".btn_next3").addClass("next");
                            $(".step3").removeClass("active");
                            $(".tab3").addClass("done");
                            $(".step4").addClass("active");
                            $('.client_email_text').text($('[name="filter_client_email"]').val());

                            Swal.fire({
                                icon: "success",
                                title: 'Success',
                                text: response[1].message,
                            });
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: 'Opps!',
                                text: response[1].message,
                            })
                        }
                    }
                });
            });
        });
    </script>
@endsection
