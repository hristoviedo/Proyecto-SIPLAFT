DROP PROCEDURE IF EXISTS agruparClientes;

DELIMITER $$

CREATE PROCEDURE agruparClientes()
BEGIN
	CREATE TEMPORARY TABLE IF NOT EXISTS t1 SELECT * FROM clients ORDER BY id DESC;
	CREATE TEMPORARY TABLE IF NOT EXISTS t2 SELECT id, identity, name, age, email, workplace, phone1, phone2, nationality, SUM(households) AS households, SUM(total_amount) AS total_mount, activity, funding, score_risk, risk, created_at, updated_at FROM t1 GROUP BY identity;
	DELETE FROM clientes;
	INSERT INTO clientes SELECT id, identity, name, age, email, workplace, phone1, phone2, nationality, households, total_mount, activity, funding, score_risk, risk, created_at, updated_at  FROM t2;
	DROP TEMPORARY TABLE IF EXISTS t1;
    DROP TEMPORARY TABLE IF EXISTS t2;
END$$
DELIMITER ;

CALL agruparClientes();
