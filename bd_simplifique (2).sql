-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Dez-2019 às 14:01
-- Versão do servidor: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bd_simplifique`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `idAluno` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idAluno`),
  KEY `idUsuariox_idx` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idAluno`, `idUsuario`) VALUES
(2, 2),
(4, 4),
(5, 5),
(7, 7),
(9, 10),
(10, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anexo`
--

CREATE TABLE IF NOT EXISTS `anexo` (
  `idAnexo` int(11) NOT NULL AUTO_INCREMENT,
  `idDisciplina` int(11) DEFAULT NULL,
  `nomeAnexo` varchar(45) NOT NULL,
  `dataAnexo` varchar(40) NOT NULL,
  `materialAnexo` varchar(200) DEFAULT NULL,
  `urlAnexo` varchar(1000) DEFAULT NULL,
  `idCurso` int(40) NOT NULL,
  `idProfessor` int(40) NOT NULL,
  PRIMARY KEY (`idAnexo`),
  KEY `idDisciplinak_idx` (`idDisciplina`),
  KEY `idCurso` (`idCurso`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `anexo`
--

INSERT INTO `anexo` (`idAnexo`, `idDisciplina`, `nomeAnexo`, `dataAnexo`, `materialAnexo`, `urlAnexo`, `idCurso`, `idProfessor`) VALUES
(3, 5, 'Material de apoio', '22/04/1996', 'bd_simpli.sql', NULL, 2, 2),
(5, 1, 'Anexo', '20/08/2019 16:42:11', NULL, 'https://forum.baboo.com.br/index.php?/topic/554812-como-fazer-um-campo-obrigatório/', 1, 3),
(8, 1, 'Testando Aexos', '07/12/2019 23:51:52', 'logo_nfm.jpg', 'https://www.w3schools.com/tags/tryit.asp?filename=tryhtml5_textarea_required', 1, 3),
(11, 4, 'ultimo teste', '07/12/2019 23:36:54', 'logo_nfm.jpg', '', 2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `calendario`
--

CREATE TABLE IF NOT EXISTS `calendario` (
  `idCalendario` int(11) NOT NULL AUTO_INCREMENT,
  `idDisciplina` int(11) NOT NULL,
  `nomeCalendario` varchar(45) NOT NULL,
  `descricaoCalendario` text,
  `dataCalendario` varchar(45) NOT NULL,
  PRIMARY KEY (`idCalendario`),
  KEY `idDisciplinal_idx` (`idDisciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cronograma`
--

CREATE TABLE IF NOT EXISTS `cronograma` (
  `idCronograma` int(40) NOT NULL AUTO_INCREMENT,
  `idProfessor` int(40) NOT NULL,
  `idCurso` int(40) NOT NULL,
  `idDisciplina` int(40) NOT NULL,
  `tituloCronograma` varchar(100) NOT NULL,
  `dataCronograma` varchar(40) NOT NULL,
  `descricaoCronograma` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCronograma`),
  KEY `idCurso` (`idCurso`),
  KEY `idDisciplina` (`idDisciplina`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Extraindo dados da tabela `cronograma`
--

INSERT INTO `cronograma` (`idCronograma`, `idProfessor`, `idCurso`, `idDisciplina`, `tituloCronograma`, `dataCronograma`, `descricaoCronograma`) VALUES
(29, 3, 2, 5, 'APLICAÇÕES DA INTEGRAL DEFINIDA', '2019-01-01', ' Volumes de sólidos por cortes e discos.'),
(30, 3, 2, 5, 'APLICAÇÕES DA INTEGRAL DEFINIDA', '1989-04-06', 'Comprimento de arco do gráfico de uma função'),
(15, 3, 2, 5, 'Apresentação da disciplina', '2019-10-01', ''),
(34, 3, 2, 5, 'bolsa caiu', '2019-01-10', ''),
(20, 3, 2, 5, 'AS FUNÇÕES HIPERBÓLICAS', '2019-09-28', 'As funções hiperbólicas'),
(33, 3, 2, 5, 'váríós acêntõs', '2019-09-24', ''),
(32, 3, 2, 5, 'Matérias revisionais', '2019-09-25', 'revisão de funções, e demais matérias do Ensino Medio'),
(31, 4, 5, 7, 'Introdução à eletrônica', '2019-08-26', 'Conceitos básicos'),
(35, 3, 2, 5, 'Testando Cronogramas', '2019-09-26', ''),
(36, 3, 2, 5, 'Testando Cronogramas', '2019-09-26', ''),
(37, 3, 2, 5, 'lo', '2019-09-05', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCurso` varchar(45) NOT NULL,
  `descricaoCurso` text NOT NULL,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`idCurso`, `nomeCurso`, `descricaoCurso`) VALUES
(1, 'PISM I', ''),
(2, 'ENEM', ''),
(3, 'PISM II', ''),
(5, 'VEST-USP', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `idDisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `idCurso` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `nomeDisciplina` varchar(45) NOT NULL,
  `anoDisciplina` varchar(45) NOT NULL,
  PRIMARY KEY (`idDisciplina`),
  KEY `idCursoy_idx` (`idCurso`),
  KEY `idProfessor_idx` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`idDisciplina`, `idCurso`, `idProfessor`, `nomeDisciplina`, `anoDisciplina`) VALUES
(1, 1, 1, 'Matematica', '2019'),
(4, 2, 3, 'Algebra', '1999'),
(5, 2, 1, 'Portugues', '1999'),
(7, 5, 3, 'Geografia', '2018');

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

CREATE TABLE IF NOT EXISTS `frequencia` (
  `idFrequencia` int(11) NOT NULL AUTO_INCREMENT,
  `idProfessor` int(40) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `idAluno` int(11) DEFAULT NULL,
  `statusFrequencia` varchar(11) DEFAULT NULL,
  `dataFrequencia` varchar(40) NOT NULL,
  PRIMARY KEY (`idFrequencia`),
  KEY `idCurso` (`idCurso`),
  KEY `idDisciplina` (`idDisciplina`),
  KEY `idAluno` (`idAluno`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=232 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gerente`
--

CREATE TABLE IF NOT EXISTS `gerente` (
  `idGerente` int(40) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(40) NOT NULL,
  PRIMARY KEY (`idGerente`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `gerente`
--

INSERT INTO `gerente` (`idGerente`, `idUsuario`) VALUES
(1, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula_curso`
--

CREATE TABLE IF NOT EXISTS `matricula_curso` (
  `idMatriculaCurso` int(11) NOT NULL AUTO_INCREMENT,
  `idAluno` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `dataMatricula` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMatriculaCurso`),
  KEY `idAlunox_idx` (`idAluno`),
  KEY `idCursox_idx` (`idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `matricula_curso`
--

INSERT INTO `matricula_curso` (`idMatriculaCurso`, `idAluno`, `idCurso`, `dataMatricula`) VALUES
(7, 2, 2, NULL),
(11, 2, 1, NULL),
(12, 7, 3, NULL),
(13, 9, 5, '19/08/2019 20:04:19'),
(14, 10, 1, '20/08/2019 22:28:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
  `idNoticia` int(11) NOT NULL AUTO_INCREMENT,
  `idCurso` int(40) NOT NULL,
  `idProfessor` int(11) DEFAULT NULL,
  `nomeNoticia` varchar(45) NOT NULL,
  `descricaoNoticia` varchar(45) NOT NULL,
  `dataNoticia` varchar(40) NOT NULL,
  PRIMARY KEY (`idNoticia`),
  KEY `idProfessorm_idx` (`idProfessor`),
  KEY `idCurso` (`idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`idNoticia`, `idCurso`, `idProfessor`, `nomeNoticia`, `descricaoNoticia`, `dataNoticia`) VALUES
(4, 2, 3, 'Teste', 'Isso é um teste', '26/09/2019 22:01:00'),
(5, 1, 1, 'Aula suspensa', 'Aula suspensa por motivo de saúde', '0000-00-00 00:00:00'),
(9, 2, 1, 'teste', 'Também é um teste', '2019-08-09 00:00:00'),
(10, 2, 3, 'Aula de inglês adiada', 'Será na quarta-feira', '2019-01-20 00:00:00'),
(18, 3, 4, 'Testando notícias', 'Um coisa, outra coisa', '25/08/2019 16:54:52'),
(19, 2, 3, 'Testando notícias', 'uma noticia qualquerr', '26/09/2019 21:58:52'),
(21, 2, 3, 'teste', 'ultimo', '07/12/2019 23:59:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `idProfessor` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idProfessor`),
  KEY `idUsuarioy_idx` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`idProfessor`, `idUsuario`) VALUES
(3, 1),
(4, 3),
(1, 6),
(2, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nomeUsuario` varchar(45) NOT NULL,
  `cpfUsuario` varchar(45) NOT NULL,
  `emailUsuario` varchar(45) NOT NULL,
  `senhaUsuario` varchar(45) NOT NULL,
  `nascimentoUsuario` varchar(45) NOT NULL,
  `nivelUsuario` int(11) NOT NULL,
  `fotoUsuario` varchar(40) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomeUsuario`, `cpfUsuario`, `emailUsuario`, `senhaUsuario`, `nascimentoUsuario`, `nivelUsuario`, `fotoUsuario`) VALUES
(1, 'Nunda Melo', '', 'nunda@gmail.com', '09877890', '09/02/2000', 2, 'perfil_1575771910.jpg'),
(2, 'Adriana Silva Matos', '', 'umemailqualquer@gmail.com', '00000000', '2019-07-13', 3, ''),
(3, 'Nurian  Sobrenome1 Sobrenome2', '', 'umemailqualque@gmail.com', '098780', '2019-07-13', 2, 'perfil_1.jpg'),
(4, 'Drirdree Silveira', '', 'exemplo@gmail.com', '22222222', '2019-07-30', 3, ''),
(5, 'Bree Vam deKamp', '', 'exemplo@gmail..com', '33333333', '2019-07-30', 3, ''),
(6, 'Roni Jose Coelho', '', 'kiko@hotmail.com', '0987654321', '09/87/6543', 2, 'perfil_1575772404.jpg'),
(7, 'Penelope Quetson', '', 'exemplo@gmail.com', '4444444', '50/90/7000', 3, ''),
(8, 'Sidney Magal', '', 'naosei@gmail.com', '55555555', '', 2, ''),
(9, 'Ronindo Figueiredo', '', 'velha@hotmail.com', '098765', '04/06/1989', 1, ''),
(10, 'Gabrielly Solis', '', 'vhsd@hotmail.com', '11111111', '50/90/7000', 3, ''),
(11, ' Luí­s Silveira', '', 'vhsd@hotmail.com', '09876543', '04/06/1989', 3, '');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `idUsuariox` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `anexo`
--
ALTER TABLE `anexo`
  ADD CONSTRAINT `idCursok` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idDisciplinak` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idProfessork` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `idDisciplinal` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `idCursoy` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idProfessor` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `idAlunon` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idCurson` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idDisciplinan` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idProfessorn` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `matricula_curso`
--
ALTER TABLE `matricula_curso`
  ADD CONSTRAINT `idAlunox` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idCursox` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `idCursom` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idProfessorm` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `idUsuarioy` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
