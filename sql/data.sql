CREATE OR REPLACE DATABASE emprunt;

CREATE TABLE emprunt_membre(
    id_membre INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    gender      ENUM ('M','F')  NOT NULL,  
    email VARCHAR(100) NOT NULL,
    mots_de_passe VARCHAR(255) NOT NULL,
    img_prpfile VARCHAR(255)
);

CREATE TABLE emprunt_categorie_objet(
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom_categorie VARCHAR(100) NOT NULL
);
CREATE TABLE emprunt_objet(
    id_objet INT PRIMARY KEY AUTO_INCREMENT,
    nom_objet VARCHAR(100) NOT NULL,
    id_membre INT NOT NULL,
    id_categorie INT NOT NULL,
    FOREIGN KEY (id_membre) REFERENCES emprunt_membre(id_membre),
    FOREIGN KEY (id_categorie) REFERENCES emprunt_categorie_objet(id_categorie)
);
CREATE TABLE emprunt_image(
    id_image INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT NOT NULL,
    FOREIGN KEY (id_objet) REFERENCES emprunt_objet(id_objet),
    nom_image VARCHAR(255) NOT NULL
);
CREATE TABLE emprunt_emprunt(
    id_emprunt INT PRIMARY KEY AUTO_INCREMENT,
    id_membre INT NOT NULL,
    FOREIGN KEY (id_membre) REFERENCES emprunt_membre(id_membre),
    id_objet INT NOT NULL,
    FOREIGN KEY (id_objet) REFERENCES emprunt_objet(id_objet),
    date_emprunt DATE NOT NULL,
    date_retour DATE
);

INSERT INTO emprunt_membre (nom, date_naissance, gender, email, mots_de_passe, img_prpfile) VALUES
('Alice', '1995-06-15', 'F', 'alice@example.com', 'mdp123', 'alice.jpg'),
('Bob', '1990-12-01', 'M', 'bob@example.com', 'mdp456', 'bob.jpg'),
('Claire', '1988-03-22', 'F', 'claire@example.com', 'mdp789', 'claire.jpg'),
('David', '1992-09-10', 'M', 'david@example.com', 'mdp000', 'david.jpg');

INSERT INTO emprunt_categorie_objet (nom_categorie) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');

-- Objets pour Alice (id_membre = 1)
INSERT INTO emprunt_objet (nom_objet, id_membre, id_categorie) VALUES
('Sèche-cheveux', 1, 1),
('Fer à lisser', 1, 1),
('Trousse manucure', 1, 1),
('Perceuse', 1, 2),
('Tournevis', 1, 2),
('Clé à molette', 1, 3),
('Jack moteur', 1, 3),
('Blender', 1, 4),
('Four', 1, 4),
('Grille-pain', 1, 4);

-- Objets pour Bob (id_membre = 2)
INSERT INTO emprunt_objet (nom_objet, id_membre, id_categorie) VALUES
('Scie sauteuse', 2, 2),
('Pistolet à colle', 2, 2),
('Clé anglaise', 2, 3),
('Compresseur', 2, 3),
('Bouilloire', 2, 4),
('Cafetière', 2, 4),
('Épilateur', 2, 1),
('Brosse chauffante', 2, 1),
('Rabot électrique', 2, 2),
('Friteuse', 2, 4);

-- Objets pour Claire (id_membre = 3)
INSERT INTO emprunt_objet (nom_objet, id_membre, id_categorie) VALUES
('Steamer', 3, 1),
('Brosse visage', 3, 1),
('Ciseaux électriques', 3, 2),
('Visseuse', 3, 2),
('Polisseuse', 3, 3),
('Multimètre', 3, 3),
('Mixeur', 3, 4),
('Four micro-ondes', 3, 4),
('Grill', 3, 4),
('Râpe électrique', 3, 4);

-- Objets pour David (id_membre = 4)
INSERT INTO emprunt_objet (nom_objet, id_membre, id_categorie) VALUES
('Rasoir électrique', 4, 1),
('Tondeuse barbe', 4, 1),
('Dévisseuse', 4, 2),
('Marteau', 4, 2),
('Crics', 4, 3),
('Pompe hydraulique', 4, 3),
('Plaque chauffante', 4, 4),
('Plancha', 4, 4),
('Cuit vapeur', 4, 4),
('Balance cuisine', 4, 4);

INSERT INTO emprunt_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(5, 2, '2025-07-01', NULL),
(6, 3, '2025-07-02', NULL),
(10, 4, '2025-07-03', NULL),
(15, 1, '2025-07-04', NULL),
(20, 3, '2025-07-05', NULL),
(25, 1, '2025-07-06', NULL),
(30, 2, '2025-07-07', NULL),
(35, 4, '2025-07-08', NULL),
(36, 2, '2025-07-09', NULL),
(40, 1, '2025-07-10', NULL);

UPDATE emprunt_emprunt SET date_retour = '2025-07-01' WHERE id_emprunt = 1;
UPDATE emprunt_emprunt SET date_retour = '2025-07-05' WHERE id_emprunt = 2;
UPDATE emprunt_emprunt SET date_retour = '2025-07-10' WHERE id_emprunt = 3;
UPDATE emprunt_emprunt SET date_retour = '2025-07-12' WHERE id_emprunt = 4;
UPDATE emprunt_emprunt SET date_retour = '2025-07-14' WHERE id_emprunt = 5;
UPDATE emprunt_emprunt SET date_retour = '2025-07-18' WHERE id_emprunt = 6;
UPDATE emprunt_emprunt SET date_retour = '2025-07-20' WHERE id_emprunt = 7;
UPDATE emprunt_emprunt SET date_retour = '2025-07-21' WHERE id_emprunt = 8;
UPDATE emprunt_emprunt SET date_retour = '2025-07-25' WHERE id_emprunt = 9;
UPDATE emprunt_emprunt SET date_retour = '2025-07-30' WHERE id_emprunt = 10;
