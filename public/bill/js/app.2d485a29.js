(function (t) {
    function e(e) {
        for (var n, o, r = e[0], c = e[1], l = e[2], u = 0, p = []; u < r.length; u++) o = r[u], Object.prototype.hasOwnProperty.call(s, o) && s[o] && p.push(s[o][0]), s[o] = 0;
        for (n in c) Object.prototype.hasOwnProperty.call(c, n) && (t[n] = c[n]);
        d && d(e);
        while (p.length) p.shift()();
        return a.push.apply(a, l || []), i()
    }

    function i() {
        for (var t, e = 0; e < a.length; e++) {
            for (var i = a[e], n = !0, r = 1; r < i.length; r++) {
                var c = i[r];
                0 !== s[c] && (n = !1)
            }
            n && (a.splice(e--, 1), t = o(o.s = i[0]))
        }
        return t
    }

    var n = {}, s = {app: 0}, a = [];

    function o(e) {
        if (n[e]) return n[e].exports;
        var i = n[e] = {i: e, l: !1, exports: {}};
        return t[e].call(i.exports, i, i.exports, o), i.l = !0, i.exports
    }

    o.m = t, o.c = n, o.d = function (t, e, i) {
        o.o(t, e) || Object.defineProperty(t, e, {enumerable: !0, get: i})
    }, o.r = function (t) {
        "undefined" !== typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(t, "__esModule", {value: !0})
    }, o.t = function (t, e) {
        if (1 & e && (t = o(t)), 8 & e) return t;
        if (4 & e && "object" === typeof t && t && t.__esModule) return t;
        var i = Object.create(null);
        if (o.r(i), Object.defineProperty(i, "default", {
            enumerable: !0,
            value: t
        }), 2 & e && "string" != typeof t) for (var n in t) o.d(i, n, function (e) {
            return t[e]
        }.bind(null, n));
        return i
    }, o.n = function (t) {
        var e = t && t.__esModule ? function () {
            return t["default"]
        } : function () {
            return t
        };
        return o.d(e, "a", e), e
    }, o.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, o.p = "/";
    var r = window["webpackJsonp"] = window["webpackJsonp"] || [], c = r.push.bind(r);
    r.push = e, r = r.slice();
    for (var l = 0; l < r.length; l++) e(r[l]);
    var d = c;
    a.push([0, "chunk-vendors"]), i()
})({
    0: function (t, e, i) {
        t.exports = i("56d7")
    }, "56d7": function (t, e, i) {
        "use strict";
        i.r(e);
        i("e260"), i("e6cf"), i("cca6"), i("a79d");
        var n = i("2b0e"), s = function () {
                var t = this, e = t.$createElement, i = t._self._c || e;
                return i("div", {attrs: {id: "app"}}, [i("div", {staticClass: "sections"}, [i("ul", {staticClass: "tabs"}, [i("li", {
                    class: {active: t.isActive("all")},
                    on: {
                        click: function (e) {
                            return e.preventDefault(), t.setActive("all", "all")
                        }
                    }
                }, [t._v(" الكل ")]), t._l(t.categories, (function (e) {
                    return i("li", {
                        key: e.id, class: {active: t.isActive(e.name)}, on: {
                            click: function (i) {
                                return i.preventDefault(), t.setActive(e.name, e.id)
                            }
                        }
                    }, [t._v(" " + t._s(e.name) + " ")])
                }))], 2), i("div", {staticClass: "tab-content"}, [i("div", {staticClass: "tab"}, [t._l(t.products, (function (e) {
                    return i("div", {
                        directives: [{
                            name: "click-outside-app",
                            rawName: "v-click-outside-app",
                            value: t.done,
                            expression: "done"
                        }], key: e.id, staticClass: "product modal-opener", on: {
                            click: function (i) {
                                t.setActiveMenu("" + e.id), t.addProduct(e, {name: "بدون", id: null}, i)
                            }
                        }
                    }, [i("img", {
                        staticClass: "inner",
                        attrs: {src: e.image, alt: "product img"}
                    }), i("h3", {staticClass: "inner"}, [t._v(t._s(e.name))]), i("p", {staticClass: "inner"}, [t._v(t._s(e.price) + " ريال")]), 1 == e.is_cooking ? i("div", {
                        staticClass: "modal",
                        class: {active: t.isMenuActive("" + e.id)}
                    }, [i("ul", [i("li", [i("button", {
                        staticClass: "addButton", on: {
                            click: function (i) {
                                t.addProduct(e, {name: "بدون", id: null}, i), t.setActiveMenu("none")
                            }
                        }
                    }, [t._v(" بدون ")])]), t._l(t.cookingTypes, (function (n) {
                        return i("li", {key: n.id}, [i("button", {
                            staticClass: "addButton", on: {
                                click: function (i) {
                                    t.addProduct(e, n, i), t.setActiveMenu("none")
                                }
                            }
                        }, [t._v(" " + t._s(n.name) + " ")])])
                    }))], 2)]) : t._e()])
                })), t.products[0] ? t._e() : i("div", [t._v("لا يوجد أصناف في هذا القسم")])], 2)])]), i("div", {staticClass: "bill"}, [i("form", {
                    on: {
                        submit: function (e) {
                            return e.preventDefault(), t.saveInvoice.apply(null, arguments)
                        }
                    }
                }, [i("table", {staticClass: "bill-products"}, [t._m(0), t._l(t.productsInBill, (function (e) {
                    return i("tr", {key: e.product_id + e.cooking_id}, [i("td", [t._v(t._s(e.product_name))]), i("td", [i("input", {
                        directives: [{
                            name: "model",
                            rawName: "v-model",
                            value: e.product_price,
                            expression: "product.product_price"
                        }],
                        attrs: {type: "number", step: "0.01", name: "price", min: "1"},
                        domProps: {value: e.product_price},
                        on: {
                            change: t.handlePoints, input: function (i) {
                                i.target.composing || t.$set(e, "product_price", i.target.value)
                            }
                        }
                    })]), i("td", [i("input", {
                        directives: [{
                            name: "model",
                            rawName: "v-model",
                            value: e.quantity,
                            expression: "product.quantity"
                        }],
                        attrs: {type: "number", name: "qty", min: "1"},
                        domProps: {value: e.quantity},
                        on: {
                            change: t.handlePoints, input: function (i) {
                                i.target.composing || t.$set(e, "quantity", i.target.value)
                            }
                        }
                    })]), i("td", [t._v(t._s(e.cooking_name))]), i("td", [t._v(" " + t._s("بدون" == e.cooking_name ? 0 : "") + " "), "بدون" != e.cooking_name ? i("input", {
                        directives: [{
                            name: "model",
                            rawName: "v-model",
                            value: e.cooking_price,
                            expression: "product.cooking_price"
                        }],
                        attrs: {type: "number", step: "0.01", name: "cooking_price", min: "1"},
                        domProps: {value: e.cooking_price},
                        on: {
                            change: t.handlePoints, input: function (i) {
                                i.target.composing || t.$set(e, "cooking_price", i.target.value)
                            }
                        }
                    }) : t._e()]), i("td", [i("button", {
                        attrs: {type: "button"}, on: {
                            click: function (i) {
                                return t.removeItem(e)
                            }
                        }
                    }, [t._v("حذف")])])])
                })), t.productsInBill[0] ? t._e() : i("tr", [i("h4", [t._v("لا يوجد أصناف مضافة")])])], 2), i("table", {staticClass: "info"}, [i("tr", [i("td", [t._v("اجمالي المنتجات")]), i("td", [t._v(t._s(t.getTotal) + " ريال")])]), i("tr", [i("td", [t._v("الضريبة " + t._s(t.tax) + "%")]), i("td", [t._v(t._s(t.getTotal * t.tax / 100) + " ريال")])]), i("tr", [i("td", [t._v("الاجمالي")]), i("td", [t._v(t._s(t.getTotal * (+t.tax + 100) / 100) + " ريال")])]), i("tr", [t._m(1), i("td", [i("div", {
                    staticStyle: {
                        "min-width": "220px",
                        "margin-left": "15px",
                        display: "inline-block"
                    }
                }, [i("v-select", {
                    attrs: {label: "name", options: t.clients},
                    model: {
                        value: t.selectedClient, callback: function (e) {
                            t.selectedClient = e
                        }, expression: "selectedClient"
                    }
                })], 1), i("button", {
                    staticClass: "modal-opener", attrs: {type: "button"}, on: {
                        click: function (e) {
                            t.AddClientModal = !0
                        }
                    }
                }, [t._v(" إضافة عميل ")])])]), i("tr", [i("td", [t._v("رصيد العميل من النقاط")]), i("td", [t._v(t._s(t.selectedClient ? t.selectedClient.points : 0))])]), i("tr", [i("td", [t._v("النقاط")]), i("td", [i("input", {
                    directives: [{
                        name: "model",
                        rawName: "v-model",
                        value: t.usePoints,
                        expression: "usePoints"
                    }],
                    attrs: {type: "checkbox", name: "", id: "use-points", disabled: !t.pointsCoverage},
                    domProps: {
                        checked: t.pointsCoverage,
                        checked: Array.isArray(t.usePoints) ? t._i(t.usePoints, null) > -1 : t.usePoints
                    },
                    on: {
                        change: [function (e) {
                            var i = t.usePoints, n = e.target, s = !!n.checked;
                            if (Array.isArray(i)) {
                                var a = null, o = t._i(i, a);
                                n.checked ? o < 0 && (t.usePoints = i.concat([a])) : o > -1 && (t.usePoints = i.slice(0, o).concat(i.slice(o + 1)))
                            } else t.usePoints = s
                        }, t.handlePoints]
                    }
                }), i("label", {attrs: {for: "use-points"}}, [t._v("استخدام النقاط")])])]), i("tr", [i("td", [t._v("حالة الفاتورة")]), i("td", [i("input", {
                    attrs: {
                        required: "",
                        type: "radio",
                        name: "bill-status",
                        id: "paid",
                        value: "paid"
                    }, on: {
                        change: function (e) {
                            return t.billStateChanged(e)
                        }
                    }
                }), i("label", {attrs: {for: "paid"}}, [t._v("مسددة كليا")]), i("input", {
                    attrs: {
                        disabled: "نقدي" == t.selectedClient.name,
                        type: "radio",
                        name: "bill-status",
                        id: "partially",
                        value: "partially"
                    }, on: {
                        change: function (e) {
                            return t.billStateChanged(e)
                        }
                    }
                }), i("label", {attrs: {for: "partially"}}, [t._v("مسددة جزئيا")]), i("input", {
                    attrs: {
                        disabled: "نقدي" == t.selectedClient.name,
                        type: "radio",
                        name: "bill-status",
                        id: "unpaid",
                        value: "unpaid"
                    }, on: {
                        change: function (e) {
                            return t.billStateChanged(e)
                        }
                    }
                }), i("label", {attrs: {for: "unpaid"}}, [t._v("غير مسددة")])])]), "partially" == t.billStatus ? i("tr", [i("td", [t._v(" المدفوع "), i("input", {
                    directives: [{
                        name: "model",
                        rawName: "v-model",
                        value: t.paid,
                        expression: "paid"
                    }],
                    attrs: {required: "", type: "number", name: "paid", min: "1", max: t.getTotal * (+t.tax + 100) / 100},
                    domProps: {value: t.paid},
                    on: {
                        input: function (e) {
                            e.target.composing || (t.paid = e.target.value)
                        }
                    }
                })]), i("td", [t._v("المتبقي " + t._s(t.getTotal * (+t.tax + 100) / 100 - t.paid))])]) : t._e(), t._m(2)]), i("input", {
                    attrs: {
                        type: "submit",
                        value: "حفظ"
                    }
                })])]), i("div", {staticStyle: {width: "100%"}}, t._l(3, (function (e) {
                    return i("div", {
                        key: e,
                        staticClass: "toPrint hide",
                        attrs: {id: ""}
                    }, [i("div", {domProps: {innerHTML: t._s(t.settings.invoice_top)}}), i("div", {staticClass: "upper-info"}, [i("p", [t._v("فاتورة رقم " + t._s(t.billCode))]), i("div", {staticClass: "details"}, [i("p", [t._v("اسم العميل")]), i("p", [t._v(t._s(t.selectedClient.name))])]), i("div", {staticClass: "details"}, [i("p", [t._v("حالة الدفع")]), i("p", [t._v(" " + t._s("paid" == t.billStatus ? "مسددة كليا" : "unpaid" == t.billStatus ? "غير مسددة" : "مسددة جزئيا") + " ")])]), i("div", {staticClass: "details"}, [i("p", [t._v("تاريخ الفاتورة")]), i("p", [t._v(t._s(t.getDate))])])]), i("hr"), i("table", [t._m(3, !0), t._l(t.productsInBill, (function (e, n) {
                        return i("tr", {key: e.product_id + e.cooking_id}, [i("td", [t._v(t._s(n + 1))]), i("td", [t._v(t._s(e.product_name))]), i("td", [t._v(t._s(e.product_price))]), i("td", [t._v(t._s(e.quantity))]), i("td", [t._v(t._s(e.cooking_name))]), i("td", [t._v(" " + t._s("بدون" == e.cooking_name ? 0 : e.cooking_price) + " ")]), i("td", [t._v(" " + t._s(e.product_price * e.quantity + parseFloat(e.cooking_price)) + " ")])])
                    }))], 2), i("hr"), i("div", {staticClass: "bill-summary"}, [i("div", {staticClass: "details"}, [i("p", [t._v("الاجمالي")]), i("p", [t._v(t._s(t.getTotal))])]), i("div", {staticClass: "details"}, [i("p", [t._v("ضريبة القيمة المضافة " + t._s(t.tax) + "%")]), i("p", [t._v(t._s(t.getTotal * t.tax / 100))])]), i("div", {staticClass: "details"}, [i("p", [t._v("اجمالي الفاتورة")]), i("p", [t._v(t._s(t.getTotal * (+t.tax + 100) / 100))])]), i("div", {staticClass: "details"}, [i("p", [t._v("المدفوع نقدي")]), i("p", [t._v(t._s(t.paid))])]), i("div", {staticClass: "details"}, [i("p", [t._v("المدفوع من النقاط")]), i("p", [t._v(t._s(t.discounted_from_points))])]), i("div", {staticClass: "details"}, [i("p", [t._v("المتبقي")]), i("p", [t._v(" " + t._s(t.getTotal * (+t.tax + 100) / 100 - t.paid - t.discounted_from_points) + " ")])])]), i("div", {domProps: {innerHTML: t._s(t.settings.invoice_bottom)}}), i("p", {staticClass: "copyright"}, [t._v("Powerd by Panorama Al-Qassim")])])
                })), 0), t.AddClientModal ? i("div", [i("transition", {attrs: {name: "model"}}, [i("div", {staticClass: "modal-mask"}, [i("div", {staticClass: "modal-wrapper"}, [i("div", {
                    directives: [{
                        name: "click-outside-app",
                        rawName: "v-click-outside-app",
                        value: t.close,
                        expression: "close"
                    }], staticClass: "modal"
                }, [i("form", {
                    staticClass: "modal-form", attrs: {action: ""}, on: {
                        submit: function (e) {
                            return e.preventDefault(), t.addClient.apply(null, arguments)
                        }
                    }
                }, [i("input", {
                    directives: [{
                        name: "model",
                        rawName: "v-model",
                        value: t.clientToAdd.name,
                        expression: "clientToAdd.name"
                    }],
                    attrs: {type: "text", name: "", placeholder: "اسم العميل", id: "", required: ""},
                    domProps: {value: t.clientToAdd.name},
                    on: {
                        input: function (e) {
                            e.target.composing || t.$set(t.clientToAdd, "name", e.target.value)
                        }
                    }
                }), i("input", {
                    directives: [{
                        name: "model",
                        rawName: "v-model",
                        value: t.clientToAdd.phone,
                        expression: "clientToAdd.phone"
                    }],
                    attrs: {type: "tel", name: "", placeholder: "رقم الجوال", id: "", required: ""},
                    domProps: {value: t.clientToAdd.phone},
                    on: {
                        input: function (e) {
                            e.target.composing || t.$set(t.clientToAdd, "phone", e.target.value)
                        }
                    }
                }), i("input", {
                    directives: [{
                        name: "model",
                        rawName: "v-model",
                        value: t.clientToAdd.address,
                        expression: "clientToAdd.address"
                    }],
                    attrs: {type: "text", name: "", placeholder: "العنوان", id: "", required: ""},
                    domProps: {value: t.clientToAdd.address},
                    on: {
                        input: function (e) {
                            e.target.composing || t.$set(t.clientToAdd, "address", e.target.value)
                        }
                    }
                }), i("textarea", {
                    attrs: {
                        name: "",
                        id: "",
                        placeholder: "ملاحظات",
                        cols: "30",
                        rows: "10"
                    }
                }), i("input", {
                    attrs: {
                        type: "submit",
                        value: "اضافة عميل"
                    }
                })])])])])])], 1) : t._e(), t.showError ? i("div", [i("transition", {attrs: {name: "model"}}, [i("div", {staticClass: "modal-mask"}, [i("div", {staticClass: "modal-wrapper"}, [i("div", {
                    directives: [{
                        name: "click-outside-app",
                        rawName: "v-click-outside-app",
                        value: t.close,
                        expression: "close"
                    }], staticClass: "modal"
                }, [t._v(" " + t._s(t.error) + " ")])])])])], 1) : t._e(), t.categories && t.products[0] && t.tax && t.cookingTypes[0] && t.clients[0] ? t._e() : i("Loader", [t._v("\\")])], 1)
            }, a = [function () {
                var t = this, e = t.$createElement, i = t._self._c || e;
                return i("tr", [i("th", [t._v("اسم الصنف")]), i("th", [t._v("السعر")]), i("th", [t._v("الكمية")]), i("th", [t._v("نوع الطبخ")]), i("th", [t._v("سعر الطبخ")]), i("th", [t._v("العمليات")])])
            }, function () {
                var t = this, e = t.$createElement, i = t._self._c || e;
                return i("td", [i("label", {attrs: {for: "client"}}, [t._v("اسم العميل")])])
            }, function () {
                var t = this, e = t.$createElement, i = t._self._c || e;
                return i("tr", [i("td", {staticStyle: {"vertical-align": "top"}}, [i("label", {staticStyle: {"margin-left": "130px"}}, [t._v("ملاحظات")])]), i("td", [i("textarea", {
                    attrs: {
                        name: "",
                        id: "",
                        cols: "65",
                        rows: "5"
                    }
                })])])
            }, function () {
                var t = this, e = t.$createElement, i = t._self._c || e;
                return i("tr", [i("th", [t._v("م")]), i("th", [t._v("الصنف")]), i("th", [t._v("السعر")]), i("th", [t._v("الكمية")]), i("th", [t._v("الطبخ")]), i("th", [t._v("سعر الطبخ")]), i("th", [t._v("الاجمالي")])])
            }], o = i("1da1"), r = (i("96cf"), i("99af"), i("b0c0"), i("4de4"), i("159b"), i("bc3a")), c = i.n(r),
            l = function () {
                var t = this, e = t.$createElement;
                t._self._c;
                return t._m(0)
            }, d = [function () {
                var t = this, e = t.$createElement, i = t._self._c || e;
                return i("div", {staticClass: "loader sub-loader flex center align"}, [i("div", {staticClass: "lds-roller sub-lds-roller"}, [i("div"), i("div"), i("div"), i("div"), i("div"), i("div"), i("div"), i("div")])])
            }], u = {name: "Loader"}, p = u, v = (i("bf8d"), i("2877")),
            m = Object(v["a"])(p, l, d, !1, null, "039f0549", null), _ = m.exports, h = {
                name: "App", data: function () {
                    return {
                        activeItem: "all",
                        activeMenu: null,
                        categories: null,
                        products: [],
                        cookingTypes: [],
                        productsInBill: [],
                        total: 0,
                        tax: null,
                        paid: 0,
                        billStatus: null,
                        modalappearance: !1,
                        requestBase: document.querySelector("meta[name='base']").content,
                        clients: [],
                        selectedClient: {name: "نقدي", id: null, points: 0},
                        AddClientModal: !1,
                        clientToAdd: {name: "", phone: "", address: "", notes: ""},
                        usePoints: !1,
                        showError: !1,
                        error: "",
                        billCode: null,
                        discounted_from_points: 0,
                        settings: {points: 0}
                    }
                }, components: {Loader: _}, computed: {
                    getTotal: function () {
                        var t = 0;
                        for (var e in this.productsInBill) t += this.productsInBill[e].product_price * this.productsInBill[e].quantity + +this.productsInBill[e].cooking_price;
                        return t
                    }, getDate: function () {
                        var t = new Date, e = t.getFullYear() + "-" + (t.getMonth() + 1) + "-" + t.getDate();
                        return e
                    }, pointsCoverage: function () {
                        return !!this.selectedClient && this.selectedClient.points * +this.settings.points > this.getTotal * (+this.tax + 100) / 100
                    }
                }, mounted: function () {
                    var t = this;
                    c.a.get("".concat(this.requestBase, "categories")).then((function (e) {
                        t.categories = e.data, t.getProducts("all")
                    })).catch((function (e) {
                        t.error = e, t.showError = !0
                    })), c.a.get("".concat(this.requestBase, "cooking-types")).then((function (e) {
                        t.cookingTypes = e.data
                    })).catch((function (e) {
                        console.warn = function () {
                        }, t.error = e, t.showError = !0
                    })), c.a.get("".concat(this.requestBase, "settings")).then((function (e) {
                        t.tax = e.data.tax, t.settings = e.data
                    })).catch((function (e) {
                        console.warn = function () {
                        }, t.error = e, t.showError = !0
                    })), c.a.get("".concat(this.requestBase, "clients")).then((function (e) {
                        t.clients = e.data
                    })).catch((function (e) {
                        console.warn = function () {
                        }, t.error = e, t.showError = !0
                    }))
                }, methods: {
                    done: function () {
                        this.setActiveMenu("none")
                    }, isActive: function (t) {
                        return this.activeItem === t
                    }, setActive: function (t, e) {
                        this.activeItem = t, this.getProducts(e)
                    }, getProducts: function (t) {
                        var e = this;
                        this.products = [], c.a.get("".concat(this.requestBase, "products").concat("all" == t ? "" : "?category_id=" + t)).then((function (t) {
                            e.products = t.data
                        }))
                    }, isMenuActive: function (t) {
                        return this.activeMenu === t
                    }, setActiveMenu: function (t) {
                        this.activeMenu = t
                    }, addProduct: function (t, e, i) {
                        if (i.stopPropagation(), 0 == t.is_cooking || 1 == t.is_cooking && i.target.classList.contains("addButton")) {
                            var n = {
                                product_name: t.name,
                                product_id: t.id,
                                product_price: t.price,
                                cooking_id: e.id,
                                cooking_name: e.name
                            }, s = !1;
                            for (var a in this.productsInBill) this.productsInBill[a].product_id == n.product_id && this.productsInBill[a].cooking_id == n.cooking_id && (s = !0, this.productsInBill[a].quantity = +this.productsInBill[a].quantity + 1);
                            s || (n.quantity = 1, n.cooking_price = 0, this.productsInBill.push(n))
                        }
                        this.handlePoints()
                    }, close: function () {
                        this.AddClientModal = !1, this.showError = !1, this.clientToAdd = {
                            name: "",
                            phone: "",
                            address: "",
                            notes: ""
                        }
                    }, addClient: function () {
                        var t = this;
                        c.a.post("".concat(this.requestBase, "clients"), this.clientToAdd).then((function (e) {
                            e.status && (t.clients.push({
                                id: e.data.id,
                                name: e.data.name
                            }), t.AddClientModal = !1, t.clientToAdd = {name: "", phone: "", address: "", notes: ""})
                        }))
                    }, removeItem: function (t) {
                        this.productsInBill = this.productsInBill.filter((function (e) {
                            return e !== t
                        }))
                    }, billStateChanged: function (t) {
                        this.billStatus = t.target.value, "paid" == t.target.value ? this.paid = this.getTotal * (+this.tax + 100) / 100 : this.paid = 0
                    }, handlePoints: function () {
                        var t = document.querySelectorAll("input[type='radio'"),
                            e = this.selectedClient.points * +this.settings.points;
                        e > this.getTotal * (+this.tax + 100) / 100 ? this.usePoints ? (this.discounted_from_points = this.getTotal * (+this.tax + 100) / 100, this.paid = 0, this.billStatus = "paid", t.forEach((function (t) {
                            "paid" == t.id ? t.checked = !0 : t.checked = !1, t.disabled = !0
                        }))) : (this.discounted_from_points = 0, t.forEach((function (t) {
                            t.disabled = !1
                        }))) : (this.discounted_from_points = 0, document.querySelector("input[type='checkbox']").checked = !1, this.usePoints = !1, "نقدي" == !this.selectedClient.name && t.forEach((function (t) {
                            t.disabled = !1
                        })))
                    }, saveInvoice: function () {
                        var t = this;
                        this.productsInBill[0] ? c.a.post("".concat(this.requestBase, "save-invoice"), {
                            products: this.productsInBill,
                            client_id: this.selectedClient.id,
                            total: this.getTotal * (+this.tax + 100) / 100,
                            status: this.billStatus,
                            received: "paid" == this.billStatus ? this.getTotal * (+this.tax + 100) / 100 : "unpaid" == this.billStatus ? 0 : this.paid,
                            is_points: this.usePoints ? 1 : 0
                        }).then(function () {
                            var e = Object(o["a"])(regeneratorRuntime.mark((function e(i) {
                                return regeneratorRuntime.wrap((function (e) {
                                    while (1) switch (e.prev = e.next) {
                                        case 0:
                                            i.data.status ? (t.billCode = i.data.code, t.$nextTick((function () {
                                                t.print(), t.productsInBill = [], t.selectedClient = {
                                                    name: "نقدي",
                                                    id: null,
                                                    points: 0
                                                }, t.usePoints = !1, t.paid = 0, t.billCode = null, document.querySelectorAll("input[type='radio'").forEach((function (t) {
                                                    t.checked = !1
                                                }))
                                            }))) : (t.error = i.data.msg, t.showError = !0);
                                        case 1:
                                        case"end":
                                            return e.stop()
                                    }
                                }), e)
                            })));
                            return function (t) {
                                return e.apply(this, arguments)
                            }
                        }()).catch((function (e) {
                            t.error = e, t.showError = !0
                        })) : (this.error = "لا يوجد أصناف مضافة في الفاتورة", this.showError = !0)
                    }, print: function () {
                        document.getElementsByClassName("sections")[0].classList.add("hide"), document.getElementsByClassName("bill")[0].classList.add("hide"), document.getElementsByClassName("toPrint").forEach((function (t) {
                            t.classList.remove("hide")
                        })), window.print(), document.getElementsByClassName("sections")[0].classList.remove("hide"), document.getElementsByClassName("bill")[0].classList.remove("hide"), document.getElementsByClassName("toPrint").forEach((function (t) {
                            t.classList.add("hide")
                        }))
                    }
                }
            }, f = h, g = (i("5c0b"), Object(v["a"])(f, s, a, !1, null, null, null)), b = g.exports, y = i("8c4f");
        n["a"].use(y["a"]);
        var C = [], k = new y["a"]({mode: "history", base: "/", routes: C}), x = k, w = i("2f62");
        n["a"].use(w["a"]);
        var P = new w["a"].Store({state: {}, mutations: {}, actions: {}, modules: {}}), A = i("4a7a"), T = i.n(A);
        i("6dfc");
        n["a"].config.productionTip = !1, n["a"].directive("click-outside-app", {
            bind: function (t, e) {
                var i = function (i) {
                    t.contains(i.target) || t === i.target || i.target.classList.contains("modal-opener") || i.target.classList.contains("inner") || e.value(i)
                };
                t.__vueClickEventHandler__ = i, document.addEventListener("click", i)
            }, unbind: function (t) {
                document.removeEventListener("click", t.__vueClickEventHandler__)
            }
        }), n["a"].component("v-select", T.a), new n["a"]({
            router: x, store: P, render: function (t) {
                return t(b)
            }
        }).$mount("#app")
    }, "5c0b": function (t, e, i) {
        "use strict";
        i("9c0c")
    }, "9c0c": function (t, e, i) {
    }, bf8d: function (t, e, i) {
        "use strict";
        i("cc45")
    }, cc45: function (t, e, i) {
    }
});
//# sourceMappingURL=app.2d485a29.js.map
