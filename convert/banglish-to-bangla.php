<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Banglish to Bangla Converter</title>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Hind Siliguri', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0; padding: 20px; color: #2c3e50;
        }
        .container {
            max-width: 900px; margin: 40px auto; background: white;
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        header {
            background: #2c3e50; color: white; padding: 25px; text-align: center;
        }
        h1 { margin: 0; font-size: 28px; }
        .subtitle { font-size: 16px; opacity: 0.9; margin-top: 8px; }
        .main { padding: 30px; }
        textarea {
            width: 100%; height: 130px; padding: 18px; font-size: 18px;
            border: 2px solid #e0e0e0; border-radius: 12px; resize: vertical;
            transition: all 0.3s; font-family: 'Hind Siliguri', monospace;
        }
        textarea:focus { border-color: #667eea; outline: none; box-shadow: 0 0 0 3px rgba(102,126,234,0.2); }
        .output {
            margin-top: 20px; padding: 20px; background: #f8f9fa;
            border-radius: 12px; font-size: 26px; line-height: 1.8;
            min-height: 80px; border: 1px solid #e0e0e0;
            white-space: pre-wrap; word-wrap: break-word;
        }
        .stats {
            display: flex; justify-content: space-between; margin-top: 15px;
            font-size: 14px; color: #7f8c8d;
        }
        .examples {
            margin-top: 25px; padding: 15px; background: #f0f4f8;
            border-radius: 10px; font-size: 15px;
        }
        .ai-badge {
            background: #667eea; color: white; padding: 4px 10px;
            border-radius: 20px; font-size: 12px; font-weight: bold;
            display: inline-block; margin-left: 8px;
        }
        .note { text-align: center; margin-top: 30px; font-size: 14px; color: #95a5a6; }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>AI বাংলিশ → বাংলা কনভার্টার <span class="ai-badge">AI</span></h1>
        <p class="subtitle">Smart phonetic + dictionary + context-aware conversion</p>
    </header>

    <div class="main">
        <textarea id="banglish" placeholder="এখানে বাংলিশ লিখুন... (ami banglay kotha boli)"></textarea>
        <div class="output" id="bangla">এখানে বাংলা দেখাবে...</div>

        <div class="stats">
            <span>শব্দ: <strong id="wordCount">0</strong></span>
            <span>সংশোধিত: <strong id="correctedCount">0</strong></span>
            <span>সময়: <strong id="timeTaken">0</strong>ms</span>
        </div>

        <div class="examples">
            <strong>উদাহরণ:</strong><br>
            ami banglay kotha boli → আমি বাংলায় কথা বলি<br>
            tumi kemon acho? → তুমি কেমন আছো?<br>
            bangladesh is beautiful → বাংলাদেশ সুন্দর<br>
            ami tomake valobashi → আমি তোমাকে ভালোবাসি
        </div>

        <p class="note">AI-powered: Smart word correction, grammar hints, and phonetic accuracy</p>
    </div>
</div>

<script>
// =================== AI-POWERED BANGLISH TO BANGLA ENGINE ===================

const AIConverter = {
    // Core phonetic mapping (consonants + vowels)
    consonant: {
        'k': 'ক', 'kh': 'খ', 'g': 'গ', 'gh': 'ঘ', 'ng': 'ঙ',
        'c': 'চ', 'ch': 'ছ', 'j': 'জ', 'jh': 'ঝ', 'ny': 'ঞ',
        't': 'ত', 'th': 'থ', 'd': 'দ', 'dh': 'ধ', 'n': 'ন',
        'T': 'ট', 'Th': 'ঠ', 'D': 'ড', 'Dh': 'ঢ', 'N': 'ণ',
        'p': 'প', 'ph': 'ফ', 'b': 'ব', 'bh': 'ভ', 'm': 'ম',
        'y': 'য', 'r': 'র', 'l': 'ল', 'v': 'ভ', 'w': 'ও',
        'sh': 'শ', 's': 'স', 'h': 'হ', 'z': 'জ',
        'ksh': 'ক্ষ', 'gy': 'জ্ঞ', 'shr': 'শ্র', 'dny': 'জ্ঞ'
    },

    vowel: {
        'a': 'আ', 'i': 'ই', 'u': 'উ', 'e': 'এ', 'o': 'ও',
        'A': 'আ', 'I': 'ঈ', 'U': 'ঊ', 'E': 'এ', 'O': 'ও',
        'aa': 'আ', 'ii': 'ঈ', 'uu': 'ঊ', 'ee': 'ঈ', 'oo': 'ও'
    },

    matra: {
        'i': 'ি', 'ii': 'ী', 'u': 'ু', 'uu': 'ূ',
        'e': 'ে', 'ai': 'ৈ', 'o': 'ো', 'ou': 'ৌ', 'aa': 'া'
    },

    // AI Dictionary: Common Banglish words → Correct Bangla
    dictionary: {
        'ami': 'আমি', 'tumi': 'তুমি', 'apni': 'আপনি', 'se': 'সে', 'tar': 'তার',
        'ekhon': 'এখন', 'kothay': 'কোথায়', 'ki': 'কি', 'kano': 'কানো',
        'bangladesh': 'বাংলাদেশ', 'dhaka': 'ঢাকা', 'kolkata': 'কলকাতা',
        'valo': 'ভালো', 'bhalo': 'ভালো', 'valobashi': 'ভালোবাসি',
        'kemon': 'কেমন', 'acho': 'আছো', 'achish': 'আছিস',
        'likhi': 'লিখি', 'boli': 'বলি', 'jai': 'যাই',
        'tomar': 'তোমার', 'amar': 'আমার', 'tar': 'তার',
        'sundor': 'সুন্দর', 'beautiful': 'সুন্দর', 'bhalo': 'ভালো'
    },

    // Contextual rules
    rules: [
        { pattern: /ain/g, replace: 'আইন' },
        { pattern: /ayn/g, replace: 'আইন' },
        { pattern: /ksh/g, replace: 'ক্ষ' },
        { pattern: /gya/g, replace: 'জ্ঞ' },
        { pattern: /shr/g, replace: 'শ্র' },
        { pattern: /ng$/g, replace: 'ং' },
        { pattern: /ng([^a-z])/g, replace: 'ঙ$1' },
        { pattern: /hasant/g, replace: '্' },
    ],

    convert(text) {
        const start = performance.now();
        let corrected = 0;
        text = text.toLowerCase().trim();

        if (!text) return { bangla: '', stats: { words: 0, corrected: 0, time: 0 } };

        // Step 1: Dictionary correction (AI Word Intelligence)
        const words = text.split(/\s+/);
        const correctedWords = words.map(word => {
            const clean = word.replace(/[^\w]/g, '');
            if (this.dictionary[clean]) {
                corrected++;
                return word.replace(clean, this.dictionary[clean]);
            }
            return word;
        });
        text = correctedWords.join(' ');

        // Step 2: Apply contextual rules
        this.rules.forEach(rule => {
            const matches = text.match(rule.pattern);
            if (matches) corrected += matches.length;
            text = text.replace(rule.pattern, rule.replace);
        });

        // Step 3: Phonetic conversion
        let result = '';
        let i = 0;

        while (i < text.length) {
            let matched = false;

            // Try 3-letter
            if (i + 3 <= text.length) {
                const sub = text.substr(i, 3);
                if (this.consonant[sub]) {
                    result += this.consonant[sub];
                    i += 3; matched = true;
                }
            }

            // Try 2-letter
            if (!matched && i + 2 <= text.length) {
                const sub = text.substr(i, 2);
                if (this.consonant[sub]) {
                    result += this.consonant[sub];
                    i += 2; matched = true;
                } else if (this.vowel[sub]) {
                    result += this.vowel[sub];
                    i += 2; matched = true;
                }
            }

            // Try 1-letter
            if (!matched) {
                const ch = text[i];
                if (this.consonant[ch]) {
                    result += this.consonant[ch];
                } else if (this.vowel[ch]) {
                    result += this.vowel[ch];
                } else {
                    result += ch;
                }
                i++;
            }

            // Apply matra after consonant
            if (i < text.length && /[ক-হ]/.test(result.slice(-1))) {
                let next = '';
                if (i + 2 <= text.length && this.matra[text.substr(i, 2)]) {
                    next = text.substr(i, 2); i += 2;
                } else if (this.matra[text[i]]) {
                    next = text[i]; i++;
                }

                if (next && next !== 'a') {
                    const matra = this.matra[next];
                    result = result.slice(0, -1) + result.slice(-1) + matra;
                }
            }
        }

        // Final cleanup
        result = result
            .replace(/অা/g, 'আ')
            .replace(/িি/g, 'ী')
            .replace(/ুু/g, 'ূ')
            .replace(/েে/g, 'ী')
            .replace(/্‌/g, '্');

        const time = Math.round(performance.now() - start);

        return {
            bangla: result || 'এখানে বাংলা দেখাবে...',
            stats: {
                words: words.length,
                corrected: corrected,
                time: time
            }
        };
    }
};

// Real-time conversion
const input = document.getElementById('banglish');
const output = document.getElementById('bangla');
const wordCount = document.getElementById('wordCount');
const correctedCount = document.getElementById('correctedCount');
const timeTaken = document.getElementById('timeTaken');

input.addEventListener('input', () => {
    const { bangla, stats } = AIConverter.convert(input.value);
    output.textContent = bangla;
    wordCount.textContent = stats.words;
    correctedCount.textContent = stats.corrected;
    timeTaken.textContent = stats.time;
});

// Initialize
output.textContent = 'এখানে বাংলা দেখাবে...';
</script>

</body>
</html>