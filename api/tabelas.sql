create table arquivos(
    id serial not null,
    endereco varchar(2000) not null,
    primary key(id)
);

create table projetos(
    id serial not null,
    nome varchar(350) not null,
    descricao varchar(2500) not null,
    tipo varchar(100) not null,
    ano_escolar integer not null,
    ano integer not null,
    votos integer default 0,
    link varchar(2000),
    primary key(id)
);

create table membros(
    id serial not null,
    nome varchar(200) not null,
    cargo varchar(200) not null,
    descricao varchar(2500),
    primary key(id)
);

create table destaques(
    id serial not null,
    titulo varchar(250) not null,
    descricao varchar(2500) not null,
    ano integer not null,
    primary key(id)
);

create table disciplinas(
    id serial not null,
    nome varchar(200) not null,
    descricao varchar(2500) not null,
    ano integer not null,
    primary key(id)
);

create table usuario(
    id serial not null,
    codigo varchar(100),
    primary key(id)
);

create table projetos_membros(
    projeto integer,
    membro integer,
    foreign key(`projeto`) references `projetos`(`id`),
    foreign key(`membro`) references `membros`(`id`),
    primary key(projeto,membro)
);

create table projetos_arquivos(
    projeto integer,
    arquivo integer,
    foreign key(`projeto`) references `projetos`(`id`),
    foreign key(`arquivo`) references `arquivos`(`id`),
    primary key(projeto,arquivo)
);

create table projetos_disciplinas(
    projeto integer,
    disciplina integer,
    foreign key(`projeto`) references `projetos`(`id`),
    foreign key(`disciplina`) references `disciplinas`(`id`),
    primary key(projeto,disciplina)
);

create table destaques_arquivos(
    destaque integer,
    arquivo integer,
    foreign key(`destaque`) references `destaques`(`id`),
    foreign key(`arquivo`) references `arquivos`(`id`),
    primary key(destaque,arquivo)
);

create table membros_arquivos(
    membro integer,
    arquivo integer,
    foreign key(`membro`) references `membros`(`id`),
    foreign key(`arquivo`) references `arquivos`(`id`),
    primary key(membro,arquivo)
);