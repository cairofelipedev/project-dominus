/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.19-MariaDB : Database - dominus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `banners` */

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(200) DEFAULT NULL,
  `data_create` timestamp NULL DEFAULT current_timestamp(),
  `nome` varchar(200) DEFAULT NULL,
  `img2` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `banners` */

insert  into `banners`(`id`,`img`,`data_create`,`nome`,`img2`) values 
(4,'banner-Banner2.jpeg','2021-04-08 22:43:31','Banner 2','banner2-Banner2.jpeg');

/*Table structure for table `categorys` */

DROP TABLE IF EXISTS `categorys`;

CREATE TABLE `categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `categorys` */

insert  into `categorys`(`id`,`nome`,`tipo`) values 
(1,'Categoria Teste','produto'),
(2,'CATEGORIA TESTE 2','blog');

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `cpf_cnpj` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` varchar(500) DEFAULT NULL,
  `whats` varchar(100) DEFAULT NULL,
  `telefone2` varchar(100) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `id_estadual` varchar(50) DEFAULT NULL,
  `data_nascimento` varchar(50) DEFAULT NULL,
  `arq1` varchar(200) DEFAULT NULL,
  `nome_arq1` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`nome`,`cpf_cnpj`,`email`,`endereco`,`whats`,`telefone2`,`tipo`,`user_create`,`id_estadual`,`data_nascimento`,`arq1`,`nome_arq1`) values 
(181,'Cairo Felipe','','cairoofelipe@gmail.com',NULL,'86999069329','','CPF','Cairo Felipe',NULL,NULL,'CairoFelipe-arquivo1.png','teste'),
(182,'Cairo Felipe','','cairoofelipe@gmail.com',NULL,'86999069329','','CPF','Cairo Felipe',NULL,NULL,'CairoFelipe-arquivo1.png','teste'),
(183,'Cairo Felipe','072.546.683-95','cairoofelipe@gmail.com',NULL,'86999069329','86999069329','CPF','Cairo Felipe',NULL,NULL,NULL,'teste'),
(184,'Cairo Felipe','072.546.683-95','cairoofelipe@gmail.com','Quadra 14 Mocambinho 1 - Setor B','86999069329','86999069329','CPF','Cairo Felipe',NULL,NULL,NULL,'teste'),
(185,'Cairo Felipe','072.546.683-95','cairoofelipe@gmail.com','Quadra 14 Mocambinho 1 - Setor B','86999069329','86999069329','CPF','Cairo Felipe','000000','07/02/1998','CairoFelipe-arquivo1.png','Cairo Felipe');

/*Table structure for table `colors` */

DROP TABLE IF EXISTS `colors`;

CREATE TABLE `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `colors` */

insert  into `colors`(`id`,`cor`) values 
(1,'AZUL'),
(2,'AMARELO'),
(3,'VERMELHO'),
(4,'VERDE');

/*Table structure for table `forms` */

DROP TABLE IF EXISTS `forms`;

CREATE TABLE `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `whats` varchar(50) DEFAULT NULL,
  `opc` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mensagem` varchar(1000) DEFAULT NULL,
  `data_envio` timestamp NULL DEFAULT current_timestamp(),
  `dv` varchar(100) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `user_vz` varchar(100) DEFAULT NULL,
  `data_vz` varchar(100) DEFAULT NULL,
  `user_ok` varchar(100) DEFAULT NULL,
  `data_ok` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `forms` */

insert  into `forms`(`id`,`nome`,`whats`,`opc`,`email`,`mensagem`,`data_envio`,`dv`,`tipo`,`status`,`user_vz`,`data_vz`,`user_ok`,`data_ok`) values 
(36,'Cairo Felipe','86999069329',NULL,'cairoofelipe@gmail.com','teste','2021-04-17 11:17:03','','1','1',NULL,NULL,NULL,NULL),
(37,'Cairo Felipe','86999069329',NULL,NULL,NULL,'2021-04-17 11:17:12','','2','1',NULL,NULL,NULL,NULL),
(38,'Cairo Felipe dos Reis Machado','(86) 99963-3288',NULL,'cairofelipedev@gmail.com','teste','2021-06-01 10:25:35','<br />\r\n<b>Warning</b>:  Undefined variable $dv in <b>C:\\xampp\\htdocs\\cairo\\project-dominus\\busca.ph','1','1',NULL,NULL,NULL,NULL);

/*Table structure for table `logs1` */

DROP TABLE IF EXISTS `logs1`;

CREATE TABLE `logs1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1727 DEFAULT CHARSET=utf8;

