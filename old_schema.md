# Schema
Primary keys are __underlined__ and foreign keys are in **bold**. Partial keys are *italicized*.
All id attributes must be unique within the table.


Account (__id__: integer, name: string, password: string, email: string, status: integer)
- Candidate keys: (id), (name)
- Constraints: 
  - All attributes except for Status must be non-null. 
  - Status is 0 when an account is suspended and 1 when an account is not suspended Additional status values may be applied.

Moderator (**__id__**: integer)
- Candidate keys: (id)
- id references Account (id)
- Constraints:
  - All attributes must not be null

Bid (__id__: integer, message: string)
- Candidate keys: (id)
- Constraints:
  - All attributes must not be null

Makes (**__aid__**: integer, **__bid__**: integer)
- Candidate keys: (aid, bid)
- aid references Account (id)
- bid references Bid (id)
- Constraints:
  - All attributes must not be null

Resolves (**__tid__**: integer, **__mid__**: integer)
- Candidate keys: (tid, mid)
- tid references Ticket (id)
- md references Moderator (id)
- Constraints:
  - All attributes must not be null

Suspends (**__aid__**: integer, **__mid__**: integer)
- Candidate keys: (aid, mid)
- Constraints:
  - All attributes must not be null

Chooses (**__aid__**: integer, **__bid__**: integer)
- Candidate keys: (aid, bid)
- aid references Account (id)
- bid references Bid (id)
- Constraints:
  - All attributes must not be null

Ticket (__ID__: integer, **MID**: integer, **AID**: integer, Subject: string, Priority: integer, Category: string)
- Candidate keys: (ID)
- mid references Moderator (id)
- aid references Account (id)
- Constraints:
  - Priority is an integer where higher number means more Priority
  - Priority is assigned based on Category
  - All attributes must not be null

Flag (__ID__: integer, **MID**: integer, **AID**: integer, date: datetime, description: string)
- Candidate keys: (ID)
- mid references Moderator (id)
- aid references Account (id)
- Constraints:
  - All attributes must be non null

Broadcast (__ID__: integer, Time: datetime, Message: string)
- Candidate keys: (ID)
- Constraints;
  - All attributes must be non null

Review (__ID__: integer, Time: datetime, Message: string)
- Candidate keys: (ID)
- Constraints:
  - All attributes must be non null

Receives (**__b_id__**: integer, **__a_id__**: integer)
- Candidate keys: (b_id, a_id)
- b_id references Broadcast (id)
- a_id references Account (id)
- Constraints:
  - All attributes must be non null

Leaves (**__r_id__**: integer, **__a_id__**: integer)
- Candidate keys: (r_id, a_id)
- r_id references Review (id)
- a_id references Account (id)
- Constraints:
  - All attributes must be non null

Location (__locationid__: integer, description: string, streetname: string, streetno: integer, postalcode: string)
- Candidate keys: (locationid)
- Constraints:
  - All attributes must not be null

Category (__name__: string)
- Candidate keys: (name)
- Constraints:
  - All attributes must be non null

Listing (**__postid__**: integer, status: string, item: string, expiration: string)
- Candidate keys: (postid)
- postId references Post (id)
- Constraints:
  - status must be one of “open", "pending", "closed", or "expired”
  - if expiration date has passed, must have "expired" status
  - listingid, status, item, and expiration must not be null

Request (**__postid__**: integer, status: string, description: string, expiration: string, type: string)
- Candidate keys: (postid)
- postId references Post (id)
- Constraints:
  - status must be one of “open", "pending", "closed", or "expired”
  - if expiration date has passed, must have "expired" status
  - type must be one of “service", "item", or "information”
  - requestid, status, expiration, type must not be null

Creates (**__postid__**: integer, **accountid**: integer, createdon: timestamp, updatedon: timestamp)
- Candidate keys: (postid)
- Constraints:
  - createdon and updatedon default to now
  - All attributes except updatedon must not be null

Fulfills (__postid__: integer, **accountid**: integer, updatedon: timestamp)
- Candidate keys: (postid)
- Constraints:
  - All attributes must not be null

BelongsTo (**__postid__**: integer, category: string)
- Candidate keys: (postid)
- Constraints:
  - All attributes must not be null

Suggests (**__postid__**: integer, __address__: string, __suggestedtime__: datetime)
- Candidate keys: (postid, address, suggestedtime)
- postId references Post (id)
- Constraints:
  - All attributes must not be null

Post (__postid__: integer, type: string)
- Candidate keys: (postid)
- Constraints:
  - postId must not be null
