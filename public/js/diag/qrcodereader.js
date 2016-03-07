/*!
 * WebCodeCamJQuery 2.0.5 javascript Bar-Qr code decoder
 * Author: Tóth András
 * Web: http://atandrastoth.co.uk
 * email: atandrastoth@gmail.com
 * Licensed under the MIT license
 */

//post method
function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

//my xmlparse
function XMLparse(code){
    parser = new DOMParser();
    xmlDoc = parser.parseFromString(code,"text/xml");
    uid =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("uid");
    name =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("name");
    gender =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("gender");
    yob =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("yob");
    gname =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("gname");
    house =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("house");
    street =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("street");
    lm =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("lm");
    dist =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("dist");
    state =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("state");
    pc =  xmlDoc.getElementsByTagName("PrintLetterBarcodeData")[0].getAttribute("pc");


    post('/diag/getDiags',{ "name":name , "uid":uid , "gender":gender , "yob":yob , "gname":gname , "house":house , "street":street , "lm":lm , "dist":dist , "state":state , "pc":pc } );
}

(function(undefined) {
    var scannerLaser = $(".scanner-laser"),
        imageUrl = $("#image-url"),
        decodeLocal = $("#decode-img"),
        play = $("#play"),
        scannedImg = $("#scanned-img"),
        scannedQR = $("#scanned-QR"),
        grabImg = $("#grab-img"),
        pause = $("#pause"),
        stop = $("#stop"),
        contrast = $("#contrast"),
        contrastValue = $("#contrast-value"),
        zoom = $("#zoom"),
        zoomValue = $("#zoom-value"),
        brightness = $("#brightness"),
        brightnessValue = $("#brightness-value"),
        threshold = $("#threshold"),
        thresholdValue = $("#threshold-value"),
        sharpness = $("#sharpness"),
        sharpnessValue = $("#sharpness-value"),
        grayscale = $("#grayscale"),
        grayscaleValue = $("#grayscale-value"),
        flipVertical = $("#flipVertical"),
        flipVerticalValue = $("#flipVertical-value"),
        flipHorizontal = $("#flipHorizontal"),
        flipHorizontalValue = $("#flipHorizontal-value");
    var args = {
        autoBrightnessValue: 100,
        resultFunction: function(res) {
            [].forEach.call(scannerLaser, function(el) {
                $(el).fadeOut(300, function() {
                    $(el).fadeIn(300);
                });
            });
            scannedImg.attr('src', res.imgData);
            //scannedQR.text(res.format + ': ' + res.code);
            //post('desk/patVisit', {name: 'Johnny Bravo'});
            XMLparse(res.code);

        },
        getDevicesError: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            for (p in error) {
                message += (p + ": " + error[p] + "\n");
            }
            alert(message);
        },
        getUserMediaError: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            for (p in error) {
                message += (p + ": " + error[p] + "\n");
            }
            alert(message);
        },
        cameraError: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            if (error.name == "NotSupportedError") {
                var ans = confirm("Your browser does not support getUserMedia via HTTP!\n(see: https://goo.gl/Y0ZkNV).\n You want to see github demo page in a new window?");
                if (ans) {
                    window.open("https://andrastoth.github.io/webcodecamjs/");
                }
            } else {
                for (p in error) {
                    message += p + ": " + error[p] + "\n";
                }
                alert(message);
            }
        },
        cameraSuccess: function() {
            grabImg.removeClass("disabled");
        }
    };
    var decoder = $("#webcodecam-canvas").WebCodeCamJQuery(args).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("#camera-select").init();
    decodeLocal.on("click", function() {
        Page.decodeLocalImage();
    });
    play.on("click", function() {
        scannedQR.text("Scanning ...");
        grabImg.removeClass("disabled");
        decoder.play();
    });
    grabImg.on("click", function() {
        scannedImg.attr("src", decoder.getLastImageSrc());
    });
    pause.on("click", function(event) {
        scannedQR.text("Paused");
        decoder.pause();
    });
    stop.on("click", function(event) {
        grabImg.addClass("disabled");
        scannedQR.text("Stopped");
        decoder.stop();
    });
    Page.changeZoom = function(a) {
        if (decoder.isInitialized()) {
            var value = typeof a !== "undefined" ? parseFloat(a.toPrecision(2)) : zoom.val() / 10;
            zoomValue.text(zoomValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.zoom = value;
            if (typeof a != "undefined") {
                zoom.val(a * 10);
            }
        }
    };
    Page.changeContrast = function() {
        if (decoder.isInitialized()) {
            var value = contrast.val();
            contrastValue.text(contrastValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.contrast = parseFloat(value);
        }
    };
    Page.changeBrightness = function() {
        if (decoder.isInitialized()) {
            var value = brightness.val();
            brightnessValue.text(brightnessValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.brightness = parseFloat(value);
        }
    };
    Page.changeThreshold = function() {
        if (decoder.isInitialized()) {
            var value = threshold.val();
            thresholdValue.text(thresholdValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.threshold = parseFloat(value);
        }
    };
    Page.changeSharpness = function() {
        if (decoder.isInitialized()) {
            var value = sharpness.prop("checked");
            if (value) {
                sharpnessValue.text(sharpnessValue.text().split(":")[0] + ": on");
                decoder.options.sharpness = [0, -1, 0, -1, 5, -1, 0, -1, 0];
            } else {
                sharpnessValue.text(sharpnessValue.text().split(":")[0] + ": off");
                decoder.options.sharpness = [];
            }
        }
    };
    Page.changeGrayscale = function() {
        if (decoder.isInitialized()) {
            var value = grayscale.prop("checked");
            if (value) {
                grayscaleValue.text(grayscaleValue.text().split(":")[0] + ": on");
                decoder.options.grayScale = true;
            } else {
                grayscaleValue.text(grayscaleValue.text().split(":")[0] + ": off");
                decoder.options.grayScale = false;
            }
        }
    };
    Page.changeVertical = function() {
        if (decoder.isInitialized()) {
            var value = flipVertical.prop("checked");
            if (value) {
                flipVerticalValue.text(flipVerticalValue.text().split(":")[0] + ": on");
                decoder.options.flipVertical = value;
            } else {
                flipVerticalValue.text(flipVerticalValue.text().split(":")[0] + ": off");
                decoder.options.flipVertical = value;
            }
        }
    };
    Page.changeHorizontal = function() {
        if (decoder.isInitialized()) {
            var value = flipHorizontal.prop("checked");
            if (value) {
                flipHorizontalValue.text(flipHorizontalValue.text().split(":")[0] + ": on");
                decoder.options.flipHorizontal = value;
            } else {
                flipHorizontalValue.text(flipHorizontalValue.text().split(":")[0] + ": off");
                decoder.options.flipHorizontal = value;
            }
        }
    };
    Page.decodeLocalImage = function() {
        if (decoder.isInitialized()) {
            decoder.decodeLocalImage(imageUrl.val());
        }
        imageUrl.val(null);
    };
    var getZomm = setInterval(function() {
        var a;
        try {
            a = decoder.getOptimalZoom();
        } catch (e) {
            a = 0;
        }
        if (!!a && a !== 0) {
            Page.changeZoom(a);
            clearInterval(getZomm);
        }
    }, 500);
    $('#camera-select').on('change', function() {
        if (decoder.isInitialized()) {
            decoder.stop().play();
        }
    });
}).call(window.Page = window.Page || {});