CREATE TABLE Accounts.BillingPaymentPayeeInformation (
	BillingPaymentPayeeID INTEGER PRIMARY KEY IDENTITY,
	BillingPaymentPayeeFullName VARCHAR (50) NOT NULL,
	BillingPaymentPayeePhoneNumber VARCHAR (20),
	BillingPaymentPayeeAddress VARCHAR (100)
)
GO
CREATE TABLE Accounts.BillingPayment (
	BillingPaymentID INTEGER PRIMARY KEY IDENTITY,
	BillingPaymentNumber VARCHAR (100) UNIQUE NOT NULL,
	BillingPaymentPaidAmount MONEY NOT NULL,
	BillingPaymentPayee INTEGER,
	FOREIGN KEY (BillingPaymentPayee) REFERENCES [Accounts].[BillingPaymentPayeeInformation] (BillingPaymentPayeeID) ON UPDATE CASCADE ON DELETE SET NULL
);
GO