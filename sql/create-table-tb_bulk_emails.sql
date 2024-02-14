CREATE TABLE doacoes.tb_bulk_emails (
	title varchar(100) NULL,
	body varchar(100) NULL,
	`date` DATETIME DEFAULT now() NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;