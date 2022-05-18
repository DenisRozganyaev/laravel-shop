/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/images-preview.js":
/*!****************************************!*\
  !*** ./resources/js/images-preview.js ***!
  \****************************************/
/***/ (() => {

eval("if (window.FileReader) {\n  document.getElementById(\"images\").onchange = function () {\n    var counter = -1,\n        file;\n    $('.images-wrapper').html('');\n    var template = \"<div class=\\\"col-sm-12 d-flex justify-content-center align-items-center\\\">\\n                                  <img src=\\\"__url__\\\" class=\\\"card-img-top\\\" style=\\\"max-width: 80%; margin: 0 auto; display: block;\\\">\\n                                </div>\";\n\n    while (file = this.files[++counter]) {\n      var reader = new FileReader();\n\n      reader.onloadend = function () {\n        return function () {\n          var img = template.replace('__url__', this.result);\n          $('.images-wrapper').append(img);\n        };\n      }(file);\n\n      reader.readAsDataURL(file);\n    }\n  };\n}\n\n$(document).ready(function (e) {\n  $('#thumbnail').change(function () {\n    var reader = new FileReader();\n\n    reader.onload = function (e) {\n      $('#thumbnail-preview').attr('src', e.target.result);\n    };\n\n    reader.readAsDataURL(this.files[0]);\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvaW1hZ2VzLXByZXZpZXcuanM/YTQwOCJdLCJuYW1lcyI6WyJ3aW5kb3ciLCJGaWxlUmVhZGVyIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsIm9uY2hhbmdlIiwiY291bnRlciIsImZpbGUiLCIkIiwiaHRtbCIsInRlbXBsYXRlIiwiZmlsZXMiLCJyZWFkZXIiLCJvbmxvYWRlbmQiLCJpbWciLCJyZXBsYWNlIiwicmVzdWx0IiwiYXBwZW5kIiwicmVhZEFzRGF0YVVSTCIsInJlYWR5IiwiZSIsImNoYW5nZSIsIm9ubG9hZCIsImF0dHIiLCJ0YXJnZXQiXSwibWFwcGluZ3MiOiJBQUFBLElBQUlBLE1BQU0sQ0FBQ0MsVUFBWCxFQUF1QjtBQUNuQkMsRUFBQUEsUUFBUSxDQUFDQyxjQUFULENBQXdCLFFBQXhCLEVBQWtDQyxRQUFsQyxHQUE2QyxZQUFZO0FBQ3JELFFBQUlDLE9BQU8sR0FBRyxDQUFDLENBQWY7QUFBQSxRQUNJQyxJQURKO0FBR0FDLElBQUFBLENBQUMsQ0FBQyxpQkFBRCxDQUFELENBQXFCQyxJQUFyQixDQUEwQixFQUExQjtBQUVBLFFBQUlDLFFBQVEsaVFBQVo7O0FBSUEsV0FBT0gsSUFBSSxHQUFHLEtBQUtJLEtBQUwsQ0FBVyxFQUFFTCxPQUFiLENBQWQsRUFBcUM7QUFDakMsVUFBSU0sTUFBTSxHQUFHLElBQUlWLFVBQUosRUFBYjs7QUFDQVUsTUFBQUEsTUFBTSxDQUFDQyxTQUFQLEdBQW9CLFlBQVk7QUFDNUIsZUFBTyxZQUFZO0FBQ2YsY0FBSUMsR0FBRyxHQUFHSixRQUFRLENBQUNLLE9BQVQsQ0FBaUIsU0FBakIsRUFBNEIsS0FBS0MsTUFBakMsQ0FBVjtBQUNBUixVQUFBQSxDQUFDLENBQUMsaUJBQUQsQ0FBRCxDQUFxQlMsTUFBckIsQ0FBNEJILEdBQTVCO0FBQ0gsU0FIRDtBQUlILE9BTGtCLENBS2hCUCxJQUxnQixDQUFuQjs7QUFNQUssTUFBQUEsTUFBTSxDQUFDTSxhQUFQLENBQXFCWCxJQUFyQjtBQUNIO0FBQ0osR0FwQkQ7QUFxQkg7O0FBRURDLENBQUMsQ0FBQ0wsUUFBRCxDQUFELENBQVlnQixLQUFaLENBQWtCLFVBQVVDLENBQVYsRUFBYTtBQUMzQlosRUFBQUEsQ0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQmEsTUFBaEIsQ0FBdUIsWUFBWTtBQUMvQixRQUFJVCxNQUFNLEdBQUcsSUFBSVYsVUFBSixFQUFiOztBQUNBVSxJQUFBQSxNQUFNLENBQUNVLE1BQVAsR0FBZ0IsVUFBQ0YsQ0FBRCxFQUFPO0FBQ25CWixNQUFBQSxDQUFDLENBQUMsb0JBQUQsQ0FBRCxDQUF3QmUsSUFBeEIsQ0FBNkIsS0FBN0IsRUFBb0NILENBQUMsQ0FBQ0ksTUFBRixDQUFTUixNQUE3QztBQUNILEtBRkQ7O0FBR0FKLElBQUFBLE1BQU0sQ0FBQ00sYUFBUCxDQUFxQixLQUFLUCxLQUFMLENBQVcsQ0FBWCxDQUFyQjtBQUNILEdBTkQ7QUFPSCxDQVJEIiwic291cmNlc0NvbnRlbnQiOlsiaWYgKHdpbmRvdy5GaWxlUmVhZGVyKSB7XG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJpbWFnZXNcIikub25jaGFuZ2UgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGxldCBjb3VudGVyID0gLTEsXG4gICAgICAgICAgICBmaWxlO1xuXG4gICAgICAgICQoJy5pbWFnZXMtd3JhcHBlcicpLmh0bWwoJycpO1xuXG4gICAgICAgIGxldCB0ZW1wbGF0ZSA9IGA8ZGl2IGNsYXNzPVwiY29sLXNtLTEyIGQtZmxleCBqdXN0aWZ5LWNvbnRlbnQtY2VudGVyIGFsaWduLWl0ZW1zLWNlbnRlclwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxpbWcgc3JjPVwiX191cmxfX1wiIGNsYXNzPVwiY2FyZC1pbWctdG9wXCIgc3R5bGU9XCJtYXgtd2lkdGg6IDgwJTsgbWFyZ2luOiAwIGF1dG87IGRpc3BsYXk6IGJsb2NrO1wiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5gO1xuXG4gICAgICAgIHdoaWxlIChmaWxlID0gdGhpcy5maWxlc1srK2NvdW50ZXJdKSB7XG4gICAgICAgICAgICBsZXQgcmVhZGVyID0gbmV3IEZpbGVSZWFkZXIoKTtcbiAgICAgICAgICAgIHJlYWRlci5vbmxvYWRlbmQgPSAoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIHJldHVybiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgIGxldCBpbWcgPSB0ZW1wbGF0ZS5yZXBsYWNlKCdfX3VybF9fJywgdGhpcy5yZXN1bHQpO1xuICAgICAgICAgICAgICAgICAgICAkKCcuaW1hZ2VzLXdyYXBwZXInKS5hcHBlbmQoaW1nKVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pKGZpbGUpO1xuICAgICAgICAgICAgcmVhZGVyLnJlYWRBc0RhdGFVUkwoZmlsZSk7XG4gICAgICAgIH1cbiAgICB9XG59XG5cbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uIChlKSB7XG4gICAgJCgnI3RodW1ibmFpbCcpLmNoYW5nZShmdW5jdGlvbiAoKSB7XG4gICAgICAgIGxldCByZWFkZXIgPSBuZXcgRmlsZVJlYWRlcigpO1xuICAgICAgICByZWFkZXIub25sb2FkID0gKGUpID0+IHtcbiAgICAgICAgICAgICQoJyN0aHVtYm5haWwtcHJldmlldycpLmF0dHIoJ3NyYycsIGUudGFyZ2V0LnJlc3VsdCk7XG4gICAgICAgIH1cbiAgICAgICAgcmVhZGVyLnJlYWRBc0RhdGFVUkwodGhpcy5maWxlc1swXSk7XG4gICAgfSk7XG59KTtcbiJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvaW1hZ2VzLXByZXZpZXcuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/images-preview.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/images-preview.js"]();
/******/ 	
/******/ })()
;