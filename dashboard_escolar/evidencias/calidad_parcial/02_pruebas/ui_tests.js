const { chromium, firefox, webkit } = require('playwright');
const { spawn, execSync } = require('child_process');
const fs = require('fs'), path = require('path');
const S = process.argv[2];
(async () => {
  const out = {};
  for (const [ver, port] of [['before', 8201], ['after', 8202]]) {
    const dir = `${S}/run_${ver}`;
    fs.writeFileSync(`${dir}/config/database.php`, `<?php\n$pdo = new PDO('sqlite:${dir}/ui.sqlite');\n$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);\n$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);\n`);
    try { fs.unlinkSync(`${dir}/ui.sqlite`); } catch {}
    execSync(`python3 -I -c "import sqlite3;c=sqlite3.connect('${dir}/ui.sqlite');c.executescript(\\"CREATE TABLE materias(id INTEGER PRIMARY KEY, nombre TEXT, modulo TEXT, submodulo TEXT, semestre INTEGER, descripcion TEXT, activo INTEGER DEFAULT 1); INSERT INTO materias(nombre,modulo,submodulo,semestre) VALUES ('Procesamiento de Lenguaje Natural','Modulo II','Sub 2',3),('Implementa aplicaciones web','Modulo IV','Sub 2',NULL);\\");c.commit()"`);
    const php = spawn('php', ['-S', `127.0.0.1:${port}`, '-t', dir], { stdio: 'ignore' });
    await new Promise(r => setTimeout(r, 1200));
    const r = out[ver] = {};
    const caps = `${S}/caps_${ver}`; fs.mkdirSync(caps, { recursive: true });
    for (const [bname, bt] of [['chromium', chromium], ['firefox', firefox], ['webkit', webkit]]) {
      let br; try { br = await bt.launch(); } catch (e) { r[bname] = 'no disponible'; continue; }
      const res = r[bname] = {};
      for (const [vp, w, h] of [['desktop', 1366, 768], ['movil', 390, 844]]) {
        const ctx = await br.newContext({ viewport: { width: w, height: h }, deviceScaleFactor: 1 });
        const pg = await ctx.newPage();
        await pg.goto(`http://127.0.0.1:${port}/index.php`);
        const m = await pg.evaluate(() => {
          const f = document.querySelector('footer'), c = document.querySelector('.content'), s = document.querySelector('.sidebar');
          const fr = f.getBoundingClientRect(), cr = c.getBoundingClientRect();
          return { cards: document.querySelectorAll('.card').length,
            servCard: document.querySelectorAll('.card strong')[1].textContent,
            hscroll: document.documentElement.scrollWidth > window.innerWidth,
            footerBesideContent: fr.left >= cr.right - 1 && fr.top < cr.bottom,
            footerText: f.textContent.trim(),
            deadLinks: [...document.querySelectorAll('nav a')].filter(a => a.getAttribute('href') === '#').length,
            navLinks: document.querySelectorAll('nav a').length };
        });
        await pg.screenshot({ path: `${caps}/index_${bname}_${vp}.png`, fullPage: true });
        await pg.goto(`http://127.0.0.1:${port}/materias.php`);
        const m2 = await pg.evaluate(() => ({ filas: document.querySelectorAll('tbody tr').length, hscroll: document.documentElement.scrollWidth > window.innerWidth, navLinks: document.querySelectorAll('nav a').length }));
        await pg.fill('#buscador', 'web'); await pg.dispatchEvent('#buscador', 'keyup');
        m2.visiblesTrasBuscar = await pg.evaluate(() => [...document.querySelectorAll('tbody tr')].filter(t => t.style.display !== 'none').length);
        await pg.screenshot({ path: `${caps}/materias_${bname}_${vp}.png`, fullPage: true });
        res[vp] = { index: m, materias: m2 };
        await ctx.close();
      }
      await br.close();
    }
    php.kill();
  }
  fs.writeFileSync(`${S}/results_ui.json`, JSON.stringify(out, null, 1));
  console.log(JSON.stringify(out, null, 1));
})();
