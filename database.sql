-- Database aanmaken
CREATE DATABASE IF NOT EXISTS promoteit CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE promoteit;

-- Tabellen verwijderen als ze bestaan
DROP TABLE IF EXISTS OPTREDEN;
DROP TABLE IF EXISTS PODIUM;
DROP TABLE IF EXISTS ARTIEST;
DROP TABLE IF EXISTS EVENEMENT;

-- Artiesten tabel
CREATE TABLE ARTIEST (
  ID int NOT NULL AUTO_INCREMENT,
  NAAM varchar(255) NOT NULL,
  OMSCHRIJVING text,
  PRIMARY KEY (ID)
);

INSERT INTO ARTIEST (NAAM, OMSCHRIJVING) VALUES
('Andre Hazes', 'De volkszanger van Nederland'),
('Kensington', 'Indiepopband met hits als Rood en Stom'),
('Maan', 'Popzangeres met hits als Liefde in de lucht en Spijt'),
('Guus Meeuwis', 'Zanger met hits als Het is een wonder en Beter dan je denkt'),
('Davina Michelle', 'Zangeres met hits als Duurt te lang en Skyward');

-- Evenementen tabel
CREATE TABLE EVENEMENT (
  ID int NOT NULL AUTO_INCREMENT,
  START_DATUM date NOT NULL,
  EIND_DATUM date NOT NULL,
  TITEL varchar(255) NOT NULL,
  OMSCHRIJVING text NOT NULL,
  PRIMARY KEY (ID)
);

INSERT INTO EVENEMENT (START_DATUM, EIND_DATUM, TITEL, OMSCHRIJVING) VALUES
('2024-06-23', '2024-06-25', 'Pinkpop', 'Het grootste popfestival van Nederland'),
('2024-07-07', '2024-07-09', 'Lowlands', 'Een alternatief festival met muziek theater en film'),
('2024-08-18', '2024-08-20', 'Mysteryland', 'Een dancefestival met elektronische muziek'),
('2024-09-02', '2024-09-04', 'Down The Rabbit Hole', 'Een festival met indie pop en elektronische muziek'),
('2024-10-13', '2024-10-15', 'Amsterdam Dance Event', 'Een dancefestival met bekende djs');

-- Podia tabel
CREATE TABLE PODIUM (
  ID int NOT NULL AUTO_INCREMENT,
  EVENEMENT_ID int NOT NULL,
  NAAM varchar(255) NOT NULL,
  OMSCHRIJVING text NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (EVENEMENT_ID) REFERENCES EVENEMENT(ID)
);

INSERT INTO PODIUM (EVENEMENT_ID, NAAM, OMSCHRIJVING) VALUES
(1, 'Main Stage', 'Het grootste podium op Pinkpop'),
(1, '3FM Stage', 'Een podium met alternatieve muziek'),
(2, 'Alpha', 'Het hoofdpodium op Lowlands'),
(2, 'Bravo', 'Een podium met theater en cabaret'),
(3, 'Mainstage', 'Het hoofdpodium op Mysteryland'),
(3, 'The Reactor', 'Een podium met techno en hardstyle'),
(4, 'Main Stage', 'Het hoofdpodium op Down The Rabbit Hole'),
(4, 'The Woods', 'Een podium met akoestische muziek'),
(5, 'Amsterdam Dance Arena', 'Het grootste podium op ADE'),
(5, 'Gashouder', 'Een podium met techno en house');

-- Optredens tabel
CREATE TABLE OPTREDEN (
  ID int NOT NULL AUTO_INCREMENT,
  EVENEMENT_ID int NOT NULL,
  PODIUM_ID int NOT NULL,
  ARTIEST_ID int NOT NULL,
  DATUM date NOT NULL,
  TIJD time NOT NULL,
  TITEL varchar(255) NOT NULL,
  OMSCHRIJVING text,
  PRIMARY KEY (ID),
  FOREIGN KEY (EVENEMENT_ID) REFERENCES EVENEMENT(ID),
  FOREIGN KEY (PODIUM_ID) REFERENCES PODIUM(ID),
  FOREIGN KEY (ARTIEST_ID) REFERENCES ARTIEST(ID)
);

INSERT INTO OPTREDEN (EVENEMENT_ID, PODIUM_ID, ARTIEST_ID, DATUM, TIJD, TITEL, OMSCHRIJVING) VALUES
(1, 1, 1, '2024-06-24', '16:00', 'Andre Hazes', 'Een show met al zijn bekende hits'),
(1, 2, 2, '2024-06-24', '18:00', 'Kensington', 'Een concert met hun nieuwste album'),
(2, 3, 3, '2024-07-08', '20:00', 'Maan', 'Een intieme show met haar akoestische nummers'),
(2, 4, 4, '2024-07-09', '14:00', 'Guus Meeuwis', 'Een meezingconcert met al zijn hits'),
(3, 5, 5, '2024-08-19', '22:00', 'Davina Michelle', 'Een energieke show met haar nieuwste hits'),
(4, 7, 1, '2024-09-03', '16:00', 'Andre Hazes', 'Een speciale middagshow'),
(5, 9, 2, '2024-10-14', '20:00', 'Kensington', 'Een spectaculaire afsluiter van ADE');
