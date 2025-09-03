-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2025 at 05:39 AM
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
  `subject_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `deadline` datetime NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `subject_id`, `title`, `description`, `deadline`, `is_active`, `created_at`) VALUES
(5, 14, 'qweqea', 'qweqea', '2025-08-21 14:59:00', 1, '2025-08-05 15:00:03'),
(7, 14, 'asdad', 'asdad', '2025-08-21 18:49:00', 1, '2025-08-10 18:49:34'),
(8, 20, 'qsdqd', 'qwe', '2025-08-22 03:23:00', 1, '2025-08-12 03:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `activity_criteria`
--

CREATE TABLE `activity_criteria` (
  `criteria_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `criteria_name` varchar(255) NOT NULL,
  `weight` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_criteria`
--

INSERT INTO `activity_criteria` (`criteria_id`, `activity_id`, `criteria_name`, `weight`) VALUES
(10, 5, 'qweqe', 10.00),
(11, 5, 'assddddd', 90.00),
(13, 7, 'adad', 100.00),
(14, 8, 'qq', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `activity_submissions`
--

CREATE TABLE `activity_submissions` (
  `submission_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `fine_name` varchar(250) NOT NULL,
  `notes` text DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `total_score` decimal(5,2) DEFAULT NULL,
  `is_checked` tinyint(1) DEFAULT 0,
  `submitted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_submissions`
--

