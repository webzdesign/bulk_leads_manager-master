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
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="c-7b">John</td>
                                        <td class="c-7b">Doe</td>
                                        <td class="c-7b">johndoe@gmail.com</td>
                                        <td class="c-7b">20/05/22</td>
                                        <td class="c-7b">4,000 US Leads | 30-60 Days Old</td>
                                        <td class="c-7b tableCards">
                                            <div class="editDlbtn d-flex">
                                                <a href="javascript:;">
                                                    <button class="cartBtn w-auto px-3 text-white f-500 whiteSpace">
                                                        <svg class="me-2" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.8334 11.9999C11.0934 11.9999 10.5001 12.5933 10.5001 13.3333C10.5001 13.6869 10.6406 14.026 10.8906 14.2761C11.1407 14.5261 11.4798 14.6666 11.8334 14.6666C12.187 14.6666 12.5262 14.5261 12.7762 14.2761C13.0263 14.026 13.1667 13.6869 13.1667 13.3333C13.1667 12.5933 12.5667 11.9999 11.8334 11.9999ZM1.16675 1.33325V2.66659H2.50008L4.90008 7.72659L3.99341 9.35992C3.89341 9.54659 3.83341 9.76659 3.83341 9.99992C3.83341 10.3535 3.97389 10.6927 4.22394 10.9427C4.47399 11.1928 4.81313 11.3333 5.16675 11.3333H13.1667V9.99992H5.44675C5.40254 9.99992 5.36015 9.98236 5.3289 9.9511C5.29764 9.91985 5.28008 9.87745 5.28008 9.83325C5.28008 9.79992 5.28675 9.77325 5.30008 9.75325L5.90008 8.66659H10.8667C11.3667 8.66659 11.8067 8.38659 12.0334 7.97992L14.4201 3.66659C14.4667 3.55992 14.5001 3.44659 14.5001 3.33325C14.5001 3.15644 14.4298 2.98687 14.3048 2.86185C14.1798 2.73682 14.0102 2.66659 13.8334 2.66659H3.97341L3.34675 1.33325H1.16675ZM5.16675 11.9999C4.42675 11.9999 3.83341 12.5933 3.83341 13.3333C3.83341 13.6869 3.97389 14.026 4.22394 14.2761C4.47399 14.5261 4.81313 14.6666 5.16675 14.6666C5.52037 14.6666 5.85951 14.5261 6.10956 14.2761C6.3596 14.026 6.50008 13.6869 6.50008 13.3333C6.50008 12.5933 5.90008 11.9999 5.16675 11.9999Z" fill="white"/>
                                                        </svg>
                                                        Resend Order
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="c-7b">John</td>
                                        <td class="c-7b">Doe</td>
                                        <td class="c-7b">johndoe@gmail.com</td>
                                        <td class="c-7b">20/05/22</td>
                                        <td class="c-7b">4,000 US Leads | 30-60 Days Old</td>
                                        <td class="c-7b tableCards">
                                            <div class="editDlbtn d-flex">
                                                <a href="javascript:;">
                                                    <button class="cartBtn w-auto px-3 text-white f-500">
                                                        <svg class="me-2" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.8334 11.9999C11.0934 11.9999 10.5001 12.5933 10.5001 13.3333C10.5001 13.6869 10.6406 14.026 10.8906 14.2761C11.1407 14.5261 11.4798 14.6666 11.8334 14.6666C12.187 14.6666 12.5262 14.5261 12.7762 14.2761C13.0263 14.026 13.1667 13.6869 13.1667 13.3333C13.1667 12.5933 12.5667 11.9999 11.8334 11.9999ZM1.16675 1.33325V2.66659H2.50008L4.90008 7.72659L3.99341 9.35992C3.89341 9.54659 3.83341 9.76659 3.83341 9.99992C3.83341 10.3535 3.97389 10.6927 4.22394 10.9427C4.47399 11.1928 4.81313 11.3333 5.16675 11.3333H13.1667V9.99992H5.44675C5.40254 9.99992 5.36015 9.98236 5.3289 9.9511C5.29764 9.91985 5.28008 9.87745 5.28008 9.83325C5.28008 9.79992 5.28675 9.77325 5.30008 9.75325L5.90008 8.66659H10.8667C11.3667 8.66659 11.8067 8.38659 12.0334 7.97992L14.4201 3.66659C14.4667 3.55992 14.5001 3.44659 14.5001 3.33325C14.5001 3.15644 14.4298 2.98687 14.3048 2.86185C14.1798 2.73682 14.0102 2.66659 13.8334 2.66659H3.97341L3.34675 1.33325H1.16675ZM5.16675 11.9999C4.42675 11.9999 3.83341 12.5933 3.83341 13.3333C3.83341 13.6869 3.97389 14.026 4.22394 14.2761C4.47399 14.5261 4.81313 14.6666 5.16675 14.6666C5.52037 14.6666 5.85951 14.5261 6.10956 14.2761C6.3596 14.026 6.50008 13.6869 6.50008 13.3333C6.50008 12.5933 5.90008 11.9999 5.16675 11.9999Z" fill="white"/>
                                                        </svg>
                                                        Resend Order
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
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
                            <select class="select2">
                                <option value="hide">Select lead type</option>
                                <option>12 months</option>
                                <option>11 months</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="c-gr f-500 f-16 w-100 mb-2">Leads Age</label>
                            <select class="select2">
                                <option value="hide">Select leads age</option>
                                <option>12 months</option>
                                <option>11 months</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="c-gr f-500 f-16 w-100 mb-2">Gender</label>
                            <select class="select2">
                                <option value="hide">Select gender</option>
                                <option>12 months</option>
                                <option>11 months</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="c-gr f-500 f-16 w-100 mb-2">State</label>
                            <select class="select2">
                                <option value="hide">Select state</option>
                                <option>12 months</option>
                                <option>11 months</option>
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
        $(document).ready(function () {
           var tbl = $('#example').DataTable({
                "dom":"<'filterHeader d-block-500 cardsHeader'<'#filterInput'><'#filterBtn'>>" + "<'row m-0'<'col-sm-12 p-0'tr>>" + "<'row datatableFooter'<'col-md-5 align-self-center'i><'col-md-7'p>>",
                "ordering": false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search here"
                }
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

        });
    </script>
@endsection
