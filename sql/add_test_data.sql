INSERT INTO Guru(name, email, admin_rights,password) VALUES ('Matti Mansikka', 'matti','t','1234');
INSERT INTO Guru(name, email, admin_rights,password) VALUES ('Raija Ratikka', 'raija','f','4321');
INSERT INTO Query(tstz,guru) VALUES (NOW(), (SELECT id FROM Guru WHERE name = 'Matti Mansikka'));
INSERT INTO Customer(name, tstz) VALUES ('Osakeyhtiö AB', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, thirdparty_consent, tstz) VALUES ('Ville','ak@ak.fi','Lopeentie','0101111', 't','t','t', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, thirdparty_consent, tstz) VALUES ('Aino V','aino@hotnail.fi','Nakkitie','0101111', 't','t','f', NOW());
INSERT INTO QueryCustomer(query, customer) VALUES ((SELECT id FROM Query WHERE guru = '1'),(SELECT id FROM Customer WHERE name = 'Osakeyhtiö AB'));
INSERT INTO Consent(label) VALUES ('Phone');
INSERT INTO Consent(label) VALUES ('Email');
INSERT INTO Consent(label) VALUES ('SMS');
INSERT INTO Consent(label) VALUES ('Direct');
INSERT INTO Consent(label) VALUES ('ThirdParty');
INSERT INTO CustomerConsent(customer, consent) VALUES ((SELECT id FROM Customer WHERE name = 'Osakeyhtiö AB'),(SELECT id FROM Consent WHERE label = 'Phone'));


