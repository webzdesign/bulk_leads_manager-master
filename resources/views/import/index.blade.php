@extends('layouts.master')
@section('content')

<div class="middleContent">
        <div class="alert alert-primary mb-4 text-center d-none" id="upload_text">
           <h2 class="display-6">File is being processed...</h2>
        </div>  
        <div class="progress mb-4" id="progress_upload" style="height: 20px;">
          <div class="progress-bar" role="progressbar" id="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" aria-label="Example with label">0%</div>
        </div>
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
                    <h3 class="text-white f-18 f-500 mb-0 f-16-500 file_name"> <span class="f-400"></span></h3>
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
                                <div class="colTwo c-19 f-16 f-500" id="import_progress">0% (Step 1 - Scanning file...)</div>
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
                                    <div class="progress-bar" style="width:1%" data-parcent="100" id="file-percentage"></div>
                                </div>
                                <span class="ms-3 c-19 f-16 f-500 f-14-500" id="progress-bar">1%</span>
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
                                <div class="d-flex align-items-center mb-4" >
                                    <div class="colOne c-gr f-16 f-500" >Import Progress:</div>
                                    <div class="colTwo c-19 f-16 f-500" >0% (Step 1 - Scanning file...)</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500" >Rows:</div>
                                    <div class="colTwo c-43 f-16 f-500">0</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500" >Duplicate Records:</div>
                                    <div class="colTwo c-19 f-16 f-500" >0 <a href="javascript:;"
                                        class="c-43">Download</a></div>
                                </div>
                                <div class="d-flex align-items-center mb-4" id='invalidRowsDiv' hidden>
                                    <div class="colOne c-gr f-16 f-500" >Invalid Records:</div>
                                    <div class="colTwo c-19 f-16 f-500" >0</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Imported Records</div>
                                    <div class="colTwo c-19 f-16 f-500" >0 <a href="javascript:;"
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
                        <table class="table mb-0" id='mainTable'>
                            @php
                                $leadFieldsMain = $leadFields;
                            @endphp
                            <thead id='thead'>
                                {{-- <tr>
                                    @foreach ($leadFieldsMain as $key => $leadField)
                                        <th>
                                            <select class="select2 select_field leadSelect" name="select_field" id="select_field{{$key}}">
                                                <option value="null"> -- Select --</option>
                                                @foreach ($leadFields as $leadField)
                                                    <option value="{{ $leadField->id }}">{{ $leadField->name }}</option>
                                                @endforeach
                                            </select>
                                            <label class="text-danger f-400 f-14 d-none" id="select_heading{{$key}}">Select Heading</label>
                                        </th>
                                    @endforeach
                                </tr> --}}
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="step">
                    <div class="cardsHeader">
                        <h3 class="c-gr f-18 f-500 mb-0 f-16-500 file_name"> <span class="f-400" id='card3Header'>(uploaded 3 hours ago)</span></h3>
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
                                    <div class="colTwo c-43 f-16 f-500" id='totalRows'>&nbsp;</div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Duplicate Records:</div>
                                    <div class="colTwo c-19 f-16 f-500" > <span id='duplicateRows'></span> <a href="javascript:;"
                                            class="c-43 download" data-text="duplicate" data-lead='{{isset($lead) ? $lead :''}}'>Download</a></div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Invalid Records:</div>
                                    <div class="colTwo c-19 f-16 f-500" id='invalidRows'> </div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Rejected Records:</div>
                                    <div class="colTwo c-19 f-16 f-500" id='rejectRecords'> </div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="colOne c-gr f-16 f-500">Imported Records</div>
                                    <div class="colTwo c-19 f-16 f-500" ><span id='importRows'></span> <a  href="javascript:;"
                                            class="c-43 download" data-text="import" data-lead='{{isset($lead) ? $lead :''}}'>Download</a></div>
                                </div>
                                <div id='lead_id' hidden></div>
                                <div hidden id='file_in_db'></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cardsFooter d-flex justify-content-end">
                    <form id="fileUploadForm" enctype="multipart/form-data">
                    <button class="btn-primary f-500 f-14" type="submit" id="next">Save & continue import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="days">

