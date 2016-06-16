CREATE SCHEMA Patient;
GO

CREATE TABLE Patient.VitalSign (
	VitalSignID INTEGER PRIMARY KEY IDENTITY,
	PatientID INTEGER,
	Temperature VARCHAR(20) NOT NULL,
	PulseRate VARCHAR(20),
	RespirationRate VARCHAR(20),
	Bloodpressure VARCHAR(20),,
	weight VARCHAR(20),
	RespirationRate VARCHAR(20),
	Bloodpressure VARCHAR(20),,
	CreatedDate DATE NOT NULL,
	UpdatedDate DATE NOT NULL,
	FOREIGN KEY (PatientID) REFERENCES Patient.VitalSign(PatientID) ON UPDATE CASCADE ON DELETE CASCADE
)
GO