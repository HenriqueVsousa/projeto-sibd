/*PRAGMA foreign_keys=ON;

DROP TABLE IF EXISTS weather;
DROP TABLE IF EXISTS reminder;
DROP TABLE IF EXISTS utilities;
DROP TABLE IF EXISTS site;
DROP TABLE IF EXISTS theme;
DROP TABLE IF EXISTS map;
DROP TABLE IF EXISTS user;*/

CREATE TABLE user(
  username VARCHAR PRIMARY KEY,
  email VARCHAR NOT NULL UNIQUE,
  password VARCHAR NOT NULL,
  location VARCHAR,
  constraint len check( LENGTH(password) >= 8)
);

CREATE TABLE map(
  name VARCHAR PRIMARY KEY,
  usr VARCHAR REFERENCES user
);

CREATE TABLE theme(
  name VARCHAR PRIMARY KEY DEFAULT('Theme'),
  map_name VARCHAR REFERENCES map
);

CREATE TABLE site(
  url VARCHAR NOT NULL PRIMARY KEY, --NOT NULL não estava incluído originalmente
  theme_name VARCHAR REFERENCES theme,
  map_name VARCHAR REFERENCES map
);

CREATE TABLE utilities(
  style VARCHAR PRIMARY KEY,
  user_name VARCHAR REFERENCES user
);

CREATE TABLE reminder(
  id INTEGER PRIMARY KEY,
  name VARCHAR DEFAULT('Nota'),
  note VARCHAR NOT NULL
  -- site_number INTEGER CHECK(site_number<=20),
  --reminder_data INTEGER,
  --reminder_style VARCHAR REFERENCES utilities,
  --reminder_site VARCHAR REFERENCES site
);

CREATE TABLE weather(
  id INTEGER PRIMARY KEY,
  weather_style VARCHAR REFERENCES utilities,
  min_temperature INTEGER,
  max_temperature INTEGER CHECK(max_temperature>min_temperature),
  humidity INTEGER
);
