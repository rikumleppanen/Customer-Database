INSERT INTO Guru(name, email, admin_rights,password) VALUES ('Matti Mansikka', 'matti','TRUE','1234');
INSERT INTO Guru(name, email, admin_rights,password) VALUES ('Raija Ratikka', 'raija','FALSE','4321');
INSERT INTO Query(tstz,guru) VALUES (NOW(), (SELECT id FROM Guru WHERE name = 'Matti Mansikka'));
INSERT INTO Customer(name, tstz) VALUES ('Osakeyhtiö AB', NOW());
INSERT INTO Customer(name, email, address, number, tstz) VALUES ('Ville','ak@ak.fi','Lopeentie','0101111', NOW());
INSERT INTO QueryCustomer(query, customer) VALUES ((SELECT id FROM Query WHERE guru = '1'),(SELECT id FROM Customer WHERE name = 'Osakeyhtiö AB'));
INSERT INTO Consent(label) VALUES ('Puhelin');
INSERT INTO Consent(label) VALUES ('Sähköposti');
INSERT INTO Consent(label) VALUES ('Kirje');
INSERT INTO CustomerConsent(customer, consent) VALUES ((SELECT id FROM Customer WHERE name = 'Osakeyhtiö AB'),(SELECT id FROM Consent WHERE label = 'Sähköposti'));


