--
-- PostgreSQL database dump
--

-- Dumped from database version 10.4 (Ubuntu 10.4-2.pgdg18.04+1)
-- Dumped by pg_dump version 10.4 (Ubuntu 10.4-2.pgdg18.04+1)

-- Started on 2018-06-15 22:26:14 -03

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 13044)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2999 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 198 (class 1259 OID 16545)
-- Name: categoria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categoria (
    id integer NOT NULL,
    nome character varying(45)
);


ALTER TABLE public.categoria OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16543)
-- Name: categoria_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categoria_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categoria_id_seq OWNER TO postgres;

--
-- TOC entry 3000 (class 0 OID 0)
-- Dependencies: 197
-- Name: categoria_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categoria_id_seq OWNED BY public.categoria.id;


--
-- TOC entry 206 (class 1259 OID 16604)
-- Name: entrada; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.entrada (
    id integer NOT NULL,
    data timestamp without time zone NOT NULL,
    categoria integer NOT NULL,
    produto integer NOT NULL,
    fornecedor integer NOT NULL,
    quantidade integer NOT NULL,
    obs text NOT NULL
);


ALTER TABLE public.entrada OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16602)
-- Name: entrada_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.entrada_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.entrada_id_seq OWNER TO postgres;

--
-- TOC entry 3001 (class 0 OID 0)
-- Dependencies: 205
-- Name: entrada_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.entrada_id_seq OWNED BY public.entrada.id;


--
-- TOC entry 202 (class 1259 OID 16571)
-- Name: fornecedor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fornecedor (
    id integer NOT NULL,
    nome text,
    telefone text,
    estado text,
    cidade text
);


ALTER TABLE public.fornecedor OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 16569)
-- Name: fornecedor_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fornecedor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fornecedor_id_seq OWNER TO postgres;

--
-- TOC entry 3002 (class 0 OID 0)
-- Dependencies: 201
-- Name: fornecedor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fornecedor_id_seq OWNED BY public.fornecedor.id;


--
-- TOC entry 200 (class 1259 OID 16553)
-- Name: produto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produto (
    id integer NOT NULL,
    categoria integer,
    nome text NOT NULL,
    estoque_minimo integer DEFAULT 0 NOT NULL,
    estoque_atual integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.produto OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 16551)
-- Name: produto_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.produto_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.produto_id_seq OWNER TO postgres;

--
-- TOC entry 3003 (class 0 OID 0)
-- Dependencies: 199
-- Name: produto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.produto_id_seq OWNED BY public.produto.id;


--
-- TOC entry 204 (class 1259 OID 16593)
-- Name: retirante; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.retirante (
    id integer NOT NULL,
    nome text,
    empresa text
);


ALTER TABLE public.retirante OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16591)
-- Name: retirante_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.retirante_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.retirante_id_seq OWNER TO postgres;

--
-- TOC entry 3004 (class 0 OID 0)
-- Dependencies: 203
-- Name: retirante_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.retirante_id_seq OWNED BY public.retirante.id;


--
-- TOC entry 208 (class 1259 OID 16615)
-- Name: saida; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.saida (
    id integer NOT NULL,
    data timestamp without time zone NOT NULL,
    categoria integer NOT NULL,
    produto integer NOT NULL,
    retirante integer NOT NULL,
    quantidade integer NOT NULL,
    obs text NOT NULL
);


ALTER TABLE public.saida OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16613)
-- Name: saida_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.saida_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.saida_id_seq OWNER TO postgres;

--
-- TOC entry 3005 (class 0 OID 0)
-- Dependencies: 207
-- Name: saida_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.saida_id_seq OWNED BY public.saida.id;


--
-- TOC entry 196 (class 1259 OID 16492)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    "user" character varying(16) NOT NULL,
    pass character varying(16) NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 2829 (class 2604 OID 16548)
-- Name: categoria id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categoria ALTER COLUMN id SET DEFAULT nextval('public.categoria_id_seq'::regclass);


--
-- TOC entry 2835 (class 2604 OID 16607)
-- Name: entrada id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entrada ALTER COLUMN id SET DEFAULT nextval('public.entrada_id_seq'::regclass);


--
-- TOC entry 2833 (class 2604 OID 16574)
-- Name: fornecedor id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fornecedor ALTER COLUMN id SET DEFAULT nextval('public.fornecedor_id_seq'::regclass);


--
-- TOC entry 2830 (class 2604 OID 16556)
-- Name: produto id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produto ALTER COLUMN id SET DEFAULT nextval('public.produto_id_seq'::regclass);


--
-- TOC entry 2834 (class 2604 OID 16596)
-- Name: retirante id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.retirante ALTER COLUMN id SET DEFAULT nextval('public.retirante_id_seq'::regclass);


--
-- TOC entry 2836 (class 2604 OID 16618)
-- Name: saida id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saida ALTER COLUMN id SET DEFAULT nextval('public.saida_id_seq'::regclass);


