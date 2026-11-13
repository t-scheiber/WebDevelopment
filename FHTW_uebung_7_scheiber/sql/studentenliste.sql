-- Table for exercise 7 (registration and login) with three fictional demo students.
-- The column names match the INSERT in register.php and the SELECT in inc/header.inc.php.
-- The demo password for all three accounts is demo1234. The hashes come from password_hash().
-- Rows with ist_demo = 0 are new registrations; register.php deletes them after 7 days.

CREATE TABLE IF NOT EXISTS studentenliste (
	sid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	vorname VARCHAR(50) NOT NULL,
	nachname VARCHAR(50) NOT NULL,
	geburtsdatum DATE NOT NULL,
	emailadresse VARCHAR(100) NOT NULL,
	passwort VARCHAR(255) NOT NULL,
	ist_demo TINYINT(1) NOT NULL DEFAULT 0,
	registriert_am TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	UNIQUE KEY emailadresse (emailadresse)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO studentenliste (vorname, nachname, geburtsdatum, emailadresse, passwort, ist_demo) VALUES
	('Anna', 'Beispiel', '2000-03-14', 'anna.beispiel@example.com', '$2y$10$f9h3S9Uz41TwDOsCupBB.O0ppIoa7jUKlZBOEOKMTfGPc/OQTzboK', 1),
	('Bernd', 'Muster', '1999-11-02', 'bernd.muster@example.com', '$2y$10$97hodIFplbEJGmIzAsEHB.fT6j0vMFd/d3fb6Y4HZiDhLyDChCZTe', 1),
	('Clara', 'Test', '2001-07-21', 'clara.test@example.com', '$2y$10$ybHl5BF4CffbSXsYOqu/JOTVlehMsUAUIkWJ78M7cUzV6JCIjubni', 1);
