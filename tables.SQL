<<<<<<< HEAD
DROP TABLE Account;
DROP TABLE Moderator;
DROP TABLE Bid;
DROP TABLE Ticket;
DROP TABLE Flag;
DROP TABLE Broadcast;
DROP TABLE Review;
DROP TABLE Receives;
DROP TABLE Category;
DROP TABLE Post;
DROP TABLE Listing;
DROP TABLE Request;
DROP TABLE BelongsTo;
DROP TABLE Suggests;
DROP TABLE LocationAddress;
DROP TABLE Pickup;
CREATE TABLE Account(
        id INTEGER IDENTITY(1, 1),
=======
CREATE TABLE Account(id INTEGER IDENTITY(1,1),
>>>>>>> b4aa880e74243fd81bf6cd2599e61900d074fd2a
        name VARCHAR(30) NOT NULL,
        password VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        status INTEGER DEFAULT 1,
        suspend_mid INTEGER DEFAULT 0,
        PRIMARY KEY(id)
);
<<<<<<< HEAD
CREATE TABLE Moderator (
        id INTEGER IDENTITY(1, 1),
=======

CREATE TABLE Moderator (id INTEGER IDENTITY(1,1),
>>>>>>> b4aa880e74243fd81bf6cd2599e61900d074fd2a
        PRIMARY KEY(id),
        welcome_message VARCHAR(100) DEFAULT "Welcome, dear moderator!",
        promotion_date TIMESTAMP DEFAULT NOW,
        FOREIGN KEY(id) REFERENCES Account
);
<<<<<<< HEAD
CREATE TABLE Bid (
        id INTEGER IDENTITY(1, 1),
=======

CREATE TABLE Bid (id INTEGER IDENTITY(1,1),
>>>>>>> b4aa880e74243fd81bf6cd2599e61900d074fd2a
        message VARCHAR(120),
        lid INTEGER,
        aid INTEGER,
        chosen INTEGER DEFAULT 0,
        FOREIGN KEY(aid) REFERENCES Account NOT NULL,
        FOREIGN KEY(lid) REFERENCES Listing NOT NULL,
        PRIMARY KEY(id)
);
<<<<<<< HEAD
CREATE TABLE Ticket (
        tid Integer IDENTITY(1, 1),
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
        f_id Integer IDENTITY(1, 1),
        f_date char(20),
        f_description char(200),
        aid INTEGER NOT NULL,
        mid INTEGER NOT NULL,
        FOREIGN KEY(aid) REFERENCES Account,
        FOREIGN KEY(mid) REFERENCES Moderator PRIMARY KEY(f_id)
);
create table Broadcast (
        b_id Integer IDENTITY(1, 1),
        b_message char(200),
        B_date char(20),
        b_time char (11),
        PRIMARY KEY(b_id)
);
create table Review (
        r_id Integer IDENTITY(1, 1),
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
=======

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
    f_date char(20),
    f_description char(200),
    aid INTEGER NOT NULL,
    mid INTEGER NOT NULL,
    FOREIGN KEY(aid) references Account,
    FOREIGN KEY(mid) references Moderator
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
>>>>>>> b4aa880e74243fd81bf6cd2599e61900d074fd2a
);
CREATE TABLE Category (name VARCHAR(20) PRIMARY KEY NOT NULL);
CREATE TABLE Post (
<<<<<<< HEAD
        post_id INTEGER IDENTITY(1, 1) PRIMARY KEY,
        post_type VARCHAR(10) NOT NULL,
        account_id INTEGER NOT NULL,
        created_on TIMESTAMP NOT NULL DEFAULT NOW,
        updated_on TIMESTAMP NOT NULL DEFAULT NOW,
        expiration DATETIME NOT NULL,
        post_status VARCHAR(10) NOT NULL,
        FOREIGN KEY (account_id) REFERENCES Account(account_id)
);
) CREATE TABLE Listing (
        post_id INTEGER,
        FOREIGN KEY(post_id) REFERENCES Post,
        item VARCHAR(50) NOT NULL,
        PRIMARY KEY postid
=======
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
>>>>>>> b4aa880e74243fd81bf6cd2599e61900d074fd2a
);
CREATE TABLE Request (
<<<<<<< HEAD
        post_id INTEGER NOT NULL,
        post_description VARCHAR(50) NOT NULL,
        expiration DATETIME NOT NULL,
        fulfilled INTEGER DEFAULT 0,
        fulfilled_on TIMESTAMP,
        fulfilled_id INTEGER DEFAULT 0,
        PRIMARY KEY post_id,
        FOREIGN KEY(post_id) REFERENCES Post,
        FOREIGN KEY (fulfilled_id) REFERENCES Account
);
=======
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

>>>>>>> b4aa880e74243fd81bf6cd2599e61900d074fd2a
CREATE TABLE BelongsTo (
        post_id INTEGER NOT NULL,
        FOREIGN KEY(post_id) REFERENCES Post,
        category VARCHAR(20) NOT NULL,
        PRIMARY KEY (post_id, category)
);
CREATE TABLE Suggests (
        postid FOREIGN KEY REFERENCES Post(postid) NOT NULL,
        pickupid FOREIGN KEY REFERENCES Pickup(pickupid) NOT NULL,
        suggestedtime DATETIME NOT NULL,
        PRIMARY KEY (postid, pickupid, suggestedtime)
);
<<<<<<< HEAD
CREATE TABLE LocationAddress (
        streetname VARCHAR(30) NOT NULL,
        streetno INTEGER,
        postalcode VARCHAR(6) NOT NULL,
        PRIMARY KEY (streetname, streetno)
=======

CREATE TABLE LocationAddress (
streetname VARCHAR(30) NOT NULL,
streetno INTEGER,
postalcode VARCHAR(6) NOT NULL,
PRIMARY KEY (streetname, streetno)
>>>>>>> b4aa880e74243fd81bf6cd2599e61900d074fd2a
);
CREATE TABLE Pickup (
<<<<<<< HEAD
        pickupid INTEGER PRIMARY KEY IDENTITY(1, 1) NOT NULL,
        description VARCHAR(100) NOT NULL,
        streetname FOREIGN KEY REFERENCES Address(streetname) NOT NULL,
        streetno FOREIGN KEY REFERENCES Address(streetno)
=======
pickupid INTEGER PRIMARY KEY IDENTITY(1,1) NOT NULL,
description VARCHAR(100) NOT NULL,
streetname FOREIGN KEY References Address(streetname) NOT NULL,
streetno FOREIGN KEY References Address(streetno)
>>>>>>> b4aa880e74243fd81bf6cd2599e61900d074fd2a
);