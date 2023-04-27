--
-- PostgreSQL database dump
--

-- Dumped from database version 15.2 (Debian 15.2-1.pgdg110+1)
-- Dumped by pg_dump version 15.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE dbname;
--
-- Name: dbname; Type: DATABASE; Schema: -; Owner: dbuser
--

CREATE DATABASE dbname WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.utf8';


ALTER DATABASE dbname OWNER TO dbuser;

\connect dbname

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: pg_database_owner
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO pg_database_owner;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: pg_database_owner
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: devices; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.devices (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    width smallint NOT NULL,
    height smallint NOT NULL,
    api_key character varying(255) NOT NULL,
    CONSTRAINT devices_check CHECK (((width * height) <= 2000))
);


ALTER TABLE public.devices OWNER TO dbuser;

--
-- Name: devices_active_workspaces; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.devices_active_workspaces (
    id_device integer NOT NULL,
    id_workspace integer NOT NULL
);


ALTER TABLE public.devices_active_workspaces OWNER TO dbuser;

--
-- Name: devices_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.devices_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.devices_id_seq OWNER TO dbuser;

--
-- Name: devices_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.devices_id_seq OWNED BY public.devices.id;


--
-- Name: devices_telemetry; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.devices_telemetry (
    id_device integer NOT NULL,
    board_temperature real,
    power_w real,
    uptime_s smallint,
    fw_ver character varying(255),
    status smallint,
    update_ts timestamp(0) without time zone
);


ALTER TABLE public.devices_telemetry OWNER TO dbuser;

--
-- Name: users; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    is_admin boolean DEFAULT false NOT NULL
);


ALTER TABLE public.users OWNER TO dbuser;

--
-- Name: users_devices; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users_devices (
    id integer NOT NULL,
    id_user integer NOT NULL,
    id_device integer NOT NULL
);


ALTER TABLE public.users_devices OWNER TO dbuser;

--
-- Name: users_devices_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.users_devices_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.users_devices_id_seq OWNER TO dbuser;

--
-- Name: users_devices_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.users_devices_id_seq OWNED BY public.users_devices.id;


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO dbuser;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: workspaces; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.workspaces (
    id integer NOT NULL,
    id_user integer NOT NULL,
    id_device integer NOT NULL,
    name character varying(255) NOT NULL,
    workspace_bytes bytea,
    CONSTRAINT workspaces_workspace_bytes_check CHECK ((octet_length(workspace_bytes) <= 2000))
);


ALTER TABLE public.workspaces OWNER TO dbuser;

--
-- Name: workspaces_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.workspaces_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.workspaces_id_seq OWNER TO dbuser;

--
-- Name: workspaces_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.workspaces_id_seq OWNED BY public.workspaces.id;


