/*
	krpano Embedding Script
	krpano 1.16.4 (build 2013-06-05)
*/
function createPanoViewer(e) {
    function ot(e) {
        return ("" + e).toLowerCase()
    }
    function ut(e, t) {
        return e[d](t) >= 0
    }
    function at() {
        var t, r, i, s, o, u, a = n.location;
        a = a.search || a.hash;
        if (a) {
            t = a[W](1)[R]("&");
            for (r = 0; r < t[x]; r++) i = t[r], s = i[d]("="), s == -1 && (s = i[x]), o = i[W](0, s), u = i[W](s + 1), o == _ || ot(o) == M ? e[M] = u : e[Z](o, u)
        }
    }
    function ft(e) {
        return e[H] = at, e
    }
    function lt() {
        var l, c, h, m, g, y, b, w, S;
        if (s == p) {
            function T() {
                var e, n, i, s, o, u, a;
                if (t[Y]) {
                    e = t[Y]["Shockwave Flash"];
                    if (typeof e == "object") {
                        n = e.description;
                        if (n) {
                            i = v, t[O] && (s = t[O]["application/x-shockwave-flash"], s && (s.enabledPlugin || (i = p)));
                            if (i) {
                                o = n[R](" ");
                                for (u = 0; u < o[x]; ++u) {
                                    a = parseFloat(o[u]);
                                    if (isNaN(a)) continue;
                                    return a
                                }
                            }
                        }
                    }
                }
                if (r.ActiveXObject) try {
                    e = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
                    if (e) {
                        n = e.GetVariable("$version");
                        if (n) return parseFloat(n[R](" ")[1][R](",").join("."))
                    }
                } catch (f) { }
                return 0
            }
            function N() {
                var e, t, i = p,
					s = n[A]("div");
                for (e = 0; e < 5; e++) if (typeof s.style[["p", "msP", "MozP", "WebkitP", "OP"][e] + "erspective"] != X) {
                    i = v, e == 3 && r[nt] && (t = r[nt]("(-webkit-transform-3d)"), t && (i = t.matches == v));
                    break
                }
                return i
            }
            function C() {
                var e, t, r = E,
					i = p;
                try {
                    e = n[A]("canvas");
                    for (t = 0; t < 4; t++) {
                        r = e.getContext(["webgl", "experimental-webgl", "moz-webgl", "webkit-3d"][t]);
                        if (r) break
                    }
                    r && (i = v)
                } catch (s) { }
                return r = E, e = E, i
            }
            if (e.isDevice("iphone|ipad|ipod")) a = f = v;
            else {
                u = T(), u >= 10.1 && (o = v), l = N(), c = C(), h = ot(t.platform), m = 0, g = 0, y = 0, b = i[d]("firefox/"), b < 0 && (b = i[d]("gecko/")), b >= 0 && (m = parseInt(i[U](1 + i[d]("/", b)), 10)), b = i[d]("chrome"), b > 0 && (y = parseInt(i[U](b + 7), 10)), b = i[d](K), b > 0 && (g = parseInt(i[U](b + 8), 10), m >= 18 && (g = 4)), l && (g > 0 && g < 4 && (l = p), m > 3 && m < 18 && g > 1 && (c = l = p), c || (h[d](Q) < 0 && m > 3 && g < 1 && (l = p), y > 9 && y < 20 && (l = p)));
                if (l || c) {
                    a = v, w = i[d]("blackberry") >= 0 || i[d]("rim tablet") >= 0 || i[d]("bb10") >= 0, S = (t.msMaxTouchPoints | 0) > 1;
                    if (g >= 4 || w || S) f = v
                }
            }
            s = v
        }
    }
    var t, n, r, i, s, o, u, a, f, l, c, h, p = !1,
		d = "indexOf",
		v = !0,
		m = "addEventListener",
		g = "externalMouseEvent",
		y = "target",
		b = "wmode",
		w = "targetelement",
		E = null,
		S = "onerror",
		x = "length",
		T = "getElementById",
		N = "bgcolor",
		C = "onmousewheel",
		k = "flashbasepath",
		L = "enable_mousewheel_js_bugfix",
		A = "createElement",
		O = "mimeTypes",
		M = "html5",
		_ = "useHTML5",
		D = "params",
		P = "externalMouseEvent2",
		H = "passQueryParameters",
		B = "always",
		j = "srcElement",
		F = "consolelog",
		I = "onready",
		q = "never",
		R = "split",
		U = "slice",
		z = "xml",
		W = "substring",
		X = "undefined",
		V = "vars",
		$ = "basepath",
		J = "mwheel",
		K = "android",
		Q = "mac",
		G = "stopPropagation",
		Y = "plugins",
		Z = "addVariable",
		et = "preventDefault",
		tt = "lastIndexOf",
		nt = "matchMedia",
		rt = '" />',
		it = "auto",
		st = "only";
    return t = navigator, n = document, r = window, i = ot(t.userAgent), s = p, o = p, u = 0, a = p, f = p, e || (e = {}), l = e[H] === v, e.swf || (e.swf = "krpano.swf"), e[z] === undefined && (e[z] = e.swf[R](".swf").join(".xml")), e.id || (e.id = "krpanoSWFObject"), e.width || (e.width = "100%"), e.height || (e.height = "100%"), e[N] || (e[N] = "#000000"), e[b] || (e[b] = E), e[y] || (e[y] = E), e[M] || (e[M] = it), e[J] === undefined && (e[J] = v), e[V] || (e[V] = []), e[D] || (e[D] = []), e[I] || (e[I] = E), e[$] ? e[k] = e[$] : (c = "./", h = e.swf[tt]("/"), h >= 0 && (c = e.swf[U](0, h + 1)), e[$] = c), e.isDevice = function (e) {
        var t, n, r, s = "all",
			o = ["ipad", "iphone", "ipod", K];
        for (t in o) i[d](o[t]) >= 0 && (s += "|" + o[t]);
        e = ot(e)[R]("|");
        if (e == E) return v;
        n = e[x];
        for (t = 0; t < n; t++) {
            r = e[t];
            if (s[d](r) >= 0) return v
        }
        return p
    }, e[Z] = function (t, n) {
        t = ot(t), t == "pano" || t == z ? e[z] = n : e[V][t] = n
    }, e.addParam = function (t, n) {
        e[D][ot(t)] = n
    }, e[_] !== undefined && (e[M] = e[_]), e[_] = function (t) {
        e[M] = t
    }, e.isHTML5possible = function () {
        return lt(), a
    }, e.isFlashpossible = function () {
        return lt(), o
    }, e[S] || (e[S] = function (t) {
        var n = e[w];
        n ? n.innerHTML = '<table width="100%" height="100%"><tr valign="middle"><td><center>ERROR:<br/><br/>' + t + "<br/><br/></center></td></tr></table>" : alert("ERROR: " + t)
    }), e.embed = function (s) {
        var c, h, _, H, R, W, $, K;
        s && (e[y] = s), e[w] = n[T](e[y]);
        if (!e[w]) e[S]("No Embedding Target");
        else {
            l && at(), e[J] == p && (e[V]["control.disablewheel"] = v), e[F] && (e[V][F] = e[F]), lt(), c = ot(e[M]), h = o, _ = a, c == q ? _ = p : ut(c, st) && (h = p), ut(c, B) ? (o = h = p, a = _ = v) : _ && (c == "whenpossible" || ut(c, "prefer") || ut(c, it) && f) && (h = p);
            if (h && o) {
                function Z(e) {
                    function S(e) {
                        function a() {
                            r[m] ? (r[m]("DOMMouseScroll", c, p), r[m]("mousewheel", c, p), n[m]("mousedown", f, p), n[m]("mouseup", l, p)) : (r.opera ? r.attachEvent(C, c) : r[C] = n[C] = c, n.onmousedown = f, n.onmouseup = l)
                        }
                        function f(e) {
                            e || (e = r.event, e[y] = e[j]), u = e ? e[y] : E
                        }
                        function l(e) {
                            var t, i, s, a, f, l, c, h;
                            e || (e = r.event, e[y] = e[j]), t = 0, i = o[x];
                            for (t = 0; t < i; t++) {
                                s = o[t];
                                if (s) {
                                    a = n[s.id];
                                    if (a && s.needfix) {
                                        f = a.getBoundingClientRect(), l = a == e[y], c = a == u, h = e.clientX >= f.left && e.clientX < f.right && e.clientY >= f.top && e.clientY < f.bottom;
                                        if ((l || c) && h == p) try {
                                            a[P] && a[P](0, "mouseUp")
                                        } catch (d) { }
                                    }
                                }
                            }
                            return v
                        }
                        function c(t) {
                            var i, u, a, f, l, c;
                            t || (t = r.event, t[y] = t[j]), i = 0, u = p, t.wheelDelta ? (i = t.wheelDelta / 120, r.opera && s && (i /= 4 / 3)) : t.detail && (i = -t.detail, s == p && (i /= 3));
                            if (i) {
                                a = 0, f = o[x];
                                for (a = 0; a < f; a++) {
                                    l = o[a];
                                    if (l) {
                                        c = n[l.id];
                                        if (c && c == t[y]) {
                                            try {
                                                c.jswheel ? c.jswheel(i) : c[g] ? c[g](i) : c[L] && (c[L](), c[g] && c[g](i))
                                            } catch (h) { }
                                            u = v;
                                            break
                                        }
                                    }
                                }
                            }
                            e[J] == p && (u = p);
                            if (u) return t[G] && t[G](), t[et] && t[et](), t.cancelBubble = v, t.cancel = v, t.returnValue = p, p
                        }
                        var i, s = ot(t.appVersion)[d](Q) >= 0,
							o = r._krpMW,
							u = E;
                        o || (o = r._krpMW = new Array, a()), i = e[b], o.push({
                            id: e.id,
                            needfix: s || !!r.chrome || i == "opaque" || i == "transparent"
                        })
                    }
                    var i, s, o, u, a, f = "",
						l = e[V],
						c = e[D],
						h = e.id;
                    for (; ;) {
                        s = n[T](h);
                        if (!s) break;
                        h += String.fromCharCode(48 + Math.floor(9 * Math.random())), e.id = h
                    }
                    e[b] && (c[b] = e[b]), e[N] && (c[N] = e[N]), e[z] !== undefined && (l[z] = e[z]), e[b] = ot(c[b]), c.allowfullscreen = "true", c.allowscriptaccess = B;
                    for (i in l) f != "" && (f += "&"), f += encodeURIComponent(i) + "=" + encodeURIComponent(l[i]);
                    c.flashvars = f, e[k] && (c.base = e[k]), o = "", u = ' id="' + h + '" width="' + e.width + '" height="' + e.height + '" style="outline:none;" ', a = "_krpcb_" + h, !e[I] || (r[a] = function () {
                        try {
                            delete r[a]
                        } catch (t) {
                            r[a] = E
                        }
                        e[I](n[T](h))
                    });
                    if (t[Y] && t[O] && t[O][x]) {
                        o = '<embed name="' + h + '"' + u + 'type="application/x-shockwave-flash" src="' + e.swf + '" ';
                        for (i in c) o += i + '="' + c[i] + '" ';
                        o += " />"
                    } else {
                        o = "<object" + u + 'classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"><param name="movie" value="' + e.swf + rt;
                        for (i in c) o += '<param name="' + i + '" value="' + c[i] + rt;
                        o += "</object>"
                    }
                    e[w].innerHTML = o, S(e)
                }
                u >= 11.4 && (H = v, ot(t.platform)[d](Q) >= 0 && ot(t.vendor)[d]("apple") >= 0 && (R = i[d]("webkit/"), R > 0 && (R = parseFloat(i[U](R + 7)), !isNaN(R) && R > 0 && R < 534 && (H = p))), H && e[b] == E && !e[D][b] && (e[b] = "direct")), Z(e)
            } else if (_ && a) {
                function nt(t) {
                    function h(e, t, r) {
                        var i, s = n.getElementsByTagName("head");
                        s && (s = s[0]), s || (s = n.body), s ? (i = n[A]("script"), i.type = "text/javascript", i.async = v, i.onload = t, i[S] = r, i.src = f + e, s.appendChild(i)) : r()
                    }
                    function d() {
                        return typeof krpanoJS !== X
                    }
                    function m() {
                        return !!r.krpanoreg && !!r.krpanokey
                    }
                    function g() {
                        s = v, b()
                    }
                    function b() {
                        i == p && (m() || s) && d() && (i = v, e[V][z] = e[z], e[D] = e, e.htmltarget = e[y], krpanojs_init(t))
                    }
                    function w() {
                        t[S]("HTML5 Version not available!")
                    }
                    var i, s, o, u = "krpanoiphone.js",
						a = "krpanoiphone.license.js",
						f = "./",
						l = t.swf,
						c = l[tt]("/");
                    c >= 0 && (f = l[U](0, c + 1)), i = p, s = p, o = m() | 0 | (d() | 0) << 1, o == 0 ? (h(a, b, g), h(u, b, w)) : o == 1 ? h(u, b, w) : o == 2 ? g() : b()
                }
                nt(e)
            } else W = "", $ = c != q, K = o == p && (c == q || !ut(c, B) && !ut(c, st)), K && (W += "Adobe Flashplayer 10.1 (or higher)"), K && $ && (W += " or a<br/>"), $ && (W += "HTML5 Browser with CSS 3D Transforms or WebGL support"), K && $ && (W += " are"), W += " required!", e[S](W)
        }
    }, ft(e)
}
function removepano(e) {
    var t, n, r, i, s = document.getElementById(e);
    if (s) {
        t = window._krpMW;
        if (t) for (n = 0; n < t.length; n++) {
            r = t[n];
            if (r && r.id === e) {
                t.splice(n, 1);
                break
            }
        }
        s.unload && s.unload(), i = s.parentNode, i && i.removeChild(s)
    }
}
function embedpano(e) {
    createPanoViewer(e).embed()
}
function createswf(e, t, n, r, i) {
    return createPanoViewer({
        swf: e,
        id: t,
        width: n,
        height: r,
        bgcolor: i
    })
}
function createkrpanoJSviewer(e, t, n) {
    return createPanoViewer({
        id: e,
        width: t,
        height: n,
        html5: "always"
    })
}
var embedPanoViewer, createkrpanoSWFviewer;
embedPanoViewer = embedpano, createkrpanoSWFviewer = createswf;
/*
	krpano HTML5 Viewer
	krpano 1.16.4 (build 2013-06-05)
*/
var krpanoJS = {
    version: "1.16.4",
    build: "2013-06-05"
};

