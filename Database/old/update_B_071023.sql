-- update groupe set taux = "100" where Fpa = "N";
-- update groupe set taux = "60" where Fpa = "O";

alter table groupe add column taux int;
alter table etablissement drop column TauxFPA;

drop procedure sp_SelectAllGrp;
delimiter $
CREATE PROCEDURE sp_SelectAllGrp(codetab varchar(10))
BEGIN
	SELECT CodeGrp,CodeFlr,Annee,Fpa,taux FROM Groupe WHERE codeEtab=codetab;
END$
delimiter ;

drop procedure sp_RechercherGlobal;
delimiter $
CREATE  PROCEDURE sp_RechercherGlobal(information text,CurrentTable VARCHAR(2),atablissement VARCHAR(20))
BEGIN
	CASE CurrentTable
		WHEN "G" THEN
			SELECT DISTINCT CodeGrp,CodeFlr,Annee,Fpa,taux  FROM groupe WHERE CodeEtab = atablissement and 
				(CodeGrp REGEXP information
                OR
                CodeFlr REGEXP information
                OR
                Annee REGEXP information);
		WHEN "F" THEN
			SELECT DISTINCT Matricule,Nom,Prenom,Type,MassHoraire FROM formateur WHERE CodeEtab = atablissement and 
				(Matricule REGEXP information
                OR
                Nom REGEXP information
                OR
                Prenom REGEXP information
                OR
                MassHoraire REGEXP information);
		WHEN "FL" THEN
			SELECT DISTINCT CodeFlr,DescpFlr,CodeSect,Niveau FROM filiere WHERE
				(CodeFlr REGEXP information
                OR
                DescpFlr REGEXP information
                OR
                CodeSect REGEXP information
                OR
                Niveau REGEXP information);
		WHEN "M" THEN
			SELECT DISTINCT CodeMd,CodeFlr,Annee,DescpMd,Pr,Dist,s1,s2 FROM modules WHERE
				(CodeMd REGEXP information
                OR
                CodeFlr REGEXP information
                OR
                Annee REGEXP information
                OR
                DescpMd REGEXP information);
		WHEN "NV" THEN
			SELECT DISTINCT CodeNiv,DescpNiv FROM niveau WHERE
				(CodeNiv REGEXP information
                OR
                DescpNiv REGEXP information);
		WHEN "SL" THEN
			SELECT DISTINCT CodeSl,DescpSl,Type FROM salle WHERE CodeEtab = atablissement and 
				(CodeSl REGEXP information
                OR
                DescpSl REGEXP information
                OR
                Type REGEXP information);
		WHEN "S" THEN
			SELECT DISTINCT CodeSect,DescpSect FROM secteur WHERE
				(CodeSect REGEXP information
                OR
                DescpSect REGEXP information);
	END CASE;
END$
delimiter ;


drop procedure sp_InsertGrp;
delimiter $
CREATE  PROCEDURE sp_InsertGrp(IN cdGrp VARCHAR(15),IN cdFl VARCHAR(15),IN cdEt VARCHAR(15),IN Ann VARCHAR(15),IN Fpa VARCHAR(1),taux int)
BEGIN
	INSERT INTO groupe VALUES (cdGrp,cdFl,cdEt,Ann,Fpa,taux);
END$
delimiter ;

drop procedure sp_UpdateGrp;
delimiter $
CREATE PROCEDURE sp_UpdateGrp(IN cdGrp VARCHAR(15),IN cdEtab VARCHAR(15),IN cdFl VARCHAR(15),IN Ann VARCHAR(15),IN Fpa VARCHAR(1),taux int)
BEGIN
	UPDATE Groupe g SET g.codeFlr = cdFl,g.Annee = Ann,	g.Fpa = Fpa,	g.taux = taux
    WHERE g.CodeGrp = cdGrp and g.CodeEtab = cdEtab;
END$
delimiter ;


