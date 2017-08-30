INSERT INTO Marketinguru(name, email, admin_rights,password) VALUES ('Matti Testaaja', 'matti@testi.com','t','1234');
INSERT INTO Marketinguru(name, email, admin_rights,password) VALUES ('Raija Testaaja', 'raija@testi.com','f','4321');
INSERT INTO Marketinguru(name, email, admin_rights,password) VALUES ('Ville Testaaja', 'ville@testi.com','f','12345');
INSERT INTO Marketinguru(name, email, admin_rights,password) VALUES ('Maija Matikainen', 'maija@testi.com','t','*1332*');
INSERT INTO Marketinguru(name, email, admin_rights,password) VALUES ('Raimo Viljakainen', 'raimo@testi.com','t','!!!!');
INSERT INTO Marketinguru(name, email, admin_rights,password) VALUES ('Aleksi Rikkilaari', 'aleksi@testi.com','f','+!!!!');

INSERT INTO Query(name, created, guru, email_consent, address_consent) VALUES ('CampaignNow', NOW(), (SELECT id FROM Marketinguru WHERE name = 'Matti Testaaja'),'t','t');
INSERT INTO Query(name, created, guru, email_consent) VALUES ('CampaignLong', NOW(), 1, '1');
INSERT INTO Query(name, created, guru, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent) VALUES ('CampaingALL', NOW(), 3, '1', '1', '1', '1', '1');
INSERT INTO Query(name, created, guru, address_consent) VALUES ('AddressCampaign', NOW(), 2, '1');
INSERT INTO Query(name, created, guru, sms_consent) VALUES ('SMSRemember', NOW(), 4, '1');

INSERT INTO Customer(name, created) VALUES ('Osakeyhtiö AB', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Ville','ak@ak.fi','Lopeentie','0101111', 't','t','t','f','f', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Aino V','aino@hotnail.fi','Nakkitie','0101111', 't','t','f','f','t', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Reisjärven Tiili Ky','tiilikainen@tiili.net','Reisjärven kylätie','23334353', 't','t','f','f','t', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Laakkosen Kasvit','firma@kasvit.com','Laakkosentie','23241', 't','t','f','f','t', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Lintuvaaran Korjaamo','firma@korjaamo.fi','Lintuvaaran väylä','324234', 'f','f','t','t','t', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Mutteritehdas Korhoset','korhoset@korhoset.net','Vasarakatu','4546433', 'f','t','f','f','f', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Ville Vainio','','Huvilakatu 2 A 4','34435353', 't','f','t','t','f', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Anne Laaksonen','anne.laaksonen@sahkposti.com','Museokatu','6646446', 't','f','t','f','t', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Matti Miettinen','matti@aivanikioma.com','Turun väylä','343534', 't','t','t','t','t', NOW());
INSERT INTO Customer(name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES ('Antti Autio','aa@autio.net','Strömberginkatu 4','35564454', 't','f','f','f','t', NOW());

INSERT INTO Querycustomer(query, customer) SELECT DISTINCT 1, id as customer FROM Customer WHERE email_consent = true AND address_consent = true;
INSERT INTO Querycustomer(query, customer) SELECT DISTINCT 2, id as customer FROM Customer WHERE email_consent = true;
INSERT INTO Querycustomer(query, customer) SELECT DISTINCT 3, id as customer FROM Customer WHERE email_consent = true AND address_consent = true AND number_consent = true AND sms_consent = true AND thirdparty_consent = true;
INSERT INTO Querycustomer(query, customer) SELECT DISTINCT 4, id as customer FROM Customer WHERE address_consent = true;
INSERT INTO Querycustomer(query, customer) SELECT DISTINCT 5, id as customer FROM Customer WHERE sms_consent = true;

INSERT INTO Product(name) VALUES ('Product A');
INSERT INTO Product(name) VALUES ('Product B');
INSERT INTO Product(name) VALUES ('Bundle AB');
INSERT INTO Product(name) VALUES ('Bundle ABC');

INSERT INTO Subscription(startdate, created,  customer, product) VALUES (to_char((NOW()-interval'1 day'),'YYYY-MM-DD'), to_char((NOW()-interval'10 day'),'YYYY-MM-DD'), (SELECT id FROM Customer WHERE name = 'Osakeyhtiö AB'),(SELECT id FROM Product WHERE name = 'A'));
INSERT INTO Subscription(startdate, created,  customer, product) VALUES (to_char((NOW()-interval'10 day'),'YYYY-MM-DD'), to_char((NOW()-interval'20 day'),'YYYY-MM-DD'), 3,3);
INSERT INTO Subscription(startdate, created,  customer, product) VALUES (to_char((NOW()-interval'1 day'),'YYYY-MM-DD'), to_char((NOW()-interval'10 day'),'YYYY-MM-DD'), 4, 2);
INSERT INTO Subscription(startdate, created,  customer, product) VALUES (to_char((NOW()-interval'1 day'),'YYYY-MM-DD'), to_char((NOW()-interval'10 day'),'YYYY-MM-DD'), 5,1);
INSERT INTO Subscription(startdate, enddate, created,  cancelled, customer, product) VALUES ('2016-12-12','2017-06-12','2016-12-10','2017-05-05', 5,2);
INSERT INTO Subscription(startdate, created,  customer, product) VALUES ('2018-01-01','2017-08-30', 5, 3);
INSERT INTO Subscription(startdate, created,  customer, product) VALUES (to_char((NOW()-interval'10 day'),'YYYY-MM-DD'), to_char((NOW()-interval'20 day'),'YYYY-MM-DD'), 6,2);
INSERT INTO Subscription(startdate, enddate, created,  cancelled, customer, product) VALUES ('2017-01-12','2017-08-16','2016-12-10','2017-06-05', 6,1);
INSERT INTO Subscription(startdate, created,  customer, product) VALUES ('2018-01-01','2017-08-30', 7, 4);
INSERT INTO Subscription(startdate, created,  customer, product) VALUES ('2018-01-01','2017-08-30', 8, 4);
INSERT INTO Subscription(startdate, created,  customer, product) VALUES ('2018-01-01','2017-08-30', 9, 4);
INSERT INTO Subscription(startdate, created,  customer, product) VALUES ('2018-01-01','2017-08-30', 10, 4);
INSERT INTO Subscription(startdate, created,  customer, product) VALUES ('2018-01-01','2017-08-30', 11, 4);
INSERT INTO Subscription(startdate, enddate, created,  cancelled, customer, product) VALUES ('2015-01-12','2017-03-16','2015-01-12','2017-03-05', 7,1);
INSERT INTO Subscription(startdate, enddate, created,  cancelled, customer, product) VALUES ('2013-02-05','2017-01-16','2013-02-05','2017-01-05', 8,1);
INSERT INTO Subscription(startdate, enddate, created,  cancelled, customer, product) VALUES ('2012-03-13','2017-08-16','2012-02-26','2017-06-05', 9,1);
INSERT INTO Subscription(startdate, enddate, created,  cancelled, customer, product) VALUES ('2011-04-25','2017-07-07','2011-04-25','2017-06-05', 10,1);
INSERT INTO Subscription(startdate, enddate, created,  cancelled, customer, product) VALUES ('2010-07-12','2017-08-20','2010-07-10','2017-08-20', 2,1);

