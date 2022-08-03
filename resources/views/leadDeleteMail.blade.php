<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Dancing+Script|Open+Sans|Questrial&display=swap');


    body {
      background: #eaeaea;
      font-family: 'Open Sans', sans-serif;
    }

    .banner {
      background: #3F189F;
      color: white;
    }

    .banner,
    .email-content {
      padding: 2em 5em;
      overflow: hidden;
    }

    h1 {
      font-family: 'Questrial', sans-serif;
      font-size: 5em;
      margin: 0 0 .5em 0;
    }

    hr {
      margin-top: 2em;
      background: blue;
    }

    a {
      text-decoration: none;
    }

    .email-heading{
      text-align: center;
    }

    .email-container {
      margin: 10% ;
      background: #ffffff;
    }

    footer {
      text-align: center;
      margin: 0;
      padding: 1em;
    }
  </style>
</head>

<body>
  <main>
    <div class="email-container">
        <div class="email-body">
            <div class="banner">
                <p style="text-align:center;font-size:20px;">{{ $title }}</p>
            </div>

            <div class="email-content">
                {!! $body !!}
            </div>
        </div>
    </div>
  </main>
  <footer>

  </footer>
</body>

</html>
