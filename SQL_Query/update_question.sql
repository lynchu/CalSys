/* update text */
UPDATE questions
    SET text_content = input_text_content 
    WHERE id = input_id;

/* update difficulty */
UPDATE questions
    SET difficulty = input_difficulty
    WHERE id = input_id;

/* adding skill 
INSERT INTO question_skill (question_id, skill_id, created_at, updated_at)
*/
