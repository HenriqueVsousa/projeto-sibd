PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: map
DROP TABLE IF EXISTS map;
CREATE TABLE map (
    id           INTEGER PRIMARY KEY ASC AUTOINCREMENT,
    name         VARCHAR NOT NULL,
    usr          INTEGER REFERENCES user (id) ON DELETE CASCADE ON UPDATE NO ACTION NOT NULL,
    theme_number INTEGER CHECK (theme_number <= 9)
);

-- Table: reminder
DROP TABLE IF EXISTS reminder;
CREATE TABLE reminder(
  id INTEGER PRIMARY KEY,
  name VARCHAR DEFAULT('Nota'),
  note VARCHAR NOT NULL,
  usr INTEGER REFERENCES user (id) ON DELETE CASCADE ON UPDATE NO ACTION NOT NULL
  -- site_number INTEGER CHECK(site_number<=20),
  --reminder_data INTEGER,
  --reminder_style VARCHAR REFERENCES utilities,
  --reminder_site VARCHAR REFERENCES site
);

-- Table: site
DROP TABLE IF EXISTS site;
CREATE TABLE site (
    id       INTEGER PRIMARY KEY ASC AUTOINCREMENT,
    url      VARCHAR NOT NULL,
    theme_id INTEGER REFERENCES theme (id) ON DELETE SET DEFAULT DEFAULT theme_default
);

-- Table: theme
DROP TABLE IF EXISTS theme;
CREATE TABLE theme (
id INTEGER PRIMARY KEY ASC AUTOINCREMENT,
name VARCHAR DEFAULT theme_defaut,
map_id INTEGER REFERENCES map (id) ON DELETE CASCADE ON UPDATE CASCADE NOT NULL
);

-- Table: user
DROP TABLE IF EXISTS user;
CREATE TABLE user (
id INTEGER PRIMARY KEY ASC AUTOINCREMENT,
username VARCHAR NOT NULL UNIQUE,
email VARCHAR NOT NULL UNIQUE,
password VARCHAR NOT NULL,
location VARCHAR DEFAULT NULL,
CONSTRAINT len CHECK (LENGTH(password) >= 8)
);

-- Table: utilities
DROP TABLE IF EXISTS utilities;
CREATE TABLE utilities (
style VARCHAR PRIMARY KEY,
user_id VARCHAR REFERENCES user (id) ON DELETE NO ACTION ON UPDATE NO ACTION);

-- Table: weather
DROP TABLE IF EXISTS weather;
CREATE TABLE weather(
  id INTEGER PRIMARY KEY,
  weather_style VARCHAR REFERENCES utilities,
  min_temperature INTEGER,
  max_temperature INTEGER CHECK(max_temperature>min_temperature),
  humidity INTEGER
);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
