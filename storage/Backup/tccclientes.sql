-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/06/2025 às 21:34
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tccclientes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(191) NOT NULL,
  `tipo_Pessoa` varchar(191) NOT NULL,
  `cpf_cnpj` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `celular` varchar(191) DEFAULT '0',
  `telefone` varchar(191) NOT NULL,
  `telefone_comercial` varchar(20) DEFAULT NULL,
  `cep` varchar(191) NOT NULL,
  `endereco` varchar(191) NOT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(191) DEFAULT NULL,
  `bairro` varchar(191) NOT NULL,
  `cidade` varchar(191) NOT NULL,
  `uf` varchar(191) NOT NULL,
  `sexo` varchar(191) NOT NULL,
  `estado_civil` varchar(191) NOT NULL,
  `data_fundacao` date DEFAULT NULL,
  `razao_social` varchar(191) DEFAULT NULL,
  `nome_fantasia` varchar(191) DEFAULT NULL,
  `inscricao_estadual` varchar(191) DEFAULT NULL,
  `inscricao_municipal` varchar(191) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `observacoes` text DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `user_id`, `nome`, `tipo_Pessoa`, `cpf_cnpj`, `email`, `celular`, `telefone`, `telefone_comercial`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `sexo`, `estado_civil`, `data_fundacao`, `razao_social`, `nome_fantasia`, `inscricao_estadual`, `inscricao_municipal`, `ativo`, `observacoes`, `data_nascimento`, `created_at`, `updated_at`) VALUES
