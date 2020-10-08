COSC349 Assignment 2


NBA Greatest players game simulator

This application allows you to select teams made up of NBA greats of your choice, and simulate what the outcome of the game would be. The outcome of the game is based on the selected players' ratings. Ratings are predetermined and do not change.

The application is built using two Apache2 web servers (one serving the player selection interface, and one other serving the game simulator), and a database server that stores player information and manages queries from the web servers.

The two Vagrant VMs are web servers running on AWS as EC2 instances, and provisioned using SSH. The database server is a MySQL engine running on the Amazon Relational Database Service (RDS). The front end and database querying is written in php and javascript.
