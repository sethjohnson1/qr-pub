/*
everything: created, modified, active, deleted etc. add later
*/

/* add meta to templates */
/* maybe make an "assets" table??*/

drop table if exists users;
create table users(
	id varchar(36) not null,
	primary key(id),
	given_name varchar(255),
	family_name varchar(255),
	created datetime,
	modified datetime,
	last_login datetime,
	active tinyint(1),
	ip varchar(20),
	provider varchar(100),
	oid varchar(200),
	user_identity varchar(255),
	username varchar(255),
	gender varchar(10),
	locale varchar(10),
	picture varchar(255),
	flags int,
	upvotes int,
	downvotes int,
	avgrating int, -- long way off, but calculate their average rating of stuff
	-- now for the Users plugin
	slug varchar(255),
	password varchar(128),
	password_token varchar(128),
	email varchar(255),
	email_verified varchar(255),
	email_token varchar(255),
	email_token_expires datetime,
	tos tinyint(1),
	last_action datetime,
	is_admin tinyint(1),
	role varchar(255)
);

-- for tracking user interaction with comments, not to be confused with the one-to-many relationship between users and their own comments
drop table if exists comments_users;
create table comments_users(
	id int not null auto_increment,
	primary key(id),
	user_id varchar(36),
	comment_id varchar(40),
	created datetime,
	modified datetime,
	-- rating int, wrong place for this, moved to comments table
	upvoted tinyint(1),
	downvoted tinyint(1),
	flagged tinyint(1)
);


drop table if exists comments;
-- expermineting with new structure
create table comments(
	id varchar(40) not null, -- maybe this should be a UUID - yes definitely because they'll be used in URLs
	primary key(id),
	thoughts text, -- because the word 'comment' is reserved
	rating int,
	created datetime,
	modified datetime,
	user_id varchar(36),
	parent_id int, -- maybe not threaded but just in case, should probably max at 3
	template_id int,
	hidden tinyint(1),
	flags int, -- this is a number so we can count number of flags, maybe shut it down after so many
	upvotes int,
	downvotes int
);

drop table if exists templates;
create table templates(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	created datetime,
	modified datetime,
	active tinyint(1),
	meta_title varchar(70),
	meta_desc varchar(400), 
	location varchar(100),
	creator varchar(255), -- simple way to keep track, and eventually could be used for Auth
	nextid int,
	previd int,
	code int,
	ip varchar(20)
);

drop table if exists assets;
create table assets(
	id char(36) not null,
	primary key(id),
	name varchar(255),
	asset_text text,
	filename varchar(255),
	filesize int(11),
	filemime varchar(45),
	template_id int, -- maybe this could be a HABTM, but I think this will make it simpler and is fine
	sortorder int,
	created datetime,
	modified datetime
);


drop table if exists beacons;
create table beacons(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	created datetime,
	modified datetime,
	active tinyint(1),
	uuid varchar(60),
	major int,
	minor int,
	strength int,
	-- relationships
	template_id int
);

-- for global settings just proof-of-concept I guess, name could be "top_logo" and value would be "something.jpg"
drop table  if exists preferences;
create table preferences(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	name_value varchar(255)
);