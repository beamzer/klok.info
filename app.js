var dagen = ["Zondag","Maandag","Dinsdag","Woensdag","Donderdag","Vrijdag","Zaterdag"];
var maanden = ["Januari","Februari","Maart","April","Mei","Juni","Juli","Augustus","September","Oktober","November","December"];
var seizoenIcon = { "Lente": "lente.svg", "Zomer": "zomer.svg", "Herfst": "herfst.svg", "Winter": "winter.svg" };

function dagdeel(h) {
  if (h < 6)  return "Nacht";
  if (h < 12) return "Ochtend";
  if (h < 18) return "Middag";
  return "Avond";
}

function seizoen(m, d) {
  // grenzen: 21 maart, 21 juni, 21 september, 21 december
  if ((m == 3 && d >= 21) || m == 4 || m == 5 || (m == 6 && d < 21)) return "Lente";
  if ((m == 6 && d >= 21) || m == 7 || m == 8 || (m == 9 && d < 21)) return "Zomer";
  if ((m == 9 && d >= 21) || m == 10 || m == 11 || (m == 12 && d < 21)) return "Herfst";
  return "Winter";
}

function update() {
  var now = new Date();
  var s = seizoen(now.getMonth() + 1, now.getDate());
  document.getElementById("dag").textContent = dagen[now.getDay()];
  document.getElementById("dagdeel").textContent = dagdeel(now.getHours());
  document.getElementById("datum").textContent = now.getDate() + " " + maanden[now.getMonth()] + " " + now.getFullYear();
  document.getElementById("seizoen").textContent = "het is " + s;
  document.getElementById("seizoen-icon").src = seizoenIcon[s];
}

window.addEventListener("load", function() {
  update();
  setInterval(update, 10000);
  if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("sw.js").catch(function() {});
  }
});
