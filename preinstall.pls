SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS "albums" (
  "id" int(11) NOT NULL COMMENT 'Айди альбома',
  "aid" int(11) NOT NULL,
  "name" text NOT NULL COMMENT 'Название альбома',
  "note" text NOT NULL COMMENT 'Описание альбома',
  "date" int(11) NOT NULL COMMENT 'Дата создания',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=89978 ;

DROP TABLE IF EXISTS `api_tokens`;
CREATE TABLE IF NOT EXISTS "api_tokens" (
  "id" bigint(20) unsigned NOT NULL,
  "token" varchar(512) COLLATE utf32_unicode_ci NOT NULL,
  "owner" bigint(20) NOT NULL,
  "access_pragma" double NOT NULL DEFAULT '0',
  UNIQUE KEY "id" ("id")
) AUTO_INCREMENT=17 ;

DROP TABLE IF EXISTS `bgcomments`;
CREATE TABLE IF NOT EXISTS "bgcomments" (
  "id" int(11) NOT NULL,
  "idbug" int(11) NOT NULL,
  "iduser" int(11) NOT NULL,
  "text" text NOT NULL,
  "date" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=45 ;

DROP TABLE IF EXISTS `blacklist`;
CREATE TABLE IF NOT EXISTS "blacklist" (
  "id" int(11) NOT NULL,
  "id1" int(11) NOT NULL COMMENT 'кто',
  "id2" int(11) NOT NULL COMMENT 'кого',
  "about" text NOT NULL COMMENT 'причина',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS "blog" (
  "id" int(255) NOT NULL COMMENT 'Таки id создается сам, но сменить можно',
  "name" text NOT NULL COMMENT 'Название блога',
  "k_about" text NOT NULL,
  "text" text NOT NULL COMMENT 'Тест блога',
  "author" text NOT NULL COMMENT 'Автор, ибо Рита хуй <3',
  "idauthor" int(11) NOT NULL,
  "imgur" int(2) NOT NULL COMMENT 'Включаем "0" - если не хотим фотку в верху, а если хотим то "1".',
  "photo1" text NOT NULL COMMENT 'Прямую ссылку на фотку',
  "date" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=8 ;

DROP TABLE IF EXISTS `bugreport`;
CREATE TABLE IF NOT EXISTS "bugreport" (
  "id" int(11) NOT NULL,
  "name" text NOT NULL,
  "email" text NOT NULL,
  "text" text NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=660 ;

DROP TABLE IF EXISTS `bugtracker`;
CREATE TABLE IF NOT EXISTS "bugtracker" (
  "id" int(11) NOT NULL,
  "name" text NOT NULL,
  "about" text NOT NULL,
  "photo" text NOT NULL,
  "important" int(11) NOT NULL COMMENT '1 - ОЧЕНЬ ВАЖНО ; 2 - Средне ; 3 - Не очень важный ',
  "aid" int(11) NOT NULL,
  "status" int(11) NOT NULL COMMENT '1 - Открыт ; 2 - Закрыт ; 3 - На модерировании',
  "date" int(11) NOT NULL,
  "comment" text NOT NULL COMMENT 'Ответ модератора на отчет.',
  "admin" int(255) NOT NULL COMMENT 'Администатор данной темы (p.s кто отвечает/следит за темой)',
  "news" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=19 ;

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS "club" (
  "id" int(11) NOT NULL DEFAULT '0' COMMENT 'id',
  "name" varchar(255) NOT NULL,
  "about" varchar(500) NOT NULL,
  "avatar" varchar(255) NOT NULL,
  "verify" int(1) NOT NULL COMMENT 'галочка группы: 0 - нет, 1 - обычная, 2 - тестерская, 3 - админская, 4 - элитного тестера донатера, 5 - повышенный интерес',
  "maturecontent" int(1) NOT NULL DEFAULT '0' COMMENT 'содержит ли группа порнографию (0 - нет, 1 - да)',
  "ban" int(1) NOT NULL,
  "comment_ban" varchar(255) NOT NULL,
  "authorid" int(11) NOT NULL,
  "wall" int(11) NOT NULL COMMENT '0 открыта 1 нихуя',
  "type" int(11) NOT NULL DEFAULT '0' COMMENT '0 технологичная группа 1 блядская тусовка',
  "datestart" int(11) NOT NULL,
  "datefinish" int(11) NOT NULL,
  "place" text NOT NULL,
  "email" text NOT NULL,
  "closed" int(11) NOT NULL DEFAULT '0',
  "deleted" int(11) NOT NULL,
  "cover" varchar(255) NOT NULL,
  "widget" int(11) NOT NULL DEFAULT '0' COMMENT 'включить этой группе виджет? 0 нет 1 да. ссылку на виджет вводить в widgetlink размером 400х155',
  "widgetlink" varchar(255) NOT NULL COMMENT 'ссылка на виджет размером ровно 400х155',
  "widgettype" int(11) NOT NULL COMMENT 'значение виджета',
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS `clubsub`;
CREATE TABLE IF NOT EXISTS "clubsub" (
  "id" int(11) NOT NULL,
  "id1" int(11) NOT NULL,
  "id2" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=491 ;

DROP TABLE IF EXISTS `clubsubrequest`;
CREATE TABLE IF NOT EXISTS "clubsubrequest" (
  "id" int(11) NOT NULL,
  "id1" int(11) NOT NULL,
  "id2" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=70 ;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS "comments" (
  "id" int(11) NOT NULL COMMENT 'просто айди, чтобы был',
  "iduser" int(11) NOT NULL COMMENT 'айди пользователя',
  "idpost" int(11) NOT NULL COMMENT 'айди поста',
  "text" text NOT NULL COMMENT 'текст',
  "date" int(11) NOT NULL COMMENT 'дата',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=180 ;

DROP TABLE IF EXISTS `dialogs`;
CREATE TABLE IF NOT EXISTS "dialogs" (
  "id" int(11) NOT NULL,
  "readit" int(1) NOT NULL DEFAULT '0',
  "id1" int(11) NOT NULL COMMENT 'айди отправителя',
  "id2" int(11) NOT NULL COMMENT 'айди получателя',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS "documents" (
  "id" bigint(20) unsigned NOT NULL,
  "name" varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  "description" longtext COLLATE utf32_unicode_ci NOT NULL,
  "access_pragma" bit(8) NOT NULL DEFAULT b'1' COMMENT 'Маска доступа',
  "file" varchar(1024) COLLATE utf32_unicode_ci NOT NULL,
  "since" bigint(20) NOT NULL COMMENT 'Дата публикации',
  UNIQUE KEY "id" ("id")
) AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS "friends" (
  "id" int(11) NOT NULL COMMENT 'просто айди, чтобы был',
  "id1" int(11) NOT NULL COMMENT 'какой айди дружит с ',
  "id2" int(11) NOT NULL COMMENT 'этим айди',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=538 ;

DROP TABLE IF EXISTS `galbums`;
CREATE TABLE IF NOT EXISTS "galbums" (
  "id" int(11) NOT NULL,
  "aid" int(11) NOT NULL,
  "name" text CHARACTER SET utf8 NOT NULL,
  "note" text CHARACTER SET utf8 NOT NULL,
  "date" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=18 ;

DROP TABLE IF EXISTS `gcomments`;
CREATE TABLE IF NOT EXISTS "gcomments" (
  "id" int(11) NOT NULL,
  "iduser" int(11) NOT NULL,
  "idpost" int(11) NOT NULL,
  "text" text NOT NULL,
  "date" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=101 ;

DROP TABLE IF EXISTS `geousers`;
CREATE TABLE IF NOT EXISTS "geousers" (
  "id" int(9) NOT NULL,
  "username" text NOT NULL,
  "password" text NOT NULL,
  "regip" text NOT NULL,
  "color" text NOT NULL,
  "bodys" text NOT NULL,
  "regdate" date NOT NULL,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS `gpost`;
CREATE TABLE IF NOT EXISTS "gpost" (
  "id" int(11) NOT NULL,
  "iduser" int(11) NOT NULL,
  "idwall" int(11) NOT NULL,
  "text" text NOT NULL,
  "date" int(11) NOT NULL,
  "image" varchar(255) NOT NULL,
  "bygroup" int(1) NOT NULL DEFAULT '0' COMMENT 'от имени группы? 1 - да, 0 - нет.',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=471 ;

DROP TABLE IF EXISTS `info_site`;
CREATE TABLE IF NOT EXISTS "info_site" (
  "infotext" text NOT NULL,
  "infoonn" int(1) NOT NULL,
  "id" int(1) NOT NULL,
  "off_site" int(2) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=2 ;

DROP TABLE IF EXISTS `invitecodes`;
CREATE TABLE IF NOT EXISTS "invitecodes" (
  "id" int(11) NOT NULL,
  "code" varchar(15) CHARACTER SET utf8 NOT NULL,
  "createdby" int(11) NOT NULL,
  "usedby" int(11) NOT NULL,
  "date" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=20 ;

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS "messages" (
  "id" int(11) NOT NULL COMMENT 'ёбаный в рот этого казино блять',
  "id1" int(11) NOT NULL COMMENT 'айди отправителя',
  "id2" int(11) NOT NULL COMMENT 'айди получателя',
  "topic" varchar(255) NOT NULL COMMENT 'тема',
  "text" varchar(500) NOT NULL COMMENT 'текст',
  "date" int(11) NOT NULL COMMENT 'время и дата',
  "readed" int(11) NOT NULL DEFAULT '0' COMMENT 'ПРОЧИТАЛ ЛИ ПОЛУЧАТЕЛЬ СООБЩЕНИЕ',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=476 ;

DROP TABLE IF EXISTS `ncomments`;
CREATE TABLE IF NOT EXISTS "ncomments" (
  "id" int(11) NOT NULL,
  "idnote" int(11) NOT NULL,
  "idauthor" int(11) NOT NULL,
  "text" text CHARACTER SET utf8 NOT NULL,
  "date" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=588 ;

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS "note" (
  "id" int(11) NOT NULL,
  "name" text NOT NULL,
  "text" text NOT NULL,
  "aid" int(11) NOT NULL,
  "date" int(11) NOT NULL,
  "edited" int(11) NOT NULL DEFAULT '0' COMMENT '0 нет 1 да',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=69 ;

DROP TABLE IF EXISTS `nyash`;
CREATE TABLE IF NOT EXISTS "nyash" (
  "id" int(11) NOT NULL,
  "id1" int(11) NOT NULL,
  "id2" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `opntwtr_posts`;
CREATE TABLE IF NOT EXISTS "opntwtr_posts" (
  "id" int(11) NOT NULL,
  "id_usr" int(11) NOT NULL,
  "text" text NOT NULL,
  "date" text NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=15 ;

DROP TABLE IF EXISTS `opntwtr_users`;
CREATE TABLE IF NOT EXISTS "opntwtr_users" (
  "id" int(11) NOT NULL,
  "name" text NOT NULL,
  "passw0rd" varchar(32) NOT NULL,
  "realname" text NOT NULL,
  "date" date NOT NULL,
  "date_registr" date NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=6 ;

DROP TABLE IF EXISTS `pcomments`;
CREATE TABLE IF NOT EXISTS "pcomments" (
  "id" int(11) NOT NULL COMMENT 'айди',
  "idphoto" int(11) NOT NULL COMMENT 'айди фото',
  "aid" int(11) NOT NULL COMMENT 'айди автора комментария',
  "date" int(11) NOT NULL COMMENT 'дата',
  "text" text NOT NULL COMMENT 'тест СУКА',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=540 ;

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS "photo" (
  "id" int(11) NOT NULL COMMENT 'Айди фотографии',
  "aid" int(11) NOT NULL,
  "image" text NOT NULL COMMENT 'путь к фотографии',
  "note" text NOT NULL COMMENT 'Описание фотографии',
  "album" int(11) NOT NULL COMMENT 'Какому альбому пренадлежит эта фотография',
  "galbum" int(11) NOT NULL COMMENT 'какому альбому в группе эта фотография пренадлежит',
  "user" int(11) NOT NULL COMMENT 'какому пользователю пренадлежит фотография (если она в группе)',
  "date" int(11) NOT NULL COMMENT 'дата в unix',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=109 ;

DROP TABLE IF EXISTS `rule`;
CREATE TABLE IF NOT EXISTS "rule" (
  "id" int(11) NOT NULL,
  "id1" int(11) NOT NULL,
  "text" text NOT NULL,
  PRIMARY KEY ("id1")
) AUTO_INCREMENT=2 ;

DROP TABLE IF EXISTS `shorts`;
CREATE TABLE IF NOT EXISTS "shorts" (
  "id" bigint(20) unsigned NOT NULL,
  "url" longtext COLLATE utf32_unicode_ci NOT NULL,
  "redirect" longtext COLLATE utf32_unicode_ci NOT NULL,
  UNIQUE KEY "id" ("id")
);

DROP TABLE IF EXISTS `siteinfo`;
CREATE TABLE IF NOT EXISTS "siteinfo" (
  "oninfo" int(1) NOT NULL,
  "texted" text NOT NULL
);

DROP TABLE IF EXISTS `subs`;
CREATE TABLE IF NOT EXISTS "subs" (
  "id" int(11) NOT NULL,
  "id1" int(11) NOT NULL,
  "id2" int(11) NOT NULL,
  PRIMARY KEY ("id")
) AUTO_INCREMENT=353 ;

DROP TABLE IF EXISTS `upload_servers`;
CREATE TABLE IF NOT EXISTS "upload_servers" (
  "id" bigint(20) unsigned NOT NULL,
  "name" longtext COLLATE utf32_unicode_ci NOT NULL,
  "key" varchar(512) COLLATE utf32_unicode_ci NOT NULL,
  UNIQUE KEY "id" ("id")
) AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `userblog`;
CREATE TABLE IF NOT EXISTS "userblog" (
  "id" int(11) NOT NULL COMMENT 'айди записи',
  "authorid" int(11) NOT NULL COMMENT 'айди пиздюка блоговода',
  "text" text NOT NULL COMMENT 'что в школе было сегодня?',
  "authortext" text NOT NULL COMMENT 'подпись аФФФтора',
  "data" date NOT NULL
);

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS "users" (
  "id" int(11) NOT NULL COMMENT 'идентификатор юзера',
  "name" varchar(36) CHARACTER SET utf8 NOT NULL COMMENT 'имя',
  "surname" varchar(36) CHARACTER SET utf8 NOT NULL COMMENT 'фамилия',
  "gender" int(1) NOT NULL DEFAULT '0' COMMENT 'пол (1 - мужчина, 2 - женщина, а 3 - транс :D)',
  "login" varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'имя пользователя',
  "password" varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'пароль (md5-шифрование)',
  "groupu" int(1) NOT NULL DEFAULT '0',
  "verify" int(1) NOT NULL DEFAULT '0' COMMENT 'есть ли галочка у пользователя (0 - нет; 1 - да, обычная; 5 - да, админская; 3 - да, тестерская)',
  "closedwall" int(1) NOT NULL DEFAULT '0',
  "ban" int(1) NOT NULL DEFAULT '0' COMMENT 'ударили ли админы по голове юзера бан-хамером? (0 - нет, 1 - да)',
  "comment_ban" varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'почему забанили пользователя',
  "avatar" varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'аватарка',
  "nickname" varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'ник',
  "status" varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'статус',
  "birthdate" int(11) NOT NULL DEFAULT '0',
  "aboutuser" varchar(1000) CHARACTER SET utf8 NOT NULL COMMENT 'о пользователе',
  "aboutuser2" varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'о пользователе (для поиска)',
  "regdate" int(11) NOT NULL,
  "lastonline" int(11) NOT NULL DEFAULT '0',
  "cssstyle" int(1) NOT NULL DEFAULT '1' COMMENT 'стиль (1 - обычный, 2 - как в старом вк, 3 - современный собственной разработки)',
  "invitecode" varchar(15) CHARACTER SET utf8 NOT NULL COMMENT 'прост',
  "telephone" varchar(255) CHARACTER SET utf8 NOT NULL,
  "email" varchar(255) CHARACTER SET utf8 NOT NULL,
  "telephone_settings" int(11) NOT NULL DEFAULT '0' COMMENT '0 - показывается друзьям, 1 - показывается всем',
  "email_settings" int(11) NOT NULL DEFAULT '0' COMMENT '0 - показывается друзьям, 1 - показывается всем',
  "advice_settings" int(11) NOT NULL DEFAULT '0',
  "ban_bugtracker" int(2) NOT NULL,
  "is_donater" int(11) NOT NULL DEFAULT '0' COMMENT 'Данный пользователь - донатер? 1 - да, 2 - нет.',
  "is_testaccount" int(11) NOT NULL DEFAULT '0' COMMENT 'перенаправлять пользоваться на страницу testaccount.php? 0 нет, 1 да',
  "rating" int(11) NOT NULL DEFAULT '100' COMMENT 'рейтинг пользователя (столько же рейтинга будет показано на странице, какое значение - такой и рейтинг)',
  "randomphrase" int(11) NOT NULL DEFAULT '0' COMMENT 'врубить на странице пользователя рандомную фразу? 1 да, 0 нет',
  "adm_lvl" int(11) NOT NULL DEFAULT '1' COMMENT 'уровень админа',
  "pagecustomstyle" int(11) NOT NULL DEFAULT '0' COMMENT 'врубить этому пользователю кастомный стиль? 0 нет, 1 стиль ВСоюзе, 2 стиль Егора, 3 дореволюционный стиль',
  "is_dead" int(11) NOT NULL DEFAULT '0' COMMENT 'Данный пользователь умер? 0 нет 1 да',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=157 ;

DROP TABLE IF EXISTS `vcomments`;
CREATE TABLE IF NOT EXISTS "vcomments" (
  "id" int(11) NOT NULL,
  "idvideo" int(11) NOT NULL COMMENT 'айди видео',
  "idauthor" int(11) NOT NULL COMMENT 'айди автора комментария',
  "date" int(11) NOT NULL,
  "text" text NOT NULL COMMENT 'текст СУКА',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=526 ;

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS "video" (
  "id" int(11) NOT NULL,
  "name" varchar(255) NOT NULL,
  "id_video" varchar(255) NOT NULL,
  "about" varchar(500) NOT NULL,
  "aid" int(11) NOT NULL,
  "date" int(11) NOT NULL,
  "category" int(11) NOT NULL COMMENT '1 - Музыка',
  "ban" int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=2560 ;

DROP TABLE IF EXISTS `wall`;
CREATE TABLE IF NOT EXISTS "wall" (
  "id" int(11) NOT NULL COMMENT 'айди поста',
  "iduser" int(11) NOT NULL COMMENT 'айди пользователя поста',
  "idwall" int(11) NOT NULL COMMENT 'айди стены',
  "text" text NOT NULL COMMENT 'текст ',
  "date" int(11) NOT NULL COMMENT 'дата',
  "image" varchar(255) NOT NULL,
  "edited" int(11) NOT NULL COMMENT '0 - нет, 1  - да',
  PRIMARY KEY ("id")
) AUTO_INCREMENT=537 ;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
