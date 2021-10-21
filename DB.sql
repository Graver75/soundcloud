create database soundcloud;

use soundcloud;

create table artists
(
    id              int auto_increment
        primary key,
    sc_id           int                                null,
    created         datetime default CURRENT_TIMESTAMP null,
    user_name       text                               null,
    name            text                               null,
    city            text                               null,
    first_name      text                               null,
    last_name       text                               null,
    followers_count int                                null,
    playlists_count int                                null,
    tracks_count    int                                null,
    link            text                               null,
    description     text                               null
);

create index artists_sc_id_index
    on artists (sc_id);

create table tracks
(
    id             int auto_increment
        primary key,
    sc_id          int                                null,
    created        datetime default CURRENT_TIMESTAMP null,
    title          text                               null,
    duration       int                                null,
    likes_count    int                                null,
    artist_id      int                                not null,
    comment_count  int                                null,
    playback_count int                                null,
    constraint tracks_artists_sc_id_fk
        foreign key (artist_id) references artists (sc_id)
);

