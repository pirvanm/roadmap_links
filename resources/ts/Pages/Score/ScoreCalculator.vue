<template>
    <div>
        <h3>Score Calculator</h3>
        <p>Job Description:</p>
        <pre>{{ jobDescription }}</pre>
        <p>Candidate Experience:</p>
        <pre>{{ candidateExperience }}</pre>
        <p>Score: {{ calculateScore() }}</p>
    </div>
</template>
  
<script>
export default {
    props: {
        jobDescription: String,
        candidateExperience: Array,
    },
    methods: {
        calculateScore() {
            const keywords = [
                'PHP',
                'Java',
                'PERL',
                'Python',
                'AJAX',
                'Web 2.0',
                'Object Oriented Programming',
                'OOP',
                'design patterns',
                'domain driven design',
                'Zend',
                'Java/Spring',
                'ASP/.NET',
                'JavaScript',
                'EXT-JS',
                'JQuery',
                'Scriptaculous',
                'Subversion',
                'Mercurial',
                'Git',
                'LAMP',
                'LAPP',
                'Linux',
                'Apache',
                'Mysql',
                'Postgres',
                'Bash shell',
                'Agile',
            ];

            let score = 0;

            keywords.forEach((keyword) => {
                if (this.jobDescription.includes(keyword)) {
                    score += 1;
                }

                this.candidateExperience.forEach((experience) => {
                    if (experience.includes(keyword)) {
                        score += 2;
                    }
                });
            });

            return score;
        },
    },
};
</script>
  