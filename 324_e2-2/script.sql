create table FlujoProceso					
(
Flujo varchar(3),
Proceso varchar(3),
ProcesoSiguiente varchar(3),
Tipo varchar(1),
Pantalla varchar(20),
Rol varchar(20)
);

create table FlujoProcesoCondicionante
(			
Flujo varchar(3),
Proceso varchar(3),
ProcesoSI varchar(3),
ProcesoNO varchar(3)
);

insert into FlujoProceso values('F1','P1','P2','I','Inicio','Postulante');
insert into FlujoProceso values('F1','P2','P3','P','Documentos','Postulante');
insert into FlujoProceso values('F1','P3','P4','P','Presentar','Postulante');
insert into FlujoProceso values('F1','P4',null,'C','AlDia','DireccionCarrera');
insert into FlujoProceso values('F1','P5',null,'F','CausaNegativa','DireccionCarrera');
insert into FlujoProceso values('F1','P6',null,'F','InscripcionValida','DireccionCarrera');

insert into FlujoProcesoCondicionante values('F1','P4','P6','P5');

create table docenteTitular
(
ci int,
nombre varchar(30),
fechaNac date,
departamento varchar(2)
);

insert into docenteTitular values(592875,'Luz Flores','1988-08-18','LP');
insert into docenteTitular values(385132,'Raul Montes','1982-06-11','LP');


create table postulante
(
ci int,
CertificadoNac bit,
FotoCI bit,
CertificadoAnt bit,
FotoTitulo bit,
ProgGestion bit
);

