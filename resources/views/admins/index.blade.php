@extends('layouts.master')
@section('content')
    <div class="middleContent">
        <div class="cards">
            <div class="cardsHeader d-flex justify-content-end">

                <button id="showModel" class="btn-primary f-500 f-14 float-right align-right" data-bs-toggle="modal"
                    data-bs-target="#addAdmin">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.00008 13.3332V7.99984M8.00008 7.99984V2.6665M8.00008 7.99984H13.3334M8.00008 7.99984H2.66675"
                            stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
                        <defs>
                            <linearGradient id="paint0_linear_1524_12120" x1="8.00008" y1="2.6665" x2="8.00008"
                                y2="13.3332" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#ffffff" />
                                <stop offset="1" stop-color="#ffffff" />
                            </linearGradient>
                        </defs>
                    </svg>
                    Add New Admin
                </button>
            </div>
            <div class="card-body  table-responsive">
                <table class="datatable  table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="modal fade fieldsModal groupModal" id="addAdmin">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="addAdmin_title">Add Admin</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="addAdminForm">
                        @csrf
                        <input type="text" id="admin_id" hidden>
                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">First Name:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="firstName" name="firstName" class="form-control"
                                    placeholder="Enter First Name">
                                <span class="jserror"></span>
                                @if ($errors->has('firstName'))
                                    <span
                                        class="requride_cls text-danger"><strong>{{ $errors->first('firstName') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">Last Name:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="lastName" name="lastName" class="form-control"
                                    placeholder="Enter Last Name">
                                <span class="jserror"></span>
                                @if ($errors->has('lastName'))
                                    <span
                                        class="requride_cls text-danger"><strong>{{ $errors->first('lastName') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">Email:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Enter Email">
                                <span class="jserror"></span>
                                @if ($errors->has('email'))
                                    <span
                                        class="requride_cls text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                        </div>


                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">Password:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password"  id="password" name="password"
                                    class="form-control" placeholder="Enter Password" autocomplete="new-password">
                                <span class="jserror"></span>
                                @if ($errors->has('password'))
                                    <span
                                        class="requride_cls text-danger"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">Confirm password:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" id="password_confirmation"
                                    name="password_confirmation" class="form-control"
                                    placeholder="re-type password to confirm" autocomplete="new-password">
                                <span class="jserror"></span>
                                @if ($errors->has('password_confirmation'))
                                    <span
                                        class="requride_cls text-danger"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <label class="c-gr f-16 f-500">Allow create or edit users:</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="allow" name="allow">
                                </div>
                            </div>
                        </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" id="addAdmin_submit" class="btn-primary" style="min-width: 74px;"
                        data-update="false">Add</button>
                </div>
                </form>
                <!-- Modal footer -->

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            drawTable();

            @if (Session::has('message'))
                Swal.fire(
                    '{{ $moduleName }}',
                    '{!! session('message') !!}',
                    'success'
                )
            @endif

            @if (Session::has('failmessage'))
                Swal.fire(
                    '{{ $moduleName }}',
                    '{!! session('failmessage') !!}',
                    'error'
                )
            @endif


            function drawTable(param = {}) {
                var datatable = $('.datatable').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    pageLength: 10,
                    searchable: false,
                    ajax: {
                        "url": "{{ route('admins.getData') }}",
                        "dataType": "json",
                        "type": "GET",
                        "data": param,
                    },
                    columns: [{
                            data: 'firstName',

                        },
                        {
                            data: 'lastName'
                        },
                        {
                            data: 'email',
                            searchable: true
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        },

                    ],
                });
            }

            $('#showModel').on('click', function(e) {
                e.preventDefault();
                $('#addAdmin_title').text('Add Admin');
                $('#addAdmin').val('');
                $('#addAdmin_submit').text('Add');
                $('#addAdmin_submit').attr('data-update', 'false');
                $('#admin_id').val('');
            });

            $("#showModel").on('click', function(e) {
                $('.jserror').html('');
                clearFields();
            });

            $('#addAdmin_submit').on('click', function(e) {
                e.preventDefault();
                var mainFlag = checkValidation();
                var subFlag = true;
                var updateFlag = true;
                id = $("#admin_id").val();
                if (id == '') {
                    subFlag = checkPassword();
                } else {
                    if (password = $('#password').val() != '') {
                        updateFlag = checkAtUpdate();
                    }
                    var type = "UPDATE";
                }
                if (mainFlag == true && subFlag == true && updateFlag == true) {

                    var firstName = $('#firstName').val();
                    var lastName = $('#lastName').val();
                    var email = $('#email').val();
                    var password = $('#password').val();
                    var password_confirmation = $('#password_confirmation').val();
                    var allow = 0 ;
                    if($('#allow').is(':checked'))
                    {
                        allow = 1;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admins.store') }}",
                        data: {
                            firstName: firstName,
                            lastName: lastName,
                            email: email,
                            password: password,
                            password_confirmation:password_confirmation,
                            allow:allow,
                            id: id,
                            type: type
                        },
                        success: function(res) {
                            if (res[0] == true) {
                                $('#addAdmin').modal('hide');
                                $('.jserror').html('');

                                clearFields();

                                Swal.fire({
                                    icon: "success",
                                    title: res[1],
                                    text: res[2],
                                }).then(function() {
                                    window.location.reload();
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


            $(document).on('click', '.delete_record', function(e) {
                var id = $(this).attr('data-id');
                e.preventDefault();
                let linkUrl = $(this).attr('href');
                Swal.fire({
                    title: '{{ __('Are you sure?') }}',
                    text: "{{ __('You wont delete this Admin!') }}",
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
                            url: "{{route('admin.delete') }}",
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
                                        window.location.reload();
                                    });
                                }
                            }
                        });

                    }
                });
            });


            $(document).on('click', '.editBtn', function(e) {
                e.preventDefault();
                clearFields();
                $('.jserror').html('');
                $('#addAdmin').modal('show');
                $('#addAdmin_title').text('EditAdmin');
                $('#addAdmin_submit').text('Update');
                $('#addAdmin_submit').attr('data-update', 'true');

                var id = $(this).attr('data-id')
                $('#admin_id').val(id);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.edit') }}",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        console.log(res);
                        $('#firstName').val(res['firstName']);
                        $('#lastName').val(res['lastName']);
                        $('#email').val(res['email']);
                        $('#allow').val(res['allowCreateEditUser']);
                       if(res['allowCreateEditUser'] == 1)
                       {
                            $('#allow').prop('checked', true);;
                       }
                       else
                       {
                            $('#allow').prop('checked', false);;
                       }
                    }
                });

            });

            $("#email").on('keyup',function(){
           var check = isEmail($(this).val())
           if(check == false && $(this).val() != '')
           {
            $(this).siblings('.jserror').css('color','red').html('Invalid Email.');
           }
           else
           {
            $(this).siblings('.jserror').html('');
           }
        });

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
             return regex.test(email);
        }

            function checkValidation() {
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

            function checkPassword() {
                var pFlag, cpFlag = false;
                if ($('#password').val() == '' || $('#password').val() == null) {
                    $('#password').siblings('.jserror').css('color', 'red').html('Password Is Required');
                } else if ($('#password_confirmation').val() == '' || $('#password_confirmation').val() == null) {
                    $('#password_confirmation').siblings('.jserror').css('color', 'red').html(
                        'password_confirmation Is Required');
                } else if ($('#password').val() !== $('#password_confirmation').val()) {
                    $('#password_confirmation').siblings('.jserror').css('color', 'red').html(
                        'password_confirmation should match with Password');
                } else {
                    pFlag = true;
                    cpFlag = true;
                }

                if (pFlag == true && cpFlag == true) {
                    return true;
                } else {
                    return false;
                }
            }

            function clearFields() {
                $('#firstName').val('');
                $('#lastName').val('');
                $('#email').val('');
                $('#password').val('');
                $('#password_confirmation').val('');

            }

            function checkAtUpdate() {
                var flag = false;
                if ($('#password_confirmation').val() == '' || $('#password_confirmation').val() == null) {
                    $('#password_confirmation').siblings('.jserror').css('color', 'red').html(
                        'password_confirmation Is Required');
                } else if ($('#password').val() !== $('#password_confirmation').val()) {
                    $('#password_confirmation').siblings('.jserror').css('color', 'red').html(
                        'password_confirmation should match with Password');
                } else {
                    flag = true;
                }

                return flag;

            }
        });
    </script>
@endsection
