# Remove the old database and user
drop
    database if exists our_place;
create
    database our_place;
use
    our_place;

# Create the new user
create
    user if not exists 'our_place'@'localhost' identified by 'password';
grant all privileges on our_place.* to
    'our_place'@'localhost';
set
    password for 'our_place'@'localhost' = 'password';


# Create the tables
create table users
(
    id              int auto_increment,
    username        varchar(255)                         not null unique,
    password        varchar(255)                         not null,
    status          varchar(50),
    description     varchar(500),
    profile_picture blob,
    external_link   varchar(100),
    is_admin        boolean,
    joined_on       datetime,
    updated_at      datetime,
    created_at      datetime default current_timestamp() not null,
    primary key (id)
) engine = InnoDB;

create table follows
(
    current_id           int not null,
    target_id            int not null,
    follows_target_since datetime default null,
    primary key (current_id, target_id),
    foreign key (current_id) references users (id),
    foreign key (target_id) references users (id),
    check (follows.current_id != follows.target_id
        )
) engine = InnoDB;

create table channels
(
    channel_id  int          not null auto_increment,
    name        varchar(255) not null,
    created_by  int          not null,
    description varchar(500),
    created_on  datetime     not null,
    primary key (channel_id)
) engine = InnoDB;

create table posts
(
    post_id    int          not null auto_increment,
    channel_id int          not null,
    author_id  int          not null,
    title      varchar(255) not null,
    content    varchar(500) not null,
    image      blob,
    reply_to   int,
    created_on datetime     not null,
    primary key (post_id),
    foreign key (author_id) references users (id),
    foreign key (channel_id) references channels (channel_id),
    foreign key (reply_to) references posts (post_id)
) engine = InnoDB;

create table likes
(
    id          int not null,
    post_id     int not null,
    liked_on    datetime default null,
    disliked_on datetime default null,
    primary key (id, post_id),
    foreign key (id) references users (id),
    foreign key (post_id) references posts (post_id)
) engine = InnoDB;


# Populate the database with 5 rows per table
insert into users (username, password, status, description, external_link, is_admin, joined_on)
values ('jakethegr8', 'iamcool123', 'Working on some projects.', 'I like to make stuff', null, false,
        '2021-01-20 10:12:2'),
       ('hackerman403', 'operationNex', 'Planning world domination.', ':)', 'https://ruletheworld.net', false,
        '2022-06-20 10:12:2'),
       ('admin', 'admin', 'I am the admin', 'I am the admin', null, true, '2021-11-23 04:32:50'),
       ('user1', 'user1', 'I am user1', 'I am user1', null, false, '2021-11-23 04:32:50'),
       ('user2', 'user2', 'I am user2', 'I am user2', null, false, '2021-11-23 04:32:50');

insert into follows (current_id, target_id, follows_target_since)
values (1, 2, '2021-01-20 10:12:2'),
       (1, 5, '2021-01-20 10:12:2'),
       (2, 1, '2021-01-20 10:12:2'),
       (2, 3, '2021-01-20 10:12:2'),
       (2, 4, '2021-01-20 10:12:2'),
       (4, 5, '2021-01-20 10:12:2'),
       (5, 1, '2021-01-20 10:12:2'),
       (5, 2, '2021-01-20 10:12:2'),
       (5, 3, '2021-01-20 10:12:2'),
       (5, 4, '2021-01-20 10:12:2');

insert into channels (name, created_by, description, created_on)
values ('General', 1, 'General discussion', '2021-01-20 10:12:2'),
       ('Programming', 1, 'Programming discussion', '2021-01-20 10:12:2'),
       ('Gaming', 1, 'Gaming discussion', '2021-01-20 10:12:2'),
       ('Music', 1, 'Music discussion', '2021-01-20 10:12:2'),
       ('Art', 1, 'Art discussion', '2021-01-20 10:12:2');

insert into posts (channel_id, author_id, title, content, image, reply_to, created_on)
values (1, 1, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (1, 2, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (1, 3, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (1, 4, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (1, 5, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (2, 1, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (2, 2, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (2, 3, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (2, 4, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (2, 5, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (3, 1, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (3, 2, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (3, 3, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (3, 4, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2'),
       (3, 5, 'Hello World', 'Hello World!', null, null, '2021-01-20 10:12:2');

insert into likes (id, post_id, liked_on, disliked_on)
values (1, 1, '2021-01-20 10:12:2', null),
       (1, 2, '2021-01-20 10:12:2', null),
       (1, 3, '2021-01-20 10:12:2', null),
       (1, 4, '2021-01-20 10:12:2', null),
       (1, 5, '2021-01-20 10:12:2', null),
       (1, 6, '2021-01-20 10:12:2', null),
       (1, 7, '2021-01-20 10:12:2', null),
       (1, 8, '2021-01-20 10:12:2', null),
       (1, 9, '2021-01-20 10:12:2', null),
       (1, 10, '2021-01-20 10:12:2', null),
       (1, 11, '2021-01-20 10:12:2', null),
       (1, 12, '2021-01-20 10:12:2', null),
       (1, 13, '2021-01-20 10:12:2', null),
       (1, 14, '2021-01-20 10:12:2', null),
       (1, 15, '2021-01-20 10:12:2', null);
