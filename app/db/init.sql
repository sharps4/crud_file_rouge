DROP TABLE IF EXISTS Setup;
DROP TABLE IF EXISTS Color;
DROP TABLE IF EXISTS Game;
DROP TABLE IF EXISTS Tetris;
DROP TABLE IF EXISTS IntruderImage;
DROP TABLE IF EXISTS Intruder;
DROP TABLE IF EXISTS QuizzQuestion;
DROP TABLE IF EXISTS Quizz;
DROP TABLE IF EXISTS HangedManWord;
DROP TABLE IF EXISTS HangedMan;
DROP TABLE IF EXISTS Company;
DROP TABLE IF EXISTS Stand;
DROP TABLE IF EXISTS Map;

CREATE TABLE Color(
    name VARCHAR(50) PRIMARY KEY,
    code VARCHAR(7)
);

CREATE TABLE Map(
    name VARCHAR(50) PRIMARY KEY
);

CREATE TABLE Stand(
    name    VARCHAR(50) PRIMARY KEY,
    map     VARCHAR(50),-- FOREIGN KEY REFERENCES Map(name),
    x       INTEGER,
    y       INTEGER,
    width   INTEGER,
    height  INTEGER,
    visited BOOLEAN
);

CREATE TABLE Company(
    name           VARCHAR(50)  PRIMARY KEY,
    stand          VARCHAR(50),--  FOREIGN KEY REFERENCES Stand(name),
    description    VARCHAR(512),
    site           VARCHAR(256),
    logo           BLOB,
    activitySector VARCHAR(50)
);

CREATE TABLE Game(
    id     INTEGER     PRIMARY KEY,
    stand  VARCHAR(50),-- FOREIGN KEY REFERENCES Stand(name),
    type   VARCHAR(50),
    gameID INTEGER,
    score  INTEGER,
    played BOOLEAN
);

CREATE TABLE Tetris(
    id INTEGER PRIMARY KEY
);

CREATE TABLE IntruderImage(
    id      INTEGER     PRIMARY KEY,
    keyword VARCHAR(50),
    image   BLOB
);

CREATE TABLE Intruder(
    id      INTEGER     PRIMARY KEY,
    keyword VARCHAR(50)
);

CREATE TABLE QuizzQuestion(
    id           INTEGER      PRIMARY KEY,
    description  VARCHAR(512),
    proposition0 VARCHAR(128),
    proposition1 VARCHAR(128),
    proposition2 VARCHAR(128),
    proposition3 VARCHAR(128),
    answer       INTEGER
);

CREATE TABLE Quizz(
    id        INTEGER PRIMARY KEY,
    question0 INTEGER,-- FOREIGN KEY REFERENCES QuizzQuestion(id),
    question1 INTEGER,-- FOREIGN KEY REFERENCES QuizzQuestion(id),
    question2 INTEGER,-- FOREIGN KEY REFERENCES QuizzQuestion(id),
    question3 INTEGER-- FOREIGN KEY REFERENCES QuizzQuestion(id)
);

CREATE TABLE HangedManWord(
    word        VARCHAR(50)  PRIMARY KEY,
    wordSet     VARCHAR(50),
    description VARCHAR(512)
);

CREATE TABLE HangedMan(
    id      INTEGER     PRIMARY KEY,
    wordSet VARCHAR(50)
);