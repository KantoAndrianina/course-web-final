create or replace view v_etapes as
    select * from etapes;

create or replace view v_coureurs as
    select * from coureurs;

create or replace view v_equipes as
    select * from equipes;

create or replace view v_penalites as
    select * from penalites;

create or replace view v_liste_etape_details as
    SELECT
        c.id id_coureur,
        c.nom AS nom_coureur,
        e.nb_coureur AS nb_coureur,
        e.id id_etape,
        e.nom AS nom_etape,
        eq.id id_equipe,
        eq.nom AS nom_equipe,
        TIMEDIFF(ed.arrivee, ed.depart) AS duree
    FROM
        etape_details ed
    JOIN v_coureurs c ON c.id = ed.coureur_id
    JOIN v_etapes e ON e.id = ed.etape_id
    JOIN v_equipes eq ON eq.id = c.equipe_id;

INSERT INTO categories (nom)
    SELECT 'Homme'
    WHERE NOT EXISTS (
        SELECT 1
        FROM categories
        WHERE nom = 'Homme'
    );
INSERT INTO categories (nom)
    SELECT 'Femme'
    WHERE NOT EXISTS (
        SELECT 1
        FROM categories
        WHERE nom = 'Femme'
    );
INSERT INTO categories (nom)
    SELECT 'Junior'
    WHERE NOT EXISTS (
        SELECT 1
        FROM categories
        WHERE nom = 'Junior'
    );

create or replace view v_categorie_coureurs as
    select c.id id_coureur, c.nom nom_coureur, numero, genre, date_naissance, cat.id id_categorie, cat.nom nom_categorie
    from categorie_coureurs cc
    join categories cat on cat.id = cc.categorie_id
    join v_coureurs c on c.id = cc.coureur_id;

create or replace view v_classement_details as
    SELECT
        ed.id,
        c.id id_coureur,
        c.nom AS nom_coureur,
        numero,
        genre,
        date_naissance,
        e.id id_etape,
        e.rang rang_etape,
        e.nom AS nom_etape,
        eq.id id_equipe,
        eq.nom AS nom_equipe,
        depart,
        IFNULL(arrivee, 'AUCUN TEMPS') arrivee,
        IFNULL(TIMEDIFF(ed.arrivee, ed.depart), 'AUCUN TEMPS') AS duree
    FROM
        etape_details ed
    JOIN v_coureurs c ON c.id = ed.coureur_id
    JOIN v_etapes e ON e.id = ed.etape_id
    JOIN v_equipes eq ON eq.id = c.equipe_id;

