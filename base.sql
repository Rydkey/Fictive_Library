DROP TABLE IF EXISTS EMPRUNT;
DROP TABLE IF EXISTS EXEMPLAIRE;
DROP TABLE IF EXISTS OEUVRE;
DROP TABLE IF EXISTS AUTEUR;
DROP TABLE IF EXISTS ADHERENT;

CREATE TABLE IF NOT EXISTS ADHERENT(
idAdherent INT NOT NULL AUTO_INCREMENT,
nomAdherent VARCHAR (25),
adresse VARCHAR (50),
datePaiement DATE,
PRIMARY KEY (idAdherent)
)ENGINE=InnoDB DEFAULT CHARSET=	utf8;

CREATE TABLE IF NOT EXISTS AUTEUR(
idAuteur INT NOT NULL AUTO_INCREMENT,
nomAuteur VARCHAR (25),
prenomAuteur VARCHAR (25),
PRIMARY KEY (idAuteur)
)ENGINE=InnoDB DEFAULT CHARSET=	utf8;

CREATE TABLE IF NOT EXISTS OEUVRE(
noOeuvre INT NOT NULL AUTO_INCREMENT,
titre VARCHAR (100),
dateParution DATE,
idAuteur INT,
PRIMARY KEY (noOeuvre),
CONSTRAINT fkOeuvreAuteur FOREIGN KEY (idAuteur) REFERENCES AUTEUR(idAuteur)ON DELETE CASCADE
)ENGINE=InnoDB;
/*DEFAULT CHARSET=	utf8;*/


CREATE TABLE IF NOT EXISTS EXEMPLAIRE(
noExemplaire INT NOT NULL AUTO_INCREMENT,
etat VARCHAR (25),
dateAchat DATE,
prix INT(6),
noOeuvre INT,
CONSTRAINT fkExemplaireOeuvre FOREIGN KEY (noOeuvre) REFERENCES OEUVRE(noOeuvre)ON DELETE CASCADE ,
PRIMARY KEY (noExemplaire)
)ENGINE=InnoDB DEFAULT CHARSET=	utf8;

