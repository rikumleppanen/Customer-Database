CREATE TABLE Guru(
    id SERIAL PRIMARY KEY, 
    name varchar(60) NOT NULL, 
    email varchar(40) NOT NULL, 
    admin_rights boolean default FALSE,
    password varchar(50) NOT NULL);

CREATE TABLE Query(
    id SERIAL PRIMARY KEY,
    tstz TIMESTAMPTZ, 
    guru INTEGER REFERENCES Guru(id));

CREATE TABLE Customer(
    id SERIAL PRIMARY KEY, 
    name varchar(60) NOT NULL, 
    email varchar(40),
    address varchar(120),
    number varchar(20),
    email_consent boolean default FALSE,
    address_consent boolean default FALSE,
    number_consent boolean default FALSE,
    sms_consent boolean default FALSE,
    thirdparty_consent boolean default FALSE,
    tstz TIMESTAMPTZ);

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
