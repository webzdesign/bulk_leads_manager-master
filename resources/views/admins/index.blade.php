@extends('layouts.master')
@section('content')

<div class="middleContent">
    <div class="cards tableCards">
        <div class="cardsHeader d-flex justify-content-end">

            <div class="col-md-4 float-left align-left">
                <input type="search" class="form-control rounded" placeholder="Search email " aria-label="Search" aria-describedby="search-addon" />
                <span class="input-group-text border-0" id="search-addon">
                  <i class="fa fa-search"></i>
                </span>
              </div>

            <button class="btn-primary f-500 f-14 float-right align-right" data-bs-toggle="modal" data-bs-target="#addAdmin">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="#ffffff"
                    xmlns="http://www.w3.org/2000/svg">
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

        <div class="cardsBody">

            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th >Email</th>
                        <th>Date Created</th>
                        <th>Last Login</th>
                        <th>actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->firstName}}</td>
                            <td>{{$user->lastName}}</td>
                            <td style='color:aqua;'>{{$user->email}}</td>
                            <td>{{date('d-m-Y',strtotime($user->created_at))}}</td>
                            <td class="align-middle">
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
                                    <button class="deleteBtn" data-id="{{$user->id}}">
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
                    @endforeach
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
                <h4 class="modal-title">Add Admin</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('admins.store')}}" method="POST" enctype="multipart/form-data" id="addAdminForm">
                    @csrf
                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <label class="c-gr f-16 f-500">First Name:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="firstName" name="firstName" class="form-control"
                            placeholder="Enter First Name">
                            @if ($errors->has('firstName'))
                            <span class="requride_cls text-danger"><strong>{{ $errors->first('firstName') }}</strong></span>
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
                            @if ($errors->has('lastName'))
                            <span class="requride_cls text-danger"><strong>{{ $errors->first('lastName') }}</strong></span>
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
                            <span class="requride_cls text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                             @endif
                    </div>
                </div>


                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <label class="c-gr f-16 f-500">Password:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="password" autocomplete=​"new-password" id="password" name="password" class="form-control"
                            placeholder="Enter Password">
                            @if ($errors->has('password'))
                            <span class="requride_cls text-danger"><strong>{{ $errors->first('password') }}</strong></span>
                             @endif
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <label class="c-gr f-16 f-500">Confirm password:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="password" autocomplete=​"new-password" id="password_confirmation" name="password_confirmation" class="form-control"
                            placeholder="re-type password to confirm">
                            @if ($errors->has('confirmPassword'))
                            <span class="requride_cls text-danger"><strong>{{ $errors->first('confirmPassword') }}</strong></span>
                             @endif
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <label class="c-gr f-16 f-500">Allow create or edit users:</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="allow" name="allow" value="1" checked>
                          </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" id="addAdmin_submit" class="btn-primary"
                    style="min-width: 74px;">Add</button>
            </div>
        </form>
            <!-- Modal footer -->

        </div>
    </div>
</div>

<div class="modal fade fieldsModal groupModal" id="updateAdmin">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Admin</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form  method="POST" enctype="multipart/form-data" id="updateAdminForm">
                    @csrf

                      <input type="text" id="id" name="id" class="form-control"
                          hidden>

                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <label class="c-gr f-16 f-500">First Name:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="up_firstName" name="up_firstName" class="form-control"
                            placeholder="Enter First Name">
                            @if ($errors->has('up_firstName'))
                            <span class="requride_cls text-danger"><strong>{{ $errors->first('up_firstName') }}</strong></span>
                             @endif
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <label class="c-gr f-16 f-500">Last Name:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="up_lastName" name="up_lastName" class="form-control"
                            placeholder="Enter Last Name">
                            @if ($errors->has('up_lastName'))
                            <span class="requride_cls text-danger"><strong>{{ $errors->first('up_lastName') }}</strong></span>
                             @endif
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <label class="c-gr f-16 f-500">Email:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="up_email" name="up_email" class="form-control"
                            placeholder="Enter Email">
                            <span class="jserror"></span>
                            @if ($errors->has('up_email'))
                            <span class="requride_cls text-danger"><strong>{{ $errors->first('up_email') }}</strong></span>
                             @endif
                    </div>
                </div>


                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <label class="c-gr f-16 f-500">Password:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="password" autocomplete=​"new-password" id="up_password" name="up_password" class="form-control"
                            placeholder="Enter Password">
                            @if ($errors->has('up_password'))
                            <span class="requride_cls text-danger"><strong>{{ $errors->first('up_password') }}</strong></span>
                             @endif
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <label class="c-gr f-16 f-500">Confirm password:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="password" autocomplete=​"new-password" id="up_password_confirmation" name="up_password_confirmation" class="form-control"
                            placeholder="re-type password to confirm">
                            @if ($errors->has('up_confirmPassword'))
                            <span class="requride_cls text-danger"><strong>{{ $errors->first('up_confirmPassword') }}</strong></span>
                             @endif
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <label class="c-gr f-16 f-500">Allow create or edit users:</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="up_allow" name="up_allow" value="1" checked>
                          </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" id="updateAdmin_submit" class="btn-primary"
                    style="min-width: 74px;">Update</button>
            </div>
        </form>
            <!-- Modal footer -->

        </div>
    </div>
</div>

@endsection
@section('script')
<script>

$(document).ready(function() {

     $("#email","#up_email").on('keyup',function(){
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

     $('#addAdminForm').validate({
            rules: {
                firstName: {
                    required: true,
                },
                lastName: {
                    required: true,
                },
                email:{
                    required:true,
                    email:true
                },
                password:{
                    required:true,
                },
                password_confirmation:{
                    required:true,
                },
            },
            messages: {
                firstName: {
                    required: "{{ __('First Name is required.') }}",
                },
                lastName: {
                    required: "{{ __('Last Name is required.') }}"
                },
                email:{
                    required: "{{ __('Email is required.') }}"
                },
                password:{
                    required: "{{ __('Passsword is required.') }}"
                },
                password_confirmation:{
                    required: "{{ __('Confirm Password is required.') }}"
                },
            },
            errorPlacement: function(error, element) {
                error.css('color', 'red').appendTo(element.parent("div"));
            },
            submitHandler: function(form) {
                $(':input[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });


        $('#updateAdminForm').validate({
            rules: {
                up_firstName: {
                    required: true,
                },
                up_lastName: {
                    required: true,
                },
                up_email:{
                    required:true,
                    email:true
                },
            },
            messages: {
                up_firstName: {
                    required: "{{ __('First Name is required.') }}",
                },
                up_lastName: {
                    required: "{{ __('Last Name is required.') }}"
                },
                up_email:{
                    required: "{{ __('Email is required.') }}"
                },
            },
            errorPlacement: function(error, element) {
                error.css('color', 'red').appendTo(element.parent("div"));
            },
            submitHandler: function(form) {
                $(':input[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });



        $('.editBtn').on('click',function(){

         id = $(this).attr('data-id');
            if(id)
            {
                $.ajax({
                type: "post",
                url: "{{route('admin.edit')}}",
                data: {id:id},
                success: function (response) {
                    console.log(response);
                    if(response)
                    {
                        $('#updateAdmin').modal('show');
                        $('#updateAdminForm').attr('action','{{route("admin.update")}}');
                        $('#id').val(response['id']);
                         $('#up_firstName').val(response['firstName']);
                         $('#up_lastName').val(response['lastName']);
                         $('#up_email').val(response['email']);
                    }

                }
            });
            }

        });

        $('.deleteBtn').on('click',function(){
            alert($(this).attr('data-id'));
        });

});

</script>
@endsection
