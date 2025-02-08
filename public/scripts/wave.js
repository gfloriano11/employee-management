const canvas = document.querySelector(".wave");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let waves = [
  { y: canvas.height / 2, length: 0.003, amplitude: 56, frequency: 0.39, color: "#86b3d7" },
  { y: canvas.height / 2, length: 0.004, amplitude: 42, frequency: 0.45, color: "#3494f4" },
  { y: canvas.height / 2, length: 0.0051, amplitude: 36, frequency: 0.32, color: "#8f8f8f" }
];

let increment = 0;

function animate() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  waves.forEach((wave) => {
    ctx.beginPath();
    ctx.moveTo(0, wave.y);

    for (let x = 0; x < canvas.width; x++) {
      ctx.lineTo(
        x,
        wave.y + Math.sin(x * wave.length + increment * wave.frequency) * wave.amplitude
      );
    }

    ctx.strokeStyle = wave.color;
    ctx.lineWidth = 2;
    ctx.stroke();
  });

  increment += 0.05;
  requestAnimationFrame(animate);
}

animate();