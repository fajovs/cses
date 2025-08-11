-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2025 at 02:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccses_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `activity_note` text DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_criteria`
--

CREATE TABLE `activity_criteria` (
  `criteria_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `criteria` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `faculty_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `faculty_number` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `user_id`, `program_id`, `faculty_number`, `created_at`, `updated_at`) VALUES
(5, 32, 9, '1231313', '2025-07-30 02:03:08', '2025-07-30 04:01:40'),
(8, 42, 9, '1111111', '2025-07-30 06:00:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(100) DEFAULT NULL,
  `program_about` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `program_about`, `created_at`, `updated_at`) VALUES
(9, 'Bachelor of Science in Information Technology', 'The BSIT is a 4-year undergraduate program that focuses on the study, design, development, implementation, support, and management of computer-based information systems. It blends practical skills and theoretical foundations to prepare students for real-world IT roles.aasssss', '2025-06-24 07:02:15', '2025-07-27 00:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `program_sections`
--

CREATE TABLE `program_sections` (
  `section_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `section_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_sections`
--

INSERT INTO `program_sections` (`section_id`, `program_id`, `section_name`) VALUES
(70, 9, 'BSIT-1A'),
(71, 9, 'BSIT-1B');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `num_questions` int(11) NOT NULL,
  `passing_score` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `subject_id`, `title`, `num_questions`, `passing_score`, `deadline`, `is_active`, `created_at`) VALUES
(4, 14, 'qweqe', 1, 0, '2025-09-04 17:51:00', 1, '2025-08-01 11:51:36'),
(5, 14, 'qewqe', 3, 2, '2025-08-19 17:25:00', 1, '2025-08-04 11:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `quiz_question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `choice_a` varchar(255) NOT NULL,
  `choice_b` varchar(255) NOT NULL,
  `choice_c` varchar(255) NOT NULL,
  `choice_d` varchar(255) NOT NULL,
  `correct_answer` enum('A','B','C','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--


-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_number` varchar(20) NOT NULL,
  `program_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `student_number`, `program_id`, `section_id`, `created_at`, `updated_at`) VALUES
(7, 43, '1231313', 9, 70, '2025-08-01 02:48:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_quiz_answers`
--

CREATE TABLE `student_quiz_answers` (
  `student_quiz_answer_id` int(11) NOT NULL,
  `student_quiz_attempt_id` int(11) NOT NULL,
  `quiz_question_id` int(11) NOT NULL,
  `selected_answer` enum('A','B','C','D') NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_quiz_attempts`
--

CREATE TABLE `student_quiz_attempts` (
  `student_quiz_attempt_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) DEFAULT 0,
  `status` enum('passed','failed') NOT NULL,
  `submitted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `subject_about` text NOT NULL,
  `section_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `program_id`, `subject_name`, `subject_about`, `section_id`, `faculty_id`, `created_at`, `updated_at`) VALUES
(14, 9, 'samplesample', 'qweqea', 70, 5, '2025-07-30 01:26:05', '2025-07-30 04:17:30'),
(15, 9, 'qweqeqweqew', 'qwewqe', 70, 8, '2025-07-30 06:01:11', NULL),
(16, 9, 'b subject', 'asdad', 71, 8, '2025-08-01 03:32:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `role` enum('admin','student','faculty','parent') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `middle_name`, `last_name`, `suffix`, `role`, `created_at`, `updated_at`) VALUES
(5, 'admin@example.com', '$2y$10$jBOTs2QufU4yDSOoNw1/vO5QUuUh6P9rO57B14B34/FAdLoSRLWzi', 'Administrator', '', 'Administrator', '', 'admin', '2025-06-24 06:55:02', '2025-06-24 06:55:02'),
(32, 'faculty@example.com', '$2y$10$B24y.lrUNHKI.AKSxUkrkOSTuf0irfO6CuihT3q6jE/Al.Y98iPmS', 'Michael', 'Sample', 'Dela', 'AM', 'faculty', '2025-07-30 02:03:08', '2025-07-30 04:01:40'),
(42, 'samplefaculty@example.com', '$2y$10$zUXaqYtu/18esABcSc6yxeWsBVlor5j4L4txJgetlpND760n/4zAy', 'two', 'two', 'two', 'two', 'faculty', '2025-07-30 06:00:42', NULL),
(43, 'student@example.com', '$2y$10$jk5Wu5yWHFhP5egqFnI3FeraOpsqhFVz/FulquIai83AakyYmuxB6', 'student', 'student', 'student', 'student', 'student', '2025-08-01 02:48:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `activity_criteria`
--
ALTER TABLE `activity_criteria`
  ADD PRIMARY KEY (`criteria_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`faculty_id`),
  ADD UNIQUE KEY `faculty_number` (`faculty_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `program_sections`
--
ALTER TABLE `program_sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`quiz_question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_number` (`student_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `student_quiz_answers`
--
ALTER TABLE `student_quiz_answers`
  ADD PRIMARY KEY (`student_quiz_answer_id`),
  ADD KEY `student_quiz_attempt_id` (`student_quiz_attempt_id`),
  ADD KEY `quiz_question_id` (`quiz_question_id`);

--
-- Indexes for table `student_quiz_attempts`
--
ALTER TABLE `student_quiz_attempts`
  ADD PRIMARY KEY (`student_quiz_attempt_id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `activity_criteria`
--
ALTER TABLE `activity_criteria`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `program_sections`
--
ALTER TABLE `program_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `quiz_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_quiz_answers`
--
ALTER TABLE `student_quiz_answers`
  MODIFY `student_quiz_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_quiz_attempts`
--
ALTER TABLE `student_quiz_attempts`
  MODIFY `student_quiz_attempt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `faculties_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`);

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz_questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`);

--
-- Constraints for table `student_quiz_answers`
--
ALTER TABLE `student_quiz_answers`
  ADD CONSTRAINT `student_quiz_answers_ibfk_1` FOREIGN KEY (`student_quiz_attempt_id`) REFERENCES `student_quiz_attempts` (`student_quiz_attempt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_quiz_answers_ibfk_2` FOREIGN KEY (`quiz_question_id`) REFERENCES `quiz_questions` (`quiz_question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_quiz_attempts`
--
ALTER TABLE `student_quiz_attempts`
  ADD CONSTRAINT `student_quiz_attempts_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_quiz_attempts_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
