@extends('layouts.master')
<style>
    .swal2-container .select{
        display: none !important;
    }
</style>
@section('content')
    <div class="middleContent settingWrpr">
        <div class="cards">
            <div class="cardsHeader">
                <div class="d-flex align-items-center">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.02395 3.283C9.07332 3.06094 9.19692 2.86234 9.37436 2.71999C9.5518 2.57764 9.77247 2.50004 9.99995 2.5H14C14.2274 2.50004 14.4481 2.57764 14.6256 2.71999C14.803 2.86234 14.9266 3.06094 14.976 3.283L15.416 5.264C15.816 5.454 16.197 5.674 16.556 5.924L18.494 5.314C18.711 5.24577 18.9448 5.25356 19.1567 5.3361C19.3687 5.41864 19.5462 5.57099 19.66 5.768L21.66 9.232C21.7737 9.42904 21.8169 9.659 21.7824 9.8839C21.7478 10.1088 21.6376 10.3152 21.47 10.469L19.973 11.842C20.0086 12.2799 20.0086 12.7201 19.973 13.158L21.47 14.531C21.6376 14.6848 21.7478 14.8912 21.7824 15.1161C21.8169 15.341 21.7737 15.571 21.66 15.768L19.66 19.232C19.5462 19.429 19.3687 19.5814 19.1567 19.6639C18.9448 19.7464 18.711 19.7542 18.494 19.686L16.557 19.076C16.197 19.326 15.816 19.546 15.417 19.736L14.977 21.716C14.9278 21.9384 14.8041 22.1374 14.6264 22.2799C14.4488 22.4225 14.2277 22.5001 14 22.5H9.99995C9.77247 22.5 9.5518 22.4224 9.37436 22.28C9.19692 22.1377 9.07332 21.9391 9.02395 21.717L8.58395 19.736C8.18395 19.546 7.80295 19.326 7.44395 19.076L5.50595 19.686C5.28895 19.7542 5.05516 19.7464 4.84317 19.6639C4.63119 19.5814 4.45369 19.429 4.33996 19.232L2.33995 15.768C2.22617 15.571 2.18298 15.341 2.21753 15.1161C2.25207 14.8912 2.36228 14.6848 2.52995 14.531L4.02695 13.158C3.99125 12.7201 3.99125 12.2799 4.02695 11.842L2.52995 10.47C2.36228 10.3162 2.25207 10.1098 2.21753 9.8849C2.18298 9.66 2.22617 9.43004 2.33995 9.233L4.33996 5.769C4.45369 5.57199 4.63119 5.41964 4.84317 5.3371C5.05516 5.25456 5.28895 5.24677 5.50595 5.315L7.44295 5.925C7.80295 5.675 8.18395 5.455 8.58295 5.265L9.02295 3.285L9.02395 3.283ZM12 15.5C12.7956 15.5 13.5587 15.1839 14.1213 14.6213C14.6839 14.0587 15 13.2956 15 12.5C15 11.7044 14.6839 10.9413 14.1213 10.3787C13.5587 9.81607 12.7956 9.5 12 9.5C11.2043 9.5 10.4412 9.81607 9.87863 10.3787C9.31602 10.9413 8.99995 11.7044 8.99995 12.5C8.99995 13.2956 9.31602 14.0587 9.87863 14.6213C10.4412 15.1839 11.2043 15.5 12 15.5V15.5Z" fill="#4F4F52"/>
                    </svg>
                    <span class="f-18 f-600 c-gr f-700">Site Settings</span>
                </div>
            </div>
            <form method="POST" action="{{ url('site_setting_create') }}" id="form1">
                @csrf
                <input type="hidden" name="id" value="{{ isset($site_settings) && $site_settings !=null ? $site_settings['id'] : ''}}">

                <div class="cardsBody">
                    <div class="row">
                        <div class="col-lg-6 pr-40">
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Auto delete records after:</label>
                                <select name="auto_delete_rec_after" class="select2">
                                    @for ($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}" <?= isset($site_settings) && $site_settings !=null && $site_settings['auto_delete_rec_after'] == $i ? 'selected' : '';?>>{{ $i }} Months</option>
                                    @endfor
                                </select>
                                @error('auto_delete_rec_after')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror

                                <p class="c-7b f-14 f-400 mt-2 mb-4">Once a lead reaches this age it will be deleted from the database.</p>
                            </div>
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Disallow import of leads older than:</label>
                                <select name="disallow_import_lead_older" class="select2">
                                    @for ($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}" <?= isset($site_settings) && $site_settings !=null && $site_settings['disallow_import_lead_older'] == $i ? 'selected' : '';?>>{{ $i }} Months</option>
                                    @endfor
                                </select>
                                @error('disallow_import_lead_older')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror

                                <p class="c-7b f-14 f-400 mt-2">
                                    When importing new CSV files, any leads that are older than this will be ignored.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 pl-40">
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Frequency of deleted archives:</label>
                                <select name="frequency_of_deleted_archives" class="select2">
                                    @for ($i=1; $i<=30; $i++)
                                        <option value="{{ $i }}" <?= isset($site_settings) && $site_settings !=null && $site_settings['frequency_of_deleted_archives'] == $i ? 'selected' : '';?>>{{ $i }} Days</option>
                                    @endfor
                                </select>

                                @error('frequency_of_deleted_archives')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror

                                <p class="c-7b f-14 f-400 mt-2">When leads expire (configure with Auto delete record setting) they are zipped and emailed to the admin, to prevent spamming emails to you every hour/day you can decrease the frequency so more records are grouped together in the zip file, otherwise you may receive frequent emails with only a handful of records. Manually deleted records ignore this and trigger a new .zip to be sent. </p>
                            </div>
                            <div class="form-group mt-4">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Number of times each lead can be downloaded:</label>
                                <select name="no_of_time_lead_download" class="select2">
                                    @for ($i=1; $i<=30; $i++)
                                        <option value="{{ $i }}" <?= isset($site_settings) && $site_settings !=null && $site_settings['no_of_time_lead_download'] == $i ? 'selected' : '';?>>{{ $i }} </option>
                                    @endfor
                                </select>
                                @error('no_of_time_lead_download')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror

                                <p class="c-7b f-14 f-400 mt-2">
                                    Each lead can only be downloaed this many times.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cardsFooter d-flex justify-content-end">
                    <button class="btn-default f-500 f-14" type="reset">Cancel</button>
                    <button class="btn-pink f-500 f-14" type="submit">Save changes</button>
                </div>
            </form>
        </div>

        <div class="cards">
            <div class="cardsHeader">
                <div class="d-flex align-items-center">
                    <svg class="me-2" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8.5L12 13.5L4 8.5V6.5L12 11.5L20 6.5V8.5ZM20 4.5H4C2.89 4.5 2 5.39 2 6.5V18.5C2 19.0304 2.21071 19.5391 2.58579 19.9142C2.96086 20.2893 3.46957 20.5 4 20.5H20C20.5304 20.5 21.0391 20.2893 21.4142 19.9142C21.7893 19.5391 22 19.0304 22 18.5V6.5C22 5.39 21.1 4.5 20 4.5Z" fill="#4F4F52"/>
                    </svg>
                    <span class="f-18 f-600 c-gr f-700">Email Setup</span>
                </div>
            </div>

            <form method="POST" action="{{ url('email_setup_create') }}" id="form2">
                @csrf
                <input type="hidden" name="id" value="{{ isset($site_settings) && $site_settings !=null ? $site_settings['id'] : '' }}">
                <div class="cardsBody">
                    <div class="row">
                        <div class="col-lg-6 pr-40">
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Email Address to send FROM:</label>
                                <input type="text" placeholder="admin@bulkleadsmanager.com" class="form-control c-gr f-14 f-500" name="email_from_address" value="<?= isset($site_settings) && $site_settings !=null ? $site_settings['email_from_address'] : '';?>">

                                @error('email_from_address')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Email from  Name:</label>
                                <input type="text" placeholder="Apache Leads" class="form-control c-gr f-14 f-500" name="email_from_name" value="<?= isset($site_settings) && $site_settings !=null ? $site_settings['email_from_name'] : '';?>">

                                @error('email_from_name')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Send deleted leads .zip file to email address (#1)</label>
                                <input type="text" placeholder="admin@apacheleads.com" class="form-control c-gr f-14 f-500" name="deleted_lead_email_one" value="<?= isset($site_settings) && $site_settings !=null ? $site_settings['deleted_lead_email_one'] : '';?>">

                                @error('deleted_lead_email_one')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 pl-40">
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Send deleted leads .zip file to email address (#2)</label>
                                <input type="text" placeholder="steve@xsited.com" class="form-control c-gr f-14 f-500" name="deleted_lead_email_two" value="<?= isset($site_settings) && $site_settings !=null ? $site_settings['deleted_lead_email_two'] : '';?>">

                                @error('deleted_lead_email_two')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">BCC all outgoing emails to Email Address (leave blank to disable)</label>
                                <input type="text" placeholder="admin@apacheleads.com" class="form-control c-gr f-14 f-500" name="bcc_email_address" value="<?= isset($site_settings) && $site_settings !=null ? $site_settings['bcc_email_address'] : '';?>">

                                @error('bcc_email_address')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Email Reply-To (optional)</label>
                                <input type="text" placeholder="admin@apacheleads.com" class="form-control c-gr f-14 f-500" name="reply_to_email" value="<?= isset($site_settings) && $site_settings !=null ? $site_settings['reply_to_email'] : '';?>">

                                @error('reply_to_email')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cardsFooter d-flex justify-content-end">
                    <button class="btn-default f-500 f-14" type="reset">Cancel</button>
                    <button class="btn-pink f-500 f-14" type="submit">Save changes</button>
                </div>
            </form>
        </div>
        <div class="cards">
            <div class="cardsHeader">
                <div class="d-flex align-items-center">
                    <svg class="me-2" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 12.63C20.85 12.64 20.71 12.69 20.61 12.8L19.61 13.8L21.66 15.8L22.66 14.8C22.88 14.59 22.88 14.24 22.66 14.03L21.42 12.8C21.3201 12.6964 21.1839 12.6354 21.04 12.63M19.04 14.38L13 20.44V22.5H15.06L21.12 16.43M20 4.5H4C3.46957 4.5 2.96086 4.71071 2.58579 5.08579C2.21071 5.46086 2 5.96957 2 6.5V18.5C2 19.0304 2.21071 19.5391 2.58579 19.9142C2.96086 20.2893 3.46957 20.5 4 20.5H11V19.61L19.24 11.39C19.71 10.9 20.36 10.63 21.04 10.63C21.38 10.63 21.72 10.69 22.04 10.82V6.5C22.04 5.38 21.12 4.5 20 4.5ZM20 8.5L12 13.5L4 8.5V6.5L12 11.5L20 6.5" fill="#4F4F52"/>
                    </svg>
                    <span class="f-18 f-600 c-gr f-700">Email Template</span>
                </div>
            </div>

            <form method="POST" action="{{ url('email_template_create') }}" id="form3">
                @csrf
                <div class="cardsBody">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Email Type</label>
                                <select name="email_subject" class="select2">
                                    <option value="lead-send" <?= isset($email_template) && $email_template !=null && $email_template['email_subject'] == 'lead-send' ? 'selected' : '';?>>Leads Send</option>
                                    <option value="lead-delete" <?= isset($email_template) && $email_template !=null && $email_template['email_subject'] == 'lead-delete' ? 'selected' : '';?>>Leads Delete</option>
                                </select>
                                @error('email_subject ')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror

                                <p class="c-7b f-14 f-400 mt-2 mb-4">[username] [email] [link] are placed with the correct values.</p>
                            </div>

                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Email Subject</label>

                                <input type="text" class="form-control" placeholder="Enter Email Subject" id="subject" name="subject" value="{{ isset($email_template) && $email_template !=null ? $email_template->subject : '' }}">
                            </div>
                            <div class="form-group">
                                <label class="c-gr f-500 f-16 w-100 mb-2">Email Description</label>
                                <textarea class="form-control c-gr f-14 f-500 content" name="content">{{ isset($email_template) && $email_template !=null ? $email_template['content'] : '' }}</textarea>
                                @error('content ')
                                    <span class="text-danger f-400 f-14">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cardsFooter d-flex justify-content-end">
                    <button class="btn-default f-500 f-14" type="reset">Cancel</button>
                    <button class="btn-pink f-500 f-14" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('/vendor/ckeditor/ckeditor/ckeditor.js') }}"></script>

