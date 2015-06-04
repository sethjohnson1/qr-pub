alter table templates add column allow_comments tinyint(1) default 1 after id;
alter table assets drop column allow_comments;
