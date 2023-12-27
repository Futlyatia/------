document.addEventListener("DOMContentLoaded", function() {
  const audio = document.querySelector("audio");
  const playPauseBtn = document.querySelector(".play-pause-btn");
  const playIcon = document.querySelector(".play-icon");
  const pauseIcon = document.querySelector(".pause-icon");
  const progressBar = document.querySelector(".progress-bar");
  const currentTime = document.querySelector(".current-time");
  const totalTime = document.querySelector(".total-time");
  const volumeSlider = document.querySelector(".volume-slider");

  playPauseBtn.addEventListener("click", function() {
      if (audio.paused) {
          audio.play();
      } else {
          audio.pause();
      }
      togglePlayPauseIcons();
  });

  audio.addEventListener("timeupdate", function() {
      updateProgressBar();
      updateTimeDisplay();
  });

  audio.addEventListener("loadedmetadata", function() {
      totalTime.innerText = formatTime(audio.duration);
  });

  volumeSlider.addEventListener("input", function() {
      audio.volume = volumeSlider.value;
  });

  function togglePlayPauseIcons() {
      playIcon.style.display = audio.paused ? "block" : "none";
      pauseIcon.style.display = audio.paused ? "none" : "block";
  }

  function updateProgressBar() {
      const progress = (audio.currentTime / audio.duration) * 100;
      progressBar.style.width = `${progress}%`;
  }

  function updateTimeDisplay() {
      currentTime.innerText = formatTime(audio.currentTime);
  }

  function formatTime(time) {
      const minutes = Math.floor(time / 60);
      const seconds = Math.floor(time % 60);
      return `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
  }
});