drop procedure SP_ModuleAffecter_Formateur;
delimiter $
CREATE PROCEDURE SP_ModuleAffecter_Formateur(mat varchar(20),codetab varchar(10),anne varchar(4))
BEGIN
	SELECT 
      af.Groupe,m.descpMd,m.s1 * g.taux /100 as s1,m.s2* g.taux /100 as s2,m.Pr* g.taux /100 as Pr ,m.Dist* g.taux /100 as Dist,m.CodeMd,af.anneefr,m.codeflr,g.Fpa,g.annee,af.avc,af.efm,(af.avc/((m.s1 + m.s2)* g.taux /100))*100 as taux
	FROM groupe g INNER JOIN affectmodule af ON af.Groupe=g.codegrp
	INNER JOIN modules m ON m.CodeMd = af.ModuleCode
	WHERE af.Matricule = mat AND af.CodeEtab = codetab
	AND af.AnneeFr = anne AND m.codeflr=g.codeflr;
     
END$
delimiter ;


drop procedure SP_Affectation_Module_Grp;
delimiter $
CREATE  PROCEDURE SP_Affectation_Module_Grp(grp varchar(15),etab varchar(15),an varchar(10))
begin
	select t2.codegrp,t2.annee,t2.CodeMd,t2.descpMd,t2.s1,t2.s2,t2.Pr,t2.Dist,t2.codeflr,t1.Matricule,t1.NomPr from
		(select g.codegrp,g.annee,m.CodeMd,m.descpMd,m.s1 * g.taux /100 as s1,m.s2* g.taux /100 as s2,m.Pr* g.taux /100 as Pr,m.Dist* g.taux /100 as Dist,m.codeflr,g.taux
		from groupe g inner join filiere f using(Codeflr)
		inner join modules m using(Codeflr) 
		where g.codeGrp = grp and g.Annee = m.Annee) t2
	left join
		(SELECT f.Matricule,concat(f.nom,' ',f.prenom) as NomPr,af.Groupe,m.descpMd,m.s1,m.s2,m.Pr,m.Dist,af.anneefr,m.codeflr,m.CodeMd,g.annee
		FROM Formateur f
		INNER JOIN affectmodule af USING(Matricule) INNER JOIN modules m ON m.CodeMd=af.ModuleCode 
		INNER JOIN groupe g using(CodeFlr)
		WHERE af.CodeEtab=etab AND af.Anneefr=an AND af.Groupe=grp  AND af.Groupe=g.CodeGrp and g.Annee = m.Annee) t1
	using(CodeMd);
END$
delimiter ;

drop procedure couleur_row_affectation;
delimiter $
CREATE PROCEDURE SP_Couleur_row_affectation(mat varchar(15),codeMd varchar(15),grp varchar(15),anne varchar(15),etab varchar(15))
begin
	declare tauxgrp float;
	declare taux float;
    select g.taux / 100 into tauxgrp  from groupe g where g.codegrp = grp;   
		select a.avc / ((m.s1 + m.s2) * tauxgrp) * 100 into taux
		from affectmodule a inner join Groupe g on g.CodeGrp = a.groupe
		inner join modules m on g.CodeFlr = m.CodeFlr
		where a.ModuleCode = m.CodeMd and a.matricule = mat and a.groupe = grp and a.ModuleCode = codeMd 
		and a.AnneeFr = anne and a.CodeEtab = etab ;
   
    if taux >= 100 then
		select "red";
	end if;
    if taux >= 90 and taux < 100 then
		select "yellow";
    end if;
    if taux < 90 then
		select "green";
    end if;
 end$
delimiter ;