--
-- Name: devices id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.devices ALTER COLUMN id SET DEFAULT nextval('public.devices_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: users_devices id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_devices ALTER COLUMN id SET DEFAULT nextval('public.users_devices_id_seq'::regclass);


--
-- Name: workspaces id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.workspaces ALTER COLUMN id SET DEFAULT nextval('public.workspaces_id_seq'::regclass);


--
-- Data for Name: devices; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.devices (id, name, width, height, api_key) VALUES (11, 'Garden lights', 10, 3, 'apk_6446de23152fc5.16908086');
INSERT INTO public.devices (id, name, width, height, api_key) VALUES (14, 'Greenhouse', 5, 3, 'apk_6448324b7e2368.55304013');
INSERT INTO public.devices (id, name, width, height, api_key) VALUES (16, 'Wall lights', 40, 40, 'apk_644838673ce574.21084782');


--
-- Data for Name: devices_active_workspaces; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.devices_active_workspaces (id_device, id_workspace) VALUES (14, 9);
INSERT INTO public.devices_active_workspaces (id_device, id_workspace) VALUES (11, 10);
INSERT INTO public.devices_active_workspaces (id_device, id_workspace) VALUES (16, 12);


--
-- Data for Name: devices_telemetry; Type: TABLE DATA; Schema: public; Owner: dbuser
--



--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.users (id, email, password, is_admin) VALUES (13, 'admin@u1.pl', '$2y$10$.i5P0aXa78PESskRLRZJwu4hJ0omQeQ18BbffK.Al5qGLHB3qusDK', true);
INSERT INTO public.users (id, email, password, is_admin) VALUES (14, 'user1@u1.pl', '$2y$10$b/Y8k2FUCQt5yAvmUU19X.L31NmAXpxP.wWT9Qle8XsdDb9gPXXlO', false);


--
-- Data for Name: users_devices; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.users_devices (id, id_user, id_device) VALUES (16, 13, 14);
INSERT INTO public.users_devices (id, id_user, id_device) VALUES (17, 13, 11);
INSERT INTO public.users_devices (id, id_user, id_device) VALUES (19, 13, 16);


--
-- Data for Name: workspaces; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.workspaces (id, id_user, id_device, name, workspace_bytes) VALUES (9, 13, 14, 'Tomatoes', '\x31198e05830818b20102824120f058540619068742458321a8d627158bc5a291a8c46e331f8f4863b238e496210882c2e252a94c465b281800');
INSERT INTO public.workspaces (id, id_user, id_device, name, workspace_bytes) VALUES (10, 13, 11, 'Garden lights summer', '\x30160c86034808d46a2c8040a083283422030382c1e13108644a1f0b86c4e3116854461d1d8ac7e29198bc7862371c8b24e3187caa512e9640a5d2995cb64f341bcc60137984da5f35994f2813b9fce67d389d4ce7b328d47a9b21a7c92415291c72ab228dd629d25a85720c');
INSERT INTO public.workspaces (id, id_user, id_device, name, workspace_bytes) VALUES (12, 13, 16, 'Party setup', '\x321a8d4590081412070183c1611068642e1d0a88426250d88c52270f8bc5631168e46e3d1a90466451d90c92471f93c965126964ae5d2a984a6652d98cd2672f9bcd671369e4ee7d3aa04e6853da0d12873fa3d169146a652e9d4aa8526a54da8d52a74fabd56b156ae56ebd5ab0566c55db0d92c75fb3d96d166b65aedd6ab85a6e56db8dd2e76fbbdd6f176be5eefd7ac05e7057dc0e13077fc3e171186198e05830818cf2186ca62f118dc7e472796c5677139fcae7a6d98c9e4b419cd3e8b51a1d4eb759afd5e5f1da5c869335aed8eab75b8ddec37bb9de70747b3dbefb85c0e370f3232d36db999bdff478fd2e4ecb97cde273c59ced3757a938ee6d7b3d8ebf8bcbdbf1f43a7ebef7b391efb0f87d1e7f97d7d3f3da7e36ff6fa7dfdaffbe0f73bf01c0502c010240f0340304c1905c1d0441f0542109c250ab0c1a3cf0c3f30d36f0e3b50f34d10321110591244d0cc510dc530ebcf06c291742d08a0d13c54fcc6104c691646c944730fc571f47717c6521b771ebbb2246321494b148d11c5b2446ee049b24ca928c972b225124b12dc791fc8f2bca130cc131ae529cb8c0ccd313ce1886c18cd736cdf373f3364dd33caae434cc83f33d3d734cc8a34b5354e7385073aab142ce33bcfebdcf2e5cd4934fd0ad2318510f6d2b47d30c2d1af54ec9b5272949f45a234bba55251503536dbcf8ed55754d58f3d5b3e4f7473a540cd12f5394ca254454cbb57b5d53aadd5d602f15b30563582b0d78dbce944d7f5154ebe58768359642916b5a9625b36db4169da2d45b0a15c364dbe814a773d7112d4372dd93b5c69c5df6e47174dc919dd37446b1d5f4ed5eb705d7405ff6d4a978ddb812ed825fa98e112ec8382d6b7a60d88c8b80de56be29716218ad6f86e13873834fda1904cb8be3b4f6338f64b2461725e5763e4f7264594e3581e5f62e6b90def922117c5f72fe518967ea0e792067b5ce66b36879f665a0e99a5e9da069fa3ea1a9ea5aae9baa6afab6a3aceb9adebdac6bfad6c1b1ec5b2ebbb26cfb36c3b4ed9b5eddb46dfb56e08f80');


--
-- Name: devices_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.devices_id_seq', 16, true);


--
-- Name: users_devices_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.users_devices_id_seq', 19, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.users_id_seq', 15, true);


--
-- Name: workspaces_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.workspaces_id_seq', 12, true);


--
-- Name: devices_active_workspaces devices_active_workspace_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.devices_active_workspaces
    ADD CONSTRAINT devices_active_workspace_pkey PRIMARY KEY (id_device);


--
-- Name: devices devices_api_key_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.devices
    ADD CONSTRAINT devices_api_key_key UNIQUE (api_key);


--
-- Name: devices devices_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.devices
    ADD CONSTRAINT devices_pkey PRIMARY KEY (id);


--
-- Name: devices_telemetry devices_telemetry_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.devices_telemetry
    ADD CONSTRAINT devices_telemetry_pkey PRIMARY KEY (id_device);


--
-- Name: users_devices users_devices_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_devices
    ADD CONSTRAINT users_devices_pkey PRIMARY KEY (id);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: workspaces workspaces_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.workspaces
    ADD CONSTRAINT workspaces_pkey PRIMARY KEY (id);


--
-- Name: devices_id_idx; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX devices_id_idx ON public.devices USING btree (id);


--
-- Name: users_id_idx; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX users_id_idx ON public.users USING btree (id);


--
-- Name: devices_active_workspaces devices_active_workspace_id_device_fkey; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.devices_active_workspaces
    ADD CONSTRAINT devices_active_workspace_id_device_fkey FOREIGN KEY (id_device) REFERENCES public.devices(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: devices_active_workspaces devices_active_workspace_id_workspace_fkey; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.devices_active_workspaces
    ADD CONSTRAINT devices_active_workspace_id_workspace_fkey FOREIGN KEY (id_workspace) REFERENCES public.workspaces(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: devices_telemetry devices_telemetry_id_device_fkey; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.devices_telemetry
    ADD CONSTRAINT devices_telemetry_id_device_fkey FOREIGN KEY (id_device) REFERENCES public.devices(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_devices users_devices_id_device_fkey; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_devices
    ADD CONSTRAINT users_devices_id_device_fkey FOREIGN KEY (id_device) REFERENCES public.devices(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_devices users_devices_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_devices
    ADD CONSTRAINT users_devices_id_user_fkey FOREIGN KEY (id_user) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: workspaces workspaces_id_device_fkey; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.workspaces
    ADD CONSTRAINT workspaces_id_device_fkey FOREIGN KEY (id_device) REFERENCES public.devices(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: workspaces workspaces_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.workspaces
    ADD CONSTRAINT workspaces_id_user_fkey FOREIGN KEY (id_user) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

