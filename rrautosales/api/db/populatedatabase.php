<?php

    //include the database connection file
    include("db.php");

    //Hold the name of the data source file in a variable for later use
    $file = "vehicles.csv";

    //Open the file and keep its contents in a variable
    $filepath = fopen($file, "r");

    //Counter used when populating the vehicles table. The number is printed in the success message and then incremented so that a final count can be given at the end.
    $count = 1;

    //Set up the database according to the ER diagram

    try{
        $conn->begin_transaction();

        //Create Condition Table
        $conn->query("CREATE TABLE `ASSIGNMENT_condition` (
            `condition_id` int(11) NOT NULL,
            `condition_desc` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Condition Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_condition`
            ADD PRIMARY KEY (`condition_id`);"
        );

        //Populate Condition Table
        $conn->query("INSERT INTO `ASSIGNMENT_condition` (`condition_id`, `condition_desc`) VALUES
            (0, 'unknown'),
            (1, 'new'),
            (2, 'like new'),
            (3, 'excellent'),
            (4, 'good'),
            (5, 'fair'),
            (6, 'salvage');"
        );

        //Create Cylinders Table
        $conn->query("CREATE TABLE `ASSIGNMENT_cylinders` (
            `cylinder_id` int(11) NOT NULL,
            `cylinders` varchar(255) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Cylinders Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_cylinders`
            ADD PRIMARY KEY (`cylinder_id`);"
        );

        //Populate Cylinders Table
        $conn->query("INSERT INTO `ASSIGNMENT_cylinders` (`cylinder_id`, `cylinders`) VALUES
            (0, 'unknown'),
            (1, '3'),
            (2, '4'),
            (3, '5'),
            (4, '6'),
            (5, '8'),
            (6, '10'),
            (7, '12'),
            (8, 'other');"
        );

        //Create Delivery Methods Table
        $conn->query("CREATE TABLE `ASSIGNMENT_delivery_methods` (
            `delivery_method_id` int(11) NOT NULL,
            `delivery_method` varchar(255) NOT NULL,
            `delivery_cost` int(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Delivery Methods Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_delivery_methods`
            ADD PRIMARY KEY (`delivery_method_id`);"
        );

        //Populate Delivery Methods Table
        $conn->query("INSERT INTO `ASSIGNMENT_delivery_methods` (`delivery_method_id`, `delivery_method`, `delivery_cost`) VALUES
            (1, 'Standard Delivery', 500),
            (2, 'One Week Delivery', 800),
            (3, 'Next Day Delivery', 1500);"
        );

        //Create Drive Type Table
        $conn->query("CREATE TABLE `ASSIGNMENT_drive_type` (
            `drive_type_id` int(11) NOT NULL,
            `drive_type` varchar(255) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Drive Type Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_drive_type`
            ADD PRIMARY KEY (`drive_type_id`);"
        );

        //Populate Drive Type Table
        $conn->query("INSERT INTO `ASSIGNMENT_drive_type` (`drive_type_id`, `drive_type`) VALUES
            (0, 'unknown'),
            (1, '4wd'),
            (2, 'fwd'),
            (3, 'rwd');"
        );

        //Create Fuel Type Table
        $conn->query("CREATE TABLE `ASSIGNMENT_fuel_type` (
            `fuel_id` int(11) NOT NULL,
            `fuel_type` varchar(255) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Fuel Type Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_fuel_type`
            ADD PRIMARY KEY (`fuel_id`);"
        );

        //Populate Fuel Type Table
        $conn->query("INSERT INTO `ASSIGNMENT_fuel_type` (`fuel_id`, `fuel_type`) VALUES
            (0, 'unknown'),
            (1, 'diesel'),
            (2, 'electric'),
            (3, 'gas'),
            (4, 'hybrid'),
            (5, 'other');"
        );

        //Create Manufacturer Table
        $conn->query("CREATE TABLE `ASSIGNMENT_manufacturer` (
            `manufacturer_id` int(11) NOT NULL,
            `manu_name` varchar(255) NOT NULL,
            `manu_logo_url` varchar(255) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Manufacturer Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_manufacturer`
            ADD PRIMARY KEY (`manufacturer_id`);"
        );

        //Populate Manufacturer Table
        $conn->query("INSERT INTO `ASSIGNMENT_manufacturer` (`manufacturer_id`, `manu_name`, `manu_logo_url`) VALUES
            (0, 'unknown', 'unknown'),
            (1, 'acura', 'https://www.carlogos.org/logo/Acura-logo-1990-1024x768.png'),
            (2, 'audi', 'https://www.carlogos.org/logo/Audi-logo-2009-1920x1080.png'),
            (3, 'bmw', 'https://www.carlogos.org/car-logos/bmw-logo-1997-1200x1200.png'),
            (4, 'buick', 'https://www.carlogos.org/logo/Buick-logo-2002-2560x1440.png'),
            (5, 'cadillac', 'https://www.carlogos.org/logo/Cadillac-logo-2014-1920x1080.png'),
            (6, 'chevrolet', 'https://www.carlogos.org/logo/Chevrolet-logo-2013-2560x1440.png'),
            (7, 'chrysler', 'https://www.carlogos.org/logo/Chrysler-logo-1998-1920x1080.png'),
            (8, 'datsun', 'https://www.carlogos.org/logo/Datsun-logo-2013-2560x1440.png'),
            (9, 'dodge', 'https://www.carlogos.org/logo/Dodge-logo-2011-3840x2160.png'),
            (10, 'fiat', 'https://www.carlogos.org/logo/Fiat-logo-2006-1920x1080.png'),
            (11, 'ford', 'https://www.carlogos.org/car-logos/ford-logo-2017.png'),
            (12, 'gmc', 'https://www.carlogos.org/logo/GMC-logo-2200x600.png'),
            (13, 'honda', 'https://www.carlogos.org/car-logos/honda-logo-1700x1150.png'),
            (14, 'hyundai', 'https://www.carlogos.org/logo/Hyundai-logo-silver-2560x1440.png'),
            (15, 'infiniti', 'https://www.carlogos.org/logo/Infiniti-logo-1989-2560x1440.png'),
            (16, 'jaguar', 'https://www.carlogos.org/logo/Jaguar-logo-2012-1920x1080.png'),
            (17, 'jeep', 'https://www.carlogos.org/logo/Jeep-logo-green-3840x2160.png'),
            (18, 'kia', 'https://www.carlogos.org/logo/Kia-logo-2560x1440.png'),
            (19, 'lexus', 'https://www.carlogos.org/logo/Lexus-logo-1988-1920x1080.png'),
            (20, 'lincoln', 'https://www.carlogos.org/logo/Lincoln-logo-2019-1920x1080.png'),
            (21, 'mazda', 'https://www.carlogos.org/logo/Mazda-logo-1997-1920x1080.png'),
            (22, 'mercedes', 'https://www.carlogos.org/logo/Mercedes-Benz-logo-2011-1920x1080.png'),
            (23, 'mercury', 'https://www.carlogos.org/logo/Mercury-logo-1980-2500x2500.png'),
            (24, 'mini', 'https://www.carlogos.org/logo/Mini-logo-2001-1920x1080.png'),
            (25, 'mitsubishi', 'https://www.carlogos.org/logo/Mitsubishi-logo-2000x2500.png'),
            (26, 'nissan', 'https://www.carlogos.org/car-logos/nissan-logo-2020-black.png'),
            (27, 'pontiac', 'https://www.carlogos.org/logo/Pontiac-logo-2560x1440.png'),
            (28, 'porsche', 'https://www.carlogos.org/car-logos/porsche-logo-2100x1100.png'),
            (29, 'ram', 'https://www.carlogos.org/logo/RAM-logo-2009-1920x1080.png'),
            (30, 'rover', 'https://www.carlogos.org/logo/Rover-logo-2003-3840x2160.png'),
            (31, 'saturn', 'https://www.carlogos.org/logo/Saturn-logo-1985-2048x2048.png'),
            (32, 'subaru', 'https://www.carlogos.org/logo/Subaru-logo-2003-2560x1440.png'),
            (33, 'tesla', 'https://www.carlogos.org/car-logos/tesla-logo-2200x2800.png'),
            (34, 'toyota', 'https://www.carlogos.org/car-logos/toyota-logo-2019-3700x1200.png'),
            (35, 'volkswagen', 'https://www.carlogos.org/logo/Volkswagen-logo-2019-1500x1500.png'),
            (36, 'volvo', 'https://www.carlogos.org/logo/Volvo-logo-2014-1920x1080.png');"
        );

        //Create Paint Colour Table
        $conn->query("CREATE TABLE `ASSIGNMENT_paint_colour` (
            `paint_colour_id` int(11) NOT NULL,
            `paint_colour` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Paint Colour Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_paint_colour`
            ADD PRIMARY KEY (`paint_colour_id`);"
        );

        //Populate Paint Colour Table
        $conn->query("INSERT INTO `ASSIGNMENT_paint_colour` (`paint_colour_id`, `paint_colour`) VALUES
            (0, 'unknown'),
            (1, 'black'),
            (2, 'blue'),
            (3, 'brown'),
            (4, 'custom'),
            (5, 'green'),
            (6, 'grey'),
            (7, 'orange'),
            (8, 'purple'),
            (9, 'red'),
            (10, 'silver'),
            (11, 'white'),
            (12, 'yellow');"
        );

        //Create Payment Options Table
        $conn->query("CREATE TABLE `ASSIGNMENT_payment_options` (
            `payment_option_id` int(11) NOT NULL,
            `user_id` int(11) NOT NULL,
            `payment_card_type` varchar(255) NOT NULL,
            `payment_card_no` varchar(255) NOT NULL,
            `payment_expiry_month` varchar(255) NOT NULL,
            `payment_expiry_year` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Payment Options Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_payment_options`
            ADD PRIMARY KEY (`payment_option_id`);"
        );

        //Create Photos Table
        $conn->query("CREATE TABLE `ASSIGNMENT_photos` (
            `photos_id` int(11) NOT NULL,
            `vehicle_type_id` int(11) NOT NULL,
            `thumbnail_photo` varchar(255) NOT NULL,
            `carousel_photo_1` varchar(255) NOT NULL,
            `carousel_photo_2` varchar(255) NOT NULL,
            `carousel_photo_3` varchar(255) NOT NULL,
            `carousel_photo_4` varchar(255) NOT NULL,
            `carousel_photo_5` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Photos Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_photos`
            ADD PRIMARY KEY (`photos_id`);"
        );

        //Populate Photos Table
        $conn->query("INSERT INTO `ASSIGNMENT_photos` (`photos_id`, `vehicle_type_id`, `thumbnail_photo`, `carousel_photo_1`, `carousel_photo_2`, `carousel_photo_3`, `carousel_photo_4`, `carousel_photo_5`) VALUES
        (1, 1, 'https://open3dmodel.com/wp-content/uploads/2019/09/Articulated-bus-3D-Model.jpg', 'https://i.redd.it/rup8l9a1ufh31.jpg', 'https://i.pinimg.com/originals/d5/ee/c1/d5eec153457905d8987ff0f3d94b59e7.jpg', 'https://2.bp.blogspot.com/-d3T625xy274/VqC2FBojguI/AAAAAAABTVw/8rbqHabR5P8/s1600/2011-Ford-E350-Quigley-4x4-Van-For-Sale.jpg', 'https://1.bp.blogspot.com/-PoyZaAOOEQs/WLQK6bAAP0I/AAAAAAABl_c/814OhPthckEEZ16ZWS3zOcvhDFhXBsyNQCLcB/s1600/Ford-E350-Adventure-Van-Conversion.jpg', 'https://i.insider.com/5e8f596a8427e94b6a7a9914?width=600&format=jpeg&auto=webp'),
        (2, 2, 'https://cdn.shopify.com/s/files/1/1028/1501/products/Mercedes_E_Class_A207_Convertible_2009_onwards_grande.jpg?v=1515757076', 'https://i.pinimg.com/736x/23/9d/51/239d51ef052bbd9cd7cd6d3c0cb4259d.jpg', 'https://images.pistonheads.com/nimg/41326/LC_03.jpg', 'https://bluesky-cogstock.cdn.imgeng.in/images/404bd759e5bd4057b8e31c49d6ac1250.jpg?width=600&scale=both', 'https://hips.hearstapps.com/pop.h-cdn.co/assets/cm/15/05/54cb0aae04728_-_2013-summer-convertibles-01-0313-lgn.jpg', 'https://bookluxurycar.com/system/gallery/original/BMW-6-SERIES-CONVERTIBLE-gallery-4.jpg'),
        (3, 3, 'https://mediapool.bmwgroup.com/cache/P9/201306/P90124678/P90124678-bmw-640i-gran-coupe-m-sport-edition-05-2013-600px.jpg', 'https://images.pistonheads.com/nimg/41015/840iGC_10.jpg', 'https://www.auto-data.net/images/f38/BMW-4-Series-Coupe-F32_1.jpg', 'https://bluesky-cogstock.cdn.imgeng.in/images/R8NAN_2.jpg?width=600&scale=both&quality=80', 'https://blog.carlease.uk.com/wp-content/uploads/2018/09/bmw-430d-gran-coupe.jpg', 'https://images.pistonheads.com/nimg/41090/P90369593_highRes_the-new-bmw-m8-gran-.jpg'),
        (4, 4, 'https://www.cars2buy.co.uk/images/car/600/93926.jpg', 'https://images.buyacar.co.uk/img/med/ford_fiesta_1_0_ecoboost_st-line_5dr_42147086.jpg', 'https://res.cloudinary.com/fulton/image/upload/q_auto,w_850,h_638,c_lfill/v1525273582/37c98-1MiniHatchbackFront.jpg.jpg', 'https://origin-resizer.images.autoexposure.co.uk/AETA77188/AETV35083190_1b.jpg', 'https://images.buyacar.co.uk/img/med/honda_civic_1_8_i-vtec_sport_nav_5dr_auto_46584955.jpg', 'https://economictimes.indiatimes.com/thumb/height-450,width-600,imgsize-148803,msid-80097357/hatchback-agencies.jpg'),
        (5, 5, 'http://shop.berglundcars.com/wp-content/uploads/sites/33/2020/05/13664_st1280_046.png', 'https://www.kbb.com/wp-content/uploads/2019/11/2015_Toyota_Sienna_LTD_oem.jpg', 'https://car-data.com/clients/car-data/7-20-2014-3-35-46-PM-7962090.jpg', 'http://img-cdn.tid.al/m/a4e472494831877b1c4d7fca342e05889dd4ae54.jpg', 'https://en.arenda-car.ru/upload/iblock/809/Hyundai-Grand-Starex.jpg', 'https://classiccarsdepot.com/media/main/vehicle_photos/ca/05/bd/ca05bd33f0ca4086208ac9b41b1310a5.jpg'),
        (6, 6, 'https://i.pinimg.com/originals/c9/36/fd/c936fd4c5877c0587382aef4c4b9dad9.jpg', 'https://pbs.twimg.com/profile_images/454720872205406208/RsY3G8Yv.jpeg', 'https://www.drivespark.com/img/2017/06/09-1497010701-bmw-x3-off-road-experience-drive-2.jpg', 'http://gr8autophoto.com/images/mazda-az-offroad-04.jpg', 'https://i.pinimg.com/originals/79/07/56/790756599692a42c489d8b8042adc7ae.jpg', 'https://www.drivespark.com/img/2016/12/13-1481605231-xtreme-offroad-challenge-dates-4.jpg'),
        (7, 7, 'http://2.bp.blogspot.com/-OYVtGuZQM4k/Ukar9vWQT8I/AAAAAAAA28c/QsPv8yP0MNI/s1600/Caterham_AeroSeven_Concept_Car_2.jpg', 'https://economictimes.indiatimes.com/thumb/height-450,width-600,imgsize-267183,msid-73152227/mercedes-benz-launched-the-sustainable-concept-car-vision-avtr-at-the-ces-tech-show-in-las-vegas-on-tuesday-.jpg', 'https://www.drivespark.com/img/2017/08/mercedes-teases-new-concept-car-05-1501922436.jpg', 'https://cdn.trendhunterstatic.com/thumbs/bmw-mz8.jpeg', 'https://i.pinimg.com/originals/ff/59/66/ff5966fee7142ee37f7cb4089a0dbd2b.jpg', 'https://open3dmodel.com/wp-content/uploads/2019/09/BMW-Concept-Car-3D-Model.jpeg'),
        (8, 8, 'https://www.rushlane.com/wp-content/uploads/2020/08/kia-seltos-pickup-truck-rendered-kleber-silva-1-600x450.jpg', 'https://commercialvehiclecontracts.co.uk/images/P/Toyota-Hilux(1).jpg', 'https://static.turbosquid.com/Preview/2015/06/17__07_03_28/HoldenVFCommodoreUTESSV0000.jpga4b3482c-9b92-455f-9e25-5a58ddb21a07Large-1.jpg', 'https://www.drivespark.com/img/2016/06/01-1464781285-mahindra-imperio.jpg', 'https://res.cloudinary.com/fulton/image/upload/q_auto,w_850,h_638,c_lfill/v1525277731/6f0ca-1SsangyongMussoFrontSide.jpg.jpg', 'https://www.drivespark.com/img/2017/07/ford-celebrates-100-years-of-building-pickup-trucks-12-27-1501162878.jpg'),
        (9, 9, 'https://static.turbosquid.com/Preview/2019/10/10__11_30_38/Toyota_corolla_sedan0000.jpg1F59F757-D27F-49AF-A00A-6B308C592202Large.jpg', 'https://cdn.jdpower.com/JDPA_2020%20Cadillac%20CT5%20Luxury%20Car%20Small.jpg', 'https://www.dallaslimoservices.com/fleet/images/sedan/sedan-limo-exterior.jpg', 'https://imgctcf.aeplcdn.com/thumbs/p-nc-f-ver4/images/cars/Renault/Renault-Megane_Sedan-2017-800-20.jpg', 'https://www.dsf.my/wp-content/uploads/2018/07/Mercedes-Benz-A-Class-sedan-1-600x450.jpg', 'https://autotraderau-res.cloudinary.com/t_cg_car_l/inventory/2020-12-22/80988860468061/10953395/2020_honda_city_New.jpg'),
        (10, 10, 'https://www.apollocamper.com/portals/2/4_Small%20SUV_Nissan%20Qashqai_600x450_1.jpg', 'https://photos.donedeal.ie/ddimg/NGExNmQ5ZmIyYjY1ZmExM2U2OTA4NmUyMDY5NDIzNTFjIvmKj06wUFqx24kjd9jaaHR0cDovL3MzLWV1LXdlc3QtMS5hbWF6b25hd3MuY29tL2RvbmVkZWFsLmllLXBob3Rvcy9waG90b191bmJyYW5kZWRfNjMyMzE0fHx8fHx8NjAweDQ1MHx8fHx8.jpeg', 'https://www.kbb.com/wp-content/uploads/2019/11/10-2018-subaru-forester-black-edition.jpg', 'https://im.idiva.com/content/2011/Feb/ultimate_autobiography_rang.jpg', 'https://www.cardealertracker.com/sites/default/files/Hyundai%20Tucson.jpg', 'https://www.channelnewsasia.com/image/12155340/4x3/600/450/c3339bef1a932a534ef7ab1d7ced1b53/Jq/aston-martin-first-suv-2.jpg'),
        (11, 11, 'https://www.modelsport.co.uk/_images/products/standard/cen8980.jpg', 'https://www.truckpages.co.uk/wp-content/uploads/2020/08/12/used-gritter-truck.jpg', 'https://ph-classic-prod-images.s3.amazonaws.com/nimg/39004/1.jpg', 'https://upload.wikimedia.org/wikipedia/commons/f/fc/Mack_R_model.jpg', 'https://autoline.info/img/s/truck-flatbed-truckVOLVO-FH-13-440---1569935699756561930_big--19100116145950707200.jpg', 'https://trucks2go.co.uk/images/pictures/news/truck-3-(page-picture-large).jpg'),
        (12, 12, 'https://i.ebayimg.com/images/g/WvQAAOSwSdleQhIa/s-l600.jpg', 'https://www.cranfield-colours.co.uk/wp-content/uploads/2017/06/yellow-van.jpg', 'https://www.northside.co.uk/assets/Uploads/_resampled/ResizedImageWzYwMCw0NTBd-Sprinter-Panel-2013VAN0315.jpg', 'https://www.owenbrotherscatering.com/pub/media/catalog/product/cache/4f29f66975fd941915f709c80ad2fd82/o/b/obcrop2-1.jpg', 'https://dragon2000-multisite.s3.eu-west-2.amazonaws.com/multisite/wp-content/uploads/sites/93/2020/02/18112903/Lincolnshire-Van-Centre-Home-Page-Signpost-2_compressed.jpg', 'https://images.buyacar.co.uk/img/med/ford_transit_custom_2_0_ecoblue_130ps_low_roof_d_cab_limited_van_44959637.jpg'),
        (13, 13, 'https://www.cars2buy.co.uk/images/car/600/83810.jpg', 'https://static.turbosquid.com/Preview/2015/08/11__04_33_05/SubaruOutback20150000.jpg5dbf44f3-05b0-453a-9622-a8155c89038fLarge-1.jpg', 'https://www.gravityautosroswell.com/imagetag/3027/main/f/Used-2018-Subaru-Outback-25i.jpg', 'https://classiccarsbay.com/media/main/vehicle_photos/1c/ae/b5/1caeb5c9caa4ea8a4c7e58dae171d807.jpg', 'https://www.iblauda.com/uploads/product/2020-02-10/323487f757231a3208bafa9be0642317_600.JPG', 'https://www.gravityautossandysprings.com/galleria_images/6401/6401_main_f.jpg');"
        );

        //Create Region Table
        $conn->query("CREATE TABLE `ASSIGNMENT_region` (
            `region_id` int(11) NOT NULL,
            `region_name` varchar(255) NOT NULL,
            `region_url` varchar(255) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Region Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_region`
            ADD PRIMARY KEY (`region_id`);"
        );

        //Populate Region Table
        $conn->query("INSERT INTO `ASSIGNMENT_region` (`region_id`, `region_name`, `region_url`) VALUES
            (0, 'Not Given', 'unknown'),
            (1, 'anchorage / mat-su', 'https://anchorage.craigslist.org'),
            (2, 'auburn', 'https://auburn.craigslist.org'),
            (3, 'birmingham', 'https://bham.craigslist.org'),
            (4, 'dothan', 'https://dothan.craigslist.org'),
            (5, 'florence / muscle shoals', 'https://shoals.craigslist.org'),
            (6, 'gadsden-anniston', 'https://gadsden.craigslist.org'),
            (7, 'huntsville / decatur', 'https://huntsville.craigslist.org'),
            (8, 'mobile', 'https://mobile.craigslist.org'),
            (9, 'montgomery', 'https://montgomery.craigslist.org'),
            (10, 'tuscaloosa', 'https://tuscaloosa.craigslist.org');"
        );

        //Create Title Status Table
        $conn->query("CREATE TABLE `ASSIGNMENT_title_status` (
            `title_id` int(11) NOT NULL,
            `title_name` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Title Status Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_title_status`
            ADD PRIMARY KEY (`title_id`);"
        );

        //Populate Title Status Table
        $conn->query("INSERT INTO `ASSIGNMENT_title_status` (`title_id`, `title_name`) VALUES
            (0, 'unknown'),
            (1, 'clean'),
            (2, 'lien'),
            (3, 'missing'),
            (4, 'parts only'),
            (5, 'rebuilt'),
            (6, 'salvage');"
        );

        //Create Transmission Table
        $conn->query("CREATE TABLE `ASSIGNMENT_transmission` (
            `transmission_id` int(11) NOT NULL,
            `transmission` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Transmission Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_transmission`
            ADD PRIMARY KEY (`transmission_id`);"
        );

        //Populate Transmission Table
        $conn->query("INSERT INTO `ASSIGNMENT_transmission` (`transmission_id`, `transmission`) VALUES
            (0, 'Not Given'),
            (1, 'automatic'),
            (2, 'manual'),
            (3, 'unknown');"
        );

        //Create User Table
        $conn->query("CREATE TABLE `ASSIGNMENT_user` (
            `User_ID` int(11) NOT NULL,
            `user_title` varchar(255) NOT NULL,
            `user_forename` varchar(255) NOT NULL,
            `user_surname` varchar(255) NOT NULL,
            `user_email` varchar(255) NOT NULL,
            `user_password` varchar(255) NOT NULL,
            `user_dob` varchar(255) NOT NULL,
            `user_gender` varchar(255) NOT NULL,
            `user_phone` varchar(255) NOT NULL,
            `user_mobile` varchar(255) NOT NULL,
            `user_ship_line_one` varchar(255) NOT NULL,
            `user_ship_line_two` varchar(255) NOT NULL,
            `user_ship_town` varchar(255) NOT NULL,
            `user_ship_zip` varchar(255) NOT NULL,
            `user_ship_state` varchar(255) NOT NULL,
            `user_ship_country` varchar(255) NOT NULL,
            `user_inv_line_one` varchar(255) NOT NULL,
            `user_inv_line_two` varchar(255) NOT NULL,
            `user_inv_town` varchar(255) NOT NULL,
            `user_inv_zip` varchar(255) NOT NULL,
            `user_inv_state` varchar(255) NOT NULL,
            `user_inv_country` varchar(255) NOT NULL,
            `user_admin` int(11) NOT NULL DEFAULT 0,
            `user_photo_url` varchar(255) NOT NULL DEFAULT 'http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/defaultUserPicture.jpg',
            `user_apikey` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set User Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_user`
            ADD PRIMARY KEY (`User_ID`),
            ADD UNIQUE KEY `user_email` (`user_email`);"
        );

        //Create Vehicle Table
        $conn->query("CREATE TABLE `ASSIGNMENT_vehicles` (
            `vehicle_id` int(11) NOT NULL,
            `region_id` int(11) NOT NULL,
            `price` int(11) NOT NULL,
            `year` int(11) NOT NULL,
            `manufacturer_id` int(11) NOT NULL,
            `model` varchar(255) NOT NULL,
            `condition_id` int(11) NOT NULL,
            `cylinders_id` int(11) NOT NULL,
            `fuel_type_id` int(11) NOT NULL,
            `odometer` int(255) DEFAULT NULL,
            `title_status_id` int(11) NOT NULL,
            `transmission_id` int(11) NOT NULL,
            `vin_number` varchar(255) NOT NULL,
            `drive_type_id` int(11) NOT NULL,
            `vehicle_type_id` int(11) NOT NULL,
            `paint_colour_id` int(11) NOT NULL,
            `image_url` varchar(255) DEFAULT NULL,
            `latitude` decimal(65,6) DEFAULT NULL,
            `longitude` decimal(65,6) DEFAULT NULL,
            `user_ID` int(11) NOT NULL,
            `date_added` date NOT NULL,
            `vehicle_owner` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Vehicle Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_vehicles`
            ADD PRIMARY KEY (`vehicle_id`);"
        );

        //Create Vehicle Type Table
        $conn->query("CREATE TABLE `ASSIGNMENT_vehicle_type` (
            `vehicle_type_id` int(11) NOT NULL,
            `vehicle_type` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Vehicle Type Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_vehicle_type`
            ADD PRIMARY KEY (`vehicle_type_id`);"
        );

        //Populate Vehicle Type Table
        $conn->query("INSERT INTO `ASSIGNMENT_vehicle_type` (`vehicle_type_id`, `vehicle_type`) VALUES
            (0, 'unknown'),
            (1, 'bus'),
            (2, 'convertible'),
            (3, 'coupe'),
            (4, 'hatchback'),
            (5, 'mini-van'),
            (6, 'offroad'),
            (7, 'other'),
            (8, 'pickup'),
            (9, 'sedan'),
            (10, 'suv'),
            (11, 'truck'),
            (12, 'van'),
            (13, 'wagon');"
        );

        //Create View History Table
        $conn->query("CREATE TABLE `ASSIGNMENT_view_history` (
            `view_history_id` int(11) NOT NULL,
            `view_history_user_id` int(11) NOT NULL,
            `view_history_vehicle_id` int(11) NOT NULL,
            `view_history_view_date` date NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set View History Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_view_history`
            ADD PRIMARY KEY (`view_history_id`);"
        );

        //Create Wish List Table
        $conn->query("CREATE TABLE `ASSIGNMENT_wishlist` (
            `wishlist_ID` int(11) NOT NULL,
            `User_ID` int(11) NOT NULL,
            `vehicle_ID` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        //Set Wish List Table Primary Key
        $conn->query("ALTER TABLE `ASSIGNMENT_wishlist`
            ADD PRIMARY KEY (`wishlist_ID`);"
        );

        $conn->commit();

    } catch (exception $e) {
        echo "<p>Error: $e</p>";
    }

    //Populate the Vehicles Table
    while(  ($line = fgetcsv($filepath)) !== FALSE ){

        /* Array Indexes and their associated attributes
        line[0] = url (not used)
        line[1] = region
        line[2] = region url
        line[3] = price
        line[4] = year
        line[5] = manufacturer
        line[6] = model
        line[7] = condition
        line[8] = cylinders
        line[9] = fuel type
        line[10] = odometer
        line[11] = title status
        line[12] = transmission type
        line[13] = VIN
        line[14] = drive type
        line[15] = vehicle type
        line[16] = paint colour
        line[17] = image url
        line[18] = latitude
        line[19] = longitude
        */

        //define and initialise variables
        $region = 0;
        $price = 0;
        $year = 0;
        $manufacturer = 0;
        $model = "";
        $condition = 0;
        $cylinders = 0;
        $fuel_type = 0;
        $odometer = "";
        $title = 0;
        $transmission = 0;
        $vin = "";
        $drivetype = 0;
        $vehicletype = 0;
        $paint = 0;
        $imageurl = "";
        $lat = "";
        $long = "";

        //Populate the variables
        switch ($line[1]) {

            case "anchorage / mat-su" :   {
                $region = 1;
                break;
            }
            
            case "auburn" :   {
                $region = 2;
                break;
            }

            case "birmingham" :   {
                $region = 3;
                break;
            }

            case "dothan" :   {
                $region = 4;
                break;
            }

            case "florence / muscle shoals" :   {
                $region = 5;
                break;
            }

            case "gadsden-anniston" :   {
                $region = 6;
                break;
            }

            case "huntsville / decatur" :   {
                $region = 7;
                break;
            }

            case "mobile" :   {
                $region = 8;
                break;
            }

            case "montgomery" :   {
                $region = 9;
                break;
            }

            case "tuscaloosa" :   {
                $region = 10;
                break;
            }
        }

        $price = $line[3];
        $year = $line[4];

        switch ($line[5]) {
            case "acura" : {
                $manufacturer = 1;
                break;
            }

            case "audi" : {
                $manufacturer = 2;
                break;
            }

            case "bmw" : {
                $manufacturer = 3;
                break;
            }

            case "buick" : {
                $manufacturer = 4;
                break;
            }

            case "cadillac" : {
                $manufacturer = 5;
                break;
            }

            case "chevrolet" : {
                $manufacturer = 6;
                break;
            }

            case "chrysler" : {
                $manufacturer = 7;
                break;
            }

            case "datsun" : {
                $manufacturer = 8;
                break;
            }

            case "dodge" : {
                $manufacturer = 9;
                break;
            }

            case "fiat" : {
                $manufacturer = 10;
                break;
            }

            case "ford" : {
                $manufacturer = 11;
                break;
            }

            case "gmc" : {
                $manufacturer = 12;
                break;
            }

            case "honda" : {
                $manufacturer = 13;
                break;
            }

            case "hyundai" : {
                $manufacturer = 14;
                break;
            }

            case "infiniti" : {
                $manufacturer = 15;
                break;
            }

            case "jaguar" : {
                $manufacturer = 16;
                break;
            }

            case "jeep" : {
                $manufacturer = 17;
                break;
            }

            case "kia" : {
                $manufacturer = 18;
                break;
            }

            case "lexus" : {
                $manufacturer = 19;
                break;
            }

            case "lincoln" : {
                $manufacturer = 20;
                break;
            }

            case "mazda" : {
                $manufacturer = 21;
                break;
            }

            case "mercedes" : {
                $manufacturer = 22;
                break;
            }

            case "mercury" : {
                $manufacturer = 23;
                break;
            }

            case "mini" : {
                $manufacturer = 24;
                break;
            }

            case "mitsubishi" : {
                $manufacturer = 25;
                break;
            }

            case "nissan" : {
                $manufacturer = 26;
                break;
            }

            case "pontiac" : {
                $manufacturer = 27;
                break;
            }

            case "porsche" : {
                $manufacturer = 28;
                break;
            }

            case "ram" : {
                $manufacturer = 29;
                break;
            }

            case "rover" : {
                $manufacturer = 30;
                break;
            }

            case "saturn" : {
                $manufacturer = 31;
                break;
            }

            case "subaru" : {
                $manufacturer = 32;
                break;
            }

            case "tesla" : {
                $manufacturer = 33;
                break;
            }

            case "toyota" : {
                $manufacturer = 34;
                break;
            }

            case "volkswagen" : {
                $manufacturer = 35;
                break;
            }

            case "volvo" : {
                $manufacturer = 36;
                break;
            }

        }

        $model = $line[6];

        switch ($line[7]) {
            case "new" : {
                $condition = 1;
                break;
            }
            case "like new" : {
                $condition = 2;
                break;
            }
            case "excellent" : {
                $condition = 3;
                break;
            }
            case "good" : {
                $condition = 4;
                break;
            }
            case "fair" : {
                $condition = 5;
                break;
            }
            case "salvage" : {
                $condition = 6;
                break;
            }
        }

        switch ($line[8]) {
            case "3 cylinders" :{
                $cylinders = 1;
                break;
            }
            case "4 cylinders" :{
                $cylinders = 2;
                break;
            }
            case "5 cylinders" :{
                $cylinders = 3;
                break;
            }
            case "6 cylinders" :{
                $cylinders = 4;
                break;
            }
            case "8 cylinders" :{
                $cylinders = 5;
                break;
            }
            case "10 cylinders" :{
                $cylinders = 6;
                break;
            }
            case "12 cylinders" :{
                $cylinders = 7;
                break;
            }
            case "other" :{
                $cylinders = 8;
                break;
            }
        }

        switch($line[9]) {
            case "diesel" : {
                $fuel_type = 1;
                break;
            }
            case "electric" : {
                $fuel_type = 2;
                break;
            }
            case "gas" : {
                $fuel_type = 3;
                break;
            }
            case "hybrid" : {
                $fuel_type = 4;
                break;
            }
            case "other" : {
                $fuel_type = 5;
                break;
            }
        }

        $odometer = $line[10];

        switch ($line[11]) {
            case "clean" : {
                $title = 1;
                break;
            }
            case "lien" : {
                $title = 2;
                break;
            }
            case "missing" : {
                $title = 3;
                break;
            }
            case "parts only" : {
                $title = 4;
                break;
            }
            case "rebuilt" : {
                $title = 5;
                break;
            }
            case "salvage" : {
                $title = 6;
                break;
            }
        }

        switch ($line[12]) {
            case "automatic" : {
                $transmission = 1;
                break;
            }
            case "manual" : {
                $transmission = 2;
                break;
            }
            case "other" : {
                $transmission = 3;
                break;
            }
        }

        $vin = $line[13];

        switch ($line[14]) {
            case "4wd" : {
                $drivetype = 1;
                break;
            }

            case "fwd" : {
                $drivetype = 2;
                break;
            }

            case "rwd" : {
                $drivetype = 3;
                break;
            }
        }

        switch ($line[15]) {
            case "bus" : {
                $vehicletype = 1;
                break;
            }
            case "convertible" : {
                $vehicletype = 2;
                break;
            }
            case "coupe" : {
                $vehicletype = 3;
                break;
            }
            case "hatchback" : {
                $vehicletype = 4;
                break;
            }
            case "mini-van" : {
                $vehicletype = 5;
                break;
            }
            case "offroad" : {
                $vehicletype = 6;
                break;
            }
            case "other" : {
                $vehicletype = 7;
                break;
            }
            case "pickup" : {
                $vehicletype = 8;
                break;
            }
            case "sedan" : {
                $vehicletype = 9;
                break;
            }
            case "SUV" : {
                $vehicletype = 10;
                break;
            }
            case "truck" : {
                $vehicletype = 11;
                break;
            }
            case "van" : {
                $vehicletype = 12;
                break;
            }
            case "wagon" : {
                $vehicletype = 13;
                break;
            }
        }

        switch ($line[16]) {
            case "black" : {
                $paint = 1;
                break;
            }
            case "blue" : {
                $paint = 2;
                break;
            }
            case "brown" : {
                $paint = 3;
                break;
            }
            case "custom" : {
                $paint = 4;
                break;
            }
            case "green" : {
                $paint = 5;
                break;
            }
            case "grey" : {
                $paint = 6;
                break;
            }
            case "orange" : {
                $paint = 7;
                break;
            }
            case "purple" : {
                $paint = 8;
                break;
            }
            case "red" : {
                $paint = 9;
                break;
            }
            case "silver" : {
                $paint = 10;
                break;
            }
            case "white" : {
                $paint = 11;
                break;
            }
            case "yellow" : {
                $paint = 12;
                break;
            }
        }

        $imageurl = $line[17];
        $lat = $line[18];
        $long = $line[19];

        /* SHOW EACH RECORD IN THE BROWSER
        echo "<p>
            <strong>Region: </strong>$region<br>
            <strong>Price: </strong>$price<br>
            <strong>Year: </strong>$year<br>
            <strong>Manufacturer: </strong>$manufacturer<br>
            <strong>Model: </strong>$model<br>
            <strong>Condition: </strong>$condition<br>
            <strong>Cylinders: </strong>$cylinders<br>
            <strong>Fuel: </strong>$fuel_type<br>
            <strong>Odometer: </strong>$odometer<br>
            <strong>Title Status: </strong>$title<br>
            <strong>Transmission: </strong>$transmission<br>
            <strong>VIN: </strong>$vin<br>
            <strong>Drive Type: </strong>$drivetype<br>
            <strong>Vehicle Type: </strong>$vehicletype<br>
            <strong>Paint Colour: </strong>$paint<br>
            <strong>Image URL: </strong>$imageurl<br>
            <strong>Latitude: </strong>$lat<br>
            <strong>Longitude: </strong>$long<br>
        </p>";
        */

        //Write the INSERT query and store it in a local variable
        $sql = "INSERT INTO ASSIGNMENT_vehicles (region_id, price, year, manufacturer_id, model, condition_id, cylinders_id, fuel_type_id, odometer, title_status_id, transmission_id, vin_number, drive_type_id, vehicle_type_id, paint_colour_id, image_url, latitude, longitude) VALUES ('$region', '$price', '$year', '$manufacturer', '$model', '$condition', '$cylinders', '$fuel_type', '$odometer', '$title', '$transmission', '$vin', '$drivetype', '$vehicletype', '$paint', '$imageurl', '$lat', '$long')";

        //Run the stored query against the datbase connection, storing the result in a variable
        $result = $conn->query($sql);

        //If there is an error, print it to the page and stop the script.
        if (!$result){
            echo $conn->error;
            die();
        } else {
            echo "<p>Record $count successfully added</p>";
            $count++;
        }
        
    }

?>