create or replace view v_classement_generals as
    SELECT 
        v.id_etape, 
        v.nom_etape,
        v.rang_etape,
        v.id_equipe, 
        v.nom_equipe,
        v.id_coureur,
        v.nom_coureur, 
        v.duree,
        IFNULL(p.points, 0) AS points
    FROM 
        (SELECT 
            t1.id_etape, 
            t1.nom_etape,
            t1.rang_etape,
            t1.id_equipe, 
            t1.nom_equipe,
            t1.id_coureur, 
            t1.nom_coureur, 
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

create or replace view v_classement_categories as
    select vcc.id_coureur, vcc.nom_coureur, vcc.numero, vcc.genre, vcc.date_naissance, id_categorie, nom_categorie, rang_etape, id_etape, nom_etape, id_equipe, nom_equipe, duree
    from v_categorie_coureurs vcc 
    join v_classement_details vcd on vcd.id_coureur = vcc.id_coureur;

create or replace view v_classement_categorie_points as
    SELECT 
        v.id_etape, 
        v.nom_etape,
        v.rang_etape,
        v.id_equipe, 
        v.nom_equipe,
        v.id_coureur,
        v.nom_coureur, 
        v.id_categorie, 
        v.nom_categorie, 
        v.duree,
        IFNULL(p.points, 0) AS points
    FROM 
        (SELECT 
            t1.id_etape, 
            t1.nom_etape,
            t1.rang_etape,
            t1.id_equipe, 
            t1.nom_equipe,
            t1.id_coureur, 
            t1.nom_coureur, 
            t1.id_categorie, 
            t1.nom_categorie, 
            t1.duree,
            (SELECT COUNT(DISTINCT t2.duree)
            FROM v_classement_categories t2
            WHERE t2.id_etape = t1.id_etape
                AND t2.id_categorie = t1.id_categorie
                AND t2.duree <= t1.duree) AS rang
        FROM 
            v_classement_categories t1) AS v
    LEFT JOIN 
        points p ON v.rang = p.classement
    ORDER BY 
        v.rang_etape, v.id_categorie, v.rang;

create or replace view v_classement_detail_penalites as
    select cd.id,id_coureur,nom_coureur,numero,genre,date_naissance,id_etape,rang_etape,nom_etape,id_equipe,nom_equipe,depart,arrivee,duree,p.id id_penal, IFNULL(penalite,'00:00:00') penalite, IFNULL(ADDTIME(duree, penalite),duree) temps_final, equipe_id
    from v_classement_details cd 
    left join v_penalites p on p.etape_id = cd.id_etape and p.equipe_id = cd.id_equipe
    order by rang_etape, id_equipe;

create or replace view v_classement_general_penalites as
    SELECT 
        v.id_etape, 
        v.nom_etape,
        v.rang_etape,
        v.id_equipe, 
        v.nom_equipe,
        v.id_coureur,
        v.nom_coureur, 
        v.duree,
        v.id_penal,
        v.penalite,
        v.temps_final,
        IFNULL(p.points, 0) AS points
    FROM 
        (SELECT 
            t1.id_etape, 
            t1.nom_etape,
            t1.rang_etape,
            t1.id_equipe, 
            t1.nom_equipe,
            t1.id_coureur, 
            t1.nom_coureur, 
            t1.duree,
            t1.id_penal,
            t1.penalite,
            t1.temps_final,
            (SELECT COUNT(DISTINCT t2.temps_final)
            FROM v_classement_detail_penalites t2
            WHERE t2.id_etape = t1.id_etape
                AND t2.temps_final <= t1.temps_final) AS rang
        FROM 
            v_classement_detail_penalites t1) AS v
    LEFT JOIN 
        points p ON v.rang = p.classement
    ORDER BY 
        v.id_etape, v.rang;

create or replace view v_classement_categorie_penalites as
    select vcc.id_coureur, vcc.nom_coureur, vcc.numero, vcc.genre, vcc.date_naissance, id_categorie, nom_categorie, rang_etape, id_etape, nom_etape, id_equipe, nom_equipe, duree, id_penal,penalite,temps_final
    from v_categorie_coureurs vcc 
    join v_classement_detail_penalites vcd on vcd.id_coureur = vcc.id_coureur;

create or replace view v_classement_categorie_point_penalites as
    SELECT 
        v.id_etape, 
        v.nom_etape,
        v.rang_etape,
        v.id_equipe, 
        v.nom_equipe,
        v.id_coureur,
        v.nom_coureur, 
        v.id_categorie, 
        v.nom_categorie, 
        v.duree,
        v.id_penal,
        v.penalite,
        v.temps_final,
        IFNULL(p.points, 0) AS points
    FROM 
        (SELECT 
            t1.id_etape, 
            t1.nom_etape,
            t1.rang_etape,
            t1.id_equipe, 
            t1.nom_equipe,
            t1.id_coureur, 
            t1.nom_coureur, 
            t1.id_categorie, 
            t1.nom_categorie, 
            t1.duree,
            t1.id_penal,
            t1.penalite,
            t1.temps_final,
            (SELECT COUNT(DISTINCT t2.temps_final)
            FROM v_classement_categorie_penalites t2
            WHERE t2.id_etape = t1.id_etape
                AND t2.id_categorie = t1.id_categorie
                AND t2.temps_final <= t1.temps_final) AS rang
        FROM 
            v_classement_categorie_penalites t1) AS v
    LEFT JOIN 
        points p ON v.rang = p.classement
    ORDER BY 
        v.rang_etape, v.id_categorie, v.rang;