-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Abr-2021 às 14:35
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sunny_house`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `client`
--

CREATE TABLE `client` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `client`
--

INSERT INTO `client` (`id`, `name`, `email`, `phone`, `cep`, `address`, `address_number`, `complement`, `created_at`, `updated_at`) VALUES
(1, 'Andréia Alma Serna Filho', 'vasques.estevao@example.net', '(69) 97269-8508', '66625-000', '59096-694, Rua Isaac, 803. F\nPorto Yuri - RS', '21', 'Text Text Text Text Text', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(2, 'Dr. Malu Ramos Escobar Sobrinho', 'marilia65@example.org', '(63) 92724-1704', '66625-000', '35386-321, Av. Noa, 5878\nTamoio do Leste - RJ', '86', 'Text Text Text Text Text', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(3, 'Sr. Sergio Zamana', 'vila.eloa@example.net', '(44) 96713-8906', '66625-000', '34746-390, Av. Serna, 2\nLuis do Leste - MA', '54', 'Text Text Text Text Text', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(4, 'Sr. Maicon Gusmão Cortês Jr.', 'qtoledo@example.net', '(16) 4603-0739', '66625-000', '34816-591, R. Thalita, 74. F\nVila Leonardo do Sul - SC', '64', 'Text Text Text Text Text', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(5, 'Gean Demian da Rosa Filho', 'gean.mascarenhas@example.org', '(46) 3640-1624', '66625-000', '72090-657, Largo Daniele, 69267. Apto 848\nPorto Everton d\'Oeste - AL', '58', 'Text Text Text Text Text', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(6, 'Cezar Aguiar Ferraz', 'verdara.alessandro@example.net', '(46) 3685-7587', '66625-000', '77728-224, Av. Emiliano Arruda, 18\nGilberto do Norte - RS', '31', 'Text Text Text Text Text', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(7, 'Sr. Isaac Marcos Jimenes', 'eva35@example.net', '(49) 97239-6133', '66625-000', '85065-324, Avenida Guilherme, 5241. Apto 31\nSanta Juliano do Leste - BA', '93', 'Text Text Text Text Text', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(8, 'Manuel Nicolas Lutero Filho', 'mari39@example.org', '(47) 2388-2903', '66625-000', '14818-455, Rua Ruth, 71. 837º Andar\nVila Maitê do Leste - TO', '99', 'Text Text Text Text Text', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(9, 'Srta. Isabelly Toledo Sobrinho', 'mel14@example.com', '(74) 3520-4477', '66625-000', '46348-055, Largo Breno, 25\nPaes do Sul - AP', '33', 'Text Text Text Text Text', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(10, 'Dr. Mauro Barreto', 'richard23@example.net', '(64) 94524-1033', '66625-000', '34146-524, Largo Francisco, 343. Apto 256\nOlga do Leste - CE', '87', 'Text Text Text Text Text', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(11, 'Sra. Mila Suellen das Dores Jr.', 'neves.alicia@example.net', '(53) 3211-9486', '66625-000', '17757-245, Rua Emily Grego, 94484\nLira do Norte - RN', '95', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(12, 'Andressa Gonçalves Salazar Neto', 'reinaldo37@example.org', '(14) 94986-8760', '66625-000', '92581-784, Rua Josefina, 4765. Bc. 89 Ap. 58\nRenata do Sul - TO', '79', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(13, 'Marcelo Cauan Reis Jr.', 'cmeireles@example.com', '(28) 97249-7001', '66625-000', '19751-270, Largo Ferminiano, 5533\nMalu do Sul - PR', '56', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(14, 'Dr. Adriel Aranda', 'fserrano@example.org', '(18) 96399-2142', '66625-000', '44207-298, Av. Cristiano Caldeira, 99944\nVila Luan - SE', '33', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(15, 'Wesley Padilha Ferminiano Filho', 'laiane.marinho@example.net', '(86) 94512-5712', '66625-000', '51003-638, Av. Rico, 2188\nBrito d\'Oeste - BA', '32', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(16, 'Dr. Marta Rivera Jr.', 'dirce86@example.net', '(48) 4744-8139', '66625-000', '35877-936, Travessa Melina Maldonado, 34\nSanta Clarice - AM', '47', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(17, 'Cristóvão Leo Verdara Sobrinho', 'tabata.pena@example.net', '(92) 4994-8555', '66625-000', '95770-717, Travessa Thales, 68. Bloco B\nCíntia do Leste - BA', '27', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(18, 'Srta. Alessandra Ferraz Jr.', 'yasmin61@example.org', '(14) 2045-8454', '66625-000', '56732-123, Av. Elisa Garcia, 8. Anexo\nBarreto do Sul - AP', '32', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(19, 'Leo Espinoza Neto', 'brito.ziraldo@example.net', '(38) 92578-1066', '66625-000', '42792-517, Travessa Estela, 2307. Fundos\nVila Irene do Leste - SC', '46', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(20, 'Benjamin Elias Brito Filho', 'sofia.vale@example.net', '(16) 94999-3653', '66625-000', '56896-454, R. Rogério, 96994. Bloco A\nRegina do Norte - DF', '49', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(21, 'Guilherme Gusmão Benez', 'casanova.reinaldo@example.com', '(17) 3273-7046', '66625-000', '44541-056, Av. Maiara Queirós, 6749. Fundos\nGuilherme do Leste - SC', '44', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(22, 'Edson Reis Filho', 'ucorreia@example.org', '(46) 2867-8841', '66625-000', '42829-670, Largo de Aguiar, 3\nPorto Adriana do Leste - AP', '38', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(23, 'Eric Alcantara Burgos Neto', 'horacio60@example.com', '(19) 97674-3427', '66625-000', '05980-304, Rua Matheus Ramires, 312. 1º Andar\nValência d\'Oeste - RJ', '10', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(24, 'Fabiana Poliana Padrão', 'abatista@example.com', '(37) 2144-9684', '66625-000', '50578-775, Rua Cristina Rodrigues, 86417\nBonilha do Norte - RR', '32', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(25, 'Sra. Paulina Rosana Reis', 'bserrano@example.com', '(96) 95963-3765', '66625-000', '31177-303, Avenida Wilson Delatorre, 10\nZamana do Sul - MA', '49', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(26, 'Graziela Nádia Rodrigues', 'salazar.teo@example.com', '(74) 4522-4433', '66625-000', '42414-304, Largo Tiago, 498\nPedro do Leste - ES', '49', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(27, 'Srta. Malu Souza Delvalle Jr.', 'lucia21@example.org', '(88) 2206-4766', '66625-000', '25528-557, R. Guilherme Matias, 1. Apto 8\nÍtalo do Sul - PI', '53', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(28, 'João Leon Saraiva', 'qdefreitas@example.com', '(35) 3849-5549', '66625-000', '68368-586, R. Victor, 1\nVila Léia do Leste - PE', '94', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(29, 'Isis Ávila Sobrinho', 'ornela30@example.com', '(34) 4495-0772', '66625-000', '36037-918, Rua Agatha Serra, 9665. Bc. 51 Ap. 87\nWilliam do Norte - ES', '55', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(30, 'Dr. Marco Sales Carmona', 'rvalente@example.com', '(18) 90479-0377', '66625-000', '71143-609, Av. Elizabeth Vale, 2. Bloco A\nSão Natália - SP', '49', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(31, 'Milena Eliane Assunção Sobrinho', 'reis.joaquim@example.net', '(22) 98540-5547', '66625-000', '16860-084, R. Daniele, 905\nSão Evandro - SP', '58', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(32, 'Henrique da Silva Filho', 'noeli.mares@example.org', '(86) 99223-0053', '66625-000', '13044-660, Avenida Emiliano Rocha, 11. F\nLeandro d\'Oeste - TO', '88', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(33, 'Rogério Matias Casanova', 'suzana.rico@example.net', '(31) 4146-5469', '66625-000', '60594-816, Avenida Dias, 9\nClara do Sul - GO', '11', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(34, 'Sr. Victor Mauro Vieira', 'uchoa.marcio@example.org', '(91) 4227-4477', '66625-000', '20804-244, Avenida Ferraz, 40298. Apto 44\nBenites do Sul - PI', '71', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(35, 'Mauro Ávila Filho', 'pontes.camila@example.org', '(77) 3069-2463', '66625-000', '65785-688, R. Saulo, 27. Apto 13\nSão Adriana - PA', '78', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(36, 'Márcia Pâmela Toledo', 'klovato@example.org', '(66) 95999-6210', '66625-000', '99506-697, Largo Allan Gil, 37. Bloco C\nCristina do Leste - AL', '72', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(37, 'Sr. Filipe Gonçalves', 'carmona.nelson@example.net', '(15) 3132-9248', '66625-000', '19488-410, Avenida Agatha, 6. Bc. 6 Ap. 84\nLetícia d\'Oeste - MS', '69', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(38, 'Tatiana Carmona Jimenes', 'adriel.flores@example.com', '(81) 93071-7400', '66625-000', '04664-567, Rua Sabrina, 21\nPereira d\'Oeste - RJ', '88', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(39, 'Thalissa da Rosa Neto', 'fabiano.benez@example.net', '(98) 4232-5072', '66625-000', '85755-266, Avenida Juliano Mendonça, 79\nSantiago d\'Oeste - AM', '87', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(40, 'Gabi Matias Faria', 'cervantes.lia@example.org', '(69) 3393-7779', '66625-000', '00957-418, Travessa Ícaro Marinho, 84. Apto 76\nPorto Jerônimo do Sul - SE', '25', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(41, 'Dr. Vitor Kevin Ortiz Filho', 'ramires.eduardo@example.org', '(12) 2264-1503', '66625-000', '13316-190, Rua Clarice, 478\nToledo do Sul - PE', '88', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(42, 'Dr. Luciano Horácio Queirós Neto', 'oqueiros@example.net', '(65) 94263-0372', '66625-000', '04795-433, Rua Antonieta Mendonça, 66. 77º Andar\nPorto Antonella - SC', '55', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(43, 'Antonella Zaragoça', 'natal07@example.com', '(61) 92654-3749', '66625-000', '69412-454, R. Rayane, 801\nSão Carol - PE', '40', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(44, 'Sr. Maximiano Tiago Estrada Sobrinho', 'feliciano.gilberto@example.com', '(68) 4974-7753', '66625-000', '03245-716, R. Lidiane, 69497. F\nPorto Marisa - SC', '80', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(45, 'Everton Gael Souza Filho', 'alana.dacruz@example.com', '(27) 2869-7539', '66625-000', '91963-546, Rua Escobar, 87. Bloco B\nVelasques do Leste - RR', '42', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(46, 'Sr. Wilson Aguiar', 'paz.sophia@example.org', '(96) 2428-0260', '66625-000', '51746-170, Avenida Pacheco, 610. Bc. 46 Ap. 62\nSão Richard do Sul - MS', '66', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(47, 'Sra. Flor Duarte', 'hosana.ramos@example.net', '(55) 2393-4268', '66625-000', '56892-911, Largo Naomi, 40. Fundos\nPorto Isis - MT', '87', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(48, 'Dr. Marisa das Dores', 'carla.montenegro@example.net', '(93) 98766-3276', '66625-000', '96371-355, Travessa Daniela, 95\nMárcia d\'Oeste - AM', '71', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(49, 'Carol Velasques Toledo', 'rocha.heloisa@example.org', '(17) 4860-5285', '66625-000', '24055-428, Av. Emília Garcia, 51707. Apto 84\nSalazar do Sul - RJ', '38', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(50, 'Dr. Franco Rangel Colaço', 'casanova.ariana@example.net', '(11) 2336-0607', '66625-000', '80725-100, Av. das Neves, 99. Bloco B\nRamos do Sul - PA', '94', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(51, 'Davi Mauro Dias', 'leandro.toledo@example.com', '(71) 2481-9392', '66625-000', '18010-144, Travessa Natália, 6. 644º Andar\nVila Demian - PB', '97', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(52, 'Srta. Camila Soto Jr.', 'lourenco.adriel@example.org', '(13) 96318-9654', '66625-000', '19888-276, Travessa Dirce, 3474\nSanta Mel - RS', '13', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(53, 'Dr. Arthur Nero Feliciano Neto', 'adriano94@example.org', '(55) 2889-6234', '66625-000', '75073-871, Rua Rafaela Romero, 3922\nVila Filipe do Leste - PI', '29', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(54, 'Dr. Pablo Alcantara Tamoio Neto', 'andres92@example.net', '(55) 98693-2841', '66625-000', '06685-144, Av. Edson, 55848\nPorto Marcos d\'Oeste - AP', '91', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(55, 'Luana Caldeira D\'ávila', 'marques.fabiana@example.org', '(65) 92198-7544', '66625-000', '53982-633, Travessa Benedito Marés, 13. Bc. 54 Ap. 23\nTamoio do Leste - RN', '75', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(56, 'Igor Juliano Marin', 'luara30@example.net', '(67) 96299-8065', '66625-000', '73721-435, Travessa Dias, 57691. Bc. 3 Ap. 75\nSão Luiza - RN', '82', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(57, 'Sr. Leo Soto', 'rogerio.marin@example.org', '(54) 4529-6913', '66625-000', '67298-344, Av. Alcantara, 2\nDavi d\'Oeste - BA', '83', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(58, 'Moisés Grego Cruz', 'gusmao.reinaldo@example.org', '(49) 4290-5142', '66625-000', '41311-516, Travessa Olga, 785\nVila Luísa - RO', '91', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(59, 'Sérgio Rios Rodrigues Jr.', 'paola97@example.org', '(16) 99916-0042', '66625-000', '95515-259, Avenida Sueli, 484\nVila Isabella - TO', '47', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(60, 'Norma Rangel Correia', 'yohanna.grego@example.com', '(12) 4421-2791', '66625-000', '42353-639, Rua Horácio, 436\nInácio d\'Oeste - DF', '66', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(61, 'Sr. Caio Alcantara Torres Neto', 'jimenes.alonso@example.net', '(69) 95802-5898', '66625-000', '28633-265, Largo Marta Quintana, 2\nAna do Sul - BA', '24', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(62, 'Srta. Eduarda Flores Bezerra', 'bdias@example.net', '(93) 4750-2664', '66625-000', '96948-620, R. Marina, 32372\nVega d\'Oeste - PA', '94', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(63, 'Dr. Raysa Roque Camacho Jr.', 'batista.dante@example.org', '(81) 96801-8904', '66625-000', '10834-661, R. Sergio Dias, 919. 12º Andar\nLuzia do Sul - RJ', '62', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(64, 'Dr. Miriam Mary Cortês', 'leonardo.vale@example.com', '(98) 92261-6403', '66625-000', '26351-771, R. Luciano, 4250\nSão Camila do Sul - SP', '80', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(65, 'Sra. Mia Valentin Souza', 'guerra.laiane@example.org', '(73) 3766-2486', '66625-000', '04407-141, Avenida Sabrina, 17\nSão Rebeca - GO', '22', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(66, 'Agatha Duarte', 'hflores@example.net', '(31) 91119-9809', '66625-000', '43813-677, Rua Aline, 286. F\nToledo do Norte - PI', '94', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(67, 'Sr. Victor Serrano', 'overdugo@example.com', '(37) 2567-7906', '66625-000', '45670-164, Travessa Lucas Soares, 82. Bc. 8 Ap. 99\nVila Sueli - PB', '56', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(68, 'Davi Assunção Oliveira Filho', 'verdugo.valentina@example.net', '(17) 93727-6942', '66625-000', '18378-273, Travessa Noel, 69411. Bc. 0 Ap. 42\nValdez do Sul - AM', '55', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(69, 'Luzia Rocha Dominato', 'amanda85@example.net', '(73) 94843-0732', '66625-000', '73628-641, Largo Lutero, 26\nSão Melinda do Leste - CE', '54', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(70, 'Srta. Isabel Maldonado Soares', 'felipe.rangel@example.org', '(22) 2748-5197', '66625-000', '23090-956, R. Eduardo, 365\nSão Mel d\'Oeste - TO', '90', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(71, 'Josefina Rayane Colaço', 'andressa.perez@example.net', '(82) 96947-9371', '66625-000', '04616-721, Avenida Vega, 988\nPorto Ziraldo - TO', '29', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(72, 'Sra. Emilly Gisele Toledo', 'abreu.leticia@example.net', '(54) 4901-4692', '66625-000', '18366-564, Largo Marés, 27\nCordeiro d\'Oeste - CE', '34', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(73, 'Analu Benez Filho', 'kesia61@example.com', '(14) 99956-2200', '66625-000', '07225-877, Largo Wagner Branco, 961\nVila Reinaldo - MT', '59', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(74, 'Aparecida Natália Dias', 'bittencourt.luciano@example.net', '(31) 98878-6828', '66625-000', '81456-082, Rua Quintana, 229. Bloco B\nSão Tomás - MG', '48', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(75, 'Srta. Lidiane Vega Marés Sobrinho', 'furtado.daiane@example.org', '(73) 95873-1464', '66625-000', '22221-812, R. Irene Salazar, 872\nMatias do Sul - BA', '47', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(76, 'Sr. Cezar Mascarenhas Filho', 'isabella.duarte@example.com', '(92) 4786-8955', '66625-000', '70610-385, Rua Irene, 50720\nMichele do Leste - MS', '83', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(77, 'Sra. Allison Duarte Corona', 'wagner84@example.org', '(98) 3232-6663', '66625-000', '99621-837, Av. Heitor Santana, 34176\nSalazar do Leste - SE', '69', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(78, 'Sara Beltrão Delgado', 'maldonado.silvana@example.com', '(96) 91869-9135', '66625-000', '04660-472, Av. Sueli Molina, 3999. Apto 84\nKetlin d\'Oeste - SE', '56', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(79, 'Sra. Ellen Violeta Salgado', 'bmares@example.com', '(82) 90905-1810', '66625-000', '88826-656, Avenida Kauan Carmona, 9000\nPorto Maurício do Leste - TO', '77', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(80, 'Sra. Stella Alves Neto', 'mel49@example.com', '(94) 91147-3057', '66625-000', '05574-760, Travessa Sebastião, 3477. Bloco A\nGuerra do Leste - GO', '17', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(81, 'Srta. Priscila Queirós de Arruda', 'cruz.ziraldo@example.net', '(63) 96040-2625', '66625-000', '90218-922, R. Estela de Aguiar, 3\nMiguel do Leste - DF', '56', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(82, 'Sr. Andres Simon Queirós', 'leonardo.marques@example.com', '(53) 2089-9673', '66625-000', '27915-353, R. André, 3725. 7º Andar\nSão Andréa do Norte - MA', '99', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(83, 'Noel Rogério da Cruz Sobrinho', 'martines.micaela@example.com', '(42) 4595-4508', '66625-000', '18999-246, Travessa Paloma Ferraz, 5. 22º Andar\nLira do Norte - AP', '31', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(84, 'Sr. André Marin Grego', 'larissa51@example.com', '(79) 98922-8973', '66625-000', '49621-569, R. Guilherme Vieira, 79748. Bloco C\nAgatha do Norte - PE', '44', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(85, 'Marília Daniele Chaves', 'nicolas.salgado@example.net', '(89) 2548-5346', '66625-000', '55847-263, Largo Giovanna, 97638\nSão Raphael d\'Oeste - RO', '67', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(86, 'Raquel Padrão', 'nmaia@example.com', '(49) 4673-1456', '66625-000', '37822-062, Av. Fontes, 754\nPorto Ícaro do Norte - GO', '48', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(87, 'Ellen Maiara Santacruz Sobrinho', 'fontes.matheus@example.net', '(63) 99584-9287', '66625-000', '46494-996, Travessa Thalia Assunção, 38\nSão Cynthia do Sul - DF', '67', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(88, 'Alexandre Arruda Sobrinho', 'jaqueline34@example.org', '(89) 2432-5044', '66625-000', '04581-340, Rua Ivana, 27036. 2º Andar\nPorto Anderson - BA', '13', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(89, 'Luiz de Souza Santiago', 'brito.sabrina@example.com', '(27) 90903-0304', '66625-000', '06785-453, Av. Sepúlveda, 1. Apto 4617\nVila Gilberto - RS', '45', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(90, 'Srta. Malena Verônica Lourenço Neto', 'mari51@example.net', '(33) 2110-6834', '66625-000', '97396-722, Largo Pablo Padrão, 6212\nSão Carol - CE', '29', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(91, 'Maximiano Montenegro Jr.', 'eduardo13@example.com', '(24) 2262-7596', '66625-000', '83995-977, Largo Katherine Valentin, 1507\nNoel do Norte - RN', '12', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(92, 'Sra. Raquel Mendonça Jr.', 'stella55@example.net', '(55) 2582-0726', '66625-000', '41196-159, R. Karen, 929. 8º Andar\nRonaldo do Sul - GO', '67', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(93, 'Sra. Raissa das Neves', 'mgomes@example.org', '(31) 92308-0681', '66625-000', '95810-836, R. Michele Casanova, 9. Apto 337\nPorto Nero do Norte - GO', '83', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(94, 'Dr. Olívia Milena Neves Filho', 'rzambrano@example.com', '(93) 4428-4995', '66625-000', '16766-899, Av. Marques, 5\nSanta Rafael do Leste - DF', '27', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(95, 'Dr. Dante Corona', 'priscila38@example.net', '(16) 95464-8057', '66625-000', '96722-250, R. Fátima Meireles, 6662\nSanta Cristóvão - MS', '87', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(96, 'Patrícia Laura Quintana Jr.', 'omatos@example.org', '(95) 90591-0581', '66625-000', '57681-045, Av. Fernandes, 80\nSanta Mila - RO', '64', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(97, 'Kauan Fidalgo Tamoio Neto', 'vasques.luiz@example.net', '(17) 2434-6752', '66625-000', '02027-428, Av. Sueli Abreu, 30\nKauan d\'Oeste - AC', '24', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(98, 'Srta. Isadora Godói', 'hernani.jimenes@example.org', '(14) 2295-6137', '66625-000', '54777-262, Travessa Manuel, 3810\nCervantes do Leste - AP', '59', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(99, 'Emanuelly Olívia Quintana', 'sandoval.manuela@example.com', '(53) 2580-2004', '66625-000', '45047-173, Travessa Colaço, 84313\nDiogo do Norte - RS', '16', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(100, 'Sr. Jonas Fidalgo', 'mares.ketlin@example.org', '(46) 98238-6777', '66625-000', '13694-894, Rua Rezende, 8\nBarros do Sul - MG', '27', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(101, 'Camilo Batista Filho', 'bittencourt.adriano@example.net', '(35) 2844-9190', '66625-000', '56489-022, R. Ivan, 15. Fundos\nSão Letícia - TO', '26', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(102, 'Dr. Fátima Giovanna Souza', 'sandoval.kleber@example.org', '(68) 4771-3044', '66625-000', '97028-057, Avenida Elias, 8689. 34º Andar\nCampos do Norte - PR', '11', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(103, 'Maicon Gil', 'iserna@example.net', '(21) 94433-7937', '66625-000', '54516-862, Rua Edson Marinho, 38926. Apto 2126\nSão Horácio d\'Oeste - PE', '85', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(104, 'Sra. Stephany Cervantes', 'urias.sara@example.org', '(34) 94181-2329', '66625-000', '64493-163, Largo Iasmin, 93961. Bloco B\nLozano d\'Oeste - AL', '27', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(105, 'Lilian Verônica Molina', 'vchaves@example.net', '(62) 4061-5226', '66625-000', '78911-380, Avenida Sepúlveda, 7\nD\'ávila do Sul - RO', '75', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(106, 'Cláudia Cortês Neto', 'anderson67@example.org', '(48) 3155-3785', '66625-000', '46783-019, Rua Daiana, 1. Bc. 9 Ap. 70\nErik d\'Oeste - AL', '62', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(107, 'Sr. Leonardo Rezende Delgado Neto', 'sofia.leal@example.com', '(92) 2178-4008', '66625-000', '42318-889, Rua Allan Matias, 9520. Bloco A\nVila Wellington - DF', '39', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(108, 'Sr. George D\'ávila Feliciano Sobrinho', 'xmaia@example.com', '(74) 92036-4752', '66625-000', '01938-718, Av. Eduarda, 384\nFlávio do Leste - PI', '82', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(109, 'Sra. Lia Maia Lira', 'jferreira@example.com', '(91) 90504-5583', '66625-000', '82985-658, Largo Agostinho da Silva, 3945. Apto 5517\nSão Giovane do Norte - PR', '62', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(110, 'Sr. Augusto Diego Pontes Sobrinho', 'quintana.debora@example.org', '(95) 91595-0944', '66625-000', '31384-464, Largo Batista, 3. Apto 3682\nAdriano d\'Oeste - GO', '94', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(111, 'Franciele Fabiana D\'ávila', 'yuri.santiago@example.com', '(84) 96232-7759', '66625-000', '33793-430, Av. Tatiana Maia, 797\nPorto Thalissa do Leste - SE', '98', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(112, 'Arthur Teobaldo Quintana', 'bia.santos@example.net', '(22) 92878-2935', '66625-000', '02945-237, Largo Marta, 5. Anexo\nPorto Carol - MT', '76', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(113, 'Srta. Isadora Prado Rezende Filho', 'mqueiros@example.com', '(53) 90359-5797', '66625-000', '14692-102, Travessa Fernandes, 23. Apto 69\nSanta Roberto - RJ', '29', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(114, 'Dr. Natal Pereira Lourenço', 'npena@example.org', '(33) 96801-6427', '66625-000', '13723-314, Rua Torres, 8519. Apto 724\nSão Adriel - AP', '84', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(115, 'Dr. Luiz Padilha', 'gabriela95@example.net', '(71) 98323-7341', '66625-000', '38440-862, Largo Flávia, 19259. Bc. 0 Ap. 08\nBarreto d\'Oeste - PB', '14', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(116, 'Sra. Lúcia Ávila', 'juliano.gomes@example.org', '(17) 98099-1239', '66625-000', '81029-269, Avenida Victor Marinho, 382. Apto 08\nMalu do Leste - TO', '74', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(117, 'Lara de Oliveira Valência', 'rsantacruz@example.com', '(54) 96189-9019', '66625-000', '50955-425, Avenida Gabrielle, 696. Apto 88\nKaren do Leste - MT', '56', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(118, 'Mari Meireles Galindo', 'fmaldonado@example.com', '(93) 3852-1846', '66625-000', '23199-735, Travessa Emília, 53967. Apto 3\nJéssica do Sul - MT', '13', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(119, 'Sr. Enzo Valentin Duarte', 'fontes.wesley@example.org', '(31) 93850-2108', '66625-000', '53421-734, Avenida César, 568. Fundos\nOrtiz do Sul - AC', '63', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(120, 'Sra. Samara Fontes Zambrano', 'carmona.maria@example.net', '(98) 96383-6487', '66625-000', '29204-553, Rua Feliciano, 651. Bloco C\nPorto Viviane - ES', '65', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(121, 'Sr. Manuel Moisés Molina Sobrinho', 'montenegro.matias@example.org', '(89) 2054-6135', '66625-000', '27716-407, Rua Isis Delgado, 9\nVila Richard - CE', '71', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(122, 'Sônia Dirce Gonçalves', 'naomi29@example.org', '(99) 2038-9283', '66625-000', '95136-433, Avenida Rebeca, 8\nJimenes do Sul - ES', '53', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(123, 'Srta. Thalita Aranda', 'mcasanova@example.net', '(62) 92324-6990', '66625-000', '89466-094, Rua Clara, 7513. Apto 449\nSaraiva do Sul - AC', '42', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(124, 'Sra. Ariane Duarte', 'rodrigo.estrada@example.net', '(14) 95303-1304', '66625-000', '48603-540, Avenida Mayara Soares, 5\nPorto Eduardo do Leste - PI', '29', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(125, 'Gian Denis Benites', 'godoi.sophie@example.net', '(14) 96763-5029', '66625-000', '99994-316, Largo Faria, 740\nSanta Marília do Leste - SE', '32', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(126, 'Marília Mayara Soto', 'reinaldo.marques@example.net', '(13) 2710-8585', '66625-000', '50752-685, Avenida Abreu, 63. Bc. 2 Ap. 20\nPorto Olga - MS', '48', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(127, 'Sra. Valentina Malena Padrão', 'ufranco@example.net', '(45) 90306-0461', '66625-000', '48748-086, Travessa Antonella, 54915. Fundos\nValentina do Sul - PE', '17', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(128, 'Dr. Adriele Rosa Garcia', 'lourenco.emilia@example.net', '(22) 93332-5907', '66625-000', '62006-190, Avenida Gisele, 94\nPorto Mônica - PI', '70', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(129, 'Sra. Débora Carvalho Burgos', 'jacomo38@example.net', '(49) 93977-1622', '66625-000', '09329-601, Avenida Denis, 6104\nGuilherme do Sul - PA', '49', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(130, 'Paulo Lucas Fernandes', 'thalita77@example.org', '(84) 93672-9573', '66625-000', '12076-567, Rua Allison Garcia, 529\nPerez d\'Oeste - TO', '19', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(131, 'Mari Sarah Galhardo', 'eunice.bittencourt@example.com', '(67) 98844-3851', '66625-000', '32539-421, Avenida Daiana, 57259. Apto 45\nLaura do Sul - ES', '97', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(132, 'James Daniel Feliciano Sobrinho', 'gabi.cortes@example.net', '(24) 2071-3340', '66625-000', '52772-192, Travessa Máximo Maldonado, 9. 62º Andar\nVieira do Norte - PR', '19', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(133, 'Suelen Delgado', 'igoncalves@example.net', '(43) 3276-8212', '66625-000', '21263-601, Av. Alma Cervantes, 2. Apto 1812\nSão Maísa do Norte - RS', '72', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(134, 'Sra. Yasmin Lira Domingues', 'leonardo.avila@example.com', '(81) 3603-3505', '66625-000', '46490-288, Largo Salazar, 5\nSaulo d\'Oeste - MS', '44', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(135, 'Dr. Benício Teles Aragão', 'manuela00@example.org', '(74) 4445-0604', '66625-000', '67249-617, Rua Ramires, 693. Bloco C\nPorto Caio - DF', '74', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(136, 'Rodolfo Danilo Marés', 'fpedrosa@example.org', '(79) 3843-6617', '66625-000', '53641-479, Rua Inácio, 182. Apto 085\nSanta Heloísa do Norte - RN', '46', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(137, 'Lucas Carlos Valentin', 'tabreu@example.net', '(83) 2735-3311', '66625-000', '88868-957, Rua Natan, 7910. F\nSão Santiago - SP', '22', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(138, 'Sr. Jorge Jean Zaragoça Sobrinho', 'ornela.serra@example.com', '(21) 4898-4003', '66625-000', '81250-266, R. Pablo, 74. F\nPorto Eunice - TO', '68', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(139, 'Ivana Maitê Montenegro', 'sepulveda.adriana@example.org', '(79) 97335-4577', '66625-000', '22030-153, Travessa Afonso, 26\nMascarenhas do Sul - PA', '76', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(140, 'Srta. Betina Fátima Fernandes', 'xferreira@example.com', '(24) 4252-7881', '66625-000', '94614-132, Travessa Tâmara Montenegro, 2. Bc. 4 Ap. 77\nFerreira d\'Oeste - CE', '72', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(141, 'Victor Gusmão', 'rbonilha@example.net', '(99) 3549-8449', '66625-000', '08231-716, Rua Ávila, 7\nSanta Adriel - RJ', '20', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(142, 'Miriam Andressa Ávila', 'jasmin15@example.org', '(35) 95742-2934', '66625-000', '65382-635, Largo Michelle, 18. Apto 17\nSerrano do Sul - PE', '19', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(143, 'Rosana Maya Brito Sobrinho', 'renato.corona@example.net', '(66) 4005-6758', '66625-000', '86086-083, Travessa Salas, 4. Apto 5386\nConstância do Sul - MG', '89', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(144, 'Tatiane Kamila Barros Neto', 'fabiano36@example.net', '(43) 96582-1277', '66625-000', '34450-906, Avenida Juliano Uchoa, 1. F\nSanta George d\'Oeste - MS', '98', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(145, 'Sr. Agostinho Queirós Vega', 'galvao.noeli@example.com', '(82) 96800-9637', '66625-000', '53983-419, Avenida Sônia, 4\nPorto Olívia do Sul - MS', '14', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(146, 'Sr. Arthur Simão Santiago Neto', 'barros.marcelo@example.com', '(62) 2292-7666', '66625-000', '83476-878, Avenida Deverso, 4364\nMaiara do Norte - RS', '45', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(147, 'Wesley Queirós', 'heloise.faria@example.com', '(85) 98568-8818', '66625-000', '92657-888, Travessa Quintana, 2. Apto 596\nKléber do Sul - TO', '16', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(148, 'Dr. Teobaldo Molina Jr.', 'mcortes@example.com', '(61) 2898-1033', '66625-000', '63970-432, Largo Amaral, 42\nPietra do Sul - MS', '81', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(149, 'Dr. Ivan Sergio Rodrigues Neto', 'george.fidalgo@example.org', '(83) 3498-9731', '66625-000', '37663-928, Largo Henrique Balestero, 3. Apto 0\nVila Mia - RR', '40', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(150, 'Daiana Valente Duarte', 'ana77@example.net', '(62) 4720-6297', '66625-000', '85936-660, Av. Thalia, 84\nIvan do Norte - AM', '98', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(151, 'Sueli Alana Santiago', 'adriel89@example.com', '(11) 4938-0101', '66625-000', '77398-234, Travessa Martinho Barreto, 2\nSão Josefina do Norte - GO', '74', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(152, 'Agustina Isabelly Ferminiano Neto', 'ortiz.nelson@example.net', '(95) 96841-9787', '66625-000', '72496-479, Av. Horácio, 2. Fundos\nPorto Alana do Leste - BA', '22', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(153, 'Eliane Brito Verdara Neto', 'marco12@example.org', '(15) 4084-8312', '66625-000', '03443-945, Rua Delatorre, 2506. Apto 8258\nLutero do Leste - SE', '61', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(154, 'Sr. Deivid Faria Leal', 'delatorre.gustavo@example.com', '(99) 2368-9641', '66625-000', '18262-503, Av. Benjamin Carmona, 879. 63º Andar\nSanta Filipe - MT', '59', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(155, 'Dr. Afonso Pacheco', 'bonilha.graziela@example.com', '(97) 98479-0759', '66625-000', '47521-673, Largo Giovane, 4926. F\nPorto Manuela - RR', '81', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(156, 'Isis Gusmão Montenegro Filho', 'camacho.maisa@example.com', '(54) 97703-4292', '66625-000', '49670-768, Avenida Nelson Vieira, 911. 761º Andar\nMaurício do Sul - MS', '59', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(157, 'Dr. Lívia de Freitas Batista Sobrinho', 'defreitas.ricardo@example.net', '(28) 99363-6565', '66625-000', '82343-314, R. Nathalia, 6. Bloco A\nCampos do Leste - PE', '80', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(158, 'Dr. Emerson Saraiva', 'benicio90@example.com', '(21) 3538-3776', '66625-000', '79033-762, Travessa Ferminiano, 4903. Bloco C\nPorto Fabrício - RJ', '79', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(159, 'Daiana Delvalle', 'lcortes@example.org', '(95) 2809-8371', '66625-000', '69586-369, Largo Luciano, 4\nOtávio do Sul - AP', '18', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(160, 'Sr. Artur Gael Perez Filho', 'guerra.dante@example.com', '(84) 96774-3545', '66625-000', '26352-354, Largo Lorena de Aguiar, 9\nVila Artur - RS', '37', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(161, 'Flávio Quintana Flores', 'sepulveda.raissa@example.org', '(33) 4169-0124', '66625-000', '77811-727, Avenida Fidalgo, 95\nSanta Augusto - RR', '26', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(162, 'Jonas Sepúlveda Jr.', 'ronaldo.bezerra@example.net', '(54) 3552-4777', '66625-000', '32610-990, Av. Flávio, 9\nSanta Kléber d\'Oeste - MG', '37', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(163, 'Dr. Carlos Salazar Filho', 'estrada.erik@example.org', '(38) 96012-0025', '66625-000', '17962-631, Avenida Dirce, 3964. Bc. 7 Ap. 49\nMaicon d\'Oeste - CE', '49', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(164, 'Sr. Antônio Artur Abreu Neto', 'carol.jimenes@example.net', '(62) 91517-9475', '66625-000', '26921-431, Avenida Benedito Carmona, 6. Apto 49\nRaissa do Sul - AM', '59', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(165, 'Naomi Ferminiano Ramos', 'wroque@example.com', '(31) 95036-8226', '66625-000', '15797-940, Largo Dante, 823\nSão Daiana - DF', '43', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(166, 'Dr. Ian Fidalgo Ferminiano Sobrinho', 'tbeltrao@example.net', '(64) 2647-0211', '66625-000', '48413-849, Av. Faro, 9. Apto 46\nAragão do Norte - GO', '71', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(167, 'Benício Toledo Aguiar Jr.', 'nicole95@example.com', '(55) 3551-4194', '66625-000', '96385-612, Av. Maia, 9784\nFlávia d\'Oeste - TO', '74', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(168, 'Dr. Richard Fonseca Saito', 'anderson.ramos@example.org', '(34) 3339-7510', '66625-000', '51950-779, Travessa Ferreira, 579\nPorto Mayara - MT', '77', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(169, 'Dr. Sandro Santiago Ramos', 'ortega.ohana@example.net', '(35) 2597-9259', '66625-000', '78761-943, Largo Stephany Salas, 4929. F\nGabi d\'Oeste - MG', '61', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(170, 'Everton Delvalle', 'yuri21@example.net', '(47) 4927-7922', '66625-000', '74458-113, Largo Violeta, 2716. Bloco A\nVerdugo do Leste - PE', '19', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(171, 'Srta. Thalissa Lilian Delgado Jr.', 'vortiz@example.com', '(69) 4874-4070', '66625-000', '54842-235, Rua Miguel, 396\nSão Alonso - ES', '57', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(172, 'Melissa Raissa Burgos Sobrinho', 'qmatias@example.net', '(27) 3116-2064', '66625-000', '63749-502, R. Ronaldo Gomes, 1\nNeves do Norte - MA', '87', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(173, 'Srta. Miriam Nathalia Molina', 'fabricio47@example.net', '(28) 92648-7053', '66625-000', '14315-646, Av. Dirce, 480\nIsadora do Leste - SE', '99', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(174, 'Srta. Abgail Miriam Solano', 'tserra@example.net', '(99) 99176-3861', '66625-000', '53677-228, Largo Cíntia Sanches, 155\nLaís do Leste - PE', '54', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(175, 'Dr. Stephanie Souza Madeira', 'saulo45@example.net', '(33) 3149-7590', '66625-000', '11187-983, R. Juliane, 99184\nVila Murilo - MS', '26', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(176, 'Sr. Diego das Neves Dias Jr.', 'deivid.ferraz@example.net', '(98) 2101-9927', '66625-000', '01530-053, R. Correia, 875\nVila Agostinho do Norte - RO', '53', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(177, 'Dr. Isadora Valente Jr.', 'salazar.alexa@example.net', '(84) 3750-8312', '66625-000', '63387-122, Avenida Vieira, 49\nVasques do Sul - MS', '54', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(178, 'Dr. Thomas Serra Mascarenhas Neto', 'reis.wagner@example.org', '(13) 95878-6097', '66625-000', '82285-284, Largo Barros, 74. F\nSanta Adriano do Leste - RR', '19', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(179, 'Isaac Marin', 'suellen94@example.org', '(11) 97235-4935', '66625-000', '91526-548, Travessa Emílio, 65234. Bloco B\nBatista do Norte - RO', '18', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(180, 'Maitê Caldeira', 'flavio.ferreira@example.com', '(24) 2225-5692', '66625-000', '81333-125, Rua Simone, 4745\nMaldonado do Norte - SP', '29', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(181, 'Srta. Louise Caroline Vega Neto', 'batista.demian@example.net', '(34) 95789-2487', '66625-000', '13935-355, Largo Sabrina Torres, 77\nSão Ohana do Norte - RO', '85', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(182, 'Dr. Simão Anderson Fidalgo', 'vsalgado@example.com', '(15) 2505-3215', '66625-000', '77661-333, Travessa Isabel, 9683\nSanta Léia do Leste - SE', '66', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(183, 'Tâmara Prado Barreto', 'patricia88@example.org', '(14) 90162-5869', '66625-000', '75523-577, Largo Edilson, 183. 85º Andar\nVila Alana do Sul - PB', '34', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(184, 'Agostinho Reis Galvão Jr.', 'thais.zamana@example.net', '(85) 91758-6316', '66625-000', '71375-216, Travessa Bárbara Godói, 921\nVila Joana d\'Oeste - SP', '24', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(185, 'Sra. Thalissa Ornela Alcantara', 'simone.montenegro@example.com', '(37) 2559-3588', '66625-000', '75724-101, Avenida Marés, 50091. Bc. 8 Ap. 23\nSanta Christopher do Norte - AM', '36', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(186, 'Michele Ortega', 'yzambrano@example.com', '(33) 90965-4687', '66625-000', '79963-325, R. João, 8. 9º Andar\nSão Vanessa - PI', '39', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(187, 'Raissa Gabrielly Souza Sobrinho', 'padilha.tais@example.net', '(65) 4377-5733', '66625-000', '40863-948, Largo Queirós, 3\nPorto Gisela do Norte - MT', '46', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(188, 'Gabi Valência Galvão Neto', 'george.rodrigues@example.org', '(75) 4166-8370', '66625-000', '02380-780, Avenida Estrada, 3. Apto 0\nPorto Sebastião do Leste - PB', '55', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(189, 'Giovanna da Silva Rangel Jr.', 'salazar.miranda@example.com', '(21) 2604-3313', '66625-000', '32712-662, Avenida Gilberto Maia, 54\nVila Sueli do Norte - RJ', '55', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(190, 'Dr. Horácio Ítalo Delgado', 'nmontenegro@example.org', '(71) 4774-1484', '66625-000', '42426-082, Rua Rios, 77. Apto 7\nWagner do Leste - TO', '97', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(191, 'Srta. Yohanna Dirce Pontes Jr.', 'delvalle.sara@example.com', '(38) 93177-8106', '66625-000', '30213-462, Avenida Elaine Esteves, 44. Apto 514\nYuri do Leste - RS', '88', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(192, 'Christian Faria Marin Jr.', 'nmeireles@example.net', '(18) 96405-5007', '66625-000', '54094-170, Largo Julieta, 1. Apto 8\nSandoval d\'Oeste - AL', '91', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(193, 'Dr. Yuri Kléber Padrão', 'nelson.furtado@example.net', '(83) 91999-5816', '66625-000', '92499-318, Avenida Isadora, 91\nPacheco do Norte - SC', '71', 'Text Text Text Text Text', '2021-04-02 12:29:07', '2021-04-02 12:29:07'),
(194, 'Ana Mascarenhas Carvalho', 'cezar29@example.net', '(89) 2715-7919', '66625-000', '73596-395, Avenida Benjamin, 222. Bloco A\nMarco do Norte - MS', '25', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(195, 'Vitor Arthur Faro', 'odesouza@example.net', '(97) 2732-0306', '66625-000', '54142-619, Rua Faro, 4635\nVila Walter - SC', '38', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(196, 'Srta. Isabella Neves', 'eduardo28@example.org', '(19) 2216-2901', '66625-000', '51582-791, Largo Garcia, 861. Apto 237\nRomero do Sul - RJ', '32', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(197, 'Ian Quintana Delatorre Sobrinho', 'martines.james@example.com', '(87) 96890-5061', '66625-000', '05071-114, Largo Camilo, 4893\nRicardo do Leste - SE', '54', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(198, 'Márcio Dias da Silva', 'antonieta.domingues@example.net', '(82) 3674-2183', '66625-000', '81143-948, Largo Kauan, 1400\nPorto Matheus do Leste - PB', '62', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(199, 'Sra. Vitória Santos Sobrinho', 'hernani48@example.com', '(81) 95462-4148', '66625-000', '09333-532, Av. Grego, 6\nPorto Michael - RR', '65', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(200, 'Cecília Urias', 'thiago.rios@example.com', '(19) 96275-6025', '66625-000', '17372-499, Av. Gael, 61617. Bloco B\nLeon do Leste - RR', '90', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(201, 'Aparecida Rodrigues', 'aline.valdez@example.com', '(87) 92551-0720', '66625-000', '60989-210, Travessa Velasques, 69. F\nVerdara do Leste - MG', '82', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(202, 'Sr. Heitor Marés', 'xaguiar@example.net', '(45) 4704-2329', '66625-000', '29571-202, Travessa Artur, 95774\nVitória do Leste - SC', '53', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(203, 'Rogério Pena Neto', 'milena91@example.net', '(93) 92139-6091', '66625-000', '24818-272, Av. Rayane, 664\nSão Thaís d\'Oeste - CE', '50', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(204, 'Sr. Hugo Franco Aragão Filho', 'sueli24@example.com', '(18) 90068-0441', '66625-000', '27165-492, R. James, 69\nSão Fábio - RS', '13', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(205, 'Dr. Edilson Colaço', 'mvale@example.org', '(27) 4154-7877', '66625-000', '91896-681, R. Rebeca Aranda, 7860. Apto 5120\nVila Estêvão - PB', '67', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(206, 'Sr. Cauan Cortês Rivera Filho', 'galindo.marilia@example.com', '(28) 96039-2449', '66625-000', '28519-220, R. Maraisa, 6461. Apto 8191\nVila Afonso - AP', '68', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(207, 'Tessália Batista Faria', 'domingues.stefany@example.net', '(96) 97743-2104', '66625-000', '59280-642, Largo Talita, 65487\nSão José - AM', '41', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(208, 'Mari Thalia Fontes Sobrinho', 'medina.edilson@example.net', '(88) 93300-2278', '66625-000', '17143-731, Rua Serrano, 1478. 2º Andar\nFábio do Norte - RJ', '75', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(209, 'Dr. Franco Natal Velasques Sobrinho', 'esteves.fabiano@example.org', '(85) 95997-5781', '66625-000', '51697-692, Avenida Kauan Ramires, 79\nVila Thaís - PI', '93', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(210, 'Moisés Paes Leal Filho', 'jbarros@example.net', '(18) 94779-6346', '66625-000', '32996-522, Rua Pedro Galvão, 99\nVila Suzana do Leste - RO', '69', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(211, 'Sra. Mirella Reis Sandoval', 'sheila.dasilva@example.com', '(65) 2597-1396', '66625-000', '87635-993, Avenida Thalia, 48. Bloco C\nSanta Cristiano do Leste - TO', '54', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(212, 'Sr. Davi Maurício Brito', 'antonella69@example.net', '(32) 93380-4294', '66625-000', '78744-831, Av. Duarte, 5\nSanta Talita - AC', '66', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(213, 'Joaquim Pablo Delatorre', 'jgoncalves@example.net', '(69) 92273-0136', '66625-000', '83893-547, Avenida Luiza Marques, 37193\nSanta Sarah - PI', '11', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(214, 'Mirela Gabrielle Feliciano Filho', 'pereira.suzana@example.org', '(15) 3769-1149', '66625-000', '06374-221, Largo Leon, 9825\nPorto Andréa - AM', '54', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(215, 'Adriano Lovato', 'paola82@example.org', '(74) 4056-9599', '66625-000', '93554-963, Avenida Karine Ortega, 375. Apto 5152\nSão Franco do Norte - TO', '81', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08');
INSERT INTO `client` (`id`, `name`, `email`, `phone`, `cep`, `address`, `address_number`, `complement`, `created_at`, `updated_at`) VALUES
(216, 'Valéria Lourenço Galvão Sobrinho', 'rcarmona@example.com', '(73) 3125-0409', '66625-000', '49606-722, Avenida Fonseca, 329\nSaraiva do Sul - AC', '28', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(217, 'Dr. Allan Robson Madeira Jr.', 'robson.salazar@example.net', '(45) 98892-1225', '66625-000', '66811-758, Rua Benjamin Cordeiro, 53. 10º Andar\nPorto Matheus do Sul - AP', '71', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(218, 'Demian Leal Jr.', 'dquintana@example.org', '(94) 3114-4757', '66625-000', '39960-405, Avenida Prado, 8\nCruz do Norte - MT', '86', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(219, 'Gilberto de Souza', 'saraiva.saulo@example.com', '(43) 2233-0332', '66625-000', '43668-723, Largo Luara, 3933. Apto 7\nSanta Sônia - ES', '64', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(220, 'Dr. Tatiane Queirós Ortiz', 'elizabeth.amaral@example.com', '(55) 2414-0052', '66625-000', '57479-174, R. Iasmin Reis, 312. Apto 3\nMaya d\'Oeste - DF', '75', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(221, 'Srta. Andréa Padrão', 'montenegro.jonas@example.net', '(62) 4252-3931', '66625-000', '45202-298, Avenida Teles, 211\nSanta Mayara - RJ', '29', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(222, 'Aparecida Barros Neto', 'godoi.evandro@example.net', '(64) 94817-1355', '66625-000', '80509-518, Av. Gabrielly, 61235\nEmiliano do Sul - RJ', '65', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(223, 'Dr. Fernando Nicolas Cervantes', 'santana.vinicius@example.net', '(84) 3021-3755', '66625-000', '65831-900, Rua Escobar, 27. Apto 0873\nPietra do Norte - PI', '31', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(224, 'Luiza Duarte Neto', 'ypena@example.com', '(87) 98525-1449', '66625-000', '63877-823, Travessa Bella Rezende, 491. Bloco A\nEmilly do Sul - PE', '62', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(225, 'Sr. Diego Velasques', 'mateus.guerra@example.net', '(96) 98738-0573', '66625-000', '83269-934, Avenida Cristiano, 60. Apto 6\nPorto Ornela d\'Oeste - RS', '46', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(226, 'Raphael Carvalho Sobrinho', 'violeta.ferreira@example.com', '(37) 3373-8442', '66625-000', '59013-483, Av. Espinoza, 1867. Bloco C\nVila Iasmin do Leste - TO', '16', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(227, 'Melina Maia', 'betina81@example.net', '(61) 4431-0207', '66625-000', '98798-330, Travessa Cezar Ortiz, 219. Anexo\nOrnela d\'Oeste - AM', '31', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(228, 'Iasmin Verdugo Aguiar', 'tabata74@example.net', '(62) 99808-4668', '66625-000', '90797-307, R. Gean, 5. 7º Andar\nDante do Sul - ES', '73', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(229, 'Diego Saito', 'karine.bittencourt@example.org', '(34) 3366-0627', '66625-000', '25018-612, Av. Emanuel, 306\nTéo d\'Oeste - PE', '45', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(230, 'Isadora Juliana Deverso Jr.', 'montenegro.vicente@example.com', '(21) 4138-4702', '66625-000', '48189-454, Avenida Vale, 6225\nVila Vitor - AL', '70', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(231, 'Jennifer Lovato', 'sandoval.luana@example.net', '(49) 96554-1195', '66625-000', '81189-527, Avenida Zambrano, 7330. Apto 30\nAlana d\'Oeste - MT', '23', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(232, 'Sr. Marco Urias Estrada', 'andreia.meireles@example.com', '(69) 95704-6072', '66625-000', '69496-256, Largo Salas, 4951\nSanta Paola - RS', '60', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(233, 'Vinícius Alonso Sandoval', 'zsantiago@example.com', '(69) 3458-1767', '66625-000', '00200-966, Av. Laís, 119. 022º Andar\nSanta Thalita do Norte - MS', '29', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(234, 'Dr. Caroline Ester Lovato Filho', 'catarina76@example.com', '(47) 90374-4307', '66625-000', '20148-057, Av. Maitê, 49. Bloco B\nSão Catarina d\'Oeste - RR', '55', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(235, 'Srta. Danielle Cíntia Fidalgo Jr.', 'deivid34@example.org', '(85) 4892-8203', '66625-000', '33211-333, Av. Ariane da Rosa, 8\nYuri do Norte - PB', '72', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(236, 'Denis Caldeira', 'dazevedo@example.org', '(33) 2605-5427', '66625-000', '59050-841, Av. Deverso, 97032. Fundos\nSanta Noa - PI', '15', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(237, 'Sra. Thalissa Salgado', 'hcortes@example.com', '(89) 98137-8817', '66625-000', '55121-828, Avenida Emanuelly, 76548\nCaio d\'Oeste - BA', '91', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(238, 'Dr. Ronaldo Delgado Neto', 'domingues.sara@example.net', '(79) 97771-4183', '66625-000', '36512-844, Rua Urias, 548\nSanta Wilson - RJ', '44', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(239, 'Srta. Ivana Tábata Lourenço Sobrinho', 'ilourenco@example.net', '(15) 3270-2796', '66625-000', '42794-795, Avenida Suellen, 3875\nAlexa do Norte - PE', '77', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(240, 'Dr. Sérgio Rezende', 'guilherme00@example.org', '(48) 95486-3103', '66625-000', '45764-753, R. Serna, 1857. Apto 49\nSanta Ian - MG', '71', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(241, 'Carolina Daiana Rivera', 'estrada.agustina@example.com', '(95) 4063-7076', '66625-000', '46323-337, Travessa Fernandes, 3. Bloco C\nVila Manuel do Leste - MS', '89', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(242, 'Dr. Hernani Benites Sales Filho', 'adriana.cruz@example.net', '(74) 99206-3218', '66625-000', '17751-472, Rua das Dores, 99667\nLourenço d\'Oeste - PR', '30', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(243, 'Carla Andressa de Aguiar Jr.', 'serra.renata@example.org', '(85) 94034-7746', '66625-000', '64886-988, Avenida Liz Rico, 6\nVila Ariana - PI', '96', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(244, 'Robson Valente Filho', 'colaco.diogo@example.net', '(66) 95340-6705', '66625-000', '84136-355, Travessa Marinho, 6564. 9º Andar\nda Cruz do Norte - RJ', '80', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(245, 'Srta. Rayane D\'ávila', 'miriam.guerra@example.org', '(43) 91778-7374', '66625-000', '97561-884, R. Teobaldo Pena, 120\nVerdara do Sul - AL', '79', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(246, 'Marcelo Serna Sobrinho', 'nelson.delatorre@example.com', '(74) 2230-5744', '66625-000', '42047-055, Largo Maldonado, 389\nVila Tomás - GO', '80', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(247, 'Sr. Christopher Hernani Grego Neto', 'martinho29@example.org', '(94) 93898-5833', '66625-000', '47136-863, Av. Malena Matos, 4\nSanta Robson do Sul - CE', '97', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(248, 'Sr. Demian Prado Ferreira Filho', 'amanda.reis@example.org', '(15) 4906-3344', '66625-000', '54759-553, Travessa Verdara, 94. Bloco C\nGalindo do Norte - TO', '37', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(249, 'Sra. Naiara Medina Gonçalves', 'suchoa@example.org', '(31) 99417-6387', '66625-000', '00359-773, Rua Flávio Assunção, 6494. F\nGiovanna do Leste - TO', '85', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(250, 'Lucio Gomes Soto', 'dias.ivan@example.com', '(84) 99048-7120', '66625-000', '47429-735, Travessa Ortiz, 721. Anexo\nÍtalo do Sul - RR', '23', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(251, 'Sra. Mariah Vanessa Esteves Jr.', 'hmascarenhas@example.net', '(21) 2716-6111', '66625-000', '63167-334, Largo Oliveira, 48. Apto 44\nGean d\'Oeste - PI', '19', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(252, 'Taís Reis Sobrinho', 'alana06@example.com', '(11) 2110-7958', '66625-000', '20244-141, R. Amaral, 39\nPorto Ester do Sul - PB', '62', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(253, 'Ian Tamoio Filho', 'suzana31@example.net', '(74) 2439-0961', '66625-000', '84073-713, Rua Mary Espinoza, 74. Apto 1\nLeonardo do Sul - GO', '88', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(254, 'Graziela Cruz Prado Sobrinho', 'avila.nayara@example.com', '(38) 3221-4938', '66625-000', '75836-103, Largo Juan Urias, 71791\nZambrano d\'Oeste - AC', '54', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(255, 'Ronaldo Ramos', 'juliana04@example.com', '(48) 4594-3686', '66625-000', '40981-677, R. Walter Delvalle, 75. Bc. 8 Ap. 35\nSanta Natan - TO', '32', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(256, 'Teobaldo Diogo Campos', 'lbatista@example.org', '(62) 2040-1777', '66625-000', '42715-072, R. Thalita, 4029. 1º Andar\nPorto Tiago do Leste - MT', '88', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(257, 'Joaquin Vila', 'maximo83@example.net', '(21) 97201-6831', '66625-000', '61238-777, Avenida Wagner Fidalgo, 41423. Fundos\nSão Julieta - AM', '69', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(258, 'Dr. Yohanna Eduarda Casanova Neto', 'catarina90@example.net', '(88) 91368-5642', '66625-000', '57020-543, Avenida Ornela Carmona, 65464\nCorreia do Leste - AM', '69', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(259, 'Sra. Pietra Valência', 'hugo.montenegro@example.org', '(98) 2670-7582', '66625-000', '56180-969, R. Corona, 27446. Bc. 3 Ap. 17\nSanta Lucio d\'Oeste - BA', '87', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(260, 'Vicente Velasques', 'lvaldez@example.org', '(11) 96499-4019', '66625-000', '76768-084, Avenida Christian Uchoa, 19\nPorto André do Sul - PR', '36', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(261, 'Dr. Léia Reis Pontes Filho', 'fonseca.clarice@example.net', '(91) 97711-0915', '66625-000', '13105-479, Travessa Dener D\'ávila, 144. Bloco B\nGiovane do Leste - MS', '31', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(262, 'Srta. Ariane Daniela Beltrão Neto', 'mateus04@example.com', '(27) 95066-2395', '66625-000', '23543-328, Rua Ayla Alves, 6378\nSanta Raphael - SE', '53', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(263, 'Sr. Thales Sandro Dias Neto', 'antonio.rios@example.com', '(14) 98239-5070', '66625-000', '29878-614, Largo Joaquim Ferreira, 115\nSão João - BA', '76', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(264, 'Norma Solano Galindo', 'soto.regina@example.org', '(86) 95169-2197', '66625-000', '59238-313, Avenida Ellen, 70511. Apto 020\nSão Angélica - MT', '92', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(265, 'Sra. Ana Tatiane Lozano Jr.', 'wtorres@example.com', '(85) 90969-1074', '66625-000', '22184-607, Av. Matheus Dias, 8\nAlícia d\'Oeste - AM', '71', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(266, 'Sr. Maurício Padilha Neto', 'gneves@example.org', '(28) 3767-3280', '66625-000', '58711-624, Avenida Sepúlveda, 129\nEsteves do Norte - AL', '57', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(267, 'Luan Franco Deverso', 'lsaraiva@example.com', '(69) 90857-0058', '66625-000', '61748-983, Avenida Alana, 9602\nJácomo d\'Oeste - PA', '79', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(268, 'Noa Esteves Zambrano Filho', 'ortega.kelly@example.net', '(88) 90748-5068', '66625-000', '83007-214, Avenida Salazar, 30. Bloco A\nVelasques do Leste - SP', '15', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(269, 'Srta. Janaina Delgado Rivera', 'luiz.bonilha@example.net', '(84) 4577-3782', '66625-000', '07717-938, Largo Danilo Urias, 45053. Bloco A\nSanta Filipe - AC', '27', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(270, 'Bruna Sepúlveda Sobrinho', 'tpereira@example.net', '(93) 97536-7574', '66625-000', '41459-567, Rua Paulina, 6. Bc. 77 Ap. 34\nPorto Jean - PB', '42', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(271, 'Sr. Mauro Théo Deverso Sobrinho', 'michael51@example.com', '(41) 3837-5869', '66625-000', '73323-324, Travessa Quintana, 251. Bc. 64 Ap. 44\nMaia d\'Oeste - AP', '37', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(272, 'Aurora Burgos Rodrigues', 'sueli.bittencourt@example.org', '(37) 90235-4772', '66625-000', '48379-053, Travessa Marcos Martines, 7\nPorto Mel d\'Oeste - AL', '96', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(273, 'Leandro Mendonça Fernandes', 'dacruz.melina@example.com', '(47) 92191-8953', '66625-000', '08998-850, R. Furtado, 45\nSanta Catarina do Sul - PA', '99', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(274, 'Dr. Wellington Batista Teles Filho', 'emiliano47@example.net', '(55) 2347-7962', '66625-000', '95387-906, Largo Eduardo, 1310\nSophia do Leste - AC', '40', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(275, 'Luciano Carlos Feliciano Filho', 'vicente.ramires@example.com', '(96) 4812-2798', '66625-000', '27520-366, Avenida Lucio Gonçalves, 23\nSanta Camilo do Leste - SE', '60', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(276, 'Bianca Pacheco Ávila', 'kamila01@example.org', '(43) 4873-3366', '66625-000', '05275-515, Travessa Mariah Padrão, 6925. Bc. 71 Ap. 83\nRico do Norte - AP', '12', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(277, 'Sr. Nero Pedro Velasques Filho', 'jrios@example.org', '(44) 94369-0222', '66625-000', '72783-968, Largo Emanuel, 108\nCarvalho do Leste - PA', '90', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(278, 'Sra. Luiza Ana Roque Sobrinho', 'spontes@example.net', '(44) 2226-1322', '66625-000', '39396-173, Travessa Vinícius Aragão, 7. Anexo\nJimenes do Leste - GO', '66', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(279, 'Nathalia Rosa Sobrinho', 'umarques@example.org', '(22) 4661-4252', '66625-000', '07443-611, R. Manuel, 2. Fundos\nSanta Melissa - RR', '15', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(280, 'Dr. Caio Nelson Rico Filho', 'zamana.juliana@example.org', '(91) 4417-2766', '66625-000', '85112-412, Rua Willian Alcantara, 2\nPorto Andres do Leste - MA', '22', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(281, 'Kevin Vila Jr.', 'dasneves.breno@example.org', '(64) 98099-9976', '66625-000', '04200-647, Rua Miguel, 8725\nSanta Rayane - PA', '28', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(282, 'Srta. Juliane Ortiz Serna', 'william.correia@example.com', '(31) 2006-9196', '66625-000', '46145-120, Travessa Gabrielly Batista, 607\ndas Dores d\'Oeste - DF', '66', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(283, 'Srta. Cecília Sheila Lovato', 'salgado.natal@example.com', '(99) 90265-0433', '66625-000', '05470-619, R. Ramos, 1\nde Souza d\'Oeste - RN', '35', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(284, 'Sra. Alessandra Amaral', 'andressa.amaral@example.org', '(97) 91496-9286', '66625-000', '90178-643, Travessa Michele, 1964\nIsis do Leste - DF', '63', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(285, 'Sr. William Nero Souza Sobrinho', 'verdara.emiliano@example.org', '(97) 90533-0942', '66625-000', '09320-727, Av. Sandro Rios, 280. F\nMauro d\'Oeste - PE', '56', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(286, 'Graziela Rafaela Reis', 'clarice43@example.com', '(24) 98406-1009', '66625-000', '36475-145, Largo Naiara da Silva, 3194. Bloco C\nVila Laiane d\'Oeste - RR', '18', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(287, 'Dr. Franciele Serra Aguiar Sobrinho', 'anderson60@example.org', '(69) 3989-1033', '66625-000', '66766-918, Rua Bella Franco, 1. Bloco C\nSanta Cláudia do Norte - TO', '57', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(288, 'Gabi Agustina das Neves Neto', 'ariane90@example.net', '(83) 2599-5801', '66625-000', '86519-769, R. Leon, 29336. Bloco B\nLia do Norte - ES', '33', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(289, 'Sr. Walter Uchoa Meireles', 'galindo.cauan@example.com', '(21) 2502-9473', '66625-000', '03481-353, Largo Katherine Alves, 12. Apto 024\nVila Joaquim do Leste - MG', '24', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(290, 'Dayane Balestero Padrão', 'valente.lucia@example.org', '(73) 3399-9219', '66625-000', '16618-752, Avenida Augusto, 528. 0º Andar\nMila do Norte - MG', '40', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(291, 'Alexa Camacho Prado', 'wellington.velasques@example.com', '(71) 2131-8878', '66625-000', '62752-021, Rua Heitor Soares, 33258. F\nVila Allan do Leste - MG', '88', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(292, 'Sr. Allan Espinoza Neto', 'prado.agostinho@example.com', '(17) 3291-3221', '66625-000', '38009-822, Av. Cristian, 32537. Bc. 2 Ap. 49\nUrias d\'Oeste - RS', '32', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(293, 'Dr. Adriano Ícaro Vieira Filho', 'anderson.caldeira@example.net', '(51) 2162-7863', '66625-000', '88162-183, Avenida Benedito Soares, 57035. Anexo\nPorto Valéria do Norte - RS', '69', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(294, 'Luiz Azevedo Ortiz Sobrinho', 'matheus.deoliveira@example.com', '(95) 95395-9817', '66625-000', '53277-743, Largo Allison Galhardo, 86\nVila Moisés - RR', '65', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(295, 'André Verdugo Ferreira Neto', 'estevao66@example.org', '(98) 91639-1321', '66625-000', '45103-899, Travessa Meireles, 99714\nValente do Leste - SE', '96', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(296, 'Sra. Mirela Salas Sobrinho', 'heloise.aranda@example.net', '(33) 4749-8560', '66625-000', '71406-686, Av. Noelí Colaço, 368\nQueirós do Leste - PE', '93', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(297, 'Daniele Cortês Alcantara Neto', 'assuncao.sandra@example.net', '(16) 91979-3132', '66625-000', '60937-914, R. Juan Corona, 4. Bloco C\nCarol do Norte - PI', '94', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(298, 'Dr. Gean Mendes Neto', 'fcamacho@example.net', '(62) 4278-6222', '66625-000', '47856-847, R. Márcio Aguiar, 414\nRezende d\'Oeste - PE', '42', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(299, 'Dr. Wilson Ricardo Teles', 'miguel.salas@example.com', '(91) 95207-9622', '66625-000', '89730-923, Travessa Gean Duarte, 691\nVioleta do Sul - AP', '53', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(300, 'Alícia de Souza Vasques', 'simao.dias@example.com', '(96) 2356-6434', '66625-000', '84520-485, Travessa Pedrosa, 297\nZambrano d\'Oeste - RN', '45', 'Text Text Text Text Text', '2021-04-02 12:29:08', '2021-04-02 12:29:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contract`
--

