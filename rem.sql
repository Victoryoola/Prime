-- rem database schema
CREATE DATABASE IF NOT EXISTS `rem` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rem`;

-- Users table (agents and buyers)
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fullName` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `phone` VARCHAR(20) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'active',
  `role` ENUM('agent','buyer') NOT NULL,
  `id_type` VARCHAR(50) DEFAULT NULL,
  `id_path` VARCHAR(255) DEFAULT NULL,
  `cv_path` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- States table
CREATE TABLE `states` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `stateName` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- LGA table
CREATE TABLE `lga` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `lga` VARCHAR(100) NOT NULL,
  `state_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`state_id`) REFERENCES `states`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Properties table
CREATE TABLE `properties` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `agent_id` INT(11) NOT NULL,
  `propertyTitle` VARCHAR(255) NOT NULL,
  `price` DECIMAL(15,2) NOT NULL,
  `propertyStatus` ENUM('for sale','for rent') NOT NULL,
  `state` INT(11) NOT NULL,
  `lga` INT(11) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `kitchen_number` INT(5) NOT NULL DEFAULT 0,
  `bath_number` INT(5) NOT NULL DEFAULT 0,
  `bed_number` INT(5) NOT NULL DEFAULT 0,
  `description` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`agent_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`state`) REFERENCES `states`(`id`),
  FOREIGN KEY (`lga`) REFERENCES `lga`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Property documents/images table
CREATE TABLE `property_documents` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `property_id` INT(11) NOT NULL,
  `file_url` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`property_id`) REFERENCES `properties`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed: Nigerian States
INSERT INTO `states` (`stateName`) VALUES
('Abia'),('Adamawa'),('Akwa Ibom'),('Anambra'),('Bauchi'),('Bayelsa'),
('Benue'),('Borno'),('Cross River'),('Delta'),('Ebonyi'),('Edo'),
('Ekiti'),('Enugu'),('FCT - Abuja'),('Gombe'),('Imo'),('Jigawa'),
('Kaduna'),('Kano'),('Katsina'),('Kebbi'),('Kogi'),('Kwara'),
('Lagos'),('Nasarawa'),('Niger'),('Ogun'),('Ondo'),('Osun'),
('Oyo'),('Plateau'),('Rivers'),('Sokoto'),('Taraba'),('Yobe'),('Zamfara');

-- Seed: LGAs for Lagos (state_id = 25)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Agege', 25),('Ajeromi-Ifelodun', 25),('Alimosho', 25),('Amuwo-Odofin', 25),
('Apapa', 25),('Badagry', 25),('Epe', 25),('Eti-Osa', 25),
('Ibeju-Lekki', 25),('Ifako-Ijaiye', 25),('Ikeja', 25),('Ikorodu', 25),
('Kosofe', 25),('Lagos Island', 25),('Lagos Mainland', 25),('Mushin', 25),
('Ojo', 25),('Oshodi-Isolo', 25),('Shomolu', 25),('Surulere', 25);

-- Seed: LGAs for FCT - Abuja (state_id = 15)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Abaji', 15),('Bwari', 15),('Gwagwalada', 15),('Kuje', 15),
('Kwali', 15),('Municipal Area Council', 15);

-- Seed: LGAs for Rivers (state_id = 33)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Ahoada East', 33),('Ahoada West', 33),('Akuku-Toru', 33),('Andoni', 33),
('Asari-Toru', 33),('Bonny', 33),('Degema', 33),('Eleme', 33),
('Emohua', 33),('Etche', 33),('Gokana', 33),('Ikwerre', 33),
('Khana', 33),('Obio-Akpor', 33),('Ogba-Egbema-Ndoni', 33),('Ogu-Bolo', 33),
('Okrika', 33),('Omuma', 33),('Opobo-Nkoro', 33),('Oyigbo', 33),
('Port Harcourt', 33),('Tai', 33);

