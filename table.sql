create table pacienti(
  cnp char(13) primary key,
  nume varchar(50),
  adresa varchar(50),
  cost_total decimal(6,2)
);

create table medici(
  id int primary key,
  nume varchar(50)
);

create table interventii(
  id int primary key,
  cnp char(13),
  descriere varchar(60),
  data date,
  id_medic int,
  timp_reactie int,
  CHECK (timp_reactie>0),
  cost decimal(6,2),
  CHECK (cost>=0),
  FOREIGN KEY (id_medic) REFERENCES medici(id),
  FOREIGN KEY (cnp) REFERENCES pacienti(cnp)
);