CREATE TABLE Marketinguru(
    id SERIAL PRIMARY KEY, 
    name varchar(60) NOT NULL, 
    email varchar(40) NOT NULL UNIQUE, 
    admin_rights boolean,
    password varchar(50) NOT NULL
);

CREATE TABLE Query(
    id SERIAL PRIMARY KEY,
    name varchar(60),
    created TIMESTAMP, 
    guru integer REFERENCES Marketinguru(id) ON DELETE CASCADE,
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
    email_consent boolean DEFAULT FALSE,
    address_consent boolean DEFAULT FALSE,
    number_consent boolean DEFAULT FALSE,
    sms_consent boolean DEFAULT FALSE,
    thirdparty_consent boolean DEFAULT FALSE,
    created TIMESTAMP,
    modified TIMESTAMP,
    modifier integer REFERENCES Marketinguru(id) ON DELETE CASCADE
);

CREATE TABLE Querycustomer(  
    query integer REFERENCES Query(id) ON DELETE CASCADE,
    customer integer REFERENCES Customer(id) ON DELETE CASCADE,
    PRIMARY KEY (query, customer)
);

CREATE TABLE Product(
    id SERIAL PRIMARY KEY, 
    name varchar(50) NOT NULL
);

CREATE TABLE Subscription(
    id SERIAL PRIMARY KEY, 
    startdate VARCHAR(40),
    enddate VARCHAR(40),
    created VARCHAR(40),
    cancelled VARCHAR(40),
    customer INTEGER REFERENCES Customer(id) ON DELETE CASCADE,
    product INTEGER REFERENCES Product(id) ON DELETE CASCADE
);
