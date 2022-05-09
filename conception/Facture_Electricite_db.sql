CREATE TABLE Fournisseur(
   nom_fournisseur VARCHAR(50),
   adresse_fournisseur VARCHAR(100) NOT NULL,
   email_fournisseur VARCHAR(50) NOT NULL,
   tel_fournisseur VARCHAR(15) NOT NULL,
   PRIMARY KEY(nom_fournisseur)
);

CREATE TABLE Agent(
   Id_Agent INT AUTO_INCREMENT,
   cin VARCHAR(10) NOT NULL,
   nom VARCHAR(30) NOT NULL,
   prenom VARCHAR(30) NOT NULL,
   nom_fournisseur VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Agent),
   FOREIGN KEY(nom_fournisseur) REFERENCES Fournisseur(nom_fournisseur)
);

CREATE TABLE Zone_géographique(
   ville VARCHAR(30),
   Id_Agent VARCHAR(20) NOT NULL,
   PRIMARY KEY(ville),
   UNIQUE(Id_Agent),
   FOREIGN KEY(Id_Agent) REFERENCES Agent(Id_Agent)
);

CREATE TABLE Client(
   Id_Client INT AUTO_INCREMENT,
   cin VARCHAR(10) NOT NULL,
   nom VARCHAR(40) NOT NULL,
   prenom VARCHAR(40) NOT NULL,
   email VARCHAR(50),
   telephone VARCHAR(15) NOT NULL,
   adresse VARCHAR(100) NOT NULL,
   ville VARCHAR(30) NOT NULL,
   nom_fournisseur VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Client),
   FOREIGN KEY(ville) REFERENCES Zone_géographique(ville),
   FOREIGN KEY(nom_fournisseur) REFERENCES Fournisseur(nom_fournisseur)
);

CREATE TABLE Consommation(
   id_Consommation INT AUTO_INCREMENT,
   mois_consommation DATE NOT NULL,
   quantite VARCHAR(50) NOT NULL,
   Id_Client INT NOT NULL,
   PRIMARY KEY(id_Consommation),
   FOREIGN KEY(Id_Client) REFERENCES Client(Id_Client)
);

CREATE TABLE Facture(
   id_Facture INT AUTO_INCREMENT,
   date_facture DATE NOT NULL,
   consommation VARCHAR(50) NOT NULL,
   montant_ht FLOAT NOT NULL,
   montant_ttc FLOAT NOT NULL,
   nom_client VARCHAR(40) NOT NULL,
   prenom_client VARCHAR(40) NOT NULL,
   adresse_client VARCHAR(100) NOT NULL,
   id_Consommation INT NOT NULL,
   nom_fournisseur VARCHAR(50) NOT NULL,
   Id_Client INT NOT NULL,
   PRIMARY KEY(id_Facture),
   FOREIGN KEY(id_Consommation) REFERENCES Consommation(id_Consommation),
   FOREIGN KEY(nom_fournisseur) REFERENCES Fournisseur(nom_fournisseur),
   FOREIGN KEY(Id_Client) REFERENCES Client(Id_Client)
);

CREATE TABLE Réclamation(
   id_Reclamation INT AUTO_INCREMENT,
   date_reclamation DATETIME NOT NULL,
   description VARCHAR(200) NOT NULL,
   Id_Client INT NOT NULL,
   PRIMARY KEY(id_Reclamation),
   FOREIGN KEY(Id_Client) REFERENCES Client(Id_Client)
);
