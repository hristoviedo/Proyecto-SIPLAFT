DROP PROCEDURE IF EXISTS calculateRisk;

DELIMITER $$
CREATE PROCEDURE calculateRisk(IN idClient INT)
BEGIN
    DECLARE percActivity FLOAT DEFAULT 0.25;
    DECLARE percFunding FLOAT DEFAULT 0.3;
    DECLARE percAge FLOAT DEFAULT 0.25;
    DECLARE percHouseholds FLOAT DEFAULT 0.2;

	SELECT @id := c.id, @households := c.households, @age := c.age, @activity := a.name, @funding := f.name
	FROM clients c, activities a, fundings f
	WHERE c.id = idClient AND c.activity_id = a.id AND c.funding_id = f.id;

	CASE
    WHEN @activity = 'TRABAJADOR ASALARIADO' THEN SET @score = @score + (1*percActivity);
	WHEN @activity = 'COMERCIANTE INDIVIDUAL / INDEPENDIENTE' THEN SET @score = @score + (2*percActivity);
	WHEN @activity = 'NEGOCIO INFORMAL' THEN SET @score = @score + (3*percActivity);
    WHEN @activity = 'PEP' THEN SET @score = @score + (4*percActivity);
    WHEN @activity = 'SIN FINES DE LUCRO (ONGS)' THEN SET @score = @score + (5*percActivity);
    ELSE SET @score = @score + (0*percActivity);
	END CASE;

    CASE
    WHEN @funding = 'EFECTIVO' THEN SET @score = @score + (5*percFunding);
	WHEN @funding = 'DEPÓSITO EN EFECTIVO EN CTAS DE LA EMPRESA' THEN SET @score = @score + (4*percFunding);
	WHEN @funding = 'AUTOFINANCIADO TRANSF. DE TERCEROS' THEN SET @score = @score + (3*percFunding);
    WHEN @funding = 'AUTOFINANCIADO TRANSF. DE CTA DEL CLIENTE' THEN SET @score = @score + (2*percFunding);
    WHEN @funding = 'FINANCIAMIENTO BANCO' THEN SET @score = @score + (1*percFunding);
    ELSE SET @score = @score + (0*percFunding);
	END CASE;

    CASE
    WHEN @age >= 66 THEN SET @score = @score + (1*percAge);
	WHEN @age >= 56 AND @age <= 65 THEN SET @score = @score + (2*percAge);
	WHEN @age >= 46 AND @age <= 55 THEN SET @score = @score + (3*percAge);
    WHEN @age >= 36 AND @age <= 45 THEN SET @score = @score + (4*percAge);
    WHEN @age >= 18 AND @age <= 35 THEN SET @score = @score + (5*percAge);
    ELSE SET @score = @score + (0*percAge);
	END CASE;

    CASE
    WHEN @households > 7 THEN SET @score = @score + (5*percHouseholds);
	WHEN @households >= 6 AND @households <= 7 THEN SET @score = @score + (4*percHouseholds);
	WHEN @households >= 4 AND @households <= 5 THEN SET @score = @score + (3*percHouseholds);
    WHEN @households >= 2 AND @households <= 3 THEN SET @score = @score + (2*percHouseholds);
    WHEN @households = 1 THEN SET @score = @score + (1*percHouseholds);
    ELSE SET @score = @score + (0*percHouseholds);
	END CASE;

    CASE
    WHEN @score > 4 AND @score <= 5 THEN SET @risk = 'CRITICO';
	WHEN @score > 3 AND @score <= 4 THEN SET @risk = 'ALTO';
	WHEN @score > 2 AND @score <= 3 THEN SET @risk = 'SIGNIFICATIVO';
    WHEN @score > 1 AND @score <= 2 THEN SET @risk = 'MODERADO';
    WHEN @score > 0 AND @score <= 1 THEN SET @risk = 'BAJO';
    ELSE SET @risk = 'NO DISPONIBLE';
	END CASE;

    SET @riskID := (SELECT r.id FROM risks r WHERE r.name = @risk);

	UPDATE clients c SET c.score_risk = @score, c.risk_id = @riskID WHERE c.id = @id;

END$$
DELIMITER ;

CALL calculateRisk(1015);