-- Seed: LGAs for Kano (state_id = 20)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Ajingi', 20),('Albasu', 20),('Bagwai', 20),('Bebeji', 20),
('Bichi', 20),('Bunkure', 20),('Dala', 20),('Dambatta', 20),
('Dawakin Kudu', 20),('Dawakin Tofa', 20),('Doguwa', 20),('Fagge', 20),
('Gabasawa', 20),('Garko', 20),('Garun Mallam', 20),('Gaya', 20),
('Gezawa', 20),('Gwale', 20),('Gwarzo', 20),('Kabo', 20),
('Kano Municipal', 20),('Karaye', 20),('Kibiya', 20),('Kiru', 20),
('Kumbotso', 20),('Kunchi', 20),('Kura', 20),('Madobi', 20),
('Makoda', 20),('Minjibir', 20),('Nasarawa', 20),('Rano', 20),
('Rimin Gado', 20),('Rogo', 20),('Shanono', 20),('Sumaila', 20),
('Takai', 20),('Tarauni', 20),('Tofa', 20),('Tsanyawa', 20),
('Tudun Wada', 20),('Ungogo', 20),('Warawa', 20),('Wudil', 20);

-- Seed: All LGAs for all 36 states + FCT
-- State IDs match the order inserted above:
-- 1=Abia, 2=Adamawa, 3=Akwa Ibom, 4=Anambra, 5=Bauchi, 6=Bayelsa,
-- 7=Benue, 8=Borno, 9=Cross River, 10=Delta, 11=Ebonyi, 12=Edo,
-- 13=Ekiti, 14=Enugu, 15=FCT-Abuja, 16=Gombe, 17=Imo, 18=Jigawa,
-- 19=Kaduna, 20=Kano, 21=Katsina, 22=Kebbi, 23=Kogi, 24=Kwara,
-- 25=Lagos, 26=Nasarawa, 27=Niger, 28=Ogun, 29=Ondo, 30=Osun,
-- 31=Oyo, 32=Plateau, 33=Rivers, 34=Sokoto, 35=Taraba, 36=Yobe, 37=Zamfara

-- Abia (1)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Aba North',1),('Aba South',1),('Arochukwu',1),('Bende',1),('Ikwuano',1),
('Isiala Ngwa North',1),('Isiala Ngwa South',1),('Isuikwuato',1),('Obi Ngwa',1),
('Ohafia',1),('Osisioma',1),('Ugwunagbo',1),('Ukwa East',1),('Ukwa West',1),
('Umuahia North',1),('Umuahia South',1),('Umu Nneochi',1);

-- Adamawa (2)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Demsa',2),('Fufure',2),('Ganye',2),('Gayuk',2),('Gombi',2),('Grie',2),
('Hong',2),('Jada',2),('Lamurde',2),('Madagali',2),('Maiha',2),('Mayo Belwa',2),
('Michika',2),('Mubi North',2),('Mubi South',2),('Numan',2),('Shelleng',2),
('Song',2),('Toungo',2),('Yola North',2),('Yola South',2);

-- Akwa Ibom (3)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Abak',3),('Eastern Obolo',3),('Eket',3),('Esit Eket',3),('Essien Udim',3),
('Etim Ekpo',3),('Etinan',3),('Ibeno',3),('Ibesikpo Asutan',3),('Ibiono-Ibom',3),
('Ika',3),('Ikono',3),('Ikot Abasi',3),('Ikot Ekpene',3),('Ini',3),
('Itu',3),('Mbo',3),('Mkpat-Enin',3),('Nsit-Atai',3),('Nsit-Ibom',3),
('Nsit-Ubium',3),('Obot Akara',3),('Okobo',3),('Onna',3),('Oron',3),
('Oruk Anam',3),('Udung-Uko',3),('Ukanafun',3),('Uruan',3),('Urue-Offong/Oruko',3),
('Uyo',3);

-- Anambra (4)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Aguata',4),('Anambra East',4),('Anambra West',4),('Anaocha',4),('Awka North',4),
('Awka South',4),('Ayamelum',4),('Dunukofia',4),('Ekwusigo',4),('Idemili North',4),
('Idemili South',4),('Ihiala',4),('Njikoka',4),('Nnewi North',4),('Nnewi South',4),
('Ogbaru',4),('Onitsha North',4),('Onitsha South',4),('Orumba North',4),
('Orumba South',4),('Oyi',4);