function krpanojs_init(c) {
    
    function embedhtml5(bd, Ab) {
        function cd() {
            function w(a) {
                return ("" + a).toLowerCase()
            }
            function X(a, b) {
                var c = 0,
                    d = 0,
                    e, f = a.length,
                    j;
                for (e = 0; e < f; e++) if (j = a.charCodeAt(e), 32 >= j) c++;
                else break;
                for (e = f - 1; 0 < e; e--) if (j = a.charCodeAt(e), 32 >= j) d++;
                else break;
                if (void 0 === b && (e = a.charAt(c), j = a.charAt(f - d - 1), ("'" == e && "'" == j || '"' == e && '"' == j) && 3 == a.split(e).length)) c++, d++;
                return a = a.slice(c, f - d)
            }
            function Ma(a) {
                return 0 <= _[321].indexOf(String(a).toLowerCase())
            }
            function Ua(a, b) {
                return _[413] == b ? Number(a) : _[54] == b ? Ma(a) : _[38] == b ? null == a ? null : String(a) : a
            }
            function Da(a) {
                return (1E3 * Number(a) | 0) / 1E3
            }
            function jb(a, b, c, d) {
                a.__defineGetter__(b, c);
                void 0 !== d && a.__defineSetter__(b, d)
            }
            function Va(a, b, c) {
                var d = "_" + b;
                a[d] = c;
                a.__defineGetter__(b, function () {
                    return a[d]
                });
                a.__defineSetter__(b, function (b) {
                    a[d] = Ua(b, typeof c);
                    a.haschanged = !0
                })
            }
            function Ob() {
                for (var a = 0; 4100 > a; a++);
            }
            function sa(a) {
                a && a.preventDefault()
            }
            function z(a, b, c, d) {
                a && a.addEventListener(b, c, d)
            }
            function F(a, b, c, d) {
                a && a.removeEventListener(b, c, d)
            }
            function V(a) {
                var b = B.createElement(1 == a ? "img" : 2 == a ? _[417] : "div");
                b && (1 == a && "off" != uc) && (b.crossOrigin = uc);
                return b
            }
            function yb(a) {
                return function () {
                    return a.apply(a, arguments)
                }
            }
            function qb(a) {
                return a.split("<").join("&lt;").split(">").join("&gt;")
            }
            function ia(a, b) {
                var c = "(" + (a >> 16 & 255) + "," + (a >> 8 & 255) + "," + (a & 255);
                return void 0 !== b ? "rgba" + c + "," + b + ")" : "rgb" + c + ")"
            }
            function Lb(a) {
                return a.split("[").join("<").split("<<").join("[").split("]").join(">").split(">>").join("]")
            }
            function cc(a, b) {
                a = Number(a);
                for (b = Number(b) ; 0 > a;) a += 360;
                for (; 360 < a;) a -= 360;
                var c = Math.abs(b - a),
                    d = Math.abs(b - (a - 360)),
                    e = Math.abs(b - (a + 360));
                d < c && d < e ? a -= 360 : e < c && e < d && (a += 360);
                return a
            }
            function pb(a) {
                if (a) {
                    var b = a.indexOf("?");
                    0 <= b && (a = a.slice(0, b));
                    b = a.indexOf("#");
                    0 <= b && (a = a.slice(0, b))
                }
                return a
            }
            function Nb(a) {
                a = pb(a);
                var b = a.lastIndexOf("/"),
                    c = a.lastIndexOf("\\");
                c > b && (b = c);
                return a.slice(b + 1)
            }
            function zb(a, b) {
                var c = String(a).charCodeAt(0);
                return 48 <= c && 57 >= c ? (ca(3, b + _[120]), !1) : !0
            }
            function Mb(a, b, c, d) {
                for (; 32 >= a.charCodeAt(b) ;) b++;
                for (; 32 >= a.charCodeAt(c - 1) ;) c--;
                var e = a.charCodeAt(b);
                if (37 == e) a = Q(a.slice(b + 1, c), d);
                else if (103 == e && "get(" == a.slice(b, b + 4)) {
                    for (b += 4; 32 >= a.charCodeAt(b) ;) b++;
                    for (c = a.lastIndexOf(")") ; 32 >= a.charCodeAt(c - 1) ;) c--;
                    a = Q(a.slice(b, c), d)
                } else {
                    d = a.charCodeAt(b);
                    if ((39 == d || 34 == d) && d == a.charCodeAt(c - 1)) b++, c--;
                    a = a.slice(b, c)
                }
                return a
            }
            function dd(a) {
                var b = [];
                if (null == a || void 0 == a) return b;
                var c, d = 0,
                    e, f, j = 0;
                a = w(a);
                e = a.length;
                for (c = 0; c < e; c++) f = a.charCodeAt(c), 40 == f ? j++ : 41 == f ? j-- : 46 == f && 0 == j && (b.push(a.slice(d, c)), d = c + 1);
                b.push(a.slice(d));
                return b
            }
            function da(a, b) {
                a = w(a);
                var c, d, e, f;
                e = Pb[a];
                null != e && (void 0 !== e && "" != e) && vc(e, null, b);
                f = Pb.getArray();
                d = f.length;
                for (c = 0; c < d; c++) e = f[c][a], null != e && (void 0 !== e && "" != e) && vc(e, null, b)
            }
            function N(a, b, c, d, e) {
                var f = null,
                    j, k = dd(a);
                j = k.length;
                if (1 == j && d && (f = k[0], void 0 !== d[f])) {
                    d[f] = _[54] == typeof d[f] ? Ma(b) : b;
                    return
                }
                var s = m,
                    f = null;
                1 < j && (f = k[j - 1]);
                for (a = 0; a < j; a++) {
                    var l = k[a],
                        h = a == j - 1,
                        p = null,
                        q = l.indexOf("[");
                    0 < q && (p = Mb(l, q + 1, l.length - 1, d), l = l.slice(0, q));
                    q = !1;
                    if (void 0 === s[l]) {
                        if (c) break;
                        h || (null == p ? s[l] = new Qb : (s[l] = new Wa(Qb), q = !0))
                    } else q = !0;
                    if (q && !1 == h && !0 == s[l].isArray && null != p) if (h = null, s = s[l], h = c ? s.getItem(p) : s.createItem(p)) {
                        if (a == j - 2 && "name" == f) {
                            b = w(b);
                            p != b && (null == b || "null" == b || "" == b ? s.removeItem(p) : s.renameItem(p, b));
                            break
                        }
                        s = h;
                        continue
                    } else break;
                    h ? s[l] = !0 == e ? b : Ua(b, typeof s[l]) : s = s[l]
                }
            }
            function Q(a, b) {
                var c, d, e, f = dd(a);
                d = f.length;
                if (1 == d && _[251] == f[0]) return b ? b._type + "[" + b.name + "]" : "";
                if (1 == d && b && (e = f[0], b.hasOwnProperty(e))) return b[e];
                var j = m;
                for (c = 0; c < d; c++) {
                    e = f[c];
                    var k = c == d - 1,
                        s = null,
                        l = e.indexOf("[");
                    0 < l && (s = Mb(e, l + 1, e.length - 1, b), e = e.slice(0, l));
                    if (j && void 0 !== j[e]) {
                        if (null != s && (l = j[e]) && l.isArray) if (e = l.getItem(s)) {
                            if (k) return e;
                            j = e;
                            continue
                        } else break;
                        if (k) return j[e];
                        j = j[e]
                    } else break
                }
                return null
            }
            function vc(a, b, c) {
                S.callaction(a, b, c)
            }
            function ca(a, b) {
                if (!ed && (0 < a || m.debugmode)) b = ["DEBUG", "INFO", _[395], "ERROR", _[320]][a] + ": " + b, H.log(b), 2 < a && m.showerrors && setTimeout(function () {
                    try {
                        H.showlog(!0)
                    } catch (a) { }
                }, 500)
            }
            function ta(a, b) {
                if (!ed) {
                    a = "" + a;
                    var c = 0 < w(a).indexOf("load");
                    a = qb(a).split("[br]").join("<br/>");
                    var d = Ba.createItem(_[362]),
                        e = Ba.createItem(_[364]);
                    d.sprite || (d.create(), H.controllayer.appendChild(d.sprite));
                    e.sprite || (e.create(), H.controllayer.appendChild(e.sprite));
                    var f;
                    d.loaded = !0;
                    d.align = _[55];
                    d.width = "100%";
                    d.height = "100%";
                    d.alpha = 0.5;
                    d.keep = !0;
                    f = d.sprite.style;
                    f.backgroundColor = _[20];
                    f.zIndex = 99999998;
                    c && (e.visible = !1);
                    e.loaded = !0;
                    e.align = _[111];
                    e.y = 0;
                    e.width = "105%";
                    var j = h.ie || h.android ? -2 : 2;
                    e.height = j + 46 / E;
                    e.keep = !0;
                    f = e.sprite.style;
                    f.backgroundColor = _[20];
                    f.color = _[34];
                    f.fontFamily = h.realDesktop && !h.ie ? _[45] : _[48];
                    f.fontSize = "12px";
                    f.margin = "-2px";
                    f.border = _[205];
                    b || (b = _[249]);
                    e.sprite.innerHTML = _[129] + b + "<br/>" + a + _[261];
                    f.zIndex = 99999999;
                    f[wc] = _[177];
                    e.jsplugin = {
                        onresize: function () {
                            var a = e.sprite.childNodes[0].clientHeight;
                            e.height = j + Math.max(46, a) / E;
                            0 >= a && (e.imageheight = 1)
                        }
                    };
                    d.updatepos();
                    e.updatepos();
                    c && setTimeout(function () {
                        try {
                            e.visible = !0
                        } catch (a) { }
                    }, 500)
                }
            }
            function bd() {
                fd.stop();
                Ea.unregister();
                H.remove()
            }
            function cd() {
                this.caller = this.args = this.cmd = null;
                this.breakable = !1
            }
            function dc(a, b, c) {
                if (null == a || "" == a) return null;
                for (var d = 0, e = 0, f = 0, j = 0, k = 0, s = 0, l = 0, h = 0, p = "", p = 0; ;) if (p = a.charCodeAt(k), 0 < p && 32 >= p) k++;
                else break;
                for (var q = [], e = a.length, d = k; d < e; d++) if (p = a.charCodeAt(d), 0 == h && 0 == l && 40 == p) f++;
                else if (0 == h && 0 == l && 41 == p) {
                    if (j++, f == j) {
                        s = d + 1;
                        p = a.slice(k, s);
                        q.push(p);
                        for (k = s; ;) if (p = a.charCodeAt(k), 0 < p && 32 >= p) k++;
                        else break;
                        p = a.charCodeAt(k);
                        if (59 != p) {
                            s = e;
                            break
                        }
                        for (k++; ;) if (p = a.charCodeAt(k), 59 == p || 0 < p && 32 >= p) k++;
                        else break;
                        d = k
                    }
                } else 34 == p ? 0 == l ? l = 1 : 1 == l && (l = 0) : 39 == p ? 0 == l ? l = 2 : 2 == l && (l = 0) : 91 == p ? h++ : 93 == p && h--;
                s != e && (p = a.slice(k, e), 0 < p.length && q.push(p));
                a = null;
                e = q.length;
                for (d = 0; d < e; d++) {
                    p = q[d];
                    l = p.indexOf("[");
                    j = p.indexOf("]");
                    f = p.indexOf("(");
                    0 < l && (0 < j && f > l && f < j) && (f = p.indexOf("(", j));
                    k = j = null;
                    0 < f ? (j = p.slice(0, f), k = X(p.slice(f + 1, p.lastIndexOf(")")), !1), 0 >= k.length && (k = null)) : (j = p, k = null);
                    j = X(j);
                    s = [];
                    if (null != k) {
                        var n, h = k.length,
                            f = 0,
                            g = -1,
                            O = -1,
                            ua = l = 0,
                            p = null;
                        for (n = 0; n < h; n++) p = k.charCodeAt(n), 0 == l && 40 == p ? f++ : 0 == l && 41 == p ? f-- : 34 == p ? 1 == l && 0 <= g ? (g = -1, l = 0) : 0 == l && (g = n, l = 1) : 39 == p && (2 == l && 0 <= O ? (O = -1, l = 0) : 0 == l && (O = n, l = 2)), 44 == p && (0 == f && 0 == l) && (p = X(k.slice(ua, n)), s.push(p), ua = n + 1);
                        0 == f && (p = X(k.slice(ua, n)), s.push(p))
                    }
                    null == a && (a = []);
                    f = new cd;
                    f.cmd = c ? j : w(j);
                    f.args = s;
                    f.caller = b;
                    a.push(f)
                }
                return a
            }
            function ec() {
                this.z = this.y = this.x = 0;
                this.to_euler_xyz = function () {
                    var a = new ec;
                    a.x = -Math.atan2(-this.y, Math.sqrt(this.x * this.x + this.z * this.z)) / ja;
                    a.y = Math.atan2(this.x, this.z) / ja + 180;
                    return a
                }
            }
            function xc(a) {
                return _[31] !== typeof Float32Array ? new Float32Array(void 0 !== a ? a : 16) : void 0 !== a ? a : Array(16)
            }
            function gd(a, b) {
                var c = b.x,
                    d = b.y,
                    e = b.z;
                b.x = c * a[0] + d * a[4] + e * a[8];
                b.y = c * a[1] + d * a[5] + e * a[9];
                b.z = c * a[2] + d * a[6] + e * a[10]
            }
            function Md(a, b, c) {
                var d, e, f;
                d = -b * ja;
                b = Math.cos(d);
                e = Math.sin(d);
                d = -a * ja;
                a = Math.cos(d);
                f = Math.sin(d);
                d = -c * ja;
                c = Math.cos(d);
                d = Math.sin(d);
                return xc([a * c - f * e * d, a * d + f * e * c, -f * b, 0, -b * d, b * c, e, 0, f * c + a * e * d, f * d - a * e * c, a * b, 0, 0, 0, 0, 1])
            }
            function yc(a, b) {
                var c = Na.getArray(),
                    d = c.length,
                    e, f = r.r_rmatrix,
                    j = Fa,
                    k = ma,
                    s = E,
                    l = 0.5 * j,
                    x = 0.5 * k,
                    p = r.r_zoom,
                    q = r.r_hlookat,
                    n = r.r_vlookat,
                    g = r.r_vlookatA,
                    O = r.r_yoff,
                    ua = r.r_zoff,
                    D = r._camroll,
                    G = r._stereographic,
                    v = 50;
                0 < ua && (G ? v -= ua : (v = 20 - ua, -125 > v && (v = -125)));
                var K = 0,
                    R = 0;
                e = 0;
                void 0 !== b && (e = b, d = e + 1);
                var m = !1 == h.simulator && (h.iphone || h.ipad || h.android && !h.webgl) ? 0.25 : 1;
                h.ie && (m = 5);
                h.androidstock && (m = r.r_zoom / 1E3 / 4);
                var rb = h.realDesktop && 250 > p ? 1.5 : 0,
                    w = zc;
                zc = !1;
                var A = Pe,
                    C = Qe;
                A[1] = l;
                A[5] = Nd;
                A[9] = q;
                A[15] = m + "," + m + "," + m;
                for (m = va; e < d; e++) {
                    var y = c[e];
                    if (y && (w && y.sprite && (y.sprite.style.opacity = Number(y._alpha) * Ac), y._visible && y.loaded && (a || y.poschanged))) {
                        y.poschanged = !1;
                        var I = y.sprite,
                            L = Number(y._flying),
                            K = (1 - L) * Number(y._ath),
                            R = (1 - L) * Number(y._atv);
                        0 < L && (K += L * cc(q, y._ath), R += L * cc(n, y._atv));
                        var Bc = !1,
                            wa = (180 - K) * ja,
                            xa = R * ja,
                            W = new ec;
                        W.x = 1E3 * Math.cos(xa) * Math.cos(wa);
                        W.z = 1E3 * Math.cos(xa) * Math.sin(wa);
                        W.y = 1E3 * Math.sin(xa);
                        gd(f, W);
                        if (y._distorted) {
                            I.style.pointerEvents = 50 <= W.z && y._enabled ? "auto" : "none";
                            Bc = !0;
                            wa = (xa = y._scale) ? y._scale : 1;
                            wa = wa * (1 - L) + L * (wa / (p / (k / 2)));
                            y._scale = 1;
                            y.updatepluginpos();
                            y._scale = xa;
                            var t = y.pixelwidth,
                                T = y.pixelheight,
                                u = xa = 1;
                            y._use_css_scale && (xa = t / y.imagewidth, u = T / y.imageheight);
                            var z = 0.5 * -T,
                                B = String(y._edge),
                                Ia = W = 0,
                                H = y._oxpix,
                                J = y._oypix,
                                W = W + 0.5 * -t / xa,
                                Ia = Ia + z / u;
                            0 <= B.indexOf("left") ? W += +t / 2 / xa : 0 <= B.indexOf(_[2]) && (W += -t / 2 / xa);
                            0 <= B.indexOf("top") ? Ia += +T / 2 / u : 0 <= B.indexOf(_[1]) && (Ia += -T / 2 / u);
                            t = -500;
                            T = y._deepscale;
                            2 == Ga && (T *= 15);
                            T /= 1 + L + rb;
                            0 < ua && (T = 1);
                            wa *= T;
                            t *= T;
                            H *= T;
                            J *= T;
                            0 < ua && (T = -((q - K) % 360), -180 > T && (T += 360), 180 < T && (T -= 360), T *= Math.cos(n / 90), B = r.hfov, !1 == G && (B = 90), 0 > T && (T = -T), T > B && (Bc = !1));
                            A[3] = x + O * (1 - L);
                            A[7] = -(g * (1 - L) + n * L);
                            A[11] = Da(-K);
                            A[13] = Da(R);
                            A[17] = t;
                            A[19] = Da(y._rotate + L * D);
                            A[21] = H;
                            A[23] = J;
                            y.inverserotation ? (A[25] = "Y(" + Da(y.ry), A[27] = "X(" + Da(y.rx), A[29] = "Z(" + Da(-y.rz)) : (A[25] = "Z(" + Da(y.rz), A[27] = "X(" + Da(-y.rx), A[29] = "Y(" + Da(-y.ry));
                            A[31] = wa * xa;
                            A[33] = wa * u;
                            A[35] = W;
                            A[37] = Ia;
                            I.style[m] = A.join("")
                        } else if (W.z >= v && (K = p / (W.z + ua), W.x = W.x * K + l, W.y = W.y * K + x + O, 8E3 > Math.abs(W.x) && 8E3 > Math.abs(W.y))) {
                            wa = (xa = y._scale) ? y._scale : 1;
                            if (y.zoom || y.distorted) wa *= Number(2 * (1 - L) * K + L * E) / E, 20 < wa && (wa = 20);
                            y._scale = 1;
                            y.updatepluginpos();
                            y._scale = xa;
                            t = y.pixelwidth;
                            T = y.pixelheight;
                            u = xa = 1;
                            y._use_css_scale && (xa = t / y.imagewidth, u = T / y.imageheight);
                            K = W.x;
                            R = W.y;
                            0 == y.accuracy2 && (K = Math.round(K), R = Math.round(R));
                            B = String(y._edge);
                            Ia = W = 0;
                            H = y._oxpix;
                            J = y._oypix;
                            0 <= B.indexOf("left") ? W += +t / 2 / xa : 0 <= B.indexOf(_[2]) && (W += -t / 2 / xa);
                            0 <= B.indexOf("top") ? Ia += +T / 2 / u : 0 <= B.indexOf(_[1]) && (Ia += -T / 2 / u);
                            B = Math.max(t, T) * y._scale + Math.max(H, J);
                            0 < K + B && (0 < R + B && K - B < j && R - B < k) && (y._use_css_scale ? wa *= s : (t *= s, T *= s, W *= s, Ia *= s), C[1] = Da(K), C[3] = Da(R), C[5] = Da(-(t / xa) / 2), C[7] = Da(-(T / u) / 2), C[9] = Da(y._rotate - D * (1 - L)), C[11] = H, C[13] = J, C[15] = wa * xa, C[17] = wa * u, C[19] = Da(W), C[21] = Da(Ia), L = C.join(""), 2 > Ga && 0.5 < Number(y.zorder2) && (L = _[291] + (999999999E3 + y._zdeep) + "px) " + L), I.style[va] = L, Bc = !0)
                        }
                        y = Bc ? "" : "none";
                        y != I.style.display && (I.style.display = y)
                    }
                }
            }
            function Ld() {
                var a = r.haschanged,
                    b = !1;
                Rb++;
                var c = H.resizeCheck(),
                    d = S.processAnimations(),
                    a = a | r.haschanged;
                if (!h.ios || h.ios && "5" <= h.iosversion) d = !1;
                d |= hd;
                hd = !1;
                d && (r._hlookat += ((Rb & 1) - 0.5) / (1 + r.r_zoom), a = !0);
                a |= ka.handleloading();
                !1 == S.blocked && (a |= Ea.handleFrictions(), ka.checkautorotate(r.haschanged) && (a = b = !0));
                a || c ? (pa.startFrame(), ka.updateview(b, !0), pa.finishFrame()) : (r.updateView(), yc(!1));
                ka.updateplugins(c);
                h.desktop && ka.checkHovering()
            }
            var fc = this;
            try {
                !Object.prototype.__defineGetter__ && Object.defineProperty({}, "x", {
                    get: function () {
                        return !0
                    }
                }).x && (Object.defineProperty(Object.prototype, _[200], {
                    enumerable: !1,
                    configurable: !0,
                    value: function (a, b) {
                        Object.defineProperty(this, a, {
                            get: b,
                            enumerable: !0,
                            configurable: !0
                        })
                    }
                }), Object.defineProperty(Object.prototype, _[199], {
                    enumerable: !1,
                    configurable: !0,
                    value: function (a, b) {
                        Object.defineProperty(this, a, {
                            set: b,
                            enumerable: !0,
                            configurable: !0
                        })
                    }
                }))
            } catch (df) { }
            var kb = navigator,
                B = document,
                t = window,
                Ja = Math.PI,
                ja = Ja / 180,
                Od = Number.NaN,
                id = 0,
                fa = t.performance && t.performance.now ?
            function () {
                return t.performance.now() - id
            } : function () {
                return (new Date).getTime() - id
            }, id = fa(), Cc = String.fromCharCode, m = null, sb = 0, db = 0, Fa = 0, ma = 0, E = 1, gc = 1, Dc = 0, lb = null, la = null, $ = null, eb = null, Pb = null, Ec = null, Na = null, Y = null, u = null, Ba = null, r = null, fb = null, gb = null, Rb = 0, Oa = 14, jd = null, Fc = [_[308], _[421]], Ka = null, uc = "", kd = !1, hd = !1, ld = !1, Bb = 0, h = {
                runDetection: function (a) {
                    function b() {
                        var a = screen.width,
                            b = screen.height,
                            c = h.topAccess ? top : t,
                            d = c.innerWidth,
                            g = c.innerHeight,
                            c = c.orientation | 0,
                            e = a / (b + 1),
                            f = d / (g + 1);
                        if (1 < e && 1 > f || 1 > e && 1 < f) e = a, a = b, b = e;
                        s.width = a;
                        s.height = b;
                        s.orientation = c;
                        h.window = {
                            width: d,
                            height: g
                        };
                        a /= d;
                        return h.pagescale = a
                    }
                    var c = "multires flash html5 html mobile tablet desktop ie webkit ios iosversion iphone ipod ipad retina hidpi android androidstock blackberry touchdevice gesturedevice fullscreensupport windows mac linux air standalone".split(" "),
                        d, e, f, j, k = B.documentElement;
                    e = c.length;
                    for (d = 0; d < e; d++) f = c[d], h[f] = !1;
                    h.html5 = h.html = !0;
                    h.iosversion = 0;
                    h.css3d = !1;
                    h.webgl = !1;
                    h.topAccess = !1;
                    h.simulator = !1;
                    var s = h.screen = {};
                    try {
                        top && top.document && (h.topAccess = !0)
                    } catch (l) { }
                    var x = kb.platform,
                        c = w(x);
                    f = kb.userAgent;
                    var p = w(f),
                        q = d = "";
                    0 <= c.indexOf("win") ? h.windows = !0 : 0 <= c.indexOf("mac") ? h.mac = !0 : 0 <= c.indexOf("linux") && (h.linux = !0);
                    var n = t.devicePixelRatio,
                        g = 2 <= n;
                    e = 1;
                    var O = 0 <= c.indexOf("ipod"),
                        ua = 0 <= c.indexOf(_[35]),
                        D = 0 <= c.indexOf("ipad"),
                        G = ua || O || D,
                        v = 0 <= p.indexOf(_[383]),
                        K = !1,
                        R = !1,
                        m = !1,
                        rb = f.indexOf(_[439]),
                        r = f.indexOf(_[384]),
                        c = !1,
                        A = 0;
                    gc = b();
                    if (G) {
                        h.ios = !0;
                        d = x;
                        j = f.indexOf("OS ");
                        if (0 < j && (j += 3, A = f.slice(j, f.indexOf(" ", j)).split("_").join("."), d += _[386] + A, h.iosversion = A, "6.0" <= A && (ua && !g || O && g))) h._iOS6_canvas_bug = !0;
                        K = ua || O;
                        R = D;
                        h.iphone = ua || O;
                        h.ipod = O;
                        h.ipad = D;
                        h.retina = g;
                        if (ua || O) e /= 2
                    } else if (v) if (j = f.indexOf(_[389]), A = parseFloat(f.slice(j + 8)), h.android = !0, h.androidversion = A, d = f.slice(j, f.indexOf(";", j)), K = 0 < w(p).indexOf(_[108]), R = !K, d += K ? _[397] : _[406], j = f.indexOf(")"), 5 < j && (A = f.slice(0, j).lastIndexOf(";"), 5 < A && (g = f.indexOf(_[416], A), 0 < g && (j = g), d += " (" + f.slice(A + 2, j) + ")")), 0 < r && (n = gc), R && 1 < n) {
                        if (h.hidpi = !0, e = n, 0 <= rb || 0 < r || 1 < gc) h.hidpi = !1, e = 1
                    } else {
                        if (K) {
                            h.hidpi = 1 < n;
                            e = n / 2;
                            0.5 > e && (e = 0.5);
                            if (0 <= rb || 1 < gc) h.hidpi = !1, e = 0.5;
                            0 < r && (h.hidpi = !1, e = 0.5)
                        }
                    } else {
                        if (0 <= p.indexOf(_[305]) || 0 <= p.indexOf(_[301]) || 0 <= p.indexOf("bb10")) h.blackberry = !0, d = _[283], c = !0;
                        0 <= p.indexOf("ipad") || 0 <= p.indexOf(_[35]) ? m = !0 : 0 <= p.indexOf(_[420]) ? (R = !0, d += _[433]) : 0 <= p.indexOf(_[108]) ? (K = !0, d += _[441], e = 0.5) : m = !0
                    }
                    O = kb.vendor && 0 <= kb.vendor.indexOf("Apple");
                    ua = t.opera;
                    g = !1;
                    m && (d = _[351] + x);
                    j = f.indexOf(_[388]);
                    if (0 < j && (O || ua || v)) j += 8, A = f.slice(j, f.indexOf(" ", j)), O ? (h.safari = !0, h.safariversion = A, q = _[447]) : (v && (q = _[223], c = !0), ua && (h.opera = !0, h.operaversion = A, q = "Opera")), q += " " + A;
                    G && (j = f.indexOf(_[445]), 0 < j && (h.safari = !0, j += 6, A = parseFloat(f.slice(j, f.indexOf(" ", j))), h.crios = A, q = _[102] + A.toFixed(1)));
                    j = rb;
                    if (0 <= j) A = parseFloat(f.slice(j + 7)), h.chrome = !0, h.chromeversion = A, q = _[102] + A.toFixed(1), j = p.indexOf("opr/"), 0 < j && (q = _[431] + parseFloat(f.slice(j + 4)).toFixed(1) + _[343], c = !0), v && 28 > A && (c = !0), v && (1 < n && 20 > A) && (h.hidpi = !0, e = n, K && (e /= 2));
                    else if (j = r, 0 > j && (j = f.indexOf(_[427])), 0 <= j && (A = parseFloat(f.slice(1 + f.indexOf("/", j))), h.firefox = !0, h.firefoxversion = A, q = _[365] + (isNaN(A) ? "" : A.toFixed(1)), v && (c = !0)), j = f.indexOf("MSIE "), g = 0 <= j || 0 <= f.indexOf(_[349])) m = h.ie = !0, R = !1, q = _[190], 0 < p.indexOf(_[345]) || 0 < p.indexOf(_[237]) ? (K = !0, m = !1, q = _[393] + q, e = 1) : 0 < p.indexOf("arm;") && 1 < kb.msMaxTouchPoints && (R = !0, m = !1, q = _[292] + q), 0 <= j && (A = f.slice(j + 4, f.indexOf(";", j)), h.ieversion = parseFloat(A), q += A), d = q, q = "";
                    h.android && (h.androidstock = !(h.chrome || h.firefox || h.opera));
                    if (0 < (j = p.indexOf(_[402]))) A = parseFloat(p.slice(j + 7)), !isNaN(A) && 0 < A && (h.webkit = !0, h.webkitversion = A);
                    h.pixelratio = isNaN(n) ? 1 : n;
                    var p = {},
                        C = V(),
                        n = function (a) {
                            for (var b = ["ms", "Moz", _[412], "O"], c = 0; 5 > c; c++) {
                                var d = 0 < c ? b[c - 1] + a.slice(0, 1).toUpperCase() + a.slice(1) : a;
                                if (void 0 !== C.style[d]) return d
                            }
                            return null
                        };
                    p.prefix = g ? "ms" : h.firefox ? "moz" : h.safari || h.chrome || h.androidstock ? _[60] : "";
                    p.perspective = n(_[289]);
                    p.transform = n(_[322]);
                    p.backgroundsize = n(_[232]);
                    p.boxshadow = n(_[326]);
                    p.boxshadow_style = _[221] == p.boxshadow ? _[188] : _[256] == p.boxshadow ? _[226] : _[89];
                    v && "4.0" > h.androidversion && (p.perspective = null);
                    if (p.perspective && (h.css3d = !0, _[189] == p.perspective && t.matchMedia && (n = t.matchMedia(_[159])))) h.css3d = !0 == n.matches;
                    C = null;
                    n = h;
                    rb = null;
                    try {
                        for (var y = V(2), r = 0; 4 > r && !(rb = y.getContext([_[62], _[71], _[95], _[92]][r])) ; r++);
                    } catch (I) { }
                    n.webgl = null != rb;
                    n = {};
                    n.useragent = f;
                    n.platform = x;
                    y = n.events = {};
                    n.css = p;
                    if (G || v || void 0 !== k.ontouchstart) h.touchdevice = !0, h.gesturedevice = !0;
                    if (x = kb.msPointerEnabled) G = kb.msMaxTouchPoints, h.touchdevice = 0 < G, h.gesturedevice = 1 < G;
                    y.touchstart = x ? _[238] : _[297];
                    y.touchmove = x ? _[239] : _[96];
                    y.touchend = x ? _[285] : _[101];
                    y.touchcancel = x ? _[225] : _[284];
                    y.gesturestart = x ? _[227] : _[257];
                    y.gesturechange = x ? _[217] : _[247];
                    y.gestureend = x ? _[260] : _[303];
                    h.pointerEvents = function () {
                        if (h.firefox) return !0;
                        var a = B.createElement("x"),
                            b = t.getComputedStyle,
                            c = a.style;
                        if (!(_[79] in c)) return !1;
                        c.pointerEvents = "auto";
                        c.pointerEvents = "x";
                        k.appendChild(a);
                        b = b && "auto" === b(a, "").pointerEvents;
                        k.removeChild(a);
                        return !!b
                    }();
                    q && (d += " - " + q);
                    h.realDesktop = m;
                    a = a.vars ? w(a.vars.simulatedevice) : null;
                    _[335] == a && (0 <= f.indexOf(_[116]) || 0 <= f.indexOf("iPod") ? a = _[35] : 0 <= f.indexOf("iPad") && (a = "ipad"));
                    h.touchdeviceNS = h.touchdevice;
                    a = _[35] == a ? 1 : "ipad" == a ? 2 : 0;
                    0 < a && (h.simulator = !0, h.crios = 0, d += " - " + (1 == a ? _[116] : "iPad") + _[306], e = a / 2, K = 1 == a, R = 2 == a, m = !1, h.ios = !0, h.iphone = K, h.ipad = R, h.touchdevice = !0, h.gesturedevice = !0);
                    h.browser = n;
                    h.infoString = d;
                    h.mobile = K;
                    h.tablet = R;
                    h.desktop = m;
                    h.getViewportScale = b;
                    E = e;
                    !1 == h.simulator && (!1 != B.fullscreenEnabled && !1 != B.mozFullScreenEnabled && !1 != B.webkitFullScreenEnabled && !1 != B.webkitFullscreenEnabled) && (a = [_[194], _[161], _[157], _[155]], d = -1, e = null, k[a[0]] ? (e = "", d = 0) : k[a[1]] ? (e = "moz", d = 1) : k[a[2]] ? (e = _[60], d = 2) : k[a[3]] && (e = _[60], d = 3), 0 <= d && !1 == c && (h.fullscreensupport = !0, y.fullscreenchange = e + _[202], y.requestfullscreen = a[d]));
                    h.buildList();
                    delete h.runDetection
                },
                buildList: function () {
                    var a, b = "all";
                    for (a in h) a == w(a) && h[a] && (b += "|" + a);
                    h.haveList = b
                },
                checkSupport: function (a) {
                    a = w(a).split("|");
                    if (null == a) return !0;
                    var b, c, d = a.length;
                    for (b = 0; b < d; b++) {
                        var e = a[b].split("+"),
                            f = !1;
                        for (c = 0; c < e.length; c++) {
                            var j = e[c],
                                k = !1;
                            33 == j.charCodeAt(0) && (j = j.slice(1), k = !0);
                            if (0 == j.indexOf("ios") && h.ios) {
                                if (h.iosversion >= j.slice(3)) if (k) {
                                    f = !1;
                                    break
                                } else f = !0
                            } else if (0 <= h.haveList.indexOf(j)) if (k) {
                                f = !1;
                                break
                            } else f = !0;
                            else if (k) f = !0;
                            else {
                                f = !1;
                                break
                            }
                        }
                        if (f) return !0
                    }
                    return !1
                }
            }, Pa = 0, Sb = 0, Pd = 0, md = !0, Ga = 0, Gc = 0, Cb = 0, ed = !1, va = null, nd = null, od = null, pd = null, wc = null, Hc = null, qd = !1, Xa = 0, Qb = function () {
                var a = this;
                a._type = "base";
                a.registerattribute = function (b, c, d, e) {
                    b = w(b);
                    d && e ? (a.hasOwnProperty(b) && (c = Ua(a[b], typeof c)), a.__defineGetter__(b, e), a.__defineSetter__(b, d), d(c)) : a[b] = a.hasOwnProperty(b) ? Ua(a[b], typeof c) : c
                };
                a.createobject = function (b) {
                    b = w(b);
                    try {
                        return a.hasOwnProperty(b) ? a[b] : a[b] = new Qb
                    } catch (c) { }
                    return null
                };
                a.removeobject = a.removeattribute = function (b) {
                    b = w(b);
                    try {
                        a[b] = null, delete a[b]
                    } catch (c) { }
                };
                a.createarray = function (b) {
                    b = w(b);
                    return a[b] && a[b].isArray ? a[b] : a[b] = new Wa(Qb)
                };
                a.removearray = function (b) {
                    b = w(b);
                    a[b] && a[b].isArray && (a[b] = null, delete a[b])
                };
                a.getattributes = function () {
                    var b = [],
                        c = ["index", _[367]],
                        d;
                    for (d in a) _[9] != typeof a[d] && (-1 == c.indexOf(d) && "_" != d.charAt(0)) && b.push(d);
                    return b
                }
            }, Wa = function (a, b) {
                var c = [],
                    d = {};
                this.isArray = !0;
                this.isDynArray = !0 == b;
                this.__defineGetter__("count", function () {
                    return c.length
                });
                this.__defineSetter__("count", function (a) {
                    0 == a ? (c = [], d = {}) : c.length = a
                });
                this.createItem = function (b, f) {
                    var j = -1,
                        k = null,
                        j = String(b).charCodeAt(0);
                    if (48 <= j && 57 >= j) {
                        if (f) return null;
                        j = parseInt(b, 10);
                        k = c[j];
                        if (null == k || void 0 == k) k = null != a ? new a : {}, k.name = "n" + j, k.index = j, c[j] = k, d[k.name] = k
                    } else if (b = w(b), k = d[b], null == k || void 0 == k) k = f ? f : null != a ? new a : {}, j = c.push(k) - 1, k.index = j, k.name = b, c[j] = k, d[b] = k;
                    return k
                };
                this.getItem = function (a) {
                    var b = -1,
                        b = String(a).charCodeAt(0);
                    48 <= b && 57 >= b ? (b = parseInt(a, 10), a = c[b]) : a = d[w(a)];
                    return a
                };
                this.getArray = function () {
                    return c
                };
                this.renameItem = function (a, b) {
                    var j = -1,
                        j = String(a).charCodeAt(0);
                    48 <= j && 57 >= j ? (j = parseInt(a, 10), j = c[j]) : j = d[w(a)];
                    j && (delete d[j.name], b = w(b), j.name = b, d[b] = j)
                };
                this.removearrayitem = this.removeItem = function (a) {
                    var b = -1,
                        b = null;
                    a = String(a);
                    b = String(a).charCodeAt(0);
                    48 <= b && 57 >= b ? (b = parseInt(a, 10), b = c[b]) : b = d[w(a)];
                    if (b) {
                        d[b.name] = null;
                        delete d[b.name];
                        c.splice(b.index, 1);
                        var j;
                        j = c.length;
                        for (a = b.index; a < j; a++) c[a].index--
                    }
                    return b
                }
            }, ya = {}, Qd = function (a) {
                for (var b = Re, c = [], d, e, f, j, k, s = a.length, l = 0, h = 0; l < s;) d = b.indexOf(a.charAt(l++)), e = b.indexOf(a.charAt(l++)), j = b.indexOf(a.charAt(l++)), k = b.indexOf(a.charAt(l++)), d = d << 2 | e >> 4, e = (e & 15) << 4 | j >> 2, f = (j & 3) << 6 | k, c[h++] = d, 64 != j && (c[h++] = e), 64 != k && (c[h++] = f);
                return c
            }, Rd = function (a, b, c) {
                if (null == a) return null;
                !0 == b && m.basedir && 0 > a.indexOf("://") && 0 != a.indexOf("/") && (a = m.basedir + a);
                a = a.split("\\").join("/");
                null == ga.firstxmlpath && (ga.firstxmlpath = "");
                null == ga.currentxmlpath && (ga.currentxmlpath = "");
                null == ga.swfpath && (ga.swfpath = "");
                null == ga.htmlpath && (ga.htmlpath = "");
                for (b = a.indexOf("%") ; 0 <= b;) {
                    var d = a.indexOf("%", b + 1);
                    if (d > b) {
                        var e = a.slice(b + 1, d),
                            f = null;
                        if (36 == e.charCodeAt(0)) {
                            if (e = Q(e.slice(1))) {
                                a = a.slice(0, b) + e + a.slice(d + 1);
                                b = a.indexOf("%");
                                continue
                            }
                        } else switch (e) {
                            case _[363]:
                                f = !0 == c ? "" : ga.firstxmlpath;
                                break;
                            case _[309]:
                                f = ga.currentxmlpath;
                                break;
                            case _[391]:
                                f = !0 == c ? "" : ga.swfpath;
                                break;
                            case _[346]:
                                f = !0 == c ? "" : ga.htmlpath;
                                break;
                            case _[392]:
                                f = !0 == c ? "" : m.basedir
                        }
                        null != f ? (d++, "/" == a.charAt(d) && d++, a = f + a.slice(d), b = a.indexOf("%")) : b = a.indexOf("%", b + 1)
                    } else b = -1
                }
                return a
            }, rd = function (a, b, c) {
                var d, e;
                if (0 <= (d = b.indexOf(_[282]))) if ((e = b.indexOf(_[255])) > d) b = b.slice(d + 11, e);
                d = null;
                void 0 !== c ? e = b : (c = b.slice(0, 8), e = b.slice(8));
                if ("KENC" != c.slice(0, 4)) return b;
                var f = !1,
                    j = b = 0,
                    j = 0;
                b = String(c).charCodeAt(4);
                if (80 == b || 82 == b || 71 == b) j = String(c).charCodeAt(5), 85 == j && (j = String(c).charCodeAt(6), 66 == j && (f = !0));
                if (!f) return a && ca(3, a + _[132]), null;
                a = Qd(e);
                c = b;
                var k, s;
                b = [];
                b.length = 256;
                if (80 == c || 82 == c) {
                    s = 15;
                    e = _[74];
                    82 == c && jd && (s = 127, e = jd);
                    k = a[65] & 7;
                    for (c = 0; 128 > c; c++) b[2 * c] = a[c], b[2 * c + 1] = String(e).charCodeAt(c & s);
                    s = a.length - 128 - k;
                    k += 128
                } else if (71 == c) {
                    k = a[4];
                    s = (a[k] ^ k) & 15 | ((a[2 + k] ^ k) >> 2 & 63) << 4 | ((a[1 + k] ^ k) >> 1 & 63) << 10 | ((a[3 + k] ^ k) & 63) << 16;
                    for (c = 0; 256 > c; c++) b[c] = a[c] ^ a[256 + s + k + 2 * c];
                    k = 256
                }
                Sd.srand(b, 256);
                a = Sd.flip(a, k, s);
                null != a && (d = Td(a));
                return d
            }, Td = function (a) {
                for (var b = "", c = 0, d = 0, e = 0, f = 0, j = a.length; c < j;) d = a[c], 128 > d ? (b += Cc(d), c++) : 191 < d && 224 > d ? (e = a[c + 1], b += Cc((d & 31) << 6 | e & 63), c += 2) : (e = a[c + 1], f = a[c + 2], d = (d & 15) << 12 | (e & 63) << 6 | f & 63, 65279 != d && (b += Cc(d)), c += 3);
                return b
            }, ga = ya, Re = _[121];
            ga.firstxmlpath = null;
            ga.currentxmlpath = null;
            ga.swfpath = null;
            ga.htmlpath = null;
            ga.parsePath = Rd;
            var Sd = new function () {
                var a, b, c;
                this.srand = function (d, e) {
                    var f, j, k, s, l = [];
                    l.length = 256;
                    for (f = 0; 256 > f; f++) l[f] = f;
                    for (j = f = 0; 256 > f; f++) j = j + l[f] + d[f % e] & 255, s = l[f], l[f] = l[j], l[j] = s;
                    for (k = j = f = 0; 256 > k; k++) f = f + 1 & 255, j = j + l[f] & 255, s = l[f], l[f] = l[j], l[j] = s;
                    a = l;
                    b = f;
                    c = j
                };
                this.flip = function (d, e, f) {
                    var j = [],
						k, s;
                    j.length = f;
                    var l = a,
						h = b,
						p = c;
                    for (k = 0; k < f; k++, e++) h = h + 1 & 255, p = p + l[h] & 255, j[k] = d[e] ^ a[l[h] + l[p] & 255], s = l[h], l[h] = l[p], l[p] = s;
                    b = h;
                    c = p;
                    return j
                }
            };
            ga.loadfile = function (a, b, c) {
                ga.loadfile2(a, null, b, c)
            };
            ga.loadfile2 = function (a, b, c, d) {
                var e = {
                    errmsg: !0
                };
                e.rqurl = a;
                a = Rd(a);
                var f = e.url = a,
                    j = function (b, c) {
                        d && d(e);
                        e.errmsg && ca(3, a + _[24] + c + ")")
                    },
                    k = new XMLHttpRequest;
                void 0 !== k.overrideMimeType && b && k.overrideMimeType(b);
                k.onreadystatechange = function () {
                    if (4 == k.readyState) {
                        var a = k.status,
                            b = k.responseText;
                        0 == a && b || 200 == a || 304 == a ? (a = rd(f, b), e.data = a, c && c(e)) : void 0 !== j ? j(f, k.status) : ta(f + _[24] + k.status + ")")
                    }
                };
                try {
                    k.open("GET", f, !0), k.send(null)
                } catch (s) {
                    void 0 !== j ? j(f, k.e) : ta(f + _[66])
                }
            };
            ga.resolvecontentencryption = rd;
            ga.b64u8 = function (a) {
                return Td(Qd(a))
            };
            ga.decodeLicense = function (a) {
                a = (new DOMParser).parseFromString(a, _[19]);
                if (a = P.findxmlnode(a, _[396])) {
                    var b = rd(null, a.firstChild.nodeValue, _[352]);
                    if (b) {
                        if (a = a.attributes.regname) a = a.nodeValue;
                        var b = b.split(";"),
                            c = {},
                            d;
                        for (d = 0; d < b.length; d++) {
                            var e = b[d].split("=");
                            2 == e.length && (c[e[0]] = e[1])
                        }
                        if (c.user == a) return c
                    }
                }
                return null
            };
            var P = {},
                Ud = function (a) {
                    for (var b = 0, c = a.childNodes, d; d = c.item(b++) ;) switch (d.nodeType) {
                        case 1:
                            Ud(d);
                            break;
                        case 8:
                            a.removeChild(d), b--
                    }
                },
                Vd = function (a, b) {
                    var c, d, e = a.childNodes,
                        f = -1;
                    d = e.length;
                    if (1 <= d) for (c = 0; c < d; c++) if (w(e[c].nodeName) == b) {
                        f = c;
                        break
                    }
                    return 0 <= f ? e[f] : null
                },
                Wd = function (a, b, c) {
                    for (var d, e, f, j, k, s, l, x = a.length, p = new XMLSerializer, q = 0; q < x; q++) if ((d = a[q]) && d.nodeName && "#text" != d.nodeName) if (e = d.nodeName, e = w(e), e = null == b && _[59] == e ? null : b ? b + "." + e : e, f = d.attributes, !f || !(f.devices && !1 == h.checkSupport(f.devices.nodeValue))) {
                        l = (j = f && f.name ? f.name.nodeValue : null) ? !0 : !1;
                        if (c) {
                            if ((_[36] == e || "layer" == e) && c & 4) continue;
                            if (_[10] == e && c & 128) continue;
                            if (_[41] == e && c & 65536) continue;
                            if (c & 64 && j) if (_[36] == e || "layer" == e) {
                                var n = Ba.getItem(j);
                                if (n && n._pCD && n.keep) continue
                            } else if (_[10] == e && (n = Na.getItem(j)) && n._pCD && n.keep) continue
                        }
                        if (e) if (l) {
                            if (_[15] == e || "data" == e || "scene" == e) {
                                Ud(d);
                                l = null;
                                if ((_[15] == e || "data" == e) && d.childNodes && 1 <= d.childNodes.length) for (n = 0; n < d.childNodes.length; n++) if (4 == d.childNodes[n].nodeType) {
                                    l = d.childNodes[n].nodeValue;
                                    break
                                }
                                null == l && (l = p.serializeToString(d), l = l.slice(l.indexOf(">") + 1, l.lastIndexOf("</")), _[15] == e && (l = l.split(_[429]).join('"').split(_[424]).join("'").split(_[423]).join(String.fromCharCode(160)).split("&amp;").join("&")));
                                N(e + "[" + j + _[32], l);
                                if (f) {
                                    n = f.length;
                                    for (l = 0; l < n; l++) k = f[l], s = w(k.nodeName), k = k.nodeValue, "name" != s && (s = e + "[" + j + "]." + w(s), N(s, k))
                                }
                                continue
                            }
                            e = e + "[" + j + "]";
                            if (!zb(j, e)) continue;
                            N(e + ".name", j)
                        } else if ((j = Q(e)) && j.isArray && !j.isDynArray) j = "n" + String(j.count), e = e + "[" + j + "]", N(e + ".name", j);
                        if (f) {
                            n = f.length;
                            for (l = 0; l < n; l++) k = f[l], s = w(k.nodeName), k = k.nodeValue, j = e ? e + "." : "", "name" != s && (s = j + w(s), N(s, k))
                        }
                        d.childNodes && 0 < d.childNodes.length && Wd(d.childNodes, e, c)
                    }
                },
                Xd = function (a, b) {
                    var c = null,
                        d, e;
                    e = a.length;
                    for (d = 0; d < e; d++) if (c = a[d], !c || !(c.nodeName && _[15] == w(c.nodeName))) {
                        var f = c.attributes;
                        if (f) {
                            var j, k = f.length;
                            for (j = 0; j < k; j++) {
                                var s = f[j],
                                    l = w(s.nodeName),
                                    h = l.indexOf("url");
                                if (0 == h || 0 < h && h == l.length - 3) l = s.nodeValue, 0 < l.indexOf("://") || 47 == l.charCodeAt(0) || "" != l && (l = b + l), s.nodeValue = l
                            }
                        }
                        c.childNodes && 0 < c.childNodes.length && Xd(c.childNodes, b)
                    }
                },
                Yd = function (a, b) {
                    var c = pb(b),
                        d = c.lastIndexOf("/"),
                        e = c.lastIndexOf("\\");
                    e > d && (d = e);
                    0 < d && (c = c.slice(0, d + 1), Xd(a, c))
                },
                Zd = function (a, b) {
                    var c = Vd(a, _[330]);
                    if (c) {
                        var d = "",
                            e, f;
                        f = c.childNodes.length;
                        for (e = 0; e < f; e++) d += c.childNodes[e].nodeValue;
                        if (c = ya.resolvecontentencryption(b, d)) return (c = (new DOMParser).parseFromString(c, _[19])) && c.documentElement && _[29] == c.documentElement.nodeName ? (ca(3, b + _[17]), null) : c
                    }
                    return a
                },
                $d = function (a, b) {
                    var c, d, e;
                    if (null != P.xmlIncludeNode) {
                        e = pb(a.url);
                        if ((d = a.responseXML) && d.documentElement && _[29] == d.documentElement.nodeName) {
                            ta(e + _[17]);
                            return
                        }
                        d = Zd(d, a.url);
                        Yd(d.childNodes, e);
                        c = d.childNodes;
                        var f = P.xmlIncludeNode.parentNode;
                        if (null != f.parentNode) {
                            var j = 0;
                            e = c.length;
                            if (1 < e) for (d = 0; d < e; d++) if (_[59] == w(c[d].nodeName)) {
                                j = d;
                                break
                            }
                            d = null;
                            if (void 0 === P.xmlDoc.importNode) {
                                var k = function (a, b) {
                                    var c, d;
                                    switch (a.nodeType) {
                                        case 1:
                                            var g = P.xmlDoc.createElement(a.nodeName);
                                            if (a.attributes && 0 < a.attributes.length) {
                                                c = 0;
                                                for (d = a.attributes.length; c < d;) g.setAttribute(a.attributes[c].nodeName, a.getAttribute(a.attributes[c++].nodeName))
                                            }
                                            if (b && a.childNodes && 0 < a.childNodes.length) {
                                                c = 0;
                                                for (d = a.childNodes.length; c < d;) g.appendChild(k(a.childNodes[c++], b))
                                            }
                                            return g;
                                        case 3:
                                        case 4:
                                        case 8:
                                            return P.xmlDoc.createTextNode(a.nodeValue)
                                    }
                                };
                                d = k(c[j], !0)
                            } else d = P.xmlDoc.importNode(c[j], !0);
                            f.insertBefore(d, P.xmlIncludeNode);
                            f.removeChild(P.xmlIncludeNode)
                        } else P.xmlDoc = d;
                        P.xmlAllNodes = [];
                        P.addNodes(P.xmlDoc.childNodes);
                        P.xmlIncludeNode = null
                    }
                    f = !1;
                    e = P.xmlAllNodes.length;
                    for (d = 0; d < e; d++) if (c = P.xmlAllNodes[d], j = null, null != c.nodeName) {
                        j = w(c.nodeName);
                        if (_[404] == j) {
                            var j = c.attributes,
                                s, l = j.length,
                                x = !1;
                            for (s = 0; s < l; s++) {
                                var p = j[s];
                                _[407] == p.nodeName && !1 == h.checkSupport(p.nodeValue) && (x = !0)
                            }
                            if (!1 == x) for (s = 0; s < l; s++) if (p = j[s], "url" == w(p.nodeName)) {
                                f = !0;
                                x = p.nodeValue;
                                P.xmlIncludeNode = c;
                                var q = ya.parsePath(x),
                                    n = new XMLHttpRequest;
                                n.url = q;
                                void 0 !== n.overrideMimeType && n.overrideMimeType(_[19]);
                                n.onreadystatechange = function () {
                                    if (4 == n.readyState) {
                                        var a = n.status;
                                        0 == a || 200 == a || 304 == a ? n.responseXML ? $d(n, b) : 200 == a ? ta(q + _[17]) : ta(q + _[65]) : ta(q + _[24] + n.status + ")")
                                    }
                                };
                                try {
                                    n.open("GET", q, !0), n.send(null)
                                } catch (g) {
                                    ta(x + _[66])
                                }
                            }
                        }
                        if (f) break
                    } !1 == f && b()
                },
                Se = P;
            P.resolvexmlencryption = Zd;
            P.resolvexmlincludes = function (a, b) {
                var c = a.childNodes;
                P.xmlDoc = a;
                P.xmlAllNodes = [];
                P.addNodes(c);
                Yd(c, m.xml.url);
                P.xmlIncludeNode = null;
                $d(null, b)
            };
            P.parsexml = Wd;
            P.xmlDoc = null;
            P.xmlAllNodes = null;
            P.xmlIncludeNode = null;
            P.addNodes = function (a) {
                var b, c, d;
                d = a.length;
                for (c = 0; c < d; c++) if ((b = a[c]) && b.nodeName && _[15] != w(b.nodeName)) P.xmlAllNodes.push(b), b.childNodes && 0 < b.childNodes.length && P.addNodes(b.childNodes)
            };
            Se.findxmlnode = Vd;
            var ea = {
                linear: function (a, b, c) {
                    return c * a + b
                },
                easeinquad: function (a, b, c) {
                    return c * a * a + b
                },
                easeoutquad: function (a, b, c) {
                    return -c * a * (a - 2) + b
                }
            };
            ea[_[21]] = ea.easeoutquad;
            ea.easeinoutquad = function (a, b, c) {
                return (1 > (a /= 0.5) ? c / 2 * a * a : -c / 2 * (--a * (a - 2) - 1)) + b
            };
            ea.easeincubic = function (a, b, c) {
                return c * a * a * a + b
            };
            ea.easeoutcubic = function (a, b, c) {
                return c * ((a -= 1) * a * a + 1) + b
            };
            ea.easeinquart = function (a, b, c) {
                return c * a * a * a * a + b
            };
            ea.easeoutquart = function (a, b, c) {
                return -c * ((a = a / 1 - 1) * a * a * a - 1) + b
            };
            ea.easeinquint = function (a, b, c) {
                return c * a * a * a * a * a + b
            };
            ea.easeoutquint = function (a, b, c) {
                return c * ((a = a / 1 - 1) * a * a * a * a + 1) + b
            };
            ea.easeinsine = function (a, b, c) {
                return -c * Math.cos(a * (Ja / 2)) + c + b
            };
            ea.easeoutsine = function (a, b, c) {
                return c * Math.sin(a * (Ja / 2)) + b
            };
            ea.easeinexpo = function (a, b, c) {
                return 0 == a ? b : c * Math.pow(2, 10 * (a - 1)) + b - 0.001 * c
            };
            ea.easeoutexpo = function (a, b, c) {
                return 1 == a ? b + c : 1.001 * c * (-Math.pow(2, -10 * a) + 1) + b
            };
            ea.easeincirc = function (a, b, c) {
                return -c * (Math.sqrt(1 - a * a) - 1) + b
            };
            ea.easeoutcirc = function (a, b, c) {
                return c * Math.sqrt(1 - (a = a / 1 - 1) * a) + b
            };
            ea.easeoutbounce = function (a, b, c) {
                return a < 1 / 2.75 ? c * 7.5625 * a * a + b : a < 2 / 2.75 ? c * (7.5625 * (a -= 1.5 / 2.75) * a + 0.75) + b : a < 2.5 / 2.75 ? c * (7.5625 * (a -= 2.25 / 2.75) * a + 0.9375) + b : c * (7.5625 * (a -= 2.625 / 2.75) * a + 0.984375) + b
            };
            ea.easeinbounce = function (a, b, c) {
                return c - ea.easeoutbounce(1 - a, 0, c) + b
            };
            ea.getTweenfu = function (a) {
                a = w(a);
                "" == a || "null" == a ? a = _[46] : void 0 === ea[a] && (ca(2, _[252] + a + _[130]), a = _[46]);
                return ea[a]
            };
            var S = {};
            (function () {
                function a(a, b, c) {
                    var d, g = a.length;
                    c = !0 != c;
                    for (d = 0; d < g; d++) {
                        var e = String(a[d]);
                        c && "null" == ("" + e).toLowerCase() ? a[d] = null : ")" == e.charAt(e.length - 1) && "get(" == e.slice(0, 4).toLowerCase() && (e = String(Q(X(e.slice(4, e.length - 1)), b)), a[d] = e)
                    }
                }
                function b(a, b) {
                    var c = "",
                        d, g, e, f, l;
                    e = a.length;
                    l = b.length;
                    for (g = 0; g < e; g++) d = a.charAt(g), "%" == d ? (g++, d = a.charCodeAt(g) - 48, 0 <= d && 9 >= d ? (g + 1 < e && (f = a.charCodeAt(g + 1) - 48, 0 <= f && 9 >= f && (g++, d = 10 * d + f)), c = d < l ? c + String(b[d]) : c + "null") : c = -11 == d ? c + "%" : c + ("%" + a.charAt(g))) : c += d;
                    return c
                }
                function c(a, c, d, g) {
                    d = Array.prototype.slice.call(d);
                    d.splice(0, 0, a);
                    c = b(c, d);
                    l.callaction(c, g, !0)
                }
                function d(a) {
                    var b = x,
                        c = b.length,
                        d;
                    for (d = 0; d < c; d++) if (b[d].id == a) {
                        b.splice(d, 1);
                        break
                    }
                }
                function e(a) {
                    var b = a.length;
                    if (2 == b || 3 == b) {
                        var c = Q(a[b - 2], l.actioncaller),
                            d = Q(a[b - 1], l.actioncaller);
                        null == c && (c = a[b - 2]);
                        null == d && (d = a[b - 1]);
                        return [a[0], parseFloat(c), parseFloat(d)]
                    }
                    return null
                }
                function f(a, b, c) {
                    var d = 1 == b.length ? Q(b[0], c) : b[1],
                        d = 0 == a ? escape(d) : unescape(d);
                    N(b[0], d, !1, c, !0)
                }
                function j(a) {
                    var b = a.position;
                    1 == a.motionmode ? (b *= a.Tmax, b <= a.T1 ? b *= a.accelspeed / 2 * b : b > a.T1 && b <= a.T1 + a.T2 ? b = a.S1 + (b - a.T1) * a.Vmax : (b -= a.T1 + a.T2, b = a.Vmax * b + a.breakspeed / 2 * b * b + a.S1 + a.S2), b = 0 != a.Smax ? b / a.Smax : 1) : 2 == a.motionmode && (b = a.tweenfu(b, 0, 1));
                    r.hlookat = a.startH + b * (a.destH - a.startH);
                    r.vlookat = a.startV + b * (a.destV - a.startV);
                    r.fov = a.startF + b * (a.destF - a.startF)
                }
                function k(a) {
                    var b = a.waitfor;
                    "load" == b ? ka.isLoading() && (a.position = 0) : _[64] == b && ka.isBlending() && (a.position = 0)
                }
                function h(a) {
                    var b = a.varname,
                        c = parseFloat(a.startval),
                        d = parseFloat(a.endval),
                        g = null != a.startval ? 0 < String(a.startval).indexOf("%") : !1,
                        e = null != a.endval ? 0 < String(a.endval).indexOf("%") : !1;
                    e ? g || (c = 0) : g && 0 == d && (e = !0);
                    var g = 0,
                        f = a.position,
                        g = a.tweenmap(f, c, d - c);
                    1 <= f && (g = d);
                    N(b, e ? g + "%" : g, !0, a.actioncaller);
                    null != a.updatefu && l.callaction(a.updatefu, a.actioncaller)
                }
                var l = S;
                l.busy = !1;
                l.blocked = !1;
                l.queue = [];
                l.actioncaller = null;
                var x = [],
                    p = [],
                    q = null,
                    n = 0,
                    g = function () {
                        this.id = null;
                        this.blocking = !1;
                        this.position = this.maxruntime = this.starttime = 0;
                        this.updatefu = this.actioncaller = this.donecall = this.process = null
                    };
                l.isblocked = function () {
                    if (l.blocked) {
                        var a = q;
                        if (a) q = null, l.stopall(), "break" != w(a) && l.callaction(a), l.processactions();
                        else return !0
                    }
                    return !1
                };
                l.callaction = function (a, b, c) {
                    if (a && "null" != a && "" != a) {
                        var d = typeof a;
                        if (_[9] === d) a();
                        else if (_[107] !== d && (a = dc(a, b))) {
                            var d = a.length,
                                g = 0 < l.queue.length,
                                e = !1;
                            for (b = 0; b < d; b++) {
                                var f = a[b];
                                _[293] == f.cmd && (e = !0);
                                f.breakable = e;
                                !0 == c ? l.queue.splice(b, 0, f) : l.queue.push(f)
                            } !1 == g && l.processactions()
                        }
                    }
                };
                var O = !1;
                l.processactions = function () {
                    if (!O) {
                        O = !0;
                        for (var c = null, d = null, g = null, e = null, f = 0, k = l.queue; null != k && 0 < k.length;) {
                            if (l.busy || l.blocked) {
                                O = !1;
                                return
                            }
                            f++;
                            if (1E4 < f) {
                                ca(2, _[74]);
                                k.length = 0;
                                break
                            }
                            c = k.shift();
                            d = String(c.cmd);
                            g = c.args;
                            c = c.caller;
                            l.actioncaller = c;
                            if ((!c || !c._busyonloaded || !c._destroyed) && "//" != d.slice(0, 2)) if ("call" == d && (d = w(g.shift())), a(g, c, "set" == d), void 0 !== l[d]) l[d].apply(l[d], g);
                            else if (c && void 0 !== c[d]) e = c[d], _[9] === typeof e ? e.apply(e, g) : l.callaction(c[d], c, !0);
                            else {
                                if (_[15] == d || "call" == d) d = w(g.shift());
                                e = null;
                                if (null != (e = Q(d))) {
                                    var j = typeof e;
                                    _[9] === j ? e.apply(e, g) : _[107] === j ? ca(2, _[73] + qb(d)) : (g.splice(0, 0, d), e = b(e, g), l.callaction(e, c, !0))
                                } else (e = Q(_[394] + d + _[32])) ? (g.splice(0, 0, d), e = b(e, g), l.callaction(e, c, !0)) : ca(2, _[73] + qb(d))
                            }
                        }
                        l.blocked || (q = null);
                        l.actioncaller = null;
                        O = !1
                    }
                };
                l.processAnimations = function (a) {
                    var b = !1,
                        c = x,
                        d = c.length,
                        g, e = fa();
                    a = !0 == a;
                    for (g = 0; g < d; g++) {
                        var f = c[g],
                            k = (e - f.starttime) / 1E3 / f.maxruntime;
                        isNaN(k) && (k = 1);
                        1 < k && (k = 1);
                        f.position = k;
                        null != f.process && (b = !0, f.process(f), k = f.position);
                        if (1 <= k || a) c.splice(g, 1), d--, g--, f.blocking ? (l.blocked = !1, l.processactions()) : f.donecall && !1 == a && l.callaction(f.donecall, f.actioncaller)
                    }
                    l.blocked && (b = !1);
                    return b
                };
                l.stopall = function () {
                    var a, b, c = l.queue;
                    b = c.length;
                    for (a = 0; a < b; a++) {
                        var d = c[a];
                        d && d.breakable && (d.cmd = "//")
                    }
                    x = [];
                    l.blocked = !1
                };
                l.breakall = function () {
                    l.processAnimations(!0)
                };
                l.oninterrupt = function (a) {
                    q = a
                };
                l.delayedcall = function () {
                    var a = arguments,
                        b = a.length,
                        c = 0;
                    3 == b && (c++, b--);
                    2 == b && (b = new g, b.maxruntime = Number(a[c]), b.donecall = a[c + 1], b.starttime = fa(), b.actioncaller = l.actioncaller, b.id = 0 < c ? "ID" + w(a[0]) : "DC" + ++n, d(b.id), x.push(b))
                };
                l.stopdelayedcall = function (a) {
                    d("ID" + w(a))
                };
                l.set = function () {
                    var a = arguments;
                    2 == a.length && N(a[0], a[1], !1, l.actioncaller)
                };
                l.copy = function () {
                    var a = arguments;
                    2 == a.length && N(a[0], Q(a[1], l.actioncaller), !1, l.actioncaller)
                };
                l.push = function () {
                    var a = arguments;
                    1 == a.length && p.push(Q(a[0], l.actioncaller))
                };
                l.pop = function () {
                    var a = arguments;
                    1 == a.length && N(a[0], p.pop(), !1, l.actioncaller)
                };
                l[_[446]] = function () {
                    var a = arguments,
                        b = a.length,
                        c = a[0],
                        d = w(Q(c, l.actioncaller));
                    if (1 == b) N(c, !Ma(d), !0, l.actioncaller);
                    else if (3 <= b) {
                        var g;
                        b--;
                        for (g = 1; g <= b; g++) {
                            var e = w(a[g]);
                            if (d == e) {
                                g++;
                                g > b && (g = 1);
                                N(c, a[g], !0, l.actioncaller);
                                break
                            }
                        }
                    }
                };
                l.roundval = function () {
                    var a = arguments;
                    if (1 <= a.length) {
                        var b = Number(Q(a[0], l.actioncaller)),
                            c = 2 == a.length ? parseInt(a[1]) : 0,
                            b = 0 == c ? Math.round(b).toString() : b.toFixed(c);
                        N(a[0], b, !1, l.actioncaller, !0)
                    }
                };
                l.inc = function () {
                    var a = arguments,
                        b = a.length;
                    if (1 <= b) {
                        var c = Number(Q(a[0], l.actioncaller)) + (1 < b ? Number(a[1]) : 1);
                        3 < b && c > Number(a[2]) && (c = Number(a[3]));
                        N(a[0], c, !0, l.actioncaller)
                    }
                };
                l.dec = function () {
                    var a = arguments,
                        b = a.length;
                    if (1 <= b) {
                        var c = Number(Q(a[0], l.actioncaller)) - (1 < b ? Number(a[1]) : 1);
                        3 < b && c < Number(a[2]) && (c = Number(a[3]));
                        N(a[0], c, !0, l.actioncaller)
                    }
                };
                l.add = function () {
                    var a = e(arguments);
                    a && N(a[0], a[1] + a[2], !1, l.actioncaller)
                };
                l.sub = function () {
                    var a = e(arguments);
                    a && N(a[0], a[1] - a[2], !1, l.actioncaller)
                };
                l.mul = function () {
                    var a = e(arguments);
                    a && N(a[0], a[1] * a[2], !1, l.actioncaller)
                };
                l.div = function () {
                    var a = e(arguments);
                    a && N(a[0], a[1] / a[2], !1, l.actioncaller)
                };
                l.mod = function () {
                    var a = e(arguments);
                    if (a) {
                        var b = a[1],
                            c = b | 0,
                            b = b + (-c + c % (a[2] | 0));
                        N(a[0], b, !1, l.actioncaller)
                    }
                };
                l.pow = function () {
                    var a = e(arguments);
                    a && N(a[0], Math.pow(a[1], a[2]), !1, l.actioncaller)
                };
                l.screentosphere = function () {
                    var a = arguments;
                    if (4 == a.length) {
                        var b = l.actioncaller,
                            c = r.screentosphere(Number(Q(a[0], b)), Number(Q(a[1], b)));
                        N(a[2], c.x, !1, b);
                        N(a[3], c.y, !1, b)
                    }
                };
                l.spheretoscreen = function () {
                    var a = arguments;
                    if (4 == a.length) {
                        var b = l.actioncaller,
                            c = r.spheretoscreen(Number(Q(a[0], b)), Number(Q(a[1], b)));
                        N(a[2], c.x, !1, b);
                        N(a[3], c.y, !1, b)
                    }
                };
                l.escape = function () {
                    f(0, arguments, l.actioncaller)
                };
                l.unescape = function () {
                    f(1, arguments, l.actioncaller)
                };
                l.txtadd = function () {
                    var a = arguments,
                        b, c = a.length,
                        d = 2 == c ? String(Q(a[0], l.actioncaller)) : "";
                    "null" == d && (d = "");
                    for (b = 1; b < c; b++) d += a[b];
                    N(a[0], d, !1, l.actioncaller, !0)
                };
                l.subtxt = function () {
                    var a = arguments,
                        b = a.length;
                    if (2 <= b) {
                        var c = Q(a[1], l.actioncaller),
                            c = null == c ? String(a[1]) : String(c),
                            c = c.substr(2 < b ? Number(a[2]) : 0, 3 < b ? Number(a[3]) : void 0);
                        N(a[0], c, !1, l.actioncaller)
                    }
                };
                l.indexoftxt = function () {
                    var a = arguments,
                        b = a.length;
                    3 <= b && (b = String(a[1]).indexOf(String(a[2]), 3 < b ? Number(a[3]) : 0), N(a[0], b, !1, l.actioncaller))
                };
                l.txtreplace = function () {
                    var a = arguments,
                        b = a.length;
                    if (3 == b || 4 == b) {
                        var b = 3 == b ? 0 : 1,
                            c = Q(a[b], l.actioncaller);
                        if (c) var d = a[b + 2],
                            c = c.split(a[b + 1]).join(d);
                        N(a[0], c, !1, l.actioncaller)
                    }
                };
                l.showlog = function () {
                    var a = arguments,
                        a = !(1 == a.length && !1 == Ma(a[0]));
                    H.showlog(a)
                };
                l.trace = function () {
                    var a = arguments,
                        b, c = a.length,
                        d = "",
                        g = l.actioncaller;
                    for (b = 0; b < c; b++) var e = a[b],
                        f = Q(e, g),
                        d = null != f ? d + f : d + e;
                    ca(1, d)
                };
                l[_[448]] = function () {
                    var a = arguments,
                        b, c = a.length,
                        d = l.actioncaller;
                    for (b = 0; b < c; b++) a: {
                        var g = d,
                            e = void 0,
                            f = void 0,
                            k = void 0,
                            j = dd(a[b]),
                            f = j.length;
                        if (1 == f && g && (k = j[0], g.hasOwnProperty(k))) {
                            g[k] = null;
                            delete g[k];
                            break a
                        }
                        for (var h = m, e = 0; e < f; e++) {
                            var k = j[e],
                                s = e == f - 1,
                                p = null,
                                I = k.indexOf("[");
                            0 < I && (p = Mb(k, I + 1, k.length - 1, g), k = k.slice(0, I));
                            if (void 0 !== h[k]) {
                                if (null != p && (I = h[k], I.isArray)) if (k = I.getItem(p)) if (s) break a;
                                else {
                                    h = k;
                                    continue
                                } else break;
                                if (s) {
                                    h[k] = null;
                                    delete h[k];
                                    break a
                                } else h = h[k]
                            } else break
                        }
                    }
                };
                l.error = function (a) {
                    ta(a)
                };
                l.openurl = function () {
                    var a = arguments;
                    t.open(a[0], 0 < a.length ? a[1] : _[449])
                };
                l.loadscene = function () {
                    var a = arguments;
                    if (0 < a.length) {
                        var b = a[0],
                            c = Q(_[114] + b + _[32]),
                            d = Q(_[114] + b + _[336]);
                        d && (d += ";");
                        null == c ? ca(3, 'loadscene() - scene "' + b + '" not found') : (m.xml.scene = b, ka.loadxml(_[366] + c + _[328], a[1], a[2], a[3], d))
                    }
                };
                l.js = function (b) {
                    var c = dc(b, null, !0);
                    if (c) {
                        c = c[0];
                        a(c.args, l.actioncaller);
                        var d = !1;
                        if (_[9] == typeof t[c.cmd]) {
                            d = !0;
                            try {
                                t[c.cmd].apply(t[c.cmd], c.args)
                            } catch (g) {
                                d = !1
                            }
                        }
                        if (!1 == d) {
                            c = c.cmd + (0 < c.args.length ? "('" + c.args.join("','") + "');" : "();");
                            try {
                                eval(c)
                            } catch (e) {
                                ca(2, 'js() - calling Javascript "' + b + '" failed: ' + e)
                            }
                        }
                    }
                };
                l.setfov = function () {
                    var a = arguments;
                    1 == a.length && (r.fov = Number(a[0]))
                };
                l.lookat = function () {
                    var a = arguments;
                    2 <= a.length && (r.hlookat = Number(a[0]), r.vlookat = Number(a[1]), 2 < a.length && (r.fov = Number(a[2])))
                };
                l.adjusthlookat = function () {
                    var a = arguments;
                    1 == a.length && (r.hlookat = cc(r.hlookat, Number(a[0])))
                };
                l.loop = function () {
                    c("loop", _[158], arguments, l.actioncaller)
                };
                l.asyncloop = function () {
                    c(_[325], _[127], arguments, l.actioncaller)
                };
                l["for"] = function () {
                    c("for", _[123], arguments, l.actioncaller)
                };
                l.asyncfor = function () {
                    c(_[360], "if(%5!=NEXTLOOP,%1);if(%2,%4;%3;delayedcall(0,asyncfor(%1,%2,%3,%4,NEXTLOOP)););", arguments, l.actioncaller)
                };
                l["if"] = function () {
                    var a = arguments,
                        b = null,
                        c = null,
                        d = null,
                        g = l.actioncaller;
                    if (2 <= a.length) {
                        b = a[0];
                        if (null == b || "" == b) b = _[22];
                        c = a[1];
                        3 == a.length && (d = a[2]);
                        var e = null,
                            f = null,
                            a = null,
                            k, j = b.length,
                            h = 0,
                            s = 0,
                            p = !1,
                            I = 0,
                            n = 0,
                            q = !1,
                            x = [],
                            m = 0,
                            O = 0;
                        for (k = 0; k < j; k++) O = b.charCodeAt(k), 32 >= O && !1 == q ? (0 < s && (x[m++] = b.substr(h, s), s = 0), p = !1) : ((61 == O || 33 == O || 62 == O || 60 == O) && !1 == q ? !1 == p && (0 < s ? (x[m++] = b.substr(h, s), s = 0) : 0 == m && (x[m++] = ""), p = !0, h = k) : (91 == O ? (I++, q = !0) : 93 == O ? (I--, 0 == I && 0 == n && (q = !1)) : (39 == O || 34 == O) && 0 == n ? (n = O, q = !0) : O == n && (n = 0, 0 == I && (q = !1)), p && (0 < s && (x[m++] = b.substr(h, s), s = 0), p = !1, h = k), 0 == s && (h = k)), s++);
                        0 < s && (x[m++] = b.substr(h, s));
                        2 == m && (x[m++] = "");
                        b = x;
                        1 == b.length ? e = b[0] : 3 == b.length && (e = X(b[0]), a = b[1], f = X(b[2]));
                        b = e ? Q(e, g) : null;
                        k = f ? Q(f, g) : null;
                        null == a || "===" == a || "!==" == a ? null == a && null == b && (isNaN(Number(e)) || (b = e)) : (null == b && (b = e), null == k && (k = f));
                        e = 0;
                        _[38] == typeof b && (e = w(b), "true" == e || "1" == e ? b = !0 : _[22] == e || "0" == e ? b = !1 : (e = Number(e), isNaN(e) || (b = e)));
                        _[38] == typeof k && (e = w(k), "true" == e || "1" == e ? k = !0 : _[22] == e || "0" == e ? k = !1 : (e = Number(e), isNaN(e) || (k = e)));
                        e = !1;
                        if (null == a) e = b ? !0 : !1;
                        else if ("===" == a || "==" == a || "EQ" == a) e = b == k;
                        else if ("!==" == a || "!=" == a) e = b != k;
                        else if ("<=" == a || "LE" == a) e = b <= k;
                        else if (">=" == a || "GE" == a) e = b >= k;
                        else if (">" == a || "&gt;" == a || "GT" == a) e = b > k;
                        else if ("<" == a || "&lt;" == a || "LT" == a) e = b < k;
                        e ? l.callaction(c, g, !0) : l.callaction(d, g, !0)
                    }
                };
                l.ifnot = function () {
                    var a = arguments;
                    l["if"](a[0], a[2], a[1])
                };
                l.lookto = function () {
                    var a = arguments,
                        b = a.length;
                    if (2 <= b) {
                        var c = l.actioncaller,
                            e = new g;
                        d(_[109]);
                        e.id = _[109];
                        e.actioncaller = c;
                        !0 == Ma(a[5]) ? (e.blocking = !1, e.donecall = a[6]) : (e.blocking = !0, l.blocked = !0);
                        4 < b && void 0 === a[4] && b--;
                        3 < b && void 0 === a[3] && b--;
                        2 < b && void 0 === a[2] && b--;
                        var f = Number(a[0]),
                            k = Number(a[1]),
                            h = 2 < b ? Number(a[2]) : r.fov,
                            s = 3 < b ? a[3] : null,
                            p = 4 < b ? Ma(a[4]) : !0;
                        if (!isNaN(f) && !isNaN(k) && !isNaN(h)) {
                            var n = 1,
                                a = 720,
                                b = -720,
                                c = 720,
                                q = r.hlookat,
                                m = q,
                                I = r.vlookat,
                                L = r.fov;
                            if (p) {
                                for (; -90 > k || 90 < k;) -90 > k ? (k = -180 - k, f += 180) : 90 < k && (k = 180 - k, f -= 180);
                                for (; 0 > q;) q += 360;
                                for (; 360 < q;) q -= 360;
                                for (; 0 > f;) f += 360;
                                for (; 360 < f;) f -= 360;
                                for (; -180 > I;) I += 360;
                                for (; 180 < I;) I -= 360;
                                q = cc(q, f);
                                I = cc(I, k);
                                p = q - m;
                                q -= p;
                                f -= p
                            }
                            e.startH = q;
                            e.startV = I;
                            e.startF = L;
                            e.destH = f;
                            e.destV = k;
                            e.destF = h;
                            f = Math.sqrt((f - q) * (f - q) + (k - I) * (k - I) + (h - L) * (h - L));
                            s && ((s = dc(s)) && (s = s[0]), s && (k = s.cmd, h = s.args, _[450] == k ? (n = 0, c = 360, 1 == s.args.length && (c = parseFloat(h[0]))) : _[411] == k ? (n = 1, 0 < s.args.length && (a = parseFloat(h[0])), 1 < s.args.length && (b = parseFloat(h[1])), 2 < s.args.length && (c = parseFloat(h[2])), a = +Math.abs(a), b = -Math.abs(b), c = +Math.abs(c)) : "tween" == k && (n = 2, e.tweenfu = ea.getTweenfu(h[0]), e.maxruntime = parseFloat(h[1]), isNaN(e.maxruntime) && (e.maxruntime = 0.5))));
                            e.motionmode = n;
                            0 == n ? e.maxruntime = f / c : 1 == n && (n = f, s = c * c / (2 * a), f = c / a, k = -(c * c) / (2 * b), h = -c / b, q = n - (s + k), I = q / c, 0 > I && (c = Math.sqrt(2 * n * a * b / (b - a)), s = c * c / (2 * a), f = c / a, k = -(c * c) / (2 * b), h = -c / b, I = q = 0), L = f + I + h, e.accelspeed = a, e.breakspeed = b, e.Vmax = c, e.Tmax = L, e.Smax = n, e.T1 = f, e.T2 = I, e.T3 = h, e.S1 = s, e.S2 = q, e.S3 = k, e.maxruntime = L);
                            e.starttime = fa();
                            e.process = j;
                            x.push(e)
                        }
                    }
                };
                l.looktohotspot = function () {
                    var a = arguments,
                        b = l.actioncaller,
                        c = Na.getItem(1 > a.length ? b ? b.name : "" : a[0]);
                    if (c) {
                        var b = c.ath,
                            c = c.atv,
                            d = 30,
                            e = Number(a[1]);
                        isNaN(e) || (d = e);
                        l.lookto(b, c, d, a[2], a[3])
                    }
                };
                l.moveto = function () {
                    var a = arguments;
                    2 <= a.length && l.lookto(a[0], a[1], r.fov, a[2])
                };
                l.zoomto = function () {
                    var a = arguments;
                    1 <= a.length && l.lookto(r.hlookat, r.vlookat, a[0], a[1])
                };
                l.wait = function () {
                    var a = arguments;
                    if (1 == a.length) {
                        var a = a[0],
                            b = w(a);
                        if ("load" == b || _[64] == b) a = 0;
                        else {
                            b = "time";
                            a = Number(a);
                            if (isNaN(a)) return;
                            0 >= a && (b = _[64], a = 0)
                        }
                        var c = new g;
                        c.waitfor = b;
                        c.maxruntime = a;
                        c.process = k;
                        c.starttime = fa();
                        c.actioncaller = l.actioncaller;
                        c.id = "WAIT" + ++n;
                        c.blocking = !0;
                        l.blocked = !0;
                        x.push(c)
                    }
                };
                l.tween = function () {
                    var a = arguments,
                        b = a.length;
                    if (2 <= b) {
                        var c = l.actioncaller,
                            e = new g,
                            f = w(a[0]),
                            k = f,
                            j = a[1],
                            p = !1;
                        c && (0 > f.indexOf(".") && c.hasOwnProperty(f)) && (k = c._type + "[" + c.name + "]." + f, p = !0);
                        e.id = k;
                        e.varname = f;
                        e.actioncaller = c;
                        e.startval = p ? c[f] : Q(f, c);
                        if (null == e.startval || "" == e.startval) e.startval = 0;
                        e.endval = j;
                        c = 2 < b ? String(a[2]) : "0.5";
                        if (0 < c.indexOf("(") && (f = dc(c))) p = f[0], _[361] == p.cmd && (f = Number(p.args[0]), c = Number(p.args[1]), j = Math.abs(parseFloat(j) - parseFloat(e.startval)), c = c * j / f);
                        c = parseFloat(c);
                        isNaN(c) && (c = 0.5);
                        e.maxruntime = c;
                        e.tweenmap = ea.getTweenfu(3 < b ? a[3] : _[46]);
                        4 < b && ("wait" == w(a[4]) ? (e.blocking = !0, l.blocked = !0) : e.donecall = a[4]);
                        5 < b && (e.updatefu = a[5]);
                        e.starttime = fa();
                        e.process = h;
                        d(k);
                        x.push(e)
                    }
                };
                l.stoptween = function () {
                    var a = l.actioncaller,
                        b = arguments,
                        c = b.length,
                        e;
                    for (e = 0; e < c; e++) {
                        var g = w(b[e]);
                        (!(a && 0 > g.indexOf(".")) || !d(a._type + "[" + a.name + "]." + g)) && d(g)
                    }
                };
                l.invalidatescreen = function () {
                    Sb = fa();
                    r.haschanged = !0
                };
                l.updatescreen = function () {
                    r.haschanged = !0
                };
                l.loadpano = function (a, b, c, d, e) {
                    ka.loadpano(a, b, c, d, e)
                };
                l.loadxml = function (a, b, c, d, e) {
                    ka.loadxml(a, b, c, d, e)
                };
                l.updateobject = function () { };
                l.fscommand = function () { };
                l.freezeview = function () { };
                l.showtext = function () { };
                l.reloadpano = function () { };
                l.addlensflare = function () { };
                l.removelensflare = function () { };
                l.addlayer = l.addplugin = function (a) {
                    if (zb(a, _[179] + a + ")") && (a = Ba.createItem(a)) && null == a.sprite) a._dyn = !0, a.create(), null == a._parent && H.pluginlayer.appendChild(a.sprite)
                };
                l.removelayer = l.removeplugin = function (a) {
                    var b = Ba.getItem(a);
                    b && (b.visible = !1, b.parent = null, b.sprite && H.pluginlayer.removeChild(b.sprite), b.destroy(), Ba.removeItem(a))
                };
                l.addhotspot = function (a) {
                    if (zb(a, _[287] + a + ")") && (a = Na.createItem(a))) null == a.sprite && (a._dyn = !0, a.create(), H.hotspotlayer.appendChild(a.sprite)), hd = !0
                };
                l.removehotspot = function (a) {
                    var b = Na.getItem(a);
                    if (b) {
                        b.visible = !1;
                        b.parent = null;
                        if (b.sprite) try {
                            H.hotspotlayer.removeChild(b.sprite)
                        } catch (c) { }
                        b.destroy();
                        Na.removeItem(a)
                    }
                }
            })();
            var H = {},
                ae = function (a) {
                    a = _[153] + a;
                    t.console ? t.console.log(a) : alert(a)
                },
                Tb = function (a, b, c, d, e, f) {
                    var j = V(),
                        k = j.style;
                    k.position = _[0];
                    "LT" == a ? (k.left = b, k.top = c) : (k.left = b, k.bottom = c);
                    k.width = d;
                    k.height = e;
                    k.overflow = _[4];
                    !1 === f && (k.webkitUserSelect = k.MozUserSelect = k.msUserSelect = k.oUserSelect = k.userSelect = "none");
                    return j
                },
                sd = function (a) {
                    if (J.fullscreen = a) t.activekrpanowindow = Ca.id;
                    da(!0 == a ? _[195] : _[201])
                },
                be = function (a) {
                    Ub && (sa(a), J.onResize(a), setTimeout(Ic, 250))
                },
                tb = function (a, b) {
                    for (var c = a.style, d = b.length, e = 0, e = 0; e < d; e += 2) c[b[e]] = b[e + 1]
                },
                ce = function () {
                    sd(!(!B.fullscreenElement && !B.mozFullScreenElement && !B.webkitIsFullScreen && !B.webkitFullscreenElement))
                },
                de = function () {
                    if (Ub) {
                        var a = t.innerHeight,
                            b = db;
                        a < b ? J.__scrollpage_yet = !0 : J.__scrollpage_yet && (J.__scrollpage_yet = !1, Ic());
                        if (a != b) J.onResize(null)
                    }
                },
                Ic = function () {
                    var a = t.innerWidth,
                        b = t.innerHeight;
                    J.__scrollpage_yet && b == db && (J.__scrollpage_yet = !1);
                    var c = screen.height - 64,
                        d = 268;
                    26 <= h.crios && (c += 44, d = 300);
                    (320 == a && b != c || a == screen.height && b != d) && t.scrollTo(0, 1)
                },
                td = function (a, b) {
                    sa(a);
                    var c = "none" == Ya.style.display ? "" : "none";
                    void 0 !== b && (c = !0 == b ? "" : "none");
                    Ya.style.display = c;
                    na.scrollTop = na.scrollHeight
                },
                ee = function () {
                    Jc && (Ha.removeChild(Jc), Jc = null);
                    var a, b = V();
                    a = 25;
                    h.androidstock && h.hidpi ? a = 38 : h.mobile && (a = 14, h.androidstock ? a = 14 * h.pixelratio : h.android && h.chrome && (a = 25 / h.pixelratio));
                    tb(b, [_[51], _[0], "left", "50%", "top", "50%", _[63], _[34], _[97], a + "px", _[42], "none", _[79], "none"]);
                    a = b.style;
                    a.zIndex = 999999;
                    a.opacity = 0.67;
                    a = V();
                    tb(a, "position;relative;left;-50%;top;-25px;fontFamily;sans-serif;textShadow;#000000 1px 1px 2px;lineHeight;110%".split(";"));
                    a.innerHTML = _[369] + (Ka && Ka[1] && 6 < X(Ka[1], !1).length ? Ka[1] : _[131]) + _[337];
                    b.appendChild(a);
                    Ha.appendChild(b);
                    Jc = b
                },
                J = H;
            J.fullscreen = !1;
            var fe = !0,
                Ub = !1;
            J.__scrollpage_yet = !1;
            var hc = null,
                Ca = null,
                Ha = null;
            J.htmltarget = null;
            J.viewerlayer = null;
            J.controllayer = null;
            J.panolayer = null;
            J.pluginlayer = null;
            var Ya = J.hotspotlayer = null,
                na = null,
                mb = null,
                Db = null,
                ge = 0,
                he = 0,
                Kc = !1,
                ud = !1;
            J.build = function (a) {
                function b() {
                    td(null, !1)
                }
                var c = a.target,
                    d = a.id,
                    e = B.getElementById(c);
                if (!e) return ae(_[134] + c), !1;
                for (var c = null, f = d, j = 1; ;) if (c = B.getElementById(d)) if (_[214] == f) j++, d = f + j;
                else return ae(_[128] + d), !1;
                else break;
                c = V();
                c.id = d;
                c.style.position = _[99];
                c.style.overflow = _[4];
                c.style.lineHeight = _[61];
                c.style.fontWeight = _[61];
                c.style.fontStyle = _[61];
                d = _[20];
                a.bgcolor && (d = a.bgcolor);
                a = w(a.wmode);
                if (_[286] == a || _[437] == a) d = null;
                null != d && (c.style.background = d);
                e.appendChild(c);
                Ca = c;
                J.htmltarget = e;
                J.viewerlayer = c;
                Ha = Tb("LT", 0, 0, "100%", "100%", !1);
                tb(Ha, "msTouchAction none msContentZooming none -webkit-tap-highlight-color rgba(255,255,255,0)".split(" "));
                J.controllayer = Ha;
                d = Tb("LT", 0, 0, "100%", "100%");
                J.panolayer = d;
                tb(d, [_[228], "none"]);
                e = Tb("LT", 0, 0, "100%", "100%", !1);
                tb(e, [nd, _[28]]);
                a = e;
                h.android && h.firefox && (f = Tb("LT", 0, 0, "1px", "1px"), f.style.background = _[203], f.style.pointerEvents = "none", f.style.zIndex = 999999999, f.style[va] = _[16], e.appendChild(f));
                f = h.hidpi ? 216 : 156;
                Ya = Tb("LB", 0, 0, "100%", f + "px", !0);
                Ya.style.display = "none";
                if (!0 !== h.opera && (2 > Ga && (Ya.style[va] = _[16]), h.ios && !1 == h.simulator || h.android && h.chrome)) Ya.style[va] = _[16];
                h.ie && (Ya.style.zIndex = 999999999);
                j = Tb("LT", 0, 0, "100%", "100%", !0);
                j.style.opacity = 0.67;
                h.android && h.opera && (j.style.borderTop = _[142]);
                tb(j, [_[222], _[20], wc, _[378] + (h.hidpi ? 16 : 8) + _[313], _[94], (h.hidpi ? 6 : 8) + "px", _[401], 0.67]);
                na = B.createElement("pre");
                var k = null;
                h.mac && (k = _[248] + (t.chrome ? "1px" : "0"));
                h.realDesktop ? (na.style.fontFamily = _[45], na.style.fontSize = "11px", k && (na.style.fontSize = "13px", na.style.textShadow = k)) : (na.style.fontFamily = _[48], na.style.fontSize = h.iphone && h.retina ? "8px" : h.hidpi ? "20px" : h.android && h.mobile && !1 == h.androidstock ? "9px" : "13px");
                tb(na, [_[51], _[0], "left", "5px", "top", "0px", _[40], "left", _[273], 0, _[267], h.realDesktop ? "16px" : 0, _[307], 0, _[241], 0, _[86], "none", _[57], 0, _[94], (h.realDesktop ? 10 : 8) + "px", _[39], "100%", _[37], f - 10 + "px", _[376], "auto", _[184], "none", _[399], "block", _[341], "left", _[296], _[347], _[42], "none", _[63], _[34]]);
                mb = V();
                k && (mb.style.textShadow = k);
                tb(mb, [_[51], _[0], _[2], 0, _[1], 0, _[39], h.iphone && h.retina ? "24px" : h.hidpi ? "60px" : "34px", _[37], f - 10 + "px", _[198], "none", _[246], "none", _[410], _[33], _[148], _[180], _[298], h.realDesktop ? _[45] : _[48], _[97], h.iphone && h.retina ? "6px" : h.realDesktop ? "10px" : h.hidpi ? "18px" : "9px", _[63], _[34]]);
                mb.innerHTML = "CLOSE";
                z(mb, _[96], sa, !0);
                z(mb, _[101], b, !0);
                z(mb, _[5], b, !0);
                Ya.appendChild(j);
                Ya.appendChild(na);
                Ya.appendChild(mb);
                c.appendChild(Ha);
                Ha.appendChild(d);
                0 < h.iosversion && "5" > h.iosversion && (a = V(), a.style.position = _[0], e.appendChild(a), Ha.style.webkitTransformStyle = _[28], e.style.webkitTransformStyle = "flat");
                Ha.appendChild(e);
                d = V();
                d.style.position = _[0];
                d.style.webkitTransformStyle = _[28];
                a.appendChild(d);
                c.appendChild(Ya);
                J.pluginlayer = e;
                J.hotspotlayer = a;
                h.fullscreensupport && z(B, h.browser.events.fullscreenchange, ce);
                Db = [c.style.width, c.style.height];
                J.onResize(null);
                z(t, _[117], J.onResize, !1);
                h.iphone && h.safari && z(t, _[112], de, !1);
                z(t, _[72], be, !1);
                return !0
            };
            J.setFullscreen = function (a) {
                if (h.fullscreensupport) if (a) Ca[h.browser.events.requestfullscreen]();
                else try {
                    B.exitFullscreen && B.exitFullscreen(), B.mozCancelFullScreen && B.mozCancelFullScreen(), B.webkitCancelFullScreen && B.webkitCancelFullScreen(), B.webkitExitFullscreen && B.webkitExitFullscreen()
                } catch (b) { } else {
                    var c = B.body,
                        d = c.style;
                    if (a) J.fsbkup = [d.padding, d.margin, d.overflow, c.scrollTop, c.scrollLeft, t.pageYOffset], d.padding = "0 0", d.margin = "0 0", d.overflow = _[4], c.scrollTop = "0", c.scrollLeft = "0", c.appendChild(Ca), Ca.style.position = _[0], Ca.style.left = 0, Ca.style.top = 0, Ca.style.width = "100%", Ca.style.height = "100%", Ea.domUpdate(), t.scrollTo(0, 0), sd(!0);
                    else if (a = J.fsbkup) J.htmltarget.appendChild(Ca), d.padding = a[0], d.margin = a[1], d.overflow = a[2], c.scrollTop = a[3], c.scrollLeft = a[4], Ca.style.position = _[99], Ea.domUpdate(), t.scrollTo(0, a[5]), J.fsbkup = null, sd(!1)
                }
            };
            J.onResize = function (a, b) {
                Kc = b;
                sa(a);
                var c = Ca,
                    d = "100%",
                    e = "100%";
                null == Db && (Db = [c.style.width, c.style.height]);
                Db && (d = Db[0], e = Db[1], "" == d && (d = "100%"), "" == e && (e = "100%"), Db = null);
                var f = fc.so;
                f && (f.width && (d = f.width), f.height && (e = f.height));
                J.fullscreen && (d = e = "100%");
                var j = 0,
                    f = c;
                do
                    if (j = f.offsetHeight, 0 >= j) {
                        if (f = f.parentNode, null == f) {
                            j = t.innerHeight;
                            break
                        }
                    } else break;
                while (1);
                var k = c.clientWidth,
                    f = d,
                    c = e;
                0 < String(d).indexOf("%") ? d = parseFloat(d) * k / 100 : (d = parseFloat(d), f = d + "px");
                0 < String(e).indexOf("%") ? e = parseFloat(e) * j / 100 : (e = parseFloat(e), c = e + "px");
                1 > e && (e = 100);
                k = screen.width;
                j = screen.height;
                h.iphone && 320 == k && "4.0" > h.iosversion && 480 > j && (j = 480);
                if (h.iphone && fe) {
                    var k = t.innerWidth,
                        s = t.innerHeight;
                    320 == k && s >= j - 124 ? s = j - 124 : k == j && 208 <= s && (s = 208);
                    fe = !1;
                    if (k == d && s && (320 == d && e == j - 124 || d == j && (208 == e || 320 == e))) Ub = !0;
                    if (26 <= h.crios && (320 == d || d == j)) Ub = !0
                }
                Ub && (320 == t.innerWidth ? (d = 320, e = j - 64, h.crios && (e += 44)) : (d = j, e = 320 == t.innerHeight ? 320 : 268, 26 <= h.crios && (e = 300)), f = d + "px", c = e + "px");
                h.getViewportScale();
                Ea && Ea.focusLoss();
                Ub && null == hc && (hc = setInterval(Ic, 4E3), setTimeout(Ic, 250));
                j = !1;
                if (sb != d || db != e || Kc) j = !0, Kc = !1, sb = d, db = e;
                fb && (fb.pixelwidth = fb.imagewidth = sb / E, fb.pixelheight = fb.imageheight = db / E);
                gb && (gb.pixelwidth = gb.imagewidth = sb / E, gb.pixelheight = gb.imageheight = db / E);
                j && (da(_[52]), j = !1);
                lb ? (j |= lb.calc(sb, db), Ha.style.left = lb.pixelx * E + "px", Ha.style.top = lb.pixely * E + "px", Ha.style.width = Fa + "px", Ha.style.height = ma + "px", d = Fa, e = ma) : (Fa = sb, ma = db);
                Dc = Math.max(4 * e / 3, d);
                Ca.style.width = f;
                Ca.style.height = c;
                pa.size(d, e);
                ud = !0;
                j && da(_[52]);
                ka.updateview(!1, !0);
                J.resizeCheck(!0);
                Kc = !1
            };
            J.resizeCheck = function (a) {
                var b = !1,
                    c = Ca,
                    d = c.clientWidth,
                    c = c.clientHeight;
                if (d != ge || c != he || a || lb && lb.haschanged) if (ge = d, he = c, b = !0, !0 == a) b = !1;
                else J.onResize(null);
                ud && !0 !== a && (b = !0, ud = !1);
                255 == (Rb & 511) && 0 == (Oa & 1) && ee();
                return b
            };
            var Vb = "";
            J.log = function (a) {
                if ("cls" == a) na.innerHTML = "";
                else if ("d" == a) ee();
                else {
                    var b = 4 > h.firefoxversion ? 4096 : 1E4;
                    Vb += a + "\n";
                    Vb.length > b ? (Vb = Vb.slice(-b / 2, -1), na.innerHTML = Vb) : na.firstChild ? na.firstChild.nodeValue += "\n" + a : na.innerHTML += a;
                    na.scrollTop = na.scrollHeight;
                    fc.so.vars && (Ma(fc.so.vars.consolelog) && t.console && t.console.log) && t.console.log(a)
                }
            };
            J.showlog = function (a) {
                td(null, a)
            };
            J.togglelog = td;
            J.getMousePos = function (a, b) {
                var c;
                if (_[31] != typeof WebKitPoint) c = new WebKitPoint, c.x = a.pageX, c.y = a.pageY, c = t.webkitConvertPointFromPageToNode(b ? b : Ha, c);
                else {
                    c = {};
                    var d = b ? b : Ha,
                        e = d.getBoundingClientRect();
                    c.x = Math.round(a.clientX - e.left - d.clientLeft + d.scrollLeft);
                    c.y = Math.round(a.clientY - e.top - d.clientTop + d.scrollTop)
                }
                return c
            };
            J.remove = function () {
                null != hc && (clearInterval(hc), hc = null);
                try {
                    F(t, _[117], J.onResize, !1), h.iphone && h.safari && F(t, _[112], de, !1), F(t, _[72], be, !1), h.fullscreensupport && F(B, h.browser.events.fullscreenchange, ce), J.htmltarget.removeChild(Ca), J.htmltarget = null, J.viewerlayer = null, J.controllayer = null, J.panolayer = null, J.pluginlayer = null, Ha = Ca = mb = na = Ya = J.hotspotlayer = null
                } catch (a) { }
            };
            var Jc = null,
                Ea = {},
                Wb = function () {
                    var a = w($.usercontrol);
                    return "mouse" == a || "all" == a
                },
                ie = function (a) {
                    for (; 0 < hb.length && !(100 >= a - hb[0].t) ;) hb.shift()
                },
                ic = function (a, b, c, d) {
                    b = r.inverseProject(a, b);
                    var e = r.inverseProject(c, d);
                    d = (Math.atan2(e.z, e.x) - Math.atan2(b.z, b.x)) / ja;
                    b = -(Math.atan2(b.y, Math.sqrt(b.x * b.x + b.z * b.z)) - Math.atan2(e.y, Math.sqrt(e.x * e.x + e.z * e.z))) / ja;
                    if (c < a && 0 > d || c > a && 0 < d) d = -d;
                    return {
                        h: d,
                        v: b
                    }
                },
                je = function (a) {
                    var b = Math.tan(Math.min(0.5 * r.fov, 45) * ja);
                    a *= Math.min(10 * b, 1);
                    Lc = !0;
                    Eb += a
                },
                ke = function (a, b, c, d) {
                    Wb() ? (a = ic(a, b, c, d), Qa = a.h, Ra = a.v, r.hlookat += Qa, r.vlookat += Ra, ka.updateview()) : Ra = Qa = 0
                },
                ub = function (a) {
                    (B.hidden || B.webkitHidden || B.mozHidden || B.msHidden) && Xb(a)
                },
                Xb = function (a) {
                    Yb();
                    a && (_[50] == a.type && !1 === a.persisted && (ed = !0), u.down && Mc(a));
                    for (var b in Nc) m.keycode = b, da(_[105]), Nc[b] = !1;
                    m.hlookat_moveforce = m.vlookat_moveforce = m.fov_moveforce = 0;
                    m.keycode = 0;
                    Lc = jc = Zb = !1;
                    Eb = vd = Oc = Pc = Qa = Ra = vb = Fb = 0
                },
                Qc = function (a) {
                    var b = 0;
                    !0 != $.disablewheel && (sa(a), Pa = fa(), Wb() && (a.wheelDelta ? b = a.wheelDelta / -120 : a.detail && (b = a.detail, !1 == h.mac && (b /= 3)), je(b * $.mousefovchange), m.wheeldelta_raw = -b, m.wheeldelta = 3 * -b, da(_[81])))
                },
                me = function (a) {
                    if (t.activekrpanowindow == H.viewerlayer.id) {
                        var b = a.keyCode;
                        !1 == (a.altKey || a.ctrlKey || a.shiftKey || 111 < b && 124 > b) && sa(a);
                        m.keycode = b;
                        Nc[b] = !0;
                        da(_[344]);
                        79 == b && (m.logkey || !(Oa & 1)) && H.togglelog();
                        le(b, 1);
                        27 == b && (Yb(), H.fullscreen && (H.fsbkup || h.opera) && H.setFullscreen(!1))
                    }
                },
                ne = function (a) {
                    t.activekrpanowindow == H.viewerlayer.id && (a = a.keyCode, m.keycode = a, Nc[a] = !1, da(_[105]), le(a, 0))
                },
                le = function (a, b) {
                    var c = w($.usercontrol);
                    if ("all" == c || "keyb" == c) a = "," + a + ",", 0 <= ("," + $.keycodesin + ",").indexOf(a) ? m.fov_moveforce = -b : 0 <= ("," + $.keycodesout + ",").indexOf(a) ? m.fov_moveforce = +b : 0 <= ("," + $.keycodesleft + ",").indexOf(a) ? m.hlookat_moveforce = -b : 0 <= ("," + $.keycodesright + ",").indexOf(a) ? m.hlookat_moveforce = +b : 0 <= ("," + $.keycodesup + ",").indexOf(a) ? m.vlookat_moveforce = $.keybinvert ? +b : -b : 0 <= ("," + $.keycodesdown + ",").indexOf(a) && (m.vlookat_moveforce = $.keybinvert ? -b : +b)
                },
                oe = function (a) {
                    Pa = fa();
                    a = ib(a);
                    u.x = a.x / E;
                    u.y = a.y / E;
                    u.moved = !0
                },
                Rc = function (a) {
                    Pa = fa();
                    var b = a.changedTouches ? a.changedTouches : [a];
                    if (0 < b.length) {
                        var c = ib(b[0]);
                        u.x = c.x / E;
                        u.y = c.y / E;
                        u.moved = !0;
                        if (0 == (Oa & 16) && (!1 == h.realDesktop || 10 <= h.ieversion && 4 > a.pointerType) && u.x > sb / E - 22 && u.y > db / E - 32 && a.type == aa.touchstart) pe = b[0].pageY, z(M, aa.touchend, qe, !0)
                    }
                },
                qe = function (a) {
                    a = a.changedTouches ? a.changedTouches : [a];
                    F(M, aa.touchend, qe, !0); -120 > a[0].pageY - pe && H.showlog(!0)
                },
                Yb = function () {
                    if ($b) {
                        try {
                            M.removeChild($b), M.removeChild(kc)
                        } catch (a) { }
                        kc = $b = null
                    }
                },
                re = function (a) {
                    if ($b) Yb();
                    else {
                        sa(a);
                        a = ib(a);
                        var b = a.x,
                            c = a.y,
                            d = Yb;
                        a = function () {
                            var a = V();
                            n = a.style;
                            n.marginTop = n.marginBottom = q[17] + x;
                            n.height = 1 + x;
                            n.backgroundColor = ia(q[18]);
                            "none" != q[19] && (n.borderBottom = _[317] + ia(q[19]));
                            O.appendChild(a)
                        };
                        var e = function (a, b, c) {
                            var e = V();
                            n = e.style;
                            n.padding = q[20] + x;
                            n.border = q[21] + _[13] + ia(q[22]);
                            n.borderRadius = q[23] + x;
                            n.marginTop = q[24] + x;
                            n.marginBottom = q[24] + x;
                            c && b ? (n.cursor = _[33], e.onmouseover = function () {
                                n = this.style;
                                n.background = ia(q[25]);
                                n.border = q[21] + _[13] + ia(q[26]);
                                n.color = ia(q[27])
                            }, e.onmouseout = function () {
                                n = this.style;
                                n.background = "none";
                                n.border = q[21] + _[13] + ia(q[22]);
                                n.color = ia(q[4])
                            }, e.onmousedown = function (a) {
                                a.stopPropagation()
                            }, e.oncontextmenu = function (a) {
                                sa(a);
                                a.stopPropagation();
                                e.onclick()
                            }, e.onclick = function () {
                                d();
                                S.callaction(c)
                            }, Ea.touch && z(e, h.browser.events.touchstart, e.onclick, !0)) : (!1 == b && (n.color = ia(q[5])), n.cursor = _[21]);
                            b = V();
                            b.style.marginLeft = q[28] + x;
                            b.style.marginRight = q[29] + x;
                            b.innerHTML = a;
                            e.appendChild(b);
                            O.appendChild(e)
                        },
                            f = function () {
                                e(_[140], !0, function () {
                                    S.openurl(_[196])
                                })
                            },
                            j = function () {
                                e(H.fullscreen ? p.exitfs : p.enterfs, !0, function () {
                                    m.fullscreen = !m.fullscreen
                                })
                            },
                            k = function () {
                                e((B ? "" : _[106] + m.version + _[215] + m.build + _[229]) + h.infoString + pa.infoString, !0, null)
                            },
                            s = function () {
                                Ka && Ka[2] && e(Ka[2], !0, function () {
                                    S.openurl(Ka[3])
                                })
                            },
                            l = function () {
                                var a = g.getBoundingClientRect(),
                                    d = a.width,
                                    a = a.height,
                                    e = c;
                                if (0 < d && 0 < a) {
                                    for (; b + d > Fa;) b -= d / 2;
                                    0 > b && (b = 0);
                                    c + a > ma && (c -= a);
                                    0 > c && (e > ma / 2 ? (c = e - a, 0 > c && (c = 4)) : (c = e, c + a > ma && (c = ma - 4 - a)));
                                    n = g.style;
                                    n.left = b + x;
                                    n.top = c + x
                                } else 10 > ++I && setTimeout(l, 32)
                            },
                            x = "px",
                            p = m.contextmenu,
                            q = w(h.mac ? "default|14|default|0xFFFFFF|0x000000|0xBBBBBB|0|0|5|2|2|8|0x66000000|0|0|1|4|5|0xEEEEEE|none|1|0|0|0|3|0xEEEEEE|0|0|20|12" : "default|default|1.5|0xFFFFFF|0x000000|0xBBBBBB|1|0xDDDDDD|2|2|2|8|0x66000000|0|0|2|2|5|0xEEEEEE|none|4|0|0|0|3|0xEEEEEE|0|0|18|12").split("|"),
                            n = null,
                            g = V();
                        g.onselectstart = _[245];
                        n = g.style;
                        n.position = _[0];
                        n.zIndex = 99999999999;
                        n[va] = _[16];
                        n.font = "menu";
                        _[21] != q[1] && (n.fontSize = q[1] + x);
                        _[21] != q[2] && (n.lineHeight = 100 * Number(q[2]) + "%");
                        n.background = ia(q[3]);
                        n.color = ia(q[4]);
                        n.border = q[6] + _[13] + ia(q[7]);
                        n.borderRadius = q[8] + x;
                        n.minWidth = 150 + x;
                        n.textAlign = "left";
                        n[wc] = q[9] + "px " + q[10] + "px " + q[11] + "px " + ia(q[12], (q[12] >> 24) / 255);
                        var O = V(),
                            n = O.style;
                        n.border = q[13] + _[13] + ia(q[14]);
                        n.paddingTop = q[15] + x;
                        n.paddingBottom = q[16] + x;
                        g.appendChild(O);
                        var r = p.item.getArray(),
                            D, G, v = 0,
                            K, t = r.length,
                            u, B = 0 != (Oa & 16),
                            E = B,
                            A = B,
                            C = !1,
                            y = !1;
                        for (u = 0; u < t; u++) if (D = r[u]) if (G = D.caption) G = Lb(unescape(G)), D.separator && 0 < v && a(), K = w(G), _[59] == K ? !1 == E && (E = !0, f(), v++) : Ka && _[375] == K ? !1 == A && (A = !0, s(), v++) : _[90] == K ? (C = !0, h.fullscreensupport && (j(), v++)) : _[290] == K ? (y = !0, k(), v++) : D.visible ? (e(G, D.enabled, D.onclick), v++) : !1 == D.visible && (D.separator && 0 < v) && O.removeChild(O.lastChild);
                        Ka && !1 == A && (0 < v && (a(), v = 0), s());
                        !1 == E && (0 < v && a(), f());
                        !1 == C && !0 == p.fullscreen && h.fullscreensupport && j();
                        !1 == y && !0 == p.versioninfo && (a(), k());
                        n = g.style;
                        n.left = _[98];
                        n.top = "10px";
                        var I = 0;
                        setTimeout(l, 16);
                        $b = g;
                        kc = V();
                        a = kc.style;
                        a.position = _[0];
                        a.zIndex = 99999999998;
                        a[va] = _[16];
                        a.width = "100%";
                        a.height = "100%";
                        M.appendChild(kc);
                        M.appendChild($b)
                    }
                },
                wd = function (a, b) {
                    var c = a.timeStamp | 0;
                    500 < c && 500 > c - Bb ? Bb = 0 : (t.activekrpanowindow = H.viewerlayer.id, Pa = fa(), sa(a), !S.isblocked() && 0 == (a.button | 0) && (Yb(), !0 != b ? (z(t, _[7], Sc, !0), z(t, _[3], lc, !0), h.topAccess && z(top, _[3], Mc, !0)) : z(h.topAccess ? top : t, aa.touchend, Tc, !0), c = ib(a), ab = c.x, bb = c.y, Gb = a.timeStamp, wb = 0, u.down = !0, u.up = !1, u.moved = !1, u.downx = u.x = c.x / E, u.downy = u.y = c.y / E, da(_[82])))
                },
                Sc = function (a) {
                    sa(a);
                    var b = ib(a);
                    u.x = b.x / E;
                    u.y = b.y / E;
                    u.moved = !0;
                    if (_[56] == w($.mousetype)) {
                        jc = !0;
                        var c = ic(ab, bb, b.x, b.y).h; -180 > c ? c = 360 + c : 180 < c && (c = -360 + c);
                        wb += c
                    } else ke(ab, bb, b.x, b.y);
                    ab = b.x;
                    bb = b.y;
                    Gb = a.timeStamp
                },
                lc = function (a, b) {
                    Pa = fa();
                    sa(a);
                    F(t, _[7], Sc, !0);
                    F(t, _[3], lc, !0);
                    h.topAccess && F(top, _[3], Mc, !0);
                    Zb = !0;
                    u.down = !1;
                    !1 == u.up && (u.up = !0, da(_[93]), !0 !== b && (!1 == u.moved || 5 > Math.abs(u.x - u.downx) && 5 > Math.abs(u.y - u.downy)) && da(_[103]))
                },
                Mc = function (a) {
                    lc(a, !0)
                },
                se = function (a) {
                    Bb = a.timeStamp | 0;
                    if (mc) {
                        if (4 == a.pointerType) {
                            a.currentPoint && (a.currentPoint.properties && !1 == a.currentPoint.properties.isLeftButtonPressed) && (a.button = 0);
                            Bb = 0;
                            wd(a, !0);
                            return
                        }
                        nc && (cb++, 2 == cb && (xd = 1), Hb.addPointer(a.pointerId), M.msSetPointerCapture(a.pointerId))
                    }
                    t.activekrpanowindow = H.viewerlayer.id;
                    Pa = fa();
                    !1 == H.__scrollpage_yet && sa(a);
                    Yb();
                    if (!nb && !S.isblocked()) {
                        var b = a.changedTouches ? a.changedTouches[0] : a,
                            c = ib(b);
                        Ib = b.pointerId ? b.pointerId : b.identifier;
                        ab = c.x;
                        bb = c.y;
                        Gb = a.timeStamp;
                        hb = [];
                        wb = 0;
                        u.down = !0;
                        u.up = !1;
                        u.moved = !1;
                        u.downx = u.x = c.x / E;
                        u.downy = u.y = c.y / E;
                        da(_[82])
                    }
                },
                ue = function (a) {
                    if (mc) {
                        if (4 == a.pointerType) {
                            u.down && Sc(a);
                            return
                        }
                        if (1 < cb) return
                    }
                    var b = Wb(),
                        c = h.opera && a.touches ? a.touches : a.changedTouches ? a.changedTouches : [a];
                    if (b && !1 == yd && 1 < c.length) b = c[0].pageX - c[1].pageX, c = c[0].pageY - c[1].pageY, c = Math.sqrt(b * b + c * c), 1 > c && (c = 1), !1 == oc ? (oc = !0, te = c, Uc(a)) : zd(a, c / te);
                    else if (Pa = fa(), !1 == H.__scrollpage_yet && sa(a), !nb && !1 != b && (c = a.changedTouches ? a.changedTouches[0] : a, Ib == (c.pointerId ? c.pointerId : c.identifier))) {
                        c = ib(c);
                        _[56] == w($.touchtype) ? (jc = !0, b = ic(ab, bb, c.x, c.y).h, -180 > b ? b = 360 + b : 180 < b && (b = -360 + b), wb += b) : ke(ab, bb, c.x, c.y);
                        ab = c.x;
                        bb = c.y;
                        Gb = a.timeStamp;
                        a = ab;
                        var b = bb,
                            d = Gb;
                        ie(d);
                        hb.push({
                            x: a,
                            y: b,
                            t: d
                        });
                        u.x = c.x / E;
                        u.y = c.y / E
                    }
                },
                Tc = function (a) {
                    if (mc) {
                        F(h.topAccess ? top : t, aa.touchend, Tc, !0);
                        cb--;
                        0 > cb && (cb = 0);
                        if (2 > cb && nb) {
                            ac(a);
                            return
                        }
                        if (4 == a.pointerType) {
                            lc(a);
                            return
                        }
                    }
                    oc && (ac(a), oc = !1);
                    !1 == H.__scrollpage_yet && sa(a);
                    if (nb) Ib = -99;
                    else {
                        var b = a.changedTouches ? a.changedTouches[0] : a;
                        if (Ib == (b.pointerId ? b.pointerId : b.identifier)) {
                            Ib = -99;
                            b = ib(b);
                            u.x = b.x / E;
                            u.y = b.y / E;
                            ab = b.x;
                            bb = b.y;
                            Gb = a.timeStamp;
                            a = ab;
                            var b = bb,
                                c = Gb;
                            ie(c);
                            hb.push({
                                x: a,
                                y: b,
                                t: c
                            });
                            Wb() && 1 < hb.length ? (b = hb[0], c = hb[hb.length - 1], a = (c.t - b.t) / 15, 0 < a && (b = ic(b.x, b.y, c.x, c.y), Zb = !0, Qa = b.h / a, Ra = b.v / a)) : (Zb = !1, Ra = Qa = 0);
                            u.down = !1;
                            !1 == u.up && (u.up = !0, da(_[93]), (!1 == u.moved || 5 > Math.abs(u.x - u.downx) && 5 > Math.abs(u.y - u.downy)) && da(_[103]))
                        }
                    }
                },
                ve = function () {
                    oc = !1;
                    Ib = -99;
                    nb = !1;
                    cb = 0
                },
                Uc = function (a) {
                    nc && 2 > cb || (sa(a), nb = !0, we = r.fov, Ib = -99, u.down = !1)
                },
                zd = function (a, b) {
                    var c = void 0 !== b ? b : a.scale;
                    if (nc) {
                        if (2 > cb) return;
                        !1 == nb && Uc(a);
                        c = xd *= c
                    }
                    sa(a);
                    Pa = fa();
                    if (Wb()) {
                        Ra = Qa = 0;
                        var d = 2 / ja,
                            e = 1 / Math.tan(we / d),
                            c = Math.atan(1 / (e * c)) * d;
                        m.wheeldelta = c > r.fov ? -3 : 3;
                        m.wheeldelta_raw = m.wheeldelta / 3;
                        r.fov = c;
                        da(_[81]);
                        ka.updateview()
                    }
                },
                ac = function (a) {
                    nb && (nb = !1);
                    sa(a)
                },
                Za = Ea;
            Za.mouse = !1;
            Za.touch = !1;
            var ib = null,
                aa = null,
                M = null,
                Nc = [],
                nb = !1,
                pe = 0,
                yd = !1,
                oc = !1,
                te = 1,
                we = 90,
                Ib = -99,
                ab = 0,
                bb = 0,
                Gb = 0,
                hb = [],
                mc = !1,
                nc = !1,
                Hb = null,
                cb = 0,
                xd = 1,
                Zb = !1,
                Qa = 0,
                Ra = 0,
                jc = !1,
                Oc = 0,
                Pc = 0,
                vd = 0,
                wb = 0,
                Lc = !1,
                Eb = 0,
                vb = 0,
                Fb = 0,
                $b = null,
                kc = null;
            Za.registerControls = function (a) {
                M = a;
                aa = h.browser.events;
                ib = H.getMousePos;
                yd = (nc = (mc = kb.msPointerEnabled) && 1 < kb.msMaxTouchPoints) || !1 == h.simulator && h.ios || void 0 !== B.documentElement.ongesturestart;
                a = !(!1 == h.simulator && h.ios || h.android || 10 <= h.ieversion && h.touchdeviceNS);
                var b = h.touchdeviceNS;
                if (b && (h.mobile || h.tablet) && !1 == h.simulator) a = !1;
                Za.mouse = a;
                Za.touch = b;
                aa.mouse = a;
                aa.touch = b;
                z(B, _[104], me, !1);
                z(B, "keyup", ne, !1);
                z(h.topAccess ? top : t, _[30], Xb, !0);
                z(h.topAccess ? top : t, _[50], Xb, !0);
                z(B, _[75], ub);
                z(B, _[67], ub);
                z(B, _[69], ub);
                z(B, _[70], ub);
                if (a || mc) z(M, _[78], Qc, !1), z(M, _[91], Qc, !1);
                a && (z(t, _[7], oe, !0), z(M, _[5], wd, !1));
                (a && h.realDesktop || h.ie) && z(M, _[30], re, !1);
                b && (z(M, aa.touchstart, Rc, !0), z(M, aa.touchmove, Rc, !0), z(M, aa.touchstart, se, !1), z(M, aa.touchmove, ue, !0), z(M, aa.touchend, Tc, !0), z(M, aa.touchcancel, ve, !0), yd && (z(M, aa.gesturestart, Uc, !1), z(M, aa.gesturechange, zd, !1), z(M, aa.gestureend, ac, !0), nc && (z(M, _[77], ac, !0), Hb = new MSGesture, Hb.target = M)))
            };
            Za.domUpdate = function () {
                if (Hb) {
                    var a = M;
                    cb = 0;
                    Za.unregister();
                    Za.registerControls(a)
                }
            };
            Za.unregister = function () {
                Hb && (Hb = Hb.target = null);
                F(B, _[104], me, !1);
                F(B, "keyup", ne, !1);
                F(h.topAccess ? top : t, _[30], Xb, !0);
                F(h.topAccess ? top : t, _[50], Xb, !0);
                h.topAccess && F(top, _[3], Mc, !0);
                F(B, _[75], ub);
                F(B, _[67], ub);
                F(B, _[69], ub);
                F(B, _[70], ub);
                F(t, _[7], oe, !0);
                F(t, _[7], Sc, !0);
                F(t, _[3], lc, !0);
                F(M, _[78], Qc, !1);
                F(M, _[91], Qc, !1);
                F(M, _[5], wd, !1);
                F(M, _[30], re, !1);
                F(M, aa.touchstart, Rc, !0);
                F(M, aa.touchmove, Rc, !0);
                F(M, aa.touchstart, se, !1);
                F(M, aa.touchmove, ue, !0);
                F(M, aa.touchend, Tc, !0);
                F(M, aa.touchcancel, ve, !0);
                F(M, aa.gesturestart, Uc, !1);
                F(M, aa.gesturechange, zd, !1);
                F(M, aa.gestureend, ac, !0);
                F(M, _[77], ac, !0);
                ib = aa = M = null
            };
            Za.handleFrictions = function () {
                var a, b = a = !1,
                    c = m.hlookat_moveforce,
                    d = m.vlookat_moveforce,
                    e = m.fov_moveforce;
                0 != e && je($.keybfovchange * e);
                if (0 != c || 0 != d || 0 != vb || 0 != Fb) {
                    var f = $.keybfriction,
                        b = $.keybspeed,
                        e = r.hlookat,
                        j = r.vlookat,
                        k = $.keybaccelerate * Math.tan(Math.min(0.5 * Number(r.fov), 45) * ja);
                    vb += c * k;
                    c = Fb += d * k;
                    d = vb;
                    vb *= f;
                    Fb *= f;
                    f = Math.sqrt(c * c + d * d);
                    0 < f ? (c /= f, d /= f) : d = c = 0;
                    f > b && (f = b);
                    d *= f;
                    e = 180 >= (Math.floor(j) % 360 + 450) % 360 ? e + d : e - d;
                    j += c * f;
                    r.hlookat = e;
                    r.vlookat = j;
                    f < 0.05 * k && (Fb = vb = 0);
                    b = !0
                }
                a |= b;
                if (Zb) b = Math.pow($.touchfriction, 0.92), Qa *= b, Ra *= b, b = Ra * Ra + Qa * Qa, e = Math.min(0.04 * Dc / r.r_zoom, 0.5), 0 != b && (r.hlookat += Qa, r.vlookat += Ra), b < e && (Zb = !1, Ra = Qa = 0), a |= 1;
                else if (jc) {
                    var b = u,
                        e = vd,
                        j = Oc,
                        k = Pc,
                        d = 0.025 * $.mouseaccelerate,
                        f = $.mousespeed,
                        h = $.mousefriction,
                        c = !1;
                    if (Wb()) {
                        if (b.down && (b.x != b.downx || b.y != b.downx)) {
                            var l = ic(b.downx, b.downy, b.x, b.y);
                            l.h = wb;
                            j = e * j - l.h * d;
                            k = e * k - l.v * d;
                            e = Math.sqrt(j * j + k * k);
                            0 < e && (j /= e, k /= e, e > f && (e = f))
                        }
                        r.hlookat += e * j;
                        r.vlookat += e * k * $.mouseyfriction;
                        e *= h;
                        d = Math.min(0.04 * Dc / r.r_zoom, 0.5);
                        !1 == b.down && e < d && (c = !0)
                    } else c = !0;
                    c && (jc = !1, wb = k = j = e = 0);
                    vd = e;
                    Oc = j;
                    Pc = k;
                    a |= 1
                }
                Lc && (b = r.fov, e = Eb, j = !1, 0 < Math.abs(e) && (j = e, k = $.fovspeed, c = r.fovmin, d = r.fovmax, e *= $.fovfriction, Math.abs(j) > k && (j = k * (j / Math.abs(j))), b += j * (0.9 * (b / 90) + 0.1), b < c && (b = c, e = 0), b > d && (b = d, e = 0), r.fov = b, Eb = e, j = !0), b = Math.min(0.1, Math.tan(Math.min(0.5 * r.fov, 45) * ja)), Math.abs(Eb) < b && (Eb = 0, Lc = !1), a |= j);
                return a
            };
            Za.stopFrictions = function (a) {
                0 == (0 | a) && (a = 3);
                a & 1 && (Oc = Qa = 0);
                a & 2 && (Pc = Ra = 0)
            };
            Za.focusLoss = Xb;
            var qa = null,
                U = null,
                ka = {},
                pc = function (a, b) {
                    !0 !== b ? r.haschanged = !0 : (!0 !== a && (Sb = fa()), da(_[258]), r.updateView(), qa && pa.renderpano(qa, 2), U && pa.renderpano(U, 1), yc(!0), da(_[235]))
                },
                ye = function (a, b, c, d, e) {
                    Aa.count++;
                    Aa.id = Aa.count;
                    if (xe()) {
                        S.busy = !0;
                        m.xml.url = "";
                        m.xml.content = a;
                        var f = (new DOMParser).parseFromString(a, _[19]);
                        P.resolvexmlincludes(f, function () {
                            f = P.xmlDoc;
                            Ad(f, b, c, d, e)
                        })
                    }
                },
                xe = function () {
                    return 1 < Aa.count && Aa.removeid != Aa.id && (Aa.removeid = Aa.id, da(_[259], !0), Aa.removeid != Aa.id) ? !1 : !0
                },
                ze = function (a) {
                    var b, c, d = "";
                    a = pb(a);
                    b = a.lastIndexOf("/");
                    c = a.lastIndexOf("\\");
                    c > b && (b = c);
                    0 <= b && (d = a.slice(0, b + 1));
                    return d
                },
                Ad = function (a, b, c, d, e) {
                    la.currentmovingspeed = 0;
                    qc = !1;
                    ba = U ? 64 : 0;
                    c && (c = w(c), 0 <= c.indexOf(_[281]) && (ba |= 4), 0 <= c.indexOf(_[262]) && (ba |= 128), 0 <= c.indexOf(_[339]) && (ba |= 16), 0 <= c.indexOf(_[353]) && (ba |= 32), 0 <= c.indexOf("merge") && (ba |= 16448), 0 <= c.indexOf(_[311]) && (ba |= 256), 0 <= c.indexOf(_[356]) && (ba |= 4), 0 <= c.indexOf(_[385]) && (ba |= 36), 0 <= c.indexOf(_[338]) && (qc = !0, ba |= 65536), 0 <= c.indexOf(_[269]) && N(_[85], 0));
                    var f = 0 != (ba & 64) && 0 == (ba & 256);
                    if (0 == (ba & 4)) {
                        var j = Ba.getArray();
                        c = j.length;
                        var k;
                        for (k = 0; k < c; k++) {
                            var h = j[k];
                            if (h && (!1 == f || !1 == h.keep)) h.sprite && (h.visible = !1, h.parent = null, H.pluginlayer.removeChild(h.sprite)), h.destroy(), Ba.removeItem(k), k--, c--
                        }
                    }
                    if (0 == (ba & 128)) {
                        j = Na.getArray();
                        c = j.length;
                        for (k = 0; k < c; k++) if ((h = j[k]) && (!1 == f || !1 == h.keep)) {
                            if (h.sprite) {
                                h.visible = !1;
                                h.parent = null;
                                try {
                                    H.hotspotlayer.removeChild(h.sprite)
                                } catch (l) { }
                            }
                            h.destroy();
                            Na.removeItem(k);
                            k--;
                            c--
                        }
                    }
                    f = Pb.getArray();
                    c = f.length;
                    for (k = 0; k < c; k++) if ((j = f[k]) && !1 == Ma(j.keep)) Pb.removeItem(k), k--, c--;
                    if (!1 == qc) {
                        if (0 >= xb && d && (d = w(d), 0 == d.indexOf(_[443]) && (xb = parseFloat(d.slice(6)), isNaN(xb) || 0 > xb))) xb = 2;
                        U && (qa && (qa.destroy(), qa = null), qa = U, qa.stop(), U = null);
                        ba & 32 && (Z[0] = r.hlookat, Z[1] = r.vlookat, Z[2] = r.camroll, Z[3] = r.fov, Z[4] = r.fovtype, Z[5] = r.fovmin, Z[6] = r.fovmax, Z[7] = r.maxpixelzoom, Z[8] = r.fisheye, Z[9] = r.fisheyefovlink, Z[10] = r.stereographic, Z[12] = r.pannini, Z[13] = r.architectural, Z[14] = r.architecturalonlymiddle);
                        0 == (ba & 16384) && r.defaults();
                        r.limitview = "auto";
                        r.hlookatmin = Number.NaN;
                        r.hlookatmax = Number.NaN;
                        r.vlookatmin = Number.NaN;
                        r.vlookatmax = Number.NaN;
                        m.preview && delete m.preview;
                        m.image && delete m.image;
                        m.onstart = null;
                        Y = m.image = {};
                        m.preview && delete m.preview;
                        Y.type = null;
                        Y.multires = !1;
                        Y.tiled = !1;
                        Y.tilesize = 0;
                        Y.tiledimagewidth = 0;
                        Y.tiledimageheight = 0;
                        Y.baseindex = 1;
                        Y.level = new Wa;
                        Y.hfov = 360;
                        Y.vfov = 180;
                        Y.voffset = 0
                    }
                    if (a && a.documentElement && _[29] == a.documentElement.nodeName) ta(a.baseURI + _[17]);
                    else {
                        P.parsexml(a.childNodes, null, ba);
                        m.xmlversion = m.version;
                        m.version = m.buildversion;
                        Vc = e;
                        if ((a = b) && "null" != a) {
                            if (_[38] == typeof a) {
                                b = a.split("&");
                                a = {};
                                for (var x in b) d = b[x].split("="), a[d[0]] = d[1]
                            }
                            for (var p in a) "xml" != p && N(p, a[p])
                        }
                        Ae()
                    }
                },
                Ae = function () {
                    var a, b, c = m.plugin.getArray(),
                        d = m.hotspot.getArray(),
                        e;
                    b = c.length;
                    for (a = 0; a < b; a++) {
                        var f = c[a];
                        if (f && f.layer && f.layer.isArray) {
                            var j = f.layer.getArray();
                            e = j.length;
                            for (b = 0; b < e; b++) {
                                var k = j[b];
                                k && (k.parent = f.name, k.keep = f.keep, Ba.createItem(k.name, k))
                            }
                            f.plugin = null;
                            f.layer = null;
                            a--;
                            b = c.length
                        }
                    }
                    b = c.length;
                    for (a = 0; a < b; a++) if ((f = c[a]) && !1 == f._pCD) f.loadstyle(), f._pCD = !0;
                    b = d.length;
                    for (a = 0; a < b; a++) if ((c = d[a]) && !1 == c._pCD) c.loadstyle(), c._pCD = !0;
                    if (!1 != Be(!0) && (!1 == qc && (ba & 32 && (r.hlookat = Z[0], r.vlookat = Z[1], r.camroll = Z[2], r.fov = Z[3], r.fovtype = Z[4], r.fovmin = Z[5], r.fovmax = Z[6], r.maxpixelzoom = Z[7], r.fisheye = Z[8], r.fisheyefovlink = Z[9], r.stereographic = Z[10], r.pannini = Z[12], r.architectural = Z[13], r.architecturalonlymiddle = Z[14]), ka.updateview(), qa && qa.removemainpano(), Ob(), "1" == eb.html5rendermode ? md = !0 : "2" == eb.html5rendermode && (md = !1), void 0 !== eb.hardwarelimit && (Xa = parseFloat(eb.hardwarelimit), isNaN(Xa) && (Xa = 0)), void 0 !== eb.usedesktopimages && (qd = Ma(eb.usedesktopimages)), Jb = !0, Ec.progress = 0, U = pa.createPano(), U.create(), 0 < xb && (Bd = !0, U.setBlend(0), zc = !0, Ac = 0)), S.busy = !1, a = m.onstart, Vc && (a = Vc, Vc = null), d = Aa.id, S.callaction(a, null, !0), d == Aa.id && (da(_[236]), d == Aa.id))) {
                        !1 == qc && (Ce(), De());
                        a = Na.getArray();
                        d = a.length;
                        for (c = 0; c < d; c++) if ((f = a[c]) && null == f.sprite) f.create(), H.hotspotlayer.appendChild(f.sprite);
                        Be();
                        da(_[52]);
                        ka.updateview();
                        S.processactions()
                    }
                },
                Be = function (a) {
                    var b = Ba.getArray(),
                        c = b.length,
                        d, e = !0;
                    for (d = 0; d < c; d++) {
                        var f = b[d];
                        if (f) {
                            var j = !1;
                            !0 == a ? !0 == f.preload && _[18] != f.type && !1 == f.loaded && (f.onloaded = Ae, f.altonloaded = null, j = !0, e = !1) : (!0 == f.preload && (f.preload = !1, f.onloaded = null), j = !0);
                            j && null == f.sprite && (f.create(), null == f._parent && H.pluginlayer.appendChild(f.sprite))
                        }
                    }
                    return e
                },
                Ce = function () {
                    var a = w(Q(_[268])),
                        b = Q(_[276]);
                    if (b && ("null" == a || _[49] == a)) {
                        a = pa.createCube();
                        a.create(!1);
                        var c = Q(_[185]);
                        if (null != c) {
                            var c = w(c),
                                d = [0, 1, 2, 3, 4, 5];
                            d[c.indexOf("l")] = 0;
                            d[c.indexOf("f")] = 1;
                            d[c.indexOf("r")] = 2;
                            d[c.indexOf("b")] = 3;
                            d[c.indexOf("u")] = 4;
                            d[c.indexOf("d")] = 5;
                            a.striporder = d
                        }
                        a.loadcubestrip(b);
                        U.setpreview(a);
                        pc(!1, !0)
                    } else if (0 == a.indexOf("grid")) {
                        if (b = dc(a)) if (b = b[0], "grid" == b.cmd) {
                            var e = b.args,
                                b = void 0 == e[1] ? 10 : parseInt(e[1]),
                                a = void 0 == e[2] ? 10 : parseInt(e[2]),
                                c = void 0 == e[3] ? 400 : parseInt(e[3]),
                                d = void 0 == e[4] ? 6710886 : parseInt(e[4]),
                                f = void 0 == e[5] ? 2236962 : parseInt(e[5]),
                                e = void 0 == e[6] ? void 0 == e[4] ? 16777215 : d : parseInt(e[6]),
                                d = ia(d),
                                f = ia(f),
                                e = ia(e),
                                j = pa.createCube();
                            j.create(!1);
                            var c = c + 1,
                                k = h.desktop ? c : 255;
                            j.imagesize = k;
                            j.setimagesize(k, k, null);
                            j.allocfaces();
                            for (var k = j.cubesize, s = k / c, a = a * s, b = b * s, l = s = 0, x = 0, s = 0; 6 > s; s++) {
                                var l = j.canvassizes[s][0],
                                    x = j.canvassizes[s][1],
                                    p = (l - k) / 2,
                                    q = (x - k) / 2,
                                    n;
                                !1 == pa.webgl ? n = j.faces[s] : (n = V(2), n.width = l, n.height = x);
                                var g = n.getContext("2d");
                                g.fillStyle = f;
                                g.fillRect(0, 0, l, x);
                                g.fillStyle = d;
                                for (l = 0; l < c; l += a) g.fillRect(p, q + l, c, 1);
                                for (l = 0; l < c; l += b) g.fillRect(p + l, q, 1, c);
                                if (e != d) {
                                    g.fillStyle = e;
                                    for (x = 0; x < c; x += a) for (l = 0; l < c; l += b) g.fillRect(p + l, q + x, 1, 1)
                                }
                                pa.drawtileimage(j, s, n)
                            }
                            j.url = null;
                            j.isloading = !1;
                            j.loaddone = !0;
                            U.setpreview(j);
                            pc(!1, !0);
                            Cd()
                        }
                    } else Cd()
                },
                Cd = function () {
                    da(_[192]);
                    da(_[334])
                },
                De = function () {
                    ld = !1;
                    var a = null != Q(_[26]),
                        b = (h.iphone && h.retina || (h.tablet || h.desktop || h.android) || !1 == a) && null != Q(_[27]),
                        c = !1;
                    if (!1 == h.desktop && !1 == qd && (a || b)) c = b ? ob(_[27]) : ob(_[26]), !1 == c && ta(_[136]);
                    else {
                        var d = Y.type;
                        if (null == d) if (Y.left || Y.cube) d = "cube";
                        else if (Y.cubestrip) d = _[49];
                        else if (Y.sphere) d = _[432];
                        else if (Y.cylinder) d = _[377];
                        else if (Y.zoomify) d = _[380];
                        else if (Y.qtvr) d = "qtvr";
                        else if (Y.video) d = "video";
                        else {
                            if (Y.mobile || Y.tablet) d = "cube"
                        } else d = w(d);
                        if ("cube" == d) {
                            if (Y.multires && Y.level) {
                                a = Y.level.getArray();
                                d = a.length;
                                b = h.iphone && h.retina || h.ipad || h.android ? 1100 : h.iphone ? 512 : 2560;
                                0 < Xa && (b = Xa + 256);
                                a.sort(function (a, b) {
                                    return +parseInt(a.tiledimagewidth, 10) - parseInt(b.tiledimagewidth, 10)
                                });
                                for (d -= 1; 0 <= d && !(a[d].tiledimagewidth <= b) ; d--);
                                0 <= d && (c = ob(_[264] + d + "]", !0))
                            } !1 == c && (h.desktop || qd ? (c = ob(_[41]), !1 == c && (c = ob(_[27])), !1 == c && (c = ob(_[26]))) : c = ob(_[41]))
                        } else _[49] == d ? (c = pa.createCube(), c.create(!1), c.loadcubestrip(Y.cubestrip.url), U.setpano(c), c = !0, pc(!1, !0)) : null != d && (b ? c = ob(_[27]) : a && (c = ob(_[26])), !1 == c && ta(_[138]))
                    }
                },
                ob = function (a, b) {
                    var c = _[141].split(" "),
                        d = h.iphone ? [0, 1, 2, 3, 4, 5] : [1, 0, 2, 4, 5, 3],
                        e = Array(6),
                        f, j, k = Q(a + "." + c[6] + ".url"),
                        s = "";
                    if (k) {
                        if (s = ya.parsePath(k)) for (f = 0; 6 > f; f++) j = d[f], k = String(c[j]).charAt(0), e[f] = s.split("%s").join(k)
                    } else for (f = 0; 6 > f; f++) if (j = d[f], s = ya.parsePath(Q(a + "." + c[j] + ".url"))) e[f] = s;
                    else return !1;
                    var l, x, c = pa.createCube(),
                        p = 1,
                        k = 1;
                    b && (k = Y.baseindex, f = Q(a), s = Y.tilesize, f = parseInt(f.tiledimagewidth, 10), p = Math.ceil(f / s), c.tiled = !0, c.tilespl = p, c.tilesize = s, c.imagesize = f);
                    c.create(!0);
                    for (f = 0; 6 > f; f++) if (j = d[f], s = e[f], !1 == b) c.loadtile(j, 0, 0, s);
                    else for (l = 0; l < p; l++) for (x = 0; x < p; x++) c.loadtile(j, x, l, Te(s, String(x + k), String(l + k)));
                    Jb = Dd = !0;
                    U.setpano(c);
                    pc(!1, !0);
                    return !0
                },
                Ed = function (a) {
                    qa && (qa.destroy(), qa = null);
                    U && (U.destroy(), U = null);
                    Jb = !0;
                    setTimeout(Ue, a)
                },
                Ue = function () {
                    U = pa.createPano();
                    U.create();
                    Ce();
                    De()
                },
                $a = ka;
            $a.loadpano = function (a, b, c, d, e) {
                Aa.count++;
                Aa.id = Aa.count;
                if (xe()) if (0 > w(c).indexOf(_[304]) && N(_[85], 0), "null" == w(a) && (a = null), a) {
                    S.busy = !0;
                    null == ya.firstxmlpath ? ya.firstxmlpath = ze(a) : a = ya.parsePath(a, !0);
                    ya.currentxmlpath = ze(a);
                    m.xml.url = a;
                    m.xml.content = null;
                    m.xml.scene = null;
                    var f = Aa.id,
                        j = new XMLHttpRequest;
                    void 0 !== j.overrideMimeType && j.overrideMimeType(_[19]);
                    j.onreadystatechange = function () {
                        if (f == Aa.id && 4 == j.readyState) {
                            var k = j.status;
                            if (0 == k || 200 == k || 304 == k) {
                                var l = j.responseXML;
                                if (l && l.childNodes) {
                                    var h = l.childNodes,
                                        p = h.length;
                                    0 == p ? l = null : 2 == p && h[1] && _[29] == h[1].nodeName && (l = null)
                                }
                                l ? (l = P.resolvexmlencryption(l, a), P.resolvexmlincludes(l, function () {
                                    l = P.xmlDoc;
                                    Ad(l, b, c, d, e)
                                })) : 200 == k ? ta(a + _[17]) : ta(a + _[65])
                            } else ta(a + _[24] + j.status + ")")
                        }
                    };
                    try {
                        j.open("GET", a, !0), j.send(null)
                    } catch (k) {
                        ta(a + _[147] + k)
                    }
                } else ye(_[197], b, c, d, e)
            };
            $a.loadxml = ye;
            $a.loadxmldoc = Ad;
            $a.updateview = pc;
            $a.updateplugins = function (a) {
                var b = Ba.getArray(),
                    c = b.length,
                    d;
                for (d = 0; d < c; d++) {
                    var e = b[d];
                    e && (a || e.poschanged) && e.loaded && e.updatepos()
                }
            };
            $a.handleloading = function () {
                var a = !1;
                !1 == rc && (qa && (a |= qa.checkloading()), U && (a |= U.checkloading()));
                Jb = U && (null != U.panocube && U.panocube.isloading && !U.panocube.loaddone || null != U.previewcube && U.previewcube.isloading && !U.previewcube.loaddone);
                Dd && !0 != Jb && (Dd = !1, da(_[231]));
                var b = oa.commands;
                if (0 < b.length && (Jb = !0, 1 < fa() - oa.lastdraw)) {
                    var c = b.splice(0, 8);
                    Ob();
                    oa.ctx.drawImage(oa.image, c[0], c[1], c[2], c[3], c[4], c[5], c[6], c[7]);
                    oa.lastdraw = fa();
                    if (0 == b.length) {
                        if (h.androidstock) {
                            for (var b = c[7], c = oa.ctx.getImageData(c[4], c[5], 1, b).data, d = 0, e = b, f = b; f > d;) 0 == c[4 * (f - 1) + 3] ? e = f : d = f, f = e + d >> 1;
                            if (1 > f / b) return ca(2, _[125]), oa.commands = [], oa.image = null, oa.ctx = null, Ob(), 0 == Xa || 512 < Xa ? (Xa = 512, Ed(2500)) : 512 == Xa ? (Xa = 256, Ed(2500)) : Ed(6E3), !0
                        }
                        oa.image && (oa.image.okay = !0, oa.image.src = null);
                        oa.image = null;
                        oa.ctx = null
                    }
                    Ob()
                }
                if (U && qa) if (!1 == rc) {
                    if (null == U.previewcube || U.previewcube && !0 == U.previewcube.loaddone) rc = !0, Wc = -1
                } else a = 0, 0 < xb && (-1 == Wc && (Wc = fa()), a = (fa() - Wc) / 1E3 / xb, 1 < a && (a = 1), a = 1 - a * a * a, 0 > a && (a = 0), U.setBlend(1 - a), zc = !0, Ac = 1 - a), 0 == a && (qa && (qa.destroy(), qa = null), Bd = rc = !1), a = !0;
                return a
            };
            $a.checkautorotate = function (a) {
                var b = fa();
                a && (Sb = b);
                Sb > Pa && (Pa = Sb);
                a = b - Pa;
                a > 1E3 * m.idletime && Pa != Pd && (Pd = Pa, da(_[419]));
                a = b - Sb;
                if (la.enabled && a > 1E3 * la.waittime) {
                    var c = r._hlookat;
                    a = r._vlookat;
                    var b = r._fov,
                        d = Math.tan(Math.min(0.5 * b, 45) * ja),
                        e = la.accel,
                        f = la.speed,
                        j = la.currentmovingspeed,
                        e = e / 60,
                        f = f / 60;
                    0 < f ? (j += e * e, j > f && (j = f)) : (j -= e * e, j < f && (j = f));
                    la.currentmovingspeed = j;
                    c += d * j;
                    d = Math.abs(d * j);
                    r._hlookat = c;
                    c = parseFloat(la.horizon);
                    isNaN(c) || (c = (c - a) / 60, e = Math.abs(c), 0 < e && (e > d && (c = d * c / e), a += c, r._vlookat = a));
                    a = parseFloat(la.tofov);
                    isNaN(a) || (a < r.fovmin && (a = r.fovmin), a > r.fovmax && (a = r.fovmax), a = (a - b) / 60, c = Math.abs(a), 0 < c && (c > d && (a = d * a / c), b += a, r._fov = b));
                    return !0
                }
                la.currentmovingspeed = 0;
                return !1
            };
            var oa = function () { };
            $a.drawimagequeue = oa;
            oa.busy = function () {
                return 0 < oa.commands.length
            };
            oa.ctx = null;
            oa.image = null;
            oa.commands = [];
            oa.lastdraw = 0;
            var Z = [],
                Aa = {
                    count: 0,
                    id: 0
                },
                ba = 0,
                qc = !1,
                xb = 0,
                Dd = !1,
                Jb = !1,
                Bd = !1,
                rc = !1,
                Wc = !1;
            $a.isLoading = function () {
                return Jb
            };
            $a.isBlending = function () {
                return Bd || rc
            };
            var Vc = null;
            $a.previewdone = Cd;
            var Te = function (a, b, c) {
                var d = "",
					e = a.length,
					f, j = !1,
					k = 0,
					h;
                for (f = 0; f < e; f++) {
                    var l = a.charAt(f);
                    if ("%" == l) j = !0, k = 0;
                    else if ("0" == l) j ? k++ : d += l;
                    else if (j) if (j = !1, h = null, 0 <= _[348].indexOf(l) ? h = b : 0 <= _[418].indexOf(l) && (h = c), null != h) {
                        for (; h.length <= k;) h = "0" + h;
                        d += h
                    } else d += "%" + l;
                    else j = !1, d += l
                }
                return d
            };
            $a.checkHovering = function () {
                if (!(1 == (Rb & 1) || S.blocked)) {
                    var a = [Ba.getArray(), Na.getArray()],
                        b, c, d, e, f;
                    for (f = 0; 2 > f; f++) {
                        b = a[f];
                        d = b.length;
                        for (e = 0; e < d; e++) (c = b[e]) && (c._visible && c.hovering && c.onhover) && S.callaction(c.onhover, c)
                    }
                }
            };
            var pa = {},
                Ve = function () {
                    var a = Ta;
                    try {
                        var b = a.COMPILE_STATUS,
                            c = a.createShader(a.VERTEX_SHADER);
                        a.shaderSource(c, "attribute vec3 vx;attribute vec2 tx;uniform float sh;uniform float ch;uniform mat4 wm;uniform mat4 pm;varying vec2 tt;void main(){vec3 vs=1000.0*normalize(vx);vec2 c2=normalize(vec2(vx.x,vx.z));vec3 vc=1000.0*vec3(c2.x,clamp(vx.y*inversesqrt(vx.x*vx.x+vx.z*vx.z),-30.0,+30.0),c2.y);vec3 vv=vx*(1.0-sh)+sh*(vs*(1.0-ch)+vc*ch);gl_Position=pm*wm*vec4(vv,1);tt=tx;}");
                        a.compileShader(c);
                        if (!a.getShaderParameter(c, b)) return !1;
                        var d = a.createShader(a.FRAGMENT_SHADER);
                        a.shaderSource(d, "#ifdef GL_ES\n#ifdef GL_FRAGMENT_PRECISION_HIGH\nprecision highp float;\n#else\nprecision mediump float;\n#endif\n#endif\nuniform float aa;uniform sampler2D sm;varying vec2 tt;void main(){vec4 c=texture2D(sm,vec2(tt.s,tt.t)" + (h.opera ? "" : ",-1.0") + ");gl_FragColor=vec4(c.rgb,c.a*aa);}");
                        a.compileShader(d);
                        if (!a.getShaderParameter(d, b)) return !1;
                        var e = a.createProgram();
                        a.attachShader(e, c);
                        a.attachShader(e, d);
                        a.linkProgram(e);
                        if (!a.getProgramParameter(e, a.LINK_STATUS)) return !1;
                        a.useProgram(e);
                        Fd = a.getAttribLocation(e, "vx");
                        Gd = a.getAttribLocation(e, "tx");
                        Ee = a.getUniformLocation(e, "sh");
                        Fe = a.getUniformLocation(e, "ch");
                        Ge = a.getUniformLocation(e, "aa");
                        He = a.getUniformLocation(e, "sm");
                        Ie = a.getUniformLocation(e, "pm");
                        Je = a.getUniformLocation(e, "wm");
                        a.enableVertexAttribArray(Fd);
                        a.enableVertexAttribArray(Gd);
                        za.sh = e;
                        za.vs = c;
                        za.ps = d
                    } catch (f) {
                        return !1
                    }
                    return !0
                },
                Ke = function (a) {
                    if (a) {
                        var b = Ta;
                        b.deleteBuffer(a.vx);
                        b.deleteBuffer(a.tx);
                        b.deleteBuffer(a.ix);
                        a.vx = null;
                        a.tx = null;
                        a.ix = null;
                        a.vxd = null;
                        a.txd = null;
                        a.ixd = null;
                        a.tcnt = 0
                    }
                },
                Sa = pa,
                ha = Sa.webgl = !1,
                La = null,
                Ta = null,
                za = null,
                sc = 0,
                Fd, Gd, Ee, Fe, Ge, He, Ie, Je, ra, bc, Kb, Xc, Yc, Hd, Zc, Le, Id, Me, $c;
            Sa.setup = function (a) {
                var b, c = null;
                Sa.reset();
                if (2 == a) {
                    try {
                        La = V(2);
                        La.style.position = _[0];
                        La.style.left = 0;
                        for (b = La.style.top = 0; 4 > b && !(c = La.getContext([_[62], _[71], _[95], _[92]][b])) ; b++);
                    } catch (d) { }
                    La && c && (Ta = c, za = {}, Ve() && (ra = c.TEXTURE_2D, bc = c.TEXTURE0, Kb = c.ARRAY_BUFFER, Xc = c.ELEMENT_ARRAY_BUFFER, Yc = c.RGBA, Hd = c.RGB, Zc = c.UNSIGNED_BYTE, Le = c.UNSIGNED_SHORT, Id = c.FLOAT, Me = c.TRIANGLES, $c = c.STATIC_DRAW, c.clearColor(0, 0, 0, 0), c.disable(c.DEPTH_TEST), c.depthFunc(c.NEVER), c.enable(c.BLEND), c.blendFunc(c.SRC_ALPHA, c.ONE_MINUS_SRC_ALPHA), c.enable(c.CULL_FACE), c.cullFace(c.FRONT), sc = c.getParameter(c.MAX_TEXTURE_SIZE), 4096 < sc && (sc = 4096), 2048 >= sc && (h.firefox && !h.mac && !h.android) && (h.css3d = !1), H.panolayer.appendChild(La), Sa.infoString = _[350], ha = !0, Sa.webgl = !0));
                    !1 == ha && (Ta = La = null, a = 1, h.webgl = !1)
                }
                1 == a && (Sa.infoString = "", h.webgl = !1);
                h.buildList()
            };
            Sa.reset = function () {
                if (ha) {
                    var a = Ta;
                    za && (a.deleteProgram(za.sh), a.deleteShader(za.vs), a.deleteShader(za.ps), za.obj0 && (Ke(za.obj0), Ke(za.obj), za.obj0 = null, za.obj = null), za = null);
                    ha = !1;
                    Ta = La = null
                }
            };
            Sa.size = function (a, b) {
                if (ha) {
                    var c = (h.android && !1 == h.androidstock || h.blackberry) && !1 == h.hidpi ? h.pixelratio : 1,
                        d = a * c + 0.5 | 0,
                        c = b * c + 0.5 | 0;
                    if (La.width != d || La.height != c) La.width = d, La.height = c, La.style.width = a + "px", La.style.height = b + "px", Ta.viewport(0, 0, d, c), h.gl = {
                        width: d,
                        height: c
                    }
                } else h.gl = {
                    width: 0,
                    height: 0
                }, qa && qa.updateviewport(), U && U.updateviewport()
            };
            Sa.startFrame = function () {
                if (ha) {
                    var a = Ta;
                    a.clear(a.COLOR_BUFFER_BIT)
                }
            };
            Sa.finishFrame = function () {
                if (ha) {
                    var a = Ta;
                    h.androidstock && a.finish()
                }
            };
            Sa.drawtileimage = function (a, b, c) {
                var d = !1;
                if (ha) {
                    d = Ta;
                    if (!a.textures) return;
                    if (!1 == a.tiled || 1 == a.tilespl) {
                        var e = !1,
                            f = h.opera ? "" : w(eb.mipmapping),
                            j = "force" == f,
                            k = sc;
                        void 0 !== eb.hardwarelimit && (k = parseFloat(eb.hardwarelimit));
                        if (!0 != h.blackberry && (j || c.width > k)) if (j && (k = 1536 < c.width ? 2048 : 1024), c.width != k || c.height != k) {
                            var s = V(2);
                            s.width = k;
                            s.height = k;
                            s.getContext("2d").drawImage(c, 0, 0, c.width, c.height, 0, 0, k, k);
                            c = s
                        }
                        k = a.textures[b];
                        null == k ? (k = d.createTexture(), d.activeTexture(bc), d.bindTexture(ra, k), d.texParameteri(ra, d.TEXTURE_WRAP_T, d.CLAMP_TO_EDGE), d.texParameteri(ra, d.TEXTURE_WRAP_S, d.CLAMP_TO_EDGE), d.texParameteri(ra, d.TEXTURE_MAG_FILTER, d.LINEAR), (j || "auto" == f) && 1024 <= c.width && 0 == (c.width & c.width - 1) ? (d.texParameteri(ra, d.TEXTURE_MIN_FILTER, d.LINEAR_MIPMAP_LINEAR), e = !0) : d.texParameteri(ra, d.TEXTURE_MIN_FILTER, d.LINEAR), a.textures[b] = k) : (d.activeTexture(bc), d.bindTexture(ra, k));
                        d.texImage2D(ra, 0, Hd, Hd, Zc, c);
                        e && d.generateMipmap(ra)
                    } else k = a.textures[b], null == k ? (k = d.createTexture(), d.activeTexture(bc), d.bindTexture(ra, k), d.texParameteri(ra, d.TEXTURE_WRAP_T, d.CLAMP_TO_EDGE), d.texParameteri(ra, d.TEXTURE_WRAP_S, d.CLAMP_TO_EDGE), d.texParameteri(ra, d.TEXTURE_MAG_FILTER, d.LINEAR), d.texParameteri(ra, d.TEXTURE_MIN_FILTER, d.LINEAR), d.texImage2D(ra, 0, Yc, a.canvassize, a.canvassize, 0, Yc, Zc, null), a.textures[b] = k) : (d.activeTexture(bc), d.bindTexture(ra, k)), d.texSubImage2D(ra, 0, c.th * a.tilesize, c.tv * a.tilesize, Yc, Zc, c);
                    d.bindTexture(ra, null);
                    d = !0
                } else if (!1 == a.usecanvas || !0 == kd) {
                    j = [1, 3, 0, 2, 4, 5];
                    c = [];
                    e = a.faces[b];
                    for (f = 0; 6 > f; f++) c[j[f]] = f;
                    j = c[b];
                    for (f = 0; 6 > f; f++) if (f != b && (k = c[f], s = a.faces[f], s.parentNode == a.layer && j < k)) {
                        a.layer.insertBefore(e, s);
                        e = null;
                        break
                    }
                    e && a.layer.appendChild(e);
                    !1 == a.usecanvas && (d = !0)
                }
                return d
            };
            Sa.renderpano = function (a, b) {
                if (ha) {
                    var c = Ta,
                        d = Fa,
                        e = ma,
                        f = a.stopped && a.state ? a.state : r.getState();
                    a.state = f;
                    var j = f.h,
                        k = f.v,
                        h = f.z,
                        l = f.r,
                        x = 1 / (0.5 * d),
                        p = -1 / (0.5 * e),
                        e = f.zf,
                        q = f.yf,
                        d = Math.min(e / 200, 1),
                        f = 0 < e ? f.ch : 0,
                        x = new Float32Array([x, 0, 0, 0, 0, p, 0, 0, 0, 0, 65535 / 65536, 1, 0, 0, 65535 / 65536 - 1, 0]),
                        j = Md(j - 90, -k, l),
                        n = xc([h, 0, 0, 0, 0, h, 0, 0, 0, q, 1, 0, 0, e * q, e, 1]),
                        h = xc(),
                        k = n[0],
                        l = n[1],
                        q = n[2],
                        p = n[3],
                        g = n[4],
                        m = n[5],
                        t = n[6],
                        D = n[7],
                        G = n[8],
                        v = n[9],
                        K = n[10],
                        w = n[11],
                        u = n[12],
                        B = n[13],
                        E = n[14],
                        n = n[15],
                        A = j[0],
                        C = j[1],
                        y = j[2],
                        I = j[3];
                    h[0] = A * k + C * g + y * G + I * u;
                    h[1] = A * l + C * m + y * v + I * B;
                    h[2] = A * q + C * t + y * K + I * E;
                    h[3] = A * p + C * D + y * w + I * n;
                    A = j[4];
                    C = j[5];
                    y = j[6];
                    I = j[7];
                    h[4] = A * k + C * g + y * G + I * u;
                    h[5] = A * l + C * m + y * v + I * B;
                    h[6] = A * q + C * t + y * K + I * E;
                    h[7] = A * p + C * D + y * w + I * n;
                    A = j[8];
                    C = j[9];
                    y = j[10];
                    I = j[11];
                    h[8] = A * k + C * g + y * G + I * u;
                    h[9] = A * l + C * m + y * v + I * B;
                    h[10] = A * q + C * t + y * K + I * E;
                    h[11] = A * p + C * D + y * w + I * n;
                    A = j[12];
                    C = j[13];
                    y = j[14];
                    I = j[15];
                    h[12] = A * k + C * g + y * G + I * u;
                    h[13] = A * l + C * m + y * v + I * B;
                    h[14] = A * q + C * t + y * K + I * E;
                    h[15] = A * p + C * D + y * w + I * n;
                    c.uniform1i(He, 0);
                    c.uniform1f(Ge, a.alpha);
                    c.uniform1f(Ee, d);
                    c.uniform1f(Fe, f);
                    c.uniformMatrix4fv(Ie, !1, x);
                    c.uniformMatrix4fv(Je, !1, h);
                    d = [];
                    a.previewcube && a.previewcube.visible && d.push(a.previewcube);
                    a.panocube && a.panocube.visible && d.push(a.panocube);
                    j = d.length;
                    for (f = 0; f < j; f++) if (h = d[f], k = 10 < e ? h.obj : h.obj0, h && h.textures && k) {
                        c.bindBuffer(Kb, k.vx);
                        c.vertexAttribPointer(Fd, 3, Id, !1, 0, 0);
                        c.bindBuffer(Kb, k.tx);
                        c.vertexAttribPointer(Gd, 2, Id, !1, 0, 0);
                        c.bindBuffer(Xc, k.ix);
                        for (x = 0; 6 > x; x++) h.textures[x] && (c.activeTexture(bc), c.bindTexture(ra, h.textures[x]), c.drawElements(Me, k.tcnt, Le, 2 * x * k.tcnt))
                    }
                } else a.render(b)
            };
            Sa.createPano = function () {
                return new We
            };
            Sa.createCube = function () {
                return new Xe
            };
            var We = function () {
                var a = this;
                a.hlookat = 0;
                a.vlookat = 0;
                a.zoom = 1;
                a.previewcube = null;
                a.panocube = null;
                a.layer = null;
                a.alpha = 1;
                var b = !1,
					c = !1;
                a.stopped = !1;
                a.create = function () {
                    if (!ha) {
                        var b = V(),
							c = b.style;
                        c.position = _[0];
                        c.left = 0;
                        c.top = 0;
                        a.layer = b;
                        H.panolayer.appendChild(b)
                    }
                };
                a.destroy = function () {
                    try {
                        ha ? (a.previewcube && (a.previewcube.destroy(), a.previewcube = null), a.panocube && (a.panocube.destroy(), a.panocube = null)) : (a.previewcube && (c && a.layer.removeChild(a.previewcube.layer), a.previewcube = null), a.panocube && (b && a.layer.removeChild(a.panocube.layer), a.panocube = null), H.panolayer.removeChild(a.layer))
                    } catch (d) { }
                    b = c = !1;
                    a.previewcube = null;
                    a.panocube = null;
                    a.layer = null
                };
                a.removemainpano = function () {
                    ha ? (a.previewcube && (a.previewcube.visible = !0), a.panocube && (a.panocube.destroy(), a.panocube = null)) : (!1 == c && a.previewcube && (a.layer.appendChild(a.previewcube.layer), c = !0), a.panocube && (b && (a.layer.removeChild(a.panocube.layer), b = !1), a.panocube = null))
                };
                a.stop = function () {
                    a.stopped = !0
                };
                a.checkloading = function () {
                    if (a.stopped) return !1;
                    var b = !1,
						d = [a.previewcube, a.panocube],
						j, k, s;
                    s = d.length;
                    var l = 0,
						x = 0;
                    for (j = 0; j < s; j++) {
                        var p = d[j],
							q = !0;
                        if (p && p.isloading) {
                            var n = p.images,
								g;
                            g = n.length;
                            var m = p.fmax | 0,
								r = p.fhave | 0;
                            g > m && (m = g);
                            for (k = 0; k < g; k++) {
                                var D = n[k],
									G = D.naturalWidth,
									v = D.naturalHeight;
                                if (0 == p.imagesize && 0 < G && 0 < v) {
                                    p.imagesize = G;
                                    if (!1 == p.setimagesize(G, v, D)) {
                                        p.isloading = !1;
                                        p.images = [];
                                        break
                                    }
                                    p.allocfaces();
                                    b = !0
                                }
                                D.complete && 0 < G && 0 < v ? (!1 == D.done && D.drawtile(), D.done ? (b = !0, r++, n.splice(k, 1), g--, k--) : q = !1) : q = !1
                            }
                            p.fmax = m;
                            p.fhave = r;
                            1 == j && (l += m, x += r);
                            p.isloading = !q;
                            p.loaddone = q;
                            0 == j && q && ka.previewdone();
                            q && 1 == j && !1 == ha && setTimeout(function () {
                                try {
                                    var b = a.panocube,
										c, d, e, g, f, k, l, j, s = h.windows && h.safari || h.androidstock ? 1 : 2;
                                    e = b.cubesize;
                                    if (b.usecanvas) {
                                        var p = 4;
                                        Cb && (p = 6, s = 1);
                                        for (c = 0; c < p; c++) if (g = b.faces[c], l = g.getContext("2d"), f = (b.canvassizes[c][0] - e) / 2, k = (b.canvassizes[c][1] - e) / 2, l) {
                                            l.imageSmoothingEnabled = !1;
                                            if (0 < f) if (1 == s) {
                                                j = l.getImageData(f, k, 1, e);
                                                for (d = 0; d < f; d++) l.putImageData(j, d, k);
                                                j = l.getImageData(f + e - 1, k, 1, e);
                                                for (d = 0; d < f; d++) l.putImageData(j, f + e + d, k)
                                            } else l.drawImage(g, f, k, 1, e, 0, k, f, e), l.drawImage(g, f + e - 1, k, 1, e, f + e, k, f, e);
                                            if (0 < k) if (1 == s) {
                                                j = l.getImageData(0, k, g.width, 1);
                                                for (d = 0; d < k; d++) l.putImageData(j, 0, d);
                                                j = l.getImageData(0, k + e - 1, g.width, 1);
                                                for (d = 0; d < k; d++) l.putImageData(j, 0, k + e + d)
                                            } else l.drawImage(g, 0, k, g.width, 1, 0, 0, g.width, k), l.drawImage(g, 0, k + e - 1, g.width, 1, 0, k + e, g.width, k)
                                        }
                                    }
                                } catch (n) { }
                            }, 10)
                        }
                    }
                    c && !1 == ld && (a.panocube && !1 == a.panocube.isloading && !1 == ka.drawimagequeue.busy()) && (c = !1, !1 == ha ? setTimeout(function () {
                        try {
                            c && (a.layer && a.previewcube) && (a.layer.removeChild(a.previewcube.layer), c = a.previewcube.visible = !1)
                        } catch (b) { }
                    }, 1500) : a.previewcube.visible = !1);
                    0 < l && (Ec.progress = x / l);
                    return b
                };
                a.updateviewport = function () {
                    var b = Fa,
						c = ma,
						d = b / 2 + "px",
						k = c / 2 + "px";
                    ha || (a.layer.style.width = b + "px", a.layer.style.height = c + "px", 0 == Ga && (a.previewcube && (b = a.previewcube.layer) && (b.style[pd] = d + " " + k), a.panocube && (b = a.panocube.layer) && (b.style[pd] = d + " " + k)))
                };
                a.setBlend = function (b) {
                    ha ? a.alpha = b : a.layer && (a.layer.style.opacity = b)
                };
                var d = _[126].split(" ");
                a.render = function () {
                    var b = Fa,
						c = ma,
						j = [a.panocube, a.previewcube],
						k, s, l = a.stopped && a.state ? a.state : r.getState();
                    a.state = l;
                    var x = l.h,
						p = l.v,
						q = l.z,
						n = l.r,
						l = l.yf,
						g, m, t;
                    if (!ha) {
                        k = h.iosversion && "4" > h.iosversion ? "" : "px";
                        var D = Ga;
                        0 == D && (a.layer.style[h.browser.css.perspective] = q + k, a.layer.style[va] = _[83] + l + "px)");
                        s = j.length;
                        for (k = 0; k < s; k++) {
                            var G = j[k];
                            if (G && (m = G.cubesize, 0 < m)) if (0 == D) g = 0.5 * (b - m), m = 0.5 * (c - m), t = 100 * k, G.layer.style[va] = _[368] + -n + _[25] + q + _[80] + -p + _[43] + x + "deg) " + (0 < t ? _[373] + t + "," + t + "," + t + ") " : "") + _[83] + m + _[216] + g + "px)";
                            else {
                                t = 1 + k;
                                2 == D && (t *= 5);
                                t = _[254] + b / 2 + "px," + c / 2 + _[178] + l + _[218] + q + _[270] + -n + _[25] + q + _[80] + -p + _[43] + x + _[233] + t + "," + t + "," + t + ") ";
                                for (g = 0; 6 > g; g++) {
                                    var v = -m / 2,
										v = _[113] + d[g] + _[234] + (v - (G.canvassizes[g][0] - m) / 2) + "px," + (v - (G.canvassizes[g][1] - m) / 2) + "px," + v + "px) ",
										K = G.faces[g];
                                    K.style.position = _[0];
                                    K.style[va + _[58]] = "0 0";
                                    K.style[va] = t + v
                                }
                            }
                        }
                    }
                };
                a.setpreview = function (b) {
                    a.previewcube = b;
                    ha || (a.layer.appendChild(b.layer), a.updateviewport());
                    c = !0
                };
                a.setpano = function (c) {
                    a.panocube = c;
                    ha || (a.layer.appendChild(c.layer), a.updateviewport());
                    b = !0
                }
            },
                Xe = function () {
                    function a(a, b, c, d) {
                        this.tcnt = a;
                        this.vxd = b;
                        this.txd = c;
                        this.ixd = d;
                        this.ix = this.tx = this.vx = null
                    }
                    function b(a) {
                        var b = Ta;
                        b.bindBuffer(Kb, a.vx = b.createBuffer());
                        b.bufferData(Kb, new Float32Array(a.vxd), $c);
                        b.bindBuffer(Kb, a.tx = b.createBuffer());
                        b.bufferData(Kb, new Float32Array(a.txd), $c);
                        b.bindBuffer(Xc, a.ix = b.createBuffer());
                        b.bufferData(Xc, new Uint16Array(a.ixd), $c)
                    }
                    function c(b, c) {
                        var d = [],
                            e = [],
                            f = [];
                        if (isNaN(c) || 0 >= c) c = 1;
                        var j, h, g, m, r, D, G, v, t, w, u, B, E, A, C, y, I = [
                            [-1, 0, 0, 0, 1, 0, 0, 0, -1],
                            [0, 0, -1, 0, 1, 0, 1, 0, 0],
                            [1, 0, 0, 0, 1, 0, 0, 0, 1],
                            [0, 0, 1, 0, 1, 0, -1, 0, 0],
                            [0, -1, 0, 0, 0, -1, 1, 0, 0],
                            [0, 1, 0, 0, 0, 1, 1, 0, 0]
                        ];
                        for (j = 0; 6 > j; j++) {
                            v = I[j][0];
                            t = I[j][1];
                            w = I[j][2];
                            u = I[j][3];
                            B = I[j][4];
                            E = I[j][5];
                            A = I[j][6];
                            C = I[j][7];
                            y = I[j][8];
                            for (g = 0; g <= c; g++) for (h = 0; h <= c; h++) m = h / c, r = g / c, e.push(m), e.push(r), m = 2 * (m - 0.5), r = 2 * (r - 0.5), D = v * m + t * r + w, G = u * m + B * r + E, m = A * m + C * r + y, d.push(b * D), d.push(b * G), d.push(b * m);
                            w = j * (c + 1) * (c + 1);
                            for (g = 0; g < c; g++) for (h = 0; h < c; h++) D = w + h + g * (c + 1), G = D + 1, v = D + (c + 1), t = v + 1, f.push(D), f.push(G), f.push(v), f.push(G), f.push(t), f.push(v)
                        }
                        return new a(6 * c * c, d, e, f)
                    }
                    var d = this,
                        e = 0 | h._cubeOverlap,
                        f = [1, 3, 0, 2, 4, 5];
                    d.layer = null;
                    d.visible = !0;
                    d.usecanvas = !0;
                    d.canvassize = 0;
                    d.cubesize = 0;
                    d.imagesize = 0;
                    d.canvassizes = [];
                    d.cubesizes = [];
                    d.tiled = !1;
                    d.tilespl = 0;
                    d.tilesize = 0;
                    d.faces = Array(6);
                    d.isloading = !0;
                    d.loaddone = !1;
                    d.cubestrip = !1;
                    d.images = [];
                    d.create = function (a) {
                        var e;
                        if (ha) d.obj || (e = a = null, null == za.obj0 ? (a = c(1E3, 1), e = c(1E3, 49), b(a), b(e), za.obj0 = a, za.obj = e) : (a = za.obj0, e = za.obj), d.obj0 = a, d.obj = e);
                        else {
                            if (!1 == md && !0 == a && (!1 == d.tiled || 1 == d.tilespl)) d.usecanvas = !1;
                            var l = d.layer = V();
                            l.style.position = _[0];
                            l.style.pointerEvents = "none";
                            0 < Ga ? (l.style.width = "100%", l.style.height = "100%", l.style.overflow = _[4]) : l.style[nd] = _[28];
                            for (e = 0; 6 > e; e++) {
                                a = f[e];
                                var j = V(d.usecanvas ? 2 : 1);
                                j.width = 16;
                                j.height = 16;
                                j.style.overflow = _[4];
                                2 == Ga && (j.style.overflow = _[53], j.style.position = _[0], j.style.left = 0, j.style.top = 0, j.style[va] = _[186], j.style.overflow = _[4]);
                                d.faces[a] = j;
                                d.usecanvas && !1 == kd && l.appendChild(j)
                            }
                        }
                        0 < d.imagesize && d.allocfaces()
                    };
                    d.destroy = function () {
                        if (ha) {
                            var a = Ta;
                            d.obj0 = null;
                            d.obj = null;
                            if (d.textures) {
                                var b, c;
                                for (b = 0; 6 > b; b++) c = d.textures[b], d.textures[b] = null, a.deleteTexture(c);
                                d.textures = null
                            }
                        }
                    };
                    d.loadtile = function (a, b, c, e) {
                        var f = null,
                            f = d.usecanvas ? V(1) : d.faces[a];
                        f.load = function () { };
                        f.side = a;
                        f.th = b;
                        f.tv = c;
                        f.url = e;
                        f.done = !1;
                        f.drawtile = d.drawtile;
                        z(f, "load", function () {
                            this.okay = !0
                        }, !1);
                        z(f, _[23], function () {
                            !0 !== this.okay && (this.done = !0, ca(3, _[84] + this.url + _[100]))
                        }, !1);
                        f.src = e;
                        f.load(e);
                        d.images.push(f);
                        d.isloading = !0
                    };
                    var j = 0;
                    d.drawtile = function () {
                        if (!ka.drawimagequeue.busy() && Rb != j) {
                            j = Rb;
                            Ob();
                            var a = 1 == this.side || 3 == this.side ? e : 0,
                                b = 3 >= this.side ? e : 0;
                            Cb && (a = b = e);
                            if (!pa.drawtileimage(d, this.side, this)) {
                                var c = d.imagesize,
                                    f = d.cubesize,
                                    p = this.th,
                                    q = this.tv,
                                    n = d.faces[this.side].getContext("2d");
                                if (n) if (ka.drawimagequeue.ctx = n, ka.drawimagequeue.image = this, n = ka.drawimagequeue.commands, !1 == d.tiled || 1 == d.tilespl) if (h._iOS6_canvas_bug) {
                                    p = 1;
                                    p = V(2);
                                    p.width = 1;
                                    p.height = c;
                                    p = p.getContext("2d");
                                    p.drawImage(this, 0, 0, 1, c, 0, 0, 1, c);
                                    for (var p = p.getImageData(0, 0, 1, c).data, q = 0, g = c, m = c; m > q;) 0 == p[4 * (m - 1) + 3] ? g = m : q = m, m = g + q >> 1;
                                    p = m / c;
                                    0 >= p && (p = 1);
                                    n.push(0, 0, c, c, a, b / p, f, f / p)
                                } else n.push(0, 0, c, c, a, b, f, f);
                                else g = this.naturalWidth, m = this.naturalHeight, c = f / c, 1 == c ? n.push(0, 0, g, m, a + p * d.tilesize * c, b + q * d.tilesize * c, g * c, m * c) : n.push(0, 0, g, m, a + p * d.tilesize * c - 0.5, b + q * d.tilesize * c - 0.5, g * c + 1, m * c + 1)
                            }
                            this.done = !0
                        }
                    };
                    d.loadcubestrip = function (a) {
                        d.cubestrip = !0;
                        a = ya.parsePath(a);
                        var b = V(1);
                        b.url = a;
                        b.done = !1;
                        b.drawtile = d.drawcubestrip;
                        z(b, _[23], function () {
                            ca(3, _[84] + this.url + _[100])
                        }, !1);
                        b.src = a;
                        d.images.push(b);
                        d.isloading = !0
                    };
                    d.drawcubestrip = function () {
                        var a = d.imagesize,
                            b = d.cubesize,
                            c = d.canvassize,
                            f = this.naturalWidth / a,
                            j = this.naturalHeight / a;
                        Ob();
                        var h = [0, 1, 2, 3, 4, 5];
                        d.striporder && (h = d.striporder);
                        var n, g, m;
                        for (g = 0; g < j; g++) for (n = 0; n < f; n++) {
                            m = h[g * f + n];
                            if (ha) {
                                var r = V(2);
                                r.width = a;
                                r.height = a;
                                r.getContext("2d").drawImage(this, n * a, g * a, a, a, 0, 0, a, a)
                            } else {
                                var D = d.faces[m].getContext("2d");
                                if (D) {
                                    var G = 1 == m || 3 == m ? e : 0,
                                        v = 3 >= m ? e : 0;
                                    Cb && (G = v = e);
                                    0 < e && (0 < v && (D.drawImage(this, n * a + 0, g * a + 0, a, 1, G, 0, a, v), D.drawImage(this, n * a + 0, g * a + a - 1, a, 1, G, c - v, a, v)), 0 < G && (D.drawImage(this, n * a + 0, g * a + 0, 1, a, 0, G, G, a), D.drawImage(this, n * a + a - 1, g * a + 0, 1, a, c - G, G, G, a)));
                                    D.drawImage(this, n * a, g * a, a, a, G, v, b, b)
                                }
                            }
                            pa.drawtileimage(d, m, r)
                        }
                        this.done = !0
                    };
                    d.setimagesize = function (a, b, c) {
                        if (d.cubestrip) if (3 * a == 2 * b) a /= 2;
                        else if (2 * a == 3 * b) a /= 3;
                        else if (1 * a == 6 * b) a /= 6;
                        else if (6 * a == 1 * b) a /= 1;
                        else return c && ca(2, _[154] + c.src + _[150]), !1;
                        d.imagesize = a;
                        return !0
                    };
                    d.allocfaces = function () {
                        if (ha) {
                            var a = d.imagesize;
                            d.canvassize = a;
                            d.cubesize = a;
                            d.canvassizes = [
                                [a, a],
                                [a, a],
                                [a, a],
                                [a, a],
                                [a, a],
                                [a, a]
                            ];
                            d.textures || (d.textures = [null, null, null, null, null, null])
                        } else {
                            var b = h.iphone && h.retina ? 800 : h.realDesktop ? 2560 : h.ipad || h.android || h.tablet ? 1024 : 600;
                            h.desktop && h.safari && (b = 2E3);
                            0 < Xa && (b = Xa);
                            h.ipod && h.retina && 640 < b && (b = 640);
                            var c = a = d.imagesize,
                                a = a + 2 * e;
                            a > b && (a = b, c = a - 2 * e);
                            2 == Ga && 0 != c % 256 && (e = 1, a += 2);
                            if (d.usecanvas && (h.chrome && !1 == h.webgl || 0 == Ga && a > (h.realDesktop ? 2E3 : 1024))) ld = !0;
                            d.canvassize = a;
                            d.cubesize = c;
                            var b = -(0.5 * c) + "px",
                                c = [0, 0, 0, 0, -90, 90],
                                f = [90, 0, -90, -180, 0, 0],
                                j, q = !h.realDesktop ? h.iosversion ? "3.2" > h.iosversion : !1 : !1;
                            for (j = 0; 6 > j; j++) {
                                var n = d.faces[j],
                                    g = 1 == j || 3 == j ? 0 : e,
                                    m = 3 >= j ? 0 : e;
                                Cb && (g = m = 0);
                                if (!q || q && 0 < j) n.style.position = _[0];
                                n.width = a - 2 * g;
                                n.height = a - 2 * m;
                                d.canvassizes[j] = [n.width, n.height];
                                Cb ? (n.style.left = -e + "px", n.style.top = -e + "px", n.style.width = a + "px", n.style.height = a + "px") : (n.style.left = "0px", n.style.top = "0px", n.style.width = n.width + "px", n.style.height = n.height + "px");
                                n.style[va] = _[354] + c[j] + _[43] + f[j] + _[25] + b + ")"
                            }
                        }
                    }
                },
                Ye = function () {
                    function a(a) {
                        var b = Fa,
                            c = ma;
                        return "VFOV" == a ? c : "HFOV" == a ? b : "DFOV" == a ? Math.sqrt(b * b + c * c) : Math.max(b, 4 * c / 3)
                    }
                    var b = this;
                    b.haschanged = !1;
                    var c = _[118].split(" "),
                        d = [_[357], _[240], _[379], _[156]],
                        e;
                    for (e in c) Va(b, c[e], 0);
                    for (e in d) Va(b, d[e], !1);
                    Va(b, _[381], "VFOV");
                    b.defaults = function () {
                        b._hlookat = 0;
                        b._vlookat = 0;
                        b._architectural = 0;
                        b._architecturalonlymiddle = !1;
                        b._fov = 90;
                        b._fovtype = h.desktop ? "VFOV" : "MFOV";
                        b._camroll = 0;
                        b._maxpixelzoom = Number.NaN;
                        b._stereographic = !1;
                        b._pannini = !1;
                        b._fisheye = 0;
                        b._fisheyefovlink = 0.5;
                        b.fovmin = 50;
                        b.fovmax = 179;
                        b.r_zoom = 1;
                        b.r_yoff = 0;
                        b.r_zoff = 0;
                        b.haschanged = !1;
                        b.limitview = "auto";
                        b.hlookatmin = Number.NaN;
                        b.hlookatmax = Number.NaN;
                        b.vlookatmin = Number.NaN;
                        b.vlookatmax = Number.NaN
                    };
                    b.inverseProject = function (a, c) {
                        var d, e, f, h, q, n, g, m;
                        f = -1E3;
                        q = f / b.r_zoom;
                        d = (a - Fa / 2) * q;
                        e = (c - ma / 2) * q;
                        q = 1 / Math.sqrt(d * d + e * e + f * f);
                        d *= q;
                        e *= q;
                        f *= q;
                        h = b.r_zoff;
                        if (0 < h) {
                            if (!1 == b._stereographic && (m = Math.atan(1E3 / h) / ja - 1, (1 > -f ? Math.acos(-f) / ja : 0) > m)) n = -e, g = d, q = n * n + g * g, 0 < q && (q = 1 / Math.sqrt(q), n *= q, g *= q), m *= ja, q = Math.sin(m), d = q * g, e = -q * n, f = -Math.cos(m);
                            n = h * f;
                            g = n * n - (h * h - 1E6);
                            0 < g && (q = -n + Math.sqrt(g), d *= q, e *= q, f = f * q - -h, q = 1 / Math.sqrt(d * d + e * e + f * f), d *= q, e *= q, f *= q)
                        }
                        h = new ec;
                        h.x = d;
                        h.y = e;
                        h.z = f;
                        return h
                    };
                    var f = b.fovRemap = function (b, c, d) {
                        b = Math.tan(b / 360 * Ja);
                        c = a(c);
                        d = a(d);
                        return b = 360 * Math.atan(b * d / c) / Ja
                    };
                    b.screentosphere = function (a, c) {
                        var d = new ec,
                            e = b.inverseProject(a * E, c * E),
                            f, h = b.r_rmatrix;
                        f = h[0];
                        var q = h[1],
                            n = h[2],
                            g = h[4],
                            m = h[5],
                            r = h[6],
                            D = h[8],
                            G = h[9],
                            h = h[10],
                            v = 1 / (f * m * h + q * r * D + g * G * n - D * m * n - g * q * h - G * r * f);
                        f = xc([(m * h - G * r) * v, (-q * h + G * n) * v, (q * r - m * n) * v, 0, (-g * h + D * r) * v, (f * h - D * n) * v, (-f * r + g * n) * v, 0, (g * G - D * m) * v, (-f * G + D * q) * v, (f * m - g * q) * v, 0, 0, 0, 0, 1]);
                        gd(f, e);
                        e = e.to_euler_xyz();
                        e.x *= -1;
                        e.y += 90;
                        180 < e.y && (e.y -= 360);
                        d.x = e.y;
                        d.y = e.x;
                        d.z = 0;
                        return d
                    };
                    b.spheretoscreen = function (a, c) {
                        var d = new ec,
                            e = (180 - a) * ja,
                            f = c * ja;
                        d.x = 1E3 * Math.cos(f) * Math.cos(e);
                        d.z = 1E3 * Math.cos(f) * Math.sin(e);
                        d.y = 1E3 * Math.sin(f);
                        gd(b.r_rmatrix, d);
                        e = d.z;
                        10 <= e ? (e = b.r_zoom / e, d.x = (d.x * e + 0.5 * Fa) / E, d.y = (d.y * e + 0.5 * ma) / E) : (d.x = Od, d.y = Od);
                        return d
                    };
                    b.updateView = function () {
                        var a = b._fov,
                            c = b._hlookat,
                            d = b._vlookat,
                            e = b._camroll,
                            m = h.webgl ? b._fisheye : 0,
                            p = b._fisheyefovlink,
                            q = b._stereographic,
                            n = 0;
                        a < b.fovmin && (a = b.fovmin);
                        a > b.fovmax && (a = b.fovmax);
                        179 < a && (a = 179);
                        if (0 < m) {
                            var g = f(a, b._fovtype, "VFOV");
                            q ? (170 < a && (a = 170), n = 1E3 * m * Math.sin(0.5 * Math.pow(Math.min(g / 130, 1), 2 * p) * Ja), 1E3 < n && (n = 1E3)) : (m += Math.pow(Math.min(m, 1), 10) / 10, n = m * Math.sin(0.5 * Math.pow(g / 180, p) * Ja), n = 3E3 * n * n)
                        }
                        var r = 0,
                            t = 0,
                            D = 0,
                            p = Number(b.hlookatmin),
                            g = Number(b.hlookatmax),
                            G = Number(b.vlookatmin),
                            v = Number(b.vlookatmax);
                        isNaN(G) && (G = -90);
                        isNaN(v) && (v = 90);
                        isNaN(p) && (p = -180);
                        isNaN(g) && (g = 180);
                        if (v < G) var K = G,
                            G = v,
                            v = K;
                        g < p && (K = p, p = g, g = K);
                        var K = g - p,
                            u = v - G,
                            B = !1,
                            E = !0,
                            z = 180;
                        switch (w(b.limitview)) {
                            case "off":
                            case _[22]:
                                K = 360;
                                p = -180;
                                g = 180;
                                G = -1E5;
                                v = 1E5;
                                break;
                            case "auto":
                                K = 360, p = -180, g = 180, G = -90, v = 90;
                            case _[434]:
                                break;
                            case _[374]:
                            case _[333]:
                                E = !1;
                            case "range":
                                360 > K && (B = !0), D = f(a, b._fovtype, "HFOV"), D > K && (D = K, E && (a = f(D, "HFOV", b._fovtype))), r = f(a, b._fovtype, "VFOV"), r > u && (r = u, E && (a = f(r, "VFOV", b._fovtype))), z = r, t = r *= 0.5, D *= 0.5, -89.9 >= G && (r = 0), 89.9 <= v && (t = 0)
                        }
                        d - r < G ? (d = G + r, Ea.stopFrictions(2)) : d + t > v && (d = v - t, Ea.stopFrictions(2));
                        B && (D = -d * ja, t = 0.5 * Fa, r = 0.5 * ma, z = r / Math.tan(0.5 * z * ja), 0 < D && (r = -r), t = 1 / Math.sqrt(1 + (t * t + r * r) / (z * z)), r = r / z * t, z = Math.acos(-t * Math.sin(D) + r * Math.cos(D)) - Ja / 2, isNaN(z) && (z = -Ja / 2), t = Math.acos((t * Math.cos(D) + r * Math.sin(D)) / Math.sin(z + Ja / 2)), isNaN(t) && (t = 0), D = 180 * t / Ja, 2 * D >= K && (E && (D = f(K, "HFOV", b._fovtype), D < a && (a = D)), D = K / 2));
                        360 > K && (K = !1, c - D < p ? (c = p + D, K = !0) : c + D > g && (c = g - D, K = !0), K && (Ea.stopFrictions(1), 0 != la.currentmovingspeed && (la.currentmovingspeed = 0, la.speed *= -1)));
                        b._fov = a;
                        b._hlookat = c;
                        b._vlookat = d;
                        a = f(a, b._fovtype, "MFOV");
                        0 < m && !1 == q ? (g = f(a, "MFOV", "VFOV"), m = Math.asin(1E3 * Math.sin(0.5 * g * ja) / (1E3 + 0.72 * n)), m = 0.5 * ma / Math.tan(m)) : m = 0.5 * Dc / Math.tan(a / 114.591559);
                        b.hfov = f(a, "MFOV", "HFOV");
                        b.r_fov = a;
                        b.r_zoom = m;
                        b.r_zoff = n;
                        b.r_vlookat = d;
                        q = Number(b._architectural);
                        0 < q ? (!1 == b._architecturalonlymiddle && (p = Math.abs(d / 90), 1 < p && (p = 1), p = Math.tan(0.25 * p * Ja), q *= 1 - p), b.r_yoff = q * (-d * (ma / Math.tan(f(a, "MFOV", "VFOV") / 114.591559)) / 90), d *= 1 - q) : b.r_yoff = 0;
                        b.r_rmatrix = Md(c - 90, -d, e);
                        c = Math.floor(1E6 * c) / 1E6;
                        d = Math.floor(1E6 * d) / 1E6;
                        e = Math.floor(1E6 * e) / 1E6;
                        b.r_hlookat = c;
                        b.r_vlookatA = d;
                        b.r_roll = e;
                        Nd = _[253] + m + (!1 == h.realDesktop && h.ios && "5" > h.iosversion || h.androidstock || Cb ? "" : "px") + _[294] + -e + _[25] + (m - n / 2) + "px) ";
                        b.haschanged = !1
                    };
                    b.getState = function () {
                        return {
                            h: b._hlookat,
                            v: b.r_vlookatA,
                            z: b.r_zoom,
                            r: b._camroll,
                            zf: b.r_zoff,
                            yf: b.r_yoff,
                            ch: b._pannini ? 1 : 0
                        }
                    };
                    b.defaults()
                },
                Ze = function () {
                    var a = this;
                    a.defaults = function () {
                        a.usercontrol = "all";
                        a.mousetype = _[56];
                        a.touchtype = _[440];
                        a.mouseaccelerate = 1;
                        a.mousespeed = 10;
                        a.mousefriction = 0.8;
                        a.mouseyfriction = 1;
                        a.mousefovchange = 1;
                        a.keybaccelerate = 0.5;
                        a.keybspeed = 10;
                        a.keybfriction = 0.9;
                        a.keybfovchange = 0.75;
                        a.keybinvert = !1;
                        a.fovspeed = 3;
                        a.fovfriction = 0.9;
                        a.camrollreset = !0;
                        a.keycodesleft = "37";
                        a.keycodesright = "39";
                        a.keycodesup = "38";
                        a.keycodesdown = "40";
                        a.keycodesin = "";
                        a.keycodesout = "";
                        a.touchfriction = 0.87;
                        a.zoomtocursor = !1;
                        a.zoomoutcursor = !0;
                        a.disablewheel = !1
                    };
                    a.defaults()
                },
                $e = function () {
                    var a = this;
                    a.haschanged = !1;
                    a.mode = _[40];
                    a.pixelx = 0;
                    a.pixely = 0;
                    a.pixelwidth = 0;
                    a.pixelheight = 0;
                    Va(a, _[40], _[55]);
                    Va(a, "x", "0");
                    Va(a, "y", "0");
                    Va(a, _[39], "100%");
                    Va(a, _[37], "100%");
                    Va(a, "left", "0");
                    Va(a, "top", "0");
                    Va(a, _[2], "0");
                    Va(a, _[1], "0");
                    a.calc = function (b, c) {
                        var d = 1 / E,
                            e = _[57] == w(a.mode),
                            f = e ? a._left : a._x,
                            h = e ? a._top : a._y,
                            k = e ? a._right : a._width,
                            m = e ? a._bottom : a._height,
                            f = 0 < f.indexOf("%") ? parseFloat(f) / 100 * b * d : Number(f),
                            k = 0 < k.indexOf("%") ? parseFloat(k) / 100 * b * d : Number(k),
                            h = 0 < h.indexOf("%") ? parseFloat(h) / 100 * c * d : Number(h),
                            m = 0 < m.indexOf("%") ? parseFloat(m) / 100 * c * d : Number(m),
                            f = f / d,
                            h = h / d,
                            k = k / d,
                            m = m / d;
                        e ? (k = b - f - k, m = c - h - m) : (e = w(a._align), 0 <= e.indexOf("left") || (f = 0 <= e.indexOf(_[2]) ? b - k - f : (b - k) / 2 + f), 0 <= e.indexOf("top") || (h = 0 <= e.indexOf(_[1]) ? c - m - h : (c - m) / 2 + h));
                        a.pixelx = Math.round(f * d);
                        a.pixely = Math.round(h * d);
                        e = !1;
                        f = Math.round(k);
                        k = Math.round(m);
                        if (Fa != f || ma != k) e = !0, Fa = f, ma = k;
                        a.pixelwidth = f * d;
                        a.pixelheight = k * d;
                        a.haschanged = !1;
                        return e
                    }
                },
                tc = function () {
                    function a() {
                        var a = Number(g._alpha);
                        g.sprite && (_[10] == g._type && (a *= Ac), g.sprite.style.opacity = a);
                        g.autoalpha && (a = 0 < a, a != g._visible && (g.visible = a))
                    }
                    function b() {
                        if (g.sprite && null != g._zorder) {
                            var a = parseInt(g._zorder);
                            !isNaN(a) && 0 <= a ? (g.sprite.style.zIndex = G + a, g._zdeep = a, g._deepscale = 100 / (200 + a)) : (g._zdeep = 0, g._deepscale = 0.5)
                        }
                    }
                    function c() {
                        g.sprite && (g.sprite.style.overflow = g._maskchildren ? _[4] : _[53])
                    }
                    function d() {
                        if (g.sprite) {
                            var a = g._enabled;
                            D && (a = g.bgcapture);
                            g.sprite.style.cursor = a && g._handcursor ? _[33] : _[21];
                            g.sprite.style.pointerEvents = a ? "auto" : "none"
                        }
                    }
                    function e(a) {
                        var b = null;
                        if (a) {
                            var b = a = w(a),
                                c = Ba,
                                d = a.indexOf("[");
                            0 < d && (b = a.slice(0, d), _[10] == b && (c = Na), a = a.slice(d + 1, a.indexOf("]")));
                            if ("stage" == b) return null == fb.sprite && (fb.sprite = H.viewerlayer, fb.loaded = !0), fb;
                            if (_[408] == b) return null == gb.sprite && (a = V(), b = a.style, b.position = _[0], b.width = "100%", b.height = "100%", b.overflow = _[4], b.zIndex = "0", b.pointerEvents = "none", H.controllayer.parentNode.insertBefore(a, H.controllayer), gb.sprite = a, gb.loaded = !0), gb;
                            b = c.getItem(a)
                        }
                        return b
                    }
                    function f(a) {
                        if (g._parent != a) {
                            if (g._parent) {
                                var b = e(g._parent);
                                if (b) {
                                    var c = b._childs;
                                    if (c) {
                                        var d, h;
                                        h = c.length;
                                        for (d = 0; d < h; d++) if (c[d] === g) {
                                            c.splice(d, 1);
                                            h--;
                                            break
                                        }
                                        0 == h && (c = null);
                                        b._childs = c;
                                        b.poschanged = !0
                                    }
                                }
                            }
                            a && ((b = e(a)) ? b.sprite ? (null == b._childs && (b._childs = []), b._use_css_scale = !1, g._use_css_scale = !1, b._childs.push(g), b.sprite.appendChild(g.sprite), b.poschanged = !0) : setTimeout(function () {
                                g._parent = null;
                                f(a)
                            }, 16) : a = null);
                            null == a && H.pluginlayer.appendChild(g.sprite);
                            g._parent = a;
                            g.poschanged = !0
                        }
                    }
                    function j() {
                        var a = this.kobject;
                        a && !1 == J && (a = a.url, 0 < w(a).indexOf(".swf") ? ca(2, g._type + "[" + g.name + _[68] + Nb(a)) : ca(3, g._type + "[" + g.name + _[193] + a))
                    }
                    function k(a) {
                        if (C && (F(t, a.type, k, !0), _[3] == a.type ? (B.body.style.webkitUserSelect = B.body.style.backupUserSelect, F(t, _[7], s, !0), F(t, _[3], k, !0)) : (F(t, h.browser.events.touchmove, s, !0), F(t, h.browser.events.touchend, k, !0)), C.pressed)) {
                            C.pressed = !1;
                            if (C._ondowncrop || C._onovercrop) C.hovering && C._onovercrop ? n(C, C._onovercrop) : n(C, C._crop);
                            S.callaction(C.onup, C);
                            O || S.blocked || S.callaction(C.onclick, C)
                        }
                    }
                    function s(a, b) {
                        var c = a.changedTouches && 0 < a.changedTouches.length ? a.changedTouches[0] : a,
                            d = c.pageX,
                            c = c.pageY;
                        !0 === b ? A = [d, c] : A ? (d -= A[0], c -= A[1], 4 < d * d + c * c && (O = !0)) : (A = null, F(t, a.type, s, !0))
                    }
                    function l(a, b) {
                        var c = a.timeStamp | 0,
                            d = !0;
                        switch (a.type) {
                            case _[11]:
                            case _[12]:
                                if (!0 == b && (c = _[18] == C.type, (C._enabled && !c || c && C.bgcapture) && C._handcursor)) g.sprite.style.cursor = _[33];
                                c = C.sprite;
                                for (d = 0; c;) {
                                    var e = c.kobject;
                                    if (e) {
                                        if (!1 == e._enabled || 0 < d && !1 == e.children) return;
                                        d++;
                                        c = c.parentNode
                                    } else break
                                }
                                for (d = C.sprite; d;) {
                                    if (e = d.kobject) !1 == e.hovering && (e.hovering = !0, !1 == e.pressed && e._onovercrop && n(e, e._onovercrop), S.blocked || S.callaction(e.onover, e));
                                    else break;
                                    d = d.parentNode
                                }
                                break;
                            case _[6]:
                            case _[8]:
                                for (c = (d = a.relatedTarget) ? d.kobject : null; d && null == c;) if (d = d.parentNode) c = d.kobject;
                                else break;
                                for (d = C.sprite; d;) {
                                    if (e = d.kobject) {
                                        for (var f = !1, j = c; j;) {
                                            if (e == j) {
                                                f = !0;
                                                break
                                            }
                                            if (j.sprite && j.sprite.parentNode) j = j.sprite.parentNode.kobject;
                                            else break
                                        }
                                        if (!1 == f) !0 == e.hovering && (e.hovering = !1, !1 == e.pressed && e._onovercrop && n(e, e._crop), S.callaction(e.onout, e));
                                        else break
                                    } else break;
                                    d = d.parentNode
                                }
                                break;
                            case _[5]:
                                if (500 < c && 500 > c - Bb) {
                                    Bb = 0;
                                    break
                                }
                                if (d = 0 == (a.button | 0)) B.body.style.backupUserSelect = B.body.style.webkitUserSelect, B.body.style.webkitUserSelect = "none", s(a, !0), z(t, _[3], k, !0), z(t, _[7], s, !0), O = !1, C.pressed = !0, C._ondowncrop && n(C, C._ondowncrop), S.blocked || S.callaction(C.ondown, C);
                                break;
                            case h.browser.events.touchstart:
                                if (Bb = c, O = !1, d = 0 == (a.button | 0)) s(a, !0), z(t, h.browser.events.touchend, k, !0), z(t, h.browser.events.touchmove, s, !0), C.pressed = !0, C._ondowncrop && n(C, C._ondowncrop), S.blocked || S.callaction(C.ondown, C)
                        }
                    }
                    function r(a, b) {
                        if (a === b) return !1;
                        for (; b && b !== a;) b = b.parentNode;
                        return b === a
                    }
                    function p(a) {
                        Pa = fa();
                        var b = a.type;
                        if (!(_[5] == b || b == h.browser.events.touchstart) || !S.isblocked()) {
                            var c = a.target.kobject;
                            null == c && (c = g);
                            if (!((_[11] == b || _[6] == b) && 4 != a.pointerType) && c) {
                                var c = a.timeStamp,
                                    e = g._eP;
                                c != g._eT && (e = 0);
                                if (_[12] == b || _[11] == b) {
                                    var f = a.relatedTarget;
                                    if (this === f || r(this, f)) return
                                } else if (_[8] == b || _[6] == b) if (f = a.relatedTarget, this === f || r(this, f)) return;
                                0 == c && (_[12] == b && !1 == g.hovering ? e = 0 : _[8] == b && !0 == g.hovering && (e = 0));
                                if (g._enabled && !D || D && g.bgcapture) {
                                    if (!1 == g.children && a.stopPropagation(), 0 == e && (!1 == g.children && 1 == a.eventPhase || 2 <= a.eventPhase)) e = 1, g.jsplugin && g.jsplugin.hittest && (b = H.getMousePos(a.changedTouches ? a.changedTouches[0] : a, g.sprite), g.jsplugin.hittest(b.x * g.imagewidth / g.pixelwidth, b.y * g.imageheight / g.pixelheight) || (e = 2)), 1 == e && (C = g, l(a), g.capture && (null == g.jsplugin && sa(a), a.stopPropagation()))
                                } else if (!1 == h.pointerEvents && (B.msElementsFromPoint && 0 == e && 2 == a.eventPhase) && (f = a.type, _[5] == f || _[3] == f || _[12] == f || _[8] == f || _[11] == f || _[6] == f || f == h.browser.events.touchstart || f == h.browser.events.touchend)) if (b = B.msElementsFromPoint(a.clientX, a.clientY)) {
                                    (_[8] == f || _[6] == f) && d();
                                    for (f = 0; f < b.length; f++) {
                                        var j = b[f].kobject ? b[f].kobject : null;
                                        if (j) {
                                            var k = _[18] == j.type;
                                            if (!0 == (j._enabled && !k || k && j.bgcapture)) if (e = 1, C = j, l(a, !0), j.capture) {
                                                null == g.jsplugin && sa(a);
                                                a.stopPropagation();
                                                break
                                            }
                                        } else break
                                    }
                                }
                                g._eT = c;
                                g._eP = e
                            }
                        }
                    }
                    function q() {
                        if (g.sprite) {
                            var a = Number(g._bgcolor),
                                b = Number(g._bgalpha);
                            isNaN(a) && (a = 0);
                            isNaN(b) && (b = 0);
                            0 == b ? g.sprite.style.background = "none" : g.sprite.style.backgroundColor = ia(a, b)
                        }
                    }
                    function n(a, b) {
                        var c = 0,
                            d = 0,
                            e = a.loader;
                        e && (c = e.naturalWidth, d = e.naturalHeight);
                        b && (b = String(b).split("|"), 4 == b.length && (c = b[2], d = b[3]));
                        null == a.jsplugin && !1 == a._isNE() && (a.imagewidth = c, a.imageheight = d, e = a._gOSF(), e & 1 && (a._width = String(c)), e & 2 && (a._height = String(d)));
                        a.updatepos()
                    }
                    var g = this;
                    g.prototype = Qb;
                    this.prototype.call(this);
                    g._type = _[36];
                    g.layer = g.plugin = new Wa(tc);
                    g.createvar = function (a, b, c) {
                        var d = "_" + a;
                        g[d] = void 0 === b ? null : b;
                        g.__defineGetter__(a, function () {
                            return g[d]
                        });
                        void 0 !== c ? g.__defineSetter__(a, function (a) {
                            g[d] = a;
                            c()
                        }) : g.__defineSetter__(a, function (a) {
                            g[d] = a;
                            g.poschanged = !0
                        })
                    };
                    var O = !1,
                        J = !1,
                        D = !1,
                        G = 0,
                        v = 3,
                        K = !1;
                    g._isNE = function () {
                        return J
                    };
                    g._gOSF = function () {
                        return v
                    };
                    g.sprite = null;
                    g.loader = null;
                    g.jsplugin = null;
                    g._use_css_scale = !1;
                    g._finalxscale = 1;
                    g._finalyscale = 1;
                    g._eT = 0;
                    g._eP = 0;
                    g._pCD = !1;
                    g.__defineGetter__("type", function () {
                        return _[44] == g.url ? _[18] : _[41]
                    });
                    g.__defineSetter__("type", function (a) {
                        _[18] == w(a) && (g.url = _[44])
                    });
                    g.imagewidth = 0;
                    g.imageheight = 0;
                    g.pixelwidth = 0;
                    g.pixelheight = 0;
                    g.pressed = !1;
                    g.hovering = !1;
                    g.loading = !1;
                    g.loaded = !1;
                    g.loadedurl = null;
                    g.loadingurl = null;
                    g.preload = !1;
                    g.keep = !1;
                    g.poschanged = !1;
                    g.style = null;
                    g.capture = !0;
                    g.children = !0;
                    g.autoalpha = !1;
                    g._deepscale = 0.5;
                    g._zdeep = 0;
                    g.accuracy = 0;
                    g._dyn = !1;
                    g.onloaded = null;
                    g.altonloaded = null;
                    var R = g.createvar,
                        N = function (a, b) {
                            var c = "_" + a;
                            g[c] = null;
                            g.__defineGetter__(a, function () {
                                return g[c]
                            });
                            g.__defineSetter__(a, b)
                        };
                    R(_[390], !0, d);
                    R(_[295], !0, d);
                    R(_[250], !1, c);
                    R(_[358], null, function () {
                        var a = g._jsborder;
                        0 >= parseInt(a) && (g._jsborder = a = null);
                        g.sprite && (g.sprite.style.border = a);
                        null != a && (g._use_css_scale = !1)
                    });
                    R(_[444], null, function () {
                        if (null != g.sprite) {
                            var a = g._alturl;
                            g._alturl = null;
                            g.url = a
                        }
                    });
                    R("url", null, function () {
                        if ("" == g._url || "null" == g._url) g._url = null;
                        null != g._url ? g.reloadurl() : (g.jsplugin && g.jsplugin.unloadplugin && g.jsplugin.unloadplugin(), g.jsplugin = null, g.loadedurl = null, g.loadingurl = null, g.loading = !1, g.loaded = !1)
                    });
                    R("scale", 1);
                    R(_[243], !1, function () {
                        K = !0
                    });
                    R(_[113], 0);
                    R("alpha", 1, a);
                    R(_[438], null, b);
                    R(_[53], !0, function () {
                        g.sprite && (!1 == g._visible ? g.sprite.style.display = "none" : g.poschanged = !0)
                    });
                    R("crop", null, function () {
                        n(g, g._crop)
                    });
                    g._childs = null;
                    g._parent = null;
                    g.__defineGetter__(_[110], function () {
                        return g._parent
                    });
                    g.__defineSetter__(_[110], function (a) {
                        if (null == a || "" == a || "null" == w(a)) a = null;
                        g.sprite ? f(a) : g._parent = a
                    });
                    for (var M = [_[40], "edge", _[299], _[300]], P = 0; P < M.length; P++) R(M[P]);
                    N(_[39], function (a) {
                        0 == 0 * parseFloat(a) ? v &= 2 : a && "prop" == a.toLowerCase() ? (a = "prop", v &= 2) : (a = null, v |= 1);
                        g._width = a;
                        g.poschanged = !0
                    });
                    N(_[37], function (a) {
                        0 == 0 * parseFloat(a) ? v &= 1 : a && "prop" == a.toLowerCase() ? (a = "prop", v &= 1) : (a = null, v |= 2);
                        g._height = a;
                        g.poschanged = !0
                    });
                    N("x", function (a) {
                        0 != 0 * parseFloat(a) && (a = null);
                        g._x = a;
                        g.poschanged = !0
                    });
                    N("y", function (a) {
                        0 != 0 * parseFloat(a) && (a = null);
                        g._y = a;
                        g.poschanged = !0
                    });
                    N("ox", function (a) {
                        0 != 0 * parseFloat(a) && (a = null);
                        g._ox = a;
                        g.poschanged = !0
                    });
                    N("oy", function (a) {
                        0 != 0 * parseFloat(a) && (a = null);
                        g._oy = a;
                        g.poschanged = !0
                    });
                    g.loadstyle = function (a) {
                        null == a && (a = g.style);
                        if (a) {
                            g.style = a;
                            a = a.split("|");
                            var b, c;
                            c = a.length;
                            for (b = 0; b < c; b++) {
                                var d = Q(_[426] + a[b] + "]");
                                if (d) for (var e in d) {
                                    var f = w(e);
                                    if ("name" != f && "index" != f && "_type" != f) {
                                        var h = d[e];
                                        _[9] !== typeof h && (g[f] = _[54] == typeof g[f] ? Ma(h) : h)
                                    }
                                }
                            }
                        }
                    };
                    g.getmouse = function (a) {
                        var b = 0,
                            c = 0;
                        if (_[31] != typeof WebKitPoint) c = new WebKitPoint, c.x = u.x, c.y = u.y, c = t.webkitConvertPointFromNodeToPage(H.controllayer, c), c = t.webkitConvertPointFromPageToNode(g.sprite, c), b = c.x, c = c.y;
                        else var c = H.controllayer,
                            d = g.sprite,
                            e = c.getBoundingClientRect(),
                            f = d.getBoundingClientRect(),
                            b = u.x - f.left - d.clientLeft + e.left + c.clientLeft,
                            c = u.y - f.top - d.clientTop + e.top + c.clientTop;
                        a && (b = b * g.imagewidth / g.pixelwidth, c = c * g.imageheight / g.pixelheight);
                        return {
                            x: b,
                            y: c
                        }
                    };
                    g.create = function () {
                        g._pCD = !0;
                        g.alturl && (g.url = g.alturl, g._alturl = null);
                        g.altscale && (g.scale = g.altscale, delete g.altscale);
                        var e = g.sprite = V(),
                            k = g.loader = V(1);
                        e.kobject = g;
                        k.kobject = g;
                        e.style.display = "none";
                        e.style.position = _[0];
                        G = _[36] == g._type ? 3001 : 2001;
                        e.style.zIndex = G;
                        c();
                        d();
                        a();
                        b();
                        g._jsborder && (g.jsborder = g._jsborder);
                        Ea.touch && (z(e, h.browser.events.touchstart, p, !0), z(e, h.browser.events.touchstart, p, !1));
                        Ea.mouse && (z(e, _[5], p, !0), z(e, _[5], p, !1));
                        if (h.desktop && (Ea.mouse || h.ie)) !1 == Ea.mouse && h.ie ? (z(e, _[11], p, !0), z(e, _[11], p, !1), z(e, _[6], p, !0), z(e, _[6], p, !1)) : (z(e, _[12], p, !0), z(e, _[12], p, !1), z(e, _[8], p, !0), z(e, _[8], p, !1));
                        z(k, _[23], j, !0);
                        z(k, "load", g.loadurl_done, !1);
                        if (e = g._parent) g._parent = null, f(e);
                        null != g._url && g.reloadurl()
                    };
                    g.destroy = function () {
                        g.jsplugin && g.jsplugin.unloadplugin && g.jsplugin.unloadplugin();
                        g.jsplugin = null;
                        g.loaded = !1;
                        g._destroyed = !0;
                        g.parent = null;
                        var a = g._childs;
                        if (a) {
                            var b, c, a = a.slice();
                            c = a.length;
                            for (b = 0; b < c; b++) a[b].parent = null;
                            g._childs = null
                        }
                    };
                    g.getfullpath = function () {
                        return g._type + "[" + g.name + "]"
                    };
                    g.changeorigin = function () {
                        var a = arguments,
                            b = null,
                            c = null;
                        if (0 < a.length) {
                            var d = null,
                                f = 0,
                                h = 0,
                                j = 0,
                                k = 0,
                                l = E,
                                n = Fa / l,
                                m = ma / l,
                                p = g._parent;
                            if (p && (p = e(p))) !1 == g._use_css_scale ? (n = p.pixelwidth * l, m = p.pixelheight * l) : (n = p.imagewidth * l, m = p.imageheight * l);
                            l = g.imagewidth;
                            p = g.imageheight;
                            b = 0;
                            d = String(g._width);
                            "" != d && null != d && (0 < d.indexOf("%") ? l = parseFloat(d) / 100 * n : "prop" == d.toLowerCase() ? b = 1 : l = d);
                            d = String(g._height);
                            "" != d && null != d && (0 < d.indexOf("%") ? p = parseFloat(d) / 100 * m : "prop" == d.toLowerCase() ? b = 2 : p = d);
                            1 == b ? l = p * g.imagewidth / g.imageheight : 2 == b && (p = l * g.imageheight / g.imagewidth);
                            b = c = w(a[0]);
                            1 < a.length && (c = w(a[1]));
                            var a = String(g._align),
                                q = g._edge ? w(g._edge) : "null";
                            if ("null" == q || _[425] == q) q = a;
                            (d = String(g._x)) && (f = 0 < d.indexOf("%") ? parseFloat(d) / 100 * n : parseFloat(d));
                            isNaN(f) && (f = 0);
                            (d = String(g._y)) && (h = 0 < d.indexOf("%") ? parseFloat(d) / 100 * m : parseFloat(d));
                            isNaN(h) && (h = 0);
                            if (d = a) j = 0 <= d.indexOf("left") ? 0 + f : 0 <= d.indexOf(_[2]) ? n - f : n / 2 + f, k = 0 <= d.indexOf("top") ? 0 + h : 0 <= d.indexOf(_[1]) ? m - h : m / 2 + h;
                            1 != g._scale && (l *= g._scale, p *= g._scale);
                            j = 0 <= q.indexOf("left") ? j + 0 : 0 <= q.indexOf(_[2]) ? j + -l : j + -l / 2;
                            k = 0 <= q.indexOf("top") ? k + 0 : 0 <= q.indexOf(_[1]) ? k + -p : k + -p / 2;
                            d = a = 0;
                            a = 0 <= b.indexOf("left") ? 0 + f : 0 <= b.indexOf(_[2]) ? n - f : n / 2 + f;
                            d = 0 <= b.indexOf("top") ? 0 + h : 0 <= b.indexOf(_[1]) ? m - h : m / 2 + h;
                            a = 0 <= c.indexOf("left") ? a + 0 : 0 <= c.indexOf(_[2]) ? a + -l : a + -l / 2;
                            d = 0 <= c.indexOf("top") ? d + 0 : 0 <= c.indexOf(_[1]) ? d + -p : d + -p / 2;
                            g._align = b;
                            g._edge = c;
                            g._x = 0 <= b.indexOf(_[2]) ? String(f + a - j) : String(f - a + j);
                            g._y = 0 <= b.indexOf(_[1]) ? String(h + d - k) : String(h - d + k)
                        }
                    };
                    g.resetsize = function () {
                        g.loaded && (g._width = String(g.imagewidth), g._height = String(g.imageheight), v = 3, g.poschanged = !0)
                    };
                    g.registercontentsize = function (a, b) {
                        null != a && (g.imagewidth = Number(a), v & 1 && (g._width = String(a)));
                        null != b && (g.imageheight = Number(b), v & 2 && (g._height = String(b)));
                        g.poschanged = !0
                    };
                    var A = null,
                        C = null;
                    g.reloadurl = function () {
                        if (g.sprite) {
                            var a = ya.parsePath(g.url);
                            if (g.loading) {
                                if (g.loadingurl == a) return;
                                g.loader.kobject = null;
                                F(g.loader, _[23], j, !0);
                                F(g.loader, "load", g.loadurl_done, !1);
                                g.loader.src = null;
                                g.loader = V(1);
                                g.loader.kobject = g;
                                z(g.loader, _[23], j, !0);
                                z(g.loader, "load", g.loadurl_done, !1)
                            }
                            if (g.loadedurl != a) if (J = !1, g.loadedurl = null, _[44] == a) D = J = !0, g.loader.src = null, g.loadedurl = a, g.createvar(_[400], g.bgcolor ? Number(g.bgcolor) : 0, q), g.createvar(_[403], g.bgalpha ? Number(g.bgalpha) : 0, q), g.createvar(_[332], Ma(g.bgcapture), d), d(), q(), g.jsplugin = {
                                onresize: function (a, b) {
                                    g.imagewidth = a / g.scale;
                                    g.imageheight = b / g.scale;
                                    return !1
                                }
                            }, g.loadurl_done();
                            else if (0 <= a.indexOf(_[244])) {
                                J = !0;
                                g.loader.src = null;
                                g.loadedurl = a;
                                var b = new af;
                                b.registerplugin(m, g.getfullpath(), g);
                                g.jsplugin = b;
                                !1 == g._dyn ? (b.updatehtml(), g.loadurl_done()) : setTimeout(function () {
                                    b.updatehtml();
                                    g.loadurl_done()
                                }, 7)
                            } else 0 <= a.indexOf(".js") ? (J = !0, g.loader.src = null, ya.loadfile2(a, _[220], function (b) {
                                g.loadedurl = a;
                                b = b.data;
                                if (null != b) {
                                    var c = 'the file "' + a + '" is not a krpano plugin!';
                                    try {
                                        eval(b + ";")
                                    } catch (d) {
                                        c = 'parsing "' + a + '" failed! '
                                    }
                                    _[9] == typeof krpanoplugin ? (b = new krpanoplugin, b.registerplugin(m, g.getfullpath(), g), g._nativeelement = !0, g.jsplugin = b, g.loadurl_done()) : ca(3, c)
                                }
                            })) : w(a).indexOf(".swf") == a.length - 4 ? ca(2, g._type + "[" + g.name + _[68] + Nb(a)) : g.loader.src != a && (g.loaded && g.preload && (g.preload = !1, g.onloaded = null), g.loading = !0, g.loaded = !1, g.loadingurl = a, g.loader.src = a)
                        }
                    };
                    g.loadurl_done = function () {
                        if (!0 != g._destroyed) {
                            !1 == J && (g.sprite.style.backgroundImage = 'url("' + g.loader.src + '")');
                            n(g, g._crop);
                            g.loading = !1;
                            K = g.loaded = !0;
                            !1 == J && (g.loadedurl = g.loadingurl);
                            g.poschanged = !0;
                            !1 == (h.iphone && h.retina) && (null == g.jsborder && !1 == J && null == g.parent && null == g._childs) && (g._use_css_scale = !0);
                            if (!1 == h.realDesktop && "5" > h.iosversion && (1 == (g.imagewidth & 1) || 1 == (g.imageheight & 1))) g._use_css_scale = !1;
                            g._busyonloaded = S.busy || S.blocked;
                            g._busyonloaded && S.callaction(_[152], g, !0);
                            S.callaction(null != g.altonloaded ? g.altonloaded : g.onloaded, g, !0)
                        }
                    };
                    var y = null;
                    g.updatepluginpos = g.updatepos = function () {
                        var a = _[10] == g._type;
                        g.poschanged = !1;
                        var b = g.sprite,
                            c = g.loader;
                        if (b && (c || !1 != J)) {
                            var d = g._align,
                                f = g._scale;
                            d || (d = _[55]);
                            var j = g._use_css_scale,
                                k = g.imagewidth,
                                l = g.imageheight,
                                n = !1,
                                m = g._crop;
                            g.pressed && g._ondowncrop ? m = g._ondowncrop : g.hovering && g._onovercrop && (m = g._onovercrop);
                            m && (m = String(m).split("|"), 4 == m.length ? (m[0] |= 0, m[1] |= 0, m[2] |= 0, m[3] |= 0) : m = null);
                            var p = g.scale9grid;
                            p && (p = String(p).split("|"), 4 <= p.length ? (p[0] |= 0, p[1] |= 0, p[2] |= 0, p[3] |= 0, j = g._use_css_scale = !1, g._scalechildren = !1) : p = null);
                            var q = E,
                                s = Fa,
                                r = ma;
                            a && g.distorted && (q = 1, s = r = 1E3);
                            var D = 1,
                                v = 1,
                                t = g._parent,
                                G = !0;
                            if (t) {
                                var x = e(t);
                                x ? (x.poschanged && x.updatepos(), !1 == j ? (s = x.pixelwidth * q, r = x.pixelheight * q) : (s = x.imagewidth * q, r = x.imageheight * q), x._scalechildren ? (D = s / q / x.imagewidth, v = r / q / x.imageheight) : (D *= x._finalxscale, v *= x._finalyscale), !1 == x.loaded && (G = !1, b.style.display = "none")) : ca(3, 'no parent "' + t + '" found')
                            }
                            var w = g._width,
                                u = g._height,
                                A = g._x,
                                C = g._y,
                                t = g._ox,
                                B = g._oy;
                            w && 0 < String(w).indexOf("%") ? w = parseFloat(w) * (s / q) / (100 * D) : null == w && (w = k);
                            u && 0 < String(u).indexOf("%") ? u = parseFloat(u) * (r / q) / (100 * v) : null == u && (u = l);
                            "prop" == w && (w = Number(u) * k / l);
                            "prop" == u && (u = Number(w) * l / k);
                            w = Number(w) * q * f * D;
                            u = Number(u) * q * f * v;
                            0 > w && (w = s + w);
                            0 > u && (u = r + u);
                            A && 0 < String(A).indexOf("%") ? A = parseFloat(A) * (s / q) / (100 * D) : null == A && (A = 0);
                            C && 0 < String(C).indexOf("%") ? C = parseFloat(C) * (r / q) / (100 * v) : null == C && (C = 0);
                            A = Number(A) * q * D;
                            C = Number(C) * q * v;
                            t && 0 < String(t).indexOf("%") ? t = parseFloat(t) * w / 100 : null == t && (t = 0);
                            B && 0 < String(B).indexOf("%") ? B = parseFloat(B) * u / 100 : null == B && (B = 0);
                            t = Number(t) * q;
                            B = Number(B) * q;
                            0 == g.accuracy && (w = Math.round(w), u = Math.round(u));
                            var f = w / k,
                                O = u / l,
                                z = w / q,
                                q = u / q;
                            if (z != g.pixelwidth || q != g.pixelheight) g.pixelwidth = z, g.pixelheight = q, n = !0;
                            this._scalechildren ? (g._finalxscale = f, g._finalyscale = O) : (g._finalxscale = D, g._finalyscale = v);
                            j ? (b.style.width = k + "px", b.style.height = l + "px") : (b.style.width = w + "px", b.style.height = u + "px");
                            if (p) {
                                var v = p,
                                    q = w,
                                    R = u,
                                    H = m,
                                    m = g.sprite,
                                    z = g.loader,
                                    N, F = E;
                                5 == v.length && (F *= Number(v[4]));
                                c = z.naturalWidth;
                                k = z.naturalHeight;
                                null == H && (H = [0, 0, c, k]);
                                if (null == y) {
                                    y = Array(9);
                                    for (l = 0; 9 > l; l++) p = V(), p.kobject = g, p.style.position = _[0], p.style.overflow = _[4], y[l] = p, m.appendChild(p)
                                }
                                var l = [H[0] + 0, H[0] + v[0], H[0] + v[0] + v[2], H[0] + H[2]],
                                    p = [H[1] + 0, H[1] + v[1], H[1] + v[1] + v[3], H[1] + H[3]],
                                    D = [v[0], v[2], H[2] - v[0] - v[2]],
                                    v = [v[1], v[3], H[3] - v[1] - v[3]],
                                    q = [D[0] * F | 0, q - ((D[0] + D[2]) * F | 0), D[2] * F | 0],
                                    R = [v[0] * F | 0, R - ((v[0] + v[2]) * F | 0), v[2] * F | 0],
                                    F = [0, q[0], q[0] + q[1]],
                                    H = [0, R[0], R[0] + R[1]],
                                    Q = 'url("' + z.src + '")';
                                for (N = 0; 3 > N; N++) for (z = 0; 3 > z; z++) {
                                    var M = y[3 * N + z].style,
                                        P = q[z] / D[z],
                                        S = R[N] / v[N];
                                    M.backgroundImage = Q;
                                    M[od] = c * P + "px " + k * S + "px";
                                    M.backgroundPosition = -l[z] * P + "px " + -p[N] * S + "px";
                                    M.left = F[z] + "px";
                                    M.top = H[N] + "px";
                                    M.width = q[z] + "px";
                                    M.height = R[N] + "px"
                                }
                                m.style.background = "none"
                            } else {
                                if (y) {
                                    try {
                                        for (k = 0; 9 > k; k++) y[k].kobject = null, b.removeChild(y[k])
                                    } catch (U) { }
                                    y = null;
                                    g.sprite && g.loader && (g.sprite.style.backgroundImage = 'url("' + g.loader.src + '")')
                                }
                                m ? (k = -m[0], m = -m[1], j || (k *= f, m *= O), b.style.backgroundPosition = k + "px " + m + "px") : b.style.backgroundPosition = "0 0";
                                c && (b.style[od] = !1 == j ? c.naturalWidth * f + "px " + c.naturalHeight * O + "px" : c.naturalWidth + "px " + c.naturalHeight + "px")
                            }
                            if (g.jsplugin && g.jsplugin.onresize && (g.pixelwidth != g.imagewidth || g.pixelheight != g.imageheight)) m = [g.imagewidth, g.imageheight], g.imagewidth = g.pixelwidth, g.imageheight = g.pixelheight, !0 === g.jsplugin.onresize(g.pixelwidth, g.pixelheight) && (g.imagewidth = m[0], g.imageheight = m[1]);
                            g._oxpix = t;
                            g._oypix = B;
                            l = "";
                            c = m = 0;
                            if (!1 == a) {
                                m = g._edge;
                                if (null == m || "" == m) m = d;
                                a = k = 0;
                                k = 0 <= m.indexOf("left") ? k + 0 : 0 <= m.indexOf(_[2]) ? k + -w : k + -w / 2;
                                a = 0 <= m.indexOf("top") ? a + 0 : 0 <= m.indexOf(_[1]) ? a + -u : a + -u / 2;
                                m = 0 <= d.indexOf("left") ? A + k : 0 <= d.indexOf(_[2]) ? s - A + k : s / 2 + A + k;
                                c = 0 <= d.indexOf("top") ? C + a : 0 <= d.indexOf(_[1]) ? r - C + a : r / 2 + C + a;
                                g._finalx = m;
                                g._finaly = c;
                                j && (s = d = 1, r = g.imagewidth / 2, A = g.imageheight / 2, l = C = 0, x && !1 == x._scalechildren && (d /= x.pixelwidth / x.imagewidth, s /= x.pixelheight / x.imageheight, C = -k * (1 - d), l = -a * (1 - s)), l = _[47] + (-r + C) + "px," + (-A + l) + _[302] + f * d + "," + O * s + _[263] + r + "px," + A + "px) ");
                                0 == g.accuracy && (m = Math.round(m), c = Math.round(c));
                                x = w / 2 + k;
                                u = u / 2 + a;
                                j && (x /= f, u /= O, t /= f, B /= O);
                                l = _[47] + m + "px," + c + "px) " + l + _[47] + -x + "px," + -u + _[279] + g._rotate + _[219] + (x + t) + "px," + (u + B) + "px)";
                                2 > Ga && !0 !== h.opera ? l = _[146] + l : h.androidstock && (l = _[175] + l);
                                va ? b.style[va] = l : (b.style.left = m + "px", b.style.top = c + "px");
                                j = g._visible && G ? "" : "none";
                                j != b.style.display && (b.style.display = j)
                            }
                            if (n || K) {
                                if (b = g._childs) {
                                    n = b.length;
                                    for (k = 0; k < n; k++) b[k].updatepos()
                                }
                                K = !1
                            }
                        }
                    }
                },
                af = function () {
                    function a(a) {
                        a && 0 == a.indexOf("data:") && ((a = Q("data[" + a.slice(5) + _[32])) || (a = ""));
                        return a
                    }
                    function b(a) {
                        if (a && a.parentNode) try {
                            a.parentNode.removeChild(a)
                        } catch (b) { }
                    }
                    function c(a) {
                        a && (a.style.left = _[98], H.viewerlayer.appendChild(a))
                    }
                    function d() {
                        if (f) {
                            var b = f.html,
                                d = f.css,
                                b = b ? a(b) : "",
                                d = d ? a(d) : "";
                            h = "none" != f._autosize;
                            var l = parseFloat(f.roundedge);
                            isNaN(l) && (l = 0);
                            var u = Ma(f.border),
                                B = parseFloat(f.borderwidth);
                            isNaN(B) && (B = 1);
                            var z = f.bordercolor,
                                z = z ? parseInt(z) : 0,
                                J = parseFloat(f.borderalpha);
                            isNaN(J) && (J = 1);
                            var N = Ma(f.background),
                                A = parseInt(f.backgroundcolor),
                                C = parseFloat(f.backgroundalpha);
                            isNaN(C) && (C = 1);
                            var y = Number(f.shadow);
                            isNaN(y) && (y = 0);
                            var I = Number(f.textshadow);
                            isNaN(I) && (I = 0);
                            b = Lb(b);
                            if (1 != E) {
                                var L = d.indexOf(_[88]);
                                if (0 <= L) {
                                    var F = parseInt(d.slice(L + 10));
                                    0 < F && (F *= E, d = d.slice(0, L + 10) + F + "px" + d.slice(d.indexOf(";", L)))
                                }
                                for (L = 0; ;) if (L = b.indexOf(_[88], L), 0 <= L) {
                                    var M = b.indexOf("px", L);
                                    0 < M && (F = parseInt(b.slice(L + 10)), 0 < F && (F *= E, b = b.slice(0, L + 10) + F + b.slice(M)));
                                    L += 1
                                } else break
                            }
                            L = d.split("}").join("{").split("{");
                            if (1 < L.length) {
                                M = [];
                                for (d = 1; d < L.length; d += 2) {
                                    var F = X(L[d - 1]),
                                        Q = L[d],
                                        P = "p" == w(F) ? "div" : F,
                                        b = b.split("<" + F).join("<" + P + _[359] + Q + "' "),
                                        b = b.split("</" + F + ">").join("</" + P + ">");
                                    M.push(L[d])
                                }
                                d = ""
                            }
                            b = 1 <= E ? !0 == f.vcenter && !1 == h ? _[135] + b + _[14] : _[137] + b + _[14] : !0 == f.vcenter && !1 == h ? _[133] + b + _[14] : _[149] + b + _[14];
                            !0 == f.vcenter && (b = _[119] + b + _[187]);
                            b = b.split("<p").join(_[151] + 2.5 * E + _[182] + 5 * E + "px;' ");
                            b = b.split("</p>").join(_[14]);
                            L = _[183];
                            !1 == h && (L += _[265]);
                            M = 0.8;
                            1 == Gc && (M = 0.78);
                            M *= E;
                            0 < y && (y *= E, F = f.shadowangle * Ja / 180, L += Hc + ":" + Math.round(y * Math.cos(F)) + "px " + Math.round(y * Math.sin(F)) + "px " + M * f.shadowrange + "px " + ia(f.shadowcolor, C * f.shadowalpha) + ";");
                            0 < I && (I *= E, F = f.textshadowangle * Ja / 180, L += _[266] + Math.round(I * Math.cos(F)) + "px " + Math.round(I * Math.sin(F)) + "px " + M * f.textshadowrange + "px " + ia(f.textshadowcolor, C * f.textshadowalpha) + ";");
                            t = 1;
                            u && 0 < B ? (t = B * E, L += _[387] + B * E + _[13] + ia(z, C * J) + ";") : t = B = 0;
                            0 < l && (L += _[230] + 0.5 * E * (l + B) + "px;");
                            N && (L += _[191] + ia(A, C) + ";");
                            L += _[422] + f.imagewidth * E + _[181];
                            L += d;
                            b = unescape(b);
                            l = b.split(_[115]);
                            if (1 < l.length) {
                                for (d = 1; d < l.length; d++) l[d - 1].lastIndexOf("href") > l[d - 1].length - 10 ? (b = l[d].indexOf('"'), 0 < b && (u = l[d].slice(0, b), u = u.split("<").join("[").split(">").join("]"), l[d] = _[139] + H.viewerlayer.id + _[342] + u + "');" + l[d].slice(b))) : l[d] = _[115] + l[d];
                                b = l.join("")
                            }
                            b = '<div style="' + L + '">' + b + _[14];
                            f.sprite.style.color = _[20];
                            f.sprite.style[_[42]] = "none";
                            n && n.parentNode == f.sprite && (q = n, n = null);
                            null == n && (n = V(), g = n.style, g.position = _[0], g.left = g.top = -t + "px", g.width = f.imagewidth * E + 2 * t + "px", g.height = "100%", g.fontSize = 12 * E + "px", g.fontFamily = "Times");
                            n.innerHTML = b;
                            c(n);
                            k = !1;
                            f.loaded = !0;
                            f.scalechildren = f.scalechildren;
                            r = 0;
                            null == m && (m = setTimeout(e, p))
                        }
                    }
                    function e() {
                        m = null;
                        k = !1;
                        if (f && n) {
                            l = !0;
                            var a = n && n.parentNode == f.sprite,
                                d = 0;
                            if (!1 == h) d = f.imageheight * E, 1 > d && (d = 1);
                            else {
                                try {
                                    d = n.childNodes[0].clientHeight, 3 > d && (d = 0)
                                } catch (v) { }
                                if (1 > d && a && n.parentNode && 1 > n.parentNode.clientHeight) {
                                    c(n);
                                    r = 0;
                                    null == m && (m = setTimeout(e, p));
                                    l = !1;
                                    return
                                }
                            }
                            0 < d ? (f.enabled = f._enabled, g.top = g.left = -t + "px", k = !0, q && q.parentNode == f.sprite ? (f.sprite.replaceChild(n, q), q = null) : (b(q), q = null, f.sprite.appendChild(n)), !1 != h && (d = Math.round(d / E), d != f._height && (f._height = d, f.poschanged = !0, _[10] == f._type ? yc(!0, f.index) : f.updatepluginpos(), f.onautosized && S.callaction(f.onautosized, f, !0)))) : (r++, 10 > r ? null == m && (m = setTimeout(e, 2 * p)) : (q && q.parentNode == f.sprite && (f.sprite.replaceChild(n, q), q = null), f.height = 0, h = !1));
                            l = !1
                        }
                    }
                    var f = null,
                        h = !1,
                        k = !1,
                        m = null,
                        l = !1,
                        r = 0,
                        p = 10,
                        q = null,
                        n = null,
                        g = null,
                        t = 1;
                    this.registerplugin = function (a, b, c) {
                        f = c;
                        a = f.html;
                        b = f.css;
                        delete f.html;
                        delete f.css;
                        f.registerattribute(_[372], "none", function (a) {
                            f._autosize = w(a)
                        }, function () {
                            return f._autosize
                        });
                        f.registerattribute(_[310], "none" != f._autosize, function (a) {
                            h = a;
                            f._autosize = a ? _[111] : "none"
                        }, function () {
                            return h
                        });
                        f.registerattribute(_[409], !1);
                        f.registerattribute(_[86], !0);
                        f.registerattribute(_[213], 1);
                        f.registerattribute(_[211], 16777215);
                        f.registerattribute(_[57], !1);
                        f.registerattribute(_[271], 1);
                        f.registerattribute(_[272], 1);
                        f.registerattribute(_[274], 0);
                        f.registerattribute(_[324], 0);
                        f.registerattribute(_[414], 0);
                        f.registerattribute(_[275], 4);
                        f.registerattribute(_[277], 45);
                        f.registerattribute(_[278], 0);
                        f.registerattribute(_[280], 1);
                        f.registerattribute(_[312], 0);
                        f.registerattribute(_[210], 4);
                        f.registerattribute(_[209], 45);
                        f.registerattribute(_[208], 0);
                        f.registerattribute(_[207], 1);
                        f.registerattribute("blur", 0);
                        f.registerattribute(_[371], 0);
                        f.registercontentsize(400, 300);
                        f.sprite.style.pointerEvents = "none";
                        f.createvar("html", a, d);
                        f.createvar("css", b, d)
                    };
                    this.unloadplugin = function () {
                        f && (f.loaded = !1, m && clearTimeout(m), b(q), b(n));
                        f = m = g = n = q = null
                    };
                    var u = E;
                    this.onresize = function (a, b) {
                        if (u != E) u = E, d();
                        else {
                            if (f) {
                                f.registercontentsize(a, b);
                                if (l) return;
                                n && (k && (g.left = g.top = -t + "px"), n.childNodes[0].style.width = a * E + "px", g.width = a * E + 2 * t + "px", h ? (k = !1, r = f.sprite.style.height = 0, null == m && (m = setTimeout(e, p))) : g.height = b * E - 0 + "px")
                            }
                            return !1
                        }
                    };
                    this.updatehtml = d
                },
                zc = !1,
                Ac = 1,
                bf = function () {
                    function a() {
                        !1 == h.css3d && b._distorted && (b._distorted = !1, b.zoom = !0);
                        b.poschanged = !0;
                        b.sprite && (b._visible && b.loaded && yc(!0, b.index), b.sprite.style[va + _[58]] = b._distorted ? "0 0" : _[398])
                    }
                    var b = this;
                    b.prototype = tc;
                    this.prototype.call(this);
                    b._type = _[10];
                    var c = b.createvar;
                    c("ath", 0);
                    c("atv", 0);
                    c(_[415], 0);
                    c("zoom", !1);
                    c("rx", 0);
                    c("ry", 0);
                    c("rz", 0);
                    c(_[340], !1, a);
                    b.accuracy2 = 1;
                    b.zorder2 = 0;
                    b.inverserotation = !1;
                    b.point = new Wa(null);
                    var d = b.create;
                    b.create = function () {
                        d();
                        a()
                    };
                    b.updatepos = function () {
                        b.poschanged = !0
                    };
                    b.getcenter = function () {
                        var a = arguments;
                        2 == a.length && (N(a[0], b.ath, !1, this), N(a[1], b.atv, !1, this))
                    }
                },
                Nd = "",
                Pe = "translate3D(;;px,;;px,0px) ;;rotateX(;;deg) rotateY(;;deg) rotateY(;;deg) rotateX(;;deg) scale3D(;;) translateZ(;;px) rotate(;;deg) translate(;;px,;;px) rotate;;deg) rotate;;deg) rotate;;deg) scale(;;,;;) translate(;;px,;;px)".split(";"),
                Qe = "translate(;;px,;;px) translate(;;px,;;px) rotate(;;deg) translate(;;px,;;px) scale(;;,;;) translate(;;px,;;px)".split(";"),
                cf = function () {
                    this.fullscreen = h.fullscreensupport;
                    this.versioninfo = !0;
                    this.enterfs = _[314];
                    this.exitfs = _[206];
                    this.item = new Wa(function () {
                        this.visible = this.enabled = !0;
                        this.caption = null;
                        this.separator = !1;
                        this.onclick = null
                    })
                },
                fd, Ne = function () {
                    Jd && (Kd(), ad(Ne))
                },
                Jd = !0,
                Kd = null,
                Oe = 0,
                ad = t.requestAnimationFrame || t.webkitRequestAnimationFrame || t.mozRequestAnimationFrame || t.oRequestAnimationFrame || t.msRequestAnimationFrame;
            fd = {
                start: function (a) {
                    if (!ad || h.ios) ad = function (a) {
                        var c = (new Date).getTime(),
                            d = Math.max(0, 16 - (c - Oe));
                        t.setTimeout(a, d);
                        Oe = c + d
                    };
                    Jd = !0;
                    Kd = a;
                    ad(Ne)
                },
                stop: function () {
                    Jd = !1;
                    Kd = null
                }
            };
            fc.init = function (a) {
                fc.so = a;
                h.runDetection(a);
                if (h.css3d || h.webgl) va = h.browser.css.transform, nd = va + "Style", pd = va + _[58];
                od = h.browser.css.backgroundsize;
                wc = h.browser.css.boxshadow;
                Hc = _[89];
                var b = h.webkit && 534 > h.webkitversion;
                b && (Hc = _[355] + Hc);
                h.ios && !1 == h.simulator ? (Ga = 0, "5" <= h.iosversion && 1 != gc && (Ga = 1, h._cubeOverlap = 4)) : h.android ? (Ga = 2, h._cubeOverlap = 0, h.chrome && (Ga = 1, Gc = 0, h._cubeOverlap = 4)) : (h.windows || h.mac) && b ? (Cb = 1, Gc = Ga = 0, h._cubeOverlap = 4) : (Ga = 1, Gc = 0, h._cubeOverlap = 8, h.chrome && (h._cubeOverlap = 22 <= h.chromeversion && 25 >= h.chromeversion ? 64 : 4));
                m = new Qb;
                m.set = N;
                m.get = Q;
                m.call = vc;
                m.trace = ca;
                m["true"] = !0;
                m[_[22]] = !1;
                m.version = _[428];
                m.build = _[315];
                m.buildversion = m.version;
                m.debugmode = !1;
                m.tweentypes = ea;
                m.basedir = _[316];
                m[Fc[0]] = m[Fc[1]] = !0;
                m.haveexternalinterface = !0;
                m.havenetworkaccess = !0;
                m.device = h;
                m.browser = h.browser;
                m._have_top_access = h.topAccess;
                m._isrealdesktop = h.realDesktop;
                m.iosversion = h.iosversion;
                m.isphone = h.iphone;
                m.ispad = h.ipad;
                m.isandroid = h.android;
                m.ishtml5 = !0;
                m.isflash = !1;
                m.ismobile = h.mobile;
                m.istablet = h.tablet;
                m.isdesktop = h.desktop;
                m.istouchdevice = h.touchdevice;
                m.isgesturedevice = h.gesturedevice;
                m.__defineGetter__(_[318], function () {
                    return sb / E
                });
                m.__defineGetter__(_[288], function () {
                    return db / E
                });
                jb(m, _[319], function () {
                    return E
                }, function (a) {
                    E = Number(a);
                    isNaN(E) && (E = 1);
                    H.onResize(null, !0)
                });
                lb = m.area = new $e;
                m.wheeldelta = 0;
                m.wheeldelta_raw = Number.NaN;
                m.keycode = 0;
                m.idletime = 0.5;
                m.__defineGetter__(_[323], fa);
                m.__defineGetter__(_[430], Math.random);
                jb(m, _[90], function () {
                    return H.fullscreen
                }, function (a) {
                    H.setFullscreen(Ma(a))
                });
                jb(m, _[327], function () {
                    return ya.swfpath
                }, function (a) {
                    ya.swfpath = a
                });
                m.hlookat_moveforce = 0;
                m.vlookat_moveforce = 0;
                m.fov_moveforce = 0;
                u = m.mouse = {};
                u.down = !1;
                u.up = !1;
                u.moved = !1;
                u.downx = 0;
                u.downy = 0;
                u.x = 0;
                u.y = 0;
                u.__defineGetter__(_[435], function () {
                    return u.x + lb.pixelx
                });
                u.__defineGetter__(_[436], function () {
                    return u.y + lb.pixely
                });
                r = m.view = new Ye;
                m.screentosphere = r.screentosphere;
                m.spheretoscreen = r.spheretoscreen;
                m.loadFile = ya.loadfile;
                m.decodeLicense = ya.decodeLicense;
                m.parsepath = m.parsePath = ya.parsePath;
                m.contextmenu = new cf;
                $ = m.control = new Ze;
                eb = m.display = {
                    mipmapping: "auto"
                };
                Y = m.image = {};
                Ba = m.plugin = new Wa(tc);
                m.layer = Ba;
                Na = m.hotspot = new Wa(bf);
                Pb = m.events = new Wa(null, !0);
                Pb.dispatch = da;
                Ec = m.progress = {};
                Ec.progress = 0;
                fb = new tc;
                gb = new tc;
                Ba.alpha = 1;
                Ba.visible = !0;
                Na.alpha = 1;
                Na.visible = !0;
                m.xml = {};
                m.xml.url = "";
                m.xml.content = null;
                m.xml.scene = null;
                b = m.security = {};
                jb(b, "cors", function () {
                    return uc
                }, function (a) {
                    uc = a
                });
                la = m.autorotate = {};
                la.enabled = !1;
                la.waittime = 1.5;
                la.accel = 1;
                la.speed = 10;
                la.horizon = 0;
                la.tofov = null;
                la.currentmovingspeed = 0;
                var b = m,
                    c = function (a) {
                        return function (b, c) {
                            void 0 === c ? N(b, Math[a](f(b))) : N(b, Math[a](f(c)))
                        }
                    },
                    d = {},
                    e = _[124].split(" "),
                    f = function (a) {
                        var b = Q(a);
                        return Number(null !== b ? b : a)
                    },
                    j;
                for (j in e) {
                    var k = e[j];
                    d[k] = c(k)
                }
                d.pi = Ja;
                d.atan2 = function (a, b, c) {
                    N(a, Math.atan2(f(b), f(c)))
                };
                d.min = function () {
                    var a = arguments,
                        b = a.length,
                        c = 3 > b ? 0 : 1,
                        d = f(a[c]);
                    for (c++; c < b; c++) d = Math.min(d, f(a[c]));
                    N(a[0], d)
                };
                d.max = function () {
                    var a = arguments,
                        b = a.length,
                        c = 3 > b ? 0 : 1,
                        d = f(a[c]);
                    for (c++; c < b; c++) d = Math.max(d, f(a[c]));
                    N(a[0], d)
                };
                d.pow = S.pow;
                b.math = d;
                m.action = new Wa;
                m.scene = new Wa;
                m.data = new Wa;
                if (!H.build(a)) return !1;
                $.layer = H.controllayer;
                ca(1, _[106] + m.version + _[370] + m.build + (m.debugmode ? _[382] : ")"));
                j = !(h.androidstock || h.android && h.firefox && 22 > h.firefoxversion || h.ios);
                a.html5 && (b = w(a.html5), 0 <= b.indexOf(_[62]) ? j = !0 : 0 <= b.indexOf("css3d") && (j = !1));
                h.webgl && j ? pa.setup(2) : pa.setup(1);
                ca(1, h.infoString + pa.infoString);
                a && (a.basepath && "" != a.basepath) && (ya.swfpath = a.basepath);
                H.onResize(null);
                h.android && h.androidstock && !1 == h.webgl && (kd = !0);
                Ea.registerControls(H.controllayer);
                fd.start(Ld);
                if (!h.css3d && !h.webgl && 0 > w(a.html5).indexOf(_[442])) ta(_[122]);
                else {
                    var s, l = [],
                        e = {},
                        k = !0;
                    j = !1;
                    var b = [],
                        x = c = null,
                        d = Cc(100),
                        p = w(_[145]).split(";"),
                        q;
                    if (null != Ab && "" != Ab) {
                        q = ya.b64u8(Ab);
                        var n = q.split(";");
                        q = Ab = null;
                        if (n[0] == p[0]) for (q = 1; q < n.length; q++) {
                            var g = n[q],
                                z = g.slice(3);
                            if ("" != g && "" != z) switch (_[144].indexOf(g.slice(0, 3)) / 3 | 0) {
                                case 1:
                                    Oa = parseInt(z);
                                    k = 0 == (Oa & 1);
                                    break;
                                case 2:
                                    s = z;
                                    l.push(p[1] + "=" + z);
                                    break;
                                case 3:
                                    l.push(p[2] + z);
                                    break;
                                case 4:
                                    b.push(z);
                                    l.push(p[3] + "=" + z);
                                    break;
                                case 5:
                                    g = parseInt(z);
                                    c = new Date;
                                    c.setFullYear(g >> 16, (g >> 8 & 15) - 1, g & 63);
                                    break;
                                case 6:
                                    x = z;
                                    break;
                                case 7:
                                    jd = z;
                                    break;
                                case 8:
                                    break;
                                case 9:
                                    Ka = z.split("|");
                                    4 != Ka.length && (Ka = null);
                                    break;
                                default:
                                    l.push(g)
                            }
                        }
                        q = B.location;
                        q = w(q.search || q.hash);
                        if (0 < q.indexOf(_[76])) {
                            ta(l.join(", "), w(_[76]).toUpperCase());
                            return
                        }
                        0 < q.indexOf(_[212]) && (null == a.vars && (a.vars = {}), a.vars.consolelog = !0, Oa = Oa & 1 | 14);
                        n = null
                    } else if (l = t.krpanoreg, n = t.krpanokey, z = "", l && n) {
                        for (q = g = 0; 384 > q; q++) {
                            var F = n[2 * q + 0] + g,
                                D = n[2 * q + 1],
                                G = l.charCodeAt(q % l.length),
                                g = g + (F + G - D);
                            59 == F ? (z = z.split("="), 2 == z.length && (e[z[0]] = z[1]), z = "") : z += String.fromCharCode(F)
                        }
                        e[p[1]] != l ? j = !0 : (k = e[p[5]], _[167] == k || _[164] == k || _[173] == k || _[171] == k || _[170] == k || _[169] == k || _[168] == k || _[174] == k || _[160] == k || _[166] == k || _[172] == k || _[165] == k || _[163] == k || _[162] == k || _[176] == k ? k = j = !0 : (s = l, Oa = 15, k = !1))
                    }
                    l = w(B[p[3]]);
                    0 == l.indexOf(_[451]) && (l = l.slice(4));
                    q = "" == l || _[331] == l || _[329] == l || 0 == l.indexOf(p[4]);
                    if (0 == (Oa & 2) && q) j = !0;
                    else if (!q && (q = l.indexOf(".") + 1, 0 > l.indexOf(".", q) && (q = 0), l = l.slice(q), 0 == l.indexOf(_[405]) && _[87] != l && (j = !0), (e = e[p[3]]) && l != e && _[87] == e && (k = !0), 0 < b.length)) {
                        j = !0;
                        for (q = 0; q < b.length; q++) if (l == b[q]) {
                            j = !1;
                            break
                        }
                    }
                    if (null != c && new Date > c) ta(_[224]), null != x && setTimeout(function () {
                        t.location = x
                    }, 500);
                    else if (j) ta(_[242]);
                    else {
                        Ka && ca(1, Ka[0]);
                        !1 == k && (s ? ca(1, _[204] + s) : k = !0);
                        (k || 0 == (Oa & 1)) && H.log(d);
                        s = null;
                        a.xml && (s = a.xml);
                        a.vars && (a.vars.xml && (s = a.vars.xml), s || (s = a.vars.pano));
                        0 == (Oa & 4) && (a.vars = null);
                        Oa & 16 && (m[Fc[0]] = m[Fc[1]] = !1);
                        j = H.viewerlayer;
                        Oa & 8 ? (j.get = yb(Q), j.set = yb(N), j.call = vc) : j.get = j.set = j.call = function () {
                            ca(2, _[143])
                        };
                        j.screentosphere = r.screentosphere;
                        j.spheretoscreen = r.spheretoscreen;
                        j.unload = bd;
                        S.loadpano(s, a.vars);
                        if (a.onready) a.onready(j);
                        return !0
                    }
                }
            }
        }
        var Lb = Ab;
        Ab = null;
        var pb = Lb.length - 3,
            Ua, X, jb, yb = "",
            Mb = "",
            Nb = 1,
            qb = 0,
            zb = [],
            Ld = [1, 48, 55, 53, 38, 51, 52, 3];
        jb = Lb.charCodeAt(4);
        for (Ua = 5; Ua < pb; Ua++) X = Lb.charCodeAt(Ua), 92 <= X && X--, 34 <= X && X--, X -= 32, X = (X + 3 * Ua + 59 + Ld[Ua & 7] + jb) % 93, jb = (23 * jb + X) % 32749, X += 32, 124 == X ? 0 == Nb ? qb ^= 1 : 1 == qb ? qb = 0 : (zb.push(yb), yb = "", Nb = 0) : (X = String.fromCharCode(X), 0 == qb ? yb += X : Mb += X, Nb++);
        0 < Nb && zb.push(yb);
        X = 0;
        for (pb += 3; Ua < pb;) X = X << 5 | Lb.charCodeAt(Ua++) - 53;
        X != jb && (zb = null);
        Ab = Mb;
        var _ = zb;
        _ && _[31] != typeof krpanoJS && (new cd).init(bd)
    };
    c.params || (c.params = c);
    c.vars && (c.params.vars = c.vars);
    c.htmltarget && (c.params.target = c.htmltarget);
    var tt= embedhtml5(c.params, "krp:4liIg)o[D-a0^@RoAFy[X!k6] B'?Eq>(AqT5bhV!YPi<Y@m>2YH.gS9#~SB7.c]4{Ad=Y_F#LhxXn;+(F3efQ6|vRm_K?U]n<z2WG-X_ MQr}4s:50_nrMDUnu;Vi)7k'qWNj%D^F4B!T!Rf?]$u9o_6?6p@=`(>TT&C>7v|jI?>w;G1@SUdrH''wwy,11lmNea]-[Fps1&`fg0lx*5D#+3IZgFtpHef4<6.gN3z&~ A_].+!9+e'lxf(ofpM''P@R|nx~?fBEX$}O9>#/NrR6MUst(reN%e{.ajPvn3,#)n-RWCPy4GHHQ0^8[O*_??vrNo +mtwfHk~7J']4u79yxVt]5K7EL~4_Z^3:je1Wn)cf5vmGn(ig@e9wJ!VFui:z;l8&DLS9A_b20My^G//01!$q'xJ=o2NU}F+DWeSO]yxUKRb;gP:&jD?eqam}ClWx{>4t=_0JK&7d4=Fugy;7GPgHoH(|88Db7Ep&y[qqs[e0D+Yn(+5p7n;!n^B[+](ZzQU5l/=PgBPOMi~-F9akR/o }lu[FQ{,wS9d2x!qFQUhRf[KWyhGK5WxMJ&$n0UG#yLaAS[2 cSsKy[LD1HP[wIv{[&x<oJXS(O.W+II]3G]wG<C^IGjUy'hJ{+4Sb|x~bW|nUACa;IHH{Qo}wXwyQaTY8epQ)k+/!%%)5j6:8 ,VejE'Ff&~/7`+83$F ES?4|Kbzg,q)1NSG8!k%AK-H7NpXS73lqYrxbV+%1}PaY9(tqfdj0%u.2Fv+,:|U7lah!4gx+>d7x%{SE) 9:V~%$(d,>qxlfa5GNz*L{>2;7iS^q&eh$.w/iw[],?y1bj&6yD/M)Y9g_oYULN+3q&UQ$;yTnt]{^6&AR5M/Z#iqgz,nu=Y:XO?3 qBue~T!qt_D+I{>Y, aRT23wd[8^QYEB&dl%3`Kf+]Aa.SKWX&b-a!A*7e a.fa+r FR1Fkr.G3d)@'8uyw-VW3.(I.8e>-N;c;JzfE#cliM7&7FFwa#rD5cdHw#Emf=0v,B`we7/2GiOy|gouI9GpXD4JL>M2saIs~kCTW:] vSLJu8I7obF?Cru!'O7qkZHM{0k?z,?_?c:H(2znLf`<08jEHUR8wQLAt_XC8gKuF,*YWP'>Bogy#NQf19-l]+hTMOM(~{e`flZw@2t1XX,&Oj8f/mJUVUp,yJdH1MYH(J/P;$7liU5yg*q,v<.pDwa`fLJ|0V#s-lZ evxadX}wR6<hYf7(%K*c0Vh.sJ!,V$;[ Hz6pp;=VYmd]DV7/< PQI6bB.*T'MS_TK9X=x#*uKs>|Gi$Z76f<()gtQk2{5,yhc{2P/5[#PsU,m>A>m|a4~Smd6FSzG!rd+Fsl}I8!A$As,w;S&K0--fn}i]-+w*PqB|:vyn-E^[mPO.}~ lSmc]?-*^y^O,VSg>6{1n L)2Q7n$s?ri [IY|80yyaCa5!uOdT%v[f>dHJGzBTI!_APCfKI3AMK#J6;!7ao_/:#Y5q#N,&P({s'Q[4Sepx(Vf(7@>u4BsV5|i[ybg9~#A^caca,GwUc@_04!;vAtoaVtd0KRhsn[]gpMJxq::8g1>sZ>k=D^b2VxJ:Lspw +$uSMVgoP-,H/8_~'DQ&%)n6TuBYh6.j0PzTlGxvIcD~flIfpIDrEY9wWA:FHD?`k[7yA7f0=3)Bzx,me*Uj!:fSn.YU;bZQ_EqEk8dWnamlW8d*~V+|t#x1xwsbf7yps!WSV>'a2M0*iqk#7B aM4PZO:mo5f!1Q0}-'H@*-MVAWy}Y8/W~I3+{sa3o6j/9{k/OHZW1DZZ;S89#MHfi;x^+nS8C2Rs2T:0vI#@K^y2s$~.Z7VR!O1vrv.~szc:_OB4F4&Gj!m<=j)nzS!6Ir5,8KdK`VI&JuG1{X6O8h_.TEZ71Wk0~O, ;gm-20r;a8Lq'7i7CWg::zNnBmC848(P>p~hYx7^jAC)fc4{{$5+z4p2.K GO.tTd$1oI.|B7$6({UCMFp/U%]*VG>cjRvyDh).03SPiFmuB= ^tur{ 4K&u|?q#ny![|W-ZyyQl6x=%E+MBn]`&EG4SNHTf*Z>E:J+<t_EW[0kY`g:P#XZE9Qze8 Y,:yNQmtCw)U[70^+m5:DUkY$Wz8#j>*LWh8hUvS_w-VJ|2!pny,nljpFCEY;b|I GJFc3r?%P$<pl27+N>D|PG4Q*t|VPX+-#^^SGQg9bhjSjS:6'@.;:vf,Ym~YNgQ0;y7):89+1T[EhEy2Q@T[IU<?rj9L<S,s apKArIU*[aKBn+w5bx*TJ6}'c/uEeK6_ofDhV^Q$iH;/tlL|^_8+JM)0y<3|kV;j7Bd1zt%t&dM]>*M^9%~_j7k>rJc(e'Sd.0k=;!*)s7ol#N%:YP&QV0OEL[bVB]_*-SkP]5m8E/~x<>rx1+y9p?]Dk}jcd}/065W7jMJnNcoJmWKxZR68Lorc5:WlFx4,kRv0;sU//Yb74[79~ZkO^VERLQr[UQhi'7tp^Ca1dRZ(fDi:`yN4y!q]z=9^AsQ;F[EFep5D8R0k$LgWcJ0u3NXl)/N0L-=DGM-?_Z{R<BaTHHDB)E(O7=;}WsV UhuGoxg&sZDH3o(-H:wwT>j*;I/*e58=s1}]N3[:Y9vNvKRp8`FzPp6_OPNV%o$m3ZCgGRqv!6xtZk$b/'9|T(f<`4e+np9F&v4bbqUVr;$%k:-$w<BeTB7@K]Scp2]h>VT[9ri|1M<p0x2tX]_}i%hOBcu3 iG!lq j[h)FA26n6 60*#^I(y9&8dUZ&Y(n^WX(-S6p;F2Jtcy Rb=&IRLUw[8V (W~`BQY21+l<2uGEI0,<{poKLe.BRaM:UF pcw'eTlZl3$([mBWQv%QSfH36G!xs6<O`xdYkNfF<=e/KFD:^q)]2kC]^UaJKZdN&c(#(,[V2l[PGe$`H#+|Xec+ qv[}WgA!>gGovmtOPC(2IA&RY2?Wb?P966rqhja9&NVJ_aSeR^,cocK@;yqGt.`gxFImoLT:PC@aSF;30}2kUc&vo[EHA)CsMBZuokiB!}y!ync,QK2bWi +X{qLTz<>`z~^7}u7U?Te$=f8c|GnwPL3{fl-hpi/&;{MQY_mt)n(3Wj3/UU'0R:0oecXxf`).N >&7^`Rx]MqJG-O{-| 59,OSo5lIZWWhZrj*CP'A{!|8z&1DVdL@GG6I)wK vAer_5/XhA:1DVd1Xk{v]WLsJY8L^If1GQ-WncTG}V&<8l1D=)>EoHwwuv%=XkqbT]>npOZ|>;t0H3LID4XdJPTB?9azz;<I!hCc[?[5m2zrL&s. vxe'x<@%vgS },'Ya=VDxP|-hF4a.Oz3oNK?_XI}znNADhb6MxD|2&G_P7-9Q}KXV&?ry3=*a]6[Hf!0/=-^-XShQuXZNOtb=z0?6Eg[z0rcc7.s0W/_DLk.>^[YkEBGh4,+jU@D*>aEU!?ro)jahZ++?V}.=.28z24*%78V-M#oc+Z{zjVKg,P97H<C-MpSt& !h_mw|Qq fVl8U{pKmW6DLoT$W'Q50#8k,g8(oJwS^_@!qFcATqCR'uMGu)+:]mmK61=uNzlrtc9ib!uCjz>@LW7#5Gi7Cvfj_z-c5j,/VfH$Ir8:2G^hd1'iOK?Wd8Owj0P#!8p_s7BZSN(@xeNm>qa:&ZV j)0it-IL#x6 r,o__~m![1R'@)ZI)9m3P/MN)QI!4D;Qz-t|4_2hD{b+x}azc^EFsg!%q!P M0P}UOU}#'c58MK6V]davl%l-10Zm5UQp`=,5~7vw8F0o,{6wX1h(G]eE!)DX'?{5JRj4&`g3/h+C7*)mvXAr6+r`$;!dJY=Q.J$i{%4*jY%T@,qM/L0S/~_arpb&3&W&L9_&-#XV-`!RTl]binZChM-x{(-^O@G`OIP%)jPgF)TB(y'DkH?9w[X?njN>qcz,;g%wB#{yKh9Ah5QtrXwd)F]f,TO7Dh>t]m-XE7.nRB]eG]DDg,R]7.gm.)1J'tY^g!Nm7zS|,1u^I{6*L<//.(Leo ,Eg]U} 0h/WI'sG,YP _X4|f?b>JGK@N$b2z_./>T9'qFtVhwvkUS[fg6]SFl~Ubnmq7#VY2nc1q'Xv'e{6}e7/Dg)63$VBSiU[@/g$C/R;1jbCk:OEF2Q| 5y6s'+OQ)3y9|#3Q';iQE#dI~h9P}p=to&zS5cCb?]5yYq';sFSX+7ilIN1ihcgrnP[>odLYPexmC^@KE4'.3sIy!?x6pjH;m[:nA5<o.ZHV'8bseW-ue.)G'q@OGb/b{tMUJ;ZzF-_bf89/5:'0,:K%CD}PN&VNj3[ x-rLz&JhG-/:<A^Or(nFh|/CC.*)f=Q24^5]Cs.KNs)OZM52VEKw'Gak~ZlTlds$*n^ZH?U.NvF%-qq/hb_b' /dv:o3I:3ckfd?m!C<C8mFmr<M~R_Rfs*W{hi&fq0c%mmW.tS7  -AtHh'vT[Kga&L(E*}mCE#1ay/Vhf KqkRj<Ct'Q;c#f)~=Up=kmpzi:GW3HH2~'Tebp^V`T'&}tZ]B4YEn12k302IB,_a$Q.KYFXR2aZeSZ7NSugT>2#z$o0@ouN<jK.*FQD>T:}/g7GsbD~vQc}o^RI3M5g.ILo'y2liqcX6k%kzX9P>=9vZnslIdUSEi5oFU-ffn,[C~Vo+ !2CI85A705*B'Li}J-IR`LO@wmAwaTw:9#d>6+L{Hik-2)>Bvk2:D;'_vO:.[e74}F^*7[:JF_{Wo}.MZ[xo,Kwp.o})~7B?Cw;y.N8,Q8 AUz8Qoigk,nSRYn_;Z$Cw#V=K5gpco(kz`/+cGx/!!rt94+ ffJ'G?DmT~^E7+~Lq/=@3T'V2A+/x2/$S{#B8&hA.?]Jdi.6Hzk!~fo,P7xN/Z.Iq.DF:=qTAFz?z[@eQ].g7eH9(S=mNi(`W!H+oFwCmF~}#&mmrp1?5_D4GZ%DU2rGu,$*G@/zx99?il %-vl+j9Q|D :K!D<E#ME)ZjJpoqb%lSi.E*'{JO:4_pN[$L&n%#8v}Kk+OvmrtZ9tWf[T]rjN221+9e/nLAvMQszO,-}?c7b[sNGLXhiOcpk%is'#2_{oc=*Wj 9k(=3Sv&6gKsGU(3'I+V=aZx(>`v4Q7aqZ>MN%b=@gh]9(w)-XV9c%>eD&T0tQ?]+mGdX`b$A4Qud7Q;{T$RUZUK9b_l[Mm]K.^A7-GMUYe{&0oy4~7WP}gk+UWKH^h;`U.+W/_|;%;`Z+m]*/rc3ETdl}e98hD(I`L7gl.dtcuV)D}klG07VYm`Q()tUf>ts$|XABco=m6&ea(r<*SGpL(zI]1u3I`((wg2uac.5/IQBh{w;2B(F<)_+J,5DSXhYn,Iy^Yi9,QzW//pK'qU{Eaw0hE$7]<kFAgnCGFl@4t.Lo&:DN7VrXY+}0O}bv!kj~!HNA9XfR'8NlRs{[<se`|7,?u8H]2ql(.IZTy*2DgnC>]-tpVyqTNw*l%L{y<U1sQ=,h?2IIf^FPZ09jk$4w@5Zo21TI 7_=o.Xs3$SAo=K1t17=_t1~L&yL=d^:}<b7!FBMFD-MG;Lp-GdIi&{>Z*SERY#z?;<dLNKi_8U=(8X<F,]6h'=0*frjaeaqfMOO;gC/Sh|l)XMO[TMOLYDGNG-@i;S*QXmBa/,A]{UA_ekv%V0C?,HM@25[Y/<1@y*gkb.hI?#jL*8v&B0k`0*.6=qFb;ZHPg8E('kl&rX/!iO}#-`QpaJxibc~3F`!GUhia<SQ}#GLjWi0qd-[?/X)L)s`ym=AP4F@b6iXTGsI'hguYi[pEe.@G/R=$HzY<gOr~7jcc{7(GYvrN/PZLsITId{<N6p3U+/fCCns[3[Q&y4?&AI2oy}|$.c(-1+o@7~Ytr~1M}cw+^vCiK{veni6-VhMT, wL_ec9ID-b1#)[o$xV6r/qGlc#|~!9>!`gpPF3$ZtKqg+;vuzRI>+^},ZJ,6$%UEcP[C-4,muNG}OnSI5MaMs-i`42`2 o_Iw(d:?)&ewJ|EL[}th^:8;1w_K3 fJ2!^n ce+*mVAR`egIl rZ,W~,UO%YrV85=8&@X:gkJ#udP[z{H2rR,=-{GK;$chepW{3@C!L2D~06;eF#grrU{B7.86S';2mst]uqi+9c/Yd^*'d-wUIxH5xIVZd<0'E9Gmm0]DL,d^zx%OC5uFv4>ZGj!=95;K)5A@B+{KHXeym#$/``)a(H@/7&?vih&ft/'s&~Oy5C)`)6AO1=%uOM(y`sd87C#/a@@qKahK!_5*p*G%muUt4)Cb,nqus9Nc5dJ5+tAYxt2O)V_CD#O09&7iLLioS S{>~2.%fZ%bEn%05RAmbtr@fmhOBW%T>:b%WtTj?n)E8!a5A{;2h#e<4 HAVK1,B~m~9GnZM$gF6$w=6vIWJ/#n,1v(v-57a5CE#@wLd5r.9;a{s.=egI9!~Y<:!wM`fZ'40}(n~wQ)VMH)vD-yl:y=`H6*5Qri4?|~o5rek2D>07+9C&nC~fsMnX@ WB+v}ov9d_MeI2|Rgs9[M-m[A_|_P@zpM c4Olqi<^()2[b `leew@BP!X_?Ju0W)}}DPK 'o`7y@:^06:a<}RF3+iDs3-RX-_YSHK[|/Egy$&iyp`7wR={pKog<L>,@l#XmomSk^X.5]U;:lR<*v:*i6Q7'&>,YE|;W<&g!j)>I4}!9f+y+=nlB4vM+lzgFp>'in.24'^LGbh3a9ZGNsnem[S!kgwce_[9^oDVk/=crOTm$SNl^|=0}HnzQCf6Sn9ieh&QP20)kP^Od1TolbMW g|t!haa9uAT@aR:|eu^ f)=b!BZ}|=|aji=W.;@h`Pm15yUj9~GlDqO+Yq/Y,:z~%_6Ul~| *8bypObsC<1f6XvxtVBZ+Vo-&NrnG!pCVALOHRuk{OSkpWmA5JyD=`p0A=5h,DyG-a(OCZG=wiIKa-q.2z ? pJecX;{;?:XW!cva15&_.=5yM`%~65L ==cn[6KX1REH0;L8 1`.+EPM:?N")
    console.log(c.params);
};