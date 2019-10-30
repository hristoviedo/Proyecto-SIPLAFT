CREATE TEMPORARY TABLE IF NOT EXISTS t1 SELECT id, age, households, activity, funding, score_risk FROM clientes;

SELECT * FROM t1;

DROP PROCEDURE IF EXISTS calcularRiesgo;

DELIMITER $$

CREATE PROCEDURE calcularRiesgo()
BEGIN
	DECLARE percAge FLOAT DEFAULT 0.25;
    
    DECLARE score FLOAT DEFAULT 0.0;

    DECLARE age FLOAT DEFAULT 0;
    
	SELECT c.age,
	CASE
    WHEN c.age >= 66 THEN age = 1
	WHEN c.age >= 56 AND c.age <= 65 THEN age = 2
	WHEN c.age >= 46 AND c.age <= 55 THEN age = 3
    WHEN c.age >= 36 AND c.age <= 45 THEN age = 4
    WHEN c.age >= 18 AND c.age <= 35 THEN age = 5
    ELSE age = 0
	END
	FROM t1 c WHERE id = 526;
    
    SET score = (age * percAge);
    
	UPDATE t1 c SET c.score_risk = score WHERE id = 526;

END$$

DELIMITER ;

CALL calcularRiesgo();

SELECT age, households, activity, funding FROM clientes;

SELECT * FROM clientes;
