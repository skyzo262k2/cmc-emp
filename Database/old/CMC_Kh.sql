alter table personnel add column secteur varchar(50);

DROP PROCEDURE SP_UpdateSurveille;
DELIMITER ;;
CREATE  PROCEDURE SP_UpdateSurveille(mat varchar(25),nm varchar(30),pre varchar(30),etab varchar(25),p_poste varchar(30))
BEGIN
	update personnel set nom=nm ,prenom=pre,Poste=p_poste where CodeEtab=etab AND Matricule=mat;
END ;;
DELIMITER ;

DROP PROCEDURE SP_GetAllSurveille;
DELIMITER ;;
CREATE PROCEDURE SP_GetAllSurveille(etab varchar(25))
BEGIN
	SELECT Matricule,Nom ,prenom,concat(Poste ,'-',  COALESCE(s.DescpSect, '')) as post FROM personnel p LEFT JOIN secteur s 
		on s.CodeSect=p.secteur  where CodeEtab=etab and Poste in ('Surveille','ChefSecteur') ;
END ;;
DELIMITER ;

DROP PROCEDURE SP_FindSurveille;
DELIMITER ;;
CREATE  PROCEDURE SP_FindSurveille(val varchar(255),etab varchar(25))
BEGIN
	SELECT Matricule,Nom ,prenom,concat(Poste ,'-',  COALESCE(s.DescpSect, '')) as post  FROM personnel p LEFT JOIN secteur s 
		on s.CodeSect=p.secteur   where CodeEtab=etab AND Poste in ('Surveille','ChefSecteur') and 
    (Matricule REGEXP val or Nom REGEXP val or prenom REGEXP val );
END ;;
DELIMITER ;



DELIMITER ;;
CREATE  PROCEDURE SP_GetFormateurSecteur(etab varchar(25),p_secteur varchar(50))
BEGIN
	SELECT DISTINCT f.Matricule,f.Nom,f.Prenom,f.Type,f.MassHoraire,concat(f.secteur,"-",s.DescpSect) as secteur FROM formateur f
	left join secteur s on f.secteur = s.CodeSect where CodeEtab = etab  and f.secteur=p_secteur;
END ;;
DELIMITER ;


