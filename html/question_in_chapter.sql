select * from question_chapter;

SELECT questions.id, questions.tex_content, chapters.chapter_name, questions.updated_at
FROM question_chapter, questions, chapters
WHERE question_chapter.chapter_id = 1
and question_chapter.question_id = questions.id
and question_chapter.chapter_id = chapters.id;