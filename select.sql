18:49
SELECT
    coureurs.nom AS nom_coureur,
    etapes.nom AS nom_etape,
    IFNULL(TIMEDIFF(etape_details.arrivee, etape_details.depart),'Non terminé') AS duree
FROM
    coureurs
JOIN etape_details ON coureurs.id = etape_details.coureur_id
JOIN etapes ON etape_details.etape_id = etapes.id;
------------------------------------------------------------------
create or replace view v_classement_details as
SELECT
    ed.id,
    c.id id_coureur,
    c.nom AS nom_coureur,
    numero,
    e.id id_etape,
    e.nom AS nom_etape,
    eq.id id_equipe,
    eq.nom AS nom_equipe,
    depart,
    arrivee,
    TIMEDIFF(ed.arrivee, ed.depart) AS duree
FROM
    etape_details ed
JOIN coureurs c ON c.id = ed.coureur_id
JOIN etapes e ON e.id = ed.etape_id
JOIN equipes eq ON eq.id = c.equipe_id;
------------------------------------------------------------------
select nom_etape, nom_coureur,nom_equipe,duree, points
        from v_classement_details 
         GROUP BY nom_coureur,nom_etape,nom_equipe,duree, points
        ORDER BY  duree ASC


select nom_equipe, sum(points) points
        from v_classement_details 
         GROUP BY nom_equipe
        ORDER BY  nom_equipe ASC
SELECT
    nom_coureur,
    nom_etape,
    duree
FROM
    v_classement_details
WHERE
    nom_etape='Mahazo'
ORDER BY
    duree ASC
------------------------------------------------------------------
-- create or replace view v_classement_general as
-- SELECT
--     nom_coureur,
--     SEC_TO_TIME(SUM(TIME_TO_SEC(duree))) AS temps_total,
--     COUNT(nom_etape) nb_etape
-- FROM
--     v_classement_details
-- GROUP BY
--     nom_coureur, nom_etape
-- ORDER BY
--     COUNT(nom_etape) DESC, temps_total ASC



--Classe G par etape
select nom_etape, nom_coureur,duree
        from v_classement_details 
         GROUP BY nom_coureur,nom_etape,duree
        ORDER BY  duree ASC

--Classe G par equipe
select nom_equipe
        from v_classement_details 
         GROUP BY nom_equipe
        ORDER BY  nom_equipe ASC

 SELECT 
                    id_coureur, 
                    id_etape, 
                    duree,
                    CASE 
                        WHEN duree IS NULL THEN 0
                        WHEN ranking = 1 THEN 10
                        WHEN ranking = 2 THEN 6
                        WHEN ranking = 3 THEN 4
                        WHEN ranking = 4 THEN 2
                        WHEN ranking = 5 THEN 1
                        ELSE 0
                    END AS points
                FROM (
                    SELECT 
                        id_coureur, 
                        id_etape, 
                        duree,
                        @rank := IF(@prev_etape = id_etape, IF(@prev_duree = duree, @rank, @rank + @rank_inc), 1) AS ranking,
                        @rank_inc := IF(@prev_etape = id_etape, IF(@prev_duree = duree, 0, 1), 1),
                        @prev_etape := id_etape,
                        @prev_duree := duree
                    FROM 
                        v_classement_details,
                        (SELECT @rank := 0, @rank_inc := 1, @prev_etape := NULL, @prev_duree := NULL) r
                    WHERE 
                        id_etape = 1 
                    ORDER BY 
                        id_etape, 
                        CASE WHEN duree IS NULL THEN 1 ELSE 0 END, 
                        duree
                ) ranked
                ORDER BY id_etape, ranking


J2

select * from v_liste_etape_details
WHERE   id_etape = 1 

group by id_etape

-- INSERT into equipes (nom, login, mdp)
-- select DISTINCT equipe, equipe,equipe 
-- from import_resultats
-- where (equipe, equipe, equipe) not in (select nom,login, mdp from equipes)

-- INSERT into coureurs (nom,numero, genre, date_naissance, equipe_id)
-- select distinct i.nom nomcoureur, numero_dossard, genre, date_naissance, e.id equipe_id
-- from import_resultats i
-- join equipes e on e.nom = i.equipe
-- where (i.nom, numero_dossard, genre, date_naissance, e.id) not in (select nom,numero, genre, date_naissance, equipe_id from coureurs)

-- INSERT into etapes (nom,longueur,nb_coureur,rang)
-- select distinct etape,longueur,nb_coureur,rang
-- from import_etapes
-- where (etape,longueur,nb_coureur,rang) not in (select nom,longueur,nb_coureur,rang from etapes)

-- INSERT into etape_details (etape_id,coureur_id, depart,arrive)
-- select e.id etape_id, c.id coureur_id, CONCAT(ie.date_départ,' ',ie.heure_départ) date_heure_depart, ir.arrivee
-- from import_etapes ie
-- join import_resultats ir on ie.rang = ir.etape_rang
-- join coureurs c on  c.nom = ir.nom and c.numero = ir.numero_dossard and c.date_naissance = ir.date_naissance
-- join etapes e on  e.nom = ie.etape and e.longueur = ie.longueur and e.nb_coureur = ie.nb_coureur and e.rang = ie.rang
-- where (e.id , c.id, CONCAT(ie.date_départ,' ',ie.heure_départ), ir.arrivee) not in(select etape_id,coureur_id, depart,arrivee from etape_details)

