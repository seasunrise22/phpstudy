create table memberboard (
    num int not null auto_increment,
    id char(20) not null,
    name char(20) not null,
    subject char(200) not null,
    content text not null,
    regist_day char(20),
    file_name char(40),
    file_type char(40),
    file_copied char(40),
    primary key(num)
);