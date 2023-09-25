// Basic service worker...
self.addEventListener("fetch", (event) => {
	event.respondWith(
		caches.open("cache").then((cache) => {
			return cache.match(event.request).then((response) => {
				console.log("cache request: " + event.request.url);
				const fetchPromise = fetch(event.request).then(
					(networkResponse) => {
						// If we got a response from the cache, update the cache...
						console.log(
							"fetch completed: " + event.request.url,
							networkResponse
						);
						if (networkResponse) {
							console.debug(
								"updated cached page: " + event.request.url,
								networkResponse
							);
							cache.put(event.request, networkResponse.clone());
						}
						return networkResponse;
					},
					(event) => {
						// Rejected promise - just ignore it, we're offline...
						console.log("Error in fetch()", event);
						event.waitUntil(
							// Our 'cache' here is named *cache* in the caches.open()...
							caches.open("cache").then((cache) => {
								return cache.addAll([
									// List : cache.addAll(), //takes a list of URLs, then fetches them from...
									// The server and adds the response to the cache...
									"./index.php", // cache your index page
									"./assets/*", // cache all images
									"./app.webmanifest",
								]);
							})
						);
					}
				);
				// Respond from the cache, or the network...
				return response || fetchPromise;
			});
		})
	);
});

// Always updating i.e latest version available...
self.addEventListener("install", (event) => {
	self.skipWaiting();
	console.log("Latest version installed!");
});
