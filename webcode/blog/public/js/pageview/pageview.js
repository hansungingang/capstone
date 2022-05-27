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

/***/ "./resources/js/pageview/pageview.js":
/*!*******************************************!*\
  !*** ./resources/js/pageview/pageview.js ***!
  \*******************************************/
/***/ (() => {

eval("document.addEventListener(\"DOMContentLoaded\", function () {\n  $.ajaxSetup({\n    headers: {\n      'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n    }\n  });\n  $.ajax({\n    type: \"post\",\n    url: \"/pageview\",\n    data: {\n      'current_url': $('#current').attr('value'),\n      'referer': $('#referer').attr('value')\n    },\n    success: function success(result) {}\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcGFnZXZpZXcvcGFnZXZpZXcuanM/ZDUyYSJdLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCIkIiwiYWpheFNldHVwIiwiaGVhZGVycyIsImF0dHIiLCJhamF4IiwidHlwZSIsInVybCIsImRhdGEiLCJzdWNjZXNzIiwicmVzdWx0Il0sIm1hcHBpbmdzIjoiQUFBQUEsUUFBUSxDQUFDQyxnQkFBVCxDQUEwQixrQkFBMUIsRUFBOEMsWUFBVTtBQUNwREMsRUFBQUEsQ0FBQyxDQUFDQyxTQUFGLENBQVk7QUFDUkMsSUFBQUEsT0FBTyxFQUFFO0FBQ0wsc0JBQWdCRixDQUFDLENBQUMseUJBQUQsQ0FBRCxDQUE2QkcsSUFBN0IsQ0FBa0MsU0FBbEM7QUFEWDtBQURELEdBQVo7QUFLQUgsRUFBQUEsQ0FBQyxDQUFDSSxJQUFGLENBQU87QUFDSEMsSUFBQUEsSUFBSSxFQUFFLE1BREg7QUFFSEMsSUFBQUEsR0FBRyxFQUFFLFdBRkY7QUFHSEMsSUFBQUEsSUFBSSxFQUFDO0FBQ0QscUJBQWdCUCxDQUFDLENBQUMsVUFBRCxDQUFELENBQWNHLElBQWQsQ0FBbUIsT0FBbkIsQ0FEZjtBQUVELGlCQUFZSCxDQUFDLENBQUMsVUFBRCxDQUFELENBQWNHLElBQWQsQ0FBbUIsT0FBbkI7QUFGWCxLQUhGO0FBT0hLLElBQUFBLE9BQU8sRUFBRSxpQkFBVUMsTUFBVixFQUFrQixDQUUxQjtBQVRFLEdBQVA7QUFXSCxDQWpCRCIsInNvdXJjZXNDb250ZW50IjpbImRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsIGZ1bmN0aW9uKCl7XHJcbiAgICAkLmFqYXhTZXR1cCh7XHJcbiAgICAgICAgaGVhZGVyczoge1xyXG4gICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKVxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG4gICAgJC5hamF4KHtcclxuICAgICAgICB0eXBlOiBcInBvc3RcIixcclxuICAgICAgICB1cmw6IFwiL3BhZ2V2aWV3XCIsXHJcbiAgICAgICAgZGF0YTp7XHJcbiAgICAgICAgICAgICdjdXJyZW50X3VybCcgOiAkKCcjY3VycmVudCcpLmF0dHIoJ3ZhbHVlJyksXHJcbiAgICAgICAgICAgICdyZWZlcmVyJyA6ICQoJyNyZWZlcmVyJykuYXR0cigndmFsdWUnKVxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKHJlc3VsdCkge1xyXG4gICAgICAgICAgIFxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59KTsiXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL3BhZ2V2aWV3L3BhZ2V2aWV3LmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/pageview/pageview.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/pageview/pageview.js"]();
/******/ 	
/******/ })()
;