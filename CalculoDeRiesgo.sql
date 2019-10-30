SELECT * FROM clientes;

DROP TEMPORARY TABLE IF EXISTS t1;

CREATE TEMPORARY TABLE IF NOT EXISTS t1 SELECT id, age, households, activity, funding, score_risk FROM clientes;

SELECT * FROM t1;

SELECT * FROM t1 WHERE id = 601;

DROP PROCEDURE IF EXISTS calcularRiesgo;

DELIMITER $$
CREATE PROCEDURE calcularRiesgo()
BEGIN
    DECLARE percActivity FLOAT DEFAULT 0.25;
    DECLARE percFunding FLOAT DEFAULT 0.3;
    DECLARE percAge FLOAT DEFAULT 0.25;
    DECLARE percHouseholds FLOAT DEFAULT 0.2;
    DECLARE score FLOAT DEFAULT 0.0;
    DECLARE age FLOAT DEFAULT 0;
    DECLARE activity VARCHAR(45) DEFAULT '';
    DECLARE funding VARCHAR(45) DEFAULT '';
    DECLARE households FLOAT DEFAULT 0;
	
    SELECT c.households, c.activity, c.age, c.funding INTO households, activity, age, funding FROM t1 c WHERE id = 601;
	
    CASE
    WHEN activity = 'TRABAJADOR ASALARIADO' THEN SET score = score + (1*percActivity);
	WHEN activity = 'COMERCIANTE INDIVIDUAL / INDEPENDIENTE' THEN SET score = score + (2*percActivity);
	WHEN activity = 'NEGOCIO INFORMAL' THEN SET score = score + (3*percActivity);
    WHEN activity = 'PEP' THEN SET score = score + (4*percActivity);
    WHEN activity = 'SIN FINES DE LUCRO (ONGS)' THEN SET score = score + (5*percActivity);
    ELSE SET score = score + (0*percActivity);
	END CASE;
    
    CASE
    WHEN funding = 'EFECTIVO' THEN SET score = score + (5*percFunding);
	WHEN funding = 'DEPÓSITO EN EFECTIVO EN CTAS DE LA EMPRESA' THEN SET score = score + (4*percFunding);
	WHEN funding = 'AUTOFINANCIADO TRANSF. DE TERCEROS' THEN SET score = score + (3*percFunding);
    WHEN funding = 'AUTOFINANCIADO TRANSF. DE CTA DEL CLIENTE' THEN SET score = score + (2*percFunding);
    WHEN funding = 'FINANCIAMIENTO BANCO' THEN SET score = score + (1*percFunding);
    ELSE SET score = score + (0*percFunding);
	END CASE;
    
    CASE
    WHEN age >= 66 THEN SET score = score + (1*percAge);
	WHEN age >= 56 AND age <= 65 THEN SET score = score + (2*percAge);
	WHEN age >= 46 AND age <= 55 THEN SET score = score + (3*percAge);
    WHEN age >= 36 AND age <= 45 THEN SET score = score + (4*percAge);
    WHEN age >= 18 AND age <= 35 THEN SET score = score + (5*percAge);
    ELSE SET score = score + (0*percAge);
	END CASE;
    
    CASE
    WHEN households > 7 THEN SET score = score + (5*percHouseholds);
	WHEN households >= 6 AND households <= 7 THEN SET score = score + (4*percHouseholds);
	WHEN households >= 4 AND households <= 5 THEN SET score = score + (3*percHouseholds);
    WHEN households >= 2 AND households <= 3 THEN SET score = score + (2*percHouseholds);
    WHEN households = 1 THEN SET score = score + (1*percHouseholds);
    ELSE SET score = score + (0*percHouseholds);
	END CASE;
    
	UPDATE t1 c SET c.score_risk = score WHERE id = 601;
END$$
DELIMITER ;

CALL calcularRiesgo();