-- Bauchi (5)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Alkaleri',5),('Bauchi',5),('Bogoro',5),('Damban',5),('Darazo',5),('Dass',5),
('Gamawa',5),('Ganjuwa',5),('Giade',5),('Itas/Gadau',5),('Jama\'are',5),
('Katagum',5),('Kirfi',5),('Misau',5),('Ningi',5),('Shira',5),('Tafawa Balewa',5),
('Toro',5),('Warji',5),('Zaki',5);

-- Bayelsa (6)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Brass',6),('Ekeremor',6),('Kolokuma/Opokuma',6),('Nembe',6),('Ogbia',6),
('Sagbama',6),('Southern Ijaw',6),('Yenagoa',6);

-- Benue (7)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Ado',7),('Agatu',7),('Apa',7),('Buruku',7),('Gboko',7),('Guma',7),
('Gwer East',7),('Gwer West',7),('Katsina-Ala',7),('Konshisha',7),('Kwande',7),
('Logo',7),('Makurdi',7),('Obi',7),('Ogbadibo',7),('Ohimini',7),('Oju',7),
('Okpokwu',7),('Oturkpo',7),('Tarka',7),('Ukum',7),('Ushongo',7),('Vandeikya',7);

-- Borno (8)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Abadam',8),('Askira/Uba',8),('Bama',8),('Bayo',8),('Biu',8),('Chibok',8),
('Damboa',8),('Dikwa',8),('Gubio',8),('Guzamala',8),('Gwoza',8),('Hawul',8),
('Jere',8),('Kaga',8),('Kala/Balge',8),('Konduga',8),('Kukawa',8),
('Kwaya Kusar',8),('Mafa',8),('Magumeri',8),('Maiduguri',8),('Marte',8),
('Mobbar',8),('Monguno',8),('Ngala',8),('Nganzai',8),('Shani',8);

-- Cross River (9)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Abi',9),('Akamkpa',9),('Akpabuyo',9),('Bakassi',9),('Bekwarra',9),('Biase',9),
('Boki',9),('Calabar Municipal',9),('Calabar South',9),('Etung',9),('Ikom',9),
('Obanliku',9),('Obubra',9),('Obudu',9),('Odukpani',9),('Ogoja',9),
('Yakuur',9),('Yala',9);

-- Delta (10)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Aniocha North',10),('Aniocha South',10),('Bomadi',10),('Burutu',10),
('Ethiope East',10),('Ethiope West',10),('Ika North East',10),('Ika South',10),
('Isoko North',10),('Isoko South',10),('Ndokwa East',10),('Ndokwa West',10),
('Okpe',10),('Oshimili North',10),('Oshimili South',10),('Patani',10),
('Sapele',10),('Udu',10),('Ughelli North',10),('Ughelli South',10),
('Ukwuani',10),('Uvwie',10),('Warri North',10),('Warri South',10),
('Warri South West',10);

-- Ebonyi (11)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Abakaliki',11),('Afikpo North',11),('Afikpo South',11),('Ebonyi',11),
('Ezza North',11),('Ezza South',11),('Ikwo',11),('Ishielu',11),('Ivo',11),
('Izzi',11),('Ohaozara',11),('Ohaukwu',11),('Onicha',11);

-- Edo (12)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Akoko-Edo',12),('Egor',12),('Esan Central',12),('Esan North-East',12),
('Esan South-East',12),('Esan West',12),('Etsako Central',12),('Etsako East',12),
('Etsako West',12),('Igueben',12),('Ikpoba-Okha',12),('Orhionmwon',12),
('Oredo',12),('Ovia North-East',12),('Ovia South-West',12),('Owan East',12),
('Owan West',12),('Uhunmwonde',12);

-- Ekiti (13)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Ado Ekiti',13),('Efon',13),('Ekiti East',13),('Ekiti South-West',13),
('Ekiti West',13),('Emure',13),('Gbonyin',13),('Ido/Osi',13),('Ijero',13),
('Ikere',13),('Ikole',13),('Ilejemeje',13),('Irepodun/Ifelodun',13),
('Ise/Orun',13),('Moba',13),('Oye',13);

