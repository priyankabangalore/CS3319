-- Part 1 SQL Updates
SELECT * FROM hospital;
UPDATE hospital SET headdoc='GD56', headdocstartdate='2001-12-19' WHERE hoscode='BBC';
UPDATE hospital SET headdoc='SE66', headdocstartdate='2004-05-30' WHERE hoscode='ABC';
UPDATE hospital SET headdoc='YT67', headdocstartdate='2001-06-01' WHERE hoscode='DDE';
SELECT * FROM hospital;

-- Part 2 SQL Inserts
INSERT INTO doctor VALUES ('PB33', 'Priyanka', 'Bangalore', '2022-09-09', '2001-01-03', 'ABC', 'Surgeon');
INSERT INTO patient VALUES ('333111222', 'Kevin', 'Hart', '2001-09-05');
INSERT INTO looksafter VALUES ('PB33', '333111222');
INSERT INTO hospital VALUES ('PPB', 'Sick Kids', 'Toronto', 'ON', 1000, 'PB33', '2022-10-10');
SELECT * FROM doctor;
SELECT * FROM patient;
SELECT * FROM looksafter;
SELECT * FROM hospital;

-- Part 3 SQL Queries
-- Query 1
SELECT lastname FROM patient;
-- Query 2
SELECT DISTINCT lastname FROM patient;
-- Query 3
SELECT * FROM doctor ORDER BY lastname;
-- Query 4
SELECT hosname, hoscode FROM hospital WHERE numofbed > 1500;
-- Query 5
SELECT firstname, lastname FROM doctor WHERE hosworksat='BBC';
-- Query 6
SELECT firstname, lastname FROM patient WHERE lastname LIKE 'G%';
-- Query 7
SELECT patient.firstname, patient.lastname FROM patient, looksafter, doctor WHERE looksafter.licensenum=doctor.licensenum AND looksafter.ohipnum=patient.ohipnum AND doctor.lastname='Webster';
-- Query 8
SELECT hosname, city, lastname FROM hospital, doctor WHERE hospital.headdoc=doctor.licensenum;
-- Query 9
SELECT SUM(numofbed) FROM hospital;
-- Query 10
SELECT patient.firstname, patient.lastname, doctor.firstname, doctor.lastname FROM patient, doctor, looksafter, hospital WHERE doctor.licensenum=looksafter.licensenum AND looksafter.ohipnum=patient.ohipnum AND hospital.headdoc=doctor.licensenum;
-- Query 11
SELECT firstname, lastname, prov FROM doctor, hospital WHERE specialty='Surgeon' AND (hosworksat='ABC' OR hosworksat='DDE');
-- Query 12
SELECT firstname FROM doctor WHERE licensenum NOT IN(SELECT licensenum FROM looksafter);
-- Query 13
SELECT firstname, lastname, count(ohipnum), hosname from doctor, hospital, looksafter WHERE looksafter.licensenum=doctor.licensenum AND hosworksat=hoscode GROUP BY doctor.licensenum HAVING COUNT(ohipnum) > 1;
-- Query 14
SELECT firstname AS 'Doctor First Name', lastname AS 'Doctor Last Name', hos1.hosname AS 'Head of Hospital Name', hos2.hosname AS 'Works at Hospital Name' FROM doctor, hospital hos1, hospital hos2 WHERE hos2.headdoc=licensenum AND hos1.hoscode!=hos2.hoscode;
-- Query 15 - My query that displays the firstname and lastname of head doctors and the number of patients they treat. This could help someone interested in Caladian Healthcare to understand the responsibilities of a head doctor aside from governing the hospital.
SELECT firstname AS 'Doctor First Name', lastname AS 'Doctor Last Name', count(ohipnum) AS "No. of Patients" FROM doctor, hospital, looksafter WHERE looksafter.licensenum=doctor.licensenum AND hospital.headdoc=doctor.licensenum;


-- Part 4 SQL Views/Deletes
CREATE VIEW ohip AS SELECT doctor.firstname AS 'dfirst', doctor.lastname AS 'dlast', doctor.birthdate AS 'dbirth', patient.firstname AS 'pfirst', patient.lastname AS 'plast', patient.birthdate AS 'pbirth' FROM doctor, patient WHERE looksafter.licensenum=doctor.licensenum AND looksaft$
SELECT * FROM ohip;
SELECT dlast, dbirth, plast, pbirth FROM ohip WHERE dbirth < pbirth;
SELECT * FROM looksafter;
DELETE FROM ohip WHERE pfirst='Kevin' AND plast='Hart';
SELECT * FROM ohip WHERE pfirst='Kevin' AND plast='Hart';
SELECT * FROM looksafter WHERE ohipnum=patient.ohipnum AND patient.firstname='Kevin' AND patient.lastname='Hart';
SELECT * FROM doctor;
DELETE FROM ohip WHERE dfirst='Bernie';
SELECT * FROM ohip WHERE dfirst='Bernie';
DELETE FROM ohip WHERE dfirst='Priyanka' AND dlast='Bangalore';
-- The new doctor I inserted (Priyanka Bangalore) cannot be deleted because headdoc is a foreign key in the hospital table, and the doctor I inserted was made headdoc of Sick Kids hospital, meaning the hospital table holds a reference to the head doctor and cannot so easily be deleted.