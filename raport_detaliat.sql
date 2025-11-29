select 
p.nume as nume_pacient,
p.cnp as cnp_pacient,
i.descriere as descriere_interventie,
i.data as data_interventie,
m.nume as nume_medic,
i.timp_reactie as timp_reactie_interventie
from pacienti p
join interventii i on p.cnp = i.cnp
join medici m on i.id_medic = m.id
order by 
nume_pacient asc, 
nume_medic asc,
timp_reactie desc;