USE taskstep;

-- STYLES

DELETE FROM style WHERE idStyle = 1000 OR idStyle = 0;

INSERT INTO style VALUES
	(0, 'classic');


-- USERS

DELETE FROM User WHERE idUser = 1000;

INSERT INTO User VALUES
	(1000, '', 'mdp', '', 'test@mail.fr', 1000, 1);


-- SESSIONS

DELETE FROM Session WHERE token = '12345678901234567890';

INSERT INTO Session VALUES
	('12345678901234567890', '9999-12-31', 1000);


-- PROJECTS

DELETE FROM projects WHERE id = 1000;

INSERT INTO projects VALUES
	(1000, 'Sample project', 1000);


-- CONTEXTS

DELETE FROM contexts WHERE id = 1000;

INSERT INTO contexts VALUES
	(1000, 'Sample context', 1000);


-- SECTIONS

DELETE FROM sections WHERE id = 1000;

INSERT INTO sections VALUES
	(1000, 'ideas');


-- ITEMS

DELETE FROM items WHERE id = 1000;

INSERT INTO items VALUES
	(1000, 'Sample item', '2024-04-10', 'Notes', 'https://oomfnetwork.fr', 0, 1000, 1000, 1000, 1000);