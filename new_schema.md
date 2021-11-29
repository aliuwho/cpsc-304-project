# Schema
Primary keys are __underlined__ and foreign keys are in **bold**.
All id attributes must be unique within the table.


Account (__id__: integer, name: string, password: string, email: string, status: integer, suspend_mid: integer)
- Candidate keys: (id), (name)
- suspend_mid references Moderator (id)
- Constraints: 
  - Name must be unique
  - All attributes except for Status and suspend_mid must be non-null. By default, Status and suspend_mid will be set to 1 and 0, respectively.
  - Status is 0 when an account is suspended and 1 when an account is not suspended Additional status values may be applied.

Moderator (**__id__**: integer, welcome_message: string, promotion_date: timestamp)
- Candidate keys: (id)
- id references Account (id)
- Constraints:
  - id must not be null

Bid (__id__: integer, message: string, lid: integer, aid: integer, chosen: integer)
- Candidate keys: (id)
- Constraints:
  - chosen is 0 or 1, representing if a bid is selected (0 = not selected)
  - All attributes except for chosen must not be null

Ticket (__ID__: integer, **MID**: integer, **AID**: integer, Subject: string, Priority: integer, Category: string, created_on: timestamp)
- Candidate keys: (ID)
- mid references Moderator (id)
- aid references Account (id)
- Constraints:
  - Priority is an integer where higher number means more Priority
  - Priority is assigned based on Category
  - All attributes must not be null

Flag (__ID__: integer, **MID**: integer, **AID**: integer, date: timestamp, severity: integer, description: string)
- Candidate keys: (ID)
- mid references Moderator (id)
- aid references Account (id)
- Constraints:
  - Severity is one of 1, 2, 3 and represents the significance of why a user is flagged. Higher severity indicates greater misdemeanor.
  - All attributes must be non null

Broadcast (__ID__: integer, Time: timestamp, Message: string)
- Candidate keys: (ID)
- Constraints;
  - All attributes must be non null

Review (__id__: integer, **receiver_id**: integer, **poster_id**: integer, description: string, time: timestamp)
- Candidate keys: (id)
- receiver_id references Account (id)
- poster_id references Account (id)
- Constraints:
  - All attributes must be non null

Receives (**__b_id__**: integer, **__a_id__**: integer)
- Candidate keys: (b_id, a_id)
- b_id references Broadcast (id)
- a_id references Account (id)
- Constraints:
  - All attributes must be non null

Location (__streetname__: string, __streetno__: integer, postalcode: string)
- Candidate keys: (streetname, streetno)
- Constraints:
  - All attributes must not be null

Category (__name__: string)
- Candidate keys: (name)
- Constraints:
  - All attributes must be non null

Listing (**__postid__**: integer, item: string)
- Candidate keys: (postid)
- postId references Post (id)
- Constraints:
  - All attributes must be not null

Request (**__postid__**: integer, description: string, fulfilled: integer, fulfilled_on: timestamp, fulfilled_id: integer)
- Candidate keys: (postid)
- postId references Post (id)
- fulfilled_id references Account (id)
- Constraints:
  - fulfilled represents whether or not the request has been completed; 0 represents an incomplete request
  - postid, description must not be null

BelongsTo (**__postid__**: integer, category: string)
- Candidate keys: (postid)
- Constraints:
  - All attributes must not be null

Suggests (**__postid__**: integer, __pickup_id__: integer, __suggestedtime__: datetime)
- Candidate keys: (postid, address, suggestedtime)
- postId references Post (id)
- pickup_id references Pickup (id)
- Constraints:
  - All attributes must not be null

Post (__postid__: integer, type: string)
- Candidate keys: (postid)
- Constraints:
  - postId must not be null

Pickup (__pickupid__: integer, description: string, streetname: string, streetno: integer)
- Candidate keys: (pickupid)
- (streetname, streetno) references LocationAddress (streetname, streetno)
- Constraints:
  - All attributes must not be null
