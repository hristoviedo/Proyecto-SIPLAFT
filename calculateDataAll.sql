DROP PROCEDURE IF EXISTS calculateDataAll;

DELIMITER $$
CREATE PROCEDURE calculateDataAll()
BEGIN
    DECLARE total_amount INTEGER DEFAULT 0;
    DECLARE households FLOAT DEFAULT 0;
	DECLARE id INTEGER DEFAULT 0;
    DECLARE fin INTEGER DEFAULT 0;

    DECLARE household_cursor CURSOR FOR
		SELECT tr.client_id, COUNT(tr.client_id), SUM(tr.amount)
		FROM transactions tr
		GROUP BY tr.client_id;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin=1;

    OPEN household_cursor;
    get_households: LOOP
		FETCH household_cursor INTO id, households, total_amount;
    IF fin = 1 THEN
       LEAVE get_households;
    END IF;

	UPDATE clients cl SET cl.households = households, cl.total_amount = total_amount WHERE cl.id = id;

	END LOOP get_households;
    CLOSE household_cursor;

END$$
DELIMITER ;

CALL calculateDataAll();