INSERT INTO `activity_submissions` (`submission_id`, `activity_id`, `student_id`, `file_path`, `fine_name`, `notes`, `feedback`, `total_score`, `is_checked`, `submitted_at`) VALUES
(14, 5, 7, 'jovaney_cidro_agda_1754810640.pdf', '', '', '', NULL, 0, '2025-08-10 15:24:00'),
(15, 7, 7, 'linkedin_grey9353_removebg_preview_1754809364__1__1754838145.png', '', '', '', NULL, 0, '2025-08-10 23:02:25'),
(16, 8, 7, 'linkedin_grey9353_removebg_preview_1754809364_1754940225.png', '', 'qwe', NULL, NULL, 0, '2025-08-12 03:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `num_questions` int(11) NOT NULL,
  `passing_score` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examinations`
--

INSERT INTO `examinations` (`exam_id`, `subject_id`, `title`, `num_questions`, `passing_score`, `deadline`, `is_active`, `created_at`) VALUES
(2, 14, 'sqwe', 3, 1, '2025-08-28 20:59:00', 1, '2025-08-04 15:00:03'),
(3, 14, 'qweqe', 2, 2, '2025-08-19 19:49:00', 1, '2025-08-11 13:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `exam_question_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `choice_a` varchar(255) NOT NULL,
  `choice_b` varchar(255) NOT NULL,
  `choice_c` varchar(255) NOT NULL,
  `choice_d` varchar(255) NOT NULL,
  `correct_answer` enum('A','B','C','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`exam_question_id`, `exam_id`, `question_text`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `correct_answer`) VALUES
(2, 2, '1', '1', '1', '1', '1', 'A'),
(3, 2, '1', '1', '1', '1', '1', 'A'),
(4, 2, '1', '1', '1', '1', '1', 'A'),
(5, 3, '1', '1', '1', '1', '1', 'A'),
(6, 3, '1', '1', '1', '1', '1', 'A');

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
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `link_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`link_id`, `parent_id`, `student_id`) VALUES
(10, 6, 7);

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

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parent_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 44, '2025-08-05 04:11:43', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `program_sections`
--

CREATE TABLE `program_sections` (
  `section_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `section_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 14, 'qweqe', 1, 1, '2025-08-28 18:27:00', 1, '2025-08-11 12:27:58');

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

INSERT INTO `quiz_questions` (`quiz_question_id`, `quiz_id`, `question_text`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `correct_answer`) VALUES
(7, 4, 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 'A'),
(11, 6, 'qweqeqe', '1', '1', '1', '1', 'A');

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
(7, 43, '1231313', 9, 70, '2025-08-01 02:48:47', NULL),
(8, 45, 'asdadad', 9, 71, '2025-08-05 04:46:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_exam_answers`
--

CREATE TABLE `student_exam_answers` (
  `student_exam_answer_id` int(11) NOT NULL,
  `student_exam_attempt_id` int(11) NOT NULL,
  `exam_question_id` int(11) NOT NULL,
  `selected_answer` enum('A','B','C','D') NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_exam_answers`
--

INSERT INTO `student_exam_answers` (`student_exam_answer_id`, `student_exam_attempt_id`, `exam_question_id`, `selected_answer`, `is_correct`) VALUES
(7, 3, 2, 'B', 0),
(8, 3, 3, 'D', 0),
(9, 3, 4, 'B', 0),
(10, 4, 5, 'A', 1),
(11, 4, 6, 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_exam_attempts`
--

CREATE TABLE `student_exam_attempts` (
  `student_exam_attempt_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) DEFAULT 0,
  `status` enum('passed','failed') NOT NULL,
  `is_checked` tinyint(1) DEFAULT 0,
  `submitted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_exam_attempts`
--

INSERT INTO `student_exam_attempts` (`student_exam_attempt_id`, `exam_id`, `student_id`, `score`, `status`, `is_checked`, `submitted_at`, `feedback`) VALUES
(3, 2, 7, 0, 'failed', 0, '2025-08-11 19:27:14', ''),
(4, 3, 7, 2, 'passed', 0, '2025-08-11 19:49:37', '');

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

--
-- Dumping data for table `student_quiz_answers`
--

INSERT INTO `student_quiz_answers` (`student_quiz_answer_id`, `student_quiz_attempt_id`, `quiz_question_id`, `selected_answer`, `is_correct`) VALUES
(10, 6, 7, 'B', 0),
(11, 7, 11, 'B', 0);

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
  `is_checked` tinyint(1) DEFAULT 0,
  `submitted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_quiz_attempts`
--

INSERT INTO `student_quiz_attempts` (`student_quiz_attempt_id`, `quiz_id`, `student_id`, `score`, `status`, `is_checked`, `submitted_at`, `feedback`) VALUES
(6, 4, 7, 0, 'passed', 0, '2025-08-06 19:25:11', ''),
(7, 6, 7, 0, 'failed', 0, '2025-08-11 18:28:32', NULL);

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
(19, 9, 'qweqewqe', 'qwewqe', 70, 8, '2025-08-11 06:55:57', NULL),
(20, 9, 'qweqe', 'qweqe', 70, 5, '2025-08-11 13:22:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `submission_scores`
--

CREATE TABLE `submission_scores` (
  `score_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `score` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(43, 'student@example.com', '$2y$10$jk5Wu5yWHFhP5egqFnI3FeraOpsqhFVz/FulquIai83AakyYmuxB6', 'student', 'student', 'student', 'student', 'student', '2025-08-01 02:48:47', NULL),
(44, 'parent@example.com', '$2y$10$1NY/ACAJBe1y72p9Ir3ZGOYzWbP2MITTnfzbrWptXs4GC6KvbMVIi', 'parent', 'parent', 'parent', 'p', 'parent', '2025-08-05 04:11:43', NULL),
(45, 'samplestudent@example.com', '$2y$10$IShhJTXmFa7rl.a.6SIvoeVpwY7SSHfiGa0xJnzLJpzVZQFIds49y', 'asda', 'asd', 'asd', '123', 'student', '2025-08-05 04:46:27', NULL);

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
  ADD PRIMARY KEY (`criteria_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `activity_submissions`
--
ALTER TABLE `activity_submissions`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `activity_submissions_ibfk_2` (`student_id`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`exam_question_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`faculty_id`),
  ADD UNIQUE KEY `faculty_number` (`faculty_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `links_ibfk_1` (`parent_id`),
  ADD KEY `links_ibfk_2` (`student_id`);

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
-- Indexes for table `student_exam_answers`
--
ALTER TABLE `student_exam_answers`
  ADD PRIMARY KEY (`student_exam_answer_id`),
  ADD KEY `student_exam_attempt_id` (`student_exam_attempt_id`),
  ADD KEY `exam_question_id` (`exam_question_id`);

--
-- Indexes for table `student_exam_attempts`
--
ALTER TABLE `student_exam_attempts`
  ADD PRIMARY KEY (`student_exam_attempt_id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `student_id` (`student_id`);

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
-- Indexes for table `submission_scores`
--
ALTER TABLE `submission_scores`
  ADD PRIMARY KEY (`score_id`),
  ADD KEY `submission_id` (`submission_id`),
  ADD KEY `criteria_id` (`criteria_id`);

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
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `activity_criteria`
--
ALTER TABLE `activity_criteria`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `activity_submissions`
--
ALTER TABLE `activity_submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `exam_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `program_sections`
--
ALTER TABLE `program_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `quiz_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student_exam_answers`
--
ALTER TABLE `student_exam_answers`
  MODIFY `student_exam_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_exam_attempts`
--
ALTER TABLE `student_exam_attempts`
  MODIFY `student_exam_attempt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_quiz_answers`
--
ALTER TABLE `student_quiz_answers`
  MODIFY `student_quiz_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_quiz_attempts`
--
ALTER TABLE `student_quiz_attempts`
  MODIFY `student_quiz_attempt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `submission_scores`
--
ALTER TABLE `submission_scores`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE;

--
-- Constraints for table `activity_criteria`
--
ALTER TABLE `activity_criteria`
  ADD CONSTRAINT `activity_criteria_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`activity_id`) ON DELETE CASCADE;

--
-- Constraints for table `activity_submissions`
--
ALTER TABLE `activity_submissions`
  ADD CONSTRAINT `activity_submissions_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`activity_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activity_submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `examinations`
--
ALTER TABLE `examinations`
  ADD CONSTRAINT `examinations_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `examinations` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`parent_id`),
  ADD CONSTRAINT `links_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

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
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `student_exam_answers`
--
ALTER TABLE `student_exam_answers`
  ADD CONSTRAINT `student_exam_answers_ibfk_1` FOREIGN KEY (`student_exam_attempt_id`) REFERENCES `student_exam_attempts` (`student_exam_attempt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_exam_answers_ibfk_2` FOREIGN KEY (`exam_question_id`) REFERENCES `exam_questions` (`exam_question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_exam_attempts`
--
ALTER TABLE `student_exam_attempts`
  ADD CONSTRAINT `student_exam_attempts_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `examinations` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_exam_attempts_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `submission_scores`
--
ALTER TABLE `submission_scores`
  ADD CONSTRAINT `submission_scores_ibfk_1` FOREIGN KEY (`submission_id`) REFERENCES `activity_submissions` (`submission_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submission_scores_ibfk_2` FOREIGN KEY (`criteria_id`) REFERENCES `activity_criteria` (`criteria_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
