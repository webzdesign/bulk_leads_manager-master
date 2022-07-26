<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body class="antialiased">
        @php
            $description = \App\Models\EmailTemplate::where('email_subject','lead-send')->get()->toArray()
        @endphp
        <center>
            <h4>Please download attachment and show lead reports.</h4>

            <?php
                if(isset($description) && $description !=null){
                    echo '<div style="text-align:justify">'.$description[0]['content'].'</div>';
                }
            ?>
        </center>
    </body>
</html>
