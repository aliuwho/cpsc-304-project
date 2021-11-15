CREATE TABLE Account(id INTEGER,
       name VARCHAR(30) NOT NULL,
        password VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        status INTEGER DEFAULT 1,
        PRIMARY KEY(id)
);

CREATE TABLE Moderator (id INTEGER,
      PRIMARY KEY(id),
       FOREIGN KEY(id) REFERENCES Account
);

CREATE TABLE Bid (id INTEGER,
        message VARCHAR(120),
        PRIMARY KEY(id)
);

CREATE TABLE Makes(aid INTEGER,
       bid INTEGER,
        PRIMARY KEY(aid, bid),
        FOREIGN KEY(aid) REFERENCES Account,
        FOREIGN KEY(bid) REFERENCES Bid
);

CREATE TABLE Resolves(tid Integer,
       mid Integer,
        PRIMARY KEY(tid, mid),
        FOREIGN KEY(tid) REFERENCES Ticket,
        FOREIGN KEY(mid) REFERENCES Moderator
);

CREATE TABLE Suspends(aid Integer,
       mid Integer NOT NULL,
       PRIMARY KEY(aid),
        FOREIGN KEY(aid) REFERENCES Account
);

CREATE TABLE Chooses(aid Integer,
       bid Integer,
        PRIMARY KEY(aid, bid),
        FOREIGN KEY(aid) REFERENCES Account,
        FOREIGN KEY(bid) REFERENCES Bid
);

CREATE TABLE Ticket (
    t_id Integer not null, 
    t_subject char(50),
    t_category char(11),
    t_priority boolean, 
PRIMARY KEY(t_id)
);

create table Flag (
    f_id Integer  not null,
    f_date char(20)
    f_description char(200)
PRIMARY KEY(f_id)
);


create table Broadcast (
    b_id Integer  not NULL, 
    b_message char(200),
    B_date char(20),
    b_time char (11),
PRIMARY KEY(b_id)
);

create table Review
    (r_id Integer not NULL,
    r_description char(200)
    r_time datetime(11)
PRIMARY KEY(r_id)
);

create table Receives (
b_id char(11) not NULL,
a_id char(11) not NULL,
PRIMARY KEY(b_id,a_id),
FOREIGN KEY(b_id) references Broadcast,
FOREIGN KEY(a_id) references Account
);

create table Leaves (
r_id Integer not NULL,
a_id Integer not NULL,
PRIMARY KEY(r_id,a_id),
FOREIGN KEY(r_id) references Review,
FOREIGN KEY(a_id) references Account
);

CREATE TABLE Category (
name VARCHAR(20) PRIMARY KEY NOT NULL
);

CREATE TABLE Post (
postid INTEGER PRIMARY KEY NOT NULL,
type VARCHAR(10) NOT NULL
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
PRIMARY KEY postid
);

CREATE TABLE Creates (
postid INTEGER FOREIGN KEY References Post(postid) NOT NULL,
accountid INTEGER FOREIGN KEY References Account(accountid) NOT NULL,
createdon TIMESTAMP NOT NULL DEFAULT NOW,
updatedon TIMESTAMP NOT NULL DEFAULT NOW,
PRIMARY KEY (postid, accountid)
);

CREATE TABLE Fulfills (
postid INTEGER FOREIGN KEY References Post(postid) NOT NULL,
accountid INTEGER FOREIGN KEY References Account(accountid) NOT NULL,
updatedon TIMESTAMP NOT NULL DEFAULT NOW,
PRIMARY KEY (postid, accountid)
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

CREATE TABLE Address (
streetname VARCHAR(30) NOT NULL,
streetno INTEGER,
postalcode VARCHAR(6) NOT NULL,
PRIMARY KEY (streetname, streetno)
);

CREATE TABLE Pickup (
pickupid INTEGER PRIMARY KEY NOT NULL,
description VARCHAR(100) NOT NULL,
streetname FOREIGN KEY References Address(streetname) NOT NULL,
streetno FOREIGN KEY References Address(streetno)
);


