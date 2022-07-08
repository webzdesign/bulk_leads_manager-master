@extends('layouts.master')
@section('content')
    <div class="middleContent">
        <div class="cards tableCards">
            <div class="cardsHeader d-flex justify-content-end">
                <button class="btn-default f-500 f-14" data-bs-toggle="modal" data-bs-target="#Fields">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.60209 7.99908C5.60209 9.27016 6.67761 10.3006 8.00435 10.3006C9.33107 10.3006 10.4066 9.27016 10.4066 7.99908C10.4066 6.72799 9.33107 5.69759 8.00435 5.69759C6.67761 5.69758 5.60209 6.728 5.60209 7.99908ZM8 3.20703C9.37367 3.21312 10.7975 3.54754 12.1454 4.18779C13.1462 4.68275 14.1215 5.38107 14.9681 6.243C15.3839 6.68299 15.9143 7.32008 16 7.99983C15.9899 8.58864 15.3583 9.31542 14.9681 9.75667C14.1742 10.5848 13.2243 11.2636 12.1454 11.8124C10.8884 12.4224 9.49717 12.7736 8 12.7932C6.62503 12.787 5.20149 12.4487 3.85512 11.8124C2.85435 11.3174 1.87855 10.6186 1.03192 9.75667C0.61612 9.31668 0.0857592 8.67958 0 7.99983C0.0101328 7.41102 0.641733 6.68422 1.03192 6.24298C1.82583 5.4149 2.77624 4.73659 3.85512 4.18776C5.11141 3.57822 6.50611 3.22942 8 3.20703ZM8.00101 4.397C5.91943 4.397 4.23201 6.01026 4.23201 8.00035C4.23201 9.99043 5.91943 11.6037 8.00101 11.6037C10.0826 11.6037 11.77 9.99042 11.77 8.00035C11.77 6.01026 10.0826 4.397 8.00101 4.397Z"
                            fill="url(#paint0_linear_1524_12112)" />
                        <defs>
                            <linearGradient id="paint0_linear_1524_12112" x1="8" y1="3.20703" x2="8"
                                y2="12.7932" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#3F189F" />
                                <stop offset="1" stop-color="#4C26AA" />
                            </linearGradient>
                        </defs>
                    </svg>
                    View Fields
                </button>
                <button class="btn-default f-500 f-14" data-bs-toggle="modal" data-bs-target="#Group" id="age_add_button">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.00008 13.3332V7.99984M8.00008 7.99984V2.6665M8.00008 7.99984H13.3334M8.00008 7.99984H2.66675"
                            stroke="url(#paint0_linear_1524_12120)" stroke-width="2" stroke-linecap="round" />
                        <defs>
                            <linearGradient id="paint0_linear_1524_12120" x1="8.00008" y1="2.6665" x2="8.00008"
                                y2="13.3332" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#3F189F" />
                                <stop offset="1" stop-color="#4C26AA" />
                            </linearGradient>
                        </defs>
                    </svg>
                    Add Age Group
                </button>
                <button class="btn-primary f-500 f-14" data-bs-toggle="modal" data-bs-target="#LeadType" id="add_lead_type">
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
                    Add New Lead Type
                </button>
            </div>
            <div class="cardsBody">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>age groups</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($LeadTypes as $LeadType)
                            <tr>
                                <td class="align-middle">{{ $LeadType->name }}</td>
                                <td>
                                    @foreach ($ageGroups as $ageGroup)
                                        @if ($LeadType->id == $ageGroup->lead_type_id)
                                            <div class="mb-2 d-flex align-items-center">
                                                <div class="dayBx">{{ $ageGroup->age_from }} - {{ $ageGroup->age_to }}
                                                    days <span class="c-7b">(0 records)</span></div>
                                                <div class="editRemove">
                                                    <label class="cursor-pointer c-16 f-14 f-500 age_edit" data-ageId="{{ $ageGroup->id }}">Edit</label>
                                                    <label class="cursor-pointer c-e9 f-14 f-500 age_remove"
                                                        data-ageId="{{ $ageGroup->id }}">Remove</label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    <div class="editDlbtn d-flex">
                                        <a href="javascript:;">
                                            <button class="editBtn" data-id="{{ $LeadType->id }}">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.8067 4.69354C14.0667 4.43354 14.0667 4.0002 13.8067 3.75354L12.2467 2.19354C12 1.93354 11.5667 1.93354 11.3067 2.19354L10.08 3.41354L12.58 5.91354L13.8067 4.69354ZM2 11.5002V14.0002H4.5L11.8733 6.6202L9.37333 4.1202L2 11.5002Z"
                                                        fill="white" />
                                                </svg>
                                            </button>
                                        </a>
                                        <button class="deleteBtn" data-id="{{ $LeadType->id }}">
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

    <!-- Fields Modal -->
    <div class="modal fade fieldsModal" id="Fields">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Fields</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <ul class="fieldList">
                        @foreach ($leadFields as $leadField)
                            <li class="f-16 f-500 c-gr">{{ $leadField->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn-primary text-uppercase" style="min-width: 67px;"
                        data-bs-dismiss="modal">ok</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Fields Modal End-->

    <!-- Age Group Modal -->
    <div class="modal fade fieldsModal groupModal" id="Group">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="age_title">Add Age Group</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row align-items-center mb-3">
                        <div class="col-md-4">
                            <label class="c-gr f-16 f-500">Record Age FROM:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="age_from" id="age_from" class="form-control">
                            <input type="text" id="age_group_id" hidden>
                            <label class="text-danger f-400 f-14 d-none" id="age_from_err">Age FROM Is Required.</label>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label class="c-gr f-16 f-500">Record Age TO:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="age_to" id="age_to" class="form-control">
                            <label class="text-danger f-400 f-14 d-none" id="age_to_err">Age TO Is Required.</label>
                        </div>
                    </div>
                    <div class="devider"></div>
                    <div class="row align-items-center mt-4">
                        <div class="col-md-4">
                            <label class="c-gr f-16 f-500">Lead Type Assigned to:</label>
                        </div>
                        <div class="col-md-8">
                            <select name="lead_type_assign" id="lead_type_assign">
                                <option value="hide">Select lead type</option>
                                @foreach ($LeadTypes as $LeadType)
                                    <option value="{{ $LeadType->id }}">{{ $LeadType->name }}</option>
                                @endforeach
                            </select>
                            <label class="text-danger f-400 f-14 d-none" id="lead_type_assign_err">Lead Type Is Required.</label>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="age_submit" class="btn-primary" style="min-width: 74px;">Add</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Age Group Modal-->

    <!-- LeadType Modal -->
    <div class="modal fade fieldsModal groupModal" id="LeadType">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="lead_type_title">Add Lead Type</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row align-items-center mb-3">
                        <div class="col-md-4">
                            <label class="c-gr f-16 f-500">Lead Type:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="lead_type" name="lead_type" class="form-control"
                                placeholder="Enter lead type">
                            <input type="text" id="lead_id" hidden>
                            <label class="text-danger f-400 f-14 d-none" id="lead_err">Lead Type Is Required.</label>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="lead_type_submit" class="btn-primary" style="min-width: 74px;"
                        data-update="false">Add</button>
                </div>

            </div>
        </div>
    </div>
    <!-- LeadType Modal End-->
@endsection
@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $('#add_lead_type').on('click', function(e) {
                $('#lead_type_title').text('Add Lead Type');
                $('#lead_type').val('');
                $('#lead_type_submit').text('Add');
                $('#lead_type_submit').attr('data-update', 'false');
                $('#lead_id').val('');
            });

            $('#age_add_button').on('click', function(e) {
                $('#age_title').text('Add Age Group');
                $('#age_submit').text('Add');
                $('#age_from').val('');
                $('#age_to').val('');
                $('#age_group_id').val('');
                var selected = $('#lead_type_assign option[value="hide"]').attr('selected','selected').text();
                $('.select-styled').text(selected);
            });

            $('#lead_type_submit').on('click', function(e) {
                var value = $('#lead_type').val();

                if (value == null || value == '') {
                    $('#lead_err').removeClass('d-none');
                } else {
                    $('#lead_err').addClass('d-none');
                    id = $("#lead_id").val();
                    if (id != '') {
                        var type = "UPDATE";
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.lead_type.store_lead_type') }}",
                        data: {
                            lead_type: value,
                            id: id,
                            type: type
                        },
                        success: function(res) {
                            if (res[0] == true) {
                                $('#LeadType').modal('hide');
                                $('#lead_type').val('');

                                Swal.fire({
                                    icon: "success",
                                    title: res[1],
                                    text: res[2],
                                }).then(function() {
                                    window.location.reload();
                                });
                            }
                        }
                    });
                }
            });

            $(".deleteBtn").on('click', function(e) {

                var id = $(this).attr('data-id')
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.lead_type.delete') }}",
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
                })
            });

            $(".editBtn").on('click', function(e) {
                $('#LeadType').modal('show');
                $('#lead_type_title').text('Edit Lead Type');
                $('#lead_type_submit').text('Update');
                $('#lead_type_submit').attr('data-update', 'true');
                $('#lead_err').addClass('d-none');

                var id = $(this).attr('data-id')
                $('#lead_id').val(id);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.lead_type.edit') }}",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        $('#lead_type').val(res[1]);
                    }
                });

            });

            $('#age_submit').on('click', function(e) {
                var ageFrom = $('#age_from').val();
                var ageTo = $('#age_to').val();
                var leadType = $('#lead_type_assign').val();

                if (ageFrom == '') {
                    $('#age_from_err').removeClass('d-none');
                } else {
                    $('#age_from_err').addClass('d-none');
                }
                if (ageTo == '') {
                    $('#age_to_err').removeClass('d-none');
                } else {
                    $('#age_to_err').addClass('d-none');
                }
                if (leadType == 'hide') {
                    $('#lead_type_assign_err').removeClass('d-none');
                } else {
                    $('#lead_type_assign_err').addClass('d-none');
                }

                if (ageFrom != '' && ageTo != '' && leadType != 'hide') {
                    var age_group_id = $('#age_group_id').val();
                    if(age_group_id != ''){
                        var type = "UPDATE";
                        var id = age_group_id;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.lead_type.store_age_group') }}",
                        data: {
                            age_from: ageFrom,
                            age_to: ageTo,
                            lead_type: leadType,
                            id: id,
                            type: type
                        },
                        success: function(res) {
                            if (res[0] == true) {
                                $('#Group').modal('hide');

                                Swal.fire({
                                    icon: "success",
                                    title: res[1],
                                    text: res[2],
                                }).then(function() {
                                    window.location.reload();
                                });
                            }
                        }
                    });
                }
            });

            $('.age_remove').on('click', function(e) {

                var id = $(this).attr('data-ageID')
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.lead_type.age_delete') }}",
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
                        })
                    }
                })
            });

            $('.age_edit').on('click', function(e){
                $('#age_from_err').addClass('d-none');
                $('#age_to_err').addClass('d-none');
                $('#lead_type_assign_err').addClass('d-none');
                var id = $(this).attr('data-ageId')

                $('#Group').modal('show');
                $('#age_title').text('Edit Age Group');
                $('#age_submit').text('Update');

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.lead_type.age_edit') }}",
                    data: {id : id},
                    success: function(res) {
                        if(res[0] == true) {
                            $('#age_group_id').val(res[1].id);
                            var selected = $('#lead_type_assign option[value='+res[1].lead_type_id+']').attr("selected", "selected").text();
                            $('.select-styled').text(selected);
                            $('#age_from').val(res[1].age_from);
                            $('#age_to').val(res[1].age_to);
                        }
                    }
                });
            });

        });
    </script>
@endsection
