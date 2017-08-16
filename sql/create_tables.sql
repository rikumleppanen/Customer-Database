CREATE TABLE Marketinguru(
    id SERIAL PRIMARY KEY, 
    name varchar(60) NOT NULL, 
    email varchar(40) NOT NULL, 
    admin_rights boolean,
    password varchar(50) NOT NULL);

CREATE TABLE Query(
    id SERIAL PRIMARY KEY,
    tstz TIMESTAMPTZ, 
    guru INTEGER REFERENCES Marketinguru(id));

CREATE TABLE Customer(
    id SERIAL PRIMARY KEY, 
    name varchar(60) NOT NULL, 
    email varchar(40),
    address varchar(120),
    number varchar(20),
    email_consent boolean,
    address_consent boolean,
    number_consent boolean,
    sms_consent boolean,
    thirdparty_consent boolean,
    created TIMESTAMP,
    modified TIMESTAMP,
    modifier integer REFERENCES Marketinguru(id));

CREATE TABLE QueryCustomer(
    id SERIAL PRIMARY KEY, 
    query INTEGER REFERENCES Query(id), 
    customer integer REFERENCES Customer(id));

CREATE TABLE Consent(
    id SERIAL PRIMARY KEY, 
    label varchar(50) NOT NULL);

CREATE TABLE CustomerConsent(
    id SERIAL PRIMARY KEY, 
    customer INTEGER REFERENCES Customer(id), 
    consent INTEGER  REFERENCES Consent(id),
    tstz TIMESTAMPTZ);
