// bump versie als je bestanden wijzigt — dit dwingt een nieuwe cache af
var CACHE = "klok-v2";
var ASSETS = [
  "./",
  "index.html",
  "app.js",
  "style.css",
  "station-clock.svg",
  "manifest.json",
  "apple-touch-icon.png",
  "apple-touch-icon-152x152.png",
  "favicon.ico"
];

self.addEventListener("install", function(e) {
  e.waitUntil(caches.open(CACHE).then(function(c) { return c.addAll(ASSETS); }));
  self.skipWaiting();
});

self.addEventListener("activate", function(e) {
  e.waitUntil(
    caches.keys().then(function(keys) {
      return Promise.all(keys.filter(function(k) { return k !== CACHE; })
                            .map(function(k) { return caches.delete(k); }));
    })
  );
  self.clients.claim();
});

self.addEventListener("fetch", function(e) {
  if (e.request.method !== "GET") return;
  e.respondWith(
    caches.match(e.request).then(function(hit) {
      return hit || fetch(e.request).then(function(resp) {
        var copy = resp.clone();
        caches.open(CACHE).then(function(c) { c.put(e.request, copy); });
        return resp;
      }).catch(function() { return caches.match("./"); });
    })
  );
});
