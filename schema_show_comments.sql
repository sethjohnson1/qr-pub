alter table templates add column allow_comments tinyint(1) default 1 after id;
alter table assets drop column allow_comments;

alter table comments add column secret_uuid varchar(36);

-- and add sortorder for templates here as well

alter table templates add column sortorder int(11) after id;