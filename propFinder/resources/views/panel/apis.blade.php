<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Swagger API -->
    <link rel="stylesheet" type="text/css" href="{{asset('swagger/swagger-ui.css')}}">
    <!-- Custom fonts for this template-->
    <link href="{{asset('panel-assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('panel-assets/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- My custom styles -->
    <style>
        g path {
            fill-opacity: 1; stroke: rgb(51, 51, 51); stroke-width: 2.5; stroke-linecap: butt; stroke-linejoin: round; stroke-miterlimit: 4; stroke-opacity: 1; stroke-dasharray: none; fill: rgb(255, 255, 255);
        }
        svg path:hover {
            fill: #1a202c;
        }

        .skeleton {
            padding: 10px;
        }

        .skeleton-bar {
            background-color: #ddd;
            height: 20px;
            margin: 10px 0;
            border-radius: 4px;
            animation: pulse 1.5s infinite ease-in-out;
        }

        @keyframes pulse {
            0% {
                background-color: #eee;
            }
            50% {
                background-color: #ddd;
            }
            100% {
                background-color: #eee;
            }
        }

        .alert-progress-bar {
            height: 4px;
            background-color: #bbbbbb;
            width: 100%;
            transition: width 0.5s ease;
        }

        .fixed-top-alert {
            position: fixed;
            top: 0;
            left: 25%;  /* 25% margin from the left */
            right: 25%; /* 25% margin from the right */
            z-index: 1050; /* High z-index to overlay other elements */
            display: none; /* Hidden by default */
            width: 50%;  /* Adjust width to account for margins */
            padding-bottom: 0; /* Add padding to accommodate the progress bar */
        }

        .popover {
            position: absolute;
            border: 1px solid #ccc;
            background-color: white;
            padding: 10px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
            display: none;
            z-index: 2000;
        }

        /* Base styles */
        .card-body {
            overflow-x: auto; /* Allows horizontal scrolling */
        }

        /* Media query for tablets/mobile */
        @media screen and (max-width: 768px) { /* Adjust 768px to the breakpoint you desire */
            #PopulationChart1 {
                min-width: 600px; /* This should be greater than the container width */
            }
        }

    </style>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <div id="topAlert" class="alert alert-warning fixed-top-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <span id="alertMessage">This is a warning alert—check it out!</span>
        <div id="alertProgressBar" class="alert-progress-bar mt-2"></div>
    </div>


    {{--    <!-- Sidebar -->--}}
    {{--    <x-sidebar/>--}}
    {{--    <!-- End of Sidebar -->--}}

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- LEft Side Buttons -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url()->previous() ?: route('home', ['locale' => App::getLocale()])}}" id="rightArrowButton">
                            <i class="fas fa-arrow-left fa-fw text-secondary"></i>
                        </a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home', ['locale' => App::getLocale()])}}" id="homeButton">
                            <i class="fas fa-home fa-fw text-secondary"></i>
                        </a>
                    </li>
                </ul>

                <!-- Right Side Buttons -->
                <ul class="navbar-nav ml-auto">
                    <!-- Accessibility Button -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="accessibilityButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-universal-access fa-fw fa-2x text-primary"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accessibilityButton">
                            <button type="button" class="btn btn-secondary dropdown-item" onclick="increaseFontSize(); event.stopPropagation();">{{__('panel.accessibility.increase_size')}}</button>
                            <button type="button" class="btn btn-secondary dropdown-item" onclick="decreaseFontSize(); event.stopPropagation();">{{__('panel.accessibility.reduce_size')}}</button>
                            <button id="contrastToggle" class="btn btn-secondary dropdown-item" disabled>{{__('panel.accessibility.high_contrast')}}</button>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div id="pageContent" class="container-fluid">
                <div id="swagger-ui"></div>

                <script src="{{asset('swagger/swagger-ui-bundle.js')}}"></script>
                <script src="{{asset('swagger/swagger-ui-standalone-preset.js')}}"></script>

                <script>
                    window.onload = function() {
                        const ui = SwaggerUIBundle({
                            url: '{{asset('swagger/openapi.json')}}',
                            dom_id: '#swagger-ui',
                            presets: [
                                SwaggerUIBundle.presets.apis,
                                SwaggerUIStandalonePreset
                            ]
                        })

                        window.ui = ui
                    }
                </script>
            </div>

            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-2">
                    <span>Powered by <strong>Swagger</strong>. Swagger Editor is used under the <a href="https://www.apache.org/licenses/LICENSE-2.0">Apache 2.0 License</a>. Copyright 2023 SmartBear Software.</span>
                </div>
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <strong>propFinder</strong> 2023</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
</div>

<x-utilities/>

<script>
    var fontSizeIncreaseCount = 0;
    var maxFontSizeIncreases = 5; // Maximum allowed increases
    var minFontSizeIncreases = -5; // Maximum allowed increases

    function increaseFontSize() {

        if (fontSizeIncreaseCount > maxFontSizeIncreases) {
            return; // Exit
        }

        var container = document.getElementById('pageContent');
        var allElements = container.querySelectorAll('*');

        // Loop through each element inside the container
        allElements.forEach(function(element) {
            var style = window.getComputedStyle(element, null).getPropertyValue('font-size');
            var currentSize = parseFloat(style);
            element.style.fontSize = (currentSize + 1) + 'px';
        });

        fontSizeIncreaseCount++;
    }

    function decreaseFontSize() {

        if (fontSizeIncreaseCount < minFontSizeIncreases) {
            return; // Exit
        }

        var container = document.getElementById('pageContent');
        var allElements = container.querySelectorAll('*');

        // Loop through each element inside the container
        allElements.forEach(function(element) {
            var style = window.getComputedStyle(element, null).getPropertyValue('font-size');
            var currentSize = parseFloat(style);
            element.style.fontSize = (currentSize - 1) + 'px';
        });

        fontSizeIncreaseCount--;
    }
</script>

</body>

</html>

