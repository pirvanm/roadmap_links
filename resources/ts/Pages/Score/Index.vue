<template>
    <div>
        <ScoreCalculator :jobDescription="jobDescription" :candidateExperience="candidateExperience" />
    </div>
</template>
  
<script>
import ScoreCalculator from './ScoreCalculator.vue';

export default {
    components: {
        ScoreCalculator,
    },
    data() {
        return {
            jobDescription: `The candidate’s background and experience should demonstrate proficiency in developing Web applications and Web services based on the following technologies:
        
        3+ years of experience with programming Web applications in PHP, Java, PERL, or Python.
        Experience developing interactive AJAX and Web 2.0 applications.
        Proficiency with Object Orientated Programming (OOP), design patterns, and domain driven design.
        Proficiency with frameworks, preferably Zend (but experience with another framework is OK). Previous experience with Java/Spring or ASP/.NET is a strong plus.
        Proficiency with JavaScript and JavaScript frameworks, preferably EXT-JS (but experience with another JavaScript framework like JQuery or Scriptaculous is also OK).
        Comfort and ease using multi-editor source control systems such as Subversion, Mercurial or Git.
        Strong LAMP/LAPP knowledge (Linux, Apache, Mysql/Postgres, PHP/PERL/Python).
        Comfortable developing on Linux using the Bash shell.
        Excellent English and communication skills.
        Experience coding in a team environment.
        Ability to work independently and collaboratively on multiple projects simultaneously.
        Experience working in an Agile SCRUM environment and working knowledge of Agile methodologies a plus.
        Industry recognized certifications are a plus.`,
            candidateExperience: [
                'marLMS',
                'Freelance Web Developer',
                'WOW Factory',
                'Web Developer Php + Vue Js',
                'Atelierele ILBAH',
                'Technical Trainer',
                'easySales Romania',
                'Web Developer',
                'Soft Dreams',
                'Full-stack Developer',
                'Web Developer',
            ],
        };
    },
};
</script>
  