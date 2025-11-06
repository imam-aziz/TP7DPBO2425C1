CREATE DATABASE IF NOT EXISTS db_wibu
DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE db_wibu;

-- --------------------------------------------------------

--
-- Struktur Tabel untuk `studio`
--
CREATE TABLE `studio` (
  `id_studio` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_studio` VARCHAR(100) NOT NULL,
  `asal_kota` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`id_studio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Mengisi data untuk tabel `studio`
--
INSERT INTO `studio` (`id_studio`, `nama_studio`, `asal_kota`) VALUES
(1, 'MAPPA', 'Nakano, Tokyo'),
(2, 'Ufotable', 'Shinjuku, Tokyo'),
(3, 'A-1 Pictures', 'Suginami, Tokyo'),
(4, 'Kyoto Animation', 'Uji, Kyoto'),
(5, 'CoMix Wave Films', 'Chiyoda, Tokyo, Japan');


-- --------------------------------------------------------

--
-- Struktur Tabel untuk `anime`
-- (Sesuai diagram Anda)
--
CREATE TABLE `anime` (
  `id_anime` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_anime` VARCHAR(255) NOT NULL,
  `genre` VARCHAR(100) DEFAULT NULL,
  `id_studio` INT(11) NOT NULL,
  PRIMARY KEY (`id_anime`),
  KEY `fk_anime_studio` (`id_studio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Mengisi data untuk tabel `anime`
--
INSERT INTO `anime` (`id_anime`, `nama_anime`, `genre`, `id_studio`) VALUES
(1, 'Jujutsu Kaisen', 'Action, Supernatural', 1),
(2, 'Kimetsu no Yaiba', 'Action, Supernatural', 2),
(3, 'Sword Art Online', 'Action, Adventure, Fantasy', 3),
(4, 'Hyouka', 'Mystery, Slice of Life', 4),
(5, 'Kimi no Na Wa', 'Drama, Romance', 5);

-- --------------------------------------------------------

--
-- Struktur Tabel untuk `character`
-- (Sesuai diagram Anda)
--
CREATE TABLE `character` (
  `id_character` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_character` VARCHAR(100) NOT NULL,
  `jenis_kelamin` VARCHAR(50) DEFAULT NULL,
  `voice_actor` VARCHAR(100) DEFAULT NULL,
  `id_anime` INT(11) NOT NULL,
  PRIMARY KEY (`id_character`),
  KEY `fk_character_anime` (`id_anime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Mengisi data untuk tabel `character`
--
INSERT INTO `character` (`id_character`, `nama_character`, `jenis_kelamin`, `voice_actor`, `id_anime`) VALUES
(1, 'Gojou Satoru', 'Pria', 'Yuuichi Nakamura', 1),
(2, 'Itadori Yuuji', 'Pria', 'Junya Enoki', 1),
(3, 'Kamado Tanjirou', 'Pria', 'Natsuki Hanae', 2),
(4, 'Kamado Nezuko', 'Wanita', 'Akari Kito', 2),
(5, 'Kirigaya Kazuto', 'Pria', 'Yoshitsugu Matsuoka', 3),
(6, 'Yuuki Asuna', 'Wanita', 'Haruka Tomatsu', 3),
(7, 'Oreki Houtarou', 'Pria', 'Yuuichi Nakamura', 4),
(8, 'Chitanda Eru', 'Wanita', 'Satomi Satou', 4),
(9, 'Tachibana Taki', 'Pria', 'Ryunosuke Kamiki', 5),
(10, 'Miyamizu Mitsuha', 'Wanita', 'Mone Kamishiraishi', 5);

-- --------------------------------------------------------

--
-- Menambahkan Constraint (Foreign Key)
--

-- Menambahkan FK dari tabel `anime` ke `studio`
ALTER TABLE `anime`
  ADD CONSTRAINT `fk_anime_studio` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Menambahkan FK dari tabel `character` ke `anime`
ALTER TABLE `character`
  ADD CONSTRAINT `fk_character_anime` FOREIGN KEY (`id_anime`) REFERENCES `anime` (`id_anime`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;