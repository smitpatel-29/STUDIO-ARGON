-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: 127.0.0.1    Database: starlitc_studio_argon
-- ------------------------------------------------------
-- Server version	9.6.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `starlitc_studio_argon`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `starlitc_studio_argon` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `starlitc_studio_argon`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('Owner','Admin') DEFAULT 'Admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','$2y$10$i4FGvbyvLDmXJdsRYu55ie25WZIX2HLZG.cVa9qO1i2xeh1DU1Pyq','admin@studioargon.com','Systems Admin','Owner','2026-03-30 13:46:04'),(2,'admin123','$2y$10$ZWP33MjCVo6Idk7lzLFXnOXI.8L6EHuobe4TBGayPCodPExabkHrm','work.adarsh@yahoo.com','Adarsh Baraiya','Admin','2026-03-31 08:20:27');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Interior Design','interior-design'),(2,'Architecture','architecture'),(3,'Industry Trends','industry-trends');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `date` varchar(50) NOT NULL,
  `excerpt` text,
  `image` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `author_img` varchar(255) NOT NULL,
  `content` longtext,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,'How Strong Brand Identity Drives Real Estate Sales in 2025','how-strong-brand-identity-drives-real-estate-sales-in-2025','Mar 15, 2025','Discover how compelling architectural visualization directly impacts pre-construction unit sales and investor confidence in today\'s competitive market.','assets/uploads/blog/featured_brand.jpg','industry-trends','Industry Trends','Alex Morgan','assets/uploads/avatar_julian.jpg','Discover how compelling architectural visualization directly impacts pre-construction unit sales and investor confidence in today\'s competitive market.Discover how compelling architectural visualization directly impacts pre-construction unit sales and investor confidence in today\'s competitive market.Discover how compelling architectural visualization directly impacts pre-construction unit sales and investor confidence in today\'s competitive market.Discover how compelling architectural visualization directly impacts pre-construction unit sales and investor confidence in today\'s competitive market.','2026-03-30 13:46:04'),(2,'Top 10 3D Rendering Software Tools for Architects','top-10-3d-rendering-software-tools-for-architects','Feb 28, 2025','A comprehensive comparison of the leading 3D rendering tools available in 2025 — from beginner-friendly platforms to professional-grade powerhouses.','assets/uploads/blog/tools_architect.jpg','software-guides','Software Guides','Priya Sharma','assets/uploads/avatar_sarah.jpg',NULL,'2026-03-30 13:46:04'),(3,'Case Study: Luxury Villa Project from Blueprint to Final Render','case-study-luxury-villa-project-from-blueprint-to-final-render','Feb 10, 2025','Behind the scenes of one of our most ambitious residential projects — from the first CAD file to the final photorealistic render delivered to the client.','assets/uploads/blog/villa_case_study.jpg','case-studies','Case Studies','David Chen','assets/uploads/avatar_marc.jpg',NULL,'2026-03-30 13:46:04'),(4,'V-Ray vs Corona Renderer: Which is Better for Architectural Visualization?','v-ray-vs-corona-renderer-which-is-better-for-architectural-visualization-','Jan 22, 2025','An honest, in-depth technical comparison of the two industry-leading render engines, evaluated on quality, speed, and ease of use for architectural projects.','assets/uploads/blog/vray_corona.jpg','rendering-tips','Rendering Tips','Priya Sharma','assets/uploads/avatar_sarah.jpg',NULL,'2026-03-30 13:46:04'),(5,'How 3D Walkthroughs Are Changing Pre-Construction Marketing','how-3d-walkthroughs-are-changing-pre-construction-marketing','Jan 08, 2025','Interactive virtual tours are replacing physical show homes for savvy developers. We explore the data behind this shift and its impact on buyer engagement.','assets/uploads/blog/walkthrough_marketing.jpg','industry-trends','Industry Trends','Alex Morgan','assets/uploads/avatar_julian.jpg',NULL,'2026-03-30 13:46:04'),(6,'5 Common Mistakes Architects Make When Briefing a Rendering Studio','5-common-mistakes-architects-make-when-briefing-a-rendering-studio','Dec 18, 2024','After 10 years of client projects, we\'ve identified the five briefing mistakes that cause delays, unexpected costs, and disappointing results — and how to avoid them.','assets/uploads/blog/briefing_mistakes.jpg','rendering-tips','Rendering Tips','Layla Hassan','assets/uploads/avatar_sarah.jpg',NULL,'2026-03-30 13:46:04'),(7,'Behind the Scenes: How We Rendered a 50-Floor Commercial Tower','behind-the-scenes-how-we-rendered-a-50-floor-commercial-tower','Dec 03, 2024','The technical and creative challenges of producing a full visual suite for one of the largest commercial tower projects in our studio\'s history.','assets/uploads/blog/tower_process.jpg','case-studies','Case Studies','David Chen','assets/uploads/avatar_marc.jpg',NULL,'2026-03-30 13:46:04'),(8,'The Future of Real Estate: VR and AR in Architectural Visualization','the-future-of-real-estate-vr-and-ar-in-architectural-visualization','Nov 20, 2024','How virtual and augmented reality are reshaping the way buyers experience properties — and what studios need to offer to stay competitive in this new landscape.','assets/uploads/blog/future_vr_ar.jpg','industry-trends','Industry Trends','Alex Morgan','assets/uploads/avatar_marc.jpg',NULL,'2026-03-30 13:46:04'),(9,'How to Prepare Your CAD Files for 3D Rendering','how-to-prepare-your-cad-files-for-3d-rendering','Nov 05, 2024','A step-by-step technical guide for architects and designers on how to prepare and export CAD files that speed up the visualization process and improve render quality.','assets/uploads/blog/cad_prep.jpg','software-guides','Software Guides','Priya Sharma','assets/uploads/avatar_sarah.jpg',NULL,'2026-03-30 13:46:04'),(11,'gvrdsgrhhd','gvrdsgrhhd','Mar 31, 2026','ngfgnfgnf','assets/uploads/about_studio.jpg','industry-trends','gngnfngfgnf','Systems Admin','assets/uploads/logo-2.png','https://cdpn.io/SyntaxSidekick/fullpage/MYepEOd?anon=true&amp;view=https://cdpn.io/SyntaxSidekick/fullpage/MYepEOd?anon=true&amp;view=https://cdpn.io/SyntaxSidekick/fullpage/MYepEOd?anon=true&amp;view=https://cdpn.io/SyntaxSidekick/fullpage/MYepEOd?anon=true&amp;view=','2026-03-31 10:14:28');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL,
  `message` text,
  `status` enum('new','read','archived') DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'Adarsh Baraiya','work.adarsh@yahoo.com','+919512094425','3D Interior Rendering','hello','new','2026-03-31 07:55:30');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_clients`
--

DROP TABLE IF EXISTS `home_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `order_index` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_clients`
--

LOCK TABLES `home_clients` WRITE;
/*!40000 ALTER TABLE `home_clients` DISABLE KEYS */;
INSERT INTO `home_clients` VALUES (1,'GENSLER',NULL,0),(2,'SOM ARCHITECTS',NULL,0),(3,'PERKINS & WILL',NULL,0),(4,'HOK GROUP',NULL,0),(5,'ZAHA HADID',NULL,0),(6,'BIG ARCH',NULL,0),(7,'FOSTER + PARTNERS',NULL,0),(9,'Smit Marvaniya','assets/uploads/logo black.png',0);
/*!40000 ALTER TABLE `home_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_slides`
--

DROP TABLE IF EXISTS `home_slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_slides` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `button_text` varchar(50) DEFAULT 'Our Works',
  `button_link` varchar(255) DEFAULT 'portfolio.php',
  `order_index` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_slides`
