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
            left: 25%;
            right: 25%;
            z-index: 1050;
            display: none;
            width: 50%;
            padding-bottom: 0;
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

        .high-contrast {
            background-color: black;
            color: white;
        }

        .high-contrast a {
            color: yellow;
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

    <!-- Modal -->
    <div class="modal fade" id="entryModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('panel.modal.title')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('panel.modal.body.header')}}</p>
                    <h5>{{__('panel.modal.body.instructions')}}:<br></h5>
                    <b>1. {{__('panel.modal.body.first_instruction')}}</b><br>
                    <small><i>*{{__('panel.modal.body.note')}}: {{__('panel.modal.body.first_instruction_note')}}</i></small><br>
                    <b>2. {{__('panel.modal.body.second_instruction')}}</b><br>
                    <small><i>*{{__('panel.modal.body.note')}}: {{__('panel.modal.body.second_instruction_note')}}</i></small><br>
                    <b>3. {{__('panel.modal.body.third_instruction')}}</b><br>
                    <small><i>*{{__('panel.modal.body.note')}}: {{__('panel.modal.body.third_instruction_note')}}</i></small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('panel.modal.close')}}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <x-sidebar/>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-globe-europe fa-fw"></i><span id="currentLang" class="d-none d-lg-inline-block font-weight-bold"></span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">{{__('panel.languages')}}</h6>
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
                    <div class="topbar-divider d-none d-sm-block"></div>
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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{--__('panel.dashboard')--}}</h1>
                    <a id="generateReport" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> {{__('panel.download_image')}}</a>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- COLUMN 1 (MAP) -->
                    <div class="col-xl p-3 border border-5" style="position: relative;">
                        <x-svg-map/>
                        <h4 class="label" id="country-name" style="position: absolute; bottom: 12px; left: 12px; z-index: 2; color:#1a202c; font-weight:600;">-</h4>
                    </div>
                    <script>
                        function displayName(name) {
                            document.getElementById('country-name').firstChild.data = name;
                        }
                    </script>
                    <!-- COLUMN 2 (PRIMARY INFO) -->
                    <div class="col-xl p-3 border border-5 d-flex flex-column">
                        <div class="row justify-content-center mb-3">
                            <h4 class="text-center font-weight-bold">{{__('panel.main_data_title')}}</h4>
                        </div>
                        <div class="container flex-grow-1">
                            <table id="primary_table" class="table table-bordered h-100" style="vertical-align: middle; text-align: center;">
                                <tbody>
                                <tr>
                                    <td class="font-weight-bold text-center align-middle">{{__('panel.main_data_values.municipality')}}</td>
                                    <td class="text-center align-middle">-</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-center align-middle">{{__('panel.main_data_values.section')}}</td>
                                    <td class="text-center align-middle">-</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-center align-middle">{{__('panel.main_data_values.area')}}</td>
                                    <td class="text-center align-middle">-</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-center align-middle">{{__('panel.main_data_values.population')}}</td>
                                    <td class="text-center align-middle">-</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-center align-middle">{{__('panel.main_data_values.real_estate_price')}}</td>
                                    <td class="text-center align-middle">-</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-xl p-3 border border-5 d-flex flex-column"> <!-- Adjust height as needed -->
                        <div class="row justify-content-center mb-3">
                            <h4 class="text-center font-weight-bold">{{__('panel.indexes_title')}}</h4><i class="fas fa-info-circle ml-1" id="indexesInfo" data-popover="indexesPopover"></i></h6>
                        </div>
                        <!-- Popover -->
                        <div class="myPopover small mx-3" id="indexesPopover">
                            {{__('panel.indexes_info')}}
                        </div>
                        <div id="progress-container" class="container flex-grow-1 overflow-auto" style="max-height: 300px;"> <!-- Adjust max-height as needed -->
                            <!-- Progress bars will be dynamically added here -->
                        </div>
                        <div id="sustainability-index" class="container mt-auto border-top border-top-2">
                            <!-- Sustainability Index will be dynamically added here -->
                        </div>
                    </div>

                </div>

                <hr>


                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">{{__('panel.general_info_header')}}</h3>
                        </div>
                    </div>

                    <!-- Content Row General Info -->
                    <div class="row">
                        <!-- Συνολικός Πληθυσμός Αθήνας -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('panel.general_info_values.population_sum_header')}} <i class="fas fa-info-circle" id="populationInfo" data-popover="populationPopover"></i></div>
                                            <!-- Popover -->
                                            <div class="myPopover small" id="populationPopover">
                                                {{__('panel.general_info_values.population_sum_info')}}
                                            </div>
                                            <div id="populationTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-person fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Πυκνότητα Δήμου / 1000 άτομα -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('panel.general_info_values.municipality_density_header')}}</div>
                                            <div id="density" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-city fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Εγκληματικότητα -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{__('panel.general_info_values.criminality_header')}} <i class="fas fa-info-circle" id="criminalityInfo" data-popover="criminalityPopover"></i></div>
                                            <!-- Popover -->
                                            <div class="myPopover small" id="criminalityPopover">
                                                {{__('panel.general_info_values.criminality_info')}}
                                            </div>
                                            <div id="criminalityTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-handcuffs fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row  Akinita  & Plithismos-->
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('panel.real_estate_header')}}</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="realEstateTotal"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('panel.population_header')}}</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="populationGender"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-primary"></i> {{__('panel.population_values.men')}}
                                    </span>
                                        <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> {{__('panel.population_values.women')}}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">{{__('panel.transportation_header')}}</h3>
                        </div>
                    </div>

                    <!-- Content Row Transportation-->
                    <div class="row">

                        <!-- Μετρό -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{__('panel.transportation_values.subway_header')}}</div>
                                            <div id="subwayTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-train fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Στάσεις Λεοφωρείων -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('panel.transportation_values.bus_header')}}</div>
                                            <div id="busTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bus fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Στασεις με Μπαρα ΑΜΕΑ -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('panel.transportation_values.bus_disability_header')}}</div>
                                            <div id="busDisabilityTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bus fa-2x text-gray-300"></i>
                                            <i class="fas fa-wheelchair"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Taxi stops -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{__('panel.transportation_values.taxi_header')}}</div>
                                            <div id="taxiTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-taxi fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">{{__('panel.education_header')}}</h3>
                        </div>
                    </div>

                    <!-- Content Row Schools-->
                    <div class="row">
                        <!-- Νηπιαγωγεία -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{__('panel.education_values.nursery_school_header')}}</div>
                                            <div id="preSchoolTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-child fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Δημοτικά -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{__('panel.education_values.primary_school_header')}}</div>
                                            <div id="primarySchoolTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-school fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Γυμνάσια -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{__('panel.education_values.middle_school_header')}}</div>
                                            <div id="middleSchoolTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chalkboard fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Λύκεια (ΓΕΛ) -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{__('panel.education_values.high_school_header')}}</div>
                                            <div id="highSchoolTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-university fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Λυκεια (ΕΠΑ.Λ.) -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{__('panel.education_values.vocational_high_school_header')}}</div>
                                            <div id="vocationalHighSchoolTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-university fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Σχολικά Εργαστηριακά Κέντρα -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{__('panel.education_values.laboratory_center_header')}}</div>
                                            <div id="schoolLaboratoryCenterTotal" class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-flask-vial fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="my-4 font-weight-bold">{{__('panel.pollution_header')}}</h3>
                        </div>
                    </div>

                    <!-- Content Row Pollution-->
                    <div class="row">

                        <!-- O3 -->
                        <div class="col-xl col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('panel.pollution_values.ozone_header')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span id="O3Total">-</span><small>μg/m³</small>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-atom fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- NO2 -->
                        <div class="col-xl col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('panel.pollution_values.nitrogen_dioxide_header')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span id="NO2Total">-</span><small>μg/m³</small>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-atom fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SO2 -->
                        <div class="col-xl col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('panel.pollution_values.sulfur_dioxide_header')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span id="SO2Total">-</span><small>μg/m³</small>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-atom fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PM2.5 -->
                        <div class="col-xl col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('panel.pollution_values.particulate_matter_25_header')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span id="PM25Total">-</span><small>μg/m³</small>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-atom fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PM10 -->
                        <div class="col-xl col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('panel.pollution_values.particulate_matter_10_header')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span id="PM10Total">-</span><small>μg/m³</small>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-atom fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
