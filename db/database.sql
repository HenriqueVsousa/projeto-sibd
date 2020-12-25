--
-- File generated with SQLiteStudio v3.2.1 on qui dez 24 18:14:05 2020
--
-- Text encoding used: System
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: map
DROP TABLE IF EXISTS map;
CREATE TABLE map (id INTEGER PRIMARY KEY ASC AUTOINCREMENT, name VARCHAR NOT NULL, usr INTEGER REFERENCES user (id) ON DELETE CASCADE ON UPDATE NO ACTION NOT NULL);
INSERT INTO map (id, name, usr) VALUES (1, 'SUN', '1');

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
INSERT INTO site (id, url, theme_id) VALUES (11, 'https://s2.sfgame.com.pt/', 6);
INSERT INTO site (id, url, theme_id) VALUES (12, 'https://soundcloud.com/0143-0111-0303-4111', 6);
INSERT INTO site (id, url, theme_id) VALUES (13, 'https://soundcloud.com/0143-0111-0303-4111', 7);
INSERT INTO site (id, url, theme_id) VALUES (14, 'https://soundcloud.com/0143-0111-0303-4111', 8);
INSERT INTO site (id, url, theme_id) VALUES (15, 'https://www.whosampled.com/', 9);
INSERT INTO site (id, url, theme_id) VALUES (16, 'https://www.residentadvisor.net/', 6);
INSERT INTO site (id, url, theme_id) VALUES (17, 'http://localhost:8080/login5/home.php', 6);
INSERT INTO site (id, url, theme_id) VALUES (18, 'https://www.whosampled.com/', 6);
INSERT INTO site (id, url, theme_id) VALUES (19, 'https://en.wikipedia.org/wiki/Ernest_Hemingway', 6);
INSERT INTO site (id, url, theme_id) VALUES (20, 'http://www.portugalsurfguide.pt/spots', 6);

-- Table: theme
DROP TABLE IF EXISTS theme;
CREATE TABLE theme (
  id INTEGER PRIMARY KEY ASC AUTOINCREMENT,
  name VARCHAR DEFAULT theme_defaut,
  map_id INTEGER REFERENCES map (id) ON DELETE CASCADE ON UPDATE CASCADE NOT NULL
);
INSERT INTO theme (id, name, map_id) VALUES (6, '0111', 1);
INSERT INTO theme (id, name, map_id) VALUES (7, '0303', 1);
INSERT INTO theme (id, name, map_id) VALUES (8, 'games', 1);
INSERT INTO theme (id, name, map_id) VALUES (9, 'budealin', 1);

-- Table: user
DROP TABLE IF EXISTS user;
CREATE TABLE user (id INTEGER PRIMARY KEY ASC AUTOINCREMENT, username VARCHAR NOT NULL UNIQUE, email VARCHAR NOT NULL UNIQUE, password VARCHAR NOT NULL, location VARCHAR DEFAULT NULL, CONSTRAINT len CHECK (LENGTH(password) >= 8));
INSERT INTO user (id, username, email, password, location) VALUES (1, 'zuble', '1234@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Urca');

-- Table: utilities
DROP TABLE IF EXISTS utilities;
CREATE TABLE utilities (style VARCHAR PRIMARY KEY, user_id VARCHAR REFERENCES user (id) ON DELETE NO ACTION ON UPDATE NO ACTION);

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