@endsection
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let idArr = [];
        var width = 0;
        var import_progress = 0;
        var startDate = 0;
        var days = 0; var hours = 0; var minutes = 0; secs = 0;
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        var leadId = '';
        var FileName = '';
        var progressPercentage = 0;
        let progressResponse;
        var request_token = "session()->get('_token')";
        $("#loaderOverlay").removeClass('d-none');
        $("#progress_upload").addClass('d-none').removeClass("progress");
        $(document).ready(function() {
            $("#loaderOverlay").addClass('d-none');
            function enableProgress(enabled = true) {
                if(enabled) {
                    $("#progressbar").addClass('progress-bar-animated progress-bar-striped');
                } else {
                    $("#progressbar").removeClass('progress-bar-animated progress-bar-striped');
                }
            }
            function setDefaultWidth(timer = 0) {
                setTimeout(function(){
                    $("#progress_upload").removeClass('d-none').addClass("progress");
                    $("#upload_text").removeClass('d-none');
                    enableProgress();
                    $("#progressbar").html('0%');
                    $('#progressbar').css("width", '100%', function() {
                        return $(this).attr("aria-valuenow", 0) + "%";
                    })
                }, timer);
            }
            function setZeroWidth(timer = 0) {
                setTimeout(function(){
                    $("#upload_text").addClass('d-none');
                    enableProgress(false);
                    $("#progressbar").html('0%');
                    $('#progressbar').css("width", '0%', function() {
                        return $(this).attr("aria-valuenow", 0) + "%";
                    })
                }, timer);
            }
            function setFullWidth(callBackFun) {
                $("#upload_text").addClass('d-none');
                enableProgress(false);
                $("#progressbar").html('100%');
                $('#progressbar').css("width", '100%', function() {
                    return $(this).attr("aria-valuenow", 100) + "%";
                });
                callBackFun();
            }
            function stopInterval() {
                if(progressResponse != null && typeof progressResponse != 'undefined') {
                    clearInterval(progressResponse);
                    progressResponse = null;
                }
            }
            function setUploadDetail() {
                $(".addStep3").addClass('d-none');
                $(".step").addClass('d-none').removeClass('active');
                $(".step:last").removeClass('d-none').addClass('active');
                $(".cardsFooter").addClass('d-none');
            }
            function getUploadProgress () {
                
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.lead.upload_progress') }}",
                    success: function(res) {
                        if(res.notify != null && typeof res.notify != 'undefined') {
                            stopInterval();
                            $("#progress_upload").removeClass('d-none').addClass("progress");
                            enableProgress(false);
                            $("#progressbar").html('100%');
                            $('#progressbar').width('100%', function() {
                                return $(this).attr("aria-valuenow", 100) + "%";
                            });
                            setUploadDetail();
                            $('#totalRows', $(".step:last")).text(res.notify.thread.rows);
                            $('#duplicateRows', $(".step:last")).text(res.notify.thread.duplicate);
                            $('#invalidRows', $(".step:last")).text(res.notify.thread.invalid + ' ('+res.notify.thread.invalid+' of these are missing an Phone Number.)' );
                            $('#importRows', $(".step:last")).text(res.notify.thread.import);
                            $('#lead_id', $(".step:last")).text(res.notify.thread.lead);
                            $("#rejectRecords", $(".step:last")).text(res.notify.thread.rejected);
                            $("#loaderOverlay").addClass('d-none');
                            Swal.fire({
                                icon: "info",
                                title: "imported Successfully",
                                text: "File Uploaded Successfully.",
                            });
                        } else {
                            if(typeof res.file_in_progress != 'undefined' && res.file_in_progress == true) {
                                $("#loaderOverlay").removeClass('d-none');
                                setUploadDetail();
                                setDefaultWidth();
                            } else {
                                let totalCounts = parseInt(res.total_count);
                                let recordCounts = parseInt(res.inserted_count);
                                progressPercentage = parseInt(recordCounts/totalCounts * 100);
                                $("#progress_upload").removeClass('d-none').addClass("progress");
                                if(totalCounts > 0 && recordCounts > 0) {
                                    $("#loaderOverlay").removeClass('d-none');
                                    setUploadDetail();
                                    $("#upload_text").removeClass('d-none');
                                    enableProgress(false);
                                    $("#progressbar").html(progressPercentage+'%');
                                    $('#progressbar').width(progressPercentage+'%', function() {
                                        return $(this).attr("aria-valuenow", progressPercentage) + "%";
                                    })
                                    if (progressPercentage >= 100) {
                                        stopInterval();
                                        setFullWidth(function() {
                                            setZeroWidth(3000)
                                        });
                                    }
                                } else {
                                    $("#loaderOverlay").addClass('d-none');
                                    setZeroWidth();
                                }
                            }
                        }
                    },
                    error:function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR, textStatus, errorThrown)
                    }
                });
            }
            
            getUploadProgress(true);
            progressResponse = setInterval(function() {
                getUploadProgress();
            }, 5000);
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
                var index = $(".step.active").index(".step");

                if(index == 0) {
                    var selectcheckbox = selectCheckbox();
                    var filecheck = fileCheck();
                    if (selectcheckbox == true && filecheck == true) {
                        var date = new Date().getTime();
                        startDate = date;
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
                        formData.append('title', $("#title").val());

                        var filesize = document.querySelector('#file').files[0].size;
                        $("#loaderOverlay").removeClass('d-none');

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.import.importCSV') }}",
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            data: formData,
                            success: function(res) {
                                $("#loaderOverlay").addClass('d-none');
                                if(res[0] == 'error') {
                                    $('#invalidFile_error').text(res[1]);
                                    $('#invalidFile_error').removeClass('d-none');
                                } else {
                                    FileName = res.file_name;
                                    uploadTime(res.file_name);
                                    setpwizard();

                                    let count = 0

                                    let stop = setInterval(function(){
                                        width += 1;
                                        $("#file-percentage.progress-bar").css('width', width + '%');
                                        $("#progress-bar").text(width + '%');

                                        if (width >= 100) {
                                            clearInterval(stop);
                                            uploadTime(res.file_name);
                                            setpwizard();
                                            $('#next').show();
                                        }
                                    },[5000])

                                    getSheetData(res.leadId);
                                    leadId = res.leadId;


                                    $('.file_name').text(res.file_name + " (upload started "+ hours +" hours "+ minutes +" minutes "+ secs +" seconds ago)");
                                    $('.uploaded_date').text(res.uploaded_date);
                                    $('.uploaded_by').text(res.uploaded_by);
                                    $('.lead_type_name').text(res.lead_type);
                                    $('#invalidFile_error').addClass('d-none');
                                    $('#file_in_db').text(res.file_in_db);

                                }
                            }
                        })

                    }
                }

                function uploadTime(res) {
                    const diff = new Date().getTime() - startDate;
                    days = diff / (24*60*60*1000);
                    hours = (days % 1) * 24;
                    minutes = (hours % 1) * 60;
                    secs = (minutes % 1) * 60;
                    [days, hours, minutes, secs] = [Math.floor(days), Math.floor(hours), Math.floor(minutes), Math.floor(secs)];

                    if(index == 2) {
                        $('.file_name').text(res + " (uploaded "+ hours +" hours "+ minutes +" minutes "+ secs +" seconds ago)");
                    } else {
                        $('.file_name').text(res + " (upload started "+ hours +" hours "+ minutes +" minutes "+ secs +" seconds ago)");
                    }
                }

                if(index == 2) {
                    var selectfield = selectField();
                    var datecheck = dateCheck();

                    if(selectfield == true && datecheck == true) {

                        $('#next').prop('disabled', true);

                        var list = [];
                        $('.select_field > option:selected').each(function() {
                            list.push($(this).val());
                        })

                        var filename =  $('#file_in_db').text();

                        $("#loaderOverlay").removeClass('d-none');

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.import.start_upload') }}",
                            data: {id: list , filename:filename , leadType:$('.lead_type_name').text(), leadId:leadId, request_token : "{{session()->get('_token')}}"},
                            success: function (res) {
                                $("#loaderOverlay").addClass('d-none');
                                if(progressResponse == null || typeof progressResponse == 'undefined') {
                                    progressResponse = setInterval(function() {
                                        getUploadProgress();
                                    }, 5000);
                                }
                                /* import_progress = 97;
                                let stop = setInterval(function(){
                                    import_progress += 1;
                                    $("#import_progress").text(import_progress + '% (Step 1 - Uploading file...)');

                                    if (import_progress >= 100) {
                                        uploadSucess();
                                        clearInterval(stop);
                                    }
                                },[2000])

                                function uploadSucess() {
                                    uploadTime(filename);
                                        if(res['done'] == true)
                                        {
                                            Swal.fire({
                                            icon: "success",
                                            title: "File Import",
                                            text: res['message'],
                                            });
                                            setpwizard();
                                            $('#totalRows').text(res['rows']);
                                            $('#duplicateRows').text(res['duplicate']);
                                            $('#invalidRows').text(res['invalid'] + ' ('+res['invalid']+' of these are missing an Phone Number.)' );
                                            $('#importRows').text(res['import']);
                                            $('#lead_id').text(res['lead']);
                                            $("#rejectRecords").text(res['rejected']);
                                            // $('.file_name').text(res['uploadTime']);
                                        }
                                        if(res['done'] == false)
                                        {
                                            Swal.fire({
                                            icon: "info",
                                            title: "File Import",
                                            text: res['message'],
                                            });
                                        }
                                } */
                            }
                        });
                    }
                }


            });

            $(document).on('click','.download',function(){
                $("#loaderOverlay").removeClass('d-none');
                var lead_id = $('#lead_id').text();
                var type = $(this).attr('data-text');

                if(type == "duplicate") {
                    var Rows = $("#duplicateRows").text();
                } else {
                    var Rows = $("#importRows").text();
                }

                $.ajax({
                    type: "POST",
                    url: "{{url('import/download')}}",
                    data: {
                        lead_id:lead_id,
                        type:type
                    },
                    success: function (data) {
                        $("#loaderOverlay").addClass('d-none');
                        var downloadLink = document.createElement("a");
                        var fileData = ['\ufeff'+data];

                        var blobObject = new Blob(fileData,{
                            type: "text/csv;charset=utf-8;"
                         });

                        var url = URL.createObjectURL(blobObject);
                        downloadLink.href = url;
                        var file = FileName.split(".csv");
                        downloadLink.download = file[0]+"_"+type+"_"+Rows+".csv";

              /*
               * Actually download CSV
               */
                         document.body.appendChild(downloadLink);
                         downloadLink.click();
                        document.body.removeChild(downloadLink);
                    }
                });
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

            function dateCheck() {
                var status = [];
                var validDate = [];
                var status1 = true;

                $('.select_field > option:selected').each(function(key, value) {
                    var value = $(this).val();
                    if(value == 'null') {
                        status.push(value);
                    } else {
                        status.push(value);
                    }
                });

                if($.inArray('12', status) !== -1)  {
                    var Days = $("#days").val();
                    var dateIndex = status.indexOf('12');
                    $('#tbody tr').each(function(key, value){
                        var date = $(this).find("td").eq(dateIndex).html();
                        var generatedDate = '';

                        if(date.search("/") !== -1) {
                            var dateParts = date.split("/");
                            if(dateParts[2].length == 2) {
                                var Year = '20'+dateParts[2];
                                generatedDate =  dateParts[0] + '/' + dateParts[1] +'/'+ Year;
                            } else {
                                generatedDate =  dateParts[0] + '/' + dateParts[1] +'/'+ dateParts[2];
                            }
                        } else {
                            var dateParts = date.split("-");
                            if(dateParts[2].length == 2) {
                                var Year = '20'+dateParts[2];
                                generatedDate =  dateParts[0] + '/' + dateParts[1] +'/'+ Year;
                            } else {
                                generatedDate =  dateParts[0] + '/' + dateParts[1] +'/'+ dateParts[2];
                            }
                        }
                        const date1 = new Date(generatedDate);
                        const date2 = new Date();
                        const diffTime = Math.abs(date2 - date1);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                       
                        if(diffDays > Days) {
                            validDate.push("false");
                        } else {
                            validDate.push("true");
                        }

                        if($.inArray("false", validDate) !== -1) {
                            Swal.fire({
                                icon: "info",
                                title: "import",
                                text: "Disallow import of leads older.",
                            });
                            status1 = false;
                        }
                    })

                    return status1;
                } else {
                    return status1;
                }
            }

            function selectField() {
                var status = [];
                $('.select_field > option:selected').each(function(key, value) {
                    var value = $(this).val();
                    if(value == 'null') {
                        $('#select_heading'+key+'').addClass('d-block').removeClass('d-none');
                        status.push(value);
                    } else {
                        $('#select_heading'+key+'').addClass('d-none');
                        status.push(value);
                    }
                });

                if($.inArray('8', status) !== -1 && $.inArray('12', status) !== -1) {
                    $('.select_heading').addClass('d-none');
                    return true;
                }else {
                    if($.inArray("null", status) !== -1) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }


            $('body').on('change', '.select_field',function(e) {
                var id = $(this).attr('id');
                var value = $(this).val();
                const valArr = {};

                valArr['key'] = id;
                valArr['val'] = value;

                const checkValue =  idArr.findIndex((obj => obj.val == value));

                const index = idArr.findIndex((obj => obj.key == id));
                if(checkValue !== -1)
                {
                    $(this).val("null");
                        Swal.fire({
                        icon: "info",
                        title: "Please select other option.",
                            text: "This value is already selected.",
                    });
                    idArr[index].val = null;
                }
                else if(index !== -1) {
                    idArr[index].val = value;
                }
                else{
                    idArr.push(valArr);
                }
            });

            function getSheetData(id) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.import.getData') }}",
                    dataType: "json",
                    data:{ id: id},
                    success: function(res) {
                        $("#days").val(res.days);
                        width = 98;
                        var thead = '';
                        var tbody = '';
                        if (res.values) {
                            $.each(res.values, function (key, value) {
                                tbody += "<tr>";
                                $.each(value, function(subkey, subvalue){
                                    tbody += "<td>"
                                    tbody += subvalue
                                    tbody += "</td>"
                                });
                                tbody += "</tr>";
                            });
                            // addDropdown(length);

                            $('#tbody').append(tbody);
                            var rows = $('#tbody tr:first td').length;
                            thead += "<tr>";
                            for (let i = 0; i < rows; i++) {
                                thead += '<th>';
                                thead += '<select class="select2 select_field" name="select_field" id="select_field'+i+'"><option value="null"> -- Select --</option>'
                                thead += '@foreach ($leadFields as $key => $leadField)';
                                thead += '<option value="{{ $leadField->id }}">{{ $leadField->name }}</option>';
                                thead += '@endforeach';
                                thead += '</select><label class="text-danger f-400 f-12 d-none select_heading" id="select_heading'+i+'">Select Heading</label>';
                                thead += '</th>';
                            }
                            thead += "</tr>";
                            $("#thead").append(thead);
                            $('.select2').select2({
                                width:"100%",
                                minimumResultsForSearch: -1
                            });
                        }
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

            $("#loaderOverlay").addClass('d-none');
        });
    </script>
@endsection
