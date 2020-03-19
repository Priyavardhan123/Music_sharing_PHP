
-- create users table
create table Users ( 
    username VARCHAR(30) NOT NULL PRIMARY KEY,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL
    );

-- create albums table
create table Albums ( 
    username VARCHAR(30),
    artist VARCHAR(230),
    album_title VARCHAR(250),
    genre VARCHAR(100),
    is_favorite BOOLEAN,
    FOREIGN KEY (username) REFERENCES Users(username)
    );

-- create songs table
create table Songs ( 
    album_title VARCHAR(250),
    song_title VARCHAR(230),
    audio_file VARCHAR(230),
    is_favorite BOOLEAN,
    FOREIGN KEY (album_title) REFERENCES Albums(album_title)
    );

