@extends('layouts.master')
<style>
    .swal2-container .select{
        display: none !important;
    }
</style>
@section('content')
    <div class="middleContent settingWrpr">
        <div class="cards">
            <div class="middleContent">
                    <div class="progress d-none" style="height: 50px;" id="upload_progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;font-size:18px;font-weight:600;">Wait until update finished.</div>
                    </div>
                    <div class="progress d-none" style="height: 50px;" id="no_progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;font-size:18px;font-weight:600;">No Process is running.</div>
                    </div>
                    <div class="cardsFooter justify-content-end d-none" id="update_button_div">
                        <button class="btn-primary f-500 f-14" type="button" id="update_age_data">Start</button>
                    </div>
            </div>
            <div class="middleContent">
                <div class="progress d-none" style="height: 50px;" id="upload_progress_text">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;font-size:18px;font-weight:600;">Fetching Status</div>
                </div>
                <div class="justify-content-center d-flex" id="update_status_div">
                    <button class="btn-primary f-500 f-14" type="button" id="check_update_age_data_status">Check Status</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    

    jQuery(document).ready(function() {
        
        $("body").on("click","button#update_age_data", function(e){
            e.preventDefault();
            
            $.ajax({
                type: "POST",
                beforeSend: function(jqXHR, JQueryAjaxSettings) {
                    $("#check_update_age_data_status").addClass('d-none');
                    $("#upload_progress_text").addClass('d-none');
                    $("#update_button_div").addClass('d-none').removeClass('d-flex')
                    $("#no_progress").addClass('d-none');
                    $("#upload_progress").removeClass('d-none');
                    $("#upload_progress > div").html('Wait until update finished.');
                },
                url: "{{ route('admin.age.update.progress.status') }}",
                success: function(res) {
                    if(res.status == -1) {
                        $("#upload_progress").addClass('d-none');
                        $("#no_progress").removeClass('d-none');
                        $("#update_button_div").removeClass('d-none').addClass('d-flex');
                    } else if(res.status > -1) {
                        if(res.status == 3) {
                            $("#upload_progress > div").html('Process Finished');
                            $("#upload_progress").removeClass('d-none');
                            $("#no_progress").addClass('d-none');
                            // $("#update_button_div").removeClass('d-none').addClass('d-flex');
                        } else {
                            $("#upload_progress").removeClass('d-none');
                            $("#no_progress").addClass('d-none');
                            $("#update_button_div").addClass('d-none').removeClass('d-flex');
                        }
                    }
                },
                error:function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown)
                }
            });
        });
        
        $("body").on("click","button#check_update_age_data_status", function(e){
            e.preventDefault();
            
            $.ajax({
                type: "POST",
                beforeSend: function(jqXHR, JQueryAjaxSettings) {
                    $("#check_update_age_data_status").html('Fetching Status...');
                },
                url: "{{ route('admin.age.update.progress') }}",
                success: function(res) {
                    if(res.status == 3) {
                        $("#no_progress").removeClass('d-none');
                        $("#update_button_div").removeClass('d-none').addClass('d-flex');
                        $("#upload_progress").addClass('d-none');
                    } else {
                        $("#upload_progress").removeClass('d-none');
                        $("#no_progress").addClass('d-none');
                        $("#update_button_div").addClass('d-none').removeClass('d-flex');
                    }
                },
                error:function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown)
                },
                complete: function(jqXHR, textStatus) {
                    $("#check_update_age_data_status").html('Check Status');
                }
            });
        });
    })
</script>
@endsection
