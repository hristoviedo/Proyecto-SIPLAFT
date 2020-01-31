DROP PROCEDURE IF EXISTS reportTransactions;

DELIMITER $$

CREATE PROCEDURE reportTransactions(IN monthReport INT, IN yearReport INT,IN companyID BIGINT)
BEGIN
	SET @rownum = 0;
	SELECT
    @rownum:= @rownum +1 AS NUMERO_REGISTRO,
	cl.name AS CLIENTES, 
	tr.transaction_apartment_number AS No_DE_APARTAMENTO,
	tr.transaction_operation_date AS FECHAS_DE_OPERACION,
	tr.transaction_amount AS MONTO_DE_OPERACION,
	tr.transaction_transfer_date AS FECHA_DE_TRASPASO_DE_ESCRITURA,
	IF(tr.transaction_intermediary_bank = "CONTADO","",tr.transaction_intermediary_bank) AS BANCO_INTERMEDIARIO,
	IF(fu.id = 5,"FINANCIAMIENTO","CONTADO") AS FONDOS,
	IF(fu.id != 5, fu.name, "") AS FORMA_DE_PAGO,
	tr.workplace AS LUGAR_DE_TRABAJO,
	IF(cl.activity_id = 2, tr.workstation, "") AS PUESTO,
	IF(cl.activity_id = 2, tr.salary, "") AS SALARIO,
	ac.name AS FUENTE_DE_INGRESO,
	cl.age AS EDAD,
	cl.identity AS IDENTIDAD,
	tr.transaction_quantity AS No_DE_APARTAMENTOS,
	cl.households AS No_DE_APARTAMENTOS_ACUMULADOS,
    ri.name AS RIESGO_CALCULADO
	FROM clients cl, transactions tr,fundings fu,activities ac, risks ri
	WHERE tr.company_id = companyID AND tr.client_id = cl.id AND tr.funding_id = fu.id AND tr.activity_id = ac.id AND cl.risk_id = ri.id
	AND MONTH(tr.transaction_operation_date) = monthReport AND YEAR(tr.transaction_operation_date) = yearReport
    ORDER BY NUMERO_REGISTRO;
END$$
DELIMITER ;

CALL reportTransactions(07,2018,04);