/*
Navicat PGSQL Data Transfer

Source Server         : teste
Source Server Version : 90602
Source Host           : localhost:5432
Source Database       : postgres
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90602
File Encoding         : 65001

Date: 2017-03-13 17:16:57
*/


-- ----------------------------
-- Sequence structure for analise_idanalise_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."analise_idanalise_seq";
CREATE SEQUENCE "public"."analise_idanalise_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for comentario_idComentario_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."comentario_idComentario_seq";
CREATE SEQUENCE "public"."comentario_idComentario_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for conta_idConta_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."conta_idConta_seq";
CREATE SEQUENCE "public"."conta_idConta_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for demonstracao_idDemonstracao_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."demonstracao_idDemonstracao_seq";
CREATE SEQUENCE "public"."demonstracao_idDemonstracao_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for empresa_conta_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."empresa_conta_id_seq";
CREATE SEQUENCE "public"."empresa_conta_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for empresa_idEmpresa_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."empresa_idEmpresa_seq";
CREATE SEQUENCE "public"."empresa_idEmpresa_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for indice_idIndice_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."indice_idIndice_seq";
CREATE SEQUENCE "public"."indice_idIndice_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for notificacao_idNotificacao_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."notificacao_idNotificacao_seq";
CREATE SEQUENCE "public"."notificacao_idNotificacao_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for rodape_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."rodape_id_seq";
CREATE SEQUENCE "public"."rodape_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for tipo_empresa_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tipo_empresa_id_seq";
CREATE SEQUENCE "public"."tipo_empresa_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for tipo_indice_idTipo_indice_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tipo_indice_idTipo_indice_seq";
CREATE SEQUENCE "public"."tipo_indice_idTipo_indice_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for usuario_idUsuario_seq1
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."usuario_idUsuario_seq1";
CREATE SEQUENCE "public"."usuario_idUsuario_seq1"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;

