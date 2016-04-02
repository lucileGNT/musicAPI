I created a small API called musicAPI
Here are the methods of musicAPI

GET /musicAPI/user/12 							Get information about User with ID =12
GET /musicAPI/song/25 							Get information about Song with ID = 25
GET /musicAPI/favorites/12						Get list of favorite songs of User with ID = 12
POST /musicAPI/favorites/add/12/25				Add song with ID = 25 to the favorite list of user with ID = 12
DELETE /musicAPI/favorites/remove/12/25			Remove song with ID = 25 from the favorite list of user with ID = 12

The schema of my database is in the file DB.xls
You can create a example of database using SQL file musicAPI_db_install.sql (directly imported from PHPmyadmin)