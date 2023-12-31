/*!
 * Variation js events for WooCommerce
 *
 * Author: Emran Ahmed
 * Released under the GPLv3 license.
 */
(function() { // webpackBootstrap
  // This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
  !function() {
    function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

    function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e2) { throw _e2; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e3) { didErr = true; err = _e3; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

    function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

    function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

    function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

    function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

    function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

    function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

    function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

    function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

    function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

    // ================================================================
    // WooCommerce Variation Swatches
    // ================================================================

    (function (window) {
      'use strict';

      var AH_Woo_Variation_Plugin = function ($) {
        return /*#__PURE__*/function () {
          function _class2(element, options, name) {
            _classCallCheck(this, _class2);

            _defineProperty(this, "defaults", {});

            // Assign
            this.name = name;
            this.element = element;
            this.$element = $(element);
            this.settings = $.extend(true, {}, this.defaults, options);
            this.product_variations = this.$element.data('product_variations') || [];
            this.is_ajax_variation = this.product_variations.length < 1;
            this.product_id = this.$element.data('product_id');
            this.reset_variations = this.$element.find('.reset_variations');
            this.attributeFields = this.$element.find('.variations select');
            this.selected_item_template = "<span class=\"ahura-product-selected-variation-item-name\" data-default=\"\"></span>";
            this.$element.addClass('ahura-loaded'); // Call

            this.init();
            this.update(); // Trigger

            $(document).trigger('ahura_woo_variation_loaded', this);
          }

          _createClass(_class2, [{
            key: "isAjaxVariation",
            value: function isAjaxVariation() {
              //this.product_variations = this.$element.data('product_variations') || []
              return this.is_ajax_variation; // = this.product_variations.length < 1
            }
          }, {
            key: "init",
            value: function init() {
              this.prepareLabel();
              this.prepareItems();
              this.setupItems();
              this.setupEvents();
              this.setUpStockInfo();
            }
          }, {
            key: "prepareLabel",
            value: function prepareLabel() {
              var _this = this;

              this.$element.find('.variations .label').each(function (index, el) {
                $(el).append(_this.selected_item_template);
              });
            }
          }, {
            key: "prepareItems",
            value: function prepareItems() {
              this.$element.find('ul.variable-items-wrapper').each(function (i, el) {
                $(el).parent().addClass('ahura-product-variation-items-wrapper');
              });
            }
          }, {
            key: "setupItems",
            value: function setupItems() {
              var _this2 = this;

              var self = this;
              this.$element.find('ul.variable-items-wrapper').each(function (i, element) {
                var selected = '';
                var $selected_variation_item = $(element).parent().prev().find('.ahura-product-selected-variation-item-name');
                var select = $(element).parent().find('select.ahura-product-woo-variation-raw-select');
                var options = select.find('option');
                var disabled = select.find('option:disabled');
                var out_of_stock = select.find('option.enabled.out-of-stock');
                var current = select.find('option:selected');
                var eq = select.find('option').eq(1);
                var selects = [];
                var disabled_selects = [];
                var out_of_stocks = []; // All Options

                options.each(function () {
                  if ($(this).val() !== '') {
                    selects.push($(this).val());
                    selected = current.length === 0 ? eq.val() : current.val();
                  }
                }); // Disabled

                disabled.each(function () {
                  if ($(this).val() !== '') {
                    disabled_selects.push($(this).val());
                  }
                }); // Out Of Stocks

                out_of_stock.each(function () {
                  if ($(this).val() !== '') {
                    out_of_stocks.push($(this).val());
                  }
                });

                var in_stocks = _.difference(selects, disabled_selects);

                _this2.setupItem(element, selected, in_stocks, out_of_stocks, $selected_variation_item);
              });
            }
          }, {
            key: "setupItem",
            value: function setupItem(element, selected, in_stocks, out_of_stocks, $selected_variation_item) {
              var _this3 = this;

              // Mark Selected
              $(element).find('li.variable-item').each(function (index, el) {
                var attribute_value = $(el).attr('data-value');
                var attribute_title = $(el).attr('data-title'); // Resetting LI

                // $(el).removeClass('selected disabled no-stock').addClass('disabled');
                $(el).attr('aria-checked', 'false');
                $(el).attr('tabindex', '-1');
                $(el).attr('data-tooltip-out-of-stock', '');
                $(el).find('input.variable-item-radio-input:radio').prop('disabled', true).prop('checked', false); // To Prevent blink

                $selected_variation_item.text('');

                if (_this3.isAjaxVariation()) {
                  $(el).find('input.variable-item-radio-input:radio').prop('disabled', false);
                  $(el).removeClass('selected disabled no-stock'); // Selected

                  if (attribute_value === selected) {
                    $(el).addClass('selected');
                    $(el).attr('aria-checked', 'true');
                    $(el).attr('tabindex', '0');
                    $(el).find('input.variable-item-radio-input:radio').prop('disabled', false).prop('checked', true);

                    $(el).trigger('ahura-item-updated', [selected, attribute_value]);
                  }
                } else {
                  // Default Selected
                  // We can't use es6 includes for IE11
                  // in_stocks.includes(attribute_value)
                  // _.contains(in_stocks, attribute_value)
                  // _.includes(in_stocks, attribute_value)
                  if (_.includes(in_stocks, attribute_value)) {
                    $(el).removeClass('selected disabled');
                    $(el).removeAttr('aria-hidden');
                    $(el).attr('tabindex', '0');
                    $(el).find('input.variable-item-radio-input:radio').prop('disabled', false); // Selected

                    if (attribute_value === selected) {
                      $(el).addClass('selected');
                      $(el).attr('aria-checked', 'true');
                      $(el).find('input.variable-item-radio-input:radio').prop('checked', true);

                      $(el).trigger('ahura-item-updated', [selected, attribute_value]);
                    }
                  } // Out of Stock

                }
              });
            }
          }, {
            key: "setupEvents",
            value: function setupEvents() {
              var self = this;
              this.$element.find('ul.variable-items-wrapper').each(function (i, element) {
                var select = $(element).parent().find('select.ahura-product-woo-variation-raw-select'); // Trigger Select event based on list

                $('body').on('click', 'ul.variable-items-wrapper .variable-item-span', function (){
                  let btn = $(this),
                      parent_el = btn.parent().parent(),
                      wrap = parent_el.parent(),
                      selected_el_name = wrap.data('attribute_name'),
                      select_el = $(`select[name="${selected_el_name}"]`);

                  if(select_el.length){
                    wrap.find('.selected').removeClass('selected');
                    parent_el.addClass('selected');
                    select_el.val(parent_el.data('value'));
                    select_el.trigger('change');
                  }
                });

                $(element).on('click.ahura', 'li.variable-item:not(.radio-variable-item):not(.color_var-variable-item)', function (event) {
                  event.preventDefault();
                  event.stopPropagation();
                  var value = $(this).data('value');
                  select.val(value).trigger('change');
                  select.trigger('click'); // select.trigger('focusin')

                  $(this).trigger('ahura-selected-item', [value, select, self.$element]); // Custom Event for li
                }); // Radio

                $(element).on('change.ahura', 'input.variable-item-radio-input:radio', function (event) {
                  event.preventDefault();
                  event.stopPropagation();
                  var value = $(this).val();
                  select.val(value).trigger('change');
                  select.trigger('click'); // select.trigger('focusin')


                  $(this).parent('li.radio-variable-item').removeClass('selected disabled no-stock').addClass('selected');
                  $(this).parent('li.radio-variable-item').trigger('ahura-selected-item', [value, select, self.$element]); // Custom Event for li
                });


                $(element).on('keydown.ahura', 'li.variable-item:not(.disabled)', function (event) {
                  if (event.keyCode && 32 === event.keyCode || event.key && ' ' === event.key || event.keyCode && 13 === event.keyCode || event.key && 'enter' === event.key.toLowerCase()) {
                    event.preventDefault();
                    $(this).trigger('click');
                  }
                });
              });
              this.$element.on('click.ahura', '.ahura-product-variation-variable-item-more', function (event) {
                event.preventDefault();
                $(this).parent().removeClass('enabled-display-limit-mode enabled-catalog-display-limit-mode');
                $(this).remove();
              });
            }
          }, {
            key: "update",
            value: function update() {
              var _this4 = this;

              // this.$element.off('woocommerce_variation_has_changed.ahura')
              this.$element.on('woocommerce_variation_has_changed.ahura', function (event) {
                // Don't use any propagation. It will disable composite product functionality
                // event.stopPropagation();
                _this4.setupItems();
              });
            }
          }, {
            key: "setUpStockInfo",
            value: function setUpStockInfo() {
              var _this5 = this;
            }
          }, {
            key: "resetStockInfo",
            value: function resetStockInfo() {
              this.$element.find('.variable-item').removeClass('show-stock-left-info');
              this.$element.find('.stock-left-info').attr('data-stock-info', '');
            }
          }, {
            key: "getChosenAttributes",
            value: function getChosenAttributes() {
              var data = {};
              var count = 0;
              var chosen = 0;
              this.attributeFields.each(function () {
                var attribute_name = $(this).data('attribute_name') || $(this).attr('name');
                var value = $(this).val() || '';

                if (value.length > 0) {
                  chosen++;
                }

                count++;
                data[attribute_name] = value;
              });
              return {
                'count': count,
                'chosenCount': chosen,
                'mayChosenCount': chosen + 1,
                'data': data
              };
            }
          }, {
            key: "findStockVariations",
            value: function findStockVariations(allVariations, selectedAttributes) {
              var found = [];

              for (var _i = 0, _Object$entries = Object.entries(selectedAttributes.data); _i < _Object$entries.length; _i++) {
                var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
                    attribute_name = _Object$entries$_i[0],
                    attribute_value = _Object$entries$_i[1];

                if (attribute_value.length === 0) {
                  var values = this.$element.find("ul[data-attribute_name='".concat(attribute_name, "']")).data('attribute_values') || [];

                  var _iterator = _createForOfIteratorHelper(values),
                      _step;

                  try {
                    for (_iterator.s(); !(_step = _iterator.n()).done;) {
                      var value = _step.value;

                      var compare = _.extend(selectedAttributes.data, _defineProperty({}, attribute_name, value));

                      var matched_variation = this.findMatchingVariations(allVariations, compare);

                      if (matched_variation.length > 0) {
                        var variation = matched_variation.shift();
                        var data = {};
                        data['attribute_name'] = attribute_name;
                        data['attribute_value'] = value;
                        data['variation'] = variation;
                        found.push(data);
                      }
                    }
                  } catch (err) {
                    _iterator.e(err);
                  } finally {
                    _iterator.f();
                  }
                }
              }

              return found;
            }
          }, {
            key: "findMatchingVariations",
            value: function findMatchingVariations(variations, attributes) {
              var matching = [];

              for (var i = 0; i < variations.length; i++) {
                var variation = variations[i];

                if (this.isMatch(variation.attributes, attributes)) {
                  matching.push(variation);
                }
              }

              return matching;
            }
          }, {
            key: "isMatch",
            value: function isMatch(variation_attributes, attributes) {
              var match = true;

              for (var attr_name in variation_attributes) {
                if (variation_attributes.hasOwnProperty(attr_name)) {
                  var val1 = variation_attributes[attr_name];
                  var val2 = attributes[attr_name];

                  if (val1 !== undefined && val2 !== undefined && val1.length !== 0 && val2.length !== 0 && val1 !== val2) {
                    match = false;
                  }
                }
              }

              return match;
            }
          }, {
            key: "destroy",
            value: function destroy() {
              this.$element.removeClass('ahura-loaded');
              this.$element.removeData(this.name);
            }
          }]);

          return _class2;
        }();
      }(jQuery);

      var jQueryPlugin = function ($) {
        return function (PluginName, ClassName) {
          $.fn[PluginName] = function (options) {
            var _this6 = this;

            for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
              args[_key - 1] = arguments[_key];
            }

            return this.each(function (index, element) {
              var $element = $(element); // let $element = $(this)

              var data = $element.data(PluginName);

              if (!data) {
                data = new ClassName($element, $.extend({}, options), PluginName);
                $element.data(PluginName, data);
              }

              if (typeof options === 'string') {
                if (_typeof(data[options]) === 'object') {
                  return data[options];
                }

                if (typeof data[options] === 'function') {
                  var _data;

                  return (_data = data)[options].apply(_data, args);
                }
              }

              return _this6;
            });
          }; // Constructor


          $.fn[PluginName].Constructor = ClassName; // Short hand

          $[PluginName] = function (options) {
            var _$;

            for (var _len2 = arguments.length, args = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
              args[_key2 - 1] = arguments[_key2];
            }

            return (_$ = $({}))[PluginName].apply(_$, [options].concat(args));
          }; // No Conflict


          $.fn[PluginName].noConflict = function () {
            return $.fn[PluginName];
          };
        };
      }(jQuery);

      jQueryPlugin('Ahura_Woo_Variations', AH_Woo_Variation_Plugin);
    })(window);
  }();
  // This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
  !function() {
    jQuery(function ($) {
      try {
        $(document).on('ahura_woo_variation_init', function () {
          $('.variations_form:not(.ahura-loaded)').Ahura_Woo_Variations(); // Any custom product with .ahura_variation_variations_form class to support

          $('.ahura_variation_variations_form:not(.ahura-loaded)').Ahura_Woo_Variations(); // Yith Composite Product

          $('.ywcp_inner_selected_container:not(.ahura-loaded)').Ahura_Woo_Variations();
        }); //.trigger('ahura_woo_variation_init')
      } catch (err) {
        // If failed (conflict?) log the error but don't stop other scripts breaking.
        window.console.log('Variation:', err);
      } // Init Ahura_Woo_Variations after wc_variation_form script loaded.


      $(document).on('wc_variation_form.ahura', function (event) {
        $(document).trigger('ahura_woo_variation_init');
      }); // Try to cover global ajax data complete

      $(document).ajaxComplete(function (event, request, settings) {
        setTimeout(function () {
          $('.variations_form:not(.ahura-loaded)').each(function () {
            $(this).wc_variation_form();
          });
        }, 100);
      }); // Composite Product Load
      // JS API: https://docs.woocommerce.com/document/composite-products/composite-products-js-api-reference/

      $(document.body).on('wc-composite-initializing', '.composite_data', function (event, composite) {
        composite.actions.add_action('component_options_state_changed', function (self) {
          $(self.$component_content).find('.variations_form').Ahura_Woo_Variations('destroy');
        });
        /* composite.actions.add_action('active_scenarios_updated', (self) => {
           console.log('active_scenarios_updated')
           $(self.$component_content).find('.variations_form').removeClass('ahura-loaded ahura-pro-loaded')
         })*/
      });
    });
  }();
  /******/ })();