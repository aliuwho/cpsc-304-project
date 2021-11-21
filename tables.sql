DROP TABLE Suggests;
DROP TABLE Pickup;
DROP TABLE LocationAddress;
DROP TABLE BelongsTo;
DROP TABLE Bid;
DROP TABLE Receives;
DROP TABLE Review;
DROP TABLE Broadcast;
DROP TABLE Flag;
DROP TABLE Ticket;
DROP TABLE Category;
DROP TABLE Request;
DROP TABLE Listing;
DROP TABLE Post;
DROP TABLE Moderator;
DROP TABLE Account;
CREATE TABLE Account (
        id INTEGER,
        name VARCHAR(30) NOT NULL,
        password VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        status INTEGER DEFAULT 1,
        suspend_mid INTEGER DEFAULT 0,
        PRIMARY KEY(id)
);
CREATE TABLE Moderator (
        id INTEGER,
        PRIMARY KEY(id),
        welcome_message VARCHAR(100) DEFAULT 'Welcome, dear moderator!',
        promotion_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY(id) REFERENCES Account
);
CREATE TABLE Ticket (
        tid INTEGER,
        aid INTEGER NOT NULL,
        mid INTEGER,
        t_subject VARCHAR(50),
        t_category VARCHAR(30),
        t_priority INTEGER DEFAULT 0,
        created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(tid),
        FOREIGN KEY(aid) REFERENCES Account,
        FOREIGN KEY(mid) REFERENCES Moderator
);
create table Flag (
        f_id Integer,
        f_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        f_description VARCHAR(200),
        aid INTEGER NOT NULL,
        mid INTEGER NOT NULL,
        FOREIGN KEY(aid) REFERENCES Account,
        FOREIGN KEY(mid) REFERENCES Moderator,
        PRIMARY KEY(f_id)
);
create table Broadcast (
        b_id Integer,
        b_message VARCHAR(200),
        b_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(b_id)
);
create table Review (
        r_id Integer,
        receiver_id Integer NOT NULL,
        poster_id Integer NOT NULL,
        r_description VARCHAR(200),
        r_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(r_id, receiver_id),
        FOREIGN KEY(receiver_id) REFERENCES Account,
        FOREIGN KEY(poster_id) REFERENCES Account
);
create table Receives (
        b_id INTEGER not NULL,
        a_id INTEGER not NULL,
        PRIMARY KEY(b_id, a_id),
        FOREIGN KEY(b_id) REFERENCES Broadcast,
        FOREIGN KEY(a_id) REFERENCES Account
);
CREATE TABLE Category (name VARCHAR(20) PRIMARY KEY NOT NULL);
CREATE TABLE Post (
        post_id INTEGER,
        post_type VARCHAR(10) NOT NULL,
        account_id INTEGER NOT NULL,
        created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        expiration TIMESTAMP NOT NULL,
        post_status VARCHAR(15) NOT NULL,
        PRIMARY KEY(post_id),
        FOREIGN KEY (account_id) REFERENCES Account
);
CREATE TABLE Listing (
        post_id INTEGER,
        item VARCHAR(50) NOT NULL,
        PRIMARY KEY(post_id),
        FOREIGN KEY(post_id) REFERENCES Post
);
CREATE TABLE Request (
        post_id INTEGER NOT NULL,
        post_description VARCHAR(50) NOT NULL,
        fulfilled INTEGER DEFAULT 0,
        fulfilled_on TIMESTAMP,
        fulfilled_id INTEGER DEFAULT 0,
        PRIMARY KEY(post_id),
        FOREIGN KEY(post_id) REFERENCES Post,
        FOREIGN KEY(fulfilled_id) REFERENCES Account
);
CREATE TABLE Bid (
        id INTEGER,
        message VARCHAR(120),
        lid INTEGER NOT NULL,
        aid INTEGER NOT NULL,
        chosen INTEGER DEFAULT 0,
        PRIMARY KEY(id),
        FOREIGN KEY(aid) REFERENCES Account,
        FOREIGN KEY(lid) REFERENCES Listing
);
CREATE TABLE BelongsTo (
        post_id INTEGER NOT NULL,
        category VARCHAR(20) NOT NULL,
        PRIMARY KEY(post_id, category),
        FOREIGN KEY(post_id) REFERENCES Post,
        FOREIGN KEY(category) REFERENCES Category
);
CREATE TABLE LocationAddress (
        streetname VARCHAR(30) NOT NULL,
        streetno INTEGER,
        postalcode VARCHAR(6) NOT NULL,
        PRIMARY KEY(streetname, streetno)
);
CREATE TABLE Pickup (
        pickupid INTEGER,
        description VARCHAR(100) NOT NULL,
        streetname NOT NULL,
        streetno NOT NULL,
        PRIMARY KEY(pickupid),
        FOREIGN KEY(streetname, streetno) REFERENCES LocationAddress
);
CREATE TABLE Suggests (
        post_id INTEGER,
        pickup_id INTEGER,
        suggested_time TIMESTAMP,
        PRIMARY KEY(post_id, pickup_id, suggested_time),
        FOREIGN KEY(post_id) REFERENCES Post,
        FOREIGN KEY(pickup_id) REFERENCES Pickup
);