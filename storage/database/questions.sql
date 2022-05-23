create table questions
(
    id                    bigint auto_increment
        primary key,
    name                  varchar(255)   default ''        not null,
    questiontext          longtext                         not null,
    questiontextformat    tinyint        default 0         not null,
    generalfeedback       longtext                         not null,
    generalfeedbackformat tinyint        default 0         not null,
    defaultmark           decimal(12, 7) default 1.0000000 not null,
    penalty               decimal(12, 7) default 0.3333333 not null,
    qtype                 varchar(20)    default ''        not null,
    length                bigint         default 1         not null,
    created_by            bigint                           null,
    modified_by           bigint                           null,
    created_at            timestamp                        null,
    updated_at            timestamp                        null,
    deleted_at            timestamp                        null
)
    comment 'This table stores the definition of one version of a question' auto_increment = 5;

create index ques_cre_ix
    on questions (created_by);

create index ques_mod_ix
    on questions (modified_by);



create index ques_qty_ix
    on questions (qtype);

INSERT INTO laravel_sl.questions (id,  name, questiontext, questiontextformat, generalfeedback, generalfeedbackformat, defaultmark, penalty, qtype, length,  created_by, modified_by, created_at, updated_at, deleted_at) VALUES (1,  'What is Laravel SL', 'A Web administration to support Second life Scripts', 1, '', 1, 1.0000000, 1.0000000, 'truefalse', 1,  2, 2, null, null, null);