/*Data for the table `logs1` */

insert  into `logs1`(`id`,`nome`,`data_hora`,`tipo`) values 
(1702,'','2021-04-07 21:34:38','login'),
(1703,'Cairo Felipe','2021-04-07 21:36:24','login'),
(1704,'Cairo Felipe','2021-04-07 21:51:39','login'),
(1705,'Cairo Felipe','2021-04-08 21:44:39','login'),
(1706,'Cairo Felipe','2021-04-08 21:45:18','login'),
(1707,'Cairo Felipe','2021-04-08 21:45:37','login'),
(1708,'Cairo Felipe','2021-04-08 21:46:07','login'),
(1709,'Cairo Felipe','2021-04-08 21:46:26','login'),
(1710,'Cairo Felipe','2021-04-08 21:46:41','login'),
(1711,'Cairo Felipe','2021-04-08 21:47:13','login'),
(1712,'Cairo Felipe','2021-04-08 21:47:59','login'),
(1713,'Cairo Felipe','2021-04-08 21:48:07','login'),
(1714,'Cairo Felipe','2021-04-09 22:04:26','login'),
(1715,'Cairo Felipe','2021-04-09 22:06:27','login'),
(1716,'Cairo Felipe','2021-04-09 22:06:43','login'),
(1717,'Cairo Felipe','2021-04-14 22:49:53','login'),
(1718,'Cairo Felipe','2021-04-17 11:06:52','login'),
(1719,'Cairo Felipe','2021-04-17 11:17:27','login'),
(1720,'Cairo Felipe','2021-04-17 11:51:56','login'),
(1721,'Cairo Felipe','2021-04-30 21:00:50','login'),
(1722,'Cairo Felipe','2021-05-03 20:20:14','login'),
(1723,'Cairo Felipe','2021-05-31 20:57:50','login'),
(1724,'Cairo Felipe','2021-06-01 07:35:06','login'),
(1725,'Cairo Felipe','2021-06-01 09:42:22','login'),
(1726,'Cairo Felipe','2021-06-01 10:40:48','login');

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) DEFAULT NULL,
  `sub_titulo` varchar(400) DEFAULT NULL,
  `texto_1` varchar(1000) DEFAULT NULL,
  `texto_2` varchar(1000) DEFAULT NULL,
  `texto_3` varchar(1000) DEFAULT NULL,
  `texto_4` varchar(1000) DEFAULT NULL,
  `img1` varchar(200) DEFAULT NULL,
  `img2` varchar(200) DEFAULT NULL,
  `img3` varchar(200) DEFAULT NULL,
  `categoria_1` varchar(100) DEFAULT NULL,
  `categoria_2` varchar(100) DEFAULT NULL,
  `categoria_3` varchar(100) DEFAULT NULL,
  `data_criacao` timestamp NULL DEFAULT current_timestamp(),
  `data_update` varchar(50) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `posts` */

insert  into `posts`(`id`,`titulo`,`sub_titulo`,`texto_1`,`texto_2`,`texto_3`,`texto_4`,`img1`,`img2`,`img3`,`categoria_1`,`categoria_2`,`categoria_3`,`data_criacao`,`data_update`,`autor`) values 
(1,'texto grande no blog em 20019','Teste Sub','tedasdasdasdasdas','tadasdasdsa','tedsadsadasdsad','tadasdasdasdas','texto grande no blog em 200191.jpeg','texto grande no blog em 200192.jpeg','texto grande no blog em 200193.jpeg','CATEGORIA TESTE 2','CATEGORIA TESTE 2','CATEGORIA TESTE 2','2021-06-01 01:04:40',NULL,'Cairo Felipe');

/*Table structure for table `produtos` */

