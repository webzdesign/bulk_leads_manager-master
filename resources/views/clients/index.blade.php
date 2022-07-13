@extends('layouts.master')
@section('content')
                <div class="middleContent">
                    <div class="importWrpr">
                        <div class="cards">
                            <table id="example" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Last Order date</th>
                                        <th>Last Product ordered</th>
                                        <th>Client Since</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id='tbody' class="tableCards" style="overflow: initial !important;">
                                    {{-- @foreach ($clients as $client)

                                    <tr>
                                        <td class="c-7b">{{$client->firstName}}</td>
                                        <td class="c-7b">{{$client->lastName}}</td>
                                        <td class="c-7b">{{$client->email}}</td>
                                        <td class="c-7b">{{isset($client->last_order_date)?date('d-m-Y',strtotime($client->last_order_date)):''}}</td>
                                        <td class="c-7b">{{isset($client->last_product_ordered)?$client->last_product_ordered:''}}</td>
                                        <td class="c-7b">{{date('d/m/y',strtotime($client->created_at))}}</td>
                                        <td class="c-7b tableCards">
                                            <div class="editDlbtn d-flex">
                                                <a href="javascript:;">
                                                    <button class="cartBtn" data-id="{{$client->id}}">
                                                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.8334 11.9999C11.0934 11.9999 10.5001 12.5933 10.5001 13.3333C10.5001 13.6869 10.6406 14.026 10.8906 14.2761C11.1407 14.5261 11.4798 14.6666 11.8334 14.6666C12.187 14.6666 12.5262 14.5261 12.7762 14.2761C13.0263 14.026 13.1667 13.6869 13.1667 13.3333C13.1667 12.5933 12.5667 11.9999 11.8334 11.9999ZM1.16675 1.33325V2.66659H2.50008L4.90008 7.72659L3.99341 9.35992C3.89341 9.54659 3.83341 9.76659 3.83341 9.99992C3.83341 10.3535 3.97389 10.6927 4.22394 10.9427C4.47399 11.1928 4.81313 11.3333 5.16675 11.3333H13.1667V9.99992H5.44675C5.40254 9.99992 5.36015 9.98236 5.3289 9.9511C5.29764 9.91985 5.28008 9.87745 5.28008 9.83325C5.28008 9.79992 5.28675 9.77325 5.30008 9.75325L5.90008 8.66659H10.8667C11.3667 8.66659 11.8067 8.38659 12.0334 7.97992L14.4201 3.66659C14.4667 3.55992 14.5001 3.44659 14.5001 3.33325C14.5001 3.15644 14.4298 2.98687 14.3048 2.86185C14.1798 2.73682 14.0102 2.66659 13.8334 2.66659H3.97341L3.34675 1.33325H1.16675ZM5.16675 11.9999C4.42675 11.9999 3.83341 12.5933 3.83341 13.3333C3.83341 13.6869 3.97389 14.026 4.22394 14.2761C4.47399 14.5261 4.81313 14.6666 5.16675 14.6666C5.52037 14.6666 5.85951 14.5261 6.10956 14.2761C6.3596 14.026 6.50008 13.6869 6.50008 13.3333C6.50008 12.5933 5.90008 11.9999 5.16675 11.9999Z" fill="white"/>
                                                        </svg>
                                                    </button>
                                                </a>
                                                <a href="javascript:;">
                                                    <button class="editBtn" data-id="{{$client->id}}">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M13.8067 4.69354C14.0667 4.43354 14.0667 4.0002 13.8067 3.75354L12.2467 2.19354C12 1.93354 11.5667 1.93354 11.3067 2.19354L10.08 3.41354L12.58 5.91354L13.8067 4.69354ZM2 11.5002V14.0002H4.5L11.8733 6.6202L9.37333 4.1202L2 11.5002Z"
                                                                fill="white" />
                                                        </svg>
                                                    </button>
                                                </a>
                                                <button class="deleteBtn delete_record" data-id="{{$client->id}}">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.6666 2.66667H10.3333L9.66659 2H6.33325L5.66659 2.66667H3.33325V4H12.6666V2.66667ZM3.99992 12.6667C3.99992 13.0203 4.14039 13.3594 4.39044 13.6095C4.64049 13.8595 4.97963 14 5.33325 14H10.6666C11.0202 14 11.3593 13.8595 11.6094 13.6095C11.8594 13.3594 11.9999 13.0203 11.9999 12.6667V4.66667H3.99992V12.6667Z"
                                                            fill="white" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal fade fieldsModal groupModal" id="addClient">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title" id='addClient_title'>Add Client</h4>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <input type="text" id="client_id" hidden>
                                <div class="row align-items-center mb-4 mx-0">
                                    <div class="col-md-4">
                                        <label class="c-gr f-16 f-500">First Name:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id='firstName' name='firstName' class="form-control f-14 c-19" placeholder="Enter first name">
                                        <span class="jserror"></span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4 mx-0">
                                    <div class="col-md-4">
                                        <label class="c-gr f-16 f-500">Last Name:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id='lastName' name='lastName' class="form-control f-14 c-19" placeholder="Enter last name">
                                        <span class="jserror"></span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4 mx-0">
                                    <div class="col-md-4">
                                        <label class="c-gr f-16 f-500">Email:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id='email' name='email' class="form-control f-14 c-19" placeholder="Enter email address">
                                        <span class="jserror"></span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4 mx-0">
                                    <div class="col-md-4">
                                        <label class="c-gr f-16 f-500">City:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id='city' name='city' class="form-control f-14 c-19" placeholder="Enter city">
                                        <span class="jserror"></span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4 mx-0">
                                    <div class="col-md-4">
                                        <label class="c-gr f-16 f-500">State:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id='state' name='state' class="form-control f-14 c-19" placeholder="Enter state">
                                        <span class="jserror"></span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4 mx-0">
                                    <div class="col-md-4">
                                        <label class="c-gr f-16 f-500">Country:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id='country' name="country" class="form-control f-14 c-19" placeholder="Enter country">
                                        <span class="jserror"></span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4 mx-0">
                                    <div class="col-md-4">
                                        <label class="c-gr f-16 f-500">IP Address</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id='ipAdrs' name='ipAdrs' class="form-control f-14 c-19" placeholder="Enter IP address">
                                        <span class="jserror"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn-primary" id='addClient_submit' style="min-width: 74px;"
                                     data-update="false">Add Client</button>
                            </div>

                        </div>
                    </div>
                </div>

   @endsection

   @section('script')
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script type="text/html" id="filterDropdown">
    <div class="d-flex align-items-center filterPanelbtn">

        <div class="me-2">
            <button id='showModel' class="btn-primary f-500 f-14" style="min-width: 84px !important;"  data-bs-toggle="modal" data-bs-target="#addClient">
                <svg class="me-1" width="16" height="16" viewBox="0 0 16 16" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.00008 13.3332V7.99984M8.00008 7.99984V2.6665M8.00008 7.99984H13.3334M8.00008 7.99984H2.66675" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path>
                    <defs>
                        <linearGradient id="paint0_linear_1524_12120" x1="8.00008" y1="2.6665" x2="8.00008" y2="13.3332" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#ffffff"></stop>
                            <stop offset="1" stop-color="#ffffff"></stop>
                        </linearGradient>
                    </defs>
                </svg>
                Add client
            </button>
        </div>

        <div class="button-dropdown position-relative">
            <button style="min-width: 104px;" class="btn-primary f-500 dropdown-toggle">
                <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.84408 12.1946C7.94068 12.1472 8.02209 12.0738 8.07909 11.9825C8.1361 11.8913 8.16644 11.7859 8.16667 11.6783V8.57501C8.16667 8.42218 8.22792 8.27518 8.33758 8.16668L11.9082 4.63518C12.0163 4.52842 12.1022 4.40126 12.1609 4.26108C12.2196 4.1209 12.2498 3.97048 12.25 3.81851V2.32751C12.2497 2.25127 12.2344 2.17583 12.2049 2.10552C12.1754 2.03522 12.1323 1.97142 12.0781 1.91777C12.0239 1.86413 11.9597 1.8217 11.8891 1.79292C11.8185 1.76413 11.7429 1.74955 11.6667 1.75001H2.33333C2.01075 1.75001 1.75 2.00784 1.75 2.32751V3.81851C1.75 4.12476 1.87308 4.41876 2.09183 4.63518L5.66242 8.16668C5.71652 8.22004 5.75948 8.28361 5.78882 8.3537C5.81816 8.4238 5.83329 8.49902 5.83333 8.57501V12.2558C5.83333 12.6846 6.2895 12.9634 6.67742 12.7715L7.84408 12.1946Z" fill="white"/></svg>Filter
            </button>
            <ul class="dropdown-menu settingWrpr cards filterDropdownBx p-0 m-0">
                <div class="cardsHeader">
                    <span class="f-18 f-600 f-16-500 c-gr f-700">Filter</span>
                </div>
                <div class="cardsBody settingWrpr">
                    <div class="form-group">
                        <label class="c-gr f-500 f-16 w-100 mb-2">State</label>
                        <select id='stateDD'>
                            <option value="">Select state</option>
                            @foreach ($states as $state)
                            <option value='{{$state}}'>{{$state}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="py-3 cardsFooter d-flex justify-content-end">
                    <button class="btn-primary f-500 f-14" style="min-width: 84px !important;" id="apply">Apply</button>
                </div>
            </ul>
        <div>
    </div>
</script>

<script type="text/html" id="searchPannel">
    <input class="form-control f-14" placeholder="Search here">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.6932 14.2957L10.7036 9.31023C11.386 8.35146 11.791 7.1584 11.791 5.90142C11.791 2.64178 9.14704 0 5.8847 0C2.62254 0.00017572 0 2.64196 0 5.90142C0 9.16105 2.64397 11.8028 5.90631 11.8028C7.18564 11.8028 8.35839 11.3981 9.31795 10.7163L14.3076 15.7018C14.4994 15.8935 14.7553 16 15.0113 16C15.2672 16 15.523 15.8935 15.7149 15.7018C16.0985 15.2971 16.0985 14.6792 15.6935 14.2956L15.6932 14.2957ZM1.96118 5.90155C1.96118 3.72845 3.73104 1.98133 5.88465 1.98133C8.03826 1.9815 9.82938 3.72845 9.82938 5.90155C9.82938 8.07466 8.05952 9.82178 5.90591 9.82178C3.7523 9.82178 1.96118 8.05338 1.96118 5.90155Z" fill="#7B809A"/></svg>
</script>
    <script>
        var emailFlag ;
        var statDD;
        $(document).ready(function () {
           var tbl = $('#example').DataTable({
                "dom":"<'filterHeader d-block-500 cardsHeader'<'#filterInput'><'#filterBtn'>>" + "<'row m-0'<'col-sm-12 p-0'tr>>" + "<'row datatableFooter'<'col-md-5 align-self-center'i><'col-md-7'p>>",
                "ordering": false,
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search here"
                },
                ajax: {
                    "url": "{{ route('admin.clients.getData') }}",
                    "dataType": "json",
                    "type": "GET",
                    "data":{
                        state: function() {
						    return $("#stateDD").val();
					    }
                    }
                },
                columns: [
                    {
                        data: 'firstName'
                    },
                    {
                        data: 'lastName'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'lastOrderDate'
                    },
                    {
                        data: 'lastProductOrder'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $('#filterInput').html($('#searchPannel').html());

            $('#filterBtn').html($('#filterDropdown').html());
            $('#filterInput > input').keyup(function(){
                tbl.search($(this).val()).draw();
            });

            $('#apply').bind("click",  function (t) {
                t.preventDefault();
                $(".button-dropdown .dropdown-menu").hide();
            });

            $('#showModel').on('click', function(e) {
                e.preventDefault();
                $('#addClient_title').text('Add Client');
                $('#addClient').val('');
                $('#addClient_submit').text('Add');
                $('#addClient_submit').attr('data-update', 'false');
                $('#client_id').val('');
            });

            $("#showModel").on('click', function(e) {
                $('.jserror').html('');
                clearFields();
            });

            $('#addClient_submit').on('click', function(e) {
                e.preventDefault();
                var email = $('#email').val();
                var mainFlag = checkValidation();
                var type = '';
                id = $("#client_id").val();
                if (id != '') {
                    type = "UPDATE";
                }
                if(mainFlag == true)
                {
                    var firstName = $('#firstName').val();
                    var lastName = $('#lastName').val();
                    var city = $('#city').val();
                    var state = $('#state').val();
                    var country = $('#country').val();
                    var ipAdrs = $('#ipAdrs').val();

                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.client.store')}}",
                        data:{
                            firstName:firstName,
                            lastName:lastName,
                            email:email,
                            city:city,
                            state:state,
                            country:country,
                            ipAdrs:ipAdrs,
                            id:id,
                            type:type
                        },
                        success: function (res) {
                            if (res[0] == true) {
                                $('#addClient').modal('hide');
                                $('.jserror').html('');

                                clearFields();

                                Swal.fire({
                                    icon: "success",
                                    title: res[1],
                                    text: res[2],
                                }).then(function() {
                                   tbl.draw();
                                });
                            }
                        },
                        fail: function(xhr, textStatus, errorThrown) {
                            alert('request failed');
                        }
                    });
                    $('.jserror').html('');
                }
            });

            $(document).on('click', '.editBtn', function(e) {
                e.preventDefault();
                clearFields();
                $('.jserror').html('');
                $('#addClient').modal('show');
                $('#addClient_title').text('Edit Client');
                $('#addClient_submit').text('Update');
                $('#addClient_submit').attr('data-update', 'true');

                var id = $(this).attr('data-id')
                $('#client_id').val(id);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.client.edit') }}",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        console.log(res);
                        $('#firstName').val(res['firstName']);
                        $('#lastName').val(res['lastName']);
                        $('#email').val(res['email']);
                        $('#city').val(res['city']);
                        $('#state').val(res['state']);
                        $('#country').val(res['country']);
                        $('#ipAdrs').val(res['ip_address']);
                    }
                });

            });

            $(document).on('click', '.delete_record', function(e) {
                var id = $(this).attr('data-id');
                e.preventDefault();
                let linkUrl = $(this).attr('href');
                Swal.fire({
                    title: '{{ __('Are you sure?') }}',
                    text: "{{ __('You wont delete this Client!') }}",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __('Yes') }}',
                    cancelButtonText: "{{ __('Cancel') }}"
                }).then(result => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: "POST",
                            url: "{{route('admin.client.delete') }}",
                            data: {
                                id: id
                            },
                            success: function(res) {
                                if (res[0] == true) {
                                    Swal.fire(
                                        'Deleted!',
                                        res[1],
                                        'success'
                                    ).then(function() {
                                      tbl.draw();
                                    });
                                }
                            }
                        });

                    }
                });
            });

            $(document).on('click','#apply',function(){
                var statDD = $('#stateDD').val();
                tbl.draw();
            });

            $("#email").on('keyup',function()
            {
                var check = isEmail($(this).val())
                if(check == false && $(this).val() != '')
                {
                    $(this).siblings('.jserror').css('color','red').html('Invalid Email.');
                }
                else
                {
                    var type = '';
                    id = $("#client_id").val();
                    if (id != '') {
                        type = "UPDATE";
                    }
                    var isValid = checkUniqueMail($(this).val(),type,id);
                    if(isValid == false)
                    {
                        $(this).siblings('.jserror').css('color','red').html('Email Already Exist.');
                    }
                    else
                    {
                         $(this).siblings('.jserror').html('');
                    }
                }

            });
        });

        function isEmail(email)
        {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
             return regex.test(email);
        }

        function checkValidation()
        {
            var fnFlag, lnFlag, emailFlag = false;
            if ($('#firstName').val() == '' || $('#firstName').val() == null) {
                    $('#firstName').siblings('.jserror').css('color', 'red').html('First Name Is Required');
                } else {
                    $('#firstName').siblings('.jserror').css('color', 'red').html('');
                    fnFlag = true;
                }
                if ($('#lastName').val() == '' || $('#lastName').val() == null) {
                    $('#lastName').siblings('.jserror').css('color', 'red').html('Last Name Is Required');
                } else {
                    $('#lastName').siblings('.jserror').css('color', 'red').html('');
                    lnFlag = true;
                }
                if ($('#email').val() == '' || $('#email').val() == null) {
                    $('#email').siblings('.jserror').css('color', 'red').html('Email Is Required');
                } else {
                    $('#email').siblings('.jserror').css('color', 'red').html('');
                    emailFlag = true;
                }
                if (fnFlag == true && lnFlag == true && emailFlag == true) {
                    return true;
                } else {
                    return false;
                }
        }
        function clearFields()
        {
                $('#firstName').val('');
                $('#lastName').val('');
                $('#email').val('');
                $('#city').val('');
                $('#state').val('');
                $('#country').val('');
                $('#ipAdrs').val('');
        }

        function checkUniqueMail(email,type)
        {
            $.ajax({
                type: "post",
                url: "{{route('admin.client.checkEmailId')}}",
                data:{
                    email:email,
                    type:type,
                    id:id
                },
                success: function (response) {
                    console.log(response);
                    if(response == 0)
                    {
                       emailFlag = false;
                    }
                    else
                    {
                        emailFlag = true;
                    }
                }
            });

            return emailFlag;
        }

    </script>
@endsection
