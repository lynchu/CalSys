
-- Function Define to update the timestamp "updated_at"
CREATE OR REPLACE FUNCTION trigger_set_timestamp()
RETURNS TRIGGER AS $$
BEGIN
  NEW.updated_at = NOW();
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- schemas
CREATE TABLE "questions" (
  "id" SERIAL PRIMARY KEY,
  "tex_content" text,
  "created_at" timestamp DEFAULT (now()),
  "updated_at" TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TABLE "textbooks" (
  "id" SERIAL PRIMARY KEY,
  "book_name" varchar,
  "isbn_10" varchar,
  "isbn_13" varchar,
  "created_at" timestamp DEFAULT (now()),
  "updated_at" TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TABLE "chapters" (
  "chapter" integer UNIQUE PRIMARY KEY NOT NULL,
  "chapter_name" varchar,
  "created_at" timestamp DEFAULT (now()),
  "updated_at" TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TABLE "question_chapter" (
  "id" SERIAL PRIMARY KEY,
  "question_id" integer references questions(id) on delete restrict,
  "chapter" integer references chapters(chapter) on delete restrict,
  "created_at" timestamp DEFAULT (now()),
  "updated_at" TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TABLE "question_textbook" (
  "id" SERIAL PRIMARY KEY,
  "question_id" integer references questions(id) on delete restrict,
  "textbook_id" integer references textbooks(id) on delete restrict,
  "page" integer,
  -- "edition" varchar,
  "created_at" timestamp DEFAULT (now()),
  "updated_at" TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

-- -- to reset the many-to-many table attributes
-- drop table question_textbook, question_chapter;

-- set trigger for updated_at column
CREATE TRIGGER set_timestamp
BEFORE UPDATE ON questions
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();

CREATE TRIGGER set_timestamp
BEFORE UPDATE ON textbooks
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();

CREATE TRIGGER set_timestamp
BEFORE UPDATE ON chapters
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();

CREATE TRIGGER set_timestamp
BEFORE UPDATE ON question_chapter
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();

CREATE TRIGGER set_timestamp
BEFORE UPDATE ON question_textbook
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();

------------------------------------------------------------------------

CREATE TABLE "original_data" (
  "id" SERIAL PRIMARY KEY,
  "tex_content" text,
  "chpater" integer,
  "textbook" varchar,
  "page" integer,
  "isbn_10" varchar,
  "isbn_13" varchar,
  "created_at" timestamp DEFAULT (now()),
  "updated_at" TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TRIGGER set_timestamp
BEFORE UPDATE ON original_data
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();