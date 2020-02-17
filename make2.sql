USE usercontrol;
INSERT INTO department(name) VALUES ('Science');
INSERT INTO department(name) VALUES ('Art');
INSERT INTO user(username,name,lname,email,image,roles,password,department_id) VALUES('admin', 'Admin', 'Last Name', 'admin@gmail.com', 'default.png', '["ROLE_ADMIN"]', '$2y$13$yyM97T4INHcV1n9FHEMureMLVvUakJEEPf52KDrg9neEDjvQuu5cu', 1);
INSERT INTO user(username,name,lname,email,image,roles,password,department_id) VALUES('user', 'User', 'Last Name', 'user@gmail.com', 'default.png', '["ROLE_USER"]', '$2y$13$piQAyl78TQ4DQoWfhIbJq.FwdozsZ5HrR9.SXfwaoR0f6ER1zHWZG', 2);
