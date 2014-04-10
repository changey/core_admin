<?php
//connect to MySQL
include_once 'config.php';

$query = 'DROP TABLE IF EXISTS itinerary';
mysql_query($query, $con) or die (mysql_error($con));
//create the table
$query = '
        CREATE TABLE itinerary (
        id        INTEGER UNSIGNED  NOT NULL AUTO_INCREMENT, 
        poster      VARCHAR(255)      NOT NULL, 
        depplace    VARCHAR(255)      NOT NULL, 
        arrplace    VARCHAR(255)      NOT NULL, 
        deptime     VARCHAR(255)      NOT NULL, 
        arrtime     VARCHAR(255)      NOT NULL,
        depflexibility     INTEGER UNSIGNED  NOT NULL DEFAULT 3,
        arrflexibility     INTEGER UNSIGNED  NOT NULL DEFAULT 3,
        people      INTEGER UNSIGNED  NOT NULL DEFAULT 1,
        class       INTEGER UNSIGNED  NOT NULL DEFAULT 0,
        nearby      BOOLEAN           NOT NULL,
        multistops  BOOLEAN           NOT NULL,
        anyairlines BOOLEAN           NOT NULL,
        additional  VARCHAR(255)      NOT NULL, 
        type        INTEGER UNSIGNED  NOT NULL DEFAULT 0,
        award       INTEGER UNSIGNED  NOT NULL DEFAULT 0,
        paid        BOOLEAN           NOT NULL,
        time        VARCHAR(255)      NOT NULL, 

        PRIMARY KEY (id)
    ) 
    ENGINE=MyISAM';
mysql_query($query, $con) or die (mysql_error($con));

$query = 'DROP TABLE IF EXISTS bids';
mysql_query($query, $con) or die (mysql_error($con));
//create the table
$query = '
        CREATE TABLE bids (
        id          INTEGER UNSIGNED  NOT NULL AUTO_INCREMENT, 
        trip_id     INTEGER UNSIGNED  NOT NULL,
        expert      VARCHAR(255)      NOT NULL,
        price       INTEGER      NOT NULL, 
        source      VARCHAR(255)      NOT NULL,
        depplace    VARCHAR(255)      NOT NULL,
        arrplace    VARCHAR(255)      NOT NULL,
        depstops    INTEGER      NOT NULL,
        arrstops    INTEGER      NOT NULL, 
        deptime     VARCHAR(255)      NOT NULL, 
        arrtime     VARCHAR(255)      NOT NULL,
        additional     VARCHAR(255)      NOT NULL,
        instructions   VARCHAR(255)      NOT NULL,
        sendtime       VARCHAR(255)      NOT NULL,
        paid        BOOLEAN      NOT NULL,
        poster      VARCHAR(255)      NOT NULL,
        people      INTEGER UNSIGNED  NOT NULL DEFAULT 1,
        class       INTEGER UNSIGNED  NOT NULL DEFAULT 0,
        nearby      BOOLEAN           NOT NULL,
        multistops  BOOLEAN           NOT NULL,
        anyairlines BOOLEAN           NOT NULL,
        depflexibility     INTEGER UNSIGNED  NOT NULL DEFAULT 3,
        arrflexibility     INTEGER UNSIGNED  NOT NULL DEFAULT 3,
        awardee     VARCHAR(255)      NOT NULL,
        awarded     BOOLEAN           NOT NULL DEFAULT 0,

        PRIMARY KEY (id)
    ) 
    ENGINE=MyISAM';
mysql_query($query, $con) or die (mysql_error($con));

$query = 'DROP TABLE IF EXISTS rnmembers';
mysql_query($query, $con) or die (mysql_error($con));
//create the table
$query = '
        CREATE TABLE rnmembers (
        id          INTEGER UNSIGNED  NOT NULL AUTO_INCREMENT, 
        user        VARCHAR(16)       NOT NULL,
        pass        VARCHAR(16)       NOT NULL,
        expert      BOOLEAN           NOT NULL,

        PRIMARY KEY (id)
    ) 
    ENGINE=MyISAM';
mysql_query($query, $con) or die (mysql_error($con));

$query = '
        CREATE TABLE experts (
        id          INTEGER UNSIGNED  NOT NULL AUTO_INCREMENT, 
        user        VARCHAR(16)       NOT NULL,
        pass        VARCHAR(16)       NOT NULL,
        flight      VARCHAR(256)      NOT NULL,

        PRIMARY KEY (id)
    ) 
    ENGINE=MyISAM';
mysql_query($query, $con) or die (mysql_error($con));

echo 'Database successfully created!';
?>