DELIMITER ;;
CREATE  PROCEDURE sp_RechercherGlobalSecteur(information VARCHAR(50),CurrentTable VARCHAR(2),atablissement VARCHAR(20),sect varchar(30))
BEGIN
	CASE CurrentTable
		WHEN "G" THEN
			SELECT DISTINCT g.CodeGrp,g.CodeFlr,fg.Annee,g.Fpa FROM groupe g 
				INNER JOIN filiere f using(CodeFlr)
				WHERE g.CodeEtab = atablissement and f.CodeSect=sect and 
				(g.CodeGrp REGEXP information
                OR
                g.CodeFlr REGEXP information
                OR
                g.Annee REGEXP information);
		WHEN "F" THEN
			SELECT DISTINCT Matricule,Nom,Prenom,Type,MassHoraire,secteur FROM formateur WHERE CodeEtab = atablissement and secteur=sect and 
				(Matricule REGEXP information
                OR
                Nom REGEXP information
                OR
                Prenom REGEXP information
                OR
                MassHoraire REGEXP information);
		WHEN "FL" THEN
			SELECT DISTINCT CodeFlr,DescpFlr,CodeSect,Niveau FROM filiere  WHERE  CodeSect=sect and
				(CodeFlr REGEXP information
                OR
                DescpFlr REGEXP information
                OR
                CodeSect REGEXP information
                OR
                Niveau REGEXP information);
		WHEN "M" THEN
			SELECT DISTINCT CodeMd,m.CodeFlr,Annee,DescpMd,Pr,Dist,s1,s2 FROM modules m
				INNER JOIN filiere f using(CodeFlr)
				WHERE
                f.CodeSect=sect and
				(CodeMd REGEXP information
                OR
                m.CodeFlr REGEXP information
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
			SELECT DISTINCT CodeSl,DescpSl,Type,secteur FROM salle WHERE CodeEtab = atablissement and secteur=sect and 
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
END ;;
DELIMITER ;



DELIMITER ;;
CREATE  PROCEDURE SPGetModuleSecteur(p_secteur varchar(30))
BEGIN 
	select m.* from modules m inner join filiere f using(CodeFlr) where f.CodeSect=p_secteur;
END ;;
DELIMITER ;




DELIMITER ;;
CREATE PROCEDURE SP_GetSalleSecteur(codeEtb varchar(20),p_secteur varchar(30))
BEGIN
	 SELECT CodeSl,DescpSl,Type,secteur FROM  salle WHERE CodeEtab=CodeEtb and secteur=p_secteur;
END ;;
DELIMITER ;


DELIMITER ;;
CREATE  PROCEDURE PS_GetStagiaireSecteur(ann varchar(30) ,et varchar(30),secteur varchar(30))
begin
		SELECT s.CEF,s.Nom,s.Prenom,s.Groupe,s.Discipline 
			FROM Stagiaire s INNER JOIN Groupe g ON g.CodeGrp=s.Groupe
			INNER JOIN filiere f USING(CodeFlr)
			WHERE Etab = et AND AnneF = ann AND f.CodeSect=secteur;
end ;;
DELIMITER ;



DELIMITER ;;
CREATE PROCEDURE SP_AddSureille(
    IN p_Matricule VARCHAR(15),
    IN p_Nom VARCHAR(25),
    IN p_Prenom VARCHAR(25),
    IN p_Poste VARCHAR(15),
    IN p_CodeEtab VARCHAR(15),
    login varchar(100),
    pass varchar(100),
    secteur varchar(50)
)
BEGIN
	declare cdu int default 0;
    select max(CodeUser) into cdu from user ;
	INSERT INTO  user value(cdu+1,login,pass,'Etab');
    
    INSERT INTO personnel (Matricule, Nom, Prenom, CodeUser, Poste, CodeEtab,secteur)
    VALUES (p_Matricule, p_Nom, p_Prenom, cdu+1, p_Poste, p_CodeEtab,secteur);
END ;;
DELIMITER ;

DROP PROCEDURE Sp_GetAllGroupes_EmploiSecteur;
DELIMITER ;;
CREATE PROCEDURE Sp_GetAllGroupes_EmploiSecteur(Codetb varchar(10),AnneFr varchar(10),secteur varchar(50))
BEGIN
	SELECT af.Groupe as CodeGrp  FROM affectmodule af
		inner join Groupe g  on g.CodeGrp=af.Groupe
        inner join filiere f using(CodeFlr)
	WHERE af.CodeEtab=codetb AND af.AnneeFr=AnneFr AND f.CodeSect=secteur  GROUP BY CodeGrp ORDER BY CodeGrp;
END ;;
DELIMITER ;

DELIMITER ;;
CREATE PROCEDURE Sp_GetAllGroupes_EmploiReelParSecteur(Codetb varchar(10),AnneFr varchar(10),secteur varchar(50))
BEGIN
	SELECT  em.CodeGrp FROM emploireel em INNER JOIN groupe g ON G.CodeGrp=em.CodeGrp
		inner join filiere f on f.codeFlr=g.CodeFlr
    WHERE em.CodeEtb=codetb AND em.AnneeFr=AnneFr AND f.CodeSect=secteur GROUP BY em.CodeGrp ORDER BY em.CodeGrp;
END ;;
DELIMITER ;




DELIMITER ;;
CREATE PROCEDURE SP_Get_Info_EmploiSecteur(anne varchar(4),cdetab varchar(10),secteur varchar(50))
BEGIN
	SELECT f.Matricule,concat(f.nom,' ',f.prenom) as NomPr  FROM filiere fi 
		inner join groupe g on g.CodeFlr=fi.CodeFlr 
        inner join emploireel e on e.CodeGrp=g.CodeGrp
        INNER JOIN Formateur f ON f.matricule=e.Matricule
        WHERE AnneeFr=anne AND e.CodeEtb=cdetab AND fi.CodeSect=secteur
        GROUP BY f.matricule;
END ;;
DELIMITER ;

DELIMITER ;;
CREATE PROCEDURE SP_GetGroupFormateurSecteur(mat varchar(50),cdetb varchar(50),an varchar(4),secteur varchar(50))
BEGIN
	SELECT DISTINCT af.Groupe FROM affectmodule  af
    INNER JOIN groupe g ON g.CodeGrp=af.Groupe
    INNER JOIN filiere f ON f.CodeFlr=g.CodeFlr
    WHERE  af.Matricule = mat AND af.CodeEtab = cdetb AND an = af.AnneeFr AND f.CodeSect=secteur;
END ;;
DELIMITER ;



