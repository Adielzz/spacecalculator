<?php
// index.php - main UI
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AFahmiAbdillah Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <style>
    body {
        height: 100vh;
        margin: 0;
        overflow: hidden;
        background: radial-gradient(circle at center, #1e293b, #0f172a);
        transition: background 0.1s linear;
    }

    .ufo {
        position: fixed;
        top: 50px;
        left: -100px;
        width: 80px;
        height: 40px;
        background: radial-gradient(circle at center, silver 70%, gray 100%);
        border-radius: 50% / 50%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        z-index: 9999;
        transition: transform 2s ease-in-out;
    }

    /* lampu di bawah UFO */
    .ufo::after {
        animation: glow 1.5s infinite alternate;
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 10px;
        background: yellow;
        border-radius: 50%;
        opacity: 0.7;
    }

    @keyframes glow {
        from {
            opacity: 0.3;
            box-shadow: 0 0 10px yellow;
        }

        to {
            opacity: 0.9;
            box-shadow: 0 0 20px yellow;
        }
    }

    #particles-js {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        /* biar di belakang kalkulator */
        background: #0f1724;
        /* fallback background */
    }


    .card {
        border-radius: 12px;
    }

    .bg-black-600 {
        background: linear-gradient(180deg, #0b0b0b, #0f1724);
        border: 1px solid rgba(202, 198, 198, 0.04);
    }

    .display input {
        background: transparent;
        border: none;
        color: #fff;
    }

    .btn-dark {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.04);
        color: #fff;
    }

    .btn-dark:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: scale(1.05);
        transition: 0.2s;
    }

    .btn-grid .btn {
        height: 48px;
        font-weight: 600;
    }

    /* Splash Screen */
    #splash-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #0f172a;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity 1s ease;
    }

    .splash-content {
        text-align: center;
        color: white;
        animation: fadeIn 1.2s ease forwards;
    }

    .splash-content h2 {
        margin-top: 12px;
        font-size: 1.5rem;
        font-family: 'Poppins', sans-serif;
    }

    /* Progress Bar */
    .progress-bar {
        margin: 20px auto 0;
        width: 200px;
        height: 8px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #38bdf8, #6366f1, #ec4899, #38bdf8);
        background-size: 300% 100%;
        animation: moveGradient 2s linear infinite;
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    @keyframes moveGradient {
        0% {
            background-position: 0% 50%;
        }

        100% {
            background-position: 100% 50%;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    </style>
</head>

<body class="bg-dark text-light">
    <!-- Splash Screen -->
    <div id="splash-screen">
        <div class="splash-content">
            <!-- Logo Kalkulator SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="white" viewBox="0 0 24 24">
                <path d="M7 2h10a2 2 0 0 1 2 2v16a2 2 0 
      1-2 2H7a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 
      2v4h10V4H7zm0 6v10h10V10H7zm2 2h2v2H9v-2zm0 
      3h2v2H9v-2zm4-3h2v2h-2v-2zm0 3h2v2h-2v-2z" />
            </svg>
            <h2>Welcome To Calculator</h2>
            <p>Made by AHMAD Fahmi Abdillah</p>
            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-fill" id="progress-fill"></div>
            </div>
        </div>
    </div>

    <div id="particles-js"></div>
    <audio id="bg-music" autoplay loop hidden>
        <source src="angkasa.mp3" type="audio/mpeg">
    </audio>
    <div class="ufo"></div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card bg-black-600 shadow-lg">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">AFA Calculator</h5>
                            <small class="text-muted"> • PHP • JS</small><button id="sound-toggle"
                                class="btn btn-sm btn-outline-light ms-2" title="Toggle sound">🔊</button>
                        </div>

                        <div class="calculator">
                            <div class="display mb-3">
                                <input id="display" type="text" readonly
                                    class="form-control form-control-lg text-end fs-4" value="0">
                            </div>

                            <div class="btn-grid">
                                <div class="d-grid gap-2 mb-2">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-secondary flex-fill action"
                                            data-action="clear">C</button>
                                        <button class="btn btn-sm btn-secondary flex-fill action"
                                            data-action="back">⌫</button>
                                        <button class="btn btn-sm btn-secondary flex-fill op" data-op="%">%</button>
                                        <button class="btn btn-sm btn-warning flex-fill op" data-op="/">÷</button>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 mb-2">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-dark num flex-fill" data-val="7">7</button>
                                        <button class="btn btn-dark num flex-fill" data-val="8">8</button>
                                        <button class="btn btn-dark num flex-fill" data-val="9">9</button>
                                        <button class="btn btn-warning flex-fill op" data-op="*">×</button>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 mb-2">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-dark num flex-fill" data-val="4">4</button>
                                        <button class="btn btn-dark num flex-fill" data-val="5">5</button>
                                        <button class="btn btn-dark num flex-fill" data-val="6">6</button>
                                        <button class="btn btn-warning flex-fill op" data-op="-">−</button>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 mb-2">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-dark num flex-fill" data-val="1">1</button>
                                        <button class="btn btn-dark num flex-fill" data-val="2">2</button>
                                        <button class="btn btn-dark num flex-fill" data-val="3">3</button>
                                        <button class="btn btn-warning flex-fill op" data-op="+">+</button>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-dark num flex-fill" data-val="0">0</button>
                                        <button class="btn btn-dark num flex-fill" data-val=".">.</button>
                                        <button class="btn btn-info flex-fill func" data-func="pow">xʸ</button>
                                        <button class="btn btn-success flex-fill eq" id="equals">=</button>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 mt-2">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-info flex-fill func" data-func="sqrt">√</button>
                                        <button class="btn btn-info flex-fill func" data-func="sin">sin</button>
                                        <button class="btn btn-info flex-fill func" data-func="cos">cos</button>
                                        <button class="btn btn-info flex-fill func" data-func="tan">tan</button>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-2">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-info flex-fill func" data-func="log">log</button>
                                        <button class="btn btn-info flex-fill func" data-func="exp">exp</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center small text-white">Made by Fahmi untuk tugas Web
                        Programming
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const display = document.getElementById('display');
    let current = '0';
    let a = null;
    let op = null;

    function update() {
        display.value = current;
    }

    document.querySelectorAll('.num').forEach(b => b.addEventListener('click', () => {
        let val = b.dataset.val;
        if (current === '0' && val !== '.') current = val;
        else current += val;
        update();
    }));

    document.querySelectorAll('.op').forEach(b => b.addEventListener('click', () => {
        a = current;
        op = b.dataset.op;
        current = '0';
        update();
    }));

    document.getElementById('equals').addEventListener('click', () => {
        if (a !== null && op !== null) {
            fetch('calc.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        operator: op,
                        a: a,
                        b: current
                    })
                })
                .then(r => r.json()).then(j => {
                    if (j.ok) {
                        current = String(j.result);
                        update();
                        a = null;
                        op = null;
                    } else alert(j.error)
                });
        }
    });

    document.querySelectorAll('.action').forEach(b => b.addEventListener('click', () => {
        if (b.dataset.action === 'clear') {
            current = '0';
            a = null;
            op = null;
            update();
        }
        if (b.dataset.action === 'back') {
            current = (current.length <= 1) ? '0' : current.slice(0, -1);
            update();
        }
    }));
    particlesJS("particles-js", {
        particles: {
            number: {
                value: 80,
                density: {
                    enable: true,
                    value_area: 800
                }
            },
            color: {
                value: "#ffffff"
            },
            shape: {
                type: "circle"
            },
            opacity: {
                value: 0.5,
                random: false
            },
            size: {
                value: 3,
                random: true
            },
            line_linked: {
                enable: true,
                distance: 150,
                color: "#ffffff",
                opacity: 0.4,
                width: 1
            },
            move: {
                enable: true,
                speed: 3,
                direction: "none",
                random: false,
                straight: false,
                out_mode: "out",
                bounce: false
            }
        },
        interactivity: {
            detect_on: "canvas",
            events: {
                onhover: {
                    enable: true,
                    mode: "repulse"
                },
                onclick: {
                    enable: true,
                    mode: "push"
                },
                resize: true
            },
            modes: {
                repulse: {
                    distance: 100,
                    duration: 0.4
                },
                push: {
                    particles_nb: 10
                }
            }
        },
        retina_detect: true
    });
    document.addEventListener("DOMContentLoaded", () => {
        const splash = document.getElementById("splash-screen");
        const progressFill = document.getElementById("progress-fill");

        let progress = 0;
        const interval = setInterval(() => {
            progress += 5;
            progressFill.style.width = progress + "%";

            if (progress >= 100) {
                clearInterval(interval);
                setTimeout(() => {
                    splash.style.opacity = "0"; // fade out
                    setTimeout(() => splash.style.display = "none",
                        1000); // hilang setelah fade
                }, 400); // delay dikit biar keliatan penuh
            }
        }, 150); // kecepatan progress (150ms sekali, bisa diubah)
    });
    // --- Sound FX (Web Audio API) ---
    const AudioContext = window.AudioContext || window.webkitAudioContext;
    const audioCtx = new AudioContext();
    const masterGain = audioCtx.createGain();
    masterGain.gain.value = 0.08; // volume awal (0.0 - 1.0)
    masterGain.connect(audioCtx.destination);

    let soundEnabled = true;
    const soundToggleBtn = document.getElementById('sound-toggle');
    if (soundToggleBtn) {
        soundToggleBtn.addEventListener('click', () => {
            soundEnabled = !soundEnabled;
            masterGain.gain.value = soundEnabled ? 0.08 : 0;
            soundToggleBtn.textContent = soundEnabled ? '🔊' : '🔇';
        });
    }

    // Resume audio context on first user gesture (mobile browsers require)
    document.addEventListener('click', () => {
        if (audioCtx.state === 'suspended') audioCtx.resume();
    }, {
        once: true
    });

    // function playClick: pendek, lembut
    function playClick(type = 'short') {
        if (!soundEnabled) return;
        const now = audioCtx.currentTime;
        const osc = audioCtx.createOscillator();
        const gain = audioCtx.createGain();

        // suara berbeda untuk tipe tombol (opsional)
        if (type === 'short') {
            osc.type = 'sine';
            osc.frequency.setValueAtTime(800, now);
            gain.gain.setValueAtTime(1.0, now);
            gain.gain.exponentialRampToValueAtTime(0.001, now + 0.06);
        } else if (type === 'long') {
            osc.type = 'triangle';
            osc.frequency.setValueAtTime(600, now);
            gain.gain.setValueAtTime(1.0, now);
            gain.gain.exponentialRampToValueAtTime(0.001, now + 0.14);
        } else {
            // default
            osc.type = 'sine';
            osc.frequency.setValueAtTime(700, now);
            gain.gain.setValueAtTime(1.0, now);
            gain.gain.exponentialRampToValueAtTime(0.001, now + 0.08);
        }

        osc.connect(gain);
        gain.connect(masterGain);
        osc.start(now);
        osc.stop(now + 0.12);
    }

    // --- Attach sound to buttons ---
    // panggil playClick() pada event click tombol yang sudah ada
    document.querySelectorAll('.num, .op, .action, .func, #equals').forEach(el => {
        el.addEventListener('click', (e) => {
            // beri variasi suara untuk tombol = dan fungsi
            if (el.id === 'equals') playClick('long');
            else if (el.classList.contains('func')) playClick('long');
            else playClick('short');
        });
    });

    document.querySelectorAll('.func').forEach(b => b.addEventListener('click', () => {
        fetch('calc.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    operator: b.dataset.func,
                    a: current
                })
            })
            .then(r => r.json()).then(j => {
                if (j.ok) {
                    current = String(j.result);
                    update();
                } else alert(j.error)
            });
    }));
    // --- UFO Logic ---
    const ufo = document.querySelector('.ufo');
    const ufoSound = new Audio("ufo.mp3");
    ufoSound.volume = 0.3;

    let audioAllowed = false;

    // aktifkan audio setelah klik pertama
    document.addEventListener("click", () => {
        if (!audioAllowed) {
            ufoSound.play().then(() => {
                ufoSound.pause();
                ufoSound.currentTime = 0;
                audioAllowed = true;
            });
        }
    });

    function moveUfo() {
        const x = Math.random() * (window.innerWidth - 100);
        const y = Math.random() * (window.innerHeight - 100);
        ufo.style.transform = `translate(${x}px, ${y}px)`;
        if (audioAllowed) {
            ufoSound.currentTime = 0;
            ufoSound.play();
        }
    }

    moveUfo();
    setInterval(moveUfo, 3000);

    update(); // pastikan display awal tampil
    </script>

    <!-- Script untuk BackSound -->
    <script>
    const bgMusic = document.getElementById("bg-music");
    bgMusic.volume = 1.0; // atur volume sesuai selera

    // Mobile browser biasanya butuh interaksi user dulu
    document.addEventListener("click", () => {
        if (bgMusic.paused) {
            bgMusic.play();
        }
    }, {
        once: true
    });



    update();
    </script>


</body>

</html>