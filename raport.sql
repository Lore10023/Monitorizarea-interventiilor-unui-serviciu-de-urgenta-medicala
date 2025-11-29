select
p.nume as nume_pacient,
p.cnp as cnp_pacient,
count(i.id) as nr_total_interventii,
avg(i.timp_reactie) as timp_mediu_reactie
from pacienti p
left join
interventii i on p.cnp = i.cnp
group by 
p.cnp, p.nume
order by 
p.nume