INSERT INTO questions(text_content, created_at, updated_at, difficulty)
VALUES("XX input_text_content xx", "XX real_createdtime xx", "XX real_updatedtime xx", "xx input_difficulty xx");
--question id and other data from php--
INSERT INTO question_chapter(question_id, chapter_id, created_at, updated_at)
VALUES("xx input_question_id xx", "xx input_chapter xx", "xx real_createdtime xx", "xx real_updatedtime xx");

INSERT INTO question_textbook(question_id, textbook_id, "page", created_at, updated_at)
VALUES("xx input_question_id xx", "xx input_textbook_id xx", "XX input_page XX", "xx real_createdtime xx", "xx real_updatedtime xx");

/*
INSERT INTO question_skill(question_id, skill_id, created_at, updated_at)
VALUES("xx input_question_id xx", "xx input_skill_id xx", "xx real_createdtime xx", "xx real_updatedtime xx");

CREATE VIEW addingid AS
SELECT MAX(questions.id) AS now_questions_id, 
       MAX(question_chapter.id) AS now_question_chapter_id,
       MAX(question_textbook.id) AS now_question_textbook_id,
       MAX(question_skill.id)   AS now_question_skill_id
FROM   questions, question_chapter, question_textbook, question_skill;

UPDATE question_chapter
    SET question_id = now_questions_id
    FROM question_chapter, addingid
    WHERE question_chapter.id = addingid.now_question_chapter_id;

UPDATE question_textbook
    SET question_id = now_questions_id
    FROM question_textbook, addingid
    WHERE question_textbook.id = addingid.now_question_textbook_id;

UPDATE question_skill
    SET question_id = now_questions_id
    FROM question_skill, addingid
    WHERE question_skill.id = addingid.now_question_skill_id;
*/
