<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100,300" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #89918A;
                display: table;
                font-weight: 300;
                font-family: 'Lato', sans-serif;
                font-size: 18px;
                background: #F1F1F1;
                line-height: 36px;
            }
            img {
                width: 125px;
            }

            .container {

                padding:150px;
            }

            .content {
                display: inline-block;
            }

            .title {
                margin-top: 50px;
                font-size: 60px; font-weight: 100;

                margin-bottom: 40px;
                color: #89918A;
            }
        </style>
    </head>
    <body>
        <div class="container">



            <div class="content">
                @include('global._logo')
                <div class="title">We&rsquo;ll be back soon!</div>
                <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment.<br>
                    If you need to you can always contact us on <b>info@2rent.pk</b>, otherwise we&rsquo;ll be back online shortly!</p>
                <p>&mdash; 2rent.pk</p>
            </div>
        </div>
    </body>
</html>
