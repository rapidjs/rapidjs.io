<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre" rel="stylesheet">

        <title>rapid js - Write rapid js for frontend API development.</title>
    </head>
    <body>
        <div id="app">
            @include('layouts.header')

            <div class="wrapper" id="app">

                <div class="container fb-grid row">

                    @include('layouts.sidebar')

                    <div class="documentation fb-grid col-xs-12 col-md-10">

                        @include('documentation.installation')

                        @include('documentation.usage')

                        @include('documentation.class-builder')

                    </div>

                </div>
                </div>
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>