--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.6
-- Dumped by pg_dump version 9.5.6

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: analise; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE analise (
    idanalise smallint NOT NULL,
    texto text,
    status smallint NOT NULL,
    ano integer NOT NULL,
    investidor smallint NOT NULL,
    credor smallint NOT NULL,
    "idEmpresa" integer NOT NULL,
    "Usuario_idUsuario" integer NOT NULL
);


ALTER TABLE analise OWNER TO postgres;

--
-- Name: analise_idanalise_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE analise_idanalise_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE analise_idanalise_seq OWNER TO postgres;

--
-- Name: analise_idanalise_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE analise_idanalise_seq OWNED BY analise.idanalise;


--
-- Name: comentario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE comentario (
    "idComentario" smallint NOT NULL,
    conteudo text NOT NULL,
    "Empresa_idEmpresa" smallint NOT NULL,
    nome character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    data date NOT NULL,
    hora time(6) without time zone NOT NULL,
    "Comentario_idComentario" integer
);


ALTER TABLE comentario OWNER TO postgres;

--
-- Name: comentario_idComentario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "comentario_idComentario_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "comentario_idComentario_seq" OWNER TO postgres;

--
-- Name: comentario_idComentario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "comentario_idComentario_seq" OWNED BY comentario."idComentario";


--
-- Name: conta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE conta (
    "idConta" smallint NOT NULL,
    nome character varying(255) NOT NULL,
    "idDemonstracao" smallint NOT NULL,
    chave character varying(255) NOT NULL,
    obrigatorio smallint NOT NULL,
    formato smallint NOT NULL,
    codigo character varying(255) NOT NULL,
    pai boolean NOT NULL
);


ALTER TABLE conta OWNER TO postgres;

--
-- Name: conta_idConta_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "conta_idConta_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "conta_idConta_seq" OWNER TO postgres;

--
-- Name: conta_idConta_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "conta_idConta_seq" OWNED BY conta."idConta";


--
-- Name: demonstracao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE demonstracao (
    "idDemonstracao" smallint NOT NULL,
    "nomeDemonstracao" character varying(255) NOT NULL,
     contaPai smallint NULL,
     ordem smallint
);


ALTER TABLE demonstracao OWNER TO postgres;

--
-- Name: demonstracao_idDemonstracao_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "demonstracao_idDemonstracao_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "demonstracao_idDemonstracao_seq" OWNER TO postgres;

--
-- Name: demonstracao_idDemonstracao_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "demonstracao_idDemonstracao_seq" OWNED BY demonstracao."idDemonstracao";


--
-- Name: empresa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE empresa (
    "idEmpresa" smallint NOT NULL,
    nome character varying(255) NOT NULL,
    fonte character varying(255) NOT NULL,
    logotipo character varying(255),
    tipo character varying(255) NOT NULL
);


ALTER TABLE empresa OWNER TO postgres;

--
-- Name: empresa_conta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE empresa_conta (
    id smallint NOT NULL,
    ano smallint NOT NULL,
    valor bigint NOT NULL,
    "idEmpresa" smallint NOT NULL,
    "idConta" smallint NOT NULL,
    "idUsuario" smallint NOT NULL,
    "statusValidacao" smallint NOT NULL
);


ALTER TABLE empresa_conta OWNER TO postgres;

--
-- Name: empresa_conta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE empresa_conta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE empresa_conta_id_seq OWNER TO postgres;

--
-- Name: empresa_conta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE empresa_conta_id_seq OWNED BY empresa_conta.id;


--
-- Name: empresa_idEmpresa_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "empresa_idEmpresa_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "empresa_idEmpresa_seq" OWNER TO postgres;

--
-- Name: empresa_idEmpresa_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "empresa_idEmpresa_seq" OWNED BY empresa."idEmpresa";


--
-- Name: empresahasusuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE empresahasusuario (
    "Empresa_idEmpresa" smallint NOT NULL,
    "Usuario_idUsuario" smallint NOT NULL
);


ALTER TABLE empresahasusuario OWNER TO postgres;

