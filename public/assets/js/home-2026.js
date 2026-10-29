/* =====================================================================
   ON Solutions — Tema 2026 (Fase A)
   Interações da home: menu, checklist de dores, calculadora de ROI,
   montagem dinâmica da mensagem do WhatsApp, carrosséis, topbar.
   Portado de docs/referencia/home-ref.html (sem o roteador SPA por hash).
   O número/mensagem base do WhatsApp vêm do servidor (setting()).
   ===================================================================== */
(function () {
  "use strict";

  function $(s, r) { return (r || document).querySelector(s); }
  function $$(s, r) { return [].slice.call((r || document).querySelectorAll(s)); }
  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)");

  // Mensagem base vem do atributo data-wa do botão fixo (preenchido via setting()).
  var fixCta = $("[data-wa-main][data-pos=fixo]");
  var BASE_MSG = (fixCta && fixCta.getAttribute("data-wa")) || "";

  // Monta o href de um botão conforme o modo explícito definido no servidor:
  //  - mode="whatsapp": endpoint wa.me + ?text=<mensagem>
  //  - mode="contact" : endpoint /contato + ?msg=<mensagem> (sem número configurado;
  //                     o visitante não perde o que preencheu — vai como parâmetro)
  // Sem endpoint/modo conhecido, mantém o href original (nunca gera link inválido).
  function buildHref(a, text) {
    var mode = a.getAttribute("data-wa-mode");
    var endpoint = a.getAttribute("data-wa-endpoint");
    if (!endpoint || !mode) return a.getAttribute("href");
    var param = (mode === "whatsapp") ? "text" : "msg";
    return endpoint + "?" + param + "=" + encodeURIComponent(text);
  }

  // ---------- mensagem dinâmica (base + desafios marcados + calculadora) ----------
  var view = $("main.view") || document;
  function refresh() {
    var m = BASE_MSG;
    var ps = $$(".pain[aria-pressed=true]", view).map(function (p) {
      return (p.getAttribute("data-q") || "").replace(/[.!?]+$/, "");
    });
    if (ps.length) {
      m += (ps.length > 1 ? " " + (view._lblMany || "Meus maiores desafios hoje:") : " " + (view._lblOne || "Meu maior desafio hoje:")) + " " + ps.join("; ") + ".";
    }
    if (view._calc) m += " " + view._calc;

    $$("[data-wa-main]").forEach(function (a) {
      a.setAttribute("data-wa", m);
      var href = buildHref(a, m);
      if (href) a.href = href;
    });
  }

  // GA/dataLayer no clique do WhatsApp (preserva comportamento da referência)
  document.addEventListener("click", function (e) {
    var a = e.target.closest ? e.target.closest("[data-wa-main]") : null;
    if (!a) return;
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({ event: "whatsapp_click", position: a.getAttribute("data-pos") || "fixo" });
  }, true);

  // ---------- menu desktop (mega) ----------
  var dd = $(".dd"), ddb = dd && $(".dd-btn"), ddMega = dd && $(".mega", dd), tmr;
  var canHover = window.matchMedia("(hover: hover) and (min-width: 1101px)");
  function ddOpen() {
    clearTimeout(tmr);
    dd.classList.add("open");
    ddb.setAttribute("aria-expanded", "true");
    if (ddMega) { ddMega.hidden = false; ddMega.setAttribute("aria-hidden", "false"); }
  }
  function ddClose() {
    dd.classList.remove("open");
    ddb.setAttribute("aria-expanded", "false");
    if (ddMega) { ddMega.hidden = true; ddMega.setAttribute("aria-hidden", "true"); }
  }
  if (dd) {
    ddb.addEventListener("click", function (e) { e.stopPropagation(); dd.classList.contains("open") ? ddClose() : ddOpen(); });
    dd.addEventListener("mouseenter", function () { if (canHover.matches) ddOpen(); });
    dd.addEventListener("mouseleave", function () { if (canHover.matches) tmr = setTimeout(ddClose, 140); });
    document.addEventListener("click", function (e) { if (!dd.contains(e.target)) ddClose(); });
    $$(".mega a", dd).forEach(function (a) { a.addEventListener("click", ddClose); });
  }

  // ---------- menu mobile ----------
  var bg = $(".burger"), mn = $("#mnav");
  function mClose() { mn.hidden = true; bg.setAttribute("aria-expanded", "false"); bg.classList.remove("on"); }
  if (bg && mn) {
    bg.addEventListener("click", function () {
      var o = mn.hidden; mn.hidden = !o;
      bg.setAttribute("aria-expanded", String(o)); bg.classList.toggle("on", o);
    });
    $$("a", mn).forEach(function (a) { a.addEventListener("click", mClose); });
    window.addEventListener("resize", function () { if (window.innerWidth > 1100) mClose(); });
  }
  document.addEventListener("keydown", function (e) { if (e.key === "Escape") { if (dd) ddClose(); if (bg && mn) mClose(); } });

  // ---------- rolagem suave para âncoras internas ----------
  // Os links do nav (Resultados/Calculadora/Como funciona/Dúvidas) apontam para
  // URLs absolutas com hash (ex.: https://site/#resultados). Quando já estamos
  // na mesma página, interceptamos o clique e rolamos suavemente até a seção,
  // em vez de deixar o navegador "pular" (salto seco). Se o alvo for outra
  // página, deixamos a navegação normal acontecer.
  function samePagePath(href) {
    try {
      var u = new URL(href, window.location.href);
      return u.pathname === window.location.pathname && u.search === window.location.search && u.hash;
    } catch (e) { return false; }
  }
  document.addEventListener("click", function (e) {
    var a = e.target.closest ? e.target.closest('a[href]') : null;
    if (!a) return;
    var href = a.getAttribute("href");
    if (!href || href.indexOf("#") === -1) return;
    var hash = samePagePath(href);
    if (!hash) return; // âncora de outra página: navegação normal
    var target = document.getElementById(hash.slice(1));
    if (!target) return;
    e.preventDefault();
    target.scrollIntoView({ behavior: reduce.matches ? "auto" : "smooth", block: "start" });
    // atualiza a URL sem recarregar, para refletir a seção atual
    if (history.pushState) history.pushState(null, "", hash);
  });

  // ---------- topbar: esconde ao rolar para baixo ----------
  var topBar = $(".top");
  if (topBar) {
    var lastY = window.scrollY, acc = 0, ticking = false;
    var menuOpen = function () { return (bg && mn && !mn.hidden) || (dd && dd.classList.contains("open")); };
    var onScroll = function () {
      var y = window.scrollY, d = y - lastY;
      lastY = y; ticking = false;
      if (y < 80 || menuOpen()) { topBar.classList.remove("hide"); acc = 0; return; }
      if ((d > 0 && acc < 0) || (d < 0 && acc > 0)) acc = 0;
      acc += d;
      if (acc > 24) topBar.classList.add("hide");
      else if (acc < -24) topBar.classList.remove("hide");
    };
    window.addEventListener("scroll", function () { if (!ticking) { ticking = true; window.requestAnimationFrame(onScroll); } }, { passive: true });
    topBar.addEventListener("focusin", function () { topBar.classList.remove("hide"); });
  }

  // ---------- toggle Hoje / Com estratégia (painel antes/depois) ----------
  $$("[data-toggle]").forEach(function (box) {
    var bs = $$("[data-t]", box), ps = $$("[data-p]", box);
    bs.forEach(function (b) {
      b.addEventListener("click", function () {
        var k = b.getAttribute("data-t");
        bs.forEach(function (x) { x.setAttribute("aria-pressed", String(x === b)); });
        ps.forEach(function (p) { p.hidden = p.getAttribute("data-p") !== k; });
      });
    });
  });

  // ---------- abas (o que resolvemos) ----------
  $$("[data-tabs]").forEach(function (box) {
    var bs = $$("[data-tab]", box), ps = $$("[data-pane]", box);
    bs.forEach(function (b) {
      b.addEventListener("click", function () {
        var k = b.getAttribute("data-tab");
        bs.forEach(function (x) { x.setAttribute("aria-pressed", String(x === b)); });
        ps.forEach(function (p) { p.hidden = p.getAttribute("data-pane") !== k; });
        setTimeout(function () { window.dispatchEvent(new Event("resize")); }, 0);
      });
    });
  });

  // ---------- checklist de desafios ----------
  var hintEl = $("[data-hint]", view);
  if (hintEl) {
    view._lblOne = hintEl.getAttribute("data-label-one") || view._lblOne;
    view._lblMany = hintEl.getAttribute("data-label-many") || view._lblMany;
  }
  document.addEventListener("click", function (e) {
    var p = e.target.closest ? e.target.closest(".pain") : null;
    if (!p) return;
    p.setAttribute("aria-pressed", String(p.getAttribute("aria-pressed") !== "true"));
    var n = $$(".pain[aria-pressed=true]", view).length, h = $("[data-hint]", view);
    if (h) {
      if (n === 0) h.textContent = "";
      else if (n === 1) h.textContent = h.getAttribute("data-hint-one") || "";
      else h.textContent = (h.getAttribute("data-hint-many") || "").replace(/:n/g, n);
    }
    refresh();
  });

  // ---------- calculadora de ROI ----------
  var cal = $("[data-calc]");
  if (cal) {
    var t = $("[data-c=ticket]", cal), m = $("[data-c=margem]", cal), iv = $("[data-c=invest]", cal),
        out = $("[data-c=out]", cal), tx = $("[data-c=txt]", cal);
    var L = {
      salesOne: cal.getAttribute("data-l-sale-one") || "venda a mais por mês",
      salesMany: cal.getAttribute("data-l-sale-many") || "vendas a mais por mês",
      fill: cal.getAttribute("data-l-fill") || "Preencha os três campos para ver o resultado.",
      txt: cal.getAttribute("data-l-txt") || "Cada venda deixa cerca de :lucro de lucro. Para cobrir :inv por mês, você precisa de :n a mais do que vende hoje.",
      msg: cal.getAttribute("data-l-msg") || "Fiz a conta na calculadora: produto de :ticket, margem de :margem% e investimento de :inv por mês (cerca de :n vendas a mais para empatar)."
    };
    var brl = function (v) { return "R$ " + Math.round(v).toLocaleString("pt-BR"); };
    var calc = function (user) {
      var a = parseFloat(t.value), mm = parseFloat(m.value), inv = parseFloat(iv.value);
      if (!(a > 0) || !(mm > 0) || !(inv >= 0)) {
        out.textContent = "\u2014"; tx.textContent = L.fill; view._calc = ""; refresh(); return;
      }
      var lucro = a * (mm / 100), n = Math.ceil(inv / lucro);
      out.textContent = n + " " + (n === 1 ? L.salesOne : L.salesMany);
      tx.textContent = L.txt.replace(/:lucro/g, brl(lucro)).replace(/:inv/g, brl(inv)).replace(/:n/g, n);
      if (user) {
        view._calc = L.msg.replace(/:ticket/g, brl(a)).replace(/:margem/g, mm).replace(/:inv/g, brl(inv)).replace(/:n/g, n);
      }
      refresh();
    };
    [t, m, iv].forEach(function (el) { el.addEventListener("input", function () { calc(true); }); });
    calc(false);
  }

  // ---------- carrossel infinito de problemas (celular) ----------
  var mqS = window.matchMedia("(max-width: 640px)");
  var loops = $$(".mq-m");
  function loopSpeed(el) {
    var tr = $(".mq-track", el), half = tr.scrollWidth / 2;
    if (half > 0) el.style.setProperty("--dur", Math.max(20, half / 35) + "s");
  }
  function loopsOn() {
    loops.forEach(function (el) {
      if (el.classList.contains("is-looping")) return;
      var tr = $(".mq-track", el);
      [].slice.call(tr.children).forEach(function (c) {
        var k = c.cloneNode(true); k.setAttribute("data-clone", ""); k.setAttribute("aria-hidden", "true"); k.setAttribute("tabindex", "-1"); tr.appendChild(k);
      });
      el.classList.add("is-looping"); loopSpeed(el);
    });
  }
  function loopsOff() {
    loops.forEach(function (el) {
      $$("[data-clone]", el).forEach(function (c) { c.remove(); });
      el.classList.remove("is-looping", "is-paused"); el.style.removeProperty("--dur");
    });
  }
  function loopsSync() { if (mqS.matches && !reduce.matches) loopsOn(); else loopsOff(); }
  loops.forEach(function (el) {
    el.addEventListener("touchstart", function () { el.classList.add("is-paused"); }, { passive: true });
    el.addEventListener("touchend", function () { setTimeout(function () { el.classList.remove("is-paused"); }, 1500); }, { passive: true });
  });
  loopsSync();
  (mqS.addEventListener ? mqS.addEventListener("change", loopsSync) : mqS.addListener(loopsSync));
  window.addEventListener("resize", function () { loops.forEach(function (el) { if (el.classList.contains("is-looping")) loopSpeed(el); }); });

  // ---------- carrossel infinito de clientes ----------
  $$("[data-marquee]").forEach(function (mq) {
    var tr = $("[data-track]", mq);
    if (!tr || !tr.children.length) return;
    if (reduce.matches) return;
    [].slice.call(tr.children).forEach(function (c) { var k = c.cloneNode(true); k.setAttribute("aria-hidden", "true"); tr.appendChild(k); });
    function sp() { var h = tr.scrollWidth / 2; if (h > 0) mq.style.setProperty("--dur", Math.max(30, h / 40) + "s"); }
    sp(); window.addEventListener("resize", sp); mq.classList.add("is-looping");
    var tt;
    mq.addEventListener("touchstart", function () { clearTimeout(tt); mq.classList.add("is-paused"); }, { passive: true });
    mq.addEventListener("touchend", function () { tt = setTimeout(function () { mq.classList.remove("is-paused"); }, 1500); }, { passive: true });
  });

  // ---------- FAQ fechado no celular ----------
  if (mqS.matches) $$(".faq details[open]").forEach(function (d) { d.removeAttribute("open"); });

  refresh();
})();
