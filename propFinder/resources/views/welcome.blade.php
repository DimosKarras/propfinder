<!DOCTYPE html>
<html>
<head>
    <title>Propfinder | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/panel-assets/img/logo_small.ico" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="{{asset('panel-assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('panel-assets/css/sb-admin-2.css')}}" rel="stylesheet">
    <style>
        body {
            color: #41424C;
        }

        .card-header .title {
            font-size: 17px;
            color: #000;
        }

        .card-header .accicon {
            float: right;
            font-size: 20px;
            width: 1.2em;
        }

        .card-header {
            cursor: pointer;
            border-bottom: none;
        }

        .card {
            border: 1px solid #ddd;
        }

        .card-body {
            border-top: 1px solid #ddd;
        }

        .card-header:not(.collapsed) .rotate-icon {
            transform: rotate(180deg);
        }

        .mybar .dropdown-list {
            padding: 0;
            border: none;
            overflow: hidden;
            position: absolute;
        }

        .mybar .dropdown-list .dropdown-header {
            background-color: #28a745;
            border: 1px solid #28a745;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            color: #fff;
        }

        .mybar .dropdown-list .dropdown-item {
            white-space: normal;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            border-left: 1px solid #e3e6f0;
            border-right: 1px solid #e3e6f0;
            border-bottom: 1px solid #e3e6f0;
            line-height: 1.3rem;
        }

        .mybar .dropdown-list .dropdown-item .dropdown-list-image {
            position: relative;
            height: 2.5rem;
            width: 2.5rem;
        }

        .mybar .dropdown-list .dropdown-item .dropdown-list-image img {
            height: 2.5rem;
            width: 2.5rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 static-top shadow mybar">
    <!-- Brand and toggle are grouped for better mobile display -->
    <a class="navbar-brand" href="{{ route('panel', ['locale' => App::getLocale()]) }}">
        <img src="/panel-assets/img/light/logo001.png" width="auto" height="75" class="d-inline-block align-top" alt="logo">
    </a>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-globe-europe fa-fw"></i><span id="currentLang" class="d-none d-lg-inline-block font-weight-bold"></span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right z-50 shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">{{__('home.languages')}}</h6>
                <a class="dropdown-item d-flex align-items-center" href="{{ route(Route::currentRouteName(), ['locale' => 'en']) }}">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="{{asset('panel-assets/img/lang/en.png')}}" alt="english language">
                    </div>
                    <div>
                        <div class="text-truncate">English</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="{{ route(Route::currentRouteName(), ['locale' => 'el']) }}">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="{{asset('panel-assets/img/lang/el.png')}}" alt="greek language">
                    </div>
                    <div>
                        <div class="text-truncate">Ελληνικά</div>
                    </div>
                </a>
            </div>
        </li>
    </ul>
</nav>


<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h1>{{__('home.welcome')}}
                <text style="color: #1a8828;">prop</text>Finder
            </h1>
            <h2>{{__('home.title_reference1')}}</h2>
            <p class="mb-2"><em>{{__('home.title_reference2')}}</em></p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <img src="panel-assets/img/hero002.png" alt="Hero Image" class="img-fluid my-4"><br>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <a href="{{ route('panel', ['locale' => App::getLocale()]) }}"
               class="btn btn-outline-success btn-lg">{{__('home.application')}}</a>
            <a href="{{ route('analytics')}}" class="btn btn-outline-success btn-lg">{{__('home.open_data')}}</a>
        </div>
    </div>
</div>

<div class="container">
    <hr class="mb-4">
    <div class="accordion" id="accordionInfo">
        <div class="card">
            <div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">
                <span class="title">{{__('home.question1')}}</span>
            </div>
            <div id="collapseOne" class="collapse show" data-parent="#accordionInfo">
                <div class="card-body">
                    {{__('home.answer1')}}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                 aria-controls="collapseTwo">
                <span class="title">{{__('home.question2')}}</span>
            </div>
            <div id="collapseTwo" class="collapse" data-parent="#accordionInfo">
                <div class="card-body">
                    {{__('home.answer2')}}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseThree"
                 aria-expanded="false">
                <span class="title">{{__('home.question3')}}</span>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordionInfo">
                <div class="card-body">
                    {{__('home.answer3')}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md d-flex justify-content-center align-items-center">
            <div class="row">
                <img src="panel-assets/img/datathon-logo.png" alt="Datathon Logo" class="img-fluid my-4" style="height: 150px; object-fit: contain;">
            </div>
        </div>
        <div class="col-md d-flex justify-content-center align-items-center">
            <div class="row">
                <img src="panel-assets/img/icontact-logo.png" alt="icontact logo" class="my-4" style="height: 150px; max-width: 250px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>


<div class="container d-flex justify-content-center align-items-center border-top mt-4" style="height: 7vh;">
    <p class="mb-0">Copyright &copy; <strong>propFinder</strong> 2023. All rights reserved.</p>
</div>

<x-utilities/>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to update the language displayed
        function updateLanguageDisplay() {
            // Get the current locale from the meta tag
            const currentLocale = '{{App::getLocale()}}';

            // Define a mapping from locale codes to language names
            const languageMap = {
                'en': 'English',
                'el': 'Ελληνικά',
                // Add more locales and their display names as needed
            };

            // Update the span with the current language, falling back to 'en' if an unknown locale is found
            document.getElementById('currentLang').textContent = languageMap[currentLocale] || languageMap['el'];
        }

        // Call the function to update the language display
        updateLanguageDisplay();
    });
</script>


</body>
</html>
