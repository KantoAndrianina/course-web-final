-- EQUIPE
INSERT INTO equipes (nom, login, mdp)
VALUES ('Avengers', 'avengers', '123');


17:26
INSERT INTO equipes (nom, login, mdp)
VALUES ('GoldenState', 'GS', '123');

-- Etapes
INSERT INTO etapes (nom, longueur, nb_coureur,rang)
VALUES ('Betsizaraina', '2000', '50','1');

-- Coureurs
INSERT INTO coureurs (nom, numero, genre,date_naissance,equipe_id)
VALUES ('Jean', '1', 'homme',"2022-01-10",1);

INSERT INTO coureurs (nom, numero, genre,date_naissance,equipe_id)
VALUES ('Curry', '30', 'homme',"2019-01-10",2);

-- etape_details
INSERT INTO etape_details (etape_id, coureur_id, depart,arrivee,points)
VALUES ('Jean', '1', NULL,"2022-01-10",1);