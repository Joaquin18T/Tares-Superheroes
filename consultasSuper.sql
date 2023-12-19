USE superhero;

SELECT * FROM alignment;  -- BANDOS
SELECT * FROM attribute;  -- atributos
SELECT * FROM colour;	  -- colores
SELECT * FROM comic;      -- no se utilizara
SELECT * FROM gender;     -- generos
SELECT * FROM publisher;  -- casa publicacion / distribucion
SELECT * FROM race;       -- razas
SELECT * FROM superhero;  -- super heroes
SELECT * FROM superpower; -- no se usara

DELIMITER $$
CREATE PROCEDURE spu_buscar_publisher(IN _publisher_name VARCHAR(50))
BEGIN
	SELECT 
		SUP.id,
        PUB.publisher_name,
        SUP.superhero_name,
        SUP.full_name,
        GEN.gender,
        RAC.race
		FROM superhero SUP
        INNER JOIN publisher PUB ON PUB.id = SUP.publisher_id
        INNER JOIN gender GEN ON GEN.id = SUP.gender_id
        INNER JOIN race RAC ON RAC.id = SUP.race_id
        WHERE PUB.publisher_name = _publisher_name
        ORDER BY PUB.publisher_name;

END $$

CALL spu_buscar_publisher ("ABC Studios");

DELIMITER $$
CREATE PROCEDURE spu_listar_publisher()
BEGIN
	SELECT 
    id,
    publisher_name
    FROM publisher
    ORDER BY publisher_name;
END $$

CALL spu_listar_publisher;

DELIMITER $$
CREATE PROCEDURE spu_contar_bando()
BEGIN
	SELECT 
    ALI.alignment,
    COUNT(ALI.alignment) cantidad
    FROM superhero SUP
    INNER JOIN alignment ALI ON ALI.id = SUP.alignment_id
    GROUP BY ALI.alignment;
END $$


CALL spu_contar_bando;

DELIMITER $$
CREATE PROCEDURE spu_contarAlig_publisher(IN _publisher_name VARCHAR(50))
BEGIN
	SELECT 
    ALI.alignment,
    COUNT(ALI.alignment) total
    FROM superhero SUP
    INNER JOIN alignment ALI ON ALI.id = SUP.alignment_id
    INNER JOIN publisher PUB ON PUB.id = SUP.publisher_id
    WHERE PUB.publisher_name = _publisher_name
    GROUP BY ALI.alignment;
END $$

CALL spu_contarAlig_publisher ('DC Comics');



    

