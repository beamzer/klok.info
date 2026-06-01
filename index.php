<html>
<!-- clock software is from: http://www.3quarks.com/en/SVGClock/index.html
     i added the right side stuff like day of week, season, etc.
     this is meant for people who have trouble remembering this information
     Ewald 2020-08-29
-->

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Klok">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="152x152" href="apple-touch-icon-152x152.png">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="style.css">
    <title>KLOK</title>

    <script type="text/javascript">
      var dagen = ["Zondag","Maandag","Dinsdag","Woensdag","Donderdag","Vrijdag","Zaterdag"];
      var maanden = ["Januari","Februari","Maart","April","Mei","Juni","Juli","Augustus","September","Oktober","November","December"];

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
        document.getElementById("dag").textContent = dagen[now.getDay()];
        document.getElementById("dagdeel").textContent = dagdeel(now.getHours());
        document.getElementById("datum").textContent = now.getDate() + " " + maanden[now.getMonth()] + " " + now.getFullYear();
        document.getElementById("seizoen").textContent = "het is " + seizoen(now.getMonth() + 1, now.getDate());
      }

      window.addEventListener("load", function() {
        update();
        setInterval(update, 10000);
        if ("serviceWorker" in navigator) {
          navigator.serviceWorker.register("sw.js").catch(function() {});
        }
      });
    </script>

  </head>

  <body>
    <section class="container">
    <div class="one">
<object data="station-clock.svg" type="image/svg+xml"
        width="100%" height="100%">
  <param name="dial"               value="din 41091.4"/>
  <param name="hourHand"           value="siemens"/>
  <param name="minuteHand"         value="siemens"/>
  <param name="secondHand"         value="din 41071.2"/>
  <param name="minuteHandBehavior" value="stepping"/>
  <param name="secondHandBehavior" value="swinging"/>
  <param name="secondHandStopToGo" value="yes"/>
  <param name="secondHandStopTime" value="1.5"/>
  <param name="backgroundColor"    value="rgba(0,0,0,0)"/>
  <param name="dialColor"          value="rgb(40,40,40)"/>
  <param name="hourHandColor"      value="rgb(20,20,20)"/>
  <param name="minuteHandColor"    value="rgb(20,20,20)"/>
  <param name="secondHandColor"    value="rgb(160,50,40)"/>
  <param name="axisCoverColor"     value="rgb(20,20,20)"/>
  <param name="axisCoverRadius"    value="7"/>
  <param name="updateInterval"     value="50"/>
</object>
    </div>

    <div class="two">
      <p class="impact1" id="dag"></p>
      <p class="impact2" id="dagdeel"></p>
      <br /><br />
      <p class="impact3"><span id="datum"></span><br /><i><span id="seizoen"></span> </i></p>
    </div>
  </body>

</html>
