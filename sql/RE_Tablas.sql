--
-- Rol Errante, servidor de rol
-- TABLAS PARA GESTIONAR EL SISTEMA DE FICHAS
--
use characters;
CREATE TABLE RE_Habilidades (
  RE_ID int(10) unsigned NOT NULL DEFAULT '0',
  RE_Nombre varchar(120) NOT NULL DEFAULT '0',
  RE_Efecto varchar(120) NOT NULL DEFAULT '',
  RE_Atributo varchar(120) NOT NULL DEFAULT '',
  RE_Code varchar(255) NOT NULL DEFAULT '',
  RE_Mana int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (RE_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado de Habilidades disponibles';
CREATE TABLE RE_Atributos (
  RE_pj varchar(120) NOT NULL DEFAULT '',
  RE_Fisico int(10) unsigned NOT NULL DEFAULT '0',
  RE_Destreza int(10) unsigned NOT NULL DEFAULT '0',
  RE_Inteligencia int(10) unsigned NOT NULL DEFAULT '0',
  RE_Percepcion int(10) unsigned NOT NULL DEFAULT '0',
  RE_Mana tinyint(3) unsigned NOT NULL DEFAULT '0',
  RE_Vida tinyint(3) NOT NULL DEFAULT '0',
  RE_Iniciativa int(10) unsigned NOT NULL DEFAULT '0',
  RE_Defensa int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (RE_pj)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Listado principal de jugadores y atributos';
CREATE TABLE RE_Habilidades_pj (
  RE_ID int(10) unsigned NOT NULL,
  RE_pj varchar(120) NOT NULL DEFAULT '',
  RE_Valor int(10) NOT NULL DEFAULT '0',
  RE_Efecto varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (RE_ID,RE_pj)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Asignacion de habilidades a pj';
CREATE TABLE RE_Atributos_SOL (
  RE_Account varchar(120) NOT NULL DEFAULT '',
  RE_pj varchar(120) NOT NULL DEFAULT '',
  RE_Fisico int(10) unsigned NOT NULL DEFAULT '0',
  RE_Destreza int(10) unsigned NOT NULL DEFAULT '0',
  RE_Inteligencia int(10) unsigned NOT NULL DEFAULT '0',
  RE_Percepcion int(10) unsigned NOT NULL DEFAULT '0',
  RE_Mana tinyint(3) unsigned NOT NULL DEFAULT '0',
  RE_Vida tinyint(3) NOT NULL DEFAULT '0',
  RE_Iniciativa int(10) unsigned NOT NULL DEFAULT '0',
  RE_Defensa int(10) unsigned NOT NULL DEFAULT '0',
  RE_Status int(10) unsigned NOT NULL DEFAULT '0',
  RE_DateUpd bigint(15) unsigned NOT NULL DEFAULT '0',
  RE_Inspect varchar(30) NOT NULL DEFAULT '',
  RE_SHA varchar(120) NOT NULL DEFAULT '',
  RE_Comments varchar(512) DEFAULT NULL,
  PRIMARY KEY (RE_pj)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Solicitudes Atributos';
CREATE TABLE RE_Habilidades_pj_SOL (
  RE_ID int(10) unsigned NOT NULL DEFAULT '0',
  RE_Pj varchar(30) NOT NULL DEFAULT '',
  RE_Valor varchar(120) NOT NULL DEFAULT '0',
  RE_Efecto varchar(120) NOT NULL DEFAULT '',
  RE_Status tinyint(3) NOT NULL DEFAULT '0',
  RE_DateUpd bigint(15) unsigned NOT NULL DEFAULT '0',
  RE_Inspect varchar(30) NOT NULL DEFAULT '',
  RE_SHA varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (RE_ID,RE_Pj)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Solicitudes Habilidad';

