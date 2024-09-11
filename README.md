# Call notes

-   nick
    -   technical lead - 4 years w/ bh
-   brock
    -   2 1/2 years
    -   started as jr dev focused on bug resolution
    -   now working on B team

#### how to get in contact

-   things to unblock
-   cannot answer questions on techcnical correctness
-   will use email thread

#### emphasis on task

-   db schema
-   php backend queries
-   routes & controllers
-   less concerned on:
    -   nice ui

<hr>

# Specs

### STEP 1: BUILD A SURVEY FORM

You will need to build a simple survey form.
The questions and answers of the survey should come from a database so
it is possible to add, edit, remove and reorder questions and answers
only by adding, editing, and deleting records from the database (with no
need to touch the code or change the database schema).
There are two types of questions: radio (single answer) and checkboxes
(multiple choice).
The completed survey will be saved in the database. Many users can
submit the survey.

Insert these questions into your database (You don't need to build an admin
page. You can simply insert with SQL queries):

    How old are you? (radio)
    - Less than 18
    - 18-99
    - More than 99

    Are you happy? (radio)
    - Yes
    - No

    What countries have you visited? (checkboxes)
    - Spain
    - France
    - Italy
    - England
    - Portugal

    What is your favorite sport? (radio)
    - Football
    - Basketball
    - Soccer
    - Volleyball

    What programming languages do you know? (checkboxes)
    - PHP
    - Ruby
    - JavaScript
    - Python

### STEP 2: BUILD A SURVEY RESULTS PAGE TO INVESTIGATE USER HAPPINESS

Build a simple page that shows for each question, what is the most popular
answer for happy users and what is the most popular answer for sad users.
