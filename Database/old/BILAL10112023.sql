drop procedure if exists sp_SelectAllGrp;
delimiter $
CREATE PROCEDURE sp_SelectAllGrp(codetab varchar(10))
BEGIN
	SELECT g.CodeGrp,g.CodeFlr,g.Annee,g.Fpa,g.taux,f.CodeSect FROM Groupe g
    inner join filiere f using(CodeFlr)
    WHERE g.codeEtab=codetab;
END$
delimiter ;

drop procedure if exists SP_GetAllValidateur;
delimiter $
CREATE PROCEDURE SP_GetAllValidateur(etablissement varchar(15))
begin 
	select v.filiere,f.DescpFlr,v.matricule,concat(fo.Nom," ",fo.prenom) as nom,f.CodeSect
    from formateur fo inner join Validateur v using(matricule)
    inner join filiere f on f.CodeFlr = v.filiere
    where Etab = etablissement 
    order by v.filiere;
END$
delimiter ;

drop procedure if exists SP_FindValidateur;
delimiter $
create PROCEDURE SP_FindValidateur(val varchar(255),etablissement varchar(15))
begin 
	select v.filiere,f.DescpFlr,v.matricule,concat(fo.Nom," ",fo.prenom) as nom,f.CodeSect
    from formateur fo inner join Validateur v using(matricule)
    inner join filiere f on f.CodeFlr = v.filiere
    where Etab = etablissement and 
    (
    v.filiere REGEXP val
	OR
	f.DescpFlr REGEXP val
	OR
	v.matricule REGEXP val
	OR
	nom REGEXP val
    )
    order by v.filiere;
END$
delimiter ;

drop procedure if exists SP_TopAbsenceStagiaire;
delimiter $
CREATE PROCEDURE SP_TopAbsenceStagiaire(dtd date,dtf date,tp VARCHAR(10),ann VARCHAR(10),etablissement VARCHAR(20))
begin
	select s.cef,s.nom,s.prenom,s.groupe,s.discipline ,count(*) as nbabsence,f.CodeSect
    from filiere f 
    inner join groupe g using(CodeFlr) 
    inner join stagiaire s on g.CodeGrp = s.Groupe
    inner join absencestagiaire a using(cef)
    where  a.DateAbsenece >= dtd and a.DateAbsenece <= dtf
    and a.type = tp and a.AnneFr = ann and a.etab = etablissement
    and s.etab = etablissement
    group by s.cef,s.nom,s.prenom,s.groupe
    order by nbabsence desc 
    limit 10
    ;
end$
delimiter ;


drop procedure if exists SP_GetConsulterAbsence;
delimiter $
CREATE PROCEDURE SP_GetConsulterAbsence(dtd date,dtf date,sea varchar(20),grp VARCHAR(20),cefstg varchar(50),
										ann VARCHAR(10),etablissement VARCHAR(10),tp varchar(10))
begin 
	if (sea = "choisir" and grp = "choisir" and cefstg = "choisir") then
        SELECT a.groupe,count(*) as nbabsence ,f.CodeSect 
        from filiere f 
		inner join groupe g using(CodeFlr) 
		inner join stagiaire s on g.CodeGrp = s.Groupe
		inner join absencestagiaire a using(cef)
        where a.DateAbsenece >= dtd and a.DateAbsenece <= dtf
        and a.AnneFr = ann and a.etab = etablissement and a.type = tp
        group by a.groupe 
        order by nbabsence desc;
	end if;
    if (sea != "choisir" and grp = "choisir" and cefstg = "choisir") then
		SELECT groupe,count(*) as nbabsence  ,f.CodeSect
        from filiere f 
		inner join groupe g using(CodeFlr) 
		inner join stagiaire s on g.CodeGrp = s.Groupe
		inner join absencestagiaire a using(cef)
        where a.DateAbsenece >= dtd and a.DateAbsenece <= dtf
        and a.AnneFr = ann and a.etab = etablissement and a.seance = sea and a.type = tp
        group by a.groupe 
        order by nbabsence desc;
	end if;
    if (sea = "choisir" and grp != "choisir" and cefstg = "choisir") then
        SELECT a.cef,s.Nom,s.Prenom,s.discipline,count(*) as nbabsence FROM stagiaire s inner join
        absencestagiaire a using(cef)
        where DateAbsenece >= dtd and DateAbsenece <= dtf
        and a.AnneFr = ann and a.etab = etablissement and a.groupe = grp and a.type = tp
        group by a.cef
        order by nbabsence desc;
	end if;
    if (sea != "choisir" and grp != "choisir" and cefstg = "choisir") then
		SELECT a.cef,s.Nom,s.Prenom,s.discipline,count(*) as nbabsence FROM stagiaire s inner join
        absencestagiaire A using(cef)
        where DateAbsenece >= dtd and DateAbsenece <= dtf
        and a.AnneFr = ann and a.etab = etablissement and a.groupe = grp and a.seance = sea and a.type = tp
        group by a.cef 
        order by nbabsence desc;
	end if;
    
    if (sea = "choisir" and grp != "choisir" and cefstg != "choisir") then
		select * 
		from Absencestagiaire  
		where CEF = cefstg  
		and  etab = etab and AnneFr = ann and Groupe = grp and type = tp 
		and DateAbsenece >= dtd and DateAbsenece <= dtf;
        
	end if;
    if (sea != "choisir" and grp != "choisir" and cefstg != "choisir") then
        select * 
		from Absencestagiaire  
		where CEF = cefstg  
		and  etab = etab and AnneFr = ann and Groupe = grp and type = tp and seance = sea
		and DateAbsenece >= dtd and DateAbsenece <= dtf;
	end if;