-- Enugu (14)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Aninri',14),('Awgu',14),('Enugu East',14),('Enugu North',14),('Enugu South',14),
('Ezeagu',14),('Igbo Etiti',14),('Igbo Eze North',14),('Igbo Eze South',14),
('Isi Uzo',14),('Nkanu East',14),('Nkanu West',14),('Nsukka',14),
('Oji River',14),('Udenu',14),('Udi',14),('Uzo-Uwani',14);

-- FCT - Abuja (15)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Abaji',15),('Bwari',15),('Gwagwalada',15),('Kuje',15),
('Kwali',15),('Municipal Area Council',15);

-- Gombe (16)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Akko',16),('Balanga',16),('Billiri',16),('Dukku',16),('Funakaye',16),
('Gombe',16),('Kaltungo',16),('Kwami',16),('Nafada',16),('Shongom',16),
('Yamaltu/Deba',16);

-- Imo (17)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Aboh Mbaise',17),('Ahiazu Mbaise',17),('Ehime Mbano',17),('Ezinihitte',17),
('Ideato North',17),('Ideato South',17),('Ihitte/Uboma',17),('Ikeduru',17),
('Isiala Mbano',17),('Isu',17),('Mbaitoli',17),('Ngor Okpala',17),
('Njaba',17),('Nkwerre',17),('Nwangele',17),('Obowo',17),('Oguta',17),
('Ohaji/Egbema',17),('Okigwe',17),('Orlu',17),('Orsu',17),('Oru East',17),
('Oru West',17),('Owerri Municipal',17),('Owerri North',17),('Owerri West',17),
('Unuimo',17);

-- Jigawa (18)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Auyo',18),('Babura',18),('Biriniwa',18),('Birnin Kudu',18),('Buji',18),
('Dutse',18),('Gagarawa',18),('Garki',18),('Gumel',18),('Guri',18),
('Gwaram',18),('Gwiwa',18),('Hadejia',18),('Jahun',18),('Kafin Hausa',18),
('Kaugama',18),('Kazaure',18),('Kiri Kasama',18),('Kiyawa',18),('Maigatari',18),
('Malam Madori',18),('Miga',18),('Ringim',18),('Roni',18),('Sule Tankarkar',18),
('Taura',18),('Yankwashi',18);

-- Kaduna (19)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Birnin Gwari',19),('Chikun',19),('Giwa',19),('Igabi',19),('Ikara',19),
('Jaba',19),('Jema\'a',19),('Kachia',19),('Kaduna North',19),('Kaduna South',19),
('Kagarko',19),('Kajuru',19),('Kaura',19),('Kauru',19),('Kubau',19),
('Kudan',19),('Lere',19),('Makarfi',19),('Sabon Gari',19),('Sanga',19),
('Soba',19),('Zangon Kataf',19),('Zaria',19);

-- Kano (20)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Ajingi',20),('Albasu',20),('Bagwai',20),('Bebeji',20),('Bichi',20),
('Bunkure',20),('Dala',20),('Dambatta',20),('Dawakin Kudu',20),('Dawakin Tofa',20),
('Doguwa',20),('Fagge',20),('Gabasawa',20),('Garko',20),('Garun Mallam',20),
('Gaya',20),('Gezawa',20),('Gwale',20),('Gwarzo',20),('Kabo',20),
('Kano Municipal',20),('Karaye',20),('Kibiya',20),('Kiru',20),('Kumbotso',20),
('Kunchi',20),('Kura',20),('Madobi',20),('Makoda',20),('Minjibir',20),
('Nasarawa',20),('Rano',20),('Rimin Gado',20),('Rogo',20),('Shanono',20),
('Sumaila',20),('Takai',20),('Tarauni',20),('Tofa',20),('Tsanyawa',20),
('Tudun Wada',20),('Ungogo',20),('Warawa',20),('Wudil',20);

-- Katsina (21)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Bakori',21),('Batagarawa',21),('Batsari',21),('Baure',21),('Bindawa',21),
('Charanchi',21),('Dan Musa',21),('Dandume',21),('Danja',21),('Daura',21),
('Dutsi',21),('Dutsin-Ma',21),('Faskari',21),('Funtua',21),('Ingawa',21),
('Jibia',21),('Kafur',21),('Kaita',21),('Kankara',21),('Kankia',21),
('Katsina',21),('Kurfi',21),('Kusada',21),('Mai\'Adua',21),('Malumfashi',21),
('Mani',21),('Mashi',21),('Matazu',21),('Musawa',21),('Rimi',21),
('Sabuwa',21),('Safana',21),('Sandamu',21),('Zango',21);

