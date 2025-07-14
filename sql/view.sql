CREATE OR REPLACE VIEW v_objets_emprunts AS
SELECT 
    o.id_objet,
    o.nom_objet,
    o.id_membre,
    o.id_categorie,
    c.nom_categorie,
    m.nom AS proprietaire,
    e.id_emprunt,
    e.date_emprunt,
    e.date_retour
FROM emprunt_objet o
JOIN emprunt_categorie_objet c ON o.id_categorie = c.id_categorie
JOIN emprunt_membre m ON o.id_membre = m.id_membre
LEFT JOIN emprunt_emprunt e ON o.id_objet = e.id_objet AND e.date_retour IS NULL;

SELECT * FROM v_objets_emprunts ;

CREATE OR REPLACE VIEW v_categorie_objet AS
SELECT ec.id_categorie, ec.nom_categorie, eo.id_objet, eo.nom_objet, eo.id_membre
FROM emprunt_categorie_objet ec
JOIN emprunt_objet eo ON ec.id_categorie = eo.id_categorie;