--
-- TOC entry 2981 (class 0 OID 16545)
-- Dependencies: 198
-- Data for Name: categoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categoria (id, nome) FROM stdin;
\.


--
-- TOC entry 2989 (class 0 OID 16604)
-- Dependencies: 206
-- Data for Name: entrada; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.entrada (id, data, categoria, produto, fornecedor, quantidade, obs) FROM stdin;
\.


--
-- TOC entry 2985 (class 0 OID 16571)
-- Dependencies: 202
-- Data for Name: fornecedor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fornecedor (id, nome, telefone, estado, cidade) FROM stdin;
\.


--
-- TOC entry 2983 (class 0 OID 16553)
-- Dependencies: 200
-- Data for Name: produto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produto (id, categoria, nome, estoque_minimo, estoque_atual) FROM stdin;
\.


--
-- TOC entry 2987 (class 0 OID 16593)
-- Dependencies: 204
-- Data for Name: retirante; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.retirante (id, nome, empresa) FROM stdin;
\.


--
-- TOC entry 2991 (class 0 OID 16615)
-- Dependencies: 208
-- Data for Name: saida; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.saida (id, data, categoria, produto, retirante, quantidade, obs) FROM stdin;
\.


--
-- TOC entry 2979 (class 0 OID 16492)
-- Dependencies: 196
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users ("user", pass) FROM stdin;
admin	admin
\.


--
-- TOC entry 3006 (class 0 OID 0)
-- Dependencies: 197
-- Name: categoria_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categoria_id_seq', 8, true);


--
-- TOC entry 3007 (class 0 OID 0)
-- Dependencies: 205
-- Name: entrada_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.entrada_id_seq', 3, true);


--
-- TOC entry 3008 (class 0 OID 0)
-- Dependencies: 201
-- Name: fornecedor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fornecedor_id_seq', 4, true);


--
-- TOC entry 3009 (class 0 OID 0)
-- Dependencies: 199
-- Name: produto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produto_id_seq', 4, true);


--
-- TOC entry 3010 (class 0 OID 0)
-- Dependencies: 203
-- Name: retirante_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.retirante_id_seq', 4, true);


--
-- TOC entry 3011 (class 0 OID 0)
-- Dependencies: 207
-- Name: saida_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.saida_id_seq', 3, true);


--
-- TOC entry 2840 (class 2606 OID 16550)
-- Name: categoria categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (id);


--
-- TOC entry 2848 (class 2606 OID 16612)
-- Name: entrada entrada_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entrada
    ADD CONSTRAINT entrada_pkey PRIMARY KEY (id);


--
-- TOC entry 2844 (class 2606 OID 16579)
-- Name: fornecedor fornecedor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fornecedor
    ADD CONSTRAINT fornecedor_pkey PRIMARY KEY (id);


--
-- TOC entry 2842 (class 2606 OID 16563)
-- Name: produto produto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produto
    ADD CONSTRAINT produto_pkey PRIMARY KEY (id);


--
-- TOC entry 2846 (class 2606 OID 16601)
-- Name: retirante retirante_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.retirante
    ADD CONSTRAINT retirante_pkey PRIMARY KEY (id);


--
-- TOC entry 2850 (class 2606 OID 16623)
-- Name: saida saida_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saida
    ADD CONSTRAINT saida_pkey PRIMARY KEY (id);


--
-- TOC entry 2838 (class 2606 OID 16496)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY ("user");


--
-- TOC entry 2851 (class 2606 OID 16564)
-- Name: produto fk_categoria; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produto
    ADD CONSTRAINT fk_categoria FOREIGN KEY (categoria) REFERENCES public.categoria(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2853 (class 2606 OID 16629)
-- Name: entrada fk_ent_categoria; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entrada
    ADD CONSTRAINT fk_ent_categoria FOREIGN KEY (categoria) REFERENCES public.categoria(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2854 (class 2606 OID 16634)
-- Name: entrada fk_fornecedor; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entrada
    ADD CONSTRAINT fk_fornecedor FOREIGN KEY (fornecedor) REFERENCES public.fornecedor(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2852 (class 2606 OID 16624)
-- Name: entrada fk_produto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entrada
    ADD CONSTRAINT fk_produto FOREIGN KEY (produto) REFERENCES public.produto(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2855 (class 2606 OID 16639)
-- Name: saida fk_sai_categoria; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saida
    ADD CONSTRAINT fk_sai_categoria FOREIGN KEY (categoria) REFERENCES public.categoria(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2856 (class 2606 OID 16644)
-- Name: saida fk_sai_prod; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saida
    ADD CONSTRAINT fk_sai_prod FOREIGN KEY (produto) REFERENCES public.produto(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2857 (class 2606 OID 16649)
-- Name: saida fk_sai_ret; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saida
    ADD CONSTRAINT fk_sai_ret FOREIGN KEY (retirante) REFERENCES public.retirante(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


-- Completed on 2018-06-15 22:26:15 -03

--
-- PostgreSQL database dump complete
--

