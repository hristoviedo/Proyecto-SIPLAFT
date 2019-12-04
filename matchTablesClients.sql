DROP PROCEDURE IF EXISTS matchTablesClients;

DELIMITER $$

CREATE PROCEDURE matchTablesClients()
BEGIN
    DECLARE cuIdentity VARCHAR(20) DEFAULT '';
    DECLARE cuName VARCHAR(40) DEFAULT '';
    DECLARE cuAge INTEGER DEFAULT 0;
    DECLARE cuEmail VARCHAR(40) DEFAULT '';
    DECLARE cuWorkplace VARCHAR(30) DEFAULT '';
    DECLARE cuPhone1 VARCHAR(20) DEFAULT '';
    DECLARE cuPhone2 VARCHAR(20) DEFAULT '';
    DECLARE cuNationality VARCHAR(20) DEFAULT '';
    DECLARE cuActivity VARCHAR(40) DEFAULT '';
    DECLARE cuFunding VARCHAR(45) DEFAULT '';
    DECLARE cuHouseholds INTEGER DEFAULT 0;
    DECLARE cuTotalAmount FLOAT DEFAULT 0;

    DECLARE activityID INTEGER DEFAULT 0;
    DECLARE fundingID INTEGER DEFAULT 0;
    DECLARE exist INTEGER DEFAULT 0;
    DECLARE fin INTEGER DEFAULT 0;

	DECLARE propertyCursor CURSOR FOR
		SELECT cu.identity, cu.name, cu.age, cu.email, cu.workplace, cu.phone1, cu.phone2, cu.nationality, cu.activity, cu.funding, cu.households, cu.total_amount FROM clients_uploads cu;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin=1;

    OPEN propertyCursor;
    getProperty: LOOP
    FETCH propertyCursor INTO cuIdentity, cuName, cuAge, cuEmail, cuWorkplace, cuPhone1, cuPhone2, cuNationality, cuActivity, cuFunding, cuHouseholds, cuTotalAmount;
	IF fin = 1 THEN
       LEAVE getProperty;
    END IF;

	SET activityID := (SELECT DISTINCT a.id FROM activities a WHERE cuActivity = a.name);
    SET fundingID := (SELECT DISTINCT f.id FROM fundings f WHERE cuFunding = f.name);

	SET exist := (SELECT count(*) FROM clients WHERE identity = cuIdentity);

	IF exist = 1 THEN
       UPDATE clients SET 
       activity_id = activityID, funding_id = fundingID,
       identity = cuIdentity, name = cuName, age = cuAge, email =cuEmail, workplace = cuWorkplace, phone1 = cuPhone1,
       phone2 = cuPhone2,nationality = cuNationality, households = cuHouseholds, total_amount = cuTotalAmount
       WHERE clients.identity = cuIdentity;
	ELSE
		INSERT INTO clients (activity_id, funding_id , identity, name, age, email, workplace, phone1, phone2, nationality, households, total_amount, created_at, updated_at) 
		VALUES (activityID, fundingID, cuIdentity, cuName, cuAge, cuEmail, cuWorkplace, cuPhone1, cuPhone2, cuNationality, cuHouseholds, cuTotalAmount, now(), now());
    END IF;

    END LOOP getProperty;
    CLOSE propertyCursor;
	TRUNCATE TABLE clients_uploads;
END$$
DELIMITER ;

CALL matchTablesClients();