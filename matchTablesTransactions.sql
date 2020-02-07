DROP PROCEDURE IF EXISTS matchTablesTransactions;

DELIMITER $$

CREATE PROCEDURE matchTablesTransactions(IN userID BIGINT, IN companyID BIGINT)
BEGIN
    DECLARE tuIdentity VARCHAR(20) DEFAULT '';
    DECLARE tuApartmentNumber VARCHAR(20) DEFAULT '';
    DECLARE tuBank VARCHAR(50) DEFAULT '';
    DECLARE tuOperationDate VARCHAR(30) DEFAULT '';
    DECLARE tuTransferDate VARCHAR(30) DEFAULT '';
    DECLARE tuCash VARCHAR(10) DEFAULT '';
    DECLARE tuCurrency VARCHAR(20) DEFAULT '';
    DECLARE tuAmount FLOAT DEFAULT 0.00;

    DECLARE clientID INTEGER DEFAULT 0;
    DECLARE activityID INTEGER DEFAULT 0;
    DECLARE fundingID INTEGER DEFAULT 0;
    DECLARE dateOperationDate DATE;
    DECLARE dateTransferDate DATE;
    DECLARE clWorkplace VARCHAR(30) DEFAULT '';
    DECLARE clWorkstation VARCHAR(30) DEFAULT '';
    DECLARE clSalary FLOAT DEFAULT 0;
    DECLARE cashBool BOOLEAN DEFAULT FALSE;

    DECLARE fin INTEGER DEFAULT 0;

	DECLARE propertyCursor CURSOR FOR
		SELECT tu.client_identity, tu.transaction_apartment_number, tu.transaction_intermediary_bank, tu.transaction_operation_date, tu.transaction_transfer_date, tu.transaction_cash, tu.transaction_currency, tu.transaction_amount FROM transactions_uploads tu;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin=1;

    OPEN propertyCursor;
    getProperty: LOOP
    FETCH propertyCursor INTO tuIdentity, tuApartmentNumber, tuBank, tuOperationDate, tuTransferDate, tuCash,tuCurrency,tuAmount;
     IF fin = 1 THEN
       LEAVE getProperty;
    END IF;

	SET clientID := (SELECT DISTINCT c.id FROM clients c WHERE tuIdentity = c.identity);
    SET activityID := (SELECT DISTINCT a.id FROM activities a, clients c WHERE tuIdentity = c.identity AND c.activity_id = a.id);
    SET fundingID := (SELECT DISTINCT f.id FROM fundings f, clients c WHERE tuIdentity = c.identity AND c.funding_id = f.id);
    SET clWorkplace := (SELECT c.workplace FROM clients c WHERE tuIdentity = c.identity);
    SET clWorkstation := (SELECT c.workstation FROM clients c WHERE tuIdentity = c.identity);
    SET clSalary := (SELECT c.salary FROM clients c WHERE tuIdentity = c.identity);
    SET dateOperationDate := STR_TO_DATE(tuOperationDate ,GET_FORMAT(DATE,'ISO'));
    SET dateTransferDate := STR_TO_DATE(tuTransferDate ,GET_FORMAT(DATE,'ISO'));

    CASE
    WHEN tuCash = 'SI' OR  tuCash = 'YES' OR  tuCash = 'TRUE' OR  tuCash = 'AFIRMATIVO' OR tuCash = '1' THEN SET cashBool = TRUE;
    ELSE SET cashBool = FALSE;
	END CASE;

    INSERT INTO transactions (client_id, user_id , company_id, activity_id, funding_id, transaction_apartment_number, transaction_intermediary_bank, transaction_operation_date, transaction_transfer_date, transaction_cash, transaction_currency, transaction_amount, workplace, workstation, salary)
				VALUES (clientID, userID, companyID, activityID, fundingID, tuApartmentNumber, tuBank, tuOperationDate, tuTransferDate, cashBool, tuCurrency, tuAmount, clWorkplace, clWorkstation, clSalary);

    END LOOP getProperty;
    CLOSE propertyCursor;
	TRUNCATE TABLE transactions_uploads;
END$$
DELIMITER ;

/*
CALL matchTablesTransactions(1,1);
*/
