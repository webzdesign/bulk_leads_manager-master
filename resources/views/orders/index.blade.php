@extends('layouts.master')
@section('content')
    <div class="middleContent">
        <div class="alert-msg">

        </div>

        <div class="importWrpr">
            <div class="cards">
                <table id="example" class="table datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Order date</th>
                            <th>Last product ordered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/html" id="filterDropdown">
        <div class="d-flex align-items-center filterPanelbtn">
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
                            <label class="c-gr f-500 f-16 w-100 mb-2">Leads Type</label>
                            <select class="select2" name="lead_type_id">
                                <option value="">Select lead type</option>
                                @if (!empty($lead_type))
                                    @foreach ($lead_type as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="c-gr f-500 f-16 w-100 mb-2">Leads Age</label>
                            <select class="select2" name="age_group_id">
                                <option value="">Select leads age</option>
                                @if (!empty($age_group))
                                    @foreach ($age_group as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->age_from .'-' .$value->age_to }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="c-gr f-500 f-16 w-100 mb-2">Gender</label>
                            <select class="select2" name="gender">
                                <option value="">Select gender</option>
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="c-gr f-500 f-16 w-100 mb-2">State</label>
                            <select class="select2" name="state_id">
                                <option value="">Select state</option>
                                @if (!empty($state))
                                    @foreach ($state as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="py-3 cardsFooter d-flex justify-content-end">
                        <button type="button" class="btn-primary f-500 f-14" style="min-width: 84px !important;" id="apply">Apply</button>
                    </div>
                </ul>
            <div>
        </div>
    </script>

    <script type="text/html" id="searchPannel">
        <input class="form-control f-14" placeholder="Search here" id="filterInput">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.6932 14.2957L10.7036 9.31023C11.386 8.35146 11.791 7.1584 11.791 5.90142C11.791 2.64178 9.14704 0 5.8847 0C2.62254 0.00017572 0 2.64196 0 5.90142C0 9.16105 2.64397 11.8028 5.90631 11.8028C7.18564 11.8028 8.35839 11.3981 9.31795 10.7163L14.3076 15.7018C14.4994 15.8935 14.7553 16 15.0113 16C15.2672 16 15.523 15.8935 15.7149 15.7018C16.0985 15.2971 16.0985 14.6792 15.6935 14.2956L15.6932 14.2957ZM1.96118 5.90155C1.96118 3.72845 3.73104 1.98133 5.88465 1.98133C8.03826 1.9815 9.82938 3.72845 9.82938 5.90155C9.82938 8.07466 8.05952 9.82178 5.90591 9.82178C3.7523 9.82178 1.96118 8.05338 1.96118 5.90155Z" fill="#7B809A"/></svg>
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {

            var datatable = $('.datatable').DataTable({
                "dom":"<'filterHeader d-block-500 cardsHeader'<'#filterInput'><'#filterBtn'>>" + "<'row m-0'<'col-sm-12 p-0'tr>>" + "<'row datatableFooter'<'col-md-5 align-self-center'i><'col-md-7'p>>",
                processing: true,
                serverSide: true,
                order: [[3, 'desc']],
                ajax: {
                    "url": "{{ route('admin.get-data') }}",
                    "type": "GET",
                    "dataType": "json",
                    "data": {
                        lead_type_id: function() {
                            return $('[name="lead_type_id"]').val();
                        },
                        age_group_id: function() {
                            return $('[name="age_group_id"]').val();
                        },
                        gender: function() {
                            return $('[name="gender"]').val();
                        },
                        state_id: function() {
                            return $('[name="state_id"]').val();
                        },
                        clientId: "{{ $clientId }}",
                    },
                },
                columns: [
                    {
                        data: 'client.firstName'
                    },
                    {
                        data: 'client.lastName'
                    },
                    {
                        data: 'client.email'
                    },
                    {
                        data: 'order_date'
                    },
                    {
                        data: 'qty'
                    },
                    {
                        data: 'action',
                        className: "c-7b tableCards",
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            $('#filterInput').html($('#searchPannel').html());

            $('#filterBtn').html($('#filterDropdown').html());
            $('#filterInput > input').keyup(function(){
                datatable.search($(this).val()).draw();
            });

            $(document).on("click","#apply", function (t) {
                $('.dropdown-menu').hide();
                datatable.draw();
            });

            $(document).on("click",".resend_order", function (t) {
                var order_id = $(this).attr('data-order_id');
                $('.loaderOverlay').removeClass('d-none');

                $.ajax({
                    type: "POST",
                    url: "{{ url('send-lead') }}"+'/'+order_id,
                    data: '',
                    cache: false,
                    success: function(response){
                        if(response !=''){
                            $('.alert-msg').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '+response+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

                            $('.loaderOverlay').addClass('d-none');
                        }
                    }
                });
            });
        });
    </script>
@endsection
