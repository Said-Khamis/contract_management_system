<?php
return [
    'institutions' => [
        'local' => [
                [
                    'name' => 'The United Republic of Tanzania',
                    'abbreviation' => null,
                    'child' => [
                        ['name' => 'Ministry of Mineral', 'abbreviation' => null ],
                        ['name' => "President's Office - Public Service Management and Good Governance", 'abbreviation' => null ],
                        ['name' => 'Ministry of Foreign Affairs and East Africa Cooperation', 'abbreviation' => 'MFAEAC'] ,
                        ['name' => 'Ministry of Constitution and Legal Affairs', 'abbreviation' => null ],
                        ['name' => 'Ministry of Health' , 'abbreviation' => NULL ],
                        ['name' => 'Ministry of Agriculture', 'abbreviation' => null ]
                    ]
                ],

                [
                    'name' => 'Ministry of Health' , 'abbreviation' => NULL,
                    'child' => [
                        ['name' => 'Benjamin Mkapa Hospital', 'abbreviation' => NULL],
                        ['name' => 'Bugando Medical Centre', 'abbreviation' => NULL],
                        ['name' => 'Designated District Hospital', 'abbreviation' => 'DDH'],
                        ['name' => 'Government Chemist Laboratory Authority', 'abbreviation' => 'GCLA'],
                        ['name' => 'Institute od Social Works', 'abbreviation' => 'ISW'],
                        ['name' => 'Jakaya Kikwete Cardiac Institute', 'abbreviation' => 'JKCI'],
                        ['name' => 'Kilimanjaro Christian Medical Centre', 'abbreviation' => 'KCMC'],
                        ['name' => 'Medical Stores Department', 'abbreviation' => 'Msd'],
                        ['name' => 'Muhimbili National Hospital ', 'abbreviation' => 'MNH'],
                        ['name' => 'Muhimbili Orthopaedic Institute', 'abbreviation' => 'MOI'],
                        ['name' => 'National Health Insurance Fund', 'abbreviation' => 'Nhif'],
                        ['name' => 'National Institute for Medical Research', 'abbreviation' => NULL],
                        ['name' => 'Ocean Road Cancer Institute ', 'abbreviation' => 'ORCI'],
                        ['name' => 'Pharmacy Council of Tanzania', 'abbreviation' => 'PCT'],
                        ['name' => 'Tanzania Food and Nutrition Centre', 'abbreviation' => 'TFNC'],
                        ['name' => 'Tanzania Medicine and Medical Devices Authority', 'abbreviation' => 'TMDA'],
                        ['name' => 'Tanzania Nursing and Midwifery Council', 'abbreviation' => NULL],
                        ['name' => 'Voluntary Agency Hospitals', 'abbreviation' => 'VAH']
                    ]
                ],

                [
                    'name' => 'Ministry of Mineral',
                    'abbreviation' => null,
                    'child' => [
                        ['name' => 'State Mining Corporation', 'abbreviation' => 'STAMICO'],
                        ['name' => 'Tanzania Extractive Industries Transparency Initiative', 'abbreviation' => 'Teiti'],
                        ['name' => 'The Geological Survey of Tanzania','abbreviation' => 'GST'],
                        ['name' => 'Mining Commission','abbreviation' => null]
                    ]
                ],

                [
                    'name' => "President's Office - Public Service Management and Good Governance",
                    'abbreviation' => null,
                    'child' => [
                        ['name' => 'National Records And Archives Department','abbreviation' => null],
                        ['name' => 'Public Remuneration Secretariet','abbreviation' => null],
                        ['name' => 'Public Service Commision','abbreviation' => null],
                        ['name' => 'Public Service Recruitment Secretariet','abbreviation' => 'PSRS'],
                        ['name' => 'Tanzania Global Learning Agency','abbreviation' => 'TaGLA'],
                        ['name' => 'Tanzania Public Service Collage','abbreviation' => 'TPSC']
                    ]
                ],

                [
                    'name' => 'Ministry of Foreign Affairs and East Africa Cooperation',
                    'abbreviation' => null,
                    'child' => [

                        ['name' => 'Arusha International Conference Centre','abbreviation' => 'Aicc'],
                        ['name' => 'Tanzania Centre for Foreign Relations','abbreviation' => 'MTCFR']
                    ]
                ],

                [
                    'name' => 'Ministry of Constitution and Legal Affairs',
                    'abbreviation' => null,
                    'child' => [
                        ['name' => 'Commission For Human Rights and Good Governance','abbreviation' => null],
                        ['name' => 'Institute of Judicial Administration','abbreviation' => 'IJA'],
                        ['name' => 'Judiciary Service Commission','abbreviation' => 'JSC'],
                        ['name' => 'Judiciary of Tanzania','abbreviation' => null],
                        ['name' => 'Law Reform Commission','abbreviation' => 'LRC'],
                        ['name' => 'Law School of Tanzania','abbreviation' => 'LST'],
                        ['name' => 'Registration Insolvency and Trusteeship Agency','abbreviation' => 'RITA'],
                        ['name' => 'THE OFFICE OF ATTORNEY GENERAL', 'abbreviation' => 'OAG']
                    ]
                ],

                [
                    'name' => 'Ministry of Agriculture',
                    'abbreviation' => null,
                    'child' => [
                        ['name' => 'Agricultural Input Trust Fund','abbreviation' => 'AGITF'],
                        ['name' => 'Agricultural Seeds Agency','abbreviation' => 'ASA'],
                        ['name' => 'Cereals and Other Produce Board of Tanzania','abbreviation' => 'COPBT']
                    ]
                ]
            ],

        'foreign' =>[
            ['name' => 'Yapi Markezi','abbreviation' => null],
            ['name' => 'DP World', 'abbreviation' => null],
            ['name' => 'Uganda Broadcasting Corporation','abbreviation' => 'UBC'],

        ],
    ],

    'countries' => [
        'tanzania' => [
            'regions' => [
                'arusha' => [
                    'districts' => [
                        'Arumeru'=>[
                            'wards' =>
                                [
                                    'akheri','bangata','bwawani','llkiding a','kikatiti','kikwe','kimnyaki','king ori','kiranyi',
                                    'kisongo','leguruki','maji ya chai','makiba','mororoni','mateves','mbuguni','mlangarini','moivo',
                                    'moshono','murieti','musa','mwandeti','nduruma','ngarenanyuki','nkanrua','nkoaranga','nkoarisambu',
                                    'oldonyosambu','oljoro','olkokola','oltroto','oltrumet','poli','singisi','sokoni II','songoso','USA River',
                                ]
                        ],
                        'Arusha'=>[
                            'wards' =>
                                [
                                    'baraa','daraja mbili','elerae','engutoto','kaloleni','kati','kimandolu','lemara','levolosi','ngarenaro',
                                    'oloirien','sekei ?A?','sokoni','sombetini','terrat','themi-urban ward','unga ltd-urban ward',
                                ]
                        ],
                        'Monduli'=>[
                            'wards' =>
                                [
                                    'elisalei','engarenaibor','engaruka','engutoto','gelai lumbwa','gelai meirugoi','kitumbeine','lolkisale',
                                    'longido','makuyuni','matale','moita','monduli juu','monduli mjini','mto wa mbu','namanga','olmolog','selela',
                                    'sepeko','tingatinga',
                                ]
                        ],
                        'Ngorongoro'=>[
                            'wards' =>
                                [
                                    'arash','digodigo','enduleni','kakesio','malambo','nainokanoka','naiyobi','ngorongoro','olbalbal','oldonyo',
                                    'orgosorok','pinyinyi','sale','soitisambu'
                                ]
                        ],

                    ]
                ],
                'Dar es salaam' => [
                    'districts' => [
                        'Ilala'=>[
                            'wards'=>[
                                'Kariakoo','Jangwani'
                            ]
                        ],
                        'Temeke'=>[
                            'wards'=>[
                                'Chamazi','Charambe'
                            ]
                        ],
                    ]
                ],
                'Dodoma' => [
                    'districts' => [
                        'Bahi'=>[
                            'wards'=>[
                                'Babayu','Bahi','Chali'
                            ],
                        ],
                        'Dodoma'=>[
                            'wards'=>[
                                'Chamwino','Chihanga'
                            ]
                        ]
                    ]
                ],
                'Geita' => [
                    'districts' => [
                        'Geita'=>[
                            'wards'=>[
                                'Bombambili','Buhalahala'
                            ]
                        ],
                        'Bukombe'=>[
                            'wards'=>[
                                'Bukombe','Bulega'
                            ]
                        ]
                    ]
                ],
                'kagera' => [
                    'districts' => [

                    ]
                ],
                'katavi' => [
                    'districts' => [
                        'Mpanda'=>[
                            'wards'=>[
                                'Ilembo','Kakese'
                            ]
                        ]
                    ]
                ],
                'Kigoma' => [
                    'districts' => [
                        'Kigoma'=>[
                            'wards'=>[
                                'Bangwe','Buhanda'
                            ]
                        ]
                    ]
                ],
                'northern pemba' => [
                    'districts' => [
                        'chake chake'=>[
                            'wards'=>[
                                'Chachani', 'Chanjaani', 'Chonga', 'Dodo', 'Kibokoni'
                            ]
                        ],
                        'mkoani'=>[
                            'wards'=>[
                                'Chambani','Changaweni', 'Chokocho', 'Chumbageni', 'Jombwe','Makombeni','Makoongwe','Mbuguani','Mbuyuni', 'Mgagadu','Mkungu','Mtambile','Mtangani','Muambe'
                            ]
                        ]
                    ]
                ],
                'zanzibar central/south' => [
                    'districts' => [
                    ]
                ],
                'zanzibar north' => [
                    'districts' => [

                    ]
                ],
                'zanzibar west' => [
                    'districts' => [
                    ]
                ],
            ],
        ],
        'kenya' => [
            'regions' => [
                'nairobi' => [
                    'districts' => [
                        'Westlands'=>[
                            'wards'=>[
                                'Kitisuru','Parklands','Karura'
                            ]
                        ],
                        'Dagoretti North'=>[
                            'wards'=>[
                                'Kilimani', 'Kawangware','Gatina','Kileleshwa', 'Kabiro'
                            ]
                        ]
                    ]
                ],
            ]
        ],
        'uganda' => [
            'regions' => [
                'kampala' => [
                    'districts' =>[
                        'Kawempe'=>[
                            'wards'=>[
                                'waise I', 'Kanyanya', 'Kazo ward', 'Kyebando', 'Makerere iii', 'Mulago I', 'Bwaise ii', 'Kawempe I', 'Kikaya', 'Makerere I','Mpererwe',
                            ]
                        ],
                        'Lubaga'=>[
                            'wards'=>[
                                'Mutundwe', 'Nateete', 'Ndeeba', 'Kabowa', 'Najjanankumbi', 'Lungujja', 'Busega', 'Lubaga', 'Mengo', 'Namungoona', 'Lubya', 'Lugala', 'Bukesa', 'Namirembe', 'Naakulabye', 'Kasubi','Kawaala'
                            ]
                        ]
                    ]
                ]
            ]
        ],
    ],
    'approval_work_flow_types' => ['checklist' => 'checklist', 'jobcard' => 'jobcard', 'requisition' => 'requisition', 'purchase order' => 'purchase order'],
    'categories' => [
        'contractss' => ['internal contractss','external contractss']
    ],
    'contract_types' => ['Bilateral Agreement' => 'Bilateral Agreement','Memorandum Of Understanding' => 'Memorandum Of Understanding', 'Regional Agreement' => 'Regional Agreement','Multilateral Agreement' => 'Multilateral Agreement'],
    'permissions' => [
        'contractss' => ['manage contractss','create contractss','edit contractss','view contractss','delete contractss'],
        'employees' => ['manage employee','create employee','edit employee','view employee','delete employee'],
        'institutions' => ['manage institution','create institution','edit institution','view institution','delete institution'],
        'locations' => ['manage location','create location','edit location','view location','delete location'],
        'users' => ['manage user','create user','edit user','view user','delete user'],
        'categories' => ['manage category','create category','edit category','view category','delete category'],
        'departments' => ['manage department','create department','edit department','view department','delete department'],
        'settings' => ['manage settings','create settings','edit settings','view settings','delete settings'],
        'approvals' => ['manage approval','create approval','edit approval','view approval','delete approval'],
    ],
    'sectors' => array(
        array('id' => '1','name' => 'Education','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-22 12:57:44','updated_at' => '2023-11-22 12:57:44','deleted_at' => NULL),
        array('id' => '2','name' => 'Health','description' => '','created_by' => '1','updated_by' => '1','created_at' => '2023-11-22 12:57:55','updated_at' => '2023-11-22 12:57:55','deleted_at' => NULL),
        array('id' => '3','name' => 'Agriculture','description' => '','created_by' => '1','updated_by' => '1','created_at' => '2023-11-22 12:58:06','updated_at' => '2023-11-22 12:58:06','deleted_at' => NULL),
        array('id' => '4','name' => 'Tourism','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:28:55','updated_at' => '2023-11-23 07:28:55','deleted_at' => NULL),
        array('id' => '5','name' => 'Mining','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:29:22','updated_at' => '2023-11-23 07:29:22','deleted_at' => NULL),
        array('id' => '6','name' => 'Finance','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:29:31','updated_at' => '2023-11-23 07:29:31','deleted_at' => NULL),
        array('id' => '7','name' => 'Fishing','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:29:40','updated_at' => '2023-11-23 07:29:40','deleted_at' => NULL),
        array('id' => '8','name' => 'Construction','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:29:51','updated_at' => '2023-11-23 07:29:51','deleted_at' => NULL),
        array('id' => '9','name' => 'Industry','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:32:09','updated_at' => '2023-11-23 07:32:09','deleted_at' => NULL),
        array('id' => '10','name' => 'Services','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:32:22','updated_at' => '2023-11-23 07:32:22','deleted_at' => NULL),
        array('id' => '11','name' => 'Petroleum and gas','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:36:17','updated_at' => '2023-11-23 07:36:17','deleted_at' => NULL),
        array('id' => '12','name' => 'Transportation','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:36:54','updated_at' => '2023-11-23 07:36:54','deleted_at' => NULL),
        array('id' => '13','name' => 'Telecommunications','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:37:02','updated_at' => '2023-11-23 07:37:02','deleted_at' => NULL),
        array('id' => '14','name' => 'international relations','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:46:48','updated_at' => '2023-11-23 07:46:48','deleted_at' => NULL),
        array('id' => '15','name' => 'Justice','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:54:05','updated_at' => '2023-11-23 07:54:05','deleted_at' => NULL),
        array('id' => '16','name' => 'Governance and Human rights','description' => NULL,'created_by' => '1','updated_by' => '1','created_at' => '2023-11-23 07:55:13','updated_at' => '2023-11-23 07:55:13','deleted_at' => NULL)
    )
];
