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
--->	8. StaffProfileRecords
--->		1. RecordID
--->		2. RecordName
--->		3. RecordType
--->		4. RecordDescription
--->	9.	StaffProfile
--->		1. StaffProfileID
--->		2. StaffID
--->		3. Records

----- TSQL BEGINS HERE ----

CREATE DATABASE EmmetBlue
GO

use EmmetBlue
GO

CREATE SCHEMA Logs
GO

CREATE SCHEMA Staffs
GO

CREATE SCHEMA Accounts
GO

CREATE SCHEMA Patients
GO

CREATE SCHEMA Pharmacy;
GO

CREATE SCHEMA Mortuary;
GO

CREATE SCHEMA Consultancy;
GO

CREATE SCHEMA Accounts
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

CREATE TABLE [Staffs].[DepartmentGroup] (
	DepartmentGroupID INT PRIMARY KEY IDENTITY,
	GroupName VARCHAR(50) UNIQUE,
	ModifiedDate DATETIME
)

CREATE TABLE [Staffs].[Department] (
	DepartmentID INT PRIMARY KEY IDENTITY,
	Name VARCHAR(50),
	GroupID INT,
	ModifiedDate DATETIME,
	FOREIGN KEY (GroupID) REFERENCES [Staffs].[DepartmentGroup] (DepartmentGroupID) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE [Staffs].[Role](
	RoleID INT PRIMARY KEY IDENTITY,
	Name VARCHAR(50) NOT NULL,
	DepartmentID INT NOT NULL,
	Description VARCHAR(200),
	ModifiedDate DATETIME,
	FOREIGN KEY (DepartmentID) REFERENCES [Staffs].[Department] ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE [Staffs].[Staff] (
	StaffID INT PRIMARY KEY IDENTITY,
	StaffUUID VARCHAR(20) UNIQUE,
	AccountActivated BIT DEFAULT 0 NOT NULL,
	ModifiedDate DATETIME
)

CREATE TABLE [Staffs].[StaffPassword] (
	StaffPasswordID INT PRIMARY KEY IDENTITY,
	StaffID INT UNIQUE,
	StaffUsername VARCHAR(20) UNIQUE,
	PasswordHash VARCHAR(MAX),
	PasswordSalt VARCHAR(20),
	ModifiedDate DATETIME,
	FOREIGN KEY (StaffID) REFERENCES [Staffs].[Staff] (StaffID) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE [Staffs].[StaffDepartment] (
	StaffDepartmentID INT PRIMARY KEY IDENTITY,
	StaffID INT UNIQUE,
	DepartmentID INT,
	ModifiedDate DATETIME,
	FOREIGN KEY (DepartmentID) REFERENCES [Staffs].[Department] ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY (StaffID) REFERENCES [Staffs].[Staff] (StaffID) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE [Staffs].[StaffRole] (
	StaffRoleID INT PRIMARY KEY IDENTITY,
	StaffID INT UNIQUE,
	RoleID INT,
	ModifiedDate DATETIME,
	FOREIGN KEY (RoleID) REFERENCES [Staffs].[Role] ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY (StaffID) REFERENCES [Staffs].[Staff] (StaffID) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE Staffs.StaffProfileRecords (
	RecordID INT PRIMARY KEY IDENTITY,
	RecordName VARCHAR(50) UNIQUE NOT NULL,
	RecordType VARCHAR(20) NOT NULL,
	RecordDescription VARCHAR(200)
)

CREATE TABLE Staffs.StaffProfile (
	StaffProfile INT PRIMARY KEY IDENTITY,
	StaffID INT NOT NULL,
	Records VARCHAR(MAX) --SERIALIZED JSON DATA WITH RECORDS FROM StaffProfileRecords
)

CREATE TABLE Mortuary.Body (
	BodyID INTEGER PRIMARY KEY IDENTITY NOT NULL,
	DeathPhysicianID INTEGER,
	BodyTag VARCHAR(50) NOT NULL,
	DateOfDeath DATE NOT NULL,
	PlaceOfDeath VARCHAR(100) NOT NULL,
	BodyStatus BIT,
	CreationDate DATETIME NOT NULL DEFAULT GETDATE(),
	LastModified DATETIME NOT NULL DEFAULT GETDATE()
)
GO

CREATE TABLE Mortuary.BodyInformation (
	BodyInformationID INTEGER PRIMARY KEY IDENTITY NOT NULL,
	BodyID INTEGER,
	BodyFullName VARCHAR(20) NOT NULL,
	BodyDateOfBirth DATE,
	BodyGender VARCHAR(10) NOT NULL,
	BodyNextOfKinFullName VARCHAR(100),
	BodyNextOfKinAddress VARCHAR(100),
	BodyNextOfKinRelationshipType VARCHAR(20),
	BodyNextOfKinPhoneNumber VARCHAR(15)
	FOREIGN KEY (BodyID) REFERENCES Mortuary.Body(BodyID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO
CREATE TABLE Mortuary.DepositorDetails(
	DepositorDetailsID INTEGER PRIMARY KEY IDENTITY NOT NULL,
	BodyID INTEGER,
	DepositorFullName VARCHAR(20),
	DepositorAddress VARCHAR (max),
	DepositorRelationshipType VARCHAR(20),
	DepositorPhoneNumber VARCHAR(20),
	FOREIGN KEY (BodyID) REFERENCES Mortuary.Body(BodyID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO

CREATE TABLE Accounts.BillingType (
	BillingTypeID INT PRIMARY KEY IDENTITY,
	BillingTypeName VARCHAR(50) NOT NULL UNIQUE,
	BillingTypeDescription VARCHAR (100)
);

-- DEPRECATED
CREATE TABLE Accounts.BillingTypeCustomerCategories (
	CustomerCategoryID INT PRIMARY KEY IDENTITY,
	CustomerCategoryName VARCHAR(100) UNIQUE NOT NULL,
	CustomerCategoryDescription VARCHAR(250)
)
-- /DEPRECATED

CREATE TABLE Accounts.BillingTransactionStatuses (
	StatusID INT PRIMARY KEY IDENTITY,
	StatusName VARCHAR(20) UNIQUE NOT NULL,
	StatusDescription VARCHAR(250)
)

CREATE TABLE Accounts.BillingPaymentMethods (
	PaymentMethodID INT PRIMARY KEY IDENTITY,
	PaymentMethodName VARCHAR(20) UNIQUE NOT NULL,
	PaymentMethodDescription VARCHAR(250)
)

-- DEPRECATED
CREATE TABLE Accounts.BillingCustomerInfo (
	CustomerContactID INT PRIMARY KEY IDENTITY,
	CustomerCategoryID INT,
	CustomerContactName VARCHAR(100),
	CustomerContactPhone VARCHAR(20),
	CustomerContactAddress VARCHAR(500),
	FOREIGN KEY (CustomerCategoryID) REFERENCES [Accounts].[BillingTypeCustomerCategories] (CustomerCategoryID) ON UPDATE CASCADE ON DELETE SET NULL
)
-- /DEPRECATED

CREATE TABLE Accounts.BillingTypeItems (
	BillingTypeItemID INT PRIMARY KEY IDENTITY,
	BillingType INT,
	BillingTypeItemName VARCHAR (100) UNIQUE,
	BillingTypeItemPrice MONEY NOT NULL,
	RateBased BIT,
	RateIdentifier VARCHAR(100),
	IntervalBased BIT,
	FOREIGN KEY (BillingType) REFERENCES [Accounts].[BillingType] (BillingTypeID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Accounts.BillingTypeItemsInterval (
	BillingTypeItemsIntervalID INT PRIMARY KEY IDENTITY,
	BillingTypeItemID INT NOT NULL,
	Interval INT DEFAULT 1,
	IntervalIncrementType VARCHAR(50) DEFAULT 'custom',
	IntervalIncrement INT,
	CHECK (IntervalIncrementType = 'geometric' OR IntervalIncrementType = 'multiplicative' OR IntervalIncrementType = 'additive' OR IntervalIncrementType = 'custom'),
	FOREIGN KEY (BillingTypeItemID) REFERENCES Accounts.BillingTypeItems(BillingTypeItemID) ON UPDATE CASCADE ON DELETE CASCADE 
);

CREATE TABLE Accounts.BillingTransactionMeta (
	BillingTransactionMetaID INT PRIMARY KEY IDENTITY,
	BillingTransactionNumber VARCHAR(15) UNIQUE NOT NULL,
	PatientID INT,
	BillingType VARCHAR(50) NOT NULL,
	BilledAmountTotal MONEY,
	CreatedByUUID VARCHAR(20),
	DateCreated DATETIME NOT NULL DEFAULT GETDATE(),
	DateCreatedDateOnly DATE DEFAULT Cast(DateAdd(day, datediff(day, 0, GETDATE()), 0) as Date),
	BillingTransactionStatus VARCHAR(20) NOT NULL DEFAULT 'Unknown',
	FOREIGN KEY (BillingType) REFERENCES [Accounts].[BillingType] (BillingTypeName) ON UPDATE CASCADE ON DELETE NO ACTION,
	FOREIGN KEY (PatientID) REFERENCES [Patients].[Patient] (PatientID) ON UPDATE CASCADE ON DELETE NO ACTION,
	FOREIGN KEY (CreatedByUUID) REFERENCES [Staffs].[Staff] (StaffUUID) ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY (BillingTransactionStatus) REFERENCES [Accounts].[BillingTransactionStatuses] (StatusName) ON UPDATE CASCADE ON DELETE NO ACTION
)

CREATE TABLE Accounts.BillingTransactionItems (
	BillingTransactionItemID INT PRIMARY KEY IDENTITY,
	BillingTransactionMetaID INT NOT NULL,
	BillingTransactionItemName VARCHAR(100),
	BillingTransactionItemQuantity INT,
	BillingTransactionItemPrice MONEY,
	FOREIGN KEY (BillingTransactionMetaID) REFERENCES [Accounts].[BillingTransactionMeta] (BillingTransactionMetaID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BillingTransactionItemName) REFERENCES [Accounts].[BillingTypeItems] (BillingTypeItemName) ON UPDATE NO ACTION ON DELETE NO ACTION
)

CREATE TABLE Accounts.BillingTransaction (
	BillingTransactionID INT PRIMARY KEY IDENTITY,
	BillingTransactionMetaID INT,
	BillingTransactionDate DATETIME NOT NULL DEFAULT GETDATE(),
	BillingTransactionCustomerName VARCHAR(50),
	BillingTransactionCustomerPhone VARCHAR(20),
	BillingTransactionCustomerAddress VARCHAR(500),
	BillingPaymentMethod VARCHAR(20) NOT NULL,
	BillingAmountPaid MONEY NOT NULL,
	BillingAmountBalance MONEY,
	FOREIGN KEY (BillingTransactionMetaID) REFERENCES [Accounts].[BillingTransactionMeta] (BillingTransactionMetaID) ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY (BillingPaymentMethod) REFERENCES [Accounts].[BillingPaymentMethods] (PaymentMethodName) ON UPDATE CASCADE ON DELETE NO ACTION
)
GO

INSERT INTO Staffs.DepartmentGroup (GroupName) VALUES ('__');
INSERT INTO Staffs.Department (Name, GroupID) VALUES ('__', 1);
INSERT INTO Staffs.Role (Name, DepartmentID) VALUES ('Administrator', 1);


CREATE TABLE Pharmacy.Store (
	StoreID INT PRIMARY KEY IDENTITY NOT NULL,
	StoreName VARCHAR(50) NOT NULL UNIQUE,
	StoreDescription VARCHAR(100)
)
GO

CREATE TABLE Pharmacy.StoreInventoryProperties (
	StoreInventoryPropertiesID INT PRIMARY KEY IDENTITY NOT NULL,
	StoreID INT,
	PropertyName VARCHAR(20) NOT NULL,
	FOREIGN KEY (StoreID) REFERENCES Pharmacy.Store(StoreID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO
CREATE TABLE Pharmacy.StoreInventory(
	ItemID INT PRIMARY KEY IDENTITY NOT NULL,
	StoreID INT,
	ItemName VARCHAR(50),
	ItemQuantity INT,
	FOREIGN KEY (StoreID) REFERENCES Pharmacy.Store(StoreID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO
CREATE TABLE Pharmacy.StoreInventoryTags(
	TagID INT PRIMARY KEY IDENTITY NOT NULL,
	ItemID INT,
	TagTitle VARCHAR(50),
	TagName VARCHAR(100),
	FOREIGN KEY (ItemID) REFERENCES Pharmacy.StoreInventory(ItemID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO

CREATE TABLE Pharmacy.EligibleDispensory(
	EligibleDispensoryID INT PRIMARY KEY IDENTITY NOT NULL,
	EligibleDispensory VARCHAR(20) UNIQUE
)
GO

CREATE TABLE Pharmacy.Dispensee(
	DispenseeID INT PRIMARY KEY IDENTITY NOT NULL,
	DispenseeType VARCHAR(20),
	DispenseeTypeID INT
)
GO
CREATE TABLE Pharmacy.Dispensation(
	DispensationID INT PRIMARY KEY IDENTITY NOT NULL,
	DispensingStore VARCHAR(50),
	EligibleDispensory VARCHAR(20),
	DispenseeID INT,
	DispensationDate DATETIME NOT NULL DEFAULT 'GETDATE()',
	FOREIGN KEY (DispensingStore) REFERENCES Pharmacy.Store(StoreName) ON UPDATE CASCADE ON DELETE NO ACTION,
	FOREIGN KEY (EligibleDispensory) REFERENCES Pharmacy.EligibleDispensory(EligibleDispensory) ON UPDATE CASCADE ON DELETE NO ACTION,
	FOREIGN KEY (DispenseeID) REFERENCES Pharmacy.Dispensee(DispenseeID) on UPDATE CASCADE ON DELETE SET NULL
)
GO
CREATE TABLE Pharmacy.DispensedItems(
	DispensedItemsID INT PRIMARY KEY IDENTITY NOT NULL,
	DispensationID INT NOT NULL,
	ItemID INT,
	DispensedQuantity INT,
	FOREIGN KEY (DispensationID) REFERENCES Pharmacy.Dispensation(DispensationID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO

CREATE TABLE Consultancy.Tags(
	TagID INT PRIMARY KEY IDENTITY NOT NULL,
	TagName VARCHAR(50) UNIQUE,
	TagDescription VARCHAR(50)
)
GO

CREATE TABLE Consultancy.ConsultationSheet (
	ConsultationSheetID INT PRIMARY KEY IDENTITY NOT NULL,
	ConsultantID INT NOT NULL,
	Title VARCHAR(100) NOT NULL,
	Note VARCHAR(MAX) NOT NULL,
	CreationDate DATE NOT NULL DEFAULT GETDATE(),
	LastModified DATE NOT NULL DEFAULT GETDATE()
)
GO

CREATE TABLE Consultancy.ConsultationSheetTags (
	ConsultationSheetTagID INT PRIMARY KEY IDENTITY NOT NULL,
	SheetID INT,
	TagName VARCHAR(50),
	FOREIGN KEY (SheetID) REFERENCES Consultancy.ConsultationSheet(ConsultationSheetID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (TagName) REFERENCES Consultancy.Tags(TagName) ON UPDATE CASCADE ON DELETE CASCADE
)
GO


----- TSQL ENDS HERE ----