-- Kebbi (22)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Aleiro',22),('Arewa Dandi',22),('Argungu',22),('Augie',22),('Bagudo',22),
('Birnin Kebbi',22),('Bunza',22),('Dandi',22),('Fakai',22),('Gwandu',22),
('Jega',22),('Kalgo',22),('Koko/Besse',22),('Maiyama',22),('Ngaski',22),
('Sakaba',22),('Shanga',22),('Suru',22),('Wasagu/Danko',22),('Yauri',22),
('Zuru',22);

-- Kogi (23)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Adavi',23),('Ajaokuta',23),('Ankpa',23),('Bassa',23),('Dekina',23),
('Ibaji',23),('Idah',23),('Igalamela-Odolu',23),('Ijumu',23),('Kabba/Bunu',23),
('Kogi',23),('Lokoja',23),('Mopa-Muro',23),('Ofu',23),('Ogori/Magongo',23),
('Okehi',23),('Okene',23),('Olamaboro',23),('Omala',23),('Yagba East',23),
('Yagba West',23);

-- Kwara (24)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Asa',24),('Baruten',24),('Edu',24),('Ekiti',24),('Ifelodun',24),
('Ilorin East',24),('Ilorin South',24),('Ilorin West',24),('Irepodun',24),
('Isin',24),('Kaiama',24),('Moro',24),('Offa',24),('Oke Ero',24),
('Oyun',24),('Pategi',24);

-- Lagos (25)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Agege',25),('Ajeromi-Ifelodun',25),('Alimosho',25),('Amuwo-Odofin',25),
('Apapa',25),('Badagry',25),('Epe',25),('Eti-Osa',25),('Ibeju-Lekki',25),
('Ifako-Ijaiye',25),('Ikeja',25),('Ikorodu',25),('Kosofe',25),
('Lagos Island',25),('Lagos Mainland',25),('Mushin',25),('Ojo',25),
('Oshodi-Isolo',25),('Shomolu',25),('Surulere',25);

-- Nasarawa (26)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Akwanga',26),('Awe',26),('Doma',26),('Karu',26),('Keana',26),('Keffi',26),
('Kokona',26),('Lafia',26),('Nasarawa',26),('Nasarawa Egon',26),('Obi',26),
('Toto',26),('Wamba',26);

-- Niger (27)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Agaie',27),('Agwara',27),('Bida',27),('Borgu',27),('Bosso',27),
('Chanchaga',27),('Edati',27),('Gbako',27),('Gurara',27),('Katcha',27),
('Kontagora',27),('Lapai',27),('Lavun',27),('Magama',27),('Mariga',27),
('Mashegu',27),('Mokwa',27),('Moya',27),('Paikoro',27),('Rafi',27),
('Rijau',27),('Shiroro',27),('Suleja',27),('Tafa',27),('Wushishi',27);

-- Ogun (28)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Abeokuta North',28),('Abeokuta South',28),('Ado-Odo/Ota',28),('Egbado North',28),
('Egbado South',28),('Ewekoro',28),('Ifo',28),('Ijebu East',28),
('Ijebu North',28),('Ijebu North East',28),('Ijebu Ode',28),('Ikenne',28),
('Imeko Afon',28),('Ipokia',28),('Obafemi Owode',28),('Odeda',28),
('Odogbolu',28),('Ogun Waterside',28),('Remo North',28),('Shagamu',28);

-- Ondo (29)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Akoko North-East',29),('Akoko North-West',29),('Akoko South-East',29),
('Akoko South-West',29),('Akure North',29),('Akure South',29),('Ese Odo',29),
('Idanre',29),('Ifedore',29),('Ilaje',29),('Ile Oluji/Okeigbo',29),
('Irele',29),('Odigbo',29),('Okitipupa',29),('Ondo East',29),('Ondo West',29),
('Ose',29),('Owo',29);

