const CACHE_NAME = "app-cache-v1";
const urlsToCache = [
    "/",
    "/css/app.css",
    "/js/app.js"
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            return Promise.all(
                urlsToCache.map(url => {
                    return fetch(url).then(response => {
                        if (!response.ok) {
                            throw new Error(`Failed to fetch ${url}`);
                        }
                        return cache.put(url, response);
                    }).catch(err => {
                        console.error('Caching failed:', err);
                    });
                })
            );
        })
    );
});


self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(response => {
            return response || fetch(event.request);
        })
    );
});