CREATE TABLE IF NOT EXISTS EMPRUNT(
idAdherent INT ,
noExemplaire INT ,
dateEmprunt DATE,
dateRendu DATE,
PRIMARY KEY (idAdherent,noExemplaire,dateEmprunt),
CONSTRAINT fkAdherentEmprunt FOREIGN KEY (idAdherent) REFERENCES ADHERENT(idAdherent)ON DELETE CASCADE,
CONSTRAINT fkExemplaireEmprunt FOREIGN KEY (noExemplaire) REFERENCES EXEMPLAIRE(noExemplaire)ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=	utf8;
INSERT INTO ADHERENT VALUES
(1,'millet','Montbeliard','2015-11-03'),
(2,'lauvernay','sevenans','2015-06-13'),
(3,'axelrad','sevenans','2016-01-12'),
(4,'bedez','hericourt','2015-03-17'),
(5,'berger','les glacis','2009-11-03'),
(6,'cambot','sevenans','2014-12-15'),
(7,'bonilla','sochaux','2015-03-17'),
(8,'asproitis','grenoble','2015-12-04'),
(9,'pereira','danjoutin','2014-11-03'),
(10,'dupont','grenoble','2015-03-14'),
(11,'durant','belfort','2014-12-16'),
(12,'piton','belfort','2015-11-03'),
(13,'durant','paris','2015-11-03');
INSERT INTO AUTEUR VALUES
(1,'Christie','agatha'),
(2,'Chateaubriand',''),
(3,'Flaubert',''),
(4,'Prevert',''),
(5,'De la fontaine','jean'),
(6,'Daudet',''),
(7,'hugo','victor'),
(8,'kessel',''),
(9,'duras',''),
(10,'Proust','marcel'),
(11,'Zola','émile'),
(12,'Highsmith',''),
(13,'Kipling',''),
(14,'Azimov',''),
(15,'Baudelaire',''),
(16,'Moliere','');
INSERT INTO OEUVRE VALUES
(1,'le retour de Poirot','1992-02-12',1),
(2,'Poirot quitte la scene','1992-05-01',1),
(3,'dix breves rencontres','1992-10-01',1),
(4,'le miroir de la mort','1992-01-01',1),
(5,'paroles','1992-03-01',4),
(6,'une creature de reve','1992-02-01',12),
(7,'mémoire d’outre-tombe',NULL,2),
(8,'Madame de Bovary',NULL,3),
(9,'un amour de de swam',NULL,9),
(10,'les femmes savantes',NULL,16),
(11,'le misanthrope',NULL,16),
(12,'Les fleurs du mal',NULL,15),
(13,'petits poemes en prose','',15),
(14,'les mondes perdus','1980-05-06',14),
(15,'La guerre des mondes','1970-03-15',14),
(16,'spectacles','1948-05-12',4),
(17,'Les fables',NULL,5),
(18,'Le triomphe de l’amour','1980-05-06',5),
(19,'le livre de la jungle',NULL,13),
(20,'kim','1901-07-01',13),
(21,'le marin de Gibraltar','1952-07-12',9),
(22,'l’assommoir',NULL,11),
(23,'j’accuse',NULL,11),
(24,'la terre',NULL,10);

INSERT INTO EXEMPLAIRE VALUES
(1,'BON','2015-08-25',13,1),
(2,'MOYEN','2013-09-28',12,1),
(3,'MOYEN','2015-05-26',12,1),
(4,'BON','2007-01-11',10,1),
(5,'MAUVAIS','2014-10-29',13,2),
(6,'NEUF','2015-10-29',20,2),
(7,'BON','2014-12-27',7,3),
(8,'MOYEN','2014-09-25',13,3),
(9,'NEUF','2006-12-29',18,4),
(10,'NEUF','2006-12-29',21,4),
(11,'BON','2009-04-29',26,5),
(12,'MAUVAIS','2015-10-27',22,6),
(13,'BON','2015-01-24',22,6),
(14,'BON','2015-05-01',28,7),
(15,'MAUVAIS','2015-01-26',28,7),
(16,'BON','2015-01-24',30,8),
(17,'BON','2015-01-23',32,9),
(18,'MAUVAIS','2007-01-29',17,10),
(19,'BON','2014-10-29',18,10),
(20,'BON','2014-10-29',18,10),
(21,'BON','2014-10-29',19,10),
(22,'BON','2015-01-26',20,11),
(23,'BON','2015-10-29',21,12),
(24,'MAUVAIS','2015-01-24',22,13),
(25,'BON','2007-01-28',22,13),
(26,'MAUVAIS','2015-01-23',26,14),
(27,'MOYEN','2006-12-26',13,14),
(28,'BON','2015-02-23',12,15),
(29,'BON','2015-10-29',15,15),
(30,'MAUVAIS','2015-01-26',32,16),
(31,'BON','2015-01-23',19,17),
(32,'MAUVAIS','2013-10-29',19,17),
(33,'BON','2014-01-23',20,17),
(34,'BON','2015-01-25',11,18),
(35,'MAUVAIS','2014-10-29',15,18),
(36,'NEUF','2015-10-29',18,18),
(37,'BON','2015-01-23',8,19),
(38,'MAUVAIS','2014-09-28',18,20),
(39,'BON','2014-12-26',18,20),
(40,'BON','2015-01-23',11,24);

INSERT INTO EMPRUNT VALUES
(3,9,'2015-06-25','2015-06-30'),
(10,6,'2015-06-22','2015-07-23'),
(3,7,'2015-06-22','2015-07-29'),
(1,19,'2015-07-26','2015-07-31'),
(1,34,'2015-07-23','2015-08-20'),
(1,11,'2015-07-26','2015-08-21'),
(2,40,'2015-07-23','2015-08-23'),
(3,5,'2015-07-26','2015-08-23'),
(2,35,'2015-07-13','2015-09-21'),
(5,40,'2015-07-25','2015-09-22'),
(8,9,'2015-07-26','2015-09-22'),
(5,12,'2015-07-25','2015-09-23'),
(2,5,'2015-08-23','2015-09-23'),
(1,15,'2015-09-23','2015-09-26'),
(6,2,'2015-09-21','2015-09-28'),
(12,38,'2015-07-26','2015-10-22'),
(2,18,'2015-09-23','2015-10-28'),
(3,5,'2015-11-23','2015-12-24'),
(3,40,'2015-11-23','2015-12-24'),
(1,37,'2015-08-11',NULL),
(13,27,'2015-08-22',NULL),
(13,6,'2015-08-25',NULL),
(8,33,'2015-08-30',NULL),
(13,13,'2015-09-04',NULL),
(3,3,'2015-09-13',NULL),
(10,19,'2015-09-21',NULL),
(2,5,'2015-09-29',NULL);


update EMPRUNT set dateRendu=NULL where dateRendu="0000­-00-­00";
update OEUVRE set dateParution=NULL where dateParution="0000­-00-­00";
SELECT * FROM ADHERENT;
SELECT * FROM AUTEUR;
SELECT * FROM OEUVRE;
SELECT * FROM EXEMPLAIRE;
SELECT * FROM EMPRUNT;
SELECT COUNT(dateEmprunt) FROM EMPRUNT WHERE dateEmprunt NOT NULL;