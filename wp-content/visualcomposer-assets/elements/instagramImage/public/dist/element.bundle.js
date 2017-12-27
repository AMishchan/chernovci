webpackJsonp([0],{

/***/ 0:
/***/ function(module, exports, __webpack_require__) {

	eval("'use strict';\n\nvar _vcCake = __webpack_require__(\"./node_modules/vc-cake/index.js\");\n\nvar _vcCake2 = _interopRequireDefault(_vcCake);\n\nvar _component = __webpack_require__(\"./instagramImage/component.js\");\n\nvar _component2 = _interopRequireDefault(_component);\n\nfunction _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }\n\nvar vcvAddElement = _vcCake2.default.getService('cook').add;\n\nvcvAddElement(__webpack_require__(\"./instagramImage/settings.json\"),\n// Component callback\nfunction (component) {\n  component.add(_component2.default);\n},\n// css settings // css for element\n{ \"css\": __webpack_require__(\"./node_modules/raw-loader/index.js!./instagramImage/styles.css\"), \"editorCss\": __webpack_require__(\"./node_modules/raw-loader/index.js!./instagramImage/editor.css\") }, '');\n\n/*****************\n ** WEBPACK FOOTER\n ** ./instagramImage/index.js\n ** module id = 0\n ** module chunks = 0\n **/\n//# sourceURL=webpack:///./instagramImage/index.js?");

/***/ },

/***/ "./instagramImage/component.js":
/***/ function(module, exports, __webpack_require__) {

	eval("'use strict';\n\nObject.defineProperty(exports, \"__esModule\", {\n  value: true\n});\n\nvar _extends2 = __webpack_require__(\"./node_modules/babel-runtime/helpers/extends.js\");\n\nvar _extends3 = _interopRequireDefault(_extends2);\n\nvar _getPrototypeOf = __webpack_require__(\"./node_modules/babel-runtime/core-js/object/get-prototype-of.js\");\n\nvar _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);\n\nvar _classCallCheck2 = __webpack_require__(\"./node_modules/babel-runtime/helpers/classCallCheck.js\");\n\nvar _classCallCheck3 = _interopRequireDefault(_classCallCheck2);\n\nvar _createClass2 = __webpack_require__(\"./node_modules/babel-runtime/helpers/createClass.js\");\n\nvar _createClass3 = _interopRequireDefault(_createClass2);\n\nvar _possibleConstructorReturn2 = __webpack_require__(\"./node_modules/babel-runtime/helpers/possibleConstructorReturn.js\");\n\nvar _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);\n\nvar _inherits2 = __webpack_require__(\"./node_modules/babel-runtime/helpers/inherits.js\");\n\nvar _inherits3 = _interopRequireDefault(_inherits2);\n\nvar _react = __webpack_require__(\"./node_modules/react/react.js\");\n\nvar _react2 = _interopRequireDefault(_react);\n\nvar _vcCake = __webpack_require__(\"./node_modules/vc-cake/index.js\");\n\nvar _vcCake2 = _interopRequireDefault(_vcCake);\n\nfunction _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }\n\nvar vcvAPI = _vcCake2.default.getService('api');\nvar cook = _vcCake2.default.getService(\"cook\");\n\nvar InstagramImage = function (_vcvAPI$elementCompon) {\n  (0, _inherits3.default)(InstagramImage, _vcvAPI$elementCompon);\n\n  function InstagramImage() {\n    (0, _classCallCheck3.default)(this, InstagramImage);\n    return (0, _possibleConstructorReturn3.default)(this, (InstagramImage.__proto__ || (0, _getPrototypeOf2.default)(InstagramImage)).apply(this, arguments));\n  }\n\n  (0, _createClass3.default)(InstagramImage, [{\n    key: 'componentDidMount',\n    value: function componentDidMount() {\n      if (this.props.atts.width) {\n        this.checkCustomSize(this.props.atts.width);\n      }\n      this.insertInstagram(this.props.atts.instagramUrl, this.props.atts.includeCaption);\n    }\n  }, {\n    key: 'componentWillReceiveProps',\n    value: function componentWillReceiveProps(nextProps) {\n      if (nextProps.atts.width) {\n        this.checkCustomSize(nextProps.atts.width);\n      } else {\n        this.setState({\n          size: null\n        });\n      }\n\n      if (this.props.atts.instagramUrl !== nextProps.atts.instagramUrl || this.props.atts.includeCaption !== nextProps.atts.includeCaption) {\n        this.insertInstagram(nextProps.atts.instagramUrl, nextProps.atts.includeCaption);\n      }\n    }\n  }, {\n    key: 'checkCustomSize',\n    value: function checkCustomSize(width) {\n      width = this.validateSize(width);\n      width = /^\\d+$/.test(width) ? width + 'px' : width;\n      var size = { width: width };\n      this.setSizeState(size);\n    }\n  }, {\n    key: 'validateSize',\n    value: function validateSize(value) {\n      var units = ['px', 'em', 'rem', '%', 'vw', 'vh'];\n      var re = new RegExp('^-?\\\\d*(\\\\.\\\\d{0,9})?(' + units.join('|') + ')?$');\n      if (value === '' || value.match(re)) {\n        return value;\n      } else {\n        return null;\n      }\n    }\n  }, {\n    key: 'setSizeState',\n    value: function setSizeState(size) {\n      this.setState({ size: size });\n    }\n  }, {\n    key: 'updateInstagramHtml',\n    value: function updateInstagramHtml() {\n      var tagString = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';\n\n      tagString = tagString.replace(/max-width\\:\\d+px\\;/g, 'max-width:100%;');\n      var component = this.getDomNode().querySelector('.vce-instagram-image-wrapper');\n      this.updateInlineHtml(component, tagString);\n      var iframe = document.querySelector('#vcv-editor-iframe').contentWindow;\n      if (iframe && iframe.instgrm && iframe.instgrm.Embeds) {\n        iframe.instgrm.Embeds.process();\n      }\n    }\n  }, {\n    key: 'loadJSONP',\n    value: function loadJSONP(url, callback, context) {\n      var name = '_jsonp_instagramImage_' + InstagramImage.unique++;\n      if (url.indexOf('?') >= 0) {\n        url += '&callback=' + name;\n      } else {\n        url += '?callback=' + name;\n      }\n\n      var script = document.createElement('script');\n      script.type = 'text/javascript';\n      script.async = true;\n      script.src = url;\n\n      var clearScript = function clearScript() {\n        document.getElementsByTagName('head')[0].removeChild(script);\n        script = null;\n        delete window[name];\n      };\n\n      var timeout = 10; // 10 second by default\n      var timeoutTrigger = window.setTimeout(function () {\n        clearScript();\n      }, timeout * 1000);\n\n      window[name] = function (data) {\n        window.clearTimeout(timeoutTrigger);\n        callback.call(context || window, data);\n        clearScript();\n      };\n\n      document.getElementsByTagName('head')[0].appendChild(script);\n    }\n  }, {\n    key: 'insertInstagram',\n    value: function insertInstagram(url, includeCaption) {\n      var _this2 = this;\n\n      if (url.match('instagram-media')) {\n        this.updateInstagramHtml(url);\n      } else {\n        var createdUrl = 'https://api.instagram.com/oembed/?url=' + url + '&hidecaption=' + !includeCaption;\n        this.loadJSONP(createdUrl, function (data) {\n          _this2.updateInstagramHtml(data.html);\n          _this2.props.api.request('layout:rendered', true);\n        });\n      }\n    }\n  }, {\n    key: 'render',\n    value: function render() {\n      var _props = this.props,\n          id = _props.id,\n          atts = _props.atts,\n          editor = _props.editor;\n      var customClass = atts.customClass,\n          width = atts.width,\n          alignment = atts.alignment,\n          metaCustomId = atts.metaCustomId;\n\n      var classes = 'vce-instagram-image';\n      var wrapperClasses = 'vce-instagram-image-wrapper vce';\n      var customProps = {};\n      var innerCustomProps = {};\n\n      if (typeof customClass === 'string' && customClass) {\n        classes += ' ' + customClass;\n      }\n\n      if (width) {\n        innerCustomProps.style = this.state ? this.state.size : null;\n      }\n\n      if (alignment) {\n        classes += ' vce-instagram-image--align-' + alignment;\n      }\n\n      customProps.key = 'customProps:' + id;\n\n      if (metaCustomId) {\n        customProps.id = metaCustomId;\n      }\n\n      var doAll = this.applyDO('all');\n\n      return _react2.default.createElement(\n        'div',\n        (0, _extends3.default)({}, customProps, { className: classes }, editor),\n        _react2.default.createElement('div', (0, _extends3.default)({ className: wrapperClasses, id: 'el-' + id }, doAll, innerCustomProps))\n      );\n    }\n  }]);\n  return InstagramImage;\n}(vcvAPI.elementComponent);\n\nInstagramImage.unique = 0;\nexports.default = InstagramImage;\n\n/*****************\n ** WEBPACK FOOTER\n ** ./instagramImage/component.js\n ** module id = ./instagramImage/component.js\n ** module chunks = 0\n **/\n//# sourceURL=webpack:///./instagramImage/component.js?");

/***/ },

/***/ "./instagramImage/settings.json":
/***/ function(module, exports) {

	eval("module.exports = {\"instagramUrl\":{\"type\":\"string\",\"access\":\"public\",\"value\":\"https://www.instagram.com/p/BJPIEc8BHEI/\",\"options\":{\"label\":\"Instagram URL (Link) or embed code\",\"link\":true}},\"designOptions\":{\"type\":\"designOptions\",\"access\":\"public\",\"value\":{},\"options\":{\"label\":\"Design Options\"}},\"editFormTab1\":{\"type\":\"group\",\"access\":\"protected\",\"value\":[\"instagramUrl\",\"width\",\"includeCaption\",\"alignment\",\"metaCustomId\",\"customClass\"],\"options\":{\"label\":\"General\"}},\"metaEditFormTabs\":{\"type\":\"group\",\"access\":\"protected\",\"value\":[\"editFormTab1\",\"designOptions\"]},\"relatedTo\":{\"type\":\"group\",\"access\":\"protected\",\"value\":[\"General\"]},\"customClass\":{\"type\":\"string\",\"access\":\"public\",\"value\":\"\",\"options\":{\"label\":\"Extra class name\",\"description\":\"Add an extra class name to the element and refer to it from Custom CSS option.\"}},\"assetsLibrary\":{\"access\":\"public\",\"type\":\"string\",\"value\":[\"animate\"]},\"width\":{\"type\":\"string\",\"access\":\"public\",\"value\":\"660px\",\"options\":{\"label\":\"Width\",\"description\":\"Enter width in pixels or percentages (Example: 200px).\"}},\"alignment\":{\"type\":\"buttonGroup\",\"access\":\"public\",\"value\":\"left\",\"options\":{\"label\":\"Alignment\",\"values\":[{\"label\":\"Left\",\"value\":\"left\",\"icon\":\"vcv-ui-icon-attribute-alignment-left\"},{\"label\":\"Center\",\"value\":\"center\",\"icon\":\"vcv-ui-icon-attribute-alignment-center\"},{\"label\":\"Right\",\"value\":\"right\",\"icon\":\"vcv-ui-icon-attribute-alignment-right\"}]}},\"includeCaption\":{\"type\":\"toggle\",\"access\":\"public\",\"value\":true,\"options\":{\"label\":\"Include caption\"}},\"metaDisableInteractionInEditor\":{\"type\":\"toggle\",\"access\":\"protected\",\"value\":true},\"metaBackendLabels\":{\"type\":\"group\",\"access\":\"protected\",\"value\":[{\"value\":[\"instagramUrl\"]}]},\"metaCustomId\":{\"type\":\"customId\",\"access\":\"public\",\"value\":\"\",\"options\":{\"label\":\"Element ID\",\"description\":\"Apply unique Id to element to link directly to it by using #your_id (for element id use lowercase input only).\"}},\"tag\":{\"access\":\"protected\",\"type\":\"string\",\"value\":\"instagramImage\"}}\n\n/*****************\n ** WEBPACK FOOTER\n ** ./instagramImage/settings.json\n ** module id = ./instagramImage/settings.json\n ** module chunks = 0\n **/\n//# sourceURL=webpack:///./instagramImage/settings.json?");

/***/ },

/***/ "./node_modules/raw-loader/index.js!./instagramImage/styles.css":
/***/ function(module, exports) {

	eval("module.exports = \".vce-instagram-image iframe {\\n  display: block;\\n  vertical-align: top;\\n}\\n\\n.vce-instagram-image-wrapper {\\n  display: inline-block;\\n  max-width: 100%;\\n}\\n\\n.vce-instagram-image-inner {\\n  width: 100%;\\n  max-width: 100%;\\n  display: inline-block;\\n  vertical-align: top;\\n}\\n\\n.vce-instagram-image--align-center {\\n  text-align: center;\\n}\\n\\n.vce-instagram-image--align-right {\\n  text-align: right;\\n}\\n\\n.vce-instagram-image--align-left {\\n  text-align: left;\\n}\"\n\n/*****************\n ** WEBPACK FOOTER\n ** ./~/raw-loader!./instagramImage/styles.css\n ** module id = ./node_modules/raw-loader/index.js!./instagramImage/styles.css\n ** module chunks = 0\n **/\n//# sourceURL=webpack:///./instagramImage/styles.css?./~/raw-loader");

/***/ },

/***/ "./node_modules/raw-loader/index.js!./instagramImage/editor.css":
/***/ function(module, exports) {

	eval("module.exports = \"[data-vcv-element-disable-interaction=\\\"true\\\"] .vce-instagram-image-wrapper {\\n  position: relative;\\n}\\n\\n[data-vcv-element-disable-interaction=\\\"true\\\"] .vce-instagram-image-wrapper::after {\\n  content: \\\"\\\";\\n  position: absolute;\\n  top: 0;\\n  right: 0;\\n  bottom: 0;\\n  left: 0;\\n  z-index: 999;\\n}\\n\\n.vce-instagram-image {\\n  min-height: 1em;\\n}\\n\"\n\n/*****************\n ** WEBPACK FOOTER\n ** ./~/raw-loader!./instagramImage/editor.css\n ** module id = ./node_modules/raw-loader/index.js!./instagramImage/editor.css\n ** module chunks = 0\n **/\n//# sourceURL=webpack:///./instagramImage/editor.css?./~/raw-loader");

/***/ }

});