--
-- File generated with SQLiteStudio v3.2.1 on qua dez 16 20:40:50 2020
--
-- Text encoding used: System
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: user
CREATE TABLE user (
  username VARCHAR PRIMARY KEY NOT NULL,
  email VARCHAR NOT NULL UNIQUE,
  password VARCHAR NOT NULL,
  location VARCHAR DEFAULT NULL,
  CONSTRAINT len CHECK (LENGTH(password) >= 8)
);

INSERT INTO user (username, email, password, location) VALUES ('zuble', '123@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '');

-- Table: map
CREATE TABLE map (
    id   INTEGER PRIMARY KEY ASC AUTOINCREMENT,
    name VARCHAR NOT NULL,
    usr  VARCHAR REFERENCES user (id) ON DELETE CASCADE ON UPDATE NO ACTION NOT NULL
);

INSERT INTO map (id, name, usr) VALUES (1, 'SUN', 'zuble');

-- Table: theme
CREATE TABLE theme (
  id INTEGER PRIMARY KEY ASC AUTOINCREMENT,
  name VARCHAR DEFAULT theme_defaut,
  map_id INTEGER REFERENCES map (id) ON DELETE CASCADE ON UPDATE CASCADE NOT NULL
);

INSERT INTO theme (id, name, map_id) VALUES (1, 'theme_default', 1);

-- Table: site
CREATE TABLE site (
    id       INTEGER PRIMARY KEY ASC AUTOINCREMENT,
    url      VARCHAR NOT NULL,
    theme_id INTEGER REFERENCES theme (id) ON DELETE SET DEFAULT DEFAULT theme_default
);

-- Table: reminder
CREATE TABLE reminder(
  id INTEGER PRIMARY KEY,
  name VARCHAR DEFAULT('Nota'),
  note VARCHAR NOT NULL
  -- site_number INTEGER CHECK(site_number<=20),
  --reminder_data INTEGER,
  --reminder_style VARCHAR REFERENCES utilities,
  --reminder_site VARCHAR REFERENCES site
);

CREATE TABLE utilities (
    style   VARCHAR PRIMARY KEY,
    user_id VARCHAR REFERENCES user (id) ON DELETE NO ACTION
                                         ON UPDATE NO ACTION
);

-- Table: weather
CREATE TABLE weather (
  id              INTEGER PRIMARY KEY,
  weather_style   VARCHAR REFERENCES utilities,
  min_temperature INTEGER,
  max_temperature INTEGER CHECK (max_temperature > min_temperature),
  humidity        INTEGER
);
COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
