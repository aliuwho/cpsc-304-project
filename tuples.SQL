INSERT INTO Account
VALUES (
        0,
        'aimyul',
        'aaaaaaaAAAAAAAAhelpme21321',
        'aimyul@student.ubc.ca',
        1,
        0
    );
INSERT INTO Account
VALUES (
        1,
        'louisecc',
        'NoFreeLunchTheorem, cpsc340',
        'louisecc@student.ubc.ca',
        1,
        0
    );
INSERT INTO Account
VALUES (
        2,
        'krish.thrukal',
        'iscream,youscream2',
        'krish.thrukal@gmail.com',
        1,
        0
    );
INSERT INTO Account
VALUES (
        3,
        'rapsody',
        'P0ttingr?',
        'bohem@test.com',
        1,
        0
    );
INSERT INTO Account
VALUES (
        4,
        'Gerald',
        'geoffr3y',
        'a.crow@notreal.org',
        0,
        0
    );
INSERT INTO Account
VALUES (
        5,
        'Penny',
        'intherefrigerator',
        'baby@baby.com',
        1,
        0
    );
INSERT INTO Account
VALUES (
        6,
        'Fred',
        'caw!',
        'fredthescarecrow@cool.com',
        1,
        0
    );
INSERT INTO Account
VALUES (7, 'yxl', 'OnMars.', 'cool@cool.ca', 0, 0);
INSERT INTO Account
VALUES (
        8,
        'dj south',
        ' Zzz123',
        'nutty@elephant.food',
        0,
        0
    );
INSERT INTO Moderator(id)
VALUES (0);
INSERT INTO Moderator(id)
VALUES (1);
INSERT INTO Moderator(id)
VALUES (2);
INSERT INTO Moderator(id, promotion_date)
VALUES (5, 2021 -10 -30 12 :00 :00);
INSERT INTO Moderator(id, welcome_message)
VALUES (6, "Hello, my friend...");
INSERT INTO Ticket(tid, subject, category, priority)
VALUES (3, 'bad customer service', 'customer service', 0);
INSERT INTO Ticket(tid, subject, category, priority)
VALUES (4, 'almost got stabbed', 'item quality', 2);
INSERT INTO Ticket(tid, subject, category, priority)
VALUES (5, 'almost ran over cat', 'good item quality', 3);
INSERT INTO Ticket(tid, subject, category, priority)
VALUES (6, 'ate a bagel', 'false information', 0);
INSERT INTO Ticket(tid, subject, category, priority)
VALUES (7, 'horrible ui', 'bad item quality', 1);
INSERT INTO Ticket(tid, subject, category, priority)
VALUES (0, 'would love to pick up');
INSERT INTO Ticket(tid, subject, category, priority)
VALUES (
        1,
        'my daughter could use a chair like this! she''s 3 years old'
    );
INSERT INTO Bid
VALUES (2, 'nice');
INSERT INTO Bid
VALUES (3, 'very interesting');
INSERT INTO Bid
VALUES (4, 'that''s just lovely');
INSERT INTO Makes
VALUES (3, 0);
INSERT INTO Makes
VALUES (4, 2);
INSERT INTO Makes
VALUES (6, 3);
INSERT INTO Makes
VALUES (3, 1);
INSERT INTO Makes
VALUES (6, 4);
INSERT INTO Resolves(tid, mid)
VALUES (0, 0);
INSERT INTO Resolves(tid, mid)
VALUES (1, 0);
INSERT INTO Resolves(tid, mid)
VALUES (2, 1);
INSERT INTO Resolves(tid, mid)
VALUES (3, 5);
INSERT INTO Resolves(tid, mid)
VALUES (4, 1);
INSERT INTO Suspends
VALUES (3, 5);
INSERT INTO Suspends
VALUES (4, 5);
INSERT INTO Suspends
VALUES (6, 5);
INSERT INTO Suspends
VALUES (7, 5);
INSERT INTO Suspends
VALUES (8, 0);
INSERT INTO Chooses
VALUES (3, 4);
INSERT INTO Chooses
VALUES (4, 4);
INSERT INTO Chooses
VALUES (6, 0);
INSERT INTO Chooses
VALUES (7, 2);
INSERT INTO Chooses
VALUES (8, 1);
INSERT INTO Flag
VALUES (3, 1985 -06 -12, 'bad behavior');
INSERT INTO Flag
VALUES (4, 1985 -06 -13, 'selling drugs');
INSERT INTO Flag
VALUES (6, 1985 -06 -14, 'against community guidelines');
INSERT INTO Flag
VALUES (7, 1985 -06 -15, 'unusual post');
INSERT INTO Flag
VALUES (8, 1985 -06 -16, 'hate speech');
INSERT INTO Broadcast(1, 'hello partner', 2021 -10 -30 12 :00 :00);
INSERT INTO Broadcast(2, 'today is a great day', 2021 -11 -05 15 :00 :00);
INSERT INTO Broadcast(4, 'stop posting stuff', 2021 -10 -30 15 :30 :00);
INSERT INTO Broadcast(5, 'start posting stuff', 2021 -10 -30 15 :45 :00);
INSERT INTO Broadcast(
        8,
        'the weather is good isn''t it',
        2021 -10 -30 15 :00 :00
    );