DROP TABLE IF EXISTS `produtos`;

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `data_add` timestamp NOT NULL DEFAULT current_timestamp(),
  `descricao` varchar(2000) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `img2` varchar(200) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `img3` varchar(200) DEFAULT NULL,
  `img4` varchar(200) DEFAULT NULL,
  `img5` varchar(200) DEFAULT NULL,
  `img6` varchar(200) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `cod` varchar(50) DEFAULT NULL,
  `altura` varchar(50) DEFAULT NULL,
  `profu` varchar(50) DEFAULT NULL,
  `largura` varchar(50) DEFAULT NULL,
  `cor1` varchar(50) DEFAULT NULL,
  `cor2` varchar(50) DEFAULT NULL,
  `cor3` varchar(50) DEFAULT NULL,
  `cor4` varchar(50) DEFAULT NULL,
  `cor5` varchar(50) DEFAULT NULL,
  `desconto` varchar(50) DEFAULT NULL,
  `valor_desconto` varchar(50) DEFAULT NULL,
  `peso` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `produtos` */

/*Table structure for table `quem_somos` */

DROP TABLE IF EXISTS `quem_somos`;

CREATE TABLE `quem_somos` (
  `home` varchar(500) DEFAULT NULL,
  `text_intro` varchar(500) DEFAULT NULL,
  `texto1` varchar(500) DEFAULT NULL,
  `texto2` varchar(500) DEFAULT NULL,
  `texto3` varchar(500) DEFAULT NULL,
  `texto4` varchar(1000) DEFAULT NULL,
  `texto5` varchar(500) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `quem_somos` */

insert  into `quem_somos`(`home`,`text_intro`,`texto1`,`texto2`,`texto3`,`texto4`,`texto5`,`id`) values 
('Localizada Teresina, PiauÃ­, a Distribuidora Dominus Ã© uma empresa especializada em equipamentos para agropecuÃ¡ria (kits de irrigaÃ§Ã£o, itens para apicultura), embalagens, utensÃ­lios domÃ©sticos e decoraÃ§Ã£o de casa.','Somos muito mais que uma distribuidora, somos a Dominus. Nascemos de um sonho para desenvolver e melhorar os negÃ³cios no PiauÃ­ e Brasil. Acreditamos que podemos fomentar o desenvolvimento da nossa economia gerando oportunidades de negÃ³cios para todos.','Com um profundo conhecimento logÃ­sticos de comÃ©rcio internacional e nacional, com mais de 30 anos com atuaÃ§Ã£o no segmento, desenvolvemos uma rede de parceiros e fornecedores localizados no Brasil, Ãsia, em todos os continentes, para oferecer serviÃ§os e facilitar o acesso a produtos e equipamentos para inovaÃ§Ã£o e geraÃ§Ã£o de valor para nossos clientes.','A Dominus Ã© definida pelos seus valores:\r\nIntegridade. CooperaÃ§Ã£o. InovaÃ§Ã£o. ExcelÃªncia. Simplicidade. Vontade de resolver problemas. O ideal de fazer o bem ao mundo.','Desde a nossa concepÃ§Ã£o, temos por objetivo atuar com empreendedores, donos de organizaÃ§Ãµes e consumidores para facilitar o acesso a produtos e serviÃ§os logÃ­sticos, para o motor de desenvolvimento econÃ´mico e social, nas mÃ£os do maior nÃºmero possÃ­vel de pessoas. Nossas portas estÃ£o e estarÃ£o abertas Ã s pessoas com brilho nos olhos, vontade e coraÃ§Ã£o aberto, independente de suas origens, posiÃ§Ã£o social ou decisÃµes pessoais.','Nosso comprometimento Ã© com uma cultura de qualidade, foco no cliente, que assume os riscos de melhorias contÃ­nuas e incentiva a criatividade, a lideranÃ§a, e, principalmente, o espÃ­rito empreendedor. Encorajamos pessoas a tomarem iniciativa, agirem e fazerem a diferenÃ§a. NÃ£o importa onde vocÃª esteja, vocÃª pode ser um parceiro e cliente da DOMINUS.','Esse Ã© um convite ao empreendedorismo e co-criaÃ§Ã£o.\r\n\r\nCom carinho,\r\n\r\nDominus Distribuidora',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `whats` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`login`,`email`,`pass`,`type`,`whats`,`img`,`user_create`) values 
(1,'Cairo Felipe','admin','cairofelipedev@gmail.com','',2,'86999069329','-edit1.jpeg',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
