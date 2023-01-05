insert into questions(tex_content)
select tex_content
from original_data
ORDER BY id;

select * from questions;

ALTER TABLE original_data 
RENAME COLUMN chpater TO chapter;

select * from question_chapter;

insert into question_chapter(question_id, chapter_id)
select questions.id, chapters.id
from questions, chapters, original_data
where original_data.chapter = chapters.id
and original_data.id = questions.id;


select * from original_data;

select * from textbooks;

insert into question_textbook(question_id, textbook_id, page)
select questions.id, textbooks.id, original_data.page
from questions, textbooks, original_data
where original_data.isbn_10 = textbooks.isbn_10
and original_data.id = questions.id;