INSERT INTO Broadcast(
        9,
        'welcome to our interface',
        2021 -10 -30 15 :00 :00
    );
INSERT INTO Review
VALUES (6, 'best product', 2021 -10 -30 12 :00 :00);
INSERT INTO Review
VALUES (10,, 'worst product', 2021 -11 -05 15 :00 :00);
INSERT INTO Review
VALUES (6, 'all right product', 2021 -10 -30 15 :30 :00);
INSERT INTO Review
VALUES (8, 'too far', 2021 -10 -30 15 :45 :00);
INSERT INTO Review
VALUES (9, 'nice and close', 2021 -10 -30 15 :00 :00);
INSERT INTO Receives
VALUES (3, 4);
INSERT INTO Receives
VALUES (4, 4);
INSERT INTO Receives
VALUES (6, 0);
INSERT INTO Receives
VALUES (7, 2);
INSERT INTO Receives
VALUES (8, 1);
INSERT INTO Leaves
VALUES (3, 4);
INSERT INTO Leaves
VALUES (4, 4);
INSERT INTO Leaves
VALUES (6, 0);
INSERT INTO Leaves
VALUES (7, 2);
INSERT INTO Leaves
VALUES (8, 1);
INSERT INTO Category
VALUES('Furniture');
INSERT INTO Category
VALUES('Clothing');
INSERT INTO Category
VALUES('Electronics');
INSERT INTO Category
VALUES('Food');
INSERT INTO Category
VALUES('Books');
INSERT INTO Category
VALUES('Musical equipment');
INSERT INTO Category
VALUES('Sports equipment');
INSERT INTO Category
VALUES('Coupons');
INSERT INTO Post
VALUES(1, 'Listing');
INSERT INTO Post
VALUES(2, 'Listing');
INSERT INTO Post
VALUES(3, 'Request');
INSERT INTO Post
VALUES(4, 'Listing');
INSERT INTO Post
VALUES(5, 'Listing');
INSERT INTO Post
VALUES(6, 'Request');
INSERT INTO Post
VALUES(7, 'Request');
INSERT INTO Post
VALUES(8, 'Listing');
INSERT INTO Post
VALUES(9, 'Listing');
INSERT INTO Listing
VALUES(1, 'Open', 'JBL headphones', 2021 -11 -15 12 :00 :00);
INSERT INTO Listing
VALUES(
        2,
        'Closed',
        'Aritzia sweater',
        2021 -10 -15 12 :00 :00
    );
INSERT INTO Listing
VALUES(4, 'Pending', 'Desk', 2021 -11 -21 12 :00 :00);
INSERT INTO Listing
VALUES(5, 'Pending', 'Dune', 2021 -11 -22 12 :00 :00);
INSERT INTO Listing
VALUES(
        8,
        'Open',
        '10% off at Pizza Garden',
        2021 -12 -23 12 :00 :00
    );