<!-- End of Page Wrapper -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attach click event listeners to each SVG path
        document.querySelectorAll('svg path').forEach(function(path) {
            path.addEventListener('click', function() {
                // Check if ObjectData exists in localStorage
                if (!localStorage.getItem('formData')) {
                    // Call your alert function if ObjectData is not found
                    showAlertWithMessage('{{__('panel.alerts.no_index_selected')}}', "warning");
                    return;
                }
                updateTableWithData(path.id);
                loadProgressData(path.id);
                fetchDataAndUpdateDivs(path.id)
            });
        });
    });

    function updateTableWithData(pathId) {
        // Asynchronous API call for primary info
        fetch('{{config('app.url')}}' + '/api/municipalities/' + pathId)
            .then(response => response.json())
            .then(data => {
                document.querySelector('#primary_table tr:nth-child(1) td:nth-child(2)').innerText = data.data.municipality;
                document.querySelector('#primary_table tr:nth-child(2) td:nth-child(2)').innerText = data.data.sector;
                document.querySelector('#primary_table tr:nth-child(3) td:nth-child(2)').innerText = data.data.area;
                document.querySelector('#primary_table tr:nth-child(4) td:nth-child(2)').innerText = data.data.population;
                document.querySelector('#primary_table tr:nth-child(5) td:nth-child(2)').innerText = data.data.price + "{{__('panel.other.real_estate_suffix')}}";
            })
            .catch(error => console.error('Error:', error));
    }

    function loadProgressData(pathId) {
        const container = document.getElementById('progress-container');

        // Clear the container and add a skeleton screen
        container.innerHTML = `
                                <div class="skeleton">
                                    <div class="skeleton-bar mt-4"></div>
                                    <div class="skeleton-bar mt-4"></div>
                                    <div class="skeleton-bar mt-4"></div>
                                    <div class="skeleton-bar mt-4"></div>
                                    <div class="skeleton-bar mt-4"></div>
                                    <!-- Add as many bars as you think represents an average load -->
                                </div>`;

        // Retrieve formData from local storage
        const formData = localStorage.getItem('formData');
        const formDataJson = formData ? JSON.parse(formData) : {};

        fetch('{{config('app.url')}}' + '/api/sustainability-results/' + pathId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                formData: JSON.stringify(formDataJson)
            })
        })
            .then(response => {
                if (!response.ok) {
                    //window.alert(JSON.stringify(response.body));
                }
                return response.json();
            })
            .then(data => {
                updateProgressBar(data.data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                container.innerHTML = `<p>${error.status} -> Error loading data: ${error.message}</p>`;
            });
    }

    function updateProgressBar(data) {
        const container = document.getElementById('progress-container');
        const sustainability = document.getElementById('sustainability-index');
        container.innerHTML = ''; // Clear the spinner
        sustainability.innerHTML = ''; // Clear the spinner

        data.forEach(item => {
            if(item.title == 'Δείκτης Βιωσιμότητας') {
                sustainability.innerHTML = `
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <strong>${item.title}</strong>
                                            <div class="progress">
                                                <div class="progress-bar" style="width:${item.percentage}%">${item.score} / 5</div>
                                            </div>
                                        </div>
                                    </div>
                                `;
            } else {
                container.innerHTML += `
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <strong>${item.title}</strong>
                                            <div class="progress">
                                                <div class="progress-bar" style="width:${item.percentage}%">${item.score} / 5</div>
                                            </div>
                                        </div>
                                    </div>
                                `;
            }
        });
    }


    function submitForm() {
        // Object to hold the data
        var formData = {};

        // Get all checkbox elements
        var checkboxes = document.querySelectorAll('input[type=checkbox]');

        // Iterate over checkboxes to collect data
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                var rangeContainerId = checkbox.id + 'RangeContainer';
                var rangeContainer = document.getElementById(rangeContainerId);

                // Check if the range container exists and has a range input
                if (rangeContainer) {
                    var rangeInput = rangeContainer.querySelector('input[type=range]');
                    var rangeValue = rangeInput ? rangeInput.value : null;

                    // Store the range value or null if no range value is found
                    formData[checkbox.id] = rangeValue ? parseFloat(rangeValue) : null;
                }
            }
        });

        formData['realEstate'] = 1;
        // Convert the formData object to JSON string
        var formDataJson = JSON.stringify(formData);

        // Store in local storage
        localStorage.setItem('formData', formDataJson);

        // Optionally, log to console or alert the user
        console.log('Form Data Saved:', formDataJson);
        showAlertWithMessage('{{__('panel.alerts.choices_saved')}}', 'success');

        // Add any other code here that needs to run when the form is submitted
    }

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


