DROP PROCEDURE IF EXISTS calculateData;

DELIMITER $$
CREATE PROCEDURE calculateData(IN idClient INT)
BEGIN
    SELECT tr.client_id, @households := COUNT(tr.client_id) AS Households, @total_amount := SUM(tr.amount) AS TotalAmount
	FROM transactions tr
	WHERE tr.client_id = idClient
	GROUP BY tr.client_id;

	UPDATE clients cl SET cl.households = @households, cl.total_amount = @total_amount WHERE cl.id = idClient;

END$$
DELIMITER ;

CALL calculateData(1035);