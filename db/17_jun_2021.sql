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
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `banners` */

insert  into `banners`(`id`,`img`,`data_create`,`nome`,`img2`,`link`) values 
(14,'banner-UD.png','2021-06-07 19:45:09','UD','banner2-UD.png','https://www.distribuidoradominus.com/busca.php?pesquisa=utilidades%20domesticas');

/*Table structure for table `categorys` */

DROP TABLE IF EXISTS `categorys`;

CREATE TABLE `categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `categorys` */

insert  into `categorys`(`id`,`nome`,`tipo`) values 
(5,'Utensílio Doméstico','produto');

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

/*Table structure for table `colors` */

DROP TABLE IF EXISTS `colors`;

CREATE TABLE `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cor` varchar(50) DEFAULT NULL,
  `valor_cor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `colors` */

insert  into `colors`(`id`,`cor`,`valor_cor`) values 
(2,'Amarelo','yellow'),
(3,'Vermelho','red'),
(6,'Preto','black'),
(7,'Branco','White'),
(9,'Azul','#0000FF');

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Data for the table `forms` */

insert  into `forms`(`id`,`nome`,`whats`,`opc`,`email`,`mensagem`,`data_envio`,`dv`,`tipo`,`status`,`user_vz`,`data_vz`,`user_ok`,`data_ok`) values 
(44,'Teste ligamos','86988400963',NULL,NULL,NULL,'2021-06-01 23:16:04','','2','1',NULL,NULL,NULL,NULL),
(45,'Teste botão ','86988400963',NULL,'cairofelipedev@gmail.com','teste','2021-06-01 23:16:23','','1','1',NULL,NULL,NULL,NULL),
(46,'teste email',NULL,NULL,'cairoodev@gmail.com',NULL,'2021-06-01 23:16:35','','3','1',NULL,NULL,NULL,NULL),
(47,'Teste celular ligamos','86988400963',NULL,NULL,NULL,'2021-06-01 23:19:12','','2','1',NULL,NULL,NULL,NULL),
(48,'Teste whats','86988400963',NULL,'cairoofelipe@gmail.com','Teste','2021-06-01 23:20:13','','1','1',NULL,NULL,NULL,NULL),
(49,'Teste celular email',NULL,NULL,'cairoofelipe@gmail.com',NULL,'2021-06-01 23:20:33','','3','1',NULL,NULL,NULL,NULL),
(50,'Teste novo','86999069329',NULL,NULL,NULL,'2021-06-02 14:37:27','','2','1',NULL,NULL,NULL,NULL),
(51,'Cairo Felipe dos Reis Machado','86999069329',NULL,'cairofelipedev@gmail.com','teste novo','2021-06-02 14:37:36','','1','1',NULL,NULL,NULL,NULL),
(52,'Cairo Felipe2',NULL,NULL,'cairoogamer@gmail.com',NULL,'2021-06-02 14:37:43','','3','1',NULL,NULL,NULL,NULL),
(53,'teste',NULL,NULL,'cairofelipedev@gmail.com',NULL,'2021-06-02 15:31:19','','3','1',NULL,NULL,NULL,NULL);

/*Table structure for table `logs1` */

DROP TABLE IF EXISTS `logs1`;

