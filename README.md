# docker-data-reciever
Recieves posted HTTP(S) data and stores it to a specified database, with basic PSK authentication

For safety, you should create a dedicated user with only insert privledges for your selected table. Select and other perms aren't required and should be assigned seperately to different users to make use of the collected data
