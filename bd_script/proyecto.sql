-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2021 a las 02:45:36
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_complementarias`
--

CREATE TABLE `actividades_complementarias` (
  `id_actividad_complementaria` int(11) NOT NULL,
  `id_tercero` int(11) DEFAULT NULL,
  `id_plan_trabajo` int(11) DEFAULT NULL,
  `corte` int(11) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividades_complementarias`
--

INSERT INTO `actividades_complementarias` (`id_actividad_complementaria`, `id_tercero`, `id_plan_trabajo`, `corte`, `observaciones`, `estado`, `fecha`, `created_at`, `updated_at`) VALUES
(13, 75, 12, 1, NULL, 'Enviado', '2020-09-09 06:41:58', '2020-09-09 06:32:32', '2020-09-09 06:41:58'),
(14, 75, 12, 2, NULL, 'Pendiente', '2020-09-09 06:32:32', '2020-09-09 06:32:32', '2020-09-09 06:32:32'),
(15, 75, 12, 3, NULL, 'Recibido', '2020-09-22 01:45:56', '2020-09-09 06:32:32', '2020-11-02 23:14:47'),
(28, 75, 13, 1, NULL, 'Pendiente', '2020-09-22 01:04:53', '2020-09-22 01:04:53', '2020-09-22 01:04:53'),
(29, 75, 13, 2, NULL, 'Pendiente', '2020-09-22 01:04:53', '2020-09-22 01:04:53', '2020-09-22 01:04:53'),
(30, 75, 13, 3, NULL, 'Pendiente', '2020-09-22 01:04:53', '2020-09-22 01:04:53', '2020-09-22 01:04:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_complementarias_detalle`
--

CREATE TABLE `actividades_complementarias_detalle` (
  `id_actividad_complementaria_detalle` int(11) NOT NULL,
  `id_actividad_complementaria` int(11) NOT NULL,
  `id_actividad_plan_trabajo` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `evidencia` text DEFAULT NULL,
  `link_evidencia` text DEFAULT NULL,
  `fecha_evidencia` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividades_complementarias_detalle`
--

INSERT INTO `actividades_complementarias_detalle` (`id_actividad_complementaria_detalle`, `id_actividad_complementaria`, `id_actividad_plan_trabajo`, `descripcion`, `evidencia`, `link_evidencia`, `fecha_evidencia`, `fecha`, `created_at`, `updated_at`) VALUES
(66, 14, 88, 'sasdasdaadaf', 'efdewfewg', 'effdsfcd', '09/09/2020 - 09/09/2020', '2020-09-09 06:42:53', '2020-09-09 06:42:53', '2020-09-09 06:42:53'),
(67, 15, 88, 'dfcdfdc', 'efef', 'https://www.youtube.com/watch?v=l0U7SxXHkPY&list=RDxpVfcZ0ZcFM&index=5&ab_channel=FutureVEVO', '21/09/2020 - 21/09/2020', '2020-09-22 01:45:36', '2020-09-22 01:45:36', '2020-09-22 01:45:36'),
(68, 13, 88, 'sdasasad', 'vdvdvdvd', 'www.sani.com', '09/09/2020 - 09/09/2020', '2020-09-22 03:42:45', '2020-09-22 03:42:45', '2020-09-22 03:42:45'),
(69, 13, 88, 'sdasasad', 'vdvdvdvd', 'www.sani.com', '09/09/2020 - 09/09/2020', '2020-09-22 03:42:45', '2020-09-22 03:42:45', '2020-09-22 03:42:45'),
(70, 13, 88, 'sdasasad', 'vdvdvdvd', 'www.sani.com', '09/09/2020 - 09/09/2020', '2020-09-22 03:42:45', '2020-09-22 03:42:45', '2020-09-22 03:42:45'),
(71, 13, 88, 'sdasasad', 'vdvdvdvd', 'www.sani.com', '09/09/2020 - 09/09/2020', '2020-09-22 03:42:45', '2020-09-22 03:42:45', '2020-09-22 03:42:45'),
(73, 28, 110, 'vdvd', 'wwwwww', 's', '21/09/2020 - 21/09/2020', '2020-09-22 04:11:11', '2020-09-22 04:11:11', '2020-09-22 04:11:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_plan_trabajo`
--

CREATE TABLE `actividades_plan_trabajo` (
  `id_actividad_plan_trabajo` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `nombre` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `acta_aprobada` text DEFAULT NULL,
  `fecha_aprobada` timestamp NULL DEFAULT NULL,
  `fecha_iniciacion` timestamp NULL DEFAULT NULL,
  `fecha_terminacion` timestamp NULL DEFAULT NULL,
  `institucion` varchar(100) DEFAULT 'Universidad Popular del Cesar',
  `horas_por_semana` int(11) DEFAULT NULL,
  `id_dominio_tipo` int(11) DEFAULT NULL,
  `requiere_actividad_complementaria` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividades_plan_trabajo`
--

INSERT INTO `actividades_plan_trabajo` (`id_actividad_plan_trabajo`, `id_plan_trabajo`, `nombre`, `descripcion`, `acta_aprobada`, `fecha_aprobada`, `fecha_iniciacion`, `fecha_terminacion`, `institucion`, `horas_por_semana`, `id_dominio_tipo`, `requiere_actividad_complementaria`, `created_at`, `updated_at`) VALUES
(88, 12, 'dvdfdn', NULL, 'ddssddsd', NULL, NULL, NULL, 'Universidad Popular del cesar', 2, 18, 1, '2020-09-09 06:32:32', '2020-09-09 06:32:32'),
(109, 13, 'efd', 'grfg', NULL, NULL, '2020-10-05 05:00:00', NULL, 'Universidad Popular del cesar', 2, 21, 1, '2020-09-22 04:10:33', '2020-09-22 04:10:33'),
(110, 13, 'reunion', 'area', NULL, NULL, '2020-09-16 05:00:00', NULL, 'Universidad Popular del cesar', 1, 24, 1, '2020-09-22 04:10:33', '2020-09-22 04:10:33'),
(111, 13, 'qqqqqqqqqqqq', 'dffe', NULL, NULL, '2020-09-29 05:00:00', NULL, 'Universidad Popular del cesar', 1, 24, 1, '2020-09-22 04:10:33', '2020-09-22 04:10:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `analisis_cualitativo_seguimiento`
--

CREATE TABLE `analisis_cualitativo_seguimiento` (
  `id_analisis_cualitativo_seguimiento` int(11) NOT NULL,
  `analisis` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_seguimiento_asignatura` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `analisis_cualitativo_seguimiento`
--

INSERT INTO `analisis_cualitativo_seguimiento` (`id_analisis_cualitativo_seguimiento`, `analisis`, `id_seguimiento_asignatura`, `created_at`, `updated_at`) VALUES
(53, 'Grupo responsable, comprometido con tareas asignadas, asisten a clases y participa de tutorias.', 28, '2020-09-09 16:58:37', '2020-09-09 16:58:37'),
(54, 'Grupo bueno academicamente, agradable para desarrollar las clases y preocupado por la aplicacion de la asignatura.', 28, '2020-09-09 16:58:37', '2020-09-09 16:58:37'),
(55, 'Grupo responsable, comprometido con tareas asignadas, asisten a clases y participa de tutorias.', 29, '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(56, 'En su gran mayoria estudiantes responsables participativos y dinamicos en clases.', 29, '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(57, 'Grupo apatico a las clases, poco participativos, faltan a clases en muchas ocasiones y no asisten a tutorias.', 29, '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(58, 'Grupo poco comprometido con las tareas asignadas, inasistencia a clase, en su gran mayoría no participan de las tutorias.', 29, '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(59, 'Grupo bueno academicamente, agradable para desarrollar las clases y preocupado por la aplicacion de la asignatura.', 29, '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(60, 'Grupo bueno academicamente, agradable para desarrollar las clases y preocupado por la aplicacion de la asignatura.', 30, '2020-09-09 18:08:19', '2020-09-09 18:08:19'),
(63, 'En su gran mayoria estudiantes responsables participativos y dinamicos en clases.', 34, '2020-09-22 18:01:27', '2020-09-22 18:01:27'),
(64, 'Grupo apatico a las clases, poco participativos, faltan a clases en muchas ocasiones y no asisten a tutorias.', 34, '2020-09-22 18:01:27', '2020-09-22 18:01:27'),
(65, 'Grupo responsable, comprometido con tareas asignadas, asisten a clases y participa de tutorias.', 36, '2020-09-22 18:05:15', '2020-09-22 18:05:15'),
(66, 'En su gran mayoria estudiantes responsables participativos y dinamicos en clases.', 36, '2020-09-22 18:05:15', '2020-09-22 18:05:15'),
(67, 'Grupo apatico a las clases, poco participativos, faltan a clases en muchas ocasiones y no asisten a tutorias.', 36, '2020-09-22 18:05:15', '2020-09-22 18:05:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id_asignatura` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `tipo` text DEFAULT NULL,
  `naturaleza` text DEFAULT NULL,
  `prerrequisitos` text DEFAULT NULL,
  `correquisitos` text DEFAULT NULL,
  `habilitable` int(11) NOT NULL,
  `validable` int(11) NOT NULL,
  `homologable` int(11) NOT NULL,
  `num_creditos` int(11) NOT NULL,
  `horas_teoricas` int(11) NOT NULL DEFAULT 0,
  `horas_practicas` int(11) NOT NULL DEFAULT 0,
  `horas_atencion_estudiantes` int(11) NOT NULL DEFAULT 0,
  `horas_preparacion_evaluacion` int(11) NOT NULL DEFAULT 0,
  `horas_totales_trabajo_independiente` int(11) NOT NULL,
  `horas_totales_semestre` int(11) DEFAULT NULL,
  `id_licencia` int(11) NOT NULL,
  `id_academusoft` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id_asignatura`, `codigo`, `nombre`, `tipo`, `naturaleza`, `prerrequisitos`, `correquisitos`, `habilitable`, `validable`, `homologable`, `num_creditos`, `horas_teoricas`, `horas_practicas`, `horas_atencion_estudiantes`, `horas_preparacion_evaluacion`, `horas_totales_trabajo_independiente`, `horas_totales_semestre`, `id_licencia`, `id_academusoft`, `created_at`, `updated_at`) VALUES
(1, 'MT101', 'Calculo I', NULL, NULL, NULL, NULL, 0, 0, 0, 2, 2, 0, 3, 7, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(2, 'MT201C', 'Calculo diferencial e integral', NULL, NULL, NULL, NULL, 0, 0, 0, 4, 2, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(3, 'MT301A', 'Matematicas Fundamentales', NULL, NULL, NULL, NULL, 0, 0, 0, 5, 3, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(4, 'MT301B', 'Algebra lineal', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(5, 'MT301C', 'Matematicas fundamentales', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(6, 'MT302A', 'Logica y conjuntos', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(7, 'MT302B', 'Calculo diferencial', NULL, NULL, NULL, NULL, 0, 0, 0, 4, 2, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(8, 'MT302C', 'Calculo diferencial', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(9, 'MT303A', 'Geometria euclidiana', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(10, 'MT303B', 'Calculo integral', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(11, 'MT303C', 'Calculo integral', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(12, 'MT304A', 'Calculo diferencial en una variable', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(13, 'MT304B', 'Calculo multivariable', NULL, NULL, NULL, NULL, 0, 0, 0, 4, 2, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(14, 'MT304C', 'Estadistica descriptiva calculo de probabilidades', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(15, 'MT305A\r\n', 'Algebra lineal', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(16, 'MT305B', 'Ecuaciones diferenciales ordinarias', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(17, 'MT305C', 'Estadistica inferencial y muestreo', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(18, 'MT305SO', 'Estadistica inferencial y muestreo', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(19, 'MT306A', 'Calculo integral en una variable', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(20, 'MT306B', 'Funciones especiales y ecuaciones diferencial', NULL, NULL, NULL, NULL, 0, 0, 0, 4, 2, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(21, 'MT307A', 'Geometria analitica', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(22, 'MT307B', 'Estadistica descriptiva e inferencial', NULL, NULL, NULL, NULL, 0, 0, 0, 4, 2, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(23, 'MT308A', 'Estadistica descriptiva y probabilidades', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(24, 'MT308B', 'Diseno experimental', NULL, NULL, NULL, NULL, 0, 0, 0, 2, 2, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(25, 'MT309A', 'Calculo de varias variables', NULL, NULL, NULL, NULL, 0, 0, 0, 5, 3, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(26, 'MT309B', 'Analisis numerico', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(27, 'MT310A', 'Estadistica inferencial y muestreo  ', NULL, NULL, NULL, NULL, 0, 0, 0, 4, 2, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(28, 'MT310B', 'Logica conjuntos y grafos', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(29, 'MT311A', 'Ecuaciones diferenciales odinarias', NULL, NULL, NULL, NULL, 0, 0, 0, 4, 2, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(30, 'MT311B', 'Programacion lineal', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(31, 'MT312A', 'Teoria de conjuntos', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(32, 'MT312B', 'Matematicas fundamental', NULL, NULL, NULL, NULL, 0, 0, 0, 4, 2, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(33, 'MT313A', 'Analisis matematico', NULL, NULL, NULL, NULL, 0, 0, 0, 5, 3, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(34, 'MT313B', 'Diseno de agregado', NULL, NULL, NULL, NULL, 0, 0, 0, 2, 2, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(35, 'MT314A', 'Algebra moderna', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(36, 'MT314B', 'Diseno de sondeo', NULL, NULL, NULL, NULL, 0, 0, 0, 2, 2, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(37, 'MT315A', 'Historia y epistemologia de las matemaicas', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(38, 'MT317B', 'Analisis de datos', NULL, NULL, NULL, NULL, 0, 0, 0, 2, 2, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(39, 'MT321A', 'Estadistica descriptiva e inferencial', NULL, NULL, NULL, NULL, 0, 0, 0, 4, 2, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(40, 'MT329B', 'Matematicas fundamental', NULL, NULL, NULL, NULL, 0, 0, 0, 4, 2, 2, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(41, 'MT501C', 'Algebra lineal', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(42, 'PS203', 'Logica matematica', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 3, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(43, 'PS405', 'Estadistica II', NULL, NULL, NULL, NULL, 0, 0, 0, 2, 2, 0, 0, 0, 0, NULL, 1, NULL, '2020-06-06 16:55:24', '2020-06-06 16:55:24'),
(44, 'PS405', 'Estadistica II', NULL, NULL, NULL, NULL, 0, 0, 0, 2, 2, 3, 1, 0, 0, NULL, 3, 1, '2020-06-06 16:55:28', '2020-06-06 17:38:54'),
(45, 'MT305A', 'Algebra lineal', NULL, NULL, NULL, NULL, 0, 0, 0, 3, 2, 2, 1, 3, 0, NULL, 3, 2, '2020-06-06 16:55:28', '2020-06-06 16:55:28'),
(46, 'PS405-15', 'Asignatura de prueba', NULL, NULL, NULL, NULL, 0, 0, 0, 2, 2, 3, 1, 0, 0, NULL, 3, 4, '2020-06-08 22:03:43', '2020-06-08 22:03:43'),
(47, 'DEPO-01A', 'Introduccion a la educacion fisica', 'teorica', 'homologable', 'Ninguno', 'Ninguno', 1, 0, 0, 4, 2, 2, 1, 1, 10, 12, 6, 353535, '2020-09-01 21:53:36', '2020-09-06 02:39:06'),
(48, 'DEPO-01B', 'Deporte y aerobicos 1', 'teorica', 'homologable', 'Ninguno', 'Ninguno', 1, 1, 0, 4, 2, 2, 1, 1, 10, 12, 6, 132345, '2020-09-20 01:47:11', '2020-09-20 01:47:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura_programa`
--

CREATE TABLE `asignatura_programa` (
  `id_asignatura_programa` int(11) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `id_asignatura` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignatura_programa`
--

INSERT INTO `asignatura_programa` (`id_asignatura_programa`, `id_programa`, `id_asignatura`, `created_at`, `updated_at`) VALUES
(1, 1, '41', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(2, 6, '43', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(6, 1, '2', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(7, 18, '3', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(8, 8, '4', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(9, 9, '4', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(10, 10, '4', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(11, 11, '4', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(12, 1, '1', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(13, 2, '1', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(14, 3, '1', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(15, 4, '1', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(16, 18, '6', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(17, 8, '7', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(18, 9, '7', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(19, 10, '7', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(20, 11, '7', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(21, 16, '7', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(22, 1, '8', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(23, 2, '8', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(24, 3, '8', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(25, 4, '8', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(26, 18, '9', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(27, 8, '10', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(28, 9, '10', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(29, 10, '10', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(30, 11, '10', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(31, 1, '11', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(32, 2, '11', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(33, 3, '11', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(34, 4, '11', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(35, 18, '12', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(36, 1, '14', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(37, 2, '14', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(38, 3, '14', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(39, 4, '14', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(40, 7, '1', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(41, 14, '1', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(42, 16, '1', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(43, 18, '21', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(44, 10, '20', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(45, 1, '39', '2020-06-06 17:32:12', '2020-06-06 17:32:12'),
(48, 22, '44', '2020-06-06 17:38:54', '2020-06-06 17:38:54'),
(49, 22, '46', '2020-06-08 22:03:43', '2020-06-08 22:03:43'),
(52, 25, '47', '2020-09-06 02:39:06', '2020-09-06 02:39:06'),
(54, 25, '48', '2020-09-27 03:50:10', '2020-09-27 03:50:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causa_seguimiento`
--

CREATE TABLE `causa_seguimiento` (
  `id_causa_seguimiento` int(11) NOT NULL,
  `id_seguimiento_asignatura` int(11) NOT NULL,
  `causa` varchar(80) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `causa_seguimiento`
--

INSERT INTO `causa_seguimiento` (`id_causa_seguimiento`, `id_seguimiento_asignatura`, `causa`, `created_at`, `updated_at`) VALUES
(169, 28, 'Dias Festivos', '2020-09-09 16:58:37', '2020-09-09 16:58:37'),
(170, 28, 'Deficiencias en conocimientos previos', '2020-09-09 16:58:37', '2020-09-09 16:58:37'),
(171, 28, 'Poco compromiso de los estudiantes en el trabajo academico', '2020-09-09 16:58:37', '2020-09-09 16:58:37'),
(172, 29, 'Asignacion tarde de asignatura', '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(173, 29, 'Poco compromiso de los estudiantes en el trabajo academico', '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(174, 29, 'El no desarrollo de los contenidos de la asignatura prerrequisito', '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(175, 30, 'Deficiencias en conocimientos previos', '2020-09-09 18:08:19', '2020-09-09 18:08:19'),
(176, 30, 'Poco compromiso de los estudiantes en el trabajo academico', '2020-09-09 18:08:19', '2020-09-09 18:08:19'),
(177, 30, 'El no desarrollo de los contenidos de la asignatura prerrequisito', '2020-09-09 18:08:19', '2020-09-09 18:08:19'),
(182, 34, 'Deficiencias en conocimientos previos', '2020-09-22 18:01:27', '2020-09-22 18:01:27'),
(183, 34, 'Tematica extensa', '2020-09-22 18:01:27', '2020-09-22 18:01:27'),
(184, 34, 'Asignacion tarde de asignatura', '2020-09-22 18:01:27', '2020-09-22 18:01:27'),
(185, 36, 'Dias Festivos', '2020-09-22 18:05:14', '2020-09-22 18:05:14'),
(186, 36, 'Deficiencia en comprension de textos', '2020-09-22 18:05:14', '2020-09-22 18:05:14'),
(187, 36, 'Deficiencias en conocimientos previos', '2020-09-22 18:05:14', '2020-09-22 18:05:14'),
(188, 36, 'Tematica extensa', '2020-09-22 18:05:15', '2020-09-22 18:05:15'),
(189, 36, 'Asignacion tarde de asignatura', '2020-09-22 18:05:15', '2020-09-22 18:05:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id_clase` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `tema` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id_clase`, `id_grupo`, `tema`, `estado`, `created_at`, `updated_at`) VALUES
(1, 13, 'Introduccion al deporte', 1, '2020-11-10 05:01:59', '2020-11-10 05:01:59'),
(2, 13, 'Introducción al deporte 2 parte', 1, '2020-11-10 05:02:48', '2020-11-10 05:02:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_asistencia`
--

CREATE TABLE `clase_asistencia` (
  `id_clase_asistencia` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `asistio` int(11) NOT NULL,
  `excusa` int(11) NOT NULL,
  `motivo_excusa` text NOT NULL,
  `archivo_excusa` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clase_asistencia`
--

INSERT INTO `clase_asistencia` (`id_clase_asistencia`, `id_clase`, `id_tercero`, `asistio`, `excusa`, `motivo_excusa`, `archivo_excusa`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 79, 0, 1, 'No pudo ir', '', 1, '2020-11-10 05:27:08', '2020-11-10 05:27:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_detalle`
--

CREATE TABLE `clase_detalle` (
  `id_clase_detalle` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `id_eje_tematico` int(11) DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_acceso`
--

CREATE TABLE `codigo_acceso` (
  `id_codigo_acceso` int(11) NOT NULL,
  `id_plan_desarrollo_asignatura` int(11) NOT NULL,
  `token` text NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `requiere_autorizacion` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `codigo_acceso`
--

INSERT INTO `codigo_acceso` (`id_codigo_acceso`, `id_plan_desarrollo_asignatura`, `token`, `id_asignatura`, `id_grupo`, `requiere_autorizacion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 22, 'adf137234cf4b0d812b3e583a409d3fd', 47, 13, 0, 1, '2020-11-03 16:16:29', '2020-11-03 23:04:23'),
(2, 22, 'a2b6e0e65e127f43ae1da49e3cb29609', 47, 14, 1, 1, '2020-11-03 17:30:46', '2020-11-03 19:58:10'),
(3, 24, '2c4563f7bcb92b2210c11235e603f577', 48, 14, 0, 1, '2020-12-03 19:57:41', '2020-12-03 19:57:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE `dominio` (
  `id_dominio` int(11) NOT NULL,
  `dominio` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dominio`
--

INSERT INTO `dominio` (`id_dominio`, `dominio`, `descripcion`, `id_padre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Tipos de tercero', 'Tipos de tercero', NULL, 1, '2020-02-09 12:41:14', '2020-02-09 12:41:14'),
(2, 'Jefe de departamento', 'Jefe de departamento', 1, 1, '2020-02-09 12:43:11', '2020-02-09 12:43:11'),
(3, 'Docente', 'Docente', 1, 1, '2020-02-09 12:43:11', '2020-02-09 12:43:11'),
(4, 'Alumno', 'Alumno', 1, 1, '2020-02-09 12:43:47', '2020-02-09 12:43:47'),
(5, 'Tipos de notificacion', 'tipos de notificacion', NULL, 1, '2020-03-01 15:49:42', '2020-03-01 15:49:42'),
(6, 'Revision', 'Es cuando hay alguna notificacion al docente de que el archivo que monto el docente fue revisado', 5, 1, '2020-03-01 15:52:17', '2020-03-01 15:52:17'),
(7, 'Tiempo', 'Es cuando el administrador amplia las fechas generales para montar los formatos', 5, 1, '2020-03-01 15:52:17', '2020-03-01 15:52:17'),
(8, 'Extra plazo', 'Es cuando el administrador le da un tiempo especifico para montar los formatos', 5, 1, '2020-03-01 15:53:30', '2020-03-01 15:53:30'),
(9, 'Retraso', 'Es cuando se notifica al docente que tiene formatos atrasados', 5, 1, '2020-03-03 10:00:18', '2020-03-03 10:00:18'),
(10, 'Tipos de formatos', NULL, NULL, 1, '2020-04-03 21:27:45', '2020-04-03 21:27:45'),
(11, 'Seguimiento asignatura', NULL, 10, 1, '2020-04-03 21:27:45', '2020-04-03 21:27:45'),
(12, 'Plan de trabajo', NULL, 10, 1, '2020-04-03 21:27:45', '2020-04-03 21:27:45'),
(13, 'Plan de desarrollo de asignatura', NULL, 10, 1, '2020-04-03 21:27:45', '2020-04-03 21:27:45'),
(14, 'Actividades complementarias', NULL, 10, 1, '2020-04-03 21:27:45', '2020-04-03 21:27:45'),
(16, 'Plan de accion', NULL, 10, 1, '2020-04-10 21:16:49', '2020-04-10 21:16:49'),
(17, 'Tipos de actividades plan de trabajo', NULL, NULL, 1, '2020-04-30 00:34:46', '2020-04-30 00:34:46'),
(18, 'Orientación y evaluación de los trabajos de grado', NULL, 17, 1, '2020-04-30 00:34:46', '2020-04-30 00:34:46'),
(19, 'Investigacion aprobada', NULL, 17, 1, '2020-04-30 00:34:46', '2020-04-30 00:34:46'),
(20, 'Proyeccion social', NULL, 17, 1, '2020-04-30 00:34:46', '2020-04-30 00:34:46'),
(21, 'Cooperación interinstitucional', NULL, 17, 1, '2020-04-30 00:34:46', '2020-04-30 00:34:46'),
(22, 'Crecimiento personal y desarrollo', NULL, 17, 1, '2020-04-30 00:34:46', '2020-04-30 00:34:46'),
(23, 'Actividades administrativas', NULL, 17, 1, '2020-04-30 00:34:46', '2020-04-30 00:34:46'),
(24, 'Otras actividades', NULL, 17, 1, '2020-04-30 00:34:46', '2020-04-30 00:34:46'),
(25, 'Clases', 'Este dominio dice que es una asignatura osea una clase del docente', NULL, 1, '2020-05-28 22:10:40', '2020-05-28 22:10:40'),
(26, 'Tipos de item en plan de asignatura', 'Este tendra los items que tienen mas de una opcion en el plan de asignatura', NULL, 1, '2020-09-06 03:34:59', '2020-09-06 03:34:59'),
(27, 'Objetivos especificos', 'Objetivos especificos', 26, 1, '2020-09-06 03:35:44', '2020-09-06 03:35:44'),
(28, 'Estrategias pedagógicas y metodológicas', 'Estrategias pedagógicas y metodológicas', 26, 1, '2020-09-06 03:37:51', '2020-09-06 03:37:51'),
(29, 'Competencias genericas', 'Competencias genericas', 26, 1, '2020-09-06 03:47:35', '2020-09-06 03:47:35'),
(30, 'Mecanismos de evaluación', 'Mecanismos de evaluación', 26, 1, '2020-09-06 03:51:34', '2020-09-06 03:51:34'),
(31, 'Referencias bibliograficas', 'Referencias bibliograficas', 26, 1, '2020-09-06 03:52:04', '2020-09-06 03:52:04'),
(32, 'Sugerencia plan de asignatura', 'Sugerencia plan de asignatura de parte del docente al jefe de departamento', 5, 1, '2020-09-20 04:19:08', '2020-09-20 04:19:08'),
(33, 'Plan de asignatura', 'Plan de asignatura', 10, 1, '2020-09-20 04:24:32', '2020-09-20 04:24:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eje_tematico`
--

CREATE TABLE `eje_tematico` (
  `id_eje_tematico` int(11) NOT NULL,
  `nombre` varchar(400) NOT NULL,
  `id_unidad_asignatura` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eje_tematico`
--

INSERT INTO `eje_tematico` (`id_eje_tematico`, `nombre`, `id_unidad_asignatura`, `created_at`, `updated_at`) VALUES
(1, 'Distribuciones muestrales(concepto)', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(2, 'Teorema de limite central', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(3, 'Distribucion maestral de media y de proporcion', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(4, 'Distribucion muestra de diferencia de media y de proporcion', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(5, 'Distribucion t-student', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(6, 'Conceptos iniciales: estimadores, estimacion, intervalo de confianza', 2, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(7, 'Estimacion por intervalo para la media y la proporcion', 2, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(8, 'Estimacion por intervalo para la diferencia de media y de proporcion', 2, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(9, 'Determinacion del tamano de muestra para estimar la media y para la proporcion', 2, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(10, 'Conceptos iniciales hipotesis,errores, test,probabilidades de errores, estadistica de prueba,valor p', 3, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(11, 'Procedimiento general de prueba.', 3, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(12, 'Prueba de hipotesis para la media y para la proporcion', 3, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(13, 'Prueba de hipotesis para la diferencia de proporciones y diferencia de medias.', 3, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(14, 'Pruebas chi-cuadrado', 284, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(15, 'Prueba de mcnemar', 284, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(16, 'Indice de disparidad', 284, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(17, 'Pruebas de homogeneidad', 284, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(18, 'Pruebas de asociacion', 284, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(20, 'Graficas y modelos', 164, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(21, 'Modelos lineales y ritmos o velocidades de cambio', 164, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(22, 'Funciones y sus graficas', 164, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(23, 'Funcion inversa: Exponenciales, logaritmicas y propiedades', 164, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(24, 'Funciones hiperbolicas', 164, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(25, 'Una mirada previa al calculo', 165, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(26, 'Calculo de limite de manera grafica y numerica', 165, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(27, 'Calculo analitico de limites', 165, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(28, 'Continuidad y limites laterales', 165, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(29, 'Limites infinitos', 165, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(30, 'Limites al infinito', 165, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(31, 'La derivada y el problema de la recta tangente', 166, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(32, 'Reglas basicas de la derivacion y razon de cambio', 166, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(33, 'Regla del producto, del cociente y derivadas de orden superior', 166, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(34, 'Regla de la cadena', 166, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(36, 'Razones de cambio relacionadas', 166, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(37, 'Derivacion implicita', 166, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(38, 'Derivacion de funciones exponenciales, logaritmicas e hiperbolicas', 166, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(39, 'Derivacion Logaritmica', 166, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(40, 'Derivacion de funciones inversas trigonometricas.', 166, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(42, 'Extremos en un intervalo', 167, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(43, 'El teorema de Rolle y el teorema del valor medio', 167, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(44, 'Funciones crecientes y decrecientes y el criterio de la primera derivada', 167, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(45, 'Concavidad y criterio de la segunda derivada', 167, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(47, 'Regla de L_Hopital', 167, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(48, 'Analisis de graficas.', 167, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(49, 'Problemas de optimizacion', 167, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(50, 'Diferenciales', 167, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(51, 'Concepto de relacion y sus elementos', 177, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(52, 'Propiedades de las relaciones: Reflexiva, simetrica, antisimetrica, transitiva', 177, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(54, 'Clases de relaciones: Equivalencia, orden, orden parcial, orden estricto, orden total', 177, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(55, 'Concepto de particion y clase de equivalencia en conjuntos de elementos', 177, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(56, 'Concepto de Funcion y sus elementos', 177, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(57, 'Clases de funciones: Inyectiva, sobreyectiva, biyectiva, inversa', 177, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(58, 'Historia', 178, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(59, 'Funciones polinomicas: Constante, identica, lineal, afÃ­n a la lineal, cuadratica, cubica', 178, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(60, 'Funciones por tramos: Valor absoluto, signum, mayor entero. Funciones racionales', 178, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(62, 'Funciones trascendentes: Exponencial, logaritmica, trigonometricas, hiperbolicas, logistica', 178, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(63, 'Operaciones binarias y propiedades', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(64, 'Definicion de grupo, anillo y campo', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(65, 'Numeros Naturales, operaciones y propiedades', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(66, 'Numeros Enteros, operaciones y propiedades, estructura de grupo y anillo', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(67, 'Valor absoluto, divisibilidad, Algoritmo de Euclides, M.C.D., Teorema Fundamental de la Aritmetica, M.C.M. Conjuntos Inductivos, Induccion matematica', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(68, 'Numeros Racionales, operaciones y propiedades, estructura de campo. Orden y densidad', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(69, 'Analisis de la ecuacion (x ^2) - 2 = 0, diagonal del cuadrado de lado 1.', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(70, 'Numeros Irracionales. Demostracion de la irracionalidad de , Raiz(5),...', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(71, 'Numeros Reales, operaciones y propiedades; estructura de Campo ordenado y completo. Axioma de completez, propiedad arquimediana. Valor absoluto y propiedades', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(72, 'Ecuaciones e inecuaciones', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(73, 'Numeros Complejos, operaciones y propiedades; modulo, conjugado, propiedades', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(74, 'Teorema de DMoivre, forma trigonometrica de un complejo, raices de un complejo', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(75, 'Anillos de polinomios. Factorizacion de polinomios en los enteros, racionales, reales y complejos Raices de un polinomio', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(76, 'Teorema del Residuo y del Factor', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(77, 'Polinomios en varias variables. Sistemas de ecuaciones. Problemas de aplicacion', 179, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(78, 'Vectores lineales, representacion, operaciones y propiedades', 180, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(79, 'Vectores coordenados en el plano y el espacio, determinacion, operaciones, norma, desigualdad triangular, vector unitario, producto escalar, propiedades, teoremas, angulo entre dos vectores...', 180, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(80, 'Representacion grafica y direccion de un vector en el espacio. Producto vectorial, propiedades y teorema. Area del paralelogramo, volumen del paralelepipedo', 180, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(81, 'Ecuaciones de la linea recta y el plano en el espacio', 180, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(82, 'Solucion de un sistema de ecuaciones lineales por los metodos tradicionales', 181, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(83, 'Sistemas de ecuaciones lineales con solucion unica, infinitas soluciones y que no tienen solucion', 181, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(84, 'Sistemas de ecuaciones lineales homogeneas, propiedades', 181, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(85, 'Matrices, suma, multiplicacion y multiplicacion por un escalar, propiedades', 181, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(86, 'Representacion matricial de un sistema de ecuaciones lineales', 181, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(87, 'Matriz aumentada, operaciones elementales. Solucion de un sistema de ecuaciones lineales por el metodo de Gauss Jordan. Metodo de la inversa de una matriz por Gauss Jordan', 181, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(88, 'Solucion de un sistema de ecuaciones lineales usando la matriz inversa', 181, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(89, 'Determinantes, solucion, propiedades. Solucion de un sistema de ecuaciones lineales por determinantes', 181, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(90, 'Definicion y propiedades', 182, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(91, 'Subespacios vectoriales, combinaciones lineales de vectores, dependencia e independencia lineal de vectores, base y dimension de un espacio y subespacio vectoriales', 182, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(92, 'Definicion de transformacion, definicion de una transformacion lineal, propiedades', 183, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(93, 'Nucleo y rango', 183, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(94, 'Transformaciones lineales asociadas a una matriz', 183, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(97, 'Valores y vectores propios de una matriz cuadrada', 184, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(98, 'Valores y vectores propios de una transformacion lineal', 184, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(99, 'Proposiciones', 185, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(100, 'Conectivos logicos', 185, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(101, 'Negacion, disyuncion, conjuncion, condicional, bicondicional', 185, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(102, 'Tabla de verdad', 185, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(103, 'Tautologias y contradicciones. Equivalencias logica, funciones preposicionales y cuantificadores', 185, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(104, 'Conjuntos, Operaciones entre conjuntos y propiedades', 185, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(105, 'Numero de elementos de un conjunto', 185, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(106, 'Particiones', 185, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(107, 'Producto Cartesiano. Propiedades', 185, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(108, 'Numeros Naturales. Operaciones y propiedades', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(109, 'Numeros Enteros. Operaciones y propiedades', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(110, 'Numeros Racionales y Fracciones. Operaciones y propiedades', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(111, 'Sistemas de representacion de una fraccion: porcentaje y decimal', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(112, 'Razones y proporciones', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(113, 'Numeros Irracionales', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(114, 'Numeros Reales. Operaciones y propiedades', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(115, 'Valor absoluto y propiedades', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(116, 'Ecuaciones, ecuaciones lineales, ecuacion de la recta, pendiente de la recta, ecuacion de la oferta y la demanda, ecuaciones cuadraticas', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(117, 'Inecuaciones', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(118, 'Factorizacion de polinomios', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(119, 'Polinomios en varias variables', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(120, 'Sistemas de ecuaciones', 186, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(121, 'Concepto de funcion', 188, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(122, 'Representacion de las funciones: verbal , numerica, visual, algebraica', 188, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(123, 'Clases de funciones :inyectiva , sobreyectiva , biyectiva , inversa', 188, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(124, 'algebra de funciones', 188, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(125, 'Variacion :directa e inversa , conjunta y combinada', 188, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(126, 'Funciones polinomicas', 188, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(127, 'Funciones especiales: Por tramos, valor absoluto, signum, mayor entero, otras funciones racionales', 188, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(128, 'Funciones trascendentes: Exponenciales , logaritmicas , trigonometricas', 188, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(129, 'Estudio de casos administrativos, contables y economicos modelados por funciones', 188, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(130, 'Concepto de proposicion y clases de proposiciones', 189, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(131, 'Conectivos logicos. Negacion, disyuncion, conjuncion, condicional, bicondicional; tablas de verdad. Tautologias y Contradicciones. Equivalencia Tautologica', 189, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(132, 'Funciones Proposicionales. Sujetos y Predicados. Cuantificador Universal. Cuantificador Existencial', 189, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(134, 'Introduccion. Reglas de inferencia logica: Modus Ponendo Ponens. Modus Tollendo Tollens, Modus Tollendo Ponens. Ley de la doble negacion. Ley de Adjuncion y Simplificacion. Ley de Adicion...', 190, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(135, 'Nocion de conjunto, representacion, notacion y generalidades.', 191, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(136, 'Operaciones entre conjuntos: Union, propiedades y demostraciones', 191, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(137, 'Interseccion, propiedades y demostraciones. Diferencia y complemento, propiedades y demostraciones. Diferencia simetrica, propiedades y demostraciones', 191, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(138, 'Conjunto de partes', 191, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(139, 'Producto Cartesiano, propiedades y demostraciones', 191, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(140, 'Numero de elementos de un Conjunto. Aplicaciones', 191, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(141, 'Sistemas decimal, binario, octal, hexadecimal. Operaciones basicas: Adicion y sustraccion, complementos. Multiplicacon. Division. Conversion entre sistemas.', 192, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(142, 'Definicion de Algebra de Boole. Principio de Dualidad. Propiedades', 193, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(143, 'Compuertas Logicas y Operaciones basicas. Otras propiedades de Algebras de Boole.', 193, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(144, 'Funciones Booleanas. Simplificacion de Funciones Booleanas. Sumas y Productos', 193, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(145, 'Mapas de Carnaug. Forma Canonica de una funcion Booleana. Minterms y Maxterms.', 193, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(146, 'Entorno en R', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(147, 'Entorno agujereado', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(148, 'Definicion de sucesiones', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(149, 'Clases de sucesiones', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(150, 'Axioma de completez', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(151, 'Limites de sucesiones', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(152, 'Propiedades de los limites para sucesiones', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(153, 'Teorema del encaje para sucesion', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(154, 'Teorema del valor absoluto', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(155, 'Divergencia y convergencia de sucesiones', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(156, 'Algebra de sucesiones', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(157, 'El numero e', 194, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(158, 'Limite de una funcion en un punto', 195, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(159, 'Propiedades fundamentales del limite de una funcion', 195, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(160, 'Limites en el infinito', 195, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(161, 'Formas indeterminadas y limites fundamentales', 195, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(162, 'Continuidad de una funcion en un punto', 195, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(163, 'Continuidad en un intervalo', 195, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(164, 'Propiedades de funciones continuas', 195, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(165, 'Clasificacion de la continuidad', 195, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(166, 'Concepto e interpretacion de la derivada de una funcion', 196, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(167, 'Procesos de derivacion de funciones reales', 196, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(168, 'Diferencial de una funcion', 196, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(169, 'Derivadas y diferenciales de orden superior', 196, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(170, 'Funciones en formas parametricas y sus derivadas', 196, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(171, 'Derivacion implicita', 196, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(172, 'Formas indeterminadas y regla de L_Hopital', 196, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(173, 'Teorema de los valores extremos', 197, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(174, 'Definicion de puntos criticos de una funcion', 197, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(175, 'Teorema de Rolle', 197, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(176, 'Teorema del valor medio', 197, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(177, 'Funciones crecientes, decrecientes y concavidad', 197, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(178, 'Maximos y minimos', 197, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(179, 'Criterio de la segunda derivada', 197, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(180, 'Representacion grafica de funciones', 197, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(182, 'Modelado y solucion de problemas geometricos', 197, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(183, 'Modelado y solucion de problemas fisicos', 197, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(184, 'Definicion de sucesiones', 199, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(185, 'Clases de sucesiones', 199, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(186, 'Axioma de completez', 199, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(187, 'Limite de sucesiones', 199, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(188, 'Propiedades de los limites de sucesiones', 199, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(189, 'Desigualdades lineales', 199, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(190, 'Desigualdades cuadraticas', 199, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(191, 'Divergencia y convergencia de sucesiones', 199, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(192, 'Algebra de sucesiones', 199, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(193, 'El numero e: Limite Neperiano', 199, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(194, 'Limite de una funcion en un punto', 200, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(195, 'Propiedades fundamentales de limite de una funcion', 200, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(196, 'Limites en el infinito', 200, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(197, 'Formas indeterminadas y limites fundamentales', 200, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(198, 'Continuidad de una funcion en un punto, en un intervalo.', 200, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(199, 'Propiedades de las funciones continuas', 200, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(200, 'Clasificacion de la continuidad', 200, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(201, 'Discontinuidad y clasificacion de las discontinuidades', 200, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(202, 'Teorema sobre funciones continuas, algebra de funciones continuas, limites de la funcion compuesta', 200, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(203, 'Ejercicios de aplicacion', 200, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(204, 'Definicion de derivada de una funcion y notaciones usadas', 201, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(205, 'Relacion entre la derivada y la continuidad de una funcion de variable real', 201, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(206, 'Diferentes interpretaciones de la derivada de una funcion: como razon de cambio, como pendiente de la recta tangente a una curva', 201, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(207, 'Incrementos y tasa', 201, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(208, 'Procesos de derivacion de funciones reales', 201, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(209, 'Diferencial de una funcion. Reglas de la derivada', 201, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(210, 'Derivadas y diferenciales de orden superior', 201, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(211, 'Derivada implicita', 201, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(212, 'Teorema del valor medio y teorema de valores extremos', 201, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(213, 'Definicion De puntos criticos de una funcion: maximos y minimos', 201, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(214, 'Definicion De puntos criticos de una funcion: maximos y minimos', 202, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(215, 'Criterio de la primera derivada para extremos relativos', 202, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(216, 'Concavidad y puntos de inflexion', 202, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(217, 'Criterio de la segunda derivada para concavidad', 202, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(218, 'Problemas de maximos y minimos', 202, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(219, 'La derivada como razon de cambio', 202, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(220, 'Aplicaciones de problemas practicos del saber especifico: costo marginal, ingreso marginal, utilidad marginal, elasticidad de la oferta y la demanda', 202, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(221, 'Resena historica', 203, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(222, 'Definiciones de: axioma, postulado, teorema, corolario, teorema reciproco, lema, escolio, problema, punto, criterios fisicos y geometricos, semirrecta, segmento, plano, semiplano, interseccion...', 203, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(223, 'Posicion relativa entre dos rectas', 203, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(224, 'Determinacion de un plano', 203, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(225, 'Posicion relativa entre una recta y un plano', 203, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(226, 'Posicion relativa entre dos planos', 203, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(227, 'Construcciones con regla y compas de: Rectas paralelas y perpendiculares', 203, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(228, 'Operaciones entre segmentos', 204, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(229, 'Bisectriz', 204, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(230, 'Angulos, sistemas de Medidas: radian, grados sexagesimal y centesimal, clases: recto, agudo, obtuso, llano, nulo, adyacentes, complementarios, suplementarios, opuestos por el vertice, consecutivo...', 204, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(231, 'Mediatriz', 204, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(232, 'Teoremas sobre: angulos adyacentes, consecutivos, opuestos por el vertice, lados perpendiculares, paralelos, angulos formados por dos paralelas y una secante', 204, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(233, 'Angulo diedro y poliedro', 204, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(234, 'Construcciones con regla y compas: copiarangulos, angulo recto, trazada de mediatriz, Bisectriz, triseccion de algunos angulos especiales', 204, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(235, 'Triangulo: elementos, clasificaciones, lineas notables.', 205, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(236, 'Congruencia de triangulos', 205, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(237, 'Propiedades de los triangulos isosceles.', 205, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(238, 'Desigualdades en el triangulo', 205, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(239, 'Lugares geometricos: la mediatriz, la bisectriz, mediana y altura, incentro, circuncentro, baricentro y ortocentro', 205, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(240, 'Rectas paralelas', 206, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(241, 'Existencia de paralelas', 206, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(242, 'Postulado de Euclides', 206, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(243, 'Angulos formados por dos rectas y una transversal', 206, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(244, 'Propiedades de los angulos entre dos paralelas y una transversal', 206, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(245, 'Distancia entre paralelas', 206, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(246, 'Base media en el triangulo', 206, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(247, 'Mediana relativa a la hipotenusa', 206, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(248, 'Construcciones geometricas', 206, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(249, 'Clasificaciones de cuadrilateros', 207, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(250, 'Paralelogramos', 207, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(251, 'Rectangulos, rombos, cuadrados y romboides', 207, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(252, 'Trapecios, trapecios isosceles, trapecio escaleno, trapecio rectangulo', 207, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(253, 'Trapezoides: simetricos y asimetricos', 207, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(254, 'Poligonos regulares e irregulares, suma de angulos internos e internos, suma de diagonales', 207, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(255, 'Aplicaciones a situaciones problemas', 207, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(256, 'Construcciones con regla y compas: de cuadrilateros', 207, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(257, 'Definicion y elementos', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(258, 'Posicion relativa entre un punto y una circunferencia', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(259, 'Circunferencias que pasan por uno, dos o tres puntos dados', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(260, 'Posicion relativa entre una recta y una circunferencia', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(261, 'Posicion relativa entre dos circunferencias', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(262, 'Angulos centrales, arcos y cuerdas, longitud de una circunferencia', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(263, 'Propiedades de un diametro perpendicular a una cuerda', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(264, 'Arcos y paralelas', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(265, 'Angulos relacionados con la circunferencia', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(268, 'Propiedades de las rectas tangentes desde un punto exterior', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(269, 'CÃ­rculo, sector circular, corona, areas', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(270, 'Construccion de rectas tangentes desde un punto exterior', 208, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(271, 'Segmentos proporcionales, division de un segmento en una razon dada', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(272, 'Teoremas: Paralelas y transversales, Thales, paralela a los lados de un triangulo, bisectriz de un angulo interior de un trangulo, semejanza de triangulos', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(273, 'Relacion metrica en los triangulos', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(274, 'Proyecciones: de un punto, de un segmento sobre una recta', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(275, 'Teoremas referentes al triÃ¡ngulo rectangulo: Altura correspondiente a la hipotenusa, Pitagoras, generalizacion del teorema de Pitagoras', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(276, 'Clasificacion de triangulos conociendo el valor de sus lados', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(277, 'Propiedades metricas de las bisectrices', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(278, 'Semejanza de triangulos', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(279, 'Relaciones metricas en triangulos rectangulos', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(280, 'Relaciones metricas en triangulos oblicuangulos', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(281, 'Relaciones metricas en la circunferencia', 209, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(282, 'Regiones planas', 210, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(283, 'Postulados para areas de regiones planas', 210, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(284, 'Area de: triangulos, cuadrilateros, poligonos, circulos', 210, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(285, 'Ecuaciones para calcular el area de regiones planas basicas, Ecuacion de Heron', 210, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(286, 'Prismas: clases, volumen, area lateral y total', 211, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(287, 'Piramides: tronco, volumen, area lateral y total', 211, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(288, 'Cilindros: superficie de revolucion, volumen, area lateral y total', 211, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(289, 'Conos: superficie de revolucion, area lateral y total', 211, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(290, 'Esfera: superficie esferica, area y volumen', 211, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(291, 'Traslaciones: propiedades (clausurativa, invertiva y asociativa)', 212, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(292, 'Rotaciones: propiedades (inversa y asociativa)', 212, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(293, 'Reflexiones: Propiedades', 212, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(294, 'Homotecias: Propiedades: nula, clusurativa, modulativa, invertiva, asociativa)', 212, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(295, 'Simetrias: Propiedades (clausurativa, invertiva, modulativa, asociativa)', 212, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(296, 'Construcciones con regla y compas', 212, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(297, 'Integrales indefinidas', 213, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(298, 'Ecuaciones diferenciales, problemas de valor inicial y modelos matematicos', 213, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(299, 'Integrales por sustitucion', 213, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(300, 'Estimacion con sumas finitas', 213, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(301, 'Sumas de Riemann e integrales definidas', 213, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(302, 'Propiedades, area y Teorema del valor medio', 213, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(303, 'Teorema fundamental del Calculo', 213, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(304, 'Sustitucion en integrales definidas', 213, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(305, 'Integracion numerica', 213, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(306, 'Funciones trascendentes', 214, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(307, 'Formulas basicas de integracion', 214, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(308, 'Integracion por partes', 214, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(309, 'Integrales trigonometricas', 214, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(310, 'Fracciones parciales', 214, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(311, 'Sustitucion trigonometrica', 214, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(312, 'Sustituciones diversas', 214, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(313, 'Integrales Impropias', 214, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(314, 'Series infinitas', 215, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(315, 'Las pruebas de la integral y de comparacion', 215, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(316, 'Criterios de la razon y la raiz', 215, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(317, 'Series alternativas y convergencia absoluta', 215, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(318, 'Series de potencias', 215, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(319, 'Series de Taylor y de Maclaurin', 215, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(320, 'Sucesiones', 217, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(321, 'Series infinitas', 217, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(322, 'Series convergente', 217, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(323, 'Series y progresiones', 217, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(324, 'Progresion aritmetica', 217, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(325, 'Suma de terminos de una progresion aritmetica', 217, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(326, 'Progresion geometrica', 217, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(327, 'Suma de terminos de una progresion geometrica', 217, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(328, 'Antidiferenciacion', 218, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(329, 'Reglas basicas de integracion', 218, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(330, 'Ingreso, costo y utilidad total. Costo almacenaje de inventario', 218, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(331, 'Integrales por sustitucion simple y por partes', 218, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(332, 'La integral definida', 218, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(333, 'Primer teorema fundamental del calculo', 218, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(334, 'Segundo teorema fundamental del calculo', 218, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(335, 'Integrales por sustitucion simple y por partes', 219, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(336, 'Integracion de potencias trigonometricas', 219, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(337, 'Integracion por sustituciones trigonometricas', 219, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(338, 'Funciones racionales y fracciones parciales', 219, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(339, 'Sustituciones diversas o de racionalizacion', 219, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(340, 'Integracion numerica', 219, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(341, 'Exceso de utilidad neta', 220, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(342, 'Ganancias netas de una maquinaria industrial', 220, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(343, 'La curva de demanda y la disposicion a gastar de los consumidores', 220, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(344, 'Excedente de los consumidores y de los productores', 220, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(345, 'Curvas de aprendizaje', 220, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(346, 'Resena historica del calculo diferencial', 221, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(347, 'Nocion intuitiva de limite', 221, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(348, ' Definicion de Cauchy (rigurosa del limite de una funcion)', 221, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(349, 'Teoremas sobre limites, unicidad del limite, algebra de limites, limites de funciones iguales, teoria del sandwich, funciones transcendentes y sus limites', 221, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(350, 'Limites laterales, relacion entre limites y limites laterales', 221, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(351, 'Ejercicios de aplicacion', 221, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(352, 'Idea intuitiva y definicion de funcion continÃºa en un punto', 222, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(353, 'Discontinuidad y clasificacion de las discontinuidades', 222, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(354, 'Continuidad sobre funciones', 222, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(355, 'Teorema sobre funciones continuas, algebra de funciones continuas, limites de la funcion compuesta', 222, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(356, 'Continuidad en un intervalo', 222, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(357, 'Ejercicios de aplicacion', 222, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(358, 'Breve resena historica de la derivada', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(359, 'Definicion de derivada de una funcion y notaciones usadas', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(360, 'Relacion entre la derivada y la continuidad de una funcion de variable real', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(361, 'Derivadas laterales', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(362, 'Reglas de derivacion', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(363, 'Teorema de derivada de la funcion compuesta (regla de la cadena)', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(364, 'Derivadas de orden superior', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(365, 'Derivacion implicita', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(366, 'Derivadas de las funciones trigonometricas', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(367, 'Funciones trigonometricas inversas y sus derivadas', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(368, 'Derivada de las funciones exponencial y logaritmica', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(369, 'Las funciones hiperbolica e hiperbolicas inversas y sus derivadas', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(370, 'Ejercicios de aplicacion', 223, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(371, 'Limites al infinito, teoremas sobre limites al infinito', 225, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(372, 'Asintotas de una curva, asintotas horizontales, clasificacion de las asintotas', 225, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(373, 'Limites infinitos y asintotas verticales', 225, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(374, 'Asintotas oblicuas, regla general para determinar la asintota de una curva', 225, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(375, 'La regla de L_Hospital', 225, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(376, 'Variantes de la regla  L_Hospital', 225, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(377, 'Ejemplos ilustrativos de la regla L_Hospital  y otras formas indeterminadas  ', 225, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(378, 'Interpretacion geometrica y fisica de la derivada', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(379, 'Valores extremos de una funcion de variable real', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(380, 'Extremos relativos. Teorema De Fermat (condicion necesaria)', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(381, 'Extremos absolutos. Teorema de los valores extremos', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(382, 'Teorema de Rolle y Teorema de Legendre o del valor medio para derivadas', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(383, 'Ejemplos de aplicaciones de estos teoremas', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(384, 'Criterio de la primera derivada para crecimiento y decrecimiento', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(385, 'Criterio de la primera derivada para extremos relativos', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(386, 'Concavidad y puntos de inflexion', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(387, 'Criterio de la segunda derivada para concavidad', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(390, 'Problemas de maximos y minimos', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(391, 'La derivada como razon de cambio', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(392, 'Variables relacionadas, variables ligadas y razon de cambio', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(393, 'Problemas sobre variables relacionadas', 226, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(394, 'Analisis y trazados de curvas ', 227, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(395, 'Dominio de la funcion', 227, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(396, 'Posibles puntas de discontinuidad', 227, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(398, 'Interceptos de la curva con los ejes coordenadas', 227, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(399, 'Asintotas de la curva', 227, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(400, 'Intervalos donde crece y decrece la curva, extremos relativos, analizando el signo de la derivada', 227, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(401, 'Intervalos de concavidad y posibles puntos de inflexion analizando el signo de la segunda derivada', 227, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(402, 'Definicion de diferencial', 228, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(403, 'Interpelacion geometrica de la diferencial y formulas diferenciales', 228, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(404, 'Aproximaciones y estimaciones de errores', 228, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(405, 'Aplicaciones', 228, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(406, 'Geometria del espacio euclidiano', 229, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(407, 'Funciones escalares (dominio en )', 229, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(408, 'Funciones vectoriales (dominio en e imagenes en )', 229, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(409, 'Limites y continuidad', 229, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(410, 'Derivadas de funciones', 229, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(411, 'Derivadas parciales', 229, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(412, 'Derivadas direccionales', 229, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(413, 'La diferencial', 230, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(414, 'Gradiente y aplicaciones', 230, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(415, 'Derivadas de orden superior', 230, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(416, 'Regla de la cadena', 230, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(417, 'Derivacion implicita', 230, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(418, 'Maximos y minimos', 230, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(419, 'Multiplicadores de Lagrange', 230, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(420, 'Modelado y solucion de problemas fisicos y geometricos', 230, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(421, 'Integrales dobles', 231, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(422, 'Cambio de coordenadas en integrales dobles', 231, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(423, 'Modelado y solucion de problemas con integrales dobles', 231, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(424, 'Integrales triples', 231, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(425, 'Cambio de coordenadas en integrales triples', 231, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(426, 'Modelado y solucion de problemas con integrales triples', 231, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(427, 'Integral de linea de campos escalares', 232, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(428, 'Integral de linea de campos vectoriales', 232, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(429, 'Teorema fundamental del calculo para integrales de linea', 232, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(430, 'Teorema de Green', 232, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(431, 'Superficies parametrizadas', 232, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(432, 'Integral de superficie de campos escalares', 232, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(433, 'Integral de superficie de campos vectoriales', 232, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(434, 'Teorema de Stokes', 232, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(435, 'Teorema de Gauss', 232, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(436, 'Generalidades', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(437, 'Naturaleza de la estadistica', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(438, 'Etapas de la investigacion estadistica', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(440, 'Diseno de la investigacion', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(441, 'Distribucion de frecuencias', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(442, 'Representacion grafica y Propiedades de las frecuencias', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(443, 'Medidas de posicion', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(444, 'Promedios simples y ponderados', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(445, 'Propiedades y caracteristicas de los promedios', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(446, 'Usos, ventajas y desventajas de la medidas de Posicion', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(447, 'Cuantiles', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(448, 'Medidas de dispersion o variacion', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(449, 'Medidas de Asimetria y apuntamiento', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(451, 'Numeros Indices', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(452, 'Ejercicios de Aplicacion', 233, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(453, 'Generalidades', 234, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(454, 'Probabilidades elementales', 234, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(455, 'Conceptos de Espacio Muestral y Esperanza Matematica', 234, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(456, 'Reglas de probabilidad', 234, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(457, 'Regla de adicion para sucesos mutuamente excluyentes y para sucesos mutuamente no excluyentes', 234, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(458, 'Regla de la multiplicacion para sucesos mutuamente independientes o para sucesos mutuamente dependientes', 234, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(459, 'Tecnicas de conteo', 234, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(460, 'Probabilidad condicional', 234, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(461, 'Teorema o formula de Bayes', 234, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(462, 'Ejercicios de Aplicacion', 234, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(463, 'Generalidades', 235, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(464, 'Variables aleatorias discretas', 235, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(465, 'Variables aleatorias continuas', 235, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(466, 'Funciones de probabilidad', 235, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(467, 'Ejercicios de Aplicacion', 235, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(468, 'Distribuciones especiales discretas', 236, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(469, 'Distribucion binomial', 236, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(470, 'Distribucion de Poisson', 236, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(471, 'Distribucion Hipergeometrica', 236, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(472, 'Distribuciones especiales continuas', 236, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(473, 'Distribucion normal', 236, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(474, 'Distribucion exponencial', 236, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(475, 'Distribucion Chi-cuadrado', 236, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(476, 'Ejercicios de Aplicacion', 236, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(477, 'Vectores lineales, representacion, operaciones y propiedades', 237, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(478, 'Vectores coordenados en el plano y el espacio, determinacion, operaciones, norma, desigualdad triangular, vector unitario, producto escalar, propiedades, teoremas, angulo entre dos vectores, proyecc', 237, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(479, 'Representacion grafica y direccion de un vector en el espacio. Producto vectorial, propiedades y teorema. Area del paralelogramo, volumen del paralelepipedo', 237, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(480, 'Ecuaciones de la linea recta y el plano en el espacio', 237, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(481, 'Solucion de un sistema de ecuaciones lineales por los metodos tradicionales', 239, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(482, 'Sistemas de ecuaciones lineales con solucion unica, infinitas soluciones y que no tienen solucion', 239, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(483, 'Sistemas de ecuaciones lineales homogeneas, propiedades', 239, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(484, 'Matrices, suma, multiplicacion y multiplicacion por un escalar, propiedades', 239, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(485, 'Representacion matricial de un sistema de ecuaciones lineales', 239, '2020-04-10 20:49:20', '2020-04-10 20:49:20');
INSERT INTO `eje_tematico` (`id_eje_tematico`, `nombre`, `id_unidad_asignatura`, `created_at`, `updated_at`) VALUES
(486, 'Matriz aumentada, operaciones elementales. Solucion de un sistema de ecuaciones lineales por el metodo de Gauss Jordan. Metodo de la inversa de una matriz por Gauss Jordan', 239, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(487, 'Solucion de un sistema de ecuaciones lineales usando la matriz ', 239, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(488, 'Determinantes, solucion, propiedades. Solucion de un sistema de ecuaciones lineales por determinantes', 239, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(489, 'Definicion y propiedades', 240, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(490, 'Subespacios vectoriales, combinaciones lineales de vectores, dependencia e independencia lineal de vectores, base y dimension de un espacio y subespacio vectoriales', 240, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(491, 'Definicion de transformacion, definicion de una transformacion lineal, propiedades', 241, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(492, 'Nucleo y rango', 241, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(493, 'Transformaciones lineales asociadas a una matriz', 241, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(494, 'Valores y vectores propios de una transformacion lineal', 242, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(495, 'Valores y vectores propios de una matriz cuadrada', 242, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(496, 'Ecuaciones diferenciales; orden y grado', 243, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(497, 'Solucion de una ecuacion diferencial', 243, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(498, 'Solucion general', 243, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(499, 'Obtencion de la ecuacion diferencial a partir de la solucion general', 243, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(500, 'Evolucion historica de algunas ecuaciones diferenciales importantes', 243, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(501, 'Conceptos basico y teoremas', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(502, 'Ecuaciones diferenciales de varias separable', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(503, 'Ecuaciones diferenciales reducibles a separables', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(504, 'Ecuaciones diferenciales homogeneas', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(505, 'Ecuaciones diferenciales transformables a homogeneas', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(506, 'Ecuaciones diferenciales exactas', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(507, 'Factor integrante', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(508, 'Ecuacion diferencial lineal de primer orden', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(509, 'Ecuaciones diferenciales reducibles a lineales', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(510, 'Metodo de eliminacion para sistemas lineales con coeficientes ', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(511, 'Modelado y solucion de problemas fisicos y geometricos', 244, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(512, 'Ecuaciones diferenciales de orden y grado superior', 245, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(513, 'Ecuaciones diferenciales lineales homogeneas', 245, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(514, 'Ecuaciones diferenciales lineales no homogeneas, metodo de coeficientes indeterminados y variacion de parametros', 245, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(515, 'Modelado y solucion de problemas fisicos', 245, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(516, 'Definicion, propiedades y teoremas basicos', 246, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(517, 'Solucion de problemas de valor inicial', 246, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(518, 'Sistemas lineales', 246, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(519, 'Solucion de sistemas lineales homogeneos con coeficientes constantes', 246, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(520, 'Modelado y solucion de problemas fisicos', 246, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(521, 'Series de potencias', 247, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(522, 'El metodo de serie de potencias', 247, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(523, 'Puntos ordinarios y singulares', 247, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(524, 'Ecuacion de Euler', 247, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(525, 'Funciones de Bessel', 247, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(526, 'Polinomios de Legendre', 247, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(527, 'Modelado y solucion de problemas fisicos', 247, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(528, 'Muestreo aleatorio con y sin reemplazo', 248, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(529, 'Media muestral y varianza muestral', 248, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(530, 'Propiedades de media muestral y Varianza muestral', 248, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(531, 'Distribucion muestral de medias', 248, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(532, 'Distribucion muestral de proporciones', 248, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(533, 'Estimacion puntual', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(534, ' Generalidades', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(535, 'Definicion de estimacion puntual', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(536, 'Propiedades de los estimadores: Insesgado, eficiente, consistente y suficiente', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(537, 'Estimacion por intervalos', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(538, 'Definicion de estimacion por intervalos', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(540, 'Intervalo de confianza para estimar la media poblacional', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(541, 'Intervalo de confianza para estimar la diferencia de medias poblacionales', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(542, 'Intervalo de confianza para estimar la proporcion poblacional', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(543, 'Intervalo de confianza para estimar la diferencia de proporciones poblacionales', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(544, 'Intervalo de confianza para estimar la varianza poblacional', 249, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(545, 'Definicion de pruebas de hipotesis', 250, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(546, 'Prueba de hipotesis para la media poblacional', 250, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(547, 'Prueba de hipotesis para la diferencia de medias poblacionales', 250, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(548, 'Prueba de hipotesis para la proporcion poblacional', 250, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(549, 'Prueba de hipotesis para la diferencia de proporciones poblacionales', 250, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(550, 'Prueba de hipotesis para la varianza poblacional', 250, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(551, 'Muestreo no probabilistico', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(552, 'Muestreo por conveniencia', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(553, 'Muestreo por juicio o por criterio', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(554, 'Muestro por cuotas', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(555, 'Muestreo por bola de nieve', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(556, 'Muestreo probabilistico', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(557, 'Generalidades', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(558, 'Muestreo aleatorio simple', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(559, 'Muestreo aleatorio estratificado', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(560, 'Muestreo sistematico', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(561, 'Muestreo por conglomerados (superficies o areas)', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(562, 'Muestreo por etapas', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(563, 'Muestreo por fases multiples', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(564, 'Metodos mixtos', 251, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(565, 'Generalidades', 252, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(567, 'El metodo de minimos cuadrados', 252, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(568, 'Inferencias basadas en estimadores de minimos cuadrados', 252, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(569, 'Regresion simple y regresion multiple', 252, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(570, 'Analisis de correlacion', 252, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(571, 'Series de Tiempos o cronologicas', 252, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(572, 'Muestreo aleatorio con y sin reemplazo', 253, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(573, 'Media muestral y varianza muestral', 253, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(574, 'Propiedades de media muestral y Varianza muestral', 253, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(575, 'Distribucion muestral de medias', 253, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(576, 'Distribucion muestral de proporciones', 253, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(577, 'Estimacion puntual', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(578, 'Generalidades', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(579, 'Definicion de estimacion puntual', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(580, 'Propiedades de los estimadores: Insesgado, eficiente, consistente y suficiente', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(581, 'Estimacion por intervalos', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(582, 'Definicion de estimacion por intervalos', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(583, 'Intervalo de confianza para estimar la media poblacional', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(584, 'Intervalo de confianza para estimar la diferencia de medias poblacionales', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(585, 'Intervalo de confianza para estimar la proporcion poblacional', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(586, 'Intervalo de confianza para estimar la diferencia de proporciones poblacionales', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(587, 'Intervalo de confianza para estimar la varianza poblacional', 254, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(588, 'Definicion de pruebas de hipotesis', 255, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(589, 'Prueba de hipotesis para la media poblacional', 255, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(590, 'Prueba de hipotesis para la diferencia de medias poblacionales', 255, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(591, 'Prueba de hipotesis para la proporcion poblacional', 255, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(592, 'Prueba de hipotesis para la diferencia de proporciones poblacionales', 255, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(593, 'Prueba de hipotesis para la varianza poblacional', 255, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(594, 'Muestreo no probabilistico', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(595, 'Muestreo por conveniencia', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(596, 'Muestreo por juicio o por criterio', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(597, 'Muestro por cuotas', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(598, 'Muestreo por bola de nieve', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(599, 'Muestreo probabilistico', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(600, 'Generalidades', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(601, 'Muestreo aleatorio simple', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(602, 'Muestreo aleatorio estratificado', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(603, 'Muestreo sistematico', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(604, 'Muestreo por conglomerados (superficies o areas)', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(605, 'Muestreo por etapas', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(606, 'Muestreo por fases multiples', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(607, 'Metodos mixtos', 256, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(608, 'Generalidades', 257, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(609, 'El metodo de minimos cuadrados', 257, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(610, 'Inferencias basadas en estimadores de minimos cuadrados', 257, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(611, 'Regresion simple y regresion multiple', 257, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(612, 'Analisis de correlacion', 257, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(613, 'Series de Tiempos o cronologicas pos o cronologicas', 257, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(614, 'Resena Historica. Funcion primitiva o antiderivada', 258, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(615, 'Teoremas', 258, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(616, 'Integral indefinida', 258, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(617, 'Primeras formulas de integracion', 258, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(618, 'Regla de sustitucion o cambio de variable', 258, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(619, 'Aplicaciones de las ecuaciones diferenciales de primer orden y a la fisica en el movimiento rectilineo', 258, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(620, 'Ejercicios', 258, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(621, 'Tabla inicial de integrales indefinidas (primera tabla de integral)', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(622, 'Formula para integracion por partes', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(623, 'Observaciones importantes del metodo de integracion por partes y ejemplos ilustrativos del metodo', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(624, 'Integral por sustitucion', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(625, 'Integrales de potencias de funciones trigonometricas', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(628, 'Integrales de la forma INT( sen n udu) y INT( cos n udu)', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(629, 'Integrales de la forma INT( sen m u cos n udu)', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(631, 'Integrales de la forma INT( tan m udu) y INT( cot m udu) m pert z + m >= 2', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(632, 'Integrales de la forma INT( sec n udu) y INT( csc n udu)', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(633, 'Integrales de la forma INT( tan m u. sec n udu) y INT( cot m u. cse n udu)', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(634, 'Sustituciones trigonometricas', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(636, 'Integrales que contienen expresiones de la forma (a 2 - u 2 ) r , (a 2 + u 2 ) r , (u 2 - a 2 ) r', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(637, 'Integracion de expresiones que contienen trinomio de la forma ax 2 + bx + c, a dif 0', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(638, 'Integracion por descomposicion en fracciones simples', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(639, 'Integracion de funciones racionales propias simples de los cuatro tipo', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(640, 'Sustituciones diversas (otras sustituciones)', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(641, 'Ejercicios', 259, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(642, 'Notacion sigma ( ) y propiedades de la sumatoria', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(643, 'Particion de un intervalo cerrado', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(644, 'Area bajo una curva utilizando las sumas superiores e inferiores', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(646, 'Suma de Riemann - Integral de Riemann', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(647, 'Algebra de funciones integrables (propiedades de la Integral definida)', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(648, 'Relacion entre la integral y la continuidad de una funcion de variable real', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(649, 'Teorema del valor intermedio', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(650, 'Teorema del valor medio (T. V. M.) para integrales', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(651, 'Primer teorema fundamental del calculo: derivada de una integral', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(652, 'Segundo teorema fundamental del calculo', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(654, 'Algunas propiedades que ayudan a simplificar los calculos en algunas integrales', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(655, 'Ejercicios', 260, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(656, 'Integrales impropias del tipo I (f d x, f d x, f d x)', 261, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(657, 'Integrales impropias del tipo II, es decir, integrales de la forma f d x, donde f(x), presenta una discontinuidad infinita en (a, b) (estudio de toda los casos). Estudio de la funcion gamma.', 261, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(658, 'Ejercicios', 261, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(659, 'Area entre curvas', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(660, 'Ejemplos sobre areas entre curvas', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(661, 'Volumen de un solido con secciones planas paralelas conocidas', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(662, 'Ejemplos sobre este tipo de volumenes', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(663, 'Volumen de solidos de revolucion (metodo de las arandelas )', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(664, 'Volumen de solidos de revolucion (metodo de las certeza)', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(665, 'Ejemplos del calculo de volumen utilizando estos metodos', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(666, 'Longitud de arco de una curva plana', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(667, 'Area de superficie de revolucion (alrededor del eje x y alrededor del eje y)', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(668, 'Ejemplos de ejercicios para el calculo de longitudes de arco y areas de superficies de revolucion', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(669, 'Centro de masa de una varilla o de un alambre', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(670, 'Centro de masa de una region plana o de una lamina delgada', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(671, 'Centro de masa de un solido de revolucion', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(672, 'Ejercicios de aplicacion sobre centro de masa', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(673, 'Los teoremas de Pappus para el calculo de areas de superficies y solidos de revolucion', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(674, 'Trabajo realizado por una fuerza variable', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(675, 'Ejemplos ilustrativos de trabajo', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(676, 'Presion hidrostatica', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(677, 'Aplicaciones de la integral definidas en coord. Polares', 262, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(678, 'Definicion y ejemplos de sucesiones de numeros reales', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(679, 'Limite de sucesiones', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(680, 'Clasificacion de las sucesiones', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(681, 'Definicion y ejemplos de series', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(682, 'Ejemplos de serie (serie geometrica, serie telescopica, series aritmetico- geometricas)', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(683, 'Condicion necesaria y suficiente para la convergencia de series', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(684, 'Criterio de divergencia de series', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(685, 'Criterio de la integral', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(686, 'Criterio de comparacion y comparacion con el limite', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(687, 'Criterio del cociente', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(688, 'Criterio de la raiz', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(689, 'Criterio de Raabe', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(690, 'Algebra de series convergentes', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(691, 'Series alternas', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(692, 'Convergencia absoluta y condicional', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(693, 'Series de Taylor y series de MaClaurin', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(694, 'Ejemplos ilustrativos sobre intervalos de convergencia absoluta y radio de convergencia', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(695, 'Representacion en funcion en serie de Taylor', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(696, 'Series binomial', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(697, 'Operaciones con series de potencias', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(698, 'Metodo de aproximacion en el calculo; formula de Taylor, metodo de Newton', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(699, 'Metodos numericos de integracion', 263, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(700, 'Funcion Sign', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(701, 'Funcion pulso rectangular', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(702, 'Funcion escalon unitario', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(703, 'Funcion rampa', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(704, 'Funciones especiales propiamente dichas', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(705, 'Funcion gamma', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(706, 'Funcion beta', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(707, 'Funcion error', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(708, 'Funcion complementaria del error', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(709, 'Integral del seno', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(710, 'Integral del coseno Integral exponencial.', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(711, 'Relacion entre las funciones especiales y la transformada de Laplace', 264, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(712, ' Generalidades', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(713, 'Funciones Ortogonales', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(714, 'Conjunto ortogonal, norma y funcion de peso', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(715, 'Desarrollo en serie de funciones ortogonal', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(716, 'Problema de sturm- Liouville', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(717, 'El proceso de ortogonalizacion de Gram-Smith', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(718, 'Polinomio de Lengendre', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(719, 'Ecuacion diferencial, propiedades de P n', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(720, 'Polinomio de Laguerre', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(721, 'Ecuacion diferencial, propiedades de L n', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(722, 'Polinomio de Hermite', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(723, 'Ecuacion diferencial, propiedades de H n', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(724, 'Polinomio de Chebyshev, ecuacion diferencial, propiedades de T n', 265, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(725, 'Generalidades', 266, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(735, 'Generalidades.', 267, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(746, 'Ecuacion de Bessel. Funciones de Bessel J V (X), serie de Fourier Bessel', 266, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(747, 'Propiedades adicionales de J V (X) y Relaciones diferenciales de recurrencia.', 266, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(748, 'Integrales que incluyen funciones de Bessel', 266, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(749, 'Condicion de convergencia', 266, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(750, 'Transformada Z', 266, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(751, 'Funciones periodicas, series trigonometricas', 267, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(752, 'Series de Fourier formulas de Euler', 267, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(753, 'Integrales de Fourier', 267, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(754, ' Transformadas de Fourier', 267, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(755, 'Transformadas de Fourier Discreta (TFD.)', 267, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(756, 'Transformadas de Seno de Fourier', 267, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(757, 'Transformadas de Coseno de Fourier', 267, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(758, 'Transformadas de Fourier compleja', 267, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(759, 'Solucion de ecuaciones diferenciales parciales utilizando transformadas.', 267, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(760, 'Generalidades.', 268, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(761, 'Definicion y ejemplos clasificacion de las ecuaciones, utilizando la tecnica del producto de funciones.', 268, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(762, 'Ecuaciones clasicas y problemas de valores en la frontera', 268, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(763, 'Ecuacion en una y dos dimension de transmision del calor.', 268, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(764, 'Ecuacion de onda en una y dos dimensiones.', 268, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(765, 'Ecuacion de Laplace', 268, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(766, 'Ecuaciones y condiciones de frontera no homogeneas', 268, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(767, 'Problemas de valores en la frontera con series de Fourier en dos variables.', 268, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(768, 'Problemas de valores en la frontera en otros sistemas de coordenadas.', 268, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(769, 'Resena historica', 269, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(770, 'Sistema de coordenadas (rectangulares y oblicuas)', 269, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(771, 'Distancia entre dos puntos (en el plano de dos dimensiones)', 269, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(772, 'Coordenadas de los puntos de division y de punto medio', 269, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(773, 'Inclinacion y pendiente de una recta', 269, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(774, 'Rectas paralelas y perpendiculares', 269, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(775, 'Angulos entre dos rectas', 269, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(776, 'Area de un poli­gono en funcion de las coordenadas y sus vertices', 269, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(777, ' Aplicaciones', 269, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(778, 'Los problemas fundamentales de la geometria analitica', 270, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(779, 'Lugar geometrico: interseccion con los ejes y campos de variacion', 270, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(780, 'Aplicaciones', 270, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(781, ' Formas de la ecuacion de una recta: punto-pendiente; pendiente-ordenada en el origen, cartesianas o de dos puntos; reducidas o abscisas y ordenadas en el origen; normal; general', 271, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(782, 'Reduccion de la forma general a la forma normal', 271, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(783, 'Ecuacion de un haz de rectas, definicion. Sistemas de rectas que pasan por la interseccion de dos rectas', 271, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(784, 'Distancia de un punto a una recta', 271, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(785, 'Ecuacion de la bisectriz de un angulo', 271, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(786, 'Aplicaciones', 271, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(787, 'Generalidades. La circunferencia', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(788, 'Definicion y construccion', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(789, 'Ecuaciones: ordinarias, canonicas, general', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(790, 'Condiciones que determinan un circunferencia', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(791, 'Sistema de circunferencias que se intersecan: eje radical', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(792, 'Ejercicios de aplicacion', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(793, 'La parabola', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(794, 'Definicion y construccion', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(795, 'Ecuaciones ordinarias, con V ( 0, 0 ) y V ( h, k ) y ejes paralelos a los ejes de coordenadas, ecuaciones generales', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(796, 'La elipse', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(797, 'Definicion y construccion', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(798, 'Propiedades. Simetricas, valores excluidos, relaciones geometricas y excentricidad', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(799, 'Ecuaciones. Formas ordinarias con C ( 0, 0 ) y C ( h, k ) y ejes paralelos a los coordenados; forma general', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(800, 'La hiperbola', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(801, 'Definicion y construccion', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(802, 'Propiedades: simetrica, valores excluidos, excentricidad, relaciones geometricas', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(803, 'Clases: conjugadas, equilateras', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(804, 'Ecuaciones: ordinarias con C ( 0, 0 ) y C ( h, k ) y ejes paralelos a los ejes de coordenadas', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(805, 'Aplicaciones', 272, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(806, 'Traslacion de ejes', 273, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(807, 'Rotacion de ejes', 273, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(808, 'Definicion y construccion', 274, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(809, 'Localizacion de puntos', 274, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(810, 'Dibujo de ecuaciones polares, simetrias', 274, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(811, 'Relacion entre las coordenadas polares y rectangulares', 274, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(812, 'Ecuaciones polares de: la recta, la circunferencia, la parabola, la elipse y la hiperbola', 274, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(813, 'Construcciones graficas de: cardioides, lemniscata de Bernoulli, rosa de cuatro petalos, trebol de tres hojas, espiral de Arquimedes', 274, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(814, 'Generalidades', 39, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(815, 'Naturaleza de la estadistica', 39, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(816, 'Distribucion de frecuencias', 39, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(817, 'Medidas de posicion', 39, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(818, 'Medidas de dispersion, asimetria y apuntamiento', 39, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(819, ' Generalidades', 40, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(820, 'Experimento deterministico y experimento aleatorio', 40, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(821, 'Espacio muestral', 40, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(822, 'Sucesos y eventos', 40, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(823, 'Enfoque clasico y epistemologia de las probabilidades', 40, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(824, 'Definicion de probabilidad', 40, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(825, 'Axiomas y probabilidad', 40, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(826, 'Teoremas basicos de la probabilidad', 40, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(827, 'Teoria combinatoria y probabilidades', 40, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(828, 'Variables aleatorias discretas', 41, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(829, 'Variables aleatorias continuas', 41, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(830, 'Funciones de probabilidad', 41, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(831, 'Funciones generadoras de momentos', 41, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(832, 'Teorema de Tchebysheff', 41, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(833, 'Distribuciones especiales discretas', 42, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(835, 'Distribucion binomial', 42, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(836, 'Distribucion de Poisson', 42, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(837, 'Distribucion Hipergeometrica', 42, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(838, 'Distribuciones especiales continuas', 42, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(839, 'Distribucion normal', 42, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(840, 'Distribucion exponencial', 42, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(842, 'Variables aleatorias independientes', 43, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(843, 'Combinaciones y transformaciones de variables aleatorias', 43, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(844, 'Densidades condicional', 43, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(845, 'Estadistica de orden', 43, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(846, 'Distribuciones muestrales relacionadas con la distribucion normal', 44, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(847, 'El Teorema del limite central', 44, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(848, 'Generalidades', 45, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(849, 'Naturaleza de la estadistica', 45, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(850, 'Distribucion de frecuencias', 45, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(851, 'Medidas de posicion', 45, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(852, 'Medidas de dispersion, asimetria y apuntamiento', 45, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(853, 'Generalidades', 46, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(854, 'Experimento deterministico y experimento aleatorio', 46, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(855, 'Espacio muestral', 46, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(856, 'Sucesos y eventos', 46, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(857, 'Enfoque clasico y epistemologia de las probabilidades', 46, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(858, 'Definicion de probabilidad', 46, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(859, 'Axiomas y probabilidad', 46, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(860, 'Teoremas basicos de la probabilidad', 46, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(861, 'Teoria combinatoria y probabilidades', 46, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(862, 'Variables aleatorias discretas', 47, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(863, 'Variables aleatorias continuas', 47, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(864, 'Funciones de probabilidad', 47, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(865, 'Funciones generadoras de momentos', 47, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(867, 'Teorema de Tchebysheff', 47, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(868, 'Distribucion binomial', 48, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(869, 'Distribucion de Poisson', 48, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(870, 'Distribucion Hipergeometrica', 48, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(871, 'Distribucion geometrica', 48, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(872, 'Distribucion normal', 48, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(873, 'Distribucion exponencial', 48, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(874, 'Distribucion Gamma', 48, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(875, 'Distribucion Beta', 48, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(876, 'Variables aleatorias independientes', 49, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(877, 'Combinaciones y transformaciones de variables aleatorias', 49, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(878, 'Densidades condicional', 49, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(879, 'Estadistica de orden', 49, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(880, 'Distribuciones muestrales relacionadas con la distribucion normal', 50, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(881, 'Distribucion Chi-cuadrado', 50, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(882, 'Distribucion estudent', 50, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(883, 'Distribucion F', 50, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(884, 'El Teorema del limite central', 50, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(885, 'Muestreo aleatorio simple', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(886, 'Generalidades', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(887, 'Determinacion del tamano de la muestra, para estimar promedios, proporciones y totales', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(888, 'Estimacion puntual y por intervalos para promedios, proporciones y totales', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(889, 'Muestreo aleatorio estratificado', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(890, 'Estimacion puntual y por intervalos para promedios, proporciones y totales', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(891, 'Otros metodos de muestreo', 1, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(892, 'Tratamientos, unidad experimental, mediciones y asignaciones', 2, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(893, 'Experimentos factoriales, Replicacion, aleatorizacion y control local', 2, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(894, 'Descripcion del modelo, ventajas y desventajas', 3, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(895, 'Metodos de disenos completamente aleatorizados', 3, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(896, 'Analisis de resultados y evaluacion del modelo', 3, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(897, 'Analisis de covarianza', 3, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(898, 'Descripcion del modelo, ventajas y desventajas', 4, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(899, 'Analisis de resultados y evaluacion del modelo', 4, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(900, 'Analisis de covarianza', 4, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(901, 'Descripcion del diseno', 5, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(902, 'Ventajas y desventajas', 5, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(903, 'Modelo de diseno completamente aleatorizados', 5, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(904, 'Analisis de resultados y evaluacion del modelo', 5, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(905, 'Analisis de covarianza', 5, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(906, ' Generalidades', 6, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(907, 'El metodo de minimos cuadrados', 6, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(908, 'Inferencias basadas en estimadores de minimos cuadrados', 6, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(909, 'Regresion simple y regresion multiple', 6, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(910, 'Analisis de correlacion', 6, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(911, ' Funciones de varias variables', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(912, 'Graficas y curva de nivel', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(913, 'Limite y continuidad', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(914, 'Derivadas parciales', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(915, 'La diferencial', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(916, 'La regla de la cadena', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(917, 'Derivada direccional y gradiente', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(918, 'Planos tangentes y rectas normales', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(919, 'Derivadas parciales de segundo orden', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(920, 'Extremos absolutos y relativos', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(921, 'Extremos condicionales y multiplicadores de LaGrange', 51, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(922, 'Integrales dobles', 52, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(923, 'Evaluacion en coordenadas rectangulares y coordenadas polares. Aplicaciones', 52, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(924, 'Integrales triples', 52, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(925, 'Evaluacion de integrales triples en coordenadas rectangulares, cilÃ­ndricas y esfericas. Aplicacion', 52, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(926, 'El vector aceleracion', 53, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(927, 'Los vectores unitarios T y N', 53, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(928, 'Las componentes escalares del vector de aceleracion a lo largo de T y N', 53, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(929, 'Campos vectoriales y escalares.', 54, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(931, 'Integrales de linea', 54, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(932, 'Campos vectoriales conservativos', 54, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(933, 'Teorema de Green', 54, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(934, 'Integrales de superficie', 54, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(935, 'Teorema de la divergencia', 54, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(936, 'Teorema de Stokes', 54, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(937, 'Â¿Que es el analisis numerico?', 68, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(938, 'La necesidad de los metodos numericos', 68, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(939, 'Implementacion de los metodos numericos en dispositivos digitales', 68, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(940, 'Estudio de errores de redondeo y truncamiento', 68, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(941, 'Analisis de errores', 68, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(942, 'Aritmetica de precision fija de una computadora', 68, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(944, 'Errores de truncamiento y la serie de Taylor', 68, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(945, 'Algoritmos, solucion por metodos iterativos y orden de convergencia', 68, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(946, 'Metodo de Biseccion', 69, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(947, 'Metodo de Newton Raphson', 69, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(948, 'Metodo de Bairstow', 69, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(949, 'Metodos directos para sistemas lineales', 70, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(950, 'Eliminacion Gaussiana', 70, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(951, 'Factorizacion LU', 70, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(952, 'Metodos iterativos para sistemas lineales', 70, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(953, 'Metodo de Jacobi', 70, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(954, 'Metodo de Gauss-Seidel', 70, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(955, 'Metodo iterativo para sistemas no lineales: Newton- Raphson', 70, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(956, 'Interpolacion de Lagrange', 71, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(957, 'Interpolacion por diferencias divididas de Newton', 71, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(958, 'Ajuste de curvas por Minimos cuadrados.', 71, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(959, 'Ajustes de curvas por funciones sinusoidales', 71, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(960, 'Formula de tres y cinco puntos para diferenciacion', 72, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(961, 'Integracion numerica', 72, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(962, 'Regla compuesta trapezoidal', 72, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(963, 'Tecnica de Simpson compuesta', 72, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(964, 'Problemas de valores iniciales', 73, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(965, 'Metodos autoinicaidores', 73, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(966, 'Metodo de Euler', 73, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(967, 'Metodos de Runge-Kutta', 73, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(969, 'Metodos Multipaso: Adams-Bashforth', 73, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(970, 'Generalidades', 74, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(971, 'Muestras aleatorias con y sin reemplazo', 74, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(972, 'Media muestral', 74, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(973, 'Varianza muestral', 74, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(974, 'Propiedades de Media muestral y Varianza muestral', 74, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(975, 'Generalidades', 75, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(976, 'Definicion de estimacion puntual', 75, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(977, 'Propiedades de los estimadores: insesgado, eficiente, consistente y suficiente', 75, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(978, 'Metodo de maxima verosimilitud', 75, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(979, 'Definicion de estimacion por intervalos', 76, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(980, 'Intervalo de confianza para estimar la media poblacional', 76, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(981, 'Intervalo de confianza para estimar la diferencia de medias poblacionales', 76, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(982, 'Intervalo de confianza para estimar la proporcion poblacional', 76, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(983, 'Intervalo de confianza para estimar la diferencia de proporciones poblacionales', 76, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(984, 'Intervalo de confianza para estimar la varianza poblacional', 76, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(985, 'Definicion de pruebas de hipotesis', 77, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(986, 'Prueba de hipotesis para la media poblacional', 77, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(987, 'Prueba de hipotesis para la diferencia de medias poblacionales', 77, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(988, 'Prueba de hipotesis para la proporcion poblacional', 77, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(989, 'Prueba de hipotesis para la diferencia de proporciones poblacionales', 77, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(990, 'Prueba de hipotesis para la varianza poblacional', 77, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(991, 'Generalidades', 78, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(992, 'El metodo de minimos cuadrados', 78, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(993, 'Inferencias basadas en estimadores de minimos cuadrados', 78, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(994, 'Estimacion de parametros', 78, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(995, 'Concepto de proposicion y clases de proposiciones', 79, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(996, 'Conectivos logicos: Negacion, disyuncion, conjuncion, condicional, bicondicional; tablas de verdad', 79, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(997, 'Tautologias y Contradicciones. Equivalencia logica', 79, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(998, 'Sujetos y Predicados', 79, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(999, 'Funciones Proposicionales y Cuantificadores', 79, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1000, 'Reglas de inferencia logica', 79, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1001, 'Metodos de demostracion', 79, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1002, 'Concepto de conjunto, representacion, notacion, generalidades', 81, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1003, 'Operaciones entre conjuntos', 81, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1004, 'Producto Cartesiano, relaciones, propiedades, particion', 81, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1005, 'Sistemas decimal, binario, octal, hexadecimal', 82, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1006, 'Operaciones basicas: Adicion y sustraccion, complementos, Multiplicacion, Division', 82, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1007, 'Conversion entre sistemas', 82, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1008, 'Representacion computacional de los numeros', 82, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1009, 'Definicion y ejemplos de Algebras de Boole', 83, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1010, 'Principio de Dualidad', 83, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1011, 'Compuertas Logicas y Circuitos, Operaciones basicas', 83, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1012, 'Funciones Booleanas', 83, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1013, 'Minimizacion de Funciones Booleanas. Metodo del Consenso', 83, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1014, 'Minimizacion de Funciones Booleanas. Mapas de Karnaug', 83, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1015, 'Grupos, subgrupos, subgrupos normales', 84, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1016, 'Homomorfismo', 84, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1017, 'Grafos y multigrafos', 84, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1018, 'Arboles. Arboles con raices', 84, '2020-04-10 20:49:20', '2020-04-10 20:49:20');
INSERT INTO `eje_tematico` (`id_eje_tematico`, `nombre`, `id_unidad_asignatura`, `created_at`, `updated_at`) VALUES
(1019, 'Grafos dirigidos. Trayectoria de los grafos dirigidos', 84, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1020, 'Maquinas de estado finito', 84, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1021, 'Ecuaciones diferenciales; orden, grado y tipo', 85, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1022, 'Solucion de una ecuacion diferencial, interpretacion', 85, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1023, 'Solucion general, singular y particular', 85, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1024, 'Obtencion de la ecuacion diferencial a partir de la solucion general', 85, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1025, 'Evolucion historica de algunas ecuaciones diferenciales importantes', 85, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1026, 'Conceptos basico y teoremas', 86, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1027, 'Ecuaciones diferenciales de variables separable y reducibles a separables', 86, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1028, 'Ecuaciones diferenciales homogeneas y transformables a homogeneas', 86, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1029, 'Ecuaciones diferenciales exactas y transformables a exacta', 86, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1030, 'Ecuacion diferencial lineal de primer orden', 86, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1031, 'Ecuaciones diferenciales reducibles a lineales', 86, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1032, 'Modelado y solucion de problemas fisicos y geometricos.', 86, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1033, 'Ecuaciones diferenciales de primer orden y grado superior', 87, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1034, 'Ecuaciones diferenciales lineales homogeneas', 87, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1035, 'Ecuaciones diferenciales lineales no homogeneas, metodo de coeficientes indeterminados y variacion de parametros', 87, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1036, 'Modelado y solucion de problemas fisicos', 87, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1037, 'Definicion, propiedades y teoremas basicos', 88, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1038, 'Solucion de problemas de valor inicial', 88, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1039, 'Sistemas lineales', 88, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1040, 'Solucion de sistemas lineales homogeneos con coeficientes constantes', 88, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1041, 'Modelado y solucion de problemas fisicos', 88, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1042, 'Series de potencias', 89, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1043, 'El metodo de serie de potencias', 89, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1044, 'Puntos ordinarios y singulares', 89, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1045, 'Ecuacion de Euler', 89, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1046, 'Ecuacion de Bessel', 89, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1047, 'Ecuacion de Legendre', 89, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1048, 'Modelado y solucion de problemas fisicos', 89, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1049, 'Metodo de eliminacion para sistemas lineales con coeficientes constantes', 90, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1050, 'Sistemas lineales', 90, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1051, 'Solucion de sistemas lineales homogeneos con coeficientes constantes', 90, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1052, 'Modelado y solucion de problemas', 90, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1053, 'Resena historica', 91, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1054, ' Definicion', 91, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1055, 'El metodo cientifico', 91, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1056, 'Concepto de modelos y clases de modelos', 91, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1057, 'Aplicacion de la investigacion de operaciones', 91, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1058, 'Modelos cuantitativos de la investigacion de operaciones', 91, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1059, 'Impacto de la investigacion en la ciencia de la administracion', 91, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1060, 'Resena historica', 92, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1061, 'Definicion', 92, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1062, 'Caracteristicas de la Programacion Lineal', 92, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1063, 'Aplicaciones de la Programacion Lineal', 92, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1064, 'Terminos usados en la Programacion Lineal', 92, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1065, 'Xxx', 92, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1066, 'Modelo general de Programacion Lineal', 92, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1067, 'Pasos para la formulacion de problemas', 92, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1068, 'Taller', 93, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1069, 'Procedimientos para trabajar con el metodo grafico', 94, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1070, 'Problemas de maximizacion', 94, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1071, 'Problemas de minimizacion', 94, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1072, 'Casos especiales:', 94, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1073, 'solucion no factibles', 94, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1074, 'Solucion ilimitada', 94, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1075, 'Solucion multiple', 94, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1076, 'Solucion xxx', 94, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1077, 'Taller', 94, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1078, 'Generalidades del metodo simplex', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1079, 'Formato estandar', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1080, 'Descripcion del metodo simplex', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1081, 'El metodo simplex en forma tabular', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1082, 'Encontrando una solucion inicial basica factible', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1083, 'El metodo de las dos fases', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1084, 'El metodo de la gran m', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1085, 'Obtencion de una mejor xxx', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1086, 'Solucion optima', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1087, 'Variables sin restriccion xxx', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1088, 'Casos especiales del metodo simplex', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1089, 'Interpretacion economica de la tabla final de simplex', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1090, 'Problemas de maximizacion y minimizacion', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1091, 'El metodo simplex revisado', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1092, 'Taller', 95, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1093, 'Generalidades', 96, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1094, 'Formato economico', 96, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1095, 'Relaciones entre el modelo primal y el dual', 96, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1096, 'Relaciones entre la solucion del modelo primal y el dual', 96, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1097, 'Interpretacion economica del dual', 96, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1098, 'El dual simplex', 96, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1099, ' Taller', 96, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1100, ' Definicion del modelo de transporte', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1101, 'Estructura del modelo de transporte en forma tabular', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1102, 'Procedimiento para generar una solucion inicial', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1103, 'Metodo esquina xxx', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1104, 'Metodo de costo minimo', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1105, 'Metodo de aproximacion vogel', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1106, 'Cruce del arroyo', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1107, 'MODI (Metodo modificado de distribucion)', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1108, 'Comparacion del metodo de transporte y el algoritmo simplex', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1109, 'Casos especiales del metodo de transporte', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1110, 'El problema de asignacion', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1111, 'Taller', 97, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1112, 'Cuantificadores y propiedades', 98, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1113, 'Operaciones generalizadas entre conjuntos: Union, interseccion, diferencia, complemento, leyes de D-Morgan.', 98, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1114, 'Pareja ordenada. Producto cartesiano, teoremas.', 99, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1115, 'Relaciones definidas en un conjunto numerico. Relacion inversa, conjunto de partes, subconjunto propio, diagramas lineales de una relacion.', 99, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1116, 'Definicion analitica y simbolica de funcion, teoremas. Funcion inyectiva y sobreyectiva de segundo grado en los conjuntos numericos, teoremas. Funciones biyectivas, teoremas. Imagen e imagen recipro', 99, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1117, 'Composicion de funciones, teoremas. Funcion inversa. Restriccion de funciones. Propiedades de las relaciones definidas en los numeros reales. Relacion congruencia modulo m. relaciones de equivalenci', 99, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1118, 'Relacion de orden, definicion y propiedades. Primer elemento, ultimo elemento, cota inferior y superior, Inf y Sup de un conjunto ordenado', 99, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1119, 'Definicion de funciones entre conjuntos numericos. Correspondencia univoca y biunivoca entre dos conjuntos. Conjuntos contables, conjuntos numerables', 100, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1120, 'Numeros cardinales, definicion, operaciones', 100, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1121, 'Numeros Naturales. Operaciones y propiedades', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1122, 'Numeros Enteros. Operaciones y propiedades', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1123, 'Numeros Racionales y Fracciones. Operaciones y propiedades', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1124, 'Sistemas de representacion de las fracciones: porcentaje y decimal', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1125, 'Notacion Cientifica', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1126, 'Razones y proporciones', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1127, 'Numeros Irracionales', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1128, 'Numeros Reales. Operaciones y propiedades', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1129, 'Valor absoluto y propiedades', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1130, 'Ecuaciones, ecuaciones lineales , ecuaciones cuadraticas', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1131, ' Inecuaciones', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1132, 'Factorizacion de polinomios', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1133, 'Polinomios en varias variables', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1134, 'Sistemas de ecuaciones', 101, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1135, 'Unidades de Medidas de Longitud', 102, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1136, 'Unidades de Medidas de Superficie', 102, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1137, 'Unidades de Medidas de Volumen', 102, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1138, 'Unidades de Medidas de Masa', 102, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1139, 'Unidades de Medidas de Capacidad', 102, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1140, 'Conversion de medidas de unas unidades a otras', 102, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1141, 'Concepto de funcion', 103, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1142, 'Representacion de las funciones: verbal , numerica, visual, algebraica', 103, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1143, 'Clases de funciones :inyectiva , sobreyectiva , biyectiva , inversa', 103, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1144, 'Algebra de funciones', 103, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1145, 'Variacion: directa e inversa , conjunta y combinada', 103, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1146, 'Funciones polinomicas', 104, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1147, 'Funciones especiales', 104, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1148, 'Por tramos, valor absoluto, signum, mayor entero, otras', 104, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1149, 'Funciones racionales', 104, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1150, 'Funciones trascendentes', 104, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1151, 'Exponenciales, logaritmicas, logisticas', 104, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1152, 'Propiedades algebraicas de R', 109, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1153, 'Propiedad de orden', 109, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1154, 'Valor absoluto', 109, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1155, 'Propiedad de la minima cota superior', 109, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1156, 'Existencia de raices cuadradas y numeros irracionales', 109, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1157, 'Sucesiones y limites', 110, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1158, 'Teoremas de limites', 110, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1159, 'Sucesiones monotonas', 110, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1160, 'Subsucesiones y el teorema de Bolzano-Weierstrass', 110, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1161, 'Criterio de Cauchy', 110, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1162, 'Sucesiones propiamente divergentes', 110, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1163, 'Teoremas sobre limites', 111, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1164, 'Aplicaciones del concepto de limite', 111, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1165, 'Definicion. Ejemplos', 112, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1166, 'Continuidad y limites', 112, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1167, 'Combinacion de funciones continuas', 112, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1168, 'Funciones continuas en intervalos', 112, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1169, 'Continuidad uniforme', 112, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1170, 'Funciones de Lipschitz', 112, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1171, 'Teorema de la extension continua', 112, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1172, 'Espacios mÃ©tricos', 114, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1173, 'Conjuntos abiertos y cerrados en R', 114, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1174, 'Funciones continuas', 114, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1175, 'Conjuntos compactos', 114, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1176, 'Generalidades', 115, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1177, 'Naturaleza del diseno de agregado', 115, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1178, 'Experimento en contexto de campo', 115, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1179, 'Concepto de experimento de campo', 115, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1180, 'Planificacion de un experimento de campo', 115, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1181, 'Realizacion del experimento', 115, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1182, 'Sintesis del papel de los experimentos de campo', 115, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1183, 'Generalidades', 117, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1184, 'Naturaleza de los experimentos', 117, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1185, 'Caracteristica de los experimentos', 117, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1186, 'Diseno de experimento y analisis de los experimentos de laboratorios', 117, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1187, 'Ejecucion de los laboratorios', 117, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1188, 'Contenido y forma de la situacion experimental', 117, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1189, 'Tecnicas para control y manipulacion de experimentos', 117, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1190, 'Oportunidades para la medicion en experimentos de laboratorios', 117, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1191, 'Relacion del estudio de campo y la encuesta', 119, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1192, 'Tipo de estudios campo', 119, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1193, 'Etapas de la realizacion de un estudio de campo', 119, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1194, 'El lugar de los estudios de campo en la investigacion programatica', 119, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1195, 'Generalidades', 120, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1196, 'Menu principal. Barras de herramientas y barras de estado', 120, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1197, 'Desde el menu principal se accede a la mayoria de las funciones del SPSS', 120, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1198, 'Creando un archivo nuevo, abriendo un archivo existente, grabar un archivo, grabando con un nombre, realizar margenes, sumarios de archivos, guardar tipos de archivos, importar datos, traer archivos', 120, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1199, 'Ventana de datos, contiene las actividades de insertar casos y de insertar las variables, borrar registros y variables', 120, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1200, 'Estructura y opciones generales del programa; para entrar en el hacer clip en el boton de inicio de Windows, luego en programas, en SPSS y finalmente SPSS ejecutable', 120, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1201, 'Divisibilidad, propiedades y demostraciones', 121, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1202, 'Algoritmo de Euclides, MCD y MCM, teoremas, numeros primos, primos relativos, corolarios', 121, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1203, 'Congruencias, definicion y teoremas, funcion indicatriz de Euler, Teorema de Euler y de Fermat', 121, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1204, 'Elemento identico e inverso de un conjunto con una operacion cualquiera', 122, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1205, 'Operaciones binarias, propiedades, tablas de doble entrada (tablas de Cayley)', 122, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1206, 'Definicion de grupo, ejercicios, teoremas.', 123, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1207, 'Definicion de subgrupo, ejercicios, teoremas', 123, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1208, 'Clases de equivalencia y clases laterales segun un subgrupo, teoremas', 123, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1209, 'Teorema de Lagrange, subgrupos triviales y aplicaciones', 123, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1210, 'Grupos ciclicos con respecto a la suma y al producto, teorema', 123, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1211, 'Grupos Normales (Invariantes), teoremas', 123, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1212, 'Grupos cocientes', 123, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1213, 'Producto de subgrupos normales, teoremas', 123, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1214, 'Definicion de homomorfismo, teoremas', 124, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1215, 'Nucleo de un homomorfismo, teorema', 124, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1216, 'Definicion de isomorfismo, teoremas', 124, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1217, 'Definicion de permutacion', 125, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1218, 'Representacion, ciclos y longitud de una permutacion. Ciclos disjuntos', 125, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1219, 'Transposiciones. Permutacion par e impar. Regla de Jordan', 125, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1220, 'Principio de conteo. Conjugado y normalizador de un elemento', 125, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1221, 'Descripcion de los conceptos de: Historia. Epistemologia. Filosofia de la matematica', 134, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1222, 'Red conceptual de la matematica hoy', 134, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1223, 'Situacion en que se encontraba la matematica a comienzos del siglo XIX', 134, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1224, 'El porque de la matematica y no las matematicas', 134, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1225, 'La situacion de los numeros', 134, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1226, 'La situacion del algebra', 134, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1227, 'La situacion de la geometria', 134, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1228, 'Los metodos infinitesimales y el calculo', 134, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1229, 'La matematica como servidora de otras ciencias', 134, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1230, 'La independencia de la matematica', 134, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1231, 'La geometria euclidiana', 135, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1232, 'El quinto postulado', 135, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1233, 'Problematica desarrollada alrededor del quinto postulado', 135, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1234, 'Geometrias hiperbolica - parabolica â€“ eliptica', 135, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1235, 'Aporte metodologico de estas geometrias al posterior desarrollo de la Matematica', 135, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1236, 'El metodo de exahucion', 136, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1237, 'Los infinitesimos (las fluxiones)', 136, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1238, 'Los problemas de la fisica en el renacimiento', 136, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1239, 'El nacimiento del Calculo diferencial y del Calculo Integral', 136, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1240, 'El origen de la teoria de grupos', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1241, 'La teoria de grupos como elemento unificador', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1242, 'El Programa de Erlangen', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1243, 'Las nuevas algebras', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1244, 'Las leyes de composicion', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1245, 'El algebra geometrica', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1246, 'Los cuerpos. Los anillos', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1247, 'Vectores. Complejos', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1248, 'Cuaterniones', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1249, 'Las matrices', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1250, 'El Algebra Lineal', 137, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1251, 'La Logica aristotelica', 138, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1252, 'El idioma universal o el alfabeto del pensamiento humano', 138, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1253, 'Las Leyes de Verdad o Algebra de Boole. (Matematica Pura)', 138, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1254, 'El formalismo logico', 138, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1255, 'Inicios de la Filosofia de la matematica', 138, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1256, 'El sistema axiomatico euclidiano', 139, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1257, 'El sistema axiomatico para la Geometria Proyectiva', 139, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1258, 'La axiomatizacion de la Aritmetica', 139, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1259, 'Los â€œproblemas de la matematicaâ€ de Hilbert', 139, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1260, 'Los sistemas matematicos artificiales', 139, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1261, 'La unidad de la matematica', 139, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1262, 'Los antecedentes', 140, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1263, 'El nacimiento', 140, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1264, 'Las paradojas', 140, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1265, 'El lenguaje unificador', 140, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1266, 'Los Diagramas', 140, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1267, 'La crisis de los fundamentos', 140, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1268, 'Generalidades', 141, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1269, 'Analisis cualitativo, historia y raices filosoficas', 141, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1270, 'Tratamiento cientifico del material simbolico', 141, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1271, 'Conversion de fenomenos a datos cientificos', 141, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1272, 'Preparacion y uso del plan de analisis', 141, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1273, 'Realizacion de codificaciones manuales', 141, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1274, 'Realizacion de tabulaciones manuales', 141, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1275, 'Generalidades', 142, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1276, 'Significado de la medicion', 142, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1277, 'Teoria de los datos', 142, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1278, 'Metodos de la reunion de los datos', 142, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1279, 'Ejecucion de las variables', 142, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1280, 'Ejecucion de las variables', 143, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1281, 'Contenido y forma de las situaciones de cada variable en estudio', 143, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1282, 'Tecnicas para control y manipulacion de variables', 143, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1283, 'Oportunidades para la medicion social en trabajos de campo', 144, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1284, 'Relacion de las variables en estudios campo', 144, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1285, 'Tipo de estudios variables', 144, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1286, 'Procesos en la realizacion o la formacion de variables', 144, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1287, 'El lugar de los variables en las tabulaciones', 144, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1288, ' Generalidades', 146, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1289, ' Metodos estadisticos descriptivos', 146, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1290, 'Histograma', 146, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1291, 'Generacion de numeros aleatorios', 146, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1292, 'Generacion de Muestras', 146, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1293, 'Coeficiente de Correlacion', 146, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1294, 'Estimacion de la Covarianzas', 146, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1295, 'Jerarquias y Percentil', 146, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1296, 'Medias moviles', 146, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1297, 'Educacion matematica, concepto de didactica de la matematica', 147, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1298, 'El saber matematico y la transposicion didactica', 147, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1299, 'Caracteristica de la interaccion en el aula: del profesor, del alumno', 147, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1300, 'Discurso matematico en el aula', 147, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1301, 'Los lineamientos curriculares de matematicas', 148, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1302, 'Pensamiento matematico', 148, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1303, 'Procesos especificos del pensamiento: Pensamiento numerico, espacial, metrico, variacional y aleatorio', 148, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1304, 'Procesos generales del pensamiento', 148, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1305, 'Curriculo de matematicas, finalidad, objetivos, organizacion', 149, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1306, 'Logros e indicadores de logros', 149, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1307, 'Estandares curriculares', 149, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1308, 'La demostracion en matematicas', 149, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1309, 'Aprendizaje matematico', 150, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1310, 'Caracteristica del desarrollo de la competencia matematica', 150, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1311, 'Matematica recreativa: actividades de matematica recreativa que se orientan hacia los componentes curriculares', 150, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1312, 'Resolucion de problemas', 150, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1313, 'Uso de las nuevas tecnologias de la informacion y la comunicacion en el aula de matematicas', 150, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1314, 'Las practicas pedagogicas de matematicas', 150, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1318, ' Importancia', 155, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1319, 'Definicion', 155, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1320, ' Division', 155, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1321, ' Planteamiento del problema', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1322, 'Fijacion de los objetivos', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1323, 'Formulacion de las hipotesis', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1324, 'Definicion de la unidad de observacion y de la unidad de medida', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1325, 'Determinacion de la poblacion y de la muestra', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1326, 'La recoleccion', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1327, 'Critica, clasificacion y ordenacion', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1328, 'La tabulacion', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1329, 'La presentacion', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1330, 'El analisis', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1331, 'Publicacion', 156, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1332, 'Tipos de Variables', 157, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1333, 'Construccion de Variables a partir de informacion', 157, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1334, 'Distribucion de frecuencias simple. Ejercicios', 157, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1335, 'Distribucion de frecuencias por intervalo', 157, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1336, 'Reglas empiricas para la construccion de Intervalos Cuestionario y ejercicios propuestos', 157, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1337, ' Definicion', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1338, ' Componentes de una grafica', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1339, 'Principales tipos de graficos', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1340, 'Grafico de lineas', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1341, 'Grafico de lineas compuesto', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1342, 'Grafico de barras', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1343, 'Grafico de barras compuesto', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1344, 'Grafico de sectores circulares', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1345, 'Histograma de frecuencias', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1346, 'Poligono de frecuencias', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1347, 'Histograma de frecuencias acumuladas', 158, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1348, 'Media aritmetica', 159, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1349, 'Propiedades de la media aritmetica', 159, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1350, 'Media aritmetica con cambio origen y de escala', 159, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1351, 'Media aritmetica ponderada', 159, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1352, ' Mediana', 159, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1353, 'La mediana cuando los datos no estan agrupados en intervalos', 159, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1354, 'La mediana cuando la informacion esta agrupada en intervalos', 159, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1355, 'La Moda', 159, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1356, 'La moda cuando los datos no estan agrupados en intervalos', 159, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1357, 'Calculo de la moda con la informacion agrupada en intervalos Cuestionario y ejercicios propuestos', 159, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1358, 'Cuartiles', 160, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1359, 'Quintiles', 160, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1360, 'Deciles', 160, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1361, 'Centiles', 160, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1362, 'Resumen', 160, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1363, 'Cuestionario y ejercicios propuestos', 160, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1364, 'Rango o recorrido', 161, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1365, 'Desviacion media', 161, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1366, 'Varianza', 161, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1367, 'Coeficiente de variabilidad Cuestionario y ejercicios propuestos', 161, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1368, 'Tablas de doble entrada', 162, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1369, 'Correlacion', 162, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1370, 'Regresion lineal', 162, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1371, 'Ajuste rectilineo (metodo de los minimos cuadrados)', 162, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1372, 'Ajuste parabolica (metodo de los minimos cuadrados) Cuestionario y ejercicios propuestos', 162, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1373, 'Nociones de conteo', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1374, 'Principio fundamental 1', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1375, 'Principio fundamental 2', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1376, ' Permutaciones', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1377, 'Variaciones', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1378, 'Combinaciones', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1379, 'Permutaciones con repeticion', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1380, 'Variaciones con repeticion Ejercicios propuestos', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1381, 'Definicion de probabilidad', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1382, 'Probabilidad a priori', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1383, 'Probabilidad a posteriori', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1384, 'Probabilidad subjetiva', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1385, 'Axiomas de la teoria de probabilidades', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1386, 'Probabilidad condicional e independencia estadistica Cuestionario y ejercicios propuestos', 163, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1387, 'Algebra de Proposiciones', 151, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1388, 'Concepto de proposicion y clases de proposiciones', 151, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1389, 'Conectivos logicos. Negacion, disyuncion, conjuncion, condicional, bicondicional; tablas de verdad. Tautologias y contradicciones. Equivalencia Logica', 151, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1390, 'Funciones proposicionales. Sujetos y Predicados. Cuantificador Universar. Cuantificador Existencial', 151, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1391, 'Inferencia Logica', 151, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1392, 'Introduccion', 151, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1393, 'Reglas de inferencia logica: Modus Ponendo Ponens, Modus Tollendo Tollens, Modus Tollendo Ponens', 151, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1394, 'Ley de la doble negacion, Ley de Adjuncion y Simplificacion, Ley de Adicion, Leyes de De Morgan, Ley de los bicondicionales, Leyes Conmutativas, Ley del Silogismo Hipotetico, Ley del Silogismo Disyu', 151, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1395, 'Nocion de conjunto, representacion, notacion y generalidades', 152, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1396, 'Operaciones entre conjuntos, propiedades y demostraciones', 152, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1397, 'Interseccion, propiedades y demostraciones', 152, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1398, 'Diferencia y Complemento, propiedades y demostraciones', 152, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1399, 'Diferencia simetrica, propiedades y demostraciones', 152, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1400, 'Conjunto de Partes', 152, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1401, 'Producto Cartesiano, propiedades y demostraciones', 152, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1402, 'Numero de elementos de un conjunto', 152, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1403, 'Aplicaciones', 152, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1404, 'Numeros Naturales. Operaciones y propiedades', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1405, 'Numeros Enteros. Operaciones y propiedades', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1406, 'Numeros Racionales y Fracciones. Operaciones y propiedades', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1407, 'Sistemas de representacion de las fracciones : porcentaje y decimal', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1408, 'Notacion Cientifica', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1409, 'Razones y proporciones', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1410, 'Numeros Irracionales', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1411, 'Numeros Reales. Operaciones y propiedades', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1412, 'Valor absoluto y propiedades', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1413, 'Ecuaciones, ecuaciones lineales , ecuaciones cuadraticas', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1414, 'Inecuaciones', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1415, 'Definicion de Polinomios', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1416, 'Algebra de Polinomios', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1417, 'Factorizacion de polinomios ', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1418, 'Sistemas de ecuaciones 2x2 y 3x3', 153, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1419, 'Concepto de funcion', 154, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1420, 'Representacion de las funciones: verbal , numerica, visual, algebraica', 154, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1421, 'Clases de funciones: inyectiva , sobreyectiva , biyectiva , inversa', 154, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1422, 'Algebra de funciones', 154, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1423, 'Variacion directa e inversa , conjunta y combinada', 154, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1424, 'Funciones polinomicas', 154, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1425, 'Funciones especiales: Por tramos, valor absoluto, signum, mayor entero, otras', 154, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1426, 'Funciones racionales', 154, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1427, 'Funciones trascendentes', 154, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1428, 'El conjunto de los numeros reales', 168, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1429, 'Subconjunto del conjunto los numeros reales y sus propiedades', 168, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1430, 'Desigualdades  e intervalos', 168, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1431, 'Funciones', 168, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1432, 'Definicion, dominio  y rango', 168, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1433, 'Graficacion de funciones simples y combinadas', 168, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1434, 'La funcion compuesta y la funcion inversa', 168, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1435, 'Definicion de limite', 169, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1436, 'Teoremas sobre el limite           ', 169, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1437, 'Limites unilaterales                   ', 169, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1438, 'limite de funciones algebraicas', 169, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1439, 'limite cuando la variable independiente tiende a infinito            ', 169, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1440, 'continuidad y discontiduidad de funciones', 169, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1441, 'definicion de continuidad', 169, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1442, 'discontinuidad de salto, removible e infinita', 169, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1443, 'aplicaciones a funciones combinadas', 169, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1444, 'Definicion de derivada', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1445, 'Definicion del cambio de x: delta(x)', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1446, 'Definicion del cambio de y: delta(y)', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1447, 'Existencia de la derivada', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1448, 'El concepto de diferencial', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1449, 'Dos significados de la derivada: como variacion de una funcion cualquiera (Pendiente) y como variacion de una funcion de posicion (velocidad)', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1450, 'Deduccion  y  manejo  de formulas de derivacion', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1451, 'Derivacion de las funciones algebraicas y transcendentes', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1452, 'Derivacion del orden n', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1453, 'Derivacion implicita', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1454, 'Maximos y minimos', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1455, 'Absolutos y relativos', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1456, 'Criterio    de    la    primera derivada', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1457, 'Criterio  de  la  segunda derivada', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1458, 'Puntos de inflexion', 170, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1459, 'Aplicacion  de  la  derivada como razon de cambio', 171, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1460, 'concepto de variacion en problemas de maximos y minimos', 171, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1461, 'teorema del calculo diferencial', 171, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1462, 'aplicaciones geometricas de la derivada', 171, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1463, 'extremos de una funcion', 171, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1464, 'trazados de la grafica de una funcion escalar', 171, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1465, 'Integral      Indefinida. Metodos de integracion', 172, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1466, 'Integral  definida:  area bajo la curva', 172, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1467, 'Propiedades   de   la integral definida', 172, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1468, 'Teorema  fundamental del calculo', 172, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1469, 'Integracion por parte                  ', 173, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1470, 'El metodo LIATE                       ', 173, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1471, 'Metodo tabular                          ', 173, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1472, 'Integral numerica                      ', 173, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1473, 'integracion de potencias trigonometricas', 173, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1474, 'integracion por sustituciones trigonometricas', 173, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1475, 'Funciones racionales y fracciones parciales                   ', 173, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1476, 'sustituciones diversas o de racionalizacion', 173, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1477, 'Aplicaciones practicas.              ', 174, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1478, 'Exceso de utilidad neta              ', 174, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1479, 'ganancias neta de una maquina industrial', 174, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1485, 'la curva de demanda y disposicion a gastar  de los consumidores', 174, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1486, 'curvas de aprendizaje', 174, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1487, 'Ejercitacion  con  problemas como:  Ingreso,  costo  y  utilidad  marginal                                           ', 174, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1488, 'Ecuaciones diferenciales elementales. Conceptos generales.', 175, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1489, 'Ecuaciones diferenciales lineales de primer orden', 175, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1490, 'Solucion de una ecuacion diferencial.', 175, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1491, 'Metodos de solucion de diversos tipo de ecuaciones diferenciales de primer orden', 175, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1492, 'Sucesiones', 176, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1493, 'Series infinitas', 176, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1494, 'Series convergente                    ', 176, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1495, 'Series y progresiones                ', 176, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1496, 'Progresion aritmetica           ', 176, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1497, 'suma de terminos de una progresion aritmetica     ', 176, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1498, ' progresion geometrica    ', 176, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1499, ' suma de terminos de una progresion geometrica    ', 176, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1500, 'el numero e', 176, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1501, 'Generalidades', 275, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1502, 'Naturaleza de la estadistica', 275, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1503, 'Distribucion de frecuencias', 275, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1504, 'Medidas de posicion', 275, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1505, 'Medidas de dispersion, asimetria y apuntamiento', 275, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1506, 'Generalidades', 276, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1507, 'Experimento deterministico y experimento aleatorio', 276, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1508, 'Espacio muestral', 276, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1509, 'Sucesos y eventos', 276, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1510, 'Enfoque clasico y epistemologia de las probabilidades', 276, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1511, 'Definicion de probabilidad', 276, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1512, 'Axiomas y probabilidad', 276, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1513, 'Teoremas basicos de la probabilidad', 276, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1514, 'Teoria combinatoria y probabilidades', 276, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1515, 'Variables aleatorias discretas', 277, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1516, 'Variables aleatorias continuas', 277, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1517, 'Funciones de probabilidad', 277, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1518, 'Funciones generadoras de momentos', 277, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1519, 'Teorema de Tchebysheff', 277, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1520, 'Distribuciones especiales discretas', 278, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1521, 'Distribucion binomial', 278, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1522, 'Distribucion de Poisson', 278, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1523, 'Distribucion Hipergeometrica', 278, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1524, 'Distribuciones especiales continuas', 278, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1525, 'Distribucion normal', 278, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1526, 'Distribucion exponencial', 278, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1527, 'Variables aleatorias independientes', 279, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1528, 'Combinaciones y transformaciones de variables aleatorias', 279, '2020-04-10 20:49:20', '2020-04-10 20:49:20');
INSERT INTO `eje_tematico` (`id_eje_tematico`, `nombre`, `id_unidad_asignatura`, `created_at`, `updated_at`) VALUES
(1529, 'Densidades condicional', 279, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1530, 'Estadistica de orden', 279, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1531, 'Distribuciones muestrales relacionadas con la distribucion normal', 280, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1532, 'El Teorema del limite central', 280, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1533, 'Numeros Naturales. Operaciones y propiedades', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1534, 'Numeros Enteros. Operaciones y propiedades', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1535, 'Numeros Racionales y Fracciones. Operaciones y propiedades', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1536, 'Sistemas de representacion de las fracciones: porcentaje y decimal', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1537, 'Notacion Cientifica', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1538, ' Razones y proporciones', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1539, 'Numeros Irracionales', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1540, 'Numeros Reales. Operaciones y propiedades', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1541, 'Valor absoluto y propiedades', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1542, 'Ecuaciones, ecuaciones lineales , ecuaciones cuadraticas', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1543, ' Inecuaciones', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1544, ' Factorizacion de polinomios', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1545, 'Polinomios en varias variables', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1546, 'Sistemas de ecuaciones', 105, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1547, 'Unidades de Medidas de Longitud', 106, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1548, 'Unidades de Medidas de Superficie', 106, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1549, 'Unidades de Medidas de Volumen', 106, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1550, 'Unidades de Medidas de Masa', 106, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1551, 'Unidades de Medidas de Capacidad', 106, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1552, 'Conversion de medidas de unas unidades a otras', 106, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1553, 'Concepto de funcion', 107, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1554, 'Representacion de las funciones: verbal , numerica, visual, algebraica', 107, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1555, 'Clases de funciones :inyectiva , sobreyectiva , biyectiva , inversa', 107, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1556, 'Algebra de funciones', 107, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1557, 'Variacion: directa e inversa , conjunta y combinada', 107, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1558, 'Funciones polinomicas', 108, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1559, 'Funciones especiales', 108, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1560, 'Por tramos, valor absoluto, signum, mayor entero, otras', 108, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1561, 'Funciones racionales.', 108, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1562, 'Funciones trascendentes', 108, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1563, 'Exponenciales, logaritmicas, logisticas', 108, '2020-04-10 20:49:20', '2020-04-10 20:49:20'),
(1566, 'eje 1 unidad 1', 295, '2020-09-17 01:33:58', '2020-09-17 01:33:58'),
(1567, 'eje 2 unidad 1', 295, '2020-09-17 01:33:58', '2020-09-17 01:33:58'),
(1568, 'eje 1 unidad 44', 295, '2020-09-17 03:40:26', '2020-09-17 03:40:26'),
(1569, 'eje 1 unidad 44', 295, '2020-09-17 03:40:40', '2020-09-17 03:40:40'),
(1570, 'eje 1 unidad 44', 295, '2020-09-17 03:49:17', '2020-09-17 03:49:17'),
(1571, 'yyyyyyyyyyyyyyyyyyyy', 295, '2020-09-17 03:51:21', '2020-09-17 03:51:21'),
(1572, 'Conceptos basicos', 295, '2020-09-17 03:56:44', '2020-10-02 03:55:25'),
(1573, 'Tipos de deporte', 295, '2020-09-17 04:17:31', '2020-10-02 03:55:25'),
(1574, 'Alcance del deporte', 296, '2020-09-23 05:21:15', '2020-12-03 19:42:45'),
(1575, 'Estilos en el deporte', 295, '2020-10-02 03:55:26', '2020-10-02 03:55:26'),
(1576, 'Practicar futbol', 297, '2020-10-02 03:57:47', '2020-10-02 03:57:47'),
(1577, 'Practicar Basketball', 297, '2020-10-02 03:57:48', '2020-10-02 03:57:48'),
(1578, 'Practicar Beisball', 298, '2020-10-02 03:57:48', '2020-10-02 03:57:48'),
(1579, 'Practicar Tennis', 298, '2020-10-02 03:57:48', '2020-10-02 03:57:48'),
(1580, 'El deporte como arte', 296, '2020-12-03 19:42:46', '2020-12-03 19:42:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eje_tematico_seguimiento`
--

CREATE TABLE `eje_tematico_seguimiento` (
  `id_eje_tematico_seguimiento` int(11) NOT NULL,
  `id_seguimiento_asignatura` int(11) NOT NULL,
  `id_eje_tematico` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eje_tematico_seguimiento`
--

INSERT INTO `eje_tematico_seguimiento` (`id_eje_tematico_seguimiento`, `id_seguimiento_asignatura`, `id_eje_tematico`, `created_at`, `updated_at`) VALUES
(274, 28, 1564, '2020-09-09 16:58:37', '2020-09-09 16:58:37'),
(275, 28, 1565, '2020-09-09 16:58:37', '2020-09-09 16:58:37'),
(276, 29, 1564, '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(277, 29, 1565, '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(278, 29, 1564, '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(279, 29, 1565, '2020-09-09 18:06:50', '2020-09-09 18:06:50'),
(280, 30, 1565, '2020-09-09 18:08:19', '2020-09-09 18:08:19'),
(285, 34, 1572, '2020-09-22 18:01:27', '2020-09-22 18:01:27'),
(286, 34, 1573, '2020-09-22 18:01:27', '2020-09-22 18:01:27'),
(287, 36, 1572, '2020-09-22 18:05:14', '2020-09-22 18:05:14'),
(288, 36, 1573, '2020-09-22 18:05:14', '2020-09-22 18:05:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `id_facultad` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `id_academusoft` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`id_facultad`, `nombre`, `id_academusoft`, `created_at`, `updated_at`) VALUES
(1, 'Derecho, ciencias políticas y sociales', NULL, '2020-06-02 17:35:54', '2020-06-02 12:35:54'),
(2, 'Ciencias básicas y educación', NULL, '2020-06-02 17:35:54', '2020-06-02 12:35:54'),
(3, 'Ingenierias y Tecnologias', NULL, '2020-06-02 17:35:54', '2020-06-02 12:35:54'),
(4, 'Ciencias de la salud', NULL, '2020-06-02 17:35:54', '2020-06-02 12:35:54'),
(5, 'Ciencias Administrativas contables y economicas', NULL, '2020-06-02 17:35:54', '2020-06-02 12:35:54'),
(6, 'Arte y folclor', NULL, '2020-06-02 17:35:54', '2020-06-02 12:35:54'),
(13, 'Facultad de deporte', 110011, '2020-09-01 21:35:32', '2020-09-01 16:35:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas_entrega`
--

CREATE TABLE `fechas_entrega` (
  `id_fecha_entrega` int(11) NOT NULL,
  `fechainicial1` date DEFAULT NULL,
  `fechafinal1` date DEFAULT NULL,
  `fechainicial2` date DEFAULT NULL,
  `fechafinal2` date DEFAULT NULL,
  `fechainicial3` date DEFAULT NULL,
  `fechafinal3` date DEFAULT NULL,
  `id_dominio_tipo_formato` int(11) NOT NULL,
  `id_periodo_academico` int(11) NOT NULL,
  `id_licencia` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fechas_entrega`
--

INSERT INTO `fechas_entrega` (`id_fecha_entrega`, `fechainicial1`, `fechafinal1`, `fechainicial2`, `fechafinal2`, `fechainicial3`, `fechafinal3`, `id_dominio_tipo_formato`, `id_periodo_academico`, `id_licencia`, `created_at`, `updated_at`) VALUES
(11, '2020-09-21', '2020-10-13', NULL, NULL, NULL, NULL, 12, 11, 6, '2020-09-22 03:58:40', '2020-09-22 03:58:40'),
(12, '2020-02-12', '2020-10-01', '2020-02-13', '2020-10-15', '2020-02-12', '2020-10-15', 11, 11, 6, '2020-09-09 18:05:16', '2020-09-09 18:05:16'),
(13, '2020-09-08', '2020-10-07', NULL, NULL, NULL, NULL, 12, 12, 6, '2020-09-09 06:22:02', '2020-09-09 06:22:02'),
(14, '2020-09-09', '2020-10-11', '2020-09-09', '2020-10-07', '2020-09-09', '2020-10-07', 14, 12, 6, '2020-09-22 03:59:06', '2020-09-22 03:59:06'),
(15, '2020-09-21', '2020-10-13', '2020-09-21', '2020-10-13', '2020-09-21', '2020-10-12', 11, 12, 6, '2020-09-22 18:03:42', '2020-09-22 18:03:42'),
(16, '2020-09-21', '2020-10-14', '2020-09-21', '2020-10-12', '2020-09-21', '2020-02-12', 14, 11, 6, '2020-09-22 04:01:41', '2020-09-22 04:01:41'),
(17, '2020-10-14', '2020-10-22', NULL, NULL, NULL, NULL, 13, 11, 6, '2020-10-16 00:53:25', '2020-10-16 00:53:25'),
(18, '2021-12-01', '2021-12-15', NULL, NULL, NULL, NULL, 13, 16, 6, '2020-12-03 19:35:49', '2020-12-03 19:35:49'),
(19, '2020-12-01', '2020-12-15', NULL, NULL, NULL, NULL, 13, 12, 6, '2020-12-03 19:46:11', '2020-12-03 19:46:11'),
(20, '2020-02-12', '2020-02-26', NULL, NULL, NULL, NULL, 12, 15, 6, '2020-10-29 04:12:47', '2020-10-29 04:11:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `id_tercero` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `num_est_ini` int(11) DEFAULT NULL,
  `id_periodo_academico` int(11) DEFAULT NULL,
  `id_academusoft` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `codigo`, `id_tercero`, `id_asignatura`, `num_est_ini`, `id_periodo_academico`, `id_academusoft`, `created_at`, `updated_at`) VALUES
(12, '01', 75, 47, 30, 11, NULL, '2020-09-01 22:06:02', '2020-09-01 22:06:02'),
(13, '01', 75, 47, 30, 12, NULL, '2020-09-17 02:48:41', '2020-09-17 02:48:41'),
(14, '02', 75, 48, 20, 12, NULL, '2020-09-20 01:50:02', '2020-09-21 04:16:03'),
(15, '01', 75, 47, 30, 15, NULL, '2020-10-29 04:06:24', '2020-10-29 04:06:24'),
(16, '02', 75, 48, 20, 15, NULL, '2020-10-29 04:06:25', '2020-10-29 04:25:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `id_periodo_academico` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_horario`, `id_tercero`, `id_periodo_academico`, `created_at`, `updated_at`) VALUES
(4, 75, 11, '2020-09-01 22:06:02', '2020-09-01 22:06:02'),
(5, 75, 12, '2020-09-09 06:32:32', '2020-09-09 06:32:32'),
(6, 75, 15, '2020-10-29 04:06:24', '2020-10-29 04:06:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_detalle`
--

CREATE TABLE `horario_detalle` (
  `id_horario_detalle` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_dominio_tipo_evento` int(11) NOT NULL,
  `dia_semana` text NOT NULL,
  `hora` text NOT NULL,
  `evento` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario_detalle`
--

INSERT INTO `horario_detalle` (`id_horario_detalle`, `id_horario`, `id_dominio_tipo_evento`, `dia_semana`, `hora`, `evento`, `created_at`, `updated_at`) VALUES
(116, 5, 18, 'Miercoles', '16-17', 'dvdfdn', '2020-09-09 06:32:32', '2020-09-09 06:32:32'),
(117, 5, 18, 'Miercoles', '14-15', 'dvdfdn', '2020-09-09 06:32:32', '2020-09-09 06:32:32'),
(140, 5, 25, 'Lunes', '6-7', 'Introduccion a la educacion fisica (Grupo 01)', '2020-09-21 04:16:02', '2020-09-21 04:16:02'),
(141, 5, 25, 'Lunes', '7-8', 'Introduccion a la educacion fisica (Grupo 01)', '2020-09-21 04:16:02', '2020-09-21 04:16:02'),
(142, 5, 25, 'Miercoles', '10-11', 'Introduccion a la educacion fisica (Grupo 01)', '2020-09-21 04:16:03', '2020-09-21 04:16:03'),
(143, 5, 25, 'Miercoles', '11-12', 'Introduccion a la educacion fisica (Grupo 01)', '2020-09-21 04:16:03', '2020-09-21 04:16:03'),
(144, 5, 25, 'Viernes', '14-15', 'Deporte y aerobicos 1 (Grupo 01)', '2020-09-21 04:16:03', '2020-09-21 04:16:03'),
(145, 5, 25, 'Viernes', '15-16', 'Deporte y aerobicos 1 (Grupo 01)', '2020-09-21 04:16:03', '2020-09-21 04:16:03'),
(146, 5, 25, 'Martes', '8-9', 'Deporte y aerobicos 1 (Grupo 02)', '2020-09-21 04:16:03', '2020-09-21 04:16:03'),
(147, 5, 25, 'Martes', '9-10', 'Deporte y aerobicos 1 (Grupo 02)', '2020-09-21 04:16:03', '2020-09-21 04:16:03'),
(261, 4, 25, 'Lunes', '6-7', 'Introduccion a la educacion fisica (Grupo 01)', '2020-09-22 04:10:33', '2020-09-22 04:10:33'),
(262, 4, 25, 'Lunes', '7-8', 'Introduccion a la educacion fisica (Grupo 01)', '2020-09-22 04:10:33', '2020-09-22 04:10:33'),
(263, 4, 25, 'Miercoles', '10-11', 'Introduccion a la educacion fisica (Grupo 01)', '2020-09-22 04:10:33', '2020-09-22 04:10:33'),
(264, 4, 25, 'Miercoles', '11-12', 'Introduccion a la educacion fisica (Grupo 01)', '2020-09-22 04:10:33', '2020-09-22 04:10:33'),
(265, 4, 21, 'Miercoles', '13-14', 'efd', '2020-09-22 04:10:33', '2020-09-22 04:10:33'),
(266, 4, 21, 'Martes', '14-15', 'efd', '2020-09-22 04:10:33', '2020-09-22 04:10:33'),
(267, 4, 24, 'Lunes', '13-14', 'reunion', '2020-09-22 04:10:33', '2020-09-22 04:10:33'),
(268, 4, 24, 'Sabado', '21-22', 'qqqqqqqqqqqq', '2020-09-22 04:10:33', '2020-09-22 04:10:33'),
(277, 6, 25, 'Lunes', '6-7', 'Introduccion a la educacion fisica (Grupo 01)', '2020-10-29 04:25:14', '2020-10-29 04:25:14'),
(278, 6, 25, 'Lunes', '7-8', 'Introduccion a la educacion fisica (Grupo 01)', '2020-10-29 04:25:14', '2020-10-29 04:25:14'),
(279, 6, 25, 'Miercoles', '10-11', 'Introduccion a la educacion fisica (Grupo 01)', '2020-10-29 04:25:14', '2020-10-29 04:25:14'),
(280, 6, 25, 'Miercoles', '11-12', 'Introduccion a la educacion fisica (Grupo 01)', '2020-10-29 04:25:14', '2020-10-29 04:25:14'),
(281, 6, 25, 'Viernes', '14-15', 'Deporte y aerobicos 1 (Grupo 01)', '2020-10-29 04:25:14', '2020-10-29 04:25:14'),
(282, 6, 25, 'Viernes', '15-16', 'Deporte y aerobicos 1 (Grupo 01)', '2020-10-29 04:25:14', '2020-10-29 04:25:14'),
(283, 6, 25, 'Martes', '8-9', 'Deporte y aerobicos 1 (Grupo 02)', '2020-10-29 04:25:14', '2020-10-29 04:25:14'),
(284, 6, 25, 'Martes', '9-10', 'Deporte y aerobicos 1 (Grupo 02)', '2020-10-29 04:25:15', '2020-10-29 04:25:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `int_fac_asi`
--

CREATE TABLE `int_fac_asi` (
  `id` int(11) NOT NULL,
  `codmat` varchar(20) NOT NULL,
  `codfac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `id_licencia` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `sede` varchar(100) NOT NULL DEFAULT 'Valledupar',
  `id_programa` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`id_licencia`, `nombre`, `email`, `telefono`, `sede`, `id_programa`, `created_at`, `updated_at`) VALUES
(1, 'Departamento de matematicas y fisicas', 'matematicas@unicesar.edu.co', '5849309', 'Valledupar', 18, '2020-04-12 23:07:29', '2020-04-12 23:07:29'),
(2, 'Departamento de sistemas', 'ingsistemas@unicesar.edu.co', '5712812', 'Valledupar', 10, '2020-05-06 02:33:41', '2020-05-06 02:33:41'),
(6, 'Deporte y educacion fisica', 'deporte@unicesar.edu.co', '570 8765', 'Valledupar', 25, '2020-09-01 21:37:55', '2020-09-06 23:28:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `notificacion` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `id_tercero_envia` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `id_tercero_recibe` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `id_dominio_tipo` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `estado` int(11) DEFAULT 0,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `id_formato` int(11) DEFAULT NULL,
  `id_periodo_academico` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `id_dominio_tipo_formato` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_notificacion`, `notificacion`, `id_tercero_envia`, `id_tercero_recibe`, `id_dominio_tipo`, `estado`, `fecha`, `id_formato`, `id_periodo_academico`, `id_asignatura`, `id_dominio_tipo_formato`, `created_at`, `updated_at`) VALUES
(113, 'Se ah generado un nuevo plazo-extra para el seguimiento con codigo 28 con un nuevo lapso de tiempo durante el 2020-09-09 hasta2020-09-11', '76', '75', '8', 1, '2020-09-08 23:14:29', 28, 0, 0, 11, '2020-09-08 23:14:29', '2020-09-09 05:28:20'),
(114, 'Se ah generado un nuevo plazo-extra para el seguimiento con codigo 28 con un nuevo lapso de tiempo durante el 2020-09-09 hasta2020-10-16', '76', '75', '8', 1, '2020-09-08 23:14:51', 28, 0, 0, 11, '2020-09-08 23:14:51', '2020-09-09 05:29:01'),
(115, 'El administrador notifica que se encuenta En espera en el seguimiento de asignatura con codigo 28 con relacion a la asignatura Introduccion a la educacion fisica (DEPO-01A)  para el grupo 01 perteneciente al 1 corte del periodo academico 2020-1.', '76', '75', '9', 1, '2020-09-09 05:26:13', 28, 0, 0, 11, '2020-09-09 05:26:13', '2020-09-09 05:29:08'),
(116, 'Se ah generado un nuevo plazo-extra para el seguimiento con codigo 29 con un nuevo lapso de tiempo durante el 2020-10-23 hasta2020-10-23', '76', '75', '8', 1, '2020-09-09 05:27:17', 29, 0, 0, 11, '2020-09-09 05:27:17', '2020-10-05 02:43:05'),
(117, 'Se ah generado un nuevo plazo-extra para el seguimiento con codigo 30 con un nuevo lapso de tiempo durante el 2020-10-23 hasta2020-10-23', '76', '75', '8', 1, '2020-09-09 05:27:29', 30, 0, 0, 11, '2020-09-09 05:27:29', '2020-10-05 02:41:50'),
(118, 'Se ah generado un nuevo plazo-extra para el seguimiento con codigo 28 con un nuevo lapso de tiempo durante el 2020-10-15 hasta2020-10-15', '76', '75', '8', 1, '2020-09-09 05:27:43', 28, 0, 0, 11, '2020-09-09 05:27:43', '2020-09-09 05:28:45'),
(119, 'El docente Luis Daniel Aponte solicita un plazo exta para el seguimiento de asignatura 29', '75', '76', '8', 1, '2020-09-09 05:36:22', 29, 0, 0, 11, '2020-09-09 05:36:22', '2020-10-20 17:04:42'),
(120, 'El docente Luis Daniel Aponte solicita un plazo exta para el seguimiento de asignatura 30', '75', '76', '8', 1, '2020-09-09 05:36:26', 30, 0, 0, 11, '2020-09-09 05:36:26', '2020-10-20 17:00:42'),
(121, 'El docente Luis Daniel Aponte solicita un plazo exta para el seguimiento de asignatura 29', '75', '76', '8', 1, '2020-09-09 05:37:05', 29, 0, 0, 11, '2020-09-09 05:37:05', '2020-10-20 17:00:20'),
(122, 'El docente Luis Daniel Aponte solicita un plazo exta para el seguimiento de asignatura 30', '75', '76', '8', 1, '2020-09-09 05:38:49', 30, 0, 0, 11, '2020-09-09 05:38:49', '2020-10-20 16:57:56'),
(123, 'El docente Luis Daniel Aponte solicita un plazo exta para el seguimiento de asignatura 29', '75', '76', '8', 1, '2020-09-09 05:55:27', 29, 0, 0, 11, '2020-09-09 05:55:27', '2020-10-20 16:57:33'),
(124, 'El docente Luis Daniel Aponte solicita un plazo exta para el seguimiento de asignatura 30', '75', '76', '8', 1, '2020-09-09 05:57:36', 30, 0, 0, 11, '2020-09-09 05:57:36', '2020-10-20 16:57:11'),
(125, 'El docente Luis Daniel Aponte solicita un plazo exta para el seguimiento de asignatura 30', '75', '76', '8', 1, '2020-09-09 06:00:27', 30, 0, 0, 11, '2020-09-09 06:00:27', '2020-09-20 05:13:35'),
(126, 'El docente Luis Daniel Aponte solicita un plazo exta para el seguimiento de asignatura 29', '75', '76', '8', 1, '2020-09-09 06:01:13', 29, 0, 0, 11, '2020-09-09 06:01:13', '2020-09-14 02:31:53'),
(127, '', '75', '76', '32', 1, '2020-09-20 04:42:35', 7, 0, 0, 33, '2020-09-20 04:42:35', '2020-09-20 05:13:06'),
(128, '', '75', '76', '32', 1, '2020-09-20 04:44:22', 7, 0, 0, 33, '2020-09-20 04:44:22', '2020-09-20 05:10:23'),
(129, 'Deberiamos cambiar la unidad xxx xxxx xxxx de este plan ya que no esta muy actualizada que se diga us ted disculpe chirrete', '75', '76', '32', 1, '2020-09-20 04:46:54', 7, 0, 0, 33, '2020-09-20 04:46:54', '2020-09-20 05:10:13'),
(130, 'Deberiamos cambiar la unidad xxx xxxx xxxx de este plan ya que no esta muy actualizada que se diga us ted disculpe chirrete', '75', '76', '32', 1, '2020-09-20 04:47:35', 7, 0, 0, 33, '2020-09-20 04:47:35', '2020-09-20 04:53:33'),
(131, 'El docente Luis Daniel Aponte solicita un plazo exta para la actividad complementaria 30', '75', '76', '8', 1, '2020-09-22 04:02:04', 30, 0, 0, 14, '2020-09-22 04:02:04', '2020-09-23 04:09:42'),
(132, 'El administrador notifica que se encuenta Retrasado 8 dias y 12 horas en el seguimiento de asignatura con codigo 39 con relacion a la asignatura Deporte y aerobicos 1 (DEPO-01B)  para el grupo 02 perteneciente al 3 corte del periodo academico 2020-2.', '76', '75', '9', 1, '2020-10-20 17:07:21', 39, 0, 0, 11, '2020-10-20 17:07:21', '2020-10-21 23:22:34'),
(133, 'El administrador notifica que se encuenta Retrasado 8 dias y 12 horas en el seguimiento de asignatura con codigo 39 con relacion a la asignatura Deporte y aerobicos 1 (DEPO-01B)  para el grupo 02 perteneciente al 3 corte del periodo academico 2020-2.', '76', '75', '9', 1, '2020-10-20 17:09:09', 39, 0, 0, 11, '2020-10-20 17:09:09', '2020-10-21 23:22:28'),
(134, 'El administrador notifica que se encuenta Retrasado 8 dias y 12 horas en el seguimiento de asignatura con codigo 39 con relacion a la asignatura Deporte y aerobicos 1 (DEPO-01B)  para el grupo 02 perteneciente al 3 corte del periodo academico 2020-2.', '76', '75', '9', 1, '2020-10-20 17:10:21', 39, 0, 0, 11, '2020-10-20 17:10:21', '2020-10-21 23:22:18'),
(135, 'El administrador te ah revisado el plan de trabajo del periodo 2020-2', '76', '75', '6', 1, '2020-10-20 23:20:03', 12, 0, 0, 12, '2020-10-20 23:20:03', '2020-10-21 16:23:58'),
(136, 'El administrador notifica que se encuenta Retrasado 6 dias y 18 horas en el formato de actividades complementarias (Corte 1) del periodo academico 2020-1.', '76', '75', '9', 1, '2020-10-20 23:22:22', 28, 0, 0, 14, '2020-10-20 23:22:22', '2020-10-21 16:23:13'),
(137, 'El jefe de departamento ha revisado el plan de desarrollo de la asignatura Introduccion a la educacion fisica - DEPO-01A', '76', '75', '6', 1, '2020-10-20 23:49:34', 15, 0, 0, 13, '2020-10-20 23:49:34', '2020-10-21 16:22:48'),
(138, 'El jefe de departamento ha revisado el plan de desarrollo de la asignatura Introduccion a la educacion fisica - DEPO-01A', '76', '75', '6', 1, '2020-10-20 23:50:16', 15, 0, 0, 13, '2020-10-20 23:50:16', '2020-10-21 16:22:33'),
(139, 'El jefe de departamento ha revisado el plan de desarrollo de la asignatura Introduccion a la educacion fisica - DEPO-01A', '76', '75', '6', 1, '2020-10-20 23:51:06', 15, 0, 0, 13, '2020-10-20 23:51:06', '2020-10-21 00:15:32'),
(140, 'El jefe de departamento ha revisado el plan de desarrollo de la asignatura Introduccion a la educacion fisica - DEPO-01A', '76', '75', '6', 1, '2020-10-21 21:25:54', 22, 0, 0, 13, '2020-10-21 21:25:54', '2020-10-21 21:26:51'),
(141, 'El administrador te ah revisado el plan de trabajo del periodo 2020-1', '76', '75', '6', 1, '2020-10-25 05:14:59', 13, 0, 0, 12, '2020-10-25 05:14:59', '2020-10-27 16:14:36'),
(142, 'El jefe de departamento ha revisado el plan de desarrollo de la asignatura Introduccion a la educacion fisica - DEPO-01A', '76', '75', '6', 1, '2020-10-27 16:00:29', 22, 0, 0, 13, '2020-10-27 16:00:29', '2020-10-27 16:17:55'),
(143, 'El administrador notifica que se encuenta Retrasado 14 dias y 23 horas en el seguimiento de asignatura con codigo 37 con relacion a la asignatura Deporte y aerobicos 1 (DEPO-01B)  para el grupo 02 perteneciente al 1 corte del periodo academico 2020-2.', '76', '75', '9', 1, '2020-10-28 04:06:55', 37, 0, 0, 11, '2020-10-28 04:06:55', '2020-10-28 04:11:45'),
(144, 'El administrador te ah revisado el plan de trabajo del periodo 2020-1', '76', '75', '6', 1, '2020-10-29 03:31:46', 13, 0, 0, 12, '2020-10-29 03:31:46', '2020-10-29 04:23:54'),
(145, 'El jefe de departamento te notifica retraso de Retrasado 245 dias y 23 horas en el plan de trabajo del periodo academico 2021-1.', '76', '75', '9', 1, '2020-10-29 04:22:17', NULL, 15, NULL, 12, '2020-10-29 04:22:17', '2020-10-29 04:24:11'),
(146, 'Se ah generado un nuevo plazo-extra para el plan de trabajo del 2021-1 un nuevo lapso de tiempo durante el 2020-10-27 hasta2020-10-29', '76', '75', '8', 1, '2020-10-29 04:42:45', NULL, 15, NULL, 12, '2020-10-29 04:42:45', '2020-10-29 05:09:38'),
(147, 'Se ah generado un nuevo plazo-extra para el seguimiento con codigo 37 con un nuevo lapso de tiempo durante el 2020-10-28 hasta2020-10-30', '76', '75', '8', 1, '2020-10-29 23:26:50', 37, NULL, NULL, 11, '2020-10-29 23:26:50', '2020-10-29 23:28:01'),
(148, 'El jefe de departamento te notifica que estas Retrasado 3 dias y 20 horas en el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del periodo academico 2020-2.', '76', '75', '9', 1, '2020-10-30 01:37:57', NULL, 2018, NULL, 13, '2020-10-30 01:37:57', '2020-10-30 05:00:31'),
(149, 'El jefe de departamento te notifica que estas Retrasado 3 dias y 20 horas en el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del periodo academico 2020-2.', '76', '75', '9', 1, '2020-10-30 01:38:12', NULL, 2018, NULL, 13, '2020-10-30 01:38:12', '2020-10-30 05:00:42'),
(150, 'Se ah generado un nuevo plazo-extra para el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del 2020-2 con un nuevo lapso de tiempo desde 2020-10-29 hasta2020-11-05', '76', '75', '8', 1, '2020-10-30 01:45:10', NULL, 12, 48, 13, '2020-10-30 01:45:10', '2020-10-30 05:00:58'),
(151, 'Se han actualizado las fechas de el plazo-extra para el plan de trabajo del 2021-1 con un nuevo lapso de tiempo desde 2020-10-27 hasta2020-10-31', '76', '75', '8', 1, '2020-10-30 04:55:59', NULL, 15, NULL, 12, '2020-10-30 04:55:59', '2020-10-30 05:04:03'),
(152, 'El jefe de departamento actual ha cancelado el plazo-extra para el plan de trabajo del 2021-1 con un nuevo lapso de tiempo desde 2020-10-27 00:00:00 hasta2020-10-31 23:59:59', '76', '75', '8', 1, '2020-10-30 05:11:03', NULL, 15, NULL, 12, '2020-10-30 05:11:03', '2020-10-30 05:13:22'),
(153, 'El jefe de departamento actual ha cancelado el plazo-extra para el plan de trabajo del 2021-1 vigente desde 2020-10-27 00:00:00 hasta2020-10-31 23:59:59', '76', '75', '8', 1, '2020-10-30 05:13:09', NULL, 15, NULL, 12, '2020-10-30 05:13:09', '2020-10-30 05:14:21'),
(154, 'Se han actualizado las fechas de el plazo-extra para el plan de trabajo del 2021-1 con un nuevo lapso de tiempo desde 2020-10-27 hasta 2020-10-28', '76', '75', '8', 1, '2020-10-30 05:18:08', NULL, 15, NULL, 12, '2020-10-30 05:18:08', '2020-10-30 05:20:08'),
(155, 'Se han actualizado las fechas de el plazo-extra para el plan de trabajo del 2021-1 con un nuevo lapso de tiempo desde 2020-10-27 hasta 2020-10-31', '76', '75', '8', 1, '2020-10-30 05:18:35', NULL, 15, NULL, 12, '2020-10-30 05:18:35', '2020-10-30 05:20:03'),
(156, 'El jefe de departamento actual ha cancelado el plazo-extra para el plan de trabajo del 2021-1 vigente desde 2020-10-27 00:00:00 hasta 2020-10-31 23:59:59', '76', '75', '8', 1, '2020-10-30 05:19:08', NULL, 15, NULL, 12, '2020-10-30 05:19:08', '2020-10-30 05:19:59'),
(157, 'Se han actualizado las fechas de el plazo-extra para el seguimiento con codigo 37 con un nuevo lapso de tiempo desde 2020-10-28 hasta 2020-10-31', '76', '75', '8', 1, '2020-10-30 05:29:00', 37, NULL, NULL, 11, '2020-10-30 05:29:00', '2020-10-30 05:29:23'),
(158, 'El jefe de departamento actual ha cancelado el plazo-extra para el seguimiento con codigo 37 vigente desde 2020-10-28 00:00:00 hasta 2020-10-31 23:59:59', '76', '75', '8', 1, '2020-10-30 05:29:38', 37, NULL, NULL, 11, '2020-10-30 05:29:38', '2020-10-30 05:30:09'),
(159, 'El jefe de departamento te notifica que estas Retrasado 17 dias y 0 horas en el plan de trabajo del periodo academico Ever Aponte.', '76', '75', '9', 0, '2020-10-30 05:31:05', NULL, 37, NULL, 12, '2020-10-30 05:31:05', '2020-10-30 05:31:05'),
(160, 'Se han actualizado las fechas de el plazo-extra para el plan de trabajo del 2021-1 con un nuevo lapso de tiempo desde 2020-10-27 hasta 2020-11-01', '76', '75', '8', 0, '2020-10-30 05:47:22', NULL, 15, NULL, 12, '2020-10-30 05:47:22', '2020-10-30 05:47:22'),
(161, 'El jefe de departamento actual ha cancelado el plazo-extra para el plan de trabajo del 2021-1 vigente desde 2020-10-27 00:00:00 hasta 2020-11-01 23:59:59', '76', '75', '8', 0, '2020-10-30 05:47:36', NULL, 15, NULL, 12, '2020-10-30 05:47:36', '2020-10-30 05:47:36'),
(162, 'El jefe de departamento actual ha cancelado el plazo-extra para el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del 2020-2 vigente desde 2020-10-29 00:00:00 hasta 2020-11-05 23:59:59', '76', '75', '8', 0, '2020-10-30 15:51:40', NULL, 12, 48, 13, '2020-10-30 15:51:40', '2020-10-30 15:51:40'),
(163, 'Se ah generado un nuevo plazo-extra para el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del 2020-2 con un nuevo lapso de tiempo desde 2020-10-29 hasta 2020-11-02', '76', '75', '8', 0, '2020-10-30 15:53:36', NULL, 12, 48, 13, '2020-10-30 15:53:36', '2020-10-30 15:53:36'),
(164, 'Se ah generado un nuevo plazo-extra para el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del 2020-2 con un nuevo lapso de tiempo desde 2020-10-29 hasta 2020-11-05', '76', '75', '8', 0, '2020-10-30 15:55:11', NULL, 12, 48, 13, '2020-10-30 15:55:11', '2020-10-30 15:55:11'),
(165, 'Se han actualizado las fechas de el plazo-extra para el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del 2020-2 con un nuevo lapso de tiempo desde 2020-10-29 hasta 2020-11-06', '76', '75', '8', 0, '2020-10-30 15:55:41', NULL, 12, 48, 13, '2020-10-30 15:55:41', '2020-10-30 15:55:41'),
(166, 'El jefe de departamento actual ha cancelado el plazo-extra para el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del 2020-2 vigente desde 2020-10-29 00:00:00 hasta 2020-11-06 23:59:59', '76', '75', '8', 0, '2020-10-30 15:55:51', NULL, 12, 48, 13, '2020-10-30 15:55:51', '2020-10-30 15:55:51'),
(167, 'El jefe de departamento te notifica que estas Retrasado 4 dias y 10 horas en el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del periodo academico 2020-2.', '76', '75', '9', 0, '2020-10-30 15:57:21', NULL, 12, NULL, 13, '2020-10-30 15:57:21', '2020-10-30 15:57:21'),
(168, 'El jefe de departamento te notifica que estas Retrasado 4 dias y 10 horas en el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del periodo academico 2020-2.', '76', '75', '9', 0, '2020-10-30 15:57:36', NULL, 12, NULL, 13, '2020-10-30 15:57:36', '2020-10-30 15:57:36'),
(169, 'El jefe de departamento te notifica que estas Retrasado 247 dias y 11 horas en el plan de trabajo del periodo academico 2021-1.', '76', '75', '9', 0, '2020-10-30 16:10:31', NULL, 15, NULL, 12, '2020-10-30 16:10:31', '2020-10-30 16:10:31'),
(170, 'El jefe de departamento te notifica que estas Retrasado 247 dias y 11 horas en el plan de trabajo del periodo academico 2021-1.', '76', '75', '9', 0, '2020-10-30 16:11:15', NULL, 15, NULL, 12, '2020-10-30 16:11:15', '2020-10-30 16:11:15'),
(171, 'El jefe de departamento te notifica que estas Retrasado 4 dias y 11 horas en el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del periodo academico 2020-2.', '76', '75', '9', 0, '2020-10-30 16:13:59', NULL, 12, 48, 13, '2020-10-30 16:13:59', '2020-10-30 16:13:59'),
(172, 'El jefe de departamento ha revisado el plan de desarrollo de la asignatura Introduccion a la educacion fisica - DEPO-01A correspondiente al P.Academico ', '76', '75', '6', 0, '2020-10-30 16:31:38', 23, NULL, NULL, 13, '2020-10-30 16:31:38', '2020-10-30 16:31:38'),
(173, 'El jefe de departamento te notifica que estas Retrasado 4 dias y 11 horas en el plan de desarrollo de la asignatura Deporte y aerobicos 1 (DEPO-01B) del periodo academico 2020-2.', '76', '75', '9', 0, '2020-10-30 16:42:23', NULL, 12, 48, 13, '2020-10-30 16:42:23', '2020-10-30 16:42:23'),
(174, 'El jefe de departamento ha revisado el plan de desarrollo de la asignatura Introduccion a la educacion fisica - DEPO-01A correspondiente al P.Academico ', '76', '75', '6', 0, '2020-10-30 17:30:13', 23, 15, 47, 13, '2020-10-30 17:30:13', '2020-10-30 17:30:13'),
(175, 'El jefe de departamento ha revisado el plan de desarrollo de la asignatura Introduccion a la educacion fisica - DEPO-01A correspondiente al P.Academico ', '76', '75', '6', 0, '2020-10-30 17:37:51', 23, 15, 47, 13, '2020-10-30 17:37:51', '2020-10-30 17:37:51'),
(176, 'El jefe de departamento ha revisado el seguimiento de asignatura numero 36.', '76', '75', '6', 1, '2020-10-30 17:40:09', 36, 12, 47, 11, '2020-10-30 17:40:09', '2020-11-02 18:51:43'),
(177, 'El jefe de departamento te ha revisado el plan de trabajo del periodo 2020-1', '76', '75', '6', 0, '2020-10-30 17:41:46', 13, 11, NULL, 12, '2020-10-30 17:41:46', '2020-10-30 17:41:46'),
(178, 'Se ah generado un nuevo plazo-extra para el plan de trabajo del 2021-1 con un nuevo lapso de tiempo desde 2020-11-11 hasta 2020-11-18', '76', '75', '8', 0, '2020-11-02 18:37:16', NULL, 15, NULL, 12, '2020-11-02 18:37:16', '2020-11-02 18:37:16'),
(179, 'El jefe de departamento te notifica que estas Retrasado 26 dias y 16 horas en la actividad complementaria del periodo academico 2020-2 con relacion al 2 corte.', '76', '75', '9', 0, '2020-11-02 21:40:21', 14, NULL, NULL, 14, '2020-11-02 21:40:21', '2020-11-02 21:40:21'),
(180, 'El jefe de departamento te notifica que estas Retrasado 26 dias y 16 horas en la actividad complementaria del periodo academico 2020-2 con relacion al 2 corte.', '76', '75', '9', 0, '2020-11-02 21:42:29', 14, NULL, NULL, 14, '2020-11-02 21:42:29', '2020-11-02 21:42:29'),
(181, 'Se ha generado un nuevo plazo-extra para la actividad complementaria numero 14 con un nuevo lapso de tiempo desde 2020-11-02 hasta 2020-11-09', '76', '75', '8', 1, '2020-11-02 22:02:14', 14, NULL, NULL, 14, '2020-11-02 22:02:14', '2020-11-02 22:07:13'),
(182, '', '76', '75', '8', 0, '2020-11-02 22:06:01', 14, NULL, NULL, 14, '2020-11-02 22:06:01', '2020-11-02 22:06:01'),
(183, 'Se han actualizado las fechas del plazo-extra para la actividad complementaria numero 14 con un nuevo lapso de tiempo desde 2020-11-02 hasta 2020-11-11', '76', '75', '8', 0, '2020-11-02 22:50:16', 14, NULL, NULL, 14, '2020-11-02 22:50:16', '2020-11-02 22:50:16'),
(184, 'El jefe de departamento te ha revisado las actividades complementarias perteneciente al 3 corte del periodo 2020-2', '76', '75', '6', 1, '2020-11-02 23:14:47', 15, NULL, NULL, 14, '2020-11-02 23:14:47', '2020-12-03 19:46:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `perfil` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `perfil`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 1, '2020-02-09 10:09:58', '2020-02-09 10:09:58'),
(2, 'Docente', 1, '2020-02-09 10:09:58', '2020-02-09 10:09:58'),
(3, 'Alumno', 1, '2020-11-04 04:57:07', '2020-11-04 04:57:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_academico`
--

CREATE TABLE `periodo_academico` (
  `id_periodo_academico` int(11) NOT NULL,
  `periodo` varchar(15) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `total_semanas` int(11) DEFAULT NULL,
  `id_academusoft` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `periodo_academico`
--

INSERT INTO `periodo_academico` (`id_periodo_academico`, `periodo`, `fechaInicio`, `fechaFin`, `total_semanas`, `id_academusoft`, `created_at`, `updated_at`) VALUES
(11, '2020-1', '2020-02-17', '2020-10-31', 18, 9899, '2020-09-01 21:39:41', '2020-09-01 21:39:41'),
(12, '2020-2', '2020-07-13', '2020-12-15', 17, 9999, '2020-09-06 22:22:43', '2020-09-21 00:06:36'),
(15, '2021-1', '2021-02-12', '2021-07-15', 18, 9987, '2020-09-23 05:17:55', '2020-09-23 05:17:55'),
(16, '2021-2', '2021-07-30', '2021-12-15', 19, 9932, '2020-09-27 03:52:05', '2020-09-27 03:52:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_asignatura`
--

CREATE TABLE `plan_asignatura` (
  `id_plan_asignatura` int(11) NOT NULL,
  `descripcion_asignatura` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `objetivo_general` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `objetivos_especificos` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estrategias_pedagogicas` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `competencias_genericas` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `mecanismos_evaluacion` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `referencias_bibliograficas` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_periodo_academico` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plan_asignatura`
--

INSERT INTO `plan_asignatura` (`id_plan_asignatura`, `descripcion_asignatura`, `objetivo_general`, `objetivos_especificos`, `estrategias_pedagogicas`, `competencias_genericas`, `mecanismos_evaluacion`, `referencias_bibliograficas`, `id_periodo_academico`, `id_asignatura`, `estado`, `created_at`, `updated_at`) VALUES
(7, '<h3><strong>Competencias Generales</strong></h3><ul><li>Reconoce la importancia del trabajo en equipo, la permanente comunicación e interacción para el logro de las metas propuestas en el contexto.</li><li>Responde con responsabilidad a las actividades asignadas para el logro de los objetivos propuestos en la asignatura.</li><li>Toma decisiones previo análisis de ventajas y desventajas a las que estas pueden conducir y su incidencia en las metas propuestas en el contexto</li></ul><h3><strong>Competencias Específicas</strong></h3><p>Desarrolla soluciones Big Data adaptadas para la captación, almacenamiento y tratamiento de grandes volúmenes de datos procedentes de diferentes contextos.</p>', '<p>El objetivo fundamental de la asignatura de DATA SCIENCE es que los alumnos aprendan los fundamentos teóricos y los métodos adecuados para saber cómo aplicar las <strong>herramientas analíticas</strong> en diferentes contextos de aplicación.</p>', '<ul><li>Conocer los conceptos y terminologías fundamental de Big Data Science y ciclo de vida de análisis de Big Data Science</li><li>Identificar, aplicar y evaluar los conceptos tecnológicos para el análisis de Big data</li><li>Conocer las diferentes etapas del ciclo de vida del analisi de Big Data</li><li>Extraer los datos, independientemente de su fuente (webs, csv, logs, apios, etc.) y de su volumen (Big Data o Small Data).</li><li>Desarrollar las diferentes técnicas de análisis de datos</li><li>Procesar los datos usando diferentes métodos de análisis exploratorio y estadísticos.</li></ul>', '<p>Entre las estrategias pedagógicas utilizadas por el docente para impartir la asignatura se encuentran:</p><ul><li><strong>Talleres. </strong>Esta estrategia metodológica fortalece el proceso de enseñanza- aprendizaje;el taller es una actividad práctica que promueve un espacio de reflexión y construcción del conocimiento; estos son previamente diseñados por los docentes con base a las competencias que el estudiante debe desarrollar en cada asignatura y publicados en espacios tales como: web sites, blogs, aula web o aula de clases. Las asignaturas de tipo teórico - práctico usan esta estrategia para promover el trabajo en equipo, consultas y profundización investigativa.</li><li><strong>Mediaciones Virtuales.</strong> El uso y apropiación de las tics se convierten en herramientas claves que son de apoyo al proceso de formación en el aula de clases, debido a que promueven en el estudiante la búsqueda permanente del conocimiento a través de herramientas como: plataformas virtuales- aula web, redes profesionales, sociales, web sites, aplicaciones en la nube, correo electrónico, foros y demás herramientas sincrónicas y sincrónicas que facilitan la interacción.</li><li><strong>Visitas empresariales:</strong> estas acercan al estudiante con aplicaciones y situaciones reales de la ingeniería de sistemas en los diferentes sectores productivos. Asociadas al conocimiento que el estudiante debe tener de su entorno, persiguiendo la construcción de pensamiento crítico y el aprendizaje significativo.</li><li><strong>Proyecto de aula</strong>: esta estrategia corresponde al desarrollo del proyecto guiado por el docente desde el inicio del semestre y donde el estudiante es el actor principal, quien debe identificar problemas del entorno y a través de aplicativos confiables contribuir a la optimización de los procesos.</li></ul>', '<p><strong>Competencias Generales</strong></p><ul><li>Reconoce la importancia del trabajo en equipo, la permanente comunicación e interacción para el logro de las metas propuestas en el contexto.</li><li>Responde con responsabilidad a las actividades asignadas para el logro de los objetivos propuestos en la asignatura.</li><li>Toma decisiones previo análisis de ventajas y desventajas a las que estas pueden conducir y su incidencia en las metas propuestas en el contexto</li></ul><p><strong>Competencias Específicas</strong></p><p>Desarrolla soluciones Big Data adaptadas para la captación, almacenamiento y tratamiento de grandes volúmenes de datos procedentes de diferentes contextos.</p>', '<p><strong>PARCIALES:</strong></p><ul><li><strong>Primer parcial: </strong>30% ( 5% talleres, trabajos, 5% primera entrega del proyecto final y 20% parcial).</li><li><strong>Segundo parcial: </strong>30% ( 5% talleres, trabajos y asistencia, 5% segunda entrega del proyecto final y parcial 20%.</li><li><strong>Tercer parcial: </strong>40% ( 20% Parcial y 20% Trabajo final).</li></ul><p><strong>TRABAJOS:</strong></p><p>Asistencia a clases.</p><p>Ejercicios.</p><p>Exposiciones.</p><p>Talleres.</p>', '<p>Big Data Análisis Grandes Volúmenes de Datos en Organizaciones, Luis Joyane Aguilar, Alfaomega</p><p> </p><p><strong>LIBROS DIGITALES</strong></p><ul><li>[TSK05] Pang-Ning Tan, Michael Steinbach, Vipin Kumar, 2005, Introduction to Data Mining, Addison-Wesley.</li></ul><p><a href=\"http://www-users.cs.umn.edu/~kumar/dmbook/index.php\"><strong>http://www-users.cs.umn.edu/~kumar/dmbook/index.php</strong></a></p><ul><li>[Alp10] Alpaydin, E. 2010 Introduction to Machine Learning, 2nd Ed. The MIT Press</li></ul><p><a href=\"https://www.cmpe.boun.edu.tr/~ethem/i2ml2e/\"><strong>https://www.cmpe.boun.edu.tr/~ethem/i2ml2e/</strong></a></p>', 12, 47, 1, '2020-09-17 01:33:58', '2020-10-21 21:19:09'),
(11, '<h3><strong>Competencias Generales</strong></h3><ul><li>Reconoce la importancia del trabajo en equipo, la permanente comunicación e interacción para el logro de las metas propuestas en el contexto.</li><li>Responde con responsabilidad a las actividades asignadas para el logro de los objetivos propuestos en la asignatura.</li><li>Toma decisiones previo análisis de ventajas y desventajas a las que estas pueden conducir y su incidencia en las metas propuestas en el contexto</li></ul><h3><strong>Competencias Específicas</strong></h3><p>Desarrolla soluciones Big Data adaptadas para la captación, almacenamiento y tratamiento de grandes volúmenes de datos procedentes de diferentes contextos.</p><figure class=\"table\"><table><thead><tr><th>sdfgsfg</th><th>sgfsdf</th><th>dsfgsdf</th><th>sdfgsd</th><th>sdfgs</th><th>sdfgsd</th></tr></thead><tbody><tr><td>gsafg</td><td>sdfgs</td><td>sdf</td><td>gds</td><td>sdfg</td><td>sdfg</td></tr></tbody></table></figure>', '<p>Yo <strong>NOMBRE </strong>mayor de edad, identificado(a) con documento de identidad <strong>TIPODOCUMENTO </strong>número <strong>IDENTIFICACION </strong>expedido en <strong>CIUDADAFILIADO</strong>, he decidido celebrar el presente contrato de recaudo electrónico a través de débito automático, por medio de pago Tarjeta de Crédito, bajo las siguientes condiciones:</p><ol><li>El presente contrato, aplica para los planes adquiridos por medio del <strong>CANAL ONLINE</strong>, es decir, a través de la página web <a href=\"http://www.spinningcentergym.com/\">www.spinningcentergym.com, </a>con medio de pago electrónico, con recurrencia mensual del valor de la afiliación, por el término de doce (12) meses, directamente desde mi tarjeta de crédito.</li><li>Con la suscripción del presente contrato, habilito a <strong>SPINNING CENTER GYM</strong>, para que por intermedio de las pasarelas de pago contratadas para su operación, realice la recurrencia mensual de débito automático de mi afiliación mensual.</li><li>El cobro del cargo fijo mensual de Afiliación, se efectuará de manera anticipada, mensualmente. Los cobros se realizarán en la fecha que corresponda a los treinta (30) días posteriores al primer pago efectuado, afectando el cupo de la tarjeta de crédito que en mi condición de AFILIADO expresamente indique y autorice a <strong>SPINNING CENTER GYM</strong>, mediante la suscripción del Formato de Autorización contenido en este Contrato, entendiéndose como pago oportuno el que se realice a más tardar el sexto día hábil posterior a la fecha de cobro. El pago se entenderá surtido, una vez la entidad financiera de EL AFILIADO, abone la totalidad del importe en la cuenta de <strong>SPINNING CENTER GYM </strong>o de quien este indique.</li><li>En los casos en que por algún motivo, la entidad financiera no pueda debitar de la cuenta suministrada el valor de la afiliación, los autorizo para informarme por cualquier medio idóneo del inconveniente presentado; de no normalizarse la situación, luego de tres (03) intentos para realizar la transacción y esta no sea exitosa,acepto que mi afiliación sea cancelada de manera inmediata. En caso de cancelación, EL AFILIADO, deberá tomar nuevamente la suscripción por medio de la página web <a href=\"http://www.spinningcentergym.com/\">www.spinningcentergym.com</a></li><li>La recurrencia mensual del valor de la afiliación a la tarjeta de crédito, la realizará la entidad financiera que el cliente señale, y en caso de algún error en el valor cobrado, el cliente será quien deba informar directamente a la entidad financiera y a <strong>SPINNING CENTER GYM </strong>de esta situación. EL AFILIADO asumirá los impuestos y gravámenes que se deriven de la recurrencia mensual.</li><li>Es responsabilidad de EL AFILIADO, cerciorarse que mensualmente se realice el cobro del cargo fijo mensual a su tarjeta de crédito por el valor correcto. <strong>SPINNING CENTER GYM </strong>no asume ninguna responsabilidad cuando se presenten inconsistencias al cargar el cupo de Tarjeta de Crédito, tales como cuenta cancelada, cuenta saldada, tarjeta bloqueada, tarjeta cancelada, cuenta en sobregiro, cuenta embargada, saldo en canje, titular fallecido, rechazos preventivos emitidos por la pasarela de pago o cualquier otro problema no imputable a <strong>SPINNING CENTER GYM, </strong>que no permita cargar el valor del pago autorizado. Tampoco será responsable por transacciones que no se puedan efectuar por problemas de línea o de congestión, fuerza mayor, caso fortuito o cualquier otra circunstancia no imputable a <strong>SPINNING CENTER GYM.</strong></li><li>EL AFILIADO, en cualquier momento, podrá actualizar los datos de su cuenta bancaria.</li><li>El plan adquirido por medio del presente contrato<strong>, </strong>no permite la aplicación de plan de referidos, ni aplicación de cortesías o promociones; así como, no permite que <strong>EL AFILIADO</strong> efectúe las congelaciones estipuladas en los planes tradicionales de la cadena, traslados de plan o cesión del mismo.</li><li>El presente contrato se renovará automáticamente, salvo que EL AFILIADO manifieste su intención de no hacerlo, con no menos de quince (15) días de anticipación a la fecha de terminación de su PLAN, solicitud que deberá ser radicada en la sede de <strong>SPINNING CENTER GYM </strong>en la que se encuentre afiliado y mediante correo electrónico enviado a <a href=\"mailto:servicioalcliente@spinningentergym.com\">servicioalcliente@spinningentergym.com.</a></li><li>EL AFILIADO, podrá terminar en cualquier momento de forma unilateral el presente contrato,para lo cual, deberá notificar su decisión con no menos de quince (15) días de anticipación a la fecha de terminación de su PLAN, solicitud que deberá ser radicada en la sede de <strong>SPINNING CENTER GYM </strong>en la que se encuentre afiliado y mediante correo electrónico enviado a <a href=\"mailto:servicioalcliente@spinningentergym.com\">servicioalcliente@spinningentergym.com.</a></li><li><strong>EXCEPCIONES DE PAGO.</strong><ol><li>Incapacidad. En los casos en los que EL AFILIADO presente incapacidad certificada por un profesional de la salud, deberá enviarla al correo electrónico de servicio al cliente, en un máximo de cinco (05) días anticipados a su fecha de débito automático, con el fin de que no se genere el cobro por el término de duración de la incapacidad, y se postergue la fecha de cobro del siguiente mes de débito automático. La incapacidad estará atada a la previa verificación y aprobación por parte de la dirección médica de SPINNING CENTER GYM.</li><li>En caso de que se adquiera un plan anual, semestral o trimestral directamente en counter, por medio del canal directo, canal corporativo o canal online, EL AFILIADO, deberá notificar al correo electrónico <a href=\"mailto:servicioalcliente@spinningentergym.com\">servicioalcliente@spinningentergym.com</a> para que se proceda a realizar la actualización pertinente en sistema y cancelación de su Debito Automático.</li></ol></li><li><strong>SPINNING CENTER GYM </strong>puede cancelar, limitar o adicionar los términos y condiciones de este contrato, mediante aviso dado en tal sentido, a través de los canales oficiales de la cadena. Si anunciada la modificación, EL AFILIADO no manifiesta por escrito su decisión de excluirse de este servicio, o continua ejecutándolo, se entenderá que acepta incondicionalmente las modificaciones introducidas.</li><li><strong>SPINNING CENTER GYM </strong>se reservará la facultad de suspender, limitar o cancelar el servicio por motivos de seguridad, uso indebido o cuando exista una causa razonable.</li><li>EL AFILIADO,con la suscripción del presente contrato, acepta la política de tratamiento de datos de <strong>SPINNING CENTER GYM</strong>, contenida en el Aviso de Privacidad que se encuentra en<a href=\"https://www.spinningcentergym.com/ayuda/politica-privacidad/\"> https://www.spinningcentergym.com/ayuda/politica-privacidad/.</a> En ese sentido, declara ser informado que:<ol><li>(l) El responsable, actuara en los términos de la Ley de protección de Datos como el responsable del tratamiento de sus datos.</li><li>(ll) <strong>SPINNING CENTER GYM </strong>ha puesto a su disposición la línea de atención al cliente (+57 1 745 0001), el correo electrónico<a href=\"mailto:servicioalcliente@spinningentergym.com\"> servicioalcliente@spinningentergym.com</a> para la atención de requerimientos relacionados con el tratamiento de sus datos personales y el ejercicio de sus derechos como titular de los datos, previstos en la Constitución y la ley, especialmente a conocer, actualizar, rectificar, suprimir la información personal, así como a revocar el consentimiento cuando en el Tratamiento no se respeten los derechos y garantías constitucionales y legales de la materia. Teniendo en cuenta lo anterior, EL AFILIADO autoriza de manera voluntaria, previa, explícita, informada e inequívoca a El responsable y a quien le sean cedidos sus derechos, para tratar sus datos personales.</li></ol></li></ol><p><strong>AUTORIZACIÓN DE RECAUDO.</strong></p><p>Por medio del presente documento y como titular de la TARJETA DE CRÉDITO, <strong>EL AFILIADO </strong>otorga incondicionalmente las siguientes autorizaciones por el término de vigencia de este Contrato:</p><ol><li>A <strong>LA ENTIDAD FINANCIERA: </strong>Ante una transacción de pago de la cuota fija mensual, a cargar a la tarjeta de crédito el valor que corresponde a la transacción y a entregar dicho valor a la empresa recaudadora o a <strong>SPINNING CENTER GYM </strong>directamente. Se entiende de acuerdo a lo aquí previsto, que <strong>EL AFILIADO </strong>pacta con la Entidad Financiera una nueva forma de disponer de los recursos disponibles en su tarjeta de crédito.</li><li>A <strong>SPINNING CENTER GYM </strong>o a quien este designe, para:<ol><li>Consultar, en cualquier tiempo y en cualquier central de información de riesgo legalmente autorizada, toda la información relevante de <strong>EL AFILIADO </strong>para conocer su desempeño como deudor.</li><li>A Reportar a cualquier central de información de riesgo legalmente autorizada, datos, tanto sobre el cumplimiento oportuno como sobre el incumplimiento, si lo hubiere, de las obligaciones de <strong>EL AFILIADO </strong>con <strong>SPINNING CENTER GYM</strong>, de tal forma que estas presenten una información veraz, pertinente, completa, actualizada y exacta del desempeño de <strong>EL AFILIADO </strong>como deudor, después de haber cruzado y procesado diversos datos útiles para obtener una información significativa. Esta autorización subsiste hasta tanto <strong>EL AFILIADO </strong>este a paz y salvo con <strong>SPINNING CENTER GYM </strong>por todo concepto, independientemente de que se dé por terminado el presente Contrato. La autorización anterior no impide el ejercicio del derecho que le asiste a <strong>EL AFILIADO </strong>a que la información suministrada por <strong>SPINNING CENTER GYM </strong>sea veraz, completa, exacta y actualizada, y en caso de que no lo sea, a que sea rectificada y a que se informe sobre las correcciones efectuadas.</li></ol></li><li>A <strong>LA EMPRESA RECAUDADORA: </strong>para conservar el presente documento en su sede y suministrar el original o copia del mismo a la entidad financiera en los casos que así se requiera, a efectos de solucionar una posible reclamación. A enviar la información aquí contenida de manera electrónica a la entidad financiera. Queda entendido que cualquier error de la empresa recaudadora en la conversión electrónica de la autorización de recaudo, es responsabilidad exclusiva de esta y por tanto todas las quejas y reclamos que <strong>EL AFILIADO </strong>realice deberán ser formuladas ante ella.</li><li><strong>EL AFILIADO </strong>como titular de la tarjeta de crédito se obliga y acepta:<ol><li>Mantener fondos suficientes en la tarjeta de crédito indicada para cubrir las Cuotas Mensuales de Afiliación;</li><li>informarse del estado y cupo de su tarjeta de crédito de acuerdo al PLAN, de la efectividad de su pago y de las moras que se puedan presentar a través de los canales y medios establecidos por la Entidad financiera con quien <strong>EL AFILIADO </strong>posee la tarjeta de crédito.</li><li>A Que el cobro y pago de la cuota fija mensual autorizados se lleven a cabo normalmente durante el tiempo y la oportunidad indicada en el presente Contrato. En el evento en que el día del pago no fuere hábil, este se hará el día hábil siguiente.</li><li>A informar inmediatamente a <strong>SPINNING CENTER GYM</strong>, sobre la renovación, reposición, modificación o cambio de la tarjeta de crédito autorizada para los pagos de la cuota fija mensual, para proceder a suscribir un nuevo formato de autorización de recaudo.</li><li>En el evento en que desee cancelar la Autorización de Recaudo, a solicitar dicha cancelación exclusivamente mediante comunicación escrita dirigida a <strong>SPINNING CENTER GYM </strong>en la sede en la que se encuentra afiliado y al correo electrónico: <a href=\"mailto:servicioalcliente@spinningentergym.com\">servicioalcliente@spinningentergym.com.</a></li></ol></li></ol>', '<ul><li>Conocer los conceptos y terminologías fundamental de Big Data Science y ciclo de vida de análisis de Big Data Science</li><li>Identificar, aplicar y evaluar los conceptos tecnológicos para el análisis de Big data</li><li>Conocer las diferentes etapas del ciclo de vida del analisi de Big Data</li><li>Extraer los datos, independientemente de su fuente (webs, csv, logs, apios, etc.) y de su volumen (Big Data o Small Data).</li><li>Desarrollar las diferentes técnicas de análisis de datos</li><li>Procesar los datos usando diferentes métodos de análisis exploratorio y estadísticos.</li></ul>', '<p>Entre las estrategias pedagógicas utilizadas por el docente para impartir la asignatura se encuentran:</p><ul><li><strong>Talleres. </strong>Esta estrategia metodológica fortalece el proceso de enseñanza- aprendizaje;el taller es una actividad práctica que promueve un espacio de reflexión y construcción del conocimiento; estos son previamente diseñados por los docentes con base a las competencias que el estudiante debe desarrollar en cada asignatura y publicados en espacios tales como: web sites, blogs, aula web o aula de clases. Las asignaturas de tipo teórico - práctico usan esta estrategia para promover el trabajo en equipo, consultas y profundización investigativa.</li><li><strong>Mediaciones Virtuales.</strong> El uso y apropiación de las tics se convierten en herramientas claves que son de apoyo al proceso de formación en el aula de clases, debido a que promueven en el estudiante la búsqueda permanente del conocimiento a través de herramientas como: plataformas virtuales- aula web, redes profesionales, sociales, web sites, aplicaciones en la nube, correo electrónico, foros y demás herramientas sincrónicas y sincrónicas que facilitan la interacción.</li><li><strong>Visitas empresariales:</strong> estas acercan al estudiante con aplicaciones y situaciones reales de la ingeniería de sistemas en los diferentes sectores productivos. Asociadas al conocimiento que el estudiante debe tener de su entorno, persiguiendo la construcción de pensamiento crítico y el aprendizaje significativo.</li><li><strong>Proyecto de aula</strong>: esta estrategia corresponde al desarrollo del proyecto guiado por el docente desde el inicio del semestre y donde el estudiante es el actor principal, quien debe identificar problemas del entorno y a través de aplicativos confiables contribuir a la optimización de los procesos.</li></ul>', '<p><strong>Competencias Generales</strong></p><ul><li>Reconoce la importancia del trabajo en equipo, la permanente comunicación e interacción para el logro de las metas propuestas en el contexto.</li><li>Responde con responsabilidad a las actividades asignadas para el logro de los objetivos propuestos en la asignatura.</li><li>Toma decisiones previo análisis de ventajas y desventajas a las que estas pueden conducir y su incidencia en las metas propuestas en el contexto</li></ul><p><strong>Competencias Específicas</strong></p><p>Desarrolla soluciones Big Data adaptadas para la captación, almacenamiento y tratamiento de grandes volúmenes de datos procedentes de diferentes contextos.</p>', '<p><strong>PARCIALES:</strong></p><ul><li><strong>Primer parcial: </strong>30% ( 5% talleres, trabajos, 5% primera entrega del proyecto final y 20% parcial).</li><li><strong>Segundo parcial: </strong>30% ( 5% talleres, trabajos y asistencia, 5% segunda entrega del proyecto final y parcial 20%.</li><li><strong>Tercer parcial: </strong>40% ( 20% Parcial y 20% Trabajo final).</li></ul><p><strong>TRABAJOS:</strong></p><p>Asistencia a clases.</p><p>Ejercicios.</p><p>Exposiciones.</p><p>Talleres.</p>', '<p>Big Data Análisis Grandes Volúmenes de Datos en Organizaciones, Luis Joyane Aguilar, Alfaomega </p><p> </p><p><strong>LIBROS DIGITALES</strong></p><ul><li>[TSK05] Pang-Ning Tan, Michael Steinbach, Vipin Kumar, 2005, Introduction to Data Mining, Addison-Wesley.</li></ul><p><a href=\"http://www-users.cs.umn.edu/~kumar/dmbook/index.php\"><strong>http://www-users.cs.umn.edu/~kumar/dmbook/index.php</strong></a></p><ul><li>[Alp10] Alpaydin, E. 2010 Introduction to Machine Learning, 2nd Ed. The MIT Press</li></ul><p><a href=\"https://www.cmpe.boun.edu.tr/~ethem/i2ml2e/\"><strong>https://www.cmpe.boun.edu.tr/~ethem/i2ml2e/</strong></a></p>', 11, 47, 1, '2020-09-23 03:25:09', '2020-10-28 04:08:24'),
(13, '<h3><strong>Competencias Generales</strong></h3><ul><li>Reconoce la importancia del trabajo en equipo, la permanente comunicación e interacción para el logro de las metas propuestas en el contexto.</li><li>Responde con responsabilidad a las actividades asignadas para el logro de los objetivos propuestos en la asignatura.</li><li>Toma decisiones previo análisis de ventajas y desventajas a las que estas pueden conducir y su incidencia en las metas propuestas en el contexto</li></ul><h3><strong>Competencias Específicas</strong></h3><p>Desarrolla soluciones Big Data adaptadas para la captación, almacenamiento y tratamiento de grandes volúmenes de datos procedentes de diferentes contextos.</p>', '<p>El objetivo fundamental de la asignatura de DATA SCIENCE es que los alumnos aprendan los fundamentos teóricos y los métodos adecuados para saber cómo aplicar las <strong>herramientas analíticas</strong> en diferentes contextos de aplicación.</p>', '<ul><li>Conocer los conceptos y terminologías fundamental de Big Data Science y ciclo de vida de análisis de Big Data Science</li><li>Identificar, aplicar y evaluar los conceptos tecnológicos para el análisis de Big data</li><li>Conocer las diferentes etapas del ciclo de vida del analisi de Big Data</li><li>Extraer los datos, independientemente de su fuente (webs, csv, logs, apios, etc.) y de su volumen (Big Data o Small Data).</li><li>Desarrollar las diferentes técnicas de análisis de datos</li><li>Procesar los datos usando diferentes métodos de análisis exploratorio y estadísticos.</li></ul>', '<p>Entre las estrategias pedagógicas utilizadas por el docente para impartir la asignatura se encuentran:</p><ul><li><strong>Talleres. </strong>Esta estrategia metodológica fortalece el proceso de enseñanza- aprendizaje;el taller es una actividad práctica que promueve un espacio de reflexión y construcción del conocimiento; estos son previamente diseñados por los docentes con base a las competencias que el estudiante debe desarrollar en cada asignatura y publicados en espacios tales como: web sites, blogs, aula web o aula de clases. Las asignaturas de tipo teórico - práctico usan esta estrategia para promover el trabajo en equipo, consultas y profundización investigativa.</li><li><strong>Mediaciones Virtuales.</strong> El uso y apropiación de las tics se convierten en herramientas claves que son de apoyo al proceso de formación en el aula de clases, debido a que promueven en el estudiante la búsqueda permanente del conocimiento a través de herramientas como: plataformas virtuales- aula web, redes profesionales, sociales, web sites, aplicaciones en la nube, correo electrónico, foros y demás herramientas sincrónicas y sincrónicas que facilitan la interacción.</li><li><strong>Visitas empresariales:</strong> estas acercan al estudiante con aplicaciones y situaciones reales de la ingeniería de sistemas en los diferentes sectores productivos. Asociadas al conocimiento que el estudiante debe tener de su entorno, persiguiendo la construcción de pensamiento crítico y el aprendizaje significativo.</li><li><strong>Proyecto de aula</strong>: esta estrategia corresponde al desarrollo del proyecto guiado por el docente desde el inicio del semestre y donde el estudiante es el actor principal, quien debe identificar problemas del entorno y a través de aplicativos confiables contribuir a la optimización de los procesos.</li></ul>', '<p><strong>Competencias Generales</strong></p><ul><li>Reconoce la importancia del trabajo en equipo, la permanente comunicación e interacción para el logro de las metas propuestas en el contexto.</li><li>Responde con responsabilidad a las actividades asignadas para el logro de los objetivos propuestos en la asignatura.</li><li>Toma decisiones previo análisis de ventajas y desventajas a las que estas pueden conducir y su incidencia en las metas propuestas en el contexto</li></ul><p><strong>Competencias Específicas</strong></p><p>Desarrolla soluciones Big Data adaptadas para la captación, almacenamiento y tratamiento de grandes volúmenes de datos procedentes de diferentes contextos.</p>', '<p><strong>PARCIALES:</strong></p><ul><li><strong>Primer parcial: </strong>30% ( 5% talleres, trabajos, 5% primera entrega del proyecto final y 20% parcial).</li><li><strong>Segundo parcial: </strong>30% ( 5% talleres, trabajos y asistencia, 5% segunda entrega del proyecto final y parcial 20%.</li><li><strong>Tercer parcial: </strong>40% ( 20% Parcial y 20% Trabajo final).</li></ul><p><strong>TRABAJOS:</strong></p><p>Asistencia a clases.</p><p>Ejercicios.</p><p>Exposiciones.</p><p>Talleres.</p>', '<p>Big Data Análisis Grandes Volúmenes de Datos en Organizaciones, Luis Joyane Aguilar, Alfaomega</p><p> </p><p><strong>LIBROS DIGITALES</strong></p><ul><li>[TSK05] Pang-Ning Tan, Michael Steinbach, Vipin Kumar, 2005, Introduction to Data Mining, Addison-Wesley.</li></ul><p><a href=\"http://www-users.cs.umn.edu/~kumar/dmbook/index.php\"><strong>http://www-users.cs.umn.edu/~kumar/dmbook/index.php</strong></a></p><ul><li>[Alp10] Alpaydin, E. 2010 Introduction to Machine Learning, 2nd Ed. The MIT Press.</li></ul><p><a href=\"https://www.cmpe.boun.edu.tr/~ethem/i2ml2e/\"><strong>https://www.cmpe.boun.edu.tr/~ethem/i2ml2e/</strong></a></p>', 15, 47, 1, '2020-09-23 05:17:55', '2020-09-27 03:43:02'),
(14, '<p>sdfsadfasdf</p>', '<p>asdfasdf</p>', NULL, NULL, NULL, NULL, NULL, 11, 48, 1, '2020-09-23 05:21:15', '2020-12-03 19:42:45'),
(16, '<h3><strong>Competencias Generales</strong></h3><ul><li>Reconoce la importancia del trabajo en equipo, la permanente comunicación e interacción para el logro de las metas propuestas en el contexto.</li><li>Responde con responsabilidad a las actividades asignadas para el logro de los objetivos propuestos en la asignatura.</li><li>Toma decisiones previo análisis de ventajas y desventajas a las que estas pueden conducir y su incidencia en las metas propuestas en el contexto</li></ul><h3><strong>Competencias Específicas</strong></h3><p>Desarrolla soluciones Big Data adaptadas para la captación, almacenamiento y tratamiento de grandes volúmenes de datos procedentes de diferentes contextos.</p>', '<p>El objetivo fundamental de la asignatura de DATA SCIENCE es que los alumnos aprendan los fundamentos teóricos y los métodos adecuados para saber cómo aplicar las <strong>herramientas analíticas</strong> en diferentes contextos de aplicación.</p>', '<ul><li>Conocer los conceptos y terminologías fundamental de Big Data Science y ciclo de vida de análisis de Big Data Science</li><li>Identificar, aplicar y evaluar los conceptos tecnológicos para el análisis de Big data</li><li>Conocer las diferentes etapas del ciclo de vida del analisi de Big Data</li><li>Extraer los datos, independientemente de su fuente (webs, csv, logs, apios, etc.) y de su volumen (Big Data o Small Data).</li><li>Desarrollar las diferentes técnicas de análisis de datos</li><li>Procesar los datos usando diferentes métodos de análisis exploratorio y estadísticos.</li></ul>', '<p>Entre las estrategias pedagógicas utilizadas por el docente para impartir la asignatura se encuentran:</p><ul><li><strong>Talleres. </strong>Esta estrategia metodológica fortalece el proceso de enseñanza- aprendizaje;el taller es una actividad práctica que promueve un espacio de reflexión y construcción del conocimiento; estos son previamente diseñados por los docentes con base a las competencias que el estudiante debe desarrollar en cada asignatura y publicados en espacios tales como: web sites, blogs, aula web o aula de clases. Las asignaturas de tipo teórico - práctico usan esta estrategia para promover el trabajo en equipo, consultas y profundización investigativa.</li><li><strong>Mediaciones Virtuales.</strong> El uso y apropiación de las tics se convierten en herramientas claves que son de apoyo al proceso de formación en el aula de clases, debido a que promueven en el estudiante la búsqueda permanente del conocimiento a través de herramientas como: plataformas virtuales- aula web, redes profesionales, sociales, web sites, aplicaciones en la nube, correo electrónico, foros y demás herramientas sincrónicas y sincrónicas que facilitan la interacción.</li><li><strong>Visitas empresariales:</strong> estas acercan al estudiante con aplicaciones y situaciones reales de la ingeniería de sistemas en los diferentes sectores productivos. Asociadas al conocimiento que el estudiante debe tener de su entorno, persiguiendo la construcción de pensamiento crítico y el aprendizaje significativo.</li><li><strong>Proyecto de aula</strong>: esta estrategia corresponde al desarrollo del proyecto guiado por el docente desde el inicio del semestre y donde el estudiante es el actor principal, quien debe identificar problemas del entorno y a través de aplicativos confiables contribuir a la optimización de los procesos.</li></ul>', '<p><strong>Competencias Generales</strong></p><ul><li>Reconoce la importancia del trabajo en equipo, la permanente comunicación e interacción para el logro de las metas propuestas en el contexto.</li><li>Responde con responsabilidad a las actividades asignadas para el logro de los objetivos propuestos en la asignatura.</li><li>Toma decisiones previo análisis de ventajas y desventajas a las que estas pueden conducir y su incidencia en las metas propuestas en el contexto</li></ul><p><strong>Competencias Específicas</strong></p><p>Desarrolla soluciones Big Data adaptadas para la captación, almacenamiento y tratamiento de grandes volúmenes de datos procedentes de diferentes contextos.</p>', '<p><strong>PARCIALES:</strong></p><ul><li><strong>Primer parcial: </strong>30% ( 5% talleres, trabajos, 5% primera entrega del proyecto final y 20% parcial).</li><li><strong>Segundo parcial: </strong>30% ( 5% talleres, trabajos y asistencia, 5% segunda entrega del proyecto final y parcial 20%.</li><li><strong>Tercer parcial: </strong>40% ( 20% Parcial y 20% Trabajo final).</li></ul><p><strong>TRABAJOS:</strong></p><p>Asistencia a clases.</p><p>Ejercicios.</p><p>Exposiciones.</p><p>Talleres.</p>', '<p>Big Data Análisis Grandes Volúmenes de Datos en Organizaciones, Luis Joyane Aguilar, Alfaomega</p><p> </p><p><strong>LIBROS DIGITALES</strong></p><ul><li>[TSK05] Pang-Ning Tan, Michael Steinbach, Vipin Kumar, 2005, Introduction to Data Mining, Addison-Wesley.</li></ul><p><a href=\"http://www-users.cs.umn.edu/~kumar/dmbook/index.php\"><strong>http://www-users.cs.umn.edu/~kumar/dmbook/index.php</strong></a></p><ul><li>[Alp10] Alpaydin, E. 2010 Introduction to Machine Learning, 2nd Ed. The MIT Press.</li></ul><p><a href=\"https://www.cmpe.boun.edu.tr/~ethem/i2ml2e/\"><strong>https://www.cmpe.boun.edu.tr/~ethem/i2ml2e/</strong></a></p>', 16, 47, 1, '2020-09-27 03:52:05', '2020-09-27 03:52:05'),
(17, '<p>sdfsadfasdf</p>', '<p>asdfasdf</p>', NULL, NULL, NULL, NULL, NULL, 12, 48, 1, '2020-12-03 19:43:14', '2020-12-03 19:43:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_asignatura_detalle`
--

CREATE TABLE `plan_asignatura_detalle` (
  `id_plan_asignatura_detalle` int(11) NOT NULL,
  `id_plan_asignatura` int(11) NOT NULL,
  `id_dominio_tipo` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plan_asignatura_detalle`
--

INSERT INTO `plan_asignatura_detalle` (`id_plan_asignatura_detalle`, `id_plan_asignatura`, `id_dominio_tipo`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(6, 7, 27, 'Ser los mejores este año siempre', 1, '2020-09-17 01:33:58', '2020-09-17 02:29:34'),
(7, 7, 30, 'Test unitarios', 1, '2020-09-17 02:30:04', '2020-09-17 02:30:04'),
(8, 7, 30, 'Pruebas examenes de forma aleatoria', 1, '2020-09-21 02:06:45', '2020-09-21 02:06:45'),
(24, 7, 29, 'Ser los number one', 1, '2020-09-23 03:24:21', '2020-09-23 03:24:21'),
(37, 7, 30, 'Examenes virtuales', 1, '2020-09-23 04:28:23', '2020-09-23 04:28:23'),
(38, 11, 27, 'Ser los mejores este año siempre', 1, '2020-09-23 04:48:01', '2020-09-23 04:48:01'),
(39, 11, 30, 'Test unitarios', 1, '2020-09-23 04:48:01', '2020-09-23 04:48:01'),
(40, 11, 30, 'Pruebas examenes de forma aleatoria', 1, '2020-09-23 04:48:01', '2020-09-23 04:48:01'),
(41, 11, 29, 'Ser los number one', 1, '2020-09-23 04:48:01', '2020-09-23 04:48:01'),
(42, 11, 30, 'Examenes virtuales', 1, '2020-09-23 04:48:01', '2020-09-23 04:48:01'),
(48, 7, 30, 'ultimito', 1, '2020-09-23 05:17:44', '2020-09-23 05:17:44'),
(55, 13, 27, 'Ser los mejores este año siempre', 1, '2020-09-23 05:19:54', '2020-09-23 05:19:54'),
(56, 13, 30, 'Test unitarios', 1, '2020-09-23 05:19:54', '2020-09-23 05:19:54'),
(57, 13, 30, 'Pruebas examenes de forma aleatoria', 1, '2020-09-23 05:19:54', '2020-09-23 05:19:54'),
(58, 13, 29, 'Ser los number one', 1, '2020-09-23 05:19:54', '2020-09-23 05:19:54'),
(59, 13, 30, 'Examenes virtuales', 1, '2020-09-23 05:19:54', '2020-09-23 05:19:54'),
(60, 14, 27, 'asdfasdsssssssssssssssssssssssssssss', 1, '2020-09-23 05:21:15', '2020-09-23 05:21:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_asignatura_eje_tematico`
--

CREATE TABLE `plan_asignatura_eje_tematico` (
  `id_plan_asignatura_eje_tematico` int(11) NOT NULL,
  `id_plan_asignatura` int(11) NOT NULL,
  `id_plan_asignatura_unidad` int(11) NOT NULL,
  `id_eje_tematico` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plan_asignatura_eje_tematico`
--

INSERT INTO `plan_asignatura_eje_tematico` (`id_plan_asignatura_eje_tematico`, `id_plan_asignatura`, `id_plan_asignatura_unidad`, `id_eje_tematico`, `estado`, `created_at`, `updated_at`) VALUES
(115, 13, 62, 1572, 1, '2020-09-27 03:43:02', '2020-09-27 03:43:02'),
(116, 13, 62, 1573, 1, '2020-09-27 03:43:02', '2020-09-27 03:43:02'),
(117, 16, 63, 1572, 1, '2020-09-27 03:52:05', '2020-09-27 03:52:05'),
(118, 16, 63, 1573, 1, '2020-09-27 03:52:05', '2020-09-27 03:52:05'),
(129, 7, 68, 1572, 1, '2020-10-21 21:19:10', '2020-10-21 21:19:10'),
(130, 7, 68, 1573, 1, '2020-10-21 21:19:10', '2020-10-21 21:19:10'),
(131, 7, 68, 1575, 1, '2020-10-21 21:19:10', '2020-10-21 21:19:10'),
(132, 7, 69, 1576, 1, '2020-10-21 21:19:10', '2020-10-21 21:19:10'),
(133, 7, 69, 1577, 1, '2020-10-21 21:19:10', '2020-10-21 21:19:10'),
(134, 7, 70, 1578, 1, '2020-10-21 21:19:10', '2020-10-21 21:19:10'),
(135, 7, 70, 1579, 1, '2020-10-21 21:19:10', '2020-10-21 21:19:10'),
(157, 11, 80, 1572, 1, '2020-10-28 04:08:24', '2020-10-28 04:08:24'),
(158, 11, 80, 1573, 1, '2020-10-28 04:08:24', '2020-10-28 04:08:24'),
(159, 11, 80, 1575, 1, '2020-10-28 04:08:24', '2020-10-28 04:08:24'),
(160, 11, 81, 1576, 1, '2020-10-28 04:08:24', '2020-10-28 04:08:24'),
(161, 11, 81, 1577, 1, '2020-10-28 04:08:25', '2020-10-28 04:08:25'),
(162, 11, 82, 1578, 1, '2020-10-28 04:08:25', '2020-10-28 04:08:25'),
(163, 11, 82, 1579, 1, '2020-10-28 04:08:25', '2020-10-28 04:08:25'),
(164, 14, 83, 1574, 1, '2020-12-03 19:42:46', '2020-12-03 19:42:46'),
(165, 14, 83, 1580, 1, '2020-12-03 19:42:46', '2020-12-03 19:42:46'),
(166, 17, 84, 1574, 1, '2020-12-03 19:43:15', '2020-12-03 19:43:15'),
(167, 17, 84, 1580, 1, '2020-12-03 19:43:15', '2020-12-03 19:43:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_asignatura_unidad`
--

CREATE TABLE `plan_asignatura_unidad` (
  `id_plan_asignatura_unidad` int(11) NOT NULL,
  `id_plan_asignatura` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `resultados_aprendizaje` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `horas_hdd` int(11) NOT NULL DEFAULT 0,
  `horas_htp` int(11) NOT NULL DEFAULT 0,
  `horas_hti` int(11) NOT NULL DEFAULT 0,
  `horas_htt` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plan_asignatura_unidad`
--

INSERT INTO `plan_asignatura_unidad` (`id_plan_asignatura_unidad`, `id_plan_asignatura`, `id_unidad`, `resultados_aprendizaje`, `horas_hdd`, `horas_htp`, `horas_hti`, `horas_htt`, `estado`, `created_at`, `updated_at`) VALUES
(62, 13, 295, 'weqwreqweerwer', 3, 2, 22, 34, 1, '2020-09-27 03:43:02', '2020-09-27 03:43:02'),
(63, 16, 295, 'weqwreqweerwer', 3, 2, 22, 34, 1, '2020-09-27 03:52:05', '2020-09-27 03:52:05'),
(68, 7, 295, 'weqwreqweerwer', 3, 2, 22, 34, 1, '2020-10-21 21:19:10', '2020-10-21 21:19:10'),
(69, 7, 297, 'Que aprendan', 2, 2, 2, 2, 1, '2020-10-21 21:19:10', '2020-10-21 21:19:10'),
(70, 7, 298, 'Que aprendan', 2, 2, 2, 2, 1, '2020-10-21 21:19:10', '2020-10-21 21:19:10'),
(80, 11, 295, 'weqwreqweerwer', 3, 2, 22, 34, 1, '2020-10-28 04:08:24', '2020-10-28 04:08:24'),
(81, 11, 297, 'Que aprendan', 2, 2, 2, 2, 1, '2020-10-28 04:08:24', '2020-10-28 04:08:24'),
(82, 11, 298, 'Que aprendan', 2, 2, 2, 2, 1, '2020-10-28 04:08:25', '2020-10-28 04:08:25'),
(83, 14, 296, 'se me sdcx', 3, 2, 1, 7, 1, '2020-12-03 19:42:45', '2020-12-03 19:42:45'),
(84, 17, 296, 'se me sdcx', 3, 2, 1, 7, 1, '2020-12-03 19:43:15', '2020-12-03 19:43:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_desarrollo_asignatura`
--

CREATE TABLE `plan_desarrollo_asignatura` (
  `id_plan_desarrollo_asignatura` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_periodo_academico` int(11) NOT NULL,
  `codigo_acceso` text DEFAULT NULL,
  `estado` text NOT NULL DEFAULT 'Enviado',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plan_desarrollo_asignatura`
--

INSERT INTO `plan_desarrollo_asignatura` (`id_plan_desarrollo_asignatura`, `id_tercero`, `id_asignatura`, `id_periodo_academico`, `codigo_acceso`, `estado`, `created_at`, `updated_at`) VALUES
(15, 75, 47, 11, NULL, 'Recibido', '2020-10-15 04:27:09', '2020-10-20 23:51:09'),
(22, 75, 47, 12, NULL, 'Enviado', '2020-10-21 21:15:51', '2020-11-03 23:04:22'),
(23, 75, 47, 15, NULL, 'Recibido', '2020-10-21 23:21:25', '2020-10-30 17:37:50'),
(24, 75, 48, 12, NULL, 'Enviado', '2020-12-03 19:57:40', '2020-12-03 19:57:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_desarrollo_asignatura_detalle`
--

CREATE TABLE `plan_desarrollo_asignatura_detalle` (
  `id_plan_desarrollo_asignatura_detalle` int(11) NOT NULL,
  `id_plan_desarrollo_asignatura` int(11) NOT NULL,
  `semana` int(11) NOT NULL,
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `titulo_semana_parciales` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `temas_trabajo_independiente` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estrategias_metodologicas` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `competencias` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `evaluacion_academica` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `bibliografia` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `is_semana_parciales` tinyint(1) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plan_desarrollo_asignatura_detalle`
--

INSERT INTO `plan_desarrollo_asignatura_detalle` (`id_plan_desarrollo_asignatura_detalle`, `id_plan_desarrollo_asignatura`, `semana`, `fecha_inicio`, `fecha_fin`, `titulo_semana_parciales`, `temas_trabajo_independiente`, `estrategias_metodologicas`, `competencias`, `evaluacion_academica`, `bibliografia`, `is_semana_parciales`, `estado`, `created_at`, `updated_at`) VALUES
(22, 15, 1, '2020-02-17 05:00:00', '2020-02-23 05:00:00', '<p>hdfg</p>', '<h2><strong>EL MEJOR PA</strong></h2>', '<p>asdas</p>', '<p>assa</p>', '<p>asda</p>', '<p>asdsa</p>', 0, 1, '2020-10-20 16:41:16', '2020-10-20 16:41:16'),
(23, 15, 2, '2020-02-25 05:00:00', '2020-03-01 05:00:00', '<h2><strong>PARCIAL 1</strong></h2>', NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-10-20 16:41:16', '2020-10-20 16:41:16'),
(34, 23, 1, '2021-07-30 05:00:00', '2021-08-04 05:00:00', '<p>hdfg</p>', '<h2><strong>EL MEJOR PA</strong></h2>', '<p>asdas</p>', '<p>assa</p>', '<p>asda</p>', '<p>asdsa</p>', 0, 1, '2020-10-21 23:21:25', '2020-10-21 23:21:25'),
(35, 23, 2, '2021-08-06 05:00:00', '2021-08-11 05:00:00', '<h2><strong>PARCIAL 1</strong></h2>', NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-10-21 23:21:26', '2020-10-21 23:21:26'),
(58, 22, 1, '2020-07-12 05:00:00', '2020-07-17 05:00:00', '<p>hdfg</p>', NULL, '<p>asdas</p>', '<p>assa</p>', '<p>asda</p>', '<p>asdsa</p>', 0, 1, '2020-11-03 23:04:23', '2020-11-03 23:04:23'),
(59, 22, 2, '2020-07-19 05:00:00', '2020-07-24 05:00:00', '<h3><strong>Primer parcial </strong></h3>', NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-03 23:04:23', '2020-11-03 23:04:23'),
(63, 24, 1, '2020-07-13 05:00:00', '2020-07-18 05:00:00', NULL, '<p>asdasdasdasdasda</p>', NULL, NULL, NULL, NULL, 0, 1, '2020-12-03 19:57:56', '2020-12-03 19:57:56'),
(64, 24, 2, '2020-07-20 05:00:00', '2020-07-25 05:00:00', NULL, '<p>dddddddddddddddddddddddddddddddddddddddddddddddddd</p>', NULL, NULL, NULL, NULL, 0, 1, '2020-12-03 19:57:56', '2020-12-03 19:57:56'),
(65, 24, 3, '2020-07-27 05:00:00', '2020-08-01 05:00:00', '<p>1ER PARCIAL</p>', NULL, NULL, NULL, NULL, '<p><a href=\"https://www.facebook.com/\">estudio</a></p>', 1, 1, '2020-12-03 19:57:56', '2020-12-03 19:57:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_desarrollo_asignatura_eje_tematico`
--

CREATE TABLE `plan_desarrollo_asignatura_eje_tematico` (
  `id_plan_desarrollo_asignatura_eje_tematico` int(11) NOT NULL,
  `id_plan_desarrollo_asignatura` int(11) NOT NULL,
  `id_plan_desarrollo_asignatura_unidad` int(11) NOT NULL,
  `id_eje_tematico` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plan_desarrollo_asignatura_eje_tematico`
--

INSERT INTO `plan_desarrollo_asignatura_eje_tematico` (`id_plan_desarrollo_asignatura_eje_tematico`, `id_plan_desarrollo_asignatura`, `id_plan_desarrollo_asignatura_unidad`, `id_eje_tematico`, `estado`, `created_at`, `updated_at`) VALUES
(19, 15, 17, 1572, 1, '2020-10-20 16:41:16', '2020-10-20 16:41:16'),
(20, 15, 18, 1576, 1, '2020-10-20 16:41:16', '2020-10-20 16:41:16'),
(31, 23, 29, 1572, 1, '2020-10-21 23:21:26', '2020-10-21 23:21:26'),
(32, 23, 30, 1576, 1, '2020-10-21 23:21:26', '2020-10-21 23:21:26'),
(55, 22, 53, 1572, 1, '2020-11-03 23:04:23', '2020-11-03 23:04:23'),
(56, 22, 54, 1576, 1, '2020-11-03 23:04:23', '2020-11-03 23:04:23'),
(59, 24, 57, 1574, 1, '2020-12-03 19:57:56', '2020-12-03 19:57:56'),
(60, 24, 58, 1580, 1, '2020-12-03 19:57:56', '2020-12-03 19:57:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_desarrollo_asignatura_unidad`
--

CREATE TABLE `plan_desarrollo_asignatura_unidad` (
  `id_plan_desarrollo_asignatura_unidad` int(11) NOT NULL,
  `id_plan_desarrollo_asignatura` int(11) NOT NULL,
  `id_plan_desarrollo_asignatura_detalle` int(11) NOT NULL,
  `id_unidad_asignatura` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plan_desarrollo_asignatura_unidad`
--

INSERT INTO `plan_desarrollo_asignatura_unidad` (`id_plan_desarrollo_asignatura_unidad`, `id_plan_desarrollo_asignatura`, `id_plan_desarrollo_asignatura_detalle`, `id_unidad_asignatura`, `estado`, `created_at`, `updated_at`) VALUES
(17, 15, 22, 295, 1, '2020-10-20 16:41:16', '2020-10-20 16:41:16'),
(18, 15, 22, 297, 1, '2020-10-20 16:41:16', '2020-10-20 16:41:16'),
(29, 23, 34, 295, 1, '2020-10-21 23:21:26', '2020-10-21 23:21:26'),
(30, 23, 34, 297, 1, '2020-10-21 23:21:26', '2020-10-21 23:21:26'),
(53, 22, 58, 295, 1, '2020-11-03 23:04:23', '2020-11-03 23:04:23'),
(54, 22, 58, 297, 1, '2020-11-03 23:04:23', '2020-11-03 23:04:23'),
(57, 24, 63, 296, 1, '2020-12-03 19:57:56', '2020-12-03 19:57:56'),
(58, 24, 64, 296, 1, '2020-12-03 19:57:56', '2020-12-03 19:57:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_trabajo`
--

CREATE TABLE `plan_trabajo` (
  `id_plan_trabajo` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `id_periodo_academico` int(11) NOT NULL,
  `total_asignaturas` int(11) DEFAULT 0,
  `total_grupos` int(11) DEFAULT 0,
  `total_estudiantes` int(11) DEFAULT 0,
  `horas_docencia_directa` int(11) DEFAULT 0,
  `horas_atencion_estudiantes` int(11) DEFAULT 0,
  `horas_preparacion_evaluacion` int(11) DEFAULT 0,
  `horas_dedicadas_actividades` int(11) DEFAULT 0,
  `horas_orientacion_proyectos` int(11) DEFAULT 0,
  `horas_investigacion` int(11) DEFAULT 0,
  `horas_proyeccion_social` int(11) DEFAULT 0,
  `horas_cooperacion` int(11) DEFAULT 0,
  `horas_crecimiento_personal` int(11) DEFAULT 0,
  `horas_actividades_administrativas` int(11) DEFAULT 0,
  `horas_otras_actividades` int(11) DEFAULT 0,
  `horas_actividades_complementarias` int(11) DEFAULT 0,
  `total_horas_semana` int(11) DEFAULT 0,
  `observaciones` text DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Enviado',
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plan_trabajo`
--

INSERT INTO `plan_trabajo` (`id_plan_trabajo`, `id_tercero`, `id_periodo_academico`, `total_asignaturas`, `total_grupos`, `total_estudiantes`, `horas_docencia_directa`, `horas_atencion_estudiantes`, `horas_preparacion_evaluacion`, `horas_dedicadas_actividades`, `horas_orientacion_proyectos`, `horas_investigacion`, `horas_proyeccion_social`, `horas_cooperacion`, `horas_crecimiento_personal`, `horas_actividades_administrativas`, `horas_otras_actividades`, `horas_actividades_complementarias`, `total_horas_semana`, `observaciones`, `estado`, `fecha`, `created_at`, `updated_at`) VALUES
(12, 75, 12, 0, 0, 0, 0, 0, 0, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, 'Recibido', '2020-09-09 06:32:32', '2020-09-09 06:32:32', '2020-10-20 23:20:10'),
(13, 75, 11, 1, 1, 30, 4, 1, 1, 6, NULL, NULL, NULL, 2, NULL, NULL, 2, 4, 0, NULL, 'Recibido', '2020-09-21 23:55:37', '2020-09-21 23:55:37', '2020-10-30 17:41:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plazo_docente`
--

CREATE TABLE `plazo_docente` (
  `id_plazo_docente` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `id_formato` int(11) DEFAULT NULL,
  `id_dominio_tipo_formato` int(11) DEFAULT NULL,
  `id_periodo_academico` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `id_tercero_otorga` int(11) DEFAULT NULL,
  `id_tercero_cancela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plazo_docente`
--

INSERT INTO `plazo_docente` (`id_plazo_docente`, `id_tercero`, `id_formato`, `id_dominio_tipo_formato`, `id_periodo_academico`, `id_asignatura`, `fecha_inicio`, `fecha_fin`, `id_tercero_otorga`, `id_tercero_cancela`, `estado`, `created_at`, `updated_at`) VALUES
(25, 75, NULL, 12, 15, NULL, '2020-10-27 05:00:00', '2020-11-02 04:59:59', 76, 76, 2, '2020-10-29 04:42:45', '2020-10-30 05:47:36'),
(26, 75, 37, 11, NULL, NULL, '2020-10-28 05:00:00', '2020-11-01 04:59:59', 76, 76, 2, '2020-10-29 23:26:49', '2020-10-30 05:29:38'),
(28, 75, NULL, 13, 12, 48, '2020-10-29 05:00:00', '2020-11-06 04:59:59', 76, 76, 2, '2020-10-30 01:45:10', '2020-10-30 15:51:40'),
(30, 75, NULL, 13, 12, 48, '2020-10-29 05:00:00', '2020-11-07 04:59:59', 76, 76, 2, '2020-10-30 15:55:11', '2020-10-30 15:55:51'),
(31, 75, NULL, 12, 15, NULL, '2020-11-11 05:00:00', '2020-11-19 04:59:59', 76, NULL, 1, '2020-11-02 18:37:16', '2020-11-02 18:37:16'),
(32, 75, 14, 14, NULL, NULL, '2020-11-02 05:00:00', '2020-11-12 04:59:59', 76, NULL, 1, '2020-11-02 22:02:14', '2020-11-02 22:50:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id_programa` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `id_facultad` int(11) NOT NULL,
  `id_academusoft` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id_programa`, `nombre`, `id_facultad`, `id_academusoft`, `created_at`, `updated_at`) VALUES
(1, 'Administracion de Empresa', 5, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(2, 'Comercio Internacional', 5, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(3, 'Contaduria Publica', 5, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(4, 'Economia', 5, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(5, 'Derecho', 1, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(6, 'Psicologia', 1, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(7, 'Sociologia', 1, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(8, 'Ingenieria Agroindustrial', 3, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(9, 'Ingenieria Ambiental y Sanitaria', 3, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(10, 'Ingenieria de Sistemas', 3, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(11, 'Ingenieria Electronica', 3, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(12, 'Enfermeria', 4, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(13, 'Instrumentacion Quirurgica', 4, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(14, 'Microbiologia', 4, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(15, 'Licenciatura en educacion fisica, recreacion y deporte', 2, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(16, 'Licenciatura en ciencias Naturales y Educacion Ambiental', 2, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(17, 'Licenciatura en Espanol e Ingles', 2, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(18, 'Licenciatura en Matematicas y Fisica', 2, NULL, '2020-06-02 17:47:56', '2020-06-02 17:47:56'),
(25, 'Deporte y educacion fisica', 13, 123123, '2020-09-01 21:37:55', '2020-09-06 23:28:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_asignatura`
--

CREATE TABLE `seguimiento_asignatura` (
  `id_seguimiento` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `corte` int(1) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `num_creditos` int(11) DEFAULT NULL,
  `num_estudiantes` int(11) DEFAULT NULL,
  `porcentaje_desarrollo` varchar(50) DEFAULT NULL,
  `porcentaje_ideal` varchar(50) DEFAULT NULL,
  `relacion_ideal_real` varchar(50) DEFAULT NULL,
  `prom_notas` double DEFAULT NULL,
  `aprobados` int(3) DEFAULT NULL,
  `reprobados` int(3) DEFAULT NULL,
  `num_est_sup_promedio` int(11) DEFAULT NULL,
  `num_est_no_sup_promedio` int(11) DEFAULT NULL,
  `estrategias_didacticas` varchar(300) DEFAULT NULL,
  `estrategias_evaluativas` varchar(300) DEFAULT NULL,
  `estrategias_desa_cont_programatico` varchar(300) DEFAULT NULL,
  `si_porc_efi_critico` varchar(300) DEFAULT NULL,
  `sugerencias` varchar(300) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `estado` varchar(30) NOT NULL DEFAULT 'Pendiente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seguimiento_asignatura`
--

INSERT INTO `seguimiento_asignatura` (`id_seguimiento`, `id_tercero`, `corte`, `id_asignatura`, `id_grupo`, `num_creditos`, `num_estudiantes`, `porcentaje_desarrollo`, `porcentaje_ideal`, `relacion_ideal_real`, `prom_notas`, `aprobados`, `reprobados`, `num_est_sup_promedio`, `num_est_no_sup_promedio`, `estrategias_didacticas`, `estrategias_evaluativas`, `estrategias_desa_cont_programatico`, `si_porc_efi_critico`, `sugerencias`, `fecha`, `estado`, `created_at`, `updated_at`) VALUES
(34, 75, 1, 47, 13, NULL, 30, '100.00%', '100%', '0.00%', 4, 23, 7, 21, 9, 'cualquier cosa', 'una que otra', NULL, 'pegarles', 'renuncio', '2020-09-22 18:01:27', 'Recibido', '2020-09-17 02:50:14', '2020-10-20 17:01:11'),
(35, 75, 2, 47, 13, NULL, 30, '0%', '100%', '100%', 4.5, 29, 1, 28, 2, 'matar al diablo', 'saque 100', NULL, 'cualquier maricada', 'suerte y muerte', '2020-09-22 17:27:12', 'Recibido', '2020-09-17 02:50:14', '2020-10-20 17:01:11'),
(36, 75, 3, 47, 13, NULL, 30, '100.00%', '100%', '0.00%', 4.5, 20, 10, 19, 11, 'jum', 'pacha', NULL, 'no dar clase', 'ninguna', '2020-09-22 18:05:14', 'Recibido', '2020-09-17 02:50:14', '2020-10-30 17:40:09'),
(37, 75, 1, 48, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-20 01:50:02', 'Pendiente', '2020-09-20 01:50:02', '2020-09-20 01:50:02'),
(38, 75, 2, 48, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-20 01:50:02', 'Pendiente', '2020-09-20 01:50:02', '2020-09-20 01:50:02'),
(39, 75, 3, 48, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-20 01:50:02', 'Pendiente', '2020-09-20 01:50:02', '2020-09-20 01:50:02'),
(40, 75, 1, 47, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-29 04:06:24', 'Pendiente', '2020-10-29 04:06:24', '2020-10-29 04:06:24'),
(41, 75, 2, 47, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-29 04:06:24', 'Pendiente', '2020-10-29 04:06:24', '2020-10-29 04:06:24'),
(42, 75, 3, 47, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-29 04:06:24', 'Pendiente', '2020-10-29 04:06:24', '2020-10-29 04:06:24'),
(43, 75, 1, 48, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-29 04:06:25', 'Pendiente', '2020-10-29 04:06:25', '2020-10-29 04:06:25'),
(44, 75, 2, 48, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-29 04:06:25', 'Pendiente', '2020-10-29 04:06:25', '2020-10-29 04:06:25'),
(45, 75, 3, 48, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-29 04:06:25', 'Pendiente', '2020-10-29 04:06:25', '2020-10-29 04:06:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terceros`
--

CREATE TABLE `terceros` (
  `id_tercero` int(11) NOT NULL,
  `cedula` varchar(20) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `apellido` varchar(40) CHARACTER SET utf8 NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `servicio` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `categoria` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `vinculacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `foto` text CHARACTER SET utf8 DEFAULT NULL,
  `id_dominio_tipo_ter` int(11) NOT NULL DEFAULT 3,
  `id_programa` int(11) DEFAULT NULL,
  `firma` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_licencia` int(11) DEFAULT NULL,
  `id_academusoft` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `terceros`
--

INSERT INTO `terceros` (`id_tercero`, `cedula`, `nombre`, `apellido`, `email`, `servicio`, `categoria`, `vinculacion`, `foto`, `id_dominio_tipo_ter`, `id_programa`, `firma`, `id_licencia`, `id_academusoft`, `estado`, `created_at`, `updated_at`) VALUES
(1, '1065713152', 'Eydy ', 'Suarez Brieva', 'ldaponte98@gmail.com', 'Tiempo completo', 'Auxiliar', 'Docente de carrera', 'fitness-logo-5.5.jpg', 3, NULL, '', 1, NULL, 1, '2020-02-09 10:18:55', '2020-08-30 23:44:43'),
(2, '1065843703', 'Luis Daniel ', 'Aponte Daza', 'ldaponte98@gmail.com', 'Tiempo completo', NULL, '', 'angie.jpg', 3, NULL, '', 1, NULL, 1, '2020-02-09 10:18:55', '2020-08-30 23:50:09'),
(3, '123456789', 'Oriana Maria', 'Jurado', 'orianajurado@unicesar.edu.co', 'Tiempo completo', NULL, '', 'dia-del-defensor-del-medio-ambiente.jpg', 3, NULL, '', 1, NULL, 1, '2020-02-09 10:18:55', '2020-04-09 21:02:05'),
(4, '232323', 'Jose Juaquin Ortiz Perez', '', '', '', NULL, '', 'hombre-guapo-caucasico-aislado-pared-beige-dando-gesto-pulgares-arriba_1368-92335.jpg', 2, NULL, '', 1, NULL, 1, '2020-02-09 12:48:36', '2020-08-03 21:34:39'),
(5, '112233445566', 'Alvaro ', 'Oñate Bowen', 'alvarobowen@unicesar.edu.co', 'Planta', 'xxx-xxx', 'Directa vinculacion', NULL, 2, 10, '', 2, NULL, 1, '2020-05-06 02:35:36', '2020-05-06 02:35:36'),
(7, '1065577005', ' LILIANA CAROLINA', 'MOLINA BLANCO', 'lilianamolina@unicesar.edu.co', 'Tiempo completo', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(8, '1065616547', 'MARCO JAVIER', 'PEÃƒâ€˜ALOZA PEREZ ', 'marcopenaloza@unicesar.edu.co', 'Tiempo completo', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(9, '1065640183', ' STEPHANY PATRICIA', 'CALDERON ROYERO', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(11, '12435533', 'ALEXANDER ', 'GARCIA ARIZA ', '', 'Tiempo completo', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(12, '12435767', ' LACIDES ALFONSO', 'BALETA PALOMINO', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(13, '12558987', ' GERMAN ISAAC', 'SOSA MONTENEGRO', '', 'Catedratico', NULL, '', 'FOTO.jpg', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(14, '12712322', ' MIGUEL ANGEL', 'GOMEZ REDONDO', '', 'Planta', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(15, '12720223', 'HUMBERTO', 'BARRIOS ESCOBAR', '', 'Planta', NULL, '', 'hbarrios.png', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(16, '12722861', ' EDGAR ENRIQUE', 'RODRIGUEZ LIZCANO', '', 'Planta', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(17, '12723028', ' SAUL ENRIQUE', 'TRUJILLO OLANO', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(18, '15171663', ' OVIDIO', 'VILLA CELEDON', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(19, '17147978', ' ARISTIDES GUILLERMO', 'LOPEZ TORRES', '', 'Planta', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(20, '17802044', ' ALVARO DE JESUS', 'SOLANO SOLANO', '', 'Planta', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(21, '18777333', 'ENRIQUE CARLOS', 'PEREZ LARA', 'enriqueperez@unicesar.edu.co', 'Tiempo completo', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(22, '18935184', ' JAVIER', 'GOMEZ PEDROZO', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(23, '18936352', 'OMAR ENRIQUE', 'TRUJILLO VARILLA ', '', 'Catedratico', NULL, '', 'fotoomar.jpeg', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(24, '19705448', ' JHONYS ENRIQUE', 'BOLAÃƒâ€˜O OSPINA', '', 'Catedratico', NULL, '', '20181012_124549.jpg', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(25, '20609692', 'MARTINEZ DE AMAYA', 'LUCIA', '', 'Planta', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(26, '49759202', 'LILIANA PATRICIA', 'BARON AMARIS', '', 'Planta', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(27, '49759978', ' AMALFI', 'GALINDO OSPINO', '', 'Planta', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(28, '49767800', ' MERY', 'FAJARDO OLMEDO', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(29, '49795603', 'GLORIA MARIA ', 'LASCANO BERMUDEZ', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(30, '5012584', 'PEDRO JUAN ', 'TORRES FLOREZ', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(31, '5136125', ' EDER HANS', 'FERNANDEZ DE LEÃƒâ€œN', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(32, '70088980', ' ARNALDO DE JESUS', 'PERALTA CASTILLA', '', 'Planta', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(33, '7572564', ' ANDRES FELIPE', 'CARVAJAL ORREGO', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(34, '7591430', ' TEOBALDO', 'GARCIA ROMERO', '', 'Planta', NULL, '', '046TEOVALDO GARCIA 1.jpg', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(35, '77005762', ' JESUS MARIA', 'VALENCIA BUSTAMANTE', '', 'Planta', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(36, '77015264', ' JORGE MARTIN', 'BARROS LAGOS', '', 'Tiempo completo', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(37, '77017176', ' OVIDIO RODOLFO', 'BAQUERO BONILLA', 'ovidiobaquero@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(38, '77018251', ' JOSE MANUEL', 'MEJIA REALES', 'josemejia@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(39, '77019202', ' RAUL ENRIQUE', 'ESCOBAR CARO', 'raulescobar@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(40, '77019401', ' CESAR ALFONSO', 'MANJARREZ PONTON', 'cesarmanjarrez@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(41, '77019804', ' RALFIS RAFAEL', 'CASSIANI SANTANA', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(42, '77022286', '  EDUARD JHON', 'PEREZ OSORIO', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(43, '77022557', ' ALEXCOSISKY ARMANDO', 'CASTILLA ANAYA', '', 'Catedratico', NULL, '', '1553824796750362755041.jpg', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(44, '77023629', ' HEBERT ALBERTO', 'DELGADO MIER', 'hebertdelgado@unicesar.edu.co', 'Catedratico', NULL, '', 'IMG_20190224_094928.jpg', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(45, '77025940', ' DANIEL DAVID', 'MEZA PAYARES', '', 'Tiempo completo', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(46, '77027674', ' MANUEL JULIAN', 'REINA CUADRADO', 'manueljreina@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(47, '77028117', ' JHONNY ANTONIO', 'RIVERA VERGEL', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(48, '77028927', ' SAUL ENRIQUE', 'VIDES GOMEZ', '', 'Medio tiempo', NULL, '', 'FOTO SAUL.jpg', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(49, '77030856', ' ROMELIO JOSE', 'GONZALEZ DAZA', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(50, '77033198', ' JAIRSINIO', 'MENDOZA LOZANO', 'jairsiniomendoza@unicesar.edu.', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(51, '77033448', ' EVER ENRIQUE', 'DE LA HOZ MOLINARES', 'everdelahoz@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(52, '77034925', ' CARLOS GILBERTO', 'HERNANDEZ MARTINEZ', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(53, '77142162', ' FABIO FIDEL', 'FUENTES MEDINA', 'fabiofuentes@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(54, '77157838', ' ISIDORO', 'GORDILLO GALVIS', 'isidorogordillo@unicesar.edu.c', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(55, '77160987', ' ROBERTO LUIS', 'MELENDEZ MURGAS', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(56, '77169158', ' GUSTAVO ADOLFO', 'RODRIGUEZ PONTON', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(57, '77169599', ' RAFAEL AGUSTIN', 'CABAS OÃƒâ€˜ATE', 'rafaelcabas@unicesar.edu.co', 'Tiempo completo', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(58, '77170113', ' ALCIDES SEGUNDO', 'PAEZ SOTO', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(59, '77170928', ' DAVID', 'MORENO RUIZ', 'davidmoreno@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(60, '77172097', ' ERNET GUILLERMO', 'MAESTRE OROZCO', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(61, '77173095', ' JORGE ALFONSO', 'GUTIERREZ SILVA', 'jorgeagutierrez@unicesar.edu.c', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(62, '77173506', ' JOSE HECTOR', 'MAESTRE HERRERA', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(63, '77174894', ' CARLOS', 'MARTINEZ ACUÃƒâ€˜A', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(64, '77177547', ' GUSTAVO ADOLFO', 'AVILA VERGARA', 'gustavoavila@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(65, '77182911', ' RAFAEL ARTURO', 'FRAGOZO RUIZ', '', 'Catedratico', NULL, '', 'RafaelFragozo.jpg', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(66, '77183911', ' CARLOS CARLOS', 'MOSCOTE FUENTES', 'carlosmoscote@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(67, '77184442', 'JADER ENRIQUE', 'ESQUIVEL MOJICA ', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(68, '77185951', ' MARLON DE JESUS', 'RONDON MEZA', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(69, '77188248', 'LUIS ALEXANDER ', 'SARAVIA ROA', 'luissaraviaroa@unicesar.edu.co', 'Catedratico', NULL, '', 'FOTOGRAFIA DE ALEX 4.jpg', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(70, '77194041', 'HAROLD ENRIQUE ', 'RUA MARTINEZ', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(71, '88137392', ' LUIS ENRIQUE', 'ACOSTA CASTAÑEZ', '', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(72, '91426985', ' HAROLD', 'VALLE FUENTES', 'haroldvalle@unicesar.edu.co', 'Catedratico', NULL, '', '0', 3, NULL, '', 1, NULL, 1, '2020-05-06 03:53:25', '2020-05-06 03:53:25'),
(73, '1065789877', 'pedro jose', 'mariano diaz', 'juan@unicesar.edu.co', 'Tiempo completo', 'auxiliar', 'Docente de carrera', NULL, 2, 22, NULL, 3, 1234456, 1, '2020-06-08 17:53:54', '2020-06-08 18:24:31'),
(74, '1065789876', 'angie lorena', 'perez florian', 'angieperez@unicesar.edu.co', 'Tiempo completo', 'auxiliar', 'Docente de carrera', 'american-express.png', 3, 22, NULL, 3, 455, 1, '2020-06-08 21:23:53', '2020-06-08 22:49:14'),
(75, '1065843703', 'Luis Daniel', 'Aponte', 'ldaponte98@gmail.com', 'Tiempo completo', 'auxiliar', 'Docente profesional', 'doctores.gif', 3, 25, NULL, 6, 11110000, 1, '2020-09-01 21:42:59', '2020-10-29 04:25:14'),
(76, '10658402600', 'Ever', 'Aponte', 'elazo@unicesar.edu.co', 'Tiempo completo', 'auxiliar', 'Jefe de carrera', NULL, 2, 25, NULL, 6, 123, 1, '2020-09-01 22:19:00', '2020-09-01 22:19:00'),
(79, '1065843700', 'Juan jose', 'Aponte Daza', 'juanjose@gmail.com', NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 1, '2020-11-04 05:23:53', '2020-11-04 05:23:53'),
(81, '100000011', 'Andres', 'Caceres', 'zoraxunicesar@gmail.com', NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 1, '2020-12-03 20:24:16', '2020-12-03 20:24:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tercero_grupo`
--

CREATE TABLE `tercero_grupo` (
  `id_tercero_grupo` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Activo, 2 = Pendiente, 0 = Rechazado o inactivo.',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tercero_grupo`
--

INSERT INTO `tercero_grupo` (`id_tercero_grupo`, `id_tercero`, `id_grupo`, `estado`, `created_at`, `updated_at`) VALUES
(2, 79, 13, 1, '2020-11-04 05:23:53', '2020-11-04 05:23:53'),
(5, 79, 14, 2, '2020-11-09 23:46:03', '2020-11-09 23:46:03'),
(6, 81, 14, 1, '2020-12-03 20:24:16', '2020-12-03 20:24:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_asignaturas_matematica`
--

CREATE TABLE `tmp_asignaturas_matematica` (
  `cod` varchar(20) NOT NULL,
  `nombre` text NOT NULL,
  `num_creditos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tmp_asignaturas_matematica`
--

INSERT INTO `tmp_asignaturas_matematica` (`cod`, `nombre`, `num_creditos`) VALUES
('MT101', 'Calculo 1', 2),
('MT201C', 'Calculo diferencial e integral', 4),
('MT301A', 'Matematicas Fundamentales', 5),
('MT301B', 'Algebra lineal', 3),
('MT301C', 'Matematicas fundamentales', 3),
('MT302A', 'Logica y conjuntos', 3),
('MT302B', 'Calculo diferencial', 4),
('MT302C', 'Calculo diferencial', 3),
('MT303A', 'Geometria euclidiana', 3),
('MT303B', 'Calculo integral', 3),
('MT303C', 'Calculo integral', 3),
('MT304A', 'Calculo diferencial en una variable', 3),
('MT304B', 'Calculo multivariable', 4),
('MT304C', 'Estadistica descriptiva calculo de probabilidades', 3),
('MT305A', 'Algebra lineal', 3),
('MT305B', 'Ecuaciones diferenciales ordinarias', 3),
('MT305C', 'Estadistica inferencial y muestreo', 3),
('MT305SO', 'Estadistica inferencial y muestreo', 3),
('MT306A', 'Calculo integral en una variable', 3),
('MT306B', 'Funciones especiales y ecuaciones diferencial', 4),
('MT307A', 'Geometria analitica', 3),
('MT307B', 'Estadistica descriptiva e inferencial', 4),
('MT308A', 'Estadistica descriptiva y probabilidades', 3),
('MT308B', 'Diseno experimental', 2),
('MT309A', 'Calculo de varias variables', 5),
('MT309B', 'Analisis numerico', 3),
('MT310A', 'Estadistica inferencial y muestreo  ', 4),
('MT310B', 'Logica conjuntos y grafos', 3),
('MT311A', 'Ecuaciones diferenciales odinarias', 4),
('MT311B', 'Programacion lineal', 3),
('MT312A', 'Teoria de conjuntos', 3),
('MT312B', 'Matematicas fundamental', 4),
('MT313A', 'Analisis matematico', 5),
('MT313B', 'Diseno de agregado', 2),
('MT314A', 'Algebra moderna', 3),
('MT314B', 'Diseno de sondeo', 2),
('MT315A', 'Historia y epistemologia de las matemaicas', 3),
('MT317B', 'Analisis de datos', 2),
('MT319A', 'Didactica de la matematica', 4),
('MT321A', 'Estadistica descriptiva e inferencial', 4),
('MT329B', 'Matematicas fundamental', 4),
('MT501C', 'Algebra lineal', 3),
('PS203', 'Logica matematica', 3),
('PS306', 'Estadistica I', 3),
('PS405', 'Estadistica II', 2),
('UPC 02N', 'Informatica I', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_asignatura`
--

CREATE TABLE `unidad_asignatura` (
  `id_unidad_asignatura` int(11) NOT NULL,
  `nombre` varchar(400) CHARACTER SET utf8 NOT NULL,
  `id_asignatura` varchar(10) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `unidad_asignatura`
--

INSERT INTO `unidad_asignatura` (`id_unidad_asignatura`, `nombre`, `id_asignatura`, `created_at`, `updated_at`) VALUES
(1, 'Tecnicas de muestreo y estimacion de parametros', '24', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(2, 'Elementos de diseno de experimentos', '24', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(3, 'Disenos completamente aleatorios', '24', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(4, 'Disenos en bloques aleatorios', '24', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(5, 'Disenos de cuadro latino', '24', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(6, 'Regresion y correlacion', '24', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(39, 'ESTADISTICA DESCRIPTIVA', '22', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(40, 'INTRODUCCION A LA PROBABILIDAD', '22', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(41, 'VARIABLES ALEATORIAS Y DISTRIBUCIONES', '22', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(42, 'DISTRIBUCIONES ESPECIALES DISCRETAS Y CONTINUAS', '22', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(43, 'DISTRIBUCIONES CONJUNTAS DE PROBABILIDAD', '22', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(44, 'DISTRIBUCIONES MUESTRALES Y EL TEOREMA DEL LIMITE CENTRAL', '22', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(45, 'ESTADISTICA DESCRIPTIVA', '23', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(46, 'INTRODUCCION A LA PROBABILIDAD', '23', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(47, 'VARIABLES ALEATORIAS Y DISTRIBUCIONES', '23', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(48, 'DISTRIBUCIONES ESPECIALES DISCRETAS Y CONTINUAS', '23', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(49, 'DISTRIBUCIONES CONJUNTAS DE PROBABILIDAD', '23', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(50, 'DISTRIBUCIONES MUESTRALES Y EL TEOREMA DEL LIMITE CENTRAL', '23', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(51, 'CALCULO DIFERENCIAL DE FUNCIONES DE VARIAS VARIABLES', '25', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(52, 'INTEGRALES MULTIPLES', '25', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(53, 'FUNCIONES VECTORIALES', '25', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(54, 'CALCULO VECTORIAL', '25', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(68, 'Generalidades', '26', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(69, 'Solucion De Ecuaciones En Una Variable', '26', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(70, 'Sistema De Ecuaciones Lineales Y No Lineales', '26', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(71, 'Interpolacion Polinomial Y Ajuste De Curvas', '26', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(72, 'Diferenciacion E Integracion Â Numerica', '26', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(73, 'Solucion Numerica De Ecuaciones Diferenciales Ordinarias', '26', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(74, 'Distribuciones Muestrales', '27', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(75, 'Estimacion De Parametros ', '27', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(76, 'Estimacion Por Intervalos', '27', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(77, 'Pruebas De Hipotesis', '27', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(78, 'Regresion Y Correlacion', '27', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(79, 'Algebra De Proposiciones E Inferencia Logica', '28', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(81, 'Introduccion A Los Conjuntos', '28', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(82, 'Sistemas De Numeracion', '28', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(83, 'Algebra De Boole', '28', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(84, 'Estructuras Algebraicas Y Teoria De Grafos', '28', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(85, 'Conceptos Fundamentales', '29', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(86, 'Ecuaciones Diferenciales De Primer Orden Y Primer Grado', '29', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(87, 'Ecuaciones Diferenciales De Orden Superior', '29', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(88, 'Transformadas De Laplace', '29', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(89, 'Solucion De Ecuaciones Diferenciales En Serie De Potencias', '29', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(90, 'Solucion De Ecuaciones Diferenciales Simultaneas', '29', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(91, 'Investigacion De Operaciones', '30', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(92, 'Programacion Lineal', '30', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(93, 'Formulacion De Problemas De Maximizacion Y Minimizacion R', '30', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(94, 'Solucion Grafica De La Programacion Lineal ', '30', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(95, 'El Metodo Simplex', '30', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(96, 'Dualidad Y Analisis De Sensibilidad', '30', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(97, 'Problemas Del Transporte Y Asignacion ', '30', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(98, 'Operaciones Sobre Colecciones De Conjuntos', '31', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(99, 'Relaciones Y Funciones', '31', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(100, 'Conjuntos Infinitos', '31', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(101, 'Sistemas Numericos', '32', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(102, 'Medicion', '32', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(103, 'Funciones', '32', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(104, 'Funciones Reales', '32', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(105, 'Sistemas Numericos', '40', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(106, 'Medicion', '40', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(107, 'Funciones', '40', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(108, 'Funciones Reales', '40', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(109, 'El Sistema De Los Numeros Reales', '33', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(110, 'Sucesiones', '33', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(111, 'LiÂ­mites De Funciones', '33', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(112, 'Funciones Continuas', '33', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(114, 'La TopologiÂ­a De R (Espacios Metricos)', '33', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(115, 'Diseno De Agregado Â ', '34', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(117, 'Introduccion A Los Experimentos En Laboratorios', '34', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(118, 'Los Experimentos En Laboratorios', '34', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(119, 'Estudios De Campo ', '34', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(120, 'Manejo De Paquete Spss', '34', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(121, 'Teoria De Numeros', '35', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(122, 'Introduccion A Los Grupos', '35', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(123, 'Grupos', '35', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(124, 'Homomorfismos e Isomorfismos Entre Grupos', '35', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(125, 'Grupo De Permutaciones', '35', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(126, 'Diseno De Sondeo', '36', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(128, 'Introduccion a La Eleccion De La Muestra', '36', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(129, 'Tecnicas De muestreo', '36', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(131, 'Trabajo Investigativo Utilizando El Instrumento De Recoleccion', '36', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(132, 'Estimacion De Parametros', '36', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(133, 'La Entrevista', '36', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(134, 'Generalidades', '37', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(135, 'Geometrias No Euclidianas', '37', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(136, 'Los Infinitesimos y El Analisis', '37', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(137, 'Teoria De Grupo. Las Nuevas Algebras', '37', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(138, 'La Logica Matematica', '37', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(139, 'El Metodo Axiomatico', '37', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(140, 'La TeoriÂ­a De Conjuntos', '37', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(141, 'Analisis De Datos', '38', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(142, 'Medicion Social', '38', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(143, 'Metodos De Analisis De Los Datos ', '38', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(144, 'Metodos De Analisis De Los Datos', '38', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(146, 'Metodos De Analisis De Los Datos Y Manejo Del Programa Excel', '38', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(147, 'Educacion Y PedagogiÂ­a De La Matematica', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(148, 'Pensamiento Matematico ', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(149, 'El Curriculo De Matematica', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(150, 'Aprendizaje Matematico: Caracteristicas Del Razonamiento ', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(151, 'Logica', '42', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(152, 'Iniciacion A Los Conjuntos', '42', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(153, 'Sistemas Numericos', '42', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(154, 'Funciones', '42', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(155, 'La Estadistica', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(156, 'Etapas Del Metodo EstadÃƒistico', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(157, 'Distribucion De Frecuencias', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(158, 'Representacion Grafica Â  Â  Â  ', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(159, 'Medidas De Tendencia Central', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(160, 'Medidas De Posicion (Percentiles)', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(161, 'Medidas De Dispersion', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(162, 'Regresion y Correlacion Lineal', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(163, 'Nociones De Probabilidad (Eventos)      ', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(164, 'Preparacion para el calculo', '1', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(165, 'Li­mites y sus propiedades', '1', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(166, 'Derivacion', '1', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(167, 'Aplicaciones de la derivada', '1', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(168, 'Introduccion al Calculo', '2', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(169, 'Limite y Continuidad', '2', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(170, 'La Derivada', '2', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(171, 'Aplicaciones de la Derivada', '2', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(172, 'La Integral', '2', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(173, 'Otras Tecnicas De Integracion', '2', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(174, 'Aplicaciones  De  La  Integracion  En  Economia, Industria', '2', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(175, 'Ecuaciones Diferenciales', '2', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(176, 'Sucesiones y Series', '2', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(177, 'Relaciones Y Funciones', '3', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(178, 'Funciones Reales', '3', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(179, 'Sistemas Numericos', '3', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(180, 'Vectores', '4', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(181, 'Sistemas De Ecuaciones Lineales Y Matrices', '4', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(182, 'Espacios Vectoriales', '4', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(183, 'Transformaciones Lineales y Matrices', '4', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(184, 'Valores Y Vectores Propios de un Operador Lineal', '4', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(185, 'Logica y Conjuntos', '5', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(186, 'Sistemas Numericos', '5', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(188, 'Funciones', '5', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(189, 'Algebra de Proposiciones', '6', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(190, 'Inferencia Logica', '6', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(191, 'Iniciacion a los Conjuntos', '6', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(192, 'Sistemas de Numeracion', '6', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(193, 'Algebra de Boole', '6', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(194, 'Sucesiones y Limites de Sucesiones', '7', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(195, 'LiÂ­mite y Continuidad de Funciones ', '7', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(196, 'La Derivada ', '7', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(197, 'Aplicaciones de la Derivada', '7', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(199, 'Sucesiones y LiÂ­mites de Sucesiones', '8', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(200, 'Limite y Continuidad de Funciones ', '8', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(201, 'La Derivada ', '8', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(202, 'Aplicaciones de la Derivada', '8', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(203, 'Generalidades', '9', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(204, 'Segmentos y angulos', '9', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(205, 'Triangulos', '9', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(206, 'Paralelismo', '9', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(207, 'Cuadrilateros y PoliÂ­gonos', '9', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(208, 'Circunferencia y Calculo', '9', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(209, 'Proporcionalidad Y Semejanza', '9', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(210, 'Areas de Regiones Planas', '9', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(211, 'GeometriÂ­a del Espacio', '9', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(212, 'Movimientos RiÂ­gidos y Transformaciones', '9', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(213, 'Integracion', '10', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(214, 'Tecnicas de Integracion', '10', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(215, 'Aplicaciones de la Integral Definida', '10', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(216, 'Series  Infinitas', '10', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(217, 'Series Infinitas', '11', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(218, 'La Integral Definida', '11', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(219, 'Metodos de Integracion', '11', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(220, 'Aplicaciones de la Integral', '11', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(221, 'Limites de Funciones', '12', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(222, 'Continuidad', '12', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(223, 'Derivacion', '12', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(225, 'Regla De La Hospital y Formas Indeterminadas', '12', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(226, 'Aplicaciones de la Derivada', '12', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(227, 'Trazado de Curvas', '12', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(228, 'La Diferencial', '12', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(229, 'Funciones de Varias Variables', '13', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(230, 'Diferenciabilidad', '13', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(231, 'Integracion Multiple', '13', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(232, 'Analisis Vectorial', '13', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(233, 'Estadistica Descriptiva', '14', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(234, 'Teoria de Probabilidades', '14', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(235, 'Variables Aleatorias Y Distribuciones', '14', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(236, 'Distribuciones Especiales Discretas y Continuas', '14', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(237, 'Vectores', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(239, 'Sistemas De Ecuaciones Lineales y Matrices', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(240, 'Espacios Vectoriales', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(241, 'Transformaciones Lineales y Matrices', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(242, 'Valores Y Vectores Propios de un Operador Lineal', '46', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(243, 'Conceptos Fundamentales', '16', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(244, 'Ecuaciones Diferenciales De Primer Orden y Primer Grado', '16', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(245, 'Ecuaciones Diferenciales de Orden Superior', '16', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(246, 'Transformadas De Laplace', '16', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(247, 'Solucion De Ecuaciones Diferenciales en Serie de Potencias', '16', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(248, 'Distribuciones Muestrales', '17', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(249, 'Estimacion de Parametros ', '17', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(250, 'Prueba de Hipotesis', '17', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(251, 'Metodos de Muestreo', '17', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(252, 'Regresion y Correlacion', '17', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(253, 'Distribuciones Muestrales', '18', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(254, 'Estimacion de Parametros ', '18', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(255, 'Prueba de Hipotesis', '18', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(256, 'Metodos de Muestreo', '18', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(257, 'Regresion Y Correlacion', '18', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(258, 'Integral Indefinida', '19', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(259, 'Metodos de Integracion ', '19', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(260, 'Integral Definida', '19', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(261, 'Integrales Impropias', '19', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(262, 'Aplicaciones de la Integral Definida', '19', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(263, 'Series Numericas', '19', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(264, 'Funciones Especiales Ordinaria y Propiamente Dichas  	', '20', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(265, 'Polinomios Ortogonales', '20', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(266, 'Funciones De Bessel', '20', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(267, 'Serie E Integrales y Transformada de Fourier', '20', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(268, 'Ecuaciones Diferenciales Parciales', '20', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(269, 'Generalidades', '21', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(270, 'Ecuaciones y Lugares Geometricos', '21', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(271, 'La LiÂ­nea Recta', '21', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(272, 'Secciones Canicas', '21', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(273, 'Transformacion de Coordenadas', '21', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(274, 'Coordenadas Polares', '21', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(275, 'Estadistica Descriptiva', '39', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(276, 'Introduccin a La Probabilidad', '39', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(277, 'Variables Aleatorias y Distribuciones', '39', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(278, 'Distribuciones Especiales Discretas y Continuas', '39', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(279, 'Distribuciones Conjuntas de Probabilidad', '39', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(280, 'Distribuciones Muestrales y el Teorema del Limite Central ', '39', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(281, 'Principio de inferencia estadistica', '43', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(282, 'Estimacion de parametros', '43', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(283, 'Prueba de hipotesis', '43', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(284, ' Pruebas de hipotesis en tablas de contingencia ', '43', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(285, 'Vectores', '41', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(286, 'Sistemas De Ecuaciones Lineales Y Matrices', '4', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(287, 'Sistemas De Ecuaciones Lineales Y Matrices', '41', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(288, 'Espacios Vectoriales', '41', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(289, 'Transformaciones Lineales y Matrices', '41', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(290, 'Valores Y Vectores Propios de un Operador Lineal', '41', '2020-05-06 04:16:28', '2020-05-06 04:16:28'),
(295, 'Introduccion al deporte', '47', '2020-09-17 01:33:58', '2020-10-02 03:55:25'),
(296, 'Intoduccion al deporte agresivo', '48', '2020-09-23 05:21:15', '2020-12-03 19:42:45'),
(297, 'Practicas Basicas del deporte 1', '47', '2020-10-02 03:57:47', '2020-10-02 03:57:47'),
(298, 'Practicas Basicas del deporte 2', '47', '2020-10-02 03:57:48', '2020-10-02 03:57:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_asignatura_seguimiento`
--

CREATE TABLE `unidad_asignatura_seguimiento` (
  `id_unidad_asignatura_seguimiento` int(11) NOT NULL,
  `id_seguimiento_asignatura` int(11) NOT NULL,
  `id_unidad_asignatura` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `usuario` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `clave` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Cuentas de los docentes';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_tercero`, `usuario`, `clave`, `id_perfil`, `created_at`, `updated_at`) VALUES
(3, 4, 'administrador', '6df5fe62dbc16647e104b9acec6db36a', 1, '2020-02-09 10:13:42', '2020-02-09 10:13:44'),
(11, 75, 'ldaponte98@gmail.com', '6df5fe62dbc16647e104b9acec6db36a', 2, '2020-09-01 21:42:59', '2020-10-29 04:25:14'),
(12, 76, 'ever', '6df5fe62dbc16647e104b9acec6db36a', 1, '2020-09-01 22:19:00', '2020-09-01 22:19:00'),
(15, 79, 'juanjose@gmail.com', 'f5737d25829e95b9c234b7fa06af8736', 3, '2020-11-04 05:23:53', '2020-11-04 05:23:53'),
(16, 81, 'zoraxunicesar@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, '2020-12-03 20:24:16', '2020-12-03 20:24:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades_complementarias`
--
ALTER TABLE `actividades_complementarias`
  ADD PRIMARY KEY (`id_actividad_complementaria`);

--
-- Indices de la tabla `actividades_complementarias_detalle`
--
ALTER TABLE `actividades_complementarias_detalle`
  ADD PRIMARY KEY (`id_actividad_complementaria_detalle`);

--
-- Indices de la tabla `actividades_plan_trabajo`
--
ALTER TABLE `actividades_plan_trabajo`
  ADD PRIMARY KEY (`id_actividad_plan_trabajo`);

--
-- Indices de la tabla `analisis_cualitativo_seguimiento`
--
ALTER TABLE `analisis_cualitativo_seguimiento`
  ADD PRIMARY KEY (`id_analisis_cualitativo_seguimiento`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asignatura`);

--
-- Indices de la tabla `asignatura_programa`
--
ALTER TABLE `asignatura_programa`
  ADD PRIMARY KEY (`id_asignatura_programa`);

--
-- Indices de la tabla `causa_seguimiento`
--
ALTER TABLE `causa_seguimiento`
  ADD PRIMARY KEY (`id_causa_seguimiento`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id_clase`),
  ADD KEY `fk_clases_grupo` (`id_grupo`);

--
-- Indices de la tabla `clase_asistencia`
--
ALTER TABLE `clase_asistencia`
  ADD PRIMARY KEY (`id_clase_asistencia`),
  ADD KEY `fk_clase_asistencia_clase` (`id_clase`),
  ADD KEY `fk_clase_asistencia_tercero` (`id_tercero`);

--
-- Indices de la tabla `clase_detalle`
--
ALTER TABLE `clase_detalle`
  ADD PRIMARY KEY (`id_clase_detalle`),
  ADD KEY `fk_clase_detalle_clase` (`id_clase`),
  ADD KEY `fk_clase_detalle_eje_tematico` (`id_eje_tematico`);

--
-- Indices de la tabla `codigo_acceso`
--
ALTER TABLE `codigo_acceso`
  ADD PRIMARY KEY (`id_codigo_acceso`),
  ADD KEY `fk_codigo_acceso_grupo` (`id_grupo`),
  ADD KEY `fk_codigo_acceso_plan_desarrollo` (`id_plan_desarrollo_asignatura`),
  ADD KEY `fk_codigo_acceso_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `dominio`
--
ALTER TABLE `dominio`
  ADD PRIMARY KEY (`id_dominio`);

--
-- Indices de la tabla `eje_tematico`
--
ALTER TABLE `eje_tematico`
  ADD PRIMARY KEY (`id_eje_tematico`);

--
-- Indices de la tabla `eje_tematico_seguimiento`
--
ALTER TABLE `eje_tematico_seguimiento`
  ADD PRIMARY KEY (`id_eje_tematico_seguimiento`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`id_facultad`);

--
-- Indices de la tabla `fechas_entrega`
--
ALTER TABLE `fechas_entrega`
  ADD PRIMARY KEY (`id_fecha_entrega`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `fk_id_tercero_grupo` (`id_tercero`),
  ADD KEY `fk_id_asignatura_grupo` (`id_asignatura`),
  ADD KEY `fk_id_periodo_academico_grupo` (`id_periodo_academico`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `horario_detalle`
--
ALTER TABLE `horario_detalle`
  ADD PRIMARY KEY (`id_horario_detalle`),
  ADD KEY `fk_id_dominio_tipo_evento` (`id_dominio_tipo_evento`);

--
-- Indices de la tabla `int_fac_asi`
--
ALTER TABLE `int_fac_asi`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`id_licencia`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `periodo_academico`
--
ALTER TABLE `periodo_academico`
  ADD PRIMARY KEY (`id_periodo_academico`);

--
-- Indices de la tabla `plan_asignatura`
--
ALTER TABLE `plan_asignatura`
  ADD PRIMARY KEY (`id_plan_asignatura`),
  ADD KEY `fk_plan_asignatura_asignatura` (`id_asignatura`),
  ADD KEY `fk_plan_asignatura_periodo_academico` (`id_periodo_academico`);

--
-- Indices de la tabla `plan_asignatura_detalle`
--
ALTER TABLE `plan_asignatura_detalle`
  ADD PRIMARY KEY (`id_plan_asignatura_detalle`),
  ADD KEY `fk_plan_asignatura_detalle_plan_asignatura` (`id_plan_asignatura`),
  ADD KEY `fk_plan_asignatura_detalle_dominio_tipo` (`id_dominio_tipo`);

--
-- Indices de la tabla `plan_asignatura_eje_tematico`
--
ALTER TABLE `plan_asignatura_eje_tematico`
  ADD PRIMARY KEY (`id_plan_asignatura_eje_tematico`),
  ADD KEY `fk_plan_asignatura_eje_tematico_eje` (`id_eje_tematico`),
  ADD KEY `fk_plan_asignatura_eje_tematico_plan_asignatura` (`id_plan_asignatura`),
  ADD KEY `fk_plan_asig_eje_unidad` (`id_plan_asignatura_unidad`);

--
-- Indices de la tabla `plan_asignatura_unidad`
--
ALTER TABLE `plan_asignatura_unidad`
  ADD PRIMARY KEY (`id_plan_asignatura_unidad`),
  ADD KEY `fk_plan_asignatura_unidad_unidad` (`id_unidad`),
  ADD KEY `fk_plan_asignatura_unidad_plan_asignatura` (`id_plan_asignatura`);

--
-- Indices de la tabla `plan_desarrollo_asignatura`
--
ALTER TABLE `plan_desarrollo_asignatura`
  ADD PRIMARY KEY (`id_plan_desarrollo_asignatura`),
  ADD KEY `fk_tercero_plan_desarrollo_asignatura` (`id_tercero`),
  ADD KEY `fk_asignatura_plan_desarrollo_asignatura` (`id_asignatura`),
  ADD KEY `fk_periodo_academico_plan_desarrollo_asignatura` (`id_periodo_academico`);

--
-- Indices de la tabla `plan_desarrollo_asignatura_detalle`
--
ALTER TABLE `plan_desarrollo_asignatura_detalle`
  ADD PRIMARY KEY (`id_plan_desarrollo_asignatura_detalle`),
  ADD KEY `fk_plan_desarrollo_asignatura_detalle_plan_desarrollo` (`id_plan_desarrollo_asignatura`);

--
-- Indices de la tabla `plan_desarrollo_asignatura_eje_tematico`
--
ALTER TABLE `plan_desarrollo_asignatura_eje_tematico`
  ADD PRIMARY KEY (`id_plan_desarrollo_asignatura_eje_tematico`),
  ADD KEY `fk_plan_desarrollo_asignatura_eje_plan_desarrollo_unidad` (`id_plan_desarrollo_asignatura_unidad`),
  ADD KEY `fk_plan_desarrollo_asignatura_eje_eje` (`id_eje_tematico`),
  ADD KEY `fk_plan_desarrollo_asignaruta_plan_desarrollo_eje` (`id_plan_desarrollo_asignatura`);

--
-- Indices de la tabla `plan_desarrollo_asignatura_unidad`
--
ALTER TABLE `plan_desarrollo_asignatura_unidad`
  ADD PRIMARY KEY (`id_plan_desarrollo_asignatura_unidad`),
  ADD KEY `fk_plan_desarrollo_asignatura_unidad_plan_desarrollo_detalle` (`id_plan_desarrollo_asignatura_detalle`),
  ADD KEY `fk_plan_desarrollo_asignatura_unidad_unidad` (`id_unidad_asignatura`),
  ADD KEY `fk_plan_desarrollo_asignaruta_plan_desarrollo_unidad` (`id_plan_desarrollo_asignatura`);

--
-- Indices de la tabla `plan_trabajo`
--
ALTER TABLE `plan_trabajo`
  ADD PRIMARY KEY (`id_plan_trabajo`);

--
-- Indices de la tabla `plazo_docente`
--
ALTER TABLE `plazo_docente`
  ADD PRIMARY KEY (`id_plazo_docente`),
  ADD KEY `fk_plazo_docente_dominio_tipo` (`id_dominio_tipo_formato`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id_programa`);

--
-- Indices de la tabla `seguimiento_asignatura`
--
ALTER TABLE `seguimiento_asignatura`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD KEY `fk_seguimiento_grupo` (`id_grupo`),
  ADD KEY `fk_seguimiento_tercero` (`id_tercero`),
  ADD KEY `fk_seguimiento_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `terceros`
--
ALTER TABLE `terceros`
  ADD PRIMARY KEY (`id_tercero`),
  ADD KEY `fk_tipo_tercero_dominio` (`id_dominio_tipo_ter`);

--
-- Indices de la tabla `tercero_grupo`
--
ALTER TABLE `tercero_grupo`
  ADD PRIMARY KEY (`id_tercero_grupo`),
  ADD KEY `fk_id_tercero_tercero_grupo` (`id_tercero`),
  ADD KEY `fk_id_grupo_tercero_grupo` (`id_grupo`);

--
-- Indices de la tabla `unidad_asignatura`
--
ALTER TABLE `unidad_asignatura`
  ADD PRIMARY KEY (`id_unidad_asignatura`);

--
-- Indices de la tabla `unidad_asignatura_seguimiento`
--
ALTER TABLE `unidad_asignatura_seguimiento`
  ADD PRIMARY KEY (`id_unidad_asignatura_seguimiento`),
  ADD KEY `fk_unidad_seguimiento` (`id_seguimiento_asignatura`),
  ADD KEY `fk_unidad_unidad` (`id_unidad_asignatura`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_tercero` (`id_tercero`),
  ADD KEY `fk_usuario_perfil` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades_complementarias`
--
ALTER TABLE `actividades_complementarias`
  MODIFY `id_actividad_complementaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `actividades_complementarias_detalle`
--
ALTER TABLE `actividades_complementarias_detalle`
  MODIFY `id_actividad_complementaria_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `actividades_plan_trabajo`
--
ALTER TABLE `actividades_plan_trabajo`
  MODIFY `id_actividad_plan_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `analisis_cualitativo_seguimiento`
--
ALTER TABLE `analisis_cualitativo_seguimiento`
  MODIFY `id_analisis_cualitativo_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `asignatura_programa`
--
ALTER TABLE `asignatura_programa`
  MODIFY `id_asignatura_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `causa_seguimiento`
--
ALTER TABLE `causa_seguimiento`
  MODIFY `id_causa_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clase_asistencia`
--
ALTER TABLE `clase_asistencia`
  MODIFY `id_clase_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clase_detalle`
--
ALTER TABLE `clase_detalle`
  MODIFY `id_clase_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigo_acceso`
--
ALTER TABLE `codigo_acceso`
  MODIFY `id_codigo_acceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `id_dominio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `eje_tematico`
--
ALTER TABLE `eje_tematico`
  MODIFY `id_eje_tematico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1581;

--
-- AUTO_INCREMENT de la tabla `eje_tematico_seguimiento`
--
ALTER TABLE `eje_tematico_seguimiento`
  MODIFY `id_eje_tematico_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `id_facultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `fechas_entrega`
--
ALTER TABLE `fechas_entrega`
  MODIFY `id_fecha_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `horario_detalle`
--
ALTER TABLE `horario_detalle`
  MODIFY `id_horario_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT de la tabla `int_fac_asi`
--
ALTER TABLE `int_fac_asi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `id_licencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `periodo_academico`
--
ALTER TABLE `periodo_academico`
  MODIFY `id_periodo_academico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `plan_asignatura`
--
ALTER TABLE `plan_asignatura`
  MODIFY `id_plan_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `plan_asignatura_detalle`
--
ALTER TABLE `plan_asignatura_detalle`
  MODIFY `id_plan_asignatura_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `plan_asignatura_eje_tematico`
--
ALTER TABLE `plan_asignatura_eje_tematico`
  MODIFY `id_plan_asignatura_eje_tematico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT de la tabla `plan_asignatura_unidad`
--
ALTER TABLE `plan_asignatura_unidad`
  MODIFY `id_plan_asignatura_unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `plan_desarrollo_asignatura`
--
ALTER TABLE `plan_desarrollo_asignatura`
  MODIFY `id_plan_desarrollo_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `plan_desarrollo_asignatura_detalle`
--
ALTER TABLE `plan_desarrollo_asignatura_detalle`
  MODIFY `id_plan_desarrollo_asignatura_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `plan_desarrollo_asignatura_eje_tematico`
--
ALTER TABLE `plan_desarrollo_asignatura_eje_tematico`
  MODIFY `id_plan_desarrollo_asignatura_eje_tematico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `plan_desarrollo_asignatura_unidad`
--
ALTER TABLE `plan_desarrollo_asignatura_unidad`
  MODIFY `id_plan_desarrollo_asignatura_unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `plan_trabajo`
--
ALTER TABLE `plan_trabajo`
  MODIFY `id_plan_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `plazo_docente`
--
ALTER TABLE `plazo_docente`
  MODIFY `id_plazo_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `seguimiento_asignatura`
--
ALTER TABLE `seguimiento_asignatura`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `terceros`
--
ALTER TABLE `terceros`
  MODIFY `id_tercero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `tercero_grupo`
--
ALTER TABLE `tercero_grupo`
  MODIFY `id_tercero_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `unidad_asignatura`
--
ALTER TABLE `unidad_asignatura`
  MODIFY `id_unidad_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT de la tabla `unidad_asignatura_seguimiento`
--
ALTER TABLE `unidad_asignatura_seguimiento`
  MODIFY `id_unidad_asignatura_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `fk_clases_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`);

--
-- Filtros para la tabla `clase_asistencia`
--
ALTER TABLE `clase_asistencia`
  ADD CONSTRAINT `fk_clase_asistencia_clase` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`),
  ADD CONSTRAINT `fk_clase_asistencia_tercero` FOREIGN KEY (`id_tercero`) REFERENCES `terceros` (`id_tercero`);

--
-- Filtros para la tabla `clase_detalle`
--
ALTER TABLE `clase_detalle`
  ADD CONSTRAINT `fk_clase_detalle_clase` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`),
  ADD CONSTRAINT `fk_clase_detalle_eje_tematico` FOREIGN KEY (`id_eje_tematico`) REFERENCES `eje_tematico` (`id_eje_tematico`);

--
-- Filtros para la tabla `codigo_acceso`
--
ALTER TABLE `codigo_acceso`
  ADD CONSTRAINT `fk_codigo_acceso_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `fk_codigo_acceso_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `fk_codigo_acceso_plan_desarrollo` FOREIGN KEY (`id_plan_desarrollo_asignatura`) REFERENCES `plan_desarrollo_asignatura` (`id_plan_desarrollo_asignatura`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_id_asignatura_grupo` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `fk_id_periodo_academico_grupo` FOREIGN KEY (`id_periodo_academico`) REFERENCES `periodo_academico` (`id_periodo_academico`),
  ADD CONSTRAINT `fk_id_tercero_grupo` FOREIGN KEY (`id_tercero`) REFERENCES `terceros` (`id_tercero`);

--
-- Filtros para la tabla `horario_detalle`
--
ALTER TABLE `horario_detalle`
  ADD CONSTRAINT `fk_id_dominio_tipo_evento` FOREIGN KEY (`id_dominio_tipo_evento`) REFERENCES `dominio` (`id_dominio`);

--
-- Filtros para la tabla `plan_asignatura`
--
ALTER TABLE `plan_asignatura`
  ADD CONSTRAINT `fk_plan_asignatura_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `fk_plan_asignatura_periodo_academico` FOREIGN KEY (`id_periodo_academico`) REFERENCES `periodo_academico` (`id_periodo_academico`);

--
-- Filtros para la tabla `plan_asignatura_detalle`
--
ALTER TABLE `plan_asignatura_detalle`
  ADD CONSTRAINT `fk_plan_asignatura_detalle_dominio_tipo` FOREIGN KEY (`id_dominio_tipo`) REFERENCES `dominio` (`id_dominio`),
  ADD CONSTRAINT `fk_plan_asignatura_detalle_plan_asignatura` FOREIGN KEY (`id_plan_asignatura`) REFERENCES `plan_asignatura` (`id_plan_asignatura`);

--
-- Filtros para la tabla `plan_asignatura_eje_tematico`
--
ALTER TABLE `plan_asignatura_eje_tematico`
  ADD CONSTRAINT `fk_plan_asig_eje_unidad` FOREIGN KEY (`id_plan_asignatura_unidad`) REFERENCES `plan_asignatura_unidad` (`id_plan_asignatura_unidad`),
  ADD CONSTRAINT `fk_plan_asignatura_eje_tematico_eje` FOREIGN KEY (`id_eje_tematico`) REFERENCES `eje_tematico` (`id_eje_tematico`),
  ADD CONSTRAINT `fk_plan_asignatura_eje_tematico_plan_asignatura` FOREIGN KEY (`id_plan_asignatura`) REFERENCES `plan_asignatura` (`id_plan_asignatura`),
  ADD CONSTRAINT `pk_plan_asignatura_eje_tematico_unidad` FOREIGN KEY (`id_plan_asignatura_unidad`) REFERENCES `plan_asignatura_unidad` (`id_plan_asignatura_unidad`),
  ADD CONSTRAINT `pk_plan_asignatura_eje_unidad` FOREIGN KEY (`id_plan_asignatura_unidad`) REFERENCES `plan_asignatura_unidad` (`id_plan_asignatura_unidad`);

--
-- Filtros para la tabla `plan_asignatura_unidad`
--
ALTER TABLE `plan_asignatura_unidad`
  ADD CONSTRAINT `fk_plan_asignatura_unidad_plan_asignatura` FOREIGN KEY (`id_plan_asignatura`) REFERENCES `plan_asignatura` (`id_plan_asignatura`),
  ADD CONSTRAINT `fk_plan_asignatura_unidad_unidad` FOREIGN KEY (`id_unidad`) REFERENCES `unidad_asignatura` (`id_unidad_asignatura`);

--
-- Filtros para la tabla `plan_desarrollo_asignatura`
--
ALTER TABLE `plan_desarrollo_asignatura`
  ADD CONSTRAINT `fk_asignatura_plan_desarrollo_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `fk_periodo_academico_plan_desarrollo_asignatura` FOREIGN KEY (`id_periodo_academico`) REFERENCES `periodo_academico` (`id_periodo_academico`),
  ADD CONSTRAINT `fk_tercero_plan_desarrollo_asignatura` FOREIGN KEY (`id_tercero`) REFERENCES `terceros` (`id_tercero`);

--
-- Filtros para la tabla `plan_desarrollo_asignatura_detalle`
--
ALTER TABLE `plan_desarrollo_asignatura_detalle`
  ADD CONSTRAINT `fk_plan_desarrollo_asignatura_detalle_plan_desarrollo` FOREIGN KEY (`id_plan_desarrollo_asignatura`) REFERENCES `plan_desarrollo_asignatura` (`id_plan_desarrollo_asignatura`);

--
-- Filtros para la tabla `plan_desarrollo_asignatura_eje_tematico`
--
ALTER TABLE `plan_desarrollo_asignatura_eje_tematico`
  ADD CONSTRAINT `fk_plan_desarrollo_asignaruta_plan_desarrollo_eje` FOREIGN KEY (`id_plan_desarrollo_asignatura`) REFERENCES `plan_desarrollo_asignatura` (`id_plan_desarrollo_asignatura`),
  ADD CONSTRAINT `fk_plan_desarrollo_asignatura_eje_eje` FOREIGN KEY (`id_eje_tematico`) REFERENCES `eje_tematico` (`id_eje_tematico`),
  ADD CONSTRAINT `fk_plan_desarrollo_asignatura_eje_plan_desarrollo_unidad` FOREIGN KEY (`id_plan_desarrollo_asignatura_unidad`) REFERENCES `plan_desarrollo_asignatura_unidad` (`id_plan_desarrollo_asignatura_unidad`);

--
-- Filtros para la tabla `plan_desarrollo_asignatura_unidad`
--
ALTER TABLE `plan_desarrollo_asignatura_unidad`
  ADD CONSTRAINT `fk_plan_desarrollo_asignaruta_plan_desarrollo_unidad` FOREIGN KEY (`id_plan_desarrollo_asignatura`) REFERENCES `plan_desarrollo_asignatura` (`id_plan_desarrollo_asignatura`),
  ADD CONSTRAINT `fk_plan_desarrollo_asignatura_unidad_plan_desarrollo_detalle` FOREIGN KEY (`id_plan_desarrollo_asignatura_detalle`) REFERENCES `plan_desarrollo_asignatura_detalle` (`id_plan_desarrollo_asignatura_detalle`),
  ADD CONSTRAINT `fk_plan_desarrollo_asignatura_unidad_unidad` FOREIGN KEY (`id_unidad_asignatura`) REFERENCES `unidad_asignatura` (`id_unidad_asignatura`);

--
-- Filtros para la tabla `plazo_docente`
--
ALTER TABLE `plazo_docente`
  ADD CONSTRAINT `fk_plazo_docente_dominio_tipo` FOREIGN KEY (`id_dominio_tipo_formato`) REFERENCES `dominio` (`id_dominio`);

--
-- Filtros para la tabla `seguimiento_asignatura`
--
ALTER TABLE `seguimiento_asignatura`
  ADD CONSTRAINT `fk_seguimiento_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `fk_seguimiento_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `fk_seguimiento_tercero` FOREIGN KEY (`id_tercero`) REFERENCES `terceros` (`id_tercero`);

--
-- Filtros para la tabla `terceros`
--
ALTER TABLE `terceros`
  ADD CONSTRAINT `fk_tipo_tercero_dominio` FOREIGN KEY (`id_dominio_tipo_ter`) REFERENCES `dominio` (`id_dominio`);

--
-- Filtros para la tabla `tercero_grupo`
--
ALTER TABLE `tercero_grupo`
  ADD CONSTRAINT `fk_id_grupo_tercero_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `fk_id_tercero_tercero_grupo` FOREIGN KEY (`id_tercero`) REFERENCES `terceros` (`id_tercero`);

--
-- Filtros para la tabla `unidad_asignatura_seguimiento`
--
ALTER TABLE `unidad_asignatura_seguimiento`
  ADD CONSTRAINT `fk_unidad_seguimiento` FOREIGN KEY (`id_seguimiento_asignatura`) REFERENCES `seguimiento_asignatura` (`id_seguimiento`),
  ADD CONSTRAINT `fk_unidad_unidad` FOREIGN KEY (`id_unidad_asignatura`) REFERENCES `unidad_asignatura` (`id_unidad_asignatura`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`),
  ADD CONSTRAINT `fk_usuario_tercero` FOREIGN KEY (`id_tercero`) REFERENCES `terceros` (`id_tercero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
