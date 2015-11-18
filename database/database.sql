PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS User;
CREATE TABLE User(
	username TEXT PRIMARY KEY,
	password TEXT NOT NULL,
	name TEXT NOT NULL,
	city TEXT NOT NULL,
);

DROP TABLE IF EXISTS Event;
CREATE TABLE Event(
	id INTEGER PRIMARY KEY,
	type REFERENCES EventType(eventType) NOT NULL,
	description TEXT NOT NULL,
	time TEXT NOT NULL,
	city TEXT NOT NULL,
	address TEXT,
	imageURL TEXT NOT NULL,
	publicEvent INTEGER NOT NULL,
	CONSTRAINT ck_public CHECK (publicEvent = 0 OR publicEvent = 1)
);

DROP TABLE IF EXISTS Attending;
CREATE TABLE Attending(
	username TEXT REFERENCES User(username) ON DELETE CASCADE,
	eventId INTEGER REFERENCES Event(id) ON DELETE CASCADE,
	PRIMARY KEY(username, eventId) 
);

DROP TABLE IF EXISTS EventCreator;
CREATE TABLE EventCreator(
	username TEXT REFERENCES User(username) ON DELETE CASCADE,
	eventId INTEGER REFERENCES Event(id) ON DELETE CASCADE,
	PRIMARY KEY(username, eventId)
);

DROP TABLE IF EXISTS Comment;
CREATE TABLE Comment(
	id INTEGER PRIMARY KEY,
	username TEXT REFERENCES User(username) ON DELETE CASCADE,
	eventId INTEGER REFERENCES Event(id) ON DELETE CASCADE,
	time TEXT NOT NULL,
	commentContent TEXT NOT NULL
);

DROP TABLE IF EXISTS EventType;
CREATE TABLE EventType(
	eventType TEXT PRIMARY KEY
);

CREATE TRIGGER CancelUserEvents
AFTER DELETE ON User
FOR EACH ROW
BEGIN
DELETE FROM Event WHERE id in (SELECT eventId FROM EventCreator WHERE username = OLD.username)
END;

INSERT INTO EventType(eventType) values ('Award ceremony');
INSERT INTO EventType(eventType) values ('Birthday');
INSERT INTO EventType(eventType) values ('Conference');
INSERT INTO EventType(eventType) values ('Dinner');
INSERT INTO EventType(eventType) values ('Family event');
INSERT INTO EventType(eventType) values ('Gathering');
INSERT INTO EventType(eventType) values ('Launch');
INSERT INTO EventType(eventType) values ('Meeting');
INSERT INTO EventType(eventType) values ('Press conference');
INSERT INTO EventType(eventType) values ('Product launch');
INSERT INTO EventType(eventType) values ('Opening');
INSERT INTO EventType(eventType) values ('Other');
INSERT INTO EventType(eventType) values ('Retreat');
INSERT INTO EventType(eventType) values ('Seminar');
INSERT INTO EventType(eventType) values ('Sports event');
INSERT INTO EventType(eventType) values ('Tea party');
INSERT INTO EventType(eventType) values ('Theme party');
INSERT INTO EventType(eventType) values ('Trade show');
INSERT INTO EventType(eventType) values ('Wedding');
INSERT INTO EventType(eventType) values ('VIP event');