-- INSERT into points (classement, points)
-- select  classement, points 
-- from import_points
-- where ( classement, points ) not in (select  classement, points from points)

SELECT 
    v.id_etape, 
    v.id_coureur, 
    v.id_equipe, 
    v.duree,
    v.rang,
    IFNULL(p.points, 0) AS points
FROM 
    (SELECT 
         t1.id_etape, 
         t1.id_coureur, 
         t1.id_equipe, 
         t1.duree,
         (SELECT COUNT(DISTINCT t2.duree)
          FROM v_classement_details t2
          WHERE t2.id_etape = t1.id_etape
            AND t2.duree <= t1.duree) AS rang
     FROM 
         v_classement_details t1) AS v
LEFT JOIN 
    points p ON v.rang = p.classement
ORDER BY 
    v.id_etape, v.rang;


SELECT 
    v.id_etape, 
    v.id_coureur, 
    IFNULL(p.points, 0) AS points
FROM 
    (SELECT 
         t1.id_etape, 
         t1.id_coureur, 
         (SELECT COUNT(DISTINCT t2.duree)
          FROM v_classement_details t2
          WHERE t2.id_etape = t1.id_etape
            AND t2.duree <= t1.duree) AS rang
     FROM 
         v_classement_details t1) AS v
LEFT JOIN 
    points p ON v.rang = p.classement
ORDER BY 
    v.id_etape, v.rang;


select *
from v_classement_detail_cats
where cat_id=5

select c.id id_coureur, c.nom nom_coureur, numero, genre, date_naissance, cat.id id_categorie, cat.nom nom_categorie
from categorie_coureurs cc
join categories cat on cat.id = cc.categorie_id
join coureurs c on c.id = cc.coureur_id

select vcc.id_coureur, vcc.nom_coureur, vcc.numero, vcc.genre, vcc.date_naissance, id_categorie, nom_categorie, id_etape, nom_etape, id_equipe, nom_equipe, duree
from v_categorie_coureurs vcc 
join v_classement_details vcd on vcd.id_coureur = vcc.id_coureur

SELECT 
    v.id_etape, 
    v.nom_etape,
    v.id_equipe, 
    v.nom_equipe,
    v.id_coureur,
    v.nom_coureur, 
    IFNULL(p.points, 0) AS points
FROM 
    (SELECT 
         t1.id_etape, 
         t1.nom_etape,
         t1.id_equipe, 
         t1.nom_equipe,
         t1.id_coureur, 
         t1.nom_coureur, 
         (SELECT COUNT(DISTINCT t2.duree)
          FROM v_classement_details t2
          WHERE t2.id_etape = t1.id_etape
            AND t2.duree <= t1.duree) AS rang
     FROM 
         v_classement_details t1) AS v
LEFT JOIN 
    points p ON v.rang = p.classement
ORDER BY 
    v.id_etape, v.rang;

    select id_equipe,nom_equipe,id_categorie,nom_categorie, sum(points) points
    from v_classement_categorie_points
    where id_categorie=5
    group by id_equipe,nom_equipe,id_categorie,nom_categorie

    SELECT c.id, cr.id
            FROM categories c
            JOIN coureurs cr
            ON (c.nom = 'Homme' AND cr.genre = 'M') OR 
            (c.nom = 'Femme' AND cr.genre = 'F') OR
            (c.nom = 'Junior' AND YEAR(cr.date_naissance) > 2006) 
            WHERE (c.id, cr.id) not in (select categorie_id, coureur_id from categorie_coureurs)
        
    SELECT c.id, cr.id
    FROM categories c
    JOIN coureurs cr
    ON (c.nom = 'Homme' AND cr.genre = 'M') OR 
    (c.nom = 'Femme' AND cr.genre = 'F') OR
    (c.nom = 'Junior' AND DATEDIFF(CURRENT_DATE, cr.date_naissance) / 365.25 < 18) 
    WHERE (c.id, cr.id) not in (select categorie_id, coureur_id from categorie_coureurs)

    select id_etape, rang_etape, nom_etape, id_coureur,nom_coureur, id_equipe, nom_equipe,id_categorie,nom_categorie, points
        from v_classement_categorie_points
        where id_categorie=4
        ORDER BY  nom_equipe ASC

    select cd.id,id_coureur,nom_coureur,numero,genre,date_naissance,id_etape,rang_etape,nom_etape,id_equipe,nom_equipe,depart,arrivee,duree,p.id id_penal, IFNULL(penalite,0) penalilte, IFNULL(ADDTIME(duree, penalite),0) temps_final
    from v_classement_details cd 
    left join v_penalites p on p.etape_id = cd.id_etape and p.equipe_id = cd.id_equipe

    select etape_id, nb_coureur,equipe_id,  count(equipe_id) nb_coureur_equipe
    from etape_details ed
    join v_etapes e on e.id = ed.etape_id
    join v_coureurs c on c.id = ed.coureur_id
    where equipe_id=122 
    group by etape_id, nb_coureur, equipe_id 