--
-- Name: indice; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE indice (
    "idIndice" smallint NOT NULL,
    formula character varying(255) NOT NULL,
    "idTipo_Indice" smallint NOT NULL,
    "nomeIndice" character varying(255),
    formato smallint NOT NULL
);


ALTER TABLE indice OWNER TO postgres;

--
-- Name: indice_idIndice_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "indice_idIndice_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "indice_idIndice_seq" OWNER TO postgres;

--
-- Name: indice_idIndice_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "indice_idIndice_seq" OWNED BY indice."idIndice";


--
-- Name: notificacao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE notificacao (
    "idNotificacao" smallint NOT NULL,
    "Usuario_idUsuario" smallint NOT NULL,
    status smallint NOT NULL,
    conteudo text NOT NULL,
    tipo smallint NOT NULL,
    "idAnalise" smallint
);


ALTER TABLE notificacao OWNER TO postgres;

--
-- Name: notificacao_idNotificacao_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "notificacao_idNotificacao_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "notificacao_idNotificacao_seq" OWNER TO postgres;

--
-- Name: notificacao_idNotificacao_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "notificacao_idNotificacao_seq" OWNED BY notificacao."idNotificacao";


--
-- Name: rodape; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE rodape (
    id smallint NOT NULL,
    link character varying(255) NOT NULL
);


ALTER TABLE rodape OWNER TO postgres;

--
-- Name: rodape_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rodape_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rodape_id_seq OWNER TO postgres;

--
-- Name: rodape_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rodape_id_seq OWNED BY rodape.id;


--
-- Name: tipo_empresa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipo_empresa (
    id smallint NOT NULL,
    "Nome" character varying(255) NOT NULL
);


ALTER TABLE tipo_empresa OWNER TO postgres;

--
-- Name: tipo_empresa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipo_empresa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipo_empresa_id_seq OWNER TO postgres;

--
-- Name: tipo_empresa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipo_empresa_id_seq OWNED BY tipo_empresa.id;


--
-- Name: tipo_indice; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipo_indice (
    "idTipo_Indice" smallint NOT NULL,
    nome character varying(255) NOT NULL,
    descricao text
);


ALTER TABLE tipo_indice OWNER TO postgres;

--
-- Name: tipo_indice_idTipo_Indice_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "tipo_indice_idTipo_Indice_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "tipo_indice_idTipo_Indice_seq" OWNER TO postgres;

--
-- Name: tipo_indice_idTipo_Indice_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "tipo_indice_idTipo_Indice_seq" OWNED BY tipo_indice."idTipo_Indice";


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE usuario (
    login character varying(45) NOT NULL,
    nome character varying(45) NOT NULL,
    senha character varying(45) NOT NULL,
    ativo integer NOT NULL,
    "identificadorPessoa" integer NOT NULL,
    email character varying(45) NOT NULL,
    matricula integer,
    "idUsuario" smallint NOT NULL
);


ALTER TABLE usuario OWNER TO postgres;

--
-- Name: usuario_idUsuario_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "usuario_idUsuario_seq1"
    START WITH 2
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "usuario_idUsuario_seq1" OWNER TO postgres;

--
-- Name: usuario_idUsuario_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "usuario_idUsuario_seq1" OWNED BY usuario."idUsuario";


--
-- Name: idanalise; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY analise ALTER COLUMN idanalise SET DEFAULT nextval('analise_idanalise_seq'::regclass);


--
-- Name: idComentario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comentario ALTER COLUMN "idComentario" SET DEFAULT nextval('"comentario_idComentario_seq"'::regclass);


--
-- Name: idConta; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY conta ALTER COLUMN "idConta" SET DEFAULT nextval('"conta_idConta_seq"'::regclass);


--
-- Name: idDemonstracao; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY demonstracao ALTER COLUMN "idDemonstracao" SET DEFAULT nextval('"demonstracao_idDemonstracao_seq"'::regclass);


