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

CREATE SCHEMA Nursing;
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



CREATE TABLE Mortuary.BodyStatus (
	BodyStatusID INT PRIMARY KEY IDENTITY NOT NULL,
	StatusShortCode VARCHAR(5) UNIQUE,
	StatusName VARCHAR(50),
)
GO

CREATE TABLE Mortuary.Body (
	BodyID INTEGER PRIMARY KEY IDENTITY NOT NULL,
	DeathPhysicianID INTEGER,
	DateOfDeath DATE NOT NULL,
	PlaceOfDeath VARCHAR(100) NOT NULL,
	BodyStatus VARCHAR(5),
	CreationDate DATETIME NOT NULL DEFAULT GETDATE(),
	LastModified DATETIME NOT NULL DEFAULT GETDATE(),
	FOREIGN KEY (BodyStatus) REFERENCES Mortuary.BodyStatus (StatusShortCode) ON UPDATE CASCADE ON DELETE SET NULL
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
CREATE TABLE Mortuary.Tags(
	TagID INTEGER PRIMARY KEY IDENTITY NOT NULL,
	TagName VARCHAR(50) UNIQUE,
)
GO
CREATE TABLE Mortuary.BodyTag(
	BodyTagID INTEGER PRIMARY KEY IDENTITY NOT NUlL,
	BodyID INTEGER,
	TagName VARCHAR(50),
	FOREIGN KEY (BodyID) REFERENCES Mortuary.Body(BodyID) ON UPDATE CASCADE ON DELETE NO ACTION
)
GO

--Insert four major Body Status types into the Mortuary.BodyStatus Table.

-- Items below are listed in (StatusShortCode, StatusName) table column order respectively
-- (RIP, Registration In Progress)
-- (LI, Logged In)
-- (LOP, Log Out In Progress)
-- (LO, Logged Out)

INSERT INTO Mortuary.BodyStatus VALUES
('RIP', 'Registration In Progress'),
('LI', 'Logged In'),
('LOP', 'Log Out In Progress'),
('LO', 'Logged Out');


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
	FOREIGN KEY (BillingType) REFERENCES [Accounts].[BillingType] (BillingTypeID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Accounts.BillingTypeItemsPrices (
	BillingTypeItemsPricesID INT PRIMARY KEY IDENTITY,
	BillingTypeItem INT,
	PatientType INT,
	BillingTypeItemPrice MONEY NOT NULL,
	RateBased BIT,
	RateIdentifier VARCHAR(100),
	IntervalBased BIT,
	FOREIGN KEY (BillingTypeItem) REFERENCES [Accounts].[BillingTypeItems] (BillingTypeItemID) ON UPDATE CASCADE ON DELETE CASCADE,
	UNIQUE(BillingTypeItem, PatientType)
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


CREATE TABLE Patients.FieldTitleType (
	TypeID INT PRIMARY KEY IDENTITY NOT NULL,
	TypeName VARCHAR(50) UNIQUE,
	TypeDescription VARCHAR(50)
)

CREATE TABLE Patients.PatientRecordsFieldTitle (
	FieldTitleID INT PRIMARY KEY IDENTITY NOT NULL,
	FieldTitleName VARCHAR(50) UNIQUE,
	FieldTitleType VARCHAR(50),
	FieldTitleDescription VARCHAR(50),
	FOREIGN KEY (FieldTitleType) REFERENCES Patients.FieldTitleType(TypeName) ON UPDATE CASCADE ON DELETE NO ACTION
)

CREATE TABLE Patients.PatientTypeCategories (
	CategoryID INT PRIMARY KEY IDENTITY,
	CategoryName VARCHAR(100) UNIQUE,
	CategoryDescription VARCHAR(500)
)

CREATE TABLE Patients.PatientType (
	PatientTypeID INT PRIMARY KEY IDENTITY,
	CategoryName VARCHAR(100),
	PatientTypeName VARCHAR(100),
	PatientTypeDescription VARCHAR(500),
	FOREIGN KEY (CategoryName) REFERENCES Patients.PatientTypeCategories(CategoryName) ON UPDATE CASCADE ON DELETE SET NULL
)

CREATE TABLE Patients.Patient (
	PatientID INT PRIMARY KEY IDENTITY,
	PatientFullName VARCHAR(50),
	PatientPicture VARCHAR(MAX),
	PatientType INT,
	PatientIdentificationDocument VARCHAR(MAX),
	PatientUUID VARCHAR(20) UNIQUE NOT NULL,
	FOREIGN KEY (PatientType) REFERENCES Patients.PatientType (PatientTypeID) ON UPDATE CASCADE ON DELETE SET NULL
)

CREATE TABLE Patients.PatientRecordsFieldValue (
	FieldValueID INT PRIMARY KEY IDENTITY NOT NULL,
	PatientID INT,
	FieldTitle VARCHAR(50),
	FieldValue VARCHAR(max),
	FOREIGN KEY (PatientID) REFERENCES Patients.Patient(PatientID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (FieldTitle) REFERENCES Patients.PatientRecordsFieldTitle(FieldTitleName) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE Patients.PatientHospitalHistory (
	HospitalHistoryID INT PRIMARY KEY IDENTITY NOT NULL,
	PatientID INT NOT NULL,
	DateAttended DATETIME,
	ReferredBy VARCHAR(50),
	Physician VARCHAR(50),
	Ward VARCHAR(50),
	DateDischarged DATETIME,
	DischargedTo VARCHAR(50),
	Condition VARCHAR(50),
	FOREIGN KEY (PatientID) REFERENCES Patients.Patient(PatientID) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE Patients.PatientDiagnosis (
	DiagnosisID INT PRIMARY KEY IDENTITY NOT NULL,
	PatientID INT NOT NULL,
	DaignosisDate DATETIME,
	CodeNumber VARCHAR(50),
	DiagnosisType VARCHAR(20),
	Diagnosis VARCHAR(MAX),
	FOREIGN KEY (PatientID) REFERENCES Patients.Patient(PatientID) ON UPDATE CASCADE ON DELETE CASCADE,
	CHECK (DiagnosisType = 'operation' OR DiagnosisType = 'diagnosis')
)

CREATE TABLE Patients.PatientProcessCheck (
	ProcessCheckID INT PRIMARY KEY IDENTITY NOT NULL,
	PatientID INT NOT NULL,
	ProcessCheck VARCHAR(50),
	FOREIGN KEY (PatientID) REFERENCES Patients.Patient(PatientID) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE Patients.PatientProcessCheckDates (
	ProcessCheckDateID INT PRIMARY KEY IDENTITY NOT NULL,
	ProcessCheckID INT NOT NULL,
	ProcessCheckDateTitle VARCHAR(50),
	ProcessCheckDate DATE,
	FOREIGN KEY (ProcessCheckID) REFERENCES Patients.PatientProcessCheck(ProcessCheckID) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE Patients.PatientDepartment (
	PatientDepartmentID INT PRIMARY KEY IDENTITY NOT NULL,
	PatientID INT,
	DepartmentID INT,
	FOREIGN KEY (PatientID) REFERENCES Patients.Patient(PatientID) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE Patients.PatientTransaction(
	PatientTransactionID INT PRIMARY KEY IDENTITY NOT NULL,
	PatientID INT,
	Link VARCHAR(max),
	Meta VARCHAR(max),
	FOREIGN KEY (PatientID) REFERENCES Patients.Patient(PatientID) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE Patients.PatientRepository (
	RepositoryItemID INT PRIMARY KEY IDENTITY NOT NULL,
	PatientID INT,
	RepositoryItemNumber VARCHAR(50) NOT NULL UNIQUE,
	RepositoryItemName VARCHAR(100),
	RepositoryItemDescription VARCHAR(4000),
	RepositoryItemUrl VARCHAR(MAX),
	FOREIGN KEY (PatientID) REFERENCES Patients.Patient(PatientID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO

INSERT INTO Patients.FieldTitleType (TypeName) VALUES ('Name'), ('Text'), ('Number'), ('Date'), ('File') 
INSERT INTO Patients.PatientRecordsFieldTitle (FieldTitleName, FieldTitleType) VALUES
('First Name', 'Name'),
('Last Name', 'Name'),
('Gender', 'Name'),
('Date Of Birth', 'Date'),
('Marital Status', 'Name'),
('Home Address', 'Text'),
('Mothers Maiden Name', 'Name'),
('Medical Hand Card Number', 'Name'),
('Phone Number', 'Name'),
('Reference Contact, Emergency', 'Text'),
('Reference Contact, Minor', 'Text'),
('State Of Origin', 'Name'),
('LGA', 'Name'),
('State Of Residence', 'Name'),
('Religious Affiliation', 'Name'),
('Occupation', 'Name'),
('Tribe', 'Name'),
('Email Address', 'Text'),
('Next Of Kin', 'Name');

INSERT INTO Staffs.DepartmentGroup (GroupName) VALUES ('__');
INSERT INTO Staffs.Department (Name, GroupID) VALUES ('__', 1);
INSERT INTO Staffs.Role (Name, DepartmentID) VALUES ('Administrator', 1);


CREATE TABLE Nursing.ObservationChartFieldTitleType (
	TypeID INT PRIMARY KEY IDENTITY NOT NULL,
	TypeName VARCHAR(50) UNIQUE,
	TypeDescription VARCHAR(50)
)
GO

CREATE TABLE Nursing.ObservationChartFieldTitle (
	FieldTitleID INT PRIMARY KEY IDENTITY NOT NULL,
	FieldTitleName VARCHAR(50) UNIQUE,
	FieldTitleType VARCHAR(50),
	FieldTitleDescription VARCHAR(50),
	FOREIGN KEY (FieldTitleType) REFERENCES Patients.FieldTitleType(TypeName) ON UPDATE CASCADE ON DELETE CASCADE
)
GO
CREATE TABLE Nursing.ObservationChart(
	ObservationChartID INT PRIMARY KEY IDENTITY NOT NULL,
	PatientID VARCHAR(20),
	StaffID VARCHAR(20),
	ObservationDate DATE NOT NULL DEFAULT GETDATE(),
	FOREIGN KEY (PatientID) REFERENCES Patients.Patient(PatientUUID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (StaffID) REFERENCES Staffs.Staff(StaffUUID) ON UPDATE CASCADE ON DELETE NO ACTION
)
GO

CREATE TABLE Nursing.ObservationChartFieldValue (
	FieldValueID INT PRIMARY KEY IDENTITY NOT NULL,
	ObservationChartID INT,
	FieldTitle VARCHAR(50),
	FieldValue VARCHAR(max),
	FOREIGN KEY (FieldTitle) REFERENCES Nursing.ObservationChartFieldTitle(FieldTitleName) ON UPDATE CASCADE ON DELETE NO ACTION,
	FOREIGN KEY (ObservationChartID) REFERENCES Nursing.ObservationChart(ObservationChartID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO
CREATE TABLE Nursing.Ward(
	WardID INT PRIMARY KEY IDENTITY NOT NULL,
	WardName VARCHAR(50) UNIQUE,
	WardDescription VARCHAR(50),
	CreatedDate DATE NOT NULL DEFAULT GETDATE(),
	UpdatedDate DATE NOT NULL DEFAULT GETDATE()
)
GO
CREATE TABLE Nursing.WardSection(
	WardSectionID INT PRIMARY KEY IDENTITY NOT NULL,
	WardID INT,
	WardSectionName VARCHAR(50) UNIQUE,
	WardSectionDescription VARCHAR(50),
	CreatedDate DATE NOT NULL DEFAULT GETDATE(),
	UpdatedDate DATE NOT NUll DEFAULT GETDATE(),
	FOREIGN KEY (WardID) REFERENCES Nursing.Ward(WardID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO
CREATE TABLE Nursing.SectionBed(
	SectionBedID INT PRIMARY KEY IDENTITY NOT NULL,
	WardSectionID INT,
	BedName VARCHAR(50) UNIQUE,
	BedDescription VARCHAR(50),
	FOREIGN KEY (WardSectionID) REFERENCES Nursing.WardSection(WardSectionID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO
CREATE TABLE Nursing.BedAssignment(
	BedAssignmentID INT PRIMARY KEY IDENTITY NOT NUll,
	BedName VARCHAR(50),
	AssignmentLeased BIT,
	AssignmentDate DATE NOT NULL DEFAULT GETDATE(),
	FOREIGN KEY (BedName) REFERENCES Nursing.SectionBed(BedName) ON UPDATE CASCADE ON DELETE CASCADE
)
GO
----- TSQL ENDS HERE ----
