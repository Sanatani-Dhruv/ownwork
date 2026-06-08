DROP TABLE IF EXISTS "cache";
CREATE TABLE "cache" (
	"cache_id"	INTEGER NOT NULL,
	"cache_ip"	TEXT NOT NULL UNIQUE,
	"cache_request_no"	INTEGER NOT NULL DEFAULT 1,
	"cache_last_request_datetime"	INTEGER NOT NULL DEFAULT datetime(),
	PRIMARY KEY("cache_id" AUTOINCREMENT) ON CONFLICT REPLACE
);
