@extends('layouts.master')
@section('content')
    <div class="middleContent">

        <div class="cards tableCards">
            <table class="table datatable" id="example" style="width:100%">
                <thead>
                    <tr>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>EMAIL</th>
                        <th>DATE CREATED</th>
                        <th>LAST LOGIN</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody id='tbody'>
                    {{-- @foreach ($users as $user)
                        <tr>
                            <td class="c-7b">{{$user->firstName}}</td>
                            <td class="c-7b">{{$user->lastName}}</td>
                            <td class="c-16">{{$user->email}}</td>
                            <td class="c-7b">{{date('d/m/y',strtotime($user->created_at))}}</td>
                            <td></td>
                            <td class="tableCards">
                                <div class="editDlbtn d-flex">
                                    <a href="javascript:;">
                                        <button class="editBtn" data-id="{{$user->id}}">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.8067 4.69354C14.0667 4.43354 14.0667 4.0002 13.8067 3.75354L12.2467 2.19354C12 1.93354 11.5667 1.93354 11.3067 2.19354L10.08 3.41354L12.58 5.91354L13.8067 4.69354ZM2 11.5002V14.0002H4.5L11.8733 6.6202L9.37333 4.1202L2 11.5002Z"
                                                    fill="white" />
                                            </svg>
                                        </button>
                                    </a>
                                    <button class="deleteBtn delete_record" data-id="{{$user->id}}">
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
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Enter Password" autocomplete="new-password">
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
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" placeholder="re-type password to confirm"
                                    autocomplete="new-password">
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

    <script type="text/html" id="filterDropdown">
        <div class="d-flex align-items-center filterPanelbtn">
            <button id="showModel" class="btn-primary f-500 f-14 float-right align-right" data-bs-toggle="modal"
                data-bs-target="#addAdmin">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.00008 13.3332V7.99984M8.00008 7.99984V2.6665M8.00008 7.99984H13.3334M8.00008 7.99984H2.66675"
                        stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
                    <defs>
                        <linearGradient id="paint0_linear_1524_12120" x1="8.00008" y1="2.6665" x2="8.00008" y2="13.3332"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#ffffff" />
                            <stop offset="1" stop-color="#ffffff" />
                        </linearGradient>
                    </defs>
                </svg>
                Add New Admin
            </button>
        </div>
    </script>

    <script type="text/html" id="searchPannel">
        <input class="form-control f-14" placeholder="Search here">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M15.6932 14.2957L10.7036 9.31023C11.386 8.35146 11.791 7.1584 11.791 5.90142C11.791 2.64178 9.14704 0 5.8847 0C2.62254 0.00017572 0 2.64196 0 5.90142C0 9.16105 2.64397 11.8028 5.90631 11.8028C7.18564 11.8028 8.35839 11.3981 9.31795 10.7163L14.3076 15.7018C14.4994 15.8935 14.7553 16 15.0113 16C15.2672 16 15.523 15.8935 15.7149 15.7018C16.0985 15.2971 16.0985 14.6792 15.6935 14.2956L15.6932 14.2957ZM1.96118 5.90155C1.96118 3.72845 3.73104 1.98133 5.88465 1.98133C8.03826 1.9815 9.82938 3.72845 9.82938 5.90155C9.82938 8.07466 8.05952 9.82178 5.90591 9.82178C3.7523 9.82178 1.96118 8.05338 1.96118 5.90155Z"
                fill="#7B809A" />
        </svg>
    </script>

    <script>
        var duplicateEmail;

        $(document).ready(function() {

            // drawTable();
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

            var datatable = $('.datatable').DataTable({
                "dom": "<'filterHeader d-block-500 cardsHeader'<'#filterInput'><'#filterBtn'>>" +
                    "<'row m-0'<'col-sm-12 p-0'tr>>" +
                    "<'row datatableFooter'<'col-md-5 align-self-center'i><'col-md-7'p>>",
                "ordering": false,
                processing: true,
                serverSide: true,
                createdRow: function( row, data, dataIndex ) {
                $( row ).find('td:eq(2)').addClass('c-16');
                },
                ajax: {
                    "url": "{{ route('admins.getData') }}",
                    "dataType": "json",
                    "type": "GET",
                },
                columns: [{
                        data: 'firstName'
                    },
                    {
                        data: 'lastName'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'lastlogin'
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
            $('#filterInput > input').keyup(function() {
                datatable.search($(this).val()).draw();
            });



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
                var email = $('#email').val();
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
                if (mainFlag == true && subFlag == true && updateFlag == true ) {

                    var firstName = $('#firstName').val();
                    var lastName = $('#lastName').val();
                    var password = $('#password').val();
                    var password_confirmation = $('#password_confirmation').val();
                    var allow = 0;
                    if ($('#allow').is(':checked')) {
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
                            password_confirmation: password_confirmation,
                            allow: allow,
                            id: id,
                            type: type
                        },
                        success: function(res) {
                            if(res == false)
                            {
                                Swal.fire({
                                    icon: "info",
                                    title: "Duplicate email address.",
                                    text: "Admin with same email address alredy exist.",
                                })
                            }
                            if (res[0] == true) {
                                $('#addAdmin').modal('hide');
                                $('.jserror').html('');

                                clearFields();

                                Swal.fire({
                                    icon: "success",
                                    title: res[1],
                                    text: res[2],

                                }).then(function() {
                                    datatable.draw();
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
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: "Cancel"
                }).then(result => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.delete') }}",
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
                                        datatable.draw();
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
                        if (res['allowCreateEditUser'] == 1) {
                            $('#allow').prop('checked', true);
                        } else {
                            $('#allow').prop('checked', false);
                        }
                    }
                });

            });

            $("#email").on('keyup', function() {
                $(this).siblings('.jserror').html('');
                var check = isEmail($(this).val())
                if (check == false && $(this).val() != '') {
                    $(this).siblings('.jserror').css('color', 'red').html('Invalid Email.');
                    $('#addAdmin_submit').prop('disabled');
                } else {
                    $(this).siblings('.jserror').html('');
                    $('#addAdmin_submit').prop('disabled', false);
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
