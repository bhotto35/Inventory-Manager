# Inventory-Manager
An Inventory Manager System based on XAMPP
Initial page: access.php

A. Security and Access (Login)
This module comprises and defines the functions of the entry points to all manager web pages in the web application.
1.	A main form is displayed to the user to enter the password to access the Home Page of the Inventory Manager.
2.	A GUI to be redirected to the individual entry points of the webpages other than the Home Page.
3.	Individual webpages that accept the password required to allow access to the respective entity-manager pages.
4.	Individual webpages that allow the user to change the decision to access a particular entity-manager page and go back to the main login page instead.
5.	Appropriate actions to be performed and messages to be shown to the user on proceeding with a password viz. staying on the same page and alerting with a message on entering incorrect password.
6.	The passwords to access an Entity Manager is separate for the Admin and the other employees authorized to access the system (who are possibly go-down managers), and can be separately affected.

B. Entity Managers
The Entity Manager module imparts basic functionalities to the web-app to do the work of manipulating the data in different tables in the Inventory database, such as:
1.	The user is allowed to insert into, delete from and update records of a table—each record serving to hold the relevant details of a/an employee/go-down/inward/product-in-stock.
2.	The user is allowed to view every record of the table in their individual manager webpages.
3.	The password that allows access to each Entity Manager is independently stored and can be unique. 
4.	The password to access a specific Entity Manager shall have the option to be changed from the respective Entity Manager page itself on the condition that the old password is validated first.
5.	The user, who is not an Admin, shall be able to logout from an individual Entity Manager page, in which case the user shall need to enter the appropriate password in order to access it again.
Apart from the above mentioned functions, there are other functions that are unique to some Entity Manager pages, which may or may not overwrite some of the above mentioned requirements, which are:
B.A Stock Manager
1.	The Stock Manager shall allow the user (Admin or one of the Godown Managers) to find available go-downs in the “godown” table by entering the appropriate key (substring) and a category under which the user wants the match to be found.
2.	The user is allowed to create (not view, update or delete) a notification for the Admin so that a proper log is maintained of the various proceedings in the Stock Manager web application. 
B.B Inwards Manager
1.	The Inwards Manager shall allow the user to find registered products in stock in the “stock” table by entering the appropriate key (substring) and a category under which the user wants the match to be found.
2.	The user is allowed to create (not view, update or delete) a notification for the Admin so that a proper log is maintained of the various proceedings in the Stock Manager web application. 
B.C Orders Manager
1.	No Order record may be inserted, updated or deleted by the user of the Inventory Manager, as the data of the orders table can only be manipulated indirectly from a (hypothetical) shopping website owned by the same company and (hypothetically) connected to the database of the Inventory Management System.
2.	The Orders Manager allows the user to manipulate the data of the “outward table” instead of the “orders” table.
3.	The user can view a consolidated table having the data of the “orders”, “bill” and “customer” tables. The data thus displayed will be based on the filter entered by the user, to search a specific set of orders. 
4.	Filters applicable shall be 
•	orders placed after a given (user-specified) date
•	orders placed before a given date
•	orders with total amount less than a given amount
•	orders with total amount more than a given amount
•	orders by a customer having the given customer ID
•	orders with bill numbers containing a given string of numbers.
5.	Keeping the filter fields empty shall result in the display of all records. 
6.	The user is allowed to create (not view, update or delete) a notification for the Admin so that a proper log is maintained of the various proceedings in the Orders Manager web application. 
Other requirements are included in the “PDF Download” module.
B.D Employee Manager
1.	Only the Admin has access to this module.
B.E Godown Manager
1.	Only the Admin has access to this module.
C. Admin Module
1.	The Admin Module, like Module-1, contains the links to the individual entry points to the different Entity Managers.
2.	The Admin module can be accessed by entering the admin’s password only.
3.	The password can be changed on the condition that the current password is entered correctly by the user before applying the new password.
4.	All tables in the database shall be viewable by the user with the use of the Admin Module, but this module does not allow manipulation of any data of the inventory database in the manner of updating, inserting or deleting.
5.	The Master Module allows for the user to obtain statistics and reports on the Inventory, which shall be specified in the “Statistics module”.
6.	Once logged in to the Admin module, the user (who is the Admin) gains access to all Entity Managers without having the need of logging in to them with passwords. 
7.	As the Admin, the user can change only the admin’s password for a specific Entity Manager, or for the Admin Module itself.
8.	As the Admin, the user has the option to log out of an Entity Manager and be redirected to the Admin Page, or log out of the Inventory Manager altogether. In the latter case the user shall need to re-access the Admin Module with the help of the admin’s password.
9.	As the Admin the user has access to automatically generated notifications listing the stock items for which the units present in stock has decreased below the minimum threshold units. 
10.	The Admin is able to view and delete notifications created manually.
11.	The Admin Module allows for the user to obtain business statistics and other reports.
Other requirements are included in the “PDF module” and the “Statistics module”.
D. Statistics Module
The Admin is able to obtain the statistics of transactions made with the items in the Inventory, over a range of dates that are earlier than a user-specified end-date and later than a user-specified start-date, including both dates. The statistics include:
1.	A table depicting the total sales in rupees (a sum which includes the profits) per day in the given range of dates, in order from earliest to latest dates.
2.	A table depicting the total number of units sold per product sold over the range of dates, along with each of their selling prices, in order of most sold products to least sold products.
3.	A vertical bar-graph depicting the total sales per date over the given range of dates, with sales on the Y-axis and dates on the X-axis.
4.	A vertical bar graph depicting the total number of units sold per product, with the units on the Y-axis and product-names on X-axis.
5.	A figure of the average sales (in rupees) over the dates depicted is returned.
6.	A figure of the total sales (in rupees) across all depicted dates is returned.
7.	The scale of the graphs should automatically be set based on the maximum and minimum values to be depicted on the Y-axis.
E. PDF Module
1.	The user is allowed to print and/or download a ‘.pdf’ file of the Orders table obtained from the Orders Manager, i.e. the user can, for example, get the list of orders that were made after a date and save the list as a PDF file.
2.	The PDF module allows for the user, as Admin, to select any combination of tables to get the PDF of all records of. For example, a combination of the current state of data in the ‘Stock’, ‘Employee’ and ‘Inwards’ tables.
3.	The PDF module allows for the user, as Admin, to print and/or save the PDF of the tables obtained from calculating the statistics (Module 4, requirements 1 and 2).
4.	The user can, as Admin, also download the ‘.pdf’ file of the graphs obtained from calculating the statistics.

