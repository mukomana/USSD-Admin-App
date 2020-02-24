CREATE TABLE `subject` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(25) NOT NULL,
    `course_mark` INT(3) NOT NULL,
    `exam_mark` INT(3),
    `final_mark` INT(3),
    `student_id` INT DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`student_id`) REFERENCES student(`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
); 
