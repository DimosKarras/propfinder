<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('panel-assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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

        .myPopover {
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
                            <i class="fas fa-arrow-left fa-fw text-secondary mr-1"></i><span>{{__('analytics.back')}}</span>
                        </a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home', ['locale' => App::getLocale()])}}" id="homeButton">
                            <i class="fas fa-home fa-fw text-secondary mr-1"></i><span>{{__('analytics.home')}}</span>
                        </a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('apis')}}" id="homeButton">
                            <i class="fas fa-exchange-alt fa-fw text-secondary mr-1"></i><span>{{__('analytics.apis')}}</span>
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

                <!-- Page Heading -->
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{--__('analytics.dashboard')--}}</h1>
                    <a id="generateReport" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> {{__('analytics.download_image')}}</a>
                </div>

                <!-- ΠΛΗΘΥΣΜΟΣ -->
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">{{__('analytics.population_header')}}</h3>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Bar Chart Row -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <!-- Title -->
                                    <h6 class="m-0 font-weight-bold text-dark">{{__('analytics.municipality_population')}}</h6>

                                    <!-- Filters Row -->
                                    <div class="row">
                                        <!-- Dropdown Filter -->
                                        <div class="col-md-auto">
                                            <select class="form-control" id="population1" onchange="fetchMunicipalityPopulationData()">
                                                <!-- Options here -->
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                            <canvas id="PopulationChart1" style="display: block; height: 320px; width: 529px;" width="661" height="400" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <b class="mx-1"><em>*{{__('analytics.data_from')}} <a href="https://www.statistics.gr/2021-census-res-pop-results" class="text-success" target="_blank">{{__('analytics.population_data_origin')}}</a></em></b>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <!-- Title -->
                                    <h6 class="m-0 font-weight-bold text-dark">{{__('analytics.municipality_population_per_year')}}</h6>

                                    <!-- Filters Row -->
                                    <div class="row">
                                        <!-- Dropdown Filter -->
                                        <div class="col-md-auto">
                                            <select class="form-control" id="population2" onchange="fetchYearPopulationData()">
                                                <option>2011</option>
                                                <option>2021</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                            <canvas id="PopulationChart2" style="display: block; height: 320px; width: 529px;" width="661" height="400" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <b class="mx-1"><em>*{{__('analytics.data_from')}} <a href="https://www.statistics.gr/2021-census-res-pop-results" class="text-success" target="_blank">{{__('analytics.population_data_origin')}}</a></em></b>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr>

                <!-- ΑΚΙΝΗΤΑ -->
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">{{__('analytics.real_estate_header')}}</h3>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-dark">{{__('analytics.real_estate_bog')}}<i class="fas fa-info-circle ml-1" id="BoGInfo" data-popover="BoGPopover"></i></h6>
                                </div>
                                <!-- Popover -->
                                <div class="myPopover" id="BoGPopover">
                                    {{__('analytics.popover.bog')}}
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="realEstateBankOfGreece"></canvas>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <b class="mx-1"><em>*{{__('analytics.data_from')}} <a href="https://opendata.bankofgreece.gr/el/dataset/5" class="text-success" target="_blank">{{__('analytics.real_estate_bog_origin')}}</a>.({{__('analytics.license')}}: {{__('analytics.real_estate_license')}})</em></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <!-- ΠΙΝΑΚΑΣ ΜΕ ΣΤΟΙΧΕΙΑ ΑΠΟ ΥΠΟΥΡΓΕΙΟ ΟΙΚΟΝΟΜΙΚΩΝ -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-dark">{{__('analytics.real_estate_objective_value')}} (2021)</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-bordered mt-3">
                                        <thead id="realEstateTableHeader">
                                        <!-- Table headers will be added here -->
                                        </thead>
                                        <tbody id="realEstateTableBody">
                                        <!-- Table rows will be added here -->
                                        </tbody>
                                    </table>
                                    <div id="realEstatePagination">
                                        <!-- Pagination buttons will be dynamically added here -->
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <b class="mx-1"><em>*{{__('analytics.data_from')}} <a href="https://maps.gsis.gr/valuemaps/" class="text-success" target="_blank">{{__('analytics.real_estate_objective_value_origin')}}</a>.</em></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- ΕΓΚΛΗΜΑΤΙΚΟΤΗΤΑ -->
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">Εγκληματικότητα</h3>
                        </div>
                    </div>

                    <!-- Content Row 1 -->
                    <div class="row">

                        <!-- Bar Chart Row -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <!-- Title -->
                                    <h6 class="m-0 font-weight-bold text-dark">Εγκληματικότητα Αττικής / Έτος</h6>

                                    <!-- Filters Row -->
                                    <div class="row">
                                        <!-- Dropdown Filter -->
                                        <div class="col-md-auto">
                                            <select class="form-control" id="criminality2" onchange="fetchCriminalityData2()">
                                                <option>2010</option>
                                                <option>2011</option>
                                                <option>2012</option>
                                                <option>2013</option>
                                                <option>2014</option>
                                                <option>2015</option>
                                                <option>2016</option>
                                                <option>2017</option>
                                                <option>2018</option>
                                                <option>2019</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="criminalityYear" style="display: block; height: 320px; width: 529px;" width="661" height="400" class="chartjs-render-monitor"></canvas>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <b class="mx-1"><em>*Δεδομένα από <a href="https://www.astynomia.gr/statistikes-epetirides/statistika-stoicheia-2/statistika-stoicheia-egklimatikotitas/" class="text-success" target="_blank">Ελληνική Αστυνομία</a>.</em></b>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Area Chart -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <!-- Title -->
                                    <h6 class="m-0 font-weight-bold text-dark">Εγκληματικότητα Αττικής / Είδος</h6>

                                    <!-- Filters Row -->
                                    <div class="row">
                                        <!-- Dropdown Filter -->
                                        <div class="col-md-auto">
                                            <select class="form-control" id="criminality1" onchange="fetchCriminalityData1()">
                                                <option>Ανθρωποκτονίες</option>
                                                <option>Απάτες</option>
                                                <option>Αποπλανήσεις</option>
                                                <option>Αρχαιοκαπηλεία</option>
                                                <option>Βιασμοί</option>
                                                <option>Εκβιάσεις</option>
                                                <option>Επαιτεία</option>
                                                <option>Ζωοκλοπή</option>
                                                <option>Κυκλοφορία παραχαραγμένων</option>
                                                <option>Λαθρεμπόριο</option>
                                                <option>Ν περί Ναρκωτικών</option>
                                                <option>Ν περί Όπλων</option>
                                                <option>Ν περί Πνευματικής Ιδιοκτησίας</option>
                                                <option>Παραχάραξη</option>
                                                <option>Πλαστογραφία</option>
                                                <option>Σεξουαλική εκμετάλλευση</option>
                                                <option>Κλοπές - Διαρρήξεις</option>
                                                <option>Κλοπές Τροχοφόρων</option>
                                                <option>Ληστείες</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="criminalityType"></canvas>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <b class="mx-1"><em>*Δεδομένα από <a href="https://www.astynomia.gr/statistikes-epetirides/statistika-stoicheia-2/statistika-stoicheia-egklimatikotitas/" class="text-success" target="_blank">Ελληνική Αστυνομία</a>.</em></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row 2 PIE CHARTS-->
                    <div class="row">

                        <!-- Bar Chart Row 1-->
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <!-- Title -->
                                    <h6 class="m-0 font-weight-bold text-dark">Κλοπές - Διαρρήξεις</h6>
                                    <!-- Filters Row -->
                                    <div class="row">
                                        <!-- Dropdown Filter -->
                                        <div class="col-md-auto">
                                            <select class="form-control" id="criminality3" onchange="fetchCriminalityData3()">
                                                <option>2010</option>
                                                <option>2011</option>
                                                <option>2012</option>
                                                <option>2013</option>
                                                <option>2014</option>
                                                <option>2015</option>
                                                <option>2016</option>
                                                <option>2017</option>
                                                <option>2018</option>
                                                <option>2019</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="criminalityBuildings" style="display: block; height: 320px; width: 529px;" width="661" height="400" class="chartjs-render-monitor"></canvas>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <b class="mx-1"><em>*Δεδομένα από <a href="https://www.astynomia.gr/statistikes-epetirides/statistika-stoicheia-2/statistika-stoicheia-egklimatikotitas/" class="text-success" target="_blank">Ελληνική Αστυνομία</a>.</em></b>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart Row 2-->
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <!-- Title -->
                                    <h6 class="m-0 font-weight-bold text-dark">Κλοπές Τροχοφόρων</h6>
                                    <!-- Filters Row -->
                                    <div class="row">
                                        <!-- Dropdown Filter -->
                                        <div class="col-md-auto">
                                            <select class="form-control" id="criminality4" onchange="fetchCriminalityData4()">
                                                <option>2010</option>
                                                <option>2011</option>
                                                <option>2012</option>
                                                <option>2013</option>
                                                <option>2014</option>
                                                <option>2015</option>
                                                <option>2016</option>
                                                <option>2017</option>
                                                <option>2018</option>
                                                <option>2019</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="criminalityVehicles" style="display: block; height: 320px; width: 529px;" width="661" height="400" class="chartjs-render-monitor"></canvas>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <b class="mx-1"><em>*Δεδομένα από <a href="https://www.astynomia.gr/statistikes-epetirides/statistika-stoicheia-2/statistika-stoicheia-egklimatikotitas/" class="text-success" target="_blank">Ελληνική Αστυνομία</a>.</em></b>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart Row 3-->
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <!-- Title -->
                                    <h6 class="m-0 font-weight-bold text-dark">Ληστείες</h6>
                                    <!-- Filters Row -->
                                    <div class="row">
                                        <!-- Dropdown Filter -->
                                        <div class="col-md-auto">
                                            <select class="form-control" id="criminality5" onchange="fetchCriminalityData5()">
                                                <option>2010</option>
                                                <option>2011</option>
                                                <option>2012</option>
                                                <option>2013</option>
                                                <option>2014</option>
                                                <option>2015</option>
                                                <option>2016</option>
                                                <option>2017</option>
                                                <option>2018</option>
                                                <option>2019</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="criminalityHeists" style="display: block; height: 320px; width: 529px;" width="661" height="400" class="chartjs-render-monitor"></canvas>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <b class="mx-1"><em>*Δεδομένα από <a href="https://www.astynomia.gr/statistikes-epetirides/statistika-stoicheia-2/statistika-stoicheia-egklimatikotitas/" class="text-success" target="_blank">Ελληνική Αστυνομία</a>.</em></b>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <hr>

                <!-- ΡΥΠΑΝΣΗ -->
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">Ατμοσφαιρική Ρύπανση</h3>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-dark">Ατμοσφαιρική Ρύπανση</h6>
                                    <!-- Filters Row -->
                                    <div class="row justify-content-end">

                                        <!-- Dropdown Filter -->
                                        <div class="col-md">
                                            <select class="form-control" id="airPollution1" onchange="fetchAirPollutionData()">
                                                <option>Μονοξείδιο του Αζώτου</option>
                                                <option>Διοξείδιο του Αζώτου</option>
                                                <option>Όζον</option>
                                                <option>Μονοξείδιο του Άνθρακα</option>
                                                <option>Διοξείδιο του Θείου</option>
                                                <option>Μικροσωματίδια PM10</option>
                                                <option>Μικροσωματίδια PM2.5</option>
                                            </select>
                                        </div>

                                        <!-- Dropdown Filter -->
                                        <div class="col-md">
                                            <select class="form-control" id="airPollution2" onchange="fetchAirPollutionData()">
                                                <option>Αγίας Παρασκευής</option>
                                                <option>Αθηναίων</option>
                                                <option>Αμαρουσίου</option>
                                                <option>Λυκόβρυσης - Πεύκης</option>
                                                <option>Νέας Σμύρνης</option>
                                                <option>Περιστερίου</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="airPollutionTotal"></canvas>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <b class="mx-1"><em>*Δεδομένα από <a href="https://ypen.gov.gr/perivallon/poiotita-tis-atmosfairas/dedomena-metriseon-atmosfairikis-rypansis/" class="text-success" target="_blank">Υπουργείο Ενέργειας</a>.</em></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <hr>

                <!-- ΣΧΟΛΕΙΑ -->
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">Σχολεία</h3>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="container-fluid mt-3">
                            <!-- Filters Row -->
                            <div class="row">

                                <div class="col-md-8"></div>

                                <!-- Dropdown Filter -->
                                <div class="col-md-2">
                                    <select class="form-control float-right" id="school1" onchange="fetchSchoolData()">
                                    </select>
                                </div>

                                <!-- Dropdown Filter -->
                                <div class="col-md-2">
                                    <select class="form-control float-right" id="school2" onchange="fetchSchoolData()">
                                    </select>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered mt-3">
                                    <thead id="tableHeader">
                                    <!-- Table rows will be added here -->
                                    </thead>
                                    <tbody id="tableBody">
                                    <!-- Table rows will be added here -->
                                    </tbody>
                                </table>
                            </div>
                            <div id="schoolPagination">
                                <!-- Pagination buttons will be dynamically added here -->
                            </div>
                            <hr>
                            <div class="row">
                                <b class="mx-1"><em>*Δεδομένα από Κατάλογος Δημοσίων Δεδομένων (<a href="https://archive.data.gov.gr/dataset/basika-stoixeia-sxolikwn-monadwn" class="text-success" target="_blank">data.gov.gr</a>). Άδεια Χρήσης (Open Data Commons Open Database License (ODbL))</em></b>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- ΜΕΣΑ ΜΑΖΙΚΗΣ ΜΕΤΑΦΟΡΑΣ -->
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">Μέσα Μαζικής Μεταφοράς</h3>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="container-fluid mt-3">
                            <!-- Filters Row -->
                            <div class="row">

                                <div class="col-md-8"></div>

                                <!-- Dropdown Filter -->
                                <div class="col-md-2">
                                    <select class="form-control float-right" id="trans1" onchange="fetchTransportationData()">
                                        <option>Στάσεις</option>
                                        <option>Στάσεις με Μπάρα</option>
                                        <option>Μετρό</option>
                                        <option>Ταξί</option>
                                    </select>
                                </div>

                                <!-- Dropdown Filter -->
                                <div class="col-md-2">
                                    <select class="form-control float-right" id="trans2" onchange="fetchTransportationData()">
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <!-- Table -->
                                <table class="table table-bordered mt-3">
                                    <thead id="transTableHeader">
                                    <!-- Table heads will be added here -->
                                    </thead>
                                    <tbody id="transTableBody">
                                    <!-- Table rows will be added here -->
                                    </tbody>
                                </table>
                            </div>
                            <div id="transPagination">
                                <!-- Pagination buttons will be dynamically added here -->
                            </div>
                            <hr>
                            <div class="row">
                                <b class="mx-1"><em>*Δεδομένα Στάσεων από την ψηφιακή πλατφόρμα διάθεσης ανοικτών δεδομένων (<a href="https://catalog.hcapdata.gr/dataset/pinakas-staseon-oasa" class="text-success" target="_blank">O2hub</a>). Άδεια Χρήσης (Creative Commons Αναφορά 4.0)</em></b>
                            </div>
                            <div class="row">
                                <b class="mx-1"><em>*Δεδομένα Στάσεων με Μπάρα από την ψηφιακή πλατφόρμα διάθεσης ανοικτών δεδομένων (<a href="https://catalog.hcapdata.gr/dataset/prosbasimothta-amea" class="text-success" target="_blank">O2hub</a>). Άδεια Χρήσης (Creative Commons Αναφορά 4.0)</em></b>
                            </div>
                            <div class="row">
                                <b class="mx-1"><em>*Δεδομένα για Πιάτσες Ταξί από την ψηφιακή πλατφόρμα διάθεσης ανοικτών δεδομένων (<a href="https://catalog.hcapdata.gr/dataset/shmeia-me-tis-piatses-taxi" class="text-success" target="_blank">O2hub</a>). Άδεια Χρήσης (Creative Commons Αναφορά 4.0)</em></b>
                            </div>
                            <div class="row">
                                <b class="mx-1"><em>*Δεδομένα Μετρό από <a href="https://www.choicegreece.com/el/tips/plhrhs-odhgos-tou-metro-ths-athinas-xarths" class="text-success" target="_blank">ChoiceGreece (Google My Maps) </a>& OpenStreetMap API.</em></b>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- ΛΟΙΠΑ -->
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">Λοιπά</h3>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="container-fluid mt-3">
                            <!-- Filters Row -->
                            <div class="row">

                                <div class="col-md-8"></div>

                                <!-- Dropdown Filter -->
                                <div class="col-md-2">
                                    <select class="form-control float-right" id="other1" onchange="fetchOtherData()">
                                        <option>Θερμαινόμενοι χώροι</option>
                                        <option>Κλιματιζόμενοι χώροι</option>
                                        <option>Κέντρα Δημιουργικής Απασχόλησης Παίδων</option>
                                        <option>Κέντρα Δημιουργικής Απασχόλησης Παίδων με Αναπηρία</option>
                                        <option>Κέντρα Φροντίδας Ηλικιωμένων</option>
                                        <option>Κέντρα Αποθεραπείας - Αποκατάστασης</option>
                                    </select>
                                </div>

                                <!-- Dropdown Filter -->
                                <div class="col-md-2">
                                    <select class="form-control float-right" id="other2" onchange="fetchOtherData()">
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <!-- Table -->
                                <table class="table table-bordered mt-3">
                                    <thead id="otherTableHeader">
                                    <!-- Table heads will be added here -->
                                    </thead>
                                    <tbody id="otherTableBody">
                                    <!-- Table rows will be added here -->
                                    </tbody>
                                </table>
                            </div>
                            <div id="otherPagination">
                                <!-- Pagination buttons will be dynamically added here -->
                            </div>
                            <hr>
                            <div class="row">
                                <b class="mx-1"><em>*Δεδομένα Κλιματιζόμενων και Θερμαινόμενων χώρων από <a href="https://www.patt.gov.gr/koinonia/politiki_prostasia/politiki_prostasia_kentriko/" class="text-success" target="_blank">Περιφέρεια Αττικής</a>.</em></b>
                            </div>
                            <div class="row">
                                <b class="mx-1"><em>*Δεδομένα Κέντρων Αποθεραπείας - Αποκατάστασης από Ανοιχτά Δεδομένα Περιφέρειας Αττικής (<a href="https://opendata.attica.gov.gr/content/genikh-dieythynsh-dhmosias-ygeias-kai-koinwnikhs-merimnas/d-nsh-koinwnikhs-merimnas/48-kentra-apotherapeias-apokatastashs" class="text-success" target="_blank">opendata.attica.gov.gr</a>).</em></b>
                            </div>
                            <div class="row">
                                <b class="mx-1"><em>*Δεδομένα Κέντρα Δημιουργικής Απασχόλησης Παιδιών από Ανοιχτά Δεδομένα Περιφέρειας Αττικής (<a href="https://opendata.attica.gov.gr/content/genikh-dieythynsh-dhmosias-ygeias-kai-koinwnikhs-merimnas/d-nsh-koinwnikhs-merimnas/44-kentra-dhmioyrgikhs-apasxolhshs-paidiwn" class="text-success" target="_blank">opendata.attica.gov.gr</a>).</em></b>
                            </div>
                            <div class="row">
                                <b class="mx-1"><em>*Δεδομένα Κέντρα Δημιουργικής Απασχόλησης Παιδιών με Ειδικές Ανάγκες από Ανοιχτά Δεδομένα Περιφέρειας Αττικής (<a href="https://opendata.attica.gov.gr/content/genikh-dieythynsh-dhmosias-ygeias-kai-koinwnikhs-merimnas/d-nsh-koinwnikhs-merimnas/45-kentra-dhmioyrgikhs-apasxolhshs-paidiwn-me-anaphria" class="text-success" target="_blank">opendata.attica.gov.gr</a>).</em></b>
                            </div>
                            <div class="row">
                                <b class="mx-1"><em>*Δεδομένα Μονάδων Φροντίδας Ηλικιωμένων από Ανοιχτά Δεδομένα Περιφέρειας Αττικής (<a href="https://opendata.attica.gov.gr/content/genikh-dieythynsh-dhmosias-ygeias-kai-koinwnikhs-merimnas/d-nsh-koinwnikhs-merimnas/43-lista-me-monades-frontidas-hlikiwmenwn" class="text-success" target="_blank">opendata.attica.gov.gr</a>).</em></b>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <hr>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
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

