@extends('layouts.master')
@section('content')
                <div class="middleContent">
                    <div class="importWrpr">
                        <div class="cards">
                            <table id="example" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="form-check-label mb-0" for="lbl1">
                                                <input class="form-check-input mt-0 all-checkbox" type="checkbox" id="lbl1"/>
                                            </label>
                                        </th>
                                        <th>age</th>
                                        <th>email</th>
                                        <th>first name</th>
                                        <th>last name</th>
                                        <th>gender</th>
                                        <th>phone</th>
                                        <th>zip</th>
                                        <th>state</th>
                                        <th>address</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <input type="text" id='leadType' hidden/>
                        </div>
                    </div>
                </div>

    @endsection
    @section('script')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/html" id="filterDropdown">
        <div class="d-flex align-items-center filterPanelbtn">
            <div>
                <button class="btn-danger f-500 me-2 deleteBtn" disabled="">
                    <svg class="me-1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.6666 2.66667H10.3333L9.66659 2H6.33325L5.66659 2.66667H3.33325V4H12.6666V2.66667ZM3.99992 12.6667C3.99992 13.0203 4.14039 13.3594 4.39044 13.6095C4.64049 13.8595 4.97963 14 5.33325 14H10.6666C11.0202 14 11.3593 13.8595 11.6094 13.6095C11.8594 13.3594 11.9999 13.0203 11.9999 12.6667V4.66667H3.99992V12.6667Z" fill="#fff"></path>
                    </svg>
                    Delete
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
                            <label class="c-gr f-500 f-16 w-100 mb-2">Leads Type</label>
                            <select id='leadTypeDD' class="select2">
                                <option value="">Select lead type</option>
                                @foreach ($leadTypes as $leadType)
                                <option value="{{$leadType->id}}">{{$leadType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="c-gr f-500 f-16 w-100 mb-2">Leads Age</label>
                            <select id='leadAgeDD' class="select2">
                                <option value="">Select Lead Age</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="c-gr f-500 f-16 w-100 mb-2">Gender</label>
                            <select id='genderDD' class="select2">
                                <option value="">Select gender</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="c-gr f-500 f-16 w-100 mb-2">State</label>
                            <select id='stateDD' class="select2">
                                <option value="">Select State</option>
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

         var selected = [];
        var state,leadType,leadAge,gender,datatable;
        $(document).ready(function () {

           var datatable = $('#example').DataTable({
                "dom":"<'filterHeader d-block-500 cardsHeader'<'#filterInput'><'#filterBtn'>>" + "<'row m-0'<'col-sm-12 p-0'tr>>" + "<'row datatableFooter'<'col-md-5 align-self-center'i><'col-md-7'p>>",
                "ordering": false,
                processing: true,
                serverSide: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search here"
                },
                ajax: {
                    "url": "{{ route('admin.leads.getData') }}",
                    "dataType": "json",
                    "type": "GET",
                    "data":{
                        state: function() {
						    return $("#stateDD").val();
					    },
                        leadType: function() {
						    return $("#leadTypeDD").val();
					    },
                        leadAge: function() {
						    return $("#leadAgeDD").val();
					    },
                        gender: function() {
						    return $("#genderDD").val();
					    },
                    }
                },
                columns: [
                    {data: 'check',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'age',
                    },
                    {
                        data: 'email',
                    },
                    {
                        data: 'first_name',
                    },
                    {
                        data: 'last_name',
                    },
                    {
                        data: 'gender',
                    },
                    {
                        data: 'phone_number',
                    },
                    {
                        data: 'zip',
                    },
                    {
                        data:'state',
                    },
                    {
                        data:'address',
                    }
                ],
            });

            $('#filterInput').html($('#searchPannel').html());

            $('#filterBtn').html($('#filterDropdown').html());
            $('#filterInput > input').keyup(function(){
                datatable.search($(this).val()).draw();
            });

            $('#apply').bind("click",  function (t) {
                t.preventDefault();
                $(".button-dropdown .dropdown-menu").hide();
            });

            $('body').on('click', '.selected', function(e) {
                alert(selected);
                if($(this).is(':checked') == true){
                    $('.deleteBtn').removeAttr('disabled')
                selected = $("input.selected:checked").map(function(){
                    return $(this).val();
                }).get();
                }
                else if($(this).is(':checked') == false && selected.length>0)
                {
                    selected = $("input.selected:checked").map(function(){
                    return $(this).val();
                    }).get();
                }
                else
                {
                    $(this).prop("checked", false);
                    selected = [];
                }
            });

            $('body').on('click', '.all-checkbox', function(e) {
                if($('.all-checkbox').is(':checked') == true){
                    $('.deleteBtn').removeAttr('disabled')
                    $(".selected").prop("checked", true);
                    selected = $("input.selected").map(function(){
                        console.log($(this).val());
                        return $(this).val();
                    }).get();
                }else if($('.selected').is(':checked') == true){
                    selected = $("input.selected:checked").map(function(){
                    return $(this).val();
                }).get();
                }
                else{
                    $(".selected").prop("checked", false);
                    selected = [];
                }
            });



        $(document).on('click','#apply',function(){
                state = $('#stateDD').val();
                leadType = $('#leadTypeDD').val();
                leadAge = $('#leadAgeDD').val();
                gender = $('#genderDD').val();
                console.log("state:"+state,"leadType:"+leadType,"leadAge:"+leadAge,"gender:"+gender);
                datatable.draw();
            });



        $(document).on('click','.deleteBtn',function(e){
            alert(selected);
            if (selected.length > 0){
                Swal.fire({
                    title: '{{ __("Are you sure?") }}',
                    text: '{{__("You want to remove this records!")}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: "{{ __('Cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{route('admin.leads.bulkRemove')}}",
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                selected: selected
                            },
                            success: function(res) {
                                Swal.fire(
                                    'User',
                                    'Records are removed Succesfully!',
                                    'success'
                                ).then(function() {
                                    datatable.draw();
                                    });
                              selected = [];
                            }
                        });
                    }
                });
            } else
            {
                Swal.fire({
                    title: '{{ __("Error!") }}',
                    text: '{{ __("Please first make a selection from the list.") }}',
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("Okay!") }}'
                });
            }
        });

        $('#leadTypeDD').on('change', function(){
            var type = $(this).val();
            console.log(type);
            $.ajax({
                type: "POST",
                url: "{{route('admin.leads.getAge')}}",
                data: {
                    type:type
                },
                success: function (response) {
                     console.log(response[0].length);
                    if(response[0].length > 0)
                    {
                         response[0].forEach(function(el, index) {
                            $('body').find('#leadAgeDD').append('<option value='+el.id+'> '+ response[1] + '|'+ el.age_from + '-' + el.age_to +' </option>');
                        });
                    }
                }
            });
        });


    });




    </script>
@endsection
