INSERT INTO Marketinguru(name, email, admin_rights,password) VALUES ('Matti Testaaja', 'matti@testi.com','t','1234');
INSERT INTO Marketinguru(name, email, admin_rights,password) VALUES ('Raija Testaaja', 'raija@testi.com','f','4321');
INSERT INTO Marketinguru(name, email, admin_rights,password) VALUES ('Ville Testaaja', 'ville@testi.com','f','12345');
INSERT INTO Query(name, created, guru, email_consent, address_consent) VALUES ('CampaignNow', NOW(), (SELECT id FROM Marketinguru WHERE name = 'Matti Testaaja'),'t','t');
INSERT INTO Query(name, created, guru, email_consent) VALUES ('CampaignLong', NOW(), 1, '1');
INSERT INTO Customer(name, created) VALUES ('Osakeyhtiö AB', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Ville','ak@ak.fi','Lopeentie','0101111', 't','t','t','f','f', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Aino V','aino@hotnail.fi','Nakkitie','0101111', 't','t','f','f','t', NOW());
INSERT INTO Querycustomer(query, customer) SELECT DISTINCT 1, id as customer FROM Customer WHERE email_consent = true AND address_consent = true;
INSERT INTO Product(name) VALUES ('A');
INSERT INTO Product(name) VALUES ('B');
INSERT INTO Product(name) VALUES ('AB');
INSERT INTO Product(name) VALUES ('ABC');
INSERT INTO Subscription(startdate, created,  customer, product) VALUES (to_char((NOW()-interval'1 day'),'YYYY-MM-DD'), to_char((NOW()-interval'10 day'),'YYYY-MM-DD'), (SELECT id FROM Customer WHERE name = 'Osakeyhtiö AB'),(SELECT id FROM Product WHERE name = 'A'));


