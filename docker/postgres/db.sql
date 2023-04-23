/*
 Navicat Premium Data Transfer

 Source Server         : dbname
 Source Server Type    : PostgreSQL
 Source Server Version : 150002 (150002)
 Source Host           : localhost:5432
 Source Catalog        : dbname
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 150002 (150002)
 File Encoding         : 65001

 Date: 22/04/2023 16:36:51
*/


-- ----------------------------
-- Sequence structure for devices_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."devices_id_seq";
CREATE SEQUENCE "public"."devices_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_devices_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_devices_id_seq";
CREATE SEQUENCE "public"."users_devices_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_id_seq";
CREATE SEQUENCE "public"."users_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for workspaces_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."workspaces_id_seq";
CREATE SEQUENCE "public"."workspaces_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for devices
-- ----------------------------
DROP TABLE IF EXISTS "public"."devices";
CREATE TABLE "public"."devices" (
  "id" int4 NOT NULL DEFAULT nextval('devices_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "width" int2 NOT NULL,
  "height" int2 NOT NULL,
  "api_key" varchar(255) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of devices
-- ----------------------------
INSERT INTO "public"."devices" VALUES (2, 'Device 2', 48, 32, '0imfnc8mVLWwsAawjYr4R');
INSERT INTO "public"."devices" VALUES (3, 'Device 3', 48, 32, 'sAawjYr4Rx-Af50DDqtlxAt');
INSERT INTO "public"."devices" VALUES (1, 'Device 1', 48, 32, 'zaCELgL.0imfnc8mVLWwy');
INSERT INTO "public"."devices" VALUES (4, 'Device 4', 48, 32, 'asddasdasdasdasdasdas');

-- ----------------------------
-- Table structure for devices_active_workspaces
-- ----------------------------
DROP TABLE IF EXISTS "public"."devices_active_workspaces";
CREATE TABLE "public"."devices_active_workspaces" (
  "id_device" int4 NOT NULL,
  "id_workspace" int4 NOT NULL
)
;

-- ----------------------------
-- Records of devices_active_workspaces
-- ----------------------------
INSERT INTO "public"."devices_active_workspaces" VALUES (1, 1);
INSERT INTO "public"."devices_active_workspaces" VALUES (2, 1);

-- ----------------------------
-- Table structure for devices_telemetry
-- ----------------------------
DROP TABLE IF EXISTS "public"."devices_telemetry";
CREATE TABLE "public"."devices_telemetry" (
  "id_device" int4 NOT NULL,
  "board_temperature" float4,
  "power_w" float4,
  "uptime_s" int2,
  "fw_ver" varchar(255) COLLATE "pg_catalog"."default",
  "status" int2,
  "update_ts" timestamp(0)
)
;

-- ----------------------------
-- Records of devices_telemetry
-- ----------------------------
INSERT INTO "public"."devices_telemetry" VALUES (1, 25, 7, 3800, '1.13.0_beta', 5, '2023-04-21 21:18:57');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "id" int4 NOT NULL DEFAULT nextval('users_id_seq'::regclass),
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "password" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "is_admin" bool NOT NULL DEFAULT false
)
;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES (2, 'user2@u2.pl', 'asd', 'f');
INSERT INTO "public"."users" VALUES (3, 'user3@u3.pl', 'asd', 'f');
INSERT INTO "public"."users" VALUES (1, 'user1@u1.pl', 'admin', 't');

-- ----------------------------
-- Table structure for users_devices
-- ----------------------------
DROP TABLE IF EXISTS "public"."users_devices";
CREATE TABLE "public"."users_devices" (
  "id" int4 NOT NULL DEFAULT nextval('users_devices_id_seq'::regclass),
  "id_user" int4 NOT NULL,
  "id_device" int4 NOT NULL
)
;

-- ----------------------------
-- Records of users_devices
-- ----------------------------
INSERT INTO "public"."users_devices" VALUES (1, 1, 1);
INSERT INTO "public"."users_devices" VALUES (2, 1, 2);
INSERT INTO "public"."users_devices" VALUES (3, 1, 3);
INSERT INTO "public"."users_devices" VALUES (5, 3, 3);
INSERT INTO "public"."users_devices" VALUES (4, 2, 2);

-- ----------------------------
-- Table structure for workspaces
-- ----------------------------
DROP TABLE IF EXISTS "public"."workspaces";
CREATE TABLE "public"."workspaces" (
  "id" int4 NOT NULL DEFAULT nextval('workspaces_id_seq'::regclass),
  "id_user" int4 NOT NULL,
  "id_device" int4 NOT NULL,
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "workspace_bytes" bytea
)
;

-- ----------------------------
-- Records of workspaces
-- ----------------------------
INSERT INTO "public"."workspaces" VALUES (1, 1, 1, 'Workspace 1', E'octet_length(workspace_bytes) <= 2000');

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."devices_id_seq"
OWNED BY "public"."devices"."id";
SELECT setval('"public"."devices_id_seq"', 4, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_devices_id_seq"
OWNED BY "public"."users_devices"."id";
SELECT setval('"public"."users_devices_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_id_seq"
OWNED BY "public"."users"."id";
SELECT setval('"public"."users_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."workspaces_id_seq"
OWNED BY "public"."workspaces"."id";
SELECT setval('"public"."workspaces_id_seq"', 1, true);

-- ----------------------------
-- Indexes structure for table devices
-- ----------------------------
CREATE INDEX "devices_id_idx" ON "public"."devices" USING btree (
  "id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Uniques structure for table devices
-- ----------------------------
ALTER TABLE "public"."devices" ADD CONSTRAINT "devices_api_key_key" UNIQUE ("api_key");

-- ----------------------------
-- Checks structure for table devices
-- ----------------------------
ALTER TABLE "public"."devices" ADD CONSTRAINT "devices_check" CHECK ((width * height) <= 2000);

-- ----------------------------
-- Primary Key structure for table devices
-- ----------------------------
ALTER TABLE "public"."devices" ADD CONSTRAINT "devices_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table devices_active_workspaces
-- ----------------------------
ALTER TABLE "public"."devices_active_workspaces" ADD CONSTRAINT "devices_active_workspace_pkey" PRIMARY KEY ("id_device");

-- ----------------------------
-- Primary Key structure for table devices_telemetry
-- ----------------------------
ALTER TABLE "public"."devices_telemetry" ADD CONSTRAINT "devices_telemetry_pkey" PRIMARY KEY ("id_device");

-- ----------------------------
-- Indexes structure for table users
-- ----------------------------
CREATE INDEX "users_id_idx" ON "public"."users" USING btree (
  "id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Uniques structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_email_key" UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table users_devices
-- ----------------------------
ALTER TABLE "public"."users_devices" ADD CONSTRAINT "users_devices_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Checks structure for table workspaces
-- ----------------------------
ALTER TABLE "public"."workspaces" ADD CONSTRAINT "workspaces_workspace_bytes_check" CHECK (octet_length(workspace_bytes) <= 2000);

-- ----------------------------
-- Primary Key structure for table workspaces
-- ----------------------------
ALTER TABLE "public"."workspaces" ADD CONSTRAINT "workspaces_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Foreign Keys structure for table devices_active_workspaces
-- ----------------------------
ALTER TABLE "public"."devices_active_workspaces" ADD CONSTRAINT "devices_active_workspace_id_device_fkey" FOREIGN KEY ("id_device") REFERENCES "public"."devices" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."devices_active_workspaces" ADD CONSTRAINT "devices_active_workspace_id_workspace_fkey" FOREIGN KEY ("id_workspace") REFERENCES "public"."workspaces" ("id") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table devices_telemetry
-- ----------------------------
ALTER TABLE "public"."devices_telemetry" ADD CONSTRAINT "devices_telemetry_id_device_fkey" FOREIGN KEY ("id_device") REFERENCES "public"."devices" ("id") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table users_devices
-- ----------------------------
ALTER TABLE "public"."users_devices" ADD CONSTRAINT "users_devices_id_device_fkey" FOREIGN KEY ("id_device") REFERENCES "public"."devices" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."users_devices" ADD CONSTRAINT "users_devices_id_user_fkey" FOREIGN KEY ("id_user") REFERENCES "public"."users" ("id") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table workspaces
-- ----------------------------
ALTER TABLE "public"."workspaces" ADD CONSTRAINT "workspaces_id_device_fkey" FOREIGN KEY ("id_device") REFERENCES "public"."devices" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."workspaces" ADD CONSTRAINT "workspaces_id_user_fkey" FOREIGN KEY ("id_user") REFERENCES "public"."users" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
