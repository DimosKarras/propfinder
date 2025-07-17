<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('panel', ['locale' => App::getLocale()]) }}">
        <div class="sidebar-brand-icon"> <!-- 'rotate-n-15' if you want to rotate the icon -->
            <img src="{{asset('panel-assets/img/dark/logo001.png')}}" alt="small_logo" style="width:auto; height:60px;">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item mx-3" id="welcomeText">
        <p>{{__('panel.sidebar.welcome')}}</p>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider" id="welcomeTextDivider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{__('panel.sidebar.filters')}}
    </div>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item" style="z-index: 199;">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseIndexes"
           aria-expanded="true" aria-controls="collapseIndexes">
            <i class="fas fa-fw fa-filter"></i>
            <span>{{__('panel.sidebar.indexes_header')}}</span>
        </a>
        <div id="collapseIndexes" class="collapse" aria-labelledby="collapseIndexes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="collapse-header">{{__('panel.sidebar.indexes_header')}}<i class="fas fa-info-circle ml-1" id="indexesBarInfo" data-popover="indexesBarPopover"></i></h6>
                    <!-- Popover -->
                    <div class="myPopover small" id="indexesBarPopover">
                        {{__('panel.sidebar.popover.indexes')}}
                    </div>
                    <a class="btn btn-link btn-sm" id="resetButton" onclick="resetForm()">
                        <i class="fas fa-fw fa-undo"></i>
                    </a>
                </div>
                <form class="user">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small mx-3" id="populationContainer">
                            <input type="checkbox" id="population" name="population" value="population" class="custom-control-input" onchange="showRange(this, 'population')">
                            <label class="custom-control-label" for="population">{{__('panel.sidebar.indexes_values.population')}}</label><i class="fas fa-info-circle ml-1" id="populationBarInfo" data-popover="populationBarPopover"></i>
                            <!-- Popover -->
                            <div class="myPopover" id="populationBarPopover">
                                {{__('panel.sidebar.popover.population')}}
                            </div>
                            <div id="populationRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3 bold" id="criminalityContainer">
                            <input type="checkbox" id="criminality" name="criminality" value="criminality" class="custom-control-input" onchange="showRange(this, 'criminality')">
                            <label class="custom-control-label" for="criminality">{{__('panel.sidebar.indexes_values.criminality')}}</label><i class="fas fa-info-circle ml-1" id="criminalityBarInfo" data-popover="criminalityBarPopover"></i>
                            <!-- Popover -->
                            <div class="myPopover" id="criminalityBarPopover">
                                {{__('panel.sidebar.popover.criminality')}}
                            </div>
                            <div id="criminalityRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3 bold" id="pollutionContainer">
                            <input type="checkbox" id="pollution" name="pollution" value="pollution" class="custom-control-input" onchange="showRange(this, 'pollution')">
                            <label class="custom-control-label" for="pollution">{{__('panel.sidebar.indexes_values.air_pollution')}}</label><i class="fas fa-info-circle ml-1" id="pollutionInfo" data-popover="pollutionPopover"></i>
                            <!-- Popover -->
                            <div class="myPopover" id="pollutionPopover">
                                {{__('panel.sidebar.popover.pollution')}}
                            </div>
                            <div id="pollutionRangeContainer"></div>
                        </div>
                        <hr>
                        <h6 class="collapse-header text-center">{{__('panel.sidebar.headers.education')}}<i class="fas fa-info-circle ml-1" id="educationInfo" data-popover="educationPopover"></i></h6>
                        <!-- Popover -->
                        <div class="myPopover small mx-3" id="educationPopover">
                            {{__('panel.sidebar.popover.education')}}
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="preSchoolContainer">
                            <input type="checkbox" id="preSchool" name="preSchool" value="preSchool" class="custom-control-input" onchange="showRange(this, 'preSchool')">
                            <label class="custom-control-label" for="preSchool">{{__('panel.sidebar.indexes_values.preschools')}}</label>
                            <div id="preSchoolRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="primarySchoolContainer">
                            <input type="checkbox" id="primarySchool" name="primarySchool" value="primarySchool" class="custom-control-input" onchange="showRange(this, 'primarySchool')">
                            <label class="custom-control-label" for="primarySchool">{{__('panel.sidebar.indexes_values.primary_schools')}}</label>
                            <div id="primarySchoolRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="middleSchoolContainer">
                            <input type="checkbox" id="middleSchool" name="middleSchool" value="middleSchool" class="custom-control-input" onchange="showRange(this, 'middleSchool')">
                            <label class="custom-control-label" for="middleSchool">{{__('panel.sidebar.indexes_values.middle_schools')}}</label>
                            <div id="middleSchoolRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="highSchoolContainer">
                            <input type="checkbox" id="highSchool" name="highSchool" value="highSchool" class="custom-control-input" onchange="showRange(this, 'highSchool')">
                            <label class="custom-control-label" for="highSchool">{{__('panel.sidebar.indexes_values.high_schools')}}</label>
                            <div id="highSchoolRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="vocationalHighSchoolContainer">
                            <input type="checkbox" id="vocationalHighSchool" name="vocationalHighSchool" value="vocationalHighSchool" class="custom-control-input" onchange="showRange(this, 'vocationalHighSchool')">
                            <label class="custom-control-label" for="vocationalHighSchool">{{__('panel.sidebar.indexes_values.vocational_high_schools')}}</label>
                            <div id="vocationalHighSchoolRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="schoolLaboratoryCenterContainer">
                            <input type="checkbox" id="schoolLaboratoryCenter" name="schoolLaboratoryCenter" value="schoolLaboratoryCenter" class="custom-control-input" onchange="showRange(this, 'schoolLaboratoryCenter')">
                            <label class="custom-control-label" for="schoolLaboratoryCenter">{{__('panel.sidebar.indexes_values.laboratory_centers')}}</label>
                            <div id="schoolLaboratoryCenterRangeContainer"></div>
                        </div>
                        <hr>
                        <h6 class="collapse-header text-center">{{__('panel.sidebar.headers.transportation')}}<i class="fas fa-info-circle ml-1" id="transportationInfo" data-popover="transportationPopover"></i></h6>
                        <!-- Popover -->
                        <div class="myPopover small mx-3" id="transportationPopover">
                            {{__('panel.sidebar.popover.transportation')}}
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="subwayContainer">
                            <input type="checkbox" id="subway" name="subway" value="subway" class="custom-control-input" onchange="showRange(this, 'subway')">
                            <label class="custom-control-label" for="subway">{{__('panel.sidebar.indexes_values.subway_stops')}}</label>
                            <div id="subwayRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="taxiContainer">
                            <input type="checkbox" id="taxi" name="taxi" value="taxi" class="custom-control-input" onchange="showRange(this, 'taxi')">
                            <label class="custom-control-label" for="taxi">{{__('panel.sidebar.indexes_values.taxi_stands')}}</label>
                            <div id="taxiRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="stopsContainer">
                            <input type="checkbox" id="stops" name="stops" value="stops" class="custom-control-input" onchange="showRange(this, 'stops')">
                            <label class="custom-control-label" for="stops">{{__('panel.sidebar.indexes_values.bus_stops')}}</label>
                            <div id="stopsRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="stopsDisabilityContainer">
                            <input type="checkbox" id="stopsDisability" name="stopsDisability" value="stopsDisability" class="custom-control-input" onchange="showRange(this, 'stopsDisability')">
                            <label class="custom-control-label" for="stopsDisability">{{__('panel.sidebar.indexes_values.bus_disability_stops')}}</label>
                            <div id="stopsDisabilityRangeContainer"></div>
                        </div>
                        <hr>
                        <h6 class="collapse-header text-center">{{__('panel.sidebar.headers.other')}}<i class="fas fa-info-circle ml-1" id="otherInfo" data-popover="otherPopover"></i></h6>
                        <!-- Popover -->
                        <div class="myPopover small mx-3" id="otherPopover">
                            {{__('panel.sidebar.popover.other')}}
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="coolingAreaContainer">
                            <input type="checkbox" id="coolingArea" name="coolingArea" value="coolingArea" class="custom-control-input" onchange="showRange(this, 'coolingArea')">
                            <label class="custom-control-label" for="coolingArea">{{__('panel.sidebar.indexes_values.cooling_areas')}}</label>
                            <div id="coolingAreaRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="heatingAreaContainer">
                            <input type="checkbox" id="heatingArea" name="heatingArea" value="heatingArea" class="custom-control-input" onchange="showRange(this, 'heatingArea')">
                            <label class="custom-control-label" for="heatingArea">{{__('panel.sidebar.indexes_values.heating_areas')}}</label>
                            <div id="heatingAreaRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="elderlyContainer">
                            <input type="checkbox" id="elderly" name="elderly" value="elderly" class="custom-control-input" onchange="showRange(this, 'elderly')">
                            <label class="custom-control-label" for="elderly">{{__('panel.sidebar.indexes_values.elderly_care_centers')}}</label>
                            <div id="elderlyRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="rehabContainer">
                            <input type="checkbox" id="rehab" name="rehab" value="rehab" class="custom-control-input" onchange="showRange(this, 'rehab')">
                            <label class="custom-control-label" for="rehab">{{__('panel.sidebar.indexes_values.rehab_centers')}}</label>
                            <div id="rehabRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="kdapContainer">
                            <input type="checkbox" id="kdap" name="kdap" value="kdap" class="custom-control-input" onchange="showRange(this, 'kdap')">
                            <label class="custom-control-label" for="kdap">{{__('panel.sidebar.indexes_values.kdap')}}</label>
                            <div id="kdapRangeContainer"></div>
                        </div>
                        <div class="custom-control custom-checkbox small mx-3" id="kdapDisabilityContainer">
                            <input type="checkbox" id="kdapDisability" name="kdapDisability" value="kdapDisability" class="custom-control-input" onchange="showRange(this, 'kdapDisability')">
                            <label class="custom-control-label" for="kdapDisability">{{__('panel.sidebar.indexes_values.kdap_disability')}}</label>
                            <div id="kdapDisabilityRangeContainer"></div>
                        </div>
                        <hr>
                    </div>
                </form>
                <!-- Element to display total percentage -->
                <div id="totalPercentage" class="form-group text-center mb-3"></div>
                <!-- Add this div as your submit button -->
                <div class="form-group d-flex justify-content-center mx-3">
                    <button class="btn btn-primary btn-sm btn-block" id="submitIndexes" onclick="submitForm()" data-toggle="tooltip" title="The index weights must not surpass 100%">{{__('panel.submit')}}</button>
                </div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{__('panel.sidebar.more_header')}}
    </div>

    <!-- Nav Item - Initial Modal -->
    <li class="nav-item">
        <a class="nav-link" type="button" data-toggle="modal" data-target="#entryModal">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>{{__('panel.sidebar.about')}}</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('analytics')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>{{__('panel.sidebar.aggregated_data')}}</span></a>
    </li>

    <!-- Nav Item - API Calls -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('apis')}}">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>APIs</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<script>
    function toggleMenuImage() {
        var image = document.querySelector('.sidebar-brand-icon img');
        var welcomeText = document.getElementById('welcomeText');
        var welcomeTextDivider = document.getElementById('welcomeTextDivider');

        // Toggle the image source
        if (image.src.includes('logo001.png')) {
            image.src = '{{asset('panel-assets/img/dark/logo002.png')}}';
        } else {
            image.src = '{{asset('panel-assets/img/dark/logo001.png')}}';
        }

        // Toggle the visibility of the text and the divider
        welcomeText.style.display = welcomeText.style.display === 'none' ? '' : 'none';
        welcomeTextDivider.style.display = welcomeTextDivider.style.display === 'none' ? '' : 'none';
    }

    document.getElementById('sidebarToggle').addEventListener('click', toggleMenuImage);

    /* -------------------------------------------------------------------------------------------------------- */
    function checkWidthAndChangeLogo() {
        var image = document.querySelector('.sidebar-brand-icon img');
        var welcomeText = document.getElementById('welcomeText');
        var welcomeTextDivider = document.getElementById('welcomeTextDivider');
        var mdBreakpoint = 768; // Bootstrap 4 md breakpoint

        if (window.innerWidth < mdBreakpoint) {
            image.src = '{{asset('panel-assets/img/dark/logo002.png')}}';
            welcomeText.style.display = 'none';
            welcomeTextDivider.style.display = 'none';
        } else {
            image.src = '{{asset('panel-assets/img/dark/logo001.png')}}';
            welcomeText.style.display = '';
            welcomeTextDivider.style.display = '';
        }
    }

    // Run the function on window resize and on initial load
    window.addEventListener('resize', checkWidthAndChangeLogo);
    window.addEventListener('DOMContentLoaded', checkWidthAndChangeLogo);
</script>