-- Osun (30)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Aiyedaade',30),('Aiyedire',30),('Atakumosa East',30),('Atakumosa West',30),
('Boluwaduro',30),('Boripe',30),('Ede North',30),('Ede South',30),
('Egbedore',30),('Ejigbo',30),('Ife Central',30),('Ife East',30),
('Ife North',30),('Ife South',30),('Ifedayo',30),('Ifelodun',30),
('Ila',30),('Ilesa East',30),('Ilesa West',30),('Irepodun',30),
('Irewole',30),('Isokan',30),('Iwo',30),('Obokun',30),('Odo Otin',30),
('Ola Oluwa',30),('Olorunda',30),('Oriade',30),('Orolu',30),('Osogbo',30);

-- Oyo (31)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Afijio',31),('Akinyele',31),('Atiba',31),('Atisbo',31),('Egbeda',31),
('Ibadan North',31),('Ibadan North-East',31),('Ibadan North-West',31),
('Ibadan South-East',31),('Ibadan South-West',31),('Ibarapa Central',31),
('Ibarapa East',31),('Ibarapa North',31),('Ido',31),('Irepo',31),
('Iseyin',31),('Itesiwaju',31),('Iwajowa',31),('Kajola',31),('Lagelu',31),
('Ogbomosho North',31),('Ogbomosho South',31),('Ogo Oluwa',31),('Olorunsogo',31),
('Oluyole',31),('Ona Ara',31),('Orelope',31),('Ori Ire',31),('Oyo East',31),
('Oyo West',31),('Saki East',31),('Saki West',31),('Surulere',31);

-- Plateau (32)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Barkin Ladi',32),('Bassa',32),('Bokkos',32),('Jos East',32),('Jos North',32),
('Jos South',32),('Kanam',32),('Kanke',32),('Langtang North',32),
('Langtang South',32),('Mangu',32),('Mikang',32),('Pankshin',32),
('Qua\'an Pan',32),('Riyom',32),('Shendam',32),('Wase',32);

-- Rivers (33)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Ahoada East',33),('Ahoada West',33),('Akuku-Toru',33),('Andoni',33),
('Asari-Toru',33),('Bonny',33),('Degema',33),('Eleme',33),('Emohua',33),
('Etche',33),('Gokana',33),('Ikwerre',33),('Khana',33),('Obio-Akpor',33),
('Ogba-Egbema-Ndoni',33),('Ogu-Bolo',33),('Okrika',33),('Omuma',33),
('Opobo-Nkoro',33),('Oyigbo',33),('Port Harcourt',33),('Tai',33);

-- Sokoto (34)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Binji',34),('Bodinga',34),('Dange Shuni',34),('Gada',34),('Goronyo',34),
('Gudu',34),('Gwadabawa',34),('Illela',34),('Isa',34),('Kebbe',34),
('Kware',34),('Rabah',34),('Sabon Birni',34),('Shagari',34),('Silame',34),
('Sokoto North',34),('Sokoto South',34),('Tambuwal',34),('Tangaza',34),
('Tureta',34),('Wamako',34),('Wurno',34),('Yabo',34);

-- Taraba (35)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Ardo Kola',35),('Bali',35),('Donga',35),('Gashaka',35),('Gassol',35),
('Ibi',35),('Jalingo',35),('Karim Lamido',35),('Kumi',35),('Lau',35),
('Sardauna',35),('Takum',35),('Ussa',35),('Wukari',35),('Yorro',35),('Zing',35);

-- Yobe (36)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Bade',36),('Bursari',36),('Damaturu',36),('Fika',36),('Fune',36),
('Geidam',36),('Gujba',36),('Gulani',36),('Jakusko',36),('Karasuwa',36),
('Machina',36),('Nangere',36),('Nguru',36),('Potiskum',36),('Tarmuwa',36),
('Yunusari',36),('Yusufari',36);

-- Zamfara (37)
INSERT INTO `lga` (`lga`, `state_id`) VALUES
('Anka',37),('Bakura',37),('Birnin Magaji/Kiyaw',37),('Bukkuyum',37),
('Bungudu',37),('Gummi',37),('Gusau',37),('Kaura Namoda',37),('Maradun',37),
('Maru',37),('Shinkafi',37),('Talata Mafara',37),('Tsafe',37),('Zurmi',37);
