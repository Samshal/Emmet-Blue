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
---> Staffs
---> 	0. DepartmentGroup
---> 		1. DepartmentGroupID
---> 		2. GroupName
---> 		3. ModifiedDate
---> 	1. Department
---> 		1. DepartmentID
---> 		2. Name
---> 		3. GroupID
---> 		4. ModifiedDate
---> 	2. Role
---> 		1. RoleID
---> 		2. Name
---> 		3. Description
---> 		4. ModifiedDate
---> 	3. Permission
---> 		1. PermissionID
---> 		2. Name
---> 		3. ModifiedDate
---> 	4. Staff
---> 		1. StaffID
---> 		2. Username
---> 		3. PasswordID
---> 		4. ModifiedDate
---> 	5. StaffPassword
---> 		1. StaffPasswordID
---> 		2. StaffID
---> 		3. PasswordHash
---> 		4. PasswordSalt
---> 		5. ModifiedDate
---> 	6. StaffDepartment
---> 		1. StaffID
---> 		2. DepartmentID
---> 		3. ModifiedDate
---> 	7. StaffRole
---> 		1. StaffID
---> 		2. RoleID
---> 		3. ModifiedDate

----- TSQL BEGINS HERE ----

use EmmetBluePre
GO

CREATE SCHEMA Logs
GO

CREATE SCHEMA Staffs
GO

CREATE TABLE [Logs].[DatabaseLog] (
	DatabaseLogID INT PRIMARY KEY,
	PostTime DATETIME,
	DatabaseUserID INT,
	Event VARCHAR(50),
	ObjectSchema VARCHAR(20),
	Object VARCHAR(20),
	TSQL VARCHAR(MAX),
	ModifiedDate DATETIME
)
GO

CREATE TABLE [Logs].[ErrorLog] (
	ErrorLogID INT PRIMARY KEY,
	ErrorTime DATETIME,
	DatabaseUserID INT,
	ErrorNumber CHAR(3),
	ErrorSeverity VARCHAR(20),
	ErrorMessage VARCHAR(200),
	ErrorObject VARCHAR(MAX),
	ModifiedDate DATETIME
)
GO

CREATE TABLE [Staffs].[DepartmentGroup] (
	DepartmentGroupID INT PRIMARY KEY,
	GroupName VARCHAR(50),
	ModifiedDate DATETIME
)
GO

CREATE TABLE [Staffs].[Department] (
	DepartmentID INT PRIMARY KEY,
	Name VARCHAR(50),
	GroupID INT,
	ModifiedDate DATETIME
)
GO

CREATE TABLE [Staffs].[Role](
	RoleID INT PRIMARY KEY,
	Name VARCHAR(50),
	Description VARCHAR(200),
	ModifiedDate DATETIME
)
GO

CREATE TABLE [Staffs].[Permission] (
	PermissionID INT PRIMARY KEY,
	Name VARCHAR(50),
	ModifiedDate DATETIME
)
GO

CREATE TABLE [Staffs].[Staff] (
	StaffID INT PRIMARY KEY,
	Username VARCHAR(20),
	PasswordID INT,
	ModifiedDate DATETIME
)
GO

CREATE TABLE [Staffs].[StaffPassword] (
	StaffPasswordID INT PRIMARY KEY,
	StaffID INT,
	PasswordHash VARCHAR(MAX),
	PasswordSalt VARCHAR(20),
	ModifiedDate DATETIME
)
GO

CREATE TABLE [Staffs].[StaffDepartment] (
	StaffID INT PRIMARY KEY,
	DepartmentID INT,
	ModifiedDate DATETIME
)
GO

CREATE TABLE [Staffs].[StaffRole] (
	StaffID INT PRIMARY KEY,
	RoleID INT,
	ModifiedDate DATETIME
)
GO


----- TSQL ENDS HERE ----
