@extends('layouts.master')
@section('content')
    <div class="middleContent">
        <div class="settingWrpr importWrpr">
            <ul class="m-0 importStep row justify-content-center">
                <li
                    class="stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
                    <div class="countStep">
                        <span class="text-white f-16 f-700 d-flex align-items-center justify-content-center">1</span>
                        <svg class="d-none" width="32" height="32" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="16" fill="url(#paint0_linear_1652_6208)" />
                            <path d="M9.33325 16L14.3333 21L22.6666 11" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <defs>
                                <linearGradient id="paint0_linear_1652_6208" x1="16" y1="0" x2="16"
                                    y2="32" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#63B967" />
                                    <stop offset="1" stop-color="#4BA64F" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <p class="mb-0">Upload File</p>
                </li>
                <li
                    class="stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
                    <div class="countStep">
                        <span class="text-white f-16 f-700 d-flex align-items-center justify-content-center">2</span>
                        <svg class="d-none" width="32" height="32" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="16" fill="url(#paint0_linear_1652_6208)" />
                            <path d="M9.33325 16L14.3333 21L22.6666 11" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <defs>
                                <linearGradient id="paint0_linear_1652_6208" x1="16" y1="0" x2="16"
                                    y2="32" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#63B967" />
                                    <stop offset="1" stop-color="#4BA64F" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <p class="mb-0">Check the File</p>
                </li>
                <li
                    class="stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
                    <div class="countStep">
                        <span class="text-white f-16 f-700 d-flex align-items-center justify-content-center">3</span>
                        <svg class="d-none" width="32" height="32" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="16" fill="url(#paint0_linear_1652_6208)" />
                            <path d="M9.33325 16L14.3333 21L22.6666 11" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <defs>
                                <linearGradient id="paint0_linear_1652_6208" x1="16" y1="0" x2="16"
                                    y2="32" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#63B967" />
                                    <stop offset="1" stop-color="#4BA64F" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <p class="mb-0">Mapping</p>
                </li>
                <li
                    class="stepProgress f-16 f-700 c-34 d-inline-flex justify-content-center position-relative align-items-center">
                    <div class="countStep">
                        <span class="text-white f-16 f-700 d-flex align-items-center justify-content-center">4</span>
                    </div>
                    <p class="mb-0">Report</p>
                </li>
            </ul>
            <div class="cards addStep3 d-none">
                <div class="cardsHeader" style="background: linear-gradient(0deg, #FB8E03 0.08%, #FEA321 100.08%);">
                    <h3 class="text-white f-18 f-500 mb-0 f-16-500 file_name"> <span class="f-400">(upload started 6 minutes
                            ago)</span></h3>
                </div>
                <div class="cardsBody p-0">
                    <div class="row uploadStatus">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-4">
                                <div class="colOne c-gr f-16 f-500">Uploaded date:</div>
                                <div class="colTwo c-19 f-16 f-500 uploaded_date"></div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="colOne c-gr f-16 f-500">Uploaded by:</div>
                                <div class="colTwo c-43 f-16 f-500 uploaded_by"></div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="colOne c-gr f-16 f-500">Status:</div>
                                <div class="colTwo c-19 f-16 f-500">Uploaded - Processing</div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="colOne c-gr f-16 f-500">Lead Type:</div>
                                <div class="colTwo c-19 f-16 f-500 lead_type_name"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-4">
                                <div class="colOne c-gr f-16 f-500">Import Progress:</div>
                                <div class="colTwo c-19 f-16 f-500">0% (Step 1 - Scanning file...)</div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="colOne c-gr f-16 f-500">Rows:</div>
                                <div class="colTwo c-43 f-16 f-500">0</div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="colOne c-gr f-16 f-500">Duplicate Records:</div>
                                <div class="colTwo c-19 f-16 f-500">0</div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="colOne c-gr f-16 f-500">Imported Records</div>
                                <div class="colTwo c-19 f-16 f-500">0 <a href="javascript:;" class="c-43">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cards">
                <div class="step active">
                    <div class="cardsHeader">
                        <span class="f-18 f-600 f-16-500 c-gr f-700">Import CSV File</span>
                    </div>
                    <div class="cardsBody">
                        <div class="row">
                            <div class="col-md-8 pr-80">
                                <div>
                                    <h3 class="c-gr f-16 f-500">Title <span class="f-400">(Leave blank to use the
                                            filename as the title)</span></h3>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title">
                                </div>
                                <form class="fileUpload mt-4 text-center position-relative" enctype="multipart/form-data" method="post">
                                    <label for="file" class="f-16 f-500 c-gr fileUploadBx d-block">
                                        <svg width="57" height="69" viewBox="0 0 57 69" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M54.1667 32.8958V18.4583L39.7292 2.41666H6.04171C5.1908 2.41666 4.37475 2.75468 3.77307 3.35636C3.17139 3.95803 2.83337 4.77409 2.83337 5.62499V63.375C2.83337 64.2259 3.17139 65.042 3.77307 65.6436C4.37475 66.2453 5.1908 66.5833 6.04171 66.5833H25.2917M42.9375 42.5208V64.9792M31.7084 53.75H54.1667"
                                                stroke="#4F4F52" stroke-width="4" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M38.125 2.41666V18.4583H54.1667" stroke="#4F4F52" stroke-width="4"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span class="d-block mt-4 file-upload-wrapper"
                                            data-text="Select a CSV file to upload"></span>
                                    </label>
                                    <input type="file" id="file" name="file" class="file-upload-field d-none">
                                    <label class="text-danger f-400 f-14 d-none" id="file_error">CSV File Is Requird.</label>
                                    <label class="text-danger f-400 f-14 d-none" id="invalidFile_error"></label>

                                </form>
                            </div>
                            <div class="col-md-4 mt-20-768">
                                <label class="f-16 c-gr f-500 mb-3">Lead Types</label>
                                @foreach ($leadTypes as $leadType)
                                    <div>
                                        <label class="form-check-label">
                                            <input class="form-check-input checkbox" type="checkbox"
                                                value="{{ $leadType->id }}" name="lead_type[]" />
                                            <span>{{ $leadType->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                                <label class="text-danger f-400 f-14 d-none" id="checkbox_error">Lead Type Is Requird.</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step ">
                    <div class="cardsHeader">
                        <h3 class="c-gr f-18 f-500 mb-0 f-16-500 file_name"> <span class="f-400">(upload started 2 seconds ago)</span></h3>
                    </div>
                    <div class="cardsBody p-0">
                        <div class="fileProgress">
                            <h3 class="f-16 f-500 c-gr">Scanning the uploaded file, please wait...</h3>
                            <div class="progressBar d-flex align-items-center">
                                <div class="progress w-100">
                                    <div class="progress-bar" style="width:0%" data-parcent="100"></div>
                                </div>
                                <span class="ms-3 c-19 f-16 f-500 f-14-500" id="progress-bar">0%</span>
                            </div>
                        </div>
                        <div class="row uploadStatus">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Uploaded date:</div>
                                    <div class="colTwo c-19 f-16 f-500 uploaded_date"></div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Uploaded by:</div>
                                    <div class="colTwo c-43 f-16 f-500 uploaded_by"></div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Status:</div>
                                    <div class="colTwo c-19 f-16 f-500">Uploaded - Processing</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Lead Type:</div>
                                    <div class="colTwo c-19 f-16 f-500 lead_type_name"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Import Progress:</div>
                                    <div class="colTwo c-19 f-16 f-500">0% (Step 1 - Scanning file...)</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Rows:</div>
                                    <div class="colTwo c-43 f-16 f-500">0</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Duplicate Records:</div>
                                    <div class="colTwo c-19 f-16 f-500">0</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Imported Records</div>
                                    <div class="colTwo c-19 f-16 f-500">0 <a href="javascript:;"
                                            class="c-43">Download</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step stepThree">
                    <div class="cardsHeader">
                        <h3 class="c-gr f-18 f-500 mb-0 f-16-500">Select headings then click save</h3>
                    </div>
                    <div class="cardsBody p-0 tableCards ">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    @foreach ($leadFields as $key => $leadField)
                                        <th>
                                            <select class="select2 select_field" name="select_field" id="select_field{{$key}}">
                                                <option value="null"> -- Select --</option>
                                                @foreach ($leadFields as $leadField)
                                                    <option value="{{ $leadField->id }}">{{ $leadField->name }}</option>
                                                @endforeach
                                            </select>
                                            <label class="text-danger f-400 f-14 d-none" id="select_heading{{$key}}">Select Heading</label>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="step">
                    <div class="cardsHeader">
                        <h3 class="c-gr f-18 f-500 mb-0 f-16-500 file_name"> <span class="f-400">(uploaded 3 hours
                                ago)</span></h3>
                    </div>
                    <div class="cardsBody p-0">
                        <div class="row uploadStatus">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Uploaded date:</div>
                                    <div class="colTwo c-19 f-16 f-500 uploaded_date"></div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Uploaded by:</div>
                                    <div class="colTwo c-43 f-16 f-500 uploaded_by"></div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Status:</div>
                                    <div class="colTwo c-4b f-16 f-500">Import Successful</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Lead Type:</div>
                                    <div class="colTwo c-19 f-16 f-500 lead_type_name"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Rows:</div>
                                    <div class="colTwo c-43 f-16 f-500">2499</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Duplicate Records:</div>
                                    <div class="colTwo c-19 f-16 f-500">345 <a href="javascript:;"
                                            class="c-43">Download</a></div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Invalid Records:</div>
                                    <div class="colTwo c-19 f-16 f-500">155 (155 of these are missing an email)</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Imported Records</div>
                                    <div class="colTwo c-19 f-16 f-500">1999 <a href="javascript:;"
                                            class="c-43">Download</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cardsFooter d-flex justify-content-end">
                    <button class="btn-primary f-500 f-14" id="next">Save & continue import</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        $(document).ready(function() {

            $("input:checkbox").on('click', function() {
                var $box = $(this);
                if ($box.is(":checked")) {
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";

                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                } else {
                    $box.prop("checked", false);
                }
            });

            $('#next').on('click', function(e) {
                e.preventDefault();
                count = 0;
                var index = $(".step.active").index(".step")

                if(index == 0) {
                    var selectcheckbox = selectCheckbox();
                    var filecheck = fileCheck();
                    if (selectcheckbox == true && filecheck == true) {
                        var leadTypeId = '';

                        $('.checkbox').each(function(i) {
                            if ($(this).is(':checked')) {
                                leadTypeId = $(this).val();
                            }
                        });

                        var files = $('#file')[0].files;

                        var formData = new FormData();
                        formData.append('lead_type_id',leadTypeId)
                        formData.append('file', document.querySelector('#file').files[0]);
                        formData.append('title', $("#title").val())

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.import.importCSV') }}",
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            data: formData,
                            success: function(res) {
                                if(res[0] == 'error') {
                                    $('#invalidFile_error').text(res[1]);
                                    $('#invalidFile_error').removeClass('d-none');
                                } else {
                                    setpwizard();

                                    let count = 0
                                    let innerbar = document.querySelector('.progress-bar')

                                    function progress(){
                                        count++
                                        innerbar.style.width =`${count}%`
                                        $("#progress-bar").text(innerbar.style.width);
                                        if(count==100){
                                            setpwizard();
                                            $('#next').show();
                                            clearInterval(stop)
                                        }
                                    }

                                    let stop = setInterval(function(){
                                        progress()
                                    },[100])

                                    getSheetData(res.lead_type_id);

                                    $('.file_name').text(res.file_name);
                                    $('.uploaded_date').text(res.uploaded_date);
                                    $('.uploaded_by').text(res.uploaded_by);
                                    $('.lead_type_name').text(res.lead_type);
                                    $('#invalidFile_error').addClass('d-none');
                                }
                            }
                        })

                    }
                }

                if(index == 2) {
                    var selectfield = selectField();

                    if(selectfield == true) {

                        var list = [];
                        $('.select_field > option:selected').each(function() {
                            list.push($(this).val());
                        })

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.import.start_upload') }}",
                            data: {id: list},
                            success: function (res) {

                            }
                        });
                    }
                }

            });

            function selectCheckbox() {
                var status = true;
                if ($('.checkbox').is(":checked")) {
                    $('#checkbox_error').addClass('d-none');
                    status = true;
                } else {
                    $('#checkbox_error').removeClass('d-none');
                    status = false;
                }

                return status;
            }

            function fileCheck() {
                var status = true;

                if($('#file').get(0).files.length == 0) {
                    $('#file_error').removeClass('d-none');
                    status = false;
                } else {
                    $('#file_error').addClass('d-none');
                    status = true;
                }

                return status;
            }

            function selectField() {
                var status = [];
                $('.select_field > option:selected').each(function(key, value) {
                    var value = $(this).val();
                    if(value == 'null') {
                        $('#select_heading'+key+'').removeClass('d-none');
                        status.push(value);
                    } else {
                        $('#select_heading'+key+'').addClass('d-none');
                        status.push(value);
                    }
                });

                if($.inArray("null", status) !== -1) {
                    return false;
                } else {
                    return true;
                }

            }

            $('.select_field').on('change', function(e) {
                var id = $(this).attr('id');
                var value = $(this).val();

                $('.select_field').each(function() {
                    if(id != $(this).attr('id')) {

                        var field_id = $(this).attr('id');
                        $('#'+field_id+' option[value='+value+']').prop('disabled', true);

                    } else {

                    }
                });

            });

            function getSheetData(id) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.import.getData') }}",
                    dataType: "json",
                    data:{ id: id},
                    success: function(res) {
                        var tbody = '';

                        $.each(res, function (key, value) {
                            tbody += "<tr>";
                            $.each(value, function(subkey, subvalue){
                                tbody += "<td>"
                                tbody += subvalue
                                tbody += "</td>"
                            });
                            tbody += "</tr>";
                        });

                        $('#tbody').append(tbody);

                    }
                })
            }

            function setpwizard()
            {
                var index = $(".step.active").index(".step"),
                stepsCount = $(".step").length

                if (index < stepsCount - 0) {
                    for (i = 0; i <= index; i++) {
                        $(".stepProgress").eq(i).addClass("done");
                    }
                    index++;
                    $(".step").removeClass("active").eq(index).addClass("active");
                    $(".stepProgress").eq(index).addClass("active");
                    $('#next').hide();
                };

                if (index == 2) {
                    $(".stepProgress").parent().parent().parent().find(".addStep3").removeClass("d-none");
                } else {
                    $(".stepProgress").parent().parent().parent().find(".addStep3").addClass("d-none");
                }

                if (index == 3) {
                    $(".stepProgress").parent().parent().parent().find(".cards .cardsFooter").removeClass("d-flex").addClass('d-none');
                }
            }

        });
    </script>
@endsection
