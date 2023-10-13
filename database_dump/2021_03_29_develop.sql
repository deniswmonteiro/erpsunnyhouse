-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Mar-2021 às 01:53
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
(1, 'Abgail Gabrielle Matos', 'delgado.diogo@example.org', '(15) 2424-0578', '66625-000', '03802-169, Av. Edilson Fernandes, 672. Bc. 69 Ap. 23\nThomas do Leste - SE', '54', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(2, 'Dr. Isaac Evandro Rico Sobrinho', 'gil.marcos@example.net', '(42) 3975-1950', '66625-000', '61822-492, Largo Joaquim Cervantes, 13\nDelatorre d\'Oeste - RN', '64', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(3, 'Sra. Júlia Verdara Toledo', 'ferminiano.eva@example.org', '(21) 96118-3623', '66625-000', '51946-612, Avenida Galvão, 77\nSão Tiago - AM', '26', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(4, 'Cléber Cordeiro Jr.', 'itamoio@example.org', '(92) 98927-9887', '66625-000', '29656-524, Largo Thalita, 96\nPorto Cléber - RJ', '73', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(5, 'Carla Sofia Zamana Jr.', 'alonso.marques@example.com', '(94) 3192-8162', '66625-000', '09337-683, Travessa Maria Valência, 58035\nFelipe do Sul - PB', '44', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(6, 'Cristiana Lorena Uchoa', 'diogo15@example.net', '(69) 94772-7571', '66625-000', '03680-922, Travessa Lorenzo, 38. Apto 89\nSanta Wagner do Norte - SP', '46', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(7, 'Aparecida Paz de Souza', 'rcorona@example.com', '(75) 4941-5893', '66625-000', '21859-420, Largo Everton Aranda, 9\nDeivid do Norte - MT', '38', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(8, 'Alan das Dores Casanova', 'kauan.aranda@example.org', '(53) 95481-2674', '66625-000', '25588-066, Largo Marques, 6490\nHugo d\'Oeste - RO', '17', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(9, 'Natal Meireles Perez Jr.', 'falcantara@example.net', '(42) 2453-2609', '66625-000', '11724-171, R. Giovana Fontes, 73\nPietra do Sul - MA', '31', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(10, 'Dr. Giovane Matos', 'pablo21@example.net', '(16) 2032-4245', '66625-000', '04360-595, Largo Meireles, 7017\nPereira do Sul - SP', '16', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(11, 'Mônica Espinoza Salazar Sobrinho', 'jserra@example.net', '(74) 95549-9145', '66625-000', '79121-538, R. Tessália Montenegro, 3. Bloco B\nVila Adriana - RO', '41', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(12, 'Sr. Gean Assunção Delgado Sobrinho', 'kcampos@example.net', '(55) 99718-8484', '66625-000', '56267-794, Av. Aranda, 28\nVila Andressa do Leste - SC', '67', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(13, 'Sr. Sandro Saraiva', 'vinicius.soares@example.com', '(85) 4588-5161', '66625-000', '28561-167, R. Ingrid, 70. 111º Andar\nÁvila do Norte - MG', '92', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(14, 'Pablo Medina Barros', 'fmatos@example.org', '(16) 3217-4488', '66625-000', '50224-711, Largo Pena, 7701\nSanta Noel do Sul - RJ', '19', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(15, 'Dr. Mário Galhardo Benites Sobrinho', 'patricia57@example.net', '(14) 3010-9744', '66625-000', '09927-532, Av. Valentin Aguiar, 341. Bc. 9 Ap. 04\nDelgado d\'Oeste - AM', '54', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(16, 'Daiana Melissa Bonilha', 'lia.rangel@example.com', '(98) 95630-4771', '66625-000', '60000-391, Rua Ingrid Padrão, 1293\nSão Sebastião - PI', '43', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(17, 'Cauan Vasques', 'gmascarenhas@example.net', '(19) 3870-5574', '66625-000', '88260-701, R. Christian, 7454\nVila Tábata - MG', '55', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(18, 'Srta. Giovanna Torres Arruda Filho', 'cabreu@example.org', '(82) 3566-9554', '66625-000', '18372-032, R. Gonçalves, 30. Bc. 24 Ap. 48\nTeles do Leste - PB', '56', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(19, 'Dr. Sergio Ivan Valdez Jr.', 'cbenites@example.com', '(42) 90510-9805', '66625-000', '26469-008, Rua Cauan, 859\nSão Leandro - SC', '94', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(20, 'Adriana Mendes Caldeira Sobrinho', 'noeli90@example.net', '(82) 96311-0960', '66625-000', '51782-019, Avenida Vila, 6632\nAlícia d\'Oeste - ES', '18', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(21, 'Elias Paz Neto', 'epacheco@example.com', '(54) 3848-8221', '66625-000', '31169-165, Travessa Marília Urias, 49\nPorto Tatiana - PA', '47', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(22, 'Rafaela Fidalgo Sobrinho', 'lamaral@example.com', '(84) 97646-5335', '66625-000', '28514-977, Av. Ortiz, 665\nVila Emilly d\'Oeste - RR', '34', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(23, 'Bruno Cortês Souza Jr.', 'ortiz.gustavo@example.net', '(46) 3636-7252', '66625-000', '08112-279, Rua Tatiane Barros, 6406\nSão Ester do Leste - AP', '43', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(24, 'Dr. Alessandro Prado Galindo', 'bernardo34@example.com', '(14) 90410-9946', '66625-000', '51682-973, Av. Mariana Cruz, 8\nSanta Tessália d\'Oeste - AP', '15', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(25, 'Srta. Stella Fontes', 'mares.felipe@example.com', '(19) 96863-6163', '66625-000', '80021-486, Travessa Paulo, 5\nPorto Sergio - ES', '28', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(26, 'Dr. Murilo Théo Paes Sobrinho', 'igalvao@example.com', '(74) 97972-5421', '66625-000', '01803-420, Avenida Eunice Gonçalves, 9054\nPorto Bianca do Sul - CE', '71', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(27, 'Mel Daniele Balestero', 'murilo.salgado@example.org', '(74) 99080-4328', '66625-000', '10008-937, Travessa Melissa, 9731\nVila Stella do Leste - ES', '81', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(28, 'Dr. Everton Serna', 'imendes@example.com', '(81) 95004-8412', '66625-000', '78511-010, Avenida Balestero, 5067. Bloco C\nSão Isadora - SE', '69', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(29, 'Débora Vale Solano Jr.', 'lira.natan@example.net', '(91) 94453-0510', '66625-000', '74024-745, Rua Dominato, 361\nVila Gustavo - PB', '79', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(30, 'Srta. Marília de Oliveira Jr.', 'zrosa@example.org', '(93) 3220-7494', '66625-000', '09760-014, Largo Anita, 37. Fundos\nAdriel do Sul - AP', '94', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(31, 'Ian Leon', 'lucia78@example.org', '(22) 93549-1034', '66625-000', '99425-899, Avenida Camila, 3\nBranco do Leste - SE', '78', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(32, 'Vicente Ramires Espinoza Neto', 'luara.paz@example.com', '(67) 90713-5614', '66625-000', '97583-349, Largo Thalia, 41. Bc. 5 Ap. 20\nEvandro do Norte - PB', '94', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(33, 'Sr. Máximo Benjamin Brito', 'darosa.lucio@example.com', '(37) 94124-2582', '66625-000', '07477-802, R. Arthur, 2111. Bloco C\nFranciele do Leste - AC', '58', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(34, 'Srta. Mariana Campos', 'npaes@example.com', '(51) 93618-7691', '66625-000', '12794-520, Av. Gilberto Cruz, 96722\nLorena do Norte - SE', '93', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(35, 'Sr. Martinho Marinho', 'marcos.espinoza@example.com', '(67) 97381-5131', '66625-000', '83923-321, Travessa Daniela Ferraz, 72. 971º Andar\nGalhardo do Leste - AP', '34', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(36, 'Dr. Aaron Ferreira Pontes Neto', 'dcorreia@example.org', '(45) 2809-3586', '66625-000', '36016-382, Largo Flávio Galindo, 83\nVila Andressa do Norte - GO', '37', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(37, 'Mila de Aguiar', 'jdacruz@example.com', '(88) 90007-1982', '66625-000', '82302-777, Travessa Adriano, 420. Fundos\nJorge do Sul - SE', '54', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(38, 'Dr. Filipe Ferreira', 'pontes.mary@example.org', '(75) 97095-0735', '66625-000', '99977-056, Travessa Edson Guerra, 4. 228º Andar\nSanta Ayla - MS', '71', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(39, 'Srta. Cristina de Freitas', 'mirella.aranda@example.com', '(88) 94016-3994', '66625-000', '26326-537, Travessa Gilberto, 94. Bloco C\nLutero d\'Oeste - AP', '94', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(40, 'Sr. Jonas D\'ávila', 'isis.queiros@example.org', '(68) 3228-1339', '66625-000', '95728-602, Av. Nicolas Carmona, 2. F\nFranco do Sul - PR', '15', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(41, 'Sra. Norma Paola Velasques Neto', 'soto.gisele@example.org', '(43) 2974-8265', '66625-000', '30093-919, Av. Josefina Mascarenhas, 1. Apto 9997\nSanta Enzo - MG', '16', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(42, 'Srta. Louise Delvalle Lutero', 'martinho.esteves@example.com', '(15) 3067-4620', '66625-000', '10929-227, Av. Willian, 13\nVila Verônica do Leste - MT', '71', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(43, 'Dr. Rosana Furtado Ortega Filho', 'ornela57@example.org', '(17) 94591-9365', '66625-000', '91302-635, Avenida Maldonado, 7\nMary do Norte - MS', '88', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(44, 'Dr. Alonso Sales Sobrinho', 'paloma.pena@example.net', '(27) 3125-2745', '66625-000', '07015-219, Av. Malu Velasques, 63219\nPorto Ronaldo - MA', '61', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(45, 'Tiago Gian Arruda Jr.', 'duarte.renato@example.net', '(86) 2775-2882', '66625-000', '86289-981, Av. Adriele Pereira, 50150. 759º Andar\nSanta Noemi d\'Oeste - DF', '84', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(46, 'Enzo Danilo Quintana', 'zaragoca.arthur@example.com', '(31) 2656-0654', '66625-000', '94408-285, Travessa Jéssica, 24\nZiraldo d\'Oeste - MA', '93', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(47, 'Agatha Meireles Assunção', 'benites.emilia@example.net', '(95) 96844-5049', '66625-000', '24580-080, Largo Maurício, 9013. Bc. 0 Ap. 33\nSão Paulo - MT', '78', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(48, 'Wilson Campos Verdugo', 'benjamin.medina@example.net', '(93) 97800-9272', '66625-000', '58969-323, Rua Rodrigo, 54690\nVila Carla - MG', '11', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(49, 'Emanuelly Betina Soares', 'amelia71@example.org', '(11) 96535-3650', '66625-000', '84603-356, Av. Marin, 38462. Bc. 1 Ap. 78\nValência do Sul - ES', '28', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(50, 'Dr. Erik Galindo', 'betina.batista@example.org', '(67) 2407-2189', '66625-000', '80458-936, Rua Lozano, 4. 65º Andar\nSão Paulina - AM', '65', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(51, 'Dr. Agatha Matias', 'cristiana20@example.org', '(92) 99034-8941', '66625-000', '19740-934, Largo Mila, 20\nSanta Melina do Norte - DF', '18', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(52, 'Sueli Escobar Neto', 'rodrigues.mayara@example.org', '(33) 93078-3194', '66625-000', '66443-570, Largo Serra, 6\nSanta Sarah do Leste - MS', '57', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(53, 'Dr. Jefferson das Dores Filho', 'cleber.dearruda@example.net', '(86) 3555-4475', '66625-000', '56762-101, R. César, 396. Apto 657\nCampos do Leste - MT', '88', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(54, 'Sra. Mirella Raquel Rosa Sobrinho', 'juliane63@example.org', '(18) 91085-2060', '66625-000', '79435-980, Largo Ferreira, 375. Bloco A\nAguiar do Norte - SP', '21', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(55, 'Sofia Oliveira Neto', 'aragao.paula@example.net', '(21) 4656-3189', '66625-000', '98708-485, Travessa Simon Romero, 8. Apto 7\nSão Renato - RO', '80', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(56, 'Sra. Vitória Lira', 'erosa@example.com', '(73) 3174-7086', '66625-000', '06589-131, Avenida Maldonado, 37. Anexo\nSepúlveda do Leste - MA', '54', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(57, 'Dr. Melissa Fonseca', 'dmendes@example.net', '(84) 98345-1330', '66625-000', '52038-136, Av. Lucas, 58667\nLucas do Norte - SE', '11', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(58, 'Benedito Quintana Solano Filho', 'faria.roberta@example.org', '(71) 4808-2402', '66625-000', '65523-977, Avenida Clara, 46947. Fundos\nVila Arthur - PR', '52', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(59, 'Sr. Caio Ronaldo Matos Sobrinho', 'valentin.bianca@example.net', '(21) 4151-5026', '66625-000', '03369-886, Rua Vale, 18286. 48º Andar\nSão André - AP', '33', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(60, 'Erik Mendonça Ferreira Sobrinho', 'gael78@example.org', '(83) 93700-0237', '66625-000', '40137-424, Avenida Cristian, 64701\nErik do Norte - CE', '23', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(61, 'Sr. Enzo Correia Estrada Jr.', 'emanuel.galhardo@example.net', '(71) 92596-3079', '66625-000', '00176-345, R. Ian Santacruz, 36\nSão Elizabeth do Leste - RN', '61', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(62, 'Alonso Perez Aranda Jr.', 'hugo.sanches@example.net', '(84) 2883-0317', '66625-000', '71695-487, Av. Fidalgo, 52468\nAssunção d\'Oeste - SC', '77', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(63, 'Sra. Lívia Ferminiano Madeira', 'roberto.soto@example.com', '(49) 96216-8370', '66625-000', '20438-666, Rua Nicolas, 4. Bloco A\nFerraz d\'Oeste - PE', '70', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(64, 'Sra. Karen Santos Alves', 'constancia53@example.net', '(45) 3934-1962', '66625-000', '83683-009, Largo Leo, 7. Fundos\nRichard do Sul - AL', '48', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(65, 'Josefina Ramires Neto', 'olivia54@example.net', '(66) 2799-1255', '66625-000', '58685-534, Avenida Maldonado, 72. 462º Andar\nSão Mateus - PA', '18', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(66, 'Sr. Noel Carrara Branco Filho', 'denis.colaco@example.org', '(14) 3604-5824', '66625-000', '26073-608, Largo Lucas Alves, 38\nSanta Valentin do Sul - MS', '92', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(67, 'Dr. Eduardo Mendes Delatorre Sobrinho', 'rangel.bianca@example.com', '(74) 95685-7226', '66625-000', '58533-457, Avenida Salas, 6\nMedina do Leste - PR', '24', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(68, 'Mário Rios', 'larissa44@example.com', '(13) 2452-3263', '66625-000', '87495-162, Av. Martinho, 95775. F\nJuliano do Leste - GO', '87', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(69, 'Esther Carvalho', 'camilo26@example.net', '(14) 92433-2349', '66625-000', '26001-884, Av. Natan Branco, 6. Bloco A\nCorona d\'Oeste - PA', '17', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(70, 'Dr. Tessália Leal Paz Sobrinho', 'talita.matos@example.net', '(91) 2720-6939', '66625-000', '06580-049, R. Ortiz, 2305\nMateus do Leste - CE', '61', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(71, 'Beatriz Elis Madeira', 'martinho.tamoio@example.com', '(82) 4934-8581', '66625-000', '26805-310, Largo Uchoa, 2\nDomingues do Leste - SP', '27', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(72, 'Sr. Murilo Christopher Quintana Filho', 'leon.anita@example.com', '(86) 91401-9169', '66625-000', '35247-064, Av. Vasques, 46. Apto 46\nPorto Cristiana do Sul - SC', '29', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(73, 'Sra. Melissa Lovato Sepúlveda Neto', 'dassuncao@example.net', '(47) 98738-1931', '66625-000', '81776-967, Avenida Eduarda Gonçalves, 27114\nSantos d\'Oeste - DF', '57', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(74, 'Sra. Alícia Helena Santos', 'agostinho83@example.com', '(61) 91215-5919', '66625-000', '53806-958, Largo Moisés Deverso, 9\nVila Kléber - ES', '56', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(75, 'Sra. Mônica de Oliveira Deverso', 'godoi.lidiane@example.org', '(66) 4449-8093', '66625-000', '49635-372, Largo de Aguiar, 9271. Apto 22\nMarcos do Norte - MT', '44', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(76, 'Dr. Gabrielle Carrara', 'thomas.soares@example.org', '(53) 2776-9412', '66625-000', '42754-935, R. Prado, 55\nEverton do Sul - AP', '85', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(77, 'Andres Leonardo Chaves Filho', 'constancia.furtado@example.net', '(37) 95569-1534', '66625-000', '12991-594, Avenida Kléber, 54\nSão Eric do Norte - CE', '33', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(78, 'Sra. Lúcia Assunção Neto', 'joao.pena@example.net', '(77) 4212-2748', '66625-000', '69885-499, R. Ziraldo Rangel, 6\nLouise do Leste - RS', '72', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(79, 'Giovana Marques', 'wesley.vila@example.com', '(46) 99847-0507', '66625-000', '29819-524, Av. Emanuelly Pontes, 6. Bc. 7 Ap. 78\nSão Isabelly do Norte - DF', '17', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(80, 'Sophie Camila Saito', 'vinicius.tamoio@example.net', '(92) 92797-3953', '66625-000', '73759-490, Avenida Vinícius Mendonça, 36827. Anexo\nPorto Daiane do Norte - GO', '75', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(81, 'Sr. Mauro Galindo Filho', 'leandro74@example.com', '(33) 96606-9802', '66625-000', '40135-011, Travessa Erik, 5\nVila Ian do Sul - RS', '71', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(82, 'Milene Fontes Neto', 'vrosa@example.com', '(14) 3133-2056', '66625-000', '88134-803, Av. Toledo, 335\nMárcio do Sul - CE', '43', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(83, 'Ohana Saraiva', 'ohana38@example.com', '(67) 98962-3564', '66625-000', '56876-505, R. Lorenzo, 58834\nToledo do Norte - AM', '78', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(84, 'Samanta Uchoa', 'ayla.feliciano@example.org', '(43) 3975-8100', '66625-000', '82865-107, R. Daniella Ramires, 5590. 311º Andar\nGodói do Sul - AP', '42', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(85, 'Dr. Milena Malu de Aguiar Sobrinho', 'estevao57@example.org', '(77) 2828-8785', '66625-000', '85256-268, Travessa Bittencourt, 365. Bc. 17 Ap. 46\nVila Sofia - DF', '45', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(86, 'Natan Roque Burgos', 'wilson46@example.com', '(75) 2901-1112', '66625-000', '74060-147, Rua Casanova, 9987. Bloco A\nSão Luara d\'Oeste - MT', '30', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(87, 'Dr. Sérgio Everton Ferreira', 'aguiar.luna@example.com', '(44) 3638-1115', '66625-000', '94288-060, Avenida Thalita, 9487. Bloco B\nMarisa do Sul - PB', '34', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(88, 'Dante Chaves Montenegro', 'kzambrano@example.org', '(32) 3751-8771', '66625-000', '20098-721, Av. Madeira, 91. Apto 78\nSão Suelen - ES', '49', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(89, 'Agatha Padrão Neto', 'esteves.josefina@example.org', '(51) 99435-8444', '66625-000', '13186-194, Rua Azevedo, 51. Anexo\nDavi do Leste - MG', '76', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(90, 'Giovane Miguel Colaço Jr.', 'isabelly60@example.net', '(79) 97248-8804', '66625-000', '97830-303, Rua Correia, 6. Bloco C\nSanta Benício - MT', '89', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(91, 'Sergio Pena Urias Jr.', 'svaldez@example.net', '(94) 4718-3316', '66625-000', '12553-592, R. Lira, 2304\nVila Máximo d\'Oeste - MT', '50', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(92, 'Sra. Lívia Benez Sobrinho', 'tamoio.gustavo@example.net', '(82) 93542-6669', '66625-000', '35546-785, Largo Jennifer, 371. Fundos\nLuiz do Leste - DF', '26', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(93, 'Juliane Sanches', 'ivan.ferminiano@example.net', '(54) 95975-3449', '66625-000', '98315-970, R. George Carvalho, 5\nSanta Camilo d\'Oeste - AL', '94', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(94, 'Henrique Valdez de Aguiar Filho', 'saito.nero@example.org', '(87) 4154-8396', '66625-000', '08834-721, Largo Katherine, 1. Apto 9\nSanta Pérola do Leste - CE', '19', 'Text Text Text Text Text', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(95, 'Matheus da Cruz Neto', 'julio.montenegro@example.org', '(91) 4839-1695', '66625-000', '67942-714, R. Miranda, 8\nPorto Adriele - MT', '80', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(96, 'Denise Sarah Aragão Filho', 'samuel.pontes@example.com', '(95) 4341-5760', '66625-000', '49233-824, R. Natan, 6. Apto 4\nTomás do Sul - AL', '47', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(97, 'Jácomo Delgado Rosa Neto', 'hdearruda@example.com', '(49) 91023-0118', '66625-000', '99338-317, Travessa Lozano, 10. Apto 734\nPorto Patrícia - GO', '53', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(98, 'Adriano Garcia Vila Sobrinho', 'hmatias@example.com', '(15) 99974-4576', '66625-000', '87898-531, Travessa Emily Beltrão, 755\nSanta Inácio - PB', '19', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(99, 'Valentina Carolina Rezende', 'kelly97@example.org', '(35) 90126-7094', '66625-000', '65587-315, Av. Paes, 35610. Bc. 5 Ap. 56\nde Aguiar do Sul - RO', '68', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(100, 'Breno Branco Bittencourt', 'alessandro.zambrano@example.net', '(46) 2888-8575', '66625-000', '43498-804, Avenida Hugo Burgos, 48\nSão Ellen do Norte - PA', '12', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(101, 'Srta. Sophia Zamana', 'msoares@example.net', '(32) 4424-3440', '66625-000', '59107-730, Travessa Everton de Freitas, 86\nPorto Violeta do Norte - PR', '23', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(102, 'Sr. Gian Rangel Corona Neto', 'lourenco.gabriela@example.org', '(65) 3634-9926', '66625-000', '22877-523, Rua Enzo Duarte, 42\nNatan d\'Oeste - RR', '33', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(103, 'Sérgio Wagner Ramires Jr.', 'fernando16@example.net', '(63) 93221-1106', '66625-000', '19468-691, R. Bezerra, 340. Fundos\nSão Maicon do Sul - PR', '42', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(104, 'Eduarda Agatha Rosa', 'alcantara.edson@example.com', '(33) 97837-3898', '66625-000', '10736-412, Largo Ícaro, 3468. 00º Andar\nLira do Sul - PB', '90', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(105, 'Sr. Rogério Victor Matias', 'catarina.medina@example.net', '(18) 93890-6767', '66625-000', '39382-315, Largo Agostinho de Souza, 4. F\nRichard do Norte - PI', '67', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(106, 'Malu Amaral Souza', 'montenegro.emilio@example.com', '(67) 3227-4500', '66625-000', '82530-188, R. Rico, 9\nVila Augusto do Leste - PR', '16', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(107, 'Sra. Yohanna Pacheco', 'ecarmona@example.org', '(74) 2457-7199', '66625-000', '57363-718, Av. Betina, 53\nPorto Renata - PB', '74', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(108, 'Heloísa Gisele Vieira', 'xsantana@example.com', '(65) 3619-4426', '66625-000', '59458-407, Travessa Cezar Batista, 2893. 027º Andar\nChaves do Leste - PA', '52', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(109, 'Elias Fidalgo Escobar Neto', 'george.quintana@example.org', '(33) 3082-1802', '66625-000', '66489-249, Av. Leonardo Torres, 68\nPorto Miguel do Leste - MT', '92', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(110, 'Dr. Filipe Maia Fidalgo', 'andre.desouza@example.net', '(54) 95011-4400', '66625-000', '23636-975, Rua Tamoio, 53\nSão Karine - MT', '40', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(111, 'Dr. Leandro Marés', 'pacheco.thais@example.com', '(92) 3148-1831', '66625-000', '38080-449, Av. Gomes, 3108. Apto 4425\nSão Camila - AL', '70', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(112, 'Dr. Ana Molina Valência', 'ariane.fernandes@example.net', '(68) 4980-9187', '66625-000', '37509-081, Travessa Vitória, 29185. 236º Andar\nLeonardo do Norte - AC', '81', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(113, 'Victor da Silva Aragão', 'valentina56@example.com', '(96) 90947-3213', '66625-000', '26243-612, Avenida Dirce Vasques, 175. Bloco B\nAlexa do Norte - SC', '83', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(114, 'Wagner Ricardo Duarte', 'nicolas.teles@example.org', '(54) 90523-9736', '66625-000', '73769-479, Av. Estela, 14\nSimon do Norte - MA', '25', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(115, 'Hortência Aragão Delvalle Jr.', 'godoi.jean@example.net', '(97) 4583-3514', '66625-000', '03390-613, Rua Rodrigo Ortiz, 40\nPorto Rodrigo d\'Oeste - SC', '71', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(116, 'Eva Gabriela Salas Sobrinho', 'renato03@example.org', '(21) 2732-9525', '66625-000', '02006-631, Travessa Elizabeth, 67. Bloco C\nSouza do Norte - RS', '13', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(117, 'Sr. Christian Inácio Corona', 'elias34@example.org', '(94) 95784-3295', '66625-000', '51143-786, Avenida Sepúlveda, 5475\nPorto Elaine - CE', '14', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(118, 'Srta. Verônica Priscila Tamoio', 'saulo.ramires@example.org', '(34) 4172-1105', '66625-000', '25995-591, Largo Maldonado, 66262. Apto 71\nCarlos do Leste - PR', '11', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(119, 'Dr. Josué Augusto Verdugo', 'padrao.malena@example.org', '(31) 98456-9211', '66625-000', '49841-402, R. Pietra, 278\nVila Leandro - MA', '85', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(120, 'Emílio Breno Zambrano', 'marta.lovato@example.net', '(94) 2885-1606', '66625-000', '11110-401, Rua Willian Vieira, 7807. Fundos\nPorto Enzo - MS', '39', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(121, 'Srta. Isabella Alice Franco Neto', 'nicolas46@example.com', '(49) 3824-4204', '66625-000', '06640-974, Avenida Josué Arruda, 9891. Apto 1791\nSanta Tâmara - MS', '95', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(122, 'João Godói Marinho', 'nero15@example.org', '(15) 2669-8291', '66625-000', '77067-829, Largo Luciano Maldonado, 76881. Fundos\nDuarte do Norte - TO', '18', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(123, 'Sr. Dener Mauro Saito Neto', 'ketlin.zaragoca@example.net', '(88) 3036-5564', '66625-000', '00180-598, Rua Ortiz, 344\nSanta Filipe - PB', '10', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(124, 'Júlia Azevedo de Oliveira Filho', 'melina.burgos@example.net', '(95) 4587-6746', '66625-000', '19477-590, R. Caldeira, 650\nSão Alana do Norte - PB', '33', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(125, 'Benedito Medina Marques', 'tomas34@example.org', '(21) 94455-8796', '66625-000', '03155-437, Av. Jonas Galindo, 5\nGonçalves do Sul - ES', '29', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(126, 'Dr. Michelle Lozano Camacho', 'lgalindo@example.com', '(33) 3973-0835', '66625-000', '31694-038, Largo Stephanie, 8841. Anexo\nSanta Paulina do Norte - DF', '68', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(127, 'Giovane Marcelo Garcia', 'dearruda.alessandra@example.net', '(97) 91964-4373', '66625-000', '16918-548, Largo Jasmin, 328. 4º Andar\nNathalia do Norte - BA', '60', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(128, 'Dr. Amélia Diana Duarte', 'mtorres@example.com', '(92) 3676-8299', '66625-000', '02949-303, Largo Walter, 2243\nVila Joaquim do Norte - SC', '50', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(129, 'Sr. Agostinho Solano', 'samara52@example.com', '(22) 3651-6333', '66625-000', '53909-503, Av. Carlos Urias, 44\ndas Neves d\'Oeste - RJ', '35', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(130, 'Michele de Freitas', 'augusto30@example.net', '(97) 2701-7635', '66625-000', '77120-336, Rua Rivera, 9422. Anexo\nSanta Emanuelly - SC', '13', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(131, 'Sr. Leonardo Guerra Neto', 'carolina57@example.org', '(15) 90583-5731', '66625-000', '20221-069, R. Naiara Gonçalves, 27920. Anexo\nRobson d\'Oeste - CE', '70', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(132, 'Dr. Moisés Rogério Queirós', 'ccorona@example.com', '(18) 2845-8233', '66625-000', '00141-468, Rua Molina, 1909. Bloco A\nPorto Anderson do Norte - SC', '83', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(133, 'Dr. David Hugo Quintana Neto', 'cristovao16@example.net', '(63) 97042-1675', '66625-000', '54835-110, Travessa Cristóvão da Silva, 916. 5º Andar\nVila Paula - MT', '50', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(134, 'Téo Wesley Galhardo Neto', 'isabel09@example.com', '(64) 2775-1961', '66625-000', '13573-854, Rua Augusto, 59. F\nSão Adriel d\'Oeste - SC', '69', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(135, 'Larissa Quintana das Dores', 'ylozano@example.org', '(77) 91152-4270', '66625-000', '11457-199, R. Salgado, 51487. Bc. 2 Ap. 07\nWilliam d\'Oeste - PI', '88', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(136, 'Srta. Sônia Adriele Marques', 'maximiano88@example.com', '(16) 3422-2003', '66625-000', '57707-409, Avenida Luciano Ávila, 13. Fundos\nSimon do Leste - SP', '84', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(137, 'Antonella Montenegro Esteves Sobrinho', 'angelica18@example.net', '(64) 96019-0063', '66625-000', '54914-414, Av. Larissa, 13159\nSão Pedro do Norte - MA', '38', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(138, 'Sra. Pérola Isabelly de Oliveira', 'ferraz.gisela@example.net', '(95) 4859-7348', '66625-000', '75869-504, R. Leon, 85. Apto 6097\nVila Tainara d\'Oeste - RO', '59', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(139, 'Sr. Manuel Aguiar Solano', 'heitor70@example.net', '(93) 98998-1794', '66625-000', '60741-577, Rua Bruna Quintana, 56691\nSão Fabrício - RS', '44', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(140, 'George Toledo Filho', 'neves.benicio@example.net', '(41) 3325-2659', '66625-000', '08590-712, Largo Miriam Rivera, 374. 26º Andar\nBezerra do Leste - PR', '16', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(141, 'Maya Flores', 'anita.deoliveira@example.com', '(33) 90015-1010', '66625-000', '45913-937, R. Théo Pena, 24. 94º Andar\nSanta Marina do Norte - RS', '55', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(142, 'Denis Godói', 'valdez.elisa@example.org', '(44) 4582-3496', '66625-000', '27930-826, R. Simon Lourenço, 2. Bloco A\nLorenzo do Sul - RO', '36', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(143, 'Sr. Simão Camacho', 'arezende@example.org', '(21) 94265-8974', '66625-000', '55607-767, Avenida Michelle, 2. F\nFernandes d\'Oeste - PA', '37', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(144, 'Luis de Oliveira Filho', 'daniella56@example.com', '(65) 4712-2292', '66625-000', '57996-896, Largo Cordeiro, 88\nVila Ariana - AP', '27', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(145, 'Dr. Andréia Guerra Sobrinho', 'tiago07@example.org', '(37) 99314-3428', '66625-000', '29474-713, Avenida Constância Verdugo, 59513\nWillian do Leste - RO', '67', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(146, 'Dr. Edilson Guilherme Abreu', 'bgalhardo@example.org', '(84) 93180-8104', '66625-000', '66884-340, Av. Davi, 65\nEsteves do Leste - RN', '46', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(147, 'Andressa Reis Romero Jr.', 'haragao@example.com', '(98) 96136-1739', '66625-000', '22422-860, Largo Emily, 5\nSanta Deivid d\'Oeste - MS', '21', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(148, 'Paula Queirós Neto', 'richard52@example.net', '(97) 3061-4182', '66625-000', '12939-242, Travessa Dirce Martines, 9. Bloco C\nSanta Demian do Sul - RO', '30', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(149, 'Srta. Lívia Cordeiro D\'ávila Neto', 'inacio.carrara@example.com', '(37) 95745-3324', '66625-000', '28429-425, R. Dias, 9860\nVila Everton do Norte - MT', '58', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(150, 'Sr. Alessandro Pedrosa da Silva', 'juan81@example.org', '(75) 96837-1340', '66625-000', '23289-911, Rua Carvalho, 74\nAlves do Norte - AM', '34', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(151, 'Gael Velasques Fontes', 'artur.gomes@example.com', '(51) 93693-4630', '66625-000', '87620-195, Avenida Carlos, 53745. Bloco C\nde Arruda do Leste - SC', '20', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(152, 'Valentin Rico Camacho Sobrinho', 'rgodoi@example.org', '(55) 97228-5468', '66625-000', '94666-442, Avenida Aragão, 7. F\nVila Paola d\'Oeste - RO', '67', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(153, 'Sr. Walter Carvalho', 'alice.oliveira@example.com', '(99) 3315-1654', '66625-000', '69071-751, R. Zambrano, 334. Bc. 11 Ap. 61\nVila Bárbara - AP', '50', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(154, 'Madalena Gabi Delvalle Filho', 'trico@example.net', '(95) 95981-3426', '66625-000', '34038-710, Largo Mila Serna, 38. 891º Andar\nDiana do Sul - MA', '59', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(155, 'Lorena Karine Romero', 'maximo.fidalgo@example.com', '(96) 3749-8368', '66625-000', '92941-957, Av. Kléber Serra, 61866\nGabriel d\'Oeste - AL', '80', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(156, 'Sra. Gisela Tatiane Estrada', 'alonso.beltrao@example.com', '(96) 92322-1640', '66625-000', '35507-025, Av. Alan, 9119. Apto 017\nSanta Josué do Norte - AL', '31', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(157, 'Diana Sara da Silva', 'roque.manuel@example.com', '(93) 4658-9163', '66625-000', '75683-989, Travessa Cristiano, 758. Apto 5\nMary d\'Oeste - BA', '88', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(158, 'Dr. Juan Carvalho Zambrano Sobrinho', 'ccruz@example.org', '(92) 3331-0534', '66625-000', '63180-026, Travessa Marcos Verdugo, 6121\nSão Aline do Norte - PR', '100', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(159, 'Guilherme Campos', 'sanches.raphael@example.net', '(95) 97501-4585', '66625-000', '08990-607, Avenida Afonso, 90\nPorto Marcelo - ES', '49', 'Text Text Text Text Text', '2021-03-29 23:53:19', '2021-03-29 23:53:19'),
(160, 'Sra. Mônica Nayara Vega Sobrinho', 'zaragoca.lais@example.com', '(86) 2862-1897', '66625-000', '93852-794, Travessa Alexandre Dias, 174. Apto 84\nCruz d\'Oeste - AP', '61', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(161, 'Sr. Nelson Queirós Bittencourt Jr.', 'moises67@example.org', '(13) 4379-1584', '66625-000', '41119-464, Largo Thales de Freitas, 33. Bc. 0 Ap. 21\nSanta Emanuel do Leste - SE', '11', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(162, 'Dr. Cíntia Barros', 'queiros.antonella@example.net', '(91) 93460-3240', '66625-000', '09589-187, Avenida Sandra, 9709\nDenise do Leste - PA', '97', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(163, 'Pâmela de Arruda Queirós Filho', 'yserrano@example.net', '(63) 4942-2304', '66625-000', '00245-235, Travessa Leandro, 533. Fundos\nVila Rosana - RS', '24', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(164, 'Agatha Fernandes Roque Neto', 'manuela.galindo@example.com', '(89) 97547-2378', '66625-000', '54473-652, R. Luísa Rosa, 83731. Apto 0\nGil do Leste - SC', '77', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(165, 'Gilberto Leonardo Balestero Jr.', 'xfranco@example.org', '(11) 2689-1621', '66625-000', '03789-380, R. Mônica Velasques, 6983. Bc. 37 Ap. 73\nPaz do Sul - RO', '96', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(166, 'Dr. Maiara Daniella Queirós', 'soares.fatima@example.net', '(37) 3272-4053', '66625-000', '97549-728, Largo Paes, 95\nBalestero do Sul - TO', '22', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(167, 'Joaquim Ferreira', 'jacomo.santacruz@example.com', '(54) 96656-7340', '66625-000', '50590-762, Avenida Rosa, 74\nBranco do Sul - RN', '33', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(168, 'Ronaldo Vila Serrano', 'jdeoliveira@example.net', '(79) 4236-6180', '66625-000', '95124-988, Travessa Camila Rocha, 4304. Bloco C\nDenis d\'Oeste - SP', '90', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(169, 'Evandro Faro Urias Sobrinho', 'olga.romero@example.net', '(42) 90125-4688', '66625-000', '36195-217, Largo Faro, 6\nLaís do Norte - SE', '42', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(170, 'Franco Corona Delatorre Filho', 'everton55@example.org', '(86) 96454-0011', '66625-000', '05871-450, Av. Roberta Brito, 9. Fundos\nPorto Esther - MS', '24', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(171, 'Laiane Mendes Maia', 'defreitas.maximo@example.com', '(43) 97753-2168', '66625-000', '59464-193, Av. Ian Santiago, 1\nPorto Adriel do Norte - SE', '26', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(172, 'Dr. Maurício Colaço Bezerra Filho', 'osantiago@example.com', '(13) 2816-7988', '66625-000', '27905-512, R. Brito, 23\nMauro do Sul - CE', '100', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(173, 'Sr. Manuel Fontes Neto', 'hdelvalle@example.com', '(13) 2859-7976', '66625-000', '96343-265, Av. Betina Salas, 12. 3º Andar\nGil do Sul - AL', '46', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(174, 'Luiz Leal Beltrão Jr.', 'delvalle.heitor@example.net', '(62) 2880-6923', '66625-000', '09461-381, R. Victor, 35\nLeon d\'Oeste - CE', '26', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(175, 'Dr. Vitória Sophie Cordeiro', 'padrao.bianca@example.org', '(12) 93674-2823', '66625-000', '06654-405, Travessa Bittencourt, 12\nGalhardo d\'Oeste - PA', '48', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(176, 'Srta. Malu Graziela Bonilha', 'usales@example.com', '(15) 99434-6087', '66625-000', '99110-151, Rua Cristóvão, 2620. Anexo\ndas Neves do Norte - MA', '92', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(177, 'Alma Maia', 'joao59@example.org', '(67) 4042-5015', '66625-000', '38487-973, Travessa Joaquin Sanches, 1\nVila Cristiano - DF', '12', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(178, 'Anderson Domingues Salas Jr.', 'hcruz@example.org', '(86) 93924-6657', '66625-000', '45071-115, R. César Beltrão, 7117. Apto 6281\nPorto Sheila do Leste - ES', '69', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(179, 'Dr. Wagner Cruz', 'mcasanova@example.com', '(27) 3037-3163', '66625-000', '20928-856, Travessa Alcantara, 559\nVila Elaine d\'Oeste - RJ', '18', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(180, 'Dr. Lúcia Brito Filho', 'agostinho.pedrosa@example.net', '(19) 92191-0641', '66625-000', '74175-526, Largo Azevedo, 2021\nPorto Demian do Sul - PA', '34', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(181, 'Artur Escobar Neto', 'rocha.leia@example.org', '(43) 96791-3363', '66625-000', '35069-193, Rua Mariah, 62300. Bc. 54 Ap. 68\nSophia do Norte - ES', '80', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(182, 'Dr. Luciana Dominato Vieira Jr.', 'ricardo.santacruz@example.com', '(97) 99450-6629', '66625-000', '09856-289, Avenida Agustina, 94\nPorto Denise d\'Oeste - RN', '98', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(183, 'Sra. Sueli Thalita Molina Neto', 'santiago.saulo@example.org', '(89) 3119-4267', '66625-000', '18416-166, Avenida Mila Ortega, 7837\nPorto Abgail do Norte - BA', '75', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(184, 'Mariah Gisele Alves Sobrinho', 'flores.lucio@example.org', '(12) 4066-3265', '66625-000', '19419-943, Largo Aragão, 4529\nNicolas do Norte - RJ', '20', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(185, 'Dr. Michael Wilson Rosa Neto', 'zbarreto@example.org', '(94) 3341-5243', '66625-000', '26522-940, Av. Noemi D\'ávila, 50968\nNeves d\'Oeste - SE', '80', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(186, 'Dr. Richard Christopher Lutero', 'manuel.aguiar@example.org', '(69) 97794-2354', '66625-000', '44600-973, R. Eduardo, 511\nVila Valentin - PI', '80', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(187, 'Sr. Lucas Lucas Neves', 'valentin.madalena@example.net', '(99) 3046-8367', '66625-000', '73320-239, Avenida Paloma, 55987\nMalena do Leste - CE', '32', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(188, 'Evandro Igor Casanova', 'christian.queiros@example.net', '(83) 98501-4486', '66625-000', '49276-859, Travessa Lavínia Assunção, 44903\nVila Cláudio d\'Oeste - TO', '73', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(189, 'Pietra Deverso Valentin Jr.', 'santiago.robson@example.net', '(84) 3844-0214', '66625-000', '15333-634, Largo Théo Dominato, 7669. Apto 994\nNelson do Sul - RN', '28', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(190, 'Srta. Paulina Santacruz', 'maia.sarah@example.com', '(63) 91953-2082', '66625-000', '91621-044, Rua Marques, 108. Bloco B\nAndres d\'Oeste - SP', '81', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(191, 'Raissa Gil Sobrinho', 'grego.carla@example.net', '(94) 91107-7827', '66625-000', '08412-247, Travessa Bittencourt, 96. 637º Andar\nSanta Wagner do Sul - PR', '16', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(192, 'Sra. Flor Thalia Dias', 'nero.neves@example.net', '(88) 95577-2639', '66625-000', '29000-792, Largo Estrada, 204\nWellington do Leste - GO', '45', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(193, 'Mateus Furtado Franco Sobrinho', 'flavio02@example.com', '(98) 95956-1930', '66625-000', '33517-607, Travessa Rogério Medina, 50502\nCarvalho d\'Oeste - RO', '31', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(194, 'Graziela Feliciano', 'rogerio93@example.com', '(48) 91240-6839', '66625-000', '75664-641, R. Cervantes, 55626. Bloco B\nVila Martinho do Leste - SC', '37', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(195, 'Leonardo Quintana Teles Filho', 'simon.romero@example.net', '(73) 4768-7888', '66625-000', '63789-287, R. Valdez, 6424. Bloco C\nSanta Ohana - SE', '52', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(196, 'Manoela Tábata Santos', 'enzo.gomes@example.net', '(42) 94869-6423', '66625-000', '20191-672, Largo Ariane das Neves, 234. Apto 253\nSão Simon - PR', '37', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(197, 'Nayara Stephanie Neves', 'anita.lira@example.net', '(12) 2196-4554', '66625-000', '89962-983, Av. Enzo, 63678\nPorto Giovana do Leste - AC', '29', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(198, 'Sra. Mila da Silva', 'elisa59@example.org', '(12) 98629-8764', '66625-000', '50553-085, Av. Yasmin Carrara, 597\nEliane do Sul - SP', '83', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(199, 'Dr. Davi Estrada', 'lutero.guilherme@example.org', '(11) 90590-6199', '66625-000', '46999-474, Av. Ziraldo, 8\nRosa do Leste - AM', '67', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(200, 'Maria Salas Filho', 'grego.luan@example.org', '(14) 4475-8338', '66625-000', '50785-553, Travessa Pereira, 7\nRichard d\'Oeste - RJ', '89', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(201, 'Sr. Simon Allan Serra', 'hortencia.aranda@example.com', '(38) 96212-7301', '66625-000', '32352-580, Rua Guerra, 55066\nElias do Norte - AP', '32', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(202, 'Dr. Lorenzo Raphael Romero', 'tperez@example.com', '(38) 4533-1062', '66625-000', '35549-034, Travessa Duarte, 9\nAriana do Sul - RJ', '71', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(203, 'Dr. Maurício Medina Saraiva Filho', 'reis.vicente@example.com', '(81) 3894-0633', '66625-000', '75038-918, R. Pacheco, 9229\nMárcio do Leste - AM', '94', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(204, 'Louise Casanova Sepúlveda Filho', 'aaron41@example.org', '(67) 90272-2053', '66625-000', '82650-186, Rua Alícia Vale, 8764\nRegiane do Norte - PA', '53', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(205, 'Ornela Queirós', 'zdomingues@example.net', '(19) 4146-7882', '66625-000', '61703-405, Rua Alonso Salas, 9754\nVila Marcos - AP', '36', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(206, 'Anita Branco Mascarenhas Jr.', 'fontes.amanda@example.com', '(11) 92286-1969', '66625-000', '94420-869, Av. Ícaro, 58540\nGael do Leste - AL', '35', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(207, 'Elisa Madeira', 'leonardo29@example.org', '(82) 94475-7924', '66625-000', '81089-524, Av. Carlos Bittencourt, 25\nSaraiva do Leste - RR', '100', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(208, 'Madalena Cervantes Lovato Filho', 'beltrao.perola@example.org', '(97) 3592-7781', '66625-000', '66933-905, Avenida Giovanna Dias, 37. 5º Andar\nDaniel do Sul - ES', '13', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(209, 'Dr. Deivid Benez Soto Filho', 'emerson59@example.com', '(47) 96140-7875', '66625-000', '71937-888, Rua Marta, 41\nGuerra do Norte - AL', '86', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(210, 'Benjamin Madeira Brito Neto', 'avila.rayane@example.org', '(53) 4088-8837', '66625-000', '30690-107, Rua Luísa Escobar, 553\nSão Simão do Norte - RS', '70', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(211, 'Naomi Marin Neto', 'artur.rezende@example.org', '(12) 2872-4913', '66625-000', '78273-651, Largo Josué Cordeiro, 9138\nSão Clara - BA', '47', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(212, 'Arthur Emerson Pedrosa Filho', 'queiros.george@example.com', '(19) 97408-2969', '66625-000', '35125-431, Rua Aranda, 7. Bloco C\nPorto Simão - BA', '91', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(213, 'Valéria Gusmão', 'iduarte@example.org', '(38) 4485-4730', '66625-000', '93096-721, Largo Paes, 2790. Apto 7000\nMarques do Norte - GO', '75', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(214, 'Dr. Abgail Pâmela Vale Jr.', 'estela.vila@example.org', '(92) 4726-4888', '66625-000', '28749-152, Av. Gisela, 77861. 607º Andar\nVila Filipe - AP', '53', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20');
INSERT INTO `client` (`id`, `name`, `email`, `phone`, `cep`, `address`, `address_number`, `complement`, `created_at`, `updated_at`) VALUES
(215, 'Sra. Alice da Cruz Maia', 'carvalho.rogerio@example.com', '(19) 3762-1104', '66625-000', '12749-860, Av. Santiago, 919\nMatias do Leste - RJ', '97', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(216, 'Dr. Adriana Molina', 'walter39@example.com', '(31) 3227-6860', '66625-000', '14759-408, Avenida Fontes, 21. F\nSanta Maitê do Norte - PB', '58', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(217, 'Srta. Adriana Chaves Quintana Neto', 'rezende.thiago@example.com', '(92) 96032-8084', '66625-000', '13066-928, R. Karina, 7863\nSão Gisele do Norte - BA', '53', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(218, 'Sra. Tábata Letícia Salazar', 'mayara.aranda@example.com', '(48) 3510-9923', '66625-000', '19617-996, Rua Cauan Jimenes, 9\nAriane do Sul - CE', '58', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(219, 'Leonardo Duarte Jr.', 'ramires.elizabeth@example.net', '(65) 3355-6458', '66625-000', '00001-198, Avenida Isabelly da Rosa, 5169. Bc. 9 Ap. 57\nVila Michele do Norte - AM', '78', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(220, 'Dr. Gabriel Rocha Jr.', 'vsanches@example.net', '(63) 92857-9830', '66625-000', '22679-142, Rua Carol Batista, 6135. Apto 1\nSanta Melinda - TO', '20', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(221, 'Simon Zambrano Neto', 'martines.jose@example.net', '(93) 2240-3264', '66625-000', '53768-132, R. Domingues, 49. Apto 40\nElisa do Leste - MS', '67', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(222, 'Dr. Laís Teles Jr.', 'amatos@example.com', '(44) 3655-4475', '66625-000', '15767-182, Av. Allan, 38. Bloco C\nPorto Mariana do Sul - PB', '39', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(223, 'Sr. James Matias Neto', 'aragao.nicolas@example.com', '(99) 90586-3425', '66625-000', '48843-214, R. Pietra Esteves, 8693\nSão Isadora do Sul - AL', '54', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(224, 'Elias da Silva Salgado Sobrinho', 'vromero@example.org', '(13) 97075-7448', '66625-000', '60665-071, Largo Márcia, 1693. Anexo\nQuintana d\'Oeste - ES', '75', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(225, 'Kléber Sandro Rivera Neto', 'amarin@example.com', '(54) 3248-4460', '66625-000', '58223-104, Travessa Murilo Fontes, 7814. Bc. 16 Ap. 14\nIsabella do Sul - SE', '79', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(226, 'Sra. Maísa Santiago Brito', 'rmadeira@example.com', '(35) 2628-7204', '66625-000', '40736-064, Rua Matias, 1\nPorto William - MT', '50', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(227, 'Marina Chaves Matias', 'deoliveira.tamara@example.org', '(15) 94488-4769', '66625-000', '06303-997, R. Leandro Deverso, 9021\nSanta Teobaldo - MS', '86', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(228, 'Karen Sueli Ferreira', 'christopher53@example.com', '(21) 91373-0421', '66625-000', '79978-237, Rua Serrano, 135. Apto 049\nJoaquin do Norte - DF', '97', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(229, 'Dr. Lucio Galindo Aragão', 'luciano.romero@example.org', '(44) 96659-2198', '66625-000', '09575-493, Av. Alexandre, 32\nVila Joana do Norte - SP', '89', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(230, 'Ronaldo Diego Sanches Neto', 'laura87@example.net', '(43) 98791-0448', '66625-000', '84406-138, Largo Gomes, 6\nIsadora d\'Oeste - PB', '32', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(231, 'Dr. Matias Rezende Flores Filho', 'lucia.vieira@example.net', '(41) 3924-7887', '66625-000', '38121-366, Rua Melina, 41931\nSerrano d\'Oeste - CE', '35', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(232, 'Dr. Kevin Teles Salgado', 'dener68@example.com', '(28) 4949-4334', '66625-000', '81134-407, Travessa da Rosa, 5512\nEsteves do Sul - TO', '50', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(233, 'Dante Nicolas Batista', 'heloisa.caldeira@example.org', '(53) 97622-8461', '66625-000', '60624-248, Rua Madeira, 3498. Bloco B\nCarvalho do Leste - SP', '55', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(234, 'Sra. Paloma Verdugo', 'pvila@example.org', '(63) 97925-8369', '66625-000', '68875-247, Rua Manuela, 1175. F\nSanta Milena do Norte - RO', '21', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(235, 'Afonso Meireles Montenegro Jr.', 'ronaldo68@example.com', '(77) 4390-8394', '66625-000', '48407-970, Largo Bittencourt, 330\nPorto Mauro do Sul - PR', '76', 'Text Text Text Text Text', '2021-03-29 23:53:20', '2021-03-29 23:53:20'),
(236, 'Manuel Fábio Saito Neto', 'cristian82@example.org', '(94) 4894-7609', '66625-000', '41515-740, R. Simon Vega, 87668\nBeatriz d\'Oeste - CE', '46', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(237, 'Nathalia Fidalgo', 'adriele00@example.net', '(28) 91519-3537', '66625-000', '65014-164, Travessa da Cruz, 64105\nThalissa do Leste - CE', '41', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(238, 'Sr. Antônio Lucio Espinoza', 'raphael.dacruz@example.com', '(64) 2699-2691', '66625-000', '78538-817, Av. Wagner Maia, 6603\nSão Christopher do Sul - ES', '43', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(239, 'Daniel Vieira Sobrinho', 'rezende.heitor@example.org', '(62) 2804-6289', '66625-000', '11193-313, Rua Hugo Galindo, 89851\nPorto Nayara - RR', '12', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(240, 'Adriele Brito de Aguiar Sobrinho', 'antonella.solano@example.org', '(34) 99411-5537', '66625-000', '59058-126, Avenida Deivid, 76805. F\nSão Benjamin do Sul - ES', '27', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(241, 'Srta. Carla Samara Perez Jr.', 'raphael.valentin@example.com', '(64) 2500-7053', '66625-000', '92713-680, Largo Alcantara, 8. Anexo\nRivera do Norte - ES', '68', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(242, 'Taís Roque Lourenço Jr.', 'yalves@example.com', '(92) 92130-4887', '66625-000', '87809-223, R. Alessandro, 8443. Bc. 88 Ap. 56\nSanta Ellen - MS', '81', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(243, 'Dr. Michael Emerson Delgado', 'benicio12@example.net', '(87) 4475-7825', '66625-000', '72387-885, Travessa Guilherme, 580. Apto 680\nFonseca d\'Oeste - SC', '20', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(244, 'Dr. Denis Espinoza', 'bsantiago@example.org', '(61) 90184-6857', '66625-000', '88405-754, Av. Lorenzo, 44. Apto 547\nSanta Franciele do Sul - RJ', '75', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(245, 'Sr. Hugo Vale', 'xfernandes@example.org', '(33) 4576-8821', '66625-000', '02611-599, Travessa Irene de Arruda, 53. Bloco B\nVila Christopher - RJ', '31', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(246, 'Sr. Pedro da Silva Serna', 'lozano.elis@example.net', '(77) 4053-5017', '66625-000', '34218-396, Travessa Maria, 95. Apto 58\nTeobaldo do Norte - AC', '66', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(247, 'Hortência Maia', 'stella46@example.org', '(22) 2212-5684', '66625-000', '51730-814, Travessa Romero, 7\nGabi do Norte - CE', '77', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(248, 'Dr. Thales Delgado', 'psoto@example.com', '(28) 97810-2224', '66625-000', '65879-378, Largo Aurora Carvalho, 799. 180º Andar\nHeitor do Leste - RJ', '50', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(249, 'Sr. Guilherme Rafael Ávila Neto', 'urias.gisela@example.com', '(27) 4752-7600', '66625-000', '48713-656, Avenida Santana, 38792\nMurilo do Norte - AP', '60', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(250, 'Sra. Clarice Fernanda Valentin Jr.', 'denise96@example.org', '(69) 3839-5844', '66625-000', '35740-833, Largo Jimenes, 54328. Anexo\nAlessandra do Sul - TO', '65', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(251, 'Srta. Micaela Carmona Filho', 'freis@example.org', '(73) 2725-9819', '66625-000', '76785-095, Avenida Franciele Molina, 635\nOtávio do Norte - PI', '87', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(252, 'Srta. Melina Ruth Sepúlveda Neto', 'leon.alexandre@example.net', '(48) 98627-1457', '66625-000', '91546-434, Travessa Gustavo Delatorre, 3167\nSanta Kamila do Leste - AM', '57', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(253, 'Ariane Melinda Bonilha Sobrinho', 'juchoa@example.com', '(47) 3297-5803', '66625-000', '57821-900, Avenida da Silva, 6581. Bloco B\nFonseca do Norte - TO', '81', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(254, 'Bianca Alves Salazar Jr.', 'ingrid.valente@example.org', '(21) 2365-4302', '66625-000', '64893-965, Av. Gilberto Saito, 68543\nDanielle do Leste - CE', '73', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(255, 'Sr. Allan Pedro Delatorre', 'gilberto84@example.net', '(32) 4154-2634', '66625-000', '58605-686, Largo Diego, 95572\nIgor d\'Oeste - SP', '37', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(256, 'Srta. Mila Feliciano D\'ávila', 'sepulveda.mauricio@example.com', '(85) 90836-7727', '66625-000', '82446-623, R. Carlos da Cruz, 2028\nSão Agustina - AC', '47', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(257, 'Sr. Natal Ícaro Serna Filho', 'molina.alessandro@example.net', '(31) 97115-8919', '66625-000', '75233-046, Largo Dias, 3\nPorto Sergio do Norte - SE', '42', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(258, 'Srta. Emilly Cláudia Faria Filho', 'franco.deaguiar@example.org', '(74) 4527-9699', '66625-000', '78354-358, Largo Maya Benites, 9623\nPorto Bia do Norte - PB', '52', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(259, 'Evandro Miguel Serrano', 'ourias@example.com', '(35) 91639-6595', '66625-000', '94419-517, R. Estrada, 8464\nVila Michael - MT', '24', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(260, 'Danielle Padrão Jimenes Filho', 'beltrao.alonso@example.org', '(45) 3384-2311', '66625-000', '53112-288, Avenida Heloísa, 66836\nCatarina do Leste - MA', '17', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(261, 'Dr. Viviane Benites', 'valentin.marin@example.net', '(53) 2940-5882', '66625-000', '84421-066, Rua Correia, 24216\nJoão do Leste - RS', '77', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(262, 'Lucas Leon Alves Neto', 'pescobar@example.com', '(94) 3596-8948', '66625-000', '83314-958, Travessa Uchoa, 8. 391º Andar\nDelgado do Sul - AP', '61', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(263, 'Srta. Franciele Rocha Tamoio', 'natal45@example.com', '(86) 2123-8107', '66625-000', '20540-001, Travessa Paulina, 4. Apto 1984\nJerônimo do Leste - RN', '55', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(264, 'Giovanna Barreto Duarte', 'allan.deaguiar@example.org', '(91) 3730-7503', '66625-000', '15019-884, Largo de Freitas, 18862\nSanta Pietra - DF', '73', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(265, 'Sr. Ivan Tomás Santacruz Sobrinho', 'ortega.thalita@example.com', '(16) 4980-3555', '66625-000', '43162-406, Av. Sérgio Ortiz, 73268\nDiogo do Sul - RR', '12', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(266, 'André Zambrano Padrão Sobrinho', 'ferraz.ester@example.org', '(61) 98231-8826', '66625-000', '22108-446, R. Eric Rosa, 6. Bloco A\nLuiz d\'Oeste - SC', '48', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(267, 'Natal Souza Alves', 'padrao.mia@example.org', '(14) 3376-0674', '66625-000', '20177-606, Avenida Vega, 5930\nPorto Júlio - SE', '53', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(268, 'Dr. Stella Gomes Sales Neto', 'joaquim.matias@example.net', '(61) 2936-1935', '66625-000', '21280-276, Av. Fonseca, 10107. Anexo\nSão Cristiano - MS', '34', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(269, 'Dr. Denise Prado Sobrinho', 'fonseca.rodolfo@example.com', '(34) 94634-7114', '66625-000', '43788-702, Rua Rezende, 9848\nSão Lara - RJ', '79', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(270, 'Ketlin Rodrigues Gil Neto', 'dirce.cervantes@example.com', '(93) 4766-7526', '66625-000', '57638-568, Travessa Juan, 46. 212º Andar\nCruz do Norte - PR', '30', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(271, 'Srta. Agatha Jaqueline Amaral Jr.', 'noel10@example.org', '(98) 95035-1815', '66625-000', '07549-259, Travessa Mirella, 6. Bc. 66 Ap. 09\nPorto Wagner - PA', '96', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(272, 'Sr. Mateus Faro Guerra Jr.', 'rodrigues.sofia@example.com', '(64) 97353-1007', '66625-000', '07923-629, Avenida Matheus, 68731\nSão Davi do Sul - MG', '71', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(273, 'Estêvão Téo Marinho', 'santos.wesley@example.net', '(81) 97496-0241', '66625-000', '77694-871, R. Josué Aguiar, 360. 80º Andar\nValdez do Leste - MS', '45', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(274, 'Sr. Roberto Rocha', 'estrada.pablo@example.com', '(41) 4841-3304', '66625-000', '64050-077, Rua Allan, 77643. 355º Andar\nPorto Luan - GO', '10', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(275, 'Dr. Janaina Colaço Filho', 'idelvalle@example.org', '(97) 3296-4668', '66625-000', '35432-835, Travessa Luiz, 6. 76º Andar\nVila Andréia - TO', '54', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(276, 'Dr. Marco Duarte Rosa', 'defreitas.livia@example.com', '(83) 98800-9953', '66625-000', '44613-270, Largo Antônio, 193\nVila Amélia - AM', '100', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(277, 'Edson de Aguiar Mendes Neto', 'fernando.sales@example.org', '(98) 2023-1697', '66625-000', '22694-641, Av. Yuri Rico, 681. Anexo\nMaurício do Norte - AC', '82', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(278, 'Dr. Téo Demian Santiago', 'fmatias@example.org', '(46) 92641-1653', '66625-000', '99165-744, R. Jerônimo, 6290. Apto 417\nVila Edilson - ES', '87', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(279, 'Sr. Sérgio Davi Brito', 'edson.sandoval@example.net', '(96) 99556-8978', '66625-000', '37340-669, Rua Duarte, 61. F\nPorto Gian - MA', '47', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(280, 'Louise Delgado Fonseca', 'kauan.goncalves@example.org', '(55) 2275-0034', '66625-000', '96044-854, Rua Dante Romero, 503\nSaraiva do Leste - RS', '14', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(281, 'Lavínia Delvalle', 'godoi.sara@example.org', '(19) 98126-2682', '66625-000', '67789-321, Av. de Souza, 4\nda Cruz do Norte - CE', '84', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(282, 'Dr. Dener Cervantes Ferreira Filho', 'simone14@example.org', '(99) 2930-2370', '66625-000', '52904-906, Travessa Maurício Rangel, 1224\nVila Eric d\'Oeste - PE', '61', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(283, 'Francisco Rezende de Freitas Sobrinho', 'rdarosa@example.com', '(84) 3792-4127', '66625-000', '58391-318, Travessa Helena, 38. Apto 7468\nPorto Heloise do Sul - CE', '50', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(284, 'Benjamin Reis Santos Neto', 'tainara.saraiva@example.net', '(16) 4219-4209', '66625-000', '80316-692, Rua Rosana, 61621\nNoel d\'Oeste - AM', '18', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(285, 'Aaron Molina Vale Filho', 'lmendes@example.org', '(71) 95738-5783', '66625-000', '67715-081, R. Velasques, 8743. 36º Andar\nVila Artur d\'Oeste - PE', '88', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(286, 'Hortência Rodrigues', 'goncalves.agostinho@example.com', '(75) 3484-9797', '66625-000', '92343-690, Largo Gisele, 659\nBreno do Norte - SP', '81', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(287, 'Dr. Leandro Pontes Souza', 'paloma.fontes@example.net', '(87) 2694-7370', '66625-000', '73988-586, Avenida Serrano, 99528. Bloco B\nKevin d\'Oeste - AL', '43', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(288, 'Stefany Godói Sobrinho', 'josefina28@example.net', '(42) 2420-0717', '66625-000', '94736-531, Travessa de Freitas, 5. Fundos\nMatias do Leste - AP', '66', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(289, 'Sra. Hortência Allison Vila Jr.', 'agustina.gusmao@example.org', '(19) 3011-2391', '66625-000', '90077-225, Largo Andressa, 98\nLuciana do Leste - PI', '74', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(290, 'Anita Mendes', 'isaac.ortiz@example.com', '(43) 95081-6716', '66625-000', '48991-829, R. Manoela, 9. Bloco B\nCortês do Sul - CE', '26', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(291, 'Josué Ramires Padrão', 'deivid.soto@example.com', '(24) 98516-1071', '66625-000', '75372-380, Largo Fernanda, 6044\nPorto Roberto do Sul - TO', '91', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(292, 'Sr. Ricardo Lucio Maia', 'gabrielly.flores@example.org', '(11) 4230-5607', '66625-000', '75134-079, Largo Saito, 52554. Bc. 5 Ap. 25\nSanta Manuel - PI', '68', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(293, 'Franciele Camacho', 'urias.suzana@example.net', '(54) 98570-1472', '66625-000', '43224-480, Largo Juan, 51552. 9º Andar\nArruda do Leste - GO', '25', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(294, 'Moisés Santacruz Sobrinho', 'noa.assuncao@example.net', '(34) 94226-6923', '66625-000', '58620-458, Largo Diogo Galindo, 9561\nBrito do Sul - MS', '62', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(295, 'Dr. Raysa Rafaela Fontes Neto', 'pablo.galvao@example.com', '(65) 94782-4533', '66625-000', '77443-217, Largo Joaquim Barreto, 4. Apto 24\nFlores do Sul - RJ', '39', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(296, 'Dr. Afonso Pena', 'andrea56@example.com', '(92) 96941-6790', '66625-000', '06345-165, Avenida Antônio, 92. Apto 39\nRivera do Leste - AC', '45', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(297, 'Dr. Estêvão Saraiva Uchoa Filho', 'padrao.malena@example.net', '(74) 2441-4040', '66625-000', '30986-082, Rua Camila Verdugo, 77\nSão Paulina d\'Oeste - PB', '25', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(298, 'Santiago Montenegro Serrano', 'hdasilva@example.net', '(63) 2185-1297', '66625-000', '45800-516, Largo Queirós, 398. 997º Andar\nFlávia do Sul - DF', '18', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(299, 'Ivana Dayane Corona', 'jacomo.feliciano@example.com', '(18) 92222-8274', '66625-000', '41664-575, Rua Gonçalves, 23173\nFlores do Leste - PR', '39', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21'),
(300, 'Thiago Oliveira Gomes', 'kelly58@example.com', '(65) 3298-1627', '66625-000', '24665-934, Avenida Ornela, 7. Bc. 46 Ap. 09\nZiraldo do Norte - AM', '73', 'Text Text Text Text Text', '2021-03-29 23:53:21', '2021-03-29 23:53:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contract`
--

CREATE TABLE `contract` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` longtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDENTE',
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
(1, 'PENDENTE', 16, 207, 65538, 'Laborum voluptate quod et nulla inventore nobis. Dolores nulla fugiat nemo cumque voluptate ut illo. Omnis voluptate ad omnis veritatis fuga sequi est. Eos ex aut enim alias itaque et est.', 2, 'Ziraldo Michael Deverso Bezerra', '(12) 96984-2479', '66625-000', '49797-677, Avenida Bonilha, 58\nSão Willian do Sul - BA', '59', 'Text Text Text Text Text', NULL, '2022-08-16 20:42:45', '2022-11-14 20:42:45', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(2, 'PENDENTE', 8, 35, 48373, 'Ex delectus repellendus deleniti dolores culpa sit. Itaque saepe iusto omnis minima quam dolor alias. Voluptas consequuntur nemo sed sequi. Dolor itaque reprehenderit quam rem quae qui illum.', 2, 'Patrícia Rios Faria', '(54) 95947-2228', '66625-000', '81086-791, Largo Simon Meireles, 327. Apto 4118\nMendes d\'Oeste - CE', '92', 'Text Text Text Text Text', NULL, '2021-02-18 04:35:15', '2021-05-19 04:35:15', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(3, 'PENDENTE', 22, 49, 19110, 'Excepturi omnis commodi aliquam optio est quia. A modi molestiae ducimus aut necessitatibus est.', 1, 'Cristiano Guerra Salazar', '(38) 91515-8173', '66625-000', '82817-839, Avenida Grego, 3428. Bc. 27 Ap. 43\nQuintana do Sul - ES', '17', 'Text Text Text Text Text', 2, '2021-07-30 09:38:29', '2021-10-28 09:38:29', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(4, 'CONCLUÍDO', 5, 283, 55688, 'Voluptatem est sit cum ducimus blanditiis cupiditate. Quia et eos nihil aut. Quos consequatur distinctio est aut sint porro deserunt. Fugit eos ex alias ipsa molestias autem.', 1, 'Dr. Renan Ferreira Jr. Gomes', '(48) 94455-5884', '66625-000', '23857-525, Rua Emily Pereira, 994. 293º Andar\nFontes do Leste - RS', '58', 'Text Text Text Text Text', 1, '2021-03-30 00:23:33', '2021-06-28 00:23:33', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(5, 'CONCLUÍDO', 20, 270, 12622, 'Aspernatur aut amet porro est sunt. Maxime nihil illum sit. Consequatur hic odio voluptatem veniam minima voluptatem error.', 2, 'Eduarda Branco Jr. Rocha', '(67) 96739-2116', '66625-000', '58611-615, Avenida Everton Ferreira, 9\nVila Ricardo d\'Oeste - DF', '82', 'Text Text Text Text Text', NULL, '2020-11-30 14:28:27', '2021-02-28 14:28:27', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(6, 'EM ANDAMENTO', 6, 275, 53405, 'Modi impedit dolorum dolorum occaecati enim. Repellat sit quam molestiae amet praesentium. Omnis fugit distinctio est est laborum nulla.', 1, 'Sr. César Soares Fontes', '(83) 4425-9992', '66625-000', '34565-061, Travessa Lucio Rivera, 45055\nVila Robson do Sul - GO', '34', 'Text Text Text Text Text', 1, '2022-09-11 12:23:08', '2022-12-10 12:23:08', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(7, 'EM ANDAMENTO', 1, 273, 67127, 'Sit sunt nobis et sit voluptatem fugiat. Ut rerum eum excepturi iure sunt consequatur. Cum amet laborum aut quo et eveniet. Est nam quisquam nesciunt omnis ratione dignissimos veritatis.', 2, 'Sergio Carrara Neto Matos', '(61) 93195-0303', '66625-000', '92083-879, Rua Vinícius, 904. Apto 5\nSanta Raissa - PB', '31', 'Text Text Text Text Text', NULL, '2021-03-16 09:56:57', '2021-06-14 09:56:57', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(8, 'PENDENTE', 4, 60, 44335, 'Vitae aut repellendus fugit dolorem unde eum aut. Laborum quo similique est sed illo incidunt. Laudantium expedita minus et necessitatibus.', 2, 'Ester Azevedo Fontes', '(42) 3384-1951', '66625-000', '20566-159, Largo de Freitas, 5\nSão Wellington - MA', '80', 'Text Text Text Text Text', NULL, '2020-11-03 06:44:17', '2021-02-01 06:44:17', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(9, 'CONCLUÍDO', 2, 86, 32927, 'Nam quibusdam provident quo error. Veritatis omnis et praesentium quibusdam. Ab in porro et sunt consequatur omnis.', 1, 'Srta. Eloá Cordeiro Soto Filho Flores', '(34) 4637-9340', '66625-000', '32357-824, Av. Urias, 113. Fundos\nSanta Dener do Sul - RS', '65', 'Text Text Text Text Text', 1, '2022-09-18 14:55:57', '2022-12-17 14:55:57', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(10, 'EM ANDAMENTO', 30, 232, 11802, 'Dolorem quod sed rerum fugiat sed nostrum. Amet similique quod et magnam. Nihil aliquid facilis ea.', 1, 'Srta. Lidiane Denise Faria Campos', '(47) 3830-1730', '66625-000', '70656-846, Rua Rebeca Caldeira, 47491. Anexo\nPorto Karen do Leste - GO', '59', 'Text Text Text Text Text', 4, '2021-12-08 11:41:39', '2022-03-08 11:41:39', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(11, 'CONCLUÍDO', 12, 67, 25007, 'Rerum praesentium aut neque incidunt. Et non natus quia reiciendis. Similique praesentium modi reprehenderit eum est doloremque mollitia quia.', 1, 'Alexa Feliciano Urias', '(34) 2949-4058', '66625-000', '22753-390, Travessa Arruda, 7\nSão Gean do Sul - PI', '86', 'Text Text Text Text Text', 3, '2021-01-11 15:21:47', '2021-04-11 15:21:47', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(12, 'EM ANDAMENTO', 7, 218, 52361, 'Veritatis qui perspiciatis atque non. Officia odio inventore quia repellendus. Libero repellat aliquam labore impedit. Officiis possimus soluta eos voluptatum et.', 1, 'Dr. Fábio Azevedo Sobrinho da Cruz', '(83) 99149-6330', '66625-000', '91989-421, Travessa Santiago, 6609\nSoares do Norte - PE', '10', 'Text Text Text Text Text', 2, '2022-11-28 04:47:14', '2023-02-26 04:47:14', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(13, 'PENDENTE', 16, 274, 51543, 'Exercitationem sapiente et labore non sed eos. Maxime reiciendis ut placeat sed iure amet.', 2, 'Gabrielle Ferraz Neto da Rosa', '(92) 3656-7567', '66625-000', '47325-919, Av. César, 3234\nSão Maurício do Norte - SC', '84', 'Text Text Text Text Text', NULL, '2022-01-22 10:35:21', '2022-04-22 10:35:21', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(14, 'EM ANDAMENTO', 28, 12, 21508, 'Vitae ut et illum ut reprehenderit. Est aliquid ratione voluptates quo nihil. Earum rerum ut sit consequatur nobis quos consequatur. Laboriosam aut et molestiae aut dolorum est qui harum.', 2, 'Dr. Carolina Ferreira Jr. Salgado', '(95) 2012-7099', '66625-000', '67815-664, Av. Amanda Saraiva, 2240. Bc. 9 Ap. 58\nLuan d\'Oeste - RN', '10', 'Text Text Text Text Text', NULL, '2021-10-14 03:40:50', '2022-01-12 03:40:50', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(15, 'CONCLUÍDO', 20, 136, 43988, 'Delectus occaecati quisquam quas. Pariatur fuga hic voluptatem dicta tempore ut. Vero ad est dolorum at non.', 2, 'Sr. Agostinho Solano Colaço Rocha', '(85) 2801-3308', '66625-000', '52816-528, Avenida Verdara, 97172\nSão Cecília do Leste - BA', '41', 'Text Text Text Text Text', NULL, '2022-06-19 04:16:19', '2022-09-17 04:16:19', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(16, 'EM ANDAMENTO', 18, 260, 46261, 'Vitae id quidem doloribus fugiat. Autem officia dolorem inventore nihil quia qui esse. Quia dicta eius quo maxime veniam. At nam corrupti quasi alias officia.', 1, 'Dr. Máximo Matos Caldeira Feliciano', '(42) 2076-2111', '66625-000', '83305-860, R. Everton Galindo, 81\nCecília d\'Oeste - RN', '85', 'Text Text Text Text Text', 4, '2021-05-10 05:24:23', '2021-08-08 05:24:23', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(17, 'EM ANDAMENTO', 1, 267, 60403, 'Eos quisquam ipsam dolorum illo vel. Saepe id enim corrupti veniam libero fugit.', 2, 'Agostinho Feliciano Correia Cordeiro', '(93) 2710-8254', '66625-000', '03241-019, R. Sanches, 28955. Bc. 6 Ap. 01\nVila Ícaro - RR', '42', 'Text Text Text Text Text', NULL, '2022-04-28 12:05:24', '2022-07-27 12:05:24', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(18, 'EM ANDAMENTO', 20, 272, 52772, 'Blanditiis similique quas et aut suscipit dolorem. Odit aut et sint natus voluptatem repellat beatae minima. Quia autem ratione possimus illum soluta nostrum. Dolor molestiae ad non culpa.', 2, 'Théo Paulo Espinoza Jr. Sandoval', '(66) 2744-1570', '66625-000', '65966-010, R. Vila, 64649\nSão Yohanna - AL', '18', 'Text Text Text Text Text', NULL, '2021-09-30 14:00:29', '2021-12-29 14:00:29', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(19, 'CONCLUÍDO', 20, 64, 77503, 'Et odio iure quia. Eligendi ipsa placeat quas ipsa non minima inventore. Iure ut delectus consequatur laborum. Minima et voluptates quidem distinctio qui et nihil.', 1, 'Dr. Josué Alcantara Saraiva', '(87) 92377-0265', '66625-000', '81843-719, R. Rosa, 12\nTeobaldo do Norte - RS', '45', 'Text Text Text Text Text', 4, '2020-04-01 19:42:25', '2020-06-30 19:42:25', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(20, 'PENDENTE', 26, 187, 67349, 'Molestiae voluptatem voluptatem nihil numquam exercitationem natus. Perspiciatis et vel culpa. Dignissimos eius nisi sed eum odio. Quam culpa voluptatem molestiae aut.', 2, 'Otávio Matos Neto Pontes', '(47) 90414-3701', '66625-000', '20632-905, Rua Stella Beltrão, 10172. F\nVila Bernardo do Leste - TO', '70', 'Text Text Text Text Text', NULL, '2021-10-22 15:08:42', '2022-01-20 15:08:42', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(21, 'EM ANDAMENTO', 13, 280, 60707, 'Harum optio iusto illum voluptatem sed rerum earum. Eos molestiae laudantium et ipsam dolor eos. Aut dolor eos aut et ab explicabo. Quas est sit animi architecto dolorem ea ratione nihil.', 2, 'Marco Velasques Carmona', '(38) 94971-1806', '66625-000', '00807-809, Av. Cauan Pontes, 78268\nGrego d\'Oeste - AP', '98', 'Text Text Text Text Text', NULL, '2020-06-22 01:30:31', '2020-09-20 01:30:31', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(22, 'EM ANDAMENTO', 24, 114, 31975, 'Magni illo ipsam repellendus optio dolorem. Suscipit suscipit quis quisquam non tempore omnis officia et.', 2, 'Téo Esteves Tamoio Salgado', '(95) 94919-6217', '66625-000', '60810-845, Av. Vale, 9. 4º Andar\nFranco do Sul - PI', '30', 'Text Text Text Text Text', NULL, '2022-07-01 04:20:18', '2022-09-29 04:20:18', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(23, 'EM ANDAMENTO', 21, 232, 36686, 'Accusamus voluptatem accusamus ut iusto iste. Et non sit animi aperiam.', 1, 'Thaís Mendonça Faro Jr. Vila', '(99) 3657-1298', '66625-000', '27272-456, Travessa Matos, 4727. 653º Andar\nCamacho d\'Oeste - RO', '99', 'Text Text Text Text Text', 3, '2022-08-01 04:43:09', '2022-10-30 04:43:09', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(24, 'EM ANDAMENTO', 13, 124, 39232, 'Temporibus omnis non et nobis ipsum quis esse. Et blanditiis delectus modi sed. Magni nemo qui quaerat maxime in laudantium magni excepturi. Velit quia quia dolor.', 2, 'Ayla Delatorre Serrano das Dores', '(28) 94989-5754', '66625-000', '52433-237, Travessa Rafael Romero, 3. Apto 5\nVila Matheus do Sul - RN', '41', 'Text Text Text Text Text', NULL, '2020-09-02 11:51:30', '2020-12-01 11:51:30', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(25, 'PENDENTE', 10, 155, 10529, 'Velit ullam iure sapiente excepturi aut hic ea. Rerum id consequatur qui quidem est vel porro. Consequatur sed earum voluptatem dolores sit. Ipsum esse ratione doloremque sit.', 2, 'Luara Brito Benites Jr. Aragão', '(64) 3378-6123', '66625-000', '51284-810, R. Vitória, 9472\nFabiano do Leste - PA', '16', 'Text Text Text Text Text', NULL, '2021-08-22 02:06:04', '2021-11-20 02:06:04', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(26, 'EM ANDAMENTO', 21, 225, 36564, 'Doloremque corporis aut consequatur non voluptatem. Nisi illo earum ipsa sequi sunt. Reprehenderit est a dolorem voluptatum quia sit error voluptatibus.', 2, 'Hugo Leon Abreu Escobar', '(11) 93018-5754', '66625-000', '90682-173, Avenida Estrada, 494\nSão Marcos do Leste - RJ', '42', 'Text Text Text Text Text', NULL, '2022-08-13 06:31:03', '2022-11-11 06:31:03', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(27, 'PENDENTE', 12, 43, 38392, 'Temporibus incidunt autem et quae facilis fugiat unde molestias. Rem ipsa asperiores dolor illo fugit quo. Debitis architecto deleniti dolorem qui dolorem.', 2, 'Vitória Giovana Verdugo Caldeira', '(22) 2623-7872', '66625-000', '61949-939, Avenida Domingues, 330. Bloco B\nGeorge do Norte - MG', '63', 'Text Text Text Text Text', NULL, '2020-10-27 17:07:54', '2021-01-25 17:07:54', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(28, 'PENDENTE', 27, 28, 64344, 'Repudiandae tempore autem aspernatur quis qui eos quibusdam aliquam. Sequi impedit deserunt voluptatem cupiditate hic et. Est qui et aut est.', 2, 'Srta. Milene Franco Escobar Aguiar', '(38) 4278-1581', '66625-000', '80774-625, Largo Jonas Molina, 2. Bloco A\nCarmona do Leste - AP', '54', 'Text Text Text Text Text', NULL, '2022-09-27 22:13:10', '2022-12-26 22:13:10', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(29, 'PENDENTE', 26, 273, 18456, 'Nostrum soluta illo est inventore. Voluptatem dolores autem magnam. Natus laboriosam ea et quas maxime atque dolorum hic. Doloremque at praesentium voluptatem et.', 2, 'Sra. Allison Serrano Meireles', '(92) 90405-0824', '66625-000', '19427-793, R. Jimenes, 75. Fundos\nMarina do Norte - ES', '50', 'Text Text Text Text Text', NULL, '2022-11-06 08:58:13', '2023-02-04 08:58:13', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(30, 'PENDENTE', 7, 159, 29192, 'Qui enim recusandae magni laborum accusantium. Distinctio in qui ut assumenda. Aut unde unde doloremque suscipit.', 2, 'Daiane Rivera Sepúlveda Cordeiro', '(14) 94836-5541', '66625-000', '75400-154, Av. Tessália, 1641\nTorres do Leste - PB', '12', 'Text Text Text Text Text', NULL, '2022-11-08 09:24:46', '2023-02-06 09:24:46', '2021-03-29 23:53:24', '2021-03-29 23:53:24');

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
(1, 3, 2, '48', 'GENERATOR', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(2, 3, 1, '1', 'STRING_BOX', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(3, 3, 7, '50MT', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(4, 3, 1, '2', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(5, 3, 5, '6', 'SOLAR_INVERTER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(6, 4, 5, '38', 'GENERATOR', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(7, 4, 1, '3', 'STRING_BOX', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(8, 4, 5, '75MT', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(9, 4, 4, '10', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(10, 4, 12, '4', 'SOLAR_INVERTER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(11, 6, 2, '29', 'GENERATOR', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(12, 6, 1, '5', 'STRING_BOX', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(13, 6, 7, '25MT', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(14, 6, 2, '5', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(15, 6, 1, '5', 'SOLAR_INVERTER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(16, 9, 3, '28', 'GENERATOR', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(17, 9, 1, '5', 'STRING_BOX', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(18, 9, 5, '100MT', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(19, 9, 7, '7', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(20, 9, 4, '3', 'SOLAR_INVERTER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(21, 10, 5, '43', 'GENERATOR', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(22, 10, 1, '3', 'STRING_BOX', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(23, 10, 3, '50MT', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(24, 10, 4, '10', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(25, 10, 12, '3', 'SOLAR_INVERTER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(26, 11, 3, '19', 'GENERATOR', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(27, 11, 1, '2', 'STRING_BOX', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(28, 11, 6, '100MT', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(29, 11, 1, '4', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(30, 11, 7, '1', 'SOLAR_INVERTER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(31, 12, 2, '24', 'GENERATOR', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(32, 12, 1, '2', 'STRING_BOX', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(33, 12, 5, '75MT', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(34, 12, 3, '7', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(35, 12, 3, '2', 'SOLAR_INVERTER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(36, 16, 1, '40', 'GENERATOR', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(37, 16, 1, '5', 'STRING_BOX', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(38, 16, 4, '25MT', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(39, 16, 3, '8', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(40, 16, 8, '3', 'SOLAR_INVERTER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(41, 19, 5, '44', 'GENERATOR', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(42, 19, 1, '2', 'STRING_BOX', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(43, 19, 2, '75MT', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(44, 19, 6, '9', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(45, 19, 2, '8', 'SOLAR_INVERTER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(46, 23, 2, '31', 'GENERATOR', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(47, 23, 1, '2', 'STRING_BOX', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(48, 23, 2, '50MT', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(49, 23, 1, '6', 'OTHER', '2021-03-29 23:53:24', '2021-03-29 23:53:24'),
(50, 23, 4, '3', 'SOLAR_INVERTER', '2021-03-29 23:53:24', '2021-03-29 23:53:24');

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
(1, 'RS6E-150P', 'Resun', 'Monocristalino', 450, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(2, 'RS6E-150P', 'Resun', 'Policristalino', 150, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(3, 'TSM-PE15H', 'Trina Solar', 'Monocristalino', 405, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(4, 'RS6E-150P', 'Trina Solar', 'Monocristalino', 150, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(5, 'ODA400-36-M', 'OSDA', 'Monocristalino', 400, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(6, 'SA10-36P', 'Sinosola', 'Policristalino', 10, '2021-03-29 23:53:23', '2021-03-29 23:53:23');

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
(1, 'Par de Conectores Femea/Macho Staubli MC4', '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(2, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Preto - Multiplo 25 Metros', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(3, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Vermelho - Multiplo 25 Metros', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(4, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Azul - Multiplo 25 Metros', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(5, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Verde - Multiplo 25 Metros', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(6, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Amarelo - Multiplo 25 Metros', '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(7, 'Cabo Solar Nexans Energyflex BR 0,6/1Kv (1500 V DC) Laranja - Multiplo 25 Metros', '2021-03-29 23:53:23', '2021-03-29 23:53:23');

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
(1, 'ABB', 2, 20, 220, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(2, 'ABB', 2, 60, 380, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(3, 'ABB', 4, 50, 220, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(4, 'ABB', 4, 100, 380, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(5, 'Fronius Eco', 2, 25, 220, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(6, 'Fronius SYMO', 2, 12, 220, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(7, 'Fronius SYMO Brasil', 2, 15, 380, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(8, 'WEG SIW600', 4, 25, 380, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(9, 'WEG SMA', 4, 30, 220, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(10, 'WEG SIW500H ST012', 4, 100, 380, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(11, 'WEG SUN 2000–60KTL-MO', 2, 60, 220, '2021-03-29 23:53:23', '2021-03-29 23:53:23'),
(12, 'WEG SUN 2000–40KTL-MO', 4, 40, 380, '2021-03-29 23:53:23', '2021-03-29 23:53:23');

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
(1, '1000v', 'Ecosolys', '2021-03-29 23:53:23', '2021-03-29 23:53:23');

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
(1, 'Renan de Aguiar Dominato', 'jorge98@example.org', '(37) 95903-2080', '66625-000', '07088-969, Largo André Fonseca, 902. Bloco C\nBenjamin d\'Oeste - SE', '88', 'Text Text Text Text Text', 8, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(2, 'Ester Melina Madeira', 'william.matos@example.com', '(92) 95019-4314', '66625-000', '38035-774, Travessa Giovane, 61668\nVila Taís - AL', '96', 'Text Text Text Text Text', 25, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(3, 'Giovanna Delgado', 'avieira@example.org', '(21) 98312-6676', '66625-000', '09693-916, Avenida Isadora Molina, 63\nCampos d\'Oeste - PI', '72', 'Text Text Text Text Text', 3, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(4, 'Márcio Aaron Romero Jr.', 'gael.ferreira@example.net', '(96) 94867-9872', '66625-000', '00830-317, Avenida Carla, 58. Bc. 7 Ap. 87\nMontenegro d\'Oeste - GO', '12', 'Text Text Text Text Text', 25, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(5, 'Breno Padilha', 'rodrigues.sophie@example.org', '(49) 4039-1099', '66625-000', '53009-057, R. Alan, 9. Bloco C\nGael do Norte - RJ', '71', 'Text Text Text Text Text', 15, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(6, 'Sra. Cíntia Fontes Lourenço Neto', 'thalita38@example.net', '(27) 3924-2564', '66625-000', '87238-277, Largo Saulo, 65312\nAlexa d\'Oeste - RR', '49', 'Text Text Text Text Text', 9, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(7, 'Sr. Cristóvão Edilson Meireles', 'daiana04@example.org', '(82) 92300-8582', '66625-000', '20730-817, Av. Pietra Serrano, 43\nAndressa d\'Oeste - AP', '42', 'Text Text Text Text Text', 23, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(8, 'Bernardo Marin Soto', 'camilo.campos@example.org', '(98) 2105-2503', '66625-000', '73704-060, Rua Chaves, 21463. Bloco C\nGusmão d\'Oeste - SE', '17', 'Text Text Text Text Text', 18, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(9, 'Sr. Estêvão Marques Ferreira Sobrinho', 'diogo.maia@example.com', '(77) 2254-2983', '66625-000', '63865-743, Avenida Pacheco, 69558. Apto 0\nSanta Nero do Sul - AL', '10', 'Text Text Text Text Text', 19, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(10, 'Dr. Cláudio Balestero Neto', 'suzana.zaragoca@example.com', '(97) 93880-6017', '66625-000', '58335-946, R. Padrão, 48151. Bloco B\nGeorge d\'Oeste - RO', '63', 'Text Text Text Text Text', 26, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(11, 'Ian da Silva Neto', 'saito.rosana@example.net', '(89) 99669-9607', '66625-000', '96756-844, Rua Rocha, 99. Apto 93\nSaraiva do Norte - RS', '53', 'Text Text Text Text Text', 19, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(12, 'Thales Reis Filho', 'rodolfo96@example.com', '(86) 97613-2425', '66625-000', '73476-624, Travessa Raysa Teles, 1\nVila Matheus d\'Oeste - PB', '86', 'Text Text Text Text Text', 26, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(13, 'Sr. Tiago Rezende Rodrigues Jr.', 'vitoria.rico@example.net', '(99) 99416-8723', '66625-000', '57597-000, Travessa Samuel Mendes, 20. Apto 9\nVila Alma do Leste - GO', '22', 'Text Text Text Text Text', 26, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(14, 'Aparecida da Silva Rico Sobrinho', 'msouza@example.com', '(42) 90838-5286', '66625-000', '31783-268, Largo Maurício Camacho, 5. Anexo\nPorto Alícia do Leste - ES', '41', 'Text Text Text Text Text', 20, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(15, 'James Casanova Souza Neto', 'marta78@example.org', '(17) 3238-5910', '66625-000', '70336-493, Rua Fernando, 48. Bloco C\nSão Gabrielly - MT', '91', 'Text Text Text Text Text', 7, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(16, 'Nelson Fontes', 'qlozano@example.net', '(79) 2287-2930', '66625-000', '03129-825, Rua Breno Roque, 6547\nSanta Manuela - PE', '97', 'Text Text Text Text Text', 9, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(17, 'Srta. Analu Cecília de Arruda Jr.', 'rosana04@example.com', '(35) 93073-0735', '66625-000', '63574-167, Av. Jaqueline, 283. Bloco B\nZambrano d\'Oeste - RS', '77', 'Text Text Text Text Text', 26, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(18, 'Sr. Felipe Delatorre', 'baranda@example.net', '(49) 93586-1953', '66625-000', '33552-815, Largo Karine Padrão, 35533. Bc. 0 Ap. 05\nPorto Ohana d\'Oeste - MT', '13', 'Text Text Text Text Text', 2, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(19, 'Santiago Leandro Camacho Sobrinho', 'paulo.padrao@example.com', '(51) 96177-4880', '66625-000', '76871-244, Largo Michele, 10. 0º Andar\nSanta Bianca - MA', '11', 'Text Text Text Text Text', 18, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(20, 'Kauan Carrara', 'jefferson.chaves@example.net', '(61) 4480-2900', '66625-000', '36849-071, Av. Erik Ramires, 7\nPorto Paulo do Norte - TO', '92', 'Text Text Text Text Text', 11, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(21, 'Dr. Ariane Molina', 'hqueiros@example.com', '(12) 4868-9336', '66625-000', '25044-763, Largo Thales, 67. Fundos\nVila Naomi do Leste - AC', '27', 'Text Text Text Text Text', 8, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(22, 'Lorenzo Ferreira Filho', 'lburgos@example.net', '(22) 4544-4430', '66625-000', '17460-937, Largo Júlio Grego, 32618\nPorto Catarina do Norte - RJ', '96', 'Text Text Text Text Text', 10, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(23, 'Thalissa Miriam Casanova', 'colaco.michelle@example.com', '(85) 4051-0139', '66625-000', '40955-200, Avenida Vinícius Faro, 33178. Apto 02\nSanta Sérgio - MT', '43', 'Text Text Text Text Text', 26, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(24, 'Wagner Sebastião Marés', 'branco.maximiano@example.org', '(96) 91049-8214', '66625-000', '41964-162, Rua Zaragoça, 3\nDaniella d\'Oeste - MS', '60', 'Text Text Text Text Text', 7, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(25, 'Raissa Lozano Jr.', 'mariah.rodrigues@example.org', '(41) 2460-4092', '66625-000', '25543-603, Largo Emílio, 84445\nLaiane do Sul - MT', '99', 'Text Text Text Text Text', 25, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(26, 'Michael Lira Jr.', 'vbonilha@example.net', '(53) 2728-4058', '66625-000', '60927-601, Travessa Valentin, 654\nPorto Marco - PA', '50', 'Text Text Text Text Text', 15, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(27, 'Dr. Emílio Matheus Ferminiano', 'alicia.rangel@example.net', '(68) 2597-6542', '66625-000', '78784-638, Avenida Luna, 417\nSão Nicolas - AP', '27', 'Text Text Text Text Text', 27, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(28, 'Eric Valência Cortês', 'rodolfo68@example.net', '(86) 96945-6283', '66625-000', '18320-031, Rua David, 75. Bloco A\nSabrina do Norte - PB', '27', 'Text Text Text Text Text', 19, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(29, 'Christian Horácio Cordeiro Sobrinho', 'salas.claudia@example.org', '(94) 2174-7935', '66625-000', '37832-696, Av. Noel Zaragoça, 5279\nSão Jerônimo - RS', '16', 'Text Text Text Text Text', 28, '2021-03-29 23:53:22', '2021-03-29 23:53:22'),
(30, 'Sra. Sônia Zamana', 'maicon81@example.com', '(41) 2485-7643', '66625-000', '34081-462, Av. Flávio, 18264. Fundos\nSergio do Norte - DF', '14', 'Text Text Text Text Text', 27, '2021-03-29 23:53:22', '2021-03-29 23:53:22');

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
(1, '2021-03-29 23:53:21', '2021-03-29 23:53:21', 'Delvalle-de Arruda'),
(2, '2021-03-29 23:53:21', '2021-03-29 23:53:21', 'Benites e Amaral'),
(3, '2021-03-29 23:53:21', '2021-03-29 23:53:21', 'Marques e Rocha S.A.'),
(4, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Quintana e Ávila e Associados'),
(5, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Caldeira e Gomes'),
(6, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Faria-Lira'),
(7, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Jimenes-Ortiz'),
(8, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Carvalho Comercial Ltda.'),
(9, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Galhardo Comercial Ltda.'),
(10, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Amaral Comercial Ltda.'),
(11, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Brito e Associados'),
(12, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Delatorre e Aragão'),
(13, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Pedrosa Ltda.'),
(14, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Montenegro e Filhos'),
(15, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Godói Comercial Ltda.'),
(16, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Deverso-Marques'),
(17, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Benites Comercial Ltda.'),
(18, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Leal Comercial Ltda.'),
(19, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Aranda S.A.'),
(20, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Mendes e Santacruz'),
(21, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Santana Comercial Ltda.'),
(22, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Burgos e Estrada'),
(23, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Batista e Escobar Ltda.'),
(24, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Guerra e Mendes'),
(25, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Arruda-Ramos'),
(26, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Maldonado e Dias'),
(27, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Aragão e Associados'),
(28, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Paz e Associados'),
(29, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Sanches-Aguiar'),
(30, '2021-03-29 23:53:22', '2021-03-29 23:53:22', 'Zaragoça Comercial Ltda.');

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
(1, 'Inácio Gonçalves Ávila Neto', 0, 'maldonado.heloisa@example.com', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'FQw9Pr99VL', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(2, 'Christopher Fernandes Corona', 0, 'rafael17@example.com', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'IS4UP4g0Cw', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(3, 'Moisés Filipe Velasques', 0, 'ariana66@example.com', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '5TwjxTWxA4', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(4, 'Luísa Ortiz Domingues', 0, 'guilherme.matias@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'PiMyGhiVlc', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(5, 'Maximiano Santana Filho', 0, 'ssoares@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'Ur1K9WG5Zc', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(6, 'Dr. Rogério Sales', 0, 'sales.murilo@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'fRMIYgpxW6', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(7, 'Paulo Romero Filho', 0, 'kamila.neves@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'TmunduDyRe', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(8, 'Dr. Noemi Espinoza Delatorre Sobrinho', 0, 'barros.antonio@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'CU9AzfN8CU', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(9, 'Demian Serra Salazar', 0, 'robson38@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'vfmpZpKbpH', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(10, 'Andressa Prado Neves', 0, 'paulo.lutero@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'dCce024Nv5', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(11, 'Jasmin Sanches Sobrinho', 0, 'faria.tatiana@example.com', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'syPRnZNnyG', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(12, 'Srta. Constância Esteves Prado', 0, 'aneves@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'b11a0S1HBb', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(13, 'Dr. Cléber Galindo', 0, 'isabel12@example.com', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '5kFMGXmcQg', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(14, 'Sra. Clara Aranda Maldonado Filho', 0, 'tatiane06@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'j16j8tAJjT', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(15, 'Natan Soto Espinoza Sobrinho', 0, 'estrada.fabricio@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'dWXx0dCnCW', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(16, 'Sr. Danilo Joaquim Escobar', 0, 'molina.josue@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'MPspHXNPIw', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(17, 'Lúcia Aguiar Saito Jr.', 0, 'imarinho@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'gKNrZPJDf6', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(18, 'Eliane Zambrano', 0, 'ferminiano.marta@example.com', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'axRbYnvAEl', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(19, 'Sra. Mila Saraiva Rezende', 0, 'roberto69@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'xdhuFAlhTz', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(20, 'Paulo da Cruz Ferraz Neto', 0, 'omarinho@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'Fl6c01OcDv', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(21, 'Malu Ferminiano Filho', 0, 'goncalves.alessandro@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'zsEYH2H6Sf', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(22, 'Dr. Olívia Dias', 0, 'gabi18@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'jOaY0XfWqy', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(23, 'Nathalia Aragão Soto', 0, 'zambrano.rogerio@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'jlHNPzdnbc', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(24, 'Paulo Cortês Jr.', 0, 'marinho.francisco@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'QXibViUJeV', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(25, 'Bia Mariana Burgos', 0, 'maraisa50@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'UWgEWtOAgq', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(26, 'Dr. Lívia Queirós Uchoa', 0, 'neves.inacio@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '9nKYJOMJfO', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(27, 'Dr. Maximiano Nicolas Rangel Jr.', 0, 'mascarenhas.ornela@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '7JBWEZ6ctr', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(28, 'Valéria Valdez Sobrinho', 0, 'alana.correia@example.org', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'tUzt5TYjmF', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(29, 'Sr. Reinaldo Faria Escobar', 0, 'otavio13@example.com', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'vz01xD6M8d', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(30, 'Katherine de Freitas Sobrinho', 0, 'sebastiao.ramires@example.net', '2021-03-29 23:53:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 'SkrKccl89A', '2021-03-29 23:53:18', '2021-03-29 23:53:18', 2),
(31, 'User Admin', 1, 'admin@admin.com', '2021-03-29 23:53:22', '$2y$10$eXZQcB18hZWACwddCw3xAueTDMj1XgeTz5xJjFv1CO/hKvmVumV3i', NULL, NULL, '0', '2021-03-29 23:53:22', '2021-03-29 23:53:22', 1);

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
(1, 'ADMINISTRADOR', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(2, 'ENGENHARIA', '2021-03-29 23:53:18', '2021-03-29 23:53:18'),
(3, 'OPERACIONAL', '2021-03-29 23:53:18', '2021-03-29 23:53:18');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
