# UBC Give

## Project Overview

Our application domain is a local community item exchange, inspired by “Buy Nothing” Facebook groups.
Users will be able to give away and request items for free by creating posts in certain categories with a location and pickup time.
They will also be able to review other users, receive announcements sent out by moderators, and file support tickets.
Reviews for users will be taken down by moderators if they contain offensive or profane content.
Moderators can also flag and suspend accounts, and they can announce broadcasts.

---

## Timeline

Check out our visual timeline [here](https://www.preceden.com/timelines/787520-ubc-give?s=6d40181217c21db).

---

## Task Breakdown

1. Backend/database (finished by Nov 9)

   a. Create all tables & insert tuples (combine into one .sql file)  
   b. Verify correctness of other teammates’ queries: meeting on Nov 10  
    c. Write the following SQL queries:

   **Krish**  
    i. Insert new listing or request  
    ii. Delete listing or request  
    iii. Update listing or request  
    iv. Fulfill a request  
    v. Count the number of requests a user has fulfilled  
    vi. Add a post to a category  
    vii. Select posts of a certain category (user search)  
    viii. Search for posts within a certain category which expire by the end of the week  
    ix. Leave a review of another user

   **Louise**  
    x. Insert bid on a certain post  
    xi. Delete bid  
    xii. Choose a bid on a post (poster only)  
    xiii. Find all the users who made a bid on a listing  
    xiv. Within users who have posted bids on their item, filter users by review over 4 stars, e.g.  
    xv. Insert new location  
    xvi. Delete location (moderator only)  
    xvii. Suggest location for listing  
    xviii. View number of flags associated with a user (moderator only)  
    xix. Issue a flag to a user (moderator only)

   **Amy**  
    xx. Insert new user (make account)  
    xxi. Delete user (delete your account)  
    xxii. Suspend a user (moderator only)  
    xxiii. Select name and email of other users (users to search/view other users)  
    xxiv. Broadcast message (moderator only)  
    xxv. Receive broadcast (inbox or notice board)  
    xxvi. Write a ticket  
    xxvii. Resolve a ticket (moderator only)

2. Frontend/integration (finished by Nov 21)  
   a. Independently familiarize with git and Oracle by Nov 5  
   b. Plan general layout of UI by Nov 10: (team meeting/discussion)  
   c. Develop working knowledge of tech stack (PHP/HTML/CSS) by Nov 14

   - _Note: Tutorials 6 and 7 will be moderately helpful_

   d. Backend integration to UI elements by Nov 21  
    i. PHP database integration  
    ii. Querying data  
   e. Develop frontend

_We will individually integrate the frontend corresponding to our backend tasks (i.e., if one of us developed SQL to add/remove users, they will also implement the buttons, input boxes, etc. of the UI that allow users perform these actions)._

**Final deadline for implementation: November 25**

---

## Potential Challenges

Time management: working consistently, setting up meetings and coordinating schedules
Achieving usable functionality of the app while maintaining an appropriate scale (i.e., separating key functionalities from nice-to-haves)
Equal distribution of work, considering some queries/sections (bids vs. moderator actions vs. listings, for example) are more complex than others.

## Bonus Features, If Possible

Search posts by keyword  
Add photo of item

---

## Our Impetus

This system will help solve SDG goal 12, responsible consumption and production, in our university.
People constantly move in and out and their needs change rapidly.
Our application is called “UBC Give” to reduce waste and offer things in need with a community-based, generous attitude.
Our application will foster a free spirit of giving what isn’t used and receiving what is needed.

## Who We Are

We are three UBC undergraduate students - Louise Cooke, Amy Liu, and Krish Thukral - who like coding, free stuff, and the occasional cup of matcha.