drop procedure SP_taux_Avencement_Module;
delimiter $
CREATE  PROCEDURE SP_taux_Avencement_Module(taux double,filtre varchar(10),anne varchar(10),etab varchar(10))
begin
	declare n int default 0;
    declare nb_affct int default 0;
	declare mat,nom,comodule,codegrp varchar(60);
    declare descpmodule varchar(400);
    declare avancement double;
    
    declare cur_affec_emploi cursor for 
    select distinct e.matricule,concat(f.nom," ",f.prenom),e.Codemodule,m.DescpMd,e.CodeGrp,af.avc / ((m.s1 + m.s2) * (g.taux / 100)) * 100 as avancement
	from formateur f,emploireel e ,affectmodule af , modules m ,Groupe g
	where e.Matricule = af.Matricule and e.CodeModule = af.ModuleCode and e.CodeGrp = af.Groupe
	and af.ModuleCode = m.CodeMd and af.Groupe = g.CodeGrp and g.CodeFlr = m.CodeFlr 
    and e.Matricule = f.Matricule and (af.avc / ((m.s1 + m.s2) * (g.taux / 100)) * 100) >= taux
    and e.CodeEtb = etab and e.AnneeFr = anne 
	order by e.CodeGrp ;
    
    declare Continue handler for Not found set n = 1;
    
    create table taux_affect(
    matricule varchar(100),
    nom varchar(100),
    codemodule varchar(100),
    descptionmodule varchar(400),
    codegroupe varchar(100),
    avancement varchar(100),
    message varchar(100)
    );
    
    open cur_affec_emploi;
		repete:loop
			fetch cur_affec_emploi into mat,nom,comodule,descpmodule,codegrp,avancement;
            if n = 1 then
				leave repete;
            end if;
            set nb_affct = Nb_Affectation(mat,codegrp,comodule);
            if nb_affct = 0 then
				insert into taux_affect values(mat,nom,comodule,descpmodule,codegrp,avancement,'groupe');
			else
				insert into taux_affect values(mat,nom,comodule,descpmodule,codegrp,avancement,'module');
            end if;
		end loop repete;
    Close cur_affec_emploi;
    
	if filtre = "tout" then
		select * from taux_affect order by codegroupe;
    else
		select * from taux_affect where message = filtre order by codegroupe;
    end if;
	drop table taux_affect;

end$
delimiter ;



drop procedure SP_TauxAvancementByEtabAnneF;
delimiter $
CREATE  PROCEDURE SP_TauxAvancementByEtabAnneF(etab varchar(20),ann varchar(10))
begin
select avg(t.avc_grp) from 
(
	select codegrp,sum(s1 + s2) * taux /100 as MH,sum(avc) / (sum(s1 + s2) * taux /100) * 100 as avc_grp 
	from affectmodule af 
    inner join groupe g  on af.groupe = g.CodeGrp
	inner join filiere f using(Codeflr)
	inner join modules m using(Codeflr) 
	where  af.modulecode=m.CodeMd and g.CodeFlr = m.CodeFlr and g.Annee = m.Annee and af.AnneeFr =ann and af.CodeEtab = etab
    group by codegrp
    union
    select codegrp,sum(s1 + s2) * taux /100 as MH, 0 as avc_grp
	from groupe g  
	inner join filiere f using(Codeflr)
	inner join modules m using(Codeflr) 
	where g.Annee = m.Annee  and g.CodeEtab = etab
    and g.CodeGrp not in (select groupe from affectmodule where AnneeFr =ann and CodeEtab = etab)
    group by codegrp
    ) as t;
end$
delimiter ;

drop procedure SP_NBGroupesNonTermineAffectation;
delimiter $
CREATE  PROCEDURE SP_NBGroupesNonTermineAffectation(et varchar(15),An varchar(4))
begin 
	select count(*) from 
	(select g.Codegrp,count(*) as nbmo,g.CodeEtab  
    from groupe g inner join modules m using(CodeFlr) 
    where g.Annee = m.Annee and g.CodeEtab = et 
    group by g.Codegrp order by g.Codegrp) as G
	left join 
    (select Groupe,count(*) as moaff 
    from Affectmodule af where af.CodeEtab = et and AnneeFr = An
    group by Groupe order by Groupe) as Aff
	on G.Codegrp = Aff.Groupe 
    where G.nbmo > Aff.moaff
    or Aff.moaff is null 
    and G.CodeEtab = et;
    -- and Aff.Groupe  not in (select codegrp from groupe where CodeEtab = "SNO0" and codegrp not in 
    -- (select distinct groupe from stagiaire where Etab = "SNO0" and AnneF = "2023"));
