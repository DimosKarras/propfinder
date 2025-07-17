<?php

return [
    'accessibility' => [
        'increase_size' => 'Increase Font Size',
        'reduce_size' => 'Reduce Font Size',
        'high_contrast' => 'High Contrast',
    ],
    'dashboard' => 'Dashboard',
    'download_image' => 'Download as image',
    'main_data_title' => 'Main data',
    'main_data_values' => [
        'municipality' => 'Municipality',
        'section' => 'Section',
        'area' => 'Area (km²)',
        'population' => 'Population (2021)',
        'real_estate_price' => 'Real Estate Price (2023)'
    ],
    'indexes_title' => 'Indexes',
    'indexes_info' => 'Here, all the results of the selected indexes are displayed. The results of the indexes, including the final sustainability index, are measured from 0 (lowest value) to 5 (highest value).',
    'general_info_header' => 'General Info',
    'general_info_values' => [
        'population_sum_header' => 'TOTAL POPULATION OF METROPOLITAN AREA OF ATHENS (2021)',
        'population_sum_info' => 'The total population of metropolitan area of Athens according to the last census (2021) and the rate of change compared to the previous census.',
        'municipality_density_header' => 'MUNICIPALITY\'S POPULATION DENSITY (PEOPLE/KM²)',
        'criminality_header' => 'Crimes in Attica (2019)',
        'criminality_info' => 'Total criminal actions that took place in Attica in 2019 and their change compared to the last data recordings in 2010. (Warning! The Criminality data refer to the whole region of Attica and not to its Municipalities.)'
    ],
    'real_estate_header' => 'Real Estate',
    'population_header' => 'Population',
    'population_values' => [
        'men' => 'Men',
        'women' => 'Women'
    ],
    'transportation_header' => 'Means of public transportation',
    'transportation_values' => [
        'subway_header' => 'SUBWAY STOPS',
        'bus_header' => 'BUS STOPS',
        'bus_disability_header' => 'BUS STOPS WITH A BAR (FOR PEOPLE WITH DISABILITIES)',
        'taxi_header' => 'TAXI STANDS'
    ],
    'education_header' => 'Education (Schools)',
    'education_values' => [
        'nursery_school_header' => 'PRESCHOOLS',
        'primary_school_header' => 'PRIMARY SCHOOLS',
        'middle_school_header' => 'MIDDLE SCHOOLS',
        'high_school_header' => 'HIGH SCHOOLS',
        'vocational_high_school_header' => 'VOCATIONAL HIGH SCHOOLS',
        'laboratory_center_header' => 'LABORATORY CENTERS'
    ],
    'pollution_header' => 'Air pollution (2022)',
    'pollution_values' => [
        'ozone_header' => 'OZONE (O₃)',
        'nitrogen_dioxide_header' => 'NITROGEN DIOXIDE (NO₂)',
        'sulfur_dioxide_header' => 'SULFUR DIOXIDE (SO₂)',
        'particulate_matter_25_header' => 'PARTICULATE MATTER 2.5 (PM2.5)',
        'particulate_matter_10_header' => 'PARTICULATE MATTER 10 (PM10)',
    ],
    'alerts' => [
        'no_index_selected' => 'There are no selected indicators! Go to FILTERS (Indexes) and fill in the indexes.',
        'choices_saved' => 'The options were saved successfully! Select a municipality to see the results.',
        'index' => [
            'up_limit' => 'The weight of the indexes should not exceed 100%.',
            'down_limit' => 'The percentage must be 100%.'
        ],
        'reset_indexes' => 'The deletion of the indexes was successful!'
    ],
    'other' => [
        'real_estate_suffix' => '€/cm²'
    ],
    'submit' => 'Submit',
    'sidebar' => [
        'welcome' => 'Welcome to propFinder app.',
        'filters' => 'FILTERS',
        'indexes_header' => 'Indexes',
        'indexes_values' => [
            'population' => 'POPULATION',
            'criminality' => 'CRIMINALITY',
            'air_pollution' => 'AIR POLLUTION',
            'preschools' => 'PRESCHOOLS',
            'primary_schools' => 'PRIMARY SCHOOLS',
            'middle_schools' => 'MIDDLE SCHOOLS',
            'high_schools' => 'HIGH SCHOOLS',
            'vocational_high_schools' => 'VOCATIONAL HIGH SCHOOLS',
            'laboratory_centers' => 'LABORATORY CENTERS',
            'subway_stops' => 'SUBWAY STOPS',
            'taxi_stands' => 'TAXI STANDS',
            'bus_stops' => 'BUS STOPS',
            'bus_disability_stops' => 'BUS STOPS WITH BAR (DISABLED PEOPLE)',
            'cooling_areas' => 'PUBLIC COOLING AREAS',
            'heating_areas' => 'PUBLIC HEATING AREAS',
            'elderly_care_centers' => 'CARE CENTERS FOR THE ELDERLY',
            'rehab_centers' => 'RESTORATION - REHABILITATION CENTERS',
            'kdap' => 'CENTER OF CREATIVE ACTIVITIES FOR CHILDREN',
            'kdap_disability' => 'CENTER OF CREATIVE ACTIVITIES FOR DISABLED CHILDREN'
        ],
        'aggregated_data' => 'Aggregated Data',
        'more_header' => 'MORE',
        'about' => 'About the application',
        'headers' => [
            'education' => 'Education',
            'transportation' => 'Means of Transport',
            'other' => 'Other'
        ],
        'popover' => [
            'indexes' => 'Here, you can select the indicators you want to include with their weights to calculate the final sustainability index. The total sum of all weights must be equal to 1. (Warning! If you choose an indicator with a weight of 0, you will be able to see the result of this indicator but it will not be included in the calculation of the final sustainability index).',
            'population' => 'This index returns the result of the population density (People / Municipality area) for each Municipality.',
            'criminality' => 'This index returns the result for the criminality level in a Municipality. (Note! The open data provided cover the entire region of Attica, so the result for each Municipality will be the same for this index.)',
            'pollution' => 'This index returns the result for the atmospheric pollution of the Municipality. (Note! The open data provided are only for 6 Municipalities in the metropolitan area of Athens.)',
            'education' => 'The following indexes are related to the education sector. They return the result of the quantity of educational units a Municipality has in relation to the population density of that Municipality.',
            'transportation' => 'The following indexes are related to the Public Transportation sector. They return the result of the quantity of stops existing in a Municipality in relation to its population density.',
            'other' => 'The following indexes mainly concern spaces, services, and points of interest a Municipality has. The results returned by the indicators are the quantity of spaces, services, or points of interest a Municipality has, in relation to its population density.'
        ]
    ],
    'modal' => [
        'title' => 'Welcome to propFinder application!',
        'body' => [
            'header' => 'With few clicks you can see thorough information about the municipalities of metropolitan city of Athens.',
            'instructions' => 'Instructions',
            'note' => 'Note',
            'first_instruction' => 'Go to the sidebar and click on the Indexes. There you will find all the indexes you want to consider, so you can personalise your final sustainability index.',
            'first_instruction_note' => 'Each index must have a weight you choose for the final results. The combined (final) weight must not exceed the 1.0!',
            'second_instruction' => 'Submit your choices',
            'second_instruction_note' => 'You can reset your choices by clicking the reset button on the indexes.',
            'third_instruction' => 'Click on a municipality on the map, so you can see the final results.',
            'third_instruction_note' => 'For better performance and view the application needs to be on a big screen. So if you use mobile better rotate your screen horizontally!',
        ],
        'close' => 'Close'
    ],
    'languages' => 'LANGUAGES',
];
