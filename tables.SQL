CREATE TABLE Account(id INTEGER IDENTITY(1,1),
        name VARCHAR(30) NOT NULL,
        password VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        status INTEGER DEFAULT 1,
        suspend_mid INTEGER DEFAULT 0,
        PRIMARY KEY(id)
);

CREATE TABLE Moderator (id INTEGER IDENTITY(1,1),
        PRIMARY KEY(id),
        FOREIGN KEY(id) REFERENCES Account
);

CREATE TABLE Bid (id INTEGER IDENTITY(1,1),
        message VARCHAR(120),
        lid INTEGER,
        aid INTEGER,
        chosen INTEGER DEFAULT 0,
        FOREIGN KEY(aid) REFERENCES Account NOT NULL,
        FOREIGN KEY(lid) REFERENCES Listing NOT NULL,
        PRIMARY KEY(id)
);

CREATE TABLE Ticket (
    tid Integer IDENTITY(1,1),
    aid Integer not null,
    mid Integer DEFAULT 0, 
    t_subject char(50),
    t_category char(11),
    t_priority boolean, 
PRIMARY KEY(tid),
FOREIGN KEY(aid) references Account
FOREIGN KEY(mid) references Moderator
);

create table Flag (
    f_id Integer IDENTITY(1,1),
    f_date char(20)
    f_description char(200)
PRIMARY KEY(f_id)
);

create table Broadcast (
    b_id Integer IDENTITY(1,1), 
    b_message char(200),
    B_date char(20),
    b_time char (11),
PRIMARY KEY(b_id)
);

create table Review
    (rid Integer IDENTITY(1,1),
    receiver_id Integer NOT NULL,
    poster_id Integer NOT NULL,
    r_description char(200),
    r_time datetime(11)
    PRIMARY KEY(rid),
    FOREIGN KEY(receiver_id) references Account,
    FOREIGN KEY(poster_id) references Account,
);

create table Receives (
b_id char(11) not NULL,
a_id char(11) not NULL,
PRIMARY KEY(b_id,a_id),
FOREIGN KEY(b_id) references Broadcast,
FOREIGN KEY(a_id) references Account
);

CREATE TABLE Category (
name VARCHAR(20) PRIMARY KEY NOT NULL
);

CREATE TABLE Post (
postid INTEGER IDENTITY(1,1) PRIMARY KEY,
type VARCHAR(10) NOT NULL,
accountid INTEGER FOREIGN KEY References Account(accountid) NOT NULL,
createdon TIMESTAMP NOT NULL DEFAULT NOW,
updatedon TIMESTAMP NOT NULL DEFAULT NOW,
;)

CREATE TABLE Listing (
postid INTEGER FOREIGN KEY References Post(postid),
status VARCHAR(10) NOT NULL,
item VARCHAR(50) NOT NULL,
expiration DATETIME NOT NULL,
PRIMARY KEY postid
);

CREATE TABLE Request (
postid INTEGER FOREIGN KEY References Post(postid) NOT NULL,
status VARCHAR(10) NOT NULL,
description VARCHAR(50) NOT NULL,
expiration DATETIME NOT NULL,
type VARCHAR(10) NOT NULL,
fulfilled INTEGER DEFAULT 0,
fulfilled_on TIMESTAMP,
fulfilled_id INTEGER DEFAULT 0,
PRIMARY KEY postid,
FOREIGN KEY (fulfilled_id) References Account
);

CREATE TABLE BelongsTo (
postid FOREIGN KEY References Post(postid) NOT NULL,
category VARCHAR(20) NOT NULL,
PRIMARY KEY (postid, category)
);

CREATE TABLE Suggests (
postid FOREIGN KEY References Post(postid) NOT NULL,
pickupid FOREIGN KEY References Pickup(pickupid) NOT NULL,
suggestedtime DATETIME NOT NULL,
PRIMARY KEY (postid, pickupid, suggestedtime)
);

CREATE TABLE LocationAddress (
streetname VARCHAR(30) NOT NULL,
streetno INTEGER,
postalcode VARCHAR(6) NOT NULL,
PRIMARY KEY (streetname, streetno)
);

CREATE TABLE Pickup (
pickupid INTEGER PRIMARY KEY IDENTITY(1,1) NOT NULL,
description VARCHAR(100) NOT NULL,
streetname FOREIGN KEY References Address(streetname) NOT NULL,
streetno FOREIGN KEY References Address(streetno)
);


