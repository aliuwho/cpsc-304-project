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
INSERT INTO Moderator
VALUES (1, 'HOWDY', TIMESTAMP '2013-04-13 00:01:01');
INSERT INTO Moderator(id)
VALUES (2);
INSERT INTO Moderator(id, promotion_date)
VALUES (5, TIMESTAMP '2015-01-01 13:00:00');
INSERT INTO Moderator(id, welcome_message)
VALUES (6, 'Hello, my friend...');
INSERT INTO Ticket(tid, aid, mid, t_subject, t_category, t_priority)
VALUES (
        3,
        3,
        1,
        'bad customer service',
        'customer service',
        0
    );
INSERT INTO Ticket(tid, aid, mid, t_subject, t_category, t_priority)
VALUES (4, 3, 5, 'almost got stabbed', 'item quality', 2);
INSERT INTO Ticket(tid, aid, mid, t_subject, t_category, t_priority)
VALUES (
        5,
        3,
        5,
        'almost ran over cat',
        'good item quality',
        3
    );
INSERT INTO Ticket(tid, aid, mid, t_subject, t_category, t_priority)
VALUES (6, 0, 6, 'ate a bagel', 'false information', 0);
INSERT INTO Ticket(tid, aid, mid, t_subject, t_category, t_priority)
VALUES (7, 4, 6, 'horrible ui', 'bad item quality', 1);
INSERT INTO Flag(f_id, f_description, aid, mid)
VALUES (3, 'bad behavior', 0, 1);
INSERT INTO Flag(f_id, f_description, aid, mid)
VALUES (4, 'selling drugs', 4, 2);
INSERT INTO Flag(f_id, f_description, aid, mid)
VALUES (6, 'against community guidelines', 4, 5);
INSERT INTO Flag(f_id, f_description, aid, mid)
VALUES (7, 'unusual post', 5, 2);
INSERT INTO Flag(f_id, f_description, aid, mid)
VALUES (8, 'hate speech', 4, 1);
INSERT INTO Broadcast
VALUES(
        1,
        'hello partner',
        TIMESTAMP '2021-10-30 12:00:00'
    );
INSERT INTO Broadcast
VALUES(
        2,
        'today is a great day',
        TIMESTAMP '2021-11-05 15:00:00'
    );
INSERT INTO Broadcast
VALUES(
        4,
        'stop posting stuff',
        TIMESTAMP '2021-10-30 15:30:00'
    );
INSERT INTO Broadcast
VALUES(
        5,
        'start posting stuff',
        TIMESTAMP '2021-10-30 15:45:00'
    );
INSERT INTO Broadcast
VALUES(
        8,
        'the weather is good isn''t it',
        TIMESTAMP '2021-10-30 15:00:00'
    );
INSERT INTO Broadcast
VALUES(
        9,
        'welcome to our interface',
        TIMESTAMP '2021-10-30 15:00:00'
    );
INSERT INTO Review
VALUES (
        6,
        0,
        2,
        'best product',
        TIMESTAMP '2021-10-30 12:00:00'
    );
INSERT INTO Review
VALUES (
        10,
        1,
        3,
        'worst product',
        TIMESTAMP '2021-11-05 15:00:00'
    );
INSERT INTO Review
VALUES (
        6,
        5,
        2,
        'all right product',
        TIMESTAMP '2021-10-30 15:30:00'
    );
INSERT INTO Review
VALUES (
        8,
        8,
        1,
        'too far',
        TIMESTAMP '2021-10-30 15:45:00'
    );
INSERT INTO Review
VALUES (
        9,
        0,
        8,
        'nice and close',
        TIMESTAMP '2021-10-30 15:00:00'
    );
INSERT INTO Receives
VALUES (5, 4);
INSERT INTO Receives
VALUES (4, 4);
INSERT INTO Receives
VALUES (1, 0);
INSERT INTO Receives
VALUES (2, 2);
INSERT INTO Receives
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
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(1, 'Listing', 8, CURRENT_TIMESTAMP, 'Pending');
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(
        2,
        'Listing',
        0,
        TIMESTAMP '2023-10-04 13:00:00',
        'Pending'
    );
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(
        3,
        'Request',
        1,
        TIMESTAMP '2023-10-04 13:00:00',
        'Closed'
    );
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(
        4,
        'Listing',
        5,
        TIMESTAMP '2023-10-04 13:00:00',
        'Pending'
    );
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(
        5,
        'Listing',
        8,
        TIMESTAMP '2023-10-04 13:00:00',
        'Open'
    );
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(
        6,
        'Request',
        2,
        TIMESTAMP '2023-12-12 10:00:00',
        'Closed'
    );
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(
        7,
        'Request',
        1,
        TIMESTAMP '2023-10-04 13:00:00',
        'Pending'
    );
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(
        8,
        'Listing',
        0,
        TIMESTAMP '2023-10-23 13:00:00',
        'Open'
    );
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(
        9,
        'Listing',
        3,
        TIMESTAMP '2023-11-18 13:00:00',
        'Closed'
    );
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(
        10,
        'Request',
        2,
        TIMESTAMP '2023-12-12 10:00:00',
        'Open'
    );
INSERT INTO Post(
        post_id,
        post_type,
        account_id,
        expiration,
        post_status
    )
VALUES(
        11,
        'Request',
        2,
        TIMESTAMP '2023-12-12 10:00:00',
        'Open'
    );
INSERT INTO Listing
VALUES(1, 'JBL headphones');
INSERT INTO Listing
VALUES(2, 'Aritzia sweater');
INSERT INTO Listing
VALUES(4, 'Desk');
INSERT INTO Listing
VALUES(5, 'Dune');
INSERT INTO Listing
VALUES(
        8,
        '10% off at Pizza Garden'
    );
INSERT INTO Listing
VALUES(9, 'Quest bars');
INSERT INTO Request(
        post_id,
        post_description,
        fulfilled,
        fulfilled_on,
        fulfilled_id
    )
VALUES(
        3,
        'Toaster oven',
        1,
        TIMESTAMP '2021-11-15 12:00:00',
        1
    );
INSERT INTO Request(post_id, post_description)
VALUES(6, 'Truck for moving');
INSERT INTO Request(post_id, post_description)
VALUES(
        7,
        'Thinking Fast and Slow'
    );
INSERT INTO Request(post_id, post_description)
VALUES(
        10,
        'Where can I find a good mechanic?'
    );
INSERT INTO Request(post_id, post_description)
VALUES(
        11,
        'Free haircut on campus'
    );
INSERT INTO Bid
VALUES (2, 'nice', 2, 8, 1);
INSERT INTO Bid
VALUES (3, 'very interesting', 9, 2, 0);
INSERT INTO Bid
VALUES (1, 'that''s just lovely', 1, 4, 1);
INSERT INTO Bid(id, lid, aid)
VALUES (5, 5, 5);
INSERT INTO Bid(id, lid, aid)
VALUES (6, 5, 1);