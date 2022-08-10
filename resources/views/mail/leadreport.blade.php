<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body class="antialiased">
        @php
            $description = \App\Models\EmailTemplate::where('email_subject','lead-send')->get()->toArray();
            $client = \App\Models\Client::where('id',$order_data['client_id'])->get()->toArray();

            $client_name = isset($client) && $client !=null ? $client[0]['firstName'] : '';
            $client_email = isset($client) && $client !=null ? $client[0]['email'] : '';

            if(isset($description) && $description !=null){
                $csvlink = url('public/storage/leadreport/'.$file);

                if(str_contains($description[0]['content'], '[link]')) {
                    $description[0]['content'] = str_replace('[link]',$csvlink,$description[0]['content']);
                }
            }
        @endphp
        <center>
            <h4>Please download attachment and show lead reports.</h4>

            <?php
                if(isset($description) && $description !=null){
                    echo '<div style="text-align:justify">'.str_replace('[username]',$client_name,str_replace('[email]',$client_email,$description[0]['content'])).'</div>';
                }
            ?>
        </center>
    </body>
</html>