end$
delimiter ;





drop procedure SP_AffecterModule;
delimiter $
CREATE PROCEDURE SP_AffecterModule(mat varchar(15),grp varchar(50),codemdl varchar(15),annefr varchar(10),codetab varchar(10))
BEGIN
		INSERT INTO affectmodule(Matricule,Groupe,ModuleCode,AnneeFr,CodeEtab) VALUES(mat,grp,codemdl,annefr,codetab);
end$
delimiter ;

drop procedure SP_AddEFM;
delimiter $
CREATE  PROCEDURE SP_AddEFM(mat varchar(15),grp varchar(15),CodeMd varchar(15),chemin varchar(150),tpefm varchar(20),
anne int,etablissement varchar(20),CdFlr varchar(20))
begin 
	insert into EFM(matricule,groupe,module,url,TypeEFM,DateEntre,CodeFlr,AnneeFr,Etab) values(mat,grp,CodeMd,chemin,tpefm,now(),CdFlr,anne,etablissement);
end$
delimiter ;


drop procedure SP_DeleteModule_Formateur;
delimiter $
CREATE  PROCEDURE SP_DeleteModule_Formateur(mat varchar(10),grp varchar(50),codmd varchar(10),anne varchar(4),etb varchar(30))
BEGIN
	DELETE FROM affectmodule WHERE Matricule=mat AND Groupe=grp AND ModuleCode=codmd AND AnneeFr=anne AND CodeEtab=etb;
end$
delimiter ;




-- *****************************************************************************************************************************************************

drop procedure SP_NbFormateurNonAffectation;
delimiter $
CREATE PROCEDURE SP_FormateurNonAffectation(Etab varchar(15),An varchar(4))
begin 
	select Matricule,Nom,Prenom from Formateur  
	where CodeEtab = Etab and 
	Matricule not in (select distinct Matricule from affectmodule where CodeEtab = Etab and AnneeFr = An);
end$
delimiter ;


drop procedure SP_GroupeNonEmploi;
delimiter $
CREATE PROCEDURE SP_GroupeNonEmploi(Etab varchar(15),An varchar(4))
begin 
	select * from groupe  where CodeEtab = Etab and codegrp not in (select distinct codegrp from emploireel where CodeEtb = Etab and AnneeFr = An);
	-- and codegrp not in (select codegrp from groupe where codegrp not in (select distinct groupe from stagiaire));
end$
delimiter ;

drop procedure SP_NBGroupesNonTermineAffectation;
delimiter $
CREATE PROCEDURE SP_GroupesNonTermineAffectation(et varchar(15),An varchar(4))
begin 
	select * from 
	(select g.Codegrp,count(*) as nbmo,g.CodeEtab  
    from groupe g inner join modules m using(CodeFlr) 
    where g.Annee = m.Annee and g.CodeEtab = et 
    group by g.Codegrp order by g.Codegrp) as G
	left join 
    (select Groupe,count(*) as moaff 
    from Affectmodule af where af.CodeEtab = et and AnneeFr = An
    group by Groupe order by Groupe) as Aff
	on G.Codegrp = Aff.Groupe 
    where G.nbmo > Aff.moaff
    or Aff.moaff is null 
    and G.CodeEtab = et;
    -- and Aff.Groupe  not in (select codegrp from groupe where CodeEtab = "SNO0" and codegrp not in 
    -- (select distinct groupe from stagiaire where Etab = "SNO0" and AnneF = "2023"));
end$
delimiter ;


