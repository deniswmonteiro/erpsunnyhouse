-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Mar-2021 às 19:47
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
(1, 'Tessália Cristina das Dores Sobrinho', 'rchaves@example.org', '(71) 2744-3584', '66625-000', '08538-897, Travessa Paloma Salazar, 406. 24º Andar\nJorge d\'Oeste - RS', '83', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(2, 'Dr. Maximiano Verdara Jr.', 'zamana.jeronimo@example.net', '(11) 95212-9804', '66625-000', '17868-571, Travessa Melinda, 9. Bloco C\nLuna d\'Oeste - TO', '38', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(3, 'Dr. Arthur Luiz Bonilha Jr.', 'bittencourt.teo@example.org', '(44) 95175-1313', '66625-000', '60151-310, Rua Alexandre, 2\nGrego do Norte - PR', '87', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(4, 'Thaís Rodrigues Gil Jr.', 'tainara54@example.org', '(44) 92792-6821', '66625-000', '96035-471, Largo Louise, 26. Bloco C\nSão Carlos do Norte - PR', '29', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(5, 'Dr. Dante Caldeira Chaves Sobrinho', 'mbenez@example.net', '(96) 4231-8551', '66625-000', '01193-254, Largo Thomas, 890. 2º Andar\nGomes do Norte - SP', '30', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(6, 'Bella Ohana Esteves Neto', 'oalves@example.net', '(16) 2231-7981', '66625-000', '30030-496, Avenida Catarina, 50\nSão Laís - ES', '47', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(7, 'Robson de Arruda Verdara', 'anderson.montenegro@example.net', '(95) 92894-9985', '66625-000', '66873-870, Av. Artur Valentin, 141\nPorto Nayara do Leste - AP', '11', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(8, 'Eva Mila Montenegro Neto', 'cgalvao@example.com', '(42) 98615-9659', '66625-000', '49792-791, Av. Dirce, 99. Apto 2\nSantana d\'Oeste - GO', '43', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(9, 'Sr. Martinho Santiago Matias', 'nfaro@example.com', '(14) 96430-5196', '66625-000', '79081-350, R. Bonilha, 991. Apto 91\nMarin do Leste - SP', '88', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(10, 'Alessandro Aranda Queirós Sobrinho', 'rvaldez@example.net', '(42) 2508-2093', '66625-000', '81401-234, R. Anderson, 52. Bloco A\nVila Leonardo - SC', '23', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(11, 'Sophia Aranda', 'eunice91@example.org', '(41) 99710-0180', '66625-000', '26730-358, R. Roberto Sandoval, 37335. 392º Andar\nGiovana do Leste - ES', '19', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(12, 'Sr. Wilson Cláudio Chaves', 'marcia.deoliveira@example.com', '(85) 4267-7169', '66625-000', '44856-928, R. Everton Perez, 37504. Apto 0773\nPorto Regiane - AP', '94', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(13, 'Bia Alice Cervantes', 'rocha.denise@example.com', '(43) 98402-3376', '66625-000', '80347-228, R. Neves, 779\nAngélica d\'Oeste - RN', '64', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(14, 'Christian Paes', 'lozano.italo@example.org', '(87) 92950-2036', '66625-000', '44612-807, Av. Rodrigues, 61. Bloco B\nVila Emiliano d\'Oeste - TO', '11', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(15, 'Thales Alan Santacruz Jr.', 'noa26@example.com', '(83) 2119-8055', '66625-000', '49787-267, Travessa Heloísa, 28855\nRogério do Leste - CE', '58', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(16, 'Dr. Tábata Lúcia Marques', 'lia.benites@example.org', '(75) 96911-4202', '66625-000', '81292-293, R. Ferreira, 36. 34º Andar\nVila Luis d\'Oeste - CE', '54', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(17, 'Sr. Máximo Gean Padilha', 'scortes@example.org', '(17) 2547-4458', '66625-000', '98961-654, Largo Nicole Aguiar, 91\nEmílio do Sul - PR', '16', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(18, 'Sr. Luciano Ávila Galhardo', 'malu.quintana@example.net', '(42) 96429-8002', '66625-000', '23052-511, R. Pacheco, 10529. Anexo\nUchoa do Norte - SE', '64', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(19, 'Diogo Ávila Serra Filho', 'galindo.christian@example.com', '(62) 4677-7770', '66625-000', '05091-753, Travessa Yuri Amaral, 176. Apto 217\nSão Fernando - RJ', '49', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(20, 'Eunice Verdugo Solano Jr.', 'lourenco.jonas@example.com', '(35) 4502-4895', '66625-000', '24825-886, Travessa Cordeiro, 5. Anexo\nNatal do Sul - RJ', '92', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(21, 'Sophie Jimenes Burgos Filho', 'pdelgado@example.org', '(91) 90036-4364', '66625-000', '14691-603, Avenida Sônia Ortega, 275\nSão Ester do Norte - AP', '49', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(22, 'Sr. Artur Benez Rezende Sobrinho', 'lrios@example.org', '(68) 91425-3973', '66625-000', '40318-562, Travessa Gusmão, 45395. Bloco A\nVila André do Leste - AL', '25', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(23, 'Pedro Verdara Pontes Sobrinho', 'xferreira@example.org', '(75) 4449-7242', '66625-000', '11144-477, Largo Maísa, 212\nVila Martinho - RO', '30', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(24, 'Nathalia Saito Branco Jr.', 'lmares@example.net', '(86) 2901-0488', '66625-000', '70208-436, Av. Tomás Aranda, 279. Anexo\nBurgos d\'Oeste - SC', '89', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(25, 'Sr. Thales David Romero Neto', 'verdugo.camilo@example.net', '(92) 91621-1649', '66625-000', '70860-212, Travessa Jerônimo da Cruz, 9. 100º Andar\nÍtalo d\'Oeste - MG', '37', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(26, 'Sr. Pablo Grego Jr.', 'nero49@example.net', '(44) 2488-7572', '66625-000', '37511-403, Travessa Carvalho, 42\nSaulo do Leste - ES', '94', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(27, 'Antonieta Leal Rivera', 'pserna@example.net', '(67) 4716-5385', '66625-000', '14680-220, Largo da Rosa, 418. Fundos\nSanta Emanuel do Norte - AM', '40', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(28, 'Danielle de Arruda Verdara Sobrinho', 'stefany.carvalho@example.net', '(63) 91400-5471', '66625-000', '68624-109, Travessa Alma, 33. F\nSônia do Sul - MA', '55', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(29, 'Dr. Michael Batista Romero', 'marcia.medina@example.org', '(71) 92886-7335', '66625-000', '00946-423, R. Gabriel, 38. Bc. 80 Ap. 93\nLorenzo d\'Oeste - PB', '18', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(30, 'Sr. Miguel Denis Serra', 'jennifer.corona@example.com', '(46) 90083-0542', '66625-000', '31576-143, Rua Marisa Neves, 510\nPorto Talita do Sul - PA', '47', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(31, 'Sophie Sanches', 'xortega@example.org', '(45) 97197-3896', '66625-000', '35907-414, R. Carolina, 98976\nPorto Sergio - SE', '51', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(32, 'Théo Joaquin Azevedo Filho', 'joana84@example.com', '(15) 91557-2183', '66625-000', '57679-981, R. Gean, 25967\nSão Bruno do Sul - MG', '14', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(33, 'Dr. Louise Juliana Estrada Sobrinho', 'beltrao.gean@example.com', '(83) 90805-8517', '66625-000', '14669-482, Travessa Cauan Bonilha, 93166\nDominato do Leste - MS', '11', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(34, 'Sr. Leonardo Estêvão Godói', 'marina84@example.net', '(69) 2790-0230', '66625-000', '88837-658, Av. Cléber, 1418\nPorto Breno - GO', '48', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(35, 'Dr. Cristiana Zaragoça Neto', 'eduardo.madeira@example.com', '(67) 99038-9879', '66625-000', '83327-298, R. Leon, 333\nSanta Jerônimo - SP', '24', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(36, 'Dr. Micaela da Silva Faria Neto', 'isabella28@example.net', '(62) 98043-9566', '66625-000', '55961-993, Travessa Amélia, 48\nPorto Leonardo d\'Oeste - CE', '44', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(37, 'Maiara Barros Faria', 'manuel55@example.com', '(99) 99632-1705', '66625-000', '45701-479, Travessa Gael Lozano, 913\nSepúlveda do Leste - PA', '67', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(38, 'Sr. Horácio Zambrano Branco Filho', 'garcia.lais@example.com', '(34) 2223-5641', '66625-000', '46207-835, Travessa Juliano Camacho, 26\nSanta Fabiano - MT', '42', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(39, 'Srta. Mary Serrano Filho', 'mia.uchoa@example.org', '(82) 97617-4499', '66625-000', '47448-925, Rua Marisa Quintana, 81. Bloco C\nVila Walter do Leste - AL', '37', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(40, 'Mariana Rangel Estrada', 'fdeaguiar@example.org', '(19) 3787-8275', '66625-000', '10230-160, Av. Lourenço, 9. Anexo\nSão Natal d\'Oeste - GO', '98', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(41, 'Simão Cléber de Arruda', 'reinaldo.bonilha@example.com', '(98) 2914-8663', '66625-000', '37171-669, Av. Julieta Mendonça, 112\nPorto Henrique - RN', '30', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(42, 'Daniela Flávia Cortês', 'bonilha.melinda@example.net', '(49) 95513-6727', '66625-000', '85954-584, Rua Alan, 8563. 4º Andar\nHeitor d\'Oeste - PR', '65', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(43, 'Emily Zambrano Serrano Jr.', 'neves.thales@example.com', '(35) 2499-2552', '66625-000', '00503-495, Largo Cíntia Sepúlveda, 85447. Bc. 18 Ap. 58\nSão Suellen d\'Oeste - RJ', '32', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(44, 'Sra. Clara Azevedo Ramos', 'horacio45@example.com', '(21) 99825-5676', '66625-000', '44489-282, R. Alonso Rico, 7\nSanta Isadora - SC', '44', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(45, 'Dr. Christian Arthur D\'ávila', 'ortega.edilson@example.net', '(64) 94687-0432', '66625-000', '72740-034, Rua Elis de Oliveira, 87. 242º Andar\nMarcelo do Sul - SE', '89', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(46, 'Ziraldo Ávila Filho', 'aaron19@example.com', '(63) 4874-6385', '66625-000', '65935-035, Av. Fabrício Pontes, 6198. Apto 9\nMaia d\'Oeste - DF', '60', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(47, 'Thaís Helena Rocha Filho', 'madalena74@example.com', '(91) 92772-2948', '66625-000', '87553-532, Rua Galindo, 22960\nSão Lidiane d\'Oeste - MT', '64', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(48, 'Dr. Samuel Jácomo Rezende', 'bianca.deaguiar@example.net', '(33) 4528-7339', '66625-000', '69477-592, Av. Nayara Sandoval, 4215\nPorto Emerson d\'Oeste - ES', '59', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(49, 'Martinho Artur Neves', 'michelle55@example.net', '(85) 4624-8787', '66625-000', '43176-737, Travessa Danilo, 303\nOtávio d\'Oeste - PE', '70', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(50, 'Dr. Danilo Vega', 'dener.galvao@example.net', '(22) 3046-4877', '66625-000', '80837-113, Avenida de Oliveira, 1470\nEstrada d\'Oeste - RO', '24', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(51, 'Mirella Uchoa Filho', 'fdelvalle@example.net', '(34) 94681-0068', '66625-000', '76641-456, Travessa Ferreira, 530\nPorto Alice - MT', '72', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(52, 'Dr. Juan Ian Godói', 'pneves@example.net', '(64) 93798-5367', '66625-000', '24822-012, Avenida Diego, 5413. 7º Andar\nVila Murilo do Norte - TO', '56', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(53, 'Sr. Kauan Velasques Vasques Filho', 'eloa96@example.net', '(79) 94356-3606', '66625-000', '74864-956, Travessa Ziraldo Roque, 834\nUrias do Norte - RR', '22', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(54, 'Nicolas Luan Matias', 'qalves@example.org', '(38) 4148-2067', '66625-000', '87498-352, Travessa Romero, 5\nCamilo do Sul - MT', '88', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(55, 'Dr. Isabelly Anita Zaragoça Sobrinho', 'benicio.amaral@example.net', '(18) 97671-8401', '66625-000', '01284-504, Travessa Suellen, 31\nMiranda do Norte - MG', '42', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(56, 'Diana Thalita Lovato Jr.', 'rios.gabriel@example.com', '(97) 2428-1791', '66625-000', '06145-982, Avenida Leal, 8\nEdson d\'Oeste - AM', '21', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(57, 'Eloá Godói Sobrinho', 'tatiane.aguiar@example.org', '(12) 93504-9223', '66625-000', '09267-942, Avenida Adriele Dominato, 772\nCervantes d\'Oeste - PA', '84', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(58, 'Luciana Emily Zamana', 'guerra.naiara@example.org', '(92) 90005-1107', '66625-000', '16818-739, Largo Burgos, 10029. 649º Andar\nFranco d\'Oeste - MA', '36', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(59, 'Dr. Eduardo Rios Neto', 'janaina.leon@example.org', '(92) 97399-3885', '66625-000', '59596-434, Av. Rodrigues, 77503\nPorto Tâmara do Norte - CE', '23', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(60, 'Sra. Gisele Carmona', 'elovato@example.org', '(94) 3005-4645', '66625-000', '03156-756, Travessa Renata Assunção, 3\nSilvana do Leste - RJ', '99', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(61, 'Sr. Evandro Maurício Oliveira', 'christopher.prado@example.net', '(18) 2682-1736', '66625-000', '24987-628, Av. Mary Marinho, 8530\nSão Emanuelly d\'Oeste - PE', '19', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(62, 'Dr. Viviane Roque Valência', 'ffeliciano@example.com', '(34) 3234-1380', '66625-000', '22464-793, Travessa Suelen Aguiar, 56. F\nReinaldo d\'Oeste - MS', '19', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(63, 'Malena Queirós Ferreira', 'molina.martinho@example.net', '(97) 91225-0259', '66625-000', '70906-541, R. Ítalo Meireles, 95\nVila Estêvão - TO', '11', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(64, 'Sra. Eloá Brito Sobrinho', 'ideoliveira@example.net', '(34) 3290-1048', '66625-000', '74040-829, Largo Luciana Pontes, 291\nGustavo do Leste - PB', '62', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(65, 'Simão Valente Filho', 'uchoa.fernando@example.org', '(34) 99558-9617', '66625-000', '74652-488, Travessa Cauan Gonçalves, 79193. Bloco B\nSanta Théo - MS', '76', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(66, 'Sra. Giovana Correia', 'rverdara@example.com', '(13) 90072-0676', '66625-000', '62266-615, Avenida Lorena Feliciano, 6347. Fundos\nKatherine do Norte - SE', '67', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(67, 'Dr. Bernardo Vega Branco', 'dener58@example.com', '(17) 2347-7088', '66625-000', '80482-450, R. Carrara, 40519. 072º Andar\nDelvalle do Leste - CE', '25', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(68, 'Lucas Corona', 'vfaria@example.net', '(47) 95145-0089', '66625-000', '31814-056, Rua Quintana, 34\nVila Adriel do Leste - AC', '86', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(69, 'Sr. Alessandro Eduardo das Dores', 'ecordeiro@example.org', '(92) 3603-0845', '66625-000', '19278-872, R. Tomás, 409. Apto 7672\nSão Sueli do Leste - AM', '94', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(70, 'José Saraiva Sobrinho', 'julio59@example.com', '(93) 93404-0062', '66625-000', '53069-918, Avenida Thaís, 50491\nCasanova do Leste - RJ', '59', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(71, 'Sra. Mariah Chaves', 'cristiano.assuncao@example.org', '(32) 94431-8765', '66625-000', '32869-094, R. Galhardo, 911\nSanta Emanuelly - RS', '40', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(72, 'Sr. Théo Christopher Rivera', 'medina.sofia@example.com', '(28) 90011-0671', '66625-000', '15491-646, R. Raquel Ortega, 7\nCervantes d\'Oeste - CE', '80', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(73, 'Srta. Elizabeth Anita Galindo Filho', 'emily96@example.com', '(41) 99538-8276', '66625-000', '03822-221, Travessa Emiliano, 3\nJúlia do Leste - RJ', '14', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(74, 'Srta. Micaela Amélia Torres Sobrinho', 'gferraz@example.com', '(47) 93503-5878', '66625-000', '43053-926, Rua Santana, 6089\nSão Gilberto do Sul - PE', '23', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(75, 'Nathalia Abreu Marques', 'demian.solano@example.net', '(15) 3887-0205', '66625-000', '62386-258, Rua Naiara, 5957. 05º Andar\nSanta Tâmara - MA', '88', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(76, 'Dr. Raphael Rodrigues Gusmão Sobrinho', 'cecilia87@example.com', '(62) 3413-0358', '66625-000', '90458-870, Avenida Renata Solano, 7\nVerônica do Leste - PB', '24', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(77, 'Sra. Samara Isis Medina Jr.', 'gabi35@example.org', '(69) 98435-3895', '66625-000', '24073-604, Rua Ohana Rezende, 3875. Apto 7\nSanta Eduardo d\'Oeste - MG', '32', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(78, 'Allan Emanuel Flores Neto', 'juliana.lutero@example.com', '(85) 92027-9215', '66625-000', '75103-669, Travessa Suzana Queirós, 16\nPorto Valéria do Norte - PA', '61', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(79, 'Dr. Viviane Brito', 'renan23@example.net', '(74) 94650-5855', '66625-000', '47710-670, Travessa Casanova, 82868\nPorto Catarina - GO', '61', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(80, 'Sr. Felipe Aguiar', 'hernani41@example.net', '(22) 4955-6994', '66625-000', '94979-004, R. Anderson, 97. Bloco B\nVila Naomi do Sul - PB', '63', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(81, 'Srta. Gabriela Marés Cruz', 'julieta35@example.net', '(28) 92462-7252', '66625-000', '26826-366, Av. Lira, 6. 83º Andar\nSueli do Sul - DF', '39', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(82, 'Sra. Giovanna Duarte Ferreira', 'estrada.poliana@example.net', '(91) 95632-0805', '66625-000', '83639-287, Travessa Rios, 387\nRosa do Norte - CE', '30', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(83, 'Dr. Regina Soto Ortega Sobrinho', 'aguiar.alessandro@example.org', '(96) 4100-7040', '66625-000', '94713-790, Largo Denis, 22\nSão Maraisa do Sul - PE', '86', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(84, 'Rogério Camacho Vasques Neto', 'lbeltrao@example.com', '(44) 98529-9698', '66625-000', '33307-323, Largo Emanuel, 20482\nVila Pérola - AC', '73', 'Text Text Text Text Text', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(85, 'Sr. Benjamin Leon', 'ester38@example.org', '(89) 4313-1837', '66625-000', '11680-921, R. Rosa, 66585\nSanta Denise - RN', '89', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(86, 'Sarah Matias', 'delgado.carol@example.com', '(68) 94199-6313', '66625-000', '82984-360, Travessa Fabrício Saraiva, 912. 3º Andar\nLidiane d\'Oeste - RJ', '88', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(87, 'Gabrielly Camacho Aragão', 'mmascarenhas@example.com', '(41) 97848-6519', '66625-000', '08094-245, Av. Giovanna, 9316\nMadeira do Sul - MA', '91', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(88, 'Michele das Dores Mendes', 'luiza09@example.net', '(93) 98338-4567', '66625-000', '95448-650, Largo Fonseca, 8. Bc. 6 Ap. 83\nPorto Ohana - SP', '37', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(89, 'Renata Alves Pedrosa Jr.', 'vsoares@example.net', '(32) 92875-9066', '66625-000', '83943-134, Rua Elis das Neves, 18200\nVila Jefferson - AL', '82', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(90, 'Sra. Noelí Aparecida da Rosa', 'tessalia25@example.org', '(94) 3162-0734', '66625-000', '08010-091, Travessa Karina, 97914. 290º Andar\nDelgado do Norte - PE', '41', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(91, 'Dante Garcia Beltrão Filho', 'matias.corona@example.com', '(49) 95112-8194', '66625-000', '70744-425, Largo Demian Ortega, 8\nFerreira do Norte - AP', '84', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(92, 'Dr. Maiara Cortês Neto', 'vdearruda@example.com', '(17) 95809-5400', '66625-000', '19382-313, R. Marco Salazar, 40\nVila Jennifer do Leste - PE', '82', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(93, 'Dr. Franco Domingues Lourenço Sobrinho', 'cordeiro.sergio@example.org', '(83) 95817-5128', '66625-000', '04185-171, Travessa Ferreira, 8. F\nPorto Manuela - SE', '34', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(94, 'Dr. Elias Jimenes', 'maia.naomi@example.org', '(35) 3021-2156', '66625-000', '68873-226, Travessa Lucio, 2395. Bc. 00 Ap. 65\nPorto Marco - SP', '14', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(95, 'Sr. Francisco Rico Meireles Filho', 'nbenites@example.org', '(34) 2225-7382', '66625-000', '68675-054, Avenida Pontes, 99\nVila Tessália - MS', '90', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(96, 'William Gomes Cervantes', 'lutero.flavia@example.org', '(55) 4632-9398', '66625-000', '80718-277, Av. Vega, 791\nPorto Emília do Leste - MA', '45', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(97, 'Rodolfo Rosa Rico', 'queiros.tomas@example.net', '(73) 2408-9544', '66625-000', '06510-302, Avenida Cláudia Alcantara, 3. Anexo\nPorto Micaela d\'Oeste - PI', '71', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(98, 'Alessandro Serrano de Freitas Filho', 'lgusmao@example.net', '(94) 99468-1809', '66625-000', '73767-665, Rua Suelen, 7\nSanta Natan - TO', '12', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(99, 'Dr. Lidiane Mariah Burgos Neto', 'dquintana@example.org', '(37) 4263-3928', '66625-000', '15454-938, Largo Andréia, 12962. Bc. 56 Ap. 23\nCléber d\'Oeste - BA', '29', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(100, 'Sara Mia Lourenço', 'bruna96@example.org', '(67) 95320-0119', '66625-000', '07953-486, R. Adriel Benez, 85\nCervantes do Norte - PR', '60', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(101, 'Micaela Dayane Zaragoça Neto', 'priscila.avila@example.org', '(65) 2034-3927', '66625-000', '01818-519, Travessa Franco, 2997. Anexo\nSão Rafael do Leste - RO', '53', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(102, 'Paloma Lourenço Neto', 'qlourenco@example.net', '(45) 99183-7633', '66625-000', '74208-519, Travessa Thales Barros, 4. Apto 077\nGonçalves do Norte - AM', '63', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(103, 'Sr. Tomás de Souza Batista', 'delatorre.vitor@example.com', '(13) 3963-9830', '66625-000', '98962-017, R. Graziela, 677\nVila Eduardo - SE', '30', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(104, 'Srta. Marisa Heloise Ortega', 'angelica.davila@example.org', '(82) 94862-4121', '66625-000', '29239-137, Av. Toledo, 8. Apto 18\nIsis do Leste - AC', '96', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(105, 'Sr. Tiago Valência Franco', 'sandoval.sarah@example.org', '(98) 3521-8068', '66625-000', '16386-131, Travessa Amaral, 52536. Bc. 08 Ap. 71\nMartines do Leste - AM', '43', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(106, 'Sr. Nero Mário Abreu', 'fatima97@example.org', '(16) 96341-1478', '66625-000', '07110-003, R. Romero, 68094\nQuintana do Norte - MS', '90', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(107, 'Sr. Cléber Madeira D\'ávila', 'valencia.janaina@example.org', '(88) 91280-8546', '66625-000', '48887-953, R. Grego, 53185\nPorto Camilo do Leste - SP', '50', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(108, 'Dr. Leandro Bruno Vila', 'mario23@example.com', '(14) 95983-4191', '66625-000', '61900-626, Travessa Laiane, 73475. Bloco B\nVila Fabrício do Leste - DF', '93', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(109, 'Dr. Gean Chaves Delvalle Sobrinho', 'umatias@example.org', '(46) 3088-0506', '66625-000', '38303-346, Rua Galvão, 640. Bc. 0 Ap. 25\nSão Noel - RO', '46', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(110, 'Srta. Mary de Freitas Dominato Neto', 'gusmao.arthur@example.com', '(18) 4654-3706', '66625-000', '25445-565, Rua Tábata, 40. Anexo\nVila Cristiana d\'Oeste - PR', '65', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(111, 'Dr. Christian Ortega Neto', 'campos.stefany@example.org', '(35) 2979-8301', '66625-000', '01482-933, R. Fátima, 297. 05º Andar\nPorto Jorge do Leste - PB', '37', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(112, 'Srta. Laura Thaís Toledo', 'santacruz.allison@example.org', '(73) 94732-0451', '66625-000', '15522-016, Largo Laís, 374. F\nSão Alana - MG', '17', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(113, 'Dr. Jácomo Prado Alves Neto', 'sescobar@example.com', '(93) 96102-3375', '66625-000', '49067-814, Av. Murilo Benites, 69. 96º Andar\nDias d\'Oeste - MS', '15', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(114, 'Manoela Dayana Benez', 'pvieira@example.com', '(27) 3793-1363', '66625-000', '21154-154, Avenida Maraisa Santana, 4927. Bloco C\nWilson do Leste - BA', '91', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(115, 'Dr. Diogo Guilherme Bonilha', 'azambrano@example.com', '(71) 90228-1561', '66625-000', '64754-357, Rua Yasmin Ávila, 8\nSão Micaela - AM', '67', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(116, 'Sr. Denis Leonardo Domingues Filho', 'ian.flores@example.net', '(97) 4206-1519', '66625-000', '38354-588, Av. Natan, 17726. Bloco A\nSanta Augusto d\'Oeste - TO', '31', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(117, 'Sr. Nero Jácomo Aragão', 'naiara.fonseca@example.com', '(13) 97531-0717', '66625-000', '79522-225, R. Pacheco, 57223. 3º Andar\nBurgos d\'Oeste - PB', '91', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(118, 'Dr. Suelen Luzia Chaves', 'corona.natal@example.net', '(49) 3384-2764', '66625-000', '78972-450, Largo Cauan Santos, 450\nPorto Angélica do Norte - RJ', '18', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(119, 'Srta. Kelly Ramires Deverso', 'bmascarenhas@example.com', '(69) 93666-6934', '66625-000', '21297-575, Av. Maísa, 89. 275º Andar\nLozano do Sul - BA', '32', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(120, 'Dr. Igor Aguiar', 'miguel.paz@example.org', '(77) 4998-2748', '66625-000', '68760-051, Travessa Domingues, 1. Bc. 81 Ap. 78\nVila Valentin do Norte - GO', '19', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(121, 'Dr. Alexandre Oliveira', 'zcampos@example.org', '(11) 90917-3674', '66625-000', '18064-697, Travessa Helena, 66144. Bloco C\nSanta Pedro do Norte - RO', '78', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(122, 'Srta. Helena Cristiana Zambrano', 'perez.eric@example.com', '(41) 4080-3534', '66625-000', '68392-483, Av. Domingues, 63963\nSoares d\'Oeste - PR', '64', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(123, 'Dr. Stephanie Vega', 'wesley11@example.com', '(95) 94954-3571', '66625-000', '78254-253, R. Rosa, 52\nSandoval do Norte - AM', '20', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(124, 'Fábio Perez de Aguiar Sobrinho', 'imedina@example.org', '(44) 96387-9736', '66625-000', '91472-047, Largo Moisés, 5. 18º Andar\nViviane d\'Oeste - PR', '80', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(125, 'Sra. Jéssica Sepúlveda Rios Neto', 'bvieira@example.com', '(84) 91102-8333', '66625-000', '67065-005, Avenida Noemi, 1\nWilson do Sul - DF', '59', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(126, 'Mary Fernandes', 'garcia.mia@example.net', '(51) 3539-9295', '66625-000', '49930-746, Av. Richard Meireles, 6. Bc. 94 Ap. 08\nSão Benício do Norte - SE', '33', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(127, 'Srta. Mirela Aurora Sepúlveda', 'everton.jimenes@example.com', '(43) 92438-6134', '66625-000', '10934-404, R. Perez, 521. Apto 15\nVila Paulo do Sul - MT', '55', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(128, 'Dr. Christopher Marés', 'paula.branco@example.org', '(24) 3077-8818', '66625-000', '62437-970, Avenida Luan, 1. Bc. 28 Ap. 30\nSanta Wesley - SC', '17', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(129, 'Srta. Daniele Furtado Mendes', 'ivan.galvao@example.net', '(46) 90211-9173', '66625-000', '72271-606, Avenida Gilberto Furtado, 5\nLara do Leste - GO', '35', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(130, 'Franco Benez Jr.', 'equeiros@example.org', '(64) 3137-8883', '66625-000', '08320-315, Travessa Heloísa, 10. 274º Andar\nSoares do Norte - PR', '84', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(131, 'Raissa Benez Filho', 'cortes.mary@example.org', '(16) 4682-4509', '66625-000', '57355-427, Avenida Rios, 59. F\nCordeiro d\'Oeste - ES', '28', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(132, 'Dr. Ruth Domingues Uchoa Sobrinho', 'horacio44@example.net', '(28) 94669-2037', '66625-000', '21221-932, Largo Alexandre Zaragoça, 83759. Apto 7953\nSanta Théo - DF', '24', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(133, 'Vitória Alice Gonçalves', 'colaco.isabelly@example.net', '(55) 4049-7916', '66625-000', '39789-384, Rua Martinho Camacho, 6\nSão Josefina - TO', '35', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(134, 'Cynthia Pontes', 'escobar.leia@example.com', '(42) 3259-6043', '66625-000', '20118-992, Av. Salas, 4925\nTéo do Sul - RJ', '33', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(135, 'Dr. Lúcia Iasmin Godói', 'vcampos@example.net', '(24) 90414-7838', '66625-000', '19862-258, Travessa Estrada, 38. Bc. 13 Ap. 28\nSanta Augusto do Sul - DF', '22', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(136, 'Sr. Cristóvão Heitor Chaves Sobrinho', 'heitor.duarte@example.com', '(97) 4033-9443', '66625-000', '59782-179, Avenida Marília Chaves, 89\nSão Josué - BA', '63', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(137, 'Sr. Adriano Branco Faro Neto', 'thalia.delvalle@example.org', '(15) 95121-6569', '66625-000', '00587-812, Largo Pedro Santos, 6. Bc. 60 Ap. 47\nElisa do Sul - SC', '21', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(138, 'Sr. Samuel Soares Sobrinho', 'acortes@example.com', '(44) 4664-1464', '66625-000', '15794-924, Avenida Fidalgo, 703\nVila Thomas do Leste - RR', '92', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(139, 'Dr. Inácio Erik Azevedo', 'valencia.suelen@example.com', '(98) 92137-7849', '66625-000', '86190-397, Rua Vale, 55\nPorto Gabriel do Leste - PB', '84', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(140, 'Sr. Murilo Everton Galhardo', 'roque.mary@example.org', '(38) 96422-2699', '66625-000', '31214-471, Largo Ferreira, 58221. Apto 455\nAbreu do Norte - AL', '39', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(141, 'Emerson Ferreira Rico', 'rramires@example.com', '(85) 93255-3837', '66625-000', '91315-565, Travessa Delgado, 68. Bc. 01 Ap. 95\nAnderson do Leste - RN', '28', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(142, 'Suelen Gil Beltrão', 'flavio.lozano@example.com', '(32) 4226-1984', '66625-000', '51994-555, R. Letícia, 4439. Apto 672\nPontes do Sul - MA', '90', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(143, 'Marta Dias Neto', 'gsantana@example.org', '(95) 93196-2457', '66625-000', '21078-271, Avenida Corona, 347\nFátima do Norte - RO', '65', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(144, 'Luzia Saito Sobrinho', 'xbenites@example.net', '(95) 98676-4080', '66625-000', '28862-532, Travessa Mascarenhas, 1765. F\nVila Viviane d\'Oeste - MS', '96', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(145, 'Dr. Pablo Colaço Abreu Sobrinho', 'guerra.miriam@example.com', '(54) 2002-2220', '66625-000', '72991-148, R. Teobaldo, 24. Fundos\nSanta Carol - RN', '71', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(146, 'Sra. Alma Romero', 'edilson16@example.org', '(13) 3531-0454', '66625-000', '11157-729, Travessa Pâmela, 8600\nJúlio do Sul - RR', '99', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(147, 'Dr. Marco Afonso Cervantes', 'smendes@example.com', '(53) 98819-4347', '66625-000', '61880-655, Travessa Azevedo, 43321\nPorto Rodolfo - BA', '55', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(148, 'Dr. Deivid Mascarenhas Valência', 'serna.luan@example.net', '(97) 4787-2749', '66625-000', '10028-256, Avenida Larissa da Rosa, 69\nVinícius do Leste - MT', '42', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(149, 'Sra. Elizabeth Talita Solano', 'leal.laura@example.net', '(17) 2009-8007', '66625-000', '30305-559, Av. Thalia, 80. 7º Andar\nUchoa d\'Oeste - PR', '50', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(150, 'Dr. Raphael Marés Ferreira', 'karen81@example.org', '(12) 90930-3526', '66625-000', '14878-958, Rua Emanuelly, 8352\nVila Sergio - DF', '35', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(151, 'Wesley Lucio Escobar', 'nelson.pereira@example.net', '(32) 97433-1271', '66625-000', '35343-667, Av. Lucio, 830. Bloco C\nLeon d\'Oeste - DF', '24', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(152, 'Dr. Ellen Barreto Sepúlveda Neto', 'qdasneves@example.net', '(48) 2093-3595', '66625-000', '24893-109, Largo Serra, 23. Apto 69\nPorto Nathalia do Norte - GO', '50', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(153, 'Dr. Jennifer Stella Estrada Filho', 'olivia63@example.org', '(83) 90292-4828', '66625-000', '31177-575, Avenida Solano, 6764. Apto 4\nSanta Lia d\'Oeste - AM', '20', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(154, 'Priscila Alícia Esteves Jr.', 'fgalindo@example.org', '(34) 93650-0499', '66625-000', '48590-196, R. Aragão, 320\nSão Jéssica do Norte - MG', '62', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(155, 'Srta. Sandra Arruda Sobrinho', 'eferraz@example.net', '(12) 97301-0656', '66625-000', '27462-596, Largo Luzia Vasques, 1866\nPorto Cristóvão d\'Oeste - TO', '100', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(156, 'Srta. Pâmela Sueli Caldeira Jr.', 'kramires@example.com', '(11) 90635-1284', '66625-000', '09975-481, Av. Vila, 2. Bc. 54 Ap. 12\nCezar do Leste - AP', '97', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(157, 'Sra. Gisele Estrada', 'eguerra@example.net', '(11) 92831-0326', '66625-000', '16821-515, Avenida Caldeira, 42\nCervantes do Norte - MS', '10', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(158, 'Sr. Mário Sergio Vega Neto', 'xqueiros@example.net', '(94) 3810-0167', '66625-000', '00194-664, Avenida Matos, 788\nVila Raissa - PI', '14', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(159, 'Dr. Noelí Serrano Mendonça', 'ana07@example.org', '(37) 4836-2647', '66625-000', '87350-459, Rua Corona, 33460\nSanches do Leste - MT', '28', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(160, 'Franco Reinaldo Meireles Filho', 'alan29@example.com', '(87) 92317-8376', '66625-000', '08653-626, Largo Heitor Abreu, 49. 20º Andar\nVila Violeta - PE', '20', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(161, 'Rogério Ferraz Vega', 'leon.regina@example.com', '(53) 2849-9495', '66625-000', '58410-144, Avenida Gael Barros, 2112. Apto 74\nSanta Dante do Sul - AL', '12', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(162, 'Dr. Constância Lavínia Ferminiano Sobrinho', 'xguerra@example.com', '(18) 95763-4247', '66625-000', '10076-895, Av. Eduarda, 272\nLorena do Sul - PI', '97', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(163, 'Renata Gabriela Correia', 'campos.alexandre@example.net', '(62) 3454-9607', '66625-000', '24728-565, Largo Maicon, 470. F\nSão Rafaela do Norte - RS', '76', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(164, 'Daniella Vale Flores Filho', 'fdias@example.com', '(15) 3131-9916', '66625-000', '06491-358, Avenida Ariane Pedrosa, 4\nLeal do Leste - RJ', '90', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(165, 'Daiana Vanessa Maldonado', 'filipe.correia@example.net', '(67) 97370-6943', '66625-000', '38476-849, Travessa Cláudio Amaral, 229\nFerminiano d\'Oeste - PR', '62', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(166, 'Richard Maurício das Neves', 'hugo.deoliveira@example.com', '(68) 4753-0299', '66625-000', '93577-060, Largo Beltrão, 226. Apto 5\nSanta Rafaela do Leste - SP', '25', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(167, 'Maitê Bezerra Souza Filho', 'correia.ian@example.net', '(92) 94531-0933', '66625-000', '15186-186, Rua Adriel, 28\nFaria do Norte - BA', '11', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(168, 'Dr. Lívia Espinoza Sobrinho', 'paz.alessandra@example.com', '(45) 4192-4292', '66625-000', '89293-511, Travessa Thiago, 84. 6º Andar\nSanta Marcelo do Leste - CE', '91', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(169, 'Dr. Bruno Bezerra Filho', 'vale.isis@example.org', '(53) 3665-0470', '66625-000', '90151-600, Av. Valente, 2044\nPablo do Norte - BA', '80', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(170, 'Sr. Dante Molina Assunção', 'serna.alexandre@example.com', '(98) 3531-1518', '66625-000', '94262-037, R. Alícia, 9\nVila Andres do Sul - RN', '33', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(171, 'Dr. Betina Soares', 'zsantacruz@example.net', '(46) 3324-0773', '66625-000', '93578-573, Avenida Moisés Marinho, 80905. Bc. 96 Ap. 35\nStephanie do Norte - RR', '84', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(172, 'Fabiano Burgos', 'qbarros@example.com', '(54) 4377-5271', '66625-000', '24597-207, Av. Gomes, 8313\nSão Paula do Norte - AL', '26', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(173, 'Laís Antonieta Padrão Jr.', 'kgalhardo@example.org', '(97) 94599-3806', '66625-000', '25138-968, R. Aparecida, 71786. Bc. 00 Ap. 63\nVila Rafaela - PA', '88', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(174, 'Edilson Raphael Zambrano', 'heloisa.dasilva@example.com', '(17) 2574-5578', '66625-000', '41095-151, Largo Vale, 54676\nMaldonado do Norte - AP', '27', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(175, 'Sra. Bruna Lozano', 'edilson.darosa@example.org', '(19) 2584-1849', '66625-000', '63003-692, Avenida Martines, 429\nJonas d\'Oeste - ES', '76', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(176, 'Sra. Mayara das Neves Neto', 'xdelgado@example.com', '(67) 91712-5936', '66625-000', '67651-885, Travessa Emanuel Valentin, 21\nSantiago d\'Oeste - PE', '72', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(177, 'Michelle Mascarenhas Jr.', 'kalves@example.org', '(18) 99667-2432', '66625-000', '85969-870, Av. Valentin, 7529. 36º Andar\nVila Aurora do Norte - MA', '39', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(178, 'Srta. Josefina Jéssica Quintana Filho', 'vanessa98@example.com', '(14) 4677-6904', '66625-000', '51418-963, Av. Heloísa Ferraz, 4650. 1º Andar\nPorto Adriel do Leste - PI', '51', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(179, 'Mirella Yasmin Salgado Sobrinho', 'duarte.breno@example.net', '(79) 94491-6716', '66625-000', '57428-169, Largo Helena Vega, 1. 886º Andar\nPrado do Sul - RO', '24', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(180, 'Emanuelly Isabella Prado', 'zaragoca.evandro@example.net', '(38) 90841-7453', '66625-000', '34932-217, Avenida Robson, 717. 81º Andar\nUchoa do Norte - RN', '71', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(181, 'Sra. Dirce Feliciano Jr.', 'alessandro.benez@example.com', '(77) 98678-1095', '66625-000', '73431-340, R. Silvana, 4583\nValdez do Norte - TO', '69', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(182, 'Sra. Luísa Jimenes Filho', 'kpaes@example.net', '(74) 4199-1113', '66625-000', '05155-032, Av. Laiane, 5\nAranda do Leste - RS', '10', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(183, 'Sr. Leo João Santiago', 'malu77@example.net', '(92) 3112-1884', '66625-000', '64113-456, Largo Neves, 74219\nSanta Emerson do Norte - SE', '13', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(184, 'Sra. Katherine Tatiane Salazar', 'kevin.garcia@example.org', '(37) 2611-5613', '66625-000', '92663-861, R. Matheus Branco, 26. Apto 7531\nSanta Jefferson do Norte - AM', '33', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(185, 'Saulo Fontes', 'blira@example.org', '(51) 91303-0903', '66625-000', '95729-842, Avenida Lucas, 97. Apto 2720\nSanta Samanta - SP', '32', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(186, 'Wilson Zaragoça Duarte Jr.', 'padilha.julio@example.org', '(82) 94106-3965', '66625-000', '79477-687, Av. Leal, 54\nSanta Maicon - CE', '19', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(187, 'Catarina Cruz', 'salgado.marcelo@example.com', '(31) 97566-0706', '66625-000', '56699-853, Avenida Delgado, 1865\nCarmona do Leste - AP', '17', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(188, 'Carlos Matos Filho', 'gustavo08@example.com', '(42) 97089-2502', '66625-000', '31466-738, Avenida Alexa, 6\nMaya do Sul - AC', '71', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(189, 'Dr. José Lira Jr.', 'tessalia.caldeira@example.net', '(38) 3091-6960', '66625-000', '92794-298, Largo Jean, 52\nSaraiva do Sul - SP', '75', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(190, 'Bernardo Pedro Teles Jr.', 'framires@example.com', '(13) 3367-1995', '66625-000', '00758-576, Avenida Fábio, 1101. 8º Andar\nSanta Raphael d\'Oeste - GO', '83', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(191, 'Dr. Kauan Rezende', 'norma57@example.net', '(85) 3438-6566', '66625-000', '55682-806, Largo Mariah Brito, 88147\nPorto Thiago - AP', '11', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(192, 'Dr. Maraisa Toledo Ferminiano Filho', 'krios@example.net', '(18) 3130-7437', '66625-000', '40851-514, Avenida Dener, 5. 9º Andar\nSão Sara do Sul - CE', '40', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(193, 'Laiane Lozano Ramires', 'paz.aurora@example.net', '(99) 99268-4517', '66625-000', '15041-623, R. Davi, 93316. Bloco B\nFeliciano do Leste - ES', '59', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(194, 'Bianca Bonilha Neto', 'correia.augusto@example.org', '(82) 3784-1670', '66625-000', '19571-051, Avenida Lia Guerra, 83176. 72º Andar\nAntônio do Sul - GO', '70', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(195, 'Sra. Tatiane Jimenes Balestero Jr.', 'mferreira@example.net', '(79) 3346-1676', '66625-000', '56790-197, Travessa Reis, 76\nVila Júlio do Sul - MG', '10', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(196, 'Sra. Naomi Julieta Serra', 'desouza.nero@example.org', '(94) 97162-2587', '66625-000', '81947-753, Travessa Agostinho, 21. Bc. 74 Ap. 26\nMatias d\'Oeste - PA', '96', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(197, 'Joaquim Ortiz Meireles', 'vsalazar@example.org', '(22) 99289-8389', '66625-000', '15191-159, Avenida Christopher, 764. Apto 5\nEstrada d\'Oeste - AP', '85', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(198, 'Srta. Kamila Brito Ramires', 'darosa.martinho@example.com', '(33) 4914-1936', '66625-000', '40911-789, Av. de Souza, 57. Bc. 02 Ap. 25\nPorto Naomi - PR', '20', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(199, 'Srta. Maísa Mia Matos', 'domingues.horacio@example.net', '(87) 90017-2594', '66625-000', '30173-501, Av. Valentin Pedrosa, 90. Apto 3944\nPorto Cléber - TO', '77', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(200, 'Dr. Isadora Lavínia Lutero Jr.', 'hmadeira@example.com', '(31) 92585-0179', '66625-000', '24942-311, Av. Lucas Abreu, 92. Bc. 6 Ap. 47\nFabiana do Norte - RO', '96', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(201, 'Diego Otávio Souza', 'quintana.leia@example.com', '(14) 4146-5352', '66625-000', '94666-556, Largo Alessandro, 84123\nSão Sônia do Sul - SE', '54', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(202, 'José Ícaro das Dores', 'kgusmao@example.net', '(68) 2891-2674', '66625-000', '24836-887, Largo Corona, 4\nPorto Arthur do Norte - TO', '21', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(203, 'Elis Fontes Sales Jr.', 'manuela51@example.net', '(34) 4556-9052', '66625-000', '87584-147, Largo Vale, 62. Apto 446\nIsabelly d\'Oeste - RO', '13', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(204, 'Sr. Téo de Aguiar Fernandes Sobrinho', 'sanches.cristovao@example.org', '(62) 91759-8620', '66625-000', '09826-481, R. Estrada, 23\nSanta Sandro - AM', '85', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(205, 'Jonas Rocha Sandoval', 'lutero.lavinia@example.net', '(16) 2299-9392', '66625-000', '99437-180, Av. Igor Rivera, 802\nEduarda do Norte - RR', '50', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(206, 'Dr. Joaquin Jácomo Escobar Filho', 'franco.barreto@example.org', '(66) 4945-0711', '66625-000', '87303-587, R. Tomás Tamoio, 7795\nPorto Dayana - TO', '76', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(207, 'Sr. Otávio Galvão', 'bmeireles@example.org', '(93) 91024-9699', '66625-000', '39954-963, Largo Marés, 8. Bloco C\nSão Agostinho - CE', '92', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(208, 'Dr. Iasmin de Aguiar', 'daniela34@example.org', '(42) 4585-8489', '66625-000', '19798-832, Travessa Vitor, 67\nSão Kelly - AP', '43', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(209, 'Débora Melissa Grego Neto', 'toledo.paulina@example.org', '(81) 94205-3231', '66625-000', '17694-865, Rua Correia, 4793\nCamilo do Norte - PR', '90', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(210, 'Hugo Natan Lira Jr.', 'alonso24@example.com', '(81) 92327-4095', '66625-000', '39988-544, Rua Mayara Meireles, 228. 486º Andar\nSaito do Sul - MG', '22', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(211, 'Laiane Maya Sales', 'viviane.espinoza@example.net', '(87) 3020-5148', '66625-000', '47491-798, Largo Abreu, 69\nHorácio do Norte - PB', '50', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(212, 'Dr. Mateus Rangel', 'sbonilha@example.com', '(86) 98474-4714', '66625-000', '30287-598, R. Vale, 4. Bc. 1 Ap. 06\nSantiago d\'Oeste - RO', '65', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(213, 'Alonso Dias Souza', 'alexandre83@example.com', '(73) 99609-3431', '66625-000', '41345-423, Largo Deverso, 260\nTéo d\'Oeste - PR', '76', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25');
INSERT INTO `client` (`id`, `name`, `email`, `phone`, `cep`, `address`, `address_number`, `complement`, `created_at`, `updated_at`) VALUES
(214, 'Thales Santiago da Cruz Sobrinho', 'westeves@example.com', '(49) 3716-3604', '66625-000', '53088-132, Av. Ávila, 5248. Bloco A\nSão Suelen - CE', '72', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(215, 'Ronaldo Prado Neto', 'sergio66@example.org', '(94) 2468-7532', '66625-000', '53525-224, Avenida Bárbara Verdugo, 751\nTomás do Leste - AP', '85', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(216, 'Isadora Martines Filho', 'stephanie.deaguiar@example.net', '(98) 2150-1143', '66625-000', '24712-119, Travessa Paz, 18257. Anexo\nMarta do Leste - DF', '25', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(217, 'Saulo Velasques', 'valeria.desouza@example.com', '(34) 3087-8954', '66625-000', '82967-694, Travessa Sanches, 495\nPorto Alonso do Norte - AM', '68', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(218, 'João Toledo Jr.', 'diego.dasneves@example.net', '(49) 93002-1117', '66625-000', '49119-159, Rua Kelly Corona, 5061\nGabrielle do Leste - MT', '62', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(219, 'Dr. Isabel Carvalho', 'thales.ferminiano@example.com', '(31) 4258-2406', '66625-000', '55463-378, Largo Louise, 70516. Bloco B\nVila Naomi do Norte - BA', '49', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(220, 'Abgail Vasques Casanova Jr.', 'iduarte@example.net', '(75) 96587-2732', '66625-000', '14863-976, Av. Elaine, 535\nSaito do Sul - SP', '46', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(221, 'Srta. Danielle Paola Soares', 'deverso.george@example.net', '(38) 3504-4958', '66625-000', '27067-470, Avenida Aurora, 12. Bloco B\nCarvalho do Norte - RN', '50', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(222, 'Sra. Mary Benites', 'avila.manoela@example.net', '(31) 4427-2140', '66625-000', '56282-421, Avenida Thalita, 6\nPorto Ohana do Leste - SE', '82', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(223, 'Marco Leonardo Serrano Neto', 'qteles@example.org', '(18) 4308-7865', '66625-000', '98390-066, Rua Duarte, 70871\nFurtado do Leste - CE', '65', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(224, 'Dr. Cléber Ferraz', 'jdasneves@example.com', '(66) 99619-2864', '66625-000', '08547-047, R. Benjamin, 8447\nUchoa do Norte - PB', '75', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(225, 'Guilherme Rosa', 'qpadrao@example.org', '(34) 2190-4990', '66625-000', '10238-215, Avenida Barros, 23922\nPorto Adriano do Leste - RS', '10', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(226, 'Lucio Emílio Medina', 'fabio.dasneves@example.net', '(54) 4457-6126', '66625-000', '68702-160, R. Delgado, 1\nPorto Carla do Norte - MA', '86', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(227, 'Sra. Mila Karen Feliciano', 'desouza.anderson@example.net', '(28) 97594-1180', '66625-000', '74350-673, Av. Amélia Bezerra, 3\nSanta Marina - AM', '28', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(228, 'Sônia da Silva Sales Sobrinho', 'madeira.flor@example.org', '(77) 4404-6378', '66625-000', '34262-661, Av. Silvana Maldonado, 792. Bloco C\nSão Lavínia do Sul - TO', '41', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(229, 'Amélia Suzana Barros Sobrinho', 'naiara.paes@example.net', '(19) 3185-8242', '66625-000', '29721-744, Travessa Reinaldo Torres, 9\nda Rosa d\'Oeste - SP', '11', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(230, 'Júlio Leon Matos', 'ferreira.heloisa@example.com', '(27) 4444-5366', '66625-000', '83981-506, Rua Nayara de Oliveira, 51996. Bloco A\nVila César do Leste - GO', '46', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(231, 'Ícaro Teles Lourenço Jr.', 'isaac85@example.org', '(49) 92284-3135', '66625-000', '32726-915, Av. Miriam, 34628. Apto 992\nGarcia d\'Oeste - ES', '32', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(232, 'Dr. Naomi Marés Sobrinho', 'milena71@example.com', '(37) 3631-4735', '66625-000', '78844-684, Avenida Gisele Guerra, 1805\nPorto Kléber - MS', '65', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(233, 'Bruno Afonso Martines Jr.', 'gverdara@example.net', '(67) 4769-0802', '66625-000', '49000-905, Largo Lia, 67\nSandoval do Leste - AM', '88', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(234, 'Davi Marés Jr.', 'thales.jimenes@example.net', '(96) 96952-0820', '66625-000', '72963-400, Av. Galhardo, 6. Fundos\nSão Laiane - ES', '66', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(235, 'Dr. Rafaela Godói Meireles', 'zaragoca.edson@example.org', '(84) 92831-7101', '66625-000', '81641-967, Av. Dayana, 3. Apto 0173\nChristopher do Sul - CE', '17', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(236, 'Sr. Hugo Rangel Velasques', 'ibonilha@example.com', '(99) 92059-3740', '66625-000', '67946-776, Avenida Ferreira, 97. F\nRoque d\'Oeste - SC', '35', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(237, 'Sr. Thomas Reis', 'katherine.pena@example.org', '(51) 2501-3092', '66625-000', '90058-305, R. Beatriz Pacheco, 5\nPorto Stephany do Norte - MA', '92', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(238, 'Janaina Jimenes das Dores', 'paulo30@example.org', '(65) 3973-3635', '66625-000', '59874-180, Rua Heloise, 76835. 85º Andar\nPorto Diego do Norte - RO', '77', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(239, 'Lidiane Lilian Arruda Sobrinho', 'kvelasques@example.org', '(14) 98454-5237', '66625-000', '61185-819, Av. Sônia, 4038\nSanta Melina do Sul - CE', '46', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(240, 'Luciano Paz Neto', 'zgalvao@example.net', '(65) 4637-7803', '66625-000', '29298-561, Largo Madalena Gomes, 91949\nSão Samara do Sul - AM', '81', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(241, 'Sr. Alexandre Oliveira Carrara Filho', 'gael82@example.com', '(13) 93575-9148', '66625-000', '88246-967, Avenida Davi, 6446. 26º Andar\nCatarina do Sul - MA', '61', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(242, 'Dr. Juliano Delatorre Cervantes', 'xsantiago@example.com', '(55) 2241-9816', '66625-000', '03067-586, Travessa Vila, 90502\nSão Nelson do Norte - SE', '78', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(243, 'Srta. Márcia Franco Sobrinho', 'esther08@example.net', '(38) 2980-4623', '66625-000', '43793-931, Av. Martines, 7. Bc. 31 Ap. 82\nQuintana do Norte - ES', '14', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(244, 'Dr. Lidiane Ingrid Quintana Sobrinho', 'pedrosa.maraisa@example.net', '(24) 97602-9652', '66625-000', '21091-995, R. Aguiar, 87. 789º Andar\nJimenes do Leste - MA', '60', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(245, 'Constância Ketlin Pacheco', 'xpadilha@example.org', '(91) 2843-7570', '66625-000', '32349-502, Largo Lozano, 72068. Bc. 81 Ap. 78\nSalgado d\'Oeste - RJ', '13', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(246, 'Dr. Cíntia Serna Saraiva', 'serna.pamela@example.org', '(81) 99916-1719', '66625-000', '13790-077, Avenida Delvalle, 24298\nDeverso do Leste - RS', '59', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(247, 'Lorena Deverso Santos', 'vdasdores@example.org', '(24) 4750-9516', '66625-000', '45782-795, Av. Antonella Dominato, 96390. Apto 36\nPorto Mauro do Leste - GO', '28', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(248, 'Dr. Murilo Fernandes Filho', 'vila.emily@example.org', '(15) 95622-4979', '66625-000', '72473-254, Travessa Quintana, 82. Bc. 4 Ap. 74\nLeandro do Leste - PE', '91', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(249, 'Viviane Serra Galhardo Filho', 'delgado.mari@example.net', '(38) 3438-8027', '66625-000', '50962-160, Avenida Sandra Vega, 293\nSanta Heloise d\'Oeste - PI', '87', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(250, 'Irene Toledo Meireles Jr.', 'lmolina@example.com', '(38) 95179-5402', '66625-000', '73878-354, Avenida Salas, 8\nSão Tainara do Sul - SC', '65', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(251, 'Pedro Jerônimo Aranda Jr.', 'msalgado@example.net', '(17) 2106-7179', '66625-000', '99938-598, Avenida Wellington Padrão, 57574\nSão Jéssica do Leste - AL', '51', 'Text Text Text Text Text', '2021-03-21 18:38:25', '2021-03-21 18:38:25'),
(252, 'Allison Gomes Toledo Jr.', 'pdasilva@example.net', '(17) 2409-3800', '66625-000', '21494-752, R. Sérgio Gusmão, 6367\nVila do Sul - RR', '52', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(253, 'Natal Emerson Matos Jr.', 'paola96@example.org', '(84) 97426-5277', '66625-000', '43520-705, Largo Serra, 57\nMateus do Leste - AM', '49', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(254, 'Jean Padilha Bezerra', 'serna.deivid@example.org', '(79) 98673-5290', '66625-000', '32615-748, Av. Luis, 47\nThomas do Sul - PA', '71', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(255, 'Mayara de Souza Filho', 'fmarinho@example.org', '(12) 96616-6412', '66625-000', '33729-029, Largo Emília Garcia, 2456\nSanta Rodolfo - SC', '95', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(256, 'Srta. Marina Maísa Ferreira Sobrinho', 'faro.kelly@example.com', '(42) 97201-0685', '66625-000', '36892-962, Rua Aragão, 719. 193º Andar\nPorto Silvana - RS', '13', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(257, 'Sr. Cristiano Sanches Benites', 'rodrigues.francisco@example.org', '(84) 2926-2179', '66625-000', '13990-687, Travessa Hugo Garcia, 90. Apto 6419\nPorto Lucas do Sul - GO', '94', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(258, 'Murilo Deverso Garcia', 'zdasilva@example.net', '(65) 97318-4673', '66625-000', '27917-918, Travessa Valentin, 585. 373º Andar\nVila Henrique - GO', '51', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(259, 'Letícia Juliane Teles Sobrinho', 'faria.yohanna@example.com', '(62) 4127-8416', '66625-000', '58440-644, Av. Quintana, 8205. F\nSanta Verônica - MT', '49', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(260, 'Dr. Paulina Paz Bittencourt Jr.', 'aurora32@example.org', '(65) 4341-2511', '66625-000', '00067-811, Travessa Simon Domingues, 90754. Bloco B\nSanta Fátima do Leste - SP', '52', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(261, 'Srta. Juliane Assunção Bonilha', 'reis.lavinia@example.net', '(51) 3940-0283', '66625-000', '41864-185, R. Noa, 879. Apto 6813\nValente do Leste - TO', '51', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(262, 'Willian Saito', 'luiz31@example.org', '(71) 2744-5160', '66625-000', '80938-423, Largo Verônica, 48. Fundos\nPorto Daniela - TO', '85', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(263, 'Srta. Madalena Batista Molina Filho', 'rsantiago@example.com', '(51) 99118-0431', '66625-000', '05742-032, Avenida Domingues, 9\nWellington d\'Oeste - MA', '60', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(264, 'Simão Arruda Ferminiano', 'urias.roberta@example.net', '(75) 96104-3948', '66625-000', '62652-265, Largo Thalia Garcia, 444\nVila Paulina - MA', '49', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(265, 'Dr. Gabriel Bezerra Galvão', 'ayla74@example.com', '(45) 4811-5565', '66625-000', '01920-147, Avenida Flor Camacho, 52. Apto 840\nSão Mauro do Sul - PI', '93', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(266, 'Robson Ferreira Godói Sobrinho', 'oliveira.iasmin@example.com', '(96) 4829-3972', '66625-000', '67333-918, R. Evandro, 91. Bloco C\nAmélia do Sul - RS', '19', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(267, 'Maitê Viviane Verdara', 'stella70@example.com', '(33) 98706-7431', '66625-000', '19808-937, Avenida Delatorre, 320. Bc. 79 Ap. 41\nDirce do Norte - MG', '67', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(268, 'Sr. Otávio Prado Feliciano', 'tfaro@example.com', '(11) 4917-6538', '66625-000', '04349-311, R. Solano, 70505. Bloco A\nPorto Ayla do Sul - RO', '25', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(269, 'Christian Alcantara', 'hmeireles@example.com', '(64) 97376-7862', '66625-000', '61146-417, Largo Paloma, 27. Bloco C\nBezerra do Norte - AL', '74', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(270, 'André Ortiz', 'matheus.mascarenhas@example.org', '(65) 93511-6274', '66625-000', '16630-601, R. Cristiano, 4. Bloco C\nVila James - PR', '25', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(271, 'Agostinho Benez Sales', 'dsantiago@example.com', '(54) 94187-9505', '66625-000', '18272-477, Avenida Mário, 27\nSão Sebastião - AL', '80', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(272, 'Louise Salas', 'valentin.arruda@example.net', '(84) 94941-0846', '66625-000', '07831-654, Largo Madalena, 2. Bc. 78 Ap. 42\nSão Ivan d\'Oeste - TO', '32', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(273, 'Thalita Giovanna Santacruz', 'ester53@example.org', '(75) 4216-6368', '66625-000', '12544-463, Travessa Benício, 63\nSanta Luara do Leste - MT', '100', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(274, 'Dr. Eduarda Melinda Fonseca Sobrinho', 'vitoria.beltrao@example.com', '(92) 2303-4809', '66625-000', '61620-159, Largo Lilian Fernandes, 7682. Bloco A\nFernandes do Sul - MG', '80', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(275, 'Fernando Bezerra', 'cvalentin@example.org', '(48) 2270-8222', '66625-000', '44752-926, R. Rocha, 2. Bloco A\nUchoa d\'Oeste - PB', '19', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(276, 'Simon Deverso Neto', 'cfaria@example.org', '(92) 94115-4788', '66625-000', '83418-301, Av. Perez, 50\nSanta Emanuelly do Leste - SP', '65', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(277, 'Sr. Edilson Carrara Alves Filho', 'gvalencia@example.org', '(81) 3136-4893', '66625-000', '07407-449, R. Karine, 37\nAriana do Norte - DF', '87', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(278, 'Isis Gomes', 'valencia.emiliano@example.com', '(24) 4190-4013', '66625-000', '96096-194, R. Jéssica, 34. Apto 001\nPorto Elias do Sul - DF', '14', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(279, 'Regiane Alma Correia Neto', 'ldominato@example.org', '(14) 4688-6336', '66625-000', '78630-311, R. Milene, 5829. Apto 11\nSueli do Norte - PB', '17', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(280, 'Dr. Miguel Ramires Salgado Sobrinho', 'oamaral@example.net', '(35) 94562-1743', '66625-000', '87749-566, Rua Karina, 522. 66º Andar\nPorto Henrique - PR', '26', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(281, 'Dr. Jerônimo Amaral Pontes Neto', 'fabricio77@example.org', '(12) 3975-0562', '66625-000', '67941-312, Av. Maiara, 85. Bc. 91 Ap. 97\nVila Valentina - ES', '43', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(282, 'Katherine Violeta Rodrigues', 'nero10@example.org', '(33) 4288-0862', '66625-000', '84173-784, Rua Eduardo, 967\nRocha do Norte - AM', '87', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(283, 'Maraisa Aguiar', 'leandro.pontes@example.net', '(47) 4741-6385', '66625-000', '22350-401, Avenida Rodrigo, 38878\nSão Samuel - CE', '100', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(284, 'Marcelo Pablo da Silva Filho', 'wverdara@example.com', '(35) 2162-2727', '66625-000', '21989-325, Rua Tiago Gil, 697. Bloco A\nLeal do Leste - MT', '14', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(285, 'George Galvão Campos Sobrinho', 'dacruz.danilo@example.com', '(32) 3136-4696', '66625-000', '03428-580, Avenida Reis, 87825\nMirela d\'Oeste - RO', '36', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(286, 'Gustavo Ortiz Delgado', 'rbrito@example.net', '(82) 93213-4536', '66625-000', '48941-630, Avenida Amanda Valentin, 42035. Apto 80\nPena do Norte - AL', '27', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(287, 'Tessália Caldeira Pena', 'lucia.galindo@example.com', '(34) 4170-8749', '66625-000', '13576-692, Travessa Ketlin Marés, 460\nPorto Thomas - BA', '66', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(288, 'Sra. Sheila Lia Dias', 'eliane.queiros@example.net', '(74) 98516-0630', '66625-000', '34849-553, Largo Rodrigues, 9946. 01º Andar\nSão Sarah - MA', '59', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(289, 'Madalena Verdara Dias Filho', 'dominato.luciana@example.org', '(14) 92152-9374', '66625-000', '47092-238, Av. Yasmin, 1446. Bloco A\nPorto João do Norte - TO', '97', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(290, 'Fabrício Verdara Montenegro Neto', 'fonseca.raquel@example.com', '(21) 94598-5310', '66625-000', '03780-893, Largo Gil, 6319. Fundos\nSanta Eric - GO', '41', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(291, 'Bárbara Camacho Ramires', 'pvaldez@example.org', '(89) 2535-0360', '66625-000', '61601-828, Avenida Nathalia Balestero, 6. 12º Andar\nVila Lorena do Norte - GO', '100', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(292, 'Marco Gabriel Delgado', 'flavia43@example.org', '(24) 4257-1361', '66625-000', '12485-209, Travessa Amanda, 81424. Bloco A\nVila Marcelo - RN', '54', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(293, 'Lorenzo Rios Ortega', 'wellington.padrao@example.com', '(89) 4956-9673', '66625-000', '37138-281, Travessa Maximiano Soares, 2062\nMendonça do Leste - TO', '80', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(294, 'Mariana Alves', 'luis.pontes@example.net', '(31) 91721-9634', '66625-000', '98320-177, Largo Wellington Montenegro, 540\nVila Maicon do Sul - AL', '45', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(295, 'Sra. Ingrid Paes Salazar', 'dpaz@example.net', '(96) 96643-4436', '66625-000', '01905-717, Av. Fonseca, 8709\nPorto Rodolfo do Leste - GO', '27', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(296, 'Michael Martines Saito Sobrinho', 'julieta.benez@example.org', '(17) 2539-1658', '66625-000', '18364-724, Largo Campos, 31. Apto 098\nDante do Norte - CE', '36', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(297, 'Dr. Adriele Violeta Prado', 'meireles.norma@example.org', '(35) 97890-6848', '66625-000', '00978-232, Largo Daniele, 8734\nSão Jéssica do Leste - RR', '13', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(298, 'Sra. Lorena Correia Serna', 'casanova.ellen@example.com', '(34) 93006-8042', '66625-000', '56441-331, Av. Adriel Santiago, 1461\nGalindo do Leste - BA', '13', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(299, 'Sr. Roberto Vale da Cruz', 'cmarinho@example.com', '(91) 93932-9697', '66625-000', '51218-238, Av. Sofia Godói, 1907. 111º Andar\nPorto Késia - MG', '71', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(300, 'Srta. Natália Estela Ortega Filho', 'mdasilva@example.net', '(68) 93523-3294', '66625-000', '98682-406, Avenida Serna, 59\nValente do Sul - SC', '53', 'Text Text Text Text Text', '2021-03-21 18:38:26', '2021-03-21 18:38:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contract`
--

CREATE TABLE `contract` (
  `id` bigint(20) UNSIGNED NOT NULL,
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

INSERT INTO `contract` (`id`, `seller_id`, `client_id`, `value`, `description`, `type`, `contract_name`, `phone`, `cep`, `address`, `address_number`, `complement`, `generator_structure`, `started_at`, `finished_at`, `created_at`, `updated_at`) VALUES
(1, 1, 143, 22067, 'Aut dicta aut excepturi odit neque. Tenetur harum ut nobis qui. Inventore sequi ex error et. Sunt accusamus repellendus deserunt.', 2, 'Jonas Christopher Valdez Neto da Rosa', '(86) 4469-7378', '66625-000', '44211-010, Travessa Raquel Zaragoça, 378. F\nVila Alan do Leste - PI', '65', 'Text Text Text Text Text', NULL, '2022-08-23 08:32:48', '2022-11-21 08:32:48', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(2, 1, 230, 35963, 'Aut et in officiis est vel. Magnam sed distinctio voluptas quam. Reprehenderit non recusandae et voluptatem.', 2, 'Sra. Lorena Miriam Duarte Pedrosa', '(84) 2783-8012', '66625-000', '96580-243, Av. Bezerra, 95973\nPena do Sul - RN', '33', 'Text Text Text Text Text', NULL, '2020-04-15 00:02:26', '2020-07-14 00:02:26', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(3, 22, 129, 20161, 'Quia harum dolores eaque quisquam quaerat tenetur officia. Adipisci saepe rerum rerum debitis. Enim amet iusto quibusdam. Qui fuga sit debitis.', 1, 'Christian Camilo Pereira Sobrinho Marin', '(19) 99691-7455', '66625-000', '04253-068, R. Amanda Rodrigues, 1330. Bloco B\nPorto Valentina - MT', '45', 'Text Text Text Text Text', 1, '2022-02-12 06:57:19', '2022-05-13 06:57:19', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(4, 16, 242, 32604, 'Eius beatae impedit inventore et ea quo dolores. Nihil quisquam officiis qui et facere voluptatem. Aut porro saepe non quaerat ex aliquid. Vitae eos natus impedit.', 2, 'Heloísa Carrara Duarte', '(67) 91987-1360', '66625-000', '15957-985, Travessa Saito, 1792\nTâmara do Sul - PB', '71', 'Text Text Text Text Text', NULL, '2020-12-21 12:12:40', '2021-03-21 12:12:40', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(5, 22, 237, 75147, 'Debitis unde dolorem ea et doloribus. Architecto aut voluptas placeat rerum. Qui nulla et aut. Praesentium maxime iusto eos sint velit.', 2, 'Dr. Rodrigo Bittencourt Carvalho Filho Cruz', '(69) 2306-1125', '66625-000', '41603-401, Largo Maicon Caldeira, 243\nPorto Sérgio do Norte - PR', '60', 'Text Text Text Text Text', NULL, '2021-06-04 21:47:11', '2021-09-02 21:47:11', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(6, 6, 34, 15905, 'Debitis et excepturi dolores quo nihil hic. In voluptatum tenetur ipsum deleniti minus dolorum autem recusandae. Ipsam cum sed nihil iste. Autem non qui repudiandae eius voluptas possimus molestiae.', 2, 'Sr. Breno George Azevedo Neto Franco', '(31) 3505-2682', '66625-000', '74831-195, Av. Joaquim, 29\nSanta Téo - MS', '96', 'Text Text Text Text Text', NULL, '2020-03-02 08:50:38', '2020-05-31 08:50:38', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(7, 12, 215, 37068, 'Quod voluptatem commodi ut sunt itaque dicta non eveniet. Eum maxime consequatur quos deleniti ut distinctio nobis.', 1, 'Dr. Rodolfo Ferminiano Solano', '(46) 3036-5745', '66625-000', '23901-541, R. Miguel, 9\nRonaldo d\'Oeste - PA', '46', 'Text Text Text Text Text', 4, '2021-05-30 17:17:33', '2021-08-28 17:17:33', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(8, 28, 18, 52302, 'Et quae beatae ea facere. Est ut aliquam nam. Et rem quaerat suscipit neque autem accusantium fugit qui.', 1, 'Paulina Allison Vega Lovato', '(73) 4979-5256', '66625-000', '23762-525, Av. Graziela, 38\nVila Gabrielly do Sul - MA', '89', 'Text Text Text Text Text', 1, '2022-07-25 23:38:01', '2022-10-23 23:38:01', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(9, 22, 1, 33823, 'Eaque eum dolor neque vel ea. Cum fugit assumenda omnis est laudantium aspernatur officia. Cupiditate deserunt ea ut.', 1, 'Srta. Rosana Adriele Carmona Filho Madeira', '(19) 3261-9985', '66625-000', '58084-239, Travessa Laura Marin, 45\nJosé d\'Oeste - ES', '93', 'Text Text Text Text Text', 2, '2022-07-09 18:20:00', '2022-10-07 18:20:00', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(10, 20, 165, 31992, 'Dolores quia reprehenderit maxime ut non qui. Amet rerum id et quae rerum itaque et. Qui sint suscipit minima iste sint.', 1, 'Sra. Rosana Eunice Branco Neto Sandoval', '(69) 2334-3776', '66625-000', '97800-426, R. Laís, 2\nValentina d\'Oeste - DF', '75', 'Text Text Text Text Text', 1, '2021-10-27 10:30:15', '2022-01-25 10:30:15', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(11, 30, 41, 62646, 'Beatae omnis et nihil unde. Est omnis vel autem culpa distinctio non. Ut quo nemo similique est et. Aut expedita occaecati nam sit illum commodi et est.', 2, 'Kelly Souza Valência Ferraz', '(14) 2323-6706', '66625-000', '76159-826, R. Alves, 6949. 95º Andar\nSão Thiago - MA', '47', 'Text Text Text Text Text', NULL, '2020-04-14 07:00:04', '2020-07-13 07:00:04', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(12, 28, 127, 32108, 'Officia natus amet tempore dignissimos enim hic. Voluptates laboriosam provident error reiciendis fugit sint nisi optio.', 1, 'Srta. Mayara Tessália Rezende Cordeiro', '(75) 3772-8153', '66625-000', '22216-899, Avenida Fontes, 4\nSanta Priscila - AL', '86', 'Text Text Text Text Text', 4, '2021-02-25 08:27:30', '2021-05-26 08:27:30', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(13, 8, 287, 41343, 'Distinctio illo quae quas. Illo impedit eum dolorem. Deleniti sapiente pariatur amet non delectus aperiam numquam. Dolore totam iusto officiis eum sit eveniet.', 1, 'Hortência Giovana Bonilha Brito', '(54) 3047-0920', '66625-000', '86493-493, Rua Enzo Galhardo, 35438. Bloco C\nAgatha do Sul - PI', '34', 'Text Text Text Text Text', 3, '2022-01-31 21:17:33', '2022-05-01 21:17:33', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(14, 22, 260, 27499, 'Facilis neque quos aspernatur excepturi voluptatem voluptas. Occaecati et minus sed dignissimos. Dolorum optio quisquam exercitationem et ducimus enim. Odio dolores laudantium necessitatibus facilis.', 2, 'Cláudio Ian Alves Sobrinho Estrada', '(35) 4365-9165', '66625-000', '00350-438, R. Saraiva, 84486. Bc. 39 Ap. 57\nRoque d\'Oeste - AM', '41', 'Text Text Text Text Text', NULL, '2022-09-20 05:19:55', '2022-12-19 05:19:55', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(15, 26, 229, 62300, 'Dolor voluptas ipsa recusandae molestiae qui quia sunt. Qui occaecati voluptatem nihil dolorem sunt.', 2, 'Sr. Inácio Furtado Neto Rosa', '(16) 96483-6583', '66625-000', '44556-295, Largo Márcio, 506. 24º Andar\nChaves do Sul - PB', '91', 'Text Text Text Text Text', NULL, '2021-08-03 03:26:52', '2021-11-01 03:26:52', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(16, 23, 173, 56729, 'Occaecati sed fuga est modi. Sit mollitia necessitatibus rem reiciendis cupiditate. Voluptas eligendi est sequi quis ea incidunt ab.', 2, 'Hortência das Dores Brito da Rosa', '(11) 2265-7281', '66625-000', '24332-121, Av. Walter Marin, 85. Apto 11\nLara do Norte - RO', '28', 'Text Text Text Text Text', NULL, '2020-01-24 01:56:50', '2020-04-23 01:56:50', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(17, 27, 135, 27347, 'Similique et autem quasi at libero tempora. Quibusdam quasi et consequatur omnis. Doloremque ipsum alias nam. Eaque occaecati perspiciatis ut aut.', 1, 'Sra. Mayara Meireles Neto Chaves', '(45) 95993-7077', '66625-000', '10574-837, R. Graziela Zamana, 80142. Bloco B\nRodrigues do Norte - TO', '10', 'Text Text Text Text Text', 1, '2022-05-30 10:07:55', '2022-08-28 10:07:55', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(18, 27, 173, 42392, 'Et ducimus accusantium accusamus dolorum. Occaecati ut id non officiis soluta et aut. Eaque quis nemo dicta sunt repellendus vitae quasi. Placeat quam cum non molestias.', 1, 'Sr. Cristóvão Fabrício Ávila Marés', '(85) 95124-8475', '66625-000', '99919-438, Rua Cláudia, 9080\nSão Raysa d\'Oeste - PI', '53', 'Text Text Text Text Text', 1, '2022-11-25 07:36:55', '2023-02-23 07:36:55', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(19, 30, 219, 44365, 'Non ab dolorem magni modi totam excepturi. Quod et libero sit et corporis possimus qui ex.', 1, 'Dr. Ronaldo Thales Assunção Neto Reis', '(97) 90796-8840', '66625-000', '29037-531, Avenida Suzana, 7\nSuzana d\'Oeste - PA', '88', 'Text Text Text Text Text', 4, '2022-03-30 23:45:55', '2022-06-28 23:45:55', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(20, 14, 192, 75770, 'Ut praesentium ut vel. Quaerat repudiandae omnis sunt modi quos excepturi. Qui ullam dolores et autem blanditiis nostrum aut.', 2, 'Alessandra Padilha Balestero Beltrão', '(11) 2870-8699', '66625-000', '71308-857, Av. Sandro Rivera, 573. 628º Andar\nPorto Deivid do Norte - RJ', '76', 'Text Text Text Text Text', NULL, '2021-11-03 15:33:43', '2022-02-01 15:33:43', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(21, 27, 196, 26401, 'Alias minima voluptatem iste officiis qui aut. Laboriosam quo incidunt consequuntur dolores. Omnis quia sunt necessitatibus et architecto ut odio. Fugit in provident beatae corrupti iure.', 1, 'Aparecida Reis Salgado Rangel', '(37) 3163-7538', '66625-000', '66218-898, R. Quintana, 48. 56º Andar\nMia do Norte - SE', '49', 'Text Text Text Text Text', 4, '2021-12-08 15:46:56', '2022-03-08 15:46:56', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(22, 6, 117, 79993, 'Officia et perspiciatis ipsum sed. Enim et ea facere molestiae sunt suscipit. Corrupti aliquam sequi repellendus molestias quia ut dicta in.', 1, 'Joaquin da Silva Perez', '(13) 2668-5122', '66625-000', '75749-604, R. Santiago, 92. Apto 5320\nPorto Michele - DF', '91', 'Text Text Text Text Text', 2, '2022-11-09 21:29:47', '2023-02-07 21:29:47', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(23, 7, 169, 44583, 'Quis commodi dignissimos ab nisi itaque veritatis nihil. Commodi aut sequi consequuntur omnis. Placeat eum officiis aut facere nihil aut laborum. Reiciendis deserunt dolor ab doloremque et.', 2, 'Sra. Carol Mendes Flores Zambrano', '(55) 97187-2160', '66625-000', '58057-388, Av. Marta Vale, 5. Apto 424\nBeltrão do Leste - AM', '85', 'Text Text Text Text Text', NULL, '2022-02-06 03:22:27', '2022-05-07 03:22:27', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(24, 26, 117, 69256, 'Quod aut optio dolorem quos. Blanditiis dolores delectus voluptate corporis omnis id sed voluptas. Totam et voluptatem pariatur labore.', 2, 'Sr. Fabiano Arthur Deverso Neto Delatorre', '(64) 93877-2850', '66625-000', '44542-946, Travessa Inácio, 3. Apto 0\nPorto Manuel - RR', '48', 'Text Text Text Text Text', NULL, '2020-02-14 12:42:15', '2020-05-14 12:42:15', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(25, 1, 50, 39276, 'Est similique quo vitae quam et necessitatibus quia. Ducimus itaque rerum officiis.', 1, 'Sr. Emílio Marco Santacruz Carrara', '(54) 3744-8232', '66625-000', '95936-104, Avenida Thaís, 3. Apto 6\nSão Naiara - PA', '48', 'Text Text Text Text Text', 1, '2022-09-26 10:08:10', '2022-12-25 10:08:10', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(26, 6, 293, 17158, 'Dolore exercitationem rerum aut a quas. Dolorem temporibus dignissimos saepe eligendi aliquam voluptatem. Nobis voluptatem veniam corrupti omnis. Voluptate et sint sint.', 2, 'Julieta Burgos Beltrão Delgado', '(69) 90457-2998', '66625-000', '90818-030, Largo Leal, 4\nPorto Marisa - AM', '56', 'Text Text Text Text Text', NULL, '2021-10-29 13:32:23', '2022-01-27 13:32:23', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(27, 19, 176, 71407, 'Quia aliquid in dolor vero. Nobis dolorum autem illum eos necessitatibus culpa. Non non alias inventore blanditiis totam officiis asperiores.', 1, 'Dr. Josué Corona Saraiva Soto', '(94) 96332-3472', '66625-000', '63016-820, Rua Ingrid Leon, 7\nSofia do Sul - SP', '61', 'Text Text Text Text Text', 3, '2021-11-03 18:10:30', '2022-02-01 18:10:30', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(28, 24, 51, 36124, 'Et tenetur debitis voluptatem ut officia sint. Ut ut quasi quis vitae ut. Quis eaque incidunt odio ducimus et sit. Sapiente aut a illum et fugiat.', 1, 'Alexandre Gomes Sobrinho Ortega', '(47) 96025-3916', '66625-000', '21445-876, Travessa Mariana, 91. 8º Andar\nVila Bruno do Sul - RS', '33', 'Text Text Text Text Text', 4, '2020-09-08 19:57:49', '2020-12-07 19:57:49', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(29, 15, 162, 16295, 'A magnam accusantium ea aliquam modi nam culpa. Veniam aut rerum dolor consectetur rem ullam sapiente similique. Qui ducimus amet illo quasi saepe. Nostrum non dolore eius molestiae.', 2, 'Dr. Nelson Kauan Toledo Sobrinho Ramires', '(28) 3682-0680', '66625-000', '71059-808, Avenida Patrícia Batista, 9733. Bloco B\nVila Leonardo d\'Oeste - BA', '19', 'Text Text Text Text Text', NULL, '2021-11-15 17:13:54', '2022-02-13 17:13:54', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(30, 10, 189, 63760, 'Consequatur enim soluta culpa quos. Itaque est earum facilis veritatis esse quia. Eveniet aut ullam reiciendis et et qui. Accusantium ea non repellendus accusantium cupiditate labore molestias.', 2, 'Maitê Camila Marques Rico', '(15) 3863-0343', '66625-000', '39553-607, Rua Fernanda, 485. 120º Andar\nAndressa do Leste - AL', '89', 'Text Text Text Text Text', NULL, '2022-05-13 17:55:21', '2022-08-11 17:55:21', '2021-03-21 18:38:27', '2021-03-21 18:38:27');

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
(1, 3, 4, '43', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(2, 3, 1, '3', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(3, 3, 5, '75MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(4, 3, 2, '8', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(5, 3, 8, '1', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(6, 7, 3, '36', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(7, 7, 1, '5', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(8, 7, 5, '25MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(9, 7, 7, '2', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(10, 7, 3, '10', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(11, 8, 6, '23', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(12, 8, 1, '1', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(13, 8, 6, '25MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(14, 8, 2, '10', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(15, 8, 6, '2', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(16, 9, 1, '22', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(17, 9, 1, '5', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(18, 9, 6, '50MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(19, 9, 5, '9', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(20, 9, 6, '2', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(21, 10, 1, '38', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(22, 10, 1, '3', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(23, 10, 6, '100MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(24, 10, 1, '5', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(25, 10, 2, '10', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(26, 12, 5, '48', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(27, 12, 1, '5', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(28, 12, 6, '25MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(29, 12, 2, '4', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(30, 12, 10, '10', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(31, 13, 6, '50', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(32, 13, 1, '2', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(33, 13, 4, '100MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(34, 13, 3, '5', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(35, 13, 6, '10', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(36, 17, 1, '37', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(37, 17, 1, '3', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(38, 17, 7, '100MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(39, 17, 3, '1', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(40, 17, 1, '3', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(41, 18, 3, '50', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(42, 18, 1, '5', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(43, 18, 5, '75MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(44, 18, 5, '1', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(45, 18, 4, '6', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(46, 19, 6, '28', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(47, 19, 1, '4', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(48, 19, 6, '100MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(49, 19, 2, '10', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(50, 19, 7, '5', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(51, 21, 4, '35', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(52, 21, 1, '3', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(53, 21, 3, '25MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(54, 21, 6, '5', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(55, 21, 6, '3', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(56, 22, 5, '27', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(57, 22, 1, '3', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(58, 22, 5, '50MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(59, 22, 5, '7', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(60, 22, 3, '5', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(61, 25, 5, '25', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(62, 25, 1, '4', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(63, 25, 3, '25MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(64, 25, 6, '6', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(65, 25, 3, '9', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(66, 27, 1, '34', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(67, 27, 1, '3', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(68, 27, 3, '75MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(69, 27, 1, '1', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(70, 27, 10, '1', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(71, 28, 6, '34', 'GENERATOR', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(72, 28, 1, '3', 'STRING_BOX', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(73, 28, 5, '75MT', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(74, 28, 1, '10', 'OTHER', '2021-03-21 18:38:27', '2021-03-21 18:38:27'),
(75, 28, 5, '10', 'SOLAR_INVERTER', '2021-03-21 18:38:27', '2021-03-21 18:38:27');

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
(1, 'RS6E-150P', 'Resun', 'Monocristalino', 450, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(2, 'RS6E-150P', 'Resun', 'Policristalino', 150, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(3, 'TSM-PE15H', 'Trina Solar', 'Monocristalino', 405, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(4, 'RS6E-150P', 'Trina Solar', 'Monocristalino', 150, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(5, 'ODA400-36-M', 'OSDA', 'Monocristalino', 400, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(6, 'SA10-36P', 'Sinosola', 'Policristalino', 10, '2021-03-21 18:38:26', '2021-03-21 18:38:26');

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
(1, 'Par de Conectores Femea/Macho Staubli MC4', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(2, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Preto - Multiplo 25 Metros', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(3, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Vermelho - Multiplo 25 Metros', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(4, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Azul - Multiplo 25 Metros', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(5, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Verde - Multiplo 25 Metros', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(6, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Amarelo - Multiplo 25 Metros', '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(7, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Laranja - Multiplo 25 Metros', '2021-03-21 18:38:26', '2021-03-21 18:38:26');

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
(1, 'ABB', 2, 20, 220, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(2, 'ABB', 2, 60, 380, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(3, 'ABB', 4, 50, 220, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(4, 'ABB', 4, 100, 380, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(5, 'Fronius Eco', 2, 25, 220, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(6, 'Fronius SYMO', 2, 12, 220, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(7, 'Fronius SYMO Brasil', 2, 15, 380, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(8, 'WEG SIW600', 4, 25, 380, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(9, 'WEG SMA', 4, 30, 220, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(10, 'WEG SIW500H ST012', 4, 100, 380, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(11, 'WEG SUN 2000–60KTL-MO', 2, 60, 220, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(12, 'WEG SUN 2000–40KTL-MO', 4, 40, 380, '2021-03-21 18:38:26', '2021-03-21 18:38:26');

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
(1, '1000v', 'Ecosolys', '2021-03-21 18:38:26', '2021-03-21 18:38:26');

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
(1, 'Srta. Jéssica Lira Galindo Filho', 'delatorre.eduarda@example.org', '(45) 91323-8109', '66625-000', '03053-200, Av. Bezerra, 8600\nMicaela d\'Oeste - SE', '97', 'Text Text Text Text Text', 6, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(2, 'Sra. Mary Ferraz Galvão Sobrinho', 'mateus20@example.org', '(93) 98337-9333', '66625-000', '57901-053, Rua Verdara, 2782. 65º Andar\nVelasques do Sul - SE', '49', 'Text Text Text Text Text', 11, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(3, 'Sr. Gean Jácomo de Oliveira Filho', 'murias@example.org', '(35) 90742-5633', '66625-000', '34137-348, Travessa Godói, 9. Apto 8947\nGomes d\'Oeste - PB', '21', 'Text Text Text Text Text', 25, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(4, 'Mateus Prado Leal', 'amelia.matos@example.com', '(62) 93443-7300', '66625-000', '88179-784, Largo Laís Barreto, 40251\nVila Lavínia - RO', '81', 'Text Text Text Text Text', 15, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(5, 'Renan Lorenzo Ferraz', 'yfranco@example.net', '(81) 4652-9342', '66625-000', '71527-438, Travessa Maurício das Neves, 2\nSão George do Norte - AM', '21', 'Text Text Text Text Text', 10, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(6, 'Renato Serra Fidalgo Sobrinho', 'jmarinho@example.net', '(17) 99931-8960', '66625-000', '70628-287, Travessa Roberta, 79\nde Freitas d\'Oeste - AM', '64', 'Text Text Text Text Text', 16, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(7, 'Dr. Cristiano Alan Camacho', 'micaela89@example.com', '(44) 91050-1890', '66625-000', '55185-871, Travessa Maurício Rios, 7879\nQuintana do Norte - PA', '22', 'Text Text Text Text Text', 8, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(8, 'Miriam Ferraz Neto', 'carla.camacho@example.org', '(74) 93888-5405', '66625-000', '13170-452, Largo da Silva, 47. Bloco B\nCamilo do Sul - AP', '52', 'Text Text Text Text Text', 23, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(9, 'Lorena Santiago Vila', 'karina76@example.com', '(75) 91918-0317', '66625-000', '10283-407, R. Ortega, 59206\nPorto Raissa - MS', '40', 'Text Text Text Text Text', 3, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(10, 'Noemi Bittencourt Esteves', 'santiago.lucia@example.net', '(46) 99141-1018', '66625-000', '34414-520, Rua Rezende, 348. Apto 7084\nPorto Mel d\'Oeste - MT', '31', 'Text Text Text Text Text', 30, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(11, 'Srta. Lidiane Verdara', 'assuncao.lorena@example.org', '(94) 97947-8223', '66625-000', '77095-730, Travessa Luzia Cruz, 1\nSanta Vinícius - PB', '22', 'Text Text Text Text Text', 3, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(12, 'Poliana Uchoa', 'laura.serra@example.com', '(71) 3997-3544', '66625-000', '48315-909, Rua Faria, 15035. 05º Andar\nVila David - BA', '88', 'Text Text Text Text Text', 1, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(13, 'Srta. Mirela Michelle Ávila', 'rocha.matheus@example.net', '(69) 92368-6345', '66625-000', '44869-167, Largo Augusto de Arruda, 53\nVila Rodolfo - AP', '10', 'Text Text Text Text Text', 7, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(14, 'Dr. Dante Chaves Bittencourt', 'benicio.camacho@example.net', '(86) 3843-2263', '66625-000', '95153-520, Av. da Silva, 63835\nEmílio do Norte - GO', '91', 'Text Text Text Text Text', 18, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(15, 'Diogo Gonçalves Roque', 'lidiane97@example.net', '(97) 95852-8744', '66625-000', '74006-794, R. Betina, 97615\nJosué do Leste - TO', '91', 'Text Text Text Text Text', 18, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(16, 'Srta. Mary Bruna Valentin Neto', 'afonso57@example.com', '(94) 99254-1799', '66625-000', '68257-913, Largo Caio Brito, 5\nPadilha do Sul - AC', '58', 'Text Text Text Text Text', 13, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(17, 'Srta. Melinda Dominato Filho', 'abreu.ricardo@example.org', '(51) 95374-1402', '66625-000', '43170-669, Largo Franco, 9. Bloco A\nSanta Cíntia d\'Oeste - MT', '63', 'Text Text Text Text Text', 19, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(18, 'Sr. Ziraldo Azevedo Filho', 'mauricio29@example.net', '(99) 96078-1784', '66625-000', '34078-161, R. Tatiane Padilha, 719\nSão Juliano - DF', '14', 'Text Text Text Text Text', 24, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(19, 'Srta. Jaqueline Késia Teles Sobrinho', 'montenegro.alice@example.org', '(37) 3569-0333', '66625-000', '03010-829, Av. Anita, 42. Bloco A\nPorto Alma - AC', '93', 'Text Text Text Text Text', 11, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(20, 'Srta. Alícia Ingrid Rios Neto', 'cervantes.abgail@example.com', '(74) 2356-7405', '66625-000', '96444-092, Travessa D\'ávila, 5. 516º Andar\nDiana d\'Oeste - PE', '20', 'Text Text Text Text Text', 23, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(21, 'Dr. Luiz Branco Pacheco Jr.', 'mares.joaquin@example.net', '(98) 94106-5084', '66625-000', '47911-882, Rua Fabrício Arruda, 6. Bloco A\nGalindo do Sul - RN', '26', 'Text Text Text Text Text', 29, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(22, 'Sra. Thalia Aurora Queirós Neto', 'deverso.maraisa@example.org', '(54) 95732-0050', '66625-000', '78194-366, Travessa Kauan, 69693. 3º Andar\nAlves do Norte - DF', '32', 'Text Text Text Text Text', 7, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(23, 'Estela da Rosa', 'lia71@example.net', '(95) 98060-7629', '66625-000', '17817-460, Travessa Azevedo, 1580\nSanta Cezar - MA', '31', 'Text Text Text Text Text', 10, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(24, 'Dr. Otávio Medina Assunção', 'luna31@example.com', '(27) 4516-0724', '66625-000', '18807-948, Largo Luis Bonilha, 523. Apto 703\nVila Alana - MA', '35', 'Text Text Text Text Text', 7, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(25, 'Sra. Lara Benites Ferminiano Filho', 'serna.murilo@example.org', '(85) 3904-3751', '66625-000', '94362-705, Avenida Sabrina, 7998. Bloco A\nRezende d\'Oeste - BA', '67', 'Text Text Text Text Text', 9, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(26, 'Márcia Alcantara', 'esteves.andreia@example.net', '(79) 93497-0417', '66625-000', '15394-185, R. Danielle Mendonça, 88. Bc. 72 Ap. 38\nVerônica do Norte - AM', '84', 'Text Text Text Text Text', 21, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(27, 'Sr. Máximo Cordeiro Sobrinho', 'hortencia.dasneves@example.net', '(19) 92927-1769', '66625-000', '20306-934, Av. Valéria Grego, 49382\nPorto Mirella do Sul - AP', '84', 'Text Text Text Text Text', 30, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(28, 'Bella Ivana Pedrosa Jr.', 'priscila66@example.net', '(49) 2839-2660', '66625-000', '51772-812, R. Andressa, 71. 8º Andar\nSão Horácio do Leste - SC', '54', 'Text Text Text Text Text', 8, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(29, 'Sr. Bernardo Saito Barreto', 'rocha.wellington@example.org', '(24) 3827-6345', '66625-000', '75178-608, Rua Souza, 9347. Apto 65\nJuliano do Leste - BA', '38', 'Text Text Text Text Text', 22, '2021-03-21 18:38:26', '2021-03-21 18:38:26'),
(30, 'Kauan Franco', 'benedito.serra@example.net', '(11) 98545-0292', '66625-000', '91242-045, Largo Kamila Deverso, 995\nVila Robson - RR', '72', 'Text Text Text Text Text', 27, '2021-03-21 18:38:26', '2021-03-21 18:38:26');

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
(1, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Urias Comercial Ltda.'),
(2, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Rodrigues e Pereira e Associados'),
(3, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Colaço e Associados'),
(4, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Zamana e Madeira S.A.'),
(5, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Molina e Rosa'),
(6, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Feliciano e Sandoval'),
(7, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Rios Comercial Ltda.'),
(8, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Galvão Comercial Ltda.'),
(9, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Beltrão-Alves'),
(10, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Galhardo e Benites e Associados'),
(11, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Galvão-Gomes'),
(12, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Campos Ltda.'),
(13, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Fernandes Comercial Ltda.'),
(14, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Lovato S.A.'),
(15, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Bittencourt e Ortega e Associados'),
(16, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Montenegro e Associados'),
(17, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Alves-Pacheco'),
(18, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Arruda e Azevedo S.A.'),
(19, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Gomes Comercial Ltda.'),
(20, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Sales e Maia e Filhos'),
(21, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'das Neves e Vale e Associados'),
(22, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Fidalgo S.A.'),
(23, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Ortega e Associados'),
(24, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Garcia-Reis'),
(25, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Rodrigues e Ortiz'),
(26, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Madeira Comercial Ltda.'),
(27, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Pena e Associados'),
(28, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Marinho Comercial Ltda.'),
(29, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Salgado e D\'ávila Ltda.'),
(30, '2021-03-21 18:38:26', '2021-03-21 18:38:26', 'Velasques e Uchoa e Associados');

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
('EKu9nFeewgJy14ol6JKgHBZTRS7iDlgRh2hDdMeO', 31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWlFDQTVZR1JxWEZubDQ3V2VIT3YyTjJYSks1SWRCN3FWSEdybHhCNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3QvZXJwc3VueWhvdXNlL2NvbnRyYWN0cyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjMxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkOGpNTU01M0o5S1FCY1UwaC54b3kuZTRySDN0Z0tFUWY2UFdFRjdidXRvai96YnVRRWhqNE8iO30=', 1616352326);

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
(1, 'Sra. Diana Naomi Vasques Sobrinho', 0, 'stefany.zambrano@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'SehdA2c3A3', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(2, 'Srta. Regiane Aparecida Galindo Filho', 0, 'uaragao@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '8ksPwQFWCE', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(3, 'Dr. Isaac Simon Bonilha Sobrinho', 0, 'fontes.giovanna@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'Dq4L6qgvN3', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(4, 'Sra. Janaina Souza Valdez', 0, 'maximo.delvalle@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '8pl6KWIEtS', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(5, 'Dr. Rogério Máximo Leal', 0, 'ndelatorre@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'Q3xwcx60xo', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(6, 'Sr. Richard Luciano Saito Sobrinho', 0, 'reis.david@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'WFoldYiT6r', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(7, 'Srta. Clara Silvana Alcantara Filho', 0, 'leon.noel@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '1iEj6NucYO', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(8, 'Dr. Bianca Leon Oliveira Jr.', 0, 'yohanna.avila@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'xZ39lmvyVi', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(9, 'Renan Pontes', 0, 'antonio38@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'wve82N7FGF', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(10, 'Sr. Franco Fontes', 0, 'pmeireles@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'KCSQdwLUjz', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(11, 'Dr. Wesley Marinho Amaral', 0, 'joana54@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'U7PyRWk0pK', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(12, 'Marisa Micaela Sandoval Neto', 0, 'qdeverso@example.org', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'ywCn8A3iuM', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(13, 'Walter Valente', 0, 'pacheco.juan@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '4aSUfYF4o6', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(14, 'Dr. Jorge Michael Neves', 0, 'heloisa71@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'MzjlJpVq3H', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(15, 'Dr. Ricardo Galvão Saito Filho', 0, 'amaral.eloa@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'lIdo0lTy4Y', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(16, 'Henrique Ortega Sobrinho', 0, 'gean45@example.org', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'dwcTaJ0vfG', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(17, 'Sr. Pedro Santiago Faro Sobrinho', 0, 'serrano.nero@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'LDdSg6LRXK', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(18, 'Cristiano Rodrigo Ferraz Sobrinho', 0, 'erik40@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'fCVDXtPbxu', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(19, 'Srta. Norma Marília Esteves', 0, 'colaco.leticia@example.org', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'D1ShCExGl5', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(20, 'Dirce Caroline Reis Sobrinho', 0, 'gil.noemi@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'lBI0r7Wv4U', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(21, 'Edilson Alan Azevedo', 0, 'delatorre.suzana@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'q3W7wZZljt', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(22, 'Edson Cortês Ferreira', 0, 'icaro14@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'J0CjcD5cnO', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(23, 'Sra. Kelly Benites', 0, 'vcarmona@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'W5dW5T9W4H', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(24, 'Dr. Luan Teles de Freitas', 0, 'idelvalle@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'ICp6WMP8fK', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(25, 'Marta Lovato', 0, 'artur.pedrosa@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'Jkoeb0fcdg', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(26, 'Késia Pereira Filho', 0, 'pdesouza@example.org', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'oVpLPbX5bo', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(27, 'Benjamin Ramires Neto', 0, 'lourenco.george@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '75RUBEzkXu', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(28, 'Graziela Isabelly Matos Neto', 0, 'ybenez@example.com', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '71PvZFALHD', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(29, 'Juliane Giovanna Madeira', 0, 'evandro.zaragoca@example.org', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'C3tOAN7Bp8', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(30, 'Sra. Esther Késia Cervantes', 0, 'emanuelly.escobar@example.net', '2021-03-21 18:38:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'OCjKS0uUVB', '2021-03-21 18:38:24', '2021-03-21 18:38:24', 2),
(31, 'User Admin', 1, 'admin@admin.com', '2021-03-21 18:38:26', '$2y$10$8jMMM53J9KQBcU0h.xoy.e4rH3tgKEQf6PWEF7butoj/zbuQEhj4O', NULL, NULL, '0', '2021-03-21 18:38:26', '2021-03-21 18:38:26', 1);

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
(1, 'ADMINISTRADOR', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(2, 'ENGENHARIA', '2021-03-21 18:38:24', '2021-03-21 18:38:24'),
(3, 'OPERACIONAL', '2021-03-21 18:38:24', '2021-03-21 18:38:24');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `contract_product`
--
ALTER TABLE `contract_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
