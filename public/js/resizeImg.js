var resizeImg = function () {

	var launch = function launch(file, callbackFeature) {
		getOrientation(file, function (orientation) {
			launch_resize(file, orientation, callbackFeature);
		});
	};

	var getOrientation = function getOrientation(file, callback) {

		if (!file) return;

		var reader = new FileReader();
		reader.onload = function (e) {

			var view = new DataView(e.target.result);
			if (view.getUint16(0, false) != 0xFFD8) return callback(-2);
			var length = view.byteLength,
			    offset = 2;
			while (offset < length) {
				var marker = view.getUint16(offset, false);
				offset += 2;
				if (marker == 0xFFE1) {
					if (view.getUint32(offset += 2, false) != 0x45786966) return callback(-1);
					var little = view.getUint16(offset += 6, false) == 0x4949;
					offset += view.getUint32(offset + 4, little);
					var tags = view.getUint16(offset, little);
					offset += 2;
					for (var i = 0; i < tags; i++) {
						if (view.getUint16(offset + i * 12, little) == 0x0112) return callback(view.getUint16(offset + i * 12 + 8, little));
					}
				} else if ((marker & 0xFF00) != 0xFF00) break;else offset += view.getUint16(offset, false);
			}
			return callback(-1);
		};
		reader.readAsArrayBuffer(file);
	};

	// Rotation image si necessaire
	var launch_resize = function launch_resize(file, orientation, callbackFeature) {

		var reader = new FileReader();
		if (file.type.indexOf('image') == 0) {
			reader.onload = function (e) {
				var image = new Image();
				image.src = e.target.result;

				image.onload = function () {

					var canvas = document.createElement('canvas');
					var ctx = canvas.getContext("2d");

					canvas.width = image.width;
					canvas.height = image.height;
					image.width = image.width;
					image.height = image.height;

					if (orientation > 2) {
						switch (orientation) {
							case 3:
							case 4:
								canvas.width = image.width;
								canvas.height = image.height;
								angle = Math.PI;
								break;
							case 5:
							case 6:
								canvas.width = image.height;
								canvas.height = image.width;
								angle = 90 * Math.PI / 180;

								break;
							case 7:
							case 8:
								canvas.width = image.height;
								canvas.height = image.width;
								angle = -0.5 * Math.PI;
								break;
							default:

								break;
						}
						var cw = canvas.width * 0.5;
						var ch = canvas.height * 0.5;
						ctx.translate(cw, ch);
						ctx.rotate(angle);
						ctx.translate(-image.width * 0.5, -image.height * 0.5);

						/// draw image and reset transform
						ctx.drawImage(image, 0, 0);
						ctx.setTransform(1, 0, 0, 1, 0, 0);
					} else {
						ctx.drawImage(image, 0, 0);
					}

					var base64img = canvas.toDataURL('image/jpeg');
					// Redim en 800x800
					resize_img(file, base64img, callbackFeature);
				};
			};
			reader.readAsDataURL(file);
		}
	};

	var resize_img = function resize_img(file, base, callbackFeature) {

		var image = new Image();
		image.src = base;
		image.onload = function () {

			var maxWidth = 800,
			    maxHeight = 800,
			    imageWidth = image.width,
			    imageHeight = image.height;

			if (imageWidth > imageHeight) {
				if (imageWidth > maxWidth) {
					imageHeight *= maxWidth / imageWidth;
					imageWidth = maxWidth;
				}
			} else {
				if (imageHeight > maxHeight) {
					imageWidth *= maxHeight / imageHeight;
					imageHeight = maxHeight;
				}
			}

			var canvas = document.createElement('canvas');

			canvas.width = imageWidth;
			canvas.height = imageHeight;
			image.width = imageWidth;
			image.height = imageHeight;

			var ctx = canvas.getContext("2d");
			ctx.drawImage(this, 0, 0, imageWidth, imageHeight);
			var base64img = canvas.toDataURL('image/jpeg');

			// var name = file.name;
			// datas_images.push({'base64img':base64img, 'name' : name.substr(0, name.lastIndexOf("."))+'.jpg', 'type':'image/jpeg'});
			// $("#progress_upload_photo").val($("#progress_upload_photo").val()+1);
			// callback_resize(num_file);

			return callbackFeature(base64img);
		};
	};

	return {
		launch: launch
	};
}();