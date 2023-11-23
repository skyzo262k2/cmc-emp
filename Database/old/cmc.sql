-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: ista_db
-- ------------------------------------------------------
-- Server version	8.0.28
drop database cmc_ista;
create database cmc_ista;
use cmc_ista;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `absenceformateur`
--

DROP TABLE IF EXISTS `absenceformateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absenceformateur` (
  `Matricule` varchar(50) NOT NULL,
  `AnneFr` varchar(10) NOT NULL,
  `DateAbsenece` date NOT NULL,
  `Groupe` varchar(20) DEFAULT NULL,
  `Seance` int NOT NULL,
  `CodeModule` varchar(20) DEFAULT NULL,
  `Justify` varchar(10) DEFAULT NULL,
  `etab` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Matricule`,`AnneFr`,`DateAbsenece`,`Seance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absenceformateur`
--

LOCK TABLES `absenceformateur` WRITE;
/*!40000 ALTER TABLE `absenceformateur` DISABLE KEYS */;
/*!40000 ALTER TABLE `absenceformateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `absencestagiaire`
--

DROP TABLE IF EXISTS `absencestagiaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absencestagiaire` (
  `CEF` varchar(255) NOT NULL,
  `AnneFr` varchar(10) NOT NULL,
  `DateAbsenece` date NOT NULL,
  `Groupe` varchar(20) DEFAULT NULL,
  `Seance` int NOT NULL,
  `CodeModule` varchar(20) DEFAULT NULL,
  `Justify` varchar(10) DEFAULT NULL,
  `etab` varchar(20) DEFAULT NULL,
  `Type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`CEF`,`AnneFr`,`DateAbsenece`,`Seance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absencestagiaire`
--

LOCK TABLES `absencestagiaire` WRITE;
/*!40000 ALTER TABLE `absencestagiaire` DISABLE KEYS */;
/*!40000 ALTER TABLE `absencestagiaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `affectmodule`
--

DROP TABLE IF EXISTS `affectmodule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `affectmodule` (
  `Matricule` varchar(15) NOT NULL,
  `Groupe` varchar(15) NOT NULL,
  `ModuleCode` varchar(15) NOT NULL,
  `AnneeFr` varchar(15) NOT NULL,
  `CodeEtab` varchar(15) DEFAULT NULL,
  `GroupeDist` varchar(15) DEFAULT NULL,
  `avc` decimal(5,2) DEFAULT '0.00',
  `efm` varchar(1) DEFAULT 'N',
  PRIMARY KEY (`Matricule`,`Groupe`,`ModuleCode`,`AnneeFr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `affectmodule`
--

LOCK TABLES `affectmodule` WRITE;
/*!40000 ALTER TABLE `affectmodule` DISABLE KEYS */;
/*!40000 ALTER TABLE `affectmodule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `annee`
--

DROP TABLE IF EXISTS `annee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `annee` (
  `Annee` varchar(4) NOT NULL,
  PRIMARY KEY (`Annee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annee`
--

LOCK TABLES `annee` WRITE;
/*!40000 ALTER TABLE `annee` DISABLE KEYS */;
INSERT INTO `annee` VALUES ('2023');
/*!40000 ALTER TABLE `annee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avancement`
--

DROP TABLE IF EXISTS `avancement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avancement` (
  `DateAvc` date NOT NULL,
  `Matricule` varchar(15) NOT NULL,
  `CodeModule` varchar(15) NOT NULL,
  `grp` varchar(15) NOT NULL,
  `jour` varchar(10) DEFAULT NULL,
  `seance` varchar(15) NOT NULL,
  `AnneFr` varchar(15) NOT NULL,
  `CodeEtab` varchar(15) NOT NULL,
  PRIMARY KEY (`DateAvc`,`Matricule`,`CodeModule`,`grp`,`seance`,`AnneFr`,`CodeEtab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avancement`
--

LOCK TABLES `avancement` WRITE;
/*!40000 ALTER TABLE `avancement` DISABLE KEYS */;
/*!40000 ALTER TABLE `avancement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complexe`
--

DROP TABLE IF EXISTS `complexe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `complexe` (
  `CodeCpl` varchar(15) NOT NULL,
  `CodeDr` varchar(15) DEFAULT NULL,
  `DescpCpl` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CodeCpl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complexe`
--

LOCK TABLES `complexe` WRITE;
/*!40000 ALTER TABLE `complexe` DISABLE KEYS */;
INSERT INTO `complexe` VALUES ('CF','DRO','Complexe de formation du Nador'),('CFB','DRO','Complexe de formation du Berkane'),('CFT','DR','Complexe de formation du tanger');
/*!40000 ALTER TABLE `complexe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dr`
--

DROP TABLE IF EXISTS `dr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dr` (
  `CodeDr` varchar(15) NOT NULL,
  `DescpDr` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CodeDr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dr`
--

LOCK TABLES `dr` WRITE;
/*!40000 ALTER TABLE `dr` DISABLE KEYS */;
INSERT INTO `dr` VALUES ('DR','Direction regional du Nord','Nord'),('DRO','Direction regional de l\'oriental','oriental');
/*!40000 ALTER TABLE `dr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `efm`
--

DROP TABLE IF EXISTS `efm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `efm` (
  `id` int NOT NULL AUTO_INCREMENT,
  `matricule` varchar(15) DEFAULT NULL,
  `groupe` varchar(15) DEFAULT NULL,
  `module` varchar(15) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `Remarque` text,
  `DateEntre` date DEFAULT NULL,
  `DateValide` date DEFAULT NULL,
  `TypeEFM` varchar(20) DEFAULT NULL,
  `validateur` varchar(20) DEFAULT NULL,
  `CodeFlr` varchar(20) DEFAULT NULL,
  `AnneeFr` int DEFAULT NULL,
  `Etab` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `efm`
--

LOCK TABLES `efm` WRITE;
/*!40000 ALTER TABLE `efm` DISABLE KEYS */;
/*!40000 ALTER TABLE `efm` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `tr_before_delete_efm` BEFORE DELETE ON `efm` FOR EACH ROW BEGIN
	delete from examvalider where id_efm = old.id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `emploiarchive`
--

DROP TABLE IF EXISTS `emploiarchive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emploiarchive` (
  `CodeGrp` varchar(15) NOT NULL,
  `Jour` varchar(15) NOT NULL,
  `Seance` varchar(15) NOT NULL,
  `CodeModule` varchar(15) DEFAULT NULL,
  `Matricule` varchar(15) DEFAULT NULL,
  `CodeSl` varchar(15) DEFAULT NULL,
  `TypeSc` varchar(15) DEFAULT NULL,
  `CodeEtb` varchar(15) NOT NULL,
  `AnneeFr` varchar(15) NOT NULL,
  `Mois` varchar(2) NOT NULL,
  PRIMARY KEY (`CodeGrp`,`AnneeFr`,`Mois`,`Jour`,`Seance`,`CodeEtb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emploiarchive`
--

LOCK TABLES `emploiarchive` WRITE;
/*!40000 ALTER TABLE `emploiarchive` DISABLE KEYS */;
/*!40000 ALTER TABLE `emploiarchive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emploidraft`
--

DROP TABLE IF EXISTS `emploidraft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emploidraft` (
  `CodeGrp` varchar(15) NOT NULL,
  `Jour` varchar(15) NOT NULL,
  `Seance` varchar(15) NOT NULL,
  `CodeModule` varchar(15) DEFAULT NULL,
  `Matricule` varchar(15) DEFAULT NULL,
  `CodeSl` varchar(15) DEFAULT NULL,
  `TypeSc` varchar(15) DEFAULT NULL,
  `CodeEtb` varchar(15) NOT NULL,
  `AnneeFr` varchar(15) NOT NULL,
  PRIMARY KEY (`CodeGrp`,`Jour`,`Seance`,`CodeEtb`,`AnneeFr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emploidraft`
--

LOCK TABLES `emploidraft` WRITE;
/*!40000 ALTER TABLE `emploidraft` DISABLE KEYS */;
/*!40000 ALTER TABLE `emploidraft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emploireel`
--

DROP TABLE IF EXISTS `emploireel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emploireel` (
  `CodeGrp` varchar(15) NOT NULL,
  `Jour` varchar(15) NOT NULL,
  `Seance` varchar(15) NOT NULL,
  `CodeModule` varchar(15) DEFAULT NULL,
  `Matricule` varchar(15) DEFAULT NULL,
  `CodeSl` varchar(15) DEFAULT NULL,
  `TypeSc` varchar(15) DEFAULT NULL,
  `CodeEtb` varchar(15) NOT NULL,
  `AnneeFr` varchar(15) NOT NULL,
  PRIMARY KEY (`CodeGrp`,`AnneeFr`,`Jour`,`Seance`,`CodeEtb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emploireel`
--

LOCK TABLES `emploireel` WRITE;
/*!40000 ALTER TABLE `emploireel` DISABLE KEYS */;
/*!40000 ALTER TABLE `emploireel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etablissement` (
  `CodeEtb` varchar(15) NOT NULL,
  `CodeCpl` varchar(15) DEFAULT NULL,
  `Ville` varchar(30) DEFAULT NULL,
  `DescpFr` varchar(50) DEFAULT NULL,
  `DescpAr` varchar(50) DEFAULT NULL,
  `Sem_Annee` int DEFAULT NULL,
  PRIMARY KEY (`CodeEtb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etablissement`
--

LOCK TABLES `etablissement` WRITE;
/*!40000 ALTER TABLE `etablissement` DISABLE KEYS */;
INSERT INTO `etablissement` VALUES ('SBO0','CFB','Berkane','ISTA Berkane',NULL,25),('SNO0','CF','Nador','CMC Nador',NULL,35),('STO0','CFT','Tanger',' ISTA Tanger',NULL,25);
/*!40000 ALTER TABLE `etablissement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examvalider`
--

DROP TABLE IF EXISTS `examvalider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examvalider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_passation` varchar(3) DEFAULT NULL,
  `bareme` varchar(3) DEFAULT NULL,
  `salle_examen` varchar(3) DEFAULT NULL,
  `duree` varchar(3) DEFAULT NULL,
  `structure_examen` varchar(3) DEFAULT NULL,
  `degre_difficulte` varchar(3) DEFAULT NULL,
  `deux_variantes` varchar(3) DEFAULT NULL,
  `corrige_depose` varchar(3) DEFAULT NULL,
  `Decision` varchar(3) DEFAULT NULL,
  `id_efm` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examvalider`
--

LOCK TABLES `examvalider` WRITE;
/*!40000 ALTER TABLE `examvalider` DISABLE KEYS */;
/*!40000 ALTER TABLE `examvalider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filiere` (
  `CodeFlr` varchar(20) NOT NULL,
  `DescpFlr` varchar(100) DEFAULT NULL,
  `CodeSect` varchar(15) NOT NULL,
  `Niveau` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`CodeFlr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filiere`
--

LOCK TABLES `filiere` WRITE;
/*!40000 ALTER TABLE `filiere` DISABLE KEYS */;
INSERT INTO `filiere` VALUES ('AGC_C_BP','Bac Pro option commerce','GC','T'),('AGC_COMPT_BP','Bac Pro option comptabilité','GC','T'),('BP_TCPS_BP','Tronc commun professionnel service','GC','T'),('BTP_B_T','Bâtiment','BTP','T'),('BTP_BOP_T','Bâtiment option Projeteur','BTP','T'),('DIA_DEV_TS','Développement Digital','DIA','TS'),('DIA_DEVOWFS_TS','Développement Digital option Web Full Stack','DIA','TS'),('DIA_ID_TS','Infrastructure Digitale','DIA','TS'),('DIA_IDOSR_TS','Infrastructure Digitale option Systèmes et Réseaux','DIA','TS'),('FGT_AEFGT_Q','Agent d\'Entretien en Froid et Génie Thermique','FGT','Q'),('FGT_AEFGTOF_Q','Agent d\'Entretien en Froid et Génie Thermique option Frigoriste','FGT','Q'),('FGT_FCC_T','Froid Commercial et Climatisation','FGT','T'),('GC_AA_T','Assistant Administratif','GC','T'),('GC_AAOC_T','Assistant Administratif option Commerce','GC','T'),('GC_AAOCP_T','Assistant Administratif option Comptabilité','GC','T'),('GC_AAOG_T','Assistant Administratif option Gestion','GC','T'),('GC_GE_TS','Gestion des Entreprises','GC','TS'),('GC_GE_TS_RCDS','Gestion des Entreprises','GC','TS'),('GC_GEOCF_TS','Gestion des Entreprises option Comptabilité et Finance','GC','TS'),('GC_GEOCM_TS','Gestion des Entreprises option Commerce et Marketing','GC','TS'),('GC_GEOOM_TS','Gestion des Entreprises option Office Manager','GC','TS'),('GC_GEORH_TS','Gestion des Entreprises option Ressources Humaines','GC','TS'),('GC_PIE_FQ','Programme d\'Innovation Entrepreneuriale : de l\'idée au projet viable','GC','FQ'),('GE_EI_T','Electricité Industrielle','GE','T'),('GE_ESA_TS','Electromécanique des Systèmes Automatisés','GE','TS'),('GE_OQE_Q','Ouvrier Qualifié en électricité','GE','Q'),('GE_OQEOEE_Q','Ouvrier Qualifié en électricité option Entretien Electrique','GE','Q'),('GE_OQEOEM_Q','Ouvrier Qualifié en électricité option Electromécanique','GE','Q'),('GE_OQOIE_Q','Ouvrier Qualifié en électricité option Installation Electrique','GE','Q'),('GM_GM_TS','Génie Mécanique','GM','TS'),('GM_GMOEMFM_TS','Génie Mécanique option Etudes et Méthodes en Fabrication Mécanique','GM','TS'),('GM_MGP_Q','Mécanicien Général Polyvalent','GM','Q'),('THR_AC_T','Arts culinaires','THR','T'),('THR_ACOCG_T','Arts culinaires option Cuisine Gastronomique','THR','T'),('THR_ACOPC_T','Arts culinaires option Pâtisserie-Chocolaterie','THR','T'),('THR_ART_Q','Agent de Restauration','THR','Q'),('THR_MT_TS','Management Touristique','THR','TS'),('THR_MTOETA_TS','Management Touristique option E-Travel Agency','THR','TS');
/*!40000 ALTER TABLE `filiere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formateur`
--

DROP TABLE IF EXISTS `formateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formateur` (
  `Matricule` varchar(15) NOT NULL,
  `Nom` varchar(25) DEFAULT NULL,
  `Prenom` varchar(25) DEFAULT NULL,
  `CodeEtab` varchar(25) NOT NULL,
  `Type` varchar(25) DEFAULT NULL,
  `MassHoraire` decimal(8,2) DEFAULT NULL,
  `Mdp` varchar(150) DEFAULT 'dev2020',
  `secteur` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Matricule`,`CodeEtab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formateur`
--

LOCK TABLES `formateur` WRITE;
/*!40000 ALTER TABLE `formateur` DISABLE KEYS */;
/*!40000 ALTER TABLE `formateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groupe` (
  `CodeGrp` varchar(15) NOT NULL,
  `CodeFlr` varchar(15) DEFAULT NULL,
  `CodeEtab` varchar(15) NOT NULL,
  `Annee` varchar(15) DEFAULT NULL,
  `Fpa` varchar(1) DEFAULT NULL,
  `taux` int DEFAULT NULL,
  PRIMARY KEY (`CodeGrp`,`CodeEtab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupe`
--

LOCK TABLES `groupe` WRITE;
/*!40000 ALTER TABLE `groupe` DISABLE KEYS */;
INSERT INTO `groupe` VALUES ('AA101','GC_AA_T','SNO0','1','N',100),('AA102','GC_AA_T','SNO0','1','N',100),('AA103','GC_AA_T','SNO0','1','N',100),('AAOC201','GC_AAOC_T','SNO0','2','N',100),('AAOC301','GC_AAOC_T','SNO0','3','N',100),('AAOCCP301','GC_AAOCP_T','SNO0','3','N',100),('AAOCCP302','GC_AAOCP_T','SNO0','3','N',100),('AAOCP201','GC_AAOCP_T','SNO0','2','N',100),('AAOG201','GC_AAOG_T','SNO0','2','N',100),('AAOG301','GC_AAOG_T','SNO0','3','N',100),('AC101','THR_AC_T','SNO0','1','O',60),('AC102','THR_AC_T','SNO0','1','O',60),('ACOCG201','THR_ACOCG_T','SNO0','2','O',60),('ACOCG202','THR_ACOCG_T','SNO0','2','O',60),('ACOCG301','THR_ACOCG_T','SNO0','3','O',60),('ACOCG302','THR_ACOCG_T','SNO0','3','O',60),('ACOPC201','THR_ACOPC_T','SNO0','2','O',60),('ACOPC202','THR_ACOPC_T','SNO0','2','O',60),('ACOPC301','THR_ACOPC_T','SNO0','3','O',60),('ACOPC302','THR_ACOPC_T','SNO0','3','O',60),('AEFGT101','FGT_AEFGT_Q','SNO0','1','N',100),('AEFGT102','FGT_AEFGT_Q','SNO0','1','N',100),('AEFGTOF201','FGT_AEFGTOF_Q','SNO0','2','N',100),('AR101','THR_ART_Q','SNO0','1','N',100),('AR102','THR_ART_Q','SNO0','1','N',100),('AR103','THR_ART_Q','SNO0','1','N',100),('AR104','THR_ART_Q','SNO0','1','N',100),('AR105','THR_ART_Q','SNO0','1','N',100),('ART201','THR_ART_Q','SNO0','2','N',100),('ART202','THR_ART_Q','SNO0','2','N',100),('B101','BTP_B_T','SNO0','1','O',60),('BOP201','BTP_BOP_T','SNO0','2','O',60),('BP_TCPS101','BP_TCPS_BP','SNO0','1','N',100),('BP_TCPS102','BP_TCPS_BP','SNO0','1','N',100),('BPCM201','AGC_C_BP','SNO0','2','N',100),('BPCM301','AGC_C_BP','SNO0','3','N',100),('BPCOMP201','AGC_COMPT_BP','SNO0','2','N',100),('BPCOMP202','AGC_COMPT_BP','SNO0','2','N',100),('BPCOMP203','AGC_COMPT_BP','SNO0','2','N',100),('BPCOMP301','AGC_COMPT_BP','SNO0','3','N',100),('BPCOMP302','AGC_COMPT_BP','SNO0','3','N',100),('DEV101','DIA_DEV_TS','SNO0','1','N',100),('DEV102','DIA_DEV_TS','SNO0','1','N',100),('DEV103','DIA_DEV_TS','SNO0','1','N',100),('DEVOWFS201','DIA_DEVOWFS_TS','SNO0','2','N',100),('DEVOWFS202','DIA_DEVOWFS_TS','SNO0','2','N',100),('EI101','GE_EI_T','SNO0','1','N',100),('EI102','GE_EI_T','SNO0','1','N',100),('EI201','GE_EI_T','SNO0','2','N',100),('EI202','GE_EI_T','SNO0','2','N',100),('ESA101','GE_ESA_TS','SNO0','1','N',100),('ESA102','GE_ESA_TS','SNO0','1','N',100),('ESA201','GE_ESA_TS','SNO0','2','N',100),('ESA202','GE_ESA_TS','SNO0','2','N',100),('GE101','GC_GE_TS','SNO0','1','N',100),('GE102','GC_GE_TS','SNO0','1','N',100),('GE103','GC_GE_TS','SNO0','1','N',100),('GE104','GC_GE_TS','SNO0','1','N',100),('GEOCF201','GC_GEOCF_TS','SNO0','2','N',100),('GEOCF301','GC_GEOCF_TS','SNO0','3','N',100),('GEOCF302','GC_GEOCF_TS','SNO0','3','N',100),('GEOCF303','GC_GEOCF_TS','SNO0','3','N',100),('GEOCM201','GC_GEOCM_TS','SNO0','2','N',100),('GEOCM301','GC_GEOCM_TS','SNO0','3','N',100),('GEOCM302','GC_GEOCM_TS','SNO0','3','N',100),('GEOCM303','GC_GEOCM_TS','SNO0','3','N',100),('GEOOM201','GC_GEOOM_TS','SNO0','2','N',100),('GEOOM301','GC_GEOOM_TS','SNO0','3','N',100),('GEORH201','GC_GEORH_TS','SNO0','2','N',100),('GEORH301','GC_GEORH_TS','SNO0','3','N',100),('GEORH302','GC_GEORH_TS','SNO0','3','N',100),('GM101','GM_GM_TS','SNO0','1','N',100),('GMOEMFM201','GM_GMOEMFM_TS','SNO0','2','N',100),('ID101','DIA_ID_TS','SNO0','1','N',100),('ID102','DIA_ID_TS','SNO0','1','N',100),('IDOSR201','DIA_IDOSR_TS','SNO0','2','N',100),('IDOSR202','DIA_IDOSR_TS','SNO0','2','N',100),('MGP101','GM_MGP_Q','SNO0','1','N',100),('MGP201','GM_MGP_Q','SNO0','2','N',100),('MT101','THR_MT_TS','SNO0','1','N',100),('MT102','THR_MT_TS','SNO0','1','N',100),('MTOETA201','THR_MTOETA_TS','SNO0','2','N',100),('MTOETA301','THR_MTOETA_TS','SNO0','3','N',100),('MTOETA302','THR_MTOETA_TS','SNO0','3','N',100),('OQE101','GE_OQE_Q','SNO0','1','N',100),('OQE102','GE_OQE_Q','SNO0','1','N',100),('OQE103','GE_OQE_Q','SNO0','1','N',100),('OQE104','GE_OQE_Q','SNO0','1','N',100),('OQE105','GE_OQE_Q','SNO0','1','N',100),('OQE106','GE_OQE_Q','SNO0','1','N',100),('OQE107','GE_OQE_Q','SNO0','1','N',100),('OQEOEE201','GE_OQEOEE_Q','SNO0','2','N',100),('OQEOEE202','GE_OQEOEE_Q','SNO0','2','N',100),('OQEOEM201','GE_OQEOEM_Q','SNO0','2','O',60),('OQEOEM202','GE_OQEOEM_Q','SNO0','2','O',60),('OQOIE201','GE_OQOIE_Q','SNO0','2','N',100),('PIE101','GC_PIE_FQ','SNO0','1','N',100),('TFCC101','FGT_FCC_T','SNO0','1','N',100),('TSGE CS 101','GC_GE_TS_RCDS','SNO0','1','N',100),('TSGE CS 301','GC_GE_TS_RCDS','SNO0','3','N',100);
/*!40000 ALTER TABLE `groupe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modules` (
  `CodeMd` varchar(15) NOT NULL,
  `CodeFlr` varchar(20) NOT NULL,
  `Annee` varchar(20) NOT NULL,
  `DescpMd` varchar(150) DEFAULT NULL,
  `Pr` decimal(5,2) DEFAULT NULL,
  `Dist` decimal(5,2) DEFAULT NULL,
  `s1` decimal(5,2) DEFAULT NULL,
  `s2` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`CodeMd`,`CodeFlr`,`Annee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES ('EGQ101','FGT_AEFGT_Q','1','Arabe',15.00,15.00,15.00,15.00),('EGQ101','GE_OQE_Q','1','Arabe',15.00,15.00,15.00,15.00),('EGQ101','GM_MGP_Q','1','Arabe',15.00,15.00,15.00,15.00),('EGQ101','THR_ART_Q','1','Arabe',15.00,15.00,15.00,15.00),('EGQ102','FGT_AEFGT_Q','1','Français',50.00,45.00,50.00,45.00),('EGQ102','GE_OQE_Q','1','Français',50.00,45.00,50.00,45.00),('EGQ102','GM_MGP_Q','1','Français',50.00,45.00,50.00,45.00),('EGQ102','THR_ART_Q','1','Français',50.00,45.00,50.00,45.00),('EGQ103','FGT_AEFGT_Q','1','Anglais  (notions de base)',20.00,20.00,20.00,20.00),('EGQ103','GE_OQE_Q','1','Anglais  (notions de base)',20.00,20.00,20.00,20.00),('EGQ103','GM_MGP_Q','1','Anglais  (notions de base)',20.00,20.00,20.00,20.00),('EGQ103','THR_ART_Q','1','Anglais  (notions de base)',20.00,20.00,20.00,20.00),('EGQ105','FGT_AEFGT_Q','1','Compétences comportementales',35.00,25.00,35.00,25.00),('EGQ105','GE_OQE_Q','1','Compétences comportementales',35.00,25.00,35.00,25.00),('EGQ105','GM_MGP_Q','1','Compétences comportementales',35.00,25.00,35.00,25.00),('EGQ105','THR_ART_Q','1','Compétences comportementales',35.00,25.00,35.00,25.00),('EGQ107','FGT_AEFGT_Q','1','Sport',20.00,0.00,20.00,0.00),('EGQ107','GE_OQE_Q','1','Sport',20.00,0.00,20.00,0.00),('EGQ107','GM_MGP_Q','1','Sport',20.00,0.00,20.00,0.00),('EGQ107','THR_ART_Q','1','Sport',20.00,0.00,20.00,0.00),('EGQ108','FGT_AEFGT_Q','1','Entrepreneuriat-PIE 1',0.00,27.50,0.00,27.50),('EGQ108','GE_OQE_Q','1','Entrepreneuriat-PIE 1',0.00,27.50,0.00,27.50),('EGQ108','GM_MGP_Q','1','Entrepreneuriat-PIE 1',0.00,27.50,0.00,27.50),('EGQ108','THR_ART_Q','1','Entrepreneuriat-PIE 1',0.00,27.50,0.00,27.50),('EGQ202','FGT_AEFGTOF_Q','2','Français',50.00,45.00,50.00,45.00),('EGQ202','GE_OQEOEE_Q','2','Français',50.00,45.00,50.00,45.00),('EGQ202','GE_OQEOEM_Q','2','Français',50.00,45.00,50.00,45.00),('EGQ202','GE_OQOIE_Q','2','Français',50.00,45.00,50.00,45.00),('EGQ202','GM_MGP_Q','2','Français',50.00,45.00,50.00,45.00),('EGQ202','THR_ART_Q','2','Français',50.00,45.00,50.00,45.00),('EGQ203','FGT_AEFGTOF_Q','2','Anglais  (notions de base)',15.00,15.00,15.00,15.00),('EGQ203','GE_OQEOEE_Q','2','Anglais  (notions de base)',15.00,15.00,15.00,15.00),('EGQ203','GE_OQEOEM_Q','2','Anglais  (notions de base)',15.00,15.00,15.00,15.00),('EGQ203','GE_OQOIE_Q','2','Anglais  (notions de base)',15.00,15.00,15.00,15.00),('EGQ203','GM_MGP_Q','2','Anglais  (notions de base)',15.00,15.00,15.00,15.00),('EGQ203','THR_ART_Q','2','Anglais  (notions de base)',15.00,15.00,15.00,15.00),('EGQ205','FGT_AEFGTOF_Q','2','Compétences comportementales',20.00,20.00,20.00,20.00),('EGQ205','GE_OQEOEE_Q','2','Compétences comportementales',20.00,20.00,20.00,20.00),('EGQ205','GE_OQEOEM_Q','2','Compétences comportementales',20.00,20.00,20.00,20.00),('EGQ205','GE_OQOIE_Q','2','Compétences comportementales',20.00,20.00,20.00,20.00),('EGQ205','GM_MGP_Q','2','Compétences comportementales',20.00,20.00,20.00,20.00),('EGQ205','THR_ART_Q','2','Compétences comportementales',20.00,20.00,20.00,20.00),('EGQB106','FGT_AEFGT_Q','1','Culture et techniques de base du numérique',0.00,25.00,0.00,25.00),('EGQB106','GE_OQE_Q','1','Culture et techniques de base du numérique',0.00,25.00,0.00,25.00),('EGQB106','GM_MGP_Q','1','Culture et techniques de base du numérique',0.00,25.00,0.00,25.00),('EGQB106','THR_ART_Q','1','Culture et techniques de base du numérique',0.00,25.00,0.00,25.00),('EGQB206','FGT_AEFGTOF_Q','2','Culture et techniques de base du numérique',25.00,0.00,25.00,0.00),('EGQB206','GE_OQEOEE_Q','2','Culture et techniques de base du numérique',25.00,0.00,25.00,0.00),('EGQB206','GE_OQEOEM_Q','2','Culture et techniques de base du numérique',25.00,0.00,25.00,0.00),('EGQB206','GE_OQOIE_Q','2','Culture et techniques de base du numérique',25.00,0.00,25.00,0.00),('EGQB206','GM_MGP_Q','2','Culture et techniques de base du numérique',25.00,0.00,25.00,0.00),('EGQB206','THR_ART_Q','2','Culture et techniques de base du numérique',25.00,0.00,25.00,0.00),('EGT101','BTP_B_T','1','Arabe',20.00,0.00,20.00,0.00),('EGT101','FGT_FCC_T','1','Arabe',20.00,0.00,20.00,0.00),('EGT101','GC_AA_T','1','Arabe',20.00,0.00,20.00,0.00),('EGT101','GE_EI_T','1','Arabe',20.00,0.00,20.00,0.00),('EGT101','THR_AC_T','1','Arabe',20.00,0.00,20.00,0.00),('EGT102','BTP_B_T','1','Français',35.00,30.00,35.00,30.00),('EGT102','FGT_FCC_T','1','Français',35.00,30.00,35.00,30.00),('EGT102','GC_AA_T','1','Français',35.00,30.00,35.00,30.00),('EGT102','GE_EI_T','1','Français',35.00,30.00,35.00,30.00),('EGT102','THR_AC_T','1','Français',35.00,30.00,35.00,30.00),('EGT103','BTP_B_T','1','Anglais technique',20.00,20.00,20.00,20.00),('EGT103','FGT_FCC_T','1','Anglais technique',20.00,20.00,20.00,20.00),('EGT103','GC_AA_T','1','Anglais technique',20.00,20.00,20.00,20.00),('EGT103','GE_EI_T','1','Anglais technique',20.00,20.00,20.00,20.00),('EGT103','THR_AC_T','1','Anglais technique',20.00,20.00,20.00,20.00),('EGT105','BTP_B_T','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT105','FGT_FCC_T','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT105','GC_AA_T','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT105','GE_EI_T','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT105','THR_AC_T','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT108','BTP_B_T','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGT108','FGT_FCC_T','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGT108','GC_AA_T','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGT108','GE_EI_T','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGT108','THR_AC_T','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGT202','BTP_BOP_T','2','Français',35.00,30.00,35.00,30.00),('EGT202','GC_AAOC_T','2','Français',35.00,30.00,35.00,30.00),('EGT202','GC_AAOCP_T','2','Français',35.00,30.00,35.00,30.00),('EGT202','GC_AAOG_T','2','Français',35.00,30.00,35.00,30.00),('EGT202','GE_EI_T','2','Français',35.00,30.00,35.00,30.00),('EGT202','THR_ACOCG_T','2','Français',35.00,30.00,35.00,30.00),('EGT202','THR_ACOPC_T','2','Français',35.00,30.00,35.00,30.00),('EGT203','BTP_BOP_T','2','Anglais technique',20.00,20.00,20.00,20.00),('EGT203','GC_AAOC_T','2','Anglais technique',20.00,20.00,20.00,20.00),('EGT203','GC_AAOCP_T','2','Anglais technique',20.00,20.00,20.00,20.00),('EGT203','GC_AAOG_T','2','Anglais technique',20.00,20.00,20.00,20.00),('EGT203','GE_EI_T','2','Anglais technique',20.00,20.00,20.00,20.00),('EGT203','THR_ACOCG_T','2','Anglais technique',20.00,20.00,20.00,20.00),('EGT203','THR_ACOPC_T','2','Anglais technique',20.00,20.00,20.00,20.00),('EGT205','BTP_BOP_T','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT205','GC_AAOC_T','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT205','GC_AAOCP_T','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT205','GC_AAOG_T','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT205','GE_EI_T','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT205','THR_ACOCG_T','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT205','THR_ACOPC_T','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGT302','GC_AAOC_T','3','Français',40.00,0.00,40.00,0.00),('EGT302','GC_AAOCP_T','3','Français',40.00,0.00,40.00,0.00),('EGT302','GC_AAOG_T','3','Français',40.00,0.00,40.00,0.00),('EGT302','THR_ACOCG_T','3','Français',40.00,0.00,40.00,0.00),('EGT302','THR_ACOPC_T','3','Français',40.00,0.00,40.00,0.00),('EGT303','GC_AAOC_T','3','Anglais technique',30.00,0.00,30.00,0.00),('EGT303','GC_AAOCP_T','3','Anglais technique',30.00,0.00,30.00,0.00),('EGT303','GC_AAOG_T','3','Anglais technique',30.00,0.00,30.00,0.00),('EGT303','THR_ACOCG_T','3','Anglais technique',30.00,0.00,30.00,0.00),('EGT303','THR_ACOPC_T','3','Anglais technique',30.00,0.00,30.00,0.00),('EGT305','GC_AAOC_T','3','Compétences comportementales',20.00,0.00,20.00,0.00),('EGT305','GC_AAOCP_T','3','Compétences comportementales',20.00,0.00,20.00,0.00),('EGT305','GC_AAOG_T','3','Compétences comportementales',20.00,0.00,20.00,0.00),('EGT305','THR_ACOCG_T','3','Compétences comportementales',20.00,0.00,20.00,0.00),('EGT305','THR_ACOPC_T','3','Compétences comportementales',20.00,0.00,20.00,0.00),('EGTA106','GC_AA_T','1','Culture et techniques avancées du numérique',40.00,0.00,40.00,0.00),('EGTA206','GC_AAOC_T','2','Culture et techniques avancées du numérique',30.00,0.00,30.00,0.00),('EGTA206','GC_AAOCP_T','2','Culture et techniques avancées du numérique',30.00,0.00,30.00,0.00),('EGTA206','GC_AAOG_T','2','Culture et techniques avancées du numérique',30.00,0.00,30.00,0.00),('EGTI106','BTP_B_T','1','Culture et techniques intermédiaires du numérique',40.00,0.00,40.00,0.00),('EGTI106','FGT_FCC_T','1','Culture et techniques intermédiaires du numérique',40.00,0.00,40.00,0.00),('EGTI106','GE_EI_T','1','Culture et techniques intermédiaires du numérique',40.00,0.00,40.00,0.00),('EGTI106','THR_AC_T','1','Culture et techniques intermédiaires du numérique',40.00,0.00,40.00,0.00),('EGTI206','BTP_BOP_T','2','Culture et techniques intermédiaires du numérique',30.00,0.00,30.00,0.00),('EGTI206','GE_EI_T','2','Culture et techniques intermédiaires du numérique',30.00,0.00,30.00,0.00),('EGTI206','THR_ACOCG_T','2','Culture et techniques intermédiaires du numérique',30.00,0.00,30.00,0.00),('EGTI206','THR_ACOPC_T','2','Culture et techniques intermédiaires du numérique',30.00,0.00,30.00,0.00),('EGTS101','DIA_DEV_TS','1','Arabe',20.00,0.00,20.00,0.00),('EGTS101','DIA_ID_TS','1','Arabe',20.00,0.00,20.00,0.00),('EGTS101','GC_GE_TS','1','Arabe',20.00,0.00,20.00,0.00),('EGTS101','GC_GE_TS_RCDS','1','Arabe',0.00,7.50,0.00,7.50),('EGTS101','GE_ESA_TS','1','Arabe',20.00,0.00,20.00,0.00),('EGTS101','GM_GM_TS','1','Arabe',20.00,0.00,20.00,0.00),('EGTS101','THR_MT_TS','1','Arabe',20.00,0.00,20.00,0.00),('EGTS102','DIA_DEV_TS','1','Français',35.00,30.00,35.00,30.00),('EGTS102','DIA_ID_TS','1','Français',35.00,30.00,35.00,30.00),('EGTS102','GC_GE_TS','1','Français',35.00,30.00,35.00,30.00),('EGTS102','GC_GE_TS_RCDS','1','Français',10.00,10.00,10.00,10.00),('EGTS102','GE_ESA_TS','1','Français',35.00,30.00,35.00,30.00),('EGTS102','GM_GM_TS','1','Français',35.00,30.00,35.00,30.00),('EGTS102','THR_MT_TS','1','Français',35.00,30.00,35.00,30.00),('EGTS103','DIA_DEV_TS','1','Anglais technique',20.00,20.00,20.00,20.00),('EGTS103','DIA_ID_TS','1','Anglais technique',20.00,20.00,20.00,20.00),('EGTS103','GC_GE_TS','1','Anglais technique',20.00,20.00,20.00,20.00),('EGTS103','GC_GE_TS_RCDS','1','Anglais technique',10.00,10.00,10.00,10.00),('EGTS103','GE_ESA_TS','1','Anglais technique',20.00,20.00,20.00,20.00),('EGTS103','GM_GM_TS','1','Anglais technique',20.00,20.00,20.00,20.00),('EGTS103','THR_MT_TS','1','Anglais technique',20.00,20.00,20.00,20.00),('EGTS105','DIA_DEV_TS','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS105','DIA_ID_TS','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS105','GC_GE_TS','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS105','GC_GE_TS_RCDS','1','Compétences comportementales',10.00,10.00,10.00,10.00),('EGTS105','GE_ESA_TS','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS105','GM_GM_TS','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS105','THR_MT_TS','1','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS108','DIA_DEV_TS','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGTS108','DIA_ID_TS','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGTS108','GC_GE_TS','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGTS108','GE_ESA_TS','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGTS108','GM_GM_TS','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGTS108','THR_MT_TS','1','Entrepreneuriat-PIE 1',40.00,32.00,40.00,32.00),('EGTS202','DIA_DEVOWFS_TS','2','Français',35.00,30.00,35.00,30.00),('EGTS202','DIA_IDOSR_TS','2','Français',35.00,30.00,35.00,30.00),('EGTS202','GC_GEOCF_TS','2','Français',35.00,30.00,35.00,30.00),('EGTS202','GC_GEOCM_TS','2','Français',35.00,30.00,35.00,30.00),('EGTS202','GC_GEOOM_TS','2','Français',35.00,30.00,35.00,30.00),('EGTS202','GC_GEORH_TS','2','Français',35.00,30.00,35.00,30.00),('EGTS202','GE_ESA_TS','2','Français',35.00,30.00,35.00,30.00),('EGTS202','GM_GMOEMFM_TS','2','Français',35.00,30.00,35.00,30.00),('EGTS202','THR_MTOETA_TS','2','Français',35.00,30.00,35.00,30.00),('EGTS203','DIA_DEVOWFS_TS','2','Anglais technique',20.00,20.00,20.00,20.00),('EGTS203','DIA_IDOSR_TS','2','Anglais technique',20.00,20.00,20.00,20.00),('EGTS203','GC_GEOCF_TS','2','Anglais technique',20.00,20.00,20.00,20.00),('EGTS203','GC_GEOCM_TS','2','Anglais technique',20.00,20.00,20.00,20.00),('EGTS203','GC_GEOOM_TS','2','Anglais technique',20.00,20.00,20.00,20.00),('EGTS203','GC_GEORH_TS','2','Anglais technique',20.00,20.00,20.00,20.00),('EGTS203','GE_ESA_TS','2','Anglais technique',20.00,20.00,20.00,20.00),('EGTS203','GM_GMOEMFM_TS','2','Anglais technique',20.00,20.00,20.00,20.00),('EGTS203','THR_MTOETA_TS','2','Anglais technique',20.00,20.00,20.00,20.00),('EGTS205','DIA_DEVOWFS_TS','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS205','DIA_IDOSR_TS','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS205','GC_GEOCF_TS','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS205','GC_GEOCM_TS','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS205','GC_GEOOM_TS','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS205','GC_GEORH_TS','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS205','GE_ESA_TS','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS205','GM_GMOEMFM_TS','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS205','THR_MTOETA_TS','2','Compétences comportementales',15.00,15.00,15.00,15.00),('EGTS302','GC_GE_TS_RCDS','3','Français',15.00,15.00,15.00,15.00),('EGTS302','GC_GEOCF_TS','3','Français',40.00,0.00,40.00,0.00),('EGTS302','GC_GEOCM_TS','3','Français',40.00,0.00,40.00,0.00),('EGTS302','GC_GEOOM_TS','3','Français',40.00,0.00,40.00,0.00),('EGTS302','GC_GEORH_TS','3','Français',40.00,0.00,40.00,0.00),('EGTS302','THR_MTOETA_TS','3','Français',40.00,0.00,40.00,0.00),('EGTS303','GC_GE_TS_RCDS','3','Anglais technique',10.00,10.00,10.00,10.00),('EGTS303','GC_GEOCF_TS','3','Anglais technique',30.00,0.00,30.00,0.00),('EGTS303','GC_GEOCM_TS','3','Anglais technique',30.00,0.00,30.00,0.00),('EGTS303','GC_GEOOM_TS','3','Anglais technique',30.00,0.00,30.00,0.00),('EGTS303','GC_GEORH_TS','3','Anglais technique',30.00,0.00,30.00,0.00),('EGTS303','THR_MTOETA_TS','3','Anglais technique',30.00,0.00,30.00,0.00),('EGTS305','GC_GE_TS_RCDS','3','Compétences comportementales',10.00,10.00,10.00,10.00),('EGTS305','GC_GEOCF_TS','3','Compétences comportementales',20.00,0.00,20.00,0.00),('EGTS305','GC_GEOCM_TS','3','Compétences comportementales',20.00,0.00,20.00,0.00),('EGTS305','GC_GEOOM_TS','3','Compétences comportementales',20.00,0.00,20.00,0.00),('EGTS305','GC_GEORH_TS','3','Compétences comportementales',20.00,0.00,20.00,0.00),('EGTS305','THR_MTOETA_TS','3','Compétences comportementales',20.00,0.00,20.00,0.00),('EGTSA106','DIA_DEV_TS','1','Culture et techniques avancées du numérique',40.00,0.00,40.00,0.00),('EGTSA106','DIA_ID_TS','1','Culture et techniques avancées du numérique',40.00,0.00,40.00,0.00),('EGTSA106','GC_GE_TS','1','Culture et techniques avancées du numérique',40.00,0.00,40.00,0.00),('EGTSA206','DIA_DEVOWFS_TS','2','Culture et techniques avancées du numérique',30.00,0.00,30.00,0.00),('EGTSA206','DIA_IDOSR_TS','2','Culture et techniques avancées du numérique',30.00,0.00,30.00,0.00),('EGTSA206','GC_GEOCF_TS','2','Culture et techniques avancées du numérique',30.00,0.00,30.00,0.00),('EGTSA206','GC_GEOCM_TS','2','Culture et techniques avancées du numérique',30.00,0.00,30.00,0.00),('EGTSA206','GC_GEOOM_TS','2','Culture et techniques avancées du numérique',30.00,0.00,30.00,0.00),('EGTSA206','GC_GEORH_TS','2','Culture et techniques avancées du numérique',30.00,0.00,30.00,0.00),('EGTSI106','GC_GE_TS_RCDS','1','Culture et techniques intermédiaires du numérique',7.50,7.50,7.50,7.50),('EGTSI106','GE_ESA_TS','1','Culture et techniques intermédiaires du numérique',40.00,0.00,40.00,0.00),('EGTSI106','GM_GM_TS','1','Culture et techniques intermédiaires du numérique',40.00,0.00,40.00,0.00),('EGTSI106','THR_MT_TS','1','Culture et techniques intermédiaires du numérique',40.00,0.00,40.00,0.00),('EGTSI206','GE_ESA_TS','2','Culture et techniques intermédiaires du numérique',30.00,0.00,30.00,0.00),('EGTSI206','GM_GMOEMFM_TS','2','Culture et techniques intermédiaires du numérique',30.00,0.00,30.00,0.00),('EGTSI206','THR_MTOETA_TS','2','Culture et techniques intermédiaires du numérique',30.00,0.00,30.00,0.00),('M101','BP_TCPS_BP','1','Environnement et organisation de l’entreprise',50.00,50.00,50.00,50.00),('M101','BTP_B_T','1','Metier et formation',30.00,0.00,30.00,0.00),('M101','DIA_DEV_TS','1','Métier et formation en développement digital',15.00,0.00,15.00,0.00),('M101','DIA_ID_TS','1','Métier et formation en infrastructure digital',15.00,0.00,15.00,0.00),('M101','FGT_AEFGT_Q','1','Métier et formation dans le secteur Froid et climatisation',15.00,0.00,15.00,0.00),('M101','FGT_FCC_T','1','Métier et formation dans le secteur Froid et climatisation',12.50,0.00,12.50,0.00),('M101','GC_AA_T','1','Métiers et formation dans le secteur GC',30.00,0.00,30.00,0.00),('M101','GC_GE_TS','1','Métier et formation',30.00,0.00,30.00,0.00),('M101','GC_GE_TS_RCDS','1','Métier et formation dans le secteur AGC',5.00,0.00,5.00,0.00),('M101','GC_PIE_FQ','1','Innovation et service client',27.50,0.00,27.50,0.00),('M101','GE_EI_T','1','Métier et formation',30.00,0.00,30.00,0.00),('M101','GE_ESA_TS','1','Métier et formation',15.00,0.00,15.00,0.00),('M101','GE_OQE_Q','1','Se situer au regard du métier et de la démarche de formation',30.00,0.00,30.00,0.00),('M101','GM_GM_TS','1','Métier et Formation',15.00,0.00,15.00,0.00),('M101','GM_MGP_Q','1','Hygiène et sécurité au travail en fabrication Mécanique',15.00,0.00,15.00,0.00),('M101','THR_AC_T','1','Se situer au regard du métier et de la démarche de formation',45.00,0.00,45.00,0.00),('M101','THR_ART_Q','1','Métier et formation',25.00,0.00,25.00,0.00),('M101','THR_MT_TS','1','Se situer au regard du métier et de la démarche de formation',45.00,0.00,45.00,0.00),('M102','BP_TCPS_BP','1','Les techniques quantitatives de gestion',40.00,40.00,40.00,40.00),('M102','BTP_B_T','1','modes opératoires',75.00,0.00,75.00,0.00),('M102','DIA_DEV_TS','1','Les bases de l\'algorithmique',110.00,0.00,110.00,0.00),('M102','DIA_ID_TS','1','Les enjeux d\'un système d\'information ',47.50,20.00,47.50,20.00),('M102','FGT_AEFGT_Q','1','Sante et securite au travail',22.50,0.00,22.50,0.00),('M102','FGT_FCC_T','1','Etude thermodynamique des machines frigorifiques',40.00,0.00,40.00,0.00),('M102','GC_AA_T','1','Introduction au droit',60.00,0.00,60.00,0.00),('M102','GC_GE_TS','1','Droit fondamental',60.00,0.00,60.00,0.00),('M102','GC_GE_TS_RCDS','1','Bureautique',0.00,20.00,0.00,20.00),('M102','GC_PIE_FQ','1','Business design',27.50,0.00,27.50,0.00),('M102','GE_EI_T','1','Le secteur électrique dans tous ses états et perspectives d\'évolution',30.00,0.00,30.00,0.00),('M102','GE_ESA_TS','1','Interprétation de plans, de schémas et de devis',30.00,0.00,30.00,0.00),('M102','GE_OQE_Q','1','Appliquer les règles de l\'hygiène, de sécurité au travail et de protection de l’environnement',45.00,0.00,45.00,0.00),('M102','GM_GM_TS','1','Interprétation de plans',140.00,0.00,140.00,0.00),('M102','GM_MGP_Q','1','Fabrication des pièces d’usinage simples en tournage',75.00,45.00,75.00,45.00),('M102','THR_AC_T','1','Maintenir un environnement de travail salubre et sécuritaire',45.00,0.00,45.00,0.00),('M102','THR_ART_Q','1','Hygiène et sécurité alimentaire',30.00,0.00,30.00,0.00),('M102','THR_MT_TS','1','Management des risques dans les circuits et séjours touristiques',30.00,0.00,30.00,0.00),('M103','BTP_B_T','1','Lecture des plans et dessin à main levée',75.00,0.00,75.00,0.00),('M103','DIA_DEV_TS','1','Programmation Orienté Objet',110.00,0.00,110.00,0.00),('M103','DIA_ID_TS','1','Conception d\'un réseau informatique ',112.50,0.00,112.50,0.00),('M103','FGT_AEFGT_Q','1','Electricité Générale',67.50,0.00,67.50,0.00),('M103','FGT_FCC_T','1','Hygiène et sécurité dans le secteur industriel',12.50,0.00,12.50,0.00),('M103','GC_AA_T','1','Entreprise et son environnement',70.00,0.00,70.00,0.00),('M103','GC_GE_TS','1','Management des organisations',75.00,0.00,75.00,0.00),('M103','GC_GE_TS_RCDS','1','L\'entreprise et son environnement',40.00,0.00,40.00,0.00),('M103','GC_PIE_FQ','1','Compétences business',0.00,25.00,0.00,25.00),('M103','GE_EI_T','1','Hygiène, Sécurité et Environnement',30.00,0.00,30.00,0.00),('M103','GE_ESA_TS','1','Hygiène, Sécurité et Environnement',30.00,0.00,30.00,0.00),('M103','GE_OQE_Q','1','Vérifier des circuits électriques à c.c. et c.a.',90.00,0.00,90.00,0.00),('M103','GM_GM_TS','1','Matériaux & traitements thermiques',30.00,0.00,30.00,0.00),('M103','GM_MGP_Q','1','Fabrication des pièces d’usinage simples en fraisage',50.00,70.00,50.00,70.00),('M103','THR_AC_T','1','Effectuer les calculs mathèmatiques de base',30.00,0.00,30.00,0.00),('M103','THR_ART_Q','1','Environnement professionnel',25.00,0.00,25.00,0.00),('M103','THR_MT_TS','1','Effectuer des calculs mathématiques de base',30.00,0.00,30.00,0.00),('M104','BTP_B_T','1','Matériaux de construction',45.00,0.00,45.00,0.00),('M104','DIA_DEV_TS','1','Sites Web statiques',105.00,0.00,105.00,0.00),('M104','DIA_ID_TS','1','Fonctionnement du système d\'exploitation ',122.50,0.00,122.50,0.00),('M104','FGT_AEFGT_Q','1','Thermodynamique Appliquée',35.00,0.00,35.00,0.00),('M104','FGT_FCC_T','1','Technique de brasage, soudage et d’oxycoupage',35.00,0.00,35.00,0.00),('M104','GC_AA_T','1','Comptabilité Générale : concepts de base et opérations courantes',130.00,0.00,130.00,0.00),('M104','GC_GE_TS','1','Comptabilité générale 1',135.00,0.00,135.00,0.00),('M104','GC_GE_TS_RCDS','1','Statistiques',20.00,0.00,20.00,0.00),('M104','GE_EI_T','1','Réalisation des croquis et des schémas',60.00,0.00,60.00,0.00),('M104','GE_ESA_TS','1','Analyse de circuits à c.c.',60.00,0.00,60.00,0.00),('M104','GE_OQE_Q','1','Représenter des pièces et des ensembles simples en dessin industriel',60.00,0.00,60.00,0.00),('M104','GM_GM_TS','1','Hygiène, Sécurité et Environnement',15.00,0.00,15.00,0.00),('M104','GM_MGP_Q','1','Métrologie dimensionnelle et géométrique',30.00,0.00,30.00,0.00),('M104','THR_AC_T','1','Utiliser l\'équipement de cuisine',45.00,0.00,45.00,0.00),('M104','THR_ART_Q','1','Mise en place',45.00,0.00,45.00,0.00),('M104','THR_MT_TS','1','Exploiter des notions relatives à la réglementation juridique',30.00,0.00,30.00,0.00),('M105','BTP_B_T','1','Topographie de base',0.00,60.00,0.00,60.00),('M105','DIA_DEV_TS','1','Programmation JavaScript',0.00,105.00,0.00,105.00),('M105','DIA_ID_TS','1','Gestion de l\'infrastructure virtualisée ',27.50,82.50,27.50,82.50),('M105','FGT_AEFGT_Q','1','Instrumentation et Outillage',35.00,0.00,35.00,0.00),('M105','FGT_FCC_T','1','Mécanique d\'entretien',30.00,0.00,30.00,0.00),('M105','GC_AA_T','1','Techniques d’accueil',30.00,0.00,30.00,0.00),('M105','GC_GE_TS','1','Gestion électronique des données',40.00,0.00,40.00,0.00),('M105','GC_GE_TS_RCDS','1','Comptabilité générale : les concepts de base',50.00,0.00,50.00,0.00),('M105','GE_EI_T','1','Analyse des circuits à courant continu et courant alternatif',90.00,0.00,90.00,0.00),('M105','GE_ESA_TS','1','Analyse de circuits à c.a.',60.00,0.00,60.00,0.00),('M105','GE_OQE_Q','1','Utiliser les outils de l’électricien et le matériel de manutention pour installer des câbles électriques et des canalisations',55.00,35.00,55.00,35.00),('M105','GM_GM_TS','1','Fabrication Mécanique',45.00,45.00,45.00,45.00),('M105','GM_MGP_Q','1','Travaux d’établi et réalisation d’opérations de perçage et de taraudage',60.00,0.00,60.00,0.00),('M105','THR_AC_T','1','Évaluer les qualités organoleptiques des aliments',45.00,0.00,45.00,0.00),('M105','THR_ART_Q','1','Réceptionner les denrées',40.00,0.00,40.00,0.00),('M105','THR_MT_TS','1','Établir des relations professionnelles en tourisme',45.00,0.00,45.00,0.00),('M106','BTP_B_T','1','réglementation urbaine',45.00,0.00,45.00,0.00),('M106','DIA_DEV_TS','1','Manipulation des bases de données',0.00,95.00,0.00,95.00),('M106','DIA_ID_TS','1','Automatisation des tâches d\'administration',0.00,110.00,0.00,110.00),('M106','FGT_AEFGT_Q','1','Technique de Soudo-Brasage',75.00,0.00,75.00,0.00),('M106','FGT_FCC_T','1','Lecture et interprétation de dessins techniques en froid',30.00,0.00,30.00,0.00),('M106','GC_AA_T','1','Gestion documentaire',0.00,50.00,0.00,50.00),('M106','GC_GE_TS','1','Marketing',0.00,90.00,0.00,90.00),('M106','GC_GE_TS_RCDS','1','Comptabilité générale : les opérations courantes',0.00,62.50,0.00,62.50),('M106','GE_EI_T','1','Travaux d’usinage manuel',45.00,0.00,45.00,0.00),('M106','GE_ESA_TS','1','Installation de canalisations électriques',50.00,0.00,50.00,0.00),('M106','GE_OQE_Q','1','Effectuer des opérations d’usinage manuel',0.00,75.00,0.00,75.00),('M106','GM_GM_TS','1','Construction Métallique',45.00,45.00,45.00,45.00),('M106','GM_MGP_Q','1','Lecture et interprétation des documents de fabrication',0.00,45.00,0.00,45.00),('M106','THR_AC_T','1','Effectuer des activités liées à l\'organisation d\'une cuisine',45.00,0.00,45.00,0.00),('M106','THR_ART_Q','1','Préparations fondamentales',50.00,0.00,50.00,0.00),('M106','THR_MT_TS','1','Appliquer des notions de comptabilité générale',65.00,0.00,65.00,0.00),('M107','BTP_B_T','1','Démarches QHSE',30.00,0.00,30.00,0.00),('M107','DIA_DEV_TS','1','Sites Web dynamiques',0.00,110.00,0.00,110.00),('M107','DIA_ID_TS','1','Sécurité des systèmes d\'information',0.00,67.50,0.00,67.50),('M107','FGT_AEFGT_Q','1','Travail de Tuyauterie',55.00,45.00,55.00,45.00),('M107','FGT_FCC_T','1','Froid ménager et froid pour collectivité',83.00,40.00,83.00,40.00),('M107','GC_AA_T','1','Techniques Quantitative de Gestion',0.00,90.00,0.00,90.00),('M107','GC_GE_TS','1','Comptabilité générale 2',0.00,70.00,0.00,70.00),('M107','GE_EI_T','1','Installation et le raccordement de tableaux de distribution basse tension et des circuits de dérivation',50.00,40.00,50.00,40.00),('M107','GE_ESA_TS','1','Oxycoupage et soudage à l\'arc électrique',45.00,0.00,45.00,0.00),('M107','GE_OQE_Q','1','Vérifier le fonctionnement des circuits électroniques de base',0.00,75.00,0.00,75.00),('M107','GM_GM_TS','1','Conception Assistée par Ordinateur',20.00,65.00,20.00,65.00),('M107','GM_MGP_Q','1','Représentation de pièces mécaniques en dessin industriel',50.00,25.00,50.00,25.00),('M107','THR_AC_T','1','Rechercher et échanger de l\'information',45.00,0.00,45.00,0.00),('M107','THR_ART_Q','1','Accueil et vente en salle',30.00,0.00,30.00,0.00),('M107','THR_MT_TS','1','Établir des liens entre les activités du secteur touristique et le développement économique',30.00,0.00,30.00,0.00),('M108','BTP_B_T','1','Techniques de réalisation des projets de batiments',0.00,60.00,0.00,60.00),('M108','DIA_DEV_TS','1','Sécurité des systèmes d\'information',0.00,40.00,0.00,40.00),('M108','DIA_ID_TS','1','Processus et outils de veille technologique',0.00,42.50,0.00,42.50),('M108','FGT_AEFGT_Q','1','Installation Frigorifique Simple',0.00,100.00,0.00,100.00),('M108','FGT_FCC_T','1','Fluide frigorigène et récupération des réfrigérants',25.00,0.00,25.00,0.00),('M108','GC_AA_T','1','Marketing fondamental',0.00,90.00,0.00,90.00),('M108','GC_GE_TS','1','Ecrits professionnels',0.00,60.00,0.00,60.00),('M108','GE_EI_T','1','Entretien des dispositifs de transmission de mouvement',0.00,45.00,0.00,45.00),('M108','GE_ESA_TS','1','Gestion de la maintenance',30.00,0.00,30.00,0.00),('M108','GE_OQE_Q','1','Se familiariser avec les notions d\'efficacité énergétique et les notions de base sur la qualité',0.00,75.00,0.00,75.00),('M108','GM_GM_TS','1','Mécanique appliqué et Résistance des Matériaux',25.00,45.00,25.00,45.00),('M108','GM_MGP_Q','1','Assemblage d’éléments mécaniques',0.00,30.00,0.00,30.00),('M108','THR_AC_T','1','Se situer au regard du tourisme durable',0.00,45.00,0.00,45.00),('M108','THR_ART_Q','1','Techniques de cuisson',55.00,0.00,55.00,0.00),('M108','THR_MT_TS','1','Se situer au regard du tourisme durable',45.00,0.00,45.00,0.00),('M109','BTP_B_T','1','les calculs simples',30.00,0.00,30.00,0.00),('M109','FGT_AEFGT_Q','1','Technique de câblage',0.00,95.00,0.00,95.00),('M109','FGT_FCC_T','1','Montage des circuits frigorifiques simples',0.00,125.00,0.00,125.00),('M109','GC_AA_T','1','Ecrits professionnels',0.00,60.00,0.00,60.00),('M109','GC_GE_TS','1','Statistique',0.00,80.00,0.00,80.00),('M109','GE_EI_T','1','Installation et raccordement des transformateurs, des machines rotatives et leurs circuits de commande',0.00,90.00,0.00,90.00),('M109','GE_ESA_TS','1','Analyse de circuits à semi-conducteurs',15.00,60.00,15.00,60.00),('M109','GM_GM_TS','1','Qualité, Production et Maintenance',0.00,40.00,0.00,40.00),('M109','GM_MGP_Q','1','Définition d\'un mode opératoire',15.00,20.00,15.00,20.00),('M109','THR_AC_T','1','Associer des techniques de cuisson classiques à la préparation des aliments',0.00,30.00,0.00,30.00),('M109','THR_ART_Q','1','TIC Restaurant',0.00,45.00,0.00,45.00),('M109','THR_MT_TS','1','Analyser l\'industrie touristique marocaine',0.00,35.00,0.00,35.00),('M110','BTP_B_T','1','Economie de construction (métré + étude de prix)',30.00,60.00,30.00,60.00),('M110','FGT_AEFGT_Q','1','Lire et interpréter un plan de synthèse',0.00,50.00,0.00,50.00),('M110','FGT_FCC_T','1','Réglage et mise au point des détendeurs',0.00,30.00,0.00,30.00),('M110','GC_AA_T','1','Logiciel comptable et commercial',0.00,60.00,0.00,60.00),('M110','GC_GE_TS','1','Logiciel de Gestion Commerciale, Comptable',0.00,60.00,0.00,60.00),('M110','GE_EI_T','1','Assemblage des composants d’une armoire électrique industrielle',0.00,60.00,0.00,60.00),('M110','GE_ESA_TS','1','Analyse de circuits pneumatiques',0.00,60.00,0.00,60.00),('M110','GM_GM_TS','1','Technologie de soudage',0.00,40.00,0.00,40.00),('M110','GM_MGP_Q','1','Résolution des calculs professionnels simples',20.00,25.00,20.00,25.00),('M110','THR_AC_T','1','Réaliser des préparations fondamentales',0.00,45.00,0.00,45.00),('M110','THR_ART_Q','1','TIC Cuisine',0.00,45.00,0.00,45.00),('M110','THR_MT_TS','1','Analyser le potentiel touristique des régions du monde',0.00,45.00,0.00,45.00),('M111','BTP_B_T','1','RDM',0.00,75.00,0.00,75.00),('M111','FGT_FCC_T','1','Condenseurs et évaporateurs',0.00,30.00,0.00,30.00),('M111','GE_EI_T','1','Analyse des circuits électronique analogique',0.00,75.00,0.00,75.00),('M111','GE_ESA_TS','1','Usinage manuel',0.00,45.00,0.00,45.00),('M111','GM_GM_TS','1','Processus de Fabrication',0.00,90.00,0.00,90.00),('M111','GM_MGP_Q','1','Technologie professionnelle',30.00,50.00,30.00,50.00),('M111','THR_AC_T','1','Apprêter les fruits et légumes',0.00,45.00,0.00,45.00),('M111','THR_ART_Q','1','Patrimoine Culinaire marocain',0.00,40.00,0.00,40.00),('M111','THR_MT_TS','1','Appliquer les règles de l\'étiquette en tourisme',0.00,30.00,0.00,30.00),('M112','BTP_B_T','1','CAO/DAO',0.00,90.00,0.00,90.00),('M112','FGT_FCC_T','1','Electricité générale',45.00,0.00,45.00,0.00),('M112','GE_EI_T','1','Montage des circuits pneumatiques et électropneumatiques',0.00,60.00,0.00,60.00),('M112','GE_ESA_TS','1','Usinage sur machines outils',0.00,50.00,0.00,50.00),('M112','GM_MGP_Q','1','Entretien de premier niveau de son poste de travail',0.00,15.00,0.00,15.00),('M112','THR_AC_T','1','Etablir des relations professionnelles',0.00,45.00,0.00,45.00),('M112','THR_MT_TS','1','Exploiter divers moyens d\'information, de relations publiques et de publicité',0.00,60.00,0.00,60.00),('M113','FGT_FCC_T','1','Compresseurs frigorifiques',0.00,30.00,0.00,30.00),('M113','GE_ESA_TS','1','Sensibilisation à la qualité',0.00,20.00,0.00,20.00),('M113','THR_AC_T','1','Effectuer la mise en place et la confection des pâtes de base et des desserts',0.00,60.00,0.00,60.00),('M113','THR_MT_TS','1','Effectuer des activités de gestion du personnel',0.00,60.00,0.00,60.00),('M114','FGT_FCC_T','1','Circuit moteur et dispoisitive de commande électrique',0.00,30.00,0.00,30.00),('M114','GE_ESA_TS','1','Dépannage de circuits électroniques de puissance',0.00,60.00,0.00,60.00),('M114','THR_MT_TS','1','Exploiter les outils du marketing du tourisme',0.00,75.00,0.00,75.00),('M115','FGT_FCC_T','1','Schémas application frigorifique',0.00,32.50,0.00,32.50),('M115','GE_ESA_TS','1','Alignement conventionnel',0.00,30.00,0.00,30.00),('M116','FGT_FCC_T','1','Electronique de base',0.00,35.00,0.00,35.00),('M116','GE_ESA_TS','1','Montage et ajustement d\'arbres, de roulements et de coussinets',0.00,45.00,0.00,45.00),('M201','AGC_C_BP','2','Marketing',0.00,120.00,0.00,120.00),('M201','AGC_COMPT_BP','2','Les opérations courantes',165.00,0.00,165.00,0.00),('M201','BTP_BOP_T','2','Dimensionnement des éléments simples de structure béton armé',70.00,0.00,70.00,0.00),('M201','DIA_DEVOWFS_TS','2','Préparation d\'un projet web',60.00,0.00,60.00,0.00),('M201','DIA_IDOSR_TS','2','Mise en place d’une infrastructure réseaux',120.00,0.00,120.00,0.00),('M201','FGT_AEFGTOF_Q','2','Fluides frigorigènes : Types et modes de manipulation',90.00,0.00,90.00,0.00),('M201','GC_AAOC_T','2','Bureautique',50.00,0.00,50.00,0.00),('M201','GC_AAOCP_T','2','Droit de travail',60.00,0.00,60.00,0.00),('M201','GC_AAOG_T','2','Droit de travail',60.00,0.00,60.00,0.00),('M201','GC_GEOCF_TS','2','Pratique de la paie',60.00,0.00,60.00,0.00),('M201','GC_GEOCM_TS','2','Bureautique',50.00,0.00,50.00,0.00),('M201','GC_GEOOM_TS','2','Techniques de résolution des problèmes',40.00,0.00,40.00,0.00),('M201','GC_GEORH_TS','2','Droit social',75.00,0.00,75.00,0.00),('M201','GE_EI_T','2','Monter des circuits hydrauliques et électrohydrauliques',60.00,0.00,60.00,0.00),('M201','GE_ESA_TS','2','Logique combinatoire',45.00,0.00,45.00,0.00),('M201','GE_OQEOEE_Q','2','Se familiariser avec les notions de maintenance préventive et prévisionnelle de l’équipement industriel',30.00,0.00,30.00,0.00),('M201','GE_OQEOEM_Q','2','Se familiariser avec les notions de maintenance préventive et prévisionnelle de l’équipement industriel',30.00,0.00,30.00,0.00),('M201','GE_OQOIE_Q','2','Réaliser des installations électriques dans un bâtiment résidentiel et tertiaire',135.00,0.00,135.00,0.00),('M201','GM_GMOEMFM_TS','2','Conception des systèmes mécaniques',100.00,70.00,100.00,70.00),('M201','GM_MGP_Q','2','Réglage et conduite d’une production de série',20.00,20.00,20.00,20.00),('M201','THR_ACOCG_T','2','Effectuer la mise en place et la confection de potages',45.00,0.00,45.00,0.00),('M201','THR_ACOPC_T','2','Confesctionner des pains classiques et spéciaux',60.00,0.00,60.00,0.00),('M201','THR_ART_Q','2','Mise en place et production en cuisine',120.00,0.00,120.00,0.00),('M201','THR_MTOETA_TS','2','Métier et formation',30.00,0.00,30.00,0.00),('M202','AGC_C_BP','2','Techniques de vente',120.00,0.00,120.00,0.00),('M202','AGC_COMPT_BP','2','Gestion des documents',66.00,0.00,66.00,0.00),('M202','BTP_BOP_T','2','Processus de conception architecturale',60.00,0.00,60.00,0.00),('M202','DIA_DEVOWFS_TS','2','Approche agile',100.00,0.00,100.00,0.00),('M202','DIA_IDOSR_TS','2','Administration d\'un environnement Windows',105.00,0.00,105.00,0.00),('M202','FGT_AEFGTOF_Q','2','Schémas frigorifiques',65.00,0.00,65.00,0.00),('M202','GC_AAOC_T','2','Techniques de vente et négociation',90.00,0.00,90.00,0.00),('M202','GC_AAOCP_T','2','Comptabilité générale : Travaux de fin d\'exercice',90.00,0.00,90.00,0.00),('M202','GC_AAOG_T','2','Comptabilité générale :Travaux de fin d\'exercice',90.00,0.00,90.00,0.00),('M202','GC_GEOCF_TS','2','Contrôle de gestion - Comptabilité analytique d\'exploitation',80.00,0.00,80.00,0.00),('M202','GC_GEOCM_TS','2','Droit du travail',40.00,0.00,40.00,0.00),('M202','GC_GEOOM_TS','2','Gestion de temps',40.00,0.00,40.00,0.00),('M202','GC_GEORH_TS','2','Gestion administative du personnel',90.00,0.00,90.00,0.00),('M202','GE_EI_T','2','Vérifier le fonctionnement des circuits d’électronique numérique',75.00,0.00,75.00,0.00),('M202','GE_ESA_TS','2','Logique séquentielle',45.00,0.00,45.00,0.00),('M202','GE_OQEOEE_Q','2','Effectuer l’installation et l’entretien d\'un système d’éclairage',75.00,0.00,75.00,0.00),('M202','GE_OQEOEM_Q','2','Monter, ajuster et aligner des systèmes mécaniques',60.00,0.00,60.00,0.00),('M202','GE_OQOIE_Q','2','Installer des systèmes d\'alarme incendie et intrusion et de contrôle d’accès',105.00,0.00,105.00,0.00),('M202','GM_GMOEMFM_TS','2','Usinage sur MOCN',40.00,0.00,40.00,0.00),('M202','GM_MGP_Q','2','Réalisation d’opérations de rectification',68.00,0.00,68.00,0.00),('M202','THR_ACOCG_T','2','Effectuer la mise en place et la confection de viandes, de volailles et de gibiers',80.00,0.00,80.00,0.00),('M202','THR_ACOPC_T','2','Confectionner des crèmes garnitures spécifiques',30.00,0.00,30.00,0.00),('M202','THR_ART_Q','2','Service des mets et des boissons',120.00,0.00,120.00,0.00),('M202','THR_MTOETA_TS','2','Gérer  l\'interculturalité en tourisme',30.00,0.00,30.00,0.00),('M203','AGC_C_BP','2','Prospection de la clientèle',74.00,0.00,74.00,0.00),('M203','AGC_COMPT_BP','2','Mathématiques financières',0.00,66.00,0.00,66.00),('M203','BTP_BOP_T','2','Etudes techniques de faisabilité et conception',30.00,0.00,30.00,0.00),('M203','DIA_DEVOWFS_TS','2','Gestion des données',100.00,0.00,100.00,0.00),('M203','DIA_IDOSR_TS','2','Administration d\'un environnement Linux',105.00,0.00,105.00,0.00),('M203','FGT_AEFGTOF_Q','2','Technologie et installation des équipements en froid commercial et domestique',90.00,0.00,90.00,0.00),('M203','GC_AAOC_T','2','Droit Commercial',50.00,0.00,50.00,0.00),('M203','GC_AAOCP_T','2','Mathématiques financières',60.00,0.00,60.00,0.00),('M203','GC_AAOG_T','2','Gestion des agendas',40.00,0.00,40.00,0.00),('M203','GC_GEOCF_TS','2','Mathématiques financières',70.00,0.00,70.00,0.00),('M203','GC_GEOCM_TS','2','Droit commercial',50.00,0.00,50.00,0.00),('M203','GC_GEOOM_TS','2','Droit des affaires',70.00,0.00,70.00,0.00),('M203','GC_GEORH_TS','2','Pratique de la paie',60.00,0.00,60.00,0.00),('M203','GE_EI_T','2','Programmer un automate',75.00,0.00,75.00,0.00),('M203','GE_ESA_TS','2','Installation et réparation de moteurs et de génératrices à c. c.',50.00,0.00,50.00,0.00),('M203','GE_OQEOEE_Q','2','Réaliser et câbler des tableaux électriques',60.00,0.00,60.00,0.00),('M203','GE_OQEOEM_Q','2','Réaliser et câbler des tableaux électriques',60.00,0.00,60.00,0.00),('M203','GE_OQOIE_Q','2','Installer des circuits de la domotique filaire et sans fil',60.00,0.00,60.00,0.00),('M203','GM_GMOEMFM_TS','2','Dossier de fabrication - FAO',70.00,70.00,70.00,70.00),('M203','GM_MGP_Q','2','Usinage complexe',150.00,127.00,150.00,127.00),('M203','THR_ACOCG_T','2','Effectuer la mise en place et la confection de poissons, de mollusques et de crustacés',80.00,0.00,80.00,0.00),('M203','THR_ACOPC_T','2','Confectionner des bouchers à partir des biscuits et des supports comestibles',60.00,0.00,60.00,0.00),('M203','THR_ART_Q','2','Notions de base en pâtisserie',80.00,0.00,80.00,0.00),('M203','THR_MTOETA_TS','2','Exploiter un GDS dans la vente de produit touristique',90.00,0.00,90.00,0.00),('M204','AGC_C_BP','2','Documents et Calculs commerciaux',0.00,60.00,0.00,60.00),('M204','AGC_COMPT_BP','2','Administration du personnel',0.00,66.00,0.00,66.00),('M204','BTP_BOP_T','2','Etude de prix',60.00,0.00,60.00,0.00),('M204','DIA_DEVOWFS_TS','2','Développement front-end',100.00,0.00,100.00,0.00),('M204','DIA_IDOSR_TS','2','Enjeux de la technologie SDN',45.00,0.00,45.00,0.00),('M204','FGT_AEFGTOF_Q','2','Systèmes frigorifiques à eau glacée',90.00,0.00,90.00,0.00),('M204','GC_AAOC_T','2','Droit du Travail',50.00,0.00,50.00,0.00),('M204','GC_AAOCP_T','2','Gestion de la paie',60.00,0.00,60.00,0.00),('M204','GC_AAOG_T','2','Gestion administrative du personnel',60.00,0.00,60.00,0.00),('M204','GC_GEOCF_TS','2','Droit des affaires',60.00,0.00,60.00,0.00),('M204','GC_GEOCM_TS','2','Marketing digital',60.00,0.00,60.00,0.00),('M204','GC_GEOOM_TS','2','Organisation et planification des activités',60.00,0.00,60.00,0.00),('M204','GC_GEORH_TS','2','Gestion financière',90.00,0.00,90.00,0.00),('M204','GE_EI_T','2','Dépanner un système automatisé',90.00,0.00,90.00,0.00),('M204','GE_ESA_TS','2','Accessoires de transmission et de transformation du mouvement',30.00,0.00,30.00,0.00),('M204','GE_OQEOEE_Q','2','Monter de circuits pneumatiques',75.00,0.00,75.00,0.00),('M204','GE_OQEOEM_Q','2','Effectuer l’installation et la maintenance des équipements pneumatiques, de pompes à vide, de moteurs pneumatiques et de compresseurs',105.00,0.00,105.00,0.00),('M204','GE_OQOIE_Q','2','Installer des systèmes des appels malades',45.00,0.00,45.00,0.00),('M204','GM_GMOEMFM_TS','2','Conception d\'outillage de production',34.00,42.00,34.00,42.00),('M204','GM_MGP_Q','2','Réalisation d’ensemble mécanique composé de pièces polyvalentes',90.00,40.00,90.00,40.00),('M204','THR_ACOCG_T','2','Effectuer la mise en place et la confection d’entremets gastronomiques',45.00,0.00,45.00,0.00),('M204','THR_ACOPC_T','2','Confectionner des bouchées à base de chocolat',60.00,0.00,60.00,0.00),('M204','THR_ART_Q','2','Facturation et encaissement',0.00,30.00,0.00,30.00),('M204','THR_MTOETA_TS','2','Valoriser les potentialités touristiques d\'un territoire',70.00,0.00,70.00,0.00),('M205','AGC_C_BP','2','Merchandising',120.00,0.00,120.00,0.00),('M205','AGC_COMPT_BP','2','Droit commercial',66.00,0.00,66.00,0.00),('M205','BTP_BOP_T','2','Contrôles, relevés et vérifications en phase conception et réalisation',45.00,0.00,45.00,0.00),('M205','DIA_DEVOWFS_TS','2','Développement back-end',25.00,95.00,25.00,95.00),('M205','DIA_IDOSR_TS','2','Administration d\'un environnement Cloud',0.00,75.00,0.00,75.00),('M205','FGT_AEFGTOF_Q','2','régulation des systèmes frigorifiques',0.00,60.00,0.00,60.00),('M205','GC_AAOC_T','2','Marketing approfondi',80.00,0.00,80.00,0.00),('M205','GC_AAOCP_T','2','Bureautique avancée',60.00,0.00,60.00,0.00),('M205','GC_AAOG_T','2','Techniques de prise de notes',40.00,0.00,40.00,0.00),('M205','GC_GEOCF_TS','2','Bureautique avancée',60.00,0.00,60.00,0.00),('M205','GC_GEOCM_TS','2','Techniques de vente et de négociation',80.00,0.00,80.00,0.00),('M205','GC_GEOOM_TS','2','Gestion administrative du personnel',60.00,0.00,60.00,0.00),('M205','GC_GEORH_TS','2','Bureautique avancée',0.00,60.00,0.00,60.00),('M205','GE_EI_T','2','Modifier l’installation ou le fonctionnement d’un équipement électrique industriel',55.00,5.00,55.00,5.00),('M205','GE_ESA_TS','2','Installation et réparation de moteurs et de génératrices à c. a.',80.00,0.00,80.00,0.00),('M205','GE_OQEOEE_Q','2','Effectuer l’installation et la maintenance des machines électriques tournantes et de transformateurs triphasés',112.50,37.50,112.50,37.50),('M205','GE_OQEOEM_Q','2','Effectuer l’installation et la maintenance des machines électriques tournantes et statiques',97.50,7.50,97.50,7.50),('M205','GE_OQOIE_Q','2','Installer des gaines techniques de logement',7.50,52.50,7.50,52.50),('M205','GM_GMOEMFM_TS','2','Elaboration de gamme de montage',45.00,0.00,45.00,0.00),('M205','GM_MGP_Q','2','Fabrication d’une pièce de rénovation en mécanique générale',0.00,100.00,0.00,100.00),('M205','THR_ACOCG_T','2','Effectuer la mise en place et la confection de hors d’œuvres, d’entrées, de salades et de canapés',45.00,0.00,45.00,0.00),('M205','THR_ACOPC_T','2','Confectionner des décors et pièces de présentation en chocolat',75.00,0.00,75.00,0.00),('M205','THR_ART_Q','2','Restauration et événementiel',0.00,60.00,0.00,60.00),('M205','THR_MTOETA_TS','2','Concevoir des produits touristiques loisirs /MICE',80.00,0.00,80.00,0.00),('M206','AGC_C_BP','2','Introduction au Droit Commercial',0.00,120.00,0.00,120.00),('M206','AGC_COMPT_BP','2','Les travaux de fin d’exercice',0.00,165.00,0.00,165.00),('M206','BTP_BOP_T','2','BIM - modélisation des éléments d’un projet de conception',75.00,0.00,75.00,0.00),('M206','DIA_DEVOWFS_TS','2','Création d\'une application Cloud native',0.00,90.00,0.00,90.00),('M206','DIA_IDOSR_TS','2','Sécurité d\'une infrastrcutre digitale',0.00,60.00,0.00,60.00),('M206','FGT_AEFGTOF_Q','2','Montage et mise en service des chambres froides',0.00,70.00,0.00,70.00),('M206','GC_AAOC_T','2','Approvisionnements',0.00,60.00,0.00,60.00),('M206','GC_AAOCP_T','2','Comptabilité analytique',0.00,90.00,0.00,90.00),('M206','GC_AAOG_T','2','Bureautique avancée',0.00,90.00,0.00,90.00),('M206','GC_GEOCF_TS','2','Comptabilité approfondie',0.00,140.00,0.00,140.00),('M206','GC_GEOCM_TS','2','E-commerce',40.00,0.00,40.00,0.00),('M206','GC_GEOOM_TS','2','Techniques d\'accueil',40.00,0.00,40.00,0.00),('M206','GC_GEORH_TS','2','GRH',0.00,120.00,0.00,120.00),('M206','GE_EI_T','2','Effectuer les opérations de maintenance corrective',0.00,60.00,0.00,60.00),('M206','GE_ESA_TS','2','Transmissions mécaniques',30.00,0.00,30.00,0.00),('M206','GE_OQEOEE_Q','2','Effectuer l’installation et l’entretien de système d\'alarme incendie, système anti vol et de surveillance vidéo',0.00,60.00,0.00,60.00),('M206','GE_OQEOEM_Q','2','Entretenir et réparer des éléments et des dispositifs de transmission et de transformation du mouvement',0.00,60.00,0.00,60.00),('M206','GE_OQOIE_Q','2','Installer des systèmes des énergies renouvelables',0.00,90.00,0.00,90.00),('M206','GM_GMOEMFM_TS','2','Amélioration et optimisation de la productivité des processus de fabrication',54.00,30.00,54.00,30.00),('M206','GM_MGP_Q','2','Technologie des outillages de presses',50.00,0.00,50.00,0.00),('M206','THR_ACOCG_T','2','Effectuer la mise en place et la confection de plats à base de produits régionaux',0.00,80.00,0.00,80.00),('M206','THR_ACOPC_T','2','Confectionner des pâtisseries et des desserts marocains',0.00,75.00,0.00,75.00),('M206','THR_ART_Q','2','Approche client',0.00,45.00,0.00,45.00),('M206','THR_MTOETA_TS','2','Exploiter différents outils dans la cotation des produits touristiques',0.00,75.00,0.00,75.00),('M207','AGC_C_BP','2','Télévente',40.00,0.00,40.00,0.00),('M207','BTP_BOP_T','2','Etablissement des plans de définition, d\'exécution et de détails',0.00,90.00,0.00,90.00),('M207','DIA_DEVOWFS_TS','2','Projet de synthèse',0.00,60.00,0.00,60.00),('M207','DIA_IDOSR_TS','2','Gestion d\'un projet d\'infrastruture digitale',0.00,45.00,0.00,45.00),('M207','FGT_AEFGTOF_Q','2','Entretien et maintenance des équipements frigorifiques',0.00,60.00,0.00,60.00),('M207','GC_AAOC_T','2','Gestion et animation du point de Vente',0.00,80.00,0.00,80.00),('M207','GC_AAOCP_T','2','Fiscalité de l\'entreprise',0.00,90.00,0.00,90.00),('M207','GC_AAOG_T','2','Comptabilité analytique',0.00,75.00,0.00,75.00),('M207','GC_GEOCF_TS','2','Analyse financière',0.00,75.00,0.00,75.00),('M207','GC_GEOCM_TS','2','Management de la force de vente',0.00,80.00,0.00,80.00),('M207','GC_GEOOM_TS','2','Correspondance en français',0.00,60.00,0.00,60.00),('M207','GC_GEORH_TS','2','Gestion prévisionnelle des emplois et des compétences',0.00,60.00,0.00,60.00),('M207','GE_EI_T','2','Effectuer l’installation et l’entretien de l’instrumentation électronique de systèmes',0.00,90.00,0.00,90.00),('M207','GE_ESA_TS','2','Utilisation de l\'automate programmable',42.50,27.50,42.50,27.50),('M207','GE_OQEOEE_Q','2','Se familiariser avec les automatismes industriels',0.00,45.00,0.00,45.00),('M207','GE_OQEOEM_Q','2','Utiliser des techniques d’équilibrage statique et dynamique',0.00,45.00,0.00,45.00),('M207','GE_OQOIE_Q','2','Réaliser le câblage informatique et la téléphonie IP',0.00,60.00,0.00,60.00),('M207','GM_GMOEMFM_TS','2','Prototypage rapide - Fabrication additive',0.00,45.00,0.00,45.00),('M207','THR_ACOCG_T','2','Effectuer la mise en place et la confection de plats de la gastronomie internationale',0.00,90.00,0.00,90.00),('M207','THR_ACOPC_T','2','Confectionner et présenter des entremets classiques',0.00,75.00,0.00,75.00),('M207','THR_ART_Q','2','Cuisine Marocaine',0.00,80.00,0.00,80.00),('M207','THR_MTOETA_TS','2','Exploiter un logiciel de management de projets',0.00,50.00,0.00,50.00),('M208','AGC_C_BP','2','Univers du commerce au Maroc',60.00,0.00,60.00,0.00),('M208','BTP_BOP_T','2','Maquette numérique',0.00,90.00,0.00,90.00),('M208','FGT_AEFGTOF_Q','2','Isolation frigorifique',0.00,30.00,0.00,30.00),('M208','GC_AAOC_T','2','Merchandising',0.00,90.00,0.00,90.00),('M208','GC_AAOCP_T','2','Comptabilité des sociétés',0.00,60.00,0.00,60.00),('M208','GC_AAOG_T','2','Correspondance en français',0.00,60.00,0.00,60.00),('M208','GC_GEOCF_TS','2','Fiscalité de l\'entreprise',0.00,90.00,0.00,90.00),('M208','GC_GEOCM_TS','2','Gestion des approvisionnements',0.00,60.00,0.00,60.00),('M208','GC_GEOOM_TS','2','Correspondance en anglais',0.00,60.00,0.00,60.00),('M208','GC_GEORH_TS','2','Contrôle de gestion',0.00,90.00,0.00,90.00),('M208','GE_EI_T','2','Effectuer les opérations de maintenance préventive et prédictive',0.00,75.00,0.00,75.00),('M208','GE_ESA_TS','2','Circuits hydrauliques',0.00,45.00,0.00,45.00),('M208','GE_OQEOEE_Q','2','Effectuer des réparations des installations électriques',0.00,60.00,0.00,60.00),('M208','GE_OQEOEM_Q','2','Effectuer l’installation et la maintenance des équipements hydrauliques, des pompes de moteurs hydrauliques',0.00,90.00,0.00,90.00),('M208','THR_ACOCG_T','2','Effectuer la mise en place et la confection de banquets gastronomiques',0.00,45.00,0.00,45.00),('M208','THR_ACOPC_T','2','Confectionner et présenter des entremets contemporains',0.00,60.00,0.00,60.00),('M208','THR_ART_Q','2','La durabilité dans la restauration',0.00,40.00,0.00,40.00),('M208','THR_MTOETA_TS','2','Concevoir et exploiter une plate-forme de vente de voyages en ligne',0.00,75.00,0.00,75.00),('M209','GC_AAOC_T','2','Marketing de la grande distribution',0.00,45.00,0.00,45.00),('M209','GC_AAOCP_T','2','Gestion de caisse et des régies d\'avance',0.00,45.00,0.00,45.00),('M209','GC_AAOG_T','2','Correspondance en arabe',0.00,60.00,0.00,60.00),('M209','GC_GEOCF_TS','2','Contrôle de gestion- budgets et tableau de bord',0.00,90.00,0.00,90.00),('M209','GC_GEOCM_TS','2','Trade marketing',0.00,80.00,0.00,80.00),('M209','GC_GEOOM_TS','2','Correspondance en arabe',0.00,40.00,0.00,40.00),('M209','GE_ESA_TS','2','Installation, réparation : commande électronique de moteurs',25.00,35.00,25.00,35.00),('M209','THR_ACOCG_T','2','Confectionner et présenter des desserts à l’assiette pour gastronomes',0.00,45.00,0.00,45.00),('M209','THR_ACOPC_T','2','Confectionner des pièces montées de pâtisserie',0.00,75.00,0.00,75.00),('M209','THR_MTOETA_TS','2','Commercialiser un produit touristique via les réseaux sociaux',0.00,50.00,0.00,50.00),('M210','GC_AAOC_T','2','E-commerce',0.00,45.00,0.00,45.00),('M210','GC_AAOG_T','2','Pratique de la paie',0.00,60.00,0.00,60.00),('M210','GC_GEOCM_TS','2','Logiciel Sphinx',0.00,30.00,0.00,30.00),('M210','GC_GEOOM_TS','2','Bureautique avancée',0.00,90.00,0.00,90.00),('M210','GE_ESA_TS','2','Installation, dépannage : instrumentation industrielle',0.00,60.00,0.00,60.00),('M210','THR_ACOCG_T','2','Concevoir un menu gastronomique',0.00,45.00,0.00,45.00),('M211','GC_AAOC_T','2','E-marketing',0.00,60.00,0.00,60.00),('M211','GC_GEOCM_TS','2','Marketing international',0.00,90.00,0.00,90.00),('M211','GC_GEOOM_TS','2','Contrôle de gestion',0.00,90.00,0.00,90.00),('M211','GE_ESA_TS','2','Système automatisé contrôlé par API',0.00,55.00,0.00,55.00),('M212','GC_GEOCM_TS','2','Merchandising',0.00,60.00,0.00,60.00),('M212','GC_GEOOM_TS','2','Gestion des approvisionnements',0.00,50.00,0.00,50.00),('M301','AGC_C_BP','3','Projet de Création d’entreprise',0.00,60.00,0.00,60.00),('M301','AGC_COMPT_BP','3','Législation du travail',64.00,0.00,64.00,0.00),('M301','GC_AAOC_T','3','Logiciel sphinx',30.00,0.00,30.00,0.00),('M301','GC_AAOCP_T','3','Analyse financière',70.00,0.00,70.00,0.00),('M301','GC_AAOG_T','3','Gestion des Stocks',60.00,0.00,60.00,0.00),('M301','GC_GE_TS_RCDS','3','Fiscalité de l\' entreprise',35.00,0.00,35.00,0.00),('M301','GC_GEOCF_TS','3','Logiciel de gestion des immobilisations des déclarations fiscales',50.00,0.00,50.00,0.00),('M301','GC_GEOCM_TS','3','Techniques du commerce international',100.00,0.00,100.00,0.00),('M301','GC_GEOOM_TS','3','Gestion de la relation client et relation fournisseur',50.00,0.00,50.00,0.00),('M301','GC_GEORH_TS','3','Responsabilité sociétale et environnementale de l\'entreprise',75.00,0.00,75.00,0.00),('M301','THR_ACOCG_T','3','Effectuer le service des petits-déjeuners',25.00,0.00,25.00,0.00),('M301','THR_ACOPC_T','3','Confectionner des produits de sucre et de confiserie',60.00,0.00,60.00,0.00),('M301','THR_MTOETA_TS','3','Vendre des produits touristiques en ligne',60.00,0.00,60.00,0.00),('M302','AGC_C_BP','3','Gestion des Approvisionnements',60.00,0.00,60.00,0.00),('M302','AGC_COMPT_BP','3','Création d’entreprise',0.00,64.00,0.00,64.00),('M302','GC_AAOC_T','3','Gestion des documents commerciaux',35.00,0.00,35.00,0.00),('M302','GC_AAOCP_T','3','Budgets et tableau de bord',70.00,0.00,70.00,0.00),('M302','GC_AAOG_T','3','Simulation de gestion d\'entreprise',90.00,0.00,90.00,0.00),('M302','GC_GEOCF_TS','3','Audit comptable et financier',50.00,0.00,50.00,0.00),('M302','GC_GEOCM_TS','3','Management de la relation client',40.00,0.00,40.00,0.00),('M302','GC_GEOOM_TS','3','GRH- dynamique des groupes',40.00,0.00,40.00,0.00),('M302','GC_GEORH_TS','3','Gestion de projet',40.00,0.00,40.00,0.00),('M302','THR_ACOCG_T','3','Effectuer le service des menus de table d’hôte et à la carte',75.00,0.00,75.00,0.00),('M302','THR_ACOPC_T','3','Confectionner et présenter des desserts à l’assiette',45.00,0.00,45.00,0.00),('M302','THR_MTOETA_TS','3','Gérer la relation client via les outils digitaux',70.00,0.00,70.00,0.00),('M303','AGC_C_BP','3','Promotion des ventes',70.00,0.00,70.00,0.00),('M303','AGC_COMPT_BP','3','Logiciels de gestion',128.00,0.00,128.00,0.00),('M303','GC_AAOC_T','3','Gestion de la relation client',40.00,0.00,40.00,0.00),('M303','GC_AAOCP_T','3','Simulation de gestion d\'entreprise',90.00,0.00,90.00,0.00),('M303','GC_GE_TS_RCDS','3','Diagnostic financier',35.00,0.00,35.00,0.00),('M303','GC_GEOCF_TS','3','Normes comptables internationales',50.00,0.00,50.00,0.00),('M303','GC_GEOOM_TS','3','Gestion de projet',40.00,0.00,40.00,0.00),('M303','GC_GEORH_TS','3','Simulation de gestion d\'entreprise',90.00,0.00,90.00,0.00),('M303','THR_ACOCG_T','3','Effectuer le service de buffets et de banquets',60.00,0.00,60.00,0.00),('M303','THR_ACOPC_T','3','Confectionner et présenter des produits de glacerie',30.00,0.00,30.00,0.00),('M303','THR_MTOETA_TS','3','Optimiser  la rentabilité d\'une E-Travel agency',50.00,0.00,50.00,0.00),('M304','AGC_C_BP','3','E-business',0.00,60.00,0.00,60.00),('M304','AGC_COMPT_BP','3','Analyse financière',0.00,96.00,0.00,96.00),('M304','GC_AAOC_T','3','Promotion des ventes',35.00,0.00,35.00,0.00),('M304','GC_GE_TS_RCDS','3','Gestion de production et des approvisionnements',15.00,0.00,15.00,0.00),('M304','GC_GEOCM_TS','3','Simulation d\'entreprise',90.00,0.00,90.00,0.00),('M304','GC_GEOOM_TS','3','Simulation de gestion d\'entreprise',90.00,0.00,90.00,0.00),('M304','THR_ACOPC_T','3','Confectionner des produits de petits déjeuners en pâtisserie',60.00,0.00,60.00,0.00),('M304','THR_MTOETA_TS','3','Elaborer le business plan d\'une E-Travel agency',60.00,0.00,60.00,0.00),('M305','AGC_C_BP','3','Logiciel et Gestion Commerciale',0.00,90.00,0.00,90.00),('M305','AGC_COMPT_BP','3','Comptabilité de gestion',128.00,0.00,128.00,0.00),('M305','GC_AAOC_T','3','Simulation de gestion d\'entreprise',90.00,0.00,90.00,0.00),('M305','GC_GE_TS_RCDS','3','Contrôle de gestion partie 1: Comptabilité analytique d\'exploitation',0.00,35.00,0.00,35.00),('M305','GC_GEOCF_TS','3','Simulation de gestion d\'entreprise',90.00,0.00,90.00,0.00),('M305','THR_MTOETA_TS','3','Stage d\'intégration',120.00,0.00,120.00,0.00),('M306','AGC_C_BP','3','Gestion de la relation client',60.00,0.00,60.00,0.00),('M306','AGC_COMPT_BP','3','Les budgets',0.00,96.00,0.00,96.00),('M306','GC_GE_TS_RCDS','3','Gestion des ressources humaines',15.00,0.00,15.00,0.00),('M307','AGC_C_BP','3','Gestion de la Caisse',0.00,50.00,0.00,50.00),('M307','GC_GE_TS_RCDS','3','Marketing stratégique',0.00,30.00,0.00,30.00),('M308','GC_GE_TS_RCDS','3','Contrôle de gestion partie II: GB+TB',0.00,30.00,0.00,30.00);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveau`
--

DROP TABLE IF EXISTS `niveau`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `niveau` (
  `CodeNiv` varchar(2) NOT NULL,
  `DescpNiv` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`CodeNiv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveau`
--

LOCK TABLES `niveau` WRITE;
/*!40000 ALTER TABLE `niveau` DISABLE KEYS */;
INSERT INTO `niveau` VALUES ('Q','Qualifier'),('S','Specialiser'),('T','Technicien'),('TS','Technicien specialiser');
/*!40000 ALTER TABLE `niveau` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personnel` (
  `Matricule` varchar(15) NOT NULL,
  `Nom` varchar(25) DEFAULT NULL,
  `Prenom` varchar(25) DEFAULT NULL,
  `CodeUser` varchar(15) DEFAULT NULL,
  `Poste` varchar(15) DEFAULT NULL,
  `CodeEtab` varchar(15) DEFAULT NULL,
  `secteur` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnel`
--

LOCK TABLES `personnel` WRITE;
/*!40000 ALTER TABLE `personnel` DISABLE KEYS */;
INSERT INTO `personnel` VALUES ('0001','Admin','Admin','0001','Directeur','SNO0',NULL),('0002','Admin','Admin','0002','Directeur','SBO0',NULL),('0003','Admin','Admin','0003','Directeur','STO0',NULL);
/*!40000 ALTER TABLE `personnel` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_delete_personne` BEFORE DELETE ON `personnel` FOR EACH ROW BEGIN
	DELETE FROM user where Codeuser=old.codeuser;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `salle`
--

DROP TABLE IF EXISTS `salle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salle` (
  `CodeSl` varchar(15) NOT NULL,
  `DescpSl` varchar(50) DEFAULT NULL,
  `Type` varchar(15) DEFAULT NULL,
  `CodeEtab` varchar(15) NOT NULL,
  `secteur` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`CodeSl`,`CodeEtab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salle`
--

LOCK TABLES `salle` WRITE;
/*!40000 ALTER TABLE `salle` DISABLE KEYS */;
INSERT INTO `salle` VALUES ('S1','SALLE 1','SALLE','SBO0',''),('S1','SALLE 1','SALLE','SNO0','DIA'),('S10','SALLE 10','SALLE','SBO0',NULL),('S10','SALLE 10','SALLE','SNO0','DIA'),('S11','SALLE 11','SALLE','SBO0',NULL),('S11','SALLE 11','SALLE','SNO0',NULL),('S12','SALLE 12','SALLE','SBO0',NULL),('S12','SALLE 12','SALLE','SNO0',NULL),('S13','SALLE 13','SALLE','SBO0',NULL),('S13','SALLE 13','SALLE','SNO0',NULL),('S14','SALLE 14','SALLE','SBO0',NULL),('S14','SALLE 14','SALLE','SNO0',NULL),('S15','SALLE 15','SALLE','SBO0',NULL),('S15','SALLE 15','SALLE','SNO0',NULL),('S16','SALLE 16','SALLE','SBO0',NULL),('S16','SALLE 16','SALLE','SNO0',NULL),('S17','salle 17','SALLE','SBO0',NULL),('S17','salle 17','SALLE','SNO0',NULL),('S2','SALLE 2','SALLE','SBO0',NULL),('S2','SALLE 2','SALLE','SNO0',NULL),('S3','SALLE 3','SALLE','SBO0',NULL),('S3','SALLE 3','SALLE','SNO0',NULL),('S4','SALLE 4','SALLE','SBO0',NULL),('S4','SALLE 4','SALLE','SNO0',NULL),('S5','SALLE 5','SALLE','SBO0',NULL),('S5','SALLE 5','SALLE','SNO0',NULL),('S6','SALLE 6','SALLE','SBO0',NULL),('S6','SALLE 6','SALLE','SNO0',NULL),('S7','SALLE 7','SALLE','SBO0',NULL),('S7','SALLE 7','SALLE','SNO0',NULL),('S8','SALLE 8','SALLE','SBO0',NULL),('S8','SALLE 8','SALLE','SNO0',NULL),('S9','SALLE 9','SALLE','SBO0',NULL),('S9','SALLE 9','SALLE','SNO0',NULL),('SD1','SALLE DEVELOPPEMENT 1','ATELIER','SNO0',NULL),('SD2','SALLE DEVELOPPEMENT 2','ATELIER','SNO0',NULL),('SRI1','SALLE RESEAUX INFORMATIQUE 1','ATELIER','SNO0',NULL),('SRI2','SALLE RESEAUX INFORMATIQUE 2','ATELIER','SNO0',NULL);
/*!40000 ALTER TABLE `salle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secteur`
--

DROP TABLE IF EXISTS `secteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `secteur` (
  `CodeSect` varchar(15) NOT NULL,
  `DescpSect` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CodeSect`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secteur`
--

LOCK TABLES `secteur` WRITE;
/*!40000 ALTER TABLE `secteur` DISABLE KEYS */;
INSERT INTO `secteur` VALUES ('BTP','Bâtiment et Travaux Publics'),('DIA','Digital et Intelligence Artificielle'),('FGT','Froid et Génie Thermique'),('GC','Gestion et Commerce'),('GE','Génie électrique'),('GM','Génie Mécanique'),('THR','Tourisme Hôtellerie Restauration');
/*!40000 ALTER TABLE `secteur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stagiaire` (
  `CEF` varchar(30) NOT NULL,
  `Nom` varchar(30) DEFAULT NULL,
  `Prenom` varchar(30) DEFAULT NULL,
  `Groupe` varchar(30) DEFAULT NULL,
  `AnneF` varchar(30) NOT NULL,
  `Etab` varchar(30) DEFAULT NULL,
  `discipline` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`CEF`,`AnneF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stagiaire`
--

LOCK TABLES `stagiaire` WRITE;
/*!40000 ALTER TABLE `stagiaire` DISABLE KEYS */;
/*!40000 ALTER TABLE `stagiaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `CodeUser` varchar(15) NOT NULL,
  `Login` varchar(25) DEFAULT NULL,
  `Mdp` varchar(160) DEFAULT NULL,
  `Type` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`CodeUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('0001','Admin','$2y$10$F3dgetwcjKYMHeVQ2nDKaOkrGRt.d95gjUKmsOVLb7uFS8yivLKoa','ETAB'),('0002','SBO0','$2y$10$F3dgetwcjKYMHeVQ2nDKaOkrGRt.d95gjUKmsOVLb7uFS8yivLKoa','ETAB'),('0003','STO0','$2y$10$F3dgetwcjKYMHeVQ2nDKaOkrGRt.d95gjUKmsOVLb7uFS8yivLKoa','ETAB');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `validateur`
--

DROP TABLE IF EXISTS `validateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `validateur` (
  `matricule` varchar(15) NOT NULL,
  `filiere` varchar(20) NOT NULL,
  `Etab` varchar(15) NOT NULL,
  PRIMARY KEY (`matricule`,`filiere`,`Etab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `validateur`
--

LOCK TABLES `validateur` WRITE;
/*!40000 ALTER TABLE `validateur` DISABLE KEYS */;
/*!40000 ALTER TABLE `validateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `validerefm`
--

DROP TABLE IF EXISTS `validerefm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `validerefm` (
  `matricule` varchar(15) NOT NULL,
  `filiere` varchar(20) NOT NULL,
  `Etab` varchar(15) NOT NULL,
  PRIMARY KEY (`matricule`,`filiere`,`Etab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `validerefm`
--

LOCK TABLES `validerefm` WRITE;
/*!40000 ALTER TABLE `validerefm` DISABLE KEYS */;
/*!40000 ALTER TABLE `validerefm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ista_db'
--

--
-- Dumping routines for database 'ista_db'
--
/*!50003 DROP FUNCTION IF EXISTS `GetFiliereByGrpAndModule` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `GetFiliereByGrpAndModule`(grp varchar(30),md varchar(20),etb varchar(20)) RETURNS varchar(20) CHARSET utf8mb4
    DETERMINISTIC
BEGIN
	declare codefiliere varchar(20);
    select g.CodeFlr into codefiliere from Groupe g inner join Filiere f using(CodeFlr)
	inner join Modules m using(CodeFlr) where g.Codegrp = grp and m.CodeMd = md and g.CodeFlr = m.CodeFlr
    and g.CodeEtab = etb;
    return codefiliere;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `Nb_Affectation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `Nb_Affectation`(mat varchar(15),grp varchar(15),module varchar(15)) RETURNS int
    DETERMINISTIC
begin

	declare nbmodule int default 0;
    select count(*) into nbmodule from affectmodule 
    where Matricule = mat and Groupe = grp and not(ModuleCode = module) and efm = "N" and 
(avc/(select s1+s2 from modules where CodeFlr=(select CodeFlr from groupe where CodeGrp=grp) and codeMd=ModuleCode))<0.9;
    return nbmodule;

end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetAllAnnee` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllAnnee`()
BEGIN 
	select * from Annee;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetAllEtablissement` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllEtablissement`()
BEGIN 
	select * from Etablissement;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetAllFiliere` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllFiliere`()
BEGIN 
	select * from Filiere;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetAllModules` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllModules`()
BEGIN 
	select * from modules;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_AddAvancement` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_AddAvancement`(DtAvc date,mat varchar(15),codeMd varchar(15),codegrp varchar(15),j varchar(15),Sea varchar(15),AnneFr varchar(15),CodeEtab varchar(15))
begin
	insert into avancement values(DtAvc,mat,codeMd,codegrp,j,Sea,AnneFr,CodeEtab);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_AddStagiaire` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_AddStagiaire`(CEF varchar(30),Nom varchar(30),Prenom varchar(30),Groupe varchar(30)
,AnneF varchar(30),Etab varchar(30),dis varchar(100))
begin
		insert into Stagiaire values(CEF,Nom,Prenom,Groupe,AnneF,Etab,dis);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_DeleteAllStagiaire` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_DeleteAllStagiaire`(anne varchar(30) ,et varchar(30))
begin
	delete from Stagiaire where Etab = et and AnneF = anne;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_DeleteAvancement` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_DeleteAvancement`(DtAvc date,mat varchar(15),codeMd varchar(15),codegrp varchar(15),Sea varchar(15),anne varchar(15),etab varchar(15))
begin
	delete from avancement where DateAvc = DtAvc and Matricule = mat and CodeModule = codeMd and seance = Sea and AnneFr = anne and CodeEtab = etab ;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_DeleteStagiaire` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_DeleteStagiaire`(c varchar(30) ,anne varchar(30),et varchar(30))
begin
	delete from Stagiaire where CEF = c and AnneF=anne and etab = et;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_FindAvancement` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_FindAvancement`(DtAvc date,mat varchar(15),codeMd varchar(15),codegrp varchar(15),Sea varchar(15),anne varchar(15),etab varchar(15))
begin
	select * from avancement where DateAvc = DtAvc and Matricule = mat and CodeModule = codeMd and seance = Sea and AnneFr = anne and CodeEtab = etab ;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_GetAllStagiaire` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_GetAllStagiaire`(ann varchar(30) ,et varchar(30))
begin
	select CEF,Nom,Prenom,Groupe,discipline from Stagiaire where Etab = et and AnneF = ann;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_GetSeanceByDay` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_GetSeanceByDay`(j varchar(10),anne varchar(15),etab varchar(15))
begin
	select E.CodeGrp,E.Seance,E.CodeModule,E.Matricule,concat(F.Nom," ",F.Prenom ),m.DescpMd, E.CodeSl,fi.CodeSect from
    Formateur F inner join  emploireel E using(Matricule) 
    inner join Groupe g using(CodeGrp)
	inner join modules m on g.CodeFlr = m.CodeFlr
	inner join filiere fi on fi.CodeFlr = m.CodeFlr
    where Jour = j and E.CodeModule = m.CodeMd and AnneeFr = anne and CodeEtb = etab
    order by CodeGrp,Seance;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_GetSeanceByDayinexecl` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_GetSeanceByDayinexecl`(j varchar(10),anne varchar(15),etab varchar(15))
begin
	select concat(F.Nom," ",F.Prenom ),E.CodeGrp,m.DescpMd,E.Jour,E.Seance,E.CodeSl from
    Formateur F inner join  emploireel E using(Matricule) 
    inner join Groupe g using(CodeGrp)
	inner join modules m on g.CodeFlr = m.CodeFlr
    where Jour = j and E.CodeModule = m.CodeMd and AnneeFr = anne and CodeEtb = etab
    order by CodeGrp,Seance;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_GetStagiaireSecteur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_GetStagiaireSecteur`(ann varchar(30) ,et varchar(30),secteur varchar(30))
begin
		SELECT s.CEF,s.Nom,s.Prenom,s.Groupe,s.Discipline 
			FROM Stagiaire s INNER JOIN Groupe g ON g.CodeGrp=s.Groupe
			INNER JOIN filiere f USING(CodeFlr)
			WHERE Etab = et AND AnneF = ann AND f.CodeSect=secteur;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_ModifierAffectmoduleMois` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_ModifierAffectmoduleMois`(mat varchar(15),codeMd varchar(15),codegrp varchar(15),anne varchar(15),etab varchar(15))
begin
	update affectmodule set avc = avc - 2.5 where Matricule = mat and Groupe = codegrp
    and ModuleCode = CodeMd and AnneeFr = anne and CodeEtab = etab ;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_ModifierAffectmodulePlus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_ModifierAffectmodulePlus`(mat varchar(15),codeMd varchar(15),codegrp varchar(15),anne varchar(15),etab varchar(15))
begin
	update affectmodule set avc = avc + 2.5 where Matricule = mat and Groupe = codegrp
    and ModuleCode = CodeMd and AnneeFr = anne and CodeEtab = etab ;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PS_UpdateStagiaire` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PS_UpdateStagiaire`(c varchar(30),n varchar(30),p varchar(30),g varchar(30),ann varchar(30)
,et varchar(30),dis varchar(100))
begin
	update Stagiaire set Nom = n,Prenom = p ,Groupe = g,discipline = dis where CEF = c and AnneF=ann and etab = et;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPGetModuleSecteur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPGetModuleSecteur`(p_secteur varchar(30))
BEGIN 
	select m.* from modules m inner join filiere f using(CodeFlr) where f.CodeSect=p_secteur;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_AbsenceStatistique` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AbsenceStatistique`(dtd date,dtf date,sea varchar(20),grp VARCHAR(20),cefstg varchar(50),
										ann VARCHAR(10),etablissement VARCHAR(10),tp varchar(10))
begin 
	if (sea = "choisir" and grp = "choisir" and cefstg = "choisir") then
        SELECT count(*) FROM absencestagiaire where DateAbsenece >= dtd and DateAbsenece <= dtf
        and AnneFr = ann and etab = etablissement and type = tp;
	end if;
    if (sea != "choisir" and grp = "choisir" and cefstg = "choisir") then
        SELECT count(*) FROM absencestagiaire where DateAbsenece >= dtd and DateAbsenece <= dtf
        and AnneFr = ann and etab = etablissement and seance = sea and type = tp;
	end if;
    if (sea = "choisir" and grp != "choisir" and cefstg = "choisir") then
        SELECT count(*) FROM absencestagiaire where DateAbsenece >= dtd and DateAbsenece <= dtf
        and AnneFr = ann and etab = etablissement and groupe = grp and type = tp;
	end if;
    if (sea = "choisir" and grp != "choisir" and cefstg != "choisir") then
        SELECT count(*) FROM absencestagiaire where DateAbsenece >= dtd and DateAbsenece <= dtf
        and AnneFr = ann and etab = etablissement and groupe = grp and cef = cefstg and type = tp;
	end if;
    if (sea != "choisir" and grp != "choisir" and cefstg = "choisir") then
        SELECT count(*) FROM absencestagiaire where DateAbsenece >= dtd and DateAbsenece <= dtf
        and AnneFr = ann and etab = etablissement and groupe = grp and seance = sea and type = tp;
	end if;
    if (sea != "choisir" and grp != "choisir" and cefstg != "choisir") then
        SELECT count(*) FROM absencestagiaire where DateAbsenece >= dtd and DateAbsenece <= dtf
        and AnneFr = ann and etab = etablissement and groupe = grp and seance = sea and cef = cefstg and type = tp;
	end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_AbsenceStatistiqueBySecteur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AbsenceStatistiqueBySecteur`(dtd date,dtf date,sea varchar(20),grp VARCHAR(20),cefstg varchar(50),
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
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_AddAbsenceFormateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AddAbsenceFormateur`(Mat varchar(20),AnneFr VARCHAR(10),DateAbsenece DATE,Groupe VARCHAR(20),Seance INT,
											CodeModule VARCHAR(20),Justify VARCHAR(10),etab VARCHAR(20))
begin 
	insert into AbsenceFormateur values(Mat,AnneFr,DateAbsenece,Groupe,Seance,CodeModule,Justify,etab);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_AddAbsenceStagiaire` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AddAbsenceStagiaire`(CEF varchar(20),AnneFr VARCHAR(10),DateAbsenece DATE,Groupe VARCHAR(20),Seance INT,
											CodeModule VARCHAR(20),Justify VARCHAR(10),etab VARCHAR(20),typeAb VARCHAR(10))
begin 
	insert into AbsenceStagiaire values(CEF,AnneFr,DateAbsenece,Groupe,Seance,CodeModule,Justify,etab,typeAb);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_AddEFM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AddEFM`(mat varchar(15),grp varchar(15),CodeMd varchar(15),chemin varchar(150),tpefm varchar(20),
anne int,etablissement varchar(20),CdFlr varchar(20))
begin 
	insert into EFM(matricule,groupe,module,url,TypeEFM,DateEntre,CodeFlr,AnneeFr,Etab) values(mat,grp,CodeMd,chemin,tpefm,now(),CdFlr,anne,etablissement);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_AddSureille` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AddSureille`(
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
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_AddValidateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AddValidateur`(mat varchar(15), flr varchar(20), etablissement varchar(15))
begin 
	insert into Validateur values(mat,flr,etablissement);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Add_cours` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Add_cours`(CodeGrp varchar(20),Jour varchar(10),Seance varchar(1),CodeModule varchar(20),
Matricule varchar(20),CodeSl varchar(20),TypeSc varchar(20),CodeEtb varchar(20),AnneeFr varchar(10))
BEGIN
	INSERT INTO emploidraft values(CodeGrp,Jour,Seance,CodeModule,Matricule,CodeSl,TypeSc,CodeEtb,AnneeFr);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Add_filiere` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Add_filiere`(CdFl VARCHAR(15),DescrpFl VARCHAR(50),CdSt VARCHAR(15),Nv VARCHAR(15))
BEGIN
	 INSERT INTO  filiere VALUES(CdFl,DescrpFl,CdSt,Nv);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Add_Salle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Add_Salle`(CdSal VARCHAR(15),DescrpSl VARCHAR(50),Typ VARCHAR(15),CdEtab VARCHAR(15),sect VARCHAR(15))
BEGIN
	 INSERT INTO  salle VALUES(CdSal,DescrpSl,Typ,CdEtab,sect);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Affectation_Module_Grp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Affectation_Module_Grp`(grp varchar(15),etab varchar(15),an varchar(10))
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_AffecterModule` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AffecterModule`(mat varchar(15),grp varchar(50),codemdl varchar(15),annefr varchar(10),codetab varchar(10))
BEGIN
		INSERT INTO affectmodule(Matricule,Groupe,ModuleCode,AnneeFr,CodeEtab) VALUES(mat,grp,codemdl,annefr,codetab);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_affecter_de_fromateurword` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_affecter_de_fromateurword`(cdetb varchar(10),annefr varchar(10))
BEGIN
	SELECT af.Matricule,f.Nom,f.Prenom FROM affectmodule af 
    INNER JOIN formateur f USING(Matricule)
    WHERE af.AnneeFr=annefr AND af.CodeEtab=cdetb group by af.Matricule ; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Archive` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Archive`(anne varchar(4),etb varchar(20))
BEGIN
	declare moi int;
    set moi = month(now());
    delete from emploiarchive where Mois=moi and AnneeFr= anne AND CodeEtb=etb;
    INSERT  INTO emploiarchive SELECT *,moi FROM emploireel ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_AvancementAffectation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AvancementAffectation`(mat varchar(10),md varchar(20),grp varchar(20),etab varchar(10),anne varchar(4))
BEGIN
	SELECT 
		af.avc,(af.avc/(m.s1 + m.s2))*100 as taux,m.s1 + m.s2
	FROM groupe g INNER JOIN affectmodule af ON af.Groupe=g.codegrp
	INNER JOIN modules m ON m.CodeMd = af.ModuleCode
	WHERE m.codeflr=g.codeflr
    and af.Groupe = grp and m.CodeMd = md and  af.Matricule=mat and  af.CodeEtab=etab and  af.AnneeFr=anne ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Couleur_row_affectation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Couleur_row_affectation`(mat varchar(15),codeMd varchar(15),grp varchar(15),anne varchar(15),etab varchar(15))
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
 end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteAllFilieres` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAllFilieres`()
BEGIN
	truncate Filiere ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteAllFormateurs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAllFormateurs`(codeEtab varchar(10))
BEGIN
	delete from Formateur where CodeEtab=codeEtab ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteAllGroupes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAllGroupes`(codeEtab varchar(10))
BEGIN
	delete from groupe where CodeEtab=codeEtab ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteAllModules` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAllModules`()
BEGIN
	truncate Modules ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteAllNiveaux` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAllNiveaux`()
BEGIN
	truncate Niveau ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteAllSalles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAllSalles`(codeEtab varchar(10))
BEGIN
	delete from Salle where CodeEtab=codeEtab ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteAllSecteurs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAllSecteurs`()
BEGIN
	truncate Secteur;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteAllSurveille` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAllSurveille`(etab varchar(25))
BEGIN
	DELETE FROM personnel where CodeEtab=etab and Poste='Surveille' ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteAllValidateurByEtab` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAllValidateurByEtab`(etablissement varchar(15))
begin 
	delete from Validateur where Etab = etablissement;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteEFM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteEFM`(id_efm int)
begin 
	delete from EFM where id = id_efm;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteFormateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteFormateur`(mat varchar(15),etab varchar(15))
BEGIN 
	Delete from Formateur where Matricule = mat and CodeEtab = etab;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_DeleteGrp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteGrp`(IN cdGrp VARCHAR(15),IN cdEtab VARCHAR(15))
BEGIN
	DELETE FROM Groupe WHERE CodeGrp = cdGrp AND CodeEtab = cdEtab;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteModules` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteModules`(IN cdmd varchar(15),IN cdfl varchar(20))
BEGIN 
	Delete from Modules m where m.CodeMd = cdmd and codeflr = cdfl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteModule_Formateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteModule_Formateur`(mat varchar(10),grp varchar(50),codmd varchar(10),anne varchar(4),etb varchar(30))
BEGIN
	DELETE FROM affectmodule WHERE Matricule=mat AND Groupe=grp AND ModuleCode=codmd AND AnneeFr=anne AND CodeEtab=etb;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_DeleteNiv` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteNiv`(IN CodeNiv VARCHAR(15))
BEGIN
	DELETE FROM Niveau n WHERE n.CodeNiv = CodeNiv;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_DeleteSec` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteSec`(IN cdSect VARCHAR(15))
BEGIN
	DELETE FROM Secteur WHERE CodeSect = cdSect;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteSurveille` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteSurveille`(mat varchar(25),etab varchar(25))
BEGIN
	DELETE FROM personnel where CodeEtab=etab AND Matricule=mat;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DeleteValidateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteValidateur`(mat varchar(15), flr varchar(20), etablissement varchar(15))
begin 
	delete from Validateur where matricule = mat and filiere = flr and Etab = etablissement;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Delete_cour` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Delete_cour`(grp varchar(15),jr varchar(10) ,Sc varchar(2),Cdetb varchar(15),an varchar(4))
BEGIN
	DELETE FROM emploidraft WHERE CodeGrp =grp AND Jour=jr AND Seance=sc AND CodeEtb=Cdetb AND AnneeFr=an;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Delete_filiere` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Delete_filiere`(CdFL VARCHAR(15))
BEGIN
	 DELETE FROM filiere WHERE CodeFlr=CdFl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Delete_Salle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Delete_Salle`(CdSal VARCHAR(15),CdEtab VARCHAR(15))
BEGIN
	 DELETE FROM salle WHERE CodeSl=CdSal AND CodeEtab=CdEtab;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_DetailEFM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_DetailEFM`(id_efm int)
BEGIN
	select e.*,v.*,f.DescpFlr,s.DescpSect from secteur s inner join filiere f using(CodeSect)
    inner join groupe g using(CodeFlr)
    inner join efm e on e.groupe = g.CodeGrp
    inner join ExamValider v 
    on e.id = v.id_efm
    where e.id = id_efm;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_DixDernieresJoursAbsenceStg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DixDernieresJoursAbsenceStg`(etablissemnet varchar(15),An varchar(4))
begin 
	select DateAbsenece,count(*) from absencestagiaire
	where Etab = etablissemnet and AnneFr = An and type = "A"
	group by DateAbsenece
	order by DateAbsenece desc limit 10;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_EFM_fait` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_EFM_fait`(ef varchar(1),mat varchar(20),grp varchar(20),cdmd varchar(20),an varchar(4),cdtb varchar(20))
begin
	update affectmodule   set efm=ef
    where  groupe=grp and  matricule=mat  and ModuleCode=cdmd and CodeEtab=cdtb and AnneeFr=an;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_EFM_VALIDER` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_EFM_VALIDER`(mat varchar(40),etb varchar(20),an varchar(4))
BEGIN
	SELECT e.id,concat(f.Nom,' ',f.prenom) as NomP,e.*,m.DescpMd FROM formateur f INNER JOIN efm e USING(matricule) 
    INNER JOIN modules m on m.codemd=e.module
    where  e.Etab=etb and e.Anneefr=an and e.codeflr=m.codeflr and e.codeflr in(select filiere from validateur where Matricule=mat and Etab=etb);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_EmploiArchiver` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_EmploiArchiver`(cdetb varchar(15),an varchar(4),ms varchar(2))
BEGIN
	SELECT * FROM emploiarchive WHERE CodeEtb=cdetb AND AnneeFr=an AND Mois=ms;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Emploi_Formateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Emploi_Formateur`(frm varchar(15),Etab varchar(15),An varchar(15))
begin 
	select E.CodeGrp,E.Jour,E.Seance,E.TypeSc,E.CodeSl,m.DescpMd 
    from Groupe g inner join EmploiReel E using(CodeGrp)
    inner join modules m on E.CodeModule = m.CodeMd 
    where E.Matricule = frm and E.CodeEtb = Etab and E.AnneeFr = An 
    and g.CodeFlr = m.CodeFlr;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Emploi_Groupe` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Emploi_Groupe`(grp varchar(15),Etab varchar(25),An varchar(15))
begin 
	select concat(F.Nom," ",F.Prenom) as nomF,F.Matricule,E.Jour,E.Seance,E.TypeSc,E.CodeSl,m.descpMd,m.CodeMd,E.CodeGrp
	from formateur F inner join emploidraft E using(Matricule)
	inner join Groupe g using(CodeGrp)
	inner join modules m on g.CodeFlr = m.CodeFlr
    where E.CodeGrp = grp  and E.CodeEtb = Etab and E.AnneeFr = An
    and E.CodeModule = m.CodeMd
    order by case  E.Jour
					When 'lundi' then 1
					When 'mardI' then 2
					When 'mercredi' then 3
					When 'jeudi' then 4
					When 'vendredi' then 5
					When 'samedi' then 6
					end
					,
					case E.Seance 
					when 1 then 1
					when 2 then 2
					when 3 then 3
					when 4 then 4
					end;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Emploi_GroupeArchiver` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Emploi_GroupeArchiver`(grp varchar(15),Etab varchar(15),An varchar(15),m varchar(2))
begin 
	select concat(F.Nom," ",F.Prenom) as nomF,F.Matricule,E.Jour,E.Seance,E.TypeSc,E.CodeSl,m.descpMd,m.CodeMd
	from formateur F inner join emploiarchive E using(Matricule)
	inner join Groupe g using(CodeGrp)
	inner join modules m on g.CodeFlr = m.CodeFlr
    where E.CodeGrp = grp  and E.CodeEtb = Etab and E.AnneeFr = An
    and E.CodeModule = m.CodeMd AND Mois=m;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Emploi_GroupeReel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Emploi_GroupeReel`(grp varchar(15),Etab varchar(15),An varchar(15))
begin 
	select concat(F.Nom," ",F.Prenom) as nomF,F.Matricule,E.Jour,E.Seance,E.TypeSc,E.CodeSl,m.descpMd,m.CodeMd
	from formateur F inner join emploireel E using(Matricule)
	inner join Groupe g using(CodeGrp)
	inner join modules m on g.CodeFlr = m.CodeFlr
    where E.CodeGrp = grp  and E.CodeEtb = Etab and E.AnneeFr = An
    and E.CodeModule = m.CodeMd ;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Emploi_Groupe_B` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Emploi_Groupe_B`(grp varchar(15),Etab varchar(15),An varchar(15))
begin 
	select concat(F.Nom," ",F.Prenom),E.Jour,E.Seance,E.TypeSc,E.CodeSl,m.descpMd
	from formateur F inner join EmploiReel E using(Matricule)
	inner join Groupe g using(CodeGrp)
	inner join modules m on g.CodeFlr = m.CodeFlr
    where E.CodeGrp = grp  and E.CodeEtb = Etab and E.AnneeFr = An
    and E.CodeModule = m.CodeMd;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Emploi_Salle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Emploi_Salle`(CodeSalle varchar(15),Etab varchar(15),An varchar(15))
begin 
	select concat(F.Nom," ",F.Prenom),E.Jour,E.Seance,E.CodeGrp,m.descpMd 
	from formateur F inner join EmploiReel E using(Matricule)
	inner join Groupe g using(CodeGrp)
	inner join modules m on g.CodeFlr = m.CodeFlr
    where E.CodeSl = CodeSalle and E.CodeEtb = Etab and E.AnneeFr = An and E.CodeModule = m.CodeMd;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_ExamValider` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_ExamValider`(
  IN p_date_passation VARCHAR(255),
  IN p_bareme VARCHAR(255),
  IN p_salle_examen VARCHAR(255),
  IN p_duree VARCHAR(255),
  IN p_structure_examen VARCHAR(255),
  IN p_degre_difficulte VARCHAR(255),
  IN p_deux_variantes VARCHAR(255),
  IN p_corrige_depose VARCHAR(255),
  IN p_decision VARCHAR(255),
  IN p_id_efm INT,
  IN p_validateur VARCHAR(255)
)
BEGIN
  IF EXISTS(SELECT * FROM ExamValider WHERE id_efm = p_id_efm) THEN
    UPDATE ExamValider SET
      date_passation = p_date_passation,
      bareme = p_bareme,
      salle_examen = p_salle_examen,
      duree = p_duree,
      structure_examen = p_structure_examen,
      degre_difficulte = p_degre_difficulte,
      deux_variantes = p_deux_variantes,
      corrige_depose = p_corrige_depose,
      Decision=p_decision
    WHERE id_efm = p_id_efm;
  ELSE
    INSERT INTO ExamValider (
      date_passation, bareme, salle_examen, duree, structure_examen, degre_difficulte, deux_variantes, corrige_depose,Decision, id_efm
    )
    VALUES (
      p_date_passation, p_bareme, p_salle_examen, p_duree, p_structure_examen, p_degre_difficulte, p_deux_variantes, p_corrige_depose,p_decision, p_id_efm
    );
  END IF;
  update efm set validateur=p_validateur,dateValide=now() where id=p_id_efm;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_FindGrp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_FindGrp`(IN cdGrp VARCHAR(15),IN cdEtab VARCHAR(15))
BEGIN
	SELECT * FROM Groupe WHERE CodeGrp = cdGrp AND CodeEtab = cdEtab;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_FindSec` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_FindSec`(IN cdSect VARCHAR(15))
BEGIN
	SELECT * FROM Secteur WHERE CodeSect = cdSect;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_FindSurveille` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_FindSurveille`(val varchar(255),etab varchar(25))
BEGIN
	SELECT Matricule,Nom ,prenom,concat(Poste ,'-',  COALESCE(s.DescpSect, '')) as post  FROM personnel p LEFT JOIN secteur s 
		on s.CodeSect=p.secteur   where CodeEtab=etab AND Poste in ('Surveille','ChefSecteur') and 
    (Matricule REGEXP val or Nom REGEXP val or prenom REGEXP val );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_FindValidateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_FindValidateur`(val varchar(255),etablissement varchar(15))
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_FormateurNonAffectation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_FormateurNonAffectation`(Etab varchar(15),An varchar(4))
begin 
	select Matricule,Nom,Prenom from Formateur  
	where CodeEtab = Etab and 
	Matricule not in (select distinct Matricule from affectmodule where CodeEtab = Etab and AnneeFr = An);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Formateur_Dispo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Formateur_Dispo`(mat varchar(15),jr varchar(10),sc varchar(1),Etab varchar(15),an varchar(15))
begin 
	select CodeGrp,CodeSl,TypeSc from emploidraft where Matricule=mat AND Jour=jr AND Seance=sc AND CodeEtb = Etab AND AnneeFr=an ;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Formateur_DispoReel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Formateur_DispoReel`(mat varchar(15),jr varchar(10),sc varchar(1),Etab varchar(15))
begin 
	select CodeGrp,CodeSl,TypeSc from emploireel where Matricule=mat AND Jour=jr AND Seance=sc AND CodeEtb = Etab ;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_Formateur_Emploi` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Formateur_Emploi`(Codetb varchar(20),AnneFr varchar(10),grp varchar(30))
BEGIN   
	SELECT f.Matricule,concat(f.nom,' ',f.prenom) as NomPr,m.CodeMd,m.DescpMd FROM Formateur f
    inner JOIN affectmodule af USING(Matricule) right JOIN modules m ON m.CodeMd=af.ModuleCode 
    INNER JOIN groupe g using(CodeFlr)
    WHERE af.CodeEtab=codetb AND af.Anneefr=AnneeFr AND af.Groupe=grp  AND af.Groupe=g.CodeGrp
    ORDER BY NomPr;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Formateur_Emplois` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Formateur_Emplois`(anne varchar(4),codtb varchar(15),mat varchar(20))
BEGIN
	SELECT e.Jour,e.Seance,e.CodeGrp,e.Matricule,e.CodeModule,e.CodeSl,e.TypeSc,m.DescpMd FROM groupe g
    INNER JOIN emploireel e ON e.CodeGrp=g.CodeGrp
    INNER JOIN modules m ON m.CodeMd=e.CodeModule 
    WHERE e.AnneeFr=anne AND e.CodeEtb=codtb AND e.Matricule=mat AND g.CodeFlr=m.CodeFlr;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_formateur_group` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_formateur_group`(grp varchar(20),flr varchar(50),an varchar(4),cdtb varchar(20))
begin
	select  af.Groupe,m.descpMd,m.CodeMd,flr,m.s1,m.s2,m.s1+m.s2 as masshoraire,af.avc,ROUND((af.avc/(m.s1+m.s2))*100,2) as taux,af.Matricule,concat(f.nom,' ',f.prenom) as nomp from formateur f
	inner join affectmodule af using(matricule)
	inner join modules m on af.ModuleCode=m.codemd
	where  af.Groupe=grp and af.anneefr=an and af.codeetab=cdtb and m.codeflr=flr;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetAllFormateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAllFormateur`(IN etab varchar(10))
BEGIN 
	SELECT DISTINCT f.Matricule,f.Nom,f.Prenom,f.Type,f.MassHoraire,concat(f.secteur,"-",s.DescpSect) as secteur FROM formateur f
	left join secteur s on f.secteur = s.CodeSect where CodeEtab = etab ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_GetAllGroupes_Emploi` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_GetAllGroupes_Emploi`(Codetb varchar(10),AnneFr varchar(10))
BEGIN
	SELECT Groupe as CodeGrp  FROM affectmodule WHERE CodeEtab=codetb AND AnneeFr=AnneFr GROUP BY CodeGrp ORDER BY CodeGrp;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_GetAllGroupes_EmploiArchiver` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_GetAllGroupes_EmploiArchiver`(Codetb varchar(10),AnneFr varchar(10),m varchar(2))
BEGIN
	SELECT CodeGrp FROM emploiarchive WHERE CodeEtb=codetb AND AnneeFr=AnneFr AND Mois=m GROUP BY CodeGrp ORDER BY CodeGrp;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_GetAllGroupes_EmploiReel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_GetAllGroupes_EmploiReel`(Codetb varchar(10),AnneFr varchar(10))
BEGIN
	SELECT  CodeGrp FROM emploireel WHERE CodeEtb=codetb AND AnneeFr=AnneFr GROUP BY CodeGrp ORDER BY CodeGrp;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_GetAllGroupes_EmploiReelParSecteur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_GetAllGroupes_EmploiReelParSecteur`(Codetb varchar(10),AnneFr varchar(10),secteur varchar(50))
BEGIN
	SELECT  em.CodeGrp FROM emploireel em INNER JOIN groupe g ON G.CodeGrp=em.CodeGrp
		inner join filiere f on f.codeFlr=g.CodeFlr
    WHERE em.CodeEtb=codetb AND em.AnneeFr=AnneFr AND f.CodeSect=secteur GROUP BY em.CodeGrp ORDER BY em.CodeGrp;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_GetAllGroupes_EmploiSecteur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_GetAllGroupes_EmploiSecteur`(Codetb varchar(10),AnneFr varchar(10),secteur varchar(50))
BEGIN
	SELECT af.Groupe as CodeGrp  FROM affectmodule af
		inner join Groupe g  on g.CodeGrp=af.Groupe
        inner join filiere f using(CodeFlr)
	WHERE af.CodeEtab=codetb AND af.AnneeFr=AnneFr AND f.CodeSect=secteur  GROUP BY CodeGrp ORDER BY CodeGrp;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetAllSurveille` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAllSurveille`(etab varchar(25))
BEGIN
	SELECT Matricule,Nom ,prenom,concat(Poste ,'-',  COALESCE(s.DescpSect, '')) as post FROM personnel p LEFT JOIN secteur s 
		on s.CodeSect=p.secteur  where CodeEtab=etab and Poste in ('Surveille','ChefSecteur') ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetAllValidateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAllValidateur`(etablissement varchar(15))
begin 
	select v.filiere,f.DescpFlr,v.matricule,concat(fo.Nom," ",fo.prenom) as nom,f.CodeSect
    from formateur fo inner join Validateur v using(matricule)
    inner join filiere f on f.CodeFlr = v.filiere
    where Etab = etablissement 
    order by v.filiere;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetAll_filiere` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAll_filiere`()
BEGIN
	 SELECT * FROM  filiere;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetAll_Salle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAll_Salle`(codeEtb varchar(10))
BEGIN
	 SELECT CodeSl,DescpSl,Type,concat(sa.secteur,"-",s.DescpSect) as secteur FROM  salle sa
     left join secteur s on sa.secteur = s.CodeSect
     WHERE CodeEtab=CodeEtb;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetConsulterAbsence` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetConsulterAbsence`(dtd date,dtf date,sea varchar(20),grp VARCHAR(20),cefstg varchar(50),
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
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetEFMByFormateurAnneeEtab` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetEFMByFormateurAnneeEtab`(mat varchar(15),anne int,etablissement varchar(20))
begin 
	select e.*,m.DescpMd from modules m inner join 
    EFM e on m.CodeMd = e.module
    inner join groupe g on e.groupe = g.Codegrp
    where  m.CodeFlr = g.CodeFlr and e.matricule = mat and e.AnneeFr = anne and e.Etab = etab;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetFormateurSecteur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetFormateurSecteur`(anne varchar(8),etab varchar(25),p_secteur varchar(50))
BEGIN   
    SELECT  f.Matricule,f.Nom,f.Prenom,f.Type,f.MassHoraire,concat(f.secteur,"-",s.DescpSect) as secteur  FROM secteur s
		inner join filiere fi on fi.CodeSect=s.CodeSect
		inner join groupe g on g.CodeFlr=fi.CodeFlr 
        inner join emploireel e on e.CodeGrp=g.CodeGrp
        INNER JOIN Formateur f ON f.matricule=e.Matricule
        WHERE AnneeFr=anne AND e.CodeEtb=etab AND fi.CodeSect=p_secteur
        GROUP BY f.matricule;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetGroupFormateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetGroupFormateur`(mat varchar(50),cdetb varchar(50),an varchar(4))
BEGIN
	SELECT DISTINCT Groupe FROM affectmodule WHERE  Matricule = mat AND CodeEtab = cdetb AND an = AnneeFr;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetGroupFormateurSecteur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetGroupFormateurSecteur`(mat varchar(50),cdetb varchar(50),an varchar(4),secteur varchar(50))
BEGIN
	SELECT DISTINCT af.Groupe FROM affectmodule  af
    INNER JOIN groupe g ON g.CodeGrp=af.Groupe
    INNER JOIN filiere f ON f.CodeFlr=g.CodeFlr
    WHERE  af.Matricule = mat AND af.CodeEtab = cdetb AND an = af.AnneeFr AND f.CodeSect=secteur;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetSalleSecteur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetSalleSecteur`(codeEtb varchar(20),p_secteur varchar(30))
BEGIN
	 SELECT CodeSl,DescpSl,Type,secteur FROM  salle WHERE CodeEtab=CodeEtb and secteur=p_secteur;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetStagiairesbyGroupe` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetStagiairesbyGroupe`(grp VARCHAR(20),ann VARCHAR(10),etablissement VARCHAR(10))
begin 
	select * from Stagiaire where groupe = grp and AnneF = ann and Etab = etablissement;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GetURLforDelete` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetURLforDelete`(id_efm int)
begin 
	select url from EFM where id = id_efm;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Get_Info_Emploi` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Get_Info_Emploi`(anne varchar(4),cdetab varchar(10))
BEGIN
	SELECT f.Matricule,concat(f.nom,' ',f.prenom) as NomPr  FROM emploireel e 
        INNER JOIN Formateur f ON f.matricule=e.Matricule
        WHERE AnneeFr=anne AND e.CodeEtb=cdetab
        GROUP BY f.matricule;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Get_Info_EmploiSecteur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Get_Info_EmploiSecteur`(anne varchar(4),cdetab varchar(10),secteur varchar(50))
BEGIN
	SELECT f.Matricule,concat(f.nom,' ',f.prenom) as NomPr  FROM filiere fi 
		inner join groupe g on g.CodeFlr=fi.CodeFlr 
        inner join emploireel e on e.CodeGrp=g.CodeGrp
        INNER JOIN Formateur f ON f.matricule=e.Matricule
        WHERE AnneeFr=anne AND e.CodeEtb=cdetab AND fi.CodeSect=secteur
        GROUP BY f.matricule;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Get_salle_dispo_Emploi` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Get_salle_dispo_Emploi`(jour varchar(10),Seanc varchar(4),anne varchar(4),cdetab varchar(10))
BEGIN
	SELECT s.codesl,s.DescpSl FROM salle s WHERE s.codesl 
    NOT IN(SELECT e.codesl FROM emploidraft e WHERE e.Jour=jour AND e.Seance=Seanc AND e.AnneeFr=anne)
	AND s.CodeEtab=cdetab
	GROUP BY s.codesl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GroupeAffecterByFormateurAnneeEtab` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GroupeAffecterByFormateurAnneeEtab`(mat varchar(15),annee varchar(10),etab varchar(15))
begin 
	select distinct Groupe from affectmodule where  matricule = mat and AnneeFr = annee and CodeEtab = etab;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GroupeNonAbsence` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GroupeNonAbsence`(dtd date,dtf date,
tp VARCHAR(10),ann VARCHAR(10),etablissement VARCHAR(20),sea varchar(10))
begin 
	if sea = "choisir" then
		SELECT distinct a.Groupe 
		from stagiaire a
		where groupe not in 
		(select distinct groupe from absencestagiaire ab
		where ab.AnneFr = ann and ab.etab = etablissement  and ab.type = tp
		and ab.DateAbsenece >= dtd and ab.DateAbsenece <= dtf)
		and a.etab = etablissement;
    else
		SELECT distinct a.Groupe 
		from stagiaire a
		where groupe not in 
		(select distinct groupe from absencestagiaire ab
		where ab.AnneFr = ann and ab.etab = etablissement and ab.seance = sea and ab.type = tp
		and ab.DateAbsenece >= dtd and ab.DateAbsenece <= dtf)
		and a.etab = etablissement;
    end if;
	
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GroupeNonEmploi` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GroupeNonEmploi`(Etab varchar(15),An varchar(4))
begin 
	select * from groupe  where CodeEtab = Etab and codegrp not in (select distinct codegrp from emploireel where CodeEtb = Etab and AnneeFr = An);
	-- and codegrp not in (select codegrp from groupe where codegrp not in (select distinct groupe from stagiaire));
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_GroupesNonTermineAffectation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GroupesNonTermineAffectation`(et varchar(15),An varchar(4))
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
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_InsertFormateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertFormateur`(mat varchar(15),Nom varchar(25),Prenom varchar(25),CodeEtab varchar(25),tp varchar(25),MS Decimal(8,2)
,passwo varchar(255),sect varchar(15))
BEGIN 
	insert into formateur values (mat,Nom,Prenom,CodeEtab,tp,MS,passwo,sect);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_InsertGrp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_InsertGrp`(IN cdGrp VARCHAR(15),IN cdFl VARCHAR(15),IN cdEt VARCHAR(15),IN Ann VARCHAR(15),IN Fpa VARCHAR(1),taux int)
BEGIN
	INSERT INTO groupe VALUES (cdGrp,cdFl,cdEt,Ann,Fpa,taux);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_InsertModules` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertModules`(IN cdmd varchar(15),IN cdfl varchar(20),IN anne varchar(20),IN DescMd varchar(150),IN Pres Decimal(5,2),IN dis Decimal(5,2)
,IN sem1 Decimal(5,2),IN sem2 Decimal(5,2))
BEGIN 
	insert into Modules values (cdmd,cdfl,anne,DescMd,Pres,dis,sem1,sem2);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_InsertNiveau` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_InsertNiveau`(IN CodeNiv VARCHAR(15),IN DescpNiv VARCHAR(25))
BEGIN
	INSERT INTO Niveau VALUES (CodeNiv,DescpNiv);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_InsertSec` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_InsertSec`(IN cdSect VARCHAR(15),IN dscpSect VARCHAR(50))
BEGIN
	INSERT INTO Secteur VALUES (cdSect,dscpSect);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Meme_module_groupes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Meme_module_groupes`(cdmdl varchar(10),mat varchar(10),jr varchar(10),sc varchar(1),cdetb varchar(10) ,an varchar(4))
BEGIN
	SELECT Groupe FROM affectmodule 
    WHERE Groupe not in(SELECT CodeGrp FROM emploidraft WHERE Jour=jr AND Seance=sc)
    AND ModuleCode=cdmdl AND Matricule=mat  AND CodeEtab=cdetb AND anneefr=an;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ModifierCour` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModifierCour`(mat varchar(15),mdl varchar(80),sal varchar(80),grp varchar(15),jr varchar(10),Sc varchar(2),Cdetb varchar(15),an varchar(4))
BEGIN
	if(select count(CodeGrp) from emploidraft where mat=Matricule AND  Jour=jr AND Seance=sc AND CodeEtb=Cdetb AND AnneeFr=an)=1 then
			UPDATE emploidraft SET CodeModule=mdl,CodeSl=sal  WHERE CodeGrp=grp AND Jour=jr AND Seance=sc AND CodeEtb=Cdetb AND AnneeFr=an;
	else
		select false as 'false' ;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ModuleAffecterByGroupeFormateurAnneeEtab` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModuleAffecterByGroupeFormateurAnneeEtab`(mat varchar(25),annee varchar(10),etab varchar(15),grp varchar(25))
begin 
	select af.ModuleCode,m.DescpMd from modules m inner join 
    affectmodule af on m.CodeMd = af.ModuleCode
    inner join groupe g on af.groupe = g.Codegrp 
    where  af.matricule = mat and af.AnneeFr = annee and af.CodeEtab = etab and af.groupe = grp and m.CodeFlr = g.CodeFlr
    and af.ModuleCode not in (select distinct module from EFM 
    where matricule = mat and AnneeFr = annee and Etab = etab and groupe = grp);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ModuleAffecter_Formateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModuleAffecter_Formateur`(mat varchar(20),codetab varchar(10),anne varchar(4))
BEGIN
	SELECT 
		 af.Groupe,m.descpMd,m.s1,m.s2,m.Pr,m.Dist,m.CodeMd,af.anneefr,m.codeflr,g.Fpa,g.taux as tauxfpaGrp 
		 ,g.annee,af.avc,af.efm,(af.avc/(m.s1 + m.s2))*100 as taux
	FROM groupe g INNER JOIN affectmodule af ON af.Groupe=g.codegrp
	INNER JOIN modules m ON m.CodeMd = af.ModuleCode
	WHERE af.Matricule = mat AND af.CodeEtab = codetab
	AND af.AnneeFr = anne AND m.codeflr=g.codeflr;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ModuledeGoupaformateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModuledeGoupaformateur`(mat varchar(30),grp varchar(25),etb varchar(50), an varchar(4))
BEGIN
select m.DescpMd,m.CodeMd,af.Matricule,af.Groupe from groupe g 
inner join affectmodule af
on af.Groupe=g.CodeGrp
inner join modules m 
on m.CodeMd=af.ModuleCode
where af.Matricule=mat AND g.CodeGrp=grp AND g.CodeFlr=m.CodeFlr AND af.CodeEtab=etb AND af.AnneeFr=an ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_moduleNoaffeceted` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_moduleNoaffeceted`(codgrp varchar(30),anne_scolaire varchar(4),etab varchar(10),codflr varchar(25),anne_formation varchar(1))
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_Module_in_emploi` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Module_in_emploi`(mat varchar(20),grp varchar(20),cdmd varchar(20),an varchar(4),cdtb varchar(20))
begin
	declare bol bool default false;
	select true into bol from affectmodule af where af.ModuleCode not in 
    (select codeModule from Emploidraft where codegrp=grp and matricule=mat and CodeEtab=cdtb and AnneeFr=an and codemodule=cdmd )
    and 
    af.ModuleCode not in 
    (select codeModule from emploireel where codegrp=grp and matricule=mat and CodeEtab=cdtb and AnneeFr=an and codemodule=cdmd )
    
    and af.groupe=grp and  af.matricule=mat  and af.ModuleCode=cdmd and af.CodeEtab=cdtb and af.AnneeFr=an;
    select bol;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_Module_trans_new_formateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Module_trans_new_formateur`(newmat varchar(20),mat varchar(20),grp varchar(20),cdmd varchar(20),an varchar(4),cdtb varchar(20))
begin
	update affectmodule   set matricule=newmat 
    where  groupe=grp and  matricule=mat  and ModuleCode=cdmd and CodeEtab=cdtb and AnneeFr=an;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_mois` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_mois`(cd varchar(10),an varchar(4))
BEGIN
	select Mois FROM emploiarchive WHERE  AnneeFr=an AND CodeEtb=cd GROUP BY Mois;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_NbFormateurByEtab` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NbFormateurByEtab`(etablissemnet varchar(15))
begin 
	select count(*) from formateur where CodeEtab = etablissemnet;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_NbGroupeByEtab` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NbGroupeByEtab`(etablissemnet varchar(15))
begin 
	select count(*) from Groupe where CodeEtab = etablissemnet;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_NbGroupeNonEmploi` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NbGroupeNonEmploi`(Etab varchar(15),An varchar(4))
begin 
	select count(*) from groupe  where CodeEtab = Etab and codegrp not in (select distinct codegrp from emploireel where CodeEtb = Etab and AnneeFr = An) and 
	codegrp not in (select codegrp from groupe where codegrp not in (select distinct groupe from stagiaire));
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_NbGroupeSansStagiaire` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NbGroupeSansStagiaire`(et varchar(15),An varchar(4))
begin 
	select codegrp from groupe 
    where CodeEtab = et and codegrp not in (select distinct groupe from stagiaire where Etab = et and AnneF = An);
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_NBGroupesNonTermineAffectation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NBGroupesNonTermineAffectation`(et varchar(15),An varchar(4))
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
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_NbModuleByAnne` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NbModuleByAnne`(an int)
begin 
	select count(*) from Modules where Annee = an;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_NbSalleByEtab` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NbSalleByEtab`(etablissemnet varchar(15))
begin 
	select count(*) from Salle where CodeEtab = etablissemnet;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_NbStagiaireByEtabAnne` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NbStagiaireByEtabAnne`(etablissemnet varchar(15),An varchar(4))
begin 
	select count(*) from Stagiaire where Etab = etablissemnet and AnneF = An;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_NomPrenomFormateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NomPrenomFormateur`(mat varchar(30))
BEGIN
	select concat(nom," ",prenom) from formateur where matricule = mat;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RechercherGlobal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RechercherGlobal`(information text,CurrentTable VARCHAR(2),etablissement VARCHAR(20))
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RechercherGlobalSecteur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RechercherGlobalSecteur`(information VARCHAR(50),CurrentTable VARCHAR(2),atablissement VARCHAR(20),sect varchar(30))
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
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Sp_recupererEfm` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_recupererEfm`(p_id_efm int)
BEGIN
	SELECT date_passation, bareme, salle_examen, duree, structure_examen, degre_difficulte, deux_variantes, corrige_depose,Decision
	FROM ExamValider where id_efm=p_id_efm;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ReinitialiserMotepasse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ReinitialiserMotepasse`(mat varchar(25),md varchar(250),etab varchar(25))
BEGIN
	UPDATE user
	INNER JOIN personnel ON user.CodeUser = personnel.CodeUser
	SET user.mdp =md
	WHERE personnel.Matricule = mat and personnel.CodeEtab=etab;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Remarque` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Remarque`(mat varchar(40),grp varchar(30),md varchar(20),rm text,etb varchar(20),an varchar(4))
BEGIN
	update efm set Remarque=rm where Matricule=mat and groupe=grp and module=md and Etab=etb and  Anneefr=an;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Seance_Formateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Seance_Formateur`(frm varchar(15),Jou varchar(15),Snc varchar(15),Etab varchar(15),An varchar(15))
begin 
	select E.CodeGrp,E.TypeSc,E.CodeSl,m.DescpMd 
    from Groupe g inner join EmploiReel E using(CodeGrp)
    inner join modules m on E.CodeModule = m.CodeMd 
    where E.Jour = Jou and E.Matricule = frm and E.Seance = Snc and E.CodeEtb = Etab and E.AnneeFr = An 
    and g.CodeFlr = m.CodeFlr;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Seance_Groupe` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Seance_Groupe`(grp varchar(15),Jou varchar(15),Snc varchar(15),Etab varchar(15),An varchar(15))
begin 
	select concat(F.Nom," ",F.Prenom),E.TypeSc,E.CodeSl,m.descpMd
	from formateur F inner join EmploiReel E using(Matricule)
	inner join Groupe g using(CodeGrp)
	inner join modules m on g.CodeFlr = m.CodeFlr
    where E.Jour = Jou and E.CodeGrp = grp and E.Seance = Snc and E.CodeEtb = Etab and E.AnneeFr = An
    and E.CodeModule = m.CodeMd;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Seance_Salle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Seance_Salle`(CodeSalle varchar(15),Jou varchar(15),Snc varchar(15),Etab varchar(15),An varchar(15))
begin 
	select concat(F.Nom," ",F.Prenom),E.CodeGrp,m.descpMd 
	from formateur F inner join EmploiReel E using(Matricule)
	inner join Groupe g using(CodeGrp)
	inner join modules m on g.CodeFlr = m.CodeFlr
    where E.CodeSl = CodeSalle and E.Jour = Jou  and E.Seance = Snc and E.CodeEtb = Etab and E.AnneeFr = An and E.CodeModule = m.CodeMd;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_SelectAllGrp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SelectAllGrp`(codetab varchar(10))
BEGIN
	SELECT g.CodeGrp,g.CodeFlr,g.Annee,g.Fpa,g.taux,f.CodeSect FROM Groupe g
    inner join filiere f using(CodeFlr)
    WHERE g.codeEtab=codetab;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_SelectAllNiveau` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SelectAllNiveau`()
BEGIN
	SELECT * FROM Niveau;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_SelectAllSec` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SelectAllSec`()
BEGIN
	SELECT * FROM Secteur;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_StagiaireNonAbsence` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_StagiaireNonAbsence`(dtd date,dtf date,grp varchar(20),
tp VARCHAR(10),ann VARCHAR(10),etablissement VARCHAR(20),sea varchar(10))
begin 
	if sea = "choisir" then
		SELECT cef,nom,prenom
		from stagiaire a
		where cef not in 
		(select distinct cef from absencestagiaire ab
		where ab.AnneFr = ann and ab.etab = etablissement  and ab.type = tp and ab.Groupe = grp 
		and ab.DateAbsenece >= dtd and ab.DateAbsenece <= dtf)
		and a.etab = etablissement
        and groupe = grp;
    else
		SELECT cef,nom,prenom
		from stagiaire a
		where cef not in 
		(select distinct cef from absencestagiaire ab
		where ab.AnneFr = ann and ab.etab = etablissement  and ab.type = tp and ab.Groupe = grp and ab.seance = sea
		and ab.DateAbsenece >= dtd and ab.DateAbsenece <= dtf)
		and a.etab = etablissement
        and groupe = grp;
    end if;
	
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_TauxAllFromrateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TauxAllFromrateur`(cdetb varchar(50),anne varchar(4))
BEGIN
	SELECT af.Matricule,concat(f.Nom,' ',f.prenom) as NomP,sum(m.s1)as s1,sum(m.s2) as s2,sum(m.s1+m.s2) as masshoraire,sum(af.avc) as avc,
	concat(ROUND((sum(af.avc)/sum(m.s1+m.s2))*100,2),' %') as taux  
	from formateur f,groupe g 
	inner join affectmodule af on g.CodeGrp=af.Groupe 
	inner join modules m on af.ModuleCode=m.CodeMd
	where  m.CodeFlr=g.CodeFlr AND f.Matricule=af.Matricule AND af.CodeEtab=cdetb AND af.AnneeFr=anne
	GROUP BY af.matricule
	order by NomP ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_TauxAvancementByEtab` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TauxAvancementByEtab`(etab varchar(20),anne varchar(20))
begin
	select sum(avc) / (sum(s1) + sum(s2)) * 100 from groupe g inner join affectmodule af on af.Groupe = g.Codegrp
	inner join modules m on m.CodeMd = af.ModuleCode
	where g.CodeFlr = m.CodeFlr and af.AnneeFr = anne and af.CodeEtab = etab;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_TauxAvancementByEtabAnneF` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TauxAvancementByEtabAnneF`(etab varchar(20),ann varchar(10))
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
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_taux_Avencement_Module` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_taux_Avencement_Module`(taux double,filtre varchar(10),anne varchar(10),etab varchar(10))
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

end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_TopAbsenceStagiaire` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TopAbsenceStagiaire`(dtd date,dtf date,tp VARCHAR(10),ann VARCHAR(10),etablissement VARCHAR(20))
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
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_TotalAbsenceFormateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TotalAbsenceFormateur`(etablissemnet varchar(15),An varchar(4))
begin 
	select count(*) from absenceformateur where etab = etablissemnet and AnneFr = An;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_TotalAbsenceStg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TotalAbsenceStg`(etablissemnet varchar(15),An varchar(4))
begin 
	select count(*) from absencestagiaire where etab = etablissemnet and AnneFr = An;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_UpdateFormateur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UpdateFormateur`(IN mat varchar(15),IN Nm varchar(25),IN Pr varchar(25),
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_UpdateGrp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UpdateGrp`(IN cdGrp VARCHAR(15),IN cdEtab VARCHAR(15),IN cdFl VARCHAR(15),IN Ann VARCHAR(15),IN Fpa VARCHAR(1),taux int)
BEGIN
	UPDATE Groupe g SET g.codeFlr = cdFl,g.Annee = Ann,	g.Fpa = Fpa,	g.taux = taux
    WHERE g.CodeGrp = cdGrp and g.CodeEtab = cdEtab;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_UpdateModules` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UpdateModules`(IN cdmd varchar(15),IN cdfl varchar(20),IN anne varchar(20),IN DescMd varchar(150),IN Pres Decimal(5,2),IN dis Decimal(5,2)
,IN sem1 Decimal(5,2),IN sem2 Decimal(5,2))
BEGIN 
	Update Modules m set
    m.Annee = anne,
    m.DescpMd = DescMd,
    m.Pr = Pres,
    m.Dist = dis,
    m.s1 = sem1,
    m.s2 = sem2
    where m.CodeMd = cdmd and codeflr = cdfl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_UpdateNiv` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UpdateNiv`(IN cod VARCHAR(15),IN dsc VARCHAR(25))
BEGIN
	UPDATE Niveau
    SET DescpNiv = dsc
	WHERE CodeNiv = cod;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_UpdateSec` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UpdateSec`(IN cdSect VARCHAR(15),IN cdDescp VARCHAR(50))
BEGIN
	UPDATE Secteur s
    SET
        s.DescpSect = cdDescp
	WHERE
		s.CodeSect = cdSect;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_UpdateSurveille` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UpdateSurveille`(mat varchar(25),nm varchar(30),pre varchar(30),etab varchar(25),p_poste varchar(30))
BEGIN
	update personnel set nom=nm ,prenom=pre,Poste=p_poste where CodeEtab=etab AND Matricule=mat;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Update_filiere` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Update_filiere`(CdFl VARCHAR(15),DescrpFl VARCHAR(50),CdSt VARCHAR(15),Nv VARCHAR(15))
BEGIN
	 UPDATE filiere 
SET 
    DescpFlr = DescrpFl,
    CodeSect = CdSt,
    Niveau = Nv
WHERE
    CodeFlr = CdFl ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Update_Salle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Update_Salle`(CdSal VARCHAR(15),DescrpSal VARCHAR(50),Typ VARCHAR(15),CdEtab VARCHAR(15),sect VARCHAR(15))
BEGIN
	 UPDATE salle 
SET 
    DescpSl = DescrpSal,
    Type = Typ,
    secteur = sect
WHERE
    CodeSl = CdSal AND CodeEtab = CdEtab;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Utiliser_Emploi` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Utiliser_Emploi`(moiis varchar(2))
BEGIN
	
    DELETE FROM emploireel WHERE 1=1;
    INSERT INTO emploireel SELECT * FROM emploidraft ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-18 22:37:51
