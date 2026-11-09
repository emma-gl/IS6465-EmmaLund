CREATE TABLE if not exists students (
  student_id INTEGER PRIMARY KEY,
  student_name TEXT NOT NULL,
  student_email TEXT NOT NULL UNIQUE
);

CREATE TABLE if not exists tutoring_requests (
  request_id INTEGER PRIMARY KEY,
  student_id INTEGER NOT NULL,
  course TEXT NOT NULL,
  topic TEXT NOT NULL,
  preferred_date TEXT NOT NULL,
  preferred_time TEXT NOT NULL,
  status TEXT NOT NULL DEFAULT 'Open',
  created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (student_id) REFERENCES students(student_id)
);

INSERT OR ignore INTO students (student_name, student_email)
VALUES ('Maria Lopez', 'maria.lopez@example.com');

INSERT OR ignore INTO tutoring_requests
  (request_id, student_id, course, topic, preferred_date, preferred_time)
VALUES
  (1, 1, 'IS 6465', 'PHP arrays and forms', '2026-11-03', '14:00');

INSERT OR IGNORE INTO students (student_name, student_email)
VALUES
  ('Jordan Lee', 'jordan.lee@example.edu'),
  ('Avery Patel', 'avery.patel@example.edu');

INSERT INTO tutoring_requests
  (student_id, course, topic, preferred_date, preferred_time)
SELECT student_id, 'IS 6465', 'Forms', '2026-11-18', '10:00'
FROM students
WHERE student_email = 'jordan.lee@example.edu'
  AND NOT EXISTS (
    SELECT 1
    FROM tutoring_requests
    WHERE student_id = students.student_id
      AND course = 'IS 6465'
      AND topic IN ('Forms', 'HTML Forms Validation')
      AND preferred_date = '2026-11-18'
      AND preferred_time = '10:00'
  );

INSERT INTO tutoring_requests
  (student_id, course, topic, preferred_date, preferred_time)
SELECT student_id, 'IS 6465', 'SQL SELECT', '2026-11-20', '13:30'
FROM students
WHERE student_email = 'jordan.lee@example.edu'
  AND NOT EXISTS (
    SELECT 1
    FROM tutoring_requests
    WHERE student_id = students.student_id
      AND course = 'IS 6465'
      AND topic = 'SQL SELECT'
      AND preferred_date = '2026-11-20'
      AND preferred_time = '13:30'
  );

INSERT INTO tutoring_requests
  (student_id, course, topic, preferred_date, preferred_time)
SELECT student_id, 'IS 6465', 'SQLite CRUD', '2026-11-25', '16:00'
FROM students
WHERE student_email = 'avery.patel@example.edu'
  AND NOT EXISTS (
    SELECT 1
    FROM tutoring_requests
    WHERE student_id = students.student_id
      AND course = 'IS 6465'
      AND topic = 'SQLite CRUD'
      AND preferred_date = '2026-11-25'
      AND preferred_time = '16:00'
  );



SELECT * FROM students;

SELECT * FROM tutoring_requests;

SELECT * FROM tutoring_requests
WHERE status = 'Open';

SELECT * FROM tutoring_requests
WHERE request_id = 3;

SELECT
  r.request_id,
  s.student_name,
  s.student_email,
  r.course,
  r.topic,
  r.preferred_date,
  r.preferred_time,
  r.status
FROM tutoring_requests AS r
JOIN students AS s ON r.student_id = s.student_id
ORDER BY r.preferred_date;

UPDATE tutoring_requests
SET topic = 'PHP arrays and forms - updated',
    preferred_date = '2026-10-12',
    preferred_time = '15:00'
WHERE request_id = 1;

DELETE from tutoring_requests
WHERE request_id = 2;

UPDATE tutoring_requests
SET status = 'Cancelled'
WHERE request_id = 1;


UPDATE tutoring_requests
SET topic = 'HTML Forms Validation'
WHERE request_id = 3;

UPDATE tutoring_requests
SET status = 'Cancelled'
WHERE request_id = 5;


INSERT OR IGNORE INTO tutoring_requests
  (request_id, student_id, course, topic, preferred_date, preferred_time)
VALUES
  (1000, 2, 'IS 6465', 'Delete Practice', '2026-12-01', '09:00');

SELECT * FROM tutoring_requests
WHERE request_id = 1000;

DELETE FROM tutoring_requests
WHERE request_id = 1000;

SELECT * FROM tutoring_requests;
