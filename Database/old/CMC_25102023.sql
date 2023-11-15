alter table formateur add column secteur varchar(15);
alter table salle add column secteur varchar(15);

drop procedure SP_GetAllFormateur;
delimiter $
CREATE  PROCEDURE SP_GetAllFormateur(IN etab varchar(10))
BEGIN 
	SELECT DISTINCT f.Matricule,f.Nom,f.Prenom,f.Type,f.MassHoraire,concat(f.secteur,"-",s.DescpSect) as secteur FROM formateur f
	left join secteur s on f.secteur = s.CodeSect where CodeEtab = etab ;
END$
delimiter ;

drop procedure SP_InsertFormateur;
delimiter $
CREATE  PROCEDURE SP_InsertFormateur(mat varchar(15),Nom varchar(25),Prenom varchar(25),CodeEtab varchar(25),tp varchar(25),MS Decimal(8,2)
,passwo varchar(255),sect varchar(15))
BEGIN 
	insert into formateur values (mat,Nom,Prenom,CodeEtab,tp,MS,passwo,sect);
END$
delimiter ;


drop procedure SP_UpdateFormateur;
delimiter $
CREATE PROCEDURE SP_UpdateFormateur(IN mat varchar(15),IN Nm varchar(25),IN Pr varchar(25),
IN CdEtab varchar(25),IN tp varchar(25),IN MS Decimal(8,2),secteur varchar(15))
BEGIN 
	Update formateur f set
    f.Nom =  Nm,
    f.Prenom =  Pr,
    f.CodeEtab =  CdEtab,
    f.Type =  tp,
    f.MassHoraire =  MS,
    f.secteur =  secteur
    where f.Matricule = mat;
END$
delimiter ;


drop procedure SP_GetAll_Salle;
delimiter $
CREATE  PROCEDURE SP_GetAll_Salle(codeEtb varchar(10))
BEGIN
	 SELECT CodeSl,DescpSl,Type,concat(sa.secteur,"-",s.DescpSect) as secteur FROM  salle sa
     left join secteur s on sa.secteur = s.CodeSect
     WHERE CodeEtab=CodeEtb;
END$
delimiter ;

drop procedure SP_Add_Salle;
delimiter $
CREATE  PROCEDURE SP_Add_Salle(CdSal VARCHAR(15),DescrpSl VARCHAR(50),Typ VARCHAR(15),CdEtab VARCHAR(15),sect VARCHAR(15))
BEGIN
	 INSERT INTO  salle VALUES(CdSal,DescrpSl,Typ,CdEtab,sect);
END$
delimiter ;

drop procedure SP_Update_Salle;
delimiter $
CREATE PROCEDURE SP_Update_Salle(CdSal VARCHAR(15),DescrpSal VARCHAR(50),Typ VARCHAR(15),CdEtab VARCHAR(15),sect VARCHAR(15))
BEGIN
	 UPDATE salle 
SET 
    DescpSl = DescrpSal,
    Type = Typ,
    secteur = sect
WHERE
    CodeSl = CdSal AND CodeEtab = CdEtab;
END$
delimiter ;

drop procedure sp_RechercherGlobal;
delimiter $
CREATE  PROCEDURE sp_RechercherGlobal(information text,CurrentTable VARCHAR(2),etablissement VARCHAR(20))
BEGIN
	CASE CurrentTable
		WHEN "G" THEN
			SELECT DISTINCT CodeGrp,CodeFlr,Annee,Fpa,taux  FROM groupe WHERE CodeEtab = etablissement and 
				(CodeGrp REGEXP information
                OR
                CodeFlr REGEXP information
                OR
                Annee REGEXP information);
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
delimiter ;



