--- This file was created on 4th June, 2016 by Samuel Adeshina <samueladeshina73@gmail.com>
--- It creates the core schema and tables needed by EmmetBlue
--- The EmmetBluePre database must exist already for the sql in this document to work

--- PROPOSED STRUCTURE ---
---> Logs
---> 	1. DatabaseLog
---> 		1. DatabaseLogID
---> 		2. PostTime
---> 		3. DatabaseUserID
---> 		4. Event
---> 		5. Schema
---> 		6. Object
---> 		7. TSQL
---> 
---> 	2. ErrorLog
---> 		1. ErrorLogID
---> 		2. ErrorTime
---> 		3. DatabaseUser
---> 		4. ErrorNumber
---> 		5. ErrorSeverity
---> 		6. ErrorState
---> 		7. ErrorMessage
---> 		8. Error
---> 
----- TSQL BEGINS HERE ----

CREATE DATABASE EmmetBlue
GO

use EmmetBlue
GO

CREATE SCHEMA Logs
GO

CREATE TABLE [Logs].[DatabaseLog] (
	DatabaseLogID INT PRIMARY KEY IDENTITY,
	PostTime DATETIME,
	DatabaseUserID INT,
	Event VARCHAR(100),
	ObjectSchema VARCHAR(200),
	Object VARCHAR(200),
	TSQL VARCHAR(MAX),
	ModifiedDate DATETIME
)

CREATE TABLE [Logs].[ErrorLog] (
	ErrorLogID INT PRIMARY KEY IDENTITY,
	ErrorTime DATETIME,
	DatabaseUserID INT,
	ErrorNumber CHAR(100),
	ErrorSeverity VARCHAR(100),
	ErrorMessage VARCHAR(MAX),
	ErrorObject VARCHAR(MAX),
	ModifiedDate DATETIME
)
----- TSQL ENDS HERE ----
