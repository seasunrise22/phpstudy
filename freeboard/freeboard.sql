create table freeboard (
    num int not null auto_increment,    -- 레코드 번호
    name char(20) not null,             -- 작성자 이름
    pass char(20) not null,             -- 비밀번호
    subject char(200) not null,         -- 글 제목
    content text,                       -- 글 내용
    regist_day char(20),                -- 작성 일시
    primary key(num)
);