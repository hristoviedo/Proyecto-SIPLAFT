DROP PROCEDURE IF EXISTS reportTransactionsAllSup;

DELIMITER $$

CREATE PROCEDURE reportTransactionsAllSup()
BEGIN
	SET @rownum = 0;
	SELECT
    @rownum:= @rownum +1 AS NUMERO_REGISTRO,
	cl.name AS CLIENTES, 
	tr.apartment_number AS No_DE_APARTAMENTO,
	tr.operation_date AS FECHAS_DE_OPERACION,
	tr.amount AS MONTO_DE_OPERACION,
	tr.transfer_date AS FECHA_DE_TRASPASO_DE_ESCRITURA,
	IF(tr.intermediary_bank = "CONTADO","",tr.intermediary_bank) AS BANCO_INTERMEDIARIO,
	IF(fu.id = 5,"FINANCIAMIENTO","CONTADO") AS FONDOS,
	IF(fu.id != 5, fu.name, "") AS FORMA_DE_PAGO,
	tr.workplace AS LUGAR_DE_TRABAJO,
	IF(cl.activity_id = 2, tr.workstation, "") AS PUESTO,
	IF(cl.activity_id = 2, tr.salary, "") AS SALARIO,
	ac.name AS FUENTE_DE_INGRESO,
	cl.age AS EDAD,
	cl.identity AS IDENTIDAD,
	cl.households AS No_DE_APARTAMENTOS_ACUMULADOS,
    ri.name AS RIESGO_CALCULADO,
    co.name AS NOMBRE_EMPRESA
	FROM clients cl, transactions tr,fundings fu,activities ac, risks ri, companies co
	WHERE tr.company_id = co.id AND tr.client_id = cl.id AND tr.funding_id = fu.id AND tr.activity_id = ac.id AND cl.risk_id = ri.id
    ORDER BY NUMERO_REGISTRO;
END$$
DELIMITER ;

CALL reportTransactionsAllSup;