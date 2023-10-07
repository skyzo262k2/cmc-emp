DROP PROCEDURE SP_moduleNoaffeceted;
DELIMITER //
CREATE PROCEDURE SP_moduleNoaffeceted(codgrp varchar(25),anne_scolaire varchar(4),etab varchar(10),codflr varchar(25),anne_formation varchar(1))
BEGIN
	SELECT 
    m.*
FROM
    modules m
WHERE
    m.codemd NOT IN (SELECT 
            af.modulecode
        FROM
            affectmodule af
                INNER JOIN
            groupe g ON g.CodeGrp = af.Groupe
        WHERE
            g.CodeGrp = codgrp
                AND af.AnneeFr = anne_scolaire
                AND g.CodeEtab = etab)
                
        AND m.codeflr = codflr
        AND m.Annee = anne_formation;
END  //
DELIMITER ;
DROP PROCEDURE SP_ModuleAffecter_Formateur;
DELIMITER //
CREATE PROCEDURE SP_ModuleAffecter_Formateur(mat varchar(20),codetab varchar(10),anne varchar(4))
BEGIN
	SELECT 
     af.Groupe,m.descpMd,m.s1,m.s2,m.Pr,m.Dist,m.CodeMd,af.anneefr,m.codeflr,g.annee,af.avc,af.efm,(af.avc/(m.s1 + m.s2))*100 as taux
	FROM groupe g INNER JOIN affectmodule af ON af.Groupe=g.codegrp
	INNER JOIN modules m ON m.CodeMd = af.ModuleCode
	WHERE af.Matricule = mat AND af.CodeEtab = codetab
	AND af.AnneeFr = anne AND m.codeflr=g.codeflr;
END  //
DELIMITER ;

DROP PROCEDURE SP_ModuleAffecterByGroupeFormateurAnneeEtab;
DELIMITER //
CREATE  PROCEDURE SP_ModuleAffecterByGroupeFormateurAnneeEtab(mat varchar(25),annee varchar(10),etab varchar(15),grp varchar(25))
begin 
	select af.ModuleCode,m.DescpMd from modules m inner join 
    affectmodule af on m.CodeMd = af.ModuleCode
    inner join groupe g on af.groupe = g.Codegrp 
    where  af.matricule = mat and af.AnneeFr = annee and af.CodeEtab = etab and af.groupe = grp and m.CodeFlr = g.CodeFlr
    and af.ModuleCode not in (select distinct module from EFM 
    where matricule = mat and AnneeFr = annee and Etab = etab and groupe = grp);
end//
DELIMITER ;

DROP PROCEDURE SP_ModuleAffecter_Formateur;
DELIMITER //
CREATE PROCEDURE SP_ModuleAffecter_Formateur(mat varchar(20),codetab varchar(10),anne varchar(4))
BEGIN
	SELECT 
     af.Groupe,m.descpMd,m.s1,m.s2,m.Pr,m.Dist,m.CodeMd,af.anneefr,m.codeflr,g.Fpa,g.annee,af.avc,af.efm,(af.avc/(m.s1 + m.s2))*100 as taux
	FROM groupe g INNER JOIN affectmodule af ON af.Groupe=g.codegrp
	INNER JOIN modules m ON m.CodeMd = af.ModuleCode
	WHERE af.Matricule = mat AND af.CodeEtab = codetab
	AND af.AnneeFr = anne AND m.codeflr=g.codeflr;
END//
DELIMITER ;
