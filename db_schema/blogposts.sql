CREATE TABLE blogposts (
    id serial PRIMARY KEY,
    title text,
    text_main text,
    text_summary text,
    created timestamp,
    changed timestamp,
    status int
);
