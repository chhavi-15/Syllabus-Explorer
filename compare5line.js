// compare.js
function compareTexts() {
    for (let i = 1; i <= 5; i++) {
        const textA = document.getElementById(`text${i}a`).value;
        const textB = document.getElementById(`text${i}b`).value;
        const resultDiv = document.getElementById(`result${i}`);
        const similaritySpan = document.getElementById(`similarity${i}`);

        const similarity = levenshteinSimilarity(textA, textB);
        similaritySpan.textContent = (similarity * 100).toFixed(2) + '%';

        const diff = getDiff(textA, textB);
        resultDiv.innerHTML = diff.html;
    }
}

function getDiff(textA, textB) {
    const sentencesA = textA.split(/[,.]\s*/);
    const sentencesB = textB.split(/[,.]\s*/);

    const diff = [];

    let i = 0;
    let j = 0;

    while (i < sentencesA.length || j < sentencesB.length) {
        const sentenceA = sentencesA[i] ? sentencesA[i].trim() : '';
        const sentenceB = sentencesB[j] ? sentencesB[j].trim() : '';

        if (sentenceA === sentenceB) {
            diff.push(sentenceA);
            i++;
            j++;
        } else {
            if (sentenceA) {
                diff.push('<span class="diff-removed">' + sentenceA + '</span>');
            }
            if (sentenceB) {
                diff.push('<span class="diff-added">' + sentenceB + '</span>');
            }
            i++;
            j++;
        }
    }

    return {
        html: diff.join('. ')
    };
}

function levenshteinSimilarity(textA, textB) {
    const wordsA = textA.split(/\s+/);
    const wordsB = textB.split(/\s+/);
    const totalWords = Math.max(wordsA.length, wordsB.length);
    const distance = levenshteinDistance(wordsA, wordsB);
    return 1 - (distance / totalWords);
}

function levenshteinDistance(wordsA, wordsB) {
    const matrix = Array.from({ length: wordsA.length + 1 }, () =>
        Array(wordsB.length + 1).fill(0)
    );

    for (let i = 0; i <= wordsA.length; i++) {
        matrix[i][0] = i;
    }
    for (let j = 0; j <= wordsB.length; j++) {
        matrix[0][j] = j;
    }

    for (let i = 1; i <= wordsA.length; i++) {
        for (let j = 1; j <= wordsB.length; j++) {
            if (wordsA[i - 1] === wordsB[j - 1]) {
                matrix[i][j] = matrix[i - 1][j - 1];
            } else {
                matrix[i][j] = Math.min(
                    matrix[i - 1][j] + 1, // deletion
                    matrix[i][j - 1] + 1, // insertion
                    matrix[i - 1][j - 1] + 1 // substitution
                );
            }
        }
    }

    return matrix[wordsA.length][wordsB.length];
}
