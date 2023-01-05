
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
  "difficulty" text,
  "created_at" timestamp DEFAULT (now()),
  "updated_at" TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

-- CREATE TABLE "skills" (
--   "id" SERIAL PRIMARY KEY,
--   "skill_name" text
-- );

CREATE TABLE "textbooks" (
  "id" SERIAL PRIMARY KEY,
  "book_name" varchar,
  "isbn_10" varchar,
  "isbn_13" varchar,
  "created_at" timestamp DEFAULT (now()),
  "updated_at" TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TABLE "chapters" (
  "id" integer UNIQUE PRIMARY KEY NOT NULL,
  "chapter_name" varchar,
  "created_at" timestamp DEFAULT (now()),
  "updated_at" TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE TABLE "question_chapter" (
  "id" SERIAL PRIMARY KEY,
  "question_id" integer references questions(id) on delete restrict,
  "chapter_id" integer references chapters(id) on delete restrict,
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


ALTER TABLE question_chapter
DROP CONSTRAINT question_chapter_question_id_fkey;

ALTER TABLE question_chapter
ADD FOREIGN KEY (question_id) REFERENCES questions(id)
ON DELETE CASCADE;

ALTER TABLE question_chapter
DROP CONSTRAINT question_chapter_chapter_id_fkey;

ALTER TABLE question_chapter
ADD FOREIGN KEY (chapter_id) REFERENCES chapters(id)
ON DELETE CASCADE;

ALTER TABLE question_textbook
DROP CONSTRAINT question_textbook_question_id_fkey;

ALTER TABLE question_textbook
ADD FOREIGN KEY (question_id) REFERENCES questions(id)
ON DELETE CASCADE;

ALTER TABLE question_textbook
DROP CONSTRAINT question_textbook_textbook_id_fkey;

ALTER TABLE question_textbook
ADD FOREIGN KEY (textbook_id) REFERENCES textbooks(id)
ON DELETE CASCADE;
/*
CREATE TABLE "question_skill" (
  "id" SERIAL PRIMARY KEY,
  "question_id" integer references questions(id) on delete restrict,
  "skill_id" integer references skills(id) on delete restrict,
  "created_at" timestamp DEFAULT (now()),
  "updated_at" TIMESTAMPTZ NOT NULL DEFAULT NOW()
);
*/

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
