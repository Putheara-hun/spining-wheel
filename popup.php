<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spin the Wheel</title>
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="container">
        <h4 class="title">Drinking Wheel</h4>
        <div id="spinButton" class="wheel-container">
            <canvas id="wheelCanvas" class="wheel"></canvas>
           <div  id="spinButton" class="wheel-pointer"></div>
           <audio id="spinSound" src="spin-sound.mp3"></audio>

        </div>
        <textarea id="nameListInput" placeholder="Enter names separated by new lines..."></textarea>
     
        <div id="winnerPopup" class="popup">
            <span id="winnerName"></span>
            <button id="closePopup">x</button>

        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>

<style>
   body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #fdf5e6;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.container {
    text-align: center;
    max-width: 600px;
}

.title {
    font-size: 2rem;
    color: #ff6f61;
    margin-bottom: 20px;
}

.wheel-container {
    position: relative;
    width: 300px;
    height: 300px;
}

.wheel {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 10px solid #ff6f61;
    background: radial-gradient(circle, #f7e9d7, #f5c6a5);
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    transition: transform 3s cubic-bezier(0.33, 1, 0.68, 1);
}

.wheel-pointer {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(40%, -70%);
    width: 10px;
    height: 80px;
    background: linear-gradient(180deg, #ff6f61, #d93d30);
    border-radius: 5px;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.5);
    z-index: 10;
}

textarea {
    width: 80%;
    height: 60px;
    padding: 10px;
    border: 2px solid #ff6f61;
    border-radius: 10px;
    font-size: 16px;
    resize: none;
    margin-top: 50px;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.2);
}

button {
    background: linear-gradient(90deg, #ff6f61, #ff867f);
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.3);
    transition: background 0.3s ease, transform 0.2s ease;
}

button:hover {
    background: linear-gradient(90deg, #ff867f, #ff6f61);
    transform: translateY(-3px);
}

.popup {
    display: none;
    width: 220px;
    height: 60px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: linear-gradient(90deg, #fff8e1, #ffe3b3);
    border: 2px solid #ff6f61;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    z-index: 1000;
  
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.popup span {
    font-size: 18px;
    font-weight: bold;
    color: #ff6f61;
}

#closePopup {
    background: none;
    color: #ff6f61;
    border: none;
    font-size: 20px;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 10px;
    padding: 0;
}

#closePopup:hover {
    color: #ff867f;
}

.popup.show {
    display: flex;
}

</style>

<script>
const canvas = document.getElementById("wheelCanvas");
const spinButton = document.getElementById("spinButton");
const nameListInput = document.getElementById("nameListInput");
const winnerPopup = document.getElementById("winnerPopup");
const winnerName = document.getElementById("winnerName");
const closePopup = document.getElementById("closePopup");

let names = [];
let ready = true;
let repeat = 1;

const colors = ["#A8CD89", "#009925", "#EEB211", "#D50F25", "#659287","#FF2929"];

const drawWheel = () => {
    const size = Math.min(window.innerWidth, window.innerHeight - 125);
    canvas.width = size;
    canvas.height = size;

    const ctx = canvas.getContext("2d");
    const radius = canvas.width / 2;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawNameList(ctx, radius);
    innerCircle(ctx, radius);
};

const drawNameList = (ctx, radius) => {
    if (names.length === 0) return;
    const angle = (2 * Math.PI) / names.length;
    let colorIndex = 0;

    for (let i = 0; i < names.length; i++) {
        const startAngle = angle * i;
        const endAngle = startAngle + angle;

        ctx.beginPath();
        ctx.moveTo(radius, radius);
        ctx.arc(radius, radius, radius, startAngle, endAngle);
        ctx.lineTo(radius, radius);
        ctx.fillStyle = colors[colorIndex];
        ctx.fill();
        ctx.save();

        ctx.translate(radius, radius);
        ctx.rotate(startAngle + angle / 2);
        ctx.textAlign = "right";
        ctx.textBaseline = "middle";
        ctx.fillStyle = "#fff";
        ctx.font = "50px Arial";
        ctx.fillText(names[i], radius - 10, 4);
        ctx.restore();

        colorIndex = (colorIndex + 1) % colors.length;
    }
};

const innerCircle = (ctx, radius) => {
    ctx.beginPath();
    ctx.arc(radius, radius, 0, 0, 2 * Math.PI);
    ctx.fillStyle = "#fff";
    ctx.fill();
};

const spinSound = document.getElementById("spinSound");

const spinClick = () => {
    if (!ready || names.length === 0) return;
    ready = false;

    // Play the spin sound
    spinSound.currentTime = 0; // Restart the sound if it was played earlier
    spinSound.play();

    const index = Math.floor(Math.random() * names.length);
    const angle = 360 / names.length;
    const min = index * angle + 1;
    const max = min + angle - 1;
    const random = Math.floor(Math.random() * (max - min + 1) + min);
    const duration = Math.floor(Math.random() * (10 - 5 + 1) + 5);
    const degree = 3600 * repeat + 90 + random;

    canvas.style.transition = `transform ${duration}s cubic-bezier(0.33, 1, 0.68, 1)`;
    canvas.style.transform = `rotate(${-degree}deg)`;
    repeat++;

    setTimeout(() => {
        ready = true;
        winnerName.textContent = names[index];
        winnerPopup.classList.add("show");
    }, duration * 1000);
};

spinButton.addEventListener("click", spinClick);
closePopup.addEventListener("click", () => {
    winnerPopup.classList.remove("show");
});

nameListInput.addEventListener("input", (event) => {
    names = event.target.value.split("\n").filter(name => name.trim() !== "");
    drawWheel();
});

window.addEventListener("resize", drawWheel);
</script>