CREATE TABLE `contract` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `value` double NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` bigint(20) NOT NULL,
  `contract_name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_number` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complement` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generator_structure` bigint(20) DEFAULT NULL,
  `started_at` datetime NOT NULL,
  `finished_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `contract`
--

INSERT INTO `contract` (`id`, `status`, `seller_id`, `client_id`, `value`, `description`, `type`, `contract_name`, `phone`, `cep`, `address`, `address_number`, `complement`, `generator_structure`, `started_at`, `finished_at`, `created_at`, `updated_at`) VALUES
(1, 'EM ANDAMENTO', 25, 1, 14621, 'Rerum sapiente ut et voluptates qui. Eos aut beatae dolorum explicabo quia doloribus. Aut reiciendis ipsa soluta autem ea nam omnis. Et aut maxime explicabo dicta ipsum. Ab id unde nemo.', 2, 'Gian Santiago Padrão Jr. Leal', '(34) 3913-0284', '66625-000', '75368-665, Avenida Laura, 23291. Fundos\nCarvalho do Leste - TO', '56', 'Text Text Text Text Text', NULL, '2021-10-30 09:53:47', '2022-01-28 09:53:47', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(2, 'CONCLUÍDO', 17, 286, 50163, 'Aspernatur culpa nam recusandae officia ut. Maiores molestias enim illum non. Culpa suscipit voluptatibus et et dolorem aliquid.', 2, 'Davi Heitor Serra Jr. Escobar', '(63) 99752-7387', '66625-000', '96574-935, R. Valentina, 15\nPorto Aaron - TO', '49', 'Text Text Text Text Text', NULL, '2020-10-24 09:39:34', '2021-01-22 09:39:34', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(3, 'PENDENTE', 5, 31, 20217, 'Inventore vero et corrupti iusto minus assumenda voluptatibus. Nisi eligendi aliquid fugiat similique sint aut. Voluptas voluptas sunt sint aut. Et amet facere est autem aspernatur.', 2, 'Constância Reis Ferreira', '(54) 3388-6568', '66625-000', '95108-315, Travessa Stephanie, 274\nFábio do Norte - MS', '32', 'Text Text Text Text Text', NULL, '2020-10-15 22:01:02', '2021-01-13 22:01:02', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(4, 'EM ANDAMENTO', 4, 37, 53996, 'Hic nam minus consequatur optio quas. Cupiditate magni corrupti corrupti soluta qui. Quis qui voluptatem architecto incidunt totam sunt. Possimus omnis neque voluptas tenetur nulla officiis.', 2, 'Dr. Thalia Lutero Marques', '(48) 2433-9731', '66625-000', '68310-040, Av. Lara Saraiva, 45668. Apto 338\nSão Luna do Norte - MA', '97', 'Text Text Text Text Text', NULL, '2020-12-17 16:00:24', '2021-03-17 16:00:24', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(5, 'PENDENTE', 13, 2, 62893, 'Natus quod eum voluptates quia non rerum quasi et. Similique numquam eum pariatur accusamus quod. Et et tenetur recusandae quis consectetur accusantium eum et.', 1, 'Dr. Gustavo Delvalle Padilha Sobrinho Barros', '(95) 90787-3877', '66625-000', '11233-617, Rua Moisés Burgos, 3322. Bc. 4 Ap. 87\nPorto Thiago - RR', '22', 'Text Text Text Text Text', 4, '2022-01-28 04:55:43', '2022-04-28 04:55:43', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(6, 'CONCLUÍDO', 3, 296, 45099, 'Facilis ab vel totam sunt facilis. Enim et maiores quis asperiores alias sapiente. In ut omnis voluptas eaque fugit. Est ea autem aliquid cumque recusandae non voluptas.', 2, 'Srta. Louise Melina de Arruda Neto Perez', '(31) 98739-9135', '66625-000', '34294-647, Travessa Madalena, 98\nPorto Edson do Sul - SP', '90', 'Text Text Text Text Text', NULL, '2022-02-26 00:44:25', '2022-05-27 00:44:25', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(7, 'PENDENTE', 29, 284, 78702, 'Sed sed labore sint autem velit in. Sed laborum aut iste eaque quidem veniam doloremque ullam. Iste non perspiciatis aspernatur quibusdam.', 2, 'Inácio Assunção Lozano', '(84) 97644-2344', '66625-000', '35283-039, Avenida Vale, 920\nPorto Cléber do Norte - SC', '30', 'Text Text Text Text Text', NULL, '2021-02-01 23:55:30', '2021-05-02 23:55:30', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(8, 'EM ANDAMENTO', 30, 97, 25216, 'Quia illum itaque excepturi reiciendis saepe voluptatibus ratione est. Molestias enim id vitae assumenda eos. Ut voluptates aut aut earum ut deserunt. Nisi suscipit aut sed id et consectetur.', 1, 'Srta. Stephanie Lidiane Lira Maia', '(43) 93215-9252', '66625-000', '32625-033, R. Cíntia, 3. Apto 37\nSão Francisco - PE', '92', 'Text Text Text Text Text', 1, '2022-09-07 16:17:16', '2022-12-06 16:17:16', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(9, 'PENDENTE', 16, 261, 63556, 'Veniam ipsa velit iste omnis laboriosam totam et. Error consequatur quo maxime modi quo id. Voluptatum porro excepturi perspiciatis consequatur. Et est nulla in asperiores distinctio sint.', 1, 'Isabelly Grego Pacheco Sobrinho Lozano', '(64) 96048-4259', '66625-000', '33276-287, Travessa Rocha, 1949\nPorto Marília d\'Oeste - SP', '42', 'Text Text Text Text Text', 3, '2022-01-03 05:00:46', '2022-04-03 05:00:46', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(10, 'CONCLUÍDO', 1, 207, 79679, 'Rerum numquam neque eos voluptas eos ducimus. Eum sint corrupti est rerum doloremque optio quis. Velit quis magnam illum. Dolores facilis et neque iusto nihil iusto dolores.', 2, 'Sr. Miguel Rocha Solano Neto Tamoio', '(71) 2869-3084', '66625-000', '18732-010, Largo Alessandra Carrara, 64\nVila Matias - RR', '97', 'Text Text Text Text Text', NULL, '2020-04-12 21:09:23', '2020-07-11 21:09:23', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(11, 'CONCLUÍDO', 20, 174, 35084, 'Et reprehenderit qui eligendi nisi. Nisi nesciunt illo vero atque. Blanditiis ut nam asperiores cum asperiores aut. Unde dolores et porro rerum in.', 2, 'Srta. Alma Rivera Souza', '(96) 2563-6393', '66625-000', '56975-763, Rua Hosana, 68268. Apto 195\nVila Vicente - GO', '42', 'Text Text Text Text Text', NULL, '2021-11-06 04:31:47', '2022-02-04 04:31:47', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(12, 'PENDENTE', 24, 169, 10123, 'Itaque atque explicabo nihil mollitia. Id cum dolorum impedit quidem omnis. Delectus dicta accusantium velit reiciendis qui.', 2, 'Sr. Tomás Isaac Valentin Pereira', '(91) 96181-3012', '66625-000', '80965-688, Rua Tatiane, 7691\nNelson d\'Oeste - SP', '42', 'Text Text Text Text Text', NULL, '2021-12-04 09:34:12', '2022-03-04 09:34:12', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(13, 'EM ANDAMENTO', 6, 275, 67479, 'In placeat non omnis velit. Impedit omnis deserunt ratione mollitia officiis est distinctio ipsam. Natus asperiores sint laboriosam non voluptatem dolores.', 1, 'Dr. Leo Serna Fernandes Sales', '(86) 3659-1699', '66625-000', '25239-617, R. Roberta Sandoval, 98099\nVila Augusto do Leste - SE', '80', 'Text Text Text Text Text', 2, '2020-10-29 00:23:50', '2021-01-27 00:23:50', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(14, 'CONCLUÍDO', 22, 22, 37149, 'Dolores quia in rerum fugit qui impedit. Ab alias in voluptatibus et et quidem optio.', 2, 'Sra. Maraisa Pâmela Torres Filho Molina', '(31) 99764-8140', '66625-000', '14823-378, R. Caroline, 7694. Apto 017\nVila Taís do Sul - MS', '98', 'Text Text Text Text Text', NULL, '2022-01-21 06:56:45', '2022-04-21 06:56:45', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(15, 'PENDENTE', 7, 298, 61761, 'Possimus necessitatibus aliquam cumque qui rerum ut. Amet nemo mollitia enim et hic maiores animi. Quo modi non recusandae vero molestiae rerum modi.', 1, 'Dr. Benjamin Valentin Fonseca Jr. Martines', '(88) 97468-8773', '66625-000', '19273-864, R. Guerra, 18\nManuel do Leste - MT', '42', 'Text Text Text Text Text', 1, '2022-10-14 02:05:23', '2023-01-12 02:05:23', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(16, 'PENDENTE', 21, 40, 11504, 'Accusantium similique et magnam doloremque voluptates debitis exercitationem. Hic consectetur voluptate quas consequatur commodi beatae. Quos ut sunt suscipit tempora perferendis magnam rerum libero.', 1, 'Lidiane Alana Rodrigues Jr. Galindo', '(61) 91345-5589', '66625-000', '66264-765, Rua Benjamin Rangel, 55899. Bloco A\nCaio do Sul - SE', '43', 'Text Text Text Text Text', 1, '2021-02-24 05:06:48', '2021-05-25 05:06:48', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(17, 'PENDENTE', 14, 281, 21891, 'Qui in illo est eum nam illum iusto. Ipsam necessitatibus et et et cupiditate. Similique soluta sed labore aut sunt quas quas.', 1, 'Cristian Zaragoça Filho Romero', '(98) 98308-8552', '66625-000', '95624-472, Av. Saulo Feliciano, 80\nFeliciano do Sul - SE', '41', 'Text Text Text Text Text', 3, '2022-06-07 03:01:39', '2022-09-05 03:01:39', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(18, 'PENDENTE', 27, 232, 15924, 'Et molestias unde dolor quidem hic nam et porro. Est officia possimus aut delectus aut. Sed est doloremque aut at consequuntur quia qui.', 2, 'Sr. Igor Leonardo Torres Correia', '(28) 95912-1570', '66625-000', '80157-885, Travessa Laura, 2255. Bloco A\nJácomo d\'Oeste - SC', '55', 'Text Text Text Text Text', NULL, '2020-03-01 07:17:08', '2020-05-30 07:17:08', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(19, 'CONCLUÍDO', 25, 216, 22219, 'Qui aut dolores qui enim placeat. Est ab autem autem occaecati. Illo sunt saepe enim eveniet fugiat cumque sequi dolorem.', 2, 'Dr. Caio Zambrano Filho Domingues', '(68) 97690-9351', '66625-000', '70164-029, Largo Téo, 66935. Apto 5297\nSão Regina - MS', '11', 'Text Text Text Text Text', NULL, '2022-07-19 21:52:19', '2022-10-17 21:52:19', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(20, 'PENDENTE', 21, 125, 31141, 'Ratione sapiente accusamus praesentium laboriosam recusandae. Consequuntur ducimus eos sit neque sunt praesentium. Deserunt rerum exercitationem molestiae est eveniet.', 1, 'Daniella Pedrosa Sobrinho Esteves', '(53) 92943-9528', '66625-000', '25205-360, Avenida Matias, 1. Anexo\nLeal do Sul - BA', '22', 'Text Text Text Text Text', 3, '2022-07-25 07:00:25', '2022-10-23 07:00:25', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(21, 'PENDENTE', 19, 106, 16811, 'Quam dolor dolore veritatis aut temporibus. Aut officiis alias atque fugit at reiciendis totam. Ipsa molestiae soluta quis quis aut.', 2, 'Cristina Romero Salgado Furtado', '(13) 3244-6165', '66625-000', '76968-988, Rua Irene, 4497. Fundos\nSanta Renan do Sul - RN', '55', 'Text Text Text Text Text', NULL, '2022-05-26 08:06:55', '2022-08-24 08:06:55', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(22, 'CONCLUÍDO', 17, 275, 63990, 'Corrupti perspiciatis atque assumenda cupiditate vel aut. Illo non nihil culpa iure amet sequi officia. Voluptatum aut vitae enim ut. Totam et voluptas molestiae consectetur quasi velit provident.', 2, 'Sra. Aline Bianca Matos Maia', '(65) 3598-4999', '66625-000', '21760-735, R. Jácomo Solano, 15680\nSão Isis do Leste - AC', '15', 'Text Text Text Text Text', NULL, '2021-05-09 00:18:03', '2021-08-07 00:18:03', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(23, 'PENDENTE', 1, 193, 54748, 'Aperiam numquam alias amet consequatur provident rerum. Eligendi exercitationem quo atque nisi commodi. Ut voluptatem architecto aut iste et quae aut quisquam. Sed qui omnis et facilis unde rerum.', 2, 'Davi Meireles Filho Pedrosa', '(73) 3855-6852', '66625-000', '45923-361, Rua Vinícius, 142. Apto 5037\nSanta Mateus do Norte - MS', '43', 'Text Text Text Text Text', NULL, '2022-11-21 18:10:50', '2023-02-19 18:10:50', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(24, 'PENDENTE', 28, 121, 45036, 'Iusto quidem similique veniam nemo delectus. Sed fuga et sint qui. Sed et fugit iste aut blanditiis. Facere recusandae enim quidem nulla et odio.', 1, 'Malena Escobar Sobrinho Santos', '(84) 4469-9548', '66625-000', '39255-138, R. Sanches, 59341. Apto 978\nSanta Beatriz d\'Oeste - MA', '88', 'Text Text Text Text Text', 3, '2021-12-03 23:04:36', '2022-03-03 23:04:36', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(25, 'EM ANDAMENTO', 21, 178, 53392, 'Excepturi expedita autem aut et. Dignissimos earum reiciendis et itaque voluptas tempore non modi. Explicabo nihil vel enim rem quia.', 2, 'Cauan Wagner Sandoval Uchoa', '(51) 2857-1414', '66625-000', '71399-322, Rua Yasmin Rezende, 1\nDelatorre do Sul - PB', '42', 'Text Text Text Text Text', NULL, '2020-09-01 19:00:38', '2020-11-30 19:00:38', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(26, 'PENDENTE', 22, 104, 32099, 'Odit et aut aliquid odio voluptatem asperiores. Fugit sit maxime nobis. Voluptatem aut natus accusantium in saepe voluptas similique.', 2, 'Kelly Godói Salgado Jr. Paz', '(99) 97220-5720', '66625-000', '83336-481, Rua Edilson Santos, 1\nRios do Sul - MS', '35', 'Text Text Text Text Text', NULL, '2022-08-20 05:02:18', '2022-11-18 05:02:18', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(27, 'PENDENTE', 28, 114, 60711, 'Vel quos quisquam est. Aut impedit non ad iusto. Dolorem occaecati sapiente maxime voluptatum repudiandae. Enim voluptas dolorem id aut.', 1, 'Sr. Adriano Caio Guerra Filho Quintana', '(54) 4515-4493', '66625-000', '36494-801, Largo Olívia, 88. Fundos\nVanessa do Leste - MS', '81', 'Text Text Text Text Text', 3, '2021-10-31 13:02:42', '2022-01-29 13:02:42', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(28, 'CONCLUÍDO', 5, 139, 34892, 'Iure enim quos voluptatum et earum. Quis est odit quos vitae aperiam non dolorem. Expedita illo accusantium consequatur fuga non incidunt odio.', 1, 'Dr. Norma Galindo Assunção Neto Maia', '(53) 95674-6883', '66625-000', '13096-166, Rua Denis Duarte, 91\nSão Valentina - MS', '56', 'Text Text Text Text Text', 3, '2020-03-11 05:56:27', '2020-06-09 05:56:27', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(29, 'EM ANDAMENTO', 10, 298, 45571, 'Et repellendus iusto quam tempora consequuntur et voluptatem. Nobis magnam animi saepe dolor. Magni nisi quidem voluptas fugit et autem sequi. Sit et consequuntur doloribus et et odit et natus.', 1, 'Paloma Furtado Montenegro', '(42) 4323-5283', '66625-000', '66843-217, Av. Rodrigo, 81\nSantos d\'Oeste - AL', '47', 'Text Text Text Text Text', 2, '2020-02-24 14:38:49', '2020-05-24 14:38:49', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(30, 'EM ANDAMENTO', 29, 118, 22248, 'Minima harum est pariatur enim aliquam. Quia pariatur minus fuga qui tenetur. Repudiandae sint et cumque totam eveniet maiores quibusdam.', 1, 'Rosana Mari Madeira Fidalgo', '(95) 92793-3763', '66625-000', '54650-188, Rua Emiliano Bittencourt, 88772\nMárcia d\'Oeste - AL', '52', 'Text Text Text Text Text', 4, '2020-05-31 16:10:43', '2020-08-29 16:10:43', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(31, 'PENDENTE', 6, 215, 150000, 'Descrição', 1, 'Adriano Lovato', '(74) 4056-9599', '66625-000', '93554-963, Avenida Karine Ortega, 375. Apto 5152São Franco do Norte - TO', '81', 'Text Text Text Text Text', 2, '2021-04-02 09:33:10', '2021-07-01 09:33:10', '2021-04-02 12:33:10', '2021-04-02 12:33:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contract_product`
--

CREATE TABLE `contract_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `contract_product`
--

INSERT INTO `contract_product` (`id`, `contract_id`, `product_id`, `quantity`, `type`, `created_at`, `updated_at`) VALUES
(1, 5, 4, '25', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(2, 5, 1, '2', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(3, 5, 7, '75MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(4, 5, 1, '10', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(5, 5, 11, '9', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(6, 8, 6, '50', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(7, 8, 1, '3', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(8, 8, 7, '100MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(9, 8, 7, '4', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(10, 8, 3, '7', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(11, 9, 1, '44', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(12, 9, 1, '4', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(13, 9, 3, '50MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(14, 9, 6, '3', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(15, 9, 2, '5', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(16, 13, 5, '35', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(17, 13, 1, '2', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(18, 13, 6, '100MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(19, 13, 3, '3', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(20, 13, 1, '1', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(21, 15, 1, '15', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(22, 15, 1, '1', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(23, 15, 7, '50MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(24, 15, 4, '2', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(25, 15, 12, '7', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(26, 16, 2, '26', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(27, 16, 1, '1', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(28, 16, 7, '25MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(29, 16, 7, '5', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(30, 16, 10, '8', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(31, 17, 4, '44', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(32, 17, 1, '4', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(33, 17, 5, '100MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(34, 17, 6, '5', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(35, 17, 3, '6', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(36, 20, 1, '23', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(37, 20, 1, '4', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(38, 20, 6, '75MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(39, 20, 2, '8', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(40, 20, 1, '2', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(41, 24, 6, '15', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(42, 24, 1, '3', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(43, 24, 1, '75MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(44, 24, 1, '3', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(45, 24, 10, '10', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(46, 27, 4, '39', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(47, 27, 1, '3', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(48, 27, 6, '100MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(49, 27, 2, '5', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(50, 27, 10, '5', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(51, 28, 4, '44', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(52, 28, 1, '4', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(53, 28, 6, '25MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(54, 28, 1, '6', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(55, 28, 10, '10', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(56, 29, 6, '46', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(57, 29, 1, '4', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(58, 29, 4, '50MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(59, 29, 4, '2', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(60, 29, 6, '3', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(61, 30, 6, '49', 'GENERATOR', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(62, 30, 1, '2', 'STRING_BOX', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(63, 30, 2, '50MT', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(64, 30, 7, '10', 'OTHER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(65, 30, 10, '10', 'SOLAR_INVERTER', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(66, 31, 1, '15', 'SOLAR_INVERTER', '2021-04-02 12:33:10', '2021-04-02 12:33:10'),
(67, 31, 1, '50', 'OTHER', '2021-04-02 12:33:10', '2021-04-02 12:33:10'),
(68, 31, 5, '50', 'GENERATOR', '2021-04-02 12:33:10', '2021-04-02 12:33:10'),
(69, 31, 6, '15', 'OTHER', '2021-04-02 12:33:10', '2021-04-02 12:33:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipment_generator`
--

CREATE TABLE `equipment_generator` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `producer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `technology` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `power` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `equipment_generator`
--

INSERT INTO `equipment_generator` (`id`, `module`, `producer`, `technology`, `power`, `created_at`, `updated_at`) VALUES
(1, 'RS6E-150P', 'Resun', 'Monocristalino', 450, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(2, 'RS6E-150P', 'Resun', 'Policristalino', 150, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(3, 'TSM-PE15H', 'Trina Solar', 'Monocristalino', 405, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(4, 'RS6E-150P', 'Trina Solar', 'Monocristalino', 150, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(5, 'ODA400-36-M', 'OSDA', 'Monocristalino', 400, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(6, 'SA10-36P', 'Sinosola', 'Policristalino', 10, '2021-04-02 12:29:09', '2021-04-02 12:29:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipment_other`
--

CREATE TABLE `equipment_other` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `equipment_other`
--

INSERT INTO `equipment_other` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Par de Conectores Femea/Macho Staubli MC4', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(2, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Preto - Multiplo 25 Metros', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(3, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Vermelho - Multiplo 25 Metros', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(4, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Azul - Multiplo 25 Metros', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(5, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Verde - Multiplo 25 Metros', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(6, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Amarelo - Multiplo 25 Metros', '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(7, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Laranja - Multiplo 25 Metros', '2021-04-02 12:29:09', '2021-04-02 12:29:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipment_solar_inverter`
--

CREATE TABLE `equipment_solar_inverter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `mppt` bigint(20) NOT NULL,
  `power` bigint(20) NOT NULL,
  `voltage` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `equipment_solar_inverter`
--

INSERT INTO `equipment_solar_inverter` (`id`, `producer`, `mppt`, `power`, `voltage`, `created_at`, `updated_at`) VALUES
(1, 'ABB', 2, 20, 220, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(2, 'ABB', 2, 60, 380, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(3, 'ABB', 4, 50, 220, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(4, 'ABB', 4, 100, 380, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(5, 'Fronius Eco', 2, 25, 220, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(6, 'Fronius SYMO', 2, 12, 220, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(7, 'Fronius SYMO Brasil', 2, 15, 380, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(8, 'WEG SIW600', 4, 25, 380, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(9, 'WEG SMA', 4, 30, 220, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(10, 'WEG SIW500H ST012', 4, 100, 380, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(11, 'WEG SUN 2000–60KTL-MO', 2, 60, 220, '2021-04-02 12:29:09', '2021-04-02 12:29:09'),
(12, 'WEG SUN 2000–40KTL-MO', 4, 40, 380, '2021-04-02 12:29:09', '2021-04-02 12:29:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipment_string_box`
--

CREATE TABLE `equipment_string_box` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `producer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `equipment_string_box`
--

INSERT INTO `equipment_string_box` (`id`, `model`, `producer`, `created_at`, `updated_at`) VALUES
(1, '1000v', 'Ecosolys', '2021-04-02 12:29:09', '2021-04-02 12:29:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `log`
--

INSERT INTO `log` (`id`, `title`, `message`, `ip`, `category`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'CONTRATO CRIADO', '\n                        <strong class=\'text-primary\'>Data:</strong> <strong class=\'text-warning\'>02/04/2021 09:33:10.</strong><br>\n                        <strong class=\'text-primary\'>IP:</strong> <strong class=\'text-warning\'>::1</strong><br>\n                        <strong class=\'text-primary\'>Ação Realizada por:</strong> <strong class=\'text-warning\'>User Admin.</strong><br>\n                        <strong class=\'text-primary\'>Cliente: </strong> <strong class=\'text-danger\'>Adriano Lovato.</strong>', '::1', 'CONTRATO', 31, '2021-04-02 12:33:10', '2021-04-02 12:33:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(18, '2014_10_12_000000_create_users_table', 1),
(19, '2014_10_12_100000_create_password_resets_table', 1),
(20, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(23, '2021_01_24_083237_create_sessions_table', 1),
(24, '2021_02_10_044408_create_category_table', 1),
(25, '2021_02_16_072504_create_clients_table', 1),
(26, '2021_02_18_181153_create_logs_table', 1),
(27, '2021_02_22_184126_create_sellers_table', 1),
(28, '2021_02_24_171039_create_contracts_table', 1),
(29, '2021_03_08_142633_create_seller_teams_table', 1),
(30, '2021_03_13_170716_create_equipment_other_table', 1),
(31, '2021_03_13_170814_create_equipment_generator_table', 1),
(32, '2021_03_16_082510_create_equipment_string_box_table', 1),
(33, '2021_03_16_082638_create_equipment_solar_inverter_table', 1),
(34, '2021_03_19_070515_create_contract_product_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `seller`
--

CREATE TABLE `seller` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seller_team_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `seller`
--

INSERT INTO `seller` (`id`, `name`, `email`, `phone`, `cep`, `address`, `address_number`, `complement`, `seller_team_id`, `created_at`, `updated_at`) VALUES
(1, 'Daniela Fernandes Sandoval Sobrinho', 'cordeiro.daniella@example.com', '(12) 2123-2386', '66625-000', '66292-575, Largo Luis Velasques, 4283. Bc. 4 Ap. 88\nSarah do Leste - SP', '57', 'Text Text Text Text Text', 22, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(2, 'Dr. Arthur Ferminiano Espinoza Sobrinho', 'galindo.kauan@example.com', '(54) 91904-4395', '66625-000', '07514-443, Travessa Diego Domingues, 78991\nSão Maximiano - GO', '34', 'Text Text Text Text Text', 21, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(3, 'Dr. Priscila Eduarda Zaragoça', 'casanova.marisa@example.net', '(96) 94721-0256', '66625-000', '66791-296, Travessa Estêvão Mendes, 6387. Apto 7\nValente do Leste - SC', '15', 'Text Text Text Text Text', 17, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(4, 'Paola Rosana Delatorre Sobrinho', 'christian.queiros@example.org', '(66) 92273-3520', '66625-000', '44838-804, Rua Ingrid Marés, 173\nVila Valentin do Leste - PI', '53', 'Text Text Text Text Text', 22, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(5, 'Dr. Antonieta Daiane Carmona', 'montenegro.sophie@example.net', '(64) 2955-6406', '66625-000', '14008-193, R. Sebastião, 976. 80º Andar\nSão Tatiana - PR', '13', 'Text Text Text Text Text', 21, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(6, 'Alonso Inácio Prado', 'pena.nicole@example.net', '(55) 2672-5138', '66625-000', '36072-514, Rua Fonseca, 4746. Apto 7\nVitória do Leste - RN', '92', 'Text Text Text Text Text', 12, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(7, 'Nayara Vega', 'deivid.solano@example.com', '(33) 94148-5436', '66625-000', '57866-722, Avenida Fonseca, 77336. 311º Andar\nSanta Moisés - RS', '10', 'Text Text Text Text Text', 1, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(8, 'Thalissa Pereira', 'cristian24@example.org', '(55) 3772-8359', '66625-000', '28238-002, Rua Vitória Esteves, 7803. Apto 416\nPontes d\'Oeste - SE', '41', 'Text Text Text Text Text', 9, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(9, 'Kléber Padilha', 'azevedo.raphael@example.net', '(61) 4839-7959', '66625-000', '96654-598, Largo Batista, 970\nSão Malu - AC', '61', 'Text Text Text Text Text', 20, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(10, 'Sra. Bia Karen Prado Sobrinho', 'gean80@example.com', '(75) 2988-6235', '66625-000', '37067-302, Av. Marta, 92\nBittencourt d\'Oeste - TO', '37', 'Text Text Text Text Text', 30, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(11, 'Pedro Maia Zamana Filho', 'hdasneves@example.net', '(55) 3276-4664', '66625-000', '78465-507, Rua Mauro Santana, 6. F\nRoberta d\'Oeste - MG', '33', 'Text Text Text Text Text', 25, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(12, 'Emiliano Alves Camacho Neto', 'mia12@example.org', '(11) 2419-9927', '66625-000', '46206-257, Travessa Ornela Rangel, 778\nVila Cléber - PE', '49', 'Text Text Text Text Text', 30, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(13, 'Giovanna Paes Neto', 'santos.maiara@example.com', '(68) 3540-7624', '66625-000', '41846-249, Avenida Dener, 1379\nVila Jennifer - SP', '28', 'Text Text Text Text Text', 14, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(14, 'Jean Tamoio Jr.', 'campos.diogo@example.org', '(38) 2256-2336', '66625-000', '39272-969, Av. Denis, 17066. 0º Andar\nSanta Thomas do Norte - RR', '96', 'Text Text Text Text Text', 20, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(15, 'Luis Carmona Jr.', 'yferminiano@example.com', '(14) 98091-8614', '66625-000', '96285-892, R. Fernandes, 72\nSanta Tâmara d\'Oeste - BA', '12', 'Text Text Text Text Text', 12, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(16, 'Srta. Thaís Gabrielly Lovato Sobrinho', 'thalita35@example.net', '(87) 90535-1083', '66625-000', '74078-624, Avenida Valentin, 20561. Bc. 1 Ap. 16\nSão Walter do Sul - GO', '41', 'Text Text Text Text Text', 17, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(17, 'Felipe Solano Leon', 'xtamoio@example.org', '(21) 3704-0290', '66625-000', '23834-846, Avenida Benez, 55\nSoares do Sul - SE', '33', 'Text Text Text Text Text', 24, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(18, 'Carlos Aaron Marinho', 'murilo.mendes@example.net', '(88) 2628-3528', '66625-000', '42996-644, Rua Cortês, 2624. 11º Andar\nMaldonado do Norte - AM', '90', 'Text Text Text Text Text', 24, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(19, 'Lucio Rosa', 'ortiz.emilia@example.net', '(84) 3444-3660', '66625-000', '06187-998, Rua Igor Estrada, 99\nCasanova do Leste - TO', '38', 'Text Text Text Text Text', 29, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(20, 'Dante Carrara', 'jasmin15@example.net', '(91) 2721-4961', '66625-000', '07618-535, Travessa Brito, 9\nSanches do Leste - TO', '20', 'Text Text Text Text Text', 25, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(21, 'Dr. Santiago Lucas Salazar', 'poliana.rodrigues@example.org', '(98) 93321-4295', '66625-000', '20769-251, Avenida Louise Rocha, 56480. Apto 1481\nSanta Rogério - MA', '67', 'Text Text Text Text Text', 26, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(22, 'Sra. Samanta Queirós Madeira', 'neves.tamara@example.org', '(82) 2059-0243', '66625-000', '93460-990, Rua Catarina Ferreira, 6. Apto 2090\nPorto Bárbara do Sul - PI', '79', 'Text Text Text Text Text', 4, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(23, 'Janaina Ariana Pena', 'ggalindo@example.org', '(71) 4263-9144', '66625-000', '00160-557, Largo Guilherme Marin, 62\nVila Aurora - PR', '16', 'Text Text Text Text Text', 26, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(24, 'Srta. Pérola Jéssica Benez Jr.', 'poliana05@example.org', '(11) 90260-4185', '66625-000', '61627-230, Rua Rivera, 23081. Apto 953\nVila Vicente - RN', '34', 'Text Text Text Text Text', 10, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(25, 'Dr. Jonas James das Neves', 'slira@example.com', '(18) 2611-5674', '66625-000', '73719-944, Largo das Dores, 4\nVila Robson do Sul - RO', '34', 'Text Text Text Text Text', 17, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(26, 'Dr. Estêvão Faro Soto Jr.', 'rangel.roberta@example.net', '(92) 3802-9509', '66625-000', '95451-957, Avenida Cervantes, 53\nSão Artur do Sul - RN', '93', 'Text Text Text Text Text', 16, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(27, 'Thomas Perez Chaves', 'acorona@example.net', '(53) 97229-7700', '66625-000', '28376-890, Largo Zamana, 17\nSanta Vicente do Norte - MS', '42', 'Text Text Text Text Text', 14, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(28, 'Luan Ziraldo Saito', 'uchoa.alexa@example.org', '(91) 90318-2724', '66625-000', '14374-014, Av. Agustina, 515. F\nDener do Norte - TO', '12', 'Text Text Text Text Text', 3, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(29, 'Théo Lourenço Neto', 'zsepulveda@example.com', '(71) 90465-5247', '66625-000', '47026-588, Rua Elias D\'ávila, 7. F\nPorto Bárbara do Leste - PB', '54', 'Text Text Text Text Text', 12, '2021-04-02 12:29:08', '2021-04-02 12:29:08'),
(30, 'Matias Alcantara Feliciano Jr.', 'ddasilva@example.net', '(87) 2857-4044', '66625-000', '63301-752, Travessa Daiana, 4. Bc. 77 Ap. 89\nValdez do Norte - SP', '59', 'Text Text Text Text Text', 28, '2021-04-02 12:29:08', '2021-04-02 12:29:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `seller_team`
--

CREATE TABLE `seller_team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `seller_team`
--

INSERT INTO `seller_team` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Sepúlveda Ltda.'),
(2, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Guerra-Espinoza'),
(3, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Perez e Torres'),
(4, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Vale Ltda.'),
(5, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Gonçalves-Paz'),
(6, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Gil e Uchoa S.A.'),
(7, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'das Dores e Serna S.A.'),
(8, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Serrano S.A.'),
(9, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Serra e Cervantes S.A.'),
(10, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Meireles e Filhos'),
(11, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Bonilha-Rios'),
(12, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Ortiz S.A.'),
(13, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Deverso Ltda.'),
(14, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Delgado-Estrada'),
(15, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Delatorre e Serna Ltda.'),
(16, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Carrara-Bezerra'),
(17, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Casanova e Souza e Associados'),
(18, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Sanches-Medina'),
(19, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Pedrosa e Filhos'),
(20, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Rodrigues-Batista'),
(21, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Valente Comercial Ltda.'),
(22, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Furtado e Associados'),
(23, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Medina Comercial Ltda.'),
(24, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Barros e Vega S.A.'),
(25, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Velasques e Associados'),
(26, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Feliciano-Salgado'),
(27, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Galvão Comercial Ltda.'),
(28, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Brito-Vega'),
(29, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Rezende e Santacruz'),
(30, '2021-04-02 12:29:08', '2021-04-02 12:29:08', 'Rodrigues Comercial Ltda.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KyCT9GaIF03jB5Rgk3GSTMrQH01iKZOihNHFWLap', 31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid1c4R214d0hicE40SVZVZHlLaVVaZDdMc1dsZElDQTlCQnpBY2VJRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRnZDViTms0Q1Z6TWJQbTdidGZSMmh1enVweWNySy5GVEpreEx4YUZmbzdUUUkvaGI2SE5FcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3QvZXJwc3VueWhvdXNlL2NvbnRyYWN0cyI7fX0=', 1617366795);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `status`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'Srta. Débora Salgado Sobrinho', 0, 'brito.matias@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'jOy9gAV21l', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(2, 'Felipe Saraiva Pacheco', 0, 'montenegro.fabricio@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'XEqslDwn4H', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(3, 'Srta. Malu Emanuelly Ávila', 0, 'dayana55@example.com', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'WktdKw79sw', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(4, 'Daiane Camacho Sandoval', 0, 'santana.tiago@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'GGEyVKIyFv', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(5, 'Priscila Rodrigues Rangel Jr.', 0, 'daniella.salas@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'egktJuQNMm', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(6, 'Sra. Bia Correia Vieira Neto', 0, 'cervantes.andrea@example.com', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'cMOq9b7NEa', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(7, 'Dr. Téo Afonso Fonseca Jr.', 0, 'cjimenes@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'aNfqxNJJA7', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(8, 'Lia Isabelly Torres Neto', 0, 'joaquim98@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'WwHyQ1EZ9r', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(9, 'Caio Carrara', 0, 'zuchoa@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'iWg2HwPfQv', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(10, 'Richard Pedro Marques', 0, 'yferreira@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'oonObbmo5y', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(11, 'Malu Rico Marinho Filho', 0, 'franco.santiago@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'TUqucjhKvn', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(12, 'Gabriel Flores Dias Jr.', 0, 'emeireles@example.com', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'fwggJWYcRc', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(13, 'Luciano Uchoa', 0, 'felipe.neves@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '0lonPtlx0A', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(14, 'Srta. Clarice Fernandes Vieira', 0, 'gil.noemi@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '5hA0SkzL2H', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(15, 'Mirela Ohana Sepúlveda Filho', 0, 'sandoval.lara@example.com', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'ABAShUHk0K', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(16, 'Lilian Pacheco', 0, 'luisa72@example.com', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'ghrF5cAfZf', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(17, 'Dr. Louise Ramires Branco', 0, 'agustina.beltrao@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'bmJx57KcZN', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(18, 'Sr. Leonardo Edilson Vega', 0, 'icaro.mares@example.com', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'rjH73Vg29X', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(19, 'Pedro Vega Jr.', 0, 'dante.amaral@example.com', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'SENOGSp5CY', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(20, 'Cristian Gian Aranda', 0, 'bonilha.fabio@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '4G2gv4vr1A', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(21, 'Sra. Sheila Cordeiro Sobrinho', 0, 'sepulveda.stephany@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '8cq2NI8KMc', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(22, 'Dr. Benedito Abreu Gil Sobrinho', 0, 'mila52@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'KnoNeAWzmX', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(23, 'Nayara Duarte Sobrinho', 0, 'zmolina@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '4QWSTWM59D', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(24, 'Sr. Eric Santacruz Serrano', 0, 'maldonado.aaron@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'gEnQcogpOp', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(25, 'Luis Bernardo Soares', 0, 'naiara16@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'ufzb0Eq3Xj', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(26, 'Cristiano Dante Valente Filho', 0, 'flavio.solano@example.com', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'U7J02aB8PI', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(27, 'Elias Ronaldo Galvão', 0, 'pereira.inacio@example.net', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'wjnEAPJ4cm', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(28, 'Dr. Isabel Stella Faria', 0, 'marcelo.gusmao@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'qDRCjggkhI', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(29, 'Hugo Saraiva Saraiva Jr.', 0, 'david.barros@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'Iq4yP4WZaG', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(30, 'Dr. Cauan Samuel Maldonado', 0, 'breno.rezende@example.org', '2021-04-02 12:29:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'STjowHSIIS', '2021-04-02 12:29:06', '2021-04-02 12:29:06', 2),
(31, 'User Admin', 1, 'admin@admin.com', '2021-04-02 12:29:08', '$2y$10$gd5bNk4CVzMbPm7btfR2huzupycrK.FTJkxLxaFfo7TQI/hb6HNEq', NULL, NULL, '0', '2021-04-02 12:29:08', '2021-04-02 12:29:08', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_category`
--

CREATE TABLE `user_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `user_category`
--

INSERT INTO `user_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ADMINISTRADOR', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(2, 'ENGENHARIA', '2021-04-02 12:29:06', '2021-04-02 12:29:06'),
(3, 'OPERACIONAL', '2021-04-02 12:29:06', '2021-04-02 12:29:06');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_email_unique` (`email`);

--
-- Índices para tabela `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contract_product`
--
ALTER TABLE `contract_product`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `equipment_generator`
--
ALTER TABLE `equipment_generator`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `equipment_other`
--
ALTER TABLE `equipment_other`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `equipment_solar_inverter`
--
ALTER TABLE `equipment_solar_inverter`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `equipment_string_box`
--
ALTER TABLE `equipment_string_box`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seller_email_unique` (`email`);

--
-- Índices para tabela `seller_team`
--
ALTER TABLE `seller_team`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- Índices para tabela `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `client`
--
ALTER TABLE `client`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT de tabela `contract`
--
ALTER TABLE `contract`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `contract_product`
--
ALTER TABLE `contract_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `equipment_generator`
--
ALTER TABLE `equipment_generator`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `equipment_other`
--
ALTER TABLE `equipment_other`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `equipment_solar_inverter`
--
ALTER TABLE `equipment_solar_inverter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `equipment_string_box`
--
ALTER TABLE `equipment_string_box`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `seller`
--
ALTER TABLE `seller`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `seller_team`
--
ALTER TABLE `seller_team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `user_category`
--
ALTER TABLE `user_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