--
-- Name: idEmpresa; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa ALTER COLUMN "idEmpresa" SET DEFAULT nextval('"empresa_idEmpresa_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa_conta ALTER COLUMN id SET DEFAULT nextval('empresa_conta_id_seq'::regclass);


--
-- Name: idIndice; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY indice ALTER COLUMN "idIndice" SET DEFAULT nextval('"indice_idIndice_seq"'::regclass);


--
-- Name: idNotificacao; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notificacao ALTER COLUMN "idNotificacao" SET DEFAULT nextval('"notificacao_idNotificacao_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rodape ALTER COLUMN id SET DEFAULT nextval('rodape_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_empresa ALTER COLUMN id SET DEFAULT nextval('tipo_empresa_id_seq'::regclass);


--
-- Name: idTipo_Indice; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_indice ALTER COLUMN "idTipo_Indice" SET DEFAULT nextval('"tipo_indice_idTipo_Indice_seq"'::regclass);


--
-- Name: idUsuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario ALTER COLUMN "idUsuario" SET DEFAULT nextval('"usuario_idUsuario_seq1"'::regclass);


--
-- Data for Name: analise; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY analise (idanalise, texto, status, ano, investidor, credor, "idEmpresa", "Usuario_idUsuario") FROM stdin;
\.


--
-- Name: analise_idanalise_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('analise_idanalise_seq', 1, false);


--
-- Data for Name: comentario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY comentario ("idComentario", conteudo, "Empresa_idEmpresa", nome, email, data, hora, "Comentario_idComentario") FROM stdin;
\.


--
-- Name: comentario_idComentario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"comentario_idComentario_seq"', 1, false);


--
-- Data for Name: conta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY conta ("idConta", nome, "idDemonstracao", chave, obrigatorio, formato, codigo, pai) FROM stdin;
37	Variação em estoques	3	#VE	1	4	5.08	false
38	Variação em fornecedores	3	#VF	1	4	5.09	false
39	Variação em imposto de renda a recolher	3	#VIRR	0	4	5.10	false
35	Variações nos ativos e passivos	3	#VAT	1	4	5.11	false
46	Outras Atividades Operacionais	3	#OAO	0	4	5.12	false
85	Fornecedores	2	#PNCforn	0	4	2.02.01	false
84	Contas a pagar	2	#PNCcont	0	4	2.02.02	false
83	Obrigações sociais e trabalhistas	2	#PNCosoc	0	4	2.02.03	false
86	Partes Relacionadas	2	PNCnonPR	0	4	2.02.05	false
41	FLUXOS DE CAIXA DAS ATIVIDADES DE INVESTIMENTOS	3	#FCAI	1	4	5.14	false
90	Obrigações com debenturistas	2	#PNCdeb	0	4	2.02.04	false
88	Empréstimos e financiamentos	2	PNCemp	0	4	2.02.06	false
42	Compras de imobilizado	3	#CI	1	4	5.15	false
43	Aquisição de ações/cotas	3	#AA	1	4	5.16	false
44	Recebimentos por vendas de ativos permanentes	3	#RVAT	1	4	5.17	false
48	Outras Atividades de Investimento	3	#OAI	0	4	5.18	false
45	Disponibilidades líquidas geradas pelas (aplicadas nas) atividades de investimentos	3	#DLGAI	1	4	5.19	false
47	FLUXOS DE CAIXA DAS ATIVIDADES DE FINANCIAMENTOS	3	#FXAF	1	4	5.20	false
49	Integralização de capital	3	#IC	1	4	5.21	false
50	Pagamentos de dividendos	3	#PD	1	4	5.22	false
51	Empréstimos tomados	3	#ET	1	4	5.23	false
52	Pagamentos de empréstimos/debêntures	3	#PED	1	4	5.24	false
53	Juros recebidos de empréstimos	3	#JRE	0	4	5.25	false
54	Juros pagos por empréstimos	3	#JPE	0	4	5.26	false
55	Outras Atividades de Financiamento	3	#OAF	0	4	5.27	false
56	Disponibilidades líquidas geradas pelas (aplicadas nas) atividades de financiamentos	3	#DLGAF	1	4	5.28	false
57	Variação de Caixa e Equivalentes	3	#VCE	1	4	5.29	false
58	Saldo Inicial de Caixa e Equivalentes	3	#SICE	1	4	5.30	false
59	Saldo Final de Caixa e Equivalentes 	3	#SFCE	1	4	5.31	false
94	Ajustes de avaliação patrimonial	2	#AVP	0	4	2.03.07	false
80	Passivo não Circulante	2	#PnC	1	4	2.02	false
102	Reserva estatutária	2	Resest	0	4	2.03.03	false
93	Reserva de capital	2	#Rcap	0	4	2.03.02	false
95	Reserva de lucros	2	#Rlucros	0	4	2.03.04	false
13	Despesas Financeiras	1	#DF	1	4	3.16	false
12	Receitas Financeiras	1	#RF	1	4	3.17	false
11	LUCRO OPERACIONAL	1	#LO	1	4	3.18	false
103	Outras receitas	1	#OR	1	4	3.19	false
9	Despesas Administrativas	1	#DA	1	4	3.11	false
28	Imposto de renda e contribuição social diferidos	1	#IRCSDIF	0	4	3.23	false
98	DESPESAS (RECEITAS) OPERACIONAIS	1	#RO	1	4	3.10	false
16	Lucro (Prejuízo) Líquido do Exercício	1	#LL	1	4	3.25	false
105	Participação nos lucros ou resultados	1	#PLR	0	4	3.24	false
106	Outras contas passivo não circulante 	2	#OCPNC	1	4	2.02.07	false
91	PATRIMÔNIO LÍQUIDO	2	#PL	1	4	2.03	false
92	Capital social	2	#CAP	1	4	2.03.01	false
96	Ações em tesouraria	2	#Atesou	0	4	2.03.05	false
97	Participação dos não controladores	2	#Partncon	0	4	2.03.06	false
8	Despesas com vendas	1	#DV	1	4	3.12	false
10	Outras receitas operacionais	1	#ORO	1	4	3.14	false
99	Outras despesas operacionais	1	#ODO	1	4	3.13	false
29	FLUXOS DE CAIXA DAS ATIVIDADES OPERACIONAIS 	3	#AO	1	4	5.01	false
30	Lucro Líquido do Exercício	3	#LL	1	4	5.02	false
31	(+/-) Ajustes para conciliar o resultado às disponibilidades geradas pelas atividades operacionais	3	#ACRD	0	4	5.03	false
32	Depreciação e amortização	3	#DA	1	4	5.04	false
33	Recebimento de lucros e dividendos de subsidiárias	3	#RLDS	0	4	5.05	false
34	Equivalência patrimonial	3	#EP	0	4	5.06	false
36	Variação em duplicatas a receber	3	#VDR	1	4	5.07	false
40	Disponibilidades líquidas geradas pelas (aplicadas nas) atividades operacionais	3	#DLGAO	1	4	5.13	false
20	Clientes	2	#Cl	1	4	1.01.03	false
100	Aplicações financeiras	2	Aplicfin	1	4	1.01.02	false
65	Partes Relacionadas	2	#PRCirc	0	4	1.02.01.01	false
73	Fornecedores	2	#Forn	1	4	2.01.01	false
63	RECEITA LÍQUIDA	1	#RL	1	4	3.03	true
61	RECEITA LÍQUIDA COM VENDAS DE PRODUTOS OU MERCADORIAS	1	#RLVPM	0	4	3.04	false
62	RECEITA LÍQUIDA COM PRESTAÇÃO DE SERVIÇOS	1	#RLPS	0	4	3.05	false
64	Custo das Mercadorias Vendidas	1	#cmv	0	4	3.06	false
5	Custo dos Produtos Vendidos	1	#CPV	0	4	3.07	false
60	Custo dos Serviços Prestados	1	#CSP	0	4	3.08	false
75	Obrigações fiscais	2	#Ofis	1	4	2.01.02	false
6	LUCRO BRUTO	1	#LB	1	4	3.09	false
74	Partes Relacionadas	2	#PRpCirc	0	4	2.01.04	false
78	Obrigações com debenturistas	2	#PCdeb	0	4	2.01.06	false
79	Dividendos a pagar	2	#PCdiv	0	4	2.01.07	false
77	Empréstimos e financiamentos	2	#PCemp	1	4	2.01.09	false
82	Outros passivos circulantes	2	#Outrospc	0	4	2.01.10	false
17	ATIVO	2	#AT	1	4	1	true
19	Disponibilidades	2	#Disp	1	4	1.01.01	false
18	Ativo Circulante	2	#AC	1	4	1.01	false
23	Ativo Não Circulante	2	#ANC	1	4	1.02	false
24	Realizável a Longo Prazo	2	#ARLP	1	4	1.02.01	false
25	Investimentos	2	#Inv	1	4	1.02.02	false
26	Imobilizado	2	#Imob	1	4	1.02.03	false
27	Intangível	2	#Int	1	4	1.02.04	false
69	Passivo Circulante	2	#PC	1	4	2.01	false
21	Estoques	2	#Est	1	4	1.01.04	false
71	Obrigações sociais e trabalhistas	2	#Osoc	1	4	2.01.05	false
67	PASSIVO E PATRIMÔNIO LÍQUIDO	2	#PPL	1	4	2	false
104	Outras despesas	1	#OD	1	4	3.20	false
66	Partes Relacionadas	2	#PRNcirc	0	4	1.01.05	false
15	Imposto de renda e contribuição social corrente	1	#IRCSCO	0	4	3.22	false
22	Outros Ativo Circulante	2	#OAC	1	4	1.01.06	false
101	Outros ativos realizáveis a longo prazo	2	Outrosrlp	0	4	1.02.01.02	false
14	LUCRO (PREJUÍZO) ANTES DOS IMPOSTOS	1	#LAIR	1	4	3.21	false
72	Contas a pagar	2	#CP	1	4	2.01.03	false
\.


--
-- Name: conta_idConta_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"conta_idConta_seq"', 106, true);


--
-- Data for Name: demonstracao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY demonstracao ("idDemonstracao", "nomeDemonstracao", contaPai, ordem) FROM stdin;
1	DRE - Demonstração do Resultado de Exercício	63	2 
2	BP - BALANÇO PATRIMONIAL	17	1
3	DFC - Demonstração dos Fluxos de Caixa	0	3 
\.


--
-- Name: demonstracao_idDemonstracao_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"demonstracao_idDemonstracao_seq"', 3, true);


--
-- Data for Name: empresa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY empresa ("idEmpresa", nome, fonte, logotipo, tipo) FROM stdin;
5	Moto honda	www.honda.com	Churchill.jpg	Nacional
7	Moto honda	www.honda.com	Churchill.jpg	Nacional
2	B2W - COMPANHIA DIGITAL	https://www.b2wdigital.com/	logo.png	Nacional
3	MOTO HONDA DA AMAZÔNIA	https://www14.honda.com.br/sobre-a-honda/no-b	Honda+honda+jpg1269350615-v1.jpg	Local
6	JHSF	www.jhsf.com.br	JHSF4.jpg	Nacional
4	Ambev	www.ambev.com.nr	ambev-1.jpg	Nacional
8	Brasil	www.brasil.com.br	Churchill.jpg	Nacional
11	Alfa	www.alfa.com.br	Churchill.jpg	Nacional
12	Alfa	www.alfa.com.br	templateAmazonCompanies (10).xls.htm	Nacional
\.


--
-- Data for Name: empresa_conta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY empresa_conta (id, ano, valor, "idEmpresa", "idConta", "idUsuario", "statusValidacao") FROM stdin;
\.


--
-- Name: empresa_conta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('empresa_conta_id_seq', 944, true);


--
-- Name: empresa_idEmpresa_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"empresa_idEmpresa_seq"', 12, true);


--
-- Data for Name: empresahasusuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY empresahasusuario ("Empresa_idEmpresa", "Usuario_idUsuario") FROM stdin;
\.


--
-- Data for Name: indice; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY indice ("idIndice", formula, "idTipo_Indice", "nomeIndice", formato) FROM stdin;
1	#DED + #DV	1	teste	4
2	#DED+#DV	1	teste	4
3	#DED	1	teste	4
4	#cmv + 2	1	teste	4
\.


--
-- Name: indice_idIndice_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"indice_idIndice_seq"', 1, false);


--
-- Data for Name: notificacao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY notificacao ("idNotificacao", "Usuario_idUsuario", status, conteudo, tipo, "idAnalise") FROM stdin;
\.


--
-- Name: notificacao_idNotificacao_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"notificacao_idNotificacao_seq"', 1, false);


--
-- Data for Name: rodape; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rodape (id, link) FROM stdin;
1	www.icomp.ufam.edu.br
2	www.globo.com.br
3	www.google.com.br
\.


--
-- Name: rodape_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rodape_id_seq', 1, false);


--
-- Data for Name: tipo_empresa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo_empresa (id, "Nome") FROM stdin;
3	Estrangeira
1	Local
2	Nacional
\.


--
-- Name: tipo_empresa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipo_empresa_id_seq', 1, false);


--
-- Data for Name: tipo_indice; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo_indice ("idTipo_Indice", nome, descricao) FROM stdin;
1	Liquidez	Liquidez
\.


--
-- Name: tipo_indice_idTipo_Indice_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"tipo_indice_idTipo_Indice_seq"', 1, false);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario (login, nome, senha, ativo, "identificadorPessoa", email, matricula, "idUsuario") FROM stdin;
admin	André	25d55ad283aa400af464c76d713c07ad	1	1	andrecosta@ufam.edu.br	\N	1
André	André Ricardo Reis Costa	b247f02dbe92e1f2410e23bb5596cb71	1	1	andre_ricardo86@hotmail.com	22614904	2
sandremartins 	Alessandre Martins	d44c4b1bcacca64754b2d45ef494779c	1	1	sandremartins@icomp.ufam.edu.br	12345678	3
sandremartins2	Alessandre Martins	c0f2fa03d2d808aaad9a69a2a0c2aea1	1	1	sandremartins@gmail.com	45674321	4
NATÁLIA	NATÁLIA BARBOSA DE MELO	f256087e6161e5c3a48fcb61cc1eec62	1	1	nataliabmelo@outlook.com	21350532	5
LG	Luiz Gustavo	7b54d81f2f1c18a0bcbf744cea2a3131	1	1	lgpa@icomp.ufam.edu.br	21351818	7
ANA CAROLINE	ANA CAROLINE DA SILVA JESUS	cc4e8a72cad450b907d5d071315e18da	1	1	carolmaps@hotmail.com	21351602	6
MÔNICA	Mônica Carolini Rodrigues de Alencar	89a8b29ebd419901b341249235616a8d	1	1	moonica.alencar85@gmail.com	21354562	10
gleyci_mendes	Gleyciane Mendes Moreira	5c9befa5bd62168f432de6c00d02d037	1	2	gleyci.mendes.83@gmail.com	21454647	11
\.


--
-- Name: usuario_idUsuario_seq1; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"usuario_idUsuario_seq1"', 11, true);


--
-- Name: analise_ano_idEmpresa_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY analise
    ADD CONSTRAINT "analise_ano_idEmpresa_key" UNIQUE (ano, "idEmpresa");


--
-- Name: analise_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY analise
    ADD CONSTRAINT analise_pkey PRIMARY KEY (idanalise);


--
-- Name: comentario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comentario
    ADD CONSTRAINT comentario_pkey PRIMARY KEY ("idComentario");


--
-- Name: conta_codigo_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY conta
    ADD CONSTRAINT conta_codigo_key UNIQUE (codigo);


--
-- Name: conta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY conta
    ADD CONSTRAINT conta_pkey PRIMARY KEY ("idConta");


--
-- Name: demonstracao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY demonstracao
    ADD CONSTRAINT demonstracao_pkey PRIMARY KEY ("idDemonstracao");


--
-- Name: empresa_conta_ano_idEmpresa_idConta_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa_conta
    ADD CONSTRAINT "empresa_conta_ano_idEmpresa_idConta_key" UNIQUE (ano, "idEmpresa", "idConta");


--
-- Name: empresa_conta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa_conta
    ADD CONSTRAINT empresa_conta_pkey PRIMARY KEY (id);


--
-- Name: empresa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_pkey PRIMARY KEY ("idEmpresa");


--
-- Name: empresahasusuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresahasusuario
    ADD CONSTRAINT empresahasusuario_pkey PRIMARY KEY ("Empresa_idEmpresa", "Usuario_idUsuario");


--
-- Name: indice_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY indice
    ADD CONSTRAINT indice_pkey PRIMARY KEY ("idIndice");


--
-- Name: notificacao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notificacao
    ADD CONSTRAINT notificacao_pkey PRIMARY KEY ("idNotificacao", "Usuario_idUsuario");


--
-- Name: rodape_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rodape
    ADD CONSTRAINT rodape_pkey PRIMARY KEY (id);


--
-- Name: tipo_empresa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_empresa
    ADD CONSTRAINT tipo_empresa_pkey PRIMARY KEY ("Nome");


--
-- Name: tipo_indice_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_indice
    ADD CONSTRAINT tipo_indice_pkey PRIMARY KEY ("idTipo_Indice");


--
-- Name: usuario_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_email_key UNIQUE (email);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY ("idUsuario");


--
-- Name: analise_Usuario_idUsuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY analise
    ADD CONSTRAINT "analise_Usuario_idUsuario_fkey" FOREIGN KEY ("Usuario_idUsuario") REFERENCES usuario("idUsuario");


--
-- Name: analise_idEmpresa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY analise
    ADD CONSTRAINT "analise_idEmpresa_fkey" FOREIGN KEY ("idEmpresa") REFERENCES empresa("idEmpresa") ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: comentario_Comentario_idComentario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comentario
    ADD CONSTRAINT "comentario_Comentario_idComentario_fkey" FOREIGN KEY ("Comentario_idComentario") REFERENCES comentario("idComentario") ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: comentario_Empresa_idEmpresa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comentario
    ADD CONSTRAINT "comentario_Empresa_idEmpresa_fkey" FOREIGN KEY ("Empresa_idEmpresa") REFERENCES empresa("idEmpresa") ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: conta_idDemonstracao_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY conta
    ADD CONSTRAINT "conta_idDemonstracao_fkey" FOREIGN KEY ("idDemonstracao") REFERENCES demonstracao("idDemonstracao") ON UPDATE CASCADE ON DELETE CASCADE;

--
-- Name: empresa_conta_idConta_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa_conta
    ADD CONSTRAINT "empresa_conta_idConta_fkey" FOREIGN KEY ("idConta") REFERENCES conta("idConta") ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: empresa_conta_idEmpresa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa_conta
    ADD CONSTRAINT "empresa_conta_idEmpresa_fkey" FOREIGN KEY ("idEmpresa") REFERENCES empresa("idEmpresa") ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: empresa_conta_idUsuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa_conta
    ADD CONSTRAINT "empresa_conta_idUsuario_fkey" FOREIGN KEY ("idUsuario") REFERENCES usuario("idUsuario");


--
-- Name: empresa_tipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_tipo_fkey FOREIGN KEY (tipo) REFERENCES tipo_empresa("Nome") ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: empresahasusuario_Empresa_idEmpresa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresahasusuario
    ADD CONSTRAINT "empresahasusuario_Empresa_idEmpresa_fkey" FOREIGN KEY ("Empresa_idEmpresa") REFERENCES empresa("idEmpresa");


--
-- Name: empresahasusuario_Usuario_idUsuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresahasusuario
    ADD CONSTRAINT "empresahasusuario_Usuario_idUsuario_fkey" FOREIGN KEY ("Usuario_idUsuario") REFERENCES usuario("idUsuario");


--
-- Name: indice_idTipo_Indice_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY indice
    ADD CONSTRAINT "indice_idTipo_Indice_fkey" FOREIGN KEY ("idTipo_Indice") REFERENCES tipo_indice("idTipo_Indice") ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: notificacao_Usuario_idUsuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notificacao
    ADD CONSTRAINT "notificacao_Usuario_idUsuario_fkey" FOREIGN KEY ("Usuario_idUsuario") REFERENCES usuario("idUsuario") ON UPDATE CASCADE;


--
-- Name: notificacao_idAnalise_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notificacao
    ADD CONSTRAINT "notificacao_idAnalise_fkey" FOREIGN KEY ("idAnalise") REFERENCES analise(idanalise) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

