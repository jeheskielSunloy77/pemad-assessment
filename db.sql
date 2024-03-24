- PERUBAHAN
-- 1. Menambahkan timestamp pada setiap tabel
-- 2. Emenganti beberapa tipe data yang bersifat statis menjadi ENUM, beberapa tipe data ini adalah Currency, Language, Country, TimeZone.
--        Alasan: Performa dan keamanan dari tipe data ENUM lebih baik.
-- 3. Membuat tabel baru 'pmd_segments' untuk menyimpan data segment client. yang awalnya disimpan di dalam tabel 'pmd_clients' sebagai kolom 'segment'
-- 4. Menganti nama kolom tabel agar lebih deskriptif dan agar 




CREATE TYPE  Currency AS ENUM ('USD','IDR')

CREATE TABLE pmd_bank (
    id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
    bank VARCHAR(128) ,
    currency Currency,
    properties TEXT ,
    subject TEXT ,
    properties_docx TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE client_segments (
    id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
    name VARCHAR(100) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TYPE Language AS ENUM ('Afrikaans', 'Albanian', 'Amharic', 'Arabic', 'Armenian', 'Azerbaijani', 'Basque', 'Belarusian', 'Bengali', 'Bosnian', 'Bulgarian', 'Catalan', 'Cebuano', 'Chichewa', 'Chinese', 'Corsican', 'Croatian', 'Czech', 'Danish', 'Dutch', 'English', 'Esperanto', 'Estonian', 'Filipino', 'Finnish', 'French', 'Frisian', 'Galician', 'Georgian', 'German', 'Greek', 'Gujarati', 'Haitian Creole', 'Hausa', 'Hawaiian', 'Hebrew', 'Hindi', 'Hmong', 'Hungarian', 'Icelandic', 'Igbo', 'Indonesian', 'Irish', 'Italian', 'Japanese', 'Javanese', 'Kannada', 'Kazakh', 'Khmer', 'Korean', 'Kurdish (Kurmanji)', 'Kyrgyz', 'Lao', 'Latin', 'Latvian', 'Lithuanian', 'Luxembourgish', 'Macedonian', 'Malagasy', 'Malay', 'Malayalam', 'Maltese', 'Maori', 'Marathi', 'Mongolian', 'Myanmar (Burmese)', 'Nepali', 'Norwegian', 'Pashto', 'Persian', 'Polish', 'Portuguese', 'Punjabi', 'Romanian', 'Russian', 'Samoan', 'Scots Gaelic', 'Serbian', 'Sesotho', 'Shona', 'Sindhi', 'Sinhala', 'Slovak', 'Slovenian', 'Somali', 'Spanish', 'Sundanese', 'Swahili', 'Swedish', 'Tajik', 'Tamil', 'Telugu', 'Thai', 'Turkish', 'Ukrainian', 'Urdu', 'Uzbek', 'Vietnamese', 'Welsh', 'Xhosa', 'Yiddish', 'Yoruba', 'Zulu');

CREATE TABLE pmd_clients (
    id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  segment_id BINARY(16) NOT NULL,
  name VARCHAR(100)  COMMENT 'nama primary contact',
  email VARCHAR(100)  COMMENT 'email company',
  company VARCHAR(128) ,
  address TEXT ,
  phone VARCHAR(50)  COMMENT 'phone company',
  timezone VARCHAR(128) NOT NULL,
  description TEXT,
  website TEXT NOT NULL,
  primary_contact_salutation VARCHAR(50) NOT NULL,
  primary_contact_email VARCHAR(100) NOT NULL,
  primary_contact_phonemob VARCHAR(50) NOT NULL,
  primary_contact_skype VARCHAR(100) NOT NULL,
  primary_contact_jobtitle VARCHAR(100) NOT NULL,
  primary_contact_phone VARCHAR(50) NOT NULL,
  additional_contact_salutation VARCHAR(50) NOT NULL,
  additional_contact_name VARCHAR(100) NOT NULL,
  additional_contact_email VARCHAR(100) NOT NULL,
  additional_contact_phonemob VARCHAR(50) NOT NULL,
  additional_contact_skype VARCHAR(100) NOT NULL,
  additional_contact_jobtitle VARCHAR(100) NOT NULL,
  additional_contact_phone VARCHAR(50) NOT NULL,
  currency Currency,
  rate_per_word int(11) NOT NULL DEFAULT 0,
  rate_per_minute int(11) NOT NULL DEFAULT 0,
  rate_per_hour int(11) NOT NULL DEFAULT 0,
  rate_per_day int(11) NOT NULL DEFAULT 0,
  rate_per_sheet int(11) NOT NULL DEFAULT 0,
  rate_per_piece int(11) NOT NULL DEFAULT 0,
  lang_from Language,
  lang_to Language,
  lang_from_custom VARCHAR(1424),
  lang_to_custom VARCHAR(1424),
  price_currency VARCHAR(1424),
  price_t VARCHAR(712) NOT NULL DEFAULT '0',
  price_e VARCHAR(712) NOT NULL DEFAULT '0',
  price_tep VARCHAR(712) NOT NULL DEFAULT '0',
  price_hourly VARCHAR(712) NOT NULL DEFAULT '0',
  price_minim VARCHAR(712) NOT NULL DEFAULT '0',
  price_note TEXT NOT NULL,
  trems_signed TEXT NOT NULL,
  trems_pinalti TEXT NOT NULL,
  trems_special TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE pmd_clients ADD FOREIGN KEY (segment_id) REFERENCES client_segments(id) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE pmd_jobs (
  id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  client_id BINARY(16) NOT NULL,
  type_id BINARY(16) NOT NULL,
  translator_id BINARY(16) NOT NULL,
  pm_id BINARY(16) NOT NULL,
  editor_id BINARY(16) NOT NULL,
  job_number VARCHAR(200)  COMMENT 'JOB NUMBER',
  kode VARCHAR(100)  COMMENT 'Clients PO Number',
  name VARCHAR(120) ,
  lang_from Language,
  lang_to Language ,
  lang_from_custom VARCHAR(20) ,
  lang_to_custom VARCHAR(20) ,
  currency Currency,
  unit VARCHAR(20) ,
  total decimal(10,2) NOT NULL DEFAULT 0.00,
  rate bigint(20) NOT NULL DEFAULT 0,
  total bigint(20) NOT NULL DEFAULT 0,
  th_unit VARCHAR(10) ,
  th_total decimal(10,2) NOT NULL DEFAULT 0.00,
  th_rate bigint(20) NOT NULL DEFAULT 0,
  th_total bigint(20) NOT NULL DEFAULT 0,
  trans_total bigint(20) DEFAULT 0,
  client_currency VARCHAR(10) ,
  client_unit VARCHAR(20) ,
  client_total decimal(10,2) NOT NULL DEFAULT 0.00,
  client_rate bigint(20) NOT NULL DEFAULT 0,
  client_total bigint(20) NOT NULL DEFAULT 0,
  client_pm VARCHAR(128) ,
  catatan TEXT ,
  status ENUM ('pending,' ,'inProgress', 'translated', 'edited', 'revisi', 'delivered', 'inquiry') DEFAULT 'pending',
  tgl_masuk bigint(20) NOT NULL DEFAULT 0,
  tgl_tugas bigint(20) NOT NULL DEFAULT 0,
  tgl_deadline bigint(20) NOT NULL DEFAULT 0,
  tgl_selesai bigint(20) NOT NULL DEFAULT 0,
  file_source TEXT ,
  file_translated TEXT ,
  file_edited TEXT ,
  file_finished TEXT ,
  project int(11) NOT NULL DEFAULT 0 COMMENT '-1: unprojected',
  inquiry bigint(20) NOT NULL DEFAULT 0,
  po int(2) NOT NULL DEFAULT 0,
  inv int(2) NOT NULL DEFAULT 0,
  client_pay int(2) NOT NULL DEFAULT 0,
  trans_pay int(2) NOT NULL DEFAULT 0,
  read_trans int(11) NOT NULL DEFAULT 0 COMMENT '0: sudah dibaca, 1: belum',
  read_editor int(11) NOT NULL DEFAULT 0 COMMENT '0: sudah dibaca, 1: belum',
  trados VARCHAR(200) NOT NULL DEFAULT '0|0|0|0|0|0|0|0',
  trados_th VARCHAR(200) NOT NULL DEFAULT '0|0|0|0|0|0|0|0',
  star_translator_quality decimal(10,2) NOT NULL,
  star_translator_responsiv decimal(10,2) NOT NULL,
  star_translator_puncuality decimal(10,2) NOT NULL,
  sendmail_trans int(11) NOT NULL DEFAULT 1 COMMENT 'harus cek lagi, pastikan status awal 1',
  sendmail_editor int(11) NOT NULL DEFAULT 1,
  project_field VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE pmd_jobs ADD FOREIGN KEY (client_id) REFERENCES pmd_clients(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE pmd_jobs ADD FOREIGN KEY (type_id) REFERENCES pmd_job_types(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE pmd_jobs ADD FOREIGN KEY (translator_id) REFERENCES pmd_users(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE pmd_jobs ADD FOREIGN KEY (pm_id) REFERENCES pmd_users(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE pmd_jobs ADD FOREIGN KEY (editor_id) REFERENCES pmd_users(id) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE pmd_job_types (
    id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  name VARCHAR(255) NOT NULL,
  label VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE pmd_options (
    id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  parameter VARCHAR(100) ,
  optvalue TEXT,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE pmd_payment (
   id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  pay_num bigint(20) NOT NULL,
  dari int(11) NOT NULL DEFAULT 0,
  kepada int(11) DEFAULT 0,
  subjek VARCHAR(200) ,
  pesan TEXT ,
  job VARCHAR(200) ,
  file VARCHAR(100) ,
  currency Currency,
  totalharga bigint(20) NOT NULL DEFAULT 0,
  total int(11) NOT NULL DEFAULT 0,
  totalharga_po bigint(20) NOT NULL DEFAULT 0,
  adddesc1 VARCHAR(200) NOT NULL,
  addjml1 bigint(20) NOT NULL,
  adddesc2 VARCHAR(200) NOT NULL,
  addjml2 bigint(20) NOT NULL,
  reddesc1 VARCHAR(200) NOT NULL,
  redjml1 bigint(20) NOT NULL,
  reddesc2 VARCHAR(200) NOT NULL,
  redjml2 bigint(20) NOT NULL,
  pay_message TEXT NOT NULL
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE pmd_po (
   id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  dari int(11) NOT NULL DEFAULT 0,
  kepada int(11) NOT NULL DEFAULT 0,
  subjek VARCHAR(255) ,
  pesan TEXT,
  job TEXT,
  pesan_po TEXT ,
  file VARCHAR(100) ,
  currency Currency,
  totalharga bigint(20) NOT NULL DEFAULT 0,
  totalharga_po bigint(20) NOT NULL,
  total int(11) NOT NULL DEFAULT 0,
  pay int(1) NOT NULL DEFAULT 0 COMMENT '0: belum dibayar, 1: sudah dibayar',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE pmd_projects (
  id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  name VARCHAR(120) ,
  client_id BINARY(16) NOT NULL,
  description TEXT ,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE pmd_projects ADD FOREIGN KEY (client_id) REFERENCES pmd_clients(id) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE pmd_quo (
   id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  quo bigint(20) NOT NULL DEFAULT 0,
  quo_status int(11) NOT NULL DEFAULT 0,
  tanggal bigint(20) NOT NULL DEFAULT 0,
  dari int(11) NOT NULL DEFAULT 0,
  kepada int(11) NOT NULL DEFAULT 0,
  subjek VARCHAR(200) ,
  pesan TEXT ,
  inq VARCHAR(200) ,
  file VARCHAR(100) ,
  currency Currency ,
  totalharga bigint(20) NOT NULL DEFAULT 0,
  total_inqharga bigint(20) NOT NULL DEFAULT 0 COMMENT 'Total harga murni dari tabel inq',
  total int(11) NOT NULL DEFAULT 0,
  vatjml bigint(20) NOT NULL DEFAULT 0,
  quo_message TEXT NOT NULL,
  bank_adm bigint(20) NOT NULL DEFAULT 0,
  shipping bigint(20) NOT NULL DEFAULT 0,
  discount bigint(20) NOT NULL DEFAULT 0,
  amount VARCHAR(200) NOT NULL,
  est_time VARCHAR(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

CREATE TABLE pmd_user (
    id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  status ENUM ('Aktif', 'Non Aktif') DEFAULT 'Aktif',
  name VARCHAR(128) ,
  email VARCHAR(128) ,
  address TEXT,
  phone VARCHAR(50) ,
  pic VARCHAR(128) ,
  password TEXT,
  role ENUM ('Translator', 'In-House' ,'Editor', 'Project Manager', 'Manager', 'Finance',  'Director') NOT NULL ,
  description TEXT ,
  tanggal bigint(20) NOT NULL DEFAULT 0,
  currency Currency,
  word int(11) NOT NULL DEFAULT 0,
  minute int(11) NOT NULL DEFAULT 0,
  hour int(11) NOT NULL DEFAULT 0,
  day int(11) NOT NULL DEFAULT 0,
  sheet int(11) NOT NULL DEFAULT 0,
  th_word int(11) NOT NULL DEFAULT 0,
  th_minute int(11) NOT NULL DEFAULT 0,
  th_hour int(11) NOT NULL DEFAULT 0,
  th_day int(11) NOT NULL DEFAULT 0,
  th_sheet int(11) NOT NULL DEFAULT 0,
  langrate VARCHAR(712) NOT NULL,
  rt_quality decimal(10,2) NOT NULL,
  rt_responsiv decimal(10,2) NOT NULL,
  rt_puncuality decimal(10,2) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TYPE Country AS ENUM ('ID','UK','US')
CREATE TYPE TimeZone AS ENUM ('WIB','WITA','WIT')

CREATE TABLE pmd_user_translator (
    id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  user_id BINARY(16),
  title VARCHAR(128) NOT NULL,
  first_name VARCHAR(128) NOT NULL,
  middle_name VARCHAR(128),
  last_name VARCHAR(128) NOT NULL,
  gender ENUM ('Male','Female'),
  date_of_birth Date NOT NULL,
  nationality Country NOT NULL,
  country Country NOT NULL,
  time_zone  TimeZone DEFAULT 'WIB',
  income_tax VARCHAR(128) NOT NULL,
  telp_home VARCHAR(64) NOT NULL,
  telp_office VARCHAR(64) NOT NULL,
  webpage VARCHAR(128) NOT NULL,
  secondary_email VARCHAR(128) NOT NULL,
  msn VARCHAR(128) NOT NULL,
  whatsapp VARCHAR(64) NOT NULL,
  skype VARCHAR(128) NOT NULL,
  other VARCHAR(128) NOT NULL,
  edu_institution VARCHAR(512) NOT NULL,
  edu_major VARCHAR(512) NOT NULL,
  edu_degree VARCHAR(512) NOT NULL,
  edu_year VARCHAR(512) NOT NULL,
  edu_graduate VARCHAR(512) NOT NULL,
  translating_since Date,
  -- tie_since varchar(128) NOT NULL,
  service_summary VARCHAR(128) NOT NULL,
  soft_tools VARCHAR(512) NOT NULL,
  langfrom1 VARCHAR(256) NOT NULL,
  langto1 VARCHAR(256) NOT NULL,
  lang VARCHAR(712) NOT NULL,
  level VARCHAR(10) NOT NULL,
  bidang VARCHAR(712) NOT NULL,
  score VARCHAR(512) NOT NULL,
  langrate VARCHAR(712) NOT NULL,
  langrate_editor VARCHAR(712) NOT NULL,
  wh_fullweek VARCHAR(128) NOT NULL,
  wh_fullweek_not VARCHAR(128) NOT NULL,
  wh_parttime VARCHAR(128) NOT NULL,
  capacity_daily VARCHAR(128) NOT NULL,
  charge_currency VARCHAR(128) NOT NULL,
  servicesfee_word VARCHAR(256) NOT NULL,
  servicesfee_hour VARCHAR(256) NOT NULL,
  servicesfee_minute VARCHAR(256) NOT NULL,
  servicesfee_character VARCHAR(256) NOT NULL,
  payment_paypal VARCHAR(128) NOT NULL,
  bank_owner_name VARCHAR(128) NOT NULL,
  bank_acc_number VARCHAR(128) NOT NULL,
  bank_name VARCHAR(128) NOT NULL,
  bank_branch VARCHAR(128) NOT NULL,
  bank_address TEXT NOT NULL,
  bank_swift VARCHAR(128) NOT NULL,
  bank_iban VARCHAR(128) NOT NULL,
  bank_owner_address TEXT NOT NULL,
  bank_owner_city VARCHAR(128) NOT NULL,
  bank_owner_zip VARCHAR(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE pmd_translator_languages (
    id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  translator_id BINARY(16),
  from Language NOT NULL,
  to Language NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE pmd_translator_work_experiances (
    id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  translator_id BINARY(16),
  company VARCHAR(128) NOT NULL,
  position VARCHAR(128) NOT NULL,
  start_date Date NOT NULL,
  end_date Date NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE pmd_file (
    id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  job_id int(11) NOT NULL DEFAULT 0,
  url TEXT ,
  word int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE pmd_inquiries (
   id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
   pm_id BINARY(16) NOT NULL,
   client_id BINARY(16) NOT NULL,
  ponum VARCHAR(100)  COMMENT 'Clients PO Number',
  nama VARCHAR(120) ,
  job_type VARCHAR(128) NOT NULL,
  langfrom VARCHAR(4) ,
  langto VARCHAR(4) ,
  langfrom_custom VARCHAR(20) ,
  langto_custom VARCHAR(20) ,
  ratetype VARCHAR(10) ,
  unit VARCHAR(10),
  total decimal(12,3) NOT NULL DEFAULT 0.000,
  rate bigint(20) NOT NULL DEFAULT 0,
  currency Currency,
  total bigint(20) NOT NULL DEFAULT 0,
  catatan TEXT ,
  status ENUM ('pending', 'proposed', 'approved') DEFAULT 'pending',
  inquiry_date DATE NOT NULL,
  approval_date DATE NOT NULL,
  file_source TEXT ,
  project int(11) NOT NULL DEFAULT 0 COMMENT '-1: unprojected',
  division VARCHAR(128) NOT NULL,
  client_status VARCHAR(128) NOT NULL,
  bank_adm bigint(20) NOT NULL,
  vat10 VARCHAR(10) NOT NULL,
  shipping bigint(20) NOT NULL,
  discount bigint(20) NOT NULL,
  daily_volume VARCHAR(512) NOT NULL,
  amount VARCHAR(512) NOT NULL,
  cat_tool VARCHAR(128) NOT NULL,
  ongoing_status VARCHAR(512) NOT NULL,
  trados VARCHAR(512) NOT NULL,
  min_currency VARCHAR(20) NOT NULL,
  min_charge bigint(20) NOT NULL,
  vendor VARCHAR(128) NOT NULL,
  est_time_frame VARCHAR(128) NOT NULL,
  last_update bigint(20) NOT NULL,
  quo int(2) NOT NULL,
  project_field VARCHAR(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE pmd_inv (
   id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  inv bigint(20) NOT NULL DEFAULT 0,
  inv_status int(11) NOT NULL DEFAULT 0,
  tanggal bigint(20) NOT NULL DEFAULT 0,
  dari int(11) NOT NULL DEFAULT 0,
  kepada int(11) NOT NULL DEFAULT 0,
  subjek VARCHAR(200) ,
  pesan TEXT ,
  job TEXT ,
  file VARCHAR(100) ,
  currency Currency ,
  totalharga bigint(20) NOT NULL DEFAULT 0,
  total_jobharga bigint(20) NOT NULL DEFAULT 0 COMMENT 'Total harga murni dari tabel job',
  total int(11) NOT NULL DEFAULT 0,
  adddesc1 VARCHAR(200) NOT NULL,
  addjml1 bigint(20) NOT NULL DEFAULT 0,
  adddesc2 VARCHAR(200) NOT NULL,
  addjml2 bigint(20) NOT NULL DEFAULT 0,
  paiddesc VARCHAR(200) NOT NULL,
  paidjml bigint(20) NOT NULL DEFAULT 0,
  discdesc VARCHAR(200) NOT NULL,
  discjml bigint(20) NOT NULL DEFAULT 0,
  ppndesc VARCHAR(200) NOT NULL,
  ppnjml bigint(20) NOT NULL DEFAULT 0,
  inv_message TEXT NOT NULL,
  bank VARCHAR(712) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE pmd_message (
   id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
  tipe int(2) NOT NULL DEFAULT 0 COMMENT '1: message, 2: activity',
  tanggal bigint(20) NOT NULL DEFAULT 0,
  message TEXT ,
  pengirim int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


--
-- Indexes for table pmd_inv
--
ALTER TABLE pmd_inv
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY id_2 (id),
  ADD KEY id (id),
  ADD KEY id_3 (id),
  ADD KEY id_4 (id);
--
-- Indexes for table pmd_payment
--
ALTER TABLE pmd_payment
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY id (id),
  ADD UNIQUE KEY id_2 (id),
  ADD KEY id_3 (id);

--
-- Indexes for table pmd_quo
--
ALTER TABLE pmd_quo
  ADD PRIMARY KEY (id) USING BTREE,
  ADD UNIQUE KEY id_2 (id) USING BTREE,
  ADD KEY id (id) USING BTREE,
  ADD KEY id_3 (id) USING BTREE,
  ADD KEY id_4 (id) USING BTREE;