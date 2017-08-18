CREATE TABLE Marketinguru(
    id SERIAL PRIMARY KEY, 
    name varchar(60) NOT NULL, 
    email varchar(40) NOT NULL, 
    admin_rights boolean,
    password varchar(50) NOT NULL);

CREATE TABLE Query(
    id SERIAL PRIMARY KEY,
    name varchar(60),
    created TIMESTAMP, 
    guru INTEGER REFERENCES Marketinguru(id),
    email_consent boolean DEFAULT FALSE,
    address_consent boolean DEFAULT FALSE,
    number_consent boolean DEFAULT FALSE,
    sms_consent boolean DEFAULT FALSE,
    thirdparty_consent boolean DEFAULT FALSE,
    sum_rows integer
    );

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

CREATE TABLE Querycustomer(
    id SERIAL PRIMARY KEY, 
    query INTEGER REFERENCES Query(id), 
    customer integer REFERENCES Customer(id));

CREATE TABLE Product(
    id SERIAL PRIMARY KEY, 
    name varchar(50) NOT NULL);

CREATE TABLE Subscription(
    id SERIAL PRIMARY KEY, 
    startdate varchar(40),
    enddate varchar(40),
    created varchar(40),
    cancelled varchar(40),
    customer INTEGER REFERENCES Customer(id), 
    product INTEGER REFERENCES Product(id));
