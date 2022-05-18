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

/***/ "./resources/js/images-actions.js":
/*!****************************************!*\
  !*** ./resources/js/images-actions.js ***!
  \****************************************/
/***/ (() => {

eval("$(function () {\n  $.ajaxSetup({\n    headers: {\n      'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n    }\n  });\n  $(document).on('click', '.remove-product-image', function (e) {\n    e.preventDefault();\n    var $btn = $(this);\n    $.ajax({\n      url: $btn.data('route'),\n      type: 'DELETE',\n      dataType: 'json',\n      success: function success(data) {\n        $btn.parent().remove();\n      },\n      error: function error(data) {\n        console.log('Error: ', data);\n      }\n    });\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvaW1hZ2VzLWFjdGlvbnMuanM/MzAyZCJdLCJuYW1lcyI6WyIkIiwiYWpheFNldHVwIiwiaGVhZGVycyIsImF0dHIiLCJkb2N1bWVudCIsIm9uIiwiZSIsInByZXZlbnREZWZhdWx0IiwiJGJ0biIsImFqYXgiLCJ1cmwiLCJkYXRhIiwidHlwZSIsImRhdGFUeXBlIiwic3VjY2VzcyIsInBhcmVudCIsInJlbW92ZSIsImVycm9yIiwiY29uc29sZSIsImxvZyJdLCJtYXBwaW5ncyI6IkFBQUFBLENBQUMsQ0FBQyxZQUFZO0FBRVZBLEVBQUFBLENBQUMsQ0FBQ0MsU0FBRixDQUFZO0FBQ1JDLElBQUFBLE9BQU8sRUFBRTtBQUNMLHNCQUFnQkYsQ0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkJHLElBQTdCLENBQWtDLFNBQWxDO0FBRFg7QUFERCxHQUFaO0FBTUFILEVBQUFBLENBQUMsQ0FBQ0ksUUFBRCxDQUFELENBQVlDLEVBQVosQ0FBZSxPQUFmLEVBQXdCLHVCQUF4QixFQUFpRCxVQUFVQyxDQUFWLEVBQWE7QUFDMURBLElBQUFBLENBQUMsQ0FBQ0MsY0FBRjtBQUNBLFFBQUlDLElBQUksR0FBR1IsQ0FBQyxDQUFDLElBQUQsQ0FBWjtBQUVBQSxJQUFBQSxDQUFDLENBQUNTLElBQUYsQ0FBTztBQUNIQyxNQUFBQSxHQUFHLEVBQUVGLElBQUksQ0FBQ0csSUFBTCxDQUFVLE9BQVYsQ0FERjtBQUVIQyxNQUFBQSxJQUFJLEVBQUUsUUFGSDtBQUdIQyxNQUFBQSxRQUFRLEVBQUUsTUFIUDtBQUlIQyxNQUFBQSxPQUFPLEVBQUUsaUJBQVNILElBQVQsRUFBZTtBQUNwQkgsUUFBQUEsSUFBSSxDQUFDTyxNQUFMLEdBQWNDLE1BQWQ7QUFDSCxPQU5FO0FBT0hDLE1BQUFBLEtBQUssRUFBRSxlQUFVTixJQUFWLEVBQWdCO0FBQ25CTyxRQUFBQSxPQUFPLENBQUNDLEdBQVIsQ0FBWSxTQUFaLEVBQXVCUixJQUF2QjtBQUNIO0FBVEUsS0FBUDtBQVdILEdBZkQ7QUFnQkgsQ0F4QkEsQ0FBRCIsInNvdXJjZXNDb250ZW50IjpbIiQoZnVuY3Rpb24gKCkge1xuXG4gICAgJC5hamF4U2V0dXAoe1xuICAgICAgICBoZWFkZXJzOiB7XG4gICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKVxuICAgICAgICB9XG4gICAgfSk7XG5cbiAgICAkKGRvY3VtZW50KS5vbignY2xpY2snLCAnLnJlbW92ZS1wcm9kdWN0LWltYWdlJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICBsZXQgJGJ0biA9ICQodGhpcyk7XG5cbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIHVybDogJGJ0bi5kYXRhKCdyb3V0ZScpLFxuICAgICAgICAgICAgdHlwZTogJ0RFTEVURScsXG4gICAgICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24oZGF0YSkge1xuICAgICAgICAgICAgICAgICRidG4ucGFyZW50KCkucmVtb3ZlKCk7XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgZXJyb3I6IGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ0Vycm9yOiAnLCBkYXRhKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfSlcbn0pO1xuIl0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy9pbWFnZXMtYWN0aW9ucy5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/images-actions.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/images-actions.js"]();
/******/ 	
/******/ })()
;