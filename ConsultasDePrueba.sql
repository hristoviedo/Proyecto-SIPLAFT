SELECT * FROM clientes ORDER BY id ASC;	

DROP PROCEDURE IF EXISTS agruparClientes;

DELIMITER $$

CREATE PROCEDURE agruparClientes()
BEGIN
	CREATE TEMPORARY TABLE IF NOT EXISTS t1 SELECT id, identity, name, age, email, workplace, phone1, phone2, nationality, SUM(households) AS households, SUM(total_amount) AS total_mount, activity, funding, score_risk, risk, created_at, updated_at FROM clientes GROUP BY identity ORDER BY id ASC;
	DELETE FROM clientes;
	INSERT INTO clientes SELECT id, identity, name, age, email, workplace, phone1, phone2, nationality, households, total_mount, activity, funding, score_risk, risk, created_at, updated_at  FROM t1;
	DROP TEMPORARY TABLE IF EXISTS t1;
END$$
DELIMITER 

CALL agruparClientes();

