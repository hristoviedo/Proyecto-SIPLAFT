DROP PROCEDURE IF EXISTS groupClients;

DELIMITER $$

CREATE PROCEDURE groupClients()
BEGIN

	DECLARE activityID INTEGER DEFAULT 0;
    DECLARE fundingID INTEGER DEFAULT 0;
    DECLARE activityName VARCHAR(20) DEFAULT '';
    DECLARE fundingName VARCHAR(20) DEFAULT '';
    DECLARE propertyID INTEGER DEFAULT 0;

	DECLARE propertyCursor CURSOR FOR
		SELECT a.id, a.name, f.id, f.name FROM activities a, fundings f;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin=1;

    OPEN propertyCursor;
    get_clients: LOOP
    FETCH propertyCursor INTO activityID, activityName, fundingID, fundingName;
     IF fin = 1 THEN
       LEAVE get_clients;
    END IF;

    CASE
    WHEN activityName = 'TRABAJADOR ASALARIADO' THEN SET propertyID = activityID;
	WHEN activityName = 'COMERCIANTE INDIVIDUAL / INDEPENDIENTE' THEN SET score = score + (2*percActivity);
	WHEN activityName = 'NEGOCIO INFORMAL' THEN SET score = score + (3*percActivity);
    WHEN activityName = 'PEP' THEN SET score = score + (4*percActivity);
    WHEN activityName = 'SIN FINES DE LUCRO (ONGS)' THEN SET score = score + (5*percActivity);
    ELSE SET score = score + (0*percActivity);
	END CASE;
    
    
    CLOSE propertyCursor;



	
	CREATE TEMPORARY TABLE IF NOT EXISTS t2 SELECT id, identity, name, age, email, workplace, phone1, phone2, nationality, SUM(households) AS households, SUM(total_amount) AS total_mount, activity, funding, score_risk, risk, created_at, updated_at FROM t1 GROUP BY identity;
	DELETE FROM clients;
	INSERT INTO clients SELECT id, identity, name, age, email, workplace, phone1, phone2, nationality, households, total_mount, activity, funding, score_risk, risk, created_at, updated_at  FROM t2;
	DROP TEMPORARY TABLE IF EXISTS t1;
    DROP TEMPORARY TABLE IF EXISTS t2;
END$$
DELIMITER ;

CALL groupClients();