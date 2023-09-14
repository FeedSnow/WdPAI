create type voivoideship as enum ('DS', 'KP', 'LU', 'LB', 'LD', 'MA', 'MZ', 'OP', 'PK', 'PD', 'PM', 'SL', 'SK', 'WN', 'WP', 'ZP');

alter type voivoideship owner to postgres;

create type user_role as enum ('Admin', 'User');

alter type user_role owner to postgres;


create table users_details
(
    user_details_id serial
        primary key,
    user_name       varchar(50)                                      not null,
    user_surname    varchar(50)                                      not null,
    user_phone      integer,
    user_image      varchar(255) default 'h2.png'::character varying not null
);

alter table users_details
    owner to postgres;

create table users
(
    user_id         serial
        primary key,
    user_details_id integer                             not null
        constraint users_users_details_user_details_id_fk
            references users_details
            on update cascade on delete cascade,
    user_email      varchar(50)                         not null
        unique,
    user_password   varchar(255)                        not null,
    user_role       user_role default 'User'::user_role not null
);

alter table users
    owner to postgres;

create table contacts
(
    user_id_1 integer not null
        references users
            on update cascade on delete cascade,
    user_id_2 integer not null
        references users
            on update cascade on delete cascade,
    constraint contacts_pk
        primary key (user_id_1, user_id_2)
);

alter table contacts
    owner to postgres;

create table delivery
(
    delivery_id           serial
        primary key,
    delivery_cod_courier  integer,
    delivery_cod_inperson integer,
    delivery_adv_courier  integer,
    delivery_adv_inperson integer,
    delivery_adv_inpost   integer
);

alter table delivery
    owner to postgres;

create table offers
(
    offer_id          serial
        primary key,
    offer_author_id   integer                                    not null
        constraint offers_users_user_id_fk
            references users
            on update cascade on delete cascade,
    offer_title       varchar(255)                               not null,
    offer_description text,
    offer_price       integer                                    not null,
    offer_quantity    integer      default 1                     not null,
    offer_created_at  date                                       not null,
    offer_active      boolean,
    offer_image       varchar(255) default ''::character varying not null,
    delivery_id       integer      default 1                     not null
        constraint offers_delivery_fk
            references delivery
            on update cascade on delete cascade,
    address_id        integer
);

alter table offers
    owner to postgres;

create table addresses
(
    address_id          serial
        primary key,
    address_voivodeship varchar(2)  not null,
    address_locality    varchar(50) not null,
    address_postcode    varchar(6)  not null,
    address_street      varchar(60) not null,
    address_housenum    varchar(6)  not null,
    address_flatnum     varchar(6)
);

alter table addresses
    owner to postgres;

create table addresses_to_users
(
    user_id    integer not null
        references users
            on update cascade on delete cascade,
    address_id integer not null
        references addresses
            on update cascade on delete restrict,
    constraint addresses_to_users_pk
        primary key (user_id, address_id)
);

alter table addresses_to_users
    owner to postgres;