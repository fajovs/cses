<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");

?>

<main class="flex-1 overflow-y-auto px-30 py-6">

    <div class=" mx-auto max-w-7xl py-6 flex flex-col  sm:flex-row sm:items-end gap-4">

        <div>
            <label for="subject_id" class="block text-sm font-medium text-gray-900 mb-3">Subject</label>
            <select id="subject_id" name="subject_id" class="w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" <?= empty($subjects) ? 'disabled' : 'required' ?>>
                <?php if (empty($subjects)) : ?>
                    <option selected disabled>No Subject Available</option>
                <?php else : ?>
                    <option value="" selected disabled>Select a Subject</option>
                    <?php foreach ($subjects as $subject) : ?>
                        <option value="<?= htmlspecialchars($subject['subject_id']) ?>"><?= htmlspecialchars($subject['subject_name']) ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div>
            <button
                id="generate" class="rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-500 focus:ring-2 focus:ring-green-600">
                Generate Report
            </button>
        </div>
    </div>

    <div id="student-information">


    </div>

    <div class="mt-8 overflow-x-auto max-h-96">
        <div id="quizzes">

        </div>

    </div>





</main>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const subject = document.getElementById('subject_id');
        const generate = document.getElementById('generate');
        const studentInfo = document.getElementById('student-information');
        const quizzesContainer = document.getElementById('quizzes');

        generate.addEventListener('click', async () => {


            generateReport(subject.value);
        });

        async function generateReport(subjectId) {
            try {
                const response = await fetch('<?= base_url('/student/reports/generate') ?>?subject=' + subjectId);
                const data = await response.json();
                const quizzess = data.quizzes;

                studentInfo.innerHTML =
                    `
                 <h1 class="font-bold text-xl">Student Information</h1>
                 <p>Name       : <strong>${data.student.last_name.charAt(0).toUpperCase() + data.student.last_name.slice(1)}, ${data.student.first_name.charAt(0).toUpperCase() + data.student.first_name.slice(1)}  ${data.student.middle_name ? data.student.middle_name.charAt(0).toUpperCase() + '.': "" } ${data.student.suffix ? data.student.suffix.charAt(0).toUpperCase() + data.student.suffix.slice(1)+"." : ""}</strong></p>
                 <p>Student ID : <strong>${data.student.student_number}</strong></p>
                 <p>Course/Year: <strong>${data.student.section_name}</strong></p>
                 <p>Instructor : <strong>${data.faculty.last_name.charAt(0).toUpperCase() + data.faculty.last_name.slice(1)}, ${data.faculty.first_name.charAt(0).toUpperCase() + data.faculty.first_name.slice(1)}  ${data.faculty.middle_name ? data.faculty.middle_name.charAt(0).toUpperCase() + '.': "" } ${data.faculty.suffix ? data.faculty.suffix.charAt(0).toUpperCase() + data.faculty.suffix.slice(1)+"." : ""}</strong></p>
                 <p>Subject    : <strong>${data.faculty.subject_name.charAt(0).toUpperCase() + data.faculty.subject_name.slice(1)}</strong></p>    
                `

                const quizzes = data.quizzes || [];
                const assignments = data.assignments || [];
                const projects = data.projects || [];
                const examinations = data.examinations || [];

                const totalQuizzes = quizzes.reduce((sum, q) => sum + (q.score || 0), 0);
                const totalAssignments = assignments.reduce((sum, a) => sum + (a.score || 0), 0);
                const totalProjects = projects.reduce((sum, p) => sum + (p.score || 0), 0);
                const totalExams = examinations.reduce((sum, e) => sum + (e.score || 0), 0);

                const highestQuizzes = quizzes.reduce((sum, q) => sum + (q.num_questions || 0), 0);
                const highestExams = examinations.reduce((sum, e) => sum + (e.num_questions || 0), 0);
                const highestAssignments = assignments.reduce((sum, a) => sum + (a.total || 0), 0);
                const highestProjects = projects.reduce((sum, e) => sum + (e.total || 0), 0);

                function safeScore(total, highest) {
                    if (typeof total !== "number" || typeof highest !== "number" || highest === 0) {
                        return "";
                    }
                    const result = (total / highest) * 40 + 55;
                    return isNaN(result) ? "" : Math.round(result);
                }


                const quizScoreEq = safeScore(totalQuizzes, highestQuizzes);
                const assignScoreEq = safeScore(totalAssignments, highestAssignments);
                const projScoreEq = safeScore(totalProjects, highestProjects);
                const examScoreEq = safeScore(totalExams, highestExams);

                const quizGradeEq = getEquivalentGrade(quizScoreEq);
                const assignGradeEq = getEquivalentGrade(assignScoreEq);
                const projGradeEq = getEquivalentGrade(projScoreEq);
                const examGradeEq = getEquivalentGrade(examScoreEq);

               

                function getEquivalentGrade(score) {
                     if (score === null || score === "" || isNaN(score)) {
                        return "";
                    }
                    score = Math.round(score);

                   

                    if (score >= 95) return "1.0";
                    if (score >= 94) return "1.1";
                    if (score >= 93) return "1.2";
                    if (score >= 92) return "1.3";
                    if (score >= 91) return "1.4";
                    if (score >= 90) return "1.5";
                    if (score >= 89) return "1.6";
                    if (score >= 88) return "1.7";
                    if (score >= 87) return "1.8";
                    if (score >= 86) return "1.9";
                    if (score >= 85) return "2.0";
                    if (score >= 84) return "2.1";
                    if (score >= 83) return "2.2";
                    if (score >= 82) return "2.3";
                    if (score >= 81) return "2.4";
                    if (score >= 80) return "2.5";
                    if (score >= 79) return "2.6";
                    if (score >= 78) return "2.7";
                    if (score >= 77) return "2.8";
                    if (score >= 76) return "2.9";
                    if (score >= 75) return "3.0";
                    if (score >= 74) return "3.1";
                    if (score >= 73) return "3.2";
                    if (score >= 72) return "3.3";
                    if (score >= 71) return "3.4";
                    if (score >= 70) return "3.5";
                    if (score >= 69) return "3.6";
                    if (score >= 68) return "3.7";
                    if (score >= 67) return "3.8";
                    if (score >= 66) return "3.9";
                    if (score >= 65) return "4.0";
                    if (score >= 64) return "4.1";
                    if (score >= 63) return "4.2";
                    if (score >= 62) return "4.3";
                    if (score >= 61) return "4.4";
                    if (score >= 60) return "4.5";
                    if (score >= 59) return "4.6";
                    if (score >= 58) return "4.7";
                    if (score >= 57) return "4.8";
                    if (score >= 56) return "4.9";
                    if (score < 56) return "5.0";
                    return "";
                }


                const maxRows = Math.max(
                    quizzes.length,
                    assignments.length,
                    projects.length,
                    examinations.length
                );

                let rows = "";
                for (let i = 0; i < maxRows; i++) {
                    rows += `
                    <tr class="${i % 2 === 0 ? "bg-white" : "bg-gray-50"}">
                    <td colspan="2" class="border px-4 py-2">${quizzes[i]?.title || ""}</td>
                    <td class="border px-4 py-2 text-center">${quizzes[i]?.score ?? ""}</td>
                    <td class="border px-4 py-2 text-center bg-green-200">${quizzes[i]?.num_questions ?? ""}</td>

                    <td colspan="2" class="border px-4 py-2">${assignments[i]?.title || ""}</td>
                    <td class="border px-4 py-2 text-center">${assignments[i]?.score ?? ""}</td>
                    <td class="border px-4 py-2 text-center bg-green-200">${assignments[i]?.total ?? ""}</td>

                    <td colspan="2"class="border px-4 py-2">${projects[i]?.title || ""}</td>
                    <td class="border px-4 py-2 text-center">${projects[i]?.score ?? ""}</td>
                    <td class="border px-4 py-2 text-center bg-green-200">${projects[i]?.total ?? ""}</td>

                    <td colspan="2" class="border px-4 py-2">${examinations[i]?.title || ""}</td>
                    <td class="border px-4 py-2 text-center">${examinations[i]?.score ?? ""}</td>
                    <td class="border px-4 py-2 text-center bg-green-200">${examinations[i]?.num_questions ?? ""}</td>
                    </tr>
                `;
                }

                let table = `
                <div class="overflow-x-auto shadow-md">
                <table class="border-2 border-gray-700 w-full min-w-[800px] text-xs sm:text-sm table-fixed">
                    <thead>
                    <tr class="bg-gray-300 text-gray-800">
                        <th colspan="4" class="border-2 px-2 sm:px-4 py-2 text-center">Quizzes</th>
                        <th colspan="4" class="border-2 px-2 sm:px-4 py-2 text-center">Assignments</th>
                        <th colspan="4" class="border-2 px-2 sm:px-4 py-2 text-center">Projects</th>
                        <th colspan="4" class="border-2 px-2 sm:px-4 py-2 text-center">Examinations</th>
                    </tr>
                    <tr class="bg-gray-100 text-gray-700">
                        <!-- Quizzes -->
                        <th colspan="2" class="border-2 px-2 sm:px-4 py-2 w-2/5 break-words bg-green-200">Title</th>
                        <th class="border-2 px-1 sm:px-2 py-2 w-10 sm:w-14 text-center bg-green-200">Score</th>
                        <th class="border-2 px-1 sm:px-2 py-2 w-10 sm:w-14 text-center bg-green-200">Highest Score</th>
                        <!-- Assignments -->
                        <th colspan="2" class="border-2 px-2 sm:px-4 py-2 w-2/5 break-words bg-green-200">Title</th>
                        <th class="border-2 px-1 sm:px-2 py-2 w-10 sm:w-14 text-center bg-green-200">Score</th>
                        <th class="border-2 px-1 sm:px-2 py-2 w-10 sm:w-14 text-center bg-green-200">Highest Score</th>
                        <!-- Projects -->
                        <th colspan="2" class="border-2 px-2 sm:px-4 py-2 w-2/5 break-words bg-green-200">Title</th>
                        <th class="border-2 px-1 sm:px-2 py-2 w-10 sm:w-14 text-center bg-green-200">Score</th>
                        <th class="border-2 px-1 sm:px-2 py-2 w-10 sm:w-14 text-center bg-green-200">Highest Score</th>
                        <!-- Examinations -->
                        <th colspan="2" class="border-2 px-2 sm:px-4 py-2 w-2/5 break-words bg-green-200">Title</th>
                        <th class="border-2 px-1 sm:px-2 py-2 w-10 sm:w-14 text-center bg-green-200">Score</th>
                        <th class="border-2 px-1 sm:px-2 py-2 w-10 sm:w-14 text-center bg-green-200">Highest Score</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                    ${rows}
                    <!-- Totals -->
                    <tr class=" font-bold">
                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center">Total</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center">${totalQuizzes}</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-green-200">${highestQuizzes}</td>

                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center">Total</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center">${totalAssignments}</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-green-200">${highestAssignments}</td>

                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center">Total</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center">${totalProjects}</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center">${highestProjects}</td>

                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center">Total</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center">${totalExams}</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-green-200">${highestExams}</td>
                    </tr>
                    <!-- Equivalent Grades -->
                    <tr class="bg-gray-100 font-semibold">
                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center">Score Equivalent</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-blue-200" colspan="2">${quizScoreEq}</td>

                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center">Score Equivalent</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-blue-200" colspan="2">${assignScoreEq}</td>

                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center">Score Equivalent</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-blue-200" colspan="2">${projScoreEq}</td>

                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center">Score Equivalent</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-blue-200" colspan="2">${examScoreEq}</td>
                    </tr>
                    <tr class="font-semibold">
                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center bg-gray-100 ">Grade Equivalent</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-blue-200" colspan="2">${quizGradeEq}</td>

                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center bg-gray-100 ">Grade Equivalent</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-blue-200" colspan="2">${assignGradeEq}</td>

                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center bg-gray-100 ">Grade Equivalent</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-blue-200" colspan="2">${projGradeEq}</td>

                        <td colspan="2" class="border-2 px-2 sm:px-4 py-2 text-center bg-gray-100 ">Grade Equivalent</td>
                        <td class="border-2 px-1 sm:px-2 py-2 text-center bg-blue-200" colspan="2">${examGradeEq}</td>
                    </tr>
                    </tbody>
                </table>
                </div>
                `;







                quizzesContainer.innerHTML = table;


            } catch (error) {
                console.log(error);
            }
        }


    })
</script>

<?php require("views/partials/foot.php"); ?>