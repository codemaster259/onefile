-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-03-2019 a las 15:33:22
-- Versión del servidor: 5.6.13
-- Versión de PHP: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jebusradec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcadores_categorias`
--

CREATE TABLE `marcadores_categorias` (
  `id` int(7) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tag` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `detalle` longtext COLLATE utf8mb4_spanish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `marcadores_categorias`
--

INSERT INTO `marcadores_categorias` (`id`, `nombre`, `tag`, `detalle`, `created`, `updated`) VALUES
(1, 'Anime', 'anime', '#40e3d3', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(6, 'Juegos', 'juegos', '#8787fb', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(5, 'Manga', 'manga', '#7D7D7D', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(17, 'Japones', 'japones', '#8080c0', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(8, 'Musica', 'musica', '#ff7c00', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(12, 'Anime Bajando', 'anime_bajando', '#40A35C', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(15, 'Hentai', 'hentai', '#ff0000', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(18, 'Programas', 'programas', '#ffff00', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(23, 'Anime Pendiente', 'anime_pendiente', '#FFFFFF', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(21, 'PC', 'pc', '#7744ab', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(22, 'Light Novels', 'light_novels', '#90a900', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(27, 'Series', 'series', '#CACACA', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(28, 'Peliculas', 'peliculas', '#575757', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(29, 'Programacion', 'programacion', '#584DFF', '2019-02-24 20:51:41', '2019-02-24 20:51:41'),
(30, 'Guitarra', 'guitarra', '#ff0000', '2019-02-24 20:51:41', '2019-02-24 20:51:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcadores_enlaces`
--

CREATE TABLE `marcadores_enlaces` (
  `id` int(7) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `categ` int(7) NOT NULL DEFAULT '0',
  `tiempo` int(15) NOT NULL,
  `user_id` int(7) NOT NULL,
  `privado` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `marcadores_enlaces`
--

INSERT INTO `marcadores_enlaces` (`id`, `titulo`, `url`, `categ`, `tiempo`, `user_id`, `privado`, `created`, `updated`) VALUES
(231, 'Amaenaideyo 2 Katsu budista ecchi', 'http://www.mediafire.com/?g9cpeh32ca8ml', 1, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(199, 'Code Geass R1 y R2', 'http://www.identi.li/index.php?topic=7709', 1, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(201, 'Code Geass R2 mf folder', 'http://www.mediafire.com/?59alwlnjnxr4t', 1, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(97, 'mflink', 'http://jebusradec.ven.bz/link.html', 21, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(450, 'Kono S o, Mi yo! 44++ (need 93)', 'http://mangapark.com/manga/kono-s-o-mi-yo/s1/v5/c44/1', 5, 1461789090, 2, 1, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(500, 'Grisaia no Kajitsu, Meikuu, Rakuen Animerush.tv', 'http://www.animerush.tv/search.php?searchquery=Grisaia+no+Meikyuu', 12, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(70, 'The Enchanted Cave', 'http://www.kongregate.com/games/DustinAux/the-enchanted-cave', 6, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(206, 'Shingeki No Kyojin Manga 67-37', 'https://mangapark.com/manga/shingeki-no-kyojin/s3/c67/37', 5, 1536630727, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(200, 'Code Geass R1 mf folder', 'http://www.mediafire.com/?ayhy44xlwlyx2', 1, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(522, '5 centimetros por segundo', 'https://www.youtube.com/watch?v=axik1Lr94R4', 23, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(337, 'Kyou Kara Maou 1-2-3', 'http://yuyu3stuff.blogspot.com/2012/06/kyo-kara-maoh.html', 12, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(499, 'Grisaia no Meikuu', 'https://mega.co.nz/#!bZ5mRCzD!ye6SdiSwEQBsjFh7Ev_lG7udfI90eNa8oyHiuwS7NHE', 12, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(492, 'mc mods new', 'https://www.youtube.com/watch?v=gof3cw730aE', 6, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(597, 'Overlord LN', 'http://skythewood.blogspot.sg/2015/04/O41.html', 22, 1460235054, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(468, 'chaika 2', 'http://www.animexgg.com/2014/10/hitsugi-no-chaika-avenging-battle.html', 23, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(520, 'Black Clover Manga 75-2', 'https://manga-mx.com/manga/black-clover/1976/p2', 5, 1535514339, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(230, 'Amaenaideyo 1 mf pass: animerec2013', 'http://www.mediafire.com/?rx6ucoatexrqe', 1, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(523, 'antivirus avast 2016', 'https://mega.nz/#!sEpVjbxD!xcH31TuZMjeiFDNiq4Dz8xKDs0gwaaX8aT8GFAkcPYQ', 18, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(526, 'http://support-au.canon.com.au/contents/AU/EN/0100420705.html', 'http://support-au.canon.com.au/contents/AU/EN/0100420705.html', 1, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(249, 'WATAMOTE MANGA 22-01', 'http://mangafox.me/manga/watashi_ga_motenai_no_wa_dou_kangaete_mo_omaera_ga_warui/v03/c022/1.html', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(596, 'two-responsive-mobile-navigation-techniques', 'https://anythinggraphic.net/demos/two-responsive-mobile-navigation-techniques/', 21, 1461528789, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(254, 'kamisama_no_inai_nichiyoubi manga', 'http://mangafox.me/manga/kamisama_no_inai_nichiyoubi/v02/c007/17.html', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(397, 'wnp_iii9.7_esn.exe full', 'http://depositfiles.org/files/t5onbpka6', 18, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(525, 'Windows 7 Loader', 'https://mega.nz/#!XcgwmYxR!uF5xHbSDocV1-SDNku2BHwrDI6LnhZTC8_6A9F7A9Tc', 18, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(257, 'musica 80', 'http://www.enladisco.com/puro-80spuro-80s/rock-mix-del-80-3', 8, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(402, 'http://www.taringa.net/posts/linux/16976918/Que-hacer-despues-de-instalar-Debian-7.html', 'http://www.taringa.net/posts/linux/16976918/Que-hacer-despues-de-instalar-Debian-7.html', 21, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(330, 'The World God Only Knows - Next 259', 'http://www.mangapark.com/manga/The-World-God-Only-Knows/', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(342, 'Katekyo Hitman Reborn! 203 Caps - Completa', 'http://www.mediafire.com/?9xg3nzu9h98do', 12, 1460658617, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(280, 'girls go around manga', 'http://www.mangareader.net/girls-go-around/1/5', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(281, 'Dungeon ni Deai Next 46', 'http://mangafox.me/manga/dungeon_ni_deai_o_motomeru_no_wa_machigatte_iru_darou_ka/', 5, 1447217404, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(452, 'kyou-koi-wo-hajimemasu', 'http://mangapark.com/manga/kyou-koi-wo-hajimemasu', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(453, 'Nana to Kaoru 17 hh', 'http://mangapark.com/manga/nana-to-kaoru/s1/v3/c17/2', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(307, 'Minamoto-kun Monogatari Next 152 - +H', 'http://www.mangapark.com/manga/Minamoto-kun-Monogatari/', 5, 1461789082, 2, 1, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(296, 'ASA MADE JUGYOU CHU (Rescue Me) cap 32 - Manga', 'http://mangafox.me/manga/asa_made_jugyou_chu/v04/c032/1.html', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(444, 'http://animegratisxmf.blogspot.com/', 'http://animegratisxmf.blogspot.com/', 1, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(298, 'SAO Girls Ops Next 5', 'http://mangafox.me/manga/sword_art_online_girls_ops/', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(466, 'Selector spread wixoss', 'https://www.google.co.ve/search?q=Selector+spread+wixoss&oq=Selector+spread+wixoss&aqs=chrome..69i57&sourceid=chrome&ie=UTF-8', 23, 1460143519, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(524, 'avast serial 2016', 'https://mega.nz/#!wRBXFJ4Q!ilKrsAIqCpD9fqKgn0ESSWjztFFuTP66aL9-IqzijX0', 18, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(439, 'Tokio Ghoul -  62/5', 'http://www.mangareader.net/toukyou-kushu/62/5', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(351, 'HxM', 'http://hentai-x-mf.blogspot.com/search?updated-max=2012-02-26T15%3A40%3A00-03%3A00&max-results=12', 15, 1462469948, 2, 1, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(378, 'Nisekoi - next 109 (go 8)', 'http://www.mangapark.com/manga/Nisekoi/', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(317, 'H+++', 'http://www.hentaihdl.com/', 1, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(363, 'Curso Japones Por Libre.com', 'http://www.japonesporlibre.com/curso/curso-de-japones', 17, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(505, 'http://photoshopen.blogspot.com/', 'http://photoshopen.blogspot.com/', 18, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(503, 'Yamada Kun to Nananin to Majo manga 91-1', 'http://mangapark.me/manga/yamada-kun-to-7-nin-no-majo/s5/c91/1', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(358, 'Saikin Imouto - next 9', 'http://mangafox.me/manga/saikin_imouto_no_yousu_ga_chotto_okashii_n_da_ga/', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(340, 'Freezing Completa Next 151', 'http://www.mangapark.com/manga/Freezing', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(327, 'hhh', 'http://nipon-hentai.blogspot.com/2013/08/imouto-paradise-22-mf.html?zx=ce1dbc998a611588', 15, 1462469952, 2, 1, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(430, 'Shovel Knight', 'http://www.intercambiosvirtuales.org', 6, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(573, 'SAO v18 Ch 22 (no defan752)', 'https://github.com/AgentMC/Sao18', 22, 1514133504, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(401, 'http://blog.desdelinux.net/que-hacer-despues-de-instalar-ubuntu-13-04-raring-ringtail/', 'http://blog.desdelinux.net/que-hacer-despues-de-instalar-ubuntu-13-04-raring-ringtail/', 21, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(441, 'http://narubl-mf.blogspot.com/', 'http://narubl-mf.blogspot.com/', 1, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(588, 'Punch Line Completa (narubl)', 'http://www.narubl-no-fansub.com/blog/punch_line_mf_narubl/2016-02-10-1255', 23, 1465025607, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(491, 'World Trigger manga', 'http://submanga.org/r/desconocido/world-trigger/75/1', 5, 0, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(480, 'gekkan-shoujo-nozaki-kun - Completa', 'http://narubl-mf.blogspot.com/2014/07/gekkan-shoujo-nozaki-kun-01-mf-narubl.html', 23, 1465025487, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(481, 'HSDxD 3 Born (crisanime)', 'http://crisanime.net/high-school-dxd-born-todos-los-capitulos-1212-sin-censura-ova-sin-censura-especiales-66-sin-censura-mega-mediafire/', 23, 1474564392, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(572, 'Boku dake ga Inai Machi next 42', 'http://mangapark.me/manga/boku-dake-ga-inai-machi', 5, 1457071113, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(545, 'Once Upon A Time S5 x E11 - 7 Dic Hackstore', 'http://hackstore.net/descargar-once-upon-a-time-quinta-temporada-subtitulado/', 27, 1449014120, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(547, 'American Gods 3 - 14 May (dimensionpeli)', 'http://www.dimensionpeliculas.com/american-gods-temporada-1-hdtv-720p-ingles-subtitulada-2017/', 27, 1494692008, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(592, 'Ragnarok The Animation', 'http://www.narubl-no-fansub.com/blog/ragnarok_the_animation_mf/2016-01-30-992', 23, 1465025503, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(593, 'menu responsive', 'http://www.valdelama.com/demo/css-responav', 21, 1461528971, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(590, 'Arifureta 129 - End!', 'https://elementalcobalt.wordpress.com/table-of-contents/', 22, 1513152713, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(561, 'One Punch Man - Cap 52-1', 'http://es.ninemanga.com/chapter/One%20Punch-Man/362326.html', 5, 1536561874, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(594, 'High School DxD Born mf', 'https://www.youtube.com/watch?v=v90ZCHHEQdo', 23, 1465025587, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(565, 'PHP Forum Example', 'http://code.tutsplus.com/tutorials/how-to-create-a-phpmysql-powered-forum-from-scratch--net-10188', 29, 1452343558, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(570, 'Shoujo-tachi wa Kouya 9 -  3 Mar (BIshojo Game)', 'http://porloprontoestaremos.blogspot.com/p/shoujo-tachi-wa-kouya-wo-mezasu.html', 23, 1465025616, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(577, 'christianvib', 'http://www.christianvib.com/libreria/', 30, 1452708847, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(598, 'How to Create a Basic Plugin | jQuery Learning Center', 'https://learn.jquery.com/plugins/basic-plugin-creation/', 29, 1461905765, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(612, 'A Role-Based Access Control (RBAC) system for PHP', 'http://www.tonymarston.net/php-mysql/role-based-access-control.html', 29, 1463749367, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(614, 'Shokugeki no Soma 202-6', 'http://fanfox.net/manga/shokugeki_no_soma/v24/c202/6.html', 5, 1527012819, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(617, 'Clockwork Planet', 'http://www.espamanga.com/11234-clockwork-planet-2.html', 5, 1465078946, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(618, 'Clockwork Planet LN', 'https://universonl.wordpress.com/tag/clockwork-planet-novela-ligera-en-espanol/', 22, 1465078987, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(619, 'No Game No Life LN', 'https://universonl.wordpress.com/no-game-no-life-novela-ligera/', 22, 1465079037, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(636, 'kohana css-and-js-files-in-module-directory', 'http://forum.kohanaframework.org/discussion/7014/css-and-js-files-in-module-directory/p1', 29, 1489377505, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(638, 'Mob Psycho 10 manga - 48', 'http://www.tumangaonline.com/lector/Mob-Psycho-100/14019/48.00/159', 5, 1473862887, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(640, 'Rpg Maker Guide', 'https://steamcommunity.com/sharedfiles/filedetails/?id=529597692', 6, 1481487537, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(641, 'rpg+maker+vx+ace+frozen+blocks+sprites', 'https://www.google.co.ve/search?q=rpg+maker+vx+ace+frozen+blocks+sprites&rlz=1C1AOHY_esVE708VE708&espv=2&biw=1280&bih=847&source=lnms&tbm=isch&sa=X&ved=0ahUKEwiB3oOTgIrQAhXFSSYKHZkXDlYQ_AUIBigB', 6, 1481487549, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(652, 'Dungeon Defense LN V5!', 'https://shalvationtranslations.wordpress.com/dungeon-defense-toc/', 22, 1513152722, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(653, 'The Return of Former Hero ver1 - 4', 'https://negaraizu.wordpress.com/the-return-of-former-hero/', 22, 1485653594, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(654, 'The Return of Former Hero ver2', 'http://raisingthedead.ninja/current-j-z/return-of-the-former-hero/', 22, 1485652209, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(655, 'Takami no Kago', 'http://raisingthedead.ninja/current-j-z/takami-no-kago/', 22, 1485652317, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(658, 'Masamune Kun no Revenge Manga c19-08', 'http://mangafox.me/manga/masamune_kun_no_revenge/v05/c019/8.html', 5, 1488276938, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(662, 'iZombie S4E3 - 12 Mar (hackstore)', 'http://hackstore.net/descargar-izombie-temporada-4-subtitulado/', 27, 1520443142, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(670, '100 4th', 'http://dimensionpeliculas.com/the-100-temporada-4-hdtv-720p-ingles-subtitulada-2017/', 27, 1494252208, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(673, 'Fate/Apocrypha 8 - 19 Ago (crisanimex)', 'https://crisanimex.com/fate-apocrypha-todos-capitulos-mg-mediafire-openload-zippyshare/', 12, 1503040220, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(686, 'Baby Driver', 'https://mega.nz/#!dqQQnLpY!gfd61Cyp3hFx1so8JOUAbKEx7RO4HevZ_K78XxyTVL4', 28, 1505750591, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(689, 'Lucifer S3E14 - Mie 7 Ene (hackstore.net)', 'http://hackstore.net/descargar-lucifer-temporada-3-subtitulado/', 27, 1517883261, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(691, 'Black Clover 72 - Mar 26 Feb (animucho)', 'https://asdasdasdasdasdasdqweqweqwezxczxczxc.blogspot.com/2018/08/black-clover.html', 12, 1550711856, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(693, 'Game Programing in C# Using Visual Studio series', 'http://ashrafgameprogramming.blogspot.in/2016/', 29, 1512716641, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(694, 'Platformer_controls_how_to_avoid_limpness_and_rigidity_feelings', 'https://www.gamasutra.com/blogs/YoannPignole/20140103/207987/Platformer_controls_how_to_avoid_limpness_and_rigidity_feelings.php', 29, 1513140338, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(695, 'https://codeincomplete.com/games/', 'https://codeincomplete.com/games/', 29, 1513140357, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(696, 'basic-2d-tile-collision', 'http://www.java-gaming.org/topics/basic-2d-tile-collision/29657/view.html', 29, 1513146800, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(697, 'LN 86 - [Asato Asato]', 'https://hellping.org/86-2/86-v1/86-v1-prologue/', 22, 1513152351, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(701, 'Killing Bites 4 - Vie 2 Feb (crisanimex)', 'https://crisanimex.com/killing-bites-todos-los-capitulos-01-mega-mediafire-openload-zippyshare-actualizable/', 12, 1517296992, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(702, 'Death March 15-1', 'http://shirouproject.blogspot.cl/2016/12/death-march-kara-hajimaru-isekai_15.html', 22, 1522221357, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(706, 'Yowamushi Pedal 356-2', 'http://fanfox.net/manga/yowamushi_pedal/v42/c356/2.html', 5, 1518661009, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(707, 'Ark LN', 'http://www.lntraducido.com/novel/ark/', 1, 1519439136, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(719, 'symfony manipular datos', 'http://www.maestrosdelweb.com/curso-symfony2-manipulando-datos-con-doctrine/', 29, 1528224984, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(721, 'Shingeki 3 - 13? - Abr 2019 (animeyt)', 'https://www.animeyt.tv/shingeki-no-kyojin-3', 12, 1539657276, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(726, 'SAO Alicization 20 - 2 Mar (animucho)', 'https://asdasdasdasdasdasdqweqweqwezxczxczxc.blogspot.com/2018/10/sword-art-online-alicizationcap-1-mp4.html', 12, 1550955194, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(728, 'Fairy Tail 2018 Cap 20 - 23 Feb (animucho)', 'https://asdasdasdasdasdasdqweqweqwezxczxczxc.blogspot.com/2018/10/fairy-tail-final-series.html', 12, 1550391269, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(731, 'Radiant 22 - 2 Mar (animucho)', 'https://asdasdasdasdasdasdqweqweqwezxczxczxc.blogspot.com/2018/10/radiantcap-1-mp4-ligero-por-mediafire.html', 12, 1550955202, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(733, 'Tate no Yuusha 8 - 27 Feb (animucho)', 'https://asdasdasdasdasdasdqweqweqwezxczxczxc.blogspot.com/2018/12/tate-no-yuusha-no-nariagari.html', 12, 1550711831, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(734, 'mob psycho II cap 8 - 25 Feb (animucho)', 'https://asdasdasdasdasdasdqweqweqwezxczxczxc.blogspot.com/2019/01/mob-psycho-100-ii.html', 12, 1550711893, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11'),
(735, 'Yakusoku no neverland 7 - 21 Feb (animucho)', 'https://asdasdasdasdasdasdqweqweqwezxczxczxc.blogspot.com/2019/01/yakusoku-no-neverland.html', 12, 1550190385, 2, 0, '2019-02-24 20:52:11', '2019-02-24 20:52:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_lista`
--

CREATE TABLE `notas_lista` (
  `id` int(7) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `contenido` longtext NOT NULL,
  `fecha` int(10) NOT NULL,
  `tags` longtext NOT NULL,
  `user_id` int(7) NOT NULL,
  `privado` int(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notas_lista`
--

INSERT INTO `notas_lista` (`id`, `titulo`, `contenido`, `fecha`, `tags`, `user_id`, `privado`, `created`, `updated`) VALUES
(9, 'Unlimited Blade Works', 'I am the bone of my sword Steel is my body and fire is my blood I have created over a thousand blades Unknown to Death, Nor known to Life Have withstood pain to create many weapons Yet, those hands will never hold anything So as I pray, Unlimited Blade Works', 1532030688, '', 2, 1, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(6, 'Coolest Wind Spell Cast!', 'Flying over all,\r\nsweeping everything like a hand,\r\nblowing body and mind,\r\nreleasing the power of wind I whisper:\r\nApocalyptic Storm!', 1460650368, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(10, 'X.U.', 'I don’t want nobody to get killed<br />\r\nI’ll come and get you<br />\r\nI am always ready to fight<br />\r\nSo don’t take all of the blame we were all swept away<br />\r\nDon’t take all of the weight. You always do<br />\r\nThere will always be something you cannot control<br />\r\nWe will overcome. Your salvation has begun<br />\r\n<br />\r\nNo signs<br />\r\nNo lights, such a mess all over<br />\r\nDon’t kill your hopes<br />\r\nYou make me realize who I need<br />\r\n<br />\r\nI’ll be there hold on<br />\r\nThey’ll change you somehow<br />\r\nSo where are you now?<br />\r\nI’ll reach you by dawn<br />\r\nBefore you can be turned<br />\r\nIllusions are torn<br />\r\nThe fallen angels you run with don’t know<br />\r\nIt is our pain that makes us all human after all<br />\r\nWarm old sepia photographs show<br />\r\nOur fragile precious world<br />\r\nMust protect it, respond to the call<br />\r\n<br />\r\nAre they really deep inside your head?<br />\r\nDo they control you like a little marionette?<br />\r\nI’ll cut the strings off you dead. Come in with me<br />\r\nLet me free the wings of your soul. Can make it fly<br />\r\nWe’ve been waiting here just to make you whole again<br />\r\nNo more hating see I have always been your friend<br />\r\n<br />\r\nNo signs<br />\r\nNo lights, such a mess all over<br />\r\nDon’t kill your hopes<br />\r\nYou make me realize who I need<br />\r\n<br />\r\nI’ll be there hold on<br />\r\nThey’ll change you somehow<br />\r\nSo where are you now?<br />\r\nI’ll reach you by dawn<br />\r\nThe shadows appear, Illusions are born<br />\r\nThe fallen angels you run with don’t know<br />\r\nIt is our pain that makes us all human after all<br />\r\nTorn old sepia photographs show<br />\r\nOur fragile precious world<br />\r\nMust discard it, respond to the call<br />\r\n<br />\r\nIf you wanna fight with me<br />\r\nThen go ahead fight with me<br />\r\nCos all I wanna do is help you man<br />\r\nYou will be the death of me<br />\r\nThe power of our army has been cut with a scythe<br />\r\nAnd if we lose you to them we may never survive<br />\r\nYou can leave but you must first believe<br />\r\nJust one step at a time and keep your head up boy and<br />\r\nYou’ll be free', 1463015915, '', 2, 1, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(11, 'Return to Destiny - Maon Kurosaki', 'Kuroku somaru sora no shita<br />\r\nkage ni obie nokosareta<br />\r\nakaku moeru chi no iro ga<br />\r\nnijin da mama tokete yuku<br />\r\n<br />\r\nMouichido mayowazu<br />\r\nano koro no bokura ni<br />\r\nmodoreru hazu mo nai<br />\r\nRETURN TO DESTINY<br />\r\n<br />\r\nAisuru koto o<br />\r\nmitsukete inori o komete<br />\r\ndareka no tame ni<br />\r\ntatakau sube o shitta<br />\r\nsoredemo kimi o nakusu to shitara<br />\r\nboku wa kono inochi o<br />\r\nsasagete demo kimi no soba ni iru yo<br />\r\n<br />\r\nKaze ga yureru mado no soto<br />\r\nyami ni kakure yorisotte<br />\r\ntsuki no shizuku namida to nari<br />\r\noto o tatezu nurashiteru<br />\r\n<br />\r\nMouichido kimi toka<br />\r\nano yoru no omoide o<br />\r\negakeru hazu mo nai<br />\r\nRETURN TO DESTINY<br />\r\n<br />\r\nIkiru tame ni wa kyouki o<br />\r\nkanki ni kaete<br />\r\nkanashimi wasurete<br />\r\nyowa sa wa dokoka ita<br />\r\ntatoe sekai ni<br />\r\nsoumouku toshite mo<br />\r\nboku wa tada nukumori o<br />\r\nkanjitai kara kimi o<br />\r\nhanasanai yo<br />\r\n<br />\r\nIma kaere tatoshite<br />\r\nwaki agaru jounen o<br />\r\nkoroseru wake mo nai<br />\r\nRETURN TO DESTINY<br />\r\n<br />\r\nAisuru koto o<br />\r\nmitsukete inori o komete<br />\r\ndareka no tame ni<br />\r\ntatakau sube o shitta<br />\r\nsoredemo kimi o nakusu to shitara<br />\r\nboku ha kono inochi o<br />\r\nsasagete demo kimi no soba ni iru yo', 1463022805, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(12, 'Unravel - TK from Ling Tosite Sigure', 'oshiete oshiete yo sono shikumi o boku no naka ni dare ga iru no?<br />\r\nkowareta kowareta yo kono sekai de kimi ga warau nanimo miezu ni<br />\r\n<br />\r\nkowareta boku nante sa iki o tomete<br />\r\nhodokenai mou hodokenai yo shinjitsu sae freeze<br />\r\nkowaseru kowasenai kurueru kuruenai<br />\r\nanata o mitsukete yureta<br />\r\n<br />\r\nyuganda sekai ni dandan boku wa sukitotte mienakunatte<br />\r\nmitsukenaide boku no koto o mitsumenaide<br />\r\ndareka ga egaita sekai no nake de anata o kizutsuketaku wa nai yo<br />\r\noboeteite boku no koto o azayaka na mama<br />\r\n<br />\r\nmugen ni hirogaru kodoku ga karamaru mujaki ni waratta kioku ga sasatte<br />\r\nugokenai ugokenai ugokenai ugokenai ugokenai ugokenai yo<br />\r\nunravelling the world<br />\r\n<br />\r\nkawatteshimatta kaerenakatta<br />\r\nfutatsu ga karameru futari ga horobiru<br />\r\nkowaseru kowasenai kurueru kuruenai<br />\r\nanata o kegasenai yo yureta<br />\r\n<br />\r\nyuganda sekai ni dandan boku wa sukitotte mienakunatte<br />\r\nmitsukenaide boku no koto o mitsumenaide<br />\r\ndareka ga shikunda kodoku na wana ni mirai ga hodoketeshimau mae ni<br />\r\nomoidashite boku no koto o azayaka na mama<br />\r\n<br />\r\nwasurenaide wasurenaide wasurenaide wasurenaide <br />\r\n<br />\r\nkaeteshimatta koto ni paralyze<br />\r\nkaerarenai koto darake no paradise<br />\r\noboeteite boku no koto o<br />\r\n<br />\r\noshiete oshiete boku no naka ni dare ga iru no?', 1463023523, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(14, 'Database - MAN WITH A MISSION ft. TAKUMA', 'Counteraction rising <br />\r\nYeah we are ready for the punch line <br />\r\nThere\'s no use with all your gimmicks <br />\r\nSO CHECK THIS OUT! <br />\r\n<br />\r\nLogin you damned one\'s <br />\r\nCrush the wont you compromise <br />\r\nThe noise comes we are ready to bow <br />\r\nWhat about the antidote for the jammed and hypnotized <br />\r\nRend the lie that covers <br />\r\nWho\'s the real sucker now <br />\r\n<br />\r\nsakimidareta hana no you ni azayaka na itami daki <br />\r\ntatazumu machi o nukete mayoi no serifu wa sute <br />\r\nkaeranai koe yo hibike <br />\r\nWe say Wow Wow Wow Wow <br />\r\n<br />\r\nDatabase Database <br />\r\nJust living in the Database Wow Wow <br />\r\nThe wall of pure fiction\'s cracking in my head <br />\r\nAnd the addiction of my world still spreads <br />\r\n<br />\r\nIn the Database Database <br />\r\nI\'m struggling in the Database Wow Wow <br />\r\nIt doesn\'t even matter if there is no hope <br />\r\nAs the madness of the system grows <br />\r\n<br />\r\nCrack in the key for the real clue <br />\r\nMass redemption reigning on <br />\r\nbut we know we\'ve been longing for this <br />\r\nCut it out The plot that deceived you <br />\r\nDrop the rebel sound Shut the system down <br />\r\nReveal the never found now <br />\r\n<br />\r\nhikisakareta to shite mo kyokou to mo genjitsu to mo <br />\r\nmieru gareki no naka de tatakaitsuzukeru dake <br />\r\n<br />\r\nGet damn all from big airheads <br />\r\nYeah You get damn all from big airheads <br />\r\nkasanaru sekai de tagiru kokoro ni hi o tomoshite <br />\r\n<br />\r\nDatabase Database <br />\r\nJust living in the Database Wow Wow <br />\r\nThe wall of pure fiction\'s cracking in my head <br />\r\nAnd the addiction of my world still spreads <br />\r\n<br />\r\nIn the Database Database <br />\r\nI\'m struggling in the Database Wow Wow <br />\r\nIt doesn\'t even matter if there is no hope <br />\r\nJust say Wow Wow Wow Wow <br />\r\n<br />\r\n\"Wait a minute, what happened? The data\'s wrong! Come on!\" <br />\r\n<br />\r\ntoki ni keisan takasa wa dasoku DA Calculator <br />\r\ntoukei ni yusaburareta mama kieteitta <br />\r\nsou naritaku nakya Database <br />\r\ndake ni tayorazu migake jibun no peesu <br />\r\n<br />\r\nGet damn all from big airheads <br />\r\nYeah You get damn all from big airheads <br />\r\nGet damn all from big airheads <br />\r\nYeah You get damn all from big airheads <br />\r\n<br />\r\nDatabase Database <br />\r\nJust living in the Database Wow Wow <br />\r\nThe wall of pure fiction\'s cracking in my head <br />\r\nAnd the addiction of my world still spreads <br />\r\n<br />\r\nIn the Database Database <br />\r\nI\'m struggling in the Database Wow Wow <br />\r\nIt doesn\'t even matter if there is no hope <br />\r\nAs the madness of the system grows <br />\r\n<br />\r\nDatabase Database <br />\r\nJust living in the Database <br />\r\nDatabase Database <br />\r\nJust say Wow Wow Wow Wow', 1463028210, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(15, 'Hottest Fire Spell', 'Burning inside the flames,<br />\r\nbecoming one with the hell,<br />\r\ngaining will and strength,<br />\r\nreleasing teh power of the fire I spell:<br />\r\n<br />\r\n\"Wall of Heat!\"', 1463028246, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(16, 'Darkest Dark Spell!!!', 'Falling into the void,<br />\r\ndraining live fom souls,<br />\r\nspreading despair and fear,<br />\r\nreleasing the power of darkness I cast:<br />\r\n<br />\r\n&quot;Vortex of Shadows!&quot;', 1472157714, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(19, 'Winrar 5.40 rarreg.key', 'RAR registration data<br />\r\nyaokai.com<br />\r\nUnlimited Company License<br />\r\nUID=636da5a1e3718a4597b9<br />\r\n641221225097b94b94094a6548ed8365940161a87853d63b09c6ff<br />\r\n0b86c572d75fb683db5960fce6cb5ffde62890079861be57638717<br />\r\n7131ced835ed65cc743d9777f2ea71a8e32c7e593cf66794343565<br />\r\nb41bcf56929486b8bcdac33d50ecf77399608cfb51a0f9e15e798c<br />\r\n57fc8a5e5c3fc69a04ae7d4ec41408c506ff1c90962e165207a4e9<br />\r\n45d426eae53d8849d222b3b26997e5e18b4526596c75d682603e01<br />\r\n1364c589ec5fcea9fa5b796e3fa7437cd080392e5d791757768079', 1513147918, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(20, 'https://appuals.com/how-to-create-custom-resolutions-on-windows-7-8-or-10/', 'https://appuals.com/how-to-create-custom-resolutions-on-windows-7-8-or-10/', 1514973552, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(21, 'JS Loop', '(function(){<br />\r\n    <br />\r\n    var ECS = {};<br />\r\n    <br />\r\n    var reserved = [&quot;Extend&quot;,&quot;Console&quot;];<br />\r\n    <br />\r\n    ECS.Extend = function(property, fn){<br />\r\n        if(property)<br />\r\n        {<br />\r\n            //if(reserved.indexOf(property) == -1)<br />\r\n            if(!this.hasOwnProperty(property))<br />\r\n            {<br />\r\n                MakePropertyChain(this, property, fn);<br />\r\n                <br />\r\n            }else{<br />\r\n                throwError(&quot;Property &lt;&quot; + property + &quot;&gt; is reserved in ECS object.&quot;);<br />\r\n            }<br />\r\n        }<br />\r\n    };<br />\r\n    <br />\r\n    ECS.Console = function(txt){<br />\r\n        console.log(txt);<br />\r\n    };<br />\r\n<br />\r\n    function MakePropertyChain(obj, str, fn){<br />\r\n        var props = str.split(&quot;.&quot;);<br />\r\n        <br />\r\n        var chain = obj;<br />\r\n        for(var i = 0; i &lt; props.length; i++)<br />\r\n        {<br />\r\n            if(i == 0 &amp;&amp; reserved.indexOf(props[i]) !== -1)<br />\r\n                throwError(&quot;Property &lt;&quot; + props[i] + &quot;&gt; is reserved in ECS object.&quot;);<br />\r\n            <br />\r\n            if(!chain[props[i]])<br />\r\n            {<br />\r\n                if(i== props.length - 1)<br />\r\n                {<br />\r\n                    chain[props[i]] = fn; //last chain property<br />\r\n                }else{<br />\r\n                    chain[props[i]] = {}; //any chain property<br />\r\n                }<br />\r\n            }<br />\r\n            chain = chain[props[i]];<br />\r\n        }<br />\r\n    }<br />\r\n    <br />\r\n    function throwError(msg)<br />\r\n    {<br />\r\n        throw new Error(msg);<br />\r\n    }<br />\r\n    window.ECS = ECS; <br />\r\n})();<br />\r\n<br />\r\nECS.Extend(&quot;Loop.Timemode&quot;, {<br />\r\n        MS: &quot;ms&quot;,<br />\r\n        S: &quot;s&quot;,<br />\r\n        M: &quot;m&quot;,<br />\r\n        H: &quot;h&quot;<br />\r\n    });<br />\r\n    <br />\r\nECS.Extend(&quot;Alert&quot;, function(){alert(&quot;&quot;)});<br />\r\nECS.Alert();<br />\r\nECS.Console(ECS);<br />\r\n    <br />\r\nECS.Extend(&quot;Loop.Interval&quot;, function (time, timemode){<br />\r\n	<br />\r\n	var that = this;<br />\r\n	var _id = null;<br />\r\n	<br />\r\n	var _timemode = timemode;<br />\r\n	<br />\r\n	var _time = time;<br />\r\n	var _realtime = parseTimeMode(time);<br />\r\n	var _callback = null;<br />\r\n	<br />\r\n	var _running = false;<br />\r\n    var _paused = false;<br />\r\n	var _times = null;<br />\r\n	<br />\r\n	var _limit = null;<br />\r\n	var _max = null;<br />\r\n	var _min = 1;<br />\r\n	<br />\r\n	var _counter = 0;<br />\r\n	<br />\r\n	function parseTimeMode(time)<br />\r\n	{<br />\r\n		var realTime = time;<br />\r\n		<br />\r\n		switch(_timemode)<br />\r\n		{<br />\r\n			case ECS.Loop.Timemode.MS: //* milisegundo<br />\r\n				realTime = time * 1;<br />\r\n				break;<br />\r\n				<br />\r\n			case ECS.Loop.Timemode.S: //* 1 segundo<br />\r\n				realTime = time * 1000;<br />\r\n				break;<br />\r\n				<br />\r\n			case ECS.Loop.Timemode.M: //* 1 minuto<br />\r\n				realTime = time * 1000 * 60;<br />\r\n				break;<br />\r\n				<br />\r\n			case ECS.Loop.Timemode.H: //* 1 hora<br />\r\n				realTime = time * 1000 * 60 * 60;<br />\r\n				break;<br />\r\n		}<br />\r\n		return realTime;<br />\r\n	}<br />\r\n	<br />\r\n	this.start = function(){<br />\r\n	<br />\r\n		_running = true;<br />\r\n		_id = setInterval(function(){<br />\r\n		<br />\r\n			if(!_callback) return;<br />\r\n		<br />\r\n			var chance = true;<br />\r\n			<br />\r\n			var number;<br />\r\n		<br />\r\n			if(_limit &amp;&amp; _max)<br />\r\n			{<br />\r\n				number = Math.floor(Math.random() * (_max)) + _min;<br />\r\n				<br />\r\n				if(number &gt;= _limit)<br />\r\n				{<br />\r\n					chance = false;<br />\r\n				}<br />\r\n			}<br />\r\n			<br />\r\n			if(chance)<br />\r\n			{<br />\r\n				if( _times !== null &amp;&amp; _counter &lt; _times)<br />\r\n				{<br />\r\n					_counter++;<br />\r\n				}<br />\r\n				<br />\r\n                if(!_paused)<br />\r\n                {<br />\r\n                    _callback.call(that, _time + _timemode);<br />\r\n                }<br />\r\n			}<br />\r\n			<br />\r\n			if(_counter == _times)<br />\r\n			{<br />\r\n				this.stop();<br />\r\n			}<br />\r\n			<br />\r\n		}.bind(that), _realtime);<br />\r\n	}<br />\r\n	<br />\r\n	this.stop = function(){<br />\r\n		if(!this.isRunning()) return;<br />\r\n		clearInterval(_id);<br />\r\n		_running = false;<br />\r\n	}<br />\r\n    <br />\r\n    this.pause = function(){<br />\r\n        _paused = true;<br />\r\n    }<br />\r\n    <br />\r\n    this.resume = function(){<br />\r\n        _paused = false;<br />\r\n    }<br />\r\n    <br />\r\n    this.isPaused = function(){<br />\r\n        return _paused;<br />\r\n    }<br />\r\n	<br />\r\n	this.getID = function(){<br />\r\n		return _id;<br />\r\n	}<br />\r\n	<br />\r\n	this.isRunning = function(){<br />\r\n		return _running;<br />\r\n	}<br />\r\n	<br />\r\n	this.do = function(callback){<br />\r\n		_callback = callback;<br />\r\n		return this;<br />\r\n	}<br />\r\n	<br />\r\n	//Specials<br />\r\n	this.repeat = function(times){<br />\r\n		if(times &gt; 0)<br />\r\n		{<br />\r\n			_times = times;<br />\r\n		}<br />\r\n		return this;<br />\r\n	}<br />\r\n	<br />\r\n	this.chance = function(limit, max){<br />\r\n		if(limit &lt; max)<br />\r\n		{<br />\r\n			_limit = limit;<br />\r\n			_max = max;<br />\r\n		}<br />\r\n		return this;<br />\r\n	}<br />\r\n});<br />\r\n<br />\r\nECS.Extend(&quot;Loop.Pool&quot;, function(){<br />\r\n<br />\r\n	var _running = false;<br />\r\n    <br />\r\n    var _paused = false;<br />\r\n	<br />\r\n	var _loops = [];<br />\r\n	<br />\r\n	this.loop = function(time, timemode){<br />\r\n	<br />\r\n		time = time || 20<br />\r\n		timemode = timemode || ECS.Loop.Timemode.MS;<br />\r\n		<br />\r\n		var loop = new ECS.Loop.Interval(time, timemode);<br />\r\n		_loops.push(loop);<br />\r\n		return loop;<br />\r\n	}<br />\r\n    <br />\r\n    this.pause = function(){<br />\r\n        <br />\r\n        for(var i = 0; i &lt; _loops.length; i++)<br />\r\n		{<br />\r\n			_loops[i].pause();<br />\r\n		}<br />\r\n        _paused = true;<br />\r\n    }<br />\r\n    <br />\r\n    this.isPaused = function(){<br />\r\n        return _paused;<br />\r\n    }<br />\r\n    <br />\r\n    this.resume = function(){<br />\r\n        for(var i = 0; i &lt; _loops.length; i++)<br />\r\n		{<br />\r\n			_loops[i].resume();<br />\r\n		}<br />\r\n        _paused = false;<br />\r\n    }<br />\r\n	<br />\r\n	this.start = function(){<br />\r\n	<br />\r\n		for(var i = 0; i &lt; _loops.length; i++)<br />\r\n		{<br />\r\n			_loops[i].start();<br />\r\n		}<br />\r\n		_running = true;<br />\r\n	}<br />\r\n	<br />\r\n	this.stop = function(){<br />\r\n	<br />\r\n		if(!_running) return;<br />\r\n		<br />\r\n		for(var i = 0; i &lt; _loops.length; i++)<br />\r\n		{<br />\r\n			_loops[i].stop();<br />\r\n		}<br />\r\n	}<br />\r\n});<br />\r\n<br />\r\nvar pool = new ECS.Loop.Pool();<br />\r\npool.loop(1000).do(function(){<br />\r\n    console.log(&quot;i\'m interval!&quot;)<br />\r\n});<br />\r\n<br />\r\npool.start();', 1515313408, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(23, 'Anime', 'Log Horizon:<br />\r\nhttps://mega.nz/#F!u5R2nTJJ!ZJgJr1Zz0zU8zWfIshnmQQ<br />\r\n<br />\r\nhttps://mega.nz/#F!GwBlgI4L!E0F5lcdrtaZ4R2r1a4XAow<br />\r\n<br />\r\nDanshi Koukousei no nichijou:<br />\r\n<br />\r\nhttps://mega.nz/#F!vRgzlKwB!GquOF2zJc-ar1eWb4-fBlw', 1520657116, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(24, 'json_response', '&lt;?php<br />\r\nfunction json_response($message = null, $code = 200)<br />\r\n{<br />\r\n    // clear the old headers<br />\r\n    header_remove();<br />\r\n    // set the actual code<br />\r\n    http_response_code($code);<br />\r\n    // set the header to make sure cache is forced<br />\r\n    header(&quot;Cache-Control: no-transform,public,max-age=300,s-maxage=900&quot;);<br />\r\n    // treat this as json<br />\r\n    header(\'Content-Type: application/json\');<br />\r\n    $status = array(<br />\r\n        200 =&gt; \'200 OK\',<br />\r\n        400 =&gt; \'400 Bad Request\',<br />\r\n        422 =&gt; \'Unprocessable Entity\',<br />\r\n        500 =&gt; \'500 Internal Server Error\'<br />\r\n        );<br />\r\n    // ok, validation error, or failure<br />\r\n    header(\'Status: \'.$status[$code]);<br />\r\n    // return the encoded json<br />\r\n    return json_encode(array(<br />\r\n        \'status\' =&gt; $code &lt; 300, // success or not?<br />\r\n        \'message\' =&gt; $message<br />\r\n        ));<br />\r\n}<br />\r\n// if you are doing ajax with application-json headers<br />\r\nif (empty($_POST)) {<br />\r\n    $_POST = json_decode(file_get_contents(&quot;php://input&quot;), true) ? : [];<br />\r\n}<br />\r\n// usage<br />\r\necho json_response(200, \'working\'); // {&quot;status&quot;:true,&quot;message&quot;:&quot;working&quot;}<br />\r\n// array usage<br />\r\necho json_response(200, array(<br />\r\n  \'data\' =&gt; array(1,2,3)<br />\r\n  ));<br />\r\n// {&quot;status&quot;:true,&quot;message&quot;:{&quot;data&quot;:[1,2,3]}}<br />\r\n// usage with error<br />\r\necho json_response(500, \'Server Error! Please Try Again!\'); // {&quot;status&quot;:false,&quot;message&quot;:&quot;Server Error! Please Try Again!&quot;}<br />\r\n', 1539022888, '', 2, 0, '2019-02-24 20:52:26', '2019-02-24 20:52:26'),
(25, 'my.freenom.com .ml domains', 'https://my.freenom.com/clientarea.php?action=domains', 1547685747, '', 2, 1, '2019-02-24 20:52:26', '2019-02-24 20:52:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina_config`
--

CREATE TABLE `pagina_config` (
  `campo` varchar(50) NOT NULL,
  `valor` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pagina_config`
--

INSERT INTO `pagina_config` (`campo`, `valor`) VALUES
('pagina_titulo', 'Pirulo Radec'),
('pagina_direccion', 'Caracas'),
('pagina_telefono', '0212-555-55-55'),
('pagina_correo', 'jebusradec@gmail.com'),
('pagina_twitter', 'http://www.twitter.com'),
('pagina_facebook', 'http://www.facebook.com'),
('pagina_youtube', 'http://www.youtube.com'),
('pagina_itemsperpagina', '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `nombre`, `apellido`, `correo`, `status`, `created`, `updated`) VALUES
(2, 'pirulo259', '$2y$10$i4TSMyglmzMdmSbydHYk0uK8Z.sE381lERJ.uqWuBQQjYpjoLEe/C', 'Carlos Tomas', 'Gonzalez Lemus', 'codemaster259@gmail.com', 1, '2019-02-24 20:51:00', '2019-02-25 00:28:43');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marcadores_categorias`
--
ALTER TABLE `marcadores_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcadores_enlaces`
--
ALTER TABLE `marcadores_enlaces`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notas_lista`
--
ALTER TABLE `notas_lista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagina_config`
--
ALTER TABLE `pagina_config`
  ADD UNIQUE KEY `parametro` (`campo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`username`),
  ADD UNIQUE KEY `userid` (`id`),
  ADD KEY `userid_2` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marcadores_categorias`
--
ALTER TABLE `marcadores_categorias`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `marcadores_enlaces`
--
ALTER TABLE `marcadores_enlaces`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=736;

--
-- AUTO_INCREMENT de la tabla `notas_lista`
--
ALTER TABLE `notas_lista`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
