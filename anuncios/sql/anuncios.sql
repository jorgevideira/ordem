-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Out-2020 às 09:17
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `anuncios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `anuncio_id` int(11) NOT NULL,
  `anuncio_user_id` int(11) UNSIGNED NOT NULL,
  `anuncio_codigo` longtext NOT NULL,
  `anuncio_titulo` varchar(255) NOT NULL,
  `anuncio_descricao` longtext NOT NULL,
  `anuncio_categoria_pai_id` int(11) NOT NULL,
  `anuncio_categoria_id` int(11) NOT NULL,
  `anuncio_preco` decimal(15,2) NOT NULL,
  `anuncio_localizacao_cep` varchar(15) NOT NULL,
  `anuncio_logradouro` varchar(255) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_bairro` varchar(50) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_cidade` varchar(50) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_estado` varchar(2) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_bairro_metalink` varchar(50) DEFAULT NULL,
  `anuncio_cidade_metalink` varchar(50) DEFAULT NULL,
  `anuncio_data_criacao` timestamp NULL DEFAULT current_timestamp(),
  `anuncio_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `anuncio_publicado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Publicado ou não',
  `anuncio_situacao` tinyint(1) NOT NULL COMMENT 'Novo ou usado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `anuncios`
--

INSERT INTO `anuncios` (`anuncio_id`, `anuncio_user_id`, `anuncio_codigo`, `anuncio_titulo`, `anuncio_descricao`, `anuncio_categoria_pai_id`, `anuncio_categoria_id`, `anuncio_preco`, `anuncio_localizacao_cep`, `anuncio_logradouro`, `anuncio_bairro`, `anuncio_cidade`, `anuncio_estado`, `anuncio_bairro_metalink`, `anuncio_cidade_metalink`, `anuncio_data_criacao`, `anuncio_data_alteracao`, `anuncio_publicado`, `anuncio_situacao`) VALUES
(4, 7, '57321690', 'Carrinho para gêmeos em ótimo estado de uso e conservação da marca alemã ABC DESIGN', 'Vendo carrinho para gêmeos em ótimo estado de uso e conservação da marca alemã ABC DESIGN, modelo ZOOM.\r\nProporciona posições diversas para melhor acomodar os bebês.\r\nInclusos também os bebês conforto da mesma marca e adaptadores para os mesmos.\r\nValor: R$ 3.000,00', 16, 8, '3000.00', '80510-000', 'Rua Inácio Lustosa', 'São Francisco', 'Curitiba', 'PR', 'sao-francisco', 'curitiba', '2020-09-24 20:19:43', '2020-10-06 06:20:09', 0, 0),
(5, 7, '31840592', 'Box Trilogia O Senhor Dos Anéis - 3 Livros - J R R Tolkien', 'Box Trilogia O Senhor Dos Anéis - 3 Livros - J R R Tolkien.', 12, 53, '100.00', '80510-000', 'Rua Inácio Lustosa', 'São Francisco', 'Curitiba', 'PR', 'sao-francisco', 'curitiba', '2020-09-24 20:28:33', '2020-09-24 23:47:34', 1, 0),
(6, 7, '36514928', 'Guitarra Memphis MG-230 Preta Usada', 'Guitarra Memphis MG-230 Preta Usada com apenas alguns riscos atrás mas em perfeito estado de funcionamento', 11, 6, '1000.00', '80510-000', 'Rua Inácio Lustosa', 'São Francisco', 'Curitiba', 'PR', 'sao-francisco', 'curitiba', '2020-09-24 20:31:07', '2020-09-24 23:47:34', 1, 0),
(7, 7, '47021895', 'Macbook Pro usado em excelente estado', 'Macbook Pro usado em excelente estado.\r\nMais detalhes chama no whats.', 2, 50, '1000.00', '80510-000', 'Rua Inácio Lustosa', 'São Francisco', 'Curitiba', 'PR', 'sao-francisco', 'curitiba', '2020-09-24 20:35:21', '2020-09-24 23:47:34', 1, 0),
(8, 8, '18430756', 'Maquina De Lavar E Secar Electrolux 9,0 Kg usada em excelente estado', 'Maquina De Lavar E Secar Electrolux 9,0 Kg usada em excelente estado', 22, 54, '1500.00', '99709-466', 'Rua Jacoh Loch', 'Parque dos Imigrantes', 'Erechim', 'RS', 'parque-dos-imigrantes', 'erechim', '2020-09-24 20:41:11', '2020-09-24 23:47:34', 1, 0),
(9, 8, '87543209', 'Tv philco smart 42 polegadas usada', 'Tv philco smart 42 polegadas usada', 23, 55, '800.00', '99709-466', 'Rua Jacoh Loch', 'Parque dos Imigrantes', 'Erechim', 'RS', 'parque-dos-imigrantes', 'erechim', '2020-09-24 20:52:23', '2020-09-24 23:47:34', 1, 0),
(10, 8, '84152369', 'Guarda roupa casal usado madeira maciça', 'Guarda roupa casal usado madeira maciça para retirar no local.', 9, 56, '200.00', '99709-466', 'Rua Jacoh Loch', 'Parque dos Imigrantes', 'Erechim', 'RS', 'parque-dos-imigrantes', 'erechim', '2020-09-24 20:58:04', '2020-09-24 23:47:34', 1, 0),
(11, 8, '60314582', 'Sofá preto de couro legítimo', 'Sofá preto de couro legítimo', 9, 56, '500.00', '99709-466', 'Rua Jacoh Loch', 'Parque dos Imigrantes', 'Erechim', 'RS', 'parque-dos-imigrantes', 'erechim', '2020-09-24 21:02:42', '2020-09-24 23:47:34', 1, 0),
(12, 14, '80746521', 'Cuidadora de idosos e babá', 'Trabalho como cuidadora de idosos e babá. Me chama no whats para maiores detalhes.', 5, 57, '0.00', '48607-370', 'Rua Bahia', 'Oliveira Lopes', 'Paulo Afonso', 'BA', 'oliveira-lopes', 'paulo-afonso', '2020-09-24 21:19:51', '2020-09-24 23:47:34', 1, 1),
(13, 14, '64258931', 'Passeadora de cães e dog Sister', 'Seu amigo mais feliz e saudável!\r\nRealizo os passeios, cuido do seu animal quando precisar viajar e limpo seu ambiente! \r\n-passeios diários;\r\n-limpeza do local e refeição;\r\n- visitas diárias;\r\n- tudo com muito amor e carinho!', 5, 64, '0.00', '48607-370', 'Rua Bahia', 'Oliveira Lopes', 'Paulo Afonso', 'BA', 'oliveira-lopes', 'paulo-afonso', '2020-09-24 21:24:17', '2020-09-24 23:47:34', 1, 0),
(14, 15, '74163295', 'Curso de maquiagem', 'Curso de maquiagem em vídeo. Total de 60hs.', 24, 66, '40.00', '35502-044', 'Rua Dez de Outubro', 'Ipiranga', 'Divinópolis', 'MG', 'ipiranga', 'divinopolis', '2020-09-24 21:36:43', '2020-09-24 23:47:34', 1, 1),
(15, 15, '26301478', 'Curso de depilação a domicílio', 'Estou oferecendo curso de depilação profissional com certificado.\r\nUm dia inteiro de curso com todo material incluso + modelo para treino.\r\nCurso totalmente prático com conteúdo teórico em apostila.\r\nTorne-se uma depiladora profissional.\r\n\r\nMais detalhes, chama no whats.', 24, 66, '0.00', '35502-044', 'Rua Dez de Outubro', 'Ipiranga', 'Divinópolis', 'MG', 'ipiranga', 'divinopolis', '2020-09-24 21:41:48', '2020-09-24 23:47:34', 1, 1),
(16, 15, '12564307', 'Curso de estética em DVD e livro, curso completo e original.', 'Curso de estética em DVD e livro, curso completo e original.', 24, 66, '300.00', '35502-044', 'Rua Dez de Outubro', 'Ipiranga', 'Divinópolis', 'MG', 'ipiranga', 'divinopolis', '2020-09-24 21:44:17', '2020-09-24 23:47:34', 1, 0),
(17, 16, '64057189', 'Xiaomi Redmi note 9 pró 128gb seminovo', 'Xiaomi Redmi note 9 pró 128gb seminovo.\r\nEntrego na região central com motoboy.', 7, 30, '1500.00', '58079-788', 'Rua Pedro Pereira da Silva', 'Grotão', 'João Pessoa', 'PB', 'grotao', 'joao-pessoa', '2020-09-24 21:56:09', '2020-09-24 23:47:34', 1, 0),
(18, 16, '96248530', 'Home Theater LG em excelente estado.', 'Home Theater LG em excelente estado.', 23, 67, '500.00', '58079-788', 'Rua Pedro Pereira da Silva', 'Grotão', 'João Pessoa', 'PB', 'grotao', 'joao-pessoa', '2020-09-24 22:02:41', '2020-09-24 23:47:34', 1, 0),
(19, 16, '15623984', 'Titan 150 mix 2012 - Super conservada', 'Titan 150 mix 2012 - Super conservada', 25, 69, '4000.00', '58079-788', 'Rua Pedro Pereira da Silva', 'Grotão', 'João Pessoa', 'PB', 'grotao', 'joao-pessoa', '2020-09-24 22:13:43', '2020-09-24 23:47:34', 1, 0),
(20, 9, '93675804', 'Hyundai Hb20s 1.6 Comfort Plus 16v', 'Hyundai Hb20s 1.6 Comfort Plus 16v', 25, 68, '35000.00', '83408-336', 'Travessa dos Esportes', 'Atuba', 'Colombo', 'PR', 'atuba', 'colombo', '2020-09-24 22:27:15', '2020-09-24 23:47:34', 1, 0),
(21, 9, '38156729', 'Chácara à venda em Colombo, região metropolitana de Curitiba', 'Chácara à venda em Colombo, região metropolitana de Curitiba.\r\n\r\nCom 3 Dormitórios, Sala, Copa, Cozinha, 2 Banheiros, 10 Vagas Garagem, Composta com Piscina, Salão de festa, Churrasqueira. área verde toda gramada e Arborizada, Arvore frutífera. Casa sede toda acabada com material de primeira qualidade, casa para caseiro com 2 dormitórios e muito mais.', 26, 72, '950000.00', '83408-336', 'Travessa dos Esportes', 'Atuba', 'Colombo', 'PR', 'atuba', 'colombo', '2020-09-24 22:35:56', '2020-09-24 23:47:34', 1, 0),
(22, 9, '78150643', 'Alugo casa na praia de matinhos', 'Casa para 8 pessoas Contando com crianças,3 quartos com cama de casal e ventilador de teto, sala com TV,cozinha,2banheiros,lavanderia,churrasqueira , piscina, \r\nA casa fica à 60m do mar\r\nRegião nobre, com tudo perto\r\nO valor do aluguel varia dependendo da época.\r\nTaxa de limpeza cobrado a parte.', 26, 71, '0.00', '83408-336', 'Travessa dos Esportes', 'Atuba', 'Colombo', 'PR', 'atuba', 'colombo', '2020-09-24 22:38:53', '2020-09-24 23:47:34', 1, 0),
(23, 10, '47918206', 'Smartwatch Champion CH50006P Pulseira de Silicone Preto', 'Smartwatch Champion CH50006P Pulseira de Silicone Preto.\r\nConsulte taxa de entrega', 27, 73, '450.00', '87308-182', 'Rua dos Gerânios', 'Moradias Verdes Campos', 'Campo Mourão', 'PR', 'moradias-verdes-campos', 'campo-mourao', '2020-09-24 22:52:34', '2020-09-24 23:47:34', 1, 1),
(24, 10, '93706128', 'Correntes de ouro - diversos modelos', 'Correntes de ouro - diversos modelos.\r\n\r\nMais detalhes chama no whats.', 27, 77, '0.00', '87308-182', 'Rua dos Gerânios', 'Moradias Verdes Campos', 'Campo Mourão', 'PR', 'moradias-verdes-campos', 'campo-mourao', '2020-09-24 22:56:56', '2020-09-24 23:47:34', 1, 1),
(25, 10, '48603192', 'Ternos italianos sob medida', 'Ternos italianos sob medida.\r\nEntre em contato conosco para maiores detalhes.', 18, 78, '0.00', '87308-182', 'Rua dos Gerânios', 'Moradias Verdes Campos', 'Campo Mourão', 'PR', 'moradias-verdes-campos', 'campo-mourao', '2020-09-24 23:01:36', '2020-09-24 23:47:34', 1, 1),
(26, 11, '05728631', 'PS4 Slim - usado', 'ps4 slim usado:, - 500 gb, - 2 controles, - cabos e fone de ouvido originais, - 7 meses de uso, unico dono, - 7 jogos midia física (foto) 2 digitais.', 4, 34, '1400.00', '83090-280', 'Rua Antônio Cavalli', 'São Marcos', 'São José dos Pinhais', 'PR', 'sao-marcos', 'sao-jose-dos-pinhais', '2020-09-24 23:06:25', '2020-09-24 23:47:34', 1, 0),
(27, 11, '79032648', 'Headset Gamer Sony Série Ouro', 'Headset Gamer Sony Sem Fio 7.1 Série Ouro PS4 e PS4 VR Preto, novo.', 2, 79, '520.00', '83090-280', 'Rua Antônio Cavalli', 'São Marcos', 'São José dos Pinhais', 'PR', 'sao-marcos', 'sao-jose-dos-pinhais', '2020-09-24 23:12:40', '2020-09-24 23:47:34', 1, 1),
(28, 11, '03691548', 'Cadeira Gamer Pichau Vienna', 'Cadeira Gamer Pichau Vienna , nova.\r\nEntrego na região de Curitiba.', 4, 81, '650.00', '83090-280', 'Rua Antônio Cavalli', 'São Marcos', 'São José dos Pinhais', 'PR', 'sao-marcos', 'sao-jose-dos-pinhais', '2020-09-24 23:23:05', '2020-09-24 23:47:34', 1, 1),
(29, 12, '92470853', 'Programador e desenvolvedor WEB', 'Trabalho no:\r\n\r\nDesenvolvimento para seu website, blog, ou landing page;\r\nDesenvolvimento para o seu aplicativo móvel (Android, iOS);\r\nDesenvolvimento para o seu projeto de loja virtual e ecommerce;\r\nDesenvolvimento para qualquer outra tarefa de programação;\r\n\r\nEntre em contato comigo para maiores detalhes.', 5, 82, '0.00', '87202-394', 'Rua Rússia', 'Residencial Parque das Nações', 'Cianorte', 'PR', 'residencial-parque-das-nacoes', 'cianorte', '2020-09-24 23:32:57', '2020-09-24 23:47:34', 1, 1),
(30, 13, '08615279', 'Bicicleta marca Pegassu aro 29', 'Bicicleta marca Pegassu aro 29.', 6, 21, '500.00', '84060-735', 'Rua Bosque das Brotas', 'Contorno', 'Ponta Grossa', 'PR', 'contorno', 'ponta-grossa', '2020-09-24 23:42:27', '2020-09-24 23:47:34', 1, 0),
(31, 13, '81036254', 'Bicicleta Elétrica Super Bike Motor 500w Bateria Litio', 'Bicicleta Elétrica Super Bike Motor 500w Bateria Litio', 6, 21, '9000.00', '84060-735', 'Rua Bosque das Brotas', 'Contorno', 'Ponta Grossa', 'PR', 'contorno', 'ponta-grossa', '2020-09-24 23:46:31', '2020-09-24 23:47:34', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios_fotos`
--

