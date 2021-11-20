DROP TABLE Pickup;
DROP TABLE LocationAddress;
DROP TABLE Suggests;
DROP TABLE BelongsTo;
DROP TABLE Request;
DROP TABLE Listing;
DROP TABLE Post;
DROP TABLE Category;
DROP TABLE Receives;
DROP TABLE Review;
DROP TABLE Broadcast;
DROP TABLE Flag;
DROP TABLE Ticket;
DROP TABLE Bid;
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
        welcome_message VARCHAR(100) DEFAULT "Welcome, dear moderator!",
        promotion_date TIMESTAMP DEFAULT NOW,
        FOREIGN KEY(id) REFERENCES Account
);
CREATE TABLE Bid (
        id INTEGER,
        message VARCHAR(120),
        lid INTEGER,
        aid INTEGER,
        chosen INTEGER DEFAULT 0,
        FOREIGN KEY(aid) REFERENCES Account NOT NULL,
        FOREIGN KEY(lid) REFERENCES Listing NOT NULL,
        PRIMARY KEY(id)
);
CREATE TABLE Ticket (
        tid Integer,
        aid Integer NOT NULL,
        mid Integer DEFAULT 0,
        t_subject char(50),
        t_category char(11),
        t_priority boolean,
        PRIMARY KEY(tid),
        FOREIGN KEY(aid) REFERENCES Account,
        FOREIGN KEY(mid) REFERENCES Moderator
);
create table Flag (
        f_id Integer,
        f_date char(20),
        f_description char(200),
        aid INTEGER NOT NULL,
        mid INTEGER NOT NULL,
        FOREIGN KEY(aid) REFERENCES Account,
        FOREIGN KEY(mid) REFERENCES Moderator PRIMARY KEY(f_id)
);
create table Broadcast (
        b_id Integer,
        b_message char(200),
        b_date char(20),
        b_time char (11),
        PRIMARY KEY(b_id)
);
create table Review (
        r_id Integer,
        receiver_id Integer NOT NULL,
        poster_id Integer NOT NULL,
        r_description char(200),
        r_time datetime(11),
        PRIMARY KEY(r_id, receiver_id),
        FOREIGN KEY(receiver_id) REFERENCES Account,
        FOREIGN KEY(poster_id) REFERENCES Account,
);
create table Receives (
        b_id char(11) not NULL,
        a_id char(11) not NULL,
        PRIMARY KEY(b_id, a_id),
        FOREIGN KEY(b_id) REFERENCES Broadcast,
        FOREIGN KEY(a_id) REFERENCES Account
);
CREATE TABLE Category (name VARCHAR(20) PRIMARY KEY NOT NULL);
CREATE TABLE Post (
        post_id INTEGER,
        post_type VARCHAR(10) NOT NULL,
        account_id INTEGER NOT NULL,
        created_on TIMESTAMP NOT NULL DEFAULT NOW,
        updated_on TIMESTAMP NOT NULL DEFAULT NOW,
        expiration DATETIME NOT NULL,
        post_status VARCHAR(10) NOT NULL,
        PRIMARY KEY(post_id),
        FOREIGN KEY (account_id) REFERENCES Account(account_id)
);
) CREATE TABLE Listing (
        post_id INTEGER,
        FOREIGN KEY(post_id) REFERENCES Post,
        item VARCHAR(50) NOT NULL,
        PRIMARY KEY(postid)
);
CREATE TABLE Request (
        post_id INTEGER NOT NULL,
        post_description VARCHAR(50) NOT NULL,
        expiration DATETIME NOT NULL,
        fulfilled INTEGER DEFAULT 0,
        fulfilled_on TIMESTAMP,
        fulfilled_id INTEGER DEFAULT 0,
        PRIMARY KEY(post_id),
        FOREIGN KEY(post_id) REFERENCES Post,
        FOREIGN KEY (fulfilled_id) REFERENCES Account
);
CREATE TABLE BelongsTo (
        post_id INTEGER NOT NULL,
        FOREIGN KEY(post_id) REFERENCES Post,
        category VARCHAR(20) NOT NULL,
        PRIMARY KEY(post_id, category)
);
CREATE TABLE Suggests (
        postid FOREIGN KEY REFERENCES Post(postid) NOT NULL,
        pickupid FOREIGN KEY REFERENCES Pickup(pickupid) NOT NULL,
        suggestedtime DATETIME NOT NULL,
        PRIMARY KEY(postid, pickupid, suggestedtime)
);
CREATE TABLE LocationAddress (
        streetname VARCHAR(30) NOT NULL,
        streetno INTEGER,
        postalcode VARCHAR(6) NOT NULL,
        PRIMARY KEY (streetname, streetno)
);
CREATE TABLE Pickup (
        pickupid INTEGER PRIMARY KEY NOT NULL,
        description VARCHAR(100) NOT NULL,
        streetname FOREIGN KEY REFERENCES Address(streetname) NOT NULL,
        streetno FOREIGN KEY REFERENCES Address(streetno)
);