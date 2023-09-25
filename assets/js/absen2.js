var result;

function getloc() {
	navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
}
$(document).ready(function getLocation() {
	result = document.getElementById("latitude");
	if (navigator.geolocation) {
		setTimeout(getloc, 3000);
	} else {
		swal({
			title: "Oops!",
			text: "Maaf, browser Anda tidak mendukung geolokasi HTML5.",
			icon: "error",
			timer: 3000,
		});
	}
});

// Define callback function for successful attempt
function successCallback(position) {
	result.innerHTML =
		"" + position.coords.latitude + "," + position.coords.longitude + "";
}

// Define callback function for failed attempt
function errorCallback(error) {
	if (error.code == 1) {
		swal({
			title: "Oops!",
			text: "Anda telah memutuskan untuk tidak membagikan posisi Anda, tetapi tidak apa-apa. Kami tidak akan meminta Anda lagi.",
			icon: "error",
			timer: 3000,
		});
	} else if (error.code == 2) {
		swal({
			title: "Oops!",
			text: "Jaringan tidak aktif atau layanan penentuan posisi tidak dapat dijangkau.",
			icon: "error",
			timer: 3000,
		});
	} else if (error.code == 3) {
		swal({
			title: "Oops!",
			text: "Waktu percobaan habis sebelum bisa mendapatkan data lokasi.",
			icon: "error",
			timer: 3000,
		});
	} else {
		swal({
			title: "Oops!",
			text: "Waktu percobaan habis sebelum bisa mendapatkan data lokasi.",
			icon: "error",
			timer: 3000,
		});
	}
}

// start webcam
Webcam.set({
	width: 312,
	height: 312,
	image_format: "jpeg",
	jpeg_quality: 80,
	flip_horiz: true,
});

var DEVICES = [];
var final = null;
navigator.mediaDevices
	.enumerateDevices()
	.then(function (devices) {
		var arrayLength = devices.length;
		for (var i = 0; i < arrayLength; i++) {
			var tempDevice = devices[i];
			//FOR EACH DEVICE, Push TO DEVICES LIST THOSE OF KIND VIDEOINPUT (cameras)
			//AND IF THE CAMERA HAS THE RIGHT FACEMODE ASSING IT TO "final"
			if (tempDevice.kind == "videoinput") {
				DEVICES.Push(tempDevice);
				if (
					tempDevice.facingMode == "environment" ||
					tempDevice.label.indexOf("facing back") >= 0
				) {
					final = tempDevice;
				}
			}
		}

		var totalCameras = DEVICES.length;
		//If couldnt find a suitable camera, pick the last one... you can change to what works for you
		if (final == null) {
			//console.log("no suitable camera, getting the last one");
			final = DEVICES[totalCameras - 1];
		}

		//Set the constraints and call getUserMedia
		var constraints = {
			audio: false,
			video: {
				deviceId: { exact: final.deviceId },
			},
		};

		navigator.mediaDevices
			.getUserMedia(constraints)
			.then(handleSuccess)
			.catch(handleError);
	})
	.catch(function (err) {
		console.log(err.name + ": " + err.message);
	});

Webcam.attach(".webcam-capture");

function captureimagedd() {
	var latitude = $(".latitude").html();
	// take snapshot and get image data
	Webcam.snap(function (data_uri) {
		// display results in page
		Webcam.upload(
			data_uri,
			"../absensi/prosesdl?latitude=" + latitude + "",
			function (code, text) {
				$data = "" + text + "";
				var results = $data.split("/");
				$results = results[0];
				$results2 = results[1];
				if ($results == "success") {
					swal({
						title: "Berhasil!",
						text: $results2,
						icon: "success",
						timer: 100000,
					});
					setTimeout("location.href = '../member';", 100000);
				} else {
					swal({
						title: "Oops!",
						text: text,
						icon: "error",
						timer: 100000,
					});
					setTimeout("location.href = '../member';", 100000);
				}
			}
		);
	});
}
