SELECT questions.id, textbook_id, book_name, isbn_10, isbn_13, chapter, chapter_name, 'page',
    text_content, difficulty, questions.created_at, questions.updated_at
FROM textbooks, questions, question_chapter, chapters, question_texbook
WHERE chapters.chapter = question_chapter.chapter 
    AND textbooks_id = question_textbook.texbook_id
    AND question_chapter.question_id = question_textbook.question_id
    AND questions.id = question_chapter.question_id;