<script>
    $(document).ready(function () {
        CKEDITOR.replace('content');

        @if(session()->has('success'))
            Swal.fire(
                'Success',
                'Settings updated successfuly!',
                'success'
            );
        @endif

        $("#form1").validate({
            rules:{
                auto_delete_rec_after: {required: true},
                disallow_import_lead_older: {required: true},
                frequency_of_deleted_archives: {required: true},
                no_of_time_lead_download: {required: true}
            },
            messages:{
                auto_delete_rec_after:{required: "This Fields Is Required."},
                disallow_import_lead_older:{required: "This Fields Is Required."},
                frequency_of_deleted_archives:{required: "This Fields Is Required."},
                no_of_time_lead_download:{required: "This Fields Is Required."}
            },
            errorPlacement: function(error, element) {
                error.addClass('text-danger f-400 f-14').appendTo(element.parent("div"));
            },
            submitHandler: function(form) {
                $(':input[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });

        $("#form2").validate({
            rules:{
                email_from_address: {required: true,email:true},
                email_from_name: {required: true},
                deleted_lead_email_one: {required: true,email:true},
                deleted_lead_email_two: {required: true,email:true},
                bcc_email_address: {email: true},
                reply_to_email: {email: true}
            },
            messages:{
                email_from_address:{required: "This Fields Is Required.",email: "Please Enter Valid Email Address."},
                email_from_name:{required: "This Fields Is Required."},
                deleted_lead_email_one:{required: "This Fields Is Required.",email: "Please Enter Valid Email Address."},
                deleted_lead_email_two:{required: "This Fields Is Required.",email: "Please Enter Valid Email Address."},
                bcc_email_address:{email: "Please Enter Valid Email Address."},
                reply_to_email:{email: "Please Enter Valid Email Address."}
            },
            errorPlacement: function(error, element) {
                error.addClass('text-danger f-400 f-14').appendTo(element.parent("div"));
            },
            submitHandler: function(form) {
                $(':input[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });

        $("#form3").validate({
            rules:{
                email_subject: {required: true},
                content: {required: true},
                subject: {required: true}
            },
            messages:{
                email_subject:{required: "This Fields Is Required."},
                content:{required: "This Fields Is Required."},
                subject:{required: "Email Subject Is Required."},
            },
            errorPlacement: function(error, element) {
                error.addClass('text-danger f-400 f-14').appendTo(element.parent("div"));
            },
            submitHandler: function(form) {
                $(':input[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });

        for (instance in CKEDITOR.instances)
        {
            CKEDITOR.instances[instance].updateElement();
        }

        $(document).on('change','[name="email_subject"]',function(){
            var email_subject = $('[name="email_subject"]').val();

            $.ajax({
                type:'POST',
                url: "{{ route('get-email-template') }}",
                dataType: 'Json',
                data: {"email_subject": email_subject},
                success: function(response) {
                    CKEDITOR.instances['content'].destroy();

                    $("#subject").val(response.subject);
                    $('[name="content"]').val(response.content);
                    CKEDITOR.replace('content');
                }
            });
        });
    });
</script>

@endsection