CREATE TABLE `anuncios_fotos` (
  `foto_id` int(11) NOT NULL,
  `foto_anuncio_id` int(11) DEFAULT NULL,
  `foto_nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `anuncios_fotos`
--

INSERT INTO `anuncios_fotos` (`foto_id`, `foto_anuncio_id`, `foto_nome`) VALUES
(44, 5, '3b2d10c36dc47582faa0264e4f287a19.jpg'),
(45, 5, '93f9e8a401fc4770499bc57d0b389edc.jpg'),
(46, 5, 'dd590540de5ebbdf325338b92cde828e.JPG'),
(47, 6, '7a459916302073d72339badc045309d2.jpg'),
(48, 6, '9e29dac34cb7ab84723803b2b2f73b88.jpg'),
(49, 6, '2b3dfdbbf5f6becc2e17465e31e7be48.jpg'),
(50, 6, 'b10f333cd33ea8d3801f3ce6272e6485.jpg'),
(51, 7, '7f0209fd9a3587a54dc2c5fdf890783a.jpg'),
(52, 7, 'da2fd9186f3535074356e0270160c210.jpg'),
(53, 7, '3e0fd924463d5a29743320bbabeb0047.jpg'),
(54, 8, 'fd60442dceca4c352aef2e1da626bbaf.jpg'),
(55, 8, 'cac35113474ebf46a670e468870bd9a9.jpg'),
(56, 8, '62195344ce6706bc4191f4fe4988e2bb.jpg'),
(57, 9, '7e2edb44162859b6e23fae2359b68cc0.jpg'),
(58, 9, '6071a73eecb4bd8d954e1ce1fb0f6881.jpg'),
(59, 9, '15ed5fa0951695b3e4315fa2958d5d23.jpg'),
(60, 10, 'cbeaa9e5d946db7930d8c5a422eacd1b.jpg'),
(61, 10, '0c7229c5dc3230e1a2fceb35198c5bb7.jpg'),
(62, 11, '1d1eb99931d38dd936a1957a99268eb8.jpg'),
(63, 11, 'dc9a809ba94f5e5bfd0c5d20b866e385.jpg'),
(64, 11, '0b2cd617b00b4246f268e486f898e4c3.jpg'),
(68, 13, 'dffcc129f4bf65d52ed72e9db6253d5a.jpg'),
(69, 13, 'd0cd56f67e5221a9070110af12374db3.jpg'),
(70, 12, 'a96afd66e63b5b8ec389a125e1a55d69.jpg'),
(71, 12, '4cb9fb7c43f615b2e5aff27624bddb7d.jpg'),
(72, 14, 'd4322fb4593c5c0a0edcfc76102166d1.jpg'),
(73, 14, '2fc114cf4fd927214bb4077efe696e9d.jpg'),
(74, 14, 'eae7d28770721e784e00970ff08dfabd.jpg'),
(75, 14, '12445e2a098216cde82662c6b0ca6388.jpg'),
(76, 15, '18e4b1a69d390b16501b1f38e83af9dc.jpg'),
(77, 15, 'bdee915f6ae38934435bc0bd0904db5f.jpg'),
(78, 16, 'af33097a4c22039f290cffaa9256c694.jpg'),
(79, 16, '5c37f293bd6e19cae2b74c42df3a7379.jpg'),
(80, 17, '6151cb5f98904e65b7c089ea8a727c55.jpg'),
(81, 17, 'b83ddd57b2fe3aabf20648926d2fe5f2.jpg'),
(82, 17, '8167e0b8d55921f931d828d56c763888.jpg'),
(83, 18, 'a9903586f9ad008fdc8691f22f2d31cc.jpg'),
(84, 18, 'b554dbd69f0a2538cd3caf7a18cdea1e.jpg'),
(85, 18, '42ab19ea40dc89a0be442a6bac6209d1.jpg'),
(86, 18, '2fc6e93c26747491183280dd76c92392.jpg'),
(87, 19, '3bb2b6d2e481a6535e737c94494a6dc8.jpg'),
(88, 19, 'b93279f72e6248a7b4c39b612c4cefb8.jpg'),
(89, 19, '2690acbf468b5e2f553461bd3fa915d5.jpg'),
(90, 20, 'd6ee53d23f56273b1e212bf335e1866d.jpg'),
(91, 20, 'c793f6f2578a3d1924fe7756164be5a3.jpg'),
(92, 20, 'c3539fa13cd8fa610a3af82f77ca1eb8.jpg'),
(93, 20, '98905614a034d3c875822c844dfbab9f.jpg'),
(94, 20, 'ccfc0060e758481e01262ab94f7bc48c.jpg'),
(95, 21, 'aacf619a5512fd118fcea4e2edd9241d.jpg'),
(96, 21, '673db0e6d3d13bac6acd4b7cab6d09aa.jpg'),
(97, 21, '38c7a41fba4ca8986f039acafedba0c6.jpg'),
(98, 21, 'e6054162476fe5717de2113e741c773f.jpg'),
(99, 22, '6752f6a67de4be063514a1a5bf0ecce7.jpg'),
(100, 22, '6cdcff34bfdd3201984f6622271d045c.jpg'),
(101, 22, '57ef8c640c12494bcc3f4fe42042993f.jpg'),
(102, 23, '9ffed980ed3fa9fe1564a6595d2955c3.jpg'),
(103, 23, '61bb47dfd87434159c64ab0c69a959b5.jpg'),
(104, 23, 'd23eb7f821e0b9ef4b4fbf2e331b5197.jpg'),
(105, 24, '1ccb6fbe8aba93fbf188b963e070f809.jpg'),
(106, 24, '6f742383449b85f13f389d9e57da6504.jpg'),
(107, 24, '53bc592864191a57ba092eff37829175.jpg'),
(108, 24, '204c37e2385036d77df13bb8963e442f.jpg'),
(109, 25, '98ddc292b69c8d5e4d3501756fff1715.jpg'),
(110, 25, 'c335066ece199f301706dd37867a4a14.jpg'),
(111, 25, '1e7fe30d21d84a91c225b701e71a8d17.jpg'),
(112, 25, 'f20a3dac7e3e826a74a4017f387846f5.jpg'),
(113, 26, 'de9f0e9194454a4af4923203999e1294.jpg'),
(114, 26, 'a29b133874ca437cb356661502199b24.jpg'),
(115, 26, '35ab6b9c1696d21dcfad0816aa7cbc49.jpg'),
(116, 26, 'ab43cb5e3f1982b764db64ae8e12870b.jpg'),
(117, 27, '18202a24887632b24162180334e47db0.jpg'),
(118, 27, '491bdb3457848f352d37807b1126db7f.jpg'),
(119, 27, 'd9a68e7c9d1aef57693de5ffaac76cf8.jpg'),
(120, 27, '3baae5b90796af1cfdf58e1ac5224151.jpg'),
(121, 28, 'd1b59c7dcbf5ce61a0eee5e96d236581.jpg'),
(122, 28, '078990476fe3fa6b3b66d59dadee5a4b.jpg'),
(123, 28, 'ba985ce0c8de9f74fda9633d4fe12bac.png'),
(124, 29, 'a8491fe2828c4c88f8b68c03754d657d.jpg'),
(125, 29, '6422edc095d41298126542d13ff6d42e.jpg'),
(126, 30, '9dd1fd4dcba0ee7e7b4d050423c0e1d5.jpg'),
(127, 30, '406dd3b1c51a3f602eb534905667df34.jpg'),
(128, 30, '60b59c7b55272ecfc380c944f073625d.jpg'),
(129, 31, '06637bc09862a93b6fbaba93f3667e52.jpg'),
(130, 31, 'e8508897f023253c784ca8f795f346bc.jpg'),
(131, 31, 'e1f909bb358de413151426fffa14e588.jpg'),
(138, 4, '187bb6ee5ef68b037cbe91d1b348374f.jpg'),
(139, 4, 'ec1c08470d80c06093dbe8de23d13c4a.jpg'),
(140, 4, '172c71d81a8911fc93ff99e52599fe1e.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios_perguntas`
--

CREATE TABLE `anuncios_perguntas` (
  `pergunta_id` int(11) NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  `anuncio_user_id` int(11) NOT NULL COMMENT 'ID do dono do anuncio. Será utilizado para verificar se a pergunta não está atrelada a outro anunciante',
  `anunciante_pergunta_id` int(11) NOT NULL,
  `pergunta` text DEFAULT NULL,
  `resposta` text DEFAULT NULL,
  `data_pergunta` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_resposta` datetime DEFAULT NULL,
  `pergunta_respondida` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Uma pergunta sempre será inserida como 0 (zero)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `anuncios_perguntas`
--

INSERT INTO `anuncios_perguntas` (`pergunta_id`, `anuncio_id`, `anuncio_user_id`, `anunciante_pergunta_id`, `pergunta`, `resposta`, `data_pergunta`, `data_resposta`, `pergunta_respondida`) VALUES
(1, 4, 7, 8, 'Ainda tem o produto?', 'Ainda tenho o produto.', '2020-09-30 04:47:53', '2020-09-30 03:13:07', 1),
(2, 4, 7, 8, 'Você entrega o carrinho na região central de Curitiba?', 'Puxa vida. Já vendi o produto. Me desculpe. Vou tirar o anúncio da plataforma.', '2020-09-30 04:47:53', '2020-10-02 03:26:01', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios_perguntas_historico`
--

CREATE TABLE `anuncios_perguntas_historico` (
  `pergunta_id` int(11) NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  `anuncio_user_id` int(11) NOT NULL COMMENT 'ID do dono do anuncio. Será utilizado para verificar se a pergunta não está atrelada a outro anunciante',
  `anunciante_pergunta_id` int(11) NOT NULL,
  `pergunta` text DEFAULT NULL,
  `resposta` text DEFAULT NULL,
  `data_pergunta` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_resposta` datetime DEFAULT NULL,
  `pergunta_respondida` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Uma pergunta sempre será inserida como 0 (zero)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `anuncios_perguntas_historico`
--

INSERT INTO `anuncios_perguntas_historico` (`pergunta_id`, `anuncio_id`, `anuncio_user_id`, `anunciante_pergunta_id`, `pergunta`, `resposta`, `data_pergunta`, `data_resposta`, `pergunta_respondida`) VALUES
(1, 4, 7, 8, 'Ainda tem o produto?', 'Ainda tenho o produto.', '2020-09-30 04:49:01', '2020-09-30 03:13:26', 1),
(2, 4, 7, 8, 'Você entrega o carrinho na região central de Curitiba?', 'Puxa vida. Já vendi o produto. Me desculpe. Vou tirar o anúncio da plataforma.', '2020-09-30 04:49:01', '2020-10-02 03:26:01', 1),
(3, 4, 7, 8, 'Posso retirar?', 'Claro que sim. Qual seria o melhor horário para você?', '2020-09-30 07:37:25', '2020-10-02 02:34:57', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `categoria_pai_id` int(11) DEFAULT NULL,
  `categoria_nome` varchar(150) NOT NULL,
  `categoria_ativa` tinyint(1) DEFAULT NULL,
  `categoria_meta_link` varchar(100) DEFAULT NULL,
  `categoria_data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_pai_id`, `categoria_nome`, `categoria_ativa`, `categoria_meta_link`, `categoria_data_criacao`, `categoria_data_alteracao`) VALUES
(2, 4, 'Mouse', 1, 'mouse', '2020-09-14 04:20:24', '2020-09-14 04:45:46'),
(3, 4, 'Fone de ouvido gamer', 1, 'fone-de-ouvido-gamer', '2020-09-14 04:46:49', NULL),
(4, 2, 'Memória ram', 1, 'memoria-ram', '2020-09-14 04:56:55', NULL),
(5, 4, 'Controles', 1, 'controles', '2020-09-16 07:36:26', NULL),
(6, 11, 'Violões e guitarras', 1, 'violoes-e-guitarras', '2020-09-23 06:57:02', NULL),
(7, 6, 'Bicicleta', 1, 'bicicleta', '2020-09-23 07:00:14', NULL),
(8, 16, 'Carrinhos e cadeirinhas', 1, 'carrinhos-e-cadeirinhas', '2020-09-24 05:50:45', '2020-09-24 05:52:39'),
(9, 16, 'Roupas e calçados', 1, 'roupas-e-calcados', '2020-09-24 05:51:27', NULL),
(10, 16, 'Brinquedos e jogos', 1, 'brinquedos-e-jogos', '2020-09-24 05:51:56', NULL),
(11, 16, 'Mobiliário infantil', 1, 'mobiliario-infantil', '2020-09-24 05:52:16', NULL),
(12, 14, 'Espelhos e retrovisores', 1, 'espelhos-e-retrovisores', '2020-09-24 05:57:20', NULL),
(13, 14, 'Tanque de combustível', 1, 'tanque-de-combustivel', '2020-09-24 05:58:04', NULL),
(14, 14, 'Volante esportivo', 1, 'volante-esportivo', '2020-09-24 05:58:21', NULL),
(15, 14, 'Capa para bancos', 1, 'capa-para-bancos', '2020-09-24 05:59:18', NULL),
(16, 14, 'Câmera veicular', 1, 'camera-veicular', '2020-09-24 06:00:01', NULL),
(17, 14, 'Central multimídia', 1, 'central-multimidia', '2020-09-24 06:01:46', NULL),
(18, 14, 'Pneus de carros e camionetes', 1, 'pneus-de-carros-e-camionetes', '2020-09-24 06:02:29', NULL),
(19, 6, 'Futebol', 1, 'futebol', '2020-09-24 06:03:48', NULL),
(20, 6, 'Camping, Caça e Pesca', 1, 'camping-caca-e-pesca', '2020-09-24 06:04:35', NULL),
(21, 6, 'Ciclismo', 1, 'ciclismo', '2020-09-24 06:06:37', NULL),
(22, 17, 'Ferramentas Manuais', 1, 'ferramentas-manuais', '2020-09-24 06:11:17', NULL),
(23, 17, 'Ferramentas para jardim', 1, 'ferramentas-para-jardim', '2020-09-24 06:12:32', NULL),
(24, 17, 'Medições e Instrumentação', 1, 'medicoes-e-instrumentacao', '2020-09-24 06:12:58', NULL),
(25, 18, 'Calçados femininos', 1, 'calcados-femininos', '2020-09-24 06:16:08', NULL),
(26, 18, 'Vestidos', 1, 'vestidos', '2020-09-24 06:16:21', NULL),
(27, 18, 'Camisetas masculinas', 1, 'camisetas-masculinas', '2020-09-24 06:16:40', NULL),
(28, 18, 'Bolsas femininas', 1, 'bolsas-femininas', '2020-09-24 06:16:54', NULL),
(29, 18, 'Moda íntima feminina', 1, 'moda-intima-feminina', '2020-09-24 06:17:16', NULL),
(30, 7, 'Smartphones', 1, 'smartphones', '2020-09-24 06:19:36', NULL),
(31, 7, 'Telefones', 1, 'telefones', '2020-09-24 06:20:17', NULL),
(32, 4, 'Consoles', 1, 'consoles', '2020-09-24 06:21:05', NULL),
(33, 4, 'Jogos', 1, 'jogos', '2020-09-24 06:21:24', NULL),
(34, 4, 'PS4', 1, 'ps4', '2020-09-24 06:23:40', NULL),
(35, 4, 'PS3', 1, 'ps3', '2020-09-24 06:24:03', NULL),
(36, 4, 'X-box one', 1, 'x-box-one', '2020-09-24 06:24:30', NULL),
(37, 4, 'Xbox 360', 1, 'xbox-360', '2020-09-24 06:24:49', NULL),
(38, 8, 'Câmeras digitais', 1, 'cameras-digitais', '2020-09-24 06:25:59', NULL),
(39, 8, 'Câmeras analógicas', 0, 'cameras-analogicas', '2020-09-24 06:26:17', NULL),
(40, 19, 'Carregadores', 1, 'carregadores', '2020-09-24 06:28:52', NULL),
(41, 19, 'Carcaças, Capas e Protetores Películas Protetoras', 1, 'carcacas-capas-e-protetores-peliculas-protetoras', '2020-09-24 06:29:23', '2020-09-24 06:32:30'),
(44, 20, 'Modem', 1, 'modem', '2020-09-24 06:37:34', NULL),
(45, 20, 'Roteadores', 1, 'roteadores', '2020-09-24 06:37:51', NULL),
(46, 20, 'Cabos de Rede e Acessórios', 1, 'cabos-de-rede-e-acessorios', '2020-09-24 06:38:11', NULL),
(47, 21, 'Impressora Multifuncional', 1, 'impressora-multifuncional', '2020-09-24 06:41:10', NULL),
(48, 21, 'Impressora térmica', 1, 'impressora-termica', '2020-09-24 06:41:38', NULL),
(49, 2, 'Acessórios para Notebook', 1, 'acessorios-para-notebook', '2020-09-24 06:42:17', NULL),
(50, 2, 'Notebook', 1, 'notebook', '2020-09-24 06:43:14', NULL),
(51, 2, 'Desktop', 1, 'desktop', '2020-09-24 06:43:49', NULL),
(52, 2, 'Computadores de mesa', 1, 'computadores-de-mesa', '2020-09-24 06:44:04', NULL),
(53, 12, 'Livros', 1, 'livros', '2020-09-24 20:27:18', NULL),
(54, 22, 'Maquinas de lavar', 1, 'maquinas-de-lavar', '2020-09-24 20:39:46', NULL),
(55, 23, 'Televisores', 1, 'televisores', '2020-09-24 20:49:51', NULL),
(56, 9, 'Móveis para sua casa', 1, 'moveis-para-sua-casa', '2020-09-24 20:54:24', NULL),
(57, 5, 'Cuidador e babá', 1, 'cuidador-e-baba', '2020-09-24 21:13:55', NULL),
(58, 5, 'Serviços domésticos', 1, 'servicos-domesticos', '2020-09-24 21:14:14', NULL),
(59, 5, 'Eventos e festas', 1, 'eventos-e-festas', '2020-09-24 21:14:31', NULL),
(60, 5, 'Reparação, conserto e reforma', 1, 'reparacao-conserto-e-reforma', '2020-09-24 21:14:49', NULL),
(61, 5, 'Informática', 1, 'informatica', '2020-09-24 21:15:15', NULL),
(62, 5, 'Transporte e mudança', 1, 'transporte-e-mudanca', '2020-09-24 21:16:00', NULL),
(63, 5, 'Saúde e beleza', 1, 'saude-e-beleza', '2020-09-24 21:16:47', NULL),
(64, 5, 'Passeios com cães', 1, 'passeios-com-caes', '2020-09-24 21:21:22', '2020-09-24 21:22:06'),
(65, 24, 'Treinamentos', 1, 'treinamentos', '2020-09-24 21:32:31', NULL),
(66, 24, 'Cursos', 1, 'cursos', '2020-09-24 21:32:42', NULL),
(67, 23, 'Home Theaters', 1, 'home-theaters', '2020-09-24 22:01:32', NULL),
(68, 25, 'Carros, vans e utilitários', 1, 'carros-vans-e-utilitarios', '2020-09-24 22:07:24', NULL),
(69, 25, 'Motos', 1, 'motos', '2020-09-24 22:09:09', NULL),
(70, 26, 'Venda de casas e apartamentos', 1, 'venda-de-casas-e-apartamentos', '2020-09-24 22:29:31', NULL),
(71, 26, 'Aluguel de casas e apartamentos', 1, 'aluguel-de-casas-e-apartamentos', '2020-09-24 22:29:44', NULL),
(72, 26, 'Venda de terrenos, chácaras, sítios e fazendas', 1, 'venda-de-terrenos-chacaras-sitios-e-fazendas', '2020-09-24 22:30:14', '2020-09-24 22:31:03'),
(73, 27, 'Relógio masculino', 1, 'relogio-masculino', '2020-09-24 22:45:35', NULL),
(74, 27, 'Relógio feminino', 1, 'relogio-feminino', '2020-09-24 22:45:55', NULL),
(75, 27, 'Anéis', 1, 'aneis', '2020-09-24 22:46:26', NULL),
(76, 27, 'Pulseiras', 1, 'pulseiras', '2020-09-24 22:46:38', NULL),
(77, 27, 'Correntes e colares', 1, 'correntes-e-colares', '2020-09-24 22:46:49', '2020-09-24 22:55:56'),
(78, 18, 'Moda masculina', 1, 'moda-masculina', '2020-09-24 22:59:54', NULL),
(79, 2, 'Headset gamer', 1, 'headset-gamer', '2020-09-24 23:09:38', NULL),
(80, 4, 'Peças e acessórios para consoles', 1, 'pecas-e-acessorios-para-consoles', '2020-09-24 23:16:41', '2020-09-24 23:16:56'),
(81, 4, 'Acessórios gamer', 1, 'acessorios-gamer', '2020-09-24 23:18:08', NULL),
(82, 5, 'Desenvolvimento web e mobile', 1, 'desenvolvimento-web-e-mobile', '2020-09-24 23:26:49', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_pai`
--

CREATE TABLE `categorias_pai` (
  `categoria_pai_id` int(11) NOT NULL,
  `categoria_pai_nome` varchar(45) NOT NULL,
  `categoria_pai_ativa` tinyint(1) DEFAULT NULL,
  `categoria_pai_meta_link` varchar(100) DEFAULT NULL,
  `categoria_pai_classe_icone` varchar(50) NOT NULL,
  `categoria_pai_data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_pai_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias_pai`
--

INSERT INTO `categorias_pai` (`categoria_pai_id`, `categoria_pai_nome`, `categoria_pai_ativa`, `categoria_pai_meta_link`, `categoria_pai_classe_icone`, `categoria_pai_data_criacao`, `categoria_pai_data_alteracao`) VALUES
(2, 'Informática', 1, 'informatica', 'lni-laptop', '2020-09-14 03:37:46', NULL),
(4, 'Games', 1, 'games', 'lni-game', '2020-09-14 04:27:22', '2020-09-21 02:28:52'),
(5, 'Serviços', 1, 'servicos', 'lni-hammer', '2020-09-21 02:31:13', '2020-09-25 07:54:24'),
(6, 'Esporte e lazer', 1, 'esporte-e-lazer', 'lni-bi-cycle', '2020-09-21 02:32:57', NULL),
(7, 'Celulares e Telefones', 1, 'celulares-e-telefones', 'lni-mobile', '2020-09-21 02:35:07', NULL),
(8, 'Câmeras e Acessórios', 1, 'cameras-e-acessorios', 'lni-camera', '2020-09-21 02:35:43', NULL),
(9, 'Para sua casa', 1, 'para-sua-casa', 'lni-home', '2020-09-21 02:38:20', NULL),
(10, 'Calçados, Roupas e Bolsas', 1, 'calcados-roupas-e-bolsas', 'lni-tshirt', '2020-09-21 02:40:27', NULL),
(11, 'Instrumentos Musicais', 1, 'instrumentos-musicais', 'lni-music', '2020-09-21 02:41:17', NULL),
(12, 'Livros, Revistas e Comics', 1, 'livros-revistas-e-comics', 'lni-book', '2020-09-21 02:42:16', NULL),
(13, 'Música, Filmes e Seriados', 1, 'musica-filmes-e-seriados', 'lni-video', '2020-09-21 02:42:49', NULL),
(14, 'Peças e acessórios para veículos', 1, 'pecas-e-acessorios-para-veiculos', 'lni-car', '2020-09-21 02:44:21', '2020-09-24 05:54:58'),
(15, 'Alimentos e Bebidas', 1, 'alimentos-e-bebidas', 'lni-dinner', '2020-09-21 02:45:09', NULL),
(16, 'Artigos infantis', 1, 'artigos-infantis', 'lni-gift', '2020-09-21 02:48:14', NULL),
(17, 'Ferramentas', 1, 'ferramentas', 'lni-hammer', '2020-09-24 06:10:21', NULL),
(18, 'Moda', 1, 'moda', 'lni-tshirt', '2020-09-24 06:15:43', NULL),
(19, 'Acessórios para Celulares', 1, 'acessorios-para-celulares', 'lni-control-panel', '2020-09-24 06:28:19', NULL),
(20, 'Conectividade e redes', 1, 'conectividade-e-redes', 'lni-database', '2020-09-24 06:37:20', NULL),
(21, 'Impressoras', 1, 'impressoras', 'lni-printer', '2020-09-24 06:39:57', NULL),
(22, 'Eletrodomésticos', 1, 'eletrodomesticos', 'lni-agenda', '2020-09-24 20:39:15', NULL),
(23, 'Áudio, TV, vídeo e fotografia', 1, 'audio-tv-video-e-fotografia', 'lni-video', '2020-09-24 20:48:18', NULL),
(24, 'Cursos e treinamentos', 1, 'cursos-e-treinamentos', 'lni-graduation', '2020-09-24 21:30:39', NULL),
(25, 'Automóveis', 1, 'automoveis', 'lni-car', '2020-09-24 22:06:27', '2020-09-24 22:07:10'),
(26, 'Imóveis', 1, 'imoveis', 'lni-apartment', '2020-09-24 22:28:43', NULL),
(27, 'Jóias e relógios', 1, 'joias-e-relogios', 'lni-alarm-clock', '2020-09-24 22:44:58', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'anunciantes', 'Anunciantes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema`
--

CREATE TABLE `sistema` (
  `sistema_id` int(11) NOT NULL,
  `sistema_razao_social` varchar(145) DEFAULT NULL,
  `sistema_nome_fantasia` varchar(145) DEFAULT NULL,
  `sistema_cnpj` varchar(25) DEFAULT NULL,
  `sistema_ie` varchar(25) DEFAULT NULL,
  `sistema_telefone_fixo` varchar(25) DEFAULT NULL,
  `sistema_telefone_movel` varchar(25) NOT NULL,
  `sistema_email` varchar(100) DEFAULT NULL,
  `sistema_site_titulo` varchar(255) DEFAULT NULL,
  `sistema_cep` varchar(25) DEFAULT NULL,
  `sistema_endereco` varchar(145) DEFAULT NULL,
  `sistema_numero` varchar(25) DEFAULT NULL,
  `sistema_bairro` varchar(100) NOT NULL,
  `sistema_cidade` varchar(100) DEFAULT NULL,
  `sistema_estado` varchar(2) DEFAULT NULL,
  `sistema_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sistema`
--

INSERT INTO `sistema` (`sistema_id`, `sistema_razao_social`, `sistema_nome_fantasia`, `sistema_cnpj`, `sistema_ie`, `sistema_telefone_fixo`, `sistema_telefone_movel`, `sistema_email`, `sistema_site_titulo`, `sistema_cep`, `sistema_endereco`, `sistema_numero`, `sistema_bairro`, `sistema_cidade`, `sistema_estado`, `sistema_data_alteracao`) VALUES
(1, 'Anuncios Inc', 'Anúncios muito legais', '80.838.809/0001-26', '683.90228-49', '(41) 3232-3030', '(41) 9999-9999', 'anuncioslegais@contato.com.br', 'Anúncios legais', '80510-000', 'Rua da Programação', '54', 'Centro', 'Curitiba', 'PR', '2020-09-16 07:11:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_foto` varchar(255) NOT NULL,
  `user_cpf` varchar(15) NOT NULL,
  `user_cep` varchar(9) NOT NULL,
  `user_endereco` varchar(255) NOT NULL,
  `user_numero_endereco` varchar(50) NOT NULL,
  `user_bairro` varchar(50) NOT NULL,
  `user_cidade` varchar(50) NOT NULL,
  `user_estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `user_foto`, `user_cpf`, `user_cep`, `user_endereco`, `user_numero_endereco`, `user_bairro`, `user_cidade`, `user_estado`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$werW/MmjYsXrWc5udQagwuorNCD4HpPsBATKHxQUCGulCikOFInuS', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1601959138, 1, 'Admin', 'Souza', 'ADMIN', '(41) 3232-3232', '945b6739e7cca3e90211250940434c32.jpg', '576.719.480-71', '80540-000', 'Rua Alberto Folloni', '45', 'Ahú', 'Curitiba', 'PR'),
(7, '::1', NULL, '$2y$10$yvfdsS0Cze204DsoYFQsaOs2JCmUGH4e1p2txiWhvxMUHrgBZ/w7a', 'filisa5130@a6mail.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1599955265, 1601869826, 0, 'Alice', 'Jéssica Emilly Melo', NULL, '(69) 98706-9941', 'b7503bb0d87b9728a20e35be76cde600.jpg', '414.349.838-38', '80510-000', 'Rua Inácio Lustosa', '35', 'São Francisco', 'Curitiba', 'PR'),
(8, '::1', NULL, '$2y$10$yvfdsS0Cze204DsoYFQsaOs2JCmUGH4e1p2txiWhvxMUHrgBZ/w7a', 'xibipi9708@zuperholo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1600924344, 1601622857, 1, 'Isabelle', 'Rayssa Cavalcanti', NULL, '(54) 98643-1865', '4b0535247351336134ca231bfbf68fe0.png', '293.570.865-28', '99709-466', 'Rua Jacoh Loch', '', 'Parque dos Imigrantes', 'Erechim', 'RS'),
(9, '127.0.0.1', NULL, '$2y$10$N1b684vZ5hvJsOdRzdSM5.NvFO/sh/sVUkXeZ4ZcK2y77dljYqHi.', 'caioemanuelsilveira@riquefroes.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1600976113, 1600986281, 1, 'Caio', 'Emanuel Silveira', NULL, '(41) 98524-9101', '53d3c9131b618ce86c3748d58eb33972.jpg', '041.595.539-40', '83408-336', 'Travessa dos Esportes', '', 'Atuba', 'Colombo', 'PR'),
(10, '127.0.0.1', NULL, '$2y$10$pnHhBGELa2ykn0djNmONN.dKa6KRArNCpvGnOA479yTrMV64zynom', 'fernandogeraldoiagofernandes_@portoweb.com.br', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1600976192, 1600987770, 1, 'Fernando', 'Geraldo Iago Fernandes', NULL, '(44) 98257-7467', '58f7642ee0cad89a92aca68a476c0c6e.jpg', '115.750.889-83', '87308-182', 'Rua dos Gerânios', '', 'Moradias Verdes Campos', 'Campo Mourão', 'PR'),
(11, '127.0.0.1', NULL, '$2y$10$cI1avCvi9I37ZEEyXsG4sO/uTWQzw.VvkXB4TT5NKgczF7jr9JMza', 'mariogaeldacruz_@stilomovelaria.com.br', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1600976572, 1600989272, 1, 'Mário', 'Gael da Cruz', NULL, '(41) 98496-9201', '3ca9891bf10c24628e129652558b73cd.jpg', '236.996.949-09', '83090-280', 'Rua Antônio Cavalli', '', 'São Marcos', 'São José dos Pinhais', 'PR'),
(12, '127.0.0.1', NULL, '$2y$10$LZL6EGCHlJ2NZy3xaJcmg.mgngjT15d/BEN1bIUY/KRNrivTwqgaa', 'nicolasfernandoiancaldeira@metraseg.com.br', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1600976763, 1600989869, 1, 'Nicolas', 'Fernando Ian Caldeira', NULL, '(44) 99182-2151', 'bf0adbeab47af8e118293af402d3e963.jpeg', '698.283.719-01', '87202-394', 'Rua Rússia', '', 'Residencial Parque das Nações', 'Cianorte', 'PR'),
(13, '127.0.0.1', NULL, '$2y$10$4rU.IxGH/ahV0R2Jka6UbOOP7KyhSvtJNRwGNuwxZX2am0hDtrX5O', 'ppedrobernardoalves@tglaw.com.br', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1600976844, 1600990838, 1, 'Pedro', 'Bernardo Alves', NULL, '(42) 98811-8267', '6b4fe121285aed516aba9e50891a1aa7.jpg', '227.536.529-02', '84060-735', 'Rua Bosque das Brotas', '', 'Contorno', 'Ponta Grossa', 'PR'),
(14, '127.0.0.1', NULL, '$2y$10$e0pPzSg8dLvq2qNtIPnUTeZQPx19j0QFwTD6zrDEpeFVJ9x87UaYu', 'luanasimoneelzafarias-75@unimedsjc.com.br', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1600977306, 1600981432, 1, 'Luana', 'Simone Elza Farias', NULL, '(75) 98792-4642', 'f3017193791a9acf53076f633474ab96.jpg', '481.158.007-91', '48607-370', 'Rua Bahia', '', 'Oliveira Lopes', 'Paulo Afonso', 'BA'),
(15, '127.0.0.1', NULL, '$2y$10$ZjI.nln2bltSsqMHXvo4oe/E3JBBTYY/reYXlXHK4mmUpsKVn2Vl.', 'marcelasaramilenacastro-89@virage.com.br', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1600977380, 1600982725, 1, 'Marcela', 'Sara Milena Castro', NULL, '(37) 99639-3560', '0d1bb87ba26993c2c5691a54306d739f.jpg', '459.407.310-74', '35502-044', 'Rua Dez de Outubro', '', 'Ipiranga', 'Divinópolis', 'MG'),
(16, '127.0.0.1', NULL, '$2y$10$FQHnJvA3A.PQLtSJZQydmeTRKKIjsPY2VVowffWGm8KGRauxwccOe', 'pietraaparecidaramos@kmspublicidade.com.br', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1600977564, 1600984319, 1, 'Pietra', 'Aparecida Ramos', NULL, '(83) 99927-6526', '1762b3aef3a38493b68094ba34f0d2a3.jpeg', '306.305.643-02', '58079-788', 'Rua Pedro Pereira da Silva', '', 'Grotão', 'João Pessoa', 'PB');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(6, 1, 1),
(37, 7, 2),
(25, 8, 2),
(26, 9, 2),
(27, 10, 2),
(28, 11, 2),
(29, 12, 2),
(34, 13, 2),
(31, 14, 2),
(32, 15, 2),
(33, 16, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`anuncio_id`),
  ADD KEY `fk_anuncio_user_id` (`anuncio_user_id`);

--
-- Índices para tabela `anuncios_fotos`
--
ALTER TABLE `anuncios_fotos`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `fk_foto_anuncio_id` (`foto_anuncio_id`);

--
-- Índices para tabela `anuncios_perguntas`
--
ALTER TABLE `anuncios_perguntas`
  ADD PRIMARY KEY (`pergunta_id`),
  ADD KEY `anuncio_id` (`anuncio_id`),
  ADD KEY `anunciante_pergunta_id` (`anunciante_pergunta_id`);

--
-- Índices para tabela `anuncios_perguntas_historico`
--
ALTER TABLE `anuncios_perguntas_historico`
  ADD PRIMARY KEY (`pergunta_id`),
  ADD KEY `anuncio_id` (`anuncio_id`),
  ADD KEY `anunciante_pergunta_id` (`anunciante_pergunta_id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`),
  ADD KEY `categoria_pai_id` (`categoria_pai_id`);

--
-- Índices para tabela `categorias_pai`
--
ALTER TABLE `categorias_pai`
  ADD PRIMARY KEY (`categoria_pai_id`);

--
-- Índices para tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Índices para tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `anuncio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `anuncios_fotos`
--
ALTER TABLE `anuncios_fotos`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT de tabela `anuncios_perguntas`
--
ALTER TABLE `anuncios_perguntas`
  MODIFY `pergunta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `anuncios_perguntas_historico`
--
ALTER TABLE `anuncios_perguntas_historico`
  MODIFY `pergunta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de tabela `categorias_pai`
--
ALTER TABLE `categorias_pai`
  MODIFY `categoria_pai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `fk_anuncio_user_id` FOREIGN KEY (`anuncio_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `anuncios_fotos`
--
ALTER TABLE `anuncios_fotos`
  ADD CONSTRAINT `fk_foto_anuncio_id` FOREIGN KEY (`foto_anuncio_id`) REFERENCES `anuncios` (`anuncio_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `anuncios_perguntas`
--
ALTER TABLE `anuncios_perguntas`
  ADD CONSTRAINT `fk_anuncio_id` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios` (`anuncio_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `anuncios_perguntas_historico`
--
ALTER TABLE `anuncios_perguntas_historico`
  ADD CONSTRAINT `fk_anuncio_id_historico` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios` (`anuncio_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categoria_pai_id` FOREIGN KEY (`categoria_pai_id`) REFERENCES `categorias_pai` (`categoria_pai_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
