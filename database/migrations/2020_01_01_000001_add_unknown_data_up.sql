INSERT INTO
  timezones
(id,
 created_at,
 updated_at,
 deleted_at,
 is_day_light_saving,
 name,
 display_name,
 raw_offset,
 raw_offset_minutes,
 day_light_display_name,
 day_light_raw_offset,
 day_light_raw_offset_minutes)
VALUES
  (0, '2024-01-01 00:00:00', '2024-01-01 00:00:00', NULL, FALSE, 'Unknown', 'Unknown', 0, 0, '', 0, 0);

INSERT INTO
  countries
(id,
 created_at,
 updated_at,
 deleted_at,
 continent_id,
 is_active,
 iso_code,
 iso_three_code,
 iso_numeric,
 name,
 official_name,
 emoji,
 latitude,
 longitude,
 latitude_max,
 latitude_min,
 longitude_max,
 longitude_min)
VALUES
  (0,
   '2024-01-01 00:00:00',
   '2024-01-01 00:00:00',
   NULL,
   0,
   TRUE,
   '',
   '',
   0,
   'Unknown',
   'Unknown',
   '',
   0,
   0,
   0,
   0,
   0,
   0);

INSERT INTO
  languages
(id, created_at, updated_at, deleted_at, code, three_letter_code, name, local_name)
VALUES
  (0, '2024-01-01 00:00:00', '2024-01-01 00:00:00', NULL, NULL, '', 'Unknown', 'Unknown');

INSERT INTO
  currencies
(id,
 created_at,
 updated_at,
 symbol,
 locale_symbol,
 en_symbol,
 code,
 numeric_code,
 name,
 full_name,
 minor_name,
 minor_symbol,
 smallest_value_text,
 decimal_places)
VALUES
  (0, '2024-01-01 00:00:00', '2024-01-01 00:00:00', '', '', '', '', 0, 'Unknown', 'Unknown', 'Unknown', '', '0', 0);

INSERT INTO
  country_timezones
(id, created_at, updated_at, country_id, timezone_id)
VALUES
  (0, '2024-01-01 00:00:00', '2024-01-01 00:00:00', 0, 0);

INSERT INTO
  country_languages
(id, created_at, updated_at, country_id, language_id)
VALUES
  (0, '2024-01-01 00:00:00', '2024-01-01 00:00:00', 0, 0);

INSERT INTO
  country_currencies
(id, created_at, updated_at, country_id, currency_id)
VALUES
  (0, '2024-01-01 00:00:00', '2024-01-01 00:00:00', 0, 0);

