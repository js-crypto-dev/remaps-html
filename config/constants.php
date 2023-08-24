<?php

return [
    'langs' => [
        'en'=> 'English',
        'fr'=> 'French',
        'es'=> 'Spanish',
        'pt'=> 'Portuguese',
        'it'=> 'Italian',
        'ja'=> 'Japanese',
        'nl'=> 'Dutch',
        'pl'=> 'Polish',
        'de'=> 'German',
        'ru'=> 'Russian',
        'tr'=> 'Turkish'
    ],
    'emails'=>[
        'customer-welcome-email'=>'Customer welcome email',
        'file-service-opened-email'=>'File service is opened',
        'new-file-service-created-email'=>'New file service email',
        'file-service-modified-email'=>'File service modified/completed',
        'file-service-processed-email'=>'File service processed',
        'new-subscription-email'=>'New subscription email',
        'subscription-cancelled'=>'Subscription cancelled',
        'payment-completed'=>'Payment completed',
        'payment-denied'=>'Payment denied',
        'payment-pending'=>'Payment pending',
        'new-ticket-created'=>'New ticket',
        'new-file-ticket-created'=>'Reply to Your ticket',
        'reply-to-your-ticket' =>'Ticket Reply',
        'customer-activate-email' =>'Company  Registration Activate',
        'new-company-apply'=>'New Company apply',
        'file-service-upload-limited'=>'File Service Upload Limited',
        'staff-job-assigned'=>'Job assigned for staff',
        'new-notification'=>'New Notification Email',
        'shoporder-processed'=>'Shop order is processed',
        'shoporder-dispatched'=>'Shop order is dispatched',
        'shoporder-delivered'=>'Shop order is delivered',
        'car-data-text' => 'Car Data Description',
        'api-welcome-email' => 'API Customer welcome email',
        'api-reset-email' => 'Reset api user password'
    ],

    'currency_sign'=>'£',

    'currency_signs' => [
        'AUD' => '$',
        'BRL' => 'R$',
        'CAD' => '$',
        'CNY' => '¥',
        'CZK' => 'Kč',
        'DKK' => 'kr',
        'EUR' => '€',
        'HKD' => 'HK$',
        'HUF' => 'ft',
        'ILS' => '₪',
        'JPY' => '¥',
        'MYR' => 'RM',
        'MXN' => '$',
        'TWD' => '$',
        'NZD' => '$',
        'NOK' => 'kr',
        'PHP' => '₱',
        'PLN' => 'zł',
        'GBP' => '£',
        'RUB' => '₽',
        'SGD' => '$',
        'SEK' => 'kr',
        'CHF' => 'CHF',
        'THB' => '฿',
        'USD' => '$',
    ],

    'currencies' => [
        'AUD' => 'AUD',
        'BRL' => 'BRL',
        'CAD' => 'CAD',
        'CNY' => 'CNY',
        'CZK' => 'CZK',
        'DKK' => 'DKK',
        'EUR' => 'EUR',
        'HKD' => 'HKD',
        'HUF' => 'HUF',
        'ILS' => 'ILS',
        'JPY' => 'JPY',
        'MYR' => 'MYR',
        'MXN' => 'MXN',
        'TWD' => 'TWD',
        'NZD' => 'NZD',
        'NOK' => 'NOK',
        'PHP' => 'PHP',
        'PLN' => 'PLN',
        'GBP' => 'GBP',
        'RUB' => 'RUB',
        'SGD' => 'SGD',
        'SEK' => 'SEK',
        'CHF' => 'CHF',
        'THB' => 'THB',
        'USD' => 'USD',
    ],

    'order_status'=>[
        'completed'=>'Completed',
        'cancelled'=>'Pending',
    ],

    'transaction_status'=>[
        'pending'=>'Pending',
        'completed'=>'Completed',
    ],

    'transaction_type'=>[
        'A'=>'Give (+)',
        'S'=>'Take (-)',
    ],

    'file_service_staus'=>[
        'P'=>'Out of Hours',
        'O'=>'Open',
        'W'=>'Waiting',
        'C'=>'Completed',
    ],

    'file_service_gearbox'=>[
        1=>'5 Speed',
        2=>'6 Speed',
        15=>'7 Speed',
        3=>'Automatic Transmission',
        13=>'CVT',
        4=>'DSG',
        5=>'DSG6',
        6=>'DSG7',
        7=>'DKG',
        8=>'DCT',
        9=>'SMG',
        10=>'SMG2',
        14=>'SMG3',
        11=>'Tiptronic',
        12=>'Multitronic',
    ],

    'file_service_fuel_type'=>[
        'Diesel'=>'Diesel',
        'Petrol'=>'Petrol / benzine',
        'Petrol91'=>'Petrol / benzine 91 RON',
        'Petrol94'=>'Petrol / benzine 94 RON',
        'Petrol95'=>'Petrol / benzine 95 RON',
        'Petrol99'=>'Petrol / benzine 99 RON',
        'Petrol100'=>'Petrol / benzine 100 RON',
        'Petrol102'=>'Petrol / benzine 102 RON',
    ],

    'file_service_reading_tool' => [
        'Alientech_Kess' => 'Alientech Kess V2',
        'Alientech_Kess V3' => 'Alientech Kess V3',
        'Alientech_KTAG' => 'Alientech KTAG',
        'Alientech_Powergate' => 'Alientech Powergate',
        'Autotuner_Bench' => 'Autotuner Bench',
        'Autotuner_Bootmode' => 'Autotuner Bootmode',
        'Autotuner_OBD' => 'Autotuner OBD',
        'bFlash_Bench' => 'bFlash Bench',
        'bFlash_BOOT' => 'bFlash BOOT',
        'bFlash_OBD' => 'bFlash OBD',
        'Bitbox' => 'Bitbox',
        'BS_OBD' => 'BS OBD',
        'BS_toolbox' => 'BS toolbox',
        'BS_Tricore_Boottool' => 'BS Tricore Boottool',
        'CMD_BDM' => 'CMD BDM',
        'CMD_Bench' => 'CMD Bench',
        'CMD_OBD' => 'CMD OBD',
        'CMD_Tricore_Boottool' => 'CMD Tricore Boottool',
        'Dimsport_Genius' => 'Dimsport Genius',
        'Dimsport_New_Trasdata' => 'Dimsport New Trasdata',
        'Eprom_programmer' => 'Eprom programmer',
        'EVC_BDM' => 'EVC BDM',
        'EVC_BSL' => 'EVC BSL',
        'Femto(Bmw_tool)' => 'Femto (Bmw tool)',
        'FGtech' => 'FGtech',
        'Frieling_i-Boot' => 'Frieling i-Boot',
        'Frieling_i-Flash' => 'Frieling i-Flash',
        'Frieling_SPI_Wizard' => 'Frieling SPI Wizard',
        'Galetto' => 'Galetto',
        'Hptuners' => 'Hptuners',
        'Magic_Motorsport_MAGPRO_Bench_FLex' => 'Magic Motorsport MAGPRO Bench/FLex',
        'Magic_Motorsport_MAGPRO_Bootmode' => 'Magic Motorsport MAGPRO Bootmode',
        'Magic_Motorsport_MAGPRO_OBD' => 'Magic Motorsport MAGPRO OBD',
        'MPPS' => 'MPPS',
        'NKLAB_EK1' => 'NKLAB EK1',
        'PCM-Flash' => 'PCM-Flash',
        'Pemicro_Nexus_Debugger' => 'Pemicro Nexus Debugger',
        'Piasini_Serial_Suite' => 'Piasini Serial Suite',
    ],

    'package_billing_interval'=>[
        'Day'=>'Daily',
        'Week'=>'Weekly',
        'Month'=>'Monthly',
        'Year'=>'Yearly',
    ],

    'paypal_mode'=>[
        'sandbox'=>'Sandbox',
        'live'=>'Live'
    ],
];
