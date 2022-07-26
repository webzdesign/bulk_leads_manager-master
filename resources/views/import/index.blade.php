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
                                    <div class="progress-bar" style="width:1%" data-parcent="100"></div>
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
                                    <div class="colTwo c-43 f-16 f-500" id='totalRows'>2499</div>
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
@endsection
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        let idArr = [];
        var width = 0;
        var import_progress = 0;
        var startDate = 0;
        var days = 0; var hours = 0; var minutes = 0; secs = 0;
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        $(document).ready(function() {

         !function(a){"use strict";a.fn.tableToJSON=function(b){var c={ignoreColumns:[],onlyColumns:null,ignoreHiddenRows:!0,ignoreEmptyRows:!1,headings:null,allowHTML:!1,includeRowId:!1,textDataOverride:"data-override",textExtractor:null};b=a.extend(c,b);var d=function(a){return void 0!==a&&null!==a},e=function(c){return d(b.onlyColumns)?-1===a.inArray(c,b.onlyColumns):-1!==a.inArray(c,b.ignoreColumns)},f=function(b,c){var e={},f=0;return a.each(c,function(a,c){f<b.length&&d(c)&&(e[b[f]]=c,f++)}),e},g=function(c,d,e){var f=a(d),g=b.textExtractor,h=f.attr(b.textDataOverride);return null===g||e?a.trim(h||(b.allowHTML?f.html():d.textContent||f.text())||""):a.isFunction(g)?a.trim(h||g(c,f)):"object"==typeof g&&a.isFunction(g[c])?a.trim(h||gc):a.trim(h||(b.allowHTML?f.html():d.textContent||f.text())||"")},h=function(c,d){var e=[],f=b.includeRowId,h="boolean"==typeof f?f:"string"==typeof f?!0:!1,i="string"==typeof f==!0?f:"rowId";return h&&"undefined"==typeof a(c).attr("id")&&e.push(i),a(c).children("td,th").each(function(a,b){e.push(g(a,b,d))}),e},i=function(a){var c=a.find("tr:first").first();return d(b.headings)?b.headings:h(c,!0)},j=function(c,h){var i,j,k,l,m,n,o,p=[],q=0,r=[];return c.children("tbody,*").children("tr").each(function(c,e){if(c>0||d(b.headings)){var f=b.includeRowId,h="boolean"==typeof f?f:"string"==typeof f?!0:!1;n=a(e);var r=n.find("td").length===n.find("td:empty").length?!0:!1;!n.is(":visible")&&b.ignoreHiddenRows||r&&b.ignoreEmptyRows||n.data("ignore")&&"false"!==n.data("ignore")||(q=0,p[c]||(p[c]=[]),h&&(q+=1,"undefined"!=typeof n.attr("id")?p[c].push(n.attr("id")):p[c].push("")),n.children().each(function(){for(o=a(this);p[c][q];)q++;if(o.filter("[rowspan]").length)for(k=parseInt(o.attr("rowspan"),10)-1,m=g(q,o),i=1;k>=i;i++)p[c+i]||(p[c+i]=[]),p[c+i][q]=m;if(o.filter("[colspan]").length)for(k=parseInt(o.attr("colspan"),10)-1,m=g(q,o),i=1;k>=i;i++)if(o.filter("[rowspan]").length)for(l=parseInt(o.attr("rowspan"),10),j=0;l>j;j++)p[c+j][q+i]=m;else p[c][q+i]=m;m=p[c][q]||g(q,o),d(m)&&(p[c][q]=m),q++}))}}),a.each(p,function(c,g){if(d(g)){var i=d(b.onlyColumns)||b.ignoreColumns.length?a.grep(g,function(a,b){return!e(b)}):g,j=d(b.headings)?h:a.grep(h,function(a,b){return!e(b)});m=f(j,i),r[r.length]=m}}),r},k=i(this);return j(this,k)}}(jQuery);

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
                                    uploadTime(res.file_name);
                                    setpwizard();

                                    let count = 0
                                    // let innerbar = document.querySelector('.progress-bar')

                                    // function progress(){
                                    //     count++
                                    //     innerbar.style.width =`${count}%`
                                    //     $("#progress-bar").text(innerbar.style.width);
                                    //     if(count==100){
                                    //         setpwizard();
                                    //         $('#next').show();
                                    //         clearInterval(stop)
                                    //     }
                                    // }

                                    let stop = setInterval(function(){
                                        width += 1;
                                        $(".progress-bar").css('width', width + '%');
                                        $("#progress-bar").text(width + '%');

                                        if (width >= 100) {
                                            clearInterval(stop);
                                            uploadTime(res.file_name);
                                            setpwizard();
                                            $('#next').show();
                                        }
                                    },[5000])

                                    getSheetData(res.lead_type_id);

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
                    if(selectfield == true) {
                        $('#next').prop('disabled', true);

                        var list = [];
                        $('.select_field > option:selected').each(function() {
                            list.push($(this).val());
                        })

                        var filename =  $('#file_in_db').text();
                        let stop = setInterval(function(){
                            import_progress += 1;
                            $("#import_progress").text(import_progress + '% (Step 1 - Uploading file...)');

                            if (import_progress >= 100) {
                                clearInterval(stop);
                            }
                        },[5000])

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.import.start_upload') }}",
                            data: {id: list , filename:filename , leadType:$('.lead_type_name').text()},
                            success: function (res) {
                                import_progress = 98;
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
                                        $('#invalidRows').text(res['invalid'] + ' ('+res['invalid']+' of these are missing an email.)' );
                                        $('#importRows').text(res['import']);
                                        $('#lead_id').text(res['lead']);
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
                            }
                        });
                    }
                }


            });

            $(document).on('click','.download',function(){
                var lead_id = $('#lead_id').text();
                var type = $(this).attr('data-text');
                console.log(lead_id);
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.import.download')}}",
                    data: {
                        lead_id:lead_id,
                        type:type
                    },
                    success: function (data) {
                        console.log(data);
                        var downloadLink = document.createElement("a");
                        var fileData = ['\ufeff'+data];

                        var blobObject = new Blob(fileData,{
                            type: "text/csv;charset=utf-8;"
                         });

                        var url = URL.createObjectURL(blobObject);
                        downloadLink.href = url;
                        downloadLink.download = "Sample.csv";

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

                if($.inArray('1', status) !== -1 && $.inArray('2', status) !== -1 && $.inArray('3', status) !== -1 && $.inArray('12', status) !== -1) {
                    $('.select_heading').addClass('d-none');
                    return true;
                } else {
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

                // idArr.push(valArr);

                console.log(idArr);

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
                        width = 98;
                        var thead = '';
                        var tbody = '';
                        if (res) {
                            $.each(res, function (key, value) {
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

            // function addDropdown(length)
            // {
            //     $("#thead").empty().append("<tr></tr>");
            //     var leadFields = '{{$leadFields}}';
            //     var select = [];
            //     // var tr = $('<tr/>');
            //     // $('#thead').append(tr);
            //     // option.attr('value', this.value).text(this.label);
            //     var td ='';
            //      for(var i=0; i<=5 ;  i++);
            //      {

            //           td += "<td>Hello</td>";
            //        //  select.attr('id',"select_field"+`${i}`).text("select");
            //      }
            //      alert(td);
            //      $('thead tr:first').append(td);

            //     console.log(leadFields);
            // }

        });
    </script>
@endsection