</script>

<script>
    function showRange(checkbox, checkboxId) {
        var containerId = checkboxId + 'RangeContainer';
        var container = document.getElementById(containerId);
        var totalPercentageDiv = document.getElementById('totalPercentage');

        if (checkbox.checked) {
            // Clear existing content in the container
            container.innerHTML = "";

            // Create a range input
            var rangeInput = document.createElement("input");
            rangeInput.type = "range";
            rangeInput.classList.add("custom-range");
            rangeInput.min = 0;
            rangeInput.max = 1;
            rangeInput.step = 0.05;
            rangeInput.value = 0;  // Set initial value to 0

            // Create a span to hold the range's value
            var stepSpan = document.createElement("span");
            stepSpan.textContent = rangeInput.value;  // Display initial value as 0
            stepSpan.style.marginLeft = "5px"; // Adjust the margin as needed

            // Add the range input and step span to the container
            container.appendChild(rangeInput);
            container.appendChild(stepSpan);

            // Update the step span's value dynamically as the range input changes
            rangeInput.addEventListener("input", function () {
                stepSpan.textContent = rangeInput.value;
                updateTotalPercentage();
            });
        } else {
            // Clear the container if the checkbox is unchecked
            container.innerHTML = "";
            updateTotalPercentage(); // Update the percentage when a checkbox is unchecked
        }
    }

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    document.addEventListener('DOMContentLoaded', function() {
        updateTotalPercentage();
    });

    // Assuming you have checkboxes with specific IDs
    var checkboxes = ['pollution', 'criminality', 'realEstate', 'population', 'preSchool', 'primarySchool', 'middleSchool', 'highSchool', 'schoolLaboratoryCenter', 'vocationalHighSchool', 'subway', 'taxi', 'stops', 'stopsDisability', 'kdap', 'kdapDisability', 'elderly', 'rehab', 'coolingArea', 'heatingArea']; // Add more checkbox IDs as needed

    checkboxes.forEach(function(checkboxId) {
        var checkbox = document.getElementById(checkboxId);
        if (checkbox) {
            checkbox.addEventListener('change', function() {
                updateTotalPercentage(); // Update the percentage when a checkbox state changes
            });
        }
    });

    function updateButtonTooltip(button, newTitle) {
        $(button).attr('data-original-title', newTitle)
            .tooltip('dispose') // Dispose the old tooltip
            .tooltip(); // Reinitialize tooltip
    }

    function updateTotalPercentage() {
        var total = 0;
        var ranges = document.querySelectorAll('.custom-range');
        var totalPercentageDiv = document.getElementById('totalPercentage');
        var submitButton = document.getElementById('submitIndexes');

        ranges.forEach(function(range) {
            var checkboxId = range.parentNode.id.replace('RangeContainer', '');
            var checkbox = document.getElementById(checkboxId);
            if (checkbox && checkbox.checked) {
                total += parseFloat(range.value);
            }
        });

        // Calculate the total percentage
        var percentage = Math.round(total * 100);
        totalPercentageDiv.textContent = percentage + '%';
        totalPercentageDiv.style.display = 'block';

        // Update the button state and tooltip based on the total percentage
        var submitButton = document.getElementById('submitIndexes');
        if (submitButton) {
            if (percentage === 100) {
                submitButton.disabled = false;
                updateButtonTooltip(submitButton, "{{__('panel.submit')}}");
                totalPercentageDiv.style.color = 'black';
            } else {
                submitButton.disabled = true;
                var tooltipMessage = percentage > 100 ? "{{__('panel.alerts.index.up_limit')}}" : "{{__('panel.alerts.index.down_limit')}}";
                updateButtonTooltip(submitButton, tooltipMessage);
                totalPercentageDiv.style.color = 'red';
            }
        }
    }

    function resetForm() {
        // Uncheck all checkboxes and remove their corresponding range inputs and text
        var checkboxes = document.querySelectorAll('.custom-control-input');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;

            // Get the ID of the container that holds the range input and text
            var containerId = checkbox.id + 'RangeContainer';
            var container = document.getElementById(containerId);
            if (container) {
                container.innerHTML = ''; // Clear the container, removing the range and its text
            }
        });

        // Clear any text in the totalPercentage div and update the total percentage
        var totalPercentageDiv = document.getElementById('totalPercentage');
        totalPercentageDiv.textContent = '';
        totalPercentageDiv.style.display = 'none';

        // Call updateTotalPercentage to reset submit button state and other related elements
        updateTotalPercentage();

        // Remove the formData from local storage
        localStorage.removeItem('formData');

        // Optionally, log to console or alert the user
        console.log('Local Storage Cleared');
        showAlertWithMessage('{{__('panel.alerts.reset_indexes')}}', 'warning');
    }


    function showAlertWithMessage(message, type, timeout = 6000) {
        var alertDiv = document.getElementById('topAlert');
        var alertMessage = document.getElementById('alertMessage');
        var progressBar = document.getElementById('alertProgressBar');

        // Configure the alert
        alertDiv.classList.remove('alert-primary', 'alert-secondary', 'alert-success', 'alert-danger', 'alert-warning', 'alert-info', 'alert-light', 'alert-dark');
        alertDiv.classList.add('alert-' + type);
        alertMessage.textContent = message;
        progressBar.style.width = '100%'; // Reset progress bar width
        alertDiv.style.display = 'block'; // Show the alert

        // Start the progress bar reduction
        var startTime = Date.now();
        var interval = setInterval(function() {
            var elapsedTime = Date.now() - startTime;
            var width = Math.max(0, 100 - (elapsedTime / timeout) * 100) - 8;
            progressBar.style.width = width + '%';

            if (elapsedTime >= timeout) {
                clearInterval(interval);
                alertDiv.style.display = 'none'; // Hide the alert
            }
        }, 50);
    }

    function fetchDataAndUpdateDivs(pathID) {
        const url = `{{config('app.url')}}/api/municipality-results/${pathID}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Update DIVs
                for (const key in data.data) {
                    if (data.data.hasOwnProperty(key)) {
                        const div = document.getElementById(key);
                        if (div) {
                            // Handle special cases for charts
                            if (key === 'realEstateTotal') {
                                updateChartData(myLineChart, data.data[key]);
                            } else if (key === 'populationGender') {
                                updatePieChart(myPieChart, data.data[key]);
                            } else {
                                // Format and update DIV content as before
                                if (typeof data.data[key] === 'object' && data.data[key].hasOwnProperty('total') && data.data[key].hasOwnProperty('variation')) {
                                    div.textContent = `${data.data[key].total} (${data.data[key].variation}%)`;
                                } else {
                                    div.textContent = data.data[key];
                                }
                            }
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching data: ', error);
            });
    }

    function updatePieChart(chart, newData) {
        chart.data.datasets.forEach((dataset) => {
            dataset.data = [newData.men, newData.women];
        });
        chart.update();
    }

    // The updateChartData function remains the same as previously provided


    function updateChartData(chart, newData) {
        let labels = Object.keys(newData);
        let data = Object.values(newData).map(value => parseFloat(value.replace(/,/g, '')));

        chart.data.labels = labels;
        chart.data.datasets.forEach((dataset) => {
            dataset.data = data;
        });

        chart.update();
    }
</script>

<x-utilities/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
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



    $(document).ready(function() {
        // Check if the modal has been shown before
        if (!localStorage.getItem('modalShown')) {
            $('#entryModal').modal('show');
            // Set a flag in local storage to indicate the modal has been shown
            localStorage.setItem('modalShown', 'true');
        }
    });

</script>

</body>

</html>