end$
delimiter ;


drop procedure if exists SP_AbsenceStatistiqueBySecteur;
delimiter $
CREATE PROCEDURE SP_AbsenceStatistiqueBySecteur(dtd date,dtf date,sea varchar(20),grp VARCHAR(20),cefstg varchar(50),
										ann VARCHAR(10),etablissement VARCHAR(10),tp varchar(10),secteur varchar(15))
begin 
	if (sea = "choisir" and grp = "choisir" and cefstg = "choisir") then
        SELECT count(*) 
        from filiere f 
		inner join groupe g using(CodeFlr) 
		inner join stagiaire s on g.CodeGrp = s.Groupe
		inner join absencestagiaire a using(cef)
        where a.DateAbsenece >= dtd and a.DateAbsenece <= dtf
        and a.AnneFr = ann and a.etab = etablissement and a.type = tp and f.CodeSect = secteur;
	end if;
    if (sea != "choisir" and grp = "choisir" and cefstg = "choisir") then
        SELECT count(*) 
        from filiere f 
		inner join groupe g using(CodeFlr) 
		inner join stagiaire s on g.CodeGrp = s.Groupe
		inner join absencestagiaire a using(cef)
        where a.DateAbsenece >= dtd and a.DateAbsenece <= dtf
        and a.AnneFr = ann and a.etab = etablissement and a.seance = sea and a.type = tp and f.CodeSect = secteur;
	end if;
    if (sea = "choisir" and grp != "choisir" and cefstg = "choisir") then
        SELECT count(*) 
        from filiere f 
		inner join groupe g using(CodeFlr) 
		inner join stagiaire s on g.CodeGrp = s.Groupe
		inner join absencestagiaire a using(cef)
        where a.DateAbsenece >= dtd and a.DateAbsenece <= dtf
        and a.AnneFr = ann and a.etab = etablissement and a.groupe = grp and a.type = tp and f.CodeSect = secteur;
	end if;
    if (sea = "choisir" and grp != "choisir" and cefstg != "choisir") then
        SELECT count(*) 
         from filiere f 
		inner join groupe g using(CodeFlr) 
		inner join stagiaire s on g.CodeGrp = s.Groupe
		inner join absencestagiaire a using(cef)
        where a.DateAbsenece >= dtd and a.DateAbsenece <= dtf
        and a.AnneFr = ann and a.etab = etablissement and a.groupe = grp and a.cef = cefstg and a.type = tp and f.CodeSect = secteur;
	end if;
    if (sea != "choisir" and grp != "choisir" and cefstg = "choisir") then
        SELECT count(*) 
        from filiere f 
		inner join groupe g using(CodeFlr) 
		inner join stagiaire s on g.CodeGrp = s.Groupe
		inner join absencestagiaire a using(cef)
        where a.DateAbsenece >= dtd and a.DateAbsenece <= dtf
        and a.AnneFr = ann and a.etab = etablissement and a.groupe = grp and a.seance = sea and a.type = tp and f.CodeSect = secteur;
	end if;
    if (sea != "choisir" and grp != "choisir" and cefstg != "choisir") then
        SELECT count(*) 
         from filiere f 
		inner join groupe g using(CodeFlr) 
		inner join stagiaire s on g.CodeGrp = s.Groupe
		inner join absencestagiaire a using(cef)
        where a.DateAbsenece >= dtd and a.DateAbsenece <= dtf
        and a.AnneFr = ann and a.etab = etablissement and a.groupe = grp and a.seance = sea and a.cef = cefstg and a.type = tp and f.CodeSect = secteur;
	end if;
