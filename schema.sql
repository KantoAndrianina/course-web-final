CREATE DATABASE db_course;
Use db_course;

-- admin
CREATE TABLE users (
    id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    email_verified_at TIMESTAMP NULL DEFAULT NULL,
    password VARCHAR(255),
    remember_token VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE equipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(40),
    login VARCHAR(40),
    mdp VARCHAR(25)
);

CREATE TABLE coureurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    numero INT,
    genre VARCHAR(20),
    date_naissance DATE,
    equipe_id INT,
    FOREIGN KEY (equipe_id) REFERENCES equipes(id)
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(40)
);

CREATE TABLE etapes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    longueur DOUBLE,
    nb_coureur INT(5),
    rang INT(5)
);

CREATE TABLE categorie_coureurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categorie_id INT,
    coureur_id INT,
    FOREIGN KEY (categorie_id) REFERENCES categories(id),
    FOREIGN KEY (coureur_id) REFERENCES coureurs(id)
);

CREATE TABLE etape_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etape_id INT,
    coureur_id INT,
    depart DATETIME,
    arrivee DATETIME,
    points INT,
    FOREIGN KEY (etape_id) REFERENCES etapes(id),
    FOREIGN KEY (coureur_id) REFERENCES coureurs(id)
);

CREATE TABLE import_etapes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etape VARCHAR(50),
    longueur DOUBLE,
    nb_coureur INT,
    rang INT,
    date_départ DATE,
    heure_départ TIME
);

CREATE TABLE import_points (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classement INT,
    points INT
);

CREATE TABLE import_resultats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etape_rang INT,
    numero_dossard INT,
    nom VARCHAR(50),
    genre VARCHAR(20),
    date_naissance DATE,
    equipe VARCHAR(20),
    arrivee DATETIME
);

CREATE TABLE points (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classement INT,
    points INT
);

CREATE TABLE penalites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etape_id INT,
    equipe_id INT,
    penalite TIME,
    FOREIGN KEY (etape_id) REFERENCES etapes(id),
    FOREIGN KEY (equipe_id) REFERENCES equipes(id)
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255),
    description TEXT,
    slug VARCHAR(255)
);