INSERT INTO Listing
VALUES(9, 'Open', 'Quest bars', 2021 -12 -24 12 :00 :00);
INSERT INTO Request
VALUES(
        3,
        'Open',
        'Toaster oven',
        2021 -11 -15 12 :00 :00,
        'Item'
    );
INSERT INTO Request
VALUES(
        6,
        'Closed',
        'Truck for moving',
        2021 -10 -15 12 :00 :00,
        'Service'
    );
INSERT INTO Request
VALUES(
        7,
        'Pending',
        'Thinking Fast and Slow',
        2021 -11 -21 12 :00 :00,
        'Item'
    );
INSERT INTO Request
VALUES(
        10,
        'Open',
        'Where can I find a good mechanic?',
        2021 -11 -22 12 :00 :00,
        'Information'
    );
INSERT INTO Request
VALUES(
        11,
        'Open',
        'Free haircut on campus',
        2021 -12 -23 12 :00 :00,
        'Service'
    );
INSERT INTO Creates
VALUES(1, 3);
INSERT INTO Creates
VALUES(2, 3);
INSERT INTO Creates
VALUES(3, 3);
INSERT INTO Creates
VALUES(5, 4);
INSERT INTO Creates
VALUES(11, 4);
INSERT INTO Fulfills
VALUES(1, 5);
INSERT INTO Fulfills
VALUES(2, 5);
INSERT INTO Fulfills
VALUES(3, 2);
INSERT INTO Fulfills
VALUES(5, 1);
INSERT INTO Fulfills
VALUES(11, 2);
INSERT INTO BelongsTo
VALUES(1, 'Electronics');
INSERT INTO BelongsTo
VALUES(2, 'Clothing');
INSERT INTO BelongsTo
VALUES(3, 'Electronics');
INSERT INTO BelongsTo
VALUES(4, 'Furniture');
INSERT INTO BelongsTo
VALUES(5, 'Books');
INSERT INTO BelongsTo
VALUES(6, 'Transportation');
INSERT INTO BelongsTo
VALUES(7, 'Books');
INSERT INTO BelongsTo
VALUES(8, 'Coupons');
INSERT INTO BelongsTo
VALUES(9, 'Food');
INSERT INTO BelongsTo
VALUES(10, 'Transportation');
INSERT INTO BelongsTo
VALUES(11, 'Other');
INSERT INTO Suggests(1, 1, '2021-10-30 12:00:00');
INSERT INTO Suggests(2, 4, '2021-11-05 15:00:00');
INSERT INTO Suggests(4, 3, '2021-10-30 15:30:00');
INSERT INTO Suggests(5, 2, '2021-10-30 15:45:00');
INSERT INTO Suggests(8, 1, '2021-10-30 15:00:00');
INSERT INTO Suggests(9, 5, '2021-10-30 15:00:00');
INSERT INTO Address
VALUES('University Boulevard', 6133, 'V6T1Z1');
INSERT INTO Address
VALUES('University Boulevard', 6200, 'V6T1Z3');
INSERT INTO Address
VALUES('Main Mall', 2366, 'V6T1Z4');
INSERT INTO Address
VALUES('Crescent Road', 6301, 'V6T1Z2');
INSERT INTO Address
VALUES('Walter Gage Road', 6011, 'V6T0B4');
INSERT INTO Address
VALUES('University Boulevard', 6131, 'V6T2A1');
INSERT INTO Pickup
VALUES(
        1,
        'in front of Honour Roll',
        'University Boulevard',
        6133
    );
INSERT INTO Pickup
VALUES(
        2,
        'in fourth floor lounge',
        'University Boulevard',
        6133
    );
INSERT INTO Pickup
VALUES(3, 'Starbucks', 'University Boulevard', 6200);
INSERT INTO Pickup
VALUES(4, 'ICICS, west doors', 'Main Mall', 2366);
INSERT INTO Pickup
VALUES(5, 'UBC Rose Garden', 'Crescent Road', 6301);
INSERT INTO Pickup
VALUES(6, 'Great Dane Coffee', 'Walter Gage Road', 6011);
INSERT INTO Pickup
VALUES(
        7,
        'MacInnes Field',
        'University Boulevard',
        6131
    );