--

LOCK TABLES `home_slides` WRITE;
/*!40000 ALTER TABLE `home_slides` DISABLE KEYS */;
INSERT INTO `home_slides` VALUES (1,'ULTIMATE PRECISION IN EVERY PIXEL',NULL,'assets/uploads/hero-new.png','Our Works','portfolio.php',0),(2,'CRAFTING FUTURE IN 3D VIZ',NULL,'assets/uploads/hero-slide-2.png','Get Quotation','portfolio.php',0),(3,'CINEMATIC STORYTELLING',NULL,'assets/uploads/hero-slide-3.png','Learn More','portfolio.php',0);
/*!40000 ALTER TABLE `home_slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_stats`
--

DROP TABLE IF EXISTS `home_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_stats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `value` int NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `order_index` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_stats`
--

LOCK TABLES `home_stats` WRITE;
/*!40000 ALTER TABLE `home_stats` DISABLE KEYS */;
INSERT INTO `home_stats` VALUES (1,'PROJECTS COMPLETED',850,NULL,0),(2,'HAPPY CLIENTS',120,NULL,0),(3,'YEARS EXPERIENCE',10,NULL,0),(4,'INDUSTRY AWARDS',15,NULL,0);
/*!40000 ALTER TABLE `home_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_testimonials`
--

DROP TABLE IF EXISTS `home_testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_testimonials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `client_role` varchar(100) DEFAULT NULL,
  `client_avatar` varchar(255) DEFAULT NULL,
  `testimonial` text NOT NULL,
  `order_index` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_testimonials`
--

LOCK TABLES `home_testimonials` WRITE;
/*!40000 ALTER TABLE `home_testimonials` DISABLE KEYS */;
INSERT INTO `home_testimonials` VALUES (1,'JULIAN V.','CHIEF ARCHITECT','assets/uploads/avatar_julian.jpg','\"Studio Argon\'s attention to detail is unmatched. They brought our vision to life with stunning realism.\"',0),(2,'SARAH L.','RE DEVELOPER','assets/uploads/avatar_sarah.jpg','\"The animation they produced helped us close the deal on our latest development project effortlessly.\"',0),(3,'MARC CHEN','INTERIOR DESIGNER','assets/uploads/avatar_marc.jpg','\"Fast, professional, and incredibly talented. They are our go-to for all 3D visualization needs.\"',0);
/*!40000 ALTER TABLE `home_testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `filesize` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'4d0625afa9d0cc586a01008ebfc65b5c.jpg','assets/uploads/4d0625afa9d0cc586a01008ebfc65b5c.jpg','jpg',46341,'2026-03-31 09:09:17'),(2,'dea295cd3489748a387a7ccfb069e012.jpg','assets/uploads/dea295cd3489748a387a7ccfb069e012.jpg','jpg',34704,'2026-03-31 09:09:54'),(3,'about_accent.jpg','assets/uploads/about_accent.jpg','jpg',55520,'2026-03-31 09:14:52'),(4,'about_main.jpg','assets/uploads/about_main.jpg','jpg',167135,'2026-03-31 09:14:52'),(5,'about_studio.jpg','assets/uploads/about_studio.jpg','jpg',109034,'2026-03-31 09:14:52'),(6,'avatar_julian.jpg','assets/uploads/avatar_julian.jpg','jpg',3855,'2026-03-31 09:14:52'),(7,'avatar_marc.jpg','assets/uploads/avatar_marc.jpg','jpg',3962,'2026-03-31 09:14:52'),(8,'avatar_sarah.jpg','assets/uploads/avatar_sarah.jpg','jpg',3300,'2026-03-31 09:14:52'),(9,'briefing_mistakes.jpg','assets/uploads/blog/briefing_mistakes.jpg','jpg',93076,'2026-03-31 09:14:52'),(10,'cad_prep.jpg','assets/uploads/blog/cad_prep.jpg','jpg',66336,'2026-03-31 09:14:52'),(11,'featured_brand.jpg','assets/uploads/blog/featured_brand.jpg','jpg',202717,'2026-03-31 09:14:52'),(12,'future_vr_ar.jpg','assets/uploads/blog/future_vr_ar.jpg','jpg',37248,'2026-03-31 09:14:52'),(13,'tools_architect.jpg','assets/uploads/blog/tools_architect.jpg','jpg',72246,'2026-03-31 09:14:52'),(14,'tower_process.jpg','assets/uploads/blog/tower_process.jpg','jpg',74678,'2026-03-31 09:14:52'),(15,'villa_case_study.jpg','assets/uploads/blog/villa_case_study.jpg','jpg',90630,'2026-03-31 09:14:52'),(16,'vray_corona.jpg','assets/uploads/blog/vray_corona.jpg','jpg',77916,'2026-03-31 09:14:52'),(17,'walkthrough_marketing.jpg','assets/uploads/blog/walkthrough_marketing.jpg','jpg',116636,'2026-03-31 09:14:52'),(18,'designinsight.png','assets/uploads/designinsight.png','png',782717,'2026-03-31 09:14:52'),(19,'exterior.png','assets/uploads/exterior.png','png',1011885,'2026-03-31 09:14:52'),(20,'future3d.png','assets/uploads/future3d.png','png',951363,'2026-03-31 09:14:52'),(21,'glass_pavilion.png','assets/uploads/glass_pavilion.png','png',1010837,'2026-03-31 09:14:52'),(22,'hero-new.png','assets/uploads/hero-new.png','png',78291,'2026-03-31 09:14:52'),(23,'hero-slide-2.png','assets/uploads/hero-slide-2.png','png',855037,'2026-03-31 09:14:52'),(24,'hero-slide-3.png','assets/uploads/hero-slide-3.png','png',942633,'2026-03-31 09:14:52'),(25,'lakeside.png','assets/uploads/lakeside.png','png',836804,'2026-03-31 09:14:52'),(26,'logo black.png','assets/uploads/logo black.png','png',48237,'2026-03-31 09:14:52'),(27,'logo-2.png','assets/uploads/logo-2.png','png',41465,'2026-03-31 09:14:52'),(28,'real_estate.png','assets/uploads/real_estate.png','png',1030515,'2026-03-31 09:14:52'),(29,'secondary-logo.png','assets/uploads/secondary-logo.png','png',50339,'2026-03-31 09:14:52'),(30,'service_animation.jpg','assets/uploads/service_animation.jpg','jpg',93079,'2026-03-31 09:14:52'),(31,'service_interior.jpg','assets/uploads/service_interior.jpg','jpg',77916,'2026-03-31 09:14:52'),(32,'david.jpg','assets/uploads/team/david.jpg','jpg',92019,'2026-03-31 09:14:52'),(33,'elena.jpg','assets/uploads/team/elena.jpg','jpg',50200,'2026-03-31 09:14:52'),(34,'marcus.jpg','assets/uploads/team/marcus.jpg','jpg',54527,'2026-03-31 09:14:52'),(35,'sarah.jpg','assets/uploads/team/sarah.jpg','jpg',27191,'2026-03-31 09:14:52');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `tools` text,
  `year` varchar(10) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio`
--

LOCK TABLES `portfolio` WRITE;
/*!40000 ALTER TABLE `portfolio` DISABLE KEYS */;
INSERT INTO `portfolio` VALUES (1,'THE GLASS PAVILION','exterior','assets/uploads/glass_pavilion.png','3ds Max, V-Ray, Photoshop','2025','A conceptual glass pavilion focusing on transparency and reflection within a natural forest setting.','2026-03-30 13:43:01'),(2,'MODERN ARCH','exterior','https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&q=80&w=1200','Corona Renderer, Sketcup, Railclone','2024','Contemporary residential architecture featuring bold geometric forms and sustainable materials.','2026-03-30 13:43:01'),(3,'LUXURY LOFT','interior','https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&q=80&w=1200','3ds Max, Corona, Forest Pack','2025','High-end industrial loft conversion with emphasis on raw materials and bespoke lighting fixtures.','2026-03-30 13:43:01'),(4,'MINIMALIST SUITE','interior','https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&q=80&w=1200','3ds Max, V-Ray, Lightroom','2024','A serene hotel suite design utilizing a monochromatic palette and natural wood textures.','2026-03-30 13:43:01'),(5,'CITYSCAPE FLYTHROUGH','animation','https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200','Unreal Engine 5, Premiere Pro','2026','Fast-paced cinematic flythrough of a planned urban development in a metropolitan business district.','2026-03-30 13:43:01');
/*!40000 ALTER TABLE `portfolio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_content`
--

DROP TABLE IF EXISTS `site_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_content` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_slug` varchar(50) NOT NULL,
  `section_slug` varchar(50) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `content` text,
  `image_url` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_section` (`page_slug`,`section_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_content`
--

LOCK TABLES `site_content` WRITE;
/*!40000 ALTER TABLE `site_content` DISABLE KEYS */;
INSERT INTO `site_content` VALUES (1,'home','hero','CRAFTING VISIONS INTO REALITY','Precision 3D rendering and cinematic storytelling for global architecture.','assets/uploads/hero-bg.jpg','2026-03-31 09:11:57'),(2,'home','welcome','WELCOME TO STUDIO ARGON','We are a boutique visualization studio based in Houston, specialzing in high-end architectural renders.','','2026-03-31 07:41:05'),(3,'about','hero','ABOUT US','Crafting visual excellence for global architecture since 2014.','https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=2070','2026-03-31 09:23:35'),(4,'about','mission','OUR MISSION','To provide architects and developers with the most photorealistic visualization tools to sell their vision.','','2026-03-31 07:41:05'),(5,'contact','hero','LET\'S TALK','Contact','https://images.unsplash.com/photo-1519643381401-22c77e60520e?auto=format&fit=crop&q=80&w=2070','2026-04-01 08:24:43'),(6,'contact','info','CONTACT INFO','Gujarat, India','','2026-04-01 08:27:50'),(7,'home','about_teaser','Visualizing Your Dreams','We are a premier 3D visualization studio dedicated to bringing architectural excellence to life. With over a decade of experience, we specialize in high-fidelity renderings and animations that captivate and convince.','assets/image/glass_pavilion.png','2026-04-01 08:17:31'),(8,'contact','details','hello@studioargon.com','+1 234 567 8901','','2026-04-01 08:26:05'),(9,'contact','enquiry','Request a <span class=\"highlight-red\">Quote</span>','ENQUIRY','','2026-04-01 08:52:46');
/*!40000 ALTER TABLE `site_content` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-01 14:24:35