end$
delimiter ;

drop procedure if exists PS_GetSeanceByDay;
delimiter $
CREATE  PROCEDURE PS_GetSeanceByDay(j varchar(10),anne varchar(15),etab varchar(15))
begin
	select E.CodeGrp,E.Seance,E.CodeModule,E.Matricule,concat(F.Nom," ",F.Prenom ),m.DescpMd, E.CodeSl,fi.CodeSect from
    Formateur F inner join  emploireel E using(Matricule) 
    inner join Groupe g using(CodeGrp)
	inner join modules m on g.CodeFlr = m.CodeFlr
	inner join filiere fi on fi.CodeFlr = m.CodeFlr
    where Jour = j and E.CodeModule = m.CodeMd and AnneeFr = anne and CodeEtb = etab
    order by CodeGrp,Seance;
end$
delimiter ;

drop procedure if exists SP_taux_Avencement_Module;
delimiter $
CREATE PROCEDURE SP_taux_Avencement_Module(taux double,filtre varchar(10),anne varchar(10),etab varchar(10))
begin
	declare n int default 0;
    declare nb_affct int default 0;
	declare mat,nom,comodule,codegrp,codesct varchar(60);
    declare descpmodule varchar(400);
    declare avancement double;
    
    declare cur_affec_emploi cursor for 
    select distinct e.matricule,concat(f.nom," ",f.prenom),e.Codemodule,m.DescpMd,e.CodeGrp,af.avc / ((m.s1 + m.s2) * (g.taux / 100)) * 100 as avancement,fi.CodeSect
	from formateur f,emploireel e ,affectmodule af , modules m ,Groupe g,filiere fi
	where e.Matricule = af.Matricule and e.CodeModule = af.ModuleCode and e.CodeGrp = af.Groupe
	and af.ModuleCode = m.CodeMd and af.Groupe = g.CodeGrp and g.CodeFlr = m.CodeFlr 
    and fi.CodeFlr = m.CodeFlr and g.CodeFlr = fi.CodeFlr
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
    message varchar(100),
    codesecteur varchar(60)
    );
    
    
    open cur_affec_emploi;
		repete:loop
			fetch cur_affec_emploi into mat,nom,comodule,descpmodule,codegrp,avancement,codesct;
            if n = 1 then
				leave repete;
            end if;
            set nb_affct = Nb_Affectation(mat,codegrp,comodule);
            if nb_affct = 0 then
				insert into taux_affect values(mat,nom,comodule,descpmodule,codegrp,avancement,'groupe',codesct);
			else
				insert into taux_affect values(mat,nom,comodule,descpmodule,codegrp,avancement,'module',codesct);
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


drop procedure if exists sp_RechercherGlobal;
delimiter $
CREATE  PROCEDURE sp_RechercherGlobal(information text,CurrentTable VARCHAR(2),etablissement VARCHAR(20))
BEGIN
	CASE CurrentTable
		WHEN "G" THEN
			SELECT g.CodeGrp,g.CodeFlr,g.Annee,g.Fpa,g.taux,f.CodeSect FROM Groupe g
			inner join filiere f using(CodeFlr)
            WHERE g.CodeEtab = etablissement and 
				(g.CodeGrp REGEXP information
                OR
                g.Fpa REGEXP information
                OR
                g.taux REGEXP information
                OR
                g.CodeFlr REGEXP information
                OR
                g.Annee REGEXP information);
		WHEN "F" THEN
			SELECT DISTINCT f.Matricule,f.Nom,f.Prenom,f.Type,f.MassHoraire,concat(s.codesect,"-",s.DescpSect) as secteur  FROM formateur f
            left join secteur s on f.secteur = s.CodeSect
            WHERE f.CodeEtab = etablissement and 
				(f.Matricule REGEXP information
                OR
                f.Nom REGEXP information
                OR
                f.Prenom REGEXP information
                OR 
                s.DescpSect REGEXP information
                OR
                f.MassHoraire REGEXP information);
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
			SELECT DISTINCT CodeSl,DescpSl,Type,secteur FROM salle WHERE CodeEtab = etablissement and 
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
delimiter $