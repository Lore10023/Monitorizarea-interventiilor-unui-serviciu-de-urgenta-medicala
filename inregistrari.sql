insert into pacienti values 
('6010101123456', 'Popescu Ion', 'Str. Lalelelor nr. 12, Bucuresti'),
('6020202123457', 'Ionescu Maria', 'Bd. Independentei nr. 45, Cluj-Napoca'),
('6030303123458', 'Georgescu Andrei', 'Str. Mihai Eminescu nr. 8, Iasi'),
('6040404123459', 'Dumitrescu Elena', 'Aleea Florilor nr. 3, Timisoara');

insert into medici values 
(1, 'Stan Radu'),
(2, 'Morar Ana'),
(3, 'Ilie Tudor'),
(4, 'Serban Oana'),
(5, 'Vintan Alexandru');

insert into interventii values 
(1,'6020202123457','Vaccinare antigripala','2025-04-12',2,10,150.00), 
(2,'6020202123457','Ecografie cardiaca','2025-12-21',5,50,500.50), 
(3,'6020202123457','Extractie molar de minte','2026-01-10',1,5,400.00), 
(4,'6020202123457','Ecografie cardiaca','2025-12-21',3,50,500.50), 

(5,'6010101123456','Curatare si fluorizare dentara','2025-03-10',3,10,350.00),
(6,'6010101123456','Detartraj profesional','2025-10-30',1,40,400.50),


(7,'6030303123458','Control periodic','2025-05-14',4,23,100.00),
(8,'6030303123458','Consultație generală','2025-06-20',1,50,269.30),
(9,'6030303123458','Control periodic','2025-07-10',5,30,104.00),


(10,'6040404123459','Prelevare probe biologice','2025-11-27',3,78,1000.00);