(1, 11, 'Sr. Alan Benites Sobrinho', 'Física', '12374765508', 'dominato.daniella@example.net', '(84) 91364-5052', '(91) 93326-4282', NULL, '70319-412', 'Rua Tamoio, 20738', NULL, NULL, 'dolorem', 'Mário do Sul', 'RR', 'Masculino', 'Viúvo', '2013-11-21', NULL, NULL, NULL, NULL, 1, NULL, '2012-04-25', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(2, 11, 'Sr. Fábio Santiago Sobrinho', 'Jurídica', '238796630631177', 'tdasilva@example.net', '(43) 94708-1966', '(19) 4566-0601', NULL, '56938-040', 'Avenida Roberta, 325', NULL, NULL, 'reprehenderit', 'Analu d\'Oeste', 'RR', 'Feminino', 'Casado', '2016-11-28', NULL, NULL, NULL, NULL, 1, NULL, '1999-10-28', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(3, 11, 'Sr. Tiago Vitor Serrano Jr.', 'Física', '55383305608', 'mila.roque@example.org', '(93) 92556-8758', '(49) 93524-5931', NULL, '89813-352', 'Travessa Katherine, 8416', NULL, NULL, 'et', 'Meireles do Leste', 'AP', 'Masculino', 'Viúvo', '2000-03-20', NULL, NULL, NULL, NULL, 1, NULL, '1978-03-02', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(4, 11, 'Saulo Fabrício Ortega', 'Jurídica', '416740915172934', 'samanta89@example.com', '(32) 96883-4419', '(73) 95109-1666', NULL, '46134-761', 'Rua Lovato, 9. Bc. 94 Ap. 95', NULL, NULL, 'occaecati', 'São Sabrina do Norte', 'SE', 'Masculino', 'Solteiro', '1975-09-29', NULL, NULL, NULL, NULL, 1, NULL, '1973-06-17', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(5, 11, 'Dr. Ingrid Serrano Filho', 'Física', '04316225511', 'nelson.serna@example.org', '(31) 90729-7578', '(87) 98091-4493', NULL, '04903-102', 'R. Padilha, 21. Apto 0', NULL, NULL, 'labore', 'Estêvão do Leste', 'PR', 'Feminino', 'Viúvo', '2000-03-17', NULL, NULL, NULL, NULL, 1, NULL, '1972-03-24', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(6, 11, 'Dr. Carla Lira Filho', 'Física', '13167434452', 'ronaldo.grego@example.com', '(64) 91306-1890', '(84) 3025-9093', NULL, '66409-216', 'Av. Aaron, 2. Apto 0944', NULL, NULL, 'nam', 'Santa Felipe do Leste', 'AP', 'Masculino', 'Viúvo', '1993-01-22', NULL, NULL, NULL, NULL, 1, NULL, '1976-10-27', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(7, 11, 'Sra. Suellen Lovato', 'Física', '45328050802', 'julieta30@example.org', '(83) 91169-9062', '(96) 98966-1098', NULL, '63497-819', 'Rua Rodrigo, 4274', NULL, NULL, 'tenetur', 'Mônica do Sul', 'RO', 'Feminino', 'Viúvo', '2023-11-18', NULL, NULL, NULL, NULL, 1, NULL, '1997-05-18', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(8, 11, 'Filipe Chaves Santos Sobrinho', 'Física', '06123427694', 'micaela.dasdores@example.org', '(14) 90171-2819', '(94) 95319-0727', NULL, '16663-876', 'Avenida James Cruz, 50428. Apto 3', NULL, NULL, 'nulla', 'Verônica do Norte', 'ES', 'Masculino', 'Solteiro', '2006-01-23', NULL, NULL, NULL, NULL, 1, NULL, '2018-10-21', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(9, 11, 'Dr. Inácio das Dores Neto', 'Jurídica', '621237266023368', 'jcaldeira@example.com', '(93) 95286-3119', '(47) 93037-3438', NULL, '56664-347', 'Avenida Zaragoça, 12. Bc. 93 Ap. 34', NULL, NULL, 'perspiciatis', 'Vila Lucio', 'MG', 'Masculino', 'Casado', '1972-01-11', NULL, NULL, NULL, NULL, 1, NULL, '2012-11-01', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(10, 11, 'Sr. Breno Cléber Santacruz Sobrinho', 'Física', '86515264999', 'cmendes@example.org', '(62) 95497-5724', '(47) 91081-9031', NULL, '41694-546', 'R. Emília, 9744. 326º Andar', NULL, NULL, 'nostrum', 'Vila Sofia', 'RS', 'Masculino', 'Casado', '1987-11-16', NULL, NULL, NULL, NULL, 1, NULL, '2016-12-31', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(11, 11, 'Suellen Fidalgo Campos Neto', 'Física', '76952896598', 'sandoval.jessica@example.org', '(68) 96760-0765', '(65) 98809-7964', NULL, '04688-674', 'Avenida Emiliano, 1698. Anexo', NULL, NULL, 'quasi', 'Lutero do Norte', 'ES', 'Masculino', 'Solteiro', '1973-07-30', NULL, NULL, NULL, NULL, 1, NULL, '2020-07-03', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(12, 11, 'Moisés Serra Lutero', 'Física', '56848755055', 'uverdugo@example.net', '(73) 94708-3160', '(97) 4600-4183', NULL, '65143-399', 'Rua Christian, 5. Anexo', NULL, NULL, 'consequatur', 'São Simon', 'AM', 'Masculino', 'Divorciado', '2020-02-09', NULL, NULL, NULL, NULL, 1, NULL, '1973-11-18', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(13, 11, 'Dr. Bruno Cauan Gomes Sobrinho', 'Física', '79467504556', 'martinho67@example.com', '(21) 96512-3467', '(45) 95761-0178', NULL, '80634-851', 'Av. Casanova, 22897. Bloco B', NULL, NULL, 'est', 'Marés d\'Oeste', 'AM', 'Feminino', 'Solteiro', '2018-02-13', NULL, NULL, NULL, NULL, 1, NULL, '1982-01-01', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(14, 11, 'Dr. Andressa Ortega Arruda Sobrinho', 'Jurídica', '112048164462524', 'sepulveda.samara@example.org', '(91) 91052-3228', '(37) 93167-2437', NULL, '36594-953', 'Av. Thomas Vieira, 37. Bc. 50 Ap. 23', NULL, NULL, 'consequatur', 'Pena d\'Oeste', 'BA', 'Masculino', 'Viúvo', '2007-03-01', NULL, NULL, NULL, NULL, 1, NULL, '1999-08-06', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(15, 11, 'Dr. Cristiano Carvalho Soto', 'Física', '87718676620', 'oortega@example.org', '(22) 96645-1491', '(35) 95161-2774', NULL, '68190-369', 'Travessa Grego, 72012', NULL, NULL, 'quo', 'Santa David d\'Oeste', 'RJ', 'Masculino', 'Solteiro', '1999-07-27', NULL, NULL, NULL, NULL, 1, NULL, '1997-12-27', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(16, 11, 'Dr. Alexandre Sepúlveda', 'Física', '25547700632', 'leandro29@example.org', '(37) 96333-0509', '(94) 99874-6806', NULL, '67080-413', 'Largo Flávio, 80489', NULL, NULL, 'similique', 'Vila Cláudio do Leste', 'RR', 'Feminino', 'Casado', '1973-05-12', NULL, NULL, NULL, NULL, 1, NULL, '1976-10-05', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(17, 11, 'Suzana Gonçalves Faro', 'Jurídica', '803582955430004', 'horacio.ramos@example.com', '(75) 99720-1185', '(14) 99768-8037', NULL, '77020-176', 'Av. Serrano, 945. Bloco C', NULL, NULL, 'et', 'Estrada d\'Oeste', 'RO', 'Feminino', 'Solteiro', '1997-03-24', NULL, NULL, NULL, NULL, 1, NULL, '1998-07-16', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(18, 11, 'Dr. Talita Chaves Benites', 'Jurídica', '107006219434141', 'deverso.juliano@example.com', '(37) 97761-4242', '(33) 98076-8790', NULL, '12294-544', 'Travessa Teobaldo Teles, 65621', NULL, NULL, 'quia', 'São Ohana do Sul', 'PA', 'Feminino', 'Viúvo', '1988-03-03', NULL, NULL, NULL, NULL, 1, NULL, '1970-12-03', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(19, 11, 'Afonso das Neves Barreto Neto', 'Física', '435227049891622', 'scordeiro@example.com', '(18) 98315-1351', '(18) 2309-0757', NULL, '19746-251', 'Rua Galvão, 34451. Bloco B', NULL, NULL, 'quibusdam', 'Serrano do Norte', 'MT', 'M', 'Solteiro(a)', '2011-06-24', NULL, NULL, NULL, NULL, 1, NULL, '2025-05-19', '2025-03-20 03:07:34', '2025-05-11 19:08:51'),
(20, 11, 'Heitor Vicente Matias', 'Jurídica', '044955904916814', 'vpereira@example.com', '(67) 91303-2198', '(43) 94847-2359', NULL, '41116-569', 'Largo Vanessa Gil, 846', NULL, NULL, 'officiis', 'Porto Heloise', 'MG', 'Masculino', 'Casado', '2013-01-20', NULL, NULL, NULL, NULL, 1, NULL, '2003-02-06', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(21, 11, 'João Wagner Uchoa', 'Jurídica', '693385782153674', 'abreu.bruno@example.com', '(83) 92791-5690', '(51) 98433-8834', NULL, '88318-346', 'R. Vega, 19', NULL, NULL, 'ducimus', 'Enzo do Sul', 'DF', 'Feminino', 'Divorciado', '2021-04-19', NULL, NULL, NULL, NULL, 1, NULL, '2021-08-29', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(22, 11, 'Cecília Dayana Fidalgo Sobrinho', 'Física', '03042121975', 'lovato.sergio@example.net', '(24) 98417-6970', '(19) 98534-0177', NULL, '64339-400', 'Travessa Casanova, 5001. 458º Andar', NULL, NULL, 'nisi', 'Santa Giovane', 'AC', 'F', 'Solteiro(a)', '2022-08-30', NULL, NULL, NULL, NULL, 1, NULL, '1977-12-23', '2025-03-20 03:07:34', '2025-05-11 21:36:42'),
(23, 11, 'Sr. Thales Pedrosa', 'Jurídica', '060276507250175', 'esther49@example.com', '(12) 98935-9528', '(97) 98421-0080', NULL, '63734-298', 'Avenida Nicolas, 762', NULL, NULL, 'est', 'São Isadora do Sul', 'RS', 'Feminino', 'Solteiro', '1994-11-24', NULL, NULL, NULL, NULL, 1, NULL, '2023-03-31', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(24, 11, 'Heitor Marinho Cortês', 'Física', '53351690897', 'julia40@example.org', '(55) 97143-1845', '(77) 90160-0704', NULL, '55457-737', 'Travessa Francisco Amaral, 2652', NULL, NULL, 'adipisci', 'Santa Cláudia', 'SC', 'Feminino', 'Casado', '2023-04-30', NULL, NULL, NULL, NULL, 1, NULL, '1982-11-21', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(25, 11, 'João Galvão Neto', 'Jurídica', '601892224529874', 'balestero.artur@example.com', '(66) 99974-1046', '(61) 2248-3660', NULL, '21494-192', 'R. Furtado, 9532. 03º Andar', NULL, NULL, 'quis', 'Alves do Sul', 'MT', 'Feminino', 'Divorciado', '1972-09-09', NULL, NULL, NULL, NULL, 1, NULL, '1994-11-09', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(26, 11, 'Sr. Maurício Correia Carmona', 'Física', '58738719958', 'emanuelly.alcantara@example.org', '(69) 94480-6981', '(41) 2380-0869', NULL, '97135-722', 'Avenida Balestero, 41361. Fundos', NULL, NULL, 'voluptates', 'Cervantes do Sul', 'ES', 'Masculino', 'Casado', '2017-01-26', NULL, NULL, NULL, NULL, 1, NULL, '2022-03-26', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(27, 11, 'Fábio Queirós Jr.', 'Física', '39248355060', 'cortes.hugo@example.org', '(96) 97555-9797', '(65) 94964-2017', NULL, '98560-930', 'Av. Gisele, 4474', NULL, NULL, 'eum', 'Vila Dener', 'DF', 'Feminino', 'Casado', '2014-08-14', NULL, NULL, NULL, NULL, 1, NULL, '1972-02-12', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(28, 11, 'Michele Serra Filho', 'Física', '21389265909', 'wilson.vega@example.com', '(55) 94679-3169', '(21) 4152-0426', NULL, '83922-094', 'Largo Murilo, 8', NULL, NULL, 'sint', 'Salazar do Norte', 'DF', 'Feminino', 'Viúvo', '1986-11-09', NULL, NULL, NULL, NULL, 1, NULL, '1989-01-08', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(29, 11, 'Srta. Dayana Léia Campos', 'Jurídica', '338543989280496', 'everton.paz@example.org', '(73) 94342-7971', '(24) 2891-1929', NULL, '97605-815', 'Av. Alícia, 473', NULL, NULL, 'eveniet', 'Evandro do Leste', 'MA', 'Masculino', 'Casado', '2020-07-06', NULL, NULL, NULL, NULL, 1, NULL, '2007-05-20', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(30, 11, 'Kevin Augusto Correia Sobrinho', 'Jurídica', '325098705551251', 'ufaro@example.com', '(28) 95307-8671', '(67) 90405-3957', NULL, '11868-100', 'Largo Francisco Bonilha, 4695. Apto 77', NULL, NULL, 'culpa', 'São Anita do Sul', 'CE', 'Masculino', 'Casado', '1974-03-14', NULL, NULL, NULL, NULL, 1, NULL, '2011-10-18', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(31, 11, 'Sr. Júlio Lovato Arruda', 'Física', '31352692824', 'jose34@example.com', '(67) 99172-4370', '(85) 2758-6243', NULL, '13818-556', 'Rua Barros, 96', NULL, NULL, 'consequatur', 'Vila Eduardo', 'RR', 'Feminino', 'Viúvo', '2001-05-30', NULL, NULL, NULL, NULL, 1, NULL, '1991-06-14', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(32, 11, 'Allison Ramires Sobrinho', 'Física', '95642502584', 'cleber.toledo@example.org', '(11) 90416-8142', '(85) 2226-8316', NULL, '19424-972', 'Rua Murilo, 97406', NULL, NULL, 'eaque', 'Santa Guilherme', 'PI', 'Feminino', 'Viúvo', '2013-09-03', NULL, NULL, NULL, NULL, 1, NULL, '2016-04-05', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(33, 11, 'Enzo Wagner Gonçalves', 'Física', '73229140053', 'ebeltrao@example.net', '(79) 94037-8408', '(89) 98777-2608', NULL, '25602-556', 'Avenida Padrão, 1388. Apto 9', NULL, NULL, 'hic', 'Vila Sara do Leste', 'PB', 'Masculino', 'Solteiro', '2018-07-12', NULL, NULL, NULL, NULL, 1, NULL, '1971-04-13', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(34, 11, 'Patrícia Barros Gil', 'Jurídica', '758107302418931', 'xromero@example.org', '(53) 97295-2796', '(99) 3222-3822', NULL, '57858-115', 'Av. Vicente Lira, 77470', NULL, NULL, 'voluptatem', 'Porto Agostinho', 'RS', 'Feminino', 'Viúvo', '1998-11-20', NULL, NULL, NULL, NULL, 1, NULL, '2007-07-20', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(35, 11, 'Everton Lira Godói Filho', 'Física', '93875623605', 'lira.cristiano@example.com', '(41) 91589-0710', '(66) 3799-7780', NULL, '09784-682', 'Avenida Márcio Esteves, 6653', NULL, NULL, 'voluptatibus', 'São Thomas', 'RO', 'Feminino', 'Casado', '1994-08-20', NULL, NULL, NULL, NULL, 1, NULL, '1984-11-19', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(36, 11, 'Natal Alves', 'Física', '63084262820', 'jonas01@example.net', '(38) 94413-8169', '(85) 3487-0257', NULL, '76859-105', 'R. Wagner Serna, 54', NULL, NULL, 'qui', 'Soto do Leste', 'PR', 'Feminino', 'Viúvo', '1980-10-04', NULL, NULL, NULL, NULL, 1, NULL, '1983-10-31', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(37, 11, 'Matheus Arruda Rezende Sobrinho', 'Jurídica', '601080344776879', 'lguerra@example.net', '(66) 90597-3777', '(82) 99216-1694', NULL, '78560-516', 'Av. Tomás Lutero, 1659. F', NULL, NULL, 'ex', 'Sheila do Sul', 'GO', 'Feminino', 'Viúvo', '2013-12-16', NULL, NULL, NULL, NULL, 1, NULL, '1997-02-21', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(38, 11, 'Sra. Sara Mirela Rocha Filho', 'Física', '52462946670', 'dasneves.sandro@example.net', '(16) 95077-2891', '(93) 99998-8428', NULL, '60035-457', 'R. Raissa, 1. Bloco B', NULL, NULL, 'delectus', 'Porto Luana', 'DF', 'Masculino', 'Viúvo', '2024-09-23', NULL, NULL, NULL, NULL, 1, NULL, '2013-08-01', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(39, 11, 'Mariana Gomes Pena Neto', 'Física', '70220303665', 'marinho.raissa@example.org', '(34) 93966-9668', '(27) 2070-8162', NULL, '05308-192', 'R. Eliane, 234. Bc. 9 Ap. 48', NULL, NULL, 'harum', 'Vila Juliana', 'CE', 'Masculino', 'Divorciado', '1970-09-16', NULL, NULL, NULL, NULL, 1, NULL, '1988-02-04', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(40, 11, 'Cauan Deverso Uchoa Filho', 'Física', '04751309293', 'eduarda.lira@example.com', '(82) 94428-3175', '(51) 97977-1399', NULL, '66881-165', 'R. Cristiana Galhardo, 2. Apto 858', NULL, NULL, 'mollitia', 'Jorge do Norte', 'AC', 'Feminino', 'Casado', '2007-12-11', NULL, NULL, NULL, NULL, 1, NULL, '1984-05-10', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(41, 11, 'Dr. Teobaldo Leo Rico Sobrinho', 'Jurídica', '775852004928713', 'reinaldo18@example.org', '(93) 97667-2017', '(11) 2313-5588', NULL, '03930-837', 'Travessa Ana Beltrão, 54986', NULL, NULL, 'libero', 'Santa Ziraldo', 'SC', 'Masculino', 'Solteiro', '1974-09-30', NULL, NULL, NULL, NULL, 1, NULL, '2000-01-13', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(42, 11, 'Dr. Renato Casanova Torres', 'Física', '47162669678', 'luis.darosa@example.org', '(65) 92557-8728', '(15) 91314-0964', NULL, '83036-681', 'Rua Willian, 6', NULL, NULL, 'est', 'Toledo d\'Oeste', 'CE', 'Feminino', 'Casado', '1973-06-20', NULL, NULL, NULL, NULL, 1, NULL, '2010-10-23', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(43, 11, 'Kamila Cervantes', 'Física', '14303728685', 'jonas92@example.net', '(93) 92305-6501', '(22) 91070-3017', NULL, '66115-347', 'R. Thalia Assunção, 10989. Anexo', NULL, NULL, 'aperiam', 'Heloise do Sul', 'GO', 'Masculino', 'Divorciado', '1981-11-23', NULL, NULL, NULL, NULL, 1, NULL, '1998-06-24', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(44, 11, 'Michael Cordeiro', 'Física', '34260589779', 'augusto19@example.org', '(94) 94601-0716', '(38) 2850-2462', NULL, '33272-874', 'R. Violeta Urias, 4. Bloco C', NULL, NULL, 'quos', 'Santa Agostinho', 'MG', 'Feminino', 'Casado', '2023-03-09', NULL, NULL, NULL, NULL, 1, NULL, '1987-02-01', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(45, 11, 'Sr. Maximiano Zaragoça', 'Jurídica', '363163162526241', 'cruz.sergio@example.org', '(96) 91975-3809', '(32) 92545-8914', NULL, '90692-615', 'R. Gian, 5543. F', NULL, NULL, 'velit', 'Santa Luiza do Sul', 'AC', 'Masculino', 'Solteiro', '2007-08-15', NULL, NULL, NULL, NULL, 1, NULL, '2021-06-12', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(46, 11, 'César Espinoza Rocha', 'Jurídica', '455723097656495', 'maximo.pontes@example.com', '(74) 90259-4777', '(93) 92799-2778', NULL, '37581-420', 'Avenida Roberta, 2865', NULL, NULL, 'doloremque', 'Carvalho d\'Oeste', 'RO', 'Masculino', 'Solteiro', '1982-10-18', NULL, NULL, NULL, NULL, 1, NULL, '1973-07-02', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(47, 11, 'Sr. Manuel José Roque Neto', 'Física', '43954662039', 'ellen22@example.net', '(16) 90833-8918', '(38) 3517-4912', NULL, '33691-515', 'R. Grego, 8', NULL, NULL, 'aliquam', 'Lilian d\'Oeste', 'TO', 'Feminino', 'Casado', '2015-06-16', NULL, NULL, NULL, NULL, 1, NULL, '1998-12-06', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(48, 11, 'Srta. Letícia Souza Garcia Filho', 'Jurídica', '825556700577216', 'luan.dasilva@example.com', '(87) 99601-9195', '(65) 3625-8053', NULL, '87687-917', 'Avenida Roque, 1664. Bloco C', NULL, NULL, 'delectus', 'Santa Naomi', 'PE', 'Masculino', 'Divorciado', '1988-09-17', NULL, NULL, NULL, NULL, 1, NULL, '1972-04-01', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(49, 11, 'Sr. Jonas Fontes Sobrinho', 'Jurídica', '378734348264654', 'delatorre.flavia@example.org', '(94) 93952-9164', '(99) 94646-3559', NULL, '71471-527', 'Travessa Flores, 8', NULL, NULL, 'veritatis', 'Vila Elias', 'PB', 'Masculino', 'Divorciado', '1986-03-27', NULL, NULL, NULL, NULL, 1, NULL, '1992-03-06', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(50, 11, 'Nádia Franco Jr.', 'Física', '98628386102', 'bbrito@example.org', '(14) 93855-4358', '(46) 2997-2559', NULL, '22328-206', 'Av. Escobar, 74723', NULL, NULL, 'eveniet', 'Malena d\'Oeste', 'PI', 'Masculino', 'Solteiro', '2022-03-15', NULL, NULL, NULL, NULL, 1, NULL, '1998-05-11', '2025-03-20 03:07:34', '2025-03-20 03:07:34'),
(51, 11, 'Givanildo de jesus Teixeira', 'Física', '02042121975', 'givanildo@guarachevrolet.com.br', '42991272061', '42991272061', NULL, '85055040', 'Rua Jorge Alves Ribeiro', '2345', NULL, 'Bonsucesso', 'Guarapuava', 'PR', 'M', 'Casado(a)', NULL, NULL, NULL, NULL, NULL, 1, NULL, '1977-12-23', '2025-05-11 21:51:46', '2025-05-11 22:03:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `condicao_pagamentos`
--

CREATE TABLE `condicao_pagamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `financeira` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `condicao_pagamentos`
--

INSERT INTO `condicao_pagamentos` (`id`, `descricao`, `financeira`, `created_at`, `updated_at`) VALUES
(1, 'Dinheiro', 1, '2025-05-08 17:46:02', '2025-06-01 23:22:43'),
(2, 'Pix', 1, '2025-05-08 17:46:17', '2025-05-08 17:46:17'),
(3, 'Financiamento', 1, '2025-05-08 17:46:24', '2025-05-08 17:46:24'),
(4, 'Depósito Bancário', 1, '2025-05-08 17:46:43', '2025-05-08 17:46:43'),
(5, 'Acréscimo(+)', 0, '2025-05-10 03:29:12', '2025-06-01 23:18:07'),
(6, 'Desconto(-)', 0, '2025-05-10 03:29:50', '2025-06-01 23:18:11'),
(7, 'Sinal de Negócio', 1, '2025-05-11 02:47:23', '2025-05-11 02:47:23'),
(8, 'Cheque', 1, '2025-05-11 02:47:40', '2025-05-11 02:47:40'),
(9, 'Cartão Crédito', 1, '2025-05-11 02:47:47', '2025-06-01 23:18:04'),
(10, 'Cartão Débito', 1, '2025-05-11 02:47:51', '2025-05-11 02:47:51'),
(11, 'Moeda Estrangeira', 1, '2025-05-11 02:48:00', '2025-05-11 02:48:00'),
(12, 'Troco na Troca (-)', 1, '2025-05-11 02:48:13', '2025-05-11 02:48:13'),
(13, 'Consórcio', 1, '2025-05-11 02:48:42', '2025-05-11 02:48:42'),
(14, 'Usado(s)', 0, '2025-05-11 02:49:05', '2025-06-01 23:18:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chave` varchar(191) NOT NULL,
  `valor` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `chave`, `valor`, `created_at`, `updated_at`) VALUES
(1, 'mostrar_todas_familias', 'false', '2025-05-08 18:56:29', '2025-05-15 12:42:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cores`
--

CREATE TABLE `cores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cor_desc` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `cores`
--

INSERT INTO `cores` (`id`, `cor_desc`, `created_at`, `updated_at`) VALUES
(1, 'Azul Seeker', '2025-05-08 18:39:17', '2025-05-08 18:39:17'),
(2, 'Branco Summit', '2025-05-08 18:39:24', '2025-05-08 18:39:24'),
(3, 'Cinza Drake', '2025-05-08 18:39:29', '2025-05-08 18:39:29'),
(4, 'Prata Shark', '2025-05-08 18:39:34', '2025-05-08 18:39:34'),
(5, 'Preto Ouro Negro', '2025-05-08 18:39:43', '2025-05-08 18:39:43'),
(6, 'Vermelho Carmin', '2025-05-08 18:39:50', '2025-05-08 18:39:50'),
(7, 'Azul Eclipse', '2025-05-08 18:46:43', '2025-05-08 18:46:43'),
(8, 'Cinza Rush', '2025-05-08 18:46:55', '2025-05-08 18:46:55'),
(9, 'Verde Safari', '2025-05-08 18:47:12', '2025-05-08 18:47:12'),
(10, 'Azul Boreal', '2025-05-08 18:47:25', '2025-05-08 18:47:25'),
(11, 'Cinza Moss', '2025-05-08 18:47:39', '2025-05-08 18:47:39'),
(12, 'Prata Switchblade', '2025-05-08 18:47:50', '2025-05-08 18:47:50'),
(13, 'Cinza Satin Steel', '2025-05-08 18:47:55', '2025-05-08 18:47:55'),
(14, 'Branco Abalone', '2025-05-08 18:48:31', '2025-05-08 18:48:31'),
(15, 'Vermelho Chili', '2025-05-08 18:49:01', '2025-05-08 18:49:01'),
(16, 'Vermelho Radiant', '2025-05-08 18:50:20', '2025-05-08 18:50:20'),
(17, 'Cinza Topázio', '2025-05-08 18:50:35', '2025-05-08 18:50:35'),
(18, 'Vermelho Scarlet', '2025-05-08 18:50:56', '2025-05-08 18:50:56'),
(19, 'Preto Global', '2025-05-08 18:51:28', '2025-05-08 18:51:28'),
(20, 'Vermelho Pull Me Over', '2025-05-08 18:51:39', '2025-05-08 18:51:39'),
(21, 'Cinza Urbano', '2025-05-08 18:51:52', '2025-05-08 18:51:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cor_familia`
--

CREATE TABLE `cor_familia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `familia_id` bigint(20) UNSIGNED NOT NULL,
  `cor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `cor_familia`
--

INSERT INTO `cor_familia` (`id`, `familia_id`, `cor_id`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '2025-05-08 21:02:52', '2025-05-08 21:02:52'),
(4, 1, 2, '2025-05-08 21:02:52', '2025-05-08 21:02:52'),
(5, 1, 3, '2025-05-08 21:02:52', '2025-05-08 21:02:52'),
(6, 1, 4, '2025-05-08 21:02:52', '2025-05-08 21:02:52'),
(7, 1, 5, '2025-05-08 21:02:52', '2025-05-08 21:02:52'),
(8, 1, 6, '2025-05-08 21:02:52', '2025-05-08 21:02:52'),
(9, 2, 10, '2025-05-09 13:07:46', '2025-05-09 13:07:46'),
(10, 2, 2, '2025-05-09 13:07:46', '2025-05-09 13:07:46'),
(11, 2, 8, '2025-05-09 13:07:46', '2025-05-09 13:07:46'),
(12, 2, 4, '2025-05-09 13:07:46', '2025-05-09 13:07:46'),
(13, 2, 5, '2025-05-09 13:07:46', '2025-05-09 13:07:46'),
(14, 2, 9, '2025-05-09 13:07:46', '2025-05-09 13:07:46'),
(15, 2, 15, '2025-05-09 13:07:46', '2025-05-09 13:07:46'),
(16, 11, 2, '2025-05-09 13:18:49', '2025-05-09 13:18:49'),
(17, 11, 11, '2025-05-09 13:18:49', '2025-05-09 13:18:49'),
(18, 11, 17, '2025-05-09 13:18:49', '2025-05-09 13:18:49'),
(19, 11, 4, '2025-05-09 13:18:49', '2025-05-09 13:18:49'),
(20, 11, 5, '2025-05-09 13:18:49', '2025-05-09 13:18:49'),
(21, 11, 18, '2025-05-09 13:18:49', '2025-05-09 13:18:49'),
(22, 10, 14, '2025-05-09 13:22:17', '2025-05-09 13:22:17'),
(23, 10, 8, '2025-05-09 13:22:17', '2025-05-09 13:22:17'),
(24, 10, 19, '2025-05-09 13:22:17', '2025-05-09 13:22:17'),
(25, 10, 16, '2025-05-09 13:22:17', '2025-05-09 13:22:17'),
(32, 7, 10, '2025-05-09 13:23:45', '2025-05-09 13:23:45'),
(33, 7, 2, '2025-05-09 13:23:45', '2025-05-09 13:23:45'),
(34, 7, 8, '2025-05-09 13:23:45', '2025-05-09 13:23:45'),
(35, 7, 4, '2025-05-09 13:23:45', '2025-05-09 13:23:45'),
(36, 7, 5, '2025-05-09 13:23:45', '2025-05-09 13:23:45'),
(37, 7, 9, '2025-05-09 13:23:45', '2025-05-09 13:23:45'),
(38, 8, 10, '2025-05-09 13:24:51', '2025-05-09 13:24:51'),
(39, 8, 2, '2025-05-09 13:24:51', '2025-05-09 13:24:51'),
(40, 8, 8, '2025-05-09 13:24:51', '2025-05-09 13:24:51'),
(41, 8, 4, '2025-05-09 13:24:51', '2025-05-09 13:24:51'),
(42, 8, 5, '2025-05-09 13:24:51', '2025-05-09 13:24:51'),
(43, 8, 9, '2025-05-09 13:24:51', '2025-05-09 13:24:51'),
(44, 8, 15, '2025-05-09 13:24:51', '2025-05-09 13:24:51');

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `familias`
--

CREATE TABLE `familias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(191) NOT NULL,
  `imagem` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `site` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `familias`
--

INSERT INTO `familias` (`id`, `descricao`, `imagem`, `created_at`, `updated_at`, `site`) VALUES
(1, 'Onix', NULL, '2025-05-08 18:56:49', '2025-05-08 19:06:23', 'https://www.chevrolet.com.br/carros/novo-onix'),
(2, 'Montana', NULL, '2025-05-08 18:59:26', '2025-05-08 18:59:26', 'https://www.chevrolet.com.br/picapes/chevrolet-montana'),
(3, 'BlazerEv', NULL, '2025-05-08 19:03:11', '2025-05-08 19:03:11', 'https://www.chevrolet.com.br/eletrico/equinox-ev'),
(4, 'EquinoxEV', NULL, '2025-05-08 19:03:19', '2025-05-08 19:03:32', 'https://www.chevrolet.com.br/eletrico/equinox-ev'),
(5, 'BoltEv', NULL, '2025-05-08 19:03:51', '2025-05-08 19:03:51', 'https://www.chevrolet.com.br/eletrico/bolt-euv'),
(6, 'Camaro', NULL, '2025-05-08 19:04:11', '2025-05-08 19:04:11', 'https://www.chevrolet.com.br/esportivos/novo-camaro'),
(7, 'Spin', NULL, '2025-05-08 19:04:39', '2025-05-08 19:04:39', 'https://www.chevrolet.com.br/suvs/novo-spin'),
(8, 'Tracker', NULL, '2025-05-08 19:04:49', '2025-05-08 19:04:49', 'https://www.chevrolet.com.br/suvs/novo-tracker'),
(9, 'TrailBlazer', NULL, '2025-05-08 19:05:08', '2025-05-08 19:05:08', 'https://www.chevrolet.com.br/suvs/novo-trailblazer'),
(10, 'Silverado', NULL, '2025-05-08 19:05:42', '2025-05-08 19:05:42', 'https://www.chevrolet.com.br/picapes/nova-silverado'),
(11, 'S10', NULL, '2025-05-08 19:05:57', '2025-05-08 19:05:57', 'https://www.chevrolet.com.br/picapes/s10'),
(12, 'OnixPlus', NULL, '2025-05-08 19:06:35', '2025-05-08 19:06:35', 'https://www.chevrolet.com.br/carros/novo-onix-plus'),
(13, 'Seminovos', NULL, '2025-05-08 19:07:18', '2025-05-08 19:07:18', 'https://www.guarachevrolet.com.br');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_13_222325_create_clientes_table', 1),
(7, '2025_03_18_235343_create_opcionais_table', 1),
(8, '2025_03_18_233416_create_veiculos_table', 2),
(9, '2025_03_29_224633_add_transmissao_to_veiculos_table', 3),
(24, '2025_04_22_200001_create_condicao_pagamentos_table', 13),
(25, '2025_04_22_200002_create_propostas_table', 14),
(26, '2025_04_22_200035_create_negociacaos_table', 14),
(27, '2025_04_22_214844_add_fk_negociacao_to_propostas_table', 14),
(28, '2025_04_02_222344_create_configuracoes_table', 15),
(29, '2025_03_30_130906_create_familias_table', 16),
(30, '2025_04_01_214822_add_site_to_veiculos_table', 16),
(31, '2025_04_01_224335_add_site_to_familias_table', 16),
(32, '2025_04_01_224831_remove_site_from_veiculos_table', 16),
(33, '2025_04_07_153336_add_chassi_to_opcionais_table', 16),
(34, '2025_04_16_023019_add_active_to_users_table', 16),
(35, '2025_04_16_114312_add_ativo_to_veiculos_table', 16),
(36, '2025_04_16_152223_add_promocao_to_veiculos_table', 16),
(37, '2025_04_18_231502_create_cores_table', 17),
(38, '2025_04_18_232516_create_cor_familia_table', 17),
(39, '2025_04_21_213537_alter_clientes_table_add_campos_extras', 16),
(40, '2025_05_15_095211_add_status_to_veiculos_table', 18),
(41, '2025_05_29_022101_add_dta_vencimento_and_pago_to_veiculos_table', 19),
(42, '2025_06_01_030507_add_pago_to_negociacoes_table', 20),
(43, '2025_06_01_031238_add_financeira_to_negociacoes_table', 21),
(44, '2025_06_01_032217_add_financeira_to_condicao_pagamentos_table', 22),
(45, '2025_06_02_120659_add_dta_faturamento_to_propostas_table', 23);

-- --------------------------------------------------------

--
-- Estrutura para tabela `negociacoes`
--

CREATE TABLE `negociacoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_proposta` bigint(20) UNSIGNED NOT NULL,
  `id_cond_pagamento` bigint(20) UNSIGNED DEFAULT NULL,
  `descricao_pagamento` varchar(191) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `financeira` tinyint(1) NOT NULL DEFAULT 1,
  `pago` tinyint(1) NOT NULL DEFAULT 0,
  `data_vencimento` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `negociacoes`
--

INSERT INTO `negociacoes` (`id`, `id_proposta`, `id_cond_pagamento`, `descricao_pagamento`, `valor`, `financeira`, `pago`, `data_vencimento`, `created_at`, `updated_at`) VALUES
(25, 14, 4, 'Depósito Bancário', 60350.89, 1, 1, '2025-05-10', '2025-05-11 02:49:41', '2025-06-01 23:30:58'),
(26, 14, 14, 'Usado(s)', 77639.11, 1, 0, '2025-05-11', '2025-05-11 02:49:41', '2025-05-11 02:49:41'),
(27, 15, 14, 'Usado(s)', 127077.87, 1, 0, '2025-05-11', '2025-05-11 04:04:40', '2025-05-11 04:04:40'),
(28, 15, 1, 'Dinheiro', 50000.00, 1, 1, '2025-05-11', '2025-05-11 04:04:40', '2025-06-01 23:31:08'),
(29, 15, 4, 'Depósito Bancário', 300000.00, 1, 0, '2025-05-11', '2025-05-11 04:04:40', '2025-05-11 04:04:40'),
(30, 15, 3, 'Financiamento', 62922.13, 1, 0, '2025-05-11', '2025-05-11 04:04:40', '2025-05-11 04:04:40'),
(31, 16, 14, 'Usado(s)', 77639.11, 1, 0, '2025-05-11', '2025-05-11 04:43:35', '2025-05-11 04:43:35'),
(32, 16, 13, 'Consórcio', 100000.00, 1, 1, '2025-05-11', '2025-05-11 04:43:35', '2025-06-02 02:43:42'),
(33, 16, 10, 'Cartão Débito', 50000.00, 1, 0, '2025-05-11', '2025-05-11 04:43:35', '2025-05-11 04:43:35'),
(34, 16, 1, 'Dinheiro', 50000.00, 1, 1, '2025-05-11', '2025-05-11 04:43:35', '2025-06-02 02:42:52'),
(35, 16, 2, 'Pix', 47960.89, 1, 0, '2025-05-11', '2025-05-11 04:43:35', '2025-05-11 04:43:35'),
(41, 18, 14, 'Usado(s)', 100000.00, 1, 0, '2025-05-14', '2025-05-14 03:25:29', '2025-05-14 03:25:29'),
(42, 18, 9, 'Cartão Crédito', 3700.00, 1, 0, '2025-05-14', '2025-05-14 03:25:29', '2025-05-14 03:25:29'),
(43, 19, 14, 'Usado(s)', 51000.00, 1, 0, '2025-05-14', '2025-05-14 04:29:49', '2025-05-14 04:29:49'),
(44, 19, 13, 'Consórcio', 50000.00, 1, 0, '2025-05-30', '2025-05-14 04:29:49', '2025-05-14 04:29:49'),
(45, 19, 1, 'Dinheiro', 1800.00, 1, 0, '2025-05-14', '2025-05-14 04:29:49', '2025-05-14 04:29:49'),
(46, 20, 14, 'Usado(s)', 73543.15, 1, 0, '2025-05-17', '2025-05-17 13:38:10', '2025-05-17 13:38:10'),
(47, 20, 1, 'Dinheiro', 1000.00, 1, 0, '2025-05-17', '2025-05-17 13:38:10', '2025-05-17 13:38:10'),
(48, 20, 8, 'Cheque', 100000.00, 1, 0, '2025-05-17', '2025-05-17 13:38:10', '2025-05-17 13:38:10'),
(49, 20, 2, 'Pix', 100000.00, 1, 0, '2025-05-17', '2025-05-17 13:38:10', '2025-05-17 13:38:10'),
(50, 20, 5, 'Acréscimo(+)', 500.00, 1, 0, '2025-05-17', '2025-05-17 13:38:10', '2025-05-17 13:38:10'),
(51, 20, 3, 'Financiamento', 51556.85, 1, 0, '2025-05-17', '2025-05-17 13:38:10', '2025-05-17 13:38:10'),
(52, 21, 14, 'Usado(s)', 40000.00, 1, 0, '2025-05-18', '2025-05-18 20:39:29', '2025-05-18 20:39:29'),
(53, 21, 13, 'Consórcio', 50000.00, 1, 0, '2025-05-18', '2025-05-18 20:39:29', '2025-05-18 20:39:29'),
(54, 21, 1, 'Dinheiro', 6300.00, 1, 0, '2025-05-18', '2025-05-18 20:39:29', '2025-05-18 20:39:29'),
(59, 23, 2, 'Pix', 100000.00, 1, 0, '2025-05-18', '2025-05-19 01:05:00', '2025-05-19 01:05:00'),
(60, 23, 2, 'Pix', 1000.00, 1, 1, '2025-05-19', '2025-05-19 01:05:00', '2025-06-02 02:52:22'),
(61, 23, 14, 'Usado(s)', 50000.00, 1, 0, '2025-05-19', '2025-05-19 01:05:00', '2025-05-19 01:05:00'),
(62, 23, 13, 'Consórcio', 100000.00, 1, 0, '2025-05-18', '2025-05-19 01:05:00', '2025-05-19 01:05:00'),
(63, 23, 3, 'Financiamento', 289000.00, 1, 0, '2025-05-18', '2025-05-19 01:05:00', '2025-05-19 01:05:00'),
(64, 24, 14, 'Usado(s)', 10000.00, 1, 0, '2025-05-24', '2025-05-24 03:44:14', '2025-05-24 03:44:14'),
(65, 24, 9, 'Cartão Crédito', 86300.00, 1, 0, '2025-05-24', '2025-05-24 03:44:14', '2025-05-24 03:44:14'),
(81, 28, 14, 'Usado(s)', 77639.11, 1, 0, '2025-05-11', '2025-06-02 18:19:37', '2025-06-02 18:19:37'),
(82, 28, 13, 'Consórcio', 100000.00, 1, 0, '2025-05-11', '2025-06-02 18:19:37', '2025-06-02 18:19:37'),
(83, 28, 10, 'Cartão Débito', 50000.00, 1, 0, '2025-05-11', '2025-06-02 18:19:37', '2025-06-02 18:19:37'),
(84, 28, 1, 'Dinheiro', 50000.00, 1, 0, '2025-05-11', '2025-06-02 18:19:37', '2025-06-02 18:19:37'),
(85, 28, 2, 'Pix', 47960.89, 1, 0, '2025-05-11', '2025-06-02 18:19:37', '2025-06-02 18:19:37');

-- --------------------------------------------------------

--
-- Estrutura para tabela `opcionais`
--

CREATE TABLE `opcionais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modelo_fab` varchar(191) NOT NULL,
  `cod_opcional` varchar(191) NOT NULL,
  `chassi` varchar(191) DEFAULT NULL,
  `descricao` varchar(10000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `opcionais`
--

INSERT INTO `opcionais` (`id`, `modelo_fab`, `cod_opcional`, `chassi`, `descricao`, `created_at`, `updated_at`) VALUES
(1, '5A43BS', 'R8A', NULL, '06 Airbags (frontais, laterais e de cortina) / Alarme Anti-furto / Assistente de partida em aclive / Controle de estabilidade e tração / Luz de\r/condução diurna / Sistema de fixação de cadeiras para crianças (\"Isofix\") e (\"Top Tether\") / Sistema de freios com ABS e sistema de distribuição\r/de frenagem (\"EBD\") / Maçanetas internas na cor prata / Rodas de aço aro 16\" com calotas integrais / Ar condicionado / Computador de bordo\r/com informações de viagem, do veículo e consumo / Direção Elétrica Progressiva / Trava elétrica das portas com acionamento na chave / Vidro\r/elétrico nas portas com acionamento por \"um toque\", anti esmagamento e fechamento/abertura automática pela chave / Chevrolet MyLink, com\r/Tela LCD sensível ao toque de 8\", integração com smartphones através do Android Auto e Apple Car Play, RadioAM/FM, Função Audio Streaming,\r/Bluetooth para até 2 celulares simultaneamente, Entrada USB dupla - tipo A e tipo C / Painel de Instrumentos 3,5” digital TFT / Controles de rádio\r/e do celular no volante / Conjunto de alto falantes - 4 unidades / Grade frontal com detalhes na cor preta / Espelhos retrovisores externos\r/manuais na cor preta / Maçanetas externas na cor preta / Acendimento automático dos faróis através de sensor crepuscular / Transmissão manual\r/de seis velocidades / OnStar + Conectividade Chevrolet + Wi-Fi / Projeção da tela do smartphone sem o uso de cabo / Protetor de caçamba /\r/Tampa traseira com abertura por botão elétrico sensível ao toque (\"touchpad\") com alívio de peso na subida e descida / Ganchos para amarração\r/de carga no interior da caçamba (8 ganchos)', '2025-03-30 23:17:25', '2025-05-09 13:08:00'),
(4, 'SemModelo', '000', '9BG148PK0SC427193', 'Opcional não cadastrado', '2025-04-13 02:56:52', '2025-04-13 02:56:52'),
(5, '5Y43TS', 'RFE', NULL, '06 Airbags (frontais, laterais e de cortina)\r/Alarme Anti-furto\r/Assistente de partida em aclive\r/Controle de estabilidade e tração\r/Luz de\r/condução diurna\r/Sistema de fixação de cadeiras para crianças (\"Isofix\") e (\"Top Tether\")\r/Sistema de freios com ABS e sistema de distribuição\r/de frenagem (\"EBD\")\r/Maçanetas internas na cor prata\r/Coluna de direção com regulagem em altura e profundidade\r/Computador de bordo\r/com informações de viagem, do veículo e consumo\r/Direção Elétrica Progressiva\r/Trava elétrica das portas com acionamento na chave\r/Vidro\r/elétrico nas portas com acionamento por \"um toque\", anti esmagamento e fechamento\r/abertura automática pela chave\r/Chevrolet MyLink, com\r/Tela LCD sensível ao toque de 8\", integração com smartphones através do Android Auto e Apple Car Play, RadioAM\r/FM, Função Audio Streaming,\r/Bluetooth para até 2 celulares simultaneamente, Entrada USB dupla - tipo A e tipo C\r/Painel de Instrumentos 3,5” digital TFT\r/Controles de rádio\r/e do celular no volante\r/Conjunto de alto falantes - 6 unidades\r/Maçanetas externas na cor do veículo\r/Desembaçador elétrico do vidro traseiro\r/\r/Entrada USB dupla para o banco traseiro\r/Acendimento automático dos faróis através de sensor crepuscular\r/Transmissão automática de seis\r/velocidades com opção de troca manual\r/OnStar + Conectividade Chevrolet + Wi-Fi\r/Projeção da tela do smartphone sem o uso de cabo\r/\r/Protetor de caçamba\r/Tampa traseira com abertura por botão elétrico sensível ao toque (\"touchpad\") com alívio de peso na subida e descida\r/\r/Ganchos para amarração de carga no interior da caçamba (8 ganchos)\r/Capota marítima\r/Iluminação na caçamba nos 2 lados\r/Rack de Teto na\r/cor prata\r/Volante esportivo com revestimento premium\r/Alça dianteira no teto (lado do passageiro)\r/Câmera de ré\r/Espelhos retrovisores\r/externos elétricos na cor do veículo\r/Console central com descansa-braço\r/Controlador de velocidade de cruzeiro\r/Easy Entry - Abertura das\r/portas, tampa traseira e alarme anti-furto através de sensor de aproximação na chave\r/Easy Start - Partida sem chave\r/Sensor de\r/estacionamento traseiro\r/Alças traseiras no teto\r/Bancos com revestimento premium na cor Preto \"Jet Black\"\r/Alerta de ponto cego\r/\r/Faróis dianteiros tipo projetor em LED\r/Carregador sem fio*\r/Ar-condicionado digital automático\r/Grade frontal com detalhes\r/em cromo escurecido\r/Roda de alumínio aro 17\" com acabamento escurecido exclusivo para a versão Premier\r/Santo Antônio\r/Integrado Chevrolet', '2025-04-20 02:48:59', '2025-05-24 01:49:13'),
(6, '5A48AS', 'R7A', NULL, 'Bluetooth para até 2 celulares simultaneamente / Chevrolet MyLink, com Tela LCD sensível ao toque de 8\", integração com\r/smartphones* através do Android Auto e Apple CarPlay, Radio AM/FM e Entrada USB / 06 Airbags (duplo frontal, duplo lateral e\r/duplo de cortina) / Acendimento automático dos faróis através de sensor crepuscular / Alarme anti-furto / Ar-condicionado / Assistente de\r/partida em aclive / Aviso sonoro e visual do cinto de segurança para todos os passageiros / Banco traseiro bipartido e rebatível / Chave tipo\r/canivete dobrável / Cinto de segurança do motorista com ajuste de altura / Cintos de segurança traseiros laterais e central de 3 pontos /\r/Computador de bordo / Conjunto de alto falantes - 4 unidades (2 tweeters e 2 dianteiros) / Controlador de limite de velocidade / Controle\r/eletrônico de estabilidade e tração / Controles do radio e telefone no volante / Direção Elétrica Progressiva / Luz de condução diurna / Roda\r/de aço aro 14\" com calotas integrais / Sistema de fixação de cadeiras para crianças (\"Isofix e Top Tether\") / Sistema de freios com ABS,\r/sistema de distribuição de frenagem (\"EBD\") e assistência de frenagem de urgência (\"PBA\") / Transmissão manual de seis velocidades /\r/Trava elétrica das portas com acionamento na chave / Vidro elétrico nas portas dianteiras e traseiras com acionamento por \"um toque\", anti\r/esmagamento e fechamento/abertura automática pela chave', '2025-04-20 02:50:45', '2025-05-09 13:12:52'),
(7, '5Y69HS', 'R8R', NULL, '06 Airbags (duplo frontal, duplo lateral e duplo de cortina) / Acabamento interno nas cores Preto \"Jet Black\" e Cinza \"Mid Ash Gray\" / Acendimento automático dos faróis\r/através de sensor crepuscular / Alarme anti-furto / Alerta de Ponto Cego / Ar-condicionado digital automático / Assistente de partida em aclive / Aviso sonoro e visual do\r/cinto de segurança para todos os passageiros / Banco do motorista com regulagem de altura / Banco traseiro bipartido e rebatível / Bancos com revestimento premium /\r/Bluetooth para até 2 celulares simultaneamente / Câmera de ré / Carregador sem fio* / Chave com sensor de aproximação / Chevrolet MyLink, com Tela LCD sensível ao\r/toque de 8\", integração com smartphones* através do Apple CarPlay, Radio AM/FM e Entrada USB / Cinto de segurança do motorista com ajuste de altura / Cintos de\r/segurança traseiros laterais e central de 3 pontos / Coluna de direção com regulagem em altura e profundidade / Computador de bordo / Conjunto de alto falantes - 6\r/unidades (2 tweeters, 2 dianteiros e 2 traseiros) / Console central com descansa-braço / Controlador de limite de velocidade / Controlador de velocidade de cruzeiro /\r/Controle eletrônico de estabilidade e tração / Controles do radio e telefone no volante / Direção Elétrica Progressiva / Easy Entry - Abertura das portas através de sensor de\r/aproximação na chave / Easy Park - Sistema de estacionamento automático / Easy Start - Partida sem chave / Entrada USB dupla para o banco traseiro (apenas\r/carregamento) / Espelhos retrovisores externos elétricos na cor do veículo / Faróis dianteiros tipo projetor / Friso cromado no contorno inferior do vidro das portas /\r/Lanterna em LED / Luz de condução diurna em LED / Maçanetas externas na cor do veículo com detalhe cromado / Maçanetas internas cromadas / OnStar / Painel de\r/instrumentos 3,5\" digital TFT / Projeção da tela do smartphone sem o uso de cabo / Regulagem de altura dos faróis - elétrica / Roda de liga leve aro 16\" com design\r/exclusivo para a versão PREMIER / Sensor de estacionamento dianteiro, lateral e traseiro / Sistema de fixação de cadeiras para crianças (\"Isofix e Top Tether\") / Sistema de\r/freios com ABS, sistema de distribuição de frenagem (\"EBD\") e assistência de frenagem de urgência (\"PBA\") / Sistema de monitoramento de pressão dos pneus /\r/Transmissão automática de seis velocidades com opção de troca manual (modo de seleção de marcha eletrônico ERS) / Trava elétrica das portas com acionamento na chave\r// Vidro elétrico nas portas dianteiras e traseiras com acionamento por \"um toque\", anti esmagamento e fechamento/abertura automática pela chave / Volante esportivo com\r/revestimento premium / Wi-Fi embarcado no veiculo para até 7 dispositivos eletrônicos **', '2025-04-20 02:52:18', '2025-05-09 13:17:51'),
(8, '5X76HS', 'RFC', NULL, '06 Airbags (frontais, laterais e de cortina) / Alarme Anti-furto / Ar condicionado / Assistente de partida em aclive / Banco\r/traseiro bipartido e rebatível / Bluetooth para até 2 celulares simultaneamente / Câmera de ré / Chevrolet MyLink, com Tela\r/LCD sensível ao toque de 8\", integração com smartphones através do Apple CarPlay e Android Auto, Radio AM/FM, e Entrada\r/USB / Coluna de direção com regulagem em altura e profundidade / Computador de bordo com informações de viagem, do\r/veículo e consumo / Conjunto de alto falantes - 4 unidades / Controlador de velocidade de cruzeiro com comandos no volante\r// Controle de estabilidade e tração / Controles de rádio e do celular no volante / Direção Elétrica Progressiva / Easy Entry -\r/Abertura das portas e alarme anti-furto através de sensor de aproximação na chave / Easy Start - Partida sem chave /\r/Espelhos retrovisores externos elétricos na cor do veículo / Grade frontal com detalhes cromados / Indicador de nível de vida\r/de óleo / Luz de condução diurna / Maçanetas externas na cor do veículo / Maçanetas internas na cor prata / Onstar / Painel\r/de Instrumentos 3,5” digital TFT / Parachoques pintados na cor do veículo / Projeção da tela do smartphone sem o uso de\r/cabo / Rack de teto na cor preto / Rodas de aço aro 16\" com calotas integrais / Sensor Crepuscular / Sistema de fixação de\r/cadeiras para crianças (\"Isofix\") e (\"Top Tether\") / Sistema de freios com ABS e sistema de distribuição de frenagem (\"EBD\")\r// Transmissão automática de seis velocidades com opção de troca manual (modo de seleção de marcha eletrônico ERS) /\r/Trava elétrica das portas com acionamento na chave / Vidro elétrico nas portas com acionamento por \"um toque\", anti\r/esmagamento e fechamento/abertura automática pela chave / Wi-Fi', '2025-04-20 02:52:40', '2025-05-09 13:26:11'),
(9, '5B48AS', 'RGH', NULL, 'Banco do motorista com regulagem de altura\r/Câmera de ré\r/Chave com sensor de aproximação\r/Easy Entry - Abertura das\r/portas através de sensor de aproximação na chave\r/Easy Start - Partida sem chave\r/Espelhos retrovisores externos elétricos\r/na cor do veículo\r/Maçanetas externas na cor do veículo\r/OnStar\r/Projeção da tela do smartphone sem o uso de cabo\r/Roda\r/de aço High-vent aro 15\" com calotas esportivas em dois tons\r/Wi-Fi embarcado no veiculo para até 7 dispositivos eletrônicos\r/**\r/Bluetooth para até 2 celulares simultaneamente\r/Chevrolet MyLink, com Tela LCD sensível ao toque de 8\", integração com\r/smartphones* através do Android Auto e Apple CarPlay, Radio AM\r/FM e Entrada USB\r/06 Airbags (duplo frontal, duplo lateral e duplo de\r/cortina)\r/Acendimento automático dos faróis através de sensor crepuscular\r/Alarme anti-furto\r/Ar-condicionado\r/Assistente de partida em\r/aclive\r/Aviso sonoro e visual do cinto de segurança para todos os passageiros\r/Banco traseiro bipartido e rebatível\r/Cinto de segurança do\r/motorista com ajuste de altura\r/Cintos de segurança traseiros laterais e central de 3 pontos\r/Computador de bordo\r/Conjunto de alto\r/falantes - 4 unidades (2 tweeters e 2 dianteiros)\r/Controlador de limite de velocidade\r/Controle eletrônico de estabilidade e tração\r/\r/Controles do radio e telefone no volante\r/Direção Elétrica Progressiva\r/Luz de condução diurna\r/Sistema de fixação de cadeiras para\r/crianças (\"Isofix e Top Tether\")\r/Sistema de freios com ABS, sistema de distribuição de frenagem (\"EBD\") e assistência de frenagem de\r/urgência (\"PBA\")\r/Transmissão manual de seis velocidades\r/Trava elétrica das portas com acionamento na chave\r/Vidro elétrico nas\r/portas dianteiras e traseiras com acionamento por \"um toque\", anti esmagamento e fechamento\r/abertura automática pela chave', '2025-05-09 13:14:45', '2025-05-29 03:50:30'),
(10, '5N48HS', 'RGM', NULL, '06 Airbags (duplo frontal, duplo lateral e duplo de cortina) / Acendimento automático dos faróis através de sensor crepuscular / Alarme antifurto / Ar-condicionado / Assistente de partida em aclive / Aviso sonoro e visual do cinto de segurança para todos os passageiros / Banco do\r/motorista com regulagem de altura / Banco traseiro bipartido e rebatível / Bancos com revestimento híbrido (tecido e revestimento premium)\r// Bluetooth para até 2 celulares simultaneamente / Câmera de ré / Chave com sensor de aproximação / Chevrolet MyLink, com Tela LCD\r/sensível ao toque de 8\", integração com smartphones* através do Android Auto e Apple CarPlay, Radio AM/FM e Entrada USB / Cinto de\r/segurança do motorista com ajuste de altura / Cintos de segurança traseiros laterais e central de 3 pontos / Coluna de direção com regulagem\r/em altura e profundidade / Computador de bordo / Conjunto de alto falantes - 6 unidades (2 tweeters, 2 dianteiros e 2 traseiros) / Console\r/central com descansa-braço / Controlador de limite de velocidade / Controlador de velocidade de cruzeiro / Controle eletrônico de estabilidade\r/e tração / Controles do radio e telefone no volante / Direção Elétrica Progressiva / Easy Entry - Abertura das portas através de sensor de\r/aproximação na chave / Easy Start - Partida sem chave / Espelhos retrovisores externos elétricos na cor do veículo / Luz de condução diurna /\r/Maçanetas externas na cor do veículo / OnStar / Painel de instrumentos 3,5\" digital TFT / Projeção da tela do smartphone sem o uso de cabo /\r/Roda de liga leve aro 16\"/ Sensor de estacionamento traseiro / Sistema de fixação de cadeiras para crianças (\"Isofix e Top Tether\") / Sistema\r/de freios com ABS, sistema de distribuição de frenagem (\"EBD\") e assistência de frenagem de urgência (\"PBA\") / Transmissão automática de\r/seis velocidades com opção de troca manual (modo de seleção de marcha eletrônico ERS) / Trava elétrica das portas com acionamento na\r/chave / Vidro elétrico nas portas dianteiras e traseiras com acionamento por \"um toque\", anti esmagamento e fechamento/abertura\r/automática pela chave / Volante esportivo com revestimento premium / Wi-Fi embarcado no veiculo para até 7 dispositivos eletrônicos **', '2025-05-09 13:15:35', '2025-05-09 13:15:35'),
(11, '5Y48HS', 'R7R', NULL, '06 Airbags (duplo frontal, duplo lateral e duplo de cortina) / Acabamento interno nas cores Preto \"Jet Black\" e Cinza \"Mid Ash Gray\" / Acendimento automático dos faróis através\r/de sensor crepuscular / Alarme anti-furto / Alerta de Ponto Cego / Ar-condicionado digital automático / Assistente de partida em aclive / Aviso sonoro e visual do cinto de\r/segurança para todos os passageiros / Banco do motorista com regulagem de altura / Banco traseiro bipartido e rebatível / Bancos com revestimento premium / Bluetooth para\r/até 2 celulares simultaneamente / Câmera de ré / Carregador sem fio* / Chave com sensor de aproximação / Chevrolet MyLink, com Tela LCD sensível ao toque de 8\",\r/integração com smartphones* através do Apple CarPlay, Radio AM/FM e Entrada USB / Cinto de segurança do motorista com ajuste de altura / Cintos de segurança traseiros\r/laterais e central de 3 pontos / Coluna de direção com regulagem em altura e profundidade / Computador de bordo / Conjunto de alto falantes - 6 unidades (2 tweeters, 2\r/dianteiros e 2 traseiros) / Console central com descansa-braço / Controlador de limite de velocidade / Controlador de velocidade de cruzeiro / Controle eletrônico de\r/estabilidade e tração / Controles do radio e telefone no volante / Direção Elétrica Progressiva / Easy Entry - Abertura das portas através de sensor de aproximação na chave /\r/Easy Park - Sistema de estacionamento automático / Easy Start - Partida sem chave / Entrada USB dupla para o banco traseiro (apenas carregamento) / Espelhos retrovisores\r/externos elétricos na cor do veículo / Faróis dianteiros tipo projetor / Friso cromado no contorno inferior do vidro das portas / Lanterna em LED / Luz de condução diurna em\r/LED / Maçanetas externas na cor do veículo com detalhe cromado / Maçanetas internas cromadas / OnStar / Painel de instrumentos 3,5\" digital TFT / Projeção da tela do\r/smartphone sem o uso de cabo / Regulagem de altura dos faróis - elétrica / Roda de liga leve aro 16\" com design exclusivo para a versão PREMIER / Sensor de estacionamento\r/dianteiro, lateral e traseiro / Sistema de fixação de cadeiras para crianças (\"Isofix e Top Tether\") / Sistema de freios com ABS, sistema de distribuição de frenagem (\"EBD\") e\r/assistência de frenagem de urgência (\"PBA\") / Sistema de monitoramento de pressão dos pneus / Transmissão automática de seis velocidades com opção de troca manual\r/(modo de seleção de marcha eletrônico ERS) / Trava elétrica das portas com acionamento na chave / Vidro elétrico nas portas dianteiras e traseiras com acionamento por \"um\r/toque\", anti esmagamento e fechamento/abertura automática pela chave / Volante esportivo com revestimento premium / Wi-Fi embarcado no veiculo para até 7 dispositivos\r/eletrônicos **', '2025-05-09 13:15:59', '2025-05-09 13:15:59'),
(12, '148PKS', 'R7U', NULL, 'Acabamento interno premium em dois tons / Adesivo HIGH COUNTRY no painel / Adesivo HIGH\r/COUNTRY nas portas dianteiras e tampa traseira / Alerta de ponto cego / Alerta de tráfego cruzado\r/traseiro / Apoios de cabeça de motorista e passageiro com bordados HIGH COUNTRY / Capota\r/marítima HIGH COUNTRY / Descansa-braço traseiro / Grade dianteira com barra cromada /\r/Santantônio exclusivo HIGH COUNTRY / 06 Airbags (duplo frontal, duplo lateral e de cortina) / Abertura\r/das portas e alarme anti-furto através de sensor de aproximação na chave \"Easy Entry\" / ABS nas 4 rodas,\r/EBD & PBA / AC Digital / Alarme antifurto / Alerta de colisão frontal / Alerta de Pressão dos Pneus / Alerta de\r/saída de faixa / Assistente inteligente de frenagem (IBA) / Bancos com revestimento premium / Banco do\r/motorista com regulagem elétrica / Câmera de ré digital de alta resolução / Carregador de celular por indução /\r/Chevrolet MyLink com Tela LCD sensível ao toque de 11\", integração com smartphones* através do Android\r/Auto e Apple CarPlay / Coluna de direção com regulagem de altura e profundidade / Console central entre os\r/bancos dianteiros / Controle anticapotamento / Controle de oscilação de trailer e reboque (TSC) / Controles de\r/Rádio e do Celular no Volante / Conjunto de alto falantes - 2 unidades e 2 tweeters / Controle de velocidade\r/em declive (HDC) / assistente de partida em aclive (HSA) / Controle Eletrônico de Estabilidade / Direção\r/Elétrica Progressiva / Entradas USB dianteiras (02) - USB-C e USB-A para carregamento e dados / Entradas\r/USB traseiras (02) - USB-C e USB-A para carregamento / Espelho retrovisor interno eletrocrômico / Espelhos\r/retrovisores externos elétricos cromados com luz indicadora de direção integrada / Estribos laterais / Farol alto\r/com ajuste automático / Faróis em LED / Faróis de neblina em LED / Frenagem automática de emergência\r/(AEB) com detecção de pedestres / Ganchos para amarração de carga na caçamba / ISOFIX / Lanternas em\r/LED / Luz de condução diurna/ luz de posição em LED / OnStar / Painel de instrumentos digital de 8\" com 3\r/configurações de personalização, informações de conta-giros, hodômetro parcial, marcador de nível de\r/combustível e demais funções / Parachoques na cor do veículo / Parachoques traseiros com aplique cromado /\r/Partida do motor por controle remoto e acionamento do ar-condicionado - Remote Start / Partida sem chave\r/(Easy Start) / Projeção da tela do smartphone sem o uso de cabo / Rack de teto / Regulagem de altura dos\r/faróis / Rodas de alumínio aro 18” / Seletor eletrônico de tração / Sensor de chuva / Sensor de\r/estacionamento dianteiro e traseiro / Sistema de Controle de Estabilidade e Controle de Tração / Sistema de\r/som - 4 alto falantes e 2 tweeters / Transmissão automática de oito velocidades / Trava elétrica da tampa\r/traseira com acionamento na chave / Trava elétrica das portas / Vidro elétrico nas portas com acionamento por\r/\"um toque\" e anti esmagamento com fechamento/abertura automática pela chave / Volante com revestimento\r/premium / Wi-Fi embarcado no veiculo para até 7 dispositivos eletrônicos**', '2025-05-09 13:19:15', '2025-05-09 13:19:15'),
(13, '3PJEDR', 'PEB', NULL, '6 Airbags / Alerta de Colisão Frontal / Alerta de detecção de pedestre frontal com auxílio de frenagem / Alerta de Pressão dos Pneus / Alerta de Ponto Cego /\r/Alerta de Segurança no banco do motorista / Alerta de uso dos Cintos de Segurança / Cintos de segurança dianteiros de 3 pontos e com pré-tensionador /\r/Cintos de segurança traseiros laterais e central de 3 pontos retráteis / Controle de velocidade em declive (Hill Descent Control) / Controles de rádio e do\r/celular no volante / Diferencial Blocante / Freios dianteiros e Traseiros a disco / Frenagem automática de emergência (AEB) / Assistente Inteligente de\r/Frenagem (IBA) / Indicador de distância do veículo a frente / OnStar / Sensores de Detecção de Pedestres Traseiro / Sensores de Estacionamento Dianteiros\r/e Traseiros / Sistema auxiliar de permanência em faixa / Sistema de ajuste de freio de Reboque Integrado / Sistema de Controle de estabilidade (ESC) e\r/Controle Eletrônico de Tração (TCS) / Sistema de Detecção de Ocupantes Traseiro / Sistema de Detecção de Tráfego Traseiro Cruzado com auxílio de\r/frenagem / Sistema de fixação de cadeiras para crianças (\"Isofix e Top Tether\") / Abertura e fechamento Elétrico da Caçamba / Ajuste de coluna de direção\r/elétrico / Ar-condicionado \"Dual Zone\" com controle eletrônico de temperatura, sistema automático de recirculação e filtro de ar / Banco Dianteiro do\r/Motorista com ajustes Elétricos / Banco Dianteiro do Passageiro com ajustes Elétricos / Bancos Dianteiros Aquecidos E Ventilados / Bancos Traseiros\r/Laterais com Aquecimento / Caçamba com acabamento em Spray-on (Anti-risco, Alta Resistência para Carga) / Câmera 360 em alta definição - Conjunto de\r/câmeras que projetam visão periférica do veículo com opção de seleção de campos visuais / Camera com Função e Linhas de reboque / Camera de Caçamba\r/(Compartimento de carga) / Câmera de Ré em alta definição / Compartimento organizador nos Bancos Traseiros / Controle de Cruzeiro Adaptativo (ACC) /\r/Controle Elétrico para abertura de todas as Janelas / Dutos Traseiros de Ventilação e Ar Condicionado / Easy Entry - Abertura das portas e alarme anti-furto\r/através de sensor de aproximação na chave / Easy Start - Partida sem chave através de botão / Espelho retrovisor externo elétrico, dobrável de Ampla Visão\r/com pisca lateral / Espelho retrovisor interno com câmera de vídeo / Ganchos para amarração de carga no interior da caçamba / Head up Display: Projeção\r/no para-brisa de informações para o motorista / Luz de cortesia na caçamba / Luzes de cortesia na cabine / Memórias de Posição e Regulagens (Banco\r/Motorista, Espelhos Retrovisores, Personalizações) / Para-sol Dianteiro Motorista e Passageiro com Iluminação / Seletor de marchas eletrônico / Seletor\r/eletronico de tração 4x2-4x4 (Integral/Reduzida) / Sistema de partida do motor por controle remoto \"Remote Start System\" / Tomada de força na caçamba /\r/Tomada de força na cabine do veículo / Trava elétrica das portas com acionamento na chave / Vidro elétrico nas portas dianteiras e traseiras / Vidro Elétrico\r/Traseira (Vigia) / Volante em Couro com Aquecimento / Antena tipo Shark / Bancos de Couro Premium com acabamento \"Jet Black com Captain Blue\" /\r/Controle Automático da Aerodinâmica da Grade Frontal / Detalhes Cromados das Maçanetas Externas / Estribos Laterais Elétricos e Retráteis / Faróis de\r/Neblina em LED / Faróis Dianteiros em Full-LED com Função de Farol Alto Automático / Ganchos Reboque Dianteiros (Cromados) / Grades Frontais com\r/acabamento cromado especial / Interior com acabamento Premium \"Jet Black com Captain Blue\" / Lanternas traseiras em LED / Rodas Aro 20\" / Pneus\r/275/60R20 / Sistema de escape traseiro duplo / Tapetes Dianteiros e Traseiros com acabamentos em carpete / Teto solar elétrico / Carregador wireless por\r/indução para dispositivos compatíveis* / Chevrolet MyLink - tela LCD sensível ao toque de 13.4\" com integração do sistema \"Google-built-in\" e de\r/smartphones* através do Android Auto e Apple CarPlay / Painel de instrumentos com tela LCD 12\" colorido e configurável / Portas USB dianteiras e traseiras\r// Projeção da tela do smartphone sem o uso de cabo / Controle de troca de marchas por borboleta no volante \"Paddle Shift\" / Radio AM/FM, função audio\r/streaming, comandos de voz, conexão bluetooth para celular e configurações do veículo / Sistema Bose® Premium de áudio com 7 auto-falantes e subwoofer\r// Wi-Fi embarcado no veiculo para até 7 dispositivos eletrônicos**', '2025-05-09 13:22:32', '2025-05-09 13:22:32'),
(14, '5C752S', 'R7S', NULL, '7 lugares / 6 airbags / Alarme Anti-furto / Assistente de partida em aclive / Controle eletrônico de estabilidade e tração / Luzes\r/indicadoras de direção laterais / Regulagem de altura dos faróis / Sistema de fixação de cadeiras para crianças (\"Isofix e Top\r/Tether\") / Alavanca do freio de mão com detalhe cromado / Maçanetas externas na cor do veículo / Painel de instrumentos\r/digital de 8\" configurável / Parachoques pintados na cor do veículo / Conjunto roda de aço e pneu sobressalente aro 16\" / Trava\r/elétrica da tampa de combústivel / Coluna de direção com regulagem em altura / Limpador e lavador elétrico do vidro traseiro /\r/Trava elétrica das portas com acionamento na chave / Vidro elétrico nas portas com acionamento por \"um toque\", anti\r/esmagamento e abertura / Fechamento automático pela chave / Banco do motorista com regulagem de altura / Banco da\r/segunda fileira bipartido e rebatível / Banco da segunda fileira corrediço / Encostos de cabeça laterais e central do banco da\r/segunda fileira / Encosto de cabeça dos bancos dianteiros com ajuste de altura / Molduras de proteção lateral na cor preta /\r/Antena no Teto / Espelhos retrovisores externos elétricos na cor do veículo / Rack de teto na cor prata / Câmera de ré digital /\r/Controles de Rádio e do Celular no Volante / Chevrolet MyLink, com Tela LCD sensível ao toque de 11\", integração com\r/smartphones através do Android Auto e Apple CarPlay, Radio AM/FM, Função Audio Streaming / Conjunto de alto falantes - 4\r/unidades / Entrada USB dupla (tipo A e Tipo C) / Entrada USB dupla para o banco traseiro (tipo A, apenas carregamento) / Luz\r/de condução diurna em LED / Faróis dianteiros em LED / Lanterna em LED / Alerta de frenagem de emergência / OnStar / WiFi embarcado no veiculo para até 7 dispositivos eletrônicos / Transmissão automática de seis velocidades com opção de troca\r/manual de marchas \"Active Select\" / Controlador de velocidade de cruzeiro com comandos no volante / Dutos de ar para o\r/banco traseiro no console central / Roda de alumínio aro 16\" / Bancos híbridos (tecido e revestimento premium) /\r/Acendimento automático dos faróis através de sensor crepuscular / Sensor de chuva com ajuste automático de\r/intensidade / Sensor de estacionamento traseiro / Volante com revestimento premium / Easy Start - Partida sem\r/chave / Ar-condicionado digital automático / Terceira fileira de assentos com banco rebatível', '2025-05-09 13:24:07', '2025-05-09 13:24:07'),
(15, '5X76DS', 'R8C', NULL, '06 Airbags (frontais, laterais e de cortina)\r/Alarme Anti-furto\r/Ar condicionado\r/Assistente de partida em aclive\r/Banco\r/traseiro bipartido e rebatível\r/Bluetooth para até 2 celulares simultaneamente\r/Câmera de ré\r/Chevrolet MyLink, com Tela\r/LCD sensível ao toque de 8\", integração com smartphones através do Apple CarPlay e Android Auto, Radio AM\r/FM, e Entrada\r/USB\r/Coluna de direção com regulagem em altura e profundidade\r/Computador de bordo com informações de viagem, do\r/veículo e consumo\r/Conjunto de alto falantes - 4 unidades\r/Controlador de velocidade de cruzeiro com comandos no volante\r/\r/Controle de estabilidade e tração\r/Controles de rádio e do celular no volante\r/Direção Elétrica Progressiva\r/Easy Entry -\r/Abertura das portas e alarme anti-furto através de sensor de aproximação na chave\r/Easy Start - Partida sem chave\r/\r/Espelhos retrovisores externos elétricos na cor do veículo\r/Grade frontal com detalhes cromados\r/Indicador de nível de vida\r/de óleo\r/Luz de condução diurna\r/Maçanetas externas na cor do veículo\r/Maçanetas internas na cor prata\r/Onstar\r/Painel\r/de Instrumentos 3,5” digital TFT\r/Parachoques pintados na cor do veículo\r/Projeção da tela do smartphone sem o uso de\r/cabo\r/Rack de teto na cor preto\r/Rodas de aço aro 16\" com calotas integrais\r/Sensor Crepuscular\r/Sistema de fixação de\r/cadeiras para crianças (\"Isofix\") e (\"Top Tether\")\r/Sistema de freios com ABS e sistema de distribuição de frenagem (\"EBD\")\r/\r/Transmissão automática de seis velocidades com opção de troca manual (modo de seleção de marcha eletrônico ERS)\r/\r/Trava elétrica das portas com acionamento na chave\r/Vidro elétrico nas portas com acionamento por \"um toque\", anti\r/esmagamento e fechamento\r/abertura automática pela chave\r/Wi-Fi', '2025-05-09 13:25:05', '2025-05-29 03:47:46'),
(16, 'SemModelo', '000', 'MKBKPRHCVPJ528324', 'Opcional não cadastrado', '2025-05-14 02:03:15', '2025-05-14 02:03:15'),
(17, 'SemModelo', '000', '8GUW1N561F4599009', 'Opcional não cadastrado', '2025-05-14 02:17:51', '2025-05-14 02:17:51'),
(18, 'SemModelo', '000', '3S7YNHWU8RG662966', 'Opcional não cadastrado', '2025-05-14 02:18:14', '2025-05-14 02:18:14'),
(19, 'SemModelo', '000', 'D4B6PTAGWK0903788', 'Opcional não cadastrado', '2025-05-14 02:20:50', '2025-05-14 02:20:50'),
(20, 'SemModelo', '000', 'UEHRCCRNRRK519649', 'Opcional não cadastrado', '2025-05-14 02:23:51', '2025-05-14 02:23:51'),
(21, 'SemModelo', '000', '1JT2J0WMR65988891', 'Opcional não cadastrado', '2025-05-14 03:21:02', '2025-05-14 03:21:02'),
(22, 'SemModelo', '000', 'B1BSRU0PNMZ175639', 'Opcional não cadastrado', '2025-05-14 03:22:14', '2025-05-14 03:22:14'),
(23, 'SemModelo', '000', 'MKBKPRHCVPJ528300', 'ELETRICO', '2025-05-14 03:24:25', '2025-05-14 03:32:43'),
(25, 'SemModelo', '000', '77777', 'VEICULO COMPLETO', '2025-05-18 20:34:30', '2025-05-24 04:39:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `propostas`
--

CREATE TABLE `propostas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cliente` bigint(20) UNSIGNED NOT NULL,
  `id_veiculoNovo` bigint(20) UNSIGNED DEFAULT NULL,
  `id_veiculoUsado1` bigint(20) UNSIGNED DEFAULT NULL,
  `id_veiculoUsado2` bigint(20) UNSIGNED DEFAULT NULL,
  `id_veiculoUsado3` bigint(20) UNSIGNED DEFAULT NULL,
  `id_negociacao` bigint(20) UNSIGNED DEFAULT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `id_user_aprovacao_gerencial` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user_aprovacao_financeira` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user_aprovacao_banco` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user_aprovacao_diretoria` bigint(20) UNSIGNED DEFAULT NULL,
  `data_proposta` date NOT NULL,
  `dta_faturamento` date DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Pendente',
  `observacao_nota` text DEFAULT NULL,
  `observacao_interna` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `propostas`
--

INSERT INTO `propostas` (`id`, `id_cliente`, `id_veiculoNovo`, `id_veiculoUsado1`, `id_veiculoUsado2`, `id_veiculoUsado3`, `id_negociacao`, `id_usuario`, `id_user_aprovacao_gerencial`, `id_user_aprovacao_financeira`, `id_user_aprovacao_banco`, `id_user_aprovacao_diretoria`, `data_proposta`, `dta_faturamento`, `status`, `observacao_nota`, `observacao_interna`, `created_at`, `updated_at`) VALUES
(14, 47, 76, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, '2025-05-10', '2025-05-10', 'Faturada', 'Observação da Nota (visível ao cliente)', 'Observação Interna (uso administrativo)', '2025-05-11 02:49:41', '2025-05-15 14:24:17'),
(15, 7, 118, 467, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, '2025-05-11', NULL, 'pendente', 'VENDA COM ALIENACAO FIDUCIARIA EM FAVOR DE BANCO GM', 'CORTESIA CAPOTA MARITIMA', '2025-05-11 04:04:40', '2025-05-11 04:04:40'),
(16, 4, 114, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, '2025-05-11', NULL, 'pendente', 'Observação da Nota (visível ao cliente)', 'Observação Interna (uso administrativo)', '2025-05-11 04:43:35', '2025-05-11 04:43:35'),
(18, 51, 78, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, '2025-05-14', '2025-06-02', 'Faturada', 'SEM RESERVA', 'INSTALAR PELICULA', '2025-05-14 03:25:29', '2025-05-15 13:38:52'),
(19, 51, 83, NULL, NULL, NULL, NULL, 67, NULL, NULL, NULL, NULL, '2025-05-14', NULL, 'rejeitada', 'CONSORCIO BB CARTA NRO 1', 'PRESENTE PARA ESPOSA', '2025-05-14 04:29:49', '2025-05-15 06:04:46'),
(20, 51, 116, 461, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, '2025-05-17', NULL, 'pendente', 'VENDA COM ALIENACAO FIDUCIARAIA EM FAVOR DO BANDO GM', 'ENTREGAR O VEICULO COM RASREADOR', '2025-05-17 13:38:10', '2025-05-17 13:38:10'),
(21, 1, 80, 610, NULL, NULL, NULL, 11, 64, 62, 23, 24, '2025-05-18', '2025-05-18', 'Faturada', NULL, NULL, '2025-05-18 20:39:29', '2025-06-01 03:31:38'),
(23, 1, 117, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, 11, '2025-05-18', '2025-06-02', 'Faturada', NULL, NULL, '2025-05-19 01:05:00', '2025-06-02 15:12:42'),
(24, 9, 79, NULL, NULL, NULL, NULL, 64, NULL, NULL, NULL, NULL, '2025-05-24', '2025-05-24', 'Faturada', NULL, NULL, '2025-05-24 03:44:14', '2025-05-29 17:19:07'),
(28, 4, 114, 459, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, '2025-06-02', NULL, 'Aprovada', 'Observação da Nota (visível ao cliente)', 'Observação Interna (uso administrativo)', '2025-06-02 18:19:37', '2025-06-02 18:21:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `level` varchar(191) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Leda Effertz', 'jorge.zboncak@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '1YalKMoPvq', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(2, 'Nicola Haag DDS', 'pgleichner@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'XXPfjEkVkR', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(3, 'Keshawn Ondricka', 'qgulgowski@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '2GgpgqSvIK', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(4, 'Oceane Thiel', 'estefania45@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'wB4hzXcr2c', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(5, 'Dr. Raymundo Emard DVM', 'bcrist@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'WV7YHXBS6U', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(6, 'Muriel Hilpert', 'king.liam@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'TelUI6j1ji', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(7, 'Felicita Smith', 'verdie31@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '3qJpBSFAvF', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(8, 'Eudora Ernser', 'corwin.forrest@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'IWrEHD94QK', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(9, 'Dr. Emory Swaniawski MD', 'doug38@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'I43W6DG1Vw', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(10, 'Horacio Lemke DVM', 'scole@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'RYZQJtnkci', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(11, 'Givanildo Teixeira', 'givanildo@guarachevrolet.com.br', '2025-03-20 03:07:34', '$2y$10$qYVsI51VL9Wg3qHqOExGe.WyOnPAywrCUh/UL0qiPAKGfHYOM48hK', 'admin', 'u0jBreROxrdYg4gReeJKOOFhvBd0GFyZZnhsNJRtwORUBZ2ymVUFCy4eEmKg', '2025-03-20 03:07:34', '2025-03-20 03:08:23', 1),
(12, 'Fredrick Glover', 'dana98@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'UiNZf7DG7e', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(13, 'Gennaro Wyman', 'pkeeling@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'zV7c4GwLNl', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(14, 'Prof. Casandra Hettinger III', 'jerrod83@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'rb08i4seBW', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(15, 'Dr. Riley Rippin Jr.', 'lschmitt@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '96xf43lzfA', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(16, 'Hiram Kreiger', 'abbie33@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '6U3MwkYGDz', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(17, 'Rafael Thiel', 'goldner.rowena@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '8AsaprAejq', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(18, 'Prof. Faustino Marks', 'maybelle91@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '0P5Z6R5JLb', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(19, 'Nick Auer', 'mante.carlo@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'Dlhyh2Rljx', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(20, 'Vergie Weissnat', 'freda.kessler@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '9c31ZKNiV2', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(21, 'D\'angelo Zulauf', 'thompson.margarete@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'D6UpZvMw8m', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(22, 'Dr. Ofelia Simonis', 'kenna73@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'dNaL3JvyBq', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(23, 'Gavin Barrows', 'xaltenwerth@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'JJLbE6uwom', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(24, 'Rosario Stamm', 'kyleigh.hessel@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'rGr4vpE0X8', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(25, 'Cary Hartmann', 'fgusikowski@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'bG8PlweMKv', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(26, 'Miss Jaida Glover III', 'antonette49@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'ddzjN02L3E', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(27, 'Sydnie Block', 'scotty.hessel@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '6RTQkTJ7b1', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(28, 'Dominic Bode V', 'mhansen@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'SKF8BI0PyV', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(29, 'Cyrus Ankunding', 'jarrell.toy@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'kC4RTzPoKi', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(30, 'Osvaldo Rogahn', 'van.oreilly@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'O3rj8PCwGx', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(31, 'Velva Lemke', 'annabelle.donnelly@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'YEJxYuiCU2', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(32, 'Dr. Rahsaan Volkman', 'kiehn.kavon@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'nDYuwKAh6B', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(33, 'Patricia Wilkinson', 'linda.mcdermott@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'ETEy7EudzN', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(34, 'Mable Yost', 'ezra.greenfelder@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'uhNIzOMWyQ', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(35, 'Dr. Marcelo Baumbach', 'reggie.herzog@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'v0GxlAz3hx', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(36, 'Mr. Lyric Bins I', 'orn.diego@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'Ab8rhuldCo', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(37, 'Prof. Holden Cummerata', 'rath.abe@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'ZUdeYoIPVu', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(38, 'Cleveland Murray', 'wiegand.beatrice@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'bcIuOi5gSo', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(39, 'Isaiah Upton', 'hgibson@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '7SL18gMiwa', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(40, 'Doris Beahan', 'kelsie21@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'qvcgwwKgw2', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(41, 'Janiya Waelchi', 'ygreen@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'I2jpct0NLV', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(42, 'Deja Predovic', 'eldred80@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'I0HNGvF35T', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(43, 'Daniella Welch', 'stanley.tromp@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'YYlUVJt8uP', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(44, 'Simone Schmeler', 'mhartmann@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'apPokSCVoF', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(45, 'Dr. Orpha Rosenbaum Sr.', 'zmorissette@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'PGF4HfpDmo', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(46, 'Ewald Medhurst II', 'harris.bonnie@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', '8CVQPQbTbC', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(47, 'Tatum Goldner', 'berenice07@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'ycH9y1Tw08', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(48, 'Mrs. Marianne Romaguera', 'pouros.roel@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'GBtq4LKpIx', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(49, 'Alysha Pollich Jr.', 'pveum@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'j2tuF3ErkeKumzXxAVSYTW5nDb1vlaaRZRFaI0azbiCaOCSFvlC5BICsaYSY', '2025-03-20 03:07:34', '2025-03-20 05:34:36', 1),
(50, 'Miss Kirsten Schroeder', 'cremin.nyah@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'RTjitUFu5y', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(51, 'Diego Streich', 'flatley.antonietta@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'LusFA8DZTm', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(52, 'Mr. Arch Rutherford MD', 'deckow.laurie@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'px3ovE3vBK', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(53, 'Prof. Caroline Stanton', 'kathryne21@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'rcRP5k0BWo', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(54, 'Marcelo Thiel', 'lavonne14@example.org', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'HEQ7c1eiaf', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(55, 'Prof. Tyrique Kilback', 'arunte@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'ZTzmC7MOis', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(56, 'Naomie Hudson', 'rmcdermott@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'OdbX1m2YKk', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(57, 'Kolby Shields', 'treutel.bernita@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'UgP9NboRju', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(58, 'Libby Bergnaum', 'wolff.mellie@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'dPMvDCwkst', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(59, 'Rowan Abernathy PhD', 'mohr.alfredo@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'uA8aPbxXhB', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(60, 'Miss Mozelle Crooks', 'cecil.collins@example.com', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'KWQV1X5gZy', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(61, 'Bessie Lesch', 'mavis.hessel@example.net', '2025-03-20 03:07:34', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vendedor', 'NYYOyWJgA1', '2025-03-20 03:07:34', '2025-03-20 03:07:34', 1),
(62, 'Eleandro', 'eleandro@teste.com', NULL, '$2y$10$5lJJc7GryGeKDPp0Ukh35.KQIf0eX7owPBX.1h0RavnnYPM2N2H6W', 'admin', NULL, '2025-05-14 04:15:27', '2025-05-14 04:17:38', 1),
(63, 'Denis', 'denis@teste.com', NULL, '$2y$10$d.1vPxSrGu4CSZ37zZTQ..cdhg3Ha/8GoYkNkIMiWwPNq5yD6LvHO', 'admin', NULL, '2025-05-14 04:15:49', '2025-05-14 04:17:55', 1),
(64, 'Gerentes da empresa', 'gerente@teste.com', NULL, '$2y$10$tubJy5MW1re/r51mbRhLweEPJGzHy4ouvbCcl93MWc0iJ0oOJ5o96', 'Gerente', NULL, '2025-05-14 04:16:15', '2025-05-14 04:18:06', 1),
(65, 'Assistente da empresa', 'assistente@teste.com', NULL, '$2y$10$u12qsIeKd9P.3fFTeiyWBuZBOQXp4I3Gl1ESxYVdMqeZ7Dx1.KwX2', 'Assistente', NULL, '2025-05-14 04:16:51', '2025-05-14 04:18:15', 1),
(66, 'Diretor', 'diretor@teste.com', NULL, '$2y$10$N3.oA1uPe9b26L6sP.HozeR5h87oSvfE.LJ6mYVTjIu3IO8XSoO.K', 'Diretor', NULL, '2025-05-14 04:17:14', '2025-05-14 04:18:23', 1),
(67, 'Vendedor Teste', 'vendedor@teste.com', NULL, '$2y$10$.fhwW4dt1foyJ/qjHu7vOenNYyKnlLlbiFCkl7xhS47qG9C0HrjU6', 'Vendedor', NULL, '2025-05-14 04:19:16', '2025-05-14 04:19:44', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `promocao` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(191) NOT NULL DEFAULT '',
  `chassi` varchar(191) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `novo_usado` varchar(191) NOT NULL,
  `marca` varchar(191) NOT NULL,
  `familia` varchar(191) NOT NULL,
  `desc_veiculo` varchar(191) NOT NULL,
  `modelo_fab` varchar(191) NOT NULL,
  `cor` varchar(191) NOT NULL,
  `cod_opcional` varchar(191) NOT NULL,
  `combustivel` varchar(191) NOT NULL,
  `transmissao` varchar(191) DEFAULT NULL,
  `Ano_Mod` varchar(191) NOT NULL,
  `motor` varchar(191) NOT NULL,
  `portas` varchar(191) NOT NULL,
  `vlr_tabela` decimal(10,2) NOT NULL,
  `vlr_bonus` decimal(10,2) NOT NULL,
  `vlr_nota` decimal(10,2) NOT NULL,
  `local` varchar(191) NOT NULL,
  `dta_faturamento` date NOT NULL,
  `user_reserva` varchar(191) NOT NULL,
  `desc_nota` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dta_vencimento` date DEFAULT NULL,
  `pago` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `ativo`, `promocao`, `status`, `chassi`, `placa`, `novo_usado`, `marca`, `familia`, `desc_veiculo`, `modelo_fab`, `cor`, `cod_opcional`, `combustivel`, `transmissao`, `Ano_Mod`, `motor`, `portas`, `vlr_tabela`, `vlr_bonus`, `vlr_nota`, `local`, `dta_faturamento`, `user_reserva`, `desc_nota`, `created_at`, `updated_at`, `dta_vencimento`, `pago`) VALUES
(76, 1, 1, 'vendido', '9BGEY43T0SB218888', '', 'Novo', 'GM', 'Montana', 'MONTANA 1.2T', '5A43BS', 'Branco Summit', 'R8A', 'Etanol', 'Mecânica', '2024/2025', '1.2', '5', 137990.00, 2500.00, 123300.00, 'Transito', '2025-01-01', '', '', NULL, '2025-06-01 05:25:23', '2025-06-08', 1),
(77, 1, 0, 'estoque', '9BGEY43T0SB218871', '', 'Novo', 'GM', 'Montana', 'MONTANA PREMIER', '5Y43TS', 'Prata Shark', 'RFE', 'Flex', 'Automática', '2024/2025', '1.2', '4', 169200.00, 0.00, 158000.00, 'Matriz', '2025-01-01', '', '', NULL, '2025-05-28 03:27:19', NULL, 0),
(78, 1, 0, 'vendido', '9BGEA48A0SG221985', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0A', '5A48AS', 'Branco Summit', 'R7A', 'Flex', 'Mecânica', '2024/2025', '1.0', '4', 96300.00, 5000.00, 88100.00, 'Matriz', '2025-01-01', '', '', NULL, '2025-06-01 05:30:25', '2025-06-08', 1),
(79, 1, 0, 'vendido', '9BGEA48A0SG222404', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0A', '5A48AS', 'BRANCO SUMMIT', 'R7A', 'Flex', 'Mecânica', '2024/2025', '1.0', '4', 96300.00, 5000.00, 88100.00, 'Filial', '2025-01-01', '', '', NULL, '2025-06-01 03:31:16', '2025-06-11', 0),
(80, 1, 0, 'vendido', '9BGEA48A0SG230868', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0A', '5A48AS', 'BRANCO SUMMIT', 'R7A', 'Flex', 'Mecânica', '2024/2025', '1.0', '4', 96300.00, 5000.00, 88100.00, 'Matriz', '2025-01-01', '', '', NULL, '2025-06-01 03:31:38', '2025-06-11', 0),
(81, 1, 1, 'estoque', '9BGEB48A0SG222769', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0A LT', '5B48AS', 'Branco Summit', 'RGH', 'Flex', 'Mecânica', '2024/2025', '1.0', '4', 102800.00, 7100.00, 92479.00, 'Matriz', '2025-01-01', '', '', NULL, '2025-05-29 04:15:42', NULL, 0),
(82, 1, 0, 'estoque', '9BGEB48A0SG222872', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0A LT', '5B48AS', 'BRANCO SUMMIT', 'RGH', 'Flex', 'Mecânica', '2024/2025', '1.0', '4', 102800.00, 7100.00, 93900.00, 'Filial', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(83, 1, 0, 'estoque', '9BGEB48A0SG222869', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0A LT', '5B48AS', 'Branco Summit', 'RGH', 'Flex', 'Mecânica', '2024/2025', '1.0', '4', 102800.00, 7100.00, 93900.00, 'Transito', '2025-01-01', '', '', NULL, '2025-05-28 00:31:08', NULL, 0),
(84, 1, 0, 'estoque', '9BGEB48A0SG222856', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0A LT', '5B48AS', 'BRANCO SUMMIT', 'RGH', 'Flex', 'Mecânica', '2024/2025', '1.0', '4', 102800.00, 7100.00, 93900.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(85, 1, 0, 'estoque', '9BGEB48A0SG228521', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0A LT', '5B48AS', 'BRANCO SUMMIT', 'RGH', 'Flex', 'Mecânica', '2024/2025', '1.0', '4', 102800.00, 7100.00, 93900.00, 'Filial', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(86, 1, 0, 'estoque', '9BGEB48A0SG231277', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0A LT', '5B48AS', 'BRANCO SUMMIT', 'RGH', 'Flex', 'Mecânica', '2024/2025', '1.0', '4', 102800.00, 7100.00, 93900.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(87, 1, 0, 'estoque', '9BGEB48A0SG231318', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0A LT', '5B48AS', 'BRANCO SUMMIT', 'RGH', 'Flex', 'Mecânica', '2024/2025', '1.0', '4', 102800.00, 7100.00, 93900.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(88, 1, 0, 'estoque', '9BGEN48H0SG228649', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0T LTZ', '5N48HS', 'Branco Summit', 'RGM', 'Flex', 'Automática', '2024/2025', '1.0', '4', 122900.00, 2000.00, 110400.00, 'Filial', '2025-01-01', '', '', NULL, '2025-05-09 13:15:35', NULL, 0),
(89, 1, 0, 'estoque', '9BGEN48H0SG231494', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0T LTZ', '5N48HS', 'PRATA SHARK', 'RGM', 'Flex', 'Automática', '2024/2025', '1.0', '4', 123600.00, 2000.00, 111100.00, 'Transito', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(90, 1, 0, 'estoque', '9BGEN48H0SG231514', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0T LTZ', '5N48HS', 'PRATA SHARK', 'RGM', 'Flex', 'Automática', '2024/2025', '1.0', '4', 123600.00, 2000.00, 111100.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(91, 1, 0, 'estoque', '9BGEY48H0SG176048', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0T PREMIER', '5Y48HS', 'Branco Summit', 'R7R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 128500.00, 5500.00, 115783.00, 'Matriz', '2025-01-01', '', '', NULL, '2025-05-09 13:15:59', NULL, 0),
(92, 1, 0, 'estoque', '9BGEY48H0SG186422', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0T PREMIER', '5Y48HS', 'BRANCO SUMMIT', 'R7R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 128500.00, 5500.00, 113200.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(93, 1, 0, 'estoque', '9BGEY48H0SG221381', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0T PREMIER', '5Y48HS', 'BRANCO SUMMIT', 'R7R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 128500.00, 2000.00, 115500.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(94, 1, 0, 'estoque', '9BGEY48H0SG234188', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0T PREMIER', '5Y48HS', 'CINZA DRAKE', 'R7R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 129200.00, 2000.00, 116200.00, 'Filial', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(95, 1, 0, 'estoque', '9BGEY48H0SG234412', '', 'Novo', 'GM', 'Onix', 'ONIX 1.0T PREMIER', '5Y48HS', 'VERMELHO CARMIM', 'R7R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 129200.00, 2000.00, 116200.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(96, 1, 0, 'estoque', '9BGEY69H0SG176336', '', 'Novo', 'GM', 'Onix', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'Branco Summit', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 135900.00, 5500.00, 122557.00, 'Matriz', '2025-01-01', '', '', NULL, '2025-05-09 13:17:51', NULL, 0),
(97, 1, 0, 'estoque', '9BGEY69H0SG195820', '', 'Novo', 'GM', 'Onix', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'BRANCO SUMMIT', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 135900.00, 2000.00, 122300.00, 'Filial', '2025-01-01', '', '', NULL, '2025-04-07 01:02:18', NULL, 0),
(98, 1, 0, 'estoque', '9BGEY69H0SG196079', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'BRANCO SUMMIT', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 135900.00, 2000.00, 122300.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(99, 1, 0, 'estoque', '9BGEY69H0SG196883', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'BRANCO SUMMIT', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 135900.00, 2000.00, 122300.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(100, 1, 0, 'estoque', '9BGEY69H0SG176173', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'BRANCO SUMMIT', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 135900.00, 2000.00, 122300.00, 'Transito', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(101, 1, 0, 'estoque', '9BGEY69H0SG176317', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'BRANCO SUMMIT', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 135900.00, 2000.00, 122300.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(102, 1, 0, 'estoque', '9BGEY69H0SG190520', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'CINZA DRAKE', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 136600.00, 2000.00, 123000.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(103, 1, 0, 'estoque', '9BGEY69H0SG190529', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'CINZA DRAKE', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 136600.00, 2000.00, 123000.00, 'Filial', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(104, 1, 0, 'estoque', '9BGEY69H0SG192146', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'CINZA DRAKE', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 136600.00, 2000.00, 123000.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(105, 1, 0, 'estoque', '9BGEY69H0SG217625', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'CINZA DRAKE', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 136600.00, 2000.00, 123000.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(106, 1, 0, 'estoque', '9BGEY69H0SG203634', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'PRATA SHARK', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 136600.00, 2000.00, 123000.00, 'Filial', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(107, 1, 0, 'estoque', '9BGEY69H0SG219745', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'PRATA SHARK', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 136600.00, 2000.00, 123000.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(108, 1, 0, 'estoque', '9BGEY69H0SG238580', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'PRATA SHARK', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 136600.00, 2000.00, 123000.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(109, 1, 0, 'estoque', '9BGEY69H0SG188732', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'PRETO OURO NEGRO', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 134900.00, 2000.00, 121400.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(110, 1, 0, 'estoque', '9BGEY69H0SG182931', '', 'Novo', 'GM', 'Onix', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'PRETO OURO NEGRO', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 134900.00, 2000.00, 119363.00, 'Transito', '2025-01-01', '', '', NULL, '2025-04-07 01:01:38', NULL, 0),
(111, 1, 0, 'estoque', '9BGEY69H0SG192986', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'PRETO OURO NEGRO', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 134900.00, 2000.00, 121400.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(112, 1, 0, 'estoque', '9BGEY69H0SG193012', '', 'Novo', 'GM', 'Onix Plus', 'ONIX PLUS 1.0T PREMIER', '5Y69HS', 'PRETO OURO NEGRO', 'R8R', 'Flex', 'Automática', '2024/2025', '1.0', '4', 134900.00, 2000.00, 121400.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(113, 1, 0, 'estoque', '9BG148PK0SC425762', '', 'Novo', 'GM', 'S10', 'S10 HIGH COUNTRY', '148PKS', 'Cinza Moss', 'R7U', 'Diesel', 'Automática', '2024/2025', '2.2', '4', 324500.00, 0.00, 292900.00, 'Transito', '2025-01-01', '', '', NULL, '2025-05-09 13:19:15', NULL, 0),
(114, 1, 0, 'negociacao', '9BG148PK0SC427193', '', 'Novo', 'GM', 'S10', 'S10 HIGH COUNTRY', '148PKS', 'CINZA TOPAZIO', 'R7U', 'Diesel', 'Mecanica', '2024/2025', '2.2', '4', 325600.00, 0.00, 285292.00, 'Matriz', '2025-01-01', '', '', NULL, '2025-06-02 18:21:21', NULL, 0),
(115, 1, 0, 'estoque', '9BG148PK0SC419423', '', 'Novo', 'GM', 'S10', 'S10 HIGH COUNTRY', '148PKS', 'PRATA SHARK', 'R7U', 'Diesel', 'Automática', '2024/2025', '2.2', '4', 325600.00, 0.00, 285292.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(116, 1, 0, 'estoque', '9BG148PK0SC426958', '', 'Novo', 'GM', 'S10', 'S10 HIGH COUNTRY', '148PKS', 'PRATA SHARK', 'R7U', 'Diesel', 'Automática', '2024/2025', '2.2', '4', 325600.00, 0.00, 285292.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(117, 1, 0, 'vendido', '3GCUD9ED5RG241065', '', 'Novo', 'GM', 'Silverado', 'SILVERADO HIGH COUNTRY', '3PJEDR', 'Cinza Rush', 'PEB', 'Gasolina', 'Automática', '2024/2024', '4.3', '4', 540000.00, 40000.00, 472100.00, 'Filial', '2025-01-01', '', '', NULL, '2025-06-02 15:10:24', '2025-06-12', 0),
(118, 1, 0, 'estoque', '3GCUD9ED5RG388955', '', 'Novo', 'GM', 'Silverado', 'SILVERADO HIGH COUNTRY', '3PJEDR', 'PRETO GLOBAL', 'PEB', 'Gasolina', 'Automática', '2024/2024', '4.3', '4', 540000.00, 0.00, 430300.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(119, 1, 0, 'estoque', '9BGJC7520SB242378', '', 'Novo', 'GM', 'Spin', 'SPIN LTZ', '5C752S', 'Branco Summit', 'R7S', 'Flex', 'Automática', '2025/2025', '1.2', '4', 144600.00, 0.00, 135100.00, 'Matriz', '2025-01-01', '', '', NULL, '2025-05-09 13:24:07', NULL, 0),
(120, 1, 0, 'estoque', '9BGEX76D0SB221022', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T', '5X76DS', 'Azul Boreal', 'R8C', 'Flex', 'Automática', '2024/2025', '1.0', '4', 120000.00, 0.00, 114038.00, 'Matriz', '2025-01-01', '', '', NULL, '2025-05-29 03:48:04', NULL, 0),
(121, 1, 0, 'estoque', '9BGEX76H0SB208650', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T', '5X76HS', 'Azul Boreal', 'RFC', 'Flex', 'Automática', '2024/2025', '1.0', '4', 120000.00, 0.00, 117500.00, 'Matriz', '2025-01-01', '', '', NULL, '2025-05-09 13:26:11', NULL, 0),
(122, 1, 0, 'estoque', '9BGEX76H0SB208735', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T', '5X76HS', 'Azul Boreal', 'RFC', 'Flex', 'Automática', '2024/2025', '1.0', '4', 120000.00, 0.00, 117500.00, 'Transito', '2025-01-01', '', '', NULL, '2025-04-20 02:52:40', NULL, 0),
(123, 1, 0, 'estoque', '9BGEX76H0SB208808', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T', '5X76HS', 'AZUL BOREAL', 'RFC', 'Flex', 'Automática', '2024/2025', '1.0', '4', 120000.00, 0.00, 117500.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(124, 1, 0, 'estoque', '9BGEX76H0SB208822', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T', '5X76HS', 'AZUL BOREAL', 'RFC', 'Flex', 'Automática', '2024/2025', '1.0', '4', 120000.00, 0.00, 117500.00, 'Transito', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(125, 1, 0, 'estoque', '9BGEX76H0SB206949', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T', '5X76HS', 'BRANCO SUMMIT', 'RFC', 'Flex', 'Automática', '2024/2025', '1.0', '4', 120000.00, 0.00, 117500.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(126, 1, 0, 'estoque', '8AGEB76H0SR112866', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T LT', '3B76HS', 'AZUL BOREAL', 'R9S', 'Flex', 'Automática', '2024/2025', '1.0', '4', 152000.00, 3000.00, 132400.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(127, 1, 0, 'estoque', '8AGEB76H0SR121498', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T LT', '3B76HS', 'BRANCO SUMMIT', 'R9S', 'Flex', 'Automática', '2024/2025', '1.0', '4', 153000.00, 3000.00, 129394.00, 'Filial', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(128, 1, 0, 'estoque', '8AGEB76H0SR121661', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T LT', '3B76HS', 'CINZA RUSH', 'R9S', 'Flex', 'Automática', '2024/2025', '1.0', '4', 153900.00, 3000.00, 134200.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(129, 1, 0, 'estoque', '8AGEB76H0SR112361', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T LT', '3B76HS', 'VERMELHO CHILI', 'R9S', 'Flex', 'Automática', '2024/2025', '1.0', '4', 153900.00, 6500.00, 133300.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(130, 1, 0, 'estoque', '9BGEB76H0SB192589', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T LT', '5B76HS', 'BRANCO SUMMIT', 'RFD', 'Flex', 'Automática', '2024/2025', '1.0', '4', 153000.00, 3000.00, 133600.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(131, 1, 0, 'estoque', '9BGEN76D0SB218857', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.0T LTZ', '5N76DS', 'PRATA SHARK', 'R8F', 'Flex', 'Automática', '2024/2025', '1.0', '4', 169100.00, 0.00, 148000.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(132, 1, 0, 'estoque', '8AGEP76B0SR106575', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'BRANCO SUMMIT', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 188000.00, 7000.00, 162469.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(133, 1, 0, 'estoque', '8AGEP76B0SR118874', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'BRANCO SUMMIT', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 188000.00, 7000.00, 164500.00, 'Transito', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(134, 1, 0, 'estoque', '8AGEP76B0SR113388', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'BRANCO SUMMIT', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 188000.00, 7000.00, 164500.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(135, 1, 0, 'estoque', '8AGEP76B0SR116736', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'BRANCO SUMMIT', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 188000.00, 7000.00, 159621.00, 'Filial', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(136, 1, 0, 'estoque', '8AGEP76B0SR116734', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'BRANCO SUMMIT', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 188000.00, 7000.00, 159621.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(137, 1, 0, 'estoque', '8AGEP76B0SR114748', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'CINZA RUSH', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 189900.00, 7000.00, 165300.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(138, 1, 0, 'estoque', '8AGEP76B0SR117821', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'CINZA RUSH', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 189900.00, 7000.00, 160435.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(139, 1, 0, 'estoque', '8AGEP76B0SR118160', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'PRATA SHARK', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 189900.00, 7000.00, 165300.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(140, 1, 0, 'estoque', '8AGEP76B0SR116505', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'PRATA SHARK', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 189900.00, 7000.00, 160435.00, 'Transito', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(141, 1, 0, 'estoque', '8AGEP76B0SR119408', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'PRATA SHARK', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 189900.00, 7000.00, 165300.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(142, 1, 0, 'estoque', '8AGEP76B0SR119416', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '3P76BS', 'PRATA SHARK', 'R9S', 'Flex', 'Automática', '2024/2025', '1.2', '4', 189900.00, 7000.00, 165300.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(143, 1, 0, 'estoque', '9BGEP76B0SB170905', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '5P76BS', 'AZUL BOREAL', 'RFG', 'Flex', 'Automática', '2024/2025', '1.2', '4', 187000.00, 7000.00, 163800.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(144, 1, 0, 'estoque', '9BGEP76B0SB186012', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '5P76BS', 'CINZA MOSS', 'RFG', 'Flex', 'Automática', '2024/2025', '1.2', '4', 188000.00, 7000.00, 164700.00, 'Filial', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(145, 1, 0, 'estoque', '9BGEP76B0SB181542', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '5P76BS', 'CINZA RUSH', 'RFG', 'Flex', 'Automática', '2024/2025', '1.2', '4', 189900.00, 7000.00, 165600.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(146, 1, 0, 'estoque', '9BGEP76B0SB184972', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '5P76BS', 'CINZA RUSH', 'RFG', 'Flex', 'Automática', '2024/2025', '1.2', '4', 189900.00, 7000.00, 160681.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(147, 1, 0, 'estoque', '9BGEP76B0SB167119', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '5P76BS', 'PRETO OURO NEGRO', 'RFG', 'Flex', 'Automática', '2024/2025', '1.2', '4', 189900.00, 7000.00, 160681.00, 'Filial', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(148, 1, 0, 'estoque', '9BGEP76B0SB173807', '', 'Novo', 'GM', 'Tracker', 'TRACKER 1.2T PREMIER', '5P76BS', 'VERMELHO CHILI', 'RFG', 'Flex', 'Automática', '2024/2025', '1.2', '4', 189900.00, 7000.00, 160681.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(149, 1, 0, 'estoque', '9BG156PK0SC425825', '', 'Novo', 'GM', 'TrailBlazer', 'TRAILBLAZER HIGH COUNTRY', '156PKS', 'BRANCO SUMMIT', 'R6A', 'Diesel', 'Automática', '2024/2025', '2.2', '4', 393600.00, 0.00, 344751.00, 'Transito', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(150, 1, 0, 'estoque', '9BG156PK0SC425826', '', 'Novo', 'GM', 'TrailBlazer', 'TRAILBLAZER HIGH COUNTRY', '156PKS', 'PRETO OURO NEGRO', 'R6A', 'Diesel', 'Automática', '2024/2025', '2.2', '4', 394700.00, 0.00, 345746.00, 'Matriz', '2025-01-01', '', '', NULL, NULL, NULL, 0),
(458, 1, 0, 'estoque', 'MKBKPRHCVPJ528324', 'ABC1234', 'Usado', 'Toyota', 'Toyota', 'COROLA', 'Kicks', 'Bege', 'WWM', 'Gasolina', 'Automática', '2001/2001', '1.0', '4', 186999.16, 3959.73, 77171.92, 'Filial', '2024-11-12', '11', 'Veículo usado modelo: Kicks', '2025-03-27 00:47:55', '2025-05-14 02:04:04', NULL, 0),
(459, 1, 0, 'entrada', 'D4B6PTAGWK0903788', 'SPI9L12', 'Usado', 'Chery', 'CHEVROLET', 'SPIN', 'Spin', 'Branco', 'UIZ', 'Gasolina', 'Automática', '2018/2018', 'Elétrico', '4', 72409.35, 3907.28, 164186.56, 'Matriz', '2024-10-28', '11', 'Veículo usado modelo: Spin', '2025-03-27 00:47:55', '2025-06-02 18:21:21', NULL, 0),
(461, 1, 0, 'estoque', '8GUW1N561F4599009', 'RAN0G12', 'Usado', 'Chevrolet', 'FORD', 'RANGER', 'Ranger', 'Branco', 'CFX', 'Diesel', 'Automática', '2011/2011', '1.6', '2', 73543.15, 931.55, 94866.27, 'Matriz', '2024-10-03', '11', 'Veículo usado modelo: Ranger', '2025-03-27 00:47:55', '2025-05-14 02:17:51', NULL, 0),
(462, 1, 0, 'estoque', 'UEHRCCRNRRK519649', 'FIA4T02', 'Usado', 'BMW', 'FIAT', 'STRADA', 'Strada', 'Azul', 'CWO', 'Gasolina', 'Mecânica', '2007/2008', '3.0', '4', 75000.00, 80000.00, 78000.00, 'Matriz', '2025-02-22', '11', 'Veículo usado modelo: Strada', '2025-03-27 00:47:55', '2025-05-14 02:23:51', NULL, 0),
(465, 1, 0, 'estoque', '3S7YNHWU8RG662966', 'REN0H12', 'Usado', 'Renault', 'Renault', 'CLIO', 'March', 'Roxo', 'PWE', 'Flex', 'Automática', '2018/2018', '2.0', '4', 133658.65, 1127.18, 30137.22, 'Consignado', '2025-01-24', '11', 'Veículo usado modelo: March', '2025-03-27 00:47:55', '2025-05-14 02:18:14', NULL, 0),
(466, 1, 0, 'estoque', 'B1BSRU0PNMZ175639', 'NIH3G15', 'Usado', 'Chery', 'NISSAN', 'VERSA', 'Versa', 'Cinza', 'FMS', 'Gasolina', 'Automática', '2013/2013', '1.0', '5', 107484.61, 3727.92, 88849.48, 'Consignado', '2025-03-22', '11', 'Veículo usado modelo: Versa', '2025-03-27 00:47:55', '2025-05-14 03:22:14', NULL, 0),
(467, 1, 0, 'estoque', '1JT2J0WMR65988891', 'FFI0B120', 'Usado', 'Kia', 'FIAT', 'STRADA', 'Strada', 'Verde Claro', 'VEV', 'Gasolina', 'Automática', '2017/2017', '1.4', '4', 127077.87, 3441.16, 57933.36, 'Filial', '2025-02-08', '11', 'Veículo usado modelo: Strada', '2025-03-27 00:47:55', '2025-05-14 03:21:02', NULL, 0),
(610, 1, 0, 'estoque', '77777', 'ABC-5254', 'usado', 'FIAT', 'FIAT', 'UNO MILLLE', 'UNO MILLLE', 'VERDE', ' ', 'Gasolina', 'Mecânica', '2003/2023', '1.0', '4', 40000.00, 41000.00, 40000.00, 'Matriz', '2025-05-18', '11', 'veiculo semi novo', '2025-05-18 20:34:30', '2025-06-01 03:31:38', NULL, 0),
(616, 1, 0, 'avaliacao', '55555', 'ABC-4555', 'usado', 'FORD', 'FORD', 'RANGER', 'RANGER', 'VERDE', ' ', 'Diesel', NULL, '2024/2024', '4.6', '4', 200000.00, 200000.00, 200000.00, 'filial', '2025-05-24', '64', 'veiculo semi novo', '2025-05-24 04:09:16', '2025-05-24 04:09:16', NULL, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_user_id_foreign` (`user_id`);

--
-- Índices de tabela `condicao_pagamentos`
--
ALTER TABLE `condicao_pagamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `configuracoes_chave_unique` (`chave`);

--
-- Índices de tabela `cores`
--
ALTER TABLE `cores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cor_familia`
--
ALTER TABLE `cor_familia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cor_familia_familia_id_foreign` (`familia_id`),
  ADD KEY `cor_familia_cor_id_foreign` (`cor_id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `negociacoes`
--
ALTER TABLE `negociacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `negociacoes_id_proposta_foreign` (`id_proposta`),
  ADD KEY `negociacoes_id_cond_pagamento_foreign` (`id_cond_pagamento`);

--
-- Índices de tabela `opcionais`
--
ALTER TABLE `opcionais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `propostas`
--
ALTER TABLE `propostas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propostas_id_cliente_foreign` (`id_cliente`),
  ADD KEY `propostas_id_veiculonovo_foreign` (`id_veiculoNovo`),
  ADD KEY `propostas_id_veiculousado1_foreign` (`id_veiculoUsado1`),
  ADD KEY `propostas_id_veiculousado2_foreign` (`id_veiculoUsado2`),
  ADD KEY `propostas_id_veiculousado3_foreign` (`id_veiculoUsado3`),
  ADD KEY `propostas_id_usuario_foreign` (`id_usuario`),
  ADD KEY `propostas_id_user_provação_gerencial_foreign` (`id_user_aprovacao_gerencial`),
  ADD KEY `propostas_id_user_provação_finaneira_foreign` (`id_user_aprovacao_financeira`),
  ADD KEY `propostas_id_user_provação_banco_foreign` (`id_user_aprovacao_banco`),
  ADD KEY `propostas_id_user_provação_diretoria_foreign` (`id_user_aprovacao_diretoria`),
  ADD KEY `propostas_id_negociacao_foreign` (`id_negociacao`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `condicao_pagamentos`
--
ALTER TABLE `condicao_pagamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cores`
--
ALTER TABLE `cores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `cor_familia`
--
ALTER TABLE `cor_familia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `familias`
--
ALTER TABLE `familias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `negociacoes`
--
ALTER TABLE `negociacoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `opcionais`
--
ALTER TABLE `opcionais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `propostas`
--
ALTER TABLE `propostas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=617;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `cor_familia`
--
ALTER TABLE `cor_familia`
  ADD CONSTRAINT `cor_familia_cor_id_foreign` FOREIGN KEY (`cor_id`) REFERENCES `cores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cor_familia_familia_id_foreign` FOREIGN KEY (`familia_id`) REFERENCES `familias` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `negociacoes`
--
ALTER TABLE `negociacoes`
  ADD CONSTRAINT `negociacoes_id_cond_pagamento_foreign` FOREIGN KEY (`id_cond_pagamento`) REFERENCES `condicao_pagamentos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `negociacoes_id_proposta_foreign` FOREIGN KEY (`id_proposta`) REFERENCES `propostas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `propostas`
--
ALTER TABLE `propostas`
  ADD CONSTRAINT `propostas_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `propostas_id_negociacao_foreign` FOREIGN KEY (`id_negociacao`) REFERENCES `negociacoes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propostas_id_user_provação_banco_foreign` FOREIGN KEY (`id_user_aprovacao_banco`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propostas_id_user_provação_diretoria_foreign` FOREIGN KEY (`id_user_aprovacao_diretoria`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propostas_id_user_provação_finaneira_foreign` FOREIGN KEY (`id_user_aprovacao_financeira`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propostas_id_user_provação_gerencial_foreign` FOREIGN KEY (`id_user_aprovacao_gerencial`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propostas_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `propostas_id_veiculonovo_foreign` FOREIGN KEY (`id_veiculoNovo`) REFERENCES `veiculos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propostas_id_veiculousado1_foreign` FOREIGN KEY (`id_veiculoUsado1`) REFERENCES `veiculos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propostas_id_veiculousado2_foreign` FOREIGN KEY (`id_veiculoUsado2`) REFERENCES `veiculos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propostas_id_veiculousado3_foreign` FOREIGN KEY (`id_veiculoUsado3`) REFERENCES `veiculos` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