CREATE TABLE `logs1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1759 DEFAULT CHARSET=utf8;

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
(1726,'Cairo Felipe','2021-06-01 10:40:48','login'),
(1727,'Cairo Felipe','2021-06-01 11:42:03','login'),
(1728,'Cairo Felipe','2021-06-01 11:49:29','login'),
(1729,'Cairo Felipe','2021-06-01 11:54:21','login'),
(1730,'Cairo Felipe','2021-06-01 13:12:52','login'),
(1731,'Cairo Felipe','2021-06-01 13:45:07','login'),
(1732,'Cairo Felipe','2021-06-01 14:17:41','login'),
(1733,'Cairo Felipe','2021-06-01 14:40:47','login'),
(1734,'Cairo Felipe','2021-06-01 14:52:16','login'),
(1735,'Cairo Felipe','2021-06-01 14:52:37','login'),
(1736,'Cairo Felipe','2021-06-01 18:21:47','login'),
(1737,'Cairo Felipe','2021-06-01 20:46:14','login'),
(1738,'Cairo Felipe','2021-06-01 22:39:24','login'),
(1739,'Cairo Felipe','2021-06-01 23:13:00','login'),
(1740,'Cairo Felipe','2021-06-02 00:03:40','login'),
(1741,'Cairo Felipe','2021-06-02 07:36:51','login'),
(1742,'Cairo Felipe','2021-06-02 07:42:25','login'),
(1743,'Cairo Felipe','2021-06-02 14:35:04','login'),
(1744,'Cairo Felipe','2021-06-02 14:37:53','login'),
(1745,'Cairo Felipe','2021-06-02 15:04:50','login'),
(1746,'Cairo Felipe','2021-06-04 11:28:23','login'),
(1747,'Cairo Felipe','2021-06-04 12:48:42','login'),
(1748,'Cairo Felipe','2021-06-06 17:48:02','login'),
(1749,'Cairo Felipe','2021-06-06 18:20:42','login'),
(1750,'Cairo Felipe','2021-06-06 18:28:25','login'),
(1751,'Alexandre Barros','2021-06-07 09:45:19','login'),
(1752,'Alexandre Barros','2021-06-07 18:53:35','login'),
(1753,'Alexandre Barros','2021-06-07 19:47:44','login'),
(1754,'Alexandre Barros','2021-06-08 09:29:12','login'),
(1755,'Alexandre Barros','2021-06-08 15:43:59','login'),
(1756,'Alexandre Barros','2021-06-08 21:28:39','login'),
(1757,'Alexandre Barros','2021-06-09 23:15:53','login'),
(1758,'Alexandre Barros','2021-06-10 08:33:58','login');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `posts` */

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `produtos` */

insert  into `produtos`(`id`,`nome`,`data_add`,`descricao`,`img`,`img2`,`price`,`category`,`img3`,`img4`,`img5`,`img6`,`status`,`cod`,`altura`,`profu`,`largura`,`cor1`,`cor2`,`cor3`,`cor4`,`cor5`,`desconto`,`valor_desconto`,`peso`) values 
(19,'Máquina para Gaseificar Água Jet SodaStream ','2021-06-07 19:02:23','Um dos modelos clássicos da Sodastream que virou acessório indispensável em milhares de lares mundo afora. Basta instalar o cilindro de gás e rosquear a garrafa com água na máquina, e você estará pronto para produzir água com gás em segundos! Não se engane com seu tamanho compacto 45cm X 20cm X 20cm (AxLxP), nossas maquinas produzem até 60 litros de água, sem necessidade de energia elétrica. Faça água com gás do jeitinho que você mais gosta, com mais ou menos gás, com a Sodastream é você quem decide. Liberte-se de carregar fardos de água no mercado e economize espaço no seu armário.','MáquinaparaGaseificarÁguaJetSodaStream-img1.png','MáquinaparaGaseificarÁguaJetSodaStream-img2.png','599,00','Utensílio Doméstico','MáquinaparaGaseificarÁguaJetSodaStream-img3.png',NULL,'','','1','000001','','','','Azul','Preto','Branco','Amarelo','Vermelho','','599',''),
(20,'Máquina para Gaseificar Água Fizzi Sodastream','2021-06-07 19:10:37','Vencedor do prêmio Reddot design award, o design elegante da Fizzi é, por si só, uma peça de decoração que destacará qualquer cantinho da casa. Não se engane com seu tamanho compacto 43cm X 13cm X 20cm (AxLxP), nossas maquinas produzem até 60 litros de agua, sem necessidade de energia elétrica. Faça agua com gás do jeitinho que você mais gosta, com mais ou menos gás, com a Sodastream é você quem decide. Liberte-se de carregar fardos de agua no mercado e economize espaço no seu armário.','MáquinaparaGaseificarÁguaFizziSodastream-img1.png','MáquinaparaGaseificarÁguaFizziSodastream-img2.png','699,00','Utensílio Doméstico','MáquinaparaGaseificarÁguaFizziSodastream-img3.png','MáquinaparaGaseificarÁguaFizziSodastream-img4.png','MáquinaparaGaseificarÁguaFizziSodastream-img5.png',NULL,'1','000002','','','','BRANCA','PRETA','VERMELHO','BRANCA','BRANCA','','699',''),
(21,'Bomba De Agua Manual Por Pressao Para Galao até 20 litros','2021-06-09 23:21:17','- Bomba para galão de água de fácil instalação, basta colocar na boca do galão de água e ajustar.\r\n\r\n- Possui bico curvo evitando respingos e tampa para proteção do bico mantendo a higiene.\r\n\r\n- Cor: Azul e branco\r\n\r\n- Bomba de água por pressão.\r\n\r\n- Ideal para galões de até 20 Litros.\r\n\r\n- Fácil de instalar.\r\n\r\n- Fácil de usar.','BombaDeAguaManualPorPressaoParaGalaoaté20litros-img1.jpg','BombaDeAguaManualPorPressaoParaGalaoaté20litros-img2.jpeg','15,00','Utensílio Doméstico','BombaDeAguaManualPorPressaoParaGalaoaté20litros-img3.jpg',NULL,'','','1','000003','61','7','17','BRANCA E AZUL','BRANCA','BRANCA','BRANCA','BRANCA','','15',''),
(22,'Bebedouro Bomba Elétrica Para Garrafão Galão Água Recarregável','2021-06-09 23:32:29','Esqueça o Peso de Virar o galão no antigo bebedouro! Apresentamos uma forma diferente e simples, onde você pode levar a qualquer lugar e encaixar em qualquer modelo de galão tranquilamente.\r\nCarga: 3 Horas. Para Galões Até 20L\r\nMateriais seguros: Aço Inox 304, Plásticos (PP, ABS, EVA), Silicones, Alumínio, Bateria de Li-ion, Circuito eletrônico\r\nVoltagem: Bivolt 110V-220V\r\n','BebedouroBombaElétricaParaGarrafãoGalãoÁguaRecarregável-img1.jpg','BebedouroBombaElétricaParaGarrafãoGalãoÁguaRecarregável-img2.jpg','40,00','Utensílio Doméstico','BebedouroBombaElétricaParaGarrafãoGalãoÁguaRecarregável-img3.jpg','BebedouroBombaElétricaParaGarrafãoGalãoÁguaRecarregável-img4.jpg',NULL,'','1','000003','','','','BRANCA E AZUL','BRANCA E AZUL','BRANCA E AZUL','BRANCA E AZUL','','','40','Peso leve: 400gr, - Líquido = 300gr');

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
('','Somos muito mais que uma distribuidora, somos a Dominus. Nascemos de um sonho para desenvolver e melhorar os negócios no Piauí e Brasil. Acreditamos que podemos fomentar o desenvolvimento da nossa economia gerando oportunidades de negócios para todos.','Com um profundo conhecimento logísticos de comércio internacional e nacional, com mais de 30 anos com atuação no segmento, desenvolvemos uma rede de parceiros e fornecedores localizados no Brasil, Ásia, em todos os continentes, para oferecer serviços e facilitar o acesso a produtos e equipamentos para inovação e geração de valor para nossos clientes.','A Dominus é definida pelos seus valores:\r\nIntegridade. Cooperação. Inovação. Excelência. Simplicidade. Vontade de resolver problemas. O ideal de fazer o bem ao mundo.','Desde a nossa concepção, temos por objetivo atuar com empreendedores, donos de organizações e consumidores para facilitar o acesso a produtos e serviços logísticos, para o motor de desenvolvimento econômico e social, nas mãos do maior número possível de pessoas. Nossas portas estão e estarão abertas às pessoas com brilho nos olhos, vontade e coração aberto, independente de suas origens, posição social ou decisões pessoais.','Nosso comprometimento é com uma cultura de qualidade, foco no cliente, que assume os riscos de melhorias contínuas e incentiva a criatividade, a liderança, e, principalmente, o espírito empreendedor. Encorajamos pessoas a tomarem iniciativa, agirem e fazerem a diferença. Não importa onde você esteja, você pode ser um parceiro e cliente da DOMINUS.','Esse é um convite ao empreendedorismo e co-criação.\r\n<br>\r\nCom carinho,\r\n<br>\r\nDominus Distribuidora',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`login`,`email`,`pass`,`type`,`whats`,`img`,`user_create`) values 
(2,'Alexandre Barros','admin','alexandre.barros@distribuidoradominus.com','admin',1,'+55 11 99691-8070',NULL,'Cairo');

/*Table structure for table `whats` */

DROP TABLE IF EXISTS `whats`;

CREATE TABLE `whats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto1` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `whats` */

insert  into `whats`(`id`,`texto1`) values 
(1,'Olá Distribuidora Dominus, gostaria de saber mais sobre o produto: ');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
