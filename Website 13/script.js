// COUNTER
var body = document.body;

function count(countBegin, countEnd, element, time) {
  var inc = 1;
  var timer = setInterval(function() {
    if (countBegin >= countEnd) {
      element.innerHTML = countEnd;
      clearInterval(timer);
    } else {
      if (countBegin % 10 <= 5 || countBegin % 100 <= 5) {
        inc += 1;
      }
      countBegin += inc;
      element.innerHTML = countBegin;
    }
  }, time);
}

function checker() {
  var height = body.scrollHeight;
  console.log(height);
  var ratio;

  if (height > 4000) {
    ratio = 0.2;
  } else if (height > 4800) {
    ratio = 0.2;
  } else if (height > 6000) {
    ratio = 0.2;
  }
  if (window.scrollY > height * ratio) {
    console.log("Start at: ", window.scrollY);
    count(0, 5000, document.querySelector("#A"), 10);
    count(0, 300, document.querySelector("#B"), 50);
    count(0, 1200, document.querySelector("#C"), 30);
    count(0, 6000, document.querySelector("#D"), 10);
    window.removeEventListener("scroll", checker);
  }
}
window.addEventListener("scroll", checker);

// DRAG SLIDER
var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
      },
    });

//Loading