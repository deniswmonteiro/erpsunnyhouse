-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Mar-2021 às 02:25
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
(1, 'Bruna Ferraz Aranda', 'lourenco.hosana@example.net', '(97) 96233-5917', '66625-000', '20839-521, R. Carla, 854\nSão Christian do Sul - AP', '61', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(2, 'Hosana Juliana Dias', 'stephany28@example.com', '(99) 4052-2134', '66625-000', '37549-939, Largo Giovanna, 37405. F\nSanta Vicente - PR', '74', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(3, 'Dr. Mayara Jimenes', 'amanda72@example.org', '(18) 3417-8321', '66625-000', '72134-917, Largo Delvalle, 8\nLilian do Sul - DF', '58', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(4, 'Dr. Stephany de Oliveira Filho', 'romero.matias@example.com', '(95) 91958-1259', '66625-000', '69615-236, Avenida Alessandra Molina, 66\nMari do Leste - ES', '72', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(5, 'Srta. Renata Leal Cortês', 'saito.miranda@example.com', '(11) 99863-0873', '66625-000', '84425-094, Av. Josué, 9825. Anexo\nVila Nelson do Leste - RO', '45', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(6, 'Raissa Antonieta Gonçalves', 'ester77@example.org', '(82) 93775-2051', '66625-000', '47736-053, Largo Gean, 44164. Apto 08\nRamires do Leste - GO', '67', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(7, 'Marisa Aguiar', 'maximiano.pacheco@example.net', '(34) 94839-9280', '66625-000', '32047-007, Largo Elaine, 959\nSanta Liz do Sul - RR', '38', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(8, 'Sra. Bella Padilha Casanova Sobrinho', 'furtado.debora@example.org', '(45) 94411-9940', '66625-000', '86722-037, Travessa Barros, 420. 1º Andar\nMelinda do Leste - RR', '23', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(9, 'Irene da Silva das Neves Sobrinho', 'melina.camacho@example.com', '(83) 99987-6071', '66625-000', '94667-796, Rua Rosa, 63\nVila Nádia do Sul - PR', '52', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(10, 'Dr. Malena Balestero Marés Sobrinho', 'fdelgado@example.com', '(69) 94558-3657', '66625-000', '71345-042, Av. Samuel, 5\nSão Danilo do Norte - TO', '56', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(11, 'Sr. Fernando Murilo Valentin', 'perez.nathalia@example.com', '(34) 99102-7079', '66625-000', '37919-188, Av. Cervantes, 14168. Bloco C\nSanta Aline - AP', '76', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(12, 'Srta. Agatha Amaral Filho', 'richard66@example.org', '(92) 2190-7804', '66625-000', '67943-253, Largo Pietra, 11448. 323º Andar\nVila Emerson do Sul - AP', '93', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(13, 'Jonas Fidalgo', 'vieira.santiago@example.net', '(77) 96676-0484', '66625-000', '85281-405, Travessa Sarah Solano, 73. Bc. 29 Ap. 07\nKarine d\'Oeste - MG', '58', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(14, 'Sra. Marina Giovana Ramires', 'sdominato@example.org', '(85) 91345-0277', '66625-000', '06794-167, Travessa Azevedo, 3. Anexo\nPorto Rosana - MG', '51', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(15, 'Sr. Denis Santana', 'vieira.angelica@example.net', '(47) 91862-4135', '66625-000', '72227-031, Avenida Faria, 90. Apto 728\nPorto Mário - ES', '82', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(16, 'Thaís Alcantara Ferreira Neto', 'william.alcantara@example.com', '(71) 3335-4463', '66625-000', '09569-417, Avenida Gael Barreto, 47\nCésar do Norte - PB', '36', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(17, 'Sr. Josué Flores Sobrinho', 'neves.manuel@example.org', '(77) 90991-9135', '66625-000', '16061-323, Rua Balestero, 4555. F\nSanta Aaron d\'Oeste - AC', '61', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(18, 'Srta. Cristina Salgado', 'sandra81@example.com', '(65) 99130-0871', '66625-000', '75042-948, Largo Reinaldo Amaral, 7866. F\nQuintana do Sul - GO', '34', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(19, 'Joaquim Tomás Queirós Jr.', 'madeira.allan@example.org', '(21) 4686-9412', '66625-000', '54365-066, Rua Luciano Maia, 44918\nVila Wellington - PI', '16', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(20, 'Dr. Luiza Padilha Jr.', 'saito.caio@example.net', '(61) 4162-7266', '66625-000', '97500-138, R. Antônio, 6. Anexo\nMiranda d\'Oeste - MG', '39', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(21, 'Filipe Campos Chaves Filho', 'xsoto@example.com', '(12) 99830-6418', '66625-000', '89965-540, R. Luciano, 50304. Anexo\nBenez do Sul - RN', '62', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(22, 'Larissa Ingrid Marques', 'dante59@example.com', '(93) 3050-8745', '66625-000', '05765-699, Travessa Joyce, 89029. 69º Andar\nOrtega do Leste - SE', '84', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(23, 'Sra. Antonieta Camacho Bonilha', 'breno.alves@example.com', '(82) 4633-7995', '66625-000', '73220-252, Largo Juan, 6274\nPorto Henrique - MT', '74', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(24, 'Dr. Sarah Cruz Batista Jr.', 'teo.duarte@example.com', '(65) 4482-3803', '66625-000', '74577-692, R. Bruno Cordeiro, 9. 0º Andar\nVila Rafaela d\'Oeste - RO', '96', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(25, 'Taís Andréa Cortês Filho', 'maximo.solano@example.com', '(15) 4310-5708', '66625-000', '84437-867, R. Caldeira, 525\nSaraiva do Norte - AL', '94', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(26, 'Nero Delgado', 'mares.amanda@example.org', '(44) 95284-0596', '66625-000', '26484-229, Av. Medina, 1450. Bloco C\nVila Wesley - RS', '52', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(27, 'Noel Lovato Godói Jr.', 'bittencourt.denise@example.org', '(88) 97472-9021', '66625-000', '39246-533, Rua Tiago, 3. Bloco B\nSão Gean do Leste - TO', '50', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(28, 'Emilly Montenegro', 'cauan71@example.net', '(73) 91006-5539', '66625-000', '31612-095, Largo Filipe, 787. Bloco C\nVila Naiara do Norte - AL', '34', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(29, 'Sr. Joaquim Branco Brito', 'qperez@example.org', '(71) 97233-4779', '66625-000', '59847-551, Rua Mendonça, 34092. Bloco A\nPorto Eloah d\'Oeste - AP', '24', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(30, 'Dr. Cezar Souza Neto', 'matias.emilio@example.org', '(98) 3875-1393', '66625-000', '79182-017, Travessa Vicente Ferreira, 861. Bloco A\nPorto Luara - MG', '27', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(31, 'Dr. Nádia Oliveira Neto', 'allan.madeira@example.com', '(28) 99120-6241', '66625-000', '54340-452, Largo David Camacho, 16\nFranco d\'Oeste - PR', '54', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(32, 'Sandra Perez Paz Filho', 'thalia56@example.org', '(34) 4958-3683', '66625-000', '98563-148, Rua Franco, 67. Apto 709\nVila Tatiane do Leste - CE', '71', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(33, 'Isabelly Rios Sobrinho', 'serrano.gabriel@example.org', '(54) 2205-3603', '66625-000', '50433-348, Avenida de Souza, 72999. Bloco A\nSanta Ivan - SC', '99', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(34, 'Estela Viviane Sepúlveda', 'luara.padrao@example.org', '(34) 90408-2963', '66625-000', '60296-677, Largo Olga Aranda, 2049. 950º Andar\nSanta Alma do Leste - TO', '27', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(35, 'Regina Montenegro', 'hernani14@example.com', '(18) 3463-4100', '66625-000', '31366-349, Av. Marcelo Lutero, 40. Bc. 34 Ap. 20\nSanta César - PR', '53', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(36, 'Dr. Guilherme Dante Saito Neto', 'igor.casanova@example.com', '(51) 3101-2772', '66625-000', '20599-603, Largo Aparecida, 102. Apto 8\nVila Alonso - RN', '81', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(37, 'Srta. Lívia Cíntia Sales Filho', 'xlozano@example.net', '(61) 92805-7324', '66625-000', '59039-115, Avenida Luciano Marin, 7835\nSanta Isaac - SE', '80', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(38, 'Srta. Paloma Gisela Meireles Jr.', 'roque.thalia@example.org', '(46) 2034-1306', '66625-000', '70102-784, R. Erik Barreto, 71757\nPorto Raphael do Leste - PE', '97', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(39, 'Dr. Isaac da Cruz Burgos Neto', 'defreitas.priscila@example.org', '(66) 96990-3493', '66625-000', '04690-202, Largo Correia, 57928\nPorto Marta do Norte - MT', '67', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(40, 'Edilson Diego Aragão', 'uqueiros@example.org', '(54) 96805-7582', '66625-000', '64143-669, Avenida Hugo Gonçalves, 9. Anexo\nPorto Vitor do Leste - PR', '55', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(41, 'Srta. Roberta Galvão', 'zamana.irene@example.net', '(81) 2512-8541', '66625-000', '85415-915, Rua Igor Esteves, 4. Bc. 2 Ap. 92\nAparecida do Sul - RJ', '36', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(42, 'Sra. Catarina Soares', 'tabata.medina@example.org', '(54) 2777-9323', '66625-000', '77767-161, Av. Diogo, 8805. Bloco B\nVila Thiago do Leste - PE', '82', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(43, 'Dr. Robson Tomás Lourenço', 'gomes.lia@example.com', '(31) 95287-9350', '66625-000', '99415-498, Avenida Samanta, 7\nPorto Emanuel d\'Oeste - AM', '41', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(44, 'Michelle Ramos Neto', 'espinoza.valentin@example.net', '(21) 4321-8185', '66625-000', '76704-373, Rua Zamana, 8. Bloco C\nD\'ávila do Norte - MA', '21', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(45, 'Denis Aragão Sobrinho', 'udearruda@example.com', '(95) 91310-1760', '66625-000', '90264-979, Av. Garcia, 842. Bloco A\nRocha do Sul - MA', '80', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(46, 'Dr. Betina Balestero Tamoio Sobrinho', 'jorge94@example.net', '(88) 4211-6258', '66625-000', '82818-320, R. Thiago Soares, 4680\nSão Juliane do Leste - AM', '62', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(47, 'Sra. Mônica de Arruda', 'jonas84@example.net', '(38) 4825-1220', '66625-000', '26031-709, Av. Bittencourt, 18. Bloco C\nMartinho do Leste - ES', '78', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(48, 'Sr. Luis da Silva Pacheco', 'urias.noel@example.com', '(17) 3040-0152', '66625-000', '60006-799, Av. Galvão, 958\nSolano do Sul - TO', '52', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(49, 'Sra. Nicole Maldonado Filho', 'wagner.lourenco@example.org', '(68) 95988-8964', '66625-000', '95389-973, Avenida Juan, 78712\nVila Franciele - PA', '91', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(50, 'Sandro Franco Sobrinho', 'tiago27@example.org', '(35) 2503-8937', '66625-000', '87709-015, Largo Diana, 33413\nBittencourt do Leste - DF', '65', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(51, 'Sr. Ian Ramos Urias', 'lidiane86@example.org', '(21) 95326-4682', '66625-000', '11984-607, Largo Vitor Benites, 15138. Bloco A\nPereira d\'Oeste - AP', '43', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(52, 'Dayane Galvão Azevedo Filho', 'xfranco@example.org', '(54) 2855-2502', '66625-000', '88185-944, Avenida Katherine, 5. F\nRogério do Sul - AC', '94', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(53, 'Srta. Dayane Abgail Valente Sobrinho', 'silvana.ferreira@example.com', '(16) 3961-0616', '66625-000', '18558-012, Rua Samara, 38. Bloco C\nMirela d\'Oeste - RO', '24', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(54, 'Srta. Ivana Santos Neto', 'romero.andre@example.org', '(13) 4415-9216', '66625-000', '12815-259, Av. Simão Gonçalves, 456\nSão Everton - GO', '76', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(55, 'Emanuel Batista de Aguiar', 'santiago.marisa@example.net', '(62) 4808-2502', '66625-000', '90465-496, Travessa Camilo Pereira, 1317. Bloco C\nCezar do Norte - MT', '53', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(56, 'Sr. Emiliano Casanova Matos Filho', 'padrao.luisa@example.net', '(91) 91471-5661', '66625-000', '07157-094, Rua Edson, 18\nSão Agatha - ES', '83', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(57, 'Bárbara Medina', 'stephany14@example.org', '(47) 2726-3981', '66625-000', '28227-650, Av. Estrada, 5987. Bc. 4 Ap. 99\nSão Miguel do Sul - AL', '29', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(58, 'Emiliano Quintana Medina Filho', 'bleal@example.org', '(88) 2144-6202', '66625-000', '94757-078, Largo Alexandre, 79065\nPereira do Leste - PA', '21', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(59, 'Sr. Kevin Wilson Batista', 'gabriela.ortiz@example.com', '(11) 4997-5754', '66625-000', '20997-322, Avenida Rivera, 147. Anexo\nSão Sônia - DF', '82', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(60, 'Ruth Noelí Molina', 'miguel.rosa@example.net', '(54) 2365-5288', '66625-000', '75958-774, Rua de Oliveira, 9. Fundos\nPorto Miranda - BA', '16', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(61, 'Dr. Filipe Martines Cordeiro', 'ester.fidalgo@example.net', '(65) 91672-2918', '66625-000', '88599-999, Av. Aranda, 721\nMaiara d\'Oeste - DF', '39', 'Text Text Text Text Text', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(62, 'Stefany Rios', 'inacio74@example.org', '(95) 92482-2122', '66625-000', '31237-330, R. Ruth, 7\nVila Regina - MS', '77', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(63, 'Dr. Carlos Vega Leal', 'ziraldo.lutero@example.com', '(85) 94682-1003', '66625-000', '26545-587, Avenida Zaragoça, 33. Bloco A\nSouza do Sul - RO', '97', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(64, 'Dr. Ronaldo Zamana Correia', 'alonso.rangel@example.net', '(37) 93419-9864', '66625-000', '23170-143, Largo Marin, 434\nVila Isabel - AM', '79', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(65, 'Sr. Leonardo Rodrigues', 'mascarenhas.kevin@example.com', '(69) 4863-2457', '66625-000', '17845-448, Av. Joana Ortega, 23\nSanta Karen - ES', '21', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(66, 'Dr. Milena Eloá Paes', 'zbatista@example.net', '(82) 96131-1298', '66625-000', '31875-392, Largo Cristiano Bonilha, 46884. 523º Andar\nSão Fátima - MA', '59', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(67, 'Sra. Alana Domingues Padilha', 'lidiane85@example.com', '(27) 97837-9700', '66625-000', '82893-492, Av. Sheila Matos, 85190. 8º Andar\nSão Heitor do Sul - ES', '19', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(68, 'Carol Diana Carvalho Filho', 'nicole21@example.net', '(31) 95152-4209', '66625-000', '65601-582, Avenida da Rosa, 29\nSão Thalissa - MS', '86', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(69, 'Srta. Gabi Galvão Saraiva', 'lia.leon@example.com', '(85) 3411-0573', '66625-000', '43228-436, Travessa Giovane, 118\nPorto Leo d\'Oeste - SC', '18', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(70, 'Dr. Yuri Arruda Molina', 'luzia88@example.net', '(12) 98102-4530', '66625-000', '82537-532, Av. Zamana, 29224. 68º Andar\nPorto Igor - MG', '84', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(71, 'Dr. Júlia Escobar Aguiar', 'pcarvalho@example.net', '(65) 96693-0644', '66625-000', '91848-521, Largo Deverso, 492. Fundos\nSanta Eduardo do Leste - SE', '81', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(72, 'Mari Cordeiro', 'benjamin.espinoza@example.com', '(99) 99071-3227', '66625-000', '03152-220, Avenida Wesley Marques, 822\nPorto Stefany - AL', '30', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(73, 'Bruno Anderson Carmona Sobrinho', 'thomas.cervantes@example.com', '(43) 90761-5941', '66625-000', '61402-733, Rua Marcos, 325. Bloco A\nAdriano do Leste - CE', '54', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(74, 'Srta. Betina Isabella Caldeira', 'alcantara.antonieta@example.com', '(81) 3432-9302', '66625-000', '01552-744, Rua Rebeca, 94. Anexo\nVila Heloise - AP', '80', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(75, 'Daniella Maldonado', 'julio24@example.com', '(19) 90280-0311', '66625-000', '32100-687, Avenida Elisa Roque, 21239\nMaraisa do Norte - PB', '74', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(76, 'Fernanda Stephanie Campos', 'camaral@example.org', '(67) 93800-8468', '66625-000', '39918-367, R. Nathalia Carmona, 190\nDeverso do Leste - RJ', '20', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(77, 'Dr. Joaquin Maximiano Salas Sobrinho', 'renato17@example.org', '(19) 95108-9836', '66625-000', '22777-290, Travessa Bruno Arruda, 310\nSão Fernanda do Leste - GO', '71', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(78, 'Dr. Poliana Bianca Santacruz Filho', 'cervantes.fernando@example.org', '(63) 2001-9618', '66625-000', '14687-401, Largo Fabiano, 2028. Bc. 19 Ap. 62\nVila Bruna d\'Oeste - ES', '36', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(79, 'Michelle Melissa Velasques Neto', 'gsantacruz@example.com', '(12) 4972-7361', '66625-000', '71576-442, Travessa Azevedo, 9. Anexo\nRivera do Leste - SE', '62', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(80, 'Sra. Nathalia Maldonado', 'andrea99@example.com', '(55) 97020-2570', '66625-000', '83427-596, Rua Miriam Brito, 73371\nNoemi do Leste - AL', '24', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(81, 'Aaron Emanuel Fernandes', 'aranda.miguel@example.org', '(38) 93414-5102', '66625-000', '51245-352, Avenida Toledo, 309. 27º Andar\nde Freitas do Norte - AM', '84', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(82, 'Sr. Alessandro Santos Ramos Neto', 'zramires@example.com', '(17) 94322-4267', '66625-000', '58504-524, Rua Luciana Duarte, 32. Anexo\nCorreia d\'Oeste - ES', '64', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(83, 'Srta. Naomi Vega', 'carmona.cauan@example.com', '(48) 98637-9804', '66625-000', '85835-165, Largo Helena, 79588\nSergio do Leste - MG', '42', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(84, 'Fernanda Estrada', 'uchoa.pablo@example.com', '(21) 98234-4733', '66625-000', '34394-202, Largo Santos, 54811. Apto 93\nRios d\'Oeste - SC', '47', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(85, 'Srta. Emily Stella Gusmão Sobrinho', 'duarte.jaqueline@example.org', '(68) 92665-2828', '66625-000', '19532-415, Avenida Márcio, 6\nVicente d\'Oeste - AC', '91', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(86, 'Sra. Aurora Arruda Filho', 'pedrosa.pietra@example.org', '(83) 98402-7229', '66625-000', '26381-883, R. Dayana, 8\nPorto Talita do Leste - SE', '67', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(87, 'Caroline Chaves Jr.', 'otavio.prado@example.org', '(31) 3175-2966', '66625-000', '21173-525, Avenida Ramires, 5569\nSão Aparecida do Norte - SP', '91', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(88, 'Milena Valência Jr.', 'benicio.molina@example.com', '(42) 92559-5138', '66625-000', '56047-607, R. Isaac, 955\nSanta Samuel do Norte - BA', '59', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(89, 'Clara Giovana Aragão Jr.', 'ndasneves@example.com', '(32) 98020-9702', '66625-000', '75496-179, Travessa Christian Valentin, 20603\nSão Jennifer - MA', '23', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(90, 'Caio Gilberto Marin Filho', 'yaguiar@example.com', '(11) 91742-0857', '66625-000', '71965-617, Travessa Augusto Salas, 18851\nSão Melissa - SP', '33', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(91, 'Dr. Paula Poliana Franco Neto', 'xlutero@example.net', '(43) 3146-3826', '66625-000', '67007-220, R. Francisco, 5383\nWalter d\'Oeste - RJ', '85', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(92, 'Noelí Cordeiro Valentin Filho', 'ramires.vitoria@example.org', '(12) 3867-8275', '66625-000', '89803-399, Rua James, 3039\nEdson do Sul - RJ', '82', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(93, 'Dr. Noelí Benites', 'mgalindo@example.net', '(31) 2305-7168', '66625-000', '23713-464, R. Paola Leon, 6\nPorto Rebeca - PB', '52', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(94, 'Sr. Yuri Ortega Brito Neto', 'luzia.zaragoca@example.org', '(82) 90721-6221', '66625-000', '40958-883, R. Augusto Carmona, 83. Bloco C\nGalvão do Sul - MA', '10', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(95, 'Jácomo Robson Pereira', 'dbonilha@example.com', '(96) 4534-5175', '66625-000', '50002-649, Travessa Zamana, 8. F\nFaro do Sul - RJ', '32', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(96, 'Dr. Noel Kauan Torres', 'victor66@example.org', '(15) 96463-6861', '66625-000', '82754-535, Avenida Branco, 1002\nRayane do Leste - RN', '25', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(97, 'Srta. Adriele Tamoio Vila Jr.', 'tatiane.solano@example.net', '(85) 4646-0094', '66625-000', '84193-668, Avenida Noel, 32\nSanta Heloísa d\'Oeste - AP', '11', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(98, 'Dr. Agustina Léia Soto Filho', 'danielle.aragao@example.org', '(41) 90764-2428', '66625-000', '21436-320, Travessa Bruno, 1\nMauro do Norte - SP', '91', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(99, 'Paola Colaço Neto', 'regina26@example.net', '(65) 92668-5145', '66625-000', '85612-676, R. Inácio, 2. Bloco C\nCampos do Sul - DF', '78', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(100, 'Richard Inácio Salas Filho', 'samara13@example.net', '(34) 90584-5102', '66625-000', '08193-770, R. Josué, 7808\nPacheco d\'Oeste - CE', '100', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(101, 'Sr. Mário Hugo Sanches Filho', 'camila10@example.com', '(22) 2236-6699', '66625-000', '37099-393, Av. Jasmin Ferminiano, 40\nSão Hortência do Norte - AP', '92', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(102, 'Carla Marin', 'sheila.queiros@example.net', '(27) 94723-7401', '66625-000', '38586-240, R. Karen, 581\nVila Otávio - PR', '32', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(103, 'Sueli Lorena Garcia', 'fabricio31@example.org', '(93) 98865-4589', '66625-000', '22480-069, Rua Luna Mendonça, 6542. Bc. 9 Ap. 85\nPaz do Norte - MS', '53', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(104, 'Lia Delgado Neto', 'jimenes.jorge@example.org', '(68) 97533-3886', '66625-000', '01072-354, Largo Serna, 5\nSolano do Sul - RR', '32', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(105, 'Cristiana Verdara Salazar', 'amelia18@example.net', '(89) 3184-8061', '66625-000', '96950-461, Largo Vitor Zambrano, 7. Fundos\nVila Vanessa - PA', '34', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(106, 'Sophia Galhardo Zaragoça Jr.', 'cleber72@example.net', '(79) 91703-3694', '66625-000', '17937-210, Avenida Silvana, 9. Apto 383\nPorto Viviane - PB', '33', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(107, 'Dr. Joaquin Alcantara', 'leo76@example.org', '(65) 4454-5171', '66625-000', '29739-189, Travessa Victor Urias, 2061\nCampos d\'Oeste - DF', '88', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(108, 'Dr. Fabrício das Neves Filho', 'samuel.vieira@example.net', '(71) 99488-9587', '66625-000', '30816-740, R. Enzo, 6\nPorto Simão do Leste - DF', '25', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(109, 'Cléber Ziraldo Leal Sobrinho', 'cavila@example.org', '(99) 4273-3823', '66625-000', '19067-738, Travessa Cléber Ferreira, 934. Bc. 2 Ap. 46\nAntonella do Leste - MT', '61', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(110, 'Sr. Felipe Ricardo Salgado Neto', 'icaro.torres@example.org', '(13) 2531-0436', '66625-000', '13202-539, Avenida Lucio Cruz, 77\nSanta Edilson d\'Oeste - PA', '52', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(111, 'Michael de Souza Filho', 'fpadilha@example.org', '(12) 2321-3537', '66625-000', '25368-924, Rua Madalena, 525. Bloco A\nSão Moisés do Leste - MG', '81', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(112, 'Cláudia Késia Salas', 'renan83@example.org', '(93) 3627-8861', '66625-000', '85702-801, R. Estrada, 10100\nVila Adriano - SE', '35', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(113, 'Mateus Alessandro Rangel', 'hortencia.carvalho@example.org', '(87) 95034-9402', '66625-000', '04242-493, Av. Faria, 63456\nAntônio d\'Oeste - CE', '74', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(114, 'Sra. Ingrid Raissa Vila', 'theo.oliveira@example.net', '(32) 95925-2566', '66625-000', '71701-475, Avenida Gabriel, 8\nAugusto d\'Oeste - ES', '42', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(115, 'Dr. César Dener Deverso Jr.', 'isabel00@example.net', '(96) 91235-3860', '66625-000', '02069-915, R. Patrícia, 4438\nSanta Miguel - SP', '98', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(116, 'Maicon Barros Benites', 'luis.dominato@example.com', '(12) 2736-1033', '66625-000', '36430-053, R. Vega, 32398. Apto 0\nPorto Poliana - RN', '82', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(117, 'Kauan Matias Beltrão Filho', 'btamoio@example.org', '(49) 2261-6014', '66625-000', '30059-276, Avenida Cervantes, 7. Apto 6952\nSalgado do Norte - MT', '57', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(118, 'Luciana Uchoa', 'santacruz.joyce@example.org', '(21) 91278-7223', '66625-000', '99585-733, R. Tatiane Paz, 8863. Apto 324\nSalazar d\'Oeste - DF', '55', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(119, 'Dr. Ícaro William Pena', 'ldearruda@example.org', '(95) 90426-4272', '66625-000', '24098-386, Av. Alma Queirós, 91. Fundos\nSão Alessandra - RR', '77', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(120, 'Isis Rivera', 'souza.suellen@example.org', '(13) 4597-6552', '66625-000', '41750-885, Travessa Santiago, 2328. Bc. 58 Ap. 89\nSanta Lidiane - MS', '86', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(121, 'Adriel Dias Marés Sobrinho', 'fserrano@example.com', '(99) 4483-7803', '66625-000', '93883-390, Av. Vieira, 213. 028º Andar\nVila Stella d\'Oeste - PA', '42', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(122, 'Dr. Maraisa Hortência Batista', 'bsoares@example.com', '(48) 92457-4147', '66625-000', '56958-195, Rua Estêvão, 4. Anexo\nSimone d\'Oeste - RJ', '29', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(123, 'Sr. Guilherme Montenegro Jimenes Jr.', 'ornela.santacruz@example.com', '(34) 95466-7650', '66625-000', '04158-890, Rua Romero, 27. Bc. 51 Ap. 48\nChristian d\'Oeste - AL', '31', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(124, 'Vitor Sepúlveda das Neves Neto', 'denise42@example.org', '(38) 99619-5619', '66625-000', '63539-782, Rua Aline Delgado, 70. Apto 6\nVila Liz - AL', '57', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(125, 'Sra. Suelen Godói', 'pontes.henrique@example.net', '(68) 99729-0096', '66625-000', '73505-236, Avenida Adriele, 87\nSão Júlio - RO', '46', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(126, 'Sr. Flávio Flores Filho', 'branco.jonas@example.com', '(61) 96103-6285', '66625-000', '60984-501, Rua Manuela Sanches, 53. Apto 1223\nReis do Leste - MA', '21', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(127, 'Flávia Abgail Rivera Neto', 'cezar.camacho@example.org', '(22) 4133-6664', '66625-000', '69289-429, Rua Aragão, 99315\nBreno d\'Oeste - PI', '51', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(128, 'Sra. Katherine Quintana', 'serna.thomas@example.net', '(98) 99095-3783', '66625-000', '48525-049, Largo Micaela Franco, 29217\nVieira do Sul - GO', '37', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(129, 'Pablo Jácomo Branco', 'vasques.bianca@example.com', '(22) 2487-2679', '66625-000', '29337-934, Avenida Ferraz, 967. 2º Andar\nSão Samuel - AP', '99', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(130, 'Sra. Verônica Estrada Pena Filho', 'zcortes@example.net', '(32) 97244-7850', '66625-000', '09367-510, Largo Rayane, 26935. Apto 45\nSantos d\'Oeste - AM', '25', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(131, 'Téo Matias', 'naiara04@example.org', '(81) 94590-8366', '66625-000', '45415-844, Travessa Elis Verdugo, 16\nAdriana do Sul - CE', '21', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(132, 'Alexandre Vega', 'renato44@example.org', '(75) 93110-9586', '66625-000', '66443-076, Avenida Jimenes, 25930. Anexo\nVila Henrique - ES', '32', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(133, 'Srta. Noemi Giovanna de Arruda', 'delgado.renato@example.org', '(88) 3523-3207', '66625-000', '53567-661, R. Dener, 91\nVila Nelson - PA', '89', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(134, 'Daiana Cristiana Serna', 'valencia.sophie@example.net', '(93) 3018-8464', '66625-000', '08957-281, Largo Máximo de Oliveira, 750. Apto 3\nDemian d\'Oeste - PB', '88', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(135, 'Dr. Fernanda Sandoval', 'pcolaco@example.org', '(87) 96386-5130', '66625-000', '12524-443, Av. Ícaro, 666. 546º Andar\nPorto Bella - RN', '68', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(136, 'Dr. Lara Batista Pacheco Filho', 'clarice49@example.com', '(34) 97250-8287', '66625-000', '88241-683, Av. Antônio Godói, 7520\nPorto Jerônimo do Sul - PI', '97', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(137, 'Everton Camilo Marin', 'feliciano.perola@example.com', '(53) 3856-8494', '66625-000', '26612-687, R. Nicole, 2173\nSoares do Sul - TO', '93', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(138, 'Mari Aguiar Assunção', 'miguel.marques@example.org', '(47) 96148-1028', '66625-000', '55119-088, R. Corona, 8\nSanta Willian - SC', '38', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(139, 'Thalia Rangel Jr.', 'aline.rangel@example.net', '(45) 98807-4124', '66625-000', '32204-429, Avenida Violeta Rivera, 556\nEdson d\'Oeste - PI', '89', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(140, 'Daiane Escobar Leal', 'eloa.toledo@example.org', '(37) 3494-3565', '66625-000', '59715-914, Rua Faro, 25. Bloco B\nGalhardo do Leste - PE', '58', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(141, 'Dr. Tâmara Gusmão Neto', 'agomes@example.org', '(74) 99740-3850', '66625-000', '46734-774, Largo Cristóvão da Silva, 79803\nCarvalho do Norte - MT', '63', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(142, 'Gian das Dores Toledo Filho', 'padilha.josue@example.org', '(41) 4102-9538', '66625-000', '70098-062, R. Luciano Ramos, 93. Apto 9613\nVasques do Leste - BA', '20', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(143, 'Ingrid Padrão Filho', 'lozano.erik@example.com', '(41) 2709-5279', '66625-000', '26979-275, Av. Cléber, 8115\nPorto Maísa - DF', '81', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(144, 'Srta. Andréia Márcia Espinoza', 'stephany40@example.net', '(35) 99026-9617', '66625-000', '93178-017, Rua Galindo, 34671. Bloco C\nMauro do Sul - RN', '96', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(145, 'Sra. Ivana Michele Ferreira', 'zurias@example.com', '(94) 3314-1019', '66625-000', '05117-328, Rua Joaquim Batista, 44. Bloco A\nNaiara d\'Oeste - RS', '20', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(146, 'Dr. Suellen Galhardo', 'cuchoa@example.org', '(61) 3952-1907', '66625-000', '49769-984, Rua Quintana, 42. 348º Andar\nOliveira do Sul - PA', '100', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(147, 'Sr. Michael Soto', 'daniel72@example.net', '(12) 3563-3568', '66625-000', '70946-507, Av. Daniella, 6296. Bloco C\nVila Carolina do Leste - AL', '56', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(148, 'Antonella Isabelly da Silva', 'salazar.betina@example.org', '(65) 92755-7982', '66625-000', '94138-679, Rua Kauan Furtado, 52. Bloco B\nEdilson d\'Oeste - AL', '59', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(149, 'Suzana Queirós Gonçalves Sobrinho', 'srico@example.org', '(67) 2978-4042', '66625-000', '95208-434, Travessa Verdara, 123. Bc. 9 Ap. 94\nSanta Augusto - BA', '72', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(150, 'Srta. Emanuelly Ferreira', 'valencia.francisco@example.com', '(93) 91589-9250', '66625-000', '20416-273, Av. David, 4784\nRuth do Sul - RR', '46', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(151, 'Dr. Vinícius Eric D\'ávila Jr.', 'artur.lovato@example.com', '(97) 4812-5884', '66625-000', '32526-978, Rua Medina, 37153. Bloco C\nSanta Benedito do Norte - RO', '52', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(152, 'Henrique Igor Branco Jr.', 'bfonseca@example.com', '(63) 92888-9847', '66625-000', '07578-446, Largo Aragão, 70\nMário do Sul - TO', '66', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(153, 'Jefferson de Aguiar Fidalgo', 'jasmin46@example.com', '(35) 90173-1605', '66625-000', '07588-256, Rua Fátima, 360. Bloco B\nSão Regiane do Norte - DF', '61', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(154, 'Roberto Campos Jr.', 'asouza@example.org', '(83) 4250-0170', '66625-000', '31593-591, Avenida Fernandes, 95. Apto 4978\nSanta Joyce - RN', '34', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(155, 'Luna Galvão Brito', 'wilson21@example.org', '(18) 93504-0895', '66625-000', '44649-005, Av. Luan, 3. F\nCorona d\'Oeste - PI', '89', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(156, 'Dr. Sara de Aguiar Arruda', 'salazar.miranda@example.com', '(13) 97565-3240', '66625-000', '08217-923, Av. Delgado, 15\nLeon do Norte - PE', '81', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(157, 'Melissa Barros', 'molina.paulina@example.net', '(22) 95927-8371', '66625-000', '00281-570, R. Roque, 8103. Bloco B\nVila Josefina - PI', '34', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(158, 'Sr. Jerônimo Padrão Valência Filho', 'estrada.thiago@example.com', '(16) 97837-2852', '66625-000', '94275-978, Travessa Juliana, 38. Apto 664\nSanta Tiago do Leste - RS', '11', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(159, 'Kauan Danilo Dominato Sobrinho', 'cezar95@example.com', '(13) 2499-7524', '66625-000', '35799-317, Travessa Dante, 64. Bloco A\nAurora d\'Oeste - ES', '80', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(160, 'Cláudia Zaragoça Jr.', 'escobar.roberto@example.com', '(55) 2325-8528', '66625-000', '14990-862, Av. Breno Vale, 25\nMateus do Leste - SC', '53', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(161, 'Sr. Rafael Davi Lovato', 'benez.juliana@example.net', '(93) 99199-1265', '66625-000', '88892-569, Avenida Sofia Carvalho, 3. Apto 152\nStella do Norte - ES', '78', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(162, 'Gustavo Santiago', 'zambrano.tais@example.com', '(77) 93092-0908', '66625-000', '03619-841, Av. Olívia, 8\nRodolfo do Norte - PE', '81', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(163, 'Sr. Rodrigo Tamoio Salazar Filho', 'nmatos@example.net', '(48) 99797-9881', '66625-000', '43162-515, Rua Flores, 90. Bc. 98 Ap. 79\nPorto Natal do Sul - AL', '74', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(164, 'Dr. Luana Antonella Madeira', 'ljimenes@example.com', '(96) 94954-9303', '66625-000', '23454-490, Avenida Mia de Souza, 957. F\nSanta Bella - CE', '45', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(165, 'Sara Santana Marin Sobrinho', 'rodrigo41@example.net', '(73) 4407-4516', '66625-000', '04769-727, R. Stephany Amaral, 68. 41º Andar\nVila Aline - AL', '38', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(166, 'Dr. Cristóvão Benez Vieira', 'salazar.juliano@example.org', '(82) 3196-9741', '66625-000', '73774-504, Travessa Júlio Montenegro, 5\nSalas do Norte - SP', '18', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(167, 'Moisés Sales Rodrigues', 'tainara.ortega@example.org', '(94) 2094-3230', '66625-000', '74830-042, Av. das Neves, 6451\nTéo do Leste - GO', '39', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(168, 'Dr. Hugo Fabrício Lira Neto', 'matos.carlos@example.com', '(94) 94659-1095', '66625-000', '93375-432, R. Benjamin Sandoval, 71. Bc. 6 Ap. 45\nSão Tábata - AP', '95', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(169, 'Filipe Deverso Sobrinho', 'oliveira.fabio@example.org', '(65) 4332-9846', '66625-000', '05604-956, Av. Kauan Mendes, 92691\nVila Kamila do Norte - RS', '97', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(170, 'Sr. Felipe Leonardo da Rosa Jr.', 'dener.rodrigues@example.net', '(45) 98833-5728', '66625-000', '64282-549, R. Wellington da Silva, 73278. Bc. 84 Ap. 29\nGustavo d\'Oeste - TO', '17', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(171, 'Dr. Teobaldo Nelson Assunção Neto', 'valente.cristian@example.com', '(16) 98074-6560', '66625-000', '45768-082, Largo Yuri, 474\nPorto Christian - SE', '64', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(172, 'Srta. Naomi Romero', 'adriel.aranda@example.com', '(42) 4885-5655', '66625-000', '62133-399, Avenida Paola, 574. Bloco B\nBurgos do Leste - ES', '11', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(173, 'James Colaço', 'javila@example.org', '(75) 90047-8570', '66625-000', '80621-350, Rua Otávio, 34638\nSão Isaac - PI', '38', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(174, 'Rogério Rezende Batista', 'xquintana@example.com', '(45) 96075-0965', '66625-000', '38126-131, Travessa Adriele Benez, 33. Bc. 01 Ap. 62\nVila Gabriel do Norte - PR', '92', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(175, 'Madalena Lourenço Sales Neto', 'olourenco@example.org', '(74) 91743-4161', '66625-000', '70704-192, Travessa Sandro, 583. Bc. 47 Ap. 78\nSanta Cíntia - ES', '64', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(176, 'Maicon Roque Lovato Sobrinho', 'eserrano@example.net', '(82) 2040-7737', '66625-000', '04610-356, Travessa Marin, 930. Fundos\nVila Breno - PR', '39', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(177, 'Sra. Thalita Daiana Balestero', 'serra.manuel@example.org', '(68) 99710-1016', '66625-000', '91002-506, Largo Edilson, 30. Bloco C\nPorto Larissa do Sul - MT', '87', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(178, 'Augusto Serra', 'isabella72@example.net', '(68) 4262-1095', '66625-000', '07671-322, Avenida Estêvão, 6946. F\nPorto Bernardo do Leste - PR', '17', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(179, 'Graziela Gusmão Jr.', 'paes.marcio@example.com', '(84) 4668-9895', '66625-000', '58462-819, Travessa Gabriel da Rosa, 33849\nOtávio do Norte - RS', '51', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(180, 'Nayara Heloise Pacheco', 'lutero.angelica@example.com', '(53) 2470-7879', '66625-000', '51076-391, Travessa Luana Gusmão, 3557\nPorto Lilian - RO', '78', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(181, 'Willian Neves Galvão Neto', 'dvasques@example.net', '(98) 4276-8643', '66625-000', '99539-125, Largo Luísa, 592. Anexo\nBarreto do Leste - MA', '21', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(182, 'Dr. Aaron da Silva Dias', 'evandro.dominato@example.net', '(15) 96841-4836', '66625-000', '68889-633, Rua Queirós, 86189\nPorto Suellen d\'Oeste - AL', '35', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(183, 'Srta. Hosana Nádia Meireles', 'lucio34@example.org', '(85) 99950-4626', '66625-000', '11260-278, Rua Ketlin, 364\nSanta Julieta - DF', '47', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(184, 'Bárbara Delvalle', 'adriano.torres@example.org', '(66) 91360-3202', '66625-000', '40726-734, Av. Jorge, 98008. 9º Andar\nSanta Léia - GO', '77', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(185, 'Amanda Marés Jr.', 'qcamacho@example.org', '(35) 95300-7254', '66625-000', '01366-107, R. Matos, 2127\nSanta Tomás do Leste - RO', '66', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(186, 'Sr. Hernani Vieira Verdugo', 'paola45@example.com', '(11) 99056-6708', '66625-000', '97723-453, Largo Tatiane da Silva, 12369. 5º Andar\nPorto Hernani do Sul - RJ', '94', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(187, 'Dr. Otávio das Neves Filho', 'icorona@example.org', '(55) 91612-4888', '66625-000', '76291-368, Rua Ian das Dores, 558\nSão Esther - MA', '24', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(188, 'Sra. Mary Abreu Gil', 'vmares@example.org', '(43) 90987-9306', '66625-000', '55267-085, Travessa de Arruda, 27\nPorto Jéssica - AP', '16', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(189, 'Dr. Gael Soares Neto', 'nelson.carmona@example.net', '(55) 98469-6006', '66625-000', '31683-798, Rua Vega, 251\nGil d\'Oeste - RS', '56', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(190, 'Manuela Leon Neto', 'paola.desouza@example.net', '(45) 4349-1274', '66625-000', '50772-012, Travessa Sandro, 6588. 086º Andar\nMarina do Sul - RJ', '99', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(191, 'Srta. Hortência Fontes Medina Jr.', 'jfranco@example.org', '(32) 97302-1672', '66625-000', '87104-281, Avenida Matheus Saraiva, 884. Bloco B\nFonseca do Sul - TO', '64', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(192, 'Srta. Fernanda Pacheco', 'camila96@example.org', '(61) 2745-2009', '66625-000', '62417-727, Av. Benites, 47490\nVila Pérola - TO', '75', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(193, 'Dr. Sebastião Jorge Vale Neto', 'galhardo.abgail@example.com', '(69) 90345-6825', '66625-000', '41852-502, Rua Sepúlveda, 9630. Bc. 0 Ap. 84\nSanta Ayla - SP', '89', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(194, 'Dr. Noelí Saraiva Feliciano Sobrinho', 'malena09@example.org', '(93) 95411-0636', '66625-000', '76501-728, Avenida Quintana, 5. Apto 4\nPorto Diogo do Leste - PI', '88', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(195, 'Dr. Heitor Luan Quintana', 'cecilia09@example.com', '(22) 4070-1601', '66625-000', '44308-053, R. Dirce Gomes, 107\nSão Luciano - RJ', '63', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(196, 'Willian Valdez Filho', 'ptamoio@example.net', '(53) 98279-6743', '66625-000', '09527-410, Travessa Sophie Pena, 44\nSanta Roberto d\'Oeste - RN', '55', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(197, 'Luiza Ferreira Queirós Neto', 'lfernandes@example.net', '(11) 2410-2533', '66625-000', '46575-437, Avenida Arruda, 438\nSanta Renan do Sul - PB', '99', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(198, 'Dr. Ariana Lutero Jr.', 'monica.quintana@example.net', '(27) 90978-4633', '66625-000', '38703-309, Rua Maitê Bonilha, 452. 786º Andar\nCaldeira do Sul - PE', '74', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(199, 'Hernani Lira', 'clara99@example.net', '(54) 3727-9825', '66625-000', '39585-143, Largo Hortência Aguiar, 2\nArthur do Norte - RO', '14', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(200, 'Sra. Maitê Campos Franco', 'adriel96@example.org', '(83) 3804-7461', '66625-000', '01628-103, Largo Milena, 7349\nVila Juliana - PB', '35', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(201, 'Sr. Igor de Aguiar Marés Filho', 'victor34@example.net', '(53) 2421-8128', '66625-000', '64029-008, Avenida Mascarenhas, 5288\nVila Ítalo do Norte - AP', '63', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(202, 'Sr. Fabrício Abreu Bezerra Filho', 'joaquin.dasdores@example.com', '(87) 4064-3222', '66625-000', '24882-948, Travessa Madalena Soto, 3885. Apto 6586\nMontenegro do Sul - SE', '71', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(203, 'Sr. Fábio Daniel Godói', 'rferminiano@example.net', '(33) 99612-7883', '66625-000', '37209-294, Travessa Filipe, 593. Apto 97\nCaio d\'Oeste - GO', '72', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(204, 'Dr. Benjamin Diogo Espinoza', 'tabata.fernandes@example.com', '(27) 4366-0135', '66625-000', '07102-168, Travessa Alícia, 13734\nPorto Suellen d\'Oeste - AL', '80', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(205, 'Dr. Juliano Robson Salazar Jr.', 'pacheco.malu@example.org', '(95) 2570-6521', '66625-000', '87305-051, R. Bruna Paes, 46\nReis do Leste - MS', '47', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(206, 'Fabiana Santos', 'joaquim56@example.org', '(96) 3833-0515', '66625-000', '69935-079, Avenida Arruda, 3. F\nVinícius do Norte - PA', '36', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(207, 'Sr. Felipe Queirós Rivera', 'matheus90@example.org', '(41) 3630-5240', '66625-000', '77864-221, R. Leal, 462\nPorto Kléber do Leste - PR', '15', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(208, 'Srta. Noa Solano', 'pcortes@example.net', '(74) 4370-6221', '66625-000', '68676-398, Travessa Ítalo, 21007\nVila Tábata - SC', '14', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(209, 'Giovanna Batista Montenegro', 'delgado.willian@example.com', '(16) 98276-3793', '66625-000', '48455-256, R. Matias, 69368. Anexo\nD\'ávila do Norte - MT', '95', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(210, 'Dr. Franco Dominato', 'raphael81@example.net', '(43) 94868-5909', '66625-000', '08342-925, Av. Jonas Toledo, 7124. 662º Andar\nMirella do Norte - RO', '35', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(211, 'Srta. Michelle Ellen Caldeira Jr.', 'debora.soto@example.org', '(94) 2397-5537', '66625-000', '95119-734, Travessa Diogo Dominato, 374\nZambrano do Sul - RR', '43', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(212, 'Alana Serna Godói', 'zleon@example.com', '(15) 3944-4658', '66625-000', '34774-036, R. Gil, 15\nMarin do Norte - PA', '25', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(213, 'Sra. Isabel Alcantara', 'felipe.padilha@example.net', '(67) 2985-5017', '66625-000', '91214-133, Rua Manuela, 55025. Anexo\nTatiana do Sul - MA', '21', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(214, 'Srta. Giovanna Aguiar', 'mflores@example.net', '(97) 91279-9874', '66625-000', '42154-766, Rua Fernanda Sandoval, 3. 9º Andar\nRoberto d\'Oeste - MS', '44', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01');
INSERT INTO `client` (`id`, `name`, `email`, `phone`, `cep`, `address`, `address_number`, `complement`, `created_at`, `updated_at`) VALUES
(215, 'Sra. Samara Salgado Paes Filho', 'ydacruz@example.net', '(82) 98294-4123', '66625-000', '78187-760, Av. Mauro, 10330. Apto 8126\nSão Eunice - GO', '49', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(216, 'Sr. Carlos Grego Aragão Jr.', 'simao.souza@example.net', '(65) 4280-1780', '66625-000', '14497-567, Avenida Michelle Balestero, 418\nSão Maiara - PI', '14', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(217, 'Dr. Cristina Olívia Queirós', 'alicia.beltrao@example.net', '(62) 4147-1072', '66625-000', '21882-794, Rua Vila, 7. 7º Andar\nAssunção do Sul - AM', '89', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(218, 'Sônia Ketlin Flores Sobrinho', 'vanessa90@example.com', '(44) 99977-3790', '66625-000', '49272-853, Travessa Téo Carmona, 23645. Apto 889\nVila Michelle - RJ', '73', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(219, 'Srta. Suzana Feliciano', 'evandro45@example.com', '(84) 2721-5184', '66625-000', '97389-555, Avenida Gean, 32213. Bloco B\nVila Alice d\'Oeste - DF', '53', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(220, 'Henrique Téo Gusmão Jr.', 'lorena16@example.net', '(62) 4145-5991', '66625-000', '58658-304, R. Iasmin Martines, 6\nThomas do Norte - MS', '68', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(221, 'Elizabeth Cynthia Torres Jr.', 'fernandes.daniel@example.com', '(81) 4468-4160', '66625-000', '54664-853, R. Sandoval, 5. Fundos\nVila Teobaldo do Sul - MA', '66', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(222, 'Dr. William Alexandre Ferminiano', 'zescobar@example.com', '(17) 2629-7038', '66625-000', '36626-267, R. Alma Martines, 6\nDias do Leste - AL', '10', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(223, 'Adriel Vila', 'leal.fabricio@example.net', '(82) 96409-9012', '66625-000', '05022-137, Largo Afonso Neves, 299\nVieira d\'Oeste - DF', '30', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(224, 'Sra. Juliana Pena', 'ferminiano.walter@example.com', '(91) 4906-6339', '66625-000', '15266-467, Travessa Ellen, 6. Apto 857\nVila Bernardo - PB', '23', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(225, 'Cléber de Souza Sobrinho', 'sesteves@example.org', '(21) 95093-7510', '66625-000', '07812-606, Largo Zaragoça, 1. Bloco B\nVila Ziraldo - RO', '82', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(226, 'Dr. Mário Salgado Teles Sobrinho', 'joaquim.barreto@example.net', '(96) 2987-2247', '66625-000', '35757-247, Av. Barros, 27706. F\nRoque do Norte - SP', '64', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(227, 'Enzo Breno Grego', 'gabriel.quintana@example.org', '(11) 3774-2115', '66625-000', '12004-082, Travessa Stella, 51610. 0º Andar\nSanta Josué do Leste - AL', '80', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(228, 'Srta. Sabrina Maísa Gil Sobrinho', 'janaina87@example.net', '(83) 3360-2104', '66625-000', '94091-656, Avenida Deivid, 86655\nPorto Fabiano do Sul - RN', '10', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(229, 'Emília de Souza', 'george44@example.org', '(69) 4039-0292', '66625-000', '02496-686, Avenida Sérgio Lovato, 8. Bc. 1 Ap. 24\nSanta Reinaldo d\'Oeste - MG', '37', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(230, 'Srta. Julieta Santacruz Santos Neto', 'agostinho68@example.com', '(94) 97463-7535', '66625-000', '21178-580, Rua Michele Uchoa, 5. Anexo\nSepúlveda do Norte - PI', '41', 'Text Text Text Text Text', '2021-03-20 01:25:01', '2021-03-20 01:25:01'),
(231, 'Hugo de Arruda Souza Filho', 'lourenco.michelle@example.net', '(71) 95396-1262', '66625-000', '51951-563, Rua Eric Saito, 69636. 7º Andar\nPorto Isaac - PB', '66', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(232, 'Sra. Mônica de Souza Galindo Filho', 'cesar05@example.org', '(34) 90365-4001', '66625-000', '10353-889, R. Allan Padrão, 1896\nMarques d\'Oeste - ES', '21', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(233, 'Sra. Jasmin Verdugo Jr.', 'casanova.gabrielle@example.com', '(69) 99144-9458', '66625-000', '87037-317, Largo de Freitas, 782\nVila Mateus do Sul - SE', '10', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(234, 'Dr. Rosana Fontes Carvalho Sobrinho', 'leo.barreto@example.net', '(43) 97070-0781', '66625-000', '84165-435, Travessa Sheila, 79\nSão Benício - SC', '100', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(235, 'Sr. Josué Tomás Vila Sobrinho', 'diogo.alcantara@example.net', '(67) 2809-5957', '66625-000', '50510-103, Rua Betina Flores, 71\nTeles d\'Oeste - PE', '50', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(236, 'Dr. Luísa Zaragoça Vasques', 'sepulveda.ariana@example.com', '(48) 4116-6140', '66625-000', '49354-884, Travessa Bittencourt, 365\nLuis do Norte - PI', '22', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(237, 'Otávio Lira', 'iquintana@example.net', '(13) 95688-6294', '66625-000', '38691-741, R. Amaral, 4\nLeo d\'Oeste - RJ', '64', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(238, 'Isadora Fonseca Escobar Jr.', 'bcaldeira@example.net', '(73) 4047-3623', '66625-000', '95686-506, R. Luciano Quintana, 3006\nSão Emanuel do Sul - PB', '88', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(239, 'Sr. Breno Salas Ramos', 'qvasques@example.org', '(95) 2732-2152', '66625-000', '52545-355, Rua Flávio, 5. Bloco B\nGalindo do Norte - CE', '92', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(240, 'Alessandro Marques Neto', 'assuncao.danielle@example.net', '(68) 3547-7444', '66625-000', '32762-311, Travessa Suelen, 5570\nSão Alana do Sul - RJ', '25', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(241, 'Thales Espinoza Perez Filho', 'regiane05@example.com', '(91) 2071-7378', '66625-000', '38673-948, Largo Roque, 2\nSão Aaron - MA', '55', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(242, 'Dr. Moisés Aragão Padrão', 'operez@example.com', '(88) 98837-0271', '66625-000', '36274-556, Largo Estrada, 1792. Anexo\nSanta Júlia - AP', '87', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(243, 'Cláudio Renato Maia', 'aline.dearruda@example.net', '(81) 3799-7343', '66625-000', '58814-605, Av. Henrique Pontes, 3652. Bloco A\nSão Walter d\'Oeste - RS', '98', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(244, 'Dr. Emiliano Delatorre Urias Neto', 'luciano95@example.com', '(71) 90664-8985', '66625-000', '01053-108, Travessa Branco, 1\nPerez do Leste - AL', '34', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(245, 'Isaac Júlio Sanches Neto', 'graziela.lutero@example.net', '(91) 2368-3952', '66625-000', '58614-498, R. Eduardo, 6811. 8º Andar\nBezerra do Leste - TO', '29', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(246, 'Paulina Michele Saito Sobrinho', 'analu.rocha@example.com', '(67) 92034-9587', '66625-000', '96346-741, Av. Reinaldo Neves, 57\nVila Mia - AC', '96', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(247, 'Suzana Montenegro', 'ncarvalho@example.com', '(99) 90520-7322', '66625-000', '44352-328, Rua Jácomo, 35832\nVila Jefferson - AL', '34', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(248, 'Thaís Miranda Fidalgo Filho', 'emerson55@example.com', '(97) 2195-4341', '66625-000', '82897-476, Largo Alícia Assunção, 7. Apto 270\nMaitê do Sul - RJ', '30', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(249, 'Dr. Flor Lorena Dias', 'simao73@example.net', '(31) 99213-6787', '66625-000', '54811-828, Rua Eunice Martines, 16\nVila Cezar d\'Oeste - PA', '93', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(250, 'Marcelo Júlio Azevedo', 'ferreira.mel@example.com', '(33) 92000-2524', '66625-000', '14636-466, Avenida Ivan Pontes, 44. Bc. 0 Ap. 78\nPorto Simon - SP', '66', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(251, 'Edson Queirós Prado Filho', 'juliane98@example.org', '(51) 93369-6987', '66625-000', '96459-139, Av. Noel Montenegro, 165\nVila Gabriel do Norte - PE', '22', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(252, 'Igor Ferminiano Jr.', 'emiliano.fonseca@example.net', '(62) 93903-4322', '66625-000', '58039-496, R. Raphael, 8. 44º Andar\nPorto Thales - BA', '37', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(253, 'Malena Jéssica Velasques Filho', 'heloisa.velasques@example.org', '(91) 95798-3167', '66625-000', '42262-302, Avenida Ivana, 589. 984º Andar\nSalgado do Sul - ES', '94', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(254, 'Arthur Heitor Rico', 'theo.beltrao@example.net', '(37) 4831-0875', '66625-000', '50271-948, R. Melissa, 4\nFerreira do Norte - RO', '59', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(255, 'Théo Carvalho', 'xavila@example.net', '(95) 3972-9029', '66625-000', '69339-614, Largo Danilo, 6\nThiago d\'Oeste - AC', '22', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(256, 'Dr. Gabriel Leal Jr.', 'danielle66@example.com', '(11) 4055-5869', '66625-000', '38879-499, Travessa Filipe Lutero, 923\nPorto Rafaela do Sul - GO', '24', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(257, 'Mirella Marques', 'jserrano@example.net', '(65) 98529-0550', '66625-000', '61519-621, Travessa Rosa, 6\nFernando d\'Oeste - PE', '75', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(258, 'Sr. Roberto Rivera Serna Jr.', 'escobar.alexandre@example.org', '(98) 99198-9345', '66625-000', '67027-638, Rua Gabriel, 14579\nVila Nayara do Sul - ES', '65', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(259, 'Júlio Guerra Espinoza Sobrinho', 'denise.galvao@example.com', '(48) 2111-1793', '66625-000', '04454-409, Avenida Suelen, 7615. Apto 3583\nThiago d\'Oeste - AL', '53', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(260, 'Graziela Gisele Rico Neto', 'ortiz.benicio@example.org', '(87) 95412-0252', '66625-000', '43715-497, R. Matos, 88341\nPorto Verônica - RO', '26', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(261, 'Fernando Assunção Vale Neto', 'luzia.prado@example.org', '(32) 3531-8882', '66625-000', '71887-907, Rua Laís Neves, 777. Bc. 82 Ap. 39\nPorto Malu do Leste - SC', '93', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(262, 'Francisco Wagner Aranda', 'micaela48@example.com', '(91) 96023-3445', '66625-000', '30892-071, Avenida Aaron, 64. 2º Andar\nVila Renata - ES', '50', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(263, 'Sr. Alexandre Valdez', 'sepulveda.maximo@example.org', '(42) 2360-0510', '66625-000', '07918-583, Av. Pérola, 5803. Bloco A\nPorto Francisco do Sul - BA', '18', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(264, 'Dr. Jefferson Lovato Sobrinho', 'reis.franco@example.com', '(83) 2850-9490', '66625-000', '91131-472, R. Rosa, 640. Bloco A\nHosana do Norte - TO', '69', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(265, 'Isaac Espinoza Gomes Neto', 'gdearruda@example.com', '(66) 94239-5641', '66625-000', '97911-750, R. de Arruda, 4\nLívia d\'Oeste - PR', '19', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(266, 'Mila Santiago Aranda Filho', 'miranda23@example.org', '(46) 90050-0109', '66625-000', '67133-698, Rua Chaves, 95\nSanta Sofia do Norte - SC', '49', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(267, 'Letícia Correia Sobrinho', 'danielle.pedrosa@example.net', '(54) 2561-2312', '66625-000', '26657-519, Largo Alves, 6794. Apto 6\nHernani do Sul - GO', '24', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(268, 'Gilberto Alessandro Beltrão', 'mirella.feliciano@example.com', '(43) 4195-9757', '66625-000', '70455-426, Avenida Paulina Urias, 77800. Anexo\nMadeira do Sul - PB', '24', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(269, 'Simon Paes Sobrinho', 'louise14@example.com', '(89) 92637-2898', '66625-000', '44564-093, Av. Vinícius Cruz, 5\nVila Teobaldo - RO', '38', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(270, 'Karina Noelí Serrano Jr.', 'thiago.alves@example.com', '(89) 3325-0754', '66625-000', '34759-395, Av. Roberto Zamana, 8396. Bc. 2 Ap. 28\nZambrano d\'Oeste - PI', '61', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(271, 'Sr. Denis Marcelo Toledo', 'crodrigues@example.com', '(42) 2268-8675', '66625-000', '16411-718, Largo Michelle Rodrigues, 72\nVale do Leste - RJ', '85', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(272, 'Dr. Ítalo Flores Molina Neto', 'valente.gisela@example.com', '(21) 3378-3709', '66625-000', '53182-967, Largo Marcos Sanches, 504\nSanta Willian d\'Oeste - RN', '91', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(273, 'Sr. Simão Amaral', 'santana.mauro@example.com', '(83) 2132-9556', '66625-000', '39248-641, Rua Benedito, 69\nManuel d\'Oeste - SE', '97', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(274, 'Sr. Simon Zambrano Jr.', 'osaraiva@example.org', '(48) 93895-4199', '66625-000', '33469-765, Rua Jácomo, 13. Bc. 00 Ap. 57\nVila Emílio - MS', '64', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(275, 'Sra. Stella Lutero Jr.', 'caldeira.matias@example.net', '(15) 90925-6222', '66625-000', '09017-739, Travessa Pedrosa, 56591\nVila Paulo do Sul - MA', '26', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(276, 'Samara Lavínia Furtado', 'isabelly83@example.net', '(82) 3121-5588', '66625-000', '25005-525, Travessa Pacheco, 6\nPorto Cezar d\'Oeste - ES', '93', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(277, 'Sra. Léia de Freitas Maia Filho', 'dasneves.giovane@example.org', '(24) 2937-2347', '66625-000', '68288-470, Av. Natália Paes, 665\nSão Irene - MA', '22', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(278, 'Gustavo Flores', 'verdugo.viviane@example.net', '(43) 95224-1482', '66625-000', '37152-012, Avenida Miranda, 12. Apto 68\nPorto Diogo d\'Oeste - TO', '22', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(279, 'Natália Stella Solano', 'tbrito@example.net', '(83) 2027-6359', '66625-000', '91804-775, R. Erik, 95. Anexo\nSalazar do Leste - SC', '72', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(280, 'Alma Camacho de Arruda Neto', 'cleber.fonseca@example.org', '(15) 3522-2772', '66625-000', '05792-613, Avenida Andressa, 75728\nSanta Sergio - RN', '39', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(281, 'Yasmin Sophie Pontes', 'jpedrosa@example.org', '(87) 4362-5604', '66625-000', '99896-940, Rua Jácomo Barreto, 8. 668º Andar\nMarta do Norte - RN', '36', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(282, 'Leonardo Walter Estrada Sobrinho', 'eloa24@example.net', '(61) 93713-3760', '66625-000', '53936-006, Largo Graziela de Souza, 5\nPorto Eric - AC', '79', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(283, 'Dr. Andréa das Dores', 'dacruz.diego@example.net', '(22) 2561-4527', '66625-000', '79297-093, Av. Máximo Delvalle, 5967\nSanta Daniele do Sul - RJ', '38', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(284, 'Murilo James Cordeiro Neto', 'pdasilva@example.com', '(14) 90115-5990', '66625-000', '91796-722, Travessa Ester, 3\nRoberta do Norte - RN', '23', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(285, 'Sra. Isadora Domingues Filho', 'qgoncalves@example.net', '(46) 2397-9701', '66625-000', '06272-622, R. Miriam Rangel, 58145. Anexo\nSão Daniel - PI', '87', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(286, 'Srta. Paulina Pedrosa Soto', 'wgarcia@example.org', '(87) 99017-2749', '66625-000', '41870-630, Largo Willian Estrada, 36. 0º Andar\nFrancisco do Sul - MA', '95', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(287, 'Dr. James de Souza Jr.', 'xtorres@example.org', '(93) 96119-3235', '66625-000', '16441-020, R. Mariana, 8. Bloco A\nLívia do Norte - CE', '89', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(288, 'Théo Ramos Filho', 'rico.veronica@example.com', '(96) 4347-2406', '66625-000', '09868-213, Travessa Luan Marques, 218\nCordeiro d\'Oeste - BA', '66', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(289, 'Walter Isaac Dominato', 'inacio10@example.org', '(98) 4733-1523', '66625-000', '26813-463, Rua Filipe, 558. 959º Andar\nPorto Ziraldo - MS', '69', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(290, 'Dr. Adriel Jefferson Roque Jr.', 'marin.wilson@example.com', '(53) 96739-7784', '66625-000', '01648-362, Travessa Vasques, 814. F\nFerreira do Norte - AP', '82', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(291, 'Dr. César Feliciano', 'simon17@example.com', '(66) 90302-4306', '66625-000', '84267-584, Av. Isis, 26. Bloco B\nLéia d\'Oeste - MA', '54', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(292, 'Adriana Zamana Serna Jr.', 'roque.elis@example.com', '(99) 94601-8070', '66625-000', '51404-895, Largo Rezende, 9\nFidalgo d\'Oeste - PR', '40', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(293, 'Tomás Ferreira Duarte Jr.', 'bbittencourt@example.net', '(85) 3763-8443', '66625-000', '62357-976, Travessa Erik Burgos, 259. Bc. 23 Ap. 58\nPerez do Norte - ES', '16', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(294, 'Sofia Catarina Rocha Neto', 'erik.serrano@example.net', '(17) 92675-3586', '66625-000', '23859-922, Travessa Teobaldo, 7. Bloco B\nSão Joaquim - AM', '88', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(295, 'Dr. Adriele Brito Cortês', 'nverdugo@example.net', '(85) 96053-5481', '66625-000', '38346-651, R. Cordeiro, 11. Bloco A\nCláudio do Leste - BA', '95', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(296, 'Valentin Feliciano Delvalle', 'brito.renata@example.net', '(82) 99266-5771', '66625-000', '51082-198, Travessa Kelly de Aguiar, 8\nSão Felipe do Leste - PE', '36', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(297, 'Dr. Horácio Pedro Cordeiro', 'violeta.rios@example.com', '(13) 90818-1670', '66625-000', '56915-209, Av. Dener Arruda, 56683. 9º Andar\nSão Sergio do Sul - AM', '74', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(298, 'Dr. Maicon Fabiano Faro Jr.', 'mirela99@example.com', '(33) 3299-0552', '66625-000', '82871-819, Travessa Marta, 46. Bc. 4 Ap. 20\nSão Rebeca - RN', '61', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(299, 'Sr. Jean Assunção', 'sebastiao27@example.com', '(62) 3284-5394', '66625-000', '60614-011, Travessa David, 4\nKarina do Sul - MS', '35', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(300, 'Inácio Perez', 'matias.afonso@example.org', '(24) 97976-1783', '66625-000', '53712-514, Av. Emília Queirós, 1\nPorto Cláudio - PE', '89', 'Text Text Text Text Text', '2021-03-20 01:25:02', '2021-03-20 01:25:02');

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
(1, 8, 221, 14765, 'Aut et et nihil. Repellat eum consequuntur tempora nisi dolorem. Officia repudiandae aliquam molestiae voluptatibus.', 1, 'Igor Camacho Ortega', '(93) 3296-0225', '66625-000', '19224-931, Travessa Rios, 2348. Apto 9240\nLucio do Sul - AC', '93', 'Text Text Text Text Text', 4, '2022-06-25 20:14:26', '2022-09-23 20:14:26', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(2, 10, 141, 22437, 'Modi ullam molestias similique quo. Earum similique molestiae neque omnis eveniet expedita.', 2, 'Srta. Ornela Stephany Vasques Jr. Madeira', '(22) 2655-2577', '66625-000', '39528-388, Largo Lidiane Velasques, 184. Anexo\nSão Josué - TO', '90', 'Text Text Text Text Text', NULL, '2022-04-14 05:50:33', '2022-07-13 05:50:33', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(3, 23, 98, 13130, 'Illum quia ut odio rerum. Molestiae commodi incidunt voluptatem quasi. Quis perspiciatis dolorem voluptatem neque dolor est.', 2, 'Dr. George Flores Pontes Barreto', '(49) 92030-9093', '66625-000', '52662-906, Av. Agatha, 9584. Apto 25\nCarol d\'Oeste - MA', '26', 'Text Text Text Text Text', NULL, '2022-03-25 00:39:01', '2022-06-23 00:39:01', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(4, 14, 96, 73959, 'Velit maiores sunt nemo maiores error inventore molestias. Fugit nihil numquam ut non. Qui omnis quod qui tenetur molestias est ut. Ducimus dolore neque sint explicabo cupiditate veritatis.', 2, 'Miranda Manuela Benites Pedrosa', '(94) 4458-3802', '66625-000', '92741-186, Largo Mateus Camacho, 9199\nSanta Arthur do Leste - AL', '31', 'Text Text Text Text Text', 1, '2020-05-07 08:15:51', '2020-08-05 08:15:51', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(5, 8, 60, 35412, 'Ullam blanditiis itaque rerum quas fugit corporis maiores quo. Qui cum error incidunt sunt qui quia.', 2, 'Betina Analu Marin Santacruz', '(94) 2027-8551', '66625-000', '79806-523, Avenida Romero, 4062. F\nRichard d\'Oeste - RS', '77', 'Text Text Text Text Text', 2, '2021-05-26 07:25:51', '2021-08-24 07:25:51', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(6, 27, 154, 53180, 'Officia a alias placeat aliquid quia qui vero. Et iusto quas optio quibusdam nisi eveniet. Sunt autem at est vitae sequi in nulla. Earum libero itaque ut optio.', 2, 'Benício Pontes Gil Jr. Abreu', '(63) 2280-7376', '66625-000', '07191-036, Travessa Samanta Saraiva, 5\nNatal d\'Oeste - BA', '89', 'Text Text Text Text Text', NULL, '2022-07-08 12:18:26', '2022-10-06 12:18:26', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(7, 8, 282, 54455, 'Mollitia voluptas labore maxime corrupti id natus. Cupiditate nihil est adipisci dolorem sequi temporibus. Culpa distinctio unde dolorem nemo velit sint.', 2, 'Dr. Thales de Oliveira Rosa Barreto', '(32) 4087-7320', '66625-000', '63692-399, Travessa Lúcia, 77242. Bloco C\nSão Emiliano - CE', '52', 'Text Text Text Text Text', 4, '2020-10-21 13:14:03', '2021-01-19 13:14:03', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(8, 9, 220, 44270, 'Assumenda qui illo nisi nisi et aut at inventore. Quia nemo at et non ad natus quod. Exercitationem amet perferendis qui placeat.', 1, 'Dr. Reinaldo das Dores Medina Campos', '(18) 4882-9134', '66625-000', '65274-477, Av. Sepúlveda, 87. Fundos\nSanta Ícaro d\'Oeste - MA', '36', 'Text Text Text Text Text', 4, '2022-09-30 06:51:25', '2022-12-29 06:51:25', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(9, 26, 63, 56411, 'Aut eveniet quaerat voluptatem hic. Fuga ducimus aut eveniet autem totam possimus. Doloribus iure pariatur nostrum nobis nam voluptatibus. Voluptatibus molestiae molestias aut quo officia.', 1, 'Srta. Sofia Lívia Sales Marques', '(32) 4593-4029', '66625-000', '55283-474, Travessa Rayane Rico, 48591\nWellington d\'Oeste - PE', '42', 'Text Text Text Text Text', NULL, '2022-08-02 17:47:22', '2022-10-31 17:47:22', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(10, 20, 248, 50740, 'Inventore hic omnis sint voluptatum. Sed voluptate non dolorem temporibus aut enim nobis. Vero quos doloremque adipisci nihil. Velit corrupti sed distinctio molestiae et et veritatis aut.', 2, 'Hortência Beltrão Valdez', '(21) 96916-1761', '66625-000', '02766-884, Avenida Ricardo Zamana, 75\nPerez d\'Oeste - MG', '20', 'Text Text Text Text Text', NULL, '2022-03-19 02:06:02', '2022-06-17 02:06:02', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(11, 17, 272, 59198, 'Molestias iste et vitae omnis ad adipisci unde ab. Distinctio excepturi enim non rem quia. Qui aliquid amet odit non eligendi.', 2, 'Emílio Perez Marés', '(64) 3326-0037', '66625-000', '33264-190, Av. Luciano, 1. Apto 733\nVinícius do Norte - MA', '33', 'Text Text Text Text Text', 1, '2020-01-04 09:48:04', '2020-04-03 09:48:04', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(12, 8, 37, 62420, 'Quam deleniti esse id commodi. Adipisci ut sunt dolorum non repellat ullam facere.', 1, 'Dr. Ayla Vega Sepúlveda Jr. Reis', '(43) 91307-4166', '66625-000', '64953-328, R. Isabelly, 4596. Bc. 01 Ap. 83\nCésar do Norte - CE', '42', 'Text Text Text Text Text', 4, '2021-03-02 13:12:40', '2021-05-31 13:12:40', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(13, 19, 88, 78204, 'Vel veniam eos id magnam. Magnam et error sunt voluptatem eius ipsa. Fugit omnis eum enim libero et. Sunt molestias vel dicta facere.', 2, 'Gabi Ramires Delatorre Caldeira', '(86) 97167-0653', '66625-000', '32534-844, Travessa Sandoval, 4381. Bloco C\nSanta Lívia - RJ', '57', 'Text Text Text Text Text', 1, '2021-01-05 15:43:29', '2021-04-05 15:43:29', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(14, 13, 248, 67987, 'Vel ex non voluptatum dolores. Sint libero reiciendis est. Et incidunt aut praesentium aspernatur. Et corporis repellendus facere.', 2, 'Sr. Rogério George Padrão Serra', '(32) 98105-8845', '66625-000', '31485-400, Travessa Prado, 718\nSanta Joana d\'Oeste - MT', '46', 'Text Text Text Text Text', 2, '2021-11-20 04:21:05', '2022-02-18 04:21:05', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(15, 24, 205, 72437, 'Quidem aliquid dolorem perspiciatis sit consectetur eaque quod. Autem possimus in alias laudantium voluptatem nemo sint ratione. Reiciendis totam impedit ea ducimus tempora qui quas.', 2, 'Srta. Cíntia Karen Montenegro Casanova', '(99) 93726-2101', '66625-000', '07399-743, Av. Josefina, 42630\nVila Dante - RJ', '16', 'Text Text Text Text Text', 4, '2021-12-21 20:15:02', '2022-03-21 20:15:02', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(16, 18, 137, 24336, 'Debitis ducimus consequuntur voluptas repellat. Dolorem reprehenderit eveniet aperiam et. Odio nesciunt a autem suscipit et eum modi.', 1, 'Alexa Jasmin Fidalgo Benez', '(79) 99440-1947', '66625-000', '92776-998, Largo Tomás, 4692\nBetina do Norte - SE', '95', 'Text Text Text Text Text', 2, '2021-09-13 07:49:51', '2021-12-12 07:49:51', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(17, 25, 1, 37649, 'Et quo impedit aut sint. Provident eos rerum libero qui corporis impedit commodi vitae. Iure recusandae repellat pariatur quia excepturi possimus minus. Qui enim numquam harum et.', 2, 'Sr. Ian Beltrão Urias Sobrinho Leon', '(34) 3119-4780', '66625-000', '59871-067, Av. Renan Valência, 646\nBárbara d\'Oeste - PR', '38', 'Text Text Text Text Text', 4, '2022-03-10 05:13:01', '2022-06-08 05:13:01', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(18, 27, 238, 36717, 'Quia quaerat voluptates vero possimus ut error doloribus. Id soluta enim voluptatum praesentium. Iste perspiciatis quo sunt.', 2, 'Sr. Benjamin Mário Cervantes Branco', '(38) 3230-5001', '66625-000', '99449-312, Rua Laura Faria, 65\nVila Andres d\'Oeste - PR', '40', 'Text Text Text Text Text', NULL, '2021-03-10 07:33:10', '2021-06-08 07:33:10', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(19, 13, 88, 78458, 'At eius aut dolores aut dolorem. Aliquam non cum unde veniam quisquam.', 2, 'Srta. Mirella Delatorre Filho Pontes', '(81) 2221-8501', '66625-000', '64147-041, Rua Ortiz, 298. 0º Andar\nRodrigues do Norte - AM', '58', 'Text Text Text Text Text', NULL, '2022-11-21 16:27:47', '2023-02-19 16:27:47', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(20, 25, 7, 78322, 'Deserunt quibusdam molestias numquam et reprehenderit rerum sit. Rerum quos perferendis eligendi modi nihil iusto optio. Unde sunt non nobis et rerum aut. Iure omnis molestiae sit et.', 1, 'Iasmin Cruz Alcantara', '(82) 98319-5700', '66625-000', '69696-147, Rua Antonieta Ortega, 75\nPorto Ellen - RN', '25', 'Text Text Text Text Text', 1, '2021-07-15 13:20:25', '2021-10-13 13:20:25', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(21, 12, 209, 22610, 'Consectetur quod error cumque necessitatibus. Dignissimos cupiditate magni et in earum. Accusantium accusantium odit quis et consequuntur qui. Placeat eius soluta ipsa dolorum.', 1, 'Cláudio Flores Batista', '(68) 2921-4298', '66625-000', '57019-449, Largo Beltrão, 27\nSão Aline - RO', '11', 'Text Text Text Text Text', 3, '2020-11-06 23:35:46', '2021-02-04 23:35:46', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(22, 26, 135, 66171, 'Esse nihil velit sequi unde. Voluptatem et eligendi et qui. Non autem esse dolor officia excepturi. Consequatur tempore quo quia ut magni odio voluptatem.', 1, 'Franco Tomás Lira Jr. Deverso', '(97) 94789-1696', '66625-000', '86034-421, Av. Chaves, 2882\nSanta Daniela do Sul - AP', '37', 'Text Text Text Text Text', NULL, '2022-10-25 07:24:05', '2023-01-23 07:24:05', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(23, 19, 15, 58497, 'Ipsam voluptatum similique sint error recusandae. Numquam qui aperiam consequatur voluptatibus aut provident. Occaecati quod officiis odio rerum aspernatur sint. A eum fugiat non a sit.', 1, 'Srta. Verônica Alves Delvalle', '(85) 90973-8280', '66625-000', '65570-617, Largo Camacho, 891. Bc. 21 Ap. 14\nSão Edson - AL', '10', 'Text Text Text Text Text', 2, '2020-02-05 12:29:23', '2020-05-05 12:29:23', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(24, 12, 14, 16079, 'Vero impedit voluptas repellendus dolor at natus omnis. Magnam suscipit cum vero fugiat laudantium autem fugiat. Quia dolores sit cupiditate molestiae labore quia debitis.', 1, 'Marília Souza Ortega Sobrinho Delgado', '(11) 2612-5822', '66625-000', '93175-582, Avenida Caio, 5170. Apto 6962\nLucio do Sul - AM', '86', 'Text Text Text Text Text', 1, '2021-08-08 16:18:18', '2021-11-06 16:18:18', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(25, 14, 243, 72520, 'Nostrum recusandae alias ea eligendi. Enim nemo quas expedita. Aperiam sapiente voluptas sit fuga omnis non.', 1, 'Enzo Feliciano Marques', '(63) 3275-5252', '66625-000', '99942-299, Largo Nádia, 3606. Bloco B\nVila Théo - SP', '80', 'Text Text Text Text Text', 3, '2021-05-14 15:08:21', '2021-08-12 15:08:21', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(26, 28, 256, 29370, 'Consequatur sit ex dolor enim voluptatum officiis. Et illum non modi. Est et a est rem ea non. Expedita ut autem omnis ullam maiores quas.', 1, 'Stephany Mary Valência de Oliveira', '(12) 2358-8610', '66625-000', '25152-524, Avenida Bella Garcia, 980. Fundos\nRaquel do Leste - RJ', '90', 'Text Text Text Text Text', 3, '2020-08-22 02:05:14', '2020-11-20 02:05:14', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(27, 14, 293, 44098, 'Repellat quo ducimus assumenda deleniti qui quia. Nisi esse delectus suscipit vel maiores non sed ratione. Velit id corrupti quia vel.', 2, 'Nádia Antonella Esteves Sobrinho Branco', '(38) 90835-1638', '66625-000', '23011-289, R. Aguiar, 859. Anexo\nThomas do Norte - SE', '19', 'Text Text Text Text Text', NULL, '2021-12-24 20:52:35', '2022-03-24 20:52:35', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(28, 27, 110, 25499, 'Iusto rem repudiandae quaerat. Voluptas qui aspernatur similique. Nisi eum omnis consequatur. Minus pariatur molestias rerum illum occaecati corporis.', 1, 'Srta. Luana Benez Santiago Teles', '(27) 4401-9069', '66625-000', '38182-655, Largo Salas, 609\nCarmona do Norte - MG', '65', 'Text Text Text Text Text', NULL, '2020-01-25 19:02:51', '2020-04-24 19:02:51', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(29, 1, 265, 76774, 'Enim molestiae quas voluptatem voluptatem autem dolor voluptatum. Illum possimus culpa dolor voluptatibus illo illum illo. Aliquam praesentium delectus voluptas quis ut eum quia.', 1, 'Fabrício de Arruda Jr. Carvalho', '(71) 3035-5811', '66625-000', '88072-076, Avenida Victor Gil, 8\nBittencourt do Norte - MA', '73', 'Text Text Text Text Text', 2, '2022-02-06 14:36:22', '2022-05-07 14:36:22', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(30, 4, 206, 60820, 'Illum ab natus quia sed ad unde ut et. Non modi quibusdam officiis possimus dolor nulla. Sapiente necessitatibus accusantium veniam aut quia. Qui perferendis et praesentium dolores a.', 2, 'Franco Vieira Fidalgo Sobrinho Galvão', '(77) 4980-6847', '66625-000', '15433-782, Rua Vale, 734. 87º Andar\nSão Kelly - MA', '65', 'Text Text Text Text Text', 3, '2020-12-29 19:01:16', '2021-03-29 19:01:16', '2021-03-20 01:25:03', '2021-03-20 01:25:03');

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
(1, 1, 4, '21', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(2, 1, 1, '5', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(3, 1, 1, '100MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(4, 1, 3, '6', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(5, 1, 10, '8', 'SOLAR_INVERTER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(6, 4, 3, '39', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(7, 4, 1, '4', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(8, 4, 6, '100MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(9, 4, 1, '8', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(10, 4, 5, '9', 'SOLAR_INVERTER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(11, 5, 4, '20', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(12, 5, 1, '3', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(13, 5, 7, '25MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(14, 5, 7, '8', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(15, 5, 10, '9', 'SOLAR_INVERTER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(16, 7, 4, '35', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(17, 7, 1, '4', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(18, 7, 7, '50MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(19, 7, 2, '2', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(20, 7, 2, '2', 'SOLAR_INVERTER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(21, 8, 5, '37', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(22, 8, 1, '3', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(23, 8, 4, '100MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(24, 8, 1, '2', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(25, 8, 8, '1', 'SOLAR_INVERTER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(26, 11, 5, '41', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(27, 11, 1, '4', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(28, 11, 1, '25MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(29, 11, 6, '8', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(30, 11, 12, '1', 'SOLAR_INVERTER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(31, 12, 5, '44', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(32, 12, 1, '1', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(33, 12, 6, '75MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(34, 12, 5, '5', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(35, 12, 5, '8', 'SOLAR_INVERTER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(36, 13, 4, '41', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(37, 13, 1, '1', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(38, 13, 7, '100MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(39, 13, 5, '7', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(40, 13, 3, '9', 'SOLAR_INVERTER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(41, 14, 3, '34', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(42, 14, 1, '1', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(43, 14, 7, '50MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(44, 14, 3, '5', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(45, 14, 11, '5', 'SOLAR_INVERTER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(46, 15, 1, '27', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(47, 15, 1, '3', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(48, 15, 6, '75MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(49, 15, 1, '5', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(50, 15, 4, '1', 'SOLAR_INVERTER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(51, 16, 6, '44', 'GENERATOR', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(52, 16, 1, '3', 'STRING_BOX', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(53, 16, 4, '100MT', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(54, 16, 6, '8', 'OTHER', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(55, 16, 9, '5', 'SOLAR_INVERTER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(56, 17, 5, '49', 'GENERATOR', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(57, 17, 1, '4', 'STRING_BOX', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(58, 17, 3, '100MT', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(59, 17, 6, '3', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(60, 17, 2, '1', 'SOLAR_INVERTER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(61, 20, 3, '26', 'GENERATOR', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(62, 20, 1, '1', 'STRING_BOX', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(63, 20, 2, '100MT', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(64, 20, 6, '7', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(65, 20, 11, '6', 'SOLAR_INVERTER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(66, 21, 6, '29', 'GENERATOR', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(67, 21, 1, '2', 'STRING_BOX', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(68, 21, 5, '25MT', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(69, 21, 7, '5', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(70, 21, 5, '6', 'SOLAR_INVERTER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(71, 23, 1, '28', 'GENERATOR', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(72, 23, 1, '2', 'STRING_BOX', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(73, 23, 7, '100MT', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(74, 23, 4, '6', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(75, 23, 12, '10', 'SOLAR_INVERTER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(76, 24, 3, '20', 'GENERATOR', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(77, 24, 1, '1', 'STRING_BOX', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(78, 24, 4, '25MT', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(79, 24, 3, '4', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(80, 24, 11, '2', 'SOLAR_INVERTER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(81, 25, 3, '36', 'GENERATOR', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(82, 25, 1, '3', 'STRING_BOX', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(83, 25, 1, '50MT', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(84, 25, 6, '4', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(85, 25, 9, '4', 'SOLAR_INVERTER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(86, 26, 5, '32', 'GENERATOR', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(87, 26, 1, '4', 'STRING_BOX', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(88, 26, 7, '25MT', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(89, 26, 1, '8', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(90, 26, 9, '2', 'SOLAR_INVERTER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(91, 29, 1, '24', 'GENERATOR', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(92, 29, 1, '2', 'STRING_BOX', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(93, 29, 7, '100MT', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(94, 29, 7, '7', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(95, 29, 2, '9', 'SOLAR_INVERTER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(96, 30, 3, '20', 'GENERATOR', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(97, 30, 1, '2', 'STRING_BOX', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(98, 30, 7, '25MT', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(99, 30, 2, '6', 'OTHER', '2021-03-20 01:25:04', '2021-03-20 01:25:04'),
(100, 30, 8, '9', 'SOLAR_INVERTER', '2021-03-20 01:25:04', '2021-03-20 01:25:04');

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
(1, 'RS6E-150P', 'Resun', 'Monocristalino', 450, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(2, 'RS6E-150P', 'Resun', 'Policristalino', 150, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(3, 'TSM-PE15H', 'Trina Solar', 'Monocristalino', 405, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(4, 'RS6E-150P', 'Trina Solar', 'Monocristalino', 150, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(5, 'ODA400-36-M', 'OSDA', 'Monocristalino', 400, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(6, 'SA10-36P', 'Sinosola', 'Policristalino', 10, '2021-03-20 01:25:03', '2021-03-20 01:25:03');

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
(1, 'Par de Conectores Femea/Macho Staubli MC4', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(2, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Preto - Multiplo 25 Metros', '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(3, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Vermelho - Multiplo 25 Metros', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(4, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Azul - Multiplo 25 Metros', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(5, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Verde - Multiplo 25 Metros', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(6, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Amarelo - Multiplo 25 Metros', '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(7, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Laranja - Multiplo 25 Metros', '2021-03-20 01:25:03', '2021-03-20 01:25:03');

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
(1, 'ABB', 2, 20, 220, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(2, 'ABB', 2, 60, 380, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(3, 'ABB', 4, 50, 220, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(4, 'ABB', 4, 100, 380, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(5, 'Fronius Eco', 2, 25, 220, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(6, 'Fronius SYMO', 2, 12, 220, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(7, 'Fronius SYMO Brasil', 2, 15, 380, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(8, 'WEG SIW600', 4, 25, 380, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(9, 'WEG SMA', 4, 30, 220, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(10, 'WEG SIW500H ST012', 4, 100, 380, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(11, 'WEG SUN 2000–60KTL-MO', 2, 60, 220, '2021-03-20 01:25:03', '2021-03-20 01:25:03'),
(12, 'WEG SUN 2000–40KTL-MO', 4, 40, 380, '2021-03-20 01:25:03', '2021-03-20 01:25:03');

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
(1, 'Ecosolys', '1000v', '2021-03-20 01:25:03', '2021-03-20 01:25:03');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_01_24_083237_create_sessions_table', 1),
(7, '2021_02_10_044408_create_category_table', 1),
(8, '2021_02_16_072504_create_clients_table', 1),
(9, '2021_02_18_181153_create_logs_table', 1),
(10, '2021_02_22_184126_create_sellers_table', 1),
(11, '2021_02_24_171039_create_contracts_table', 1),
(12, '2021_03_08_142633_create_seller_teams_table', 1),
(13, '2021_03_13_170716_create_equipment_other_table', 1),
(14, '2021_03_13_170814_create_equipment_generator_table', 1),
(15, '2021_03_16_082510_create_equipment_string_box_table', 1),
(16, '2021_03_16_082638_create_equipment_solar_inverter_table', 1),
(17, '2021_03_19_070515_create_contract_product_table', 1);

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
(1, 'Sra. Paloma Perez', 'joaquim49@example.org', '(95) 97793-1845', '66625-000', '28107-902, Largo Natan, 9199. Bc. 6 Ap. 97\nIgor do Leste - TO', '56', 'Text Text Text Text Text', 5, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(2, 'Sr. Guilherme Cristian Colaço', 'maia.cristina@example.com', '(74) 93555-0955', '66625-000', '43589-105, Travessa Nádia Vega, 6663\nNaomi do Sul - AM', '77', 'Text Text Text Text Text', 4, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(3, 'Sra. Luciana Mariah Santiago', 'dverdara@example.net', '(88) 3614-4307', '66625-000', '02774-967, R. Cristiano, 7111\nSão Thalissa - PI', '64', 'Text Text Text Text Text', 23, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(4, 'Sra. Maiara Zaragoça Rezende', 'leal.alessandro@example.com', '(31) 3004-8144', '66625-000', '14745-222, Largo Nicole Quintana, 33677. Bc. 3 Ap. 49\nLeon d\'Oeste - CE', '86', 'Text Text Text Text Text', 22, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(5, 'Carlos Fidalgo Sobrinho', 'alice.branco@example.org', '(11) 3139-0734', '66625-000', '83429-786, Largo Ornela, 3941\nSão Emília do Norte - AM', '70', 'Text Text Text Text Text', 13, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(6, 'Dr. Luciano Wellington Ferraz Filho', 'mpontes@example.com', '(15) 3882-6727', '66625-000', '16557-105, Travessa Teobaldo, 9850. Anexo\nPorto Daiane do Leste - SP', '21', 'Text Text Text Text Text', 12, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(7, 'João Solano Saito', 'marco.flores@example.org', '(55) 4989-0368', '66625-000', '65297-652, Rua William, 62. 733º Andar\nSimone d\'Oeste - RN', '100', 'Text Text Text Text Text', 14, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(8, 'Sra. Heloísa Furtado', 'eloah.rico@example.com', '(82) 91034-8810', '66625-000', '43034-042, Avenida Carlos, 77965. Anexo\nAnita d\'Oeste - RJ', '18', 'Text Text Text Text Text', 4, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(9, 'Maya Valentina Aragão', 'msalas@example.com', '(49) 2798-5428', '66625-000', '34036-659, Avenida Denis Marinho, 87371\nSão Ornela d\'Oeste - MA', '93', 'Text Text Text Text Text', 26, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(10, 'Dr. Arthur Barros Toledo', 'feliciano.ellen@example.org', '(96) 2065-9122', '66625-000', '71061-535, Rua Escobar, 24536. F\nPena do Leste - AM', '64', 'Text Text Text Text Text', 15, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(11, 'Giovane Cervantes Zamana', 'rodrigo11@example.org', '(71) 93582-3407', '66625-000', '88111-973, Rua Maria, 934. Anexo\nSanta Katherine - MG', '37', 'Text Text Text Text Text', 15, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(12, 'Yuri de Souza Garcia Sobrinho', 'erik.vega@example.org', '(16) 96329-4931', '66625-000', '85327-516, Avenida Hugo, 15\nPorto Simone d\'Oeste - CE', '58', 'Text Text Text Text Text', 27, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(13, 'Rafaela Alcantara', 'walter91@example.com', '(84) 4223-3886', '66625-000', '37270-935, Largo Ellen Lozano, 3. Fundos\nVila Horácio - AM', '86', 'Text Text Text Text Text', 22, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(14, 'Dr. Madalena Dirce de Arruda', 'anita74@example.org', '(95) 94619-5003', '66625-000', '32400-509, R. Daiana Grego, 19419\nVila do Norte - AM', '57', 'Text Text Text Text Text', 2, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(15, 'Juliana Mendes', 'cruz.talita@example.com', '(99) 4237-9447', '66625-000', '52480-858, Avenida Pedrosa, 4. Apto 1301\nVila Dayana - BA', '39', 'Text Text Text Text Text', 3, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(16, 'Dr. Sophia Romero', 'joaquin03@example.net', '(33) 98187-8444', '66625-000', '85666-494, R. Pablo, 8\nCamila do Sul - AP', '63', 'Text Text Text Text Text', 4, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(17, 'Fabrício Molina Branco Filho', 'maldonado.benicio@example.com', '(12) 98410-4028', '66625-000', '49581-019, Travessa Francisco Torres, 70001. Bc. 70 Ap. 73\nPorto Téo d\'Oeste - ES', '17', 'Text Text Text Text Text', 3, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(18, 'Dr. Graziela Ortiz Jr.', 'rafael.deoliveira@example.net', '(41) 4612-3046', '66625-000', '87585-381, Rua Vila, 53\nVerdara do Sul - AL', '55', 'Text Text Text Text Text', 26, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(19, 'Srta. Aparecida Eliane da Cruz Neto', 'valentina.vasques@example.net', '(79) 3032-2611', '66625-000', '77154-926, Travessa Heitor, 9821. Apto 4\nGalindo do Sul - BA', '46', 'Text Text Text Text Text', 14, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(20, 'Agustina Salgado Ramos', 'talita53@example.net', '(95) 4993-5789', '66625-000', '44764-598, Rua Rivera, 37586. Fundos\nSão Joana d\'Oeste - ES', '99', 'Text Text Text Text Text', 7, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(21, 'Dr. Juan Marin de Souza', 'escobar.sebastiao@example.net', '(33) 98682-8345', '66625-000', '01047-201, Rua Mônica, 5734. Apto 9015\nSão Renato do Sul - PE', '50', 'Text Text Text Text Text', 22, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(22, 'Sr. Alexandre Tiago Serrano Sobrinho', 'zamana.barbara@example.com', '(61) 90540-4212', '66625-000', '41789-628, Rua Isaac Galhardo, 79\nFelipe d\'Oeste - MG', '28', 'Text Text Text Text Text', 4, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(23, 'Suellen Mia Jimenes', 'davila.sonia@example.net', '(77) 99284-8085', '66625-000', '78179-079, Avenida Amanda, 4976. Bc. 8 Ap. 20\nSão Kevin d\'Oeste - GO', '69', 'Text Text Text Text Text', 10, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(24, 'Dr. Talita Carol Cortês Jr.', 'ferreira.giovanna@example.net', '(53) 94847-9278', '66625-000', '16531-975, Av. Mila, 227. Anexo\nGalvão do Norte - SC', '81', 'Text Text Text Text Text', 14, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(25, 'Sra. Milena Guerra Vieira', 'campos.samara@example.com', '(62) 4333-3515', '66625-000', '67979-408, Avenida Aragão, 7709. Anexo\nVila Valentin do Norte - RS', '24', 'Text Text Text Text Text', 23, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(26, 'Sueli Eunice da Silva', 'msantiago@example.com', '(51) 92904-8391', '66625-000', '62375-343, Rua Antonella Garcia, 4\nSão Demian d\'Oeste - DF', '78', 'Text Text Text Text Text', 5, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(27, 'Sr. Júlio Walter Leal', 'valeria.correia@example.com', '(69) 4637-3104', '66625-000', '26854-066, Travessa Natália Faria, 36011. F\nDuarte d\'Oeste - RJ', '31', 'Text Text Text Text Text', 22, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(28, 'Simão Benedito Cordeiro Neto', 'jasmin48@example.net', '(19) 2031-9795', '66625-000', '68875-309, R. Marques, 3556. Bloco A\nVila José do Sul - RN', '60', 'Text Text Text Text Text', 4, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(29, 'Sr. André Mascarenhas Guerra', 'tgil@example.com', '(92) 3320-3164', '66625-000', '25451-153, Largo Milena Ortega, 5789\nPorto Wesley - AL', '59', 'Text Text Text Text Text', 20, '2021-03-20 01:25:02', '2021-03-20 01:25:02'),
(30, 'Rodolfo Fernando Paes Filho', 'zfaro@example.org', '(24) 3916-9961', '66625-000', '13366-733, Travessa Sônia, 1413\nVila Marco - RO', '63', 'Text Text Text Text Text', 2, '2021-03-20 01:25:02', '2021-03-20 01:25:02');

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
(1, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'da Rosa S.A.'),
(2, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Madeira-Matos'),
(3, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Roque e Cortês'),
(4, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Romero e Valentin e Filhos'),
(5, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Soares-Salazar'),
(6, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Camacho-Brito'),
(7, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Dominato Comercial Ltda.'),
(8, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Salgado e Maia Ltda.'),
(9, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Faria-Maia'),
(10, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Medina Comercial Ltda.'),
(11, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Vila e Ortega'),
(12, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Marin Comercial Ltda.'),
(13, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Cortês Ltda.'),
(14, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Ramires-Carrara'),
(15, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Queirós e Saraiva'),
(16, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Paes-Mascarenhas'),
(17, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Santacruz Comercial Ltda.'),
(18, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Marés-Serra'),
(19, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Santos Ltda.'),
(20, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Saraiva e Matias S.A.'),
(21, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Dias e Associados'),
(22, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Ferraz e Fontes'),
(23, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Queirós-Martines'),
(24, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Camacho Comercial Ltda.'),
(25, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Carrara-Martines'),
(26, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Dias Comercial Ltda.'),
(27, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Santos e Associados'),
(28, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Leal S.A.'),
(29, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Brito e Ferraz e Associados'),
(30, '2021-03-20 01:25:02', '2021-03-20 01:25:02', 'Guerra e Associados');

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
(1, 'Tainara Assunção Jr.', 0, 'queiros.claudio@example.org', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '0s9zeIR6jE', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(2, 'Santiago Máximo Galvão', 0, 'samara.santos@example.com', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '5LoAJQqJpw', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(3, 'Sr. Natal Diogo Padrão', 0, 'dsantacruz@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '65Nurt7fT6', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(4, 'Dr. Julieta Luara Pereira Sobrinho', 0, 'valentin.kleber@example.com', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '7pMMJuwh45', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(5, 'Gabriela Pena Filho', 0, 'umedina@example.com', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'IDxZODjr3h', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(6, 'Alana Rios Filho', 0, 'luiza54@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'AFaL57zdo0', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(7, 'Franciele Paola Mascarenhas Jr.', 0, 'wagner.vega@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'qz3MsV8zFM', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(8, 'Dr. Jennifer Marés Ferreira Neto', 0, 'valente.pedro@example.com', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'UMLHX69bm9', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(9, 'Sr. Samuel Vale Zaragoça Neto', 0, 'assuncao.marina@example.com', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'LDWBtHKvrY', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(10, 'Samara Cecília Reis Jr.', 0, 'xgodoi@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'atzpeIcL3H', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(11, 'Samuel Deverso Neto', 0, 'dortega@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'ZJXXJje5j7', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(12, 'Sr. Wilson Fábio Salas', 0, 'lucas12@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'xGgo2s3Vlc', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(13, 'Breno Wellington Galhardo', 0, 'pgusmao@example.org', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '5BxDPFLntT', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(14, 'Sr. Fábio Oliveira Sobrinho', 0, 'scarrara@example.com', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'yv8Et1MMYY', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(15, 'Amanda Colaço', 0, 'emanuelly.pereira@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'SkGUHidwJo', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(16, 'Sr. Sergio Santos Amaral Sobrinho', 0, 'aguiar.alma@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '7r8jRC816p', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(17, 'Eduardo Fabrício Carmona', 0, 'xsantacruz@example.org', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'WTXR15V1Ww', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(18, 'Srta. Malena Sandra Vieira', 0, 'gferraz@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'jLLGqsGfas', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(19, 'Dr. Thalissa Gusmão Campos Filho', 0, 'agustina73@example.com', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'MY4uEcKNY5', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(20, 'Dirce Gabrielly Pena', 0, 'aburgos@example.com', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'rN9tY1NQWF', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(21, 'Emília Elis Matias Sobrinho', 0, 'esteves.igor@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'Tfzi0smOnO', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(22, 'Sr. Moisés Branco Aragão', 0, 'mlourenco@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'RMBlnRXcMe', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(23, 'Sr. Mário de Freitas Neto', 0, 'valentin.galindo@example.org', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'YT0SRKaClT', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(24, 'Suelen Maraisa das Dores Filho', 0, 'matias.fernandes@example.org', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '5vJ3xAnP0S', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(25, 'Heloísa Graziela Salgado', 0, 'davi55@example.org', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'FjV9eEopqX', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(26, 'Emilly Ester Gonçalves', 0, 'valente.maite@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '03GT3nRRzG', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(27, 'Sr. Yuri Vieira Teles', 0, 'gil.michele@example.org', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '3lWmA1Dsr6', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(28, 'Dr. Enzo Marés Jr.', 0, 'verdugo.joao@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'kEBuoJL5BS', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(29, 'Noemi Montenegro Furtado Sobrinho', 0, 'sanches.richard@example.org', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'MiLiDIocLJ', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(30, 'Joaquin Andres Lovato Jr.', 0, 'velasques.matias@example.net', '2021-03-20 01:25:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'svOaaGTB45', '2021-03-20 01:25:00', '2021-03-20 01:25:00', 2),
(31, 'User Admin', 1, 'admin@admin.com', '2021-03-20 01:25:02', '$2y$10$7oHGVbi5YF6VZRPymMXlbuyQ2oiAfFt9.UC4JNdMDJytBbjEyeZ7i', NULL, NULL, '0', '2021-03-20 01:25:02', '2021-03-20 01:25:02', 1);

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
(1, 'ADMINISTRADOR', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(2, 'ENGENHARIA', '2021-03-20 01:25:00', '2021-03-20 01:25:00'),
(3, 'OPERACIONAL', '2021-03-20 01:25:00', '2021-03-20 01:25:00');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
