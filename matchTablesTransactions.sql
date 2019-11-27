DROP PROCEDURE IF EXISTS matchTablesTransactions;

DELIMITER $$

CREATE PROCEDURE matchTablesTransactions(IN userID BIGINT, IN companyID BIGINT)
BEGIN
    DECLARE tuIdentity VARCHAR(20) DEFAULT '';
    DECLARE tuDate VARCHAR(20) DEFAULT '';
    DECLARE tuCash VARCHAR(5) DEFAULT '';
    DECLARE tuDollars VARCHAR(5) DEFAULT '';
    DECLARE tuAmountLempiras FLOAT DEFAULT 0.00;
    DECLARE tuAmountDollars FLOAT DEFAULT 0.00;

    DECLARE clientID INTEGER DEFAULT 0;
    DECLARE dateDate DATE;
    DECLARE cashBool BOOLEAN DEFAULT FALSE;
    DECLARE dollarsBool BOOLEAN DEFAULT FALSE;
    
    DECLARE fin INTEGER DEFAULT 0;

	DECLARE propertyCursor CURSOR FOR
		SELECT tu.client_identity, tu.transaction_date, tu.transaction_cash, tu.transaction_dollars, tu.transaction_amount_lempiras, tu.transaction_amount_dollars FROM transactions_uploads tu;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin=1;

    OPEN propertyCursor;
    getProperty: LOOP
    FETCH propertyCursor INTO tuIdentity, tuDate, tuCash, tuDollars, tuAmountLempiras, tuAmountDollars;
     IF fin = 1 THEN
       LEAVE getProperty;
    END IF;

	SET clientID := (SELECT DISTINCT c.id FROM clients c WHERE tuIdentity = c.identity);
    
    CASE
    WHEN tuCash = 'SI' OR  tuCash = 'YES' OR  tuCash = 'TRUE' OR  tuCash = 'AFIRMATIVO' OR tuCash = '1' THEN SET cashBool = TRUE;
    ELSE SET cashBool = FALSE;
	END CASE;
    
    CASE
    WHEN tuDollars = 'SI' OR  tuDollars = 'YES' OR  tuDollars = 'TRUE' OR  tuDollars = 'AFIRMATIVO' OR  tuDollars = '1' THEN SET dollarsBool = TRUE;
    ELSE SET dollarsBool = FALSE;
	END CASE;
    
    SET dateDate := STR_TO_DATE(tuDate ,GET_FORMAT(DATE,'ISO'));

    INSERT INTO transactions (client_id, user_id , company_id, transaction_date, transaction_cash, transaction_dollars, transaction_amount_lempiras, transaction_amount_dollars) 
				VALUES (clientID, userID, companyID, tuDate, cashBool, dollarsBool, tuAmountLempiras, tuAmountDollars);

    END LOOP getProperty;
    CLOSE propertyCursor;
	TRUNCATE TABLE transactions_uploads;
END$$
DELIMITER ;

/*
CALL matchTablesTransactions(1,1);
*/