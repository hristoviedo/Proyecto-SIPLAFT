select
co.name as EMPRESA,
cl.name as CLIENTES, 
tr.transaction_apartment_number as No_DE_APARTAMENTO,
tr.transaction_operation_date as FECHAS_DE_OPERACION,
tr.transaction_amount as MONTO_DE_OPERACION,
tr.transaction_transfer_date as FECHA_DE_TRASPASO_DE_ESCRITURA,
tr.transaction_intermediary_bank as BANCO_INTERMEDIARIO,
if(fu.id = 5,"FINANCIAMIENTO","CONTADO") as FONDOS,
/*fu.name as FONDOS,*/
/*fu.name as FORMA_DE_PAGO,*/
if(fu.id != 5, fu.name, "") as FORMA_DE_PAGO,
tr.workplace as LUGAR_DE_TRABAJO,
if(cl.activity_id = 2, tr.workstation, "") as PUESTO,
if(cl.activity_id = 2, tr.salary, "") as SALARIO,
/*tr.workstation as PUESTO,
tr.salary as SALARIO,*/
ac.name as FUENTE_DE_INGRESO,
cl.age as EDAD,
cl.identity as IDENTIDAD,
tr.transaction_quantity as No_DE_APARTAMENTOS,
cl.households as No_DE_APARTAMENTOS_ACUMULADOS
from clients cl, transactions tr,companies co,fundings fu,users us, activities ac
where tr.user_id = us.id and tr.client_id = cl.id and tr.funding_id = fu.id and us.company_id = co.id and tr.activity_id = ac.id;


select us.name, co.name
from users us, companies co 
where us.company_id = co.id;