<!-- JavaScript for Filtering and Searching -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchOptions('population1', 'municipality');
        fetchOptions('school1', 'municipality');
        fetchOptions('school2', 'schools');
        fetchOptions('trans2', 'municipality');
        fetchOptions('other2', 'municipality');
        fetchBankOfGreeceData();
        fetchRealEstateData();
        fetchMunicipalityPopulationData();
        fetchYearPopulationData();
        fetchAirPollutionData();
        fetchSchoolData();
        fetchTransportationData();
        fetchOtherData();
        fetchCriminalityData1();
        fetchCriminalityData2();
        fetchCriminalityData3();
        fetchCriminalityData4();
        fetchCriminalityData5();

    });

    // Popover Functionality
    document.addEventListener("DOMContentLoaded", function() {
        // Handler to show or hide popover
        function togglePopover(popoverId, iconId) {
            var popover = document.getElementById(popoverId);
            var icon = document.getElementById(iconId);

            // Hide all other popovers
            document.querySelectorAll('.myPopover').forEach(function(p) {
                if (p !== popover) {
                    p.style.display = 'none';
                }
            });

            var isVisible = popover.style.display === "block";
            if (!isVisible) {
                popover.style.display = "block";
            } else {
                popover.style.display = "none";
            }
        }

        // Add click event listeners to icons
        document.querySelectorAll('[data-popover]').forEach(function(icon) {
            var popoverId = icon.getAttribute('data-popover');
            icon.addEventListener("click", function(event) {
                togglePopover(popoverId, icon.id);
                event.stopPropagation();
            });
        });

        // Close popovers when clicking elsewhere
        document.addEventListener("click", function() {
            document.querySelectorAll('.myPopover').forEach(function(p) {
                p.style.display = 'none';
            });
        });
    });

    function fetchOptions(selectId, field) {
        // Replace with your API URL
        fetch('{{config('app.url')}}' + '/api/getFields/' + field)
            .then(response => response.json())
            .then(data => {
                populateDropdown(selectId, data.data);
            })
            .catch(error => {
                console.error('Error fetching options:', error);
            });
    }

    function populateDropdown(selectId, options) {
        var select = document.getElementById(selectId);

        // Clear existing options
        if(selectId === 'airPollution2' || selectId === 'population1') {
            select.innerHTML = '';
        } else {
            select.innerHTML = '<option>Όλα</option>';
        }


        // Add new options from API
        for (var key in options) {
            if (options.hasOwnProperty(key)) {
                var opt = document.createElement('option');
                opt.value = options[key];
                opt.innerHTML = options[key];
                opt.id = selectId + "_" + key; // Set the key as the option's id
                select.appendChild(opt);
            }
        }
    }

    function fetchSchoolData(pageNumber = 1) {
        var select1 = document.getElementById("school1");
        var select1Value = select1 && select1.value ? select1.value : 'Όλα';

        var select2 = document.getElementById("school2");
        var select2Value = select2 && select2.value ? select2.value : 'Όλα';

        // Prepare the data to be sent in the POST request
        var formData = new URLSearchParams();
        formData.append('municipality', select1Value);
        formData.append('kind', select2Value);
        var apiURL = `{{config('app.url')}}/api/fetchSchoolData?page=${pageNumber}`;

        fetch(apiURL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                populateTable(data.data, 'schools');
                setupPagination(data.current_page, data.last_page, 'changePageSchool', 'schoolPagination');
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchTransportationData(pageNumber = 1) {
        var select1 = document.getElementById("trans1");
        var select1Value = select1 && select1.value ? select1.value : 'Στάσεις';

        var select2 = document.getElementById("trans2");
        var select2Value = select2 && select2.value ? select2.value : 'Όλα';

        // Prepare the data to be sent in the POST request
        var formData = new URLSearchParams();
        formData.append('trans', select1Value);
        formData.append('municipality', select2Value);
        var apiURL = `{{config('app.url')}}/api/fetchTransData?page=${pageNumber}`;

        fetch(apiURL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                populateTable(data.data, 'trans');
                setupPagination(data.current_page, data.last_page, 'changePageTrans', 'transPagination');
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchOtherData(pageNumber = 1) {
        var select1 = document.getElementById("other1");
        var select1Value = select1 && select1.value ? select1.value : 'Θερμαινόμενοι Χώροι';

        var select2 = document.getElementById("other2");
        var select2Value = select2 && select2.value ? select2.value : 'Όλα';

        // Prepare the data to be sent in the POST request
        var formData = new URLSearchParams();
        formData.append('other', select1Value);
        formData.append('municipality', select2Value);
        var apiURL = `{{config('app.url')}}/api/fetchOtherData?page=${pageNumber}`;

        fetch(apiURL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                populateTable(data.data, 'other');
                setupPagination(data.current_page, data.last_page, 'changePageOther', 'otherPagination');
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }


    function fetchAirPollutionData() {
        var select1 = document.getElementById("airPollution1");
        var select1Value = select1 && select1.value ? select1.value : 'Μονοξείδιο του Αζώτου';

        var select2 = document.getElementById("airPollution2");
        var select2Value = select2 && select2.value ? select2.value : 'Αγίας Παρασκευής';

        // Prepare the data to be sent in the POST request
        var formData = new URLSearchParams();
        formData.append('municipality', select2Value);
        formData.append('pollution', select1Value);
        var apiURL = `{{config('app.url')}}/api/fetchAirPollutionData`;

        fetch(apiURL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                updateChartData(pollutionChart, data);
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchMunicipalityPopulationData() {

        var select1 = document.getElementById("population1");
        var select1Value = select1 && select1.value ? select1.value : 'Αγίας Βαρβάρας';

        var apiURL = `{{config('app.url')}}/api/fetchPopulationData?municipality=${select1Value}`;

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                updateBarChart(municipalityPopulationChart, data.data);
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchYearPopulationData() {
        var select1 = document.getElementById("population2");
        var select1Value = select1 && select1.value ? select1.value : '2011';



        var apiURL = `{{config('app.url')}}/api/fetchPopulationData?year=${select1Value}`;

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                updateBarChart(yearPopulationChart, data.data);
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchBankOfGreeceData() {
        var apiURL = `{{config('app.url')}}/api/fetchBankOfGreeceData`;

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                updateChartData(bankOfGreeceChart, data.data);
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchRealEstateData(year=2021) {
        var apiURL = `{{config('app.url')}}/api/fetchRealEstateData?year=${year}`;

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                populateTable(data.data, 'realEstate');
                // Initialize pagination
                const itemsPerPage = 4; // Set the number of items per page
                createPaginationControls(data.data.values, itemsPerPage);
                customPaginator(data.data.values, 1, itemsPerPage); // Start with the first page

            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchCriminalityData1(){
        var select1 = document.getElementById("criminality1");
        var select1Value = select1 && select1.value ? select1.value : 'Ανθρωποκτονίες';

        var apiURL = `{{config('app.url')}}/api/fetchCriminalityData?data=all&criminality=${select1Value}`;

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                updateCriminalityChartData(criminalityChart, data.data);
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchCriminalityData2(){
        var select1 = document.getElementById("criminality2");
        var select1Value = select1 && select1.value ? select1.value : '2010';

        var apiURL = `{{config('app.url')}}/api/fetchCriminalityData?data=all&year=${select1Value}`;

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                updateBarChart(yearCriminalityChart, data.data.values);
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchCriminalityData3(){
        var select1 = document.getElementById("criminality3");
        var select1Value = select1 && select1.value ? select1.value : '2010';

        var apiURL = `{{config('app.url')}}/api/fetchCriminalityData?data=buildings&year=${select1Value}`;

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                updateCriminalityPieChart(buildingsCriminalityChart, data.data);
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchCriminalityData4(){
        var select1 = document.getElementById("criminality4");
        var select1Value = select1 && select1.value ? select1.value : '2010';

        var apiURL = `{{config('app.url')}}/api/fetchCriminalityData?data=vehicles&year=${select1Value}`;

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                updateCriminalityPieChart(vehiclesCriminalityChart, data.data);
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    function fetchCriminalityData5(){
        var select1 = document.getElementById("criminality5");
        var select1Value = select1 && select1.value ? select1.value : '2010';

        var apiURL = `{{config('app.url')}}/api/fetchCriminalityData?data=heists&year=${select1Value}`;

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                updateCriminalityPieChart(heistsCriminalityChart, data.data);
            })
            .catch(error => {
                console.error('Error fetching table data:', error);
            });
    }

    /* ------------------------------------------------------------------------------------- */
    function populateTable(data, type) {
        // Selecting the correct table body and header based on the type
        var tableBody, tableHeader;
        if (type === 'schools') {
            tableBody = document.getElementById('tableBody');
            tableHeader = document.getElementById('tableHeader');
        } else if (type === 'trans') {
            tableBody = document.getElementById('transTableBody');
            tableHeader = document.getElementById('transTableHeader');
        } else if (type === 'realEstate') {
            tableBody = document.getElementById('realEstateTableBody');
            tableHeader = document.getElementById('realEstateTableHeader');
        } else {
            tableBody = document.getElementById('otherTableBody');
            tableHeader = document.getElementById('otherTableHeader');
        }

        // Clear existing headers and rows
        tableHeader.innerHTML = '';
        tableBody.innerHTML = '';

        // Extracting headers and values
        var headers = data.headers;
        var rows = data.values;

        // Handling headers
        var headerRow = tableHeader.insertRow();
        headers.forEach(header => {
            var th = document.createElement("th");
            th.innerHTML = header;
            headerRow.appendChild(th);
        });

        // Handling rows
        rows.forEach(row => {
            var tableRow = tableBody.insertRow();

            // Iterate over each property in the row object
            Object.values(row).forEach(val => {
                var cell = tableRow.insertCell();
                // Check if the value is a URL, create a link if it is
                if (typeof val === 'string' && val.startsWith("http")) {
                    var link = document.createElement("a");
                    link.href = val;
                    link.target = "_blank";
                    link.innerHTML = "Link";
                    cell.appendChild(link);
                } else {
                    cell.innerHTML = val;
                }
            });
        });
    }

    function updateChartData(chart, newData) {
        // Create labels in the format "Year QQuarter"
        let labels = newData.map(item => `${item.year} ${item.quarter}ο τρμ`);
        // Extract the average value for each data point
        let data = newData.map(item => item.value);

        chart.data.labels = labels;
        chart.data.datasets.forEach((dataset) => {
            dataset.data = data;
        });

        chart.update();
    }


    function updateCriminalityPieChart(chart, newData) {
        // Extract number of crimes for the new dataset
        let newDataset = newData.map(item => item.number_of_crimes);

        // Extract crime types for labels
        let labels = newData.map(item => item.type);

        // Assuming there is only one dataset in the pie chart
        if (chart.data.datasets.length > 0) {
            chart.data.datasets[0].data = newDataset;
        }

        // Update labels
        chart.data.labels = labels;

        // Update the chart
        chart.update();
    }


    function updateBarChart(chart, newData) {
        let labels, menData, womenData;

        if (chart.options.chartName === 'municipalityPopulationChart') {
            // Extract years for labels
            labels = newData.map(item => item.year);

            // Extract data for men and women
            menData = newData.map(item => item.men);
            womenData = newData.map(item => item.women);

            chart.data.datasets[0].data = menData; // Update men's data
            chart.data.datasets[1].data = womenData; // Update women's data
        } else if (chart.options.chartName === 'yearCriminalityChart') {
            // Extract types for labels
            labels = newData.map(item => item.type);

            // Extract number of crimes data
            crimeData = newData.map(item => item.number_of_crimes);

            chart.data.datasets[0].data = crimeData; // Update crime data
        } else {
            // Handle other chart updates
            labels = newData.map(item => item.municipality);
            let populationData = newData.map(item => item.population);

            chart.data.datasets[0].data = populationData; // Update population data
            // Assuming only one dataset for this type of chart
        }

        chart.data.labels = labels;
        chart.update();
    }


    function updateCriminalityChartData(chart, newData) {
        // Create labels from the "year" field
        let labels = newData.map(item => item.year);
        // Extract the number of crimes for each data point
        let data = newData.map(item => item.number_of_crimes);

        chart.data.labels = labels;
        chart.data.datasets.forEach((dataset) => {
            dataset.data = data;
        });

        chart.update();
    }


    function customPaginator(data, currentPage, itemsPerPage) {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedItems = data.slice(startIndex, endIndex);

        const tableBody = document.getElementById('realEstateTableBody');
        tableBody.innerHTML = ''; // Clear existing data

        paginatedItems.forEach(item => {
            // Assuming 'item' is an object with properties that match your table columns
            const row = document.createElement('tr');
            Object.values(item).forEach(text => {
                const cell = document.createElement('td');
                cell.textContent = text;
                row.appendChild(cell);
            });
            tableBody.appendChild(row);
        });

        createPaginationControls(data, itemsPerPage, currentPage);
    }

    function createPaginationControls(data, itemsPerPage, currentPage) {
        const paginationDiv = document.getElementById('realEstatePagination');
        paginationDiv.innerHTML = ''; // Clear existing pagination

        const pageCount = Math.ceil(data.length / itemsPerPage);

        // Create a div for pagination buttons and apply Bootstrap pagination classes
        const paginationContainer = document.createElement('nav');
        const paginationUl = document.createElement('ul');
        paginationUl.className = 'pagination';

        for (let i = 1; i <= pageCount; i++) {
            const paginationLi = document.createElement('li');
            paginationLi.className = 'page-item';
            if (i === currentPage) {
                paginationLi.classList.add('active');
            }

            const button = document.createElement('button');
            button.className = 'page-link';
            button.textContent = i;
            button.onclick = () => customPaginator(data, i, itemsPerPage);

            paginationLi.appendChild(button);
            paginationUl.appendChild(paginationLi);
        }

        paginationContainer.appendChild(paginationUl);
        paginationDiv.appendChild(paginationContainer);
    }

    // function filterTable() {
    //     var select1 = document.getElementById("school1").value;
    //     var select2 = document.getElementById("school2").value;
    //     var table = document.getElementById("tableBody");
    //     var rows = table.getElementsByTagName("tr");
    //
    //     for (var i = 0; i < rows.length; i++) {
    //         var cells = rows[i].getElementsByTagName("td");
    //         // Column indices
    //         var columnIndex1 = 6; // Index for "Δήμος"
    //         var columnIndex2 = 1; // Index for "Είδος"
    //
    //         var cellValue1 = cells[columnIndex1].innerText;
    //         var cellValue2 = cells[columnIndex2].innerText;
    //
    //         if ((select1 === "All" || cellValue1 === select1) &&
    //             (select2 === "All" || cellValue2 === select2)) {
    //             rows[i].style.display = "";
    //         } else {
    //             rows[i].style.display = "none";
    //         }
    //     }
    // }

    function setupPagination(currentPage, lastPage, pageChangeFunction, paginationDivId) {
        let paginationHTML = '<nav><ul class="pagination">';

        // Previous Button
        if (currentPage > 1) {
            paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="${pageChangeFunction}(${currentPage - 1}); return false;">Previous</a></li>`;
        } else {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">Previous</span></li>`;
        }

        // Page number buttons
        for (let i = 1; i <= lastPage; i++) {
            if (i === currentPage || i === 1 || i === lastPage || (i >= currentPage - 2 && i <= currentPage + 2)) {
                paginationHTML += `<li class="page-item ${i === currentPage ? 'active' : ''}"><a class="page-link" href="#" onclick="${pageChangeFunction}(${i}); return false;">${i}</a></li>`;
            } else if (i === 2 || i === lastPage - 1) {
                paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
        }

        // Next Button
        if (currentPage < lastPage) {
            paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="${pageChangeFunction}(${currentPage + 1}); return false;">Next</a></li>`;
        } else {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">Next</span></li>`;
        }

        paginationHTML += '</ul></nav>';
        document.getElementById(paginationDivId).innerHTML = paginationHTML;
    }


    function changePageSchool(newPage) {
        fetchSchoolData(newPage);
    }

    function changePageTrans(newPage) {
        fetchTransportationData(newPage);
    }

    function changePageOther(newPage) {
        fetchOtherData(newPage);
    }


    function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableBody");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Assuming you want to search in the 'Name' column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.getElementById('generateReport').addEventListener('click', function() {
        html2canvas(document.getElementById('pageContent')).then(canvas => {
            // Create an image
            const image = canvas.toDataURL('image/png', 1.0);

            // Create a link to download the image
            let downloadLink = document.createElement('a');
            downloadLink.href = image;
            downloadLink.download = 'pageContent.png';

            // Append the link to the body, click it and then remove it
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        });
    });

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

    document.getElementById('contrastToggle').addEventListener('click', function() {
        document.body.classList.toggle('high-contrast');
    });
</script>
</body>

</html>