-- ----------------------------
-- Table structure for analise
-- ----------------------------
DROP TABLE IF EXISTS "public"."analise";
CREATE TABLE "public"."analise" (
"idanalise" int2 DEFAULT nextval('analise_idanalise_seq'::regclass) NOT NULL,
"texto" text COLLATE "default",
"status" int2 NOT NULL,
"ano" int4 NOT NULL,
"investidor" int2 NOT NULL,
"credor" int2 NOT NULL,
"idEmpresa" int4 NOT NULL,
"Usuario_idUsuario" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of analise
-- ----------------------------

-- ----------------------------
-- Table structure for comentario
-- ----------------------------
DROP TABLE IF EXISTS "public"."comentario";
CREATE TABLE "public"."comentario" (
"idComentario" int2 DEFAULT nextval('"comentario_idComentario_seq"'::regclass) NOT NULL,
"conteudo" text COLLATE "default" NOT NULL,
"Empresa_idEmpresa" int2 NOT NULL,
"nome" varchar(255) COLLATE "default" NOT NULL,
"email" varchar(255) COLLATE "default" NOT NULL,
"data" date NOT NULL,
"hora" time(6) NOT NULL,
"Comentario_idComentario" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of comentario
-- ----------------------------

-- ----------------------------
-- Table structure for conta
-- ----------------------------
DROP TABLE IF EXISTS "public"."conta";
CREATE TABLE "public"."conta" (
"idConta" int2 DEFAULT nextval('"conta_idConta_seq"'::regclass) NOT NULL,
"nome" varchar(255) COLLATE "default" NOT NULL,
"idDemonstracao" int2 NOT NULL,
"chave" varchar(255) COLLATE "default" NOT NULL,
"obrigatorio" int2 NOT NULL,
"ordem" int2 NOT NULL,
"formato" int2 NOT NULL,
"pai" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of conta
-- ----------------------------

-- ----------------------------
-- Table structure for demonstracao
-- ----------------------------
DROP TABLE IF EXISTS "public"."demonstracao";
CREATE TABLE "public"."demonstracao" (
"idDemonstracao" int2 DEFAULT nextval('"demonstracao_idDemonstracao_seq"'::regclass) NOT NULL,
"nomeDemonstracao" varchar(255) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of demonstracao
-- ----------------------------

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS "public"."empresa";
CREATE TABLE "public"."empresa" (
"idEmpresa" int2 DEFAULT nextval('"empresa_idEmpresa_seq"'::regclass) NOT NULL,
"nome" varchar(255) COLLATE "default" NOT NULL,
"fonte" varchar(255) COLLATE "default" NOT NULL,
"logotipo" varchar(255) COLLATE "default",
"tipo" varchar(255) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of empresa
-- ----------------------------

-- ----------------------------
-- Table structure for empresa_conta
-- ----------------------------
DROP TABLE IF EXISTS "public"."empresa_conta";
CREATE TABLE "public"."empresa_conta" (
"id" int2 DEFAULT nextval('empresa_conta_id_seq'::regclass) NOT NULL,
"ano" int2 NOT NULL,
"valor" int8 NOT NULL,
"idEmpresa" int2 NOT NULL,
"idConta" int2 NOT NULL,
"idUsuario" int2 NOT NULL,
"statusValidacao" int2 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of empresa_conta
-- ----------------------------

-- ----------------------------
-- Table structure for empresahasusuario
-- ----------------------------
DROP TABLE IF EXISTS "public"."empresahasusuario";
CREATE TABLE "public"."empresahasusuario" (
"Empresa_idEmpresa" int2 NOT NULL,
"Usuario_idUsuario" int2 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of empresahasusuario
-- ----------------------------

-- ----------------------------
-- Table structure for indice
-- ----------------------------
DROP TABLE IF EXISTS "public"."indice";
CREATE TABLE "public"."indice" (
"idIndice" int2 DEFAULT nextval('"indice_idIndice_seq"'::regclass) NOT NULL,
"formula" varchar(255) COLLATE "default" NOT NULL,
"idTipo_Indice" int2 NOT NULL,
"nomeIndice" varchar(255) COLLATE "default",
"formato" int2 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of indice
-- ----------------------------

-- ----------------------------
-- Table structure for notificacao
-- ----------------------------
DROP TABLE IF EXISTS "public"."notificacao";
CREATE TABLE "public"."notificacao" (
"idNotificacao" int2 DEFAULT nextval('"notificacao_idNotificacao_seq"'::regclass) NOT NULL,
"Usuario_idUsuario" int2 NOT NULL,
"status" int2 NOT NULL,
"conteudo" text COLLATE "default" NOT NULL,
"tipo" int2 NOT NULL,
"idAnalise" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of notificacao
-- ----------------------------

-- ----------------------------
-- Table structure for rodape
-- ----------------------------
DROP TABLE IF EXISTS "public"."rodape";
CREATE TABLE "public"."rodape" (
"id" int2 DEFAULT nextval('rodape_id_seq'::regclass) NOT NULL,
"link" varchar(255) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of rodape
-- ----------------------------
INSERT INTO "public"."rodape" VALUES ('1', 'www.icomp.ufam.edu.br');
INSERT INTO "public"."rodape" VALUES ('2', 'www.globo.com.br');
INSERT INTO "public"."rodape" VALUES ('3', 'www.google.com.br');

-- ----------------------------
-- Table structure for tipo_empresa
-- ----------------------------
DROP TABLE IF EXISTS "public"."tipo_empresa";
CREATE TABLE "public"."tipo_empresa" (
"id" int2 DEFAULT nextval('tipo_empresa_id_seq'::regclass) NOT NULL,
"Nome" varchar(255) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tipo_empresa
-- ----------------------------
INSERT INTO "public"."tipo_empresa" VALUES ('3', 'Estrangeira');
INSERT INTO "public"."tipo_empresa" VALUES ('1', 'Local');
INSERT INTO "public"."tipo_empresa" VALUES ('2', 'Nacional');

-- ----------------------------
-- Table structure for tipo_indice
-- ----------------------------
DROP TABLE IF EXISTS "public"."tipo_indice";
CREATE TABLE "public"."tipo_indice" (
"idTipo_indice" int2 DEFAULT nextval('"tipo_indice_idTipo_indice_seq"'::regclass) NOT NULL,
"nome" varchar(255) COLLATE "default" NOT NULL,
"descricao" text COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tipo_indice
-- ----------------------------

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS "public"."usuario";
CREATE TABLE "public"."usuario" (
"login" varchar(45) COLLATE "default" NOT NULL,
"nome" varchar(45) COLLATE "default" NOT NULL,
"senha" varchar(45) COLLATE "default" NOT NULL,
"ativo" int4 NOT NULL,
"identificadorPessoa" int4 NOT NULL,
"email" varchar(45) COLLATE "default" NOT NULL,
"matricula" int4,
"idUsuario" int2 DEFAULT nextval('"usuario_idUsuario_seq1"'::regclass) NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO "public"."usuario" VALUES ('admin', 'André', '25d55ad283aa400af464c76d713c07ad', '1', '1', 'andrecosta@ufam.edu.br', null, '1');

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------
ALTER SEQUENCE "public"."analise_idanalise_seq" OWNED BY "analise"."idanalise";
ALTER SEQUENCE "public"."comentario_idComentario_seq" OWNED BY "comentario"."idComentario";
ALTER SEQUENCE "public"."conta_idConta_seq" OWNED BY "conta"."idConta";
ALTER SEQUENCE "public"."demonstracao_idDemonstracao_seq" OWNED BY "demonstracao"."idDemonstracao";
ALTER SEQUENCE "public"."empresa_conta_id_seq" OWNED BY "empresa_conta"."id";
ALTER SEQUENCE "public"."empresa_idEmpresa_seq" OWNED BY "empresa"."idEmpresa";
ALTER SEQUENCE "public"."indice_idIndice_seq" OWNED BY "indice"."idIndice";
ALTER SEQUENCE "public"."notificacao_idNotificacao_seq" OWNED BY "notificacao"."idNotificacao";
ALTER SEQUENCE "public"."rodape_id_seq" OWNED BY "rodape"."id";
ALTER SEQUENCE "public"."tipo_empresa_id_seq" OWNED BY "tipo_empresa"."id";
ALTER SEQUENCE "public"."tipo_indice_idTipo_indice_seq" OWNED BY "tipo_indice"."idTipo_indice";
ALTER SEQUENCE "public"."usuario_idUsuario_seq1" OWNED BY "usuario"."idUsuario";

-- ----------------------------
-- Uniques structure for table analise
-- ----------------------------
ALTER TABLE "public"."analise" ADD UNIQUE ("ano", "idEmpresa");

-- ----------------------------
-- Primary Key structure for table analise
-- ----------------------------
ALTER TABLE "public"."analise" ADD PRIMARY KEY ("idanalise");

-- ----------------------------
-- Primary Key structure for table comentario
-- ----------------------------
ALTER TABLE "public"."comentario" ADD PRIMARY KEY ("idComentario");

-- ----------------------------
-- Primary Key structure for table conta
-- ----------------------------
ALTER TABLE "public"."conta" ADD PRIMARY KEY ("idConta");

-- ----------------------------
-- Primary Key structure for table demonstracao
-- ----------------------------
ALTER TABLE "public"."demonstracao" ADD PRIMARY KEY ("idDemonstracao");

-- ----------------------------
-- Primary Key structure for table empresa
-- ----------------------------
ALTER TABLE "public"."empresa" ADD PRIMARY KEY ("idEmpresa");

-- ----------------------------
-- Uniques structure for table empresa_conta
-- ----------------------------
ALTER TABLE "public"."empresa_conta" ADD UNIQUE ("ano", "idEmpresa", "idConta");

-- ----------------------------
-- Primary Key structure for table empresa_conta
-- ----------------------------
ALTER TABLE "public"."empresa_conta" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table empresahasusuario
-- ----------------------------
ALTER TABLE "public"."empresahasusuario" ADD PRIMARY KEY ("Empresa_idEmpresa", "Usuario_idUsuario");

-- ----------------------------
-- Primary Key structure for table indice
-- ----------------------------
ALTER TABLE "public"."indice" ADD PRIMARY KEY ("idIndice");

-- ----------------------------
-- Primary Key structure for table notificacao
-- ----------------------------
ALTER TABLE "public"."notificacao" ADD PRIMARY KEY ("idNotificacao", "Usuario_idUsuario");

-- ----------------------------
-- Primary Key structure for table rodape
-- ----------------------------
ALTER TABLE "public"."rodape" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tipo_empresa
-- ----------------------------
ALTER TABLE "public"."tipo_empresa" ADD PRIMARY KEY ("Nome");

-- ----------------------------
-- Primary Key structure for table tipo_indice
-- ----------------------------
ALTER TABLE "public"."tipo_indice" ADD PRIMARY KEY ("idTipo_indice");

-- ----------------------------
-- Uniques structure for table usuario
-- ----------------------------
ALTER TABLE "public"."usuario" ADD UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table usuario
-- ----------------------------
ALTER TABLE "public"."usuario" ADD PRIMARY KEY ("idUsuario");

-- ----------------------------
-- Foreign Key structure for table "public"."analise"
-- ----------------------------
ALTER TABLE "public"."analise" ADD FOREIGN KEY ("Usuario_idUsuario") REFERENCES "public"."usuario" ("idUsuario") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."analise" ADD FOREIGN KEY ("idEmpresa") REFERENCES "public"."empresa" ("idEmpresa") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."comentario"
-- ----------------------------
ALTER TABLE "public"."comentario" ADD FOREIGN KEY ("Empresa_idEmpresa") REFERENCES "public"."empresa" ("idEmpresa") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."comentario" ADD FOREIGN KEY ("Comentario_idComentario") REFERENCES "public"."comentario" ("idComentario") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."conta"
-- ----------------------------
ALTER TABLE "public"."conta" ADD FOREIGN KEY ("idDemonstracao") REFERENCES "public"."demonstracao" ("idDemonstracao") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."empresa"
-- ----------------------------
ALTER TABLE "public"."empresa" ADD FOREIGN KEY ("tipo") REFERENCES "public"."tipo_empresa" ("Nome") ON DELETE SET NULL ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."empresa_conta"
-- ----------------------------
ALTER TABLE "public"."empresa_conta" ADD FOREIGN KEY ("idConta") REFERENCES "public"."conta" ("idConta") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."empresa_conta" ADD FOREIGN KEY ("idUsuario") REFERENCES "public"."usuario" ("idUsuario") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."empresa_conta" ADD FOREIGN KEY ("idEmpresa") REFERENCES "public"."empresa" ("idEmpresa") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."empresahasusuario"
-- ----------------------------
ALTER TABLE "public"."empresahasusuario" ADD FOREIGN KEY ("Empresa_idEmpresa") REFERENCES "public"."empresa" ("idEmpresa") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."empresahasusuario" ADD FOREIGN KEY ("Usuario_idUsuario") REFERENCES "public"."usuario" ("idUsuario") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Key structure for table "public"."indice"
-- ----------------------------
ALTER TABLE "public"."indice" ADD FOREIGN KEY ("idTipo_Indice") REFERENCES "public"."tipo_indice" ("idTipo_indice") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."notificacao"
-- ----------------------------
ALTER TABLE "public"."notificacao" ADD FOREIGN KEY ("idAnalise") REFERENCES "public"."analise" ("idanalise") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."notificacao" ADD FOREIGN KEY ("Usuario_idUsuario") REFERENCES "public"."usuario" ("idUsuario") ON DELETE NO ACTION ON UPDATE CASCADE;
